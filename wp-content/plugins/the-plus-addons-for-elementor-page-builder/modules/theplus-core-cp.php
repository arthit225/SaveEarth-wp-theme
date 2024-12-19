<?php
namespace TheplusAddons;
use Elementor\Utils;

if ( ! defined( 'WPINC' ) ) {
	die;
}
if ( ! class_exists( 'Theplus_Core_Cp_Lite' ) ) {

	/**
	 * Define Theplus_Core_Cp_Lite class
	 */
	class Theplus_Core_Cp_Lite {

		/**
		 * A reference to an instance of this class.
		 *
		 * @since 5.0.6
		 * @var   object
		 */
		private static $instance = null;

		/**
		 * Initalize integration hooks
		 *
		 * @return void
		 */
		public function init() {
			$plus_extras=l_theplus_get_option('general','extras_elements');
			if(!empty($plus_extras) && in_array('plus_cross_cp',$plus_extras)){
				add_action( 'elementor/editor/before_enqueue_scripts', array( $this, 'enqueue_editor_cp_scripts' ), 98 );
				require_once L_THEPLUS_PATH . 'modules/theplus-cross-copy-paste.php';
			}
		}
		
		
		/**
		 * Load required js on before enqueue widget JS.
		 *
		 * @since 5.0.6
		 */
		public function enqueue_editor_cp_scripts() {
			wp_enqueue_script(
				'plus-xdstorage-cp',
				L_THEPLUS_ASSETS_URL .'js/extra/xdlocalstorage.js',
				null,
				L_THEPLUS_VERSION,
				true
			);

			wp_enqueue_script(
				'plus-cross-cp',
				L_THEPLUS_ASSETS_URL .'js/main/cross-cp/plus-cross-cp.js',
				array( 'jquery', 'elementor-editor', 'plus-xdstorage-cp' ),
				L_THEPLUS_VERSION,
				true
			);
			wp_localize_script(
			'jquery',
				'theplus_cross_cp',
				array(
					'ajax_url' => admin_url( 'admin-ajax.php' ),
					'nonce'    => wp_create_nonce( 'plus_cross_cp_import' ),
				)
			);
		}

		/**
		 * Returns the instance.
		 *
		 * @since  5.0.6
		 * @return object
		 */
		public static function get_instance( $shortcodes = array() ) {
			
			if ( null == self::$instance ) {
				self::$instance = new self( $shortcodes );
			}
			return self::$instance;
		}
	}
}

/**
 * Returns instance of Theplus_Core_Cp_Lite
 *
 * @return object
 */
function theplus_core_cp_lite() {
	return Theplus_Core_Cp_Lite::get_instance();
}