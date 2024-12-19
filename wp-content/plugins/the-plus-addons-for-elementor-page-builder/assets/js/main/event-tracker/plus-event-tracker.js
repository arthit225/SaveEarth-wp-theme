/*event tracker*/
(function($) {
    "use strict";
    $(document).ready(function () {
        plus_event_tracker($);
    });
})( jQuery );
function plus_event_tracker($) {
    "use strict";
    function log(str='') {
        if(window.debug_track) {
            console.log('[Plus-Event-Tracker] - ' + str);
        }
    }
    function facebooktrack(type, event, source) {
        log("fbq('" + type + "', '" + event + "')");
        if(window.fbq && typeof(fbq) === 'function') {
            fbq(type, event);
        } else {
            console.error('Error : Facebook event, fbq is not defined');
        }
    }    
    function gtagtrack(eventname,eventcatagory,eventlabel, source) {
        log("gtag('event', '" + eventname + "','catagory','" + eventcatagory + "','label','" + eventlabel + "', {})");
        if(window.gtag && typeof(gtag) === 'function') {            
			gtag('event', eventname, { 'event_category': eventcatagory , 'event_label': eventlabel});			
        } else {
            console.error('Error : Gtag/GA event, gtag/ga is not defined');
        }
    }
	
    function gototrack(element, options) {
		if(options !=undefined){
			if(options['plus-track-fb-event']) {			
				var event = options['plus-fb-event'];			
				if(event === 'Custom') {
					var customevent = options['plus-fb-event-custom'];
					facebooktrack('trackCustom', customevent, element);				
				}else {
					facebooktrack('track', event, element);
				}			
			}
		  
			if(options['plus-track-gtag-event']) {
				var eventname = options['plus-gtag-event-name'];
				var eventcatagory = options['plus-gtag-event-catagory'];
				var eventlabel = options['plus-ga-label'];            
					gtagtrack(eventname,eventcatagory,eventlabel);            
			}
		}
    }
    function loadtracker(element,theplus_event_tracker) {      
		if($(element).find('a').length > 0)  {
			$(element).find('a').each(function () {
				$(this).on('click', function () {
					gototrack(this, theplus_event_tracker);
				});
			});
		}else {
            $(element).on('click:not(.wpcf7-submit):not(.everest-forms-submit-button):not(.wpforms-submit)', function () {
                gototrack(this, theplus_event_tracker);
            });
        }	
    }
    
    $('.theplus-event-tracker').each(function () {
        var theplus_event_tracker = $(this).data('theplus-event-tracker');
        loadtracker(this, theplus_event_tracker);
    });
	
	if($('.wpcf7-form .wpcf7-submit').length ){
		$('.wpcf7-form .wpcf7-submit').on('click', function(){
			var new_get_data = $(this).closest('.theplus-event-tracker').data('theplus-event-tracker');
			gototrack(this, new_get_data);
		});
	}
	
	if($('.caldera_forms_form .btn').length ){
		$('.caldera_forms_form .btn').on('click', function(){
			var new_get_data = $(this).closest('.theplus-event-tracker').data('theplus-event-tracker');
			gototrack(this, new_get_data);
		});
	}
	
	if($('.everest-form .everest-forms-submit-button').length ){
		$('.everest-form .everest-forms-submit-button').on('click', function(){
			var new_get_data = $(this).closest('.theplus-event-tracker').data('theplus-event-tracker');
			gototrack(this, new_get_data);
		});
	}
	
	if($('.wpforms-form .wpforms-submit').length ){
		$('.wpforms-form .wpforms-submit').on('click', function(){
			var new_get_data = $(this).closest('.theplus-event-tracker').data('theplus-event-tracker');
			gototrack(this, new_get_data);
		});
	}
	
	if($('.elementor-form .elementor-button').length ){
		$('.elementor-form .elementor-button').on('click', function(){
			var new_get_data = $(this).closest('.theplus-event-tracker').data('theplus-event-tracker');
			gototrack(this, new_get_data);
		});
	}
	
	if($('.elementor-widget-video .elementor-open-inline .elementor-custom-embed-image-overlay').length ){
		$('.elementor-widget-video .elementor-open-inline .elementor-custom-embed-image-overlay').on('click', function(){
			var new_get_data = $(this).closest('.theplus-event-tracker').data('theplus-event-tracker');
			gototrack(this, new_get_data);
		});
	}
	
	if($('.ts-video-wrapper .ts-video-play-btn').length ){
		$('.ts-video-wrapper .ts-video-play-btn').on('click', function(){
			var new_get_data = $(this).closest('.theplus-event-tracker').data('theplus-event-tracker');
			gototrack(this, new_get_data);
		});
	}
}