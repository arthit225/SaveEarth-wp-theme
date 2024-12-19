/*accordion*/( function( $ ) {
	"use strict";
	var WidgetAccordionHandler = function($scope, $) {

		var $plusadv_accordion = $scope.find('.theplus-accordion-wrapper');
		var $this =  $plusadv_accordion,
			$accordionID                = $this.attr('id'),
			$currentAccordion           = $('#'+$accordionID),
			$accordionType              = $this.data('accordion-type'),
			$accordionSpeed             = $this.data('toogle-speed'),
			$accrodionList              = $this.find('.theplus-accordion-item'),
			$PlusAccordionListHeader    = $accrodionList.find('.plus-accordion-header');
			
		
			$accrodionList.each(function(i) {
				if( $(this).find($PlusAccordionListHeader).hasClass('active-default') ) {
					$(this).find($PlusAccordionListHeader).addClass('active');
					$(this).find('.plus-accordion-content').addClass('active').css('display', 'block').slideDown($accordionSpeed);
					
					if($(this).next('.plus-accordion-content').find(" .list-carousel-slick > .post-inner-loop").length){
						$(this).next('.plus-accordion-content').find(" .list-carousel-slick > .post-inner-loop").slick('setPosition');
					}					
				}
			});
		
		if( 'accordion' == $accordionType ) {
			$PlusAccordionListHeader.on('click', function() {
				//Check if 'active' class is already exists
				if( $(this).hasClass('active') ) {
					$(this).removeClass('active');
					$(this).next('.plus-accordion-content').removeClass('active').slideUp($accordionSpeed);
				}else {
					$PlusAccordionListHeader.removeClass('active');
					$PlusAccordionListHeader.next('.plus-accordion-content').removeClass('active').slideUp($accordionSpeed);
			
					$(this).toggleClass('active');
					$(this).next('.plus-accordion-content').slideToggle($accordionSpeed, function() {
						$(this).toggleClass('active');
					});
					if($(this).next('.plus-accordion-content').find(" .list-carousel-slick > .post-inner-loop").length){
						$(this).next('.plus-accordion-content').find(" .list-carousel-slick > .post-inner-loop").slick('setPosition');
					}
					
				}
			});			
		}
		if( 'toggle' == $accordionType ) {
			$PlusAccordionListHeader.on('click', function() {
				if( $(this).hasClass('active') ) {
					$(this).removeClass('active');
					$(this).next('.plus-accordion-content').removeClass('active').slideUp($accordionSpeed);
				}else {
					$(this).toggleClass('active');
					$(this).next('.plus-accordion-content').slideToggle($accordionSpeed, function() {
						$(this).toggleClass('active');
					});
				}
			});
		}
		var hash = window.location.hash;
		if(hash!='' && hash!=undefined && !$(hash).hasClass("active") && $(hash).length){
			$('html, body').animate({
				scrollTop: $(hash).offset().top
			}, 1500);
			$(hash+".plus-accordion-header").trigger("click");
		}
		
	};
	$(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/tp-accordion.default', WidgetAccordionHandler);
	});
})(jQuery);