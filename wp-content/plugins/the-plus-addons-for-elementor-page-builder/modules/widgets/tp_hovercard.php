<?php
/**
 * Widget Name: TP Hover card
 * Description: TP Hover card
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
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Css_Filter;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class L_ThePlus_Hovercard
 */
class L_ThePlus_Hovercard extends Widget_Base {

	/**
	 * Document Link For Need help.
	 *
	 * @since 1.0.0
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
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_name() {
		return 'tp-hovercard';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Hover Card', 'tpebl' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-square theplus_backend_icon';
	}

	/**
	 * Get Widget categories.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_categories() {
		return array( 'plus-essential' );
	}

	/**
	 * Get Widget keywords.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_keywords() {
		return array( 'Hover card', 'Card hover', 'Card on hover', 'Elementor hover card', ' Elementor card hover', 'Elementor card on hover' );
	}

	/**
	 * Get Widget Custom Help Url.
	 *
	 * @since 1.0.0
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
	 * @version 5.4.2
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Hover Card', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new \Elementor\Repeater();
		$repeater->start_controls_tabs( 'tabs_tag_open_close' );

		$repeater->start_controls_tab(
			'tab_open_tag',
			array(
				'label' => esc_html__( 'Open', 'tpebl' ),
			)
		);
		$repeater->add_control(
			'open_tag',
			array(
				'label'   => esc_html__( 'Open Tag', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'div',
				'options' => array(
					'div'  => esc_html__( 'Div', 'tpebl' ),
					'span' => esc_html__( 'Span', 'tpebl' ),
					'h1'   => esc_html__( 'H1', 'tpebl' ),
					'h2'   => esc_html__( 'H2', 'tpebl' ),
					'h3'   => esc_html__( 'H3', 'tpebl' ),
					'h4'   => esc_html__( 'H4', 'tpebl' ),
					'h5'   => esc_html__( 'H5', 'tpebl' ),
					'h6'   => esc_html__( 'H6', 'tpebl' ),
					'p'    => esc_html__( 'p', 'tpebl' ),
					'a'    => esc_html__( 'a', 'tpebl' ),
					'none' => esc_html__( 'None', 'tpebl' ),
				),
			)
		);
		$repeater->add_control(
			'a_link',
			array(
				'label'       => esc_html__( 'Link', 'tpebl' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => array(
					'active' => true,
				),
				'separator'   => 'after',
				'placeholder' => esc_html__( 'https://www.demo-link.com', 'tpebl' ),
				'condition'   => array(
					'open_tag' => 'a',
				),
			)
		);
		$repeater->add_control(
			'open_tag_class',
			array(
				'label'     => esc_html__( 'Enter Class', 'tpebl' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '',
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'open_tag!' => 'none',
				),
			)
		);
		$repeater->end_controls_tab();
		$repeater->start_controls_tab(
			'tab_close_tag',
			array(
				'label' => esc_html__( 'Close', 'tpebl' ),
			)
		);
		$repeater->add_control(
			'close_tag',
			array(
				'label'   => esc_html__( 'Close Tag', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'close',
				'options' => array(
					'close' => esc_html__( 'Default', 'tpebl' ),
					'div'   => esc_html__( 'Div', 'tpebl' ),
					'span'  => esc_html__( 'Span', 'tpebl' ),
					'h1'    => esc_html__( 'H1', 'tpebl' ),
					'h2'    => esc_html__( 'H2', 'tpebl' ),
					'h3'    => esc_html__( 'H3', 'tpebl' ),
					'h4'    => esc_html__( 'H4', 'tpebl' ),
					'h5'    => esc_html__( 'H5', 'tpebl' ),
					'h6'    => esc_html__( 'H6', 'tpebl' ),
					'p'     => esc_html__( 'p', 'tpebl' ),
					'a'     => esc_html__( 'a', 'tpebl' ),
					'none'  => esc_html__( 'None', 'tpebl' ),
				),
			)
		);
		$repeater->end_controls_tab();
		$repeater->end_controls_tabs();

		$repeater->add_control(
			'content_tag',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Content', 'tpebl' ),
				'default'   => 'none',
				'options'   => array(
					'none'   => esc_html__( 'None', 'tpebl' ),
					'text'   => esc_html__( 'Text', 'tpebl' ),
					'image'  => esc_html__( 'Image', 'tpebl' ),
					'html'   => esc_html__( 'HTML', 'tpebl' ),
					'style'  => esc_html__( 'Style', 'tpebl' ),
					'script' => esc_html__( 'Script', 'tpebl' ),
				),
				'separator' => 'before',
			)
		);
		$repeater->add_control(
			'text_content',
			array(
				'label'     => wp_kses_post( "Text <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "use-text-content-with-hover-card-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::TEXTAREA,
				'dynamic'   => array(
					'active' => true,
				),
				'default'   => esc_html__( 'The Plus', 'tpebl' ),
				'condition' => array(
					'content_tag' => 'text',
				),
			)
		);
		$repeater->add_control(
			'media_content',
			array(
				'type'      => Controls_Manager::MEDIA,
				'label'     => wp_kses_post( "Media <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "use-image-content-with-hover-card-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'dynamic'   => array(
					'active' => true,
				),
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'content_tag' => 'image',
				),
			)
		);
		$repeater->add_control(
			'html_content',
			array(
				'label'     => wp_kses_post( "HTML Content <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "use-html-content-with-hover-card-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::WYSIWYG,
				'default'   => esc_html__( 'I am text block. Click edit button to change this text.', 'tpebl' ),
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'content_tag' => 'html',
				),
			)
		);
		$repeater->add_control(
			'style_content',
			array(
				'label'     => wp_kses_post( "Custom Style <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "use-style-content-with-hover-card-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::TEXTAREA,
				'dynamic'   => array(
					'active' => true,
				),
				'default'   => '',
				'condition' => array(
					'content_tag' => 'style',
				),
			)
		);
		$repeater->add_control(
			'script_content',
			array(
				'label'     => wp_kses_post( "Custom Script <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "use-script-content-with-hover-card-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::TEXTAREA,
				'dynamic'   => array(
					'active' => true,
				),
				'default'   => '',
				'condition' => array(
					'content_tag' => 'script',
				),
			)
		);

		if( ! tp_senitize_role( 'unfiltered_html' ) ){
			$repeater->add_control(
				'script_c_notice',
				array(
					'type'        => Controls_Manager::RAW_HTML,
					'raw'         => '<p class="tp-controller-notice"><i>You are not a admin user so <b>Custom Script</b> option dose not work for you tell your admin to give you rights.</i></p>',
					'label_block' => true,
					'condition' => array(
						'content_tag' => 'script',
					),
				)
			);
		}

		$repeater->add_control(
			'style_heading',
			array(
				'label'     => esc_html__( 'Style', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'open_tag!' => 'none',
				),
			)
		);
		$repeater->add_control(
			'position',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Position', 'tpebl' ),
				'default'   => 'relative',
				'options'   => array(
					'relative' => esc_html__( 'Relative', 'tpebl' ),
					'absolute' => esc_html__( 'Absolute', 'tpebl' ),
				),
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'position: {{VALUE}}',
				),
				'condition' => array(
					'open_tag!' => 'none',
				),
			)
		);
		$repeater->add_control(
			'display',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Display', 'tpebl' ),
				'default'   => 'initial',
				'options'   => array(
					'block'        => esc_html__( 'Block', 'tpebl' ),
					'inline-block' => esc_html__( 'Inline Block', 'tpebl' ),
					'flex'         => esc_html__( 'Flex', 'tpebl' ),
					'inline-flex'  => esc_html__( 'Inline Flex', 'tpebl' ),
					'initial'      => esc_html__( 'Initial', 'tpebl' ),
					'inherit'      => esc_html__( 'Inherit', 'tpebl' ),
				),
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} ' => 'display: {{VALUE}}',
				),
				'condition' => array(
					'open_tag!' => 'none',
				),
			)
		);
		$repeater->add_control(
			'flex_direction',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Flex Direction', 'tpebl' ),
				'default'   => 'unset',
				'options'   => array(
					'column'         => esc_html__( 'column', 'tpebl' ),
					'column-reverse' => esc_html__( 'column-reverse', 'tpebl' ),
					'row'            => esc_html__( 'row', 'tpebl' ),
					'unset'          => esc_html__( 'unset', 'tpebl' ),
				),
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} ' => 'flex-direction: {{VALUE}}',
				),
				'condition' => array(
					'open_tag!' => 'none',
					'display'   => array( 'flex', 'inline-flex' ),
				),
			)
		);
		$repeater->add_control(
			'display_alignmet_opt',
			array(
				'label'     => esc_html__( 'Alignment CSS Options', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'condition' => array(
					'open_tag!' => 'none',
				),
			)
		);
		$repeater->add_control(
			'text_align',
			array(
				'label'     => esc_html__( 'Text Align', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'center',
				'options'   => array(
					'left'   => esc_html__( 'Left', 'tpebl' ),
					'center' => esc_html__( 'Center', 'tpebl' ),
					'right'  => esc_html__( 'Right', 'tpebl' ),
				),
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'text-align:{{VALUE}};',
				),
				'condition' => array(
					'open_tag!'            => 'none',
					'display_alignmet_opt' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'align_items',
			array(
				'label'     => esc_html__( 'Align Items', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'center',
				'options'   => array(
					'flex-start' => esc_html__( 'Flex Start', 'tpebl' ),
					'center'     => esc_html__( 'Center', 'tpebl' ),
					'flex-end'   => esc_html__( 'Flex End', 'tpebl' ),
				),
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'align-items:{{VALUE}};',
				),
				'condition' => array(
					'open_tag!'            => 'none',
					'display'              => array( 'flex', 'inline-flex' ),
					'display_alignmet_opt' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'justify_content',
			array(
				'label'     => esc_html__( 'Justify Content', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'center',
				'options'   => array(
					'flex-start'    => esc_html__( 'Flex Start', 'tpebl' ),
					'center'        => esc_html__( 'Center', 'tpebl' ),
					'flex-end'      => esc_html__( 'Flex End', 'tpebl' ),
					'space-around'  => esc_html__( 'Space Around', 'tpebl' ),
					'space-between' => esc_html__( 'Space Between', 'tpebl' ),
					'space-evenly'  => esc_html__( 'Space Evenly', 'tpebl' ),
				),
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'justify-content:{{VALUE}};',
				),
				'condition' => array(
					'open_tag!'            => 'none',
					'display'              => array( 'flex', 'inline-flex' ),
					'display_alignmet_opt' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'vertical_align',
			array(
				'label'     => esc_html__( 'Vertical Align', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'middle',
				'options'   => array(
					'top'    => esc_html__( 'Top', 'tpebl' ),
					'middle' => esc_html__( 'Middle', 'tpebl' ),
					'bottom' => esc_html__( 'Bottom', 'tpebl' ),
				),
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'vertical-align:{{VALUE}};',
				),
				'condition' => array(
					'open_tag!'            => 'none',
					'display'              => array( 'flex', 'inline-flex' ),
					'display_alignmet_opt' => 'yes',
				),
			)
		);
		$repeater->add_responsive_control(
			'margin',
			array(
				'label'      => esc_html__( 'Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
				'condition'  => array(
					'open_tag!' => 'none',
				),
			)
		);
		$repeater->add_responsive_control(
			'padding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'open_tag!' => 'none',
				),
			)
		);
		$repeater->add_control(
			'top_offset_switch',
			array(
				'label'     => esc_html__( 'Top (Auto / PX)', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'PX', 'tpebl' ),
				'label_off' => esc_html__( 'Auto', 'tpebl' ),
				'condition' => array(
					'open_tag!' => 'none',
					'position'  => 'absolute',
				),
			)
		);
		$repeater->add_control(
			'top_offset',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Top Offset', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => -300,
						'max'  => 300,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'condition'   => array(
					'open_tag!'         => 'none',
					'position'          => 'absolute',
					'top_offset_switch' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'bottom_offset_switch',
			array(
				'label'     => esc_html__( 'Bottom (Auto / PX)', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'PX', 'tpebl' ),
				'label_off' => esc_html__( 'Auto', 'tpebl' ),
				'condition' => array(
					'open_tag!' => 'none',
					'position'  => 'absolute',
				),
			)
		);
		$repeater->add_control(
			'bottom_offset',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Bottom Offset', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => -300,
						'max'  => 300,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'condition'   => array(
					'open_tag!'            => 'none',
					'position'             => 'absolute',
					'bottom_offset_switch' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'left_offset_switch',
			array(
				'label'     => esc_html__( 'Left (Auto / PX)', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'PX', 'tpebl' ),
				'label_off' => esc_html__( 'Auto', 'tpebl' ),
				'condition' => array(
					'open_tag!' => 'none',
					'position'  => 'absolute',
				),
			)
		);
		$repeater->add_control(
			'left_offset',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Left Offset', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => -300,
						'max'  => 300,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'condition'   => array(
					'open_tag!'          => 'none',
					'position'           => 'absolute',
					'left_offset_switch' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'right_offset_switch',
			array(
				'label'     => esc_html__( 'Right (Auto / PX)', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'PX', 'tpebl' ),
				'label_off' => esc_html__( 'Auto', 'tpebl' ),
				'condition' => array(
					'open_tag!' => 'none',
					'position'  => 'absolute',
				),
			)
		);
		$repeater->add_control(
			'right_offset',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Right Offset', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => -300,
						'max'  => 300,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'condition'   => array(
					'open_tag!'           => 'none',
					'position'            => 'absolute',
					'right_offset_switch' => 'right_offset_switch',
				),
			)
		);
		$repeater->add_control(
			'width_height',
			array(
				'label'     => esc_html__( 'Width/Height Options', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'condition' => array(
					'open_tag!' => 'none',
				),
			)
		);
		$repeater->add_responsive_control(
			'width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Width', 'tpebl' ),
				'size_units'  => array( 'px', '%', 'vh' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					),
					'%'  => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
					'vh' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} ' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition'   => array(
					'open_tag!'    => 'none',
					'width_height' => 'yes',
				),
			)
		);
		$repeater->add_responsive_control(
			'min_width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Min. Width', 'tpebl' ),
				'size_units'  => array( 'px', '%', 'vh' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					),
					'%'  => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
					'vh' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'min-width: {{SIZE}}{{UNIT}};',
				),
				'condition'   => array(
					'open_tag!'    => 'none',
					'width_height' => 'yes',
				),
			)
		);
		$repeater->add_responsive_control(
			'height',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Height', 'tpebl' ),
				'size_units'  => array( 'px', '%', 'vh' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 700,
						'step' => 1,
					),
					'%'  => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
					'vh' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'height: {{SIZE}}{{UNIT}};',
				),
				'condition'   => array(
					'open_tag!'    => 'none',
					'width_height' => 'yes',
				),
			)
		);
		$repeater->add_responsive_control(
			'min_height',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Min. Height', 'tpebl' ),
				'size_units'  => array( 'px', '%', 'vh' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 700,
						'step' => 1,
					),
					'%'  => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
					'vh' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} ' => 'min-height: {{SIZE}}{{UNIT}};',
				),
				'condition'   => array(
					'open_tag!'    => 'none',
					'width_height' => 'yes',
				),
			)
		);
		$repeater->add_responsive_control(
			'z_index',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Z-Index', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} ' => 'z-index: {{SIZE}};',
				),
				'condition'   => array(
					'open_tag!' => 'none',
				),
			)
		);
		$repeater->add_control(
			'overflow',
			array(
				'label'     => esc_html__( 'Overflow', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'visible',
				'options'   => array(
					'hidden'  => esc_html__( 'Hidden', 'tpebl' ),
					'visible' => esc_html__( 'Visible', 'tpebl' ),
				),
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'overflow:{{VALUE}} !important;',
				),
				'condition' => array(
					'open_tag!' => 'none',
				),
			)
		);
		$repeater->add_control(
			'visibility',
			array(
				'label'     => esc_html__( 'Visibility', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'unset',
				'options'   => array(
					'unset'   => esc_html__( 'Unset', 'tpebl' ),
					'hidden'  => esc_html__( 'Hidden', 'tpebl' ),
					'visible' => esc_html__( 'Visible', 'tpebl' ),
				),
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} ' => 'visibility:{{VALUE}} !important;',
				),
				'condition' => array(
					'open_tag!' => 'none',
				),
			)
		);
		$repeater->add_control(
			'bg_opt_heading',
			array(
				'label'     => esc_html__( 'Background Style', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'open_tag!' => 'none',
				),
			)
		);
		$repeater->add_control(
			'bg_opt',
			array(
				'label'     => esc_html__( 'Background', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'condition' => array(
					'open_tag!' => 'none',
				),
			)
		);
		$repeater->start_controls_tabs( 'tabs_background_options' );
			$repeater->start_controls_tab(
				'bg_opt_normal',
				array(
					'label'     => esc_html__( 'Normal', 'tpebl' ),
					'condition' => array(
						'open_tag!' => 'none',
						'bg_opt'    => 'yes',
					),
				)
			);
			$repeater->add_group_control(
				Group_Control_Background::get_type(),
				array(
					'name'      => 'bg_opt_bg',
					'types'     => array( 'classic', 'gradient' ),
					'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}}',
					'condition' => array(
						'open_tag!' => 'none',
						'bg_opt'    => 'yes',
					),
				)
			);
			$repeater->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'      => 'bg_opt_border',
					'label'     => esc_html__( 'Border', 'tpebl' ),
					'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}}',
					'condition' => array(
						'open_tag!' => 'none',
						'bg_opt'    => 'yes',
					),
				)
			);
			$repeater->add_responsive_control(
				'bg_opt_br',
				array(
					'label'      => esc_html__( 'Border Radius', 'tpebl' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} {{CURRENT_ITEM}}' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
					'condition'  => array(
						'open_tag!' => 'none',
						'bg_opt'    => 'yes',
					),
				)
			);
			$repeater->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'      => 'bg_opt_shadow',
					'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}}',
					'condition' => array(
						'open_tag!' => 'none',
						'bg_opt'    => 'yes',
					),
				)
			);
			$repeater->add_control(
				'transition',
				array(
					'label'       => esc_html__( 'Transition css', 'tpebl' ),
					'type'        => Controls_Manager::TEXT,
					'placeholder' => esc_html__( 'all .3s linear', 'tpebl' ),
					'selectors'   => array(
						'{{WRAPPER}} {{CURRENT_ITEM}}' => '-webkit-transition: {{VALUE}};-moz-transition: {{VALUE}};-o-transition: {{VALUE}};-ms-transition: {{VALUE}};',
					),
					'condition'   => array(
						'open_tag!' => 'none',
						'bg_opt'    => 'yes',
					),
					'separator'   => 'before',
				)
			);
			$repeater->add_control(
				'transform',
				array(
					'label'       => esc_html__( 'Transform css', 'tpebl' ),
					'type'        => Controls_Manager::TEXT,
					'placeholder' => esc_html__( 'rotate(10deg) scale(1.1)', 'tpebl' ),
					'selectors'   => array(
						'{{WRAPPER}} {{CURRENT_ITEM}}' => 'transform: {{VALUE}};-ms-transform: {{VALUE}};-moz-transform: {{VALUE}};-webkit-transform: {{VALUE}};',
					),
					'condition'   => array(
						'open_tag!' => 'none',
						'bg_opt'    => 'yes',
					),
				)
			);
			$repeater->add_group_control(
				Group_Control_Css_Filter::get_type(),
				array(
					'name'      => 'css_filters',
					'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}}',
					'condition' => array(
						'open_tag!' => 'none',
						'bg_opt'    => 'yes',
					),
				)
			);
			$repeater->add_control(
				'opacity',
				array(
					'label'     => esc_html__( 'Opacity', 'tpebl' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => array(
						'px' => array(
							'max'  => 1,
							'min'  => 0,
							'step' => 0.01,
						),
					),
					'selectors' => array(
						'{{WRAPPER}} {{CURRENT_ITEM}}' => 'opacity: {{SIZE}};',
					),
					'condition' => array(
						'open_tag!' => 'none',
						'bg_opt'    => 'yes',
					),
				)
			);
			$repeater->end_controls_tab();
			$repeater->start_controls_tab(
				'bg_opt_hover',
				array(
					'label'     => esc_html__( 'Hover', 'tpebl' ),
					'condition' => array(
						'open_tag!' => 'none',
						'bg_opt'    => 'yes',
					),
				)
			);
			$repeater->add_control(
				'cst_hover',
				array(
					'label'     => wp_kses_post( "Custom Hover <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "add-hover-effect-with-custom-hover-class-in-elementor-hover-card/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
					'type'      => Controls_Manager::SWITCHER,
					'default'   => 'no',
					'label_on'  => esc_html__( 'Enable', 'tpebl' ),
					'label_off' => esc_html__( 'Disable', 'tpebl' ),
					'condition' => array(
						'open_tag!' => 'none',
						'bg_opt'    => 'yes',
					),
				)
			);
			$repeater->add_control(
				'cst_hover_class',
				array(
					'label'       => esc_html__( 'Enter Class', 'tpebl' ),
					'type'        => Controls_Manager::TEXT,
					'default'     => '',
					'dynamic'     => array( 'active' => true ),
					'label_block' => true,
					'condition'   => array(
						'open_tag!' => 'none',
						'bg_opt'    => 'yes',
						'cst_hover' => 'yes',
					),
				)
			);
			$repeater->add_group_control(
				Group_Control_Background::get_type(),
				array(
					'name'      => 'bg_opt_bg_hover',
					'types'     => array( 'classic', 'gradient' ),
					'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}}:hover',
					'condition' => array(
						'open_tag!'  => 'none',
						'bg_opt'     => 'yes',
						'cst_hover!' => 'yes',
					),
				)
			);
			$repeater->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'      => 'bg_opt_border_hover',
					'label'     => esc_html__( 'Border', 'tpebl' ),
					'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}}:hover',
					'condition' => array(
						'open_tag!'  => 'none',
						'bg_opt'     => 'yes',
						'cst_hover!' => 'yes',
					),
				)
			);
			$repeater->add_responsive_control(
				'bg_opt_br_hover',
				array(
					'label'      => esc_html__( 'Border Radius', 'tpebl' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
					'condition'  => array(
						'open_tag!'  => 'none',
						'bg_opt'     => 'yes',
						'cst_hover!' => 'yes',
					),
				)
			);
			$repeater->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'      => 'bg_opt_shadow_hover',
					'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}}:hover',
					'condition' => array(
						'open_tag!'  => 'none',
						'bg_opt'     => 'yes',
						'cst_hover!' => 'yes',
					),
				)
			);
			$repeater->add_control(
				'transition_hover',
				array(
					'label'       => esc_html__( 'Transition css', 'tpebl' ),
					'type'        => Controls_Manager::TEXT,
					'placeholder' => esc_html__( 'all .3s linear', 'tpebl' ),
					'selectors'   => array(
						'{{WRAPPER}} {{CURRENT_ITEM}}:hover' => '-webkit-transition: {{VALUE}};-moz-transition: {{VALUE}};-o-transition: {{VALUE}};-ms-transition: {{VALUE}};',
					),
					'condition'   => array(
						'open_tag!'  => 'none',
						'bg_opt'     => 'yes',
						'cst_hover!' => 'yes',
					),
					'separator'   => 'before',
				)
			);
			$repeater->add_control(
				'transform_hover',
				array(
					'label'       => esc_html__( 'Transform css', 'tpebl' ),
					'type'        => Controls_Manager::TEXT,
					'placeholder' => esc_html__( 'rotate(10deg) scale(1.1)', 'tpebl' ),
					'selectors'   => array(
						'{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'transform: {{VALUE}};-ms-transform: {{VALUE}};-moz-transform: {{VALUE}};-webkit-transform: {{VALUE}};',
					),
					'condition'   => array(
						'open_tag!'  => 'none',
						'bg_opt'     => 'yes',
						'cst_hover!' => 'yes',
					),
				)
			);
			$repeater->add_group_control(
				Group_Control_Css_Filter::get_type(),
				array(
					'name'      => 'css_filters_hover',
					'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}}:hover',
					'condition' => array(
						'open_tag!'  => 'none',
						'bg_opt'     => 'yes',
						'cst_hover!' => 'yes',
					),
				)
			);
			$repeater->add_control(
				'opacity_hover',
				array(
					'label'     => esc_html__( 'Opacity', 'tpebl' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => array(
						'px' => array(
							'max'  => 1,
							'min'  => 0,
							'step' => 0.01,
						),
					),
					'selectors' => array(
						'{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'opacity: {{SIZE}};',
					),
					'condition' => array(
						'open_tag!'  => 'none',
						'bg_opt'     => 'yes',
						'cst_hover!' => 'yes',
					),
				)
			);
			$repeater->add_control(
				'b_color_option',
				array(
					'label'       => esc_html__( 'Background', 'tpebl' ),
					'type'        => Controls_Manager::CHOOSE,
					'options'     => array(
						'solid'    => array(
							'title' => esc_html__( 'Classic', 'tpebl' ),
							'icon'  => 'eicon-paint-brush',
						),
						'gradient' => array(
							'title' => esc_html__( 'Gradient', 'tpebl' ),
							'icon'  => 'fa fa-barcode',
						),
						'image'    => array(
							'title' => esc_html__( 'Image', 'tpebl' ),
							'icon'  => 'fa fa-file-image-o',
						),
					),
					'condition'   => array(
						'open_tag!' => 'none',
						'bg_opt'    => 'yes',
						'cst_hover' => 'yes',
					),
					'label_block' => false,
					'default'     => 'solid',
				)
			);
			$repeater->add_control(
				'b_color_solid',
				array(
					'label'     => esc_html__( 'Color', 'tpebl' ),
					'type'      => Controls_Manager::COLOR,
					'condition' => array(
						'open_tag!'      => 'none',
						'bg_opt'         => 'yes',
						'cst_hover'      => 'yes',
						'b_color_option' => 'solid',
					),
				)
			);
			$repeater->add_control(
				'b_gradient_color1',
				array(
					'label'     => esc_html__( 'Color 1', 'tpebl' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => 'orange',
					'condition' => array(
						'open_tag!'      => 'none',
						'bg_opt'         => 'yes',
						'cst_hover'      => 'yes',
						'b_color_option' => 'gradient',
					),
					'of_type'   => 'gradient',
				)
			);
			$repeater->add_control(
				'b_gradient_color1_control',
				array(
					'type'        => Controls_Manager::SLIDER,
					'label'       => esc_html__( 'Color 1 Location', 'tpebl' ),
					'size_units'  => array( '%' ),
					'default'     => array(
						'unit' => '%',
						'size' => 0,
					),
					'render_type' => 'ui',
					'condition'   => array(
						'open_tag!'      => 'none',
						'bg_opt'         => 'yes',
						'cst_hover'      => 'yes',
						'b_color_option' => 'gradient',
					),
					'of_type'     => 'gradient',
				)
			);
			$repeater->add_control(
				'b_gradient_color2',
				array(
					'label'     => esc_html__( 'Color 2', 'tpebl' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => 'cyan',
					'condition' => array(
						'open_tag!'      => 'none',
						'bg_opt'         => 'yes',
						'cst_hover'      => 'yes',
						'b_color_option' => 'gradient',
					),
					'of_type'   => 'gradient',
				)
			);
			$repeater->add_control(
				'b_gradient_color2_control',
				array(
					'type'        => Controls_Manager::SLIDER,
					'label'       => esc_html__( 'Color 2 Location', 'tpebl' ),
					'size_units'  => array( '%' ),
					'default'     => array(
						'unit' => '%',
						'size' => 100,
					),
					'render_type' => 'ui',
					'condition'   => array(
						'open_tag!'      => 'none',
						'bg_opt'         => 'yes',
						'cst_hover'      => 'yes',
						'b_color_option' => 'gradient',
					),
					'of_type'     => 'gradient',
				)
			);
			$repeater->add_control(
				'b_gradient_style',
				array(
					'type'      => Controls_Manager::SELECT,
					'label'     => esc_html__( 'Gradient Style', 'tpebl' ),
					'default'   => 'linear',
					'options'   => l_theplus_get_gradient_styles(),
					'condition' => array(
						'open_tag!'      => 'none',
						'bg_opt'         => 'yes',
						'cst_hover'      => 'yes',
						'b_color_option' => 'gradient',
					),
					'of_type'   => 'gradient',
				)
			);
			$repeater->add_control(
				'b_gradient_angle',
				array(
					'type'       => Controls_Manager::SLIDER,
					'label'      => esc_html__( 'Gradient Angle', 'tpebl' ),
					'size_units' => array( 'deg' ),
					'default'    => array(
						'unit' => 'deg',
						'size' => 180,
					),
					'range'      => array(
						'deg' => array(
							'step' => 10,
						),
					),
					'condition'  => array(
						'open_tag!'        => 'none',
						'bg_opt'           => 'yes',
						'cst_hover'        => 'yes',
						'b_color_option'   => 'gradient',
						'b_gradient_style' => array( 'linear' ),
					),
					'of_type'    => 'gradient',
				)
			);
			$repeater->add_control(
				'b_gradient_position',
				array(
					'type'      => Controls_Manager::SELECT,
					'label'     => esc_html__( 'Position', 'tpebl' ),
					'options'   => l_theplus_get_position_options(),
					'default'   => 'center center',
					'condition' => array(
						'open_tag!'        => 'none',
						'bg_opt'           => 'yes',
						'cst_hover'        => 'yes',
						'b_color_option'   => 'gradient',
						'b_gradient_style' => 'radial',
					),
					'of_type'   => 'gradient',
				)
			);
			$repeater->add_control(
				'b_h_image',
				array(
					'type'      => Controls_Manager::MEDIA,
					'label'     => esc_html__( 'Background Image', 'tpebl' ),
					'dynamic'   => array( 'active' => true ),
					'condition' => array(
						'open_tag!'      => 'none',
						'bg_opt'         => 'yes',
						'cst_hover'      => 'yes',
						'b_color_option' => 'image',
					),
				)
			);
			$repeater->add_control(
				'b_h_image_position',
				array(
					'type'      => Controls_Manager::SELECT,
					'label'     => esc_html__( 'Image Position', 'tpebl' ),
					'default'   => 'center center',
					'options'   => array(
						''              => esc_html__( 'Default', 'tpebl' ),
						'top left'      => esc_html__( 'Top Left', 'tpebl' ),
						'top center'    => esc_html__( 'Top Center', 'tpebl' ),
						'top right'     => esc_html__( 'Top Right', 'tpebl' ),
						'center left'   => esc_html__( 'Center Left', 'tpebl' ),
						'center center' => esc_html__( 'Center Center', 'tpebl' ),
						'center right'  => esc_html__( 'Center Right', 'tpebl' ),
						'bottom left'   => esc_html__( 'Bottom Left', 'tpebl' ),
						'bottom center' => esc_html__( 'Bottom Center', 'tpebl' ),
						'bottom right'  => esc_html__( 'Bottom Right', 'tpebl' ),
					),
					'condition' => array(
						'open_tag!'       => 'none',
						'bg_opt'          => 'yes',
						'cst_hover'       => 'yes',
						'b_color_option'  => 'image',
						'b_h_image[url]!' => '',
					),
				)
			);
			$repeater->add_control(
				'b_h_image_attach',
				array(
					'type'      => Controls_Manager::SELECT,
					'label'     => esc_html__( 'Attachment', 'tpebl' ),
					'default'   => 'scroll',
					'options'   => array(
						''       => esc_html__( 'Default', 'tpebl' ),
						'scroll' => esc_html__( 'Scroll', 'tpebl' ),
						'fixed'  => esc_html__( 'Fixed', 'tpebl' ),
					),
					'condition' => array(
						'open_tag!'       => 'none',
						'bg_opt'          => 'yes',
						'cst_hover'       => 'yes',
						'b_color_option'  => 'image',
						'b_h_image[url]!' => '',
					),
				)
			);
			$repeater->add_control(
				'b_h_image_repeat',
				array(
					'type'      => Controls_Manager::SELECT,
					'label'     => esc_html__( 'Repeat', 'tpebl' ),
					'default'   => 'repeat',
					'options'   => array(
						''          => esc_html__( 'Default', 'tpebl' ),
						'no-repeat' => esc_html__( 'No-repeat', 'tpebl' ),
						'repeat'    => esc_html__( 'Repeat', 'tpebl' ),
						'repeat-x'  => esc_html__( 'Repeat-x', 'tpebl' ),
						'repeat-y'  => esc_html__( 'Repeat-y', 'tpebl' ),
					),
					'condition' => array(
						'open_tag!'       => 'none',
						'bg_opt'          => 'yes',
						'cst_hover'       => 'yes',
						'b_color_option'  => 'image',
						'b_h_image[url]!' => '',
					),
				)
			);
			$repeater->add_control(
				'b_h_image_size',
				array(
					'type'      => Controls_Manager::SELECT,
					'label'     => esc_html__( 'Background Size', 'tpebl' ),
					'default'   => 'cover',
					'options'   => array(
						''        => esc_html__( 'Default', 'tpebl' ),
						'auto'    => esc_html__( 'Auto', 'tpebl' ),
						'cover'   => esc_html__( 'Cover', 'tpebl' ),
						'contain' => esc_html__( 'Contain', 'tpebl' ),
					),
					'condition' => array(
						'open_tag!'       => 'none',
						'bg_opt'          => 'yes',
						'cst_hover'       => 'yes',
						'b_color_option'  => 'image',
						'b_h_image[url]!' => '',
					),
				)
			);
			$repeater->add_control(
				'b_h_border_style',
				array(
					'label'     => esc_html__( 'Border Style', 'tpebl' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => '',
					'options'   => array(
						''       => esc_html__( 'None', 'tpebl' ),
						'solid'  => esc_html__( 'Solid', 'tpebl' ),
						'dashed' => esc_html__( 'Dashed', 'tpebl' ),
						'dotted' => esc_html__( 'Dotted', 'tpebl' ),
						'groove' => esc_html__( 'Groove', 'tpebl' ),
						'inset'  => esc_html__( 'Inset', 'tpebl' ),
						'outset' => esc_html__( 'Outset', 'tpebl' ),
						'ridge'  => esc_html__( 'Ridge', 'tpebl' ),
					),
					'condition' => array(
						'open_tag!' => 'none',
						'bg_opt'    => 'yes',
						'cst_hover' => 'yes',
					),
				)
			);
			$repeater->add_responsive_control(
				'b_h_border_width',
				array(
					'label'      => esc_html__( 'Border Width', 'tpebl' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'condition'  => array(
						'open_tag!'         => 'none',
						'bg_opt'            => 'yes',
						'cst_hover'         => 'yes',
						'b_h_border_style!' => '',
					),
				)
			);
			$repeater->add_control(
				'b_h_border_color',
				array(
					'label'     => esc_html__( 'Border Color', 'tpebl' ),
					'type'      => Controls_Manager::COLOR,
					'condition' => array(
						'open_tag!'         => 'none',
						'bg_opt'            => 'yes',
						'cst_hover'         => 'yes',
						'b_h_border_style!' => '',
					),
				)
			);
			$repeater->add_responsive_control(
				'b_h_border_radius',
				array(
					'label'      => esc_html__( 'Border Radius', 'tpebl' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'condition'  => array(
						'open_tag!' => 'none',
						'bg_opt'    => 'yes',
						'cst_hover' => 'yes',
					),
				)
			);
			$repeater->add_control(
				'box_shadow_hover_cst',
				array(
					'label'        => esc_html__( 'Box Shadow', 'tpebl' ),
					'type'         => Controls_Manager::POPOVER_TOGGLE,
					'label_off'    => __( 'Default', 'tpebl' ),
					'label_on'     => __( 'Custom', 'tpebl' ),
					'return_value' => 'yes',
					'condition'    => array(
						'open_tag!' => 'none',
						'bg_opt'    => 'yes',
						'cst_hover' => 'yes',
					),
				)
			);
			$repeater->start_popover();
			$repeater->add_control(
				'box_shadow_color',
				array(
					'label'     => esc_html__( 'Color', 'tpebl' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => 'rgba(0,0,0,0.5)',
					'condition' => array(
						'open_tag!'            => 'none',
						'bg_opt'               => 'yes',
						'cst_hover'            => 'yes',
						'box_shadow_hover_cst' => 'yes',
					),
				)
			);
			$repeater->add_control(
				'box_shadow_horizontal',
				array(
					'label'      => esc_html__( 'Horizontal', 'tpebl' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => array( 'px' ),
					'range'      => array(
						'px' => array(
							'max'  => -100,
							'min'  => 100,
							'step' => 2,
						),
					),
					'default'    => array(
						'unit' => 'px',
						'size' => 0,
					),
					'condition'  => array(
						'open_tag!'            => 'none',
						'bg_opt'               => 'yes',
						'cst_hover'            => 'yes',
						'box_shadow_hover_cst' => 'yes',
					),
				)
			);
			$repeater->add_control(
				'box_shadow_vertical',
				array(
					'label'      => esc_html__( 'Vertical', 'tpebl' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => array( 'px' ),
					'range'      => array(
						'px' => array(
							'max'  => -100,
							'min'  => 100,
							'step' => 2,
						),
					),
					'default'    => array(
						'unit' => 'px',
						'size' => 0,
					),
					'condition'  => array(
						'open_tag!'            => 'none',
						'bg_opt'               => 'yes',
						'cst_hover'            => 'yes',
						'box_shadow_hover_cst' => 'yes',
					),
				)
			);
			$repeater->add_control(
				'box_shadow_blur',
				array(
					'label'      => esc_html__( 'Blur', 'tpebl' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => array( 'px' ),
					'range'      => array(
						'px' => array(
							'max'  => 0,
							'min'  => 100,
							'step' => 1,
						),
					),
					'default'    => array(
						'unit' => 'px',
						'size' => 10,
					),
					'condition'  => array(
						'open_tag!'            => 'none',
						'bg_opt'               => 'yes',
						'cst_hover'            => 'yes',
						'box_shadow_hover_cst' => 'yes',
					),
				)
			);
			$repeater->add_control(
				'box_shadow_spread',
				array(
					'label'      => esc_html__( 'Spread', 'tpebl' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => array( 'px' ),
					'range'      => array(
						'px' => array(
							'max'  => -100,
							'min'  => 100,
							'step' => 2,
						),
					),
					'default'    => array(
						'unit' => 'px',
						'size' => 0,
					),
					'condition'  => array(
						'open_tag!'            => 'none',
						'bg_opt'               => 'yes',
						'cst_hover'            => 'yes',
						'box_shadow_hover_cst' => 'yes',
					),
				)
			);
			$repeater->end_popover();

			$repeater->add_control(
				'transition_hover_cst',
				array(
					'label'       => esc_html__( 'Transition css', 'tpebl' ),
					'type'        => Controls_Manager::TEXT,
					'placeholder' => esc_html__( 'all .3s linear', 'tpebl' ),
					'condition'   => array(
						'open_tag!' => 'none',
						'bg_opt'    => 'yes',
						'cst_hover' => 'yes',
					),
					'separator'   => 'before',
				)
			);
			$repeater->add_control(
				'transform_hover_cst',
				array(
					'label'       => esc_html__( 'Transform css', 'tpebl' ),
					'type'        => Controls_Manager::TEXT,
					'placeholder' => esc_html__( 'rotate(10deg) scale(1.1)', 'tpebl' ),
					'condition'   => array(
						'open_tag!' => 'none',
						'bg_opt'    => 'yes',
						'cst_hover' => 'yes',
					),
				)
			);

			$repeater->add_control(
				'css_filter_hover_cst',
				array(
					'label'        => esc_html__( 'CSS Filter', 'tpebl' ),
					'type'         => Controls_Manager::POPOVER_TOGGLE,
					'label_off'    => __( 'Default', 'tpebl' ),
					'label_on'     => __( 'Custom', 'tpebl' ),
					'return_value' => 'yes',
					'condition'    => array(
						'open_tag!' => 'none',
						'bg_opt'    => 'yes',
						'cst_hover' => 'yes',
					),
				)
			);
			$repeater->start_popover();
			$repeater->add_control(
				'css_filter_blur',
				array(
					'label'     => esc_html__( 'Blur', 'tpebl' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => array(
						'px' => array(
							'max'  => 10,
							'min'  => 0,
							'step' => 0.1,
						),
					),
					'default'   => array(
						'unit' => 'px',
						'size' => 0,
					),
					'condition' => array(
						'open_tag!'            => 'none',
						'bg_opt'               => 'yes',
						'cst_hover'            => 'yes',
						'css_filter_hover_cst' => 'yes',
					),
				)
			);
			$repeater->add_control(
				'css_filter_brightness',
				array(
					'label'     => esc_html__( 'Brightness', 'tpebl' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => array(
						'px' => array(
							'max'  => 200,
							'min'  => 0,
							'step' => 2,
						),
					),
					'default'   => array(
						'unit' => '%',
						'size' => 100,
					),
					'condition' => array(
						'open_tag!'            => 'none',
						'bg_opt'               => 'yes',
						'cst_hover'            => 'yes',
						'css_filter_hover_cst' => 'yes',
					),
				)
			);
			$repeater->add_control(
				'css_filter_contrast',
				array(
					'label'     => esc_html__( 'Contrast', 'tpebl' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => array(
						'px' => array(
							'max'  => 200,
							'min'  => 0,
							'step' => 2,
						),
					),
					'default'   => array(
						'unit' => '%',
						'size' => 100,
					),
					'condition' => array(
						'open_tag!'            => 'none',
						'bg_opt'               => 'yes',
						'cst_hover'            => 'yes',
						'css_filter_hover_cst' => 'yes',
					),
				)
			);
			$repeater->add_control(
				'css_filter_saturation',
				array(
					'label'     => esc_html__( 'Saturation', 'tpebl' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => array(
						'px' => array(
							'max'  => 200,
							'min'  => 0,
							'step' => 2,
						),
					),
					'default'   => array(
						'unit' => '%',
						'size' => 100,
					),
					'condition' => array(
						'open_tag!'            => 'none',
						'bg_opt'               => 'yes',
						'cst_hover'            => 'yes',
						'css_filter_hover_cst' => 'yes',
					),
				)
			);
			$repeater->add_control(
				'css_filter_hue',
				array(
					'label'     => esc_html__( 'Hue', 'tpebl' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => array(
						'px' => array(
							'max'  => 360,
							'min'  => 0,
							'step' => 5,
						),
					),
					'default'   => array(
						'unit' => 'px',
						'size' => 0,
					),
					'condition' => array(
						'open_tag!'            => 'none',
						'bg_opt'               => 'yes',
						'cst_hover'            => 'yes',
						'css_filter_hover_cst' => 'yes',
					),
				)
			);
			$repeater->end_popover();

			$repeater->add_control(
				'opacity_hover_cst',
				array(
					'label'     => esc_html__( 'Opacity', 'tpebl' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => array(
						'px' => array(
							'max'  => 1,
							'min'  => 0,
							'step' => 0.01,
						),
					),
					'condition' => array(
						'open_tag!' => 'none',
						'bg_opt'    => 'yes',
						'cst_hover' => 'yes',
					),
				)
			);
		$repeater->end_controls_tab();
		$repeater->end_controls_tabs();

		$repeater->add_control(
			'text_heading',
			array(
				'label'     => esc_html__( 'Text Style', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'content_tag' => 'text',
				),
			)
		);
		$repeater->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'text_typography',
				'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}}',
				'condition' => array(
					'content_tag' => 'text',
				),
			)
		);
		$repeater->start_controls_tabs( 'tabs_text_style' );
		$repeater->start_controls_tab(
			'tab_text_normal',
			array(
				'label'     => esc_html__( 'Normal', 'tpebl' ),
				'condition' => array(
					'content_tag' => 'text',
				),
			)
		);
		$repeater->add_control(
			'text_color',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'content_tag' => 'text',
				),
			)
		);
		$repeater->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'      => 'text_shadow',
				'label'     => esc_html__( 'Text Shadow', 'tpebl' ),
				'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}}',
				'condition' => array(
					'content_tag' => 'text',
				),
			)
		);
		$repeater->end_controls_tab();
		$repeater->start_controls_tab(
			'tab_text_hover',
			array(
				'label'     => esc_html__( 'Hover', 'tpebl' ),
				'condition' => array(
					'content_tag' => 'text',
				),
			)
		);
		$repeater->add_control(
			'cst_text_hover',
			array(
				'label'     => esc_html__( 'Custom Hover', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'condition' => array(
					'content_tag' => 'text',
				),
			)
		);
		$repeater->add_control(
			'text_color_h',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'content_tag'     => 'text',
					'cst_text_hover!' => 'yes',
				),
			)
		);
		$repeater->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'      => 'text_shadow_h',
				'label'     => esc_html__( 'Text Shadow', 'tpebl' ),
				'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}}:hover',
				'condition' => array(
					'content_tag'     => 'text',
					'cst_text_hover!' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'cst_text_hover_class',
			array(
				'label'       => esc_html__( 'Enter Class', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'dynamic'     => array( 'active' => true ),
				'label_block' => true,
				'condition'   => array(
					'content_tag'    => 'text',
					'cst_text_hover' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'text_color_h_cst',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'content_tag'    => 'text',
					'cst_text_hover' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'text_shadow_hover_cst',
			array(
				'label'        => esc_html__( 'Text Shadow', 'tpebl' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'tpebl' ),
				'label_on'     => __( 'Custom', 'tpebl' ),
				'return_value' => 'yes',
				'condition'    => array(
					'content_tag'    => 'text',
					'cst_text_hover' => 'yes',
				),
			)
		);
		$repeater->start_popover();
		$repeater->add_control(
			'ts_color',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(0,0,0,0.5)',
				'condition' => array(
					'content_tag'           => 'text',
					'cst_text_hover'        => 'yes',
					'text_shadow_hover_cst' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'ts_horizontal',
			array(
				'label'      => esc_html__( 'Horizontal', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'max'  => -100,
						'min'  => 100,
						'step' => 2,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 0,
				),
				'condition'  => array(
					'content_tag'           => 'text',
					'cst_text_hover'        => 'yes',
					'text_shadow_hover_cst' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'ts_vertical',
			array(
				'label'      => esc_html__( 'Vertical', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'max'  => -100,
						'min'  => 100,
						'step' => 2,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 0,
				),
				'condition'  => array(
					'content_tag'           => 'text',
					'cst_text_hover'        => 'yes',
					'text_shadow_hover_cst' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'ts_blur',
			array(
				'label'      => esc_html__( 'Blur', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'max'  => 0,
						'min'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 10,
				),
				'condition'  => array(
					'content_tag'           => 'text',
					'cst_text_hover'        => 'yes',
					'text_shadow_hover_cst' => 'yes',
				),
			)
		);
		$repeater->end_popover();
		$repeater->end_controls_tab();
		$repeater->end_controls_tabs();

		$repeater->add_control(
			'image_heading',
			array(
				'label'     => esc_html__( 'Image Style', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'content_tag' => 'image',
				),
			)
		);
		$repeater->add_control(
			'image_width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Width', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'condition'   => array(
					'content_tag' => 'image',
				),
				'selectors'   => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} ' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$repeater->add_control(
			'image_max_width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Max. Width', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'condition'   => array(
					'content_tag' => 'image',
				),
				'selectors'   => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} ' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$repeater->start_controls_tabs( 'tabs_image' );
		$repeater->start_controls_tab(
			'tab_image',
			array(
				'label'     => esc_html__( 'Normal', 'tpebl' ),
				'condition' => array(
					'content_tag' => 'image',
				),
			)
		);
		$repeater->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'image_border',
				'label'     => esc_html__( 'Border', 'tpebl' ),
				'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}}',
				'condition' => array(
					'content_tag' => 'image',
				),
			)
		);
		$repeater->add_responsive_control(
			'image_br',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'content_tag' => 'image',
				),
			)
		);
		$repeater->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'image_shadow',
				'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}}',
				'condition' => array(
					'content_tag' => 'image',
				),
			)
		);
		$repeater->add_control(
			'image_opacity',
			array(
				'label'     => esc_html__( 'Opacity', 'tpebl' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max'  => 1,
						'min'  => 0,
						'step' => 0.01,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'opacity: {{SIZE}};',
				),
				'condition' => array(
					'content_tag' => 'image',
				),
			)
		);
		$repeater->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'name'      => 'image_css_filters',
				'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}}',
				'condition' => array(
					'content_tag' => 'image',
				),
			)
		);
		$repeater->end_controls_tab();
		$repeater->start_controls_tab(
			'tab_hover',
			array(
				'label'     => esc_html__( 'Hover', 'tpebl' ),
				'condition' => array(
					'content_tag' => 'image',
				),
			)
		);
		$repeater->add_control(
			'cst_image_hover',
			array(
				'label'     => esc_html__( 'Custom Hover', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'condition' => array(
					'content_tag' => 'image',
				),
			)
		);
		$repeater->add_control(
			'cst_image_hover_class',
			array(
				'label'       => esc_html__( 'Enter Class', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'dynamic'     => array( 'active' => true ),
				'label_block' => true,
				'condition'   => array(
					'content_tag'     => 'image',
					'cst_image_hover' => 'yes',
				),
			)
		);
		$repeater->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'image_border_h',
				'label'     => esc_html__( 'Border', 'tpebl' ),
				'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}}:hover',
				'condition' => array(
					'content_tag'      => 'image',
					'cst_image_hover!' => 'yes',
				),
			)
		);
		$repeater->add_responsive_control(
			'image_br_h',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'content_tag'      => 'image',
					'cst_image_hover!' => 'yes',
				),
			)
		);
		$repeater->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'image_shadow_h',
				'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}}:hover',
				'condition' => array(
					'content_tag'      => 'image',
					'cst_image_hover!' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'image_opacity_h',
			array(
				'label'     => esc_html__( 'Opacity', 'tpebl' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max'  => 1,
						'min'  => 0,
						'step' => 0.01,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'opacity: {{SIZE}};',
				),
				'condition' => array(
					'content_tag'      => 'image',
					'cst_image_hover!' => 'yes',
				),
			)
		);
		$repeater->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'name'      => 'image_css_filters_h',
				'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}}:hover',
				'condition' => array(
					'content_tag'      => 'image',
					'cst_image_hover!' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'image_h_border_style',
			array(
				'label'     => esc_html__( 'Border Style', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => array(
					''       => esc_html__( 'None', 'tpebl' ),
					'solid'  => esc_html__( 'Solid', 'tpebl' ),
					'dashed' => esc_html__( 'Dashed', 'tpebl' ),
					'dotted' => esc_html__( 'Dotted', 'tpebl' ),
					'groove' => esc_html__( 'Groove', 'tpebl' ),
					'inset'  => esc_html__( 'Inset', 'tpebl' ),
					'outset' => esc_html__( 'Outset', 'tpebl' ),
					'ridge'  => esc_html__( 'Ridge', 'tpebl' ),
				),
				'condition' => array(
					'content_tag'     => 'image',
					'cst_image_hover' => 'yes',
				),
			)
		);
		$repeater->add_responsive_control(
			'image_h_border_width',
			array(
				'label'      => esc_html__( 'Border Width', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'condition'  => array(
					'content_tag'           => 'image',
					'cst_image_hover'       => 'yes',
					'image_h_border_style!' => '',
				),
			)
		);
		$repeater->add_control(
			'image_h_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'content_tag'           => 'image',
					'cst_image_hover'       => 'yes',
					'image_h_border_style!' => '',
				),
			)
		);
		$repeater->add_responsive_control(
			'image_h_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'condition'  => array(
					'content_tag'     => 'image',
					'cst_image_hover' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'image_box_shadow_hover_cst',
			array(
				'label'        => esc_html__( 'Box Shadow', 'tpebl' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'tpebl' ),
				'label_on'     => __( 'Custom', 'tpebl' ),
				'return_value' => 'yes',
				'condition'    => array(
					'content_tag'     => 'image',
					'cst_image_hover' => 'yes',
				),
			)
		);
		$repeater->start_popover();
		$repeater->add_control(
			'image_box_shadow_color',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(0,0,0,0.5)',
				'condition' => array(
					'content_tag'                => 'image',
					'cst_image_hover'            => 'yes',
					'image_box_shadow_hover_cst' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'image_box_shadow_horizontal',
			array(
				'label'      => esc_html__( 'Horizontal', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'max'  => -100,
						'min'  => 100,
						'step' => 2,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 0,
				),
				'condition'  => array(
					'content_tag'                => 'image',
					'cst_image_hover'            => 'yes',
					'image_box_shadow_hover_cst' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'image_box_shadow_vertical',
			array(
				'label'      => esc_html__( 'Vertical', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'max'  => -100,
						'min'  => 100,
						'step' => 2,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 0,
				),
				'condition'  => array(
					'content_tag'                => 'image',
					'cst_image_hover'            => 'yes',
					'image_box_shadow_hover_cst' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'image_box_shadow_blur',
			array(
				'label'      => esc_html__( 'Blur', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'max'  => 0,
						'min'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 10,
				),
				'condition'  => array(
					'content_tag'                => 'image',
					'cst_image_hover'            => 'yes',
					'image_box_shadow_hover_cst' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'image_box_shadow_spread',
			array(
				'label'      => esc_html__( 'Spread', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'max'  => -100,
						'min'  => 100,
						'step' => 2,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 0,
				),
				'condition'  => array(
					'content_tag'                => 'image',
					'cst_image_hover'            => 'yes',
					'image_box_shadow_hover_cst' => 'yes',
				),
			)
		);
		$repeater->end_popover();
		$repeater->add_control(
			'image_opacity_hover_cst',
			array(
				'label'     => esc_html__( 'Opacity', 'tpebl' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max'  => 1,
						'min'  => 0,
						'step' => 0.01,
					),
				),
				'condition' => array(
					'content_tag'     => 'image',
					'cst_image_hover' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'image_css_filter_hover_cst',
			array(
				'label'        => esc_html__( 'CSS Filter', 'tpebl' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'tpebl' ),
				'label_on'     => __( 'Custom', 'tpebl' ),
				'return_value' => 'yes',
				'condition'    => array(
					'content_tag'     => 'image',
					'cst_image_hover' => 'yes',
				),
			)
		);
		$repeater->start_popover();
		$repeater->add_control(
			'image_css_filter_blur',
			array(
				'label'     => esc_html__( 'Blur', 'tpebl' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max'  => 10,
						'min'  => 0,
						'step' => 0.1,
					),
				),
				'default'   => array(
					'unit' => 'px',
					'size' => 0,
				),
				'condition' => array(
					'content_tag'                => 'image',
					'cst_image_hover'            => 'yes',
					'image_css_filter_hover_cst' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'image_css_filter_brightness',
			array(
				'label'     => esc_html__( 'Brightness', 'tpebl' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max'  => 200,
						'min'  => 0,
						'step' => 2,
					),
				),
				'default'   => array(
					'unit' => '%',
					'size' => 100,
				),
				'condition' => array(
					'content_tag'                => 'image',
					'cst_image_hover'            => 'yes',
					'image_css_filter_hover_cst' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'image_css_filter_contrast',
			array(
				'label'     => esc_html__( 'Contrast', 'tpebl' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max'  => 200,
						'min'  => 0,
						'step' => 2,
					),
				),
				'default'   => array(
					'unit' => '%',
					'size' => 100,
				),
				'condition' => array(
					'content_tag'                => 'image',
					'cst_image_hover'            => 'yes',
					'image_css_filter_hover_cst' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'image_css_filter_saturation',
			array(
				'label'     => esc_html__( 'Saturation', 'tpebl' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max'  => 200,
						'min'  => 0,
						'step' => 2,
					),
				),
				'default'   => array(
					'unit' => '%',
					'size' => 100,
				),
				'condition' => array(
					'content_tag'                => 'image',
					'cst_image_hover'            => 'yes',
					'image_css_filter_hover_cst' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'image_css_filter_hue',
			array(
				'label'     => esc_html__( 'Hue', 'tpebl' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max'  => 360,
						'min'  => 0,
						'step' => 5,
					),
				),
				'default'   => array(
					'unit' => 'px',
					'size' => 0,
				),
				'condition' => array(
					'content_tag'                => 'image',
					'cst_image_hover'            => 'yes',
					'image_css_filter_hover_cst' => 'yes',
				),
			)
		);
		$repeater->end_popover();
		$repeater->end_controls_tab();
		$repeater->end_controls_tabs();

		$this->add_control(
			'how_it_works',
			array(
				'label' => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "create-custom-layout-with-hover-card-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> Learn How it works  <i class='eicon-help-o'></i> </a>" ),
				'type'  => Controls_Manager::HEADING,
			)
		);
		$this->add_control(
			'hover_card_content',
			array(
				'label'       => esc_html__( 'Content [ Start Tag -- End Tag ]', 'tpebl' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{content_tag}} [ {{open_tag }} -- {{close_tag}} ]',
			)
		);
		$this->end_controls_section();

		include L_THEPLUS_PATH . 'modules/widgets/theplus-needhelp.php';
		include L_THEPLUS_PATH . 'modules/widgets/theplus-profeatures.php';
	}

	/**
	 * Document Link For Need help.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 *
	 * @var post_id of the class.
	 */
	private $post_id;

	/**
	 * Render
	 *
	 * Written in PHP and HTML.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	protected function render() {
		$settings  = $this->get_settings_for_display();
		$hover_cnt = ! empty( $settings['hover_card_content'] ) ? $settings['hover_card_content'] : array();

		$loopitem = '';
		$loopcss  = '';

		$i = 1;

		$hover_card = '<div class="tp-hover-card-wrapper">';

		foreach ( $hover_cnt as $item ) {
			$opan_tag = ! empty( $item['open_tag'] ) ? $item['open_tag'] : '';
			$open_tag = '';

			if ( 'none' !== $opan_tag ) {
				$open_tag = l_theplus_validate_html_tag( $opan_tag );
				$this->add_render_attribute( 'loop_attr' . $i, 'class', 'elementor-repeater-item-' . esc_attr( $item['_id'] ) );
			}

			$class     = '';
			$tag_class = ! empty( $item['open_tag_class'] ) ? $item['open_tag_class'] : '';

			if ( ! empty( $tag_class ) ) {
				$this->add_render_attribute( 'loop_attr' . $i, 'class', $tag_class );
			}

			$con_tag   = ! empty( $item['content_tag'] ) ? $item['content_tag'] : '';
			$midia_con = ! empty( $item['media_content']['url'] ) ? $item['media_content']['url'] : '';

			if ( 'image' === $con_tag && ! empty( $midia_con ) ) {
				$this->add_render_attribute( 'loop_attr_img' . $i, 'class', 'elementor-repeater-item-' . esc_attr( $item['_id'] ) . '.loop-inner' );
			}

			$close_tag = '';
			$close_tab = ! empty( $item['close_tag'] ) ? $item['close_tag'] : '';

			if ( 'close' === $close_tab ) {
				$close_tag = l_theplus_validate_html_tag( $open_tag );
			} elseif ( 'close' !== $close_tab && 'none' !== $close_tab ) {
				$close_tag = l_theplus_validate_html_tag( $close_tab );
			}

			$a_link = ! empty( $item['a_link'] ) ? $item['a_link']['url'] : '';

			if ( 'a' === $opan_tag ) {

				if ( ! empty( $a_link['url'] ) ) {

					$this->add_render_attribute( 'loop_attr' . $i, 'href', esc_url( $a_link ) );

					if ( $a_link['is_external'] ) {
						$this->add_render_attribute( 'loop_attr' . $i, 'target', '_blank' );
					}

					if ( $a_link['nofollow'] ) {
						$this->add_render_attribute( 'loop_attr' . $i, 'rel', 'nofollow' );
					}
				}
			}

			if ( ! empty( $open_tag ) ) {
				$loopitem .= '<' . l_theplus_validate_html_tag( $open_tag ) . ' ' . $this->get_render_attribute_string( 'loop_attr' . $i ) . '>';
			}

			$text_cont = ! empty( $item['text_content'] ) ? $item['text_content'] : '';

			if ( 'none' !== $con_tag ) {
				if ( 'text' === $con_tag && ! empty( $text_cont ) ) {
					$loopitem .= $text_cont;
				}

				if ( 'image' === $con_tag && ! empty( $midia_con ) ) {
					$loopitem .= '<img ' . $this->get_render_attribute_string( 'loop_attr_img' . $i ) . ' src="' . esc_url( $midia_con ) . '" />';
				}

				$html_con = ! empty( $item['html_content'] ) ? $item['html_content'] : '';
				if ( 'html' === $con_tag && ! empty( $html_con ) ) {
					$loopitem .= $html_con;
				}

				$style_con = ! empty( $item['style_content'] ) ? $item['style_content'] : '';
				if ( 'style' === $con_tag && ! empty( $style_con ) ) {
					$loopitem .= '<style>' . $style_con . '</style>';
				}

				$script_con = ! empty( $item['script_content'] ) ? $item['script_content'] : '';
				
				if( tp_senitize_role( 'unfiltered_html' ) ){
					if ( 'script' === $con_tag && ! empty( $script_con ) ) {
						$loopitem .= wp_print_inline_script_tag( $script_con );
					}
				}
			}

			if ( 'none' !== $close_tab ) {
				$loopitem .= '</' . l_theplus_validate_html_tag( $close_tag ) . '>';
			}

			$position = ! empty( $item['position'] ) ? $item['position'] : '';

			if ( 'absolute' === $position ) {

				$tov = '';
				$bov = '';
				$lov = '';
				$rov = 'auto';

				$top_switch = ! empty( $item['top_offset_switch'] ) ? $item['top_offset_switch'] : '';
				$top_size   = ! empty( $item['top_offset']['size'] ) ? $item['top_offset']['size'] : '';
				$top_unit   = ! empty( $item['top_offset']['unit'] ) ? $item['top_offset']['unit'] : '';

				if ( ( 'yes' === $top_switch ) && ! empty( $top_size ) ) {
					$tov = $top_size . $top_unit;
				}

				$bottom_switch = ! empty( $item['bottom_offset_switch'] ) ? $item['bottom_offset_switch'] : '';
				$bottom_size   = ! empty( $item['bottom_offset']['size'] ) ? $item['bottom_offset']['size'] : '';
				$bottom_unit   = ! empty( $item['bottom_offset']['unit'] ) ? $item['bottom_offset']['unit'] : '';

				if ( ( 'yes' === $bottom_switch ) && ! empty( $bottom_size ) ) {
					$bov = $bottom_size . $bottom_unit;
				}

				$left_switch = ! empty( $item['left_offset_switch'] ) ? $item['left_offset_switch'] : '';
				$left_size   = ! empty( $item['left_offset']['size'] ) ? $item['left_offset']['size'] : '';
				$left_unit   = ! empty( $item['left_offset']['unit'] ) ? $item['left_offset']['unit'] : '';

				if ( 'yes' === $left_switch && ! empty( $left_size ) ) {
					$lov = $left_size . $left_unit;
				}

				$right_switch = ! empty( $item['right_offset_switch'] ) ? $item['right_offset_switch'] : '';
				$right_size   = ! empty( $item['right_offset']['size'] ) ? $item['right_offset']['size'] : '';
				$right_unit   = ! empty( $item['right_offset']['unit'] ) ? $item['right_offset']['unit'] : '';

				if ( 'yes' === $right_switch && ! empty( $right_size ) ) {
					$rov = $right_size . $right_unit;
				}

				$loopcss .= '.elementor-element' . $this->get_unique_selector() . '  .elementor-repeater-item-' . esc_attr( $item['_id'] ) . '{top: ' . $tov . ';bottom: ' . $bov . ';left: ' . $lov . ';right: ' . $rov . ';}';
			}

			$get_ele_pre     = '';
			$cst_hover       = ! empty( $item['cst_hover'] ) ? $item['cst_hover'] : '';
			$cst_text_hover  = ! empty( $item['cst_text_hover'] ) ? $item['cst_text_hover'] : '';
			$cst_image_hover = ! empty( $item['cst_image_hover'] ) ? $item['cst_image_hover'] : '';

			if ( 'yes' === $cst_hover || 'yes' === $cst_text_hover || ( ! empty( $item['cst_image_hover'] ) && 'yes' === $cst_image_hover ) ) {

				$hover_class = ! empty( $item['cst_hover_class'] ) ? $item['cst_hover_class'] : '';
				$get_ele_pre = '.elementor-element' . $this->get_unique_selector() . ' ' . $hover_class . ':hover .elementor-repeater-item-' . esc_attr( $item['_id'] );

				if ( ! empty( $hover_class ) ) {

					$b_color_option = ! empty( $item['b_color_option'] ) ? $item['b_color_option'] : '';

					if ( 'solid' === $b_color_option ) {
						if ( ! empty( $item['b_color_solid'] ) ) {
							$loopcss .= $get_ele_pre . '{background-color:' . $item['b_color_solid'] . ' !important;}';
						}
					} elseif ( 'gradient' === $b_color_option ) {

						if ( ! empty( $item['b_gradient_style'] ) && 'linear' === $item['b_gradient_style'] ) {
							if ( ! empty( $item['b_gradient_color1'] ) && ! empty( $item['b_gradient_color2'] ) ) {
								$loopcss .= $get_ele_pre . '{background-image: linear-gradient(' . $item['b_gradient_angle']['size'] . $item['b_gradient_angle']['unit'] . ', ' . $item['b_gradient_color1'] . ' ' . $item['b_gradient_color1_control']['size'] . $item['b_gradient_color1_control']['unit'] . ', ' . $item['b_gradient_color2'] . ' ' . $item['b_gradient_color2_control']['size'] . $item['b_gradient_color2_control']['unit'] . ') !important}';
							}
						} elseif ( ! empty( $item['b_gradient_style'] ) && 'radial' === $item['b_gradient_style'] ) {
							if ( ! empty( $item['b_gradient_color1'] ) && ! empty( $item['b_gradient_color2'] ) ) {
								$loopcss .= $get_ele_pre . '{background-image: radial-gradient(at ' . $item['b_gradient_position'] . ', ' . $item['b_gradient_color1'] . ' ' . $item['b_gradient_color1_control']['size'] . $item['b_gradient_color1_control']['unit'] . ', ' . $item['b_gradient_color2'] . ' ' . $item['b_gradient_color2_control']['size'] . $item['b_gradient_color2_control']['unit'] . ') !important}';
							}
						}
					} elseif ( 'image' === $b_color_option ) {

						$b_h_image = ! empty( $item['b_h_image']['url'] ) ? $item['b_h_image']['url'] : '';

						if ( ! empty( $b_h_image ) ) {
							$loopcss .= $get_ele_pre . '{background-image:url(' . $b_h_image . ') !important;background-position:' . $item['b_h_image_position'] . ' !important;background-attachment:' . $item['b_h_image_attach'] . ' !important;background-repeat:' . $item['b_h_image_repeat'] . ' !important;background-size:' . $item['b_h_image_size'] . ' !important;}';
						}
					}

					$h_border_style = ! empty( $item['b_h_border_style'] ) ? $item['b_h_border_style'] : '';

					if ( ! empty( $h_border_style ) ) {
						$loopcss .= $get_ele_pre . '{border-style:' . $h_border_style . ' !important;border-width: ' . $item['b_h_border_width']['top'] . $item['b_h_border_width']['unit'] . ' ' . $item['b_h_border_width']['right'] . $item['b_h_border_width']['unit'] . ' ' . $item['b_h_border_width']['bottom'] . $item['b_h_border_width']['unit'] . ' ' . $item['b_h_border_width']['left'] . $item['b_h_border_width']['unit'] . ' !important;border-color:' . $item['b_h_border_color'] . ' !important;}';
					}

					$h_radius = ! empty( $item['b_h_border_radius'] ) ? $item['b_h_border_radius'] : '';
					if ( ! empty( $h_radius ) ) {
						if ( ! empty( $item['b_h_border_radius']['top'] ) || ! empty( $item['b_h_border_radius']['right'] ) || ! empty( $item['b_h_border_radius']['bottom'] ) || ! empty( $item['b_h_border_radius']['left'] ) ) {
							$loopcss .= $get_ele_pre . '{border-radius: ' . $item['b_h_border_radius']['top'] . $item['b_h_border_radius']['unit'] . ' ' . $item['b_h_border_radius']['right'] . $item['b_h_border_radius']['unit'] . ' ' . $item['b_h_border_radius']['bottom'] . $item['b_h_border_radius']['unit'] . ' ' . $item['b_h_border_radius']['left'] . $item['b_h_border_radius']['unit'] . ' !important;}';
						}
					}

					$box_shadow_hov = ! empty( $item['box_shadow_hover_cst'] ) ? $item['box_shadow_hover_cst'] : '';
					if ( 'yes' === $box_shadow_hov ) {
						$loopcss .= $get_ele_pre . '{box-shadow: ' . $item['box_shadow_horizontal']['size'] . 'px ' . $item['box_shadow_vertical']['size'] . 'px ' . $item['box_shadow_blur']['size'] . 'px ' . $item['box_shadow_spread']['size'] . 'px ' . $item['box_shadow_color'] . ' !important;}';
					}

					$transi_hover_cst = ! empty( $item['transition_hover_cst'] ) ? $item['transition_hover_cst'] : '';

					if ( ! empty( $transi_hover_cst ) ) {
						$loopcss .= $get_ele_pre . '{ -webkit-transition: ' . $transi_hover_cst . ' !important;-moz-transition: ' . $transi_hover_cst . ' !important;-o-transition:' . $transi_hover_cst . ' !important;-ms-transition: ' . $transi_hover_cst . ' !important;}';
					}

					$transform_hover = ! empty( $item['transform_hover_cst'] ) ? $item['transform_hover_cst'] : '';
					if ( ! empty( $transform_hover ) ) {
						$loopcss .= $get_ele_pre . '{ transform: ' . $transform_hover . ' !important;-ms-transform: ' . $transform_hover . ' !important;-moz-transform:' . $transform_hover . ' !important;-webkit-transform: ' . $transform_hover . ' !important;}';
					}

					$css_filter   = ! empty( $item['css_filter_hover_cst'] ) ? $item['css_filter_hover_cst'] : '';
					$cfb          = ! empty( $item['css_filter_brightness']['size'] ) ? $item['css_filter_brightness']['size'] : 100;
					$cfc          = ! empty( $item['css_filter_contrast']['size'] ) ? $item['css_filter_contrast']['size'] : 100;
					$css_satura   = ! empty( $item['css_filter_saturation']['size'] ) ? $item['css_filter_saturation']['size'] : 100;
					$filter_blure = ! empty( $item['css_filter_blur']['size'] ) ? $item['css_filter_blur']['size'] : 0;
					$filter_hue   = ! empty( $item['css_filter_hue']['size'] ) ? $item['css_filter_hue']['size'] : 0;

					if ( 'yes' === $css_filter ) {
						$loopcss .= $get_ele_pre . '{filter:brightness( ' . $cfb . '% ) contrast( ' . $cfc . '% ) saturate( ' . $css_satura . '% ) blur( ' . $filter_blure . 'px ) hue-rotate( ' . $filter_hue . 'deg ) !important}';
					}

					$css_opicity = ! empty( $item['opacity_hover_cst']['size'] ) ? $item['opacity_hover_cst']['size'] : '';
					if ( ! empty( $css_opicity ) ) {
						$loopcss .= $get_ele_pre . '{ opacity: ' . $css_opicity . ' !important;}';
					}
				}
					$cst_text_chover = ! empty( $item['cst_text_hover_class'] ) ? $item['cst_text_hover_class'] : '';
				if ( ! empty( $cst_text_chover ) ) {
					$text_co_cst = ! empty( $item['text_color_h_cst'] ) ? $item['text_color_h_cst'] : '';

					if ( ! empty( $text_co_cst ) ) {
						$loopcss .= $get_ele_pre . '{ color: ' . $text_co_cst . ' !important;}';
					}

					$ts_color = ! empty( $item['ts_color'] ) ? $item['ts_color'] : '';

					if ( ! empty( $ts_color ) ) {
						$hor_size = ! empty( $item['ts_horizontal']['size'] ) ? $item['ts_horizontal']['size'] : 0;
						$ts_verti = ! empty( $item['ts_vertical']['size'] ) ? $item['ts_vertical']['size'] : 0;
						$ts_blur  = ! empty( $item['ts_blur']['size'] ) ? $item['ts_blur']['size'] : 10;

						$loopcss .= $get_ele_pre . '{ text-shadow : ' . $hor_size . 'px ' . $ts_verti . 'px ' . $ts_blur . 'px ' . $ts_color . ' !important;}';
					}
				}

				$cst_img_hc = ! empty( $item['cst_image_hover_class'] ) ? $item['cst_image_hover_class'] : '';

				if ( ! empty( $cst_img_hc ) ) {

					$img_hbs = ! empty( $item['image_h_border_style'] ) ? $item['image_h_border_style'] : '';

					if ( ! empty( $img_hbs ) ) {
						$loopcss .= $get_ele_pre . ' img{border-style:' . $img_hbs . ' !important;border-width: ' . $item['image_h_border_width']['top'] . $item['image_h_border_width']['unit'] . ' ' . $item['image_h_border_width']['right'] . $item['image_h_border_width']['unit'] . ' ' . $item['image_h_border_width']['bottom'] . $item['image_h_border_width']['unit'] . ' ' . $item['image_h_border_width']['left'] . $item['image_h_border_width']['unit'] . ' !important;border-color:' . $item['image_h_border_color'] . ' !important;}';
					}
					if ( ! empty( $item['image_h_border_radius'] ) ) {

						if ( ! empty( $item['image_h_border_radius']['top'] ) || ! empty( $item['image_h_border_radius']['right'] ) || ! empty( $item['image_h_border_radius']['bottom'] ) || ! empty( $item['image_h_border_radius']['left'] ) ) {
							$loopcss .= $get_ele_pre . ' img{border-radius: ' . $item['image_h_border_radius']['top'] . $item['image_h_border_radius']['unit'] . ' ' . $item['image_h_border_radius']['right'] . $item['image_h_border_radius']['unit'] . ' ' . $item['image_h_border_radius']['bottom'] . $item['image_h_border_radius']['unit'] . ' ' . $item['image_h_border_radius']['left'] . $item['image_h_border_radius']['unit'] . ' !important;}';
						}
					}

					$img_box_shc = ! empty( $item['image_box_shadow_hover_cst'] ) ? $item['image_box_shadow_hover_cst'] : '';
					if ( 'yes' === $img_box_shc ) {
						$loopcss .= $get_ele_pre . ' img{box-shadow: ' . $item['image_box_shadow_horizontal']['size'] . 'px ' . $item['image_box_shadow_vertical']['size'] . 'px ' . $item['image_box_shadow_blur']['size'] . 'px ' . $item['image_box_shadow_spread']['size'] . 'px ' . $item['image_box_shadow_color'] . ' !important;}';
					}

					$img_ohc = ! empty( $item['image_opacity_hover_cst']['size'] ) ? $item['image_opacity_hover_cst']['size'] : '';

					if ( ! empty( $img_ohc ) ) {
						$loopcss .= $get_ele_pre . ' img{ opacity: ' . $img_ohc . ' !important;}';
					}

					$img_cfhc = ! empty( $item['image_css_filter_hover_cst'] ) ? $item['image_css_filter_hover_cst'] : '';
					if ( 'yes' === $img_cfhc ) {
						$loopcss .= $get_ele_pre . ' img{filter:brightness( ' . $item['image_css_filter_brightness']['size'] . '% ) contrast( ' . $item['image_css_filter_contrast']['size'] . '% ) saturate( ' . $item['image_css_filter_saturation']['size'] . '% ) blur( ' . $item['image_css_filter_blur']['size'] . 'px ) hue-rotate( ' . $item['image_css_filter_hue']['size'] . 'deg ) !important}';
					}
				}
			}

			++$i;
		}

			$hover_card  .= $loopitem;
			$hover_card  .= '</div>';
				$loopcss .= '.tp-hover-card-wrapper{position:relative;display:block;width:100%;height:100%;}
				.tp-hover-card-wrapper * {transition:all 0.3s linear}';
		if ( ! empty( $loopcss ) ) {
			$hover_card .= '<style>' . $loopcss . '</style>';
		}

		echo $hover_card;
	}
}
