<?php

namespace Templately\Core\Importer\Utils;

use Exception;
use Templately\Utils\Base;

class Utils extends Base {
	/**
	 * @throws Exception
	 */
	public static function read_json_file( $path ) {
		if ( ! file_exists( $path ) ) {
			throw new Exception( __( 'JSON file not exists. ' . basename( $path ), 'templately' ) );
		}

		$file_content = self::file_get_contents( $path );

		return $file_content ? json_decode( $file_content, true ) : [];
	}

	/**
	 * @param $file
	 * @param mixed ...$args
	 *
	 * @return false|string
	 */
	public static function file_get_contents( $file, ...$args ) {
		if ( ! is_file( $file ) || ! is_readable( $file ) ) {
			return false;
		}

		return file_get_contents( $file, ...$args );
	}

	public static function get_builtin_wp_post_types(): array {
		$post_type_args = [
			'show_in_nav_menus' => true,
			'public'            => true
		];
		$_post_types    = get_post_types( $post_type_args, 'objects' );

		return array_merge( array_keys( $_post_types ), [ 'nav_menu_item', 'wp_navigation' ] );
	}

	public static function map_old_new_post_ids( array $imported_data ) {
		$result = [];

		$result += $imported_data['templates']['succeed'] ?? [];

		if ( isset( $imported_data['content'] ) ) {
			foreach ( $imported_data['content'] as $post_type ) {
				$result += $post_type['succeed'] ?? [];
			}
		}

		if ( isset( $imported_data['wp-content'] ) ) {
			foreach ( $imported_data['wp-content'] as $post_type ) {
				$result += $post_type['succeed'] ?? [];
			}
		}

		return $result;
	}

	public static function map_old_new_term_ids( array $imported_data ) {
		$result = [];

		if ( isset( $imported_data['terms'] ) ) {
			foreach ( $imported_data['terms'] as $post_type ) {
				$result += $post_type['succeed'] ?? [];
			}
		}

		return $result;
	}

	public static function map_old_new_term_ids_el( array $imported_data ): array {
		$result = [];

		if ( ! isset( $imported_data['taxonomies'] ) ) {
			return $result;
		}

		foreach ( $imported_data['taxonomies'] as $post_type_taxonomies ) {
			foreach ( $post_type_taxonomies as $taxonomy ) {
				foreach ( $taxonomy as $term ) {
					$result[ $term['old_id'] ] = $term['new_id'];
				}
			}
		}

		return $result;
	}

	/**
	 * @param string $platform
	 *
	 * @return ImportHelper
	 */
	public static function get_json_helper( string $platform ) {
		return $platform === 'elementor' ? new ElementorHelper() : new GutenbergHelper();
	}

	public static function get_backup_options() {
		global $wpdb;

		$prefix = '__templately_';
		$table_name = $wpdb->options; // Assuming default options table name

		$sql = "SELECT option_name, option_value FROM {$table_name} WHERE option_name LIKE %s";
		$prepared_sql = $wpdb->prepare($sql, array("$prefix%")); // Escape wildcard for security

		$results = $wpdb->get_results($prepared_sql);

		$templately_options = array();
		foreach ($results as $row) {
			$name = str_replace($prefix, '', $row->option_name);
			$templately_options[$name] = maybe_unserialize($row->option_value);
		}

		return $templately_options;
	}

	public static function backup_option_value($key, $autoload = 'no') {
		$old_value = get_option($key);
		if ($old_value) {
			update_option("__templately_$key", $old_value, $autoload);
		}
		else {
			add_option("__templately_$key", $old_value, '', $autoload);
		}
	}

	public static function update_option($key, $value, $autoload = 'no') {
		self::backup_option_value($key, $autoload);
		return update_option($key, $value, $autoload);
	}

	public static function import_page_settings( $id, $settings ) {
		$extra_settings = [
			'page_on_front' => [
				'show_on_front' => 'page'
			]
		];
		if ( isset( $settings['page_for_posts'] ) && $settings['page_for_posts'] ) {
			self::update_option( 'page_for_posts', $id );
		}
		if ( isset( $settings['show_on_front'] ) && $settings['show_on_front'] ) {
			self::update_option( 'page_on_front', $id );
			self::update_option( 'show_on_front', 'page' );
		}
		if ( ! empty( $settings['page_settings'] ) ) {
			foreach ( $settings['page_settings'] as $option_name => $val ) {
				self::update_option( $option_name, $id );
				if ( array_key_exists( $option_name, $extra_settings ) ) {
					foreach ( $extra_settings[ $option_name ] as $name => $value ) {
						self::update_option( $name, $value );
					}
				}
			}
		}
	}

	public static function upload_logo($url) {
		if(empty($url)) {
			return ['error' => __('URL is empty', 'templately')];
		}

		// Validate URL and ensure scheme is present
		if ( ! wp_http_validate_url( $url ) || !parse_url( $url, PHP_URL_SCHEME ) ) {
			return ['error' => __('Invalid URL', 'templately')];
		}

		// Download image and get MIME type
		$temp_file = download_url( $url );
		if ( is_wp_error( $temp_file ) ) {
			return ['error' => __('Failed to download image', 'templately')];
		}

		// Validate image type using wp_get_image_mime
		$mime_type = wp_get_image_mime( $temp_file );
		if ( ! $mime_type || !in_array( $mime_type, get_allowed_mime_types() ) ) {
			unlink( $temp_file );
			return ['error' => __('Invalid image type', 'templately')];
		}

		$file_info = wp_check_filetype_and_ext( $temp_file, basename( $url ), get_allowed_mime_types() );
		if ( ! $file_info['ext'] || $file_info['type'] !== $mime_type ) {
			unlink( $temp_file );
			return ['error' => __('File type and extension check failed', 'templately')];
		}

		// Prepare the file for sideloading
		$file = array(
			'name'     => basename($url),
			'type'     => $mime_type,
			'tmp_name' => $temp_file,
			'error'    => 0,
			'size'     => filesize($temp_file),
		);

		// Load the WordPress media handler
		require_once(ABSPATH . 'wp-admin/includes/media.php');
		require_once(ABSPATH . 'wp-admin/includes/file.php');
		require_once(ABSPATH . 'wp-admin/includes/image.php');

		// Handle the sideload
		$id = media_handle_sideload($file, 0);

		if (is_wp_error($id)) {
			@unlink($file['tmp_name']);
			return ['error' => __('Failed to sideload image', 'templately')];
		}

		return [
			'id'  => $id,
			'url' => esc_url_raw(wp_get_attachment_url($id)),
		];
	}
}