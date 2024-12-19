<?php

namespace Templately\Core\Importer;

use Templately\Utils\Helper;

trait LogHelper {
	private $log_types = [
		''
	];

	public function sse_log( $type, $message, $progress = 1, $action = 'updateLog', $status = null ) {
		$data = [
			'action'   => $action,
			'type'     => $type,
			'progress' => $progress,
			'message'  => $message
		];

		if ( $progress == 100 && $status == null ) {
			$data['status'] = 'complete';
		} elseif ( $status != null ) {
			$data['status'] = $status;
		}

		$this->sse_message( $data );
	}

	public function removeLog( $type ) {
		$this->sse_message( [
			'action'   => 'removeLog',
			'type'     => $type,
			'progress' => 100
		] );
	}

	public function sse_message( $data ) {
		// Log the data into debug log file
		$this->debug_log( $data );

		$log = get_option( 'templately_fsi_log' ) ?: [];
		$log[] = $data;
		update_option( 'templately_fsi_log', $log );

		// if(Helper::should_flush()){
		// 	echo "event: message\n";
		// 	echo 'data: ' . wp_json_encode( $data ) . "\n\n";

		// 	// Extra padding.
		// 	echo esc_html( ':' . str_repeat( ' ', 2048 ) . "\n\n" );

		// 	flush();
		// }
		// else if($data['action'] === 'complete' || $data['action'] === 'downloadComplete' || $data['action'] === 'error'){
		// 	wp_send_json( $data );
		// }
	}

	/**
	 * Printing Error Logs in debug.log file.
	 *
	 * @param mixed $log
	 * @return void
	 */
	public function debug_log( $log ){
		if ( defined('TEMPLATELY_EVENT_LOG') && TEMPLATELY_EVENT_LOG === true ) {
			if ( is_array( $log ) || is_object( $log ) ) {
				error_log( print_r( $log, true ) );
			} else if($log) {
				error_log( $log );
			}
		}
	}
}