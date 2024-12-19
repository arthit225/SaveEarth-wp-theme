<?php
/**
 * Widget Name: TP Text Block
 * Description: Content of text text block.
 * Author: Theplus
 * Author URI: https://posimyth.com
 *
 * @package ThePlus
 */

namespace TheplusAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class L_ThePlus_Adv_Text_Block
 */
class L_ThePlus_Adv_Text_Block extends Widget_Base {

	/**
	 * Document Link For Need help.
	 *
	 * @since 5.3.3
	 *
	 * @var TpDoc of the class.
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
	 */
	public function get_name() {
		return 'tp-adv-text-block';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 1.0.0
	 */
	public function get_title() {
		return esc_html__( 'TP Text Block', 'tpebl' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'fa fa-file-text theplus_backend_icon';
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
		return array( 'Advance Text Block', 'Advanced Text Block', 'Text Block', 'Text Box', 'Enhanced Text Block', 'Improved Text Block', 'Customizable Text Block', 'Stylish Text Block', 'Unique Text Block', 'Elementor Text Block', 'Elementor Advanced Text Block', 'Elementor Enhanced Text Block', 'Elementor Customizable Text Block', 'Elementor Stylish Text Block, Elementor Unique Text Block', 'Elementor Addon Text Block', 'Text Editor', 'Rich Text Editor', 'Elementor Text Editor', 'Elementor Rich Text Editor' );
	}

	/**
	 * Get Widget Custom Help Url.
	 *
	 * @since 1.0.0
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
				'label' => esc_html__( 'Content', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'content_description',
			array(
				'label'       => wp_kses_post( "Description <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "advanced-text-block-elementor?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => esc_html__( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'tpebl' ),
				'placeholder' => esc_html__( 'Type your description here', 'tpebl' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);
		$this->add_responsive_control(
			'content_align',
			array(
				'label'        => esc_html__( 'Alignment', 'tpebl' ),
				'type'         => Controls_Manager::CHOOSE,
				'options'      => array(
					'left'    => array(
						'title' => esc_html__( 'Left', 'tpebl' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center'  => array(
						'title' => esc_html__( 'Center', 'tpebl' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'   => array(
						'title' => esc_html__( 'Right', 'tpebl' ),
						'icon'  => 'eicon-text-align-right',
					),
					'justify' => array(
						'title' => esc_html__( 'Justify', 'tpebl' ),
						'icon'  => 'eicon-text-align-justify',
					),
				),
				'devices'      => array( 'desktop', 'tablet', 'mobile' ),
				'prefix_class' => 'text-%s',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'extra_section',
			array(
				'label' => esc_html__( 'Extra', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'display_count',
			array(
				'label'     => wp_kses_post( "Description Limit <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "limit-wordcount-text-widget-elementor?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'display_count_by',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Limit on', 'tpebl' ),
				'default'   => 'char',
				'options'   => array(
					'char' => esc_html__( 'Character', 'tpebl' ),
					'word' => esc_html__( 'Word', 'tpebl' ),
				),
				'condition' => array(
					'display_count' => 'yes',
				),
			)
		);
		$this->add_control(
			'display_count_input',
			array(
				'label'     => esc_html__( 'Count', 'tpebl' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 1000,
				'step'      => 1,
				'condition' => array(
					'display_count' => 'yes',
				),
			)
		);
		$this->add_control(
			'display_3_dots',
			array(
				'label'     => esc_html__( 'Display Dots', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'default'   => 'yes',
				'condition' => array(
					'display_count' => 'yes',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_styling',
			array(
				'label' => esc_html__( 'Typography', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'content_color',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#888',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_adv_text_block .text-content-block p,{{WRAPPER}} .pt_plus_adv_text_block .text-content-block' => 'color:{{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'content_typography',
				'label'    => esc_html__( 'Typography', 'tpebl' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				),
				'selector' => '{{WRAPPER}} .pt_plus_adv_text_block .text-content-block,{{WRAPPER}} .pt_plus_adv_text_block .text-content-block p',
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
	 * Limit Words.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 * @param string $text The input string to limit words in.
	 * @param int    $limit The maximum number of words to allow in the string.
	 */
	protected function l_limit_words( $text, $limit ) {
		$words = explode( ' ', $text );

		return implode( ' ', array_splice( $words, 0, $limit ) );
	}

	/**
	 * Render Progress Bar Written in PHP and HTML.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	protected function render() {
		$settings     = $this->get_settings_for_display();
		$limit_on     = ! empty( $settings['display_count_by'] ) ? $settings['display_count_by'] : 'char';
		$dis_count    = ! empty( $settings['display_count'] ) ? $settings['display_count'] : '';
		$content_desc = ! empty( $settings['content_description'] ) ? ( $settings['content_description'] ) : '';

		$dots  = ! empty( $settings['display_3_dots'] ) ? $settings['display_3_dots'] : '';
		$count = ! empty( $settings['display_count_input'] ) ? $settings['display_count_input'] : '';

		$ani_effects  = ! empty( $settings['animation_effects'] ) ? $settings['animation_effects'] : 'no-animation';
		$ani_delay    = ! empty( $settings['animation_delay']['size'] ) ? $settings['animation_delay']['size'] : 50;
		$ani_duration = ! empty( $settings['animation_duration_default'] ) ? $settings['animation_duration_default'] : '';

		$due_speed   = ! empty( $settings['animate_duration']['size'] ) ? $settings['animate_duration']['size'] : 50;
		$out_effects = ! empty( $settings['animation_out_effects'] ) ? $settings['animation_out_effects'] : 'no-animation';
		$ani_o_delay = ! empty( $settings['animation_out_delay']['size'] ) ? $settings['animation_out_delay']['size'] : 50;

		$ani_o_duration = ! empty( $settings['animation_out_duration_default'] ) ? $settings['animation_out_duration_default'] : '';
		$o_due_speed    = ! empty( $settings['animation_out_duration']['size'] ) ? $settings['animation_out_duration']['size'] : 50;

		if ( 'yes' === $dis_count && ! empty( $count ) ) {

			if ( 'char' === $limit_on ) {
				$description = substr( $content_desc, 0, $count );

				if ( strlen( $content_desc ) > $count && 'yes' === $dots ) {
					$description .= '...';
				}
			} elseif ( 'word' === $limit_on ) {
				$description = $this->l_limit_words( $content_desc, $count );

				if ( str_word_count( $content_desc ) > $count && 'yes' === $dots ) {
					$description .= '...';
				}
			}
		} else {
			$description = $content_desc;
		}

		if ( 'no-animation' === $ani_effects ) {
			$animated_class = '';
			$animation_attr = '';
		} else {
			$animate_offset  = '85%';
			$animated_class  = 'animate-general';
			$animation_attr  = ' data-animate-type="' . esc_attr( $ani_effects ) . '" data-animate-delay="' . esc_attr( $ani_delay ) . '"';
			$animation_attr .= ' data-animate-offset="' . esc_attr( $animate_offset ) . '"';

			if ( 'yes' === $ani_duration ) {
				$animate_duration = $due_speed;
				$animation_attr  .= ' data-animate-duration="' . esc_attr( $animate_duration ) . '"';
			}

			if ( 'no-animation' !== $out_effects ) {
				$animation_attr .= ' data-animate-out-type="' . esc_attr( $out_effects ) . '" data-animate-out-delay="' . esc_attr( $ani_o_delay ) . '"';
				if ( 'yes' === $ani_o_duration ) {
					$animation_attr .= ' data-animate-out-duration="' . esc_attr( $o_due_speed ) . '"';
				}
			}
		}

		$text_block = '<div class="pt-plus-text-block-wrapper" >';

			$text_block .= '<div class="text_block_parallax">';

				$text_block .= '<div class="pt_plus_adv_text_block ' . esc_attr( $animated_class ) . '" ' . $animation_attr . '>';

					$text_block .= '<div class="text-content-block">' . wp_kses_post( $description ) . '</div>';

				$text_block .= '</div>';

			$text_block .= '</div>';

		$text_block .= '</div>';

		echo $text_block;

	}
}