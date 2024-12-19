<?php
namespace TheplusAddons;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

Class L_WPML {
	
	/**
	 * A reference to an instance of this class.
	 *
	 * @since 1.0.0
	 * @var   object
	 */
	private static $instance = null;
	
    public function plus_translate_widgets($widgets)
    {
		 $widgets['tp-adv-text-block'] = [
            'conditions' => ['widgetType' => 'tp-adv-text-block'],
            'fields' => [
                [
                    'field'       => 'content_description',
                    'type'        => esc_html__('Advanced Text Block Description', 'tpebl'),
                    'editor_type' => 'VISUAL',
                ]
            ],
        ];		
		$widgets['tp-blockquote'] = [
            'conditions' => ['widgetType' => 'tp-blockquote'],
            'fields' => [
                [
                    'field'       => 'content_description',
                    'type'        => esc_html__('Quote Description', 'tpebl'),
                    'editor_type' => 'VISUAL',
                ],
				[
                    'field'       => 'quote_author',
                    'type'        => esc_html__('Quote Author', 'tpebl'),
                    'editor_type' => 'LINE',
                ]
            ],
        ];
		$widgets['tp-blog-listout'] = [
            'conditions' => ['widgetType' => 'tp-blog-listout'],
            'fields' => [
                [
                    'field'       => 'button_text',
                    'type'        => esc_html__('Blog Listout Button Text', 'tpebl'),
                    'editor_type' => 'LINE',
                ],
				[
                    'field'       => 'all_filter_category',
                    'type'        => esc_html__('Blog Listout All Filter Category Text', 'tpebl'),
                    'editor_type' => 'LINE',
                ],
				[
                    'field'       => 'load_more_btn_text',
                    'type'        => esc_html__('Blog Listout Button Text', 'tpebl'),
                    'editor_type' => 'LINE',
                ],
				[
                    'field'       => 'tp_loading_text',
                    'type'        => esc_html__('Dynamic Listing Loading Text', 'tpebl'),
                    'editor_type' => 'LINE',
                ],
				[
                    'field'       => 'loaded_posts_text',
                    'type'        => esc_html__('Blog Listout All Posts Loaded Text', 'tpebl'),
                    'editor_type' => 'LINE',
                ]
            ],
        ];
		$widgets['tp-button'] = [
            'conditions' => ['widgetType' => 'tp-button'],
            'fields' => [
                [
                    'field'       => 'button_text',
                    'type'        => esc_html__('Button Text', 'tpebl'),
                    'editor_type' => 'LINE',
                ],
				[
                    'field'       => 'button_24_text',
                    'type'        => esc_html__('Button Tag Text', 'tpebl'),
                    'editor_type' => 'LINE',
                ],
				[
                    'field'       => 'button_hover_text',
                    'type'        => esc_html__('Button Hover Text', 'tpebl'),
                    'editor_type' => 'LINE',
                ],
				 [
                    'field'       => 'plus_tooltip_content_desc',
                    'type'        => esc_html__('Button Tooltip Content', 'tpebl'),
                    'editor_type' => 'AREA',
                ],
				[
                    'field'       => 'plus_tooltip_content_wysiwyg',
                    'type'        => esc_html__('Button Tooltip Content', 'tpebl'),
                    'editor_type' => 'VISUAL',
                ]
            ],
        ];
		$widgets['tp-countdown'] = [
            'conditions' => ['widgetType' => 'tp-countdown'],
            'fields' => [
                [
                    'field'       => 'text_days',
                    'type'        => esc_html__('Countdown Days Section Text', 'tpebl'),
                    'editor_type' => 'LINE',
                ],
				[
                    'field'       => 'text_hours',
                    'type'        => esc_html__('Countdown Hours Section Text', 'tpebl'),
                    'editor_type' => 'LINE',
                ],
				[
                    'field'       => 'text_minutes',
                    'type'        => esc_html__('Countdown Minutes Section Text', 'tpebl'),
                    'editor_type' => 'LINE',
                ],
				[
                    'field'       => 'text_seconds',
                    'type'        => esc_html__('Countdown Seconds Section Text', 'tpebl'),
                    'editor_type' => 'LINE',
                ]
            ],
        ];
		$widgets['tp-clients-listout'] = [
            'conditions' => ['widgetType' => 'tp-clients-listout'],
            'fields' => [
                [
                    'field'       => 'all_filter_category',
                    'type'        => esc_html__('Clients Listout All Filter Category Text', 'tpebl'),
                    'editor_type' => 'LINE',
                ],
				[
                    'field'       => 'load_more_btn_text',
                    'type'        => esc_html__('Clients Listout Button Text', 'tpebl'),
                    'editor_type' => 'LINE',
                ],
				[
                    'field'       => 'tp_loading_text',
                    'type'        => esc_html__('Dynamic Listing Loading Text', 'tpebl'),
                    'editor_type' => 'LINE',
                ],
				[
                    'field'       => 'loaded_posts_text',
                    'type'        => esc_html__('Clients Listout All Posts Loaded Text', 'tpebl'),
                    'editor_type' => 'LINE',
                ]
            ],
        ];
		$widgets['tp-header-extras'] = [
            'conditions' => ['widgetType' => 'tp-header-extras'],
            'fields' => [
                [
                    'field'       => 'search_placeholder_text',
                    'type'        => esc_html__('Header Extras Search Placeholder Text', 'tpebl'),
                    'editor_type' => 'LINE',
                ],
				[
                    'field'       => 'cart_offer_text',
                    'type'        => esc_html__('Header Extras Mini Cart Offer Text', 'tpebl'),
                    'editor_type' => 'LINE',
                ],
				[
                    'field'       => 'button_1_text',
                    'type'        => esc_html__('Header Extras Button Text 1', 'tpebl'),
                    'editor_type' => 'LINE',
                ],
				[
                    'field'       => 'button_2_text',
                    'type'        => esc_html__('Header Extras Button Text 2', 'tpebl'),
                    'editor_type' => 'LINE',
                ]
            ],
        ];
		$widgets['tp-heading-animation'] = [
            'conditions' => ['widgetType' => 'tp-heading-animation'],
            'fields' => [
                [
                    'field'       => 'prefix',
                    'type'        => esc_html__('Heading Animation Prefix Text', 'tpebl'),
                    'editor_type' => 'LINE',
                ],
				[
                    'field'       => 'ani_title',
                    'type'        => esc_html__('Heading Animation Animated Text', 'tpebl'),
                    'editor_type' => 'AREA',
                ],
				[
                    'field'       => 'postfix',
                    'type'        => esc_html__('Heading Animation Postfix Text', 'tpebl'),
                    'editor_type' => 'LINE',
                ]
            ],
        ];
		$widgets['tp-heading-title'] = [
            'conditions' => ['widgetType' => 'tp-heading-title'],
            'fields' => [
                [
                    'field'       => 'title',
                    'type'        => esc_html__('Heading Title', 'tpebl'),
                    'editor_type' => 'LINE',
                ],
				[
                    'field'       => 'sub_title',
                    'type'        => esc_html__('Heading Sub Title', 'tpebl'),
                    'editor_type' => 'LINE',
                ],
				[
                    'field'       => 'title_s',
                    'type'        => esc_html__('Heading Extra Title', 'tpebl'),
                    'editor_type' => 'LINE',
                ]
            ],
        ];
		$widgets['tp-navigation-menu-lite'] = [
            'conditions' => ['widgetType' => 'tp-navigation-menu-lite'],
            'fields' => [
                [
                    'field'       => 'vertical_side_title_text',
                    'type'        => esc_html__('Navigation Menu Title', 'tpebl'),
                    'editor_type' => 'LINE',
                ]
            ],
        ];
		$widgets['tp-number-counter'] = [
            'conditions' => ['widgetType' => 'tp-number-counter'],
            'fields' => [
                [
                    'field'       => 'title',
                    'type'        => esc_html__('Number Counter Title', 'tpebl'),
                    'editor_type' => 'LINE',
                ]
            ],
        ];
		$widgets['tp-page-scroll'] = [
            'conditions' => ['widgetType' => 'tp-page-scroll'],
            'fields' => [
                [
                    'field'       => 'nav_dots_tooltips',
                    'type'        => esc_html__('Page Scroll Dots Tooltips Text', 'tpebl'),
                    'editor_type' => 'LINE',
                ],
				[
                    'field'       => 'dots_tooltips',
                    'type'        => esc_html__('Page Scroll Dots Tooltips Text', 'tpebl'),
                    'editor_type' => 'LINE',
                ],
				[
                    'field'       => 'nxt_txt',
                    'type'        => esc_html__('Page Scroll Next Button Text', 'tpebl'),
                    'editor_type' => 'LINE',
                ],
				[
                    'field'       => 'prev_txt',
                    'type'        => esc_html__('Page Scroll Previous Button Text', 'tpebl'),
                    'editor_type' => 'LINE',
                ]
            ],
        ];
		$widgets['tp-post-search'] = [
            'conditions' => ['widgetType' => 'tp-post-search'],
            'fields' => [
                [
                    'field'       => 'search_field_placeholder',
                    'type'        => esc_html__('Post Search Search Field Placeholder', 'tpebl'),
                    'editor_type' => 'LINE',
                ],
				[
                    'field'       => 'button_text',
                    'type'        => esc_html__('Post Search Button Text', 'tpebl'),
                    'editor_type' => 'LINE',
                ]
            ],
        ];
		$widgets['tp-progress-bar'] = [
            'conditions' => ['widgetType' => 'tp-progress-bar'],
            'fields' => [
                [
                    'field'       => 'title',
                    'type'        => esc_html__('Progress Bar Title', 'tpebl'),
                    'editor_type' => 'LINE',
                ],
				[
                    'field'       => 'sub_title',
                    'type'        => esc_html__('Progress Bar Sub Title', 'tpebl'),
                    'editor_type' => 'LINE',
                ],
				[
                    'field'       => 'number',
                    'type'        => esc_html__('Progress Bar Number', 'tpebl'),
                    'editor_type' => 'LINE',
                ],
				[
                    'field'       => 'symbol',
                    'type'        => esc_html__('Progress Bar Prefix/Postfix Symbol', 'tpebl'),
                    'editor_type' => 'LINE',
                ]
            ],
        ];
		$widgets['tp-team-member-listout'] = [
            'conditions' => ['widgetType' => 'tp-team-member-listout'],
            'fields' => [
                [
                    'field'       => 'all_filter_category',
                    'type'        => esc_html__('Team Member All Filter Category Text', 'tpebl'),
                    'editor_type' => 'LINE',
                ]
            ],
        ];
		$widgets['tp-video-player'] = [
            'conditions' => ['widgetType' => 'tp-video-player'],
            'fields' => [
                [
                    'field'       => 'video_title',
                    'type'        => esc_html__('Title of Video', 'tpebl'),
                    'editor_type' => 'LINE',
                ]
            ],
        ];
		/*repeater & normal start*/
		$widgets['tp-accordion'] = [
            'conditions' => ['widgetType' => 'tp-accordion'],
			'fields'     => [],
            'integration-class' => '\TheplusAddons\L_WPML\Tp_Accordion',
        ];	
		
		$widgets['tp-flip-box'] = [
            'conditions' => ['widgetType' => 'tp-flip-box'],
			'fields'     => [
				[
                    'field'       => 'title',
                    'type'        => esc_html__('Flip Box : Title', 'tpebl'),
                    'editor_type' => 'LINE',
                ],
				[
                    'field'       => 'button_text',
                    'type'        => esc_html__('Flip Box : Button Text', 'tpebl'),
                    'editor_type' => 'LINE',
                ]
			],
            'integration-class' => '\TheplusAddons\L_WPML\Tp_Flip_Box',
        ];
		
		$widgets['tp-gallery-listout'] = [
            'conditions' => ['widgetType' => 'tp-gallery-listout'],
			'fields'     => [				
				[
                    'field'       => 'style_4_button_text',
                    'type'        => esc_html__('Gallery Listout : Button Text', 'tpebl'),
                    'editor_type' => 'LINE',
                ],
				[
                    'field'       => 'all_filter_category',
                    'type'        => esc_html__('Gallery Listout : All Filter Category Text', 'tpebl'),
                    'editor_type' => 'LINE',
                ],
				[
                    'field'       => 'load_more_btn_text',
                    'type'        => esc_html__('Gallery Listout : Load More Button Text', 'tpebl'),
                    'editor_type' => 'LINE',
                ],
				[
                    'field'       => 'loaded_posts_text',
                    'type'        => esc_html__('Gallery Listout : All Posts Loaded Text', 'tpebl'),
                    'editor_type' => 'LINE',
                ]
			],
            'integration-class' => '\TheplusAddons\L_WPML\Tp_Gallery_Listout',
        ];		
		
		$widgets['tp-info-box'] = [
            'conditions' => ['widgetType' => 'tp-info-box'],
			'fields'     => [
				[
                    'field'       => 'title',
                    'type'        => esc_html__('Info Box : Title', 'tpebl'),
                    'editor_type' => 'LINE',
                ],
				[
                    'field'       => 'button_text',
                    'type'        => esc_html__('Info Box : Button Text', 'tpebl'),
                    'editor_type' => 'LINE',
                ],
				[
                    'field'       => 'pin_text_title',
                    'type'        => esc_html__('Info Box : Pin Text', 'tpebl'),
                    'editor_type' => 'LINE',
                ],
				[
                    'field'       => 'content_desc',
                    'type'        => esc_html__('Info Box : Description', 'tpebl'),
                    'editor_type' => 'VISUAL',
                ],				
				'url_link'       => [
					'field'       => 'url',
					'type'        => __( 'Info Box : Link', 'tpebl' ),
					'editor_type' => 'LINK',
				],				
			],
            'integration-class' => '\TheplusAddons\L_WPML\Tp_Info_Box',
        ];
		
		$widgets['tp-pricing-table'] = [
            'conditions' => ['widgetType' => 'tp-pricing-table'],
			'fields'     => [
				[
                    'field'       => 'pricing_title',
                    'type'        => esc_html__('Pricing Table : Title', 'tpebl'),
                    'editor_type' => 'LINE',
                ],
				[
                    'field'       => 'pricing_subtitle',
                    'type'        => esc_html__('Pricing Table : Sub Title', 'tpebl'),
                    'editor_type' => 'LINE',
                ],
				[
                    'field'       => 'price_prefix',
                    'type'        => esc_html__('Pricing Table : Prefix Text', 'tpebl'),
                    'editor_type' => 'LINE',
                ],
				[
                    'field'       => 'price_postfix',
                    'type'        => esc_html__('Pricing Table : Postfix Text', 'tpebl'),
                    'editor_type' => 'LINE',
                ],
				[
                    'field'       => 'previous_price_prefix',
                    'type'        => esc_html__('Pricing Table : Prefix Text', 'tpebl'),
                    'editor_type' => 'LINE',
                ],
				[
                    'field'       => 'previous_price_postfix',
                    'type'        => esc_html__('Pricing Table : Postfix Text', 'tpebl'),
                    'editor_type' => 'LINE',
                ],
				[
                    'field'       => 'list_style_show_option',
                    'type'        => esc_html__('Pricing Table : Expand Section Title', 'tpebl'),
                    'editor_type' => 'LINE',
                ],
				[
                    'field'       => 'list_style_less_option',
                    'type'        => esc_html__('Pricing Table : Shrink Section Title', 'tpebl'),
                    'editor_type' => 'LINE',
                ],
				[
                    'field'       => 'button_text',
                    'type'        => esc_html__('Pricing Table : Button Text', 'tpebl'),
                    'editor_type' => 'LINE',
                ],
				[
                    'field'       => 'content_wysiwyg',
                    'type'        => esc_html__('Pricing Table : Content', 'tpebl'),
                    'editor_type' => 'VISUAL',
                ],
				[
                    'field'       => 'ribbon_pin_text',
                    'type'        => esc_html__('Pricing Table : Ribbon/Pin Text', 'tpebl'),
                    'editor_type' => 'VISUAL',
                ]
			],
            'integration-class' => '\TheplusAddons\L_WPML\Tp_Pricing_Table',
        ];		
		
		$widgets['tp-scroll-navigation'] = [
            'conditions' => ['widgetType' => 'tp-scroll-navigation'],
			'fields'     => [],
            'integration-class' => '\TheplusAddons\L_WPML\Tp_Scroll_Navigation',
        ];
		
		$widgets['tp-social-icon'] = [
            'conditions' => ['widgetType' => 'tp-social-icon'],
			'fields'     => [],
            'integration-class' => '\TheplusAddons\L_WPML\Tp_Social_Icon',
        ];
		
		$widgets['tp-tabs-tours'] = [
            'conditions' => ['widgetType' => 'tp-tabs-tours'],
			'fields'     => [],
            'integration-class' => '\TheplusAddons\L_WPML\Tp_Tabs_Tours',
        ];
		/*repeater & normal end*/
		
		return $widgets;
    }
	public function __construct() {
		if ( class_exists( 'L_WPML_Elementor_Module_With_Items' ) ) {
			$this->includes();
			add_filter('wpml_elementor_widgets_to_translate', [$this, 'plus_translate_widgets']);
		}
	}
	
	public function includes() {
		require_once L_THEPLUS_PATH.'modules/enqueue/L_WPML/Tp_Accordion.php';
		require_once L_THEPLUS_PATH.'modules/enqueue/L_WPML/Tp_Flip_Box.php';
		require_once L_THEPLUS_PATH.'modules/enqueue/L_WPML/Tp_Gallery_Listout.php';
		require_once L_THEPLUS_PATH.'modules/enqueue/L_WPML/Tp_Info_Box.php';
		require_once L_THEPLUS_PATH.'modules/enqueue/L_WPML/Tp_Pricing_Table.php';
		require_once L_THEPLUS_PATH.'modules/enqueue/L_WPML/Tp_Scroll_Navigation.php';
		require_once L_THEPLUS_PATH.'modules/enqueue/L_WPML/Tp_Social_Icon.php';
		require_once L_THEPLUS_PATH.'modules/enqueue/L_WPML/Tp_Tabs_Tours.php';
	}
	
	/**
	 * Returns the instance.
	 * @since  1.0.0
	 */
	public static function get_instance( $shortcodes = array() ) {

		if ( null == self::$instance ) {
			self::$instance = new self( $shortcodes );
		}
		return self::$instance;
	}
}

/**
 * Returns instance of L_WPML
 */
function l_theplus_wpml_translate() {
	return L_WPML::get_instance();
}