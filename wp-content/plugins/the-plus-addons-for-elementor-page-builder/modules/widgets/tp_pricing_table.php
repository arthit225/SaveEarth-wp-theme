<?php
/**
 * Widget Name: Pricing Table
 * Description: unique design of pricing table.
 * Author: Theplus
 * Author URI: https://posimyth.com
 *
 * @package ThePlus
 */

namespace TheplusAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class L_ThePlus_Pricing_Table
 */
class L_ThePlus_Pricing_Table extends Widget_Base {

	/**
	 * Document Link For Need help.
	 *
	 * @var tp_doc of the class.
	 */
	public $tp_doc = L_THEPLUS_TPDOC;

	/**
	 * Helpdesk Link For Need help.
	 *
	 * @var tp_help of the class.
	 */
	public $tp_help = L_THEPLUS_HELP;

	/**
	 * Get Widget Name.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_name() {
		return 'tp-pricing-table';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Pricing Table', 'tpebl' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-money theplus_backend_icon';
	}

	/**
	 * Get Custom url.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_custom_help_url() {
		$help_url = $this->tp_help;

		return esc_url( $help_url );
	}

	/**
	 * Get Widget categories.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_categories() {
		return array( 'plus-essential' );
	}

	/**
	 * Get Widget keywords.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_keywords() {
		return array( 'Pricing', 'Table', 'Pricing Table', 'Pricing Plan', 'Pricing Comparison', 'Pricing Options', 'Pricing Packages', 'Pricing Grid', 'Pricing Chart' );
	}

	/**
	 * Register controls.
	 *
	 * @since 1.0.0
	 * @version 5.5.4
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Layout', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'pricing_table_style',
			array(
				'label'   => esc_html__( 'Style', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => array(
					'style-1' => esc_html__( 'Style 1', 'tpebl' ),
					'style-2' => esc_html__( 'Style 2 (PRO)', 'tpebl' ),
					'style-3' => esc_html__( 'Style 3 (PRO)', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'pricing_table_style_pro_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'pricing_table_style!' => array( 'style-1' ),
				),
			)
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'title_content_section',
			array(
				'label'     => esc_html__( 'Title Section', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'pricing_table_style' => 'style-1',
				),
			)
		);
		$this->add_control(
			'title_heading',
			array(
				'label'     => esc_html__( 'Title', 'tpebl' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'title_style',
			array(
				'label'   => esc_html__( 'Title Style', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => array(
					'style-1' => esc_html__( 'Style 1', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'pricing_title',
			array(
				'label'   => esc_html__( 'Title', 'tpebl' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Professional', 'tpebl' ),
				'dynamic' => array( 'active' => true ),
			)
		);
		$this->add_control(
			'pricing_subtitle',
			array(
				'label'   => esc_html__( 'Sub Title', 'tpebl' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '',
				'dynamic' => array( 'active' => true ),
			)
		);
		$this->add_control(
			'icons_heading',
			array(
				'label'     => esc_html__( 'Icon Options', 'tpebl' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'image_icon',
			array(
				'label'   => esc_html__( 'Select Icon', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => array(
					''      => esc_html__( 'None', 'tpebl' ),
					'icon'  => esc_html__( 'Icon', 'tpebl' ),
					'image' => esc_html__( 'Image', 'tpebl' ),
					'svg'   => esc_html__( 'Svg (PRO)', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'image_icon_note',
			array(
				'type'        => Controls_Manager::RAW_HTML,
				'raw'         => '<p class="tp-controller-notice"><i>You can select Icon, Custom Image or SVG using this option.</i></p>',
				'label_block' => true,
			)
		);
		$this->add_control(
			'svg_icon_pro_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'image_icon' => 'svg',
				),
			)
		);
		$this->add_control(
			'select_image',
			array(
				'label'      => esc_html__( 'Use Image As icon', 'tpebl' ),
				'type'       => Controls_Manager::MEDIA,
				'default'    => array(
					'url' => '',
				),
				'media_type' => 'image',
				'dynamic'    => array( 'active' => true ),
				'condition'  => array(
					'image_icon' => 'image',
				),
			)
		);
		$this->add_control(
			'icon_font_style',
			array(
				'label'     => esc_html__( 'Icon Font', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'font_awesome',
				'options'   => array(
					'font_awesome' => esc_html__( 'Font Awesome', 'tpebl' ),
					'icon_mind'    => esc_html__( 'Icons Mind (PRO)', 'tpebl' ),
				),
				'condition' => array(
					'image_icon' => 'icon',
				),
			)
		);
		$this->add_control(
			'icon_fontawesome',
			array(
				'label'     => esc_html__( 'Icon Library', 'tpebl' ),
				'type'      => Controls_Manager::ICON,
				'default'   => 'fa fa-bank',
				'condition' => array(
					'image_icon'      => 'icon',
					'icon_font_style' => 'font_awesome',
				),
			)
		);
		$this->add_control(
			'icons_mind_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'image_icon'      => 'icon',
					'icon_font_style' => 'icon_mind',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'price_content_section',
			array(
				'label'     => esc_html__( 'Price', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'pricing_table_style' => 'style-1',
				),
			)
		);
		$this->add_control(
			'price_style',
			array(
				'label'   => esc_html__( 'Price Style', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => array(
					'style-1' => esc_html__( 'Style 1', 'tpebl' ),
					'style-2' => esc_html__( 'Style 2 (PRO)', 'tpebl' ),
					'style-3' => esc_html__( 'Style 3 (PRO)', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'price_style_pro_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'price_style!' => 'style-1',
				),
			)
		);

		$this->add_control(
			'price_prefix',
			array(
				'label'       => esc_html__( 'Prefix Text', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( '$', 'tpebl' ),
				'placeholder' => esc_html__( 'Enter text of Price Prefix.. Ex. $,Rs,...', 'tpebl' ),
				'dynamic'     => array( 'active' => true ),
				'condition'   => array(
					'price_style' => 'style-1',
				),
			)
		);
		$this->add_control(
			'price',
			array(
				'label'       => esc_html__( 'Value Of Price', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( '59.99', 'tpebl' ),
				'placeholder' => esc_html__( 'Enter value of Price.. Ex. 49,69...', 'tpebl' ),
				'dynamic'     => array( 'active' => true ),
				'condition'   => array(
					'price_style' => 'style-1',
				),
			)
		);
		$this->add_control(
			'price_postfix',
			array(
				'label'       => esc_html__( 'Postfix Text', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Per Month', 'tpebl' ),
				'placeholder' => esc_html__( 'Enter text of Price Postfix.. Ex. Per Month...', 'tpebl' ),
				'dynamic'     => array( 'active' => true ),
				'condition'   => array(
					'price_style' => 'style-1',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'previous_price_content_section',
			array(
				'label'     => esc_html__( 'Previous Price', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'pricing_table_style' => 'style-1',
				),
			)
		);
		$this->add_control(
			'show_previous_price',
			array(
				'label'     => esc_html__( 'Display Previous Price', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Yes', 'tpebl' ),
				'label_off' => esc_html__( 'No', 'tpebl' ),
			)
		);
		$this->add_control(
			'previous_price_prefix',
			array(
				'label'       => esc_html__( 'Prefix Text', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( '$', 'tpebl' ),
				'placeholder' => esc_html__( 'Enter text of Price Prefix.. Ex. $,Rs,...', 'tpebl' ),
				'dynamic'     => array( 'active' => true ),
				'condition'   => array(
					'show_previous_price' => 'yes',
				),
			)
		);
		$this->add_control(
			'previous_price',
			array(
				'label'       => esc_html__( 'Value Of Price', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( '59.99', 'tpebl' ),
				'placeholder' => esc_html__( 'Enter value of Price.. Ex. 49,69...', 'tpebl' ),
				'dynamic'     => array( 'active' => true ),
				'condition'   => array(
					'show_previous_price' => 'yes',
				),
			)
		);
		$this->add_control(
			'previous_price_postfix',
			array(
				'label'       => esc_html__( 'Postfix Text', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'Enter text of Price Postfix.. Ex. Rs,%..', 'tpebl' ),
				'dynamic'     => array( 'active' => true ),
				'condition'   => array(
					'show_previous_price' => 'yes',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'content_description_section',
			array(
				'label'     => esc_html__( 'Content Description', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'pricing_table_style' => 'style-1',
				),
			)
		);
		$this->add_control(
			'content_style',
			array(
				'label'   => esc_html__( 'Content Style', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'stylist_list',
				'options' => array(
					'stylist_list'    => esc_html__( 'Stylish List', 'tpebl' ),
					'wysiwyg_content' => esc_html__( 'WYSIWYG', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_stylist',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "add-show-more-button-for-features-in-elementor-pricing-table/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> Learn How it works  <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'content_style' => 'stylist_list',
				),
			)
		);
		$this->add_control(
			'content_list_style',
			array(
				'label'     => esc_html__( 'Content List Style', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style-1',
				'options'   => array(
					'style-1' => esc_html__( 'Style 1', 'tpebl' ),
					'style-2' => esc_html__( 'Style 2', 'tpebl' ),
				),
				'condition' => array(
					'content_style' => 'stylist_list',
				),
			)
		);
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'list_description',
			array(
				'label'       => esc_html__( 'List Description', 'tpebl' ),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => esc_html__( 'I am text block.', 'tpebl' ),
				'placeholder' => esc_html__( 'Type your description here', 'tpebl' ),
				'dynamic'     => array( 'active' => true ),
			)
		);
		$repeater->add_control(
			'list_icon_style',
			array(
				'label'   => esc_html__( 'Icon Font', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'font_awesome',
				'options' => array(
					'font_awesome' => esc_html__( 'Font Awesome', 'tpebl' ),
					'icon_mind'    => esc_html__( 'Icons Mind (Pro)', 'tpebl' ),
				),
			)
		);
		$repeater->add_control(
			'list_icon_fontawesome',
			array(
				'label'     => esc_html__( 'Icon Library', 'tpebl' ),
				'type'      => Controls_Manager::ICON,
				'default'   => 'fa fa-plus',
				'separator' => 'before',
				'condition' => array(
					'list_icon_style' => 'font_awesome',
				),
			)
		);
		$repeater->add_control(
			'list_icons_mind_pro',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'list_icon_style' => array( 'icon_mind' ),
				),
			)
		);
		$repeater->add_control(
			'show_tooltips',
			array(
				'label'       => esc_html__( 'Tooltip options', 'tpebl' ),
				'type'        => Controls_Manager::SWITCHER,
				'label_on'    => esc_html__( 'Yes', 'tpebl' ),
				'label_off'   => esc_html__( 'No', 'tpebl' ),
				'render_type' => 'template',
				'separator'   => 'before',
			)
		);
		$repeater->add_control(
			'show_tooltips_pro',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'show_tooltips' => 'yes',
				),
			)
		);
		$this->add_control(
			'icon_list',
			array(
				'label'       => '',
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'list_description' => esc_html__( 'List Item 1', 'tpebl' ),
					),
					array(
						'list_description' => esc_html__( 'List Item 2', 'tpebl' ),
					),
					array(
						'list_description' => esc_html__( 'List Item 3', 'tpebl' ),
					),
				),
				'title_field' => '{{{ list_description }}}',
				'condition'   => array(
					'content_style' => 'stylist_list',
				),
			)
		);
		$this->add_control(
			'content_wysiwyg_style',
			array(
				'label'     => esc_html__( 'Content Style', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style-1',
				'options'   => array(
					'style-1' => esc_html__( 'Style 1', 'tpebl' ),
					'style-2' => esc_html__( 'Style 2', 'tpebl' ),
				),
				'condition' => array(
					'content_style' => 'wysiwyg_content',
				),
			)
		);
		$this->add_control(
			'content_wysiwyg',
			array(
				'label'     => esc_html__( 'Content', 'tpebl' ),
				'type'      => Controls_Manager::WYSIWYG,
				'default'   => esc_html__( 'Luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'tpebl' ),
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'content_style' => 'wysiwyg_content',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'button_section',
			array(
				'label'     => esc_html__( 'Button', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'pricing_table_style' => 'style-1',
				),
			)
		);
		$this->add_control(
			'display_button',
			array(
				'label'     => esc_html__( 'Button', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'default'   => 'yes',
			)
		);
		$this->add_control(
			'button_style',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Button Style', 'tpebl' ),
				'default'   => 'style-8',
				'options'   => array(
					'style-7' => esc_html__( 'Style 1 (PRO)', 'tpebl' ),
					'style-8' => esc_html__( 'Style 2', 'tpebl' ),
					'style-9' => esc_html__( 'Style 3 (PRO)', 'tpebl' ),
				),
				'condition' => array(
					'display_button' => 'yes',
				),
			)
		);
		$this->add_control(
			'button_style_pro_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'display_button' => 'yes',
					'button_style!'  => 'style-8',
				),
			)
		);

		$this->add_control(
			'button_text',
			array(
				'label'     => esc_html__( 'Button Text', 'tpebl' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Free Trial', 'tpebl' ),
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'display_button' => 'yes',
					'button_style'   => 'style-8',
				),
			)
		);
		$this->add_control(
			'button_link',
			array(
				'label'       => esc_html__( 'Button Link', 'tpebl' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => array(
					'active' => true,
				),
				'placeholder' => esc_html__( 'https://www.demo-link.com', 'tpebl' ),
				'default'     => array(
					'url' => '#',
				),
				'condition'   => array(
					'display_button' => 'yes',
					'button_style'   => 'style-8',
				),
			)
		);
		$this->add_control(
			'button_icon_style',
			array(
				'label'     => esc_html__( 'Icon Font', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'font_awesome',
				'options'   => array(
					''             => esc_html__( 'None', 'tpebl' ),
					'font_awesome' => esc_html__( 'Font Awesome', 'tpebl' ),
					'icon_mind'    => esc_html__( 'Icons Mind (Pro)', 'tpebl' ),
				),
				'condition' => array(
					'display_button' => 'yes',
					'button_style!'  => array( 'style-7', 'style-9' ),
				),
			)
		);
		$this->add_control(
			'button_icon',
			array(
				'label'       => esc_html__( 'Icon', 'tpebl' ),
				'type'        => Controls_Manager::ICON,
				'label_block' => true,
				'default'     => 'fa fa-chevron-right',
				'condition'   => array(
					'display_button'    => 'yes',
					'button_style!'     => array( 'style-7', 'style-9' ),
					'button_icon_style' => 'font_awesome',
				),
			)
		);
		$this->add_control(
			'button_icons_mind_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'display_button'    => 'yes',
					'button_style!'     => array( 'style-7', 'style-9' ),
					'button_icon_style' => 'icon_mind',
				),
			)
		);
		$this->add_control(
			'before_after',
			array(
				'label'     => esc_html__( 'Icon Position', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'after',
				'options'   => array(
					'after'  => esc_html__( 'After', 'tpebl' ),
					'before' => esc_html__( 'Before', 'tpebl' ),
				),
				'condition' => array(
					'display_button'     => 'yes',
					'button_style!'      => array( 'style-7', 'style-9' ),
					'button_icon_style!' => array( '', 'icon_mind' ),
				),
			)
		);
		$this->add_control(
			'icon_spacing',
			array(
				'label'     => esc_html__( 'Icon Spacing', 'tpebl' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max' => 100,
					),
				),
				'condition' => array(
					'display_button'     => 'yes',
					'button_style!'      => array( 'style-7', 'style-9' ),
					'button_icon_style!' => array( '', 'icon_mind' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .button-link-wrap i.button-after' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .button-link-wrap i.button-before' => 'margin-right: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'call_to_action_section',
			array(
				'label'     => esc_html__( 'Call to Action', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'pricing_table_style' => 'style-1',
				),
			)
		);
		$this->add_control(
			'call_to_action_section_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ribbon_pin_section',
			array(
				'label'     => esc_html__( 'Ribbon', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'pricing_table_style' => 'style-1',
				),
			)
		);
		$this->add_control(
			'display_ribbon_pin',
			array(
				'label'     => wp_kses_post( "Display Ribbon <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "add-a-ribbon-to-an-elementor-pricing-table/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Yes', 'tpebl' ),
				'label_off' => esc_html__( 'No', 'tpebl' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'ribbon_pin_style',
			array(
				'label'     => wp_kses_post( "Ribbon Style <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "add-a-ribbon-to-an-elementor-pricing-table/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style-1',
				'options'   => array(
					'style-1' => esc_html__( 'Style 1 ', 'tpebl' ),
					'style-2' => esc_html__( 'Style 2 (Pro)', 'tpebl' ),
					'style-3' => esc_html__( 'Style 3 (Pro)', 'tpebl' ),
				),
				'condition' => array(
					'display_ribbon_pin' => 'yes',
				),
			)
		);
		$this->add_control(
			'ribbon_pin_text',
			array(
				'label'     => esc_html__( 'Ribbon/Pin Text', 'tpebl' ),
				'type'      => Controls_Manager::WYSIWYG,
				'default'   => esc_html__( 'Recommended', 'tpebl' ),
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'display_ribbon_pin' => 'yes',
					'ribbon_pin_style'   => 'style-1',
				),
			)
		);
		$this->add_control(
			'ribbon_pin_style_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'display_ribbon_pin' => 'yes',
					'ribbon_pin_style!'  => 'style-1',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_svg_styling',
			array(
				'label'     => esc_html__( 'Svg Style', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'image_icon' => 'svg',
				),
			)
		);
		$this->add_control(
			'section_svg_styling_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon_styling',
			array(
				'label'     => esc_html__( 'Icon Style', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'image_icon' => 'icon',
				),
			)
		);
		$this->add_control(
			'icon_style',
			array(
				'label'   => esc_html__( 'Icon Style', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'square',
				'options' => array(
					''              => esc_html__( 'None', 'tpebl' ),
					'square'        => esc_html__( 'Square', 'tpebl' ),
					'rounded'       => esc_html__( 'Rounded', 'tpebl' ),
					'hexagon'       => esc_html__( 'Hexagon (PRO)', 'tpebl' ),
					'pentagon'      => esc_html__( 'Pentagon (PRO)', 'tpebl' ),
					'square-rotate' => esc_html__( 'Square Rotate (PRO)', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'icon_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Size', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 25,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner .pricing-icon' => 'font-size: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);
		$this->add_control(
			'icon_width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Width', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 250,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 50,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner .pricing-icon' => 'width: {{SIZE}}{{UNIT}} !important;height: {{SIZE}}{{UNIT}} !important;line-height: {{SIZE}}{{UNIT}} !important;text-align: center;',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_icon_style' );
		$this->start_controls_tab(
			'tab_icon_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'icon_color_option',
			array(
				'label'       => esc_html__( 'Icon Color', 'tpebl' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => array(
					'solid'    => array(
						'title' => esc_html__( 'Classic', 'tpebl' ),
						'icon'  => 'eicon-paint-brush',
					),
					'gradient' => array(
						'title' => esc_html__( 'Gradient', 'tpebl' ),
						'icon'  => 'fa fa-barcode',
					),
				),
				'default'     => 'solid',
				'label_block' => false,
			)
		);
		$this->add_control(
			'icon_color',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner .pricing-icon' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'icon_color_option' => 'solid',
				),
				'separator' => 'after',
			)
		);
		$this->add_control(
			'icon_gradient_color1',
			array(
				'label'     => esc_html__( 'Color 1', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'orange',
				'condition' => array(
					'icon_color_option' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'icon_gradient_color1_control',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Color 1 Location', 'tpebl' ),
				'size_units'  => array( '%' ),
				'default'     => array(
					'unit' => '%',
					'size' => 0,
				),
				'render_type' => 'ui',
				'condition'   => array(
					'icon_color_option' => 'gradient',
				),
				'of_type'     => 'gradient',
			)
		);
		$this->add_control(
			'icon_gradient_color2',
			array(
				'label'     => esc_html__( 'Color 2', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'cyan',
				'condition' => array(
					'icon_color_option' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'icon_gradient_color2_control',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Color 2 Location', 'tpebl' ),
				'size_units'  => array( '%' ),
				'default'     => array(
					'unit' => '%',
					'size' => 100,
				),
				'render_type' => 'ui',
				'condition'   => array(
					'icon_color_option' => 'gradient',
				),
				'of_type'     => 'gradient',
			)
		);
		$this->add_control(
			'icon_gradient_style',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Gradient Style', 'tpebl' ),
				'default'   => 'linear',
				'options'   => l_theplus_get_gradient_styles(),
				'condition' => array(
					'icon_color_option' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'icon_gradient_angle',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Gradient Angle', 'tpebl' ),
				'size_units' => array( 'deg' ),
				'default'    => array(
					'unit' => 'deg',
					'size' => 180,
				),
				'range'      => array(
					'deg' => array(
						'step' => 10,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner .pricing-icon' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{icon_gradient_color1.VALUE}} {{icon_gradient_color1_control.SIZE}}{{icon_gradient_color1_control.UNIT}}, {{icon_gradient_color2.VALUE}} {{icon_gradient_color2_control.SIZE}}{{icon_gradient_color2_control.UNIT}})',
				),
				'condition'  => array(
					'icon_color_option'   => 'gradient',
					'icon_gradient_style' => array( 'linear' ),
				),
				'of_type'    => 'gradient',
				'separator'  => 'after',
			)
		);
		$this->add_control(
			'icon_gradient_position',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Position', 'tpebl' ),
				'options'   => l_theplus_get_position_options(),
				'default'   => 'center center',
				'selectors' => array(
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner .pricing-icon' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{icon_gradient_color1.VALUE}} {{icon_gradient_color1_control.SIZE}}{{icon_gradient_color1_control.UNIT}}, {{icon_gradient_color2.VALUE}} {{icon_gradient_color2_control.SIZE}}{{icon_gradient_color2_control.UNIT}})',
				),
				'condition' => array(
					'icon_color_option'   => 'gradient',
					'icon_gradient_style' => 'radial',
				),
				'of_type'   => 'gradient',
				'separator' => 'after',

			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'icon_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .plus-pricing-table .pricing-table-inner .pricing-icon',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'icon_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner .pricing-icon' => 'border-color: {{VALUE}}',
				),
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'icon_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner .pricing-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'icon_box_shadow',
				'selector' => '{{WRAPPER}} .plus-pricing-table .pricing-table-inner .pricing-icon',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_icon_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'icon_hover_color_option',
			array(
				'label'       => esc_html__( 'Icon Hover Color', 'tpebl' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => array(
					'solid'    => array(
						'title' => esc_html__( 'Classic', 'tpebl' ),
						'icon'  => 'eicon-paint-brush',
					),
					'gradient' => array(
						'title' => esc_html__( 'Gradient', 'tpebl' ),
						'icon'  => 'fa fa-barcode',
					),
				),
				'default'     => 'solid',
				'label_block' => false,
			)
		);

		$this->add_control(
			'icon_hover_color',
			array(
				'label'     => esc_html__( 'Hover Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner:hover .pricing-icon' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'icon_hover_color_option' => 'solid',
				),
				'separator' => 'after',
			)
		);
		$this->add_control(
			'icon_hover_gradient_color1',
			array(
				'label'     => esc_html__( 'Color 1', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'orange',
				'condition' => array(
					'icon_hover_color_option' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'icon_hover_gradient_color1_control',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Color 1 Location', 'tpebl' ),
				'size_units'  => array( '%' ),
				'default'     => array(
					'unit' => '%',
					'size' => 0,
				),
				'render_type' => 'ui',
				'condition'   => array(
					'icon_hover_color_option' => 'gradient',
				),
				'of_type'     => 'gradient',
			)
		);
		$this->add_control(
			'icon_hover_gradient_color2',
			array(
				'label'     => esc_html__( 'Color 2', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'cyan',
				'condition' => array(
					'icon_hover_color_option' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'icon_hover_gradient_color2_control',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Color 2 Location', 'tpebl' ),
				'size_units'  => array( '%' ),
				'default'     => array(
					'unit' => '%',
					'size' => 100,
				),
				'render_type' => 'ui',
				'condition'   => array(
					'icon_hover_color_option' => 'gradient',
				),
				'of_type'     => 'gradient',
			)
		);
		$this->add_control(
			'icon_hover_gradient_style',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Gradient Style', 'tpebl' ),
				'default'   => 'linear',
				'options'   => l_theplus_get_gradient_styles(),
				'condition' => array(
					'icon_hover_color_option' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'icon_hover_gradient_angle',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Gradient Angle', 'tpebl' ),
				'size_units' => array( 'deg' ),
				'default'    => array(
					'unit' => 'deg',
					'size' => 180,
				),
				'range'      => array(
					'deg' => array(
						'step' => 10,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner:hover .pricing-icon' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{icon_hover_gradient_color1.VALUE}} {{icon_hover_gradient_color1_control.SIZE}}{{icon_hover_gradient_color1_control.UNIT}}, {{icon_hover_gradient_color2.VALUE}} {{icon_hover_gradient_color2_control.SIZE}}{{icon_hover_gradient_color2_control.UNIT}})',
				),
				'condition'  => array(
					'icon_hover_color_option'   => 'gradient',
					'icon_hover_gradient_style' => array( 'linear' ),
				),
				'of_type'    => 'gradient',
				'separator'  => 'after',
			)
		);
		$this->add_control(
			'icon_hover_gradient_position',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Position', 'tpebl' ),
				'options'   => l_theplus_get_position_options(),
				'default'   => 'center center',
				'selectors' => array(
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner:hover .pricing-icon' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{icon_hover_gradient_color1.VALUE}} {{icon_hover_gradient_color1_control.SIZE}}{{icon_hover_gradient_color1_control.UNIT}}, {{icon_hover_gradient_color2.VALUE}} {{icon_hover_gradient_color2_control.SIZE}}{{icon_hover_gradient_color2_control.UNIT}})',
				),
				'condition' => array(
					'icon_hover_color_option'   => 'gradient',
					'icon_hover_gradient_style' => 'radial',
				),
				'of_type'   => 'gradient',
				'separator' => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'icon_hover_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .plus-pricing-table .pricing-table-inner:hover .pricing-icon',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'icon_border_hover_color',
			array(
				'label'     => esc_html__( 'Hover Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner:hover .pricing-icon' => 'border-color: {{VALUE}}',
				),
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'icon__hover_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner:hover .pricing-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'icon_hover_box_shadow',
				'selector' => '{{WRAPPER}} .plus-pricing-table .pricing-table-inner:hover .pricing-icon',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_styling',
			array(
				'label'     => esc_html__( 'Title Style', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'pricing_title!' => '',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typography', 'tpebl' ),
				'selector' => '{{WRAPPER}} .plus-pricing-table .pricing-title',
			)
		);
		$this->add_responsive_control(
			'title_alignment',
			array(
				'label'     => esc_html__( 'Alignment', 'tpebl' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => esc_html__( 'Left', 'tpebl' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'tpebl' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => esc_html__( 'Right', 'tpebl' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .plus-pricing-table.pricing-style-1 .pricing-title' => 'text-align: {{VALUE}}',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_title_style' );
		$this->start_controls_tab(
			'tab_title_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'title_color_option',
			array(
				'label'       => esc_html__( 'Title Color', 'tpebl' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => array(
					'solid'    => array(
						'title' => esc_html__( 'Classic', 'tpebl' ),
						'icon'  => 'eicon-paint-brush',
					),
					'gradient' => array(
						'title' => esc_html__( 'Gradient', 'tpebl' ),
						'icon'  => 'eicon-barcode',
					),
				),
				'label_block' => false,
				'default'     => 'solid',
			)
		);
		$this->add_control(
			'title_color',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .plus-pricing-table .pricing-title' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'title_color_option' => 'solid',
				),
			)
		);
		$this->add_control(
			'title_gradient_color1',
			array(
				'label'     => esc_html__( 'Color 1', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'orange',
				'condition' => array(
					'title_color_option' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'title_gradient_color1_control',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Color 1 Location', 'tpebl' ),
				'size_units'  => array( '%' ),
				'default'     => array(
					'unit' => '%',
					'size' => 0,
				),
				'render_type' => 'ui',
				'condition'   => array(
					'title_color_option' => 'gradient',
				),
				'of_type'     => 'gradient',
			)
		);
		$this->add_control(
			'title_gradient_color2',
			array(
				'label'     => esc_html__( 'Color 2', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'cyan',
				'condition' => array(
					'title_color_option' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'title_gradient_color2_control',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Color 2 Location', 'tpebl' ),
				'size_units'  => array( '%' ),
				'default'     => array(
					'unit' => '%',
					'size' => 100,
				),
				'render_type' => 'ui',
				'condition'   => array(
					'title_color_option' => 'gradient',
				),
				'of_type'     => 'gradient',
			)
		);
		$this->add_control(
			'title_gradient_style',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Gradient Style', 'tpebl' ),
				'default'   => 'linear',
				'options'   => l_theplus_get_gradient_styles(),
				'condition' => array(
					'title_color_option' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'title_gradient_angle',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Gradient Angle', 'tpebl' ),
				'size_units' => array( 'deg' ),
				'default'    => array(
					'unit' => 'deg',
					'size' => 180,
				),
				'range'      => array(
					'deg' => array(
						'step' => 10,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-pricing-table .pricing-title' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{title_gradient_color1.VALUE}} {{title_gradient_color1_control.SIZE}}{{title_gradient_color1_control.UNIT}}, {{title_gradient_color2.VALUE}} {{title_gradient_color2_control.SIZE}}{{title_gradient_color2_control.UNIT}})',
				),
				'condition'  => array(
					'title_color_option'   => 'gradient',
					'title_gradient_style' => array( 'linear' ),
				),
				'of_type'    => 'gradient',
			)
		);
		$this->add_control(
			'title_gradient_position',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Position', 'tpebl' ),
				'options'   => l_theplus_get_position_options(),
				'default'   => 'center center',
				'selectors' => array(
					'{{WRAPPER}} .plus-pricing-table .pricing-title' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{title_gradient_color1.VALUE}} {{title_gradient_color1_control.SIZE}}{{title_gradient_color1_control.UNIT}}, {{title_gradient_color2.VALUE}} {{title_gradient_color2_control.SIZE}}{{title_gradient_color2_control.UNIT}})',
				),
				'condition' => array(
					'title_color_option'   => 'gradient',
					'title_gradient_style' => 'radial',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_title_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'title_hover_color_option',
			array(
				'label'       => esc_html__( 'Title Hover Color', 'tpebl' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => array(
					'solid'    => array(
						'title' => esc_html__( 'Classic', 'tpebl' ),
						'icon'  => 'eicon-paint-brush',
					),
					'gradient' => array(
						'title' => esc_html__( 'Gradient', 'tpebl' ),
						'icon'  => 'fa fa-barcode',
					),
				),
				'label_block' => false,
				'default'     => 'solid',
			)
		);
		$this->add_control(
			'title_hover_color',
			array(
				'label'     => esc_html__( 'Hover Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner:hover .pricing-title' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'title_hover_color_option' => 'solid',
				),
			)
		);
		$this->add_control(
			'title_hover_gradient_color1',
			array(
				'label'     => esc_html__( 'Color 1', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'orange',
				'condition' => array(
					'title_hover_color_option' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'title_hover_gradient_color1_control',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Color 1 Location', 'tpebl' ),
				'size_units'  => array( '%' ),
				'default'     => array(
					'unit' => '%',
					'size' => 0,
				),
				'render_type' => 'ui',
				'condition'   => array(
					'title_hover_color_option' => 'gradient',
				),
				'of_type'     => 'gradient',
			)
		);
		$this->add_control(
			'title_hover_gradient_color2',
			array(
				'label'     => esc_html__( 'Color 2', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'cyan',
				'condition' => array(
					'title_hover_color_option' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'title_hover_gradient_color2_control',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Color 2 Location', 'tpebl' ),
				'size_units'  => array( '%' ),
				'default'     => array(
					'unit' => '%',
					'size' => 100,
				),
				'render_type' => 'ui',
				'condition'   => array(
					'title_hover_color_option' => 'gradient',
				),
				'of_type'     => 'gradient',
			)
		);
		$this->add_control(
			'title_hover_gradient_style',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Gradient Style', 'tpebl' ),
				'default'   => 'linear',
				'options'   => l_theplus_get_gradient_styles(),
				'condition' => array(
					'title_hover_color_option' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'title_hover_gradient_angle',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Gradient Angle', 'tpebl' ),
				'size_units' => array( 'deg' ),
				'default'    => array(
					'unit' => 'deg',
					'size' => 180,
				),
				'range'      => array(
					'deg' => array(
						'step' => 10,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner:hover .pricing-title' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{title_hover_gradient_color1.VALUE}} {{title_hover_gradient_color1_control.SIZE}}{{title_hover_gradient_color1_control.UNIT}}, {{title_hover_gradient_color2.VALUE}} {{title_hover_gradient_color2_control.SIZE}}{{title_hover_gradient_color2_control.UNIT}})',
				),
				'condition'  => array(
					'title_hover_color_option'   => 'gradient',
					'title_hover_gradient_style' => array( 'linear' ),
				),
				'of_type'    => 'gradient',
			)
		);
		$this->add_control(
			'title_hover_gradient_position',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Position', 'tpebl' ),
				'options'   => l_theplus_get_position_options(),
				'default'   => 'center center',
				'selectors' => array(
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner:hover .pricing-title' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{title_hover_gradient_color1.VALUE}} {{title_hover_gradient_color1_control.SIZE}}{{title_hover_gradient_color1_control.UNIT}}, {{title_hover_gradient_color2.VALUE}} {{title_hover_gradient_color2_control.SIZE}}{{title_hover_gradient_color2_control.UNIT}})',
				),
				'condition' => array(
					'title_hover_color_option'   => 'gradient',
					'title_hover_gradient_style' => 'radial',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_subtitle_styling',
			array(
				'label'     => esc_html__( 'SubTitle Style', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'pricing_subtitle!' => '',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'subtitle_typography',
				'label'    => esc_html__( 'Typography', 'tpebl' ),
				'selector' => '{{WRAPPER}} .plus-pricing-table .pricing-table-inner .pricing-subtitle',
			)
		);
		$this->add_responsive_control(
			'subtitle_alignment',
			array(
				'label'     => esc_html__( 'Alignment', 'tpebl' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => esc_html__( 'Left', 'tpebl' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'tpebl' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => esc_html__( 'Right', 'tpebl' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .plus-pricing-table.pricing-style-1 .pricing-subtitle' => 'text-align: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'subtitle_color',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner .pricing-subtitle' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'subtitle_Hover_color',
			array(
				'label'     => esc_html__( 'Hover Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner:hover .pricing-subtitle' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_previous_price_styling',
			array(
				'label'     => esc_html__( 'Previous Price Style', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'show_previous_price' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'previous_price_typography',
				'label'    => esc_html__( 'Typography', 'tpebl' ),
				'selector' => '{{WRAPPER}} .plus-pricing-table .pricing-previous-price-wrap',
			)
		);
		$this->add_control(
			'previous_price_align',
			array(
				'label'       => esc_html__( 'Price Alignment', 'tpebl' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => array(
					'top'    => array(
						'title' => esc_html__( 'Top', 'tpebl' ),
						'icon'  => 'eicon-v-align-top',
					),
					'middle' => array(
						'title' => esc_html__( 'Middle', 'tpebl' ),
						'icon'  => 'eicon-text-align-center',
					),
					'bottom' => array(
						'title' => esc_html__( 'Bottom', 'tpebl' ),
						'icon'  => 'eicon-v-align-bottom',
					),
				),
				'default'     => 'top',
				'toggle'      => true,
				'label_block' => false,
				'selectors'   => array(
					'{{WRAPPER}} .plus-pricing-table .pricing-previous-price-wrap' => 'vertical-align: {{VALUE}};',
				),
			)
		);
		$this->start_controls_tabs( 'previous_price_style_tab' );
		$this->start_controls_tab(
			'previous_price_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);

		$this->add_control(
			'previous_price_color',
			array(
				'label'     => esc_html__( 'Price Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-pricing-table .pricing-previous-price-wrap' => 'color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'previous_price_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'previous_price_hover_color',
			array(
				'label'     => esc_html__( 'Price Hover Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner:hover .pricing-previous-price-wrap' => 'color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_price_styling',
			array(
				'label' => esc_html__( 'Price Style', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'price_style_heading',
			array(
				'label'     => esc_html__( 'Price Main', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'price_typography',
				'label'    => esc_html__( 'Typography', 'tpebl' ),
				'selector' => '{{WRAPPER}} .plus-pricing-table .pricing-price-wrap.style-1 span.price-prefix-text,{{WRAPPER}} .plus-pricing-table .pricing-price-wrap.style-1 .pricing-price',
			)
		);
		$this->add_responsive_control(
			'price_alignment',
			array(
				'label'     => esc_html__( 'Alignment', 'tpebl' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => esc_html__( 'Left', 'tpebl' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'tpebl' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => esc_html__( 'Right', 'tpebl' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .plus-pricing-table.pricing-style-1 .pricing-price-wrap' => 'text-align: {{VALUE}}',
				),
			)
		);
		$this->start_controls_tabs( 'price_style_tab' );
		$this->start_controls_tab(
			'price_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);

		$this->add_control(
			'price_color',
			array(
				'label'     => esc_html__( 'Price Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-pricing-table .pricing-price-wrap.style-1 span.price-prefix-text,{{WRAPPER}} .plus-pricing-table .pricing-price-wrap.style-1 .pricing-price' => 'color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'price_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'price_hover_color',
			array(
				'label'     => esc_html__( 'Price Hover Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner:hover .pricing-price-wrap.style-1 span.price-prefix-text,{{WRAPPER}} .plus-pricing-table .pricing-table-inner:hover .pricing-price-wrap.style-1 .pricing-price' => 'color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'price_postfix_style_heading',
			array(
				'label'     => esc_html__( 'Postfix', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'price_postfix_typography',
				'label'    => esc_html__( 'Typography', 'tpebl' ),
				'selector' => '{{WRAPPER}} .plus-pricing-table .pricing-price-wrap.style-1 span.price-postfix-text',
			)
		);
		$this->start_controls_tabs( 'price_postfix_style_tab' );
		$this->start_controls_tab(
			'price_postfix_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);

		$this->add_control(
			'price_postfix_color',
			array(
				'label'     => esc_html__( 'Postfix Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-pricing-table .pricing-price-wrap span.price-postfix-text' => 'color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'price_postfix_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'price_postfix_hover_color',
			array(
				'label'     => esc_html__( 'Postfix Hover Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner:hover .pricing-price-wrap span.price-postfix-text' => 'color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_styling',
			array(
				'label' => esc_html__( 'Content Style', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'content_typography',
				'label'     => esc_html__( 'Typography', 'tpebl' ),
				'selector'  => '{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.content-desc .pricing-content',
				'condition' => array(
					'content_style' => 'wysiwyg_content',
				),
			)
		);
		$this->add_control(
			'content_text_color',
			array(
				'label'     => esc_html__( 'Content Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.content-desc .pricing-content,{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.content-desc .pricing-content p' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'content_style' => 'wysiwyg_content',
				),
			)
		);
		$this->add_control(
			'content_border_width_color',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Border Width', 'tpebl' ),
				'size_units'  => array( '%' ),
				'range'       => array(
					'%' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 2,
					),
				),
				'default'     => array(
					'unit' => '%',
					'size' => 2,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.content-desc.style-1 hr.border-line' => 'margin: 30px {{SIZE}}{{UNIT}}',
				),
				'condition'   => array(
					'content_style'         => 'wysiwyg_content',
					'content_wysiwyg_style' => 'style-1',
				),
			)
		);
		$this->add_control(
			'content_border_top_color',
			array(
				'label'     => esc_html__( 'Border Top Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.content-desc.style-1 hr.border-line' => 'border-top:1px solid;border-top-color: {{VALUE}};',
				),
				'condition' => array(
					'content_style'         => 'wysiwyg_content',
					'content_wysiwyg_style' => 'style-1',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'list_content_typography',
				'label'     => esc_html__( 'Typography', 'tpebl' ),
				'selector'  => '{{WRAPPER}} .plus-pricing-table ul.plus-icon-list-items span.plus-icon-list-text',
				'condition' => array(
					'content_style' => 'stylist_list',
				),
			)
		);
		$this->add_responsive_control(
			'desc_content_alignment',
			array(
				'label'     => esc_html__( 'Alignment', 'tpebl' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => esc_html__( 'Left', 'tpebl' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'tpebl' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => esc_html__( 'Right', 'tpebl' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.content-desc .pricing-content,{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.content-desc .pricing-content p' => 'text-align: {{VALUE}}',
				),
				'condition' => array(
					'content_style' => 'wysiwyg_content',
				),
				'default'   => '',
				'toggle'    => true,
			)
		);
		$this->add_responsive_control(
			'listing_content_alignment',
			array(
				'label'     => esc_html__( 'Alignment', 'tpebl' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'flex-start' => array(
						'title' => esc_html__( 'Left', 'tpebl' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center'     => array(
						'title' => esc_html__( 'Center', 'tpebl' ),
						'icon'  => 'eicon-text-align-center',
					),
					'flex-end'   => array(
						'title' => esc_html__( 'Right', 'tpebl' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .plus-pricing-table ul.plus-icon-list-items li' => 'justify-content: {{VALUE}}',
				),
				'condition' => array(
					'content_style' => 'stylist_list',
				),
				'default'   => '',
				'toggle'    => true,
			)
		);
		$this->add_control(
			'list_icon_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'List Icon Size', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 2,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 14,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.listing-content li span.plus-icon-list-icon' => 'font-size: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.listing-content li span.plus-icon-list-icon svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}}',
				),
				'condition'   => array(
					'content_style' => 'stylist_list',
				),
			)
		);
		$this->add_responsive_control(
			'content_spg',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pricing-content-wrap.listing-content.style-1 ul.plus-icon-list-items, {{WRAPPER}} .pricing-content-wrap.listing-content.style-2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'list_content_style_tab' );
		$this->start_controls_tab(
			'list_content_normal',
			array(
				'label'     => esc_html__( 'Normal', 'tpebl' ),
				'condition' => array(
					'content_style' => 'stylist_list',
				),
			)
		);
		$this->add_control(
			'list_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-pricing-table ul.plus-icon-list-items span.plus-icon-list-text,{{WRAPPER}} .plus-pricing-table ul.plus-icon-list-items span.plus-icon-list-text p' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'content_style' => 'stylist_list',
				),
			)
		);
		$this->add_control(
			'list_icon_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-pricing-table ul.plus-icon-list-items span.plus-icon-list-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .plus-pricing-table ul.plus-icon-list-items span.plus-icon-list-icon svg' => 'fill: {{VALUE}};stroke: {{VALUE}};',
				),
				'condition' => array(
					'content_style' => 'stylist_list',
				),
			)
		);
		$this->add_control(
			'list_style_2_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.listing-content.style-2 li' => 'border-bottom-color: {{VALUE}};',
				),
				'condition' => array(
					'content_style'      => 'stylist_list',
					'content_list_style' => 'style-2',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'list_content_hover_box',
			array(
				'label'     => esc_html__( 'Box Hover', 'tpebl' ),
				'condition' => array(
					'content_style' => 'stylist_list',
				),
			)
		);
		$this->add_control(
			'list_text_hover_color_box',
			array(
				'label'     => esc_html__( 'Hover Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-pricing-table:hover .pricing-content-wrap.listing-content ul.plus-icon-list-items li span.plus-icon-list-text,{{WRAPPER}} .plus-pricing-table:hover .pricing-content-wrap.listing-content ul.plus-icon-list-items li span.plus-icon-list-text p' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'content_style' => 'stylist_list',
				),
			)
		);
		$this->add_control(
			'list_icon_hover_color_box',
			array(
				'label'     => esc_html__( 'Hover Icon Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-pricing-table:hover .pricing-content-wrap.listing-content ul.plus-icon-list-items li span.plus-icon-list-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .plus-pricing-table:hover .pricing-content-wrap.listing-content ul.plus-icon-list-items li span.plus-icon-list-icon svg' => 'fill: {{VALUE}};stroke: {{VALUE}};',
				),
				'condition' => array(
					'content_style' => 'stylist_list',
				),
			)
		);
		$this->add_control(
			'list_style2_hover_border_color_box',
			array(
				'label'     => esc_html__( 'Hover Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-pricing-table:hover .pricing-content-wrap.listing-content.style-2 ul li' => 'border-bottom-color: {{VALUE}};',
				),
				'condition' => array(
					'content_style'      => 'stylist_list',
					'content_list_style' => 'style-2',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'list_content_hover',
			array(
				'label'     => esc_html__( 'Hover', 'tpebl' ),
				'condition' => array(
					'content_style' => 'stylist_list',
				),
			)
		);
		$this->add_control(
			'list_text_hover_color',
			array(
				'label'     => esc_html__( 'Hover Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.listing-content ul.plus-icon-list-items li:hover span.plus-icon-list-text,{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.listing-content ul.plus-icon-list-items li:hover span.plus-icon-list-text p' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'content_style' => 'stylist_list',
				),
			)
		);
		$this->add_control(
			'list_icon_hover_color',
			array(
				'label'     => esc_html__( 'Hover Icon Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.listing-content ul.plus-icon-list-items li:hover span.plus-icon-list-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.listing-content ul.plus-icon-list-items li:hover span.plus-icon-list-icon svg' => 'fill: {{VALUE}};stroke: {{VALUE}};',
				),
				'condition' => array(
					'content_style' => 'stylist_list',
				),
			)
		);
		$this->add_control(
			'list_style2_hover_border_color',
			array(
				'label'     => esc_html__( 'Hover Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.listing-content.style-2 ul li:hover' => 'border-bottom-color: {{VALUE}};',
				),
				'condition' => array(
					'content_style'      => 'stylist_list',
					'content_list_style' => 'style-2',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'list_between_space',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'List Between Space', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 2,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 5,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.listing-content.style-1 li' => 'margin-bottom: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.listing-content.style-2 li' => 'padding: {{SIZE}}{{UNIT}} 0',
				),
				'condition'   => array(
					'content_style' => 'stylist_list',
				),
			)
		);
		$this->add_responsive_control(
			'icon_between_space',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Spacing', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 2,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 5,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .plus-pricing-table .plus-icon-list-items .plus-icon-list-item .plus-icon-list-icon' => 'margin-right: {{SIZE}}{{UNIT}}',
				),
				'condition'   => array(
					'content_style' => 'stylist_list',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_bg_styling',
			array(
				'label'     => esc_html__( 'Content Background Style', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'content_style'      => 'stylist_list',
					'content_list_style' => 'style-1',
				),
			)
		);
		$this->add_control(
			'content_box_border',
			array(
				'label'     => esc_html__( 'Content Box Border', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'separator' => 'before',
				'default'   => 'no',
			)
		);
		$this->start_controls_tabs( 'content_border_style' );
		$this->start_controls_tab(
			'content_border_normal',
			array(
				'label'     => esc_html__( 'Normal', 'tpebl' ),
				'condition' => array(
					'content_box_border' => 'yes',
				),
			)
		);
		$this->add_control(
			'content_box_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#eee',
				'selectors' => array(
					'{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.listing-content.style-1 ul.plus-icon-list-items,{{WRAPPER}} .pricing-content-wrap.listing-content.style-1 a.read-more-options' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'content_box_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'content_box_border_width',
			array(
				'label'      => esc_html__( 'Border Width', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'top'    => 1,
					'right'  => 1,
					'bottom' => 1,
					'left'   => 1,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.listing-content.style-1 ul.plus-icon-list-items,{{WRAPPER}} .pricing-content-wrap.listing-content.style-1 a.read-more-options' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'content_box_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'content_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.listing-content.style-1 ul.plus-icon-list-items,{{WRAPPER}} .pricing-content-wrap.listing-content.style-1 a.read-more-options,{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.listing-content.style-1 .content-overlay-bg-color' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'content_box_border' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'content_border_hover',
			array(
				'label'     => esc_html__( 'Hover', 'tpebl' ),
				'condition' => array(
					'content_box_border' => 'yes',
				),
			)
		);
		$this->add_control(
			'content_box_border_hover_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.listing-content.style-1:hover ul.plus-icon-list-items,{{WRAPPER}} .pricing-content-wrap.listing-content.style-1:hover a.read-more-options' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'content_box_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'content_border_hover_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.listing-content.style-1:hover ul.plus-icon-list-items,{{WRAPPER}} .pricing-content-wrap.listing-content.style-1:hover a.read-more-options,{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.listing-content.style-1:hover .content-overlay-bg-color' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'content_box_border' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'content_background_options',
			array(
				'label'     => esc_html__( 'Background Options', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->start_controls_tabs( 'content_background_style' );
		$this->start_controls_tab(
			'content_background_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'content_box_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.listing-content.style-1 .content-overlay-bg-color',

			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'content_background_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'content_box_hover_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.listing-content.style-1:hover .content-overlay-bg-color',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'content_shadow_options',
			array(
				'label'     => esc_html__( 'Box Shadow Options', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->start_controls_tabs( 'content_shadow_style' );
		$this->start_controls_tab(
			'content_shadow_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'content_box_shadow',
				'selector' => '{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.listing-content.style-1 .content-overlay-bg-color',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'content_shadow_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'content_box_hover_shadow',
				'selector' => '{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.listing-content.style-1:hover .content-overlay-bg-color',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_tooltip_option_styling',
			array(
				'label' => esc_html__( 'Tooltip Options', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'section_tooltip_option_styling_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_button_styling',
			array(
				'label'     => esc_html__( 'Button Style', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'display_button' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'button_alignment',
			array(
				'label'     => esc_html__( 'Alignment', 'tpebl' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => esc_html__( 'Left', 'tpebl' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'tpebl' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => esc_html__( 'Right', 'tpebl' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .plus-pricing-table.pricing-style-1 .pt-plus-button-wrapper,{{WRAPPER}} .plus-pricing-table.pricing-style-2 .pt-plus-button-wrapper,{{WRAPPER}} .plus-pricing-table.pricing-style-3 .pt-plus-button-wrapper ' => 'text-align: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'button_top_bottom',
			array(
				'label'   => esc_html__( 'Position', 'tpebl' ),
				'type'    => Controls_Manager::CHOOSE,
				'default' => 'middle',
				'options' => array(
					'middle' => array(
						'title' => esc_html__( 'Center', 'tpebl' ),
						'icon'  => 'eicon-v-align-middle',
					),
					'bottom' => array(
						'title' => esc_html__( 'Bottom', 'tpebl' ),
						'icon'  => 'eicon-v-align-bottom',
					),
				),
			)
		);
		$this->add_control(
			'button_top_space',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Button Above Space', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 2,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 0,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .pt-plus-button-wrapper' => 'margin-top: {{SIZE}}{{UNIT}}',
				),
				'condition'   => array(
					'display_button' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'button_padding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'default'    => array(
					'top'      => '8',
					'right'    => '35',
					'bottom'   => '8',
					'left'     => '35',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_button .button-link-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'button_typography',
				'selector' => '{{WRAPPER}} .pt_plus_button .button-link-wrap',
			)
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);

		$this->add_control(
			'btn_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_button .button-link-wrap' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pt_plus_button.button-style-7 .button-link-wrap:after' => 'border-color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'button_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap',
				'separator' => 'after',
				'condition' => array(
					'button_style!' => array( 'style-7', 'style-9' ),
				),
			)
		);
		$this->add_control(
			'button_border_style',
			array(
				'label'     => esc_html__( 'Border Style', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'solid',
				'options'   => array(
					'none'   => esc_html__( 'None', 'tpebl' ),
					'solid'  => esc_html__( 'Solid', 'tpebl' ),
					'dotted' => esc_html__( 'Dotted', 'tpebl' ),
					'dashed' => esc_html__( 'Dashed', 'tpebl' ),
					'groove' => esc_html__( 'Groove', 'tpebl' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap' => 'border-style: {{VALUE}};',
				),
				'condition' => array(
					'button_style' => array( 'style-8' ),
				),
			)
		);

		$this->add_responsive_control(
			'button_border_width',
			array(
				'label'      => esc_html__( 'Border Width', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'top'    => 1,
					'right'  => 1,
					'bottom' => 1,
					'left'   => 1,
				),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'button_style'         => array( 'style-8' ),
					'button_border_style!' => 'none',
				),
			)
		);

		$this->add_control(
			'button_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'button_style'         => array( 'style-8' ),
					'button_border_style!' => 'none',
				),
				'separator' => 'after',
			)
		);

		$this->add_responsive_control(
			'button_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'button_style' => array( 'style-8' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'button_shadow',
				'selector'  => '
							   {{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap',
				'condition' => array(
					'button_style' => array( 'style-8' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_button_box_hover',
			array(
				'label' => esc_html__( 'Box Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'btn_text_box_hover_color',
			array(
				'label'     => esc_html__( 'Text Hover Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-pricing-table:hover .button-link-wrap' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'box_hover_btn_bg',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .plus-pricing-table:hover .pt_plus_button.button-style-8 .button-link-wrap',
				'separator' => 'after',
				'condition' => array(
					'button_style!' => array( 'style-7', 'style-9' ),
				),
			)
		);
		$this->add_control(
			'btn_border_box_hover_color',
			array(
				'label'     => esc_html__( 'Hover Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .plus-pricing-table:hover .pt_plus_button.button-style-8 .button-link-wrap' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'button_style'         => array( 'style-8' ),
					'button_border_style!' => 'none',
				),
				'separator' => 'after',
			)
		);
		$this->add_responsive_control(
			'box_hover_btn_radius',
			array(
				'label'      => esc_html__( 'Hover Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-pricing-table:hover .pt_plus_button.button-style-8 .button-link-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'button_style' => array( 'style-8' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'box_hover_btn_shadow',
				'selector'  => '{{WRAPPER}} .plus-pricing-table:hover .pt_plus_button.button-style-8 .button-link-wrap',
				'condition' => array(
					'button_style' => array( 'style-8' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_button_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'btn_text_hover_color',
			array(
				'label'     => esc_html__( 'Text Hover Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_button .button-link-wrap:hover' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'button_hover_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap:hover',
				'separator' => 'after',
				'condition' => array(
					'button_style!' => array( 'style-7', 'style-9' ),
				),
			)
		);
		$this->add_control(
			'button_border_hover_color',
			array(
				'label'     => esc_html__( 'Hover Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap:hover' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'button_style'         => array( 'style-8' ),
					'button_border_style!' => 'none',
				),
				'separator' => 'after',
			)
		);

		$this->add_responsive_control(
			'button_hover_radius',
			array(
				'label'      => esc_html__( 'Hover Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'button_style' => array( 'style-8' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'button_hover_shadow',
				'selector'  => '{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap:hover',
				'condition' => array(
					'button_style' => array( 'style-8' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		$this->start_controls_section(
			'section_call_to_action_styling',
			array(
				'label' => esc_html__( 'Call To Action(CTA)', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'section_call_to_action_styling_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_ribbon_pin_styling',
			array(
				'label'     => esc_html__( 'Ribbon/Pin', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'display_ribbon_pin' => 'yes',
					'ribbon_pin_style'   => 'style-1',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'ribbon_pin_typography',
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				),
				'selector' => '{{WRAPPER}} .plus-pricing-table .pricing-ribbon-pin .ribbon-pin-inner',
			)
		);
		$this->add_control(
			'ribbon_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => array(
					'{{WRAPPER}} .plus-pricing-table .pricing-ribbon-pin .ribbon-pin-inner,{{WRAPPER}} .plus-pricing-table .pricing-ribbon-pin .ribbon-pin-inner p' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_responsive_control(
			'ribbon_alignment',
			array(
				'label'     => esc_html__( 'Alignment', 'tpebl' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => esc_html__( 'Left', 'tpebl' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'tpebl' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => esc_html__( 'Right', 'tpebl' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .plus-pricing-table .pricing-ribbon-pin.style-1 .ribbon-pin-inner' => 'text-align: {{VALUE}}',
				),
				'condition' => array(
					'ribbon_pin_style' => 'style-1',
				),
			)
		);
		$this->add_responsive_control(
			'ribbon_padding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-pricing-table .pricing-ribbon-pin.style-1 .ribbon-pin-inner ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
				'condition'  => array(
					'ribbon_pin_style' => 'style-1',
				),
			)
		);
		$this->add_responsive_control(
			'ribbon_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-pricing-table .pricing-ribbon-pin.style-1 .ribbon-pin-inner,{{WRAPPER}} .plus-pricing-table .pricing-ribbon-pin.style-2,{{WRAPPER}} .plus-pricing-table .pricing-ribbon-pin.style-3' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'ribbon_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .plus-pricing-table .pricing-ribbon-pin.style-1 .ribbon-pin-inner,{{WRAPPER}} .plus-pricing-table .pricing-ribbon-pin.style-2',
				'separator' => 'before',
				'condition' => array(
					'ribbon_pin_style' => array( 'style-1', 'style-2' ),
				),
			)
		);
		$this->add_control(
			'ribbon_bg_style_3',
			array(
				'label'     => esc_html__( 'Background Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#212121',
				'selectors' => array(
					'{{WRAPPER}} .plus-pricing-table .pricing-ribbon-pin.style-3' => 'background: {{VALUE}};',
					'{{WRAPPER}} .plus-pricing-table .pricing-ribbon-pin.style-3:after' => 'border-top-color: {{VALUE}};border-left-color: {{VALUE}};',
				),
				'condition' => array(
					'ribbon_pin_style' => array( 'style-3' ),
				),
			)
		);
		$this->add_responsive_control(
			'ribbon_pin_width',
			array(
				'label'      => esc_html__( 'Max-Width', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 2,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 120,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-pricing-table .pricing-ribbon-pin.style-2' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'ribbon_pin_style' => 'style-2',
				),
			)
		);
		$this->add_responsive_control(
			'ribbon_pin_adjust',
			array(
				'label'      => esc_html__( 'Adjust Pin Text', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 300,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 20,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-pricing-table .pricing-ribbon-pin.style-2 .ribbon-pin-inner' => 'margin-top: -{{SIZE}}{{UNIT}};margin-left: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'ribbon_pin_style' => 'style-2',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_bg_option_styling',
			array(
				'label' => esc_html__( 'Background Options', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'bg_padding',
			array(
				'label'      => esc_html__( 'Inner Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-pricing-table.pricing-style-1 .pricing-table-inner,{{WRAPPER}} .plus-pricing-table.pricing-style-2 .pricing-table-inner,{{WRAPPER}} .plus-pricing-table.pricing-style-3 .pricing-top-part' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'box_border',
			array(
				'label'     => esc_html__( 'Box Border', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'default'   => 'no',
			)
		);
		$this->start_controls_tabs( 'tabs_border_style' );
		$this->start_controls_tab(
			'tab_border_normal',
			array(
				'label'     => esc_html__( 'Normal', 'tpebl' ),
				'condition' => array(
					'box_border' => 'yes',
				),
			)
		);
		$this->add_control(
			'box_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .plus-pricing-table.pricing-style-1 .pricing-table-inner,{{WRAPPER}} .plus-pricing-table.pricing-style-2 .pricing-table-inner,{{WRAPPER}} .plus-pricing-table.pricing-style-3 .pricing-top-part' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'box_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'box_border_width',
			array(
				'label'      => esc_html__( 'Border Width', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'top'    => 1,
					'right'  => 1,
					'bottom' => 1,
					'left'   => 1,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-pricing-table.pricing-style-1 .pricing-table-inner,{{WRAPPER}} .plus-pricing-table.pricing-style-2 .pricing-table-inner,{{WRAPPER}} .plus-pricing-table.pricing-style-3 .pricing-top-part' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'box_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-pricing-table.pricing-style-1 .pricing-table-inner,{{WRAPPER}} .plus-pricing-table.pricing-style-2 .pricing-table-inner,{{WRAPPER}} .plus-pricing-table.pricing-style-3 .pricing-top-part' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'box_border' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_border_hover',
			array(
				'label'     => esc_html__( 'Hover', 'tpebl' ),
				'condition' => array(
					'box_border' => 'yes',
				),
			)
		);
		$this->add_control(
			'box_border_hover_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .plus-pricing-table.pricing-style-1:hover .pricing-table-inner,{{WRAPPER}} .plus-pricing-table.pricing-style-2:hover .pricing-table-inner,{{WRAPPER}} .plus-pricing-table.pricing-style-3:hover .pricing-top-part' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'box_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'border_hover_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-pricing-table.pricing-style-1:hover .pricing-table-inner,{{WRAPPER}} .plus-pricing-table.pricing-style-2:hover .pricing-table-inner,{{WRAPPER}} .plus-pricing-table.pricing-style-3:hover .pricing-top-part' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'box_border' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'background_options',
			array(
				'label'     => esc_html__( 'Background Options', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'bg_hover_animation',
			array(
				'label'   => esc_html__( 'Background Hover Animation', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'hover_normal',
				'options' => array(
					'hover_normal'       => esc_html__( 'Select Hover Bg Animation', 'tpebl' ),
					'hover_fadein'       => esc_html__( 'FadeIn (Pro)', 'tpebl' ),
					'hover_slide_left'   => esc_html__( 'SlideInLeft (Pro)', 'tpebl' ),
					'hover_slide_right'  => esc_html__( 'SlideInRight (Pro)', 'tpebl' ),
					'hover_slide_top'    => esc_html__( 'SlideInTop (Pro)', 'tpebl' ),
					'hover_slide_bottom' => esc_html__( 'SlideInBotton (Pro)', 'tpebl' ),
				),
			)
		);
		$this->start_controls_tabs( 'tabs_background_style' );
		$this->start_controls_tab(
			'tab_background_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'box_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .plus-pricing-table.pricing-style-1 .pricing-table-inner',

			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_background_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'box_hover_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .plus-pricing-table.pricing-style-1:hover .pricing-table-inner',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'shadow_options',
			array(
				'label'     => esc_html__( 'Box Shadow Options', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->start_controls_tabs( 'tabs_shadow_style' );
		$this->start_controls_tab(
			'tab_shadow_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'box_shadow',
				'selector' => '{{WRAPPER}} .plus-pricing-table.pricing-style-1 .pricing-table-inner,{{WRAPPER}} .plus-pricing-table.pricing-style-2 .pricing-table-inner,{{WRAPPER}} .plus-pricing-table.pricing-style-3 .pricing-top-part',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_shadow_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'box_hover_shadow',
				'selector' => '{{WRAPPER}} .plus-pricing-table.pricing-style-1:hover .pricing-table-inner,{{WRAPPER}} .plus-pricing-table.pricing-style-2:hover .pricing-table-inner,{{WRAPPER}} .plus-pricing-table.pricing-style-3:hover .pricing-top-part',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_extra_options_styling',
			array(
				'label' => esc_html__( 'Extra Effects', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'transform_scale',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Scale Zoom', 'tpebl' ),
				'default'     => array(
					'unit' => '',
					'size' => 1,
				),
				'range'       => array(
					'' => array(
						'min'  => 0.6,
						'max'  => 1.8,
						'step' => 0.05,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .plus-pricing-table.pricing-style-1 .pricing-table-inner,{{WRAPPER}} .plus-pricing-table.pricing-style-2 .pricing-table-inner,{{WRAPPER}} .plus-pricing-table.pricing-style-3 .pricing-top-part' => 'transform: scale({{SIZE}});',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_plus_extra_adv',
			array(
				'label' => esc_html__( 'Plus Extras', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_ADVANCED,
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_animation_styling',
			array(
				'label' => esc_html__( 'On Scroll View Animation', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'animation_effects',
			array(
				'label'   => esc_html__( 'Choose Animation Effect', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'no-animation',
				'options' => l_theplus_get_animation_options(),
			)
		);
		$this->add_control(
			'animation_delay',
			array(
				'type'      => Controls_Manager::SLIDER,
				'label'     => esc_html__( 'Animation Delay', 'tpebl' ),
				'default'   => array(
					'unit' => '',
					'size' => 50,
				),
				'range'     => array(
					'' => array(
						'min'  => 0,
						'max'  => 4000,
						'step' => 15,
					),
				),
				'condition' => array(
					'animation_effects!' => 'no-animation',
				),
			)
		);
		$this->add_control(
			'animation_duration_default',
			array(
				'label'     => esc_html__( 'Animation Duration', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'condition' => array(
					'animation_effects!' => 'no-animation',
				),
			)
		);
		$this->add_control(
			'animate_duration',
			array(
				'type'      => Controls_Manager::SLIDER,
				'label'     => esc_html__( 'Duration Speed', 'tpebl' ),
				'default'   => array(
					'unit' => 'px',
					'size' => 50,
				),
				'range'     => array(
					'px' => array(
						'min'  => 100,
						'max'  => 10000,
						'step' => 100,
					),
				),
				'condition' => array(
					'animation_effects!'         => 'no-animation',
					'animation_duration_default' => 'yes',
				),
			)
		);
		$this->add_control(
			'animation_out_effects',
			array(
				'label'     => esc_html__( 'Out Animation Effect', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'no-animation',
				'options'   => l_theplus_get_out_animation_options(),
				'separator' => 'before',
				'condition' => array(
					'animation_effects!' => 'no-animation',
				),
			)
		);
		$this->add_control(
			'animation_out_delay',
			array(
				'type'      => Controls_Manager::SLIDER,
				'label'     => esc_html__( 'Out Animation Delay', 'tpebl' ),
				'default'   => array(
					'unit' => '',
					'size' => 50,
				),
				'range'     => array(
					'' => array(
						'min'  => 0,
						'max'  => 4000,
						'step' => 15,
					),
				),
				'condition' => array(
					'animation_effects!'     => 'no-animation',
					'animation_out_effects!' => 'no-animation',
				),
			)
		);
		$this->add_control(
			'animation_out_duration_default',
			array(
				'label'     => esc_html__( 'Out Animation Duration', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'condition' => array(
					'animation_effects!'     => 'no-animation',
					'animation_out_effects!' => 'no-animation',
				),
			)
		);
		$this->add_control(
			'animation_out_duration',
			array(
				'type'      => Controls_Manager::SLIDER,
				'label'     => esc_html__( 'Duration Speed', 'tpebl' ),
				'default'   => array(
					'unit' => 'px',
					'size' => 50,
				),
				'range'     => array(
					'px' => array(
						'min'  => 100,
						'max'  => 10000,
						'step' => 100,
					),
				),
				'condition' => array(
					'animation_effects!'             => 'no-animation',
					'animation_out_effects!'         => 'no-animation',
					'animation_out_duration_default' => 'yes',
				),
			)
		);
		$this->end_controls_section();

		include L_THEPLUS_PATH . 'modules/widgets/theplus-needhelp.php';
		include L_THEPLUS_PATH . 'modules/widgets/theplus-profeatures.php';
	}

	/**
	 * Render Progress Bar
	 *
	 * Written in PHP and HTML.
	 *
	 * @since 1.0.0
	 * @version 5.5.4
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		$title_style   = ! empty( $settings['title_style'] ) ? $settings['title_style'] : '';
		$pricing_style = ! empty( $settings['pricing_table_style'] ) ? $settings['pricing_table_style'] : '';
		$pricing_title = ! empty( $settings['pricing_title'] ) ? $settings['pricing_title'] : '';

		$pricing_subtitle = ! empty( $settings['pricing_subtitle'] ) ? $settings['pricing_subtitle'] : '';

		$title = '';
		if ( ! empty( $pricing_title ) ) {
			$title     .= '<div class="pricing-title-wrap">';
				$title .= '<div class="pricing-title">' . wp_kses_post( $pricing_title ) . '</div>';
			$title     .= '</div>';
		}

		$subtitle = '';
		if ( ! empty( $pricing_subtitle ) ) {
			$subtitle     .= '<div class="pricing-subtitle-wrap">';
				$subtitle .= '<div class="pricing-subtitle">' . wp_kses_post( $pricing_subtitle ) . '</div>';
			$subtitle     .= '</div>';
		}

		$icons_content = '';
		$image_icon    = ! empty( $settings['image_icon'] ) ? $settings['image_icon'] : '';

		if ( 'image' === $image_icon ) {

			$pimg_url = ! empty( $settings['select_image'] ) ? $settings['select_image'] : '';

			$img_src = '';
			if ( ! empty( $pimg_url ) ) {
				$image_id = $pimg_url['id'];
				$img_src  = tp_get_image_rander( $image_id, 'full', array( 'class' => 'pricing-icon-img' ) );
			}

			$icons_content = '<div class="pricing-icon">' . $img_src . '</div>';
		}

		$icon_style = ! empty( $settings['icon_style'] ) ? $settings['icon_style'] : '';

		$service_icon_style = '';
		if ( 'square' === $icon_style ) {
			$service_icon_style = 'icon-squre';
		}

		if ( 'rounded' === $icon_style ) {
			$service_icon_style = 'icon-rounded';
		}

		if ( 'icon' === $image_icon ) {

			$if_style = ! empty( $settings['icon_font_style'] ) ? $settings['icon_font_style'] : '';

			if ( 'font_awesome' === $if_style ) {
				$icons = $settings['icon_fontawesome'];
			} else {
				$icons = '';
			}

			$icon_bg = tp_bg_lazyLoad( $settings['icon_background_image'], $settings['icon_hover_background_image'] );
			if ( ! empty( $icons ) ) {
				$icons_content = '<div class="pricing-icon ' . esc_attr( $service_icon_style ) . ' ' . $icon_bg . '"><i class=" ' . esc_attr( $icons ) . ' "></i></div>';
			}
		}

		$border_stroke_color = 'none';

		$content_style   = ! empty( $settings['content_style'] ) ? $settings['content_style'] : '';
		$content_wysiwyg = ! empty( $settings['content_wysiwyg'] ) ? $settings['content_wysiwyg'] : '';

		$pricing_content = '';
		$i               = 0;
		if ( 'wysiwyg_content' === $content_style && ! empty( $content_wysiwyg ) ) {
			$content_wys = ! empty( $settings['content_wysiwyg_style'] ) ? $settings['content_wysiwyg_style'] : 'style-1';

			$pricing_content .= '<div class="pricing-content-wrap content-desc ' . esc_attr( $content_wys ) . '">';
			if ( 'style-1' === $content_wys ) {
				$pricing_content .= '<hr class="border-line" />';
			}

			$pricing_content .= '<div class="pricing-content">';

			$pricing_content .= wp_kses_post( $content_wysiwyg );

			$pricing_content .= '</div>';

			$pricing_content .= '<div class="content-overlay-bg-color"></div>';

			$pricing_content .= '</div>';

		} elseif ( 'stylist_list' === $content_style ) {
			$con_lstyle = ! empty( $settings['content_list_style'] ) ? $settings['content_list_style'] : 'style-1';

			$pricing_content .= '<div class="pricing-content-wrap listing-content ' . esc_attr( $con_lstyle ) . '">';

			$pricing_content .= '<ul class="plus-icon-list-items">';

			foreach ( $settings['icon_list'] as $index => $item ) {
				$repeater_setting_key = $this->get_repeater_setting_key( 'text', 'icon_list', $index );

				$this->add_render_attribute( $repeater_setting_key, 'class', 'plus-icon-list-text' );

				$this->add_inline_editing_attributes( $repeater_setting_key );

				$pricing_content .= '<li class="plus-icon-list-item elementor-repeater-item-' . esc_attr( $item['_id'] ) . '" data-local="true">';

				$icons           = '';
				$list_icon_style = ! empty( $item['list_icon_style'] ) ? $item['list_icon_style'] : 'font_awesome';
				if ( 'font_awesome' === $list_icon_style ) {
					$icons = $item['list_icon_fontawesome'];
				}

				if ( ! empty( $icons ) ) {
					$pricing_content .= '<span class="plus-icon-list-icon">';

						$pricing_content .= '<i class="' . esc_attr( $icons ) . '" aria-hidden="true"></i>';

						$pricing_content .= '</span>';
				}

				$pricing_content .= '<span ' . $this->get_render_attribute_string( $repeater_setting_key ) . '>' . wp_kses_post( $item['list_description'] ) . '</span>';
				$pricing_content .= '</li>';

				++$i;
			}

			$pricing_content .= '</ul>';

			if ( 'style-1' === $con_lstyle ) {
				$pricing_content .= '<div class="content-overlay-bg-color"></div>';
			}

			$pricing_content .= '</div>';
		}

		$previous_price_content = '';

		$pre_price = ! empty( $settings['show_previous_price'] ) ? $settings['show_previous_price'] : '';

		if ( 'yes' === $pre_price ) {
			$previous_price = ! empty( $settings['previous_price'] ) ? $settings['previous_price'] : '';

			$previous_price_prefix   = ! empty( $settings['previous_price_prefix'] ) ? $settings['previous_price_prefix'] : '';
			$previous_price_postfix  = ! empty( $settings['previous_price_postfix'] ) ? $settings['previous_price_postfix'] : '';
			$previous_price_content .= '<span class="pricing-previous-price-wrap">' . esc_html( $previous_price_prefix ) . esc_html( $previous_price ) . esc_html( $previous_price_postfix ) . '</span>';
		}

		$price = ! empty( $settings['price'] ) ? $settings['price'] : '';

		$price_style  = ! empty( $settings['price_style'] ) ? $settings['price_style'] : '';
		$price_prefix = ! empty( $settings['price_prefix'] ) ? $settings['price_prefix'] : '';

		$price_postfix = ! empty( $settings['price_postfix'] ) ? $settings['price_postfix'] : '';

		$price_content      = '<div class="pricing-price-wrap ' . esc_attr( $price_style ) . '">';
			$price_content .= $previous_price_content;

		if ( ! empty( $price_prefix ) ) {
			$price_content .= '<span class="price-prefix-text">' . esc_html( $price_prefix ) . '</span>';
		}

		if ( ! empty( $price ) ) {
			$price_content .= '<span class="pricing-price">' . esc_html( $price ) . '</span>';
		}

		if ( ! empty( $price_postfix ) ) {
			$price_content .= '<span class="price-postfix-text">' . esc_html( $price_postfix ) . '</span>';
		}

		$price_content .= '</div>';

		$the_button = '';

		$btn_on   = ! empty( $settings['display_button'] ) ? $settings['display_button'] : '';
		$btn_link = ! empty( $settings['button_link'] ) ? $settings['button_link'] : '';

		if ( 'yes' === $btn_on ) {

			if ( ! empty( $btn_link['url'] ) ) {
				$this->add_render_attribute( 'button', 'href', esc_url( $btn_link['url'] ) );
				if ( $btn_link['is_external'] ) {
					$this->add_render_attribute( 'button', 'target', '_blank' );
				}
				if ( $btn_link['nofollow'] ) {
					$this->add_render_attribute( 'button', 'rel', 'nofollow' );
				}
			}

			$btn_bg = tp_bg_lazyLoad( $settings['button_background_image'], $settings['button_hover_background_image'] );

			$this->add_render_attribute( 'button', 'class', 'button-link-wrap' . $btn_bg );
			$this->add_render_attribute( 'button', 'role', 'button' );

			$button_style = ! empty( $settings['button_style'] ) ? $settings['button_style'] : '';
			$button_text  = $settings['button_text'];

			$btn_uid = uniqid( 'btn' );

			$data_class  = $btn_uid;
			$data_class .= ' button-' . $button_style . ' ';

			$the_button = '<div class="pt-plus-button-wrapper">';

			$the_button .= '<div class="button_parallax">';

				$the_button .= '<div class="ts-button">';

					$the_button .= '<div class="pt_plus_button ' . esc_attr( $data_class ) . '">';

						$the_button .= '<div class="animted-content-inner">';

							$the_button .= '<a ' . $this->get_render_attribute_string( 'button' ) . '>';

							$the_button .= $this->render_text();

							$the_button .= '</a>';

						$the_button .= '</div>';

					$the_button .= '</div>';

				$the_button .= '</div>';

			$the_button .= '</div>';

			$the_button .= '</div>';
		}

		/*Ribbon Pin*/
		$ribbon_content = '';
		$rpinbg         = '';
		// $rpinbg = function_exists( 'tp_has_lazyload' ) ? tp_bg_lazyLoad( $settings['ribbon_background_image'] ) : '';
		if ( ! empty( $settings['display_ribbon_pin'] ) && 'yes' === $settings['display_ribbon_pin'] && 'style-1' === $settings['ribbon_pin_style'] ) {
			$ribbon_style    = $settings['ribbon_pin_style'];
			$ribbon_content .= '<div class="pricing-ribbon-pin ' . $rpinbg . ' ' . esc_attr( $ribbon_style ) . '">';
			$ribbon_content .= '<div class="ribbon-pin-inner ' . $rpinbg . '">';
			$ribbon_content .= wp_kses_post( $settings['ribbon_pin_text'] );
			$ribbon_content .= '</div>';
			$ribbon_content .= '</div>';
		}

		$title_style_content = '';
		if ( 'style-1' === $title_style ) {
			$title_style_content .= '<div class="pricing-title-content style-1">';

			$title_style_content .= $icons_content;
			$title_style_content .= $title;
			$title_style_content .= $subtitle;

			$title_style_content .= '</div>';
		}

		$pricing_output = '';
		if ( 'style-1' === $pricing_style ) {
			$pricing_output .= $ribbon_content;
			$pricing_output .= $title_style_content;
			$pricing_output .= $price_content;

			if ( 'bottom' === $settings['button_top_bottom'] ) {
				$pricing_output .= $pricing_content;
				$pricing_output .= $the_button;
			} else {
				$pricing_output .= $the_button;
				$pricing_output .= $pricing_content;
			}

			$pricing_output .= '<div class="pricing-overlay-color"></div>';
		}

		$animate_duration  = ! empty( $settings['animate_duration']['size'] ) ? $settings['animate_duration']['size'] : 50;
		$animation_effects = ! empty( $settings['animation_effects'] ) ? $settings['animation_effects'] : '';

		$out_duration    = ! empty( $settings['animation_out_duration_default'] ) ? $settings['animation_out_duration_default'] : '';
		$animation_delay = ! empty( $settings['animation_delay']['size'] ) ? $settings['animation_delay']['size'] : 50;

		$ani_duration = ! empty( $settings['animation_duration_default'] ) ? $settings['animation_duration_default'] : '';
		$out_effect   = ! empty( $settings['animation_out_effects'] ) ? $settings['animation_out_effects'] : '';
		$out_delay    = ! empty( $settings['animation_out_delay']['size'] ) ? $settings['animation_out_delay']['size'] : 50;
		$out_speed    = ! empty( $settings['animation_out_duration']['size'] ) ? $settings['animation_out_duration']['size'] : 50;

		if ( 'no-animation' === $animation_effects ) {
			$animated_class = '';
			$animation_attr = '';
		} else {
			$animate_offset  = '85%';
			$animated_class  = 'animate-general';
			$animation_attr  = ' data-animate-type="' . esc_attr( $animation_effects ) . '" data-animate-delay="' . esc_attr( $animation_delay ) . '"';
			$animation_attr .= ' data-animate-offset="' . esc_attr( $animate_offset ) . '"';

			if ( 'yes' === $ani_duration ) {
				$animation_attr .= ' data-animate-duration="' . esc_attr( $animate_duration ) . '"';
			}

			if ( 'no-animation' !== $out_effect ) {
				$animation_attr .= ' data-animate-out-type="' . esc_attr( $out_effect ) . '" data-animate-out-delay="' . esc_attr( $out_delay ) . '"';

				if ( 'yes' === $out_duration ) {
					$animation_attr .= ' data-animate-out-duration="' . esc_attr( $out_speed ) . '"';
				}
			}
		}

		$output = '<div id="plus-pricing-table" class="plus-pricing-table pricing-' . esc_attr( $pricing_style ) . ' ' . esc_attr( $animated_class ) . '" ' . $animation_attr . '>';

			$pt_bg = tp_bg_lazyLoad( $settings['box_background_image'], $settings['box_hover_background_image'] );

			$output .= '<div class="pricing-table-inner ' . $pt_bg . '">';

			$output .= $pricing_output;

			$output .= '</div>';

		$output .= '</div>';

		echo $output;
	}

	/**
	 * Load Widget Render text
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	protected function render_text() {
		$icons_after  = '';
		$icons_before = '';
		$settings     = $this->get_settings_for_display();

		$button_style = ! empty( $settings['button_style'] ) ? $settings['button_style'] : '';
		$before_after = ! empty( $settings['before_after'] ) ? $settings['before_after'] : '';
		$button_text  = ! empty( $settings['button_text'] ) ? $settings['button_text'] : '';
		$i_style      = ! empty( $settings['button_icon_style'] ) ? $settings['button_icon_style'] : '';

		$icons = '';
		if ( 'font_awesome' === $i_style ) {
			$icons = $settings['button_icon'];
		}

		if ( 'before' === $before_after && ! empty( $icons ) ) {
			$icons_before = '<i class="btn-icon button-before ' . esc_attr( $icons ) . '"></i>';
		}

		if ( 'after' === $before_after && ! empty( $icons ) ) {
			$icons_after = '<i class="btn-icon button-after ' . esc_attr( $icons ) . '"></i>';
		}

		if ( 'style-8' === $button_style ) {
			$button_text = $icons_before . wp_kses_post( $button_text ) . $icons_after;
		}

		return $button_text;
	}
}
