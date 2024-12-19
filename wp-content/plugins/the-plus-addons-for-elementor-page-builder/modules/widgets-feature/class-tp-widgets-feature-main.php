<?php
/**
 * The file that defines the core plugin class
 *
 * @link       https://posimyth.com/
 * @since      5.6.7
 *
 * @package    the-plus-addons-for-elementor-page-builder
 */

/**
 * Exit if accessed directly.
 * */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'TP_Widgets_Feature_Main' ) ) {

	/**
	 * It is Main Class for load all widet feature.
	 *
	 * @since 5.6.7
	 */
	class TP_Widgets_Feature_Main {

		/**
		 * Member Variable
		 *
		 * @var instance
		 */private static $instance;
		

		/**
		 *  Initiator
		 *
		 *  @since 5.6.7
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
		 * @since 5.6.7
		 */
		public function __construct() {
			$this->tp_get_widgets();
		}

		/**
		 * Manage Widget feature ajax.
		 *
		 * @since 5.6.7
		 */
		public function tp_get_widgets() {

			$elements = l_theplus_get_option( 'general', 'check_elements' );

			if ( ! empty( $elements ) ) {

				if( in_array( 'tp_plus_form', $elements ) ){
					require_once L_THEPLUS_PATH . "modules/widgets-feature/class-tp-form-handler.php";
				}

				foreach ( $elements as $key => $value ) {
					if( 'tp_blog_listout' === $value ) {
						require_once L_THEPLUS_PATH . "modules/widgets-feature/class-tp-load-more.php";
				    }
				}
			}
		}
	}

	return TP_Widgets_Feature_Main::get_instance();
}
