<?php
/**
 * Widget Name: Gravity Form
 * Description: Third party plugin Gravity Form style.
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
 * Class L_ThePlus_Gravity_Form
 */
class L_ThePlus_Gravity_Form extends Widget_Base {

	/**
	 * Document Link For Need help.
	 *
	 * @var tp_doc of the class.
	 * @since 1.0.1
	 * @version 5.4.2
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
		return 'tp-gravityt-form';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Gravity Form', 'tpebl' );
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
		return array( 'Gravity Forms', 'Form Builder', 'Contact Form', 'WordPress Forms', 'Elementor Forms' );
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
	 * Register controls.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Gravity Form', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'gravity_form',
			array(
				'label'     => esc_html__( 'Select Form', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '0',
				'options'   => $this->l_theplus_gravity_form(),
				'condition' => array(
					'select' => 'gf_default',
				),
			)
		);
		$this->add_control(
			'gravity_form_dm',
			array(
				'label'     => esc_html__( 'Select Form', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => $this->l_theplus_gravity_form_using_dm(),
				'condition' => array(
					'select' => 'gf_dmp',
				),
			)
		);
		$this->add_control(
			'title_hide',
			array(
				'label'     => esc_html__( 'Title', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'ajax',
			array(
				'label'     => esc_html__( 'Ajax Form Submit', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'extra_options_section',
			array(
				'label' => esc_html__( 'Extra Options', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'select',
			array(
				'label'   => esc_html__( 'Compatibility', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'gf_default',
				'options' => array(
					'gf_default' => esc_html__( 'Gravity Form', 'tpebl' ),
					'gf_dmp'     => esc_html__( 'Download Monitor', 'tpebl' ),
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_form_heading',
			array(
				'label' => esc_html__( 'Form Heading & Description', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'form_heading_typography',
				'selector' => '{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gform_heading .gform_title',
			)
		);
		$this->add_control(
			'form_heading_color',
			array(
				'label'     => esc_html__( 'Form Heading', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gform_heading .gform_title' => 'color: {{VALUE}}',
				),
				'separator' => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'form_h_desc_typ',
				'selector' => '{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gform_heading .gform_description',
			)
		);
		$this->add_control(
			'form_h_desc_color',
			array(
				'label'     => esc_html__( 'Description', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gform_heading .gform_description' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_responsive_control(
			'form_h_desc_bottom_space',
			array(
				'label'      => esc_html__( 'Bottom space', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gform_description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'form_heading_align',
			array(
				'label'     => esc_html__( 'Alignment', 'tpebl' ),
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
				'separator' => 'before',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gform_heading' => 'text-align:{{VALUE}};',
				),
				'toggle'    => true,
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_head',
			array(
				'label' => esc_html__( 'Heading Styling', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'f_head_bottom_space',
			array(
				'label'      => esc_html__( 'Bottom space', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gsection' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'f_head_typography',
				'selector' => '{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gsection_title',
			)
		);
		$this->add_control(
			'f_head_color',
			array(
				'label'     => esc_html__( 'Heading Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gsection_title' => 'color: {{VALUE}}',
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
				'selector' => '{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield_label,
				{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .ginput_full label,
				{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .ginput_left label,
				{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .ginput_right label,
				{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .address_city label,
				{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .address_zip label,
				{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .address_country label',
			)
		);
		$this->add_control(
			'label_color',
			array(
				'label'     => esc_html__( 'Label Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield_label,
					{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .ginput_full label,
					{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .ginput_left label,
					{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .ginput_right label,
					{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .address_city label,
					{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .address_zip label,
					{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .address_country label' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'inline_sub_label_head',
			array(
				'label'     => esc_html__( 'Sub Label', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'inline_sub_label_typography',
				'selector' => '{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .name_prefix label,
					{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .name_first label,
					{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .name_middle label,
					{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .name_last label,
					{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .name_suffix label,
					{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .ginput_container.ginput_container_email label',
			)
		);
		$this->add_control(
			'inline_sub_label_color',
			array(
				'label'     => esc_html__( 'Sub Label Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .name_prefix label,
					{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .name_first label,
					{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .name_middle label,
					{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .name_last label,
					{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .name_suffix label,
					{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .ginput_container.ginput_container_email label' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'sub_label_desc_typography',
				'selector' => '{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield_description,
					{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper span.gf_step_number,
					{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gsection_description,
					{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper span.ginput_product_price_label,
					{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper span.ginput_quantity_label',
			)
		);
		$this->add_control(
			'sub_label_color',
			array(
				'label'     => esc_html__( 'Description Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield_description,
					{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper span.gf_step_number,
					{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gsection_description,
					{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper span.ginput_product_price_label,
					{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper span.ginput_quantity_label' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'max_char_color',
			array(
				'label'     => esc_html__( 'Max Character Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .charleft.ginput_counter' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'req_symbol_color',
			array(
				'label'     => esc_html__( 'Required Symbol', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield_required' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_responsive_control(
			'progress_bar_size',
			array(
				'label'      => esc_html__( 'Progress Bar Text Size', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 5,
						'max' => 1500,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gf_progressbar_title' => 'font-size: {{SIZE}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);
		$this->add_control(
			'progress_bar_text_color',
			array(
				'label'     => esc_html__( 'Progress Bar Text', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gf_progressbar_title' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_responsive_control(
			'progress_bar_border_size',
			array(
				'label'      => esc_html__( 'Progress Bar Border Size', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 5,
						'max' => 1500,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gf_progressbar' => 'padding: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'progress_bar_color',
			array(
				'label'     => esc_html__( 'Progress Bar Border', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gf_progressbar' => 'background-color: {{VALUE}}',
				),
				'separator' => 'after',
			)
		);
		$this->add_control(
			'price_color',
			array(
				'label'     => esc_html__( 'Price', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .ginput_product_price,{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .ginput_shipping_price,{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .ginput_total' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'consent_color',
			array(
				'label'     => esc_html__( 'consent', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield_consent_label' => 'color: {{VALUE}}',
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
				'selector' => '{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="text"],
				{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper select,{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="email"],{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="tel"],{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="url"]',
			)
		);
		$this->add_control(
			'input_placeholder_color',
			array(
				'label'     => esc_html__( 'Placeholder Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input::-webkit-input-placeholder,
					{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper  select::-webkit-input-placeholder' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield .ginput_container input[type="text"],{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield .ginput_container select,{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="email"],{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="tel"],{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="url"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield .ginput_container input[type="text"],{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield .ginput_container select,{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="email"],{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="tel"],{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="url"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield .ginput_container input[type="text"],
					{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield .ginput_container select,{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="email"],{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="tel"],{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="url"]' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'input_field_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield .ginput_container input[type="text"],
					{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield .ginput_container select,{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="email"],{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="tel"],{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="url"]',
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
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield .ginput_container input[type="text"]:focus,
					{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield .ginput_container select:focus,{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="email"]:focus,{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="tel"]:focus,{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="url"]:focus' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'input_field_focus_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield .ginput_container input[type="text"]:focus,
					{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield .ginput_container select:focus,{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="email"]:focus,{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="tel"]:focus,{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="url"]:focus',
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
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield .ginput_container input[type="text"],
					{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield .ginput_container select,{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="email"],{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="tel"],{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="url"]' => 'border-style: {{VALUE}};',
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
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield .ginput_container input[type="text"],
					{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield .ginput_container select,{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="email"],{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="tel"],{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="url"]' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield .ginput_container input[type="text"],
					{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield .ginput_container select,{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="email"],{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="tel"],{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="url"]' => 'border-color: {{VALUE}};',
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
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield .ginput_container input[type="text"],
					{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield .ginput_container select,{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="email"],{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="tel"],{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="url"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield .ginput_container input[type="text"]:focus,
					{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield .ginput_container select:focus,{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="email"]:focus,{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="tel"]:focus,{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="url"]:focus' => 'border-color: {{VALUE}};',
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
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield .ginput_container input[type="text"]:focus,
					{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield .ginput_container select:focus,{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="email"]:focus,{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="tel"]:focus,{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="url"]:focus' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield .ginput_container input[type="text"],
					{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield .ginput_container select,{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="email"],{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="tel"],{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="url"]',
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
				'selector' => '{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield .ginput_container input[type="text"]:focus,
					{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield .ginput_container select:focus,{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="email"]:focus,{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="tel"]:focus,{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="url"]:focus',
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
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield .ginput_container textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield .ginput_container textarea' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'textarea_typography',
				'selector' => '{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield .ginput_container textarea',
			)
		);
		$this->add_control(
			'textarea_placeholder_color',
			array(
				'label'     => esc_html__( 'Placeholder Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield .ginput_container  textarea::-webkit-input-placeholder' => 'color: {{VALUE}};',
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
							'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield .ginput_container textarea' => 'color: {{VALUE}};',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Background::get_type(),
					array(
						'name'     => 'textarea_field_bg',
						'types'    => array( 'classic', 'gradient' ),
						'selector' => '{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield .ginput_container textarea',
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
							'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield .ginput_container textarea:focus' => 'color: {{VALUE}};',
						),
					)
				);
				$this->add_group_control(
					Group_Control_Background::get_type(),
					array(
						'name'     => 'textarea_field_focus_bg',
						'types'    => array( 'classic', 'gradient' ),
						'selector' => '{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield .ginput_container textarea:focus',
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
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield .ginput_container textarea' => 'border-style: {{VALUE}};',
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
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield .ginput_container textarea' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
							'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield .ginput_container textarea' => 'border-color: {{VALUE}};',
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
							'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield .ginput_container textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
							'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield .ginput_container textarea:focus' => 'border-color: {{VALUE}};',
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
							'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield .ginput_container textarea:focus' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield .ginput_container textarea',
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
				'selector' => '{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield .ginput_container textarea:focus',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_select',
			array(
				'label' => esc_html__( 'Select Fields Styling', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'section_style_select_height',
			array(
				'label'     => esc_html__( 'Height Auto', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => __( 'Enable', 'tpebl' ),
				'label_off' => __( 'Disable', 'tpebl' ),
				'default'   => 'no',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield .ginput_container select' => 'height: auto;',
				),
			)
		);
		$this->add_responsive_control(
			'section_style_select_padding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield .ginput_container select' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
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
				'selector' => '{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield_checkbox label',
			)
		);

		$this->add_control(
			'checked_field_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield_checkbox label' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .ginput_container_checkbox span.gravity_checkbox_label:before' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'checked_uncheck_color',
			array(
				'label'     => esc_html__( 'UnChecked Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .ginput_container_checkbox span.gravity_checkbox_label:before' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'checked_field_color',
			array(
				'label'     => esc_html__( 'Checked Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .ginput_container_checkbox input[type=checkbox]:checked + label span.gravity_checkbox_label:before' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'unchecked_field_bgcolor',
			array(
				'label'     => esc_html__( 'UnChecked Bg Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .ginput_container_checkbox input[type=checkbox] + label span.gravity_checkbox_label' => 'background: {{VALUE}};',
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
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .ginput_container_checkbox input[type=checkbox]:checked + label span.gravity_checkbox_label' => 'background: {{VALUE}};',
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
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .ginput_container_checkbox span.gravity_checkbox_label' => 'border-style: {{VALUE}};',
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
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .ginput_container_checkbox span.gravity_checkbox_label' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .ginput_container_checkbox span.gravity_checkbox_label' => 'border-color: {{VALUE}};',
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
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .ginput_container_checkbox span.gravity_checkbox_label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'check_box_border' => 'yes',
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
				'selector' => '{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield_radio label',
			)
		);
		$this->add_control(
			'radio_field_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield_radio label' => 'color: {{VALUE}};',
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
						'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .ginput_container_radio span.gravity_radio_label:before' => 'font-size: {{SIZE}}{{UNIT}};',
					),
				)
			);
		$this->add_control(
			'radio_uncheck_color',
			array(
				'label'     => esc_html__( 'UnChecked Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .ginput_container_radio span.gravity_radio_label:before' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'radio_field_color',
			array(
				'label'     => esc_html__( 'Checked Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .ginput_container_radio input[type=radio]:checked + label span.gravity_radio_label:before' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'radio_unchecked_field_bgcolor',
			array(
				'label'     => esc_html__( 'UnChecked Bg Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .ginput_container_radio input[type=radio] + label span.gravity_radio_label' => 'background: {{VALUE}};',
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
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .ginput_container_radio input[type=radio]:checked + label span.gravity_radio_label' => 'background: {{VALUE}};',
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
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .ginput_container_radio span.gravity_radio_label' => 'border-style: {{VALUE}};',
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
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .ginput_container_radio span.gravity_radio_label' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .ginput_container_radio span.gravity_radio_label' => 'border-color: {{VALUE}};',
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
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .ginput_container_radio span.gravity_radio_label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .ginput_container_fileupload' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .ginput_container_fileupload' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'file_typography',
				'selector' => '{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .ginput_container_fileupload input[type="file"]',
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
						'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .ginput_container_fileupload input[type="file"]' => 'color: {{VALUE}};',
					),
				)
			);
			$this->add_control(
				'file_bg_color',
				array(
					'label'     => esc_html__( 'Background', 'tpebl' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .ginput_container_fileupload input[type="file"]' => 'background: {{VALUE}};',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'     => 'file_border',
					'label'    => esc_html__( 'Border', 'tpebl' ),
					'selector' => '{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .ginput_container_fileupload input[type="file"]',
				)
			);
			$this->add_responsive_control(
				'file_border_radius',
				array(
					'label'      => esc_html__( 'Border Radius', 'tpebl' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .ginput_container_fileupload input[type="file"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'     => 'file_shadow',
					'selector' => '{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .ginput_container_fileupload input[type="file"]',
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
						'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .ginput_container_fileupload input[type="file"]:hover' => 'color: {{VALUE}};',
					),
				)
			);
			$this->add_control(
				'file_bg_color_hover',
				array(
					'label'     => esc_html__( 'Background', 'tpebl' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .ginput_container_fileupload input[type="file"]:hover' => 'background: {{VALUE}};',
					),
				)
			);
			$this->add_control(
				'file_border_color_hover',
				array(
					'label'     => esc_html__( 'Border Color', 'tpebl' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .ginput_container_fileupload input[type="file"]:hover' => 'border-color: {{VALUE}};',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'     => 'file_hover_shadow',
					'selector' => '{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .ginput_container_fileupload input[type="file"]:hover',
				)
			);
			$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'enable_multi_file_upload',
			array(
				'label'     => esc_html__( 'Enable Multi-File Upload', 'tpebl' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'multi_file_upload_switch',
			array(
				'label'     => esc_html__( 'Multi-File Upload Style', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'default'   => 'no',
			)
		);
		$this->add_responsive_control(
			'multi_file_upload_text_typo',
			array(
				'label'      => esc_html__( 'Text Size', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 10,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input.button.gform_button_select_files' => 'font-size: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'multi_file_upload_switch' => 'yes',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_multi_file_upload_style' );
			$this->start_controls_tab(
				'multi_file_upload_normal',
				array(
					'label'     => esc_html__( 'Normal', 'tpebl' ),
					'condition' => array(
						'multi_file_upload_switch' => 'yes',
					),
				)
			);
				$this->add_control(
					'mfu_color_normal',
					array(
						'label'     => esc_html__( 'Text Color', 'tpebl' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input.button.gform_button_select_files' => 'color: {{VALUE}};',
						),
						'condition' => array(
							'multi_file_upload_switch' => 'yes',
						),
					)
				);
				$this->add_control(
					'mfu_bg_normal',
					array(
						'label'     => esc_html__( 'Background', 'tpebl' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input.button.gform_button_select_files' => 'background: {{VALUE}};',
						),
						'condition' => array(
							'multi_file_upload_switch' => 'yes',
						),
					)
				);
				$this->add_responsive_control(
					'mfu_border_radius',
					array(
						'label'      => esc_html__( 'Border Radius', 'tpebl' ),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => array( 'px', '%' ),
						'selectors'  => array(
							'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input.button.gform_button_select_files' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						),
						'condition'  => array(
							'multi_file_upload_switch' => 'yes',
						),
					)
				);
			$this->end_controls_tab();
				$this->start_controls_tab(
					'multi_file_upload_hover',
					array(
						'label'     => esc_html__( 'Hover', 'tpebl' ),
						'condition' => array(
							'multi_file_upload_switch' => 'yes',
						),
					)
				);
				$this->add_control(
					'mfu_color_hover',
					array(
						'label'     => esc_html__( 'Text Color', 'tpebl' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input.button.gform_button_select_files:hover' => 'color: {{VALUE}};',
						),
						'condition' => array(
							'multi_file_upload_switch' => 'yes',
						),
					)
				);
				$this->add_control(
					'mfu_bg_hover',
					array(
						'label'     => esc_html__( 'Background', 'tpebl' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input.button.gform_button_select_files:hover' => 'background: {{VALUE}};',
						),
						'condition' => array(
							'multi_file_upload_switch' => 'yes',
						),
					)
				);
				$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_button_styling',
			array(
				'label' => esc_html__( 'Submit/Next/Previous Button', 'tpebl' ),
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
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="button"],
					{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="submit"]' => 'width: {{SIZE}}{{UNIT}}',
				),
				'separator'   => 'after',
			)
		);
		$this->add_responsive_control(
			'content_align',
			array(
				'label'     => esc_html__( 'Alignment', 'tpebl' ),
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
				'default'   => 'center',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gform_footer' => 'text-align: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'button_typography',
				'selector' => '{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="button"],
					{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="submit"]',
			)
		);
		$this->add_responsive_control(
			'button_inner_padding',
			array(
				'label'      => esc_html__( 'Inner Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="button"],
					{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="submit"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="button"],
					{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="submit"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'label'     => esc_html__( 'Button Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gform_button.button' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'button_bg',
			array(
				'label'     => esc_html__( 'Button Background', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gform_button.button' => 'background: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'nxt_button_color',
			array(
				'label'     => esc_html__( 'Next Button Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gform_next_button' => 'color: {{VALUE}};',
				),
				'separator' => 'before',
			)
		);
		$this->add_control(
			'nxt_button_bg',
			array(
				'label'     => esc_html__( 'Next Button Background', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gform_next_button' => 'background: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'pre_button_color',
			array(
				'label'     => esc_html__( 'Previous Button Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gform_previous_button' => 'color: {{VALUE}};',
				),
				'separator' => 'before',
			)
		);
		$this->add_control(
			'pre_button_bg',
			array(
				'label'     => esc_html__( 'Previous Button Background', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gform_previous_button' => 'background: {{VALUE}};',
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
			'button_color_hover',
			array(
				'label'     => esc_html__( 'Button Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gform_button.button:hover' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'button_bg_hover',
			array(
				'label'     => esc_html__( 'Button Background', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gform_button.button:hover' => 'background: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'nxt_button_hover_color',
			array(
				'label'     => esc_html__( 'Next Button Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gform_next_button:hover' => 'color: {{VALUE}};',
				),
				'separator' => 'before',
			)
		);
		$this->add_control(
			'nxt_button_hover_bg',
			array(
				'label'     => esc_html__( 'Next Button Background', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gform_next_button:hover' => 'background: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'pre_button_hover_color',
			array(
				'label'     => esc_html__( 'Previous Button Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gform_previous_button:hover' => 'color: {{VALUE}};',
				),
				'separator' => 'before',
			)
		);
		$this->add_control(
			'pre_button_hover_bg',
			array(
				'label'     => esc_html__( 'Previous Button Background', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gform_previous_button:hover' => 'background: {{VALUE}};',
				),
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
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="button"],
					{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="submit"]' => 'border-style: {{VALUE}};',
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
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="button"],
					{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="submit"]' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="button"],
					{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="submit"]' => 'border-color: {{VALUE}};',
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
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="button"],
					{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="submit"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="button"]:hover,
					{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="submit"]:hover' => 'border-color: {{VALUE}};',
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
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="button"]:hover,
					{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="submit"]:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
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
				'selector' => '{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="button"],
					{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="submit"]',
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
				'selector' => '{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="button"]:hover,
					{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper input[type="submit"]:hover',
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
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'selector' => '{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield',
				)
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'     => 'oute_r__border',
					'label'    => esc_html__( 'Border', 'tpebl' ),
					'selector' => '{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield',
				)
			);
			$this->add_responsive_control(
				'oute_r_border_radius',
				array(
					'label'      => esc_html__( 'Border Radius', 'tpebl' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'     => 'oute_r_shadow',
					'selector' => '{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield',
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
					'selector' => '{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield:hover',
				)
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'     => 'oute_r__border_hover',
					'label'    => esc_html__( 'Border', 'tpebl' ),
					'selector' => '{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield:hover',
				)
			);
			$this->add_responsive_control(
				'oute_r_border_radius_hover',
				array(
					'label'      => esc_html__( 'Border Radius', 'tpebl' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'     => 'oute_r_shadow_hover',
					'selector' => '{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield:hover',
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
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'selector' => '{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper',
				)
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'     => 'form_border',
					'label'    => esc_html__( 'Border', 'tpebl' ),
					'selector' => '{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper',
				)
			);
			$this->add_responsive_control(
				'form_border_radius',
				array(
					'label'      => esc_html__( 'Border Radius', 'tpebl' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'     => 'form_shadow',
					'selector' => '{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper',
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
					'selector' => '{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper:hover',
				)
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'     => 'form_border_hover',
					'label'    => esc_html__( 'Border', 'tpebl' ),
					'selector' => '{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper:hover',
				)
			);
			$this->add_responsive_control(
				'form_border_radius_hover',
				array(
					'label'      => esc_html__( 'Border Radius', 'tpebl' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'     => 'form_shadow_hover',
					'selector' => '{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper:hover',
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
					'{{WRAPPER}} .pt_plus_gravity_form .gform_confirmation_wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .pt_plus_gravity_form .gform_confirmation_wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'response_success_typography',
				'selector' => '{{WRAPPER}} .pt_plus_gravity_form .gform_confirmation_wrapper',
			)
		);
		$this->add_control(
			'response_success_color',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_gravity_form .gform_confirmation_wrapper' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'response_success_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .pt_plus_gravity_form .gform_confirmation_wrapper',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'response_success_border',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .pt_plus_gravity_form .gform_confirmation_wrapper',
			)
		);
		$this->add_responsive_control(
			'response_success_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_gravity_form .gform_confirmation_wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .pt_plus_gravity_form .gfield_description.validation_message' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),

			)
		);
		$this->add_responsive_control(
			'response_validation_margin',
			array(
				'label'      => esc_html__( 'Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_gravity_form .gfield_description.validation_message' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'response_validation_typography',
				'selector' => '{{WRAPPER}} .pt_plus_gravity_form .gfield_description.validation_message',
			)
		);
		$this->add_control(
			'response_validation_color',
			array(
				'label'     => esc_html__( 'Text Color/Field Border', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .gform_wrapper .validation_message,{{WRAPPER}} .gform_wrapper div.validation_error' => 'color: {{VALUE}};',
					'{{WRAPPER}} .gform_wrapper .gfield_error input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .gform_wrapper .gfield_error textarea' => 'border-color: {{VALUE}};',

					'{{WRAPPER}} .gform_wrapper div.validation_error' => 'border-top-color: {{VALUE}}; border-bottom-color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'response_validation_bg',
			array(
				'label'     => esc_html__( 'Background', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .gform_wrapper .gfield.gfield_error,{{WRAPPER}} .gform_wrapper .gfield.gfield_error.gfield_contains_required.gfield_creditcard_warning' => 'background: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'response_validation_border',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .gform_wrapper .gfield.gfield_error,{{WRAPPER}} .gform_wrapper .gfield.gfield_error.gfield_contains_required.gfield_creditcard_warning',
			)
		);
		$this->add_responsive_control(
			'response_validation_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .gform_wrapper .gfield.gfield_error,{{WRAPPER}} .gform_wrapper .gfield.gfield_error.gfield_contains_required.gfield_creditcard_warning' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper' => 'max-width: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
			'captcha_margin',
			array(
				'label'      => esc_html__( 'Captcha Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_gravity_form .gform_wrapper .gfield .ginput_recaptcha' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
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

		include L_THEPLUS_PATH . 'modules/widgets/theplus-needhelp.php';
		include L_THEPLUS_PATH . 'modules/widgets/theplus-profeatures.php';
	}

	/**
	 * Render Gravity-Form.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function render() {
		$settings = $this->get_settings_for_display();

		$animation_delay   = ! empty( $settings['animation_delay']['size'] ) ? $settings['animation_delay']['size'] : 50;
		$animate_duration  = ! empty( $settings['animate_duration']['size'] ) ? $settings['animate_duration']['size'] : 50;
		$animation_effects = ! empty( $settings['animation_effects'] ) ? $settings['animation_effects'] : '';

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

		$output  = '<div class="pt_plus_gravity_form ' . esc_attr( $animated_class ) . '" ' . $animation_attr . '>';
		$output .= do_shortcode( $this->get_shortcode() );
		$output .= '</div>';

		echo $output;
	}

	/**
	 * Get Shortcode.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	private function get_shortcode() {
		$settings = $this->get_settings();

		$gra_form    = ! empty( $settings['gravity_form'] ) ? $settings['gravity_form'] : '0';
		$gra_form_dm = ! empty( $settings['gravity_form_dm'] ) ? $settings['gravity_form_dm'] : '';

		$compatibillty = ! empty( $settings['select'] ) ? $settings['select'] : 'gf_default';

		if ( '0' === $gra_form && 'gf_default' === $compatibillty ) {
			return '<h3 class="theplus-posts-not-found">' . esc_html__( 'Please select Gravity Form', 'tpebl' ) . '</h3>';
		}

		if ( empty( $gra_form_dm ) && 'gf_dmp' === $compatibillty ) {
			return '<h3 class="theplus-posts-not-found">' . esc_html__( 'Please select Download Monitor Form', 'tpebl' ) . '</h3>';
		}

		if ( ( ! empty( $compatibillty ) && 'gf_dmp' === $settings['select'] ) && ! empty( $gra_form_dm ) ) {
			$attributes = array(
				'id' => $gra_form_dm,
			);
		} else {
			$attributes = array(
				'id'          => $gra_form,
				'title'       => $settings['title_hide'] ? 'true' : 'false',
				'description' => $settings['title_hide'] ? 'true' : 'false',
				'ajax'        => ! empty( $settings['ajax'] ) ? 'true' : 'false',
			);
		}

		$this->add_render_attribute( 'shortcode', $attributes );

		$shortcode = array();
		if ( ( ! empty( $settings['select'] ) && 'gf_dmp' === $settings['select'] ) && ! empty( $gra_form_dm ) ) {
			$shortcode[] = sprintf( '[dlm_gf_form download_id = ' . esc_attr( $gra_form_dm ) . ']', $this->get_render_attribute_string( 'shortcode' ) );
		} else {
			$shortcode[] = sprintf( '[gravityform %s]', $this->get_render_attribute_string( 'shortcode' ) );
		}

		return implode( '', $shortcode );
	}

	/**
	 * Gravity form
	 *
	 * @since 1.0.1
	 * @version 5.5.2
	 */
	function l_theplus_gravity_form() {
		if ( class_exists( 'GFCommon' ) ) {
			$gravity_forms = \RGFormsModel::get_forms( null, 'title' );
			$g_form_options = ['0' => esc_html__( 'Select Form', 'tpebl' )];

			if ( ! empty( $gravity_forms ) && ! is_wp_error( $gravity_forms ) ) {
				foreach ( $gravity_forms as $form ) {   
					$g_form_options[ $form->id ] = $form->title;
				}
			}
		} else {
			$g_form_options = ['0' => esc_html__( 'Form Not Found!', 'tpebl' ) ];
		}

		return $g_form_options;
	}

	/**
	 * Gravity form using download monitor
	 *
	 * @since 1.0.1
	 * @version 5.5.2
	 */
	function l_theplus_gravity_form_using_dm() {
		$gf_dm = array();
		$gf_dm_form = get_posts('post_type="dlm_download"&numberposts=-1');
		$gf_dm = ['0' => esc_html__( 'Select Form', 'tpebl' )];

		if ( !empty($gf_dm_form) ) {
			foreach ($gf_dm_form as $gfdmform) {
				$gf_dm[$gfdmform->ID] = $gfdmform->post_title;
			}
		} else {
			$gf_dm[0] = esc_html__('No forms found', 'tpebl');
		}

		return $gf_dm;
	}

}
