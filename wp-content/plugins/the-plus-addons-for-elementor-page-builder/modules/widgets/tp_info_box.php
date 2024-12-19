<?php
/**
 * Widget Name: Info Box
 * Description: Display Infobox.
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
use Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) {
	exit;// Exit if accessed directly.
}

/**
 * Class L_ThePlus_Info_Box
 */
class L_ThePlus_Info_Box extends Widget_Base {

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
		return 'tp-info-box';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Info Box', 'tpebl' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-info-circle theplus_backend_icon';
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
		return array( 'Info Box', 'Information Box', 'Content Box', 'Text Box', 'Feature Box', 'Icon Box', 'Callout Box', 'Highlight Box', 'Notification Box', 'Alert Box', 'Message Box', 'Card Box', 'Box Widget', 'Box Element', 'Box Container' );
	}

	/**
	 * Get custom URL.
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
				'label' => esc_html__( 'Content', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'info_box_layout',
			array(
				'label'   => esc_html__( 'Select Layout', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'single_layout',
				'options' => array(
					'single_layout'   => esc_html__( 'Listing', 'tpebl' ),
					'carousel_layout' => esc_html__( 'Carousel (Pro)', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_single_layout',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "show-services-box-in-wordpress-using-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'info_box_layout' => array( 'single_layout' ),
				),
			)
		);
		$this->add_control(
			'main_style',
			array(
				'label'     => esc_html__( 'Info Box Style', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style_1',
				'options'   => array(
					'style_1'  => esc_html__( 'Style-1', 'tpebl' ),
					'style_2'  => esc_html__( 'Style-2 (Pro)', 'tpebl' ),
					'style_3'  => esc_html__( 'Style-3', 'tpebl' ),
					'style_4'  => esc_html__( 'Style-4', 'tpebl' ),
					'style_7'  => esc_html__( 'Style-5 (Pro)', 'tpebl' ),
					'style_11' => esc_html__( 'Style-6 (Pro)', 'tpebl' ),
				),
				'condition' => array(
					'info_box_layout' => 'single_layout',
				),
			)
		);
		$this->add_control(
			'loop_select_icon_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'info_box_layout' => 'carousel_layout',
				),
			)
		);
		$this->add_control(
			'main_style_pro_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'main_style!' => array( 'style_1', 'style_3','style_4' ),
				),
			)
		);
		$this->add_control(
			'connection_switch',
			array(
				'label'     => esc_html__( 'Carousel Anything Connection', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'default'   => 'no',
				'separator' => 'before',
				'condition' => array(
					'info_box_layout' => 'carousel_layout',
				),
			)
		);
		$this->add_control(
			'connection_switch_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'info_box_layout'   => 'carousel_layout',
					'connection_switch' => 'yes',
				),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'     => esc_html__( 'Title Of Info Box', 'tpebl' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'The Plus', 'tpebl' ),
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'info_box_layout' => 'single_layout',
					'main_style'      => array( 'style_1', 'style_3','style_4' ),
				),
			)
		);
		$this->add_control(
			'content_desc',
			array(
				'label'       => esc_html__( 'Description', 'tpebl' ),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => esc_html__( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'tpebl' ),
				'placeholder' => esc_html__( 'Type your description here', 'tpebl' ),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'info_box_layout' => 'single_layout',
					'main_style'      => array( 'style_1', 'style_3','style_4' ),
				),
			)
		);
		$this->add_responsive_control(
			'text_align',
			array(
				'label'     => esc_html__( 'Info Box Alignment', 'tpebl' ),
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
				'toggle'    => true,
				'separator' => 'before',
				'condition' => array(
					'main_style' => array('style_3'),
				),
			)
		);
		$this->add_control(
			'url_link',
			array(
				'label'         => esc_html__( 'Link', 'tpebl' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_html__( 'https://your-link.com', 'tpebl' ),
				'show_external' => true,
				'default'       => array(
					'url' => '',
				),
				'dynamic'       => array(
					'active' => true,
				),
				'condition'     => array(
					'info_box_layout' => 'single_layout',
					'main_style'      => array( 'style_1', 'style_3','style_4' ),
				),
			)
		);
		$this->add_control(
			'image_icon',
			array(
				'label'     => esc_html__( 'Select Icon', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'icon',
				'options'   => array(
					''      => esc_html__( 'None', 'tpebl' ),
					'icon'  => esc_html__( 'Icon', 'tpebl' ),
					'image' => esc_html__( 'Image', 'tpebl' ),
					'svg'   => esc_html__( 'Svg (PRO)', 'tpebl' ),
				),
				'separator' => 'before',
				'condition' => array(
					'info_box_layout' => 'single_layout',
					'main_style'      => array( 'style_1', 'style_3','style_4' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_image',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "create-elementor-image-box/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'image_icon' => array( 'image' ),
				),
			)
		);
		$this->add_control(
			'img_note',
			array(
				'type'        => Controls_Manager::RAW_HTML,
				'raw'         => '<p class="tp-controller-notice"><i>You can select Icon, Custom Image or SVG using this option.</i></p>',
				'label_block' => true,
				'condition'   => array(
					'info_box_layout' => 'single_layout',
					'main_style'      => array( 'style_1', 'style_3','style_4' ),
				),
			)
		);
		$this->add_control(
			'svg_icon_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'info_box_layout' => 'single_layout',
					'main_style'      => array( 'style_1', 'style_3','style_4' ),
					'image_icon'      => 'svg',
				),
			)
		);
		$this->add_control(
			'select_image',
			array(
				'label'      => esc_html__( 'Use Image As icon', 'tpebl' ),
				'type'       => Controls_Manager::MEDIA,
				'default'    => array(
					'url' => '',
				),
				'media_type' => 'image',
				'dynamic'    => array(
					'active' => true,
				),
				'condition'  => array(
					'info_box_layout' => 'single_layout',
					'main_style'      => array( 'style_1', 'style_3','style_4' ),
					'image_icon'      => 'image',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'select_image_thumbnail',
				'default'   => 'full',
				'separator' => 'after',
				'condition' => array(
					'info_box_layout' => 'single_layout',
					'main_style'      => array( 'style_1', 'style_3','style_4' ),
					'image_icon'      => 'image',
				),
			)
		);
		$this->add_control(
			'icon_font_style',
			array(
				'label'     => esc_html__( 'Icon Font', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'font_awesome',
				'options'   => array(
					'font_awesome'   => esc_html__( 'Font Awesome', 'tpebl' ),
					'font_awesome_5' => esc_html__( 'Font Awesome 5', 'tpebl' ),
					'icon_mind'      => esc_html__( 'Icons Mind (Pro)', 'tpebl' ),
					'icon_image'     => esc_html__( 'Icon Image (Pro)', 'tpebl' ),
				),
				'condition' => array(
					'info_box_layout' => 'single_layout',
					'main_style'      => array( 'style_1', 'style_3','style_4' ),
					'image_icon'      => 'icon',
				),
			)
		);
		$this->add_control(
			'icon_fontawesome',
			array(
				'label'     => esc_html__( 'Icon Library', 'tpebl' ),
				'type'      => Controls_Manager::ICON,
				'default'   => 'fa fa-bank',
				'condition' => array(
					'info_box_layout' => 'single_layout',
					'main_style'      => array( 'style_1', 'style_3','style_4' ),
					'image_icon'      => 'icon',
					'icon_font_style' => 'font_awesome',
				),
			)
		);
		$this->add_control(
			'icon_fontawesome_5',
			array(
				'label'     => esc_html__( 'Icon Library', 'tpebl' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-plus',
					'library' => 'solid',
				),
				'condition' => array(
					'info_box_layout' => 'single_layout',
					'main_style'      => array( 'style_1', 'style_3','style_4' ),
					'image_icon'      => 'icon',
					'icon_font_style' => 'font_awesome_5',
				),
			)
		);
		$this->add_control(
			'icons_image_pro_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'info_box_layout' => 'single_layout',
					'main_style'      => array( 'style_1', 'style_3','style_4' ),
					'image_icon'      => 'icon',
					'icon_font_style' => array( 'icon_mind', 'icon_image' ),
				),
			)
		);
		$this->add_control(
			'display_button',
			array(
				'label'     => esc_html__( 'Button', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'default'   => 'no',
				'separator' => 'before',
				'condition' => array(
					'info_box_layout' => 'single_layout',
					'main_style'      => array( 'style_1', 'style_3','style_4' ),
				),
			)
		);
		$this->add_control(
			'button_style',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Button Style', 'tpebl' ),
				'default'   => 'style-8',
				'options'   => array(
					'style-7' => esc_html__( 'Style 1 (Pro)', 'tpebl' ),
					'style-8' => esc_html__( 'Style 2', 'tpebl' ),
					'style-9' => esc_html__( 'Style 3 (Pro)', 'tpebl' ),
				),
				'condition' => array(
					'info_box_layout' => 'single_layout',
					'main_style'      => array( 'style_1', 'style_3','style_4' ),
					'display_button'  => 'yes',
				),
			)
		);
		$this->add_control(
			'button_style_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'info_box_layout' => 'single_layout',
					'main_style'      => array( 'style_1', 'style_3','style_4' ),
					'display_button'  => 'yes',
					'button_style!'   => 'style-8',
				),
			)
		);
		$this->add_control(
			'button_text',
			array(
				'label'       => esc_html__( 'Button Text', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
				'default'     => esc_html__( 'Read More', 'tpebl' ),
				'placeholder' => esc_html__( 'Read More', 'tpebl' ),
				'condition'   => array(
					'info_box_layout' => 'single_layout',
					'main_style'      => array( 'style_1', 'style_3','style_4' ),
					'display_button'  => 'yes',
					'button_style'    => 'style-8',
				),
			)
		);
		$this->add_control(
			'button_link',
			array(
				'label'       => esc_html__( 'Button Link', 'tpebl' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => array(
					'active' => true,
				),
				'placeholder' => esc_html__( 'https://www.demo-link.com', 'tpebl' ),
				'default'     => array(
					'url' => '#',
				),
				'condition'   => array(
					'info_box_layout' => 'single_layout',
					'main_style'      => array( 'style_1', 'style_3','style_4' ),
					'display_button'  => 'yes',
					'button_style'    => 'style-8',
				),
			)
		);
		$this->add_control(
			'button_icon_style',
			array(
				'label'     => esc_html__( 'Icon Font', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'font_awesome',
				'options'   => array(
					''               => esc_html__( 'None', 'tpebl' ),
					'font_awesome'   => esc_html__( 'Font Awesome', 'tpebl' ),
					'font_awesome_5' => esc_html__( 'Font Awesome 5', 'tpebl' ),
					'icon_mind'      => esc_html__( 'Icons Mind (Pro)', 'tpebl' ),
				),
				'condition' => array(
					'info_box_layout' => 'single_layout',
					'main_style'      => array( 'style_1', 'style_3','style_4' ),
					'display_button'  => 'yes',
					'button_style!'   => array( 'style-7', 'style-9' ),
				),
			)
		);
		$this->add_control(
			'button_icon',
			array(
				'label'       => esc_html__( 'Icon', 'tpebl' ),
				'type'        => Controls_Manager::ICON,
				'label_block' => true,
				'default'     => 'fa fa-chevron-right',
				'condition'   => array(
					'info_box_layout'   => 'single_layout',
					'main_style'        => array( 'style_1', 'style_3','style_4' ),
					'display_button'    => 'yes',
					'button_style!'     => array( 'style-7', 'style-9' ),
					'button_icon_style' => 'font_awesome',
				),
			)
		);
		$this->add_control(
			'button_icon_5',
			array(
				'label'     => esc_html__( 'Icon Library', 'tpebl' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-plus',
					'library' => 'solid',
				),
				'condition' => array(
					'info_box_layout'   => 'single_layout',
					'main_style'        => array( 'style_1', 'style_3','style_4' ),
					'display_button'    => 'yes',
					'button_style!'     => array( 'style-7', 'style-9' ),
					'button_icon_style' => 'font_awesome_5',
				),
			)
		);
		$this->add_control(
			'button_icons_mind_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'info_box_layout'   => 'single_layout',
					'main_style'        => array( 'style_1', 'style_3','style_4' ),
					'display_button'    => 'yes',
					'button_style!'     => array( 'style-7', 'style-9' ),
					'button_icon_style' => 'icon_mind',
				),
			)
		);
		$this->add_control(
			'before_after',
			array(
				'label'     => esc_html__( 'Icon Position', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'after',
				'options'   => array(
					'after'  => esc_html__( 'After', 'tpebl' ),
					'before' => esc_html__( 'Before', 'tpebl' ),
				),
				'condition' => array(
					'info_box_layout'    => 'single_layout',
					'main_style'         => array( 'style_1', 'style_3','style_4' ),
					'display_button'     => 'yes',
					'button_style!'      => array( 'style-7', 'style-9' ),
					'button_icon_style!' => array( '', 'icon_mind' ),
				),
			)
		);
		$this->add_control(
			'icon_spacing',
			array(
				'label'     => esc_html__( 'Icon Spacing', 'tpebl' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max' => 100,
					),
				),
				'condition' => array(
					'info_box_layout'    => 'single_layout',
					'main_style'         => array( 'style_1', 'style_3','style_4' ),
					'display_button'     => 'yes',
					'button_style!'      => array( 'style-7', 'style-9' ),
					'button_icon_style!' => array( '', 'icon_mind' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .button-link-wrap .button-after' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .button-link-wrap .button-before' => 'margin-right: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'hover_info_button',
			array(
				'label'     => esc_html__( 'Hover Button InfoBox', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'tpebl' ),
				'label_off' => esc_html__( 'Off', 'tpebl' ),
				'default'   => 'no',
				'condition' => array(
					'info_box_layout' => 'single_layout',
					'main_style'      => array( 'style_1', 'style_3','style_4'),
					'display_button'  => 'yes',
					'button_style'    => array( 'style-8' ),
				),
			)
		);
		$this->add_control(
			'display_pin_text',
			array(
				'label'     => esc_html__( 'Display Pin Text', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'default'   => 'no',
				'separator' => 'before',
				'condition' => array(
					'info_box_layout' => 'single_layout',
					'main_style'      => array('style_3','style_4'),
				),
			)
		);
		$this->add_control(
			'display_pin_text_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'info_box_layout'  => 'single_layout',
					'main_style'       => array('style_3','style_4'),
					'display_pin_text' => 'yes',
				),
			)
		);

		$this->add_control(
			'title_tag',
			array(
				'label'     => esc_html__( 'Title Tag', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'div',
				'options'   => l_theplus_get_tags_options(),
				'separator' => 'before',
				'condition' => array(
					'info_box_layout' => 'single_layout',
					'main_style'      => array( 'style_1', 'style_3','style_4' ),
				),
			)
		);
		$this->add_control(
			'full_infobox_switch',
			array(
				'label'     => wp_kses_post( "Full Infobox Link <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "add-link-to-the-info-box-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'default'   => 'no',
				'separator' => 'before',
				'condition' => array(
					'info_box_layout' => 'single_layout',
					'main_style'      => array( 'style_1', 'style_3','style_4' ),
				),
			)
		);
		$this->add_control(
			'full_infobox_note',
			array(
				'type'        => Controls_Manager::RAW_HTML,
				'raw'         => '<p class="tp-controller-notice"><i>Note : If you enable this option, There will be only one link for whole infobox. Rest links will be removed.</i></p>',
				'label_block' => true,
				'condition'   => array(
					'info_box_layout' => 'single_layout',
					'main_style'      => array( 'style_1', 'style_3','style_4' ),
				),
			)
		);
		$this->add_control(
			'full_infobox_switch_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'full_infobox_switch' => array( 'yes' ),
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_title_styling',
			array(
				'label' => esc_html__( 'Title Style', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typography', 'tpebl' ),
				'selector' => '{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-title',
			)
		);
		$this->start_controls_tabs( 'tabs_title_style' );
		$this->start_controls_tab(
			'tab_title_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'title_color_option',
			array(
				'label'       => esc_html__( 'Title Color', 'tpebl' ),
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
				),
				'label_block' => false,
				'default'     => 'solid',
			)
		);
		$this->add_control(
			'title_color',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-title' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'title_color_option' => 'solid',
				),
			)
		);
		$this->add_control(
			'title_gradient_color1',
			array(
				'label'     => esc_html__( 'Color 1', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'orange',
				'condition' => array(
					'title_color_option' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'title_gradient_color1_control',
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
					'title_color_option' => 'gradient',
				),
				'of_type'     => 'gradient',
			)
		);
		$this->add_control(
			'title_gradient_color2',
			array(
				'label'     => esc_html__( 'Color 2', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'cyan',
				'condition' => array(
					'title_color_option' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'title_gradient_color2_control',
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
					'title_color_option' => 'gradient',
				),
				'of_type'     => 'gradient',
			)
		);
		$this->add_control(
			'title_gradient_style',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Gradient Style', 'tpebl' ),
				'default'   => 'linear',
				'options'   => l_theplus_get_gradient_styles(),
				'condition' => array(
					'title_color_option' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'title_gradient_angle',
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
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-title' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{title_gradient_color1.VALUE}} {{title_gradient_color1_control.SIZE}}{{title_gradient_color1_control.UNIT}}, {{title_gradient_color2.VALUE}} {{title_gradient_color2_control.SIZE}}{{title_gradient_color2_control.UNIT}})',
				),
				'condition'  => array(
					'title_color_option'   => 'gradient',
					'title_gradient_style' => array( 'linear' ),
				),
				'of_type'    => 'gradient',
			)
		);
		$this->add_control(
			'title_gradient_position',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Position', 'tpebl' ),
				'options'   => l_theplus_get_position_options(),
				'default'   => 'center center',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-title' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{title_gradient_color1.VALUE}} {{title_gradient_color1_control.SIZE}}{{title_gradient_color1_control.UNIT}}, {{title_gradient_color2.VALUE}} {{title_gradient_color2_control.SIZE}}{{title_gradient_color2_control.UNIT}})',
				),
				'condition' => array(
					'title_color_option'   => 'gradient',
					'title_gradient_style' => 'radial',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_title_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'title_hover_color_option',
			array(
				'label'       => esc_html__( 'Title Hover Color', 'tpebl' ),
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
				),
				'label_block' => false,
				'default'     => 'solid',
			)
		);
		$this->add_control(
			'title_hover_color',
			array(
				'label'     => esc_html__( 'Hover Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#3351a6',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-title,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .service-title' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'title_hover_color_option' => 'solid',
				),
			)
		);
		$this->add_control(
			'title_hover_gradient_color1',
			array(
				'label'     => esc_html__( 'Color 1', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'orange',
				'condition' => array(
					'title_hover_color_option' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'title_hover_gradient_color1_control',
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
					'title_hover_color_option' => 'gradient',
				),
				'of_type'     => 'gradient',
			)
		);
		$this->add_control(
			'title_hover_gradient_color2',
			array(
				'label'     => esc_html__( 'Color 2', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'cyan',
				'condition' => array(
					'title_hover_color_option' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'title_hover_gradient_color2_control',
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
					'title_hover_color_option' => 'gradient',
				),
				'of_type'     => 'gradient',
			)
		);
		$this->add_control(
			'title_hover_gradient_style',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Gradient Style', 'tpebl' ),
				'default'   => 'linear',
				'options'   => l_theplus_get_gradient_styles(),
				'condition' => array(
					'title_hover_color_option' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'title_hover_gradient_angle',
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
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-title,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .service-title' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{title_hover_gradient_color1.VALUE}} {{title_hover_gradient_color1_control.SIZE}}{{title_hover_gradient_color1_control.UNIT}}, {{title_hover_gradient_color2.VALUE}} {{title_hover_gradient_color2_control.SIZE}}{{title_hover_gradient_color2_control.UNIT}})',
				),
				'condition'  => array(
					'title_hover_color_option'   => 'gradient',
					'title_hover_gradient_style' => array( 'linear' ),
				),
				'of_type'    => 'gradient',
			)
		);
		$this->add_control(
			'title_hover_gradient_position',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Position', 'tpebl' ),
				'options'   => l_theplus_get_position_options(),
				'default'   => 'center center',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-title,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .service-title' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{title_hover_gradient_color1.VALUE}} {{title_hover_gradient_color1_control.SIZE}}{{title_hover_gradient_color1_control.UNIT}}, {{title_hover_gradient_color2.VALUE}} {{title_hover_gradient_color2_control.SIZE}}{{title_hover_gradient_color2_control.UNIT}})',
				),
				'condition' => array(
					'title_hover_color_option'   => 'gradient',
					'title_hover_gradient_style' => 'radial',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'title_top_space',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => esc_html__( 'Title Top Space', 'tpebl' ),
				'range' => [
					'px' => array(
						'step' => 2,
						'min'  => -150,
						'max'  => 150,
					),
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'tablet_default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'mobile_default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors'   => array(
					'{{WRAPPER}} .pt_plus_info_box.info-box-style_1 .info-box-inner .service-title,{{WRAPPER}} .pt_plus_info_box.info-box-style_3 .info-box-inner .service-title,{{WRAPPER}} .pt_plus_info_box.info-box-style_4 .info-box-inner .service-media' => 'margin-top : {{SIZE}}{{UNIT}}',
				),
			]
		);
		$this->add_responsive_control(
			'title_btm_space',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => esc_html__( 'Title Bottom Space', 'tpebl' ),
				'range' => [
					'px' => array(
						'step' => 2,
						'min'  => -150,
						'max'  => 150,
					),
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'tablet_default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'mobile_default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .pt_plus_info_box.info-box-style_1 .info-box-inner .service-title,{{WRAPPER}} .pt_plus_info_box.info-box-style_2 .info-box-inner .service-title,{{WRAPPER}} .pt_plus_info_box.info-box-style_3 .info-box-inner .service-title,{{WRAPPER}} .pt_plus_info_box.info-box-style_4 .info-box-inner .service-media,{{WRAPPER}} .pt_plus_info_box.info-box-style_7 .info-box-inner .service-title' => 'margin-bottom : {{SIZE}}{{UNIT}}',
				),
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_title_border_styling',
			array(
				'label' => esc_html__( 'Bottom Border Style', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'border_check',
			array(
				'label'     => esc_html__( 'Display Border', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'default'   => 'yes',
			)
		);
		$this->add_control(
			'border_check_note',
			array(
				'type'        => Controls_Manager::RAW_HTML,
				'raw'         => '<p class="tp-controller-notice"><i>By checking up this option you can turn on underline/border under the title.</i></p>',
				'label_block' => true,
			)
		);
		$this->add_control(
			'border_width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Border Width', 'tpebl' ),
				'size_units'  => array( '%' ),
				'range'       => array(
					'%' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 5,
					),
				),
				'default'     => array(
					'unit' => '%',
					'size' => 20,
				),
				'render_type' => 'ui',
				'condition'   => array(
					'border_check' => 'yes',
				),
				'selectors'   => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-border' => 'width: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_control(
			'border_height',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Border Height', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 20,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 1,
				),
				'render_type' => 'ui',
				'condition'   => array(
					'border_check' => 'yes',
				),
				'selectors'   => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-border' => 'border-width: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_control(
			'title_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-border' => 'border-color: {{VALUE}}',
				),
				'condition' => array(
					'border_check' => 'yes',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_desc_styling',
			array(
				'label' => esc_html__( 'Description Style', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'desc_typography',
				'label'    => esc_html__( 'Typography', 'tpebl' ),
				'selector' => '{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-desc,{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-desc p',
			)
		);
		$this->add_control(
			'desc_color',
			array(
				'label'     => esc_html__( 'Desc Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-desc,{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-desc p' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'desc_hover_color',
			array(
				'label'     => esc_html__( 'Desc Hover Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-desc,{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-desc p,
					{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .service-desc,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .service-desc p' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_responsive_control(
			'desc_padding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .info-box-inner  .info-box-bg-box .service-desc ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_bg_option_styling',
			array(
				'label' => esc_html__( 'Background Options', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
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
				'condition' => array(
					'main_style' => array( 'style_1', 'style_3','style_4' ),
				),
			)
		);
		$this->add_control(
			'box_border_style',
			array(
				'label'     => esc_html__( 'Border Style', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'solid',
				'options'   => l_theplus_get_border_style(),
				'condition' => array(
					'box_border' => 'yes',
					'main_style' => array( 'style_1', 'style_3','style_4' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .info-box-bg-box' => 'border-style: {{VALUE}};',
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
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .info-box-bg-box' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'main_style' => array( 'style_1', 'style_3','style_4' ),
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
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .info-box-bg-box' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'main_style' => array( 'style_1', 'style_3','style_4' ),
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
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .info-box-bg-box,{{WRAPPER}} .pt_plus_info_box .info-box-inner .infobox-overlay-color' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'main_style' => array( 'style_1', 'style_3','style_4' ),
					'box_border' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_border_hover',
			array(
				'label'     => esc_html__( 'Hover', 'tpebl' ),
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
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .info-box-bg-box,
					{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .info-box-bg-box' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'main_style' => array( 'style_1', 'style_3','style_4' ),
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
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .info-box-bg-box,{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .infobox-overlay-color,
					{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .info-box-bg-box,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .infobox-overlay-color' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'main_style' => array( 'style_1', 'style_3','style_4' ),
					'box_border' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'border_check_right',
			array(
				'label'     => esc_html__( 'Side image Border', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'default'   => 'yes',
				'condition' => array(
					'main_style' => array( 'style_1' ),
				),
			)
		);
		$this->add_control(
			'border_right_color',
			array(
				'label'     => esc_html__( 'Border Right Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'condition' => array(
					'main_style'         => array( 'style_1' ),
					'border_check_right' => 'yes',
				),
			)
		);
		$this->add_control(
			'background_options',
			array(
				'label'     => esc_html__( 'Background Options', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'bg_hover_animation',
			array(
				'label'   => esc_html__( 'Background Hover Animation', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'hover_normal',
				'options' => array(
					'hover_normal'       => esc_html__( 'Select Hover Bg Animation', 'tpebl' ),
					'hover_fadein'       => esc_html__( 'FadeIn (Pro)', 'tpebl' ),
					'hover_slide_left'   => esc_html__( 'SlideInLeft (Pro)', 'tpebl' ),
					'hover_slide_right'  => esc_html__( 'SlideInRight (Pro)', 'tpebl' ),
					'hover_slide_top'    => esc_html__( 'SlideInTop (Pro)', 'tpebl' ),
					'hover_slide_bottom' => esc_html__( 'SlideInBotton (Pro)', 'tpebl' ),
				),
			)
		);
		$this->start_controls_tabs( 'tabs_background_style' );
		$this->start_controls_tab(
			'tab_background_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'box_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .pt_plus_info_box .info-box-inner .info-box-bg-box',

			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_background_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'box_hover_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .info-box-bg-box',
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
				'selector' => '{{WRAPPER}} .pt_plus_info_box .info-box-inner .info-box-bg-box',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_shadow_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'box_hover_shadow',
				'selector' => '{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .info-box-bg-box,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .info-box-bg-box',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_button_styling',
			array(
				'label'     => esc_html__( 'Button Style', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'display_button' => 'yes',
				),
			)
		);
		$this->add_control(
			'button_top_space',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Button Above Space', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 2,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 0,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .pt-plus-button-wrapper' => 'margin-top: {{SIZE}}{{UNIT}}',
				),
				'condition'   => array(
					'display_button' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'button_padding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'default'    => array(
					'top'      => '15',
					'right'    => '30',
					'bottom'   => '15',
					'left'     => '30',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_button .button-link-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'button_typography',
				'selector' => '{{WRAPPER}} .pt_plus_button .button-link-wrap',
			)
		);
		$this->add_responsive_control(
			'button_icon_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Size', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .pt_plus_button .button-link-wrap i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .pt_plus_button .button-link-wrap svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
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
			'btn_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_button .button-link-wrap' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pt_plus_button.button-style-7 .button-link-wrap:after' => 'border-color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'button_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap',
				'separator' => 'after',
				'condition' => array(
					'button_style!' => array( 'style-7', 'style-9' ),
				),
			)
		);
		$this->add_control(
			'button_border_style',
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
					'{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap' => 'border-style: {{VALUE}};',
				),
				'condition' => array(
					'button_style' => array( 'style-8' ),
				),
			)
		);

		$this->add_responsive_control(
			'button_border_width',
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
					'{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'button_style'         => array( 'style-8' ),
					'button_border_style!' => 'none',
				),
			)
		);

		$this->add_control(
			'button_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'button_style'         => array( 'style-8' ),
					'button_border_style!' => 'none',
				),
				'separator' => 'after',
			)
		);

		$this->add_responsive_control(
			'button_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'button_style' => array( 'style-8' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'button_shadow',
				'selector'  => '{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap',
				'condition' => array(
					'button_style' => array( 'style-8' ),
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
			'btn_text_hover_color',
			array(
				'label'     => esc_html__( 'Text Hover Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_button .button-link-wrap:hover,{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .pt_plus_button .hover_box_button' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'button_hover_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .pt_plus_button .hover_box_button',
				'separator' => 'after',
				'condition' => array(
					'button_style!' => array( 'style-7', 'style-9' ),
				),
			)
		);
		$this->add_control(
			'button_border_hover_color',
			array(
				'label'     => esc_html__( 'Hover Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .pt_plus_button .hover_box_button' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'button_style'         => array( 'style-8' ),
					'button_border_style!' => 'none',
				),
				'separator' => 'after',
			)
		);

		$this->add_responsive_control(
			'button_hover_radius',
			array(
				'label'      => esc_html__( 'Hover Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .pt_plus_button .hover_box_button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'button_style' => array( 'style-8' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'button_hover_shadow',
				'selector'  => '{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .pt_plus_button .hover_box_button',
				'condition' => array(
					'button_style' => array( 'style-8' ),
				),
			)
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_svg_styling',
			array(
				'label'     => esc_html__( 'Svg Style', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'image_icon' => array( 'svg' ),
				),
			)
		);
		$this->add_control(
			'section_svg_styling_options',
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
			'section_icon_styling',
			array(
				'label'      => esc_html__( 'Icon Style', 'tpebl' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'image_icon',
							'operator' => '==',
							'value'    => 'icon',
						),
					),
				),
			)
		);
		$this->add_control(
			'icon_style',
			array(
				'label'   => esc_html__( 'Icon Styles', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'square',
				'options' => array(
					''              => esc_html__( 'None', 'tpebl' ),
					'square'        => esc_html__( 'Square', 'tpebl' ),
					'rounded'       => esc_html__( 'Rounded', 'tpebl' ),
					'hexagon'       => esc_html__( 'Hexagon (Pro)', 'tpebl' ),
					'pentagon'      => esc_html__( 'Pentagon (Pro)', 'tpebl' ),
					'square-rotate' => esc_html__( 'Square Rotate (Pro)', 'tpebl' ),
				),
			)
		);
		$this->add_responsive_control(
			'icon_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Size', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 25,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner i.service-icon' => 'font-size: {{SIZE}}{{UNIT}} !important;',
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon i' => 'font-size: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon .icon-image-set' => 'max-width: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
			'icon_width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Width', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 250,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 50,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon' => 'width: {{SIZE}}{{UNIT}} !important;height: {{SIZE}}{{UNIT}} !important;line-height: {{SIZE}}{{UNIT}} !important;text-align: center;',
					'{{WRAPPER}} .pt_plus_info_box .info-box-bg-box .icon_shine_show' => 'background-position: -{{SIZE}}{{UNIT}} -{{SIZE}}{{UNIT}}, 0 0',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_icon_style' );
		$this->start_controls_tab(
			'tab_icon_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'icon_color_option',
			array(
				'label'       => esc_html__( 'Icon Color', 'tpebl' ),
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
				),
				'label_block' => false,
				'default'     => 'solid',
			)
		);
		$this->add_control(
			'icon_color',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon:before, {{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon i:before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon svg' => 'fill: {{VALUE}}; stroke: {{VALUE}};',
				),
				'condition' => array(
					'icon_color_option' => 'solid',
				),
				'separator' => 'after',
			)
		);
		$this->add_control(
			'icon_gradient_color1',
			array(
				'label'     => esc_html__( 'Color 1', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'orange',
				'condition' => array(
					'icon_color_option' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'icon_gradient_color1_control',
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
					'icon_color_option' => 'gradient',
				),
				'of_type'     => 'gradient',
			)
		);
		$this->add_control(
			'icon_gradient_color2',
			array(
				'label'     => esc_html__( 'Color 2', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'cyan',
				'condition' => array(
					'icon_color_option' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'icon_gradient_color2_control',
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
					'icon_color_option' => 'gradient',
				),
				'of_type'     => 'gradient',
			)
		);
		$this->add_control(
			'icon_gradient_style',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Gradient Style', 'tpebl' ),
				'default'   => 'linear',
				'options'   => l_theplus_get_gradient_styles(),
				'condition' => array(
					'icon_color_option' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'icon_gradient_angle',
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
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon:before,
					{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon i:before' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{icon_gradient_color1.VALUE}} {{icon_gradient_color1_control.SIZE}}{{icon_gradient_color1_control.UNIT}}, {{icon_gradient_color2.VALUE}} {{icon_gradient_color2_control.SIZE}}{{icon_gradient_color2_control.UNIT}});-webkit-transition: all 0.3s linear;-moz-transition: all 0.3s linear;-o-transition: all 0.3s linear;-ms-transition: all 0.3s linear;transition: all 0.3s linear;',
				),
				'condition'  => array(
					'icon_color_option'   => 'gradient',
					'icon_gradient_style' => array( 'linear' ),
				),
				'of_type'    => 'gradient',
				'separator'  => 'after',
			)
		);
		$this->add_control(
			'icon_gradient_position',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Position', 'tpebl' ),
				'options'   => l_theplus_get_position_options(),
				'default'   => 'center center',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon:before,
					{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon i:before' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{icon_gradient_color1.VALUE}} {{icon_gradient_color1_control.SIZE}}{{icon_gradient_color1_control.UNIT}}, {{icon_gradient_color2.VALUE}} {{icon_gradient_color2_control.SIZE}}{{icon_gradient_color2_control.UNIT}});-webkit-transition: all 0.3s linear;-moz-transition: all 0.3s linear;-o-transition: all 0.3s linear;-ms-transition: all 0.3s linear;transition: all 0.3s linear;',
				),
				'condition' => array(
					'icon_color_option'   => 'gradient',
					'icon_gradient_style' => 'radial',
				),
				'of_type'   => 'gradient',
				'separator' => 'after',

			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'icon_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'icon_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon' => 'border-color: {{VALUE}}',
				),
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'icon_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'icon_box_shadow',
				'selector' => '{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_icon_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'icon_hover_color_option',
			array(
				'label'       => esc_html__( 'Icon Hover Color', 'tpebl' ),
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
				),
				'label_block' => false,
				'default'     => 'solid',
			)
		);

		$this->add_control(
			'icon_hover_color',
			array(
				'label'     => esc_html__( 'Hover Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-icon:before,{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-icon i:before,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .service-icon:before,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .service-icon i:before' => 'color: {{VALUE}};background: transparent;-webkit-background-clip: unset;-webkit-text-fill-color: initial;',
				),
				'condition' => array(
					'icon_hover_color_option' => 'solid',
				),
				'separator' => 'after',
			)
		);
		$this->add_control(
			'icon_hover_gradient_color1',
			array(
				'label'     => esc_html__( 'Color 1', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'orange',
				'condition' => array(
					'icon_hover_color_option' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'icon_hover_gradient_color1_control',
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
					'icon_hover_color_option' => 'gradient',
				),
				'of_type'     => 'gradient',
			)
		);
		$this->add_control(
			'icon_hover_gradient_color2',
			array(
				'label'     => esc_html__( 'Color 2', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'cyan',
				'condition' => array(
					'icon_hover_color_option' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'icon_hover_gradient_color2_control',
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
					'icon_hover_color_option' => 'gradient',
				),
				'of_type'     => 'gradient',
			)
		);
		$this->add_control(
			'icon_hover_gradient_style',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Gradient Style', 'tpebl' ),
				'default'   => 'linear',
				'options'   => l_theplus_get_gradient_styles(),
				'condition' => array(
					'icon_hover_color_option' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'icon_hover_gradient_angle',
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
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-icon:before,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .service-icon:before,{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-icon i:before,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .service-icon i:before' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{icon_hover_gradient_color1.VALUE}} {{icon_hover_gradient_color1_control.SIZE}}{{icon_hover_gradient_color1_control.UNIT}}, {{icon_hover_gradient_color2.VALUE}} {{icon_hover_gradient_color2_control.SIZE}}{{icon_hover_gradient_color2_control.UNIT}})',
				),
				'condition'  => array(
					'icon_hover_color_option'   => 'gradient',
					'icon_hover_gradient_style' => array( 'linear' ),
				),
				'of_type'    => 'gradient',
				'separator'  => 'after',
			)
		);
		$this->add_control(
			'icon_hover_gradient_position',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Position', 'tpebl' ),
				'options'   => l_theplus_get_position_options(),
				'default'   => 'center center',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-icon:before,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .service-icon:before,{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-icon i:before,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .service-icon i:before' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{icon_hover_gradient_color1.VALUE}} {{icon_hover_gradient_color1_control.SIZE}}{{icon_hover_gradient_color1_control.UNIT}}, {{icon_hover_gradient_color2.VALUE}} {{icon_hover_gradient_color2_control.SIZE}}{{icon_hover_gradient_color2_control.UNIT}})',
				),
				'condition' => array(
					'icon_hover_color_option'   => 'gradient',
					'icon_hover_gradient_style' => 'radial',
				),
				'of_type'   => 'gradient',
				'separator' => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'icon_hover_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-icon,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .service-icon',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'icon_border_hover_color',
			array(
				'label'     => esc_html__( 'Hover Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-icon,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .service-icon' => 'border-color: {{VALUE}}',
				),
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'icon__hover_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-icon,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .service-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'icon_hover_box_shadow',
				'selector' => '{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-icon,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .service-icon',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'icon_overlay',
			array(
				'label'     => esc_html__( 'Icon Overlay', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'tpebl' ),
				'label_off' => esc_html__( 'Off', 'tpebl' ),
				'default'   => 'no',
				'separator' => 'before',
				'condition' => array(
					'info_box_layout' => 'single_layout',
					'main_style'      => array( 'style_1', 'style_3','style_4' ),
				),
			)
		);
		$this->add_control(
			'icon_overlay_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'info_box_layout' => 'single_layout',
					'main_style'      => array( 'style_1', 'style_3','style_4' ),
					'icon_overlay'    => 'yes',
				),
			)
		);
		$this->add_control(
			'icon_shine_effect',
			array(
				'label'     => esc_html__( 'Icon Shine Effect', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'tpebl' ),
				'label_off' => esc_html__( 'Off', 'tpebl' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'icon_shine_effect_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'info_box_layout'   => 'single_layout',
					'main_style'        => array( 'style_1', 'style_3','style_4' ),
					'icon_shine_effect' => 'yes',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_image_styling',
			array(
				'label'      => esc_html__( 'Image Style', 'tpebl' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'image_icon',
							'operator' => '==',
							'value'    => 'image',
						),
					),
				),
			)
		);
		$this->add_responsive_control(
			'img_max_width',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Max Width', 'tpebl' ),
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_info_box .service-img' => 'max-width: {{SIZE}}{{UNIT}} !important;',
				),
				'condition'  => array(
					'image_icon' => 'image',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_image_style' );
		$this->start_controls_tab(
			'tab_image_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_responsive_control(
			'image_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'image_box_shadow',
				'selector' => '{{WRAPPER}} .pt_plus_info_box .info-box-inner  .service-img',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_image_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_responsive_control(
			'image_hover_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-img,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .service-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'image_hover_box_shadow',
				'selector' => '{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover  .service-img,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active  .service-img',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_pin_text_styling',
			array(
				'label'     => esc_html__( 'Pin Text Style', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'info_box_layout'  => 'single_layout',
					'main_style'       => 'style_3',
					'display_pin_text' => 'yes',
				),
			)
		);
		$this->add_control(
			'section_pin_text_styling_options',
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
			'section_carousel_options_styling',
			array(
				'label'     => esc_html__( 'Carousel Options', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'info_box_layout' => 'carousel_layout',
				),
			)
		);
		$this->add_control(
			'section_carousel_options_styling_options',
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
			'section_extra_option_styling',
			array(
				'label' => esc_html__( 'Extra Options', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'box_padding',
			array(
				'label'      => esc_html__( 'Box Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'default'    => array(
					'top'    => '15',
					'right'  => '15',
					'bottom' => '15',
					'left'   => '15',
				),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .info-box-bg-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .pt_plus_info_box.info-box-style_3 .icon-overlay ' => 'top: calc(0% - {{TOP}}{{UNIT}});',
					'{{WRAPPER}} .pt_plus_info_box.info-box-style_1 .icon-overlay .m-r-16' => 'left: calc(0% - {{LEFT}}{{UNIT}});',
					'{{WRAPPER}} .pt_plus_info_box.info-box-style_2 .icon-overlay .m-l-16' => 'right: calc(0% - {{RIGHT}}{{UNIT}});',
				),
			)
		);
		$this->add_control(
			'vertical_center',
			array(
				'label'     => esc_html__( 'Vertical Center', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'tpebl' ),
				'label_off' => esc_html__( 'Off', 'tpebl' ),
				'default'   => 'no',
				'condition' => array(
					'main_style' => array( 'style_1','style_4' ),
				),
			)
		);

		$this->add_control(
			'tilt_parallax',
			array(
				'label'       => esc_html__( 'Tilt 3D Parallax', 'tpebl' ),
				'type'        => Controls_Manager::SWITCHER,
				'label_on'    => esc_html__( 'Yes', 'tpebl' ),
				'label_off'   => esc_html__( 'No', 'tpebl' ),
				'render_type' => 'template',
				'separator'   => 'before',
				'condition'   => array(
					'main_style' => array( 'style_3' ),
				),
			)
		);
		$this->add_control(
			'Parallax_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'tilt_parallax' => 'yes',
				),
			)
		);
		$this->add_control(
			'messy_column',
			array(
				'label'     => esc_html__( 'Messy Columns', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'tpebl' ),
				'label_off' => esc_html__( 'Off', 'tpebl' ),
				'default'   => 'no',
				'condition' => array(
					'info_box_layout' => 'carousel_layout',
				),
			)
		);
		$this->add_control(
			'messy_column_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'info_box_layout' => 'carousel_layout',
					'messy_column'    => 'yes',
				),
			)
		);

		$this->add_control(
			'min_height_section',
			array(
				'label'     => esc_html__( 'Minimum Height Section', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Yes', 'tpebl' ),
				'label_off' => esc_html__( 'No', 'tpebl' ),
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'minimum_height',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Minimum Height', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 40,
						'max'  => 700,
						'step' => 5,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 350,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .info-box-bg-box' => 'min-height: {{SIZE}}{{UNIT}};display: -webkit-box;display: -ms-flexbox;display: flex;-webkit-box-orient: vertical;-webkit-align-items: center;-ms-align-items: center;align-items: center;',
					'{{WRAPPER}} .pt_plus_info_box.info-box-style_3 .info-box-inner .info-box-bg-box' => '-webkit-justify-content: center;-moz-justify-content: center;-ms-justify-content: center;justify-content: center;',
					'{{WRAPPER}} .pt_plus_info_box.info-box-style_2 .info-box-inner .info-box-bg-box' => '-webkit-justify-content: flex-end;-moz-justify-content: flex-end;-ms-justify-content: flex-end;justify-content: flex-end;',
				),
				'condition'   => array(
					'min_height_section' => 'yes',
				),
			)
		);
		$this->add_control(
			'box_hover_effects',
			array(
				'label'     => esc_html__( 'Box Hover Effects', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => l_theplus_get_content_hover_effect_options(),
				'separator' => 'before',
			)
		);
		$this->add_control(
			'responsive_visible_opt',
			array(
				'label'     => esc_html__( 'Responsive Visibility', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'separator' => 'before',
			)
		);
		$this->add_control(
			'desktop_opt',
			array(
				'label'     => esc_html__( 'Desktop', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'condition' => array(
					'responsive_visible_opt' => 'yes',
				),
			)
		);
		$this->add_control(
			'tablet_opt',
			array(
				'label'     => esc_html__( 'Tablet', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'condition' => array(
					'responsive_visible_opt' => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_opt',
			array(
				'label'     => esc_html__( 'Mobile', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'condition' => array(
					'responsive_visible_opt' => 'yes',
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

		include L_THEPLUS_PATH . 'modules/widgets/theplus-needhelp.php';
		include L_THEPLUS_PATH . 'modules/widgets/theplus-profeatures.php';
	}

	/**
	 * Render Infobox
	 *
	 * Written in PHP and HTML.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		$info_box_layout = ! empty( $settings['info_box_layout'] ) ? $settings['info_box_layout'] : '';
		$main_style      = ! empty( $settings['main_style'] ) ? $settings['main_style'] : '';

		$hover_class       = '';
		$box_hover_effects = ! empty( $settings['box_hover_effects'] ) ? $settings['box_hover_effects'] : '';

		if ( 'push' === $box_hover_effects ) {
			$hover_class .= 'content_hover_push';
		}

		$animation_effects = ! empty( $settings['animation_effects'] ) ? $settings['animation_effects'] : '';
		$animate_duration  = ! empty( $settings['animate_duration']['size'] ) ? $settings['animate_duration']['size'] : 50;

		$animation_delay = ! empty( $settings['animation_delay']['size'] ) ? $settings['animation_delay']['size'] : 50;

		$out_duration = ! empty( $settings['animation_out_duration_default'] ) ? $settings['animation_out_duration_default'] : '';
		$ani_duration = ! empty( $settings['animation_duration_default'] ) ? $settings['animation_duration_default'] : '';

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

		$service_title  = '';
		$description    = '';
		$service_img    = '';
		$service_center = '';
		$service_align  = '';
		$service_border = '';
		$service_space  = '';

		$service_icon_style = '';
		$serice_box_border  = '';
		$serice_img_border  = '';
		$border_right_css   = '';

		$imge_content = '';
		$title_css    = '';
		$subtitle_css = '';
		$output       = '';

		$text_align = ! empty( $settings['text_align'] ) ? $settings['text_align'] : '';
		$box_border = ! empty( $settings['box_border'] ) ? $settings['box_border'] : '';
		$var_cent   = ! empty( $settings['vertical_center'] ) ? $settings['vertical_center'] : '';

		if ( 'left' === $text_align ) {
			$service_align = 'text-left';
		}

		if ( 'center' === $text_align ) {
			$service_align = 'text-center';
		}

		if ( 'right' === $text_align ) {
			$service_align = 'text-right';
		}

		if ( 'yes' === $box_border ) {
			$serice_box_border = 'service-border-box';
		}

		if ( 'yes' === $var_cent ) {
			$service_center = 'vertical-center';
		}

		$url_link = ! empty( $settings['url_link'] ) ? $settings['url_link'] : '';

		if ( ! empty( $url_link['url'] ) ) {
			$this->add_render_attribute( 'box_link', 'href', esc_url( $url_link['url'] ) );

			if ( $url_link['is_external'] ) {
				$this->add_render_attribute( 'box_link', 'target', '_blank' );
			}

			if ( $url_link['nofollow'] ) {
				$this->add_render_attribute( 'box_link', 'rel', 'nofollow' );
			}
		}

		$image_icon = ! empty( $settings['image_icon'] ) ? $settings['image_icon'] : '';

		if ( 'image' === $image_icon ) {
			$image_alt = '';
			$info_img  = ! empty( $settings['select_image'] ) ? $settings['select_image'] : '';

			$img_src = '';
			if ( ! empty( $info_img['url'] ) ) {
				$image_id = $info_img['id'];
				$img_src  = tp_get_image_rander( $image_id, $settings['select_image_thumbnail_size'], array( 'class' => 'service-img' ) );
			}

			$service_a_start = '';
			$service_a_end   = '';

			if ( ! empty( $url_link['url'] ) ) {
				$service_a_start = '<a ' . $this->get_render_attribute_string( 'box_link' ) . ' >';
				$service_a_end   = '</a>';
			}

			$service_img = $service_a_start . $img_src . $service_a_end;
		}

		$icon_style = ! empty( $settings['icon_style'] ) ? $settings['icon_style'] : '';

		if ( 'square' === $icon_style && 'icon' === $image_icon ) {
			$service_icon_style = 'icon-squre';
		}

		if ( 'rounded' === $icon_style && 'icon' === $image_icon ) {
			$service_icon_style = 'icon-rounded';
		}

		$icon_fstyle = ! empty( $settings['icon_font_style'] ) ? $settings['icon_font_style'] : '';

		if ( 'icon' === $image_icon ) {

			if ( 'font_awesome' === $icon_fstyle ) {
				$icons = ! empty( $settings['icon_fontawesome'] ) ? $settings['icon_fontawesome'] : '';
			} elseif ( 'font_awesome_5' === $icon_fstyle ) {
				ob_start();
				\Elementor\Icons_Manager::render_icon( $settings['icon_fontawesome_5'], array( 'aria-hidden' => 'true' ) );
				$icons = ob_get_contents();
				ob_end_clean();
			} else {

				$icons = '';
			}

			if ( ! empty( $icons ) ) {
				$si_bg = tp_bg_lazyLoad( $settings['icon_background_image'], $settings['icon_hover_background_image'] );

				if ( ! empty( $icon_fstyle ) && 'font_awesome_5' === $icon_fstyle ) {
					$service_img = '<div class="service-icon-wrap"><span class=" service-icon ' . $si_bg . ' ' . esc_attr( $service_icon_style ) . '">' . $icons . '</span></div>';
				} else {
					$service_img = '<div class="service-icon-wrap"><i class=" ' . esc_attr( $icons ) . ' service-icon ' . $si_bg . ' ' . esc_attr( $service_icon_style ) . '"></i></div>';
				}
			}
		}

		$border_cright = ! empty( $settings['border_check_right'] ) ? $settings['border_check_right'] : '';
		if ( 'yes' === $border_cright ) {
			$serice_img_border = 'service-img-border';
			$border_right_css  = ' style="';

			$border_rcolor = ! empty( $settings['border_right_color'] ) ? $settings['border_right_color'] : '';

			if ( ! empty( $border_rcolor ) ) {
				$border_right_css .= 'border-color: ' . esc_attr( $border_rcolor ) . ';';
			}

			$border_right_css .= '"';
		}

		$title_tag  = ! empty( $settings['title_tag'] ) ? $settings['title_tag'] : 'div';
		$info_title = ! empty( $settings['title'] ) ? $settings['title'] : '';

		if ( ! empty( $info_title ) ) {
			$service_title = '<a ' . $this->get_render_attribute_string( 'box_link' ) . ' ><' . l_theplus_validate_html_tag( $title_tag ) . ' class="service-title "> ' . wp_kses_post( $info_title ) . ' </' . l_theplus_validate_html_tag( $title_tag ) . '></a>';
		}

		$border_check = ! empty( $settings['border_check'] ) ? $settings['border_check'] : '';
		if ( 'yes' === $border_check ) {
			$service_border = '<div class="service-border"> </div>';
		}

		$content_desc = ! empty( $settings['content_desc'] ) ? $settings['content_desc'] : '';
		if ( ! empty( $content_desc ) ) {
			$description = '<div class="service-desc"> ' . wp_kses_post( $content_desc ) . ' </div>';
		}

		$the_button = '';

		$btn_on = ! empty( $settings['display_button'] ) ? $settings['display_button'] : '';

		if ( 'yes' === $btn_on ) {

			$btn_link = ! empty( $settings['button_link'] ) ? $settings['button_link'] : '';

			if ( ! empty( $btn_link['url'] ) ) {
				$this->add_render_attribute( 'button', 'href', esc_url( $btn_link['url'] ) );

				if ( $btn_link['is_external'] ) {
					$this->add_render_attribute( 'button', 'target', '_blank' );
				}

				if ( $btn_link['nofollow'] ) {
					$this->add_render_attribute( 'button', 'rel', 'nofollow' );
				}
			}

			$bll_bg = tp_bg_lazyLoad( $settings['button_background_image'], $settings['button_hover_background_image'] );
			$this->add_render_attribute( 'button', 'class', 'button-link-wrap' . $bll_bg );

			$hbc_bg = tp_bg_lazyLoad( $settings['icon_background_image'] );

			$hover_box_class = ! empty( $settings['hover_info_button'] ) && 'yes' === $settings['hover_info_button'] ? ' hover_box_button' . $hbc_bg : '';
			$this->add_render_attribute( 'button', 'class', $hover_box_class );
			$this->add_render_attribute( 'button', 'role', 'button' );

			$button_style = ! empty( $settings['button_style'] ) ? $settings['button_style'] : '';
			$button_text  = ! empty( $settings['button_text'] ) ? $settings['button_text'] : '';

			$btn_uid = uniqid( 'btn' );

			$data_class = $btn_uid;

			$data_class .= ' button-' . $button_style . ' ';

			$the_button = '<div class="pt-plus-button-wrapper">';

				$the_button .= '<div class="button_parallax">';

					$the_button .= '<div class="ts-button">';

						$the_button .= '<div class="pt_plus_button ' . esc_attr( $data_class ) . '">';

							$the_button .= '<div class="animted-content-inner">';

									$the_button .= '<a ' . $this->get_render_attribute_string( 'button' ) . '>';

								$the_button .= $this->render_text();

									$the_button .= '</a>';

							$the_button .= '</div>';

						$the_button .= '</div>';

					$the_button .= '</div>';

				$the_button .= '</div>';

			$the_button .= '</div>';
		}

		if ( 'single_layout' === $info_box_layout ) {
				$output   = '<div class="info-box-inner content_hover_effect ' . esc_attr( $hover_class ) . '">';
				$ll_bgbox = tp_bg_lazyLoad( $settings['box_background_image'], $settings['box_hover_background_image'] );

				$lazy_bg    = function_exists( 'tp_has_lazyload' ) ? tp_bg_lazyLoad( $settings['box_background_image'], $settings['box_hover_background_image'] ) : '';
			    $lazy_ol_bg = function_exists( 'tp_has_lazyload' ) ? tp_bg_lazyLoad( $settings['box_hover_background_image'] ) : '';

			if ( 'style_1' === $main_style ) {

				$output     .= '<div class="info-box-bg-box  ' . esc_attr( $serice_box_border ) . ' ' . esc_attr( $ll_bgbox ) . '">';
					$output .= '<div class="service-media text-left ' . esc_attr( $service_center ) . ' ">';

				if ( ! empty( $service_img ) ) {
					$output .= '<div class="m-r-16  ' . esc_attr( $serice_img_border ) . '" ' . $border_right_css . '> ' . $service_img . ' </div>';
				}
						$output .= '<div class="service-content ">';

							$output .= $service_title;

							$output .= $service_border;

							$output .= $description;

							$output .= $the_button;

						$output .= '</div>';

					$output .= '</div>';

					$output .= '<div class="infobox-overlay-color"></div>';

				$output .= '</div>';
			}

			if ( 'style_3' === $main_style ) {
				$output .= '<div class="info-box-bg-box ' . esc_attr( $serice_box_border ) . ' ' . esc_attr( $ll_bgbox ) . '">';

					$output .= '<div class="' . esc_attr( $service_align ) . '">';

						$output .= '<div class="service-center">';

							$output .= '<div class="info-icon-content">' . $service_img . '</div>';

							$output .= $service_title;

							$output .= $service_border;

							$output .= $description;

							$output .= $the_button;

							$output .= '</div>';

					$output .= '</div>';

					$output .= '<div class="infobox-overlay-color"></div>';

				$output .= '</div>';
			}

			if ( 'style_4' === $main_style ) {
				$output                 .= '<div class="info-box-bg-box ' . esc_attr( $lazy_bg ) . ' ' . esc_attr( $serice_box_border ) . '">';
					$output             .= '<div class="">';
						$output         .= '<div class="service-media service-left ' . esc_attr( $service_center ) . '">';
							$output     .= $service_img;
							$output     .= '<div class="service-content">';
								$output .= $service_title;
							$output     .= '</div>';
						$output         .= '</div>';
							$output     .= $service_border;
							$output     .= $description;
							$output     .= $the_button;
					$output             .= '</div>';
					$output             .= '<div class="infobox-overlay-color ' . esc_attr( $lazy_ol_bg ) . '"></div>';
				$output                 .= '</div>';
			}

			$output .= '</div>';
		}

		$visiblity_hide = '';
		if ( ! empty( $settings['responsive_visible_opt'] ) && 'yes' === $settings['responsive_visible_opt'] ) {
			$visiblity_hide .= ( 'yes' !== $settings['desktop_opt'] && empty( $settings['desktop_opt'] ) ) ? 'hide-desktop ' : '';
			$visiblity_hide .= ( 'yes' !== $settings['tablet_opt'] && empty( $settings['tablet_opt'] ) ) ? 'hide-tablet ' : '';
			$visiblity_hide .= ( 'yes' !== $settings['mobile_opt'] && empty( $settings['mobile_opt'] ) ) ? 'hide-mobile ' : '';
		}

		$uid = uniqid( 'info_box' );

		$info_box = '<div id="' . esc_attr( $uid ) . '" class="pt_plus_info_box  ' . esc_attr( $uid ) . ' info-box-' . esc_attr( $main_style ) . ' ' . esc_attr( $animated_class ) . '  ' . esc_attr( $service_space ) . ' ' . $visiblity_hide . ' "  data-id="' . esc_attr( $uid ) . '" ' . $animation_attr . '>';

			$info_box .= '<div class="post-inner-loop ">';

				$info_box .= $output;

			$info_box .= '</div>';

		$info_box .= '</div>';

		echo $info_box;
	}

	/**
	 * Used to get render text
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 *
	 * @return object $response feed object.
	 */
	protected function render_text() {
		$icons_after  = '';
		$icons_before = '';
		$settings     = $this->get_settings_for_display();

		$button_style = ! empty( $settings['button_style'] ) ? $settings['button_style'] : '';
		$before_after = ! empty( $settings['before_after'] ) ? $settings['before_after'] : '';
		$button_text  = ! empty( $settings['button_text'] ) ? $settings['button_text'] : '';
		$icon_font    = ! empty( $settings['button_icon_style'] ) ? $settings['button_icon_style'] : '';

		if ( 'font_awesome' === $icon_font ) {
			$icons = ! empty( $settings['button_icon'] ) ? $settings['button_icon'] : '';
		} elseif ( 'font_awesome_5' === $icon_font ) {
			ob_start();
			\Elementor\Icons_Manager::render_icon( $settings['button_icon_5'], array( 'aria-hidden' => 'true' ) );
			$icons = ob_get_contents();
			ob_end_clean();
		} else {
			$icons = '';
		}

		if ( 'before' === $before_after && ! empty( $icons ) ) {

			if ( ! empty( $icon_font ) && 'font_awesome_5' === $icon_font ) {
				$icons_before = '<span class="btn-icon button-before">' . $icons . '</span>';
			} else {
				$icons_before = '<i class="btn-icon button-before ' . esc_attr( $icons ) . '"></i>';
			}
		}

		if ( 'after' === $before_after && ! empty( $icons ) ) {

			if ( ! empty( $icon_font ) && 'font_awesome_5' === $icon_font ) {
				$icons_after = '<span class="btn-icon button-after">' . $icons . '</span>';
			} else {
				$icons_after = '<i class="btn-icon button-after ' . esc_attr( $icons ) . '"></i>';
			}
		}

		if ( 'style-8' === $button_style ) {
			$button_text = $icons_before . $button_text . $icons_after;
		}

		return $button_text;
	}
}