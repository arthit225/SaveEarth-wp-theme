<?php

namespace Templately\Utils;

use Automatic_Upgrader_Skin;
use Plugin_Upgrader;
use Theme_Upgrader;
use WP_Ajax_Upgrader_Skin;
use WP_Filesystem_Base;
use function activate_plugin;
use function current_user_can;
use function install_plugin_install_status;
use function is_plugin_inactive;
use function is_wp_error;
use function plugins_api;
use function sanitize_key;
use function wp_unslash;

class Installer extends Base {
	/**
	 * Some process take long time to execute
	 * for that need to raise the limit.
	 */
	public static function raise_limits() {
		wp_raise_memory_limit( 'admin' );
		if ( wp_is_ini_value_changeable( 'max_execution_time' ) ) {
			@ini_set( 'max_execution_time', 0 );
		}
		@ set_time_limit( 0 );
	}

	public function install( $plugin ): array {
		require_once ABSPATH . 'wp-admin/includes/plugin.php';
		require_once ABSPATH . 'wp-admin/includes/file.php';
		require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
		include_once ABSPATH . 'wp-admin/includes/plugin-install.php';

		$response = [ 'success' => false, 'message' => '' ];

		$_plugins     = Helper::get_plugins();
		$is_installed = isset( $_plugins[ $plugin['plugin_file'] ] );

		// Check if the plugin is already active
		if (is_plugin_active($plugin['plugin_file'])) {
			$response['success'] = true;
			$response['slug']    = $plugin['slug'];
			return $response;
		}

		if ( isset( $plugin['is_pro'] ) && $plugin['is_pro'] ) {
			if ( ! $is_installed ) {
				$response['code']    = 'pro_plugin';
				$response['message'] = 'Pro Plugin';
			}
		}

		if ( ! $is_installed ) {
			if(!Helper::current_user_can( 'install_plugins' )){
				$response['code']    = 'invalid_requirements';
				$response['message'] = __( 'Sorry, you do not have permission to install a plugin.', 'templately' );
				return $response;
			}

			/**
			 * @var array|object $api
			 */
			$api = plugins_api( 'plugin_information', [
				'slug'   => sanitize_key( wp_unslash( $plugin['slug'] ) ),
				'fields' => [
					'sections' => false,
				],
			] );

			if ( is_wp_error( $api ) ) {
				$response['message'] = $api->get_error_message();

				return $response;
			}

			$compatibility = $this->check_compatibility($api);
			if (!$compatibility['success']) {
				return $compatibility;
			}

			$response['name'] = $api->name;

			$skin     = new WP_Ajax_Upgrader_Skin();
			$upgrader = new Plugin_Upgrader( $skin );
			$result   = $upgrader->install( $api->download_link );

			if ( is_wp_error( $result ) ) {
				$response['code']    = $result->get_error_code();
				$response['message'] = $result->get_error_message();

				return $response;
			} elseif ( is_wp_error( $skin->result ) ) {
				$response['code']    = $skin->result->get_error_code();
				$response['message'] = $skin->result->get_error_message();

				return $response;
			} elseif ( $skin->get_errors()->has_errors() ) {
				$response['message'] = $skin->get_error_messages();

				return $response;
			} elseif ( is_null( $result ) ) {
				global $wp_filesystem;
				$response['code']    = 'unable_to_connect_to_filesystem';
				$response['message'] = __( 'Unable to connect to the filesystem. Please confirm your credentials.' );

				if ( $wp_filesystem instanceof WP_Filesystem_Base && is_wp_error( $wp_filesystem->errors ) && $wp_filesystem->errors->has_errors() ) {
					$response['message'] = esc_html( $wp_filesystem->errors->get_error_message() );
				}

				return $response;
			}
			else if($result !== true){
				$response['message'] = __('Failed to install plugin', 'templately');
				return $response;
			}

			$install_status        = install_plugin_install_status( $api );
			$plugin['plugin_file'] = $install_status['file'];
		}

		if ( !Helper::current_user_can( 'activate_plugins' ) && is_plugin_inactive( $file ) ) {
			$response['code']    = 'invalid_requirements';
			$response['message'] = __( 'Sorry, you do not have permission to activate a plugin.', 'templately' );
			return $response;
		}

		$activate_status = $this->activate_plugin( $plugin['plugin_file'] );

		if ( is_wp_error( $activate_status ) ) {
			$response['message'] = $activate_status->get_error_message();
		}

		if ( $activate_status && ! is_wp_error( $activate_status ) ) {
			$response['success'] = true;
		}

		$response['slug'] = $plugin['slug'];

		return $response;
	}

	public function install_and_activate_theme($theme_slug) {
		require_once(ABSPATH . 'wp-admin/includes/class-wp-upgrader.php');
		require_once(ABSPATH . 'wp-admin/includes/theme.php');
		require_once(ABSPATH . 'wp-admin/includes/theme-install.php');

		$response = ['success' => false];

		// Check if the theme is already active
		if ($theme_slug == get_option('stylesheet')) {
			$response['success'] = true;
			$response['message'] = __('Theme is already active', 'templately');
			return $response;
		}

		if (!function_exists('themes_api')) {
			$response['message'] = __('Function themes_api does not exist', 'templately');
			return $response;
		}

		$api = themes_api('theme_information', [
			'slug' => sanitize_key($theme_slug),
			'fields' => [
				'sections' => false,
			],
		]);

		if (is_wp_error($api)) {
			$response['message'] = $api->get_error_message();
			return $response;
		}

		$compatibility = $this->check_compatibility($api);
		if (!$compatibility['success']) {
			return $compatibility;
		}

		if (!wp_get_theme($theme_slug)->exists()) {
			$upgrader = new Theme_Upgrader(new Automatic_Upgrader_Skin());
			$result = $upgrader->install($api->download_link);

			if (is_wp_error($result)) {
				$response['message'] = $result->get_error_message();
				return $response;
			}
			else if($result !== true){
				$response['message'] = __('Failed to install theme', 'templately');
				return $response;
			}

			$response['install'] = 'success';
		}

		$activate_status = $this->activate_theme($theme_slug);

		if ( is_wp_error( $activate_status ) ) {
			$response['message'] = $activate_status->get_error_message();
		}
		else if ($activate_status) {
			$response['success'] = true;
		} else {
			$response['message'] = __('Failed to activate theme', 'templately');
		}

		return $response;
	}

	public function check_compatibility($api) {
		// Check compatibility with current PHP version
		if (version_compare(PHP_VERSION, $api->requires_php, '<')) {
			return [
				'success' => false,
				'message' => sprintf(__('The plugin requires PHP version %s or higher. You are running version %s.', 'templately'), $api->requires_php, PHP_MAJOR_VERSION . "." . PHP_MINOR_VERSION)
			];
		}

		// Check compatibility with current WP version
		global $wp_version;
		if (version_compare($wp_version, $api->requires, '<')) {
			return [
				'success' => false,
				'message' => sprintf(__('The plugin requires WordPress version %s or higher. You are running version %s.', 'templately'), $api->requires, $wp_version)
			];
		}

		return ['success' => true];
	}

	private function activate_plugin( $file ) {
		if ( is_plugin_active( $file ) ) {
			return true;
		}

		if ( Helper::current_user_can( 'activate_plugins' ) && is_plugin_inactive( $file ) ) {
			$result = activate_plugin( $file );
			if ( is_wp_error( $result ) ) {
				return $result;
			} else {
				return true;
			}
		}

		return false;
	}

	private function activate_theme($theme_slug) {
		if (get_option('stylesheet') == $theme_slug) {
			// The theme is already active
			return true;
		}

		if (Helper::current_user_can('switch_themes')) {
			// Activate the theme
			switch_theme($theme_slug);

			// Check if the theme was successfully activated
			if (get_option('stylesheet') == $theme_slug) {
				return true;
			} else {
				return new \WP_Error('theme_activation_failed', __('Failed to activate theme', 'templately'));
			}
		}

		return false;
	}

}