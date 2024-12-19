<?php
/**
 * Widget Name: Social Icon
 * Description: share social icon list design.
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

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class L_ThePlus_Social_Icon
 */
class L_ThePlus_Social_Icon extends Widget_Base {

	/**
	 * Get Widget Name.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_name() {
		return 'tp-social-icon';
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
		return esc_html__( 'Social Icon', 'tpebl' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-share-square-o theplus_backend_icon';
	}

	/**
	 * Get Widget categories.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_categories() {
		return array( 'plus-essential' );
	}

	/**
	 * Get KeyWords.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_keywords() {
		return array( 'social', 'icon', 'social icon' );
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
			'content_section',
			array(
				'label' => esc_html__( 'Content', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'styles',
			array(
				'label'   => esc_html__( 'Style', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => array(
					'style-1'  => esc_html__( 'Style 1', 'tpebl' ),
					'style-2'  => esc_html__( 'Style 2', 'tpebl' ),
					'style-3'  => esc_html__( 'Style 3', 'tpebl' ),
					'style-4'  => esc_html__( 'Style 4', 'tpebl' ),
					'style-5'  => esc_html__( 'Style 5', 'tpebl' ),
					'style-6'  => esc_html__( 'Style 6', 'tpebl' ),
					'style-7'  => esc_html__( 'Style 7', 'tpebl' ),
					'style-8'  => esc_html__( 'Style 8', 'tpebl' ),
					'style-9'  => esc_html__( 'Style 9', 'tpebl' ),
					'style-10' => esc_html__( 'Style 10', 'tpebl' ),
					'style-11' => esc_html__( 'Style 11', 'tpebl' ),
					'style-12' => esc_html__( 'Style 12', 'tpebl' ),
					'style-13' => esc_html__( 'Style 13', 'tpebl' ),
					'style-14' => esc_html__( 'Style 14', 'tpebl' ),
					'style-15' => esc_html__( 'Style 15', 'tpebl' ),
					'custom'   => esc_html__( 'Custom', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'hover_animation',
			array(
				'label'     => esc_html__( 'Select Hover Style', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'hover-1',
				'separator' => 'after',
				'options'   => array(
					'hover-1' => esc_html__( 'Style 1', 'tpebl' ),
					'hover-2' => esc_html__( 'Style 2', 'tpebl' ),
				),
				'condition' => array(
					'styles' => array( 'style-14', 'style-15' ),
				),
			)
		);
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'pt_plus_social_icons',
			array(
				'label'   => esc_html__( 'Social Network Select', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'image',
				'options' => array(
					'none'                    => esc_html__( 'None', 'tpebl' ),
					'fa-deviantart'           => esc_html__( 'Deviantart ', 'tpebl' ),
					'fa-digg'                 => esc_html__( 'Digg ', 'tpebl' ),
					'fa-dribbble'             => esc_html__( 'Dribbble ', 'tpebl' ),
					'fa-dropbox'              => esc_html__( 'Dropbox ', 'tpebl' ),
					'fa-facebook'             => esc_html__( 'Facebook ', 'tpebl' ),
					'fa-flickr'               => esc_html__( 'Flickr ', 'tpebl' ),
					'fa-foursquare'           => esc_html__( 'Foursquare ', 'tpebl' ),
					'fa-google-plus'          => esc_html__( 'Google + ', 'tpebl' ),
					'fa-instagram'            => esc_html__( 'Instagram ', 'tpebl' ),
					'fa-lastfm'               => esc_html__( 'LastFM ', 'tpebl' ),
					'fa-linkedin'             => esc_html__( 'LinkedIN ', 'tpebl' ),
					'fa-pinterest-p'          => esc_html__( 'Pinterest ', 'tpebl' ),
					'fa-rss'                  => esc_html__( 'RSS ', 'tpebl' ),
					'fa-tumblr'               => esc_html__( 'Tumblr ', 'tpebl' ),
					'fa-twitter'              => esc_html__( 'Twitter ', 'tpebl' ),
					'fa-vimeo'                => esc_html__( 'Vimeo ', 'tpebl' ),
					'fa-wordpress'            => esc_html__( 'Wordpress ', 'tpebl' ),
					'fa-youtube'              => esc_html__( 'YouTube', 'tpebl' ),
					'fa-envelope'             => esc_html__( 'Mail', 'tpebl' ),
					'fa-yelp'                 => esc_html__( 'Yelp', 'tpebl' ),
					'fa-xing'                 => esc_html__( 'Xing ', 'tpebl' ),
					'fa-spotify'              => esc_html__( 'Spotify ', 'tpebl' ),
					'fa-houzz'                => esc_html__( 'Houzz ', 'tpebl' ),
					'fa-skype'                => esc_html__( 'Skype ', 'tpebl' ),
					'fa-slideshare'           => esc_html__( 'Slideshare ', 'tpebl' ),
					'fa-bandcamp'             => esc_html__( 'Bandcamp ', 'tpebl' ),
					'fa-soundcloud'           => esc_html__( 'Soundcloud ', 'tpebl' ),
					'fa-snapchat-ghost'       => esc_html__( 'Snapchat ', 'tpebl' ),
					'fa-behance'              => esc_html__( 'Behance ', 'tpebl' ),
					'fa-windows'              => esc_html__( 'Windows', 'tpebl' ),
					'fa-video-camera'         => esc_html__( 'Video ', 'tpebl' ),
					'fa-tripadvisor'          => esc_html__( 'TripAdvisor ', 'tpebl' ),
					'fa-vk'                   => esc_html__( 'VK ', 'tpebl' ),
					'fa-odnoklassniki-square' => esc_html__( 'Odnoklassniki', 'tpebl' ),
					'fa-odnoklassniki'        => esc_html__( 'Odnoklassniki 1', 'tpebl' ),
					'fa-get-pocket'           => esc_html__( 'Get Pocket', 'tpebl' ),
					'fa-tiktok'               => esc_html__( 'Tiktok', 'tpebl' ),
					'custom'                  => esc_html__( 'Custom', 'tpebl' ),
				),
			)
		);
		$repeater->add_control(
			'pt_plus_social_icon_custom',
			array(
				'label'     => esc_html__( 'Icon', 'tpebl' ),
				'type'      => Controls_Manager::ICON,
				'default'   => 'fa fa-whatsapp',
				'condition' => array(
					'pt_plus_social_icons' => 'custom',
				),
			)
		);
		$repeater->add_control(
			'social_url',
			array(
				'label'       => esc_html__( 'Link', 'tpebl' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => array(
					'active' => true,
				),
				'placeholder' => esc_html__( 'https://www.demo-link.com', 'tpebl' ),
				'default'     => array(
					'url' => '#',
				),
			)
		);
		$repeater->add_control(
			'social_text',
			array(
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'label'       => esc_html__( 'Title', 'tpebl' ),
				'default'     => '',
				'dynamic'     => array( 'active' => true ),
			)
		);

		$repeater->add_control(
			'icon_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#d3d3d3',
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}:not(.style-12) a,{{WRAPPER}} {{CURRENT_ITEM}}.style-12 a .fa' => 'color: {{VALUE}};',
				),
			)
		);
		$repeater->add_control(
			'icon_hover_color',
			array(
				'label'     => esc_html__( 'Icon Hover Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}:not(.style-12):not(.style-4):hover a,{{WRAPPER}} {{CURRENT_ITEM}}.style-12 a span,{{WRAPPER}} {{CURRENT_ITEM}}.style-4 a i.fa,{{WRAPPER}} {{CURRENT_ITEM}}.style-5:hover a i.fa,{{WRAPPER}} {{CURRENT_ITEM}}.style-14 a span' => 'color: {{VALUE}};',
				),
			)
		);
		$repeater->add_control(
			'bg_color',
			array(
				'label'     => esc_html__( 'Background Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#404040',
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}:not(.style-3):not(.style-9):not(.style-11):not(.style-12) a,{{WRAPPER}} {{CURRENT_ITEM}}.style-12 a .fa' => 'background: {{VALUE}};',
					'{{WRAPPER}} {{CURRENT_ITEM}}.style-3' => 'background: {{VALUE}};background-clip: content-box;',
					'{{WRAPPER}} {{CURRENT_ITEM}}.style-9:hover a span:before' => 'background: {{VALUE}};',
					'{{WRAPPER}} {{CURRENT_ITEM}}.style-11 a:before' => '-webkit-box-shadow: inset 0 0 0 70px {{VALUE}};-moz-box-shadow: inset 0 0 0 70px {{VALUE}};box-shadow: inset 0 0 0 70px {{VALUE}};',
				),
			)
		);
		$repeater->add_control(
			'bg_hover_color',
			array(
				'label'     => esc_html__( 'Background Hover Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#222222',
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}:not(.style-3):not(.style-9):not(.style-11):not(.style-12):hover a,{{WRAPPER}} {{CURRENT_ITEM}}.style-6 a .social-hover-style,{{WRAPPER}} {{CURRENT_ITEM}}.style-12:hover a span' => 'background: {{VALUE}};',
					'{{WRAPPER}} {{CURRENT_ITEM}}.style-3:hover' => 'background: {{VALUE}};background-clip: content-box;',
					'{{WRAPPER}} {{CURRENT_ITEM}}.style-11:hover a:before' => '-webkit-box-shadow: inset 0 0 0 4px {{VALUE}};-moz-box-shadow: inset 0 0 0 4px {{VALUE}};box-shadow: inset 0 0 0 4px {{VALUE}};',
				),
			)
		);
		$repeater->add_control(
			'border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#404040',
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}},{{WRAPPER}} {{CURRENT_ITEM}}:not(.style-11):not(.style-12):not(.style-13) a,{{WRAPPER}} {{CURRENT_ITEM}}.style-12 a .fa,{{WRAPPER}} {{CURRENT_ITEM}}.style-13 a:after,{{WRAPPER}} {{CURRENT_ITEM}}.style-13 a:before' => 'border-color: {{VALUE}};',
				),
			)
		);
		$repeater->add_control(
			'border_hover_color',
			array(
				'label'     => esc_html__( 'Border Hover Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#222222',
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}:hover,{{WRAPPER}} {{CURRENT_ITEM}}:not(.style-11):not(.style-12):not(.style-13):hover a,{{WRAPPER}} {{CURRENT_ITEM}}.style-12:hover a span,{{WRAPPER}} {{CURRENT_ITEM}}.style-13:hover a:after,{{WRAPPER}} {{CURRENT_ITEM}}.style-13:hover a:before' => 'border-color: {{VALUE}};',
				),
			)
		);
		$repeater->add_control(
			'loop_magic_scroll',
			array(
				'label'     => esc_html__( 'Magic Scroll', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$repeater->add_control(
			'loop_magic_scroll_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'loop_magic_scroll' => array( 'yes' ),
				),
			)
		);
		$repeater->add_control(
			'plus_tooltip',
			array(
				'label'       => esc_html__( 'Tooltip', 'tpebl' ),
				'type'        => Controls_Manager::SWITCHER,
				'label_on'    => esc_html__( 'Yes', 'tpebl' ),
				'label_off'   => esc_html__( 'No', 'tpebl' ),
				'render_type' => 'template',
				'separator'   => 'before',
			)
		);
		$repeater->add_control(
			'plus_tooltip_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'plus_tooltip' => array( 'yes' ),
				),
			)
		);
		$repeater->add_control(
			'plus_mouse_move_parallax',
			array(
				'label'     => esc_html__( 'Mouse Move Parallax', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Yes', 'tpebl' ),
				'label_off' => esc_html__( 'No', 'tpebl' ),
				'separator' => 'before',
			)
		);
		$repeater->add_control(
			'plus_mouse_move_parallax_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'plus_mouse_move_parallax' => array( 'yes' ),
				),
			)
		);
		$repeater->add_control(
			'plus_continuous_animation',
			array(
				'label'     => esc_html__( 'Continuous Animation', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Yes', 'tpebl' ),
				'label_off' => esc_html__( 'No', 'tpebl' ),
				'separator' => 'before',
			)
		);
		$repeater->add_control(
			'plus_animation_effect',
			array(
				'label'     => esc_html__( 'Animation Effect', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'pulse',
				'options'   => array(
					'pulse'    => esc_html__( 'Pulse', 'tpebl' ),
					'floating' => esc_html__( 'Floating', 'tpebl' ),
					'tossing'  => esc_html__( 'Tossing', 'tpebl' ),
					'rotating' => esc_html__( 'Rotating', 'tpebl' ),
				),
				'condition' => array(
					'plus_continuous_animation' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'plus_animation_hover',
			array(
				'label'     => esc_html__( 'Hover Animation', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Yes', 'tpebl' ),
				'label_off' => esc_html__( 'No', 'tpebl' ),
				'condition' => array(
					'plus_continuous_animation' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'plus_animation_duration',
			array(
				'label'      => esc_html__( 'Duration Time', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => 's',
				'range'      => array(
					's' => array(
						'min'  => 0.5,
						'max'  => 50,
						'step' => 0.1,
					),
				),
				'default'    => array(
					'unit' => 's',
					'size' => 1.2,
				),
				'selectors'  => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'animation-duration: {{SIZE}}{{UNIT}};-webkit-animation-duration: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'plus_continuous_animation' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'plus_transform_origin',
			array(
				'label'       => esc_html__( 'Transform Origin', 'tpebl' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'center center',
				'options'     => array(
					'top left'      => esc_html__( 'Top Left', 'tpebl' ),
					'top center"'   => esc_html__( 'Top Center', 'tpebl' ),
					'top right'     => esc_html__( 'Top Right', 'tpebl' ),
					'center left'   => esc_html__( 'Center Left', 'tpebl' ),
					'center center' => esc_html__( 'Center Center', 'tpebl' ),
					'center right'  => esc_html__( 'Center Right', 'tpebl' ),
					'bottom left'   => esc_html__( 'Bottom Left', 'tpebl' ),
					'bottom center' => esc_html__( 'Bottom Center', 'tpebl' ),
					'bottom right'  => esc_html__( 'Bottom Right', 'tpebl' ),
				),
				'selectors'   => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}' => '-webkit-transform-origin: {{VALUE}};-moz-transform-origin: {{VALUE}};-ms-transform-origin: {{VALUE}};-o-transform-origin: {{VALUE}};transform-origin: {{VALUE}};',
				),
				'render_type' => 'template',
				'condition'   => array(
					'plus_continuous_animation' => 'yes',
					'plus_animation_effect'     => 'rotating',
				),
			)
		);
		$this->add_control(
			'pt_plus_social_networks',
			array(
				'label'       => esc_html__( 'Social Network Select', 'tpebl' ),
				'type'        => Controls_Manager::REPEATER,
				'default'     => array(
					array(
						'pt_plus_social_icons' => '',
					),
				),
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ pt_plus_social_icons }}}',
			)
		);

		$this->add_responsive_control(
			'social_align',
			array(
				'label'   => esc_html__( 'Alignment', 'tpebl' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => array(
					'text-left'   => array(
						'title' => esc_html__( 'Left', 'tpebl' ),
						'icon'  => 'eicon-text-align-left',
					),
					'text-center' => array(
						'title' => esc_html__( 'Center', 'tpebl' ),
						'icon'  => 'eicon-text-align-center',
					),
					'text-right'  => array(
						'title' => esc_html__( 'Right', 'tpebl' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default' => 'text-center',
			)
		);
		$this->add_control(
			'social_icon_verical',
			array(
				'label'     => esc_html__( 'Vertical Layout', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'default'   => 'no',
				'separator' => 'before',
				'condition' => array(
					'styles!' => 'custom',
				),
			)
		);
		$this->add_responsive_control(
			'vl_max_width',
			array(
				'label'      => esc_html__( 'Max. Width', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_social_list.pt_plus_sl_vertical.style-14 ul.social_list' => 'max-width:{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .pt_plus_social_list.pt_plus_sl_vertical.style-15 ul.social_list li' => 'min-width:{{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'styles'              => array( 'style-14', 'style-15' ),
					'social_icon_verical' => 'yes',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_social_styling',
			array(
				'label' => esc_html__( 'Style', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'social_icon_gap_margin',
			array(
				'label'      => esc_html__( 'Icons Between Gap', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_social_list ul.social_list li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'social_icon_gap_padding',
			array(
				'label'      => esc_html__( 'Icons Gap', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_social_list ul.social_list li a i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'height_social',
			array(
				'label'      => esc_html__( 'Height', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'unit' => 'px',
					'size' => 50,
				),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_social_list.style-15 ul.social_list li a' => 'height:{{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'styles' => array( 'style-15' ),
				),
			)
		);
		$this->add_responsive_control(
			'icon_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Font Size', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'default'     => array(
					'unit' => 'px',
					'size' => 15,
				),
				'range'       => array(
					'px' => array(
						'min'  => 8,
						'max'  => 150,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .pt_plus_social_list ul.social_list .style-1 a,
					{{WRAPPER}} .pt_plus_social_list ul.social_list .style-2 a i.fa,
					{{WRAPPER}} .pt_plus_social_list ul.social_list .style-3 a,
					{{WRAPPER}} .pt_plus_social_list ul.social_list .style-4 a,
					{{WRAPPER}} .pt_plus_social_list ul.social_list .style-5 a,
					{{WRAPPER}} .pt_plus_social_list ul.social_list .style-6 a,
					{{WRAPPER}} .pt_plus_social_list ul.social_list .style-7 a,
					{{WRAPPER}} .pt_plus_social_list ul.social_list .style-8 a,
					{{WRAPPER}} .pt_plus_social_list ul.social_list .style-9 a,
					{{WRAPPER}} .pt_plus_social_list ul.social_list .style-10 a,
					{{WRAPPER}} .pt_plus_social_list ul.social_list .style-11 a,
					{{WRAPPER}} .pt_plus_social_list ul.social_list .style-12 a .fa,
					{{WRAPPER}} .pt_plus_social_list ul.social_list .style-13 a,
					{{WRAPPER}} .pt_plus_social_list ul.social_list .style-14 a,
					{{WRAPPER}} .pt_plus_social_list ul.social_list .style-15 a,
					{{WRAPPER}} .pt_plus_social_list ul.social_list .custom a' => 'font-size: {{SIZE}}{{UNIT}};',
				),

			)
		);
		$this->add_responsive_control(
			'social_icon_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_social_list ul.social_list .style-1 a,
					{{WRAPPER}} .pt_plus_social_list ul.social_list .style-2 a,					
					{{WRAPPER}} .pt_plus_social_list ul.social_list .style-4 a,
					{{WRAPPER}} .pt_plus_social_list ul.social_list .style-5 a,
					{{WRAPPER}} .pt_plus_social_list ul.social_list .style-6 a,
					{{WRAPPER}} .pt_plus_social_list ul.social_list .style-7 a,
					{{WRAPPER}} .pt_plus_social_list ul.social_list .style-10 a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'styles' => array( 'style-1', 'style-2', 'style-4', 'style-5', 'style-6', 'style-7', 'style-10' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'text_typography',
				'selector'  => '{{WRAPPER}} .pt_plus_social_list ul.social_list .style-1 a span,
				{{WRAPPER}} .pt_plus_social_list ul.social_list .style-2 a span,
				{{WRAPPER}} .pt_plus_social_list ul.social_list .style-4 a span,
				{{WRAPPER}} .pt_plus_social_list ul.social_list .style-10 a span,
				{{WRAPPER}} .pt_plus_social_list ul.social_list .style-12 a span,
				{{WRAPPER}} .pt_plus_social_list ul.social_list .style-14 a span,
				{{WRAPPER}} .pt_plus_social_list ul.social_list .style-15 a span',
				'condition' => array(
					'styles' => array( 'style-1', 'style-2', 'style-4', 'style-10', 'style-12', 'style-14', 'style-15' ),
				),
			)
		);
		$this->add_responsive_control(
			'social_icon_width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Width', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 400,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 60,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .pt_plus_social_list.custom ul.social_list li a' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition'   => array(
					'styles' => 'custom',
				),
				'separator'   => 'before',
			)
		);
		$this->add_responsive_control(
			'social_icon_height',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Height', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 400,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 40,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .pt_plus_social_list.custom ul.social_list li a' => 'height: {{SIZE}}{{UNIT}};',
				),
				'condition'   => array(
					'styles' => 'custom',
				),
			)
		);
		$this->add_control(
			'social_icon_border',
			array(
				'label'     => esc_html__( 'Box Border', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'default'   => 'no',
				'separator' => 'before',
				'condition' => array(
					'styles' => 'custom',
				),
			)
		);
		$this->add_control(
			'social_border_style',
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
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_social_list.custom ul.social_list li a' => 'border-style: {{VALUE}};',
				),
				'condition' => array(
					'styles'             => 'custom',
					'social_icon_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'social_border_width',
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
					'{{WRAPPER}} .pt_plus_social_list.custom ul.social_list li a' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'styles'             => 'custom',
					'social_icon_border' => 'yes',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_border_style' );
		$this->start_controls_tab(
			'tab_border_normal',
			array(
				'label'     => esc_html__( 'Normal', 'tpebl' ),
				'condition' => array(
					'styles' => 'custom',
				),
			)
		);
		$this->add_responsive_control(
			'social_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_social_list.custom ul.social_list li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'styles' => 'custom',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_border_hover',
			array(
				'label'     => esc_html__( 'Hover', 'tpebl' ),
				'condition' => array(
					'styles' => 'custom',
				),
			)
		);
		$this->add_responsive_control(
			'social_border_hover_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_social_list.custom ul.social_list li:hover a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'styles' => 'custom',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'social_icon_shadow_options',
			array(
				'label'     => esc_html__( 'Box Shadow Options', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'styles' => 'custom',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_shadow_style' );
		$this->start_controls_tab(
			'tab_shadow_normal',
			array(
				'label'     => esc_html__( 'Normal', 'tpebl' ),
				'condition' => array(
					'styles' => 'custom',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'social_icon_box_shadow',
				'selector'  => '{{WRAPPER}} .pt_plus_social_list.custom ul.social_list li a',
				'condition' => array(
					'styles' => 'custom',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_shadow_hover',
			array(
				'label'     => esc_html__( 'Hover', 'tpebl' ),
				'condition' => array(
					'styles' => 'custom',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'social_icon_box_hover_shadow',
				'selector'  => '{{WRAPPER}} .pt_plus_social_list.custom ul.social_list li:hover a',
				'condition' => array(
					'styles' => 'custom',
				),
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
	 * Register controls.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$styles        = ! empty( $settings['styles'] ) ? $settings['styles'] : '';
		$social_align  = $settings['social_align'];
		$social_align .= ! empty( $settings['social_align_tablet'] ) ? ' tsocial' . $settings['social_align_tablet'] : '';
		$social_align .= ! empty( $settings['social_align_mobile'] ) ? ' msocial' . $settings['social_align_mobile'] : '';

		$social_icon_verical = isset( $settings['social_icon_verical'] ) ? $settings['social_icon_verical'] : '';

		$si_v_class = '';

		if ( 'yes' === $social_icon_verical ) {
			$si_v_class = ' pt_plus_sl_vertical';
		}

		$social_animation = '';
		$social_chaffle   = '';
		$hover_style      = '';
		$social_text      = '';
		$link             = '';
		$link_atts_title  = '';
		$link_atts_url    = '';
		$link_atts_target = '';

		$hover_animation = ! empty( $settings['hover_animation'] ) ? $settings['hover_animation'] : '';

		if ( 'style-14' === $styles || 'style-15' === $styles ) {

			if ( 'hover-1' === $hover_animation ) {
				$social_animation = 'social-faded';
			} elseif ( 'hover-2' === $hover_animation ) {
				$social_animation = 'socail-chaffal';
				$social_chaffle   = 'ts-chaffle';
			}
		}

		$animation_effects = ! empty( $settings['animation_effects'] ) ? $settings['animation_effects'] : '';
		$animation_delay   = ! empty( $settings['animation_delay']['size'] ) ? $settings['animation_delay']['size'] : 50;
		$animate_duration  = ! empty( $settings['animate_duration']['size'] ) ? $settings['animate_duration']['size'] : 50;

		$ani_duration = ! empty( $settings['animation_duration_default'] ) ? $settings['animation_duration_default'] : '';
		$out_effect   = ! empty( $settings['animation_out_effects'] ) ? $settings['animation_out_effects'] : '';
		$out_delay    = ! empty( $settings['animation_out_delay']['size'] ) ? $settings['animation_out_delay']['size'] : 50;
		$out_duration = ! empty( $settings['animation_out_duration_default'] ) ? $settings['animation_out_duration_default'] : '';
		$out_speed    = ! empty( $settings['animation_out_duration']['size'] ) ? $settings['animation_out_duration']['size'] : 50;

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

		$social  = '<div class="pt_plus_social_list ' . esc_attr( $si_v_class ) . ' ' . esc_attr( $social_align ) . ' ' . esc_attr( $styles ) . ' ' . esc_attr( $animated_class ) . '" ' . $animation_attr . '>';
		$social .= '<ul class="social_list ' . esc_attr( $social_animation ) . '">';

		$pt_plus_sn = ! empty( $settings['pt_plus_social_networks'] ) ? $settings['pt_plus_social_networks'] : '';

		if ( ! empty( $pt_plus_sn ) ) {
			foreach ( $pt_plus_sn as $network ) {

				$id = wp_rand( 1000, 10000000 );

				$pt_social_ic = ! empty( $network['pt_plus_social_icons'] ) ? $network['pt_plus_social_icons'] : '';
				$pt_cust_icon = ! empty( $network['pt_plus_social_icon_custom'] ) ? $network['pt_plus_social_icon_custom'] : '';
				$social_url   = ! empty( $network['social_url'] ) ? $network['social_url'] : '';

				if ( ! empty( $pt_social_ic ) && ! empty( $social_url['url'] ) ) {

					if ( 'custom' === $pt_social_ic && ! empty( $pt_cust_icon ) ) {
						$icon = $pt_cust_icon;
					} elseif ( ! empty( $pt_social_ic ) ) {
						$icon = $pt_social_ic;
					}

					if ( ! empty( $social_url['url'] ) ) {
						$link_atts_url = 'href="' . esc_url( $social_url['url'] ) . '"';
					}

					if ( ! empty( $social_url['is_external'] ) ) {
						$link_atts_target = 'target="_blank"';
					}

					if ( ! empty( $social_url['nofollow'] ) ) {
						$link_atts_title = 'rel="nofollow"';
					}

					$soc_txt = ! empty( $network['social_text'] ) ? $network['social_text'] : '';

					if ( ! empty( $soc_txt ) && ( 'style-1' === $styles || 'style-2' === $styles || 'style-4' === $styles || 'style-10' === $styles || 'style-12' === $styles || 'style-14' === $styles || 'style-15' === $styles || 'custom' === $styles ) ) {
						$social_text = '<span class="' . esc_attr( $social_chaffle ) . '" data-lang="en">' . wp_kses_post( $soc_txt ) . '</span>';
					}

					$icon_html = '<i class="fa fab ' . esc_attr( $icon ) . '"></i>';

					if ( 'style-6' === $styles ) {
						$hover_style = '<i class="social-hover-style"></i>';
					}

					if ( 'style-9' === $styles ) {
						$hover_style = '<span class="line-top-left style-' . esc_attr( $icon ) . '"></span><span class="line-top-center style-' . esc_attr( $icon ) . '"></span><span class="line-top-right style-' . esc_attr( $icon ) . '"></span><span class="line-bottom-left style-' . esc_attr( $icon ) . '"></span><span class="line-bottom-center style-' . esc_attr( $icon ) . '"></span><span class="line-bottom-right style-' . esc_attr( $icon ) . '"></span>';
					}

					$continuous_animation = '';

					$plus_con_ani = ! empty( $network['plus_continuous_animation'] ) ? $network['plus_continuous_animation'] : '';
					$plus_hov_ani = ! empty( $network['plus_animation_hover'] ) ? $network['plus_animation_hover'] : '';

					if ( 'yes' === $plus_con_ani ) {
						if ( 'yes' === $plus_hov_ani ) {
							$animation_class = 'hover_';
						} else {
							$animation_class = 'image-';
						}

						$continuous_animation = $animation_class . $network['plus_animation_effect'];
					}

					$uid_social = uniqid( 'social' ) . $network['_id'];

					$social .= '<li id="' . esc_attr( $uid_social ) . '" class="elementor-repeater-item-' . esc_attr( $network['_id'] ) . ' ' . esc_attr( $styles ) . '  social-' . esc_attr( $icon ) . ' social-' . esc_attr( $id ) . ' ' . esc_attr( $continuous_animation ) . '" ' . $this->get_render_attribute_string( '_tooltip' ) . '>';

						$social .= '<div class="social-loop-inner ">';

							$social .= '<a ' . $link_atts_url . ' ' . esc_attr( $link_atts_title ) . ' ' . esc_attr( $link_atts_target ) . '>' . $icon_html . $social_text . $hover_style . '</a>';

						$social .= '</div>';

					$social .= '</li>';
				}
			}
		}
		$social .= '</ul>';
		$social .= '</div>';
		echo $social;
	}
}
