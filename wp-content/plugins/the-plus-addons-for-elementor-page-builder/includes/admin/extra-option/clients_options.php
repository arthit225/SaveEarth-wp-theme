<?php
/**
 * Widget Name: Client options
 * Description: Client options
 * Author: Theplus
 * Author URI: https://posimyth.com
 *
 * @since   6.0.0
 * @package ThePlus
 */

/**Exit if accessed directly.*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Tpae_Clients_Options' ) ) {

	/**
	 * Tpae_Clients_Options
	 *
	 * @since 6.0.0
	 */
	class Tpae_Clients_Options {

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
			add_action( 'add_meta_boxes', array( $this, 'add_clients_meta_box' ) );
			add_action( 'save_post', array( $this, 'save_clients_meta_data' ) );
		}

		/**
		 * Set client post name
		 *
		 * @since 6.0.0
		 */
		public function l_theplus_client_post_name() {
			$post_name = apply_filters( 'tpae_get_post_type', 'post_type', 'client_plugin_name' );
			if ( isset( $post_name ) && ! empty( $post_name ) ) {
				$post_name = apply_filters( 'tpae_get_post_type', 'post_type', 'client_plugin_name' );
			} else {
				$post_name = 'theplus_clients';
			}

			return $post_name;
		}

		/**
		 * Set client meta box
		 *
		 * @since 6.0.0
		 */
		public function add_clients_meta_box() {
			$post_type = $this->l_theplus_client_post_name();

			add_meta_box(
				'tpae_clients_options',
				esc_html__( 'TP Clients Options', 'tpebl' ),
				array( $this, 'render_clients_meta_box' ),
				$post_type,
				'normal',
				'high'
			);
		}

		/**
		 * Render client meta box
		 *
		 * @since 6.0.0
		 */
		public function render_clients_meta_box( $post ) {
			wp_nonce_field( 'tpae_save_client_meta_box', 'tpae_client_nonce' );

			$client_url = get_post_meta( $post->ID, '_theplus_clients_url', true );

			?>
			<style>
				#tpae_clients_options .tpae_clientopt_main{
					display: flex;
					padding: 10px;
				}
				.tpae_clientopt_main .tpae_clientopt_wrap{
					width: 100%;
					display: flex;
					padding: 15px 7px;
					border-bottom: 1px solid #e9e9e9;
				}
				.tpae_clientopt_wrap > label {
					width: 15%;
					display: flex;
					align-items: center;
					font-size: 14px;
					font-weight: 500;
				}
			</style>
			<div class="tpae_clientopt_main">
				<div class="tpae_clientopt_wrap">
					<label for="theplus_clients_url"><?php echo esc_html__( 'URL:', 'tpebl' ); ?></label>
					<input type="url" id="theplus_clients_url" name="theplus_clients_url" value="<?php echo esc_url( $client_url ); ?>" placeholder="https://example.com" style="width: 50%;" />
				</div>
			</div>
			<?php
		}

		/**
		 * Save client meta data
		 *
		 * @since 6.0.0
		 */
		public function save_clients_meta_data( $post_id ) {
			if ( ! isset( $_POST['tpae_client_nonce'] ) || ! wp_verify_nonce( $_POST['tpae_client_nonce'], 'tpae_save_client_meta_box' ) ) {
				return;
			}

			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return;
			}

			if ( isset( $_POST['theplus_clients_url'] ) ) {
				$client_url = sanitize_text_field( $_POST['theplus_clients_url'] );
				update_post_meta( $post_id, '_theplus_clients_url', $client_url );
			}
		}
	}

	Tpae_Clients_Options::get_instance();
}
