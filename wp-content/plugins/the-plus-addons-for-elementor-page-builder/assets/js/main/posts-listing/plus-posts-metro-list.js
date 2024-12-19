//Metro Layout Load
(function($) {
    'use strict';
	$(document).ready(function() {
		//Filter Category Post
		$('.list-isotope-metro').each(function() {
			var c = $(this);
			var uid=c.data("id");
			var inner_c=$('.'+uid).find(".post-inner-loop");
			$('.'+uid+' .post-filter-data').find(".filter-category-list").on('click',function(event) {
				event.preventDefault();
				var d = $(this).attr("data-filter");
				$(this).parent().parent().find(".active").removeClass("active"),
				$(this).addClass("active"),
				inner_c.isotope({
					filter: d,
					visibleStyle: { opacity: 1 }
				}),
				$("body").trigger("isotope-sorted");
				
			});
		});
		if ($('.list-isotope-metro').length) {
			theplus_setup_packery_portfolio('all');
			$('.list-isotope-metro .post-inner-loop').isotope('layout').isotope("reloadItems");
		}
	});
	$(window).on("resize", function() {
		"use strict";
		if ($('.list-isotope-metro').length) {
			theplus_setup_packery_portfolio('all');	
			$('.list-isotope-metro .post-inner-loop').isotope('layout');
		}		
	});
})(jQuery);
function theplus_backend_packery_portfolio(uid,metro_column,metro_style) {
	'use strict';
		var setPad=0,$=jQuery;
		var myWindow=$(window);
		var container=$("#"+uid);		
		if (metro_column == '3') {
			var	norm_size = Math.floor((container.width() - setPad*2)/3),
			double_size = norm_size*2;				
			container.find('.grid-item').each(function(){
				var set_w = norm_size,
				set_h = norm_size;
				
				if(metro_style=='style-1'){
					if ($(this).hasClass('metro-item1') || $(this).hasClass('metro-item7')) {
						set_w = double_size,
						set_h = double_size;
					}
					if ($(this).hasClass('metro-item4') || $(this).hasClass('metro-item9')) {
						set_w = double_size,
						set_h = norm_size;
					}
				}
				if (myWindow.width() < 760) {
					set_w = myWindow.width() - setPad*2;
					set_h = myWindow.width() - setPad*2;
				}	
				$(this).css({
					'width' : set_w+'px',
					'height' : set_h+'px'
				});
			});
		}
			if (myWindow.innerWidth() > 767) {
				$("#"+uid).isotope({
					itemSelector: '.grid-item',
					layoutMode: 'masonry',
					masonry: {
						columnWidth: norm_size
					}
				});
			}else{
				$("#"+uid).isotope({
					layoutMode: 'masonry',
					masonry: {
						columnWidth: '.grid-item'
					}
				});
			}
		$("#"+uid).isotope('layout').isotope('layout').isotope( 'reloadItems' );
		
		$("#"+uid).imagesLoaded( function(){		
			$("#"+uid).isotope('layout').isotope( 'reloadItems' );		
		});
}
function theplus_setup_packery_portfolio(packery_id) {
	'use strict';
	var $=jQuery;
	$('.list-isotope-metro').each(function(){
		var uid=$(this).data("id");
		var metro_column=$(this).attr('data-metro-columns');
		var tablet_metro_column=$(this).attr('data-tablet-metro-columns');
		var setPad = 0;
		var myWindow=$(window);
		var responsive_width=window.innerWidth;
		if(responsive_width <= 1024 && tablet_metro_column!=undefined){
			metro_column=tablet_metro_column;
		}		
		if (metro_column == '3') {
			var metro_style=$(this).attr('data-metro-style');
			if(responsive_width <= 1024 && tablet_metro_column!=undefined){
				metro_style=$(this).attr('data-tablet-metro-style');
			}
			var	norm_size = Math.floor(($(this).width() - setPad*2)/3),
			double_size = norm_size*2;				
			$(this).find('.grid-item').each(function(){
				var set_w = norm_size,
				set_h = norm_size;
				
				if(metro_style=='style-1'){
					if ($(this).hasClass('metro-item1') || $(this).hasClass('metro-item7')) {
						set_w = double_size,
						set_h = double_size;
					}
					if ($(this).hasClass('metro-item4') || $(this).hasClass('metro-item9')) {
						set_w = double_size,
						set_h = norm_size;
					}
				}
				if (myWindow.width() < 760) {
					set_w = myWindow.width() - setPad*2;
					set_h = myWindow.width() - setPad*2;
				}	
				$(this).css({
					'width' : set_w+'px',
					'height' : set_h+'px'
				});
			});
		}
		
		if($(this).hasClass('list-isotope-metro')){
			if (myWindow.innerWidth() > 767) {
				$("#"+uid).isotope({
					itemSelector: '.grid-item',
					layoutMode: 'masonry',
					masonry: {
						columnWidth: norm_size
					}
				});
			}else{
				$("#"+uid).isotope({
					layoutMode: 'masonry',
					masonry: {
						columnWidth: '.grid-item'
					}
				});
			}
		}else{
			$("#"+uid).isotope({
				layoutMode: 'masonry',
				masonry: {
					columnWidth: norm_size
				}
			});
		}
		$("#"+uid).isotope('layout');
		
		$("#"+uid).imagesLoaded( function(){
			$("#"+uid).isotope('layout').isotope( 'reloadItems' );		
		});
				
	});
}