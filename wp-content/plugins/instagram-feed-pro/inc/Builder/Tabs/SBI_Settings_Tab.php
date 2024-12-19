<?php
/**
 * Customizer Tab
 *
 * @since 4.0
 */
namespace InstagramFeed\Builder\Tabs;

use InstagramFeed\Helpers\Util;
use InstagramFeed\Builder\SBI_Feed_Builder;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


class SBI_Settings_Tab {

	public static $should_disable_pro_features = false;

	/**
	 * Get Customize Tab Sections
	 *
	 * @since 4.0
	 * @access public
	 *
	 * @return array
	 */
	public static function get_sections() {
		self::$should_disable_pro_features = sbi_builder_pro()->license_service->should_disable_pro_features;

		return array(
			'settings_feedtype'           => array(
				'heading'  => __( 'Sources', 'instagram-feed' ),
				'icon'     => 'source',
				'controls' => self::get_settings_sources_controls(),
			),
			'settings_filters_moderation' => array(
				'heading'             => __( 'Filters and Moderation', 'instagram-feed' ),
				'icon'                => 'filter',
				'separator'           => 'none',
				'description'         => ! self::$should_disable_pro_features ? '' : __( 'Visually moderate your feed or hide specific posts with Instagram Feed Pro.', 'instagram-feed' ),
				'checkExtensionPopup' => ! self::$should_disable_pro_features ? null : 'filtermoderation',
				'proLabel'            => ! self::$should_disable_pro_features ? false : true,
				'controls'            => self::get_settings_filters_moderation_controls(),
			),
			'settings_sort'               => array(
				'heading'  => __( 'Sort', 'instagram-feed' ),
				'icon'     => 'sort',
				'controls' => self::get_settings_sort_controls(),
			),
			'settings_shoppable_feed'     => array(
				'heading'   => __( 'Shoppable Feed', 'instagram-feed' ),
				'icon'      => 'shop',
				'separator' => 'none',
				'controls'  => self::get_settings_shoppable_feed_controls(),
			),
			'empty_sections'              => array(
				'heading'  => '',
				'isHeader' => true,
			),
			'settings_advanced'           => array(
				'heading'  => __( 'Advanced', 'instagram-feed' ),
				'icon'     => 'cog',
				'controls' => self::get_settings_advanced_controls(),
			),
		);
	}




	/**
	 * Get Settings Tab Filters & Moderation Section
	 *
	 * @since 4.0
	 * @return array
	 */
	public static function get_settings_filters_moderation_controls() {
		return array(
			array(
				'type'                 => 'customview',
				'viewId'               => 'moderationmode',
				'checkExtensionDimmed' => ! self::$should_disable_pro_features ? null : 'filtermoderation',
				'checkExtensionPopup'  => ! self::$should_disable_pro_features ? null : 'filtermoderation',
				'switcher'             => array(
					'id'          => 'enablemoderationmode',
					'label'       => __( 'Enable', 'instagram-feed' ),
					'reverse'     => 'true',
					'stacked'     => 'true',
					'labelStrong' => true,
					'options'     => array(
						'enabled'  => true,
						'disabled' => false,
					),
				),
				'moderationTypes'      => array(
					'allow' => array(
						'label'       => __( 'Allow List', 'instagram-feed' ),
						'description' => __( 'Hides post by default so you can select the ones you want to show', 'instagram-feed' ),
					),
					'block' => array(
						'label'       => __( 'Block List', 'instagram-feed' ),
						'description' => __( 'Show all posts by default so you can select the ones you want to hide', 'instagram-feed' ),
					),
				),
			),
			array(
				'type'              => 'separator',
				'top'               => 10,
				'bottom'            => 10,
				'checkViewDisabled' => 'moderationMode',
			),
			array(
				'type'                 => 'heading',
				'strongHeading'        => 'true',
				'heading'              => __( 'Filters', 'instagram-feed' ),
				'checkExtensionDimmed' => ! self::$should_disable_pro_features ? false : 'filtermoderation',
				'checkExtensionPopup'  => ! self::$should_disable_pro_features ? false : 'filtermoderation',
				'checkViewDisabled'    => 'moderationMode',
			),
			array(
				'type'                 => 'textarea',
				'id'                   => 'includewords',
				'ajaxAction'           => 'feedFlyPreview',
				'heading'              => __( 'Only show posts containing', 'instagram-feed' ),
				'tooltip'              => __( 'Only show posts which contain certain words or hashtags in the caption. For example, adding "sheep, cow, dog" will show any photos which contain either the word sheep, cow, or dog. You can separate multiple words or hashtags using commas.', 'instagram-feed' ),
				'placeholder'          => __( 'Add words here to only show posts containing these words', 'instagram-feed' ),
				'checkExtensionDimmed' => ! self::$should_disable_pro_features ? false : 'filtermoderation',
				'checkExtensionPopup'  => ! self::$should_disable_pro_features ? false : 'filtermoderation',
				'checkViewDisabled'    => 'moderationMode',
			),

			array(
				'type'                 => 'textarea',
				'id'                   => 'excludewords',
				'disabledInput'        => true,
				'heading'              => __( 'Do not show posts containing', 'instagram-feed' ),
				'tooltip'              => __( 'Remove any posts containing these text strings, separating multiple strings using commas.', 'instagram-feed' ),
				'placeholder'          => __( 'Add words here to hide any posts containing these words', 'instagram-feed' ),
				'checkViewDisabled'    => 'moderationMode',
				'checkExtensionDimmed' => ! self::$should_disable_pro_features ? false : 'filtermoderation',
				'checkExtensionPopup'  => ! self::$should_disable_pro_features ? false : 'filtermoderation',
				'ajaxAction'           => 'feedFlyPreview',
			),

			array(
				'type'                 => 'heading',
				'strongHeading'        => 'true',
				'stacked'              => 'true',
				'heading'              => __( 'Show specific types of posts', 'instagram-feed' ),
				'checkViewDisabled'    => 'moderationMode',
				'checkExtensionDimmed' => ! self::$should_disable_pro_features ? false : 'filtermoderation',
				'checkExtensionPopup'  => ! self::$should_disable_pro_features ? false : 'filtermoderation',
			),

			array(
				'type'                 => 'checkbox',
				'id'                   => 'photosposts',
				'label'                => __( 'Photos', 'instagram-feed' ),
				'reverse'              => 'true',
				'stacked'              => 'true',
				'checkViewDisabled'    => 'moderationMode',
				'ajaxAction'           => 'feedFlyPreview',
				'checkExtensionDimmed' => ! self::$should_disable_pro_features ? false : 'filtermoderation',
				'checkExtensionPopup'  => ! self::$should_disable_pro_features ? false : 'filtermoderation',
				'options'              => array(
					'enabled'  => true,
					'disabled' => false,
				),
			),

			array(
				'type'                 => 'checkbox',
				'id'                   => 'videosposts',
				'label'                => __( 'Feed Videos', 'instagram-feed' ),
				'reverse'              => 'true',
				'stacked'              => 'true',
				'checkViewDisabled'    => 'moderationMode',
				'ajaxAction'           => 'feedFlyPreview',
				'checkExtensionDimmed' => ! self::$should_disable_pro_features ? false : 'filtermoderation',
				'checkExtensionPopup'  => ! self::$should_disable_pro_features ? false : 'filtermoderation',
				'options'              => array(
					'enabled'  => true,
					'disabled' => false,
				),
			),

			array(
				'type'                 => 'checkbox',
				'id'                   => 'reelsposts',
				'label'                => __( 'Reels', 'instagram-feed' ),
				'reverse'              => 'true',
				'stacked'              => 'true',
				'checkViewDisabled'    => 'moderationMode',
				'ajaxAction'           => 'feedFlyPreview',
				'checkExtensionDimmed' => ! self::$should_disable_pro_features ? false : 'filtermoderation',
				'checkExtensionPopup'  => ! self::$should_disable_pro_features ? false : 'filtermoderation',
				'options'              => array(
					'enabled'  => true,
					'disabled' => false,
				),
			),

			array(
				'type'                 => 'separator',
				'top'                  => 26,
				'bottom'               => 15,
				'checkViewDisabled'    => 'moderationMode',
				'checkExtensionDimmed' => ! self::$should_disable_pro_features ? false : 'filtermoderation',
				'checkExtensionPopup'  => ! self::$should_disable_pro_features ? false : 'filtermoderation',
			),

			array(
				'type'                 => 'number',
				'id'                   => 'offset',
				'strongHeading'        => 'true',
				'stacked'              => 'true',
				'placeholder'          => '0',
				'fieldSuffix'          => 'posts',
				'heading'              => __( 'Post Offset', 'instagram-feed' ),
				'description'          => __( 'This will skip the specified number of posts from displaying in the feed', 'instagram-feed' ),
				'checkViewDisabled'    => 'moderationMode',
				'ajaxAction'           => 'feedFlyPreview',
				'checkExtensionDimmed' => ! self::$should_disable_pro_features ? false : 'filtermoderation',
				'checkExtensionPopup'  => ! self::$should_disable_pro_features ? false : 'filtermoderation',
			),

		);
	}


	/**
	 * Get Settings Tab Sort Section
	 *
	 * @since 4.0
	 * @return array
	 */
	public static function get_settings_sort_controls() {
		return array(
			array(
				'type'          => 'toggleset',
				'id'            => 'sortby',
				'heading'       => __( 'Sort Posts by', 'instagram-feed' ),
				'strongHeading' => 'true',
				'ajaxAction'    => 'feedFlyPreview',
				'options'       => array(
					array(
						'value' => 'none',
						'label' => __( 'Newest', 'instagram-feed' ),
					),
					array(
						'value'          => 'likes',
						'label'          => __( 'Likes', 'instagram-feed' ),
						'checkExtension' => ! self::$should_disable_pro_features ? null : 'postStyling',
						'utmLink'        => ! self::$should_disable_pro_features ? null : 'https://smashballoon.com/instagram-feed/demo/?utm_campaign=instagram-free&utm_source=customizer&utm_medium=load-more',
						'proLabel'       => ! self::$should_disable_pro_features ? null : true,
						'condition'      => array( 'type' => array( 'mixed', 'user', 'tagged' ) ),
					),
					array(
						'value' => 'random',
						'label' => __( 'Random', 'instagram-feed' ),
					),
				),
			),
		);
	}


	/**
	 * Get Settings Tab Shoppable Feed Section
	 *
	 * @since 4.0
	 * @return array
	 */
	public static function get_settings_shoppable_feed_controls() {
		return array(
			array(
				'type'                 => 'switcher',
				'id'                   => 'shoppablefeed',
				'label'                => __( 'Enable', 'instagram-feed' ),
				'reverse'              => 'true',
				'stacked'              => 'true',
				'checkExtensionPopup'  => ! self::$should_disable_pro_features ? false : 'shoppablefeed',
				'checkExtensionDimmed' => ! self::$should_disable_pro_features ? false : 'shoppablefeed',
				'options'              => array(
					'enabled'  => true,
					'disabled' => false,
				),
			),
			array(
				'type'          => 'customview',
				'condition'     => array( 'shoppablefeed' => array( false ) ),
				'conditionHide' => true,
				'viewId'        => 'shoppabledisabled',
			),
			array(
				'type'          => 'customview',
				'condition'     => array( 'shoppablefeed' => array( true ) ),
				'conditionHide' => true,
				'viewId'        => 'shoppableenabled',
			),
			array(
				'type'          => 'customview',
				'condition'     => array( 'shoppablefeed' => array( true ) ),
				'conditionHide' => true,
				'viewId'        => 'shoppableselectedpost',
			),

		);
	}


	/**
	 * Get Settings Tab Advanced Section
	 *
	 * @since 4.0
	 * @return array
	 */
	public static function get_settings_advanced_controls() {
		return array(
			array(
				'type'          => 'number',
				'id'            => 'maxrequests',
				'strongHeading' => 'true',
				'heading'       => __( 'Max Concurrent API Requests', 'instagram-feed' ),
				'description'   => __( 'Change the number of maximum concurrent API requests. Not recommended unless directed by the support team.', 'instagram-feed' ),
			),
			array(
				'type'                => 'switcher',
				'id'                  => 'customtemplates',
				'label'               => __( 'Custom Templates', 'instagram-feed' ),
				'description'         => sprintf( __( 'The default HTML for the feed can be replaced with custom templates added to your theme\'s folder. Enable this setting to use these templates. Custom templates are not used in the feed editor. %1$sLearn More%2$s', 'instagram-feed' ), '<a href="https://smashballoon.com/guide-to-creating-custom-templates/?utm_source=plugin-pro&utm_campaign=sbi&utm_medium=customizer" target="_blank">', '</a>' ),
				'descriptionPosition' => 'bottom',
				'reverse'             => 'true',
				'strongHeading'       => 'true',
				'labelStrong'         => 'true',
				'options'             => array(
					'enabled'  => true,
					'disabled' => false,
				),
			),
			array(
				'type'                => 'switcher',
				'id'                  => 'mediavine',
				'label'               => __( 'Enable MediaVine Integration', 'instagram-feed' ),
				'description'         => sprintf( __( 'This will enable our feature to automatically add "hints" to your feeds HTML that allows MediaVine to insert ads. This feature is meant only for MediaVine ad network users. %1$sLearn More%2$s', 'instagram-feed' ), '<a href="https://smashballoon.com/doc/how-do-i-integrate-mediavine-ads/" target="_blank">', '</a>' ),
				'descriptionPosition' => 'bottom',
				'reverse'             => 'true',
				'strongHeading'       => 'true',
				'labelStrong'         => 'true',
				'options'             => array(
					'enabled'  => true,
					'disabled' => false,
				),
			),

		);
	}

	/**
	 * Get Settings TabSources Section
	 *
	 * @since 6.0
	 * @return array
	 */
	public static function get_settings_sources_controls() {
		return array(
			array(
				'type'   => 'customview',
				'viewId' => 'sources',
			),
		);
	}

}
