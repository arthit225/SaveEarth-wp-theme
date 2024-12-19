<?php
/**
 * Class SB_Instagram_Settings_Pro
 *
 * @since 5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

use InstagramFeed\Helpers\Util;
use InstagramFeed\SB_Instagram_Data_Encryption;


class SB_Instagram_Settings_Pro extends SB_Instagram_Settings{

	private $business_accounts;

	/**
	 * SB_Instagram_Settings constructor.
	 *
	 * @param array $atts
	 * @param array $db
	 * @param array|bool $preview_settings
	 */
	public function __construct( $atts, $db, $preview_settings = false ) {
		if ( empty( $atts['feed'] ) ) {
			$sbi_statuses = get_option( 'sbi_statuses', array() );
			if ( empty( $sbi_statuses['support_legacy_shortcode'] ) ) {
				if ( empty( $atts ) ) {
					$atts = array();
				}

				$atts['feed'] = 1;
			}
		}

		$this->connected_accounts = array();
		$this->feed_type_and_terms = array();
		$this->connected_accounts_in_feed = array();
		$this->atts = $this->filter_atts_for_legacy( $atts );
		$this->db   = $db;

		if ( ! empty( $atts['feed'] ) && $atts['feed'] !== 'legacy' ) {
			$this->settings = SB_Instagram_Settings::get_settings_by_feed_id( $atts['feed'], $preview_settings );

			if ( ! empty( $this->settings ) ) {
				$this->settings['customizer'] = isset($atts['customizer']) && $atts['customizer'] == true ? true : false;
				$this->settings['feed'] = intval( $atts['feed'] );
				if ( ! empty( $this->atts['cachetime'] ) ) {
					$this->settings['cachetime'] = $this->atts['cachetime'];
				}

				$this->connected_accounts = $this->get_connected_accounts_from_settings();

				if ( $this->settings['type'] === 'mixed' ) {
					$this->atts['tagged'] = $this->settings['tagged'];
					$this->atts['user'] = $this->settings['id'];
					$this->atts['hashtag'] = $this->settings['hashtag'];
				}

				foreach ( $this->atts as $key => $value ) {
					$this->settings[ $key ] = $value;
				}
			}
		}

		if ( empty( $this->settings ) ) {
			if ( ! empty( $preview_settings ) ) {
				$this->settings = $preview_settings;
			} else {
				$sbi_statuses = get_option( 'sbi_statuses', array() );

				if ( ! empty( $sbi_statuses['support_legacy_shortcode'] ) ) {
					$legacy_settings_option = self::get_legacy_feed_settings();

					if ( empty( $legacy_settings_option ) ) {
						$this->settings = SB_Instagram_Settings_Pro::get_settings_by_legacy_shortcode( $atts, $db );
					} else {
						$this->settings = wp_parse_args( $this->atts, $legacy_settings_option );
					}
				}

			}
			if ( ! empty( $this->settings ) ) {
				if ( ! is_array( $this->settings ) ) {
					$this->settings = array();
				}
				$this->settings['customizer'] = isset($atts['customizer']) && $atts['customizer'] == true ? true : false;

				$this->settings['feed'] = 'legacy';
				if ( isset( $this->settings['type'] ) && $this->settings['type'] === 'mixed' ) {
					$this->atts['tagged']  = ! empty( $this->settings['tagged'] ) ? $this->settings['tagged'] : array();
					$this->atts['user']    = ! empty( $this->settings['id'] ) ? $this->settings['id'] : array();
					$this->atts['hashtag'] = ! empty( $this->settings['hashtag'] ) ? $this->settings['hashtag'] : array();
				}

				$this->connected_accounts = $this->get_connected_accounts_from_settings();

			}

			$this->settings = wp_parse_args( $this->settings, \InstagramFeed\Builder\SBI_Feed_Saver::settings_defaults() );

		}
		if ( empty( $this->settings ) ) {
			return;
		}

		$this->settings = $this->filter_for_builder( $this->settings, $atts );

		$this->settings = $this->filter_for_legacy( $this->settings, $atts );


		if ( ! empty( $this->settings['customizer'] ) ) {
			$this->settings = $this->filter_for_customizer( $this->settings );
		}

		if ( empty( $this->settings['feed_is_moderated'] ) ) {
			$this->settings['feed_is_moderated'] = false;
		}


		$this->connected_accounts = apply_filters( 'sbi_connected_accounts', $this->connected_accounts, $this->atts );

		$this->settings['customtemplates'] = $this->settings['customtemplates'] === true || $this->settings['customtemplates'] === 'true' || $this->settings['customtemplates'] === 'on';
		if ( Util::isDebugging() ) {
			$this->settings['customtemplates'] = false;
		}
		$this->settings['showbio'] = $this->settings['showbio'] === 'true' || $this->settings['showbio'] === 'on' || $this->settings['showbio'] === true;
		if ( isset( $atts['showbio'] ) && $atts['showbio'] === 'false' ) {
			$this->settings['showbio'] = false;
		}
		// allow the use of "user=" for tagged type as well
		if ( $this->settings['type'] === 'tagged'
		     && empty( $atts['tagged'] )
		     && ! empty( $atts['user'] ) ) {
			$this->settings['tagged'] = $atts['user'];
		}
		$this->settings['num'] = max( (int)$this->settings['num'], 0);
		$this->settings['minnum'] = max( (int)$this->settings['num'], (int)$this->settings['nummobile'] );
		if ( $this->settings['sortby'] === 'likes' ) {
			$this->settings['apinum'] = 200;
		}

		$this->settings['disable_resize'] = isset( $db['sb_instagram_disable_resize'] ) && ($db['sb_instagram_disable_resize'] === 'on' || $db['disable_js_image_loading'] === true);
		$this->settings['favor_local'] = ! isset( $db['sb_instagram_favor_local'] ) || ($db['sb_instagram_favor_local'] === 'on') || ($db['sb_instagram_favor_local'] === true);
		$this->settings['backup_cache_enabled'] = ! isset( $db['sb_instagram_backup'] ) || ($db['sb_instagram_backup'] === 'on') || $db['sb_instagram_backup'] === true;
		$this->settings['font_method'] = 'svg';
		$this->settings['disable_js_image_loading'] = ! isset( $this->settings['disable_js_image_loading'] ) && isset( $db['disable_js_image_loading'] ) && (($db['disable_js_image_loading'] === 'on') || $db['disable_js_image_loading'] === true);

		switch ( $db['sbi_cache_cron_interval'] ) {
			case '30mins' :
				$this->settings['sbi_cache_cron_interval'] = 60*30;
				break;
			case '1hour' :
				$this->settings['sbi_cache_cron_interval'] = 60*60;
				break;
			default :
				$this->settings['sbi_cache_cron_interval'] = 60*60*12;
		}
		$this->settings['sb_instagram_cache_time'] = isset( $this->db['sb_instagram_cache_time'] ) ? $this->db['sb_instagram_cache_time'] : 1;
		$this->settings['sb_instagram_cache_time_unit'] = isset( $this->db['sb_instagram_cache_time_unit'] ) ? $this->db['sb_instagram_cache_time_unit'] : 'hours';

		$this->settings['stories'] = (($this->settings['stories'] === '' && ! isset( $db['sb_instagram_stories'])) || $this->settings['stories'] === true || $this->settings['stories'] === 'on' || $this->settings['stories'] === 'true') && $this->settings['stories'] !== 'false';

		$this->settings['addModerationModeLink'] = ($this->settings['moderationmode'] === true || $this->settings['moderationmode'] === 'on' || $this->settings['moderationmode'] === 'true') && current_user_can('edit_posts' );

		$moderation_mode = isset ( $atts['doingModerationMode'] );
		if ( $moderation_mode ) {
			$this->settings['cols'] = 4;
			$this->settings['colsmobile'] = 2;
			$this->settings['colstablet'] = 3;

			$this->settings['num'] = 50;
			$this->settings['apinum'] = 50;
			$this->settings['minnum'] = 50;
			$this->settings['nummobile'] = 50;

			$this->settings['lightboxcomments'] = false;
			$this->settings['showlikes'] = false;
			$this->settings['showcaption'] = false;
			$this->settings['showheader'] = true;
			$this->settings['showbutton'] = true;
			$this->settings['showfollow'] = false;
			$this->settings['disablelightbox'] = true;
			$this->settings['sortby'] = 'none';
			$this->settings['doingModerationMode'] = true;
			$this->settings['offset'] = 0;
		}

		if ( ! empty( $this->atts['cachetime'] ) ) {
			$this->settings['caching_type'] = 'page';
			$cache_time = max( 1, (int) $this->atts['cachetime'] );
			$this->settings['cachetimeseconds'] = 60 * $cache_time;
		} elseif ( ! empty( $this->db['legacy_page_cache'] ) ) {
			$this->settings['caching_type'] = 'page';
			$cache_time = max( 1, (int) $this->db['legacy_page_cache'] );
			$this->settings['cachetimeseconds'] = 60 * $cache_time;
		} else {
			$this->settings['caching_type'] = 'background';
		}

		$feed_is_permanent = isset( $atts['permanent'] ) ? ($atts['permanent'] === 'true') : false;
		$white_list_is_permanent = false;
		if ( ! empty( $this->settings['whitelist'] ) ) {
			$permanent_white_lists = get_option( 'sb_permanent_white_lists', array() );
			if ( in_array( $this->settings['whitelist'], $permanent_white_lists, true ) ) {
				$white_list_is_permanent = true;
			}

			$this->settings['whitelist_ids'] = get_option( 'sb_instagram_white_lists_'.$this->settings['whitelist'], array() );
			$this->settings['whitelist_num'] = count( $this->settings['whitelist_ids'] );
		}

		if ( $feed_is_permanent || $white_list_is_permanent ) {
			$this->settings['backup_cache_enabled'] = true;
			$this->settings['alwaysUseBackup'] = true;
			$this->settings['caching_type'] = 'permanent';
		}

		$this->settings['headeroutside'] = ($this->settings['headeroutside'] === true || $this->settings['headeroutside'] === 'on' || $this->settings['headeroutside'] === 'true');
		if ( $this->settings['showheader'] === 'false' ) {
			$this->settings['showheader'] = false;
		}
		$this->settings['heightunit'] = ! empty( $this->settings['heightunit'] ) ? $this->settings['heightunit'] : 'px';

		if ( empty( $atts['layout'] ) && isset( $atts['carousel'] ) && $atts['carousel'] === 'true' ) {
			$this->settings['layout'] = 'carousel';
		}

		if ( $this->settings['layout'] === 'carousel'
		     && $this->settings['num'] <= $this->settings['cols'] ) {
			$this->settings['num'] = 2 * (int)$this->settings['cols'];
			$this->settings['minnum'] = 2 * (int)$this->settings['cols'];
		}

		$this->settings['ajax_post_load'] = ! isset( $this->settings['ajax_post_load'] ) && isset( $db['sb_ajax_initial'] ) && (($db['sb_ajax_initial'] === 'on') || $db['sb_ajax_initial'] === true);

		$this->settings['isgutenberg'] = SB_Instagram_Blocks::is_gb_editor();
		if ( $this->settings['isgutenberg'] ) {
			$this->settings['ajax_post_load'] = false;
			$this->settings['disable_js_image_loading'] = true;
		}

		if ( (int)$this->settings['offset'] > 0 ) {
			$num = max( (int)$this->settings['minnum'], (int)$this->settings['apinum'] );
			$this->settings['apinum'] = $num + (int)$this->settings['offset'];
		}

		$this->settings['showfollow'] = ( $this->settings['showfollow'] == 'on' || $this->settings['showfollow'] == 'true' || $this->settings['showfollow'] == true ) && $this->settings['showfollow'] !== 'false';

		$this->settings['gdpr'] = isset( $db['gdpr'] ) ? $db['gdpr'] : 'auto';
		$this->settings = apply_filters( 'sbi_feed_settings', $this->settings, $this->connected_accounts );

		if ( SB_Instagram_GDPR_Integrations::doing_gdpr( $this->settings ) ) {
			SB_Instagram_GDPR_Integrations::init();
		}

		if ( $this->settings['feedid'] === 'false' ) {
			$this->settings['feedid'] = false;
		}

		// flag moderation mode and shoppable mode
		$this->settings['moderation_shoppable'] = ! empty( $_POST['moderationShoppableMode'] );
	}

	/**
	 * Backwards compatibility for shortcode arguments and feeds
	 *
	 * @param array $atts
	 * @param array $db
	 *
	 * @return array
	 * @since 6.0
	 */
	public static function get_settings_by_legacy_shortcode( $atts, $db ) {
		//Create the includes string to set as shortcode default
		$hover_include_string = '';
		if( isset($db[ 'sbi_hover_inc_username' ]) ){
			($db[ 'sbi_hover_inc_username' ] && $db[ 'sbi_hover_inc_username' ] !== '') ? $hover_include_string .= 'username,' : $hover_include_string .= '';
		}
		//If the username option doesn't exist in the database yet (eg: on plugin update) then set it to be displayed
		if ( !array_key_exists( 'sbi_hover_inc_username', $db ) ) $hover_include_string .= 'username,';

		if( isset($db[ 'sbi_hover_inc_icon' ]) ){
			($db[ 'sbi_hover_inc_icon' ] && $db[ 'sbi_hover_inc_icon' ] !== '') ? $hover_include_string .= 'icon,' : $hover_include_string .= '';
		}
		if ( !array_key_exists( 'sbi_hover_inc_icon', $db ) ) $hover_include_string .= 'icon,';

		if( isset($db[ 'sbi_hover_inc_date' ]) ){
			($db[ 'sbi_hover_inc_date' ] && $db[ 'sbi_hover_inc_date' ] !== '') ? $hover_include_string .= 'date,' : $hover_include_string .= '';
		}
		if ( !array_key_exists( 'sbi_hover_inc_date', $db ) ) $hover_include_string .= 'date,';

		if( isset($db[ 'sbi_hover_inc_instagram' ]) ){
			($db[ 'sbi_hover_inc_instagram' ] && $db[ 'sbi_hover_inc_instagram' ] !== '') ? $hover_include_string .= 'instagram,' : $hover_include_string .= '';
		}
		if ( !array_key_exists( 'sbi_hover_inc_instagram', $db ) ) $hover_include_string .= 'instagram,';

		if( isset($db[ 'sbi_hover_inc_location' ]) ){
			($db[ 'sbi_hover_inc_location' ] && $db[ 'sbi_hover_inc_location' ] !== '') ? $hover_include_string .= 'location,' : $hover_include_string .= '';
		}
		if( isset($db[ 'sbi_hover_inc_caption' ]) ){
			($db[ 'sbi_hover_inc_caption' ] && $db[ 'sbi_hover_inc_caption' ] !== '') ? $hover_include_string .= 'caption,' : $hover_include_string .= '';
		}
		if( isset($db[ 'sbi_hover_inc_likes' ]) ){
			($db[ 'sbi_hover_inc_likes' ] && $db[ 'sbi_hover_inc_likes' ] !== '') ? $hover_include_string .= 'likes,' : $hover_include_string .= '';
		}
		if ( isset( $db[ 'sb_instagram_incex_one_all' ] ) ) {
			if ( $db[ 'sb_instagram_incex_one_all' ]  == 'one' ) {
				$db[ 'sb_instagram_include_words' ] = '';
				$db[ 'sb_instagram_exclude_words' ] = '';
			}
		}

		$settings = shortcode_atts(
			array(
				//TESTV6
				'customizer' => isset($db[ 'customizer' ]) ? $db[ 'customizer' ] : false,

				//Feed general
				'type' => isset($db[ 'sb_instagram_type' ]) ? $db[ 'sb_instagram_type' ] : 'user',
				'order' => isset($db[ 'sb_instagram_order' ]) ? $db[ 'sb_instagram_order' ] : '',
				'id' => isset($db[ 'sb_instagram_user_id' ]) ? $db[ 'sb_instagram_user_id' ] : '',
				'hashtag' => isset($db[ 'sb_instagram_hashtag' ]) ? $db[ 'sb_instagram_hashtag' ] : '',
				'tagged' => isset($db[ 'sb_instagram_tagged_ids' ]) ? $db[ 'sb_instagram_tagged_ids' ] : '',
				'location' => isset($db[ 'sb_instagram_location' ]) ? $db[ 'sb_instagram_location' ] : '',
				'coordinates' => isset($db[ 'sb_instagram_coordinates' ]) ? $db[ 'sb_instagram_coordinates' ] : '',
				'single' => '',
				'width' => isset($db[ 'sb_instagram_width' ]) ? $db[ 'sb_instagram_width' ] : '',
				'widthunit' => isset($db[ 'sb_instagram_width_unit' ]) ? $db[ 'sb_instagram_width_unit' ] : '',
				'widthresp' => isset($db[ 'sb_instagram_feed_width_resp' ]) ? $db[ 'sb_instagram_feed_width_resp' ] : '',
				'height' => isset($db[ 'sb_instagram_height' ]) ? $db[ 'sb_instagram_height' ] : '',
				'heightunit' => isset($db[ 'sb_instagram_height_unit' ]) ? $db[ 'sb_instagram_height_unit' ] : 'px',
				'sortby' => isset($db[ 'sb_instagram_sort' ]) ? $db[ 'sb_instagram_sort' ] : '',
				'disablelightbox' => isset($db[ 'sb_instagram_disable_lightbox' ]) ? $db[ 'sb_instagram_disable_lightbox' ] : '',
				'captionlinks' => isset($db[ 'sb_instagram_captionlinks' ]) ? $db[ 'sb_instagram_captionlinks' ] : '',
				'offset' => isset($db[ 'sb_instagram_offset' ]) ? $db[ 'sb_instagram_offset' ] : '',
				'num' => isset($db[ 'sb_instagram_num' ]) ? $db[ 'sb_instagram_num' ] : '',
				'apinum'           => isset( $db['sb_instagram_minnum'] ) ? $db['sb_instagram_minnum'] : '',
				'nummobile' => isset($db[ 'sb_instagram_nummobile' ]) ? $db[ 'sb_instagram_nummobile' ] : '',
				'cols' => isset($db[ 'sb_instagram_cols' ]) ? $db[ 'sb_instagram_cols' ] : '',
				'colsmobile' => isset($db[ 'sb_instagram_colsmobile' ]) ? $db[ 'sb_instagram_colsmobile' ] : '',
				'colstablet' => 2,
				'disablemobile' => isset($db[ 'sb_instagram_disable_mobile' ]) ? $db[ 'sb_instagram_disable_mobile' ] : '',
				'imagepadding' => isset($db[ 'sb_instagram_image_padding' ]) ? $db[ 'sb_instagram_image_padding' ] : '',
				'imagepaddingunit' => isset($db[ 'sb_instagram_image_padding_unit' ]) ? $db[ 'sb_instagram_image_padding_unit' ] : '',
				'layout' => isset($db[ 'sb_instagram_layout_type' ]) ? $db[ 'sb_instagram_layout_type' ] : 'grid',

				//Lightbox comments
				'lightboxcomments' => isset($db[ 'sb_instagram_lightbox_comments' ]) ? $db[ 'sb_instagram_lightbox_comments' ] : '',
				'numcomments' => isset($db[ 'sb_instagram_num_comments' ]) ? $db[ 'sb_instagram_num_comments' ] : '',

				//Photo hover styles
				'hovereffect' => isset($db[ 'sb_instagram_hover_effect' ]) ? $db[ 'sb_instagram_hover_effect' ] : '',
				'hovercolor' => isset($db[ 'sb_hover_background' ]) ? $db[ 'sb_hover_background' ] : '',
				'hovertextcolor' => isset($db[ 'sb_hover_text' ]) ? $db[ 'sb_hover_text' ] : '',
				'hoverdisplay' => $hover_include_string,

				//Item misc
				'background' => isset($db[ 'sb_instagram_background' ]) ? $db[ 'sb_instagram_background' ] : '',
				'imageres' => isset($db[ 'sb_instagram_image_res' ]) ? $db[ 'sb_instagram_image_res' ] : '',
				'media' => isset($db[ 'sb_instagram_media_type' ]) ? $db[ 'sb_instagram_media_type' ] : '',
				'videotypes' => isset($db[ 'videotypes' ]) ? $db[ 'videotypes' ] : 'regular,reels',
				'showcaption' => isset($db[ 'sb_instagram_show_caption' ]) ? $db[ 'sb_instagram_show_caption' ] : true,
				'captionlength' => isset($db[ 'sb_instagram_caption_length' ]) ? $db[ 'sb_instagram_caption_length' ] : '',
				'captioncolor' => isset($db[ 'sb_instagram_caption_color' ]) ? $db[ 'sb_instagram_caption_color' ] : '',
				'captionsize' => isset($db[ 'sb_instagram_caption_size' ]) ? $db[ 'sb_instagram_caption_size' ] : '',
				'showlikes' => isset($db[ 'sb_instagram_show_meta' ]) ? $db[ 'sb_instagram_show_meta' ] : true,
				'likescolor' => isset($db[ 'sb_instagram_meta_color' ]) ? $db[ 'sb_instagram_meta_color' ] : '',
				'likessize' => isset($db[ 'sb_instagram_meta_size' ]) ? $db[ 'sb_instagram_meta_size' ] : '',
				'hidephotos' => isset($db[ 'sb_instagram_hide_photos' ]) ? $db[ 'sb_instagram_hide_photos' ] : '',

				//Footer
				'showbutton' => isset($db[ 'sb_instagram_show_btn' ]) ? $db[ 'sb_instagram_show_btn' ] : '',
				'buttoncolor' => isset($db[ 'sb_instagram_btn_background' ]) ? $db[ 'sb_instagram_btn_background' ] : '',
				'buttontextcolor' => isset($db[ 'sb_instagram_btn_text_color' ]) ? $db[ 'sb_instagram_btn_text_color' ] : '',
				'buttontext' => isset($db[ 'sb_instagram_btn_text' ]) ? stripslashes( esc_attr( $db[ 'sb_instagram_btn_text' ] ) ) : '',
				'showfollow' => isset($db[ 'sb_instagram_show_follow_btn' ]) ? $db[ 'sb_instagram_show_follow_btn' ] : '',
				'followcolor' => isset($db[ 'sb_instagram_folow_btn_background' ]) ? $db[ 'sb_instagram_folow_btn_background' ] : '',
				'followtextcolor' => isset($db[ 'sb_instagram_follow_btn_text_color' ]) ? $db[ 'sb_instagram_follow_btn_text_color' ] : '',
				'followtext' => isset($db[ 'sb_instagram_follow_btn_text' ]) ? stripslashes( esc_attr( $db[ 'sb_instagram_follow_btn_text' ] ) ) : '',

				//Header
				'showheader' => isset($db[ 'sb_instagram_show_header' ]) ? $db[ 'sb_instagram_show_header' ] : '',
				'headercolor' => isset($db[ 'sb_instagram_header_color' ]) ? $db[ 'sb_instagram_header_color' ] : '',
				'headerstyle' => isset($db[ 'sb_instagram_header_style' ]) ? $db[ 'sb_instagram_header_style' ] : '',
				'showfollowers' => isset($db[ 'sb_instagram_show_followers' ]) ? $db[ 'sb_instagram_show_followers' ] : true,
				'showbio' => isset($db[ 'sb_instagram_show_bio' ]) ? $db[ 'sb_instagram_show_bio' ] : true,
				'custombio' => isset($db[ 'sb_instagram_custom_bio' ]) ? $db[ 'sb_instagram_custom_bio' ] : '',
				'customavatar' => isset($db[ 'sb_instagram_custom_avatar' ]) ? $db[ 'sb_instagram_custom_avatar' ] : '',
				'headerprimarycolor' => isset($db[ 'sb_instagram_header_primary_color' ]) ? $db[ 'sb_instagram_header_primary_color' ] : '',
				'headersecondarycolor' => isset($db[ 'sb_instagram_header_secondary_color' ]) ? $db[ 'sb_instagram_header_secondary_color' ] : '',
				'headersize' => isset($db[ 'sb_instagram_header_size' ]) ? $db[ 'sb_instagram_header_size' ] : '',
				'stories' => isset($db[ 'sb_instagram_stories' ]) ? $db[ 'sb_instagram_stories' ] : true,
				'storiestime' => isset($db[ 'sb_instagram_stories_time' ]) ? $db[ 'sb_instagram_stories_time' ] : '',
				'headeroutside' => isset($db[ 'sb_instagram_outside_scrollable' ]) ? $db[ 'sb_instagram_outside_scrollable' ] : '',
				'headersource' => '',

				'class' => '',
				'ajaxtheme' => isset($db[ 'sb_instagram_ajax_theme' ]) ? $db[ 'sb_instagram_ajax_theme' ] : '',
				'cachetime' => isset($db[ 'sb_instagram_cache_time' ]) ? $db[ 'sb_instagram_cache_time' ] : '',
				'blockusers' => isset($db[ 'sb_instagram_block_users' ]) ? $db[ 'sb_instagram_block_users' ] : '',
				'showusers' => isset($db[ 'sb_instagram_show_users' ]) ? $db[ 'sb_instagram_show_users' ] : '',
				'excludewords' => isset($db[ 'sb_instagram_exclude_words' ]) ? $db[ 'sb_instagram_exclude_words' ] : '',
				'includewords' => isset($db[ 'sb_instagram_include_words' ]) ? $db[ 'sb_instagram_include_words' ] : '',
				'maxrequests' => isset($db[ 'sb_instagram_requests_max' ]) ? $db[ 'sb_instagram_requests_max' ] : '',

				//Carousel
				'carousel' => isset($db[ 'sb_instagram_carousel' ]) ? $db[ 'sb_instagram_carousel' ] : '',
				'carouselrows' => isset($db[ 'sb_instagram_carousel_rows' ]) ? $db[ 'sb_instagram_carousel_rows' ] : '',
				'carouselloop' => isset($db[ 'sb_instagram_carousel_loop' ]) ? $db[ 'sb_instagram_carousel_loop' ] : '',
				'carouselarrows' => isset($db[ 'sb_instagram_carousel_arrows' ]) ? $db[ 'sb_instagram_carousel_arrows' ] : '',
				'carouselpag' => isset($db[ 'sb_instagram_carousel_pag' ]) ? $db[ 'sb_instagram_carousel_pag' ] : '',
				'carouselautoplay' => isset($db[ 'sb_instagram_carousel_autoplay' ]) ? $db[ 'sb_instagram_carousel_autoplay' ] : '',
				'carouseltime' => isset($db[ 'sb_instagram_carousel_interval' ]) ? $db[ 'sb_instagram_carousel_interval' ] : '',

				//Highlight
				'highlighttype' => isset($db[ 'sb_instagram_highlight_type' ]) ? $db[ 'sb_instagram_highlight_type' ] : '',
				'highlightoffset' => isset($db[ 'sb_instagram_highlight_offset' ]) ? $db[ 'sb_instagram_highlight_offset' ] : '',
				'highlightpattern' => isset($db[ 'sb_instagram_highlight_factor' ]) ? $db[ 'sb_instagram_highlight_factor' ] : '',
				'highlighthashtag' => isset($db[ 'sb_instagram_highlight_hashtag' ]) ? $db[ 'sb_instagram_highlight_hashtag' ] : '',
				'highlightids' => isset($db[ 'sb_instagram_highlight_ids' ]) ? $db[ 'sb_instagram_highlight_ids' ] : '',

				//WhiteList
				'whitelist' => '',

				//Load More on Scroll
				'autoscroll' => isset($db[ 'sb_instagram_autoscroll' ]) ? $db[ 'sb_instagram_autoscroll' ] : '',
				'autoscrolldistance' => isset($db[ 'sb_instagram_autoscrolldistance' ]) ? $db[ 'sb_instagram_autoscrolldistance' ] : '',

				//Moderation Mode
				'moderationmode' => isset($db[ 'sb_instagram_moderation_mode' ]) ? $db[ 'sb_instagram_moderation_mode' ] === 'visual' : '',

				//Permanent
				'permanent' => isset($db[ 'sb_instagram_permanent' ]) ? $db[ 'sb_instagram_permanent' ] : false,
				'accesstoken' => '',
				'user' => isset($db[ 'sb_instagram_user_id' ]) ? $db[ 'sb_instagram_user_id' ] : false,

				//Misc
				'feedid' => isset($db[ 'sb_instagram_feed_id' ]) ? $db[ 'sb_instagram_feed_id' ] : false,

				'resizeprocess'    => isset( $db['sb_instagram_resizeprocess'] ) ? $db['sb_instagram_resizeprocess'] : 'background',
				'mediavine'    => isset( $db['sb_instagram_media_vine'] ) ? $db['sb_instagram_media_vine'] : '',
				'customtemplates'    => isset( $db['custom_template'] ) ? $db['custom_template'] : '',
				'gdpr'    => isset( $db['gdpr'] ) ? $db['gdpr'] : 'auto',

			), $atts );

		$settings['sources'] = is_string( $settings['id'] ) ? explode( ',', str_replace( ' ', '', $settings['id'] ) ) : array();

		return $settings;
	}

	/**
	 * Converts settings from the builder to settings used in the feed
	 *
	 * @param $settings
	 * @param $atts
	 *
	 * @return mixed
	 * @since 6.0
	 */
	public function filter_for_builder( $settings, $atts ) {

		if ( ! empty( $settings['shoppablefeed'] )
			&& $settings['shoppablefeed'] !== 'false'
			&& ! empty( $settings['shoppablefeed'] ) ) {
			$settings['captionlinks'] = true;

			if ( ! is_array( $settings['shoppablelist'] ) ) {
				$settings['shoppablelist'] = json_decode( $settings['shoppablelist'], true ) ? json_decode( $settings['shoppablelist'], true ) : array();
			}
		}

		if ( ! isset( $atts['media'] ) ) {
			$include_photos = $settings['media'] !== 'videos';
			if ( isset( $settings['photosposts'] ) ) {
				$include_photos = $settings['photosposts'] !== 'false' && ! empty( $settings['photosposts'] );
			}

			if ( isset( $settings['videosposts'] ) && $settings['videosposts'] ) {
				$include_videos = true;
			} else {
				$include_videos = $settings['media'] === 'all' || $settings['media'] === 'videos' ? true : false;
			}
			if ( isset( $settings['videosposts'] ) ) {
				$include_videos = $settings['videosposts'] !== 'false' && ! empty( $settings['videosposts'] );
			}

			if ( isset( $settings['reelsposts'] ) ) {
				$include_reels = $settings['reelsposts'] !== 'false' && ! empty( $settings['reelsposts'] ) ? true : false;
			} else {
				$include_reels = ($settings['media'] === 'all' || $include_videos) !== false ? true : false;
				if ( $include_reels ) {
					$settings['reelsposts'] = true;
				} else {
					$settings['reelsposts'] = false;
				}
			}

			if ( $include_photos && $include_videos && $include_reels ) {
				$settings['media'] = 'all';
			} elseif( $include_photos && ( $include_videos || $include_reels ) ) {
				$settings['media'] = array( 'photos', 'videos' );
			} elseif ( $include_videos || $include_reels ) {
				$settings['media'] = 'videos';
			} else {
				$settings['media'] = 'photos';
			}
		} else {
			$include_reels = $settings['media'] === 'all' || $settings['media'] === 'videos' && strpos( $settings['videotypes'], 'reels' ) !== false;
			$include_videos = $settings['media'] === 'all' || $settings['media'] === 'videos' && strpos( $settings['videotypes'], 'regular' ) !== false;
		}

		if ( ! isset( $atts['videotypes'] ) ) {

			$video_types = array();
			if ( $include_reels ) {
				$video_types[] = 'reels';
			}
			if ( $include_videos ) {
				$video_types[] = 'regular';
			}
			$settings['videotypes'] = implode( ',', $video_types );
		}

		if ( ! empty( $settings['enablemoderationmode'] )
			&& $settings['enablemoderationmode'] !== 'false' &&
	        ! empty( $settings['moderationlist'] ) ) {
			$moderation_list = json_decode( $settings['moderationlist'], true );

			if ( $moderation_list ) {
				$settings['feed_is_moderated'] = true;

				$settings['block_list'] = array();
				if ( ! empty( $settings['customBlockModerationlist'] ) ) {
					$custom_block_list = explode( ',', str_replace( ' ', '', $settings['customBlockModerationlist'] ) );
					$settings['block_list'] = $custom_block_list;
				}
				$settings['whitelist'] = 'builder';
				$settings['hidephotos'] = 'builder';
				if ( $moderation_list['list_type_selected'] === 'allow' ) {
					$settings['allow_list'] = ! empty( $moderation_list['allow_list'] ) ? $moderation_list['allow_list'] : array();
					$settings['apinum'] = ! empty( $settings['apinum'] ) ? max( intval( $settings['apinum'] ), 20 ) : 20;
				} else {
					$settings['block_list'] = ! empty( $moderation_list['block_list'] ) ? array_merge( $settings['block_list'], $moderation_list['block_list'] ) : $settings['block_list'];
				}
			}

		}

		if ( isset( $atts['ajaxtheme'] ) ) {
			$settings['ajaxtheme'] = $atts['ajaxtheme'] === 'true';
		} else {
			$db = sbi_get_database_settings();
			$settings['ajaxtheme'] = isset( $db['sb_instagram_ajax_theme'] ) ? $db['sb_instagram_ajax_theme'] === '1' || $db['sb_instagram_ajax_theme'] === true || $db['sb_instagram_ajax_theme'] === 'on' : false;
		}

		return $settings;
	}

	/**
	 * Disables or enables certain settings when using the
	 * customizer
	 *
	 * @param $settings
	 *
	 * @return mixed
	 * @since 6.0
	 */
	public function filter_for_customizer( $settings ) {

		$settings['customtemplates'] = false;
		$settings['moderationmode'] = false;
		$settings['ajax_post_load'] = false;
		$settings['disable_js_image_loading'] = false;
		$settings['showheader'] = true;

		return $settings;

	}

	/**
	 * Filters out or converts allowed/disallowed shortcode settings
	 *
	 * @param $atts
	 *
	 * @return mixed
	 * @since 6.0
	 */
	public function filter_atts_for_legacy( $atts ) {
		if ( ! empty( $atts['from_update'] ) ) {
			unset( $atts['from_update'] );
			return $atts;
		}
		$sbi_statuses = get_option( 'sbi_statuses', array() );
		$allowed_legacy_shortcode = array(
			'feed',
			'moderationmode',
			'hidephotos',
			'permanent',
			'headersource',
			'customizer',
			'cachetime',
			'class',
			'mediavine'
		);

		if ( ! empty( $sbi_statuses['support_legacy_shortcode'] )
			&& empty( $atts['feed'] ) ) {

			if ( is_array( $sbi_statuses['support_legacy_shortcode'] ) ) {
				$atts_diff = array_diff( $sbi_statuses['support_legacy_shortcode'], $atts ); // determines if the shortcode settings match the shortcode settings of an existing feed

				foreach ( $atts_diff as $key => $value ) {
					if ( in_array( $key, $allowed_legacy_shortcode ) ) {
						unset( $atts_diff[ $key ] );
					}
				}
				if ( empty( $atts_diff ) ) {
					$atts['feed'] = 1;
				}
			}

			if ( empty( $atts['feed'] ) ) {
				return $atts;
			}
		}


		foreach ( $atts as $key => $value ) {
			if ( ! in_array( $key, $allowed_legacy_shortcode ) ) {
				unset( $atts[ $key ] );
			}

		}

		return $atts;

	}

	/**
	 * Converts legacy feed settings to work with new settings
	 *
	 * @param $settings
	 * @param $atts
	 *
	 * @return mixed
	 * @since 6.0
	 */
	public function filter_for_legacy( $settings, $atts  ) {
		$sbi_statuses = get_option( 'sbi_statuses', array() );

		if ( empty( $sbi_statuses['support_legacy_shortcode'] ) ) {
			return $settings;
		}

		if ( isset( $atts['whitelist'] ) ) {
			$settings['whitelist'] = $atts['whitelist'];
			$settings['feed_is_moderated'] = true;
			$feed_is_permanent = isset( $atts['permanent'] ) ? ($atts['permanent'] === 'true') : false;
			$white_list_is_permanent = false;
			$permanent_white_lists = get_option( 'sb_permanent_white_lists', array() );
			if ( in_array( $settings['whitelist'], $permanent_white_lists, true ) ) {
				$white_list_is_permanent = true;
			}

			$settings['whitelist_ids'] = get_option( 'sb_instagram_white_lists_'.$settings['whitelist'], array() );
			$settings['whitelist_num'] = count( $settings['whitelist_ids'] );

			if ( $feed_is_permanent || $white_list_is_permanent ) {
				$settings['backup_cache_enabled'] = true;
				$settings['alwaysUseBackup'] = true;
				$settings['caching_type'] = 'permanent';
			}
		}


		return $settings;

	}

	/**
	 * Sets the feed ID used to identify which posts to retrieve from the
	 * database among other important features. Uses a combination of the
	 * feed type, feed display settings, moderation settings, number
	 * settings, and post order. Can be set manually if two similar feeds
	 * share the same name and are causing conflicts.
	 *
	 * Pro - More factors used to create name (see above)
	 *
	 * @param string $transient_name
	 *
	 * @since 5.0
	 * @since 5.2 support for db query feed id setting, tagged
	 */
	public function set_transient_name( $transient_name = '' ) {

		if ( ! empty( $transient_name ) ) {
			$this->transient_name = $transient_name;
		} elseif ( ! empty( $this->settings['feed'] ) && $this->settings['feed'] !== 'legacy' && intval( $this->settings['feed'] ) > 0 ) {
			$this->transient_name = '*' . $this->settings['feed'];
		} elseif ( ! empty( $this->settings['feedid'] ) ) {
			$this->transient_name = 'sbi_' . $this->settings['feedid'];
		} else {
			$feed_type_and_terms = $this->feed_type_and_terms;

			$sb_instagram_include_words = $this->settings['includewords'];
			$sb_instagram_exclude_words = $this->settings['excludewords'];
			$sbi_cache_string_include = '';
			$sbi_cache_string_exclude = '';

			//Convert include words array into a string consisting of 3 chars each
			if ( ! empty( $sb_instagram_include_words ) ) {
				$sb_instagram_include_words_arr = explode(',', $sb_instagram_include_words);

				foreach( $sb_instagram_include_words_arr as $sbi_word ){
					$sbi_include_word = str_replace( str_split(' #'), '', $sbi_word );
					$sbi_cache_string_include .= substr( str_replace('%','', urlencode( $sbi_include_word ) ), 0, 3 );
				}

			}

			//Convert exclude words array into a string consisting of 3 chars each
			if ( ! empty( $sb_instagram_exclude_words ) ) {
				$sb_instagram_exclude_words_arr = explode( ',', $sb_instagram_exclude_words );

				foreach( $sb_instagram_exclude_words_arr as $sbi_word ){
					$sbi_exclude_word = str_replace( str_split( ' #' ) , '', $sbi_word );
					$sbi_cache_string_exclude .= substr( str_replace( '%','', urlencode( $sbi_exclude_word ) ), 0, 3 );
				}

			}

			//Figure out how long the first part of the caching string should be
			$sbi_cache_string_include_length = strlen( $sbi_cache_string_include );
			$sbi_cache_string_exclude_length = strlen( $sbi_cache_string_exclude );
			$sbi_cache_string_length = 40 - min( $sbi_cache_string_include_length + $sbi_cache_string_exclude_length, 20 );

			isset( $this->settings[ 'whitelist' ] ) ? $sb_instagram_white_list = trim( $this->settings['whitelist'] ) : $sb_instagram_white_list = '';
			$sbi_transient_name = 'sbi_';
			$sbi_transient_name .= substr( $sb_instagram_white_list, 0, 3 );
			if ( is_array( $this->settings['media'] ) ){
				$string_media_setting = implode( '', $this->settings['media'] );
			} else {
				$string_media_setting = (string) $this->settings['media'];
			}
			if ( $string_media_setting !== 'all' ) {
				$sbi_transient_name .= substr( $string_media_setting, 0, 1 );
				if ( $this->settings['media'] === 'videos' ) {
					$video_types = ! empty( $this->settings['videotypes'] ) ? explode( ',', str_replace( ' ', '', strtolower( $this->settings['videotypes'] ) ) ) : array( 'igtv', 'regular', 'reels' );
					if ( ! in_array( 'reels', $video_types ) ) {
						$sbi_transient_name .= 'e';
					} elseif ( ! in_array( 'regular', $video_types ) ) {
						$sbi_transient_name .= 'r';
					}
				}

			}

			if ( $this->settings['sortby'] === 'likes' ) {
				$sbi_transient_name .= 'lsrt';
			}
			if ( $this->settings['sortby'] === 'random' ) {
				$sbi_transient_name .= 'rdm';
			}

			if ( isset( $feed_type_and_terms['users'] ) ) {
				foreach ( $feed_type_and_terms['users'] as $term_and_params ) {
					$user = $term_and_params['term'];
					$connected_account = isset( $this->connected_accounts_in_feed[ $user ] ) ? $this->connected_accounts_in_feed[ $user ] : $user;
					if ( isset( $connected_account['type'] ) && $connected_account['type'] === 'business' ) {
						$sbi_transient_name .= $connected_account['username'];
					} else {
						$sbi_transient_name .= $user;
					}
				}
			}

			if ( isset( $feed_type_and_terms['hashtags_top'] ) || isset( $feed_type_and_terms['hashtags_recent'] ) ) {
				if ( isset( $feed_type_and_terms['hashtags_recent'] ) ) {
					$terms_params = $feed_type_and_terms['hashtags_recent'];
				} else {
					$terms_params = $feed_type_and_terms['hashtags_top'];
					$sbi_transient_name .= '+';
				}

				foreach ( $terms_params as $term_and_params ) {
					$hashtag = $term_and_params['hashtag_name'];
					$full_tag = str_replace('%','',urlencode( $hashtag ));
					$max_length = strlen( $full_tag ) < 20 ? strlen( $full_tag ) : 20;
					$sbi_transient_name .= strtoupper( substr( $full_tag, 0, $max_length ) );
				}
			}

			if ( isset( $feed_type_and_terms['tagged'] ) ) {
				$sbi_transient_name .= SBI_TAGGED_PREFIX;

				foreach ( $feed_type_and_terms['tagged'] as $term_and_params ) {
					$user = $term_and_params['term'];
					$connected_account = isset( $this->connected_accounts_in_feed[ $user ] ) ? $this->connected_accounts_in_feed[ $user ] : $user;
					if ( isset( $connected_account['type'] ) && $connected_account['type'] === 'business' ) {
						$sbi_transient_name .= $connected_account['username'];
					} else {
						$sbi_transient_name .= $user;
					}
				}
			}

			$num = $this->settings['num'];

			if ( (int)$this->settings['offset'] > 0 ) {
				$num = $num . 'o' . (int)$this->settings['offset'];
			}

			$num_length = strlen( $num ) + 1;

			// add filter prefix and suffixes substr( $sb_instagram_white_list, 0, 3 )

			//Add both parts of the caching string together and make sure it doesn't exceed 45
			$this->settings['db_query_feed_id'] = substr( $sbi_transient_name, 0, $sbi_cache_string_length ) . $sbi_cache_string_include . $sbi_cache_string_exclude;

			$sbi_transient_name = substr( $sbi_transient_name, 0, $sbi_cache_string_length - $num_length ) . $sbi_cache_string_include . $sbi_cache_string_exclude;

			if ( isset( $feed_type_and_terms['hashtags_recent'] ) && isset( $this->settings['cache_all'] ) && $this->settings['cache_all'] ) {
				$existing_posts = SB_Instagram_Feed_Pro::get_post_set_from_db( $sbi_transient_name, 0, time(), 1 );
				if ( isset( $existing_posts[0] ) ) {
					if ( isset( $feed_type_and_terms['hashtags_top'] ) ) {
						unset( $feed_type_and_terms['hashtags_top'] );
						$this->feed_type_and_terms = $feed_type_and_terms;
					}
				}

			}

			if ( ! isset( $this->settings['doingModerationMode'] ) ) {
				$sbi_transient_name .= '#' . $num;
			}

			$this->transient_name = $sbi_transient_name;
		}

	}

	/**
	 * @param array $connected_accounts
	 */
	private function add_connected_accounts_in_feed( $connected_accounts ) {
		foreach ( $connected_accounts as $key => $connected_account ) {
			$this->connected_accounts_in_feed[ $key ] = $connected_account;
		}
	}

	/**
	 * @param array $feed_type_and_terms
	 */
	private function add_feed_type_and_terms( $feed_type_and_terms ) {
		$this->feed_type_and_terms = array_merge( $this->feed_type_and_terms, $feed_type_and_terms );
	}

	/**
	 * @param array|bool $users
	 */
	private function set_user_feed( $users = false ) {
		global $sb_instagram_posts_manager;

		if ( ! $users ) {
			$set = false;
			foreach ( $this->connected_accounts as $connected_account ) {
				if ( ! $set ) {
					$set = true;
					$this->settings['user'] = $connected_account['username'];
					$this->connected_accounts_in_feed = array( $connected_account['user_id'] => $connected_account );
					$feed_type_and_terms = array(
						'users'=> array(
							array(
								'term' => $connected_account['user_id'],
								'params' => array()
							)
						)
					);
					if ( $sb_instagram_posts_manager->are_current_api_request_delays( $connected_account ) ) {
						$feed_type_and_terms['users'][0]['error'] = true;
					}
					$this->feed_type_and_terms = $feed_type_and_terms;
				}
			}
			return;
		} else {
			$connected_accounts_in_feed = array();
			$feed_type_and_terms = array(
				'users' => array()
			);
			$usernames_included = array();
			$usernames_not_connected = array();


			foreach ( $users as $user_id_or_name ) {
				$connected_account = ! empty( $this->connected_accounts[ $user_id_or_name ] ) ? $this->connected_accounts[ $user_id_or_name ] : SB_Instagram_Connected_Account::lookup( $user_id_or_name );

				if ( $connected_account ) {
					if ( ! in_array( $connected_account['username'], $usernames_included, true ) ) {
						if ( ! $sb_instagram_posts_manager->are_current_api_request_delays( $connected_account ) ) {
							$feed_type_and_terms['users'][] = array(
								'term'   => $connected_account['user_id'],
								'params' => array()
							);
						} else {
							$feed_type_and_terms['users'][] = array(
								'term'   => $connected_account['user_id'],
								'params' => array(),
								'error' => true
							);
						}
						$connected_accounts_in_feed[ $connected_account['user_id'] ] = $connected_account;
						$usernames_included[] = $connected_account['username'];
					}
				} else {
					$feed_type_and_terms['users'][] = array(
						'term'   => $user_id_or_name,
						'params' => array(),
						'error' => true
					);
					$usernames_not_connected[] = $user_id_or_name;
				}

			}

			if ( ! empty( $usernames_not_connected ) ) {
				global $sb_instagram_posts_manager;
				if ( count( $usernames_not_connected ) === 1 ) {
					$user = $usernames_not_connected[0];
				} else {
					$user = implode( ', ', $usernames_not_connected );
				}

				$settings_link = '<a href="'.get_admin_url().'admin.php?page=sbi-settings" target="_blank">' . __( 'plugin Settings page', 'instagram-feed' ) . '</a>';

				$error_message_return = array(
					'error_message' => sprintf( __( 'Error: There is no connected account for the user %s.', 'instagram-feed' ), $user ),
					'admin_only' => sprintf( __( 'A connected account related to the user is required to display user feeds. Please connect an account for this user on the %s.', 'instagram-feed' ), $settings_link ),
					'frontend_directions' => '',
					'backend_directions' => ''
				);
				$sb_instagram_posts_manager->maybe_set_display_error( 'configuration', $error_message_return );
			}

			$this->add_feed_type_and_terms( $feed_type_and_terms );

			$this->add_connected_accounts_in_feed( $connected_accounts_in_feed );

		}

	}

	/**
	 * @param array $hashtags
	 */
	private function set_hashtag_feed( $hashtags ) {
		global $sb_instagram_posts_manager;

		$hashtag_order_suffix = $this->settings['order'] === 'recent' ? 'recent' : 'top';
		if ( $this->settings['order'] === 'top' ) {
			$this->settings['sortby'] = 'api';
			$this->settings['apinum'] = empty( $this->settings['moderation_shoppable'] ) ? 50 : 20;
		}
		$connected_accounts_in_feed = array();

		$feed_type_and_terms = array(
			'hashtags_' . $hashtag_order_suffix => array()
		);
		$saved_hashtag_ids = SB_Instagram_Settings_Pro::get_hashtag_ids();

		$connected_business_accounts = SB_Instagram_Connected_Account::lookup( '', 'business' );

		if ( ! empty( $connected_business_accounts[1] ) ) {
			if ( ! empty( $this->atts['user'] ) ) {
				$user_array = is_array( $this->atts['user'] ) ? $this->atts['user'] : explode( ',', str_replace( ' ', '',  $this->atts['user'] ) );
			} elseif ( ! empty( $this->atts['id'] ) ) {
				$user_array = is_array( $this->atts['id'] ) ? $this->atts['id'] : explode( ',', str_replace( ' ', '',  $this->atts['id'] ) );
			}
			$filtered_business_accounts = array();
			if ( ! empty( $user_array ) ) {
				foreach ( $user_array as $user_name ) {
					$maybe_user_business_account = SB_Instagram_Connected_Account::lookup( $user_name );
					if ( $maybe_user_business_account && isset( $maybe_user_business_account['type'] ) && $maybe_user_business_account['type'] === 'business' ) {
						$filtered_business_accounts[] = $maybe_user_business_account;
					}
				}
			}
			if ( ! empty( $filtered_business_accounts ) ) {
				$connected_business_accounts = $filtered_business_accounts;
			}
		}

		if ( empty( $connected_business_accounts ) ) {
			$this->feed_type_and_terms = $feed_type_and_terms;
			$this->connected_accounts_in_feed = array();

			$error_message_return = array(
				'error_message' => __( 'Error: There are no business accounts connected.', 'instagram-feed' ),
				'admin_only' => sprintf( __( 'A business account is required to display hashtag feeds. Please visit %s to learn how to connect a business account.', 'instagram-feed' ), '<a href="https://smashballoon.com/migrate-to-new-instagram-hashtag-api/">' . __( 'this page', 'instagram-feed' ) . '</a>' ),
				'frontend_directions' => '',
				'backend_directions' => ''
			);
			$sb_instagram_posts_manager->maybe_set_display_error( 'configuration', $error_message_return );

			return;
		}

		foreach ( $hashtags as $hashtag ) {
			$hashtag_id = false;
			$error = false;
			$hashtag = str_replace('#', '', $hashtag );
			if ( ! empty( $hashtag ) ) {
				if ( isset( $saved_hashtag_ids[ $hashtag ] ) && isset( $saved_hashtag_ids[ $hashtag ]['connected_account'] ) ) {
					$hashtag_id = isset( $saved_hashtag_ids[ $hashtag ]['id'] ) ? $saved_hashtag_ids[ $hashtag ]['id'] : $saved_hashtag_ids[ $hashtag ];
					$connected_account = isset( $saved_hashtag_ids[ $hashtag ]['connected_account'] ) && ! empty( $saved_hashtag_ids[ $hashtag ]['connected_account'] ) ? $saved_hashtag_ids[ $hashtag ]['connected_account'] : $connected_business_accounts[0];
					$connected_accounts_in_feed[ $hashtag_id ] = $connected_account;
					$feed_type_and_terms[ 'hashtags_' . $hashtag_order_suffix ][] = array(
						'term' => $hashtag_id,
						'params' => array( 'hashtag_id' => $hashtag_id ),
						'hashtag_name' => $hashtag
					);
				} else {
					global $sb_instagram_posts_manager;

					$i = 0;
					$new_hashtag_id = false;
					$hashtag_does_not_exist_error = false;

					while ( isset( $connected_business_accounts[ $i ] ) && ! $new_hashtag_id && ! $hashtag_does_not_exist_error ) {
						$sb_instagram_posts_manager->maybe_remove_display_error( 'hashtag_limit' );
						if ( $sb_instagram_posts_manager->account_over_hashtag_limit( $connected_business_accounts[ $i ] ) ) {
							$error = true;

						} else {
							$error = false;

							if ( ! $sb_instagram_posts_manager->hashtag_has_error( $hashtag ) ) {
								$connected_business_account = $connected_business_accounts[ $i ];
								$new_hashtag_id = SB_Instagram_Settings_Pro::get_remote_hashtag_id_from_hashtag_name( $hashtag, $connected_business_account );

								if ( $new_hashtag_id ) {
									$hashtag_id = $new_hashtag_id;
									$connected_accounts_in_feed[ $new_hashtag_id ] = $connected_business_account;
									$feed_type_and_terms[ 'hashtags_' . $hashtag_order_suffix ][] = array(
										'term' => $new_hashtag_id,
										'params' => array( 'hashtag_id' => $new_hashtag_id ),
										'hashtag_name' => $hashtag
									);
									$new_hashtag_ids = array(
										$hashtag => array(
											'id' => $new_hashtag_id,
											'connected_account' => $connected_business_account
										)
									);
									SB_Instagram_Settings_Pro::update_hashtag_ids( $new_hashtag_ids );

								} elseif( ! $new_hashtag_id && $i === count( $connected_business_accounts ) - 1 ) {
									$feed_type_and_terms[ 'hashtags_' . $hashtag_order_suffix ][] = array(
										'term' => '',
										'params' => array(),
										'hashtag_name' => $hashtag,
										'error' => true
									);
								}
							} else {

								$feed_type_and_terms[ 'hashtags_' . $hashtag_order_suffix ][] = array(
									'term' => '',
									'params' => array(),
									'hashtag_name' => $hashtag,
									'error' => true
								);
							}
						}

						$i++;
					}
				}

				if ( $error ) {
					$feed_type_and_terms[ 'hashtags_' . $hashtag_order_suffix ][] = array(
						'term' => '',
						'params' => array(),
						'hashtag_name' => $hashtag,
						'error' => true
					);
				}

				if ( $hashtag_id ) {
					if ( $hashtag_order_suffix === 'recent'
					     && ! SB_Instagram_Posts_Manager::top_post_request_already_made( $hashtag ) ) {
						$this->settings['cache_all'] = true;
						$feed_type_and_terms['hashtags_top'][] = array(
							'term' => $hashtag_id,
							'params' => array( 'hashtag_id' => $hashtag_id ),
							'hashtag_name' => $hashtag,
							'one_time_request' => true
						);
					}
				}

				foreach ( $feed_type_and_terms[ 'hashtags_' . $hashtag_order_suffix ] as $key => $hashtag_terms ) {
					$term = $hashtag_terms['term'];

					if ( ! empty( $term ) && $sb_instagram_posts_manager->are_current_api_request_delays( $connected_accounts_in_feed[ $term ] ) ) {
						$feed_type_and_terms[ 'hashtags_' . $hashtag_order_suffix ][ $key ]['error'] = true;
					}
				}
			}

		}

		$this->add_feed_type_and_terms( $feed_type_and_terms );

		$this->add_connected_accounts_in_feed( $connected_accounts_in_feed );
	}

	/**
	 * @param array $tagged
	 */
	private function set_tagged_feed( $tagged ) {
		global $sb_instagram_posts_manager;

		$feed_type_and_terms['tagged'] = array();
		$connected_accounts_in_feed = array();

		if ( ! empty( $tagged ) ) {
			$users = is_array( $tagged ) ? $tagged : explode( ',', str_replace( ' ', '',  $tagged ) );
			$usernames_included = array();
			$usernames_not_connected = array();

			foreach ( $users as $user_id_or_name ) {
				$connected_account = ! empty( $this->connected_accounts[ $user_id_or_name ] ) ? $this->connected_accounts[ $user_id_or_name ] : SB_Instagram_Connected_Account::lookup( $user_id_or_name );
				$valid_for_tagged = $connected_account && isset( $connected_account['type'] ) && $connected_account['type'] === 'business';
				if ( $valid_for_tagged ) {
					if ( ! $sb_instagram_posts_manager->are_current_api_request_delays( $connected_account ) ) {
						if ( ! in_array( $connected_account['username'], $usernames_included, true ) ) {
							$feed_type_and_terms['tagged'][]                             = array(
								'term'   => $connected_account['user_id'],
								'params' => array()
							);
							$connected_accounts_in_feed[ $connected_account['user_id'] ] = $connected_account;
							$usernames_included[]                                        = $connected_account['username'];
						}
					} else {
						$feed_type_and_terms['tagged'][] = array(
							'term'   => $user_id_or_name,
							'params' => array(),
							'error' => true
						);
						$connected_accounts_in_feed[ $connected_account['user_id'] ] = $connected_account;
						$usernames_included[]                                        = $connected_account['username'];
					}
				} else {
					$feed_type_and_terms['tagged'][] = array(
						'term'   => $user_id_or_name,
						'params' => array(),
						'error' => true
					);
					$usernames_not_connected[] = $user_id_or_name;
				}

			}

		}

		if ( ! empty( $usernames_not_connected ) ) {
			global $sb_instagram_posts_manager;
			if ( count( $usernames_not_connected ) === 1 ) {
				$user = $usernames_not_connected[0];
			} else {
				$user = implode( ', ', $usernames_not_connected );
			}
/*
			$error_message_return = array(
				'error_message' => sprintf( __( 'Error: There is no connected business account for the user %s.', 'instagram-feed' ), $user ),
				'admin_only' => sprintf( __( 'A connected business account related to the tagged Instagram account is required to display tagged feeds. Please visit %s to learn how to connect a business account.', 'instagram-feed' ), '<a href="https://smashballoon.com/migrate-to-new-instagram-hashtag-api/">' . __( 'this page', 'instagram-feed' ) . '</a>' ),
				'frontend_directions' => '',
				'backend_directions' => ''
			);
			$sb_instagram_posts_manager->maybe_set_display_error( 'configuration', $error_message_return );
*/
		}

		$this->add_feed_type_and_terms( $feed_type_and_terms );

		$this->add_connected_accounts_in_feed( $connected_accounts_in_feed );

	}

	/**
	 * Based on the settings related to retrieving post data from the API,
	 * this setting is used to make sure all endpoints needed for the feed are
	 * connected and stored for easily looping through when adding posts
	 *
	 * Pro - More feed types supported (hashtag_recent, hashtag_top)
	 *
	 * @since 5.0
	 * @since 5.2 mixed feeds use shortcode settings only, support for
	 *  tagged feeds added
	 * @since 5.3 warnings and workarounds added for deprecated accounts
	 */
	public function set_feed_type_and_terms() {
		global $sb_instagram_posts_manager;

		$is_using_access_token_in_shortcode = ! empty( $this->atts['accesstoken'] );
		$settings_link = '<a href="'.get_admin_url().'admin.php?page=sbi-settings" target="_blank">' . __( 'plugin Settings page', 'instagram-feed' ) . '</a>';
		if ( $is_using_access_token_in_shortcode ) {
			$error_message_return = array(
				'error_message' => __( 'Error: Cannot add access token directly to the shortcode.', 'instagram-feed' ),
				'admin_only' => sprintf( __( 'Due to recent Instagram platform changes, it\'s no longer possible to create a feed by adding the access token to the shortcode. Remove the access token from the shortcode and connect an account on the %s instead.', 'instagram-feed' ), $settings_link ),
				'frontend_directions' => '',
				'backend_directions' => ''
			);

			$sb_instagram_posts_manager->maybe_set_display_error( 'configuration', $error_message_return );


			$this->atts['accesstoken'] = '';
		}

		if ( $this->settings['type'] === 'user' ) {
			if ( empty( $this->settings['id'] )
			     && empty( $this->settings['user'] )
			     && ! empty ( $this->connected_accounts ) ) {

				$this->set_user_feed();
			} else {
				$user_array= array();
				if ( ! empty( $this->settings['user'] ) ) {
					$user_array = is_array( $this->settings['user'] ) ? $this->settings['user'] : explode( ',', str_replace( ' ', '',  $this->settings['user'] ) );
				} elseif ( ! empty( $this->settings['id'] ) ) {
					$user_array = is_array( $this->settings['id'] ) ? $this->settings['id'] : explode( ',', str_replace( ' ', '',  $this->settings['id'] ) );
				}

				$this->set_user_feed( $user_array );
			}
			if ( empty( $this->feed_type_and_terms['users'] ) ) {
				$sbi_statuses_option = get_option( 'sbi_statuses', array() );


				if ( isset( $sbi_statuses_option['support_legacy_shortcode'] ) && ! $sbi_statuses_option['support_legacy_shortcode'] ) {

					if ( empty( $this->atts['feed'] ) ) {
						$error_message_return = array(
							'error_message' => __( 'Error: No Feed ID Set.', 'instagram-feed' ),
							'admin_only' => __( 'Visit the Instagram Feed settings page to see which feeds have been created and how to embed them.', 'instagram-feed' ),
							'frontend_directions' => '',
							'backend_directions' => ''
						);
					} else {
						$error_message_return = array(
							'error_message' => __( 'Error: Invalid Feed ID.', 'instagram-feed' ),
							'admin_only' => __( 'Visit the Instagram Feed settings page to see which feeds have been created and how to embed them.', 'instagram-feed' ),
							'frontend_directions' => '',
							'backend_directions' => ''
						);
					}

					$sb_instagram_posts_manager->maybe_set_display_error( 'configuration', $error_message_return );
					return;
				} else {
					if ( empty( $this->atts['feed'] ) ) {
						$error_message_return = array(
							'error_message' => __( 'Error: No users set.', 'instagram-feed' ),
							'admin_only' => __( 'Please visit the plugin\'s settings page to select a user account or add one to the shortcode - user="username".', 'instagram-feed' ),
							'frontend_directions' => '',
							'backend_directions' => ''
						);
					} else {
						$error_message_return = array(
							'error_message' => __( 'Error: Invalid Feed ID.', 'instagram-feed' ),
							'admin_only' => __( 'Visit the Instagram Feed settings page to see which feeds have been created and how to embed them.', 'instagram-feed' ),
							'frontend_directions' => '',
							'backend_directions' => ''
						);
					}

				}

				$sb_instagram_posts_manager->maybe_set_display_error( 'configuration', $error_message_return );
			}
		} elseif ( $this->settings['type'] === 'hashtag' ) {


			$hashtags = is_array( $this->settings['hashtag'] ) ? $this->settings['hashtag'] : explode( ',', str_replace( array( ' ', '#' ), '', $this->settings['hashtag'] ) );

			$non_empty_hashtags = array();
			foreach ( $hashtags as $hashtag ) {
				if ( ! empty( $hashtag ) ) {
					$non_empty_hashtags[] = $hashtag;
				}
			}

			if ( $non_empty_hashtags ) {
				$this->set_hashtag_feed( $non_empty_hashtags );
			}
			if ( empty( $this->feed_type_and_terms['hashtags_recent'] )
				&& empty( $this->feed_type_and_terms['hashtags_top'] ) ) {
				$error_message_return = array(
					'error_message' => __( 'Error: No hashtags set.', 'instagram-feed' ),
					'admin_only' => __( 'Please visit the plugin\'s settings page to enter a hashtag or add one to the shortcode - hashtag="example".', 'instagram-feed' ),
					'frontend_directions' => '',
					'backend_directions' => ''
				);
				$sb_instagram_posts_manager->maybe_set_display_error( 'configuration', $error_message_return );
			}

		} elseif ( $this->settings['type'] === 'tagged' ) {
			$tagged = is_array( $this->settings['tagged'] ) ? $this->settings['tagged'] : explode( ',', str_replace( array(
				' ',
				'@'
			), '', $this->settings['tagged'] ) );

			$this->set_tagged_feed( $tagged );

			if ( empty( $this->feed_type_and_terms['tagged'] ) ) {
				$error_message_return = array(
					'error_message' => __( 'Error: No users set.', 'instagram-feed' ),
					'admin_only' => __( 'Please visit the plugin\'s settings page to select a user account or add one to the shortcode - tagged="username".', 'instagram-feed' ),
					'frontend_directions' => '',
					'backend_directions' => ''
				);
				$sb_instagram_posts_manager->maybe_set_display_error( 'configuration', $error_message_return );
			}
		} elseif ( $this->settings['type'] === 'mixed' ) {
			if ( ! empty( $this->atts['user'] ) ) {
				$user_array = is_array( $this->atts['user'] ) ? $this->atts['user'] : explode( ',', str_replace( ' ', '',  $this->atts['user'] ) );
			} elseif ( ! empty( $this->atts['id'] ) ) {
				$user_array = is_array( $this->atts['id'] ) ? $this->atts['id'] : explode( ',', str_replace( ' ', '',  $this->atts['id'] ) );
			}
			if ( ! empty( $user_array ) ) {
				$this->set_user_feed( $user_array );
			}

			if ( isset( $this->atts['hashtag'] ) ) {
				$hashtags           = is_array( $this->atts['hashtag'] ) ? $this->atts['hashtag'] : explode( ',', str_replace( array(
					' ',
					'#'
				), '', $this->atts['hashtag'] ) );
				$non_empty_hashtags = array();
				foreach ( $hashtags as $hashtag ) {
					if ( ! empty( $hashtags ) ) {
						$non_empty_hashtags[] = $hashtag;
					}
				}
				if ( ! empty( $non_empty_hashtags ) ) {
					$this->set_hashtag_feed( $non_empty_hashtags );
				}
			}

			if ( isset( $this->atts['tagged'] ) ) {
				$tagged = is_array( $this->atts['tagged'] ) ? $this->atts['tagged'] : explode( ',', str_replace( array(
					' ',
					'@'
				), '', $this->atts['tagged'] ) );

				if ( ! empty( $tagged ) ) {
					$this->set_tagged_feed( $tagged );
				}
			}

			if ( empty( $this->feed_type_and_terms['tagged'] )
				 && empty( $this->feed_type_and_terms['hashtags_recent'] )
			     && empty( $this->feed_type_and_terms['hashtags_top'] )
			     && empty( $this->feed_type_and_terms['users'] )) {
				$error_message_return = array(
					'error_message' => __( 'Error: No users set.', 'instagram-feed' ),
					'admin_only' => __( 'Please visit the plugin\'s settings page to select a user account or add one to the shortcode - tagged="username".', 'instagram-feed' ),
					'frontend_directions' => '',
					'backend_directions' => ''
				);
				$sb_instagram_posts_manager->maybe_set_display_error( 'configuration', $error_message_return );
			}
		}

		foreach ( $this->connected_accounts_in_feed as $connected_account_in_feed ) {
			if ( isset( $connected_account_in_feed['private'] )
			     && sbi_private_account_near_expiration( $connected_account_in_feed ) ) {
				$link_1 = '<a href="https://help.instagram.com/116024195217477/In">';
				$link_2 = '</a>';
				$error_message_return = array(
					'error_message' => __( 'Error: Private Instagram Account.', 'instagram-feed' ),
					'admin_only' => sprintf( __( 'It looks like your Instagram account is private. Instagram requires private accounts to be reauthenticated every 60 days. Refresh your account to allow it to continue updating, or %smake your Instagram account public%s.', 'instagram-feed' ), $link_1, $link_2 ),
					'frontend_directions' => '<a href="https://smashballoon.com/instagram-feed/docs/errors/#10">' . __( 'Click here to troubleshoot', 'instagram-feed' ) . '</a>',
					'backend_directions' => ''
				);

				$sb_instagram_posts_manager->maybe_set_display_error( 'configuration', $error_message_return );

			}
		}

		if ( ! empty( $this->connected_accounts_in_feed ) ) {
			$this->settings['sources'] = $this->connected_accounts_in_feed;
		}
	}

	/**
	 * Each hashtag has an ID associated with it. This must be retrieved first to
	 * get any posts associated with the hashtag.
	 *
	 * @param $hashtag
	 * @param $account
	 *
	 * @return bool|string
	 *
	 * @since 5.0
	 */
	public static function get_remote_hashtag_id_from_hashtag_name( $hashtag, $account ) {
		global $sb_instagram_posts_manager;

		if ( $sb_instagram_posts_manager->are_current_api_request_delays( $account ) ) {
			return false;
		}

		$connection = new SB_Instagram_API_Connect_Pro( $account, 'ig_hashtag_search', array( 'hashtag' => $hashtag ) );

		$connection->connect();

		if ( ! $connection->is_wp_error() && ! $connection->is_instagram_error() ) {
			$data = $connection->get_data();
			if ( isset( $data[0] ) ) {
				$sb_instagram_posts_manager->remove_error( 'hashtag_limit', $account );

				return $data[0]['id'];
			} else {
				return false;
			}
		} else {
			if ( $connection->is_wp_error() ) {
				SB_Instagram_API_Connect_Pro::handle_wp_remote_get_error( $connection->get_wp_error() );
			} else {
				$response = $connection->get_data();
				if ( (int)$response['error']['code'] === 24 ) {
					$response['hashtag'] = $hashtag;
					$sb_instagram_posts_manager->add_error( 'hashtag', $response );
				} elseif ( (int)$response['error']['code'] === 18 ) {
					$sb_instagram_posts_manager->add_error( 'hashtag_limit', $response, $account['user_id'] );
				} elseif ( isset( $response['error'] ) ) {
					SB_Instagram_API_Connect_Pro::handle_instagram_error( $connection->get_data(), $account, 'ig_hashtag_search' );
				}
			}

			return false;
		}

	}

	/**
	 * The plugin will output settings on the frontend for debugging purposes.
	 * Safe settings to display are added here.
	 *
	 * @return array
	 *
	 * @since 5.2
	 */
	public static function get_public_db_settings_keys() {
		$public = array(
			'type',
			'user',
			'order',
			'id',
			'hashtag',
			'tagged',
			'width',
			'widthunit',
			'height',
			'heightunit',
			'widthresp',
			'sortby',
			'captionlinks',
			'offset',
			'num',
			'apinum',
			'disablelightbox',
			'apinum',
			'nummobile',
			'numtablet',
			'cols',
			'colsmobile',
			'colstablet',
			'disablemobile',
			'colstablet',
			'imagepadding',
			'imagepaddingunit',
			'layout',
			'lightboxcomments',
			'numcomments',
			'hovereffect',
			'hovercolor',
			'hovertextcolor',
			'hoverdisplay',
			'background',
			'imageres',
			'videotypes',
			'showcaption',
			'captionlength',
			'hovercaptionlength',
			'captioncolor',
			'captionsize',
			'showlikes',
			'likessize',
			'hidephotos',
			'showbutton',
			'buttoncolor',
			'buttonhovercolor',
			'buttontextcolor',
			'buttontext',
			'showfollow',
			'followcolor',
			'followhovercolor',
			'followtextcolor',
			'followtext',
			'showheader',
			'headertextsize',
			'headercolor',
			'headerstyle',
			'showfollowers',
			'showbio',
			'custombio',
			'customavatar',
			'headerprimarycolor',
			'headersecondarycolor',
			'headersize',
			'stories',
			'storiestime',
			'class',
			'ajaxtheme',
			'excludewords',
			'includewords',
			'maxrequests',
			'carouselrows',
			'carouselloop',
			'carouselarrows',
			'carouselpag',
			'carouselautoplay',
			'carouseltime',
			'highlighttype',
			'highlightoffset',
			'highlightpattern',
			'highlighthashtag',
			'highlightids',
			'whitelist',
			'highlighttype',
			'autoscroll',
			'autoscrolldistance',
			'permanent',
			'user',
			'feedid',
			'resizeprocess',
			'mediavine',
			'customtemplates',
			'gdpr',
			'colorpalette',
			'feed',
			'minnum',
			'disable_resize',
			'disable_js_image_loading',
			'sbi_cache_cron_interval',
			'sb_instagram_cache_time',
			'sb_instagram_cache_time_unit',
			'addModerationModeLink',
			'caching_type',
			'ajax_post_load',
			'caching_type',
			'reelsposts'
		);

		return $public;
	}

	/**
	 * Hashtag IDs are stored locally to avoid the extra API call
	 *
	 * @return array
	 *
	 * @since 5.0
	 */
	public static function get_hashtag_ids() {
		$ids_with_accounts = get_option( 'sbi_hashtag_ids_with_connected_accounts', array() );
		$encryption = new SB_Instagram_Data_Encryption();

		if ( empty( $ids_with_accounts ) ) {
			$ids = get_option( 'sbi_hashtag_ids', array() );
			if ( ! is_array( $ids ) ) {
				$ids = json_decode( $encryption->decrypt( $ids ), true );
			}
			$ids_with_accounts = array();

			if( ! empty( $ids ) ) {
				foreach ( $ids as $hashtag => $id ) {
					$ids_with_accounts[ $hashtag ] = array(
						'id' => $id,
					);
				}
				update_option( 'sbi_hashtag_ids_with_connected_accounts', $encryption->encrypt( sbi_json_encode( $ids_with_accounts ) ), false );
			}
		}
		if ( ! is_array( $ids_with_accounts ) ) {
			$ids_with_accounts = json_decode( $encryption->decrypt( $ids_with_accounts ), true );
		}
		return $ids_with_accounts;
	}

	/**
	 * Stores the retrieved hashtag ID locally using hashtag => hashtag ID
	 * key value pair
	 *
	 * @param $hashtag_name_id_pairs
	 *
	 * @since 5.0
	 */
	public static function update_hashtag_ids( $hashtag_name_id_pairs ) {
		$existing = self::get_hashtag_ids();
		$encryption = new SB_Instagram_Data_Encryption();
		if ( ! is_array( $existing ) ) {
			$existing = json_decode( $encryption->decrypt( $existing ), true );
		}
		$existing = is_array( $existing ) ? $existing : [];
		$new = array_merge( $existing, $hashtag_name_id_pairs );
		update_option( 'sbi_hashtag_ids_with_connected_accounts', $encryption->encrypt( sbi_json_encode( $new ) ), false );
	}

	/**
	 * Clears the marker for the hashtag limit being reached for a connected account
	 * since this expires after a week.
	 *
	 * @param $account
	 *
	 * @since 5.0
	 */
	public static function clear_hashtag_limit_reached( $account ) {
		$options = get_option( 'sb_instagram_settings', array() );

		$connected_accounts =  isset( $options['connected_accounts'] ) ? $options['connected_accounts'] : array();

		foreach ( $connected_accounts as $key => $connected_account ) {
			if ( isset( $connected_accounts[ $key ]['hashtag_limit_reached'] ) ) {
				unset( $connected_accounts[ $key ]['hashtag_limit_reached'] );
			}
		}

		$options['connected_accounts'] = $connected_accounts;

		update_option( 'sb_instagram_settings', $options );
	}

	public static function default_settings() {
		$defaults = array(
			'sb_instagram_at'                   => '',
			'sb_instagram_type'                 => 'user',
			'sb_instagram_order'                => 'top',
			'sb_instagram_user_id'              => '',
			'sb_instagram_tagged_ids' => '',
			'sb_instagram_hashtag'              => '',
			'sb_instagram_type_self_likes'      => '',
			'sb_instagram_location'             => '',
			'sb_instagram_coordinates'          => '',
			'sb_instagram_preserve_settings'    => '',
			'sb_instagram_ajax_theme'           => false,
			'enqueue_js_in_head'                => false,
			'disable_js_image_loading'          => false,
			'sb_instagram_disable_resize'       => false,
			'sb_instagram_favor_local'          => true,
			'sb_instagram_cache_time'           => '1',
			'sb_instagram_cache_time_unit'      => 'hours',
			'sbi_caching_type'                  => 'page',
			'sbi_cache_cron_interval'           => '12hours',
			'sbi_cache_cron_time'               => '1',
			'sbi_cache_cron_am_pm'              => 'am',

			'sb_instagram_width'                => '100',
			'sb_instagram_width_unit'           => '%',
			'sb_instagram_feed_width_resp'      => false,
			'sb_instagram_height'               => '',
			'sb_instagram_num'                  => '20',
			'sb_instagram_nummobile'            => '',
			'sb_instagram_height_unit'          => '',
			'sb_instagram_cols'                 => '4',
			'sb_instagram_colsmobile'           => 'auto',
			'sb_instagram_image_padding'        => '5',
			'sb_instagram_image_padding_unit'   => 'px',

			//Layout Type
			'sb_instagram_layout_type'          => 'grid',
			'sb_instagram_highlight_type'       => 'pattern',
			'sb_instagram_highlight_offset'     => 0,
			'sb_instagram_highlight_factor'     => 6,
			'sb_instagram_highlight_ids'        => '',
			'sb_instagram_highlight_hashtag'    => '',

			//Hover style
			'sb_hover_background'               => '',
			'sb_hover_text'                     => '',
			'sbi_hover_inc_username'            => true,
			'sbi_hover_inc_icon'                => true,
			'sbi_hover_inc_date'                => true,
			'sbi_hover_inc_instagram'           => true,
			'sbi_hover_inc_location'            => false,
			'sbi_hover_inc_caption'             => false,
			'sbi_hover_inc_likes'               => false,
			// 'sb_instagram_hover_text_size'      => '',

			'sb_instagram_sort'                 => 'none',
			'sb_instagram_disable_lightbox'     => false,
			'sb_instagram_offset'               => 0,
			'sb_instagram_captionlinks'         => false,
			'sb_instagram_background'           => '',
			'sb_instagram_show_btn'             => true,
			'sb_instagram_btn_background'       => '',
			'sb_instagram_btn_text_color'       => '',
			'sb_instagram_btn_text'             => __( 'Load More', 'instagram-feed' ),
			'sb_instagram_image_res'            => 'auto',
			'sb_instagram_media_type'           => 'all',
			'sb_instagram_moderation_mode'      => 'manual',
			'sb_instagram_hide_photos'          => '',
			'sb_instagram_block_users'          => '',
			'sb_instagram_ex_apply_to'          => 'all',
			'sb_instagram_inc_apply_to'         => 'all',
			'sb_instagram_show_users'           => '',
			'sb_instagram_exclude_words'        => '',
			'sb_instagram_include_words'        => '',

			//Text
			'sb_instagram_show_caption'         => true,
			'sb_instagram_caption_length'       => '50',
			'sb_instagram_caption_color'        => '',
			'sb_instagram_caption_size'         => '13',

			//lightbox comments
			'sb_instagram_lightbox_comments'    => true,
			'sb_instagram_num_comments'         => '20',

			//Meta
			'sb_instagram_show_meta'            => true,
			'sb_instagram_meta_color'           => '',
			'sb_instagram_meta_size'            => '13',
			//Header
			'sb_instagram_show_header'          => true,
			'sb_instagram_header_color'         => '',
			'sb_instagram_header_style'         => 'standard',
			'sb_instagram_show_followers'       => true,
			'sb_instagram_show_bio'             => true,
			'sb_instagram_custom_bio' => '',
			'sb_instagram_custom_avatar' => '',
			'sb_instagram_header_primary_color'  => '517fa4',
			'sb_instagram_header_secondary_color'  => 'eeeeee',
			'sb_instagram_header_size'  => 'small',
			'sb_instagram_outside_scrollable' => false,
			'sb_instagram_stories' => true,
			'sb_instagram_stories_time' => 5000,

			//Follow button
			'sb_instagram_show_follow_btn'      => true,
			'sb_instagram_folow_btn_background' => '',
			'sb_instagram_follow_btn_text_color' => '',
			'sb_instagram_follow_btn_text'      => __( 'Follow on Instagram', 'instagram-feed' ),

			//Autoscroll
			'sb_instagram_autoscroll' => false,
			'sb_instagram_autoscrolldistance' => 200,

			//Misc
			'sb_instagram_custom_css'           => '',
			'sb_instagram_custom_js'            => '',
			'sb_instagram_requests_max'         => '5',
			'sb_instagram_minnum' => '0',
			'sb_instagram_cron'                 => 'unset',
			'sb_instagram_disable_font'         => false,
			'sb_instagram_backup' => true,
			'sb_ajax_initial' => false,
			'sb_instagram_resizeprocess' => 'background',
			'enqueue_css_in_shortcode' => false,
			'sb_instagram_disable_mob_swipe' => false,
			'sbi_br_adjust' => true,
			'sb_instagram_media_vine' => false,
			'custom_template' => false,
			'disable_admin_notice' => false,
			'enable_email_report' => 'on',
			'email_notification' => 'monday',
			'email_notification_addresses' => get_option( 'admin_email' ),
			'gdpr' => 'auto',

			//Carousel
			'sb_instagram_carousel'             => false,
			'sb_instagram_carousel_rows'        => 1,
			'sb_instagram_carousel_loop'        => 'rewind',
			'sb_instagram_carousel_arrows'      => false,
			'sb_instagram_carousel_pag'         => true,
			'sb_instagram_carousel_autoplay'    => false,
			'sb_instagram_carousel_interval'    => '5000'

		);

		return $defaults;
	}

	public function get_connected_accounts_from_settings() {
		if ( $this->settings['feed'] === 'legacy' ) {
			$sources = \InstagramFeed\Builder\SBI_Db::source_query();

			return \InstagramFeed\Builder\SBI_Source::convert_sources_to_connected_accounts( $sources );
		}
		$include_all_businesses = false;

		$account_ids = [];

		if ( $this->settings['type'] === 'hashtag' ) {
			$include_all_businesses = true;
		}

		if ( $this->settings['type'] === 'mixed' ) {
			$include_all_businesses = ! empty( $this->settings['hashtag'] );
		}

		$ids = array();
		if ( ! empty( $this->settings['id'] ) ) {
			$ids = is_array( $this->settings['id'] ) ? $this->settings['id'] : explode( ',', str_replace(' ', '', $this->settings['id'] ) );
		}
		$tagged = array();
		if ( ! empty( $this->settings['tagged'] ) ) {
			$tagged = is_array( $this->settings['tagged'] ) ? $this->settings['tagged'] : explode( ',', str_replace(' ', '', $this->settings['tagged'] ) );
		}

		$account_ids = array_merge( $ids, $tagged );

		$args = array(
			'all_businesses' => $include_all_businesses,
			'id' => $account_ids
		);
		$sources = \InstagramFeed\Builder\SBI_Db::source_query( $args );

		if ( empty( $sources ) ) {
			$sources = \InstagramFeed\Builder\SBI_Db::source_query();
		}

		return \InstagramFeed\Builder\SBI_Source::convert_sources_to_connected_accounts( $sources );
	}

	/**
	 * Attributes allowed in shortcodes and how they are sanitized
	 *
	 * @return array
	 */
	public static function get_pro_allowed_atts() {
		$allowed_atts = SB_Instagram_Settings::get_allowed_atts();

		$pro_allowed_atts = array(
			'feed' => array(
				'method' => 'intval',
				'allowed_vals' => 99999
			),
			'type'               => array(
				'method'       => 'enum',
				'allowed_vals' => array( 'user', 'tagged', 'hashtag', 'mixed' ),
			),
			'order'              => array(
				'method'       => 'enum',
				'allowed_vals' => array( 'top', 'recent' ),
			),
			'tagged'             => array(
				'method'       => 'feedid_chars',
				'allowed_vals' => 'any',
			),
			'hashtag'            => array(
				'method'       => 'hashtag_chars',
				'allowed_vals' => 'any',
			),
			'disablelightbox'    => array(
				'method' => 'page_load_only',
			),
			'captionlinks'       => array(
				'method' => 'page_load_only',
			),
			'offset'             => array(
				'method'       => 'intval',
				'allowed_vals' => 500,
			),
			'layout'             => array(
				'method' => 'page_load_only',
			),
			'lightboxcomments'   => array(
				'method' => 'page_load_only',
			),
			'numcomments'        => array(
				'method' => 'page_load_only',
			),
			'hovereffect'        => array(
				'method' => 'page_load_only',
			),
			'hovercolor'         => array(
				'method'       => 'color',
				'allowed_vals' => 'any',
			),
			'hovertextcolor'     => array(
				'method'       => 'color',
				'allowed_vals' => 'any',
			),
			'hoverdisplay'       => array(
				'method'       => 'enum_array',
				'allowed_vals' => array( 'icon', 'date', 'instagram', 'location', 'caption', 'likes' ),
			),
			'media'              => array(
				'method'       => 'enum',
				'allowed_vals' => array( 'all', 'photos', 'videos' ),
			),
			'videotypes'         => array(
				'method'       => 'enum_array',
				'allowed_vals' => array( 'regular', 'reels' ),
			),
			'showcaption'        => array(
				'method'       => 'string_true',
				'allowed_vals' => 'any',
			),
			'captionlength'      => array(
				'method'       => 'intval',
				'allowed_vals' => 500,
			),
			'hovercaptionlength' => array(
				'method'       => 'intval',
				'allowed_vals' => 500,
			),
			'captioncolor'       => array(
				'method'       => 'color',
				'allowed_vals' => 'any',
			),
			'captionsize'        => array(
				'method'       => 'pxsize',
				'allowed_vals' => 'any',
			),
			'showlikes'          => array(
				'method'       => 'string_true',
				'allowed_vals' => 'any',
			),
			'likescolor'         => array(
				'method'       => 'color',
				'allowed_vals' => 'any',
			),
			'likessize'          => array(
				'method'       => 'pxsize',
				'allowed_vals' => 'any',
			),
			'hidephotos'         => array(
				'method'       => 'numeric_and_comma',
				'allowed_vals' => 'any',
			),
			'showfollowers'      => array(
				'method'       => 'string_true',
				'allowed_vals' => 'any',
			),
			'stories'            => array(
				'method' => 'page_load_only',
			),
			'storiestime'        => array(
				'method' => 'page_load_only',
			),
			'includewords'       => array(
				'method'       => 'inc_ex',
				'allowed_vals' => 100,
			),
			'excludewords'       => array(
				'method'       => 'inc_ex',
				'allowed_vals' => 100,
			),
			'carousel'           => array(
				'method' => 'page_load_only',
			),
			'carouselrows'       => array(
				'method' => 'page_load_only',
			),
			'carouselloop'       => array(
				'method' => 'page_load_only',
			),
			'carouselarrows'     => array(
				'method' => 'page_load_only',
			),
			'carouselpag'        => array(
				'method' => 'page_load_only',
			),
			'carouselautoplay'   => array(
				'method' => 'page_load_only',
			),
			'carouseltime'       => array(
				'method' => 'page_load_only',
			),
			'highlighttype'      => array(
				'method' => 'page_load_only',
			),
			'highlightoffset'    => array(
				'method' => 'page_load_only',
			),
			'highlightpattern'   => array(
				'method' => 'page_load_only',
			),
			'highlighthashtag'   => array(
				'method' => 'page_load_only',
			),
			'highlightids'       => array(
				'method' => 'page_load_only',
			),
			'whitelist'          => array(
				'method'       => 'feedid_chars',
				'allowed_vals' => 'any',
			),
			'autoscroll'         => array(
				'method' => 'page_load_only',
			),
			'autoscrolldistance' => array(
				'method' => 'page_load_only',
			),
			'moderationmode'     => array(
				'method' => 'page_load_only',
			),
			'permanent'          => array(
				'method'       => 'string_true',
				'allowed_vals' => 'any',
			),
			'mediavine'          => array(
				'method' => 'page_load_only',
			),
			'doingModerationMode'      => array(
				'method'       => 'string_true',
				'allowed_vals' => 'any',
			),
		);

		return array_merge( $allowed_atts, $pro_allowed_atts );
	}

	/**
	 * Compares given array with an allow list of
	 * setting keys and how they should be sanitized
	 *
	 * @param array $atts
	 *
	 * @return array
	 */
	public static function pro_sanitize_raw_atts( $atts ) {
		$sanitized_atts = array();

		$allowed_atts = SB_Instagram_Settings_Pro::get_pro_allowed_atts();

		foreach ( $atts as $key => $value ) {
			if ( ! is_array( $value ) ) {
				$value = (string) $value;
			} else {
				$value = '';
			}

			if ( isset( $allowed_atts[ $key ] ) && strlen( $value ) < 500 ) {
				$sanitization_method = $allowed_atts[ $key ]['method'];

				switch ( $sanitization_method ) {
					case 'enum' :
						if ( in_array( $value, $allowed_atts[ $key ]['allowed_vals'], true ) ) {
							$sanitized_atts[ $key ] = sanitize_text_field( $value );
						}
						break;
					case 'enum_array' :
						$values_array = explode( ',', str_replace( ' ', '', $value ) );
						$filtered = array();
						foreach ( $values_array as $single_value ) {
							if ( in_array( $single_value, $allowed_atts[ $key ]['allowed_vals'], true ) ) {
								$filtered[] = $single_value;
							}
						}
						$sanitized_atts[ $key ] = implode( ',', $filtered );
						break;
					case 'alpha_numeric_and_comma' :
						$sanitized_atts[ $key ] = preg_replace( "/[^A-Za-z0-9_,]/", '', $value );
						break;
					case 'feedid_chars' :
						$value = str_replace( ' ', '', $value );
						$feedid_chars_with_expected = preg_replace( "/[^A-Za-z0-9#_\-\/?,]/", '', str_replace('%','', urlencode( $value ) ) );
						if ( $feedid_chars_with_expected !== str_replace('%','', urlencode( $value ) ) ) {
							$sanitized_atts[ $key ] = '';
						} else {
							$sanitized_atts[ $key ] = sanitize_text_field( $value );
						}
						break;
					case 'hashtag_chars' :
						$value = str_replace( ' ', '', $value );
						$hashtag_with_expected = preg_replace( "/[^A-Za-z0-9#_\-\/?,]/", '', str_replace('%','', urlencode( $value ) ) );
						if ( $hashtag_with_expected !== str_replace('%','', urlencode( $value ) ) ) {
							$sanitized_atts[ $key ] = '';
						} else {
							$sanitized_atts[ $key ] = sanitize_text_field( $value );
						}
						break;
					case 'intval' :
						$value = intval( $value );

						if ( $value < (int)$allowed_atts[ $key ]['allowed_vals'] ) {
							$sanitized_atts[ $key ] = $value;
						}

						break;
					case 'floatval' :
						$value = floatval( $value );

						if ( $allowed_atts[ $key ]['allowed_vals'] === 'any' ) {
							$sanitized_atts[ $key ] = $value;
						} elseif ( $value < (float)$allowed_atts[ $key ]['allowed_vals'] ) {
							$sanitized_atts[ $key ] = $value;
						}

						if ( floor( $value ) === $value ) {
							$sanitized_atts[ $key ] = (int)$value;
						}

						break;
					case 'string_true' :
						$value = floatval( $value );

						if ( $value === 'true' || $value === 'on' || $value === true ) {
							$sanitized_atts[ $key ] = 'true';
						} else {
							$sanitized_atts[ $key ] = 'false';
						}

						break;
					case 'color' :
						if ( strpos( $value, 'rgb' ) === false ) {
							$sanitized_atts[ $key ] = sanitize_hex_color( $value );
						} else {
							$sanitized_atts[ $key ] = preg_replace( "/[^rgba0-9.,()]/", '', $value );
						}

						break;
					case 'pxsize' :
						if ( strpos( $value, 'inherit' ) !== false ) {
							$sanitized_atts[ $key ] = 'inherit';
						} else {
							$sanitized_atts[ $key ] = preg_replace( "/[^0-9]/", '', $value );
						}

						break;
					case 'numeric_and_comma' :
						$sanitized_atts[ $key ] = preg_replace( "/[^0-9,]/", '', $value );

						break;
					case 'inc_ex' :
						$values_array = explode( ',', str_replace( ' ', '', $value ) );
						$filtered = array();
						foreach ( $values_array as $single_value ) {
							if ( strlen( $single_value ) < $allowed_atts[ $key ]['allowed_vals'] ) {
								$filtered[] = $single_value;
							}
						}
						$sanitized_atts[ $key ] = implode( ',', $filtered );
						break;
				}
			}
		}

		return $sanitized_atts;
  }

	/**
	 * @return mixed
	 * @since 6.0
	 */
	public static function get_legacy_feed_settings() {
		return json_decode( get_option( 'sbi_legacy_feed_settings', '{}' ), true );
	}

	/**
	 * @param $instagram_feed_settings
	 *
	 * @return mixed
	 * @since 6.0
	 */
	public static function legacy_to_builder_convert( $instagram_feed_settings ) {

		$moderation_json_array = array(
			'list_type_selected' => 'allow',
			'allow_list' => array(),
			'block_list' => ! empty( $instagram_feed_settings['hidephotos'] ) ? explode( ',', str_replace(',', ' ', $instagram_feed_settings['hidephotos'] ) ) : array()
		);

		if ( ! empty( $instagram_feed_settings['whitelist_ids'] ) ) {
			$moderation_json_array['allow_list'] = $instagram_feed_settings['whitelist_ids'];
		} else {
			$moderation_json_array['list_type_selected'] = 'block';
		}
		$instagram_feed_settings['moderationlist'] = json_encode( $moderation_json_array );
		$instagram_feed_settings['customizer'] = false;
		$instagram_feed_settings['feed'] = 'legacy';
		$unsets = array(
			'feed_is_moderated',
			'whitelist_ids',
			'whitelist_num',
			'minnum',
			'disable_resize',
			'favor_local',
			'backup_cache_enabled',
			'font_method',
			'disable_js_image_loading',
			'sbi_cache_cron_interval',
			'sb_instagram_cache_time',
			'sb_instagram_cache_time_unit',
			'addModerationModeLink',
			'caching_type',
			'ajax_post_load',
			'isgutenberg',
			'hidephotos',
		);

		foreach ( $unsets as $unset_key ) {
			if ( isset( $instagram_feed_settings[ $unset_key ] ) ) {
				unset( $instagram_feed_settings[ $unset_key ] );
			}
		}

		return $instagram_feed_settings;
	}

	/**
	 * For one time update to capture existing legacy shortcode atts
	 *
	 * @param array $atts
	 * @param array $db
	 *
	 * @return array
	 */
	public static function legacy_shortcode_atts( $atts, $db ) {
		//Create the includes string to set as shortcode default
		$hover_include_string = '';
		if ( isset( $db['sbi_hover_inc_username'] ) ) {
			( $db['sbi_hover_inc_username'] && $db['sbi_hover_inc_username'] !== '' ) ? $hover_include_string .= 'username,' : $hover_include_string .= '';
		}
		//If the username option doesn't exist in the database yet (eg: on plugin update) then set it to be displayed
		if ( ! array_key_exists( 'sbi_hover_inc_username', $db ) ) {
			$hover_include_string .= 'username,';
		}

		if ( isset( $db['sbi_hover_inc_icon'] ) ) {
			( $db['sbi_hover_inc_icon'] && $db['sbi_hover_inc_icon'] !== '' ) ? $hover_include_string .= 'icon,' : $hover_include_string .= '';
		}
		if ( ! array_key_exists( 'sbi_hover_inc_icon', $db ) ) {
			$hover_include_string .= 'icon,';
		}

		if ( isset( $db['sbi_hover_inc_date'] ) ) {
			( $db['sbi_hover_inc_date'] && $db['sbi_hover_inc_date'] !== '' ) ? $hover_include_string .= 'date,' : $hover_include_string .= '';
		}
		if ( ! array_key_exists( 'sbi_hover_inc_date', $db ) ) {
			$hover_include_string .= 'date,';
		}

		if ( isset( $db['sbi_hover_inc_instagram'] ) ) {
			( $db['sbi_hover_inc_instagram'] && $db['sbi_hover_inc_instagram'] !== '' ) ? $hover_include_string .= 'instagram,' : $hover_include_string .= '';
		}
		if ( ! array_key_exists( 'sbi_hover_inc_instagram', $db ) ) {
			$hover_include_string .= 'instagram,';
		}

		if ( isset( $db['sbi_hover_inc_location'] ) ) {
			( $db['sbi_hover_inc_location'] && $db['sbi_hover_inc_location'] !== '' ) ? $hover_include_string .= 'location,' : $hover_include_string .= '';
		}
		if ( isset( $db['sbi_hover_inc_caption'] ) ) {
			( $db['sbi_hover_inc_caption'] && $db['sbi_hover_inc_caption'] !== '' ) ? $hover_include_string .= 'caption,' : $hover_include_string .= '';
		}
		if ( isset( $db['sbi_hover_inc_likes'] ) ) {
			( $db['sbi_hover_inc_likes'] && $db['sbi_hover_inc_likes'] !== '' ) ? $hover_include_string .= 'likes,' : $hover_include_string .= '';
		}
		if ( isset( $db['sb_instagram_incex_one_all'] ) ) {
			if ( $db['sb_instagram_incex_one_all'] === 'one' ) {
				$db['sb_instagram_include_words'] = '';
				$db['sb_instagram_exclude_words'] = '';
			}
		}

		$settings = shortcode_atts(
			array(
				//Feed general
				'type'                 => isset( $db['sb_instagram_type'] ) ? $db['sb_instagram_type'] : 'user',
				'order'                => isset( $db['sb_instagram_order'] ) ? $db['sb_instagram_order'] : '',
				'id'                   => isset( $db['sb_instagram_user_id'] ) ? $db['sb_instagram_user_id'] : '',
				'hashtag'              => isset( $db['sb_instagram_hashtag'] ) ? $db['sb_instagram_hashtag'] : '',
				'tagged'               => isset( $db['sb_instagram_tagged_ids'] ) ? $db['sb_instagram_tagged_ids'] : '',
				'location'             => isset( $db['sb_instagram_location'] ) ? $db['sb_instagram_location'] : '',
				'coordinates'          => isset( $db['sb_instagram_coordinates'] ) ? $db['sb_instagram_coordinates'] : '',
				'single'               => '',
				'width'                => isset( $db['sb_instagram_width'] ) ? $db['sb_instagram_width'] : '',
				'widthunit'            => isset( $db['sb_instagram_width_unit'] ) ? $db['sb_instagram_width_unit'] : '',
				'widthresp'            => isset( $db['sb_instagram_feed_width_resp'] ) ? $db['sb_instagram_feed_width_resp'] : '',
				'height'               => isset( $db['sb_instagram_height'] ) ? $db['sb_instagram_height'] : '',
				'heightunit'           => isset( $db['sb_instagram_height_unit'] ) ? $db['sb_instagram_height_unit'] : '',
				'sortby'               => isset( $db['sb_instagram_sort'] ) ? $db['sb_instagram_sort'] : '',
				'disablelightbox'      => isset( $db['sb_instagram_disable_lightbox'] ) ? $db['sb_instagram_disable_lightbox'] : '',
				'captionlinks'         => isset( $db['sb_instagram_captionlinks'] ) ? $db['sb_instagram_captionlinks'] : '',
				'offset'               => isset( $db['sb_instagram_offset'] ) ? $db['sb_instagram_offset'] : '',
				'num'                  => isset( $db['sb_instagram_num'] ) ? $db['sb_instagram_num'] : '',
				'apinum'               => isset( $db['sb_instagram_minnum'] ) ? $db['sb_instagram_minnum'] : '',
				'nummobile'            => isset( $db['sb_instagram_nummobile'] ) ? $db['sb_instagram_nummobile'] : '',
				'cols'                 => isset( $db['sb_instagram_cols'] ) ? $db['sb_instagram_cols'] : '',
				'colsmobile'           => isset( $db['sb_instagram_colsmobile'] ) ? $db['sb_instagram_colsmobile'] : '',
				'disablemobile'        => isset( $db['sb_instagram_disable_mobile'] ) ? $db['sb_instagram_disable_mobile'] : '',
				'imagepadding'         => isset( $db['sb_instagram_image_padding'] ) ? $db['sb_instagram_image_padding'] : '',
				'imagepaddingunit'     => isset( $db['sb_instagram_image_padding_unit'] ) ? $db['sb_instagram_image_padding_unit'] : '',
				'layout'               => isset( $db['sb_instagram_layout_type'] ) ? $db['sb_instagram_layout_type'] : 'grid',

				//Lightbox comments
				'lightboxcomments'     => isset( $db['sb_instagram_lightbox_comments'] ) ? $db['sb_instagram_lightbox_comments'] : '',
				'numcomments'          => isset( $db['sb_instagram_num_comments'] ) ? $db['sb_instagram_num_comments'] : '',

				//Photo hover styles
				'hovereffect'          => isset( $db['sb_instagram_hover_effect'] ) ? $db['sb_instagram_hover_effect'] : '',
				'hovercolor'           => isset( $db['sb_hover_background'] ) ? $db['sb_hover_background'] : '',
				'hovertextcolor'       => isset( $db['sb_hover_text'] ) ? $db['sb_hover_text'] : '',
				'hoverdisplay'         => $hover_include_string,

				//Item misc
				'background'           => isset( $db['sb_instagram_background'] ) ? $db['sb_instagram_background'] : '',
				'imageres'             => isset( $db['sb_instagram_image_res'] ) ? $db['sb_instagram_image_res'] : '',
				'media'                => isset( $db['sb_instagram_media_type'] ) ? $db['sb_instagram_media_type'] : '',
				'videotypes'           => isset( $db['videotypes'] ) ? $db['videotypes'] : 'regular,,reels',
				'showcaption'          => isset( $db['sb_instagram_show_caption'] ) ? $db['sb_instagram_show_caption'] : true,
				'captionlength'        => isset( $db['sb_instagram_caption_length'] ) ? $db['sb_instagram_caption_length'] : '',
				'captioncolor'         => isset( $db['sb_instagram_caption_color'] ) ? $db['sb_instagram_caption_color'] : '',
				'captionsize'          => isset( $db['sb_instagram_caption_size'] ) ? $db['sb_instagram_caption_size'] : '',
				'showlikes'            => isset( $db['sb_instagram_show_meta'] ) ? $db['sb_instagram_show_meta'] : true,
				'likescolor'           => isset( $db['sb_instagram_meta_color'] ) ? $db['sb_instagram_meta_color'] : '',
				'likessize'            => isset( $db['sb_instagram_meta_size'] ) ? $db['sb_instagram_meta_size'] : '',
				'hidephotos'           => isset( $db['sb_instagram_hide_photos'] ) ? $db['sb_instagram_hide_photos'] : '',

				//Footer
				'showbutton'           => isset( $db['sb_instagram_show_btn'] ) ? $db['sb_instagram_show_btn'] : '',
				'buttoncolor'          => isset( $db['sb_instagram_btn_background'] ) ? $db['sb_instagram_btn_background'] : '',
				'buttontextcolor'      => isset( $db['sb_instagram_btn_text_color'] ) ? $db['sb_instagram_btn_text_color'] : '',
				'buttontext'           => isset( $db['sb_instagram_btn_text'] ) ? stripslashes( esc_attr( $db['sb_instagram_btn_text'] ) ) : '',
				'showfollow'           => isset( $db['sb_instagram_show_follow_btn'] ) ? $db['sb_instagram_show_follow_btn'] : '',
				'followcolor'          => isset( $db['sb_instagram_folow_btn_background'] ) ? $db['sb_instagram_folow_btn_background'] : '',
				'followtextcolor'      => isset( $db['sb_instagram_follow_btn_text_color'] ) ? $db['sb_instagram_follow_btn_text_color'] : '',
				'followtext'           => isset( $db['sb_instagram_follow_btn_text'] ) ? stripslashes( esc_attr( $db['sb_instagram_follow_btn_text'] ) ) : '',

				//Header
				'showheader'           => isset( $db['sb_instagram_show_header'] ) ? $db['sb_instagram_show_header'] : '',
				'headercolor'          => isset( $db['sb_instagram_header_color'] ) ? $db['sb_instagram_header_color'] : '',
				'headerstyle'          => isset( $db['sb_instagram_header_style'] ) ? $db['sb_instagram_header_style'] : '',
				'showfollowers'        => isset( $db['sb_instagram_show_followers'] ) ? $db['sb_instagram_show_followers'] : true,
				'showbio'              => isset( $db['sb_instagram_show_bio'] ) ? $db['sb_instagram_show_bio'] : true,
				'custombio'            => isset( $db['sb_instagram_custom_bio'] ) ? $db['sb_instagram_custom_bio'] : '',
				'customavatar'         => isset( $db['sb_instagram_custom_avatar'] ) ? $db['sb_instagram_custom_avatar'] : '',
				'headerprimarycolor'   => isset( $db['sb_instagram_header_primary_color'] ) ? $db['sb_instagram_header_primary_color'] : '',
				'headersecondarycolor' => isset( $db['sb_instagram_header_secondary_color'] ) ? $db['sb_instagram_header_secondary_color'] : '',
				'headersize'           => isset( $db['sb_instagram_header_size'] ) ? $db['sb_instagram_header_size'] : '',
				'stories'              => isset( $db['sb_instagram_stories'] ) ? $db['sb_instagram_stories'] : true,
				'storiestime'          => isset( $db['sb_instagram_stories_time'] ) ? $db['sb_instagram_stories_time'] : '',
				'headeroutside'        => isset( $db['sb_instagram_outside_scrollable'] ) ? $db['sb_instagram_outside_scrollable'] : '',

				'class'                => '',
				'ajaxtheme'            => isset( $db['sb_instagram_ajax_theme'] ) ? $db['sb_instagram_ajax_theme'] : '',
				'cachetime'            => isset( $db['sb_instagram_cache_time'] ) ? $db['sb_instagram_cache_time'] : '',
				'blockusers'           => isset( $db['sb_instagram_block_users'] ) ? $db['sb_instagram_block_users'] : '',
				'showusers'            => isset( $db['sb_instagram_show_users'] ) ? $db['sb_instagram_show_users'] : '',
				'excludewords'         => isset( $db['sb_instagram_exclude_words'] ) ? $db['sb_instagram_exclude_words'] : '',
				'includewords'         => isset( $db['sb_instagram_include_words'] ) ? $db['sb_instagram_include_words'] : '',
				'maxrequests'          => isset( $db['sb_instagram_requests_max'] ) ? $db['sb_instagram_requests_max'] : '',

				//Carousel
				'carousel'             => isset( $db['sb_instagram_carousel'] ) ? $db['sb_instagram_carousel'] : '',
				'carouselrows'         => isset( $db['sb_instagram_carousel_rows'] ) ? $db['sb_instagram_carousel_rows'] : '',
				'carouselloop'         => isset( $db['sb_instagram_carousel_loop'] ) ? $db['sb_instagram_carousel_loop'] : '',
				'carouselarrows'       => isset( $db['sb_instagram_carousel_arrows'] ) ? $db['sb_instagram_carousel_arrows'] : '',
				'carouselpag'          => isset( $db['sb_instagram_carousel_pag'] ) ? $db['sb_instagram_carousel_pag'] : '',
				'carouselautoplay'     => isset( $db['sb_instagram_carousel_autoplay'] ) ? $db['sb_instagram_carousel_autoplay'] : '',
				'carouseltime'         => isset( $db['sb_instagram_carousel_interval'] ) ? $db['sb_instagram_carousel_interval'] : '',

				//Highlight
				'highlighttype'        => isset( $db['sb_instagram_highlight_type'] ) ? $db['sb_instagram_highlight_type'] : '',
				'highlightoffset'      => isset( $db['sb_instagram_highlight_offset'] ) ? $db['sb_instagram_highlight_offset'] : '',
				'highlightpattern'     => isset( $db['sb_instagram_highlight_factor'] ) ? $db['sb_instagram_highlight_factor'] : '',
				'highlighthashtag'     => isset( $db['sb_instagram_highlight_hashtag'] ) ? $db['sb_instagram_highlight_hashtag'] : '',
				'highlightids'         => isset( $db['sb_instagram_highlight_ids'] ) ? $db['sb_instagram_highlight_ids'] : '',

				//WhiteList
				'whitelist'            => '',

				//Load More on Scroll
				'autoscroll'           => isset( $db['sb_instagram_autoscroll'] ) ? $db['sb_instagram_autoscroll'] : '',
				'autoscrolldistance'   => isset( $db['sb_instagram_autoscrolldistance'] ) ? $db['sb_instagram_autoscrolldistance'] : '',

				//Moderation Mode
				'moderationmode'       => isset( $db['sb_instagram_moderation_mode'] ) ? $db['sb_instagram_moderation_mode'] === 'visual' : '',

				//Permanent
				'permanent'            => isset( $db['sb_instagram_permanent'] ) ? $db['sb_instagram_permanent'] : false,
				'accesstoken'          => '',
				'user'                 => isset( $db['sb_instagram_user_id'] ) ? $db['sb_instagram_user_id'] : false,

				//Misc
				'feedid'               => isset( $db['sb_instagram_feed_id'] ) ? $db['sb_instagram_feed_id'] : false,

				'resizeprocess'        => isset( $db['sb_instagram_resizeprocess'] ) ? $db['sb_instagram_resizeprocess'] : 'background',
				'mediavine'            => isset( $db['sb_instagram_media_vine'] ) ? $db['sb_instagram_media_vine'] : '',
				'customtemplates'      => isset( $db['custom_template'] ) ? $db['custom_template'] : '',
				'gdpr'                 => isset( $db['gdpr'] ) ? $db['gdpr'] : 'auto',

			),
			$atts
		);
		$settings['customtemplates'] = $settings['customtemplates'] === 'true' || $settings['customtemplates'] === 'on' || $settings['customtemplates'] === true;
		$settings['showbio'] = $settings['showbio'] === 'true' || $settings['showbio'] === 'on' || $settings['showbio'] === true;
		if ( isset( $settings['showbio'] ) && $settings['showbio'] === 'false' ) {
			$settings['showbio'] = false;
		}
		// allow the use of "user=" for tagged type as well
		if ( $settings['type'] === 'tagged'
		     && empty( $atts['tagged'] )
		     && ! empty( $atts['user'] ) ) {
			$settings['tagged'] = $atts['user'];
		}
		$settings['num']    = max( (int) $settings['num'], 0 );
		$settings['minnum'] = max( (int) $settings['num'], (int) $settings['nummobile'] );
		$settings['disable_resize']           = isset( $db['sb_instagram_disable_resize'] ) && ( $db['sb_instagram_disable_resize'] === 'on' || $db['sb_instagram_disable_resize'] === true );
		$settings['favor_local']              = ! isset( $db['sb_instagram_favor_local'] ) || ( $db['sb_instagram_favor_local'] === 'on' ) || ( $db['sb_instagram_favor_local'] === true );
		$settings['backup_cache_enabled']     = ! isset( $db['sb_instagram_backup'] ) || ( $db['sb_instagram_backup'] === 'on' ) || $db['sb_instagram_backup'] === true;
		$settings['font_method']              = 'svg';
		$settings['disable_js_image_loading'] = isset( $db['disable_js_image_loading'] ) && ( $db['disable_js_image_loading'] === 'on' || $db['disable_js_image_loading'] === true );

		switch ( $db['sbi_cache_cron_interval'] ) {
			case '30mins':
				$settings['sbi_cache_cron_interval'] = 60 * 30;
				break;
			case '1hour':
				$settings['sbi_cache_cron_interval'] = 60 * 60;
				break;
			default:
				$settings['sbi_cache_cron_interval'] = 60 * 60 * 12;
		}
		$settings['sb_instagram_cache_time']      = isset( $db['sb_instagram_cache_time'] ) ? $db['sb_instagram_cache_time'] : 1;
		$settings['sb_instagram_cache_time_unit'] = isset( $db['sb_instagram_cache_time_unit'] ) ? $db['sb_instagram_cache_time_unit'] : 'hours';

		$settings['stories'] = ( ( $settings['stories'] === '' && ! isset( $db['sb_instagram_stories'] ) ) || $settings['stories'] === true || $settings['stories'] === 'on' || $settings['stories'] === 'true' ) && $settings['stories'] !== 'false';
		return $settings;
	}
}
