<?php
/*
Plugin Name: Page scroll to id
Plugin URI: http://manos.malihu.gr/page-scroll-to-id
Description: Page scroll to id is an easy-to-use jQuery plugin that enables animated (smooth) page scrolling to specific id within the document. 
Version: 1.7.9
Author: malihu
Author URI: http://manos.malihu.gr
License: MIT License (MIT)
Text Domain: page-scroll-to-id
Domain Path: /languages
*/

/*
Copyright 2013  malihu  (email: manos@malihu.gr)

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/

if(!defined('WPINC')){ die; } // Abort if file is called directly

if(!class_exists('malihuPageScroll2id')){ // --edit--
	
	/*
	Plugin uses the following db options: 
	db_prefix_version (holds plugin version) 
	db_prefix_instances (holds all plugin instances and their settings in a single array) 
	*/
	
	/* to setup, search for: --edit-- */
	
	class malihuPageScroll2id{ // --edit--
		
		protected $version='1.7.9'; // Plugin version --edit--
		protected $update_option=null;
		
		protected $plugin_name='Page scroll to id'; // Plugin name --edit--
		protected $plugin_slug='page-scroll-to-id'; // Plugin slug --edit--
		protected $db_prefix='page_scroll_to_id_'; // Database field plugin prefix --edit--
		protected $pl_pfx='mPS2id_'; // Plugin prefix --edit--
		protected $sc_pfx='ps2id'; // Shortcode prefix --edit--
		
		protected static $instance=null;
		protected $plugin_screen_hook_suffix=null;
		
		protected $index=0;
		protected $default;
		
		protected $plugin_script='jquery.malihu.PageScroll2id.js'; // Plugin public script (main js plugin file) --edit--
		protected $plugin_init_script='jquery.malihu.PageScroll2id-init.js'; // Plugin public initialization script --edit--
		protected $plugin_production_script='page-scroll-to-id.min.js'; // Plugin public production script (main + init) --edit--
		protected $plugin_unbind_defer_script='jquery.malihu.PageScroll2id-unbind-defer.js'; // Plugin public special script --edit--
		
		private function __construct(){
			// Plugin requires PHP version 5.2 or higher
			if(version_compare(PHP_VERSION, '5.2', '<')){
				add_action('admin_notices', array($this, 'admin_notice_php_version'));
				return;
			}
			// Plugin requires WP version 3.3 or higher
			if(version_compare(get_bloginfo('version'), '3.3', '<')){
				add_action('admin_notices', array($this, 'admin_notice_wp_version'));
				return;
			}
			// Plugin default params
			$this->default=array(
				$this->pl_pfx.'instance_'.$this->index => $this->plugin_options_array('defaults',$this->index,null,null)
			);
			// Add textdomain
			add_action('plugins_loaded', array($this, 'init_localization'));
			// Add the options page and menu item.
			add_action('admin_menu', array($this, 'add_plugin_admin_menu'));
			// Upgrade plugin
			add_action('admin_init', array($this, 'upgrade_plugin'));
			// Add/save plugin settings.
			add_action('admin_init', array($this, 'add_plugin_settings'));
			// Load admin stylesheet and javaScript.
			add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_styles'));
			add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));
			// Load admin block editor (i.e. Gutenberg) assets (stylesheet, javaScript etc.)
			add_action('enqueue_block_editor_assets', array($this, 'enqueue_admin_block_styles'));
			add_action('enqueue_block_editor_assets', array($this, 'enqueue_admin_block_scripts'));
			// Register plugin's blocks (Gutenberg)
			add_action('plugins_loaded', array($this, 'plugin_register_blocks_fn'));
			// load public stylesheet and javaScript.
			if(!defined('PS2ID_MINIFIED_JS')){
				define('PS2ID_MINIFIED_JS', true); //load production script by default
			}
			add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
			// Add plugin shortcodes
			$this->add_plugin_shortcode(); // Remove/comment for plugin without any shortcodes --edit-- 
			// Add plugin settings link
			add_filter('plugin_action_links_'.plugin_basename(__FILE__), array($this, 'add_plugin_action_links'));
			// Add contextual help for the plugin
			add_action('admin_head', array($this, 'plugin_contextual_help'), 10, 3);
			// Plugin API (actions, hooks, filters etc.)
			$this->pluginAPI_functions();
		}
		
		public static function get_instance(){
			if(null==self::$instance){
				self::$instance=new self;
			}
			
			return self::$instance;
		}
		
		// PHP version notice
		public function admin_notice_php_version(){
			_e('<div class="error"><p><strong>'.$this->plugin_name.'</strong> requires PHP version <strong>5.2</strong> or higher.</p></div>', $this->plugin_slug);
		}
		
		// WP version notice
		public function admin_notice_wp_version(){
			_e('<div class="error"><p><strong>'.$this->plugin_name.'</strong> requires WordPress version <strong>3.3</strong> or higher. Deactivate the plugin and reactivate when WordPress is updated.</p></div>', $this->plugin_slug);
		}
		
		// Plugin localization (load plugin textdomain)
		public function init_localization(){
			if(!load_plugin_textdomain($this->plugin_slug, false, WP_LANG_DIR)){
				load_plugin_textdomain($this->plugin_slug, false, dirname(plugin_basename(__FILE__)).'/languages/'); 
			}
		}
		
		// Admin styles
		public function enqueue_admin_styles(){
			wp_enqueue_style($this->plugin_slug.'-admin-styles-gen', plugins_url('css/admin-gen.css', __FILE__), $this->version);
			if(!isset($this->plugin_screen_hook_suffix)){
				return;
			}
			$screen=get_current_screen();
			// If this is the plugin's settings page, load admin styles
			if($screen->id==$this->plugin_screen_hook_suffix){ 
				wp_enqueue_style($this->plugin_slug.'-admin-styles', plugins_url('css/admin.css', __FILE__), $this->version);
			}
		}
		
		// Admin scripts
		public function enqueue_admin_scripts(){
			if(!isset($this->plugin_screen_hook_suffix)){
				return;
			}
			$screen=get_current_screen();
			// If this is the plugin's settings page, load admin scripts
			if($screen->id==$this->plugin_screen_hook_suffix){ 
				wp_enqueue_script('jquery-ui-sortable');
				wp_enqueue_script($this->plugin_slug.'-admin-script', plugins_url('js/admin.js', __FILE__), array('jquery', 'jquery-ui-sortable'), $this->version, 1);
				$params=array(
			  		'id' => $this->pl_pfx.'form',
					'db_prefix' => $this->db_prefix,
					'sc_prefix' => $this->sc_pfx
				);
				wp_localize_script($this->plugin_slug.'-admin-script', '_adminParams', $params);
			}
		}

		// Admin block editor styles (Gutenberg)
		public function enqueue_admin_block_styles(){
			wp_enqueue_style(
				$this->plugin_slug.'-admin-blocks-style', 
				plugins_url( 'includes/blocks/blocks.css', __FILE__ ), 
				array( 'wp-edit-blocks' ), 
				filemtime( plugin_dir_path( __FILE__ ) . 'includes/blocks/blocks.css' )
			);
		}

		// Admin block editor scripts (Gutenberg)
		public function enqueue_admin_block_scripts(){
			wp_enqueue_script(
				$this->plugin_slug.'-admin-blocks-script', 
				plugins_url( 'includes/blocks/blocks.js', __FILE__ ), 
				array( 'wp-blocks', 'wp-components', 'wp-element', 'wp-i18n', 'wp-editor' ), 
				filemtime( plugin_dir_path( __FILE__ ) . 'includes/blocks/blocks.js' ),
				true // Load script in footer.
			);
		}

		// Register plugin's blocks (Gutenberg)
		public function plugin_register_blocks_fn(){
			if ( function_exists( 'register_block_type' ) ){
				register_block_type( 'ps2id/blocks', array(
					'editor_script' => $this->plugin_slug.'-admin-blocks-script',
					'editor_style'  => $this->plugin_slug.'-admin-blocks-style',
				) );
			}
		}
		
		// front-end plugin scripts
		public function enqueue_scripts(){
			wp_enqueue_script('jquery');
			/* 
			to load the unminified script files, in config.php use: 
			define('PS2ID_MINIFIED_JS', false); 
			*/ 
			if(PS2ID_MINIFIED_JS){
				//production minified single file
				wp_register_script($this->plugin_slug.'-plugin-script', plugins_url('js/'.$this->plugin_production_script, __FILE__), array('jquery'), $this->version, 1);
				wp_enqueue_script($this->plugin_slug.'-plugin-script');
			}else{
				//development unminified files
				wp_register_script($this->plugin_slug.'-plugin-script', plugins_url('js/'.$this->plugin_script, __FILE__), array('jquery'), $this->version, 1);
				wp_enqueue_script($this->plugin_slug.'-plugin-script');
				wp_register_script($this->plugin_slug.'-plugin-init-script', plugins_url('js/'.$this->plugin_init_script, __FILE__), array('jquery', $this->plugin_slug.'-plugin-script'), $this->version, 1);
				wp_enqueue_script($this->plugin_slug.'-plugin-init-script');
			}
			$this->plugin_fn_call();
			//test
			/*if(PS2ID_MINIFIED_JS){
				$this->debug_to_console('load js '.PS2ID_MINIFIED_JS);
			}*/
		}
		
		public function add_plugin_admin_menu(){
			$this->plugin_screen_hook_suffix=add_options_page(
				__($this->plugin_name, $this->plugin_slug),
				__($this->plugin_name, $this->plugin_slug),
				'manage_options',
				$this->plugin_slug,
				array($this, 'display_plugin_admin_page')
			);
		}
		
		public function add_plugin_settings(){
			// All plugin settings are saved as array in a single option
			register_setting($this->plugin_slug, $this->db_prefix.'instances', $this->validate_plugin_settings());
			// Get plugin options array
			$pl_instances=get_option($this->db_prefix.'instances', $this->default);
			// Loop the array to generate instances, fields etc.
			// Add settings section for each plugin instance
			//while(list($var, $val)=each($pl_instances)){
			foreach($pl_instances as $var => $val){
				add_settings_section(
					$this->db_prefix.'settings_section'.$this->index,
					null,
					'__return_false', // instead of null to avoid wp <3.4.1 warnings (https://core.trac.wordpress.org/ticket/21630)
					$this->plugin_slug
				);
				// Add settings fields for each section
				//while(list($var2, $val2)=each($val)){
				foreach($val as $var2 => $val2){
					//while(list($var3, $val3)=each($val2)){
					foreach($val2 as $var3 => $val3){
						switch($var3){
						    case 'value':
						        $i_val=$val3;
						        break;
						    case 'values':
						        $i_vals=$val3;
						        break;
							case 'id':
						         $i_id=$val3;
						        break;
						    case 'field_type':
						         $i_field_type=$val3;
						        break;
							case 'label':
						         $i_label=$val3;
						        break;
							case 'checkbox_label':
						         $i_checkbox_label=$val3;
						        break;
							case 'radio_labels':
						         $i_radio_labels=$val3;
						        break;
							case 'field_info':
						         $i_field_info=$val3;
						        break;
							case 'description':
						         $i_description=$val3;
						        break;
							case 'wrapper':
						         $i_wrapper=$val3;
						        break;
						}
					}
					add_settings_field(
						$i_id,
						$i_label,
						array($this, 'instance_field_callback'),
						$this->plugin_slug,
						$this->db_prefix.'settings_section'.$this->index,
						array(
							'value' => $i_val,
							'values' => $i_vals,
							'id' => $i_id,
							'field_type' => $i_field_type,
							'label_for' => ($i_field_type!=='checkbox' && $i_field_type!=='radio') ? $i_id : null,
							'checkbox_label' => $i_checkbox_label,
							'radio_labels' => $i_radio_labels,
							'field_info' => $i_field_info,
							'description' => $i_description,
							'wrapper' => $i_wrapper
						)
				    );
				}
				$this->index++;
			}
		}
		
		public function instance_field_callback($args){
			$html=(!empty($args['wrapper'])) ? '<'.$args['wrapper'].'>' : '';
			if($args['field_type']=='text'){ // Text field
				$html.='<input type="text" id="'.$args['id'].'" name="'.$args['id'].'" value="'.$args['value'].'" class="regular-text code" /> ';
			}else if($args['field_type']=='text-integer'){ // Text field - integer
				$html.='<input type="text" id="'.$args['id'].'" name="'.$args['id'].'" value="'.$args['value'].'" class="small-text" /> ';
			}else if($args['field_type']=='checkbox'){ // Checkbox
				(!empty($args['checkbox_label'])) ? $html.='<label for="'.$args['id'].'">' : $html.='';
				$html.='<input type="checkbox" id="'.$args['id'].'" name="'.$args['id'].'" value="true" '.checked('true', $args['value'], false).' /> ';
				(!empty($args['checkbox_label'])) ? $html.=$args['checkbox_label'].'</label> ' : $html.='';
			}else if($args['field_type']=='select'){ // Select/dropdown
				$html.='<select id="'.$args['id'].'" name="'.$args['id'].'">';
				$select_options=explode(',', $args['values']);
				foreach($select_options as $select_option){
					$html.='<option value="'.$select_option.'" '.selected($select_option, $args['value'], false).'>'.$select_option.'</option>';
				}
				$html.= '</select> ';
			}else if($args['field_type']=='radio'){ // Radio buttons
				$radio_buttons=explode(',', $args['values']);
				$radio_labels=explode('|', $args['radio_labels']);
				$i=0;
				foreach($radio_buttons as $radio_button){
					$html.='<label title="'.$radio_button.'"><input type="radio" name="'.$args['id'].'" value="'.$radio_button.'" '.checked($radio_button, $args['value'], false).' /> <span>'.$radio_labels[$i].'</span> </label> ';
					$html.=($radio_button===end($radio_buttons)) ? '' : '<br />';
					$i++;
				}
			}else if($args['field_type']=='textarea'){ // Textarea
				$html.='<textarea id="'.$args['id'].'" name="'.$args['id'].'" rows="10" cols="50" class="large-text code">'.$args['value'].'</textarea> ';
			}else if($args['field_type']=='hidden'){ // Hidden field
				$html.='<input type="hidden" id="'.$args['id'].'" name="'.$args['id'].'" value="'.$args['value'].'" /> ';
			}
			$html.=(!empty($args['wrapper'])) ? '</'.$args['wrapper'].'>' : '';
			(!empty($args['field_info'])) ? $html.='<span>'.$args['field_info'].'</span> ' : $html.='';
			(!empty($args['description'])) ? $html.='<p class="description">'.$args['description'].'</p>' : $html.='';
			echo wp_kses($html, array(
				'input'     => array(
					'type'  	=> array(),
					'id' 		=> array(),
					'name' 		=> array(),
					'value' 	=> array(),
					'class'		=> array(),
					'checked'	=> array(),
				),
				'textarea'  => array(
					'id' 		=> array(),
					'name' 		=> array(),
					'rows' 		=> array(),
					'cols'		=> array(),
					'class'		=> array(),
				),
				'label'     => array(
					'for'	  	=> array(),
					'title'	  	=> array(),
				),
				'select'     => array(
					'id' 		=> array(),
					'name' 		=> array(),
				),
				'option'     => array(
					'value' 	=> array(),
					'selected'	=> array(),
				),
				'span'     	=> array(),
				'p'		    => array(
					'class' 	=> array(),
				),
				'fieldset' 	=> array(),
				'br'     	=> array(),
				'a'		    => array(
					'href' 		=> array(),
					'target'	=> array(),
					'class'		=> array(),
				),
				'code'     	=> array(),
				'small'    	=> array(),
			));
		}
		
		public function display_plugin_admin_page(){
			include_once(plugin_dir_path( __FILE__ ).'includes/admin.php');
		}
		
		public function add_plugin_action_links($links){
			//$settings_link='<a href="options-general.php?page='.$this->plugin_slug.'">Settings</a>';
			//array_unshift($links, $settings_link);
			//$links[]='<a href="options-general.php?page='.$this->plugin_slug.'">Settings</a>';
			$links[]='<a href="'. esc_url( get_admin_url(null, 'options-general.php?page='.$this->plugin_slug) ) .'">Settings</a>';
			$links[]='<a href="http://manos.malihu.gr/page-scroll-to-id-for-wordpress/" target="_blank">Documentation</a>';
			return $links;
		}
		
		public function plugin_fn_call(){
			$instances=get_option($this->db_prefix.'instances');
			//filter only necessary values
			$instancesOptions=new stdClass();
			foreach ((array)$instances as $i_key => $instanceOptions){
				$instancesOptions->$i_key = new stdClass();
				foreach ((array)$instanceOptions as $o_key => $instanceOption){
					$instancesOptions->$i_key->$o_key = $instanceOption['value'];
				}
			}
			$params=array(
				'instances' => $instancesOptions, //pass filtered values
				'total_instances' => count((array)$instances),
				'shortcode_class' => '_'.$this->sc_pfx
			);
			$loc_script=PS2ID_MINIFIED_JS ? $this->plugin_slug.'-plugin-script' : $this->plugin_slug.'-plugin-init-script';
			wp_localize_script($loc_script, $this->pl_pfx.'params', $params);
		}
		
		public function add_plugin_shortcode(){
			$pl_shortcodes=array();
			$pl_shortcodes_b=array();
			$instances=get_option($this->db_prefix.'instances');
			for($i=1; $i<=count((array)$instances); $i++){
				$pl_shortcodes[]='pl_shortcode_fn_'.$i;
				$pl_shortcodes_b[]='pl_shortcode_fn_'.$i;
				// --edit--
				$tag=$shortcode_class=$this->sc_pfx; // Shortcode without suffix 
				$tag_b=$this->sc_pfx.'_wrap'; // Shortcode without suffix 
				//$tag=$shortcode_class=$this->sc_pfx.'_'.$i; // Shortcode with suffix 
				include_once(
					plugin_dir_path( __FILE__ ).(version_compare(PHP_VERSION, '5.3', '<') ? 'includes/malihu-pagescroll2id-shortcodes-php52.php' : 'includes/malihu-pagescroll2id-shortcodes.php')
				);
			}
		}
		
		public function validate_plugin_settings(){
			if(!empty($_POST) || !wp_verify_nonce(wp_json_encode($_POST))){
				if(isset($_POST[$this->db_prefix.'reset']) && $_POST[$this->db_prefix.'reset']==='true'){ 
					// Reset all to default
					$_POST[$this->db_prefix.'instances']=$this->default; 
				}else{ 
					// Update settings array
					if(isset($_POST[$this->db_prefix.'total_instances'])){
						$instances=$_POST[$this->db_prefix.'total_instances'];
						for($i=0; $i<$instances; $i++){
							$instance=$this->plugin_options_array('validate',$i,null,null);
							$update[$this->pl_pfx.'instance_'.$i]=$instance;
						}
						$_POST[$this->db_prefix.'instances']=$update; // Save array to plugin option
					}
				}
			}
		}
		
		public function sanitize_input($type, $val, $def){
			switch($type){
				case 'text': // General
					$val=(empty($val)) ? $def : sanitize_text_field($val);
					break;
				case 'number': // Positive number
					$val=(int) preg_replace('/\D/', '', $val);
					break;
				case 'integer': // Positive or negative number
					$s=strpos($val, '-');
					$n=(int) preg_replace('/\D/', '', $val);
					$val=($s===false) ? $n : '-'.$n;
					break;
				case 'class': // Class name
					$val=sanitize_html_class($val, $def);
					break;
			}
			return $val;
		}
		
		public function upgrade_plugin(){
			// Get/set plugin version
			$current_version=get_site_option($this->db_prefix.'version');
			if(!$current_version){
				add_site_option($this->db_prefix.'version', $this->version);
				$old_db_options=$this->get_plugin_old_db_options(); // Get old/deprecated plugin db options --edit--
				$this->delete_plugin_old_db_options(); // Delete old/deprecated plugin db options --edit--
			}else{
				$old_db_options=null; // Old/deprecated plugin db options --edit--
			}
			if($this->version!==$current_version){
				// Update plugin options to new version ones
				$pl_instances=get_option($this->db_prefix.'instances', $this->default);
				$pl_instances_count=(is_array($pl_instances) || $pl_instances instanceof Countable) ? count($pl_instances) : 1;
				for($i=0; $i<$pl_instances_count; $i++){
					$j=$pl_instances[$this->pl_pfx.'instance_'.$i];
					$instance=$this->plugin_options_array('upgrade',$i,$j,$old_db_options); // --edit--
					$update[$this->pl_pfx.'instance_'.$i]=$instance;
				}
				$this->update_option=update_option($this->db_prefix.'instances', $update); // Update options
				update_site_option($this->db_prefix.'version', $this->version); // Update version
			}
		}
		
		// --edit--
		public function get_plugin_old_db_options(){
			$old_db_opt1=get_option('malihu_pagescroll2id_sel');
			$old_db_opt2=get_option('malihu_pagescroll2id_scrollSpeed');
			$old_db_opt3=get_option('malihu_pagescroll2id_autoScrollSpeed');
			$old_db_opt4=get_option('malihu_pagescroll2id_scrollEasing');
			$old_db_opt5=get_option('malihu_pagescroll2id_scrollingEasing');
			$old_db_opt6=get_option('malihu_pagescroll2id_pageEndSmoothScroll');
			$old_db_opt7=get_option('malihu_pagescroll2id_layout');
			return array(  
				($old_db_opt1) ? $old_db_opt1 : 'a[href*=\'#\']:not([href=\'#\'])',
				($old_db_opt2) ? $old_db_opt2 : 800,
				($old_db_opt3) ? $old_db_opt3 : 'true',
				($old_db_opt4) ? $old_db_opt4 : 'easeInOutQuint',
				($old_db_opt5) ? $old_db_opt5 : 'easeOutQuint',
				($old_db_opt6) ? $old_db_opt6 : 'true',
				($old_db_opt7) ? $old_db_opt7 : 'vertical'
			);
		}
		
		// --edit--
		public function delete_plugin_old_db_options(){
			delete_option('malihu_pagescroll2id_sel');
			delete_option('malihu_pagescroll2id_scrollSpeed');
			delete_option('malihu_pagescroll2id_autoScrollSpeed');
			delete_option('malihu_pagescroll2id_scrollEasing');
			delete_option('malihu_pagescroll2id_scrollingEasing');
			delete_option('malihu_pagescroll2id_pageEndSmoothScroll');
			delete_option('malihu_pagescroll2id_layout');
		}
		
		private function debug_to_console($data){
			/* 
			This is just a helper function that sends debug code to the Javascript console 
			Usage: $this->debug_to_console('hello world'); 
			*/
			echo('<script>var _debugData_='.json_encode($data).'; console.log("PHP: "+_debugData_);</script>');
		}
		
		public function plugin_contextual_help(){
			if(!isset($this->plugin_screen_hook_suffix)){
				return;
			}
			$screen=get_current_screen();
			 if(strcmp($screen->id, $this->plugin_screen_hook_suffix)==0){
				if(get_bloginfo('version') >= '3.6'){
					// --edit--
					// Multiple contextual help files/tabs
					ob_start();
					include_once(plugin_dir_path( __FILE__ ).'includes/help/overview.inc');
					$help_overview=ob_get_contents();
					ob_end_clean();
					ob_start();
					include_once(plugin_dir_path( __FILE__ ).'includes/help/get-started.inc');
					$help_get_started=ob_get_contents();
					ob_end_clean();
					ob_start();
					include_once(plugin_dir_path( __FILE__ ).'includes/help/plugin-settings.inc');
					$help_plugin_settings=ob_get_contents();
					ob_end_clean();
					ob_start();
					include_once(plugin_dir_path( __FILE__ ).'includes/help/shortcodes.inc');
					$help_plugin_shortcodes=ob_get_contents();
					ob_end_clean();
					ob_start();
					include_once(plugin_dir_path( __FILE__ ).'includes/help/sidebar.inc');
					$help_sidebar=ob_get_contents();
					ob_end_clean();
					if(method_exists($screen, 'add_help_tab')){
						$screen->add_help_tab(array(
							'id' => $this->plugin_slug.'overview',
							'title' => 'Overview',
							'content' => $help_overview,
						));
						$screen->add_help_tab(array(
							'id' => $this->plugin_slug.'get-started',
							'title' => 'Get started',
							'content' => $help_get_started,
						));
						$screen->add_help_tab(array(
							'id' => $this->plugin_slug.'plugin-settings',
							'title' => 'Plugin settings',
							'content' => $help_plugin_settings,
						));
						$screen->add_help_tab(array(
							'id' => $this->plugin_slug.'shortcodes',
							'title' => 'Shortcodes',
							'content' => $help_plugin_shortcodes,
						));
						$screen->set_help_sidebar($help_sidebar);
					}
				}
			 }
		}
		
		// Plugin API (actions, hooks, filters etc.) fn
		public function pluginAPI_functions(){
			$pl_instances=get_option($this->db_prefix.'instances', $this->default);
			$pl_i=$pl_instances[$this->pl_pfx.'instance_0'];
			// WP Menu API menus HTML attributes (requires WP version 3.6 or higher)
			if(isset($pl_i['autoSelectorMenuLinks']) && $pl_i['autoSelectorMenuLinks']['value']=='true'){
				add_filter('nav_menu_link_attributes', array($this, 'wp_menu_links_custom_atts'), 10, 3);
			}
			// tinyMCE buttons (requires WP version 3.9 or higher)
			if(version_compare(get_bloginfo('version'), '3.9', '>=') && isset($pl_i['adminTinyMCEbuttons']) && $pl_i['adminTinyMCEbuttons']['value']=='true'){
				$plugin_tinymce = new malihuPageScroll2idtinymce();
				add_action('admin_head', array($plugin_tinymce, 'add_custom_button'));
			}
			// Display widgets id attribute 
			if(isset($pl_i['adminDisplayWidgetsId']) && $pl_i['adminDisplayWidgetsId']['value']=='true'){
				add_action('widget_form_callback', array($this, 'display_widget_id'), 10, 2);
			}
			// Auto-generate dummy offset element
			if(isset($pl_i['dummyOffset']) && $pl_i['dummyOffset']['value']=='true'){
				add_action('wp_footer', array($this, 'dummy_offset_element'), 99);
			}
			// Unbind unrelated click events with specific selector (requires PHP 5.3 or higher)
			if(version_compare(PHP_VERSION, '5.3', '>')){
				$_ENV["ps2id_p_plugin_slug"] = $this->plugin_slug;
				$_ENV["ps2id_p_plugin_unbind_defer_script"] = $this->plugin_unbind_defer_script;
				$_ENV["ps2id_p_version"] = $this->version;
				$_ENV["ps2id_p_pl_pfx"] = $this->pl_pfx;
				include_once(
					plugin_dir_path( __FILE__ ).'includes/malihu-pagescroll2id-unbind-click-php53.php'
				);
			}
		}
		
		// WP Menu API menus HTML attributes fn 
		public function wp_menu_links_custom_atts($atts, $item, $args){
			$atts['data-ps2id-api'] = 'true';
			//link specific offset special class (ps2id-offset-NUMBER)
			if(preg_match("/ps2id-offset-/s", var_export($item->classes, true))){
				foreach ( $item->classes as $key => $value ) {
					if( substr_count($value, 'ps2id-offset-') > 0 ) {
							$ps2id_offset_value = $value;
					}
				}
				if(isset($ps2id_offset_value)){
					$ps2id_offset_value = explode('ps2id-offset-', $ps2id_offset_value);
					if(is_numeric($ps2id_offset_value[1])){
						$atts['data-ps2id-offset'] = $ps2id_offset_value[1];
					}
				}
			}
			return $atts;
		}
		
		// Display widgets id attribute fn 
		public function display_widget_id($instance, $widget){
			if($widget->id_base!=='malihupagescroll2idwidget'){ // don't show it on plugin widget (duh!)
				$row = '<p class="ps2id-admin-widgets-row-help">';
				$row .= '<span class="description"><em>Page scroll to id target: <b>'.$widget->id.'</b></em></span>';
				$row .= '</p>';
				echo wp_kses($row, array(
					'p'     	=> array(
						'class'		=> array(),
					),
					'span'     	=> array(
						'class'		=> array(),
					),
					'em'     	=> array(),
					'b'     	=> array(),
				));
			}
			return $instance;
		}

		// Auto-generate dummy offset element fn
		public function dummy_offset_element(){
			$dummy_offset_class = '';
			if ( is_admin_bar_showing() ) {
				$dummy_offset_class .= ' class="admin-bar-visible"';
			}
			$dummy_offset_markup = '<div class="ps2id-dummy-offset-wrapper" style="overflow:hidden;height:0;visibility:hidden;z-index:-1;"><div id="ps2id-dummy-offset"'.$dummy_offset_class.' style="width:100%;visibility:hidden;"></div></div>';
			echo wp_kses( $dummy_offset_markup, array(
				'div'    	=> array(
					'class'		=> array(),
					'id'		=> array(),
					'style'		=> array(),
				),
			));
		}
		
		public function plugin_options_array($action, $i, $j, $old){
			// --edit--
			// Defaults
			$d0='a[href*=\'#\']:not([href=\'#\'])';
			$d19='true';
			$d29='a[href^=\'#tab-\'], a[href^=\'#tabs-\'], a[data-toggle]:not([data-toggle=\'tooltip\']), a[data-slide], a[data-vc-tabs], a[data-vc-accordion], a.screen-reader-text.skip-link';
			$d1=800;
			$d2='true';
			$d3='easeInOutQuint';
			$d4='easeOutQuint';
			$d32='false';
			$d5='true';
			$d24='false';
			$d26='false';
			$d33='false';
			$d6='vertical';
			$d7=0;
			$d30='false';
			$d8='';
			$d9='mPS2id-clicked';
			$d10='mPS2id-target';
			$d11='mPS2id-highlight';
			$d12='false';
			$d14='false';
			$d16='false';
			$d22='false';
			$d13='true';
			$d17='true';
			$d18=0;
			$d27='true';
			$d28='false';
			$d15=0;
			$d20='true';
			$d21='true';
			$d23='false';
			$d34='';
			$d25='false';
			$d31='false';
			// Values
			switch($action){
				case 'validate':
					$v0=$this->sanitize_input('text', $_POST[$this->db_prefix.$i.'_selector'], $d0);
					$v19=(isset($_POST[$this->db_prefix.$i.'_autoSelectorMenuLinks'])) ? 'true' : 'false';
					$v29=$this->sanitize_input('text', $_POST[$this->db_prefix.$i.'_excludeSelector'], $d29);
					$v1=$this->sanitize_input('number', $_POST[$this->db_prefix.$i.'_scrollSpeed'], $d1);
					$v2=(isset($_POST[$this->db_prefix.$i.'_autoScrollSpeed'])) ? 'true' : 'false';
					$v3=$_POST[$this->db_prefix.$i.'_scrollEasing'];
					$v4=$_POST[$this->db_prefix.$i.'_scrollingEasing'];
					$v32=(isset($_POST[$this->db_prefix.$i.'_forceScrollEasing'])) ? 'true' : 'false';
					$v5=(isset($_POST[$this->db_prefix.$i.'_pageEndSmoothScroll'])) ? 'true' : 'false';
					$v24=(isset($_POST[$this->db_prefix.$i.'_stopScrollOnUserAction'])) ? 'true' : 'false';
					$v26=(isset($_POST[$this->db_prefix.$i.'_autoCorrectScroll'])) ? 'true' : 'false';
					$v33=(isset($_POST[$this->db_prefix.$i.'_autoCorrectScrollExtend'])) ? 'true' : 'false';
					$v6=$_POST[$this->db_prefix.$i.'_layout'];
					$v7=$this->sanitize_input('text', $_POST[$this->db_prefix.$i.'_offset'], $d7);
					$v30=(isset($_POST[$this->db_prefix.$i.'_dummyOffset'])) ? 'true' : 'false';
					$v8=(empty($_POST[$this->db_prefix.$i.'_highlightSelector'])) ? $d8 : $this->sanitize_input('text', $_POST[$this->db_prefix.$i.'_highlightSelector'], $d8);
					$v9=$this->sanitize_input('class', $_POST[$this->db_prefix.$i.'_clickedClass'], $d9);
					$v10=$this->sanitize_input('class', $_POST[$this->db_prefix.$i.'_targetClass'], $d10);
					$v11=$this->sanitize_input('class', $_POST[$this->db_prefix.$i.'_highlightClass'], $d11);
					$v12=(isset($_POST[$this->db_prefix.$i.'_forceSingleHighlight'])) ? 'true' : 'false';
					$v14=(isset($_POST[$this->db_prefix.$i.'_keepHighlightUntilNext'])) ? 'true' : 'false';
					$v16=(isset($_POST[$this->db_prefix.$i.'_highlightByNextTarget'])) ? 'true' : 'false';
					$v22=(isset($_POST[$this->db_prefix.$i.'_appendHash'])) ? 'true' : 'false';
					$v13=(isset($_POST[$this->db_prefix.$i.'_scrollToHash'])) ? 'true' : 'false';
					$v17=(isset($_POST[$this->db_prefix.$i.'_scrollToHashForAll'])) ? 'true' : 'false';
					$v18=$this->sanitize_input('number', $_POST[$this->db_prefix.$i.'_scrollToHashDelay'], $d18);
					$v27=(isset($_POST[$this->db_prefix.$i.'_scrollToHashUseElementData'])) ? 'true' : 'false';
					$v28=(isset($_POST[$this->db_prefix.$i.'_scrollToHashRemoveUrlHash'])) ? 'true' : 'false';
					$v15=$this->sanitize_input('text', $_POST[$this->db_prefix.$i.'_disablePluginBelow'], $d15);
					$v20=(isset($_POST[$this->db_prefix.$i.'_adminDisplayWidgetsId'])) ? 'true' : 'false';
					$v21=(isset($_POST[$this->db_prefix.$i.'_adminTinyMCEbuttons'])) ? 'true' : 'false';
					$v23=(isset($_POST[$this->db_prefix.$i.'_unbindUnrelatedClickEvents'])) ? 'true' : 'false';
					$v34=$this->sanitize_input('text', $_POST[$this->db_prefix.$i.'_unbindUnrelatedClickEventsSelector'], $d34);
					$v25=(isset($_POST[$this->db_prefix.$i.'_normalizeAnchorPointTargets'])) ? 'true' : 'false';
					$v31=(isset($_POST[$this->db_prefix.$i.'_encodeLinks'])) ? 'true' : 'false';
					break;
				case 'upgrade':
					if(isset($old)){
						$v0=$old[0];
						$v1=$old[1];
						$v2=$old[2];
						$v3=$old[3];
						$v4=$old[4];
						$v5=$old[5];
						$v6=$old[6];
					}else{
						$v0=(isset($j['selector'])) ? $j['selector']['value'] : $d0;
						$v1=(isset($j['scrollSpeed'])) ? $j['scrollSpeed']['value'] : $d1;
						$v2=(isset($j['autoScrollSpeed'])) ? $j['autoScrollSpeed']['value'] : $d2;
						$v3=(isset($j['scrollEasing'])) ? $j['scrollEasing']['value'] : $d3;
						$v4=(isset($j['scrollingEasing'])) ? $j['scrollingEasing']['value'] : $d4;
						$v5=(isset($j['pageEndSmoothScroll'])) ? $j['pageEndSmoothScroll']['value'] : $d5;
						$v6=(isset($j['layout'])) ? $j['layout']['value'] : $d6;
					}
					$v7=(isset($j['offset'])) ? $j['offset']['value'] : $d7;
					$v30=(isset($j['dummyOffset'])) ? $j['dummyOffset']['value'] : $d30;
					$v8=(isset($j['highlightSelector'])) ? $j['highlightSelector']['value'] : $d8;
					$v9=(isset($j['clickedClass'])) ? $j['clickedClass']['value'] : $d9;
					$v10=(isset($j['targetClass'])) ? $j['targetClass']['value'] : $d10;
					$v11=(isset($j['highlightClass'])) ? $j['highlightClass']['value'] : $d11;
					$v12=(isset($j['forceSingleHighlight'])) ? $j['forceSingleHighlight']['value'] : $d12;
					$v14=(isset($j['keepHighlightUntilNext'])) ? $j['keepHighlightUntilNext']['value'] : $d14;
					$v16=(isset($j['highlightByNextTarget'])) ? $j['highlightByNextTarget']['value'] : $d16;
					$v22=(isset($j['appendHash'])) ? $j['appendHash']['value'] : $d22;
					$v13=(isset($j['scrollToHash'])) ? $j['scrollToHash']['value'] : $d13;
					$v17=(isset($j['scrollToHashForAll'])) ? $j['scrollToHashForAll']['value'] : $d17;
					$v18=(isset($j['scrollToHashDelay'])) ? $j['scrollToHashDelay']['value'] : $d18;
					$v15=(isset($j['disablePluginBelow'])) ? $j['disablePluginBelow']['value'] : $d15;
					$v19=(isset($j['autoSelectorMenuLinks'])) ? $j['autoSelectorMenuLinks']['value'] : $d19;
					$v29=(isset($j['excludeSelector'])) ? $j['excludeSelector']['value'] : $d29;
					$v20=(isset($j['adminDisplayWidgetsId'])) ? $j['adminDisplayWidgetsId']['value'] : $d20;
					$v21=(isset($j['adminTinyMCEbuttons'])) ? $j['adminTinyMCEbuttons']['value'] : $d21;
					$v23=(isset($j['unbindUnrelatedClickEvents'])) ? $j['unbindUnrelatedClickEvents']['value'] : $d23;
					$v34=(isset($j['unbindUnrelatedClickEventsSelector'])) ? $j['unbindUnrelatedClickEventsSelector']['value'] : $d34;
					$v24=(isset($j['stopScrollOnUserAction'])) ? $j['stopScrollOnUserAction']['value'] : $d24;
					$v25=(isset($j['normalizeAnchorPointTargets'])) ? $j['normalizeAnchorPointTargets']['value'] : $d25;
					$v26=(isset($j['autoCorrectScroll'])) ? $j['autoCorrectScroll']['value'] : $d26;
					$v33=(isset($j['autoCorrectScrollExtend'])) ? $j['autoCorrectScrollExtend']['value'] : $d33;
					$v27=(isset($j['scrollToHashUseElementData'])) ? $j['scrollToHashUseElementData']['value'] : $d27;
					$v28=(isset($j['scrollToHashRemoveUrlHash'])) ? $j['scrollToHashRemoveUrlHash']['value'] : $d28;
					$v31=(isset($j['encodeLinks'])) ? $j['encodeLinks']['value'] : $d31;
					$v32=(isset($j['forceScrollEasing'])) ? $j['forceScrollEasing']['value'] : $d32;
					break;
				default:
					$v0=$d0;
					$v19=$d19;
					$v29=$d29;
					$v1=$d1;
					$v2=$d2;
					$v3=$d3;
					$v4=$d4;
					$v32=$d32;
					$v5=$d5;
					$v24=$d24;
					$v26=$d26;
					$v33=$d33;
					$v6=$d6;
					$v7=$d7;
					$v30=$d30;
					$v8=$d8;
					$v9=$d9;
					$v10=$d10;
					$v11=$d11;
					$v12=$d12;
					$v14=$d14;
					$v16=$d16;
					$v22=$d22;
					$v13=$d13;
					$v17=$d17;
					$v18=$d18;
					$v27=$d27;
					$v28=$d28;
					$v15=$d15;
					$v20=$d20;
					$v21=$d21;
					$v23=$d23;
					$v34=$d34;
					$v25=$d25;
					$v31=$d31;
			}
			// Options array
			/*
			option name
				option value 
				option values (for dropdowns, radio buttons) 
				field id 
				field type (e.g. text, checkbox etc.) 
				option setting title (also label for non checkboxes and radio buttons) 
				label for checkbox 
				labels for radio buttons 
				small information text (as span next to field/fieldset) 
				option setting description (as paragraph below the field/fieldset) 
				fields wrapper element (e.g. fieldset) 
			*/
			return array(
				'selector' => array(
					'value' => $v0,
					'values' => null,
					'id' => $this->db_prefix.$i.'_selector',
					'field_type' => 'text',
					'label' => 'Selector(s)',
					'checkbox_label' => null,
					'radio_labels' => null,
					'field_info' => null,
					'description' => 'Set the links (in the form of <a href="https://www.w3.org/TR/css3-selectors/" target="_blank">CSS selectors</a>) that will scroll the page when clicked (default value: any link with a non-empty hash (<code>#</code>) value in its URL) <br /><small>In addition to selectors above, the plugin is enabled automatically on links (or links contained within elements) with class <code>ps2id</code></small> <br /><small><a class="button button-small mPS2id-show-option-common-values" href="#">Show common values</a><span>For all links: <code>'.$d0.'</code><br />For menu links only: <code>.menu-item a[href*=\'#\']:not([href=\'#\'])</code></span></small>',
					'wrapper' => null
				),
				'autoSelectorMenuLinks' => array(
					'value' => $v19,
					'values' => null,
					'id' => $this->db_prefix.$i.'_autoSelectorMenuLinks',
					'field_type' => 'checkbox',
					'label' => '',
					'checkbox_label' => 'Enable on WordPress Menu links',
					'radio_labels' => null,
					'field_info' => null,
					'description' => 'Automatically enable the plugin on custom links (containing <code>#</code> in their URL) created in Appearance &rarr; Menus <br /><small>Requires WordPress version 3.6 or higher</small>',
					'wrapper' => 'fieldset'
				),
				'excludeSelector' => array(
					'value' => $v29,
					'values' => null,
					'id' => $this->db_prefix.$i.'_excludeSelector',
					'field_type' => 'text',
					'label' => '',
					'checkbox_label' => null,
					'radio_labels' => null,
					'field_info' => 'selectors are excluded',
					'description' => 'Set the links (in the form of <a href="https://www.w3.org/TR/css3-selectors/" target="_blank">CSS selectors</a>) that will be excluded from plugin&apos;s selectors (the plugin will not hanlde these links) <br /><small><a class="button button-small mPS2id-show-option-common-values" href="#">Show common values</a><span><code>'.$d29.'</code></span></small>',
					'wrapper' => null
				),
				'scrollSpeed' => array(
					'value' => $v1,
					'values' => null,
					'id' => $this->db_prefix.$i.'_scrollSpeed',
					'field_type' => 'text-integer',
					'label' => 'Scroll duration',
					'checkbox_label' => null,
					'radio_labels' => null,
					'field_info' => 'milliseconds',
					'description' => 'Scroll animation duration (i.e. scrolling speed) in milliseconds (1000 milliseconds equal 1 second)',
					'wrapper' => null
				),
				'autoScrollSpeed' => array(
					'value' => $v2,
					'values' => null,
					'id' => $this->db_prefix.$i.'_autoScrollSpeed',
					'field_type' => 'checkbox',
					'label' => '',
					'checkbox_label' => 'Auto-adjust scrolling duration',
					'radio_labels' => null,
					'field_info' => null,
					'description' => 'Enable to let the plugin fine-tune scrolling duration/speed according to target and page scroll position',
					'wrapper' => 'fieldset'
				),
				'scrollEasing' => array(
					'value' => $v3,
					'values' => 'linear,swing,easeInQuad,easeOutQuad,easeInOutQuad,easeInCubic,easeOutCubic,easeInOutCubic,easeInQuart,easeOutQuart,easeInOutQuart,easeInQuint,easeOutQuint,easeInOutQuint,easeInExpo,easeOutExpo,easeInOutExpo,easeInSine,easeOutSine,easeInOutSine,easeInCirc,easeOutCirc,easeInOutCirc,easeInElastic,easeOutElastic,easeInOutElastic,easeInBack,easeOutBack,easeInOutBack,easeInBounce,easeOutBounce,easeInOutBounce',
					'id' => $this->db_prefix.$i.'_scrollEasing',
					'field_type' => 'select',
					'label' => 'Scroll type/easing',
					'checkbox_label' => null,
					'radio_labels' => null,
					'field_info' => null,
					'description' => 'Scroll animation easing (<a href="http://manos.malihu.gr/page-scroll-to-id-for-wordpress/#ps2id-duration-easings-demo" target="_blank">visual representation &amp; demo of all easing types</a>)',
					'wrapper' => null
				),
				'scrollingEasing' => array(
					'value' => $v4,
					'values' => 'linear,swing,easeInQuad,easeOutQuad,easeInOutQuad,easeInCubic,easeOutCubic,easeInOutCubic,easeInQuart,easeOutQuart,easeInOutQuart,easeInQuint,easeOutQuint,easeInOutQuint,easeInExpo,easeOutExpo,easeInOutExpo,easeInSine,easeOutSine,easeInOutSine,easeInCirc,easeOutCirc,easeInOutCirc,easeInElastic,easeOutElastic,easeInOutElastic,easeInBack,easeOutBack,easeInOutBack,easeInBounce,easeOutBounce,easeInOutBounce',
					'id' => $this->db_prefix.$i.'_scrollingEasing',
					'field_type' => 'select',
					'label' => '',
					'checkbox_label' => null,
					'radio_labels' => null,
					'field_info' => null,
					'description' => 'Alternative animation easing (applied when a link is clicked while the page is animated/scrolling)',
					'wrapper' => null
				),
				'forceScrollEasing' => array(
					'value' => $v32,
					'values' => null,
					'id' => $this->db_prefix.$i.'_forceScrollEasing',
					'field_type' => 'checkbox',
					'label' => '',
					'checkbox_label' => 'Force scroll type/easing',
					'radio_labels' => null,
					'field_info' => null,
					'description' => 'Enable if the selected animation easing does not seem to take effect and/or there\'s conflict with other easing libraries and plugins',
					'wrapper' => 'fieldset'
				),
				'pageEndSmoothScroll' => array(
					'value' => $v5,
					'values' => null,
					'id' => $this->db_prefix.$i.'_pageEndSmoothScroll',
					'field_type' => 'checkbox',
					'label' => 'Scroll behavior',
					'checkbox_label' => 'Always scroll smoothly when reaching the end of the page/document',
					'radio_labels' => null,
					'field_info' => null,
					'description' => null,
					'wrapper' => 'fieldset'
				),
				'stopScrollOnUserAction' => array(
					'value' => $v24,
					'values' => null,
					'id' => $this->db_prefix.$i.'_stopScrollOnUserAction',
					'field_type' => 'checkbox',
					'label' => '',
					'checkbox_label' => 'Stop page scrolling on mouse-wheel or touch-swipe',
					'radio_labels' => null,
					'field_info' => null,
					'description' => 'Enable if you want to stop page scrolling when the user tries to scroll the page manually (e.g. via mouse-wheel or touch-swipe)',
					'wrapper' => 'fieldset'
				),
				'autoCorrectScroll' => array(
					'value' => $v26,
					'values' => null,
					'id' => $this->db_prefix.$i.'_autoCorrectScroll',
					'field_type' => 'checkbox',
					'label' => '',
					'checkbox_label' => 'Verify target position and readjust scrolling (if necessary), after scrolling animation is complete',
					'radio_labels' => null,
					'field_info' => null,
					'description' => null,
					'wrapper' => 'fieldset'
				),
				'autoCorrectScrollExtend' => array(
					'value' => $v33,
					'values' => null,
					'id' => $this->db_prefix.$i.'_autoCorrectScrollExtend',
					'field_type' => 'checkbox',
					'label' => '',
					'checkbox_label' => 'Extend target position verification and scrolling adjustment for lazy-load scripts (images, iframes etc.) and changes in document\'s length',
					'radio_labels' => null,
					'field_info' => null,
					'description' => null,
					'wrapper' => 'fieldset'
				),
				'layout' => array(
					'value' => $v6,
					'values' => 'vertical,horizontal,auto',
					'id' => $this->db_prefix.$i.'_layout',
					'field_type' => 'radio',
					'label' => 'Page layout',
					'checkbox_label' => null,
					'radio_labels' => 'vertical|horizontal|auto',
					'field_info' => null,
					'description' => 'Restrict page scrolling to top-bottom (vertical) or left-right (horizontal) accordingly. For both vertical and horizontal scrolling select <code>auto</code> <br /><small>Please note that "Layout" option does not transform your theme&#8217;s templates layout (i.e. it won&#8217;t change your theme/page design from vertical to horizontal).</small>',
					'wrapper' => 'fieldset'
				),
				'offset' => array(
					'value' => $v7,
					'values' => null,
					'id' => $this->db_prefix.$i.'_offset',
					'field_type' => 'text',
					'label' => 'Offset',
					'checkbox_label' => null,
					'radio_labels' => null,
					'field_info' => 'pixels',
					'description' => 'Offset scroll-to position by x amount of pixels (positive or negative) or by <a href="https://www.w3.org/TR/css3-selectors/" target="_blank">selector</a> (e.g. <code>#navigation-menu</code>)',
					'wrapper' => null
				),
				'dummyOffset' => array(
					'value' => $v30,
					'values' => null,
					'id' => $this->db_prefix.$i.'_dummyOffset',
					'field_type' => 'checkbox',
					'label' => '',
					'checkbox_label' => 'Auto-generate <code>#ps2id-dummy-offset</code> element',
					'radio_labels' => null,
					'field_info' => null,
					'description' => 'Enable if you want the plugin to create a hidden element and use its selector as offset. The element that will be created is: <code>#ps2id-dummy-offset</code> <br /><small>You should use the <code>#ps2id-dummy-offset</code> value in the <b>Offset</b> option above. You should then use the same selector/value and in your CSS and give it a height equal to the amount of offset you want.</small>',
					'wrapper' => 'fieldset'
				),
				'highlightSelector' => array(
					'value' => $v8,
					'values' => null,
					'id' => $this->db_prefix.$i.'_highlightSelector',
					'field_type' => 'text',
					'label' => 'Highlight selector(s)',
					'checkbox_label' => null,
					'radio_labels' => null,
					'field_info' => null,
					'description' => 'Set the links (in the form of <a href="https://www.w3.org/TR/css3-selectors/" target="_blank">CSS selectors</a>) that will be eligible for highlighting (leave empty to highlight all)',
					'wrapper' => null
				),
				'clickedClass' => array(
					'value' => $v9,
					'values' => null,
					'id' => $this->db_prefix.$i.'_clickedClass',
					'field_type' => 'text',
					'label' => 'Classes &amp; highlight options',
					'checkbox_label' => null,
					'radio_labels' => null,
					'field_info' => 'class name',
					'description' => 'Class of the clicked link. You can use this class (e.g. <code>.mPS2id-clicked</code>) in your CSS to style the clicked link.',
					'wrapper' => null
				),
				'targetClass' => array(
					'value' => $v10,
					'values' => null,
					'id' => $this->db_prefix.$i.'_targetClass',
					'field_type' => 'text',
					'label' => '',
					'checkbox_label' => null,
					'radio_labels' => null,
					'field_info' => 'class name',
					'description' => 'Class of the (current) target element. You can use this class (e.g. <code>.mPS2id-target</code>) in your CSS to style the highlighted target element(s). <br />If multiple elements are highlighted, you can use the <code>-first</code> or <code>-last</code> suffix in the class name (e.g. <code>.mPS2id-target-first</code>, <code>.mPS2id-target-last</code>) to style the first or last highlighted element accordingly',
					'wrapper' => null
				),
				'highlightClass' => array(
					'value' => $v11,
					'values' => null,
					'id' => $this->db_prefix.$i.'_highlightClass',
					'field_type' => 'text',
					'label' => '',
					'checkbox_label' => null,
					'radio_labels' => null,
					'field_info' => 'class name',
					'description' => 'Class of the (current) highlighted link. You can use this class (e.g. <code>.mPS2id-highlight</code>) in your CSS to style the highlighted link(s). <br />If multiple links are highlighted, you can use the <code>-first</code> or <code>-last</code> suffix in the class name (e.g. <code>.mPS2id-highlight-first</code>, <code>.mPS2id-highlight-last</code>) to style the first or last highlighted links accordingly',
					'wrapper' => null
				),
				'forceSingleHighlight' => array(
					'value' => $v12,
					'values' => null,
					'id' => $this->db_prefix.$i.'_forceSingleHighlight',
					'field_type' => 'checkbox',
					'label' => '',
					'checkbox_label' => 'Allow only one highlighted element at a time',
					'radio_labels' => null,
					'field_info' => null,
					'description' => null,
					'wrapper' => 'fieldset'
				),
				'keepHighlightUntilNext' => array(
					'value' => $v14,
					'values' => null,
					'id' => $this->db_prefix.$i.'_keepHighlightUntilNext',
					'field_type' => 'checkbox',
					'label' => '',
					'checkbox_label' => 'Keep the current element highlighted until the next one comes into view (i.e. always keep at least one element highlighted)',
					'radio_labels' => null,
					'field_info' => null,
					'description' => null,
					'wrapper' => 'fieldset'
				),
				'highlightByNextTarget' => array(
					'value' => $v16,
					'values' => null,
					'id' => $this->db_prefix.$i.'_highlightByNextTarget',
					'field_type' => 'checkbox',
					'label' => '',
					'checkbox_label' => 'Highlight by next target',
					'radio_labels' => null,
					'field_info' => null,
					'description' => 'Set targets length according to their next adjacent target position (useful when target elements have zero dimensions)',
					'wrapper' => 'fieldset'
				),
				'appendHash' => array(
					'value' => $v22,
					'values' => null,
					'id' => $this->db_prefix.$i.'_appendHash',
					'field_type' => 'checkbox',
					'label' => 'Links behavior',
					'checkbox_label' => 'Append the clicked link&#8217;s hash value (e.g. <code>#id</code>) to browser&#8217;s URL/address bar',
					'radio_labels' => null,
					'field_info' => null,
					'description' => null,
					'wrapper' => 'fieldset'
				),
				'scrollToHash' => array(
					'value' => $v13,
					'values' => null,
					'id' => $this->db_prefix.$i.'_scrollToHash',
					'field_type' => 'checkbox',
					'label' => '',
					'checkbox_label' => 'Scroll from/to different pages (i.e. scroll to target when page loads)',
					'radio_labels' => null,
					'field_info' => null,
					'description' => null,
					'wrapper' => 'fieldset'
				),
				'scrollToHashForAll' => array(
					'value' => $v17,
					'values' => null,
					'id' => $this->db_prefix.$i.'_scrollToHashForAll',
					'field_type' => 'checkbox',
					'label' => '',
					'checkbox_label' => 'Enable different pages scrolling on all links (even the ones that are not handled by the plugin)',
					'radio_labels' => null,
					'field_info' => null,
					'description' => null,
					'wrapper' => 'fieldset'
				),
				'scrollToHashDelay' => array(
					'value' => $v18,
					'values' => null,
					'id' => $this->db_prefix.$i.'_scrollToHashDelay',
					'field_type' => 'text-integer',
					'label' => '',
					'checkbox_label' => null,
					'radio_labels' => null,
					'field_info' => 'milliseconds delay for scrolling to target on page load',
					'description' => null,
					'wrapper' => null
				),
				'scrollToHashUseElementData' => array(
					'value' => $v27,
					'values' => null,
					'id' => $this->db_prefix.$i.'_scrollToHashUseElementData',
					'field_type' => 'checkbox',
					'label' => '',
					'checkbox_label' => 'Use element&apos;s custom offset (if it exists) when scrolling from/to different pages.',
					'radio_labels' => null,
					'field_info' => null,
					'description' => null,
					'wrapper' => 'fieldset'
				),
				'scrollToHashRemoveUrlHash' => array(
					'value' => $v28,
					'values' => null,
					'id' => $this->db_prefix.$i.'_scrollToHashRemoveUrlHash',
					'field_type' => 'checkbox',
					'label' => '',
					'checkbox_label' => 'Remove URL hash (i.e. the <code>#some-id</code> part in browser&apos;s address bar) when scrolling from/to different pages.',
					'radio_labels' => null,
					'field_info' => null,
					'description' => null,
					'wrapper' => 'fieldset'
				),
				'disablePluginBelow' => array(
					'value' => $v15,
					'values' => null,
					'id' => $this->db_prefix.$i.'_disablePluginBelow',
					'field_type' => 'text',
					'label' => 'Disable plugin below',
					'checkbox_label' => null,
					'radio_labels' => null,
					'field_info' => 'screen-size',
					'description' => 'Set the width,height screen-size (in pixels), below which the plugin will be disabled (e.g. <code>1024</code> or <code>1024,600</code>)',
					'wrapper' => null
				),
				'adminDisplayWidgetsId' => array(
					'value' => $v20,
					'values' => null,
					'id' => $this->db_prefix.$i.'_adminDisplayWidgetsId',
					'field_type' => 'checkbox',
					'label' => 'Administration',
					'checkbox_label' => 'Display widgets id attribute',
					'radio_labels' => null,
					'field_info' => null,
					'description' => 'Show the id attribute of each widget in Appearance &rarr; Widgets',
					'wrapper' => 'fieldset'
				),
				'adminTinyMCEbuttons' => array(
					'value' => $v21,
					'values' => null,
					'id' => $this->db_prefix.$i.'_adminTinyMCEbuttons',
					'field_type' => 'checkbox',
					'label' => '',
					'checkbox_label' => 'Enable insert link/target buttons in post visual editor',
					'radio_labels' => null,
					'field_info' => null,
					'description' => '<small>Requires WordPress version 3.9 or higher</small>',
					'wrapper' => 'fieldset'
				),
				'unbindUnrelatedClickEvents' => array(
					'value' => $v23,
					'values' => null,
					'id' => $this->db_prefix.$i.'_unbindUnrelatedClickEvents',
					'field_type' => 'checkbox',
					'label' => 'Advanced options',
					'checkbox_label' => 'Prevent other scripts from handling plugin&#8217;s links (if possible)',
					'radio_labels' => null,
					'field_info' => null,
					'description' => 'Enable if another plugin or a theme script handles page scrolling and conflicts with "Page scroll to id" (removes other scripts js click events from the links)',
					'wrapper' => 'fieldset'
				),
				'unbindUnrelatedClickEventsSelector' => array(
					'value' => $v34,
					'values' => null,
					'id' => $this->db_prefix.$i.'_unbindUnrelatedClickEventsSelector',
					'field_type' => 'text',
					'label' => '',
					'checkbox_label' => null,
					'radio_labels' => null,
					'field_info' => null,
					'description' => 'Prevent other scripts from handling plugin&#8217;s links selector(s) <br /><small>Requires PHP version 5.3 or higher</small>',
					'wrapper' => null
				),
				'normalizeAnchorPointTargets' => array(
					'value' => $v25,
					'values' => null,
					'id' => $this->db_prefix.$i.'_normalizeAnchorPointTargets',
					'field_type' => 'checkbox',
					'label' => '',
					'checkbox_label' => 'Normalize anchor-point targets',
					'radio_labels' => null,
					'field_info' => null,
					'description' => 'Force zero dimensions (via CSS) on targets created with <code>[ps2id]</code> shortcode',
					'wrapper' => 'fieldset'
				),
				'encodeLinks' => array(
					'value' => $v31,
					'values' => null,
					'id' => $this->db_prefix.$i.'_encodeLinks',
					'field_type' => 'checkbox',
					'label' => '',
					'checkbox_label' => 'Encode unicode characters on links URL',
					'radio_labels' => null,
					'field_info' => null,
					'description' => 'Enable if you have links that have encoded unicode characters (e.g. on internationalized domain names) in their URL',
					'wrapper' => 'fieldset'
				)
			);
		}
		
	}

}

if(class_exists('malihuPageScroll2id')){ // --edit--
	
	// tinyMCE class --edit--
	require_once(plugin_dir_path( __FILE__ ).'includes/class-malihu-pagescroll2id-tinymce.php');
	
	malihuPageScroll2id::get_instance(); // --edit--
	
	// Widget class --edit--
	require_once(plugin_dir_path( __FILE__ ).'includes/class-malihu-pagescroll2id-widget.php');

	// plugin notice class (see also admin.php and admin.css for settings page banner) --edit--
	require_once(plugin_dir_path( __FILE__ ).'includes/ps2id-plugin-admin-notice.php');

}
?>