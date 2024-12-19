<?php
/**
 * Widget Name: Accordion/FAQ
 * Description: Toggle of faq/accordion.
 * Author: Theplus
 * Author URI: https://posimyth.com
 *
 * @package the-plus-addons-for-elementor-page-builder
 */

namespace TheplusAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use TheplusAddons\L_Theplus_Element_Load;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class L_ThePlus_Accordion.
 */
class L_ThePlus_Accordion extends Widget_Base {

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
		return 'tp-accordion';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Accordion', 'tpebl' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-lightbulb-o theplus_backend_icon';
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
		return array( 'plus-tabbed' );
	}

	/**
	 * Get Widget keywords.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_keywords() {
		return array( 'Accordion', 'Toggle', 'Collapsible', 'Expandable', ' Content Panel', 'FAQ', 'Q&A', 'Show/Hide', 'Dropdown', 'Tabbed Content', 'Vertical Tabs', 'Accordion Menu', 'Expand/Collapse', 'Content Slider' );
	}

	/**
	 * Register controls.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Content', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'tab_title',
			array(
				'label'       => esc_html__( 'Title & Content', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Accordion Title', 'tpebl' ),
				'dynamic'     => array(
					'active' => true,
				),
				'label_block' => true,
			)
		);
		$repeater->add_control(
			'content_source',
			array(
				'label'   => wp_kses_post( "Content Source <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "elementor-accordion-widget-settings-overview?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'content',
				'options' => array(
					'content'       => esc_html__( 'Content', 'tpebl' ),
					'page_template' => esc_html__( 'Page Template', 'tpebl' ),
				),
			)
		);
		$repeater->add_control(
			'tab_content',
			array(
				'label'      => esc_html__( 'Content', 'tpebl' ),
				'type'       => Controls_Manager::WYSIWYG,
				'default'    => esc_html__( 'Accordion Content', 'tpebl' ),
				'show_label' => false,
				'dynamic'    => array(
					'active' => true,
				),
				'condition'  => array(
					'content_source' => array( 'content' ),
				),
			)
		);
		$repeater->add_control(
			'content_template',
			array(
				'label'       => esc_html__( 'Elementor Templates', 'tpebl' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '0',
				'options'     => L_theplus_get_templates(),
				'label_block' => 'true',
				'condition'   => array( 'content_source' => 'page_template' ),
			)
		);
		$repeater->add_control(
			'backend_preview_template',
			array(
				'label'       => esc_html__( 'Backend Visibility', 'tpebl' ),
				'type'        => Controls_Manager::SWITCHER,
				'default'     => 'no',
				'label_on'    => esc_html__( 'Show', 'tpebl' ),
				'label_off'   => esc_html__( 'Hide', 'tpebl' ),
				'description' => esc_html__( 'Note : If disabled, Template will not visible/load in the backend for better page loading performance.', 'tpebl' ),
				'separator'   => 'after',
			)
		);
		$repeater->add_control(
			'display_icon',
			array(
				'label'     => esc_html__( 'Show Icon', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'separator' => 'before',
			)
		);
		$repeater->add_control(
			'display_icon_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'display_icon' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'tabs',
			array(
				'label'       => '',
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'tab_title'   => esc_html__( 'Accordion #1', 'tpebl' ),
						'tab_content' => esc_html__( 'I am item content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'tpebl' ),
					),
					array(
						'tab_title'   => esc_html__( 'Accordion #2', 'tpebl' ),
						'tab_content' => esc_html__( 'I am item content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'tpebl' ),
					),
				),
				'title_field' => '{{{ tab_title }}}',
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'icon_content_section',
			array(
				'label' => esc_html__( 'Icon Option', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'display_icon',
			array(
				'label'     => wp_kses_post( "Show Icon <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "add-icons-in-elementor-accordion?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank'  rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
			)
		);
		$this->add_control(
			'icon_style',
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
					'display_icon' => 'yes',
				),
			)
		);
		$this->add_control(
			'icon_fontawesome',
			array(
				'label'     => esc_html__( 'Icon Library', 'tpebl' ),
				'type'      => Controls_Manager::ICON,
				'default'   => 'fa fa-plus',
				'condition' => array(
					'display_icon' => 'yes',
					'icon_style'   => 'font_awesome',
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
					'display_icon' => 'yes',
					'icon_style'   => 'font_awesome_5',
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
					'display_icon' => 'yes',
					'icon_style'   => 'icon_mind',
				),
			)
		);

		$this->add_control(
			'icon_fontawesome_active',
			array(
				'label'     => esc_html__( 'Active Icon Library', 'tpebl' ),
				'type'      => Controls_Manager::ICON,
				'default'   => 'fa fa-minus',
				'condition' => array(
					'display_icon' => 'yes',
					'icon_style'   => 'font_awesome',
				),
			)
		);
		$this->add_control(
			'icon_fontawesome_5_active',
			array(
				'label'     => esc_html__( 'Icon Library', 'tpebl' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-plus',
					'library' => 'solid',
				),
				'condition' => array(
					'display_icon' => 'yes',
					'icon_style'   => 'font_awesome_5',
				),
			)
		);
		$this->add_control(
			'title_html_tag',
			array(
				'label'     => esc_html__( 'Title HTML Tag', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'h1'  => 'H1',
					'h2'  => 'H2',
					'h3'  => 'H3',
					'h4'  => 'H4',
					'h5'  => 'H5',
					'h6'  => 'H6',
					'div' => 'div',
				),
				'default'   => 'div',
				'separator' => 'before',
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'extra_content_section',
			array(
				'label' => esc_html__( 'Extra Option', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'extra_content_section_options',
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
			'special_content_section',
			array(
				'label' => esc_html__( 'Special Options', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'active_accordion',
			array(
				'label'   => wp_kses_post( "Active Accordion <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'options' => L_theplus_get_numbers(),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_toggle_style_icon',
			array(
				'label'     => esc_html__( 'Icon', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'display_icon' => 'yes',
				),
			)
		);

		$this->add_control(
			'icon_align',
			array(
				'label'       => esc_html__( 'Alignment', 'tpebl' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => array(
					'left'  => array(
						'title' => esc_html__( 'Start', 'tpebl' ),
						'icon'  => 'eicon-h-align-left',
					),
					'right' => array(
						'title' => esc_html__( 'End', 'tpebl' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'default'     => is_rtl() ? 'right' : 'left',
				'toggle'      => false,
				'label_block' => false,
				'condition'   => array(
					'display_icon' => 'yes',
				),
			)
		);

		$this->add_control(
			'icon_color',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .elementor-accordion .elementor-tab-title .elementor-accordion-icon i:before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-accordion .elementor-tab-title .elementor-accordion-icon svg' => 'fill: {{VALUE}};',
				),
				'condition' => array(
					'display_icon' => 'yes',
				),
			)
		);

		$this->add_control(
			'icon_active_color',
			array(
				'label'     => esc_html__( 'Active Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .elementor-accordion .elementor-tab-title.active .elementor-accordion-icon i:before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-accordion .elementor-tab-title.active .elementor-accordion-icon svg' => 'fill: {{VALUE}};',
				),
				'condition' => array(
					'display_icon' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'icon_space',
			array(
				'label'     => esc_html__( 'Gap', 'tpebl' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .elementor-accordion .elementor-accordion-icon.elementor-accordion-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-accordion .elementor-accordion-icon.elementor-accordion-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
				),
				'condition' => array(
					'display_icon' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'toggle_icon_size',
			array(
				'label'     => esc_html__( 'Icon Size', 'tpebl' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'default'   => array(
					'unit' => 'px',
					'size' => 20,
				),
				'selectors' => array(
					'{{WRAPPER}} .theplus-accordion-wrapper.elementor-accordion .elementor-tab-title .elementor-accordion-icon' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .theplus-accordion-wrapper.elementor-accordion .elementor-tab-title .elementor-accordion-icon svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
				'condition' => array(
					'display_icon' => 'yes',
				),
			)
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'section_title_style',
			array(
				'label' => esc_html__( 'Title', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typography', 'tpebl' ),
				'selector' => '{{WRAPPER}} .theplus-accordion-wrapper .theplus-accordion-item .plus-accordion-header',
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
					'{{WRAPPER}} .theplus-accordion-wrapper .theplus-accordion-item .plus-accordion-header' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .theplus-accordion-wrapper .theplus-accordion-item .plus-accordion-header' => 'background-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{title_gradient_color1.VALUE}} {{title_gradient_color1_control.SIZE}}{{title_gradient_color1_control.UNIT}}, {{title_gradient_color2.VALUE}} {{title_gradient_color2_control.SIZE}}{{title_gradient_color2_control.UNIT}});-webkit-background-clip: text;-webkit-text-fill-color: transparent;',
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
					'{{WRAPPER}} .theplus-accordion-wrapper .theplus-accordion-item .plus-accordion-header' => 'background-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{title_gradient_color1.VALUE}} {{title_gradient_color1_control.SIZE}}{{title_gradient_color1_control.UNIT}}, {{title_gradient_color2.VALUE}} {{title_gradient_color2_control.SIZE}}{{title_gradient_color2_control.UNIT}});-webkit-background-clip: text;-webkit-text-fill-color: transparent;',
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
			'tab_title_active',
			array(
				'label' => esc_html__( 'Active', 'tpebl' ),
			)
		);
		$this->add_control(
			'title_active_color_option',
			array(
				'label'       => esc_html__( 'Title Active Color', 'tpebl' ),
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
			'title_active_color',
			array(
				'label'     => esc_html__( 'Active Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#3351a6',
				'selectors' => array(
					'{{WRAPPER}} .theplus-accordion-wrapper .theplus-accordion-item .plus-accordion-header.active' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'title_active_color_option' => 'solid',
				),
			)
		);
		$this->add_control(
			'title_active_gradient_color1',
			array(
				'label'     => esc_html__( 'Color 1', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'orange',
				'condition' => array(
					'title_active_color_option' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'title_active_gradient_color1_control',
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
					'title_active_color_option' => 'gradient',
				),
				'of_type'     => 'gradient',
			)
		);
		$this->add_control(
			'title_active_gradient_color2',
			array(
				'label'     => esc_html__( 'Color 2', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'cyan',
				'condition' => array(
					'title_active_color_option' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'title_active_gradient_color2_control',
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
					'title_active_color_option' => 'gradient',
				),
				'of_type'     => 'gradient',
			)
		);
		$this->add_control(
			'title_active_gradient_style',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Gradient Style', 'tpebl' ),
				'default'   => 'linear',
				'options'   => l_theplus_get_gradient_styles(),
				'condition' => array(
					'title_active_color_option' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'title_active_gradient_angle',
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
					'{{WRAPPER}} .theplus-accordion-wrapper .theplus-accordion-item .plus-accordion-header.active' => 'background-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{title_active_gradient_color1.VALUE}} {{title_active_gradient_color1_control.SIZE}}{{title_active_gradient_color1_control.UNIT}}, {{title_active_gradient_color2.VALUE}} {{title_active_gradient_color2_control.SIZE}}{{title_active_gradient_color2_control.UNIT}});-webkit-background-clip: text;-webkit-text-fill-color: transparent;',
				),
				'condition'  => array(
					'title_active_color_option'   => 'gradient',
					'title_active_gradient_style' => array( 'linear' ),
				),
				'of_type'    => 'gradient',
			)
		);
		$this->add_control(
			'title_active_gradient_position',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Position', 'tpebl' ),
				'options'   => l_theplus_get_position_options(),
				'default'   => 'center center',
				'selectors' => array(
					'{{WRAPPER}} .theplus-accordion-wrapper .theplus-accordion-item .plus-accordion-header.active' => 'background-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{title_active_gradient_color1.VALUE}} {{title_active_gradient_color1_control.SIZE}}{{title_active_gradient_color1_control.UNIT}}, {{title_active_gradient_color2.VALUE}} {{title_active_gradient_color2_control.SIZE}}{{title_active_gradient_color2_control.UNIT}});-webkit-background-clip: text;-webkit-text-fill-color: transparent;',
				),
				'condition' => array(
					'title_active_color_option'   => 'gradient',
					'title_active_gradient_style' => 'radial',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_accordion_styling',
			array(
				'label' => esc_html__( 'Title Background', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'title_accordion_padding',
			array(
				'label'      => esc_html__( 'Inner Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-accordion-wrapper .theplus-accordion-item .plus-accordion-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'title_border_options',
			array(
				'label'     => esc_html__( 'Border Options', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'title_box_border',
			array(
				'label'     => esc_html__( 'Box Border', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'default'   => 'no',
			)
		);

		$this->add_control(
			'title_border_style',
			array(
				'label'     => esc_html__( 'Border Style', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'solid',
				'options'   => L_theplus_get_border_style(),
				'selectors' => array(
					'{{WRAPPER}} .theplus-accordion-wrapper .theplus-accordion-item .plus-accordion-header' => 'border-style: {{VALUE}};',
				),
				'condition' => array(
					'title_box_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'title_box_border_width',
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
					'{{WRAPPER}} .theplus-accordion-wrapper .theplus-accordion-item .plus-accordion-header' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'title_box_border' => 'yes',
				),
			)
		);

		$this->add_control(
			'title_box_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .theplus-accordion-wrapper .theplus-accordion-item .plus-accordion-header' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'title_box_border' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'title_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-accordion-wrapper .theplus-accordion-item .plus-accordion-header' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'title_box_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'accordion_space',
			array(
				'label'      => esc_html__( 'Accordion Between Space', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 200,
						'step' => 2,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 15,
				),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-accordion-wrapper .theplus-accordion-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
				'separator'  => 'after',
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
				'selector' => '{{WRAPPER}} .theplus-accordion-wrapper .theplus-accordion-item .plus-accordion-header',

			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_background_active',
			array(
				'label' => esc_html__( 'Active', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'box_active_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .theplus-accordion-wrapper .theplus-accordion-item .plus-accordion-header.active',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_desc_styling',
			array(
				'label' => esc_html__( 'Content', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'desc_typography',
				'label'    => esc_html__( 'Typography', 'tpebl' ),
				'selector' => '{{WRAPPER}} .theplus-accordion-wrapper .theplus-accordion-item .plus-accordion-content .plus-content-editor',
			)
		);
		$this->add_control(
			'desc_color',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .theplus-accordion-wrapper .theplus-accordion-item .plus-accordion-content .plus-content-editor,{{WRAPPER}} .theplus-accordion-wrapper .theplus-accordion-item .plus-accordion-content .plus-content-editor p' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_content_bg_styling',
			array(
				'label' => esc_html__( 'Content Background', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'content_accordion_margin',
			array(
				'label'      => esc_html__( 'Content Margin Space', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-accordion-wrapper .theplus-accordion-item .plus-accordion-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);
		$this->add_responsive_control(
			'content_accordion_padding',
			array(
				'label'      => esc_html__( 'Content Inner Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-accordion-wrapper .theplus-accordion-item .plus-accordion-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'content_border_options',
			array(
				'label'     => esc_html__( 'Border Options', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'content_box_border',
			array(
				'label'     => esc_html__( 'Box Border', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'default'   => 'no',
			)
		);

		$this->add_control(
			'content_border_style',
			array(
				'label'     => esc_html__( 'Border Style', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'solid',
				'options'   => L_theplus_get_border_style(),
				'selectors' => array(
					'{{WRAPPER}} .theplus-accordion-wrapper .theplus-accordion-item .plus-accordion-content' => 'border-style: {{VALUE}};',
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
					'{{WRAPPER}} .theplus-accordion-wrapper .theplus-accordion-item .plus-accordion-content' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'content_box_border' => 'yes',
				),
			)
		);

		$this->add_control(
			'content_box_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .theplus-accordion-wrapper .theplus-accordion-item .plus-accordion-content' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
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
					'{{WRAPPER}} .theplus-accordion-wrapper .theplus-accordion-item .plus-accordion-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'content_box_border' => 'yes',
				),
			)
		);
		$this->add_control(
			'content_background_options',
			array(
				'label' => esc_html__( 'Background Options', 'tpebl' ),
				'type'  => Controls_Manager::HEADING,
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'content_box_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .theplus-accordion-wrapper .theplus-accordion-item .plus-accordion-content',
			)
		);
		$this->add_control(
			'content_shadow_options',
			array(
				'label'     => esc_html__( 'Box Shadow Options', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'content_box_shadow',
				'selector' => '{{WRAPPER}} .theplus-accordion-wrapper .theplus-accordion-item .plus-accordion-content',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_hover_styling',
			array(
				'label' => esc_html__( 'Hover Style', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'section_hover_styling_options',
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
	 * Render Accrordion.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	protected function render() {
		$settings  = $this->get_settings_for_display();
		$templates = L_Theplus_Element_Load::elementor()->templates_manager->get_source( 'local' )->get_items();
		$id_int    = substr( $this->get_id_int(), 0, 3 );
		$uid       = uniqid( 'accordion' );

		$ani_effects = ! empty( $settings['animation_effects'] ) ? $settings['animation_effects'] : '';
		$ani_delay   = ! empty( $settings['animation_delay']['size'] ) ? $settings['animation_delay']['size'] : 50;
		$out_ani     = ! empty( $settings['animation_out_effects'] ) ? $settings['animation_out_effects'] : '';
		$oani_delay  = ! empty( $settings['animation_out_delay']['size'] ) ? $settings['animation_out_delay']['size'] : 50;

		$animate_duration = ! empty( $settings['animate_duration']['size'] ) ? $settings['animate_duration']['size'] : 50;

		$oani_duration  = ! empty( $settings['animation_out_duration_default'] ) ? $settings['animation_out_duration_default'] : '';
		$duratiom_speed = ! empty( $settings['animation_out_duration']['size'] ) ? $settings['animation_out_duration']['size'] : 50;
		$ani_duration   = ! empty( $settings['animation_duration_default'] ) ? $settings['animation_duration_default'] : '';

		$title_tag    = ! empty( $settings['title_html_tag'] ) ? $settings['title_html_tag'] : 'div';
		$display_icon = ! empty( $settings['display_icon'] ) ? $settings['display_icon'] : '';
		$icon_style   = ! empty( $settings['icon_style'] ) ? $settings['icon_style'] : '';
		$icon_allig   = ! empty( $settings['icon_align'] ) ? $settings['icon_align'] : '';

		if ( 'no-animation' === $ani_effects ) {
			$animated_class = '';
			$animation_attr = '';
		} else {
			$animate_offset  = '85%';
			$animated_class  = 'animate-general';
			$animation_attr  = ' data-animate-type="' . esc_attr( $ani_effects ) . '" data-animate-delay="' . esc_attr( $ani_delay ) . '"';
			$animation_attr .= ' data-animate-offset="' . esc_attr( $animate_offset ) . '"';

			if ( 'yes' === $ani_duration ) {
				$animation_attr .= ' data-animate-duration="' . esc_attr( $animate_duration ) . '"';
			}

			if ( 'no-animation' !== $out_ani ) {
				$animation_attr .= ' data-animate-out-type="' . esc_attr( $out_ani ) . '" data-animate-out-delay="' . esc_attr( $oani_delay ) . '"';

				if ( 'yes' === $oani_duration ) {
					$animation_attr .= ' data-animate-out-duration="' . esc_attr( $duratiom_speed ) . '"';
				}
			}
		}

		?>
		<div class="theplus-accordion-wrapper elementor-accordion <?php echo esc_attr( $animated_class ); ?>" id="<?php echo esc_attr( $uid ); ?>" data-accordion-id="<?php echo esc_attr( $uid ); ?>" data-accordion-type="accordion" data-toogle-speed="300" <?php echo $animation_attr; ?>  role="tablist">
			<?php
			foreach ( $settings['tabs'] as $index => $item ) {
				$content_source = ! empty( $item['content_source'] ) ? $item['content_source'] : '';
				$tab_content    = ! empty( $item['tab_content'] ) ? wp_kses_post( $item['tab_content'] ) : '';

				$tab_count = $index + 1;

				if ( $settings['active_accordion'] == $tab_count || 'all-open' === $settings['active_accordion'] ) {
					$active_default = 'active-default';
				} elseif ( $settings['active_accordion'] == 0 ) {
					$active_default = '0';
				} else {
					$active_default = 'no';
				}

				$tab_title_id   = 'elementor-tab-title-' . $id_int . $tab_count;
				$tab_content_id = 'elementor-tab-content-' . $id_int . $tab_count;

				$tab_title_setting_key = $this->get_repeater_setting_key( 'tab_title', 'tabs', $index );

				$tab_content_setting_key = $this->get_repeater_setting_key( 'tab_content', 'tabs', $index );

				$this->add_render_attribute(
					$tab_title_setting_key,
					array(
						'id'            => $tab_title_id,
						'class'         => array( 'elementor-tab-title', 'plus-accordion-header', $active_default ),
						'tabindex'      => $id_int . $tab_count,
						'data-tab'      => $tab_count,
						'role'          => 'tab',
						'aria-controls' => $tab_content_id,
					)
				);

				$this->add_render_attribute(
					$tab_content_setting_key,
					array(
						'id'              => $tab_content_id,
						'class'           => array( 'elementor-tab-content', 'elementor-clearfix', 'plus-accordion-content', $active_default ),
						'data-tab'        => $tab_count,
						'role'            => 'tabpanel',
						'aria-labelledby' => $tab_title_id,
					)
				);

				$this->add_inline_editing_attributes( $tab_content_setting_key, 'advanced' );
				$accordion_toggle_icon = '';
				?>
				
				<div class="theplus-accordion-item">
					<<?php echo l_theplus_validate_html_tag( $title_tag ); ?> <?php echo $this->get_render_attribute_string( $tab_title_setting_key ); ?>>
						<?php
						if ( 'yes' === $display_icon ) {

							$icons        = '';
							$icons_active = '';
							if ( 'font_awesome' === $icon_style ) {
								$icons_active = ! empty( $settings['icon_fontawesome_active'] ) ? $settings['icon_fontawesome_active'] : '';

								$icons = ! empty( $settings['icon_fontawesome'] ) ? $settings['icon_fontawesome'] : '';
							} elseif ( 'font_awesome_5' === $icon_style ) {
								$fontawesome_5 = ! empty( $settings['icon_fontawesome_5'] ) ? $settings['icon_fontawesome_5'] : 'fas fa-plus';
								$active_font_5 = ! empty( $settings['icon_fontawesome_5_active'] ) ? $settings['icon_fontawesome_5_active'] : 'fas fa-plus';

								ob_start();
								\Elementor\Icons_Manager::render_icon( $fontawesome_5, array( 'aria-hidden' => 'true' ) );
								$icons = ob_get_contents();
								ob_end_clean();

								ob_start();
								\Elementor\Icons_Manager::render_icon( $active_font_5, array( 'aria-hidden' => 'true' ) );
								$icons_active = ob_get_contents();
								ob_end_clean();
							}

							if ( ! empty( $icons ) && ! empty( $icons_active ) ) {
								$accordion_toggle_icon = '<span class="elementor-accordion-icon elementor-accordion-icon-' . esc_attr( $icon_allig ) . '" aria-hidden="true">';

								if ( 'font_awesome_5' === $icon_style ) {
									$accordion_toggle_icon .= '<span class="elementor-accordion-icon-closed">' . $icons . '</span>';
									$accordion_toggle_icon .= '<span class="elementor-accordion-icon-opened">' . $icons_active . '</span>';
								} else {
									$accordion_toggle_icon .= '<i class="elementor-accordion-icon-closed ' . esc_attr( $icons ) . '"></i>';
									$accordion_toggle_icon .= '<i class="elementor-accordion-icon-opened ' . esc_attr( $icons_active ) . '"></i>';
								}

								$accordion_toggle_icon .= '</span>';
							}
						}

						if ( 'left' === $icon_allig ) {
							echo $accordion_toggle_icon;
						}

						$tab_tit = ! empty( $item['tab_title'] ) ? $item['tab_title'] : '';
						echo '<span style="width:100%">' . wp_kses_post( $tab_tit ) . '</span>';

						if ( 'right' === $icon_allig ) {
							echo $accordion_toggle_icon;
						}

						?>

					</<?php echo l_theplus_validate_html_tag( $title_tag ); ?>>  

					<?php 

					$content_template = isset( $item['content_template'] ) ? intval( $item['content_template'] ) : 0;
					$backend_preview = !empty( $item['backend_preview_template'] ) ? $item['backend_preview_template'] : '';
					if ( 'content' === $content_source && ! empty( $tab_content ) || ( 'page_template' === $content_source && ! empty( $content_template ) ) ) { ?>
						<div <?php echo $this->get_render_attribute_string( $tab_content_setting_key ); ?>>
							<?php

							if ( 'content' === $content_source && ! empty( $tab_content ) ) {
								echo '<div class="plus-content-editor">' . $this->parse_text_editor( $tab_content ) . '</div>';
							}

							if ( \Elementor\Plugin::$instance->editor->is_edit_mode() && 'page_template' === $content_source && ! empty( $content_template ) ) {
								if ( 'yes' === $backend_preview ) {
									$template_status = get_post_status( $content_template );
									if( 'publish' === $template_status ){
										echo '<div class="plus-content-editor">' . L_Theplus_Element_Load::elementor()->frontend->get_builder_content_for_display( $content_template ) . '</div>';
									}else{
										echo '<div class="tab-preview-template-notice"><div class="preview-temp-notice-heading">' . esc_html__( 'Unauthorized Access', 'tpebl' ) . '</b></div><div class="preview-temp-notice-desc"><b>' . esc_html__( 'Note :', 'tpebl' ) . '</b> ' . esc_html__( 'You need to upgrade your permissions to Editor or Administrator level to update this option.', 'tpebl' ) . '</div></div>';
									}
								} else {
									$get_template_name = '';
									if ( ! empty( $templates ) ) {
										foreach ( $templates as $value ) {
											if ( $value['template_id'] == $content_template ) {
												$get_template_name = $value['title'];
											}
										}
									}

									echo '<div class="tab-preview-template-notice"><div class="preview-temp-notice-heading">Selected Template : <b>"' . esc_attr( $get_template_name ) . '"</b></div><div class="preview-temp-notice-desc"><b>' . esc_html__( 'Note :', 'tpebl' ) . '</b> ' . esc_html__( 'We have turn off visibility of template in the backend due to performance improvements. This will be visible perfectly on the frontend.', 'tpebl' ) . '</div></div>';
								}
							} elseif ( 'page_template' === $content_source ) {
								$template_status = get_post_status( $content_template );
								if( 'publish' === $template_status ){
									echo '<div class="plus-content-editor">' . L_Theplus_Element_Load::elementor()->frontend->get_builder_content_for_display( $content_template ) . '</div>';
								}else{
									echo '<div class="tab-preview-template-notice"><div class="preview-temp-notice-heading">' . esc_html__( 'Unauthorized Access', 'tpebl' ) . '</b></div><div class="preview-temp-notice-desc"><b>' . esc_html__( 'Note :', 'tpebl' ) . '</b> ' . esc_html__( 'You need to upgrade your permissions to Editor or Administrator level to update this option.', 'tpebl' ) . '</div></div>';
								}
							}

							?>

						</div>
					<?php } ?>

				</div>

			<?php } ?>
		</div>
		<?php
	}
}