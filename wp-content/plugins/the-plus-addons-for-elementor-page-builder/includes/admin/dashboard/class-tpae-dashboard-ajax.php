<?php
/**
 * The file store Database Default Entry
 *
 * @link    https://posimyth.com/
 * @since   6.0.0
 *
 * @package the-plus-addons-for-elementor-page-builder
 */

/**Exit if accessed directly.*/
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Tpae_Dashboard_Ajax' ) ) {

	/**
	 * Tpae_Dashboard_Ajax
	 *
	 * @since 6.0.0
	 */
	class Tpae_Dashboard_Ajax {

		/**
		 * Member Variable
		 *
		 * @var instance
		 */
		private static $instance;

		/**
		 * Member Variable
		 *
		 * @var global_setting
		 */
		public $global_setting = array();

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
		 * @since    6.0.0
		 */
		public function __construct() {
			add_action( 'wp_ajax_tpae_dashboard_ajax_call', array( $this, 'tpae_dashboard_ajax_call' ) );
		}

		/**
		 * Load the required dependencies for this plugin.
		 *
		 * @since 6.0.0
		 */
		public function tpae_dashboard_ajax_call() {

			if ( ! check_ajax_referer( 'tpae-db-nonce', 'nonce', false ) ) {

				$response = $this->tpae_set_response( false, 'Invalid nonce.', 'The security check failed. Please refresh the page and try again.' );

				wp_send_json( $response );
				wp_die();
			}

			if ( ! is_user_logged_in() || ! current_user_can( 'manage_options' ) ) {
				$response = $this->tpae_set_response( false, 'Invalid Permission.', 'Something went wrong.' );

				wp_send_json( $response );
				wp_die();
			}

			$type = isset( $_POST['type'] ) ? strtolower( sanitize_text_field( wp_unslash( $_POST['type'] ) ) ) : false;
			if ( ! $type ) {
				$response = $this->tpae_set_response( false, 'Invalid type.', 'Something went wrong.' );

				wp_send_json( $response );
				wp_die();
			}

			switch ( $type ) {
				case 'tpae_onload_data':
					$response = $this->tpae_onload_data();
					break;
				case 'tpae_set_widget_list':
					$response = $this->tpae_set_widget_list();
					break;
				case 'tpae_get_scan_widgets':
					$response = $this->tpae_get_elements_status_scan();
					break;
				case 'tpae_set_extra_options':
					$response = $this->tpae_set_extra_options();
					break;
				case 'tpae_get_custom_css_js':
					$response = $this->tpae_get_custom_css_js();
					break;
				case 'tpae_set_custom_css_js':
					$response = $this->tpae_set_custom_css_js();
					break;
				case 'tpae_set_listing_data':
					$response = $this->tpae_set_listing_data();
					break;
				case 'tpae_prev_version':
					$response = $this->tpae_prev_version();
					break;
				case 'tpae_rollback_check':
					$response = $this->tpae_rollback_check();
					break;
				case 'tpae_performance_manage':
					$response = $this->tpae_performance_manage();
					break;
				case 'tpae_plugin_install':
					$response = $this->tpae_plugin_install();
					break;
				case 'tpae_theme_install':
					$response = $this->tpae_theme_install();
					break;
				case 'tpae_api_call':
					$response = $this->tpae_api_call();
					break;
				case 'tpae_transient_manage':
					$response = $this->tpae_transient_manage();
					break;
				case 'tpae_wp_option_manage':
					$response = $this->tpae_wp_option_manage();
					break;
				case 'tpae_license_manage':
					$response = apply_filters( 'tpaep_licence_ajax_call', 'tpaep_license_manage' );
					break;
				case 'set_whitelabel':
					$response = apply_filters( 'tpaep_dashboard_ajax_call', 'tpaep_set_whitelabel' );
					break;
			}

			wp_send_json( $response );
			wp_die();
		}

		/**
		 * Set Response
		 *
		 * @since 6.0.0
		 */
		public function tpae_onload_data() {

			// $plugins = isset( $_POST['plugin_data'] ) ? json_decode( sanitize_text_field( wp_unslash( $_POST['plugin_data'] ) ) ) : array();

			$plugins = array(
				array(
					'name'        => 'wdesignkit',
					'status'      => '',
					'plugin_slug' => 'wdesignkit/wdesignkit.php',
				),
				array(
					'name'        => 'the-plus-addons-for-block-editor',
					'status'      => '',
					'plugin_slug' => 'the-plus-addons-for-block-editor/the-plus-addons-for-block-editor.php',
				),
				array(
					'name'        => 'uichemy',
					'status'      => '',
					'plugin_slug' => 'uichemy/uichemy.php',
				),
				array(
					'name'        => 'nexter-extension',
					'status'      => '',
					'plugin_slug' => 'nexter-extension/nexter-extension.php',
				),
				array(
					'name'        => 'envato-elements',
					'status'      => '',
					'plugin_slug' => 'envato-elements/envato-elements.php',
				),
			);

			$plugin_details = $this->tpae_check_plugins_depends( $plugins );
			$plugin_details = ! empty( $plugin_details ) ? $plugin_details : $plugins;

			$user = wp_get_current_user();

			$user_image = get_avatar_url( $user->ID );

			$tpae_pro = defined( 'THEPLUS_VERSION' ) ? 1 : 0;

			$get_whats_new      = get_transient( 'tp_dashboard_overview' );
			$get_active_widgets = $this->tpae_get_elements_status_scan();

			$user_info = array(
				'user_image'   => $user_image,
				'roles'        => $user->roles,
				'user_name'    => $user->display_name,
				'tpae_pro'     => $tpae_pro,
				'whatsnew'     => $get_whats_new,
				'used_widgets' => $get_active_widgets,
				'success'      => true,
			);

			$get_widget_list   = get_option( 'theplus_options', array() );
			$get_extra_option  = get_option( 'theplus_api_connection_data', array() );
			$get_listing_data  = get_option( 'post_type_options' );
			$get_custom_css_js = get_option( 'theplus_styling_data' );
			$get_performance   = get_option( 'theplus_performance' );

			$response = array(
				'success'       => true,
				'message'       => esc_html__( 'success', 'tpebl' ),
				'description'   => esc_html__( 'success', 'tpebl' ),
				'user_info'     => $user_info,
				'widgets'       => $get_widget_list,
				'extra_option'  => $get_extra_option,
				'listing_data'  => $get_listing_data,
				'plugin_detail' => $plugin_details,
				'custom_css_js' => $get_custom_css_js,
				'performance'   => $get_performance,
			);

			if ( defined( 'THEPLUS_VERSION' ) ) {

				$get_white_label = get_option( 'theplus_white_label' );

				$get_woo_thankyou_options = apply_filters( 'tpaep_dashboard_ajax_call', 'tpaep_woo_thankyou_options' );
				$get_licence_data         = apply_filters( 'tpaep_licence_ajax_call', 'tpaep_license_status' );

				$response['white_label']     = $get_white_label;
				$response['license_details'] = $get_licence_data;

				$response['extra_option']['thankyou_page'] = $get_woo_thankyou_options;
			}

			return $response;
		}

		/**
		 *
		 * It is Use for Check Plugin Dependency of template.
		 *
		 * @since 6.0.0
		 */
		public function tpae_check_plugins_depends( $plugins ) {
			$update_plugin = array();

			$all_plugins = get_plugins();

			foreach ( $plugins as $plugin ) {
				$pluginslug = ! empty( $plugin['plugin_slug'] ) ? sanitize_text_field( wp_unslash( $plugin['plugin_slug'] ) ) : '';

				if ( ! is_plugin_active( $pluginslug ) ) {
					if ( ! isset( $all_plugins[ $pluginslug ] ) ) {
							$plugin['status'] = 'unavailable';
					} else {
						$plugin['status'] = 'inactive';
					}

					$update_plugin[] = $plugin;
				} elseif ( is_plugin_active( $pluginslug ) ) {
					$plugin['status'] = 'active';
					$update_plugin[]  = $plugin;
				}
			}

			return $update_plugin;
		}

		/**
		 * Plugin Install
		 *
		 * @since 6.0.0
		 */
		public function tpae_set_widget_list() {

			$widget_data = json_decode( stripslashes( sanitize_text_field( wp_unslash( $_POST['widget_data'] ) ) ), true );

			$data = get_option( 'theplus_options' );

			if ( false === $data ) {
				return $this->tpae_set_response( false, 'oops.', 'oops.' );
			}

			update_option( 'theplus_options', $widget_data );

			$this->tpae_backend_catch_remove();

			return $this->tpae_set_response( true, 'Successfully.', 'Successfully.' );
		}

		/**
		 * Extra Options
		 *
		 * @since 6.0.0
		 */
		public function tpae_set_extra_options() {
			$get_options_data = get_option( 'theplus_api_connection_data' );

			$extra_options_data = isset( $_POST['extra_options_data'] ) ? sanitize_text_field( wp_unslash( $_POST['extra_options_data'] ) ) : '';
			$extra_options_data = json_decode( $extra_options_data, true );

			if ( empty( $get_options_data ) ) {
				add_option( 'theplus_api_connection_data', $extra_options_data, '', 'on' );
			} else {
				update_option( 'theplus_api_connection_data', $extra_options_data );
			}

			$this->tpae_backend_catch_remove();
			
			return $this->tpae_set_response( true, 'Data Updated.', 'Data Updated Successfully.' );
		}

		/**
		 * Scan Widget : Get all Scan Widget list
		 *
		 * @since 6.0.0
		 */
		public function tpae_get_elements_status_scan() {

			if ( ! current_user_can( 'install_plugins' ) ) {
				$response = $this->tpae_set_response( false, 'Invalid nonce.', 'The security check failed. Please refresh the page and try again.' );
				return $response;
			}

			global $wpdb;

			$post_ids = $wpdb->get_col( 'SELECT `post_id` FROM `' . $wpdb->postmeta . '`WHERE `meta_key` = \'_elementor_version\';' );

			$tp_widgets_list = '';

			$page = ! empty( $_GET['page'] ) ? sanitize_text_field( wp_unslash( $_GET['page'] ) ) : '';

			$theplus_options = get_option( 'theplus_options' );
			if ( ! empty( $theplus_options ) && isset( $theplus_options['check_elements'] ) ) {
				$tp_widgets_list = $theplus_options['check_elements'];
			}

			if ( empty( $post_ids ) ) {
				$output['message'] = 'All Unused Widgets Found!';
				$output['widgets'] = $tp_widgets_list;

				return $output;
			}

			$scan_post_ids = array();
			$countwidgets  = array();

			foreach ( $post_ids as $post_id ) {
				if ( 'revision' === get_post_type( $post_id ) ) {
					continue;
				}

				$get_widgets = $this->tpae_check_elements_status_scan( $post_id, $tp_widgets_list );

				$scan_post_ids[ $post_id ] = $get_widgets;

				if ( ! empty( $get_widgets ) ) {
					foreach ( $get_widgets as $value ) {
						if ( ! empty( $value ) && in_array( $value, $tp_widgets_list ) ) {
							$countwidgets[ $value ] = ( isset( $countwidgets[ $value ] ) ? absint( $countwidgets[ $value ] ) : 0 ) + 1;
						}
					}
				}
			}

			$output = array();
			$val1   = count( $tp_widgets_list );
			$val2   = count( $countwidgets );
			$val3   = $val1 - $val2;

			$output['message'] = '* ' . $val3 . ' Unused Widgets Found!';
			$output['widgets'] = $countwidgets;

			return $output;
		}

		/**
		 * Scan Widget : Check Elements Status for Scanning
		 *
		 * @since 6.0.0
		 *
		 * @param int   $post_id         Optional. The post ID to check elements status for.
		 * @param array $tp_widgets_list Optional. The list of The Plus Addons widgets.
		 */
		public function tpae_check_elements_status_scan( $post_id = '', $tp_widgets_list = '' ) {

			if ( ! current_user_can( 'install_plugins' ) ) {
				$response = $this->tpae_set_response( false, 'Invalid nonce.', 'The security check failed. Please refresh the page and try again.' );
				return $response;
			}

			if ( ! empty( $post_id ) ) {
				$meta_data = \Elementor\Plugin::$instance->documents->get( $post_id );

				if ( is_object( $meta_data ) ) {
					$meta_data = $meta_data->get_elements_data();
				}

				if ( empty( $meta_data ) ) {
					return '';
				}

				$to_return = array();

				\Elementor\Plugin::$instance->db->iterate_data(
					$meta_data,
					function ( $element ) use ( $tp_widgets_list, &$to_return ) {
						if ( ! empty( $element['widgetType'] ) && array_key_exists( str_replace( '-', '_', $element['widgetType'] ), array_flip( $tp_widgets_list ) ) ) {
							$to_return[] = str_replace( '-', '_', $element['widgetType'] );
						}
					}
				);
			}

			return array_values( $to_return );
		}

		/**
		 * Disable The Plus Addons Elements Status Scan
		 *
		 * @since 6.0.0
		 */
		public function tpae_set_disable_elements_status_scan() {

			if ( ! current_user_can( 'install_plugins' ) ) {
				$response = $this->tpae_set_response( false, 'Invalid nonce.', 'The security check failed. Please refresh the page and try again.' );
				return $response;
			}

			$message = '';

			$sacaneddatapass = ! empty( $_GET['SacanedDataPass'] ) ? wp_unslash( $_GET['SacanedDataPass'] ) : '';
			if ( isset( $sacaneddatapass ) && ! empty( $sacaneddatapass ) ) {
				$tp_widgets_list = '';

				$page            = ! empty( $_GET['page'] ) ? sanitize_text_field( wp_unslash( $_GET['page'] ) ) : '';
				$theplus_options = get_option( 'theplus_options' );

				if ( ! empty( $theplus_options ) && isset( $theplus_options['check_elements'] ) ) {
					$tp_widgets_list = $theplus_options['check_elements'];

					$val1 = count( $tp_widgets_list );
					$val2 = count( $sacaneddatapass );
					$val3 = $val1 - $val2;

					$theplus_options['check_elements'] = array_keys( $sacaneddatapass );

					update_option( 'theplus_options', $theplus_options, null, 'no' );

					l_theplus_library()->remove_backend_dir_files();

					$message = 'We have scanned your site and disabled ' . $val3 . ' unused The Plus Addons widgets.';
				}
			}

			return $message;
		}

		/**
		 * tpae_get_custom_css_js
		 *
		 * @since 6.0.0
		 */
		public function tpae_get_custom_css_js() {
			$theplus_styling_data = get_option( 'theplus_styling_data' );

			$css_rules = '';
			$js_rules  = '';

			if ( ! empty( $theplus_styling_data['theplus_custom_css_editor'] ) ) {
				$css_rules = $theplus_styling_data['theplus_custom_css_editor'];

				$css_rules     .= '<style>';
					$css_rules .= $theplus_styling_data['theplus_custom_css_editor'];
				$css_rules     .= '</style>';
			}

			if ( ! empty( $theplus_styling_data['theplus_custom_js_editor'] ) ) {
				$theplus_custom_js_editor = $theplus_styling_data['theplus_custom_js_editor'];
				$js_rules                 = $theplus_custom_js_editor;
				$js_rules                 = wp_print_inline_script_tag( $js_rules );
			}

			return array(
				'css' => $css_rules,
				'js'  => $js_rules,
			);
		}

		/**
		 * tpae_set_custom_css_js
		 *
		 * @since 6.0.0
		 */
		public function tpae_set_custom_css_js() {
			$theplus_styling_data = get_option( 'theplus_styling_data' );

			$new_code = json_decode( stripslashes( $_POST['new_code'] ), true );

			$css = isset( $new_code['css'] ) ? $new_code['css'] : '';
			$js  = isset( $new_code['js'] ) ? $new_code['js'] : '';

			$theplus_styling_data['theplus_custom_css_editor'] = $css;
			$theplus_styling_data['theplus_custom_js_editor']  = $js;

			if ( false == $theplus_styling_data ) {
				add_option( 'theplus_styling_data', $theplus_styling_data, '', 'yes' );
			} else {
				update_option( 'theplus_styling_data', $theplus_styling_data );
			}

			return $theplus_styling_data;
		}

		/**
		 * tpae_set_custom_css_js
		 *
		 * @since 6.0.0
		 */
		public function tpae_set_listing_data() {
			$get_listing = get_option( 'post_type_options' );

			$listing_data = isset( $_POST['listing_data'] ) ? sanitize_text_field( wp_unslash( $_POST['listing_data'] ) ) : '';
			$listing_data = json_decode( $listing_data, true );

			if ( false == $get_listing ) {
				add_option( 'post_type_options', $listing_data, '', 'yes' );
			} else {
				update_option( 'post_type_options', $listing_data );
			}

			return $this->tpae_set_response( true, 'Data Updated.', 'Data Updated Successfully.' );
		}

		/**
		 * Get Plugin Previous Versions
		 *
		 * @since 6.0.0
		 */
		public function tpae_prev_version() {

			$versions_list = get_transient( 'tpae_rollback_version_' . L_THEPLUS_VERSION );
			if ( $versions_list === false ) {

				require_once ABSPATH . 'wp-admin/includes/plugin-install.php';

				$plugin_info = plugins_api(
					'plugin_information',
					array(
						'slug' => 'the-plus-addons-for-elementor-page-builder',
					)
				);

				if ( empty( $plugin_info->versions ) || ! is_array( $plugin_info->versions ) ) {
					return array();
				}

				krsort( $plugin_info->versions );

				$versions_list = array();

				$index = 0;
				foreach ( $plugin_info->versions as $version => $download_link ) {
					if ( 25 <= $index ) {
						break;
					}

					$lowercase_version      = strtolower( $version );
					$check_rollback_version = ! preg_match( '/(beta|rc|trunk|dev)/i', $lowercase_version );

					$check_rollback_version = apply_filters( 'tpae_check_rollback_version', $check_rollback_version, $lowercase_version );

					if ( ! $check_rollback_version ) {
						continue;
					}

					if ( version_compare( $version, L_THEPLUS_VERSION, '>=' ) ) {
						continue;
					}

					++$index;
					$versions_list[] = $version;
				}

				set_transient( 'tpae_rollback_version_' . L_THEPLUS_VERSION, $versions_list, WEEK_IN_SECONDS );
			}

			return $versions_list;
		}

		/**
		 * Rollback to Previous Versions
		 *
		 * @since 6.0.0
		 */
		public function tpae_rollback_check() {

			$current_ver = isset( $_POST['version'] ) ? sanitize_text_field( wp_unslash( $_POST['version'] ) ) : '';

			$rv = $this->tpae_prev_version();
			if ( empty( $current_ver ) || ! in_array( $current_ver, $rv ) ) {
				return $this->tpae_set_response( false, 'Invalid nonce.', 'Try selecting another version.' );
			}

			$plugin_slug = basename( L_THEPLUS_PNAME, '.php' );

			$thisVersion     = $current_ver;
			$this_pluginName = L_THEPLUS_PBNAME;
			$this_pluginSlug = $plugin_slug;
			$this_pluginURL  = sprintf( 'https://downloads.wordpress.org/plugin/%s.%s.zip', $this_pluginSlug, $thisVersion );

			$plugin_info = array(
				'plugin_name' => $this_pluginName,
				'plugin_slug' => $this_pluginSlug,
				'version'     => $thisVersion,
				'package_url' => $this_pluginURL,
			);

			$update_plugins_data = get_site_transient( 'update_plugins' );

			if ( ! is_object( $update_plugins_data ) ) {
				$update_plugins_data = new \stdClass();
			}

			$plugin_info              = new \stdClass();
			$plugin_info->new_version = $thisVersion;
			$plugin_info->slug        = $this_pluginSlug;
			$plugin_info->package     = $this_pluginURL;
			$plugin_info->url         = 'https://theplusaddons.com/';

			$update_plugins_data->response[ $this_pluginName ] = $plugin_info;

			set_site_transient( 'update_plugins', $update_plugins_data );

			require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';

			$logo_url = L_THEPLUS_URL . 'assets/images/theplus-logo-small.png';

			$args = array(
				'url'    => 'update.php?action=upgrade-plugin&plugin=' . rawurlencode( $this_pluginName ),
				'plugin' => $this_pluginName,
				'nonce'  => 'upgrade-plugin_' . $this_pluginName,
				'title'  => '<img src="' . esc_url( $logo_url ) . '" alt="theplus-logo"><div class="theplus-rb-subtitle">' . esc_html__( 'Rollback to Previous Version', 'tpebl' ) . '</div>',
			);

			$upgrader_plugin = new \Plugin_Upgrader( new \Plugin_Upgrader_Skin( $args ) );
			$upgrader_plugin->upgrade( $this_pluginName );

			$activation_result = activate_plugin( $this_pluginName );

			return $this->tpae_set_response( true, 'Roll Back Successfully', 'Roll Back Successfully Done.' );
			// wp_redirect( esc_url( admin_url( 'admin.php?page=theplus_welcome_page' ) ) );
		}

		/**
		 * Performance Manage
		 *
		 * @since 6.0.0
		 */
		public function tpae_performance_manage() {
			$plus_cache_option = isset( $_POST['performance_option'] ) ? sanitize_text_field( wp_unslash( $_POST['performance_option'] ) ) : '';
			$plus_cache_option = json_decode( stripslashes( sanitize_text_field( wp_unslash( $plus_cache_option ) ) ), true );

			if ( ! empty( $plus_cache_option ) ) {
				update_option( 'theplus_performance', $plus_cache_option, '', 'on' );
			}

			return $this->tpae_set_response( true, 'Successfully.', 'Change Successfully.' );
		}

		/**
		 * Plugin Install
		 *
		 * @since 6.0.0
		 */
		public function tpae_plugin_install() {

			if ( ! current_user_can( 'install_plugins' ) ) {
				$response = $this->tpae_set_response( false, 'Invalid nonce.', 'The security check failed. Please refresh the page and try again.' );
				return $response;
			}

			$slug = isset( $_POST['slug'] ) ? sanitize_text_field( wp_unslash( $_POST['slug'] ) ) : '';
			$name = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
			if ( ! $slug ) {
				return $this->tpae_set_response( false, 'Slug Not Found.', 'Something went wrong.' );
			}

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
								'slug'   => $name,
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

			$plugin_basename = $slug;

			if ( ! isset( $installed_plugins[ $plugin_basename ] ) && empty( $installed_plugins[ $plugin_basename ] ) ) {

				$installed         = $upgrader->install( $plugin_info->download_link );
				$activation_result = activate_plugin( $plugin_basename );

				$success = null === $activation_result;
				$result  = $this->tpae_set_response( $success, "Successfully Install", "Successfully Install", '' );

			} elseif ( isset( $installed_plugins[ $plugin_basename ] ) ) {

				$activation_result = activate_plugin( $plugin_basename );

				$success = null === $activation_result;
				$result  = $this->tpae_set_response( $success, "Successfully Activate", "Successfully Activate", '' );

			}

			return $result;
		}

		/**
		 * Theme Install
		 *
		 * @since 6.0.0
		 */
		public function tpae_theme_install() {

			if ( ! current_user_can( 'install_themes' ) ) {
				$response = $this->tpae_set_response( false, 'Invalid nonce.', 'The security check failed. Please refresh the page and try again.' );
				return $response;
			}

			$name = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';

			$theme_slug    = $name;
			$theme_api_url = 'https://api.wordpress.org/themes/info/1.0/';

			// Parameters for the request
			$args = array(
				'body' => array(
					'action'  => 'theme_information',
					'request' => serialize(
						(object) array(
							'slug'   => $name,
							'fields' => array(
								'description'     => false,
								'sections'        => false,
								'rating'          => true,
								'ratings'         => false,
								'downloaded'      => true,
								'download_link'   => true,
								'last_updated'    => true,
								'homepage'        => true,
								'tags'            => true,
								'template'        => true,
								'active_installs' => false,
								'parent'          => false,
								'versions'        => false,
								'screenshot_url'  => true,
								'active_installs' => false,
							),
						)
					),
				),
			);

			// Make the request
			$response = wp_remote_post( $theme_api_url, $args );
			// Check for errors
			if ( is_wp_error( $response ) ) {
				$error_message = $response->get_error_message();

				$result = $this->tpae_set_response( false, 'oops', 'oops', '' );
			} else {
				$theme_info    = unserialize( $response['body'] );
				$theme_name    = $theme_info->name;
				$theme_zip_url = $theme_info->download_link;

				global $wp_filesystem;
				// Install the theme
				$theme = wp_remote_get( $theme_zip_url );

				if ( ! function_exists( 'WP_Filesystem' ) ) {
					require_once wp_normalize_path( ABSPATH . '/wp-admin/includes/file.php' );
				}

				WP_Filesystem();

				$active_theme = wp_get_theme();
				$theme_name   = $active_theme->get( 'Name' );

				$wp_filesystem->put_contents( WP_CONTENT_DIR . '/themes/' . $theme_slug . '.zip', $theme['body'] );
				$zip = new ZipArchive();
				if ( $zip->open( WP_CONTENT_DIR . '/themes/' . $theme_slug . '.zip' ) === true ) {
					$zip->extractTo( WP_CONTENT_DIR . '/themes/' );
					$zip->close();
				}

				$wp_filesystem->delete( WP_CONTENT_DIR . '/themes/' . $theme_slug . '.zip' );

				$result = $this->tpae_set_response( true, "Success $name", "Success $name", '' );
			}

			return $result;
		}

		/**
		 * API call and get Response
		 *
		 * @since 6.0.0
		 */
		public function tpae_api_call() {

			$method  = isset( $_POST['method'] ) ? sanitize_text_field( wp_unslash( $_POST['method'] ) ) : 'POST';
			$api_url = isset( $_POST['api_url'] ) ? sanitize_text_field( wp_unslash( $_POST['api_url'] ) ) : '';
			$body    = isset( $_POST['url_body'] ) ? json_decode( wp_unslash( $_POST['url_body'] ) ) : array();

			$args = array(
				'method'  => $method,
				'headers' => array(
					'Content-Type' => 'application/json',
				),
			);

			if ( ! empty( $body ) ) {
				$args['body'] = wp_json_encode( $body );
			}

			if ( 'POST' === $method ) {
				$response = wp_remote_post( $api_url, $args );
			}

			if ( 'GET' === $method ) {
				$response = wp_remote_get( $api_url, $args );
			}

			$statuscode = wp_remote_retrieve_response_code( $response );
			$getdataone = wp_remote_retrieve_body( $response );
			$statuscode = array( 'HTTP_CODE' => $statuscode );

			$response = json_decode( $getdataone, true );

			if ( is_array( $statuscode ) && is_array( $response ) ) {
				$final = array_merge( $statuscode, $response );
			}

			return $final;
		}

		/**
		 * Manage Databash Transient
		 *
		 * @since 6.0.0
		 */
		public function tpae_transient_manage() {

			$operation = isset( $_POST['operation'] ) ? sanitize_text_field( wp_unslash( $_POST['operation'] ) ) : '';
			$key       = isset( $_POST['key'] ) ? sanitize_text_field( wp_unslash( $_POST['key'] ) ) : '';

			if ( 'get' === $operation ) {
				$data = get_transient( $key );

				if ( false === $data ) {
					return $this->tpae_set_response( false, 'oops.', 'oops.' );
				}

				return $data;
			} elseif ( 'delete' === $operation ) {
				delete_option( $key );

				return $this->tpae_set_response( true, 'Successfully.', 'Successfully.' );
			}
		}

		/**
		 * Manage Wp Option Table
		 *
		 * @since 6.0.0
		 */
		public function tpae_wp_option_manage() {
			$operation = isset( $_POST['operation'] ) ? sanitize_text_field( wp_unslash( $_POST['operation'] ) ) : '';
			$key       = isset( $_POST['key'] ) ? sanitize_text_field( wp_unslash( $_POST['key'] ) ) : '';

			if ( 'get' === $operation ) {
				// $data = get_transient( $key );

				// if( false === $data ) {
				// return $this->tpae_set_response( false, 'oops.', 'oops.' );
				// }

				// return $data;
			} elseif ( 'delete' === $operation ) {
				delete_option( $key );

				return $this->tpae_set_response( true, 'Successfully.', 'Successfully.' );
			}
		}

		/**
		 * Plugin Install
		 *
		 * @since 6.0.0
		 */
		public function tpae_backend_catch_remove() {
			l_theplus_library()->remove_backend_dir_files();
		}

		/**
		 * Set the response data.
		 *
		 * @since 6.0.0
		 *
		 * @param bool   $success     Indicates whether the operation was successful. Default is false.
		 * @param string $message     The main message to include in the response. Default is an empty string.
		 * @param string $description A more detailed description of the message or error. Default is an empty string.
		 * @param mixed  $data        Optional additional data to include in the response. Default is an empty string.
		 */
		public function tpae_set_response( $success = false, $message = '', $description = '', $data = '' ) {

			$response = array(
				'success'     => $success,
				'message'     => esc_html( $message ),
				'description' => esc_html( $description ),
			);

			return $response;
		}
	}

	Tpae_Dashboard_Ajax::get_instance();
}
