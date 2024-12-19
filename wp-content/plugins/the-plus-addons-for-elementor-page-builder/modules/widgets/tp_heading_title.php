<?php
/**
 * Widget Name: Heading Title
 * Description: Creative Heading Options.
 * Author: Theplus
 * Author URI: https://posimyth.com
 *
 * @package ThePlus
 */

namespace TheplusAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;

if ( ! defined( 'ABSPATH' ) ) {
	exit;// Exit if accessed directly.
}

/**
 * Class L_Theplus_Ele_Heading_Title
 */
class L_Theplus_Ele_Heading_Title extends Widget_Base {

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
	 */
	public function get_name() {
		return 'tp-heading-title';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 1.0.0
	 */
	public function get_title() {
		return esc_html__( 'Heading Title', 'tpebl' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'fa fa-header theplus_backend_icon';
	}

	/**
	 * Get Widget categories.
	 *
	 * @since 1.0.0
	 */
	public function get_categories() {
		return array( 'plus-essential' );
	}

	/**
	 * Get Widget keywords.
	 *
	 * @since 1.0.0
	 */
	public function get_keywords() {
		return array( 'Heading', 'Title', 'Heading Title', 'Heading Widget', 'Title Widget' );
	}

	public function get_custom_help_url() {
		$help_url = $this->tp_help;

		return esc_url( $help_url );
	}

	/**
	 * Register controls.
	 *
	 * @since 1.0.0
	 *
	 * @version 5.4.2
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'heading_title_layout_section',
			array(
				'label' => esc_html__( 'Content', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'heading_style',
			array(
				'type'    => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Style', 'tpebl' ),
				'default' => 'style_1',
				'options' => array(
					'style_1' => esc_html__( 'Modern', 'tpebl' ),
					'style_2' => esc_html__( 'Simple', 'tpebl' ),
					'style_4' => esc_html__( 'Classic', 'tpebl' ),
					'style_5' => esc_html__( 'Double Border', 'tpebl' ),
					'style_6' => esc_html__( 'Vertical Border', 'tpebl' ),
					'style_7' => esc_html__( 'Dashing Dots', 'tpebl' ),
					'style_8' => esc_html__( 'Unique', 'tpebl' ),
					'style_9' => esc_html__( 'Stylish', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'select_heading',
			array(
				'label'   => esc_html__( 'Select Heading', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => array(
					'default'    => esc_html__( 'Default', 'tpebl' ),
					'page_title' => esc_html__( 'Page Title', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_page_title',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "slide-out-discount-code-card-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'select_heading' => array( 'page_title' ),
				),
			)
		);
		$this->add_control(
			'title',
			array(
				'type'        => Controls_Manager::TEXT,
				'label'       => esc_html__( 'Heading Title', 'tpebl' ),
				'label_block' => true,
				'default'     => esc_html__( 'Heading', 'tpebl' ),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'select_heading' => 'default',
				),
			)
		);
		$this->add_control(
			'sub_title',
			array(
				'type'        => Controls_Manager::TEXT,
				'label'       => esc_html__( 'Sub Title', 'tpebl' ),
				'label_block' => true,
				'separator'   => 'before',
				'default'     => esc_html__( 'Sub Title', 'tpebl' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);
		$this->add_control(
			'title_s',
			array(
				'type'        => Controls_Manager::TEXT,
				'label'       => esc_html__( 'Extra Title', 'tpebl' ),
				'label_block' => true,
				'separator'   => 'before',
				'default'     => esc_html__( 'Title', 'tpebl' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);
		$this->add_control(
			'heading_s_style',
			array(
				'type'    => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Extra Title Position', 'tpebl' ),
				'default' => 'text_after',
				'options' => array(
					'text_after'  => esc_html__( 'Prefix', 'tpebl' ),
					'text_before' => esc_html__( 'Postfix', 'tpebl' ),
				),
			)
		);
		$this->add_responsive_control(
			'sub_title_align',
			array(
				'label'        => esc_html__( 'Alignment', 'tpebl' ),
				'type'         => Controls_Manager::CHOOSE,
				'options'      => array(
					'left'    => array(
						'title' => esc_html__( 'Left', 'tpebl' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center'  => array(
						'title' => esc_html__( 'Center', 'tpebl' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'   => array(
						'title' => esc_html__( 'Right', 'tpebl' ),
						'icon'  => 'eicon-text-align-right',
					),
					'justify' => array(
						'title' => esc_html__( 'Justify', 'tpebl' ),
						'icon'  => 'eicon-text-align-justify',
					),
				),
				'devices'      => array( 'desktop', 'tablet', 'mobile' ),
				'prefix_class' => 'text-%s',
				'default'      => 'center',
				'separator'    => 'before',
			)
		);
		$this->add_control(
			'heading_title_subtitle_limit',
			array(
				'label'     => wp_kses_post( "Heading Title & Sub Title Limit <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "limit-word-count-in-heading-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'display_heading_title_limit',
			array(
				'label'     => esc_html__( 'Heading Title Limit', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'default'   => 'no',
				'separator' => 'before',
				'condition' => array(
					'heading_title_subtitle_limit' => 'yes',
				),
			)
		);
		$this->add_control(
			'display_heading_title_by',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Limit on', 'tpebl' ),
				'default'   => 'char',
				'options'   => array(
					'char' => esc_html__( 'Character', 'tpebl' ),
					'word' => esc_html__( 'Word', 'tpebl' ),
				),
				'condition' => array(
					'heading_title_subtitle_limit' => 'yes',
					'display_heading_title_limit'  => 'yes',
				),
			)
		);
		$this->add_control(
			'display_heading_title_input',
			array(
				'label'     => esc_html__( 'Heading Title Count', 'tpebl' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 1000,
				'step'      => 1,
				'condition' => array(
					'heading_title_subtitle_limit' => 'yes',
					'display_heading_title_limit'  => 'yes',
				),
			)
		);
		$this->add_control(
			'display_title_3_dots',
			array(
				'label'     => esc_html__( 'Display Dots', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'default'   => 'yes',
				'condition' => array(
					'heading_title_subtitle_limit' => 'yes',
					'display_heading_title_limit'  => 'yes',
				),
			)
		);

		$this->add_control(
			'display_sub_title_limit',
			array(
				'label'     => esc_html__( 'Sub Title Limit', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'default'   => 'no',
				'separator' => 'before',
				'condition' => array(
					'heading_title_subtitle_limit' => 'yes',
				),
			)
		);
		$this->add_control(
			'display_sub_title_by',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Limit on', 'tpebl' ),
				'default'   => 'char',
				'options'   => array(
					'char' => esc_html__( 'Character', 'tpebl' ),
					'word' => esc_html__( 'Word', 'tpebl' ),
				),
				'condition' => array(
					'heading_title_subtitle_limit' => 'yes',
					'display_sub_title_limit'      => 'yes',
				),
			)
		);
		$this->add_control(
			'display_sub_title_input',
			array(
				'label'     => esc_html__( 'Sub Title Count', 'tpebl' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 1000,
				'step'      => 1,
				'condition' => array(
					'heading_title_subtitle_limit' => 'yes',
					'display_sub_title_limit'      => 'yes',
				),
			)
		);
		$this->add_control(
			'display_sub_title_3_dots',
			array(
				'label'     => esc_html__( 'Display Dots', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'default'   => 'yes',
				'condition' => array(
					'heading_title_subtitle_limit' => 'yes',
					'display_sub_title_limit'      => 'yes',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_styling',
			array(
				'label'     => esc_html__( 'Separator Settings', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'heading_style!' => array( 'style_1', 'style_2', 'style_8' ),
				),
			)
		);
		$this->add_control(
			'input_margin',
			array(
				'label'      => esc_html__( 'Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .heading .sub-style .vertical-divider,
					 {{WRAPPER}} .heading-title .separator,
					 {{WRAPPER}} .heading.style-5 .heading-title:after,.heading.style-5 .heading-title:before,
					 {{WRAPPER}} .heading.style-7 .head-title:after,
					 {{WRAPPER}} .heading.style-9 .head-title .seprator.sep-l ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'double_color',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#4d4d4d',
				'selectors' => array(
					'{{WRAPPER}} .heading.style-5 .heading-title:before,{{WRAPPER}} .heading.style-5 .heading-title:after' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'heading_style' => 'style_5',
				),
			)
		);
		$this->add_control(
			'double_top',
			array(
				'label'     => esc_html__( 'Top Separator Height', 'tpebl' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => -50,
				'step'      => 1,
				'default'   => 6,
				'condition' => array(
					'heading_style' => 'style_5',
				),
				'selectors' => array(
					'{{WRAPPER}} .heading.style-5 .heading-title:before' => 'height: {{VALUE}}px;',
				),

			)
		);
		$this->add_control(
			'double_bottom',
			array(
				'label'     => esc_html__( 'Bottom Separator Height', 'tpebl' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => -50,
				'step'      => 1,
				'default'   => 2,
				'condition' => array(
					'heading_style' => 'style_5',
				),
				'selectors' => array(
					'{{WRAPPER}} .heading.style-5 .heading-title:after' => 'height: {{VALUE}}px;',
				),

			)
		);
		$this->add_control(
			'sep_img',
			array(
				'label'     => esc_html__( 'Separator With Image', 'tpebl' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url' => '',
				),
				'condition' => array(
					'heading_style' => 'style_4',
				),
			)
		);
		$this->add_control(
			'sep_clr',
			array(
				'label'     => esc_html__( 'Separator Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#4099c3',
				'selectors' => array(
					'{{WRAPPER}} .heading .title-sep' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'heading_style' => array( 'style_4', 'style_9' ),
				),
			)
		);
		$this->add_responsive_control(
			'sep_width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Separator Width', 'tpebl' ),
				'size_units'  => array( '%', 'px' ),
				'default'     => array(
					'unit' => '%',
					'size' => 100,
				),
				'range'       => array(
					'' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 2,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .heading .title-sep,{{WRAPPER}} .heading .seprator' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition'   => array(
					'heading_style' => array( 'style_4', 'style_9' ),
				),
			)
		);
		$this->add_control(
			'dot_color',
			array(
				'label'     => esc_html__( 'Separator Dot Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ca2b2b',
				'selectors' => array(
					'{{WRAPPER}} .heading .sep-dot' => 'color: {{VALUE}};',
					'{{WRAPPER}} .heading.style-7 .head-title:after' => 'color: {{VALUE}}; text-shadow: 15px 0 {{VALUE}}, -15px 0 {{VALUE}};',
				),
				'condition' => array(
					'heading_style' => array( 'style_7', 'style_9' ),
				),
			)
		);
		$this->add_responsive_control(
			'sep_height',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Separator Height', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'default'     => array(
					'unit' => 'px',
					'size' => 2,
				),
				'range'       => array(
					'' => array(
						'min'  => 0,
						'max'  => 10,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .heading .title-sep' => 'border-width: {{SIZE}}{{UNIT}};',
				),
				'condition'   => array(
					'heading_style' => 'style_4',
				),
			)
		);
		$this->add_control(
			'top_clr',
			array(
				'label'     => esc_html__( 'Separator Vertical Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#1e73be',
				'selectors' => array(
					'{{WRAPPER}} .heading .vertical-divider' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'heading_style' => 'style_6',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_title_styling',
			array(
				'label'     => esc_html__( 'Main Title', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'title!' => '',
				),

			)
		);
		$this->add_control(
			'title_h',
			array(
				'type'    => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Title Tag', 'tpebl' ),
				'default' => 'h2',
				'options' => l_theplus_get_tags_options( 'a' ),
			)
		);
		$this->add_control(
			'title_link',
			array(
				'label'       => esc_html__( 'Heading Title Link', 'tpebl' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => array(
					'active' => true,
				),
				'placeholder' => esc_html__( 'https://www.demo-link.com', 'tpebl' ),
				'condition'   => array(
					'title_h' => 'a',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Title Typography', 'tpebl' ),
				'selector' => '{{WRAPPER}} .heading .heading-title',
			)
		);
		$this->add_control(
			'title_color',
			array(
				'label'       => esc_html__( 'Title Color', 'tpebl' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => array(
					'solid'    => array(
						'title' => esc_html__( 'Solid', 'tpebl' ),
						'icon'  => 'eicon-paint-brush',
					),
					'gradient' => array(
						'title' => esc_html__( 'Gradient', 'tpebl' ),
						'icon'  => 'fa fa-barcode',
					),
				),
				'label_block' => false,
				'default'     => 'solid',
				'toggle'      => true,
			)
		);
		$this->add_control(
			'title_solid_color',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .heading .heading-title' => 'color: {{VALUE}};',
				),
				'default'   => '#313131',
				'condition' => array(
					'title_color' => array( 'solid' ),
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
					'title_color' => 'gradient',
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
					'title_color' => 'gradient',
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
					'title_color' => 'gradient',
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
					'title_color' => 'gradient',
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
					'title_color' => 'gradient',
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
					'{{WRAPPER}} .heading .heading-title' => 'background-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{title_gradient_color1.VALUE}} {{title_gradient_color1_control.SIZE}}{{title_gradient_color1_control.UNIT}}, {{title_gradient_color2.VALUE}} {{title_gradient_color2_control.SIZE}}{{title_gradient_color2_control.UNIT}})',
				),
				'condition'  => array(
					'title_color'          => array( 'gradient' ),
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
					'{{WRAPPER}} .heading .heading-title' => 'background-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{title_gradient_color1.VALUE}} {{title_gradient_color1_control.SIZE}}{{title_gradient_color1_control.UNIT}}, {{title_gradient_color2.VALUE}} {{title_gradient_color2_control.SIZE}}{{title_gradient_color2_control.UNIT}})',
				),
				'condition' => array(
					'title_color'          => array( 'gradient' ),
					'title_gradient_style' => 'radial',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'      => 'title_shadow',
				'selectors' => '{{WRAPPER}} .heading .heading-title',
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			's_maintitle_pg',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .heading_style .heading-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'heading_style' => array( 'style_1', 'style_2' ),
				),
			)
		);
		$this->add_control(
			'special_effect',
			array(
				'label'     => esc_html__( 'Special Effect', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'separator' => 'before',
				'condition' => array(
					'heading_style' => array( 'style_1', 'style_2', 'style_8' ),
				),
			)
		);
		$this->add_control(
			'special_effect_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'heading_style'  => array( 'style_1', 'style_2', 'style_8' ),
					'special_effect' => 'yes',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_sub_title_styling',
			array(
				'label'     => esc_html__( 'Sub Title', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'sub_title!' => '',
				),
			)
		);
		$this->add_control(
			'sub_title_tag',
			array(
				'type'    => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Subtitle Tag', 'tpebl' ),
				'default' => 'h3',
				'options' => l_theplus_get_tags_options(),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'sub_title_typography',
				'label'    => esc_html__( 'Typography', 'tpebl' ),
				'selector' => '{{WRAPPER}} .heading .heading-sub-title',
			)
		);
		$this->add_control(
			'sub_title_color',
			array(
				'label'       => esc_html__( 'Subtitle Title Color', 'tpebl' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => array(
					'solid'    => array(
						'title' => esc_html__( 'Solid', 'tpebl' ),
						'icon'  => 'eicon-paint-brush',
					),
					'gradient' => array(
						'title' => esc_html__( 'Gradient', 'tpebl' ),
						'icon'  => 'fa fa-barcode',
					),
				),
				'label_block' => false,
				'default'     => 'solid',
				'toggle'      => true,
			)
		);
		$this->add_control(
			'sub_title_solid_color',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .heading .heading-sub-title' => 'color: {{VALUE}};',
				),
				'default'   => '#313131',
				'condition' => array(
					'sub_title_color' => array( 'solid' ),
				),
			)
		);
		$this->add_control(
			'sub_title_gradient_color1',
			array(
				'label'     => esc_html__( 'Color 1', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'orange',
				'condition' => array(
					'sub_title_color' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'sub_title_gradient_color1_control',
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
					'sub_title_color' => 'gradient',
				),
				'of_type'     => 'gradient',
			)
		);
		$this->add_control(
			'sub_title_gradient_color2',
			array(
				'label'     => esc_html__( 'Color 2', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'cyan',
				'condition' => array(
					'sub_title_color' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'sub_title_gradient_color2_control',
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
					'sub_title_color' => 'gradient',
				),
				'of_type'     => 'gradient',
			)
		);
		$this->add_control(
			'sub_title_gradient_style',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Gradient Style', 'tpebl' ),
				'default'   => 'linear',
				'options'   => l_theplus_get_gradient_styles(),
				'condition' => array(
					'sub_title_color' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'sub_title_gradient_angle',
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
					'{{WRAPPER}} .heading .heading-sub-title' => 'background-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{sub_title_gradient_color1.VALUE}} {{sub_title_gradient_color1_control.SIZE}}{{sub_title_gradient_color1_control.UNIT}}, {{sub_title_gradient_color2.VALUE}} {{sub_title_gradient_color2_control.SIZE}}{{sub_title_gradient_color2_control.UNIT}})',
				),
				'condition'  => array(
					'sub_title_color'          => array( 'gradient' ),
					'sub_title_gradient_style' => array( 'linear' ),
				),
				'of_type'    => 'gradient',
			)
		);
		$this->add_control(
			'sub_title_gradient_position',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Position', 'tpebl' ),
				'options'   => l_theplus_get_position_options(),
				'default'   => 'center center',
				'selectors' => array(
					'{{WRAPPER}} .heading .heading-sub-title' => 'background-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{sub_title_gradient_color1.VALUE}} {{sub_title_gradient_color1_control.SIZE}}{{sub_title_gradient_color1_control.UNIT}}, {{sub_title_gradient_color2.VALUE}} {{sub_title_gradient_color2_control.SIZE}}{{sub_title_gradient_color2_control.UNIT}})',
				),
				'condition' => array(
					'sub_title_color'          => array( 'gradient' ),
					'sub_title_gradient_style' => 'radial',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_responsive_control(
			's_subtitle_pg',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .heading_style .heading-sub-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'heading_style' => array( 'style_1', 'style_2' ),
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_extra_title_styling',
			array(
				'label'     => esc_html__( 'Extra Title', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'heading_style' => 'style_1',
					'title_s!'      => '',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'ex_title_typography',
				'label'    => esc_html__( 'Typography', 'tpebl' ),
				'selector' => '{{WRAPPER}} .heading .title-s',
			)
		);
		$this->add_control(
			'ex_title_color',
			array(
				'label'       => esc_html__( 'Extra Title Color', 'tpebl' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => array(
					'solid'    => array(
						'title' => esc_html__( 'Solid', 'tpebl' ),
						'icon'  => 'eicon-paint-brush',
					),
					'gradient' => array(
						'title' => esc_html__( 'Gradient', 'tpebl' ),
						'icon'  => 'fa fa-barcode',
					),
				),
				'label_block' => false,
				'default'     => 'solid',
				'toggle'      => true,
			)
		);
		$this->add_control(
			'ex_title_solid_color',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .heading .title-s' => 'color: {{VALUE}};',
				),
				'default'   => '#313131',
				'condition' => array(
					'ex_title_color' => array( 'solid' ),
				),
			)
		);
		$this->add_control(
			'ex_title_gradient_color1',
			array(
				'label'     => esc_html__( 'Color 1', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'orange',
				'condition' => array(
					'ex_title_color' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'ex_title_gradient_color1_control',
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
					'ex_title_color' => 'gradient',
				),
				'of_type'     => 'gradient',
			)
		);
		$this->add_control(
			'ex_title_gradient_color2',
			array(
				'label'     => esc_html__( 'Color 2', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'cyan',
				'condition' => array(
					'ex_title_color' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'ex_title_gradient_color2_control',
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
					'ex_title_color' => 'gradient',
				),
				'of_type'     => 'gradient',
			)
		);
		$this->add_control(
			'ex_title_gradient_style',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Gradient Style', 'tpebl' ),
				'default'   => 'linear',
				'options'   => l_theplus_get_gradient_styles(),
				'condition' => array(
					'ex_title_color' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'ex_title_gradient_angle',
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
					'{{WRAPPER}} .heading .title-s' => 'background-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{ex_title_gradient_color1.VALUE}} {{ex_title_gradient_color1_control.SIZE}}{{ex_title_gradient_color1_control.UNIT}}, {{ex_title_gradient_color2.VALUE}} {{ex_title_gradient_color2_control.SIZE}}{{ex_title_gradient_color2_control.UNIT}})',
				),
				'condition'  => array(
					'ex_title_color'          => array( 'gradient' ),
					'ex_title_gradient_style' => array( 'linear' ),
				),
				'of_type'    => 'gradient',
			)
		);
		$this->add_control(
			'ex_title_gradient_position',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Position', 'tpebl' ),
				'options'   => l_theplus_get_position_options(),
				'default'   => 'center center',
				'selectors' => array(
					'{{WRAPPER}} .heading .title-s' => 'background-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{ex_title_gradient_color1.VALUE}} {{ex_title_gradient_color1_control.SIZE}}{{ex_title_gradient_color1_control.UNIT}}, {{ex_title_gradient_color2.VALUE}} {{ex_title_gradient_color2_control.SIZE}}{{ex_title_gradient_color2_control.UNIT}})',
				),
				'condition' => array(
					'ex_title_color'          => array( 'gradient' ),
					'ex_title_gradient_style' => 'radial',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_settings_option_styling',
			array(
				'label' => esc_html__( 'Advanced', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'position',
			array(
				'type'    => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Title Position', 'tpebl' ),
				'default' => 'after',
				'options' => array(
					'before' => esc_html__( 'Before Title', 'tpebl' ),
					'after'  => esc_html__( 'After Title', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'mobile_center_align',
			array(
				'type'    => Controls_Manager::SWITCHER,
				'label'   => esc_html__( 'Center Alignment In Mobile', 'tpebl' ),
				'default' => 'no',
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
	 * Load Widget limit Words
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 *
	 * @param string $string The string to limit the words for.
	 * @param int    $word_limit The maximum number of words to keep in the string.
	 * @return string The modified string with the limited number of words.
	 */
	protected function l_limit_words( $string, $word_limit ) {
		$words = explode( ' ', $string );
		return implode( ' ', array_splice( $words, 0, $word_limit ) );
	}

	/**
	 * Render Progress Bar
	 *
	 * Written in PHP and HTML.
	 *
	 * @since 1.0.0
	 *
	 * @version 5.4.2
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		$heading_style = ! empty( $settings['heading_style'] ) ? $settings['heading_style'] : 'style_1';
		$select_head   = ! empty( $settings['select_heading'] ) ? $settings['select_heading'] : 'default';
		$title         = ! empty( $settings['title'] ) ? $settings['title'] : '';
		$head_limit    = ! empty( $settings['display_heading_title_limit'] ) ? $settings['display_heading_title_limit'] : '';
		$head_count    = ! empty( $settings['display_heading_title_input'] ) ? $settings['display_heading_title_input'] : '';

		$head_by   = ! empty( $settings['display_heading_title_by'] ) ? $settings['display_heading_title_by'] : 'char';
		$dots      = ! empty( $settings['display_title_3_dots'] ) ? $settings['display_title_3_dots'] : '';
		$sep_img   = ! empty( $settings['sep_img']['url'] ) ? $settings['sep_img']['url'] : '';
		$t_color   = ! empty( $settings['title_color'] ) ? $settings['title_color'] : '';
		$ex_color  = ! empty( $settings['ex_title_color'] ) ? $settings['ex_title_color'] : '';
		$sub_color = ! empty( $settings['sub_title_color'] ) ? $settings['sub_title_color'] : '';

		$animation_effects = ! empty( $settings['animation_effects'] ) ? $settings['animation_effects'] : '';
		$animation_delay   = ! empty( $settings['animation_delay']['size'] ) ? $settings['animation_delay']['size'] : 50;
		$ani_duration      = ! empty( $settings['animation_duration_default'] ) ? $settings['animation_duration_default'] : '';

		$ani_size  = ! empty( $settings['animate_duration']['size'] ) ? $settings['animate_duration']['size'] : 50;
		$out_ani   = ! empty( $settings['animation_out_effects'] ) ? $settings['animation_out_effects'] : '';
		$ani_delay = ! empty( $settings['animation_out_delay']['size'] ) ? $settings['animation_out_delay']['size'] : '';
		$out_d_ani = ! empty( $settings['animation_out_duration_default'] ) ? $settings['animation_out_duration_default'] : '';
		$out_speed = ! empty( $settings['animation_out_duration']['size'] ) ? $settings['animation_out_duration']['size'] : 50;

		$sub_title_count = ! empty( $settings['display_sub_title_input'] ) ? $settings['display_sub_title_input'] : '';
		$mobaile_align   = ! empty( $settings['mobile_center_align'] ) ? $settings['mobile_center_align'] : '';
		$sub_limit_by    = ! empty( $settings['display_sub_title_by'] ) ? $settings['display_sub_title_by'] : 'char';

		$title_link = ! empty( $settings['title_link']['url'] ) ? $settings['title_link']['url'] : '';
		$title_h    = ! empty( $settings['title_h'] ) ? $settings['title_h'] : 'h2';
		$sub_title  = ! empty( $settings['sub_title'] ) ? $settings['sub_title'] : '';
		$sub_limit  = ! empty( $settings['display_sub_title_limit'] ) ? $settings['display_sub_title_limit'] : '';
		$sub_dots   = ! empty( $settings['display_sub_title_3_dots'] ) ? $settings['display_sub_title_3_dots'] : '';
		$sub_tag    = ! empty( $settings['sub_title_tag'] ) ? $settings['sub_title_tag'] : 'h3';
		$position   = ! empty( $settings['position'] ) ? $settings['position'] : 'after';
		$title_s    = ! empty( $settings['title_s'] ) ? $settings['title_s'] : '';

		$heading_title_text = '';
		if ( 'page_title' === $select_head ) {
			$heading_title_text = get_the_title();
		} elseif ( ! empty( $title ) ) {

			if ( ( 'yes' === $head_limit ) && ! empty( $head_count ) ) {

				if ( ! empty( $head_by ) ) {
					if ( 'char' === $head_by ) {
						$heading_title_text = substr( $title, 0, $head_count );

					} elseif ( 'word' === $head_by ) {
						$heading_title_text = $this->l_limit_words( $title, $head_count );
					}
				}

				if ( 'char' === $head_by ) {

					if ( strlen( $title ) > $head_count ) {
						if ( 'yes' === $dots ) {
							$heading_title_text .= '...';
						}
					}
				} elseif ( 'word' === $head_by ) {

					if ( str_word_count( $title ) > $head_count ) {

						if ( 'yes' === $dots ) {
							$heading_title_text .= '...';
						}
					}
				}
			} else {
				$heading_title_text = $title;
			}
		}

		$img_src = '';

		$sub_gradient_cass     = '';
		$title_s_gradient_cass = '';
		$title_gradient_cass   = '';

		if ( ! empty( $sep_img ) ) {
			$image_id = $settings['sep_img']['id'];
			$img_src  = tp_get_image_rander( $image_id, 'full', array( 'class' => 'service-img' ) );
		}

		if ( 'gradient' === $t_color ) {
			$title_gradient_cass = 'heading-title-gradient';
		}
		if ( 'gradient' === $ex_color ) {
			$title_s_gradient_cass = 'heading-title-gradient';
		}
		if ( 'gradient' === $sub_color ) {
			$sub_gradient_cass = 'heading-title-gradient';
		}

		if ( 'no-animation' === $animation_effects ) {
			$animated_class = '';
			$animation_attr = '';
		} else {
			$animate_offset  = '85%';
			$animated_class  = 'animate-general';
			$animation_attr  = ' data-animate-type="' . esc_attr( $animation_effects ) . '" data-animate-delay="' . esc_attr( $animation_delay ) . '"';
			$animation_attr .= ' data-animate-offset="' . esc_attr( $animate_offset ) . '"';

			if ( 'yes' === $ani_duration ) {
				$animate_duration = $ani_size;
				$animation_attr  .= ' data-animate-duration="' . esc_attr( $animate_duration ) . '"';
			}

			if ( 'no-animation' !== $out_ani ) {
				$animation_attr .= ' data-animate-out-type="' . esc_attr( $out_ani ) . '" data-animate-out-delay="' . esc_attr( $ani_delay ) . '"';

				if ( 'yes' === $out_d_ani ) {
					$animation_attr .= ' data-animate-out-duration="' . esc_attr( $out_speed ) . '"';
				}
			}
		}

		$style_class = '';
		if ( 'style_1' === $heading_style ) {
			$style_class = 'style-1';
		} elseif ( 'style_2' === $heading_style ) {
			$style_class = 'style-2';
		} elseif ( 'style_4' === $heading_style ) {
			$style_class = 'style-4';
		} elseif ( 'style_5' === $heading_style ) {
			$style_class = 'style-5';
		} elseif ( 'style_6' === $heading_style ) {
			$style_class = 'style-6';
		} elseif ( 'style_7' === $heading_style ) {
			$style_class = 'style-7';
		} elseif ( 'style_8' === $heading_style ) {
			$style_class = 'style-8';
		} elseif ( 'style_9' === $heading_style ) {
			$style_class = 'style-9';
		} elseif ( 'style_10' === $heading_style ) {
			$style_class = 'style-10';
		} elseif ( 'style_11' === $heading_style ) {
			$style_class = 'style-11';
		}

		$uid = uniqid( 'heading_style' );

		$heading = '<div class="heading heading_style ' . esc_attr( $uid ) . ' ' . esc_attr( $style_class ) . ' ' . esc_attr( $animated_class ) . '" ' . $animation_attr . '>';

		$mobile_center = '';

		if ( 'yes' === $mobaile_align ) {

			if ( 'style_1' === $heading_style || 'style_2' === $heading_style || 'style_4' === $heading_style || 'style_5' === $heading_style || 'style_7' === $heading_style || 'style_9' === $heading_style ) {
				$mobile_center = 'heading-mobile-center';
			}
		}
		$heading .= '<div class="sub-style" >';

		if ( 'style_6' === $heading_style ) {
			$heading .= '<div class="vertical-divider top"> </div>';
		}
		$title_con      = '';
		$s_title_con    = '';
		$title_s_before = '';

		if ( 'style_1' === $heading_style ) {
			$title_s_before .= '<span class="title-s ' . esc_attr( $title_s_gradient_cass ) . '"> ' . wp_kses_post( $title_s ) . ' </span>';
		}

		if ( ! empty( $heading_title_text ) ) {

			if ( ! empty( $title_link ) && 'a' === $title_h ) {
				$this->add_render_attribute( 'titlehref', 'href', esc_url( $title_link ) );

				if ( $settings['title_link']['is_external'] ) {
					$this->add_render_attribute( 'titlehref', 'target', '_blank' );
				}

				if ( $settings['title_link']['nofollow'] ) {
					$this->add_render_attribute( 'titlehref', 'rel', 'nofollow' );
				}
			}

			$title_con      = '<div class="head-title ' . esc_attr( $mobile_center ) . '" > ';
				$title_con .= '<' . esc_attr( l_theplus_validate_html_tag( $title_h ) ) . ' ' . $this->get_render_attribute_string( 'titlehref' ) . ' class="heading-title ' . esc_attr( $mobile_center ) . '  ' . esc_attr( $title_gradient_cass ) . '"  data-hover="' . esc_attr( $heading_title_text ) . '">';

			$hed_text_st = ! empty( $settings['heading_s_style'] ) ? $settings['heading_s_style'] : '';

			if ( 'text_before' === $hed_text_st ) {
				$title_con .= $title_s_before . $heading_title_text;
			} else {
				$title_con .= $heading_title_text . $title_s_before;
			}
				$title_con .= '</' . esc_attr( l_theplus_validate_html_tag( $title_h ) ) . '>';

			if ( 'style_4' === $heading_style || 'style_9' === $heading_style ) {
				$title_con .= '<div class="seprator sep-l" >';
				$title_con .= '<span class="title-sep sep-l" ></span>';

				if ( 'style_9' === $heading_style ) {
					$title_con .= '<div class="sep-dot">.</div>';
				} elseif ( ! empty( $img_src ) ) {
					$title_con .= '<div class="sep-mg">' . $img_src . '</div>';
				}
				$title_con .= '<span class="title-sep sep-r" ></span>';
				$title_con .= '</div>';
			}
			$title_con .= '</div>';
		}
			$sub_title_dis = '';
		if ( ! empty( $sub_title ) ) {
			if ( 'yes' === $sub_limit && ! empty( $sub_title_count ) ) {

				if ( ! empty( $sub_limit_by ) ) {

					if ( 'char' === $sub_limit_by ) {
						$sub_title_dis = substr( $sub_title, 0, $sub_title_count );
						if ( strlen( $sub_title ) > $sub_title_count ) {
							if ( 'yes' === $sub_dots ) {
								$sub_title_dis .= '...';
							}
						}
					} elseif ( 'word' === $sub_limit_by ) {
						$sub_title_dis = $this->l_limit_words( $sub_title, $sub_title_count );
						if ( str_word_count( $sub_title ) > $sub_title_count ) {
							if ( 'yes' === $sub_dots ) {
								$sub_title_dis .= '...';
							}
						}
					}
				}
			} else {
				$sub_title_dis = $sub_title;
			}
			$s_title_con  = '<div class="sub-heading">';
			$s_title_con .= '<' . esc_attr( l_theplus_validate_html_tag( $sub_tag ) ) . ' class="heading-sub-title ' . esc_attr( $mobile_center ) . ' ' . esc_attr( $sub_gradient_cass ) . '"> ' . esc_html( $sub_title_dis ) . ' </' . esc_attr( l_theplus_validate_html_tag( $sub_tag ) ) . '>';
			$s_title_con .= '</div>';
		}
		if ( 'before' === $position ) {
			$heading .= $s_title_con . $title_con;

		}if ( 'after' === $position ) {
			$heading .= $title_con . $s_title_con;
		}
		if ( 'style_6' === $heading_style ) {
			$heading .= '<div class="vertical-divider bottom"> </div>';
		}
				$heading .= '</div>';
			$heading     .= '</div>';

		echo $heading;
	}
}
