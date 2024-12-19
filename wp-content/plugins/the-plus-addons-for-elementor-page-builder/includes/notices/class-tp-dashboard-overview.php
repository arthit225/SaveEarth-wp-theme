<?php
/**
 * It is Main File to load all Notice, Upgrade Menu and all
 *
 * @link       https://posimyth.com/
 * @since      5.3.4
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

if ( ! class_exists( 'Tp_Dashboard_Overview' ) ) {

	/**
	 * This class used for only load All Notice Files
	 *
	 * @since 5.3.4
	 */
	class Tp_Dashboard_Overview {

		/**
		 * Instance
		 *
		 * @since 5.3.4
		 * @access private
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
		 * API Overview Option
		 *
		 * @var string
		 */
		public $api_overview = 'https://api.posimyth.com/wp-json/tpae/v2/tpae_dashboard_overview_data';

		/**
		 * API Overview Data
		 *
		 * @var string
		 */
		public $overview_data = array();

		/**
		 * API Transient key
		 *
		 * @var string
		 */
		public $transient_key = 'tp_dashboard_overview';

		/**
		 * White label Option
		 *
		 * @var string
		 */
		public $hidden_label = '';

		/**
		 * Instance
		 *
		 * Ensures only one instance of the class is loaded or can be loaded.
		 *
		 * @since 5.3.4
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
		 * @since 5.3.4
		 * @access public
		 */
		public function __construct() {
			$this->tp_white_label();

			/**
			 * Register Dashboard Widgets.
			 */
			$this->tp_call_api_dashboard_overview();
			add_action( 'wp_dashboard_setup', array( $this, 'tp_dashbord_overview_manage' ) );
		}

		/**
		 * Here add globel class varible for white label
		 *
		 * @since 5.3.4
		 * @access public
		 */
		public function tp_white_label() {
			$this->whitelabel   = get_option( 'theplus_white_label' );
			$this->hidden_label = ! empty( $this->whitelabel['tp_hidden_label'] ) ? $this->whitelabel['tp_hidden_label'] : '';
		}

		/**
		 * Initiate our hooks
		 *
		 * @since 5.3.4
		 * @access public
		 */
		public function tp_dashbord_overview_manage() {
			add_action( 'admin_enqueue_scripts', array( $this, 'tp_admin_scripts' ), 10, 1 );
			wp_add_dashboard_widget( 'tp-dashboard-overview', esc_html__( 'The Plus Addons for Elementor Overview', 'tpebl' ), array( $this, 'tp_dashboard_overview_widget' ) );
		}

		/**
		 * Initiate our hooks
		 *
		 * @since 5.3.4
		 * @access public
		 * @param string $hook The current admin page hook.
		 */
		public function tp_admin_scripts( $hook ) {

			if ( ! in_array( $hook, array( 'index.php' ), true ) ) {
				return;
			}

			wp_enqueue_style( 'tp-dashboard-css', L_THEPLUS_URL . 'assets/css/admin/tp-dashboard-overview.css', array(), L_THEPLUS_VERSION );
		}

		/**
		 * Displays the ThePlus dashboard widget.
		 *
		 * @since 5.3.4
		 * @access public
		 */
		public function tp_dashboard_overview_widget() {

			$this->tp_call_api_dashboard_overview();

			$output      = '';
			$output     .= '<div class="tp-dashboard-overview tp-dashboard-widget">';
				$output .= $this->tp_dashboard_overview_header();
				$output .= $this->tp_dashboard_overview_content();
				$output .= $this->tp_dashboard_overview_footer();
			$output     .= '</div>';

			echo $output;
		}

		/**
		 * Displays the Overview Header HTML
		 *
		 * @since 5.3.4
		 * @access public
		 */
		public function tp_dashboard_overview_header() {
			$output = '';

			$output             .= '<div class="tp-overview-header">';
				$output         .= '<div class="tp-overview-logo">';
					$output     .= '<div class="tp-overview-logo-wrapper">';
						$output .= '<svg style="background: linear-gradient(to right, #6D68FE, #B446FF);" width="36" height="36" viewBox="0 0 400 408" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd" d="M199.7 71H151.2V197.3H112V210.2H151.2V228.3H164V83.9H199.7C219.3 83.9 235.2 99.8 235.3 119.4V144.2H248.2V119.4C248.1 102 238.7 86 223.6 77.4C216.3 73.2 208.1 71 199.7 71ZM206.1 179.2H193.3V197.3H175.1V210.2H193.3V228.3H206.1V210.2H224.2V197.3H206.1V179.2ZM193.3 116.1H206.1V155.2H332.4V203.7C332.4 212.1 330.2 220.4 326.1 227.6C317.5 242.8 301.4 252.2 284.1 252.3H259.2V239.4H284.1C303.6 239.3 319.5 223.3 319.5 203.7V168.1H175.1V155.2H193.3V116.1ZM248.2 179.2H235.4V323.6H199.7C180.1 323.6 164.1 307.7 164 288.1V263.3H151.2V288.1C151.2 305.5 160.7 321.6 175.8 330.1C183.1 334.3 191.3 336.4 199.7 336.4H248.2V210.2H287.4V197.3H248.2V179.2ZM115.3 155.2H140.2V168.1H115.3C95.8 168.2 79.9 184.2 79.9 203.8V239.4H224.2V252.3H206.1V291.4H193.3V252.3H67V203.8C67 195.4 69.2 187.1 73.3 179.9C81.9 164.7 98 155.3 115.3 155.2Z" fill="white"/><path fill-rule="evenodd" clip-rule="evenodd" d="M163.8 252.1V155H151V252.1H163.8ZM174.9 197.1V210H248V197.1H174.9ZM248 155H175V167.9H248V155ZM247.9 252.1V239.2H174.9V252.1H247.9Z" fill="white"/></svg>';
					$output     .= '</div>';
				$output         .= '</div>';

				$output         .= '<div class="tp-overview-versions-text">';
					$output     .= '<span class="tp-overview-version">';
						$output .= esc_html__( 'ThePlus Addons  ', 'tpebl' );
						$output .= 'v' . L_THEPLUS_VERSION;
					$output     .= '</span>';

			if ( defined( 'THEPLUS_VERSION' ) ) {
				$output     .= '<span class="tp-overview-version">';
					$output .= esc_html__( 'ThePlus Addons Pro ', 'tpebl' );
					$output .= 'v' . THEPLUS_VERSION;
				$output     .= '</span>';
			}
			
				$output .= '</div>';
			$output     .= '</div>';

			return $output;
		}

		/**
		 * Displays the Overview Body HTML
		 *
		 * @since 5.3.4
		 * @access public
		 */
		public function tp_dashboard_overview_content() {
			$output = '';

			$overview_data = ! empty( $this->overview_data['data'] ) ? $this->overview_data['data'] : array();

			if ( ! empty( $overview_data ) && is_array( $overview_data ) ) {
				$output     .= '<div class="tp-overview-news-updates">';
					$output .= '<div class="tp-overview-heading"> News & Updates </div>';
					$output .= '<div class="tp-overview-recentposts">';

				foreach ( $overview_data as $value ) {
					$title       = ! empty( $value['title'] ) ? $value['title'] : '';
					$description = ! empty( $value['description'] ) ? $value['description'] : '';
					$link        = ! empty( $value['link'] ) ? $value['link'] : '';

					$output     .= '<div class="tp-overview-post">';
						$output .= '<a href="' . esc_url( $link ) . '"> <span> New </span>' . esc_html( $title ) . '</a>';
						$output .= '<div class="tp-post-desc">' . esc_html( $description ) . '</div>';
					$output     .= '</div>';
				}

					$output .= '</div>';
				$output     .= '</div>';
			}

			return $output;
		}

		/**
		 * Displays the Overview Footer HTML
		 *
		 * @since 5.3.4
		 * @access public
		 */
		public function tp_dashboard_overview_footer() {
			$base_actions = array(
				'blog' => array(
					'title' => esc_html__( 'Blog', 'tpebl' ),
					'link'  => 'https://theplusaddons.com/blog/?utm_source=wpbackend&utm_medium=widgets&utm_campaign=links',
				),
				'help' => array(
					'title' => esc_html__( 'Help', 'tpebl' ),
					'link'  => 'https://theplusaddons.com/help/getting-started/?utm_source=wpbackend&utm_medium=widgets&utm_campaign=links',
				),
			);

			$output  = '';
			$output .= '<div class="tp-overview-footer">';
			foreach ( $base_actions as $key => $action ) {
				$link = !empty( $action['link'] ) ? $action['link'] : '';
				$title = !empty( $action['title'] ) ? $action['title'] : '';

				$output .= '<a href="' . esc_html( $link ) . '" target="_blank">' . esc_html( $title ) . '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18.125 9.375C17.9592 9.375 17.8003 9.44085 17.6831 9.55806C17.5658 9.67527 17.5 9.83424 17.5 10V15.625C17.5 16.1223 17.3025 16.5992 16.9508 16.9508C16.5992 17.3025 16.1223 17.5 15.625 17.5H4.375C3.87772 17.5 3.40081 17.3025 3.04917 16.9508C2.69754 16.5992 2.5 16.1223 2.5 15.625V4.375C2.5 3.87772 2.69754 3.40081 3.04917 3.04917C3.40081 2.69754 3.87772 2.5 4.375 2.5H10C10.1658 2.5 10.3247 2.43415 10.4419 2.31694C10.5592 2.19973 10.625 2.04076 10.625 1.875C10.625 1.70924 10.5592 1.55027 10.4419 1.43306C10.3247 1.31585 10.1658 1.25 10 1.25H4.375C3.5462 1.25 2.75134 1.57924 2.16529 2.16529C1.57924 2.75134 1.25 3.5462 1.25 4.375V15.625C1.25 16.4538 1.57924 17.2487 2.16529 17.8347C2.75134 18.4208 3.5462 18.75 4.375 18.75H15.625C16.4538 18.75 17.2487 18.4208 17.8347 17.8347C18.4208 17.2487 18.75 16.4538 18.75 15.625V10C18.75 9.83424 18.6842 9.67527 18.5669 9.55806C18.4497 9.44085 18.2908 9.375 18.125 9.375Z" fill="black"/><path d="M13.7497 2.50001H16.6185L9.55597 9.55626C9.49739 9.61436 9.45089 9.68349 9.41916 9.75965C9.38743 9.83581 9.37109 9.9175 9.37109 10C9.37109 10.0825 9.38743 10.1642 9.41916 10.2404C9.45089 10.3165 9.49739 10.3857 9.55597 10.4438C9.61407 10.5023 9.6832 10.5488 9.75936 10.5806C9.83552 10.6123 9.91721 10.6286 9.99972 10.6286C10.0822 10.6286 10.1639 10.6123 10.2401 10.5806C10.3162 10.5488 10.3854 10.5023 10.4435 10.4438L17.4997 3.38751V6.25001C17.4997 6.41577 17.5656 6.57474 17.6828 6.69195C17.8 6.80916 17.959 6.87501 18.1247 6.87501C18.2905 6.87501 18.4494 6.80916 18.5667 6.69195C18.6839 6.57474 18.7497 6.41577 18.7497 6.25001V1.87501C18.7502 1.79276 18.7344 1.71122 18.7033 1.63507C18.6722 1.55892 18.6264 1.48966 18.5685 1.43126C18.5101 1.37333 18.4408 1.32751 18.3647 1.2964C18.2885 1.2653 18.207 1.24953 18.1247 1.25001H13.7497C13.584 1.25001 13.425 1.31586 13.3078 1.43307C13.1906 1.55028 13.1247 1.70925 13.1247 1.87501C13.1247 2.04077 13.1906 2.19974 13.3078 2.31695C13.425 2.43416 13.584 2.50001 13.7497 2.50001Z" fill="black"/></svg></a>';
			}

			if ( ! defined( 'THEPLUS_VERSION' ) ) {
				$output .= '<a href="https://theplusaddons.com/pricing/?utm_source=wpbackend&utm_medium=widgets&utm_campaign=links" class="tp-upgrade-btn" target="_blank"> Upgrade <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18.125 9.375C17.9592 9.375 17.8003 9.44085 17.6831 9.55806C17.5658 9.67527 17.5 9.83424 17.5 10V15.625C17.5 16.1223 17.3025 16.5992 16.9508 16.9508C16.5992 17.3025 16.1223 17.5 15.625 17.5H4.375C3.87772 17.5 3.40081 17.3025 3.04917 16.9508C2.69754 16.5992 2.5 16.1223 2.5 15.625V4.375C2.5 3.87772 2.69754 3.40081 3.04917 3.04917C3.40081 2.69754 3.87772 2.5 4.375 2.5H10C10.1658 2.5 10.3247 2.43415 10.4419 2.31694C10.5592 2.19973 10.625 2.04076 10.625 1.875C10.625 1.70924 10.5592 1.55027 10.4419 1.43306C10.3247 1.31585 10.1658 1.25 10 1.25H4.375C3.5462 1.25 2.75134 1.57924 2.16529 2.16529C1.57924 2.75134 1.25 3.5462 1.25 4.375V15.625C1.25 16.4538 1.57924 17.2487 2.16529 17.8347C2.75134 18.4208 3.5462 18.75 4.375 18.75H15.625C16.4538 18.75 17.2487 18.4208 17.8347 17.8347C18.4208 17.2487 18.75 16.4538 18.75 15.625V10C18.75 9.83424 18.6842 9.67527 18.5669 9.55806C18.4497 9.44085 18.2908 9.375 18.125 9.375Z" fill="black"/><path d="M13.7497 2.50001H16.6185L9.55597 9.55626C9.49739 9.61436 9.45089 9.68349 9.41916 9.75965C9.38743 9.83581 9.37109 9.9175 9.37109 10C9.37109 10.0825 9.38743 10.1642 9.41916 10.2404C9.45089 10.3165 9.49739 10.3857 9.55597 10.4438C9.61407 10.5023 9.6832 10.5488 9.75936 10.5806C9.83552 10.6123 9.91721 10.6286 9.99972 10.6286C10.0822 10.6286 10.1639 10.6123 10.2401 10.5806C10.3162 10.5488 10.3854 10.5023 10.4435 10.4438L17.4997 3.38751V6.25001C17.4997 6.41577 17.5656 6.57474 17.6828 6.69195C17.8 6.80916 17.959 6.87501 18.1247 6.87501C18.2905 6.87501 18.4494 6.80916 18.5667 6.69195C18.6839 6.57474 18.7497 6.41577 18.7497 6.25001V1.87501C18.7502 1.79276 18.7344 1.71122 18.7033 1.63507C18.6722 1.55892 18.6264 1.48966 18.5685 1.43126C18.5101 1.37333 18.4408 1.32751 18.3647 1.2964C18.2885 1.2653 18.207 1.24953 18.1247 1.25001H13.7497C13.584 1.25001 13.425 1.31586 13.3078 1.43307C13.1906 1.55028 13.1247 1.70925 13.1247 1.87501C13.1247 2.04077 13.1906 2.19974 13.3078 2.31695C13.425 2.43416 13.584 2.50001 13.7497 2.50001Z" fill="black"/></svg></a>';
			}

			if ( defined( 'THEPLUS_VERSION' ) ) {
				$output .= '<a href="https://store.posimyth.com/helpdesk/?utm_source=wpbackend&utm_medium=widgets&utm_campaign=links" target="_blank"> Helpdesk <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18.125 9.375C17.9592 9.375 17.8003 9.44085 17.6831 9.55806C17.5658 9.67527 17.5 9.83424 17.5 10V15.625C17.5 16.1223 17.3025 16.5992 16.9508 16.9508C16.5992 17.3025 16.1223 17.5 15.625 17.5H4.375C3.87772 17.5 3.40081 17.3025 3.04917 16.9508C2.69754 16.5992 2.5 16.1223 2.5 15.625V4.375C2.5 3.87772 2.69754 3.40081 3.04917 3.04917C3.40081 2.69754 3.87772 2.5 4.375 2.5H10C10.1658 2.5 10.3247 2.43415 10.4419 2.31694C10.5592 2.19973 10.625 2.04076 10.625 1.875C10.625 1.70924 10.5592 1.55027 10.4419 1.43306C10.3247 1.31585 10.1658 1.25 10 1.25H4.375C3.5462 1.25 2.75134 1.57924 2.16529 2.16529C1.57924 2.75134 1.25 3.5462 1.25 4.375V15.625C1.25 16.4538 1.57924 17.2487 2.16529 17.8347C2.75134 18.4208 3.5462 18.75 4.375 18.75H15.625C16.4538 18.75 17.2487 18.4208 17.8347 17.8347C18.4208 17.2487 18.75 16.4538 18.75 15.625V10C18.75 9.83424 18.6842 9.67527 18.5669 9.55806C18.4497 9.44085 18.2908 9.375 18.125 9.375Z" fill="black"/><path d="M13.7497 2.50001H16.6185L9.55597 9.55626C9.49739 9.61436 9.45089 9.68349 9.41916 9.75965C9.38743 9.83581 9.37109 9.9175 9.37109 10C9.37109 10.0825 9.38743 10.1642 9.41916 10.2404C9.45089 10.3165 9.49739 10.3857 9.55597 10.4438C9.61407 10.5023 9.6832 10.5488 9.75936 10.5806C9.83552 10.6123 9.91721 10.6286 9.99972 10.6286C10.0822 10.6286 10.1639 10.6123 10.2401 10.5806C10.3162 10.5488 10.3854 10.5023 10.4435 10.4438L17.4997 3.38751V6.25001C17.4997 6.41577 17.5656 6.57474 17.6828 6.69195C17.8 6.80916 17.959 6.87501 18.1247 6.87501C18.2905 6.87501 18.4494 6.80916 18.5667 6.69195C18.6839 6.57474 18.7497 6.41577 18.7497 6.25001V1.87501C18.7502 1.79276 18.7344 1.71122 18.7033 1.63507C18.6722 1.55892 18.6264 1.48966 18.5685 1.43126C18.5101 1.37333 18.4408 1.32751 18.3647 1.2964C18.2885 1.2653 18.207 1.24953 18.1247 1.25001H13.7497C13.584 1.25001 13.425 1.31586 13.3078 1.43307C13.1906 1.55028 13.1247 1.70925 13.1247 1.87501C13.1247 2.04077 13.1906 2.19974 13.3078 2.31695C13.425 2.43416 13.584 2.50001 13.7497 2.50001Z" fill="black"/></svg></a>';
			}

			$output .= '</div>';

			return $output;
		}

		/**
		 * Displays the called API
		 *
		 * @since 5.3.4
		 * @access public
		 */
		public function tp_call_api_dashboard_overview() {
			$data = get_transient( $this->transient_key );
			
			if ( false === $data || empty( $data ) ) {
				$u_r_l      = wp_remote_get( $this->api_overview );
				$statuscode = wp_remote_retrieve_response_code( $u_r_l );
				$getdataone = wp_remote_retrieve_body( $u_r_l );
				$statuscode = array( 'HTTP_CODE' => $statuscode );

				$response = json_decode( $getdataone, true );
				if ( is_array( $statuscode ) && is_array( $response ) ) {
					$this->overview_data = array_merge( $statuscode, $response );
				}

				set_transient( $this->transient_key, $this->overview_data, 21600 );
			} else {
				$this->overview_data = get_transient( $this->transient_key );
			}
		}
	}

	Tp_Dashboard_Overview::instance();
}
