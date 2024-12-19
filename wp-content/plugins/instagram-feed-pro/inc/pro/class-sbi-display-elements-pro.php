<?php
/**
 * Class SB_Instagram_Display_Elements_Pro
 *
 * @since 5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class SB_Instagram_Display_Elements_Pro extends SB_Instagram_Display_Elements
{

	/**
	 * Pro - First looks for Pro only icons
	 *
	 * @param $type
	 * @param $icon_type
	 * @param $styles
	 *
	 * @return string
	 *
	 * @since 5.0
	 */
	public static function get_icon( $type, $icon_type, $styles = '' ) {
		$icon = self::get_pro_icons( $type, $icon_type, $styles );

		if ( $icon === '' ) {
			$icon = self::get_basic_icons( $type, $icon_type );
		}
		return $icon;
	}

	/**
	 * @param $type
	 * @param $icon_type
	 * @param $styles
	 *
	 * @return string
	 *
	 * @since 5.0
	 */
	private static function get_pro_icons( $type, $icon_type, $styles = '' ) {
		if ( $type === 'date' ) {
			if ( $icon_type === 'svg' ) {
				return '<svg ' . $styles . ' class="svg-inline--fa fa-clock fa-w-16" aria-hidden="true" data-fa-processed="" data-prefix="far" data-icon="clock" role="presentation" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm61.8-104.4l-84.9-61.7c-3.1-2.3-4.9-5.9-4.9-9.7V116c0-6.6 5.4-12 12-12h32c6.6 0 12 5.4 12 12v141.7l66.8 48.6c5.4 3.9 6.5 11.4 2.6 16.8L334.6 349c-3.9 5.3-11.4 6.5-16.8 2.6z"></path></svg>';
			} else {
				return '<i class="fa fa-clock" aria-hidden="true"></i>';
			}

		} elseif ( $type === 'likes' ) {
			if ( $icon_type === 'svg' ) {
				return '<svg ' . $styles . ' class="svg-inline--fa fa-heart fa-w-18" aria-hidden="true" data-fa-processed="" data-prefix="fa" data-icon="heart" role="presentation" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M414.9 24C361.8 24 312 65.7 288 89.3 264 65.7 214.2 24 161.1 24 70.3 24 16 76.9 16 165.5c0 72.6 66.8 133.3 69.2 135.4l187 180.8c8.8 8.5 22.8 8.5 31.6 0l186.7-180.2c2.7-2.7 69.5-63.5 69.5-136C560 76.9 505.7 24 414.9 24z"></path></svg>';
			} else {
				return '<i class="fa fa-heart" aria-hidden="true"></i>';
			}
		} elseif ( $type === 'comments' ) {
			if ( $icon_type === 'svg' ) {
				return '<svg ' . $styles . ' class="svg-inline--fa fa-comment fa-w-18" aria-hidden="true" data-fa-processed="" data-prefix="fa" data-icon="comment" role="presentation" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M576 240c0 115-129 208-288 208-48.3 0-93.9-8.6-133.9-23.8-40.3 31.2-89.8 50.3-142.4 55.7-5.2.6-10.2-2.8-11.5-7.7-1.3-5 2.7-8.1 6.6-11.8 19.3-18.4 42.7-32.8 51.9-94.6C21.9 330.9 0 287.3 0 240 0 125.1 129 32 288 32s288 93.1 288 208z"></path></svg>';
			} else {
				return '<i class="fa fa-comment" aria-hidden="true"></i>';
			}

		} elseif ( $type === 'newlogo' ) {
			return '<svg ' . $styles . ' class="sbi_new_logo fa-instagram fa-w-14" aria-hidden="true" data-fa-processed="" data-prefix="fab" data-icon="instagram" role="img" viewBox="0 0 448 512">
                <path fill="currentColor" d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"></path>
            </svg>';
		} elseif ( $type === 'map_marker' ) {
			if ( $icon_type === 'svg' ) {
				return '<svg ' . $styles . ' class="svg-inline--fa fa-map-marker fa-w-12" aria-hidden="true" data-fa-processed="" data-prefix="fa" data-icon="map-marker" role="presentation" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path fill="currentColor" d="M172.268 501.67C26.97 291.031 0 269.413 0 192 0 85.961 85.961 0 192 0s192 85.961 192 192c0 77.413-26.97 99.031-172.268 309.67-9.535 13.774-29.93 13.773-39.464 0z"></path></svg>';
			} else {
				return '<i class="fa fa-map-marker" aria-hidden="true"></i>';
			}

		} elseif ( $type === 'photo' ) {
			if ( $icon_type === 'svg' ) {
				return '<svg class="svg-inline--fa fa-image fa-w-16" aria-hidden="true" data-fa-processed="" data-prefix="far" data-icon="image" role="presentation" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M464 448H48c-26.51 0-48-21.49-48-48V112c0-26.51 21.49-48 48-48h416c26.51 0 48 21.49 48 48v288c0 26.51-21.49 48-48 48zM112 120c-30.928 0-56 25.072-56 56s25.072 56 56 56 56-25.072 56-56-25.072-56-56-56zM64 384h384V272l-87.515-87.515c-4.686-4.686-12.284-4.686-16.971 0L208 320l-55.515-55.515c-4.686-4.686-12.284-4.686-16.971 0L64 336v48z"></path></svg>';
			} else {
				return '<i class="fa fa-image" aria-hidden="true"></i>';
			}
		} elseif ( $type === 'user' ) {
			if ( $icon_type === 'svg' ) {
				return '<svg class="svg-inline--fa fa-user fa-w-16" style="margin-right: 3px;" aria-hidden="true" data-fa-processed="" data-prefix="fa" data-icon="user" role="presentation" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M96 160C96 71.634 167.635 0 256 0s160 71.634 160 160-71.635 160-160 160S96 248.366 96 160zm304 192h-28.556c-71.006 42.713-159.912 42.695-230.888 0H112C50.144 352 0 402.144 0 464v24c0 13.255 10.745 24 24 24h464c13.255 0 24-10.745 24-24v-24c0-61.856-50.144-112-112-112z"></path></svg>';
			} else {
				return '<i class="fa fa-user" aria-hidden="true"></i>';
			}

		} else {
			return '';
		}
	}

	/**
	 * The sbi_link element for each item has different styles applied if
	 * the lightbox is disabled.
	 *
	 * @param $settings
	 *
	 * @return string
	 *
	 * @since 5.0
	 */
	public static function get_sbi_link_classes( $settings ) {
		$customizer = sbi_doing_customizer( $settings );
		if ( $customizer ) {
			return ' :class="\'sbi_link_customizer sbi_link\' + ($parent.valueIsEnabled( $parent.customizerFeedData.settings.disablelightbox ) || $parent.valueIsEnabled( $parent.customizerFeedData.settings.shoppablefeed ) ? \' sbi_disable_lightbox\' : \'\')" ';
		}
		$lightbox_class = ( ! empty( $settings['disablelightbox'] ) && ($settings['disablelightbox'] === 'on' || $settings['disablelightbox'] === 'true' || $settings['disablelightbox'] === true) ) ? ' sbi_disable_lightbox' : '';
		return ' class="sbi_link ' . $lightbox_class . '" ';
	}

	/**
	 * Custom background color for the hover element. Slightly opaque.
	 *
	 * @param $settings
	 *
	 * @return string
	 *
	 * @since 5.0
	 */
	public static function get_sbi_link_styles( $settings ) {
		if ( ! empty( $settings['hovercolor'] ) && $settings['hovercolor'] !== '#000' ) {
			return ' style="background: rgba(' . esc_attr( sbi_hextorgb( $settings['hovercolor'] ) ) . ',0.85)"';
		}
		return '';
	}

	/**
	 * Text color for the hover element.
	 *
	 * @param $settings
	 *
	 * @return string
	 *
	 * @since 5.0
	 */
	public static function get_hover_styles( $settings ) {
		if ( ! empty( $settings['hovertextcolor'] ) && $settings['hovertextcolor'] !== '#000' ) {
			return ' style="color: rgba(' . esc_attr( sbi_hextorgb( $settings['hovertextcolor'] ) ) . ',1)"';
		}
		return '';
	}

	/**
	 * Inline styles applied to the caption/like count/comment count information appearing
	 * underneath each post by default.
	 *
	 * @param $settings
	 *
	 * @return string
	 *
	 * @since 5.0
	 */
	public static function get_sbi_info_styles( $settings ) {
		$styles = '';
		if ( (! empty( $settings['captionsize'] ) && $settings['captionsize'] !== 'inherit') || ! empty( $settings['captioncolor'] ) ) {
			$styles = ' style="';
			if ( ! empty( $settings['captionsize'] ) && $settings['captionsize'] !== 'inherit' ) {
				$styles .= 'font-size: '. esc_attr( $settings['captionsize'] ) . 'px;';
			}
			if ( ! empty( $settings['captioncolor'] ) ) {
				$styles .= 'color: rgb(' . esc_attr( sbi_hextorgb( $settings['captioncolor'] ) ). ');';
			}
			$styles .= '"';
		}
		return $styles;
	}

	/**
	 * Color of the likes heart icon and the comment voice box icon in the
	 * sbi_info area.
	 *
	 * @param $settings
	 *
	 * @return string
	 *
	 * @since 5.0
	 */
	public static function get_sbi_meta_color_styles( $settings ) {
		if ( ! empty( $settings['likescolor'] ) ) {
			return ' style="color: rgb(' . esc_attr( sbi_hextorgb( $settings['likescolor'] ) ). ');"';
		}
		return '';
	}

	/**
	 * Size of the likes heart icon and the comment voice box icon in the
	 * sbi_info area.
	 *
	 * @param $settings
	 *
	 * @return string
	 *
	 * @since 5.0
	 */
	public static function get_sbi_meta_size_color_styles( $settings ) {
		$styles = '';
		if ( ( ! empty( $settings['likessize'] ) && $settings['likessize'] !== 'inherit' ) || ! empty( $settings['likescolor'] ) ) {
			$styles = ' style="';
			if ( ! empty( $settings['likessize'] ) && $settings['likessize'] !== 'inherit' ) {
				$styles .= 'font-size: ' . esc_attr( $settings['likessize'] ) . 'px;';
			}
			if ( ! empty( $settings['likescolor'] ) ) {
				$styles .= 'color: rgb(' . esc_attr( sbi_hextorgb( $settings['likescolor'] ) ) . ');';
			}
			$styles .= '"';
		}

		return $styles;
	}

	/**
	 * A not very elegant but useful method to abstract out how the settings
	 * work for displaying certain elements in the feed.
	 *
	 * @param string $element specific key, view below for supported ones
	 * @param $settings
	 *
	 * @return bool
	 *
	 * @since 5.0
	 */
	public static function should_show_element( $element, $settings ) {
		$customizer = sbi_doing_customizer( $settings );
		if ( $customizer ) {
			return true;
		} else {
			$hover_elements = array(
				'hoverusername',
				'hoverdate',
				'hoverinstagram',
				'hoverlocation',
				'hovercaption',
				'hoverlikes'
			);
			if ( in_array( $element, $hover_elements, true ) ) {
				$hover_items = explode( ',', str_replace( ' ', '', $settings['hoverdisplay'] ) );

				return in_array( str_replace( 'hover', '', $element ), (array) $hover_items, true );
			}

			$standard_bool_default_true_options = array(
				'caption',
				'likes',
				'headerfollowers',
				'headerbio',
				'headerstory'
			);
			$element_settings_pairs             = array(
				'caption'         => 'showcaption',
				'likes'           => 'showlikes',
				'headerfollowers' => 'showfollowers',
				'headerbio'       => 'showbio',
				'headerstory'     => 'stories',
			);
			if ( in_array( $element, $standard_bool_default_true_options, true ) ) {
				return $settings[ $element_settings_pairs[ $element ] ] === 'true'
				       || $settings[ $element_settings_pairs[ $element ] ] === 'on'
				       || $settings[ $element_settings_pairs[ $element ] ] === true
				       || ! isset( $settings[ $element_settings_pairs[ $element ] ] );
			}
		}

		return false;
	}

	/**
	 * Used for attribute that determines how long a slide will appear in a "story".
	 *
	 * @param $settings
	 *
	 * @return int|mixed
	 *
	 * @since 5.0
	 */
	public static function get_stories_delay( $settings ) {
		$stories_time = ! empty( $settings['storiestime'] ) ? max( 500, (int)$settings['storiestime'] ) : 5000;
		return $stories_time;
	}

	/**
	 * Not used with the core feed but can be used for customizations.
	 *
	 * @param $settings
	 *
	 * @return string
	 *
	 * @since 5.0
	 */
	public static function get_feed_type_class( $settings ) {
		return 'sbi_feed_type_' . esc_attr( $settings['type'] );
	}

	/**
	 * Boxed style headers have more color options - primary color
	 *
	 * @param $settings
	 *
	 * @return string
	 *
	 * @since 5.0
	 */
	public static function get_boxed_header_styles( $settings ) {
		if ( ! empty( $settings['headerprimarycolor'] ) ) {
			return ' style="background: rgb(' . esc_attr( sbi_hextorgb( $settings['headerprimarycolor'] ) ). ');"';
		}
		return '';
	}

	/**
	 * Boxed style headers have more color options - secondary color
	 *
	 * @param $settings
	 *
	 * @return string
	 *
	 * @since 5.0
	 */
	public static function get_header_bar_styles( $settings ) {
		if ( ! empty( $settings['headersecondarycolor'] ) ) {
			return ' style="background: rgb(' . esc_attr( sbi_hextorgb( $settings['headersecondarycolor'] ) ). ');"';
		}
		return '';
	}

	/**
	 * For text, likes counts, post counts
	 *
	 * @param $settings
	 *
	 * @return string
	 *
	 * @since 5.0
	 */
	public static function get_header_info_styles( $settings ) {
		if ( ! empty( $settings['headerprimarycolor'] ) ) {
			return ' style="color: rgb(' . esc_attr( sbi_hextorgb( $settings['headerprimarycolor'] ) ). ');"';
		}
		return '';
	}

	/**
	 * Global header classes
	 *
	 * @param $settings
	 *
	 * @return string
	 *
	 * @since 5.0
	 */
	public static function get_header_class( $settings, $avatar, $type = 'normal' ) {
		$customizer = sbi_doing_customizer( $settings );
		if ( $customizer ) {
			return ' :class="$parent.getHeaderClass(\'' . $type . '\')" ';
		} else {
			$type_class     = SB_Instagram_Display_Elements_Pro::get_feed_type_class( $settings );
			$centered_class = $settings['headerstyle'] === 'centered' && $type === 'normal' ? ' sbi_centered' : '';
			$size_class     = SB_Instagram_Display_Elements_Pro::get_header_size_class( $settings );
			$avatar_class   = $avatar !== '' ? '' : ' sbi_no_avatar';
			$boxed_class    = $type === 'boxed' ? ' sbi_header_style_boxed' : '';
			$palette_class  = SB_Instagram_Display_Elements::get_palette_class( $settings, '_header' );
			$outside_class  = $settings['headeroutside'] ? ' sbi_header_outside' : '';

			return ' class="sb_instagram_header ' . esc_attr( $type_class ) . esc_attr( $centered_class ) . esc_attr( $size_class ) . esc_attr( $outside_class ) . esc_attr( $avatar_class ) . esc_attr( $boxed_class ) . esc_attr( $palette_class ) . '" ';
		}
	}

	/**
	 * Header Story Attributes
	 *
	 * @param $customizer, $settings, $header_data, $avatar
	 *
	 * @return string
	 *
	 * @since 6.0
	 */
	public static function get_story_attributes( $customizer, $settings, $header_data, $avatar ){
		if ( $customizer ) {
			return ' :data-story-wait="$parent.getStoryData() ? $parent.getStoryDelays() : false" :data-story-data="$parent.getStoryData()" :data-story-avatar="$parent.getStoryData() ? $parent.getHeaderAvatar() : false" ';
		} else {
			$stories_delay     = SB_Instagram_Display_Elements_Pro::get_stories_delay( $settings );
			$story_data        = SB_Instagram_Parse_Pro::get_story_data( $header_data );
			$should_show_story = ! empty( $story_data ) ? SB_Instagram_Display_Elements_Pro::should_show_element( 'headerstory', $settings ) : false;

			return $should_show_story ? ' data-story-wait="' . (int) $stories_delay . '" data-story-data="' . esc_attr( sbi_json_encode( $story_data ) ) . '" data-story-avatar="' . esc_attr( $avatar ) . '"' : '';
		}
	}

	/**
     * Photo wrap content
     *
	 * @param array $post
	 * @param array $settings
	 *
	 * @return string
     *
     * @since 6.0
	 */
    public static function get_photo_wrap_content( $post, $settings ) {
	    $post_id        = SB_Instagram_Parse_Pro::get_post_id( $post );
	    $media_full_res = SB_Instagram_Parse_Pro::get_media_url( $post );
	    $caption        = SB_Instagram_Parse_Pro::get_caption( $post, '' );
	    $caption = SB_Instagram_Display_Elements::sanitize_caption( $caption );

	    if ( sbi_doing_customizer( $settings ) ) {
	    	$moderation_mode = SB_Instagram_Display_Elements_Pro::print_moderation_toggle_button( $post_id );
	    	$shoppable_button = SB_Instagram_Display_Elements_Pro::print_shoppable_edit_button( $post_id, esc_url( $media_full_res ), $caption );
		    return $moderation_mode . $shoppable_button;
	    }

	    return '';
    }

    /**
     * Post Item HTML Attributes
     * Mainly used in the VueJS Feed Preview
     *
	 * @param array $post
	 *
	 * @return string
     *
     * @since 6.0
	 */
    public static function get_sbi_item_attributes( $post, $settings = array() ) {
	    $post_id = SB_Instagram_Parse_Pro::get_post_id( $post );
	    $post_attributes = '';
	    if ( sbi_doing_customizer( $settings ) ) {
		    $post_attributes = ' :data-moderation="$parent.checkPostModertationModeAttribute(\'<?php echo $post_id ?>\')" ';
	    }

	    if ( $settings['captionlinks'] ) {
            if ( ! empty( $settings['shoppablelist'][ $post_id ] ) ) {
	            $post_attributes .= ' data-shoppable="' . esc_attr( $settings['shoppablelist'][ $post_id ] ) . '"';
            }
        }
	    return $post_attributes;
    }


	/**
     * Print Shoppable Button
     *
	 * @param int $post_id
	 * @param string $media
	 * @param string $caption
	 *
	 * @return string
	 */
	public static function print_shoppable_edit_button( $post_id, $media, $caption ){
		ob_start();
		$caption = SB_Instagram_Display_Elements::sanitize_caption( $caption );
	?>
		<button class="sb-shoppable-edit-btn sbi-btn-grey sb-button-standard"
			v-if="!$parent.checkPostShoppableFeed('<?php echo $post_id ?>') && $parent.valueIsEnabled( $parent.customizerFeedData.settings.shoppablefeed ) && $parent.customizerScreens.activeSection === 'settings_shoppable_feed'"
			:data-active="($parent.shoppableFeed.postId == '<?php echo $post_id ?>' || Object.keys($parent.customizerFeedData.settings.shoppablelist).length == 0 )  && $parent.valueIsEnabled( $parent.customizerFeedData.settings.shoppablefeed ) && $parent.customizerScreens.activeSection === 'settings_shoppable_feed'"
			@click.prevent.default="$parent.openPostShoppableFeed('<?php echo $post_id ?>', '<?php echo $media ?>', '<?php echo htmlspecialchars($caption) ?>')">
			<div class="sb-shoppable-edit-btn-link" v-html="$parent.svgIcons['link']"></div>
			<span v-html="$parent.genericText.add"></span>
		</button>
		<button class="sb-shoppable-edit-btn sbi-btn-blue sb-button-standard"
			v-if="$parent.checkPostShoppableFeed('<?php echo $post_id ?>') && $parent.valueIsEnabled( $parent.customizerFeedData.settings.shoppablefeed ) && $parent.customizerScreens.activeSection === 'settings_shoppable_feed'"
			:data-active="($parent.shoppableFeed.postId == '<?php echo $post_id ?>' || Object.keys($parent.customizerFeedData.settings.shoppablelist).length == 0 )  && $parent.valueIsEnabled( $parent.customizerFeedData.settings.shoppablefeed ) && $parent.customizerScreens.activeSection === 'settings_shoppable_feed'"
			@click.prevent.default="$parent.openPostShoppableFeed('<?php echo $post_id ?>', '<?php echo $media ?>', '<?php echo htmlspecialchars($caption) ?>')">
			<div class="sb-shoppable-edit-btn-link" v-html="$parent.svgIcons['link']"></div>
			<span v-html="$parent.genericText.update"></span>
		</button>
	<?php
		$html = ob_get_contents();
		ob_get_clean();
		return $html;
	}


	/**
     * Print Moderation Toggle Button
     *
	 * @param int $post_id
	 *
	 * @return string
	 */
	public static function print_moderation_toggle_button( $post_id ){
		ob_start();
	?>
		<div class="sbi-moderation-overlay-ctn" v-if="$parent.customizerScreens.activeSection === 'settings_filters_moderation' && $parent.viewsActive.moderationMode && $parent.valueIsEnabled($parent.customizerFeedData.settings.enablemoderationmode) " @click.prevent.default="$parent.addPostToModerationList('<?php echo $post_id ?>')">
			<div class="sbi-moderation-toggle" :data-type="$parent.checkPostModertationMode('<?php echo $post_id ?>')">
				<div class="sbi-moderation-toggle-icon sbi-moderation-checkmark"></div>
				<div class="sbi-moderation-toggle-icon sbi-moderation-x"></div>
			</div>
		</div>
	<?php
		$html = ob_get_contents();
		ob_get_clean();
		return $html;
	}


	/**
     * Print Moderation Toggle Button
     *
	 * @param int $post_id
	 *
	 * @return string
	 */
	public static function header_type( $settings ) {
		$header_template = 'header-generic';
    	if ( $settings['type'] != 'hashtag' && $settings['headerstyle'] != 'text') {
			$header_template = $settings['headerstyle'] !== 'boxed' ?  'header' : 'header-boxed';
		}
	    if( isset( $settings['headerstyle'] ) && $settings['headerstyle'] == 'text'){
		    $header_template = 'header-text';
	    }
	    return $header_template;
    }

    /**
	 * Should Show Print HTML
	 *
	 * @param bool $customizer
	 * @param string $condition
	 *
	 * @return string
	 *
	 * @since 6.1
	 */
	public static function create_condition_show_vue( $customizer, $condition ) {
		if ( $customizer ) {
			return ' v-show="' . $condition . '" ';
		}
		return '';
	}


	/**
	 * Text Header Style
	 *
	 * @param $settings
	 *
	 * @return string
	 *
	 * @since 6.1
	 */
	public static function get_header_text_style( $settings ) {
		if ( ! empty( $settings['headertextcolor'] ) && $settings['headertextcolor'] !== '#' && !sbi_doing_customizer( $settings )) {
			return ' style="color: ' . $settings['headertextcolor'] . ' "';
		}
		return '';
	}

}
