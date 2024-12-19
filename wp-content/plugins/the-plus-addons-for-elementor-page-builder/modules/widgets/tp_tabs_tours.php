<?php
/**
 * Widget Name: Tabs And Tours
 * Description: Toggle of a tabs and tours content.
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


use TheplusAddons\L_Theplus_Element_Load;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class L_ThePlus_Tabs_Tours
 */
class L_ThePlus_Tabs_Tours extends Widget_Base {

	/**
	 * Document Link For Need help.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
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
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_name() {
		return 'tp-tabs-tours';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Tabs/Tours', 'tpebl' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-th-list theplus_backend_icon';
	}

	/**
	 * Get Widget categories.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_custom_help_url() {
		$help_url = $this->tp_help;

		return esc_url( $help_url );
	}

	/**
	 * Get Widget categories.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_categories() {
		return array( 'plus-tabbed' );
	}

	/**
	 * Get Widget keywords.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_keywords() {
		return array( 'tabs', 'tours', 'Tabs widget', 'Tours widget', 'Elementor Tabs', 'Elementor Tours', ' Elementor Tabs widget', 'Elementor Tours widget', 'Tabs addon', 'Tours addon', 'Elementor Tabs addon', 'Elementor Tours addon' );
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
				'label' => esc_html__( 'Content', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'how_it_works',
			array(
				'label' => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "tabs-tours-elementor-widget-settings-overview?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> Learn How it works  <i class='eicon-help-o'></i> </a>" ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'tab_title',
			array(
				'label'       => esc_html__( 'Title & Content', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Tab Title', 'tpebl' ),
				'dynamic'     => array(
					'active' => true,
				),
				'label_block' => true,
			)
		);
		$repeater->add_control(
			'content_source',
			array(
				'label'   => esc_html__( 'Content Source', 'tpebl' ),
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
				'default'    => esc_html__( 'Content', 'tpebl' ),
				'show_label' => false,
				'dynamic'    => array( 'active' => true ),
				'condition'  => array(
					'content_source' => array( 'content' ),
				),
			)
		);
		$repeater->add_control(
			'content_template_type',
			array(
				'label'     => wp_kses_post( "Templates<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "elementor-template-inside-tabs-widget/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'dropdown',
				'options'   => array(
					'dropdown' => esc_html__( 'Template', 'tpebl' ),
					'manually' => esc_html__( 'Shortcode', 'tpebl' ),
				),
				'condition' => array(
					'content_source' => array( 'page_template' ),
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
				'condition'   => array(
					'content_source'        => 'page_template',
					'content_template_type' => 'dropdown',
				),
			)
		);
		$repeater->add_control(
			'content_template_id',
			array(
				'label'       => esc_html__( 'Elementor Templates Shortcode', 'tpebl' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => array(
					'active' => true,
				),
				'default'     => '',
				'placeholder' => '[elementor-template id="70"]',
				'condition'   => array(
					'content_source'        => 'page_template',
					'content_template_type' => 'manually',
				),
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
				'condition'   => array(
					'content_source' => 'page_template',
				),
			)
		);
		$repeater->add_control(
			'display_icon',
			array(
				'label'     => wp_kses_post( "Show Inner Icon <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "add-icons-to-elementor-tabs?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'separator' => 'before',
				'condition' => array(
					'content_source' => array( 'content' ),
				),
			)
		);
		$repeater->add_control(
			'icon_style',
			array(
				'label'     => esc_html__( 'Icon Font', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'font_awesome',
				'options'   => array(
					'font_awesome' => esc_html__( 'Font Awesome', 'tpebl' ),
					'font_awesome_5' => esc_html__( 'Font Awesome 5', 'tpebl' ),
					'icon_mind'    => esc_html__( 'Icons Mind (Pro)', 'tpebl' ),
					'image'        => esc_html__( 'Image (Pro)', 'tpebl' ),
				),
				'condition' => array(
					'content_source' => array( 'content' ),
					'display_icon'   => 'yes',
				),
			)
		);
		$repeater->add_control(
			'icon_fontawesome',
			array(
				'label'     => esc_html__( 'Icon Library', 'tpebl' ),
				'type'      => Controls_Manager::ICON,
				'default'   => 'fa fa-plus',
				'separator' => 'before',
				'condition' => array(
					'content_source' => array( 'content' ),
					'display_icon'   => 'yes',
					'icon_style'     => 'font_awesome',
				),
			)
		);
		$repeater->add_control(
			'icon_fontawesome_5',
			array(
				'label'     => esc_html__( 'Icon Library', 'tpebl' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-plus',
					'library' => 'solid',
				),
				'separator' => 'before',
				'condition' => array(
					'display_icon' => 'yes',
					'icon_style'   => 'font_awesome_5',
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
					'content_source' => array( 'content' ),
					'display_icon'   => 'yes',
					'icon_style'     => array( 'icon_mind', 'image' ),
				),
			)
		);
		$repeater->add_control(
			'display_icon1',
			array(
				'label'     => wp_kses_post( "Show Outer Icon <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "add-icons-to-elementor-tabs?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'separator' => 'before',
				'condition' => array(
					'content_source' => array( 'content' ),
				),
			)
		);
		$repeater->add_control(
			'display_icon1_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'content_source' => array( 'content' ),
					'display_icon1'  => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'tabs',
			array(
				'label'       => 'Tab Content',
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'tab_title'   => esc_html__( 'Tab #1', 'tpebl' ),
						'tab_content' => esc_html__( 'I am item content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'tpebl' ),
					),
					array(
						'tab_title'   => esc_html__( 'Tab #2', 'tpebl' ),
						'tab_content' => esc_html__( 'I am item content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'tpebl' ),
					),
				),
				'title_field' => '{{{ tab_title }}}',
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'layout_content_section',
			array(
				'label' => esc_html__( 'Layout', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'tabs_type',
			array(
				'label'        => esc_html__( 'Layout', 'tpebl' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'horizontal',
				'options'      => array(
					'horizontal' => esc_html__( 'Horizontal', 'tpebl' ),
					'vertical'   => esc_html__( 'Vertical', 'tpebl' ),
				),
				'prefix_class' => 'elementor-tabs-view-',
			)
		);
		$this->add_control(
			'tabs_align_horizontal',
			array(
				'label'       => esc_html__( 'Navigation Position', 'tpebl' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => array(
					'top'    => array(
						'title' => esc_html__( 'Top', 'tpebl' ),
						'icon'  => 'eicon-v-align-top',
					),
					'bottom' => array(
						'title' => esc_html__( 'Bottom', 'tpebl' ),
						'icon'  => 'eicon-v-align-bottom',
					),
				),
				'default'     => 'top',
				'label_block' => false,
				'condition'   => array(
					'tabs_type' => array( 'horizontal' ),
				),
			)
		);
		$this->add_control(
			'tabs_align_vertical',
			array(
				'label'       => wp_kses_post( "Navigation Position <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "vertical-tabs-in-elementor?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => array(
					'left'  => array(
						'title' => esc_html__( 'Left', 'tpebl' ),
						'icon'  => 'eicon-text-align-left',
					),
					'right' => array(
						'title' => esc_html__( 'Right', 'tpebl' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'     => 'left',
				'label_block' => false,
				'condition'   => array(
					'tabs_type' => array( 'vertical' ),
				),
			)
		);
		$this->add_control(
			'tabs_swiper',
			array(
				'label'     => esc_html__( 'Swiper Effect', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'On', 'tpebl' ),
				'label_off' => esc_html__( 'Off', 'tpebl' ),
				'separator' => 'before',
				'condition' => array(
					'tabs_type' => array( 'horizontal' ),
				),
			)
		);
		$this->add_control(
			'tabs_swiper_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'tabs_type'   => array( 'horizontal' ),
					'tabs_swiper' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'on_hover_tabs',
			array(
				'label'     => wp_kses_post( "On Hover Tab <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "elementor-tab-on-hover?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'separator' => 'before',
			)
		);
		$this->add_control(
			'on_hover_tabs_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'on_hover_tabs' => array( 'yes' ),
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_toggle_style_icon',
			array(
				'label' => esc_html__( 'Icon', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'icon_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Size', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 6,
						'max'  => 200,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 15,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header .tab-icon-wrap,{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title .tab-icon-wrap' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header .tab-icon-wrap svg,{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title .tab-icon-wrap svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header .tab-icon-image' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'icon_color',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header .tab-icon-wrap,{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title .tab-icon-wrap' => 'color: {{VALUE}};',
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header .tab-icon-wrap svg,{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title .tab-icon-wrap svg' => 'fill: {{VALUE}}'
				),
			)
		);

		$this->add_control(
			'icon_active_color',
			array(
				'label'     => esc_html__( 'Active Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header:hover .tab-icon-wrap,{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header.active .tab-icon-wrap,{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title.active .tab-icon-wrap' => 'color: {{VALUE}};',
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header.active .tab-icon-wrap svg,{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title.active .tab-icon-wrap svg' => 'fill: {{VALUE}}'
				),
			)
		);

		$this->add_responsive_control(
			'icon_space',
			array(
				'label'     => esc_html__( 'Spacing', 'tpebl' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav:not(.full-width-icon) .plus-tab-header .tab-icon-wrap,{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title .tab-icon-wrap' => 'padding-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .theplus-tabs-wrapper ul.plus-tabs-nav.full-width-icon .plus-tab-header .tab-icon-wrap' => 'padding-right: 0;padding-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'full_icon',
			array(
				'label'     => esc_html__( 'Full Width Icon', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'separator' => 'before',
			)
		);
		$this->add_control(
			'full_icon_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'full_icon' => array( 'yes' ),
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_toggle_style_icon_outer',
			array(
				'label' => esc_html__( 'Outer Icon', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'section_toggle_style_icon_outer_options',
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
			'section_title_style',
			array(
				'label' => esc_html__( 'Tab Title Bar', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'nav_vertical_width',
			array(
				'label'      => esc_html__( 'Navigation Width', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( '%', 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 600,
						'step' => 2,
					),
					'%'  => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => '%',
					'size' => 25,
				),
				'selectors'  => array(
					'{{WRAPPER}}.elementor-tabs-view-vertical .theplus-tabs-nav-wrapper' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'tabs_type' => 'vertical',
				),
			)
		);
		$this->add_control(
			'nav_vertical_align',
			array(
				'label'       => esc_html__( 'Vertical Alignment', 'tpebl' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => array(
					'align-top'    => array(
						'title' => esc_html__( 'Top', 'tpebl' ),
						'icon'  => 'eicon-arrow-up',
					),
					'align-center' => array(
						'title' => esc_html__( 'Center', 'tpebl' ),
						'icon'  => 'eicon-text-align-center',
					),
					'align-bottom' => array(
						'title' => esc_html__( 'Bottom', 'tpebl' ),
						'icon'  => 'eicon-arrow-down',
					),
				),
				'default'     => 'align-top',
				'label_block' => false,
				'separator'   => 'after',
				'condition'   => array(
					'tabs_type' => 'vertical',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typography', 'tpebl' ),
				'selector' => '{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header,{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title',
			)
		);
		$this->add_control(
			'nav_align',
			array(
				'label'       => esc_html__( 'Nav Alignment', 'tpebl' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => array(
					'text-left'   => array(
						'title' => esc_html__( 'Left', 'tpebl' ),
						'icon'  => 'eicon-text-align-left',
					),
					'text-center' => array(
						'title' => esc_html__( 'Center', 'tpebl' ),
						'icon'  => 'eicon-text-align-center',
					),
					'text-right'  => array(
						'title' => esc_html__( 'Right', 'tpebl' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'     => 'text-left',
				'label_block' => false,
			)
		);
		$this->add_control(
			'nav_full_width',
			array(
				'label'     => esc_html__( 'Nav Full-Width', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Yes', 'tpebl' ),
				'label_off' => esc_html__( 'No', 'tpebl' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'nav_full_width_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'nav_full_width' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'nav_title_display',
			array(
				'label'     => esc_html__( 'Title On/Off', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'tpebl' ),
				'label_off' => esc_html__( 'Off', 'tpebl' ),
				'default'   => 'yes',
				'separator' => 'after',
			)
		);
		$this->add_control(
			'nav_same_width',
			array(
				'label'     => esc_html__( 'Nav Equal Width', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Yes', 'tpebl' ),
				'label_off' => esc_html__( 'No', 'tpebl' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'nav_same_width_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'nav_same_width' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'nav_color_options',
			array(
				'label'     => esc_html__( 'Title Color Options', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
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
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header,{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header span:not(.tab-icon-wrap),{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title span:not(.tab-icon-wrap)' => 'background-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{title_gradient_color1.VALUE}} {{title_gradient_color1_control.SIZE}}{{title_gradient_color1_control.UNIT}}, {{title_gradient_color2.VALUE}} {{title_gradient_color2_control.SIZE}}{{title_gradient_color2_control.UNIT}});-webkit-background-clip: text;-webkit-text-fill-color: transparent;',
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
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header span:not(.tab-icon-wrap),{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title span:not(.tab-icon-wrap)' => 'background-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{title_gradient_color1.VALUE}} {{title_gradient_color1_control.SIZE}}{{title_gradient_color1_control.UNIT}}, {{title_gradient_color2.VALUE}} {{title_gradient_color2_control.SIZE}}{{title_gradient_color2_control.UNIT}});-webkit-background-clip: text;-webkit-text-fill-color: transparent;',
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
						'icon'  => 'fa fa-barcode',
					),
				),
				'default'     => 'solid',
				'label_block' => false,
			)
		);
		$this->add_control(
			'title_active_color',
			array(
				'label'     => esc_html__( 'Active Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#3351a6',
				'selectors' => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header:hover,{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header.active,{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title.active' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header:hover span:not(.tab-icon-wrap),{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header.active span:not(.tab-icon-wrap),{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title.active span:not(.tab-icon-wrap)' => 'background-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{title_active_gradient_color1.VALUE}} {{title_active_gradient_color1_control.SIZE}}{{title_active_gradient_color1_control.UNIT}}, {{title_active_gradient_color2.VALUE}} {{title_active_gradient_color2_control.SIZE}}{{title_active_gradient_color2_control.UNIT}});-webkit-background-clip: text;-webkit-text-fill-color: transparent;',
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
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header:hover span:not(.tab-icon-wrap),{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header.active span:not(.tab-icon-wrap),{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title.active span:not(.tab-icon-wrap)' => 'background-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{title_active_gradient_color1.VALUE}} {{title_active_gradient_color1_control.SIZE}}{{title_active_gradient_color1_control.UNIT}}, {{title_active_gradient_color2.VALUE}} {{title_active_gradient_color2_control.SIZE}}{{title_active_gradient_color2_control.UNIT}});-webkit-background-clip: text;-webkit-text-fill-color: transparent;',
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
			'section_tab_underline',
			array(
				'label' => esc_html__( 'Underline', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'tab_title_underline_display',
			array(
				'label'     => esc_html__( 'Underline', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'tab_title_underline_display_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'tab_title_underline_display' => array( 'yes' ),
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_bg_style',
			array(
				'label' => esc_html__( 'Tab Title Bar Background', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'nav_inner_margin',
			array(
				'label'      => esc_html__( 'Nav Inner Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header,{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'nav_inner_padding',
			array(
				'label'      => esc_html__( 'Nav Inner Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'separator'  => 'after',
				'selectors'  => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header,{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'nav_title_space',
			array(
				'label'      => esc_html__( 'Space Between Navigation', 'tpebl' ),
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
					'{{WRAPPER}}.elementor-tabs-view-horizontal .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header' => 'margin-left: {{SIZE}}{{UNIT}};margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.elementor-tabs-view-horizontal .theplus-tabs-wrapper .plus-tabs-nav li:first-child .plus-tab-header' => 'margin-left:0;',
					'{{WRAPPER}}.elementor-tabs-view-horizontal .theplus-tabs-wrapper .plus-tabs-nav li:last-child .plus-tab-header' => 'margin-right:0;',
					'{{WRAPPER}}.elementor-tabs-view-vertical .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header' => 'margin-top: {{SIZE}}{{UNIT}};margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.elementor-tabs-view-vertical .theplus-tabs-wrapper .plus-tabs-nav li:first-child .plus-tab-header' => 'margin-top:0;',
					'{{WRAPPER}}.elementor-tabs-view-vertical .theplus-tabs-wrapper .plus-tabs-nav li:last-child .plus-tab-header' => 'margin-bottom:0;',

				),
			)
		);
		$this->add_control(
			'nav_box_border',
			array(
				'label'     => esc_html__( 'Box Border', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);

		$this->add_control(
			'nav_border_style',
			array(
				'label'     => esc_html__( 'Border Style', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'solid',
				'options'   => l_theplus_get_border_style(),
				'selectors' => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header' => 'border-style: {{VALUE}};',
				),
				'condition' => array(
					'nav_box_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'nav_border_width',
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
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'nav_box_border' => 'yes',
				),
			)
		);
		$this->start_controls_tabs( 'nav_box_border_style' );
		$this->start_controls_tab(
			'nav_border_normal',
			array(
				'label'     => esc_html__( 'Normal', 'tpebl' ),
				'condition' => array(
					'nav_box_border' => 'yes',
				),
			)
		);
		$this->add_control(
			'nav_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'nav_box_border' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'nav_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'nav_box_border' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'nav_border_active',
			array(
				'label'     => esc_html__( 'Active', 'tpebl' ),
				'condition' => array(
					'nav_box_border' => 'yes',
				),
			)
		);
		$this->add_control(
			'nav_border_active_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header:hover,{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header.active' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'nav_box_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'nav_border_active_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header:hover,{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header.active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'nav_box_border' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->start_controls_tabs( 'nav_background_style' );
		$this->start_controls_tab(
			'nav_background_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'nav_box_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header',

			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'nav_background_active',
			array(
				'label' => esc_html__( 'Active', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'nav_box_active_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header:hover,{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header.active',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		$this->start_controls_section(
			'section_nav_bg_styling',
			array(
				'label' => esc_html__( 'Navigation Area Background', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'nav_bg_margin',
			array(
				'label'      => esc_html__( 'Margin Space', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-nav-wrapper .plus-tabs-nav' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);
		$this->add_responsive_control(
			'nav_bg_padding',
			array(
				'label'      => esc_html__( 'Inner Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-nav-wrapper .plus-tabs-nav' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'nav_bg_box_border',
			array(
				'label'     => esc_html__( 'Box Border', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);

		$this->add_control(
			'nav_bg_border_style',
			array(
				'label'     => esc_html__( 'Border Style', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'solid',
				'options'   => L_theplus_get_border_style(),
				'selectors' => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-nav-wrapper .plus-tabs-nav' => 'border-style: {{VALUE}};',
				),
				'condition' => array(
					'nav_bg_box_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'nav_bg_box_border_width',
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
					'{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-nav-wrapper .plus-tabs-nav' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'nav_bg_box_border' => 'yes',
				),
			)
		);
		$this->start_controls_tabs( 'nav_bg_border_tab' );
		$this->start_controls_tab(
			'nav_bg_border_normal',
			array(
				'label'     => esc_html__( 'Normal', 'tpebl' ),
				'condition' => array(
					'nav_bg_box_border' => 'yes',
				),
			)
		);
		$this->add_control(
			'nav_bg_box_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-nav-wrapper .plus-tabs-nav' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'nav_bg_box_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'nav_bg_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-nav-wrapper .plus-tabs-nav' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'nav_bg_box_border' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'nav_bg_border_hover',
			array(
				'label'     => esc_html__( 'Hover', 'tpebl' ),
				'condition' => array(
					'nav_bg_box_border' => 'yes',
				),
			)
		);
		$this->add_control(
			'nav_bg_box_border_hover_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-nav-wrapper .plus-tabs-nav:hover' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'nav_bg_box_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'nav_bg_border_hover_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-nav-wrapper .plus-tabs-nav:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'nav_bg_box_border' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->start_controls_tabs( 'nav_bg_background_style' );
		$this->start_controls_tab(
			'nav_bg_background_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'nav_bg_box_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-nav-wrapper,{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-nav-wrapper .plus-tabs-nav',

			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'nav_bg_background_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'nav_bg_box_hover_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-nav-wrapper .plus-tabs-nav:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'nav_bg_shadow_options',
			array(
				'label'     => esc_html__( 'Box Shadow Options', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->start_controls_tabs( 'nav_bg_shadow_style' );
		$this->start_controls_tab(
			'nav_bg_shadow_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'nav_bg_box_shadow',
				'selector' => '{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-nav-wrapper .plus-tabs-nav',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'nav_bg_shadow_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'nav_bg_box_hover_shadow',
				'selector' => '{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-nav-wrapper .plus-tabs-nav:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'nav_bg_box_bf',
			array(
				'label'        => esc_html__( 'Backdrop Filter', 'tpebl' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'tpebl' ),
				'label_on'     => __( 'Custom', 'tpebl' ),
				'return_value' => 'yes',
			)
		);
		$this->add_control(
			'nav_bg_box_bf_blur',
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
					'nav_bg_box_bf' => 'yes',
				),
			)
		);
		$this->add_control(
			'nav_bg_box_bf_grayscale',
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
					'{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-nav-wrapper .plus-tabs-nav' => '-webkit-backdrop-filter:grayscale({{nav_bg_box_bf_grayscale.SIZE}})  blur({{nav_bg_box_bf_blur.SIZE}}{{nav_bg_box_bf_blur.UNIT}}) !important;backdrop-filter:grayscale({{nav_bg_box_bf_grayscale.SIZE}})  blur({{nav_bg_box_bf_blur.SIZE}}{{nav_bg_box_bf_blur.UNIT}}) !important;',
				),
				'condition'  => array(
					'nav_bg_box_bf' => 'yes',
				),
			)
		);
		$this->end_popover();
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
				'selector' => '{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-content-wrapper .plus-tab-content .plus-content-editor',
			)
		);
		$this->add_control(
			'desc_color',
			array(
				'label'     => esc_html__( 'Desc Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-content-wrapper .plus-tab-content .plus-content-editor,{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-content-wrapper .plus-tab-content .plus-content-editor p' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_section();
		/*desc style*/
		$this->start_controls_section(
			'section_desc_bg_styling',
			array(
				'label' => esc_html__( 'Content Background', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'content_tab_margin',
			array(
				'label'      => esc_html__( 'Content Margin Space', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-content-wrapper,{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion.mobile-accordion-tab .theplus-tabs-content-wrapper .plus-tab-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'content_tab_padding',
			array(
				'label'      => esc_html__( 'Content Inner Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-content-wrapper,{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion.mobile-accordion-tab .theplus-tabs-content-wrapper .plus-tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-content-wrapper' => 'border-style: {{VALUE}};',
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
					'{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-content-wrapper' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-content-wrapper' => 'border-color: {{VALUE}};',
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
					'{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-content-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'content_box_border' => 'yes',
				),
			)
		);

		$this->add_control(
			'content_background_options',
			array(
				'label'     => esc_html__( 'Background Options', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'content_box_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-content-wrapper',

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
				'selector' => '{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-content-wrapper',
			)
		);
		$this->end_controls_section();
		/* Extra option */
		$this->start_controls_section(
			'section_extra_options',
			array(
				'label' => esc_html__( 'Extra Options', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'section_extra_pro_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
			)
		);
		$this->add_control(
			'tab_nav_responsive',
			array(
				'label'       => esc_html__( 'Tab Navigation Responsive', 'tpebl' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '',
				'options'     => array(
					''              => esc_html__( 'None', 'tpebl' ),
					'nav_full'      => esc_html__( 'Full Width (PRO) ', 'tpebl' ),
					'nav_one'       => esc_html__( 'One By One (PRO)', 'tpebl' ),
					'tab_accordion' => esc_html__( 'Force Accordion', 'tpebl' ),
				),
				'separator'   => 'before',
				'description' => esc_html__( 'These options are for making your tabs look different in small devices. You can select none, If you want to keep your settings.', 'tpebl' ),
			)
		);
		$this->add_control(
			'tab_nav_responsive_pro_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'tab_nav_responsive!' => 'tab_accordion',
				),
			)
		);
		$this->add_control(
			'tab_accordion_options',
			array(
				'label'     => esc_html__( 'Accordion Navigation Options', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'tab_nav_responsive' => 'tab_accordion',
				),
			)
		);
		$this->start_controls_tabs( 'accordion_background_style' );
		$this->start_controls_tab(
			'accordion_background_normal',
			array(
				'label'     => esc_html__( 'Normal', 'tpebl' ),
				'condition' => array(
					'tab_nav_responsive' => 'tab_accordion',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'accordion_box_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title',
				'condition' => array(
					'tab_nav_responsive' => 'tab_accordion',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'accordion_background_active',
			array(
				'label'     => esc_html__( 'Active', 'tpebl' ),
				'condition' => array(
					'tab_nav_responsive' => 'tab_accordion',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'accordion_box_active_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title.active',
				'condition' => array(
					'tab_nav_responsive' => 'tab_accordion',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
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
	 * Tabs tours render.
	 *
	 * @since 1.0.1
	 * @version 5.5.4
	 */
	protected function render() {
		$settings  = $this->get_settings_for_display();
		$templates = L_Theplus_Element_Load::elementor()->templates_manager->get_source( 'local' )->get_items();

		$tabs               = $this->get_settings_for_display( 'tabs' );
		$nav_align          = $settings['nav_align'];
		$id_int             = substr( $this->get_id_int(), 0, 3 );
		$nav_vertical_align = $settings['nav_vertical_align'];
		$uid                = uniqid( 'tabs' );

		$animation_effects = ! empty( $settings['animation_effects'] ) ? $settings['animation_effects'] : '';
		$animation_delay   = ! empty( $settings['animation_delay']['size'] ) ? $settings['animation_delay']['size'] : 50;
		$ani_duration      = ! empty( $settings['animation_duration_default'] ) ? $settings['animation_duration_default'] : '';
		$animate_duration  = ! empty( $settings['animate_duration']['size'] ) ? $settings['animate_duration']['size'] : 50;
		$out_effect        = ! empty( $settings['animation_out_effects'] ) ? $settings['animation_out_effects'] : '';
		$out_delay         = ! empty( $settings['animation_out_delay']['size'] ) ? $settings['animation_out_delay']['size'] : 50;
		$out_duration      = ! empty( $settings['animation_out_duration_default'] ) ? $settings['animation_out_duration_default'] : '';
		$out_speed         = ! empty( $settings['animation_out_duration']['size'] ) ? $settings['animation_out_duration']['size'] : 50;

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

		$tab_nav      = '<div class="theplus-tabs-nav-wrapper elementor-tabs-wrapper ' . esc_attr( $nav_align ) . ' ' . esc_attr( $nav_vertical_align ) . ' ">';
			$tab_nav .= '<ul class="plus-tabs-nav">';
		foreach ( $tabs as $index => $item ) :
			$tab_count = $index + 1;

			$tab_title_id   = 'elementor-tab-title-' . $id_int . $tab_count;
			$tab_content_id = 'elementor-tab-content-' . $id_int . $tab_count;

			$tab_title_setting_key = $this->get_repeater_setting_key( 'tab_title', 'tabs', $index );
			$tabh_bg               = tp_bg_lazyLoad( $settings['nav_box_background_image'], $settings['nav_box_active_background_image'] );
			$this->add_render_attribute(
				$tab_title_setting_key,
				array(
					'id'            => $tab_title_id,
					'class'         => array( 'elementor-tab-title', 'elementor-tab-desktop-title', 'plus-tab-header' . $tabh_bg ),
					'data-tab'      => $tab_count,
					'tabindex'      => $id_int . $tab_count,
					'role'          => 'tab',
					'aria-controls' => $tab_content_id,
				)
			);

			$tab_nav  .= '<li>';
			$tab_nav  .= '<div ' . $this->get_render_attribute_string( $tab_title_setting_key ) . '>';
			$image_alt = '';
			$dis_icon  = ! empty( $item['display_icon'] ) ? $item['display_icon'] : '';

			if ( 'yes' === $dis_icon ) :
				$icons      = '';
				$icon_image = '';

				$icon_style = ! empty( $item['icon_style'] ) ? $item['icon_style'] : '';

				if ( 'font_awesome' === $icon_style ) {

					$icons = $item['icon_fontawesome'];
				}elseif ( 'font_awesome_5' === $item['icon_style'] ) {
					ob_start();
					\Elementor\Icons_Manager::render_icon( $item['icon_fontawesome_5'], array( 'aria-hidden' => 'true' ) );
					$icons = ob_get_contents();
					ob_end_clean();
				}

				if ( ! empty( $icons ) || ! empty( $icon_image ) ) {
						$tab_nav .= '<span class="tab-icon-wrap" aria-hidden="true">';
					if ( 'image' !== $icon_style ) {
						if ( 'font_awesome_5' === $item['icon_style'] ) {
								$tab_nav .= '<span>' . $icons . '</span>';
							} else {
								$tab_nav .= '<i class="tab-icon ' . esc_attr( $icons ) . '"></i>';
							}
					} else {
						$tab_nav .= '<img src="' . esc_url( $icon_image ) . '" class="tab-icon tab-icon-image" alt="' . esc_attr( $image_alt ) . '" />';
					}
						$tab_nav .= '</span>';
				}
				endif;
				$nav_title = ! empty( $settings['nav_title_display'] ) ? $settings['nav_title_display'] : '';
			if ( 'yes' === $nav_title ) {
				$tab_nav .= '<span>' . wp_kses_post( $item['tab_title'] ) . '</span>';
			}
				$tab_nav .= '</div>';

				$tab_nav .= '</li>';
				endforeach;
				$tab_nav .= '</ul>';
			$tab_nav     .= '</div>';
			$tabccon_bg   = tp_bg_lazyLoad( $settings['content_box_background_image'] );
			$tab_content  = '<div class="theplus-tabs-content-wrapper elementor-tabs-content-wrapper ' . $tabccon_bg . '">';
		foreach ( $tabs as $index => $item ) :
			$tab_count = $index + 1;

			$tab_content_setting_key = $this->get_repeater_setting_key( 'tab_content', 'tabs', $index );

			$tab_title_mobile_setting_key = $this->get_repeater_setting_key( 'tab_title_mobile', 'tabs', $tab_count );

			$this->add_render_attribute(
				$tab_content_setting_key,
				array(
					'id'              => $tab_content_id,
					'class'           => array( 'elementor-tab-content', 'elementor-clearfix', 'plus-tab-content' ),
					'data-tab'        => $tab_count,
					'role'            => 'tabpanel',
					'aria-labelledby' => $tab_title_id,
				)
			);
			$acmob_bg = tp_bg_lazyLoad( $settings['accordion_box_background_image'], $settings['accordion_box_active_background_image'] );
			$this->add_render_attribute(
				$tab_title_mobile_setting_key,
				array(
					'class'    => array( 'elementor-tab-title', 'elementor-tab-mobile-title', $acmob_bg, $nav_align ),
					'tabindex' => $id_int . $tab_count,
					'data-tab' => $tab_count,
					'role'     => 'tab',
				)
			);

			$this->add_inline_editing_attributes( $tab_content_setting_key, 'advanced' );

			$tab_content .= '<div ' . $this->get_render_attribute_string( $tab_title_mobile_setting_key ) . '>';
			$image_alt    = '';
			if ( 'yes' === $dis_icon ) :
				$icons      = '';
				$icon_image = '';
				$IconStyle  = ! empty( $item['icon_style'] ) ? $item['icon_style'] : '';

				if ( 'font_awesome' === $icon_style ) {
						$icons = $item['icon_fontawesome'];
				}elseif ( 'font_awesome_5' === $IconStyle ) {
					ob_start();
						\Elementor\Icons_Manager::render_icon( $item['icon_fontawesome_5'], array( 'aria-hidden' => 'true' ) );
						$icons = ob_get_contents();
					ob_end_clean();
				}

				if ( ! empty( $icons ) || ! empty( $icon_image ) ) {
						$tab_content .= '<span class="tab-icon-wrap" aria-hidden="true">';
					if ( 'image' !== $icon_style ) {
						if ( 'font_awesome_5' === $IconStyle ) {
							$tab_content .= $icons;
						} else {
							$tab_content .= '<i class="tab-icon ' . esc_attr( $icons ) . '"></i>';
						}
					} else {
						$tab_content .= '<img src="' . esc_url( $icon_image ) . '" class="tab-icon tab-icon-image" alt="' . esc_attr( $image_alt ) . '" />';
					}
					$tab_content .= '</span>';
				}
						endif;
				$tab_title    = ! empty( $item['tab_title'] ) ? $item['tab_title'] : '';
				$tab_content .= '<span>' . wp_kses_post( $tab_title ) . '</span>';
			$tab_content     .= '</div>';
			$tab_content     .= '<div ' . $this->get_render_attribute_string( $tab_content_setting_key ) . '>';

			$con_sors = ! empty( $item['content_source'] ) ? $item['content_source'] : '';
			$tab_con  = ! empty( $item['tab_content'] ) ? $item['tab_content'] : '';

			if ( 'content' === $con_sors && ! empty( $tab_con ) ) {
				$tab_content .= '<div class="plus-content-editor">' . $this->parse_text_editor( $tab_con ) . '</div>';
			}

			$content_template = isset( $item['content_template'] ) ? intval( $item['content_template'] ) : 0;

			if ( ( ! empty( $item['content_source'] ) && 'page_template' === $item['content_source'] ) && ( ! empty( $item['content_template_type'] ) && 'manually' === $item['content_template_type'] ) && ! empty( $item['content_template_id'] ) ) {
				if ( \Elementor\Plugin::$instance->editor->is_edit_mode() && 'page_template' === $item['content_source'] && ! empty( $item['content_template_id'] ) ) {
					if ( ! empty( $item['backend_preview_template'] ) && 'yes' === $item['backend_preview_template'] ) {
						$template_status = get_post_status( $content_template );
						if( 'publish' === $template_status ) {
							$tab_content .= '<div class="plus-content-editor">' . L_Theplus_Element_Load::elementor()->frontend->get_builder_content_for_display( substr( $item['content_template_id'], 24, -2 ) ) . '</div>';
						} else {
							$tab_content .= '<div class="tab-preview-template-notice"><div class="preview-temp-notice-heading">' . esc_html__( 'Unauthorized Access', 'tpebl' ) . '</b></div><div class="preview-temp-notice-desc"><b>' . esc_html__( 'Note :', 'tpebl' ) . '</b> ' . esc_html__( 'You need to upgrade your permissions to Editor or Administrator level to update this option.', 'tpebl' ) . '</div></div>';
						}
					} else {
						$tab_content .= '<div class="tab-preview-template-notice"><div class="preview-temp-notice-heading">Selected Template : <b>"' . esc_attr( $item['content_template_id'] ) . '"</b></div><div class="preview-temp-notice-desc"><b>Note :</b> We have turn off visibility of template in the backend due to performance improvements. This will be visible perfectly on the frontend.</div></div>';
					}
				} elseif ( 'page_template' === $item['content_source'] && ! empty( $item['content_template_id'] ) ) {

					$template_status = get_post_status( $content_template );
					if( 'publish' === $template_status ) {
						$tab_content .= '<div class="plus-content-editor">' . L_Theplus_Element_Load::elementor()->frontend->get_builder_content_for_display( substr( $item['content_template_id'], 24, -2 ) ) . '</div>';
					} else {
						$tab_content .= '<div class="tab-preview-template-notice"><div class="preview-temp-notice-heading">' . esc_html__( 'Unauthorized Access', 'tpebl' ) . '</b></div><div class="preview-temp-notice-desc"><b>' . esc_html__( 'Note :', 'tpebl' ) . '</b> ' . esc_html__( 'You need to upgrade your permissions to Editor or Administrator level to update this option.', 'tpebl' ) . '</div></div>';
					}
				}
			} elseif ( \Elementor\Plugin::$instance->editor->is_edit_mode() && 'page_template' === $item['content_source'] && ! empty( $content_template ) ) {
				if ( ! empty( $item['backend_preview_template'] ) && 'yes' === $item['backend_preview_template'] ) {
					$template_status = get_post_status( $content_template );
					if( 'publish' === $template_status ) {
						$tab_content .= '<div class="plus-content-editor">' . L_Theplus_Element_Load::elementor()->frontend->get_builder_content_for_display( $content_template ) . '</div>';
					} else {
						$tab_content .= '<div class="tab-preview-template-notice"><div class="preview-temp-notice-heading">' . esc_html__( 'Unauthorized Access', 'tpebl' ) . '</b></div><div class="preview-temp-notice-desc"><b>' . esc_html__( 'Note :', 'tpebl' ) . '</b> ' . esc_html__( 'You need to upgrade your permissions to Editor or Administrator level to update this option.', 'tpebl' ) . '</div></div>';
					}
				} else {
					$get_template_name = '';
					$get_template_id   = $content_template;
					if ( ! empty( $templates ) && ! empty( $get_template_id ) ) {
						foreach ( $templates as $value ) {
							if ( $value['template_id'] === $get_template_id ) {
								$get_template_name = $value['title'];
							}
						}
					}

					$tab_content .= '<div class="tab-preview-template-notice"><div class="preview-temp-notice-heading">Selected Template : <b>"' . esc_attr( $get_template_name ) . '"</b></div><div class="preview-temp-notice-desc"><b>Note :</b> We have turn off visibility of template in the backend due to performance improvements. This will be visible perfectly on the frontend.</div></div>';
				}
			} elseif ( 'page_template' === $item['content_source'] && ! empty( $content_template ) ) {

				$template_status = get_post_status( $content_template );
				if( 'publish' === $template_status ) {
					$tab_content .= '<div class="plus-content-editor">' . L_Theplus_Element_Load::elementor()->frontend->get_builder_content_for_display( $content_template ) . '</div>';
				} else {
					$tab_content .= '<div class="tab-preview-template-notice"><div class="preview-temp-notice-heading">' . esc_html__( 'Unauthorized Access', 'tpebl' ) . '</b></div><div class="preview-temp-notice-desc"><b>' . esc_html__( 'Note :', 'tpebl' ) . '</b> ' . esc_html__( 'You need to upgrade your permissions to Editor or Administrator level to update this option.', 'tpebl' ) . '</div></div>';
				}
			}
				$tab_content .= '</div>';
				endforeach;
			$tab_content .= '</div>';

		$default_active  = '';
		$default_active .= ' data-tab-default="0"';
		$default_active .= ' data-tab-hover="no"';

		$responsive_class = '';
		$nav_respon       = ! empty( $settings['tab_nav_responsive'] ) ? $settings['tab_nav_responsive'] : '';
		if ( 'tab_accordion' === $nav_respon ) {
			$responsive_class = 'mobile-accordion';
		}

		$output = '<div class="theplus-tabs-wrapper elementor-tabs ' . esc_attr( $animated_class ) . ' ' . esc_attr( $responsive_class ) . '" id="' . esc_attr( $uid ) . '" data-tabs-id="' . esc_attr( $uid ) . '"  ' . $default_active . ' ' . $animation_attr . ' role="tablist">';

		$tebs_typs = ! empty( $settings['tabs_type'] ) ? $settings['tabs_type'] : '';

		if ( 'horizontal' === $tebs_typs ) {
			$align_hor = ! empty( $settings['tabs_align_horizontal'] ) ? $settings['tabs_align_horizontal'] : '';
			if ( 'top' === $align_hor ) {
				$output .= $tab_nav . $tab_content;
			}
			if ( 'bottom' === $align_hor ) {
				$output .= $tab_content . $tab_nav;
			}
		}

		if ( 'vertical' === $tebs_typs ) {
			$align_ver = ! empty( $settings['tabs_align_vertical'] ) ? $settings['tabs_align_vertical'] : '';
			if ( 'left' === $align_ver ) {
				$output .= $tab_nav . $tab_content;
			}
			if ( 'right' === $align_ver ) {
				$output .= $tab_content . $tab_nav;
			}
		}
		$output .= '</div>';
		echo $output;
	}
}