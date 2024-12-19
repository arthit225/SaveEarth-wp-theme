<?php
/**
 * It is Main File to load all Notice, Upgrade Menu and all
 *
 * @link       https://posimyth.com/
 * @since      6.5.6
 *
 * @package    Theplus
 * @subpackage ThePlus/Notices
 * */

namespace Theplus\Notices;

/**
 * Exit if accessed directly.
 * */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Tp_Wdkit_Preview_Popup' ) ) {

	/**
	 * This class used for Wdesign-kit releted
	 *
	 * @since 6.5.6
	 */
	class Tp_Wdkit_Preview_Popup {

		/**
		 * Instance
		 *
		 * @since 6.5.6
		 * @static
		 * @var instance of the class.
		 */
		private static $instance = null;

		/**
		 * White label Option
		 *
		 * @var string
		 */
		public $whitelabel = '';

		/**
		 * White label Option
		 *
		 * @var string
		 */
		public $hidden_label = '';

		/**
		 * Instance
		 *
		 * @since 6.5.6
		 * @var w_d_s_i_g_n_k_i_t_slug
		 */
		public $w_d_s_i_g_n_k_i_t_slug = 'wdesignkit/wdesignkit.php';

		/**
		 * It is store wp_options table with name tp_wdkit_preview_popup
		 *
		 * @since 6.5.6
		 * @var db_preview_popup_key
		 */
		public $db_preview_popup_key = 'tp_wdkit_preview_popup';

		/**
		 * Instance
		 *
		 * Ensures only one instance of the class is loaded or can be loaded.
		 *
		 * @since 6.5.6
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
		 * @since 6.5.6
		 */
		public function __construct() {

			if ( class_exists( '\Elementor\Plugin' ) ) {
				add_action( 'elementor/editor/before_enqueue_scripts', array( $this, 'wdkit_elementor_editor_sripts' ) );
				add_action( 'elementor/editor/before_enqueue_scripts', array( $this, 'wdkit_elementor_editor_style' ) );
			}

			add_action( 'elementor/preview/enqueue_styles', array( $this, 'wdkit_elementor_preview_style' ) );
			add_action( 'wp_ajax_tp_install_wdkit', array( $this, 'tp_install_wdkit' ) );

			add_action( 'wp_ajax_tp_dont_show_again', array( $this, 'tp_dont_show_again' ) );
			add_action( 'wp_ajax_nopriv_tp_dont_show_again', array( $this, 'tp_dont_show_again' ) );

			add_action( 'elementor/editor/footer', array( $this, 'tp_wdkit_preview_html_popup' ) );
		}

		/**
		 * Loded Wdesignkit Template Logo CSS
		 *
		 * @since 6.5.6
		 */
		public function wdkit_elementor_preview_style() {
			wp_enqueue_style( 'tp-wdkit-elementor-editor-css', L_THEPLUS_URL . 'assets/css/wdesignkit/tp-wdkit-logo.css', array(), L_THEPLUS_VERSION );
		}

		/**
		 * Loded Wdesignkit Template Js
		 *
		 * @since 6.5.6
		 */
		public function wdkit_elementor_editor_sripts() {

			wp_enqueue_script( 'tp-wdkit-preview-popup', L_THEPLUS_URL . 'assets/js/wdesignkit/tp-wdkit-preview-popup.js', array( 'jquery', 'wp-i18n' ), L_THEPLUS_VERSION, true );

			wp_localize_script(
				'tp-wdkit-preview-popup',
				'tp_wdkit_preview_popup',
				array(
					'nonce'    => wp_create_nonce( 'tp_wdkit_preview_popup' ),
					'ajax_url' => admin_url( 'admin-ajax.php' ),
				)
			);
		}

		/**
		 * Loded Wdesignkit Template CSS
		 *
		 * @since 6.5.6
		 */
		public function wdkit_elementor_editor_style() {
			wp_enqueue_style( 'tp-wdkit-elementor-popup', L_THEPLUS_URL . 'assets/css/wdesignkit/tp-wdkit-preview-popup.css', array(), L_THEPLUS_VERSION );
		}

		/**
		 * Install Wdesign kit
		 *
		 * @since 6.5.6
		 */
		public function tp_install_wdkit() {

			check_ajax_referer( 'tp_wdkit_preview_popup', 'security' );

			$installed_plugins = get_plugins();

			include_once ABSPATH . 'wp-admin/includes/file.php';
			include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
			include_once ABSPATH . 'wp-admin/includes/class-automatic-upgrader-skin.php';
			include_once ABSPATH . 'wp-admin/includes/class-plugin-upgrader.php';

			$result   = array();
			$response = wp_remote_post(
				'http://api.wordpress.org/plugins/info/1.0/',
				array(
					'body' => array(
						'action'  => 'plugin_information',
						'request' => serialize(
							(object) array(
								'slug'   => 'wdesignkit',
								'fields' => array(
									'version' => false,
								),
							)
						),
					),
				)
			);

			$plugin_info = unserialize( wp_remote_retrieve_body( $response ) );

			if ( ! $plugin_info ) {
				wp_send_json_error( array( 'content' => __( 'Failed to retrieve plugin information.', 'tpebl' ) ) );
			}

			$skin     = new \Automatic_Upgrader_Skin();
			$upgrader = new \Plugin_Upgrader( $skin );

			$plugin_basename = $this->w_d_s_i_g_n_k_i_t_slug;

			if ( ! isset( $installed_plugins[ $plugin_basename ] ) && empty( $installed_plugins[ $plugin_basename ] ) ) {

				$installed         = $upgrader->install( $plugin_info->download_link );
				$activation_result = activate_plugin( $plugin_basename );

				$success = null === $activation_result;
				$result  = $this->tp_response( 'Success Install WDesignKit', 'Success Install WDesignKit', $success, '' );

			} elseif ( isset( $installed_plugins[ $plugin_basename ] ) ) {

				$activation_result = activate_plugin( $plugin_basename );

				$success = null === $activation_result;
				$result  = $this->tp_response( 'Success Install WDesignKit', 'Success Install WDesignKit', $success, '' );

			}

			wp_send_json( $result );
		}

		/**
		 * Close Popup Permanently
		 *
		 * @since 6.5.6
		 */
		public function tp_dont_show_again() {

			check_ajax_referer( 'tp_wdkit_preview_popup', 'security' );

			$option_value = get_option( $this->db_preview_popup_key );
			if ( ! empty( $option_value ) && 'yes' === $option_value ) {
				update_option( $this->db_preview_popup_key, 'yes' );
			} else {
				add_option( $this->db_preview_popup_key, 'yes' );
			}

			$result = $this->tp_response( 'Success Install WDesignKit', 'Success Install WDesignKit', true, '' );

			wp_send_json( $result );
		}

		/**
		 * Check plugin status
		 *
		 * @since 6.5.6
		 * @return array
		 */
		private function check_plugin_status() {

			$installed_plugins = get_plugins();

			$plugin_page_url = add_query_arg( array( 'page' => 'wdesign-kit' ), admin_url( 'admin.php' ) );

			$installed = false;
			if ( is_plugin_active( $this->w_d_s_i_g_n_k_i_t_slug ) || isset( $installed_plugins[ $this->w_d_s_i_g_n_k_i_t_slug ] ) ) {
				$installed = true;
			}

			return array(
				'installed'       => $installed,
				'plugin_page_url' => $plugin_page_url,
			);
		}

		/**
		 * It is WDesignKit Popup Design for Download and install
		 *
		 * @since 6.5.6
		 */
		public function tp_wdkit_preview_html_popup() {
			$plugin_status = $this->check_plugin_status(); ?>
			
			<div id="tp-wdkit-wrap" class="tp-main-container" style="display: none">
				<div class="tp-top-sections">
					<div class="tp-message">
						<a class="tp-not-show-again" href="#"><?php echo esc_html__( 'Don’t Show Again', 'tpebl' ); ?></a>
					</div>
					<div class="tp-close-btn">
						<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M13.7071 1.70711C14.0976 1.31658 14.0976 0.683417 13.7071 0.292893C13.3166 -0.0976312 12.6834 -0.0976312 12.2929 0.292893L7 5.58579L1.70711 0.292893C1.31658 -0.0976312 0.683417 -0.0976312 0.292893 0.292893C-0.0976312 0.683417 -0.0976312 1.31658 0.292893 1.70711L5.58579 7L0.292893 12.2929C-0.0976312 12.6834 -0.0976312 13.3166 0.292893 13.7071C0.683417 14.0976 1.31658 14.0976 1.70711 13.7071L7 8.41421L12.2929 13.7071C12.6834 14.0976 13.3166 14.0976 13.7071 13.7071C14.0976 13.3166 14.0976 12.6834 13.7071 12.2929L8.41421 7L13.7071 1.70711Z" fill="white" fill-opacity="0.8" /></svg>
					</div>
				</div>
				<div class="tp-middel-sections">
					<div class="tp-text-top">
						<?php echo esc_html__( 'Get 1000+ Predesigned Elementor Templates & Sections', 'tpebl' ); ?>
					</div>
					<div class="tp-text-bottom">
						<?php echo esc_html__( 'Uniquely designed Elementor Templates for every website type made with Elementor & The Plus Addons for Elementor Widgets.', 'tpebl' ); ?>
					</div>
					<div class="tp-learn-more-about">
						<?php if ( false === $plugin_status['installed'] ) { ?>
							<a class="tp-wdesign-install" href="#">
								<span class="theplus-enable-text"><?php echo esc_html( 'Enable Templates' ); ?></span>
								<div class="tp-wkit-publish-loader">
									<div class="tp-wb-loader-circle"></div>
								</div>
							</a>
						<?php } else { ?>
							<a class="tp-wdesign-install" href="#"><span class="tp-visit-plugin"><?php echo esc_html__( 'Visit Plugin', 'tpebl' ); ?></span></a>
						<?php } ?>
							<a class="tp-wdesign-about" href="https://wdesignkit.com/browse/template?plugin=%5B1003%5D&temp_type=pagetemplate"><?php echo esc_html__( 'Learn More', 'tpebl' ); ?></a>
					</div>
				</div>
				<div class="tp-image-sections"></div>
			</div> 
			<?php
		}

		/**
		 * Response
		 *
		 * @param string  $message pass message.
		 * @param string  $description pass message.
		 * @param boolean $success pass message.
		 * @param string  $data pass message.
		 *
		 * @since 6.5.6
		 */
		public function tp_response( $message = '', $description = '', $success = false, $data = '' ) {
			return array(
				'message'     => $message,
				'description' => $description,
				'success'     => $success,
				'data'        => $data,
			);
		}
	}

	Tp_Wdkit_Preview_Popup::instance();
}
