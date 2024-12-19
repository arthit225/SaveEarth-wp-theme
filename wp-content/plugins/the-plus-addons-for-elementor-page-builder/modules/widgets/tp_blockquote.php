<?php
/**
 * Widget Name: Blockquote
 * Description: Author Quote Style.
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
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class L_ThePlus_Block_Quote
 */
class L_ThePlus_Block_Quote extends Widget_Base {

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
		return 'tp-blockquote';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 1.0.0
	 */
	public function get_title() {
		return esc_html__( 'Blockquote', 'tpebl' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'fa fa-quote-left theplus_backend_icon';
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
		return array( 'Quotes', 'Quote box', 'Quote widget', 'Testimonials', 'Testimonial box', 'Testimonial widget', 'Customer reviews', 'Review box', 'Review widget', 'Feedback box', 'Feedback widget', 'Comment box', 'Comment widget', 'Opinion box', 'Opinion widget', 'Recommendation box', 'Recommendation widget', 'Rating box', 'Rating box' );
	}

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
				'label' => esc_html__( 'Blockquote', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'style',
			array(
				'label'   => esc_html__( 'Style', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => l_theplus_get_style_list( 2 ),
			)
		);
		$this->add_control(
			'content_description',
			array(
				'label'       => esc_html__( 'Description', 'tpebl' ),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => esc_html__( '"I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo."', 'tpebl' ),
				'placeholder' => esc_html__( 'Type your block quote here', 'tpebl' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);
		$this->add_control(
			'quote_author',
			array(
				'label'     => esc_html__( 'Author', 'tpebl' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'John Doe', 'tpebl' ),
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'style' => 'style-2',
				),
			)
		);
		$this->add_control(
			'quote_author_desc',
			array(
				'label'     => esc_html__( 'Author Description', 'tpebl' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( '- Developer', 'tpebl' ),
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'style!' => 'style-1',
				),
			)
		);
		$this->add_control(
			'quote_icon',
			array(
				'label'     => esc_html__( 'Icon', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => '',
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'separator' => 'before',
				'condition' => array(
					'style!' => 'style-1',
				),
			)
		);
		$this->add_control(
			'quote_icon_select',
			array(
				'label'     => esc_html__( 'Icon Library', 'tpebl' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-quote-left',
					'library' => 'solid',
				),
				'condition' => array(
					'style!'     => 'style-1',
					'quote_icon' => 'yes',
				),
			)
		);
		$this->add_control(
			'quote_icon_pos',
			array(
				'label'     => esc_html__( 'Position', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'qip_top',
				'options'   => array(
					'qip_top'   => esc_html__( 'Top', 'tpebl' ),
					'qip_bottm' => esc_html__( 'Bottom', 'tpebl' ),
					'qip_both'  => esc_html__( 'Both', 'tpebl' ),
				),
				'condition' => array(
					'style!'     => 'style-1',
					'quote_icon' => 'yes',
				),
			)
		);
		$this->add_control(
			'quote_icon_pos_align',
			array(
				'label'     => esc_html__( 'Alignment', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'qipa_left',
				'options'   => array(
					'qipa_left'  => esc_html__( 'Left', 'tpebl' ),
					'qipa_right' => esc_html__( 'Right', 'tpebl' ),
				),
				'condition' => array(
					'style!'         => 'style-1',
					'quote_icon'     => 'yes',
					'quote_icon_pos' => array( 'qip_top', 'qip_bottm' ),
				),
			)
		);
		$this->add_control(
			'quote_icon_pos_align_both',
			array(
				'label'     => esc_html__( 'Alignment', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'qipa_opposite',
				'options'   => array(
					'qipa_opposite' => esc_html__( 'Opposite', 'tpebl' ),
					'qipa_left'     => esc_html__( 'Left', 'tpebl' ),
					'qipa_right'    => esc_html__( 'Right', 'tpebl' ),
					'qipa_center'   => esc_html__( 'Center', 'tpebl' ),
				),
				'condition' => array(
					'style!'         => 'style-1',
					'quote_icon'     => 'yes',
					'quote_icon_pos' => 'qip_both',
				),
			)
		);
		$this->add_control(
			'quote_tweet',
			array(
				'label'     => wp_kses_post( "Tweet <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "click-to-tweet-text-box-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'separator' => 'before',
			)
		);
		$this->add_control(
			'quote_tweet_icon_select',
			array(
				'label'     => esc_html__( 'Tweet Icon', 'tpebl' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fab fa-twitter',
					'library' => 'solid',
				),
				'condition' => array(
					'quote_tweet' => 'yes',
				),
			)
		);
		$this->add_control(
			'quote_tweet_text',
			array(
				'label'     => esc_html__( 'Text', 'tpebl' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Tweet', 'tpebl' ),
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'quote_tweet' => 'yes',
				),
			)
		);
		$this->add_control(
			'quote_tweet_link',
			array(
				'label'     => esc_html__( 'Tweet Current Page', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'condition' => array(
					'quote_tweet' => 'yes',
				),
			)
		);
		$this->add_control(
			'tweet_Note',
			array(
				'type'        => Controls_Manager::RAW_HTML,
				'raw'         => '<p class="tp-controller-notice"><i>Note : If disable, It will tweet content of blockquote instead of current page URL.</i></p>',
				'label_block' => true,
			)
		);
		$this->add_control(
			'quote_iamge_switch',
			array(
				'label'     => esc_html__( 'Image', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'separator' => 'before',
				'condition' => array(
					'style!' => 'style-1',
				),
			)
		);
		$this->add_control(
			'quote_image',
			array(
				'label'      => esc_html__( 'Select', 'tpebl' ),
				'type'       => Controls_Manager::MEDIA,
				'media_type' => 'image',
				'separator'  => 'before',
				'condition'  => array(
					'style!'             => 'style-1',
					'quote_iamge_switch' => 'yes',
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
			'content_extras_section',
			array(
				'label' => esc_html__( 'Extra Options', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'quote_dropcap',
			array(
				'label'     => esc_html__( 'Drop Cap', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'condition' => array(
					'style!' => 'style-2',
				),
			)
		);
		$this->add_control(
			'border_layout',
			array(
				'label'   => esc_html__( 'Border Layout', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => array(
					'none' => esc_html__( 'None', 'tpebl' ),
					'bl_1' => esc_html__( 'Layout 1', 'tpebl' ),
					'bl_2' => esc_html__( 'Layout 2', 'tpebl' ),
					'bl_3' => esc_html__( 'Layout 3', 'tpebl' ),
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
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'content_typography',
				'label'    => esc_html__( 'Typography', 'tpebl' ),
				'selector' => '{{WRAPPER}} .plus_blockquote blockquote.quote-text > span,{{WRAPPER}} .plus_blockquote blockquote.quote-text',
			)
		);
		$this->start_controls_tabs( 'tabs_quote_style' );
		$this->start_controls_tab(
			'tab_quote_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'content_color',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#888',
				'selectors' => array(
					'{{WRAPPER}} .plus_blockquote blockquote.quote-text > span,{{WRAPPER}} .plus_blockquote blockquote.quote-text p,{{WRAPPER}} .plus_blockquote blockquote.quote-text' => 'color:{{VALUE}};',
				),
			)
		);
		$this->add_control(
			'author_color',
			array(
				'label'     => esc_html__( 'Author Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#888',
				'selectors' => array(
					'{{WRAPPER}} .plus_blockquote .quote-text .quote_author' => 'color:{{VALUE}};',
				),
				'condition' => array(
					'style' => 'style-2',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_quote_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'content_hover_color',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .plus_blockquote:hover blockquote.quote-text > span,{{WRAPPER}} .plus_blockquote:hover blockquote.quote-text p,{{WRAPPER}} .plus_blockquote:hover blockquote.quote-text' => 'color:{{VALUE}};',
				),
			)
		);
		$this->add_control(
			'author_hover_color',
			array(
				'label'     => esc_html__( 'Author Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .plus_blockquote:hover .quote-text .quote_author' => 'color:{{VALUE}};',
				),
				'condition' => array(
					'style' => 'style-2',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'quote_color',
			array(
				'label'     => esc_html__( 'Quote Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#888',
				'selectors' => array(
					'{{WRAPPER}} .plus_blockquote.quote-style-2 .quote-left' => 'color: {{VALUE}};',
				),
				'separator' => 'before',
				'condition' => array(
					'style' => 'style-2',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'      => 'text_shadow',
				'label'     => esc_html__( 'Quote Shadow', 'tpebl' ),
				'selector'  => '{{WRAPPER}} .plus_blockquote.quote-style-2 .quote-left',
				'separator' => 'before',
				'condition' => array(
					'style' => 'style-2',
				),
			)
		);
		$this->add_responsive_control(
			'quote_padding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus_blockquote' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'quote_margin',
			array(
				'label'      => esc_html__( 'Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus_blockquote' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_dropcap_styling',
			array(
				'label'     => esc_html__( 'Drop Cap', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'style!'        => 'style-2',
					'quote_dropcap' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'dropcap_padding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt-plus-text-block-wrapper .tp-blockquote-dropcap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'dropcap_typography',
				'selector' => '{{WRAPPER}} .pt-plus-text-block-wrapper .tp-blockquote-dropcap',
			)
		);
		$this->start_controls_tabs( 'tabs_dropcap' );
		$this->start_controls_tab(
			'tab_dropcap_n',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'dropcap_color_n',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt-plus-text-block-wrapper .tp-blockquote-dropcap' => 'color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_dropcap_h',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'dropcap_color_h',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt-plus-text-block-wrapper .plus_blockquote:hover .tp-blockquote-dropcap' => 'color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_desc_styling',
			array(
				'label' => esc_html__( 'Description', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'desc_padding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus_blockquote .tp-bq-desc,{{WRAPPER}} .plus_blockquote .tp-bq-desc p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			)
		);
		$this->add_responsive_control(
			'desc_margin',
			array(
				'label'      => esc_html__( 'Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus_blockquote .tp-bq-desc,{{WRAPPER}} .plus_blockquote .tp-bq-desc p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_author_styling',
			array(
				'label'     => esc_html__( 'Author', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'style!' => 'style-1',
				),
			)
		);
		$this->add_responsive_control(
			'author_align',
			array(
				'label'     => esc_html__( 'Alignment', 'tpebl' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'flex-start' => array(
						'title' => esc_html__( 'Left', 'tpebl' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center'     => array(
						'title' => esc_html__( 'Center', 'tpebl' ),
						'icon'  => 'eicon-text-align-center',
					),
					'flex-end'   => array(
						'title' => esc_html__( 'Right', 'tpebl' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => 'center',
				'selectors' => array(
					'{{WRAPPER}} .plus_blockquote.quote-style-2 .quote-text .quote_author' => 'justify-content: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'author_main_heading',
			array(
				'label'     => 'Author Name',
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'author_main_typography',
				'selector' => '{{WRAPPER}} .plus_blockquote.quote-style-2 .quote-text .quote_author',
			)
		);
		$this->add_responsive_control(
			'author_main_margin',
			array(
				'label'      => esc_html__( 'Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus_blockquote.quote-style-2 .quote-text .quote_author' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'author_main_padding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus_blockquote.quote-style-2 .quote-text .quote_author' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'author_main_color',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus_blockquote.quote-style-2 .quote-text .quote_author' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'author_desc_heading',
			array(
				'label'     => 'Author Description',
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'author_desc_margin',
			array(
				'label'      => esc_html__( 'Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus_blockquote.quote-style-2 .quote-text .quote_author .quote_author-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'author_desc_padding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus_blockquote.quote-style-2 .quote-text .quote_author .quote_author-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'author_desc_typography',
				'selector' => '{{WRAPPER}} .plus_blockquote.quote-style-2 .quote-text .quote_author .quote_author-desc',
			)
		);
		$this->add_control(
			'author_desc_color',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus_blockquote.quote-style-2 .quote-text .quote_author .quote_author-desc' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'author_extras_heading',
			array(
				'label'     => esc_html__( 'Author Extras', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'author_extras_position',
			array(
				'label'     => esc_html__( 'Position', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Absolute', 'tpebl' ),
				'label_off' => esc_html__( 'Relative', 'tpebl' ),
				'default'   => 'no',
				'selectors' => array(
					'{{WRAPPER}} .plus_blockquote .quote_author' => 'position: absolute;',
				),
				'condition' => array(
					'author_extras_heading' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'ae_left',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Left', 'tpebl' ),
				'size_units'  => array( 'px', '%' ),
				'range'       => array(
					'px' => array(
						'min'  => -700,
						'max'  => 700,
						'step' => 1,
					),
					'%'  => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .plus_blockquote .quote_author' => 'left:{{SIZE}}{{UNIT}}',
				),
				'condition'   => array(
					'author_extras_heading'  => 'yes',
					'author_extras_position' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'ae_right',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Top', 'tpebl' ),
				'size_units'  => array( 'px', '%' ),
				'range'       => array(
					'px' => array(
						'min'  => -700,
						'max'  => 700,
						'step' => 1,
					),
					'%'  => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .plus_blockquote .quote_author' => 'top:{{SIZE}}{{UNIT}}',
				),
				'condition'   => array(
					'author_extras_heading'  => 'yes',
					'author_extras_position' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'ae_padding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus_blockquote .quote_author' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'author_extras_heading'  => 'yes',
					'author_extras_position' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'ae_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .plus_blockquote .quote_author',
				'condition' => array(
					'author_extras_heading'  => 'yes',
					'author_extras_position' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'ae_border',
				'label'     => esc_html__( 'Border', 'tpebl' ),
				'selector'  => '{{WRAPPER}} .plus_blockquote .quote_author',
				'separator' => 'before',
				'condition' => array(
					'author_extras_heading'  => 'yes',
					'author_extras_position' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'ae_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus_blockquote .quote_author' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'author_extras_heading'  => 'yes',
					'author_extras_position' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'ae_shadow',
				'selector'  => '{{WRAPPER}} .plus_blockquote .quote_author',
				'condition' => array(
					'author_extras_heading'  => 'yes',
					'author_extras_position' => 'yes',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_image_styling',
			array(
				'label'     => esc_html__( 'Image', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'style!'             => 'style-1',
					'quote_iamge_switch' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'image_padding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-bq-imr-wrap img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'image_margin',
			array(
				'label'      => esc_html__( 'Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-bq-imr-wrap img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'image_align',
			array(
				'label'     => esc_html__( 'Alignment', 'tpebl' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'flex-start' => array(
						'title' => esc_html__( 'Left', 'tpebl' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center'     => array(
						'title' => esc_html__( 'Center', 'tpebl' ),
						'icon'  => 'eicon-text-align-center',
					),
					'flex-end'   => array(
						'title' => esc_html__( 'Right', 'tpebl' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => 'center',
				'selectors' => array(
					'{{WRAPPER}} .tp-bq-imr-wrap' => 'justify-content: {{VALUE}};',
				),
			)
		);
		$this->add_responsive_control(
			'image_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Size', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 500,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 100,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-bq-imr-wrap img' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'image_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-bq-imr-wrap img',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'image_border',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-bq-imr-wrap img',
			)
		);
		$this->add_responsive_control(
			'image_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-bq-imr-wrap img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'image_shadow',
				'selector' => '{{WRAPPER}} .tp-bq-imr-wrap img',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon_styling',
			array(
				'label'     => esc_html__( 'Icon', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'style!'     => 'style-1',
					'quote_icon' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'icon_padding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus_blockquote .quote-left i,{{WRAPPER}}  .plus_blockquote .quote-left-both i,{{WRAPPER}} .plus_blockquote .quote-left svg,{{WRAPPER}}  .plus_blockquote .quote-left-both svg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'icon_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Size', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 10,
						'max'  => 200,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .plus_blockquote .quote-left i,{{WRAPPER}} .plus_blockquote .quote-left-both i' => 'font-size: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .plus_blockquote .quote-left svg,{{WRAPPER}} .plus_blockquote .quote-left-both svg' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
			'icon_pos_top1',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Top Icon Offset', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => -500,
						'max'  => 500,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .plus_blockquote .quote-left.qip_top' => 'top: {{SIZE}}{{UNIT}} !important',
				),
				'condition'   => array(
					'style!'         => 'style-1',
					'quote_icon'     => 'yes',
					'quote_icon_pos' => 'qip_top',
				),
			)
		);
		$this->add_responsive_control(
			'icon_pos_top_left1',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Left Icon Offset', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => -500,
						'max'  => 500,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .plus_blockquote .quote-left.qipa_left' => 'left: {{SIZE}}{{UNIT}} !important',
				),
				'condition'   => array(
					'style!'               => 'style-1',
					'quote_icon'           => 'yes',
					'quote_icon_pos'       => 'qip_top',
					'quote_icon_pos_align' => 'qipa_left',
				),
			)
		);
		$this->add_responsive_control(
			'icon_pos_top_right1',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Right Icon Offset', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => -500,
						'max'  => 500,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .plus_blockquote .quote-left.qipa_right' => 'right: {{SIZE}}{{UNIT}} !important',
				),
				'condition'   => array(
					'style!'               => 'style-1',
					'quote_icon'           => 'yes',
					'quote_icon_pos'       => 'qip_top',
					'quote_icon_pos_align' => 'qipa_right',
				),
			)
		);
		$this->add_responsive_control(
			'icon_pos_bottom_bottom1',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Bottom Icon Offset', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => -500,
						'max'  => 500,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .plus_blockquote .quote-left.qip_bottm' => 'bottom: {{SIZE}}{{UNIT}} !important',
				),
				'condition'   => array(
					'style!'         => 'style-1',
					'quote_icon'     => 'yes',
					'quote_icon_pos' => 'qip_bottm',
				),
			)
		);
		$this->add_responsive_control(
			'icon_pos_bottom_left1',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Left Icon Offset', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => -500,
						'max'  => 500,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .plus_blockquote .quote-left.qip_bottm.qipa_left' => 'left: {{SIZE}}{{UNIT}} !important',
				),
				'condition'   => array(
					'style!'               => 'style-1',
					'quote_icon'           => 'yes',
					'quote_icon_pos'       => 'qip_bottm',
					'quote_icon_pos_align' => 'qipa_left',
				),
			)
		);
		$this->add_responsive_control(
			'icon_pos_bottom_right1',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Right Icon Offset', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => -500,
						'max'  => 500,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .plus_blockquote .quote-left.qip_bottm.qipa_right' => 'right: {{SIZE}}{{UNIT}} !important',
				),
				'condition'   => array(
					'style!'               => 'style-1',
					'quote_icon'           => 'yes',
					'quote_icon_pos'       => 'qip_bottm',
					'quote_icon_pos_align' => 'qipa_right',
				),
			)
		);

		$this->add_responsive_control(
			'icon_pos_both_top_bottom1',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Top/Bottom Icon Offset', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => -500,
						'max'  => 500,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .plus_blockquote.quote-style-2 .quote-left.qip_both' => 'top: {{SIZE}}{{UNIT}} !important',
					'{{WRAPPER}} .plus_blockquote.quote-style-2 .quote-text>span.quote-left-both' => 'bottom: {{SIZE}}{{UNIT}} !important',
				),
				'condition'   => array(
					'style!'         => 'style-1',
					'quote_icon'     => 'yes',
					'quote_icon_pos' => 'qip_both',
				),
			)
		);
		$this->add_responsive_control(
			'iplt_icon',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Left Top Icon Offset', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => -500,
						'max'  => 500,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .plus_blockquote.quote-style-2 .quote-left.qipa_opposite' => 'left: {{SIZE}}{{UNIT}} !important;right:auto',
				),
				'condition'   => array(
					'style!'                    => 'style-1',
					'quote_icon'                => 'yes',
					'quote_icon_pos'            => 'qip_both',
					'quote_icon_pos_align_both' => 'qipa_opposite',
				),
			)
		);
		$this->add_responsive_control(
			'ipbr_icon',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Right Bottom Icon Offset', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => -500,
						'max'  => 500,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .plus_blockquote.quote-style-2 .quote-left-both.qipa_opposite' => 'right: {{SIZE}}{{UNIT}} !important;left:auto',
				),
				'condition'   => array(
					'style!'                    => 'style-1',
					'quote_icon'                => 'yes',
					'quote_icon_pos'            => 'qip_both',
					'quote_icon_pos_align_both' => 'qipa_opposite',
				),
			)
		);
		$this->add_responsive_control(
			'ipld_icon',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Left Icon Offset', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => -500,
						'max'  => 500,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .plus_blockquote.quote-style-2 .quote-left.qip_both.qipa_left,{{WRAPPER}} .plus_blockquote.quote-style-2 .quote-left-both.qip_both.qipa_left ' => 'left: {{SIZE}}{{UNIT}} !important;right:auto',
					'{{WRAPPER}} .plus_blockquote.quote-style-2 .quote-left-both.qip_both.qipa_left' => 'transform: rotate(180deg)',
				),
				'condition'   => array(
					'style!'                    => 'style-1',
					'quote_icon'                => 'yes',
					'quote_icon_pos'            => 'qip_both',
					'quote_icon_pos_align_both' => 'qipa_left',
				),
			)
		);
		$this->add_responsive_control(
			'ipright_icon',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Right Icon Offset', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => -500,
						'max'  => 500,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .plus_blockquote.quote-style-2 .quote-left.qip_both.qipa_right,{{WRAPPER}} .plus_blockquote.quote-style-2 .quote-left-both.qip_both.qipa_right ' => 'right: {{SIZE}}{{UNIT}} !important;left:auto',
					'{{WRAPPER}} .plus_blockquote.quote-style-2 .quote-left-both.qip_both.qipa_right' => 'transform: rotate(180deg)',
				),
				'condition'   => array(
					'style!'                    => 'style-1',
					'quote_icon'                => 'yes',
					'quote_icon_pos'            => 'qip_both',
					'quote_icon_pos_align_both' => 'qipa_right',
				),
			)
		);

		$this->add_control(
			'icon_color',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus_blockquote .quote-left i,{{WRAPPER}} .plus_blockquote .quote-left-both i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .plus_blockquote .quote-left svg,{{WRAPPER}} .plus_blockquote .quote-left-both svg' => 'fill: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'icon_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .plus_blockquote .quote-left i,{{WRAPPER}}  .plus_blockquote .quote-left-both i,{{WRAPPER}} .plus_blockquote .quote-left svg,{{WRAPPER}}  .plus_blockquote .quote-left-both svg',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'icon_border',
				'label'     => esc_html__( 'Border', 'tpebl' ),
				'selector'  => '{{WRAPPER}} .plus_blockquote .quote-left i,{{WRAPPER}}  .plus_blockquote .quote-left-both i,{{WRAPPER}} .plus_blockquote .quote-left svg,{{WRAPPER}}  .plus_blockquote .quote-left-both svg',
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'icon_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus_blockquote .quote-left i,{{WRAPPER}}  .plus_blockquote .quote-left-both i,{{WRAPPER}} .plus_blockquote .quote-left svg,{{WRAPPER}}  .plus_blockquote .quote-left-both svg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'icon_shadow',
				'selector' => '{{WRAPPER}} .plus_blockquote .quote-left i,{{WRAPPER}}  .plus_blockquote .quote-left-both i,{{WRAPPER}} .plus_blockquote .quote-left svg,{{WRAPPER}}  .plus_blockquote .quote-left-both svg',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_tweet_styling',
			array(
				'label'     => esc_html__( 'Tweet Button', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'quote_tweet' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'tweet_align',
			array(
				'label'     => esc_html__( 'Alignment', 'tpebl' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'flex-start' => array(
						'title' => esc_html__( 'Left', 'tpebl' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center'     => array(
						'title' => esc_html__( 'Center', 'tpebl' ),
						'icon'  => 'eicon-text-align-center',
					),
					'flex-end'   => array(
						'title' => esc_html__( 'Right', 'tpebl' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => 'flex-start',
				'selectors' => array(
					'{{WRAPPER}} .plus_blockquote .tp-bq-tweet-wrapper' => 'justify-content: {{VALUE}};',
				),
			)
		);
		$this->add_responsive_control(
			'tweet_padding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus_blockquote .tp-bq-tweet-wrapper .tp-bq-tweet' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);
		$this->add_responsive_control(
			'tweet_margin',
			array(
				'label'      => esc_html__( 'Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus_blockquote .tp-bq-tweet-wrapper .tp-bq-tweet' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'tweet_typography',
				'selector' => '{{WRAPPER}} .plus_blockquote .tp-bq-tweet-wrapper .tp-bq-tweet',
			)
		);
		$this->add_responsive_control(
			'tweet_svg_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Size', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 300,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .plus_blockquote .tp-bq-tweet-wrapper .tp-bq-tweet svg' => 'width: {{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .plus_blockquote .tp-bq-tweet-wrapper .tp-bq-tweet i' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'tweet_svg_offset',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Offset', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .plus_blockquote .tp-bq-tweet-wrapper .tp-bq-tweet i,{{WRAPPER}}  .plus_blockquote .tp-bq-tweet-wrapper .tp-bq-tweet svg' => 'margin-right:{{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_tweet' );
		$this->start_controls_tab(
			'tab_tweet_n',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'tweet_color_n',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus_blockquote .tp-bq-tweet-wrapper .tp-bq-tweet' => 'color: {{VALUE}};',
					'{{WRAPPER}} .plus_blockquote .tp-bq-tweet-wrapper .tp-bq-tweet svg' => 'fill: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'tweet_background_n',
				'label'    => esc_html__( 'Background', 'tpebl' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .plus_blockquote .tp-bq-tweet-wrapper .tp-bq-tweet',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'tweet_border_n',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .plus_blockquote .tp-bq-tweet-wrapper .tp-bq-tweet',
			)
		);
		$this->add_responsive_control(
			'tweet_br_n',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus_blockquote .tp-bq-tweet-wrapper .tp-bq-tweet' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'tweet_shadow_n',
				'selector' => '{{WRAPPER}} .plus_blockquote .tp-bq-tweet-wrapper .tp-bq-tweet',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_tweet_h',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'tweet_color_h',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus_blockquote .tp-bq-tweet-wrapper .tp-bq-tweet:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .plus_blockquote .tp-bq-tweet-wrapper .tp-bq-tweet:hover svg' => 'fill: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'tweet_background_h',
				'label'    => esc_html__( 'Background', 'tpebl' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .plus_blockquote .tp-bq-tweet-wrapper .tp-bq-tweet:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'tweet_border_h',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .plus_blockquote .tp-bq-tweet-wrapper .tp-bq-tweet:hover',
			)
		);
		$this->add_responsive_control(
			'tweet_br_h',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus_blockquote .tp-bq-tweet-wrapper .tp-bq-tweet:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'tweet_shadow_h',
				'selector' => '{{WRAPPER}} .plus_blockquote .tp-bq-tweet-wrapper .tp-bq-tweet:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'tweet_extras_heading',
			array(
				'label'     => esc_html__( 'Tweet Extras', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'tweet_extras_position',
			array(
				'label'     => esc_html__( 'Position', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Absolute', 'tpebl' ),
				'label_off' => esc_html__( 'Relative', 'tpebl' ),
				'default'   => 'no',
				'selectors' => array(
					'{{WRAPPER}} .plus_blockquote .tp-bq-tweet-wrapper .tp-bq-tweet' => 'position: absolute;',
				),
				'condition' => array(
					'tweet_extras_heading' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'tw_left',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Left', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => -700,
						'max'  => 700,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .plus_blockquote .tp-bq-tweet-wrapper .tp-bq-tweet' => 'left:{{SIZE}}{{UNIT}}',
				),
				'condition'   => array(
					'tweet_extras_heading'  => 'yes',
					'tweet_extras_position' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'tw_right',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Top', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => -700,
						'max'  => 700,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .plus_blockquote .tp-bq-tweet-wrapper .tp-bq-tweet' => 'top:{{SIZE}}{{UNIT}}',
				),
				'condition'   => array(
					'tweet_extras_heading'  => 'yes',
					'tweet_extras_position' => 'yes',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_border_l1_styling',
			array(
				'label'     => esc_html__( 'Border Layout', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'border_layout' => 'bl_1',
				),
			)
		);
		$this->add_control(
			'border_l1_inner_heading',
			array(
				'label' => 'Inner Part',
				'type'  => Controls_Manager::HEADING,
			)
		);
		$this->add_responsive_control(
			'bl1o_i_height',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Height', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .plus_blockquote.bl_1' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'bl1o_i_background_h',
				'label'    => esc_html__( 'Background', 'tpebl' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .plus_blockquote.bl_1 blockquote.quote-text',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'bl1o_i_border_h',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .plus_blockquote.bl_1 blockquote.quote-text',
			)
		);
		$this->add_responsive_control(
			'bl1o_i__br_h',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus_blockquote.bl_1 blockquote.quote-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'bl1o_i_shadow_h',
				'selector' => '{{WRAPPER}} .plus_blockquote.bl_1 blockquote.quote-text',
			)
		);
		$this->add_control(
			'border_l1_outer_heading',
			array(
				'label'     => 'Outer Part',
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'bl1o_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Border Size', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 20,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .plus_blockquote.bl_1:before,{{WRAPPER}} .plus_blockquote.bl_1:after' => 'border-width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'bl1o_color',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus_blockquote.bl_1:before,{{WRAPPER}} .plus_blockquote.bl_1:after' => 'border-color: {{VALUE}};',
				),
			)
		);
		$this->add_responsive_control(
			'bl1o_br',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus_blockquote.bl_1:before,{{WRAPPER}} .plus_blockquote.bl_1:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_border_l2_styling',
			array(
				'label'     => esc_html__( 'Border Layout', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'border_layout' => 'bl_2',
				),
			)
		);
		$this->add_responsive_control(
			'bl2o_width_height',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Background Size', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 700,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .plus_blockquote.bl_2' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'bl2o_bg_heading',
			array(
				'label' => 'Normal',
				'type'  => Controls_Manager::HEADING,
			)
		);
		$this->add_control(
			'bl2o_bgcolor1',
			array(
				'label' => esc_html__( 'Background Color1', 'tpebl' ),
				'type'  => Controls_Manager::COLOR,
			)
		);
		$this->add_control(
			'bl2o_bgcolor2',
			array(
				'label'     => esc_html__( 'Background Color2', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus_blockquote.bl_2' => 'background: radial-gradient( ellipse at center, {{bl2o_bgcolor1.VALUE}}, {{value}} 70%, rgb(176 187 191 / 0%) 70.3% );',
				),
			)
		);
		$this->add_control(
			'bl2o_bg_hover_heading',
			array(
				'label'     => 'Hover',
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'bl2o_bgcolor1_h',
			array(
				'label' => esc_html__( 'Background Color1', 'tpebl' ),
				'type'  => Controls_Manager::COLOR,
			)
		);
		$this->add_control(
			'bl2o_bgcolor2_h',
			array(
				'label'     => esc_html__( 'Background Color2', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus_blockquote.bl_2:hover' => 'background: radial-gradient( ellipse at center, {{bl2o_bgcolor1_h.VALUE}}, {{value}} 70%, rgb(176 187 191 / 0%) 70.3% );',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_border_l3_styling',
			array(
				'label'     => esc_html__( 'Border Layout', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'border_layout' => 'bl_3',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'bl3_border',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .plus_blockquote.bl_3',
			)
		);
		$this->add_control(
			'bl3_corner_dot_bg_color',
			array(
				'label'     => esc_html__( 'Corner Background Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus_blockquote.bl_3 .tp-corner-box' => 'background: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'bl3_corner_dot_color',
			array(
				'label'     => esc_html__( 'Corner Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus_blockquote.bl_3 .tp-corner-box.tp-corner-box-left' => 'border-color: transparent transparent {{VALUE}} transparent;',
					'{{WRAPPER}} .plus_blockquote.bl_3 .tp-corner-box.tp-corner-box-right' => 'border-color:{{VALUE}} transparent transparent transparent;',
					'{{WRAPPER}} .plus_blockquote.bl_3 .tp-corner-box.tp-corner-box-top' => 'border-color:transparent transparent transparent {{VALUE}};',
					'{{WRAPPER}} .plus_blockquote.bl_3 .tp-corner-box.tp-corner-box-bottom' => 'border-color:transparent {{VALUE}} transparent transparent;',
				),
			)
		);
		$this->add_responsive_control(
			'bl3_corner_dot_bs',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Corner Border Size', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 20,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .plus_blockquote.bl_3 .tp-corner-box' => 'border-width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'bl3_corner_dot_bsize',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Corner Position', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 150,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .plus_blockquote.bl_3 .tp-corner-box.tp-corner-box-left' => 'top: -{{SIZE}}{{UNIT}};left:-{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .plus_blockquote.bl_3 .tp-corner-box.tp-corner-box-right' => 'bottom: -{{SIZE}}{{UNIT}};right:-{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .plus_blockquote.bl_3 .tp-corner-box.tp-corner-box-top' => 'top: -{{SIZE}}{{UNIT}};right:-{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .plus_blockquote.bl_3 .tp-corner-box.tp-corner-box-bottom' => 'bottom: -{{SIZE}}{{UNIT}};left:-{{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'bl3_corner_dot_bsize_n',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Corner Size', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 150,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .plus_blockquote.bl_3 .tp-corner-box' => 'height: {{SIZE}}{{UNIT}};width:{{SIZE}}{{UNIT}};',
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
		$this->add_responsive_control(
			'box_padding_n',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus_blockquote' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'box_margin_n',
			array(
				'label'      => esc_html__( 'Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus_blockquote' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
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
			)
		);
		$this->add_control(
			'border_style',
			array(
				'label'     => esc_html__( 'Border Style', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'solid',
				'options'   => l_theplus_get_border_style(),
				'selectors' => array(
					'{{WRAPPER}} .plus_blockquote' => 'border-style: {{VALUE}};',
				),
				'condition' => array(
					'box_border' => 'yes',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_border_style' );
		$this->start_controls_tab(
			'tab_border_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'box_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .plus_blockquote' => 'border-color: {{VALUE}};',
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
					'{{WRAPPER}} .plus_blockquote' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
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
					'{{WRAPPER}} .plus_blockquote' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_border_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'box_border_hover_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .plus_blockquote:hover' => 'border-color: {{VALUE}};',
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
					'{{WRAPPER}} .plus_blockquote:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'background_options',
			array(
				'label'     => esc_html__( 'Background Options', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
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
				'selector' => '{{WRAPPER}} .plus_blockquote ',

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
				'selector' => '{{WRAPPER}} .plus_blockquote:hover',
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
				'selector' => '{{WRAPPER}} .plus_blockquote',
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
				'selector' => '{{WRAPPER}} .plus_blockquote:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
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
	 * Render Block quote
	 *
	 * Written in PHP and HTML.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	protected function render() {

		$settings    = $this->get_settings_for_display();
		$description = ! empty( $settings['content_description'] ) ? $settings['content_description'] : '';
		$quote_style = ! empty( $settings['style'] ) ? $settings['style'] : 'style-1';

		$author        = ! empty( $settings['quote_author'] ) ? $settings['quote_author'] : '';
		$author_desc   = ! empty( $settings['quote_author_desc'] ) ? $settings['quote_author_desc'] : '';
		$border_layout = ! empty( $settings['border_layout'] ) ? $settings['border_layout'] : 'none';

		$icon        = isset( $settings['quote_icon'] ) ? $settings['quote_icon'] : '';
		$icon_select = ! empty( $settings['quote_icon_select'] ) ? $settings['quote_icon_select'] : 'fas fa-quote-left';
		$icon_pos    = ! empty( $settings['quote_icon_pos'] ) ? $settings['quote_icon_pos'] : 'qip_top';
		$icon_align  = ! empty( $settings['quote_icon_pos_align'] ) ? $settings['quote_icon_pos_align'] : 'qipa_left';
		$iamge_on    = ! empty( $settings['quote_iamge_switch'] ) ? $settings['quote_iamge_switch'] : '';
		$q_image     = ! empty( $settings['quote_image']['url'] ) ? $settings['quote_image']['url'] : '';
		$dropcap     = ! empty( $settings['quote_dropcap'] ) ? $settings['quote_dropcap'] : '';

		$quote_tweet = isset( $settings['quote_tweet'] ) ? $settings['quote_tweet'] : 'no';
		$tweet_icon  = ! empty( $settings['quote_tweet_icon_select'] ) ? $settings['quote_tweet_icon_select'] : 'fab fa-twitter';

		$icon_align_both  = ! empty( $settings['quote_icon_pos_align_both'] ) ? $settings['quote_icon_pos_align_both'] : 'qipa_opposite';
		$quote_tweet_link = isset( $settings['quote_tweet_link'] ) ? $settings['quote_tweet_link'] : 'no';

		$ani_effects   = ! empty( $settings['animation_effects'] ) ? $settings['animation_effects'] : 'no-animation';
		$ani_delay     = ! empty( $settings['animation_delay']['size'] ) ? $settings['animation_delay']['size'] : 50;
		$ani_duration  = ! empty( $settings['animation_duration_default'] ) ? $settings['animation_duration_default'] : '';
		$ani_speed     = ! empty( $settings['animate_duration']['size'] ) ? $settings['animate_duration']['size'] : 50;
		$ani_o_effects = ! empty( $settings['animation_out_effects'] ) ? $settings['animation_out_effects'] : 'no-animation';
		$ani_o_delay   = ! empty( $settings['animation_out_delay']['size'] ) ? $settings['animation_out_delay']['size'] : 50;
		$ani_o_speed   = ! empty( $settings['animation_out_duration']['size'] ) ? $settings['animation_out_duration']['size'] : 50;

		$ani_o_duration = ! empty( $settings['animation_out_duration_default'] ) ? $settings['animation_out_duration_default'] : '';

		$blclass = '';
		if ( 'none' !== $border_layout ) {
			$blclass = ' tpblcls';
		}

		$icon_s      = '';
		$pos_s       = '';
		$align_s     = '';
		$tweet_icons = '';
		$tweet_text  = '';
		$quote_img   = '';
		$tweetlink   = '';
		$twt_btn     = '';
		$udata       = '';

		$author_desccon = '';

		if ( 'yes' === $quote_tweet ) {

			if ( ! empty( $tweet_icon ) ) {
				ob_start();
				\Elementor\Icons_Manager::render_icon( $tweet_icon, array( 'aria-hidden' => 'true' ) );
				$tweet_icons = ob_get_contents();
				ob_end_clean();
			}

			$tweet_text = ! empty( $settings['quote_tweet_text'] ) ? $settings['quote_tweet_text'] : '';

			if ( ! empty( $description ) ) {
				$udata .= wp_strip_all_tags( $description );
			}

			if ( ! empty( $author ) ) {
				$udata .= ' — ' . wp_strip_all_tags( $author );
			}

			if ( ! empty( $author_desc ) ) {
				$udata .= ' ( ' . wp_strip_all_tags( $author_desc ) . ' ) ';
			}

			if ( 'yes' === $quote_tweet_link ) {
				$urldata = 'http://';

				if ( isset( $_SERVER['HTTPS'] ) && 'on' === $_SERVER['HTTPS'] ) {
					$urldata = 'https://';
				}

				$urldata = ! empty( $_SERVER['HTTP_HOST'] ) ? sanitize_text_field( wp_unslash( $_SERVER['HTTP_HOST'] ) ) : '';
				$urldata = ! empty( $_SERVER['REQUEST_URI'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '';

				$udata .= ' ' . urlencode( $urldata );
			}

			$twt_btn = '<div class="tp-bq-tweet-wrapper"><a href="' . esc_url( 'https://twitter.com/intent/tweet?text=' . $udata ) . '" class="tp-bq-tweet" target="_blank">' . wp_kses_post( $tweet_icons ) . esc_html( $tweet_text ) . '</a></div>';

		}

		if ( 'yes' === $iamge_on && ! empty( $q_image ) ) {

			$imageid   = ! empty( $settings['quote_image']['id'] ) ? $settings['quote_image']['id'] : '';
			$image_src = tp_get_image_rander( $imageid, 'full', array( 'class' => 'tp-bq-img' ) );
			$quote_img = '<div class="tp-bq-imr-wrap" >' . $image_src . '</div>';
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
				$animate_duration = $ani_speed;
				$animation_attr  .= ' data-animate-duration="' . esc_attr( $animate_duration ) . '"';
			}

			if ( 'no-animation' !== $ani_o_effects ) {
				$animation_attr .= ' data-animate-out-type="' . esc_attr( $ani_o_effects ) . '" data-animate-out-delay="' . esc_attr( $ani_o_delay ) . '"';
				if ( 'yes' === $ani_o_duration ) {
					$animation_attr .= ' data-animate-out-duration="' . esc_attr( $ani_o_speed ) . '"';
				}
			}
		}

			$text_block = '<div class="pt-plus-text-block-wrapper" >';

				$text_block .= '<div class="text_block_parallax">';

					$lz1 = function_exists( 'tp_has_lazyload' ) ? tp_bg_lazyLoad( $settings['box_background_image'], $settings['box_hover_background_image'] ) : '';

					$text_block .= '<div class="plus_blockquote quote-' . esc_attr( $quote_style ) . ' ' . esc_attr( $animated_class ) . ' ' . esc_attr( $lz1 ) . ' ' . esc_attr( $border_layout ) . ' ' . esc_attr( $blclass ) . '" ' . $animation_attr . '>';

		if ( 'bl_3' === $border_layout ) {
			$text_block .= '<div class="tp-corner-box tp-corner-box-left"></div><div class="tp-corner-box tp-corner-box-right"></div><div class="tp-corner-box tp-corner-box-top"></div><div class="tp-corner-box tp-corner-box-bottom"></div>';
		}

		$text_block .= '<blockquote class="quote-text">';

		if ( 'style-2' === $quote_style && 'yes' === $icon ) {
			if ( ! empty( $icon_select ) ) {
				ob_start();
				\Elementor\Icons_Manager::render_icon( $icon_select, array( 'aria-hidden' => 'true' ) );
				$icon_s = ob_get_contents();
				ob_end_clean();

				if ( 'qip_top' === $icon_pos || 'qip_bottm' === $icon_pos ) {
					$pos_s = $icon_pos;
					if ( ! empty( $icon_align ) ) {
						$align_s = $icon_align;
					}
				}

				if ( 'qip_both' === $icon_pos ) {
					$pos_s = $icon_pos;
					if ( ! empty( $icon_align_both ) ) {
						$align_s = $icon_align_both;
					}
				}

				if ( ! empty( $icon_s ) ) {
					$text_block .= '<span class="quote-left ' . esc_attr( $icon_pos ) . ' ' . esc_attr( $align_s ) . '">' . $icon_s . '</span>';
				} else {
					$text_block .= '<i class="fa fa-quote-left quote-left" aria-hidden="true"></i>';
				}
			}

		}
		if ( 'yes' === $iamge_on && ! empty( $q_image ) ) {
			$text_block .= $quote_img;
		}

		if ( 'yes' === $dropcap && 'style-2' !== $quote_style ) {
			$content = wp_kses_post( $description );

			if ( '<' === $content[0] ) {
				$position  = strpos( $content, '>' );
				$pos       = $position + 2;
				$first_pos = $position + 1;
				$result    = substr( $content, 0, $pos );

				$text_block .= '<span><span class="tp-blockquote-dropcap">' . wp_kses_post( $content[ $first_pos ] ) . '</span> ' . trim( $content, $result ) . ' </span>';
			} else {
				$text_block .= '<span class="tp-bq-desc">' . wp_kses_post( $description ) . '</span>';
			}
		} else {
			$text_block .= '<span class="tp-bq-desc">' . wp_kses_post( $description ) . '</span>';
		}

		if ( 'style-2' === $quote_style && ! empty( $author ) ) {

			if ( ! empty( $author_desc ) ) {
				$author_desccon = '<span class="quote_author-desc">' . esc_html( $author_desc ) . '</span>';
			}

			$text_block .= '<p class="quote_author">' . esc_html( $author ) . $author_desccon . '</p>';
		}

		$text_block .= $twt_btn;

		if ( 'style-2' === $quote_style && 'yes' === $icon && ! empty( $icon_select ) && ! empty( $icon_pos ) && 'qip_both' === $icon_pos && ! empty( $icon_align_both ) ) {
			$align_s = $icon_align_both;

			$text_block .= '<span class="quote-left-both ' . esc_attr( $icon_pos ) . ' ' . esc_attr( $align_s ) . '">' . $icon_s . '</span>';
		}
						$text_block .= '</blockquote>';

					$text_block .= '</div>';

				$text_block .= '</div>';

			$text_block .= '</div>';

		echo $text_block;
	}
}
