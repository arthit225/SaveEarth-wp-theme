<?php

namespace Templately\Core\Importer\Runners;


use Exception;
use Templately\Core\Importer\Utils\Utils;

class Finalizer extends BaseRunner {
	private $options       = [];
	private $type_to_check = [ 'templates', 'content' ];
	private $imported_data;

	private $type     = '';
	private $sub_type = '';
	private $extra_content;

	private $total_counts    = 0;

	/**
	 * @var array|mixed
	 */
	protected $map_post_ids = [];
	/**
	 * @var array|mixed
	 */
	protected $map_term_ids = [];

	public function get_name(): string {
		return 'finalize';
	}

	public function get_label(): string {
		return __( 'Finalizing Your Imports', 'templately' );
	}

	public function log_message(): string {
		return __( 'Finalizing Your Imports', 'templately' );
	}

	public function should_run( $data, $imported_data = [] ): bool {
		$data = [];

		foreach ( $this->type_to_check as $type ) {
			$contents = ! empty ( $this->manifest[ $type ] ) ? $this->manifest[ $type ] : [];
			if ( $type == 'templates' ) {
				$this->prepare( $data, $contents, $type );
			} else {
				foreach ( $contents as $post_type => $templates ) {
					$this->prepare( $data, $templates, $type, $post_type );
				}
			}
		}
		$this->options = &$data;

		return ! empty( $data ) || $this->platform == 'gutenberg';
	}

	private function prepare( &$data, $templates, $type, $sub_type = null ) {
		if ( empty( $templates ) || ! is_array( $templates ) ) {
			return;
		}
		foreach ( $templates as $id => $template ) {
			if ( ! isset( $template['data'] ) && !isset( $template['__attachments']) && !isset($template['has_logo']) ) {
				continue;
			}

			// if ( ! isset( $template['data']['form'] ) && ! isset( $template['data']['nav_menus'] )) {
			// 	continue;
			// }

			$this->total_counts += 1;

			if ( $sub_type ) {
				$data[ $type ][ $sub_type ][ $id ] = $template;
			} else {
				$data[ $type ][ $id ] = $template;
			}
		}
	}

	public function import( $data, $imported_data ): array {
		$this->imported_data = &$imported_data;

		$this->json->imported_data = $this->imported_data;
		$this->json->map_post_ids  = Utils::map_old_new_post_ids( $this->imported_data );
		$this->json->map_term_ids  = Utils::map_old_new_term_ids( $this->imported_data );
		if ( ! empty( $imported_data['extra-content'] ) ) {
			$this->extra_content = $imported_data['extra-content'];
		}

		add_action('templately_import.finalize_gutenberg_attachment', [$this, 'post_log'], 10, 2);

		// Get the processed templates from the session data
		$processed = $this->origin->get_progress();

		if(empty($processed)){
			$this->log( 0 );
			$processed = ["__started__"];
			$this->origin->update_progress( $processed);
		}

		foreach ( $this->options as $type => $contents ) {
			$this->type = $type;

			// If the template has been processed, skip it
			if (in_array($type, $processed)) {
				continue;
			}

			if ( $type == 'templates' ) {
				$this->finalize_imports( $contents );

				$processed[] = $type;
				$this->origin->update_progress( $processed);
				// If it's not the last item, send the SSE message and exit
				if( end($this->options) !== $contents ) {
					$this->sse_message( [
						'type'    => 'continue',
						'action'  => 'continue',
						'results' => __METHOD__ . '::' . __LINE__,
					] );
					exit;
				}
			} else {
				foreach ( $contents as $post_type => $templates ) {
					// If the template has been processed, skip it
					if (in_array("$type::$post_type", $processed)) {
						continue;
					}

					$this->sub_type = $post_type;
					$this->finalize_imports( $templates );

					$processed[] = "$type::$post_type";
					$this->origin->update_progress( $processed);
					// If it's not the last item, send the SSE message and exit
					if( end($contents) !== $templates ) {
						$this->sse_message( [
							'type'    => 'continue',
							'action'  => 'continue',
							'results' => __METHOD__ . '::' . __LINE__,
						] );
						exit;
					}
				}
			}
		}

		if ( $this->platform == 'gutenberg' ) {
			$this->regenerate_assets();
		}

		return [];
	}

	private function regenerate_assets() {
		$upload_dir = wp_upload_dir();
		if ( is_dir( $upload_dir['basedir'] . '/eb-style/' ) ) {
			array_map( 'unlink', glob( $upload_dir['basedir'] . '/eb-style/*.min.css' ) );
			rmdir( $upload_dir['basedir'] . '/eb-style/' );
		}
	}

	private function finalize_imports( $templates ) {
		// Get the processed templates from the session data
		$processed = $this->origin->get_progress();

		foreach ( $templates as $old_template_id => $template_settings ) {
			// If the template has been processed, skip it
			if (in_array($old_template_id, $processed)) {
				continue;
			}

			try {
				$path = $this->dir_path . $this->type . DIRECTORY_SEPARATOR;
				if ( ! empty( $this->sub_type ) ) {
					$path .= $this->sub_type . DIRECTORY_SEPARATOR;
				}
				$path          .= "{$old_template_id}.json";
				$template_json = Utils::read_json_file( $path );
				$params = $this->origin->get_request_params();
				$this->json->prepare( $template_json, $template_settings, $this->extra_content['form'][ $old_template_id ] ?? [], $params )->update();

				// Broadcast Log
				$progress = floor( ( 100 * count($processed) ) / $this->total_counts );
				$this->log( $progress );
			} catch ( Exception $e ) {
				continue;
			}

			// Add the template to the processed templates and update the session data
			$processed[] = $old_template_id;
			$this->origin->update_progress( $processed);

			// If it's not the last item, send the SSE message and exit
			if( end($templates) !== $template_settings) {
				$this->sse_message( [
					'type'    => 'continue',
					'action'  => 'continue',
					'results' => __METHOD__ . '::' . __LINE__,
				] );
				exit;
			}
		}
	}

	public function post_log($id, $size_dimension = null){
		$this->log(-1, "Imported attachment: $id" . ( $size_dimension ? " - $size_dimension" : ''), 'eventLog');
	}
}