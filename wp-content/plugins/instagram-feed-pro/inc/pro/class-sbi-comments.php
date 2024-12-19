<?php
/**
 * Class SB_Instagram_Comments
 *
 * Collection of static functions meant to retrieve comments from
 * the Instagram API for a single post and store them in a cache.
 *
 * See the "sbiComments" object in the sb-instagram.js class to see how
 * loading of comments into the lightbox is handled.
 *
 * @since 5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
use InstagramFeed\SB_Instagram_Data_Encryption;

class SB_Instagram_Comments {

	/**
	 * AJAX listeners related to all of the frontend comment features
	 *
	 * @since 5.0
	 */
	public static function init_listeners() {
		add_action( 'wp_ajax_sbi_get_comment_cache', array( 'SB_Instagram_Comments', 'the_ajax_comment_cache' ) );
		add_action( 'wp_ajax_nopriv_sbi_get_comment_cache', array( 'SB_Instagram_Comments', 'the_ajax_comment_cache' ) );
		add_action( 'wp_ajax_sbi_remote_comments_needed', array( 'SB_Instagram_Comments', 'process_remote_comment_request' ) );
		add_action( 'wp_ajax_nopriv_sbi_remote_comments_needed', array( 'SB_Instagram_Comments', 'process_remote_comment_request' ) );
	}

	/**
	 * When the first image is opened in the lightbox, the comment
	 * cache is retrieved using AJAX
	 *
	 * @since 5.0
	 */
	public static function the_ajax_comment_cache() {
		$comment_cache = self::get_comment_cache();

		wp_send_json_success( $comment_cache );
	}

	/**
	 * If no comments are available in the comment cache for a post, or
	 * the number of comments for the post are greater than the
	 * number in the cache, new remote comments are retrieved.
	 *
	 * @since 5.0
	 * @since 5.1.2 remote comments only retrieved if API requests are not delayed
	 */
	public static function process_remote_comment_request() {
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended
		$post_id = isset( $_POST['post_id'] ) ? sbi_sanitize_instagram_ids( $_POST['post_id'] ) : false;
		$user    = isset( $_POST['user'] ) ? sbi_sanitize_username( $_POST['user'] ) : false;
		$type    = isset( $_POST['type'] ) && $_POST['type'] === 'personal' ? 'personal' : 'business';
		if ( $post_id && $user ) {
			$args = array( 'username' => $user );
			$results = InstagramFeed\Builder\SBI_Db::source_query( $args );

			if ( !empty( $results ) ) {
				$connected_accounts = \InstagramFeed\Builder\SBI_Source::convert_sources_to_connected_accounts( $results );

				foreach ( $connected_accounts as $account ) {
					if ( ! empty( $account['access_token'] ) && $account['account_type'] === 'business' ) {
						global $sb_instagram_posts_manager;

						$api_requests_delayed = $sb_instagram_posts_manager->are_current_api_request_delays( $account );

						if ( ! $api_requests_delayed ) {
							$comments = self::get_remote_comments( $account, $post_id );

							if ( $comments ) {
								self::update_comment_cache( $post_id, $comments, count( $comments ) );
								wp_send_json_success( $comments );

							} else {
								wp_send_json_success( array() );
							}

						}

					}
				}


			}

		}

		wp_send_json_success( array() );
	}

	/**
	 * Comments are stored in a cache with the Instagram Post ID
	 * as the key
	 *
	 * @return mixed|string
	 *
	 * @since 5.0
	 */
	public static function get_comment_cache() {
		$comment_cache = get_transient( 'sbinst_comment_cache' );

		if ( $comment_cache ) {
			$encryption = new SB_Instagram_Data_Encryption();

			$maybe_decrypted = $encryption->decrypt( $comment_cache );
			if ( ! empty( $maybe_decrypted ) ) {
				$comment_cache = $maybe_decrypted;
			}
			$comment_cache_data = ! empty( $comment_cache ) ? json_decode( $comment_cache ) : '{}';
		} else {
			$comment_cache_data = array();
		}

		return $comment_cache_data;
	}

	/**
	 * Adds new comments to the comment cache. Only the latest
	 * 200 posts have comments cached.
	 *
	 * @param string $post_id
	 * @param array $comments
	 * @param int $total_comments
	 *
	 * @since 5.0
	 */
	public static function update_comment_cache( $post_id, $comments, $total_comments ) {

		$comment_cache_transient = get_transient( 'sbinst_comment_cache' );
		$encryption              = new SB_Instagram_Data_Encryption();

		$maybe_decrypted = $encryption->decrypt( $comment_cache_transient );
		if ( ! empty( $maybe_decrypted ) ) {
			$comment_cache_transient = $maybe_decrypted;
		}

		$comment_cache = $comment_cache_transient ? json_decode( $comment_cache_transient, true ) : array();

		if ( is_array( $comment_cache ) && ! isset( $comment_cache[ $post_id ] ) && count( $comment_cache ) >= 200 ) {
			array_shift( $comment_cache );
		} else {
			$comment_cache = array();
		}

		$comment_cache[ $post_id ] = array( $comments, time() + ( 15 * 60 ), $total_comments );

		set_transient( 'sbinst_comment_cache', $encryption->encrypt( sbi_json_encode( $comment_cache ) ), 0 );
	}

	/**
	 * Retrieve comments for a specific post. Comments for a post can only be
	 * retrieved if the account is connected.
	 *
	 * @param array $account connected account for the post
	 * @param string $post_id
	 *
	 * @return array|bool
	 *
	 * @since 5.0
	 */
	public static function get_remote_comments( $account, $post_id ) {

		$comments_return = array();

		// basic display does not support comments as of January 2020
		if ( $account['type'] === 'basic' ) {
			return array();
		}

		$connection = new SB_Instagram_API_Connect_Pro( $account, 'comments', array( 'post_id' => $post_id ) );

		$connection->connect();

		if ( ! $connection->is_wp_error() && ! $connection->is_instagram_error() ) {
			$comments = $connection->get_data();

			if ( ! empty( $comments ) && isset( $comments[0]['text'] ) ) {
				foreach ( $comments as $comment ) {

					$username          = isset( $comment['from'] ) ? self::clean_comment( $comment['from']['username'] ) : self::clean_comment( $comment['username'] );
					$comments_return[] = array(
						'text'     => self::clean_comment( $comment['text'] ),
						'id'       => sbi_sanitize_instagram_ids( $comment['id'] ),
						'username' => sbi_sanitize_username( $username ),
					);

				}
			}

			return $comments_return;

		} else {
			if ( $connection->is_wp_error() ) {
				SB_Instagram_API_Connect::handle_wp_remote_get_error( $connection->get_wp_error() );
			} else {
				SB_Instagram_API_Connect::handle_instagram_error( $connection->get_data(), $account );
			}

			return false;
		}
	}

	/**
	 * The only html allowed should be <br> tags. All parts of the comment are
	 * escaped and new lines converted to <br> to be easily and securely converted
	 * in the JS.
	 *
	 * @param $comment_part
	 *
	 * @return string
	 *
	 * @since 5.0
	 */
	public static function clean_comment( $comment_part ) {
		return esc_html( nl2br( $comment_part ) );
	}
}
