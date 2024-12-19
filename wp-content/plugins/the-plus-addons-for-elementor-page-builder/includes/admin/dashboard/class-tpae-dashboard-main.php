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

if ( ! class_exists( 'Tpae_Dashboard_Main' ) ) {

	/**
	 * Tpae_Dashboard_Main
	 *
	 * @since 6.0.0
	 */
	class Tpae_Dashboard_Main {

		/**
		 * Member Variable
		 *
		 * @var instance
		 */
		private static $instance;

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
			$this->tpae_dashboard_main();
		}

		/**
		 * Dashboard Build File loaded.
		 *
		 * @since 6.0.0
		 */
		public function tpae_dashboard_main() {

			if( is_admin() && is_user_logged_in() && current_user_can( 'manage_options' ) ){
				include L_THEPLUS_PATH . 'includes/admin/dashboard/class-tpae-dashboard-ajax.php';
			}

			include L_THEPLUS_PATH . 'includes/admin/dashboard/class-tpae-dashboard-meta.php';
			include L_THEPLUS_PATH . 'includes/admin/dashboard/class-tpae-dashboard-listing.php';
		}
	}

	Tpae_Dashboard_Main::get_instance();
}
