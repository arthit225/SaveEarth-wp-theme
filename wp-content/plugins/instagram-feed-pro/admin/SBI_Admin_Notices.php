<?php
/**
 * CFF Admin Notices.
 *
 * @since 6.0
 */
namespace InstagramFeed\Admin;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

use InstagramFeed\SBI_Response;
use InstagramFeed\Helpers\Util;
use InstagramFeed\SBI_HTTP_Request;

class SBI_Admin_Notices {


	/**
	 * CFF License Key
	 */
	public $sbi_license;

	public function __construct() {
		$this->init();
	}

	/**
	 * Determining if the user is viewing the our page, if so, party on.
	 *
	 * @since 6.0
	 */
	public function init() {
		if ( ! is_admin() ) {
			return;
		}
		add_action( 'in_admin_header', array( $this, 'remove_admin_notices' ) );
		add_action( 'sbi_admin_notices', array( $this, 'sbi_license_notices' ) );
		add_action( 'sbi_admin_header_notices', array( $this, 'sbi_license_header_notices' ) );
		add_action( 'admin_notices', array( $this, 'sbi_license_notices' ) );
		add_action( 'wp_ajax_sbi_check_license', array( $this, 'sbi_check_license' ) );
		add_action( 'wp_ajax_sbi_dismiss_license_notice', array( $this, 'sbi_dismiss_license_notice' ) );
		add_action( 'wp_ajax_sbi_license_activation', [$this, 'ajax_activate_license'] );
	}

	/**
	 * Remove admin notices from inside our plugin screens so we can show our customized notices
	 *
	 * @since 6.0
	 */
	public function remove_admin_notices() {
		$current_screen      = get_current_screen();
		$not_allowed_screens = array(
			'instagram-feed_page_sbi-feed-builder',
			'instagram-feed_page_sbi-settings',
			'instagram-feed_page_sbi-oembeds-manager',
			'instagram-feed_page_sbi-extensions-manager',
			'instagram-feed_page_sbi-about-us',
			'instagram-feed_page_sbi-support',
		);

		if ( in_array( $current_screen->base, $not_allowed_screens, true ) || strpos( $current_screen->base, 'sbi-' ) !== false ) {
			remove_all_actions('admin_notices');
			remove_all_actions('all_admin_notices');
		}
	}

	/**
	 * CFF Get Renew License URL
	 *
	 * @since 6.0
	 *
	 * @return string $url
	 */
	public static function get_renew_url( $license_state = 'expired' ) {
		global $sbi_download_id;
		if ( $license_state == 'inactive' ) {
			return admin_url('admin.php?page=sbi-settings&focus=license');
		}

		$license_key = get_option( 'sbi_license_key' ) ? get_option( 'sbi_license_key' ) : null;

		$url = sprintf(
			'https://smashballoon.com/checkout/?edd_license_key=%s&download_id=%s&utm_campaign=instagram-pro&utm_source=expired-notice&utm_medium=renew-license',
			$license_key,
			$sbi_download_id
		);

		return $url;
	}

	/**
	 * CFF Check License
	 *
	 * @since 6.0
	 */
	public function sbi_check_license() {
		$sbi_license_key = trim( get_option( 'sbi_license_key' ) );
		check_ajax_referer( 'sbi_nonce', 'sbi_nonce' );

		if ( ! sbi_current_user_can( 'manage_instagram_feed_options' ) ) {
			wp_send_json_error(); // This auto-dies.
		}

		// Check the API
		$sbi_api_params   = array(
			'edd_action' => 'check_license',
			'license'    => $sbi_license_key,
			'item_name'  => urlencode( SBI_PLUGIN_NAME ), // the name of our product in EDD
		);
		$sbi_response     = wp_remote_get(
			add_query_arg( $sbi_api_params, SBI_STORE_URL ),
			array(
				'timeout'   => 60,
			)
		);
		$sbi_license_data = (array) json_decode( wp_remote_retrieve_body( $sbi_response ) );
		// Update the updated license data
		update_option( 'sbi_license_data', $sbi_license_data );

		$sbi_todays_date = gmdate( 'Y-m-d' );
		// Check whether it's active
		if ( $sbi_license_data['license'] !== 'expired' && ( strtotime( $sbi_license_data['expires'] ) > strtotime( $sbi_todays_date ) ) ) {
			// if the license is active then lets remove the ignore check for dashboard so next time it will show the expired notice in dashboard screen
			update_user_meta( get_current_user_id(), 'sbi_ignore_dashboard_license_notice', false );

			$response = new SBI_Response(
				true,
				array(
					'msg'     => 'License Active',
					'content' => $this->get_renewed_license_notice_content(),
				)
			);
			$response->send();
		} else {
			$content  = $this->get_expired_license_notice_content();
			$content  = str_replace( 'Your Instagram Feed Pro license key has expired', 'We rechecked but your license key is still expired', $content );
			$response = new SBI_Response(
				false,
				array(
					'msg'     => 'License Not Renewed',
					'content' => $content,
				)
			);
			$response->send();
		}
	}

	/**
	 * CFF Dismiss Notice
	 *
	 * @since 6.0
	 */
	public function sbi_dismiss_license_notice() {
		check_ajax_referer( 'sbi_nonce', 'sbi_nonce' );

		if ( ! sbi_current_user_can( 'manage_instagram_feed_options' ) ) {
			wp_send_json_error(); // This auto-dies.
		}
		global $current_user;
		$user_id = $current_user->ID;
		update_user_meta( $user_id, 'sbi_ignore_dashboard_license_notice', true );
	}

	/**
	 * Display post 2 weeks license expired notice at the top of header
	 *
	 * @since 6.2.0
	 */
	public function sbi_license_header_notices() {
		$current_screen = sbi_builder_pro()->license_service->is_current_screen_allowed();
		//Only display notice to admins
		if ( ! current_user_can( sbi_builder_pro()->license_service->capability_check ) ) {
			return;
		}
		// We will display the license notice only on those allowed screens
		if ( isset( $current_screen['is_allowed'] ) && $current_screen['is_allowed'] === false ) {
			return;
		}
		// get the license key
		$sbi_license_key= sbi_builder_pro()->license_service->get_license_key;
		/* Check that the license exists and */
		if ( empty( $sbi_license_key) || ! isset( $sbi_license_key) ) {
			if ( $current_screen['base'] == 'instagram-feed_page_sbi-feed-builder' ) {
				echo $this->get_post_grace_period_header_notice( 'sbi-license-inactive-state' );
			}
			return;
		}

		//Number of days until license expires
		$sbi_license_expired = sbi_builder_pro()->license_service->is_license_expired;
		if ( ! $sbi_license_expired ) {
			return;
		}
		// Grace period ended?
		if ( sbi_builder_pro()->license_service->is_license_grace_period_ended( true ) ) {
			if ( get_option( 'sbi_check_license_api_post_grace_period' ) !== 'false' ) {
				$sbi_license_expired = sbi_builder_pro()->license_service->sbi_check_license( sbi_builder_pro()->license_service->get_license_key, true, true );
			}
			if ( $sbi_license_expired ) {
				echo $this->get_post_grace_period_header_notice();
			}
		}
	}

	/**
	 * Display license expire related notices in the plugin's pages
	 *
	 * @since 6.2.0
	 */
	public function sbi_license_notices() {
		$current_screen 			= sbi_builder_pro()->license_service->is_current_screen_allowed();

		//Only display notice to admins
		if ( ! current_user_can( sbi_builder_pro()->license_service->capability_check ) ) {
			return;
		}
		// We will display the license notice only on those allowed screens
		if ( isset( $current_screen['is_allowed'] ) && $current_screen['is_allowed'] === false ) {
			return;
		}
		// get the license key
		$sbi_license_key= sbi_builder_pro()->license_service->get_license_key;
		/* Check that the license exists and the user hasn't already clicked to ignore the message */
		if ( empty( $sbi_license_key) || ! isset( $sbi_license_key) ) {
			if ( $current_screen['base'] !== 'instagram-feed_page_sbi-feed-builder' ) {
				echo $this->get_inactive_license_notice_content( $current_screen['base'] );
			}
			return;
		}
        // If license not expired then return;
		$sbi_license_expired = sbi_builder_pro()->license_service->is_license_expired;
		if ( ! $sbi_license_expired ) {
			return;
		}
		// Grace period ended?
		if ( sbi_builder_pro()->license_service->is_license_grace_period_ended ) {
			return;
		}
		// So, license has expired and grace period active
		// Lets display the error notice
		if ( $current_screen['base'] !== 'instagram-feed_page_sbi-settings' ) {
			echo $this->get_expired_license_notice_content();
		}
	}

	/**
	 * Get content for expired license notice
	 *
	 * @since 6.2.0
	 *
	 * @return string $output
	 */
	public function get_expired_license_notice_content() {
		global $current_user;
		$current_screen = get_current_screen();

		$output = '<div class="sb-license-notice">
				<h4>Your license key has expired</h4>
				<p>You are no longer receiving updates that protect you against upcoming Facebook changes. There’s a <strong>14 day</strong> grace period before access to some Pro features in the plugin will be limited.</p>
				<div class="sb-notice-buttons">
					<a href="'. $this->get_renew_url() .'" class="sb-btn sb-btn-blue" target="_blank">Renew License</a>
					<a href="#" class="sb-btn" @click.prevent.default="activateView(\'whyRenewLicense\')">Why Renew?</a>
					<a class="recheck-license-status sb-btn" @click="recheckLicense(\'sbi\')" v-html="recheckBtnText(\'sbi\')" :class="recheckLicenseStatus"></a>
				</div>
				<svg class="sb-notice-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10 0C4.48 0 0 4.48 0 10C0 15.52 4.48 20 10 20C15.52 20 20 15.52 20 10C20 4.48 15.52 0 10 0ZM11 15H9V13H11V15ZM11 11H9V5H11V11Z" fill="#D72C2C"/></svg>
			</div>';

		if ( ! empty( $current_screen->base ) && $current_screen->base == 'dashboard' ) {
			$output .= '<button id="sb-dismiss-notice">
                        <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.66683 1.27325L8.72683 0.333252L5.00016 4.05992L1.2735 0.333252L0.333496 1.27325L4.06016 4.99992L0.333496 8.72659L1.2735 9.66659L5.00016 5.93992L8.72683 9.66659L9.66683 8.72659L5.94016 4.99992L9.66683 1.27325Z" fill="white"/>
                        </svg>
                    </button>';
		}

		return $output;
	}

	/**
	 * Get post grace period header notice content
	 *
	 * @since 6.2.0
	 */
	public function get_post_grace_period_header_notice( $license_status = 'expired' ) {
		$notice_text = 'Your Instagram Feed Pro License has expired. Renew to keep using PRO features.';
		if ( $license_status == 'sbi-license-inactive-state' ) {
			$notice_text = 'Your license key is inactive. Please add license key to enable PRO features.';
		}
		return '<div id="sbi-license-expired-agp" class="sbi-license-expired-agp sbi-le-flow-1 '. $license_status .'">
			<span class="sbi-license-expired-agp-message">'. $notice_text .' <span @click.prevent.default="activateView(\'licenseLearnMore\')">Learn More</span></span>
			<button type="button" id="sbi-dismiss-header-notice" title="Dismiss this message" data-page="overview" class="sbi-dismiss">
				<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M15.8327 5.34175L14.6577 4.16675L9.99935 8.82508L5.34102 4.16675L4.16602 5.34175L8.82435 10.0001L4.16602 14.6584L5.34102 15.8334L9.99935 11.1751L14.6577 15.8334L15.8327 14.6584L11.1744 10.0001L15.8327 5.34175Z" fill="white"></path>
				</svg>
			</button>
		</div>';
	}

	/**
	 * Get content for successfully renewed license notice
	 *
	 * @since 6.0
	 *
	 * @return string $output
	 */
	public function get_renewed_license_notice_content() {
		$output = '<span class="sb-notice-icon sb-error-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C6.5 2 2 6.5 2 12C2 17.5 6.5 22 12 22C17.5 22 22 17.5 22 12C22 6.5 17.5 2 12 2ZM10 17L5 12L6.41 10.59L10 14.17L17.59 6.58L19 8L10 17Z" fill="#59AB46"/>
                </svg>
            </span>
            <div class="sb-notice-body">
                <h3 class="sb-notice-title">Thanks! Your license key is valid.</h3>
                <p>You can safely dismiss this modal.</p>
                <div class="license-action-btns">
                    <a target="_blank" class="sbi-license-btn sbi-btn-blue sbi-notice-btn" id="sbi-hide-notice">
                        <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.66683 1.27325L8.72683 0.333252L5.00016 6.05992L1.2735 0.333252L0.333496 1.27325L6.06016 4.99992L0.333496 8.72659L1.2735 9.66659L5.00016 5.93992L8.72683 9.66659L9.66683 8.72659L5.94016 4.99992L9.66683 1.27325Z" fill="white"/>
                        </svg>
                        Dismiss
                    </a>
                </div>
            </div>';

		return $output;
	}

	public function get_inactive_license_notice_content( $screen ) {
		$output = '<div id="sby-license-inactive-agp" class="sby-license-inactive-agp sby-le-flow-1">
				<div class="sb-left">
					<div class="sb-left-content">
						<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M10 0C4.48 0 0 4.48 0 10C0 15.52 4.48 20 10 20C15.52 20 20 15.52 20 10C20 4.48 15.52 0 10 0ZM11 15H9V13H11V15ZM11 11H9V5H11V11Z" fill="#D72C2C"></path>
						</svg>
						<h4>Your license key is inactive</h4>
						<p>No license key detected. Please activate your license key to enable Pro features.</p>
					</div>
				</div>
				<div class="sb-right">
					<div class="sby-buttons">';
					if ( $screen == 'instagram-feed_page_sbi-settings' ) {
						$output .= '<a class="sb-btn sb-btn-blue"  id="sbFocusLicenseSection">Activate License Key</a>';
					} else {
						$output .= '<a href="'. admin_url('admin.php?page=sbi-settings&focus=license').'" class="sby-buttons"><span class="sb-btn sb-btn-blue">Activate License Key</span></a>';
					}
					$output .= '<a class="sb-btn sb-btn-grey" @click.prevent.default="activateView(\'licenseLearnMore\')">Learn More</a>
					</div></div>
			</div>';
		return $output;
	}

	/**
	 * Activate License AJAX Handler
	 *
	 * @since 6.2.0
	 */
	public function ajax_activate_license() {
		check_ajax_referer( 'sbi-admin', 'nonce' );

		if ( ! sbi_builder_pro()->license_service->capability_check ) {
			return;
		}

		$license_key = sanitize_text_field( $_POST['license_key'] );

		$response = $this->sbi_activate_license($license_key);

		if ( $response === true ) {
			wp_send_json_success();
		}

		wp_send_json_error();
	}

	/**
	 * Activate License
	 *
	 * @since 6.2.0
	 */
	public function sbi_activate_license($license_key) {
		// retrieve the license from the database
		$sbi_license_key= trim( $license_key );

		// data to send in our API request
		$api_params = array(
			'edd_action' => 'activate_license',
			'license'    => $sbi_license_key,
			'item_name'  => urlencode( SBI_PLUGIN_NAME ), // the name of our product in EDD
			'url'        => home_url()
		);

		// Call the custom API.
		$response = wp_remote_get( add_query_arg( $api_params, SBI_STORE_URL ),
			array( 'timeout' => 15, 'sslverify' => false ) );

		// make sure the response came back okay
		if ( is_wp_error( $response ) ) {
			return false;
		}

		// decode the license data
		$sbi_license_data = (array) json_decode( wp_remote_retrieve_body( $response ) );

		if (
			$sbi_license_data['success'] 	== false ||
			$sbi_license_data['error'] 		== 'missing' ||
			$sbi_license_data['license'] 	== 'invalid_item_id' ||
			$sbi_license_data['license'] 	== 'invalid' ||
			$sbi_license_data['license'] 	== 'expired' ||
			$sbi_license_data['error'] 		== 'missing' )
		{
			return false;
		}

		// only store the license key
		update_option( 'sbi_license_key', $license_key );
		//store the license data in an option
		update_option( 'sbi_license_data', $sbi_license_data );
		// $license_data->license will be either "valid" or "invalid"
		update_option( 'sbi_license_status', $sbi_license_data['license'] );
		// make license check_api true so next time it expires it checks again
		update_option( 'sbi_check_license_api_when_expires', 'true' );
		update_option( 'sbi_check_license_api_post_grace_period', 'true' );

		return true;
	}

}
