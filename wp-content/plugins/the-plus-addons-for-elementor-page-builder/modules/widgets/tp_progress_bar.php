<?php
/**
 * Widget Name: Progress Bar
 * Description: Progress Bar
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
use Elementor\Group_Control_Image_Size;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;

use TheplusAddons\L_Theplus_Element_Load;

if ( ! defined( 'ABSPATH' ) ) {
	exit;// Exit if accessed directly.
}

/**
 * Class L_ThePlus_Progress_Bar
 */
class L_ThePlus_Progress_Bar extends Widget_Base {

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
		return 'tp-progress-bar';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Progress Bar', 'tpebl' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-pie-chart theplus_backend_icon';
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
	 *
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
		return array( 'pie chart', 'chart', 'Graph', 'Data Visualization', 'Circular Chart', 'Percentage Chart', 'Statistics Chart', 'Progress Bar', 'Progress Indicator', 'Progress Tracker', 'Progress Meter', 'Progress Graph', 'Progress Chart', 'Progress Status' );
	}

	/**
	 * Register controls.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'progress_bar',
			array(
				'label' => esc_html__( 'Progress Bar', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'main_style',
			array(
				'label'   => esc_html__( 'Main Style', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'progressbar',
				'options' => array(
					'progressbar' => esc_html__( 'Progress Bar', 'tpebl' ),
					'pie_chart'   => esc_html__( 'Pie Chart', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_piechart',
			array(
				'label' => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "create-circle-progress-bars-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> Learn How it works  <i class='eicon-help-o'></i> </a>" ),
				'type'  => Controls_Manager::HEADING,
				'condition' => array(
					'main_style' => 'pie_chart',
				),
			)
		);
		$this->add_control(
			'pie_chart_style',
			array(
				'label'     => esc_html__( 'Pie Chart Style', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style_1',
				'options'   => array(
					'style_1' => esc_html__( 'Style 1', 'tpebl' ),
					'style_2' => esc_html__( 'Style 2', 'tpebl' ),
					'style_3' => esc_html__( 'Style 3', 'tpebl' ),
				),
				'condition' => array(
					'main_style' => array( 'pie_chart' ),
				),
			)
		);
		$this->add_control(
			'progressbar_style',
			array(
				'label'     => esc_html__( 'Progress Bar Style', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style_1',
				'options'   => array(
					'style_1' => esc_html__( 'Style 1', 'tpebl' ),
					'style_2' => esc_html__( 'Style 2', 'tpebl' ),
				),
				'condition' => array(
					'main_style' => array( 'progressbar' ),
				),
			)
		);
		$this->add_control(
			'pie_border_style',
			array(
				'label'     => esc_html__( 'Pie Chart Round Styles', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style_1',
				'options'   => array(
					'style_1' => esc_html__( 'Style 1', 'tpebl' ),
					'style_2' => esc_html__( 'Style 2', 'tpebl' ),
				),
				'condition' => array(
					'main_style' => array( 'pie_chart' ),
				),
			)
		);
		$this->add_control(
			'progress_bar_size',
			array(
				'label'     => esc_html__( 'Progress Bar Height', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'small',
				'options'   => array(
					'small'  => esc_html__( 'Small Height', 'tpebl' ),
					'medium' => esc_html__( 'Medium Height', 'tpebl' ),
					'large'  => esc_html__( 'Large Height', 'tpebl' ),
				),
				'condition' => array(
					'main_style'        => array( 'progressbar' ),
					'progressbar_style' => array( 'style_1' ),
				),
			)
		);

		$this->add_control(
			'value_width',
			array(
				'label'      => esc_html__( 'Dynamic Value (0-100)', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( '%' ),
				'range'      => array(
					'%' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'condition'  => array(
					'main_style' => array( 'progressbar' ),
				),
				'default'    => array(
					'unit' => '%',
					'size' => 59,
				),
				'separator'  => 'before',
			)
		);
		$this->add_control(
			'title',
			array(
				'label'     => esc_html__( 'Title', 'tpebl' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'The Plus', 'tpebl' ),
				'separator' => 'before',
				'dynamic'   => array( 'active' => false ),
				'ai' 		=> array('active' => false ),
			)
		);
		$this->add_control(
			'sub_title',
			array(
				'label'     => esc_html__( 'Sub Title', 'tpebl' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'The Plus', 'tpebl' ),
				'dynamic'   => array( 'active' => false ),
				'ai' 		=> array('active' => false ),
			)
		);

		$this->add_control(
			'number',
			array(
				'label'       => esc_html__( 'Number', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( '59', 'tpebl' ),
				'placeholder' => esc_html__( 'Enter Number Ex. 50 , 60', 'tpebl' ),
				'separator'   => 'before',
				'dynamic'     => array( 'active' => false ),
				'ai' 		  => array('active' => false ),
			)
		);
		$this->add_control(
			'symbol',
			array(
				'label'       => esc_html__( 'Prefix/Postfix Symbol', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( '%', 'tpebl' ),
				'placeholder' => esc_html__( 'Enter Symbol', 'tpebl' ),
				'dynamic'     => array( 'active' => false ),
				'ai' 		  => array('active' => false ),
			)
		);
		$this->add_control(
			'symbol_position',
			array(
				'label'     => esc_html__( 'Symbol Position', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'after',
				'options'   => array(
					'after'  => esc_html__( 'After Number', 'tpebl' ),
					'before' => esc_html__( 'Before Number', 'tpebl' ),
				),
				'condition' => array(
					'symbol!' => '',
				),
			)
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'icon_progress_bar',
			array(
				'label' => esc_html__( 'Icon', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'image_icon',
			array(
				'label'   => esc_html__( 'Select Icon', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'icon',
				'options' => array(
					''      => esc_html__( 'None', 'tpebl' ),
					'icon'  => esc_html__( 'Icon', 'tpebl' ),
					'image' => esc_html__( 'Image', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'image_Note',
			array(
				'type'        => Controls_Manager::RAW_HTML,
				'raw'         => '<p class="tp-controller-notice"><i>You can select Icon, Custom Image using this option.</i></p>',
				'label_block' => true,
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
				'dynamic'    => array( 'active' => true ),
				'media_type' => 'image',
				'condition'  => array(
					'image_icon' => 'image',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'select_image_thumbnail',
				'default'   => 'full',
			)
		);
		$this->add_control(
			'type',
			array(
				'label'     => esc_html__( 'Icon Font', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'font_awesome',
				'options'   => array(
					'font_awesome' => esc_html__( 'Font Awesome', 'tpebl' ),
					'icon_mind'    => esc_html__( 'Icons Mind (Pro)', 'tpebl' ),
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
					'image_icon' => 'icon',
					'type'       => 'font_awesome',
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
					'image_icon' => 'icon',
					'type'       => 'icon_mind',
				),
			)
		);
		$this->add_control(
			'icon_postition',
			array(
				'label'     => esc_html__( 'Icon Title Before after', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'before',
				'options'   => array(
					'before' => esc_html__( 'Before', 'tpebl' ),
					'after'  => esc_html__( 'After', 'tpebl' ),
				),
				'condition' => array(
					'image_icon' => array( 'icon', 'image', 'svg' ),
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_pie_chart_styling',
			array(
				'label'     => esc_html__( 'Pie Chart Setting', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'main_style' => array( 'pie_chart' ),
				),
			)
		);
		$this->add_control(
			'pie_value',
			array(
				'label'      => esc_html__( 'Dynamic Value (0-1)', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( '%' ),
				'range'      => array(
					'%' => array(
						'min'  => 0,
						'max'  => 1,
						'step' => 0.1,
					),
				),
				'default'    => array(
					'unit' => '%',
					'size' => 0.6,
				),
				'condition'  => array(
					'main_style' => array( 'pie_chart' ),
				),
				'separator'  => 'before',
			)
		);

		$this->add_responsive_control(
			'pie_size',
			array(
				'label'       => esc_html__( 'Pie Chart Circle Size', 'tpebl' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 700,
						'step' => 2,
					),
				),
				'render_type' => 'template',
				'default'     => array(
					'unit' => 'px',
					'size' => 200,
				),
				'selectors'   => array(
					'{{WRAPPER}} .pt-plus-circle' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
				'condition'   => array(
					'main_style' => array( 'pie_chart' ),
				),
			)
		);
		$this->add_control(
			'pie_thickness',
			array(
				'label'      => esc_html__( 'Thickness', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'%' => array(
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 5,
				),
				'condition'  => array(
					'main_style' => array( 'pie_chart' ),
				),
			)
		);
		$this->add_control(
			'data_empty_fill',
			array(
				'label'     => esc_html__( 'Pie Empty Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'condition' => array(
					'main_style'       => array( 'pie_chart' ),
					'pie_chart_style!' => array( 'style_2' ),
				),
			)
		);
		$this->add_control(
			'pie_empty_color',
			array(
				'label'     => esc_html__( 'pie Chart Empty Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'main_style'       => array( 'pie_chart1' ),
					'pie_chart_style!' => array( 'style_2' ),
				),
			)
		);
		$this->add_control(
			'pie_fill',
			array(
				'label'       => esc_html__( 'Chart Fill Color', 'tpebl' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => array(
					'classic'  => array(
						'title' => esc_html__( 'Classic', 'tpebl' ),
						'icon'  => 'eicon-paint-brush',
					),
					'gradient' => array(
						'title' => esc_html__( 'Gradient', 'tpebl' ),
						'icon'  => 'fa fa-barcode',
					),
				),
				'condition'   => array(
					'main_style' => array( 'pie_chart' ),
				),
				'label_block' => false,
				'default'     => 'classic',
			)
		);
		$this->add_control(
			'pie_fill_classic',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'orange',
				'condition' => array(
					'main_style' => array( 'pie_chart' ),
					'pie_fill'   => 'classic',
				),

			)
		);
		$this->add_control(
			'pie_fill_gradient_color1',
			array(
				'label'     => esc_html__( 'Color 1', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'orange',
				'condition' => array(
					'main_style' => array( 'pie_chart' ),
					'pie_fill'   => 'gradient',
				),

			)
		);
		$this->add_control(
			'pie_fill_gradient_color2',
			array(
				'label'     => esc_html__( 'Color 2', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'green',
				'condition' => array(
					'main_style' => array( 'pie_chart' ),
					'pie_fill'   => 'gradient',
				),

			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_styling',
			array(
				'label' => esc_html__( 'Title Setting', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typography', 'tpebl' ),
				'selector' => '{{WRAPPER}} .progress_bar .prog-title.prog-icon .progress_bar-title,{{WRAPPER}} .pt-plus-pie_chart .progress_bar-title',
			)
		);
		$this->add_control(
			'title_color',
			array(
				'label'     => esc_html__( 'Title Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => array(
					'default' => Global_Colors::COLOR_PRIMARY,
				),
				'selectors' => array(
					'{{WRAPPER}} span.progress_bar-title,
					{{WRAPPER}} .progress_bar-media.large .prog-title.prog-icon.large .progres-ims,
					{{WRAPPER}} .progress_bar-media.large .prog-title.prog-icon.large .progress_bar-title' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'title_margin',
			array(
				'label'      => esc_html__( 'Title Left Margin', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( '%' ),
				'range'      => array(
					'%' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} span.progress_bar-title,
					{{WRAPPER}} .progress_bar-media.large .prog-title.prog-icon.large .progres-ims,
					{{WRAPPER}} .tp-progress-bar span.progress_bar-title' => 'margin-left: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'main_style' => array( 'progressbar' ),
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_subtitle_styling',
			array(
				'label' => esc_html__( 'Sub Title Setting', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'subtitle_typography',
				'label'    => esc_html__( 'Typography', 'tpebl' ),
				'selector' => '{{WRAPPER}} .progress_bar .prog-title.prog-icon .progress_bar-sub_title,{{WRAPPER}} .pt-plus-pie_chart .progress_bar-sub_title',
			)
		);
		$this->add_control(
			'subtitle_color',
			array(
				'label'     => esc_html__( 'Sub Title Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .progress_bar-sub_title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'section_number_styling',
			array(
				'label' => esc_html__( 'Number Setting', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'number_typography',
				'label'    => esc_html__( 'Typography', 'tpebl' ),
				'selector' => '{{WRAPPER}} .progress_bar .counter-number .theserivce-milestone-number',
			)
		);
		$this->add_control(
			'number_color',
			array(
				'label'     => esc_html__( 'Number Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => array(
					'default' => Global_Colors::COLOR_PRIMARY,
				),
				'selectors' => array(
					'{{WRAPPER}} .progress_bar .counter-number .theserivce-milestone-number' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_responsive_control(
			'number_margin',
			array(
				'label'      => esc_html__( 'Space Between', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .pt-plus-pie_chart.style-3 .pie_chart .counter-number ' => 'margin-top: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_number_pre_pos_styling',
			array(
				'label' => esc_html__( 'Number Prefix/Postfix Style', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'prefix_postfix_typography',
				'label'    => esc_html__( 'Typography', 'tpebl' ),
				'selector' => '{{WRAPPER}} .progress_bar .counter-number .theserivce-milestone-symbol',
			)
		);
		$this->add_control(
			'prefix_postfix_symbol_color',
			array(
				'label'     => esc_html__( 'Prefix/Postfix Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .progress_bar .counter-number .theserivce-milestone-symbol' => 'color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'section_icon_styling',
			array(
				'label' => esc_html__( 'Icon/Image Setting', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'icon_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'image_icon' => array( 'icon' ),
				),
				'selectors' => array(
					'{{WRAPPER}} span.progres-ims' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'icon_size',
			array(
				'label'      => esc_html__( 'Icon Size', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'condition'  => array(
					'image_icon' => array( 'icon' ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .progress_bar .prog-title.prog-icon span.progres-ims,{{WRAPPER}} .pt-plus-circle .pianumber-css .progres-ims,{{WRAPPER}} .pt-plus-pie_chart .pie_chart .progres-ims' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'image_size',
			array(
				'label'      => esc_html__( 'Image Size', 'tpebl' ),
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
					'size' => 40,
				),
				'condition'  => array(
					'image_icon' => array( 'image' ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .progress_bar .progres-ims img.progress_bar-img' => 'height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};',
				),

			)
		);
		$this->add_responsive_control(
			'image_border_radius',
			array(
				'label'      => esc_html__( 'Image Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .progress_bar .progres-ims img.progress_bar-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'image_icon' => array( 'image' ),
				),
			)
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'section_progress_bar_styling',
			array(
				'label'     => esc_html__( 'Progress Bar Setting', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'main_style' => array( 'progressbar' ),
				),
			)
		);
		$this->add_control(
			'progress_bar_margin',
			array(
				'label'      => esc_html__( 'Progress Bar Top Margin', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( '%' ),
				'range'      => array(
					'%' => array(
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .progress_bar-skill.skill-fill' => 'margin-top: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'main_style' => array( 'progressbar' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'progress_filled_color',
				'label'    => esc_html__( 'Filled Color', 'tpebl' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .progress_bar-skill-bar-filled',
			)
		);
		$this->add_control(
			'progress_empty_color',
			array(
				'label' => esc_html__( 'Empty Color', 'tpebl' ),
				'type'  => Controls_Manager::COLOR,
			)
		);
		$this->add_control(
			'progress_seprator_color',
			array(
				'label'     => esc_html__( 'Seprator Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .progress-style_2 .progress_bar-skill-bar-filled:after' => 'border-color: {{VALUE}}',
				),
				'condition' => array(
					'progressbar_style' => array( 'style_2' ),
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
				'label'   => esc_html__( 'In Animation Effect', 'tpebl' ),
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
	 * @version 5.4.2
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$animation_effects = ! empty( $settings['animation_effects'] ) ? $settings['animation_effects'] : '';
		$animation_delay   = ! empty( $settings['animation_delay']['size'] ) ? $settings['animation_delay']['size'] : 50;
		$ani_duration      = ! empty( $settings['animation_duration_default'] ) ? $settings['animation_duration_default'] : '';
		$animate_duration  = ! empty( $settings['animate_duration']['size'] ) ? $settings['animate_duration']['size'] : 50;
		$out_effect        = ! empty( $settings['animation_out_effects'] ) ? $settings['animation_out_effects'] : '';
		$out_delay         = ! empty( $settings['animation_out_delay']['size'] ) ? $settings['animation_out_delay']['size'] : 50;
		$out_duration      = ! empty( $settings['animation_out_duration_default'] ) ? $settings['animation_out_duration_default'] : '';
		$out_speed         = ! empty( $settings['animation_out_duration']['size'] ) ? $settings['animation_out_duration']['size'] : 50;
		$progress_width    = ! empty( $settings['value_width']['size'] ) ? $settings['value_width']['size'] . '%' : '59%';

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

		$main_style       = ! empty( $settings['main_style'] ) ? $settings['main_style'] : '';
		$pie_chart_style  = ! empty( $settings['pie_chart_style'] ) ? $settings['pie_chart_style'] : '';
		$pie_border_style = ! empty( $settings['pie_border_style'] ) ? $settings['pie_border_style'] : '';
		$pie_empty_color  = ! empty( $settings['pie_empty_color'] ) ? $settings['pie_empty_color'] : '#8072fc';

		$progress_empty_color = ! empty( $settings['progress_empty_color'] ) ? $settings['progress_empty_color'] : '#8072fc';
		$progressbar_style    = ! empty( $settings['progressbar_style'] ) ? $settings['progressbar_style'] : '';
		$progress_bar_size    = ! empty( $settings['progress_bar_size'] ) ? $settings['progress_bar_size'] : '';

		$pie_size   = ! empty( $settings['pie_size']['size'] ) ? $settings['pie_size']['size'] : 200;
		$title      = ! empty( $settings['title'] ) ? $settings['title'] : '';
		$subtitle   = ! empty( $settings['sub_title'] ) ? $settings['sub_title'] : '';
		$image_icon = ! empty( $settings['image_icon'] ) ? $settings['image_icon'] : '';
		$select_img = ! empty( $settings['select_image']['url'] ) ? $settings['select_image']['url'] : '';
		$select_id  = ! empty( $settings['select_image']['id'] ) ? $settings['select_image']['id'] : '';
		$icon_type  = ! empty( $settings['type'] ) ? $settings['type'] : '';
		$icon_p     = ! empty( $settings['icon_postition'] ) ? $settings['icon_postition'] : '';
		$sym_pois   = ! empty( $settings['symbol_position'] ) ? $settings['symbol_position'] : '';
		$num        = ! empty( $settings['number'] ) ? $settings['number'] : '';
		$pi_fill    = ! empty( $settings['pie_fill'] ) ? $settings['pie_fill'] : '';

		$title_content = '';

		if ( ! empty( $title ) ) {
			$title_content = '<span class="progress_bar-title"> ' . esc_html( $title ) . ' </span>';
		}

		$subtitle_content = '';

		if ( ! empty( $subtitle ) ) {
			$subtitle_content = '<div class="progress_bar-sub_title"> ' . esc_html( $subtitle ) . ' </div>';

		}

		if ( ! empty( $pie_size ) ) {
			$inner_width  = ' style="';
			$inner_width .= 'width: ' . esc_attr( $pie_size ) . 'px;';
			$inner_width .= 'height: ' . esc_attr( $pie_size ) . 'px;';
			$inner_width .= '"';
		}

		$progress_bar_img = '';

		if ( 'image' === $image_icon && ! empty( $select_img ) ) {
			$image_id = $select_id;
			$img_src  = tp_get_image_rander( $image_id, $settings['select_image_thumbnail_size'], array( 'class' => 'progress_bar-img' ) );

			$progress_bar_img = '<span class="progres-ims">' . $img_src . '</span>';
		}

		if ( 'icon' === $image_icon ) {
			if ( 'font_awesome' === $icon_type ) {
				$icons = $settings['icon_fontawesome'];
			} else {
				$icons = '';
			}

			$progress_bar_img = '<span class="progres-ims"><i class=" ' . esc_attr( $icons ) . '"></i></span>';
		}

		if ( 'after' === $icon_p ) {
			$icon_text = $title_content . $progress_bar_img . $subtitle_content;
		} else {
			$icon_text = $progress_bar_img . $title_content . $subtitle_content;
		}

		$sym = ! empty( $settings['symbol'] ) ? $settings['symbol'] : '';

		if ( ! empty( $sym ) ) {
			if ( 'after' === $sym_pois ) {
				$symbol2 = '<span class="theserivce-milestone-number icon-milestone" data-counterup-nums="' . esc_attr( $num ) . '">' . esc_html( $num ) . '</span><span class="theserivce-milestone-symbol">' . esc_html( $sym ) . '</span>';
			} elseif ( 'before' === $sym_pois ) {
				$symbol2 = '<span class="theserivce-milestone-symbol">' . esc_html( $sym ) . '</span><span class="theserivce-milestone-number" data-counterup-nums="' . esc_attr( $num ) . '">' . esc_html( $num ) . '</span>';
			}
		} else {
			$symbol2 = '<span class="theserivce-milestone-number icon-milestone" data-counterup-nums="' . esc_attr( $num ) . '">' . esc_html( $num ) . '</span>';
		}

		if ( 'gradient' === $pi_fill ) {
			$data_fill_color = ' data-fill="{&quot;gradient&quot;: [&quot;' . sanitize_hex_color( $settings['pie_fill_gradient_color1'] ) . '&quot;,&quot;' . sanitize_hex_color( $settings['pie_fill_gradient_color2'] ) . '&quot;]}" ';
		} else {
			$data_fill_color = ' data-fill="{&quot;color&quot;: &quot;' . sanitize_hex_color( $settings['pie_fill_classic'] ) . '&quot;}" ';
		}

		if ( 'pie_chart' === $main_style ) {

			if ( 'style_1' === $pie_chart_style ) {
				if ( ! empty( $symbol2 ) ) {
					$number_markup = '<h5 class="counter-number">' . $progress_bar_img . $symbol2 . '</h5>';
				}
			} elseif ( ! empty( $symbol2 ) ) {
					$number_markup = '<h5 class="counter-number">' . $symbol2 . '</h5>';
			}
		} elseif ( ! empty( $symbol2 ) ) {
				$number_markup = '<h5 class="counter-number">' . $symbol2 . '</h5>';
		}

		$pie_border_after = '';

		if ( 'style_2' === $pie_border_style ) {
			$pie_border_after = 'pie_border_after';
			$pie_empty_color1 = 'transparent';
		} else {
			$pie_empty_color1 = $pie_empty_color;
		}

		$uid = uniqid( 'progress_bar' );

		$progress_bar = '<div class="progress_bar pt-plus-peicharts progress-skill-bar ' . esc_attr( $uid ) . ' progress_bar-' . esc_attr( $main_style ) . ' ' . esc_attr( $animated_class ) . '" ' . $animation_attr . ' data-empty="' . esc_attr( $pie_empty_color ) . '" data-uid="' . esc_attr( $uid ) . '" >';

		if ( 'progressbar' === $main_style ) {
			$icon_bg = tp_bg_lazyLoad( $settings['progress_filled_color_image'] );

			if ( 'style_1' === $progressbar_style ) {
				if ( 'large' !== $progress_bar_size ) {
					$progress_bar .= '<div class="progress_bar-media">';

						$progress_bar .= '<div class="prog-title prog-icon">';

							$progress_bar .= $icon_text;

						$progress_bar .= '</div>';

						$progress_bar .= $number_markup;

					$progress_bar .= '</div>';

					$progress_bar     .= '<div class="progress_bar-skill skill-fill ' . esc_attr( $progress_bar_size ) . '" style="background-color:' . esc_attr( $progress_empty_color ) . '">';
						$progress_bar .= '<div class="progress_bar-skill-bar-filled ' . $icon_bg . '" data-width="' . esc_attr( $progress_width ) . '">	</div>';
					$progress_bar     .= '</div>';
				} else {
					$progress_bar .= '<div class="progress_bar-skill skill-fill ' . esc_attr( $progress_bar_size ) . '" style="background-color:' . esc_attr( $progress_empty_color ) . '" >';

						$progress_bar .= '<div class="progress_bar-skill-bar-filled ' . $icon_bg . '" data-width="' . esc_attr( $progress_width ) . '">	</div>';

						$progress_bar .= '<div class="progress_bar-media ' . esc_attr( $progress_bar_size ) . ' ">';

							$progress_bar .= '<div class="prog-title prog-icon ' . esc_attr( $progress_bar_size ) . '">';

								$progress_bar .= $progress_bar_img . $title_content;

							$progress_bar .= '</div>';

							$progress_bar .= $number_markup;

						$progress_bar .= '</div>';

					$progress_bar .= '</div>';
				}
			} elseif ( 'style_2' === $progressbar_style ) {
				$progress_bar .= '<div class="progress_bar-media">';

					$progress_bar .= '<div class="prog-title prog-icon">';

						$progress_bar .= $icon_text;

					$progress_bar .= '</div>';

					$progress_bar .= $number_markup;

				$progress_bar .= '</div>';

				$progress_bar .= '<div class="progress_bar-skill skill-fill progress-' . esc_attr( $progressbar_style ) . '" style="background-color:' . esc_attr( $progress_empty_color ) . '">';

					$progress_bar .= '<div class="progress_bar-skill-bar-filled ' . $icon_bg . '"  data-width="' . esc_attr( $progress_width ) . '">	</div>';

				$progress_bar .= '</div>';
			}
		}

		if ( ! empty( $settings['data_empty_fill'] ) ) {
			$data_empty_fill = sanitize_hex_color( $settings['data_empty_fill'] );
		} else {
			$data_empty_fill = 'transparent';
		}

		$pie_size     = ! empty( $settings['pie_value']['size'] ) ? $settings['pie_value']['size'] : '';
		$pie_val      = ! empty( $settings['pie_size']['size'] ) ? $settings['pie_size']['size'] : '';
		$pie_thikness = ! empty( $settings['pie_thickness']['size'] ) ? $settings['pie_thickness']['size'] : '';

		if ( 'pie_chart' === $main_style ) {
				$progress_bar .= '<div class="pt-plus-piechart ' . esc_attr( $pie_border_after ) . ' pie-' . esc_attr( $pie_chart_style ) . '"  ' . $data_fill_color . ' data-emptyfill="' . $data_empty_fill . '" data-value="' . esc_attr( $pie_size ) . '"  data-size="' . esc_attr( $pie_val ) . '" data-thickness="' . esc_attr( $pie_thikness ) . '"  data-animation-start-value="0"  data-reverse="false">';

				$progress_bar .= '<div class="pt-plus-circle" ' . $inner_width . '>';

				$progress_bar .= '<div class="pianumber-css" >';

			if ( 'style_3' !== $pie_chart_style ) {
				$progress_bar .= $number_markup;
			} else {
				$progress_bar .= $progress_bar_img;
			}

			$progress_bar .= '</div>';
			$progress_bar .= '</div>';
			$progress_bar .= '</div>';

			if ( 'style_1' === $pie_chart_style ) {
				$progress_bar .= '<div class="pt-plus-pie_chart" >';

					$progress_bar .= $title_content;
					$progress_bar .= $subtitle_content;

				$progress_bar .= '</div>';
			} elseif ( 'style_2' === $pie_chart_style ) {
				$progress_bar .= '<div class="pt-plus-pie_chart style-2" >';

				$progress_bar .= '<div class="pie_chart " >';

				if ( 'before' === $icon_p ) {
					$progress_bar .= '<div class="pie_chart " >';

						$progress_bar .= $progress_bar_img;

					$progress_bar .= '</div>';
				}

					$progress_bar .= '<div class="pie_chart-style2">';

						$progress_bar .= $title_content;
						$progress_bar .= $subtitle_content;

					$progress_bar .= '</div>';

				if ( 'after' === $icon_p ) {
					$progress_bar .= '<div class="pie_chart " >';

						$progress_bar .= $progress_bar_img;

					$progress_bar .= '</div >';
				}

				$progress_bar .= '</div>';

				$progress_bar .= '</div>';
			} elseif ( 'style_3' === $pie_chart_style ) {
				$progress_bar .= '<div class="pt-plus-pie_chart style-3">';

					$progress_bar .= '<div class="pie_chart " >';

					$progress_bar .= $number_markup;

					$progress_bar .= '</div >';
					$progress_bar .= '<div class="pie_chart-style3">';
					$progress_bar .= $title_content;
					$progress_bar .= $subtitle_content;
					$progress_bar .= '</div>';

				$progress_bar .= '</div>';
			}
		}
			$progress_bar    .= '</div>';
			$inline_js_script = '( function ( $ ) { 
			"use strict";
			$( document ).ready(function() {
				var elements = document.querySelectorAll(".pt-plus-piechart");
				Array.prototype.slice.apply(elements).forEach(function(el) {
					var $el = jQuery(el);
					//$el.circleProgress({value: 0});
					new Waypoint({
						element: el,
						handler: function() {
							if(!$el.hasClass("done-progress")){
							setTimeout(function(){
								$el.circleProgress({
									value: $el.data("value"),
									emptyFill: $el.data("emptyfill"),
									startAngle: -Math.PI/4*2,
								});
								//  this.destroy();
							}, 800);
							$el.addClass("done-progress");
							}
						},
						offset: "80%"
					});
				});
			});
			$(window).on("load resize scroll", function(){
				$(".pt-plus-peicharts").each( function(){
					var height=$("canvas",this).outerHeight();
					var width=$("canvas",this).outerWidth();
					$(".pt-plus-circle",this).css("height",height+"px");
					$(".pt-plus-circle",this).css("width",width+"px");
				});
			});
		} ( jQuery ) );';

		$progress_bar .= wp_print_inline_script_tag( $inline_js_script );

		echo $progress_bar;
	}
}