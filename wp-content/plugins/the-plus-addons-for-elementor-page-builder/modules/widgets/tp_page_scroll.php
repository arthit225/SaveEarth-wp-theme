<?php
/**
 * Widget Name: Page Scroll
 * Description: Page Scroll
 * Author: Theplus
 * Author URI: https://posimyth.com
 *
 * @package ThePlus
 */

namespace TheplusAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

use TheplusAddons\L_Theplus_Element_Load;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class L_ThePlus_Page_Scroll
 */
class L_ThePlus_Page_Scroll extends Widget_Base {

	/**
	 * Get Widget Name.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_name() {
		return 'tp-page-scroll';
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
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Page Scroll', 'tpebl' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-rocket theplus_backend_icon';
	}

	/**
	 * Get Widget categories.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_categories() {
		return array( 'plus-creatives' );
	}

	/**
	 * Get Widget keywords.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_keywords() {
		return array( 'Page Piling', 'Page Scroll', 'Scrollable Pages', 'Vertical Scroll', 'Full Page Scroll', 'Scrollable Sections' );
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
	 * @version 5.4.2
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_page_scroll',
			array(
				'label' => esc_html__( 'Page Scroll', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'page_scroll_opt',
			array(
				'label'   => esc_html__( 'Option', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'tp_full_page',
				'options' => array(
					'tp_full_page'         => esc_html__( 'Full Page', 'tpebl' ),
					'tp_page_pilling'      => esc_html__( 'Page Piling (Pro)', 'tpebl' ),
					'tp_multi_scroll'      => esc_html__( 'Multi Scroll (Pro)', 'tpebl' ),
					'tp_horizontal_scroll' => esc_html__( 'Horizontal Scroll (Pro)', 'tpebl' ),
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'full_pagepilling_content_templates',
			array(
				'label'     => esc_html__( 'Content', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'page_scroll_opt' => array( 'tp_full_page' ),
				),
			)
		);
		$this->add_control(
			'fit_screen_note',
			array(
				'label' => esc_html__( 'Make sure your templates have full width On and It will suitable to screen height.', 'tpebl' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			)
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'fp_content_template',
			array(
				'label'       => esc_html__( 'Elementor Templates', 'tpebl' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '0',
				'options'     => l_theplus_get_templates(),
				'label_block' => 'true',
			)
		);
		$repeater->add_control(
			'fp-slideid',
			array(
				'label'       => esc_html__( 'Slide ID', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
				'placeholder' => esc_html__( 'Slide ID', 'tpebl' ),
			)
		);
		$this->add_control(
			'fp_content',
			array(
				'label'  => '',
				'type'   => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'hscroll_content_template',
			array(
				'label'     => esc_html__( 'Content', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'page_scroll_opt' => 'tp_horizontal_scroll',
				),
			)
		);
		$this->add_control(
			'hscroll_content_template_options',
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
			'settings_section',
			array(
				'label'     => esc_html__( 'Extra Options', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'page_scroll_opt' => 'tp_horizontal_scroll',
				),
			)
		);
		$this->add_control(
			'settings_section_options',
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
			'multi_scroll_content_templates',
			array(
				'label'     => esc_html__( 'Multi Scroll Content', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'page_scroll_opt' => 'tp_multi_scroll',
				),
			)
		);
		$this->add_control(
			'template_full_height_text',
			array(
				'label' => esc_html__( 'Make sure your templates have full width On and It will suitable to screen height.', 'tpebl' ),
				'type'  => Controls_Manager::RAW_HTML,
			)
		);
		$this->add_control(
			'multi_scroll_content_options',
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
			'dots_settings',
			array(
				'label'     => esc_html__( 'Dots', 'tpebl' ),
				'condition' => array(
					'page_scroll_opt!' => 'tp_horizontal_scroll',
				),
			)
		);
		$this->add_control(
			'show_dots',
			array(
				'label'     => esc_html__( 'Dots', 'tpebl' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'default'   => 'yes',
				'condition' => array(
					'page_scroll_opt' => 'tp_full_page',
				),
			)
		);
		$this->add_control(
			'dots_Note',
			array(
				'type'        => Controls_Manager::RAW_HTML,
				'raw'         => '<p class="tp-controller-notice"><i>Works only on the frontend.</i></p>',
				'label_block' => true,
			)
		);
		$this->add_control(
			'nav_postion',
			array(
				'label'     => esc_html__( 'Dots Positions', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'right' => esc_html__( 'Right', 'tpebl' ),
					'left'  => esc_html__( 'Left', 'tpebl' ),
				),
				'default'   => 'right',
				'condition' => array(
					'show_dots'       => 'yes',
					'page_scroll_opt' => 'tp_full_page',
				),
			)
		);
		$this->add_control(
			'nav_dots_tooltips',
			array(
				'label'     => esc_html__( 'Dots Tooltips Text', 'tpebl' ),
				'type'      => Controls_Manager::TEXT,
				'condition' => array(
					'page_scroll_opt' => array( 'tp_full_page' ),
					'show_dots'       => 'yes',
				),
			)
		);
		$this->add_control(
			'dots_toolti_Note',
			array(
				'type'        => Controls_Manager::RAW_HTML,
				'raw'         => '<p class="tp-controller-notice"><i>Add Multiple text separated by comma \',\'</i></p>',

				'label_block' => true,
			)
		);
		$this->add_control(
			'multi_navigation_dots',
			array(
				'label'     => esc_html__( 'Navigation Dots', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => array(
					'page_scroll_opt' => 'tp_multi_scroll',
				),

			)
		);
		$this->add_control(
			'multi_navigation_dots_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'page_scroll_opt'       => 'tp_multi_scroll',
					'multi_navigation_dots' => 'yes',
				),
			)
		);

		$this->add_control(
			'scroll_nav_connection',
			array(
				'label'     => esc_html__( 'Scroll Navigation Connection', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'scroll_nav_connection_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'scroll_nav_connection' => array( 'yes' ),
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'next_previous_settings',
			array(
				'label'     => esc_html__( 'Next Previous Button', 'tpebl' ),
				'condition' => array(
					'page_scroll_opt' => array( 'tp_full_page' ),
				),
			)
		);
		$this->add_control(
			'show_next_prev',
			array(
				'label'     => esc_html__( 'Next Previous Button', 'tpebl' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'default'   => 'yes',
			)
		);
		$this->add_control(
			'next_prev_style',
			array(
				'label'     => esc_html__( 'Style', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'style-1' => esc_html__( 'Style 1 (Pro)', 'tpebl' ),
					'style-2' => esc_html__( 'Style 2 (Pro)', 'tpebl' ),
					'style-3' => esc_html__( 'Style 3 (Pro)', 'tpebl' ),
					'custom'  => esc_html__( 'Custom (Pro)', 'tpebl' ),
				),
				'default'   => 'style-1',
				'condition' => array(
					'show_next_prev' => 'yes',
				),
			)
		);
		$this->add_control(
			'next_prev_style_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'show_next_prev' => array( 'yes' ),
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_show_paginate',
			array(
				'label'     => esc_html__( 'Paginate', 'tpebl' ),
				'condition' => array(
					'page_scroll_opt' => array( 'tp_full_page' ),
				),
			)
		);
		$this->add_control(
			'show_paginate',
			array(
				'label'     => esc_html__( 'Show Paginate', 'tpebl' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'show_paginate_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'show_paginate' => array( 'yes' ),
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_show_header_footer_opt',
			array(
				'label'     => esc_html__( 'Footer Options', 'tpebl' ),
				'condition' => array(
					'page_scroll_opt' => array( 'tp_full_page' ),
				),
			)
		);
		$this->add_control(
			'tp_show_header_footer_note',
			array(
				'label' => esc_html__( 'Footer template count in Paginate.', 'tpebl' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			)
		);
		$this->add_control(
			'tp_show_footer',
			array(
				'label'     => esc_html__( 'Footer', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'tp_show_footer_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'tp_show_footer' => array( 'yes' ),
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_show_extra_opt',
			array(
				'label'     => esc_html__( 'Extra Option', 'tpebl' ),
				'condition' => array(
					'page_scroll_opt' => array( 'tp_full_page' ),
				),
			)
		);
		$this->add_control(
			'tp_direction',
			array(
				'label'     => esc_html__( 'Direction', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'vertical',
				'options'   => array(
					'vertical'   => esc_html__( 'Vertical (Pro)', 'tpebl' ),
					'horizontal' => esc_html__( 'Horizontal (Pro)', 'tpebl' ),
				),
				'separator' => 'after',
				'condition' => array(
					'page_scroll_opt!' => array( 'tp_full_page' ),
				),
			)
		);
		$this->add_control(
			'tp_fp_hide_hash_id',
			array(
				'label'     => esc_html__( 'Hide Hash/id in URL', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'default'   => 'no',
				'separator' => 'after',
				'condition' => array(
					'page_scroll_opt' => array( 'tp_full_page' ),
				),
			)
		);
		$this->add_control(
			'tp_fp_hide_hash_id_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'page_scroll_opt'    => array( 'tp_full_page' ),
					'tp_fp_hide_hash_id' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'tp_keyboard_scrolling',
			array(
				'label'     => esc_html__( 'Keyboard Scrolling', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'default'   => 'yes',

			)
		);
		$this->add_control(
			'tp_keyboard_scrolling_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'page_scroll_opt'       => array( 'tp_full_page' ),
					'tp_keyboard_scrolling' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'tp_scrolling_speed',
			array(
				'label'     => esc_html__( 'Scrolling Speed (Pro)', 'tpebl' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 5,
				'max'       => 5000,
				'step'      => 5,
				'default'   => 700,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'tp_loop_bottom',
			array(
				'label'       => esc_html__( 'Loop Bottom', 'tpebl' ),
				'type'        => Controls_Manager::SWITCHER,
				'label_on'    => esc_html__( 'Enable', 'tpebl' ),
				'label_off'   => esc_html__( 'Disable', 'tpebl' ),
				'default'     => 'no',
				'description' => esc_html__( 'Scrolling down in the last section should scroll to the first one or not.', 'tpebl' ),
				'separator'   => 'before',
			)
		);
		$this->add_control(
			'tp_loop_bottom_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'tp_loop_bottom' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'tp_loop_top',
			array(
				'label'       => esc_html__( 'Loop Top', 'tpebl' ),
				'type'        => Controls_Manager::SWITCHER,
				'label_on'    => esc_html__( 'Enable', 'tpebl' ),
				'label_off'   => esc_html__( 'Disable', 'tpebl' ),
				'description' => esc_html__( 'Scrolling up in the first section should scroll to the last one or not.', 'tpebl' ),
				'default'     => 'no',
			)
		);
		$this->add_control(
			'tp_loop_top_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'tp_loop_top' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'tp_tablet_off',
			array(
				'label'     => esc_html__( 'Page Pilling in Tablet', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'default'   => 'no',
				'separator' => 'before',
				'condition' => array(
					'page_scroll_opt!' => array( 'tp_full_page' ),
				),
			)
		);
		$this->add_control(
			'tp_tablet_off_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'page_scroll_opt!' => array( 'tp_full_page' ),
					'tp_tablet_off'    => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'tp_mobile_off',
			array(
				'label'     => esc_html__( 'Page Pilling in Mobile', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'default'   => 'no',
				'condition' => array(
					'page_scroll_opt!' => array( 'tp_full_page' ),
				),
			)
		);
		$this->add_control(
			'tp_mobile_off_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'page_scroll_opt!' => array( 'tp_full_page' ),
					'tp_mobile_off'    => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'tp_continuous_vertical',
			array(
				'label'     => esc_html__( 'Continuous Vertical', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'default'   => 'no',
				'separator' => 'before',
				'condition' => array(
					'page_scroll_opt!' => array( 'tp_page_pilling' ),
				),
			)
		);
		$this->add_control(
			'tp_continuous_vertical_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'page_scroll_opt!'       => array( 'tp_page_pilling' ),
					'tp_continuous_vertical' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'tp_responsive_width',
			array(
				'label'     => esc_html__( 'Responsive Width', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'default'   => 'no',
				'condition' => array(
					'page_scroll_opt!' => array( 'tp_page_pilling' ),
				),
			)
		);
		$this->add_control(
			'res_width_value',
			array(
				'label'       => esc_html__( 'Responsive Width', 'tpebl' ),
				'type'        => \Elementor\Controls_Manager::NUMBER,
				'min'         => 300,
				'max'         => 2000,
				'step'        => 5,
				'default'     => 0,
				'description' => esc_html__( 'ex. 900 < Scroll Normal Site', 'tpebl' ),
				'condition'   => array(
					'page_scroll_opt!'    => array( 'tp_page_pilling' ),
					'tp_responsive_width' => 'yes',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_multi_extra_opt',
			array(
				'label'     => esc_html__( 'Extra Option', 'tpebl' ),
				'condition' => array(
					'page_scroll_opt' => 'tp_multi_scroll',
				),
			)
		);
		$this->add_control(
			'section_multi_extra_opt_options',
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
			'section_hscroll_styling',
			array(
				'label'     => esc_html__( 'Horizontal Scroll Style', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'page_scroll_opt' => 'tp_horizontal_scroll',
				),
			)
		);
		$this->add_control(
			'section_hscroll_styling_options',
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
			'section_dot_styling',
			array(
				'label'     => esc_html__( 'Dot Style', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'page_scroll_opt' => array( 'tp_full_page' ),
				),
			)
		);
		$this->start_controls_tabs( 'tabs_dot_style' );
		$this->start_controls_tab(
			'tab_dot_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'dots_color_n',
			array(
				'label'     => esc_html__( 'Dots Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'#fp-nav ul li a span' => 'background: {{VALUE}}',
					'#pp-nav ul li a span,#multiscroll-nav ul li a span' => 'border:1px solid {{VALUE}} !important',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_dot_active',
			array(
				'label'     => esc_html__( 'Active', 'tpebl' ),
				'condition' => array(
					'page_scroll_opt!' => array( 'tp_full_page' ),
				),
			)
		);
		$this->add_control(
			'dots_color_h',
			array(
				'label'     => esc_html__( 'Dots Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'#pp-nav ul li .active span,#multiscroll-nav ul li .active span' => 'background: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'dots_tt_head',
			array(
				'label'     => esc_html__( 'Tooltip Text Option', 'tpebl' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'dots_text_padding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'#fp-nav ul li .fp-tooltip,#pp-nav ul li .pp-tooltip,#multiscroll-nav ul li .multiscroll-tooltip' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'dots_text_typo_n',
				'label'    => esc_html__( 'Typography', 'tpebl' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '#fp-nav ul li .fp-tooltip,#pp-nav ul li .pp-tooltip,#multiscroll-nav ul li .multiscroll-tooltip',

			)
		);
		$this->add_control(
			'dots_text_color_n',
			array(
				'label'     => esc_html__( 'Tooltip Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'#fp-nav ul li .fp-tooltip,#pp-nav ul li .pp-tooltip,#multiscroll-nav ul li .multiscroll-tooltip' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'dots_text_bg_color_n',
			array(
				'label'     => esc_html__( 'Tooltip Background', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'#fp-nav ul li .fp-tooltip,#pp-nav ul li .pp-tooltip,#multiscroll-nav ul li .multiscroll-tooltip' => 'background: {{VALUE}}',
				),
			)
		);
		$this->add_responsive_control(
			'dots_tt_border',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'#fp-nav ul li .fp-tooltip,#pp-nav ul li .pp-tooltip,#multiscroll-nav ul li .multiscroll-tooltip' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_nxt_prv_styling',
			array(
				'label'     => esc_html__( 'Next Previous Button Style', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'page_scroll_opt'  => array( 'tp_full_page' ),
					'next_prev_style!' => array( 'custom' ),
				),
			)
		);
		$this->add_control(
			'section_nxt_prv_styling_options',
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
			'section_nxt_prv_custom',
			array(
				'label'     => esc_html__( 'Next Previous Custom Style', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'page_scroll_opt' => array( 'tp_full_page' ),
					'next_prev_style' => array( 'custom' ),
				),
			)
		);
		$this->add_control(
			'section_nxt_prv_custom_options',
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
			'section_paginate_custom',
			array(
				'label'     => esc_html__( 'Paginate Style', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'page_scroll_opt' => array( 'tp_full_page' ),
					'show_paginate'   => 'yes',
				),
			)
		);
		$this->add_control(
			'section_paginate_custom_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
			)
		);
		$this->end_controls_section();
	}

	/**
	 * Page Scroll Render.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$id = $this->get_id();

		$page_scroll_opt = ! empty( $settings['page_scroll_opt'] ) ? $settings['page_scroll_opt'] : '';

		$uid_widget = uniqid( 'ps' );

		$data_attr = '';
		$widget_id = 'ps' . $this->get_id();

		$this->add_inline_editing_attributes( 'left_side_text', 'advanced' );
		$this->add_inline_editing_attributes( 'right_side_text', 'advanced' );
		$this->add_render_attribute( 'left_side_text', 'class', 'theplus-multiscroll-left-text' );
		$this->add_render_attribute( 'right_side_text', 'class', 'theplus-multiscroll-right-text' );

		$full_page_content = '';
		$full_page_anchors = array();
		$fullpage_opt      = array();

		if ( 'tp_full_page' === $page_scroll_opt ) {

			if ( ! empty( $settings['fp_content'] ) ) {

				$i = 1;
				foreach ( $settings['fp_content'] as $item ) {

					$elem_templates = ! empty( $item['fp_content_template'] ) ? $item['fp_content_template'] : '';

					if ( ! empty( $elem_templates ) ) {
						$slideid = ! empty( $item['fp-slideid'] ) ? $item['fp-slideid'] : 'fp_' . $id . '_' . $i;

						$full_page_anchors[] = $slideid;

						$full_page_content .= '<div class="section">';

							$template_status = get_post_status( $elem_templates );
							if( 'publish' === $template_status ) {
								$full_page_content .= L_Theplus_Element_Load::elementor()->frontend->get_builder_content_for_display( $elem_templates );
							} else {
								$full_page_content .= '<div class="tab-preview-template-notice"><div class="preview-temp-notice-heading">' . esc_html__( 'Unauthorized Access', 'tpebl' ) . '</b></div><div class="preview-temp-notice-desc"><b>' . esc_html__( 'Note :', 'tpebl' ) . '</b> ' . esc_html__( 'You need to upgrade your permissions to Editor or Administrator level to update this option.', 'tpebl' ) . '</div></div>';
							}

						$full_page_content .= '</div>';

						++$i;
					}
				}
			} else {
				$errortitle   = esc_html__( 'No Template Selected!', 'tpebl' );
				$errormassage = esc_html__( 'Please Select Template To Get The Desired Result', 'tpebl' );

				echo l_theplus_get_widgetError( $errortitle, $errormassage );
			}

			if ( ! empty( $full_page_anchors ) ) {
				$fullpage_opt['anchors'] = $full_page_anchors;
			}

			$fullpage_opt['navigationTooltips'] = false;
			$fullpage_opt['responsiveWidth']    = ! empty( $settings['res_width_value'] ) ? sanitize_text_field( $settings['res_width_value'] ) : 0;

			$dots_text     = ! empty( $settings['nav_dots_tooltips'] ) ? sanitize_text_field( $settings['nav_dots_tooltips'] ) : '';
			$nav_dots_text = explode( ',', $dots_text );

			$dots_show     = ! empty( $settings['show_dots'] ) ? $settings['show_dots'] : '';

			if ( 'yes' === $dots_show && 'tp_full_page' === $page_scroll_opt && 'tp_full_page' === $page_scroll_opt ) {
				$fullpage_opt['navigation'] = true;
				$fullpage_opt['navigationPosition'] = ! empty( $settings['nav_postion'] ) && 'left' === $settings['nav_postion'] ? 'left' : 'right';
				$fullpage_opt['navigationTooltips'] = $nav_dots_text;
			} else {
				$fullpage_opt['navigation'] = false;
			}

			$data_fullpage = wp_json_encode( $fullpage_opt );

			$data_attr .= ' data-full-page-opt=\'' . esc_attr( $data_fullpage ) . '\'';

			$scroll_conn   = ! empty( $settings['scroll_nav_connection'] ) ? $settings['scroll_nav_connection'] : '';
			$scroll_con_id = ! empty( $settings['scrollnav_connect_id'] ) ? sanitize_text_field( $settings['scrollnav_connect_id'] ) : '';

			if ( 'yes' === $scroll_conn && ! empty( $scroll_con_id ) ) {
				$data_attr .= ' data-scroll-nav-id="tp-sc-' . esc_attr( $scroll_con_id ) . '"';
			}
		}

		echo '<div id="' . esc_attr( $uid_widget ) . '" class="tp-page-scroll-wrapper ' . esc_attr( $uid_widget ) . ' ' . esc_attr( $page_scroll_opt ) . '" data-id="' . esc_attr( $uid_widget ) . '" data-option="' . esc_attr( $page_scroll_opt ) . '" ' . $data_attr . '>';

		if ( 'tp_full_page' === $page_scroll_opt ) {
			echo $full_page_content;
		}

		echo '</div>';
	}
}
