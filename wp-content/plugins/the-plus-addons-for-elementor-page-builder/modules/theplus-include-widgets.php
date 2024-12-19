<?php
/**
 * The file store Database Default Entry
 *
 * @link       https://posimyth.com/
 * @since      5.6.7
 *
 * @package    the-plus-addons-for-elementor-page-builder
 */

namespace TheplusAddons;

/**Exit if accessed directly.*/
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'L_Theplus_Widgets_Include' ) ) {

	/**
	 * Define L_Theplus_Widgets_Include class
	 */
	class L_Theplus_Widgets_Include {
		
		/**
		 * A reference to an instance of this class.
		 *
		 * @since 1.0.0
		 * @var   object
		 */
		private static $instance = null;

		/**
		 * Returns the instance.
		 *
		 * @since  1.0.0
		 * @return object
		 */
		public static function get_instance( $shortcodes = array() ) {

			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self( $shortcodes );
			}
			return self::$instance;
		}

		/**
		 * ThePlus_Load constructor.
		 */
		public function __construct() {
			
			$this->required_fiels();
			l_theplus_generator()->init();
			l_theplus_library();

			if(!defined('THEPLUS_VERSION')){
				$this->init();
				l_theplus_wpml_translate();
			}
		}

		/**
		 * Initalize integration hooks
		 *
		 * @return void
		 */
		public function init() {
			add_action( 'elementor/widgets/register', array($this, 'add_widgets' ) );
		}

		/**
		* Widget Include required files
		*
		* @since 6.0.0
		*/
		public function required_fiels() {	
			require_once L_THEPLUS_PATH.'modules/enqueue/plus-widgets-manager.php';
			require_once L_THEPLUS_PATH.'modules/enqueue/plus-library.php';
			require_once L_THEPLUS_PATH.'modules/enqueue/plus-generator.php';

			if(!defined('THEPLUS_VERSION')){
				require_once L_THEPLUS_PATH.'modules/enqueue/plus-wpml.php';
			}
		}

		/**
		 * Add new controls.
		 *
		 * @param  object $widgets_manager Controls manager instance.
		 * @return void
		 */		
		public function add_widgets( $widgets_manager ) {

			$grouped = array(
				'theplus-widgets' => '\TheplusAddons\Widgets\L_Theplus_Elements_Widgets',
				'tp_smooth_scroll' => '\TheplusAddons\Widgets\L_ThePlus_Smooth_Scroll',
				'tp_accordion' => '\TheplusAddons\Widgets\L_ThePlus_Accordion',
				'tp_adv_text_block' => '\TheplusAddons\Widgets\L_ThePlus_Adv_Text_Block',
				'tp_age_gate' => '\TheplusAddons\Widgets\L_ThePlus_Age_Gate',
				'tp_blockquote' => '\TheplusAddons\Widgets\L_ThePlus_Block_Quote',
				'tp_blog_listout' => '\TheplusAddons\Widgets\L_ThePlus_Blog_ListOut',
				'tp_button' => '\TheplusAddons\Widgets\L_ThePlus_Button',
				'tp_caldera_forms' => '\TheplusAddons\Widgets\L_ThePlus_Caldera_Forms',
				'tp_clients_listout' => '\TheplusAddons\Widgets\L_ThePlus_Clients_ListOut',
				'tp_contact_form_7' => '\TheplusAddons\Widgets\L_ThePlus_Contact_Form_7',
				'tp_countdown' => '\TheplusAddons\Widgets\L_ThePlus_Countdown',
				'tp_carousel_anything' => '\TheplusAddons\Widgets\L_ThePlus_Carousel_Anything',
				'tp_dark_mode' => '\TheplusAddons\Widgets\L_ThePlus_Dark_Mode',
				'tp_dynamic_categories' => '\TheplusAddons\Widgets\L_ThePlus_Dynamic_Categories',
				'tp_everest_form' => '\TheplusAddons\Widgets\L_ThePlus_Everest_form',
				'tp_plus_form' => '\TheplusAddons\Widgets\L_ThePlus_Plus_Form',
				'tp_flip_box' => '\TheplusAddons\Widgets\L_ThePlus_Flip_Box',
				'tp_gallery_listout' => '\TheplusAddons\Widgets\L_ThePlus_Gallery_ListOut',
				'tp_gravity_form' => '\TheplusAddons\Widgets\L_ThePlus_Gravity_Form',
				'tp_heading_animation' => '\TheplusAddons\Widgets\L_ThePlus_Heading_Animation',
				'tp_header_extras' => '\TheplusAddons\Widgets\L_ThePlus_Header_Extras',
				'tp_heading_title' => '\TheplusAddons\Widgets\L_Theplus_Ele_Heading_Title',
				'tp_hovercard' => '\TheplusAddons\Widgets\L_ThePlus_Hovercard',
				'tp_info_box' => '\TheplusAddons\Widgets\L_ThePlus_Info_Box',
				'tp_meeting_scheduler' => '\TheplusAddons\Widgets\L_ThePlus_Meeting_Scheduler',
				'tp_messagebox' => '\TheplusAddons\Widgets\L_ThePlus_MessageBox',
				'tp_navigation_menu_lite' => '\TheplusAddons\Widgets\L_ThePlus_Navigation_Menu_Lite',
				'tp_ninja_form' => '\TheplusAddons\Widgets\L_ThePlus_Ninja_form',
				'tp_number_counter' => '\TheplusAddons\Widgets\L_ThePlus_Number_Counter',
				'tp_post_title' => '\TheplusAddons\Widgets\L_ThePlus_Post_Title',				
				'tp_post_content' => '\TheplusAddons\Widgets\L_ThePlus_Post_Content',
				'tp_post_featured_image' => '\TheplusAddons\Widgets\L_ThePlus_Featured_Image',
				'tp_post_meta' => '\TheplusAddons\Widgets\L_ThePlus_Post_Meta',
				'tp_post_author' => '\TheplusAddons\Widgets\L_ThePlus_Post_Author',
				'tp_post_comment' => '\TheplusAddons\Widgets\L_ThePlus_Post_Comment',
				'tp_post_navigation' => '\TheplusAddons\Widgets\L_ThePlus_Post_Navigation',
				'tp_page_scroll' => '\TheplusAddons\Widgets\L_ThePlus_Page_Scroll',
				'tp_pricing_table' => '\TheplusAddons\Widgets\L_ThePlus_Pricing_Table',
				'tp_post_search' => '\TheplusAddons\Widgets\L_ThePlus_Post_Search',
				'tp_progress_bar' => '\TheplusAddons\Widgets\L_ThePlus_Progress_Bar',
				'tp_process_steps' => '\TheplusAddons\Widgets\L_ThePlus_Process_Steps',
				'tp_scroll_navigation' => '\TheplusAddons\Widgets\L_ThePlus_Scroll_Navigation',
				'tp_social_icon' => '\TheplusAddons\Widgets\L_ThePlus_Social_Icon',
				'tp_social_embed' => '\TheplusAddons\Widgets\L_ThePlus_Social_Embed',
				'tp_syntax_highlighter' => '\TheplusAddons\Widgets\L_ThePlus_Syntax_Highlighter',
				'tp_style_list' => '\TheplusAddons\Widgets\L_ThePlus_Style_List',
				'tp_switcher' => '\TheplusAddons\Widgets\L_ThePlus_Switcher',
				'tp_tabs_tours' => '\TheplusAddons\Widgets\L_ThePlus_Tabs_Tours',
				'tp_team_member_listout' => '\TheplusAddons\Widgets\L_ThePlus_Team_Member_ListOut',
				'tp_testimonial_listout' => '\TheplusAddons\Widgets\L_ThePlus_Testimonial_ListOut',
				'tp_table' => '\TheplusAddons\Widgets\L_ThePlus_Data_Table',
				'tp_video_player' => '\TheplusAddons\Widgets\L_ThePlus_Video_Player',				
				'tp_wp_forms' => '\TheplusAddons\Widgets\L_ThePlus_Wp_Forms',
			);
			
			$get_option=l_theplus_get_option('general','check_elements');
			if(!empty($get_option)){
				array_push($get_option, "theplus-widgets");				
				foreach ( $grouped as $widget_id => $class_name ) {
					if(in_array($widget_id,$get_option)){
						if ( $this->include_widget( $widget_id, true ) ) {
							$widgets_manager->register( new $class_name() );
						}
					}
				}
			}
		}
		
		
		/**
		 * Include control file by class name.
		 *
		 * @param  [type] $class_name [description]
		 * @return [type]             [description]
		 */
		public function include_widget( $widget_id, $grouped = false ) {

			$filename = sprintf('modules/widgets/'.$widget_id.'.php');

			if ( ! file_exists( L_THEPLUS_PATH.$filename ) ) {
				return false;
			}

			require L_THEPLUS_PATH.$filename;

			return true;
		}
	}

	L_Theplus_Widgets_Include::get_instance();
}