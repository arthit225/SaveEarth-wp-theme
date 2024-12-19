<?php
/**
 * Widget Name: Social Embed
 * Description: Social Embed
 * Author: Theplus
 * Author URI: https://posimyth.com
 *
 * @package ThePlus
 */

namespace TheplusAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class L_ThePlus_Social_Embed
 */
class L_ThePlus_Social_Embed extends Widget_Base {

	/**
	 * Get Widget Name.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_name() {
		return 'tp-social-embed';
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
		return esc_html__( 'Social Embed', 'tpebl' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-code theplus_backend_icon';
	}

	/**
	 * Get Widget categories.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_categories() {
		return array( 'plus-social' );
	}

	/**
	 * Get KeyWords.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_keywords() {
		return array( 'Social Embed', 'Social Media Embed', 'Embed Social Media', 'Social Media Widget', 'Social Media', 'Elementor Social Embed', 'Social Embed' );
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
				'label' => esc_html__( 'Embed Options', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'EmbedType',
			array(
				'label'   => esc_html__( 'Type', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'facebook',
				'options' => array(
					'facebook'  => esc_html__( 'Facebook', 'tpebl' ),
					'twitter'   => esc_html__( 'Twitter', 'tpebl' ),
					'vimeo'     => esc_html__( 'Vimeo', 'tpebl' ),
					'instagram' => esc_html__( 'Instagram', 'tpebl' ),
					'youtube'   => esc_html__( 'YouTube', 'tpebl' ),
					'googlemap' => esc_html__( 'Google Map', 'tpebl' ),
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'semd_Fb',
			array(
				'label'     => esc_html__( 'Facebook', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'EmbedType' => 'facebook',
				),
			)
		);
		$this->add_control(
			'Type',
			array(
				'label'     => esc_html__( 'Type', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'videos',
				'options'   => array(
					'comments'   => esc_html__( 'Comments', 'tpebl' ),
					'posts'      => esc_html__( 'Posts', 'tpebl' ),
					'videos'     => esc_html__( 'Videos', 'tpebl' ),
					'page'       => esc_html__( 'Page', 'tpebl' ),
					'likebutton' => esc_html__( 'Like Button', 'tpebl' ),
					'save'       => esc_html__( 'Save Button', 'tpebl' ),
					'share'      => esc_html__( 'Share Button', 'tpebl' ),
				),
				'condition' => array(
					'EmbedType' => 'facebook',
				),
			)
		);
		$this->add_control(
			'CommentType',
			array(
				'label'     => esc_html__( 'Options', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'viewcomment',
				'options'   => array(
					'viewcomment' => esc_html__( 'View Comments', 'tpebl' ),
					'onlypost'    => esc_html__( 'Add Comments', 'tpebl' ),
				),
				'condition' => array(
					'EmbedType' => 'facebook',
					'Type'      => 'comments',
				),
				'separator' => 'before',
			)
		);
		$this->add_control(
			'CommentTypeViewCommentDep',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => 'Note : The Embedded Comments has been deprecated.<a rel="noopener noreferrer" target="_blank" href="https://developers.facebook.com/docs/plugins/embedded-comments/" target="_blank">More Info</a>',
				'content_classes' => 'tp-widget-description',
				'condition'       => array(
					'EmbedType'   => 'facebook',
					'Type'        => 'comments',
					'CommentType' => 'viewcomment',
				),
			)
		);
		$this->add_control(
			'CommentURL',
			array(
				'label'         => __( 'Comment URL', 'tpebl' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'Paste URL Here', 'tpebl' ),
				'show_external' => true,
				'dynamic'       => array( 'active' => true ),
				'default'       => array(
					'url'         => 'https://www.facebook.com/posimyth/posts/2107330979289233?comment_id=2107337105955287&reply_comment_id=2108417645847233',
					'is_external' => true,
					'nofollow'    => true,
				),
				'condition'     => array(
					'EmbedType'   => 'facebook',
					'Type'        => 'comments',
					'CommentType' => 'viewcomment',
				),
			)
		);
		$this->add_control(
			'AppID',
			array(
				'label'     => esc_html__( 'App ID', 'tpebl' ),
				'type'      => Controls_Manager::TEXT,
				'dynamic'   => array( 'active' => true ),
				'default'   => '',
				'condition' => array(
					'EmbedType'   => 'facebook',
					'Type'        => 'comments',
					'CommentType' => 'onlypost',
				),
			)
		);
		$this->add_control(
			'AppIDFbPost',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => 'Note : How to <a href="https://developers.facebook.com/apps"  target="_blank" rel="noopener noreferrer">Create App ID ?</a>',
				'content_classes' => 'tp-widget-description',
				'condition'       => array(
					'EmbedType'   => 'facebook',
					'Type'        => 'comments',
					'CommentType' => 'onlypost',
				),
			)
		);
		$this->add_control(
			'TargetC',
			array(
				'label'     => esc_html__( 'Target URL', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'custom',
				'options'   => array(
					'currentpage' => esc_html__( 'Current Page', 'tpebl' ),
					'custom'      => esc_html__( 'Custom', 'tpebl' ),
				),
				'condition' => array(
					'EmbedType'   => 'facebook',
					'Type'        => 'comments',
					'CommentType' => 'onlypost',
				),
				'separator' => 'before',
			)
		);
		$this->add_control(
			'URLFC',
			array(
				'label'     => esc_html__( 'URL Format', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'plain',
				'options'   => array(
					'plain'  => esc_html__( 'Plain Permalink', 'tpebl' ),
					'pretty' => esc_html__( 'Pretty Permalink', 'tpebl' ),
				),
				'condition' => array(
					'EmbedType'   => 'facebook',
					'Type'        => 'comments',
					'CommentType' => 'onlypost',
					'TargetC'     => 'currentpage',
				),
			)
		);
		$this->add_control(
			'CommentAddURL',
			array(
				'label'         => __( 'Custom URL', 'tpebl' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'Paste URL Here', 'tpebl' ),
				'show_external' => true,
				'dynamic'       => array( 'active' => true ),
				'default'       => array(
					'url'         => 'https://www.facebook.com/',
					'is_external' => true,
					'nofollow'    => true,
				),
				'condition'     => array(
					'EmbedType'   => 'facebook',
					'Type'        => 'comments',
					'CommentType' => 'onlypost',
					'TargetC'     => 'custom',
				),
			)
		);
		$this->add_control(
			'PostURL',
			array(
				'label'         => __( 'Post URL', 'tpebl' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'Paste URL Here', 'tpebl' ),
				'show_external' => true,
				'dynamic'       => array( 'active' => true ),
				'default'       => array(
					'url'         => 'https://www.facebook.com/posimyth/posts/3054603914561930',
					'is_external' => true,
					'nofollow'    => true,
				),
				'condition'     => array(
					'EmbedType' => 'facebook',
					'Type'      => 'posts',
				),
				'separator'     => 'before',
			)
		);
		$this->add_control(
			'VideosURL',
			array(
				'label'         => __( 'Videos URL', 'tpebl' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'Paste URL Here', 'tpebl' ),
				'show_external' => true,
				'dynamic'       => array( 'active' => true ),
				'default'       => array(
					'url'         => 'https://www.facebook.com/posimyth/videos/444986032863860/',
					'is_external' => true,
					'nofollow'    => true,
				),
				'condition'     => array(
					'EmbedType' => 'facebook',
					'Type'      => 'videos',
				),
				'separator'     => 'before',
			)
		);
		$this->add_control(
			'URLP',
			array(
				'label'         => __( 'Page URL', 'tpebl' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'Paste URL Here', 'tpebl' ),
				'show_external' => true,
				'dynamic'       => array( 'active' => true ),
				'default'       => array(
					'url'         => 'https://www.facebook.com/posimyth',
					'is_external' => true,
					'nofollow'    => true,
				),
				'condition'     => array(
					'EmbedType' => 'facebook',
					'Type'      => 'page',
				),
				'separator'     => 'before',
			)
		);
		$this->add_control(
			'TargetLike',
			array(
				'label'     => esc_html__( 'Target URL', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'custom',
				'options'   => array(
					'currentpage' => esc_html__( 'Current Page', 'tpebl' ),
					'custom'      => esc_html__( 'Custom', 'tpebl' ),
				),
				'condition' => array(
					'EmbedType' => 'facebook',
					'Type'      => 'likebutton',
				),
				'separator' => 'before',
			)
		);
		$this->add_control(
			'FmtURLlb',
			array(
				'label'     => esc_html__( 'URL Format', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'plain',
				'options'   => array(
					'plain'  => esc_html__( 'Plain Permalink', 'tpebl' ),
					'pretty' => esc_html__( 'Pretty Permalink', 'tpebl' ),
				),
				'condition' => array(
					'EmbedType'  => 'facebook',
					'Type'       => 'likebutton',
					'TargetLike' => 'currentpage',
				),
			)
		);
		$this->add_control(
			'likeBtnUrl',
			array(
				'label'         => __( 'Like Button URL', 'tpebl' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'Paste URL Here', 'tpebl' ),
				'show_external' => true,
				'dynamic'       => array( 'active' => true ),
				'default'       => array(
					'url'         => 'https://www.facebook.com/posimyth',
					'is_external' => true,
					'nofollow'    => true,
				),
				'condition'     => array(
					'EmbedType'  => 'facebook',
					'Type'       => 'likebutton',
					'TargetLike' => 'custom',
				),
			)
		);
		$this->add_control(
			'SaveURL',
			array(
				'label'         => __( 'Save URL', 'tpebl' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'Paste URL Here', 'tpebl' ),
				'show_external' => true,
				'dynamic'       => array( 'active' => true ),
				'default'       => array(
					'url'         => 'https://www.facebook.com/',
					'is_external' => true,
					'nofollow'    => true,
				),
				'condition'     => array(
					'EmbedType' => 'facebook',
					'Type'      => 'save',
				),
				'separator'     => 'before',
			)
		);
		$this->add_control(
			'ShareURL',
			array(
				'label'         => __( 'Share URL', 'tpebl' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'Paste URL Here', 'tpebl' ),
				'show_external' => true,
				'dynamic'       => array( 'active' => true ),
				'default'       => array(
					'url'         => 'https://www.facebook.com/',
					'is_external' => true,
					'nofollow'    => true,
				),
				'condition'     => array(
					'EmbedType' => 'facebook',
					'Type'      => 'share',
				),
				'separator'     => 'before',
			)
		);
		$this->add_control(
			'ReMrFbPost',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => 'Note : <a href="https://developers.facebook.com/docs/plugins"  target="_blank" rel="noopener noreferrer">Read More About All Options</a>',
				'content_classes' => 'tp-widget-description',
				'condition'       => array(
					'EmbedType' => 'facebook',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'semd_Fb_opts',
			array(
				'label'     => esc_html__( 'Facebook Options', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'EmbedType' => 'facebook',
				),
			)
		);
		$this->add_control(
			'PcomentcT',
			array(
				'label'     => esc_html__( 'Parent Comment', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'condition' => array(
					'EmbedType'   => 'facebook',
					'Type'        => 'comments',
					'CommentType' => 'viewcomment',
				),
			)
		);
		$this->add_responsive_control(
			'wdCmt',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Width', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'condition'   => array(
					'EmbedType'   => 'facebook',
					'Type'        => 'comments',
					'CommentType' => 'viewcomment',
				),
				'selectors'   => array(
					'{{WRAPPER}} .tp-social-embed iframe.tp-fb-iframe' => 'width: {{SIZE}}{{UNIT}}',
				),
				'separator'   => 'before',
			)
		);
		$this->add_responsive_control(
			'HgCmt',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Height', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 2000,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'condition'   => array(
					'EmbedType'   => 'facebook',
					'Type'        => 'comments',
					'CommentType' => 'viewcomment',
				),
				'selectors'   => array(
					'{{WRAPPER}} .tp-social-embed iframe.tp-fb-iframe' => 'height: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_control(
			'CountC',
			array(
				'label'     => esc_html__( 'Comment Count', 'tpebl' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 5000,
				'step'      => 100,
				'default'   => '',
				'condition' => array(
					'EmbedType'   => 'facebook',
					'Type'        => 'comments',
					'CommentType' => 'onlypost',
				),
			)
		);
		$this->add_control(
			'OrderByC',
			array(
				'label'     => esc_html__( 'Order By', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'social',
				'options'   => array(
					'social'      => esc_html__( 'Social', 'tpebl' ),
					'reversetime' => esc_html__( 'Reverse Time', 'tpebl' ),
					'time'        => esc_html__( 'Time', 'tpebl' ),
				),
				'condition' => array(
					'EmbedType'   => 'facebook',
					'Type'        => 'comments',
					'CommentType' => 'onlypost',
				),
			)
		);
		$this->add_control(
			'FullPT',
			array(
				'label'     => esc_html__( 'Show Text', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'condition' => array(
					'EmbedType' => 'facebook',
					'Type'      => 'posts',
				),
			)
		);
		$this->add_responsive_control(
			'wdPost',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Width', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'condition'   => array(
					'EmbedType' => 'facebook',
					'Type'      => 'posts',
				),
				'selectors'   => array(
					'{{WRAPPER}} .tp-social-embed iframe.tp-fb-iframe' => 'width: {{SIZE}}{{UNIT}}',
				),
				'separator'   => 'before',
			)
		);
		$this->add_responsive_control(
			'HgPost',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Height', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 2000,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'condition'   => array(
					'EmbedType' => 'facebook',
					'Type'      => 'posts',
				),
				'selectors'   => array(
					'{{WRAPPER}} .tp-social-embed iframe.tp-fb-iframe' => 'height: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_control(
			'FullVT',
			array(
				'label'     => esc_html__( 'Allow Full Screen', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'condition' => array(
					'EmbedType' => 'facebook',
					'Type'      => 'videos',
				),
			)
		);
		$this->add_control(
			'AutoplayVT',
			array(
				'label'     => esc_html__( 'Autoplay', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'condition' => array(
					'EmbedType' => 'facebook',
					'Type'      => 'videos',
				),
			)
		);
		$this->add_control(
			'CaptionVT',
			array(
				'label'     => esc_html__( 'Captions', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'condition' => array(
					'EmbedType' => 'facebook',
					'Type'      => 'videos',
				),
			)
		);
		$this->add_responsive_control(
			'wdVideo',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Width', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'condition'   => array(
					'EmbedType' => 'facebook',
					'Type'      => 'videos',
				),
				'selectors'   => array(
					'{{WRAPPER}} .tp-social-embed iframe.tp-fb-iframe' => 'width: {{SIZE}}{{UNIT}}',
				),
				'separator'   => 'before',
			)
		);
		$this->add_responsive_control(
			'HgVideo',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Height', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 2000,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'condition'   => array(
					'EmbedType' => 'facebook',
					'Type'      => 'videos',
				),
				'selectors'   => array(
					'{{WRAPPER}} .tp-social-embed iframe.tp-fb-iframe' => 'height: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_control(
			'LayoutP',
			array(
				'label'     => esc_html__( 'Layout', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'timeline',
				'options'   => array(
					'timeline' => esc_html__( 'Timeline', 'tpebl' ),
					'events'   => esc_html__( 'Events', 'tpebl' ),
					'messages' => esc_html__( 'Messages', 'tpebl' ),
				),
				'condition' => array(
					'EmbedType' => 'facebook',
					'Type'      => 'page',
				),
			)
		);
		$this->add_control(
			'smallHP',
			array(
				'label'     => esc_html__( 'Small Header', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'condition' => array(
					'EmbedType' => 'facebook',
					'Type'      => 'page',
				),
			)
		);
		$this->add_control(
			'CoverP',
			array(
				'label'     => esc_html__( 'Cover Photo', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => array(
					'EmbedType' => 'facebook',
					'Type'      => 'page',
				),
			)
		);
		$this->add_control(
			'ProfileP',
			array(
				'label'     => esc_html__( 'Show Friend\'s Faces', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => array(
					'EmbedType' => 'facebook',
					'Type'      => 'page',
				),
			)
		);
		$this->add_control(
			'CTABTN',
			array(
				'label'     => esc_html__( 'Custom CTA Button', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => array(
					'EmbedType' => 'facebook',
					'Type'      => 'page',
				),
			)
		);
		$this->add_responsive_control(
			'wdPage',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Width', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'condition'   => array(
					'EmbedType' => 'facebook',
					'Type'      => 'page',
				),
				'selectors'   => array(
					'{{WRAPPER}} .tp-social-embed iframe.tp-fb-iframe' => 'width: {{SIZE}}{{UNIT}}',
				),
				'separator'   => 'before',
			)
		);
		$this->add_responsive_control(
			'HgPage',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Height', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 2000,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'condition'   => array(
					'EmbedType' => 'facebook',
					'Type'      => 'page',
				),
				'selectors'   => array(
					'{{WRAPPER}} .tp-social-embed iframe.tp-fb-iframe' => 'height: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_control(
			'SizeLB',
			array(
				'label'     => esc_html__( 'Size', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'small',
				'options'   => array(
					'small' => esc_html__( 'Small', 'tpebl' ),
					'large' => esc_html__( 'Large', 'tpebl' ),
				),
				'condition' => array(
					'EmbedType' => 'facebook',
					'Type'      => array( 'likebutton', 'save', 'share' ),
				),
			)
		);
		$this->add_control(
			'TypeLB',
			array(
				'label'     => esc_html__( 'Type', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'like',
				'options'   => array(
					'like'      => esc_html__( 'Like', 'tpebl' ),
					'recommend' => esc_html__( 'Recommend', 'tpebl' ),
				),
				'condition' => array(
					'EmbedType' => 'facebook',
					'Type'      => 'likebutton',
				),
			)
		);
		$this->add_control(
			'BtnStyleLB',
			array(
				'label'     => esc_html__( 'Layout', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'button',
				'options'   => array(
					'standard'     => esc_html__( 'Standard', 'tpebl' ),
					'button'       => esc_html__( 'Button', 'tpebl' ),
					'button_count' => esc_html__( 'Button Count', 'tpebl' ),
					'box_count'    => esc_html__( 'Box Count', 'tpebl' ),
				),
				'condition' => array(
					'EmbedType' => 'facebook',
					'Type'      => 'likebutton',
				),
			)
		);
		$this->add_control(
			'ColorSLB',
			array(
				'label'     => esc_html__( 'Color Scheme', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'light',
				'options'   => array(
					'light' => esc_html__( 'Light', 'tpebl' ),
					'dark'  => esc_html__( 'Dark', 'tpebl' ),
				),
				'condition' => array(
					'EmbedType'  => 'facebook',
					'Type'       => 'likebutton',
					'BtnStyleLB' => 'standard',
				),
			)
		);
		$this->add_control(
			'SBtnLB',
			array(
				'label'     => esc_html__( 'Share Button', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'condition' => array(
					'EmbedType' => 'facebook',
					'Type'      => 'likebutton',
				),
			)
		);
		$this->add_control(
			'FacesLBT',
			array(
				'label'     => esc_html__( 'Faces', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'condition' => array(
					'EmbedType' => 'facebook',
					'Type'      => 'likebutton',
				),
			)
		);
		$this->add_responsive_control(
			'wdLikeBtn',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Width', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'condition'   => array(
					'EmbedType' => 'facebook',
					'Type'      => 'likebutton',
				),
				'selectors'   => array(
					'{{WRAPPER}} .tp-social-embed iframe.tp-fb-iframe' => 'width: {{SIZE}}{{UNIT}}',
				),
				'separator'   => 'before',
			)
		);
		$this->add_responsive_control(
			'HgLikeBtn',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Height', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'condition'   => array(
					'EmbedType' => 'facebook',
					'Type'      => 'likebutton',
				),
				'selectors'   => array(
					'{{WRAPPER}} .tp-social-embed iframe.tp-fb-iframe' => 'height: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_control(
			'ShareBTN',
			array(
				'label'     => esc_html__( 'Layout', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'button',
				'options'   => array(
					'button'       => esc_html__( 'Button', 'tpebl' ),
					'button_count' => esc_html__( 'Button Count', 'tpebl' ),
					'box_count'    => esc_html__( 'Box Count', 'tpebl' ),
				),
				'condition' => array(
					'EmbedType' => 'facebook',
					'Type'      => 'share',
				),
			)
		);
		$this->add_responsive_control(
			'wdShareBtn',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Width', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'condition'   => array(
					'EmbedType' => 'facebook',
					'Type'      => 'share',
				),
				'selectors'   => array(
					'{{WRAPPER}} .tp-social-embed iframe.tp-fb-iframe' => 'width: {{SIZE}}{{UNIT}}',
				),
				'separator'   => 'before',
			)
		);
		$this->add_responsive_control(
			'HgShareBtn',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Height', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'condition'   => array(
					'EmbedType' => 'facebook',
					'Type'      => 'share',
				),
				'selectors'   => array(
					'{{WRAPPER}} .tp-social-embed iframe.tp-fb-iframe' => 'height: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'semd_Tw',
			array(
				'label'     => esc_html__( 'Twitter', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'EmbedType' => 'twitter',
				),
			)
		);
		$this->add_control(
			'TweetType',
			array(
				'label'     => esc_html__( 'Embed Type', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'timelines',
				'options'   => array(
					'Tweets'    => esc_html__( 'Tweets Embed', 'tpebl' ),
					'timelines' => esc_html__( 'Timelines Embed', 'tpebl' ),
					'buttons'   => esc_html__( 'Buttons Embed', 'tpebl' ),
				),
				'condition' => array(
					'EmbedType' => 'twitter',
				),
			)
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'TweetURl',
			array(
				'label'         => esc_html__( 'Tweet URL', 'tpebl' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_html__( 'Paste URL Here', 'tpebl' ),
				'show_external' => true,
				'default'       => array(
					'url' => 'https://twitter.com/Interior/status/463440424141459456',
				),
				'dynamic'       => array(
					'active' => true,
				),
			)
		);
		$repeater->add_control(
			'TwMassage',
			array(
				'label'   => esc_html__( 'Loading Message', 'tpebl' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Loading', 'tpebl' ),
				'dynamic' => array( 'active' => true ),
			)
		);
		$this->add_control(
			'TwRepeater',
			array(
				'label'       => esc_html__( 'Tweets', 'tpebl' ),
				'type'        => Controls_Manager::REPEATER,
				'default'     => array(
					array(
						'TweetURl'  => 'https://twitter.com/Interior/status/463440424141459456',
						'TwMassage' => '&mdash; Loading',
					),
				),
				'separator'   => 'before',
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ TwMassage }}}',
				'condition'   => array(
					'EmbedType' => 'twitter',
					'TweetType' => 'Tweets',
				),
			)
		);
		$this->add_control(
			'TwGuides',
			array(
				'label'     => esc_html__( 'Guides Contents', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'Profile',
				'options'   => array(
					'Profile'    => esc_html__( 'Profile Timeline', 'tpebl' ),
					'Likes'      => esc_html__( 'Likes Timeline', 'tpebl' ),
					'List'       => esc_html__( 'List Timeline', 'tpebl' ),
					'Collection' => esc_html__( 'Collection', 'tpebl' ),
				),
				'condition' => array(
					'EmbedType' => 'twitter',
					'TweetType' => 'timelines',
				),
			)
		);
		$this->add_control(
			'Twstyle',
			array(
				'label'     => esc_html__( 'Layout', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'linear',
				'options'   => array(
					'grid'   => esc_html__( 'Grid style', 'tpebl' ),
					'linear' => esc_html__( 'Linear style', 'tpebl' ),
				),
				'condition' => array(
					'EmbedType' => 'twitter',
					'TweetType' => 'timelines',
				),
			)
		);
		$this->add_control(
			'Twlisturl',
			array(
				'label'         => __( 'List URL', 'tpebl' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'Paste URL Here', 'tpebl' ),
				'show_external' => true,
				'dynamic'       => array( 'active' => true ),
				'default'       => array(
					'url'         => 'https://twitter.com/TwitterDev/lists/national-parks',
					'is_external' => true,
					'nofollow'    => true,
				),
				'condition'     => array(
					'EmbedType' => 'twitter',
					'TweetType' => 'timelines',
					'TwGuides'  => 'List',
				),
				'separator'     => 'before',
			)
		);
		$this->add_control(
			'TwlisturlNote',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => 'Note : How to <a href="https://tweetdeck.twitter.com/"  target="_blank" rel="noopener noreferrer">Create List ?</a>',
				'content_classes' => 'tp-widget-description',
				'condition'       => array(
					'EmbedType' => 'twitter',
					'TweetType' => 'timelines',
					'TwGuides'  => 'List',
				),
			)
		);
		$this->add_control(
			'TwCollection',
			array(
				'label'         => __( 'Collection URL', 'tpebl' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'Paste URL Here', 'tpebl' ),
				'show_external' => true,
				'dynamic'       => array( 'active' => true ),
				'default'       => array(
					'url'         => 'https://twitter.com/TwitterDev/timelines/539487832448843776',
					'is_external' => true,
					'nofollow'    => true,
				),
				'condition'     => array(
					'EmbedType' => 'twitter',
					'TweetType' => 'timelines',
					'TwGuides'  => 'Collection',
				),
				'separator'     => 'before',
			)
		);
		$this->add_control(
			'TwCollectionNote',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => 'Note : How to <a href="https://tweetdeck.twitter.com/"  target="_blank" rel="noopener noreferrer">Create Collections ?</a>',
				'content_classes' => 'tp-widget-description',
				'condition'       => array(
					'EmbedType' => 'twitter',
					'TweetType' => 'timelines',
					'TwGuides'  => 'Collection',
				),
			)
		);
		$this->add_control(
			'Twbutton',
			array(
				'label'     => esc_html__( 'Button Type', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'follow',
				'options'   => array(
					'Tweets'  => esc_html__( 'Tweets', 'tpebl' ),
					'follow'  => esc_html__( 'Follow', 'tpebl' ),
					'Message' => esc_html__( 'Direct Message', 'tpebl' ),
					'like'    => esc_html__( 'Like', 'tpebl' ),
					'Reply'   => esc_html__( 'Reply', 'tpebl' ),
					'Retweet' => esc_html__( 'Retweet', 'tpebl' ),
				),
				'condition' => array(
					'EmbedType' => 'twitter',
					'TweetType' => 'buttons',
				),
			)
		);
		$this->add_control(
			'Twname',
			array(
				'label'      => esc_html__( 'Username', 'tpebl' ),
				'type'       => Controls_Manager::TEXT,
				'default'    => esc_html__( 'TwitterDev', 'tpebl' ),
				'dynamic'    => array(
					'active' => true,
				),
				'separator'  => 'before',
				'condition'  => array(
					'EmbedType' => 'twitter',
				),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'terms' => array(
								array(
									'name'     => 'TweetType',
									'operator' => '===',
									'value'    => 'timelines',
								),
								array(
									'name'     => 'TwGuides',
									'operator' => 'in',
									'value'    => array( 'Profile', 'Likes' ),
								),
							),
						),
						array(
							'terms' => array(
								array(
									'name'     => 'TweetType',
									'operator' => '===',
									'value'    => 'buttons',
								),
								array(
									'name'     => 'Twbutton',
									'operator' => 'in',
									'value'    => array( 'follow', 'Message' ),
								),
							),
						),
					),
				),
			)
		);
		$this->add_control(
			'TwRId',
			array(
				'label'     => esc_html__( 'Message ID', 'tpebl' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( '3805104374', 'tpebl' ),
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'EmbedType' => 'twitter',
					'TweetType' => 'buttons',
					'Twbutton'  => 'Message',
				),
			)
		);
		$this->add_control(
			'TwTweetId',
			array(
				'label'     => esc_html__( 'Tweet ID', 'tpebl' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( '463440424141459456', 'tpebl' ),
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'EmbedType' => 'twitter',
					'TweetType' => 'buttons',
					'Twbutton'  => array( 'like', 'Reply', 'Retweet' ),
				),
			)
		);
		$this->add_control(
			'ReMrTwPost',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => 'Note : <a href="https://developer.twitter.com/en/docs/twitter-for-websites/embedded-tweets/overview"  target="_blank" rel="noopener noreferrer">Read More About All Options</a>',
				'content_classes' => 'tp-widget-description',
				'condition'       => array(
					'EmbedType' => 'twitter',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'semd_Tw_opts',
			array(
				'label'     => esc_html__( 'Twitter Options', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'EmbedType' => 'twitter',
				),
			)
		);
		$this->add_control(
			'TwColor',
			array(
				'label'     => esc_html__( 'Dark Mode', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'condition' => array(
					'EmbedType' => 'twitter',
					'TweetType' => array( 'Tweets', 'timelines' ),
				),
			)
		);
		$this->add_control(
			'TwCards',
			array(
				'label'     => esc_html__( 'Disable Media', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'condition' => array(
					'EmbedType' => 'twitter',
					'TweetType' => 'Tweets',
				),
			)
		);
		$this->add_control(
			'Twconver',
			array(
				'label'     => esc_html__( 'Disable Conversation', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'condition' => array(
					'EmbedType' => 'twitter',
					'TweetType' => 'Tweets',
				),
			)
		);
		$this->add_control(
			'Twalign',
			array(
				'label'     => esc_html__( 'Alignment', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'center',
				'options'   => array(
					'left'   => esc_html__( 'Left', 'tpebl' ),
					'center' => esc_html__( 'Center', 'tpebl' ),
					'right'  => esc_html__( 'Right', 'tpebl' ),
				),
				'condition' => array(
					'EmbedType' => 'twitter',
					'TweetType' => 'Tweets',
				),
			)
		);
		$this->add_control(
			'TwBrCr',
			array(
				'label'     => esc_html__( 'Separator Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'separator' => 'before',
				'condition' => array(
					'EmbedType' => 'twitter',
					'TweetType' => 'timelines',
				),
			)
		);
		$this->add_control(
			'TwDesign',
			array(
				'label'       => esc_html__( 'Button', 'tpebl' ),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'default'     => '',
				'options'     => array(
					'noheader'    => esc_html__( 'No Header', 'tpebl' ),
					'nofooter'    => esc_html__( 'No Footer', 'tpebl' ),
					'noborders'   => esc_html__( 'No Borders', 'tpebl' ),
					'noscrollbar' => esc_html__( 'No Scrollbar', 'tpebl' ),
					'transparent' => esc_html__( 'Transparent', 'tpebl' ),
				),
				'label_block' => true,
				'condition'   => array(
					'EmbedType' => 'twitter',
					'TweetType' => 'timelines',
				),
			)
		);
		$this->add_responsive_control(
			'Twlimit',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Tweet Limit', 'tpebl' ),
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
					'size' => '',
				),
				'render_type' => 'ui',
				'condition'   => array(
					'EmbedType' => 'twitter',
					'TweetType' => 'timelines',
				),
				'separator'   => 'before',
			)
		);
		$this->add_responsive_control(
			'Twwidth',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Width ( px )', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'condition'   => array(
					'EmbedType' => 'twitter',
					'TweetType' => array( 'Tweets', 'timelines' ),
				),
				'separator'   => 'before',
			)
		);
		$this->add_responsive_control(
			'Twheight',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Height ( px )', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 2000,
						'step' => 10,
					),
				),
				'render_type' => 'ui',
				'condition'   => array(
					'EmbedType' => 'twitter',
					'TweetType' => 'timelines',
					'Twstyle'   => 'linear',
				),
				'separator'   => 'before',
			)
		);
		$this->add_control(
			'TwBtnSize',
			array(
				'label'     => esc_html__( 'Button Size', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => array(
					''      => esc_html__( 'Normal', 'tpebl' ),
					'large' => esc_html__( 'Large', 'tpebl' ),
				),
				'condition' => array(
					'EmbedType' => 'twitter',
					'TweetType' => 'buttons',
					'Twbutton'  => array( 'Tweets', 'follow', 'Message' ),
				),
			)
		);
		$this->add_control(
			'TwTextBtn',
			array(
				'label'     => esc_html__( 'Tweet Text', 'tpebl' ),
				'type'      => Controls_Manager::TEXTAREA,
				'rows'      => 3,
				'default'   => esc_html__( 'Hello', 'tpebl' ),
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'EmbedType' => 'twitter',
					'TweetType' => 'buttons',
					'Twbutton'  => array( 'Tweets' ),
				),
			)
		);
		$this->add_control(
			'TwTweetUrl',
			array(
				'label'         => __( 'Page URL', 'tpebl' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'Paste URL Here', 'tpebl' ),
				'show_external' => true,
				'dynamic'       => array( 'active' => true ),
				'default'       => array(
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				),
				'condition'     => array(
					'EmbedType' => 'twitter',
					'TweetType' => 'buttons',
					'Twbutton'  => array( 'Tweets' ),
				),
			)
		);
		$this->add_control(
			'TwHashtags',
			array(
				'label'       => esc_html__( 'Hashtags ( Tag1 #Tag2 )', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Twitter', 'tpebl' ),
				'placeholder' => esc_html__( '#Tag1 #Tag2 #tag3', 'tpebl' ),
				'dynamic'     => array(
					'active' => true,
				),
				'label_block' => true,
				'condition'   => array(
					'EmbedType' => 'twitter',
					'TweetType' => 'buttons',
					'Twbutton'  => array( 'Tweets' ),
				),
			)
		);
		$this->add_control(
			'TwVia',
			array(
				'label'       => esc_html__( 'Via ( Tag1 @Tag2 )', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Twitter', 'tpebl' ),
				'placeholder' => esc_html__( 'Tag1 @Tag2 @tag3', 'tpebl' ),
				'dynamic'     => array(
					'active' => true,
				),
				'label_block' => true,
				'condition'   => array(
					'EmbedType' => 'twitter',
					'TweetType' => 'buttons',
					'Twbutton'  => array( 'Tweets' ),
				),
			)
		);
		$this->add_control(
			'TwCount',
			array(
				'label'     => esc_html__( 'Followers Count', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => array(
					'EmbedType' => 'twitter',
					'TweetType' => 'buttons',
					'Twbutton'  => array( 'follow' ),
				),
			)
		);
		$this->add_control(
			'TwHideUname',
			array(
				'label'     => esc_html__( 'Disable Username', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'condition' => array(
					'EmbedType' => 'twitter',
					'TweetType' => 'buttons',
					'Twbutton'  => array( 'follow', 'Message' ),
				),
			)
		);
		$this->add_control(
			'TwMessage',
			array(
				'label'     => esc_html__( 'Message Text', 'tpebl' ),
				'type'      => Controls_Manager::TEXTAREA,
				'rows'      => 3,
				'default'   => esc_html__( 'Hello', 'tpebl' ),
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'EmbedType' => 'twitter',
					'TweetType' => 'buttons',
					'Twbutton'  => array( 'Message' ),
				),
			)
		);
		$this->add_control(
			'TwIcon',
			array(
				'label'     => esc_html__( 'Disable Icon', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'condition' => array(
					'EmbedType' => 'twitter',
					'TweetType' => 'buttons',
					'Twbutton'  => array( 'like', 'Reply', 'Retweet' ),
				),
			)
		);
		$this->add_control(
			'likeBtn',
			array(
				'label'     => esc_html__( 'Button Text', 'tpebl' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Like', 'tpebl' ),
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'EmbedType' => 'twitter',
					'TweetType' => 'buttons',
					'Twbutton'  => array( 'like' ),
				),
			)
		);
		$this->add_control(
			'ReplyBtn',
			array(
				'label'     => esc_html__( 'Button Text', 'tpebl' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Reply', 'tpebl' ),
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'EmbedType' => 'twitter',
					'TweetType' => 'buttons',
					'Twbutton'  => array( 'Reply' ),
				),
			)
		);
		$this->add_control(
			'RetweetBtn',
			array(
				'label'     => esc_html__( 'Button Text', 'tpebl' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Retweet', 'tpebl' ),
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'EmbedType' => 'twitter',
					'TweetType' => 'buttons',
					'Twbutton'  => array( 'Retweet' ),
				),
			)
		);
		$this->add_control(
			'TwMsg',
			array(
				'label'       => esc_html__( 'Loading Message', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Loading', 'tpebl' ),
				'dynamic'     => array(
					'active' => true,
				),
				'label_block' => true,
				'condition'   => array(
					'EmbedType' => 'twitter',
					'TweetType' => 'buttons',
				),
				'separator'   => 'before',
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'semd_Vm',
			array(
				'label'     => esc_html__( 'Vimeo', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'EmbedType' => 'vimeo',
				),
			)
		);
		$this->add_control(
			'ViId',
			array(
				'label'     => esc_html__( 'Vimeo ID', 'tpebl' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( '288344114', 'tpebl' ),
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'EmbedType' => 'vimeo',
				),
			)
		);
		$this->add_control(
			'ViOption',
			array(
				'label'       => esc_html__( 'Vimeo Option', 'tpebl' ),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'default'     => '',
				'options'     => array(
					'loop'        => esc_html__( 'Loop', 'tpebl' ),
					'muted'       => esc_html__( 'Muted', 'tpebl' ),
					'speed'       => esc_html__( 'Speed (Pro Account)', 'tpebl' ),
					'title'       => esc_html__( 'Title', 'tpebl' ),
					'autoplay'    => esc_html__( 'Autoplay', 'tpebl' ),
					'autopause'   => esc_html__( 'AutoPause', 'tpebl' ),
					'portrait'    => esc_html__( 'Portrait', 'tpebl' ),
					'fullscreen'  => esc_html__( 'FullScreen', 'tpebl' ),
					'background'  => esc_html__( 'Background (Plus Account)', 'tpebl' ),
					'playsinline' => esc_html__( 'PlaysInline', 'tpebl' ),
					'byline'      => esc_html__( 'Byline (Username)', 'tpebl' ),
					'transparent' => esc_html__( 'Transparent', 'tpebl' ),
					'dnt'         => esc_html__( 'Do Not Track (DNT)', 'tpebl' ),
					'pip'         => esc_html__( 'Picture In Picture (PIP)', 'tpebl' ),
				),
				'label_block' => true,
				'condition'   => array(
					'EmbedType' => 'vimeo',
				),
			)
		);
		$this->add_control(
			'VmAutoplayNote',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => 'Note : The <b>mute</b> option should be required when you select the <b>autoplay</b> option.',
				'content_classes' => 'tp-widget-description',
				'condition'       => array(
					'EmbedType' => 'vimeo',
				),
			)
		);
		$this->add_control(
			'ReMrVmPost',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => 'Note : <a href="https://vimeo.zendesk.com/hc/en-us/articles/360001494447-Using-Player-Parameters"  target="_blank" rel="noopener noreferrer">Read More About All Options</a>',
				'content_classes' => 'tp-widget-description',
				'condition'       => array(
					'EmbedType' => 'vimeo',
				),
			)
		);
		$this->add_control(
			'VmStime',
			array(
				'label'       => esc_html__( 'Video Start Time', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'E.g : 5m0s', 'tpebl' ),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'EmbedType' => 'vimeo',
				),
			)
		);
		$this->add_control(
			'VmColor',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'EmbedType' => 'vimeo',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'semd_Ig',
			array(
				'label'     => esc_html__( 'Instagram', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'EmbedType' => 'instagram',
				),
			)
		);
		$this->add_control(
			'IGType',
			array(
				'label'     => esc_html__( 'Instagram Type', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'posts',
				'options'   => array(
					'posts' => esc_html__( 'Posts', 'tpebl' ),
					'reels' => esc_html__( 'Reels', 'tpebl' ),
					'igtv'  => esc_html__( 'IGTV', 'tpebl' ),
				),
				'condition' => array(
					'EmbedType' => 'instagram',
				),
			)
		);
		$this->add_control(
			'IGId',
			array(
				'label'     => esc_html__( 'Instagram ID', 'tpebl' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'CGAvnLcA3zb', 'tpebl' ),
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'EmbedType' => 'instagram',
				),
			)
		);
		$this->add_control(
			'IGCaptione',
			array(
				'label'     => esc_html__( 'Disable Captioned', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'condition' => array(
					'EmbedType' => 'instagram',
				),
			)
		);
		$this->add_control(
			'ReMrIgPost',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => 'Note : <a href="https://developers.facebook.com/docs/instagram"  target="_blank" rel="noopener noreferrer">Read More About All Options</a>',
				'content_classes' => 'tp-widget-description',
				'condition'       => array(
					'EmbedType' => 'instagram',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'semd_Yt',
			array(
				'label'     => esc_html__( 'YouTube', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'EmbedType' => 'youtube',
				),
			)
		);
		$this->add_control(
			'YtType',
			array(
				'label'     => esc_html__( 'YouTube Type', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'YtSV',
				'options'   => array(
					'YtSV'    => esc_html__( 'Single Video', 'tpebl' ),
					'YtPlayV' => esc_html__( 'Playlist Video', 'tpebl' ),
					'YtuserV' => esc_html__( 'Users Video', 'tpebl' ),
				),
				'condition' => array(
					'EmbedType' => 'youtube',
				),
			)
		);
		$this->add_control(
			'YtVideoId',
			array(
				'label'       => esc_html__( 'Video ID', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'XmtXC_n6X6Q', 'tpebl' ),
				'dynamic'     => array(
					'active' => true,
				),
				'label_block' => true,
				'condition'   => array(
					'EmbedType' => 'youtube',
					'YtType'    => 'YtSV',
				),
			)
		);
		$this->add_control(
			'YtPlaylistId',
			array(
				'label'       => esc_html__( 'Playlist ID', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'PLivjPDlt6ApQgylktXlL2AhuPvRtDiN1S', 'tpebl' ),
				'dynamic'     => array(
					'active' => true,
				),
				'label_block' => true,
				'condition'   => array(
					'EmbedType' => 'youtube',
					'YtType'    => 'YtPlayV',
				),
			)
		);
		$this->add_control(
			'YtUsername',
			array(
				'label'       => esc_html__( 'Username', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'NationalGeographic', 'tpebl' ),
				'dynamic'     => array(
					'active' => true,
				),
				'label_block' => true,
				'condition'   => array(
					'EmbedType' => 'youtube',
					'YtType'    => 'YtuserV',
				),
			)
		);
		$this->add_control(
			'YtOption',
			array(
				'label'       => esc_html__( 'YouTube Option', 'tpebl' ),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'default'     => '',
				'options'     => array(
					'loop'           => esc_html__( 'Loop', 'tpebl' ),
					'fs'             => esc_html__( 'FullScreen', 'tpebl' ),
					'autoplay'       => esc_html__( 'Autoplay', 'tpebl' ),
					'mute'           => esc_html__( 'Muted', 'tpebl' ),
					'controls'       => esc_html__( 'Controls Enable', 'tpebl' ),
					'disablekb'      => esc_html__( 'Disable Keyboard', 'tpebl' ),
					'modestbranding' => esc_html__( 'Disable Youtube Icon', 'tpebl' ),
					'playsinline'    => esc_html__( 'PlaysInline', 'tpebl' ),
					'rel'            => esc_html__( 'Related Video', 'tpebl' ),
				),
				'label_block' => true,
				'condition'   => array(
					'EmbedType' => 'youtube',
				),
			)
		);
		$this->add_control(
			'YtAutoplayNote',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => 'Note : The <b>mute</b> option should be required when you select the <b>autoplay</b> option.',
				'content_classes' => 'tp-widget-description',
				'condition'       => array(
					'EmbedType' => 'youtube',
				),
			)
		);
		$this->add_control(
			'ReMrYtPost',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => 'Note : <a href="https://developers.google.com/youtube/player_parameters"  target="_blank" rel="noopener noreferrer">Read More About All Options</a>',
				'content_classes' => 'tp-widget-description',
				'condition'       => array(
					'EmbedType' => 'youtube',
				),
			)
		);
		$this->add_control(
			'YtSTime',
			array(
				'label'       => esc_html__( 'Start Time', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'E.g : 60', 'tpebl' ),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'EmbedType' => 'youtube',
				),
			)
		);
		$this->add_control(
			'YtETime',
			array(
				'label'       => esc_html__( 'End Time', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'E.g : 60', 'tpebl' ),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'EmbedType' => 'youtube',
				),
			)
		);
		$this->add_control(
			'Ytlanguage',
			array(
				'label'       => esc_html__( 'Language', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'E.g : en', 'tpebl' ),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'EmbedType' => 'youtube',
				),
			)
		);
		$this->add_control(
			'YtLangNote',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => 'Note : <a href="http://www.loc.gov/standards/iso639-2/php/code_list.php" target="_blank" rel="noopener noreferrer">Language ISO 639-1 Code</a>',
				'content_classes' => 'tp-widget-description',
				'condition'       => array(
					'EmbedType' => 'youtube',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'Map_section',
			array(
				'label'     => esc_html__( 'Google Map', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'EmbedType' => 'googlemap',
				),
			)
		);
		$this->add_control(
			'Mapaccesstoken',
			array(
				'label'   => esc_html__( 'Map Type', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => array(
					'default'     => esc_html__( 'Default', 'tpebl' ),
					'accesstoken' => esc_html__( 'Access Token', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'GAccesstoken',
			array(
				'label'       => __( 'AccessToken', 'tpebl' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 2,
				'default'     => '',
				'placeholder' => __( 'Enter AccessToken', 'tpebl' ),
				'condition'   => array(
					'Mapaccesstoken' => 'accesstoken',
				),
			)
		);
		$this->add_control(
			'GMapModes',
			array(
				'label'     => esc_html__( 'Map Modes', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'search',
				'options'   => array(
					'place'      => esc_html__( 'Place Mode', 'tpebl' ),
					'directions' => esc_html__( 'Directions Mode', 'tpebl' ),
					'streetview' => esc_html__( 'Streetview Mode', 'tpebl' ),
					'search'     => esc_html__( 'Search Mode', 'tpebl' ),
				),
				'condition' => array(
					'Mapaccesstoken' => 'accesstoken',
				),
			)
		);
		$this->add_control(
			'GSearchText',
			array(
				'label'       => __( 'Search Text', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'New York, NY, USA', 'tpebl' ),
				'placeholder' => __( 'Enter Location Text', 'tpebl' ),
				'condition'   => array(
					'GMapModes' => array( 'place', 'search' ),
				),
			)
		);
		$this->add_control(
			'GOrigin',
			array(
				'label'       => __( 'Starting point', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'LosAngeles+California+USA', 'tpebl' ),
				'placeholder' => __( 'Enter Starting Point', 'tpebl' ),
				'separator'   => 'before',
				'condition'   => array(
					'Mapaccesstoken' => 'accesstoken',
					'GMapModes'      => 'directions',
				),
			)
		);
		$this->add_control(
			'GDestination',
			array(
				'label'       => __( 'End Point', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Corona+California+USA', 'tpebl' ),
				'placeholder' => __( 'Enter Starting Point', 'tpebl' ),
				'condition'   => array(
					'Mapaccesstoken' => 'accesstoken',
					'GMapModes'      => 'directions',
				),
			)
		);
		$this->add_control(
			'GWaypoints',
			array(
				'label'       => __( 'Way Points', 'tpebl' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 3,
				'default'     => __( 'Huntington+Beach+California+US | Santa Ana+California+USA', 'tpebl' ),
				'placeholder' => __( 'Type your description here', 'tpebl' ),
				'condition'   => array(
					'Mapaccesstoken' => 'accesstoken',
					'GMapModes'      => 'directions',
				),
			)
		);
		$this->add_control(
			'GTravelMode',
			array(
				'label'     => esc_html__( 'Travel Mode', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'driving',
				'options'   => array(
					'driving'   => esc_html__( 'Driving Mode', 'tpebl' ),
					'bicycling' => esc_html__( 'Bicycling', 'tpebl' ),
					'flying'    => esc_html__( 'Flying', 'tpebl' ),
					'transit'   => esc_html__( 'Transit', 'tpebl' ),
					'walking'   => esc_html__( 'Walking Mode', 'tpebl' ),
				),
				'condition' => array(
					'Mapaccesstoken' => 'accesstoken',
					'GMapModes'      => 'directions',
				),
			)
		);
		$this->add_control(
			'Gavoid',
			array(
				'label'       => esc_html__( 'Avoid Elements', 'tpebl' ),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'default'     => '',
				'options'     => array(
					'tolls'    => __( 'Tolls', 'tpebl' ),
					'highways' => __( 'Highways', 'tpebl' ),
				),
				'label_block' => true,
				'condition'   => array(
					'Mapaccesstoken' => 'accesstoken',
					'GMapModes'      => 'directions',
				),
			)
		);
		$this->add_control(
			'GstreetviewText',
			array(
				'label'       => __( 'latitude and longitude', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( '23.0489,72.5160', 'tpebl' ),
				'placeholder' => __( 'let,long', 'tpebl' ),
				'condition'   => array(
					'Mapaccesstoken' => 'accesstoken',
					'GMapModes'      => 'streetview',
				),
			)
		);
		$this->add_control(
			'Pluscodelink',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => 'Note : <a href="https://plus.codes/7JMJ2GP6+9F" target="_blank" rel="noopener noreferrer">Get latitude and longitude</a>',
				'content_classes' => 'tp-widget-description',
				'condition'       => array(
					'EmbedType' => 'googlemap',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'MapOption_section',
			array(
				'label'     => esc_html__( 'Map Option', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'EmbedType' => 'googlemap',
				),
			)
		);
		$this->add_control(
			'MapViews',
			array(
				'label'     => esc_html__( 'Map View', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'roadmap',
				'options'   => array(
					'roadmap'   => esc_html__( 'Roadmap', 'tpebl' ),
					'satellite' => esc_html__( 'Satellite', 'tpebl' ),
				),
				'condition' => array(
					'Mapaccesstoken' => 'accesstoken',
					'EmbedType'      => 'googlemap',
					'GMapModes!'     => 'streetview',
				),
			)
		);
		$this->add_control(
			'MapZoom',
			array(
				'label'      => __( 'Zoom', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 21,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 3,
				),
				'condition'  => array(
					'GMapModes!' => 'streetview',
				),
			)
		);
		$this->add_responsive_control(
			'GMwidth',
			array(
				'label'      => __( 'Width', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'vw' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					),
					'%'  => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 5,
					),
					'vw' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 5,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 600,
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-embed iframe' => 'width:{{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
			'GMHeight',
			array(
				'label'      => __( 'Height', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'vh' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					),
					'%'  => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 5,
					),
					'vh' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 5,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 450,
				),

				'selectors'  => array(
					'{{WRAPPER}} .tp-social-embed iframe' => 'height:{{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->end_controls_section();
		/*Map option End*/

		/*Extra Options Start*/
		$this->start_controls_section(
			'semd_Extra_opts',
			array(
				'label'     => esc_html__( 'Extra Options', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'EmbedType' => array( 'vimeo', 'youtube' ),
				),
			)
		);
		$this->add_responsive_control(
			'ExWidth',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Width', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1500,
						'step' => 640,
					),
				),
				'render_type' => 'ui',
				'condition'   => array(
					'EmbedType' => array( 'vimeo', 'youtube' ),
				),
				'selectors'   => array(
					'{{WRAPPER}} .tp-social-embed iframe.tp-frame-set' => 'width: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
			'ExHeight',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Height', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1500,
						'step' => 360,
					),
				),
				'render_type' => 'ui',
				'condition'   => array(
					'EmbedType' => array( 'vimeo', 'youtube' ),
				),
				'selectors'   => array(
					'{{WRAPPER}} .tp-social-embed iframe.tp-frame-set' => 'height: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->end_controls_section();
		/*Extra Options End*/

		/*Embed Options Style Start*/
		$this->start_controls_section(
			'section_EmdOpt_styling',
			array(
				'label' => esc_html__( 'Embed Options', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'AlignmentBG',
			array(
				'label'     => esc_html__( 'Content Alignment', 'tpebl' ),
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
					'{{WRAPPER}} .tp-social-embed' => 'text-align: {{VALUE}}',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_EmdOpt_stl' );
		$this->start_controls_tab(
			'tab_EmdOpt_Nml',
			array(
				'label'      => esc_html__( 'Normal', 'tpebl' ),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'terms' => array(
								array(
									'name'     => 'EmbedType',
									'operator' => '===',
									'value'    => 'facebook',
								),
								array(
									'name'     => 'Type',
									'operator' => 'in',
									'value'    => array( 'comments', 'posts', 'videos', 'page' ),
								),
							),
						),
						array(
							'terms' => array(
								array(
									'name'     => 'EmbedType',
									'operator' => '===',
									'value'    => 'twitter',
								),
								array(
									'name'     => 'TweetType',
									'operator' => '===',
									'value'    => 'buttons',
								),
								array(
									'name'     => 'Twbutton',
									'operator' => 'in',
									'value'    => array( 'like', 'Reply', 'Retweet' ),
								),
							),
						),
					),
				),
			)
		);
		$this->add_control(
			'TwBtnCr',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tw-button' => 'color:{{VALUE}};',
				),
				'condition' => array(
					'EmbedType' => 'twitter',
					'TweetType' => 'buttons',
					'Twbutton'  => array( 'like', 'Reply', 'Retweet' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'TwBtnBg',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .tw-button',
				'condition' => array(
					'EmbedType' => 'twitter',
					'TweetType' => 'buttons',
					'Twbutton'  => array( 'like', 'Reply', 'Retweet' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'       => 'BorderPost',
				'label'      => esc_html__( 'Border', 'tpebl' ),
				'selector'   => '{{WRAPPER}} .tp-fb-iframe,{{WRAPPER}} .tw-button',
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'terms' => array(
								array(
									'name'     => 'EmbedType',
									'operator' => '===',
									'value'    => 'facebook',
								),
								array(
									'name'     => 'Type',
									'operator' => 'in',
									'value'    => array( 'comments', 'posts', 'videos', 'page' ),
								),
							),
						),
						array(
							'terms' => array(
								array(
									'name'     => 'EmbedType',
									'operator' => '===',
									'value'    => 'twitter',
								),
								array(
									'name'     => 'TweetType',
									'operator' => '===',
									'value'    => 'buttons',
								),
								array(
									'name'     => 'Twbutton',
									'operator' => 'in',
									'value'    => array( 'like', 'Reply', 'Retweet' ),
								),
							),
						),
					),
				),
			)
		);
		$this->add_responsive_control(
			'BorderRs',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-fb-iframe,{{WRAPPER}} .tw-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'terms' => array(
								array(
									'name'     => 'EmbedType',
									'operator' => '===',
									'value'    => 'facebook',
								),
								array(
									'name'     => 'Type',
									'operator' => 'in',
									'value'    => array( 'comments', 'posts', 'videos', 'page' ),
								),
							),
						),
						array(
							'terms' => array(
								array(
									'name'     => 'EmbedType',
									'operator' => '===',
									'value'    => 'twitter',
								),
								array(
									'name'     => 'TweetType',
									'operator' => '===',
									'value'    => 'buttons',
								),
								array(
									'name'     => 'Twbutton',
									'operator' => 'in',
									'value'    => array( 'like', 'Reply', 'Retweet' ),
								),
							),
						),
					),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'       => 'BoxS',
				'selector'   => '{{WRAPPER}} .tp-fb-iframe,{{WRAPPER}} .tw-button',
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'terms' => array(
								array(
									'name'     => 'EmbedType',
									'operator' => '===',
									'value'    => 'facebook',
								),
								array(
									'name'     => 'Type',
									'operator' => 'in',
									'value'    => array( 'comments', 'posts', 'videos', 'page' ),
								),
							),
						),
						array(
							'terms' => array(
								array(
									'name'     => 'EmbedType',
									'operator' => '===',
									'value'    => 'twitter',
								),
								array(
									'name'     => 'TweetType',
									'operator' => '===',
									'value'    => 'buttons',
								),
								array(
									'name'     => 'Twbutton',
									'operator' => 'in',
									'value'    => array( 'like', 'Reply', 'Retweet' ),
								),
							),
						),
					),
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_EmdOpt_Hvr',
			array(
				'label'      => esc_html__( 'Hover', 'tpebl' ),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'terms' => array(
								array(
									'name'     => 'EmbedType',
									'operator' => '===',
									'value'    => 'facebook',
								),
								array(
									'name'     => 'Type',
									'operator' => 'in',
									'value'    => array( 'comments', 'posts', 'videos', 'page' ),
								),
							),
						),
						array(
							'terms' => array(
								array(
									'name'     => 'EmbedType',
									'operator' => '===',
									'value'    => 'twitter',
								),
								array(
									'name'     => 'TweetType',
									'operator' => '===',
									'value'    => 'buttons',
								),
								array(
									'name'     => 'Twbutton',
									'operator' => 'in',
									'value'    => array( 'like', 'Reply', 'Retweet' ),
								),
							),
						),
					),
				),
			)
		);
		$this->add_control(
			'TwBtnCrH',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tw-button:hover' => 'color:{{VALUE}};',
				),
				'condition' => array(
					'EmbedType' => 'twitter',
					'TweetType' => 'buttons',
					'Twbutton'  => array( 'like', 'Reply', 'Retweet' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'TwBtnBgH',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .tw-button:hover',
				'condition' => array(
					'EmbedType' => 'twitter',
					'TweetType' => 'buttons',
					'Twbutton'  => array( 'like', 'Reply', 'Retweet' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'       => 'BorderPostHr',
				'label'      => esc_html__( 'Border', 'tpebl' ),
				'selector'   => '{{WRAPPER}} .tp-fb-iframe:hover,{{WRAPPER}} .tw-button:hover',
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'terms' => array(
								array(
									'name'     => 'EmbedType',
									'operator' => '===',
									'value'    => 'facebook',
								),
								array(
									'name'     => 'Type',
									'operator' => 'in',
									'value'    => array( 'comments', 'posts', 'videos', 'page' ),
								),
							),
						),
						array(
							'terms' => array(
								array(
									'name'     => 'EmbedType',
									'operator' => '===',
									'value'    => 'twitter',
								),
								array(
									'name'     => 'TweetType',
									'operator' => '===',
									'value'    => 'buttons',
								),
								array(
									'name'     => 'Twbutton',
									'operator' => 'in',
									'value'    => array( 'like', 'Reply', 'Retweet' ),
								),
							),
						),
					),
				),
			)
		);
		$this->add_responsive_control(
			'BorderHRs',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-fb-iframe:hover,{{WRAPPER}} .tw-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'terms' => array(
								array(
									'name'     => 'EmbedType',
									'operator' => '===',
									'value'    => 'facebook',
								),
								array(
									'name'     => 'Type',
									'operator' => 'in',
									'value'    => array( 'comments', 'posts', 'videos', 'page' ),
								),
							),
						),
						array(
							'terms' => array(
								array(
									'name'     => 'EmbedType',
									'operator' => '===',
									'value'    => 'twitter',
								),
								array(
									'name'     => 'TweetType',
									'operator' => '===',
									'value'    => 'buttons',
								),
								array(
									'name'     => 'Twbutton',
									'operator' => 'in',
									'value'    => array( 'like', 'Reply', 'Retweet' ),
								),
							),
						),
					),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'       => 'BoxSHr',
				'selector'   => '{{WRAPPER}} .tp-fb-iframe:hover,{{WRAPPER}} .tw-button:hover',
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'terms' => array(
								array(
									'name'     => 'EmbedType',
									'operator' => '===',
									'value'    => 'facebook',
								),
								array(
									'name'     => 'Type',
									'operator' => 'in',
									'value'    => array( 'comments', 'posts', 'videos', 'page' ),
								),
							),
						),
						array(
							'terms' => array(
								array(
									'name'     => 'EmbedType',
									'operator' => '===',
									'value'    => 'twitter',
								),
								array(
									'name'     => 'TweetType',
									'operator' => '===',
									'value'    => 'buttons',
								),
								array(
									'name'     => 'Twbutton',
									'operator' => 'in',
									'value'    => array( 'like', 'Reply', 'Retweet' ),
								),
							),
						),
					),
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'EmbedBrstyle',
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
					'EmbedType' => array( 'vimeo', 'instagram', 'youtube' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .tp-social-embed iframe' => 'border-style: {{VALUE}} !important',
				),
			)
		);
		$this->add_responsive_control(
			'EmbedBrwidth',
			array(
				'label'      => esc_html__( 'Border Width', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'condition'  => array(
					'EmbedType'     => array( 'vimeo', 'instagram', 'youtube' ),
					'EmbedBrstyle!' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-embed iframe' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			)
		);
		$this->add_control(
			'EmbedBrcolor',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'EmbedType'     => array( 'vimeo', 'instagram', 'youtube' ),
					'EmbedBrstyle!' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .tp-social-embed iframe' => 'border-color: {{VALUE}} !important',
				),
			)
		);
		$this->add_control(
			'EmbedBsd',
			array(
				'label'        => esc_html__( 'Box Shadow', 'tpebl' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'tpebl' ),
				'label_on'     => __( 'Custom', 'tpebl' ),
				'return_value' => 'yes',
				'condition'    => array(
					'EmbedType' => array( 'vimeo', 'instagram', 'youtube' ),
				),
			)
		);
		$this->start_popover();
		$this->add_control(
			'EmbedBsd_color',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(0,0,0,0.5)',
				'condition' => array(
					'EmbedType' => array( 'vimeo', 'instagram', 'youtube' ),
					'EmbedBsd'  => 'yes',
				),
			)
		);
		$this->add_control(
			'EmbedBsd_horizontal',
			array(
				'label'      => esc_html__( 'Horizontal', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'max'  => 100,
						'min'  => -100,
						'step' => 2,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 0,
				),
				'condition'  => array(
					'EmbedType' => array( 'vimeo', 'instagram', 'youtube' ),
					'EmbedBsd'  => 'yes',
				),
			)
		);
		$this->add_control(
			'EmbedBsd_vertical',
			array(
				'label'      => esc_html__( 'Vertical', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'max'  => 100,
						'min'  => -100,
						'step' => 2,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 0,
				),
				'condition'  => array(
					'EmbedType' => array( 'vimeo', 'instagram', 'youtube' ),
					'EmbedBsd'  => 'yes',
				),
			)
		);
		$this->add_control(
			'EmbedBsd_blur',
			array(
				'label'      => esc_html__( 'Blur', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'max'  => 100,
						'min'  => 0,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 10,
				),
				'condition'  => array(
					'EmbedType' => array( 'vimeo', 'instagram', 'youtube' ),
					'EmbedBsd'  => 'yes',
				),
			)
		);
		$this->add_control(
			'EmbedBsd_spread',
			array(
				'label'      => esc_html__( 'Spread', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'max'  => 100,
						'min'  => -100,
						'step' => 2,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 0,
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-social-embed iframe' => 'box-shadow: {{EmbedBsd_horizontal.SIZE}}{{EmbedBsd_horizontal.UNIT}} {{EmbedBsd_vertical.SIZE}}{{EmbedBsd_vertical.UNIT}} {{EmbedBsd_blur.SIZE}}{{EmbedBsd_blur.UNIT}} {{EmbedBsd_spread.SIZE}}{{EmbedBsd_spread.UNIT}} {{EmbedBsd_color.VALUE}} !important',
				),
				'condition'  => array(
					'EmbedType' => array( 'vimeo', 'instagram', 'youtube' ),
					'EmbedBsd'  => 'yes',
				),
			)
		);
		$this->end_popover();
		$this->add_control(
			'SemdBgOpt',
			array(
				'label'     => esc_html__( 'Outer Background Option', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'SocialBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-social-embed',
			)
		);
		$this->end_controls_section();
		/*Embed Options Style End*/
	}

	/**
	 * Register controls.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	protected function render() {

		$settings   = $this->get_settings_for_display();
		$uid_sembed = uniqid( 'tp-sembed' );
		$embed_type = ! empty( $settings['EmbedType'] ) ? $settings['EmbedType'] : 'facebook';

		$output  = '';
		$lz2     = function_exists( 'tp_has_lazyload' ) ? tp_bg_lazyLoad( $settings['SocialBg_image'] ) : '';
		$output .= '<div class="tp-widget-' . esc_attr( $uid_sembed ) . ' tp-social-embed ' . $lz2 . '">';
		if ( 'vimeo' === $embed_type || 'youtube' === $embed_type ) {
			$ex_width  = ! empty( $settings['ExWidth']['size'] ) ? $settings['ExWidth']['size'] : 640;
			$ex_height = ! empty( $settings['ExHeight']['size'] ) ? $settings['ExHeight']['size'] : 360;
		}
		if ( 'facebook' === $embed_type ) {
			$f_type   = ! empty( $settings['Type'] ) ? $settings['Type'] : '';
			$size_btn = ! empty( $settings['SizeLB'] ) ? $settings['SizeLB'] : '';
			if ( 'comments' === $f_type ) {
				$comment_type = ! empty( $settings['CommentType'] ) ? $settings['CommentType'] : 'viewcomment';
				if ( 'viewcomment' === $comment_type ) {
					$comment_url = ! empty( $settings['CommentURL'] ) && ! empty( $settings['CommentURL']['url'] ) ? urlencode( $settings['CommentURL']['url'] ) : '';
					$fb_wdcmt    = ! empty( $settings['wdCmt']['size'] ) ? $settings['wdCmt']['size'] : 560;
					$fbh_gcmt    = ! empty( $settings['HgCmt']['size'] ) ? $settings['HgCmt']['size'] : 300;
					$pcomentct   = ! empty( 'yes' === $settings['PcomentcT'] ) ? true : false;
					if ( ! empty( $comment_url ) ) {
						$output .= '<iframe class="tp-fb-iframe" src="https://www.facebook.com/plugins/comment_embed.php?href=' . esc_attr( $comment_url ) . '&include_parent=' . esc_attr( $pcomentct ) . '&width=' . esc_attr( $fb_wdcmt ) . '&height=' . esc_attr( $fbh_gcmt ) . '&appId=" width="' . esc_attr( $fb_wdcmt ) . '" height="' . esc_attr( $fbh_gcmt ) . '" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media" ></iframe>';
					} else {
						$output .= 'URL Empty';
					}
				} elseif ( 'onlypost' === $comment_type ) {
					$fb_comments_add = ! empty( $settings['CommentAddURL'] ) && ! empty( $settings['CommentAddURL']['url'] ) ? $settings['CommentAddURL']['url'] : '';
					$target_c        = ! empty( $settings['TargetC'] ) ? $settings['TargetC'] : 'custom';
					if ( 'currentpage' === $target_c ) {
						$url_fc  = ! empty( $settings['URLFC'] ) ? $settings['URLFC'] : 'plain';
						$post_id = get_the_ID();
						if ( 'plain' === $url_fc ) {
							$plain_url = get_permalink( $post_id );
							$output   .= '<div class="fb-comments tp-fb-iframe" data-href="' . esc_url( $plain_url ) . '" data-width="" data-numposts="' . esc_attr( $settings['CountC'] ) . '" data-order-by="' . esc_attr( $settings['OrderByC'] ) . '" ></div>';
						} elseif ( 'pretty' === $url_fc ) {
							$pretty_url = add_query_arg( 'p', $post_id, home_url() );
							$output    .= '<div class="fb-comments tp-fb-iframe" data-href="' . esc_url( $pretty_url ) . '" data-width="" data-numposts="' . esc_attr( $settings['CountC'] ) . '" data-order-by="' . esc_attr( $settings['OrderByC'] ) . '" ></div>';
						}
					} else {
						$output .= '<div class="fb-comments tp-fb-iframe" data-href="' . esc_url( $fb_comments_add ) . '" data-width="" data-numposts="' . esc_attr( $settings['CountC'] ) . '" data-order-by="' . esc_attr( $settings['OrderByC'] ) . '" ></div>';
					}

					$output .= '<script async defer src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2"></script>';
				}
			}
			if ( 'posts' === $f_type ) {
				$post_url = ! empty( $settings['PostURL'] ) && ! empty( $settings['PostURL']['url'] ) ? $settings['PostURL']['url'] : '';
				$wd_post  = ! empty( $settings['wdPost']['size'] ) ? $settings['wdPost']['size'] : 500;
				$hg_post  = ! empty( $settings['HgPost']['size'] ) ? $settings['HgPost']['size'] : 560;
				$full_pt  = ! empty( 'yes' === $settings['FullPT'] ) ? true : false;
				$output  .= '<iframe class="tp-fb-iframe" src="https://www.facebook.com/plugins/post.php?href=' . esc_url( $post_url ) . '&show_text=' . esc_attr( $full_pt ) . '&width=' . esc_attr( $wd_post ) . '&height=' . esc_attr( $hg_post ) . '&appId=" width="' . esc_attr( $wd_post ) . '" height="' . esc_attr( $hg_post ) . '" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media" ></iframe>';
			}
			if ( 'videos' === $f_type ) {
				$videos_url  = ! empty( $settings['VideosURL'] ) && ! empty( $settings['VideosURL']['url'] ) ? $settings['VideosURL']['url'] : '';
				$wd_video    = ! empty( $settings['wdVideo']['size'] ) ? $settings['wdVideo']['size'] : 500;
				$hg_video    = ! empty( $settings['HgVideo']['size'] ) ? $settings['HgVideo']['size'] : 560;
				$caption_vt  = ! empty( 'yes' === $settings['CaptionVT'] ) ? true : false;
				$autoplay_vt = ! empty( 'yes' === $settings['AutoplayVT'] ) ? true : false;
				$full_video  = '';
				$full_vt     = ! empty( $settings['FullVT'] ) ? $settings['FullVT'] : '';
				if ( 'yes' === $full_vt ) {
					$full_video = 'allowFullScreen';
				}
				$output .= '<iframe class="tp-fb-iframe" src="https://www.facebook.com/plugins/video.php?href=' . esc_url( $videos_url ) . '&show_text=' . esc_attr( $caption_vt ) . '&width=' . esc_attr( $wd_video ) . '&height=' . esc_attr( $hg_video ) . '&autoplay=' . esc_attr( $autoplay_vt ) . '&appId=" width="' . esc_attr( $wd_video ) . '" height="' . esc_attr( $hg_video ) . '" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media" ' . $full_video . ' ></iframe>';
			}
			if ( 'likebutton' === $f_type ) {
				$fb_likebtn   = ! empty( $settings['likeBtnUrl'] ) && ! empty( $settings['likeBtnUrl']['url'] ) ? $settings['likeBtnUrl']['url'] : '';
				$face_btn     = ! empty( $settings['FacesLBT'] ) ? $settings['FacesLBT'] : '';
				$faces_lbt    = ! empty( 'yes' === $face_btn ) ? true : false;
				$fbh_glike    = ! empty( $settings['HgLikeBtn']['size'] ) ? $settings['HgLikeBtn']['size'] : 70;
				$fbwd_like    = ! empty( $settings['wdLikeBtn']['size'] ) ? $settings['wdLikeBtn']['size'] : 350;
				$share_button = ! empty( $settings['SBtnLB'] ) ? $settings['SBtnLB'] : '';
				$sbtn_lb      = ! empty( 'yes' === $share_button ) ? true : false;
				$traget_like  = ! empty( $settings['TargetLike'] ) ? $settings['TargetLike'] : '';
				if ( 'currentpage' === $traget_like ) {
					$fmt_urlib = ! empty( $settings['FmtURLlb'] ) ? $settings['FmtURLlb'] : 'plain';
					$post_id   = get_the_ID();
					if ( 'plain' === $fmt_urlib ) {
						$plain_lurl = get_permalink( $post_id );
						$output    .= '<iframe class="tp-fb-iframe" src="https://www.facebook.com/plugins/like.php?href=' . esc_url( $plain_lurl ) . '&layout=' . esc_attr( $settings['BtnStyleLB'] ) . '&action=' . esc_attr( $settings['TypeLB'] ) . '&size=' . esc_attr( $size_btn ) . '&share=' . esc_attr( $sbtn_lb ) . '&height=' . esc_attr( $fbh_glike ) . '&show_faces=' . esc_attr( $faces_lbt ) . '&colorscheme=' . esc_attr( $settings['ColorSLB'] ) . '&width=' . esc_attr( $fbwd_like ) . '&appId=" width="' . esc_attr( $fbwd_like ) . '" height="' . esc_attr( $fbh_glike ) . '" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>';
					} elseif ( 'pretty' === $fmt_urlib ) {
						$pretty_lurl = add_query_arg( 'p', $post_id, home_url() );
						$output     .= '<iframe class="tp-fb-iframe" src="https://www.facebook.com/plugins/like.php?href=' . esc_url( $pretty_lurl ) . '&layout=' . esc_attr( $settings['BtnStyleLB'] ) . '&action=' . esc_attr( $settings['TypeLB'] ) . '&size=' . esc_attr( $size_btn ) . '&share=' . esc_attr( $sbtn_lb ) . '&height=' . esc_attr( $fbh_glike ) . '&show_faces=' . esc_attr( $faces_lbt ) . '&colorscheme=' . esc_attr( $settings['ColorSLB'] ) . '&width=' . esc_attr( $fbwd_like ) . '&appId=" width="' . esc_attr( $fbwd_like ) . '" height="' . esc_attr( $fbh_glike ) . '" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>';
					}
				} else {
					$output .= '<iframe class="tp-fb-iframe" src="https://www.facebook.com/plugins/like.php?href=' . esc_url( $fb_likebtn ) . '&layout=' . esc_attr( $settings['BtnStyleLB'] ) . '&action=' . esc_attr( $settings['TypeLB'] ) . '&size=' . esc_attr( $size_btn ) . '&share=' . esc_attr( $sbtn_lb ) . '&height=' . esc_attr( $fbh_glike ) . '&show_faces=' . esc_attr( $faces_lbt ) . '&colorscheme=' . esc_attr( $settings['ColorSLB'] ) . '&width=' . esc_attr( $fbwd_like ) . '&appId=" width="' . esc_attr( $fbwd_like ) . '" height="' . esc_attr( $fbh_glike ) . '" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>';
				}
			}
			if ( 'page' === $f_type ) {
				$urlp    = ! empty( $settings['URLP'] ) && ! empty( $settings['URLP']['url'] ) ? $settings['URLP']['url'] : '';
				$wd_page = ! empty( $settings['wdPage']['size'] ) ? $settings['wdPage']['size'] : 340;
				$hg_page = ! empty( $settings['HgPage']['size'] ) ? $settings['HgPage']['size'] : 500;

				$small_header = ! empty( $settings['smallHP'] ) ? $settings['smallHP'] : '';

				$small_hp = ! empty( 'yes' === $small_header ) ? true : false;
				$cover_p  = true;
				$cover_p  = ! empty( $settings['CoverP'] ) ? $settings['CoverP'] : '';

				if ( 'yes' === $cover_p ) {
					$cover_p = false;
				}

				$show_frd  = ! empty( $settings['ProfileP'] ) ? $settings['ProfileP'] : '';
				$profile_p = ! empty( 'yes' === $show_frd ) ? true : false;

				$cus_vta_btn = ! empty( $settings['CTABTN'] ) ? $settings['CTABTN'] : '';

				$ctabtn  = ! empty( 'yes' === $cus_vta_btn ) ? true : false;
				$output .= '<iframe class="tp-fb-iframe" src="https://www.facebook.com/plugins/page.php?href=' . esc_url( $urlp ) . '&tabs=' . esc_attr( $settings['LayoutP'] ) . '&width=' . esc_attr( $wd_page ) . '&height=' . esc_attr( $hg_page ) . '&small_header=' . esc_attr( $small_hp ) . '&hide_cover=' . esc_attr( $cover_p ) . '&show-facepile=' . esc_attr( $profile_p ) . '&hide_cta=' . esc_attr( $ctabtn ) . '&lazy=true&adapt_container_width=true&appId=" width="' . esc_attr( $wd_page ) . '" height="' . esc_attr( $hg_page ) . '" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media" ></iframe>';
			}
			if ( 'save' === $f_type ) {
				$save_url = ! empty( $settings['SaveURL'] ) && ! empty( $settings['SaveURL']['url'] ) ? $settings['SaveURL']['url'] : '';

				$output .= '<div class="fb-save" data-uri="' . esc_url( $save_url ) . '" data-size="' . esc_attr( $size_btn ) . '"></div>';
				$output .= '<script async defer src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2"></script>';
			}
			if ( 'share' === $f_type ) {
				$share_url = ! empty( $settings['ShareURL'] ) && ! empty( $settings['ShareURL']['url'] ) ? $settings['ShareURL']['url'] : '';
				$share_hbt = ! empty( $settings['HgShareBtn']['size'] ) ? $settings['HgShareBtn']['size'] : 50;
				$share_wbt = ! empty( $settings['wdShareBtn']['size'] ) ? $settings['wdShareBtn']['size'] : 96;
				$output   .= '<iframe class="tp-fb-iframe" src="https://www.facebook.com/plugins/share_button.php?href=' . esc_url( $share_url ) . '&layout=' . esc_attr( $settings['ShareBTN'] ) . '&size=' . esc_attr( $size_btn ) . '&width=' . esc_attr( $share_wbt ) . '&height=' . esc_attr( $share_hbt ) . '&appId=" width="' . esc_attr( $share_wbt ) . '" height="' . esc_attr( $share_hbt ) . '" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>';
			}
		} elseif ( 'twitter' === $embed_type ) {
			$tweet_type = ! empty( $settings['TweetType'] ) ? $settings['TweetType'] : 'timelines';
			$tw_name    = ! empty( $settings['Twname'] ) ? $settings['Twname'] : '';
			$dark_mode  = ! empty( $settings['TwColor'] ) ? $settings['TwColor'] : '';
			$tw_color   = ! empty( 'yes' === $dark_mode ) ? 'dark' : 'light';
			$tw_width   = ! empty( $settings['Twwidth']['size'] ) ? $settings['Twwidth']['size'] : '';
			$twitconver = ! empty( $settings['Twconver'] ) ? $settings['Twconver'] : '';
			$tw_conver  = ! empty( 'yes' === $twitconver ) ? 'none' : '';
			$tw_msg     = ! empty( $settings['TwMsg'] ) ? $settings['TwMsg'] : '';
			if ( 'Tweets' === $tweet_type ) {
				$tw_repeater = ! empty( $settings['TwRepeater'] ) ? $settings['TwRepeater'] : array();
				$twit_card   = ! empty( $settings['TwCards'] ) ? $settings['TwCards'] : '';
				$tw_cards    = ! empty( 'yes' === $twit_card ) ? 'hidden' : '';
				$tw_align    = ! empty( $settings['Twalign'] ) ? $settings['Twalign'] : 'center';

				foreach ( $tw_repeater as $index => $tweet ) {
					$tw_url      = ! empty( $tweet['TweetURl'] ) && ! empty( $tweet['TweetURl']['url'] ) ? $tweet['TweetURl']['url'] : '';
					$tw_massage  = ! empty( $tweet['TwMassage'] ) ? $tweet['TwMassage'] : '';
					$output     .= '<blockquote class="twitter-tweet" data-theme="' . esc_attr( $tw_color ) . '" data-width="' . esc_attr( $tw_width ) . '" data-cards="' . esc_attr( $tw_cards ) . '" data-align="' . esc_attr( $tw_align ) . '" data-conversation="' . esc_attr( $tw_conver ) . '" >';
						$output .= '<p lang="en" dir="ltr">' . wp_kses_post( $tw_massage ) . '</p>';
						$output .= '<a href="' . esc_attr( $tw_url ) . '"></a>';
					$output     .= '</blockquote>';
				}
			}
			if ( 'timelines' === $tweet_type ) {
				$tw_url     = '';
				$tw_class   = 'twitter-timeline';
				$tw_guides  = ! empty( $settings['TwGuides'] ) ? $settings['TwGuides'] : 'Profile';
				$tw_brcr    = ! empty( $settings['TwBrCr'] ) ? $settings['TwBrCr'] : '';
				$tw_limit   = ! empty( $settings['Twlimit']['size'] ) ? $settings['Twlimit']['size'] : '';
				$tw_style   = ! empty( $settings['Twstyle'] ) ? $settings['Twstyle'] : 'linear';
				$tw_design  = ! empty( $settings['TwDesign'] ) ? $settings['TwDesign'] : array();
				$tw_height  = ( 'linear' === $tw_style ) ? $settings['Twheight']['size'] : '';
				$design_btn = array();
				if ( is_array( $tw_design ) ) {
					foreach ( $tw_design as $value ) {
						$design_btn[] = $value;
					}
				}
				$tw_design = wp_json_encode( $design_btn );
				if ( 'Profile' === $tw_guides ) {
					$tw_url = 'https://twitter.com/' . esc_attr( $tw_name );
				} elseif ( 'List' === $tw_guides ) {
					$tw_url = ! empty( $settings['Twlisturl'] ) && ! empty( $settings['Twlisturl']['url'] ) ? $settings['Twlisturl']['url'] : '';
				} elseif ( 'Likes' === $tw_guides ) {
					$tw_url = 'https://twitter.com/' . esc_attr( $tw_name ) . '/likes';
				} elseif ( 'Collection' === $tw_guides ) {
					$tw_class = 'twitter-grid';
					$tw_url   = ! empty( $settings['TwCollection'] ) && ! empty( $settings['TwCollection']['url'] ) ? $settings['TwCollection']['url'] : '';
				}
				$output .= '<a class="' . esc_attr( $tw_class ) . '" href="' . esc_url( $tw_url ) . '" data-width="' . esc_attr( $tw_width ) . '" data-height="' . esc_attr( $tw_height ) . '" data-theme="' . esc_attr( $tw_color ) . '" data-chrome="' . esc_attr( $tw_design ) . '" data-border-color="' . esc_attr( $tw_brcr ) . '" data-tweet-limit="' . esc_attr( $tw_limit ) . '" data-aria-polite="" >' . wp_kses_post( $tw_msg ) . '</a>';
			}
			if ( 'buttons' === $tweet_type ) {
				$tw_button  = ! empty( $settings['Twbutton'] ) ? $settings['Twbutton'] : 'follow';
				$tw_btnsize = ! empty( $settings['TwBtnSize'] ) ? $settings['TwBtnSize'] : '';
				$tw_tweetid = ! empty( $settings['TwTweetId'] ) ? $settings['TwTweetId'] : '';
				$tw_icon    = ! empty( $settings['TwIcon'] ) ? $settings['TwIcon'] : '';
				$twicon     = ! empty( 'yes' === $tw_icon ) ? '' : '<i class="fab fa-twitter"></i>';
				$lz1        = function_exists( 'tp_has_lazyload' ) ? tp_bg_lazyLoad( $settings['TwBtnBg_image'], $settings['TwBtnBgH_image'] ) : '';
				if ( 'Tweets' === $tw_button ) {
					$tw_via       = ! empty( $settings['TwVia'] ) ? $settings['TwVia'] : '';
					$tw_text_btn  = ! empty( $settings['TwTextBtn'] ) ? $settings['TwTextBtn'] : '';
					$tw_hashtags  = ! empty( $settings['TwHashtags'] ) ? $settings['TwHashtags'] : '';
					$tw_tweet_url = ! empty( $settings['TwTweetUrl'] ) && ! empty( $settings['TwTweetUrl']['url'] ) ? $settings['TwTweetUrl']['url'] : '';
					$output      .= '<a class="twitter-share-button" href="https://twitter.com/intent/tweet" data-size="' . esc_attr( $tw_btnsize ) . '" data-text="' . esc_attr( $tw_text_btn ) . '" data-url="' . esc_url( $tw_tweet_url ) . '" data-via="' . esc_attr( $tw_via ) . '" data-hashtags="' . esc_attr( $tw_hashtags ) . '" >' . wp_kses_post( $tw_msg ) . '</a></br>';
				} elseif ( 'follow' === $tw_button ) {
					$tw_count      = ! empty( $settings['TwCount'] ) ? $settings['TwCount'] : 'false';
					$twiter_dicon  = ! empty( $settings['TwHideUname'] ) ? $settings['TwHideUname'] : '';
					$tw_hide_uname = ! empty( 'yes' === $twiter_dicon ) ? 'false' : $settings['TwHideUname'];
					$output       .= '<a class="twitter-follow-button" href="https://twitter.com/' . esc_attr( $tw_name ) . '" data-size="' . esc_attr( $tw_btnsize ) . '" data-show-screen-name="' . esc_attr( $tw_hide_uname ) . '" data-show-count="' . esc_attr( $tw_count ) . '" >' . wp_kses_post( $tw_msg ) . '</a></br>';
				} elseif ( 'Message' === $tw_button ) {
					$tw_rid        = ! empty( $settings['TwRId'] ) ? $settings['TwRId'] : '';
					$tw_message    = ! empty( $settings['TwMessage'] ) ? $settings['TwMessage'] : '';
					$tw_hide_uname = ! empty( $settings['TwHideUname'] ) ? '@' : '';
					$output       .= '<a class="twitter-dm-button" href="https://twitter.com/messages/compose?recipient_id=' . esc_attr( $tw_rid ) . '" data-text="' . esc_attr( $tw_message ) . '" data-size="' . esc_attr( $tw_btnsize ) . '" data-screen-name="' . esc_attr( $tw_hide_uname . $tw_name ) . '">' . wp_kses_post( $tw_msg ) . '</a>';
				} elseif ( 'like' === $tw_button ) {
					$output .= '<a class="tw-button ' . esc_attr( $lz1 ) . '" href="https://twitter.com/intent/like?tweet_id=' . esc_attr( $tw_tweetid ) . '" >' . wp_kses_post( $twicon . ' ' . $settings['likeBtn'] ) . '</a>';
				} elseif ( 'Reply' === $tw_button ) {
					$output .= '<a class="tw-button ' . esc_attr( $lz1 ) . '" href="https://twitter.com/intent/tweet?in_reply_to=' . esc_attr( $tw_tweetid ) . '">' . wp_kses_post( $twicon . ' ' . $settings['ReplyBtn'] ) . '</a>';
				} elseif ( 'Retweet' === $tw_button ) {
					$output .= '<a class="tw-button ' . esc_attr( $lz1 ) . '" href="https://twitter.com/intent/retweet?tweet_id=' . esc_attr( $tw_tweetid ) . '">' . wp_kses_post( $twicon . ' ' . $settings['RetweetBtn'] ) . '</a>';
				}
			}
			$output .= '<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>';
		} elseif ( 'vimeo' === $embed_type ) {
			$v_mid     = ! empty( $settings['ViId'] ) ? $settings['ViId'] : '';
			$vm_stime  = ! empty( $settings['VmStime'] ) ? $settings['VmStime'] : '';
			$vm_color  = ! empty( $settings['VmColor'] ) ? ltrim( $settings['VmColor'], '#' ) : 'ffffff';
			$vm_select = ! empty( $settings['ViOption'] ) ? $settings['ViOption'] : array();
			$vm_all    = array();
			if ( is_array( $vm_select ) ) {
				foreach ( $vm_select as $value ) {
					$vm_all[] = $value;
				}
			}
			$vm_full_screen  = ( in_array( 'fullscreen', $vm_all ) ) ? 'webkitallowfullscreen="true" mozallowfullscreen="true" allowfullscreen="true"' : '';
			$vm_auto_play    = ( in_array( 'autoplay', $vm_all ) ) ? 1 : 0;
			$vm_loop         = ( in_array( 'loop', $vm_all ) ) ? 1 : 0;
			$vm_muted        = ( in_array( 'muted', $vm_all ) ) ? 1 : 0;
			$vm_auto_pause   = ( in_array( 'autopause', $vm_all ) ) ? 1 : 0;
			$vm_background   = ( in_array( 'background', $vm_all ) ) ? 1 : 0;
			$vm_byline       = ( in_array( 'byline', $vm_all ) ) ? 1 : 0;
			$vm_speed        = ( in_array( 'speed', $vm_all ) ) ? 1 : 0;
			$vm_title        = ( in_array( 'title', $vm_all ) ) ? 1 : 0;
			$vm_portrait     = ( in_array( 'portrait', $vm_all ) ) ? 1 : 0;
			$vm_play_sinline = ( in_array( 'playsinline', $vm_all ) ) ? 1 : 0;
			$vm_dnt          = ( in_array( 'dnt', $vm_all ) ) ? 1 : 0;
			$vm_pip          = ( in_array( 'pip', $vm_all ) ) ? 1 : 0;
			$vm_transparent  = ( in_array( 'transparent', $vm_all ) ) ? 1 : 0;
			$output         .= '<iframe class="tp-frame-set" src="https://player.vimeo.com/video/' . esc_attr( $v_mid ) . '?autoplay=' . esc_attr( $vm_auto_play ) . '&loop=' . esc_attr( $vm_loop ) . '&muted=' . esc_attr( $vm_muted ) . '&autopause=' . esc_attr( $vm_auto_pause ) . '&background=' . esc_attr( $vm_background ) . '&byline=' . esc_attr( $vm_byline ) . '&playsinline=' . esc_attr( $vm_play_sinline ) . '&speed=' . esc_attr( $vm_speed ) . '&title=' . esc_attr( $vm_title ) . '&portrait=' . esc_attr( $vm_portrait ) . '&dnt=' . esc_attr( $vm_dnt ) . '&pip=' . esc_attr( $vm_pip ) . '&transparent=' . esc_attr( $vm_transparent ) . '&color=' . esc_attr( $vm_color ) . '&#t=' . esc_attr( $vm_stime ) . '" width="' . esc_attr( $ex_width ) . '" height="' . esc_attr( $ex_height ) . '" frameborder="0" ' . esc_attr( $vm_full_screen ) . ' ></iframe>';
		} elseif ( 'instagram' === $embed_type ) {
			$ig_type    = ! empty( $settings['IGType'] ) ? $settings['IGType'] : 'posts';
			$igig       = ! empty( $settings['IGId'] ) ? $settings['IGId'] : 'CGAvnLcA3zb';
			$ig_cap     = '';
			$igcaptions = ! empty( $settings['IGCaptione'] ) ? $settings['IGCaptione'] : '';
			if ( 'yes' !== $igcaptions ) {
				$ig_cap = 'data-instgrm-captioned';
			}
			if ( 'posts' === $ig_type ) {
				$ig_id = 'p/' . $igig;
			} elseif ( 'reels' === $ig_type ) {
				$ig_id = 'reel/' . $igig;
			} elseif ( 'igtv' === $ig_type ) {
				$ig_id = 'tv/' . $igig;
			}
			$output .= '<blockquote class="instagram-media" ' . esc_attr( $ig_cap ) . ' data-instgrm-version="13" data-instgrm-permalink="https://www.instagram.com/' . esc_attr( $ig_id ) . '/?utm_source=ig_embed"></blockquote><script async src="//www.instagram.com/embed.js"></script>';
		} elseif ( 'youtube' === $embed_type ) {
			$yt_type     = ! empty( $settings['YtType'] ) ? $settings['YtType'] : 'YtSV';
			$yt_option   = ! empty( $settings['YtOption'] ) ? $settings['YtOption'] : array();
			$yt_stime    = ! empty( $settings['YtSTime'] ) ? $settings['YtSTime'] : '';
			$yt_etime    = ! empty( $settings['YtETime'] ) ? $settings['YtETime'] : '';
			$yt_language = ! empty( $settings['Ytlanguage'] ) ? $settings['Ytlanguage'] : '';
			$yt_select   = array();
			if ( is_array( $yt_option ) ) {
				foreach ( $yt_option as $value ) {
					$yt_select[] = $value;
				}
			}

			$yt_loop           = ( in_array( 'loop', $yt_select ) ) ? 1 : 0;
			$yt_fs             = ( in_array( 'fs', $yt_select ) ) ? 1 : 0;
			$yt_autoplay       = ( in_array( 'autoplay', $yt_select ) ) ? 1 : 0;
			$yt_muted          = ( in_array( 'mute', $yt_select ) ) ? 1 : 0;
			$yt_controls       = ( in_array( 'controls', $yt_select ) ) ? 1 : 0;
			$yt_disablekb      = ( in_array( 'disablekb', $yt_select ) ) ? 1 : 0;
			$yt_modestbranding = ( in_array( 'modestbranding', $yt_select ) ) ? 1 : 0;
			$yt_playsinline    = ( in_array( 'playsinline', $yt_select ) ) ? 1 : 0;
			$yt_rel            = ( in_array( 'rel', $yt_select ) ) ? 1 : 0;
			$yt_parameters     = 'autoplay=' . esc_attr( $yt_autoplay ) . '&mute=' . esc_attr( $yt_muted ) . '&controls=' . esc_attr( $yt_controls ) . '&disablekb=' . esc_attr( $yt_disablekb ) . '&fs=' . esc_attr( $yt_fs ) . '&modestbranding=' . esc_attr( $yt_modestbranding ) . '&loop=' . esc_attr( $yt_loop ) . '&rel=' . esc_attr( $yt_rel ) . '&playsinline=' . esc_attr( $yt_playsinline ) . '&start=' . esc_attr( $yt_stime ) . '&end=' . esc_attr( $yt_etime ) . '&hl=' . esc_attr( $yt_language );
			if ( 'YtSV' === $yt_type ) {
				$yt_videoid = ! empty( $settings['YtVideoId'] ) ? $settings['YtVideoId'] : '';
				$yt_src     = 'https://www.youtube.com/embed/' . esc_attr( $yt_videoid ) . '?playlist=' . esc_attr( $yt_videoid ) . '&' . esc_attr( $yt_parameters );
			} elseif ( 'YtPlayV' === $yt_type ) {
				$yt_play_listid = ! empty( $settings['YtPlaylistId'] ) ? $settings['YtPlaylistId'] : '';
				$yt_src         = 'https://www.youtube.com/embed?listType=playlist&list=' . esc_attr( $yt_play_listid ) . '&' . esc_attr( $yt_parameters );
			} elseif ( 'YtuserV' === $yt_type ) {
				$yt_username = ! empty( $settings['YtUsername'] ) ? $settings['YtUsername'] : '';
				$yt_src      = 'https://www.youtube.com/embed?listType=user_uploads&list=' . esc_attr( $yt_username ) . '&' . esc_attr( $yt_parameters );
			}
			$output .= '<iframe class="tp-frame-set" width="' . esc_attr( $ex_width ) . '" height="' . esc_attr( $ex_height ) . '" src="' . esc_attr( $yt_src ) . '" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
		} elseif ( 'googlemap' === $embed_type ) {
			$map_accesstoken = ! empty( $settings['Mapaccesstoken'] ) ? $settings['Mapaccesstoken'] : 'default';
			$gsearch_text    = ! empty( $settings['GSearchText'] ) ? $settings['GSearchText'] : 'Goa+India';
			$map_zoom        = ( ! empty( $settings['MapZoom'] ) && ! empty( $settings['MapZoom']['size'] ) ) ? (int) $settings['MapZoom']['size'] : 1;

			if ( 'default' === $map_accesstoken ) {
				$output .= '<iframe src="https://maps.google.com/maps?q=' . esc_attr( $gsearch_text ) . '&z=' . esc_attr( $map_zoom ) . '&output=embed"  loading="lazy" allowfullscreen frameborder="0" scrolling="no"></iframe>';
			} elseif ( 'accesstoken' === $map_accesstoken ) {
				$ga_ccesstoken = ! empty( $settings['GAccesstoken'] ) ? $settings['GAccesstoken'] : '';
				$gmap_modes    = ! empty( $settings['GMapModes'] ) ? $settings['GMapModes'] : 'search';
				$map_views     = ! empty( $settings['MapViews'] ) ? $settings['MapViews'] : 'roadmap';

				if ( 'place' === $gmap_modes ) {
					$output .= '<iframe src="https://www.google.com/maps/embed/v1/place?key=' . esc_attr( $ga_ccesstoken ) . '&q=' . esc_attr( $gsearch_text ) . '&zoom=' . esc_attr( $map_zoom ) . '&maptype=' . esc_attr( $map_views ) . '&language=En"   loading="lazy" allowfullscreen></iframe>';
				} elseif ( 'directions' === $gmap_modes ) {
					$gorigin       = ! empty( $settings['GOrigin'] ) ? '&origin=' . $settings['GOrigin'] : '&origin=""';
					$g_destination = ! empty( $settings['GDestination'] ) ? '&destination=' . $settings['GDestination'] : '&destination=""';
					$gwaypoints    = ! empty( $settings['GWaypoints'] ) ? '&waypoints=' . $settings['GWaypoints'] : '';
					$gtravel_mode  = ! empty( $settings['GTravelMode'] ) ? $settings['GTravelMode'] : 'GTravelMode';
					$gavoid        = ! empty( $settings['Gavoid'] ) ? '&avoid=' . implode( '|', $settings['Gavoid'] ) : '';

					$output .= '<iframe src="https://www.google.com/maps/embed/v1/directions?key=' . esc_attr( $ga_ccesstoken ) . esc_attr( $gorigin ) . esc_attr( $g_destination ) . esc_attr( $gwaypoints ) . esc_attr( $gavoid ) . '&mode=' . esc_attr( $gtravel_mode ) . '&zoom=' . esc_attr( $map_zoom ) . '&maptype=' . esc_attr( $map_views ) . '&language=En"  loading="lazy" allowfullscreen ></iframe>';
				} elseif ( 'streetview' === $gmap_modes ) {
					$gstreetview_text = ! empty( $settings['GstreetviewText'] ) ? $settings['GstreetviewText'] : '';

					$output .= '<iframe src="https://www.google.com/maps/embed/v1/streetview?key=' . esc_attr( $ga_ccesstoken ) . '&location=' . esc_attr( $gstreetview_text ) . '&heading=210&pitch=10&fov=90"  loading="lazy" allowfullscreen></iframe>';
				} elseif ( 'search' === $gmap_modes ) {
					$output .= '<iframe src="https://www.google.com/maps/embed/v1/search?key=' . esc_attr( $ga_ccesstoken ) . '&q=' . esc_attr( $gsearch_text ) . '&zoom=' . esc_attr( $map_zoom ) . '&maptype=' . esc_attr( $map_views ) . '&language=En"  loading="lazy" allowfullscreen ></iframe>';
				}
			}
		}
		$output .= '</div>';
		echo $output;
	}
}
