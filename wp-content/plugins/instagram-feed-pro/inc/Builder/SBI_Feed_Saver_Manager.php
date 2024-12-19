<?php
/**
 * Instagram Feed Saver Manager
 *
 * @since 6.0
 * @since INSTA_FEED_PRO_SINCE Added Feed template.
 */

namespace InstagramFeed\Builder;

use InstagramFeed\Traits\SBI_Feed_Template_Settings;

class SBI_Feed_Saver_Manager {

	use SBI_Feed_Template_Settings;

	/**
	 * AJAX hooks for various feed data related functionality
	 *
	 * @since 6.0
	 */
	public static function hooks() {
		add_action( 'wp_ajax_sbi_feed_saver_manager_builder_update', array( 'InstagramFeed\Builder\SBI_Feed_Saver_Manager', 'builder_update' ) );
		add_action( 'wp_ajax_sbi_feed_saver_manager_get_feed_settings', array( 'InstagramFeed\Builder\SBI_Feed_Saver_Manager', 'get_feed_settings' ) );
		add_action( 'wp_ajax_sbi_feed_saver_manager_get_feed_list_page', array( 'InstagramFeed\Builder\SBI_Feed_Saver_Manager', 'get_feed_list_page' ) );
		add_action( 'wp_ajax_sbi_feed_saver_manager_get_locations_page', array( 'InstagramFeed\Builder\SBI_Feed_Saver_Manager', 'get_locations_page' ) );
		add_action( 'wp_ajax_sbi_feed_saver_manager_delete_feeds', array( 'InstagramFeed\Builder\SBI_Feed_Saver_Manager', 'delete_feed' ) );
		add_action( 'wp_ajax_sbi_feed_saver_manager_duplicate_feed', array( 'InstagramFeed\Builder\SBI_Feed_Saver_Manager', 'duplicate_feed' ) );
		add_action( 'wp_ajax_sbi_feed_saver_manager_clear_single_feed_cache', array( 'InstagramFeed\Builder\SBI_Feed_Saver_Manager', 'clear_single_feed_cache' ) );
		add_action( 'wp_ajax_sbi_feed_saver_manager_importer', array( 'InstagramFeed\Builder\SBI_Feed_Saver_Manager', 'importer' ) );
		add_action( 'wp_ajax_sbi_feed_saver_manager_fly_preview', array( 'InstagramFeed\Builder\SBI_Feed_Saver_Manager', 'feed_customizer_fly_preview' ) );
		add_action( 'wp_ajax_sbi_feed_saver_manager_retrieve_comments', array( 'InstagramFeed\Builder\SBI_Feed_Saver_Manager', 'retrieve_comments' ) );
		add_action( 'wp_ajax_sbi_feed_saver_manager_clear_comments_cache', array( 'InstagramFeed\Builder\SBI_Feed_Saver_Manager', 'clear_comments_cache' ) );
		add_action( 'wp_ajax_sbi_feed_saver_manager_delete_source', array( 'InstagramFeed\Builder\SBI_Feed_Saver_Manager', 'delete_source' ) );
		add_action( 'wp_ajax_sbi_update_personal_account', array( 'InstagramFeed\Builder\SBI_Feed_Saver_Manager', 'sbi_update_personal_account' ) );



		//Detect Leaving the Page
		add_action( 'wp_ajax_sbi_feed_saver_manager_recache_feed', array( 'InstagramFeed\Builder\SBI_Feed_Saver_Manager', 'recache_feed' ) );

	}

	/**
	 * Used in an AJAX call to update settings for a particular feed.
	 * Can also be used to create a new feed if no feed_id sent in
	 * $_POST data.
	 *
	 * @since 6.0
	 */
	public static function builder_update() {
		check_ajax_referer( 'sbi-admin' , 'nonce');

		if ( ! sbi_current_user_can( 'manage_instagram_feed_options' ) ) {
			wp_send_json_error();
		}

		$settings_data = $_POST;

		$feed_id     = false;
		$is_new_feed = isset( $settings_data['new_insert'] ) ? true : false;
		if ( ! empty( $settings_data['feed_id'] ) ) {
			$feed_id = sanitize_text_field( $settings_data['feed_id'] );
			unset( $settings_data['feed_id'] );
		} elseif ( isset( $settings_data['feed_id'] ) ) {
			unset( $settings_data['feed_id'] );
		}
		unset( $settings_data['action'] );

		if ( ! isset( $settings_data['feed_name'] ) ) {
			$settings_data['feed_name'] = '';
		}

		$update_feed = isset( $settings_data['update_feed'] ) ? true : false;
		unset( $settings_data['update_feed'] );

		//Check if New
		if ( isset( $settings_data['new_insert'] ) && $settings_data['new_insert'] === 'true' && isset( $settings_data['sourcename'] ) ) {
			$settings_data['order'] = sanitize_text_field( $_POST['order'] );
			if ( $_POST['type'] === 'hashtag' ) {
				$settings_data['feed_name'] = sanitize_text_field( implode( ' ', $_POST['hashtag'] ) );
			} else {
				$settings_data['feed_name'] = SBI_Db::feeds_query_name( $settings_data['sourcename'] );
			}

			// Add feed settings depending on feed templates.
			$settings_data = self::get_feed_settings_by_feed_templates( $settings_data );
		}
		unset( $settings_data['new_insert'] );
		unset( $settings_data['sourcename'] );
		$feed_name = '';
		if ( $update_feed ) {
			$settings_data['settings']['sources'] = $_POST['sources'];
			$feed_name                            = $settings_data['feed_name'];
			$settings_data                        = $settings_data['settings'];
			$settings_data['shoppablelist']       = isset( $_POST['shoppablelist'] ) ? sbi_json_encode( $_POST['shoppablelist'] ) : array();
			$settings_data['moderationlist']      = isset( $_POST['moderationlist'] ) ? json_encode( $_POST['moderationlist'], true ) : array();
		}

		$source_ids   = $_POST['sources'];
		$args         = array( 'id' => $source_ids );
		$source_query = SBI_Db::source_query( $args );
		$sources      = array();
		if ( ! empty( $source_query ) ) {
			foreach ( $source_query as $source ) {
				$sources[] = $source['account_id'];
			}
		}

		$settings_data['sources'] = $sources;
		$settings_data['user']    = '';
		unset( $settings_data['sources'] );
		$settings_data['id'] = $sources;

		$feed_saver = new SBI_Feed_Saver( $feed_id );
		$feed_saver->set_feed_name( $feed_name );
		$feed_saver->set_data( $settings_data );

		$return = array(
			'success' => false,
			'feed_id' => false,
		);
		if ( $feed_saver->update_or_insert() ) {
			$return = array(
				'success' => true,
				'feed_id' => $feed_saver->get_feed_id(),
			);
			if ( $is_new_feed ) {
				echo wp_json_encode( $return );
				wp_die();
			} else {
				$feed_cache = new \SB_Instagram_Cache( $feed_id );
				$feed_cache->clear( 'all' );
				$feed_cache->clear( 'posts' );
				echo wp_json_encode( $return );
				wp_die();
			}
		}
		echo wp_json_encode( $return );

		wp_die();

	}

	/**

	 * Retrieve comments AJAX call
	 *
	 * @since 6.0
	 */
	public static function retrieve_comments() {
		check_ajax_referer( 'sbi-admin' , 'nonce');

		if ( ! sbi_current_user_can( 'manage_instagram_feed_options' ) ) {
			wp_send_json_error();
		}

		wp_send_json_success();
	}

	/**
	 * Clear comments cache AJAX call
	 *
	 * @since 6.0
	*/
	public static function clear_comments_cache() {
		check_ajax_referer( 'sbi-admin' , 'nonce');

		if ( ! sbi_current_user_can( 'manage_instagram_feed_options' ) ) {
			wp_send_json_error();
		}

		$manager = new \SB_Instagram_Data_Manager();
		$manager->delete_comments_data();
		echo 'success';
		wp_die();
	}

	/**
	 * Used in an AJAX call to delete feeds from the Database
	 * $_POST data.
	 *
	 * @since 6.0
	 */
	public static function delete_feed() {
		check_ajax_referer( 'sbi-admin' , 'nonce');

		if ( ! sbi_current_user_can( 'manage_instagram_feed_options' ) ) {
			wp_send_json_error();
		}

		if ( ! empty( $_POST['feeds_ids'] ) && is_array( $_POST['feeds_ids'] ) ) {
			SBI_Db::delete_feeds_query( $_POST['feeds_ids'] );
		}
	}


	/**
	 * Used in an AJAX call to delete Soureces from the Database
	 * $_POST data.
	 *
	 * @since 6.0
	 */
	public static function delete_source() {
		check_ajax_referer( 'sbi-admin' , 'nonce');

		if ( ! sbi_current_user_can( 'manage_instagram_feed_options' ) ) {
			wp_send_json_error();
		}

		if ( ! empty( $_POST['source_id'] ) ) {
			\SB_Instagram_Connected_Account::delete_local_avatar( $_POST['username'] );
			SBI_Db::delete_source_query( $_POST['source_id'] );
		}

	}

	public static function recache_feed() {
		check_ajax_referer( 'sbi-admin' , 'nonce');

		if ( ! sbi_current_user_can( 'manage_instagram_feed_options' ) ) {
			wp_send_json_error();
		}

		$feed_id    = sanitize_key( $_POST['feedID'] );
		$feed_cache = new \SB_Instagram_Cache( $feed_id );
		$feed_cache->clear( 'all' );
		$feed_cache->clear( 'posts' );
	}



	/**
	 * Used in an AJAX call to delete a feed cache from the Database
	 * $_POST data.
	 *
	 * @since 6.0
	 */
	public static function clear_single_feed_cache() {
		check_ajax_referer( 'sbi-admin' , 'nonce');

		if ( ! sbi_current_user_can( 'manage_instagram_feed_options' ) ) {
			wp_send_json_error();
		}

		$feed_id = sanitize_key( $_POST['feedID'] );

		if ( $feed_id === 'legacy' ) {
			\SB_Instagram_Cache::clear_legacy();

			$feed_cache = new \SB_Instagram_Cache( 'sbi_' . $feed_id );
			$feed_cache->clear( 'all' );
			$feed_cache->clear( 'posts' );
		} else {
			$feed_cache = new \SB_Instagram_Cache( $feed_id );
			$feed_cache->clear( 'all' );
			$feed_cache->clear( 'posts' );
		}

		if ( ! empty( $_POST['previewSettings'] ) && ! empty( $_POST['previewSettings']['hashtag'] ) ) {
			global $sb_instagram_posts_manager;
			if ( is_array( $_POST['previewSettings']['hashtag'] ) ) {
				foreach ( $_POST['previewSettings']['hashtag'] as $hashtag ) {
					$hashtag = str_replace( '#', '', sanitize_text_field( $hashtag ) );
					$sb_instagram_posts_manager->clear_top_post_request( $hashtag );
				}
			} elseif ( is_string( $_POST['previewSettings']['hashtag'] ) ) {
				$hashtag = str_replace( '#', '', sanitize_text_field( $_POST['previewSettings']['hashtag'] ) );
				$sb_instagram_posts_manager->clear_top_post_request( $hashtag );
			}
		}

		self::feed_customizer_fly_preview();
		wp_die();

	}

	/**
	 * Used in an AJAX call to duplicate a Feed
	 * $_POST data.
	 *
	 * @since 6.0
	 */
	public static function duplicate_feed() {
		check_ajax_referer( 'sbi-admin' , 'nonce');

		if ( ! sbi_current_user_can( 'manage_instagram_feed_options' ) ) {
			wp_send_json_error();
		}

		if ( ! empty( $_POST['feed_id'] ) ) {
			SBI_Db::duplicate_feed_query( $_POST['feed_id'] );
		}
	}


	/**
	 * Import a feed from JSON data
	 *
	 * @since 6.0
	 */
	public static function importer() {
		check_ajax_referer( 'sbi-admin' , 'nonce');

		if ( ! sbi_current_user_can( 'manage_instagram_feed_options' ) ) {
			wp_send_json_error();
		}

		if ( ! empty( $_POST['feed_json'] ) && strpos( $_POST['feed_json'], '{' ) === 0 ) {
			echo sbi_json_encode( self::import_feed( stripslashes( $_POST['feed_json'] ) ) );
		} else {
			echo sbi_json_encode(
				array(
					'success' => false,
					'message' => __(
						'Invalid JSON. Must have brackets "{}"',
						'instagram-feed'
					),
				)
			);
		}
		wp_die();
	}


	/**
	 * Used To check if it's customizer Screens
	 * Returns Feed info or false!
	 *
	 * @param bool $include_comments
	 *
	 * @return array|bool
	 *
	 * @since 6.0
	 */
	public static function maybe_feed_customizer_data( $include_comments = false ) {
		if ( isset( $_GET['feed_id'] ) ) {
			$feed_id      = sanitize_key( $_GET['feed_id'] );
			$feed_saver   = new SBI_Feed_Saver( $feed_id );
			$settings     = $feed_saver->get_feed_settings();
			$feed_db_data = $feed_saver->get_feed_db_data();

			if ( $settings !== false ) {
				$return = array(
					'feed_info'  => $feed_db_data,
					'headerData' => $feed_db_data,
					'settings'   => $settings,
					'posts'      => array(),
				);
				if ( intval( $feed_id ) > 0 ) {
					$instagram_feed_settings = new \SB_Instagram_Settings_Pro(
						array(
							'feed'       => $feed_id,
							'customizer' => true,
						),
						sbi_defaults()
					);
				} else {
					$instagram_feed_settings = new \SB_Instagram_Settings_Pro( $settings, sbi_defaults() );
				}

				$instagram_feed_settings->set_feed_type_and_terms();
				$instagram_feed_settings->set_transient_name();
				$transient_name = $instagram_feed_settings->get_transient_name();
				$settings       = $instagram_feed_settings->get_settings();

				$feed_type_and_terms = $instagram_feed_settings->get_feed_type_and_terms();
				if ( $feed_id === 'legacy' && $transient_name === 'sbi_false' ) {
					$transient_name = 'sbi_legacy';
				}
				$instagram_feed = new \SB_Instagram_Feed_Pro( $transient_name );

				$instagram_feed->set_cache( $instagram_feed_settings->get_cache_time_in_seconds(), $settings );

				if ( $instagram_feed->regular_cache_exists() ) {
					$instagram_feed->set_post_data_from_cache();

					if ( $instagram_feed->need_posts( $settings['num'] ) && $instagram_feed->can_get_more_posts() ) {
						while ( $instagram_feed->need_posts( $settings['num'] ) && $instagram_feed->can_get_more_posts() ) {
							$instagram_feed->add_remote_posts( $settings, $feed_type_and_terms, $instagram_feed_settings->get_connected_accounts_in_feed() );
						}

						$instagram_feed->cache_feed_data( $instagram_feed_settings->get_cache_time_in_seconds(), $settings['backup_cache_enabled'] );
					}
				} else {
					while ( $instagram_feed->need_posts( $settings['num'] ) && $instagram_feed->can_get_more_posts() ) {
						$instagram_feed->add_remote_posts( $settings, $feed_type_and_terms, $instagram_feed_settings->get_connected_accounts_in_feed() );
					}

					if ( $instagram_feed->out_of_next_pages() || $instagram_feed->should_look_for_db_only_posts( $settings, $feed_type_and_terms ) ) {
						$instagram_feed->add_db_only_posts( $transient_name, $settings, $feed_type_and_terms );
					}

					if ( ! $instagram_feed->should_use_backup() ) {
						$instagram_feed->cache_feed_data( $instagram_feed_settings->get_cache_time_in_seconds(), $settings['backup_cache_enabled'] );
					} elseif ( $instagram_feed->should_cache_error() ) {
						$cache_time = min( $instagram_feed_settings->get_cache_time_in_seconds(), 15 * 60 );
						$instagram_feed->cache_feed_data( $cache_time, false );
					}
				}
				$return['posts'] = $instagram_feed->get_post_data();

				$header_data = array();

				$instagram_feed->set_remote_header_data( $settings, $feed_type_and_terms, $instagram_feed_settings->get_connected_accounts_in_feed() );
				$header_data = $instagram_feed->get_header_data();
				if ( $settings['stories'] && ! empty( $header_data ) ) {
					$instagram_feed->set_remote_stories_data( $settings, $feed_type_and_terms, $instagram_feed_settings->get_connected_accounts_in_feed() );
				}
				$instagram_feed->cache_header_data( $instagram_feed_settings->get_cache_time_in_seconds(), $settings['backup_cache_enabled'] );
				if ( ! empty( $header_data ) && \SB_Instagram_Connected_Account::local_avatar_exists( $header_data['username'] ) ) {
					$header_data['local_avatar_url'] = \SB_Instagram_Connected_Account::get_local_avatar_url( $header_data['username'] );
					$header_data['local_avatar']     = \SB_Instagram_Connected_Account::get_local_avatar_url( $header_data['username'] );
				} else {
					$header_data['local_avatar'] = false;
				}
				$header_data['local_avatar'] = false;
				$return['header']            = $header_data;
				$return['headerData']        = $header_data;

				return $return;

			}
		}
		return false;
	}


	/**
	 * Used to retrieve Feed Posts for preview screen
	 * Returns Feed info or false!
	 *
	 *
	 *
	 * @since 6.0
	 */
	public static function feed_customizer_fly_preview() {
		check_ajax_referer( 'sbi-admin' , 'nonce');

		if ( ! sbi_current_user_can( 'manage_instagram_feed_options' ) ) {
			wp_send_json_error();
		}

		if ( isset( $_POST['feedID'] ) && isset( $_POST['previewSettings'] ) ) {
			$feed_id          = absint( wp_unslash( $_POST['feedID'] ) );
			$preview_settings = $_POST['previewSettings'];
			$feed_name        = $_POST['feedName'];

			$moderation_shoppable = isset( $_POST['moderationShoppableMode'] ) && ( $_POST['moderationShoppableMode'] === true || $_POST['moderationShoppableMode'] === 'true' );

			if ( $moderation_shoppable ) {
				$offset        = intval( $_POST['moderationShoppableModeOffset'] );
				$show_selected = ! empty( $_POST['moderationShoppableShowSelected'] ) ? intval( $_POST['moderationShoppableShowSelected'] ) : 0;

				$preview_settings['num']       = 20;
				$preview_settings['nummobile'] = $preview_settings['num'];
				$preview_settings['minnum']    = $preview_settings['num'];
				$preview_settings['apinum']    = $preview_settings['num'];
				$preview_settings['layout']    = 'grid';
				$preview_settings['cols']      = 4;
				$preview_settings['offset']    = $offset * $preview_settings['num'];

				$opt = [
					'feed_id' => $feed_id,
					'offset'  => $preview_settings['offset'],
					'page'  => $offset
				];

				$preview_settings['enablemoderationmode'] = false;
				$preview_settings['shoppablelist']        = isset( $preview_settings['shoppablelist'] ) ? sbi_json_encode( $preview_settings['shoppablelist'] ) : array();
				$preview_settings['moderationlistarray']  = isset( $preview_settings['moderationlist'] ) ? $preview_settings['moderationlist'] : array();
				$preview_settings['moderationlist']       = isset( $preview_settings['moderationlist'] ) ? sbi_json_encode( $preview_settings['moderationlist'] ) : array();
				if ( $show_selected ) {
					$type_selected = ! empty( $preview_settings['moderationlistarray']['list_type_selected'] ) ? $preview_settings['moderationlistarray']['list_type_selected'] : 'allow';
					if ( $type_selected === 'allow' && ! empty( $preview_settings['moderationlistarray']['allow_list'] ) ) {
						$preview_settings['show_selected_list'] = $preview_settings['moderationlistarray']['allow_list'];
					} elseif ( ! empty( $preview_settings['moderationlistarray']['block_list'] ) ) {
						$preview_settings['show_selected_list'] = $preview_settings['moderationlistarray']['block_list'];
					}
					if ( $offset === 0 ) {
						$feed_cache = new \SB_Instagram_Cache( $feed_id );
						$feed_cache->clear( 'show_selected' );
					}
				}
				$atts = SBI_Feed_Builder::add_customizer_att(
					array(
						'feed'       => $feed_id,
						'customizer' => true,
					)
				);


				if ( $offset > 0 ) {
					$size_of_allow_list = ! empty( $preview_settings['show_selected_list'] ) && is_array( $preview_settings['show_selected_list'] ) ? count( $preview_settings['show_selected_list'] ) : 0;
					$result             = array(
						'html'       => self::moderation_pagination_feed( $opt , $preview_settings),
						'feedStatus' => array( 'shouldPaginate' => true  )
					);
					$return['feed_html']  = $result['html'];
					$return['feedStatus'] = $result['feedStatus'];
					$return['sizeAllow']  = $size_of_allow_list;



					echo wp_json_encode( $return );
					die();
				}

				$feed_cache = new \SB_Instagram_Cache( $feed_id );
				$feed_cache->clear( 'all' );
				$feed_cache->clear( 'posts' );

				$feed_saver = new SBI_Feed_Saver( $feed_id );
				$feed_saver->set_feed_name( $feed_name );
				$feed_saver->set_data( $preview_settings );

				$return['feed_html'] = display_instagram( $atts, $preview_settings );

				echo $return['feed_html'];
				die();
			}
			$preview_settings['moderationlist'] = isset( $preview_settings['moderationlist'] ) ? json_encode( $preview_settings['moderationlist'], true ) : array();


			$feed_cache = new \SB_Instagram_Cache( $feed_id );
			$feed_cache->clear( 'all' );
			$feed_cache->clear( 'posts' );

			$feed_saver = new SBI_Feed_Saver( $feed_id );
			$feed_saver->set_feed_name( $feed_name );
			$feed_saver->set_data( $preview_settings );

			// Update feed settings depending on feed templates
			if ( isset( $_POST['isFeedTemplatesPopup'] ) ) {
				$preview_settings = self::get_feed_settings_by_feed_templates( $preview_settings );
				$return['customizerData'] = $preview_settings;
			}

			$atts = SBI_Feed_Builder::add_customizer_att(
				array(
					'feed'       => $feed_id,
					'customizer' => true,
				)
			);

			$return['feed_html'] = display_instagram( $atts, $preview_settings );

			if ( $moderation_shoppable && strpos( $return['feed_html'], 'id="sbi_mod_error"' ) && $preview_settings['offset'] > 0 ) {
				$return['feed_html'] = '<div id="sbi_mod_error" style="display: block;"><strong>' . esc_html__("That's it!. No more posts to load.", 'instagram-feed' ) . '</strong></div>';
			}
			if ( ! empty( $_POST['isFeedTemplatesPopup'] ) ) {
				echo sbi_json_encode( $return );
			} else {
				echo $return['feed_html'];
			}
		}
		wp_die();
	}



	/**
	 * Used in AJAX call to return settings for an existing feed.
	 *
	 * @since 6.0
	 */
	public static function get_feed_settings() {
		check_ajax_referer( 'sbi-admin' , 'nonce');

		if ( ! sbi_current_user_can( 'manage_instagram_feed_options' ) ) {
			wp_send_json_error();
		}

		$feed_id = ! empty( $_POST['feed_id'] ) ? sanitize_key( $_POST['feed_id'] ) : false;

		if ( ! $feed_id ) {
			wp_die( 'no feed id' );
		}

		$feed_saver = new SBI_Feed_Saver( $feed_id );
		$settings   = $feed_saver->get_feed_settings();

		$return = array(
			'settings'  => $settings,
			'feed_html' => '',
		);

		if ( isset( $_POST['include_post_set'] ) &&
			! empty( $_POST['include_post_set'] ) ) {
			$atts                = SBI_Feed_Builder::add_customizer_att( array( 'feed' => $return['feed_id'] ) );
		$return['feed_html'] = display_instagram( $atts );
	}

	echo sbi_json_encode( $return );
	wp_die();
}

	/**
	 * Get a list of feeds with a limit and offset like a page
	 *
	 * @since 6.0
	 */
	public static function get_feed_list_page() {
		check_ajax_referer( 'sbi-admin' , 'nonce');

		if ( ! sbi_current_user_can( 'manage_instagram_feed_options' ) ) {
			wp_send_json_error();
		}
		$args       = array( 'page' => (int) $_POST['page'] );
		$feeds_data = SBI_Feed_Builder::get_feed_list( $args );

		echo sbi_json_encode( $feeds_data );

		wp_die();
	}

	/**
	 * Get a list of locations with a limit and offset like a page
	 *
	 * @since 6.0
	 */
	public static function get_locations_page() {
		check_ajax_referer( 'sbi-admin' , 'nonce');

		if ( ! sbi_current_user_can( 'manage_instagram_feed_options' ) ) {
			wp_send_json_error();
		}

		$args = array( 'page' => (int) $_POST['page'] );

		if ( ! empty( $_POST['is_legacy'] ) ) {
			$args['feed_id'] = sanitize_text_field( $_POST['feed_id'] );
		} else {
			$args['feed_id'] = '*' . (int) $_POST['feed_id'];
		}
		$feeds_data = \SB_Instagram_Feed_Locator::instagram_feed_locator_query( $args );

		if ( count( $feeds_data ) < SBI_Db::RESULTS_PER_PAGE ) {
			$args['html_location'] = array( 'footer', 'sidebar', 'header' );
			$args['group_by']      = 'html_location';
			$args['page']          = 1;
			$non_content_data      = \SB_Instagram_Feed_Locator::instagram_feed_locator_query( $args );

			$feeds_data = array_merge( $feeds_data, $non_content_data );
		}

		echo sbi_json_encode( $feeds_data );

		wp_die();
	}

	/**
	 * Return a single JSON string for importing a feed
	 *
	 * @param int $feed_id
	 *
	 * @return string
	 *
	 * @since 6.0
	 */
	public static function get_export_json( $feed_id ) {
		$feed_saver = new SBI_Feed_Saver( $feed_id );
		$settings   = $feed_saver->get_feed_settings();

		// For Hashtag and Tagged Feeds, 'sources' are not set which causes an import failure.
		// So, setting the 'sources' to connected accounts.
		if ( isset( $settings['type'] ) && ( 'hashtag' === $settings['type'] || 'tagged' === $settings['type'] )
		&& ! isset( $settings['sources'] ) ) {

			$settings['sources'] = array();
			if( 'tagged' === $settings['type'] && isset( $settings['tagged'] ) && is_array( $settings['tagged'] ) ) {
				$source_ids   = array_filter( $settings['tagged'] );
				$args         = array( 'id' => $source_ids );
				$source_query = SBI_Db::source_query( $args );
				if ( ! empty( $source_query ) ) {
					foreach ( $source_query as $source ) {
						// if business account, then add it to the sources.
						if ( isset( $source['account_type'] ) && isset( $source['account_id'] )
						&& 'business' === $source['account_type'] ) {
							$settings['sources'][] = $source['account_id'];
						}
					}
				}
			} else {

				$instagram_feed_settings = new \SB_Instagram_Settings_Pro( array( 'feed' => $feed_id ), $settings );
				$connected_accounts = $instagram_feed_settings->get_connected_accounts_from_settings();
				if ( ! empty( $connected_accounts ) ) {
					foreach ( $connected_accounts as $account ) {
						// if business account, then add it to the sources.
						if ( isset( $account['account_type'] ) && isset( $account['user_id'] )
						&& 'business' === $account['account_type'] ) {
							$settings['sources'][] = $account['user_id'];
						}
					}
				}
			}
		}
		return sbi_json_encode( $settings );
	}

	/**
	 * All export strings for all feeds on the first 'page'
	 *
	 * @return array
	 *
	 * @since 6.0
	 */
	public static function get_all_export_json() {
		$args = array( 'page' => 1 );

		$feeds_data = SBI_Db::feeds_query( $args );

		$return = array();
		foreach ( $feeds_data as $single_feed ) {
			$return[ $single_feed['id'] ] = self::get_export_json( $single_feed['id'] );
		}

		return $return;
	}

	/**
	 * Use a JSON string to import a feed with settings and sources. The return
	 * is whether or not the import was successful
	 *
	 * @param string $json
	 *
	 * @return array
	 *
	 * @since 6.0
	 */
	public static function import_feed( $json ) {
		$settings_data = json_decode( $json, true );

		$return = array(
			'success' => false,
			'message' => '',
		);

		if ( empty( $settings_data['sources'] ) ) {
			$return['message'] = __( 'No feed source is included. Cannot upload feed.', 'instagram-feed' );
			return $return;
		}

		$sources = $settings_data['sources'];

		unset( $settings_data['sources'] );

		$settings_source = array();
		foreach ( $sources as $source ) {

			if ( isset( $source['user_id'] ) ) {
				$source['account_id'] = $source['user_id'];
				$source['id']         = $source['user_id'];
			}
			if ( isset( $source['account_id'] ) ) {
				if ( isset( $source['record_id'] ) ) {
					unset( $source['record_id'] );
				}

				$settings_source[] = $source['account_id'];
			}
		}
		$settings_data['sources'] = $settings_source;
		$feed_saver               = new SBI_Feed_Saver( false );
		$feed_saver->set_data( $settings_data );

		if ( $feed_saver->update_or_insert() ) {
			$return = array(
				'success' => true,
				'feed_id' => $feed_saver->get_feed_id(),
			);

			return $return;
		} else {
			$return['message'] = __( 'Could not import feed. Please try again', 'instagram-feed' );
		}
		return $return;
	}

	/**
	 * Determines what table and sanitization should be used
	 * when handling feed setting data.
	 *
	 * TODO: Add settings that need something other than sanitize_text_field
	 *
	 * @param string $key
	 *
	 * @return array
	 *
	 * @since 6.0
	 */
	public static function get_data_type( $key ) {
		switch ( $key ) {
			case 'sources':
			$return = array(
				'table'        => 'feed_settings',
				'sanitization' => 'sanitize_text_field',
			);
			break;
			case 'feed_title':
			$return = array(
				'table'        => 'feeds',
				'sanitization' => 'sanitize_text_field',
			);
			break;
			case 'feed_name':
			$return = array(
				'table'        => 'feeds',
				'sanitization' => 'sanitize_text_field',
			);
			break;
			case 'status':
			$return = array(
				'table'        => 'feeds',
				'sanitization' => 'sanitize_text_field',
			);
			break;
			case 'author':
			$return = array(
				'table'        => 'feeds',
				'sanitization' => 'int',
			);
			break;
			default:
			$return = array(
				'table'        => 'feed_settings',
				'sanitization' => 'sanitize_text_field',
			);
			break;
		}

		return $return;
	}

	/**
	 * Uses the appropriate sanitization function and returns the result
	 * for a value
	 *
	 * @param string $type
	 * @param int|string $value
	 *
	 * @return int|string
	 *
	 * @since 6.0
	 */
	public static function sanitize( $type, $value ) {
		switch ( $type ) {
			case 'int':
			$return = intval( $value );
			break;
			case 'boolean':
			$return = self::cast_boolean( $value );
			break;
			default:
			$return = sanitize_text_field( $value );
			break;
		}

		return $return;
	}

	/**
	 * Check if boolean
	 * for a value
	 *
	 * @param string $type
	 * @param int|string $value
	 *
	 * @return int|string
	 *
	 * @since 6.0
	 */
	public static function is_boolean( $value ) {
		return ( $value === 'true' || $value === 'false' || is_bool( $value ) ) ? true : false;
	}

	public static function cast_boolean( $value ) {
		if ( $value === 'true' || $value === true || $value === 'on' ) {
			return true;
		}
		return false;
	}


	/**
	 * Update Personal Account Info
	 * Setting Avatar + Bio
	 *
	 * @return json
	 *
	 * @since 6.1
	 */
	public static function sbi_update_personal_account(){

		check_ajax_referer( 'sbi-admin' , 'nonce');
		if ( ! sbi_current_user_can( 'manage_instagram_feed_options' ) ) {
			wp_send_json_error();
		}

		if( isset( $_FILES['avatar'] ) ){
			$account_avatar = $_FILES['avatar']['tmp_name'];
			$created = \SB_Instagram_Connected_Account::create_local_avatar( $_POST['username'], $account_avatar );
			\SB_Instagram_Connected_Account::update_local_avatar_status( $_POST['username'], $created );
		}

		if( isset( $_POST['bio'] ) ){
			#SBI_Source::update_personal_account_bio( $_POST['id'], $_POST['bio'] );
			SBI_Source::update_personal_account_bio( $_POST['id'], stripslashes($_POST['bio']) );
		}
		$response = array(
			'success' => true,
			'sourcesList' => SBI_Feed_Builder::get_source_list()
		);
		echo sbi_json_encode( $response );
		wp_die();
	}



	/**
	 * Used for moderation Pagination
	 *
	 * @param array $opt
	 * @param array $preview_settings
	 *
	 * @return HTML
	 *
	 * @since 6.1
	 */
	public static function moderation_pagination_feed( $opt, $preview_settings ) {
		$feed_id = sanitize_text_field( $opt['feed_id'] );

		$atts = [
			'feed' => $feed_id
		];
		$database_settings = sbi_get_database_settings();
		$instagram_feed_settings = new \SB_Instagram_Settings_Pro( $atts, $database_settings, $preview_settings );

		$instagram_feed_settings->set_feed_type_and_terms();
		$instagram_feed_settings->set_transient_name();
		$transient_name = $instagram_feed_settings->get_transient_name();

		$settings =  $instagram_feed_settings->get_settings();
		$offset = isset( $opt['offset'] ) ? (int)$opt['offset'] : 0;
		$page = isset( $opt['page'] ) ? (int)$opt['page'] : 1;

		$settings['customizer']     = true;
		$settings['ajax_post_load'] = false; // prevents pagination and checkboxes from breaking

		$feed_type_and_terms = $instagram_feed_settings->get_feed_type_and_terms();

		$instagram_feed = new \SB_Instagram_Feed_Pro( $transient_name );
		$instagram_feed->set_cache( $instagram_feed_settings->get_cache_time_in_seconds(), $settings );

		if ( $settings['caching_type'] === 'permanent' && empty( $settings['doingModerationMode'] ) ) {
			$instagram_feed->add_report( 'trying to use permanent cache' );
			$instagram_feed->maybe_set_post_data_from_backup();
		} elseif ( $settings['caching_type'] === 'background' ) {
			$instagram_feed->add_report( 'background caching used' );
			if ( $instagram_feed->regular_cache_exists() ) {
				$instagram_feed->add_report( 'setting posts from cache' );
				$instagram_feed->set_post_data_from_cache();
			}

			if ( $instagram_feed->need_posts( $settings['minnum'] + $settings['offset'], $offset, $page ) && $instagram_feed->can_get_more_posts() ) {
				while ( $instagram_feed->need_posts( $settings['minnum'] + $settings['offset'], $offset, $page ) && $instagram_feed->can_get_more_posts() ) {
					$instagram_feed->add_remote_posts( $settings, $feed_type_and_terms, $instagram_feed_settings->get_connected_accounts_in_feed() );
				}

				$normal_method = true;
				if ( $instagram_feed->need_to_start_cron_job() ) {
					$instagram_feed->add_report( 'needed to start cron job' );
					$to_cache = array(
						'atts' => $atts,
						'last_requested' => time(),
					);


					$normal_method = false;

				} else {
					$instagram_feed->add_report( 'updating last requested and adding to cache' );
					$to_cache = array(
						'last_requested' => time(),
					);
				}

				if ( $instagram_feed->out_of_next_pages() && $instagram_feed->should_look_for_db_only_posts( $settings, $feed_type_and_terms ) ) {
					$instagram_feed->add_report( 'Adding Db only posts' );
					$instagram_feed->add_db_only_posts( $transient_name, $settings, $feed_type_and_terms );
				}

				if ( $normal_method ) {
					$instagram_feed->set_cron_cache( $to_cache, $instagram_feed_settings->get_cache_time_in_seconds(), $settings['backup_cache_enabled'] );
				} else {
					$instagram_feed->set_cron_cache( $to_cache, $instagram_feed_settings->get_cache_time_in_seconds() );
				}
			}

		} elseif ( $instagram_feed->regular_cache_exists() ) {
			$instagram_feed->add_report( 'regular cache exists' );
			$instagram_feed->set_post_data_from_cache();

			if ( $instagram_feed->need_posts( (int)$settings['minnum'] + (int)$settings['offset'], $offset, $page ) && $instagram_feed->can_get_more_posts() ) {
				while ( $instagram_feed->need_posts( $settings['minnum'] + $settings['offset'], $offset, $page ) && $instagram_feed->can_get_more_posts() ) {
					$instagram_feed->add_remote_posts( $settings, $feed_type_and_terms, $instagram_feed_settings->get_connected_accounts_in_feed() );
				}

				if ( $instagram_feed->out_of_next_pages() || $instagram_feed->should_look_for_db_only_posts( $settings, $feed_type_and_terms ) ) {
					$instagram_feed->add_report( 'Adding Db only posts' );
					$instagram_feed->add_db_only_posts( $transient_name, $settings, $feed_type_and_terms );
				}

				$instagram_feed->add_report( 'adding to cache' );
				$instagram_feed->cache_feed_data( $instagram_feed_settings->get_cache_time_in_seconds(), $settings['backup_cache_enabled'] );
			}

			if ( $instagram_feed->using_an_allow_list( $settings ) ) {
				$instagram_feed->add_report( 'Adding allow list only posts' );
				$instagram_feed->add_db_only_allow_list_posts( $settings );
			}


		} else {
			$instagram_feed->add_report( 'no feed cache found' );

			while ( $instagram_feed->need_posts( $settings['minnum'] + $settings['offset'], $offset, $page ) && $instagram_feed->can_get_more_posts() ) {
				$instagram_feed->add_remote_posts( $settings, $feed_type_and_terms, $instagram_feed_settings->get_connected_accounts_in_feed() );
			}

			if ( $instagram_feed->should_use_backup() ) {
				$instagram_feed->add_report( 'trying to use a backup cache' );
				$instagram_feed->maybe_set_post_data_from_backup();
			} else {
				$instagram_feed->add_report( 'transient gone, adding to cache' );
				$instagram_feed->cache_feed_data( $instagram_feed_settings->get_cache_time_in_seconds(), $settings['backup_cache_enabled'] );
			}
		}

		$settings['feed_avatars'] = array();
		if ( $instagram_feed->need_avatars( $settings ) ) {
			$instagram_feed->set_up_feed_avatars( $instagram_feed_settings->get_connected_accounts_in_feed(), $feed_type_and_terms );
			$settings['feed_avatars'] = $instagram_feed->get_username_avatars();
		}

		$should_paginate_offset = (int)$offset + (int)$settings['offset'];
		$feed_status = array( 'shouldPaginate' => $instagram_feed->should_use_pagination( $settings, $should_paginate_offset ) );



		$moderation_posts = array_slice( $instagram_feed->get_post_data(), $offset, $settings['minnum'] );

		return $instagram_feed->get_the_feed_html( $settings, $atts, $instagram_feed_settings->get_feed_type_and_terms(), $instagram_feed_settings->get_connected_accounts_in_feed(), $moderation_posts );
	}
}
