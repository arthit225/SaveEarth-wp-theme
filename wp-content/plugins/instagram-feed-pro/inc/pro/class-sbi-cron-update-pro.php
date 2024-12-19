<?php
/**
 * Class SB_Instagram_Cron_Updater_Pro
 *
 * The use of recent hashtag feeds that require some posts
 * to be loaded strictly from the sb_instagram_posts custom
 * tables in the database means that updating in the background
 * requires some additional logic.
 *
 * @since 5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class SB_Instagram_Cron_Updater_Pro extends  SB_Instagram_Cron_Updater {

	/**
	 * Loop through all feed cache transients and update the post and
	 * header caches.
	 *
	 * Pro - Need to use the Pro version of the single cron update
	 *
	 * @since 5.0
	 * @since 5.1.2 feed cache array is shuffled to accommodate large numbers of feeds
	 */
	public static function do_feed_updates() {
		$cron_records = \InstagramFeed\Builder\SBI_Db::feed_caches_query( array( 'cron_update' => true ) );

		$num = count( $cron_records );
		if ( $num === \InstagramFeed\Builder\SBI_Db::RESULTS_PER_CRON_UPDATE ) {
			wp_schedule_single_event( time() + 120, 'sbi_cron_additional_batch' );
		}

		self::update_batch( $cron_records );
	}

	public static function update_batch( $cron_records ) {
		$report = array(
			'notes' => array(
				'time_ran'             => date( 'Y-m-d H:i:s' ),
				'num_found_transients' => count( $cron_records ),
			),
		);

		$settings = sbi_get_database_settings();

		foreach ( $cron_records as $feed_cache ) {
			$feed_id            = $feed_cache['feed_id'];
			$report[ $feed_id ] = array();

			$cache = new SB_Instagram_Cache( $feed_id );
			$cache->retrieve_and_set();
			$cache->update_last_updated();
			$posts_cache = $cache->get( 'posts' );

			if ( $posts_cache ) {
				$feed_data = json_decode( $posts_cache, true );

				$atts                                = isset( $feed_data['atts'] ) ? $feed_data['atts'] : false;
				$last_retrieve                       = isset( $feed_data['last_retrieve'] ) ? (int) $feed_data['last_retrieve'] : 0;
				$last_requested                      = isset( $feed_data['last_requested'] ) ? (int) $feed_data['last_requested'] : false;
				$report[ $feed_id ]['last_retrieve'] = date( 'Y-m-d H:i:s', $last_retrieve );
				if ( $atts !== false ) { // not needed after v6?

					if ( ! $last_requested || $last_requested > ( time() - 60 * 60 * 24 * 30 ) ) {
						$instagram_feed_settings = new SB_Instagram_Settings_Pro( $atts, $settings );

						self::do_single_feed_cron_update( $instagram_feed_settings, $feed_data, $atts );

						$report[ $feed_id ]['did_update'] = 'yes';
					} else {
						$report[ $feed_id ]['did_update'] = 'no - not recently requested';
					}
				} else {
					$report[ $feed_id ]['did_update'] = 'no - missing atts';
				}
			} else {
				$report[ $feed_id ]['did_update'] = 'no - no post cache found';
			}
		}

		update_option( 'sbi_cron_report', $report, false );
	}

	/**
	 * Update a single feed cache based on settings
	 *
	 * Pro - Logic added for recent hashtag feeds that require retrieving
	 *       old posts from the custom database tables
	 *
	 * @param $instagram_feed_settings
	 * @param $feed_data
	 * @param $atts
	 * @param bool $include_resize
	 *
	 * @return object
	 *
	 * @since 5.0
	 */
	public static function do_single_feed_cron_update( $instagram_feed_settings, $feed_data, $atts, $include_resize = true ) {
		$instagram_feed_settings->set_feed_type_and_terms();
		$instagram_feed_settings->set_transient_name();
		$transient_name      = $instagram_feed_settings->get_transient_name();
		$settings            = $instagram_feed_settings->get_settings();
		$feed_type_and_terms = $instagram_feed_settings->get_feed_type_and_terms();

		$instagram_feed = new SB_Instagram_Feed_Pro( $transient_name );
		$instagram_feed->set_cache( $instagram_feed_settings->get_cache_time_in_seconds(), $settings );

		while ( $instagram_feed->need_posts( $settings['num'] ) && $instagram_feed->can_get_more_posts() ) {
			$instagram_feed->add_remote_posts( $settings, $feed_type_and_terms, $instagram_feed_settings->get_connected_accounts_in_feed() );
		}

		if ( $instagram_feed->out_of_next_pages() || $instagram_feed->should_look_for_db_only_posts( $settings, $feed_type_and_terms ) ) {
			$instagram_feed->add_report( 'Adding Db only posts' );

			$instagram_feed->add_db_only_posts( $transient_name, $settings, $feed_type_and_terms );
		}

		do_action( 'sbi_before_feed_cache_update', $instagram_feed, $transient_name, $instagram_feed_settings->get_connected_accounts_in_feed() );

		$post_data = $instagram_feed->get_post_data();
		if ( $instagram_feed->using_an_allow_list( $settings ) && ( $instagram_feed->out_of_next_pages() || count( $post_data ) < $settings['minnum'] ) ) {
			$instagram_feed->add_report( 'Adding allow list only posts' );
			$instagram_feed->add_db_only_allow_list_posts( $settings );
		}

		$to_cache = array(
			'atts'           => $atts,
			'last_requested' => $feed_data['last_requested'],
			'last_retrieve'  => time(),
		);

		$instagram_feed->set_cron_cache( $to_cache, $instagram_feed_settings->get_cache_time_in_seconds(), $settings['backup_cache_enabled'] );

		if ( $instagram_feed->need_header( $settings, $feed_type_and_terms ) ) {
			$instagram_feed->set_remote_header_data( $settings, $feed_type_and_terms, $instagram_feed_settings->get_connected_accounts_in_feed() );
			$header_data = $instagram_feed->get_header_data();
			if ( $settings['stories'] && ! empty( $header_data ) ) {
				$instagram_feed->set_remote_stories_data( $settings, $feed_type_and_terms, $instagram_feed_settings->get_connected_accounts_in_feed() );
			}
			$instagram_feed->cache_header_data( $instagram_feed_settings->get_cache_time_in_seconds(), $settings['backup_cache_enabled'] );
		}

		if ( $include_resize ) {
			$fill_in_timestamp = date( 'Y-m-d H:i:s', time() + 150 );

			$image_sizes = array(
				'personal' => array(
					'full'  => 640,
					'low'   => 320,
					'thumb' => 150,
				),
				'business' => array(
					'full'  => 640,
					'low'   => 320,
					'thumb' => 150,
				),
			);

			$post_set = new SB_Instagram_Post_Set( $post_data, $transient_name, $fill_in_timestamp, $image_sizes );

			$post_set->maybe_save_update_and_resize_images_for_posts();
		}

		sbi_delete_image_cache( $transient_name );

		do_action( 'sbi_after_single_feed_cron_update', $transient_name );

		return $instagram_feed;
	}

}
