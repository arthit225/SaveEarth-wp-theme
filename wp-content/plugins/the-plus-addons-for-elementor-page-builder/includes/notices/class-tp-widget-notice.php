<?php
/**
 * Exit if accessed directly.
 *
 * @link       https://posimyth.com/
 * @since      5.3.3
 *
 * @package    Theplus
 * @subpackage ThePlus/Notices
 * */

namespace Tp\Notices\WidgetNotice;

/**
 * Exit if accessed directly.
 * */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Tp_Widget_Notice' ) ) {

	/**
	 * This class used for only load widget notice
	 *
	 * @since 5.3.3
	 */
	class Tp_Widget_Notice {

		/**
		 * Instance
		 *
		 * @since 5.3.3
		 * @access private
		 * @static
		 * @var instance of the class.
		 */
		private static $instance = null;

		/**
		 * Instance
		 *
		 * Ensures only one instance of the class is loaded or can be loaded.
		 *
		 * @since 5.3.3
		 * @access public
		 * @static
		 * @return instance of the class.
		 */
		public static function instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Constructor
		 *
		 * Perform some compatibility checks to make sure basic requirements are meet.
		 *
		 * @since 5.2.3
		 * @version 5.3.3
		 * @access public
		 */
		public function __construct() {
			// add_action( 'admin_notices', array( $this, 'tp_widget_banner_notice' ) );
			add_action( 'wp_ajax_wb_dismiss_notice', array( $this, 'tp_widget_dismiss_notice' ) );
			add_action( 'admin_notices', array( $this, 'l_theplus_elementor_cache_notice' ) );
			add_action( 'admin_notices', array( $this, 'tpae_dashboard_notice' ) );
		}

		/**
		 * New widget demos link notice
		 *
		 * @since 5.3.1
		 * @version 5.3.3
		 * @access public
		 */
		public function tp_widget_banner_notice() {
			$current_screen_id = get_current_screen()->id;

			if ( get_user_meta( get_current_user_id(), 'tp_dismissed_notice_widget', true ) ) {
				return;
			}

			if ( ! in_array( $current_screen_id, array( 'toplevel_page_tpgb_welcome_page', 'theplus-settings_page_theplus_options', 'edit-clients-listout', 'edit-plus-mega-menu', 'edit-nxt_builder', 'appearance_page_nexter_settings_welcome', 'toplevel_page_wdesign-kit', 'toplevel_page_theplus_welcome_page', 'toplevel_page_elementor', 'edit-elementor_library', 'elementor_page_elementor-system-info', 'dashboard', 'update-core', 'plugins' ), true ) ) {
				return false;
			}

			$ouput          = '';
			$ouput         .= '<div class="notice notice-info is-dismissible tpae-bf-sale" style="display:grid;grid-template-columns: 100px auto;padding-top: 25px; padding-bottom: 22px;border-left-color: #8072fc;margin-left: 0;">';
				$ouput     .= '<div style="display: flex;justify-content: center;flex-direction: row;margin: 0;padding: 0;">';
					$ouput .= '<svg style="background: linear-gradient(to right, #6D68FE, #B446FF);" width="100" height="100" viewBox="0 0 400 408" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd" d="M199.7 71H151.2V197.3H112V210.2H151.2V228.3H164V83.9H199.7C219.3 83.9 235.2 99.8 235.3 119.4V144.2H248.2V119.4C248.1 102 238.7 86 223.6 77.4C216.3 73.2 208.1 71 199.7 71ZM206.1 179.2H193.3V197.3H175.1V210.2H193.3V228.3H206.1V210.2H224.2V197.3H206.1V179.2ZM193.3 116.1H206.1V155.2H332.4V203.7C332.4 212.1 330.2 220.4 326.1 227.6C317.5 242.8 301.4 252.2 284.1 252.3H259.2V239.4H284.1C303.6 239.3 319.5 223.3 319.5 203.7V168.1H175.1V155.2H193.3V116.1ZM248.2 179.2H235.4V323.6H199.7C180.1 323.6 164.1 307.7 164 288.1V263.3H151.2V288.1C151.2 305.5 160.7 321.6 175.8 330.1C183.1 334.3 191.3 336.4 199.7 336.4H248.2V210.2H287.4V197.3H248.2V179.2ZM115.3 155.2H140.2V168.1H115.3C95.8 168.2 79.9 184.2 79.9 203.8V239.4H224.2V252.3H206.1V291.4H193.3V252.3H67V203.8C67 195.4 69.2 187.1 73.3 179.9C81.9 164.7 98 155.3 115.3 155.2Z" fill="white"/><path fill-rule="evenodd" clip-rule="evenodd" d="M163.8 252.1V155H151V252.1H163.8ZM174.9 197.1V210H248V197.1H174.9ZM248 155H175V167.9H248V155ZM247.9 252.1V239.2H174.9V252.1H247.9Z" fill="white"/></svg>';
				$ouput     .= '</div>';

				$ouput          .= '<div style="display: flex;flex-direction: column;margin-left: 15px;justify-content: space-between;">';
					$ouput      .= '<h2 style="margin:0;">' . esc_html__( 'Try out the Horizontal Scroll Widget for Elementor!', 'tpebl' ) . '</h2>';
						$message = sprintf(
							__( 'It comes with lots of animations and effects. Easily create a stunning full-page horizontal scrolling animation to amaze your website visitors', 'tpebl' ),
							'<strong>',
							'</strong>'
						);

						$ouput .= sprintf( '<p style="margin:0 0 2px;">%1$s</p>', $message );

						$ouput     .= '<p style="margin:0;">';
							$ouput .= '<a class="button button-primary" href="' . esc_url( '"https://theplusaddons.com/widgets/elementor-horizontal-scroll/?utm_source=wpbackend&utm_medium=banner&utm_campaign=link' ) . '" target="_blank" rel="noopener noreferrer" style="margin-right:10px;">' . esc_html__( 'Check Demos', 'tpebl' ) . '</a>';
							$ouput .= '<a class="button-dismiss" href="' . esc_url( 'https://etemplates.wdesignkit.com/theplusaddons/widgets/creative-digital-agency/?utm_source=wpbackend&utm_medium=banner&utm_campaign=links' ) . '" target="_blank" rel="noopener noreferrer" style="color: #2271b1;text-decoration: none;font-weight: 500;">' . esc_html__( 'Our Popular Demo', 'tpebl' ) . '</a>';
						$ouput     .= '</p>';
					$ouput         .= '</div>';
				$ouput             .= '</div>';

			$ouput .= '<script>;
				jQuery(document).ready(function ($) {
					$(".tpae-bf-sale.is-dismissible").on("click", ".notice-dismiss", function () {
						$.ajax({
							type: "POST",
							url: ajaxurl,
							data: {
								action: "wb_dismiss_notice",
							},
						});
					});
				});
			</script>';

			echo $ouput;
		}

		/**
		 * Version Update Notice
		 *
		 * @since 5.4.0
		 * @version 5.4.0
		 * @access public
		 */
		public function l_theplus_elementor_cache_notice(){
			if ( is_admin() && defined( 'THEPLUS_VERSION' ) && version_compare( THEPLUS_VERSION, '5.5.3', '<' ) ) {
				echo '<div class="notice notice-error tp-update-notice is-dismissible"><p>' . esc_html__( 'This is major Version Release. That is required to have latest version of The Plus Addons for Elementor Pro 5.5.3 Install Latest version Now.', 'tpebl' ) . '</p></div>';
			}
		}

		/**
		 * Version Update Notice
		 *
		 * @since 6.0.0
		 */
		public function tpae_dashboard_notice(){
			if ( defined( 'THEPLUS_VERSION' ) && version_compare( THEPLUS_VERSION, '6.0.0', '<' ) ) {
				echo '<div class="notice notice-error tp-update-notice is-dismissible"><p>' . esc_html__( 'This is major Version Release. That is required to have latest version of The Plus Addons for Elementor Pro 6.0.0 Install Latest version Now.', 'tpebl' ) . '</p></div>';
			}
		}

		/**
		 * New widget demos link notice
		 *
		 * @since 5.3.1
		 * @version 5.3.3
		 * @access public
		 */
		public function tp_widget_dismiss_notice() {

			if ( ! is_user_logged_in() ) {
				wp_send_json_error( array( 'content' => __( 'Insufficient permissions.', 'tpebl' ) ) );
			}

			update_user_meta( get_current_user_id(), 'tp_dismissed_notice_widget', 1 );

			wp_die();
		}
	}

	Tp_Widget_Notice::instance();
}
