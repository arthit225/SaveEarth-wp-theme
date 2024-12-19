<?php
/**
 * Widget Name: Countdown
 * Description: Display countdown.
 * Author: Theplus
 * Author URI: https://posimyth.com
 *
 * @package ThePlus
 */

namespace TheplusAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class L_ThePlus_Countdown
 */
class L_ThePlus_Countdown extends Widget_Base {

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
		return 'tp-countdown';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 1.0.0
	 */
	public function get_title() {
		return esc_html__( 'Countdown', 'tpebl' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'fa fa-clock-o theplus_backend_icon';
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
		return array( 'Countdown', 'Timer', 'Countdown Timer', 'Elementor Countdown', 'Elementor Timer', 'Elementor Countdown Timer', 'Time Limit', 'Time Countdown' );
	}

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
				'label' => esc_html__( 'Countdown Date', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'CDType',
			array(
				'label'   => esc_html__( 'Countdown Setup', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'normal',
				'options' => array(
					'normal'   => esc_html__( 'Normal Countdown', 'tpebl' ),
					'scarcity' => esc_html__( 'Scarcity Countdown (Evergreen) (Pro)', 'tpebl' ),
					'numbers'  => esc_html__( 'Fake Numbers Counter (Pro)', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_normal',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "create-a-sticky-countdown-timer-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'CDType' => array( 'normal' ),
				),
			)
		);
		$this->add_control(
			'tab_content_options1',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'CDType' => array( 'scarcity', 'numbers' ),
				),
			)
		);
		$this->add_control(
			'CDstyle',
			array(
				'label'     => esc_html__( 'Countdown Style', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style-1',
				'options'   => array(
					'style-1' => esc_html__( 'Style 1', 'tpebl' ),
					'style-2' => esc_html__( 'Style 2', 'tpebl' ),
					'style-3' => esc_html__( 'Style 3 ', 'tpebl' ),
				),
				'condition' => array(
					'CDType' => 'normal',
				),
			)
		);

		$this->add_control(
			'counting_timer',
			array(
				'label'     => esc_html__( 'Launch Date', 'tpebl' ),
				'type'      => Controls_Manager::DATE_TIME,
				'label_block' => false,
				'default'   => gmdate( 'Y-m-d H:i', strtotime( '+1 month' ) + ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS ) ),
				'condition' => array(
					'CDType' => 'normal',
				),
			)
		);
		$this->add_control(
			'count_Note',
			array(
				'type'        => Controls_Manager::RAW_HTML,
				'raw'         => '<p class="tp-controller-notice"><i>Date set according to your timezone: %s.</i></p>',
				'label_block' => true,
				'condition'   => array(
					'CDType' => 'normal',
				),
			)
		);
		$this->add_control(
			'inline_style',
			array(
				'label'     => wp_kses_post( "Inline Style <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "style-elementor-countdown-timer-in-block-or-inline-style/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'tpebl' ),
				'label_off' => esc_html__( 'Off', 'tpebl' ),
				'default'   => 'no',
				'separator' => 'before',
				'condition' => array(
					'CDType'  => 'normal',
					'CDstyle' => 'style-1',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_downcount',
			array(
				'label' => esc_html__( 'Content Source', 'tpebl' ),
			)
		);
		$this->add_control(
			'days_labels',
			array(
				'label'     => wp_kses_post( "Days <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "hide-countdown-days-hours-mins-seconds-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'default'   => 'yes',
			)
		);
		$this->add_control(
			'hours_labels',
			array(
				'label'     => esc_html__( 'Hours', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'default'   => 'yes',
			)
		);

		$this->add_control(
			'minutes_labels',
			array(
				'label'     => esc_html__( 'Minutes', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'default'   => 'yes',
			)
		);

		$this->add_control(
			'seconds_labels',
			array(
				'label'     => esc_html__( 'Seconds', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'separator' => 'after',
				'default'   => 'yes',
			)
		);
		$this->add_control(
			'show_labels',
			array(
				'label'   => esc_html__( 'Show Labels', 'tpebl' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);
		$this->add_control(
			'text_days',
			array(
				'type'      => Controls_Manager::TEXT,
				'label'     => esc_html__( 'Days Section Text', 'tpebl' ),
				'separator' => 'before',
				'default'   => esc_html__( 'Days', 'tpebl' ),
				'condition' => array(
					'show_labels!' => '',
				),
			)
		);
		$this->add_control(
			'text_hours',
			array(
				'type'      => Controls_Manager::TEXT,
				'label'     => esc_html__( 'Hours Section Text', 'tpebl' ),
				'default'   => esc_html__( 'Hours', 'tpebl' ),
				'condition' => array(
					'show_labels!' => '',
				),
			)
		);
		$this->add_control(
			'text_minutes',
			array(
				'type'      => Controls_Manager::TEXT,
				'label'     => esc_html__( 'Minutes Section Text', 'tpebl' ),
				'default'   => esc_html__( 'Minutes', 'tpebl' ),
				'condition' => array(
					'show_labels!' => '',
				),
			)
		);
		$this->add_control(
			'text_seconds',
			array(
				'type'      => Controls_Manager::TEXT,
				'label'     => esc_html__( 'Seconds Section Text', 'tpebl' ),
				'default'   => esc_html__( 'Seconds', 'tpebl' ),
				'condition' => array(
					'show_labels!' => '',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'extraoption_downcount',
			array(
				'label'     => esc_html__( 'Extra Option', 'tpebl' ),
				'condition' => array(
					'CDType'  => array( 'normal', 'scarcity' ),
					'CDstyle' => 'style-2',
				),
			)
		);
		$this->add_control(
			'fliptheme',
			array(
				'label'      => esc_html__( 'Theme Color', 'tpebl' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'dark',
				'options'    => array(
					'dark'  => esc_html__( 'Dark', 'tpebl' ),
					'light' => esc_html__( 'Light ( Pro )', 'tpebl' ),
					'mix'   => esc_html__( 'Mix ( Pro )', 'tpebl' ),
				),
				'condition'  => array(
					'CDType' => array( 'normal', 'scarcity' ),
				),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'CDstyle',
							'operator' => '===',
							'value'    => 'style-2',
						),
					),
				),
			)
		);
		$this->add_control(
			'style_extra',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'fliptheme!' => 'dark',
				),
			)
		);
		$this->add_control(
			'expirytype',
			array(
				'label'        => esc_html__( 'After Expiry Action', 'tpebl' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Enable', 'tpebl' ),
				'label_off'    => esc_html__( 'Disable', 'tpebl' ),
				'return_value' => 'yes',
				'default'      => '',
				'conditions'   => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'terms' => array(
								array(
									'name'     => 'CDType',
									'operator' => '===',
									'value'    => 'normal',
								),
							),
						),
					),
				),
			)
		);
		$this->add_control(
			'expirytype_pro',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'expirytype' => 'yes',
				),
			)
		);
		$this->add_control(
			'countdownExpiry',
			array(
				'label'      => esc_html__( 'Select Action', 'tpebl' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'none',
				'options'    => array(
					'none'     => esc_html__( 'None', 'tpebl' ),
					'showmsg'  => esc_html__( 'Message ( Pro )', 'tpebl' ),
					'showtemp' => esc_html__( 'Template ( Pro )', 'tpebl' ),
					'redirect' => esc_html__( 'Page Redirect ( Pro )', 'tpebl' ),
				),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'terms' => array(
								array(
									'name'     => 'CDType',
									'operator' => '===',
									'value'    => 'normal',
								),
							),
						),
					),
				),

			)
		);
		$this->add_control(
			'countdownExpiry_pro',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'countdownExpiry!' => 'none',
				),
			)
		);
		$this->add_control(
			'cd_classbased',
			array(
				'label'     => wp_kses_post( "Class Based Section Visibility <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "change-website-content-when-countdown-timer-ends/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'separator' => 'before',
				'condition' => array(
					'CDType'   => 'normal',
					'CDstyle!' => 'style-3',
				),
			)
		);
		$this->add_control(
			'cd_classbasedPro',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'cd_classbased' => 'yes',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_styling',
			array(
				'label'     => esc_html__( 'Counter Styling', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'CDstyle' => 'style-1',
				),
			)
		);
		$this->add_control(
			'number_text_color',
			array(
				'label'     => esc_html__( 'Counter Font Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_countdown li > span' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'numbers_typography',
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				),
				'selector'  => '{{WRAPPER}}  .pt_plus_countdown li > span',
				'separator' => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'label_typography',
				'label'     => esc_html__( 'Label Typography', 'tpebl' ),
				'selector'  => '{{WRAPPER}} .pt_plus_countdown li > h6',
				'separator' => 'after',
				'condition' => array(
					'show_labels!' => '',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_days_style' );

		$this->start_controls_tab(
			'tab_day_style',
			array(
				'label' => esc_html__( 'Days', 'tpebl' ),
			)
		);
		$this->add_control(
			'days_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_countdown li.count_1 h6' => 'color:{{VALUE}};',
				),
				'condition' => array(
					'show_labels!' => '',
					'CDstyle'      => 'style-1',
				),
			)
		);
		$this->add_control(
			'days_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_countdown li.count_1' => 'border-color:{{VALUE}};',
				),
				'condition' => array(
					'inline_style!' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'days_background',
				'label'    => esc_html__( 'Days Background', 'tpebl' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .pt_plus_countdown li.count_1',

			)
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_hour_style',
			array(
				'label' => esc_html__( 'Hours', 'tpebl' ),
			)
		);
		$this->add_control(
			'hours_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_countdown li.count_2 h6' => 'color:{{VALUE}};',
				),
				'condition' => array(
					'show_labels!' => '',
					'CDstyle'      => 'style-1',
				),
			)
		);
		$this->add_control(
			'hours_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_countdown li.count_2' => 'border-color:{{VALUE}};',
				),
				'condition' => array(
					'inline_style!' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'hours_background',
				'label'    => esc_html__( 'Background', 'tpebl' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .pt_plus_countdown li.count_2',
			)
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_minute_style',
			array(
				'label' => esc_html__( 'Minutes', 'tpebl' ),
			)
		);
		$this->add_control(
			'minutes_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_countdown li.count_3 h6' => 'color:{{VALUE}};',
				),
				'condition' => array(
					'show_labels!' => '',
					'CDstyle'      => 'style-1',
				),
			)
		);
		$this->add_control(
			'minutes_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_countdown li.count_3' => 'border-color:{{VALUE}};',
				),
				'condition' => array(
					'inline_style!' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'minutes_background',
				'label'    => esc_html__( 'Background', 'tpebl' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .pt_plus_countdown li.count_3',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_second_style',
			array(
				'label' => esc_html__( 'Seconds', 'tpebl' ),
			)
		);
		$this->add_control(
			'seconds_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_countdown li.count_4 h6' => 'color:{{VALUE}};',
				),
				'condition' => array(
					'show_labels!' => '',
					'CDstyle'      => 'style-1',
				),
			)
		);
		$this->add_control(
			'seconds_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_countdown li.count_4' => 'border-color:{{VALUE}};',
				),
				'condition' => array(
					'inline_style!' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'seconds_background',
				'label'    => esc_html__( 'Background', 'tpebl' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .pt_plus_countdown li.count_4',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'counter_padding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'separator'  => 'before',
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_countdown li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'counter_margin',
			array(
				'label'      => esc_html__( 'Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_countdown li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'count_border_style',
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
				'separator' => 'before',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_countdown li' => 'border-style: {{VALUE}};',
				),
			)
		);
		$this->add_responsive_control(
			'count_border_width',
			array(
				'label'      => esc_html__( 'Border Width', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'top'    => 3,
					'right'  => 3,
					'bottom' => 3,
					'left'   => 3,
				),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_countdown li' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'count_border_style!' => 'none',
				),
			)
		);
		$this->add_control(
			'count_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_countdown li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'count_hover_shadow',
				'selector'  => '{{WRAPPER}} .pt_plus_countdown li',
				'separator' => 'before',
			)
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'style3_styling',
			array(
				'label'     => esc_html__( 'Style 3', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'CDType'  => array( 'normal', 'scarcity' ),
					'CDstyle' => 'style-3',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 's3numbertypo',
				'label'    => esc_html__( 'Typography', 'tpebl' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-countdown .tp-countdown-counter .progressbar-text .number',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 's3labeltypo',
				'label'    => esc_html__( 'Typography', 'tpebl' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-countdown .tp-countdown-counter .progressbar-text .label',
			)
		);
		$this->add_control(
			'strokewd1',
			array(
				'label'     => esc_html__( 'Stroke Width', 'tpebl' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 5,
				'step'      => 1,
				'default'   => 5,
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .tp-countdown-counter svg > path:nth-of-type(2)' => 'stroke-width:{{VALUE}};',
				),
			)
		);
		$this->add_control(
			'trailwd',
			array(
				'label'     => esc_html__( 'Trail Width', 'tpebl' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 5,
				'step'      => 1,
				'default'   => 3,
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .tp-countdown-counter svg > path:nth-of-type(1)' => 'stroke-width:{{VALUE}};',
				),
			)
		);
		$this->start_controls_tabs( 's3_tabs' );
		$this->start_controls_tab(
			's3_num_days',
			array(
				'label' => esc_html__( 'Days', 'tpebl' ),
			)
		);
		$this->add_control(
			's3daynumberncr',
			array(
				'label'     => esc_html__( 'Counter Number Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .tp-countdown-counter .counter-part:nth-of-type(1) .progressbar-text .number' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			's3daytextncr',
			array(
				'label'     => esc_html__( 'Counter Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .tp-countdown-counter .counter-part:nth-of-type(1) .progressbar-text .label' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			's3daystrokencr',
			array(
				'label'     => esc_html__( 'Counter Stroke Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .tp-countdown-counter .counter-part:nth-of-type(1) svg > path:nth-of-type(1)' => 'stroke: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			's3daystrailnncr',
			array(
				'label'     => esc_html__( 'Counter Trail Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .tp-countdown-counter .counter-part:nth-of-type(1) svg > path:nth-of-type(2)' => 'stroke: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			's3_text_hours',
			array(
				'label' => esc_html__( 'Hours', 'tpebl' ),
			)
		);
		$this->add_control(
			's3hoursnumberncr',
			array(
				'label'     => esc_html__( 'Counter Number Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .tp-countdown-counter .counter-part:nth-of-type(2) .progressbar-text .number' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			's3hourstextncr',
			array(
				'label'     => esc_html__( 'Counter Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .tp-countdown-counter .counter-part:nth-of-type(2) .progressbar-text .label' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			's3hourstrokencr',
			array(
				'label'     => esc_html__( 'Counter Stroke Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .tp-countdown-counter .counter-part:nth-of-type(2) svg > path:nth-of-type(1)' => 'stroke: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			's3hourstrailncr',
			array(
				'label'     => esc_html__( 'Counter Trail Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .tp-countdown-counter .counter-part:nth-of-type(2) svg > path:nth-of-type(2)' => 'stroke: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			's3_text_minutes',
			array(
				'label' => esc_html__( 'Minutes', 'tpebl' ),
			)
		);
		$this->add_control(
			's3minutnumberncr',
			array(
				'label'     => esc_html__( 'Counter Number Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .tp-countdown-counter .counter-part:nth-of-type(3) .progressbar-text .number' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			's3minuttextncr',
			array(
				'label'     => esc_html__( 'Counter Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .tp-countdown-counter .counter-part:nth-of-type(3) .progressbar-text .label' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			's3miutstrokencr',
			array(
				'label'     => esc_html__( 'Counter Stroke Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .tp-countdown-counter .counter-part:nth-of-type(3) svg > path:nth-of-type(1)' => 'stroke: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			's3miutstrailncr',
			array(
				'label'     => esc_html__( 'Counter Trail Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .tp-countdown-counter .counter-part:nth-of-type(3) svg > path:nth-of-type(2)' => 'stroke: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			's3_text_seconds',
			array(
				'label' => esc_html__( 'Second', 'tpebl' ),
			)
		);
		$this->add_control(
			's3secondnumberncr',
			array(
				'label'     => esc_html__( 'Counter Number Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .tp-countdown-counter .counter-part:nth-of-type(4) .progressbar-text .number' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			's3secondtextncr',
			array(
				'label'     => esc_html__( 'Counter Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .tp-countdown-counter .counter-part:nth-of-type(4) .progressbar-text .label' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			's3secondtrokencr',
			array(
				'label'     => esc_html__( 'Counter Stroke Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .tp-countdown-counter .counter-part:nth-of-type(4) svg > path:nth-of-type(1)' => 'stroke: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			's3secondstrailncr',
			array(
				'label'     => esc_html__( 'Counter Trail Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .tp-countdown-counter .counter-part:nth-of-type(4) svg > path:nth-of-type(2)' => 'stroke: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			's3hoverstyle',
			array(
				'label'     => __( 'Hover style', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			's3numberhcr',
			array(
				'label'     => esc_html__( 'Number Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .tp-countdown-counter .counter-part:hover .progressbar-text .number' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			's3texthcr',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .tp-countdown-counter .counter-part:hover .progressbar-text .label' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			's3trokehcr',
			array(
				'label'     => esc_html__( 'Stroke Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .tp-countdown-counter .counter-part:hover svg > path:nth-of-type(1)' => 'stroke: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			's3strailhcr',
			array(
				'label'     => esc_html__( 'Trail Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .tp-countdown-counter .counter-part:hover svg > path:nth-of-type(2)' => 'stroke: {{VALUE}};',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'style2text_styling',
			array(
				'label'     => esc_html__( 'Label', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'CDType'      => array( 'normal', 'scarcity' ),
					'CDstyle'     => 'style-2',
					'show_labels' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 's2texttypo',
				'label'    => esc_html__( 'Typography', 'tpebl' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-countdown .rotor-group .rotor-group-heading',
			)
		);
		$this->start_controls_tabs( 's32_tabs' );
		$this->start_controls_tab(
			's2_text_days',
			array(
				'label' => esc_html__( 'Days', 'tpebl' ),
			)
		);
		$this->add_control(
			's2daytextdcr',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .rotor-group:nth-of-type(1) .rotor-group-heading:before' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 's2daytextdbg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-countdown .rotor-group:nth-of-type(1) .rotor-group-heading:before',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 's2daytextdb',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-countdown .rotor-group:nth-of-type(1) .rotor-group-heading:before',
			)
		);
		$this->add_responsive_control(
			's2daytextdbrs',
			array(
				'label'      => __( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-countdown .rotor-group:nth-of-type(1) .rotor-group-heading:before' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 's2daytextdsd',
				'selector' => '{{WRAPPER}} .tp-countdown .rotor-group:nth-of-type(1) .rotor-group-heading:before',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			's2_text_hours',
			array(
				'label' => esc_html__( 'Hours', 'tpebl' ),
			)
		);
		$this->add_control(
			's2hoursnumberncr',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .rotor-group:nth-of-type(2) .rotor-group-heading:before' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 's2daytexttbg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-countdown .rotor-group:nth-of-type(2) .rotor-group-heading:before',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 's2daytexttdb',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-countdown .rotor-group:nth-of-type(2) .rotor-group-heading:before',
			)
		);
		$this->add_responsive_control(
			's2daytexttbrs',
			array(
				'label'      => __( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-countdown .rotor-group:nth-of-type(2) .rotor-group-heading:before' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 's2daytexttsd',
				'selector' => '{{WRAPPER}} .tp-countdown .rotor-group:nth-of-type(2) .rotor-group-heading:before',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			's2_text_minutes',
			array(
				'label' => esc_html__( 'Minutes', 'tpebl' ),
			)
		);
		$this->add_control(
			's2minutesnumberncr',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .rotor-group:nth-of-type(3) .rotor-group-heading:before' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 's2daytextmtbg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-countdown .rotor-group:nth-of-type(3) .rotor-group-heading:before',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 's2daytextmdb',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-countdown .rotor-group:nth-of-type(3) .rotor-group-heading:before',
			)
		);
		$this->add_responsive_control(
			's2daytextmbrs',
			array(
				'label'      => __( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-countdown .rotor-group:nth-of-type(3) .rotor-group-heading:before' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 's2daytextmsd',
				'selector' => '{{WRAPPER}} .tp-countdown .rotor-group:nth-of-type(3) .rotor-group-heading:before',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			's2_text_seconds',
			array(
				'label' => esc_html__( 'Second', 'tpebl' ),
			)
		);
		$this->add_control(
			's2secondnumberncr',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .rotor-group:nth-of-type(4) .rotor-group-heading:before' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 's2daytextmsbg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-countdown .rotor-group:nth-of-type(4) .rotor-group-heading:before',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 's2daytextsdb',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-countdown .rotor-group:nth-of-type(4) .rotor-group-heading:before',
			)
		);
		$this->add_responsive_control(
			's2daytextsbrs',
			array(
				'label'      => __( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-countdown .rotor-group:nth-of-type(4) .rotor-group-heading:before' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 's2daytextssd',
				'selector' => '{{WRAPPER}} .tp-countdown .rotor-group:nth-of-type(4) .rotor-group-heading:before',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		/*counter style*/
		$this->start_controls_section(
			'style2counter_styling',
			array(
				'label'     => esc_html__( 'Counter', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'CDType'  => array( 'normal', 'scarcity' ),
					'CDstyle' => 'style-2',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'style2countertypo',
				'label'    => esc_html__( 'Typography', 'tpebl' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-countdown .flipdown .rotor',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'style2dark_styling',
			array(
				'label'     => esc_html__( 'Dark Theme', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'CDType'  => array( 'normal', 'scarcity' ),
					'CDstyle' => 'style-2',
				),
			)
		);
		$this->start_controls_tabs( 's2dark_tabs' );
		$this->start_controls_tab(
			's2dark_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			's2haddingntop',
			array(
				'label' => esc_html__( 'Top Options', 'tpebl' ),
				'type'  => Controls_Manager::HEADING,
			)
		);
		$this->add_control(
			's2darktopncr',
			array(
				'label'     => esc_html__( 'Top Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .flipdown.flipdown__theme-dark .rotor,{{WRAPPER}} .tp-countdown .flipdown.flipdown__theme-dark .rotor-top,{{WRAPPER}} .tp-countdown .flipdown.flipdown__theme-dark .rotor-leaf-front' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 's2darktopnbg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-countdown .flipdown.flipdown__theme-dark .rotor,{{WRAPPER}} .tp-countdown .flipdown.flipdown__theme-dark .rotor-top,{{WRAPPER}} .tp-countdown .flipdown.flipdown__theme-dark .rotor-leaf-front',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 's2bordernb',
				'label'    => esc_html__( 'Border Top', 'tpebl' ),
				'selector' => '{{WRAPPER}} .flipdown.flipdown__theme-dark .rotor-top,{{WRAPPER}} .flipdown.flipdown__theme-dark .rotor-leaf-front',
			)
		);

		$this->add_control(
			's2haddingnbootom',
			array(
				'label'     => esc_html__( 'Bottom Options', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			's2darkbottomncr',
			array(
				'label'     => esc_html__( 'Bottom Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .flipdown.flipdown__theme-dark .rotor-bottom, {{WRAPPER}} .flipdown.flipdown__theme-dark .rotor-leaf-rear' => 'color:{{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 's2darkbottomnbg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .flipdown.flipdown__theme-dark .rotor-bottom, {{WRAPPER}} .flipdown.flipdown__theme-dark .rotor-leaf-rear',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 's2borderbottomnb',
				'label'    => esc_html__( 'Border Top', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-countdown .flipdown.flipdown__theme-dark .rotor:after',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			's2dark_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			's2haddihghtop',
			array(
				'label' => esc_html__( 'Top Options', 'tpebl' ),
				'type'  => Controls_Manager::HEADING,
			)
		);
		$this->add_control(
			's2darktophcr',
			array(
				'label'     => esc_html__( 'Top Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .flipdown.flipdown__theme-dark:hover .rotor,{{WRAPPER}} .tp-countdown .flipdown.flipdown__theme-dark:hover .rotor-top,{{WRAPPER}} .tp-countdown .flipdown.flipdown__theme-dark:hover .rotor-leaf-front' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 's2darktophbg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-countdown .flipdown.flipdown__theme-dark:hover .rotor,{{WRAPPER}} .tp-countdown .flipdown.flipdown__theme-dark:hover .rotor-top,{{WRAPPER}} .tp-countdown .flipdown.flipdown__theme-dark:hover .rotor-leaf-front',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 's2darkborderhb',
				'label'    => esc_html__( 'Border Top', 'tpebl' ),
				'selector' => '{{WRAPPER}} .flipdown.flipdown__theme-dark:hover .rotor-top,{{WRAPPER}} .flipdown.flipdown__theme-dark:hover .rotor-top,{{WRAPPER}} .flipdown.flipdown__theme-dark:hover .rotor-leaf-front',
			)
		);

		$this->add_control(
			's2haddinghbootom',
			array(
				'label'     => esc_html__( 'Bottom Options', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			's2darkbottomhcr',
			array(
				'label'     => esc_html__( 'Bottom Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .flipdown.flipdown__theme-dark:hover .rotor-bottom, {{WRAPPER}} .flipdown.flipdown__theme-dark:hover .rotor-leaf-rear' => 'color:{{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 's2darkbottomhbg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .flipdown.flipdown__theme-dark:hover .rotor-bottom, {{WRAPPER}} .flipdown.flipdown__theme-dark:hover .rotor-leaf-rear',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'middlelinehb',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-countdown .flipdown.flipdown__theme-dark:hover .rotor:after',
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'style2dot_styling',
			array(
				'label'     => esc_html__( 'Dot', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'CDType'  => array( 'normal', 'scarcity' ),
					'CDstyle' => 'style-2',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 's2ndotbg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-countdown .flipdown .rotor-group:nth-child(n+2):nth-child(-n+3):before,{{WRAPPER}} .tp-countdown .flipdown .rotor-group:nth-child(n+2):nth-child(-n+3):after,{{WRAPPER}}  .tp-countdown.countdown-style-2 .rotor-group:first-child::after,{{WRAPPER}}  .tp-countdown.countdown-style-2 .rotor-group:first-child::before',
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
			'background_styling',
			array(
				'label' => esc_html__( 'Background', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'bgpad',
			array(
				'label'      => __( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-countdown' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'bgmar',
			array(
				'label'      => __( 'Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-countdown' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs( 'bg_tabs' );
		$this->start_controls_tab(
			'bg_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'bgnbg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-countdown',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'bgnb',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-countdown',
			)
		);
		$this->add_responsive_control(
			'bgnbr',
			array(
				'label'      => __( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-countdown' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'bgnsd',
				'selector' => '{{WRAPPER}} .tp-countdown',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'bg_hover',
			array(
				'label' => esc_html__( 'hover', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'bghbg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-countdown:hover',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'bghb',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-countdown:hover',

			)
		);
		$this->add_responsive_control(
			'bghbr',
			array(
				'label'      => __( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-countdown:hover' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'bghsd',
				'selector' => '{{WRAPPER}} .tp-countdown:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
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
				'label'   => esc_html__( 'Animation Duration', 'tpebl' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
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
	 * Render Progress Bar Written in PHP and HTML.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$days_labels    = ! empty( $settings['days_labels'] ) ? true : false;
		$hours_labels   = ! empty( $settings['hours_labels'] ) ? true : false;
		$minutes_labels = ! empty( $settings['minutes_labels'] ) ? true : false;
		$seconds_labels = ! empty( $settings['seconds_labels'] ) ? true : false;
		$cd_type        = ! empty( $settings['CDType'] ) ? $settings['CDType'] : 'normal';
		$cd_style       = ! empty( $settings['CDstyle'] ) ? $settings['CDstyle'] : 'style-1';

		$label_on   = ! empty( $settings['show_labels'] ) ? $settings['show_labels'] : '';
		$text_days  = ! empty( $settings['text_days'] ) ? esc_html( $settings['text_days'] ) : 'Days';
		$text_hours = ! empty( $settings['text_hours'] ) ? esc_html( $settings['text_hours'] ) : 'Hours';

		$text_minutes = ! empty( $settings['text_minutes'] ) ? esc_html( $settings['text_minutes'] ) : 'Minutes';
		$text_seconds = ! empty( $settings['text_seconds'] ) ? esc_html( $settings['text_seconds'] ) : 'Seconds';

		$count_time = ! empty( $settings['counting_timer'] ) ? $settings['counting_timer'] : '08/24/2024 12:00:00';

		$data_attr = '';

		$uid = uniqid( 'count_down' );

		$widget_id = $this->get_id();

		if ( empty( $label_on ) ) {
			$show_labels = $label_on;
		} else {
			$show_labels = 'yes';
		}

		if ( ! empty( $count_time ) ) {
			$counting_timer = $count_time;
			$counting_timer = gmdate( 'm/d/Y H:i:s', strtotime( $counting_timer ) );
		}

		$offset_time  = get_option( 'gmt_offset' );
		$offset_dtime = wp_timezone_string();

		$now = new \DateTime( 'NOW', new \DateTimeZone( $offset_dtime ) );

		$style_class = '';
		$cd_data     = array();
		if ( 'normal' === $cd_type ) {
			$style_class = 'countdown-' . $cd_style;

			$cd_data = array(
				'widgetid'      => $widget_id,
				'type'          => $cd_type,
				'style'         => $cd_style,
				'days'          => $text_days,
				'hours'         => $text_hours,
				'minutes'       => $text_minutes,
				'seconds'       => $text_seconds,

				'daysenable'    => $days_labels,
				'hoursenable'   => $hours_labels,
				'minutesenable' => $minutes_labels,
				'secondsenable' => $seconds_labels,
			);
		}

		if ( 'normal' === $cd_type ) {
			$other_dataa = array(
				'offset' => $offset_time,
				'timer'  => $counting_timer,
			);

			$cd_data = array_merge( $cd_data, $other_dataa );
		}

		$cd_classbased = isset( $settings['cd_classbased'] ) ? 'yes' : 'no';
		$cd_data       = htmlspecialchars( wp_json_encode( $cd_data ), ENT_QUOTES, 'UTF-8' );

		$output = '';

		$output .= '<div class="tp-countdown tp-widget-' . esc_attr( $widget_id ) . ' ' . esc_attr( $style_class ) . '" data-basic="' . esc_attr( $cd_data ) . '" >';

			$data_attr .= ' data-days=' . wp_json_encode( $text_days ) . '';
			$data_attr .= ' data-hours=' . wp_json_encode( $text_hours ) . '';
			$data_attr .= ' data-minutes=' . wp_json_encode( $text_minutes ) . '';
			$data_attr .= ' data-seconds=' . wp_json_encode( $text_seconds ) . '';

			$animation_effects = ! empty( $settings['animation_effects'] ) ? $settings['animation_effects'] : '';
			$animation_delay   = ! empty( $settings['animation_delay']['size'] ) ? $settings['animation_delay']['size'] : 50;

			$ani_duration     = ! empty( $settings['animation_duration_default'] ) ? $settings['animation_duration_default'] : '';
			$animate_duration = ! empty( $settings['animate_duration']['size'] ) ? $settings['animate_duration']['size'] : 50;
			$out_effect       = ! empty( $settings['animation_out_effects'] ) ? $settings['animation_out_effects'] : '';
			$out_delay        = ! empty( $settings['animation_out_delay']['size'] ) ? $settings['animation_out_delay']['size'] : 50;
			$out_duration     = ! empty( $settings['animation_out_duration_default'] ) ? $settings['animation_out_duration_default'] : '';
			$out_speed        = ! empty( $settings['animation_out_duration']['size'] ) ? $settings['animation_out_duration']['size'] : 50;

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

		$inline_style = ( ! empty( $settings['inline_style'] ) && 'yes' === $settings['inline_style'] ) ? 'count-inline-style' : '';

		if ( 'normal' === $cd_type && 'style-1' === $cd_style ) {
			$output .= '<ul class="pt_plus_countdown ' . esc_attr( $uid ) . ' ' . esc_attr( $inline_style ) . ' ' . esc_attr( $animated_class ) . '" ' . $data_attr . ' data-timer="' . esc_attr( $counting_timer ) . '" data-offset="' . esc_attr( $offset_time ) . '" ' . esc_attr( $animation_attr ) . '>';
			if ( ! empty( $days_labels ) ) {
				$output     .= '<li class="count_1">';
					$output .= '<span class="days">00</span>';

				if ( ! empty( $show_labels ) && 'yes' === $show_labels ) {
					$output .= '<h6 class="days_ref">' . sanitize_text_field( $text_days ) . '</h6>';
				}

				$output .= '</li>';
			}

			if ( ! empty( $hours_labels ) ) {
				$output     .= '<li class="count_2">';
					$output .= '<span class="hours">00</span>';

				if ( ! empty( $show_labels ) && 'yes' === $show_labels ) {
					$output .= '<h6 class="hours_ref">' . sanitize_text_field( $text_hours ) . '</h6>';
				}

				$output .= '</li>';
			}

			if ( ! empty( $minutes_labels ) ) {
				$output     .= '<li class="count_3">';
					$output .= '<span class="minutes">00</span>';

				if ( ! empty( $show_labels ) && 'yes' === $show_labels ) {
					$output .= '<h6 class="minutes_ref">' . sanitize_text_field( $text_minutes ) . '</h6>';
				}

				$output .= '</li>';
			}

			if ( ! empty( $seconds_labels ) ) {
				$output     .= '<li class="count_4">';
					$output .= '<span class="seconds last">00</span>';
				if ( ! empty( $show_labels ) && 'yes' === $show_labels ) {
					$output .= '<h6 class="seconds_ref">' . sanitize_text_field( $text_seconds ) . '</h6>';
				}
					$output .= '</li>';
			}
				$output .= '</ul>';
		}

		$output .= '</div>';

		echo $output;
	}
}
