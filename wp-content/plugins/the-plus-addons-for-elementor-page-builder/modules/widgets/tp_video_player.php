<?php
/**
 * Widget Name: Video Player
 * Description: Video player.
 * Author: Theplus
 * Author URI: https://posimyth.com
 *
 * @package ThePlus
 */

namespace TheplusAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class L_ThePlus_Video_Player
 */
class L_ThePlus_Video_Player extends Widget_Base {

	/**
	 * Get Widget Name.
	 *
	 * @since 1.0.0
	 *
	 * @version 5.4.2
	 */
	public function get_name() {
		return 'tp-video-player';
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
	 *
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Video', 'tpebl' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.0.0
	 *
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-video-camera theplus_backend_icon';
	}

	/**
	 * Get Widget categories.
	 *
	 * @since 1.0.0
	 *
	 * @version 5.4.2
	 */
	public function get_categories() {
		return array( 'plus-essential' );
	}
	/**
	 * Get Widget keywords.
	 *
	 * @since 1.0.0
	 *
	 * @version 5.4.2
	 */
	public function get_keywords() {
		return array( 'video', 'media', 'player', 'multimedia', 'youtube', 'vimeo', 'mp4', 'embed', 'playback', 'watch', 'stream', 'online', 'clip', 'film', 'movie', 'visual', 'recording', 'motion picture' );
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
	 *
	 * @version 5.4.2
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Video', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'video_type',
			array(
				'label'   => esc_html__( 'Source', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'youtube',
				'options' => array(
					'youtube'     => esc_html__( 'Youtube', 'tpebl' ),
					'vimeo'       => esc_html__( 'Vimeo', 'tpebl' ),
					'self-hosted' => esc_html__( 'Self Hosted', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'youtube_id',
			array(
				'type'        => Controls_Manager::TEXT,
				'label'       => esc_html__( 'YouTube Id', 'tpebl' ),
				'label_block' => true,
				'separator'   => 'before',
				'default'     => esc_html__( 'TJ1SDXbij8Y', 'tpebl' ),
				'placeholder' => esc_html__( 'YouTube ID : TJ1SDXbij8Y', 'tpebl' ),
				'dynamic'     => array( 'active' => true ),
				'condition'   => array(
					'video_type' => 'youtube',
				),
			)
		);
		$this->add_control(
			'vimeo_id',
			array(
				'type'        => Controls_Manager::TEXT,
				'label'       => esc_html__( 'Vimeo Id', 'tpebl' ),
				'label_block' => true,
				'separator'   => 'before',
				'default'     => esc_html__( '27246366', 'tpebl' ),
				'placeholder' => esc_html__( 'Vimeo ID : 27246366', 'tpebl' ),
				'dynamic'     => array( 'active' => true ),
				'condition'   => array(
					'video_type' => 'vimeo',
				),
			)
		);
		$this->add_control(
			'mp4_link',
			array(
				'label'      => esc_html__( 'Mp4 Video Link', 'tpebl' ),
				'type'       => Controls_Manager::MEDIA,
				'media_type' => 'video',
				'dynamic'    => array( 'active' => true ),
				'condition'  => array(
					'video_type' => 'self-hosted',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'content_video_option',
			array(
				'label' => esc_html__( 'Video Options', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'video_options',
			array(
				'label'     => esc_html__( 'Video Options', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'video_autoplay',
			array(
				'label' => esc_html__( 'AutoPlay', 'tpebl' ),
				'type'  => Controls_Manager::SWITCHER,
			)
		);

		$this->add_control(
			'video_muted',
			array(
				'label' => esc_html__( 'Mute', 'tpebl' ),
				'type'  => Controls_Manager::SWITCHER,
			)
		);
		$this->add_control(
			'video_loop',
			array(
				'label' => esc_html__( 'Loop', 'tpebl' ),
				'type'  => Controls_Manager::SWITCHER,
			)
		);
		$this->add_control(
			'video_controls',
			array(
				'label'     => esc_html__( 'Controls', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'default'   => 'yes',
				'condition' => array(
					'video_type!' => 'vimeo',
				),
			)
		);

		$this->add_control(
			'video_touch_disable',
			array(
				'label'     => esc_html__( 'Video Touch Disable', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'No', 'tpebl' ),
				'label_on'  => esc_html__( 'Yes', 'tpebl' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'modest_branding',
			array(
				'label'     => esc_html__( 'Modest Branding', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'condition' => array(
					'video_type'     => array( 'youtube' ),
					'video_controls' => 'yes',
				),
			)
		);
		$this->add_control(
			'video_color',
			array(
				'label'     => esc_html__( 'Controls Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'condition' => array(
					'video_type' => array( 'vimeo' ),
				),
			)
		);
		$this->add_control(
			'rel',
			array(
				'label'     => esc_html__( 'Related Videos', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'condition' => array(
					'video_type' => 'youtube',
				),
			)
		);
		$this->add_control(
			'rel_nots',
			array(
				'type'        => Controls_Manager::RAW_HTML,
				'raw'         => '<p class="tp-controller-notice"><i>Choose from Related or Random videos at the end.</i></p>',
				'label_block' => true,
				'condition'   => array(
					'video_type' => 'youtube',
				),
			)
		);

		$this->add_control(
			'yt_privacy',
			array(
				'label'       => esc_html__( 'Privacy Mode', 'tpebl' ),
				'type'        => Controls_Manager::SWITCHER,
				'description' => wp_kses_post( '<p class="tp-controller-notice"><i>When you turn on privacy mode, YouTube won\'t store information about visitors on your website unless they play the video.</i></p>', ),
				'condition'   => array(
					'video_type' => 'youtube',
				),
			)
		);

		$this->add_control(
			'vimeo_title',
			array(
				'label'     => esc_html__( 'Intro Title', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'default'   => 'yes',
				'condition' => array(
					'video_type' => 'vimeo',
				),
			)
		);

		$this->add_control(
			'vimeo_portrait',
			array(
				'label'     => esc_html__( 'Intro Portrait', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'default'   => 'yes',
				'condition' => array(
					'video_type' => 'vimeo',
				),
			)
		);

		$this->add_control(
			'vimeo_byline',
			array(
				'label'     => esc_html__( 'Intro Byline', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'default'   => 'yes',
				'condition' => array(
					'video_type' => 'vimeo',
				),
			)
		);

		$this->add_control(
			'view',
			array(
				'label'   => esc_html__( 'View', 'tpebl' ),
				'type'    => Controls_Manager::HIDDEN,
				'default' => 'youtube',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_image_icon',
			array(
				'label' => esc_html__( 'Image/Icon', 'tpebl' ),
			)
		);
		$this->add_control(
			'image_banner',
			array(
				'label'   => esc_html__( 'Only Icon / Full Banner', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'banner_img',
				'options' => array(
					'only_icon'  => esc_html__( 'Only Icon image', 'tpebl' ),
					'banner_img' => esc_html__( 'Banner Image', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'only_img',
			array(
				'label'     => esc_html__( 'Choose Image', 'tpebl' ),
				'type'      => Controls_Manager::MEDIA,
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'image_banner' => 'only_icon',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'only_img_thumbnail',
				'default'   => 'full',
				'separator' => 'none',
				'condition' => array(
					'image_banner' => 'only_icon',
				),
			)
		);

		$this->add_control(
			'icon_align',
			array(
				'label'     => esc_html__( 'Icon Align', 'tpebl' ),
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
				'condition' => array(
					'image_banner' => 'only_icon',
				),
			)
		);
		$this->add_control(
			'display_banner_image',
			array(
				'label'     => esc_html__( 'Banner Image', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'Off', 'tpebl' ),
				'label_on'  => esc_html__( 'On', 'tpebl' ),
				'default'   => 'no',
				'condition' => array(
					'image_banner' => 'banner_img',
				),
			)
		);
		$this->add_control(
			'banner_image',
			array(
				'label'     => esc_html__( 'Image Upload', 'tpebl' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url' => L_THEPLUS_URL . '/assets/images/tp-placeholder.jpg',
				),
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'display_banner_image' => 'yes',
					'image_banner'         => 'banner_img',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'banner_image_thumbnail',
				'default'   => 'full',
				'separator' => 'none',
				'condition' => array(
					'display_banner_image' => 'yes',
					'image_banner'         => 'banner_img',
				),
			)
		);
		$this->add_control(
			'image_video',
			array(
				'label'     => esc_html__( 'Icon Upload', 'tpebl' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url' => '',
				),
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'display_banner_image' => 'yes',
					'image_banner'         => 'banner_img',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'image_video_thumbnail',
				'default'   => 'full',
				'separator' => 'none',
				'condition' => array(
					'display_banner_image' => 'yes',
					'image_banner'         => 'banner_img',
				),
			)
		);
		$this->add_control(
			'video_title',
			array(
				'type'        => Controls_Manager::TEXT,
				'label'       => esc_html__( 'Title of Video', 'tpebl' ),
				'label_block' => true,
				'separator'   => 'before',
				'default'     => esc_html__( 'Video Title', 'tpebl' ),
				'dynamic'     => array( 'active' => true ),
				'condition'   => array(
					'display_banner_image' => 'yes',
					'image_banner'         => 'banner_img',
				),
			)
		);
		$this->add_control(
			'video_desc',
			array(
				'type'        => Controls_Manager::TEXTAREA,
				'label'       => esc_html__( 'Video Description', 'tpebl' ),
				'label_block' => true,
				'separator'   => 'before',
				'default'     => '',
				'dynamic'     => array( 'active' => true ),
				'condition'   => array(
					'display_banner_image' => 'yes',
					'image_banner'         => 'banner_img',
				),
			)
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'section_schema_markup',
			array(
				'label' => esc_html__( 'Schema Markup', 'tpebl' ),
			)
		);
		$this->add_control(
			'markupSch',
			array(
				'label'     => esc_html__( 'Schema Markup', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'Off', 'tpebl' ),
				'label_on'  => esc_html__( 'On', 'tpebl' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'video_date',
			array(
				'label'     => __( 'Video Date', 'tpebl' ),
				'type'      => Controls_Manager::DATE_TIME,
				'condition' => array(
					'markupSch' => 'yes',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_styling',
			array(
				'label'     => esc_html__( 'Video Title', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'display_banner_image' => 'yes',
					'image_banner'         => 'banner_img',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'video_title_typography',
				'label'     => esc_html__( 'Title Typography', 'tpebl' ),
				'selector'  => '{{WRAPPER}} .ts-video-caption-text',
				'separator' => 'before',
				'condition' => array(
					'display_banner_image' => 'yes',
				),
			)
		);
		$this->add_control(
			'title_color',
			array(
				'label'     => esc_html__( 'Title Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ts-video-caption-text' => 'color: {{VALUE}};',
				),
				'default'   => '#313131',
				'condition' => array(
					'display_banner_image' => 'yes',
				),
			)
		);
		$this->add_control(
			'background_color',
			array(
				'label'     => esc_html__( 'Title Background Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ts-video-caption-text' => 'background: {{VALUE}};',
				),
				'default'   => '#ffffff',
				'condition' => array(
					'display_banner_image' => 'yes',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_desc_styling',
			array(
				'label'     => esc_html__( 'Video Description', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'display_banner_image' => 'yes',
					'image_banner'         => 'banner_img',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'video_desc_typography',
				'label'     => esc_html__( 'Description Typography', 'tpebl' ),
				'selector'  => '{{WRAPPER}} .tp-video-desc',
				'separator' => 'before',
				'condition' => array(
					'display_banner_image' => 'yes',
				),
			)
		);
		$this->add_control(
			'desc_color',
			array(
				'label'     => esc_html__( 'Description Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-video-desc' => 'color: {{VALUE}};',
				),
				'default'   => '#888',
				'condition' => array(
					'display_banner_image' => 'yes',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_video_styling',
			array(
				'label' => esc_html__( 'Video Styling', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'popup_video',
			array(
				'label'     => esc_html__( 'Video On Popup', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'Off', 'tpebl' ),
				'label_on'  => esc_html__( 'On', 'tpebl' ),
				'default'   => 'no',
				'condition' => array(
					'image_banner' => 'banner_img',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_effect_video' );

		$this->start_controls_tab(
			'tab_effect_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'video_border',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .pt_plus_video-box-shadow',
			)
		);
		$this->add_responsive_control(
			'video_bor_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_video-box-shadow' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};overflow:hidden;',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'box_shadow',
				'label'    => esc_html__( 'Box Shadow', 'tpebl' ),
				'selector' => '{{WRAPPER}} .pt_plus_video-box-shadow',
			)
		);
		$this->add_control(
			'video_transform',
			array(
				'type'        => Controls_Manager::TEXT,
				'label'       => esc_html__( 'Transform Effect', 'tpebl' ),
				'label_block' => true,
				'separator'   => 'before',
				'placeholder' => esc_html__( 'rotate(2deg) skew(50deg)', 'tpebl' ),
				'default'     => '',
			)
		);
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'name'     => 'css_filters',
				'selector' => '{{WRAPPER}} .pt_plus_video-box-shadow',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_effect_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'video_border_h',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .pt_plus_video-box-shadow:hover',
			)
		);
		$this->add_responsive_control(
			'video_bor_radius_h',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_video-box-shadow:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};overflow:hidden;',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'hover_box_shadow',
				'label'    => esc_html__( 'Hover Box Shadow', 'tpebl' ),
				'selector' => '{{WRAPPER}} .pt_plus_video-box-shadow:hover',
			)
		);
		$this->add_control(
			'hover_video_transform',
			array(
				'type'        => Controls_Manager::TEXT,
				'label'       => esc_html__( 'Hover Transform Effect', 'tpebl' ),
				'label_block' => true,
				'placeholder' => esc_html__( 'rotate(2deg) skew(50deg)', 'tpebl' ),
				'default'     => '',
			)
		);
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'name'     => 'css_filters_hover',
				'selector' => '{{WRAPPER}} .pt_plus_video-box-shadow:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon_styling',
			array(
				'label' => esc_html__( 'Icon Setting', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'icon_continuous_animation',
			array(
				'label'       => esc_html__( 'Continuous Animation', 'tpebl' ),
				'type'        => Controls_Manager::SWITCHER,
				'label_on'    => esc_html__( 'Yes', 'tpebl' ),
				'label_off'   => esc_html__( 'No', 'tpebl' ),
				'render_type' => 'template',
				'separator'   => 'before',
			)
		);
		$this->add_control(
			'icon_animation_effect',
			array(
				'label'       => esc_html__( 'Animation Effect', 'tpebl' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'pulse',
				'options'     => array(
					'pulse'      => esc_html__( 'Pulse', 'tpebl' ),
					'floating'   => esc_html__( 'Floating', 'tpebl' ),
					'tossing'    => esc_html__( 'Tossing', 'tpebl' ),
					'rotating'   => esc_html__( 'Rotating', 'tpebl' ),
					'drop_waves' => esc_html__( 'Drop Waves', 'tpebl' ),
				),
				'render_type' => 'template',
				'condition'   => array(
					'icon_continuous_animation' => 'yes',
				),
			)
		);
		$this->add_control(
			'icon_animation_hover',
			array(
				'label'       => esc_html__( 'Hover Animation', 'tpebl' ),
				'type'        => Controls_Manager::SWITCHER,
				'label_on'    => esc_html__( 'Yes', 'tpebl' ),
				'label_off'   => esc_html__( 'No', 'tpebl' ),
				'render_type' => 'template',
				'condition'   => array(
					'icon_continuous_animation' => 'yes',
				),
			)
		);
		$this->add_control(
			'icon_animation_duration',
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
					'size' => 2.5,
				),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_video_player .tp-video-icon-inner,{{WRAPPER}} .pt_plus_video_player .tp-video-popup,{{WRAPPER}} .pt_plus_video_player .tp-video-popup-icon .tp-video-icon' => 'animation-duration: {{SIZE}}{{UNIT}};-webkit-animation-duration: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'icon_continuous_animation' => 'yes',
					'icon_animation_effect!'    => 'drop_waves',
				),
			)
		);
		$this->add_control(
			'icon_transform_origin',
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
					'{{WRAPPER}} .pt_plus_video_player .tp-video-icon-inner,{{WRAPPER}} .pt_plus_video_player .tp-video-popup,{{WRAPPER}} .pt_plus_video_player .tp-video-popup-icon .tp-video-icon' => '-webkit-transform-origin: {{VALUE}};-moz-transform-origin: {{VALUE}};-ms-transform-origin: {{VALUE}};-o-transform-origin: {{VALUE}};transform-origin: {{VALUE}};',
				),
				'render_type' => 'template',
				'condition'   => array(
					'icon_continuous_animation' => 'yes',
					'icon_animation_effect'     => 'rotating',
				),
			)
		);
		$this->add_control(
			'drop_waves_color',
			array(
				'label'     => esc_html__( 'Drop Wave Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_video_player .image-drop_waves:after,{{WRAPPER}} .pt_plus_video_player .hover_drop_waves:after' => 'background: {{VALUE}}',
				),
				'condition' => array(
					'icon_continuous_animation' => 'yes',
					'icon_animation_effect'     => 'drop_waves',
				),
			)
		);
		$this->add_control(
			'icon_radius',
			array(
				'label'      => esc_html__( 'Icon Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_video_player .tp-video-icon-inner,{{WRAPPER}} .pt_plus_video_player .tp-video-popup,{{WRAPPER}} .pt_plus_video_player .tp-video-popup-icon .tp-video-icon,{{WRAPPER}} .pt_plus_video_player .image-drop_waves:after,{{WRAPPER}} .pt_plus_video_player .hover_drop_waves:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'play_icon_size',
			array(
				'label'      => esc_html__( 'Icon Size', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => 'px',
				'range'      => array(
					'px' => array(
						'min'  => 20,
						'max'  => 500,
						'step' => 2,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 100,
				),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_video_player .tp-video-icon-inner,{{WRAPPER}} .pt_plus_video_player .tp-video-popup,{{WRAPPER}} .pt_plus_video_player .tp-video-popup-icon' => 'max-width: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};max-height: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
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
	 * Render Video Player
	 *
	 * Written in PHP and HTML.
	 *
	 * @since 1.0.0
	 *
	 * @version 5.4.2
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		$mainsch   = '';
		$thumbsch  = '';
		$titlesch  = '';
		$descsch   = '';
		$uploadate = '';

		$markupsch = ! empty( $settings['markupSch'] ) ? $settings['markupSch'] : '';

		if ( 'yes' === $markupsch ) {
			$mainsch   = 'itemscope="" itemprop="VideoObject" itemtype="http://schema.org/VideoObject"';
			$thumbsch  = 'itemprop="thumbnailUrl"';
			$titlesch  = 'itemprop="name"';
			$descsch   = 'itemprop="description"';
			$uploadate = $this->get_settings( 'video_date' );
		}

		$video_type = ! empty( $settings['video_type'] ) ? $settings['video_type'] : '';

		$youtube_id = '';
		$vimeo_id   = '';
		$mp4_link   = '';

		$yt_id    = ! empty( $settings['youtube_id'] ) ? $settings['youtube_id'] : '';
		$vimeo_id = ! empty( $settings['vimeo_id'] ) ? $settings['vimeo_id'] : '';
		$mp_4     = ! empty( $settings['mp4_link']['url'] ) ? $settings['mp4_link']['url'] : '';

		if ( ! empty( $yt_id ) ) {
			$youtube_id = $yt_id;
		}
		if ( ! empty( $vimeo_id ) ) {
			$vimeo_id = $vimeo_id;
		}
		if ( ! empty( $mp_4 ) ) {
			$mp4_link = $mp_4;
		}

		$icon_effect = '';

		$icon_ani = ! empty( $settings['icon_continuous_animation'] ) ? $settings['icon_continuous_animation'] : '';
		$icon_hov = ! empty( $settings['icon_animation_hover'] ) ? $settings['icon_animation_hover'] : '';

		if ( 'yes' === $icon_ani ) {

			if ( 'yes' === $icon_hov ) {
				$animation_class = 'hover_';
			} else {
				$animation_class = 'image-';
			}

			$icon_effect = $animation_class . $settings['icon_animation_effect'];
		}

		$video_content = '';
		$banner_image  = '';

		$banner_url  = '';
		$video_space = '';
		$image_video = '';
		$image_alt   = '';
		$only_image  = '';

		$title = '';

		$image_video_url  = '';
		$icon_align_video = '';

		$vid_title = ! empty( $settings['video_title'] ) ? $settings['video_title'] : '';
		$vid_des   = ! empty( $settings['video_desc'] ) ? $settings['video_desc'] : '';

		if ( ! empty( $vid_title ) ) {
			$title = '<div class="ts-video-caption-text" >';

			$title .= '<span ' . $titlesch . '>' . esc_html( $vid_title ) . '</span>';

			if ( ! empty( $vid_des ) ) {
				$title .= '<div class="tp-video-desc" ' . esc_attr( $descsch ) . ' >';

					$title .= wp_kses_post( $vid_des );

				$title .= '</div>';
			}

			$title .= '</div>';
		}
			$vid_img = ! empty( $settings['only_img'] ) ? $settings['only_img'] : '';

		if ( ! empty( $vid_img['url'] ) ) {

			$only_img = $vid_img['id'];

			$img = wp_get_attachment_image_src( $only_img, $settings['only_img_thumbnail_size'] );

			$only_img_icon = $img[0];
			$only_image   .= '<img class="ts-video-only-icon" src="' . esc_url( $only_img_icon ) . '" alt="play-icon" />';
		}

		$img_video = ! empty( $settings['image_video']['url'] ) ? $settings['image_video']['url'] : '';
		$img_vi_id = ! empty( $settings['image_video']['id'] ) ? $settings['image_video']['id'] : '';

		if ( ! empty( $img_video ) ) {

			$image_video_src = $settings['image_video']['id'];
			$img             = wp_get_attachment_image_src( $image_video_src, $settings['image_video_thumbnail_size'] );
			$image_video     = $img[0];

			$image_alt = get_post_meta( $img_vi_id, '_wp_attachment_image_alt', true );

			if ( ! $image_alt ) {
				$image_alt = get_the_title( $img_vi_id );
			} elseif ( ! $image_alt ) {
					$image_alt = 'Plus video thumb';
			}

			$image_video_url .= '<div class="tp-video-icon-inner ' . esc_attr( $icon_effect ) . '"><img class="ts-video-icon" src="' . esc_url( $image_video ) . '"  alt="' . esc_attr( $image_alt ) . '" /></div>';
		}

		$ban_img   = ! empty( $settings['banner_image']['url'] ) ? $settings['banner_image']['url'] : '';
		$ban_om_id = ! empty( $settings['banner_image']['id'] ) ? $settings['banner_image']['id'] : '';

		if ( ! empty( $ban_img ) ) {

			if ( ! empty( $ban_om_id ) ) {
				$banner_image = $ban_om_id;

				$img = wp_get_attachment_image_src( $banner_image, $settings['banner_image_thumbnail_size'] );

				$banner_image = $img[0];
			} else {
				$banner_image = L_THEPLUS_URL . '/assets/images/tp-placeholder.jpg';
			}

			$banner_url .= '<img class="ts-video-image-zoom set-image" ' . $thumbsch . ' content="' . esc_url( $banner_image ) . '" src="' . esc_url( $banner_image ) . '" alt="" /><div class="tp-video-popup-icon"> <div class="tp-video-icon ' . esc_attr( $icon_effect ) . '"><img class="ts-video-caption" src="' . esc_url( $image_video ) . '" alt="' . esc_attr( $image_alt ) . '" /></div></div>' . $title;
		}

		$youtube_frame_attr = '';

		$youtube_attr     = '';
		$video_touchable  = '';
		$self_video_attr  = '';
		$vimeo_frame_attr = '';

		$vid_auto = ! empty( $settings['video_autoplay'] ) ? $settings['video_autoplay'] : '';

		if ( 'yes' === $vid_auto ) {

			if ( 'youtube' === $video_type ) {
				$youtube_frame_attr .= '&amp;autoplay=1&amp;version=3';

				$youtube_attr .= ' allow="autoplay; encrypted-media"  ';
			}

			if ( 'vimeo' === $video_type ) {
				$vimeo_frame_attr .= '&amp;autoplay=1';
			}

			if ( 'self-hosted' === $video_type ) {
				$self_video_attr .= ' autoplay';
			}
		}
			$vid_loop = ! empty( $settings['video_loop'] ) ? $settings['video_loop'] : '';

		if ( 'yes' === $vid_loop ) {
			if ( 'youtube' === $video_type ) {
				$youtube_frame_attr .= '&amp;loop=1&amp;playlist=' . esc_attr( $yt_id );
			}
			if ( 'vimeo' === $video_type ) {
				$vimeo_frame_attr .= '&amp;loop=1';
			}
			if ( 'self-hosted' === $video_type ) {
				$self_video_attr .= ' loop ';
			}
		}

		$vid_con = ! empty( $settings['video_controls'] ) ? $settings['video_controls'] : '';

		if ( 'yes' === $vid_con ) {

			if ( 'youtube' === $video_type ) {
				$youtube_frame_attr .= '&amp;controls=1';
			}

			if ( 'self-hosted' === $video_type ) {
				$self_video_attr .= ' controls ';
			}
		} elseif ( 'youtube' === $video_type ) {
			$youtube_frame_attr .= '&amp;controls=0';
		}

		$modest_brd = ! empty( $settings['modest_branding'] ) ? $settings['modest_branding'] : '';

		if ( 'yes' === $modest_brd ) {

			if ( 'youtube' === $video_type ) {
				$youtube_frame_attr .= '&amp;modestbranding=1';
			}
		} elseif ( 'youtube' === $video_type ) {
			$youtube_frame_attr .= '&amp;modestbranding=0';
		}

		$rel = ! empty( $settings['rel'] ) ? $settings['rel'] : '';

		if ( 'yes' === $rel ) {

			if ( 'youtube' === $video_type ) {
				$youtube_frame_attr .= '&amp;rel=0';
			}
		} elseif ( 'youtube' === $video_type ) {
			$youtube_frame_attr .= '&amp;rel=1';
		}

		$youtube_privacy = '';

		$yt_privacy = ! empty( $settings['yt_privacy'] ) ? $settings['yt_privacy'] : '';

		if ( 'yes' === $yt_privacy ) {

			if ( 'youtube' === $video_type ) {
				$youtube_privacy .= '-nocookie';
			}
		} elseif ( 'youtube' === $video_type ) {
			$youtube_privacy .= '';
		}

		$vid_mute = ! empty( $settings['video_muted'] ) ? $settings['video_muted'] : '';

		if ( 'yes' === $vid_mute ) {

			if ( 'youtube' === $video_type ) {
				$youtube_frame_attr .= '&amp;mute=1';
			}

			if ( 'vimeo' === $video_type ) {
				$vimeo_frame_attr .= '&amp;muted=1';
			}

			if ( 'self-hosted' === $video_type ) {
				$self_video_attr .= ' muted ';
			}
		}

		$vid_color = ! empty( $settings['video_color'] ) ? $settings['video_color'] : '';
		if ( ! empty( $vid_color ) ) {
			if ( 'vimeo' === $video_type ) {
				$video_color       = str_replace( '#', '', $vid_color );
				$vimeo_frame_attr .= '&amp;color=' . esc_attr( $video_color ) . ';';
			}
		}

		$vie_title = ! empty( $settings['vimeo_title'] ) ? $settings['vimeo_title'] : '';

		if ( 'yes' === $vie_title ) {
			if ( 'vimeo' === $video_type ) {
				$vimeo_frame_attr .= '&amp;title=1;';
			}
		} else {
			$vimeo_frame_attr .= '&amp;title=0;';
		}

		$vie_portrait = ! empty( $settings['vimeo_portrait'] ) ? $settings['vimeo_portrait'] : '';

		if ( 'yes' === $vie_portrait ) {

			if ( 'vimeo' === $video_type ) {
				$vimeo_frame_attr .= '&amp;portrait=1;';
			}
		} else {
			$vimeo_frame_attr .= '&amp;portrait=0;';
		}

		$vie_byline = ! empty( $settings['vimeo_byline'] ) ? $settings['vimeo_byline'] : '';

		if ( 'yes' === $vie_byline ) {

			if ( 'vimeo' === $video_type ) {
				$vimeo_frame_attr .= '&amp;byline=1;';
			}
		} else {
			$vimeo_frame_attr .= '&amp;byline=0;';
		}

		$touch_on = ! empty( $settings['video_touch_disable'] ) ? $settings['video_touch_disable'] : '';

		if ( 'yes' === $touch_on ) {
			$video_touchable = ' not-touch ';
		}

		$image_banner   = ! empty( $settings['image_banner'] ) ? $settings['image_banner'] : '';
		$dis_banner_img = ! empty( $settings['display_banner_image'] ) ? $settings['display_banner_image'] : '';
		$pop_vid        = ! empty( $settings['popup_video'] ) ? $settings['popup_video'] : '';

		if ( 'banner_img' === $image_banner ) {

			if ( 'yes' === $dis_banner_img ) {

				if ( 'yes' === $pop_vid ) {
					if ( 'youtube' === $video_type ) {
						$video_content .= '<a href="https://www.youtube' . $youtube_privacy . '.com/embed/' . esc_attr( $youtube_id ) . '" data-lity >' . $banner_url . '</a>';
					} elseif ( 'vimeo' === $video_type ) {
						$video_content .= '<a href="https://player.vimeo.com/video/' . esc_attr( $vimeo_id ) . '" data-lity >' . $banner_url . '</a>';
					} elseif ( 'self-hosted' === $video_type ) {
						$video_content .= '<a href="' . esc_url( $mp4_link ) . '" data-lity type="video/mp4">' . $banner_url . '</a>';
					}

					$video_space = '';
				} elseif ( 'youtube' === $video_type ) {
					$video_content .= '<div class="ts-video-wrapper ts-video-hover-effect-zoom ts-type-' . esc_attr( $video_type ) . '" data-mode="lazyload" data-provider="' . esc_attr( $video_type ) . '" id="ts-video-video-6" ' . $mainsch . ' data-grow=""><div class="ts-video-embed-container" ><img class="ts-video-thumbnail" data-object-fit="" ' . esc_attr( $thumbsch ) . ' content="' . esc_url( $banner_image ) . '" src="' . esc_url( $banner_image ) . '" alt="' . esc_attr__( 'Video Thumbnail', 'tpebl' ) . '"><h5 class="ts-video-title">' . $title . '</h5><span class="ts-video-lazyload" data-allowfullscreen="" data-class="pt-plus-video-frame fitvidsignore" data-frameborder="0" data-scrolling="no" data-src="https://www.youtube' . $youtube_privacy . '.com/embed/' . esc_attr( $youtube_id ) . '?html5=1&amp;title=0&amp;byline=0&amp;portrait=0&amp;autoplay=1' . $youtube_frame_attr . '"  data-sandbox="allow-scripts allow-same-origin allow-presentation allow-forms" data-width="480" data-height="270"></span><button class="ts-video-play-btn ts-video-blay-btn-youtube" type="button">' . $image_video_url . '</button>';
					
					if ( ! empty( $markupsch ) ) {
						$video_content .= '<div class="tp-video-upload" itemprop="uploadDate" content="' . esc_attr( $uploadate ) . '" style="display: none;"></div><div class="tp-video-upload" itemprop="contentUrl" content="https://www.youtube' . $youtube_privacy . '.com/embed/' . esc_attr( $youtube_id ) . '?html5=1&amp;title=0&amp;byline=0&amp;portrait=0&amp;autoplay=1' . $youtube_frame_attr . '" style="display: none;"></div>';
					}

					$video_content .= '</div></div>';
				} elseif ( 'vimeo' === $video_type ) {
					$video_content .= '<div class="ts-video-wrapper ts-video-hover-effect-zoom ts-type-' . esc_attr( $video_type ) . '" data-mode="lazyload" data-provider="' . esc_attr( $video_type ) . '" id="ts-video-video-6" ' . $mainsch . ' data-grow=""><div class="ts-video-embed-container" ><img class="ts-video-thumbnail" data-object-fit="" ' . esc_attr( $thumbsch ) . ' content="' . esc_url( $banner_image ) . '" src="' . esc_url( $banner_image ) . '" alt="' . esc_attr__( 'Video Thumbnail', 'tpebl' ) . '"><h5 class="ts-video-title">' . $title . '</h5><span class="ts-video-lazyload" data-allowfullscreen="" data-class="pt-plus-video-frame fitvidsignore" data-frameborder="0" data-scrolling="no" data-src="https://player.vimeo.com/video/' . esc_attr( $vimeo_id ) . '?html5=1&amp;title=0&amp;byline=0&amp;portrait=0&amp;autoplay=1" data-sandbox="allow-scripts allow-same-origin allow-presentation allow-forms" data-width="480" data-height="270"></span><button class="ts-video-play-btn ts-video-blay-btn-youtube" type="button">' . $image_video_url . '</button>';

					if ( ! empty( $markupsch ) ) {
						$video_content .= '<div class="tp-video-upload" itemprop="uploadDate" content="' . esc_attr( $uploadate ) . '" style="display: none;"></div><div class="tp-video-upload" itemprop="contentUrl" content="https://player.vimeo.com/video/' . esc_attr( $vimeo_id ) . '?html5=1&amp;title=0&amp;byline=0&amp;portrait=0&amp;autoplay=1" style="display: none;"></div>';
					}

					$video_content .= '</div></div>';
				} elseif ( 'self-hosted' === $video_type ) {
					$video_content .= '<div class="ts-video-wrapper ts-video-hover-effect-zoom ts-type-' . esc_attr( $video_type ) . '" data-mode="lazyload" data-provider="' . esc_attr( $video_type ) . '" id="ts-video-video-6" ' . $mainsch . ' data-grow=""><div class="ts-video-embed-container" ><img class="ts-video-thumbnail" data-object-fit="" ' . esc_attr( $thumbsch ) . ' content="' . esc_url( $banner_image ) . '" src="' . esc_url( $banner_image ) . '" alt="' . esc_attr__( 'Video Thumbnail', 'tpebl' ) . '"><h5 class="ts-video-title">' . $title . '</h5><div class="video_container"><video class="ts-video-poster" width="100%" poster="' . esc_url( $banner_image ) . '" controls > <source src="' . esc_url( $mp4_link ) . '" type="video/mp4" ></video></div></span><button class="ts-video-play-btn ts-video-blay-btn-youtube" type="button">' . $image_video_url . '</button>';

					if ( ! empty( $markupsch ) ) {
						$video_content .= '<div class="tp-video-upload" itemprop="uploadDate" content="' . esc_attr( $uploadate ) . '" style="display: none;"></div><div class="tp-video-upload" itemprop="contentUrl" content="' . esc_url( $mp4_link ) . '" style="display: none;"></div>';
					}

					$video_content .= '</div></div>';
				}
			} elseif ( 'youtube' === $video_type ) {

				$video_content .= '<div class="ts-video-wrapper embed-container  ts-type-' . esc_attr( $video_type ) . '"><iframe width="100%"  src="https://www.youtube' . $youtube_privacy . '.com/embed/' . esc_attr( $youtube_id ) . '?&amp;autohide=1&amp;showtitle=0' . $youtube_frame_attr . '" ' . $youtube_attr . ' frameborder="0" allowfullscreen></iframe></div>';

			} elseif ( 'vimeo' === $video_type ) {
				$video_content .= '<div class="ts-video-wrapper embed-container  ts-type-' . esc_attr( $video_type ) . '"><iframe src="https://player.vimeo.com/video/' . $vimeo_id . '?html5=1&amp;title=0&amp;byline=0&amp;portrait=0&amp;' . $vimeo_frame_attr . '" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>';
			} elseif ( 'self-hosted' === $video_type ) {
				$video_content .= '<div class="ts-video-wrapper ts-type-' . esc_attr( $video_type ) . '"><video width="100%" ' . esc_attr( $self_video_attr ) . '> <source src="' . esc_url( $mp4_link ) . '" type="video/mp4" ></video></div>';
			}
		} elseif ( 'only_icon' === $image_banner ) {
			if ( 'yes' !== $dis_banner_img ) {
				if ( 'youtube' === $video_type ) {
					$video_content .= '<a href="https://www.youtube.com/embed/' . esc_attr( $youtube_id ) . '" class="tp-video-popup ' . esc_attr( $icon_effect ) . '" data-lity >' . $only_image . '</a>';
				} elseif ( 'vimeo' === $video_type ) {
					$video_content .= '<a href="https://player.vimeo.com/video/' . esc_attr( $vimeo_id ) . '" class="tp-video-popup ' . esc_attr( $icon_effect ) . '" data-lity >' . $only_image . '</a>';
				} elseif ( 'self-hosted' === $video_type ) {
					$video_content .= '<a href="' . esc_url( $mp4_link ) . '" class="tp-video-popup ' . esc_attr( $icon_effect ) . '" data-lity type="video/mp4">' . $only_image . '</a>';
				}
			}

			$icon_align = ! empty( $settings['icon_align'] ) ? $settings['icon_align'] : '';

			$icon_align_video = $icon_align;
		}

		$animation_effects = ! empty( $settings['animation_effects'] ) ? $settings['animation_effects'] : '';
		$animate_duration  = ! empty( $settings['animate_duration']['size'] ) ? $settings['animate_duration']['size'] : 50;

		$animation_delay = ! empty( $settings['animation_delay']['size'] ) ? $settings['animation_delay']['size'] : 50;

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

			$uid = uniqid( 'video_player' );

			$video_player  = '<div class="pt_plus_video-box-shadow ' . esc_attr( $uid ) . ' ' . esc_attr( $animated_class ) . '" ' . $animation_attr . '>';
			$video_player .= '<div class="pt_plus_video_player ' . esc_attr( $video_touchable ) . ' ' . esc_attr( $video_space ) . ' text-' . esc_attr( $icon_align_video ) . '">';

			$video_player .= $video_content;

		if ( 'yes' !== $dis_banner_img ) {
			$video_player .= $banner_url;
		}

		$video_player .= '</div>';
		$video_player .= '</div>';

		$css_rules = '';

		$vi_transform  = ! empty( $settings['video_transform'] ) ? $settings['video_transform'] : '';
		$hov_transform = ! empty( $settings['hover_video_transform'] ) ? $settings['hover_video_transform'] : '';

		if ( ! empty( $vi_transform ) || ! empty( $hov_transform ) ) {

			$css_rules .= '<style>';
			if ( ! empty( $vi_transform ) ) {
				$css_rules .= '.' . esc_attr( $uid ) . '.pt_plus_video-box-shadow{-webkit-transform: ' . esc_attr( $vi_transform ) . ';-ms-transform: ' . esc_attr( $vi_transform ) . ';-moz-transform: ' . esc_attr( $vi_transform ) . ';-o-transform: ' . esc_attr( $vi_transform ) . ';transform: ' . esc_attr( $vi_transform ) . ';}';
			}

			if ( ! empty( $hov_transform ) ) {
				$css_rules .= '.' . esc_attr( $uid ) . '.pt_plus_video-box-shadow:hover{-webkit-transform: ' . esc_attr( $hov_transform ) . ';-ms-transform: ' . esc_attr( $hov_transform ) . ';-moz-transform: ' . esc_attr( $hov_transform ) . ';-o-transform: ' . esc_attr( $hov_transform ) . ';transform: ' . esc_attr( $hov_transform ) . ';}';
			}

			$css_rules .= '</style>';
		}

		echo $css_rules . $video_player;
	}
}
