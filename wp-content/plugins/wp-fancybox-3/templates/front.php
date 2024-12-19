<script type="text/javascript">
  try {
    jQuery(document).ready(function () {
      var e = jQuery('<?php echo $selector;?>');<?php
        $s = '{';
        $s .= 'loop: '.(! empty($options['loop']) ? 'true' : 'false').',';
        $s .= 'margin: ['.(! empty($options['margin']['v']) ? (float)$options['margin']['v'] : '44').','.(! empty($options['margin']['h']) ? (float)$options['margin']['h'] : '0').'],';
        $s .= ! empty($options['gutter']) ? 'gutter : '.(float)$options['gutter'].',' : '';
        $s .= 'keyboard: '.(! empty($options['keyboard']) ? 'true' : 'false').',';
        $s .= 'arrows: '.(! empty($options['arrows']) ? 'true' : 'false').',';
        $s .= 'infobar: '.(! empty($options['infobar']) ? 'true' : 'false').',';
        $s .= 'toolbar: '.(! empty($options['toolbar']) ? 'true' : 'false').',';

        $s .= 'buttons: [';
        $s .= ! empty($options['buttons']['slideShow']) ? "'slideShow'," : '';
        $s .= ! empty($options['buttons']['fullScreen']) ? "'fullScreen'," : '';
        $s .= ! empty($options['buttons']['share']) ? "'share'," : '';
        $s .= ! empty($options['buttons']['thumbs']) ? "'thumbs'," : '';
        $s .= ! empty($options['buttons']['close']) ? "'close'" : '';
        $s .= '],';

        $s .= ! empty($options['idleTime']) ? 'idleTime: '.(int)$options['idleTime'].',' : '';
        $s .= ! empty($options['smallBtn']) ? "smallBtn: '".esc_attr($options['smallBtn'])."'," : '';

        $s .= 'protect:'.(! empty($options['protect']) ? 'true' : 'false').',';
        $s .= 'modal:'.(! empty($options['modal']) ? 'true' : 'false').',';

        if ( ! empty($options['animationEffect'])) {
            $s .= "animationEffect: '".esc_attr($options['animationEffect'])."',";
        }

        $s .= ! empty($options['animationDuration']) ? 'animationDuration: '.(int)$options['animationDuration'].',' : '';

        if ( ! empty($options['zoomOpacity'])) {
            $s .= "zoomOpacity: '".esc_attr($options['zoomOpacity'])."',";
        }

        if ( ! empty($options['transitionEffect'])) {
            $s .= "transitionEffect: '".esc_attr($options['transitionEffect'])."',";
        }

        $s .= ! empty($options['transitionDuration']) ? 'transitionDuration: '.(int)$options['animationDuration'].',' : '';

        if ( ! empty($options['slideClass'])) {
            $s .= "slideClass: '".esc_attr($options['slideClass'])."',";
        }

        if ( ! empty($options['baseClass'])) {
            $s .= "baseClass: '".esc_attr($options['baseClass'])."',";
        }
        $s .= 'autoFocus: '.(! empty($options['autoFocus']) ? 'true' : 'false').',';
        $s .= 'backFocus: '.(! empty($options['backFocus']) ? 'true' : 'false').',';
        $s .= 'trapFocus: '.(! empty($options['trapFocus']) ? 'true' : 'false').',';
        $s .= 'fullScreen: { autoStart: '.(! empty($options['fullScreen']['autoStart']) ? 'true' : 'false').' },';
        $s .= 'touch: { vertical: '.(! empty($options['touch']['vertical']) ? 'true' : 'false').', momentum: '.(! empty($options['touch']['momentum']) ? 'true' : 'false').'},';
        $s .= 'slideShow: { autoStart: '.(! empty($options['slideShow']['autoStart']) ? 'true' : 'false').', speed: '.(! empty($options['slideShow']['speed']) ? (int)$options['slideShow']['speed'] : '400').'},';
        $s .= 'thumbs: { autoStart: '.(! empty($options['thumbs']['autoStart']) ? 'true' : 'false').', momentum: '.(! empty($options['thumbs']['hideOnClose']) ? 'true' : 'false').'},';
        $s .= 'clickContent: function(current, event) {return current.type === "image" ? "'.(! empty($options['clickContent']) ? esc_attr($options['clickContent']) : 'zoom').'" : false},';
        $s .= 'clickSlide: "'.(! empty($options['clickSlide']) ? esc_attr($options['clickSlide']) : 'close').'",';
        $s .= 'clickOutside: "'.(! empty($options['clickOutside']) ? esc_attr($options['clickOutside']) : 'close').'",';
        $s .= 'dblclickContent: "'.(! empty($options['dblclickContent']) ? esc_attr($options['dblclickContent']) : 'false').'",';
        $s .= 'dblclickSlide: "'.(! empty($options['dblclickSlide']) ? esc_attr($options['dblclickSlide']) : 'false').'",';
        $s .= 'dblclickOutside: "'.(! empty($options['dblclickOutside']) ? esc_attr($options['dblclickOutside']) : 'false').'",';
        $s .= 'mobile: {  preventCaptionOverlap: false, idleTime: false,';
        $s .= 'clickContent: function(current, event) { return current.type === "image" ? "'.(! empty($options['mobile']['clickContent']) ? esc_attr($options['mobile']['clickContent']) : 'toggleControls').'" : "close"},';
        $s .= 'clickSlide: function(current, event) { return current.type === "image" ? "'.(! empty($options['mobile']['clickSlide']) ? esc_attr($options['mobile']['clickSlide']) : 'toggleControls').'" : "close"},';
        $s .= 'dblclickContent: function(current, event) { return current.type === "image" ? "'.(! empty($options['mobile']['dblclickContent']) ? esc_attr($options['mobile']['dblclickContent']) : 'zoom').'" : false},';
        $s .= 'dblclickSlide: function(current, event) { return current.type === "image" ? "'.(! empty($options['mobile']['dblclickSlide']) ? esc_attr($options['mobile']['dblclickSlide']) : 'zoom').'" : false}';
        $s .= '},';
        $s .= "lang : 'default',
	i18n : {
		'default' : {
			CLOSE       : '".esc_attr(! empty($options['translation']['close']) ? $options['translation']['close'] : __('Close',
                'wpfancybox3'))."',
			NEXT        : '".esc_attr(! empty($options['translation']['next']) ? $options['translation']['next'] : __('Next',
                'wpfancybox3'))."',
			PREV        : '".esc_attr(! empty($options['translation']['prev']) ? $options['translation']['prev'] : __('Previous',
                'wpfancybox3'))."',
			ERROR       : '".esc_attr(! empty($options['translation']['error']) ? $options['translation']['error'] : __('The requested content cannot be loaded. Please try again later.',
                'wpfancybox3'))."',
			PLAY_START  : '".esc_attr(! empty($options['translation']['start']) ? $options['translation']['start'] : __('Start slideshow',
                'wpfancybox3'))."',
			PLAY_STOP   : '".esc_attr(! empty($options['translation']['pause']) ? $options['translation']['stop'] : __('Pause slideshow',
                'wpfancybox3'))."',
			FULL_SCREEN : '".esc_attr(! empty($options['translation']['full']) ? $options['translation']['full'] : __('Full screen',
                'wpfancybox3'))."',
			THUMBS      : '".esc_attr(! empty($options['translation']['thumbs']) ? $options['translation']['thumbs'] : __('Thumbnails',
                'wpfancybox3'))."',
		    SHARE       : '".esc_attr(! empty($options['translation']['share']) ? $options['translation']['share'] : __('Share',
                'wpfancybox3'))."',
		},
	}";

        if ( ! empty($options['customOptions'])) {
            $s .= ','.$options['customOptions'];
        }

        $s .= '}';
        $s = trim($s);

        echo ! empty($options['gallery']) ? " e.on('click', function() {jQuery.fancybox.open( e, {$s}, e.index( this ));
	return false;})" : "e.fancybox($s);";?>})
  } catch (e) {
    console.log('Error:' + e)
  }
</script>