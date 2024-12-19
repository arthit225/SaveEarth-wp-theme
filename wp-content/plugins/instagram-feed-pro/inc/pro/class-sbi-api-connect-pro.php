<?php
/**
 * Class SB_Instagram_API_Connect_Pro
 *
 * Adds support for additional endpoints:
 *
 * - Personal account comments
 * - Business account top and recent hashtags
 * - Business account stories
 * - Business account comments
 * - Business account hashtag IDs
 *
 * @since 5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class SB_Instagram_API_Connect_Pro extends SB_Instagram_API_Connect {

	protected $response;

	public function type_allows_after_paging( $type ) {
		return $type === 'tagged';
	}

	/**
	 * Sets the url for the API request based on the account information,
	 * type of data needed, and additional parameters
	 *
	 * @param array $connected_account
	 * @param string $endpoint_slug header or user
	 * @param array $params
	 *
	 * @since 5.0
	 * @since 5.2 endpoints for mentions and tags added
	 * @since 5.3 endpoints for basic display api added
	 */
	protected function set_url( $connected_account, $endpoint_slug, $params ) {
		$account_type = isset( $connected_account['type'] ) ? $connected_account['type'] : 'personal';
		$num          = ! empty( $params['num'] ) ? (int) $params['num'] : 33;

		if ( $account_type === 'basic' || $account_type === 'personal' ) {
			$access_token = sbi_maybe_clean( $connected_account['access_token'] );
			if ( strpos( $access_token, 'IG' ) !== 0 ) {
				$this->encryption_error = true;

				$url = '';
			} else {

				if ( $endpoint_slug === 'access_token' ) {
					$url = 'https://graph.instagram.com/refresh_access_token?grant_type=ig_refresh_token&access_token=' . $access_token;
				} elseif ( $endpoint_slug === 'header' ) {
					$url = 'https://graph.instagram.com/me?fields=id,username,media_count,account_type&access_token=' . $access_token;
				} else {
					$num = min( $num, 200 );
					$url = 'https://graph.instagram.com/' . $connected_account['user_id'] . '/media?fields=media_url,thumbnail_url,caption,id,media_type,media_product_type,timestamp,username,comments_count,like_count,permalink,children%7Bmedia_url,id,media_type,timestamp,permalink,thumbnail_url%7D&limit=' . $num . '&access_token=' . $access_token;
				}
			}
		} else {
			$access_token = sbi_maybe_clean( $connected_account['access_token'] );
			if ( strpos( $access_token, 'EA' ) !== 0 ) {
				$this->encryption_error = true;

				$url = '';
			} else {
				// The new API has a max of 200 per request
				$num    = min( $num, 200 );
				$paging = isset( $params['cursor'] ) ? '&after=' . $params['cursor'] : '';
				if ( $endpoint_slug === 'header' ) {
					$url = 'https://graph.facebook.com/' . $connected_account['user_id'] . '?fields=biography,id,username,website,followers_count,media_count,profile_picture_url,name&access_token=' . $access_token;
				} elseif ( $endpoint_slug === 'stories' ) {
					$url = 'https://graph.facebook.com/' . $connected_account['user_id'] . '/stories?fields=media_url,caption,id,media_type,permalink,children%7Bmedia_url,id,media_type,permalink%7D&limit=100&access_token=' . $access_token;
				} elseif ( $endpoint_slug === 'recent_hashtag_refetch' ) {
					$num = 50;
					$url = 'https://graph.facebook.com/v10.0/' . $params['hashtag_id'] . '/top_media?user_id=' . $connected_account['user_id'] . '&fields=media_url,media_product_type,id,media_type,permalink&limit=' . $num . '&access_token=' . $access_token;
				} elseif ( $endpoint_slug === 'hashtags_top' ) {
					$num = min( $num, 50 );
					$url = 'https://graph.facebook.com/v10.0/' . $params['hashtag_id'] . '/top_media?user_id=' . $connected_account['user_id'] . '&fields=media_url,media_product_type,video_title,caption,id,media_type,timestamp,comments_count,like_count,permalink,children%7Bmedia_url,id,media_type,permalink%7D&limit=' . $num . '&access_token=' . $access_token;
				} elseif ( $endpoint_slug === 'hashtags_recent' ) {
					$num = min( $num, 50 );
					$url = 'https://graph.facebook.com/v10.0/' . $params['hashtag_id'] . '/recent_media?user_id=' . $connected_account['user_id'] . '&fields=media_url,media_product_type,video_title,caption,id,media_type,timestamp,comments_count,like_count,permalink,children%7Bmedia_url,id,media_type,permalink%7D&limit=' . $num . '&access_token=' . $access_token;
				} elseif ( $endpoint_slug === 'recently_searched_hashtags' ) {
					$url = 'https://graph.facebook.com/' . $connected_account['user_id'] . '/recently_searched_hashtags?access_token=' . $access_token . '&limit=40';
				} elseif ( $endpoint_slug === 'tagged' ) {
					$url = 'https://graph.facebook.com/v10.0/' . $connected_account['user_id'] . '/tags?user_id=' . $connected_account['user_id'] . '&fields=media_url,media_product_type,video_title,caption,id,media_type,timestamp,comments_count,like_count,permalink,children%7Bmedia_url,id,media_type,permalink%7D&limit=' . $num . '&access_token=' . $access_token . $paging;
				} elseif ( $endpoint_slug === 'ig_hashtag_search' ) {
					$url = 'https://graph.facebook.com/ig_hashtag_search?user_id=' . $connected_account['user_id'] . '&q=' . urlencode( $params['hashtag'] ) . '&access_token=' . $access_token;
				} elseif ( $endpoint_slug === 'comments' ) {
					$url = 'https://graph.facebook.com/v10.0/' . $params['post_id'] . '/comments?fields=text,username&access_token=' . $access_token;
				} else {
					$url = 'https://graph.facebook.com/v10.0/' . $connected_account['user_id'] . '/media?fields=media_url,media_product_type,video_title,thumbnail_url,caption,id,media_type,timestamp,username,comments_count,like_count,permalink,children%7Bmedia_url,id,media_type,timestamp,permalink,thumbnail_url%7D&limit=' . $num . '&access_token=' . $access_token;
				}
			}

		}

		$this->set_url_from_args( $url );
	}
}
