<?php
/**
 * Customizer Tab
 *
 *
 * @since 6.0
 */
namespace InstagramFeed\Builder\Tabs;

use InstagramFeed\Builder\SBI_Feed_Builder;
use InstagramFeed\Helpers\Util;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


class SBI_Customize_Tab {

	public static $should_disable_pro_features = false;

	/**
	 * Get Customize Tab Sections
	 *
	 *
	 * @since 6.0
	 * @access public
	 *
	 * @return array
	 */
	public static function get_sections() {
		self::$should_disable_pro_features = sbi_builder_pro()->license_service->should_disable_pro_features;

		return array(
			'settings_feedtemplate' => [
				'heading' 	=> __( 'Template', 'custom-facebook-feed' ),
				'icon' 		=> 'layout',
				'controls'	=> self::get_settings_feed_templates_controls()
			],
			'customize_feedlayout'     => array(
				'heading'  => __( 'Feed Layout', 'instagram-feed' ),
				'icon'     => 'feed_layout',
				'controls' => self::get_customize_feedlayout_controls(),
			),
			'customize_colorschemes'   => array(
				'heading'  => __( 'Color Scheme', 'instagram-feed' ),
				'icon'     => 'color_scheme',
				'controls' => self::get_customize_colorscheme_controls(),
			),
			'customize_sections'       => array(
				'heading'  => __( 'Sections', 'instagram-feed' ),
				'isHeader' => true,
			),
			'customize_header'         => array(
				'heading'   => __( 'Header', 'instagram-feed' ),
				'icon'      => 'header',
				'separator' => 'none',
				'controls'  => self::get_customize_header_controls(),
			),
			'customize_posts'          => array(
				'heading'         => __( 'Posts', 'instagram-feed' ),
				'icon'            => 'article',
				'controls'        => self::get_customize_posts_controls(),
				'nested_sections' => self::get_customize_posts_nested_sections()
			),
			'customize_loadmorebutton' => array(
				'heading'     => __( 'Load More Button', 'instagram-feed' ),
				'description' => '<br/>',
				'icon'        => 'load_more',
				'separator'   => 'none',
				'controls'    => self::get_customize_loadmorebutton_controls(),
			),
			'customize_followbutton'   => array(
				'heading'     => __( 'Follow Button', 'instagram-feed' ),
				'description' => '<br/>',
				'icon'        => 'follow',
				'separator'   => 'none',
				'controls'    => self::get_customize_followbutton_controls(),
			),
			'customize_lightbox'       => array(
				'heading'     => __( 'Lightbox', 'instagram-feed' ),
				'description' => !self::$should_disable_pro_features ? '<br/>' : __( 'Upgrade to Pro to add a modal when user clicks on a post.', 'instagram-feed' ),
				'proLabel'		=> !self::$should_disable_pro_features ? false : true,
				'icon'        => 'lightbox',
				'separator'   => 'none',
				'checkExtensionPopup' => !self::$should_disable_pro_features ? null : 'lightbox',
				'controls'    => self::get_customize_lightbox_controls(),
			),

		);
	}

	/**
	 * Get Settings Tab Feed Type Section.
	 *
	 * @since INSTA_FEED_PRO_SINCE
	 *
	 * @return array
	 */
	public static function get_settings_feed_templates_controls() {
		return [
			[
				'type'   => 'customview',
				'viewId' => 'feedtemplate'
			]
		];
	}

	/**
	 * Get Customize Tab Feed Layout Section
	 * @since 6.0
	 * @return array
	 */
	public static function get_customize_feedlayout_controls() {
		$columns_options = array(
			'1' => '1',
			'2' => '2',
			'3' => '3',
			'4' => '4',
			'5' => '5',
			'6' => '6',
			'7' => '7',
			'8' => '8',
			'9' => '9',
			'10' => '10',

		);

		return array(
			array(
				'type'      => 'toggleset',
				'id'        => 'layout',
				'heading'   => __( 'Layout', 'instagram-feed' ),
				'separator' => 'bottom',
				'options'   => array(
					array(
						'value' => 'grid',
						'icon'  => 'grid',
						'label' => __( 'Grid', 'instagram-feed' ),
					),
					array(
						'value' => 'carousel',
						'icon'  => 'carousel',
						'checkExtension' => !self::$should_disable_pro_features ? null : 'feedLayout',
						'label' => __( 'Carousel', 'instagram-feed' ),
					),
					array(
						'value' => 'masonry',
						'icon'  => 'masonry',
						'checkExtension' => !self::$should_disable_pro_features ? null : 'feedLayout',
						'label' => __( 'Masonry', 'instagram-feed' ),
					),
					array(
						'value' => 'highlight',
						'icon'  => 'highlight',
						'checkExtension' => !self::$should_disable_pro_features ? null : 'feedLayout',
						'label' => __( 'Highlight', 'instagram-feed' ),
					),
				),
			),

			//Carousel Settings
			array(
				'type'          => 'heading',
				'heading'       => __( 'Carousel Settings', 'instagram-feed' ),
				'condition'     => array( 'layout' => array( 'carousel' ) ),
				'conditionHide' => true,
			),
			array(
				'type'          => 'select',
				'id'            => 'carouselrows',
				'layout'        => 'half',
				'condition'     => array( 'layout' => array( 'carousel' ) ),
				'conditionHide' => true,
				'ajaxAction'    => 'feedFlyPreview',
				'strongHeading' => 'false',
				'stacked'       => 'true',
				'heading'       => __( 'Rows', 'instagram-feed' ),
				'options'       => array(
					1 => '1',
					2 => '2',
				),
			),

			array(
				'type'          => 'select',
				'id'            => 'carouselloop',
				'condition'     => array( 'layout' => array( 'carousel' ) ),
				'conditionHide' => true,
				'layout'        => 'half',
				'strongHeading' => 'false',
				'heading'       => __( 'Loop Type', 'instagram-feed' ),
				'stacked'       => 'true',
				'options'       => array(
					'rewind'   => __( 'Rewind', 'instagram-feed' ),
					'infinity' => __( 'Infinity', 'instagram-feed' ),
				),
			),
			array(
				'type'          => 'number',
				'id'            => 'carouseltime',
				'condition'     => array( 'layout' => array( 'carousel' ) ),
				'conditionHide' => true,
				'stacked'       => 'true',
				'layout'        => 'half',
				'fieldSuffix'   => 'ms',
				'heading'       => __( 'Interval Time', 'instagram-feed' ),
			),
			array(
				'type'          => 'checkbox',
				'id'            => 'carouselarrows',
				'condition'     => array( 'layout' => array( 'carousel' ) ),
				'conditionHide' => true,
				'label'         => __( 'Show Navigation Arrows', 'instagram-feed' ),
				'reverse'       => 'true',
				'stacked'       => 'true',
				'options'       => array(
					'enabled'  => true,
					'disabled' => false,
				),
			),
			array(
				'type'          => 'checkbox',
				'id'            => 'carouselpag',
				'condition'     => array( 'layout' => array( 'carousel' ) ),
				'conditionHide' => true,
				'label'         => __( 'Show Pagination', 'instagram-feed' ),
				'reverse'       => 'true',
				'stacked'       => 'true',
				'options'       => array(
					'enabled'  => true,
					'disabled' => false,
				),
			),
			array(
				'type'          => 'checkbox',
				'id'            => 'carouselautoplay',
				'condition'     => array( 'layout' => array( 'carousel' ) ),
				'conditionHide' => true,
				'label'         => __( 'Enable Autoplay', 'instagram-feed' ),
				'reverse'       => 'true',
				'stacked'       => 'true',
				'options'       => array(
					'enabled'  => true,
					'disabled' => false,
				),
			),

			//HighLight Settings
			array(
				'type'          => 'heading',
				'heading'       => __( 'HighLight Settings', 'instagram-feed' ),
				'condition'     => array( 'layout' => array( 'highlight' ) ),
				'conditionHide' => true,
			),
			array(
				'type'          => 'select',
				'id'            => 'highlighttype',
				'condition'     => array( 'layout' => array( 'highlight' ) ),
				'conditionHide' => true,
				'layout'        => 'half',
				'strongHeading' => 'false',
				'heading'       => __( 'Type', 'instagram-feed' ),
				'stacked'       => 'true',
				'options'       => array(
					'pattern' => __( 'Pattern', 'instagram-feed' ),
					'id'      => __( 'Post ID', 'instagram-feed' ),
					'hashtag' => __( 'Hashtag', 'instagram-feed' ),
				),
			),
			array(
				'type'          => 'number',
				'id'            => 'highlightoffset',
				'condition'     => array(
					'layout'        => array( 'highlight' ),
					'highlighttype' => array( 'pattern' ),
				),
				'conditionHide' => true,
				'stacked'       => 'true',
				'layout'        => 'half',
				'heading'       => __( 'Offset', 'instagram-feed' ),
			),
			array(
				'type'          => 'number',
				'id'            => 'highlightpattern',
				'condition'     => array(
					'layout'        => array( 'highlight' ),
					'highlighttype' => array( 'pattern' ),
				),
				'conditionHide' => true,
				'stacked'       => 'true',
				'layout'        => 'half',
				'fieldSuffix'   => 'posts',
				'heading'       => __( 'Highlight every', 'instagram-feed' ),
			),

			array(
				'type'          => 'textarea',
				'id'            => 'highlightids',
				'description'   => __( 'Highlight posts with these IDs', 'instagram-feed' ),
				'placeholder'   => 'id1, id2',
				'condition'     => array(
					'layout'        => array( 'highlight' ),
					'highlighttype' => array( 'id' ),
				),
				'conditionHide' => true,
				'stacked'       => 'true',
			),

			array(
				'type'          => 'textarea',
				'id'            => 'highlighthashtag',
				'description'   => __( 'Highlight posts with these hashtags', 'instagram-feed' ),
				'placeholder'   => '#hashtag1, #hashtag2',
				'condition'     => array(
					'layout'        => array( 'highlight' ),
					'highlighttype' => array( 'hashtag' ),
				),
				'conditionHide' => true,
				'stacked'       => 'true',
			),

			array(
				'type'          => 'separator',
				'top'           => 20,
				'bottom'        => 10,
				'condition'     => array( 'layout' => array( 'highlight' ) ),
				'conditionHide' => true,
			),

			array(
				'type'          => 'number',
				'id'            => 'height',
				'fieldSuffix'   => 'px',
				'separator'     => 'bottom',
				'strongHeading' => 'true',
				'heading'       => __( 'Feed Height', 'instagram-feed' ),
				'style'         => array( '#sb_instagram' => 'height:{{value}}px!important;overflow:auto;' ),
			),
			array(
				'type'          => 'number',
				'id'            => 'imagepadding',
				'fieldSuffix'   => 'px',
				'separator'     => 'bottom',
				'strongHeading' => 'true',
				'heading'       => __( 'Padding', 'instagram-feed' ),
				'style'         => array( '#sbi_images' => 'padding:{{value}}px!important;' ),
			),
			array(
				'type'    => 'heading',
				'heading' => __( 'Number of Posts', 'instagram-feed' ),
			),
			array(
				'type'          => 'number',
				'id'            => 'num',
				'icon'          => 'desktop',
				'layout'        => 'half',
				'ajaxAction'    => 'feedFlyPreview',

				'strongHeading' => 'false',
				'stacked'       => 'true',
				'heading'       => __( 'Desktop', 'instagram-feed' ),
			),
			array(
				'type'          => 'number',
				'id'            => 'nummobile',
				'icon'          => 'mobile',
				'layout'        => 'half',
				'strongHeading' => 'false',
				'stacked'       => 'true',
				'heading'       => __( 'Mobile', 'instagram-feed' ),
			),

			array(
				'type'   => 'separator',
				'top'    => 10,
				'bottom' => 10,
			),
			array(
				'type'          => 'heading',
				'heading'       => __( 'Columns', 'instagram-feed' ),
				'conditionHide' => true,
			),
			array(
				'type'          => 'select',
				'id'            => 'cols',
				'conditionHide' => true,
				'icon'          => 'desktop',
				'layout'        => 'half',
				'strongHeading' => 'false',
				'heading'       => __( 'Desktop', 'instagram-feed' ),
				'stacked'       => 'true',
				'options'       => $columns_options
			),

			array(
				'type'          => 'select',
				'id'            => 'colstablet',
				'conditionHide' => true,
				'icon'          => 'tablet',
				'layout'        => 'half',
				'strongHeading' => 'false',
				'heading'       => __( 'Tablet', 'instagram-feed' ),
				'stacked'       => 'true',
				'options'       => $columns_options
			),
			array(
				'type'          => 'select',
				'id'            => 'colsmobile',
				'conditionHide' => true,
				'icon'          => 'mobile',
				'layout'        => 'half',
				'strongHeading' => 'false',
				'heading'       => __( 'Mobile', 'instagram-feed' ),
				'stacked'       => 'true',
				'options'       => $columns_options
			),

		);
	}

	/**
	 * Get Customize Tab Color Scheme Section
	 * @since 6.0
	 * @return array
	 */
	public static function get_customize_colorscheme_controls() {
		$feed_id            = isset( $_GET['feed_id'] ) ? sanitize_key( $_GET['feed_id'] ) : '';
		$color_scheme_array = array(
			array(
				'type'      => 'toggleset',
				'id'        => 'colorpalette',
				'separator' => 'bottom',
				'options'   => array(
					array(
						'value' => 'inherit',
						'label' => __( 'Inherit from Theme', 'instagram-feed' ),
					),
					array(
						'value' => 'light',
						'icon'  => 'sun',
						'label' => __( 'Light', 'instagram-feed' ),
					),
					array(
						'value' => 'dark',
						'icon'  => 'moon',
						'label' => __( 'Dark', 'instagram-feed' ),
					),
					array(
						'value' => 'custom',
						'icon'  => 'cog',
						'label' => __( 'Custom', 'instagram-feed' ),
					),
				),
			),

			//Custom Color Palette
			array(
				'type'          => 'heading',
				'condition'     => array( 'colorpalette' => array( 'custom' ) ),
				'conditionHide' => true,
				'heading'       => __( 'Custom Palette', 'instagram-feed' ),
			),
			array(
				'type'          => 'colorpicker',
				'id'            => 'custombgcolor1',
				'condition'     => array( 'colorpalette' => array( 'custom' ) ),
				'conditionHide' => true,
				'layout'        => 'half',
				'strongHeading' => 'false',
				'heading'       => __( 'Background', 'custom-facebook-feed' ),
				'style'         => array( '.sbi_header_palette_custom_' . $feed_id . ',#sb_instagram.sbi_palette_custom_' . $feed_id . ',#sbi_lightbox .sbi_lb-outerContainer .sbi_lb-dataContainer,#sbi_lightbox .sbi_lightbox_tooltip,#sbi_lightbox .sbi_share_close' => 'background:{{value}}!important;' ),
				'stacked'       => 'true',
			),
			array(
				'type'          => 'colorpicker',
				'id'            => 'customtextcolor1',
				'condition'     => array( 'colorpalette' => array( 'custom' ) ),
				'conditionHide' => true,
				'layout'        => 'half',
				'strongHeading' => 'false',
				'heading'       => __( 'Text', 'custom-facebook-feed' ),
				'style'         => array( '#sb_instagram.sbi_palette_custom_' . $feed_id . ' .sbi_caption,#sbi_lightbox .sbi_lb-outerContainer .sbi_lb-dataContainer .sbi_lb-details .sbi_lb-caption,#sbi_lightbox .sbi_lb-outerContainer .sbi_lb-dataContainer .sbi_lb-number,#sbi_lightbox.sbi_lb-comments-enabled .sbi_lb-commentBox p' => 'color:{{value}}!important;' ),
				'stacked'       => 'true',
			),
			array(
				'type'          => 'colorpicker',
				'id'            => 'customtextcolor2',
				'condition'     => array( 'colorpalette' => array( 'custom' ) ),
				'conditionHide' => true,
				'layout'        => 'half',
				'strongHeading' => 'false',
				'heading'       => __( 'Text 2', 'custom-facebook-feed' ),
				'style'         => array( '.sbi_header_palette_custom_' . $feed_id . ' .sbi_bio,#sb_instagram.sbi_palette_custom_' . $feed_id . ' .sbi_meta' => 'color:{{value}}!important;' ),
				'stacked'       => 'true',
			),
			array(
				'type'          => 'colorpicker',
				'id'            => 'customlinkcolor1',
				'condition'     => array( 'colorpalette' => array( 'custom' ) ),
				'conditionHide' => true,
				'layout'        => 'half',
				'strongHeading' => 'false',
				'heading'       => __( 'Link', 'custom-facebook-feed' ),
				'style'         => array( '.sbi_header_palette_custom_' . $feed_id . ' a,#sb_instagram.sbi_palette_custom_' . $feed_id . ' .sbi_expand a,#sbi_lightbox .sbi_lb-outerContainer .sbi_lb-dataContainer .sbi_lb-details a,#sbi_lightbox.sbi_lb-comments-enabled .sbi_lb-commentBox .sbi_lb-commenter' => 'color:{{value}};' ),
				'stacked'       => 'true',
			),
			array(
				'type'          => 'colorpicker',
				'id'            => 'custombuttoncolor1',
				'condition'     => array( 'colorpalette' => array( 'custom' ) ),
				'conditionHide' => true,
				'layout'        => 'half',
				'strongHeading' => 'false',
				'heading'       => __( 'Button 1', 'custom-facebook-feed' ),
				'style'         => array( '#sb_instagram.sbi_palette_custom_' . $feed_id . ' #sbi_load .sbi_load_btn' => 'background:{{value}}!important;' ),
				'stacked'       => 'true',
			),
			array(
				'type'          => 'colorpicker',
				'id'            => 'custombuttoncolor2',
				'condition'     => array( 'colorpalette' => array( 'custom' ) ),
				'conditionHide' => true,
				'layout'        => 'half',
				'strongHeading' => 'false',
				'heading'       => __( 'Button 2', 'custom-facebook-feed' ),
				'style'         => array( '#sb_instagram.sbi_palette_custom_' . $feed_id . ' #sbi_load .sbi_follow_btn a' => 'background:{{value}}!important;' ),
				'stacked'       => 'true',
			),
		);

		$color_overrides = array();

		$color_overrides_array = array();
		return array_merge( $color_scheme_array, $color_overrides_array );
	}

	/**
	 * Get Customize Tab Header Section
	 * @since 6.0
	 * @return array
	 */
	public static function get_customize_header_controls() {
		$is_business_source = SBI_Feed_Builder::is_business_source();

		$header_controls = array(
			array(
				'type'    => 'switcher',
				'id'      => 'showheader',
				'label'   => __( 'Enable', 'instagram-feed' ),
				'reverse' => 'true',
				'stacked' => 'true',
				'options' => array(
					'enabled'  => true,
					'disabled' => false,
				),
			),
		);
		if ( ! self::$should_disable_pro_features ) {
			$header_controls[] =  array(
				'type'      => 'separator',
				'condition' => array( 'showheader' => array( true ) ),
				'conditionHide' => true,
				'top'       => 10,
				'bottom'    => 10,
			);
			$header_controls[] = array(
				'type'      => 'toggleset',
				'id'        => 'headerstyle',
				'condition' => array( 'showheader' => array( true ) ),
				'conditionHide' => true,
				'heading'   => __( 'Header Style', 'instagram-feed' ),
				'options'   => array(
					array(
						'value' => 'standard',
						'label' => __( 'Standard', 'instagram-feed' ),
						'checkExtension' => !self::$should_disable_pro_features ? null : 'headerLayout',
					),
					array(
						'value' => 'boxed',
						'label' => __( 'Boxed', 'instagram-feed' ),
						'checkExtension' => !self::$should_disable_pro_features ? null : 'headerLayout',
					),
					array(
						'value' => 'centered',
						'label' => __( 'Centered', 'instagram-feed' ),
						'checkExtension' => !self::$should_disable_pro_features ? null : 'headerLayout',
					),
					array(
						'value' => 'text',
						'label' => __( 'Text', 'instagram-feed' ),
						'checkExtension' => !self::$should_disable_pro_features ? null : 'headerLayout',
					),
				),
			);
		}

		$header_controls[] = array(
			'type'          => 'select',
			'id'            => 'headersize',
			'condition'     => array(
				'showheader'  => array( true ),
				'headerstyle' => array( 'standard', 'boxed', 'centered' )
			),
			'conditionHide' => true,
			'strongHeading' => 'true',
			'separator'     => self::$should_disable_pro_features ? 'bottom' : 'both',
			'heading'       => __( 'Header Size', 'instagram-feed' ),
			'options'       => array(
				'small'  => __( 'Small', 'instagram-feed' ),
				'medium' => __( 'Medium', 'instagram-feed' ),
				'large'  => __( 'Large', 'instagram-feed' ),
			),
		);

		$header_controls[] = array(
			'type'          => 'imagechooser',
			'id'            => 'customavatar',
			'condition'     => array(
				'showheader'  => array( true ),
				'headerstyle' => array( 'standard', 'boxed', 'centered' )
			),
			'conditionHide' => true,

			'strongHeading' => 'true',
			'separator'     => 'bottom',
			'heading'       => __( 'Use Custom Avatar', 'instagram-feed' ),
			'tooltip'       => __( 'Upload your own custom image to use for the avatar. This is automatically retrieved from Instagram for Business accounts, but is not available for Personal accounts.', 'instagram-feed' ),
			'placeholder'   => __( 'No Image Added', 'instagram-feed' ),
		);

		$header_controls[] = array(
			'type'      => 'heading',
			'heading'   => __( 'Text', 'instagram-feed' ),
			'type'          => 'heading',
			'heading'       => __( 'Text', 'instagram-feed' ),
			'condition'     => array(
				'showheader'  => array( true ),
				'headerstyle' => array( 'standard', 'boxed', 'centered' )
			),
			'conditionHide' => true,
		);

		$header_controls[] = array(
			'type'          => 'colorpicker',
			'id'            => 'headercolor',
			'condition'     => array(
				'showheader'  => array( true ),
				'headerstyle' => array( 'standard', 'boxed', 'centered' )
			),
			'conditionHide' => true,
			'layout'        => 'half',
			'strongHeading' => 'false',
			'heading'       => __( 'Color', 'instagram-feed' ),
			'style'         => array( '.sbi_header_text > *, .sbi_bio_info > *' => 'color:{{value}}!important;' ),
			'stacked'       => 'true',
		);
			
		$header_controls[] = array(
			'type'          => 'colorpicker',
			'id'            => 'headerprimarycolor',
			'condition'     => array(
				'showheader'  => array( true ),
				'headerstyle' => 'boxed',
			),
			'conditionHide' => true,
			'layout'        => 'half',
			'strongHeading' => 'false',
			'heading'       => __( 'Primary Color', 'instagram-feed' ),
			'style'         => array(
				'.sbi_header_style_boxed .sbi_bio_info > *' => 'color:{{value}}!important;',
				'.sbi_header_style_boxed' => 'background:{{value}}!important;',
			),
			'stacked'       => 'true',
		);
		$header_controls[] = array(
			'type'          => 'colorpicker',
			'id'            => 'headersecondarycolor',
			'condition'     => array(
				'showheader'  => array( true ),
				'headerstyle' => 'boxed',
			),
			'conditionHide' => true,
			'layout'        => 'half',
			'strongHeading' => 'false',
			'heading'       => __( 'Secondary Color', 'instagram-feed' ),
			'style'         => array( '.sbi_header_style_boxed .sbi_header_bar' => 'background:{{value}}!important;' ),
			'stacked'       => 'true',
		);
		$header_controls[] = array(
			'type'      => 'separator',
			'condition' => array( 'showheader' => array( true ) ),
			'conditionHide' => true,
			'top'       => 10,
			'bottom'    => 10,
		);
		
		if ( ! self::$should_disable_pro_features ) {
			$header_controls[] = array(
				'type'        => 'switcher',
				'id'          => 'showfollowers',
				'type'          => 'switcher',
				'id'            => 'showfollowers',
				'condition'     => array(
					'showheader'  => array( true ),
					'headerstyle' => array( 'standard', 'boxed', 'centered' )
				),
				'checkExtensionDimmed'	=> !self::$should_disable_pro_features ? false : 'headerLayout',
				'checkExtensionPopup' => !self::$should_disable_pro_features ? false : 'headerLayout',
				'conditionHide' => true,
				'label'         => __( 'Show number of followers', 'instagram-feed' ),
				'stacked'       => 'true',
				'labelStrong'   => 'true',
				'options'       => array(
					'enabled'  => true,
					'disabled' => false,
				),
			);
			$header_controls[] = array(
				'type'          => 'separator',
				'condition'     => array(
					'showheader'  => array( true ),
					'headerstyle' => array( 'standard', 'boxed', 'centered' )
				),
				'conditionHide' => true,
				'top'           => 10,
				'bottom'        => 10,
			);
		}
		$header_controls[] = array(
			'type'          => 'switcher',
			'id'            => 'showbio',
			'condition'     => array(
				'showheader'  => array( true ),
				'headerstyle' => array( 'standard', 'boxed', 'centered' )
			),
			'conditionHide' => true,
			'label'         => __( 'Show Bio Text', 'instagram-feed' ),
			'tooltip'       => __( 'Use your own custom bio text in the feed header. This is automatically retrieved from Instagram for Business accounts, but it not available for Personal accounts.', 'instagram-feed' ),
			'stacked'     => 'true',
			'labelStrong' => 'true',
			'options'     => array(
				'enabled'  => true,
				'disabled' => false,
			),
		);
		$header_controls[] = array(
			'type'        => 'textarea',
			'id'          => 'custombio',
			'placeholder' => __( 'Add Custom bio', 'instagram-feed' ),
			'condition'   => array(
				'showheader' => array( true ),
				'headerstyle' => array( 'standard', 'boxed', 'centered' ),
				'showbio'    => array( true ),
			),
			'conditionHide' => true,
			'child'       => 'true',
			'stacked'     => 'true',
		);
		$header_controls[] = array(
			'type'      => 'separator',
			'condition'     => array(
				'showheader'  => array( true ),
				'headerstyle' => array( 'standard', 'boxed', 'centered' )
			),
			'conditionHide' => true,
			'top'       => 10,
			'bottom'    => 10,
		);
		$header_controls[] = array(
			'type'        => 'switcher',
			'id'          => 'headeroutside',
			'condition'     => array(
				'showheader'  => array( true ),
				'headerstyle' => array( 'standard', 'boxed', 'centered' )
			),
			'conditionHide' => true,

			'label'       => __( 'Show outside scrollable area', 'instagram-feed' ),
			'stacked'     => 'true',
			'labelStrong' => 'true',
			'options'     => array(
				'enabled'  => true,
				'disabled' => false,
			),
		);
		$header_controls[] = array(
			'type'      => 'separator',
			'condition' => array(
				'showheader'  => array( true ),
				'headerstyle' => array( 'standard', 'boxed', 'centered' )
			),
			'top'       => 10,
			'conditionHide' => true,
			'bottom'    => 10,
		);

		if ( self::$should_disable_pro_features ) {
			$header_controls[] = array(
				'type' 				=> 'heading',
				'heading' 			=> __( 'Advanced', 'instagram-feed' ),
				'proLabel'		=> true,
				'checkExtensionPopupLearnMore' 	=> !self::$should_disable_pro_features ? false : 'headerLayout',
				'condition'			=> ['showheader' => [true]],
				'conditionHide' => true,
				'description' 	=> __( 'Tweak the header styles and show your follower count with Instagram Feed Pro.', 'instagram-feed' ),
			);
			$header_controls[] = array(
				'type' 				=> 'separator',
				'condition'			=> ['showheader' => [true]],
				'conditionHide' => true,
				'top' 				=> 30,
				'bottom' 			=> 10,
			);
		}

		$header_controls[] = array(
			'type'        => 'switcher',
			'id'          => 'stories',
			'condition'     => array(
				'showheader'  => array( true ),
				'headerstyle' => array( 'standard', 'boxed', 'centered' )
			),
			'conditionHide' => true,
			'switcherTop' => true,
			'checkExtensionDimmed'	=> !self::$should_disable_pro_features ? false : 'headerLayout',
			'checkExtensionPopup' => !self::$should_disable_pro_features ? false : 'headerLayout',
			'heading'     => __( 'Include Stories', 'instagram-feed' ),
			'description' => __( 'You can view active stories by clicking the profile picture in the header. Instagram Business accounts only.<br/><br/>', 'instagram-feed' ),
			'tooltip'     =>
				'<div class="sbi-story-tltp-ctn"><strong>' . __( 'Add Instagram Stories', 'instagram-feed' ) . '</strong>' .
				'<p>' . __( 'Show your active stories from Instagram on your website.', 'instagram-feed' ) . '</p>' .
				'<p class="sbi-story-note"><strong>' . __( 'Note: ', 'instagram-feed' ) . '</strong>' .
				'<span>' . __( 'You need to have a business account with an active story.', 'instagram-feed' ) . '</span></p>' .
				'<div class="sbi-story-tooltip-img"><img src="'.esc_url(SBI_BUILDER_URL . 'assets/img/stories-tooltip.png' ).'" alt="stories tooltip"></div></div>' ,

			'stacked'     => 'true',
			'labelStrong' => 'true',
			'layout'      => 'half',
			'reverse'     => 'true',
			'options'     => array(
				'enabled'  => true,
				'disabled' => false,
			),
		);
		$header_controls[] = array(
			'type'                => 'number',
			'id'                  => 'storiestime',
			'condition'           => array(
				'showheader' => array( true ),
				'headerstyle' => array( 'standard', 'boxed', 'centered' ),
				'stories'    => array( true ),
			),
			'conditionHide'       => true,
			'strongHeading'       => false,
			'stacked'             => 'true',
			'placeholder'         => '500',
			'child'               => true,
			'checkExtensionDimmed'	=> !self::$should_disable_pro_features ? false : 'headerLayout',
			'checkExtensionPopup' => !self::$should_disable_pro_features ? false : 'headerLayout',
			'fieldSuffix'         => 'milliseconds',
			'heading'             => __( 'Change Interval', 'instagram-feed' ),
			'description'         => __( 'This is the time a story displays for, before displaying the next one. Videos always change when the video is finished.', 'instagram-feed' ),
			'descriptionPosition' => 'bottom',
		);

		if ( self::$should_disable_pro_features ) {
			$header_controls[] = array(
				'type'          => 'separator',
				'condition'     => array(
					'showheader'  => array( true ),
					'headerstyle' => array( 'standard', 'boxed', 'centered' )
				),
				'conditionHide' => true,
				'top'           => 10,
				'bottom'        => 10,
			);
			$header_controls[] = array(
				'type'        => 'switcher',
				'id'          => 'showfollowers',
				'type'          => 'switcher',
				'id'            => 'showfollowers',
				'condition'     => array(
					'showheader'  => array( true ),
					'headerstyle' => array( 'standard', 'boxed', 'centered' )
				),
				'checkExtensionDimmed'	=> !self::$should_disable_pro_features ? false : 'headerLayout',
				'checkExtensionPopup' => !self::$should_disable_pro_features ? false : 'headerLayout',
				'conditionHide' => true,
				'label'         => __( 'Show number of followers', 'instagram-feed' ),
				'stacked'       => 'true',
				'labelStrong'   => 'true',
				'options'       => array(
					'enabled'  => true,
					'disabled' => false,
				),
			);
			$header_controls[] =  array(
				'type'      => 'separator',
				'condition' => array( 'showheader' => array( true ) ),
				'conditionHide' => true,
				'top'       => 10,
				'bottom'    => 10,
			);
			$header_controls[] = array(
				'type'      => 'toggleset',
				'id'        => 'headerstyle',
				'condition' => array( 'showheader' => array( true ) ),
				'conditionHide' => true,
				'heading'   => __( 'Header Style', 'instagram-feed' ),
				'options'   => array(
					array(
						'value' => 'standard',
						'label' => __( 'Standard', 'instagram-feed' ),
						'checkExtension' => !self::$should_disable_pro_features ? false : 'headerLayout',
					),
					array(
						'value' => 'boxed',
						'label' => __( 'Boxed', 'instagram-feed' ),
						'checkExtension' => !self::$should_disable_pro_features ? false : 'headerLayout',
					),
					array(
						'value' => 'centered',
						'label' => __( 'Centered', 'instagram-feed' ),
						'checkExtension' => !self::$should_disable_pro_features ? false : 'headerLayout',
					),
					array(
						'value' => 'text',
						'label' => __( 'Text', 'instagram-feed' ),
						'checkExtension' => !self::$should_disable_pro_features ? false : 'headerLayout',
					),
				),
			);
		}
		$header_controls[] = array(
			'type' 				=> 'textarea',
			'id' 				=> 'headertext',
			'heading' 			=> __( 'Text', 'instagram-feed' ),
			'condition'           => array(
				'showheader'  => array( true ),
				'headerstyle' => array( 'text' ),
			),
			'conditionHide'       => true,
			'stacked'			=> 'true'
		);

		$header_controls[] = array(
				'type' 				=> 'select',
				'id' 				=> 'headertextsize',
				'condition'           => array(
					'showheader'  => array( true ),
					'headerstyle' => array( 'text' ),
				),
				'conditionHide'		=> true,
				'layout' 			=> 'full',
				'strongHeading'		=> 'false',
				'heading' 			=> __( 'Size', 'instagram-feed' ),
				'stacked'			=> 'true',
				'options'			=> array(
					'small' => __( 'Small', 'custom-twitter-feeds' ),
					'medium' => __( 'Medium', 'custom-twitter-feeds' ),
					'large' => __( 'Large', 'custom-twitter-feeds' ),
				)
			);
		$header_controls[] = array(
				'type' 				=> 'colorpicker',
				'id' 				=> 'headertextcolor',
				'condition'           => array(
					'showheader'  => array( true ),
					'headerstyle' => array( 'text' ),
				),
				'conditionHide'		=> true,
				'layout' 			=> 'half',
				'strongHeading'		=> 'false',
				'heading' 			=> __( 'Color', 'custom-facebook-feed' ),
				'style'				=> ['.sbi-header-type-text' => 'color:{{value}};'],
				'stacked'			=> 'true'
			);

		return $header_controls;
	}

	/**
	 * Get Customize Tab Posts Section
	 * @since 6.0
	 * @return array
	 */
	public static function get_customize_posts_controls() {
		if ( !self::$should_disable_pro_features ) {
			return array();
		} else {
			return [
				[
					'type' 				=> 'heading',
					'heading' 			=> __( 'Advanced', 'instagram-feed' ),
					'proLabel'		=> true,
					'checkExtensionPopupLearnMore' 	=> 'postStyling',
					'description' 	=> __( 'These properties are available in the PRO version.', 'instagram-feed' ),
				],
				[
					'type' 				=> 'checkbox',
					'id' 				=> 'showcaption',
					'label' 			=> __( 'Caption', 'instagram-feed' ),
					'labelStrong'		=> 'true',
					'separator'			=> 'bottom',
					'checkExtensionDimmed'	=> 'postStyling',
					'checkExtensionPopup' => 'postStyling',
					'disabledInput'		=> true,
					'options'			=> [
						'enabled'	=> true,
						'disabled'	=> false
					]
				],
				[
					'type' 		=> 'checkbox',
					'id' 				=> 'showlikes',
					'label' 			=> __( 'Like and Comment Summary', 'instagram-feed' ),
					'labelStrong'		=> 'true',
					'checkExtensionDimmed'	=> 'postStyling',
					'checkExtensionPopup' => 'postStyling',
					'separator'			=> 'bottom',
					'disabledInput'		=> true,
					'options'			=> [
						'enabled'	=> true,
						'disabled'	=> false
					]
				],
				[
					'type' 		=> 'checkbox',
					'id' 				=> 'showlikes',
					'label' 			=> __( 'Hover State', 'instagram-feed' ),
					'labelStrong'		=> 'true',
					'checkExtensionDimmed'	=> 'postStyling',
					'checkExtensionPopup' => 'postStyling',
					'separator'			=> 'bottom',
					'disabledInput'		=> true,
					'options'			=> [
						'enabled'	=> true,
						'disabled'	=> false
					]
				],
			];
		}
	}

	public static function get_customize_posts_nested_sections() {
		if ( self::$should_disable_pro_features ) {
			return array(
				'images_videos' => [
					'heading' 			=> __( 'Images and Videos', 'instagram-feed' ),
					'icon' 				=> 'picture',
					'isNested'			=> 'true',
					'separator'			=> 'none',
					'controls'			=> self::get_nested_images_videos_controls(),
				],
			);
		}
		return array(
			'post_style'        => array(
				'heading'   => __( 'Post Style', 'instagram-feed' ),
				'icon'      => 'color_scheme',
				'isNested'  => 'true',
				'separator' => 'none',
				'controls'  => self::get_nested_post_style_controls(),
			),
			'images_videos'        => array(
				'heading'   => __( 'Images and Videos', 'instagram-feed' ),
				'icon'      => 'picture',
				'isNested'  => 'true',
				'separator' => 'none',
				'controls'  => self::get_nested_images_videos_controls(),
			),
			'caption'              => array(
				'heading'     => __( 'Caption', 'instagram-feed' ),
				'description' => __( 'Customize caption text for your posts<br/><br/>', 'instagram-feed' ),
				'icon'        => 'caption',
				'isNested'    => 'true',
				'separator'   => 'none',
				'controls'    => self::get_nested_caption_controls(),
			),
			'like_comment_summary' => array(
				'heading'     => __( 'Like and Comment Summary', 'instagram-feed' ),
				'description' => __( 'The like and comment icons below each post<br/><br/>', 'instagram-feed' ),
				'icon'        => 'heart',
				'isNested'    => 'true',
				'separator'   => 'none',
				'controls'    => self::get_nested_like_comment_summary_controls(),
			),
			'hover_state'          => array(
				'heading'     => __( 'Hover State', 'instagram-feed' ),
				'description' => __( 'What\'s displayed when hovering over a post<br/><br/>', 'instagram-feed' ),
				'icon'        => 'cursor',
				'isNested'    => 'true',
				'separator'   => 'none',
				'controls'    => self::get_nested_hover_state_controls(),
			),
		);
	}

	/**
	 * Get Customize Tab Posts Section
	 * @since 6.0
	 * @return array
	 */
	public static function get_nested_images_videos_controls() {
		return array(
			array(
				'type'   => 'separator',
				'top'    => 20,
				'bottom' => 20,
			),
			array(
				'type'          => 'select',
				'id'            => 'imageres',
				'strongHeading' => 'true',
				'conditionHide' => true,
				'stacked'       => 'true',
				'heading'       => __( 'Resolution', 'instagram-feed' ),
				'description'   => __( 'By default we auto-detect image width and fetch a optimal resolution.', 'instagram-feed' ),
				'options'       => array(
					'auto'   => __( 'Auto-detect (recommended)', 'instagram-feed' ),
					'thumb'  => __( 'Thumbnail (150x150)', 'instagram-feed' ),
					'medium' => __( 'Medium (320x320)', 'instagram-feed' ),
					'full'   => __( 'Full size (640x640)', 'instagram-feed' ),
				),
			),
		);
	}

	/**
	 * Get Customize Tab Posts Section
	 * @since 6.0
	 * @return array
	 */
	public static function get_nested_caption_controls() {
		return array(
			array(
				'type'    => 'switcher',
				'id'      => 'showcaption',
				'label'   => __( 'Enable', 'instagram-feed' ),
				'reverse' => 'true',
				'stacked' => 'true',
				'condition' => array( 'layout' => array( 'grid', 'carousel', 'masonry' )),
				'options' => array(
					'enabled'  => true,
					'disabled' => false,
				),
			),
			array(
				'type'      => 'separator',
				'top'       => 15,
				'bottom'    => 15,
				'condition' => array(
					'showcaption' => array( true ),
					'layout' => array( 'grid', 'carousel', 'masonry' )
				),

			),
			array(
				'type'        => 'number',
				'id'          => 'captionlength',
				'condition'   => array(
					'showcaption' => array( true ),
					'layout' => array( 'grid', 'carousel', 'masonry' )
				),

				'stacked'     => 'true',
				'fieldSuffix' => 'characters',
				'heading'     => __( 'Maximum Text Length', 'instagram-feed' ),
				'description' => __( 'Caption will truncate after reaching the length', 'instagram-feed' ),
			),
			array(
				'type'      => 'separator',
				'top'       => 25,
				'bottom'    => 15,
				'condition' => array(
					'showcaption' => array( true ),
					'layout' => array( 'grid', 'carousel', 'masonry' )
				),
			),
			array(
				'type'      => 'heading',
				'condition' => array(
					'showcaption' => array( true ),
					'layout' => array( 'grid', 'carousel', 'masonry' )
				),

				'heading'   => __( 'Text', 'instagram-feed' ),
			),
			array(
				'type'          => 'select',
				'id'            => 'captionsize',
				'condition'     => array(
					'showcaption' => array( true ),
					'layout' => array( 'grid', 'carousel', 'masonry' )
				),
				'layout'        => 'half',
				'strongHeading' => 'false',
				'heading'       => __( 'Size', 'instagram-feed' ),
				'stacked'       => 'true',
				'style'         => array( '.sbi_caption_wrap .sbi_caption' => 'font-size:{{value}}px!important;' ),
				'options'       => SBI_Builder_Customizer_Tab::get_text_size_options(),
			),
			array(
				'type'          => 'colorpicker',
				'id'            => 'captioncolor',
				'condition'     => array(
					'showcaption' => array( true ),
					'layout' => array( 'grid', 'carousel', 'masonry' )
				),

				'layout'        => 'half',
				'strongHeading' => 'false',
				'heading'       => __( 'Color', 'instagram-feed' ),
				'style'         => array( '.sbi_caption_wrap .sbi_caption' => 'color:{{value}}!important;' ),
				'stacked'       => 'true',
			),

		);
	}

	/**
	 * Get Customize Tab Posts Section
	 * @since 6.0
	 * @return array
	 */
	public static function get_nested_like_comment_summary_controls() {
		return array(
			array(
				'type'    => 'switcher',
				'id'      => 'showlikes',
				'label'   => __( 'Enable', 'instagram-feed' ),
				'reverse' => 'true',
				'stacked' => 'true',
				'condition'     => array( 'layout' => array( 'grid', 'carousel', 'masonry' ) ),
				'options' => array(
					'enabled'  => true,
					'disabled' => false,
				),
			),
			array(
				'type'      => 'separator',
				'top'       => 15,
				'bottom'    => 15,
				'condition' => array(
					'showlikes' => array( true ),
					'layout' => array( 'grid', 'carousel', 'masonry' )
				),

			),
			array(
				'type'      => 'heading',
				'condition' => array(
					'showlikes' => array( true ),
					'layout' => array( 'grid', 'carousel', 'masonry' )
				),
				'heading'   => __( 'Icon', 'instagram-feed' ),
			),
			array(
				'type'          => 'select',
				'id'            => 'likessize',
				'condition'     =>  array(
					'showlikes' => array( true ),
					'layout' => array( 'grid', 'carousel', 'masonry' )
				),

				'layout'        => 'half',
				'strongHeading' => 'false',
				'heading'       => __( 'Size', 'instagram-feed' ),
				'stacked'       => 'true',
				'style'         => array( '.sbi_likes, .sbi_comments, .sbi_likes svg, .sbi_comments svg' => 'font-size:{{value}}px!important;' ),
				'options'       => SBI_Builder_Customizer_Tab::get_text_size_options(),
			),
			array(
				'type'          => 'colorpicker',
				'id'            => 'likescolor',
				'condition'     =>  array(
					'showlikes' => array( true ),
					'layout' => array( 'grid', 'carousel', 'masonry' )
				),
				'layout'        => 'half',
				'strongHeading' => 'false',
				'heading'       => __( 'Color', 'instagram-feed' ),
				'style'         => array( '.sbi_info_wrapper .sbi_likes svg, .sbi_info_wrapper .sbi_comments svg' => 'color:{{value}};' ),
				'stacked'       => 'true',
			),
		);
	}

	/**
	 * Get Customize Tab Posts Section
	 * @since 6.0
	 * @return array
	 */
	public static function get_nested_hover_state_controls() {
		return array(
			array(
				'type'          => 'colorpicker',
				'id'            => 'hovercolor',
				'icon'          => 'background',
				'layout'        => 'half',
				'strongHeading' => 'false',
				'heading'       => __( 'Background', 'instagram-feed' ),
				'style'         => array( '.sbi_link' => 'background:{{value}}!important;' ),
				'stacked'       => 'true',
			),
			array(
				'type'          => 'colorpicker',
				'id'            => 'hovertextcolor',
				'icon'          => 'text',
				'layout'        => 'half',
				'strongHeading' => 'false',
				'heading'       => __( 'Text', 'instagram-feed' ),
				'style'         => array( '.sbi_photo_wrap .sbi_username > a, .sbi_photo_wrap .sbi_caption,.sbi_photo_wrap .sbi_instagram_link,.sbi_photo_wrap .sbi_hover_bottom,.sbi_photo_wrap .sbi_location,.sbi_photo_wrap .sbi_meta,.sbi_photo_wrap .sbi_comments' => 'color:{{value}}!important;' ),
				'stacked'       => 'true',
			),
			array(
				'type'    => 'heading',
				'heading' => __( 'Information to display', 'instagram-feed' ),
			),
			array(
				'type'    => 'checkboxlist',
				'id'      => 'hoverdisplay',
				'options' => array(
					array(
						'value' => 'username',
						'label' => __( 'Username', 'instagram-feed' ),
					),
					array(
						'value' => 'date',
						'label' => __( 'Date', 'instagram-feed' ),
					),
					array(
						'value' => 'instagram',
						'label' => __( 'Instagram Icon', 'instagram-feed' ),
					),
					array(
						'value' => 'caption',
						'label' => __( 'Caption', 'instagram-feed' ),
					),
					array(
						'value' => 'likes',
						'label' => __( 'Like/Comment Icons<br/>(Business account only)', 'instagram-feed' ),
					),
				),
				'reverse' => 'true',
			),
			array(
				'type'      => 'separator',
				'top'       => 15,
				'bottom'    => 15,
				'condition'     => array(
					'hoverdisplay' => 'caption',
				),
			
			),
			array(
				'type'        => 'number',
				'id'          => 'hovercaptionlength',
				'stacked'     => 'true',
				'fieldSuffix' => 'characters',
				'heading'     => __( 'Maximum Caption Length', 'instagram-feed' ),
				'description' => __( 'Caption will truncate after reaching the length', 'instagram-feed' ),
				'condition'     => array(
					'hoverdisplay' => 'caption',
				),
			)
		);
	}

	/**
	 * Get Customize Tab Load More Button Section
	 * @since 6.0
	 * @return array
	 */
	public static function get_customize_loadmorebutton_controls() {
		$controls = array(
			array(
				'type'    => 'switcher',
				'id'      => 'showbutton',
				'label'   => __( 'Enable', 'instagram-feed' ),
				'reverse' => 'true',
				'stacked' => 'true',
				'options' => array(
					'enabled'  => true,
					'disabled' => false,
				),
			),
			array(
				'type'      => 'separator',
				'condition' => array( 'showbutton' => array( true ) ),
				'top'       => 20,
				'bottom'    => 5,
			),
			array(
				'type'          => 'text',
				'id'            => 'buttontext',
				'condition'     => array( 'showbutton' => array( true ) ),

				'strongHeading' => 'true',
				'heading'       => __( 'Text', 'instagram-feed' ),
			),
			array(
				'type'      => 'separator',
				'condition' => array( 'showbutton' => array( true ) ),
				'top'       => 15,
				'bottom'    => 15,
			),
			array(
				'type'      => 'heading',
				'heading'   => __( 'Color', 'instagram-feed' ),
				'condition' => array( 'showbutton' => array( true ) ),
			),
			array(
				'type'          => 'colorpicker',
				'id'            => 'buttoncolor',
				'condition'     => array( 'showbutton' => array( true ) ),
				'layout'        => 'half',
				'icon'          => 'background',
				'strongHeading' => 'false',
				'heading'       => __( 'Background', 'instagram-feed' ),
				'style'         => array( '.sbi_load_btn' => 'background:{{value}}!important;' ),
				'stacked'       => 'true',
			),
			array(
				'type'          => 'colorpicker',
				'id'            => 'buttonhovercolor',
				'condition'     => array( 'showbutton' => array( true ) ),
				'layout'        => 'half',
				'icon'          => 'cursor',
				'strongHeading' => 'false',
				'heading'       => __( 'Hover State', 'instagram-feed' ),
				'style'         => array( '.sbi_load_btn:hover' => 'background:{{value}}!important;' ),
				'stacked'       => 'true',
			),
			array(
				'type'          => 'colorpicker',
				'id'            => 'buttontextcolor',
				'condition'     => array( 'showbutton' => array( true ) ),
				'layout'        => 'half',
				'icon'          => 'text',
				'strongHeading' => 'false',
				'heading'       => __( 'Text', 'instagram-feed' ),
				'style'         => array( '.sbi_load_btn' => 'color:{{value}}!important;' ),
				'stacked'       => 'true',
			),
			array(
				'type'      => 'separator',
				'condition' => array( 'showbutton' => array( true ) ),
				'top'       => 15,
				'bottom' 	=> 5,
			)
		);

		if ( self::$should_disable_pro_features ) {
			$controls[] = array(
				'type' 				=> 'heading',
				'heading' 			=> __( 'Advanced', 'instagram-feed' ),
				'condition' => array( 'showbutton' => array( true ) ),
				'proLabel'		=> true,
				'checkExtensionPopupLearnMore' 	=> 'postStyling',
				'utmLink' => 'https://smashballoon.com/instagram-feed/demo/?utm_campaign=instagram-free&utm_source=customizer&utm_medium=load-more',
				'description' 	=> __( 'These properties are available in the PRO version.', 'instagram-feed' )
			);
			$controls[] = array(
				'type' 				=> 'separator',
				'condition' => array( 'showbutton' => array( true ) ),
				'conditionHide' => true,
				'top' 				=> 30,
				'bottom' 			=> 10,
			);
		}
		$controls[] = array(
			'type'        => 'switcher',
			'id'          => 'autoscroll',
			'condition'   => array( 'showbutton' => array( true ) ),
			'switcherTop' => true,
			'checkExtensionDimmed' => !self::$should_disable_pro_features ? false : 'postStyling',
			'checkExtensionPopup' => !self::$should_disable_pro_features ? false : 'postStyling',
			'utmLink' => !self::$should_disable_pro_features ? false : 'https://smashballoon.com/instagram-feed/demo/?utm_campaign=instagram-free&utm_source=customizer&utm_medium=load-more',
			'heading'     => __( 'Infinite Scroll', 'instagram-feed' ),
			'description' => __( 'This will load more posts automatically when the users reach the end of the feed', 'instagram-feed' ),
			'stacked'     => 'true',
			'labelStrong' => 'true',
			'layout'      => 'half',
			'reverse'     => 'true',
			'options'     => array(
				'enabled'  => true,
				'disabled' => false,
			),
		);
		$controls[] = array(
			'type'          => 'number',
			'id'            => 'autoscrolldistance',
			'condition'     => array(
				'showbutton' => array( true ),
				'autoscroll' => array( 'true' ),
			),
			'conditionHide' => true,
			'strongHeading' => false,
			'stacked'       => 'true',
			'layout'        => 'half',
			'placeholder'   => '200',
			'child'         => true,
			'fieldSuffix'   => 'px',
			'heading'       => __( 'Trigger Distance', 'instagram-feed' ),
		);

		return $controls;
	}

	/**
	 * Get Customize Tab Follow Button Section
	 * @since 6.0
	 * @return array
	 */
	public static function get_customize_followbutton_controls() {
		return array(
			array(
				'type'    => 'switcher',
				'id'      => 'showfollow',
				'label'   => __( 'Enable', 'instagram-feed' ),
				'reverse' => 'true',
				'stacked' => 'true',
				'options' => array(
					'enabled'  => true,
					'disabled' => false,
				),
			),
			array(
				'type'      => 'separator',
				'condition' => array( 'showfollow' => array( true ) ),
				'top'       => 20,
				'bottom'    => 5,
			),
			array(
				'type'          => 'text',
				'id'            => 'followtext',
				'condition'     => array( 'showfollow' => array( true ) ),

				'strongHeading' => 'true',
				'heading'       => __( 'Text', 'instagram-feed' ),
			),
			array(
				'type'      => 'separator',
				'condition' => array( 'showfollow' => array( true ) ),
				'top'       => 15,
				'bottom'    => 15,
			),
			array(
				'type'      => 'heading',
				'heading'   => __( 'Color', 'instagram-feed' ),
				'condition' => array( 'showfollow' => array( true ) ),
			),
			array(
				'type'          => 'colorpicker',
				'id'            => 'followcolor',
				'condition'     => array( 'showfollow' => array( true ) ),
				'layout'        => 'half',
				'icon'          => 'background',
				'strongHeading' => 'false',
				'heading'       => __( 'Background', 'instagram-feed' ),
				'style'         => array( '.sbi_follow_btn a' => 'background:{{value}}!important;' ),
				'stacked'       => 'true',
			),
			array(
				'type'          => 'colorpicker',
				'id'            => 'followhovercolor',
				'condition'     => array( 'showfollow' => array( true ) ),
				'layout'        => 'half',
				'icon'          => 'cursor',
				'strongHeading' => 'false',
				'heading'       => __( 'Hover State', 'instagram-feed' ),
				'style'         => array( '.sbi_follow_btn a:hover' => 'box-shadow:inset 0 0 10px 20px {{value}}!important;' ),
				'stacked'       => 'true',
			),
			array(
				'type'          => 'colorpicker',
				'id'            => 'followtextcolor',
				'condition'     => array( 'showbutton' => array( true ) ),
				'layout'        => 'half',
				'icon'          => 'text',
				'strongHeading' => 'false',
				'heading'       => __( 'Text', 'instagram-feed' ),
				'style'         => array( '.sbi_follow_btn a' => 'color:{{value}}!important;' ),
				'stacked'       => 'true',
			),
		);
	}


	/**
	 * Get Customize Tab LightBox Section
	 * @since 6.0
	 * @return array
	 */
	public static function get_customize_lightbox_controls() {
		$controls = array(
			array(
				'type'    => 'switcher',
				'id'      => 'disablelightbox',
				'label'   => __( 'Enable', 'instagram-feed' ),
				'reverse' => 'true',
				'stacked' => 'true',
				'checkExtensionDimmed'	=> !self::$should_disable_pro_features ? false : 'lightbox',
				'checkExtensionPopup' => !self::$should_disable_pro_features ? false : 'lightbox',
				'options' => array(
					'enabled'  => false,
					'disabled' => true,
				),
			),
			array(
				'type'      => 'separator',
				'condition' => array( 'disablelightbox' => array( false ) ),
				'top'       => 20,
				'bottom'    => 5,
			),
			array(
				'type'        => 'switcher',
				'id'          => 'lightboxcomments',
				'condition'   => array( 'disablelightbox' => array( false ) ),
				'switcherTop' => true,
				'checkExtensionDimmed'	=> !self::$should_disable_pro_features ? false : 'lightbox',
				'checkExtensionPopup' => !self::$should_disable_pro_features ? false : 'lightbox',
				'heading'     => __( 'Comments', 'instagram-feed' ),
				'tooltip'     => __( 'Display comments for your posts inside the lightbox. Comments are only available for User feeds from Business accounts.', 'instagram-feed' ),
				'stacked'     => 'true',
				'labelStrong' => 'true',
				'layout'      => 'half',
				'reverse'     => 'true',
				'options'     => array(
					'enabled'  => true,
					'disabled' => false,
				),
			),
			array(
				'type'                => 'number',
				'id'                  => 'numcomments',
				'condition'           => array(
					'disablelightbox'  => array( false ),
					'lightboxcomments' => array( true ),
				),
				'conditionHide'       => true,
				'strongHeading'       => false,
				'stacked'             => 'true',
				'placeholder'         => '20',
				'child'               => true,
				'fieldSuffixAction'   => 'clearCommentCache',
				'checkExtensionDimmed'	=> !self::$should_disable_pro_features ? false : 'lightbox',
				'checkExtensionPopup' => !self::$should_disable_pro_features ? false : 'lightbox',
				'fieldSuffix'         => 'Clear Cache',
				'heading'             => __( 'No. of Comments', 'instagram-feed' ),
				'description'         => __( 'Clearing cache will remove all the saved comments in the database', 'instagram-feed' ),
				'descriptionPosition' => 'bottom',
			),
		);

		if ( self::$should_disable_pro_features ) {
			$pro_notice_control = array(
				'type'      => 'separator',
				'condition' => array( 'disablelightbox' => array( false ) ),
				'top'       => 15,
				'bottom'    => 20,
			);
			
			array_unshift( $controls, $pro_notice_control );
		}

		return $controls;
	}

	/**
	 * Get Customize Tab `Post Style` Nested Section
	 *
	 * @since INSTA_FEED_PRO_SINCE
	 *
	 * @return array
	 */
	static function get_nested_post_style_controls() {
		return array(
			array(
				'type'    => 'toggleset',
				'id'      => 'poststyle',
				'heading' => __( 'Post Type', 'instagram-feed' ),
				'options' => array(
					array(
						'value' => 'boxed',
						'icon'  => 'boxed',
						'label' => __( 'Boxed', 'instagram-feed' )
					),
					array(
						'value' => 'regular',
						'icon'  => 'thumbnail',
						'label' => __( 'Regular', 'instagram-feed' )
					)
				)
			),
			array(
				'type'   => 'separator',
				'top'    => 10,
				'bottom' => 10,
			),
			array(
				'type'          => 'heading',
				'condition'     => array( 'poststyle' => array( 'boxed' ) ),
				'conditionHide' => true,
				'heading'       => __( 'Individual Properties', 'instagram-feed' ),
			),
			array(
				'type'          => 'colorpicker',
				'id'            => 'postbgcolor',
				'condition'     => array( 'poststyle' => array( 'boxed' ) ),
				'conditionHide' => true,
				'layout'        => 'half',
				'icon'          => 'background',
				'strongHeading' => 'false',
				'heading'       => __( 'Background', 'instagram-feed' ),
				'style'         => array( '.sbi_inner_wrap' => 'background:{{value}};' ),
				'stacked'       => 'true'
			),
			array(
				'type'          => 'number',
				'id'            => 'postcorners',
				'condition'     => array( 'poststyle' => array( 'boxed' ) ),
				'conditionHide' => true,
				'fieldSuffix'   => 'px',
				'layout'        => 'half',
				'icon'          => 'corner',
				'strongHeading' => 'false',
				'heading'       => __( 'Border Radius', 'instagram-feed' ),
				'style'         => array( '.sbi_inner_wrap' => 'border-radius: {{value}}px;' ),
				'stacked'       => 'true'
			),
			array(
				'type'          => 'separator',
				'top'           => 10,
				'condition'     => array( 'poststyle' => array( 'boxed' ) ),
				'conditionHide' => true,
				'bottom'        => 5,
			),
			array(
				'type'          => 'checkbox',
				'id'            => 'boxshadow',
				'condition'     => array( 'poststyle' => array( 'boxed' ) ),
				'conditionHide' => true,
				'label'         => __( 'Box Shadow', 'instagram-feed' ),
				'options'       => array(
					'enabled'  => 'on',
					'disabled' => 'off'
				),
				'stacked'       => 'true'
			),
		);
	}

}
