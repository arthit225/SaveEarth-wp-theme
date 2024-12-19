/*slick carousel*/
( function( $ ) {
	"use strict";
	var WidgetThePlusHandler = function ($scope, $) {
		var wid_sec = $scope.parents('section.elementor-element,.elementor-element.e-container,.elementor-element.e-con');
		if( wid_sec.find('.list-carousel-slick').length > 0){
			var carousel_elem = $scope.find('.list-carousel-slick').eq(0);
				if (carousel_elem.length > 0) {
					if(!carousel_elem.hasClass("done-carousel")){
						theplus_carousel_list();
					}
				}
		}
	};

	$(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/global', WidgetThePlusHandler);
	});
})(jQuery);

function theplus_carousel_list(data_widget=''){	
	var $ = jQuery;
	$('.list-carousel-slick').each(function() {
		var $self = $(this);			
		var $uid = $self.data("id");
		var slide_speed = $self.data("slide_speed");
		var default_active_slide = $self.data("default_active_slide");
		var slider_desktop_column = $self.data("slider_desktop_column");
		var steps_slide =$self.data("steps_slide");
		var slider_padding = $self.data("slider_padding");
		
		var slider_draggable = $self.data("slider_draggable");
		var slider_infinite = $self.data("slider_infinite");
		var slider_adaptive_height = $self.data("slider_adaptive_height");
		var slider_autoplay = $self.data("slider_autoplay");
		var autoplay_speed = $self.data("autoplay_speed");
		var slider_rows = $self.data("slider_rows");
					
		var slider_dots = $self.data("slider_dots");
		var slider_dots_style = $self.data("slider_dots_style");
		
		var slider_arrows=$self.data("slider_arrows");

        var data = $self[0].dataset;

        parsedData = data && data.result ? JSON.parse(data.result) : '';
        var getDIrection = parsedData.carousel_direction,
            rtlVal = false;

        if( 'rtl' === getDIrection ){
            rtlVal = true;
        }

		if( steps_slide == '1' ){
			steps_slide == '1';
		}else{
			steps_slide = slider_desktop_column;
		}	
		
		var prev_arrow = '<button type="button" class="slick-nav slick-prev style-2" aria-label="tp-previous-btn"><span class="icon-wrap"></span></button>';
		var next_arrow = '<button type="button" class="slick-nav slick-next style-2" aria-label="tp-next-btn"><span class="icon-wrap"></span></button>';
	
		if( default_active_slide == undefined ){
			default_active_slide = 0;
		}

		var args = {
			dots: slider_dots,
			vertical: false,
			fade:false,
			arrows: slider_arrows,
			infinite: slider_infinite,
			speed: slide_speed,
			initialSlide: default_active_slide,
			adaptiveHeight: slider_adaptive_height,
			autoplay: slider_autoplay,
			autoplaySpeed: autoplay_speed,
			pauseOnHover: false,
			centerMode: false,
			centerPadding: 0,
			prevArrow: prev_arrow,
			nextArrow: next_arrow,
			slidesToShow: 1,
			slidesToScroll: 1,
			draggable:slider_draggable,
			dotsClass:slider_dots_style,
            rtl: rtlVal,
            
		}

		if( !$(this).hasClass("done-carousel") ){
			$('> .post-inner-loop',this).slick(args);
				setTimeout(function(){
					$(".slick-dots.style-2 li").each(function(){
						if($(this).find("svg").length==0){
							$(this).append('<svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 16 16" preserveAspectRatio="none"><circle cx="8" cy="8" r="6.215"></circle></svg>');
						}
					});
				}, 1000);

			$(this).addClass("done-carousel");
		}	
	});
}