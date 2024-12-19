<?php
/**
 * Widget Name: Carousel Anything
 * Description: template section slide for carousel.
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
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

use TheplusAddons\L_Theplus_Element_Load;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class L_ThePlus_Carousel_Anything
 */
class L_ThePlus_Carousel_Anything extends Widget_Base {

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
	 * @since 1.2.0
	 * @version 5.4.2
	 */
	public function get_name() {
		return 'tp-carousel-anything';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 1.2.0
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Carousel Anything', 'tpebl' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.2.0
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-sliders theplus_backend_icon';
	}

	/**
	 * Get custom URL.
	 *
	 * @since 1.2.0
	 * @version 5.4.2
	 */
	public function get_custom_help_url() {
		$help_url = $this->tp_help;

		return esc_url( $help_url );
	}

	/**
	 * Get categories.
	 *
	 * @since 1.2.0
	 * @version 5.4.2
	 */
	public function get_categories() {
		return array( 'plus-creatives' );
	}

	/**
	 * Get keywords.
	 *
	 * @since 1.2.0
	 * @version 5.4.2
	 */
	public function get_keywords() {
		return array( 'carousel', 'slider', 'slideshow', 'image carousel', 'image slider', 'image slideshow', 'carousel widget', 'slider widget', 'slideshow widget' );
	}

	/**
	 * Register controls.
	 *
	 * @since 1.2.0
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
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'tab_title',
			array(
				'label'       => esc_html__( 'Title', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Slide 1', 'tpebl' ),
				'dynamic'     => array(
					'active' => true,
				),
				'label_block' => true,
			)
		);
		$repeater->add_control(
			'content_template_type',
			array(
				'label'   => esc_html__( 'Content Type', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'dropdown',
				'options' => array(
					'dropdown' => esc_html__( 'Template', 'tpebl' ),
					'manually' => esc_html__( 'Shortcode', 'tpebl' ),
				),
			)
		);
		$repeater->add_control(
			'content_template',
			array(
				'label'       => wp_kses_post( "Select Content <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "connect-carousel-remote-with-carousel-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '0',
				'options'     => l_theplus_get_templates(),
				'label_block' => 'true',
				'condition'   => array(
					'content_template_type' => 'dropdown',
				),
			)
		);
		$repeater->add_control(
			'content_template_id',
			array(
				'label'       => esc_html__( 'Enter Elementor Template Shortcode', 'tpebl' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => array(
					'active' => true,
				),
				'default'     => '',
				'placeholder' => '[elementor-template id="70"]',
				'condition'   => array(
					'content_template_type' => 'manually',
				),
			)
		);
		$this->add_control(
			'carousel_content',
			array(
				'label'       => '',
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'tab_title' => esc_html__( 'Slide #1', 'tpebl' ),
					),
					array(
						'tab_title' => esc_html__( 'Slide #2', 'tpebl' ),
					),
				),
				'title_field' => '{{{ tab_title }}}',
			)
		);
		$this->add_control(
			'slide_overflow_hidden',
			array(
				'label'       => esc_html__( 'Overflow Hidden', 'tpebl' ),
				'type'        => Controls_Manager::SWITCHER,
				'label_on'    => esc_html__( 'On', 'tpebl' ),
				'label_off'   => esc_html__( 'Off', 'tpebl' ),
				'default'     => 'no',
				'separator'   => 'before',
				'description' => esc_html__( 'If any content goes outside of section and conflict with another. We suggest to turn this option on.', 'tpebl' ),
			)
		);
		$this->add_control(
			'carousel_unique_id',
			array(
				'label'       => wp_kses_post( "Unique Carousel ID <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "connect-infobox-with-carousel-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'separator'   => 'before',
				'description' => esc_html__( 'Keep this blank or Setup Unique id for carousel which you can use with "Carousel Remote" widget.', 'tpebl' ),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'extra_opts_section',
			array(
				'label' => esc_html__( 'Extra Options', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'slide_random_order',
			array(
				'label'     => esc_html__( 'Slide Random Order', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'tpebl' ),
				'label_off' => esc_html__( 'Off', 'tpebl' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'tab_content_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'slide_random_order' => array( 'yes' ),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_carousel_options_styling',
			array(
				'label' => esc_html__( 'Carousel Options', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'slider_direction',
			array(
				'label'   => esc_html__( 'Slider Mode', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'horizontal',
				'options' => array(
					'horizontal' => esc_html__( 'Horizontal', 'tpebl' ),
					'vertical'   => esc_html__( 'Vertical (Pro)', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'vertical_direction',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'slider_direction' => array( 'vertical' ),
				),
			)
		);
		$this->add_control(
			'carousel_direction',
			array(
				'label'   => esc_html__( 'Slide Direction', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'ltr',
				'options' => array(
					'rtl' => esc_html__( 'Right to Left', 'tpebl' ),
					'ltr' => esc_html__( 'Left to Right', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'slide_speed',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Slide Speed', 'tpebl' ),
				'size_units' => '',
				'range'      => array(
					'' => array(
						'min'  => 0,
						'max'  => 10000,
						'step' => 100,
					),
				),
				'default'    => array(
					'unit' => '',
					'size' => 1500,
				),
			)
		);
		$this->add_control(
			'slide_fade_inout',
			array(
				'label'     => esc_html__( 'Slide Animation', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'none',
				'options'   => array(
					'none'      => esc_html__( 'Default', 'tpebl' ),
					'fadeinout' => esc_html__( 'Fade in/Fade out', 'tpebl' ),
				),
				'condition' => array(
					'slider_direction' => 'horizontal',
				),
			)
		);
		$this->add_control(
			'slide_fade_inout_notice',
			array(
				'type'            => \Elementor\Controls_Manager::RAW_HTML,
				'raw'             => 'Note : Just for single column layout.',
				'content_classes' => 'tp-widget-description',
				'condition'       => array(
					'slider_direction' => 'horizontal',
					'slide_fade_inout' => 'fadeinout',
				),
			)
		);
		$this->add_control(
			'slider_animation',
			array(
				'label'   => esc_html__( 'Animation Type', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'ease',
				'options' => array(
					'ease'   => esc_html__( 'With Hold', 'tpebl' ),
					'linear' => esc_html__( 'Continuous(Pro)', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'Slider_animation_effect',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'slider_animation' => array( 'linear' ),
				),
			)
		);
		$this->start_controls_tabs( 'tabs_carousel_style' );
		$this->start_controls_tab(
			'tab_carousel_desktop',
			array(
				'label' => esc_html__( 'Desktop', 'tpebl' ),
			)
		);
		$this->add_control(
			'slider_desktop_column',
			array(
				'label'   => wp_kses_post( "Desktop Columns <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "multiple-columned-elementor-carousel-slider/' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'options' => array(
					'1' => esc_html__( 'Column 1', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'steps_slide',
			array(
				'label'       => esc_html__( 'Next Previous', 'tpebl' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '1',
				'description' => esc_html__( 'Select option of column scroll on previous or next in carousel.', 'tpebl' ),
				'options'     => array(
					'1' => esc_html__( 'One Column', 'tpebl' ),
					'2' => esc_html__( 'All Visible Columns', 'tpebl' ),
				),
			)
		);
		$this->add_responsive_control(
			'slider_padding',
			array(
				'label'      => esc_html__( 'Slide Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'default'    => array(
					'px' => array(
						'top'    => '',
						'right'  => '10',
						'bottom' => '',
						'left'   => '10',
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .list-carousel-slick .slick-initialized .slick-slide' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'slider_draggable',
			array(
				'label'     => esc_html__( 'Draggable', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'tpebl' ),
				'label_off' => esc_html__( 'Off', 'tpebl' ),
				'default'   => 'yes',
			)
		);
		$this->add_control(
			'multi_drag',
			array(
				'label'     => esc_html__( 'Multi Drag', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'default'   => 'no',
				'condition' => array(
					'slider_draggable' => 'yes',
				),
			)
		);
		$this->add_control(
			'slider_infinite',
			array(
				'label'     => wp_kses_post( 'Infinite Mode', 'tpebl'),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'tpebl' ),
				'label_off' => esc_html__( 'Off', 'tpebl' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'infinite_mode_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'slider_infinite' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'slider_pause_hover',
			array(
				'label'     => esc_html__( 'Pause On Hover', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'tpebl' ),
				'label_off' => esc_html__( 'Off', 'tpebl' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'pause_hover_option',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'slider_pause_hover' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'slider_adaptive_height',
			array(
				'label'     => esc_html__( 'Adaptive Height', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'tpebl' ),
				'label_off' => esc_html__( 'Off', 'tpebl' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'slider_autoplay',
			array(
				'label'     => wp_kses_post( 'Autoplay', 'tpebl'),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'tpebl' ),
				'label_off' => esc_html__( 'Off', 'tpebl' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'autoplay_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'slider_autoplay' => array( 'yes' ),
				),
			)
		);

		$this->add_control(
			'slider_dots',
			array(
				'label'     => wp_kses_post( "Show Dots <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "showhide-arrows-dots-in-elementor-carousel/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'tpebl' ),
				'label_off' => esc_html__( 'Off', 'tpebl' ),
				'default'   => 'yes',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'slider_dots_style',
			array(
				'label'     => esc_html__( 'Dots Style', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style-1',
				'options'   => array(
					'style-1' => esc_html__( 'Style 1', 'tpebl' ),
					'style-2' => esc_html__( 'Style 2(Pro)', 'tpebl' ),
					'style-3' => esc_html__( 'Style 3(Pro)', 'tpebl' ),
					'style-4' => esc_html__( 'Style 4(Pro)', 'tpebl' ),
					'style-5' => esc_html__( 'Style 5(Pro)', 'tpebl' ),
					'style-6' => esc_html__( 'Style 6(Pro)', 'tpebl' ),
					'style-7' => esc_html__( 'Style 7(Pro)', 'tpebl' ),
				),
				'condition' => array(
					'slider_dots' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'dot_style',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'slider_dots_style!' => array( 'style-1' ),
				),
			)
		);
		$this->add_control(
			'slick_dots_size',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Size', 'tpebl' ),
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 2,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .slick-dots.style-1 li,{{WRAPPER}}  .slick-dots.style-2 li,{{WRAPPER}}  .slick-dots.style-3 li' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'slider_dots'       => 'yes',
					'slider_dots_style' => array( 'style-1'),
					'slider_dots_style!' => array( 'style-2', 'style-3'),
				),
			)
		);
		$this->add_control(
			'dots_border_color',
			array(
				'label'     => esc_html__( 'Dots Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .list-carousel-slick .slick-dots.style-1 li button,{{WRAPPER}} .list-carousel-slick .slick-dots.style-6 li button' => '-webkit-box-shadow:inset 0 0 0 8px {{VALUE}};-moz-box-shadow: inset 0 0 0 8px {{VALUE}};box-shadow: inset 0 0 0 8px {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick .slick-dots.style-1 li.slick-active button' => '-webkit-box-shadow:inset 0 0 0 1px {{VALUE}};-moz-box-shadow: inset 0 0 0 1px {{VALUE}};box-shadow: inset 0 0 0 1px {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick .slick-dots.style-2 li button' => 'border-color:{{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick ul.slick-dots.style-3 li button' => '-webkit-box-shadow: inset 0 0 0 1px {{VALUE}};-moz-box-shadow: inset 0 0 0 1px {{VALUE}};box-shadow: inset 0 0 0 1px {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick .slick-dots.style-3 li.slick-active button' => '-webkit-box-shadow: inset 0 0 0 8px {{VALUE}};-moz-box-shadow: inset 0 0 0 8px {{VALUE}};box-shadow: inset 0 0 0 8px {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick ul.slick-dots.style-4 li button' => '-webkit-box-shadow: inset 0 0 0 0px {{VALUE}};-moz-box-shadow: inset 0 0 0 0px {{VALUE}};box-shadow: inset 0 0 0 0px {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick .slick-dots.style-1 li button:before' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'slider_dots_style' => array( 'style-1'),
					'slider_dots_style!' => array( 'style-2', 'style-3', 'style-5'),
					'slider_dots'       => 'yes',
				),
			)
		);
		$this->add_control(
			'dots_top_padding',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Dots Top Padding', 'tpebl' ),
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 2,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 0,
				),
				'selectors'  => array(
					'{{WRAPPER}} .list-carousel-slick .slick-slider.slick-dotted' => 'padding-bottom: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'slider_dots_style' => array( 'style-1'),
					'slider_dots' => 'yes',
				),
			)
		);
		$this->add_control(
			'overlay_content_dots',
			array(
				'label'     => esc_html__( 'Overlay Content Dots', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'tpebl' ),
				'label_off' => esc_html__( 'Off', 'tpebl' ),
				'default'   => 'yes',
				'condition' => array(
					'slider_dots' => 'yes',
				),
			)
		);
		$this->add_control(
			'direction_dots',
			array(
				'label'     => esc_html__( 'Direction Dots', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Vertical', 'tpebl' ),
				'label_off' => esc_html__( 'Horizontal', 'tpebl' ),
				'default'   => 'no',
				'condition' => array(
					'slider_dots' => 'yes',
				),
			)
		);
		$this->add_control(
			'direction_dots_option',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'direction_dots' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'hover_show_dots',
			array(
				'label'     => esc_html__( 'On Hover Dots', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'tpebl' ),
				'label_off' => esc_html__( 'Off', 'tpebl' ),
				'default'   => 'no',
				'condition' => array(
					'slider_dots' => 'yes',
				),
			)
		);
		$this->add_control(
			'hover_dots_option',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'hover_show_dots' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'slider_arrows',
			array(
				'label'     => wp_kses_post( "Show Arrows <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "showhide-arrows-dots-in-elementor-carousel/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'tpebl' ),
				'label_off' => esc_html__( 'Off', 'tpebl' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'slider_arrows_style',
			array(
				'label'     => esc_html__( 'Arrows Style', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style-1',
				'options'   => array(
					'style-1' => esc_html__( 'Style 1', 'tpebl' ),
					'style-2' => esc_html__( 'Style 2(Pro)', 'tpebl' ),
					'style-3' => esc_html__( 'Style 3(Pro)', 'tpebl' ),
					'style-4' => esc_html__( 'Style 4(Pro)', 'tpebl' ),
					'style-5' => esc_html__( 'Style 5(Pro)', 'tpebl' ),
					'style-6' => esc_html__( 'Style 6(Pro)', 'tpebl' ),
				),
				'condition' => array(
					'slider_arrows' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'arrow_style',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'slider_arrows_style!' => array( 'style-1' ),
				),
			)
		);
		$this->add_control(
			'arrow_bg_color',
			array(
				'label'     => esc_html__( 'Arrow Background Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c44d48',
				'selectors' => array(
					'{{WRAPPER}} .list-carousel-slick .slick-nav.slick-prev.style-1,{{WRAPPER}} .list-carousel-slick .slick-nav.slick-next.style-1,{{WRAPPER}} .list-carousel-slick .slick-nav.style-3:before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-3:before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-6:before,{{WRAPPER}} .list-carousel-slick .slick-next.style-6:before' => 'background: {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick .slick-prev.style-4:before,{{WRAPPER}} .list-carousel-slick .slick-nav.style-4:before' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'slider_arrows_style' => array( 'style-1'),
					'slider_arrows_style!' => array( 'style-3', 'style-4', 'style-6'),
					'slider_arrows'       => 'yes',
				),
			)
		);
		$this->add_control(
			'arrow_icon_color',
			array(
				'label'     => esc_html__( 'Arrow Icon Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => array(
					'{{WRAPPER}} .list-carousel-slick .slick-nav.slick-prev.style-1:before,{{WRAPPER}} .list-carousel-slick .slick-nav.slick-next.style-1:before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-3:before,{{WRAPPER}} .list-carousel-slick .slick-nav.style-3:before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-4:before,{{WRAPPER}} .list-carousel-slick .slick-nav.style-4:before,{{WRAPPER}} .list-carousel-slick .slick-nav.style-6 .icon-wrap' => 'color: {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick .slick-prev.style-2 .icon-wrap:before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-2 .icon-wrap:after,{{WRAPPER}} .list-carousel-slick .slick-next.style-2 .icon-wrap:before,{{WRAPPER}} .list-carousel-slick .slick-next.style-2 .icon-wrap:after,{{WRAPPER}} .list-carousel-slick .slick-prev.style-5 .icon-wrap:before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-5 .icon-wrap:after,{{WRAPPER}} .list-carousel-slick .slick-next.style-5 .icon-wrap:before,{{WRAPPER}} .list-carousel-slick .slick-next.style-5 .icon-wrap:after' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'slider_arrows_style' => array( 'style-1'),
					'slider_arrows_style!' => array('style-2', 'style-3', 'style-4', 'style-5', 'style-6'),
					'slider_arrows'       => 'yes',
				),
			)
		);
		$this->add_control(
			'arrow_hover_bg_color',
			array(
				'label'     => esc_html__( 'Arrow Hover Background Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => array(
					'{{WRAPPER}} .list-carousel-slick .slick-nav.slick-prev.style-1:hover,{{WRAPPER}} .list-carousel-slick .slick-nav.slick-next.style-1:hover,{{WRAPPER}} .list-carousel-slick .slick-prev.style-2:hover::before,{{WRAPPER}} .list-carousel-slick .slick-next.style-2:hover::before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-3:hover:before,{{WRAPPER}} .list-carousel-slick .slick-nav.style-3:hover:before' => 'background: {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick .slick-prev.style-4:hover:before,{{WRAPPER}} .list-carousel-slick .slick-nav.style-4:hover:before' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'slider_arrows_style' => array( 'style-1'),
					'slider_arrows_style!' => array( 'style-2', 'style-3', 'style-4'),
					'slider_arrows'       => 'yes',
				),
			)
		);
		$this->add_control(
			'arrow_hover_icon_color',
			array(
				'label'     => esc_html__( 'Arrow Hover Icon Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c44d48',
				'selectors' => array(
					'{{WRAPPER}} .list-carousel-slick .slick-nav.slick-prev.style-1:hover:before,{{WRAPPER}} .list-carousel-slick .slick-nav.slick-next.style-1:hover:before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-3:hover:before,{{WRAPPER}} .list-carousel-slick .slick-nav.style-3:hover:before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-4:hover:before,{{WRAPPER}} .list-carousel-slick .slick-nav.style-4:hover:before,{{WRAPPER}} .list-carousel-slick .slick-nav.style-6:hover .icon-wrap' => 'color: {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick .slick-prev.style-2:hover .icon-wrap::before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-2:hover .icon-wrap::after,{{WRAPPER}} .list-carousel-slick .slick-next.style-2:hover .icon-wrap::before,{{WRAPPER}} .list-carousel-slick .slick-next.style-2:hover .icon-wrap::after,{{WRAPPER}} .list-carousel-slick .slick-prev.style-5:hover .icon-wrap::before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-5:hover .icon-wrap::after,{{WRAPPER}} .list-carousel-slick .slick-next.style-5:hover .icon-wrap::before,{{WRAPPER}} .list-carousel-slick .slick-next.style-5:hover .icon-wrap::after' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'slider_arrows_style' => array( 'style-1'),
					'slider_arrows_style!' => array( 'style-2', 'style-3', 'style-4', 'style-5', 'style-6'),
					'slider_arrows'       => 'yes',
				),
			)
		);
		$this->add_control(
			'outer_section_arrow',
			array(
				'label'     => esc_html__( 'Outer Content Arrow', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'tpebl' ),
				'label_off' => esc_html__( 'Off', 'tpebl' ),
				'default'   => 'no',
				'condition' => array(
					'slider_arrows'       => 'yes',
					'slider_arrows_style' => array( 'style-1'),
					'slider_arrows_style!' => array('style-2', 'style-5', 'style-6'),
				),
			)
		);
		$this->add_control(
			'outer_content_arrow',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'outer_section_arrow' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'hover_show_arrow',
			array(
				'label'     => esc_html__( 'On Hover Arrow', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'tpebl' ),
				'label_off' => esc_html__( 'Off', 'tpebl' ),
				'default'   => 'no',
				'condition' => array(
					'slider_arrows' => 'yes',
				),
			)
		);
		$this->add_control(
			'show_arrow_style',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'hover_show_arrow' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'slider_center_mode',
			array(
				'label'     => wp_kses_post( "Center Mode <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "increase-center-slide-in-elementor-carousel/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'tpebl' ),
				'label_off' => esc_html__( 'Off', 'tpebl' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'center_mode_effect',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'slider_center_mode' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'slide_row_top_space',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Row Top Space', 'tpebl' ),
				'size_units' => '',
				'range'      => array(
					'' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 2,
					),
				),
				'default'    => array(
					'unit' => '',
					'size' => 15,
				),
				'selectors'  => array(
					'{{WRAPPER}} .list-carousel-slick[data-slider_rows="2"] .slick-slide > div:last-child,{{WRAPPER}} .list-carousel-slick[data-slider_rows="3"] .slick-slide > div:nth-last-child(-n+2)' => 'padding-top:{{SIZE}}px',
				),
				'condition'  => array(
					'slider_rows' => array( '2', '3' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_carousel_tablet',
			array(
				'label' => esc_html__( 'Tablet', 'tpebl' ),
			)
		);
		$this->add_control(
			'tab_carousel_tablet_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_carousel_mobile',
			array(
				'label' => esc_html__( 'Mobile', 'tpebl' ),
			)
		);
		$this->add_control(
			'tab_carousel_mobile_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*carousel option*/

		include L_THEPLUS_PATH . 'modules/widgets/theplus-needhelp.php';
		include L_THEPLUS_PATH . 'modules/widgets/theplus-profeatures.php';
	}

	/**
	 * Carousel anything.
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$uid      = uniqid( 'carousel' );
		$id_int   = substr( $this->get_id_int(), 0, 3 );

		$slide_overflow_hidden = ( 'yes' === $settings['slide_overflow_hidden'] ) ? 'slide-overflow-hidden' : '';

		// Carousel option.
		$isotope       = '';
		$data_slider   = '';
		$arrow_class   = '';
		$data_carousel = '';

		$slider_direction = 'Vertical' === $settings['slider_direction'] ? 'true' : 'false';

		$data_slider .= ' data-slider_direction="' . esc_attr( $slider_direction ) . '"';
		$data_slider .= ' data-slide_speed="' . ( isset( $settings['slide_speed']['size'] ) ? esc_attr( $settings['slide_speed']['size'] ) : 1500 ) . '"';

		$slide_fade_inout = ( 'horizontal' === $settings['slider_direction'] && 'fadeinout' === $settings['slide_fade_inout'] ) ? 'true' : 'false';

		$data_slider .= ' data-slide_fade_inout="' . esc_attr( $slide_fade_inout ) . '"';

		$data_slider .= ' data-slider_desktop_column="1"';
		$data_slider .= ' data-steps_slide="1"';

		$slider_draggable = 'yes' === $settings['slider_draggable'] ? 'true' : 'false';

		$multi_drag   = ( 'yes' === $settings['multi_drag'] ) ? 'true' : 'false';
		$data_slider .= ' data-slider_draggable="' . esc_attr( $slider_draggable ) . '"';
		$data_slider .= ' data-multi_drag="' . esc_attr( $multi_drag ) . '"';

		$slider_adaptive_height = ( 'yes' === $settings['slider_adaptive_height'] ) ? 'true' : 'false';

		$data_slider .= ' data-slider_adaptive_height="' . esc_attr( $slider_adaptive_height ) . '"';

		$slider_animation = ( isset( $settings['slider_animation'] ) ? $settings['slider_animation'] : 'ease' );

		$data_slider    .= ' data-slider_animation="' . esc_attr( $slider_animation ) . '"';

		$carousel_direction = ! empty( $settings['carousel_direction'] ) ? $settings['carousel_direction'] : 'ltr';

		$carousel_slider = '';

		if ( ! empty( $carousel_direction ) ) {
			$carousel_data = array(
				'carousel_direction' => $carousel_direction,
			);

			$carousel_slider = 'data-result="' . htmlspecialchars( wp_json_encode( $carousel_data, true ), ENT_QUOTES, 'UTF-8' ) . '"';
		}

		$slider_dots  = 'yes' === $settings['slider_dots'] ? 'true' : 'false';
		$data_slider .= ' data-slider_dots="' . esc_attr( $slider_dots ) . '"';
		$data_slider .= ' data-slider_dots_style="slick-dots ' . esc_attr( $settings['slider_dots_style'] ) . '"';

		$slider_arrows = 'yes' === $settings['slider_arrows'] ? 'true' : 'false';
		$data_slider  .= ' data-slider_arrows="' . esc_attr( $slider_arrows ) . '"';
		$data_slider  .= ' data-slider_arrows_style="' . esc_attr( $settings['slider_arrows_style'] ) . '" ';
		$data_slider  .= ' data-arrows_position="' . ( isset( $settings['arrows_position'] ) ? esc_attr( $settings['arrows_position'] ) : 'top-right' ) . '" ';
		$data_slider  .= ' data-arrow_bg_color="' . ( isset( $settings['arrow_bg_color'] ) ? esc_attr( $settings['arrow_bg_color'] ) : '#c44d48' ) . '" ';
		$data_slider  .= ' data-arrow_icon_color="' . ( isset( $settings['arrow_icon_color'] ) ? esc_attr( $settings['arrow_icon_color'] ) : '#fff' ) . '" ';
		$data_slider  .= ' data-arrow_hover_bg_color="' . ( isset( $settings['arrow_hover_bg_color'] ) ? esc_attr( $settings['arrow_hover_bg_color'] ) : '#fff' ) . '" ';
		$data_slider  .= ' data-arrow_hover_icon_color="' . ( isset( $settings['arrow_hover_icon_color'] ) ? esc_attr( $settings['arrow_hover_icon_color'] ) : '#c44d48' ) . '" ';

		$data_slider .= ' data-slider_rows="' . ( isset( $settings['slider_rows'] ) ? esc_attr( $settings['slider_rows'] ) : 1 ) . '" ';

		$isotope = 'list-carousel-slick';

		if ( ! empty( $settings['overlay_content_dots'] ) && 'yes' === $settings['overlay_content_dots'] && 'yes' === $settings['slider_dots'] ) {
			$data_carousel .= ' overlay-content-dots';
		}

		$tab_id = '';

		$carousel_bg_conn = '';
		if ( ! empty( $settings['carousel_unique_id'] ) ) {
			$uid    = 'tpca_' . $settings['carousel_unique_id'];
			$tab_id = 'tptab_' . $settings['carousel_unique_id'];

			$carousel_bg_conn = ' data-carousel-bg-conn="bgcarousel' . esc_attr( $settings['carousel_unique_id'] ) . '"';
		}
		?>
 
		<div id="<?php echo esc_attr( $uid ); ?>" class="theplus-carousel-anything-wrapper <?php echo esc_attr( $isotope ); ?> <?php echo esc_attr( $arrow_class ); ?> <?php echo esc_attr( $data_carousel ); ?> <?php echo esc_attr( $uid ); ?> "data-id="<?php echo esc_attr( $uid ); ?>" data-connection="<?php echo esc_attr( $tab_id ); ?>" <?php echo $carousel_slider; ?> dir=<?php echo esc_attr( $carousel_direction ); ?> <?php echo $data_slider; ?> <?php echo $carousel_bg_conn; ?>>
			<div class="plus-carousel-inner post-inner-loop">
			<?php
			if ( ! empty( $settings['carousel_content'] ) ) {
				foreach ( $settings['carousel_content'] as $index => $item ) :
					$tab_count = $index + 1;
					$tab_content_setting_key = $this->get_repeater_setting_key( 'tab_content', 'carousel_content', $index );
					$this->add_render_attribute(
						$tab_content_setting_key,
						array(
							'id'    => 'slide-content-' . $id_int . $tab_count,
							'class' => array( 'plus-slide-content', 'grid-item', $slide_overflow_hidden ),
						)
					);

					?>
					<div <?php echo $this->get_render_attribute_string( $tab_content_setting_key ); ?>>
						<div class="slide-content-inner">
							<?php

							$content_template = isset( $item['content_template'] ) ? intval( $item['content_template'] ) : 0;
							$template_status  = get_post_status( $content_template );

							if( 'publish' === $template_status ){
								if ( ( ! empty( $item['content_template_type'] ) && 'manually' === $item['content_template_type'] ) && ! empty( $item['content_template_id'] ) ) {
									echo '<div class="plus-content-editor">' . L_Theplus_Element_Load::elementor()->frontend->get_builder_content_for_display( substr( $item['content_template_id'], 24, -2 ) ) . '</div>';
								} elseif ( ! empty( $item['content_template'] ) ) {
									echo '<div class="plus-content-editor">' . L_Theplus_Element_Load::elementor()->frontend->get_builder_content_for_display( $item['content_template'] ) . '</div>';
								}
							} else {
								echo '<div class="tab-preview-template-notice"><div class="preview-temp-notice-heading">' . esc_html__( 'Unauthorized Access', 'tpebl' ) . '</b></div><div class="preview-temp-notice-desc"><b>' . esc_html__( 'Note :', 'tpebl' ) . '</b> ' . esc_html__( 'You need to upgrade your permissions to Editor or Administrator level to update this option.', 'tpebl' ) . '</div></div>';
							}
							?>
													
						</div>
					</div>
					<?php
				endforeach;
			}
			?>
			</div>
		</div>
		<?php
	}
}