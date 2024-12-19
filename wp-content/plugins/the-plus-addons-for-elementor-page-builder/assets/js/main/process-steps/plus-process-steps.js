(function($) {
	"use strict";
    var WidgetProcessStepsHandler = function($scope, $) {
        var container = $scope.find('.tp-process-steps-widget'),
            loop_item = container.find(".tp-process-steps-wrapper");

        if (container.hasClass('style_2')) {
            var w = $(window).innerWidth();
            if (w >= 768) {
				var total_item = loop_item.length;
				var divWidth = container.width();
				var margin = total_item * 20;

				var new_divWidth = divWidth - margin;
				var per_box_width = new_divWidth / total_item;
				loop_item.css('width', per_box_width);
					
                $(window).on('resize', function() {                    
                    var total_item = loop_item.length;
                    var divWidth = container.width();
                    var margin = total_item * 20;

                    new_divWidth = divWidth - margin;
                    per_box_width = new_divWidth / total_item;
                    loop_item.css('width', per_box_width);

                });
            }
        }
    };
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/tp-process-steps.default', WidgetProcessStepsHandler);
    });
})(jQuery);