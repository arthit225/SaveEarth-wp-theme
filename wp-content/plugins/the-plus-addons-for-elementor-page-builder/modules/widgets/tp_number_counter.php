<?php
/**
 * Widget Name: Number Counter
 * Description: Display style of count numbers
 * Author: Theplus
 * Author URI: https://posimyth.com
 *
 * @package ThePlus
 */

namespace TheplusAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class L_ThePlus_Number_Counter
 */
class L_ThePlus_Number_Counter extends Widget_Base {

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
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_name() {
		return 'tp-number-counter';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Number Counter', 'tpebl' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-hashtag theplus_backend_icon';
	}

	/**
	 * Get Widget categories.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_categories() {
		return array( 'plus-essential' );
	}

	/**
	 * Get Widget keywords.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_keywords() {
		return array( '' );
	}

	public function get_custom_help_url() {
		$help_url = $this->tp_help;

		return esc_url( $help_url );
	}

	/**
	 * Register controls.
	 *
	 * @since 1.0.1
	 * @version 5.5.4
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Style Counter', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'style',
			array(
				'label'   => esc_html__( 'Style', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => l_theplus_get_style_list( 2 ),
			)
		);
		$this->add_control(
			'title',
			array(
				'label'   => esc_html__( 'Title', 'tpebl' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Title', 'tpebl' ),
				'dynamic' => array( 'active' => true ),
			)
		);
		$this->add_responsive_control(
			'alignment',
			array(
				'label'        => esc_html__( 'Alignment', 'tpebl' ),
				'type'         => Controls_Manager::CHOOSE,
				'options'      => array(
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
				'devices'      => array( 'desktop', 'tablet', 'mobile' ),
				'default'      => 'center',
				'prefix_class' => 'text-%s',
				'label_block'  => false,
				'toggle'       => false,
				'condition'    => array(
					'style' => 'style-1',
				),
			)
		);
		$this->add_responsive_control(
			'alignment_2',
			array(
				'label'        => esc_html__( 'Alignment', 'tpebl' ),
				'type'         => Controls_Manager::CHOOSE,
				'options'      => array(
					'left'  => array(
						'title' => esc_html__( 'Left', 'tpebl' ),
						'icon'  => 'eicon-text-align-left',
					),
					'right' => array(
						'title' => esc_html__( 'Right', 'tpebl' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'      => 'left',
				'prefix_class' => 'text-%s',
				'label_block'  => false,
				'toggle'       => false,
				'condition'    => array(
					'style' => 'style-2',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'number_content_section',
			array(
				'label' => esc_html__( 'Number Counting', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'max_number',
			array(
				'label'   => wp_kses_post( "Number Value <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "animated-number-counter-for-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'    => Controls_Manager::NUMBER,
				'default' => esc_html__( '1000', 'tpebl' ),
				'dynamic' => array( 'active' => true ),
			)
		);
		$this->add_control(
			'max_num_Note',
			array(
				'type'        => Controls_Manager::RAW_HTML,
				'raw'         => '<p class="tp-controller-notice"><i>Enter the value of number/digits you want to showcase in icon counter. E.g, 100,999,etc..</i></p>',
				'label_block' => true,
			)
		);
		$this->add_control(
			'min_number',
			array(
				'label'   => esc_html__( 'Animation Starting Number Value', 'tpebl' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => esc_html__( '0', 'tpebl' ),
				'dynamic' => array( 'active' => true ),
			)
		);
		$this->add_control(
			'min_num_Note',
			array(
				'type'        => Controls_Manager::RAW_HTML,
				'raw'         => '<p class="tp-controller-notice"><i>Enter the digit from which you want to start the animation on scroll. E.g. 0,10,80, etc</i></p>',
				'label_block' => true,
			)
		);
		$this->add_control(
			'increment_number',
			array(
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Number gap for animation', 'tpebl' ),
				'default' => array(
					'unit' => '',
					'size' => 5,
				),
				'range'   => array(
					'' => array(
						'min'  => 0,
						'max'  => 5000,
						'step' => 5,
					),
				),
				'dynamic' => array( 'active' => true ),
			)
		);
		$this->add_control(
			'increment_Note',
			array(
				'type'        => Controls_Manager::RAW_HTML,
				'raw'         => '<p class="tp-controller-notice"><i>Enter the value of number you want while animation.</i></p>',
				'label_block' => true,
			)
		);
		$this->add_control(
			'delay_number',
			array(
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Time delay in animation gap', 'tpebl' ),
				'default' => array(
					'unit' => '',
					'size' => 5,
				),
				'range'   => array(
					'' => array(
						'min'  => 0,
						'max'  => 10000,
						'step' => 10,
					),
				),
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'symbol',
			array(
				'label'     => esc_html__( 'Symbol', 'tpebl' ),
				'type'      => Controls_Manager::TEXT,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'symbol_Note',
			array(
				'type'        => Controls_Manager::RAW_HTML,
				'raw'         => '<p class="tp-controller-notice"><i>You can add any value in this option which will be setup as prefix or postfix on Digits. e.g. +,%,etc.</i></p>',
				'label_block' => true,
			)
		);
		$this->add_control(
			'symbol_position',
			array(
				'label'   => esc_html__( 'Symbol Position', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'after',
				'options' => array(
					'after'  => esc_html__( 'After Number', 'tpebl' ),
					'before' => esc_html__( 'Before Number', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'symbol_pos_Note',
			array(
				'type'        => Controls_Manager::RAW_HTML,
				'raw'         => '<p class="tp-controller-notice"><i>You can Select Symbol position using this option.</i></p>',
				'label_block' => true,
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'icon_content_section',
			array(
				'label' => esc_html__( 'Icon', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'icon_type',
			array(
				'label'   => esc_html__( 'Select Icon', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'icon',
				'options' => array(
					''      => esc_html__( 'None', 'tpebl' ),
					'icon'  => esc_html__( 'Icon', 'tpebl' ),
					'image' => esc_html__( 'Image', 'tpebl' ),
					'svg'   => esc_html__( 'Svg (Pro)', 'tpebl' ),
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
			'icon_font_style',
			array(
				'label'     => esc_html__( 'Icon Font', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'font_awesome',
				'options'   => array(
					'font_awesome' => esc_html__( 'Font Awesome', 'tpebl' ),
					'icon_mind'    => esc_html__( 'Icons Mind (Pro)', 'tpebl' ),
				),
				'condition' => array(
					'icon_type' => 'icon',
				),
			)
		);
		$this->add_control(
			'icon_fontawesome',
			array(
				'label'     => esc_html__( 'Icon Library', 'tpebl' ),
				'type'      => Controls_Manager::ICON,
				'default'   => 'fa fa-download',
				'condition' => array(
					'icon_type'       => 'icon',
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
					'icon_type'       => 'icon',
					'icon_font_style' => 'icon_mind',
				),
			)
		);
		$this->add_control(
			'svg_pro_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'icon_type' => 'svg',
				),
			)
		);
		$this->add_control(
			'icon_image',
			array(
				'label'     => esc_html__( 'Choose Image', 'tpebl' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'icon_type' => 'image',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'icon_image_thumbnail',
				'default'   => 'full',
				'separator' => 'none',
				'condition' => array(
					'icon_type' => 'image',
				),
			)
		);
		$this->add_control(
			'url_link',
			array(
				'label'         => esc_html__( 'Link', 'tpebl' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_html__( 'https://your-link.com', 'tpebl' ),
				'show_external' => true,
				'dynamic'       => array( 'active' => true ),
				'default'       => array(
					'url' => '',
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
					'icon_type' => 'svg',
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
					'icon_type' => 'icon',
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
					'{{WRAPPER}} .plus-number-counter .counter-icon-inner .counter-icon' => 'font-size: {{SIZE}}{{UNIT}} !important;',
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
					'{{WRAPPER}} .plus-number-counter .counter-icon-inner' => 'width: {{SIZE}}{{UNIT}} !important;height: {{SIZE}}{{UNIT}} !important;line-height: {{SIZE}}{{UNIT}} !important;',
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
						'icon'  => 'eicon-barcode',
					),
				),
				'label_block' => false,
				'default'     => 'solid',

			)
		);
		$this->add_control(
			'icon_color',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-number-counter .counter-icon-inner .counter-icon' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .plus-number-counter .counter-icon-inner .counter-icon' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{icon_gradient_color1.VALUE}} {{icon_gradient_color1_control.SIZE}}{{icon_gradient_color1_control.UNIT}}, {{icon_gradient_color2.VALUE}} {{icon_gradient_color2_control.SIZE}}{{icon_gradient_color2_control.UNIT}})',
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
					'{{WRAPPER}} .plus-number-counter .counter-icon-inner .counter-icon' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{icon_gradient_color1.VALUE}} {{icon_gradient_color1_control.SIZE}}{{icon_gradient_color1_control.UNIT}}, {{icon_gradient_color2.VALUE}} {{icon_gradient_color2_control.SIZE}}{{icon_gradient_color2_control.UNIT}})',
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
				'selector'  => '{{WRAPPER}} .plus-number-counter .counter-icon-inner',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'icon_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-number-counter .counter-icon-inner' => 'border-color: {{VALUE}}',
				),
				'separator' => 'before',
				'condition' => array(
					'icon_style!' => array( '', 'hexagon', 'pentagon', 'square-rotate' ),
				),
			)
		);
		$this->add_responsive_control(
			'icon_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-number-counter .counter-icon-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
				'condition'  => array(
					'icon_style!' => array( 'hexagon', 'pentagon', 'square-rotate' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'icon_box_shadow',
				'selector'  => '{{WRAPPER}} .plus-number-counter .counter-icon-inner',
				'condition' => array(
					'icon_style!' => array( 'hexagon', 'pentagon', 'square-rotate' ),
				),
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
						'icon'  => 'eicon-barcode',
					),
				),
				'label_block' => false,
				'default'     => 'solid',
			)
		);

		$this->add_control(
			'icon_hover_color',
			array(
				'label'     => esc_html__( 'Hover Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover .counter-icon-inner .counter-icon' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover .counter-icon-inner .counter-icon' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{icon_hover_gradient_color1.VALUE}} {{icon_hover_gradient_color1_control.SIZE}}{{icon_hover_gradient_color1_control.UNIT}}, {{icon_hover_gradient_color2.VALUE}} {{icon_hover_gradient_color2_control.SIZE}}{{icon_hover_gradient_color2_control.UNIT}})',
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
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover .counter-icon-inner .counter-icon' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{icon_hover_gradient_color1.VALUE}} {{icon_hover_gradient_color1_control.SIZE}}{{icon_hover_gradient_color1_control.UNIT}}, {{icon_hover_gradient_color2.VALUE}} {{icon_hover_gradient_color2_control.SIZE}}{{icon_hover_gradient_color2_control.UNIT}})',
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
				'selector'  => '{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover .counter-icon-inner',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'icon_border_hover_color',
			array(
				'label'     => esc_html__( 'Hover Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover .counter-icon-inner' => 'border-color: {{VALUE}}',
				),
				'separator' => 'before',
				'condition' => array(
					'icon_style!' => array( '', 'hexagon', 'pentagon', 'square-rotate' ),
				),
			)
		);
		$this->add_responsive_control(
			'icon__hover_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover .counter-icon-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
				'condition'  => array(
					'icon_style!' => array( 'hexagon', 'pentagon', 'square-rotate' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'icon_hover_box_shadow',
				'selector'  => '{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover .counter-icon-inner',
				'condition' => array(
					'icon_style!' => array( 'hexagon', 'pentagon', 'square-rotate' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		$this->start_controls_section(
			'section_icon_image_styling',
			array(
				'label'     => esc_html__( 'Image Style', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'icon_type' => 'image',
				),
			)
		);
		$this->add_responsive_control(
			'image_width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Image Width', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 2,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 100,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .plus-number-counter .counter-image-inner' => 'max-width: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_title_styling',
			array(
				'label' => esc_html__( 'Title Style', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typography', 'tpebl' ),
				'selector' => '{{WRAPPER}} .plus-number-counter .number-counter-inner-block .counter-title,{{WRAPPER}} .plus-number-counter .number-counter-inner-block .counter-title a',
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
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block .counter-title,{{WRAPPER}} .plus-number-counter .number-counter-inner-block .counter-title a' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block .counter-title,{{WRAPPER}} .plus-number-counter .number-counter-inner-block .counter-title a' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{title_gradient_color1.VALUE}} {{title_gradient_color1_control.SIZE}}{{title_gradient_color1_control.UNIT}}, {{title_gradient_color2.VALUE}} {{title_gradient_color2_control.SIZE}}{{title_gradient_color2_control.UNIT}})',
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
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block .counter-title,{{WRAPPER}} .plus-number-counter .number-counter-inner-block .counter-title a' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{title_gradient_color1.VALUE}} {{title_gradient_color1_control.SIZE}}{{title_gradient_color1_control.UNIT}}, {{title_gradient_color2.VALUE}} {{title_gradient_color2_control.SIZE}}{{title_gradient_color2_control.UNIT}})',
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
						'icon'  => 'eicon-barcode',
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
				'default'   => '#3351a6',
				'selectors' => array(
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover .counter-title,{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover .counter-title a' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover .counter-title,{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover .counter-title a' => 'background-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{title_hover_gradient_color1.VALUE}} {{title_hover_gradient_color1_control.SIZE}}{{title_hover_gradient_color1_control.UNIT}}, {{title_hover_gradient_color2.VALUE}} {{title_hover_gradient_color2_control.SIZE}}{{title_hover_gradient_color2_control.UNIT}})',
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
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover .counter-title,{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover .counter-title a' => 'background-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{title_hover_gradient_color1.VALUE}} {{title_hover_gradient_color1_control.SIZE}}{{title_hover_gradient_color1_control.UNIT}}, {{title_hover_gradient_color2.VALUE}} {{title_hover_gradient_color2_control.SIZE}}{{title_hover_gradient_color2_control.UNIT}})',
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
				'render_type'     => 'ui',
				'selectors'       => array(
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block .counter-title' => 'margin-top : {{SIZE}}{{UNIT}}',
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
				'render_type'     => 'ui',
				'selectors'       => array(
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block .counter-title' => 'margin-bottom : {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_digit_option',
			array(
				'label' => esc_html__( 'Digit Style', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'digit_typography',
				'label'    => esc_html__( 'Typography', 'tpebl' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .plus-number-counter .number-counter-inner-block .counter-number',
			)
		);
		$this->start_controls_tabs( 'digit_gradient' );
		$this->start_controls_tab(
			'digit_gradient_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'digit_gradient_color',
			array(
				'label'       => esc_html__( 'Digit Color', 'tpebl' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => array(
					'color'    => array(
						'title' => esc_html__( 'Classic', 'tpebl' ),
						'icon'  => 'eicon-paint-brush',
					),
					'gradient' => array(
						'title' => esc_html__( 'Gradient', 'tpebl' ),
						'icon'  => 'eicon-barcode',
					),
				),
				'label_block' => false,
				'default'     => 'color',
			)
		);
		$this->add_control(
			'digit_gradient_color1',
			array(
				'label'     => esc_html__( 'Color 1', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'orange',
				'selectors' => array(
					'{{WRAPPER}} .counter-number .number-counter-inner-block .counter-number .counter-number-inner' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'digit_gradient_color' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'digit_gradient_color1_control',
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
					'digit_gradient_color' => 'gradient',
				),
				'of_type'     => 'gradient',
			)
		);
		$this->add_control(
			'digit_gradient_color2',
			array(
				'label'     => esc_html__( 'Color 2', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'cyan',
				'selectors' => array(
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block .counter-number .counter-number-inner' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'digit_gradient_color' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'digit_gradient_color2_control',
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
					'digit_gradient_color' => 'gradient',
				),
				'of_type'     => 'gradient',
			)
		);
		$this->add_control(
			'digit_gradient_style',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Gradient Style', 'tpebl' ),
				'default'   => 'linear',
				'options'   => l_theplus_get_gradient_styles(),
				'condition' => array(
					'digit_gradient_color' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'digit_gradient_angle',
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
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block .counter-number .counter-number-inner' => '-webkit-background-clip:text !important;-webkit-text-fill-color: transparent; background: linear-gradient({{SIZE}}{{UNIT}}, {{digit_gradient_color1.VALUE}} {{digit_gradient_color1_control.SIZE}}{{digit_gradient_color1_control.UNIT}}, {{digit_gradient_color2.VALUE}} {{digit_gradient_color2_control.SIZE}}{{digit_gradient_color2_control.UNIT}})',
				),
				'condition'  => array(
					'digit_gradient_color' => 'gradient',
					'digit_gradient_style' => array( 'linear' ),
				),
				'of_type'    => 'gradient',
				'separator'  => 'after',
			)
		);
		$this->add_control(
			'style_color',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block .counter-number .counter-number-inner' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'digit_gradient_color' => 'color',
				),
			)
		);
		$this->add_control(
			'symbol_color',
			array(
				'label'     => esc_html__( 'Symbol Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block .counter-number .number-counter-symbol' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'digit_gradient_color' => 'color',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'gradient_title_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'gradient_hover_color_option',
			array(
				'label'       => esc_html__( 'Gradient Hover Color', 'tpebl' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => array(
					'color'    => array(
						'title' => esc_html__( 'Classic', 'tpebl' ),
						'icon'  => 'eicon-paint-brush',
					),
					'gradient' => array(
						'title' => esc_html__( 'Gradient', 'tpebl' ),
						'icon'  => 'eicon-barcode',
					),
				),
				'label_block' => false,
				'default'     => 'color',
			)
		);
		$this->add_control(
			'hover_gradient_color1',
			array(
				'label'     => esc_html__( 'Color 1', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'orange',
				'condition' => array(
					'gradient_hover_color_option' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'hover_gradient_color1_control',
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
					'gradient_hover_color_option' => 'gradient',
				),
				'of_type'     => 'gradient',
			)
		);
		$this->add_control(
			'hover_gradient_color2',
			array(
				'label'     => esc_html__( 'Color 2', 'thepltpeblus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'cyan',
				'condition' => array(
					'gradient_hover_color_option' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'hover_gradient_color2_control',
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
					'gradient_hover_color_option' => 'gradient',
				),
				'of_type'     => 'gradient',
			)
		);
		$this->add_control(
			'hover_gradient_style',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Gradient Style', 'tpebl' ),
				'default'   => 'linear',
				'options'   => l_theplus_get_gradient_styles(),
				'condition' => array(
					'gradient_hover_color_option' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'hover_gradient_angle',
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
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover .counter-number' => '-webkit-background-clip:text !important;-webkit-text-fill-color: transparent; background: linear-gradient({{SIZE}}{{UNIT}}, {{hover_gradient_color1.VALUE}} {{hover_gradient_color1_control.SIZE}}{{hover_gradient_color1_control.UNIT}}, {{hover_gradient_color2.VALUE}} {{hover_gradient_color2_control.SIZE}}{{hover_gradient_color2_control.UNIT}})',
				),
				'condition'  => array(
					'gradient_hover_color_option' => 'gradient',
					'hover_gradient_style'        => array( 'linear' ),
				),
				'of_type'    => 'gradient',
			)
		);
		$this->add_control(
			'hover_gradient_position',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Position', 'tpebl' ),
				'options'   => l_theplus_get_position_options(),
				'default'   => 'center center',
				'selectors' => array(
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover .counter-number,{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover .counter-number' => 'background-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{hover_gradient_color1.VALUE}} {{hover_gradient_color1_control.SIZE}}{{hover_gradient_color1_control.UNIT}}, {{hover_gradient_color2.VALUE}} {{hover_gradient_color2_control.SIZE}}{{hover_gradient_color2_control.UNIT}})',
				),
				'condition' => array(
					'gradient_hover_color_option' => 'gradient',
					'hover_gradient_style'        => 'radial',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'style_hover_color',
			array(
				'label'     => esc_html__( 'Hover Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover .counter-number' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'gradient_hover_color_option' => 'color',
				),
			)
		);
		$this->add_control(
            'symbol_hover_color',
            array(
                'label'     => esc_html__( 'Symbol Hover Color', 'tpebl' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover .counter-number .number-counter-symbol' => 'color: {{VALUE}}',
                ),
                'condition' => array(
                    'gradient_hover_color_option' => 'color',
                ),
            )
        );
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'number_top_space',
			array(
				'type'            => Controls_Manager::SLIDER,
				'label'           => esc_html__( 'Number Top Space', 'tpebl' ),
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
				'render_type'     => 'ui',
				'selectors'       => array(
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block .counter-number' => 'margin-top : {{SIZE}}{{UNIT}}',
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
			'border_style',
			array(
				'label'     => esc_html__( 'Border Style', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => l_theplus_get_border_style(),
				'default'   => 'solid',
				'selectors' => array(
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block' => 'border-style: {{VALUE}};',
				),
				'condition' => array(
					'box_border' => 'yes',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_border_style' );
		$this->start_controls_tab(
			'tab_border_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'box_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block' => 'border-color: {{VALUE}};',
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
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_border_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'box_border_hover_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover' => 'border-color: {{VALUE}};',
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
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .plus-number-counter .number-counter-inner-block',

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
				'selector' => '{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover',
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
				'selector' => '{{WRAPPER}} .plus-number-counter .number-counter-inner-block',
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
				'selector' => '{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		$this->start_controls_section(
			'section_extra_option_styling',
			array(
				'label' => esc_html__( 'Extra Options', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
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
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'vertical_center',
			array(
				'label'     => esc_html__( 'Vertical Center', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'tpebl' ),
				'label_off' => esc_html__( 'Off', 'tpebl' ),
				'default'   => 'no',
				'condition' => array(
					'style' => array( 'style-2' ),
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
	 * Number Counter Render.
	 *
	 * @since 1.0.1
	 * @version 5.5.4
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
		$style    = ! empty( $settings['style'] ) ? $settings['style'] : '';

		$alignment = 'text-' . ( ! empty( $settings['alignment'] ) ? $settings['alignment'] : '' );

		$animation_effects = ! empty( $settings['animation_effects'] ) ? $settings['animation_effects'] : '';
		$animation_delay   = ! empty( $settings['animation_delay']['size'] ) ? $settings['animation_delay']['size'] : 50;

		$ani_duration     = ! empty( $settings['animation_duration_default'] ) ? $settings['animation_duration_default'] : '';
		$animate_duration = ! empty( $settings['animate_duration']['size'] ) ? $settings['animate_duration']['size'] : 50;

		$out_effect   = ! empty( $settings['animation_out_effects'] ) ? $settings['animation_out_effects'] : '';
		$out_delay    = ! empty( $settings['animation_out_delay']['size'] ) ? $settings['animation_out_delay']['size'] : 50;
		$out_duration = ! empty( $settings['animation_out_duration_default'] ) ? $settings['animation_out_duration_default'] : '';
		$out_speed    = ! empty( $settings['animation_out_duration']['size'] ) ? $settings['animation_out_duration']['size'] : 50;

		$symbol       = ! empty( $settings['symbol'] ) ? $settings['symbol'] : '';
		$max_number   = ! empty( $settings['max_number'] ) ? $settings['max_number'] : '';
		$delay_number = ! empty( $settings['delay_number']['size'] ) ? $settings['delay_number']['size'] : '';

		$increment_number = ! empty( $settings['increment_number']['size'] ) ? $settings['increment_number']['size'] : '';
		$symbol_position  = ! empty( $settings['symbol_position'] ) ? $settings['symbol_position'] : '';

		$icon_type  = ! empty( $settings['icon_type'] ) ? $settings['icon_type'] : '';
		$icon_url   = ! empty( $settings['icon_image'] ) ? $settings['icon_image'] : '';
		$icon_font  = ! empty( $settings['icon_font_style'] ) ? $settings['icon_font_style'] : '';
		$icon_style = ! empty( $settings['icon_style'] ) ? $settings['icon_style'] : '';
		$num_title  = ! empty( $settings['title'] ) ? $settings['title'] : '';

		$icon_fontawesome = ! empty( $settings['icon_fontawesome'] ) ? $settings['icon_fontawesome'] : 'fa fa-download';
		$align_center     = ! empty( $settings['vertical_center'] ) ? $settings['vertical_center'] : '';

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

		$hover_class  = '';
		$hover_uniqid = uniqid( 'hover-effect' );

		$box_hover_effects = ! empty( $settings['box_hover_effects'] ) ? $settings['box_hover_effects'] : '';
		if ( 'push' === $box_hover_effects ) {
			$hover_class .= 'content_hover_push';
		}

		$icon_link_a = '';

		$icon_link_a_close = '';

		$url_link = ! empty( $settings['url_link'] ) ? $settings['url_link'] : '';

		if ( ! empty( $url_link['url'] ) ) {
			$this->add_render_attribute( 'url_link', 'href', esc_url( $url_link['url'] ) );

			if ( $url_link['is_external'] ) {
				$this->add_render_attribute( 'url_link', 'target', '_blank' );
			}

			if ( $url_link['nofollow'] ) {
				$this->add_render_attribute( 'url_link', 'rel', 'nofollow' );
			}

			$icon_link_a = '<a ' . $this->get_render_attribute_string( 'url_link' ) . '>';

			$icon_link_a_close = '</a>';
		}

		$min_number = $settings['min_number'];

		if ( ! empty( $symbol ) ) {
			if ( 'after' === $symbol_position ) {
				$number_symbol = '<span class="counter-number-inner numscroller" data-min="' . esc_attr( $min_number ) . '" data-max="' . esc_attr( $max_number ) . '" data-delay="' . esc_attr( $delay_number ) . '" data-increment="' . esc_attr( $increment_number ) . '">' . esc_html( $min_number ) . '</span><span class="number-counter-symbol">' . esc_html( $symbol ) . '</span>';
			} elseif ( 'before' === $symbol_position ) {
				$number_symbol = '<span class="number-counter-symbol">' . esc_html( $symbol ) . '</span><span class="counter-number-inner numscroller"  data-min="' . esc_attr( $min_number ) . '" data-max="' . esc_attr( $max_number ) . '" data-delay="' . esc_attr( $delay_number ) . '" data-increment="' . esc_attr( $increment_number ) . '">' . esc_html( $min_number ) . '</span>';
			}
		} else {
			$number_symbol = '<span class="counter-number-inner numscroller" data-min="' . esc_attr( $min_number ) . '" data-max="' . esc_attr( $max_number ) . '" data-delay="' . esc_attr( $delay_number ) . '" data-increment="' . esc_attr( $increment_number ) . '">' . esc_html( $min_number ) . '</span>';
		}

		$icon_img_ic = '';
		if ( 'image' === $icon_type && ! empty( $icon_url['url'] ) ) {
			$icon_img_ic .= '<div class="counter-image-inner">';

			$icon_image = $icon_url['id'];

			$img_src = tp_get_image_rander( $icon_image, 'full', array( 'class' => 'counter-icon-image' ) );

			$icon_img_ic .= $img_src;

			$icon_img_ic .= '</div>';
		} elseif ( 'icon' === $icon_type ) {
			if ( 'font_awesome' === $icon_font ) {
				$icons = $icon_fontawesome;
			} else {
				$icons = '';
			}

			$icon_bg = tp_bg_lazyLoad( $settings['icon_background_image'], $settings['icon_hover_background_image'] );

			$icon_img_ic .= '<div class="counter-icon-inner shape-icon-' . esc_attr( $icon_style ) . ' ' . $icon_bg . '">';

			$icon_img_ic .= '<span class="counter-icon ' . esc_attr( $icons ) . '"></span>';

			$icon_img_ic .= '</div>';
		}

		$number_markup = '';
		if ( ! empty( $max_number ) ) {
			$number_markup = '<h5 class="counter-number">' . $number_symbol . '</h5>';
		}

		$title = '';
		if ( '' !== $num_title ) {
			$title = '<h6 class="counter-title">' . $icon_link_a . esc_html( $num_title ) . $icon_link_a_close . '</h6>';
		}

		$vertical_center = '';
		if ( 'style-2' === $style && 'yes' === $align_center ) {
			$vertical_center = 'vertical-center';
		}

		$icon_bg1        = tp_bg_lazyLoad( $settings['box_background_image'], $settings['box_hover_background_image'] );
		$counter_content = '<div class="number-counter-inner-block ' . esc_attr( $vertical_center ) . ' ' . $icon_bg1 . '">';

		if ( 'style-1' === $style ) {
			$counter_content .= '<div class="counter-wrap-content" >';

			$counter_content .= $icon_link_a . $icon_img_ic . $icon_link_a_close;
			$counter_content .= $number_markup;
			$counter_content .= $title;

			$counter_content .= '</div>';
		} elseif ( 'style-2' === $style ) {
			$counter_content .= '<div class="icn-header">';

				$counter_content .= $icon_link_a . $icon_img_ic . $icon_link_a_close;

			$counter_content .= '</div>';

			$counter_content .= '<div class="counter-content">';

				$counter_content .= $number_markup;
				$counter_content .= $title;

			$counter_content .= '</div>';
		} else {
			$counter_content .= '<div class="counter-wrap-content" >' . wp_kses_post( $number_markup ) . ' ' . wp_kses_post( $title ) . ' </div>';
		}

		$counter_content .= '</div>';

		$uid = uniqid( 'counter' );

		$icon_counter = '<div class=" content_hover_effect ' . esc_attr( $hover_class ) . '" >';

			$icon_counter .= '<div class="plus-number-counter counter-' . esc_attr( $style ) . ' ' . esc_attr( $uid ) . ' ' . esc_attr( $animated_class ) . '" data-id="' . esc_attr( $uid ) . '" ' . $animation_attr . '>';

				$icon_counter .= $counter_content;

			$icon_counter .= '</div>';

		$icon_counter .= '</div>';

		echo $icon_counter;
	}
}
