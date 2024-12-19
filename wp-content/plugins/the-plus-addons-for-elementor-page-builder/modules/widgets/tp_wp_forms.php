<?php
/**
 * Widget Name: WP Forms
 * Description: Third party plugin WP forms style.
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
 * Class L_ThePlus_Wp_Forms
 */
class L_ThePlus_Wp_Forms extends Widget_Base {

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
		return 'tp-wp-forms';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'WPForms', 'tpebl' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-envelope-open theplus_backend_icon';
	}

	/**
	 * Get Widget categories.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_categories() {
		return array( 'plus-adapted' );
	}

	/**
	 * Get Widget keywords.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_keywords() {
		return array( 'WP Forms', 'WordPress Forms', 'Form Builder', 'Elementor Forms', 'Contact Forms', 'Custom Forms', 'Drag and Drop Forms', 'Form Creator', 'Form Designer', 'Form Generator', 'Form Maker', 'Form Plugin', 'Form Widget' );
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
	 * @since 1.0.1
	 * @version 5.5.4
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'WPForms', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'wp_forms',
			array(
				'label'   => esc_html__( 'Select Form', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '0',
				'options' => $this->l_theplus_wpforms_forms(),
			)
		);
		$this->add_control(
			'wp_forms_notice',
			array(
				'type'        => Controls_Manager::RAW_HTML,
				'raw'         => '<p class="tp-controller-notice"><i>NOTICE :- Dashboard -> WPForms -> Settings.</i></p>',
				'label_block' => true,
			)
		);
		$this->add_control(
			'wp_forms_notice_dec',
			array(
				'type'        => Controls_Manager::RAW_HTML,
				'raw'         => '<p class="tp-controller-notice"><i>Check Load Assets Globally to load form in wordpress backend.</i></p>',
				'label_block' => true,
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'displayoption_section',
			array(
				'label' => esc_html__( 'Display Options', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'form_title',
			array(
				'label'     => esc_html__( 'Form Name', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'default'   => '',
			)
		);
		$this->add_control(
			'form_description',
			array(
				'label'     => esc_html__( 'Form Description', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'default'   => '',
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
		$this->add_control(
			'label_typ_head',
			array(
				'label'     => esc_html__( 'Label Typography', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'label_padding',
			array(
				'label'      => esc_html__( 'Inner Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .wpforms-container label.wpforms-field-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .wpforms-container label.wpforms-field-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'label_typography',
				'selector' => '{{WRAPPER}} .wpforms-container label.wpforms-field-label',
			)
		);
		$this->add_control(
			'label_color',
			array(
				'label'     => esc_html__( 'Label Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wpforms-container label.wpforms-field-label' => 'color: {{VALUE}}',
					'separator' => 'after',
				),
			)
		);
		$this->add_control(
			'label_inline_typ_head',
			array(
				'label'     => esc_html__( 'Inline Label Typography', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'inline_label_typography',
				'selector' => '{{WRAPPER}} .wpforms-container .wpforms-field-sublabel',
			)
		);
		$this->add_control(
			'sub_label_color',
			array(
				'label'     => esc_html__( 'Inline/Sub Label Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wpforms-container .wpforms-field-label-inline,{{WRAPPER}} .wpforms-container .wpforms-field-sublabel' => 'color: {{VALUE}}',
				),
				'separator' => 'after',
			)
		);
		$this->add_control(
			'req_symbol_color',
			array(
				'label'     => esc_html__( 'Required Symbol', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wpforms-container .wpforms-required-label' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_dec_text',
			array(
				'label' => esc_html__( 'Description Text', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'desc_margin',
			array(
				'label'      => esc_html__( 'Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .wpforms-container .wpforms-field-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'desc_inner_padding',
			array(
				'label'      => esc_html__( 'Inner Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .wpforms-container .wpforms-field-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'desc_typography',
				'selector' => '{{WRAPPER}} .wpforms-container .wpforms-field-description',
			)
		);
		$this->add_control(
			'desc_color',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wpforms-container .wpforms-field-description' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'dec_background',
			array(
				'label'     => esc_html__( 'Background Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wpforms-container .wpforms-field-description' => 'background: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'dec_border_switch',
			array(
				'label'     => esc_html__( 'Border', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'default'   => 'no',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'dec_border',
				'label'     => esc_html__( 'Border', 'tpebl' ),
				'selector'  => '{{WRAPPER}} .wpforms-container .wpforms-field-description',
				'condition' => array(
					'dec_border_switch' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'dec_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .wpforms-container .wpforms-field-description' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'dec_border_switch' => 'yes',
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
				'selector' => '{{WRAPPER}} .wpforms-container input[type="text"],
				{{WRAPPER}} .wpforms-container input[type="email"],
				{{WRAPPER}} .wpforms-container input[type="number"],
				{{WRAPPER}} .wpforms-container select',
			)
		);
		$this->add_control(
			'input_placeholder_color',
			array(
				'label'     => esc_html__( 'Placeholder Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wpforms-container input::-webkit-input-placeholder,
					{{WRAPPER}} .wpforms-container  email::-webkit-input-placeholder,
					{{WRAPPER}} .wpforms-container  number::-webkit-input-placeholder,
					{{WRAPPER}} .wpforms-container  select::-webkit-input-placeholder' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .wpforms-container .wpforms-field input[type="text"],{{WRAPPER}} .wpforms-container .wpforms-field input[type="email"],
				{{WRAPPER}} .wpforms-container .wpforms-field input[type="number"],
				{{WRAPPER}} .wpforms-container .wpforms-field select' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .wpforms-container .wpforms-field input[type="text"],{{WRAPPER}} .wpforms-container .wpforms-field input[type="email"],
				{{WRAPPER}} .wpforms-container .wpforms-field input[type="number"],
				{{WRAPPER}} .wpforms-container .wpforms-field select,{{WRAPPER}} .wpforms-container .wpforms-field-sublabel.after,{{WRAPPER}} .wpforms-container .wpforms-field-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .wpforms-container .wpforms-field input[type="text"],{{WRAPPER}} .wpforms-container .wpforms-field input[type="email"],
				{{WRAPPER}} .wpforms-container .wpforms-field input[type="number"],
				{{WRAPPER}} .wpforms-container .wpforms-field select' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'input_field_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .wpforms-container .wpforms-field input[type="text"],{{WRAPPER}} .wpforms-container .wpforms-field input[type="email"],
				{{WRAPPER}} .wpforms-container .wpforms-field input[type="number"],
				{{WRAPPER}} .wpforms-container .wpforms-field select',
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
					'{{WRAPPER}} .wpforms-container .wpforms-field input[type="text"]:focus,{{WRAPPER}} .wpforms-container .wpforms-field input[type="email"]:focus,
				{{WRAPPER}} .wpforms-container .wpforms-field input[type="number"]:focus,
				{{WRAPPER}} .wpforms-container .wpforms-field select:focus' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'input_field_focus_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .wpforms-container .wpforms-field input[type="text"]:focus,{{WRAPPER}} .wpforms-container .wpforms-field input[type="email"]:focus,
				{{WRAPPER}} .wpforms-container .wpforms-field input[type="number"]:focus,
				{{WRAPPER}} .wpforms-container .wpforms-field select:focus',
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
					'{{WRAPPER}} .wpforms-container .wpforms-field input[type="text"],{{WRAPPER}} .wpforms-container .wpforms-field input[type="email"],
				{{WRAPPER}} .wpforms-container .wpforms-field input[type="number"],
				{{WRAPPER}} .wpforms-container .wpforms-field select' => 'border-style: {{VALUE}};',
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
					'{{WRAPPER}} .wpforms-container .wpforms-field input[type="text"],{{WRAPPER}} .wpforms-container .wpforms-field input[type="email"],
				{{WRAPPER}} .wpforms-container .wpforms-field input[type="number"],
				{{WRAPPER}} .wpforms-container .wpforms-field select' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'box_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .wpforms-container .wpforms-field input[type="text"],{{WRAPPER}} .wpforms-container .wpforms-field input[type="email"],
				{{WRAPPER}} .wpforms-container .wpforms-field input[type="number"],
				{{WRAPPER}} .wpforms-container .wpforms-field select' => 'border-color: {{VALUE}};',
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
					'{{WRAPPER}} .wpforms-container .wpforms-field input[type="text"],{{WRAPPER}} .wpforms-container .wpforms-field input[type="email"],
				{{WRAPPER}} .wpforms-container .wpforms-field input[type="number"],
				{{WRAPPER}} .wpforms-container .wpforms-field select' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_border_hover',
			array(
				'label' => esc_html__( 'Focus', 'tpebl' ),
			)
		);
		$this->add_control(
			'box_border_hover_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .wpforms-container .wpforms-field input[type="text"]:focus,{{WRAPPER}} .wpforms-container .wpforms-field input[type="email"]:focus,
				{{WRAPPER}} .wpforms-container .wpforms-field input[type="number"]:focus,
				{{WRAPPER}} .wpforms-container .wpforms-field select:focus' => 'border-color: {{VALUE}};',
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
					'{{WRAPPER}} .wpforms-container .wpforms-field input[type="text"]:focus,{{WRAPPER}} .wpforms-container .wpforms-field input[type="email"]:focus,
				{{WRAPPER}} .wpforms-container .wpforms-field input[type="number"]:focus,
				{{WRAPPER}} .wpforms-container .wpforms-field select:focus' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .wpforms-container .wpforms-field input[type="text"],{{WRAPPER}} .wpforms-container .wpforms-field input[type="email"],
				{{WRAPPER}} .wpforms-container .wpforms-field input[type="number"],
				{{WRAPPER}} .wpforms-container .wpforms-field select',
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
				'selector' => '{{WRAPPER}} .wpforms-container .wpforms-field input[type="text"]:focus,{{WRAPPER}} .wpforms-container .wpforms-field input[type="email"]:focus,
				{{WRAPPER}} .wpforms-container .wpforms-field input[type="number"]:focus,
				{{WRAPPER}} .wpforms-container .wpforms-field select:focus',
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
					'{{WRAPPER}} .wpforms-container .wpforms-field.wpforms-field-textarea textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .wpforms-container .wpforms-field.wpforms-field-textarea textarea' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'textarea_typography',
				'selector' => '{{WRAPPER}} .wpforms-container .wpforms-field.wpforms-field-textarea textarea',
			)
		);
		$this->add_control(
			'textarea_placeholder_color',
			array(
				'label'     => esc_html__( 'Placeholder Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wpforms-container  textarea::-webkit-input-placeholder' => 'color: {{VALUE}};',
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
							'{{WRAPPER}} .wpforms-container .wpforms-field.wpforms-field-textarea textarea' => 'color: {{VALUE}};',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Background::get_type(),
					array(
						'name'     => 'textarea_field_bg',
						'types'    => array( 'classic', 'gradient' ),
						'selector' => '{{WRAPPER}} .wpforms-container .wpforms-field.wpforms-field-textarea textarea',
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
							'{{WRAPPER}} .wpforms-container .wpforms-field.wpforms-field-textarea textarea:focus' => 'color: {{VALUE}};',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Background::get_type(),
					array(
						'name'     => 'textarea_field_focus_bg',
						'types'    => array( 'classic', 'gradient' ),
						'selector' => '{{WRAPPER}} .wpforms-container .wpforms-field.wpforms-field-textarea textarea:focus',
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
					'{{WRAPPER}} .wpforms-container .wpforms-field.wpforms-field-textarea textarea' => 'border-style: {{VALUE}};',
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
					'{{WRAPPER}} .wpforms-container .wpforms-field.wpforms-field-textarea textarea' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'label' => esc_html__( 'Normal', 'tpebl' ),
					)
				);
				$this->add_control(
					'ta_box_border_color',
					array(
						'label'     => esc_html__( 'Border Color', 'tpebl' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							'{{WRAPPER}} .wpforms-container .wpforms-field.wpforms-field-textarea textarea' => 'border-color: {{VALUE}};',
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
							'{{WRAPPER}} .wpforms-container .wpforms-field.wpforms-field-textarea textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						),
					)
				);
				$this->end_controls_tab();

				$this->start_controls_tab(
					'tab_ta_border_hover',
					array(
						'label' => esc_html__( 'Focus', 'tpebl' ),
					)
				);
				$this->add_control(
					'ta_box_border_hover_color',
					array(
						'label'     => esc_html__( 'Border Color', 'tpebl' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '',
						'selectors' => array(
							'{{WRAPPER}} .wpforms-container .wpforms-field.wpforms-field-textarea textarea:focus' => 'border-color: {{VALUE}};',
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
							'{{WRAPPER}} .wpforms-container .wpforms-field.wpforms-field-textarea textarea:focus' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .wpforms-container .wpforms-field.wpforms-field-textarea textarea',
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
				'selector' => '{{WRAPPER}} .wpforms-container .wpforms-field.wpforms-field-textarea textarea:focus',
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
				'selector' => '{{WRAPPER}} .wpforms-field.wpforms-field-checkbox li label,{{WRAPPER}} .wpforms-field.wpforms-field-checkbox li.wpforms-image-choices-item .wpforms-image-choices-label',
			)
		);

		$this->add_control(
			'checked_field_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wpforms-field.wpforms-field-checkbox li label,{{WRAPPER}} .wpforms-field.wpforms-field-checkbox li.wpforms-image-choices-item .wpforms-image-choices-label' => 'color: {{VALUE}};',
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
						'min'  => 10,
						'max'  => 60,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .wpforms-field.wpforms-field-checkbox li label:before' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'checked_uncheck_color',
			array(
				'label'     => esc_html__( 'UnChecked Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wpforms-field.wpforms-field-checkbox li:not(.wpforms-selected) label:before' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'checked_field_color',
			array(
				'label'     => esc_html__( 'Checked Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wpforms-field.wpforms-field-checkbox li.wpforms-selected label:before' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'unchecked_field_bgcolor',
			array(
				'label'     => esc_html__( 'UnChecked Bg Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wpforms-field.wpforms-field-checkbox li:not(.wpforms-selected) label:before' => 'background: {{VALUE}};',
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
					'{{WRAPPER}} .wpforms-field.wpforms-field-checkbox li.wpforms-selected label:before' => 'background: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'img_chkbx_heading',
			array(
				'label'     => esc_html__( 'Image choices & Style', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'img_chkbx_switch',
			array(
				'label'     => esc_html__( 'Must use image choices in WPForms', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'default'   => 'no',
			)
		);
		$this->add_responsive_control(
			'img_chkbx_padding',
			array(
				'label'      => esc_html__( 'Inner Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-field-checkbox ul.wpforms-image-choices-modern label,
					 {{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-field-checkbox ul.wpforms-image-choices-classic label,
					 {{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-field-checkbox ul.wpforms-image-choices-none label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'img_chkbx_switch' => 'yes',
				),
			)
		);
		$this->add_control(
			'img_chkbx_field_bgcolor',
			array(
				'label'     => esc_html__( 'Image Checkbox Normal', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-field-checkbox ul.wpforms-image-choices-modern label' => 'background: {{VALUE}};',
					'{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-field-checkbox ul.wpforms-image-choices-classic label' => 'border:solid {{VALUE}};',
				),
				'condition' => array(
					'img_chkbx_switch' => 'yes',
				),
			)
		);
		$this->add_control(
			'img_chkbx_field_bgcolor_active',
			array(
				'label'     => esc_html__( 'Image Checkbox Selected', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-field-checkbox ul.wpforms-image-choices-modern li.wpforms-selected label' => 'background: {{VALUE}};',
					'{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-field-checkbox ul.wpforms-image-choices-classic li.wpforms-selected label' => 'border:solid {{VALUE}};',
				),
				'condition' => array(
					'img_chkbx_switch' => 'yes',
				),
			)
		);
		$this->add_control(
			'img_chkbx_chk_color',
			array(
				'label'     => esc_html__( 'Checked Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-field-checkbox ul.wpforms-image-choices-modern .wpforms-image-choices-image:after,{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-field-checkbox ul.wpforms-image-choices-classic .wpforms-image-choices-image:after' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'img_chkbx_switch' => 'yes',
				),
			)
		);

		$this->add_control(
			'img_chkbx_chk_bgcolor',
			array(
				'label'     => esc_html__( 'Checked Bg Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-field-checkbox ul.wpforms-image-choices-modern .wpforms-image-choices-image:after,{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-field-checkbox ul.wpforms-image-choices-classic .wpforms-image-choices-image:after' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'img_chkbx_switch' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'img_chkbx_icon_size',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Image Icon Size', 'tpebl' ),
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 300,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-field-checkbox ul.wpforms-image-choices-modern .wpforms-image-choices-image:after,
					 {{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-field-checkbox ul.wpforms-image-choices-classic .wpforms-image-choices-image:after' => 'font-size: {{SIZE}}{{UNIT}}',
				),
				'condition'  => array(
					'img_chkbx_switch' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'img_chkbx_icon_bg_size',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Image Icon Background Size', 'tpebl' ),
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 300,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-field-checkbox ul.wpforms-image-choices-modern .wpforms-image-choices-image:after,
					{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-field-checkbox ul.wpforms-image-choices-classic .wpforms-image-choices-image:after' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'img_chkbx_switch' => 'yes',
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
					'{{WRAPPER}} .wpforms-field.wpforms-field-checkbox li label:before,
					{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-field-checkbox ul.wpforms-image-choices-modern li label,
					{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-field-checkbox ul.wpforms-image-choices-classic li label' => 'border-style: {{VALUE}};',
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
					'{{WRAPPER}} .wpforms-field.wpforms-field-checkbox li label:before,
					{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-field-checkbox ul.wpforms-image-choices-modern li label,
					{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-field-checkbox ul.wpforms-image-choices-classic li label' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .wpforms-field.wpforms-field-checkbox li label:before,
					{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-field-checkbox ul.wpforms-image-choices-modern li label,
					{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-field-checkbox ul.wpforms-image-choices-classic li label' => 'border-color: {{VALUE}};',
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
					'{{WRAPPER}} .wpforms-field.wpforms-field-checkbox li label:before,
					{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-field-checkbox ul.wpforms-image-choices-modern li label,
					{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-field-checkbox ul.wpforms-image-choices-classic li label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .wpforms-field.wpforms-field-radio li label,{{WRAPPER}} .wpforms-field.wpforms-field-radio li.wpforms-image-choices-item .wpforms-image-choices-label',
			)
		);
		$this->add_control(
			'radio_field_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wpforms-field.wpforms-field-radio li label,{{WRAPPER}} .wpforms-field.wpforms-field-radio li.wpforms-image-choices-item .wpforms-image-choices-label' => 'color: {{VALUE}};',
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
							'min'  => 10,
							'max'  => 60,
							'step' => 1,
						),
					),
					'selectors'  => array(
						'{{WRAPPER}} .wpforms-field.wpforms-field-radio li label:before' => 'font-size: {{SIZE}}{{UNIT}};',
					),
				)
			);
		$this->add_control(
			'radio_uncheck_color',
			array(
				'label'     => esc_html__( 'UnChecked Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wpforms-field.wpforms-field-radio li:not(.wpforms-selected) label:before' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'radio_field_color',
			array(
				'label'     => esc_html__( 'Checked Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wpforms-field.wpforms-field-radio li.wpforms-selected label:before' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'radio_unchecked_field_bgcolor',
			array(
				'label'     => esc_html__( 'UnChecked Bg Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wpforms-field.wpforms-field-radio li:not(.wpforms-selected) label:before' => 'background: {{VALUE}};',
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
					'{{WRAPPER}} .wpforms-field.wpforms-field-radio li.wpforms-selected label:before' => 'background: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'img_rdo_heading',
			array(
				'label'     => esc_html__( 'Image choices & Style', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'img_rdo_switch',
			array(
				'label'     => esc_html__( 'Must use image choices in WPForms', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'default'   => 'no',
			)
		);
		$this->add_responsive_control(
			'img_rdo_padding',
			array(
				'label'      => esc_html__( 'Inner Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-field-radio ul.wpforms-image-choices-modern label,
					 {{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-field-radio ul.wpforms-image-choices-classic label,
					 {{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-field-radio ul.wpforms-image-choices-none label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'img_rdo_switch' => 'yes',
				),
			)
		);
		$this->add_control(
			'img_rdo_field_bgcolor',
			array(
				'label'     => esc_html__( 'Image Radio Normal', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-field-radio ul.wpforms-image-choices-modern label' => 'background: {{VALUE}};',
					'{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-field-radio ul.wpforms-image-choices-classic label' => 'border:solid {{VALUE}};',
				),
				'condition' => array(
					'img_rdo_switch' => 'yes',
				),
			)
		);
		$this->add_control(
			'img_rdo_field_bg_active',
			array(
				'label'     => esc_html__( 'Image Radio Selected', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-field-radio ul.wpforms-image-choices-modern li.wpforms-selected label' => 'background: {{VALUE}};',
					'{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-field-radio ul.wpforms-image-choices-classic li.wpforms-selected label' => 'border:solid {{VALUE}};',
				),
				'condition' => array(
					'img_rdo_switch' => 'yes',
				),
			)
		);
		$this->add_control(
			'img_rdo_chk_color',
			array(
				'label'     => esc_html__( 'Checked Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-field-radio ul.wpforms-image-choices-modern .wpforms-image-choices-image:after,{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-field-radio ul.wpforms-image-choices-classic .wpforms-image-choices-image:after' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'img_rdo_switch' => 'yes',
				),
			)
		);

		$this->add_control(
			'img_rdo_chk_bgcolor',
			array(
				'label'     => esc_html__( 'Checked Bg Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-field-radio ul.wpforms-image-choices-modern .wpforms-image-choices-image:after,{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-field-radio ul.wpforms-image-choices-classic .wpforms-image-choices-image:after' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'img_rdo_switch' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'img_rdo_icon_size',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Image Icon Size', 'tpebl' ),
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 300,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-field-radio ul.wpforms-image-choices-modern .wpforms-image-choices-image:after,
					 {{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-field-radio ul.wpforms-image-choices-classic .wpforms-image-choices-image:after' => 'font-size: {{SIZE}}{{UNIT}}',
				),
				'condition'  => array(
					'img_rdo_switch' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'img_rdo_icon_bg_size',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Image Icon Background Size', 'tpebl' ),
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 300,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-field-radio ul.wpforms-image-choices-modern .wpforms-image-choices-image:after,
					{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-field-radio ul.wpforms-image-choices-classic .wpforms-image-choices-image:after' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'img_rdo_switch' => 'yes',
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
					'{{WRAPPER}} .wpforms-field.wpforms-field-radio li label:before,
					 {{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-field-radio ul.wpforms-image-choices-modern li label,
					 {{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-field-checkbox ul.wpforms-image-choices-classic li label' => 'border-style: {{VALUE}};',
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
					'{{WRAPPER}} .wpforms-field.wpforms-field-radio li label:before,
					{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-field-radio ul.wpforms-image-choices-modern li label,
					 {{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-field-checkbox ul.wpforms-image-choices-classic li label' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .wpforms-field.wpforms-field-radio li label:before,
					{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-field-radio ul.wpforms-image-choices-modern li label,
					 {{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-field-checkbox ul.wpforms-image-choices-classic li label' => 'border-color: {{VALUE}};',
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
					'{{WRAPPER}} .wpforms-field.wpforms-field-radio li label:before,
					{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-field-radio ul.wpforms-image-choices-modern li label,
					 {{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-field-checkbox ul.wpforms-image-choices-classic li label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
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
					'{{WRAPPER}} div.wpforms-container .wpforms-form button[type=submit],
					{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-page-button' => 'width: {{SIZE}}{{UNIT}}',
				),
				'separator'   => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'button_typography',
				'selector' => '{{WRAPPER}} div.wpforms-container .wpforms-form button[type=submit],
					{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-page-button',
			)
		);
		$this->add_responsive_control(
			'button_inner_padding',
			array(
				'label'      => esc_html__( 'Inner Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} div.wpforms-container .wpforms-form button[type=submit],
					{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-page-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} div.wpforms-container .wpforms-form button[type=submit],
					{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-page-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} div.wpforms-container .wpforms-form button[type=submit],
					{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-page-button' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'button_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} div.wpforms-container .wpforms-form button[type=submit],
					{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-page-button',
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
					'{{WRAPPER}} div.wpforms-container .wpforms-form button[type=submit]:hover,
					{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-page-button:hover' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'button_hover_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} div.wpforms-container .wpforms-form button[type=submit]:hover,
					{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-page-button:hover',
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
					'{{WRAPPER}} div.wpforms-container .wpforms-form button[type=submit],
					{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-page-button' => 'border-style: {{VALUE}};',
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
					'{{WRAPPER}} div.wpforms-container .wpforms-form button[type=submit],
					{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-page-button' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'button_box_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} div.wpforms-container .wpforms-form button[type=submit],
					{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-page-button' => 'border-color: {{VALUE}};',
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
					'{{WRAPPER}} div.wpforms-container .wpforms-form button[type=submit],
					{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-page-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_button_border_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'button_box_border_hover_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} div.wpforms-container .wpforms-form button[type=submit]:hover,
					{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-page-button:hover' => 'border-color: {{VALUE}};',
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
					'{{WRAPPER}} div.wpforms-container .wpforms-form button[type=submit]:hover,
					{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-page-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
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
				'selector' => '{{WRAPPER}} div.wpforms-container .wpforms-form button[type=submit],
					{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-page-button',
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
				'selector' => '{{WRAPPER}} div.wpforms-container .wpforms-form button[type=submit]:hover,
					{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-page-button:hover',
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
					'{{WRAPPER}} div.wpforms-container .wpforms-field,{{WRAPPER}} .wpforms-container .wpforms-submit-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} div.wpforms-container .wpforms-field,{{WRAPPER}} .wpforms-container .wpforms-submit-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
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
					'selector' => '{{WRAPPER}} .wpforms-container .wpforms-field',
				)
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'     => 'oute_r__border',
					'label'    => esc_html__( 'Border', 'tpebl' ),
					'selector' => '{{WRAPPER}} .wpforms-container .wpforms-field',
				)
			);
			$this->add_responsive_control(
				'oute_r_border_radius',
				array(
					'label'      => esc_html__( 'Border Radius', 'tpebl' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .wpforms-container .wpforms-field' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'     => 'oute_r_shadow',
					'selector' => '{{WRAPPER}} .wpforms-container .wpforms-field',
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
					'selector' => '{{WRAPPER}} .wpforms-container .wpforms-field:hover',
				)
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'     => 'oute_r__border_hover',
					'label'    => esc_html__( 'Border', 'tpebl' ),
					'selector' => '{{WRAPPER}} .wpforms-container .wpforms-field:hover',
				)
			);
			$this->add_responsive_control(
				'oute_r_border_radius_hover',
				array(
					'label'      => esc_html__( 'Border Radius', 'tpebl' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .wpforms-container .wpforms-field:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'     => 'oute_r_shadow_hover',
					'selector' => '{{WRAPPER}} .wpforms-container .wpforms-field:hover',
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
					'{{WRAPPER}} .wpforms-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .wpforms-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'selector' => '{{WRAPPER}} .wpforms-container',
				)
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'     => 'form_border',
					'label'    => esc_html__( 'Border', 'tpebl' ),
					'selector' => '{{WRAPPER}} .wpforms-container',
				)
			);
			$this->add_responsive_control(
				'form_border_radius',
				array(
					'label'      => esc_html__( 'Border Radius', 'tpebl' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .wpforms-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'     => 'form_shadow',
					'selector' => '{{WRAPPER}} .wpforms-container',
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
					'selector' => '{{WRAPPER}} .wpforms-container:hover',
				)
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'     => 'form_border_hover',
					'label'    => esc_html__( 'Border', 'tpebl' ),
					'selector' => '{{WRAPPER}} .wpforms-container:hover',
				)
			);
			$this->add_responsive_control(
				'form_border_radius_hover',
				array(
					'label'      => esc_html__( 'Border Radius', 'tpebl' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .wpforms-container:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'     => 'form_shadow_hover',
					'selector' => '{{WRAPPER}} .wpforms-container:hover',
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
					'{{WRAPPER}} .wpforms-confirmation-container-full' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .wpforms-confirmation-container-full' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'response_success_typography',
				'selector' => '{{WRAPPER}} .wpforms-confirmation-container-full,{{WRAPPER}} .wpforms-confirmation-container-full p',
			)
		);
		$this->add_control(
			'response_success_color',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wpforms-confirmation-container-full,{{WRAPPER}} .wpforms-confirmation-container-full p' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'response_success_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .wpforms-confirmation-container-full',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'response_success_border',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .wpforms-confirmation-container-full',
			)
		);
		$this->add_responsive_control(
			'response_success_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .wpforms-confirmation-container-full' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'response_validation_typography',
				'selector' => '{{WRAPPER}} div.wpforms-container .wpforms-form label.wpforms-error',
			)
		);
		$this->add_control(
			'response_validation_color',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} div.wpforms-container .wpforms-form label.wpforms-error' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'response_validation_field_color',
			array(
				'label'     => esc_html__( 'Field Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-field input.wpforms-error,
					{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-field textarea.wpforms-error,
					{{WRAPPER}} div.wpforms-container .wpforms-form .wpforms-field select.wpforms-error' => 'border:1px solid {{VALUE}};',
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
					'{{WRAPPER}} .wpforms-container' => 'max-width: {{SIZE}}{{UNIT}}',
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
	 * Wp Form shortcode.
	 *
	 * @since 1.0.1
	 * @version 5.5.4
	 */
	private function get_shortcode() {
		$settings = $this->get_settings_for_display();

		$form_description = ! empty( $settings['form_description'] ) ? 'true' : 'false';
		$form_title       = ! empty( $settings['form_title'] ) ? 'true' : 'false';

		if ( ! $settings['wp_forms'] ) {
			return '<h3 class="theplus-posts-not-found">' . esc_html__( 'Please select a WPForms', 'tpebl' ) . '</h3>';
		}

		$attributes = array(
			'id'          => $settings['wp_forms'],
			'description' => $form_description,
			'title'       => $form_title,
		);
		$this->add_render_attribute( 'shortcode', $attributes );

		$shortcode   = array();
		$shortcode[] = sprintf( '[wpforms %s]', $this->get_render_attribute_string( 'shortcode' ) );

		return implode( '', $shortcode );
	}

	/**
	 * Wp Form Render.
	 *
	 * @since 1.0.1
	 * @version 5.5.4
	 */
	public function render() {
		$settings = $this->get_settings_for_display();

		$animation_effects = ! empty( $settings['animation_effects'] ) ? $settings['animation_effects'] : '';
		$animate_duration  = ! empty( $settings['animate_duration']['size'] ) ? $settings['animate_duration']['size'] : 50;
		$animation_delay   = ! empty( $settings['animation_delay']['size'] ) ? $settings['animation_delay']['size'] : 50;

		$ani_duration = ! empty( $settings['animation_duration_default'] ) ? $settings['animation_duration_default'] : '';
		$out_duration = ! empty( $settings['animation_out_duration_default'] ) ? $settings['animation_out_duration_default'] : '';

		$out_effect = ! empty( $settings['animation_out_effects'] ) ? $settings['animation_out_effects'] : '';
		$out_delay  = ! empty( $settings['animation_out_delay']['size'] ) ? $settings['animation_out_delay']['size'] : 50;
		$out_speed  = ! empty( $settings['animation_out_duration']['size'] ) ? $settings['animation_out_duration']['size'] : 50;

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

		$output  = '<div class="pt_plus_wpforms" ' . esc_attr( $animated_class ) . '" ' . $animation_attr . '>';
		$output .= do_shortcode( $this->get_shortcode() );
		$output .= '</div>';
		echo $output;
	}

	/**
	 * Wp Form Render.
	 *
	 * @since 1.0.1
	 * @version 5.5.2
	 */
	function l_theplus_wpforms_forms() {
		$options = array();
		if ( class_exists( '\WPForms\WPForms' ) ) {

			$args = array(
				'post_type'      => 'wpforms',
				'posts_per_page' => -1,
			);

			$contact_forms = get_posts( $args );

			if ( ! empty( $contact_forms ) && ! is_wp_error( $contact_forms ) ) {
				$options[0] = esc_html__( 'Select a WPForm', 'tpebl' );
				foreach ( $contact_forms as $post ) {
					$options[ $post->ID ] = $post->post_title;
				}
			}
		} else {
			$options[0] = esc_html__( 'Create a Form First', 'tpebl' );
		}

		return $options;
	}
}
