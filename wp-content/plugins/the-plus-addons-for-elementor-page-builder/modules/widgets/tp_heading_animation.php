<?php
/**
 * Widget Name: Heading Animattion
 * Description: Text Animation of style.
 * Author: Theplus
 * Author URI: https://posimyth.com
 *
 * @package ThePlus
 */

namespace TheplusAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class L_ThePlus_Heading_Animation
 */
class L_ThePlus_Heading_Animation extends Widget_Base {

	/**
	 * Get Widget Name.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_name() {
		return 'tp-heading-animation';
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
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Heading Animation', 'tpebl' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-i-cursor theplus_backend_icon';
	}

	/**
	 * Get Widget categories.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_categories() {
		return array( 'plus-creatives' );
	}

	/**
	 * Get Widget keywords.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_keywords() {
		return array( 'Animated Text', 'Text Animation', 'Animated Typography', 'Animated Heading', 'Animated Title', 'Animated Words' );
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
	 * @version 5.4.2
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Text Animation', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'anim_styles',
			array(
				'label'   => esc_html__( 'Animation Style', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => array(
					'style-1' => esc_html__( 'Style 1', 'tpebl' ),
					'style-2' => esc_html__( 'Style 2', 'tpebl' ),
					'style-3' => esc_html__( 'Style 3', 'tpebl' ),
					'style-4' => esc_html__( 'Style 4', 'tpebl' ),
					'style-5' => esc_html__( 'Style 5', 'tpebl' ),
					'style-6' => esc_html__( 'Style 6', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'prefix',
			array(
				'type'        => Controls_Manager::TEXT,
				'label'       => esc_html__( 'Prefix Text', 'tpebl' ),
				'label_block' => true,
				'separator'   => 'before',
				'default'     => esc_html__( 'This is ', 'tpebl' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);
		$this->add_control(
			'prefix_note',
			array(
				'type'        => Controls_Manager::RAW_HTML,
				'raw'         => '<p class="tp-controller-notice"><i>Enter Text, Which will be visible before the Animated Text.</i></p>',
				'label_block' => true,
			)
		);
		$this->add_control(
			'ani_title',
			array(
				'label'       => esc_html__( 'Animated Text', 'tpebl' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 5,
				'default'     => esc_html__( 'Heading', 'tpebl' ),
				'placeholder' => esc_html__( 'Type your description here', 'tpebl' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);
		$this->add_control(
			'title_note',
			array(
				'type'        => Controls_Manager::RAW_HTML,
				'raw'         => '<p class="tp-controller-notice"><i>You need to add Multiple line by ctrl + Enter Or Shift + Enter for animated text.</i></p>',
				'label_block' => true,
			)
		);
		$this->add_control(
			'ani_title_tag',
			array(
				'type'    => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Animated Text Tag', 'tpebl' ),
				'default' => 'h1',
				'options' => l_theplus_get_tags_options(),
			)
		);
		$this->add_control(
			'postfix',
			array(
				'type'        => Controls_Manager::TEXT,
				'label'       => esc_html__( 'Postfix Text', 'tpebl' ),
				'label_block' => true,
				'separator'   => 'before',
				'default'     => esc_html__( 'Animation', 'tpebl' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);
		$this->add_control(
			'postfix_note',
			array(
				'type'        => Controls_Manager::RAW_HTML,
				'raw'         => '<p class="tp-controller-notice"><i>Enter Text, Which will be visible After the Animated Text.</i></p>',
				'label_block' => true,
			)
		);
		$this->add_responsive_control(
			'heading_text_align',
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
					'{{WRAPPER}} .pt-plus-heading-animation .pt-plus-cd-headline,{{WRAPPER}} .pt-plus-heading-animation .pt-plus-cd-headline span' => 'text-align: {{VALUE}};',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_prefix_postfix_styling',
			array(
				'label' => esc_html__( 'Prefix and Postfix', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'heading_anim_color',
			array(
				'label'     => esc_html__( 'Font Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .pt-plus-heading-animation .pt-plus-cd-headline,{{WRAPPER}} .pt-plus-heading-animation .pt-plus-cd-headline span' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'prefix_postfix_typography',
				'selector' => '{{WRAPPER}} .pt-plus-heading-animation .pt-plus-cd-headline,{{WRAPPER}} .pt-plus-heading-animation .pt-plus-cd-headline span',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_heading_animation_styling',
			array(
				'label' => esc_html__( 'Animated Text', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'ani_color',
			array(
				'label'     => esc_html__( 'Font Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .pt-plus-heading-animation .pt-plus-cd-headline b' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'ani_typography',
				'selector' => '{{WRAPPER}} .pt-plus-heading-animation .pt-plus-cd-headline b',
			)
		);
		$this->add_control(
			'ani_bg_color',
			array(
				'label'     => esc_html__( 'Animation Background Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#d3d3d3',
				'condition' => array(
					'anim_styles!' => array( 'style-6' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .pt-plus-heading-animation:not(.head-anim-style-6) .pt-plus-cd-headline b' => 'background: {{VALUE}};',
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
	}

	/**
	 * Render
	 *
	 * Written in PHP and HTML.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	protected function render() {

		$settings    = $this->get_settings_for_display();
		$anim_styles = ! empty( $settings['anim_styles'] ) ? $settings['anim_styles'] : 'style-1';
		$prefix      = ! empty( $settings['prefix'] ) ? $settings['prefix'] : '';
		$postfix     = ! empty( $settings['postfix'] ) ? $settings['postfix'] : '';
		$ani_title   = ! empty( $settings['ani_title'] ) ? $settings['ani_title'] : '';
		$title_tag   = ! empty( $settings['ani_title_tag'] ) ? $settings['ani_title_tag'] : 'h1';

		$animation_effects = ! empty( $settings['animation_effects'] ) ? $settings['animation_effects'] : '';
		$animate_duration  = ! empty( $settings['animate_duration']['size'] ) ? $settings['animate_duration']['size'] : 50;
		$animation_delay   = ! empty( $settings['animation_delay']['size'] ) ? $settings['animation_delay']['size'] : 50;

		$ani_duration = ! empty( $settings['animation_duration_default'] ) ? $settings['animation_duration_default'] : '';
		$out_ani      = ! empty( $settings['animation_out_effects'] ) ? $settings['animation_out_effects'] : '';
		$out_delay    = ! empty( $settings['animation_out_delay']['size'] ) ? $settings['animation_out_delay']['size'] : 50;
		$out_duration = ! empty( $settings['animation_out_duration_default'] ) ? $settings['animation_out_duration_default'] : '';
		$out_speed    = ! empty( $settings['animation_out_duration']['size'] ) ? $settings['animation_out_duration']['size'] : 50;
		$ani_bg       = ! empty( $settings['ani_bg_color'] ) ? $settings['ani_bg_color'] : '';
		$font_color   = ! empty( $settings['ani_color'] ) ? $settings['ani_color'] : '';

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

			if ( 'no-animation' !== $out_ani ) {
				$animation_attr .= ' data-animate-out-type="' . esc_attr( $out_ani ) . '" data-animate-out-delay="' . esc_attr( $out_delay ) . '"';
				if ( 'yes' === $out_duration ) {
					$animation_attr .= ' data-animate-out-duration="' . esc_attr( $out_speed ) . '"';
				}
			}
		}

			$heading_animation_back = 'style="';

		if ( ! empty( $ani_bg ) ) {
			$heading_animation_back .= 'background: ' . esc_attr( $ani_bg ) . ';';
		}
		$heading_animation_back .= '"';

		$order   = array( "\r\n", "\n", "\r", '<br/>', '<br>' );
		$replace = '|';

		$str = str_replace( $order, $replace, $ani_title );

		$lines = explode( '|', $str );

		$count_lines = count( $lines );

		$background_css = '';
		if ( ! empty( $font_color ) ) {
			$background_css .= 'background-color: ' . esc_attr( $font_color ) . ';';
		}

		$uid = uniqid( 'heading-animation' );

		$heading_animation = '<div class="pt-plus-heading-animation heading-animation head-anim-' . esc_attr( $anim_styles ) . ' ' . esc_attr( $animated_class ) . ' ' . esc_attr( $uid ) . '"  ' . $animation_attr . '>';

		if ( 'style-1' === $anim_styles ) {
			$heading_animation .= '<' . l_theplus_validate_html_tag( $title_tag ) . ' class="pt-plus-cd-headline letters type" >';
			if ( ! empty( $prefix ) ) {
				$heading_animation .= '<span >' . $prefix . ' </span>';
			}

			if ( ! empty( $ani_title ) ) {
				$heading_animation .= '<span class="cd-words-wrapper waiting" ' . $heading_animation_back . '>';

				$i = 0;
				foreach ( $lines as $line ) {
					if ( 0 === $i ) {

						$heading_animation .= '<b  class="is-visible"> ' . wp_strip_all_tags( $line ) . '</b>';

					} else {
						$heading_animation .= '<b> ' . wp_strip_all_tags( $line ) . '</b>';
					}
					++$i;
				}

				$strings = '[';
				foreach ( $lines as $key => $line ) {
					$strings .= trim( htmlspecialchars_decode( wp_strip_all_tags( $line ) ) );
					if ( ( $count_lines - 1 ) !== $key ) {
						$strings .= ',';
					}
				}
				$strings           .= ']';
				$heading_animation .= '</span>';
			}

			if ( ! empty( $postfix ) ) {
				$heading_animation .= '<span > ' . esc_html( $postfix ) . ' </span>';
			}

			$heading_animation .= '</' . l_theplus_validate_html_tag( $title_tag ) . '>';
		}
		if ( 'style-2' === $anim_styles ) {
			$heading_animation .= '<' . l_theplus_validate_html_tag( $title_tag ) . ' class="pt-plus-cd-headline rotate-1" >';
			if ( ! empty( $prefix ) ) {
				$heading_animation .= '<span >' . esc_html( $prefix ) . ' </span>';
			}

			if ( ! empty( $ani_title ) ) {
				$heading_animation .= '<span class="cd-words-wrapper">';

				$i = 0;
				foreach ( $lines as $line ) {
					if ( 0 === $i ) {

						$heading_animation .= '<b  class="is-visible"> ' . wp_strip_all_tags( $line ) . '</b>';

					} else {
						$heading_animation .= '<b> ' . wp_strip_all_tags( $line ) . '</b>';
					}
					++$i;
				}
				$strings = '[';
				foreach ( $lines as $key => $line ) {
					$strings .= trim( htmlspecialchars_decode( wp_strip_all_tags( $line ) ) );
					if ( ( $count_lines - 1 ) !== $key ) {
						$strings .= ',';
					}
				}
				$strings           .= ']';
				$heading_animation .= '</span>';
			}

			if ( ! empty( $postfix ) ) {
				$heading_animation .= '<span > ' . esc_html( $postfix ) . ' </span>';
			}

			$heading_animation .= '</' . l_theplus_validate_html_tag( $title_tag ) . '>';
		}
		if ( 'style-3' === $anim_styles ) {
			$heading_animation .= '<' . l_theplus_validate_html_tag( $title_tag ) . ' class="pt-plus-cd-headline zoom" >';
			if ( ! empty( $prefix ) ) {
				$heading_animation .= '<span >' . esc_html( $prefix ) . ' </span>';
			}

			if ( ! empty( $ani_title ) ) {
				$heading_animation .= '<span class="cd-words-wrapper">';

				$i = 0;
				foreach ( $lines as $line ) {
					if ( 0 === $i ) {

						$heading_animation .= ' <b  class="is-visible ">' . wp_strip_all_tags( $line ) . '</b>';

					} else {
						$heading_animation .= ' <b>' . wp_strip_all_tags( $line ) . '</b>';
					}
					++$i;
				}

				$strings = '[';
				foreach ( $lines as $key => $line ) {
					$strings .= trim( htmlspecialchars_decode( wp_strip_all_tags( $line ) ) );
					if ( ( $count_lines - 1 ) !== $key ) {
						$strings .= ',';
					}
				}
				$strings           .= ']';
				$heading_animation .= '</span>';
			}

			if ( ! empty( $postfix ) ) {
				$heading_animation .= '<span > ' . esc_html( $postfix ) . ' </span>';
			}

			$heading_animation .= '</' . l_theplus_validate_html_tag( $title_tag ) . '>';
		}
		if ( 'style-4' === $anim_styles ) {
			$heading_animation .= '<' . l_theplus_validate_html_tag( $title_tag ) . ' class="pt-plus-cd-headline loading-bar " >';
			if ( ! empty( $prefix ) ) {
				$heading_animation .= '<span >' . esc_html( $prefix ) . ' </span>';
			}
			if ( ! empty( $ani_title ) ) {
				$heading_animation .= '<span class="cd-words-wrapper">';

				$i = 0;
				foreach ( $lines as $line ) {
					if ( 0 === $i ) {

						$heading_animation .= ' <b class="is-visible ">' . wp_strip_all_tags( $line ) . '</b>';

					} else {
						$heading_animation .= ' <b>' . wp_strip_all_tags( $line ) . '</b>';
					}
					++$i;
				}

				$strings = '[';
				foreach ( $lines as $key => $line ) {
					$strings .= trim( htmlspecialchars_decode( wp_strip_all_tags( $line ) ) );
					if ( ( $count_lines - 1 ) !== $key ) {
						$strings .= ',';
					}
				}
				$strings           .= ']';
				$heading_animation .= '</span>';
			}

			if ( ! empty( $postfix ) ) {
				$heading_animation .= '<span > ' . esc_html( $postfix ) . '</span>';
			}

			$heading_animation .= '</' . l_theplus_validate_html_tag( $title_tag ) . '>';
		}
		if ( 'style-5' === $anim_styles ) {
			$heading_animation .= '<' . l_theplus_validate_html_tag( $title_tag ) . ' class="pt-plus-cd-headline push" >';
			if ( ! empty( $prefix ) ) {
				$heading_animation .= '<span >' . esc_html( $prefix ) . ' </span>';
			}

			if ( ! empty( $ani_title ) ) {
				$heading_animation .= '<span class="cd-words-wrapper">';

				$i = 0;
				foreach ( $lines as $line ) {
					if ( 0 === $i ) {

						$heading_animation .= '<b  class="is-visible "> ' . wp_strip_all_tags( $line ) . '</b>';

					} else {
						$heading_animation .= '<b> ' . wp_strip_all_tags( $line ) . '</b>';
					}
					++$i;
				}

				$strings = '[';
				foreach ( $lines as $key => $line ) {
					$strings .= trim( htmlspecialchars_decode( wp_strip_all_tags( $line ) ) );
					if ( ( $count_lines - 1 ) !== $key ) {
						$strings .= ',';
					}
				}
				$strings           .= ']';
				$heading_animation .= '</span>';
			}

			if ( ! empty( $postfix ) ) {
				$heading_animation .= '<span > ' . esc_html( $postfix ) . ' </span>';
			}

			$heading_animation .= '</' . l_theplus_validate_html_tag( $title_tag ) . '>';
		}
		if ( 'style-6' === $anim_styles ) {
			$heading_animation .= '<' . l_theplus_validate_html_tag( $title_tag ) . ' class="pt-plus-cd-headline letters scale" >';
			if ( ! empty( $prefix ) ) {
				$heading_animation .= '<span >' . esc_html( $prefix ) . ' </span>';
			}
			if ( ! empty( $ani_title ) ) {
				$heading_animation .= '<span class="cd-words-wrapper style-6"   >';

				$i = 0;
				foreach ( $lines as $line ) {
					if ( 0 === $i ) {
						$heading_animation .= '<b  class="is-visible ">' . wp_strip_all_tags( $line ) . '</b>';

					} else {
						$heading_animation .= '<b>' . wp_strip_all_tags( $line ) . '</b>';
					}
					++$i;
				}

				$strings = '[';
				foreach ( $lines as $key => $line ) {
					$strings .= trim( htmlspecialchars_decode( wp_strip_all_tags( $line ) ) );
					if ( ( $count_lines - 1 ) !== $key ) {
						$strings .= ',';
					}
				}
				$strings           .= ']';
				$heading_animation .= '</span>';
			}

			if ( ! empty( $postfix ) ) {
				$heading_animation .= '<span > ' . esc_html( $postfix ) . ' </span>';
			}

			$heading_animation .= '</' . l_theplus_validate_html_tag( $title_tag ) . '>';
		}
		$heading_animation .= '</div>';

		$css_rule      = '';
		$css_rule     .= '<style>';
			$css_rule .= '.' . esc_js( $uid ) . ' .pt-plus-cd-headline.loading-bar .cd-words-wrapper::after{' . esc_js( $background_css ) . '}';
		$css_rule     .= '</style>';
		echo $css_rule . $heading_animation;
	}
}
