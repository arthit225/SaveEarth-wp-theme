<?php
/**
 * Widget Name: Process/Steps
 * Description: Process/Steps
 * Author: Theplus
 * Author URI: https://posimyth.com
 *
 * @package tpebl
 */

namespace TheplusAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use TheplusAddons\L_Theplus_Element_Load;
use Elementor\Group_Control_Image_Size;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class L_ThePlus_Tp_Shape_Divider.
 */
class L_ThePlus_Process_Steps extends Widget_Base {

	/**
	 * Get Widget Name.
	 *
	 * @since 3.0.0
	 * @version 5.4.2
	 */
	public function get_name() {
		return 'tp-process-steps';
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
	 * @since 3.0.0
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Process/Steps', 'tpebl' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 3.0.0
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-ellipsis-h theplus_backend_icon';
	}

	/**
	 * Get Widget Categories.
	 *
	 * @since 3.0.0
	 * @version 5.4.2
	 */
	public function get_categories() {
		return array( 'plus-creatives' );
	}

	/**
	 * Get Widget Keywords.
	 *
	 * @since 3.0.0
	 * @version 5.4.2
	 */
	public function get_keywords() {
		return array( 'Process', 'Steps', 'Procedure', 'Method', 'Workflow', 'Sequence', 'Order', 'Stages', 'Phases', 'Actions', 'Tasks', 'Activities', 'Operation', 'Protocol', 'Technique', 'Approach', 'System', 'Plan', 'Strategy', 'Path', 'Route', 'Formula', 'Algorithm', 'Blueprint', 'Roadmap' );
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
	 * @since 3.0.0
	 * @version 5.4.2
	 */
	protected function register_controls() {

		/** Process Steps Content Section Start*/
		$this->start_controls_section(
			'section_process_steps',
			array(
				'label' => esc_html__( 'Process/Steps', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'ps_style',
			array(
				'label'   => esc_html__( 'Style', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style_1',
				'options' => array(
					'style_1' => esc_html__( 'Vertical', 'tpebl' ),
					'style_2' => esc_html__( 'Horizontal', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'pro_ste_display_counter',
			array(
				'label'     => esc_html__( 'Display Counter', 'tpebl' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'pro_ste_display_counter_style',
			array(
				'label'     => esc_html__( 'Counter Style', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'number-normal',
				'options'   => array(
					'number-normal'        => esc_html__( 'Normal', 'tpebl' ),
					'decimal-leading-zero' => esc_html__( 'Decimal Leading Zero', 'tpebl' ),
					'upper-alpha'          => esc_html__( 'Upper Alpha', 'tpebl' ),
					'lower-alpha'          => esc_html__( 'Lower Alpha', 'tpebl' ),
					'lower-roman'          => esc_html__( 'Lower Roman', 'tpebl' ),
					'upper-roman'          => esc_html__( 'Upper Roman', 'tpebl' ),
					'lower-greek'          => esc_html__( 'Lower Greek', 'tpebl' ),
					'custom-text'          => esc_html__( 'Custom Text', 'tpebl' ),
				),
				'condition' => array(
					'pro_ste_display_counter' => 'yes',
				),
			)
		);
		$this->add_control(
			'pro_ste_display_special_bg',
			array(
				'label'     => esc_html__( 'Special Background', 'tpebl' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'pro_ste_display_info_box',
			array(
				'label'     => esc_html__( 'Normal Layout In Mobile', 'tpebl' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'default'   => 'no',
				'separator' => 'before',
				'condition' => array(
					'ps_style' => 'style_2',
				),
			)
		);
		$this->add_responsive_control(
			'img_st2_align',
			array(
				'label'     => esc_html__( 'Circle Alignment', 'tpebl' ),
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
				'default'   => 'center',
				'selectors' => array(
					'{{WRAPPER}} .tp-process-steps-widget.style_2.mobile .tp-process-steps-wrapper .tp-ps-left-imt' => 'justify-content: {{VALUE}};',
				),
				'condition' => array(
					'ps_style'                 => 'style_2',
					'pro_ste_display_info_box' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'content_st2_align',
			array(
				'label'     => esc_html__( 'Content Alignment', 'tpebl' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
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
				'default'   => 'center',
				'condition' => array(
					'ps_style'                 => 'style_2',
					'pro_ste_display_info_box' => 'yes',
				),
				'selectors' => array(
					'{{WRAPPER}} .tp-process-steps-widget.style_2.mobile .tp-process-steps-wrapper .tp-ps-right-content' => 'text-align: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'default_active',
			array(
				'label'   => esc_html__( 'Default Active', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '0',
				'options' => array(
					'0'      => esc_html__( '1', 'tpebl' ),
					'1'      => esc_html__( '2', 'tpebl' ),
					'2'      => esc_html__( '3', 'tpebl' ),
					'3'      => esc_html__( '4', 'tpebl' ),
					'4'      => esc_html__( '5', 'tpebl' ),
					'5'      => esc_html__( '6', 'tpebl' ),
					'6'      => esc_html__( '7', 'tpebl' ),
					'7'      => esc_html__( '8', 'tpebl' ),
					'8'      => esc_html__( '9', 'tpebl' ),
					'9'      => esc_html__( '10', 'tpebl' ),
					'50'     => esc_html__( 'None', 'tpebl' ),
					'custom' => esc_html__( 'Custom', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'default_active_custom',
			array(
				'label'     => esc_html__( 'Custom', 'tpebl' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 100,
				'step'      => 1,
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'default_active' => 'custom',
				),
			)
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'loop_title',
			array(
				'label'   => esc_html__( 'Title', 'tpebl' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'The Plus', 'tpebl' ),
				'dynamic' => array( 'active' => true ),
			)
		);
		$repeater->add_control(
			'loop_content_desc',
			array(
				'label'   => esc_html__( 'Description', 'tpebl' ),
				'type'    => Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'tpebl' ),
			)
		);
		$repeater->add_control(
			'loop_image_icon',
			array(
				'label'       => esc_html__( 'Select Icon', 'tpebl' ),
				'type'        => Controls_Manager::SELECT,
				'description' => esc_html__( 'You can select Icon, Custom Image or Text using this option.', 'tpebl' ),
				'default'     => 'icon',
				'separator'   => 'before',
				'options'     => array(
					''       => esc_html__( 'None', 'tpebl' ),
					'icon'   => esc_html__( 'Icon', 'tpebl' ),
					'image'  => esc_html__( 'Image', 'tpebl' ),
					'text'   => esc_html__( 'Text', 'tpebl' ),
					'lottie' => esc_html__( 'Lottie', 'tpebl' ),
				),
			)
		);
		$repeater->add_control(
			'lottieUrl',
			array(
				'label'       => esc_html__( 'Lottie URL', 'tpebl' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://www.demo-link.com', 'tpebl' ),
				'condition'   => array(
					'loop_image_icon' => 'lottie',
				),
			)
		);
		$repeater->add_responsive_control(
			'lottieWidth',
			array(
				'label'     => esc_html__( 'Lottie Width', 'tpebl' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 1,
						'max'  => 700,
						'step' => 1,
					),
				),
				'default'   => array(
					'unit' => 'px',
					'size' => 40,
				),
				'condition' => array(
					'loop_image_icon' => 'lottie',
				),
			)
		);
		$repeater->add_responsive_control(
			'lottieHeight',
			array(
				'label'     => esc_html__( 'Lottie Height', 'tpebl' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 1,
						'max'  => 700,
						'step' => 1,
					),
				),
				'default'   => array(
					'unit' => 'px',
					'size' => 40,
				),
				'condition' => array(
					'loop_image_icon' => 'lottie',
				),
			)
		);
		$repeater->add_control(
			'loop_select_image',
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
					'loop_image_icon' => 'image',
				),
			)
		);
		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'thumbnail',
				'default'   => 'full',
				'separator' => 'after',
				'exclude'   => array( 'custom' ),
				'condition' => array(
					'loop_image_icon' => 'image',
				),
			)
		);
		$repeater->add_control(
			'loop_icon_style',
			array(
				'label'     => esc_html__( 'Icon Font', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'font_awesome',
				'options'   => array(
					'font_awesome' => esc_html__( 'Font Awesome', 'tpebl' ),
					'icon_mind'    => esc_html__( 'Icons Mind ( PRO )', 'tpebl' ),
				),
				'condition' => array(
					'loop_image_icon' => 'icon',
				),
			)
		);
		$repeater->add_control(
			'loop_icon_fontawesome',
			array(
				'label'     => esc_html__( 'Icon Library', 'tpebl' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-star',
					'library' => 'solid',
				),
				'condition' => array(
					'loop_image_icon' => 'icon',
					'loop_icon_style' => 'font_awesome',
				),
			)
		);
		$repeater->add_control(
			'icons_mind_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'loop_icon_style' => 'icon_mind',
				),
			)
		);
		$repeater->add_control(
			'loop_select_text',
			array(
				'label'     => esc_html__( 'Text', 'tpebl' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'The Plus', 'tpebl' ),
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'loop_image_icon' => 'text',
				),
			)
		);
		$repeater->add_control(
			'loop_icn_link',
			array(
				'label'     => esc_html__( 'Icon Link', 'tpebl' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'default'   => 'no',
			)
		);
		$repeater->add_control(
			'loop_url_link',
			array(
				'label'         => esc_html__( 'Link', 'tpebl' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_html__( 'https://your-link.com', 'tpebl' ),
				'show_external' => true,
				'default'       => array(
					'url' => '',
				),
				'separator'     => 'before',
				'dynamic'       => array(
					'active' => true,
				),
			)
		);
		$repeater->add_control(
			'sep_pre_ste_background_n_head',
			array(
				'label'     => 'Normal Background Option',
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$repeater->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'sep_pre_ste_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper{{CURRENT_ITEM}} .tp-ps-left-imt .tp-ps-icon-img',
			)
		);
		$repeater->add_control(
			'sep_pre_ste_background_h_head',
			array(
				'label'     => 'Hover Background Option',
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$repeater->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'sep_pre_ste_background_h',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper:hover{{CURRENT_ITEM}} .tp-ps-left-imt .tp-ps-icon-img,
				{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper.active{{CURRENT_ITEM}} .tp-ps-left-imt .tp-ps-icon-img',
			)
		);
		$repeater->add_control(
			'dis_counter_custom_text_head',
			array(
				'label'     => 'Display Counter Custom Text',
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$repeater->add_control(
			'dis_counter_custom_text',
			array(
				'label'   => esc_html__( 'Custom Text', 'tpebl' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Step', 'tpebl' ),
				'dynamic' => array( 'active' => true ),
			)
		);
		$this->add_control(
			'loop_content',
			array(
				'label'       => esc_html__( 'Process/Steps', 'tpebl' ),
				'type'        => Controls_Manager::REPEATER,
				'default'     => array(
					array(
						'loop_title' => 'The Plus 1',
					),
					array(
						'loop_title' => 'The Plus 2',
					),
					array(
						'loop_title' => 'The Plus 3',
					),
				),
				'separator'   => 'before',
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ loop_title }}}',
			)
		);
		$this->add_control(
			'connection_switch',
			array(
				'label'     => esc_html__( 'Carousel Anything Connection', 'tpebl' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'carousel_pro_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'connection_switch' => 'yes',
				),
			)
		);
		$this->end_controls_section();

		/** Style Section Start*/
		/** Title Style Start*/
		$this->start_controls_section(
			'section_title_styling',
			array(
				'label' => esc_html__( 'Title Style', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'heading_tag',
			array(
				'type'    => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Tag', 'tpebl' ),
				'default' => 'h6',
				'options' => array(
					'h1' => esc_html__( 'H1', 'tpebl' ),
					'h2' => esc_html__( 'H2', 'tpebl' ),
					'h3' => esc_html__( 'H3', 'tpebl' ),
					'h4' => esc_html__( 'H4', 'tpebl' ),
					'h5' => esc_html__( 'H5', 'tpebl' ),
					'h6' => esc_html__( 'H6', 'tpebl' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper .tp-ps-content .tp-pro-step-title',
			)
		);
		$this->add_control(
			'title_text_color_n',
			array(
				'label'     => esc_html__( 'Text Color Normal', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper .tp-ps-content .tp-pro-step-title' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'title_text_color_h',
			array(
				'label'     => esc_html__( 'Text Color Hover', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper:hover .tp-ps-content .tp-pro-step-title,
					{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper.active .tp-ps-content .tp-pro-step-title' => 'color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_section();

		/** Description Style Start*/
		$this->start_controls_section(
			'section_description_styling',
			array(
				'label' => esc_html__( 'Description Style', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'description_margin',
			array(
				'label'      => esc_html__( 'Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-process-steps-widget .tp-pro-step-desc, .tp-process-steps-widget.style_1 .tp-pro-step-desc p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'description_typography',
				'selector' => '{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper .tp-ps-content .tp-pro-step-desc,{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper .tp-ps-content .tp-pro-step-desc p,
				{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper .tp-ps-content .tp-pro-step-desc span',
			)
		);
		$this->add_control(
			'title_description_color_n',
			array(
				'label'     => esc_html__( 'Description Color Normal', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper .tp-ps-content .tp-pro-step-desc,{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper .tp-ps-content .tp-pro-step-desc p' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'title_description_color_h',
			array(
				'label'     => esc_html__( 'Description Color Hover', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper:hover .tp-ps-content .tp-pro-step-desc,
					{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper.active .tp-ps-content .tp-pro-step-desc,{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper:hover .tp-ps-content .tp-pro-step-desc p,
					{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper.active .tp-ps-content .tp-pro-step-desc p' => 'color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_section();

		/** Icon/Image Style Start*/
		$this->start_controls_section(
			'section_icon_image_styling',
			array(
				'label' => esc_html__( 'Icon/Image Style', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'tab_icon_heading',
			array(
				'label' => esc_html__( 'Icon Options', 'tpebl' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			)
		);
		$this->add_responsive_control(
			'tab_icon_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Size', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 500,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-process-steps-widget .tp-ps-icon-img i' => 'font-size:{{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .tp-process-steps-widget .tp-ps-icon-img svg' => 'width: {{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_tab_icon' );
		$this->start_controls_tab(
			'tab_tab_icon_n',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'tab_icon_color_n',
			array(
				'label'     => esc_html__( 'Icon Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper .tp-ps-icon-img i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper .tp-ps-icon-img svg' => 'fill: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_tab_icon_h',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'tab_icon_color_h',
			array(
				'label'     => esc_html__( 'Icon Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper:hover .tp-ps-icon-img i,
					{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper.active .tp-ps-icon-img i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper:hover .tp-ps-icon-img svg,
					{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper.active .tp-ps-icon-img svg' => 'fill: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'tab_image_heading',
			array(
				'label'     => esc_html__( 'Image Options', 'tpebl' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'tab_image_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Image Size', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 500,
						'step' => 1,
					),
				),
				'separator'   => 'after',
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper .tp-ps-icon-img .tp-icon-img' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
			'tab_image_border_radius_n',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-ps-icon-img.tp-pro-step-icon-img .tp-icon-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'tab_text_heading',
			array(
				'label'     => esc_html__( 'Text Options', 'tpebl' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'tab_text_typography',
				'label'    => esc_html__( 'Typography', 'tpebl' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper .tp-ps-icon-img .tp-ps-text',
			)
		);
		$this->start_controls_tabs( 'tabs_tab_text' );
		$this->start_controls_tab(
			'tab_tab_text_n',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'tab_text_color_n',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper .tp-ps-icon-img .tp-ps-text' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_tab_text_h',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'tab_text_color_h',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper:hover .tp-ps-icon-img .tp-ps-text,
					{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper.active .tp-ps-icon-img .tp-ps-text' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'tab_bg_heading',
			array(
				'label'     => esc_html__( 'Background Options', 'tpebl' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'tab_bg_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Background Size', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 10,
						'max'  => 500,
						'step' => 2,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 90,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper .tp-ps-icon-img' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .tp-process-steps-widget .tp-ps-left-imt .tp-ps-special-bg:after' => 'width: calc({{SIZE}}{{UNIT}} + 20px);height:calc({{SIZE}}{{UNIT}} + 20px);',
					'{{WRAPPER}} .tp-process-steps-widget .tp-ps-left-imt .tp-ps-special-bg:before' => 'width: calc({{SIZE}}{{UNIT}} + 40px);height:calc({{SIZE}}{{UNIT}} + 40px);',
					'{{WRAPPER}} .tp-process-steps-widget.style_1 .tp-process-steps-wrapper .tp-ps-left-imt:after,
					{{WRAPPER}} .tp-process-steps-widget.style_2 .tp-process-steps-wrapper .tp-ps-left-imt:after' => 'left:calc(({{SIZE}}{{UNIT}} /2 ) - ({{seprator_border_width_n.SIZE}}px));',
					'{{WRAPPER}} .tp-process-steps-widget.style_1 .tp-process-steps-wrapper .tp-ps-left-imt' => 'margin-right: calc(({{SIZE}}{{UNIT}}/1.3));',
					'{{WRAPPER}} .tp-process-steps-widget.style_1 .tp-process-steps-wrapper .tp-ps-right-content' => 'width: calc((100% - ({{SIZE}}{{UNIT}} * 2)));',
				),
			)
		);
		$this->add_responsive_control(
			'pro_ste_minimum_height',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Minimum Height of Content', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 150,
				),
				'separator'   => 'before',
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-process-steps-widget.style_1 .tp-process-steps-wrapper,{{WRAPPER}} .tp-process-steps-widget.style_1 .tp-process-steps-wrapper .tp-ps-left-imt:after,{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper' => 'min-height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .tp-process-steps-widget.style_2.mobile .tp-process-steps-wrapper,{{WRAPPER}} .tp-process-steps-widget.style_2.mobile .tp-process-steps-wrapper .tp-ps-left-imt:after' => 'min-width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_tab_bg' );
		$this->start_controls_tab(
			'tab_tab_bg_n',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'tab_bg_background_n',
				'label'    => esc_html__( 'Background', 'tpebl' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper .tp-ps-icon-img',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'tab_bg_border_n',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper .tp-ps-icon-img',
			)
		);
		$this->add_responsive_control(
			'tab_bg_border_radius_n',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper .tp-ps-icon-img:first-child,
					{{WRAPPER}} .tp-process-steps-widget .tp-ps-left-imt .tp-ps-special-bg:before,
					{{WRAPPER}} .tp-process-steps-widget .tp-ps-left-imt .tp-ps-special-bg:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'tab_bg__shadow_n',
				'selector' => '{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper .tp-ps-icon-img:first-child,
				{{WRAPPER}} .tp-process-steps-widget .tp-ps-left-imt .tp-ps-special-bg:before,
					{{WRAPPER}} .tp-process-steps-widget .tp-ps-left-imt .tp-ps-special-bg:after',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_tab_bg_h',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'tab_bg_background_h',
				'label'    => esc_html__( 'Background', 'tpebl' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper:hover .tp-ps-icon-img,
				{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper.active .tp-ps-icon-img',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'tab_bg_border_h',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper:hover .tp-ps-icon-img,
				{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper.active .tp-ps-icon-img',
			)
		);
		$this->add_responsive_control(
			'tab_bg_border_radius_h',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper:hover .tp-ps-icon-img:first-child,
					{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper:hover .tp-ps-left-imt .tp-ps-special-bg:before,
					{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper:hover .tp-ps-left-imt .tp-ps-special-bg:after,
					{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper.active .tp-ps-icon-img:first-child,
					{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper.active .tp-ps-left-imt .tp-ps-special-bg:before,
					{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper.active .tp-ps-left-imt .tp-ps-special-bg:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'tab_bg__shadow_h',
				'selector' => '{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper:hover .tp-ps-icon-img:first-child,
				{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper:hover .tp-ps-left-imt .tp-ps-special-bg:before,
					{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper:hover .tp-ps-left-imt .tp-ps-special-bg:after,
					{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper.active .tp-ps-icon-img:first-child,
				{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper.active .tp-ps-left-imt .tp-ps-special-bg:before,
					{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper.active .tp-ps-left-imt .tp-ps-special-bg:after',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->start_controls_tabs( 'tabs_transform' );
		$this->start_controls_tab(
			'tab_transform',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'transform_n',
			array(
				'label'       => esc_html__( 'Transform CSS', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'rotate(10deg) scale(1.1)', 'tpebl' ),
				'selectors'   => array(
					'{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper .tp-ps-icon-img .tp-ps-text,
					{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper .tp-ps-icon-img .tp-icon-img,
					{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper .tp-ps-icon-img i' => 'transform: {{VALUE}};-ms-transform: {{VALUE}};-moz-transform: {{VALUE}};-webkit-transform: {{VALUE}};transform-style: preserve-3d;-ms-transform-style: preserve-3d;-moz-transform-style: preserve-3d;-webkit-transform-style: preserve-3d;-webkit-transition: all .3s ease-in-out;
					-moz-transition: all .3s ease-in-out;-o-transition: all .3s ease-in-out;transition: all .3s ease-in-out;',
				),
			)
		);
		$this->add_control(
			'overlay_color_n',
			array(
				'label'     => esc_html__( 'Overlay Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-process-steps-wrapper .tp-ps-left-imt .tp-ps-icon-img' => 'box-shadow: {{VALUE}} 0 0 0 100px inset;',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_transform_h',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'transform_h',
			array(
				'label'       => esc_html__( 'Transform CSS', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'rotate(10deg) scale(1.1)', 'tpebl' ),
				'selectors'   => array(
					'{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper:hover .tp-ps-icon-img .tp-ps-text,
					{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper:hover .tp-ps-icon-img .tp-icon-img,
					{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper:hover .tp-ps-icon-img i,
					{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper.active .tp-ps-icon-img .tp-ps-text,
					{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper.active .tp-ps-icon-img .tp-icon-img,
					{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper.active .tp-ps-icon-img i' => 'transform: {{VALUE}};-ms-transform: {{VALUE}};-moz-transform: {{VALUE}};-webkit-transform: {{VALUE}};transform-style: preserve-3d;-ms-transform-style: preserve-3d;-moz-transform-style: preserve-3d;-webkit-transform-style: preserve-3d;',
				),
			)
		);
		$this->add_control(
			'overlay_color_h',
			array(
				'label'     => esc_html__( 'Overlay Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-process-steps-wrapper:hover .tp-ps-left-imt .tp-ps-icon-img,
					{{WRAPPER}} .tp-process-steps-wrapper.active .tp-ps-left-imt .tp-ps-icon-img' => 'box-shadow: {{VALUE}} 0 0 0 100px inset;',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'tab_bg_bf',
			array(
				'label'        => esc_html__( 'Backdrop Filter', 'tpebl' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'tpebl' ),
				'label_on'     => __( 'Custom', 'tpebl' ),
				'return_value' => 'yes',
			)
		);
		$this->add_control(
			'tab_bg_bf_blur',
			array(
				'label'      => esc_html__( 'Blur', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'max'  => 100,
						'min'  => 1,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 10,
				),
				'condition'  => array(
					'tab_bg_bf' => 'yes',
				),
			)
		);
		$this->add_control(
			'tab_bg_bf_grayscale',
			array(
				'label'      => esc_html__( 'Grayscale', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'max'  => 1,
						'min'  => 0,
						'step' => 0.1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 0,
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper .tp-ps-icon-img' => '-webkit-backdrop-filter:grayscale({{tab_bg_bf_grayscale.SIZE}})  blur({{tab_bg_bf_blur.SIZE}}{{tab_bg_bf_blur.UNIT}}) !important;backdrop-filter:grayscale({{tab_bg_bf_grayscale.SIZE}})  blur({{tab_bg_bf_blur.SIZE}}{{tab_bg_bf_blur.UNIT}}) !important;',
				),
				'condition'  => array(
					'tab_bg_bf' => 'yes',
				),
			)
		);
		$this->end_popover();
		$this->end_controls_section();

		/** Lottie Style Start*/
		$this->start_controls_section(
			'section_lottie_styling',
			array(
				'label' => esc_html__( 'Lottie', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'lottieWidth',
			array(
				'label'   => esc_html__( 'Width', 'tpebl' ),
				'type'    => Controls_Manager::SLIDER,
				'range'   => array(
					'px' => array(
						'min'  => 1,
						'max'  => 700,
						'step' => 1,
					),
				),
				'default' => array(
					'unit' => 'px',
					'size' => 40,
				),
			)
		);
		$this->add_responsive_control(
			'lottieHeight',
			array(
				'label'   => esc_html__( 'Height', 'tpebl' ),
				'type'    => Controls_Manager::SLIDER,
				'range'   => array(
					'px' => array(
						'min'  => 1,
						'max'  => 700,
						'step' => 1,
					),
				),
				'default' => array(
					'unit' => 'px',
					'size' => 40,
				),
			)
		);
		$this->add_responsive_control(
			'lottieSpeed',
			array(
				'label'   => esc_html__( 'Speed', 'tpebl' ),
				'type'    => Controls_Manager::SLIDER,
				'range'   => array(
					'px' => array(
						'min'  => 1,
						'max'  => 10,
						'step' => 1,
					),
				),
				'default' => array(
					'unit' => 'px',
					'size' => 1,
				),
			)
		);
		$this->add_control(
			'lottieLoop',
			array(
				'label'     => esc_html__( 'Loop Animation', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'default'   => 'yes',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'lottiehover',
			array(
				'label'     => esc_html__( 'Hover Animation', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->end_controls_section();

		/** Separator/Line Style Start*/
		$this->start_controls_section(
			'section_seprator_styling',
			array(
				'label' => esc_html__( 'Separator/Line Style', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->start_controls_tabs( 'tabs_seprator' );
		$this->start_controls_tab(
			'tab_seprator_n',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'seprator_color_n',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-process-steps-widget.style_1 .tp-process-steps-wrapper .tp-ps-left-imt:after,
					{{WRAPPER}} .tp-process-steps-widget.style_2 .tp-ps-left-imt:before,
					{{WRAPPER}} .tp-process-steps-widget.style_2 .tp-process-steps-wrapper .tp-ps-left-imt:after' => 'border-color:{{VALUE}};',
				),
			)
		);

		$this->add_control(
			'seprator_border_style_n',
			array(
				'label'     => esc_html__( 'Border Type', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'solid',
				'options'   => array(
					'solid'             => esc_html__( 'Solid', 'tpebl' ),
					'dashed'            => esc_html__( 'Dashed', 'tpebl' ),
					'dotted'            => esc_html__( 'Dotted', 'tpebl' ),
					'groove'            => esc_html__( 'Groove', 'tpebl' ),
					'inset'             => esc_html__( 'Inset', 'tpebl' ),
					'outset'            => esc_html__( 'Outset', 'tpebl' ),
					'ridge'             => esc_html__( 'Ridge', 'tpebl' ),
					'border_img_custom' => esc_html__( 'Custom', 'tpebl' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .tp-process-steps-widget.style_1 .tp-process-steps-wrapper .tp-ps-left-imt:after,
{{WRAPPER}} .tp-process-steps-widget.style_2 .tp-ps-left-imt:before,
{{WRAPPER}} .tp-process-steps-widget.style_2 .tp-process-steps-wrapper .tp-ps-left-imt:after' => 'border-style: {{VALUE}};',
				),
			)
		);
		$this->add_responsive_control(
			'seprator_border_width_n',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Border Size', 'tpebl' ),
				'size_units'  => array( 'px', '%' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 1000,
						'step' => 1,
					),
					'%'  => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 1,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-process-steps-widget.style_2 .tp-process-steps-wrapper .tp-ps-left-imt:before,
					{{WRAPPER}} .tp-process-steps-widget.style_1 .tp-process-steps-wrapper .tp-ps-left-imt:after' => 'border-width: {{SIZE}}{{UNIT}} !important;',
				),
				'condition'   => array(
					'seprator_border_style_n!' => 'border_img_custom',
				),
			)
		);
		$this->add_control(
			'seprator_cusom_img',
			array(
				'label'      => esc_html__( 'Separator/Line Image', 'tpebl' ),
				'type'       => Controls_Manager::MEDIA,
				'media_type' => 'image',
				'default'    => array(
					'url' => '',
				),
				'condition'  => array(
					'seprator_border_style_n' => 'border_img_custom',
				),
			)
		);
		$this->add_responsive_control(
			'seprator_main_top_offset',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Separator/Line Offset', 'tpebl' ),
				'size_units'  => array( 'px', '%' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 1000,
						'step' => 1,
					),
					'%'  => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'separator'   => 'after',
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-process-steps-widget.style_1.tp_ps_sep_img .tp-sep-custom-img-inner,
					{{WRAPPER}} .tp-process-steps-widget.style_2.tp_ps_sep_img .tp-sep-custom-img-inner' => 'left: {{SIZE}}{{UNIT}} !important;position:relative;',
				),
				'condition'   => array(
					'seprator_border_style_n' => 'border_img_custom',
				),
			)
		);
		$this->add_responsive_control(
			'seprator_main_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Separator/Line Size', 'tpebl' ),
				'size_units'  => array( 'px', '%' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 1000,
						'step' => 1,
					),
					'%'  => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'separator'   => 'after',
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-process-steps-widget.style_2 .tp-process-steps-wrapper .tp-ps-left-imt:before' => 'width: {{SIZE}}{{UNIT}} !important; right: calc((-{{SIZE}}{{UNIT}} / 2) - 10px)!important;',
					'{{WRAPPER}} .tp-process-steps-widget.style_1.tp_ps_sep_img .tp-sep-custom-img-inner' => 'max-height: {{SIZE}}{{UNIT}} !important;',
				),
				'condition'   => array(
					'ps_style!'                => 'style_1',
					'seprator_border_style_n!' => 'border_img_custom',
				),
			)
		);
		$this->add_responsive_control(
			'seprator_img_height_width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Image Maximum Size', 'tpebl' ),
				'size_units'  => array( 'px', '%' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 1000,
						'step' => 1,
					),
					'%'  => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'separator'   => 'after',
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-process-steps-widget.style_1.tp_ps_sep_img .tp-sep-custom-img-inner' => 'max-height: {{SIZE}}{{UNIT}} !important;',
					'{{WRAPPER}} .tp-process-steps-widget.style_2.tp_ps_sep_img .tp-sep-custom-img-inner' => 'width: {{SIZE}}{{UNIT}} !important;height:auto !important;max-width: {{SIZE}}{{UNIT}} !important;',
				),
				'condition'   => array(
					'seprator_border_style_n' => 'border_img_custom',
				),
			)
		);

		$this->add_responsive_control(
			'seprator_cusom_img_button_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-process-steps-widget.tp_ps_sep_img .tp-process-steps-wrapper .separator_custom_img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'seprator_border_style_n' => 'border_img_custom',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_seprator_h',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'seprator_color_h',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-process-steps-widget.style_1 .tp-process-steps-wrapper:hover .tp-ps-left-imt:after,
					{{WRAPPER}} .tp-process-steps-widget.style_2 .tp-process-steps-wrapper:hover .tp-ps-left-imt:before,
					{{WRAPPER}} .tp-process-steps-widget.style_2 .tp-process-steps-wrapper:hover .tp-ps-left-imt:after,
					{{WRAPPER}} .tp-process-steps-widget.style_1 .tp-process-steps-wrapper.active .tp-ps-left-imt:after,
					{{WRAPPER}} .tp-process-steps-widget.style_2 .tp-process-steps-wrapper.active .tp-ps-left-imt:before,
					{{WRAPPER}} .tp-process-steps-widget.style_2 .tp-process-steps-wrapper.active .tp-ps-left-imt:after' => 'border-color:{{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/** Display Countet Style Start*/
		$this->start_controls_section(
			'section_display_counter_styling',
			array(
				'label'     => esc_html__( 'Display Counter Style', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'pro_ste_display_counter' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'display_counter_padding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-process-steps-widget .tp-ps-left-imt .tp-ps-dc:after' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'pro_ste_display_counter_style' => array( 'custom-text', 'number-normal' ),
				),
				'separator'  => 'after',
			)
		);
		$this->add_responsive_control(
			'display_counter_left_offset',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Left Offset', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => -300,
						'max'  => 300,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-process-steps-widget .tp-ps-left-imt .tp-ps-dc' => 'margin-left: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
			'display_counter_top_offset',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Top Offset', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => -200,
						'max'  => 200,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-process-steps-widget .tp-ps-left-imt .tp-ps-dc' => 'margin-top: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'display_counter_typography',
				'selector'  => '{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper .tp-ps-left-imt .tp-ps-dc:after,
				{{WRAPPER}} .tp-process-steps-wrapper .tp-ps-dc.dc_custom_text .ds_custom_text_label',
				'separator' => 'before',
			)
		);
		$this->start_controls_tabs( 'tabs_display_counter' );
		$this->start_controls_tab(
			'tab_display_counter_n',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'display_counter_color',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper .tp-ps-left-imt .tp-ps-dc:after,
				{{WRAPPER}} .tp-process-steps-wrapper .tp-ps-dc.dc_custom_text .ds_custom_text_label' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'display_counter_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper .tp-ps-left-imt .tp-ps-dc:after,
				{{WRAPPER}} .tp-process-steps-wrapper .tp-ps-dc.dc_custom_text .ds_custom_text_label',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'display_counter_border',
				'label'     => esc_html__( 'Border', 'tpebl' ),
				'selector'  => '{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper .tp-ps-left-imt .tp-ps-dc:after,
				{{WRAPPER}} .tp-process-steps-wrapper .tp-ps-dc.dc_custom_text .ds_custom_text_label',
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'display_counter_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper .tp-ps-left-imt .tp-ps-dc:after,
					{{WRAPPER}} .tp-process-steps-wrapper .tp-ps-dc.dc_custom_text .ds_custom_text_label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'display_counter_shadow',
				'selector' => '{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper .tp-ps-left-imt .tp-ps-dc:after,
				{{WRAPPER}} .tp-process-steps-wrapper .tp-ps-dc.dc_custom_text .ds_custom_text_label',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_display_counter_h',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'display_counter_color_h',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper:hover .tp-ps-left-imt .tp-ps-dc:after,
				{{WRAPPER}} .tp-process-steps-wrapper:hover .tp-ps-dc.dc_custom_text .ds_custom_text_label,
				{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper.active .tp-ps-left-imt .tp-ps-dc:after,
				{{WRAPPER}} .tp-process-steps-wrapper.active .tp-ps-dc.dc_custom_text .ds_custom_text_label' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'display_counter_background_h',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper:hover .tp-ps-left-imt .tp-ps-dc:after,
				{{WRAPPER}} .tp-process-steps-wrapper:hover .tp-ps-dc.dc_custom_text .ds_custom_text_label,
				{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper.active .tp-ps-left-imt .tp-ps-dc:after,
				{{WRAPPER}} .tp-process-steps-wrapper.active .tp-ps-dc.dc_custom_text .ds_custom_text_label',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'display_counter_border_h',
				'label'     => esc_html__( 'Border', 'tpebl' ),
				'selector'  => '{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper:hover .tp-ps-left-imt .tp-ps-dc:after,
				{{WRAPPER}} .tp-process-steps-wrapper:hover .tp-ps-dc.dc_custom_text .ds_custom_text_label,
				{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper.active .tp-ps-left-imt .tp-ps-dc:after,
				{{WRAPPER}} .tp-process-steps-wrapper.active .tp-ps-dc.dc_custom_text .ds_custom_text_label',
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'display_counter_radius_h',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper:hover .tp-ps-left-imt .tp-ps-dc:after,
					{{WRAPPER}} .tp-process-steps-wrapper:hover .tp-ps-dc.dc_custom_text .ds_custom_text_label,
					{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper.active .tp-ps-left-imt .tp-ps-dc:after,
					{{WRAPPER}} .tp-process-steps-wrapper.active .tp-ps-dc.dc_custom_text .ds_custom_text_label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'display_counter_shadow_h',
				'selector' => '{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper:hover .tp-ps-left-imt .tp-ps-dc:after,
				{{WRAPPER}} .tp-process-steps-wrapper:hover .tp-ps-dc.dc_custom_text .ds_custom_text_label,
				{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper.active .tp-ps-left-imt .tp-ps-dc:after,
				{{WRAPPER}} .tp-process-steps-wrapper.active .tp-ps-dc.dc_custom_text .ds_custom_text_label',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/** Content Background Style Start*/
		$this->start_controls_section(
			'section_content_bg_styling',
			array(
				'label' => esc_html__( 'Content Background Style', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'content_bg_padding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper .tp-ps-right-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_responsive_control(
			'content_bg_margin_st2',
			array(
				'label'      => esc_html__( 'Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-process-steps-widget.style_2  .tp-process-steps-wrapper .tp-ps-right-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
				'condition'  => array(
					'ps_style' => 'style_2',
				),
			)
		);
		$this->add_responsive_control(
			'content_bg_margin_right',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Left Content Right Margin', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 300,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-process-steps-widget.style_1 .tp-process-steps-wrapper .tp-ps-left-imt' => 'margin-right: {{SIZE}}{{UNIT}} !important',
				),
				'condition'   => array(
					'ps_style' => 'style_1',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_content_bg' );
		$this->start_controls_tab(
			'tab_content_bg_n',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'content_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper .tp-ps-right-content',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'content_bg_border',
				'label'     => esc_html__( 'Border', 'tpebl' ),
				'selector'  => '{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper .tp-ps-right-content',
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'content_bg_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper .tp-ps-right-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'content_bg_shadow',
				'selector' => '{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper .tp-ps-right-content',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_content_bg_h',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'content_background_h',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper:hover .tp-ps-right-content,
				{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper.active .tp-ps-right-content',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'content_bg_border_h',
				'label'     => esc_html__( 'Border', 'tpebl' ),
				'selector'  => '{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper:hover .tp-ps-right-content,
				{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper.active .tp-ps-right-content',
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'content_bg_radius_h',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper:hover .tp-ps-right-content,
					{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper.active .tp-ps-right-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'content_bg_shadow_h',
				'selector' => '{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper:hover .tp-ps-right-content,
				{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper.active .tp-ps-right-content',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'content_bg_bf',
			array(
				'label'        => esc_html__( 'Backdrop Filter', 'tpebl' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'tpebl' ),
				'label_on'     => __( 'Custom', 'tpebl' ),
				'return_value' => 'yes',
			)
		);
		$this->add_control(
			'content_bg_bf_blur',
			array(
				'label'      => esc_html__( 'Blur', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'max'  => 100,
						'min'  => 1,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 10,
				),
				'condition'  => array(
					'content_bg_bf' => 'yes',
				),
			)
		);
		$this->add_control(
			'content_bg_bf_grayscale',
			array(
				'label'      => esc_html__( 'Grayscale', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'max'  => 1,
						'min'  => 0,
						'step' => 0.1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 0,
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-process-steps-widget .tp-process-steps-wrapper .tp-ps-right-content' => '-webkit-backdrop-filter:grayscale({{content_bg_bf_grayscale.SIZE}})  blur({{content_bg_bf_blur.SIZE}}{{content_bg_bf_blur.UNIT}}) !important;backdrop-filter:grayscale({{content_bg_bf_grayscale.SIZE}})  blur({{content_bg_bf_blur.SIZE}}{{content_bg_bf_blur.UNIT}}) !important;',
				),
				'condition'  => array(
					'content_bg_bf' => 'yes',
				),
			)
		);
		$this->end_popover();
		$this->end_controls_section();

		/** Horizontal bg Style Start*/
		$this->start_controls_section(
			'Horizontal_bg_section',
			array(
				'label'     => esc_html__( 'Horizontal Background', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'ps_style' => 'style_2',
				),
			)
		);
		$this->add_responsive_control(
			'Horizontal_bg_padding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-process-steps-widget.style_2 .tp-process-steps-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'ps_style' => 'style_2',
				),
			)
		);
		$this->add_responsive_control(
			'Horizontal_bg_margin_st22',
			array(
				'label'      => esc_html__( 'Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-process-steps-widget.style_2 .tp-process-steps-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'ps_style' => 'style_2',
				),
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
			'animation_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
			)
		);
		$this->end_controls_section();

		/** Plus Extra*/
		$this->start_controls_section(
			'section_plus_extra_adv',
			array(
				'label' => esc_html__( 'Plus Extras', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_ADVANCED,
			)
		);
		$this->end_controls_section();

	}

	/**
	 * Render Process/Steps.
	 *
	 * @since 3.0.0
	 * @version 5.4.2
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$uid = uniqid( 'proste' );

		$pro_ste_display_counter_style = $settings['pro_ste_display_counter_style'];

		$responsive_class   = '';
		$display_special_bg = '';

		$display_counter_class    = '';
		$seprator_cusom_img_class = '';

		if ( 'number-normal' === $pro_ste_display_counter_style ) {
			$display_counter_class = 'number_normal';
		} elseif ( 'decimal-leading-zero' === $pro_ste_display_counter_style ) {
			$display_counter_class = 'decimal_leading_zero';
		} elseif ( 'upper-alpha' === $pro_ste_display_counter_style ) {
			$display_counter_class = 'upper_alpha';
		} elseif ( 'lower-alpha' === $pro_ste_display_counter_style ) {
			$display_counter_class = 'lower_alpha';
		} elseif ( 'lower-roman' === $pro_ste_display_counter_style ) {
			$display_counter_class = 'lower_roman';
		} elseif ( 'upper-roman' === $pro_ste_display_counter_style ) {
			$display_counter_class = 'upper_roman';
		} elseif ( 'lower-greek' === $pro_ste_display_counter_style ) {
			$display_counter_class = 'lower_greek';
		} elseif ( 'custom-text' === $pro_ste_display_counter_style ) {
			$display_counter_class = 'dc_custom_text';
		}

		if ( ! empty( $settings['seprator_border_style_n'] ) && 'border_img_custom' === $settings['seprator_border_style_n'] ) {
			$seprator_cusom_img_class = 'tp_ps_sep_img';
		}

		if ( ! empty( $settings['pro_ste_display_special_bg'] ) && 'yes' === $settings['pro_ste_display_special_bg'] ) {
			$display_special_bg = 'tp-ps-special-bg';
		}
		$mobile_class = '';
		if ( ! empty( $settings['pro_ste_display_info_box'] ) && 'yes' === $settings['pro_ste_display_info_box'] ) {
			$mobile_class = 'mobile';
		}

		if ( ! empty( $settings['loop_content'] ) ) {
			$output = '<div id="' . esc_attr( $uid ) . '" class="tp-process-steps-widget ' . esc_attr( $settings['ps_style'] ) . ' ' . esc_attr( $seprator_cusom_img_class ) . ' ' . esc_attr( $mobile_class ) . ' ">';
			$index  = 0;

			$loop_content = $settings['loop_content'];
			foreach ( $loop_content as $index => $item ) {
				$ps_count       = $index;
				$on_load_class  = '';
				$default_active = $settings['default_active'];

				if ( ( ! empty( $default_active ) && 'custom' === $default_active ) && ( ! empty( $settings['default_active_custom'] ) && ( $settings['default_active_custom'] - 1 ) === $ps_count ) ) {
					$on_load_class = 'active';
				} elseif ( $default_active == $ps_count && 'custom' !== $default_active ) {
					$on_load_class = 'active';
				}

				$list_img    = '';
				$list_title  = '';
				$title_a_end = '';
				$description = '';

				$title_a_start = '';

				/** Link*/
				if ( ! empty( $item['loop_url_link']['url'] ) ) {
					$this->add_render_attribute( 'loop_box_link' . $index, 'href', esc_url( $item['loop_url_link']['url'] ) );

					if ( $item['loop_url_link']['is_external'] ) {
						$this->add_render_attribute( 'box_link' . $index, 'target', '_blank' );
					}

					if ( $item['loop_url_link']['nofollow'] ) {
						$this->add_render_attribute( 'box_link' . $index, 'rel', 'nofollow' );
					}
				}

				/** Title*/
				if ( ! empty( $item['loop_title'] ) ) {
					if ( ! empty( $item['loop_url_link']['url'] ) ) {
						$title_a_start = '<a ' . $this->get_render_attribute_string( 'loop_box_link' . $index ) . '>';
						$title_a_end   = '</a>';
					}

					$heading_tag = ! empty( $settings['heading_tag'] ) ? $settings['heading_tag'] : 'h6';
					$list_title  = $title_a_start . '<' . L_theplus_validate_html_tag( $heading_tag ) . ' class="tp-pro-step-title">' . wp_kses_post( $item['loop_title'] ) . '</' . L_theplus_validate_html_tag( $heading_tag ) . '>' . $title_a_end;
				}

				/** Description*/
				if ( ! empty( $item['loop_content_desc'] ) ) {
					$description = '<div class="tp-pro-step-desc"> ' . wp_kses_post( $item['loop_content_desc'] ) . ' </div>';
				}

				/** Icon/Image/Text*/
				if ( ! empty( $item['loop_image_icon'] ) ) {
					/** Image*/
					if ( isset( $item['loop_image_icon'] ) && 'image' === $item['loop_image_icon'] ) {
						$loop_img_src1 = '';
						if ( ! empty( $item['loop_select_image']['url'] ) ) {
							$loop_select_image = $item['loop_select_image']['id'];
							$loop_img_src1     = tp_get_image_rander( $loop_select_image, $item['thumbnail_size'], array( 'class' => 'tp-icon-img' ) );
						}

						$list_img = '<div class="tp-ps-icon-img tp-pro-step-icon-img" >' . $loop_img_src1 . '</div>';
					} elseif ( isset( $item['loop_image_icon'] ) && 'text' === $item['loop_image_icon'] ) {
						$list_img = '<span class="tp-ps-text">' . esc_html( $item['loop_select_text'] ) . '</span>';
					} elseif ( isset( $item['loop_image_icon'] ) && 'lottie' === $item['loop_image_icon'] ) {
						$ext = pathinfo( $item['lottieUrl']['url'], PATHINFO_EXTENSION );
						if ( 'json' !== $ext ) {
							$list_img .= '<h3 class="theplus-posts-not-found">' . esc_html__( 'Opps!! Please Enter Only JSON File Extension.', 'tpebl' ) . '</h3>';
						} else {
							$lottie_width = isset( $settings['lottieWidth']['size'] ) ? $settings['lottieWidth']['size'] : 40;
							if ( ! empty( $item['lottieWidth']['size'] ) ) {
								$lottie_width = isset( $item['lottieWidth']['size'] ) ? $item['lottieWidth']['size'] : 40;
							}

							$lottie_height = isset( $settings['lottieHeight']['size'] ) ? $settings['lottieHeight']['size'] : 40;
							if ( ! empty( $item['lottieHeight']['size'] ) ) {
								$lottie_height = isset( $item['lottieHeight']['size'] ) ? $item['lottieHeight']['size'] : 40;
							}

							$lottie_loop  = isset( $settings['lottieLoop'] ) ? $settings['lottieLoop'] : 'no';
							$lottiehover  = isset( $settings['lottiehover'] ) ? $settings['lottiehover'] : 'no';
							$lottie_speed = isset( $settings['lottieSpeed']['size'] ) ? $settings['lottieSpeed']['size'] : 1;

							$lottie_loop_value = '';
							if ( ! empty( $settings['lottieLoop'] ) && 'yes' === $settings['lottieLoop'] ) {
								$lottie_loop_value = 'loop';
							}

							$lottie_anim = 'autoplay';
							if ( ! empty( $settings['lottiehover'] ) && 'yes' === $settings['lottiehover'] ) {
								$lottie_anim = 'hover';
							}

							$list_img .= '<lottie-player src="' . esc_url( $item['lottieUrl']['url'] ) . '" style="width: ' . esc_attr( $lottie_width ) . 'px; height: ' . esc_attr( $lottie_height ) . 'px;" ' . esc_attr( $lottie_loop_value ) . '  speed="' . esc_attr( $lottie_speed ) . '" ' . esc_attr( $lottie_anim ) . '></lottie-player>';
						}
					}
				}

				/** Icon/Image/Text*/
				if ( ! empty( $item['loop_icon_style'] ) && 'font_awesome' === $item['loop_icon_style'] ) {
					ob_start();
					\Elementor\Icons_Manager::render_icon( $item['loop_icon_fontawesome'], array( 'aria-hidden' => 'true' ) );
					$list_img = ob_get_contents();
					ob_end_clean();
				}

				$display_counter = '';
				if ( ! empty( $settings['pro_ste_display_counter'] ) && 'yes' === $settings['pro_ste_display_counter'] ) {
					$display_counter = '<div class="tp-ps-dc ' . esc_attr( $display_counter_class ) . '">';

					if ( 'yes' === $settings['pro_ste_display_counter'] && 'custom-text' === $settings['pro_ste_display_counter_style'] ) {
						$display_counter .= '<span class="ds_custom_text_label">' . esc_html( $item['dis_counter_custom_text'] ) . '</span>';
					}

					$display_counter .= '</div>';
				}

				$dis_sep_custom_img = '';
				if ( ! empty( $settings['seprator_border_style_n'] ) && 'border_img_custom' === $settings['seprator_border_style_n'] ) {
					if ( ! empty( $settings['seprator_cusom_img']['url'] ) ) {
						$seprator_cusom_img = $settings['seprator_cusom_img']['id'];
						$sepimg1            = tp_get_image_rander( $seprator_cusom_img, 'full', array( 'class' => 'tp-sep-custom-img-inner' ) );
						$dis_sep_custom_img = '<span class="separator_custom_img">' . $sepimg1 . '</span>';
					}
				}

				$output .= '<div class="tp-process-steps-wrapper elementor-repeater-item-' . esc_attr( $item['_id'] ) . ' elementor-ps-content-' . esc_attr( $ps_count ) . ' ' . esc_attr( $on_load_class ) . '" data-index="' . esc_attr( $ps_count ) . '">';
				if ( ! empty( $settings['ps_style'] ) ) {
					if ( 'style_1' === $settings['ps_style'] || 'style_2' === $settings['ps_style'] ) {
						$output .= '<div class="tp-ps-left-imt ' . esc_attr( $display_special_bg ) . '">';

						$icn_a_start = '<span class="tp-ps-icon-img ' . esc_attr( $display_special_bg ) . '">';
						$icn_a_end   = '</span>';
						if ( ! empty( $item['loop_icn_link'] && 'yes' === $item['loop_icn_link'] ) ) {
							if ( ! empty( $item['loop_url_link']['url'] ) ) {
								$icn_a_start = '<a class="tp-ps-icon-img ' . esc_attr( $display_special_bg ) . '" ' . $this->get_render_attribute_string( 'loop_box_link' . $index ) . '>';
								$icn_a_end   = '</a>';
							}
						}

						if ( ! empty( $list_img ) ) {
							$output .= $dis_sep_custom_img . $icn_a_start . $list_img . $icn_a_end . $display_counter;
						}

						$output .= '</div>';
						$output .= '<div class="tp-ps-right-content">';

							$output .= '<span class="tp-ps-content">' . $list_title . ' ' . $description . '</span>';

						$output .= '</div>';
					}
				}

				$output .= '</div>';
				++$index;
			}

			$output .= '</div>';

			echo $output;
		}
	}
}