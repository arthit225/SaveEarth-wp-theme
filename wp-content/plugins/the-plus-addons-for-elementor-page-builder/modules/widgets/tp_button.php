<?php
/**
 * Widget Name: Button
 * Description: creative of button style.
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

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class L_ThePlus_Button
 */
class L_ThePlus_Button extends Widget_Base {

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
		return 'tp-button';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 1.0.0
	 */
	public function get_title() {
		return esc_html__( 'TP Button', 'tpebl' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'fa fa-link theplus_backend_icon';
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
		return array( 'Buttons', 'Button widget', 'Elementor buttons', ' Elementor button widget', 'Button elementor addon', 'Elementor plus addon buttons', 'Elementor plus buttons', 'Button', 'Button elementor element', 'Button elementor module', 'Elementor button module', 'Elementor button element', 'Button elementor extension', 'Elementor button extension', 'Button elementor plugin', 'Elementor button plugin' );
	}

	public function get_custom_help_url() {
		$doc_url = $this->tp_help;

		return esc_url( $doc_url );
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
			'content_section',
			array(
				'label' => esc_html__( 'Content', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'button_style',
			array(
				'type'    => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Button Style', 'tpebl' ),
				'default' => 'style-1',
				'options' => array(
					'style-1'  => esc_html__( 'Style 1', 'tpebl' ),
					'style-2'  => esc_html__( 'Style 2', 'tpebl' ),
					'style-3'  => esc_html__( 'Style 3', 'tpebl' ),
					'style-4'  => esc_html__( 'Style 4', 'tpebl' ),
					'style-5'  => esc_html__( 'Style 5', 'tpebl' ),
					'style-6'  => esc_html__( 'Style 6', 'tpebl' ),
					'style-7'  => esc_html__( 'Style 7', 'tpebl' ),
					'style-8'  => esc_html__( 'Style 8', 'tpebl' ),
					'style-9'  => esc_html__( 'Style 9', 'tpebl' ),
					'style-10' => esc_html__( 'Style 10', 'tpebl' ),
					'style-11' => esc_html__( 'Style 11', 'tpebl' ),
					'style-12' => esc_html__( 'Style 12', 'tpebl' ),
					'style-13' => esc_html__( 'Style 13', 'tpebl' ),
					'style-14' => esc_html__( 'Style 14', 'tpebl' ),
					'style-15' => esc_html__( 'Style 15', 'tpebl' ),
					'style-16' => esc_html__( 'Style 16', 'tpebl' ),
					'style-17' => esc_html__( 'Style 17', 'tpebl' ),
					'style-18' => esc_html__( 'Style 18', 'tpebl' ),
					'style-19' => esc_html__( 'Style 19', 'tpebl' ),
					'style-20' => esc_html__( 'Style 20', 'tpebl' ),
					'style-21' => esc_html__( 'Style 21', 'tpebl' ),
					'style-22' => esc_html__( 'Style 22', 'tpebl' ),
					'style-24' => esc_html__( 'Style 23', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'button_text',
			array(
				'label'       => esc_html__( 'Text', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
				'default'     => esc_html__( 'Read More', 'tpebl' ),
				'placeholder' => esc_html__( 'Read More', 'tpebl' ),
			)
		);
		$this->add_control(
			'button_24_text',
			array(
				'label'       => esc_html__( 'Button Tag Text', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
				'default'     => esc_html__( 'Click Here', 'tpebl' ),
				'placeholder' => esc_html__( 'Click Here', 'tpebl' ),
				'condition'   => array(
					'button_style' => array( 'style-24' ),
				),
			)
		);
		$this->add_control(
			'button_hover_text',
			array(
				'label'       => wp_kses_post( "Hover Text <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "button-text-on-hover-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
				'default'     => esc_html__( 'Click Here', 'tpebl' ),
				'placeholder' => esc_html__( 'Click Here', 'tpebl' ),
				'condition'   => array(
					'button_style' => array( 'style-4', 'style-11', 'style-14' ),
				),
			)
		);
		$this->add_control(
			'button_link',
			array(
				'label'       => esc_html__( 'Link', 'tpebl' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => array(
					'active' => true,
				),
				'separator'   => 'before',
				'placeholder' => esc_html__( 'https://www.demo-link.com', 'tpebl' ),
				'default'     => array(
					'url' => '#',
				),
			)
		);
		$this->add_control(
			'button_custom_attributes',
			array(
				'label'     => __( 'Add Custom Attributes', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Yes', 'tpebl' ),
				'label_off' => esc_html__( 'No', 'tpebl' ),
				'default'   => 'no',
			)
		);

		$this->add_control(
			'custom_attributes',
			array(
				'label'       => __( 'Custom Attributes', 'tpebl' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => array(
					'active' => true,
				),
				'placeholder' => __( 'key=value', 'tpebl' ),
				'condition'   => array(
					'button_custom_attributes' => 'yes',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_button_styling',
			array(
				'label' => esc_html__( 'Layout', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_responsive_control(
			'button_align',
			array(
				'label'   => esc_html__( 'Alignment', 'tpebl' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => array(
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
			)
		);

		$this->add_control(
			'btn_hover_style',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Button Style', 'tpebl' ),
				'default'   => 'hover-left',
				'options'   => array(
					'hover-left'   => esc_html__( 'On Left', 'tpebl' ),
					'hover-right'  => esc_html__( 'On Right', 'tpebl' ),
					'hover-top'    => esc_html__( 'On Top', 'tpebl' ),
					'hover-bottom' => esc_html__( 'On Bottom', 'tpebl' ),
				),
				'condition' => array(
					'button_style' => array( 'style-11', 'style-13' ),
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_button_icon_styling',
			array(
				'label'     => esc_html__( 'Icon Settings', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'button_style!' => array( 'style-3', 'style-6', 'style-7', 'style-9' ),
				),
			)
		);
		$this->add_control(
			'icon_hover_style',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Icon Hover Style', 'tpebl' ),
				'default'   => 'hover-top',
				'options'   => array(
					'hover-top'    => esc_html__( 'On Top', 'tpebl' ),
					'hover-bottom' => esc_html__( 'On Bottom', 'tpebl' ),
				),
				'condition' => array(
					'button_style' => array( 'style-17' ),
				),
			)
		);
		$this->add_control(
			'button_icon_style',
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
					'button_style!' => array( 'style-3', 'style-6', 'style-7', 'style-9' ),
				),
			)
		);
		$this->add_control(
			'button_icon',
			array(
				'label'       => esc_html__( 'Icon', 'tpebl' ),
				'type'        => Controls_Manager::ICON,
				'label_block' => true,
				'default'     => 'fa fa-chevron-right',
				'condition'   => array(
					'button_style!'     => array( 'style-3', 'style-6', 'style-7', 'style-9' ),
					'button_icon_style' => 'font_awesome',
				),
			)
		);
		$this->add_control(
			'button_icon_5',
			array(
				'label'     => esc_html__( 'Icon Library', 'tpebl' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-plus',
					'library' => 'solid',
				),
				'condition' => array(
					'button_style!'     => array( 'style-3', 'style-6', 'style-7', 'style-9' ),
					'button_icon_style' => 'font_awesome_5',
				),
			)
		);
		$this->add_control(
			'before_after',
			array(
				'label'     => esc_html__( 'Icon Position', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'after',
				'options'   => array(
					'after'  => esc_html__( 'After', 'tpebl' ),
					'before' => esc_html__( 'Before', 'tpebl' ),
				),
				'condition' => array(
					'button_style!'      => array( 'style-3', 'style-6', 'style-7', 'style-9', 'style-17' ),
					'button_icon_style!' => '',
				),
			)
		);
		$this->add_responsive_control(
			'icon_spacing',
			array(
				'label'     => esc_html__( 'Icon Spacing', 'tpebl' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max' => 100,
					),
				),
				'condition' => array(
					'button_style!'      => array( 'style-3', 'style-6', 'style-7', 'style-9', 'style-17' ),
					'button_icon_style!' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .button-link-wrap .button-after' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .button-link-wrap .button-before' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .pt_plus_button.button-style-22 .button-link-wrap .btn-icon.button-before' => 'padding-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .pt_plus_button.button-style-22 .button-link-wrap .btn-icon.button-after' => 'padding-right: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'icon_size',
			array(
				'label'     => esc_html__( 'Icon Size', 'tpebl' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max' => 200,
					),
				),
				'separator' => 'before',
				'condition' => array(
					'button_style!'      => array( 'style-3', 'style-6', 'style-7', 'style-9', 'style-17' ),
					'button_icon_style!' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .button-link-wrap .btn-icon' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .button-link-wrap .btn-icon svg' => 'width: {{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_extra_styling',
			array(
				'label' => esc_html__( 'Extra', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'button_css_id',
			array(
				'label'       => esc_html__( 'Button ID', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'title'       => esc_html__( 'Add your custom id WITHOUT the Pound key. e.g: my-id', 'tpebl' ),
				'label_block' => false,
			)
		);
		$this->add_control(
			'btn_id_Note',
			array(
				'type'        => Controls_Manager::RAW_HTML,
				'raw'         => '<p class="tp-controller-notice"><i>Please make sure the ID is unique and not used elsewhere on the page this form is displayed. This field allows <code>A-z 0-9</code> & underscore chars without spaces..</i></p>',
				'label_block' => true,
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_styling',
			array(
				'label' => esc_html__( 'Typography and Cosmetics', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'button_margin',
			array(
				'label'      => esc_html__( 'Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_button:not(.button-style-11):not(.button-style-17) .button-link-wrap,
					{{WRAPPER}} .pt_plus_button.button-style-11 .button-link-wrap > span,
					{{WRAPPER}} .pt_plus_button.button-style-11 .button-link-wrap::before,
					{{WRAPPER}} .pt_plus_button.button-style-17 .button-link-wrap > span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'button_padding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'default'    => array(
					'top'      => '15',
					'right'    => '30',
					'bottom'   => '15',
					'left'     => '30',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_button:not(.button-style-11):not(.button-style-17) .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-11 .button-link-wrap > span,{{WRAPPER}} .pt_plus_button.button-style-11 .button-link-wrap::before,{{WRAPPER}} .pt_plus_button.button-style-17 .button-link-wrap > span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'button_typography',
				'selector' => '{{WRAPPER}} .pt_plus_button .button-link-wrap',
			)
		);
		$this->add_control(
			'button_svg_icon_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Svg Icon Size', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .pt_plus_button .button-link-wrap svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);

		$this->add_control(
			'btn_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_button .button-link-wrap' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pt_plus_button .button-link-wrap svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .pt_plus_button.button-style-3 .button-link-wrap .arrow *' => 'fill: {{VALUE}};stroke: {{VALUE}};',
					'{{WRAPPER}} .pt_plus_button.button-style-7 .button-link-wrap:after' => 'border-color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'btn_icon_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_button .button-link-wrap .btn-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pt_plus_button .button-link-wrap svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .pt_plus_button.button-style-7 .button-link-wrap:after' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .pt_plus_button.button-style-6 .button-link-wrap::before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pt_plus_button.button-style-7 .button-link-wrap span.btn-arrow' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pt_plus_button.button-style-9 a.button-link-wrap .btn-arrow' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'button_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .pt_plus_button.button-style-2 .button-link-wrap i,
								{{WRAPPER}} .pt_plus_button.button-style-3 a.button-link-wrap:before,
								{{WRAPPER}} .pt_plus_button.button-style-4 .button-link-wrap,
								{{WRAPPER}} .pt_plus_button.button-style-5 .button-link-wrap,
								{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap,
								{{WRAPPER}} .pt_plus_button.button-style-10 .button-link-wrap,
								{{WRAPPER}} .pt_plus_button.button-style-11 .button-link-wrap,
								{{WRAPPER}} .pt_plus_button.button-style-14 .button-link-wrap,
								{{WRAPPER}} .pt_plus_button.button-style-15 .button-link-wrap::before,
								{{WRAPPER}} .pt_plus_button.button-style-15 .button-link-wrap::after,
								{{WRAPPER}} .pt_plus_button.button-style-16 .button-link-wrap::after,
								{{WRAPPER}} .pt_plus_button.button-style-17 .button-link-wrap,
								{{WRAPPER}} .pt_plus_button.button-style-18 .button-link-wrap::after,
								{{WRAPPER}} .pt_plus_button.button-style-19 .button-link-wrap,
								{{WRAPPER}} .pt_plus_button.button-style-20 .button-link-wrap,
								{{WRAPPER}} .pt_plus_button.button-style-21 .button-link-wrap,
								{{WRAPPER}} .pt_plus_button.button-style-22 .button-link-wrap,
								{{WRAPPER}} .pt_plus_button.button-style-24 .button-link-wrap',
				'condition' => array(
					'button_style!' => array( 'style-1', 'style-6', 'style-7', 'style-9', 'style-12', 'style-13' ),
				),
			)
		);
		$this->add_control(
			'button_border_style',
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
					'{{WRAPPER}} .pt_plus_button.button-style-4 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-5 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-10 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-11 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-12 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-13 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-14 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-16 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-17 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-19 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-20 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-21 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-22 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-24 .button-link-wrap' => 'border-style: {{VALUE}};',
				),
				'separator' => 'before',
				'condition' => array(
					'button_style' => array( 'style-4', 'style-5', 'style-8', 'style-10', 'style-11', 'style-12', 'style-13', 'style-14', 'style-16', 'style-17', 'style-19', 'style-20', 'style-21', 'style-22', 'style-24' ),
				),
			)
		);

		$this->add_responsive_control(
			'button_border_width',
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
					'{{WRAPPER}} .pt_plus_button.button-style-4 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-5 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-10 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-11 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-12 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-13 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-14 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-16 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-16 .button-link-wrap::before,{{WRAPPER}} .pt_plus_button.button-style-17 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-19 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-20 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-21 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-22 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-24 .button-link-wrap' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'button_style'         => array( 'style-4', 'style-5', 'style-8', 'style-10', 'style-11', 'style-12', 'style-13', 'style-14', 'style-16', 'style-17', 'style-19', 'style-20', 'style-21', 'style-22', 'style-24' ),
					'button_border_style!' => 'none',
				),
			)
		);

		$this->add_control(
			'button_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_button.button-style-4 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-5 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-10 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-11 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-12 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-13 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-14 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-16 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-17 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-19 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-20 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-21 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-22 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-24 .button-link-wrap' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .pt_plus_button.button-style-18 .button-link-wrap' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'button_style'         => array( 'style-4', 'style-5', 'style-8', 'style-10', 'style-11', 'style-12', 'style-13', 'style-14', 'style-16', 'style-17', 'style-18', 'style-19', 'style-20', 'style-21', 'style-22', 'style-24' ),
					'button_border_style!' => 'none',
				),
			)
		);

		$this->add_responsive_control(
			'button_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_button.button-style-4 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-10 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-11 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-12 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-13 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-14 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-16 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-17 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-18 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-18 .button-link-wrap::after,{{WRAPPER}} .pt_plus_button.button-style-19 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-20 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-21 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-22 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-24 .button-link-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'button_style' => array( 'style-4', 'style-8', 'style-10', 'style-11', 'style-12', 'style-13', 'style-14', 'style-16', 'style-17', 'style-19', 'style-20', 'style-21', 'style-22', 'style-24' ),
				),
			)
		);
		$this->add_responsive_control(
			'button_radius_18',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_button.button-style-18 .button-link-wrap::after,{{WRAPPER}} .pt_plus_button.button-style-18 .button-link-wrap::before,{{WRAPPER}} .pt_plus_button.button-style-18 .button-link-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'button_style' => 'style-18',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'button_shadow',
				'selector'  => '{{WRAPPER}} .pt_plus_button.button-style-2 .button-link-wrap i,
							   {{WRAPPER}} .pt_plus_button.button-style-4 .button-link-wrap,
							   {{WRAPPER}} .pt_plus_button.button-style-5 .button-link-wrap,
							   {{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap,
							   {{WRAPPER}} .pt_plus_button.button-style-10 .button-link-wrap,
							   {{WRAPPER}} .pt_plus_button.button-style-11 .button-link-wrap,
							   {{WRAPPER}} .pt_plus_button.button-style-12 .button-link-wrap,
							   {{WRAPPER}} .pt_plus_button.button-style-13 .button-link-wrap,
							   {{WRAPPER}} .pt_plus_button.button-style-14 .button-link-wrap,
							   {{WRAPPER}} .pt_plus_button.button-style-15 .button-link-wrap,
							   {{WRAPPER}} .pt_plus_button.button-style-16 .button-link-wrap,
							   {{WRAPPER}} .pt_plus_button.button-style-17 .button-link-wrap,
							   {{WRAPPER}} .pt_plus_button.button-style-18 .button-link-wrap,
							   {{WRAPPER}} .pt_plus_button.button-style-19 .button-link-wrap,
							   {{WRAPPER}} .pt_plus_button.button-style-20 .button-link-wrap,
							   {{WRAPPER}} .pt_plus_button.button-style-21 .button-link-wrap,
							   {{WRAPPER}} .pt_plus_button.button-style-22 .button-link-wrap,
							   {{WRAPPER}} .pt_plus_button.button-style-24 .button-link-wrap',
				'condition' => array(
					'button_style' => array( 'style-2', 'style-4', 'style-5', 'style-8', 'style-10', 'style-11', 'style-12', 'style-13', 'style-14', 'style-15', 'style-16', 'style-17', 'style-18', 'style-19', 'style-20', 'style-21', 'style-22', 'style-24' ),
				),
			)
		);
		$this->add_control(
			'btn_bottom_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'button_style' => 'style-1',
				),
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_button .button-link-wrap .button_line' => 'background: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'bottom_border_height',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Border Height', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'default'     => array(
					'unit' => 'px',
					'size' => 1,
				),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 20,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'condition'   => array(
					'button_style' => 'style-1',
				),
				'selectors'   => array(
					'{{WRAPPER}} .pt_plus_button .button-link-wrap .button_line' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'btn_text_hover_color',
			array(
				'label'     => esc_html__( 'Text Hover Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_button .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-17 .button-link-wrap .btn-icon,{{WRAPPER}} .pt_plus_button.button-style-22 .button-link-wrap .btn-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pt_plus_button .button-link-wrap:hover svg,{{WRAPPER}} .pt_plus_button.button-style-17 .button-link-wrap .btn-icon svg,{{WRAPPER}} .pt_plus_button.button-style-22 .button-link-wrap .btn-icon svg,{{WRAPPER}} .pt_plus_button.button-style-11 .button-link-wrap svg,{{WRAPPER}} .pt_plus_button.button-style-14 .button-link-wrap svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .pt_plus_button.button-style-11 .button-link-wrap::before,{{WRAPPER}} .pt_plus_button.button-style-14 .button-link-wrap::after' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pt_plus_button.button-style-3 .button-link-wrap:hover .arrow-1 *' => 'fill: {{VALUE}};stroke: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'button_hover_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .pt_plus_button.button-style-2 .button-link-wrap:hover i,
								{{WRAPPER}} .pt_plus_button.button-style-3 .button-link-wrap:hover:before,
								{{WRAPPER}} .pt_plus_button.button-style-4 .button-link-wrap::after,
								{{WRAPPER}} .pt_plus_button.button-style-5 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-5 .button-link-wrap:before,{{WRAPPER}} .pt_plus_button.button-style-5 .button-link-wrap:after,
								{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap:hover,
								{{WRAPPER}} .pt_plus_button.button-style-10 .button-link-wrap:hover,
								{{WRAPPER}} .pt_plus_button.button-style-11 .button-link-wrap::before,
								{{WRAPPER}} .pt_plus_button.button-style-12 .button-link-wrap::before,
								{{WRAPPER}} .pt_plus_button.button-style-13 .button-link-wrap::before,{{WRAPPER}} .pt_plus_button.button-style-13 .button-link-wrap::after,
								{{WRAPPER}} .pt_plus_button.button-style-14 .button-link-wrap:hover,
								{{WRAPPER}} .pt_plus_button.button-style-15 .button-link-wrap:hover::after,
								{{WRAPPER}} .pt_plus_button.button-style-16 .button-link-wrap::before,
								{{WRAPPER}} .pt_plus_button.button-style-17 .button-link-wrap::before,
								{{WRAPPER}} .pt_plus_button.button-style-18 .button-link-wrap:hover::after,
								{{WRAPPER}} .pt_plus_button.button-style-19 .button-link-wrap:after,
								{{WRAPPER}} .pt_plus_button.button-style-20 .button-link-wrap:after,
								{{WRAPPER}} .pt_plus_button.button-style-21 .button-link-wrap:after,
								{{WRAPPER}} .pt_plus_button.button-style-22 .button-link-wrap:hover,
								{{WRAPPER}} .pt_plus_button.button-style-24 .button-link-wrap:hover',
				'condition' => array(
					'button_style!' => array( 'style-1', 'style-6', 'style-7', 'style-9' ),
				),
			)
		);
		$this->add_control(
			'hover_button_border_style',
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
					'{{WRAPPER}} .pt_plus_button.button-style-4 .button-link-wrap:hover,
					{{WRAPPER}} .pt_plus_button.button-style-5 .button-link-wrap:hover,
					{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap:hover,
					{{WRAPPER}} .pt_plus_button.button-style-10 .button-link-wrap:hover,
					{{WRAPPER}} .pt_plus_button.button-style-11 .button-link-wrap:hover,
					{{WRAPPER}} .pt_plus_button.button-style-12 .button-link-wrap:hover,
					{{WRAPPER}} .pt_plus_button.button-style-13 .button-link-wrap:hover,
					{{WRAPPER}} .pt_plus_button.button-style-14 .button-link-wrap:hover,
					{{WRAPPER}} .pt_plus_button.button-style-16 .button-link-wrap:hover,
					{{WRAPPER}} .pt_plus_button.button-style-17 .button-link-wrap:hover,
					{{WRAPPER}} .pt_plus_button.button-style-19 .button-link-wrap:hover,
					{{WRAPPER}} .pt_plus_button.button-style-20 .button-link-wrap:hover,
					{{WRAPPER}} .pt_plus_button.button-style-21 .button-link-wrap:hover,
					{{WRAPPER}} .pt_plus_button.button-style-22 .button-link-wrap:hover,
					{{WRAPPER}} .pt_plus_button.button-style-24 .button-link-wrap:hover' => 'border-style: {{VALUE}};',
				),
				'separator' => 'before',
				'condition' => array(
					'button_style' => array( 'style-4', 'style-5', 'style-8', 'style-10', 'style-11', 'style-12', 'style-13', 'style-14', 'style-16', 'style-17', 'style-19', 'style-20', 'style-21', 'style-22', 'style-24' ),
				),
			)
		);

		$this->add_responsive_control(
			'hover_button_border_width',
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
					'{{WRAPPER}} .pt_plus_button.button-style-4 .button-link-wrap:hover,
					{{WRAPPER}} .pt_plus_button.button-style-5 .button-link-wrap:hover,
					{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap:hover,
					{{WRAPPER}} .pt_plus_button.button-style-10 .button-link-wrap:hover,
					{{WRAPPER}} .pt_plus_button.button-style-11 .button-link-wrap:hover,
					{{WRAPPER}} .pt_plus_button.button-style-12 .button-link-wrap:hover,
					{{WRAPPER}} .pt_plus_button.button-style-13 .button-link-wrap:hover,
					{{WRAPPER}} .pt_plus_button.button-style-14 .button-link-wrap:hover,
					{{WRAPPER}} .pt_plus_button.button-style-16 .button-link-wrap:hover,
					{{WRAPPER}} .pt_plus_button.button-style-16 .button-link-wrap::before,
					{{WRAPPER}} .pt_plus_button.button-style-17 .button-link-wrap:hover,
					{{WRAPPER}} .pt_plus_button.button-style-19 .button-link-wrap:hover,
					{{WRAPPER}} .pt_plus_button.button-style-20 .button-link-wrap:hover,
					{{WRAPPER}} .pt_plus_button.button-style-21 .button-link-wrap:hover,
					{{WRAPPER}} .pt_plus_button.button-style-22 .button-link-wrap:hover,
					{{WRAPPER}} .pt_plus_button.button-style-24 .button-link-wrap:hover' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'button_style'               => array( 'style-4', 'style-5', 'style-8', 'style-10', 'style-11', 'style-12', 'style-13', 'style-14', 'style-16', 'style-17', 'style-19', 'style-20', 'style-21', 'style-22', 'style-24' ),
					'hover_button_border_style!' => 'none',
				),
			)
		);

		$this->add_control(
			'button_border_hover_color',
			array(
				'label'     => esc_html__( 'Hover Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_button.button-style-4 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-5 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-10 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-11 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-12 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-13 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-14 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-16 .button-link-wrap::before,{{WRAPPER}} .pt_plus_button.button-style-17 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-19 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-20 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-21 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-22 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-24 .button-link-wrap:hover' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .pt_plus_button.button-style-18 .button-link-wrap::before' => 'background: {{VALUE}};',
				),
				'separator' => 'before',
				'condition' => array(
					'button_style'         => array( 'style-4', 'style-5', 'style-8', 'style-10', 'style-11', 'style-12', 'style-13', 'style-14', 'style-16', 'style-17', 'style-18', 'style-19', 'style-20', 'style-21', 'style-22', 'style-24' ),
					'button_border_style!' => 'none',
				),
			)
		);
		$this->add_responsive_control(
			'button_radius_hover_18',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_button.button-style-18 .button-link-wrap:hover::after,{{WRAPPER}} .pt_plus_button.button-style-18 .button-link-wrap:hover::before,{{WRAPPER}} .pt_plus_button.button-style-18 .button-link-wrap:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'button_style' => 'style-18',
				),
			)
		);
		$this->add_responsive_control(
			'button_hover_radius',
			array(
				'label'      => esc_html__( 'Hover Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_button.button-style-4 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-10 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-11 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-12 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-13 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-14 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-16 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-17 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-19 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-20 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-21 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-22 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-24 .button-link-wrap:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'button_style' => array( 'style-4', 'style-8', 'style-10', 'style-11', 'style-12', 'style-13', 'style-14', 'style-16', 'style-17', 'style-19', 'style-20', 'style-21', 'style-22', 'style-24' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'button_hover_shadow',
				'selector'  => '{{WRAPPER}} .pt_plus_button.button-style-2 .button-link-wrap:hover i,
							   {{WRAPPER}} .pt_plus_button.button-style-4 .button-link-wrap:hover,
							   {{WRAPPER}} .pt_plus_button.button-style-5 .button-link-wrap:hover,
							   {{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap:hover,
							   {{WRAPPER}} .pt_plus_button.button-style-10 .button-link-wrap:hover,
							   {{WRAPPER}} .pt_plus_button.button-style-11 .button-link-wrap:hover,
							   {{WRAPPER}} .pt_plus_button.button-style-12 .button-link-wrap:hover,
							   {{WRAPPER}} .pt_plus_button.button-style-13 .button-link-wrap:hover,
							   {{WRAPPER}} .pt_plus_button.button-style-14 .button-link-wrap:hover,
							   {{WRAPPER}} .pt_plus_button.button-style-15 .button-link-wrap:hover,
							   {{WRAPPER}} .pt_plus_button.button-style-16 .button-link-wrap:hover,
							   {{WRAPPER}} .pt_plus_button.button-style-17 .button-link-wrap:hover,
							   {{WRAPPER}} .pt_plus_button.button-style-18 .button-link-wrap:hover,
							   {{WRAPPER}} .pt_plus_button.button-style-19 .button-link-wrap:hover,
							   {{WRAPPER}} .pt_plus_button.button-style-20 .button-link-wrap:hover,
							   {{WRAPPER}} .pt_plus_button.button-style-21 .button-link-wrap:hover,
							   {{WRAPPER}} .pt_plus_button.button-style-22 .button-link-wrap:hover,
							   {{WRAPPER}} .pt_plus_button.button-style-24 .button-link-wrap:hover',
				'condition' => array(
					'button_style' => array( 'style-2', 'style-4', 'style-5', 'style-8', 'style-10', 'style-11', 'style-12', 'style-13', 'style-14', 'style-15', 'style-16', 'style-17', 'style-18', 'style-19', 'style-20', 'style-21', 'style-22', 'style-24' ),
				),
			)
		);
		$this->add_control(
			'btn_bottom_border_hover_color',
			array(
				'label'     => esc_html__( 'Border Hover Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'button_style' => 'style-1',
				),
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_button .button-link-wrap:hover .button_line' => 'background: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'button_tag_24_heading',
			array(
				'label'     => esc_html__( 'Button Tag Text', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'button_style' => array( 'style-24' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'button_tag_typography',
				'selector'  => '{{WRAPPER}} .pt_plus_button.button-style-24 .button-tag-hint',
				'condition' => array(
					'button_style' => 'style-24',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_extra_effect_styling',
			array(
				'label' => esc_html__( 'Special', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'btn_magic_scroll',
			array(
				'label'       => esc_html__( 'Magic Scroll', 'tpebl' ),
				'type'        => Controls_Manager::SWITCHER,
				'label_on'    => esc_html__( 'Yes', 'tpebl' ),
				'label_off'   => esc_html__( 'No', 'tpebl' ),
				'render_type' => 'template',
			)
		);
		$this->add_control(
			'btn_magic_scroll_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'btn_magic_scroll' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'plus_tooltip',
			array(
				'label'       => wp_kses_post( "Tooltip <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "tooltip-text-in-button-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'        => Controls_Manager::SWITCHER,
				'label_on'    => esc_html__( 'Yes', 'tpebl' ),
				'label_off'   => esc_html__( 'No', 'tpebl' ),
				'render_type' => 'template',
				'separator'   => 'before',
			)
		);
		$this->add_control(
			'plus_tooltip_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'plus_tooltip' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'btn_special_effect',
			array(
				'label'     => esc_html__( 'Special Effect', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'btn_special_effect_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'btn_special_effect' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'plus_mouse_move_parallax',
			array(
				'label'       => esc_html__( 'Mouse Move Parallax', 'tpebl' ),
				'type'        => Controls_Manager::SWITCHER,
				'label_on'    => esc_html__( 'Yes', 'tpebl' ),
				'label_off'   => esc_html__( 'No', 'tpebl' ),
				'render_type' => 'template',
				'separator'   => 'before',
			)
		);
		$this->add_control(
			'plus_mouse_move_parallax_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'plus_mouse_move_parallax' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'plus_continuous_animation',
			array(
				'label'       => wp_kses_post( "Continuous Animation <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "continuous-animation-in-button-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'        => Controls_Manager::SWITCHER,
				'label_on'    => esc_html__( 'Yes', 'tpebl' ),
				'label_off'   => esc_html__( 'No', 'tpebl' ),
				'render_type' => 'template',
				'separator'   => 'before',
			)
		);
		$this->add_control(
			'plus_animation_effect',
			array(
				'label'       => esc_html__( 'Animation Effect', 'tpebl' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'pulse',
				'options'     => array(
					'pulse'    => esc_html__( 'Pulse', 'tpebl' ),
					'floating' => esc_html__( 'Floating', 'tpebl' ),
					'tossing'  => esc_html__( 'Tossing', 'tpebl' ),
					'rotating' => esc_html__( 'Rotating', 'tpebl' ),
				),
				'render_type' => 'template',
				'condition'   => array(
					'plus_continuous_animation' => 'yes',
				),
			)
		);
		$this->add_control(
			'plus_animation_hover',
			array(
				'label'       => esc_html__( 'Hover Animation', 'tpebl' ),
				'type'        => Controls_Manager::SWITCHER,
				'label_on'    => esc_html__( 'Yes', 'tpebl' ),
				'label_off'   => esc_html__( 'No', 'tpebl' ),
				'render_type' => 'template',
				'condition'   => array(
					'plus_continuous_animation' => 'yes',
				),
			)
		);
		$this->add_control(
			'plus_animation_duration',
			array(
				'label'      => esc_html__( 'Duration Time', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => 's',
				'range'      => array(
					's' => array(
						'min'  => 0.5,
						'max'  => 50,
						'step' => 0.1,
					),
				),
				'default'    => array(
					'unit' => 's',
					'size' => 2.5,
				),
				'selectors'  => array(
					'{{WRAPPER}} .pt-plus-button-wrapper .animted-content-inner' => 'animation-duration: {{SIZE}}{{UNIT}};-webkit-animation-duration: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'plus_continuous_animation' => 'yes',
				),
			)
		);
		$this->add_control(
			'plus_transform_origin',
			array(
				'label'       => esc_html__( 'Transform Origin', 'tpebl' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'center center',
				'options'     => array(
					'top left'      => esc_html__( 'Top Left', 'tpebl' ),
					'top center"'   => esc_html__( 'Top Center', 'tpebl' ),
					'top right'     => esc_html__( 'Top Right', 'tpebl' ),
					'center left'   => esc_html__( 'Center Left', 'tpebl' ),
					'center center' => esc_html__( 'Center Center', 'tpebl' ),
					'center right'  => esc_html__( 'Center Right', 'tpebl' ),
					'bottom left'   => esc_html__( 'Bottom Left', 'tpebl' ),
					'bottom center' => esc_html__( 'Bottom Center', 'tpebl' ),
					'bottom right'  => esc_html__( 'Bottom Right', 'tpebl' ),
				),
				'selectors'   => array(
					'{{WRAPPER}} .pt-plus-button-wrapper .animted-content-inner' => '-webkit-transform-origin: {{VALUE}};-moz-transform-origin: {{VALUE}};-ms-transform-origin: {{VALUE}};-o-transform-origin: {{VALUE}};transform-origin: {{VALUE}};',
				),
				'render_type' => 'template',
				'condition'   => array(
					'plus_continuous_animation' => 'yes',
					'plus_animation_effect'     => 'rotating',
				),
			)
		);
		$this->add_control(
			'full_width_btn',
			array(
				'label'     => wp_kses_post( "Full-Width Button<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "full-width-button-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'btn_hover_effects',
			array(
				'label'     => wp_kses_post( "Button Hover Effects <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "button-hover-animation-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'separator' => 'before',
				'options'   => l_theplus_get_content_hover_effect_options(),
			)
		);
		$this->add_control(
			'hover_shadow_color',
			array(
				'label'     => esc_html__( 'Shadow Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(0, 0, 0, 0.6)',
				'condition' => array(
					'btn_hover_effects' => array( 'float_shadow', 'grow_shadow', 'shadow_radial' ),
				),
			)
		);
		$this->add_control(
			'shake_animate',
			array(
				'label'     => wp_kses_post( "Interval Shake Animate' <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "interval-shake-animation-in-button-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'shake_animate_duration',
			array(
				'label'     => esc_html__( 'Interval Shake Duration', 'tpebl' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 100,
				'step'      => 1,
				'default'   => 5,
				'selectors' => array(
					'{{WRAPPER}} .pt-plus-button-wrapper .button-link-wrap.shake_animate' => ' animation-duration: {{VALUE}}s;-o-animation-duration: {{VALUE}}s;
					-ms-animation-duration: {{VALUE}}s;-moz-animation-duration: {{VALUE}}s;-webkit-animation-duration: {{VALUE}}s;',
				),
				'condition' => array(
					'shake_animate' => 'yes',
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
	 * Render Block quote
	 *
	 * Written in PHP and HTML.
	 *
	 * @since 1.0.0
	 *
	 * @version 5.4.2
	 */
	protected function render() {

		$settings    = $this->get_settings_for_display();
		$hover_class = '';
		$hover_attr  = '';
		$data_class  = '';

		$full_button_width = '';
		$button_hover_text = '';

		$reveal_effects = '';
		$effect_attr    = '';

		$btn_sp_effect  = ! empty( $settings['btn_special_effect'] ) ? $settings['btn_special_effect'] : '';
		$full_width_btn = ! empty( $settings['full_width_btn'] ) ? $settings['full_width_btn'] : '';

		$plus_mouse = ! empty( $settings['plus_mouse_move_parallax'] ) ? $settings['plus_mouse_move_parallax'] : '';
		$btn_hover  = ! empty( $settings['btn_hover_effects'] ) ? $settings['btn_hover_effects'] : '';
		$btn_link   = ! empty( $settings['button_link']['url'] ) ? $settings['button_link']['url'] : '';

		$lz1        = function_exists( 'tp_has_lazyload' ) ? tp_bg_lazyLoad( $settings['button_background_image'], $settings['button_hover_background_image'] ) : '';
		$btn_id     = ! empty( $settings['button_css_id'] ) ? $settings['button_css_id'] : '';
		$shake_ani  = ! empty( $settings['shake_animate'] ) ? $settings['shake_animate'] : '';
		$hover_text = ! empty( $settings['button_hover_text'] ) ? $settings['button_hover_text'] : '';
		$btn_text   = ! empty( $settings['button_text'] ) ? $settings['button_text'] : '';

		$coni_ani  = ! empty( $settings['plus_continuous_animation'] ) ? $settings['plus_continuous_animation'] : '';
		$hover_ani = ! empty( $settings['plus_animation_hover'] ) ? $settings['plus_animation_hover'] : '';
		$plus_ani  = ! empty( $settings['plus_animation_effect'] ) ? $settings['plus_animation_effect'] : 'pulse';

		$out_default_ani   = ! empty( $settings['animation_out_duration_default'] ) ? $settings['animation_out_duration_default'] : '';
		$ani_duration      = ! empty( $settings['animation_duration_default'] ) ? $settings['animation_duration_default'] : '';
		$animate_duration  = ! empty( $settings['animate_duration']['size'] ) ? $settings['animate_duration']['size'] : 50;
		$out_ani_effects   = ! empty( $settings['animation_out_effects'] ) ? $settings['animation_out_effects'] : '';
		$out_ani_delay     = ! empty( $settings['animation_out_delay']['size'] ) ? $settings['animation_out_delay']['size'] : 50;
		$out_ani_speed     = ! empty( $settings['animation_out_duration']['size'] ) ? $settings['animation_out_duration']['size'] : 50;
		$animation_effects = ! empty( $settings['animation_effects'] ) ? $settings['animation_effects'] : '';
		$animation_delay   = ! empty( $settings['animation_delay']['size'] ) ? $settings['animation_delay']['size'] : 50;
		$custom_attributes = ! empty( $settings['custom_attributes'] ) ? $settings['custom_attributes'] : '';

		$button_custom_attributes = ! empty( $settings['button_custom_attributes'] ) ? $settings['button_custom_attributes'] : '';

		if ( 'yes' === $btn_sp_effect ) {
			$effect_rand_no = uniqid( 'reveal' );
			$color_1        = ! empty( $settings['plus_overlay_spcial_effect_color_1'] ) ? $settings['plus_overlay_spcial_effect_color_1'] : '#313131';
			$color_2        = ! empty( $settings['plus_overlay_spcial_effect_color_2'] ) ? $settings['plus_overlay_spcial_effect_color_2'] : '#ff214f';
			$effect_attr   .= ' data-reveal-id="' . esc_attr( $effect_rand_no ) . '" ';
			$effect_attr   .= ' data-effect-color-1="' . esc_attr( $color_1 ) . '" ';
			$effect_attr   .= ' data-effect-color-2="' . esc_attr( $color_2 ) . '" ';
			$reveal_effects = ' pt-plus-reveal ' . esc_attr( $effect_rand_no ) . ' ';
		}

		$move_parallax      = '';
		$move_parallax_attr = '';
		$parallax_move      = '';

		if ( 'yes' === $plus_mouse ) {
			$move_parallax       = 'pt-plus-move-parallax';
			$parallax_move       = 'parallax-move';
			$parallax_speed_x    = isset( $settings['plus_mouse_parallax_speed_x']['size'] ) ? $settings['plus_mouse_parallax_speed_x']['size'] : 30;
			$parallax_speed_y    = isset( $settings['plus_mouse_parallax_speed_y']['size'] ) ? $settings['plus_mouse_parallax_speed_y']['size'] : 30;
			$move_parallax_attr .= ' data-move_speed_x="' . esc_attr( $parallax_speed_x ) . '" ';
			$move_parallax_attr .= ' data-move_speed_y="' . esc_attr( $parallax_speed_y ) . '" ';
		}

		$hover_class = '';
		$hover_attr  = '';

		$hover_uniqid = uniqid( 'hover-effect' );

		if ( 'float_shadow' === $btn_hover || 'grow_shadow' === $btn_hover || 'shadow_radial' === $btn_hover ) {
			$hover_attr .= 'data-hover_uniqid="' . esc_attr( $hover_uniqid ) . '" ';
			$hover_attr .= ' data-hover_shadow="' . esc_attr( $settings['hover_shadow_color'] ) . '" ';
			$hover_attr .= ' data-content_hover_effects="' . esc_attr( $btn_hover ) . '" ';
		}

		if ( 'grow' === $btn_hover ) {
			$hover_class .= 'content_hover_grow';
		} elseif ( 'push' === $btn_hover ) {
			$hover_class .= 'content_hover_push';
		} elseif ( 'bounce-in' === $btn_hover ) {
			$hover_class .= 'content_hover_bounce_in';
		} elseif ( 'float' === $btn_hover ) {
			$hover_class .= 'content_hover_float';
		} elseif ( 'wobble_horizontal' === $btn_hover ) {
			$hover_class .= 'content_hover_wobble_horizontal';
		} elseif ( 'wobble_vertical' === $btn_hover ) {
			$hover_class .= 'content_hover_wobble_vertical';
		} elseif ( 'float_shadow' === $btn_hover ) {
			$hover_class .= ' ' . esc_attr( $hover_uniqid ) . ' content_hover_float_shadow';
		} elseif ( 'grow_shadow' === $btn_hover ) {
			$hover_class .= ' ' . esc_attr( $hover_uniqid ) . ' content_hover_grow_shadow';
		} elseif ( 'shadow_radial' === $btn_hover ) {
			$hover_class .= '' . esc_attr( $hover_uniqid ) . ' content_hover_radial';
		}

		if ( ! empty( $btn_link ) ) {
			$btx_link = ! empty( $settings['button_link'] ) ? $settings['button_link'] : '';
			$this->add_link_attributes( 'button', $btx_link );
		}

		if ( ! empty( 'yes' === $shake_ani ) ) {
			$this->add_render_attribute( 'button', 'class', 'button-link-wrap shake_animate ' . $lz1 );
		} else {
			$this->add_render_attribute( 'button', 'class', 'button-link-wrap ' . $lz1 );
		}

		$this->add_render_attribute( 'button', 'role', 'button' );

		if ( ! empty( $btn_id ) ) {
			$this->add_render_attribute( 'button', 'id', $btn_id );
		}

		if ( ! empty( $hover_text ) ) {
			$this->add_render_attribute( 'button', 'data-hover', $hover_text );
		} else {
			$this->add_render_attribute( 'button', 'data-hover', $btn_text );
		}

		$button_style = ! empty( $settings['button_style'] ) ? $settings['button_style'] : 'style-1';
		$button_align = ' text-' . ( ! empty( $settings['button_align'] ) ? $settings['button_align'] : '' );

		$button_align .= ! empty( $settings['button_align_tablet'] ) ? ' text--tablet' . $settings['button_align_tablet'] : '';
		$button_align .= ! empty( $settings['button_align_mobile'] ) ? ' text--mobile' . $settings['button_align_mobile'] : '';

		$btn_hover_style   = ! empty( $settings['btn_hover_style'] ) ? $settings['btn_hover_style'] : 'hover-left';
		$icon_hover_style  = ! empty( $settings['icon_hover_style'] ) ? $settings['icon_hover_style'] : 'hover-top';
		$button_text       = $btn_text;
		$button_hover_text = $hover_text;

		$uid        = uniqid( 'btn' );
		$data_class = $uid;

		$data_class .= ' button-' . $button_style . ' ';

		if ( 'style-11' === $button_style || 'style-13' === $button_style ) {
			$data_class .= ' ' . $btn_hover_style . ' ';
		}
		if ( 'style-17' === $button_style ) {
			$data_class .= ' ' . $icon_hover_style . ' ';
		}

		if ( 'yes' === $full_width_btn ) {
			$data_class       .= ' full-button ';
			$full_button_width = ' full-button ';
		}

		$continuous_animation = '';

		if ( 'yes' === $coni_ani ) {
			if ( 'yes' === $hover_ani ) {
				$animation_class = 'hover_';
			} else {
				$animation_class = 'image-';
			}
			$continuous_animation = $animation_class . $plus_ani;
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
				$animation_attr .= ' data-animate-duration="' . esc_attr( $animate_duration ) . '"';
			}
			if ( 'no-animation' !== $out_ani_effects ) {
				$animation_attr .= ' data-animate-out-type="' . esc_attr( $out_ani_effects ) . '" data-animate-out-delay="' . esc_attr( $out_ani_delay ) . '"';
				if ( 'yes' === $out_default_ani ) {
					$animation_attr .= ' data-animate-out-duration="' . esc_attr( $out_ani_speed ) . '"';
				}
			}
		}
		$uid_button = uniqid( 'button' );

		$cst_att = '';
		if ( 'yes' === $button_custom_attributes && ! empty( $custom_attributes ) ) {
			$cst_att = $custom_attributes;
		}

		$the_button = '<div class="pt-plus-button-wrapper  ' . esc_attr( $button_align ) . ' ">';

			$the_button .= '<div class="button_parallax ' . esc_attr( $full_button_width ) . '">';

				$the_button .= '<div id="' . esc_attr( $uid_button ) . '"  class="' . esc_attr( $button_align ) . ' ts-button content_hover_effect ' . esc_attr( $hover_class ) . ' ' . esc_attr( $full_button_width ) . '" ' . $hover_attr . '>';

					$the_button .= '<div class="pt_plus_button ' . esc_attr( $data_class ) . ' ' . esc_attr( $animated_class ) . ' ' . $reveal_effects . '" ' . $effect_attr . ' ' . $animation_attr . '>';

						$the_button .= '<div class="animted-content-inner ' . esc_attr( $continuous_animation ) . '">';

							$the_button .= '<a ' . $this->get_render_attribute_string( 'button' ) . ' ' . tp_senitize_js_input( $cst_att ) . ' >';

							$the_button .= $this->render_text();

							$the_button .= '</a>';

						$the_button .= '</div>';

					$the_button .= '</div>';

				$the_button .= '</div>';

			$the_button .= '</div>';

		$the_button .= '</div>';

		echo $the_button;
	}

	/**
	 * Render Text
	 *
	 * @since 1.0.0
	 *
	 * @version 5.4.2
	 */
	protected function render_text() {
		$icons_after   = '';
		$icons_before  = '';
		$button_text   = '';
		$style_content = '';

		$settings     = $this->get_settings_for_display();
		$button_style = ! empty( $settings['button_style'] ) ? $settings['button_style'] : 'style-1';
		$before_after = ! empty( $settings['before_after'] ) ? $settings['before_after'] : '';
		$button_text  = ! empty( $settings['button_text'] ) ? $settings['button_text'] : '';
		$icon_style   = ! empty( $settings['button_icon_style'] ) ? $settings['button_icon_style'] : 'font_awesome';

		$icons = '';

		$btn_icon = ! empty( $settings['button_icon'] ) ? $settings['button_icon'] : '';
		if ( 'font_awesome' === $icon_style ) {
			$icons = $btn_icon;
		} elseif ( 'font_awesome_5' === $icon_style ) {

			$btn_i5 = ! empty( $settings['button_icon_5'] ) ? $settings['button_icon_5'] : '';
			ob_start();
			\Elementor\Icons_Manager::render_icon( $btn_i5, array( 'aria-hidden' => 'true' ) );
			$icons = ob_get_contents();
			ob_end_clean();
		}

		if ( 'before' === $before_after && ! empty( $icons ) ) {

			if ( 'font_awesome_5' === $icon_style ) {

				$icons_before = '<span class="btn-icon button-before">' . $icons . '</span>';
			} else {
				$icons_before = '<i class="btn-icon button-before ' . esc_attr( $icons ) . '"></i>';
			}
		}
		if ( 'after' === $before_after && ! empty( $icons ) ) {

			if ( 'font_awesome_5' === $icon_style ) {
				$icons_after = '<span class="btn-icon button-after">' . $icons . '</span>';
			} else {
				$icons_after = '<i class="btn-icon button-after ' . esc_attr( $icons ) . '"></i>';
			}
		}

		if ( 'style-1' === $button_style ) {
			$button_text   = $icons_before . esc_html( $button_text ) . $icons_after;
			$style_content = '<div class="button_line"></div>';
		}

		if ( 'style-2' === $button_style || 'style-5' === $button_style || 'style-8' === $button_style || 'style-10' === $button_style ) {
			$button_text = $icons_before . esc_html( $button_text ) . $icons_after;
		}

		if ( 'style-3' === $button_style ) {
			$button_text = esc_html( $button_text ) . '<svg class="arrow" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="48" height="9" viewBox="0 0 48 9"><path d="M48.000,4.243 L43.757,8.485 L43.757,5.000 L0.000,5.000 L0.000,4.000 L43.757,4.000 L43.757,0.000 L48.000,4.243 Z" class="cls-1"></path></svg><svg class="arrow-1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="48" height="9" viewBox="0 0 48 9"><path d="M48.000,4.243 L43.757,8.485 L43.757,5.000 L0.000,5.000 L0.000,4.000 L43.757,4.000 L43.757,0.000 L48.000,4.243 Z" class="cls-1"></path></svg>';
		}

		if ( 'style-4' === $button_style ) {
			$button_text = $icons_before . esc_html( $button_text ) . $icons_after;
		}

		if ( 'style-6' === $button_style ) {
			$button_text = esc_html( $button_text );
		}

		if ( 'style-7' === $button_style ) {
			$button_text = esc_html( $button_text ) . '<span class="btn-arrow"></span>';
		}

		if ( 'style-9' === $button_style ) {
			$button_text = esc_html( $button_text ) . '<span class="btn-arrow"><i class="fa-show fas fa-chevron-right" aria-hidden="true"></i><i class="fa-hide fas fa-chevron-right" aria-hidden="true"></i></span>';
		}

		if ( 'style-11' === $button_style ) {
			$button_text = '<span>' . $icons_before . esc_html( $button_text ) . $icons_after . '</span>';
		}

		if ( 'style-12' === $button_style || 'style-15' === $button_style || 'style-16' === $button_style ) {
			$button_text = '<span>' . $icons_before . esc_html( $button_text ) . $icons_after . '</span>';
		}

		if ( 'style-13' === $button_style ) {
			$button_text = '<span>' . $icons_before . esc_html( $button_text ) . $icons_after . '</span>';
		}

		if ( 'style-14' === $button_style ) {
			$button_text = '<span>' . $icons_before . esc_html( $button_text ) . $icons_after . '</span>';
		}

		if ( 'style-17' === $button_style ) {
			if ( 'font_awesome_5' === $icon_style ) {
				ob_start();
				\Elementor\Icons_Manager::render_icon( $settings['button_icon_5'], array( 'aria-hidden' => 'true' ) );
				$icons = ob_get_contents();
				ob_end_clean();
				$icons_before = '<span class="btn-icon button-after">' . $icons . '</span>';
			} else {
				$icons_before = '<i class="btn-icon button-after ' . esc_attr( $icons ) . '"></i>';
			}
			$button_text = $icons_before . '<span>' . esc_html( $button_text ) . '</span>';
		}

		if ( 'style-18' === $button_style || 'style-19' === $button_style || 'style-20' === $button_style || 'style-21' === $button_style || 'style-22' === $button_style ) {
			$button_text = $icons_before . '<span>' . esc_html( $button_text ) . '</span>' . $icons_after;
		}

		$button_24_text = ! empty( $settings['button_24_text'] ) ? $settings['button_24_text'] : '';

		if ( 'style-24' === $button_style ) {
			$button_24_tag = '';

			if ( ! empty( $button_24_text ) ) {
				$button_24_tag = '<span class="button-tag-hint">' . esc_html( $button_24_text ) . '</span>';
			}
			$button_text = $icons_before . '<span>' . $button_24_tag . esc_html( $button_text ) . '</span>' . $icons_after;
		}

		return $button_text . $style_content;
	}
}
