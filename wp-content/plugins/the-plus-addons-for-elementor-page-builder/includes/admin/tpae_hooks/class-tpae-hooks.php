<?php
/**
 * The file store Database Default Entry
 *
 * @link        https://posimyth.com/
 * @since       6.0.0
 *
 * @package     the-plus-addons-for-elementor-page-builder
 */

/**Exit if accessed directly.*/
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Tpae_Hooks' ) ) {

	/**
	 * Tpae_Hooks
	 *
	 * @since 6.0.0
	 */
	class Tpae_Hooks {

		/**
		 * Member Variable
		 *
		 * @var instance
		 */
		private static $instance;

		/**
		 * Member Variable
		 *
		 * @var global_setting
		 */
		public $global_setting = array();

		/**
		 *  Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Define the core functionality of the plugin.
		 *
		 * @since 6.0.0
		 */
		public function __construct() {

			add_action( 'tpae_db_default', array( $this, 'tpae_db_default' ), 10 );
			add_filter( 'tpae_get_post_type', array( $this, 'tpae_get_post_type' ), 10, 2 );
		}

		/**
		 * Create Default widget entry
		 *
		 * @since 6.0.0
		 */
		public function tpae_db_default() {

			// Get Widget List.
			$default_load = get_option( 'theplus_options' );
			if ( empty( $default_load ) ) {
				$theplus_options['check_elements']  = array( 'tp_accordion', 'tp_adv_text_block', 'tp_blockquote', 'tp_blog_listout', 'tp_button', 'tp_contact_form_7', 'tp_countdown', 'tp_clients_listout', 'tp_gallery_listout', 'tp_flip_box', 'tp_heading_animation', 'tp_header_extras', 'tp_heading_title', 'tp_info_box', 'tp_navigation_menu_lite', 'tp_page_scroll', 'tp_progress_bar', 'tp_number_counter', 'tp_pricing_table', 'tp_scroll_navigation', 'tp_social_icon', 'tp_tabs_tours', 'tp_team_member_listout', 'tp_testimonial_listout', 'tp_video_player' );
				$theplus_options['extras_elements'] = array();

				add_option( 'theplus_options', $theplus_options, '', 'on' );
			}else{
				if ( ! is_array( $default_load['check_elements'] ) || ! is_array( $default_load['extras_elements'] ) ) {
					$theplus_options['check_elements'] = is_array( $default_load['check_elements'] ) ? $default_load['check_elements'] : array();
					$theplus_options['extras_elements'] = is_array( $default_load['extras_elements'] ) ? $default_load['extras_elements'] : array();

					update_option( 'theplus_options', $theplus_options, '', 'on' );
				}
            }

			// Get Listing Data.
			$get_listing_data = get_option( 'post_type_options' );
			if ( empty( $get_listing_data ) ) {
				$def_listing_data = array(
					'client_post_type'      => 'disable',
					'testimonial_post_type' => 'disable',
					'team_member_post_type' => 'disable',
				);

				add_option( 'post_type_options', $def_listing_data, '', 'on' );
			}

			// Get custom css & js.
			$get_styling_data = get_option( 'theplus_styling_data' );
			if ( empty( $get_styling_data ) ) {
				$def_styling_data = array(
					'tp_styling_hidden'         => 'hidden',
					'theplus_custom_css_editor' => '',
					'theplus_custom_js_editor'  => '',
				);

				add_option( 'theplus_styling_data', $def_styling_data, '', 'on' );
			}

			$get_theplus_performance = get_option( 'theplus_performance' );
			if ( empty( $get_theplus_performance ) ) {
				$set_theplus_performance = array(
					'plus_cache_option' => 'separate',
				);

				add_option( 'theplus_performance', $set_theplus_performance, '', 'on' );
			}

			// Set Extra Option.
			$get_extra_option = get_option( 'theplus_api_connection_data' );
			if ( empty( $get_extra_option ) ) {
				$set_extra_option = array(
					'plus_lazyload_opt'                  => 'disable',
					'plus_lazyload_opt_anim'             => 'fade',
					'theplus_facebook_app_id'            => '',
					'load_icons_mind'                    => 'disable',
					'gmap_api_switch'                    => 'enable',
					'load_pre_loader_func'               => 'disable',
					'scroll_animation_offset'            => 85,
					'theplus_site_key_recaptcha'         => '',
					'theplus_secret_key_recaptcha'       => '',
					'theplus_facebook_app_secret'        => '',
					'theplus_google_client_id'           => '',
					'theplus_google_analytics_id'        => '',
					'theplus_facebook_pixel_id'          => '',
					'load_icons_mind_ids'                => '',
					'theplus_google_map_api'             => '',
					'theplus_mailchimp_api'              => '',
					'theplus_mailchimp_id'               => '',
					'load_pre_loader_lottie_js'          => 'on',
					'load_pre_loader_func_ids'           => '',
					'dynamic_category_thumb_check'       => 'on',
					'theplus_woo_swatches_switch'        => 'on',
					'theplus_custom_field_video_switch'  => 'on',
					'theplus_woo_recently_viewed_switch' => 'on',
					'theplus_woo_countdown_switch'       => 'on',
					'theplus_woo_thank_you_page_select'  => '2',
					'bodymovin_load_js_check'            => 'on',
				);

				add_option( 'theplus_api_connection_data', $set_extra_option, '', 'on' );
			}
		}

		/**
		 * Create for the get Post types
		 *
		 * @since 6.0.0
		 */
		public function tpae_get_post_type( $post_type, $name ) {

			$get_post_type = get_option( 'post_type_options' );

			$values = '';
			if ( 'post_type' === $post_type ) {
				if ( isset( $get_post_type[ $name ] ) && ! empty( $get_post_type[ $name ] ) ) {
					$values = $get_post_type[ $name ];
				}
			}

			return $values;
		}
	}

	Tpae_Hooks::get_instance();
}
