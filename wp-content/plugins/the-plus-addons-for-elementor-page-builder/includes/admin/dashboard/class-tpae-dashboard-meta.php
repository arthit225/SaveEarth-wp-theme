<?php
/**
 * The file store Database Default Entry
 *
 * @link       https://posimyth.com/
 * @since      6.0.0
 *
 * @package    the-plus-addons-for-elementor-page-builder
 */

/**Exit if accessed directly.*/
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Tpae_Dashboard_Meta' ) ) {

	/**
	 * Tpae_Dashboard_Meta
	 *
	 * @since 6.0.0
	 */
	class Tpae_Dashboard_Meta {

		/**
		 * Member Variable
		 *
		 * @var instance
		 */
		private static $instance;

		/**
		 * Option key, and option page slug
		 *
		 * @var string
		 */
		private $key = 'theplus_options';

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
			if ( current_user_can( 'manage_options' ) ) {
				add_action( 'admin_menu', array( $this, 'tpae_add_dashboard_menu' ) );
				add_action( 'admin_enqueue_scripts', array( $this, 'tpae_enqueue_scripts' ) );
			}
		}

		/**
		 * Dashboard Build File loaded.
		 *
		 * @since 6.0.0
		 *
		 * @param string $page use for check page type.
		 */
		public function tpae_enqueue_scripts( $page ) {

			if ( 'toplevel_page_theplus_welcome_page' === $page ) {
				wp_enqueue_script( 'tpae-db-build', L_THEPLUS_URL . 'build/index.js', array( 'wp-i18n', 'wp-element', 'wp-components' ), L_THEPLUS_VERSION, true );
				wp_localize_script(
					'tpae-db-build',
					'tpae_db_object',
					array(
						'ajax_url'        => admin_url( 'admin-ajax.php' ),
						'nonce'           => wp_create_nonce( 'tpae-db-nonce' ),
						'tpae_nonce_old'  => wp_create_nonce( 'theplus-addons' ),
						'tpae_url'        => L_THEPLUS_URL,
						'tpae_version'    => defined( 'THEPLUS_VERSION' ) ? THEPLUS_VERSION : L_THEPLUS_VERSION,
						'tpae_wdkit_url'  => L_THEPLUS_WDKIT_URL,
						'tpae_wp_version' => get_bloginfo( 'version' ),
						'tpae_pro'        => defined( 'THEPLUS_VERSION' ) ? 1 : 0,
						'tpae_whitelabel' => get_option( 'theplus_white_label' ),
					)
				);

				wp_set_script_translations( 'tpae-db-build', 'tpebl' );

				wp_enqueue_style( 'tpae-db-build', L_THEPLUS_URL . 'build/index.css', array(), L_THEPLUS_VERSION, 'all' );
			}
		}

		/**
		 * Dashboard Build File loaded.
		 *
		 * @since 6.0.0
		 */
		public function tpae_add_dashboard_menu() {

			$setting_name = esc_html__( 'The Plus Addons', 'tpebl' );
			if ( defined( 'THEPLUS_VERSION' ) ) {
				$options = get_option( 'theplus_white_label' );

				$setting_name = ! empty( $options['tp_plugin_name'] ) ? $options['tp_plugin_name'] : __( 'ThePlus Addons', 'tpebl' );
			}

			add_menu_page( $setting_name, $setting_name, 'manage_options', 'theplus_welcome_page', array( $this, 'tpae_admin_page_display' ), 'dashicons-plus-settings', 67.1 );

			if ( ! defined( 'THEPLUS_VERSION' ) ) {
				add_submenu_page( 'theplus_welcome_page', esc_html__( 'Upgrade Now', 'tpebl' ), esc_html__( 'Upgrade Now', 'tpebl' ), 'manage_options', esc_url( 'https://theplusaddons.com/pricing?utm_source=wpbackend&utm_medium=dashboard&utm_campaign=plussettings' ) );
			}

			add_action( 'admin_footer', array( $this, 'tpae_link_in_new_tab' ) );

			// Hook to modify the submenu head title.
			add_action( 'admin_menu', array( $this, 'tpae_submenu_head_title' ), 101 );
		}

		/**
		 * Parent Page Rename in Sub menu.
		 *
		 * @since 6.0.0
		 */
		public function tpae_submenu_head_title() {
			global $submenu;

			if ( isset( $submenu['theplus_welcome_page'] ) ) {
				$submenu['theplus_welcome_page'][0][0] = esc_html__( 'Dashboard', 'tpebl' );
			}
		}

		/**
		 * Open Link in New Tab WordPress Menu
		 *
		 * @since 6.0.0
		 */
		public function tpae_link_in_new_tab() {
			?>
			<script type="text/javascript">
				document.addEventListener('DOMContentLoaded', function() {
					var upgradeLink = document.querySelector('a[href*="https://theplusaddons.com/pricing"]');
					if ( upgradeLink ) {
						upgradeLink.setAttribute('target', '_blank');
						upgradeLink.setAttribute('rel', 'noopener noreferrer');
					}
				});
			</script>
			<?php
		}

		/**
		 * Add Dashboard HTML with js
		 *
		 * @since 6.0
		 */
		public function tpae_admin_page_display() {
			echo '<div id="theplus-app"></div>';
		}
	}

	Tpae_Dashboard_Meta::get_instance();
}
