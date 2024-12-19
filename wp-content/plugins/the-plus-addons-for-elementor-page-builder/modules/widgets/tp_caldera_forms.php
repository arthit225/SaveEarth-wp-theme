<?php
/**
 * Widget Name: Caldera Forms
 * Description: Third party plugin Caldera Forms style.
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
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class L_ThePlus_Caldera_Forms
 */
class L_ThePlus_Caldera_Forms extends Widget_Base {

	/**
	 * Get Widget Name.
	 *
	 * @since 1.0.0
	 */
	public function get_name() {
		return 'tp-caldera-forms';
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
	 */
	public function get_title() {
		return esc_html__( 'Caldera Forms', 'tpebl' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'fa fa-envelope-open theplus_backend_icon';
	}

	/**
	 * Get Widget categories.
	 *
	 * @since 1.0.0
	 */
	public function get_categories() {
		return array( 'plus-adapted' );
	}

	/**
	 * Get Widget keywords.
	 *
	 * @since 1.0.0
	 */
	public function get_keywords() {
		return array( 'Caldera Forms', 'Form builder', 'Form creator', 'Contact form', 'WordPress form', 'Form plugin', 'Form widget', 'Form generator', 'Drag and drop form', 'Form element', 'Elementor form', 'Plus Addons form', 'Caldera form widget' );
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
	 *
	 * @version 5.4.2
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Caldera Forms', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'caldera_forms',
			array(
				'label'   => esc_html__( 'Select Form', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '0',
				'options' => $this->l_theplus_caldera_forms(),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_s_label',
			array(
				'label' => esc_html__( 'Label', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'label_padding',
			array(
				'label'      => esc_html__( 'Inner Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_caldera_forms .control-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'label_margin',
			array(
				'label'      => esc_html__( 'Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_caldera_forms .control-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'label_typography',
				'selector' => '{{WRAPPER}} .pt_plus_caldera_forms .control-label',
			)
		);
		$this->add_control(
			'label_color',
			array(
				'label'     => esc_html__( 'Label', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_caldera_forms .control-label' => 'color: {{VALUE}}',
					'separator' => 'after',
				),
			)
		);
		$this->add_control(
			'inline_help_label_color',
			array(
				'label'     => esc_html__( 'Inline/Description Text', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_caldera_forms .help-block' => 'color: {{VALUE}}',
					'separator' => 'after',
				),
			)
		);
		$this->add_control(
			'req_symbol_color',
			array(
				'label'     => esc_html__( 'Required Symbol', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_caldera_forms .caldera-grid .field_required' => 'color: {{VALUE}} !important',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_input',
			array(
				'label' => esc_html__( 'Input Fields Styling', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'input_typography',
				'selector' => '{{WRAPPER}} .pt_plus_caldera_forms input[type="text"],
				{{WRAPPER}} .pt_plus_caldera_forms input[type="email"],
				{{WRAPPER}} .pt_plus_caldera_forms input[type="number"],
				{{WRAPPER}} .pt_plus_caldera_forms input[type=tel],
				{{WRAPPER}} .pt_plus_caldera_forms input[type=credit_card_cvc],
				{{WRAPPER}} .pt_plus_caldera_forms input[type=phone],
				{{WRAPPER}} .pt_plus_caldera_forms input[type=url],
				{{WRAPPER}} .pt_plus_caldera_forms input[type=color_picker],
				{{WRAPPER}} .pt_plus_caldera_forms input[type=date],
				{{WRAPPER}} .pt_plus_caldera_forms select.form-control',
			)
		);
		$this->add_control(
			'input_placeholder_color',
			array(
				'label'     => esc_html__( 'Placeholder Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_caldera_forms input::-webkit-input-placeholder,
					{{WRAPPER}} .pt_plus_caldera_forms  email::-webkit-input-placeholder,
					{{WRAPPER}} .pt_plus_caldera_forms  number::-webkit-input-placeholder,
					{{WRAPPER}} .pt_plus_caldera_forms  select::-webkit-input-placeholder' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_responsive_control(
			'input_inner_padding',
			array(
				'label'      => esc_html__( 'Inner Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_caldera_forms input[type="text"],
				{{WRAPPER}} .pt_plus_caldera_forms input[type="email"],
				{{WRAPPER}} .pt_plus_caldera_forms input[type="number"],
				{{WRAPPER}} .pt_plus_caldera_forms input[type="tel"],
				{{WRAPPER}} .pt_plus_caldera_forms input[type="credit_card_cvc"],
				{{WRAPPER}} .pt_plus_caldera_forms input[type="phone"],
				{{WRAPPER}} .pt_plus_caldera_forms input[type="url"],
				{{WRAPPER}} .pt_plus_caldera_forms input[type="color_picker"],
				{{WRAPPER}} .pt_plus_caldera_forms input[type="date"],
				{{WRAPPER}} .pt_plus_caldera_forms select.form-control,
				{{WRAPPER}} .pt_plus_caldera_forms .help-block,
				{{WRAPPER}} .pt_plus_caldera_forms .flag-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'input_inner_margin',
			array(
				'label'      => esc_html__( 'Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_caldera_forms input[type="text"],
				{{WRAPPER}} .pt_plus_caldera_forms input[type="email"],
				{{WRAPPER}} .pt_plus_caldera_forms input[type="number"],
				{{WRAPPER}} .pt_plus_caldera_forms input[type="tel"],
				{{WRAPPER}} .pt_plus_caldera_forms input[type="credit_card_cvc"],
				{{WRAPPER}} .pt_plus_caldera_forms input[type="phone"],
				{{WRAPPER}} .pt_plus_caldera_forms input[type="url"],
				{{WRAPPER}} .pt_plus_caldera_forms input[type="color_picker"],
				{{WRAPPER}} .pt_plus_caldera_forms input[type="date"],
				{{WRAPPER}} .pt_plus_caldera_forms select.form-control,
				{{WRAPPER}} .pt_plus_caldera_forms .help-block' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->start_controls_tabs( 'tabs_input_field_style' );
		$this->start_controls_tab(
			'tab_input_field_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'input_field_color',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_caldera_forms input[type="text"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="email"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="number"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="tel"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="credit_card_cvc"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="phone"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="url"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="color_picker"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="date"],
					{{WRAPPER}} .pt_plus_caldera_forms select.form-control,
					{{WRAPPER}} .pt_plus_caldera_forms .flag-container' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'input_field_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .pt_plus_caldera_forms input[type="text"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="email"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="number"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="tel"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="credit_card_cvc"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="phone"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="url"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="color_picker"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="date"],
					{{WRAPPER}} .pt_plus_caldera_forms select.form-control,
					{{WRAPPER}} .pt_plus_caldera_forms .flag-container',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_input_field_focus',
			array(
				'label' => esc_html__( 'Focus', 'tpebl' ),
			)
		);
		$this->add_control(
			'input_field_focus_color',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_caldera_forms input[type="text"]:focus,
					{{WRAPPER}} .pt_plus_caldera_forms input[type="email"]:focus,
					{{WRAPPER}} .pt_plus_caldera_forms input[type="number"]:focus,
					{{WRAPPER}} .pt_plus_caldera_forms input[type="tel"]:focus,
					{{WRAPPER}} .pt_plus_caldera_forms input[type="credit_card_cvc"]:focus,
					{{WRAPPER}} .pt_plus_caldera_forms input[type="phone"]:focus,
					{{WRAPPER}} .pt_plus_caldera_forms input[type="url"]:focus,
					{{WRAPPER}} .pt_plus_caldera_forms input[type="color_picker"]:focus,
					{{WRAPPER}} .pt_plus_caldera_forms input[type="date"]:focus,
					{{WRAPPER}} .pt_plus_caldera_forms select:focus.form-control,
					{{WRAPPER}} .pt_plus_caldera_forms .flag-container:focus' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'input_field_focus_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .pt_plus_caldera_forms input[type="text"]:focus,
					{{WRAPPER}} .pt_plus_caldera_forms input[type="email"]:focus,
					{{WRAPPER}} .pt_plus_caldera_forms input[type="number"]:focus,
					{{WRAPPER}} .pt_plus_caldera_forms input[type="tel"]:focus,
					{{WRAPPER}} .pt_plus_caldera_forms input[type="credit_card_cvc"]:focus,
					{{WRAPPER}} .pt_plus_caldera_forms input[type="phone"]:focus,
					{{WRAPPER}} .pt_plus_caldera_forms input[type="url"]:focus,
					{{WRAPPER}} .pt_plus_caldera_forms input[type="color_picker"]:focus,
					{{WRAPPER}} .pt_plus_caldera_forms input[type="date"]:focus,
					{{WRAPPER}} .pt_plus_caldera_forms select:focus.form-control,
					{{WRAPPER}} .pt_plus_caldera_forms .flag-container:focus',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'input_border_options',
			array(
				'label'     => esc_html__( 'Border Options', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
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
					'{{WRAPPER}} .pt_plus_caldera_forms input[type="text"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="email"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="number"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="tel"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="credit_card_cvc"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="phone"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="url"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="color_picker"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="date"],
					{{WRAPPER}} .pt_plus_caldera_forms select.form-control,
					{{WRAPPER}} .pt_plus_caldera_forms .flag-container' => 'border-style: {{VALUE}};',
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
					'{{WRAPPER}} .pt_plus_caldera_forms input[type="text"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="email"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="number"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="tel"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="credit_card_cvc"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="phone"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="url"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="color_picker"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="date"],
					{{WRAPPER}} .pt_plus_caldera_forms select.form-control,
					{{WRAPPER}} .pt_plus_caldera_forms .flag-container' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .pt_plus_caldera_forms input[type="text"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="email"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="number"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="tel"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="credit_card_cvc"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="phone"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="url"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="color_picker"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="date"],
					{{WRAPPER}} .pt_plus_caldera_forms select.form-control,
					{{WRAPPER}} .pt_plus_caldera_forms .flag-container' => 'border-color: {{VALUE}};',
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
					'{{WRAPPER}} .pt_plus_caldera_forms input[type="text"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="email"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="number"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="tel"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="credit_card_cvc"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="phone"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="url"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="color_picker"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="date"],
					{{WRAPPER}} .pt_plus_caldera_forms select.form-control,
					{{WRAPPER}} .pt_plus_caldera_forms .flag-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'label'     => esc_html__( 'Focus', 'tpebl' ),
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
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_caldera_forms input[type="text"]:focus,
					{{WRAPPER}} .pt_plus_caldera_forms input[type="email"]:focus,
					{{WRAPPER}} .pt_plus_caldera_forms input[type="number"]:focus,
					{{WRAPPER}} .pt_plus_caldera_forms input[type="tel"]:focus,
					{{WRAPPER}} .pt_plus_caldera_forms input[type="credit_card_cvc"]:focus,
					{{WRAPPER}} .pt_plus_caldera_forms input[type="phone"]:focus,
					{{WRAPPER}} .pt_plus_caldera_forms input[type="url"]:focus,
					{{WRAPPER}} .pt_plus_caldera_forms input[type="color_picker"]:focus,
					{{WRAPPER}} .pt_plus_caldera_forms input[type="date"]:focus,
					{{WRAPPER}} .pt_plus_caldera_forms select:focus.form-control,
					{{WRAPPER}} .pt_plus_caldera_forms .flag-container:focus' => 'border-color: {{VALUE}};',
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
					'{{WRAPPER}} .pt_plus_caldera_forms input[type="text"]:focus,
					{{WRAPPER}} .pt_plus_caldera_forms input[type="email"]:focus,
					{{WRAPPER}} .pt_plus_caldera_forms input[type="number"]:focus,
					{{WRAPPER}} .pt_plus_caldera_forms input[type="tel"]:focus,
					{{WRAPPER}} .pt_plus_caldera_forms input[type="credit_card_cvc"]:focus,
					{{WRAPPER}} .pt_plus_caldera_forms input[type="phone"]:focus,
					{{WRAPPER}} .pt_plus_caldera_forms input[type="url"]:focus,
					{{WRAPPER}} .pt_plus_caldera_forms input[type="color_picker"]:focus,
					{{WRAPPER}} .pt_plus_caldera_forms input[type="date"]:focus,
					{{WRAPPER}} .pt_plus_caldera_forms select:focus.form-control,
					{{WRAPPER}} .pt_plus_caldera_forms .flag-container:focus' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'box_border' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'shadow_options',
			array(
				'label'     => esc_html__( 'Box Shadow Options', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->start_controls_tabs( 'tabs_shadow_style' );
		$this->start_controls_tab(
			'tab_shadow_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'box_shadow',
				'selector' => '{{WRAPPER}} .pt_plus_caldera_forms input[type="text"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="email"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="number"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="tel"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="credit_card_cvc"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="phone"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="url"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="color_picker"],
					{{WRAPPER}} .pt_plus_caldera_forms input[type="date"],
					{{WRAPPER}} .pt_plus_caldera_forms select.form-control,
					{{WRAPPER}} .pt_plus_caldera_forms .flag-container',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_shadow_hover',
			array(
				'label' => esc_html__( 'Focus', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'box_active_shadow',
				'selector' => '{{WRAPPER}} .pt_plus_caldera_forms input[type="text"]:focus,
					{{WRAPPER}} .pt_plus_caldera_forms input[type="email"]:focus,
					{{WRAPPER}} .pt_plus_caldera_forms input[type="number"]:focus,
					{{WRAPPER}} .pt_plus_caldera_forms input[type="tel"]:focus,
					{{WRAPPER}} .pt_plus_caldera_forms input[type="credit_card_cvc"]:focus,
					{{WRAPPER}} .pt_plus_caldera_forms input[type="phone"]:focus,
					{{WRAPPER}} .pt_plus_caldera_forms input[type="url"]:focus,
					{{WRAPPER}} .pt_plus_caldera_forms input[type="color_picker"]:focus,
					{{WRAPPER}} .pt_plus_caldera_forms input[type="date"]:focus,
					{{WRAPPER}} .pt_plus_caldera_forms select:focus.form-control,
					{{WRAPPER}} .pt_plus_caldera_forms .flag-container:focus',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_textarea',
			array(
				'label' => esc_html__( 'Textarea Fields Styling', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'textarea_inner_padding',
			array(
				'label'      => esc_html__( 'Inner Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_caldera_forms textarea.form-control' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'textarea_inner_margin',
			array(
				'label'      => esc_html__( 'Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_caldera_forms textarea.form-control' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'textarea_typography',
				'selector' => '{{WRAPPER}} .pt_plus_caldera_forms textarea.form-control',
			)
		);
		$this->add_control(
			'textarea_placeholder_color',
			array(
				'label'     => esc_html__( 'Placeholder Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_caldera_forms  textarea::-webkit-input-placeholder' => 'color: {{VALUE}};',
				),
			)
		);
			$this->start_controls_tabs( 'tabs_textarea_field_style' );
				$this->start_controls_tab(
					'tab_textarea_field_normal',
					array(
						'label' => esc_html__( 'Normal', 'tpebl' ),
					)
				);
				$this->add_control(
					'textarea_field_color',
					array(
						'label'     => esc_html__( 'Text Color', 'tpebl' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							'{{WRAPPER}} .pt_plus_caldera_forms textarea.form-control' => 'color: {{VALUE}};',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Background::get_type(),
					array(
						'name'     => 'textarea_field_bg',
						'types'    => array( 'classic', 'gradient' ),
						'selector' => '{{WRAPPER}} .pt_plus_caldera_forms textarea.form-control',
					)
				);
				$this->end_controls_tab();

				$this->start_controls_tab(
					'tab_textarea_field_focus',
					array(
						'label' => esc_html__( 'Focus', 'tpebl' ),
					)
				);
				$this->add_control(
					'textarea_field_focus_color',
					array(
						'label'     => esc_html__( 'Text Color', 'tpebl' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							'{{WRAPPER}} .pt_plus_caldera_forms textarea:focus.form-control' => 'color: {{VALUE}};',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Background::get_type(),
					array(
						'name'     => 'textarea_field_focus_bg',
						'types'    => array( 'classic', 'gradient' ),
						'selector' => '{{WRAPPER}} .pt_plus_caldera_forms textarea:focus.form-control',
					)
				);
				$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'textarea_border_options',
			array(
				'label'     => esc_html__( 'Border Options', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'ta_box_border',
			array(
				'label'     => esc_html__( 'Box Border', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'ta_border_style',
			array(
				'label'     => esc_html__( 'Border Style', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'solid',
				'options'   => l_theplus_get_border_style(),
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_caldera_forms textarea.form-control' => 'border-style: {{VALUE}};',
				),
				'condition' => array(
					'ta_box_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'ta_box_border_width',
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
					'{{WRAPPER}} .pt_plus_caldera_forms textarea.form-control' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'ta_box_border' => 'yes',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_ta_border_style' );
				$this->start_controls_tab(
					'tab_ta_border_normal',
					array(
						'label'     => esc_html__( 'Normal', 'tpebl' ),
						'condition' => array(
							'ta_box_border' => 'yes',
						),
					)
				);
				$this->add_control(
					'ta_box_border_color',
					array(
						'label'     => esc_html__( 'Border Color', 'tpebl' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							'{{WRAPPER}} .pt_plus_caldera_forms textarea.form-control' => 'border-color: {{VALUE}};',
						),
						'condition' => array(
							'ta_box_border' => 'yes',
						),
					)
				);
				$this->add_responsive_control(
					'ta_border_radius',
					array(
						'label'      => esc_html__( 'Border Radius', 'tpebl' ),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => array( 'px', '%' ),
						'selectors'  => array(
							'{{WRAPPER}} .pt_plus_caldera_forms textarea.form-control' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						),
						'condition'  => array(
							'ta_box_border' => 'yes',
						),
					)
				);
				$this->end_controls_tab();

				$this->start_controls_tab(
					'tab_ta_border_hover',
					array(
						'label'     => esc_html__( 'Focus', 'tpebl' ),
						'condition' => array(
							'ta_box_border' => 'yes',
						),
					)
				);
				$this->add_control(
					'ta_box_border_hover_color',
					array(
						'label'     => esc_html__( 'Border Color', 'tpebl' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '',
						'selectors' => array(
							'{{WRAPPER}} .pt_plus_caldera_forms textarea:focus.form-control' => 'border-color: {{VALUE}};',
						),
						'condition' => array(
							'ta_box_border' => 'yes',
						),
					)
				);
				$this->add_responsive_control(
					'ta_border_hover_radius',
					array(
						'label'      => esc_html__( 'Border Radius', 'tpebl' ),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => array( 'px', '%' ),
						'selectors'  => array(
							'{{WRAPPER}} .pt_plus_caldera_forms textarea:focus.form-control' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						),
						'condition'  => array(
							'ta_box_border' => 'yes',
						),
					)
				);
				$this->end_controls_tab();
				$this->end_controls_tabs();
				$this->add_control(
					'ta_shadow_options',
					array(
						'label'     => esc_html__( 'Box Shadow Options', 'tpebl' ),
						'type'      => Controls_Manager::HEADING,
						'separator' => 'before',
					)
				);
		$this->start_controls_tabs( 'tabs_ta_shadow_style' );
		$this->start_controls_tab(
			'tab_ta_shadow_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'ta_box_shadow',
				'selector' => '{{WRAPPER}} .pt_plus_caldera_forms textarea.form-control',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_ta_shadow_hover',
			array(
				'label' => esc_html__( 'Focus', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'ta_box_active_shadow',
				'selector' => '{{WRAPPER}} .pt_plus_caldera_forms textarea:focus.form-control',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_checked_styling',
			array(
				'label' => esc_html__( 'CheckBox/Radio Field', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->start_controls_tabs( 'tabs_checkbox_field_style' );
		$this->start_controls_tab(
			'tab_unchecked_field_bg',
			array(
				'label' => esc_html__( 'Check Box', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'checkbox_text_typography',
				'selector' => '{{WRAPPER}} .caldera-grid .checkbox label,{{WRAPPER}} .caldera-grid .checkbox-inline',
			)
		);
		$this->add_control(
			'checked_field_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .caldera-grid .checkbox label,{{WRAPPER}} .caldera-grid .checkbox-inline' => 'color: {{VALUE}};',
				),
				'separator' => 'after',
			)
		);
		$this->add_responsive_control(
			'checkbox_typography',
			array(
				'label'      => esc_html__( 'Icon Size', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 5,
						'max' => 50,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} span.caldera_checkbox_label:before' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'checked_uncheck_color',
			array(
				'label'     => esc_html__( 'UnChecked Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_caldera_forms .checkbox label .caldera_checkbox_label:before' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'checked_field_color',
			array(
				'label'     => esc_html__( 'Checked Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .caldera-grid .checkbox input[type=checkbox]:checked + .caldera_checkbox_label:before' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'unchecked_field_bgcolor',
			array(
				'label'     => esc_html__( 'UnChecked Bg Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_caldera_forms .checkbox label .caldera_checkbox_label' => 'background: {{VALUE}};',
				),
				'separator' => 'before',
			)
		);
		$this->add_control(
			'checked_field_bgcolor',
			array(
				'label'     => esc_html__( 'Checked Bg Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .caldera-grid .checkbox input[type=checkbox]:checked + .caldera_checkbox_label' => 'background: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'check_box_border_options',
			array(
				'label'     => esc_html__( 'Border Options', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'check_box_border',
			array(
				'label'     => esc_html__( 'Box Border', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'default'   => 'no',
			)
		);

		$this->add_control(
			'check_box_border_style',
			array(
				'label'     => esc_html__( 'Border Style', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'solid',
				'options'   => l_theplus_get_border_style(),
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_caldera_forms .checkbox label .caldera_checkbox_label' => 'border-style: {{VALUE}};',
				),
				'condition' => array(
					'check_box_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'check_box_border_width',
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
					'{{WRAPPER}} .pt_plus_caldera_forms .checkbox label .caldera_checkbox_label' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'check_box_border' => 'yes',
				),
			)
		);
		$this->add_control(
			'unchecked_box_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_caldera_forms .checkbox label .caldera_checkbox_label' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'check_box_border' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'unchecked_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_caldera_forms .checkbox label .caldera_checkbox_label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'check_box_border' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_checked_field_bg',
			array(
				'label' => esc_html__( 'Radio Button', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'radio_text_typography',
				'selector' => '{{WRAPPER}} .caldera-grid .radio label,{{WRAPPER}} .caldera-grid .radio-inline',
			)
		);
		$this->add_control(
			'radio_field_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .caldera-grid .radio label,{{WRAPPER}} .caldera-grid .radio-inline' => 'color: {{VALUE}};',
				),
				'separator' => 'after',
			)
		);
			$this->add_responsive_control(
				'radio_typography',
				array(
					'label'      => esc_html__( 'Icon Size', 'tpebl' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => array( 'px' ),
					'range'      => array(
						'px' => array(
							'min' => 5,
							'max' => 50,
						),
					),
					'selectors'  => array(
						'{{WRAPPER}} span.caldera_radio_label:before' => 'font-size: {{SIZE}}{{UNIT}};',
					),
				)
			);
		$this->add_control(
			'radio_uncheck_color',
			array(
				'label'     => esc_html__( 'UnChecked Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_caldera_forms .radio label .caldera_radio_label:before' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'radio_field_color',
			array(
				'label'     => esc_html__( 'Checked Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .caldera-grid .radio input[type=radio]:checked + .caldera_radio_label:before' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'radio_unchecked_field_bgcolor',
			array(
				'label'     => esc_html__( 'UnChecked Bg Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_caldera_forms .radio label .caldera_radio_label' => 'background: {{VALUE}};',
				),
				'separator' => 'before',
			)
		);
		$this->add_control(
			'radio_checked_field_bgcolor',
			array(
				'label'     => esc_html__( 'Checked Bg Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .caldera-grid .radio input[type=radio]:checked + .caldera_radio_label' => 'background: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'radio_border_options',
			array(
				'label'     => esc_html__( 'Border Options', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'radio_border',
			array(
				'label'     => esc_html__( 'Box Border', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'default'   => 'no',
			)
		);

		$this->add_control(
			'radio_border_style',
			array(
				'label'     => esc_html__( 'Border Style', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'solid',
				'options'   => l_theplus_get_border_style(),
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_caldera_forms .radio label .caldera_radio_label' => 'border-style: {{VALUE}};',
				),
				'condition' => array(
					'radio_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'radio_border_width',
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
					'{{WRAPPER}} .pt_plus_caldera_forms .radio label .caldera_radio_label' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'radio_border' => 'yes',
				),
			)
		);
		$this->add_control(
			'radio_unchecked_box_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_caldera_forms .radio label .caldera_radio_label' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'radio_border' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'radio_unchecked_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_caldera_forms .radio label .caldera_radio_label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'radio_border' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_toggle_styling',
			array(
				'label' => esc_html__( 'Toggle Button', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'toggle_padding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_caldera_forms .cf-toggle-group-buttons .btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'toggle_margin',
			array(
				'label'      => esc_html__( 'Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_caldera_forms .cf-toggle-group-buttons .btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'toggle_typography',
				'selector' => '{{WRAPPER}} .pt_plus_caldera_forms .cf-toggle-group-buttons .btn',
			)
		);
		$this->start_controls_tabs( 'tabs_toggle' );
		$this->start_controls_tab(
			'tab_toggle_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			't_text_color_n',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_caldera_forms .cf-toggle-group-buttons .btn' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			't_bg_color_n',
			array(
				'label'     => esc_html__( 'Background', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_caldera_forms .cf-toggle-group-buttons .btn' => 'background: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 't_border_n',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .pt_plus_caldera_forms .cf-toggle-group-buttons .btn,{{WRAPPER}} .pt_plus_caldera_forms .cf-toggle-group-buttons .btn:hover,{{WRAPPER}} .pt_plus_caldera_forms .cf-toggle-group-buttons .btn.btn-success',
			)
		);
		$this->add_responsive_control(
			't_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_caldera_forms .cf-toggle-group-buttons .btn,{{WRAPPER}} .pt_plus_caldera_forms .cf-toggle-group-buttons .btn:hover,{{WRAPPER}} .pt_plus_caldera_forms .cf-toggle-group-buttons .btn.btn-success' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 't_box_shadow_n',
				'selector'  => '{{WRAPPER}} .pt_plus_caldera_forms .cf-toggle-group-buttons .btn',
				'separator' => 'before',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_toggle_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			't_text_color_h',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_caldera_forms .cf-toggle-group-buttons .btn:hover' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			't_bg_color_h',
			array(
				'label'     => esc_html__( 'Background', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_caldera_forms .cf-toggle-group-buttons .btn:hover' => 'background: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			't_border_color_h',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_caldera_forms .cf-toggle-group-buttons .btn:hover' => 'border-color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 't_box_shadow_h',
				'selector'  => '{{WRAPPER}} .pt_plus_caldera_forms .cf-toggle-group-buttons .btn:hover',
				'separator' => 'before',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_toggle_active',
			array(
				'label' => esc_html__( 'Active', 'tpebl' ),
			)
		);
		$this->add_control(
			't_text_color_a',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_caldera_forms .cf-toggle-group-buttons .btn.btn-success' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			't_bg_color_a',
			array(
				'label'     => esc_html__( 'Background', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_caldera_forms .cf-toggle-group-buttons .btn.btn-success' => 'background: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			't_border_color_a',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_caldera_forms .cf-toggle-group-buttons .btn.btn-success' => 'border-color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 't_box_shadow_a',
				'selector'  => '{{WRAPPER}} .pt_plus_caldera_forms .cf-toggle-group-buttons .btn.btn-success',
				'separator' => 'before',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_file_styling',
			array(
				'label' => esc_html__( 'File/Upload Field', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'file_padding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_caldera_forms input[type=file],{{WRAPPER}} .pt_plus_caldera_forms .caldera_forms_form .form-control.cf2-file .btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'file_margin',
			array(
				'label'      => esc_html__( 'Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_caldera_forms input[type=file],{{WRAPPER}} .pt_plus_caldera_forms .caldera_forms_form .form-control.cf2-file .btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'file_typography',
				'selector' => '{{WRAPPER}} .pt_plus_caldera_forms input[type=file],{{WRAPPER}} .pt_plus_caldera_forms .caldera_forms_form .form-control.cf2-file .btn',
			)
		);
		$this->start_controls_tabs( 'tabs_file_style' );
			$this->start_controls_tab(
				'tab_file_normal',
				array(
					'label' => esc_html__( 'Normal', 'tpebl' ),
				)
			);
			$this->add_control(
				'file_color',
				array(
					'label'     => esc_html__( 'Text Color', 'tpebl' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .pt_plus_caldera_forms input[type=file],{{WRAPPER}} .pt_plus_caldera_forms .caldera_forms_form .form-control.cf2-file .btn' => 'color: {{VALUE}};',
					),
				)
			);
			$this->add_control(
				'file_bg_color',
				array(
					'label'     => esc_html__( 'Background', 'tpebl' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .pt_plus_caldera_forms input[type=file],{{WRAPPER}} .pt_plus_caldera_forms .caldera_forms_form .form-control.cf2-file .btn' => 'background: {{VALUE}};',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'     => 'file_border',
					'label'    => esc_html__( 'Border', 'tpebl' ),
					'selector' => '{{WRAPPER}} .pt_plus_caldera_forms input[type=file],{{WRAPPER}} .pt_plus_caldera_forms .caldera_forms_form .form-control.cf2-file .btn',
				)
			);
			$this->add_responsive_control(
				'file_border_radius',
				array(
					'label'      => esc_html__( 'Border Radius', 'tpebl' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .pt_plus_caldera_forms input[type=file],{{WRAPPER}} .pt_plus_caldera_forms .caldera_forms_form .form-control.cf2-file .btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'     => 'file_shadow',
					'selector' => '{{WRAPPER}} .pt_plus_caldera_forms input[type=file],{{WRAPPER}} .pt_plus_caldera_forms .caldera_forms_form .form-control.cf2-file .btn',
				)
			);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'tab_file_hover',
				array(
					'label' => esc_html__( 'Hover', 'tpebl' ),
				)
			);
			$this->add_control(
				'file_color_hover',
				array(
					'label'     => esc_html__( 'Text Color', 'tpebl' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .pt_plus_caldera_forms input[type=file]:hover,{{WRAPPER}} .pt_plus_caldera_forms .caldera_forms_form .form-control.cf2-file .btn:hover' => 'color: {{VALUE}};',
					),
				)
			);
			$this->add_control(
				'file_bg_color_hover',
				array(
					'label'     => esc_html__( 'Background', 'tpebl' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .pt_plus_caldera_forms input[type=file]:hover,{{WRAPPER}} .pt_plus_caldera_forms .caldera_forms_form .form-control.cf2-file .btn:hover' => 'background: {{VALUE}};',
					),
				)
			);
			$this->add_control(
				'file_border_color_hover',
				array(
					'label'     => esc_html__( 'Border Color', 'tpebl' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .pt_plus_caldera_forms input[type=file]:hover,{{WRAPPER}} .pt_plus_caldera_forms .caldera_forms_form .form-control.cf2-file .btn:hover' => 'border-color: {{VALUE}};',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'     => 'file_hover_shadow',
					'selector' => '{{WRAPPER}} .pt_plus_caldera_forms input[type=file]:hover,{{WRAPPER}} .pt_plus_caldera_forms .caldera_forms_form .form-control.cf2-file .btn:hover',
				)
			);
			$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_sbreak_summry_styling',
			array(
				'label' => esc_html__( 'Section Break / Summary', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'sb_color',
			array(
				'label'     => esc_html__( 'Section Break Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_caldera_forms .caldera-grid hr' => 'border-color: {{VALUE}};',
				),
				'separator' => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'summry_heading_typography',
				'selector' => '{{WRAPPER}} .pt_plus_caldera_forms h2',
			)
		);
		$this->add_control(
			'summry_heading_color',
			array(
				'label'     => esc_html__( 'Summry Heading Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_caldera_forms h2' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'summry_heading_alignment',
			array(
				'label'     => esc_html__( 'Summary Heading  Alignment', 'tpebl' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
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
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_caldera_forms h2' => 'text-align: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'summry_heading_margin_bottom',
			array(
				'label'      => esc_html__( 'Bottom Space', 'tpebl' ),
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
					'{{WRAPPER}} .pt_plus_caldera_forms h2' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'summry_padding',
			array(
				'label'      => esc_html__( 'Summry Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_caldera_forms .caldera-forms-summary-field' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'c_summry_typography',
				'selector' => '{{WRAPPER}} .pt_plus_caldera_forms .caldera-forms-summary-field ul>li',
			)
		);
		$this->add_control(
			'summry_color',
			array(
				'label'     => esc_html__( 'Summry Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_caldera_forms .caldera-forms-summary-field ul>li' => 'color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_c_special_styling',
			array(
				'label' => esc_html__( 'Caldera Special', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'c_s_cal_typography',
				'selector' => '{{WRAPPER}} .pt_plus_caldera_forms .total-line',
			)
		);
		$this->add_control(
			'c_s_cal_color',
			array(
				'label'     => esc_html__( 'Calculation Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_caldera_forms .total-line' => 'color: {{VALUE}};',
				),
				'separator' => 'after',
			)
		);
		$this->add_control(
			'consent_field_head',
			array(
				'label' => esc_html__( 'Consent Field', 'tpebl' ),
				'type'  => Controls_Manager::HEADING,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'consent_typography',
				'selector' => '{{WRAPPER}} .pt_plus_caldera_forms label.caldera-forms-gdpr-field-label,{{WRAPPER}} .pt_plus_caldera_forms .caldera-forms-consent-field-linked_text',
			)
		);
		$this->add_control(
			'consent_field_color',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_caldera_forms label.caldera-forms-gdpr-field-label,{{WRAPPER}} .pt_plus_caldera_forms .caldera-forms-consent-field-linked_text' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'consent_field_p_color',
			array(
				'label'     => esc_html__( 'Privacy Hover Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_caldera_forms .caldera-forms-consent-field-linked_text:hover' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'consent_field_req_color',
			array(
				'label'     => esc_html__( '* Sign Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_caldera_forms .caldera-forms-consent-field span' => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_button_styling',
			array(
				'label' => esc_html__( 'Submit/Send Button', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'button_max_width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Width', 'tpebl' ),
				'size_units'  => array( 'px', '%' ),
				'range'       => array(
					'px' => array(
						'min'  => 100,
						'max'  => 2000,
						'step' => 5,
					),
					'%'  => array(
						'min'  => 10,
						'max'  => 100,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .pt_plus_caldera_forms input[type = submit],
					{{WRAPPER}} .pt_plus_caldera_forms input[type = button],
					{{WRAPPER}} .pt_plus_caldera_forms input[type = reset]' => 'width: {{SIZE}}{{UNIT}}',
				),
				'separator'   => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'button_typography',
				'selector' => '{{WRAPPER}} .pt_plus_caldera_forms input[type = submit],
					{{WRAPPER}} .pt_plus_caldera_forms input[type = button],
					{{WRAPPER}} .pt_plus_caldera_forms input[type = reset]',
			)
		);
		$this->add_responsive_control(
			'button_inner_padding',
			array(
				'label'      => esc_html__( 'Inner Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_caldera_forms input[type = submit],
					{{WRAPPER}} .pt_plus_caldera_forms input[type = button],
					{{WRAPPER}} .pt_plus_caldera_forms input[type = reset]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'button_margin',
			array(
				'label'      => esc_html__( 'Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_caldera_forms input[type = submit],
					{{WRAPPER}} .pt_plus_caldera_forms input[type = button],
					{{WRAPPER}} .pt_plus_caldera_forms input[type = reset]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
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
			'button_color',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_caldera_forms input[type = submit],
					{{WRAPPER}} .pt_plus_caldera_forms input[type = button],
					{{WRAPPER}} .pt_plus_caldera_forms input[type = reset]' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'button_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .pt_plus_caldera_forms input[type = submit],
					{{WRAPPER}} .pt_plus_caldera_forms input[type = button],
					{{WRAPPER}} .pt_plus_caldera_forms input[type = reset]',
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
			'button_hover_color',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_caldera_forms input[type = submit]:hover,
					{{WRAPPER}} .pt_plus_caldera_forms input[type = button]:hover,
					{{WRAPPER}} .pt_plus_caldera_forms input[type = reset]:hover' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'button_hover_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .pt_plus_caldera_forms input[type = submit]:hover,
					{{WRAPPER}} .pt_plus_caldera_forms input[type = button]:hover,
					{{WRAPPER}} .pt_plus_caldera_forms input[type = reset]:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'button_border_options',
			array(
				'label'     => esc_html__( 'Border Options', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'button_box_border',
			array(
				'label'     => esc_html__( 'Box Border', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'default'   => 'no',
			)
		);

		$this->add_control(
			'button_border_style',
			array(
				'label'     => esc_html__( 'Border Style', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'solid',
				'options'   => l_theplus_get_border_style(),
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_caldera_forms input[type = submit],
					{{WRAPPER}} .pt_plus_caldera_forms input[type = button],
					{{WRAPPER}} .pt_plus_caldera_forms input[type = reset]' => 'border-style: {{VALUE}};',
				),
				'condition' => array(
					'button_box_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'button_box_border_width',
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
					'{{WRAPPER}} .pt_plus_caldera_forms input[type = submit],
					{{WRAPPER}} .pt_plus_caldera_forms input[type = button],
					{{WRAPPER}} .pt_plus_caldera_forms input[type = reset]' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'button_box_border' => 'yes',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_button_border_style' );
		$this->start_controls_tab(
			'tab_button_border_normal',
			array(
				'label'     => esc_html__( 'Normal', 'tpebl' ),
				'condition' => array(
					'button_box_border' => 'yes',
				),
			)
		);
		$this->add_control(
			'button_box_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_caldera_forms input[type = submit],
					{{WRAPPER}} .pt_plus_caldera_forms input[type = button],
					{{WRAPPER}} .pt_plus_caldera_forms input[type = reset]' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'button_box_border' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'button_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_caldera_forms input[type = submit],
					{{WRAPPER}} .pt_plus_caldera_forms input[type = button],
					{{WRAPPER}} .pt_plus_caldera_forms input[type = reset]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
				'condition'  => array(
					'button_box_border' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_button_border_hover',
			array(
				'label'     => esc_html__( 'Hover', 'tpebl' ),
				'condition' => array(
					'button_box_border' => 'yes',
				),
			)
		);
		$this->add_control(
			'button_box_border_hover_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_caldera_forms input[type = submit]:hover,
					{{WRAPPER}} .pt_plus_caldera_forms input[type = button]:hover,
					{{WRAPPER}} .pt_plus_caldera_forms input[type = reset]:hover' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'button_box_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'button_border_hover_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_caldera_forms input[type = submit]:hover,
					{{WRAPPER}} .pt_plus_caldera_forms input[type = button]:hover,
					{{WRAPPER}} .pt_plus_caldera_forms input[type = reset]:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
				'condition'  => array(
					'button_box_border' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'button_shadow_options',
			array(
				'label'     => esc_html__( 'Box Shadow Options', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->start_controls_tabs( 'tabs_button_shadow_style' );
		$this->start_controls_tab(
			'tab_button_shadow_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'button_shadow',
				'selector' => '{{WRAPPER}} .pt_plus_caldera_forms input[type = submit],
				{{WRAPPER}} .pt_plus_caldera_forms input[type = button],
				{{WRAPPER}} .pt_plus_caldera_forms input[type = reset]',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_button_shadow_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'button_hover_shadow',
				'selector' => '{{WRAPPER}} .pt_plus_caldera_forms input[type = submit]:hover,
					{{WRAPPER}} .pt_plus_caldera_forms input[type = button]:hover,
					{{WRAPPER}} .pt_plus_caldera_forms input[type = reset]:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_oute_r_styling',
			array(
				'label' => esc_html__( 'Outer Field', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'oute_r_inner_margin',
			array(
				'label'      => esc_html__( 'Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_caldera_forms .form-group' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'oute_r_inner_padding',
			array(
				'label'      => esc_html__( 'Inner Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_caldera_forms .form-group' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->start_controls_tabs( 'tabs_oute_r' );
			$this->start_controls_tab(
				'oute_r_normal',
				array(
					'label' => esc_html__( 'Normal', 'tpebl' ),
				)
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				array(
					'name'     => 'oute_r_field_bg',
					'types'    => array( 'classic', 'gradient' ),
					'selector' => '{{WRAPPER}} .pt_plus_caldera_forms .form-group',
				)
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'     => 'oute_r__border',
					'label'    => esc_html__( 'Border', 'tpebl' ),
					'selector' => '{{WRAPPER}} .pt_plus_caldera_forms .form-group',
				)
			);
			$this->add_responsive_control(
				'oute_r_border_radius',
				array(
					'label'      => esc_html__( 'Border Radius', 'tpebl' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .pt_plus_caldera_forms .form-group' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'     => 'oute_r_shadow',
					'selector' => '{{WRAPPER}} .pt_plus_caldera_forms .form-group',
				)
			);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'oute_r_hover',
				array(
					'label' => esc_html__( 'Hover', 'tpebl' ),
				)
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				array(
					'name'     => 'oute_r_field_bg_hover',
					'types'    => array( 'classic', 'gradient' ),
					'selector' => '{{WRAPPER}} .pt_plus_caldera_forms .form-group:hover',
				)
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'     => 'oute_r__border_hover',
					'label'    => esc_html__( 'Border', 'tpebl' ),
					'selector' => '{{WRAPPER}} .pt_plus_caldera_forms .form-group:hover',
				)
			);
			$this->add_responsive_control(
				'oute_r_border_radius_hover',
				array(
					'label'      => esc_html__( 'Border Radius', 'tpebl' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .pt_plus_caldera_forms .form-group:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'     => 'oute_r_shadow_hover',
					'selector' => '{{WRAPPER}} .pt_plus_caldera_forms .form-group:hover',
				)
			);
			$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_form_container',
			array(
				'label' => esc_html__( 'Form Container', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'form_cont_padding',
			array(
				'label'      => esc_html__( 'Inner Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_caldera_forms .caldera_forms_form' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'form_cont_margin',
			array(
				'label'      => esc_html__( 'Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_caldera_forms .caldera_forms_form' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->start_controls_tabs( 'tabs_form_container' );
			$this->start_controls_tab(
				'form_normal',
				array(
					'label' => esc_html__( 'Normal', 'tpebl' ),
				)
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				array(
					'name'     => 'form_bg',
					'types'    => array( 'classic', 'gradient' ),
					'selector' => '{{WRAPPER}} .pt_plus_caldera_forms .caldera_forms_form',
				)
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'     => 'form_border',
					'label'    => esc_html__( 'Border', 'tpebl' ),
					'selector' => '{{WRAPPER}} .pt_plus_caldera_forms .caldera_forms_form',
				)
			);
			$this->add_responsive_control(
				'form_border_radius',
				array(
					'label'      => esc_html__( 'Border Radius', 'tpebl' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .pt_plus_caldera_forms .caldera_forms_form' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'     => 'form_shadow',
					'selector' => '{{WRAPPER}} .pt_plus_caldera_forms .caldera_forms_form',
				)
			);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'form_hover',
				array(
					'label' => esc_html__( 'Hover', 'tpebl' ),
				)
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				array(
					'name'     => 'form_bg_hover',
					'types'    => array( 'classic', 'gradient' ),
					'selector' => '{{WRAPPER}} .pt_plus_caldera_forms .caldera_forms_form:hover',
				)
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'     => 'form_border_hover',
					'label'    => esc_html__( 'Border', 'tpebl' ),
					'selector' => '{{WRAPPER}} .pt_plus_caldera_forms .caldera_forms_form:hover',
				)
			);
			$this->add_responsive_control(
				'form_border_radius_hover',
				array(
					'label'      => esc_html__( 'Border Radius', 'tpebl' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .pt_plus_caldera_forms .caldera_forms_form:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'     => 'form_shadow_hover',
					'selector' => '{{WRAPPER}} .pt_plus_caldera_forms .caldera_forms_form:hover',
				)
			);
			$this->end_controls_tab();
			$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_response_message',
			array(
				'label' => esc_html__( 'Response Message', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->start_controls_tabs( 'tabs_response_style' );
		$this->start_controls_tab(
			'tab_response_success',
			array(
				'label' => esc_html__( 'Success', 'tpebl' ),
			)
		);
		$this->add_responsive_control(
			'response_success_margin',
			array(
				'label'      => esc_html__( 'Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_caldera_forms .caldera-grid .alert.alert-success' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'response_success_padding',
			array(
				'label'      => esc_html__( 'Inner Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_caldera_forms .caldera-grid .alert.alert-success' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'response_success_typography',
				'selector' => '{{WRAPPER}} .pt_plus_caldera_forms .caldera-grid .alert.alert-success',
			)
		);
		$this->add_control(
			'response_success_color',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_caldera_forms .caldera-grid .alert.alert-success' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'response_success_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .pt_plus_caldera_forms .caldera-grid .alert.alert-success',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'response_success_border',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .pt_plus_caldera_forms .caldera-grid .alert.alert-success',
			)
		);
		$this->add_responsive_control(
			'response_success_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_caldera_forms .caldera-grid .alert.alert-success' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_response_validation',
			array(
				'label' => esc_html__( 'Validation/Error', 'tpebl' ),
			)
		);
		$this->add_responsive_control(
			'response_validation_padding',
			array(
				'label'      => esc_html__( 'Inner Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_caldera_forms .parsley-required' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'response_validation_typography',
				'selector' => '{{WRAPPER}} .pt_plus_caldera_forms .parsley-required',
			)
		);
		$this->add_control(
			'response_validation_color',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_caldera_forms .parsley-required' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'response_validation_bg',
			array(
				'label'     => esc_html__( 'Background', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_caldera_forms .parsley-required' => 'background: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'response_validation_border',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .pt_plus_caldera_forms .parsley-required',
			)
		);
		$this->add_responsive_control(
			'response_validation_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_caldera_forms .parsley-required' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_extra_option_styling',
			array(
				'label' => esc_html__( 'Extra Option', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'content_max_width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Maximum Width', 'tpebl' ),
				'size_units'  => array( 'px', '%' ),
				'range'       => array(
					'px' => array(
						'min'  => 250,
						'max'  => 2000,
						'step' => 5,
					),
					'%'  => array(
						'min'  => 10,
						'max'  => 100,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .pt_plus_caldera_forms .caldera_forms_form' => 'max-width: {{SIZE}}{{UNIT}}',
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
	}

	
	/**
	 * Render caldera form.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function render() {
		$settings = $this->get_settings_for_display();

		$ani_out = ! empty( $settings['animation_out_duration_default'] ) ? $settings['animation_out_duration_default'] : '';

		$ani_delay  = ! empty( $settings['animation_out_delay']['size'] ) ? $settings['animation_out_delay']['size'] : 50;
		$ani_effect = ! empty( $settings['animation_out_effects'] ) ? $settings['animation_out_effects'] : 'no-animation';

		$ani_effects  = ! empty( $settings['animation_effects'] ) ? $settings['animation_effects'] : 'no-animation';
		$ani_duration = ! empty( $settings['animation_duration_default'] ) ? $settings['animation_duration_default'] : '';

		$duration_size  = ! empty( $settings['animation_out_duration']['size'] ) ? $settings['animation_out_duration']['size'] : 50;
		$duration_speed = ! empty( $settings['animate_duration']['size'] ) ? $settings['animate_duration']['size'] : 50;

		$animation_delay = ! empty( $settings['animation_delay']['size'] ) ? $settings['animation_delay']['size'] : 50;

		if ( 'no-animation' === $ani_effects ) {
			$animated_class = '';
			$animation_attr = '';
		} else {
			$animate_offset  = '85%';
			$animated_class  = 'animate-general';
			$animation_attr  = ' data-animate-type="' . esc_attr( $ani_effects ) . '" data-animate-delay="' . esc_attr( $animation_delay ) . '"';
			$animation_attr .= ' data-animate-offset="' . esc_attr( $animate_offset ) . '"';

			if ( 'yes' === $ani_duration ) {
				$animate_duration = $duration_speed;
				$animation_attr  .= ' data-animate-duration="' . esc_attr( $animate_duration ) . '"';
			}

			if ( 'no-animation' !== $ani_effect ) {
				$animation_attr .= ' data-animate-out-type="' . esc_attr( $ani_effect ) . '" data-animate-out-delay="' . esc_attr( $ani_delay ) . '"';
				if ( 'yes' === $ani_out ) {
					$animation_attr .= ' data-animate-out-duration="' . esc_attr( $duration_size ) . '"';
				}
			}
		}

		$output      = '<div class="pt_plus_caldera_forms ' . esc_attr( $animated_class ) . '" ' . $animation_attr . '>';
			$output .= do_shortcode( $this->get_shortcode() );
		$output     .= '</div>';

		echo $output;
	}

	/**
	 * Get Shortcode.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	private function get_shortcode() {
		$settings = $this->get_settings_for_display();
		$c_form   = ! empty( $settings['caldera_forms'] ) ? $settings['caldera_forms'] : '0';

		if ( '0' === $c_form ) {
			return '<h3 class="theplus-posts-not-found">' . esc_html__( 'Please select a Caldera Forms', 'tpebl' ) . '</h3>';
		}

		$attributes = array(
			'id' => $c_form,
		);
		$this->add_render_attribute( 'shortcode', $attributes );

		$shortcode   = array();
		$shortcode[] = sprintf( '[caldera_form %s]', $this->get_render_attribute_string( 'shortcode' ) );

		return implode( '', $shortcode );
	}

	/**
	 * Get caldera form.
	 *
	 * @since 1.0.0
	 * @version 5.5.2
	 */
	function l_theplus_caldera_forms() {
		if ( class_exists( 'Caldera_Forms' ) ) {
			$caldera_forms = \Caldera_Forms_Forms::get_forms( true, true );
			$form_options = ['0' => esc_html__( 'Select Form', 'tpebl' )];
			$form  = [];

			if ( !empty( $caldera_forms ) && !is_wp_error( $caldera_forms ) ) {
				foreach ( $caldera_forms as $form ) {
					if ( isset($form['ID']) and isset($form['name'])) {
						$form_options[$form['ID']] = $form['name'];
					}   
				}
			}
		} else {
			$form_options = ['0' => esc_html__( 'Form Not Found!', 'tpebl' ) ];
		}

		return $form_options;
	}
}