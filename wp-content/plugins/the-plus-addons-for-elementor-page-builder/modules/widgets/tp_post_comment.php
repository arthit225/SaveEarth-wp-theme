<?php
/**
 * Widget Name: Post Comment
 * Description: Post Comment
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
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class L_ThePlus_Post_Comment
 */
class L_ThePlus_Post_Comment extends Widget_Base {

	/**
	 * Get Widget Name.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_name() {
		return 'tp-post-comment';
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
		return esc_html__( 'Post Comment', 'tpebl' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-commenting theplus_backend_icon';
	}

	/**
	 * Get Widget categories.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_categories() {
		return array( 'plus-builder' );
	}

	/**
	 * Get Widget keywords.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_keywords() {
		return array( 'Post Comment', 'Comment', 'Comment Box', 'Comment Section', 'Feedback', 'User Feedback', 'User Comment', 'Add Comment', 'Leave Comment', 'Submit Comment', 'Comment Form', 'Comment Widget', 'Comment Element', 'Elementor Comment', 'Elementor Comment Box', 'Elementor Comment Section', 'Elementor Feedback', 'Elementor User Feedback', 'Elementor User Comment', 'Elementor Add Comment', 'Elementor Leave Comment', 'Elementor Submit Comment', 'Elementor Comment Form' );
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
	 * Get Widget Custom Help Url.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'contentt_section',
			array(
				'label' => esc_html__( 'Content', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'PostTitle',
			array(
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Title', 'tpebl' ),
				'default' => esc_html__( 'Leave Your Comment', 'tpebl' ),
			)
		);
		$this->add_control(
			'BtnTitle',
			array(
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Button Text', 'tpebl' ),
				'default' => esc_html__( 'Submit Now', 'tpebl' ),
			)
		);
		$this->add_control(
			'PlaceholderTxt',
			array(
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Placeholder Text', 'tpebl' ),
				'default' => esc_html__( 'Comment', 'tpebl' ),
			)
		);
		$this->add_control(
			'LeaveTxt',
			array(
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Leave Reply Text', 'tpebl' ),
				'default' => esc_html__( 'Leave A Reply To', 'tpebl' ),
			)
		);
		$this->add_control(
			'CancelTxt',
			array(
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Cancel Reply Text', 'tpebl' ),
				'default' => esc_html__( 'Cancel Reply', 'tpebl' ),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Heading', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'headingTypo',
				'label'    => esc_html__( 'Text', 'tpebl' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-post-comment .comment-list .comment-section-title,.tp-post-comment #respond.comment-respond h3#reply-title',
			)
		);
		$this->add_control(
			'headingColor',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-post-comment .comment-list .comment-section-title,.tp-post-comment #respond.comment-respond h3#reply-title' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_cmnt_list_style',
			array(
				'label' => esc_html__( 'Comment List', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'imagesize',
			array(
				'type'      => Controls_Manager::SLIDER,
				'label'     => esc_html__( 'Image Size', 'tpebl' ),
				'range'     => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .tp-post-comment .comment-list li.comment>.comment-body img.avatar,{{WRAPPER}} .tp-post-comment .comment-list li.pingback>.comment-body img.avatar' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_cmnt_list_img_style' );
		$this->start_controls_tab(
			'tab_cmnt_list_img_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'imgNmlBorder',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-post-comment .comment-list li.comment>.comment-body img.avatar,{{WRAPPER}} .tp-post-comment .comment-list li.pingback>.comment-body img.avatar',
			)
		);
		$this->add_responsive_control(
			'imgNmlBRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-post-comment .comment-list li.comment>.comment-body img.avatar,{{WRAPPER}} .tp-post-comment .comment-list li.pingback>.comment-body img.avatar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'img_Shadow',
				'label'    => esc_html__( 'Box Shadow', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-post-comment .comment-list li.comment>.comment-body img.avatar,{{WRAPPER}} .tp-post-comment .comment-list li.pingback>.comment-body img.avatar',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_cmnt_list_imgh_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'imgHvrBorder',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-post-comment .comment-list li.comment>.comment-body img.avatar:hover,{{WRAPPER}} .tp-post-comment .comment-list li.pingback>.comment-body img.avatar:hover',
			)
		);
		$this->add_responsive_control(
			'imgHvrBRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-post-comment .comment-list li.comment>.comment-body img.avatar:hover,{{WRAPPER}} .tp-post-comment .comment-list li.pingback>.comment-body img.avatar:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'imgH_Shadow',
				'label'    => esc_html__( 'Box Shadow', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-post-comment .comment-list li.comment>.comment-body img.avatar:hover,{{WRAPPER}} .tp-post-comment .comment-list li.pingback>.comment-body img.avatar:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'userTypo',
				'label'    => esc_html__( 'Username Typography', 'tpebl' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-post-comment .comment-author.vcard .fn .url',
			)
		);
		$this->start_controls_tabs( 'tabs_cmnt_list_style' );
		$this->start_controls_tab(
			'tab_cmnt_list_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'userColor',
			array(
				'label'     => esc_html__( 'Username Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-post-comment .comment-author.vcard .fn .url' => 'color: {{VALUE}}',
				),
				'separator' => 'after',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_cmnt_list_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'userHoverColor',
			array(
				'label'     => esc_html__( 'Username Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-post-comment .comment-author.vcard .fn .url:hover' => 'color: {{VALUE}}',
				),
				'separator' => 'after',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'metaTypo',
				'label'    => esc_html__( 'Meta Typography', 'tpebl' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-post-comment .comment-meta .comment-metadata a',

			)
		);
		$this->start_controls_tabs( 'tabs_cmnt_meta_style' );
		$this->start_controls_tab(
			'tab_cmnt_meta_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'metaColor',
			array(
				'label'     => esc_html__( 'Meta Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-post-comment .comment-meta .comment-metadata a' => 'color: {{VALUE}}',
				),
				'separator' => 'after',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_cmnt_meta_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'metaHoverColor',
			array(
				'label'     => esc_html__( 'Meta Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-post-comment .comment-meta .comment-metadata a:hover' => 'color: {{VALUE}}',
				),
				'separator' => 'after',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'replyTypo',
				'label'    => esc_html__( 'Reply Message Typography', 'tpebl' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-post-comment .comment-list .comment-content,{{WRAPPER}} .tp-post-comment .comment-list .comment-content p',
			)
		);
		$this->start_controls_tabs( 'tabs_cmnt_reply_style' );
		$this->start_controls_tab(
			'tab_cmnt_reply_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'replyColor',
			array(
				'label'     => esc_html__( 'Reply Message Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-post-comment .comment-list .comment-content,{{WRAPPER}} .tp-post-comment .comment-list .comment-content p' => 'color: {{VALUE}}',
				),
				'separator' => 'after',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_cmnt_reply_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'replyHoverColor',
			array(
				'label'     => esc_html__( 'Reply Message Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-post-comment .comment-list .comment-content:hover,{{WRAPPER}} .tp-post-comment .comment-list .comment-content:hover p' => 'color: {{VALUE}};border-color: {{VALUE}}',
				),
				'separator' => 'after',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'sep_comment_styling',
			array(
				'label' => esc_html__( 'Separate Comment', 'tpebl' ),
				'type'  => Controls_Manager::HEADING,
			)
		);
		$this->add_control(
			'sep_comment_padding',
			array(
				'type'      => Controls_Manager::SLIDER,
				'label'     => esc_html__( 'Padding', 'tpebl' ),
				'range'     => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .tp-post-comment .comment-list>.comment:not(.parent),
					{{WRAPPER}} .tp-post-comment .comment-list ul.children li,
					{{WRAPPER}} .tp-post-comment .comment-list>.comment:nth-child(2),
					{{WRAPPER}} .tp-post-comment .comment-list>.comment.parent > .comment-body' => 'padding: {{SIZE}}px;',
					'{{WRAPPER}} .tp-post-comment .comment-list>.comment.parent > .comment-body' => 'padding-left: calc(95px + {{SIZE}}px) !important;',
					'{{WRAPPER}} .tp-post-comment .comment-list li.comment.parent > .comment-body  img.avatar' => 'left: {{SIZE}}px !important;top: {{SIZE}}px !important;',
					'{{WRAPPER}} .tp-post-comment .comment-list li.comment.parent > .comment-body .reply' => 'right: {{SIZE}}px !important;',
					'{{WRAPPER}} .tp-post-comment #comments .comment-list li.comment> .children' => 'padding-top: {{SIZE}}px !important;',
				),
			)
		);
		$this->add_control(
			'sep_comment_bottom_space',
			array(
				'type'      => Controls_Manager::SLIDER,
				'label'     => esc_html__( 'Bottom Space', 'tpebl' ),
				'range'     => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .tp-post-comment .comment-list>.comment:not(.parent),
					{{WRAPPER}} .tp-post-comment .comment-list ul.children li,
					{{WRAPPER}} .tp-post-comment .comment-list>.comment:nth-child(2),
					{{WRAPPER}} .tp-post-comment .comment-list>.comment.parent > .comment-body' => 'margin-bottom: {{SIZE}}px;',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'sepcommentborder',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-post-comment .comment-list>.comment:not(.parent),
					{{WRAPPER}} .tp-post-comment .comment-list ul.children li,
					{{WRAPPER}} .tp-post-comment .comment-list>.comment:nth-child(2),
					{{WRAPPER}} .tp-post-comment .comment-list>.comment.parent > .comment-body',
			)
		);
		$this->add_responsive_control(
			'sepcommentborderradius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-post-comment .comment-list>.comment:not(.parent),
					{{WRAPPER}} .tp-post-comment .comment-list ul.children li,
					{{WRAPPER}} .tp-post-comment .comment-list>.comment:nth-child(2),
					{{WRAPPER}} .tp-post-comment .comment-list>.comment.parent > .comment-body' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_rep_button_style',
			array(
				'label' => esc_html__( 'Reply Button', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'repbtnpadding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-post-comment .comment-list .reply a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'repbtnTypo',
				'label'    => esc_html__( 'Typography', 'tpebl' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-post-comment .comment-list .reply a',
			)
		);
		$this->start_controls_tabs( 'tabs_rep_btn_color_style' );
		$this->start_controls_tab(
			'tab_rep_btn_color_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'repbtnColor',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-post-comment .comment-list .reply a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'repbtnBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-post-comment .comment-list .reply a',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'repbtnBorder',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-post-comment .comment-list .reply a',
			)
		);
		$this->add_responsive_control(
			'repbtnBorderRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-post-comment .comment-list .reply a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'repbtnBoxShadow',
				'selector' => '{{WRAPPER}} .tp-post-comment .comment-list .reply a',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_rep_btn_color_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'repbtnHoverColor',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-post-comment .comment-list .reply a:hover' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'repbtnBgHover',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-post-comment .comment-list .reply a:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'repbtnBorderHover',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-post-comment .comment-list .reply a:hover',
			)
		);
		$this->add_responsive_control(
			'repbtnBorderRadiusHover',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-post-comment .comment-list .reply a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'repbtnBoxShadowHover',
				'selector' => '{{WRAPPER}} .tp-post-comment .comment-list .reply a:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_repcan_button_style',
			array(
				'label' => esc_html__( 'Cancel Reply', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'repCanbtnTypo',
				'label'    => esc_html__( 'Typography', 'tpebl' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-post-comment #respond.comment-respond #cancel-comment-reply-link',
			)
		);
		$this->start_controls_tabs( 'tabs_repcancel_btn_style' );
		$this->start_controls_tab(
			'tab_repcancel_btn_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'repcanbtnColor',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-post-comment #respond.comment-respond #cancel-comment-reply-link' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_repcancel_btn_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'repcanbtnColorHover',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-post-comment #respond.comment-respond #cancel-comment-reply-link:hover' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_cmnt_field_style',
			array(
				'label' => esc_html__( 'Comment Form', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'fieldLabelColor',
			array(
				'label'     => esc_html__( 'Label Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-post-comment #respond #commentform label' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'fieldLabelTypo',
				'label'     => esc_html__( 'Label Typography', 'tpebl' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .tp-post-comment #respond #commentform label',
				'separator' => 'after',
			)
		);
		$this->add_responsive_control(
			'fieldpadding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-post-comment #commentform #author,{{WRAPPER}} .tp-post-comment #commentform #email,{{WRAPPER}} .tp-post-comment #commentform #url,{{WRAPPER}} .tp-post-comment form.comment-form textarea#comment' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'fieldTypo',
				'label'    => esc_html__( 'Fields Typography', 'tpebl' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-post-comment #commentform #author,{{WRAPPER}} .tp-post-comment #commentform #email,{{WRAPPER}} .tp-post-comment #commentform #url,{{WRAPPER}} .tp-post-comment form.comment-form textarea#comment',
			)
		);
		$this->start_controls_tabs( 'tabs_cmnt_field_style' );
		$this->start_controls_tab(
			'tab_cmnt_field_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'fieldColor',
			array(
				'label'     => esc_html__( 'Fields Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-post-comment #commentform #author,{{WRAPPER}} .tp-post-comment #commentform #email,{{WRAPPER}} .tp-post-comment #commentform #url,{{WRAPPER}} .tp-post-comment form.comment-form textarea#comment' => 'color: {{VALUE}}',
				),

			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'fieldBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-post-comment #commentform #author,
				{{WRAPPER}} .tp-post-comment #commentform #email,
				{{WRAPPER}} .tp-post-comment #commentform #url,
				{{WRAPPER}} .tp-post-comment form.comment-form textarea#comment',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'fieldBorder',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-post-comment #commentform #author,
				{{WRAPPER}} .tp-post-comment #commentform #email,
				{{WRAPPER}} .tp-post-comment #commentform #url,
				{{WRAPPER}} .tp-post-comment form.comment-form textarea#comment',
			)
		);
		$this->add_responsive_control(
			'fieldBorderRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-post-comment #commentform #author,
				{{WRAPPER}} .tp-post-comment #commentform #email,
				{{WRAPPER}} .tp-post-comment #commentform #url,
				{{WRAPPER}} .tp-post-comment form.comment-form textarea#comment' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'fieldBoxShadow',
				'selector' => '{{WRAPPER}} .tp-post-comment #commentform #author,
				{{WRAPPER}} .tp-post-comment #commentform #email,
				{{WRAPPER}} .tp-post-comment #commentform #url,
				{{WRAPPER}} .tp-post-comment form.comment-form textarea#comment',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_cmnt_field_hover',
			array(
				'label' => esc_html__( 'Focus', 'tpebl' ),
			)
		);
		$this->add_control(
			'fieldHoverColor',
			array(
				'label'     => esc_html__( 'Fields Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-post-comment #commentform #author:focus,
				{{WRAPPER}} .tp-post-comment #commentform #email:focus,
				{{WRAPPER}} .tp-post-comment #commentform #url:focus,
				{{WRAPPER}} .tp-post-comment form.comment-form textarea#comment:focus' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'fieldBgHover',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-post-comment #commentform #author:focus,
				{{WRAPPER}} .tp-post-comment #commentform #email:focus,
				{{WRAPPER}} .tp-post-comment #commentform #url:focus,
				{{WRAPPER}} .tp-post-comment form.comment-form textarea#comment:focus',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'fieldBorderHover',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-post-comment #commentform #author:focus,
				{{WRAPPER}} .tp-post-comment #commentform #email:focus,
				{{WRAPPER}} .tp-post-comment #commentform #url:focus,
				{{WRAPPER}} .tp-post-comment form.comment-form textarea#comment:focus',
			)
		);
		$this->add_responsive_control(
			'fieldBorderRadiusHover',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-post-comment #commentform #author:focus,
				{{WRAPPER}} .tp-post-comment #commentform #email:focus,
				{{WRAPPER}} .tp-post-comment #commentform #url:focus,
				{{WRAPPER}} .tp-post-comment form.comment-form textarea#comment:focus' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'fieldBoxShadowHover',
				'selector' => '{{WRAPPER}} .tp-post-comment #commentform #author:focus,
				{{WRAPPER}} .tp-post-comment #commentform #email:focus,
				{{WRAPPER}} .tp-post-comment #commentform #url:focus,
				{{WRAPPER}} .tp-post-comment form.comment-form textarea#comment:focus',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'customwidth',
			array(
				'label'     => esc_html__( 'Custom Width', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'customwidthcomment',
			array(
				'type'      => Controls_Manager::SLIDER,
				'label'     => esc_html__( 'Comment', 'tpebl' ),
				'range'     => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .tp-post-comment form.comment-form .tp-row' => 'width: {{SIZE}}%;float: left;margin-right: 15px;',
				),
				'condition' => array(
					'customwidth' => 'yes',
				),
			)
		);
		$this->add_control(
			'customwidthauthor',
			array(
				'type'      => Controls_Manager::SLIDER,
				'label'     => esc_html__( 'Author', 'tpebl' ),
				'range'     => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .tp-post-comment form.comment-form .comment-form-author' => 'width: {{SIZE}}%;float: left;margin-right: 15px;',
				),
				'condition' => array(
					'customwidth' => 'yes',
				),
			)
		);
		$this->add_control(
			'customwidthemail',
			array(
				'type'      => Controls_Manager::SLIDER,
				'label'     => esc_html__( 'Email', 'tpebl' ),
				'range'     => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .tp-post-comment form.comment-form .comment-form-email' => 'width: {{SIZE}}%;float: left;margin-right: 15px;',
				),
				'condition' => array(
					'customwidth' => 'yes',
				),
			)
		);
		$this->add_control(
			'customwidthwebsite',
			array(
				'type'      => Controls_Manager::SLIDER,
				'label'     => esc_html__( 'Website', 'tpebl' ),
				'range'     => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .tp-post-comment form.comment-form .comment-form-url' => 'width: {{SIZE}}%;float: left;margin-right: 15px;',
				),
				'condition' => array(
					'customwidth' => 'yes',
				),
			)
		);
		$this->add_control(
			'customwidthcc',
			array(
				'type'      => Controls_Manager::SLIDER,
				'label'     => esc_html__( 'Cookies Consent', 'tpebl' ),
				'range'     => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .tp-post-comment .comment-form-cookies-consent input#wp-comment-cookies-consent' => 'width: {{SIZE}}%;',
					'{{WRAPPER}} .tp-post-comment .comment-form-cookies-consent label' => 'text-align: center;',
				),
				'condition' => array(
					'customwidth' => 'yes',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_button_style',
			array(
				'label' => esc_html__( 'Submit Button', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'btnpadding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-post-comment #commentform #submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_responsive_control(
			'btnalign',
			array(
				'label'     => esc_html__( 'Alignment', 'tpebl' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => 'left',
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
				'devices'   => array( 'desktop', 'tablet', 'mobile' ),
				'separator' => 'before',
				'selectors' => array(
					'{{WRAPPER}} .tp-post-comment #comments .form-submit' => 'text-align: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'btnTypo',
				'label'    => esc_html__( 'Button Typography', 'tpebl' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-post-comment #commentform #submit',
			)
		);
		$this->start_controls_tabs( 'tabs_btn_color_style' );
		$this->start_controls_tab(
			'tab_btn_color_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'btnColor',
			array(
				'label'     => esc_html__( 'Button Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-post-comment #commentform #submit' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'btnBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-post-comment #commentform #submit',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'btnBorder',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-post-comment #commentform #submit',
			)
		);
		$this->add_responsive_control(
			'btnBorderRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-post-comment #commentform #submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'btnBoxShadow',
				'selector' => '{{WRAPPER}} .tp-post-comment #commentform #submit',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_btn_color_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'btnHoverColor',
			array(
				'label'     => esc_html__( 'Button Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-post-comment #commentform #submit:hover' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'btnBgHover',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-post-comment #commentform #submit:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'btnBorderHover',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-post-comment #commentform #submit:hover',
			)
		);
		$this->add_responsive_control(
			'btnBorderRadiusHover',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-post-comment #commentform #submit:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'btnBoxShadowHover',
				'selector' => '{{WRAPPER}} .tp-post-comment #commentform #submit:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	/**
	 * Render Post Comment
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	protected function render() {
		$settings     = $this->get_settings_for_display();
		$post_id      = get_queried_object_id();
		$post         = get_queried_object();
		$uid_pscmnt   = uniqid( 'tp-comment' );
		$comment_args = $this->tp_comment_args();
		$comment      = get_comments( $post );
		$list_args    = array(
			'style'       => 'ul',
			'short_ping'  => true,
			'avatar_size' => 100,
			'page'        => $post_id,
		);

		ob_start();
			echo '<div class="tp-post-comment tp-widget-' . esc_attr( $uid_pscmnt ) . '">';
				echo '<div id="comments" class="comments-area">';
		if ( get_comments_number( $post_id ) > 0 ) {
			echo '<ul class="comment-list">';
			echo '<li>';
			echo '<div class="comment-section-title">' . esc_html__( 'Comment', 'tpebl' ) . ' (' . esc_html( get_comments_number( $post_id ) ) . ')</div>';
			echo '<li>';
			wp_list_comments( $list_args, $comment );
			echo '</ul>';
		}
				comment_form( $comment_args, $post_id );
				echo '</div>';
			echo '</div>';
		$output = ob_get_clean();

		echo $output;
	}

	/**
	 * Comment Args Post Comment
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function tp_comment_args() {
		$settings = $this->get_settings_for_display();

		$post_title      = ! empty( $settings['PostTitle'] ) ? $settings['PostTitle'] : '';
		$btn_title       = ! empty( $settings['BtnTitle'] ) ? $settings['BtnTitle'] : '';
		$placeholder_txt = ! empty( $settings['PlaceholderTxt'] ) ? $settings['PlaceholderTxt'] : '';
		$leave_txt       = ! empty( $settings['LeaveTxt'] ) ? $settings['LeaveTxt'] : '';
		$cancel_txt      = ! empty( $settings['CancelTxt'] ) ? $settings['CancelTxt'] : '';

		$user          = wp_get_current_user();
		$user_identity = $user->exists() ? $user->display_name : '';
		$args          = array(
			'id_form'              => 'commentform',
			'class_form'           => 'comment-form',
			'id_submit'            => 'submit',
			'title_reply'          => esc_html( $post_title ),
			// Translators: %s is replaced with the title of the post being replied to.
            'title_reply_to' => esc_html( $leave_txt ) . sprintf( esc_html__( 'Reply to %s', 'tpebl' ), esc_html( $post_title ) ),
			'cancel_reply_link'    => esc_html( $cancel_txt ),
			'label_submit'         => esc_html( $btn_title ),
			'comment_field'        => '<div class="tp-row"><div class="tp-col-md-12 tp-col"><label><textarea id="comment" name="comment" cols="45" rows="6" placeholder="' . esc_html( $placeholder_txt ) . '" aria-required="true"></textarea></label></div></div>',

			'must_log_in' => '<p class="must-log-in">' .
        sprintf(
        // Translators: %1$s is replaced with the opening <a> tag, and %2$s is replaced with the closing </a> tag.
        esc_html__( 'You must be %1$slogged in%2$s to post a comment.', 'tpebl' ),
        '<a href="' . esc_url( wp_login_url( apply_filters( 'the_permalink', get_permalink() ) ) ) . '">',
        '</a>'
    ) . '</p>',


	'logged_in_as' => '<p class="logged-in-as">' .
    sprintf(
        // Translators: %1$s is replaced with the user's display name, %2$s is replaced with the opening <a> tag for the user profile link, %3$s is replaced with the closing </a> tag for the user profile link, %4$s is replaced with the opening <a> tag for the logout link, and %5$s is replaced with the closing </a> tag for the logout link.
        esc_html__( 'Logged in as %1$s%2$s. %3$sLog out?%4$s', 'tpebl' ),
        $user_identity,
        '<a href="' . esc_url( admin_url( 'profile.php' ) ) . '">',
        '</a>',
        '<a href="' . esc_url( wp_logout_url( apply_filters( 'the_permalink', get_permalink() ) ) ) . '" title="' . esc_attr__( 'Log out of this account', 'tpebl' ) . '">',
        '</a>'
    ) . '</p>',

			'comment_notes_before' => '',
			'comment_notes_after'  => '',
		);
		return $args;
	}
}