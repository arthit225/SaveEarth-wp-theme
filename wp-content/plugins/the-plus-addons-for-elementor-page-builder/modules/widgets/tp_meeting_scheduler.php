<?php
/**
 * Widget Name: Meeting Scheduler
 * Description: Meeting Scheduler.
 * Author: Theplus
 * Author URI: https://posimyth.com
 *
 * @package ThePlus
 */

namespace TheplusAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class L_ThePlus_Meeting_Scheduler
 */
class L_ThePlus_Meeting_Scheduler extends Widget_Base {

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
		return 'tp-meeting-scheduler';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Meeting Scheduler', 'tpebl' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-calendar theplus_backend_icon';
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
		return array( 'Meeting Scheduler', 'Schedule Meeting', 'Meeting Planner', 'Meeting Organizer', 'Meeting Arranger', 'Meeting Time Manager', 'Meeting Coordinator', 'Meeting Scheduling Tool', 'Meeting Booking', 'Meeting Calendar' );
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
				'label' => esc_html__( 'Meeting Scheduler', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'scheduler_select',
			array(
				'label'   => wp_kses_post( "Select <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "meeting-scheduler-widget-settings-overview?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'calendly',
				'options' => array(
					'calendly'    => esc_html__( 'Calendly', 'tpebl' ),
					'freebusy'    => esc_html__( 'Freebusy', 'tpebl' ),
					'meetingbird' => esc_html__( 'Meetingbird', 'tpebl' ),
					'vyte'        => esc_html__( 'Vyte', 'tpebl' ),
					'xai'         => esc_html__( 'X Ai', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'calendly_username',
			array(
				'label'       => wp_kses_post( "User Name <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "embed-calendly-meeting-elementor?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'Enter User Name', 'tpebl' ),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'scheduler_select' => 'calendly',
				),
			)
		);
		$this->add_control(
			'calendly_note',
			array(
				'type'        => Controls_Manager::RAW_HTML,
				'raw'         => '<p class="tp-controller-notice"><i>How to get Username from Calendly?  <a href="https://help.calendly.com/hc/en-us" class="theplus-btn" target="_blank">Get Steps!</a></i></p>',
				'label_block' => true,
				'condition'   => array(
					'scheduler_select' => 'calendly',
				),
			)
		);
		$this->add_control(
			'calendly_time',
			array(
				'label'     => esc_html__( 'Time', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '15min',
				'options'   => array(
					'15min' => esc_html__( '15 Minutes', 'tpebl' ),
					'30min' => esc_html__( '30 Minutes', 'tpebl' ),
					'60min' => esc_html__( '60 Minutes', 'tpebl' ),
					''      => esc_html__( 'All', 'tpebl' ),
				),
				'condition' => array(
					'scheduler_select' => 'calendly',
				),
			)
		);
		$this->add_control(
			'calendly_event',
			array(
				'label'     => esc_html__( 'Display Event Type', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'default'   => 'yes',
				'condition' => array(
					'scheduler_select' => 'calendly',
					'calendly_time!'   => '',
				),
			)
		);
		$this->add_control(
			'calendly_height',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Height', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 10,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 650,
				),
				'render_type' => 'ui',
				'condition'   => array(
					'scheduler_select' => 'calendly',
				),
				'selectors'   => array(
					'{{WRAPPER}} .calendly-inline-widget,{{WRAPPER}} .calendly-wrapper' => 'height:{{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_control(
			'freebusy_url',
			array(
				'label'       => wp_kses_post( "URL <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "embed-freebusy-elementor?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'Enter URL', 'tpebl' ),
				'dynamic'     => array( 'active' => true ),
				'condition'   => array(
					'scheduler_select' => 'freebusy',
				),
			)
		);
		$this->add_control(
			'freebusy_note',
			array(
				'type'        => Controls_Manager::RAW_HTML,
				'raw'         => '<p class="tp-controller-notice"><i>How to get Freebusy URL?  <a href="https://help.freebusy.io/en/articles/3313368-how-to-share-your-availability-by-generating-a-link-though-your-freebusy-account" class="theplus-btn" target="_blank">Get Steps!</a></i></p>',
				'label_block' => true,
				'condition'   => array(
					'scheduler_select' => 'freebusy',
				),
			)
		);
		$this->add_control(
			'freebusy_width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Width', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 10,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 600,
				),
				'render_type' => 'ui',
				'condition'   => array(
					'scheduler_select' => 'freebusy',
				),
			)
		);
		$this->add_control(
			'freebusy_height',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Height', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 10,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 600,
				),
				'render_type' => 'ui',
				'condition'   => array(
					'scheduler_select' => 'freebusy',
				),
			)
		);
		$this->add_control(
			'freebusy_scroll',
			array(
				'label'     => esc_html__( 'Scroll Bar', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'default'   => 'no',
				'condition' => array(
					'scheduler_select' => 'freebusy',
				),
			)
		);
		$this->add_control(
			'meetingbird_url',
			array(
				'label'       => esc_html__( 'URL', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'Enter URL', 'tpebl' ),
				'dynamic'     => array( 'active' => true ),
				'condition'   => array(
					'scheduler_select' => 'meetingbird',
				),
			)
		);
		$this->add_control(
			'meetingbird_note',
			array(
				'type'        => Controls_Manager::RAW_HTML,
				'raw'         => '<p class="tp-controller-notice"><i>How to get Meeting Bird URL?  <a href="https://help.meetingbird.com/en/collections/168865-getting-started" class="theplus-btn" target="_blank">Get Steps!</a></i></p>',
				'label_block' => true,
				'condition'   => array(
					'scheduler_select' => 'meetingbird',
				),
			)
		);
		$this->add_control(
			'meetingbird_height',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Min. Height', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 10,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 600,
				),
				'render_type' => 'ui',
				'condition'   => array(
					'scheduler_select' => 'meetingbird',
				),
			)
		);
		$this->add_control(
			'vyte_url',
			array(
				'label'       => wp_kses_post( "URL <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "embed-vyte-elementor?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'Enter URL', 'tpebl' ),
				'dynamic'     => array( 'active' => true ),
				'condition'   => array(
					'scheduler_select' => 'vyte',
				),
			)
		);
		$this->add_control(
			'vyte_note',
			array(
				'type'        => Controls_Manager::RAW_HTML,
				'raw'         => '<p class="tp-controller-notice"><i>If you need help getting details. <a href="https://support.vyte.in/en/" class="theplus-btn" target="_blank">Helpdesk!</a></a></i></p>',
				'label_block' => true,
				'condition'   => array(
					'scheduler_select' => 'vyte',
				),
			)
		);
		$this->add_control(
			'vyte_width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Width', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 10,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 600,
				),
				'render_type' => 'ui',
				'condition'   => array(
					'scheduler_select' => 'vyte',
				),
			)
		);
		$this->add_control(
			'vyte_height',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Height', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 10,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 600,
				),
				'render_type' => 'ui',
				'condition'   => array(
					'scheduler_select' => 'vyte',
				),
			)
		);
		$this->add_control(
			'xai_username',
			array(
				'label'       => esc_html__( 'User Name', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'Enter User Name', 'tpebl' ),
				'dynamic'     => array( 'active' => true ),
				'condition'   => array(
					'scheduler_select' => 'xai',
				),
			)
		);
		$this->add_control(
			'xai_note',
			array(
				'type'        => Controls_Manager::RAW_HTML,
				'raw'         => '<p class="tp-controller-notice"><i>If you need help getting details. <a href="https://help.x.ai/en/" class="theplus-btn" target="_blank">Helpdesk!</a></i></p>',
				'label_block' => true,
				'condition'   => array(
					'scheduler_select' => 'xai',
				),
			)
		);
		$this->add_control(
			'xai_pagename',
			array(
				'label'       => esc_html__( 'Page Name', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'Enter Page Name', 'tpebl' ),
				'dynamic'     => array( 'active' => true ),
				'condition'   => array(
					'scheduler_select' => 'xai',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'calendly_style',
			array(
				'label'     => esc_html__( 'Calendly Style', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'scheduler_select' => 'calendly',
				),
			)
		);
		$this->add_control(
			'calendly_text_color',
			array(
				'label' => esc_html__( 'Text', 'tpebl' ),
				'type'  => Controls_Manager::COLOR,
			)
		);
		$this->add_control(
			'calendly_primary_color',
			array(
				'label' => esc_html__( 'Link', 'tpebl' ),
				'type'  => Controls_Manager::COLOR,
			)
		);
		$this->add_control(
			'calendly_background_color',
			array(
				'label' => esc_html__( 'Background', 'tpebl' ),
				'type'  => Controls_Manager::COLOR,
			)
		);
		$this->end_controls_section();

		include L_THEPLUS_PATH . 'modules/widgets/theplus-needhelp.php';
		include L_THEPLUS_PATH . 'modules/widgets/theplus-profeatures.php';
	}

	/**
	 * Meeting Scheduler Render.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	protected function render() {
		$settings         = $this->get_settings_for_display();
		$scheduler_select = ! empty( $settings['scheduler_select'] ) ? $settings['scheduler_select'] : '';
		$calendly_uname   = ! empty( $settings['calendly_username'] ) ? $settings['calendly_username'] : '';
		$output           = '';
		$time_output      = '';
		$calendly_event   = '';
		$xai_output       = '';

		if ( 'calendly' === $scheduler_select ) {

			if ( ! empty( $calendly_uname ) ) {
				$time = ! empty( $settings['calendly_time'] ) ? $settings['calendly_time'] : '15min';
				if ( ! empty( $time ) ) {
					$time_output .= '';
				} else {
					$time_output .= '/' . $time . '/';
				}
				$calendly_text_color       = ! empty( $settings['calendly_text_color'] ) ? '&text_color=' . str_replace( '#', '', $settings['calendly_text_color'] ) : '';
				$calendly_primary_color    = ! empty( $settings['calendly_primary_color'] ) ? '&primary_color=' . str_replace( '#', '', $settings['calendly_primary_color'] ) : '';
				$calendly_background_color = ! empty( $settings['calendly_background_color'] ) ? '&background_color=' . str_replace( '#', '', $settings['calendly_background_color'] ) : '';
				$c_event                   = ! empty( $settings['calendly_event'] ) ? $settings['calendly_event'] : '';

				if ( 'yes' === $c_event ) {
					$calendly_event = '';
				} else {
					$calendly_event = 'hide_event_type_details=1';
				}
				$output .= '<div class="calendly-inline-widget" data-url="https://calendly.com/' . esc_attr( $calendly_uname ) . esc_attr( $time_output ) . '?' . esc_attr( $calendly_event ) . esc_attr( $calendly_text_color ) . esc_attr( $calendly_primary_color ) . esc_attr( $calendly_background_color ) . '">';
				$output .= '</div>';
				$output .= ' <script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js"></script>';
				if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
					$output .= '<div class="calendly-wrapper" style="width:100%; position:absolute; top:0; left:0; z-index:100;"></div>';
				}
			}
		} elseif ( 'freebusy' === $scheduler_select ) {
			$freebusy_scroll = ! empty( $settings['freebusy_scroll'] ) ? $settings['freebusy_scroll'] : 'no';
			$f_url           = ! empty( $settings['freebusy_url'] ) ? $settings['freebusy_url'] : '';
			$f_width         = ! empty( $settings['freebusy_width']['size'] ) ? $settings['freebusy_width']['size'] : 600;
			$f_height        = ! empty( $settings['freebusy_height']['size'] ) ? $settings['freebusy_height']['size'] : 600;

			if ( ! empty( $f_width ) ) {
				$output .= '<iframe src="' . esc_url( $f_url ) . '" width="' . esc_attr( $f_width ) . '" height="' . esc_attr( $f_height ) . '" frameborder="0" scrolling="' . esc_attr( $freebusy_scroll ) . '"></iframe>';
			}
		} elseif ( 'meetingbird' === $scheduler_select ) {
				$m_url    = ! empty( $settings['meetingbird_url'] ) ? $settings['meetingbird_url'] : '';
				$m_height = ! empty( $settings['meetingbird_height']['size'] ) ? $settings['meetingbird_height']['size'] : 600;

			if ( ! empty( $m_url ) ) {
				$output .= '<iframe src="' . esc_url( $m_url ) . '" style="width: 100%; border: none; min-height: ' . esc_attr( $m_height ) . 'px;"></iframe>';
			}
		} elseif ( 'vyte' === $scheduler_select ) {
			$v_url   = ! empty( $settings['vyte_url'] ) ? $settings['vyte_url'] : '';
			$v_width = ! empty( $settings['vyte_width']['size'] ) ? $settings['vyte_width']['size'] : 600;
			$v_hight = ! empty( $settings['vyte_height']['size'] ) ? $settings['vyte_height']['size'] : 600;

			if ( ! empty( $v_url ) ) {
				$output .= '<iframe src="' . esc_url( $v_url ) . '" width="' . esc_attr( $v_width ) . '" height="' . esc_attr( $v_hight ) . '" frameborder="0"></iframe>';
			}
		} elseif ( 'xai' === $scheduler_select ) {
			$xai_uname    = ! empty( $settings['xai_username'] ) ? $settings['xai_username'] : '';
			$xai_pagename = ! empty( $settings['xai_pagename'] ) ? $settings['xai_pagename'] : '';
			if ( ! empty( $xai_uname ) ) {
				if ( ! empty( $xai_pagename ) ) {
					$xai_output .= '/' . $xai_pagename;
				}
				$output .= '<script type="text/javascript" src="https://x.ai/embed/xdotai-embed.js" id="xdotaiEmbed" data-page="/' . esc_attr( $xai_uname ) . esc_attr( $xai_output ) . '" data-height data-width data-element async></script>';
			}
		}

		echo $output;
	}
}
