<?php
/**
 * Widget Name: Post Previous Next
 * Description: Post Previous Next
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
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;

use TheplusAddons\L_Theplus_Element_Load;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class L_ThePlus_Post_Navigation
 */
class L_ThePlus_Post_Navigation extends Widget_Base {

	/**
	 * Document Link For Need help
	 *
	 * @var tp_doc of the class
	 */
	public $tp_doc = L_THEPLUS_TPDOC;

	/**
	 * Helpdesk Link For Need help.
	 *
	 * @var tp_help of the class.
	 */
	public $tp_help = L_THEPLUS_HELP;

	/**
	 * Get Widget Name
	 *
	 * @since 5.0.0
	 * @version 5.4.2
	 */
	public function get_name() {
		return 'tp-post-navigation';
	}

	/**
	 * Get Widget Title
	 *
	 * @since 5.0.0
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Post Prev/Next', 'tpebl' );
	}

	/**
	 * Get Widget Icon
	 *
	 * @since 5.0.0
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-exchange theplus_backend_icon';
	}

	/**
	 * Get Widget Categories
	 *
	 * @since 5.0.0
	 * @version 5.4.2
	 */
	public function get_categories() {
		return array( 'plus-builder' );
	}

	/**
	 * Get Widget Keywords
	 *
	 * @since 5.0.0
	 * @version 5.4.2
	 */
	public function get_keywords() {
		return array( 'Post', 'Navigation', 'Post Navigation', 'Previous', 'Next', 'Previous Post', 'Next Post' );
	}

	/**
	 * Get Custom url
	 *
	 * @since 5.0.0
	 * @version 5.4.2
	 */
	public function get_custom_help_url() {
		$help_url = $this->tp_help;

		return esc_url( $help_url );
	}

	/**
	 * Register controls
	 *
	 * @since 5.0.0
	 * @version 5.4.2
	 */
	protected function register_controls() {

		/** Content Section Start*/
		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Content', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'style',
			array(
				'label'   => esc_html__( 'Style', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => array(
					'style-1' => esc_html__( 'Style 1', 'tpebl' ),
					'style-2' => esc_html__( 'Style 2', 'tpebl' ),
					'style-3' => esc_html__( 'Style 3', 'tpebl' ),
					'style-4' => esc_html__( 'Style 4', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'showcsttexonomy',
			array(
				'label'     => esc_html__( 'Related', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'showcsttexonomy_select',
			array(
				'label'     => esc_html__( 'Taxonomies', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => l_theplus_get_post_taxonomies(),
				'default'   => 'category',
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'showcsttexonomy' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'st3minheight',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Min Height', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 500,
						'step' => 1,
					),
				),
				'condition'   => array(
					'style' => 'style-3',
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-post-navigation.tp-nav-trans.tp-nav-style-3 .tp-post-nav-hover-con' => 'min-height: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_control(
			'prevText',
			array(
				'label'       => esc_html__( 'Previous Post', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Previous Post',
				'placeholder' => 'Previous Post',
				'label_block' => true,
			)
		);
		$this->add_control(
			'nextText',
			array(
				'label'       => esc_html__( 'Next Post', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Next Post',
				'placeholder' => 'Next Post',
				'label_block' => true,
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_np_icon_style',
			array(
				'label'     => esc_html__( 'Prev/Next Icon', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'style' => 'style-2',
				),
			)
		);
		$this->add_responsive_control(
			'np_icon_align',
			array(
				'label'     => esc_html__( 'Alignment', 'tpebl' ),
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
				'devices'   => array( 'desktop', 'tablet', 'mobile' ),
				'default'   => 'flex-start',
				'selectors' => array(
					'{{WRAPPER}} .tp-post-navigation.tp-nav-style-2 .tp-post-nav' => 'justify-content: {{VALUE}}',
				),
			)
		);
		$this->add_responsive_control(
			'np_icon_padding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-post-navigation.tp-nav-style-2 .post-prev a i,{{WRAPPER}} .tp-post-navigation.tp-nav-style-2 .post-next a i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'np_icon_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Size', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 200,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-post-navigation.tp-nav-style-2 .post-prev a i,{{WRAPPER}} .tp-post-navigation.tp-nav-style-2 .post-next a i' => 'font-size: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_tab_np_icon' );
		$this->start_controls_tab(
			'tab_np_icon_n',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'tab_np_icon_color_n',
			array(
				'label'     => esc_html__( 'Icon Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-post-navigation.tp-nav-style-2 .post-prev a i,{{WRAPPER}} .tp-post-navigation.tp-nav-style-2 .post-next a i' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'np_icon_background_n',
				'label'    => esc_html__( 'Background', 'tpebl' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-post-navigation.tp-nav-style-2 .post-prev a i,{{WRAPPER}} .tp-post-navigation.tp-nav-style-2 .post-next a i',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'np_icon_border_n',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-post-navigation.tp-nav-style-2 .post-prev a i,{{WRAPPER}} .tp-post-navigation.tp-nav-style-2 .post-next a i',
			)
		);
		$this->add_responsive_control(
			'np_icon_radius_n',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-post-navigation.tp-nav-style-2 .post-prev a i,{{WRAPPER}} .tp-post-navigation.tp-nav-style-2 .post-next a i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'np_icon_shadow_n',
				'selector' => '{{WRAPPER}} .tp-post-navigation.tp-nav-style-2 .post-prev a i,{{WRAPPER}} .tp-post-navigation.tp-nav-style-2 .post-next a i',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_tabs_np_icon_h',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'tab_np_icon_h',
			array(
				'label'     => esc_html__( 'Icon Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-post-navigation.tp-nav-style-2 .post-prev:hover a i,{{WRAPPER}} .tp-post-navigation.tp-nav-style-2 .post-next:hover a i' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'np_icon_background_h',
				'label'    => esc_html__( 'Background', 'tpebl' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-post-navigation.tp-nav-style-2 .post-prev:hover a i,{{WRAPPER}} .tp-post-navigation.tp-nav-style-2 .post-next:hover a i',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'np_icon_border_h',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-post-navigation.tp-nav-style-2 .post-prev:hover a i,{{WRAPPER}} .tp-post-navigation.tp-nav-style-2 .post-next:hover a i',
			)
		);
		$this->add_responsive_control(
			'np_icon_radius_h',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-post-navigation.tp-nav-style-2 .post-prev:hover a i,{{WRAPPER}} .tp-post-navigation.tp-nav-style-2 .post-next:hover a i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'np_icon_shadow_h',
				'selector' => '{{WRAPPER}} .tp-post-navigation.tp-nav-style-2 .post-prev:hover a i,{{WRAPPER}} .tp-post-navigation.tp-nav-style-2 .post-next:hover a i',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_next_prev_con_style',
			array(
				'label'     => esc_html__( 'Prev/Next Content', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'style!' => array( 'style-3', 'style-4' ),
				),
			)
		);
		$this->add_responsive_control(
			'np__con_padding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-post-navigation.tp-nav-style-2 .post-prev:hover .tp-post-nav-hover-con,{{WRAPPER}} .tp-post-navigation.tp-nav-style-2 .post-next:hover .tp-post-nav-hover-con' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'np__con_background_h',
				'label'    => esc_html__( 'Background', 'tpebl' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-post-navigation.tp-nav-style-2 .post-prev:hover .tp-post-nav-hover-con,{{WRAPPER}} .tp-post-navigation.tp-nav-style-2 .post-next:hover .tp-post-nav-hover-con',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'np__con_border_h',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-post-navigation.tp-nav-style-2 .post-prev:hover .tp-post-nav-hover-con,{{WRAPPER}} .tp-post-navigation.tp-nav-style-2 .post-next:hover .tp-post-nav-hover-con',
			)
		);
		$this->add_responsive_control(
			'np__con_radius_h',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-post-navigation.tp-nav-style-2 .post-prev:hover .tp-post-nav-hover-con,{{WRAPPER}} .tp-post-navigation.tp-nav-style-2 .post-next:hover .tp-post-nav-hover-con' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'np__con_shadow_h',
				'selector' => '{{WRAPPER}} .tp-post-navigation.tp-nav-style-2 .post-prev:hover .tp-post-nav-hover-con,{{WRAPPER}} .tp-post-navigation.tp-nav-style-2 .post-next:hover .tp-post-nav-hover-con',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_next_prev_title_style',
			array(
				'label'     => esc_html__( 'Prev/Next', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'style!' => array( 'style-4' ),
				),
			)
		);
		$this->add_responsive_control(
			'space_between',
			array(
				'label'      => esc_html__( 'Space Between', 'tpebl' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 5,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-nav-style-1 .tp-post-nav .post-prev' => 'padding-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .tp-nav-style-1 .tp-post-nav .post-next' => 'padding-left: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'navTypo',
				'label'    => esc_html__( 'Typography', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-post-navigation .prev-post-content b,{{WRAPPER}} .tp-post-navigation .next-post-content b',
			)
		);
		$this->start_controls_tabs( 'tabs_next_prev_style' );
		$this->start_controls_tab(
			'tab_next_prev_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'navNormalColor',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-post-navigation .prev-post-content b,{{WRAPPER}} .tp-post-navigation .next-post-content b' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_next_prev_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'navHoverColor',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-post-navigation .post-prev:hover .prev-post-content b,{{WRAPPER}} .tp-post-navigation .post-next:hover .next-post-content b' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			array(
				'label'     => esc_html__( 'Post Title', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'style!' => array( 'style-4' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'titleTypo',
				'label'    => esc_html__( 'Typography', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-post-navigation .prev-post-content span,{{WRAPPER}} .tp-post-navigation .next-post-content span',
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
			'titleNormalColor',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-post-navigation .prev-post-content span,{{WRAPPER}} .tp-post-navigation .next-post-content span' => 'color: {{VALUE}}',
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
			'titleHoverColor',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-post-navigation .post-prev:hover .prev-post-content span,{{WRAPPER}} .tp-post-navigation .post-next:hover .next-post-content span' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_img_style',
			array(
				'label'     => esc_html__( 'Image', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'style!' => array( 'style-3', 'style-4' ),
				),
			)
		);
		$this->start_controls_tabs( 'tabs_img_style' );
		$this->start_controls_tab(
			'tab_img_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'imgBorder',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-post-navigation img',
			)
		);
		$this->add_responsive_control(
			'imgBorderRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-post-navigation img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'imgBoxShadow',
				'selector' => '{{WRAPPER}} .tp-post-navigation img',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_img_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'imgBorderHover',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-post-navigation .post-prev:hover img,{{WRAPPER}} .tp-post-navigation .post-next:hover img',
			)
		);
		$this->add_responsive_control(
			'imgBorderRadiusHover',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-post-navigation .post-prev:hover img,{{WRAPPER}} .tp-post-navigation .post-next:hover img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'imgBoxShadowHover',
				'selector' => '{{WRAPPER}} .tp-post-navigation .post-prev:hover img,{{WRAPPER}} .tp-post-navigation .post-next:hover img',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_prev_box_style',
			array(
				'label'     => esc_html__( 'Prev Box', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'style' => 'style-1',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_prev_box_style' );
		$this->start_controls_tab(
			'tab_prev_box_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'prevBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-post-navigation .post-prev .prev',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'prevBorder',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-post-navigation .post-prev .prev',
			)
		);
		$this->add_responsive_control(
			'prevBorderRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-post-navigation .post-prev .prev' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'prevBoxShadow',
				'selector' => '{{WRAPPER}} .tp-post-navigation .post-prev .prev',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_prev_box_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'prevBgHover',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-post-navigation .post-prev:hover .prev',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'prevBorderHover',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-post-navigation .post-prev:hover .prev',
			)
		);
		$this->add_responsive_control(
			'prevBorderRadiusHover',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-post-navigation .post-prev:hover .prev' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'prevBoxShadowHover',
				'selector' => '{{WRAPPER}} .tp-post-navigation .post-prev:hover .prev',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_next_box_style',
			array(
				'label'     => esc_html__( 'Next Box ', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'style' => 'style-1',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_next_box_style' );
		$this->start_controls_tab(
			'tab_next_box_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'nextBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-post-navigation .post-next .next',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'nextBorder',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-post-navigation .post-next .next',
			)
		);
		$this->add_responsive_control(
			'nextBorderRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-post-navigation .post-next .next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'nextBoxShadow',
				'selector' => '{{WRAPPER}} .tp-post-navigation .post-next .next',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_next_box_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'nextBgHover',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-post-navigation .post-next:hover .next',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'nextBorderHover',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-post-navigation .post-next:hover .next',
			)
		);
		$this->add_responsive_control(
			'nextBorderRadiusHover',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-post-navigation .post-next:hover .next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'nextBoxShadowHover',
				'selector' => '{{WRAPPER}} .tp-post-navigation .post-next:hover .next',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_bg_style',
			array(
				'label'     => esc_html__( 'Content Background', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'style' => 'style-1',
				),
			)
		);
		$this->add_responsive_control(
			'padding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'default'    => array(
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->start_controls_tabs( 'tabs_content_bg_style' );
		$this->start_controls_tab(
			'tab_content_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'boxBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}}',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'boxBorder',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}}',
			)
		);
		$this->add_responsive_control(
			'boxBorderRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}}' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'boxBoxShadow',
				'selector' => '{{WRAPPER}}',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_content_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'boxBgHover',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}}:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'boxBorderHover',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}}:hover',
			)
		);
		$this->add_responsive_control(
			'boxBorderRadiusHover',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}}:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'boxBoxShadowHover',
				'selector' => '{{WRAPPER}}:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_image_bg_style',
			array(
				'label'     => esc_html__( 'Background Image ', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'style' => 'style-3',
				),
			)
		);
		$this->add_control(
			'column_bg_image_normal',
			array(
				'label'     => esc_html__( 'Normal Background', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-post-navigation.tp-nav-trans.tp-nav-style-3 .post_nav_link .tp-post-nav-hover-con:before' => 'background: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'column_bg_image_hover',
			array(
				'label'     => esc_html__( 'Hover Background', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-post-navigation.tp-nav-trans.tp-nav-style-3 .post_nav_link:hover .tp-post-nav-hover-con:before' => 'background: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'column_bg_image_position',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Image Position', 'tpebl' ),
				'default'   => 'center center',
				'options'   => l_theplus_get_image_position_options(),
				'selectors' => array(
					'{{WRAPPER}} .tp-post-navigation.tp-nav-trans.tp-nav-style-3 .tp-post-nav-hover-con' => 'background-position: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'column_bg_img_attach',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Attachment', 'tpebl' ),
				'default'   => 'fixed',
				'options'   => l_theplus_get_image_attachment_options(),
				'selectors' => array(
					'{{WRAPPER}} .tp-post-navigation.tp-nav-trans.tp-nav-style-3 .tp-post-nav-hover-con' => 'background-attachment: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'column_bg_img_repeat',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Repeat', 'tpebl' ),
				'default'   => 'no-repeat',
				'options'   => l_theplus_get_image_reapeat_options(),
				'selectors' => array(
					'{{WRAPPER}} .tp-post-navigation.tp-nav-trans.tp-nav-style-3 .tp-post-nav-hover-con' => 'background-repeat: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'column_bg_image_size',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Background Size', 'tpebl' ),
				'default'   => 'cover',
				'options'   => l_theplus_get_image_size_options(),
				'selectors' => array(
					'{{WRAPPER}} .tp-post-navigation.tp-nav-trans.tp-nav-style-3 .tp-post-nav-hover-con' => 'background-size: {{VALUE}} !important;',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_st4_icon_style',
			array(
				'label'     => esc_html__( 'Icon ', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'style' => array( 'style-4' ),
				),
			)
		);
		$this->add_control(
			'st4_icon_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-post-navigation.tp-nav-style-4 .tp-post-nav-hover-arrow' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'st4_icon_color_hover',
			array(
				'label'     => esc_html__( 'Hover Icon Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-post-navigation.tp-nav-style-4 .post-prev:hover .tp-post-nav-hover-arrow,
					{{WRAPPER}} .tp-post-navigation.tp-nav-style-4 .post-next:hover .tp-post-nav-hover-arrow' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'st4_icon_bg',
			array(
				'label'     => esc_html__( 'Background Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-post-navigation.tp-nav-style-4 .tp-post-nav-hover-arrow' => 'background: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'st4_icon_bg_hover',
			array(
				'label'     => esc_html__( 'Hover Background Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-post-navigation.tp-nav-style-4 .post-prev:hover .tp-post-nav-hover-arrow,{{WRAPPER}} .tp-post-navigation.tp-nav-style-4 .post-next:hover .tp-post-nav-hover-arrow' => 'background: {{VALUE}};',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_st4_post_con_style',
			array(
				'label'     => esc_html__( 'Post Content ', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'style' => array( 'style-4' ),
				),
			)
		);
		$this->add_responsive_control(
			'st4_post_con_padding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-post-navigation.tp-nav-style-4 .prev-post-content,
					{{WRAPPER}} .tp-post-navigation.tp-nav-style-4 .next-post-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'st4_post_con_bg',
			array(
				'label'     => esc_html__( 'Background', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-post-navigation.tp-nav-style-4 .prev-post-content,
					{{WRAPPER}} .tp-post-navigation.tp-nav-style-4 .next-post-content' => 'background: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'st4titleTypo',
				'label'    => esc_html__( 'Post Title Typography', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-post-navigation .post-next:hover .next-post-content span,{{WRAPPER}} .tp-post-navigation .post-prev:hover .prev-post-content span',
			)
		);
		$this->add_control(
			'st4titleNormalColor',
			array(
				'label'     => esc_html__( 'Post Title Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-post-navigation .post-next:hover .next-post-content span,{{WRAPPER}} .tp-post-navigation .post-prev:hover .prev-post-content span' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'st4labelTypo',
				'label'    => esc_html__( 'Post Label Typography', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-post-navigation .prev-post-content b,{{WRAPPER}} .tp-post-navigation .next-post-content b',
			)
		);
		$this->add_control(
			'st4labelNormalColor',
			array(
				'label'     => esc_html__( 'Post Label Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-post-navigation .prev-post-content b,{{WRAPPER}} .tp-post-navigation .next-post-content b' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_section();

		include L_THEPLUS_PATH . 'modules/widgets/theplus-needhelp.php';
		include L_THEPLUS_PATH . 'modules/widgets/theplus-profeatures.php';
	}

	/**
	 * Render Post Previous Next
	 *
	 * @since 5.0.0
	 * @version 5.4.2
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$post  = get_queried_object();
		$style = ! empty( $settings['style'] ) ? $settings['style'] : 'style-1';

		$post_id   = get_queried_object_id();
		$prev_text = ! empty( $settings['prevText'] ) ? $settings['prevText'] : 'Previous Post';
		$next_text = ! empty( $settings['nextText'] ) ? $settings['nextText'] : 'Next Post';
		$uid_psnav = uniqid( 'tp-nav' );

		$showcsttexonomy = isset( $settings['showcsttexonomy'] ) ? $settings['showcsttexonomy'] : 'no';

		if ( isset( $showcsttexonomy ) && 'yes' === $showcsttexonomy ) {
			$showcsttexonomy_select = ! empty( $settings['showcsttexonomy_select'] ) ? $settings['showcsttexonomy_select'] : '';
			if ( $showcsttexonomy_select ) {
				$prev_post = get_previous_post( true, '', $showcsttexonomy_select );
				$next_post = get_next_post( true, '', $showcsttexonomy_select );
			}
		} else {
			$prev_post = get_previous_post();
			$next_post = get_next_post();
		}

		$img     = '';
		$prevnav = '';

		$prevpostimg = '';
		$prevpostcon = '';
		if ( ! empty( $prev_post ) ) {

			$prevpostcon .= '<div class="prev-post-content">';

				$prevpostcon .= '<b>' . esc_html( $prev_text ) . '</b>';
				$prevpostcon .= '<span>' . esc_html( $prev_post->post_title ) . '</span>';

			$prevpostcon .= '</div>';

			if ( has_post_thumbnail( $prev_post->ID ) ) {
				$prevpostimg .= '<div class="post-image">';

					$prevpostimg .= tp_get_image_rander( $prev_post->ID, 'thumbnail', array( 'class' => 'tp-nav-trans' ), 'post' );

				$prevpostimg .= '</div>';
			} else {
				$prevpostimg .= '<div class="post-image">';

					$prevpostimg .= '<img src="' . L_THEPLUS_URL . '/assets/images/placeholder-grid.jpg" class="tp-nav-trans" />';

				$prevpostimg .= '</div>';
			}

			if ( ! empty( $style ) ) {
				$lazyclass = '';
				if ( 'style-1' === $style ) {
					$prevnav .= '<a href="' . esc_url( get_permalink( $prev_post->ID ) ) . '" class="post_nav_link prev tp-nav-trans" rel="' . esc_attr__( 'prev', 'tpebl' ) . '">';

						$prevnav .= $prevpostimg;
						$prevnav .= $prevpostcon;

					$prevnav .= '</a>';
				} elseif ( 'style-2' === $style ) {
					$prevnav .= '<a href="' . esc_url( get_permalink( $prev_post->ID ) ) . '" class="post_nav_link prev tp-nav-trans" rel="' . esc_attr__( 'prev', 'tpebl' ) . '"><i aria-hidden="true" class="far fa-arrow-alt-circle-left"></i>';
					$prevnav .= '<div class="tp-post-nav-hover-con">' . $prevpostimg . $prevpostcon . '</div></a>';
				} elseif ( 'style-3' === $style ) {
					$img = wp_get_attachment_image_src( get_post_thumbnail_id( $prev_post->ID ), 'full' );

					if ( tp_has_lazyload() ) {
						$lazyclass = ' lazy-background';
					}

					$prevnav .= '<a href="' . esc_url( get_permalink( $prev_post->ID ) ) . '" class="post_nav_link prev tp-nav-trans" rel="' . esc_attr__( 'prev', 'tpebl' ) . '">';
					$prevnav .= '<div class="tp-post-nav-hover-con ' . esc_attr( $lazyclass ) . '" style="background-image: url(' . esc_url( ! empty( $img[0] ) ? $img[0] : '' ) . ');background-size: cover;background-attachment: fixed;background-position: center center;background-repeat:no-repeat;">' . $prevpostcon . '</div></a>';
				} elseif ( 'style-4' === $style ) {
					$prevnav .= '<a href="' . esc_url( get_permalink( $prev_post->ID ) ) . '" class="post_nav_link prev tp-nav-trans" rel="' . esc_attr__( 'prev', 'tpebl' ) . '">';

						$prevnav .= $prevpostimg;
						$prevnav .= '<div class="tp-post-nav-hover-arrow"></div>';
						$prevnav .= $prevpostcon;

					$prevnav .= '</a>';
				}
			}
		}

		$img1    = '';
		$nextnav = '';

		$nextpostcon = '';
		$nextpostimg = '';
		if ( ! empty( $next_post ) ) {
			$nextpostcon .= '<div class="next-post-content">';

				$nextpostcon .= '<b>' . esc_html( $next_text ) . '</b>';
				$nextpostcon .= '<span>' . esc_html( $next_post->post_title ) . '</span>';

			$nextpostcon .= '</div>';

			if ( has_post_thumbnail( $next_post->ID ) ) {
				$nextpostimg .= '<div class="post-image">';

					$nextpostimg .= tp_get_image_rander( $next_post->ID, 'thumbnail', array( 'class' => 'tp-nav-trans' ), 'post' );

				$nextpostimg .= '</div>';
			} else {
				$nextpostimg .= '<div class="post-image">';

					$nextpostimg .= '<img src="' . L_THEPLUS_URL . '/assets/images/placeholder-grid.jpg" class="tp-nav-trans" />';

				$nextpostimg .= '</div>';
			}

			if ( ! empty( $style ) ) {
				$lazyclass = '';
				if ( 'style-1' === $style ) {
					$nextnav .= '<a href="' . esc_url( get_permalink( $next_post->ID ) ) . '" class="post_nav_link next tp-nav-trans" rel="' . esc_attr__( 'next', 'tpebl' ) . '">';

						$nextnav .= $nextpostcon;
						$nextnav .= $nextpostimg;

					$nextnav .= '</a>';
				} elseif ( 'style-2' === $style ) {
					$nextnav .= '<a href="' . esc_url( get_permalink( $next_post->ID ) ) . '" class="post_nav_link next tp-nav-trans" rel="' . esc_attr__( 'next', 'tpebl' ) . '"><i aria-hidden="true" class="far fa-arrow-alt-circle-right"></i>';
					$nextnav .= '<div class="tp-post-nav-hover-con">' . $nextpostimg . $nextpostcon . '</div></a>';
				} elseif ( 'style-3' === $style ) {
					$img1 = wp_get_attachment_image_src( get_post_thumbnail_id( $next_post->ID ), 'full' );
					if ( tp_has_lazyload() ) {
						$lazyclass = ' lazy-background';
					}

					$nextnav .= '<a href="' . esc_url( get_permalink( $next_post->ID ) ) . '" class="post_nav_link next tp-nav-trans" rel="' . esc_attr__( 'next', 'tpebl' ) . '">';
					$nextnav .= '<div class="tp-post-nav-hover-con ' . esc_attr( $lazyclass ) . '" style="background-image: url(' . esc_url( $img1[0] ) . ');background-size: cover;background-attachment: fixed;background-position: center center;background-repeat:no-repeat;">' . $nextpostcon . '</div></a>';
				} elseif ( 'style-4' === $style ) {
					$nextnav .= '<a href="' . esc_url( get_permalink( $next_post->ID ) ) . '" class="post_nav_link next tp-nav-trans" rel="' . esc_attr__( 'next', 'tpebl' ) . '">';

						$nextnav .= $nextpostimg;
						$nextnav .= '<div class="tp-post-nav-hover-arrow"></div>';
						$nextnav .= $nextpostcon;

					$nextnav .= '</a>';
				}
			}
		}

		$output = '<div class="tp-post-navigation tp-nav-trans tp-widget-' . esc_attr( $uid_psnav ) . ' tp-nav-' . esc_attr( $style ) . '">';

			$output .= '<div class="tp-post-nav tp-row">';

		$colclass = '';
		if ( 'style-2' !== $style ) {
			$colclass = 'tp-col tp-col-md-6 tp-col-sm-6 tp-col-xs-12';
		}

				$output .= '<div class="post-prev ' . esc_attr( $colclass ) . '">';

					$output .= $prevnav;

				$output .= '</div>';

				$output .= '<div class="post-next ' . esc_attr( $colclass ) . '">';

					$output .= $nextnav;

				$output .= '</div>';

			$output .= '</div>';

		$output .= '</div>';

		echo $output;
	}

	/**
	 * Render content_template
	 *
	 * @since 5.0.0
	 * @version 5.4.2
	 */
	protected function content_template() {
	}
}
