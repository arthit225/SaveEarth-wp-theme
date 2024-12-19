<?php
/**
 * Widget Name: TP Navigation Menu
 * Description: Style of header navigation bar menu
 * Author: theplus
 * Author URI: https://posimyth.com
 *
 * @package ThePlus
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

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class L_ThePlus_Navigation_Menu_Lite
 */
class L_ThePlus_Navigation_Menu_Lite extends Widget_Base {

	/**
	 * Document Link For Need help.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
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
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_name() {
		return 'tp-navigation-menu-lite';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_title() {
		return __( 'Navigation Menu Lite', 'tpebl' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-bars theplus_backend_icon';
	}

	/**
	 * Get Widget categories.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_categories() {
		return array( 'plus-header' );
	}

	/**
	 * Get Widget custom url.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_custom_help_url() {
		$help_url = $this->tp_help;

		return esc_url( $help_url );
	}

	/**
	 * Get Widget keywords.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_keywords() {
		return array( 'menu', 'navigation', 'header', 'menu bar', 'nav' );
	}

	/**
	 * Register controls.
	 *
	 * @since 1.0.1
	 * @version 5.5.4
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'navbar_sections',
			array(
				'label' => __( 'Navigation Bar', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'TypeMenu',
			array(
				'label'   => esc_html__( 'Menu Type', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'standard',
				'options' => array(
					'standard' => esc_html__( 'Default', 'tpebl' ),
					'custom'   => esc_html__( 'Repeater', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'navbar_menu_type',
			array(
				'label'   => __( 'Menu Direction', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'horizontal',
				'options' => array(
					'horizontal' => __( 'Horizontal Menu', 'tpebl' ),
					'vertical'   => __( 'Vertical Menu', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_vertical',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "create-a-vertical-navigation-menu-in-elementor-for-free/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'navbar_menu_type' => array( 'vertical' ),
				),
			)
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'depth',
			array(
				'label'   => esc_html__( 'Menu Level', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '0',
				'options' => array(
					'0' => esc_html__( '0 Level', 'tpebl' ),
					'1' => esc_html__( '1 Level', 'tpebl' ),
					'2' => esc_html__( '2 Level', 'tpebl' ),
					'3' => esc_html__( '3 Level', 'tpebl' ),
					'4' => esc_html__( '4 Level', 'tpebl' ),
					'5' => esc_html__( '5 Level', 'tpebl' ),
					'6' => esc_html__( '6 Level', 'tpebl' ),
				),
			)
		);
		$repeater->add_control(
			'SmenuType',
			array(
				'label'     => esc_html__( 'Sub Menu Type', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'link',
				'options'   => array(
					'link'      => esc_html__( 'Link', 'tpebl' ),
					'mega-menu' => esc_html__( 'Mega Menu', 'tpebl' ),
				),
				'condition' => array(
					'depth' => '1',
				),
			)
		);
		$repeater->add_control(
			'LinkFilter',
			array(
				'label'         => esc_html__( 'Link', 'tpebl' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_html__( 'https://your-link.com', 'tpebl' ),
				'show_external' => true,
				'default'       => array(
					'url'         => '#',
					'is_external' => true,
					'nofollow'    => true,
				),
				'dynamic'       => array( 'active' => true ),
				'conditions'    => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'terms' => array(
								array(
									'name'     => 'depth',
									'operator' => '!=',
									'value'    => '1',
								),
							),
						),
						array(
							'terms' => array(
								array(
									'name'     => 'depth',
									'operator' => '==',
									'value'    => '1',
								),
								array(
									'name'     => 'SmenuType',
									'operator' => '==',
									'value'    => 'link',
								),
							),
						),
					),
				),
			)
		);
		$repeater->add_control(
			'filterlabel',
			array(
				'label'       => esc_html__( 'Menu Text', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'dynamic'     => array(
					'active' => true,
				),
				'label_block' => true,
				'conditions'  => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'terms' => array(
								array(
									'name'     => 'depth',
									'operator' => '!=',
									'value'    => '1',
								),
							),
						),
						array(
							'terms' => array(
								array(
									'name'     => 'depth',
									'operator' => '==',
									'value'    => '1',
								),
								array(
									'name'     => 'SmenuType',
									'operator' => '==',
									'value'    => 'link',
								),
							),
						),
					),
				),
			)
		);
		$repeater->add_control(
			'blockTemp',
			array(
				'label'       => esc_html__( 'Template', 'tpebl' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '0',
				'options'     => L_theplus_get_templates(),
				'label_block' => 'true',
				'condition'   => array(
					'depth'     => '1',
					'SmenuType' => 'mega-menu',
				),
			)
		);
		$repeater->add_control(
			'megaMType',
			array(
				'label'     => esc_html__( 'Mega Menu Type', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'default',
				'options'   => array(
					'default'    => esc_html__( 'Default', 'tpebl' ),
					'container'  => esc_html__( 'Container', 'tpebl' ),
					'full-width' => esc_html__( 'Full Width', 'tpebl' ),
				),
				'condition' => array(
					'depth'     => '1',
					'SmenuType' => 'mega-menu',
				),
			)
		);
		$repeater->add_control(
			'megaMwid',
			array(
				'label'      => esc_html__( 'Container Width', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 5000,
						'step' => 1,
					),
					'%'  => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 0.5,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-wrap .plus-navigation-inner .navbar-nav li.plus-dropdown-default ul.dropdown-menu' => 'max-width: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}};right: auto;',
				),
				'condition'  => array(
					'megaMType' => 'default',
				),
			)
		);
		$repeater->add_control(
			'megaMAlign',
			array(
				'label'     => esc_html__( 'Dropdown Menu Alignment', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'default',
				'options'   => array(
					'default' => esc_html__( 'Default', 'tpebl' ),
					'center'  => esc_html__( 'Center', 'tpebl' ),
				),
				'condition' => array(
					'megaMType' => 'default',
				),
			)
		);
		$repeater->add_control(
			'moblieMmenu',
			array(
				'label'     => esc_html__( 'Moblie Mega Menu Link', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Yes', 'tpebl' ),
				'label_off' => esc_html__( 'No', 'tpebl' ),
			)
		);
		$repeater->add_control(
			'MLinkFilter',
			array(
				'label'         => esc_html__( 'Link', 'tpebl' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_html__( 'https://your-link.com', 'tpebl' ),
				'show_external' => true,
				'default'       => array(
					'url'         => '#',
					'is_external' => true,
					'nofollow'    => true,
				),
				'dynamic'       => array( 'active' => true ),
				'condition'     => array(
					'moblieMmenu' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'Mfilterlabel',
			array(
				'label'       => esc_html__( 'Menu Text', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'dynamic'     => array(
					'active' => true,
				),
				'label_block' => true,
				'condition'   => array(
					'moblieMmenu' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'minWidth',
			array(
				'label'      => esc_html__( 'Submenu Minimum Width (Px)', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => '',
				'range'      => array(
					'px' => array(
						'min'  => 100,
						'max'  => 1000,
						'step' => 2,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav li{{CURRENT_ITEM}} > ul.dropdown-menu' => 'min-width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'megaMType' => 'default',
				),
			)
		);
		$repeater->add_control(
			'showlabel',
			array(
				'label'     => esc_html__( 'Label', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Yes', 'tpebl' ),
				'label_off' => esc_html__( 'No', 'tpebl' ),
			)
		);
		$repeater->add_control(
			'labeltxt',
			array(
				'label'       => esc_html__( 'Title', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'New', 'tpebl' ),
				'dynamic'     => array(
					'active' => true,
				),
				'label_block' => true,
				'condition'   => array(
					'showlabel' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'labelcolor',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav li{{CURRENT_ITEM}} a .plus-nav-label-text,{{WRAPPER}} .plus-mobile-menu .navbar-nav li{{CURRENT_ITEM}} a .plus-nav-label-text' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'showlabel' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'labelBgcolor',
			array(
				'label'     => esc_html__( 'Background Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav li{{CURRENT_ITEM}} a .plus-nav-label-text,{{WRAPPER}} .plus-mobile-menu .navbar-nav li{{CURRENT_ITEM}} a .plus-nav-label-text' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'showlabel' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'menuiconTy',
			array(
				'label'   => esc_html__( 'Menu Icon Type', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => array(
					''     => esc_html__( 'None', 'tpebl' ),
					'icon' => esc_html__( 'Icon', 'tpebl' ),
					'img'  => esc_html__( 'Image', 'tpebl' ),
				),
			)
		);
		$repeater->add_control(
			'preicon',
			array(
				'label'     => esc_html__( 'Select Icon', 'tpebl' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-home',
					'library' => 'solid',
				),
				'condition' => array(
					'menuiconTy' => 'icon',
				),
			)
		);
		$repeater->add_control(
			'menuImg',
			array(
				'label'     => esc_html__( 'Upload Icon Image', 'tpebl' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'menuiconTy' => 'img',
				),
			)
		);
		$repeater->start_controls_tabs( 'tab_mega_menu_rep' );
		$repeater->start_controls_tab(
			'tab_mega_menu_Nml',
			array(
				'label'     => esc_html__( 'Normal', 'tpebl' ),
				'condition' => array(
					'menuiconTy!' => '',
				),
			)
		);
		$repeater->add_responsive_control(
			'iconPadding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-inner .plus-navigation-menu .navbar-nav li.dropdown .dropdown-menu li{{CURRENT_ITEM}} >a span.plus-navicon-wrap .plus-nav-icon-menu,{{WRAPPER}} .plus-navigation-menu .navbar-nav>li{{CURRENT_ITEM}} >a>span.plus-navicon-wrap .plus-nav-icon-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$repeater->add_control(
			'iconcolor',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-inner .plus-navigation-menu .navbar-nav li.dropdown .dropdown-menu li{{CURRENT_ITEM}} >a span.plus-navicon-wrap .plus-nav-icon-menu,{{WRAPPER}} .plus-navigation-menu .navbar-nav>li{{CURRENT_ITEM}} >a>span.plus-navicon-wrap .plus-nav-icon-menu' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'menuiconTy' => 'icon',
				),
			)
		);
		$repeater->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'iconBg',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .plus-navigation-inner .plus-navigation-menu .navbar-nav li{{CURRENT_ITEM}} >a span.plus-navicon-wrap,{{WRAPPER}} .plus-navigation-inner .plus-navigation-menu .navbar-nav li.dropdown .dropdown-menu li{{CURRENT_ITEM}} >a span.plus-navicon-wrap',
				'condition' => array(
					'menuiconTy!' => '',
				),
			)
		);
		$repeater->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'iconborcolor',
				'label'     => esc_html__( 'Border', 'tpebl' ),
				'selector'  => '{{WRAPPER}} .plus-navigation-inner .plus-navigation-menu .navbar-nav li.dropdown .dropdown-menu li{{CURRENT_ITEM}} >a span.plus-navicon-wrap,{{WRAPPER}} .plus-navigation-menu .navbar-nav>li{{CURRENT_ITEM}} >a>span.plus-navicon-wrap',
				'condition' => array(
					'menuiconTy!' => '',
				),
			)
		);
		$repeater->end_controls_tab();
		$repeater->start_controls_tab(
			'tab_mega_menu_Hvr',
			array(
				'label'     => esc_html__( 'Hover', 'tpebl' ),
				'condition' => array(
					'menuiconTy!' => '',
				),
			)
		);
		$repeater->add_responsive_control(
			'iconHvrPadding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-inner .plus-navigation-menu .navbar-nav li.dropdown .dropdown-menu li{{CURRENT_ITEM}}:hover>a span.plus-navicon-wrap .plus-nav-icon-menu,{{WRAPPER}} .plus-navigation-menu .navbar-nav>li{{CURRENT_ITEM}}:hover>a>span.plus-navicon-wrap .plus-nav-icon-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$repeater->add_control(
			'iconHvrcolor',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-inner .plus-navigation-menu .navbar-nav li.dropdown .dropdown-menu li{{CURRENT_ITEM}}:hover>a span.plus-navicon-wrap,{{WRAPPER}} .plus-navigation-menu .navbar-nav>li{{CURRENT_ITEM}}:hover>a>span.plus-navicon-wrap' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'menuiconTy' => 'icon',
				),
			)
		);
		$repeater->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'iconHvrBg',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .plus-navigation-inner .plus-navigation-menu .navbar-nav li{{CURRENT_ITEM}}:hover>a span.plus-navicon-wrap,{{WRAPPER}} .plus-navigation-inner .plus-navigation-menu .navbar-nav li.dropdown .dropdown-menu li{{CURRENT_ITEM}}:hover>a span.plus-navicon-wrap',
				'condition' => array(
					'menuiconTy!' => '',
				),
			)
		);
		$repeater->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'iconhvrborcolor',
				'label'     => esc_html__( 'Border', 'tpebl' ),
				'selector'  => '{{WRAPPER}} .plus-navigation-inner .plus-navigation-menu .navbar-nav li.dropdown .dropdown-menu li{{CURRENT_ITEM}}:hover>a span.plus-navicon-wrap .plus-nav-icon-menu,{{WRAPPER}} .plus-navigation-menu .navbar-nav>li{{CURRENT_ITEM}}:hover>a>.plus-navicon-wrap .plus-nav-icon-menu',
				'condition' => array(
					'menuiconTy!' => '',
				),
			)
		);
		$repeater->end_controls_tab();
		$repeater->start_controls_tab(
			'tab_mega_menu_Act',
			array(
				'label'     => esc_html__( 'Active', 'tpebl' ),
				'condition' => array(
					'menuiconTy!' => '',
				),
			)
		);
		$repeater->add_responsive_control(
			'iconActPadding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-inner .plus-navigation-menu .navbar-nav li.dropdown .dropdown-menu li{{CURRENT_ITEM}}.active>a span.plus-navicon-wrap .plus-nav-icon-menu,{{WRAPPER}} .plus-navigation-menu .navbar-nav>li{{CURRENT_ITEM}}.active>a>.plus-navicon-wrap .plus-nav-icon-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$repeater->add_control(
			'iconActcolor',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-inner .plus-navigation-menu .navbar-nav li.dropdown .dropdown-menu li{{CURRENT_ITEM}}.active>a span.plus-navicon-wrap,{{WRAPPER}} .plus-navigation-menu .navbar-nav>li{{CURRENT_ITEM}}.active>a>.plus-navicon-wrap' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'menuiconTy' => 'icon',
				),
			)
		);
		$repeater->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'iconActBg',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .plus-navigation-menu .navbar-nav li{{CURRENT_ITEM}}.active>a span.plus-navicon-wrap,{{WRAPPER}} .plus-navigation-inner .plus-navigation-menu .navbar-nav li.dropdown .dropdown-menu li{{CURRENT_ITEM}}.active>a span.plus-navicon-wrap',
				'condition' => array(
					'menuiconTy!' => '',
				),
			)
		);
		$repeater->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'iconActborcolor',
				'label'     => esc_html__( 'Border', 'tpebl' ),
				'selector'  => '{{WRAPPER}} .plus-navigation-inner .plus-navigation-menu .navbar-nav li.dropdown .dropdown-menu li{{CURRENT_ITEM}}.active>a span.plus-navicon-wrap .plus-nav-icon-menu,{{WRAPPER}} .plus-navigation-menu .navbar-nav>li{{CURRENT_ITEM}}.active>a>.plus-navicon-wrap .plus-nav-icon-menu',
				'condition' => array(
					'menuiconTy!' => '',
				),
			)
		);
		$repeater->end_controls_tab();
		$repeater->end_controls_tabs();
		$repeater->add_control(
			'navDesc',
			array(
				'label'       => esc_html__( 'Description', 'tpebl' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 3,
				'default'     => '',
				'placeholder' => esc_html__( 'Enter Description', 'tpebl' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);
		$repeater->add_control(
			'classTxt',
			array(
				'label'       => esc_html__( 'Custom Class', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'Enter Class Name', 'tpebl' ),
				'dynamic'     => array(
					'active' => true,
				),
				'label_block' => true,
			)
		);
		$this->add_control(
			'ItemMenu',
			array(
				'label'       => esc_html__( 'Navigation Menu', 'tpebl' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'depth' => '0',
					),
				),
				'title_field' => 'Level {{{ depth }}}',
				'condition'   => array(
					'TypeMenu' => 'custom',
				),
			)
		);
		$this->add_control(
			'navbar',
			array(
				'label'     => __( 'Select Menu', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => l_theplus_navigation_menulist(),
				'condition' => array(
					'TypeMenu' => 'standard',
				),
			)
		);
		$this->add_control(
			'menu_hover_click',
			array(
				'label'   => __( 'Menu Hover/Click', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'hover',
				'options' => array(
					'hover' => __( 'Hover Sub-Menu', 'tpebl' ),
					'click' => __( 'Click Sub-Menu', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_hovermenu',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "open-elementor-submenu-dropdown-on-hover-for-free/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'menu_hover_click' => array( 'hover' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_clickmenu',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "open-elementor-submenu-dropdown-on-click-for-free/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'menu_hover_click' => array( 'click' ),
				),
			)
		);
		$this->add_control(
			'menu_transition',
			array(
				'label'   => __( 'Menu Effects', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => array(
					'style-1' => __( 'Style 1', 'tpebl' ),
					'style-2' => __( 'Style 2', 'tpebl' ),
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_extra_options',
			array(
				'label' => __( 'Extra Options', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'nav_alignment',
			array(
				'label'       => __( 'Alignment', 'tpebl' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => array(
					'text-left'   => array(
						'title' => __( 'Left', 'tpebl' ),
						'icon'  => 'eicon-text-align-left',
					),
					'text-center' => array(
						'title' => __( 'Center', 'tpebl' ),
						'icon'  => 'eicon-text-align-center',
					),
					'text-right'  => array(
						'title' => __( 'Right', 'tpebl' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'separator'   => 'before',
				'default'     => 'text-center',
				'toggle'      => true,
				'label_block' => false,
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_mobile_menu_options',
			array(
				'label' => __( 'Mobile Menu', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'show_mobile_menu',
			array(
				'label'     => wp_kses_post( "Responsive Mobile Menu <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "create-an-elementor-hamburger-toggle-menu-for-mobile-for-free/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => __( 'Show', 'tpebl' ),
				'label_off' => __( 'Hide', 'tpebl' ),
				'default'   => 'yes',
			)
		);
		$this->add_control(
			'open_mobile_menu',
			array(
				'label'      => __( 'Open Mobile Menu', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1500,
						'step' => 5,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 991,
				),
				'condition'  => array(
					'show_mobile_menu' => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_menu_toggle_style',
			array(
				'label'     => __( 'Toggle Style', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style-1',
				'options'   => array(
					'style-1' => __( 'Style 1', 'tpebl' ),
				),
				'condition' => array(
					'show_mobile_menu' => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_toggle_alignment',
			array(
				'label'       => __( 'Toggle Alignment', 'tpebl' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => array(
					'flex-start' => array(
						'title' => __( 'Left', 'tpebl' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center'     => array(
						'title' => __( 'Center', 'tpebl' ),
						'icon'  => 'eicon-text-align-center',
					),
					'flex-end'   => array(
						'title' => __( 'Right', 'tpebl' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'separator'   => 'before',
				'default'     => 'flex-end',
				'toggle'      => true,
				'label_block' => false,
				'selectors'   => array(
					'{{WRAPPER}} .plus-mobile-nav-toggle.mobile-toggle' => 'justify-content: {{VALUE}}',
				),
				'condition'   => array(
					'show_mobile_menu' => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_nav_alignment',
			array(
				'label'       => __( 'Mobile Navigation Alignment', 'tpebl' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => array(
					'left'   => array(
						'title' => __( 'Left', 'tpebl' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'tpebl' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => __( 'Right', 'tpebl' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'separator'   => 'before',
				'default'     => 'flex-start',
				'toggle'      => true,
				'label_block' => false,
				'selectors'   => array(
					'{{WRAPPER}} .plus-mobile-menu-content .nav li a' => 'text-align: {{VALUE}}',
				),
				'condition'   => array(
					'show_mobile_menu' => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_menu_content',
			array(
				'label'     => __( 'Menu Content', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'normal-menu',
				'options'   => array(
					'normal-menu'   => __( 'Normal Menu', 'tpebl' ),
					'template-menu' => __( 'Template Menu', 'tpebl' ),
				),
				'condition' => array(
					'show_mobile_menu' => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_navbar',
			array(
				'label'     => __( 'Select Menu', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => l_theplus_navigation_menulist(),
				'condition' => array(
					'show_mobile_menu'    => 'yes',
					'mobile_menu_content' => 'normal-menu',
				),
			)
		);
		$this->add_control(
			'mobile_navbar_template',
			array(
				'label'       => esc_html__( 'Elementor Templates', 'tpebl' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '0',
				'options'     => L_theplus_get_templates(),
				'label_block' => 'true',
				'condition'   => array(
					'show_mobile_menu' => 'yes',
				),
				'condition'   => array(
					'show_mobile_menu'    => 'yes',
					'mobile_menu_content' => 'template-menu',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'main_menu_styling',
			array(
				'label' => __( 'Main Menu', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'main_menu_typography',
				'label'    => __( 'Typography', 'tpebl' ),
				'selector' => '{{WRAPPER}} .plus-navigation-menu .navbar-nav>li>a',
			)
		);
		$this->add_responsive_control(
			'main_menu_outer_padding',
			array(
				'label'      => __( 'Outer Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'default'    => array(
					'top'      => '5',
					'right'    => '5',
					'bottom'   => '5',
					'left'     => '5',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav>li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_responsive_control(
			'main_menu_inner_padding',
			array(
				'label'      => __( 'Inner Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'default'    => array(
					'top'      => '10',
					'right'    => '5',
					'bottom'   => '10',
					'left'     => '5',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav>li>a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
					'{{WRAPPER}} .plus-navigation-wrap .plus-navigation-inner.main-menu-indicator-style-2 .plus-navigation-menu .navbar-nav > li.dropdown > a:before' => 'right: calc({{RIGHT}}{{UNIT}} + 3px);',
				),
			)
		);
		$this->add_control(
			'main_menu_indicator_style',
			array(
				'label'     => __( 'Main Menu Indicator Style', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'none',
				'options'   => array(
					'none'    => __( 'None', 'tpebl' ),
					'style-1' => __( 'Style 1', 'tpebl' ),
				),
				'separator' => 'after',
			)
		);
		$this->start_controls_tabs( 'tabs_main_menu_style' );
		$this->start_controls_tab(
			'tab_main_menu_normal',
			array(
				'label' => __( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'main_menu_normal_color',
			array(
				'label'     => __( 'Normal Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav>li>a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'main_menu_normal_icon_color',
			array(
				'label'     => __( 'Icon Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-wrap .plus-navigation-inner.main-menu-indicator-style-1 .plus-navigation-menu .navbar-nav > li.dropdown > a:after' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'main_menu_indicator_style!' => 'none',
				),
			)
		);
		$this->add_control(
			'main_menu_border',
			array(
				'label'     => __( 'Box Border', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => __( 'Show', 'tpebl' ),
				'label_off' => __( 'Hide', 'tpebl' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'main_menu_normal_border_style',
			array(
				'label'     => __( 'Border Style', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'solid',
				'options'   => array(
					'none'   => __( 'None', 'tpebl' ),
					'solid'  => __( 'Solid', 'tpebl' ),
					'dotted' => __( 'Dotted', 'tpebl' ),
					'dashed' => __( 'Dashed', 'tpebl' ),
					'groove' => __( 'Groove', 'tpebl' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav>li>a' => 'border-style: {{VALUE}};',
				),
				'condition' => array(
					'main_menu_border' => 'yes',
				),
			)
		);
		$this->add_control(
			'main_menu_normal_border_color',
			array(
				'label'     => __( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav>li>a' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'main_menu_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'main_menu_normal_border_width',
			array(
				'label'      => __( 'Border Width', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'top'    => 1,
					'right'  => 1,
					'bottom' => 1,
					'left'   => 1,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav>li>a' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'main_menu_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'main_menu_normal_radius',
			array(
				'label'      => __( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav>li>a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'main_menu_normal_bg_options',
			array(
				'label'     => __( 'Normal Background Options', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'main_menu_normal_bg_color',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .plus-navigation-menu .navbar-nav>li>a',

			)
		);
		$this->add_control(
			'main_menu_normal_shadow_options',
			array(
				'label'     => __( 'Shadow Options', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'main_menu_normal_shadow',
				'selector' => '{{WRAPPER}} .plus-navigation-menu .navbar-nav>li>a',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_main_menu_hover',
			array(
				'label' => __( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'main_menu_hover_color',
			array(
				'label'     => __( 'Hover Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ff5a6e',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav > li:hover > a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'main_menu_hover_icon_color',
			array(
				'label'     => __( 'Hover Icon Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-wrap .plus-navigation-inner.main-menu-indicator-style-1 .plus-navigation-menu .navbar-nav > li.dropdown:hover > a:after' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'main_menu_indicator_style!' => 'none',
				),
			)
		);
		$this->add_control(
			'main_menu_hover_border_color',
			array(
				'label'     => __( 'Hover Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav > li:hover > a' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'main_menu_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'main_menu_hover_radius',
			array(
				'label'      => __( 'Hover Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav > li:hover > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'main_menu_hover_bg_options',
			array(
				'label'     => __( 'Hover Background Options', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'main_menu_hover_bg_color',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .plus-navigation-menu .navbar-nav > li:hover > a',

			)
		);
		$this->add_control(
			'main_menu_hover_shadow_options',
			array(
				'label'     => __( 'Hover Shadow Options', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'main_menu_hover_shadow',
				'selector' => '{{WRAPPER}} .plus-navigation-menu .navbar-nav > li:hover > a',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_main_menu_active',
			array(
				'label' => __( 'Active', 'tpebl' ),
			)
		);
		$this->add_control(
			'main_menu_active_color',
			array(
				'label'     => __( 'Active Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ff5a6e',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav > li.active > a,{{WRAPPER}} .plus-navigation-menu .navbar-nav > li:focus > a,{{WRAPPER}} .plus-navigation-menu .navbar-nav > li.current_page_item > a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'main_menu_active_icon_color',
			array(
				'label'     => __( 'Hover Icon Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-wrap .plus-navigation-inner.main-menu-indicator-style-1 .plus-navigation-menu .navbar-nav > li.dropdown.active > a:after,{{WRAPPER}} .plus-navigation-wrap .plus-navigation-inner.main-menu-indicator-style-1 .plus-navigation-menu .navbar-nav > li.dropdown:focus > a:after,{{WRAPPER}} .plus-navigation-wrap .plus-navigation-inner.main-menu-indicator-style-1 .plus-navigation-menu .navbar-nav > li.dropdown.current_page_item > a:after' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'main_menu_indicator_style!' => 'none',
				),
			)
		);
		$this->add_control(
			'main_menu_active_border_color',
			array(
				'label'     => __( 'Active Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav > li.active > a,{{WRAPPER}} .plus-navigation-menu .navbar-nav > li:focus > a,{{WRAPPER}} .plus-navigation-menu .navbar-nav > li.current_page_item > a' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'main_menu_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'main_menu_active_radius',
			array(
				'label'      => __( 'Active Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav > li.active > a,{{WRAPPER}} .plus-navigation-menu .navbar-nav > li:focus > a,{{WRAPPER}} .plus-navigation-menu .navbar-nav > li.current_page_item > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'main_menu_active_bg_options',
			array(
				'label'     => __( 'Active Background Options', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'main_menu_active_bg_color',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .plus-navigation-menu .navbar-nav > li.active > a,{{WRAPPER}} .plus-navigation-menu .navbar-nav > li:focus > a,{{WRAPPER}} .plus-navigation-menu .navbar-nav > li.current_page_item > a',

			)
		);
		$this->add_control(
			'main_menu_active_shadow_options',
			array(
				'label'     => __( 'Active Shadow Options', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'main_menu_active_shadow',
				'selector' => '{{WRAPPER}} .plus-navigation-menu .navbar-nav > li.active > a,{{WRAPPER}} .plus-navigation-menu .navbar-nav > li:focus > a,{{WRAPPER}} .plus-navigation-menu .navbar-nav > li.current_page_item > a',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'sub_menu_styling',
			array(
				'label' => __( 'Sub Menu', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'sub_menu_typography',
				'label'    => __( 'Typography', 'tpebl' ),
				'selector' => '{{WRAPPER}} .plus-navigation-menu .nav li.dropdown .dropdown-menu > li > a',
			)
		);
		$this->add_control(
			'sub_menu_outer_options',
			array(
				'label'     => __( 'Sub-Menu Outer Options', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'sub_menu_outer_padding',
			array(
				'label'      => __( 'Outer Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'default'    => array(
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => true,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-menu .nav li.dropdown .dropdown-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
					'{{WRAPPER}} .plus-navigation-menu .nav li.dropdown .dropdown-menu .dropdown-menu' => 'margin-top: {{TOP}}{{UNIT}};',
					'{{WRAPPER}} .plus-navigation-menu .nav li.dropdown .dropdown-menu .dropdown-menu' => 'left: calc(100% + {{RIGHT}}{{UNIT}});',
				),
			)
		);
		$this->add_control(
			'sub_menu_outer_border',
			array(
				'label'     => __( 'Box Border', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => __( 'Show', 'tpebl' ),
				'label_off' => __( 'Hide', 'tpebl' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'sub_menu_outer_border_style',
			array(
				'label'     => __( 'Border Style', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'solid',
				'options'   => array(
					'none'   => __( 'None', 'tpebl' ),
					'solid'  => __( 'Solid', 'tpebl' ),
					'dotted' => __( 'Dotted', 'tpebl' ),
					'dashed' => __( 'Dashed', 'tpebl' ),
					'groove' => __( 'Groove', 'tpebl' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-menu .nav li.dropdown .dropdown-menu' => 'border-style: {{VALUE}};',
				),
				'condition' => array(
					'sub_menu_outer_border' => 'yes',
				),
			)
		);
		$this->add_control(
			'sub_menu_outer_border_color',
			array(
				'label'     => __( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-menu .nav li.dropdown .dropdown-menu' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'sub_menu_outer_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'sub_menu_outer_border_width',
			array(
				'label'      => __( 'Border Width', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'top'    => 1,
					'right'  => 1,
					'bottom' => 1,
					'left'   => 1,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-menu .nav li.dropdown .dropdown-menu' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'sub_menu_outer_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'sub_menu_outer_radius',
			array(
				'label'      => __( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-menu .nav li.dropdown .dropdown-menu' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'sub_menu_outer_bg_color',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .plus-navigation-menu .nav li.dropdown .dropdown-menu',

			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'sub_menu_outer_shadow',
				'selector'  => '{{WRAPPER}} .plus-navigation-menu .nav li.dropdown .dropdown-menu',
				'separator' => 'after',
			)
		);
		$this->add_control(
			'sub_menu_inner_options',
			array(
				'label'     => __( 'Sub-Menu Inner Options', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'sub_menu_inner_padding',
			array(
				'label'      => __( 'Inner Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'default'    => array(
					'top'      => '10',
					'right'    => '15',
					'bottom'   => '10',
					'left'     => '15',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-menu:not(.menu-vertical) .nav li.dropdown .dropdown-menu > li,{{WRAPPER}} .plus-navigation-menu.menu-vertical .nav li.dropdown .dropdown-menu > li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}  !important;',
				),
			)
		);
		$this->add_control(
			'sub_menu_indicator_style',
			array(
				'label'     => __( 'Sub Menu Indicator Style', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'none',
				'options'   => array(
					'none'    => __( 'None', 'tpebl' ),
					'style-1' => __( 'Style 1', 'tpebl' ),
					'style-2' => __( 'Style 2', 'tpebl' ),
				),
				'separator' => 'after',
			)
		);
		$this->start_controls_tabs( 'tabs_sub_menu_style' );
		$this->start_controls_tab(
			'tab_sub_menu_normal',
			array(
				'label' => __( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'sub_menu_normal_color',
			array(
				'label'     => __( 'Normal Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-menu .nav li.dropdown .dropdown-menu > li > a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'sub_menu_normal_icon_color',
			array(
				'label'     => __( 'Icon Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-wrap .plus-navigation-inner.sub-menu-indicator-style-1 .plus-navigation-menu .navbar-nav ul.dropdown-menu > li.dropdown-submenu > a:after' => 'color: {{VALUE}}',
					'{{WRAPPER}} .plus-navigation-wrap .plus-navigation-inner.sub-menu-indicator-style-2 .plus-navigation-menu .navbar-nav ul.dropdown-menu > li.dropdown-submenu > a:before,{{WRAPPER}}  .plus-navigation-wrap .plus-navigation-inner.sub-menu-indicator-style-2 .plus-navigation-menu .navbar-nav ul.dropdown-menu > li.dropdown-submenu > a:after' => 'background: {{VALUE}}',
					'{{WRAPPER}} .plus-navigation-wrap .plus-navigation-inner.sub-menu-indicator-style-2 .plus-navigation-menu .navbar-nav ul.dropdown-menu > li.dropdown-submenu > a:before' => 'border-color: {{VALUE}};background: 0 0;',
				),
				'condition' => array(
					'sub_menu_indicator_style!' => 'none',
				),
			)
		);
		$this->add_control(
			'sub_menu_normal_bg_options',
			array(
				'label'     => __( 'Normal Background Options', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'sub_menu_normal_bg_color',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .plus-navigation-menu .nav li.dropdown .dropdown-menu > li',

			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_sub_menu_hover',
			array(
				'label' => __( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'sub_menu_hover_color',
			array(
				'label'     => __( 'Hover Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ff5a6e',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-menu .nav li.dropdown .dropdown-menu > li:hover > a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'sub_menu_hover_icon_color',
			array(
				'label'     => __( 'Hover Icon Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-wrap .plus-navigation-inner.sub-menu-indicator-style-1 .plus-navigation-menu .navbar-nav ul.dropdown-menu > li.dropdown-submenu:hover > a:after' => 'color: {{VALUE}}',
					'{{WRAPPER}} .plus-navigation-wrap .plus-navigation-inner.sub-menu-indicator-style-2 .plus-navigation-menu .navbar-nav ul.dropdown-menu > li.dropdown-submenu:hover > a:before,{{WRAPPER}}  .plus-navigation-wrap .plus-navigation-inner.sub-menu-indicator-style-2 .plus-navigation-menu .navbar-nav ul.dropdown-menu > li.dropdown-submenu:hover > a:after' => 'background: {{VALUE}}',
					'{{WRAPPER}} .plus-navigation-wrap .plus-navigation-inner.sub-menu-indicator-style-2 .plus-navigation-menu .navbar-nav ul.dropdown-menu > li.dropdown-submenu:hover > a:before' => 'border-color: {{VALUE}};background: 0 0;',
				),
				'condition' => array(
					'sub_menu_indicator_style!' => 'none',
				),
			)
		);
		$this->add_control(
			'sub_menu_hover_bg_options',
			array(
				'label'     => __( 'Hover Background Options', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'sub_menu_hover_bg_color',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .plus-navigation-menu .nav li.dropdown .dropdown-menu > li:hover',

			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_sub_menu_active',
			array(
				'label' => __( 'Active', 'tpebl' ),
			)
		);
		$this->add_control(
			'sub_menu_active_color',
			array(
				'label'     => __( 'Active Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ff5a6e',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav li.dropdown .dropdown-menu > li.active > a,{{WRAPPER}} .plus-navigation-menu .navbar-nav li.dropdown .dropdown-menu > li:focus > a,{{WRAPPER}} .plus-navigation-menu .navbar-nav li.dropdown .dropdown-menu > li.current_page_item > a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'sub_menu_active_icon_color',
			array(
				'label'     => __( 'Active Icon Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-wrap .plus-navigation-inner.sub-menu-indicator-style-1 .plus-navigation-menu .navbar-nav ul.dropdown-menu > li.dropdown-submenu.active > a:after,{{WRAPPER}} .plus-navigation-wrap .plus-navigation-inner.sub-menu-indicator-style-1 .plus-navigation-menu .navbar-nav ul.dropdown-menu > li.dropdown-submenu:focus > a:after,{{WRAPPER}} .plus-navigation-wrap .plus-navigation-inner.sub-menu-indicator-style-1 .plus-navigation-menu .navbar-nav ul.dropdown-menu > li.dropdown-submenu.current_page_item > a:after' => 'color: {{VALUE}}',
					'{{WRAPPER}} .plus-navigation-wrap .plus-navigation-inner.sub-menu-indicator-style-2 .plus-navigation-menu .navbar-nav ul.dropdown-menu > li.dropdown-submenu.active > a:before,{{WRAPPER}} .plus-navigation-wrap .plus-navigation-inner.sub-menu-indicator-style-2 .plus-navigation-menu .navbar-nav ul.dropdown-menu > li.dropdown-submenu:focus > a:before,{{WRAPPER}} .plus-navigation-wrap .plus-navigation-inner.sub-menu-indicator-style-2 .plus-navigation-menu .navbar-nav ul.dropdown-menu > li.dropdown-submenu.current_page_item > a:before,{{WRAPPER}}  .plus-navigation-wrap .plus-navigation-inner.sub-menu-indicator-style-2 .plus-navigation-menu .navbar-nav ul.dropdown-menu > li.dropdown-submenu.active > a:after,{{WRAPPER}}  .plus-navigation-wrap .plus-navigation-inner.sub-menu-indicator-style-2 .plus-navigation-menu .navbar-nav ul.dropdown-menu > li.dropdown-submenu:focus > a:after,{{WRAPPER}}  .plus-navigation-wrap .plus-navigation-inner.sub-menu-indicator-style-2 .plus-navigation-menu .navbar-nav ul.dropdown-menu > li.dropdown-submenu.current_page_item > a:after' => 'background: {{VALUE}}',
					'{{WRAPPER}} .plus-navigation-wrap .plus-navigation-inner.sub-menu-indicator-style-2 .plus-navigation-menu .navbar-nav ul.dropdown-menu > li.dropdown-submenu.active > a:before,{{WRAPPER}} .plus-navigation-wrap .plus-navigation-inner.sub-menu-indicator-style-2 .plus-navigation-menu .navbar-nav ul.dropdown-menu > li.dropdown-submenu:focus > a:before,{{WRAPPER}} .plus-navigation-wrap .plus-navigation-inner.sub-menu-indicator-style-2 .plus-navigation-menu .navbar-nav ul.dropdown-menu > li.dropdown-submenu.current_page_item > a:before' => 'border-color: {{VALUE}};background: 0 0;',
				),
				'condition' => array(
					'sub_menu_indicator_style!' => 'none',
				),
			)
		);
		$this->add_control(
			'sub_menu_active_bg_options',
			array(
				'label'     => __( 'Active Background Options', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'sub_menu_active_bg_color',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .plus-navigation-menu .navbar-nav li.dropdown .dropdown-menu > li.active,{{WRAPPER}} .plus-navigation-menu .navbar-nav li.dropdown .dropdown-menu > li:focus,{{WRAPPER}} .plus-navigation-menu .navbar-nav li.dropdown .dropdown-menu > li.current_page_item',

			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'mobile_nav_options_styling',
			array(
				'label'     => __( 'Mobile Menu Style', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'show_mobile_menu' => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_nav_toggle_options',
			array(
				'label'     => __( 'Toggle Navigation Style', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'mobile_nav_toggle_height',
			array(
				'label'      => __( 'Toggle Height', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-mobile-nav-toggle.mobile-toggle' => 'min-height: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'toggle_menu_gap',
			array(
				'label'      => __( 'Toggle Bottom Space', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu-content' => 'margin-top: {{SIZE}}{{UNIT}};',
				),
			)
		);		
		$this->add_responsive_control(
			'mobile_menu_border_main',
			array(
				'label'      => esc_html__( 'Border Bottom Size', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 10,
						'step' => 1,
					),
				),
				'separator'  => array( 'before', 'after' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu .navbar-nav li a' => 'border-width: {{SIZE}}{{UNIT}};',
				),
			)
		); 
		$this->start_controls_tabs( 'tab_toggle_nav_style' );
		$this->start_controls_tab(
			'tab_toggle_nav_normal',
			array(
				'label' => __( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'toggle_nav_color',
			array(
				'label'     => __( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ff5a6e',
				'selectors' => array(
					'{{WRAPPER}} .mobile-plus-toggle-menu ul.toggle-lines li.toggle-line' => 'background: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_toggle_nav_active',
			array(
				'label' => __( 'Active', 'tpebl' ),
			)
		);
		$this->add_control(
			'toggle_nav_active_color',
			array(
				'label'     => __( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ff5a6e',
				'selectors' => array(
					'{{WRAPPER}} .mobile-plus-toggle-menu:not(.collapsed) ul.toggle-lines li.toggle-line' => 'background: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'mobile_main_menu_options',
			array(
				'label'     => __( 'Mobile Main Menu Style', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'mobile_main_menu_typography',
				'label'    => __( 'Typography', 'tpebl' ),
				'selector' => '{{WRAPPER}} .plus-mobile-menu .navbar-nav>li>a',
			)
		);
		$this->add_responsive_control(
			'mobile_main_menu_margin',
			array(
				'label'      => esc_html__( 'Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-mobile-menu .navbar-nav li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'mobile_main_menu_inner_padding',
			array(
				'label'      => __( 'Inner Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'default'    => array(
					'top'      => '10',
					'right'    => '10',
					'bottom'   => '10',
					'left'     => '10',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-mobile-menu .navbar-nav>li>a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_mobile_main_menu_style' );
		$this->start_controls_tab(
			'tab_mobile_main_menu_normal',
			array(
				'label' => __( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'mobile_main_menu_normal_color',
			array(
				'label'     => __( 'Normal Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .plus-mobile-menu .navbar-nav>li>a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'mobile_main_menu_normal_icon_color',
			array(
				'label'     => __( 'Icon Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu .navbar-nav > li.dropdown > a:after' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'mobile_main_menu_normal_bg_options',
			array(
				'label'     => __( 'Background Options', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'mobile_main_menu_normal_bg_color',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu .navbar-nav>li>a',

			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_mobile_main_menu_active',
			array(
				'label' => __( 'Active', 'tpebl' ),
			)
		);
		$this->add_control(
			'mobile_main_menu_active_color',
			array(
				'label'     => __( 'Active Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ff5a6e',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu .navbar-nav > li.active > a,{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu .navbar-nav > li:focus > a,{{WRAPPER}} .plus-mobile-menu .navbar-nav > li.current_page_item > a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'mobile_main_menu_active_icon_color',
			array(
				'label'     => __( 'Active Icon Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu .navbar-nav > li.dropdown.active > a:after,{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu .navbar-nav > li.dropdown:focus > a:after,{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu .navbar-nav > li.dropdown.current_page_item > a:after' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'mobile_main_menu_active_bg_options',
			array(
				'label'     => __( 'Active Background Options', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'mobile_main_menu_active_bg_color',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu .navbar-nav > li.dropdown.active > a,{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu .navbar-nav > li.dropdown:focus > a,{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu .navbar-nav > li.dropdown.current_page_item > a',

			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'mobile_menu_border_color',
			array(
				'label'     => __( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'separator' => array( 'before', 'after' ),
				'selectors' => array(
					'{{WRAPPER}} .plus-mobile-nav-toggle .plus-mobile-menu .navbar-nav li a' => 'border-bottom-color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'mobile_sub_menu_options',
			array(
				'label'     => __( 'Mobile Sub Menu Style', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'mobile_sub_menu_typography',
				'label'    => __( 'Typography', 'tpebl' ),
				'selector' => '{{WRAPPER}} .plus-mobile-menu .nav li.dropdown .dropdown-menu > li > a',
			)
		);
		$this->add_responsive_control(
			'mobile_sub_menu_margin',
			array(
				'label'      => esc_html__( 'Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-mobile-menu .nav li.dropdown .dropdown-menu li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'mobile_sub_menu_inner_padding',
			array(
				'label'      => __( 'Inner Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'default'    => array(
					'top'      => '10',
					'right'    => '10',
					'bottom'   => '10',
					'left'     => '15',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-mobile-menu .nav li.dropdown .dropdown-menu > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_mobile_sub_menu_style' );
		$this->start_controls_tab(
			'tab__mobile_sub_menu_normal',
			array(
				'label' => __( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'mobile_sub_menu_normal_color',
			array(
				'label'     => __( 'Normal Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .plus-mobile-menu .nav li.dropdown .dropdown-menu > li > a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'mobile_sub_menu_normal_icon_color',
			array(
				'label'     => __( 'Icon Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu .nav li.dropdown .dropdown-menu > li > a:after' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'mobile_sub_menu_normal_bg_options',
			array(
				'label'     => __( 'Background Options', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'mobile_sub_menu_normal_bg_color',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu .nav li.dropdown .dropdown-menu > li > a',

			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_mobile_sub_menu_active',
			array(
				'label' => __( 'Active', 'tpebl' ),
			)
		);
		$this->add_control(
			'mobile_sub_menu_active_color',
			array(
				'label'     => __( 'Active Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ff5a6e',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu .navbar-nav li.dropdown .dropdown-menu > li.active > a,{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu .navbar-nav li.dropdown .dropdown-menu > li:focus > a,{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu .navbar-nav li.dropdown .dropdown-menu > li.current_page_item > a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'mobile_sub_menu_active_icon_color',
			array(
				'label'     => __( 'Active Icon Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu .navbar-nav ul.dropdown-menu > li.dropdown-submenu.active > a:after,{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu .navbar-nav ul.dropdown-menu > li.dropdown-submenu:focus > a:after,{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu .navbar-nav ul.dropdown-menu > li.dropdown-submenu.current_page_item > a:after' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'mobile_sub_menu_active_bg_options',
			array(
				'label'     => __( 'Active Background Options', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'mobile_sub_menu_active_bg_color',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu .navbar-nav li.dropdown .dropdown-menu > li.active > a,{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu .navbar-nav li.dropdown .dropdown-menu > li:focus > a,{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu .navbar-nav li.dropdown .dropdown-menu > li.current_page_item > a',

			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'extra_options_styling',
			array(
				'label' => __( 'Extra Options', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'main_menu_hover_style',
			array(
				'label'   => __( 'Main Menu Hover Effects', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => array(
					'none'    => __( 'None', 'tpebl' ),
					'style-1' => __( 'Style 1', 'tpebl' ),
					'style-2' => __( 'Style 2', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'border-height',
			array(
				'label'      => __( 'Border Width', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 30,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 1,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav.menu-hover-style-2 > li > a:after,{{WRAPPER}} .plus-navigation-menu .navbar-nav.menu-hover-style-2 > li > a:before' => 'height: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'main_menu_hover_style' => array( 'style-2' ),
				),
			)
		);
		$this->add_control(
			'alignment-border-adjust',
			array(
				'label'      => __( 'Alignment Border Adjust', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 2,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav.menu-hover-style-2 > li > a:after,{{WRAPPER}} .plus-navigation-menu .navbar-nav.menu-hover-style-2 > li > a:before' => 'bottom : {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'main_menu_hover_style' => array( 'style-2' ),
				),
			)
		);
		$this->add_control(
			'main_menu_hover_style_1_color',
			array(
				'label'     => __( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#222',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav.menu-hover-style-1 > li > a:before,{{WRAPPER}} .plus-navigation-menu .navbar-nav.menu-hover-style-2 > li > a:after,{{WRAPPER}} .plus-navigation-menu .navbar-nav.menu-hover-style-2 > li > a:before' => 'background: {{VALUE}}',
				),
				'condition' => array(
					'main_menu_hover_style' => array( 'style-1', 'style-2' ),
				),
			)
		);
		$this->add_control(
			'main_menu_hover_style_2_color',
			array(
				'label'     => __( 'Hover Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#222',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav.menu-hover-style-2 > li > a:hover:after,{{WRAPPER}} .plus-navigation-menu .navbar-nav.menu-hover-style-2 > li > a:hover:before' => 'background: {{VALUE}}',
				),
				'condition' => array(
					'main_menu_hover_style' => array( 'style-2' ),
				),
			)
		);
		$this->add_control(
			'main_menu_hover_style_1_width',
			array(
				'label'      => __( 'Border Width', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 10,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 1,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav.menu-hover-style-1 > li > a:before' => 'height: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'main_menu_hover_style' => 'style-1',
				),
			)
		);
		$this->add_control(
			'main_menu_hover_inverse',
			array(
				'label'     => __( 'On Hover Inverse Effect Main Menu', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => __( 'Show', 'tpebl' ),
				'label_off' => __( 'Hide', 'tpebl' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'main_menu_hover_inverse_pro',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'main_menu_hover_inverse' => 'yes',
				),
			)
		);
		$this->add_control(
			'sub_menu_hover_inverse',
			array(
				'label'     => __( 'On Hover Inverse Effect Sub Menu', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => __( 'Show', 'tpebl' ),
				'label_off' => __( 'Hide', 'tpebl' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'sub_menu_hover_inverse_pro',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'sub_menu_hover_inverse' => 'yes',
				),
			)
		);
		$this->add_control(
			'main_menu_last_open_sub_menu',
			array(
				'label'     => __( 'Main Menu Last Open Sub-menu Left', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => __( 'Show', 'tpebl' ),
				'label_off' => __( 'Hide', 'tpebl' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'main_menu_last_open_sub_menu_pro',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'main_menu_last_open_sub_menu' => 'yes',
				),
			)
		);
		$this->end_controls_section();
		include L_THEPLUS_PATH . 'modules/widgets/theplus-needhelp.php';
		include L_THEPLUS_PATH . 'modules/widgets/theplus-profeatures.php';
	}

	/**
	 * Meeting Scheduler Render.
	 *
	 * @since 1.0.1
	 * @version 5.5.4
	 */
	protected function render() {
		$menu_attr = '';
		$settings  = $this->get_settings_for_display();

		$nav_alignment = ! empty( $settings['nav_alignment'] ) ? $settings['nav_alignment'] : '';

		$menu_hover  = ! empty( $settings['menu_hover_click'] ) ? $settings['menu_hover_click'] : '';
		$navbar_menu = ! empty( $settings['navbar_menu_type'] ) ? $settings['navbar_menu_type'] : '';
		$effects     = ! empty( $settings['menu_transition'] ) ? $settings['menu_transition'] : 'style-1';
		$hover_style = ! empty( $settings['main_menu_hover_style'] ) ? $settings['main_menu_hover_style'] : 'none';

		$main_manu_style = ! empty( $settings['main_menu_indicator_style'] ) ? $settings['main_menu_indicator_style'] : 'none';
		$sub_menu_style  = ! empty( $settings['sub_menu_indicator_style'] ) ? $settings['sub_menu_indicator_style'] : 'none';

		$menu_content = ! empty( $settings['mobile_menu_content'] ) ? $settings['mobile_menu_content'] : '';

		$mob_menu  = ! empty( $settings['show_mobile_menu'] ) ? $settings['show_mobile_menu'] : '';
		$menu_size = ! empty( $settings['open_mobile_menu']['size'] ) ? $settings['open_mobile_menu']['size'] : 991;
		$menu_unit = ! empty( $settings['open_mobile_menu']['unit'] ) ? $settings['open_mobile_menu']['unit'] : 'px';

		$mobile_menu_toggle_style = ! empty( $settings['mobile_menu_toggle_style'] ) ? $settings['mobile_menu_toggle_style'] : 'style-1';

		$menu_hover_click = 'menu-' . $menu_hover;
		$navbar_menu_type = 'menu-' . $navbar_menu;
		$menu_attr       .= ' data-menu_transition="' . esc_attr( $effects ) . '"';

		$main_menu_hover_style     = 'menu-hover-' . $hover_style;
		$main_menu_indicator_style = 'main-menu-indicator-' . $main_manu_style;
		$sub_menu_indicator_style  = 'sub-menu-indicator-' . $sub_menu_style;

		$nav_menu      = ! empty( $settings['navbar'] ) ? wp_get_nav_menu_object( $settings['navbar'] ) : false;
		$mobile_navbar = ! empty( $settings['mobile_navbar'] ) ? wp_get_nav_menu_object( $settings['mobile_navbar'] ) : false;
		$TypeMenu      = ! empty( $settings['TypeMenu'] ) ? $settings['TypeMenu'] : 'standard';

		$navbar_attr = array();

		// if ( ! $nav_menu ) {
		// return;
		// }

		$nav_menu_args = array(
			'menu'            => $nav_menu,
			'theme_location'  => 'default_navmenu',
			'depth'           => 8,
			'container'       => 'div',
			'container_class' => 'plus-navigation-menu ' . $navbar_menu_type,
			'menu_class'      => 'nav navbar-nav yamm ' . $main_menu_hover_style,
			'fallback_cb'     => false,
			'walker'          => new L_Theplus_Navigation_NavWalker(),
		);

		if ( 'yes' === $mob_menu && 'normal-menu' === $menu_content ) {

			$mobile_nav_menu_args = array(
				'menu'            => $mobile_navbar,
				'theme_location'  => 'mobile_navmenu',
				'depth'           => 5,
				'container'       => 'div',
				'container_class' => 'plus-mobile-menu',
				'menu_class'      => 'nav navbar-nav',
				'fallback_cb'     => false,
				'walker'          => new L_Theplus_Navigation_NavWalker(),
			);
		}
		$temp_menu = '';
		if ( 'template-menu' === $menu_content ) {
			$temp_menu = 'template_mobile_menu';
		}

		$uid = uniqid( 'nav-menu' );

		?>

		<div class="plus-navigation-wrap <?php echo esc_attr( $nav_alignment ); ?> <?php echo esc_attr( $uid ); ?>">
			<div class="plus-navigation-inner <?php echo ( $menu_hover_click ); ?> <?php echo esc_attr( $main_menu_indicator_style ); ?> <?php echo esc_attr( $sub_menu_indicator_style ); ?> " <?php echo $menu_attr; ?>>
				<div id="theplus-navigation-normal-menu" class="collapse navbar-collapse navbar-ex1-collapse">
	
					<div class="plus-navigation-menu <?php echo esc_attr( $navbar_menu_type ); ?>">
						
						<?php
						if ( defined( 'JUPITERX_VERSION' ) ) {

							wp_nav_menu( $nav_menu_args );
						} elseif ( ! empty( $TypeMenu ) && $TypeMenu == 'custom' ) {
							echo wp_kses_post( $this->tp_mega_menu( $settings ) );
						} else {
							wp_nav_menu( apply_filters( 'widget_nav_menu_args', $nav_menu_args, $nav_menu, $settings ) );
						}
						?>
					</div>
				</div>

				<?php if ( 'yes' === $mob_menu && ! empty( $mobile_menu_toggle_style ) ) { ?>
				
					<div class="plus-mobile-nav-toggle navbar-header mobile-toggle">
						<div class="mobile-plus-toggle-menu plus-collapsed toggle-<?php echo esc_attr( $mobile_menu_toggle_style ); ?>" data-target="#plus-mobile-nav-toggle-<?php echo esc_attr( $uid ); ?>">
							<?php if ( 'style-1' === $mobile_menu_toggle_style ) { ?>
							<ul class="toggle-lines">
								<li class="toggle-line"></li>
								<li class="toggle-line"></li>
							</ul>
							<?php } ?>
						</div>
					</div>
				
					<div id="plus-mobile-nav-toggle-<?php echo esc_attr( $uid ); ?>"
						class="plus-mobile-menu  collapse navbar-collapse navbar-ex1-collapse plus-mobile-menu-content <?php echo esc_attr( $temp_menu ); ?>">
						<?php

						if ( 'normal-menu' === $menu_content && ! empty( $settings['mobile_navbar'] ) ) {

							if ( defined( 'JUPITERX_VERSION' ) ) {
								wp_nav_menu( $mobile_nav_menu_args );
							} else {
								wp_nav_menu( apply_filters( 'widget_nav_menu_args', $mobile_nav_menu_args, $nav_menu, $settings ) );
							}
						} elseif ( ! empty( $TypeMenu ) && $TypeMenu == 'custom' ) {
							echo wp_kses_post($this->tp_mega_menu( $settings ));
						}
						?>
						<?php

						$mobile_navbar_template = ! empty( $settings['mobile_navbar_template'] ) ? $settings['mobile_navbar_template'] : '';

						$template_status = get_post_status( $mobile_navbar_template );

						if ( 'template-menu' === $menu_content && ! empty( $mobile_navbar_template ) ) {
							if( 'publish' === $template_status ) {
								echo '<div class="plus-content-editor">' . L_Theplus_Element_Load::elementor()->frontend->get_builder_content_for_display( $mobile_navbar_template ) . '</div>';
							} else {
								echo '<div class="tab-preview-template-notice"><div class="preview-temp-notice-heading">' . esc_html__( 'Unauthorized Access', 'tpebl' ) . '</b></div><div class="preview-temp-notice-desc"><b>' . esc_html__( 'Note :', 'tpebl' ) . '</b> ' . esc_html__( 'You need to upgrade your permissions to Editor or Administrator level to update this option.', 'tpebl' ) . '</div></div>';
							}
						}
						?>
					</div>
				<?php } ?>
				
			</div>
		</div>
		 
		<?php

		$css_rule = '';
		if ( 'yes' === $mob_menu && ! empty( $menu_size ) ) {
			$open_mobile_menu  = $menu_size . $menu_unit;
			$close_mobile_menu = ( $menu_size + 1 ) . $menu_unit;

			$css_rule .= '@media (min-width:' . esc_attr( $close_mobile_menu ) . '){.plus-navigation-wrap.' . esc_attr( $uid ) . ' #theplus-navigation-normal-menu{display: block!important;}.plus-navigation-wrap.' . esc_attr( $uid ) . ' #plus-mobile-nav-toggle-' . esc_attr( $uid ) . '.collapse.in{display:none;}}';

			$css_rule .= '@media (max-width:' . esc_attr( $open_mobile_menu ) . '){.plus-navigation-wrap.' . esc_attr( $uid ) . ' #theplus-navigation-normal-menu{display:none !important;}.plus-navigation-wrap.' . esc_attr( $uid ) . ' .plus-mobile-nav-toggle.mobile-toggle{display: -webkit-flex;display: -moz-flex;display: -ms-flex;display: flex;-webkit-align-items: center;-moz-align-items: center;-ms-align-items: center;align-items: center;-webkit-justify-content: flex-end;-moz-justify-content: flex-end;-ms-justify-content: flex-end;justify-content: flex-end;}}';
		} else {
			$css_rule .= '.plus-navigation-wrap.' . esc_attr( $uid ) . ' #theplus-navigation-normal-menu{display: block!important;}';
		}

		echo '<style>' . $css_rule . '</style>';
	}

	/**
	 * Tp Mega Menu 
	 *
	 * @since 5.5.4
	 * @version 5.5.4
	 */
	protected function tp_mega_menu( $settings, $sett = '' ) {

		$CustomMenu = '';
		$stylecss   = '';
		if ( ! empty( $settings['ItemMenu'] ) ) {
			$CustomMenu .= '<ul class="nav navbar-nav ' . ( $settings['main_menu_hover_style'] == 'style-1' ? 'menu-hover-style-1' : ( $settings['main_menu_hover_style'] == 'style-2' ? 'menu-hover-style-2' : '' ) ) . ' ' . ( ( $settings['main_menu_hover_inverse'] == 'yes' ) ? 'hover-inverse-effect' : '' ) . ' ' . ( ( $settings['sub_menu_hover_inverse'] == 'yes' ) ? 'submenu-hover-inverse-effect' : '' ) . '  ' . ( ( $settings['main_menu_last_open_sub_menu'] == 'yes' ) ? ' open-sub-menu-left' : '' ) . ' ">';

			$menuArray = $settings['ItemMenu'];

			$level = 0;
			foreach ( $settings['ItemMenu'] as $index => $item ) {
				$depth     = $item['depth'];
				$Nextdepth = ( ! empty( $menuArray[ intval( $index + 1 ) ] ) ) ? intval( $menuArray[ $index + 1 ]['depth'] ) : '';
				$Prevdepth = ( ! empty( $menuArray[ intval( $index - 1 ) ] ) ) ? intval( $menuArray[ $index - 1 ]['depth'] ) : '';

				$st_child_Li = '';
				if ( $depth > 0 ) {
					if ( ( $Nextdepth == $depth || $Nextdepth > $depth || $Nextdepth < $depth ) && $Prevdepth != $depth && $Prevdepth < $depth ) {
						$level       = $level + 1;
						$st_child_Li = '<ul role="menu" class="dropdown-menu">';
					}
				}

				$st_end_child_Li = $end_child_Li = '';
				if ( $Nextdepth < $depth ) {
					$diff = ( (int) $depth - (int) $Nextdepth );
					if ( $diff >= 1 ) {
						for ( $i = 0; $i < $diff; $i++ ) {
							$end_child_Li .= '</ul></li>';
						}
					} elseif ( $diff === 0 ) {
						$end_child_Li .= '</li>';
					}
				}

				$name        = '';
				$itemUrl     = '';
				$menuName    = '';
				$indiIcon    = '';
				$subindiIcon = '';

				// Get Prefix Icon
				$preicon = '';
				if ( $item['menuiconTy'] !== '' && $item['menuiconTy'] == 'icon' ) {
					$preicon .= '<span class="plus-navicon-wrap"><i class="' . $item['preicon']['value'] . ' plus-nav-icon-menu"> </i></span>';
				} elseif ( $item['menuiconTy'] !== '' && $item['menuiconTy'] == 'img' ) {
					if ( ! empty( $item['menuImg'] ) && ! empty( $item['menuImg']['id'] ) ) {
						$preicon .= '<span class="plus-navicon-wrap">' . wp_get_attachment_image( $item['menuImg']['id'], 'full', true, array( 'class' => 'plus-nav-icon-menu' ) ) . '</span>';
					} elseif ( ! empty( $item['menuImg']['url'] ) ) {
						$preicon .= '<span class="plus-navicon-wrap"><img src="' . esc_url( $item['menuImg']['url'] ) . '" class="plus-nav-icon-menu icon-img" alt="' . esc_attr__( 'icon_img', 'tpebl' ) . '" /></span>';
					}
				}

				// Get Label
				$txtLabel = '';
				if ( ! empty( $item['showlabel'] ) && $item['labeltxt'] != '' ) {
					$txtLabel .= '<span class="plus-nav-label-text">' . esc_html( $item['labeltxt'] ) . '</span>';
				}

				// Get Descroption
				$navdesc = '';
				if ( ! empty( $item['navDesc'] ) ) {
					$navdesc .= '<span class="tp-navigation-description">' . $item['navDesc'] . '</span>';
				}
				$LinkFilter = ! empty( $item['LinkFilter']['url'] ) ? $item['LinkFilter']['url'] : '#';

				$menuName = ! empty( $LinkFilter ) && ! empty( $item['filterlabel'] ) ? $item['filterlabel'] : '';

				// Get Page Url from id
				$current_active = '';
				if ( ! empty( $item['LinkFilter']['url'] ) ) {
					$itemUrl      = $item['LinkFilter']['url'];
					$itemTarget   = ! empty( $item['LinkFilter']['is_external'] ) ? ' target="_blank"' : '';
					$itemNofollow = ! empty( $item['LinkFilter']['nofollow'] ) ? ' rel="nofollow"' : '';
					if ( $item['filterlabel'] === get_the_ID() ) {
						$current_active = ' active';
					}
				} else {
					$itemUrl = '#';
				}

				if ( ( $depth != '1' ) || ! empty( $item['SmenuType'] ) && $item['SmenuType'] != 'mega-menu' && $item['SmenuType'] == 'link' ) {
					$name = '<a href="' . esc_attr( $itemUrl ) . '" ' . $itemTarget . $itemNofollow . ' title="' . esc_attr( $menuName ) . '" data-text="' . esc_attr( $menuName ) . '" >' . $preicon . '<span class="plus-title-wrap">' . esc_html( $menuName ) . '' . $txtLabel . '' . $navdesc . '</span></a>';
				}
				$dropdownClass = ( $Nextdepth >= 2 && ( $Nextdepth > $depth ) ) ? 'dropdown-submenu menu-item-has-children' : ( ( $Nextdepth > $depth ) ? 'dropdown menu-item-has-children' : '' );

				$MegaMenuClass = '';
				if ( $Nextdepth === 1 ) {
					$NextMenu = ( ! empty( $menuArray[ $index + 1 ] ) ) ? $menuArray[ $index + 1 ] : '';
					if ( $NextMenu != '' && $NextMenu['SmenuType'] == 'mega-menu' ) {
						$MegaMenuClass .= ' plus-fw';
						if ( $NextMenu != '' && $NextMenu['megaMType'] != '' ) {
							$MegaMenuClass .= ' plus-dropdown-' . $NextMenu['megaMType'];
						}
						if ( $NextMenu != '' && $NextMenu['megaMType'] == 'default' ) {
							$unit = isset( $NextMenu['megaMwid']['size'] ) && ! empty( $NextMenu['megaMwid']['size'] ) ? $NextMenu['megaMwid']['size'] : '';

							// Desktop
							if ( isset( $NextMenu['megaMwid']['size'] ) && ! empty( $NextMenu['megaMwid']['size'] ) ) {
								$stylecss .= '@media (min-width: 1024px) { .plus-navigation-wrap .plus-navigation-inner .navbar-nav>li.elementor-repeater-item-' . $item['_id'] . '.plus-dropdown-default>ul.dropdown-menu{ max-width: ' . $NextMenu['megaMwid']['size'] . $unit . ' !important; min-width: ' . $NextMenu['megaMwid']['size'] . $unit . '!important; ' . ( isset( $NextMenu['megaMAlign'] ) && $NextMenu['megaMAlign'] == 'default' ? 'right: auto;' : '' ) . '} } ';
							}
							// Tablet
							if ( isset( $NextMenu['megaMwid']['size'] ) && ! empty( $NextMenu['megaMwid']['size'] ) ) {
								$stylecss .= '@media (max-width: 1024px) and (min-width:768px){ .plus-navigation-wrap .plus-navigation-inner .navbar-nav>li.elementor-repeater-item-' . $item['_id'] . '.plus-dropdown-default>ul.dropdown-menu{ max-width: ' . $NextMenu['megaMwid']['size'] . $unit . ' !important; min-width: ' . $NextMenu['megaMwid']['size'] . $unit . ' !important; ' . ( isset( $NextMenu['megaMAlign'] ) && $NextMenu['megaMAlign'] == 'default' ? 'right: auto;' : '' ) . '} } ';
							}
							// Mobile
							if ( isset( $NextMenu['megaMwid']['size'] ) && ! empty( $NextMenu['megaMwid']['size'] ) ) {
								$stylecss .= '@media (max-width: 767px) { .plus-navigation-wrap .plus-navigation-inner .navbar-nav>li.elementor-repeater-item-' . $item['_id'] . '.plus-dropdown-default>ul.dropdown-menu{ max-width: ' . $NextMenu['megaMwid']['size'] . $unit . ' !important; min-width: ' . $NextMenu['megaMwid']['size'] . $unit . ' !important; ' . ( isset( $NextMenu['megaMAlign'] ) && $NextMenu['megaMAlign'] == 'default' ? 'right: auto;' : '' ) . '} } ';
							}
						}
					}
					if ( $NextMenu != '' && $NextMenu['megaMType'] == 'default' && isset( $NextMenu['megaMAlign'] ) && $NextMenu['megaMAlign'] == 'center' ) {
						$MegaMenuClass .= ' plus-dropdown-' . esc_attr( $NextMenu['megaMAlign'] );
					}
				}
				$start_Li = "<li class='menu-item depth-" . esc_attr( $depth ) . ' ' . esc_attr( $dropdownClass ) . ' ' . esc_attr( $MegaMenuClass ) . ' ' . ( ! empty( $item['classTxt'] ) ? $item['classTxt'] : '' ) . ' elementor-repeater-item-' . esc_attr( $item['_id'] ) . $current_active . "' >";

				if ( $depth == '1' && $item['SmenuType'] == 'mega-menu' ) {
					if ( empty( $sett ) || empty( $item['moblieMmenu'] && $item['moblieMmenu'] == 'no' ) ) {
						$start_Li .= '<div class="plus-megamenu-content">';
						if ( ( $item['blockTemp'] ) && $item['blockTemp'] != '0' ) {
							$template_status = get_post_status( $item['blockTemp'] );
							if( 'publish' === $template_status ) {
								$start_Li .= '<div class="plus-content-editor">' . L_Theplus_Element_Load::elementor()->frontend->get_builder_content_for_display( $item['blockTemp'] ) . '</div>';
							} else {
								$start_Li .= '<div class="tab-preview-template-notice"><div class="preview-temp-notice-heading">' . esc_html__( 'Unauthorized Access', 'tpebl' ) . '</b></div><div class="preview-temp-notice-desc"><b>' . esc_html__( 'Note :', 'tpebl' ) . '</b> ' . esc_html__( 'You need to upgrade your permissions to Editor or Administrator level to update this option.', 'tpebl' ) . '</div></div>';
							}
						}
						$start_Li .= '</div>';
					}
					if ( ! empty( $item['moblieMmenu'] && $item['moblieMmenu'] == 'yes' ) && ! empty( $sett ) ) {
						$MLinkFilter = (array) $item['MLinkFilter']['url'];
						$MmenuName   = ! empty( $MLinkFilter ) && ! empty( $item['Mfilterlabel'] ) ? $item['Mfilterlabel'] : '';
						$MitemUrl    = ! empty( $item['MLinkFilter']['url'] ) ? $item['MLinkFilter']['url'] : '#';
						$Target      = ! empty( $item['MLinkFilter']['is_external'] ) ? ' target="_blank"' : '';
						$Nofollow    = ! empty( $item['MLinkFilter']['nofollow'] ) ? ' rel="nofollow"' : '';
						$start_Li   .= '<a href="' . esc_attr( $MitemUrl ) . '" ' . $Target . $Nofollow . ' title="' . esc_attr( $MmenuName ) . '" data-text="' . $MmenuName . '" >' . $preicon . '' . $MmenuName . '' . $txtLabel . '</a>';
					}
				}
				$end_Li = '';
				if ( $Nextdepth === $depth && $depth === '0' && $Nextdepth === $Prevdepth ) {
					$end_Li = '</li>';
				}
				$CustomMenu .= $st_end_child_Li . $st_child_Li . $start_Li . $name . $end_Li . $end_child_Li;
			}
			$CustomMenu .= '</ul>';
			if ( ! empty( $stylecss ) ) {
				$CustomMenu .= '<style>' . $stylecss . '</style>';
			}
		}
		return $CustomMenu;
	}
}