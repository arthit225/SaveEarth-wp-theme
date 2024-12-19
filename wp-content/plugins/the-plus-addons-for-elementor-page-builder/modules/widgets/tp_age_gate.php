<?php
/**
 * Widget Name: Age Gate
 * Description: Age gate
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
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class L_ThePlus_Age_Gate
 */
class L_ThePlus_Age_Gate extends Widget_Base {

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
	 * @since 5.3.5
	 */
	public function get_name() {
		return 'tp-age-gate';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 5.3.5
	 */
	public function get_title() {
		return esc_html__( 'Age Gate', 'tpebl' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 5.3.5
	 */
	public function get_icon() {
		return 'fas fa-user-shield theplus_backend_icon';
	}

	/**
	 * Get Widget categories.
	 *
	 * @since 5.3.5
	 */
	public function get_categories() {
		return array( 'plus-essential' );
	}

	/**
	 * Get Widget keywords.
	 *
	 * @since 5.3.5
	 */
	public function get_keywords() {
		return array( 'Age Gate', 'Age Verification', 'Age Restriction', 'Age Confirmation', 'Age Check', 'Age Limit', 'Age Requirement' );
	}

	public function get_custom_help_url() {
		$help_url = $this->tp_help;

		return esc_url( $help_url );
	}

	/**
	 * Register controls.
	 *
	 * @since 5.3.5
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'age_head_content_section',
			array(
				'label' => esc_html__( 'Layout', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'age_verify_method',
			array(
				'type'    => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Method', 'tpebl' ),
				'default' => 'method-1',
				'options' => array(
					'method-1' => esc_html__( 'Age Confirmation', 'tpebl' ),
					'method-2' => esc_html__( 'Birth Date', 'tpebl' ),
					'method-3' => esc_html__( 'Boolean', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_birth_date',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "add-age-verification-by-birthdate-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'age_verify_method' => array( 'method-2' ),
				),
			)
		);
		$this->add_control(
			'backend_preview',
			array(
				'label'     => esc_html__( 'Backend Visibility', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'separator' => 'before',
			)
		);
		$this->add_control(
			'tempNotice',
			array(
				'type'        => Controls_Manager::RAW_HTML,
				'raw'         => '<p class="tp-controller-notice"><i>To view your Age gate design in the backend Elementor editor, you can enable the backend preview. To avoid full screen disruption during normal page edits, please keep it disabled.</i></p>',
				'label_block' => true,
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'age_actContent_section',
			array(
				'label' => esc_html__( 'Content', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'age_icon_img_type',
			array(
				'label'     => esc_html__( 'Logo', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'tpebl' ),
				'label_off' => esc_html__( 'Off', 'tpebl' ),
				'default'   => 'yes',
			)
		);
		$this->add_control(
			'age_head_img',
			array(
				'label'     => esc_html__( 'Logo', 'tpebl' ),
				'type'      => Controls_Manager::MEDIA,
				'dynamic'   => array( 'active' => true ),
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'age_icon_img_type' => 'yes',
				),
			)
		);
		$this->add_control(
			'age_gate_title',
			array(
				'label'     => esc_html__( 'Title', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'tpebl' ),
				'label_off' => esc_html__( 'Off', 'tpebl' ),
				'default'   => 'yes',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'age_gate_title_input',
			array(
				'label'       => esc_html__( 'Title', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array( 'active' => true ),
				'default'     => esc_html__( 'Age Verification', 'tpebl' ),
				'placeholder' => esc_html__( 'Enter Your Title', 'tpebl' ),
				'label_block' => false,
				'condition'   => array(
					'age_gate_title' => 'yes',
				),
			)
		);
		$this->add_control(
			'age_gate_description',
			array(
				'label'     => esc_html__( 'Description', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'tpebl' ),
				'label_off' => esc_html__( 'Off', 'tpebl' ),
				'default'   => 'yes',
			)
		);
		$this->add_control(
			'age_gate_description_input',
			array(
				'label'       => esc_html__( 'Description', 'tpebl' ),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => esc_html__( 'You must be 18 years old to visit our website.', 'tpebl' ),
				'placeholder' => esc_html__( 'Enter Description', 'tpebl' ),
				'dynamic'     => array( 'active' => true ),
				'condition'   => array(
					'age_verify_method'    => 'method-1',
					'age_gate_description' => 'yes',
				),
			)
		);
		$this->add_control(
			'age_gate_description_inputwo',
			array(
				'label'       => esc_html__( 'Description', 'tpebl' ),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => esc_html__( 'You must be 18 years old to visit our website. Enter your birthdate below, your age will be calculated automatically.', 'tpebl' ),
				'placeholder' => esc_html__( 'Enter Description', 'tpebl' ),
				'dynamic'     => array( 'active' => true ),
				'condition'   => array(
					'age_verify_method'    => 'method-2',
					'age_gate_description' => 'yes',
				),
			)
		);
		$this->add_control(
			'age_gate_description_inputhree',
			array(
				'label'       => esc_html__( 'Description', 'tpebl' ),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => esc_html__( 'You must be 18 years old to visit our website. Select your preference below.', 'tpebl' ),
				'placeholder' => esc_html__( 'Enter Description', 'tpebl' ),
				'dynamic'     => array( 'active' => true ),
				'condition'   => array(
					'age_verify_method'    => 'method-3',
					'age_gate_description' => 'yes',
				),
			)
		);
		$this->add_control(
			'chkinput_text',
			array(
				'label'       => esc_html__( 'Check Input Text', 'tpebl' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => array( 'active' => true ),
				'default'     => esc_html__( 'I confirm that I am 18 years old or over', 'tpebl' ),
				'placeholder' => esc_html__( 'Enter Text', 'tpebl' ),
				'separator'   => 'before',
				'condition'   => array(
					'age_verify_method' => 'method-1',
				),

			)
		);
		$this->add_control(
			'birthyears',
			array(
				'label'     => esc_html__( 'Minimum Age Limit', 'tpebl' ),
				'type'      => Controls_Manager::NUMBER,
				'dynamic'   => array(
					'active' => true,
				),
				'min'       => 6,
				'max'       => 100,
				'default'   => 18,
				'condition' => array(
					'age_verify_method' => 'method-2',
				),
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'db_max_width',
			array(
				'label'       => esc_html__( 'Form Content Max-width', 'tpebl' ),
				'type'        => Controls_Manager::SLIDER,
				'separator'   => 'before',
				'range'       => array(
					'%' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-agegate-wrapper .tp-agegate-method' => 'max-width: {{SIZE}}%;',
				),
				'condition'   => array(
					'age_verify_method' => array( 'method-2', 'method-3' ),
				),
			)
		);
		$this->add_control(
			'age_extra_info_switch',
			array(
				'label'     => esc_html__( 'Extra Info', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'tpebl' ),
				'label_off' => esc_html__( 'Off', 'tpebl' ),
				'default'   => 'yes',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'age_extra_info',
			array(
				'label'       => esc_html__( 'Extra Info', 'tpebl' ),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => esc_html__( 'By entering this site you are agreeing to the Terms of Use and Privacy Policy.', 'tpebl' ),
				'placeholder' => esc_html__( 'Type your extra info here', 'tpebl' ),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'age_extra_info_switch' => 'yes',
				),
			)
		);
		$this->add_control(
			'age_gate_wrong_message',
			array(
				'label'       => esc_html__( 'Error Message', 'tpebl' ),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => esc_html__( 'Sorry...!!! You are not eligible for this website', 'tpebl' ),
				'placeholder' => esc_html__( 'Enter Your Message', 'tpebl' ),
				'dynamic'     => array( 'active' => true ),
				'condition'   => array(
					'age_verify_method' => array( 'method-2', 'method-3' ),
				),
				'separator'   => 'before',
			)
		);
		$this->add_responsive_control(
			'age_gate_align',
			array(
				'label'     => esc_html__( 'Alignment', 'tpebl' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => 'center',
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
				'separator' => 'before',
				'selectors' => array(
					'{{WRAPPER}} .tp-agegate-wrapper .tp-agegate-inner-wrapper .tp-agegate-boxes,
					{{WRAPPER}} .tp-agegate-wrapper .tp-agegate-inner-wrapper .tp-agegate-boxes *:not(.tp-age-btn-ex)' => 'align-items: {{VALUE}};justify-content: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'age_gate_align_txtera',
			array(
				'label'     => esc_html__( 'Textarea Alignment', 'tpebl' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => 'center',
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
					'{{WRAPPER}} .tp-agegate-wrapper .tp-agegate-inner-wrapper .tp-agegate-boxes,
					{{WRAPPER}} .tp-agegate-wrapper .tp-agegate-inner-wrapper .tp-agegate-boxes *:not(.tp-age-btn-ex)' => 'text-align: {{VALUE}};',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'button_section',
			array(
				'label' => esc_html__( 'Button', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'FirstBTn_options',
			array(
				'label'     => esc_html__( 'First Button Options', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'button_text',
			array(
				'label'       => esc_html__( 'Text', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array( 'active' => true ),
				'default'     => esc_html__( 'Enter', 'tpebl' ),
				'placeholder' => esc_html__( 'Enter Text', 'tpebl' ),
			)
		);
		$this->add_control(
			'icon_action',
			array(
				'label'     => esc_html__( 'Icon', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'tpebl' ),
				'label_off' => esc_html__( 'Off', 'tpebl' ),
				'default'   => 'yes',
			)
		);
		$this->add_control(
			'button_icon',
			array(
				'label'     => esc_html__( 'Icon library', 'tpebl' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-book-open',
					'library' => 'solid',
				),
				'condition' => array(
					'icon_action' => 'yes',
				),
			)
		);
		$this->add_control(
			'icon_position',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Icon Position', 'tpebl' ),
				'default'   => 'age_icon_prefix',
				'options'   => array(
					'age_icon_prefix'  => esc_html__( 'Prefix', 'tpebl' ),
					'age_icon_postfix' => esc_html__( 'Postfix', 'tpebl' ),
				),
				'condition' => array(
					'icon_action' => 'yes',
				),
			)
		);
		$this->add_control(
			'SecondBTn_options',
			array(
				'label'     => esc_html__( 'Second Button Options', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'age_verify_method' => 'method-3',
				),
			)
		);
		$this->add_control(
			'second_button_text',
			array(
				'label'       => esc_html__( 'Button Text', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array( 'active' => true ),
				'default'     => esc_html__( 'No', 'tpebl' ),
				'placeholder' => esc_html__( 'Enter Text', 'tpebl' ),
				'condition'   => array(
					'age_verify_method' => 'method-3',
				),
			)
		);
		$this->add_control(
			'second_icon_action',
			array(
				'label'     => esc_html__( 'Button Icon', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'tpebl' ),
				'label_off' => esc_html__( 'Off', 'tpebl' ),
				'default'   => 'yes',
				'condition' => array(
					'age_verify_method' => 'method-3',
				),
			)
		);
		$this->add_control(
			'second_button_icon',
			array(
				'label'     => esc_html__( 'Button Icon', 'tpebl' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-book-reader',
					'library' => 'solid',
				),
				'condition' => array(
					'age_verify_method'  => 'method-3',
					'second_icon_action' => 'yes',
				),
			)
		);
		$this->add_control(
			'second_icon_position',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Icon Position', 'tpebl' ),
				'default'   => 'age_scnd_icon_prefix',
				'options'   => array(
					'age_scnd_icon_prefix'  => esc_html__( 'Prefix', 'tpebl' ),
					'age_scnd_icon_postfix' => esc_html__( 'Postfix', 'tpebl' ),
				),
				'condition' => array(
					'age_verify_method'  => 'method-3',
					'second_icon_action' => 'yes',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'ag_extra_opt',
			array(
				'label' => esc_html__( 'Extra Option', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'age_sec_bg_image_switch',
			array(
				'label'     => esc_html__( 'Background Image', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'tpebl' ),
				'label_off' => esc_html__( 'Off', 'tpebl' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'age_sec_bg_image',
			array(
				'label'     => esc_html__( 'Background', 'tpebl' ),
				'type'      => Controls_Manager::MEDIA,
				'dynamic'   => array( 'active' => true ),
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'age_sec_bg_image_switch' => 'yes',
				),
			)
		);
		$this->add_control(
			'age_bgImg_pos',
			array(
				'label'     => esc_html__( 'Background Position', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'center center',
				'options'   => l_theplus_get_image_position_options(),
				'selectors' => array(
					'{{WRAPPER}} .tp-agegate-wrapper' => 'background-position:{{VALUE}} !important;',
				),
				'condition' => array(
					'age_sec_bg_image_switch' => 'yes',
				),
			)
		);
		$this->add_control(
			'age_sec_bg_overlay_color',
			array(
				'label'     => esc_html__( 'Overlay Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-agegate-wrapper:after' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'age_sec_bg_image_switch' => 'yes',
				),
			)
		);
		$this->add_control(
			'age_side_image_show',
			array(
				'label'     => esc_html__( 'Right Side Image', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'tpebl' ),
				'label_off' => esc_html__( 'Off', 'tpebl' ),
				'default'   => '',
			)
		);
		$this->add_control(
			'age_side_img',
			array(
				'label'     => esc_html__( 'Image', 'tpebl' ),
				'type'      => Controls_Manager::MEDIA,
				'dynamic'   => array( 'active' => true ),
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'age_side_image_show' => 'yes',
				),
			)
		);
		$this->add_control(
			'age_rightImg_pos',
			array(
				'label'     => esc_html__( 'Right Image Position', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'center center',
				'options'   => l_theplus_get_image_position_options(),
				'selectors' => array(
					'{{WRAPPER}} .tp-agegate-boxes.tp-equ-width-50' => 'background-position:{{VALUE}} !important;',
				),
				'condition' => array(
					'age_side_image_show' => 'yes',
				),
			)
		);
		$this->add_control(
			'age_cookies',
			array(
				'label'     => esc_html__( 'Cookies', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'tpebl' ),
				'label_off' => esc_html__( 'Off', 'tpebl' ),
				'default'   => 'yes',
			)
		);
		$this->add_control(
			'age_cookies_days',
			array(
				'label'     => esc_html__( 'Cookies Expiry Time', 'tpebl' ),
				'type'      => Controls_Manager::NUMBER,
				'dynamic'   => array(
					'active' => true,
				),
				'min'       => 1,
				'max'       => 365,
				'default'   => 10,
				'condition' => array(
					'age_cookies' => 'yes',
				),
			)
		);
		$this->add_control(
			'age_gate_cookiNote',
			array(
				'type'        => Controls_Manager::RAW_HTML,
				'raw'         => '<p class="tp-controller-notice"><i>Note : Set The Number Of Days Cookies To Be Saved.</i></p>',
				'label_block' => true,
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'age_logo_styling',
			array(
				'label'     => esc_html__( 'Logo', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'age_icon_img_type' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'logo_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Logo Size', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 500,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-agegate-inner-wrapper .tp-agegate-boxes .tp-age-ii .tp-agegate-image' => 'max-width: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
			'logo_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-agegate-inner-wrapper .tp-agegate-boxes .tp-age-ii .tp-agegate-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'logo_margin',
			array(
				'label'      => esc_html__( 'Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-agegate-inner-wrapper .tp-agegate-boxes .tp-age-ii .tp-agegate-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'age_title_styling',
			array(
				'label'     => esc_html__( 'Title', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'age_gate_title' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'title_typo',
				'label'     => esc_html__( 'Typography', 'tpebl' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .tp-agegate-boxes .tp-agegate-title',
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'title_padding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-agegate-boxes .tp-agegate-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'title_margin',
			array(
				'label'      => esc_html__( 'Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-agegate-boxes .tp-agegate-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->start_controls_tabs( 'age_title_color' );
		$this->start_controls_tab(
			'title_color_n',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'titleNmlColor',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-agegate-boxes .tp-agegate-title' => 'color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'title_color_h',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'titleHvrColor',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-agegate-boxes:hover .tp-agegate-title' => 'color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'age_desc_styling',
			array(
				'label'     => esc_html__( 'Description', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'age_gate_description' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'desc_typo',
				'label'    => esc_html__( 'Typography', 'tpebl' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-agegate-boxes .tp-agegate-description',
			)
		);
		$this->add_responsive_control(
			'desc_padding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-agegate-boxes .tp-agegate-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'desc_margin',
			array(
				'label'      => esc_html__( 'Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-agegate-boxes .tp-agegate-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->start_controls_tabs( 'age_desc_color' );
		$this->start_controls_tab(
			'desc_color_n',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'descNmlColor',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-agegate-boxes .tp-agegate-description' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'descNmlBG',
				'label'    => esc_html__( 'Background Type', 'tpebl' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-agegate-boxes .tp-agegate-description',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'descNmlBorder',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-agegate-boxes .tp-agegate-description',
			)
		);
		$this->add_responsive_control(
			'descNmlBRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-agegate-boxes .tp-agegate-description' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'desc_color_h',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'descHvrColor',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-agegate-boxes:hover .tp-agegate-description' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'descHvrBG',
				'label'    => esc_html__( 'Background Type', 'tpebl' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-agegate-boxes:hover .tp-agegate-description',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'descHvrBorder',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-agegate-boxes:hover .tp-agegate-description',
			)
		);
		$this->add_responsive_control(
			'descHvrBRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-agegate-boxes:hover .tp-agegate-description' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'age_chktxt_styling',
			array(
				'label'     => esc_html__( 'Checkbox Icon/Text', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'age_verify_method' => 'method-1',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'chktxt_typo',
				'label'     => esc_html__( 'Typography', 'tpebl' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .tp-agegate-boxes .tp-agegate-method .agc_checkbox',
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'chktxt_padding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-agegate-boxes .tp-agegate-method .agc_checkbox' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'chktxt_margin',
			array(
				'label'      => esc_html__( 'Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-agegate-boxes .tp-agegate-method .agc_checkbox' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->start_controls_tabs( 'age_chktxt_color' );
		$this->start_controls_tab(
			'chktxt_color_n',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'chktxtNmlColor',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-agegate-boxes .tp-agegate-method .agc_checkbox' => 'color: {{VALUE}};',
				),

			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'chktxt_color_h',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'chktxtHvrColor',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-agegate-boxes:hover .tp-agegate-method .agc_checkbox' => 'color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'age_inputdate_styling',
			array(
				'label'     => esc_html__( 'Input Field', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'age_verify_method' => 'method-2',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'inputdate_typo',
				'label'    => esc_html__( 'Typography', 'tpebl' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-agegate-boxes .tp-agegate-method .age_verify_birthdate',
			)
		);
		$this->add_responsive_control(
			'inputdate_margin',
			array(
				'label'      => esc_html__( 'Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-agegate-boxes .tp-agegate-method .age_verify_birthdate' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'inputdate_padding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-agegate-boxes .tp-agegate-method .age_verify_birthdate' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->start_controls_tabs( 'age_inputdate_tab' );
		$this->start_controls_tab(
			'inputdate_n',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'inputdate_color',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-agegate-boxes .tp-agegate-method .age_verify_birthdate' => 'color:{{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'inputdate_background',
				'label'    => esc_html__( 'Background Type', 'tpebl' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-agegate-boxes .tp-agegate-method .age_verify_birthdate',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'inputdate_border',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-agegate-boxes .tp-agegate-method .age_verify_birthdate',
			)
		);
		$this->add_responsive_control(
			'inputdate_bradius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-agegate-boxes .tp-agegate-method .age_verify_birthdate' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'inputdate_Shadow',
				'label'    => esc_html__( 'Box Shadow', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-agegate-boxes .tp-agegate-method .age_verify_birthdate',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'inputdate_h',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'inputdate_color_h',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-agegate-boxes:hover .tp-agegate-method .age_verify_birthdate' => 'color:{{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'inputdate_background_h',
				'label'    => esc_html__( 'Background Type', 'tpebl' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-agegate-boxes:hover .tp-agegate-method .age_verify_birthdate',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'inputdate_border_h',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-agegate-boxes:hover .tp-agegate-method .age_verify_birthdate',
			)
		);
		$this->add_responsive_control(
			'inputdate_bradius_h',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-agegate-boxes:hover .tp-agegate-method .age_verify_birthdate' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'inputdate_Shadow_h',
				'label'    => esc_html__( 'Box Shadow', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-agegate-boxes:hover .tp-agegate-method .age_verify_birthdate',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'age_firstbtn_styling',
			array(
				'label' => esc_html__( 'First Button', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'fbtn_typo',
				'label'    => esc_html__( 'Typography', 'tpebl' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-agegate-boxes .tp-agegate-method .age_vms .age_vmb,{{WRAPPER}} .tp-agegate-boxes .tp-agegate-method .age_verify_method_btnsubmit,{{WRAPPER}} .tp-agegate-boxes .tp-agegate-method .tp-age-btn-yes',
			)
		);
		$this->add_responsive_control(
			'fbtn_padding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-agegate-boxes .tp-agegate-method .age_vms .age_vmb,
					{{WRAPPER}} .tp-agegate-boxes .tp-agegate-method .age_verify_method_btnsubmit,
					{{WRAPPER}} .tp-agegate-boxes .tp-agegate-method .tp-age-btn-yes' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'fbtn_margin',
			array(
				'label'      => esc_html__( 'Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-agegate-boxes .tp-agegate-method .age_vms,
					{{WRAPPER}} .tp-agegate-boxes .tp-agegate-method .age_verify_method_btnsubmit,
					{{WRAPPER}} .tp-agegate-boxes .tp-agegate-method .tp-age-btn-yes' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->start_controls_tabs( 'age_firstbtn_tab' );
		$this->start_controls_tab(
			'fbtn_n',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'fbtn_color',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-agegate-boxes .tp-agegate-method .age_vms .age_vmb,
					{{WRAPPER}} .tp-agegate-boxes .tp-agegate-method .age_verify_method_btnsubmit,
					{{WRAPPER}} .tp-agegate-boxes .tp-agegate-method .tp-age-btn-yes' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'fbtn_background',
				'label'    => esc_html__( 'Background Type', 'tpebl' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-agegate-boxes .tp-agegate-method .age_vms .age_vmb,
				{{WRAPPER}} .tp-agegate-boxes .tp-agegate-method .age_verify_method_btnsubmit,
				{{WRAPPER}} .tp-agegate-boxes .tp-agegate-method .tp-age-btn-yes',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'fbtn_border',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-agegate-boxes .tp-agegate-method .age_vms .age_vmb,
					{{WRAPPER}} .tp-agegate-boxes .tp-agegate-method .age_verify_method_btnsubmit,
					{{WRAPPER}} .tp-agegate-boxes .tp-agegate-method .tp-age-btn-yes',
			)
		);
		$this->add_responsive_control(
			'fbtn_bradius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-agegate-boxes .tp-agegate-method .age_vms .age_vmb,
					{{WRAPPER}} .tp-agegate-boxes .tp-agegate-method .age_verify_method_btnsubmit,
					{{WRAPPER}} .tp-agegate-boxes .tp-agegate-method .tp-age-btn-yes' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'fbtn_Shadow',
				'label'    => esc_html__( 'Box Shadow', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-agegate-boxes .tp-agegate-method .age_vms .age_vmb,
					{{WRAPPER}} .tp-agegate-boxes .tp-agegate-method .age_verify_method_btnsubmit,
					{{WRAPPER}} .tp-agegate-boxes .tp-agegate-method .tp-age-btn-yes',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'fbtn_h',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'fbtn_color_h',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-agegate-boxes:hover .tp-agegate-method .age_vms .age_vmb,
					{{WRAPPER}} .tp-agegate-boxes:hover .tp-agegate-method .age_verify_method_btnsubmit,
					{{WRAPPER}} .tp-agegate-boxes:hover .tp-agegate-method .tp-age-btn-yes' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'fbtn_background_h',
				'label'    => esc_html__( 'Background Type', 'tpebl' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-agegate-boxes:hover .tp-agegate-method .age_vms .age_vmb,
				{{WRAPPER}} .tp-agegate-boxes:hover .tp-agegate-method .age_verify_method_btnsubmit,
				{{WRAPPER}} .tp-agegate-boxes:hover .tp-agegate-method .tp-age-btn-yes',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'fbtn_border_h',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-agegate-boxes:hover .tp-agegate-method .age_vms .age_vmb,
					{{WRAPPER}} .tp-agegate-boxes:hover .tp-agegate-method .age_verify_method_btnsubmit,
					{{WRAPPER}} .tp-agegate-boxes:hover .tp-agegate-method .tp-age-btn-yes',
			)
		);
		$this->add_responsive_control(
			'fbtn_bradius_h',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-agegate-boxes:hover .tp-agegate-method .age_vms .age_vmb,
					{{WRAPPER}} .tp-agegate-boxes:hover .tp-agegate-method .age_verify_method_btnsubmit,
					{{WRAPPER}} .tp-agegate-boxes:hover .tp-agegate-method .tp-age-btn-yes' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'fbtn_Shadow_h',
				'label'    => esc_html__( 'Box Shadow', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-agegate-boxes:hover .tp-agegate-method .age_vms .age_vmb,
					{{WRAPPER}} .tp-agegate-boxes:hover .tp-agegate-method .age_verify_method_btnsubmit,
					{{WRAPPER}} .tp-agegate-boxes:hover .tp-agegate-method .tp-age-btn-yes',

			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'age_tglicon_styling',
			array(
				'label'     => esc_html__( 'First Button Icon', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'icon_action' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'tgl_icn_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Size', 'tpebl' ),
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
					'{{WRAPPER}} .tp-method-1 .tp-agegate-boxes .tp-agegate-method .age_vmb i,{{WRAPPER}} .tp-method-2 .tp-agegate-boxes .tp-agegate-method .age_verify_method_btnsubmit i,{{WRAPPER}} .tp-method-3 .tp-agegate-boxes .tp-agegate-method .tp-age-btn-yes i' => 'font-size: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .tp-method-1 .tp-agegate-boxes .tp-agegate-method .age_vmb svg,{{WRAPPER}} .tp-method-2 .tp-agegate-boxes .tp-agegate-method .age_verify_method_btnsubmit svg,{{WRAPPER}} .tp-method-3 .tp-agegate-boxes .tp-agegate-method .tp-age-btn-yes svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
			'tgl_icn_space',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Offset', 'tpebl' ),
				'size_units'  => array( 'px', '%' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					),
					'%'  => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 10,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-method-1 .tp-agegate-boxes .tp-agegate-method .age_vmb i,{{WRAPPER}} .tp-method-2 .tp-agegate-boxes .tp-agegate-method .age_verify_method_btnsubmit i,{{WRAPPER}} .tp-method-3 .tp-agegate-boxes .tp-agegate-method .tp-age-btn-yes i,{{WRAPPER}} .tp-method-1 .tp-agegate-boxes .tp-agegate-method .age_vmb svg,{{WRAPPER}} .tp-method-2 .tp-agegate-boxes .tp-agegate-method .age_verify_method_btnsubmit svg,{{WRAPPER}} .tp-method-3 .tp-agegate-boxes .tp-agegate-method .tp-age-btn-yes svg' => 'margin-left: {{SIZE}}{{UNIT}}',
				),
				'condition'   => array(
					'icon_position' => array( 'age_icon_postfix' ),
				),
			)
		);
		$this->add_responsive_control(
			'tgl_icn_space_left',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Offset', 'tpebl' ),
				'size_units'  => array( 'px', '%' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					),
					'%'  => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 10,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-method-1 .tp-agegate-boxes .tp-agegate-method .age_vmb i,{{WRAPPER}} .tp-method-2 .tp-agegate-boxes .tp-agegate-method .age_verify_method_btnsubmit i,{{WRAPPER}} .tp-method-3 .tp-agegate-boxes .tp-agegate-method .tp-age-btn-yes i,{{WRAPPER}} .tp-method-1 .tp-agegate-boxes .tp-agegate-method .age_vmb svg,{{WRAPPER}} .tp-method-2 .tp-agegate-boxes .tp-agegate-method .age_verify_method_btnsubmit svg,{{WRAPPER}} .tp-method-3 .tp-agegate-boxes .tp-agegate-method .tp-age-btn-yes svg' => 'margin-right: {{SIZE}}{{UNIT}}',
				),
				'condition'   => array(
					'icon_position' => array( 'age_icon_prefix' ),
				),
			)
		);
		$this->add_responsive_control(
			'tgl_margin',
			array(
				'label'      => esc_html__( 'Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-method-1 .tp-agegate-boxes .tp-agegate-method .age_vmb i,{{WRAPPER}} .tp-method-2 .tp-agegate-boxes .tp-agegate-method .age_verify_method_btnsubmit i,{{WRAPPER}} .tp-method-3 .tp-agegate-boxes .tp-agegate-method .tp-age-btn-yes i,{{WRAPPER}} .tp-method-1 .tp-agegate-boxes .tp-agegate-method .age_vmb svg,{{WRAPPER}} .tp-method-2 .tp-agegate-boxes .tp-agegate-method .age_verify_method_btnsubmit svg,{{WRAPPER}} .tp-method-3 .tp-agegate-boxes .tp-agegate-method .tp-age-btn-yes svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->start_controls_tabs( 'tgl_icon_color' );
		$this->start_controls_tab(
			'tglicn_color_n',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'tglNormalColor',
			array(
				'label'     => esc_html__( 'Icon Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-method-1 .tp-agegate-boxes .tp-agegate-method .age_vmb i,{{WRAPPER}} .tp-method-2 .tp-agegate-boxes .tp-agegate-method .age_verify_method_btnsubmit i,{{WRAPPER}} .tp-method-3 .tp-agegate-boxes .tp-agegate-method .tp-age-btn-yes i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tp-method-1 .tp-agegate-boxes .tp-agegate-method .age_vmb svg,{{WRAPPER}} .tp-method-2 .tp-agegate-boxes .tp-agegate-method .age_verify_method_btnsubmit svg,{{WRAPPER}} .tp-method-3 .tp-agegate-boxes .tp-agegate-method .tp-age-btn-yes svg' => 'fill: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tglicn_color_h',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'tglHoverColor',
			array(
				'label'     => esc_html__( 'Icon Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-method-1 .tp-agegate-boxes:hover .tp-agegate-method .age_vmb i,{{WRAPPER}} .tp-method-2 .tp-agegate-boxes:hover .tp-agegate-method .age_verify_method_btnsubmit i,{{WRAPPER}} .tp-method-3 .tp-agegate-boxes:hover .tp-agegate-method .tp-age-btn-yes i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tp-method-1 .tp-agegate-boxes:hover .tp-agegate-method .age_vmb svg,{{WRAPPER}} .tp-method-2 .tp-agegate-boxes:hover .tp-agegate-method .age_verify_method_btnsubmit svg,{{WRAPPER}} .tp-method-3 .tp-agegate-boxes:hover .tp-agegate-method .tp-age-btn-yes svg' => 'fill: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'age_scndbtn_styling',
			array(
				'label'     => esc_html__( 'Second Button', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'age_verify_method' => 'method-3',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'sbtn_typo',
				'label'    => esc_html__( 'Typography', 'tpebl' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-agegate-boxes .tp-agegate-method .tp-age-btn-no',
			)
		);
		$this->add_responsive_control(
			'sbtn_padding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-agegate-boxes .tp-agegate-method .tp-age-btn-no' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'sbtn_margin',
			array(
				'label'      => esc_html__( 'Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-agegate-boxes .tp-agegate-method .tp-age-btn-no' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->start_controls_tabs( 'age_scndbtn_tab' );
		$this->start_controls_tab(
			'sbtn_n',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'sbtn_color',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-agegate-boxes .tp-agegate-method .tp-age-btn-no' => 'color:{{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'sbtn_background',
				'label'    => esc_html__( 'Background Type', 'tpebl' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-agegate-boxes .tp-agegate-method .tp-age-btn-no',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'sbtn_border',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-agegate-boxes .tp-agegate-method .tp-age-btn-no',
			)
		);
		$this->add_responsive_control(
			'sbtn_bradius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-agegate-boxes .tp-agegate-method .tp-age-btn-no' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'sbtn_Shadow',
				'label'    => esc_html__( 'Box Shadow', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-agegate-boxes .tp-agegate-method .tp-age-btn-no',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'sbtn_h',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'sbtn_color_h',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-agegate-boxes:hover .tp-agegate-method .tp-age-btn-no' => 'color:{{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'sbtn_background_h',
				'label'    => esc_html__( 'Background Type', 'tpebl' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-agegate-boxes:hover .tp-agegate-method .tp-age-btn-no',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'sbtn_border_h',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-agegate-boxes:hover .tp-agegate-method .tp-age-btn-no',
			)
		);
		$this->add_responsive_control(
			'sbtn_bradius_h',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-agegate-boxes:hover .tp-agegate-method .tp-age-btn-no' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'sbtn_Shadow_h',
				'label'    => esc_html__( 'Box Shadow', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-agegate-boxes:hover .tp-agegate-method .tp-age-btn-no',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'scndBtn_icn_styling',
			array(
				'label'     => esc_html__( 'Second Button Icon', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'age_verify_method'  => 'method-3',
					'second_icon_action' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'scndBtn_icn_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Size', 'tpebl' ),
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
					'{{WRAPPER}} .tp-method-3 .tp-agegate-boxes .tp-agegate-method .tp-age-btn-no i' => 'font-size: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .tp-method-3 .tp-agegate-boxes .tp-agegate-method .tp-age-btn-no svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
			'scndBtn_icn_space',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Offset', 'tpebl' ),
				'size_units'  => array( 'px', '%' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					),
					'%'  => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 10,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-method-3 .tp-agegate-boxes .tp-agegate-method .tp-age-btn-no i,{{WRAPPER}} .tp-method-3 .tp-agegate-boxes .tp-agegate-method .tp-age-btn-no svg' => 'margin-left: {{SIZE}}{{UNIT}}',
				),
				'condition'   => array(
					'second_icon_position' => array( 'age_scnd_icon_postfix' ),
				),
			)
		);
		$this->add_responsive_control(
			'scndBtn_icn_space_left',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Offset', 'tpebl' ),
				'size_units'  => array( 'px', '%' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					),
					'%'  => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 10,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-method-3 .tp-agegate-boxes .tp-agegate-method .tp-age-btn-no i,{{WRAPPER}} .tp-method-3 .tp-agegate-boxes .tp-agegate-method .tp-age-btn-no svg' => 'margin-right: {{SIZE}}{{UNIT}}',
				),
				'condition'   => array(
					'second_icon_position' => array( 'age_scnd_icon_prefix' ),
				),
			)
		);
		$this->add_responsive_control(
			'scndBtn_margin',
			array(
				'label'      => esc_html__( 'Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-method-3 .tp-agegate-boxes .tp-agegate-method .tp-age-btn-no i,{{WRAPPER}} .tp-method-3 .tp-agegate-boxes .tp-agegate-method .tp-age-btn-no svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->start_controls_tabs( 'scndBtn_icon_color' );
		$this->start_controls_tab(
			'scndBtnicn_color_n',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'scndBtnNormalColor',
			array(
				'label'     => esc_html__( 'Icon Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-method-3 .tp-agegate-boxes .tp-agegate-method .tp-age-btn-no i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tp-method-3 .tp-agegate-boxes .tp-agegate-method .tp-age-btn-no svg' => 'fill: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'scndBtnicn_color_h',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'scndBtnHoverColor',
			array(
				'label'     => esc_html__( 'Icon Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-method-3 .tp-agegate-boxes:hover .tp-agegate-method .tp-age-btn-no i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tp-method-3 .tp-agegate-boxes:hover .tp-agegate-method .tp-age-btn-no svg' => 'fill: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'age_einfo_styling',
			array(
				'label'     => esc_html__( 'Extra Info', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'age_extra_info_switch' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'einfo_Size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Text Size', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 500,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 25,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-agegate-boxes .tp-agegate-extra-info' => 'font-size: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'info_typo',
				'label'     => esc_html__( 'Typography', 'tpebl' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .tp-agegate-boxes .tp-agegate-extra-info',
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'info_padding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-agegate-boxes .tp-agegate-extra-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'info_margin',
			array(
				'label'      => esc_html__( 'Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-agegate-boxes .tp-agegate-extra-info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->start_controls_tabs( 'age_einfo_color' );
		$this->start_controls_tab(
			'einfo_color_n',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'einfoNmlColor',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-agegate-boxes .tp-agegate-extra-info' => 'color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'einfo_color_h',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'einfoHvrColor',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-agegate-boxes:hover .tp-agegate-extra-info' => 'color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'age_message_styling',
			array(
				'label'     => esc_html__( 'Error Message', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'age_verify_method' => array( 'method-2', 'method-3' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'msg_typo',
				'label'    => esc_html__( 'Typography', 'tpebl' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-agegate-boxes .tp-age-wm',
			)
		);
		$this->add_responsive_control(
			'msg_padding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-agegate-boxes .tp-age-wm' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'msg_margin',
			array(
				'label'      => esc_html__( 'Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-agegate-boxes .tp-age-wm' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->start_controls_tabs( 'age_msg_color' );
		$this->start_controls_tab(
			'msg_color_n',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'msgNmlColor',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-agegate-boxes .tp-age-wm' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'msgNmlBG',
				'label'    => esc_html__( 'Background Type', 'tpebl' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-agegate-boxes .tp-age-wm',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'msgNmlBorder',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-agegate-boxes .tp-age-wm',
			)
		);
		$this->add_responsive_control(
			'msgNmlBRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-agegate-boxes .tp-age-wm' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'msgNmlShadow',
				'label'    => esc_html__( 'Box Shadow', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-agegate-boxes .tp-age-wm',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'msg_color_h',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'msgHvrColor',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-agegate-boxes:hover .tp-age-wm' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'msgHvrBG',
				'label'    => esc_html__( 'Background Type', 'tpebl' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-agegate-boxes:hover .tp-age-wm',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'msgHvrBorder',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-agegate-boxes:hover .tp-age-wm',
			)
		);
		$this->add_responsive_control(
			'msgHvrBRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-agegate-boxes:hover .tp-age-wm' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'msgHvrShadow',
				'label'    => esc_html__( 'Box Shadow', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-agegate-boxes:hover .tp-age-wm',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'age_box_styling',
			array(
				'label' => esc_html__( 'Box', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'box_position',
			array(
				'label'     => esc_html__( 'Position', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'tpebl' ),
				'label_off' => esc_html__( 'Off', 'tpebl' ),
				'default'   => 'no',
			)
		);
		$this->add_responsive_control(
			'box_left_auto',
			array(
				'label'     => esc_html__( 'Left (Auto)', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'On', 'tpebl' ),
				'label_off' => esc_html__( 'Off', 'tpebl' ),
				'condition' => array(
					'box_position' => array( 'yes' ),
				),
			)
		);
		$this->add_responsive_control(
			'box_pos_xposition',
			array(
				'label'      => esc_html__( 'Left', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
					'%'  => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'separator'  => 'after',
				'condition'  => array(
					'box_position'  => array( 'yes' ),
					'box_left_auto' => array( 'yes' ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-agegate-inner-wrapper' => 'margin-left: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'box_right_auto',
			array(
				'label'     => esc_html__( 'Right (Auto)', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'On', 'tpebl' ),
				'label_off' => esc_html__( 'Off', 'tpebl' ),
				'condition' => array(
					'box_position' => array( 'yes' ),
				),
			)
		);
		$this->add_responsive_control(
			'box_pos_rightposition',
			array(
				'label'      => esc_html__( 'Right', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
					'%'  => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'condition'  => array(
					'box_position'   => array( 'yes' ),
					'box_right_auto' => array( 'yes' ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-agegate-inner-wrapper' => 'margin-right: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'box_width',
			array(
				'label'      => esc_html__( 'Width', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'separator'  => 'before',
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 2000,
						'step' => 5,
					),
					'%'  => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 500,
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-agegate-inner-wrapper' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'box_height',
			array(
				'label'      => esc_html__( 'Height', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 2000,
						'step' => 5,
					),
					'%'  => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 400,
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-agegate-inner-wrapper' => 'min-height: {{SIZE}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->start_controls_tabs( 'age_box_bgcolor' );
		$this->start_controls_tab(
			'box_bg_n',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'box_backgroundNml',
				'label'    => esc_html__( 'Background Type', 'tpebl' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-agegate-inner-wrapper',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'box_borderNml',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-agegate-inner-wrapper',
			)
		);
		$this->add_responsive_control(
			'box_bradiusNml',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-agegate-inner-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'box_ShadowNml',
				'label'    => esc_html__( 'Box Shadow', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-agegate-inner-wrapper',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'box_bg_h',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'box_backgroundHvr',
				'label'    => esc_html__( 'Background Type', 'tpebl' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-agegate-inner-wrapper:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'box_borderHvr',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-agegate-inner-wrapper:hover',
			)
		);
		$this->add_responsive_control(
			'box_bradiusHvr',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-agegate-inner-wrapper:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'box_ShadowHvr',
				'label'    => esc_html__( 'Box Shadow', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-agegate-inner-wrapper:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		include L_THEPLUS_PATH . 'modules/widgets/theplus-needhelp.php';
		include L_THEPLUS_PATH . 'modules/widgets/theplus-profeatures.php';
	}

	/**
	 * Render Age-gate
	 *
	 * Written in PHP and HTML.
	 *
	 * @since 1.0.1
	 *
	 * @version 5.4.2
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$logo_on    = ! empty( $settings['age_icon_img_type'] ) ? $settings['age_icon_img_type'] : '';
		$desc_on    = ! empty( $settings['age_gate_description'] ) ? $settings['age_gate_description'] : '';
		$title_on   = ! empty( $settings['age_gate_title'] ) ? $settings['age_gate_title'] : '';
		$ex_info_on = ! empty( $settings['age_extra_info_switch'] ) ? $settings['age_extra_info_switch'] : '';
		$bg_imag_on = ! empty( $settings['age_sec_bg_image_switch'] ) ? $settings['age_sec_bg_image_switch'] : '';

		$title_txt = ! empty( $settings['age_gate_title_input'] ) ? $settings['age_gate_title_input'] : '';

		$extra_info = $settings['age_extra_info'];
		$error_msg  = $settings['age_gate_wrong_message'];
		$side_image = ! empty( $settings['age_side_image_show'] ) ? $settings['age_side_image_show'] : '';

		$c_box_text  = ! empty( $settings['chkinput_text'] ) ? $settings['chkinput_text'] : '';
		$btn_text    = ! empty( $settings['button_text'] ) ? $settings['button_text'] : '';
		$icon_pos    = ! empty( $settings['icon_position'] ) ? $settings['icon_position'] : 'age_icon_prefix';
		$icon_action = ! empty( $settings['icon_action'] ) ? $settings['icon_action'] : '';

		$s_btn_text = ! empty( $settings['second_button_text'] ) ? $settings['second_button_text'] : '';
		$s_icon_pos = ! empty( $settings['second_icon_position'] ) ? $settings['second_icon_position'] : 'age_scnd_icon_prefix';

		$method_type  = ! empty( $settings['age_verify_method'] ) ? $settings['age_verify_method'] : 'method-1';
		$age_side_img = ! empty( $settings['age_side_img']['url'] ) ? $settings['age_side_img']['url'] : '';

		$bg_img       = ! empty( $settings['age_sec_bg_image']['url'] ) ? $settings['age_sec_bg_image']['url'] : '';
		$cookies      = ! empty( $settings['age_cookies'] ) ? $settings['age_cookies'] : '';
		$cookies_days = ! empty( $settings['age_cookies_days'] ) ? $settings['age_cookies_days'] : 10;
		$se_btn_icon  = ! empty( $settings['second_button_icon'] ) ? $settings['second_button_icon'] : '';

		$desc_html = '';
		if ( 'yes' === $desc_on ) {

			if ( 'method-1' === $method_type ) {
				$desc_html = $settings['age_gate_description_input'];
			} elseif ( 'method-2' === $method_type ) {
				$desc_html = $settings['age_gate_description_inputwo'];
			} elseif ( 'method-3' === $method_type ) {
				$desc_html = $settings['age_gate_description_inputhree'];
			}
		}

		$button_icon   = '';
		$right_img     = '';
		$data_attr     = '';
		$lazybgclass1  = '';
		$img_wrapper   = '';
		$s_button_icon = '';

		if ( 'yes' === $side_image ) {
			$right_img = 'tp-equ-width-50';
		}

		if ( 'yes' === $bg_imag_on && ! empty( $bg_img ) ) {

			if ( tp_has_lazyload() ) {
				$lazybgclass1 = ' lazy-background';
			}

			$img_wrapper = 'style="background-image:url(' . esc_url( $bg_img ) . ');background-size:cover;background-attachment:inherit;background-position:center center;"';
		}

		if ( 'yes' === $cookies ) {
			$cookies_days = isset( $cookies_days ) ? tp_senitize_js_input( $cookies_days ) : 10;
			if( is_numeric( $cookies_days ) ){
				$data_attr .= 'data-age_cookies_days="' . esc_attr( $cookies_days ) . '"';
			}else{
				$data_attr .= 'data-age_cookies_days="10"';
			}
		}

		if ( 'method-2' === $method_type ) {
			$birthyears = ! empty( $settings['birthyears'] ) ? tp_senitize_js_input( $settings['birthyears'] ) : 18;
			if( is_numeric( $cookies_days ) ){
				$data_attr .= ' data-userbirth="' . esc_attr( $birthyears ) . '"';
			}else{
				$data_attr .= ' data-userbirth="18"';
			}
		}

		if ( ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) && 'yes' !== $settings['backend_preview'] ) {
			$output = '<h3 class="theplus-posts-not-found">' . esc_html__( 'Note: You may use this widget on Header or Footer Template directly. It will load it on all pages throughout the website.', 'tpebl' ) . '</h3>';
		} else {
			$output              = '<div class="tp-agegate-wrapper ' . esc_attr( $lazybgclass1 ) . ' tp-' . esc_attr( $method_type ) . '" ' . $img_wrapper . ' ' . $data_attr . '>';
				$output         .= '<div class="tp-agegate-inner-wrapper">';
						$output .= '<div class="tp-agegate-boxes ' . esc_attr( $right_img ) . '">';

			if ( ! empty( $error_msg ) ) {
				$output .= '<div class="tp-age-wm">' . esc_html( $error_msg ) . '</div>';
			}

			$age_head_img = ! empty( $settings['age_head_img']['url'] ) ? $settings['age_head_img']['url'] : '';
			$age_head_id  = ! empty( $settings['age_head_img']['id'] ) ? $settings['age_head_img']['id'] : '';

			if ( ! empty( $logo_on ) && ! empty( $age_head_img ) ) {
				$image_id = $age_head_id;

				if ( ! empty( $image_id ) ) {
					$img_src = tp_get_image_rander( $image_id, 'full', array( 'class' => 'tp-agegate-image' ) );
					$output .= '<div class="tp-age-ii">' . $img_src . '</div>';
				} else {
					$output .= '<div class="tp-age-ii"><img src=' . esc_url( $age_head_img ) . ' class="tp-agegate-image"></div>';
				}
			}

			if ( 'yes' === $title_on && ! empty( $title_txt ) ) {
				$output .= '<div class="tp-agegate-title">' . esc_html( $title_txt ) . '</div>';
			}

			if ( ! empty( $desc_html ) ) {
				$output .= '<div class="tp-agegate-description">' . wp_kses_post( $desc_html ) . '</div>';
			}
							$output .= '<div class="tp-agegate-method">';

			$icon_before = '';
			$icon_after  = '';

			if ( 'yes' === $icon_action ) {
				$btn_icon = ! empty( $settings['button_icon'] ) ? $settings['button_icon'] : '';

				if ( ! empty( $btn_icon ) ) {
					ob_start();
					\Elementor\Icons_Manager::render_icon( $btn_icon, array( 'aria-hidden' => 'true' ) );
					$button_icon = ob_get_contents();
					ob_end_clean();
				}

				if ( 'age_icon_prefix' === $icon_pos ) {
					$icon_before = $button_icon;
				} elseif ( 'age_icon_postfix' === $icon_pos ) {
					$icon_after = $button_icon;
				}
			}

			if ( 'method-1' === $method_type ) {

				$output     .= '<div class="agc_checkbox">';
					$output .= '<label for="age_vmc"><input type="checkbox" class="age_vmc" name="agc_check" id="age_vmc"><span class="tp-age-checkmark"></span>' . esc_html( $c_box_text ) . '</label>';
				$output     .= '</div>';
				$output     .= '<div class="age_vms">';
					$output .= '<button type="submit" class="age_vmb tp-age-btn-ex" style="opacity:0.5;" >' . $icon_before . '' . esc_html( $btn_text ) . '' . $icon_after . '</button>';
				$output     .= '</div>';
			} elseif ( 'method-2' === $method_type ) {

				$output .= '<input type="date" class="age_verify_birthdate" name="age_birth" value="' . gmdate( 'Y-m-d' ) . '">';
				$output .= '<button type="submit" class="age_verify_method_btnsubmit tp-age-btn-ex">' . $icon_before . '' . esc_html( $btn_text ) . '' . $icon_after . '</button>';
			} elseif ( 'method-3' === $method_type ) {

				$output .= '<button type="submit" class="tp-age-btn-yes tp-age-btn-ex" name="tp-age-btn-yes">' . $icon_before . '' . esc_html( $btn_text ) . '' . $icon_after . '</button>';

				$s_icon_before = '';
				$s_icon_after  = '';

				$s_icon_action = ! empty( $settings['second_icon_action'] ) ? $settings['second_icon_action'] : 'yes';

				if ( 'yes' === $s_icon_action ) {

					if ( ! empty( $se_btn_icon ) ) {
						ob_start();
						\Elementor\Icons_Manager::render_icon( $se_btn_icon, array( 'aria-hidden' => 'true' ) );
						$s_button_icon = ob_get_contents();
						ob_end_clean();
					}

					if ( 'age_scnd_icon_prefix' === $s_icon_pos ) {
						$s_icon_before = $s_button_icon;
					} elseif ( 'age_scnd_icon_postfix' === $s_icon_pos ) {
						$s_icon_after = $s_button_icon;
					}
				}

				$output .= '<button type="submit" class="tp-age-btn-no tp-age-btn-ex" name="tp-age-btn-no">' . $s_icon_before . '' . esc_html( $s_btn_text ) . '' . $s_icon_after . '</button>';
			}

			$output .= '</div>';

			if ( 'yes' === $ex_info_on && ! empty( $extra_info ) ) {
				$output .= '<div class="tp-agegate-extra-info">' . wp_kses_post( $extra_info ) . '</div>';
			}

			$output .= '</div>';

			if ( 'yes' === $side_image && ! empty( $age_side_img ) ) {

				$lazybgclass = '';

				if ( tp_has_lazyload() ) {
					$lazybgclass = ' lazy-background';
				}

				$output .= '<div class="tp-agegate-boxes ' . esc_attr( $lazybgclass ) . ' ' . esc_attr( $right_img ) . '" style="background-image:url(' . esc_url( $age_side_img ) . ');background-size:cover;background-attachment:inherit;"></div>';
			}
				$output .= '</div>';
			$output     .= '</div>';
		}

		echo $output;
	}
}
