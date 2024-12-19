<?php
/**
 * Class SB_Instagram_Parse_Pro
 *
 * @since 5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class SB_Instagram_Parse_Pro extends SB_Instagram_Parse
{
	/**
	 * @param $post array
	 *
	 * @return string
	 *
	 * @since 5.0
	 */
	public static function get_username( $post ) {
		if ( ! empty( $post['username'] ) ) {
			return $post['username'];
		} elseif ( ! empty( $post['user']['username'] ) ) {
			return $post['user']['username'];
		} elseif ( isset( $post['data']['username'] ) ) {
			return $post['data']['username'];
		}

		return '';
	}
	public static function get_instagram_url_part( $header_data, $post ) {
		if ( isset( $post['term'] ) && strpos( $post['term'], '#' ) !== false ) {
			$hashtag = str_replace( '#', '', $post['term'] );
		} elseif ( isset( $header_data['hashtags_recent'] ) ) {
			$hashtag = $header_data['hashtags_recent']['hashtag'];
		} elseif ( isset( $header_data['hashtags_top'] ) ) {
			$hashtag = $header_data['hashtags_top']['hashtag'];
		} else {
			$part = '';
			foreach ( $header_data as $key => $data ) {
				if ( empty( $part ) ) {
					$part = $key;
				}
			}
			return $part;

		}

		return 'explore/tags/' . $hashtag;
	}

	/**
	 * @param $header_data
	 *
	 * @return string
	 */
	public static function get_generic_term( $header_data ) {
		if ( isset( $header_data['term'] ) ) {
			return $header_data['term'];
		} else {
			return '';
		}
	}

	/**
	 * @param $post array
	 *
	 * @return int
	 *
	 * @since 5.0
	 */
	public static function get_likes_count( $post ) {
		if ( ! empty( $post['likes'] ) ) {
			return $post['likes']['count'];
		} elseif ( ! empty( $post['like_count'] ) ) {
			return $post['like_count'];
		}
		return 0;
    }

	/**
	 * @param $post array
	 *
	 * @return int
	 *
	 * @since 5.0
	 */
	public static function get_comments_count( $post ) {
		if ( ! empty( $post['comments']['count'] ) ) {
			return $post['comments']['count'];
		} elseif ( ! empty( $post['comments_count'] ) ) {
			return $post['comments_count'];
		}
		return 0;
	}

	public static function comment_or_like_counts_data_exists( $post ) {
		if ( isset( $post['comments']['count'] ) ) {
			return true;
		} elseif ( isset( $post['comments_count'] ) ) {
			return true;
		}
		return false;
	}

	/**
	 * If an avatar exists for this username (from a connected account)
	 * the url for it will be returned.
	 *
	 * @param $post
	 * @param $avatars array key value pair of user name => avatar url
	 *
	 * @return string
	 */
	public static function get_item_avatar( $post, $avatars ) {
		if ( empty ( $avatars ) ) {
			return '';
		} else {
			$username = SB_Instagram_Parse_Pro::get_username( $post );
			if ( isset( $avatars[ $username ] ) ) {
				return $avatars[ $username ];
			}
		}
		return '';
	}

	/**
	 * Video and carousel post types have additional data that is used
	 * in the lightbox
	 *
	 * @param $post
	 *
	 * @return array key value pair of data type => data used in lightbox
	 *
	 * @since 5.0
	 *
	 */
	public static function get_lightbox_media_atts( $post ) {
		$return = array(
			'video' => '',
			'carousel' => ''
		);
		if ( isset( $post['videos'] ) ) {
			$return['video'] = $post['videos']['standard_resolution']['url'];
		} elseif ( isset( $post['media_type'] ) && $post['media_type'] === 'VIDEO' && isset( $post['media_url'] ) ) {
			$return['video'] = $post['media_url'];
		} elseif ( isset( $post['media_type'] ) && $post['media_type'] === 'VIDEO' ) {
			$return['video'] = 'missing';
		} else {
			$return['video'] = '';
		}

		if ( SB_Instagram_Parse_Pro::get_media_type( $post ) === 'carousel' ) {
			$carousel_object = SB_Instagram_Parse_Pro::get_carousel_object( $post );
			$return['carousel'] = sbi_json_encode( $carousel_object );

			if ( $carousel_object['vid_first'] ) {
				$return['video'] = $carousel_object['data'][0]['media'];
			}
		}

		return $return;
	}

	/**
	 * Carousel post data is parsed and arranged for use in the lightbox
	 * here
	 *
	 * @param $post
	 *
	 * @return array
	 *
	 * @since 5.0
	 */
	public static function get_carousel_object( $post ) {
		$car_obj = array(
			'data' => array(),
			'vid_first' => false
		);

		if ( isset( $post['carousel_media'] ) ) {
			$i = 0;
			foreach ( $post['carousel_media'] as $carousel_item ) {
				if ( isset( $carousel_item['images'] ) ) {
					$car_obj['data'][ $i ] = array(
						'type' => 'image',
						'media' => $carousel_item['images']['standard_resolution']['url']
					);
				} elseif ( isset( $carousel_item['videos'] ) ) {
					$car_obj['data'][ $i ] = array(
						'type' => 'video',
						'media' => $carousel_item['videos']['standard_resolution']['url']
					);

					if ( $i === 0 ) {
						$car_obj['vid_first'] = true;
					}
				}

				$i++;
			}
		} elseif ( isset( $post['children'] ) ) {
			$i = 0;
			foreach ( $post['children']['data'] as $carousel_item ) {
				if ( $carousel_item['media_type'] === 'IMAGE' ) {
					if ( isset( $carousel_item['media_url'] ) ) {
						$car_obj['data'][ $i ] = array(
							'type' => 'image',
							'media' => $carousel_item['media_url']
						);
					} else {
						$media = trailingslashit( SBI_PLUGIN_URL ) . 'img/thumb-placeholder.png';
						//attempt to get
						$permalink = SB_Instagram_Parse::fix_permalink( SB_Instagram_Parse::get_permalink( $carousel_item ) );
						$single = new SB_Instagram_Single( $permalink );
						$single->init();
						$carousel_item_post = $single->get_post();

						if ( isset( $carousel_item_post['thumbnail_url'] ) ) {
							$media = $carousel_item_post['thumbnail_url'];
						} elseif ( isset( $carousel_item_post['media_url'] ) && strpos( $carousel_item_post['media_url'], '.mp4' ) === false ) {
							$media = $carousel_item_post['media_url'];
						}
						$car_obj['data'][ $i ] = array(
							'type' => 'image',
							'media' => $media
						);
					}
				} elseif ( $carousel_item['media_type'] === 'VIDEO' ) {
					if ( isset( $carousel_item['media_url'] ) ) {
						$car_obj['data'][ $i ] = array(
							'type' => 'video',
							'media' => $carousel_item['media_url']
						);

						if ( $i === 0 ) {
							$car_obj['vid_first'] = true;
						}
					} else {
						$media = trailingslashit( SBI_PLUGIN_URL ) . 'img/thumb-placeholder.png';
						//attempt to get
						$permalink = SB_Instagram_Parse::fix_permalink( SB_Instagram_Parse::get_permalink( $carousel_item ) );
						$single = new SB_Instagram_Single( $permalink );
						$single->init();
						$carousel_item_post = $single->get_post();

						if ( isset( $carousel_item_post['thumbnail_url'] ) ) {
							$media = $carousel_item_post['thumbnail_url'];
						} elseif ( isset( $carousel_item_post['media_url'] ) && strpos( $carousel_item_post['media_url'], '.mp4' ) === false ) {
							$media = $carousel_item_post['media_url'];
						}
						$car_obj['data'][ $i ] = array(
							'type' => 'image',
							'media' => $media
						);
					}
				}

				$i++;
			}
		}

		return $car_obj;
	}

	/**
	 * Will only return something if using the old API
	 *
	 * @param $post
	 *
	 * @return array data used by the hover element for locations
	 *
	 * @since 5.0
	 */
	public static function get_location_info( $post ) {
		$return = array();
		if ( isset( $post['location'] ) ) {
			$name = ! empty( $post['location'] ) && ! empty( $post['location']['name'] ) ? $post['location']['name'] : '';
			$return = array(
				'name' => $name,
				'id' => '',
				'longitude' => '',
				'lattitude' => ''
			);
			if ( isset( $post['location']['id'] ) ) {
				$return['id'] = $post['location']['id'];
			}
			if ( isset( $post['location']['longitude'] ) ) {
				$return['longitude'] = $post['location']['longitude'];
			}
			if ( isset( $post['location']['lattitude'] ) ) {
				$return['lattitude'] = $post['location']['lattitude'];
			}
		}

        return $return;
	}

	/**
	 * Only available for the old API. Returns list of hashtags
	 * used in the feed.
	 *
	 * @param $post
	 *
	 * @return bool
	 *
	 * @since 5.1
	 */
	public static function get_tags( $post ) {
		if ( isset( $post['tags'] ) ) {
			return $post['tags'];
		}

		return false;
	}

	/**
	 * Not directly parsed from the API response but story data
	 * is always included as part of header data in the feed so
	 * this function will return it if it was set along with header
	 * data
	 *
	 * @param $header_data
	 *
	 * @return string
	 *
	 * @since 5.0
	 */
	public static function get_story_data( $header_data ) {
		if ( isset( $header_data['stories'] ) && isset( $header_data['stories'][0] ) ) {
			return $header_data['stories'];
		}
		return '';
	}

	/**
	 * Number of posts made by account
	 *
	 * @param $header_data
	 *
	 * @return int
	 *
	 * @since 5.0
	 */
	public static function get_post_count( $header_data ) {
		if ( isset( $header_data['data']['counts'] ) ) {
			return $header_data['data']['counts']['media'];
		} elseif ( isset( $header_data['counts'] ) ) {
			return $header_data['counts']['media'];
		} elseif ( isset( $header_data['media_count'] ) ) {
			return $header_data['media_count'];
		}
		return 0;
	}

	/**
	 * Number of followers for account
	 *
	 * @param $header_data
	 *
	 * @return int
	 *
	 * @since 5.0
	 */
	public static function get_follower_count( $header_data ) {
		if ( isset( $header_data['data']['counts'] ) ) {
			return $header_data['data']['counts']['followed_by'];
		} elseif ( isset( $header_data['counts'] ) ) {
			return $header_data['counts']['followed_by'];
		} elseif ( isset( $header_data['followers_count'] ) ) {
			return $header_data['followers_count'];
		}
		return '';
	}
}