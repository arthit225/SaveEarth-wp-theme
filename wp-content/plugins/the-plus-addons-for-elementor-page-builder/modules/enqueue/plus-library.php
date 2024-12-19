<?php
if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

Class L_Plus_Library {
	/**
	 * A reference to an instance of this class.
	 *
	 * @since 1.0.0
	 * @var   object
	 */	
	private static $instance = null;

	// public $tmp_widget = true;
	
	public $l_registered_widgets;
    /**
     *  Return array of registered elements.
     *
     * @todo filter output
     */	 
    public function get_l_registered_widgets() {
        return array_keys($this->l_registered_widgets);
    }

    /**
     * Return saved settings
     *
     * @since 2.0
	 * 
	 * @version 5.5.4
     */
    public function get_plus_widget_settings($element = null) {
		$replace = [
			'tp_smooth_scroll' => 'tp-smooth-scroll',
			'tp_accordion' => 'tp-accordion',
			'tp_age_gate' => 'tp-age-gate',
			'tp_adv_text_block' => 'tp-adv-text-block',
			'tp_blockquote' => 'tp-blockquote',
			'tp_blog_listout' => 'tp-blog-listout',
			'tp_button' => 'tp-button',
			'tp_caldera_forms' => 'tp-caldera-forms',
			'tp_clients_listout' => 'tp-clients-listout',
			'tp_contact_form_7' => 'tp-contact-form-7',
			'tp_countdown' => 'tp-countdown',
			'tp_carousel_anything' => 'tp-carousel-anything',
			'tp_dark_mode' => 'tp-dark-mode',
			'tp_dynamic_categories' => 'tp-dynamic-categories',
			'tp_everest_form' => 'tp-everest-form',
			'tp_plus_form' => 'tp-plus-form',
			'tp_flip_box' => 'tp-flip-box',
			'tp_gallery_listout' => 'tp-gallery-listout',
			'tp_gravity_form' => 'tp-gravityt-form',			
			'tp_heading_animation' => 'tp-heading-animation',
			'tp_header_extras' => 'tp-header-extras',
			'tp_heading_title' => 'tp-heading-title',
			'tp_hovercard' => 'tp-hovercard',
			'tp_info_box' => 'tp-info-box',
			'tp_messagebox' => 'tp-messagebox',
			'tp_meeting_scheduler' => 'tp-meeting-scheduler',
			'tp_navigation_menu_lite' => 'tp-navigation-menu-lite',
			'tp_ninja_form' => 'tp-ninja-form',
			'tp_number_counter' => 'tp-number-counter',
			'tp_post_title' => 'tp-post-title',
			'tp_post_content' => 'tp-post-content',
			'tp_post_featured_image' => 'tp-post-featured-image',
			'tp_post_meta' => 'tp-post-meta',
			'tp_post_author' => 'tp-post-author',
			'tp_post_comment' => 'tp-post-comment',
			'tp_post_navigation' => 'tp-post-navigation',
			'tp_page_scroll' => 'tp-page-scroll',
			'tp_pricing_table' => 'tp-pricing-table',
			'tp_post_search' => 'tp-post-search',
			'tp_progress_bar' => 'tp-progress-bar',
			'tp_process_steps' => 'tp-process-steps',
			'tp_scroll_navigation' => 'tp-scroll-navigation',
			'tp_social_embed' => 'tp-social-embed',
			'tp_social_icon' => 'tp-social-icon',
			'tp_syntax_highlighter' => 'tp-syntax-highlighter',
			'tp_style_list' => 'tp-style-list',
			'tp_switcher' => 'tp-switcher',
			'tp_tabs_tours' => 'tp-tabs-tours',
			'tp_team_member_listout' => 'tp-team-member-listout',
			'tp_testimonial_listout' => 'tp-testimonial-listout',
			'tp_table' => 'tp-table',
			'tp_video_player' => 'tp-video-player',
			'tp_wp_forms' => 'tp-wp-forms',
        ];
		$merge = [
			'plus-backend-editor'
		];
		
		$elements=l_theplus_get_option('general','check_elements');
		if(empty($elements)){
			$elements = array_keys($replace);
		}
		$plus_extras=l_theplus_get_option('general','extras_elements');
		$elements = array_map(function ($val) use ($replace) {
		    return (array_key_exists($val, $replace) ? $replace[$val] : $val);
        }, $elements);
		

		if( ! empty( $elements ) ){
			$merge[] = 'plus-alignmnet-effect';
		}

		if ( in_array( 'tp-number-counter', $elements ) ) {
			$merge[] = 'tp-number-counter';
			$merge[] = 'tp-number-counter-style-1';
			$merge[] = 'tp-number-counter-style-2';
			$merge[] = 'tp-draw-svg';
		}

		if(in_array('tp-blog-listout',$elements)){
			$merge[] = 'plus-listing-masonry';
			$merge[] = 'plus-listing-metro';
			$merge[] = 'tp-blog-listout';
			$merge[] = 'tp-bloglistout-style-1';
		}

		if(in_array('tp-flip-box',$elements)){
			$merge[] = 'plus-responsive-visibility';
		}

		if(in_array('tp-info-box',$elements)){
			$merge[] = 'tp-info-box';
			$merge[] = 'tp-info-box-style_1';
			$merge[] = 'tp-info-box-style_3';
			$merge[] = 'tp-info-box-style_4';
			$merge[] = 'plus-responsive-visibility';
		}

		if(in_array('tp-messagebox',$elements)){
			$merge[] = 'tp-messagebox-js';
		}
		
		if ( in_array( 'tp-gallery-listout', $elements ) ) {
			$merge[] = 'plus-listing-masonry';
			$merge[] = 'plus-listing-metro';
			$merge[] = 'tp-gallery-listout';
			$merge[] = 'tp-gallery-listout-style-1';
			$merge[] = 'tp-gallery-listout-style-2';
		}

		if(in_array('tp-team-member-listout',$elements)){
			$merge[] = 'tp-team-member-listout';
			$merge[] = 'tp-team-member-listout-style-1';
			$merge[] = 'tp-team-member-listout-style-3';
			$merge[] = 'plus-listing-masonry';
		}

		if ( in_array( 'tp-testimonial-listout', $elements ) ) {
			$merge[] = 'tp-testimonial-listout';
			$merge[] = 'tp-testimonial-listout-style-1';
			$merge[] = 'tp-testimonial-listout-style-2';
			$merge[] = 'tp-testimonial-listout-style-3';
			$merge[] = 'tp-testimonial-listout-style-4';
			$merge[] = 'plus-listing-masonry';
			$merge[] = 'tp-arrows-style-2';
			$merge[] = 'tp-arrows-style';
			$merge[] = 'tp-carousel-style-1';
			$merge[] = 'tp-carousel-style';

			$merge[] = 'tp-carosual-extra';
			$merge[] = 'tp-bootstrap-grid';
		}

		if ( in_array( 'tp-page-scroll', $elements ) ) {
			$merge[] = 'tp-fullpage';
			$merge[] = 'tp-fullpage-scroll';
			$merge[] = 'plus-widget-error';
		}

		if(in_array('tp-process-steps',$elements)){
			$merge[] = 'tp-process-bg';
			$merge[] = 'tp-process-counter';
			$merge[] = 'tp-process-steps-js';
		}
		
		if(!empty($plus_extras) && in_array('section_scroll_animation',$plus_extras)){
			$merge[] ='plus-extras-section-skrollr';
		}
		if(!empty($plus_extras) && in_array('plus_equal_height',$plus_extras)){
			$merge[] ='plus-equal-height';
		}
		
		if(tp_has_lazyload()){
			$merge[] ='plus-lazyLoad';
		}

		if(in_array('tp-syntax-highlighter',$elements)){
			$merge[] = 'tp-syntax-highlighter';
			$merge[] = 'tp-syntax-highlighter-icons';
			$merge[] = 'prism_default';
			$merge[] = 'prism_coy';
			$merge[] = 'prism_dark';
			$merge[] = 'prism_funky';
			$merge[] = 'prism_okaidia';
			$merge[] = 'prism_solarizedlight';
			$merge[] = 'prism_tomorrownight';
			$merge[] = 'prism_twilight';
		}

		if ( in_array( 'tp-age-gate', $elements ) ) {
			$merge[] = 'tp-age-gate';
			$merge[] = 'tp-ag-method-1';
			$merge[] = 'tp-ag-method-2';
			$merge[] = 'tp-ag-method-3';
		}

		if(in_array('tp-blockquote',$elements) ){
			$merge[] = 'tp-blockquote';
			$merge[] = 'tp-bq-bl_1';
			$merge[] = 'tp-bq-bl_2';
			$merge[] = 'tp-bq-bl_3';
		}

		if(in_array('tp-countdown',$elements)){
			$merge[] = 'tp-countdown';
			$merge[] = 'tp-countdown-style-1';
			$merge[] = 'tp-countdown-style-2';
			$merge[] = 'tp-countdown-style-3';
		}

		if(in_array('tp-heading-title',$elements)){
			$merge[]= 'tp-heading-title';
			$merge[]= 'tp-heading-title-style_1';
			$merge[]= 'tp-heading-title-style_2';
			$merge[]= 'tp-heading-title-style_3';
			$merge[]= 'tp-heading-title-style_4';
			$merge[]= 'tp-heading-title-style_5';
			$merge[]= 'tp-heading-title-style_6';
			$merge[]= 'tp-heading-title-style_7';
			$merge[]= 'tp-heading-title-style_8';
			$merge[]= 'tp-heading-title-style_9';
			$merge[]= 'tp-heading-title-style_10';
			$merge[]= 'tp-heading-title-style_11';
		}

		if ( in_array( 'tp-progress-bar', $elements ) ) {
			$merge[]= 'tp-progress-bar';
			$merge[]= 'tp-piechart';
		}
		$tmp_widget = true;
		$tp_widget = ['tp-button', 'tp-flip-box', 'tp-info-box', 'tp-pricing-table', 'tp-blog-listout'];
		foreach ($tp_widget as $value) {
			if(!empty($tmp_widget) && in_array( $value ,$elements)){
				$merge[]= 'tp-button';
				$merge[]= 'tp-button-style-1';
				$merge[]= 'tp-button-style-2';
				$merge[]= 'tp-button-style-3';
				$merge[]= 'tp-button-style-4';
				$merge[]= 'tp-button-style-5';
				$merge[]= 'tp-button-style-6';
				$merge[]= 'tp-button-style-7';
				$merge[]= 'tp-button-style-8';
				$merge[]= 'tp-button-style-9';
				$merge[]= 'tp-button-style-10';
				$merge[]= 'tp-button-style-11';
				$merge[]= 'tp-button-style-12';
				$merge[]= 'tp-button-style-13';
				$merge[]= 'tp-button-style-14';
				$merge[]= 'tp-button-style-15';
				$merge[]= 'tp-button-style-16';
				$merge[]= 'tp-button-style-17';
				$merge[]= 'tp-button-style-18';
				$merge[]= 'tp-button-style-19';
				$merge[]= 'tp-button-style-20';
				$merge[]= 'tp-button-style-21';
				$merge[]= 'tp-button-style-22';
			    $merge[]= 'tp-button-style-24';
				$tmp_widget = false; 
			}
		}

		if(in_array('tp-social-icon',$elements)){
			$merge[] = 'tp-social-icon';
			$merge[] = 'tp-social-icon-style-1';
			$merge[] = 'tp-social-icon-style-2';
			$merge[] = 'tp-social-icon-style-3';
			$merge[] = 'tp-social-icon-style-4';
			$merge[] = 'tp-social-icon-style-5';
			$merge[] = 'tp-social-icon-style-6';
			$merge[] = 'tp-social-icon-style-7';
			$merge[] = 'tp-social-icon-style-8';
			$merge[] = 'tp-social-icon-style-9';
			$merge[] = 'tp-social-icon-style-10';
			$merge[] = 'tp-social-icon-style-11';
			$merge[] = 'tp-social-icon-style-12';
			$merge[] = 'tp-social-icon-style-13';
			$merge[] = 'tp-social-icon-style-14';
			$merge[] = 'tp-social-icon-style-15';
		}

		if ( in_array( 'tp-pricing-table', $elements ) ) {
			$merge[] = 'tp-pricing-table';
            $merge[] = 'tp-pricing-table-style-1';
            $merge[] = 'tp-pricing-ribbon';
		}

		if ( in_array( 'tp-scroll-navigation', $elements ) ) {
			$merge[] = 'tp-scroll-navigation';
			$merge[] = 'tp-scroll-navigation-style-1';
		}

		if ( in_array( 'tp-video-player', $elements ) ) {
			$merge[] = 'tp-lity-extra';
		}

		if ( in_array( 'tp-heading-animation', $elements ) ) {
			$merge[] = 'tp-heading-animation';
			$merge[] = 'tp-heading-animation-style-1';
			$merge[] = 'tp-heading-animation-style-2';
			$merge[] = 'tp-heading-animation-style-3';
			$merge[] = 'tp-heading-animation-style-4';
			$merge[] = 'tp-heading-animation-style-5';
			$merge[] = 'tp-heading-animation-style-6';
		}

		if( in_array('tp-dynamic-categories',$elements )){
			$merge[] = 'plus-listing-masonry';
			$merge[] = 'plus-listing-metro';
			$merge[] = 'tp-dynamic-categories';
			$merge[] = 'tp-dynamic-categories-style_1';
			$merge[] = 'tp-dynamic-categories-style_2';
			$merge[] = 'tp-dynamic-categories-style_3';
		}
		
		$result =array_unique($merge);
		$elements =array_merge($result , $elements);
        return (isset($element) ? (isset($elements[$element]) ? $elements[$element] : 0) : array_filter($elements));
    }

    /**
     * Remove files
     * @since 2.0
     */
    public function remove_files_unlink($post_type = null, $post_id = null, $extension = ['css', 'js'], $preload = false) {
		$filename = '';
		if(!empty($preload)){
			$filename = 'preload-';
		}
        $css_path_url = $this->secure_path_url(L_THEPLUS_ASSET_PATH . DIRECTORY_SEPARATOR . ($post_type ? 'theplus-'.$filename . $post_type : 'tpebl') . (isset($post_id) ? '-' . $post_id : '') . '.min.css');
        $js_path_url = $this->secure_path_url(L_THEPLUS_ASSET_PATH . DIRECTORY_SEPARATOR . ($post_type ? 'theplus-'.$filename . $post_type : 'tpebl') . (isset($post_id) ? '-' . $post_id : '') . '.min.js');

        if (file_exists($css_path_url) && in_array( 'css', $extension )) {
            wp_delete_file($css_path_url);
        }

        if (file_exists($js_path_url) && in_array( 'js', $extension )) {
            wp_delete_file($js_path_url);
        }
    }

    /**
     * Remove in directory files
     * @since 2.0
     */
    public function remove_dir_files($path_url) {
        if (!is_dir($path_url) || !file_exists($path_url)) {
            return;
        }

		if(get_option('tpae_backend_cache') === false){
			add_option('tpae_backend_cache', strtotime('now'),false);
		}else{
			update_option('tpae_backend_cache', strtotime('now'),false);
		}

        foreach (scandir($path_url) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }

            wp_delete_file($this->secure_path_url($path_url . DIRECTORY_SEPARATOR . $item));
        }
    }
	
	/**
     * Remove backend in directory files
     * @since 2.0.2
     */
    public function remove_backend_dir_files() {
		if (file_exists(L_THEPLUS_ASSET_PATH . '/theplus.min.css')) {
			wp_delete_file($this->secure_path_url(L_THEPLUS_ASSET_PATH . DIRECTORY_SEPARATOR . '/theplus.min.css'));
		}
		if(file_exists(L_THEPLUS_ASSET_PATH . '/theplus.min.js')){
			wp_delete_file($this->secure_path_url(L_THEPLUS_ASSET_PATH . DIRECTORY_SEPARATOR . '/theplus.min.js'));
		}
		
		$action_page = 'tpae_backend_cache';
		if ( FALSE === get_option($action_page) ){
			add_option( $action_page, time() );
		}else{
			update_option( $action_page, time() );
		}
    }
	
	/**
     * Remove current Page in directory files
     * @since 2.1.0
     */
    public function remove_current_page_dir_files( $path_url, $plus_name = '' ) {
	
		if ((!is_dir($path_url) || !file_exists($path_url)) && empty($plus_name)) {
            return;
        }
		
		if (file_exists($path_url . '/'. $plus_name. '.min.css')) {
			wp_delete_file($this->secure_path_url($path_url . DIRECTORY_SEPARATOR . '/'. $plus_name . '.min.css'));
		}
		if (file_exists($path_url . '/'. str_replace("theplus","theplus-preload",$plus_name). '.min.css')) {
			wp_delete_file($this->secure_path_url($path_url . DIRECTORY_SEPARATOR . '/'. str_replace("theplus","theplus-preload",$plus_name) .'.min.css'));
			array_map('unlink', glob($this->secure_path_url($path_url . DIRECTORY_SEPARATOR . '/'. str_replace("theplus","theplus-preload",$plus_name.'-') .'*.*')));
		}
		if(file_exists($path_url . '/'. $plus_name. '.min.js')){
			wp_delete_file($this->secure_path_url($path_url. DIRECTORY_SEPARATOR . '/'. $plus_name . '.min.js'));
		}

		delete_option($plus_name. '_update_at');
    }

    /**
     * Check if elementor preview mode or not 
	 * @since 2.0
     */
    public function is_preview_mode(){
        if (isset($_POST['doing_wp_cron'])) {
            return true;
        }
        if (wp_doing_ajax()) {
            return true;
        }
        if (isset($_GET['elementor-preview']) && (int)$_GET['elementor-preview']) {
            return true;
        }
        if (isset($_POST['action']) && $_POST['action'] == 'elementor') {
            return true;
        }

        return false;
    }

    /**
     * Generate secure path url
     * @since 2.0
     */
    public function secure_path_url($path_url) {
        $path_url = str_replace(['//', '\\\\'], ['/', '\\'], $path_url);

        return str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $path_url);
    }
	/**
	 * Returns the instance.
	 * @since  1.0.0
	 */
	public static function get_instance( $shortcodes = array() ) {
		
		if ( null == self::$instance ) {
			self::$instance = new self( $shortcodes );
		}
		return self::$instance;
	}
}
/**
 * Returns instance of L_Plus_Library
 */
function l_theplus_library() {
	return L_Plus_Library::get_instance();
}