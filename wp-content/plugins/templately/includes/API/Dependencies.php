<?php

namespace Templately\API;

use stdClass;
use Templately\Utils\Helper;
use Templately\Utils\Database;
use Templately\Utils\Installer;
use WP_REST_Request;

use function current_user_can;


class Dependencies extends API {

	private $endpoint = 'dependencies';
	public $query = 'dependencies{ id, name, icon, plugin_file, plugin_original_slug, is_pro, link }';

	public function __construct() {
		parent::__construct();

		if(!empty($_GET['disable_redirect'])) {
			add_filter('wp_redirect', '__return_false', 999);
		}
	}

	public function permission_check( WP_REST_Request $request ) {
		$this->request = $request;
		// $_route = $request->get_route();

		// if( $_route === '/templately/v1/dependencies/install' && ! Helper::current_user_can( 'install_plugins' ) ) {
		// 	return Helper::error('invalid_permission', __( 'Sorry, you do not have permission to install a plugin.', 'templately' ), 'dependencies/install', 403 );
		// }

		return true;
	}

	public function register_routes() {
		$this->get( $this->endpoint, [ $this, 'get_dependencies' ] );
		$this->get( $this->endpoint  . '/plugins', [ $this, 'get_plugins' ] );
		$this->get( $this->endpoint  . '/themes', [ $this, 'get_themes' ] );
		$this->post( $this->endpoint . '/check', [$this, 'check_dependencies'] );
		$this->post( $this->endpoint . '/install', [$this, 'install_dependencies'] );
	}

	public function get_dependencies() {
		$dependencies = Database::get_transient( $this->endpoint );

		if( $dependencies ) {
			return $this->success( $dependencies );
		}

		$response = $this->http()->query(
			'dependencies',
			'id, name, icon, is_pro, platforms{ id, name, file_type, icon }'
		)->post();

		if( ! is_wp_error( $response ) ) {
			$_dependencies = [];
			if( ! empty( $response ) ) {
				$_dependencies[ 'unknown' ] = [];
				foreach( $response as $dependency ) {
					if( ! empty( $dependency['platforms'] ) ) {
						foreach( $dependency['platforms'] as $platform ) {
							if( ! isset( $_dependencies[ $platform['name'] ] ) ) {
								$_dependencies[ $platform['name'] ] = [];
							}
							$_dependencies[ $platform['name'] ][] = $dependency;
						}
					} else {
						$_dependencies[ 'unknown' ][] = $dependency;
					}
				}
			}

			Database::set_transient( $this->endpoint, $_dependencies );
			return $_dependencies;
		}

		return $response;
	}

	public function check_dependencies(){
		$dependencies = $this->get_param( 'dependencies', '', '' );
		$platform = $this->get_param( 'platform', 'elementor' );

		$_inactive_plugins = [];
		$_plugins = Helper::get_plugins();

		if( $platform === 'elementor' ) {
			$elementor_plugin              = new stdClass();
			$elementor_plugin->name        = __( 'Elementor', 'templately' );
			$elementor_plugin->plugin_file = 'elementor/elementor.php';
			$elementor_plugin->slug        = 'elementor';
			$elementor_plugin->is_pro      = false;
			$elementor_plugin->is_active   = Helper::is_plugin_active( 'elementor/elementor.php' );

			$_inactive_plugins[] = $elementor_plugin;
		}

		if ( ! empty( $dependencies ) && is_array( $dependencies ) ) {
			foreach ( $dependencies as $dependency ) {
				if( ! is_array( $dependency ) || ! isset( $dependency['plugin_file'] ) ) {
					continue;
				}

				$dependency  = ( object ) $dependency;
				if ( is_null( $dependency->plugin_file ) ) {
					continue;
				}

				$dependency->is_active = Helper::is_plugin_active( $dependency->plugin_file );

				if( isset( $dependency->plugin_original_slug ) ) {
					$dependency->slug = $dependency->plugin_original_slug;
					unset( $dependency->plugin_original_slug );
				}

				if ( $dependency->is_pro ) {
					if ( isset( $_plugins[ $dependency->plugin_file ] ) ) {
						unset( $dependency->is_pro );
						$dependency->message = __( 'You have the plugin installed.', 'templately' );
					}
				}
				$_inactive_plugins[] = $dependency;
			}
		}

		return [
			'dependencies' => $_inactive_plugins
		];
	}

	public function install_dependencies(){
		$requirements = $this->get_param( 'requirement', [], '' );
		if( empty( $requirements ) ) {
			return $this->error(
				'invalid_requirements',
				__('You have supplied an invalid requirements. Please reload the page and try again.'),
				'/install',
				400
			);
		}
		$installed = Installer::get_instance()->install( $requirements );
		if(empty($installed['success'])){
			return $this->error($installed['code'], $installed['message'], 'dependencies/install', 403 );
		}
		return $installed;
	}

	public function get_plugins() {
		require_once ABSPATH . 'wp-admin/includes/plugin.php';

		$plugins = array();

		foreach ( get_plugins() as $file => $data ) {
			// if ( is_wp_error( $this->check_read_permission( $file ) ) ) {
			// 	continue;
			// }

			$data = array(
				'plugin'       => substr( $file, 0, - 4 ),
				'status'       => $this->get_plugin_status( $file ),
				'name'         => $data['Name'],
				'plugin_uri'   => $data['PluginURI'],
				'author'       => $data['Author'],
				'author_uri'   => $data['AuthorURI'],
				'description'  => array(
					'raw'      => $data['Description'],
					'rendered' => $data['Description'],
				),
				'version'      => $data['Version'],
				'network_only' => $data['Network'],
				'requires_wp'  => $data['RequiresWP'],
				'requires_php' => $data['RequiresPHP'],
				'textdomain'   => $data['TextDomain'],
			);

			$plugins[] = $data;
		}

		return new \WP_REST_Response( $plugins );
	}

	public function get_themes() {
		$themes = array();

		$active_themes = wp_get_themes();
		$current_theme = wp_get_theme();

		foreach ( $active_themes as $theme_name => $theme ) {
			$data = array(
				'status'     => $theme->get_stylesheet() === $current_theme->get_stylesheet() ? 'active' : 'inactive',
				'template'   => $theme->get_template(),
				'stylesheet' => $theme->get_stylesheet(),
			);


			$plain_field_mappings = array(
				'requires_php' => 'RequiresPHP',
				'requires_wp'  => 'RequiresWP',
				'textdomain'   => 'TextDomain',
				'version'      => 'Version',
			);

			foreach ( $plain_field_mappings as $field => $header ) {
				$data[ $field ] = $theme->get( $header );
			}

			$rich_field_mappings = array(
				'author'      => 'Author',
				'author_uri'  => 'AuthorURI',
				'description' => 'Description',
				'name'        => 'Name',
				'tags'        => 'Tags',
				'theme_uri'   => 'ThemeURI',
			);

			foreach ( $rich_field_mappings as $field => $header ) {
				$data[ $field ]['raw'] = $theme->display( $header, false, true );
				$data[ $field ]['rendered'] = $theme->display( $header );
			}

			$themes[] = $data;
		}

		return new \WP_REST_Response( $themes );
	}

	/**
	 * Get's the activation status for a plugin.
	 *
	 * @since 5.5.0
	 *
	 * @param string $plugin The plugin file to check.
	 * @return string Either 'active' or 'inactive'.
	 */
	protected function get_plugin_status( $plugin ) {
		if ( is_plugin_active_for_network( $plugin ) ) {
			return 'active';
		}

		if ( is_plugin_active( $plugin ) ) {
			return 'active';
		}

		return 'inactive';
	}

}