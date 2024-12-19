<?php
/**
 * Widget Name: Ninja Form
 * Description: Third party plugin ninja form style.
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
 * Class L_ThePlus_Ninja_form
 */
class L_ThePlus_Ninja_form extends Widget_Base {

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
		return 'tp-ninja-form';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Ninja Form', 'tpebl' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-envelope-o theplus_backend_icon';
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
		return array( 'Ninja Forms', 'form builder', 'form plugin', 'contact forms', 'form creator', 'form designer', 'form generator', 'form maker', 'form widget', 'form element', 'form addon', 'form extension' );
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
	 * Register controls.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Ninja Form', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'contact_form',
			array(
				'label'   => esc_html__( 'Select Form', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '0',
				'options' => $this->l_theplus_get_ninja_form_post(),
			)
		);
		$this->add_control(
			'form_style',
			array(
				'label'   => esc_html__( 'Style', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => l_theplus_get_style_list( 1 ),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_form_heading',
			array(
				'label' => esc_html__( 'Form Heading', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'form_heading_typography',
				'selector'  => '{{WRAPPER}} .theplus-ninja-form.style-1 .nf-form-title h3',
				'separator' => 'after',
			)
		);
		$this->add_control(
			'form_heading_color',
			array(
				'label'     => esc_html__( 'Form Heading', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .theplus-ninja-form.style-1 .nf-form-title h3' => 'color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_help_text',
			array(
				'label' => esc_html__( 'Field Hint', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'help_icon_color',
			array(
				'label'     => esc_html__( 'Hint Icon', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .theplus-ninja-form.style-1 span.fa.fa-info-circle.nf-help:before' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'help_desc_color',
			array(
				'label'     => esc_html__( 'Description', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .theplus-ninja-form.style-1 .nf-field-description' => 'color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_label',
			array(
				'label' => esc_html__( 'Label Styling', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'label_typography',
				'selector' => '{{WRAPPER}} .nf-form-layout .nf-field-label label',
			)
		);
		$this->add_control(
			'label_color',
			array(
				'label'     => esc_html__( 'Label Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .nf-form-layout .nf-field-label label' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'sub_label_color',
			array(
				'label'     => esc_html__( 'Field Description Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .theplus-ninja-form.style-1 .nf-field-description,{{WRAPPER}} .theplus-ninja-form.style-1 .nf-field-description p' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'req_symbol_color',
			array(
				'label'     => esc_html__( 'Required Symbol', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .theplus-ninja-form.style-1 .ninja-forms-req-symbol' => 'color: {{VALUE}}',
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
				'selector' => '{{WRAPPER}} .theplus-ninja-form .nf-field-element input[type="text"],
				{{WRAPPER}} .theplus-ninja-form .nf-field-element input[type="email"],
				{{WRAPPER}} .theplus-ninja-form .nf-field-element input[type="number"],
				{{WRAPPER}} .theplus-ninja-form .nf-field-element select',
			)
		);
		$this->add_control(
			'input_placeholder_color',
			array(
				'label'     => esc_html__( 'Placeholder Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .nf-form-content input::-webkit-input-placeholder,
					{{WRAPPER}} .nf-form-content  email::-webkit-input-placeholder,
					{{WRAPPER}} .nf-form-content  number::-webkit-input-placeholder,
					{{WRAPPER}} .nf-form-content  select::-webkit-input-placeholder' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .theplus-ninja-form .textbox-wrap:not(.submit-wrap) .nf-field-element .ninja-forms-field,
				{{WRAPPER}} .theplus-ninja-form .firstname-wrap .nf-field-element .ninja-forms-field,
				{{WRAPPER}} .theplus-ninja-form .lastname-wrap .nf-field-element .ninja-forms-field,
				{{WRAPPER}} .theplus-ninja-form .email-wrap .nf-field-element .ninja-forms-field,
				{{WRAPPER}} .theplus-ninja-form .number-wrap .nf-field-element .ninja-forms-field,				
				{{WRAPPER}} .theplus-ninja-form .date-wrap .nf-field-element .ninja-forms-field,
				{{WRAPPER}} .theplus-ninja-form .city-wrap .nf-field-element .ninja-forms-field,
				{{WRAPPER}} .theplus-ninja-form .address-wrap .nf-field-element .ninja-forms-field,
				{{WRAPPER}} .theplus-ninja-form .list-select-wrap .nf-field-element .ninja-forms-field' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_responsive_control(
			'input_inner_margin',
			array(
				'label'      => esc_html__( 'Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-ninja-form .textbox-wrap:not(.submit-wrap) .nf-field-element .ninja-forms-field,
				{{WRAPPER}} .theplus-ninja-form .firstname-wrap .nf-field-element .ninja-forms-field,
				{{WRAPPER}} .theplus-ninja-form .lastname-wrap .nf-field-element .ninja-forms-field,
				{{WRAPPER}} .theplus-ninja-form .email-wrap .nf-field-element .ninja-forms-field,
				{{WRAPPER}} .theplus-ninja-form .number-wrap .nf-field-element .ninja-forms-field,				
				{{WRAPPER}} .theplus-ninja-form .date-wrap .nf-field-element .ninja-forms-field,
				{{WRAPPER}} .theplus-ninja-form .city-wrap .nf-field-element .ninja-forms-field,
				{{WRAPPER}} .theplus-ninja-form .address-wrap .nf-field-element .ninja-forms-field,
				{{WRAPPER}} .theplus-ninja-form .list-select-wrap .nf-field-element .ninja-forms-field' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .theplus-ninja-form .nf-field-element input[type="text"],
				{{WRAPPER}} .theplus-ninja-form .nf-field-element input[type="email"],
				{{WRAPPER}} .theplus-ninja-form .nf-field-element input[type="number"],
				{{WRAPPER}} .theplus-ninja-form .nf-field-element input[type="tel"],
				{{WRAPPER}} .theplus-ninja-form .nf-field-element select' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'input_field_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .theplus-ninja-form .nf-field-element input[type="text"],
				{{WRAPPER}} .theplus-ninja-form .nf-field-element input[type="email"],
				{{WRAPPER}} .theplus-ninja-form .nf-field-element input[type="number"],
				{{WRAPPER}} .theplus-ninja-form .nf-field-element input[type="tel"],
				{{WRAPPER}} .theplus-ninja-form .list-select-wrap .nf-field-element select',
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
					'{{WRAPPER}} .theplus-ninja-form .nf-field-element input[type="text"]:focus,
				{{WRAPPER}} .theplus-ninja-form .nf-field-element input[type="email"]:focus,
				{{WRAPPER}} .theplus-ninja-form .nf-field-element input[type="number"]:focus,
				{{WRAPPER}} .theplus-ninja-form .nf-field-element input[type="tel"]:focus,
				{{WRAPPER}} .theplus-ninja-form .list-select-wrap:focus .nf-field-element select' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'input_field_focus_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .theplus-ninja-form .nf-field-element input[type="text"]:focus,
				{{WRAPPER}} .theplus-ninja-form .nf-field-element input[type="email"]:focus,
				{{WRAPPER}} .theplus-ninja-form .nf-field-element input[type="number"]:focus,
				{{WRAPPER}} .theplus-ninja-form .nf-field-element input[type="tel"]:focus,
				{{WRAPPER}} .theplus-ninja-form .list-select-wrap:focus .nf-field-element select',
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
					'{{WRAPPER}} .theplus-ninja-form .nf-field-element input[type="text"],
				{{WRAPPER}} .theplus-ninja-form .nf-field-element input[type="email"],
				{{WRAPPER}} .theplus-ninja-form .nf-field-element input[type="number"],
				{{WRAPPER}} .theplus-ninja-form .nf-field-element input[type="tel"],
				{{WRAPPER}} .theplus-ninja-form .nf-field-element select' => 'border-style: {{VALUE}};',
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
					'{{WRAPPER}} .theplus-ninja-form .nf-field-element input[type="text"],
				{{WRAPPER}} .theplus-ninja-form .nf-field-element input[type="email"],
				{{WRAPPER}} .theplus-ninja-form .nf-field-element input[type="number"],
				{{WRAPPER}} .theplus-ninja-form .nf-field-element input[type="tel"],
				{{WRAPPER}} .theplus-ninja-form .nf-field-element select' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .theplus-ninja-form .nf-field-element input[type="text"],
				{{WRAPPER}} .theplus-ninja-form .nf-field-element input[type="email"],
				{{WRAPPER}} .theplus-ninja-form .nf-field-element input[type="number"],
				{{WRAPPER}} .theplus-ninja-form .nf-field-element input[type="tel"],
				{{WRAPPER}} .theplus-ninja-form .nf-field-element select' => 'border-color: {{VALUE}};',
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
					'{{WRAPPER}} .theplus-ninja-form .nf-field-element input[type="text"],
				{{WRAPPER}} .theplus-ninja-form .nf-field-element input[type="email"],
				{{WRAPPER}} .theplus-ninja-form .nf-field-element input[type="number"],
				{{WRAPPER}} .theplus-ninja-form .nf-field-element input[type="tel"],
				{{WRAPPER}} .theplus-ninja-form .nf-field-element select' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .theplus-ninja-form .nf-field-element input[type="text"]:focus,
				{{WRAPPER}} .theplus-ninja-form .nf-field-element input[type="email"]:focus,
				{{WRAPPER}} .theplus-ninja-form .nf-field-element input[type="number"]:focus,
				{{WRAPPER}} .theplus-ninja-form .nf-field-element input[type="tel"]:focus,
				{{WRAPPER}} .theplus-ninja-form .nf-field-element select:focus' => 'border-color: {{VALUE}};',
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
					'{{WRAPPER}} .theplus-ninja-form .nf-field-element input[type="text"]:focus,
				{{WRAPPER}} .theplus-ninja-form .nf-field-element input[type="email"]:focus,
				{{WRAPPER}} .theplus-ninja-form .nf-field-element input[type="number"]:focus,
				{{WRAPPER}} .theplus-ninja-form .nf-field-element input[type="tel"]:focus,
				{{WRAPPER}} .theplus-ninja-form .nf-field-element select:focus' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .theplus-ninja-form .nf-field-element input[type="text"],
				{{WRAPPER}} .theplus-ninja-form .nf-field-element input[type="email"],
				{{WRAPPER}} .theplus-ninja-form .nf-field-element input[type="number"],
				{{WRAPPER}} .theplus-ninja-form .nf-field-element input[type="tel"],
				{{WRAPPER}} .theplus-ninja-form .nf-field-element select',
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
				'selector' => '{{WRAPPER}} .theplus-ninja-form .nf-field-element input[type="text"]:focus,
				{{WRAPPER}} .theplus-ninja-form .nf-field-element input[type="email"]:focus,
				{{WRAPPER}} .theplus-ninja-form .nf-field-element input[type="number"]:focus,
				{{WRAPPER}} .theplus-ninja-form .nf-field-element input[type="tel"]:focus,
				{{WRAPPER}} .theplus-ninja-form .nf-field-element select:focus',
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
					'{{WRAPPER}} .theplus-ninja-form .nf-field-element textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_responsive_control(
			'textarea_inner_margin',
			array(
				'label'      => esc_html__( 'Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-ninja-form .nf-field-element textarea' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'textarea_typography',
				'selector' => '{{WRAPPER}} .theplus-ninja-form .nf-field-element textarea',
			)
		);
		$this->add_control(
			'textarea_placeholder_color',
			array(
				'label'     => esc_html__( 'Placeholder Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .nf-form-content  textarea::-webkit-input-placeholder' => 'color: {{VALUE}};',
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
							'{{WRAPPER}} .theplus-ninja-form .nf-field-element textarea' => 'color: {{VALUE}};',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Background::get_type(),
					array(
						'name'     => 'textarea_field_bg',
						'types'    => array( 'classic', 'gradient' ),
						'selector' => '{{WRAPPER}} .theplus-ninja-form .nf-field-element textarea',
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
							'{{WRAPPER}} .theplus-ninja-form .nf-field-element textarea:focus' => 'color: {{VALUE}};',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Background::get_type(),
					array(
						'name'     => 'textarea_field_focus_bg',
						'types'    => array( 'classic', 'gradient' ),
						'selector' => '{{WRAPPER}} .theplus-ninja-form .nf-field-element textarea:focus',
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
					'{{WRAPPER}} .theplus-ninja-form .nf-field-element textarea' => 'border-style: {{VALUE}};',
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
					'{{WRAPPER}} .theplus-ninja-form .nf-field-element textarea' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
							'{{WRAPPER}} .theplus-ninja-form .nf-field-element textarea' => 'border-color: {{VALUE}};',
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
							'{{WRAPPER}} .theplus-ninja-form .nf-field-element textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
							'{{WRAPPER}} .theplus-ninja-form .nf-field-element textarea:focus' => 'border-color: {{VALUE}};',
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
							'{{WRAPPER}} .theplus-ninja-form .nf-field-element textarea:focus' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .theplus-ninja-form .nf-field-element textarea',
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
				'selector' => '{{WRAPPER}} .theplus-ninja-form .nf-field-element textarea:focus',
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
				'selector' => '{{WRAPPER}} .theplus-ninja-form .field-wrap.listcheckbox-wrap .nf-field-element label',
			)
		);
		$this->add_control(
			'checked_field_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .theplus-ninja-form .field-wrap.listcheckbox-wrap .nf-field-element label' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .theplus-ninja-form .field-wrap.listcheckbox-wrap .nf-field-element label:before,{{WRAPPER}} .theplus-ninja-form .field-wrap.checkbox-wrap .nf-field-label label:before' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'checked_uncheck_color',
			array(
				'label'     => esc_html__( 'UnChecked Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .theplus-ninja-form .checkbox-wrap .nf-field-element li label:before,
					{{WRAPPER}} .theplus-ninja-form .listcheckbox-wrap .nf-field-element li label:before' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'checked_field_color',
			array(
				'label'     => esc_html__( 'Checked Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .theplus-ninja-form .checkbox-wrap .nf-field-element label.nf-checked-label:before,
					{{WRAPPER}} .theplus-ninja-form .checkbox-wrap .nf-field-label label.nf-checked-label:before,
					{{WRAPPER}} .theplus-ninja-form .listcheckbox-wrap .nf-field-element label.nf-checked-label:before,
					{{WRAPPER}} .theplus-ninja-form .listcheckbox-wrap .nf-field-label label.nf-checked-label:before' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'unchecked_field_bgcolor',
			array(
				'label'     => esc_html__( 'UnChecked Bg Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .theplus-ninja-form .checkbox-wrap .nf-field-element li label:before,
					{{WRAPPER}} .theplus-ninja-form .listcheckbox-wrap .nf-field-element li label:before' => 'background: {{VALUE}};',
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
					'{{WRAPPER}} .theplus-ninja-form .checkbox-wrap .nf-field-element label.nf-checked-label:before,
					{{WRAPPER}} .theplus-ninja-form .checkbox-wrap .nf-field-label label.nf-checked-label:before,
					{{WRAPPER}} .theplus-ninja-form .listcheckbox-wrap .nf-field-element label.nf-checked-label:before,
					{{WRAPPER}} .theplus-ninja-form .listcheckbox-wrap .nf-field-label label.nf-checked-label:before' => 'background: {{VALUE}};',
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
					'{{WRAPPER}} .theplus-ninja-form .checkbox-wrap .nf-field-element li label:before,
					{{WRAPPER}} .theplus-ninja-form .listcheckbox-wrap .nf-field-element li label:before' => 'border-style: {{VALUE}};',
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
					'{{WRAPPER}} .theplus-ninja-form .checkbox-wrap .nf-field-element li label:before,
					{{WRAPPER}} .theplus-ninja-form .listcheckbox-wrap .nf-field-element li label:before' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} {{WRAPPER}} .theplus-ninja-form .checkbox-wrap .nf-field-element li label:before,
					{{WRAPPER}} .theplus-ninja-form .listcheckbox-wrap .nf-field-element li label:before' => 'border-color: {{VALUE}};',
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
					'{{WRAPPER}} .theplus-ninja-form .checkbox-wrap .nf-field-element li label:before,
					{{WRAPPER}} .theplus-ninja-form .listcheckbox-wrap .nf-field-element li label:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_radio_field',
			array(
				'label' => esc_html__( 'Radio Button', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'radio_text_typography',
				'selector' => '{{WRAPPER}} .theplus-ninja-form .field-wrap.listradio-wrap .nf-field-element label',
			)
		);
		$this->add_control(
			'radio_field_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .theplus-ninja-form .field-wrap.listradio-wrap .nf-field-element label' => 'color: {{VALUE}};',
				),
				'separator' => 'after',
			)
		);
		$this->add_control(
			'radio_uncheck_color',
			array(
				'label'     => esc_html__( 'UnChecked Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .listradio-wrap .nf-field-element label:after' => 'color: {{VALUE}};',
					'{{WRAPPER}} .listradio-wrap .nf-field-element label:after' => 'border:2px solid {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'radio_field_color',
			array(
				'label'     => esc_html__( 'Checked Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .listradio-wrap .nf-field-element label.nf-checked-label:before' => 'background: {{VALUE}};',
					'{{WRAPPER}} .listradio-wrap .nf-field-element label.nf-checked-label:after' => 'border-color: {{VALUE}};',
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
				'label'       => esc_html__( 'Maximum Width', 'tpebl' ),
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
					'{{WRAPPER}} .theplus-ninja-form .field-wrap input[type=button]' => 'max-width: {{SIZE}}{{UNIT}}',
				),
				'separator'   => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'button_typography',
				'selector' => '{{WRAPPER}} .theplus-ninja-form .field-wrap input[type=button]',
			)
		);
		$this->add_responsive_control(
			'button_inner_padding',
			array(
				'label'      => esc_html__( 'Inner Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-ninja-form .field-wrap input[type=button]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);
		$this->add_responsive_control(
			'button_margin',
			array(
				'label'      => esc_html__( 'Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-ninja-form .field-wrap input[type=button]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .theplus-ninja-form .field-wrap input[type=button]' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'button_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .theplus-ninja-form .field-wrap input[type=button]',
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
					'{{WRAPPER}} .theplus-ninja-form .field-wrap:hover input[type=button]' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'button_hover_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .theplus-ninja-form .field-wrap:hover input[type=button]',
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
					'{{WRAPPER}} .theplus-ninja-form .field-wrap input[type=button]' => 'border-style: {{VALUE}};',
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
					'{{WRAPPER}} .theplus-ninja-form .field-wrap input[type=button]' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .theplus-ninja-form .field-wrap input[type=button]' => 'border-color: {{VALUE}};',
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
					'{{WRAPPER}} .theplus-ninja-form .field-wrap input[type=button]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
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
					'{{WRAPPER}} .theplus-ninja-form .field-wrap:hover input[type=button]' => 'border-color: {{VALUE}};',
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
					'{{WRAPPER}} .theplus-ninja-form .field-wrap:hover input[type=button]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
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
				'selector' => '{{WRAPPER}} .theplus-ninja-form .field-wrap input[type=button]',
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
				'selector' => '{{WRAPPER}} .theplus-ninja-form .field-wrap:hover input[type=button]',
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
			'oute_r_inner_padding',
			array(
				'label'      => esc_html__( 'Inner Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-ninja-form.style-1 .nf-field-container:not(.submit-container)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'oute_r_inner_margin',
			array(
				'label'      => esc_html__( 'Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-ninja-form.style-1 .nf-field-container:not(.submit-container)' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_control(
			'oute_r_color',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .theplus-ninja-form.style-1 label,.theplus-ninja-form.style-1 .nf-form-layout .nf-field-label label,{{WRAPPER}} .theplus-ninja-form.style-1 .nf-error-msg,
                    .theplus-ninja-form.style-1 .ninja-forms-req-symbol,{{WRAPPER}} .theplus-ninja-form.style-1 span' => 'color: {{VALUE}};',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_bg_style' );
			$this->start_controls_tab(
				'tabs_bg_style_normal',
				array(
					'label' => esc_html__( 'Normal', 'tpebl' ),
				)
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				array(
					'name'     => 'oute_r_field_bg',
					'types'    => array( 'classic', 'gradient' ),
					'selector' => '{{WRAPPER}} .theplus-ninja-form.style-1 .nf-field-container:not(.submit-container)',
				)
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'     => 'oute_r__border',
					'label'    => esc_html__( 'Border', 'tpebl' ),
					'selector' => '{{WRAPPER}} .theplus-ninja-form.style-1 .nf-field-container:not(.submit-container)',
				)
			);
			$this->add_responsive_control(
				'oute_r_border_radius',
				array(
					'label'      => esc_html__( 'Border Radius', 'tpebl' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .theplus-ninja-form.style-1 .nf-field-container:not(.submit-container)' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'     => 'oute_r_shadow',
					'selector' => '{{WRAPPER}} .theplus-ninja-form.style-1 .nf-field-container:not(.submit-container)',
				)
			);
			$this->end_controls_tab();

			$this->start_controls_tab(
				'tabs_bg_style_hover',
				array(
					'label' => esc_html__( 'Hover', 'tpebl' ),
				)
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				array(
					'name'     => 'oute_r_field_bg_hover',
					'types'    => array( 'classic', 'gradient' ),
					'selector' => '{{WRAPPER}} .theplus-ninja-form.style-1 .nf-field-container:not(.submit-container):hover',
				)
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'     => 'oute_r__border_hover',
					'label'    => esc_html__( 'Border', 'tpebl' ),
					'selector' => '{{WRAPPER}} .theplus-ninja-form.style-1 .nf-field-container:not(.submit-container):hover',
				)
			);
			$this->add_responsive_control(
				'oute_r_border_radius_hover',
				array(
					'label'      => esc_html__( 'Border Radius', 'tpebl' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .theplus-ninja-form.style-1 .nf-field-container:not(.submit-container):hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'     => 'oute_r_shadow_hover',
					'selector' => '{{WRAPPER}} .theplus-ninja-form.style-1 .nf-field-container:not(.submit-container):hover',
				)
			);
			$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_outer_styling',
			array(
				'label' => esc_html__( 'Form Container', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'outer_inner_padding',
			array(
				'label'      => esc_html__( 'Inner Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-ninja-form.style-1' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'outer_inner_margin',
			array(
				'label'      => esc_html__( 'Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-ninja-form.style-1' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->start_controls_tabs( 'tabs_outer_field_style' );
		$this->start_controls_tab(
			'tab_outer_field_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'outer_field_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .theplus-ninja-form.style-1',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_outer_field_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'outer_field_focus_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .theplus-ninja-form.style-1:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'outer_border_options',
			array(
				'label'     => esc_html__( 'Border Options', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'outer_box_border',
			array(
				'label'     => esc_html__( 'Box Border', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'default'   => 'no',
			)
		);

		$this->add_control(
			'outer_border_style',
			array(
				'label'     => esc_html__( 'Border Style', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'solid',
				'options'   => l_theplus_get_border_style(),
				'selectors' => array(
					'{{WRAPPER}} .theplus-ninja-form.style-1' => 'border-style: {{VALUE}};',
				),
				'condition' => array(
					'outer_box_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'outer_box_border_width',
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
					'{{WRAPPER}} .theplus-ninja-form.style-1' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'outer_box_border' => 'yes',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_outer_border_style' );
		$this->start_controls_tab(
			'tab_outer_border_normal',
			array(
				'label'     => esc_html__( 'Normal', 'tpebl' ),
				'condition' => array(
					'outer_box_border' => 'yes',
				),
			)
		);
		$this->add_control(
			'outer_box_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .theplus-ninja-form.style-1' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'outer_box_border' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'outer_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-ninja-form.style-1' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'outer_box_border' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_outer_border_hover',
			array(
				'label'     => esc_html__( 'Hover', 'tpebl' ),
				'condition' => array(
					'outer_box_border' => 'yes',
				),
			)
		);
		$this->add_control(
			'outer_box_border_hover_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .theplus-ninja-form.style-1:hover' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'outer_box_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'outer_border_hover_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-ninja-form.style-1:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'outer_shadow_options',
			array(
				'label'     => esc_html__( 'Box Shadow Options', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->start_controls_tabs( 'tabs_outer_shadow_style' );
		$this->start_controls_tab(
			'tab_outer_shadow_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'outer_box_shadow',
				'selector' => '{{WRAPPER}} .theplus-ninja-form.style-1',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_outer_shadow_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'outer_box_active_shadow',
				'selector' => '{{WRAPPER}} .theplus-ninja-form.style-1:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_response_msg_styling',
			array(
				'label' => esc_html__( 'Response Message', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'response_msg_typography',
				'selector' => '{{WRAPPER}} .nf-form-wrap .nf-response-msg',
			)
		);
		$this->add_responsive_control(
			'response_msg_padding',
			array(
				'label'      => esc_html__( 'Inner Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .nf-form-wrap .nf-response-msg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);
		$this->add_responsive_control(
			'response_msg_margin',
			array(
				'label'      => esc_html__( 'Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .nf-form-wrap .nf-response-msg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->start_controls_tabs( 'tabs_response_style' );
		$this->start_controls_tab(
			'tab_response_success',
			array(
				'label' => esc_html__( 'Success', 'tpebl' ),
			)
		);
		$this->add_control(
			'response_success_color',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .nf-form-wrap .nf-response-msg p' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'response_success_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .nf-form-wrap .nf-response-msg',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_response_validate',
			array(
				'label' => esc_html__( 'Validation', 'tpebl' ),
			)
		);
		$this->add_control(
			'response_validate_color',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .nf-form-wrap .nf-form-errors,{{WRAPPER}} .nf-form-wrap .nf-error-msg.nf-error-field-errors' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'response_validate_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .nf-form-wrap .nf-form-errors',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'response_box_border',
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
			'response_border_style',
			array(
				'label'     => esc_html__( 'Border Style', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'solid',
				'options'   => l_theplus_get_border_style(),
				'selectors' => array(
					'{{WRAPPER}} .nf-form-wrap .nf-response-msg' => 'border-style: {{VALUE}};',
				),
				'condition' => array(
					'response_box_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'response_msg_border_width',
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
					'{{WRAPPER}} .nf-form-wrap .nf-response-msg' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'response_box_border' => 'yes',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_response_msg' );
		$this->start_controls_tab(
			'tab_response_msg_success',
			array(
				'label' => esc_html__( 'Success', 'tpebl' ),
			)
		);
		$this->add_control(
			'success_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .nf-form-wrap .nf-response-msg' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'response_box_border' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'success_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .nf-form-wrap .nf-response-msg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_response_msg_validate',
			array(
				'label' => esc_html__( 'Validation', 'tpebl' ),
			)
		);
		$this->add_control(
			'validate_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .nf-form-wrap .nf-form-errors' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'response_box_border' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'validate_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .nf-form-wrap .nf-form-errors' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
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
					'{{WRAPPER}} .theplus-ninja-form.style-1' => 'max-width: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
			'required_field_inner_padding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-ninja-form.style-1 .nf-error-msg.nf-error-required-error,{{WRAPPER}} .theplus-ninja-form.style-1 .nf-error-msg.nf-error-field-errors' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_control(
			'required_field_color',
			array(
				'label'     => esc_html__( 'Required Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .theplus-ninja-form.style-1 .nf-error-msg.nf-error-required-error,{{WRAPPER}} .theplus-ninja-form.style-1 .nf-error-msg.nf-error-field-errors' => 'color: {{VALUE}};',
					'{{WRAPPER}} .theplus-ninja-form.style-1 .nf-error .ninja-forms-field,{{WRAPPER}} .theplus-ninja-form.style-1 .nf-error-msg.nf-error-field-errors' => 'border:1px solid {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'required_field_bgcolor',
			array(
				'label'     => esc_html__( 'Required Background Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .theplus-ninja-form.style-1 .nf-error-msg.nf-error-required-error' => 'background: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'required_field_border_color',
			array(
				'label'     => esc_html__( 'Required Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .theplus-ninja-form.style-1 .nf-error-msg.nf-error-required-error' => 'border:1px solid {{VALUE}};',
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
	 * Ninja Form Render.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function render() {
		$settings   = $this->get_settings_for_display();
		$form_style = ! empty( $settings['form_style'] ) ? $settings['form_style'] : '';

		$out_speed = ! empty( $settings['animation_out_duration']['size'] ) ? $settings['animation_out_duration']['size'] : 50;
		$out_delay = ! empty( $settings['animation_out_delay']['size'] ) ? $settings['animation_out_delay']['size'] : 50;

		$out_effect   = ! empty( $settings['animation_out_effects'] ) ? $settings['animation_out_effects'] : '';
		$ani_duration = ! empty( $settings['animation_duration_default'] ) ? $settings['animation_duration_default'] : '';
		$out_duration = ! empty( $settings['animation_out_duration_default'] ) ? $settings['animation_out_duration_default'] : '';

		$animation_delay  = ( ! empty( $settings['animation_delay']['size'] ) ) ? $settings['animation_delay']['size'] : 50;
		$animate_duration = ! empty( $settings['animate_duration']['size'] ) ? $settings['animate_duration']['size'] : 50;

		$animation_effects = ! empty( $settings['animation_effects'] ) ? $settings['animation_effects'] : '';

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

		$this->add_render_attribute(
			'contact-form',
			'class',
			array(
				'theplus-contact-form',
				'theplus-ninja-form',
			)
		);

		$this->add_render_attribute(
			'contact-form',
			'id',
			array(
				'theplus-ninja-form-' . get_the_ID(),
			)
		);

		$output      = '<div class="theplus-ninja-form ' . esc_attr( $form_style ) . ' ' . esc_attr( $animated_class ) . '" ' . $animation_attr . '>';
			$output .= do_shortcode( $this->get_shortcode() );
		$output     .= '</div>';

		echo $output;
	}

	/**
	 * Ninja Form shortcode.
	 *
	 * @version 5.4.2
	 */
	private function get_shortcode() {
		$settings = $this->get_settings_for_display();
		$c_form   = ! empty( $settings['contact_form'] ) ? $settings['contact_form'] : '';

		if ( ! $c_form ) {
			return '<h3 class="theplus-posts-not-found">' . esc_html__( 'Please select a Ninja Form', 'tpebl' ) . '</h3>';
		}

		$attributes = array(
			'id' => $c_form,
		);

		$this->add_render_attribute( 'form_shortcode', $attributes );

		$shortcode   = array();
		$shortcode[] = sprintf( '[ninja_form %s]', $this->get_render_attribute_string( 'form_shortcode' ) );

		return implode( '', $shortcode );
	}

	/**
	 * Get Ninja Form.
	 *
	 * @since 1.0.1
	 * @version 5.5.2
	 */
	function l_theplus_get_ninja_form_post() {
		$options = array();
		if ( class_exists( 'Ninja_Forms' ) ) {
			$contact_forms = Ninja_Forms()->form()->get_forms();

			if ( ! empty( $contact_forms ) && ! is_wp_error( $contact_forms ) ) {

				$options[0] = esc_html__( 'Select Ninja Form', 'tpebl' );

				foreach ( $contact_forms as $form ) {   
					$options[ $form->get_id() ] = $form->get_setting( 'title' );
				}
			}
		} else {
			$options[0] = esc_html__( 'Create a Form First', 'tpebl' );
		}
		return $options;
	}
}