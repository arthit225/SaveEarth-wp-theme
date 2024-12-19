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

namespace Tp\Notices\TPAGInstallNotice;

/**
 * Exit if accessed directly.
 * */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Tp_Tpag_Install_Notice' ) ) {

	/**
	 * This class used for only elementor widget load
	 *
	 * @since 5.3.3
	 */
	class Tp_Tpag_Install_Notice {

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
		 * @since 5.2.3
		 * @version 5.3.3
		 * @access public
		 * @var t_p_a_g_slug
		 */
		public $t_p_a_g_slug = 'the-plus-addons-for-block-editor/the-plus-addons-for-block-editor.php';

		/**
		 * Instance
		 *
		 * @since 5.2.3
		 * @version 5.3.3
		 * @access public
		 * @var t_p_a_g_doc_url
		 */
		public $t_p_a_g_doc_url = 'https://theplusblocks.com/?utm_source=wpbackend&utm_medium=adminpanel&utm_campaign=notice';

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
			/**Install ThePlus Blocks Notice*/
			add_action( 'admin_notices', array( $this, 'theplus_blocks_notice_install_plugin' ) );

			/**TPAG Close Popup and Notice*/
			add_action( 'wp_ajax_theplus_blocks_dismiss_notice', array( $this, 'theplus_blocks_dismiss_notice' ) );
		}

		/**
		 * Plugin Active Theplus Addons for Block Editor Notice Installing Notice show
		 *
		 * @since 5.3.3
		 * @access public
		 */
		public function theplus_blocks_notice_install_plugin() {
			$installed_plugins = get_plugins();

			$file_path   = $this->t_p_a_g_slug;
			$screen      = get_current_screen();
			$nonce       = wp_create_nonce( 'theplus-addons-tpag-blocks' );
			$pt_exclude  = ! empty( $screen->post_type ) && in_array( $screen->post_type, array( 'elementor_library', 'product' ), true );
			$parent_base = ! empty( $screen->parent_base ) && in_array( $screen->parent_base, array( 'edit', 'plugins' ), true );
			$get_action  = ! empty( $_GET['action'] ) ? sanitize_text_field( wp_unslash( $_GET['action'] ) ) : '';

			if ( ! $parent_base || $pt_exclude ) {
				return;
			}

			$notice_dismissed = get_user_meta( get_current_user_id(), 'theplus_tpag_blocks_dismissed_notice', true );
			if ( ! empty( $notice_dismissed ) ) {
				return;
			}

			if ( is_plugin_active( $file_path ) || isset( $installed_plugins[ $file_path ] ) ) {
				return;
			}

			if ( ! empty( $_GET['action'] ) && 'install-plugin' === $_GET['action'] ) {
				return;
			}

			$install_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=the-plus-addons-for-block-editor' ), 'install-plugin_the-plus-addons-for-block-editor' );

			$admin_notice  = '<h3>' . esc_html__( "It's Live 🎉 The Plus Blocks for Gutenberg is Ready to Use!", 'tpebl' ) . '</h3>';
			$admin_notice .= '<p>' . esc_html__( 'Do you use Gutenberg Block Editor to create websites or post blogs?', 'tpebl' ) . '</p>';
			$admin_notice .= '<p>' . esc_html__( 'Then check our Gutenberg Block version, where we provide you over 85+ WordPress Blocks (40 Free Blocks) to help you create fast websites without compromising on design.', 'tpebl' ) . '</p>';
			$admin_notice .= '<p>' . sprintf( '<a href="%s" class="tp-block-notice-checkdemos" target="_blank" rel="noopener noreferrer">%s</a>', $this->t_p_a_g_doc_url, esc_html__( 'Check Live demos', 'tpebl' ) ) . '</p>';
			$admin_notice .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $install_url, esc_html__( 'Install The Plus Blocks', 'tpebl' ) ) . '</p>';
			$admin_notice .= '<button type="button" class="notice-dismiss"><span class="screen-reader-text">' . esc_html__( 'Dismiss this notice', 'tpebl' ) . '</span></button>';

			echo '<div class="notice notice-error is-dismissible theplus-tpag-blocks-notice" style="border-left-color: #8072fc;">' . wp_kses_post( $admin_notice ) . '</div>';

			?>
			<script>
				jQuery('.theplus-tpag-blocks-notice .notice-dismiss').on('click', function() {
					jQuery.ajax({
						url: ajaxurl,
						type: 'POST',
						data: {
							action: 'theplus_blocks_dismiss_notice',
							security: "<?php echo esc_html( $nonce ); ?>",
							type: 'tpag_notice',
						},
						success: function(response) {
							jQuery('.theplus-tpag-blocks-notice').hide();
						}
					});
				});
			</script>
			<?php
		}

		/**
		 * It's is use for Save key in database
		 * TAPG Notice and TAG Popup Dismisse
		 *
		 * @since 5.3.3
		 * @access public
		 */
		public function theplus_blocks_dismiss_notice() {
			$get_security = ! empty( $_POST['security'] ) ? sanitize_text_field( wp_unslash( $_POST['security'] ) ) : '';

			if ( ! isset( $get_security ) || empty( $get_security ) || ! wp_verify_nonce( $get_security, 'theplus-addons-tpag-blocks' ) ) {
				die( 'Security checked!' );
			}

			if ( ! current_user_can( 'manage_options' ) ) {
				wp_send_json_error( __( 'You are not allowed to do this action', 'tpebl' ) );
			}

			$get_type = ! empty( $_POST['type'] ) ? sanitize_text_field( wp_unslash( $_POST['type'] ) ) : '';

			if ( 'tpag_notice' === $get_type ) {
				update_user_meta( get_current_user_id(), 'theplus_tpag_blocks_dismissed_notice', true );
			} elseif ( 'tpag_popup' === $get_type ) {
				// add_option('theplus_tpag_blocks_dismissed_popup', true);
			}

			wp_send_json_success();
		}
	}

	Tp_Tpag_Install_Notice::instance();
}
