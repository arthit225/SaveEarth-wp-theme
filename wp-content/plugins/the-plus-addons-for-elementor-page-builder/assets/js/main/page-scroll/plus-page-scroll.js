/*Page Scroll*/(function(a) {
	'use strict';
	var b = function(a, b) {
        return this.init(a, b)
    };
	b.defaults = {
		licenseKey: '845A4AB1-B87A4168-BA7C13F1-54120148',
		navigationTooltips: !0,
		navigation: true,
		navigationPosition: 'right',		
		showActiveTooltip: true,
		slidesNavigation: true,
		controlArrows: true,
		easingcss3: 'cubic-bezier(.32,.18,.22,1)',
		scrollingSpeed: 850,
		keyboardScrolling: false,
		responsiveWidth: 900,		
    },	
	b.prototype = {
        init: function(a, b) {
			return a.data("tponePage") ? this : (this.el = a,
           this.setOptions(b).build(),
            this)
		},
		setOptions: function(c) {
            return this.el.data("__tsonePage", this),
            this.options = a.extend(!0, {}, b.defaults, c),
            this
        },
		 build: function() {
			var b = a(this.el),c = this.options;
			var uid = b.data('id');
			b.fullpage(a.extend(!0, {}, this.options, {
				onLeave: function(b, c) {
					var d = a(this);
					//paginate
					a('.fullpage-nav-paginate .slide-nav').removeClass("active animated");
					a('.fullpage-nav-paginate .slide-nav[data-slide='+parseInt(c.index)+']').addClass("active animated");
					
					//scroll nav
					var id=b.item;
					var ids=a(id).closest(".tp-page-scroll-wrapper").data("scroll-nav-id");
					if(ids!='' && ids!=undefined){
						a('#'+ids).find('.highlight').removeClass("highlight");
						a('#'+ids).find('a:eq(' + parseInt(c.index) + ')').addClass("highlight");
					}
				},
				afterLoad: function(origin, destination, direction){
					//Animation
					var tp_anim_cls = a("#"+uid).find('.fp-section:not(.active)');
					tp_anim_cls.find('.animate-general').removeClass('animation-done');
					tp_anim_cls.find('.animate-general').css('opacity','0');
					tp_anim_cls.find('.pt_plus_animated_image.bg-img-animated').removeClass('creative-animated');
					
					var tp_anim = a("#"+uid).find('.fp-section.active');
					a(tp_anim).find('.animate-general:not(.animation-done)').each(function() {
						var d;
						var b = a(this);
						var delay_time=b.data("animate-delay");
						d = b.data("animate-type");
						if(b.hasClass("animation-done")){
							b.hasClass("animation-done");
						}else{
							b.addClass("animation-done").velocity(d, {delay: delay_time,display:'auto'});
						}
					});
					
					/*load draw svg*/
					if(a(tp_anim).find(".pt_plus_animated_svg").length > 0){
						a('.pt_plus_animated_svg',tp_anim).pt_plus_animated_svg();
					}
					
					if(a(tp_anim).find('.pt_plus_animated_image.bg-img-animated').length > 0){
						a(tp_anim).find('.pt_plus_animated_image.bg-img-animated').each(function() {
							var b=a(this);
							if(b.hasClass("creative-animated")){
								b.hasClass("creative-animated");
								}else{
								b.addClass("creative-animated");
							}							
						});
					}
					if(a("#"+uid).find(".fp-section .elementor-widget[data-settings]").length > 0){
						tp_anim_cls.find(".elementor-widget.animated").each(function() {
							var t=a(this), b = a(this).data("settings");
							if(b!=undefined && b._animation){
								t.addClass("elementor-invisible").removeClass(b._animation +" animated");
							}
						});
						tp_anim_cls.find(".elementor-column.animated").each(function() {
							var t=a(this), b = a(this).data("settings");
							if(b!=undefined && b.animation){
								t.addClass("elementor-invisible").removeClass(b.animation +" animated");
							}
						});
						tp_anim.find(".elementor-widget:not(.animated)").each(function() {
							var t=a(this), b = a(this).data("settings");
							if(b!=undefined && b._animation && b._animation_delay){
								setTimeout(function(){
									t.removeClass("elementor-invisible").addClass(b._animation + ' animated');	
								}, b._animation_delay);								
							}else if(b!=undefined){
								t.removeClass("elementor-invisible").addClass(b._animation + ' animated');
							}
						});
						tp_anim.find(".elementor-column:not(.animated)").each(function() {
							var t=a(this), b = a(this).data("settings");
							if(b!=undefined && b.animation && b.animation_delay){
								setTimeout(function(){
									t.removeClass("elementor-invisible").addClass(b.animation + ' animated');	
								}, b.animation_delay);								
							}else if(b!=undefined){
								t.removeClass("elementor-invisible").addClass(b.animation + ' animated');
							}
						});
					}
				}
			})),
		  
			//Next Sections
			a('.fp-nav-btn.fp-nav-next').on('click', function(b) {
				b.preventDefault();
				a.fn.fullpage.moveSectionDown();
			});
			//Prev Sections
			a('.fp-nav-btn.fp-nav-prev').on('click', function(b) {
				b.preventDefault();
				a.fn.fullpage.moveSectionUp();
			});
		}
	}
	
	a.fn.PlusFullPage = function(c) {
        return this.map(function() {
            var d = a(this);            
            var e, f = d.data('full-page-opt');
            return f && (e = a.extend(!0, {}, c, f)),
            new b(d,e)
        })
    }
}
).apply(this, [jQuery]);

(function ($) {
	var WidgetPageScrollHandler = function($scope, $) {		
		var container=$scope.find('.tp-page-scroll-wrapper');
		var uid = container.data('id');	
	
		if($scope.find('.tp-page-scroll-wrapper.tp_full_page').length>0){
			$("#fp-nav").remove();
			if ( $( 'html' ).hasClass( 'fp-enabled' ) ) {
				$.fn.fullpage.destroy('all');
			}
			$('.tp-page-scroll-wrapper.tp_full_page').PlusFullPage();
			
		}
	};

	$(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/tp-page-scroll.default', WidgetPageScrollHandler);
	});
})(jQuery);