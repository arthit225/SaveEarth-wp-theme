<?php
/**
 * Widget Name: Scroll Navigation
 * Description: navigation bar Scrolling Effect scroll event.
 * Author: Theplus
 * Author URI: https://posimyth.com
 *
 * @package ThePlus
 */

namespace TheplusAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class L_ThePlus_Scroll_Navigation
 */
class L_ThePlus_Scroll_Navigation extends Widget_Base {

	/**
	 * Get Widget Name.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_name() {
		return 'tp-scroll-navigation';
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
		return esc_html__( 'Scroll Navigation', 'tpebl' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-sort theplus_backend_icon';
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
		return array( 'Scroll Navigation', 'Scroll Menu', ' Sticky Navigation', 'Sticky Menu', 'Fixed Navigation', 'Fixed Menu', 'Anchor Menu', ' Anchor Navigation', 'Smooth Scroll', 'One Page Navigation' );
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
	 * @version 5.4.2
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Scroll Navigation', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'scroll_navigation_style',
			array(
				'label'   => esc_html__( 'Style', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => array(
					'style-1' => esc_html__( 'Style 1', 'tpebl' ),
					'style-2' => esc_html__( 'Style 2 (Pro)', 'tpebl' ),
					'style-3' => esc_html__( 'Style 3 (Pro)', 'tpebl' ),
					'style-4' => esc_html__( 'Style 4 (Pro)', 'tpebl' ),
					'style-5' => esc_html__( 'Style 5 (Pro)', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'scroll_navigation_direction',
			array(
				'label'     => esc_html__( 'Direction', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'right',
				'options'   => array(
					'left'         => esc_html__( 'Middle Left', 'tpebl' ),
					'right'        => esc_html__( 'Middle Right', 'tpebl' ),
					'top'          => esc_html__( 'Top', 'tpebl' ),
					'top_left'     => esc_html__( 'Top Left', 'tpebl' ),
					'top_right'    => esc_html__( 'Top Right', 'tpebl' ),
					'bottom'       => esc_html__( 'Bottom', 'tpebl' ),
					'bottom_left'  => esc_html__( 'Bottom Left', 'tpebl' ),
					'bottom_right' => esc_html__( 'Bottom Right', 'tpebl' ),
				),
				'condition' => array(
					'scroll_navigation_style' => array( 'style-1' ),
				),
			)
		);
		$this->add_control(
			'scroll_navigation_direction_st4',
			array(
				'label'     => esc_html__( 'Direction', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'right',
				'options'   => array(
					'left'  => esc_html__( 'Middle Left (Pro)', 'tpebl' ),
					'right' => esc_html__( 'Middle Right (Pro)', 'tpebl' ),
				),
				'condition' => array(
					'scroll_navigation_style' => array( 'style-2', 'style-4' ),
				),
			)
		);
		$this->add_control(
			'scroll_navigation_direction_inner',
			array(
				'label'     => esc_html__( 'Position', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'p_center',
				'options'   => array(
					'p_left'   => esc_html__( 'Left (Pro)', 'tpebl' ),
					'p_right'  => esc_html__( 'Right (Pro)', 'tpebl' ),
					'p_center' => esc_html__( 'Center (Pro)', 'tpebl' ),
				),
				'condition' => array(
					'scroll_navigation_direction' => array( 'top', 'bottom' ),
					'scroll_navigation_style!'    => array( 'style-2', 'style-4' ),
				),
			)
		);
		$this->add_control(
			'scroll_navigation_display_counter',
			array(
				'label'     => esc_html__( 'Display Counter', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'default'   => 'no',
				'separator' => 'before',
				'condition' => array(
					'scroll_navigation_style' => array( 'style-2', 'style-4' ),
				),

			)
		);
		$this->add_control(
			'scroll_navigation_display_counter_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'scroll_navigation_style'           => array( 'style-2', 'style-4' ),
					'scroll_navigation_display_counter' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'scroll_navigation_tooltip_display_style',
			array(
				'label'     => esc_html__( 'Tooltip Display Style', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'on-default',
				'options'   => array(
					'on-hover'          => esc_html__( 'On Hover', 'tpebl' ),
					'on-active-section' => esc_html__( 'On Active Section (Pro)', 'tpebl' ),
					'on-default'        => esc_html__( 'Default', 'tpebl' ),
				),
				'separator' => 'before',
			)
		);
		$this->add_control(
			'tooltip_style_options_pro',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'scroll_navigation_tooltip_display_style' => 'on-active-section',
				),
			)
		);
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'scroll_navigation_section_id',
			array(
				'label'   => esc_html__( 'Section ID', 'tpebl' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'section-id',
			)
		);
		$repeater->add_control(
			'display_tool_tip',
			array(
				'label'     => esc_html__( 'Tooltip', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'default'   => 'no',
				'separator' => 'before',

			)
		);
		$repeater->add_control(
			'tooltip_menu_title',
			array(
				'label'     => esc_html__( 'Tooltip Title', 'tpebl' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '',
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'display_tool_tip' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'display_tool_tip_icon',
			array(
				'label'     => esc_html__( 'Icon', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$repeater->add_control(
			'loop_icon_style',
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
					'display_tool_tip_icon' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'loop_icon_fontawesome',
			array(
				'label'     => esc_html__( 'Icon Library', 'tpebl' ),
				'type'      => Controls_Manager::ICON,
				'default'   => 'fa fa-bank',
				'condition' => array(
					'loop_icon_style'       => 'font_awesome',
					'display_tool_tip_icon' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'loop_icon_fontawesome_5',
			array(
				'label'     => esc_html__( 'Icon Library', 'tpebl' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-plus',
					'library' => 'solid',
				),
				'condition' => array(
					'loop_icon_style'       => 'font_awesome_5',
					'display_tool_tip_icon' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'loop_icon_mind_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'loop_icon_style'       => 'icon_mind',
					'display_tool_tip_icon' => 'yes',
				),
			)
		);
		$this->add_control(
			'scroll_navigation_menu_list',
			array(
				'label'     => esc_html__( 'Scroll Navigation List', 'tpebl' ),
				'type'      => Controls_Manager::REPEATER,
				'fields'    => $repeater->get_controls(),
				'default'   => array(
					array(
						'loop_image_icon'       => 'icon',
						'loop_icon_style'       => 'font_awesome',
						'loop_icon_fontawesome' => 'fa fa-dot-circle-o',
					),

				),
				'separator' => 'before',
			)
		);
		$this->add_control(
			'pagescroll_connection',
			array(
				'label'     => esc_html__( 'Page Scroll Connection', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'pagescroll_connection_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'pagescroll_connection' => array( 'yes' ),
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_navigation_styling',
			array(
				'label' => esc_html__( 'Navigation Style', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'navigation_icon_height_width',
			array(
				'label'      => esc_html__( 'Icon Height/Width', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 25,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-scroll-navigation .theplus-scroll-navigation__dot,{{WRAPPER}} .theplus-scroll-navigation .theplus-scroll-navigation__dot:hover,{{WRAPPER}} .theplus-scroll-navigation a.theplus-scroll-navigation__item._mPS2id-h.highlight .theplus-scroll-navigation__dot,
					{{WRAPPER}} .theplus-scroll-navigation .theplus-scroll-navigation__dot:before,{{WRAPPER}} .theplus-scroll-navigation .theplus-scroll-navigation__dot:hover:before,{{WRAPPER}} .theplus-scroll-navigation a.theplus-scroll-navigation__item._mPS2id-h.highlight .theplus-scroll-navigation__dot' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .theplus-scroll-navigation .theplus-scroll-navigation__inner' => 'min-width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'scroll_navigation_style' => 'style-1',
				),
			)
		);
		$this->add_responsive_control(
			'navigation_icon_spacing_other_all_margin',
			array(
				'label'      => esc_html__( 'Icon Spacing', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-scroll-navigation.s_n_top_left a.theplus-scroll-navigation__item,
					{{WRAPPER}} .theplus-scroll-navigation.s_n_top_right a.theplus-scroll-navigation__item,
					{{WRAPPER}} .theplus-scroll-navigation.s_n_bottom_left a.theplus-scroll-navigation__item,
					{{WRAPPER}} .theplus-scroll-navigation.s_n_bottom_right a.theplus-scroll-navigation__item,
					{{WRAPPER}} .theplus-scroll-navigation.s_n_left a.theplus-scroll-navigation__item,
					{{WRAPPER}} .theplus-scroll-navigation.s_n_right a.theplus-scroll-navigation__item' => 'margin-top: {{SIZE}}{{UNIT}};margin-bottom: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'scroll_navigation_direction'     => array( 'left', 'right', 'top_left', 'top_right', 'bottom_left', 'bottom_right' ),
					'scroll_navigation_direction_st4' => array( 'left', 'right' ),
					'scroll_navigation_style'         => 'style-1',
				),
			)
		);
		$this->start_controls_tabs( 'scroll_navigation_icon_style' );
		$this->start_controls_tab(
			'scroll_navigation_icon_normal',
			array(
				'label'     => esc_html__( 'Normal', 'tpebl' ),
				'condition' => array(
					'scroll_navigation_style' => 'style-1',
				),
			)
		);
		$this->add_control(
			'scroll_navigation_icon_color_normal',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .theplus-scroll-navigation.style-1 .theplus-scroll-navigation__dot' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'scroll_navigation_style' => 'style-1',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'scroll_navigation_icon_border_normal',
				'label'     => esc_html__( 'Border', 'tpebl' ),
				'selector'  => '{{WRAPPER}} .theplus-scroll-navigation.style-1 .theplus-scroll-navigation__dot',
				'condition' => array(
					'scroll_navigation_style' => 'style-1',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'scroll_navigation_icon_hover',
			array(
				'label'     => esc_html__( 'Hover', 'tpebl' ),
				'condition' => array(
					'scroll_navigation_style' => 'style-1',
				),
			)
		);
		$this->add_control(
			'scroll_navigation_icon_color_hover',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .theplus-scroll-navigation.style-1 .theplus-scroll-navigation__dot:hover,
					{{WRAPPER}} .theplus-scroll-navigation.style-1 a.theplus-scroll-navigation__item._mPS2id-h.highlight .theplus-scroll-navigation__dot' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'scroll_navigation_style' => 'style-1',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'scroll_navigation_icon_border_hover',
				'label'     => esc_html__( 'Border', 'tpebl' ),
				'selector'  => '{{WRAPPER}} .theplus-scroll-navigation.style-1 .theplus-scroll-navigation__dot:hover,
					{{WRAPPER}} .theplus-scroll-navigation.style-1 a.theplus-scroll-navigation__item._mPS2id-h.highlight .theplus-scroll-navigation__dot',
				'condition' => array(
					'scroll_navigation_style' => 'style-1',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'sc_style_pro_option',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'scroll_navigation_style!' => 'style-1',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_navigation_background_styling',
			array(
				'label' => esc_html__( 'Navigation Background', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'section_navigation_background_styling_option',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'scroll_navigation_style!' => 'style-1',
				),
			)
		);
		$this->add_control(
			'scroll_nav_icon_background_style',
			array(
				'label'     => esc_html__( 'Navigation Background', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'default'   => 'no',
				'condition' => array(
					'scroll_navigation_style' => 'style-1',
				),
			)
		);
		$this->start_controls_tabs( 'scroll_nav_icon_background' );
		$this->start_controls_tab(
			'scroll_nav_icon_background_normal',
			array(
				'label'     => esc_html__( 'Normal', 'tpebl' ),
				'condition' => array(
					'scroll_navigation_style'          => 'style-1',
					'scroll_nav_icon_background_style' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'scroll_nav_icon_background_normal',
				'label'     => esc_html__( 'Icon Background', 'tpebl' ),
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .theplus-scroll-navigation.style-1 .theplus-scroll-navigation__inner .theplus-scroll-navigation__item',
				'condition' => array(
					'scroll_navigation_style'          => 'style-1',
					'scroll_nav_icon_background_style' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'scroll_nav_icon_background_hover',
			array(
				'label'     => esc_html__( 'Hover', 'tpebl' ),
				'condition' => array(
					'scroll_navigation_style'          => 'style-1',
					'scroll_nav_icon_background_style' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'scroll_nav_icon_background_hover',
				'label'     => esc_html__( 'Icon Background', 'tpebl' ),
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .theplus-scroll-navigation.style-1 .theplus-scroll-navigation__inner a.theplus-scroll-navigation__item:hover,
				{{WRAPPER}} .theplus-scroll-navigation.style-1 .theplus-scroll-navigation__inner .theplus-scroll-navigation__item.highlight',
				'condition' => array(
					'scroll_navigation_style'          => 'style-1',
					'scroll_nav_icon_background_style' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'scroll_nav_icon_background_border_heading',
			array(
				'label'     => esc_html__( 'Icon Background Border', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'scroll_navigation_style'          => 'style-1',
					'scroll_nav_icon_background_style' => 'yes',
				),
			)
		);
		$this->start_controls_tabs( 'scroll_nav_icon_background_border' );
		$this->start_controls_tab(
			'scroll_nav_icon_background_border_normal',
			array(
				'label'     => esc_html__( 'Normal', 'tpebl' ),
				'condition' => array(
					'scroll_navigation_style'          => 'style-1',
					'scroll_nav_icon_background_style' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'scroll_nav_icon_background_border__normal',
				'label'     => esc_html__( 'Border', 'tpebl' ),
				'selector'  => '{{WRAPPER}} .theplus-scroll-navigation.style-1 .theplus-scroll-navigation__inner .theplus-scroll-navigation__item',
				'condition' => array(
					'scroll_navigation_style'          => 'style-1',
					'scroll_nav_icon_background_style' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'scroll_nav_icon_background_border_radious_normal',
			array(
				'label'      => esc_html__( 'Icon Background Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-scroll-navigation.style-1 .theplus-scroll-navigation__inner .theplus-scroll-navigation__item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'scroll_navigation_style'          => 'style-1',
					'scroll_nav_icon_background_style' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'scroll_nav_icon_background_border_hover',
			array(
				'label'     => esc_html__( 'Hover', 'tpebl' ),
				'condition' => array(
					'scroll_navigation_style'          => 'style-1',
					'scroll_nav_icon_background_style' => 'yes',
				),
			)
		);
		$this->add_control(
			'scroll_nav_icon_background_border_hover_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .theplus-scroll-navigation.style-1 .theplus-scroll-navigation__inner a.theplus-scroll-navigation__item:hover,
				{{WRAPPER}} .theplus-scroll-navigation.style-1 .theplus-scroll-navigation__inner .theplus-scroll-navigation__item.highlight' => 'border-color: {{VALUE}}',
				),
				'condition' => array(
					'scroll_navigation_style'          => 'style-1',
					'scroll_nav_icon_background_style' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'scroll_nav_icon_background_border_radious_hover',
			array(
				'label'      => esc_html__( 'Icon Background Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-scroll-navigation.style-1 .theplus-scroll-navigation__inner a.theplus-scroll-navigation__item:hover,
				{{WRAPPER}} .theplus-scroll-navigation.style-1 .theplus-scroll-navigation__inner .theplus-scroll-navigation__item.highlight' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'scroll_navigation_style'          => 'style-1',
					'scroll_nav_icon_background_style' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'scroll_nav_icon_background_shadow',
				'selector'  => '{{WRAPPER}} .theplus-scroll-navigation.style-1 .theplus-scroll-navigation__inner .theplus-scroll-navigation__item',
				'condition' => array(
					'scroll_navigation_style' => 'style-1',
				),

			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_navigation_tooltip_styling',
			array(
				'label' => esc_html__( 'Tooltip', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'section_navigation_tooltip_styling_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'scroll_navigation_style!' => 'style-1',
				),
			)
		);
		$this->add_responsive_control(
			'navigation_tooltip_margin',
			array(
				'label'      => esc_html__( 'Navigation Tooltip Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-scroll-navigation .theplus-scroll-navigation__inner .tooltiptext' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
				'condition'  => array(
					'scroll_navigation_style' => 'style-1',
				),
			)
		);
		$this->add_responsive_control(
			'navigation_tooltip_padding',
			array(
				'label'      => esc_html__( 'Navigation Tooltip Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-scroll-navigation .theplus-scroll-navigation__inner .tooltiptext' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'scroll_navigation_style' => 'style-1',
				),
			)
		);
		$this->add_responsive_control(
			'scroll_navigation_tooltip_align',
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
				'prefix_class' => 'text-%s',
				'separator'    => 'after',
				'condition'    => array(
					'scroll_navigation_style' => 'style-1',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'navigation_tooltip_typography',
				'label'     => esc_html__( 'Typography', 'tpebl' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				),
				'selector'  => '{{WRAPPER}} .theplus-scroll-navigation .theplus-scroll-navigation__dot span.tooltiptext',
				'condition' => array(
					'scroll_navigation_style' => 'style-1',
				),
			)
		);
		$this->add_responsive_control(
			'navigation_tooltip_svg_icon',
			array(
				'label'      => esc_html__( 'Svg Icon Size', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 150,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 20,
				),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-scroll-navigation .theplus-scroll-navigation__dot span.tooltiptext svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'scroll_navigation_style' => 'style-1',
				),
			)
		);
		$this->add_control(
			'navigation_tooltip_font_color_normal',
			array(
				'label'     => esc_html__( 'Font Color Normal', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .theplus-scroll-navigation__dot .tooltiptext' => 'color: {{VALUE}}',
					'{{WRAPPER}} .theplus-scroll-navigation__dot .tooltiptext svg' => 'fill: {{VALUE}}',
				),
				'default'   => '#FFFFFF',
				'condition' => array(
					'scroll_navigation_style' => 'style-1',
				),
			)
		);
		$this->add_control(
			'navigation_tooltip_font_color_hover',
			array(
				'label'     => esc_html__( 'Font Color Hover', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .theplus-scroll-navigation__dot .tooltiptext:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .theplus-scroll-navigation__dot .tooltiptext:hover svg' => 'fill: {{VALUE}}',
				),
				'condition' => array(
					'scroll_navigation_style' => 'style-1',
				),
			)
		);
		$this->add_control(
			'navigation_tooltip_background_color',
			array(
				'label'     => esc_html__( 'Background Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .theplus-scroll-navigation .theplus-scroll-navigation__dot .tooltiptext' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .theplus-scroll-navigation .theplus-scroll-navigation__dot span.tooltiptext:after' => 'border-right-color:{{VALUE}}',
				),
				'default'   => '#000000',
				'condition' => array(
					'scroll_navigation_style' => 'style-1',
				),
			)
		);
		$this->add_responsive_control(
			'navigation_tooltip_height',
			array(
				'label'      => esc_html__( 'Tooltip Height', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 35,
						'max'  => 200,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-scroll-navigation .theplus-scroll-navigation__dot span.tooltiptext' => 'height: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'scroll_navigation_style' => 'style-1',
				),
			)
		);
		$this->add_control(
			'scroll_nav_tooltip_arrow',
			array(
				'label'     => esc_html__( 'Tooltip Arrow', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'default'   => 'yes',
				'condition' => array(
					'scroll_navigation_style' => 'style-1',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'scroll_nav_tooltip_shadow',
				'selector'  => '{{WRAPPER}} .theplus-scroll-navigation__dot span.tooltiptext',
				'condition' => array(
					'scroll_navigation_style' => 'style-1',
				),
			)
		);
		$this->add_responsive_control(
			'scroll_nav_tooltip_border_radious',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-scroll-navigation__dot .tooltiptext' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'scroll_navigation_style' => 'style-1',
				),
				'separator'  => 'after',
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_navigation_dispaly_counter_styling',
			array(
				'label'     => esc_html__( 'Display Counter', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'scroll_navigation_style' => array( 'style-2', 'style-4' ),
				),
			)
		);
		$this->add_control(
			'section_navigation_dispaly_counter_styling_options',
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
			'section_bg_option_styling',
			array(
				'label' => esc_html__( 'Whole Background Style', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'navigation_icon_padding',
			array(
				'label'      => esc_html__( 'Whole Navigation Offset', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-scroll-navigation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'scroll_nav_background_padding',
			array(
				'label'      => esc_html__( 'Whole Navigation Inner Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-scroll-navigation .theplus-scroll-navigation__inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'scroll_nav_background_style',
			array(
				'label'     => esc_html__( 'Background', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'default'   => 'no',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'scroll_nav_background',
				'label'     => esc_html__( 'Background', 'tpebl' ),
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .theplus-scroll-navigation .theplus-scroll-navigation__inner',
				'condition' => array(
					'scroll_nav_background_style' => 'yes',
				),
			)
		);
		$this->add_control(
			'scroll_nav_background_border',
			array(
				'label'     => esc_html__( 'Box Border', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'default'   => 'no',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'scroll_nav_background_border',
				'label'     => esc_html__( 'Border', 'tpebl' ),
				'selector'  => '{{WRAPPER}} .theplus-scroll-navigation .theplus-scroll-navigation__inner',
				'condition' => array(
					'scroll_nav_background_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'scroll_nav_background_border_radious',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-scroll-navigation .theplus-scroll-navigation__inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'scroll_nav_background_border' => 'yes',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'scroll_nav_background_shadow',
				'selector' => '{{WRAPPER}} .theplus-scroll-navigation .theplus-scroll-navigation__inner',

			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'extra_option_style_section',
			array(
				'label' => esc_html__( 'Extra Options', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'show_scroll_window_offset',
			array(
				'label'     => esc_html__( 'Show Menu Scroll Offset', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'show_scroll_window_offset_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'show_scroll_window_offset' => array( 'yes' ),
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
	 * @version 5.4.2
	 */
	protected function render() {
		$settings      = $this->get_settings_for_display();
		$sn_style      = ! empty( $settings['scroll_navigation_style'] ) ? $settings['scroll_navigation_style'] : '';
		$sn_direction  = ! empty( $settings['scroll_navigation_direction'] ) ? $settings['scroll_navigation_direction'] : '';
		$display_style = ! empty( $settings['scroll_navigation_tooltip_display_style'] ) ? $settings['scroll_navigation_tooltip_display_style'] : '';
		$menu_list     = ! empty( $settings['scroll_navigation_menu_list'] ) ? $settings['scroll_navigation_menu_list'] : '';

		$scroll_style = '';
		if ( 'style-1' === $sn_style ) {
			$scroll_style = 'style-1';
		}

		$direction_class = '';
		if ( 'top' === $sn_direction ) {
			$direction_class = 's_n_top';
		} elseif ( 'top_left' === $sn_direction ) {
			$direction_class = 's_n_top_left';
		} elseif ( 'top_right' === $sn_direction ) {
			$direction_class = 's_n_top_right';
		} elseif ( 'bottom' === $sn_direction ) {
			$direction_class = 's_n_bottom';
		} elseif ( 'bottom_left' === $sn_direction ) {
			$direction_class = 's_n_bottom_left';
		} elseif ( 'bottom_right' === $sn_direction ) {
			$direction_class = 's_n_bottom_right';
		} elseif ( 'left' === $sn_direction ) {
			$direction_class = 's_n_left';
		} elseif ( 'right' === $sn_direction ) {
			$direction_class = 's_n_right';
		}

		$display_tooltip_style_class = '';
		if ( 'on-default' === $display_style ) {
			$display_tooltip_style_class = 'on_default';
		}

		$tooltip_arrow = '';
		$tt_arrow      = ! empty( $settings['scroll_nav_tooltip_arrow'] ) ? $settings['scroll_nav_tooltip_arrow'] : '';

		if ( 'yes' === $tt_arrow ) {
			$tooltip_arrow = 'sn_t_a_e';
		} else {
			$tooltip_arrow = 'sn_t_a_d';
		}

		if ( ! empty( $menu_list ) ) {
			$uid                = uniqid( 'scroll' );
			$scroll_navigation  = '<div class="theplus-scroll-navigation ' . esc_attr( $uid ) . ' ' . esc_attr( $scroll_style ) . ' ' . esc_attr( $direction_class ) . ' " data-uid="' . esc_attr( $uid ) . '" >';
			$scroll_navigation .= '<div class="theplus-scroll-navigation__inner">';

			foreach ( $menu_list as $item ) {
				$scroll_navigation .= '<a href="#' . esc_attr( $item['scroll_navigation_section_id'] ) . '" class="theplus-scroll-navigation__item _mPS2id-h" >';
				$tooltip_menu_title = '';
				$tooltip_title      = '';
				$tooltip_icon       = '';
				$icons              = '';
				$s_icon_img         = '';

				$icon_opt = ! empty( $item['loop_icon_style'] ) ? $item['loop_icon_style'] : '';

				if ( 'font_awesome' === $icon_opt ) {
					$li_font = ! empty( $item['loop_icon_fontawesome'] ) ? $item['loop_icon_fontawesome'] : 'fa fa-bank';
					$icons   = $li_font;
				} elseif ( 'font_awesome_5' === $icon_opt ) {
					ob_start();
					\Elementor\Icons_Manager::render_icon( $item['loop_icon_fontawesome_5'], array( 'aria-hidden' => 'true' ) );
					$icons = ob_get_contents();
					ob_end_clean();
				} else {
					$icons = '';
				}
				if ( ! empty( $icons ) ) {
					if ( 'font_awesome_5' === $icon_opt ) {
						$s_icon_img = '<span class="scroll-tooltip-icon ">' . $icons . '</span>';
					} else {
						$s_icon_img = '<i class=" ' . esc_attr( $icons ) . ' scroll-tooltip-icon "></i>';
					}
				}

				$tt_title = ! empty( $item['tooltip_menu_title'] ) ? $item['tooltip_menu_title'] : '';

				if ( ! empty( $tt_title || $icons ) ) {
					$tooltip_title = '<span class="tooltiptext ' . esc_attr( $direction_class ) . ' ' . esc_attr( $tooltip_arrow ) . ' ' . $settings['scroll_navigation_tooltip_align'] . ' ' . esc_attr( $display_tooltip_style_class ) . '">' . $s_icon_img . ' ' . esc_html( $tt_title ) . '</span>';
				}

				$scroll_navigation .= '<div class="theplus-scroll-navigation__dot">' . $tooltip_title . '</div>';
				$scroll_navigation .= '</a>';
			}
			$scroll_navigation .= '</div>';
			$scroll_navigation .= '</div>';

			echo $scroll_navigation;
		}
	}
}
