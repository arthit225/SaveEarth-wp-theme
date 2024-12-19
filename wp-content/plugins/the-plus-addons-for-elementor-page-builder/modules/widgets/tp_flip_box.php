<?php
/**
 * Widget Name: Flip Box
 * Description: Display Flipbox.
 * Author: Theplus
 * Author URI: https://posimyth.com
 *
 * @package ThePlus
 */

namespace TheplusAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class L_ThePlus_Flip_Box
 */
class L_ThePlus_Flip_Box extends Widget_Base {

	/**
	 * Get Widget Name.
	 *
	 * @since 1.0.0
	 */
	public function get_name() {
		return 'tp-flip-box';
	}

	/**
	 * Helpdesk Link For Need help.
	 *
	 * @var tp_help of the class.
	 */
	public $tp_help = L_THEPLUS_HELP;

	/**
	 * Get Widget Title.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Flip Box', 'tpebl' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-dot-circle-o theplus_backend_icon';
	}

	/**
	 * Get Widget categories.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_categories() {
		return array( 'plus-creatives' );
	}

	/**
	 * Get Widget keywords.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_keywords() {
		return array( 'Flipbox', 'Flip Box', ' Flip-card', 'Card flip', 'Box flip', 'Elementor flipbox', 'Elementor flip box', 'Elementor flip-card', 'Elementor card flip', ' Elementor box flip' );
	}

	/**
	 * Get Widget Custom Help Url.
	 *
	 * @version 5.4.2
	 */
	public function get_custom_help_url() {
		$help_url = $this->tp_help;

		return esc_url( $help_url );
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
				'label' => esc_html__( 'Content', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'info_box_layout',
			array(
				'label'   => esc_html__( 'Select Layout', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'single_layout',
				'options' => array(
					'single_layout'   => esc_html__( 'Listing', 'tpebl' ),
					'carousel_layout' => esc_html__( 'Carousel (PRO)', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'plus_pro_info_box_layout_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'info_box_layout' => 'carousel_layout',
				),
			)
		);
		$this->add_control(
			'flip_style',
			array(
				'label'     => esc_html__( 'Flip Type', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'horizontal',
				'options'   => array(
					'horizontal' => esc_html__( 'Horizontal', 'tpebl' ),
					'vertical'   => esc_html__( 'Vertical', 'tpebl' ),
				),
				'condition' => array(
					'info_box_layout' => 'single_layout',
				),
			)
		);
		$this->add_responsive_control(
			'flip_box_height',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Box Height', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 50,
						'max'  => 700,
						'step' => 5,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 300,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-flipbox,{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-flipbox-front,{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-flipbox-back' => 'min-height: {{SIZE}}{{UNIT}}',
				),
				'condition'   => array(
					'info_box_layout' => 'single_layout',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'front_content_section',
			array(
				'label'     => esc_html__( 'Front Side', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'info_box_layout' => 'single_layout',
				),
			)
		);
		$this->add_control(
			'front_options',
			array(
				'label'     => esc_html__( 'Front Options', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'info_box_layout' => 'single_layout',
				),
			)
		);
		$this->add_control(
			'title',
			array(
				'label'     => esc_html__( 'Title', 'tpebl' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'The Plus', 'tpebl' ),
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'info_box_layout' => 'single_layout',
				),
			)
		);

		$this->add_control(
			'image_icon',
			array(
				'label'     => esc_html__( 'Select Icon', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'icon',
				'options'   => array(
					''      => esc_html__( 'None', 'tpebl' ),
					'icon'  => esc_html__( 'Icon', 'tpebl' ),
					'image' => esc_html__( 'Image', 'tpebl' ),
					'svg'   => esc_html__( 'Svg (Pro)', 'tpebl' ),
				),
				'condition' => array(
					'info_box_layout' => 'single_layout',
				),
			)
		);
		$this->add_control(
			'icon_Note',
			array(
				'type'        => Controls_Manager::RAW_HTML,
				'raw'         => '<p class="tp-controller-notice"><i>You can select Icon, Custom Image or SVG using this option.</i></p>',
				'label_block' => true,
			)
		);
		$this->add_control(
			'plus_pro_image_icon_svg_options',
			array(
				'label'       => __( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'info_box_layout' => 'single_layout',
					'image_icon'      => 'svg',
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
				'dynamic'    => array(
					'active' => true,
				),
				'condition'  => array(
					'info_box_layout' => 'single_layout',
					'image_icon'      => 'image',
				),
			)
		);
		$this->add_responsive_control(
			'select_image_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Image Max-Width', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 10,
						'max'  => 700,
						'step' => 5,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .pt_plus_info_box.info-box-style_5 .service-img' => 'max-width: {{SIZE}}{{UNIT}}',
				),
				'condition'   => array(
					'info_box_layout' => 'single_layout',
					'image_icon'      => 'image',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'select_image_thumbnail',
				'default'   => 'full',
				'separator' => 'none',
				'condition' => array(
					'info_box_layout' => 'single_layout',
					'image_icon'      => 'image',
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
					'font_awesome'   => esc_html__( 'Font Awesome', 'tpebl' ),
					'font_awesome_5' => esc_html__( 'Font Awesome 5', 'tpebl' ),
					'icon_mind'      => esc_html__( 'Icons Mind (Pro)', 'tpebl' ),
				),
				'condition' => array(
					'info_box_layout' => 'single_layout',
					'image_icon'      => 'icon',
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
					'info_box_layout' => 'single_layout',
					'image_icon'      => 'icon',
					'icon_font_style' => 'font_awesome',
				),
			)
		);
		$this->add_control(
			'icon_fontawesome_5',
			array(
				'label'     => esc_html__( 'Icon Library', 'tpebl' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-plus',
					'library' => 'solid',
				),
				'condition' => array(
					'info_box_layout' => 'single_layout',
					'image_icon'      => 'icon',
					'icon_font_style' => 'font_awesome_5',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'back_content_section',
			array(
				'label'     => esc_html__( 'Back Side', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'info_box_layout' => 'single_layout',
				),
			)
		);
		$this->add_control(
			'back_options',
			array(
				'label'     => esc_html__( 'Back Options', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'info_box_layout' => 'single_layout',
				),
			)
		);
		$this->add_control(
			'content_desc',
			array(
				'label'       => esc_html__( 'Description', 'tpebl' ),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => esc_html__( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'tpebl' ),
				'placeholder' => esc_html__( 'Type your description here', 'tpebl' ),
				'condition'   => array(
					'info_box_layout' => 'single_layout',
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
				'default'   => 'no',
				'separator' => 'before',
				'condition' => array(
					'info_box_layout' => 'single_layout',
				),
			)
		);
		$this->add_control(
			'button_style',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Button Style', 'tpebl' ),
				'default'   => 'style-8',
				'options'   => array(
					'style-7' => esc_html__( 'Style 1 (Pro)', 'tpebl' ),
					'style-8' => esc_html__( 'Style 2', 'tpebl' ),
					'style-9' => esc_html__( 'Style 3 (Pro)', 'tpebl' ),
				),
				'condition' => array(
					'info_box_layout' => 'single_layout',
					'display_button'  => 'yes',
				),
			)
		);
		$this->add_control(
			'button_pro_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'info_box_layout' => 'single_layout',
					'display_button'  => 'yes',
					'button_style!'   => 'style-8',
				),
			)
		);
		$this->add_control(
			'button_text',
			array(
				'label'       => esc_html__( 'Text', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
				'default'     => esc_html__( 'Read More', 'tpebl' ),
				'placeholder' => esc_html__( 'Read More', 'tpebl' ),
				'condition'   => array(
					'info_box_layout' => 'single_layout',
					'display_button'  => 'yes',
					'button_style'    => 'style-8',
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
					'info_box_layout' => 'single_layout',
					'display_button'  => 'yes',
					'button_style'    => 'style-8',
				),
			)
		);
		$this->add_control(
			'button_icon_font_style',
			array(
				'label'     => esc_html__( 'Icon Font', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'font_awesome',
				'options'   => array(
					'font_awesome'   => esc_html__( 'Font Awesome', 'tpebl' ),
					'font_awesome_5' => esc_html__( 'Font Awesome 5', 'tpebl' ),
					'icon_mind'      => esc_html__( 'Icons Mind (Pro)', 'tpebl' ),
				),
				'condition' => array(
					'info_box_layout' => 'single_layout',
					'display_button'  => 'yes',
					'button_style!'   => array( 'style-7', 'style-9' ),
				),
			)
		);
		$this->add_control(
			'icon_mind_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'info_box_layout'        => 'single_layout',
					'display_button'         => 'yes',
					'button_style!'          => array( 'style-7', 'style-9' ),
					'button_icon_font_style' => 'icon_mind',
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
					'info_box_layout'        => 'single_layout',
					'display_button'         => 'yes',
					'button_style!'          => array( 'style-7', 'style-9' ),
					'button_icon_font_style' => 'font_awesome',
				),
			)
		);
		$this->add_control(
			'button_icon_5',
			array(
				'label'     => esc_html__( 'Icon Library', 'tpebl' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-plus',
					'library' => 'solid',
				),
				'condition' => array(
					'info_box_layout'        => 'single_layout',
					'display_button'         => 'yes',
					'button_style!'          => array( 'style-7', 'style-9' ),
					'button_icon_font_style' => 'font_awesome_5',
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
					'info_box_layout'         => 'single_layout',
					'display_button'          => 'yes',
					'button_style!'           => array( 'style-7', 'style-9' ),
					'button_icon_font_style!' => '',
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
					'info_box_layout'         => 'single_layout',
					'display_button'          => 'yes',
					'button_style!'           => array( 'style-7', 'style-9' ),
					'button_icon_font_style!' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .button-link-wrap .button-after' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .button-link-wrap .button-before' => 'margin-right: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_svg_styling',
			array(
				'label'      => esc_html__( 'Front Svg Icon', 'tpebl' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'image_icon',
							'operator' => '==',
							'value'    => 'svg',
						),
					),
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
				'label'      => esc_html__( 'Front Icon', 'tpebl' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'image_icon',
							'operator' => '==',
							'value'    => 'icon',
						),
					),
				),
			)
		);
		$this->add_control(
			'icon_style',
			array(
				'label'   => esc_html__( 'Icon Styles', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'square',
				'options' => array(
					''              => esc_html__( 'None', 'tpebl' ),
					'square'        => esc_html__( 'Square', 'tpebl' ),
					'rounded'       => esc_html__( 'Rounded', 'tpebl' ),
					'hexagon'       => esc_html__( 'Hexagon', 'tpebl' ),
					'pentagon'      => esc_html__( 'Pentagon', 'tpebl' ),
					'square-rotate' => esc_html__( 'Square Rotate', 'tpebl' ),
				),
			)
		);
		$this->add_responsive_control(
			'icon_size',
			array(
				'type'            => Controls_Manager::SLIDER,
				'label'           => esc_html__( 'Icon Size', 'tpebl' ),
				'range'           => array(
					'px' => array(
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					),
				),
				'devices'         => array( 'desktop', 'tablet', 'mobile' ),
				'desktop_default' => array(
					'unit' => 'px',
					'size' => 25,
				),
				'tablet_default'  => array(
					'unit' => 'px',
					'size' => 25,
				),
				'mobile_default'  => array(
					'unit' => 'px',
					'size' => 25,
				),
				'selectors'       => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon' => 'font-size: {{SIZE}}{{UNIT}} !important;',
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon svg' => 'width: {{SIZE}}{{UNIT}} !important;height: {{SIZE}}{{UNIT}} !important;',
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
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon' => 'width: {{SIZE}}{{UNIT}} !important;height: {{SIZE}}{{UNIT}} !important;line-height: {{SIZE}}{{UNIT}} !important;text-align: center;',
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
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon:before,
					{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon i:before' => 'color: {{VALUE}};background: transparent;-webkit-background-clip: unset;-webkit-text-fill-color: initial;',
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon svg' => 'fill: {{VALUE}};background: transparent;-webkit-background-clip: unset;-webkit-text-fill-color: initial;',
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
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon:before,
					{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon i:before' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{icon_gradient_color1.VALUE}} {{icon_gradient_color1_control.SIZE}}{{icon_gradient_color1_control.UNIT}}, {{icon_gradient_color2.VALUE}} {{icon_gradient_color2_control.SIZE}}{{icon_gradient_color2_control.UNIT}});-webkit-transition: all 0.3s linear;-moz-transition: all 0.3s linear;-o-transition: all 0.3s linear;-ms-transition: all 0.3s linear;transition: all 0.3s linear;',
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
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon:before,
					{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon i:before' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{icon_gradient_color1.VALUE}} {{icon_gradient_color1_control.SIZE}}{{icon_gradient_color1_control.UNIT}}, {{icon_gradient_color2.VALUE}} {{icon_gradient_color2_control.SIZE}}{{icon_gradient_color2_control.UNIT}});-webkit-transition: all 0.3s linear;-moz-transition: all 0.3s linear;-o-transition: all 0.3s linear;-ms-transition: all 0.3s linear;transition: all 0.3s linear;',
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
				'selector'  => '{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'icon_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon' => 'border-color: {{VALUE}}',
				),
				'separator' => 'before',
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
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-icon:before,
					{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon i:before' => 'color: {{VALUE}};background: transparent;-webkit-background-clip: unset;-webkit-text-fill-color: initial;',
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-icon svg' => 'fill: {{VALUE}};background: transparent;-webkit-background-clip: unset;-webkit-text-fill-color: initial;',
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
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-icon:before,
					{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon i:before' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{icon_hover_gradient_color1.VALUE}} {{icon_hover_gradient_color1_control.SIZE}}{{icon_hover_gradient_color1_control.UNIT}}, {{icon_hover_gradient_color2.VALUE}} {{icon_hover_gradient_color2_control.SIZE}}{{icon_hover_gradient_color2_control.UNIT}})',
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
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-icon:before,
					{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon i:before' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{icon_hover_gradient_color1.VALUE}} {{icon_hover_gradient_color1_control.SIZE}}{{icon_hover_gradient_color1_control.UNIT}}, {{icon_hover_gradient_color2.VALUE}} {{icon_hover_gradient_color2_control.SIZE}}{{icon_hover_gradient_color2_control.UNIT}})',
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
				'selector'  => '{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-icon',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'icon_border_hover_color',
			array(
				'label'     => esc_html__( 'Hover Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-icon' => 'border-color: {{VALUE}}',
				),
				'separator' => 'before',
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_styling',
			array(
				'label' => esc_html__( 'Front Title', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typography', 'tpebl' ),
				'selector' => '{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-title',
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
						'icon'  => 'fa fa-barcode',
					),
				),
				'default'     => 'solid',
				'label_block' => false,
			)
		);
		$this->add_control(
			'title_color',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-title' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-title' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{title_gradient_color1.VALUE}} {{title_gradient_color1_control.SIZE}}{{title_gradient_color1_control.UNIT}}, {{title_gradient_color2.VALUE}} {{title_gradient_color2_control.SIZE}}{{title_gradient_color2_control.UNIT}})',
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
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-title' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{title_gradient_color1.VALUE}} {{title_gradient_color1_control.SIZE}}{{title_gradient_color1_control.UNIT}}, {{title_gradient_color2.VALUE}} {{title_gradient_color2_control.SIZE}}{{title_gradient_color2_control.UNIT}})',
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
				'default'     => 'solid',
				'label_block' => false,
			)
		);
		$this->add_control(
			'title_hover_color',
			array(
				'label'     => esc_html__( 'Hover Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#3351a6',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-title' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-title' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{title_hover_gradient_color1.VALUE}} {{title_hover_gradient_color1_control.SIZE}}{{title_hover_gradient_color1_control.UNIT}}, {{title_hover_gradient_color2.VALUE}} {{title_hover_gradient_color2_control.SIZE}}{{title_hover_gradient_color2_control.UNIT}})',
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
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-title' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{title_hover_gradient_color1.VALUE}} {{title_hover_gradient_color1_control.SIZE}}{{title_hover_gradient_color1_control.UNIT}}, {{title_hover_gradient_color2.VALUE}} {{title_hover_gradient_color2_control.SIZE}}{{title_hover_gradient_color2_control.UNIT}})',
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
		$this->add_responsive_control(
			'title_top_space',
			array(
				'type'            => Controls_Manager::SLIDER,
				'label'           => esc_html__( 'Title Top Space', 'tpebl' ),
				'range'           => array(
					'px' => array(
						'step' => 2,
						'min'  => -150,
						'max'  => 150,
					),
				),
				'devices'         => array( 'desktop', 'tablet', 'mobile' ),
				'desktop_default' => array(
					'unit' => 'px',
					'size' => 0,
				),
				'tablet_default'  => array(
					'unit' => 'px',
					'size' => 0,
				),
				'mobile_default'  => array(
					'unit' => 'px',
					'size' => 0,
				),
				'selectors'       => array(
					'{{WRAPPER}} .pt_plus_info_box.info-box-style_5 .info-box-inner .service-title' => 'margin-top : {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
			'title_btm_space',
			array(
				'type'            => Controls_Manager::SLIDER,
				'label'           => esc_html__( 'Title Bottom Space', 'tpebl' ),
				'range'           => array(
					'px' => array(
						'step' => 2,
						'min'  => -150,
						'max'  => 150,
					),
				),
				'devices'         => array( 'desktop', 'tablet', 'mobile' ),
				'desktop_default' => array(
					'unit' => 'px',
					'size' => 0,
				),
				'tablet_default'  => array(
					'unit' => 'px',
					'size' => 0,
				),
				'mobile_default'  => array(
					'unit' => 'px',
					'size' => 0,
				),
				'selectors'       => array(
					'{{WRAPPER}} .pt_plus_info_box.info-box-style_5 .info-box-inner .service-title' => 'margin-bottom : {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_desc_styling',
			array(
				'label' => esc_html__( 'Back Description', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'desc_typography',
				'label'    => esc_html__( 'Typography', 'tpebl' ),
				'selector' => '{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-desc,{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-desc p',
			)
		);
		$this->add_control(
			'desc_hover_color',
			array(
				'label'     => esc_html__( 'Desc Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-desc,{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-desc p' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_button_styling',
			array(
				'label'      => esc_html__( 'Back Button', 'tpebl' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'display_button',
							'operator' => '==',
							'value'    => 'yes',
						),
					),
				),
			)
		);
		$this->add_responsive_control(
			'button_padding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'default'    => array(
					'top'      => '15',
					'right'    => '30',
					'bottom'   => '15',
					'left'     => '30',
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
		$this->add_control(
			'button_svg_icon',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Svg Icon Size', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 150,
						'step' => 2,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 20,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .pt_plus_button .button-link-wrap svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
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
					'{{WRAPPER}} .pt_plus_button .button-link-wrap svg' => 'fill: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'button_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap',
				'condition' => array(
					'button_style' => 'style-8',
				),
			)
		);
		$this->add_control(
			'button_border_style',
			array(
				'label'      => esc_html__( 'Border Style', 'tpebl' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'solid',
				'options'    => array(
					'none'   => esc_html__( 'None', 'tpebl' ),
					'solid'  => esc_html__( 'Solid', 'tpebl' ),
					'dotted' => esc_html__( 'Dotted', 'tpebl' ),
					'dashed' => esc_html__( 'Dashed', 'tpebl' ),
					'groove' => esc_html__( 'Groove', 'tpebl' ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap' => 'border-style: {{VALUE}};',
				),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'button_style',
							'operator' => '==',
							'value'    => 'style-8',
						),
					),
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
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'button_style',
							'operator' => '==',
							'value'    => 'style-8',
						),
					),
				),
			)
		);

		$this->add_control(
			'button_border_color',
			array(
				'label'      => esc_html__( 'Border Color', 'tpebl' ),
				'type'       => Controls_Manager::COLOR,
				'default'    => '#313131',
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap' => 'border-color: {{VALUE}};',
				),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'button_style',
							'operator' => '==',
							'value'    => 'style-8',
						),
					),
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'button_shadow',
				'selector'  => '{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap',
				'condition' => array(
					'button_style' => 'style-8',
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
					'{{WRAPPER}} .pt_plus_button .button-link-wrap:hover svg' => 'fill: {{VALUE}};',
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
					'button_style' => 'style-8',
				),
			)
		);
		$this->add_control(
			'button_border_hover_color',
			array(
				'label'      => esc_html__( 'Hover Border Color', 'tpebl' ),
				'type'       => Controls_Manager::COLOR,
				'default'    => '#313131',
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap:hover' => 'border-color: {{VALUE}};',
				),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'button_style',
							'operator' => '==',
							'value'    => 'style-8',
						),
					),
				),
				'separator'  => 'after',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'button_hover_shadow',
				'selector'  => '{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap:hover',
				'condition' => array(
					'button_style' => 'style-8',
				),
			)
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_bg_option_styling',
			array(
				'label' => esc_html__( 'Background Options', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
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
		$this->add_control(
			'box_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-flipbox-front,{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-flipbox-back' => 'border-color: {{VALUE}};',
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
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-flipbox-front,{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-flipbox-back' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'box_border' => 'yes',
				),
			)
		);

		$this->add_control(
			'box_border_style',
			array(
				'label'     => esc_html__( 'Border Style', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'solid',
				'options'   => l_theplus_get_border_style(),
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-flipbox-front,{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-flipbox-back' => 'border-style: {{VALUE}};',
				),
				'condition' => array(
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
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-flipbox-front,{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-flipbox-back,{{WRAPPER}} .pt_plus_info_box .infobox-front-overlay,{{WRAPPER}} .pt_plus_info_box .infobox-back-overlay' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_background_style' );
		$this->start_controls_tab(
			'tab_background_front',
			array(
				'label'     => esc_html__( 'Front', 'tpebl' ),
				'condition' => array(
					'info_box_layout' => 'single_layout',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'box_front_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-flipbox-front',
				'condition' => array(
					'info_box_layout' => 'single_layout',
				),
			)
		);
		$this->add_control(
			'box_front_overlay_bg_color',
			array(
				'label'     => esc_html__( 'Overlay Background Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'separator' => 'before',
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .infobox-front-overlay' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'info_box_layout' => 'single_layout',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_background_back',
			array(
				'label'     => esc_html__( 'Back', 'tpebl' ),
				'condition' => array(
					'info_box_layout' => 'single_layout',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'box_back_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-flipbox-back',
				'condition' => array(
					'info_box_layout' => 'single_layout',
				),
			)
		);
		$this->add_control(
			'box_back_overlay_bg_color',
			array(
				'label'     => esc_html__( 'Overlay Background Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'separator' => 'before',
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .infobox-back-overlay' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'info_box_layout' => 'single_layout',
				),
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
			'tab_shadow_front',
			array(
				'label' => esc_html__( 'Front', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'box_shadow',
				'selector' => '{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-flipbox-front',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_shadow_back',
			array(
				'label' => esc_html__( 'Back', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'box_hover_shadow',
				'selector' => '{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-flipbox-back',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_carousel_options_styling',
			array(
				'label'     => esc_html__( 'Carousel Options', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'info_box_layout' => 'carousel_layout',
				),
			)
		);
		$this->add_control(
			'plus_pro_carousel_options_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'info_box_layout' => 'carousel_layout',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_extra_option_styling',
			array(
				'label' => esc_html__( 'Extra Options', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'box_padding',
			array(
				'label'      => esc_html__( 'Box Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'default'    => array(
					'top'    => '15',
					'right'  => '15',
					'bottom' => '15',
					'left'   => '15',
				),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .info-box-bg-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'messy_column',
			array(
				'label'     => esc_html__( 'Messy Columns', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'tpebl' ),
				'label_off' => esc_html__( 'Off', 'tpebl' ),
				'default'   => 'no',
				'condition' => array(
					'info_box_layout' => 'carousel_layout',
				),
			)
		);
		$this->add_control(
			'messy_column_even',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Even Columns', 'tpebl' ),
				'size_units'  => array( 'px', '%' ),
				'range'       => array(
					'px' => array(
						'min'  => -250,
						'max'  => 250,
						'step' => 2,
					),
					'%'  => array(
						'min'  => 70,
						'max'  => 70,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 0,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .pt_plus_info_box .slick-initialized .slick-slide.info-box-inner:nth-child(2n+1)' => 'margin-top: {{SIZE}}{{UNIT}};',
				),
				'condition'   => array(
					'info_box_layout' => 'carousel_layout',
					'messy_column'    => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'messy_column_odd',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Odd Columns', 'tpebl' ),
				'size_units'  => array( 'px', '%' ),
				'range'       => array(
					'px' => array(
						'min'  => -250,
						'max'  => 250,
						'step' => 2,
					),
					'%'  => array(
						'min'  => 70,
						'max'  => 70,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 70,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .pt_plus_info_box .slick-initialized .slick-slide.info-box-inner:nth-child(2n+2)' => 'margin-top: {{SIZE}}{{UNIT}};',
				),
				'condition'   => array(
					'info_box_layout' => 'carousel_layout',
					'messy_column'    => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'box_hover_effects',
			array(
				'label'     => esc_html__( 'Box Hover Effects', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => l_theplus_get_content_hover_effect_options(),
				'separator' => 'before',
			)
		);
		$this->add_control(
			'responsive_visible_opt',
			array(
				'label'     => esc_html__( 'Responsive Visibility', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'separator' => 'before',
			)
		);
		$this->add_control(
			'desktop_opt',
			array(
				'label'     => esc_html__( 'Desktop', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'condition' => array(
					'responsive_visible_opt' => 'yes',
				),
			)
		);
		$this->add_control(
			'tablet_opt',
			array(
				'label'     => esc_html__( 'Tablet', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'condition' => array(
					'responsive_visible_opt' => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_opt',
			array(
				'label'     => esc_html__( 'Mobile', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'condition' => array(
					'responsive_visible_opt' => 'yes',
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
	}

	/**
	 * Render
	 *
	 * Written in PHP and HTML.
	 *
	 * @since 1.0.0
	 * @version 5.5.4
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		$info_box_layout = ! empty( $settings['info_box_layout'] ) ? $settings['info_box_layout'] : 'single_layout';
		$main_style      = 'style_5';
		$hover_class     = '';
		$hover_uniqid    = uniqid( 'hover-effect' );

		$box_hover_effects = ! empty( $settings['box_hover_effects'] ) ? $settings['box_hover_effects'] : '';

		if ( 'push' === $box_hover_effects ) {
			$hover_class .= 'content_hover_push';
		}

		$animation_effects = ! empty( $settings['animation_effects'] ) ? $settings['animation_effects'] : '';
		$animation_delay   = ! empty( $settings['animation_delay']['size'] ) ? $settings['animation_delay']['size'] : 50;

		$ani_duration = ! empty( $settings['animation_duration_default'] ) ? $settings['animation_duration_default'] : '';
		$ani_speed    = ! empty( $settings['animate_duration']['size'] ) ? $settings['animate_duration']['size'] : 50;
		$out_effects  = ! empty( $settings['animation_out_effects'] ) ? $settings['animation_out_effects'] : '';
		$out_delay    = ! empty( $settings['animation_out_delay']['size'] ) ? $settings['animation_out_delay']['size'] : 50;
		$out_duration = ! empty( $settings['animation_out_duration_default'] ) ? $settings['animation_out_duration_default'] : '';

		$out_speed  = ! empty( $settings['animation_out_duration']['size'] ) ? $settings['animation_out_duration']['size'] : 50;
		$border_box = ! empty( $settings['box_border'] ) ? $settings['box_border'] : '';
		$image_icon = ! empty( $settings['image_icon'] ) ? $settings['image_icon'] : '';
		$icon_style = ! empty( $settings['icon_style'] ) ? $settings['icon_style'] : 'square';
		$icon_font  = ! empty( $settings['icon_font_style'] ) ? $settings['icon_font_style'] : 'font_awesome';
		$image_id   = ! empty( $settings['select_image']['id'] ) ? $settings['select_image']['id'] : '';
		$icon_5     = ! empty( $settings['icon_fontawesome_5'] ) ? $settings['icon_fontawesome_5'] : '';
		$d_button   = ! empty( $settings['display_button'] ) ? $settings['display_button'] : '';
		$btn_url    = ! empty( $settings['button_link']['url'] ) ? $settings['button_link']['url'] : '';
		$flip_type  = ! empty( $settings['flip_style'] ) ? $settings['flip_style'] : 'horizontal';

		$content_desc  = ! empty( $settings['content_desc'] ) ? $settings['content_desc'] : '';
		$title         = ! empty( $settings['title'] ) ? $settings['title'] : '';
		$respo_visible = ! empty( $settings['responsive_visible_opt'] ) ? $settings['responsive_visible_opt'] : '';

		$img_url = ! empty( $settings['select_image']['url'] ) ? $settings['select_image']['url'] : '';

		if ( 'no-animation' === $animation_effects ) {
			$animated_class = '';
			$animation_attr = '';
		} else {
			$animate_offset  = '85%';
			$animated_class  = 'animate-general';
			$animation_attr  = ' data-animate-type="' . esc_attr( $animation_effects ) . '" data-animate-delay="' . esc_attr( $animation_delay ) . '"';
			$animation_attr .= ' data-animate-offset="' . esc_attr( $animate_offset ) . '"';
			if ( 'yes' === $ani_duration ) {
				$animation_attr .= ' data-animate-duration="' . esc_attr( $ani_speed ) . '"';
			}
			if ( 'no-animation' !== $out_effects ) {
				$animation_attr .= ' data-animate-out-type="' . esc_attr( $out_effects ) . '" data-animate-out-delay="' . esc_attr( $out_delay ) . '"';
				if ( 'yes' === $out_duration ) {
					$animation_attr .= ' data-animate-out-duration="' . esc_attr( $out_speed ) . '"';
				}
			}
		}

		$description        = '';
		$service_img        = '';
		$service_title      = '';
		$service_icon_style = '';
		$serice_box_border  = '';

		$service_space = '';
		$imge_content  = '';
		$title_css     = '';
		$subtitle_css  = '';
		$output        = '';
		$service_btn   = '';
		$the_button    = '';

		if ( 'yes' === $border_box ) {
			$serice_box_border = 'service-border-box';
		}
		if ( 'image' === $image_icon ) {
			if ( ! empty( $img_url ) ) {
				$img_src = tp_get_image_rander( $image_id, $settings['select_image_thumbnail_size'], array( 'class' => 'service-img' ) );
			} else {
				$img_src = '';
			}
			$service_img = $img_src;
		}

		if ( 'square' === $icon_style ) {
			$service_icon_style = 'icon-squre';
		}
		if ( 'rounded' === $icon_style ) {
			$service_icon_style = 'icon-rounded';
		}
		if ( 'hexagon' === $icon_style ) {
			$service_icon_style = 'icon-hexagon';
		}
		if ( 'pentagon' === $icon_style ) {
			$service_icon_style = 'icon-pentagon';
		}
		if ( 'square-rotate' === $icon_style ) {
			$service_icon_style = 'icon-square-rotate';
		}
		if ( 'icon' === $image_icon ) {
			if ( 'font_awesome' === $icon_font ) {
				$fontawsm_four = ! empty( $settings['icon_fontawesome'] ) ? $settings['icon_fontawesome'] : 'fa fa-bank';
				$icons         = $fontawsm_four;
			} elseif ( 'font_awesome_5' === $icon_font ) {
				ob_start();
				\Elementor\Icons_Manager::render_icon( $icon_5, array( 'aria-hidden' => 'true' ) );
				$icons = ob_get_contents();
				ob_end_clean();
			} else {
				$icons = '';
			}

			$service_icon_style .= tp_bg_lazyLoad( $settings['icon_background_image'], $settings['icon_hover_background_image'] );

			if ( 'font_awesome_5' === $icon_font ) {
				$service_img = '<span class=" service-icon ' . esc_attr( $service_icon_style ) . '">' . $icons . '</span>';
			} else {
				$service_img = '<i class=" ' . esc_attr( $icons ) . ' service-icon ' . esc_attr( $service_icon_style ) . '"></i>';
			}
		}

		if ( ! empty( $title ) ) {
			$service_title = '<div class="service-title"> ' . esc_html( $title ) . ' </div>';
		}

		if ( ! empty( $content_desc ) ) {
			$description = '<div class="service-desc"> ' . wp_kses_post( $content_desc ) . ' </div>';
		}

		$the_button = '';

		if ( 'yes' === $d_button ) {

			if ( ! empty( $btn_url ) ) {
				$this->add_render_attribute( 'button', 'href', esc_url( $btn_url ) );
				$btn_en = ! empty( $settings['button_link'] ) ? $settings['button_link'] : '';

				if ( $btn_en['is_external'] ) {
					$this->add_render_attribute( 'button', 'target', '_blank' );
				}

				if ( $btn_en['nofollow'] ) {
					$this->add_render_attribute( 'button', 'rel', 'nofollow' );
				}
			}

			$buttonlazybg = tp_bg_lazyLoad( $settings['button_background_image'], $settings['button_hover_background_image'] );

			$this->add_render_attribute( 'button', 'class', 'button-link-wrap' . $buttonlazybg );
			$this->add_render_attribute( 'button', 'role', 'button' );

			$button_style = ! empty( $settings['button_style'] ) ? $settings['button_style'] : 'style-8';
			$button_text  = ! empty( $settings['button_text'] ) ? $settings['button_text'] : '';
			$btn_uid      = uniqid( 'btn' );
			$data_class   = ' button-' . $button_style . ' ';
			$data_class  .= $btn_uid;

			$the_button = '<div class="pt-plus-button-wrapper text-center">';

			$the_button .= '<div class="button_parallax">';

				$the_button .= '<div class="text-center ts-button">';

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

		if ( 'horizontal' === $flip_type ) {
			$service_flip = 'flip-horizontal';
		}
		if ( 'vertical' === $flip_type ) {
			$service_flip = 'flip-vertical';
		}

		if ( 'single_layout' === $info_box_layout ) {
			$output = '<div class="info-box-inner content_hover_effect ' . esc_attr( $hover_class ) . '">';
			if ( 'style_5' === $main_style ) {
				$output             .= '<div class="info-box-bg-box">';
					$output         .= '<div class="service-flipbox ' . esc_attr( $service_flip ) . ' height-full">';
						$output     .= '<div class="service-flipbox-holder height-full text-center perspective bezier-1"	>';
							$sflipbg = tp_bg_lazyLoad( $settings['box_front_background_image'] );

							$output             .= '<div class="service-flipbox-front ' . esc_attr( $sflipbg ) . ' bezier-1 no-backface origin-center">';
								$output         .= '<div class="service-flipbox-content width-full">';
									$output     .= $service_img;
									$output     .= '<div class="service-content">';
										$output .= $service_title;
									$output     .= '</div>';
								$output         .= '</div>';
								$output         .= '<div class="infobox-front-overlay"></div>';
							$output             .= '</div>';
							$sfbacklazy          = tp_bg_lazyLoad( $settings['box_back_background_image'] );
							$output             .= '<div class="service-flipbox-back ' . esc_attr( $sfbacklazy ) . ' fold-back-horizontal no-backface bezier-1 origin-center">';
								$output         .= '<div class="service-flipbox-content width-full">';
									$output     .= $description;
									$output     .= $the_button;
								$output         .= '</div>';
								$output         .= '<div class="infobox-back-overlay"></div>';
							$output             .= '</div>';
						$output                 .= '</div>';
					$output                     .= '</div>';
				$output                         .= '</div>';
			}
			$output .= '</div>';
		}

		$visiblity_hide = '';
		if ( 'yes' === $respo_visible ) {
			$visiblity_hide .= ( 'yes' !== $settings['desktop_opt'] && '' === $settings['desktop_opt'] ) ? 'hide-desktop ' : '';
			$visiblity_hide .= ( 'yes' !== $settings['tablet_opt'] && '' === $settings['tablet_opt'] ) ? 'hide-tablet ' : '';
			$visiblity_hide .= ( 'yes' !== $settings['mobile_opt'] && '' === $settings['mobile_opt'] ) ? 'hide-mobile ' : '';
		}

		$uid = uniqid( 'flip_box' );

		$info_box          = '<div class="pt_plus_info_box ' . esc_attr( $uid ) . ' info-box-' . esc_attr( $main_style ) . ' ' . esc_attr( $animated_class ) . '  ' . esc_attr( $service_space ) . ' ' . esc_attr( $visiblity_hide ) . ' "  data-id="' . esc_attr( $uid ) . '" ' . $animation_attr . '>';
			$info_box     .= '<div class="post-inner-loop">';
				$info_box .= $output;
			$info_box     .= '</div>';
		$info_box         .= '</div>';
		echo $info_box;
	}

	/**
	 * Render Text
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	protected function render_text() {
		$icons_after  = '';
		$icons_before = '';
		$settings     = $this->get_settings_for_display();

		$button_style = ! empty( $settings['button_style'] ) ? $settings['button_style'] : 'style-8';
		$before_after = ! empty( $settings['before_after'] ) ? $settings['before_after'] : 'after';
		$button_text  = ! empty( $settings['button_text'] ) ? $settings['button_text'] : '';
		$icon_style   = ! empty( $settings['button_icon_font_style'] ) ? $settings['button_icon_font_style'] : 'font_awesome';

		if ( 'font_awesome' === $icon_style ) {
			$icons = ! empty( $settings['button_icon'] ) ? $settings['button_icon'] : '';
		} elseif ( 'font_awesome_5' === $icon_style ) {
			ob_start();
			\Elementor\Icons_Manager::render_icon( $settings['button_icon_5'], array( 'aria-hidden' => 'true' ) );
			$icons = ob_get_contents();
			ob_end_clean();
		} else {
			$icons = '';
		}
		if ( 'before' === $before_after && ! empty( $icons ) ) {
			if ( 'font_awesome_5' === $icon_style ) {
				$icons_before = '<span class="btn-icon button-before">' . $icons . '</span>';
			} else {
				$icons_before = '<i class="btn-icon button-before ' . esc_attr( $icons ) . '"></i>';
			}
		}
		if ( 'after' === $before_after && ! empty( $icons ) ) {
			if ( 'font_awesome_5' === $icon_style ) {
				$icons_after = '<span class="btn-icon button-after">' . $icons . '</span>';
			} else {
				$icons_after = '<i class="btn-icon button-after ' . esc_attr( $icons ) . '"></i>';
			}
		}

		if ( 'style-8' === $button_style ) {
			$button_text = $icons_before . esc_attr( $button_text ) . $icons_after;
		}

		return $button_text;
	}
}
