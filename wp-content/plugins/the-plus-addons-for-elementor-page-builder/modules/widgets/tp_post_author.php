<?php
/**
 * Widget Name: Post Author
 * Description: Post Author
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
 * Class L_ThePlus_Post_Author
 */
class L_ThePlus_Post_Author extends Widget_Base {

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
		return 'tp-post-author';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Post Author', 'tpebl' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-user theplus_backend_icon';
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
		return array( 'Post Author', 'Author', 'Author Box', 'Post Author Box', 'Author Details', 'Author Bio' );
	}

	/**
	 * Get Widget Custom Help Url.
	 *
	 * @since 1.0.1
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
				'label' => esc_html__( 'Post Author', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'style',
			array(
				'label'   => esc_html__( 'Style', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => array(
					'style-1' => esc_html__( 'Style 1', 'tpebl' ),
					'style-2' => esc_html__( 'Style 2', 'tpebl' ),
				),
			)
		);
		$this->add_responsive_control(
			'st2_width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Max Width', 'tpebl' ),
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
					'style' => 'style-2',
				),
				'selectors'   => array(
					'{{WRAPPER}} .tp-author-details.style-2' => 'max-width: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
			'st2_content_align',
			array(
				'label'     => esc_html__( 'Content Alignment', 'tpebl' ),
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
				'condition' => array(
					'style' => 'style-2',
				),
				'selectors' => array(
					'{{WRAPPER}} .tp-author-details.style-2 *' => 'text-align: {{VALUE}};',
				),
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'st2_align',
			array(
				'label'     => esc_html__( 'Box Alignment', 'tpebl' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'  => array(
						'title' => esc_html__( 'Left', 'tpebl' ),
						'icon'  => 'eicon-text-align-left',
					),
					'unset' => array(
						'title' => esc_html__( 'Center', 'tpebl' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right' => array(
						'title' => esc_html__( 'Right', 'tpebl' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => 'unset',
				'condition' => array(
					'style' => 'style-2',
				),
				'selectors' => array(
					'{{WRAPPER}} .tp-author-details.style-2' => 'float: {{VALUE}};',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_author_name_style',
			array(
				'label' => esc_html__( 'Author Name', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'ShowName',
			array(
				'label'     => esc_html__( 'Show Author Name', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'default'   => 'yes',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'nameTypo',
				'label'     => esc_html__( 'Typography', 'tpebl' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .tp-author-details .author-name',
				'condition' => array(
					'ShowName' => 'yes',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_author_style' );
		$this->start_controls_tab(
			'tab_author_normal',
			array(
				'label'     => esc_html__( 'Normal', 'tpebl' ),
				'condition' => array(
					'ShowName' => 'yes',
				),
			)
		);
		$this->add_control(
			'nameNormalColor',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-author-details .author-name' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'ShowName' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_author_hover',
			array(
				'label'     => esc_html__( 'Hover', 'tpebl' ),
				'condition' => array(
					'ShowName' => 'yes',
				),
			)
		);
		$this->add_control(
			'nameHoverColor',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-author-details:hover .author-name' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'ShowName' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_author_role_style',
			array(
				'label' => esc_html__( 'Author Role', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'ShowRole',
			array(
				'label'     => esc_html__( 'Show Author Role', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'default'   => 'yes',
			)
		);
		$this->add_control(
			'roleLabel',
			array(
				'label'       => esc_html__( 'Label', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array( 'active' => true ),
				'default'     => esc_html__( 'Role : ', 'tpebl' ),
				'placeholder' => esc_html__( 'Enter Label', 'tpebl' ),
				'condition'   => array(
					'ShowRole' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'roleTypo',
				'label'     => esc_html__( 'Typography', 'tpebl' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .tp-author-details .tp-author-role',
				'condition' => array(
					'ShowRole' => 'yes',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_author_role_style' );
		$this->start_controls_tab(
			'tab_author_role_normal',
			array(
				'label'     => esc_html__( 'Normal', 'tpebl' ),
				'condition' => array(
					'ShowRole' => 'yes',
				),
			)
		);
		$this->add_control(
			'roleNormalColor',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-author-details .tp-author-role' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'ShowRole' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_author_role_hover',
			array(
				'label'     => esc_html__( 'Hover', 'tpebl' ),
				'condition' => array(
					'ShowRole' => 'yes',
				),
			)
		);
		$this->add_control(
			'roleHoverColor',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-author-details:hover .tp-author-role' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'ShowRole' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_author_bio_style',
			array(
				'label' => esc_html__( 'Author Bio', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'ShowBio',
			array(
				'label'     => esc_html__( 'Show Bio', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'default'   => 'yes',
			)
		);
		$this->add_responsive_control(
			'bioMargin',
			array(
				'label'      => esc_html__( 'Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-author-details .author-bio' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'ShowBio' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'bioTypo',
				'label'     => esc_html__( 'Typography', 'tpebl' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .tp-author-details .author-bio',
				'condition' => array(
					'ShowBio' => 'yes',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_author_bio_style' );
		$this->start_controls_tab(
			'tab_author_bio_normal',
			array(
				'label'     => esc_html__( 'Normal', 'tpebl' ),
				'condition' => array(
					'ShowBio' => 'yes',
				),
			)
		);
		$this->add_control(
			'bioNormalColor',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-author-details .author-bio' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'ShowBio' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_author_bio_hover',
			array(
				'label'     => esc_html__( 'Hover', 'tpebl' ),
				'condition' => array(
					'ShowBio' => 'yes',
				),
			)
		);
		$this->add_control(
			'bioHoverColor',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-author-details:hover .author-bio' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'ShowBio' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_author_avtar_style',
			array(
				'label' => esc_html__( 'Author Avatar', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'ShowAvatar',
			array(
				'label'     => esc_html__( 'Show Avatar', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'default'   => 'yes',
			)
		);
		$this->add_responsive_control(
			'avatarWidth',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Avatar Width', 'tpebl' ),
				'size_units'  => array( 'px', 'em' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-author-details .author-avatar' => 'max-width: {{SIZE}}{{UNIT}};',
				),
				'separator'   => 'after',
				'condition'   => array(
					'ShowAvatar' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'avatarBorderRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-author-details .author-avatar,{{WRAPPER}} .tp-author-details .author-avatar img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'ShowAvatar' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'avatarBoxShadow',
				'selector'  => '{{WRAPPER}} .tp-author-details .author-avatar',
				'condition' => array(
					'ShowAvatar' => 'yes',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_social_links_style',
			array(
				'label' => esc_html__( 'Social Links', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'ShowSocial',
			array(
				'label'     => esc_html__( 'Show Social', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'default'   => 'yes',
			)
		);
		$this->add_responsive_control(
			'socialSize',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Social Size', 'tpebl' ),
				'size_units'  => array( 'px', 'em' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-author-details ul.author-social li a' => 'font-size: {{SIZE}}{{UNIT}};',
				),
				'separator'   => 'after',
				'condition'   => array(
					'ShowSocial' => 'yes',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_social_style' );
		$this->start_controls_tab(
			'tab_social_normal',
			array(
				'label'     => esc_html__( 'Normal', 'tpebl' ),
				'condition' => array(
					'ShowSocial' => 'yes',
				),
			)
		);
		$this->add_control(
			'socialNormalColor',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-author-details ul.author-social li a' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'ShowSocial' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_social_hover',
			array(
				'label'     => esc_html__( 'Hover', 'tpebl' ),
				'condition' => array(
					'ShowSocial' => 'yes',
				),
			)
		);
		$this->add_control(
			'socialHoverColor',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-author-details ul.author-social li a:hover' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'ShowSocial' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_bg_style',
			array(
				'label' => esc_html__( 'Content Background', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'padding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'default'    => array(
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-author-details' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->start_controls_tabs( 'tabs_content_bg_style' );
		$this->start_controls_tab(
			'tab_content_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'boxBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-author-details',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'boxBorder',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-author-details',
			)
		);
		$this->add_responsive_control(
			'boxBorderRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-author-details' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'boxBoxShadow',
				'selector' => '{{WRAPPER}} .tp-author-details',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_content_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'boxBgHover',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-author-details:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'boxBorderHover',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-author-details:hover',
			)
		);
		$this->add_responsive_control(
			'boxBorderRadiusHover',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-author-details:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'boxBoxShadowHover',
				'selector' => '{{WRAPPER}} .tp-author-details:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		
		include L_THEPLUS_PATH . 'modules/widgets/theplus-needhelp.php';
		include L_THEPLUS_PATH . 'modules/widgets/theplus-profeatures.php';
	}

	/**
	 * Post Auther Render.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		$post_id     = get_queried_object_id();
		$post        = get_queried_object();
		$style       = ! empty( $settings['style'] ) ? $settings['style'] : 'style-1';
		$show_name   = ! empty( $settings['ShowName'] ) ? $settings['ShowName'] : false;
		$show_role   = ! empty( $settings['ShowRole'] ) ? $settings['ShowRole'] : false;
		$show_bio    = ! empty( $settings['ShowBio'] ) ? $settings['ShowBio'] : false;
		$show_avatar = ! empty( $settings['ShowAvatar'] ) ? $settings['ShowAvatar'] : false;
		$show_social = ! empty( $settings['ShowSocial'] ) ? $settings['ShowSocial'] : false;

		$uid_psauthor = uniqid( 'tp-author' );

		$outputavatar = '';
		$outputname   = '';
		$outputrole   = '';
		$outputbio    = '';
		$authorsocial = '';

		if ( ! empty( $post ) ) {
			$author_page_url = get_author_posts_url( $post->post_author );
			$avatar_url      = get_avatar_url( $post->post_author );
			$author_bio      = get_the_author_meta( 'user_description', $post->post_author );
			if ( $show_name ) {
				$author_name = get_the_author_meta( 'display_name', $post->post_author );
				$outputname .= '<a href="' . esc_url( $author_page_url ) . '" class="author-name tp-author-trans" rel="' . esc_attr__( 'author', 'tpebl' ) . '" >' . $author_name . '</a>';
			}
			if ( ! empty( $show_role ) ) {
				global $authordata;
				$author_roles = $authordata->roles;
				$author_role  = array_shift( $author_roles );
				$outputrole  .= '<span class="tp-author-role">' . esc_html( $settings['roleLabel'] ) . $author_role . '</span>';
			}
			if ( ! empty( $show_avatar ) ) {
				$outputavatar .= '<a href="' . esc_url( $author_page_url ) . '" rel="' . esc_attr__( 'author', 'tpebl' ) . '" class="author-avatar tp-author-trans"><img src="' . esc_url( $avatar_url ) . '" /></a>';
			}
			if ( ! empty( $show_bio ) ) {
				$outputbio .= '<div class="author-bio tp-author-trans" >' . wp_kses_post( $author_bio ) . '</div>';
			}
			if ( ! empty( $show_social ) ) {
				$author_website   = get_the_author_meta( 'user_url', $post->post_author );
				$author_email     = get_the_author_meta( 'email', $post->post_author );
				$author_number    = get_the_author_meta( 'tp_phone_number', $post->post_author );
				$author_facebook  = get_the_author_meta( 'tp_profile_facebook', $post->post_author );
				$author_twitter   = get_the_author_meta( 'tp_profile_twitter', $post->post_author );
				$author_instagram = get_the_author_meta( 'tp_profile_instagram', $post->post_author );

				$authorsocial .= '<ul class="author-social">';
				if ( ! empty( $author_website ) ) {
					$authorsocial .= '<li><a href="' . esc_url( $author_website ) . '" rel="' . esc_attr__( 'website', 'tpebl' ) . '" target="_blank"><i class="fas fa-globe-americas"></i></a></li>';
				}
				if ( ! empty( $author_email ) ) {
					$authorsocial .= '<li><a href="mailto:' . esc_attr( $author_email ) . '" rel="' . esc_attr__( 'email', 'tpebl' ) . '"><i class="fas fa-envelope"></i></a></li>';
				}
				if ( ! empty( $author_number ) ) {
					$authorsocial .= '<li><a href="tel:' . esc_attr( $author_number ) . '" rel="' . esc_attr__( 'author_number', 'tpebl' ) . '"><i class="fas fa-phone-alt"></i></a></li>';
				}
				if ( ! empty( $author_facebook ) ) {
					$authorsocial .= '<li><a href="' . esc_url( $author_facebook ) . '" rel="' . esc_attr__( 'facebook', 'tpebl' ) . '" target="_blank"><i class="fab fa-facebook-f"></i></a></li>';
				}
				if ( ! empty( $author_twitter ) ) {
					$authorsocial .= '<li><a href="' . esc_url( $author_twitter ) . '" rel="' . esc_attr__( 'twitter', 'tpebl' ) . '" target="_blank"><i class="fab fa-twitter" ></i></a></li>';
				}
				if ( ! empty( $author_instagram ) ) {
					$authorsocial .= '<li><a href="' . esc_url( $author_instagram ) . '" rel="' . esc_attr__( 'instagram', 'tpebl' ) . '" target="_blank"><i class="fab fa-instagram"></i></a></li>';
				}
				$authorsocial .= '</ul>';
			}
		}
		$output      = '<div class="tp-post-author-info">';
			$ll_bg   = tp_bg_lazyLoad( $settings['boxBg_image'], $settings['boxBgHover_image'] );
			$output .= '<div class="tp-author-details ' . esc_attr( $style ) . ' ' . $ll_bg . '">';
		if ( ! empty( $show_avatar ) ) {
			$output .= $outputavatar;
		}
		$output .= '<div class="author-info">';
		if ( ! empty( $show_name ) ) {
			$output .= $outputname;
		}
		if ( ! empty( $show_role ) ) {
			$output .= $outputrole;
		}
		if ( ! empty( $show_bio ) ) {
			$output .= $outputbio;
		}
		if ( ! empty( $show_social ) ) {
			$output .= $authorsocial;
		}
				$output .= '</div>';
			$output     .= '</div>';
		$output         .= '</div>';
		echo $output;
	}
}
