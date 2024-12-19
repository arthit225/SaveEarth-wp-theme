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

if ( ! class_exists( 'Tpae_Preset' ) ) {

	/**
	 * Tpae_Preset
	 *
	 * @since 6.0.0
	 */
	class Tpae_Preset {

		/**
		 * Member Variable
		 *
		 * @var instance
		 */
		private static $instance;

		/**
		 * It is api to get Data
		 *
		 * @var api
		 */
		public $api = 'https://wdesignkit.com/api/wp/widget/preset';

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
			add_action( 'elementor/editor/before_enqueue_scripts', array( $this, 'tpap_preset_css_enqueue' ) );
			add_action( 'elementor/editor/before_enqueue_scripts', array( $this, 'tpap_preset_js_enqueue' ) );

			add_action( 'wp_ajax_tpaep_preset_ajax_call', array( $this, 'tpaep_preset_ajax_call' ) );
		}

		/**
		 * Loded Preset Template Js
		 *
		 * @since 6.0.0
		 */
		public function tpap_preset_js_enqueue() {
			wp_enqueue_script( 'tpae-preset-button', L_THEPLUS_URL . 'assets/js/admin/tp-preset-btn.js', array( 'jquery', 'wp-i18n' ), L_THEPLUS_VERSION, true );
			wp_enqueue_script( 'tpae-preset-popup', L_THEPLUS_URL . 'includes/preset/index.js', array( 'wp-i18n', 'wp-element', 'wp-components' ), L_THEPLUS_VERSION, true );
			wp_localize_script(
				'tpae-preset-popup',
				'tpae_preset_data',
				array(
					'ajax_url' => admin_url( 'admin-ajax.php' ),
					'nonce'    => wp_create_nonce( 'tpae-db-preset' ),
					'tpae_url' => L_THEPLUS_URL,
					'tpae_pro' => defined( 'THEPLUS_VERSION' ) ? 1 : 0,
				)
			);

			wp_set_script_translations( 'tpae-preset-popup', 'tpebl' );
		}

		/**
		 * Loded Preset Template CSS
		 *
		 * @since 6.0.0
		 */
		public function tpap_preset_css_enqueue() {
			wp_enqueue_style( 'tpae-preset-popup', L_THEPLUS_URL . 'includes/preset/index.css', array(), L_THEPLUS_VERSION, false );
		}

		/**
		 * Load the required dependencies for this plugin.
		 *
		 * @since 6.0.0
		 */
		public function tpaep_preset_ajax_call() {

			if ( ! check_ajax_referer( 'tpae-db-preset', 'nonce', false ) ) {

				$response = $this->tpae_set_response( false, 'Invalid nonce.', 'The security check failed. Please refresh the page and try again.' );

				wp_send_json( $response );
				wp_die();
			}

			if ( ! is_user_logged_in() || ! current_user_can( 'manage_options' ) ) {
				$response = $this->tpae_set_response( false, 'Invalid Permission.', 'Something went wrong.' );

				wp_send_json( $response );
				wp_die();
			}

			$args = array();

			$free_pro    = isset( $_POST['free_pro'] ) ? strtolower( sanitize_text_field( wp_unslash( $_POST['free_pro'] ) ) ) : '';
			$widget_slug = isset( $_POST['widget_slug'] ) ? sanitize_text_field( wp_unslash( $_POST['widget_slug'] ) ) : '';
			$builder     = isset( $_POST['builder'] ) ? sanitize_text_field( wp_unslash( $_POST['builder'] ) ) : 'elementor';
			$search      = isset( $_POST['search'] ) ? sanitize_text_field( wp_unslash( $_POST['search'] ) ) : '';
			$currentpage = isset( $_POST['currentpage'] ) ? sanitize_text_field( wp_unslash( $_POST['currentpage'] ) ) : 1;
			$parpage     = isset( $_POST['parpage'] ) ? sanitize_text_field( wp_unslash( $_POST['parpage'] ) ) : 1;

			if ( ! empty( $free_pro ) ) {
				$args['free_pro'] = $free_pro;
			}

			if ( ! empty( $widget_slug ) ) {
				$args['widget_slug'] = $widget_slug;
			}

			if ( ! empty( $builder ) ) {
				$args['builder'] = $builder;
			}

			if ( ! empty( $search ) ) {
				$args['search'] = $search;
			}

			if ( ! empty( $currentpage ) ) {
				$args['currentpage'] = (int) $currentpage;
			}

			if ( ! empty( $parpage ) ) {
				$args['parpage'] = (int) $parpage;
			}

			$param = array(
				'method'  => 'POST',
				'body'    => $args,
				'timeout' => 100,
			);

			$response = wp_remote_post( $this->api, $param );

			$status_code = wp_remote_retrieve_response_code( $response );
			if ( 200 === $status_code ) {
				$get_retrieve_body = wp_remote_retrieve_body( $response );
				$get_response      = $this->tpae_set_response( true, 'Successfully.', 'Successfully.', $get_retrieve_body );
			} else {
				$get_response = $this->tpae_set_response( false, 'Oops.', 'Oops.', array() );
			}

			wp_send_json( $get_response );
			wp_die();
		}

		/**
		 * Prepares a structured response array.
		 *
		 * @since 6.0.0
		 *
		 * @param bool   $success     Whether the operation was successful. Defaults to false.
		 * @param string $message     The main message to include in the response.
		 * @param string $description A more detailed description for the response.
		 * @param array  $data        Additional data to include in the response.
		 *
		 * @return array              The formatted response array.
		 */
		public function tpae_set_response( $success = false, $message = '', $description = '', $data = array() ) {

			$response = array(
				'success'     => $success,
				'message'     => esc_html( $message ),
				'description' => esc_html( $description ),
				'data'        => $data,
			);

			return $response;
		}
	}

	Tpae_Preset::get_instance();
}
