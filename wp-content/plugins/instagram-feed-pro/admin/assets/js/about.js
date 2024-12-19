var extensions_data = {
    genericText: sbi_about.genericText,
    links: sbi_about.links,
    extentions_bundle: sbi_about.extentions_bundle,
    supportPageUrl: sbi_about.supportPageUrl,
    plugins: sbi_about.pluginsInfo,
    stickyWidget: false,
    socialWallActivated: sbi_about.socialWallActivated,
    socialWallLinks: sbi_about.socialWallLinks,
    recommendedPlugins: sbi_about.recommendedPlugins,
    social_wall: sbi_about.social_wall,
    aboutBox: sbi_about.aboutBox,
    ajax_handler: sbi_about.ajax_handler,
    nonce: sbi_about.nonce,
    buttons: sbi_about.buttons,
    icons: sbi_about.icons,
    recheckLicenseStatus: null,
    licenseKey : sbi_about.licenseKey,
    btnClicked: null,
    btnStatus: null,
    btnName: null,
    sbiLicenseNoticeActive: (sbi_about.sbiLicenseNoticeActive === '1'),
    sbiLicenseInactiveState: (sbi_about.sbiLicenseInactiveState === '1'),
    licenseBtnClicked : false,
    svgIcons : sbi_about.svgIcons,
    viewsActive : {
        whyRenewLicense : false,
        licenseLearnMore : false,
    },
    notificationElement : {
        type : 'success', // success, error, warning, message
        text : '',
        shown : null
    },
}

var sbiAbout = new Vue({
    el: "#sbi-about",
    http: {
        emulateJSON: true,
        emulateHTTP: true
    },
    data: extensions_data,
    methods: {
        recheckLicense: function( optionName = null ) {
			var self = this;
			var licenseNoticeWrapper = document.querySelector('.sb-license-notice');
            self.recheckLicenseStatus = 'loading';
			let data = new FormData();
            data.append( 'action', 'sbi_recheck_connection' );
            data.append( 'license_key', self.licenseKey );
            data.append( 'option_name', optionName );
            data.append( 'nonce', this.nonce );
            fetch(this.ajax_handler, {
                method: "POST",
                credentials: 'same-origin',
                body: data
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                if ( data.success == true ) {
                    if ( data.data.license == 'valid' ) {
                        this.recheckLicenseStatus = 'success';
                    }
                    if ( data.data.license != 'valid' ) {
                        this.recheckLicenseStatus = 'error';
                    }

                    setTimeout(function() {
                        this.recheckLicenseStatus = null;
						if ( data.data.license == 'valid' ) {
							licenseNoticeWrapper.remove();
						}
                    }.bind(this), 3000);
                }
                return;
            });
        },
        recheckBtnText: function( btnName ) {
			var self = this;
            if ( self.recheckLicenseStatus == null ) {
                return self.genericText.recheckLicense;
            } else if ( self.recheckLicenseStatus == 'loading' ) {
                return self.svgIcons.loaderSVG + ' ' + self.genericText.recheckLicense;
            } else if ( self.recheckLicenseStatus == 'success' ) {
                return self.svgIcons.checkmarkSVG + ' ' + self.genericText.licenseValid;
            } else if ( self.recheckLicenseStatus == 'error' ) {
                return self.svgIcons.times2SVG + ' ' + self.genericText.licenseExpired;
            }
        },
		/**
		 * Activate license key from license error post grace period header notice 
		 * 
		 * @since 6.2.0
		 */
		 activateLicense: function() {
			var self = this;
			if ( self.licenseKey == null ) {
                return;
			}
            self.licenseBtnClicked = true;
            let data = new FormData();
            data.append( 'action', 'sbi_license_activation' );
            data.append( 'nonce', sbi_admin.nonce );
            data.append( 'license_key', self.licenseKey );
            fetch(sbi_about.ajax_handler, {
                method: "POST",
                credentials: 'same-origin',
                body: data
            })
            .then(response => response.json())
            .then(data => {
                self.licenseBtnClicked = false;
				if(data && data.success == false) {
					self.processNotification("licenseError");
					return;
				}
				if( data.success != false ){
					self.processNotification("licenseActivated");
				}
            });
		},
        activatePlugin: function( plugin, name, index, type ) {
            this.btnClicked = index + 1;
            this.btnStatus = 'loading';
            this.btnName = name;

            let data = new FormData();
            data.append( 'action', 'sbi_activate_addon' );
            data.append( 'nonce', this.nonce );
            data.append( 'plugin', plugin );
            data.append( 'type', 'plugin' );
            if ( this.extentions_bundle && type == 'extension' ) {
                data.append( 'extensions_bundle', this.extentions_bundle );
            }
            fetch(this.ajax_handler, {
                method: "POST",
                credentials: 'same-origin',
                body: data
            })
            .then(response => response.json())
            .then(data => {
                if( data.success == true ) {
                    if ( name === 'social_wall' ) {
                        this.social_wall.activated = true;
                    } else if ( type === 'recommended_plugin' ) {
                        this.recommendedPlugins[name].activated = true;
                    } else {
                        this.plugins[name].activated = true;
                    }
                    this.btnClicked = null;
                    this.btnStatus = null;
                    this.btnName = null;
                }
            });
        },
        deactivatePlugin: function( plugin, name, index, type  ) {
            this.btnClicked = index + 1;
            this.btnStatus = 'loading';
            this.btnName = name;
            
            let data = new FormData();
            data.append( 'action', 'sbi_deactivate_addon' );
            data.append( 'nonce', this.nonce );
            data.append( 'plugin', plugin );
            data.append( 'type', 'plugin' );
            if ( this.extentions_bundle && type == 'extension' ) {
                data.append( 'extensions_bundle', this.extentions_bundle );
            }
            fetch(this.ajax_handler, {
                method: "POST",
                credentials: 'same-origin',
                body: data
            })
            .then(response => response.json())
            .then(data => {
                if( data.success == true ) {
                    if ( name === 'social_wall' ) {
                        this.social_wall.activated = false;
                    } else if ( type === 'recommended_plugin' ) {
                        this.recommendedPlugins[name].activated = false;
                    } else {
                        this.plugins[name].activated = false;
                    }
                    this.btnClicked = null;
                    this.btnName = null;
                    this.btnStatus = null;
                }
                return;
            });
        },
        installPlugin: function( plugin, name, index, type ) {
            this.btnClicked = index + 1;
            this.btnStatus = 'loading';
            this.btnName = name;

            let data = new FormData();
            data.append( 'action', 'sbi_install_addon' );
            data.append( 'nonce', this.nonce );
            data.append( 'plugin', plugin );
            data.append( 'type', 'plugin' );
            fetch(this.ajax_handler, {
                method: "POST",
                credentials: 'same-origin',
                body: data
            })
            .then(response => response.json())
            .then(data => {
                if( data.success == true ) {
                    if ( type === 'recommended_plugin' ) {
                        this.recommendedPlugins[name].installed = true;
                        this.recommendedPlugins[name].activated = true;
                    } else {
                        this.plugins[name].installed = true;
                        this.plugins[name].activated = true;
                    }
                    this.btnClicked = null;
                    this.btnName = null;
                    this.btnStatus = null;
                }
                return;
            });
        },
        buttonIcon: function() {
            if ( this.btnStatus == 'loading' ) {
                return this.icons.loaderSVG
            }
        },
        /**
         * Activate View
         *
         * @since 6.2.0
        */
         activateView : function(viewName, sourcePopupType = 'creation', ajaxAction = false){
            var self = this;
            self.viewsActive[viewName] = (self.viewsActive[viewName] == false ) ? true : false;
        },
        /**
         * Toggle Sticky Widget view
         * 
         * @since 4.0
         */
         toggleStickyWidget: function() {
            this.stickyWidget = !this.stickyWidget;
        },
		/**
		 * Loading Bar & Notification
		 *
		 * @since 6.2.0
		 */
		processNotification : function( notificationType ){
			var self = this,
				notification = self.genericText.notification[ notificationType ];
			self.loadingBar = false;
			self.notificationElement =  {
				type : notification.type,
				text : notification.text,
				shown : "shown"
			};
			setTimeout(function(){
				self.notificationElement.shown =  "hidden";
			}, 5000);
		},
    }
})