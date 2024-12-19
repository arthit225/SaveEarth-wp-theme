<?php
if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

Class L_Plus_Generator {
	/**
	 * A reference to an instance of this class.
	 *
	 * @since 1.0.0
	 * @var   object
	 */
	private static $instance = null;
	
	public $transient_widgets;
	public $l_registered_widgets;
    
	public $tpae_cache = null;
	public $plus_uid = null;
	public $requires_update;

	private static $tpae_post_type = '';
	private static $tpae_post_id = '';
	public $post_assets_object = array();
	public $post_assets_objects = array();

	public $tp_first_load = true;

	public $transient_extensions = array();
	
	public function get_caching_option(){
		if($this->tpae_cache != null ){
			return $this->tpae_cache;
		}
		$theplus_options=get_option( 'theplus_performance' );
		$cacheOpt = (!empty($theplus_options['plus_cache_option'])) ? $theplus_options['plus_cache_option'] : '';
		
		if($cacheOpt=='separate'){
			$this->tpae_cache = true;
			return true;
		}else{
			$this->tpae_cache = false;
			return false;
		}
	}
	
    /**
     * Merge all Files Load
     *
     * @since 2.0
     */
    public function plus_merge_files($paths = array(), $file = 'theplus-style.min.css',$type='') {
        $output = '';

        if (!empty($paths)) {
            foreach ($paths as $path) {
                if ( file_exists( l_theplus_library()->secure_path_url($path) ) ) {
                	$output .= file_get_contents(l_theplus_library()->secure_path_url($path));
				}
            }
        }
		if(!empty($type) && $type=='css'){			
			// Remove comments
			$output = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $output);
			// Remove space after colons
			$output = str_replace(': ', ':', $output);
			// Remove whitespace
			$output = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $output);
			//Remove Last Semi colons
			$output = preg_replace('/;}/', '}', $output);
		}
		if(!empty($output)){
			return file_put_contents(l_theplus_library()->secure_path_url(L_THEPLUS_ASSET_PATH . DIRECTORY_SEPARATOR . $file), $output);
		}

		return false;
        
    }

    /**
     * Generate scripts and minify.
     *
     * @since 2.0
     */
    public function plus_generate_scripts($elements, $file_name = null, $extension = ['css', 'js'], $common = true) {
		
        if (empty($elements)) {
            return;
        }
		
        if (!file_exists(L_THEPLUS_ASSET_PATH)) {
            wp_mkdir_p(L_THEPLUS_ASSET_PATH);
        }

        // default load js and css
        $js_url = array();

		if($common === false){
			$css_url = array();
		}else{
			$css_url = array(
				L_THEPLUS_PATH . DIRECTORY_SEPARATOR . "assets/css/main/plus-extra-adv/plus-extra-adv.min.css",
			);
		}

        // merge files widgets
		if( in_array('js', $extension) ){
			$js_url = array_merge($js_url, $this->plus_dependency_widgets($elements, 'js'));
			if(!empty($js_url)){
				$this->plus_merge_files($js_url, ($file_name ? $file_name : 'theplus') . '.min.js','js');
			}
		}
		if( in_array('css', $extension) ){
			$css_url = array_merge($css_url, $this->plus_dependency_widgets($elements, 'css'));
			if(!empty($css_url)){
				$this->plus_merge_files($css_url, ($file_name ? $file_name : 'theplus') . '.min.css','css');
			}
		}
    }

	 /**
     * Generate Separate scripts and style.
     *
     * @since 5.0.1
     */
    public function plus_load_separate_file($elements, $file_name = null) {
		
        if (empty($elements)) {
            return;
        }
		
        // default load js and css
        $js_url = array();

        $css_url = array(
			L_THEPLUS_PATH . DIRECTORY_SEPARATOR . "assets/css/main/plus-extra-adv/plus-extra-adv.min.css",
        );

        // collect library scripts & styles
        $js_url = array_merge($js_url, $this->plus_dependency_widgets($elements, 'js'));
        $css_url = array_merge($css_url, $this->plus_dependency_widgets($elements, 'css'));
		
		return ['css' => $css_url, 'js' => $js_url ];
    }

    /**
     * Check if cache files exists
     *
     * @since 2.0
     */
    public function check_cache_files($post_type = null, $post_id = null) {
        $css_url = L_THEPLUS_ASSET_PATH . DIRECTORY_SEPARATOR . ($post_type ? 'theplus-' . $post_type : 'theplus') . (isset($post_id) ? '-' . $post_id : '') . '.min.css';
        $js_url = L_THEPLUS_ASSET_PATH . DIRECTORY_SEPARATOR . ($post_type ? 'theplus-' . $post_type : 'theplus') . (isset($post_id) ? '-' . $post_id : '') . '.min.js';

        if (is_readable(l_theplus_library()->secure_path_url($css_url)) && is_readable(l_theplus_library()->secure_path_url($js_url))) {
			return true;
        }
        return false;
    }

	public function check_css_js_cache_files($post_type = null, $post_id = null, $type = 'css', $preload = false) {
		if( empty( $type) ){
			return false;
		}
		$filename = '';
		if(!empty($preload)){
			$filename = 'preload-';
		}
		if($type == 'css'){
			$css_url = L_THEPLUS_ASSET_PATH . DIRECTORY_SEPARATOR . ($post_type ? 'theplus-'.$filename . $post_type : 'theplus') . (isset($post_id) ? '-' . $post_id : '') . '.min.css';
			if ( is_readable(l_theplus_library()->secure_path_url($css_url)) ) {
				return true;
			}
		}else if($type == 'js'){
			$js_url = L_THEPLUS_ASSET_PATH . DIRECTORY_SEPARATOR . ($post_type ? 'theplus-'.$filename . $post_type : 'theplus') . (isset($post_id) ? '-' . $post_id : '') . '.min.js';
			if ( is_readable(l_theplus_library()->secure_path_url($js_url)) ) {
				return true;
			}
		}
		return false;
	}

	/**
     * Widgets dependency for modules
     *
     * @since 2.0
     */
    public function plus_dependency_widgets(array $elements, $type) {
        $paths = [];
		if(has_filter('theplus_pro_registered_widgets')) {
			$this->l_registered_widgets = apply_filters('theplus_pro_registered_widgets', $this->l_registered_widgets );
		}
        foreach ($elements as $element) {
            if (isset($this->l_registered_widgets[$element])) {
                if (!empty($this->l_registered_widgets[$element]['dependency'][$type])) {
                    foreach ($this->l_registered_widgets[$element]['dependency'][$type] as $path) {
                        $paths[] = $path;
                    }
                }
            } elseif (isset($this->registered_extensions[$element])) {
                if (!empty($this->registered_extensions[$element]['dependency'][$type])) {
                    foreach ($this->registered_extensions[$element]['dependency'][$type] as $path) {
                        $paths[] = $path;
                    }
                }
            }
        }

        return array_unique($paths);
    }

	/**
	 * Update PostMeta / TermMeta Value
	 * 
	 * @since 3.2.1
	 * @version 5.5.0
	 * 
	 **/
	public function update_posts_metadata( $post_id = '', $meta_key = '', $update_key= '', $val = '', $save = '' ){
		if( $post_id != '' ){
			$old_value = [];
			if(is_404() || is_search() || $post_id===0 || !is_numeric($post_id)){
				$old_value = get_option( 'theplus-term-'.$post_id.'-widgets' );
			}else if(self::$tpae_post_type === 'term' && is_numeric($post_id)){
				$old_value = get_term_meta( $post_id, $meta_key, true );
			}else if(is_numeric($post_id)){
				$old_value = get_post_meta( $post_id, $meta_key, true );
			}
			
			if( !empty($old_value) && is_array($old_value) ){
				$old_value[ $update_key ] = $val;
			}else if(!empty($old_value) && !is_array($old_value)){
				$old_value = [];
				$old_value[ $update_key ] = $val;
			}else if(empty($old_value)){
				$old_value = [];
				$old_value[ $update_key ] = $val;
			}

			if( !empty( $save ) ){
                $old_value['update_at'] = get_option('tp_save_update_at');
            }

			if(is_404() || is_search() || $post_id===0 || !is_numeric($post_id)){
				update_option( 'theplus-term-'.$post_id.'-widgets', $old_value );
			}else if(self::$tpae_post_type === 'term' && is_numeric($post_id)){
				update_term_meta( $post_id, $meta_key, $old_value );
			}else if(is_numeric($post_id)){
				update_post_meta( $post_id, $meta_key, $old_value );
			}

		}
	}

	public function get_posts_metadata($post_id = '', $meta_key = '', $get_key_val= '', $old_key = ''){
		$value = '';
		if( $post_id != '' ){
			$old_value = '';
			if(is_404() || is_search() || $post_id===0 || !is_numeric($post_id)){
				$old_value = get_option( 'theplus-term-'.$post_id.'-widgets' );
			}else if(self::$tpae_post_type === 'term' && is_numeric($post_id)){
				$old_value = get_term_meta( $post_id, $meta_key, true );
			}else if(is_numeric($post_id)){
				$old_value = get_post_meta( $post_id, $meta_key, true );
			}

			if( !empty($old_value) && is_array($old_value) && isset($old_value[ $get_key_val ]) ){
				$value = $old_value[ $get_key_val ];
			}else if(!empty($old_value) && !is_array($old_value)){
				$value = $old_value;
			}
		}
		
		//old options key remove
		if(empty($value) && !empty($old_key)){
			$old_key_value = get_option( $old_key );
			if(!empty($old_key_value) && !is_404() && !is_search()){
				$this->update_posts_metadata($post_id, $meta_key, $get_key_val, $old_key_value );
				delete_option( $old_key );
			}
		}

		return $value;
	}

	public function get_post_version( $post_id = '' ){
		$version = L_THEPLUS_VERSION;
		
		if( $post_id != '' ){
			
			$version = get_post_meta( $post_id, '_elementor_css', true );
			if(!empty($version) && !empty($version['time'])){
				return $version['time'];
			}else{
				$updated_at = $this->get_posts_metadata( $post_id, 'tp_widgets', 'update_at');
				if(!empty($updated_at)){
					return $updated_at;
				}else if( empty($updated_at) ){
					$vtime = get_option('tp_save_update_at');
					if(!empty($vtime)){
						$this->update_posts_metadata( self::$tpae_post_id, 'tp_widgets', 'update_at', $vtime);
						return $vtime;
					}
				}
			}
		}
		
		return $version;
	}

	public function remove_post_metadata($post_id = '', $meta_key = '', $get_key_val= '', $old_key = ''){
		if(!empty($old_key)){
			$value = get_option( $old_key );
			if(!empty($value)){
				delete_option( $old_key );
			}
		}
		if( !empty($post_id) ){
			$value = get_post_meta( $post_id, $meta_key, true );
			if( !empty($value) && isset($value[ $get_key_val ]) ){
				unset($value[ $get_key_val ]);
				update_post_meta( $post_id, $meta_key, $value );
			}
		}else if( $post_id === 0 || !is_numeric($post_id)){
			$value = get_option( 'theplus-term-'.$post_id.'-widgets' );
			if( !empty($value) && isset($value[ $get_key_val ]) ){
				unset($value[ $get_key_val ]);
				update_option( 'theplus-term-'.$post_id.'-widgets', $value );
			}
		}
	}

    /**
     * Generate single post scripts
     *
     * @since 2.0
	 * @version 5.5.0
	 * 
     */
    public function generate_scripts_frontend() {
		
		if ($this->check_generate_script() === false) {
            return;
        }

        $replace = [
            'plus-woocommerce' => 'product-plus',
        ];

		if(has_filter('tp_pro_transient_widgets')) {
			$this->transient_widgets = apply_filters('tp_pro_transient_widgets', $this->transient_widgets);
		}
	
        $elements = array_map(function ($val) use ($replace) {
			$val = str_replace(['theplus-'], [''], $val);
		    return (array_key_exists($val, $replace) ? $replace[$val] : $val);
        }, $this->transient_widgets);
		
		if(has_filter('theplus_pro_registered_widgets')) {
			$this->l_registered_widgets = apply_filters('theplus_pro_registered_widgets', $this->l_registered_widgets );
		}
		
        $elements = array_intersect(array_keys($this->l_registered_widgets), $elements);
		
        $extensions = apply_filters('theplus/section/after_render', $this->transient_extensions);

        $elements = array_unique(array_merge($elements, $extensions));
		
		sort($elements);
		
		if($this->get_post_type_post_id()){

			$this->update_posts_metadata( self::$tpae_post_id, 'tp_widgets', 'widgets', $elements, true);
			if(!empty(self::$tpae_post_type) && self::$tpae_post_type == 'post'){
				$this->update_posts_metadata( self::$tpae_post_id, '_elementor_css', 'time', time());
			}
			
			l_theplus_library()->remove_files_unlink(self::$tpae_post_type, self::$tpae_post_id);
			
            // if no cache files, generate new
            if (!$this->check_cache_files(self::$tpae_post_type, self::$tpae_post_id) && !$this->get_caching_option()) {
                $this->plus_generate_scripts($elements, 'theplus-' . self::$tpae_post_type . '-' . self::$tpae_post_id);
            }

			if( $this->requires_update && $this->get_caching_option() === false && $this->check_css_js_cache_files(self::$tpae_post_type, self::$tpae_post_id, 'js') ){
				$plus_version = $this->get_post_version(self::$tpae_post_id);
				
				$js_file = L_THEPLUS_ASSET_URL . '/theplus-' . self::$tpae_post_type . '-' . self::$tpae_post_id . '.min.js';
				if( $this->check_css_js_cache_files(self::$tpae_post_type, self::$tpae_post_id, 'js') ){
					wp_enqueue_script('theplus-front-js', $this->pathurl_security($js_file), ['jquery'], $plus_version, true);
				}
			}
			
        }
    }
	
	public function load_inline_script(){
		$js_inline1 = 'var theplus_ajax_url = "'.admin_url("admin-ajax.php").'";
		var theplus_ajax_post_url = "'.admin_url("admin-post.php").'";
		var theplus_nonce = "'.wp_create_nonce("theplus-addons").'";';
		echo wp_print_inline_script_tag($js_inline1);	
	}

	//Plus Addons Scripts
	public function plus_enqueue_scripts() {
	
		if ( is_admin_bar_showing() && !$this->get_caching_option()) {
			wp_enqueue_script(
				'plus-purge-js',
				$this->pathurl_security(L_THEPLUS_URL . '/assets/js/main/general/theplus-purge.js'),
				['jquery'],
				L_THEPLUS_VERSION,
				true
			);
		}
		
		if (l_theplus_library()->is_preview_mode()) {
			
			// generate fallback scripts			
			if (!$this->check_cache_files()) {
				$plus_widget_settings = l_theplus_library()->get_plus_widget_settings();
				if(has_filter('plus_widget_setting')) {
					$plus_widget_settings = apply_filters('plus_widget_setting', $plus_widget_settings);
				}
				$this->plus_generate_scripts($plus_widget_settings);
			}

			// enqueue scripts
			if ($this->check_cache_files()) {
				$css_file = L_THEPLUS_ASSET_URL . '/theplus.min.css';
				$js_file = L_THEPLUS_ASSET_URL . '/theplus.min.js';
			} else {
				$tp_url = L_THEPLUS_URL;
				if(defined('THEPLUS_VERSION')){
					$tp_url = THEPLUS_URL;
				}
				$css_file = $tp_url . '/assets/css/main/general/theplus.min.css';
				$js_file = $tp_url . '/assets/js/main/general/theplus.min.js';
			}

			$tpae_backend_cache = get_option( 'tpae_backend_cache');
			if( FALSE === $tpae_backend_cache ){
				update_option( 'tpae_backend_cache', time() );
			}
			wp_enqueue_style(
				'plus-editor-css',
				$this->pathurl_security($css_file),
				false,
				$tpae_backend_cache
			);

			wp_enqueue_script(
				'plus-editor-js',
				$this->pathurl_security($js_file),
				['jquery'],
				$tpae_backend_cache,
				true
			);
			
			$this->load_inline_script();
			// hook extended assets
			do_action('theplus/after_enqueue_scripts', $this->check_cache_files());

		} else {
			if ( $this->get_post_type_post_id() ) {
				$uid = 'theplus-' . self::$tpae_post_type . '-' . self::$tpae_post_id;
				$this->enqueue_frontend_load(self::$tpae_post_type, self::$tpae_post_id);
			}
		}
	}

	// rules how css will be enqueued on front-end
	protected function enqueue_frontend_load($post_type, $queried_obj){
		
		if(!l_theplus_library()->is_preview_mode()){

			if ( $this->get_post_type_post_id() ) {
			
				$elements = [];
				if (!$this->requires_update) {
					$elements = $this->get_posts_metadata($queried_obj, 'tp_widgets', 'widgets', $this->plus_uid . 'tp_widgets');
					if($this->get_caching_option()){
						l_theplus_library()->remove_files_unlink($post_type, $queried_obj);
					}else{
						if (!$this->check_css_js_cache_files($post_type, $queried_obj,'css') && !$this->check_css_js_cache_files($post_type, $queried_obj,'js') && !empty($elements)) {
							$this->plus_generate_scripts($elements, 'theplus-' . $post_type . '-' . $queried_obj);
						}
					}
					// if no widget in page, return
					if (empty($elements)) {
						return;
					}else if(!empty($elements)){
						$this->enqueue_css_js( $elements, false );
					}
				}

			}

		}
	
	}
	
	/**
	 * Load enqueue Css and Js
	 * @since new_version
	 * @version 5.5.0
	 */
	public function enqueue_css_js( $elements = [], $in_footer = false, $load_depend = ['jquery'] ) {

		$tp_url = L_THEPLUS_URL;
		$tp_path = L_THEPLUS_PATH . DIRECTORY_SEPARATOR;
		
		$plus_version = $this->get_post_version( self::$tpae_post_id );
		
		wp_enqueue_script( 'jquery-ui-slider' ); //Audio Player

		$load_localize ='jquery';

		//Separate File Caching
		if($this->get_caching_option() && !empty($elements) && $in_footer == false ){
			$separate_path = $this->plus_load_separate_file($elements);
			if(isset($separate_path['css']) && !empty($separate_path['css'])){
				$iji = 1;
				foreach( $separate_path['css'] as $key => $path ){
					if(is_readable(l_theplus_library()->secure_path_url($path))){
						$css_sep_url = str_replace( $tp_path, $tp_url, $path);
						if(defined('THEPLUS_VERSION') && defined('THEPLUS_URL')){
							$css_sep_url = str_replace( THEPLUS_PATH . DIRECTORY_SEPARATOR, THEPLUS_URL, $css_sep_url);
						}
						$css_file_key = basename($css_sep_url, ".css");
						$css_file_key = basename($css_file_key, ".min");
						$lastFolder = basename(dirname($css_sep_url));
						$enq_name = 'theplus-'.$css_file_key.'-'.$lastFolder;
						
						wp_enqueue_style( $enq_name , $this->pathurl_security($css_sep_url), false, $plus_version);
						$iji++;
					}
				}
			}
			if(isset($separate_path['js']) && !empty($separate_path['js'])){
				$iji = 0;
				foreach( $separate_path['js'] as $key => $path ){
					if(is_readable(l_theplus_library()->secure_path_url($path))){
						$js_sep_url = str_replace( $tp_path, $tp_url, $path );
						if(defined('THEPLUS_VERSION') && defined('THEPLUS_URL')){
							$js_sep_url = str_replace( THEPLUS_PATH . DIRECTORY_SEPARATOR, THEPLUS_URL, $js_sep_url);
						}
						$js_file_key = basename($js_sep_url, ".js");
						$js_file_key = basename($js_file_key, ".min");
						if($iji === 0){
							$load_localize = 'theplus-'.$js_file_key;
						}
						wp_enqueue_script('theplus-'.$js_file_key,$this->pathurl_security($js_sep_url), $load_depend, $plus_version, true);
						$iji++;
					}
				}
			}
		}else if($this->get_caching_option() == false){
			if ( $this->check_css_js_cache_files( self::$tpae_post_type, self::$tpae_post_id, 'css' ) && $in_footer == false ) {
				$css_file = L_THEPLUS_ASSET_URL . '/theplus-' . self::$tpae_post_type . '-' . self::$tpae_post_id . '.min.css';
				wp_enqueue_style('theplus-front-css',$this->pathurl_security($css_file), false, $plus_version );
			}

			$load_localize = 'tpgb-purge-js';
			if( $this->check_css_js_cache_files(self::$tpae_post_type, self::$tpae_post_id, 'js') ){
				$js_file = L_THEPLUS_ASSET_URL . '/theplus-' . self::$tpae_post_type . '-' . self::$tpae_post_id . '.min.js';

				wp_enqueue_script('theplus-front-js', $this->pathurl_security($js_file), ['jquery'], $plus_version, true);
				$load_localize = 'theplus-front-js';
			}
		}

		$this->load_inline_script();
		
		// hook extended assets
		do_action('theplus/after_enqueue_scripts', $this->check_cache_files(self::$tpae_post_type, self::$tpae_post_id));
	}

    /**
     * Clear cache files
     *
     * @since 2.0
     */
    public function theplus_smart_perf_clear_cache() {
		check_ajax_referer('theplus-addons', 'security');

        // clear cache files
		l_theplus_library()->remove_dir_files(L_THEPLUS_ASSET_PATH);
		update_option('tp_save_update_at', strtotime('now'), false);
		wp_send_json(true);
    }
	
	/**
     * Clear cache files
     *
     * @since 2.0.2
     */
    public function theplus_backend_clear_cache() {
		check_ajax_referer('theplus-addons', 'security');

        // clear cache files
		l_theplus_library()->remove_backend_dir_files();

		wp_send_json(true);
    }
	
	/**
     * Current Page Clear cache files
     *
     * @since 2.0.2
     */
    public function theplus_current_page_clear_cache() {
		check_ajax_referer('theplus-addons', 'security');
		
		$plus_name='';
		if(isset($_POST['plus_name']) && !empty($_POST['plus_name'])){
			$plus_name = sanitize_text_field($_POST['plus_name']);
		}
		if($plus_name== 'theplus-all') {
			// All clear cache files
			l_theplus_library()->remove_dir_files(L_THEPLUS_ASSET_PATH);
			update_option('tp_save_update_at', strtotime('now'), false);
		} else {
			// Current Page cache files
			l_theplus_library()->remove_current_page_dir_files( L_THEPLUS_ASSET_PATH, $plus_name );
		}
		wp_send_json(true);
    }

	/**
	 * Version Vise Clear Cache
	 * @since 5.4.0
	 */
	public function tp_version_clear_cache() {
		$option_name = 'tpae_version_cache';
		$get_version = get_option( $option_name );
		$versions = [ L_THEPLUS_VERSION ];

		if($get_version === false){
			l_theplus_library()->remove_dir_files(L_THEPLUS_ASSET_PATH); //only remove files
			update_option('tp_save_update_at', strtotime('now'), false); //all cache regenerate
			add_option( $option_name, $versions );

			$this->tp_third_patry_cache();

		}else{
			if( ! in_array( '5.6.0', $get_version ) ){
				l_theplus_library()->remove_dir_files(L_THEPLUS_ASSET_PATH); //only remove files
				update_option('tp_save_update_at', strtotime('now'), false); //all cache regenerate
				$versions = array_unique( array_merge( $get_version, ['5.6.0'] ) );
				update_option( $option_name, $versions );

				$this->tp_third_patry_cache();
			}
		}
	}

	/**
	 * Generate secure path url
	 *
	 * @since v2.0
	 */
	public function pathurl_security($url) {
        return preg_replace(['/^http:/', '/^https:/', '/(?!^)\/\//'], ['', '', '/'], $url);
    }

	public function tp_third_patry_cache(){
		// Clear Litespeed cache
		if(method_exists('LiteSpeed_Cache_API', 'purge_all')){
			LiteSpeed_Cache_API::purge_all();
		}

		// W3 Total Cache.
		if ( function_exists( 'w3tc_flush_all' ) ) {
			w3tc_flush_all();
		}

		// WP Fastest Cache.
		if ( ! empty( $GLOBALS['wp_fastest_cache'] ) && method_exists( $GLOBALS['wp_fastest_cache'], 'deleteCache' ) ) {
			$GLOBALS['wp_fastest_cache']->deleteCache(true);
		}

		// WP Super Cache
		if ( function_exists( 'wp_cache_clean_cache' ) ) {
			global $file_prefix;
			wp_cache_clean_cache( $file_prefix, true );
		}
		
		$all_clear_cache = array(
			'W3 Total Cache' => 'w3tc_pgcache_flush',
			'WP Fastest Cache' => 'wpfc_clear_all_cache',
			'WP Rocket' => 'rocket_clean_domain',
			'Cachify' => 'cachify_flush_cache',
			'Comet Cache' => array('comet_cache', 'clear'),
			'SG Optimizer' => 'sg_cachepress_purge_cache',
			'Pantheon' => 'pantheon_wp_clear_edge_all',
			'Zen Cache' => array('zencache', 'clear'),
			'Breeze' => array('Breeze_PurgeCache', 'breeze_cache_flush'),
			'Swift Performance' => array('Swift_Performance_Cache', 'clear_all_cache'),
			'WP Optimize' => 'wpo_cache_flush',
		);
		
		foreach ($all_clear_cache as $plugin => $method) {
			if (is_callable($method)) {
				call_user_func($method);
			}
		}

		do_action( 'litespeed_purge_all' );
	}

	/**
	 * Add menu in admin bar.
	 *
	 * Adds "Plus Clear Cache" items to the WordPress admin bar.
	 *
	 * Fired by `admin_bar_menu` filter.
	 *
	 * @since 2.1.0
	 */
	public function add_plus_clear_cache_admin_bar( \WP_Admin_Bar $wp_admin_bar ) {
		
		global $wp_admin_bar;
		
		if ( ! is_super_admin()
			 || ! is_object( $wp_admin_bar ) 
			 || ! function_exists( 'is_admin_bar_showing' ) 
			 || ! is_admin_bar_showing() ) {
			return;
		}

		if( empty(self::$tpae_post_type) ){
			$this->get_post_type_post_id();
		}

		if (file_exists(L_THEPLUS_ASSET_PATH . '/theplus-' . self::$tpae_post_type . '-' . self::$tpae_post_id . '.min.css') || file_exists(L_THEPLUS_ASSET_PATH . '/theplus-' . self::$tpae_post_type . '-' . self::$tpae_post_id . '.min.js')) {
		
				//Parent
				$wp_admin_bar->add_node( [
					'id'	=> 'theplus-purge-clear',					
					'meta'	=> array(
						'class' => 'theplus-purge-clear',
					),
					'title' => esc_html__( 'The Plus Performance', 'tpebl' ),
					
				] );
				
				//Child Item
				$args = array();
				array_push($args,array(
					'id'		=>	'plus-purge-all-pages',
					'title'		=>	esc_html__( 'Purge All Pages', 'tpebl' ),
					'href'		=> 	'#clear-theplus-all',
					'parent'	=>	'theplus-purge-clear',
					'meta'   	=> 	array( 'class' => 'plus-purge-all-pages' ),
				));

				array_push($args,array(
					'id'     	=>	'plus-purge-current-page',
					'title'		=>	esc_html__( 'Purge Current Page', 'tpebl' ),
					'href'		=>	'#clear-theplus-' . self::$tpae_post_type . '-' . self::$tpae_post_id,
					'parent' 	=>	'theplus-purge-clear',
					'meta'   	=>	array( 'class' => 'plus-purge-current-page' ),
				));
				
				sort($args);
				foreach( $args as $each_arg) {
					$wp_admin_bar->add_node($each_arg);
				}
		}
	}
	
	/**
	 * Print style.
	 *
	 * Fired by `admin_head` and `wp_head` filters.
	 *
	 * @since 1.0.0
	 */
	public function plus_purge_clear_print_style() {
		if((is_admin_bar_showing())){ ?>
			<style>#wpadminbar .theplus-purge-clear > .ab-item:before {content: '';background-image: url(<?php echo esc_url( L_THEPLUS_URL . '/assets/images/theplus-logo-small.png' ); ?>) !important;background-size: 20px !important;background-position: center;width: 20px;height: 20px;background-repeat: no-repeat;top: 50%;transform: translateY(-50%);} @media (max-width:660px){ #wpadminbar {position: fixed;} }</style>
		<?php }
	}
	
	/**
     * Check if wp running in background
     *
     * @since 5.0.1
     */
    public function is_background_running() {
        if (wp_doing_cron()) {
            return true;
        }

        if (wp_doing_ajax()) {
            return true;
        }
        
        return false;
    }
	
	/**
     * Set transient post save
     *
     * @since 5.0.1
     */
	public function tp_post_save_transient( $post_id, $post_data ){
		if (wp_doing_cron()) {
            return;
        }

		if( !empty($post_id) ){
			$current_post_type = get_post_type( $post_id );
			if ( in_array($current_post_type, ['post', 'page', 'product']) ) {
				$this->remove_post_metadata($post_id, 'tp_widgets', 'update_at','theplus-post-'. $post_id . '_update_at');
			}else{
				update_option('tp_save_update_at', strtotime('now'), false);
			}
		}else{
			update_option('tp_save_update_at', strtotime('now'), false);
		}
	}
	
	/**
     * Update transient Post Remove
     */
	public function tp_trashed_post_transient( $post_id ){
		if (wp_doing_cron()) {
            return;
        }

	    if ( ! defined( 'ELEMENTOR_VERSION' ) && ! class_exists( 'Elementor\Plugin' ) ) {
		    return false;
	    }

		if( !empty($post_id) ){
			$current_post_type = get_post_type( $post_id );
			$this->remove_post_metadata($post_id, 'tp_widgets', 'update_at','theplus-post-'. $post_id . '_update_at');
			if ( ! in_array($current_post_type, ['post', 'page', 'product']) ) {
				update_option('tp_save_update_at', strtotime('now'), false);
			}
			if(function_exists('l_theplus_library')){
				$plus_name = 'theplus-post-'. $post_id;
				l_theplus_library()->remove_current_page_dir_files( L_THEPLUS_ASSET_PATH, $plus_name );
			}
		}
	}

	/**
	* Get Loaded Template
	*
	* @since 5.0.4
	*/
	public function tp_get_lodded_template( $content, $post_id ) {
		if ( $this->is_background_running() ) {
			return;
		}

		if (l_theplus_library()->is_preview_mode() && $this->requires_update) {
			$this->transient_widgets = array_merge( $this->transient_widgets, $this->find_widgets_from_templates( $content ) );
        }
		
		return $content;
	}

	/**
	* Get Lists from Template
	*
	* @since 5.0.4
	*/
	public function find_widgets_from_templates( $elements ) {
		$getlists = [];

		foreach($elements as $element){
			if(isset($element['elType']) && $element['elType'] == 'section'){}
			if(isset($element['elType'] ) && $element['elType'] == 'widget') {
				if($element['widgetType'] === 'global') {					
				} else {
					$getlists[] = $element['widgetType'];
				}
			}

			if(!empty($element['elements'])){
				$getlists = array_merge( $getlists, $this->find_widgets_from_templates( $element[ 'elements' ] ) );
			}
		}
		
		return $getlists;
	}

	/*
	 * Get Post ID and Post Type
	 * @since new_version
	 */
	public function get_post_type_post_id(){
		if(!empty(self::$tpae_post_type) && self::$tpae_post_id != '' ){
			return true;
		}

		global $wp_query;
		if( is_home() || is_singular() || is_archive() || is_search() || (isset( $wp_query ) && (bool) $wp_query->is_posts_page) || is_404() ){
			$queried_obj = get_queried_object_id();
			if(isset( $wp_query ) && isset($wp_query->is_post_type_archive) && !empty($wp_query->is_post_type_archive)){
				$queried_obj = $wp_query->query['post_type'];
			}
			if(is_search()){
				$queried_obj = 'search';
			}
			if(is_404()){
				$queried_obj = '404';
			}
			$post_type = (is_singular() ? 'post' : 'term');
			
			self::$tpae_post_type = $post_type;
			self::$tpae_post_id = $queried_obj;
			
			return true;
		}

		return false;
	}

	/**
     * Check Post Data
     *
     * @since 5.0.1
     */
	public function init_post_request_data(){
		
		if (is_admin()) {
            return;
        }
		
		if ($this->is_background_running()) {
            return;
        }
		
		$uid = null;
		
		if (!l_theplus_library()->is_preview_mode()) {
			if ( $this->get_post_type_post_id() ) {
				$uid = 'theplus-' . self::$tpae_post_type . '-' . self::$tpae_post_id;
			}
		}else{
			$uid = 'theplus';
		}
		
		if ($uid && $this->plus_uid == null) {
            $this->plus_uid = $uid;
            $this->requires_update = $this->requires_update();
        }
	}
	
	/**
     * Require Update Data
     *
     * @since 5.0.1
     */
	public function requires_update(){
		
		$widgets = $this->get_posts_metadata( self::$tpae_post_id, 'tp_widgets', 'widgets', $this->plus_uid . 'tp_widgets');
        $save_updated_at = get_option('tp_save_update_at');
        $post_updated_at = $this->get_posts_metadata( self::$tpae_post_id, 'tp_widgets', 'update_at', $this->plus_uid . '_update_at');

        if ($widgets === false) {
            return true;
        }
        if ($save_updated_at === false) {
            return true;
        }
		if ($post_updated_at === false || empty($post_updated_at) || (!empty($post_updated_at) && $save_updated_at != $post_updated_at)) {
			return true;
		}

		return false;
	}
	
	public function tp_before_enqueue_styles(){
		if ( $this->get_post_type_post_id() ) {
			$this->header_init_load_data( self::$tpae_post_type, self::$tpae_post_id );
		}
	}

	public function load_asset_per_location( $instance ) {

		if ( is_admin() || ! ( class_exists( 'ElementorPro\Modules\ThemeBuilder\Module' ) ) ) {
			return false;
		}

		$locations = $instance->get_locations();

		foreach ( $locations as $location => $settings ) {
			
			$documents = \ElementorPro\Modules\ThemeBuilder\Module::instance()->get_conditions_manager()->get_documents_for_location( $location );
			if( !empty($documents) ){
				foreach ( $documents as $document ) {
					$post_id = $document->get_post()->ID;
					$this->header_init_load_data( 'post', $post_id );
				}
			}
		}
	}

	public function load_asset_per_file( $file_name ) {

		if( empty( $file_name ) ){
			return $file_name;
		}

		$post_id  = preg_replace( '/[^0-9]/', '', $file_name );

		if ( $post_id < 1 ) {
			return $file_name;
		}

		$this->header_init_load_data( 'post', $post_id );
		
		return $file_name;
	}

	public function check_generate_script() {
		if ($this->is_background_running()) {
            return false;
        }
		
        if ($this->plus_uid === null) {
            return false;
        }

        if (l_theplus_library()->is_preview_mode()) {
            return false;
        }
		
        if (!$this->requires_update) {
            return false;
        }
		
		if(get_option('tp_save_update_at') === false){
			update_option('tp_save_update_at', strtotime('now'),false);
		}
		
		$update_at = $this->get_posts_metadata(self::$tpae_post_id, 'tp_widgets', 'update_at', $this->plus_uid . '_update_at' );
		if (get_option('tpgb_save_updated_at') === $update_at) {
            return false;
        }
		return true;
	}

	public function header_init_load_data($post_type = null, $post_id = null) {
		
		if($this->check_generate_script() === false ){
			return;
		}

		if(empty($post_type) || $post_id==null){
			return;
		}

		if( !empty($this->post_assets_object) && isset( $this->post_assets_object[ $post_id ] ) ){
			return;
		}
		
		if ( empty($this->post_assets_object) || (!empty($this->post_assets_object) && !isset( $this->post_assets_object[ $post_id ] ) && class_exists('Plus_Widgets_Manager') ) ) {
			$load_enqueue = tpae_get_post_assets( $post_id, $post_type );
			if(!empty($load_enqueue)){
				if(isset($load_enqueue->transient_widgets) && !empty($load_enqueue->transient_widgets)){
					
					if(has_filter('theplus_pro_registered_widgets')) {
						$this->l_registered_widgets = apply_filters('theplus_pro_registered_widgets', $this->l_registered_widgets );
					}
					$load_enqueue->transient_widgets = array_intersect(array_keys($this->l_registered_widgets), $load_enqueue->transient_widgets);

					if(!empty($load_enqueue->transient_widgets)){
						$this->enqueue_assets( $load_enqueue->transient_widgets, $post_type, $load_enqueue->preload_name, $load_enqueue->post_id );
					}
				}
				$widget_lists = [];
				if(!empty($load_enqueue->transient_widgets)){
					$widget_lists = array_unique($load_enqueue->transient_widgets);
					$this->transient_widgets = array_merge($this->transient_widgets, $widget_lists);
				}
				$this->post_assets_object[ $post_id ] = $widget_lists;
			}
		}
		
	}

	public function enqueue_assets( $elements = [], $post_type = '', $preload = '', $post_id = '' ){
		if(!empty($elements)){
			if ( !$this->check_css_js_cache_files( $post_type, $preload, 'css', true ) && $this->get_caching_option() == false ) {
				sort($elements);
				$this->plus_generate_scripts( $elements, 'theplus-preload-' . $post_type . '-' . $preload, ['css'], false);
			}
			if(!empty($this->tp_first_load)){
				$this->load_inline_script();
			}
			if($this->get_caching_option() == false){
				$plus_version = $this->get_post_version( $post_id );
				
				if(!empty($this->tp_first_load)){
					wp_enqueue_style( 'theplus-general-preload',$this->pathurl_security(L_THEPLUS_URL . "assets/css/main/plus-extra-adv/plus-extra-adv.min.css"), ['elementor-frontend'], $plus_version );
					$this->tp_first_load = false;
				}
				if($this->check_css_js_cache_files( $post_type, $preload, 'css', true )){
					$css_file = L_THEPLUS_ASSET_URL . '/theplus-preload-' . $post_type . '-' . $preload . '.min.css';
					wp_enqueue_style( 'theplus-'.$preload.'-preload',$this->pathurl_security($css_file), ['elementor-frontend'], $plus_version );
				}
				
			}else if(!empty($this->get_caching_option()) && !empty($elements)){
				$tp_url = L_THEPLUS_URL;
				$tp_path = L_THEPLUS_PATH . DIRECTORY_SEPARATOR;
				$tp_version = L_THEPLUS_VERSION;
				if(defined('THEPLUS_VERSION') && defined('THEPLUS_URL')){
					$tp_url = THEPLUS_URL;
					$tp_path = THEPLUS_PATH . DIRECTORY_SEPARATOR;
					$tp_version = THEPLUS_VERSION;
				}

				if(!empty($this->tp_first_load)){
					$this->tp_first_load = false;
				}
				$separate_path = $this->plus_load_separate_file($elements);
				if(!empty($separate_path) && isset($separate_path['css']) && !empty($separate_path['css'])){
					foreach( $separate_path['css'] as $key => $path ){
						if(is_readable(l_theplus_library()->secure_path_url($path))){
							$css_sep_url = str_replace( $tp_path, $tp_url, $path);
							if ( defined('THEPLUS_VERSION') && defined('THEPLUS_URL') ) {
								$css_sep_url = str_replace( L_THEPLUS_PATH . DIRECTORY_SEPARATOR, L_THEPLUS_URL, $css_sep_url);
							}
							$css_file_key = basename($css_sep_url, ".css");
							$css_file_key = basename($css_file_key, ".min");
							wp_enqueue_style('theplus-'.$css_file_key,$this->pathurl_security($css_sep_url),false,$tp_version);
						}
					}
				}
				if(!empty($separate_path) && isset($separate_path['js']) && !empty($separate_path['js'])){
					foreach( $separate_path['js'] as $key => $path ){
						if(is_readable(l_theplus_library()->secure_path_url($path))){
							$js_sep_url = str_replace( $tp_path, $tp_url, $path);
							if ( defined('THEPLUS_VERSION') && defined('THEPLUS_URL') ) {
								$js_sep_url = str_replace( L_THEPLUS_PATH . DIRECTORY_SEPARATOR , L_THEPLUS_URL , $js_sep_url);
							}
							$js_file_key = basename($js_sep_url, ".js");
							$js_file_key = basename($js_file_key, ".min");
							wp_enqueue_script('theplus-'.$js_file_key,$this->pathurl_security($js_sep_url),['jquery'],$tp_version,true);
						}
					}
				}
			}
		}
	}
	public function init(){
		$this->l_registered_widgets = l_registered_widgets();
		
		$this->transient_widgets = [];
		$this->transient_extensions = [];
		
		add_action( 'elementor/frontend/before_enqueue_styles', [ $this, 'tp_before_enqueue_styles' ] );
		add_action( 'elementor/theme/register_locations', [ $this, 'load_asset_per_location' ], 20 );
		add_filter( 'elementor/files/file_name', [ $this, 'load_asset_per_file' ] );

		add_action('wp_footer', array($this, 'generate_scripts_frontend'));
		
		add_action( 'elementor/editor/after_save', array($this,'tp_post_save_transient'), 10, 2 );
		add_action('trashed_post', array($this, 'tp_trashed_post_transient'), 10, 1);

		add_action('wp', [$this, 'init_post_request_data']);

		//@since 5.0.4
		add_filter('elementor/frontend/builder_content_data', [$this, 'tp_get_lodded_template'], 10, 2);

		if(!$this->get_caching_option()){
			add_action( 'admin_bar_menu', [ $this, 'add_plus_clear_cache_admin_bar' ], 300 );
			if(current_user_can("manage_options")){
				add_action('wp_ajax_plus_purge_current_clear', array($this, 'theplus_current_page_clear_cache'));
			}
		
			if(is_user_logged_in()){
				add_action( 'wp_head', [ $this, 'plus_purge_clear_print_style' ]);		
			}
		}
		
		add_action('wp_enqueue_scripts', array($this, 'plus_enqueue_scripts'));
		
		if (is_admin() && current_user_can("manage_options")) {
			add_action('admin_init', array($this, 'tp_version_clear_cache'));
			add_action('wp_ajax_smart_perf_clear_cache', array($this, 'theplus_smart_perf_clear_cache'));
			add_action('wp_ajax_backend_clear_cache', array($this, 'theplus_backend_clear_cache'));
		}
		
		//@since 5.0.4
		remove_filter('elementor/frontend/builder_content_data', [$this, 'tp_get_lodded_template'], 10, 2);
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
 * Returns instance of L_Plus_Generator
 */
function l_theplus_generator() {
	return L_Plus_Generator::get_instance();
}