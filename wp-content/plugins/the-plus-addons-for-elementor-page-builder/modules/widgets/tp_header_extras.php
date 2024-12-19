<?php
/**
 * Widget Name: Header Extras
 * Description: header extra icons search bar, mini cart and toggle content..etc
 * Author: Theplus
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
 * Class L_ThePlus_Header_Extras
 */
class L_ThePlus_Header_Extras extends Widget_Base {

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
		return 'tp-header-extras';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Header Meta Content', 'tpebl' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-info theplus_backend_icon';
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
	 * Get Widget keywords.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_keywords() {
		return array( 'Header extras', 'Elementor header extras', 'Elementor addon', 'The Plus Addons for Elementor', 'Search bar', 'Search widget' );
	}

	public function get_custom_help_url() {
		$help_url = $this->tp_help;

		return esc_url( $help_url );
	}

	/**
	 * Register controls.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'meta_content_sections',
			array(
				'label' => esc_html__( 'Meta Content', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'select_icon_list',
			array(
				'label'   => esc_html__( 'Select Options', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => array(
					'search'       => esc_html__( 'Search Bar', 'tpebl' ),
					'cart'         => esc_html__( 'Mini Cart', 'tpebl' ),
					'extra_toggle' => esc_html__( 'Extra Toggle Bar (Pro)', 'tpebl' ),
					'wpml_lang'    => esc_html__( 'Language Switcher (Pro)', 'tpebl' ),
					'music'        => esc_html__( 'Music (Pro)', 'tpebl' ),
					'action_1'     => esc_html__( 'Call to Action 1 (Pro)', 'tpebl' ),
					'action_2'     => esc_html__( 'Call to Action 2 (Pro)', 'tpebl' ),
				),
			)
		);
		$repeater->add_control(
			'how_it_works_search',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "add-search-icon-to-elementor-navigation-header-menu/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'select_icon_list' => array( 'search' ),
				),
			)
		);
		$repeater->add_control(
			'how_it_works_cart',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "add-woocommerce-mini-cart-in-elementor-navigation-header-menu/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'select_icon_list' => array( 'cart' ),
				),
			)
		);
		$repeater->add_responsive_control(
			'icon_left_space',
			array(
				'label'      => esc_html__( 'Icon Left Space', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
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
					'{{WRAPPER}} .header-extra-icons ul.icons-content-list > li{{CURRENT_ITEM}}' => 'padding-left: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$repeater->add_responsive_control(
			'icon_right_space',
			array(
				'label'      => esc_html__( 'Icon Right Space', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
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
					'{{WRAPPER}} .header-extra-icons ul.icons-content-list > li{{CURRENT_ITEM}}' => 'padding-right: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$repeater->add_control(
			'responsive_icon_hidden_options',
			array(
				'label'     => esc_html__( 'Responsive Device', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$repeater->add_control(
			'responsive_hidden_desktop',
			array(
				'label'     => esc_html__( 'Hide On Desktop', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Hide', 'tpebl' ),
				'label_off' => esc_html__( 'Show', 'tpebl' ),
				'default'   => 'no',
			)
		);
		$repeater->add_control(
			'responsive_hidden_tablet',
			array(
				'label'     => esc_html__( 'Hide On Tablet', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Hide', 'tpebl' ),
				'label_off' => esc_html__( 'Show', 'tpebl' ),
				'default'   => 'no',
			)
		);
		$repeater->add_control(
			'responsive_hidden_mobile',
			array(
				'label'     => esc_html__( 'Hide On Mobile', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Hide', 'tpebl' ),
				'label_off' => esc_html__( 'Show', 'tpebl' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'sequence_icons',
			array(
				'label'       => '',
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'select_icon_list' => 'search',
					),
				),
				'title_field' => '{{{ select_icon_list }}}',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_search_options',
			array(
				'label' => esc_html__( 'Search Options', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'display_search_bar',
			array(
				'label'     => esc_html__( 'Display Search Bar', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'tpebl' ),
				'label_off' => esc_html__( 'Off', 'tpebl' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'search_icon_style',
			array(
				'label'     => esc_html__( 'Icon Style', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style-1',
				'options'   => array(
					'style-1'            => esc_html__( 'Style 1', 'tpebl' ),
					'style-custom-icon'  => esc_html__( 'Custom Icon (Pro)', 'tpebl' ),
					'style-custom-image' => esc_html__( 'Custom Image (Pro)', 'tpebl' ),
				),
				'condition' => array(
					'display_search_bar' => 'yes',
				),
			)
		);
		$this->add_control(
			'search_icon_style_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'display_search_bar' => 'yes',
					'search_icon_style'  => array( 'style-custom-icon', 'style-custom-image' ),
				),
			)
		);
		$this->add_control(
			'search_bar_content_style',
			array(
				'label'     => esc_html__( 'Search Content Style', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style-1',
				'options'   => array(
					'style-1' => esc_html__( 'Style 1', 'tpebl' ),
					'style-2' => esc_html__( 'Style 2', 'tpebl' ),
					'style-3' => esc_html__( 'Style 3', 'tpebl' ),
					'style-4' => esc_html__( 'Style 4', 'tpebl' ),
				),
				'condition' => array(
					'display_search_bar' => 'yes',
					'search_icon_style'  => 'style-1',
				),
			)
		);
		$this->add_control(
			'search_bar_open_content_style',
			array(
				'label'     => esc_html__( 'Open Content Position', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'sboc_left',
				'options'   => array(
					'sboc_left'  => esc_html__( 'Left', 'tpebl' ),
					'sboc_right' => esc_html__( 'Right', 'tpebl' ),
				),
				'condition' => array(
					'display_search_bar'       => 'yes',
					'search_icon_style'        => 'style-1',
					'search_bar_content_style' => array( 'style-3', 'style-4' ),
				),
			)
		);
		$this->add_control(
			'search_placeholder_text',
			array(
				'label'     => esc_html__( 'Search Placeholder Text', 'tpebl' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Search...', 'tpebl' ),
				'condition' => array(
					'display_search_bar' => 'yes',
					'search_icon_style'  => 'style-1',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_search_bar_styling',
			array(
				'label'     => esc_html__( 'Search Bar Style', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'display_search_bar' => 'yes',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_search_icon_style' );
		$this->start_controls_tab(
			'tab_search_icon_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'search_icon_color',
			array(
				'label'     => esc_html__( 'Search Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .header-extra-icons li.search-icon .plus-post-search-icon svg,{{WRAPPER}} .header-extra-icons li.search-icon .plus-post-search-icon svg path' => 'fill: {{VALUE}};stroke: {{VALUE}}',
					'{{WRAPPER}} .header-extra-icons .icons-content-list .search-icon .plus-post-search-icon i' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'form_content_background',
				'label'     => esc_html__( 'Content Background', 'tpebl' ),
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .header-extra-icons .plus-search-form.plus-search-form-content,
				{{WRAPPER}} .plus-search-form.style-4 .plus-search-section input.plus-search-field',
				'condition' => array(
					'search_bar_content_style' => array( 'style-1', 'style-3', 'style-4' ),
				),
			)
		);
		$this->add_control(
			'form_content_background_2',
			array(
				'label'     => esc_html__( 'Content Background Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => array(
					'{{WRAPPER}} .header-extra-icons .plus-search-form.plus-search-form-content.style-2' => 'background: {{VALUE}}',
					'{{WRAPPER}} .plus-search-form.style-2 .plus-search-section:before' => 'border-bottom-color: {{VALUE}}',
				),
				'condition' => array(
					'search_bar_content_style' => 'style-2',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_search_icon_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'search_icon_color_hover',
			array(
				'label'     => esc_html__( 'Search Hover Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ff5a6e',
				'selectors' => array(
					'{{WRAPPER}} .header-extra-icons li.search-icon .plus-post-search-icon:hover svg,{{WRAPPER}} .header-extra-icons li.search-icon .plus-post-search-icon:hover svg path' => 'fill: {{VALUE}};stroke: {{VALUE}}',
					'{{WRAPPER}} .header-extra-icons .icons-content-list .search-icon .plus-post-search-icon:hover i' => 'color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'search_field_heading_options',
			array(
				'label'     => esc_html__( 'Search Field Style', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'search_field_typography',
				'label'    => esc_html__( 'Typography', 'tpebl' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				),
				'selector' => '{{WRAPPER}} .plus-search-form.plus-search-form-content input.plus-search-field',
			)
		);
		$this->start_controls_tabs( 'tabs_search_field_style' );
		$this->start_controls_tab(
			'tab_search_field_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'search_field_placeholder_color',
			array(
				'label'     => esc_html__( 'Placeholder Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#888',
				'selectors' => array(
					'{{WRAPPER}} .plus-search-form.plus-search-form-content input.plus-search-field::-webkit-input-placeholder' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'search_field_color',
			array(
				'label'     => esc_html__( 'Field Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .plus-search-form.plus-search-form-content input.plus-search-field' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'search_field_border',
				'label'     => esc_html__( 'Border', 'tpebl' ),
				'selector'  => '{{WRAPPER}} .plus-search-form.style-4 .plus-search-section input.plus-search-field',
				'condition' => array(
					'search_bar_content_style' => 'style-4',
				),
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'search_field_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-search-form.style-4 .plus-search-section input.plus-search-field' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'search_bar_content_style' => 'style-4',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'search_field_shadow',
				'selector'  => '{{WRAPPER}} .plus-search-form.style-4 .plus-search-section input.plus-search-field',
				'condition' => array(
					'search_bar_content_style' => 'style-4',
				),
			)
		);
		$this->add_control(
			'field_border_color_1',
			array(
				'label'     => esc_html__( 'Border Bottom Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .plus-search-form.plus-search-form-content input.plus-search-field' => 'border-bottom-color: {{VALUE}}',
				),
				'condition' => array(
					'search_bar_content_style' => 'style-1',
				),
			)
		);
		$this->add_control(
			'search_field_bg_2',
			array(
				'label'     => esc_html__( 'Field Background Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .plus-search-form.plus-search-form-content input.plus-search-field' => 'background: {{VALUE}}',
				),
				'condition' => array(
					'search_bar_content_style' => 'style-2',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_search_field_focus',
			array(
				'label' => esc_html__( 'Focus', 'tpebl' ),
			)
		);
		$this->add_control(
			'search_field_placeholder_focus_color',
			array(
				'label'     => esc_html__( 'Placeholder Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#888',
				'selectors' => array(
					'{{WRAPPER}} .plus-search-form.plus-search-form-content input.plus-search-field:focus::-webkit-input-placeholder' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'search_field_focus_color',
			array(
				'label'     => esc_html__( 'Field Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .plus-search-form.plus-search-form-content input.plus-search-field:focus' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'field_focus_border_color_1',
			array(
				'label'     => esc_html__( 'Border Bottom Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .plus-search-form.plus-search-form-content.style-1 input.plus-search-field:focus' => 'border-bottom-color: {{VALUE}}',
				),
				'condition' => array(
					'search_bar_content_style' => 'style-1',
				),
			)
		);
		$this->add_control(
			'search_field_focus_bg_2',
			array(
				'label'     => esc_html__( 'Field Background Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .plus-search-form.plus-search-form-content input.plus-search-field:focus' => 'background: {{VALUE}}',
				),
				'condition' => array(
					'search_bar_content_style' => 'style-2',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'search_field_border_bottom_1',
			array(
				'label'      => esc_html__( 'Search Field Border Width', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 20,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 2,
				),
				'separator'  => 'before',
				'selectors'  => array(
					'{{WRAPPER}} .plus-search-form.plus-search-form-content.style-1 input.plus-search-field' => 'border-bottom-width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'search_bar_content_style' => 'style-1',
				),
			)
		);
		$this->add_control(
			'search_submit_btn_heading_options',
			array(
				'label'     => esc_html__( 'Submit Button', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->start_controls_tabs( 'tabs_search_submit_btn_style' );
		$this->start_controls_tab(
			'tab_search_submit_btn_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'search_submit_btn_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .header-extra-icons li.search-icon .plus-search-form .plus-search-submit svg, .header-extra-icons li.search-icon .plus-search-form .plus-search-submit svg path' => 'fill: {{VALUE}};stroke: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_search_submit_btn_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'search_submit_btn_color_hover',
			array(
				'label'     => esc_html__( 'Icon Hover Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ff5a6e',
				'selectors' => array(
					'{{WRAPPER}} .header-extra-icons li.search-icon .plus-search-form .plus-search-submit:hover svg, .header-extra-icons li.search-icon .plus-search-form .plus-search-submit:hover svg path' => 'fill: {{VALUE}};stroke: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'search_close_btn_heading_options',
			array(
				'label'     => esc_html__( 'Search Close Button', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'search_bar_content_style' => array( 'style-1', 'style-3' ),
				),
			)
		);
		$this->add_control(
			'close_btn_border',
			array(
				'label'     => esc_html__( 'Box Border', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'default'   => 'no',
				'condition' => array(
					'search_bar_content_style' => array( 'style-1', 'style-3' ),
				),
			)
		);
		$this->add_responsive_control(
			'close_btn_border_width',
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
					'{{WRAPPER}} .plus-search-form .plus-search-close' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'search_bar_content_style' => array( 'style-1', 'style-3' ),
					'close_btn_border'         => 'yes',
				),
			)
		);
		$this->add_control(
			'close_btn_border_style',
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
					'{{WRAPPER}} .plus-search-form .plus-search-close' => 'border-style: {{VALUE}};',
				),
				'condition' => array(
					'search_bar_content_style' => array( 'style-1', 'style-3' ),
					'close_btn_border'         => 'yes',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_search_close_style' );
		$this->start_controls_tab(
			'tab_search_close_normal',
			array(
				'label'     => esc_html__( 'Normal', 'tpebl' ),
				'condition' => array(
					'search_bar_content_style' => array( 'style-1', 'style-3' ),
				),
			)
		);
		$this->add_control(
			'search_close_color',
			array(
				'label'     => esc_html__( 'Close Icon Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .plus-search-form .plus-search-close .search-close:before,{{WRAPPER}} .plus-search-form .plus-search-close .search-close:after' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'search_bar_content_style' => array( 'style-1', 'style-3' ),
				),
			)
		);
		$this->add_control(
			'close_btn_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}}  .plus-search-form .plus-search-close' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'search_bar_content_style' => array( 'style-1', 'style-3' ),
					'close_btn_border'         => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'close_btn_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-search-form .plus-search-close' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'search_bar_content_style' => array( 'style-1', 'style-3' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_search_close_hover',
			array(
				'label'     => esc_html__( 'Hover', 'tpebl' ),
				'condition' => array(
					'search_bar_content_style' => array( 'style-1', 'style-3' ),
				),
			)
		);
		$this->add_control(
			'search_close_color_hover',
			array(
				'label'     => esc_html__( 'Close Icon Hover Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ff5a6e',
				'selectors' => array(
					'{{WRAPPER}} .plus-search-form .plus-search-close:hover .search-close:before,{{WRAPPER}} .plus-search-form .plus-search-close:hover .search-close:after' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'search_bar_content_style' => array( 'style-1', 'style-3' ),
				),
			)
		);
		$this->add_control(
			'close_btn_border_hover_color',
			array(
				'label'     => esc_html__( 'Border Hover Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .plus-search-form .plus-search-close:hover' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'search_bar_content_style' => array( 'style-1', 'style-3' ),
					'close_btn_border'         => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'close_btn_border_hover_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-search-form .plus-search-close:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'search_bar_content_style' => array( 'style-1', 'style-3' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'close_btn_bg_options',
			array(
				'label'     => esc_html__( 'Background Options', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'search_bar_content_style' => array( 'style-1', 'style-3' ),
				),
			)
		);
		$this->start_controls_tabs( 'tabs_close_btn_background_style' );
		$this->start_controls_tab(
			'tab_close_btn_background_normal',
			array(
				'label'     => esc_html__( 'Normal', 'tpebl' ),
				'condition' => array(
					'search_bar_content_style' => array( 'style-1', 'style-3' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'close_btn_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .plus-search-form .plus-search-close',
				'condition' => array(
					'search_bar_content_style' => array( 'style-1', 'style-3' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_close_btn_background_hover',
			array(
				'label'     => esc_html__( 'Hover', 'tpebl' ),
				'condition' => array(
					'search_bar_content_style' => array( 'style-1', 'style-3' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'close_btn_hover_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .plus-search-form .plus-search-close:hover',
				'condition' => array(
					'search_bar_content_style' => array( 'style-1', 'style-3' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'close_btn_shadow_options',
			array(
				'label'     => esc_html__( 'Box Shadow Options', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'search_bar_content_style' => array( 'style-1', 'style-3' ),
				),
			)
		);
		$this->start_controls_tabs( 'tabs_close_btn_shadow_style' );
		$this->start_controls_tab(
			'tab_close_btn_shadow_normal',
			array(
				'label'     => esc_html__( 'Normal', 'tpebl' ),
				'condition' => array(
					'search_bar_content_style' => array( 'style-1', 'style-3' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'close_btn_shadow',
				'selector'  => '{{WRAPPER}} .plus-search-form .plus-search-close',
				'condition' => array(
					'search_bar_content_style' => array( 'style-1', 'style-3' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_close_btn_shadow_hover',
			array(
				'label'     => esc_html__( 'Hover', 'tpebl' ),
				'condition' => array(
					'search_bar_content_style' => array( 'style-1', 'style-3' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'close_btn_hover_shadow',
				'selector'  => '{{WRAPPER}} .plus-search-form .plus-search-close:hover',
				'condition' => array(
					'search_bar_content_style' => array( 'style-1', 'style-3' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'search_custom_img_heads',
			array(
				'label'     => esc_html__( 'Custom Image', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'search_icon_style' => array( 'style-custom-image' ),
				),
			)
		);
		$this->add_control(
			'search_custom_img_heads_options',
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
			'section_mini_cart_options',
			array(
				'label' => esc_html__( 'Cart Options', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'display_mini_cart',
			array(
				'label'     => esc_html__( 'Display Cart', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'tpebl' ),
				'label_off' => esc_html__( 'Off', 'tpebl' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'cart_icon_style',
			array(
				'label'     => esc_html__( 'Toggle Style', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style-1',
				'options'   => array(
					'style-1' => esc_html__( 'Style 1', 'tpebl' ),
					'style-2' => esc_html__( 'Style 2 (Pro)', 'tpebl' ),
				),
				'condition' => array(
					'display_mini_cart' => 'yes',
				),
			)
		);
		$this->add_control(
			'cart_icon_style_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'display_mini_cart' => 'yes',
					'cart_icon_style'   => 'style-2',
				),
			)
		);
		$this->add_responsive_control(
			'cart_extra_content_width_st1',
			array(
				'label'      => esc_html__( 'Open Content Width', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .header-extra-icons .mini-cart-icon .widget.woocommerce.widget_shopping_cart,
					{{WRAPPER}} .header-extra-icons .mini-cart-icon .widget_shopping_cart .cart_list,
					{{WRAPPER}} .header-extra-icons .mini-cart-icon .tpmc-header-extra-toggle-content-ext' => 'width: {{SIZE}}{{UNIT}};max-width: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'display_mini_cart' => 'yes',
					'cart_icon_style'   => 'style-1',
				),
			)
		);
		$this->add_responsive_control(
			'cart_extra_content_height_st1',
			array(
				'label'      => esc_html__( 'Open Content Height', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .header-extra-icons .mini-cart-icon .widget.woocommerce.widget_shopping_cart,
					{{WRAPPER}} .header-extra-icons .mini-cart-icon .widget_shopping_cart .cart_list,
					{{WRAPPER}} .header-extra-icons .mini-cart-icon .tpmc-header-extra-toggle-content-ext' => 'height: {{SIZE}}{{UNIT}};max-height: {{SIZE}}{{UNIT}};min-height: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'display_mini_cart' => 'yes',
					'cart_icon_style'   => 'style-1',
				),
			)
		);
		$this->add_responsive_control(
			'cart_pro_ani_speed',
			array(
				'label'     => esc_html__( 'Cart Product Transition Duration', 'tpebl' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'step' => 0.1,
						'min'  => 0.1,
						'max'  => 10,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .header-extra-icons .mini-cart-icon .widget.woocommerce.widget_shopping_cart' => 'transition: all {{SIZE}}s ;-webkit-transition: all {{SIZE}}s;-moz-transition: all {{SIZE}}s ;-ms-transition: all {{SIZE}}s;',
				),
				'condition' => array(
					'display_mini_cart' => 'yes',
					'cart_icon_style'   => 'style-1',
				),
			)
		);

		$this->add_control(
			'cart_icon',
			array(
				'label'     => esc_html__( 'Cart Icon', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'default',
				'options'   => array(
					'default'           => esc_html__( 'Default', 'tpebl' ),
					'cart_custom_icon'  => esc_html__( 'Custom Icon (Pro)', 'tpebl' ),
					'cart_custom_image' => esc_html__( 'Custom Image (Pro)', 'tpebl' ),
				),
				'condition' => array(
					'display_mini_cart' => 'yes',
					'cart_icon_style'   => 'style-1',
				),
			)
		);
		$this->add_control(
			'cart_offer_text',
			array(
				'label'     => esc_html__( 'Mini Cart Offer Text', 'tpebl' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Free Shipping on All Orders Over $100', 'tpebl' ),
				'separator' => 'before',
				'condition' => array(
					'display_mini_cart' => 'yes',
					'cart_icon_style'   => 'style-1',
				),
			)
		);
		$this->add_control(
			'cart_offer_text_offset',
			array(
				'label'      => esc_html__( 'Offset', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => -400,
						'max'  => 400,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .header-extra-icons .mini-cart-icon .mc-extra-bottom-con' => 'margin-top: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'display_mini_cart' => 'yes',
					'cart_icon_style'   => 'style-1',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_cart_styling',
			array(
				'label'     => esc_html__( 'Cart Icon Style', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'display_mini_cart' => 'yes',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_cart_icon_style' );
		$this->start_controls_tab(
			'tab_cart_icon_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'cart_icon_color',
			array(
				'label'     => esc_html__( 'Cart Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .header-extra-icons li.mini-cart-icon .plus-cart-icon.style-1 svg,{{WRAPPER}} .header-extra-icons li.mini-cart-icon .plus-cart-icon.style-1 svg path,{{WRAPPER}} .header-extra-icons li.mini-cart-icon .plus-cart-icon.style-2 svg,{{WRAPPER}} .header-extra-icons li.mini-cart-icon .plus-cart-icon.style-2 svg path' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .header-extra-icons .mini-cart-icon .cart_custom_icon i' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_cart_icon_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'cart_icon_color_hover',
			array(
				'label'     => esc_html__( 'Cart Hover Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .header-extra-icons li.mini-cart-icon .plus-cart-icon.style-1:hover svg,{{WRAPPER}} .header-extra-icons li.mini-cart-icon .plus-cart-icon.style-1:hover svg path,{{WRAPPER}} .header-extra-icons li.mini-cart-icon .plus-cart-icon.style-2:hover svg,{{WRAPPER}} .header-extra-icons li.mini-cart-icon .plus-cart-icon.style-2:hover svg path' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .header-extra-icons .mini-cart-icon .plus-cart-icon.cart_custom_icon:hover i' => 'color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'cart_count_style_heading_options',
			array(
				'label'     => esc_html__( 'Cart Count', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'cart_count_typography',
				'label'    => esc_html__( 'Cart Count Typography', 'tpebl' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				),
				'selector' => '{{WRAPPER}} .header-extra-icons li.mini-cart-icon .plus-cart-icon .cart-wrap span',
			)
		);
		$this->start_controls_tabs( 'tabs_cart_count_style' );
		$this->start_controls_tab(
			'tab_cart_count_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'cart_count_color',
			array(
				'label'     => esc_html__( 'Count Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => array(
					'{{WRAPPER}} .header-extra-icons li.mini-cart-icon .plus-cart-icon .cart-wrap span' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'cart_count_background',
				'label'    => esc_html__( 'Background', 'tpebl' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .header-extra-icons li.mini-cart-icon .plus-cart-icon .cart-wrap span',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_cart_count_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'cart_count_color_hover',
			array(
				'label'     => esc_html__( 'Count Hover Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => array(
					'{{WRAPPER}} .header-extra-icons li.mini-cart-icon .plus-cart-icon:hover .cart-wrap span' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'cart_count_background_hover',
				'label'    => esc_html__( 'Background', 'tpebl' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .header-extra-icons li.mini-cart-icon .plus-cart-icon:hover .cart-wrap span',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'mini_cart_style_heading_options',
			array(
				'label'     => esc_html__( 'Mini Cart Background', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->start_controls_tabs( 'tabs_mini_cart_bg_style' );
		$this->start_controls_tab(
			'tab_mini_cart_bg_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_responsive_control(
			'min_cart_box_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .header-extra-icons .mini-cart-icon.style-1 .widget_shopping_cart_content,
					{{WRAPPER}} .header-extra-icons .mini-cart-icon.style-2 .tpmc-header-extra-toggle-content,
					{{WRAPPER}} .header-extra-icons .mini-cart-icon .tpmc-header-extra-toggle-content-ext.open' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'mini_cart_bg_background',
				'label'    => esc_html__( 'Background', 'tpebl' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .header-extra-icons .mini-cart-icon.style-1 .widget_shopping_cart_content,
				{{WRAPPER}} .header-extra-icons .mini-cart-icon.style-2 .tpmc-header-extra-toggle-content,
					{{WRAPPER}} .header-extra-icons .mini-cart-icon .tpmc-header-extra-toggle-content-ext.open',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'min_cart_box_shadow',
				'selector'  => '{{WRAPPER}} .header-extra-icons .mini-cart-icon .tpmc-header-extra-toggle-content-ext.open',
				'separator' => 'before',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_mini_cart_bg_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_responsive_control(
			'min_cart_box_radius_hover',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .header-extra-icons .mini-cart-icon.style-1 .widget_shopping_cart_content:hover,
					{{WRAPPER}} .header-extra-icons .mini-cart-icon.style-2 .tpmc-header-extra-toggle-content:hover,
					{{WRAPPER}} .header-extra-icons .mini-cart-icon .tpmc-header-extra-toggle-content-ext.open:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'mini_cart_bg_hover',
				'label'    => esc_html__( 'Background', 'tpebl' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .header-extra-icons .mini-cart-icon.style-1 .widget_shopping_cart_content:hover,
				{{WRAPPER}} .header-extra-icons .mini-cart-icon.style-2 .tpmc-header-extra-toggle-content:hover,
					{{WRAPPER}} .header-extra-icons .mini-cart-icon .tpmc-header-extra-toggle-content-ext.open:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'min_cart_box_shadow_hover',
				'selector'  => '{{WRAPPER}} .header-extra-icons .mini-cart-icon .tpmc-header-extra-toggle-content-ext.open:hover',
				'separator' => 'before',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'mini_cart_style_heading_options_bt',
			array(
				'label'     => esc_html__( 'Mini Cart Bottom Text Background', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'mini_cart_etext_typography',
				'label'    => esc_html__( 'Cart Title Typography', 'tpebl' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				),
				'selector' => '{{WRAPPER}} .header-extra-icons .mini-cart-icon .mc-extra-bottom-con',
			)
		);

		$this->start_controls_tabs( 'tabs_mini_cart_bg_style_bt' );
		$this->start_controls_tab(
			'tab_mini_cart_bg_normal_bt',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'cart_etext_color',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .header-extra-icons .mini-cart-icon .mc-extra-bottom-con' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_responsive_control(
			'min_cart_box_radius_bt',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .header-extra-icons .mini-cart-icon .mc-extra-bottom-con' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'mini_cart_bg_background_bt',
				'label'    => esc_html__( 'Background', 'tpebl' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .header-extra-icons .mini-cart-icon .tpmc-header-extra-toggle-content-ext.open,{{WRAPPER}} .header-extra-icons .mini-cart-icon .mc-extra-bottom-con',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'min_cart_box_shadow_bt',
				'selector'  => '{{WRAPPER}} .header-extra-icons .mini-cart-icon .mc-extra-bottom-con',
				'separator' => 'before',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_mini_cart_bg_hover_bt',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'cart_etext_color_h',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .header-extra-icons .mini-cart-icon .tpmc-header-extra-toggle-content-ext.open:hover .mc-extra-bottom-con' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_responsive_control(
			'min_cart_box_radius_hover_bt',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .header-extra-icons .mini-cart-icon .tpmc-header-extra-toggle-content-ext.open:hover .mc-extra-bottom-con' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'mini_cart_bg_hover_bt',
				'label'    => esc_html__( 'Background', 'tpebl' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .header-extra-icons .mini-cart-icon .tpmc-header-extra-toggle-content-ext.open:hover .mc-extra-bottom-con',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'min_cart_box_shadow_hover_bt',
				'selector'  => '{{WRAPPER}} .header-extra-icons .mini-cart-icon .tpmc-header-extra-toggle-content-ext.open:hover .mc-extra-bottom-con',
				'separator' => 'before',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_mini_cart_styling',
			array(
				'label'     => esc_html__( 'Mini Cart Style', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'display_mini_cart' => 'yes',
				),
			)
		);
		$this->add_control(
			'cart_inner_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'display_mini_cart' => 'yes',
					'cart_icon_style'   => 'style-2',
				),
			)
		);
		$this->add_control(
			'mini_cart_empty_heading',
			array(
				'label'     => esc_html__( 'Empty Cart Style', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'mini_cart_empty_icon_size',
			array(
				'label'      => esc_html__( 'Icon Size', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 300,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .woocommerce-mini-cart__empty-message:before' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'mini_cart_empty_icon_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce-mini-cart__empty-message:before' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'mini_cart_empty_text_size',
			array(
				'label'      => esc_html__( 'Text Size', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 300,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .widget_shopping_cart_content .woocommerce-mini-cart__empty-message' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'mini_cart_empty_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .widget_shopping_cart_content .woocommerce-mini-cart__empty-message' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'mini_cart_title_heading',
			array(
				'label'     => esc_html__( 'Title Style', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'mini_cart_title_typography',
				'label'    => esc_html__( 'Cart Title Typography', 'tpebl' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				),
				'selector' => '{{WRAPPER}} .header-extra-icons .mini-cart-icon .widget_shopping_cart .cart_list li > a:not(.remove)',
			)
		);
		$this->start_controls_tabs( 'tabs_mini_cart_title_style' );
		$this->start_controls_tab(
			'tab_cart_title_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'cart_title_color',
			array(
				'label'     => esc_html__( 'Title Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .header-extra-icons .mini-cart-icon .widget_shopping_cart .cart_list li > a:not(.remove)' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_cart_title_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'cart_title_color_hover',
			array(
				'label'     => esc_html__( 'Count Title Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#8072fc',
				'selectors' => array(
					'{{WRAPPER}} .header-extra-icons .mini-cart-icon .widget_shopping_cart .cart_list li > a:not(.remove):hover' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'mini_cart_quantity_heading',
			array(
				'label'     => esc_html__( 'Quantity Style', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'mini_cart_quantity_typography',
				'label'    => esc_html__( 'Cart Quantity Typography', 'tpebl' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				),
				'selector' => '{{WRAPPER}} .header-extra-icons .mini-cart-icon .widget_shopping_cart .cart_list li .quantity',
			)
		);
		$this->start_controls_tabs( 'tabs_mini_cart_quantity_style' );
		$this->start_controls_tab(
			'tab_cart_quantity_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'cart_quantity_color',
			array(
				'label'     => esc_html__( 'Quantity Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#848484',
				'selectors' => array(
					'{{WRAPPER}} .header-extra-icons .mini-cart-icon .widget_shopping_cart .cart_list li .quantity,{{WRAPPER}} .header-extra-icons .mini-cart-icon .widget_shopping_cart .cart_list li .quantity span' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'cart_remove_color',
			array(
				'label'     => esc_html__( 'Remove Cart Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#848484',
				'selectors' => array(
					'{{WRAPPER}} .header-extra-icons .mini-cart-icon .widget_shopping_cart .cart_list li a.remove' => 'color: {{VALUE}} !important',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_cart_quantity_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'cart_quantity_color_hover',
			array(
				'label'     => esc_html__( 'Count Quantity Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#848484',
				'selectors' => array(
					'{{WRAPPER}} .header-extra-icons .mini-cart-icon .widget_shopping_cart .cart_list li:hover .quantity,{{WRAPPER}} .header-extra-icons .mini-cart-icon .widget_shopping_cart .cart_list li:hover .quantity span' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'cart_remove_color_hover',
			array(
				'label'     => esc_html__( 'Remove Cart Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#848484',
				'selectors' => array(
					'{{WRAPPER}} .header-extra-icons .mini-cart-icon .widget_shopping_cart .cart_list li a.remove:hover' => 'color: {{VALUE}} !important',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'mini_cart_sep_heading',
			array(
				'label'     => esc_html__( 'Separator Style', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'mini_cart_sep_border_style',
			array(
				'label'     => esc_html__( 'Separator Style', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'solid',
				'options'   => l_theplus_get_border_style(),
				'selectors' => array(
					'{{WRAPPER}} .header-extra-icons .mini-cart-icon .widget_shopping_cart .cart_list > li' => 'border-bottom: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'mini_cart_sep_border_width',
			array(
				'label'      => esc_html__( 'Separator Width', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .header-extra-icons .mini-cart-icon .widget_shopping_cart .cart_list > li' => 'border-width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'mini_cart_sep_border_color',
			array(
				'label'     => esc_html__( 'Separator Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .header-extra-icons .mini-cart-icon .widget_shopping_cart .cart_list > li' => 'border-color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'mini_cart_in_img_heading',
			array(
				'label'     => esc_html__( 'Cart Product Image Style', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'mini_cart_in_img_size',
			array(
				'label'      => esc_html__( 'Image Size', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 10,
						'max'  => 500,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .header-extra-icons .mini-cart-icon .widget_shopping_cart .cart_list li > a > img' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'display_scrolling_bar' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'mini_cart_in_img_border',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .header-extra-icons .mini-cart-icon .widget_shopping_cart .cart_list li > a > img',
			)
		);
		$this->add_responsive_control(
			'mini_cart_in_img_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .header-extra-icons .mini-cart-icon .widget_shopping_cart .cart_list li > a > img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'mini_cart_in_img_shadow',
				'selector' => '{{WRAPPER}} .header-extra-icons .mini-cart-icon .widget_shopping_cart .cart_list li > a > img',
			)
		);
		$this->add_control(
			'mini_cart_subtotal_heading',
			array(
				'label'     => esc_html__( 'SubTotal/Price Style', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->start_controls_tabs( 'tabs_min_cart_subtotal_style' );
		$this->start_controls_tab(
			'tab_min_cart_subtotal_normal',
			array(
				'label' => esc_html__( 'SubTotal', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'mini_cart_subtotal_typography',
				'label'    => esc_html__( 'Sub-Total Typography', 'tpebl' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				),
				'selector' => '{{WRAPPER}} .header-extra-icons .mini-cart-icon .total strong',
			)
		);
		$this->add_control(
			'cart_subtotal_color',
			array(
				'label'     => esc_html__( 'Sub-Total Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .header-extra-icons .mini-cart-icon .total strong' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_min_cart_subtotal_price',
			array(
				'label' => esc_html__( 'Total Price', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'mini_cart_price_typography',
				'label'    => esc_html__( 'Total Price Typography', 'tpebl' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				),
				'selector' => '{{WRAPPER}} .header-extra-icons .mini-cart-icon .widget_shopping_cart .total span.amount',
			)
		);
		$this->add_control(
			'cart_price_color',
			array(
				'label'     => esc_html__( 'Total Price Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .header-extra-icons .mini-cart-icon .widget_shopping_cart .total span.amount' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'mini_cart_btn_heading',
			array(
				'label'     => esc_html__( 'Buttons Style', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->start_controls_tabs( 'tabs_min_cart_btn_style' );
		$this->start_controls_tab(
			'tab_min_cart_btn_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'min_cart_btn_border_style',
			array(
				'label'     => esc_html__( 'Border Style', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'none',
				'options'   => array(
					'none'   => esc_html__( 'None', 'tpebl' ),
					'solid'  => esc_html__( 'Solid', 'tpebl' ),
					'dotted' => esc_html__( 'Dotted', 'tpebl' ),
					'dashed' => esc_html__( 'Dashed', 'tpebl' ),
					'groove' => esc_html__( 'Groove', 'tpebl' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .header-extra-icons .mini-cart-icon .widget_shopping_cart a.button' => 'border-style: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'min_cart_btn_border_width',
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
					'{{WRAPPER}} .header-extra-icons .mini-cart-icon .widget_shopping_cart a.button' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'min_cart_btn_border_style!' => 'none',
				),
			)
		);

		$this->add_responsive_control(
			'min_cart_btn_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .header-extra-icons .mini-cart-icon .widget_shopping_cart a.button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'min_cart_btn_shadow',
				'selector' => '{{WRAPPER}} .header-extra-icons .mini-cart-icon .widget_shopping_cart a.button',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_min_cart_btn_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_responsive_control(
			'min_cart_btn_hover_radius',
			array(
				'label'      => esc_html__( 'Hover Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .header-extra-icons .mini-cart-icon .widget_shopping_cart a.button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'min_cart_btn_hover_shadow',
				'selector' => '{{WRAPPER}} .header-extra-icons .mini-cart-icon .widget_shopping_cart a.button:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'mini_cart_view_btn_heading',
			array(
				'label'     => esc_html__( 'View Cart Button', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'mini_cart_view_btn_padding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'default'    => array(
					'top'      => '10',
					'right'    => '15',
					'bottom'   => '10',
					'left'     => '15',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .header-extra-icons .mini-cart-icon .widget_shopping_cart a.button:not(.checkout)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'mini_cart_view_btn_typography',
				'selector' => '{{WRAPPER}} .header-extra-icons .mini-cart-icon .widget_shopping_cart a.button:not(.checkout)',
			)
		);
		$this->start_controls_tabs( 'tabs_min_cart_view_btn_style' );
		$this->start_controls_tab(
			'tab_min_cart_view_btn_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'min_cart_view_btn_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .header-extra-icons .mini-cart-icon .widget_shopping_cart a.button:not(.checkout)' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'min_cart_view_btn_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .header-extra-icons .mini-cart-icon .widget_shopping_cart a.button:not(.checkout)',
			)
		);
		$this->add_control(
			'min_cart_view_btn_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .header-extra-icons .mini-cart-icon .widget_shopping_cart a.button:not(.checkout)' => 'border-color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_min_cart_view_btn_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'min_cart_view_btn_text_color_hover',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .header-extra-icons .mini-cart-icon .widget_shopping_cart a.button:not(.checkout):hover' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'min_cart_view_btn_background_hover',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .header-extra-icons .mini-cart-icon .widget_shopping_cart a.button:not(.checkout):hover',
			)
		);
		$this->add_control(
			'min_cart_view_btn_border_hover_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .header-extra-icons .mini-cart-icon .widget_shopping_cart a.button:not(.checkout):hover' => 'border-color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'mini_cart_checkout_btn_heading',
			array(
				'label'     => esc_html__( 'Checkout Button', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'mini_cart_checkout_btn_padding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'default'    => array(
					'top'      => '10',
					'right'    => '15',
					'bottom'   => '10',
					'left'     => '15',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .header-extra-icons .mini-cart-icon .widget_shopping_cart a.button.checkout' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'mini_cart_checkout_btn_typography',
				'selector' => '{{WRAPPER}} .header-extra-icons .mini-cart-icon .widget_shopping_cart a.button.checkout',
			)
		);
		$this->start_controls_tabs( 'tabs_min_cart_checkout_btn_style' );
		$this->start_controls_tab(
			'tab_min_cart_checkout_btn_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'min_cart_checkout_btn_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .header-extra-icons .mini-cart-icon .widget_shopping_cart a.button.checkout' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'min_cart_checkout_btn_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .header-extra-icons .mini-cart-icon .widget_shopping_cart a.button.checkout',
			)
		);
		$this->add_control(
			'min_cart_checkout_btn_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .header-extra-icons .mini-cart-icon .widget_shopping_cart a.button.checkout' => 'border-color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_min_cart_checkout_btn_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'min_cart_checkout_btn_text_color_hover',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .header-extra-icons .mini-cart-icon .widget_shopping_cart a.button.checkout:hover' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'min_cart_checkout_btn_background_hover',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .header-extra-icons .mini-cart-icon .widget_shopping_cart a.button.checkout:hover',
			)
		);
		$this->add_control(
			'min_cart_checkout_btn_border_hover_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .header-extra-icons .mini-cart-icon .widget_shopping_cart a.button.checkout:hover' => 'border-color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'display_scrolling_bar',
			array(
				'label'     => esc_html__( 'Content Scrolling Bar', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'default'   => 'yes',
				'separator' => 'before',
			)
		);

		$this->start_controls_tabs( 'tabs_scrolling_bar_style' );
		$this->start_controls_tab(
			'tab_scrolling_bar_scrollbar',
			array(
				'label'     => esc_html__( 'Scrollbar', 'tpebl' ),
				'condition' => array(
					'display_scrolling_bar' => 'yes',
				),
			)
		);
		$this->add_control(
			'scroll_scrollbar_width',
			array(
				'label'      => esc_html__( 'ScrollBar Width', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 10,
				),
				'selectors'  => array(
					'.header-extra-icons .mini-cart-icon .widget_shopping_cart.open .cart_list::-webkit-scrollbar' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'display_scrolling_bar' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'scroll_scrollbar_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '.header-extra-icons .mini-cart-icon .widget_shopping_cart.open .cart_list::-webkit-scrollbar',
				'condition' => array(
					'display_scrolling_bar' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_scrolling_bar_thumb',
			array(
				'label'     => esc_html__( 'Thumb', 'tpebl' ),
				'condition' => array(
					'display_scrolling_bar' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'scroll_thumb_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '.header-extra-icons .mini-cart-icon .widget_shopping_cart.open .cart_list::-webkit-scrollbar-thumb',
				'condition' => array(
					'display_scrolling_bar' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'scroll_thumb_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'.header-extra-icons .mini-cart-icon .widget_shopping_cart.open .cart_list::-webkit-scrollbar-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'display_scrolling_bar' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'scroll_thumb_shadow',
				'selector'  => '.header-extra-icons .mini-cart-icon .widget_shopping_cart.open .cart_list::-webkit-scrollbar-thumb',
				'condition' => array(
					'display_scrolling_bar' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_scrolling_bar_track',
			array(
				'label'     => esc_html__( 'Track', 'tpebl' ),
				'condition' => array(
					'display_scrolling_bar' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'scroll_track_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '.header-extra-icons .mini-cart-icon .widget_shopping_cart.open .cart_list::-webkit-scrollbar-track',
				'condition' => array(
					'display_scrolling_bar' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'scroll_track_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'.header-extra-icons .mini-cart-icon .widget_shopping_cart.open .cart_list::-webkit-scrollbar-track' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'display_scrolling_bar' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'scroll_track_shadow',
				'selector'  => '.header-extra-icons .mini-cart-icon .widget_shopping_cart.open .cart_list::-webkit-scrollbar-track',
				'condition' => array(
					'display_scrolling_bar' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'mc_close_heading_options',
			array(
				'label'     => esc_html__( 'Close Icon Style', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'cart_icon_style' => 'style-2',
				),
			)
		);
		$this->add_control(
			'mc_close_heading_options_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'cart_icon_style' => 'style-2',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_extra_toggle_bar_options',
			array(
				'label' => esc_html__( 'Extra Toggle Bar', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'display_extra_toggle_bar',
			array(
				'label'     => esc_html__( 'Display Toggle Bar', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'tpebl' ),
				'label_off' => esc_html__( 'Off', 'tpebl' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'extra_toggle_style',
			array(
				'label'     => esc_html__( 'Toggle Style', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style-1',
				'options'   => array(
					'style-1' => esc_html__( 'Style 1 (Pro)', 'tpebl' ),
					'style-2' => esc_html__( 'Style 2 (Pro)', 'tpebl' ),
					'style-3' => esc_html__( 'Style 3 (Pro)', 'tpebl' ),
					'style-4' => esc_html__( 'Style 4 (Pro)', 'tpebl' ),
					'style-5' => esc_html__( 'Custom (Pro)', 'tpebl' ),
				),
				'condition' => array(
					'display_extra_toggle_bar' => 'yes',
				),
			)
		);
		$this->add_control(
			'extra_toggle_style_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'display_extra_toggle_bar' => 'yes',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_extra_toggle_bar_styling',
			array(
				'label'     => esc_html__( 'Extra Toggle Bar', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'display_extra_toggle_bar' => 'yes',
				),
			)
		);
		$this->add_control(
			'section_extra_toggle_bar_styling_options',
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
			'section_language_switcher_wpml_styling',
			array(
				'label'     => esc_html__( 'WPML Language Switcher', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'display_language_switcher' => 'yes',
					'select_trans'              => 'p_wpml',
				),
			)
		);
		$this->add_control(
			'section_language_switcher_wpml_styling_options',
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
			'section_language_switcher_translatepress_styling',
			array(
				'label'     => esc_html__( 'Translatepress Language Switcher', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'display_language_switcher' => 'yes',
					'select_trans'              => 'p_translatepress',
				),
			)
		);
		$this->add_control(
			'section_language_switcher_translatepress_styling_options',
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
			'section_wpml_lang_switch_options',
			array(
				'label' => esc_html__( 'Language Switcher', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'display_language_switcher',
			array(
				'label'     => esc_html__( 'Display Language Switcher', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'tpebl' ),
				'label_off' => esc_html__( 'Off', 'tpebl' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'select_trans',
			array(
				'label'     => esc_html__( 'Select', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'p_wpml',
				'options'   => array(
					'p_wpml'           => esc_html__( 'WPML (Pro)', 'tpebl' ),
					'p_translatepress' => esc_html__( 'Translatepress (Pro)', 'tpebl' ),
				),
				'condition' => array(
					'display_language_switcher' => 'yes',
				),
			)
		);
		$this->add_control(
			'select_trans_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'display_language_switcher' => 'yes',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_music_bar_options',
			array(
				'label' => esc_html__( 'Music Options', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'display_music_bar',
			array(
				'label'     => esc_html__( 'Display Music', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'tpebl' ),
				'label_off' => esc_html__( 'Off', 'tpebl' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'display_music_bar_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'display_music_bar' => array( 'yes' ),
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_music_bar_styling',
			array(
				'label'     => esc_html__( 'Music Bar Style', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'display_music_bar' => 'yes',
				),
			)
		);
		$this->add_control(
			'section_music_bar_styling_options',
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
			'section_call_to_action_1_options',
			array(
				'label' => esc_html__( 'Call To Action 1', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'display_call_to_action_1',
			array(
				'label'     => esc_html__( 'Display Call To Action', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'tpebl' ),
				'label_off' => esc_html__( 'Off', 'tpebl' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'display_call_to_action_1_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'display_call_to_action_1' => array( 'yes' ),
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_styling',
			array(
				'label'     => esc_html__( 'Call To Action 1', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'display_call_to_action_1' => 'yes',
				),
			)
		);
		$this->add_control(
			'section_styling_options',
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
			'section_call_to_action_2_options',
			array(
				'label' => esc_html__( 'Call To Action 2', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'display_call_to_action_2',
			array(
				'label'     => esc_html__( 'Display Call To Action', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'tpebl' ),
				'label_off' => esc_html__( 'Off', 'tpebl' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'display_call_to_action_2_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'display_call_to_action_2' => array( 'yes' ),
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_button_2_styling',
			array(
				'label'     => esc_html__( 'Call To Action 2', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'display_call_to_action_2' => 'yes',
				),
			)
		);
		$this->add_control(
			'section_button_2_styling_options',
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
			'section_extra_options',
			array(
				'label' => esc_html__( 'Extra Options', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'icon_alignment',
			array(
				'label'       => esc_html__( 'Alignment', 'tpebl' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => array(
					'flex-left' => array(
						'title' => esc_html__( 'Left', 'tpebl' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center'    => array(
						'title' => esc_html__( 'Center', 'tpebl' ),
						'icon'  => 'eicon-text-align-center',
					),
					'flex-end'  => array(
						'title' => esc_html__( 'Right', 'tpebl' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'     => 'flex-start',
				'toggle'      => true,
				'label_block' => false,
				'selectors'   => array(
					'{{WRAPPER}} .header-extra-icons ul.icons-content-list' => ' -webkit-justify-content: {{VALUE}};-moz-justify-content: {{VALUE}};-ms-justify-content: {{VALUE}};justify-content: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'icon_between_padding',
			array(
				'label'      => esc_html__( 'Icon Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .header-extra-icons ul.icons-content-list > li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_extra_option',
			array(
				'label' => esc_html__( 'Extra Option', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'sticky_options',
			array(
				'label'     => esc_html__( 'Sticky Options', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'sticky_options_pro',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'sticky_options' => array( 'yes' ),
				),
			)
		);
		$this->end_controls_section();

		include L_THEPLUS_PATH . 'modules/widgets/theplus-needhelp.php';
		include L_THEPLUS_PATH . 'modules/widgets/theplus-profeatures.php';
	}

	/**
	 * Render Header-Extras.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	protected function render() {

		$settings          = $this->get_settings_for_display();
		$search_icon_style = ! empty( $settings['search_icon_style'] ) ? $settings['search_icon_style'] : 'style-1';
		$cart_icon         = ! empty( $settings['cart_icon'] ) ? $settings['cart_icon'] : 'default';
		$search_style      = ! empty( $settings['search_bar_content_style'] ) ? $settings['search_bar_content_style'] : 'style-1';
		$search_text       = ! empty( $settings['search_placeholder_text'] ) ? $settings['search_placeholder_text'] : '';
		$search_on         = ! empty( $settings['display_search_bar'] ) ? $settings['display_search_bar'] : '';
		$cart_on           = ! empty( $settings['display_mini_cart'] ) ? $settings['display_mini_cart'] : '';
		$editor_mode       = \Elementor\Plugin::$instance->editor->is_edit_mode();

		$widget_uid = $this->get_id();

		$meta_content      = '<div class="header-extra-icons">';
			$meta_content .= '<div class="header-icons-inner">';

		if ( ! empty( $settings['sequence_icons'] ) ) {
			$meta_content .= '<ul class="icons-content-list">';
			foreach ( $settings['sequence_icons'] as $index => $item ) :
						$select_icon_list      = $item['select_icon_list'];
						$responsive_class_attr = '';

				$rhd = ! empty( $item['responsive_hidden_desktop'] ) ? $item['responsive_hidden_desktop'] : '';
				$rht = ! empty( $item['responsive_hidden_tablet'] ) ? $item['responsive_hidden_tablet'] : '';
				$rhm = ! empty( $item['responsive_hidden_mobile'] ) ? $item['responsive_hidden_mobile'] : '';

				if ( 'yes' === $rhd ) {
					$responsive_class_attr .= ' header-extra-icons-hidden-desktop';
				}
				if ( 'yes' === $rht ) {
						$responsive_class_attr .= ' header-extra-icons-hidden-tablet';
				}
				if ( 'yes' === $rhm ) {
						$responsive_class_attr .= ' header-extra-icons-hidden-mobile';
				}

				if ( 'yes' === $search_on && 'search' === $select_icon_list ) {
					$meta_content     .= '<li class="search-icon elementor-repeater-item-' . esc_attr( $item['_id'] ) . ' ' . esc_attr( $responsive_class_attr ) . '">';
					$meta_content     .= '<div class="content-icon-list">';
						$meta_content .= '<div class="plus-post-search-icon ' . esc_attr( $search_icon_style ) . '">';
					if ( 'style-1' === $search_icon_style ) {
						$meta_content .= '<?xml version="1.0" encoding="UTF-8"?><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 50 50" version="1.1" width="100px" height="100px"><g id="surface1"><path style=" " d="M 21 3 C 11.621094 3 4 10.621094 4 20 C 4 29.378906 11.621094 37 21 37 C 24.710938 37 28.140625 35.804688 30.9375 33.78125 L 44.09375 46.90625 L 46.90625 44.09375 L 33.90625 31.0625 C 36.460938 28.085938 38 24.222656 38 20 C 38 10.621094 30.378906 3 21 3 Z M 21 5 C 29.296875 5 36 11.703125 36 20 C 36 28.296875 29.296875 35 21 35 C 12.703125 35 6 28.296875 6 20 C 6 11.703125 12.703125 5 21 5 Z "/></g></svg>';
					}

					$meta_content   .= '</div>';
					$st3_4_search_op = '';

					if ( 'style-3' === $search_style || 'style-4' === $search_style ) {
						$st3_4_search_op = ! empty( $settings['search_bar_open_content_style'] ) ? $settings['search_bar_open_content_style'] : 'sboc_left';
					}

					$meta_content .= '<div class="plus-search-form plus-search-form-content ' . esc_attr( $search_style ) . ' ' . esc_attr( $st3_4_search_op ) . '" data-style="' . esc_attr( $search_style ) . '">';

						$meta_content .= '<div class="plus-search-close"><div class="search-close"></div></div>';
						$meta_content .= '<div class="plus-search-section">';
						$meta_content .= '<form action="' . esc_url( home_url() ) . '" method="get">';

							$meta_content .= '<input type="text" class="plus-search-field" placeholder="' . esc_attr( $search_text ) . '" name="s" autocomplete="off">';
							$meta_content .= '<div class="plus-submit-icon-container"><button type="submit" class="plus-search-submit""><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 50 50" version="1.1" width="100px" height="100px"><g id="surface1"><path style=" " d="M 21 3 C 11.621094 3 4 10.621094 4 20 C 4 29.378906 11.621094 37 21 37 C 24.710938 37 28.140625 35.804688 30.9375 33.78125 L 44.09375 46.90625 L 46.90625 44.09375 L 33.90625 31.0625 C 36.460938 28.085938 38 24.222656 38 20 C 38 10.621094 30.378906 3 21 3 Z M 21 5 C 29.296875 5 36 11.703125 36 20 C 36 28.296875 29.296875 35 21 35 C 12.703125 35 6 28.296875 6 20 C 6 11.703125 12.703125 5 21 5 Z "></path></g></svg></button></div>';

						$meta_content .= '</form>';
						$meta_content .= '</div>';

					$meta_content .= '</div>';

					$meta_content .= '</div>';
					$meta_content .= '</li>';
				}
				if ( 'yes' === $cart_on && 'cart' === $select_icon_list ) {

					global $woocommerce;
					if ( $woocommerce ) {

						$cart_icon_style = ! empty( $settings['cart_icon_style'] ) ? $settings['cart_icon_style'] : 'style-1';
						$meta_content   .= '<li class="mini-cart-icon ' . $cart_icon_style . ' elementor-repeater-item-' . esc_attr( $item['_id'] ) . ' ' . esc_attr( $responsive_class_attr ) . '">';
						$meta_content   .= '<div class="content-icon-list">';

							$meta_content .= '<a href="' . wc_get_cart_url() . '" class="plus-cart-icon ' . esc_attr( $cart_icon_style ) . ' ' . esc_attr( $cart_icon ) . '">';
						if ( 'style-1' === $cart_icon_style ) {
							if ( 'default' === $cart_icon ) {
								$meta_content .= '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 96 96" height="100%" id="bag" version="1.1" viewBox="0 0 96 96" width="100%" xml:space="preserve" style="&#10;"><path d="M68,24v-4C68,8.954,59.046,0,48,0S28,8.954,28,20v4H12v60c0,6.63,5.37,12,12,12h48c6.63,0,12-5.37,12-12V24H68z M36,20  c0-6.627,5.373-12,12-12c6.627,0,12,5.373,12,12v4H36V20z M76,84c0,2.21-1.79,4-4,4H24c-2.21,0-4-1.79-4-4V32h56V84z"/></svg>';
							}

							if ( ! $editor_mode ) {
								$meta_content .= '<div class="cart-wrap"><span>' . WC()->cart->get_cart_contents_count() . '</span></div>';
							} else {
								$meta_content .= '<div class="cart-wrap"><span>0</span></div>';
							}
						}
							$meta_content .= '</a>';

						if ( 'style-1' === $cart_icon_style ) {
							$meta_content .= '<div class="tpmc-header-extra-toggle-content-ext">';
						}

						if ( ! $editor_mode ) {
								ob_start();
									the_widget( 'WC_Widget_Cart', 'title= ' );
								$captured_cart_content = ob_get_clean();
							$meta_content             .= $captured_cart_content;
						} else {
							ob_start();
							the_widget( 'WC_Widget_Cart' );
							$captured_cart_content = ob_get_clean();
							$meta_content         .= $captured_cart_content;
						}

						$cart_text = ! empty( $settings['cart_offer_text'] ) ? $settings['cart_offer_text'] : '';

						if ( ! empty( $cart_text ) ) {
							if ( 'style-1' === $cart_icon_style ) {
								$meta_content .= '<div class="mc-extra-bottom-con">' . wp_kses_post( $cart_text ) . '</div>';
								$meta_content .= '</div>';
							}
						}
						$meta_content .= '</div>';
						$meta_content .= '</li>';
					}
				}
				endforeach;
					$meta_content .= '</ul>';
		}
			$meta_content .= '</div>';
		$meta_content     .= '</div>';

		echo $meta_content;
	}
}
