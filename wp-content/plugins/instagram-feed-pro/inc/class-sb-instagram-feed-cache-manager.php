<?php

namespace InstagramFeed;

class SBI_Feed_Cache_Manager {
	/**
	 * @var false|int
	 */
	private $next_scheduled;

	/**
	 * @var string
	 */
	private $cache_type;

	public function __construct( $update_cron, $cache_type ) {
		$this->next_scheduled = wp_next_scheduled( $update_cron );
		$this->cache_type     = $cache_type;
	}

	private function should_fallback() {
		return ( $this->next_scheduled - time() ) < 0;
	}

	public function get_caching_type() {
		if ( $this->should_fallback() ) {
			return 'page';
		}

		return $this->cache_type;
	}
}