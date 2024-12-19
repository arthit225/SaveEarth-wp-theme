<?php

namespace InstagramFeed;

use InstagramFeed\Admin\SBI_HTTP_Request;

class SBI_License_Service {

	/**
	 * Instance
	 *
	 * @since 4.4
	 * @access private
	 * @static
	 * @var CFF_License_Service
	 */
	private static $instance;

	/**
	 * Get license renew URL.
	 *
	 * @since 4.4
	 * @access public
	 */
	public $get_renew_url;

	/**
	 * User Capability Check.
	 *
	 * @since 4.4
	 * @access public
	 */
	public $capability_check;

	/**
	 * Get the plugin license key.
	 *
	 * @since 4.4
	 * @access public
	 */
	public $get_license_key;

	/**
	 * Get the plugin license data
	 *
	 * @since 4.4
	 * @access public
	 */
	public $get_license_data;

	/**
	 * Check whether the license expired or not
	 *
	 * @since 4.4
	 * @access public
	 */
	public $is_license_expired;

	/**
	 * Check whether the grace period ended or not
	 *
	 * @since 4.4
	 * @access public
	 */
	public $is_license_grace_period_ended;

	/**
	 * Check whether the license expired and grace period ended
	 *
	 * @since 4.4
	 * @access public
	 */
	public $expiredLicenseWithGracePeriodEnded;

	/**
	 * Should disable Pro features
	 *
	 * @since 4.4
	 * @access public
	 */
	public $should_disable_pro_features;

	/**
	 * Instantiate the class
	 */
    public static function instance() {
        if ( null === self::$instance) {
			self::$instance = new self();
			
			self::$instance->get_renew_url = self::get_renew_url();
			self::$instance->capability_check = self::capability_check();
			self::$instance->get_license_key = self::get_license_key();
			self::$instance->get_license_data = self::get_license_data();
			self::$instance->is_license_expired = self::is_license_expired();
			self::$instance->is_license_grace_period_ended = self::is_license_grace_period_ended();
			self::$instance->expiredLicenseWithGracePeriodEnded = self::expiredLicenseWithGracePeriodEnded();
			self::$instance->should_disable_pro_features = self::should_disable_pro_features();
        }

		return self::$instance;
    }

	public static function capability_check() {
		if ( !function_exists('wp_get_current_user') ) { 
			include( ABSPATH . "wp-includes/pluggable.php" ); 
		}
		$cap             = current_user_can( 'manage_instagram_feed_options' ) ? 'manage_instagram_feed_options' : 'manage_options';
		$cap             = apply_filters( 'sbi_settings_pages_capability', $cap );
		return $cap;
	}

	public static function is_current_screen_allowed() {
		$allowed_screens = array(
			'instagram-feed_page_sbi-feed-builder',
			'instagram-feed_page_sbi-settings',
			'instagram-feed_page_sbi-oembeds-manager',
			'instagram-feed_page_sbi-extensions-manager',
			'instagram-feed_page_sbi-about-us',
			'instagram-feed_page_sbi-support',
		);
		$allowed_screens = apply_filters( 'sbi_admin_pages_allowed_screens', $allowed_screens );
		$current_screen = get_current_screen();
		$is_allowed = in_array( $current_screen->id, $allowed_screens );
		return array(
			'is_allowed' => $is_allowed,
			'base' => $current_screen->base,
		);
	}

	public static function get_license_key() {
		$license_key = get_option( 'sbi_license_key' );
		$license_key = apply_filters( 'sbi_license_key', $license_key );
		return trim($license_key);
	}
	
	public static function get_license_data() {
		if ( get_option( 'sbi_license_data' ) ) {
			// Get license data from the db and convert the object to an array
			return (array) get_option( 'sbi_license_data' );
		}

		$sbi_license_data = self::sbi_check_license( self::$instance->get_license_key );

		return $sbi_license_data;
	}

	public static function is_license_expired() {
		$sbi_license_data = (array) self::$instance->get_license_data;
		//If expires param isn't set yet then set it to be a date to avoid PHP notice
		$sbi_license_expires_date = isset( $sbi_license_data['expires'] ) ? $sbi_license_data['expires'] : '2036-12-31 23:59:59';
		if ( $sbi_license_expires_date === 'lifetime' ) {
			$sbi_license_expires_date = '2036-12-31 23:59:59';
		}
		$sbi_todays_date = gmdate( 'Y-m-d' );
		$sbi_interval = round( abs( strtotime( $sbi_todays_date ) - strtotime( $sbi_license_expires_date ) ) / 86400 );
		//Is license expired?
		if ( $sbi_interval === 0 || strtotime( $sbi_license_expires_date ) < strtotime( $sbi_todays_date ) ) {
			//If we haven't checked the API again one last time before displaying the expired notice then check it to make sure the license hasn't been renewed
			if ( get_option( 'sbi_check_license_api_when_expires' ) !== 'false' ) {
				$sbi_license_expired = self::$instance->sbi_check_license( self::$instance->get_license_key, true );
			} else {
				$sbi_license_expired = true;
			}
		} else {
			$sbi_license_expired = false;
			//License is not expired so change the check_api setting to be true so the next time it expires it checks again
			update_option( 'sbi_check_license_api_when_expires', 'true' );
			update_option( 'sbi_check_license_api_post_grace_period', 'true' );
		}
		$sbi_license_expires_date_arr = str_split( $sbi_license_expires_date );
		// If expired date is returned as 1970 (or any other 20th century year) then it means that the correct expired date was not returned and so don't show the renewal notice
		if ( $sbi_license_expires_date_arr[0] === '1' ) {
			$sbi_license_expired = false;
		}
		
		// If there's no expired date then don't show the expired notification
		if ( empty( $sbi_license_expires_date ) || ! isset( $sbi_license_expires_date ) ) {
			$sbi_license_expired = false;
		}

		// Is license missing - ie. on very first check
		if ( isset( $sbi_license_data['error'] ) ) {
			if ( $sbi_license_data['error'] === 'missing' ) {
				$sbi_license_expired = false;
			}
		}

		return $sbi_license_expired;
	}

	public static function is_license_grace_period_ended( $post_grace_period = false ) {
		// Get license data
		$sbi_license_data = (array) self::$instance->get_license_data;
		//If expires param isn't set yet then set it to be a date to avoid PHP notice
		$sbi_license_expires_date = isset( $sbi_license_data['expires'] ) ? $sbi_license_data['expires'] : '2036-12-31 23:59:59';
		if ( $sbi_license_expires_date == 'lifetime' ) {
			$sbi_license_expires_date = '2036-12-31 23:59:59';
		}

		$sbi_todays_date = date('Y-m-d');
		$sbi_grace_period_date = strtotime( $sbi_license_expires_date . '+14 days');
		$sbi_grace_period_interval = round( abs( strtotime( $sbi_todays_date ) - $sbi_grace_period_date ) / 86400 );

		if ( $post_grace_period && strtotime( $sbi_todays_date ) > $sbi_grace_period_date ) {
			return true;
		}

		if ( $sbi_grace_period_interval == 0 || $sbi_grace_period_date < strtotime( $sbi_todays_date ) ) {
			return true;
		}

		return;
	}
	
	/**
	 * Check if licese expired/inactive notices needs to show
	 * 
	 * @since 2.0.2
	 */
	public static function expiredLicenseWithGracePeriodEnded() {
		return !empty( self::$instance->get_license_key ) && 
				self::$instance->is_license_expired && 
				self::is_license_grace_period_ended( true );
	}

	/**
	 * Check if need to disable the pro features
	 * 
	 * @since 2.0.2
	 */
	public static function should_disable_pro_features() {
		return empty( self::$instance->get_license_key ) || 
				( self::$instance->is_license_expired && 
				self::$instance->is_license_grace_period_ended( true ) );
	}
	
	/**
	 * Remote check for license status
	 * 
	 * @since 4.4
	 */
	public static function sbi_check_license( $sbi_license = null, $check_license_status = false, $license_api_second_check = false  ) {
		$sbi_license = $sbi_license ? $sbi_license : self::$instance->get_license_key;
		if ( empty( $sbi_license ) ) {
			return;
		}
		//Set a flag so it doesn't check the API again until the next time it expires
		if ( $license_api_second_check ) {
			update_option( 'sbi_check_license_api_post_grace_period', 'false' );
		} else {
			update_option( 'sbi_check_license_api_when_expires', 'false' );
		}
		
		// data to send to our API request
		$sbi_api_params = array(
			'edd_action' => 'check_license',
			'license'    => $sbi_license,
			'item_name'  => urlencode( SBI_PLUGIN_NAME ), // the name of our product in EDD
		);
		$api_url        = add_query_arg( $sbi_api_params, SBI_STORE_URL );
		$args           = array(
			'timeout'   => 60,
		);
		// Call the remore license request.
		$request = wp_remote_get( $api_url, $args );
		if ( is_wp_error( $request ) ) {
			return;
		}
		// decode the license data
		$sbi_license_data = (array) json_decode( wp_remote_retrieve_body( $request ) );
		if ( $sbi_license_data && is_array( $sbi_license_data ) && isset( $sbi_license_data['license'] ) ) {
			//Store license data in db
			update_option( 'sbi_license_data', $sbi_license_data );
			update_option( 'sby_license_status', $sbi_license_data['license'] );
		}
		$sbi_todays_date = gmdate( 'Y-m-d' );
		if ( $check_license_status ) {
			//Check whether it's active
			if( isset( $sbi_license_data['license'] ) && $sbi_license_data['license'] !== 'expired' && ( strtotime( $sbi_license_data['expires'] ) > strtotime( $sbi_todays_date ) ) ){
				$sbi_license_status = false;
			} else {
				$sbi_license_status = true;
			}

			return $sbi_license_status;
		}
		

		return $sbi_license_data;
	}

    /**
     * CFF Get Renew License URL
     *
     * @since 4.0
     *
     * @return string $url
     */
    public static function get_renew_url( $license_state = 'expired' ) {
		global $sbi_download_id;
		if ( $license_state == 'inactive' ) {
			return admin_url('admin.php?page=sbi-settings');
		}
		$license_key = self::$instance->get_license_key;
		$url = sprintf(
			'https://smashballoon.com/checkout/?edd_license_key=%s&download_id=%s&utm_campaign=instagram-pro&utm_source=expired-notice&utm_medium=renew-license',
			$license_key,
			$sbi_download_id
		);

		return $url;
    }
}
