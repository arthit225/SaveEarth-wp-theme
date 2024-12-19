<?php
/**
 * It is Main File to load all Notice, Upgrade Menu and all
 *
 * @link       https://posimyth.com/
 * @since      5.3.3
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

if ( ! class_exists( 'Tp_Deactivate_Feedback' ) ) {

	/**
	 * This class used for only load All Notice Files
	 *
	 * @since 5.3.3
	 */
	class Tp_Deactivate_Feedback {

		/**
		 * Singleton Instance of the Class.
		 *
		 * @since 5.3.3
		 * @access private
		 * @static
		 * @var null|instance $instance An instance of the class or null if not instantiated yet.
		 */
		private static $instance = null;

		/**
		 * Singleton Instance of the Class.
		 *
		 * @since 5.3.4
		 * @access private
		 * @static
		 * @var string|deactive_count_api $deactive_count_api An instance of the class or null if not instantiated yet.
		 */
		private $count_api = 'https://api.posimyth.com/wp-json/tpae/v2/tpae_deactive_user_count_api';

		/**
		 * Singleton Instance Creation Method.
		 *
		 * This public static method ensures that only one instance of the class is loaded or can be loaded.
		 * It follows the Singleton design pattern to create or return the existing instance of the class.
		 *
		 * @since 5.3.3
		 * @access public
		 * @static
		 * @return self Instance of the class.
		 */
		public static function instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Constructor Method for Compatibility Checks and Actions Initialization.
		 *
		 * This constructor method is automatically triggered when the class is instantiated.
		 * It performs compatibility checks to ensure basic requirements are met and initiates
		 * necessary actions such as setting up deactivation feedback and adding AJAX hooks.
		 *
		 * @since 5.3.3
		 * @access public
		 */
		public function __construct() {
			$this->tp_deactivate_feedback();

			add_action( 'wp_ajax_tp_deactivate_rateus_notice', array( $this, 'tp_deactivate_rateus_notice' ) );
			add_action( 'wp_ajax_tp_skip_rateus_notice', array( $this, 'tp_skip_rateus_notice' ) );
		}

		/**
		 * Check if the Current Screen is Related to Plugin Management.
		 *
		 * This private function checks whether the current screen corresponds to the
		 * WordPress plugin management screen, specifically the 'plugins' or 'plugins-network' screens.
		 * Returns true if the current screen is related to plugin management, otherwise false.
		 *
		 * @since 5.3.3
		 * @access private
		 *
		 * @return bool True if the current screen is for managing plugins, otherwise false.
		 */
		private function tp_plugins_screen() {
			return in_array( get_current_screen()->id, array( 'plugins', 'plugins-network' ), true );
		}

		/**
		 * Initialize Hooks for Deactivation Feedback Functionality.
		 *
		 * Sets up hooks to enable the functionality related to deactivation feedback.
		 * This function adds an action hook to load necessary scripts and styles when
		 * the user accesses screens related to plugin deactivation.
		 *
		 * Fired by the `current_screen` action hook.
		 *
		 * @since 5.3.3
		 * @access public
		 */
		public function tp_deactivate_feedback() {

			add_action(
				'current_screen',
				function () {

					if ( ! $this->tp_plugins_screen() ) {
						return;
					}

					add_action( 'admin_enqueue_scripts', array( $this, 'tp_enqueue_feedback_dialog' ) );
				}
			);
		}

		/**
		 * Enqueue feedback dialog scripts.
		 *
		 * Registers the feedback dialog scripts and enqueues them.
		 *
		 * @since 1.0.0
		 * @access public
		 */
		public function tp_enqueue_feedback_dialog() {

			add_action( 'admin_footer', array( $this, 'tp_display_deactivation_feedback_dialog' ) );

			wp_register_script( 'tp-elementor-admin-feedback', L_THEPLUS_URL . 'assets/js/admin/tp-deactivate-feedback.js', array(), L_THEPLUS_VERSION, true );
			wp_enqueue_script( 'tp-elementor-admin-feedback' );
		}

		/**
		 * Print Deactivate Feedback Dialog.
		 *
		 * Displays a dialog box to prompt the user for reasons when deactivating Elementor.
		 * Provides options and input fields to collect feedback on why the plugin is being deactivated.
		 * This dialog is displayed in the WordPress admin area.
		 *
		 * Fired by the `admin_footer` filter hook.
		 *
		 * @since 5.3.3
		 * @access public
		 *
		 * This function generates an HTML dialog box with radio buttons and text fields to capture
		 * the user's feedback regarding their reasons for deactivating The Plus Addons for Elementor plugin.
		 * The collected feedback is sent when the user deactivates the plugin.
		 */
		public function tp_display_deactivation_feedback_dialog() {

			$deactivate_reasons = array(
				'tp_temporary_deactivation'         => array(
					'title'             => esc_html__( 'This is a temporary deactivation', 'tpebl' ),
					'input_placeholder' => '',
				),
				'tp_no_longer_needed'               => array(
					'title'             => esc_html__( 'No more planning to use Elementor', 'tpebl' ),
					'input_placeholder' => '',
				),
				'tp_performance_issues'             => array(
					'title'             => esc_html__( 'Performance Issues', 'tpebl' ),
					'input_placeholder' => '',
				),
				'tp_found_a_better_plugin'          => array(
					'title'             => esc_html__( 'Found an alternative Elementor Addon', 'tpebl' ),
					'input_placeholder' => esc_html__( 'Please share which plugin', 'tpebl' ),
				),
				'tp_couldnt_get_the_plugin_to_work' => array(
					'title'             => esc_html__( 'Its missing the feature i require.', 'tpebl' ),
					'input_placeholder' => '',
				),
				'tp_Dont_want_elementor_addon'      => array(
					'title'             => esc_html__( 'Dont want to use any Elementor Addon, just Elementor.', 'tpebl' ),
					'input_placeholder' => '',
				),
				'tp_facing_technical'               => array(
					'title'             => esc_html__( 'Facing technical issues/bugs with the plugin.', 'tpebl' ),
					'input_placeholder' => '',
				),
				'tp_other'                          => array(
					'title'             => esc_html__( 'Other', 'tpebl' ),
					'input_placeholder' => esc_html__( 'Please share the reason', 'tpebl' ),
				),
			);

			$site_url = home_url();
			$security = wp_create_nonce( 'tp-deactivate-feedback' );

			$current_datetime = date('Y-m-d H:i:s');
			$current_user = wp_get_current_user();
			$user_email   = $current_user->user_email; 
			$tpae_version = L_THEPLUS_VERSION;


			?>

			<div id="tp-feedback-dialog-wrapper">
				<div id="tp-feedback-dialog-header">
					<svg width="28" height="28" viewBox="0 0 314 314" fill="none" xmlns="http://www.w3.org/2000/svg">
						<g clip-path="url(#clip0_4529_4146)">
							<path d="M284 0H30C13.4315 0 0 13.4315 0 30V284C0 300.569 13.4315 314 30 314H284C300.569 314 314 300.569 314 284V30C314 13.4315 300.569 0 284 0Z" fill="url(#paint0_linear_4529_4146)"/>
							<mask id="mask0_4529_4146" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="24" y="24" width="266" height="266">
								<path d="M290 24H24V290H290V24Z" fill="white"/>
							</mask>
							<g mask="url(#mask0_4529_4146)">
								<path d="M163.3 132.8H150.5V150.9H132.3V163.8H150.5V181.9H163.3V163.8H181.4V150.9H163.3V132.8Z" fill="white" fill-opacity="0.2"/>
								<path d="M156.9 24.6001H108.4V150.9H69.2002V163.8H108.4V181.9H121.2V37.5001H156.9C176.5 37.5001 192.4 53.4001 192.5 73.0001V97.8001H205.4V73.0001C205.3 55.6001 195.9 39.6001 180.8 31.0001C173.5 26.8001 165.3 24.6001 156.9 24.6001Z" fill="white" fill-opacity="0.2"/>
								<path d="M163.3 69.7002H150.5V108.8H132.3V121.7H276.7V157.3C276.7 176.9 260.8 192.9 241.3 193H216.4V205.9H241.3C258.6 205.8 274.7 196.4 283.3 181.2C287.4 174 289.6 165.7 289.6 157.3V108.8H163.3V69.7002Z" fill="white" fill-opacity="0.2"/>
								<path d="M205.4 132.8H192.6V277.2H156.9C137.3 277.2 121.3 261.3 121.2 241.7V216.9H108.4V241.7C108.4 259.1 117.9 275.2 133 283.7C140.3 287.9 148.5 290 156.9 290H205.4V163.8H244.6V150.9H205.4V132.8Z" fill="white" fill-opacity="0.2"/>
								<path d="M97.4002 108.8H72.5002C55.2002 108.9 39.1002 118.3 30.5002 133.5C26.4002 140.7 24.2002 149 24.2002 157.4V205.9H150.5V245H163.3V205.9H181.4V193H37.1002V157.4C37.1002 137.8 53.0002 121.8 72.5002 121.7H97.4002V108.8Z" fill="white" fill-opacity="0.2"/>
								<path d="M132.3 163.8V150.9H205.4V163.8H132.3Z" fill="white"/>
								<path d="M121.2 108.8V205.9H108.4V108.8H121.2Z" fill="white"/>
								<path d="M205.4 108.8H132.4V121.7H205.4V108.8Z" fill="white"/>
								<path d="M205.3 193V205.9H132.3V193H205.3Z" fill="white"/>
							</g>
						</g>
						<defs>
							<linearGradient id="paint0_linear_4529_4146" x1="0" y1="0" x2="510.884" y2="215.282" gradientUnits="userSpaceOnUse">
								<stop stop-color="#6D68FE"/>
								<stop offset="1" stop-color="#B446FF"/>
							</linearGradient>
							<clipPath id="clip0_4529_4146">
								<rect width="314" height="314" fill="white"/>
							</clipPath>
						</defs>
					</svg>	


					<span id="tp-feedback-dialog-header-title">
					<?php echo esc_html__( 'Quick Feedback', 'tpebl' ); ?></span>
				</div>
				<form id="tp-feedback-dialog-form" method="post">
					<input type="hidden" name="site_url" value="<?php echo esc_url( $site_url ); ?>" />
					<input type="hidden" name="nonce" value="<?php echo esc_attr( $security ); ?>" />
					<input type="hidden" name="cur_datetime" value="<?php echo esc_attr( $current_datetime ); ?>" />
					<input type="hidden" name="user_email" value="<?php echo esc_attr( $user_email ); ?>" />
					<input type="hidden" name="tpae_version" value="<?php echo esc_attr( $tpae_version ); ?>" />

					<div id="tp-feedback-dialog-form-caption">
						<?php echo esc_html__( " If you have a moment, please let us know why you're deactivating The Plus Addons for Elementor :", 'tpebl' ); ?>
					</div>

					<div id="tp-feedback-dialog-form-body">
						<?php foreach ( $deactivate_reasons as $reason_key => $reason ) : ?>
							<div class="tp-feedback-dialog-input-wrapper <?php echo esc_attr( $reason_key ); ?>">
								<input id="tp-deactivate-feedback-<?php echo esc_attr( $reason_key ); ?>" class="tp-deactivate-feedback-dialog-input" type="radio" name="reason_key" value="<?php echo esc_attr( $reason_key ); ?>" />

								<label for="tp-deactivate-feedback-<?php echo esc_attr( $reason_key ); ?>" class="tp-deactivate-feedback-dialog-label">
									<?php echo esc_html( $reason['title'] ); ?>
								</label>

								<?php if ( ! empty( $reason['input_placeholder'] ) ) { ?>
									<input class="tp-feedback-text" type="text" name="reason_<?php echo esc_attr( $reason_key ); ?>" placeholder="<?php echo esc_attr( $reason['input_placeholder'] ); ?>" />
								<?php } ?>
							</div>
						<?php endforeach; ?>
					</div>
				</form>
			</div>
			<?php
		}

		/**
		 * Deactivates the rate-us notice via AJAX.
		 *
		 * This function handles the AJAX request to deactivate the rate-us notice,
		 * and sends the necessary data to the remote API for processing.
		 *
		 * @since 5.3.3
		 * @access public
		 *
		 * @return void
		 */
		public function tp_deactivate_rateus_notice() {
			$nonce = ! empty( $_POST['nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['nonce'] ) ) : '';

			if ( ! isset( $nonce ) || empty( $nonce ) || ! wp_verify_nonce( $nonce, 'tp-deactivate-feedback' ) ) {
				die( 'Security checked!' );
			}

			$deavtive_url = 'https://api.posimyth.com/wp-json/tpae/v2/tpae_deactivate_user_data';

			$site_url        = ! empty( $_POST['site_url'] ) ? sanitize_text_field( wp_unslash( $_POST['site_url'] ) ) : '';
			$reason_key      = ! empty( $_POST['reason_key'] ) ? sanitize_text_field( wp_unslash( $_POST['reason_key'] ) ) : '';
			$reason_tp_other = ! empty( $_POST['reason_tp_other'] ) ? sanitize_text_field( wp_unslash( $_POST['reason_tp_other'] ) ) : '';

			$reason_tp_found_a_better_plugin = ! empty( $_POST['reason_tp_found_a_better_plugin'] ) ? sanitize_text_field( wp_unslash( $_POST['reason_tp_found_a_better_plugin'] ) ) : '';

			$cur_datetime = ! empty( $_POST['cur_datetime'] ) ? sanitize_text_field( wp_unslash( $_POST['cur_datetime'] ) ) : '';
			$user_email   = ! empty( $_POST['user_email'] ) ? sanitize_text_field( wp_unslash( $_POST['user_email'] ) ) : '';
			$tpae_version = ! empty( $_POST['tpae_version'] ) ? sanitize_text_field( wp_unslash( $_POST['tpae_version'] ) ) : '';

			$api_params = array(
				'site_url'                        => $site_url,
				'reason_key'                      => $reason_key,
				'reason_tp_other'                 => $reason_tp_other,

				'reason_tp_found_a_better_plugin' => $reason_tp_found_a_better_plugin,

				'cur_datetime' => $cur_datetime,
				'user_email'   => $user_email,
				'tpae_version' => $tpae_version,
			);

			$response = wp_remote_post(
				$deavtive_url,
				array(
					'timeout'   => 30,
					'sslverify' => false,
					'body'      => $api_params,
				)
			);

			wp_die();
		}

		/**
		 * Deactivates skip notice
		 *
		 * This function handles the AJAX request to deactivate the rate-us notice,
		 * and sends the necessary data to the remote API for processing.
		 *
		 * @since 5.3.4
		 * @access public
		 *
		 * @return void
		 */
		public function tp_skip_rateus_notice() {

			check_ajax_referer( 'tp-deactivate-feedback', 'nonce' );

			$response = wp_remote_post(
				$this->count_api,
				array(
					'body'    => array(),
					'headers' => array(
						'Content-Type' => 'application/x-www-form-urlencoded',
					),
				)
			);

			wp_die();
		}
	}

	Tp_Deactivate_Feedback::instance();
}