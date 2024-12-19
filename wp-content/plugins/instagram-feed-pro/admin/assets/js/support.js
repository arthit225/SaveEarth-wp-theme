var support_data = {
    genericText: sbi_support.genericText,
    articles: sbi_support.articles,
    system_info: sbi_support.system_info,
    system_info_n: sbi_support.system_info_n,
    exportFeed: 'none',
    stickyWidget: false,
    feeds: sbi_support.feeds,
    supportUrl: sbi_support.supportUrl,
    socialWallActivated: sbi_support.socialWallActivated,
    socialWallLinks: sbi_support.socialWallLinks,
    siteSearchUrl: sbi_support.siteSearchUrl,
    siteSearchUrlWithArgs: null,
    searchKeywords: null,
    buttons: sbi_support.buttons,
    links: sbi_support.links,
    supportPageUrl: sbi_support.supportPageUrl,
    systemInfoBtnStatus: 'collapsed',
    copyBtnStatus: null,
    ajax_handler: sbi_support.ajax_handler,
    nonce: sbi_support.nonce,
    icons: sbi_support.icons,
    images: sbi_support.images,
    svgIcons : sbi_support.svgIcons,
    sbiLicenseNoticeActive: (sbi_support.sbiLicenseNoticeActive === '1'),
    sbiLicenseInactiveState: (sbi_support.sbiLicenseInactiveState === '1'),
    licenseKey : sbi_support.licenseKey,
    recheckLicenseStatus: null,
    licenseBtnClicked : false,
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

var sbisupport = new Vue({
    el: "#sbi-support",
    http: {
        emulateJSON: true,
        emulateHTTP: true
    },
    data: support_data,
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
        copySystemInfo: function() {
            let self = this;
            const el = document.createElement('textarea');
			el.className = 'sbi-fb-cp-clpboard';
			el.value = self.system_info_n;
			document.body.appendChild(el);
			el.select();
			document.execCommand('copy');
			document.body.removeChild(el);
            this.notificationElement =  {
                type : 'success',
                text : this.genericText.copiedToClipboard,
                shown : "shown"
            };

            setTimeout(function() {
                this.notificationElement.shown =  "hidden";
            }.bind(self), 3000);
        },
        expandSystemInfo: function() {
            this.systemInfoBtnStatus = ( this.systemInfoBtnStatus == 'collapsed' ) ? 'expanded' : 'collapsed';
        },
        expandBtnText: function() {
            if ( this.systemInfoBtnStatus == 'collapsed' ) {
                return this.buttons.expand;
            } else if ( this.systemInfoBtnStatus == 'expanded' ) {
                return this.buttons.collapse;
            }
        },
        exportFeedSettings: function() {
            // return if no feed is selected
            if ( this.exportFeed === 'none' ) {
                return;
            }

            let url = this.ajax_handler + '?action=sbi_export_settings_json&nonce=' + this.nonce + '&feed_id=' + this.exportFeed;
            window.location = url;
        },
        searchDoc: function() {
            let self = this;
            let searchInput = document.getElementById('sbi-search-doc-input');
            searchInput.addEventListener('keyup', function ( event ) {
                let url = new URL( self.siteSearchUrl );
                let search_params = url.searchParams;
                if ( self.searchKeywords ) {
                    search_params.set('search', self.searchKeywords);
                }
                search_params.set('plugin', 'instagram');
                url.search = search_params.toString();
                self.siteSearchUrlWithArgs = url.toString();

                if ( event.key === 'Enter' ) {
                    window.open( self.siteSearchUrlWithArgs, '_blank');
                }
            })
        },
        searchDocStrings: function() {
            let self = this;
            let url = new URL( this.siteSearchUrl );
            let search_params = url.searchParams;
            setTimeout(function() {
                search_params.set('search', self.searchKeywords);
                search_params.set('plugin', 'instagram');
                url.search = search_params.toString();
                self.siteSearchUrlWithArgs = url.toString();
            }, 10);
        },
        goToSearchDocumentation: function() {
            if ( this.searchKeywords !== null && this.siteSearchUrlWithArgs !== null ) {
                window.open( this.siteSearchUrlWithArgs, '_blank');
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
            fetch(sbi_support.ajax_handler, {
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
        /**
         * Toggle Sticky Widget view
         *
         * @since 4.0
         */
         toggleStickyWidget: function() {
            this.stickyWidget = !this.stickyWidget;
        },
    },
})
