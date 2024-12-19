( function( $ ) {
	"use strict";
	var WidgetScrollNavHandler = function($scope, $) {
		var scroll_nav = $scope.find('.theplus-scroll-navigation');
		if(scroll_nav.length > 0 ){
			if(scroll_nav.data("pagescroll") =='yes'){
				scroll_nav.find(".theplus-scroll-navigation__item:eq(0)").addClass("highlight");
				$(".theplus-scroll-navigation__item").on('click',function(e){
					e.preventDefault();
					if(!$(this).hasClass("highlight")){
						var id=$(this).attr("href");
						var itemId = id.substring(1, id.length);						
						$(this).parent().find(".highlight").removeClass("highlight");
						$(this).addClass("highlight");
					}
				});
			}else{
				$(".theplus-scroll-navigation__item").mPageScroll2id({
					highlightSelector:".theplus-scroll-navigation__item",
					highlightClass:"highlight",
					forceSingleHighlight:true,
				});

				$(".theplus-scroll-navigation__item").on('click',function(e){
					e.preventDefault();
					var to=$(this).parent().parent("section").next().attr("id");
					$.mPageScroll2id("scrollTo",to);
				});
			}
		}
		var container = $scope.find('.theplus-scroll-navigation.scroll-view');
		var container_scroll_view = $scope.find('.theplus-scroll-navigation__inner');
		if(container.length > 0 && container_scroll_view){
			$(window).on('scroll', function() {
				var scroll = $(this).scrollTop();
				container.each(function () {
					var scroll_view_value = $(this).data("scroll-view");
					var uid=$(this).data("uid"),
						$scroll_top = $("."+uid );
					if (scroll > scroll_view_value) {
						$scroll_top.addClass('show');
					}else {
						$scroll_top.removeClass('show');
					}
					
				});
			});	
		}
	};
	$(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/tp-scroll-navigation.default', WidgetScrollNavHandler);
	});
})(jQuery);