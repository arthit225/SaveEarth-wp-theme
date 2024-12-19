<?php
/**
 * Widget Name: Clients Logo Carousel
 * Description: Different style of clients logo.
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
use Elementor\Group_Control_Css_Filter;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class L_ThePlus_Clients_ListOut.
 */
class L_ThePlus_Clients_ListOut extends Widget_Base {

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
		return 'tp-clients-listout';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Clients', 'tpebl' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-user theplus_backend_icon';
	}

	/**
	 * Get Widget categories.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_categories() {
		return array( 'plus-listing' );
	}

	/**
	 * Get Widget keywords.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_keywords() {
		return array( 'client', 'listing', 'theplus' );
	}

	/**
	 * Update is_reload_preview_required.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function is_reload_preview_required() {
		return true;
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
	 * Register controls.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Content Layout', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'style',
			array(
				'label'   => esc_html__( 'Style', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => l_theplus_get_style_list( 1 ),
			)
		);
		$this->add_control(
			'layout',
			array(
				'label'   => esc_html__( 'Layout', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'grid',
				'options' => array(
					'grid'     => esc_html__( 'Grid', 'tpebl' ),
					'masonry'  => esc_html__( 'Masonry', 'tpebl' ),
					'carousel' => esc_html__( 'Carousel (PRO)', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_grid',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "show-elementor-client-logos-in-grid-layout/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> Learn How it works  <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'layout' => array( 'grid' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_masonry',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "add-logo-showcase-in-masonry-grid-layout-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> Learn How it works  <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'layout' => array( 'masonry' ),
				),
			)
		);
		$this->add_responsive_control(
			'grid_minmum_height',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Minimum Height', 'tpebl' ),
				'size_units'  => array( 'px', 'em' ),
				'default'     => array(
					'unit' => 'px',
					'size' => 100,
				),
				'range'       => array(
					'px' => array(
						'min'  => 50,
						'max'  => 500,
						'step' => 5,
					),
					'em' => array(
						'min'  => 50,
						'max'  => 400,
						'step' => 5,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .clients-list .post-inner-loop .grid-item .client-post-content .client-content-logo' => 'min-height: {{SIZE}}{{UNIT}};display: -webkit-box;display: -ms-flexbox;display: flex;-webkit-box-orient: vertical;-webkit-align-items: center;-ms-align-items: center;align-items: center;-ms-flex-wrap: wrap;flex-wrap: wrap;',
				),
				'condition'   => array(
					'layout' => array( 'grid' ),
				),
			)
		);
		$this->add_control(
			'clientContentFrom',
			array(
				'label'   => esc_html__( 'Select Source', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'clcontent',
				'options' => array(
					'clcontent'  => esc_html__( 'Post Type', 'tpebl' ),
					'clrepeater' => esc_html__( 'Repeater', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'how_works_Post_Type',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "add-logo-showcase-from-dynamic-custom-post-type-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> Learn How it works  <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'clientContentFrom' => 'clcontent',
				),
			)
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'clientLinkMaskLabel',
			array(
				'label'       => esc_html__( 'Client Name', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array( 'active' => true ),
				'default'     => '',
				'placeholder' => esc_html__( 'Enter Client Name', 'tpebl' ),
			)
		);
		$repeater->add_control(
			'clientlink',
			array(
				'label'         => esc_html__( 'Client URL', 'tpebl' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_html__( 'https://your-link.com', 'tpebl' ),
				'show_external' => true,
				'default'       => array( 'url' => '#' ),
				'dynamic'       => array( 'active' => true ),
			)
		);
		$repeater->add_control(
			'clientImage',
			array(
				'label'   => esc_html__( 'Client Logo', 'tpebl' ),
				'type'    => Controls_Manager::MEDIA,
				'dynamic' => array( 'active' => true ),
			)
		);
		$this->add_control(
			'clientLinkMaskList',
			array(
				'label'       => esc_html__( 'Manage Clients', 'tpebl' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array( 'clientLinkMaskLabel' => esc_html__( 'SoftPro Solutions', 'tpebl' ) ),
					array( 'clientLinkMaskLabel' => esc_html__( 'TechZone Systems', 'tpebl' ) ),
					array( 'clientLinkMaskLabel' => esc_html__( 'DataPro Technologies', 'tpebl' ) ),
					array( 'clientLinkMaskLabel' => esc_html__( 'CodeWorks Inc.', 'tpebl' ) ),
				),
				'title_field' => '{{{ clientLinkMaskLabel }}}',
				'condition'   => array(
					'clientContentFrom' => 'clrepeater',
				),
			)
		);
		$this->add_control(
			'plus_pro_layout_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'layout' => array( 'carousel' ),
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'content_source_section',
			array(
				'label'     => esc_html__( 'Content Source', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'clientContentFrom!' => 'clrepeater',
				),
			)
		);
		$this->add_control(
			'post_category',
			array(
				'type'        => Controls_Manager::SELECT2,
				'label'       => esc_html__( 'Select Category', 'tpebl' ),
				'default'     => '',
				'label_block' => true,
				'multiple'    => true,
				'options'     => $this->tpae_get_categories(),
				'separator'   => 'before',
			)
		);
		$this->add_control(
			'display_posts',
			array(
				'label'     => esc_html__( 'Maximum Posts Display', 'tpebl' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 200,
				'step'      => 1,
				'default'   => 8,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'post_offset',
			array(
				'label'   => esc_html__( 'Offset Posts', 'tpebl' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 0,
				'max'     => 50,
				'step'    => 1,
				'default' => '',
			)
		);
		$this->add_control(
			'post_Note',
			array(
				'type'        => Controls_Manager::RAW_HTML,
				'raw'         => '<p class="tp-controller-notice"><i>Hide posts from the beginning of listing.</i></p>',
				'label_block' => true,
			)
		);
		$this->add_control(
			'post_order_by',
			array(
				'label'   => esc_html__( 'Order By', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => l_theplus_orderby_arr(),
			)
		);
		$this->add_control(
			'post_order',
			array(
				'label'   => esc_html__( 'Order', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'DESC',
				'options' => l_theplus_order_arr(),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'columns_section',
			array(
				'label'     => esc_html__( 'Columns Manage', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'layout!' => array( 'carousel' ),
				),
			)
		);
		$this->add_control(
			'desktop_column',
			array(
				'label'     => esc_html__( 'Desktop Column', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '3',
				'options'   => l_theplus_get_columns_list(),
				'condition' => array(
					'layout!' => array( 'metro', 'carousel' ),
				),
			)
		);
		$this->add_control(
			'tablet_column',
			array(
				'label'     => esc_html__( 'Tablet Column', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '4',
				'options'   => l_theplus_get_columns_list(),
				'condition' => array(
					'layout!' => array( 'metro', 'carousel' ),
				),
			)
		);
		$this->add_control(
			'mobile_column',
			array(
				'label'     => esc_html__( 'Mobile Column', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '6',
				'options'   => l_theplus_get_columns_list(),
				'condition' => array(
					'layout!' => array( 'metro', 'carousel' ),
				),
			)
		);
		$this->add_responsive_control(
			'columns_gap',
			array(
				'label'      => esc_html__( 'Columns Gap/Space Between', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'default'    => array(
					'top'    => '15',
					'right'  => '15',
					'bottom' => '15',
					'left'   => '15',
				),
				'separator'  => 'before',
				'condition'  => array(
					'layout!' => array( 'carousel' ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .clients-list .post-inner-loop .grid-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .clients-list:not(.list-carousel-slick) .layout-style-1 .client-post-content:after' => 'bottom: -{{BOTTOM}}{{UNIT}}',
					'{{WRAPPER}} .clients-list:not(.list-carousel-slick) .layout-style-1 .client-post-content:before' => 'right: -{{RIGHT}}{{UNIT}}',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'extra_option_section',
			array(
				'label' => esc_html__( 'Extra Options', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'post_title_tag',
			array(
				'label'     => esc_html__( 'Title Tag', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'h3',
				'options'   => l_theplus_get_tags_options(),
				'separator' => 'after',
			)
		);
		$this->add_control(
			'display_post_title',
			array(
				'label'     => esc_html__( 'Display Client Title', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'default'   => 'yes',
			)
		);
		$this->add_control(
			'disable_link',
			array(
				'label'     => esc_html__( 'Disable Link', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'disable_link_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'disable_link' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'display_thumbnail',
			array(
				'label'     => esc_html__( 'Display Image Size', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'display_thumbnail_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'display_thumbnail' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'filter_category',
			array(
				'label'     => esc_html__( 'Category Wise Filter', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'default'   => 'no',
				'separator' => 'before',
				'condition' => array(
					'layout!' => 'carousel',
				),
			)
		);
		$this->add_control(
			'filter_category_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'filter_category' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'post_extra_option',
			array(
				'label'     => esc_html__( 'More Post Loading Options (Pro)', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'none',
				'options'   => l_theplus_post_loading_option(),
				'separator' => 'before',
				'condition' => array(
					'layout!'            => array( 'carousel' ),
					'clientContentFrom!' => 'clrepeater',
				),
			)
		);
		$this->add_control(
			'post_extra_option_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'layout!'            => array( 'carousel' ),
					'clientContentFrom!' => 'clrepeater',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			array(
				'label'     => esc_html__( 'Title', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'display_post_title' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typography', 'tpebl' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .clients-list .post-inner-loop .post-title,{{WRAPPER}} .clients-list .post-inner-loop .post-title a',
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
			'title_color',
			array(
				'label'     => esc_html__( 'Title Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .clients-list .post-inner-loop .post-title,{{WRAPPER}} .clients-list .post-inner-loop .post-title a' => 'color: {{VALUE}}',
				),
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
			'title_hover_color',
			array(
				'label'     => esc_html__( 'Title Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .clients-list .post-inner-loop .client-post-content:hover .post-title,{{WRAPPER}} .clients-list .post-inner-loop .client-post-content:hover .post-title a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_filter_category_styling',
			array(
				'label'     => esc_html__( 'Filter Category', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'filter_category' => 'yes',
				),
			)
		);
		$this->add_control(
			'section_filter_category_styling_options',
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
			'section_client_logo_styling',
			array(
				'label' => esc_html__( 'Client Logo Style', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'layout_style',
			array(
				'label'     => esc_html__( 'Layout Style', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'none',
				'options'   => array(
					'none'           => esc_html__( 'None', 'tpebl' ),
					'layout-style-1' => esc_html__( 'Layout 1 (Pro)', 'tpebl' ),
				),
				'condition' => array(
					'style!' => 'carousel',
				),
			)
		);
		$this->add_control(
			'plus_pro_layout_style_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'layout_style' => array( 'layout-style-1' ),
				),
			)
		);
		$this->start_controls_tabs( 'tabs_logo_style' );
		$this->start_controls_tab(
			'tab_logo_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'name'     => 'logo_css_filters',
				'selector' => '{{WRAPPER}} .clients-list .client-post-content .client-featured-logo img',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_logo_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'name'     => 'logo_css_filters_hover',
				'selector' => '{{WRAPPER}} .clients-list .client-post-content:hover .client-featured-logo img',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_box_loop_styling',
			array(
				'label' => esc_html__( 'Individual Client Background', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'content_inner_padding',
			array(
				'label'      => esc_html__( 'Inner Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .clients-list .post-inner-loop .grid-item .client-post-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
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
				'default'   => 'solid',
				'options'   => l_theplus_get_border_style(),
				'selectors' => array(
					'{{WRAPPER}} .clients-list .post-inner-loop .grid-item .client-post-content' => 'border-style: {{VALUE}};',
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
					'{{WRAPPER}} .clients-list .post-inner-loop .grid-item .client-post-content' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'box_border' => 'yes',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_border_style' );
		$this->start_controls_tab(
			'tab_border_normal',
			array(
				'label'     => esc_html__( 'Normal', 'tpebl' ),
				'condition' => array(
					'box_border' => 'yes',
				),
			)
		);
		$this->add_control(
			'box_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .clients-list .post-inner-loop .grid-item .client-post-content' => 'border-color: {{VALUE}};',
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
					'{{WRAPPER}} .clients-list .post-inner-loop .grid-item .client-post-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'box_border' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_border_hover',
			array(
				'label'     => esc_html__( 'Hover', 'tpebl' ),
				'condition' => array(
					'box_border' => 'yes',
				),
			)
		);
		$this->add_control(
			'box_border_hover_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .clients-list .post-inner-loop .grid-item .client-post-content:hover' => 'border-color: {{VALUE}};',
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
					'{{WRAPPER}} .clients-list .post-inner-loop .grid-item .client-post-content:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'box_border' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
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
				'selector' => '{{WRAPPER}} .clients-list .post-inner-loop .grid-item .client-post-content',

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
				'name'     => 'box_active_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .clients-list .post-inner-loop .grid-item .client-post-content:hover',
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
					'layout' => 'carousel',
				),
			)
		);
		$this->add_control(
			'section_carousel_options_styling_options',
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
			'section_extra_options_styling',
			array(
				'label' => esc_html__( 'Extra Options', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
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
			)
		);
		$this->add_control(
			'messy_column_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'messy_column' => array( 'yes' ),
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
			'animated_column_list',
			array(
				'label'     => esc_html__( 'List Load Animation', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => array(
					''        => esc_html__( 'Content Animation Block', 'tpebl' ),
					'stagger' => esc_html__( 'Stagger Based Animation', 'tpebl' ),
				),
				'condition' => array(
					'animation_effects!' => array( 'no-animation' ),
				),
			)
		);
		$this->add_control(
			'animation_stagger',
			array(
				'type'      => Controls_Manager::SLIDER,
				'label'     => esc_html__( 'Animation Stagger', 'tpebl' ),
				'default'   => array(
					'unit' => '',
					'size' => 150,
				),
				'range'     => array(
					'' => array(
						'min'  => 0,
						'max'  => 6000,
						'step' => 10,
					),
				),
				'condition' => array(
					'animation_effects!'   => array( 'no-animation' ),
					'animated_column_list' => 'stagger',
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
	 * Render clients_listout
	 *
	 * Written in PHP and HTML.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	protected function render() {
		$settings   = $this->get_settings_for_display();
		$query_args = $this->get_query_args();
		$query      = new \WP_Query( $query_args );

		$clients_name     = l_theplus_client_post_name();
		$clients_taxonomy = $this->tpae_get_post_cat();

		$style  = ! empty( $settings['style'] ) ? $settings['style'] : 'style-1';
		$layout = ! empty( $settings['layout'] ) ? $settings['layout'] : 'grid';

		$layout_style   = ( 'none' !== $settings['layout_style'] ) ? $settings['layout_style'] : '';
		$post_title_tag = ! empty( $settings['post_title_tag'] ) ? $settings['post_title_tag'] : 'h3';
		$post_category  = ! empty( $settings['post_category'] ) ? $settings['post_category'] : '';

		$display_post_title = ! empty( $settings['display_post_title'] ) ? $settings['display_post_title'] : '';

		$content_from  = ! empty( $settings['clientContentFrom'] ) ? $settings['clientContentFrom'] : 'clcontent';
		$link_masklist = ! empty( $settings['clientLinkMaskList'] ) ? $settings['clientLinkMaskList'] : array();

		$ani_effects  = ! empty( $settings['animation_effects'] ) ? $settings['animation_effects'] : '';
		$ani_delay    = ! empty( $settings['animation_delay']['size'] ) ? $settings['animation_delay']['size'] : 50;
		$ani_stagger  = ! empty( $settings['animation_stagger']['size'] ) ? $settings['animation_stagger']['size'] : 150;
		$ani_col_list = ! empty( $settings['animated_column_list'] ) ? $settings['animated_column_list'] : '';
		$ani_duration = ! empty( $settings['animation_duration_default'] ) ? $settings['animation_duration_default'] : '';

		$ani_out_effects = ! empty( $settings['animation_out_effects'] ) ? $settings['animation_out_effects'] : '';
		$out_ani_delay   = ! empty( $settings['animation_out_delay']['size'] ) ? $settings['animation_out_delay']['size'] : 50;

		$animate_duration = ! empty( $settings['animate_duration']['size'] ) ? $settings['animate_duration']['size'] : 50;
		$out_ani_duration = ! empty( $settings['animation_out_duration_default'] ) ? $settings['animation_out_duration_default'] : '';
		$out_ani_speed    = ! empty( $settings['animation_out_duration']['size'] ) ? $settings['animation_out_duration']['size'] : 50;

		$animated_columns = '';
		if ( 'no-animation' === $ani_effects ) {
			$animated_class = '';
			$animation_attr = '';
		} else {
			$animate_offset  = '85%';
			$animated_class  = 'animate-general';
			$animation_attr  = ' data-animate-type="' . esc_attr( $ani_effects ) . '" data-animate-delay="' . esc_attr( $ani_delay ) . '"';
			$animation_attr .= ' data-animate-offset="' . esc_attr( $animate_offset ) . '"';

			if ( 'stagger' === $ani_col_list ) {
				$animated_columns = 'animated-columns';
				$animation_attr  .= ' data-animate-columns="stagger"';
				$animation_attr  .= ' data-animate-stagger="' . esc_attr( $ani_stagger ) . '"';
			} elseif ( 'columns' === $ani_col_list ) {
				$animated_columns = 'animated-columns';
				$animation_attr  .= ' data-animate-columns="columns"';
			}

			if ( 'yes' === $ani_duration ) {
				$animation_attr .= ' data-animate-duration="' . esc_attr( $animate_duration ) . '"';
			}

			if ( 'no-animation' !== $ani_out_effects ) {
				$animation_attr .= ' data-animate-out-type="' . esc_attr( $ani_out_effects ) . '" data-animate-out-delay="' . esc_attr( $out_ani_delay ) . '"';

				if ( 'yes' === $out_ani_duration ) {
					$animation_attr .= ' data-animate-out-duration="' . esc_attr( $out_ani_speed ) . '"';
				}
			}
		}

		$desktop_class = '';
		$tablet_class  = '';
		$mobile_class  = '';

		$dc = ! empty( $settings['desktop_column'] ) ? $settings['desktop_column'] : 3;
		$tc = ! empty( $settings['tablet_column'] ) ? $settings['tablet_column'] : 4;
		$mc = ! empty( $settings['mobile_column'] ) ? $settings['mobile_column'] : 6;

		if ( 'carousel' !== $layout ) {
			$desktop_class = 'tp-col-lg-' . esc_attr( $dc );
			$tablet_class  = 'tp-col-md-' . esc_attr( $tc );
			$mobile_class  = 'tp-col-sm-' . esc_attr( $mc );
			$mobile_class .= ' tp-col-' . esc_attr( $mc );
		}

		$layout_attr = '';
		$data_class  = '';

		if ( ! empty( $layout ) ) {
			if ( 'grid' !== $layout ) {
				$data_class  .= l_theplus_get_layout_list_class( $layout );
				$layout_attr .= l_theplus_get_layout_list_attr( $layout );
			} else {
				$data_class .= ' list-isotope';
			}
		} else {
			$data_class .= ' list-isotope';
		}

		$data_class .= ' client-' . esc_attr( $style );

		$output    = '';
		$data_attr = '';

		$uid = uniqid( 'post' );

		$data_attr .= ' data-id="' . esc_attr( $uid ) . '"';
		$data_attr .= ' data-style="' . esc_attr( $style ) . '"';

		$d_flex = '';
		if ( 'carousel' !== $layout ) {
			$d_flex = 'd-flex flex-row';
		}
		if ( 'clrepeater' === $content_from ) {
			if ( ! empty( $link_masklist ) ) {
				if ( 'carousel' !== $layout ) {
					$index = 1;

					$output .= '<div id="pt-plus-clients-post-list" class="clients-list ' . esc_attr( $uid ) . ' ' . esc_attr( $data_class ) . ' ' . esc_attr( $animated_class ) . '" ' . esc_attr( $layout_attr ) . ' ' . $data_attr . ' ' . $animation_attr . ' data-enable-isotope="1">';

					$output .= '<div class="tp-row post-inner-loop ' . esc_attr( $layout_style ) . '  ' . esc_attr( $d_flex ) . ' flex-wrap tp-align-items-center ' . esc_attr( $uid ) . '">';

					foreach ( $link_masklist as $item ) {
						$client_lml     = ! empty( $item['clientLinkMaskLabel'] ) ? $item['clientLinkMaskLabel'] : '';
						$clientlink     = ! empty( $item['clientlink']['url'] ) ? $item['clientlink']['url'] : '';
						$client_image   = ! empty( $item['clientImage']['url'] ) ? $item['clientImage']['url'] : '';
						$client_imageid = ! empty( $item['clientImage']['id'] ) ? $item['clientImage']['id'] : '';

						$output .= '<div class="grid-item flex-column flex-wrap ' . $desktop_class . ' ' . $tablet_class . ' ' . $mobile_class . ' ' . esc_attr( $animated_columns ) . '">';

						if ( ! empty( $style ) ) {

							ob_start();
							include L_THEPLUS_WSTYLES . 'client/client-' . sanitize_file_name( $style ) . '.php';
							$output .= ob_get_contents();
							ob_end_clean();

						}

						$output .= '</div>';
						++$index;
					}

					$output .= '</div>';

					$output .= '</div>';
				} else {
					$output .= '<h3 class="theplus-posts-not-found">' . esc_html__( 'Carousel Layout Premium Version.', 'tpebl' ) . '</h3>';
				}
			}
		} elseif ( ! $query->have_posts() ) {
			$output .= '<h3 class="theplus-posts-not-found">' . esc_html__( 'Posts not found', 'tpebl' ) . '</h3>';
		} elseif ( 'carousel' !== $layout ) {
			$output .= '<div id="pt-plus-clients-post-list" class="clients-list ' . esc_attr( $uid ) . ' ' . esc_attr( $data_class ) . ' ' . esc_attr( $animated_class ) . '" ' . $layout_attr . ' ' . $data_attr . ' ' . $animation_attr . ' data-enable-isotope="1">';

			$output .= '<div class="tp-row post-inner-loop ' . esc_attr( $layout_style ) . '  ' . esc_attr( $d_flex ) . ' flex-wrap tp-align-items-center ' . esc_attr( $uid ) . '">';

			while ( $query->have_posts() ) {

				$query->the_post();
				$post = $query->post;

				$output .= '<div class="grid-item flex-column flex-wrap ' . $desktop_class . ' ' . $tablet_class . ' ' . $mobile_class . ' ' . esc_attr( $animated_columns ) . '">';

				if ( ! empty( $style ) ) {
					ob_start();
					include L_THEPLUS_WSTYLES . 'client/client-' . sanitize_file_name( $style ) . '.php';
					$output .= ob_get_contents();
					ob_end_clean();
				}

				$output .= '</div>';

			}

			$output .= '</div>';

			$output .= '</div>';
		} else {
			$output .= '<h3 class="theplus-posts-not-found">' . esc_html__( 'Carousel Layout Premium Version.', 'tpebl' ) . '</h3>';
		}

		echo $output;
		wp_reset_postdata();
	}

	/**
	 * Get Query
	 *
	 * Written in PHP and HTML.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	protected function get_query_args() {
		$settings = $this->get_settings_for_display();
		$category = array();

		$clients_name     = l_theplus_client_post_name();
		$clients_taxonomy = $this->tpae_get_post_cat();

		$terms = get_terms(
			array(
				'taxonomy'   => $clients_taxonomy,
				'hide_empty' => true,
			)
		);

		$post_category = ! empty( $settings['post_category'] ) ? $settings['post_category'] : '';

		if ( ! is_wp_error( $terms ) && ! empty( $terms ) && ! empty( $post_category ) ) {
			foreach ( $terms as $term ) {
				if ( in_array( $term->term_id, $post_category ) ) {
					$category[] = $term->slug;
				}
			}
		}

		$post_ob  = ! empty( $settings['post_order_by'] ) ? $settings['post_order_by'] : '';
		$post_o   = ! empty( $settings['post_order'] ) ? $settings['post_order'] : '';
		$dis_post = ! empty( $settings['display_posts'] ) ? $settings['display_posts'] : '';

		$query_args = array(
			'post_type'           => $clients_name,
			$clients_taxonomy     => $category,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			'posts_per_page'      => intval( $dis_post ),
			'orderby'             => $post_ob,
			'order'               => $post_o,
		);

		$offset = ! empty( $settings['post_offset'] ) ? absint( $settings['post_offset'] ) : 0;

		global $paged;

		$paged_custom = 1;
		$paged_custom = $paged;

		if ( get_query_var( 'paged' ) ) {
			$paged_custom = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
			$paged_custom = get_query_var( 'page' );
		} else {
			$paged_custom = 1;
		}

		$query_args['offset'] = $offset;

		return $query_args;
	}

	/**
	 * Get Clients-categories
	 *
	 * @since 5.6.9
	 */
	public function tpae_get_categories() {

		$clients = $this->tpae_get_post_cat();

		if ( ! empty( $clients ) ) {
			$categories = get_categories(
				array(
					'taxonomy'   => $clients,
					'hide_empty' => 0,
				)
			);

			if ( empty( $categories ) || ! is_array( $categories ) ) {
				return array();
			}
		}

		return wp_list_pluck( $categories, 'name', 'term_id' );
	}

	/**
	 * Get Clents-post
	 *
	 * @since 5.6.9
	 */
	public function tpae_get_post_cat() {
		$post_type_options = get_option( 'post_type_options' );
		$client_post_type  = ! empty( $post_type_options['client_post_type'] ) ? $post_type_options['client_post_type'] : '';

		$post_name = 'theplus_clients_cat';

		if ( isset( $client_post_type ) && ! empty( $client_post_type ) ) {
			if ( 'themes' === $client_post_type ) {
				$post_name = $this->tpae_get_options( 'client_category_name' );
			} elseif ( 'plugin' === $client_post_type ) {
				$get_name = $this->tpae_get_options( 'client_category_plugin_name' );
				if ( isset( $get_name ) && ! empty( $get_name ) ) {
					$post_name = $this->tpae_get_options( 'client_category_plugin_name' );
				}
			} elseif ( 'themes_pro' === $client_post_type ) {
				$post_name = 'clients_category';
			}
		} else {
			$post_name = 'theplus_clients_cat';
		}

		return $post_name;
	}

	/**
	 * Get tp options
	 *
	 * @since 5.6.9
	 *
	 * @param string $field use for get type.
	 */
	public function tpae_get_options( $field ) {

		$post_type_options = get_option( 'post_type_options' );

		if ( isset( $post_type_options[ $field ] ) && ! empty( $post_type_options[ $field ] ) ) {
			return $post_type_options[ $field ];
		}

		return '';
	}
}
