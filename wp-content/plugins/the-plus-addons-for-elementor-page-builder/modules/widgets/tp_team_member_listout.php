<?php
/**
 * Widget Name: Team Member Listing
 * Description: Different style of Team Member taxonomy Post listing layouts.
 * Author: Theplus
 * Author URI: https://posimyth.com
 *
 * @package ThePlus
 */

namespace TheplusAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Css_Filter;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class L_ThePlus_Team_Member_ListOut
 */
class L_ThePlus_Team_Member_ListOut extends Widget_Base {

	/**
	 * Document Link For Need help.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
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
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_name() {
		return 'tp-team-member-listout';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Team Member Listing', 'tpebl' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-users theplus_backend_icon';
	}

	/**
	 * Get Widget categories.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_categories() {
		return array( 'plus-listing' );
	}

	/**
	 * Get Custom Url.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_custom_help_url() {
		$help_url = $this->tp_help;

		return esc_url( $help_url );
	}

	/**
	 * Update is_reload_preview_required.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function is_reload_preview_required() {
		return true;
	}

	/**
	 * Register Controls.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Content Layout', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'selctSource',
			array(
				'label'   => esc_html__( 'Select Source', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'post',
				'options' => array(
					'post'     => esc_html__( 'Post Type', 'tpebl' ),
					'repeater' => esc_html__( 'Repeater', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_Post_Type',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "create-elementor-team-members-section-with-custom-post-type/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> Learn How it works  <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'selctSource' => 'post',
				),
			)
		);
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'memberTitle',
			array(
				'label'       => esc_html__( 'Member Name', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
			)
		);
		$repeater->add_control(
			'tmImage',
			array(
				'label'   => esc_html__( 'Member Image', 'tpebl' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			)
		);
		$repeater->add_control(
			'designationTeam',
			array(
				'label'       => esc_html__( 'Designation', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Designation', 'tpebl' ),
			)
		);
		$repeater->add_control(
			'customUrl',
			array(
				'label'       => esc_html__( 'Single Page Url ', 'tpebl' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'tpebl' ),
				'options'     => array( 'url', 'is_external', 'nofollow' ),
				'default'     => array(
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				),
				'label_block' => true,
			)
		);
		$repeater->add_control(
			'websiteLink',
			array(
				'label'       => esc_html__( 'Website ', 'tpebl' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'tpebl' ),
				'options'     => array( 'url', 'is_external', 'nofollow' ),
				'default'     => array(
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				),
				'label_block' => true,
			)
		);
		$repeater->add_control(
			'fbLink',
			array(
				'label'       => esc_html__( 'Facebook ', 'tpebl' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'tpebl' ),
				'options'     => array( 'url', 'is_external', 'nofollow' ),
				'default'     => array(
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				),
				'label_block' => true,
			)
		);
		$repeater->add_control(
			'twitterLink',
			array(
				'label'       => esc_html__( 'Twitter ', 'tpebl' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'tpebl' ),
				'options'     => array( 'url', 'is_external', 'nofollow' ),
				'default'     => array(
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				),
				'label_block' => true,
			)
		);
		$repeater->add_control(
			'instaLink',
			array(
				'label'       => esc_html__( 'Instagram ', 'tpebl' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'tpebl' ),
				'options'     => array( 'url', 'is_external', 'nofollow' ),
				'default'     => array(
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				),
				'label_block' => true,
			)
		);
		$repeater->add_control(
			'gooogleLink',
			array(
				'label'       => esc_html__( 'Google ', 'tpebl' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'tpebl' ),
				'options'     => array( 'url', 'is_external', 'nofollow' ),
				'default'     => array(
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				),
				'label_block' => true,
			)
		);
		$repeater->add_control(
			'linkdinLink',
			array(
				'label'       => esc_html__( 'Linkedin ', 'tpebl' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'tpebl' ),
				'options'     => array( 'url', 'is_external', 'nofollow' ),
				'default'     => array(
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				),
				'label_block' => true,
			)
		);
		$repeater->add_control(
			'emailLink',
			array(
				'label'       => esc_html__( 'Email ', 'tpebl' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__( 'example@domain.com', 'tpebl' ),
				'options'     => array( 'url', 'is_external', 'nofollow' ),
				'default'     => array(
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				),
				'label_block' => true,
			)
		);
		$repeater->add_control(
			'phnLink',
			array(
				'label'       => esc_html__( 'Phone ', 'tpebl' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__( '+1 (xxx) xxx-xx-xx', 'tpebl' ),
				'options'     => array( 'url', 'is_external', 'nofollow' ),
				'default'     => array(
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				),
				'label_block' => true,
			)
		);
		$repeater->add_control(
			'clientCategory',
			array(
				'label'       => esc_html__( 'Category (For Filter)', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'e.g. Category1, Category2', 'tpebl' ),
				'title'       => 'you can add multiple with separated by comma.',
				'label_block' => true,
			)
		);
		$this->add_control(
			'tmList',
			array(
				'label'       => wp_kses_post( "Member List <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "add-category-wise-filter-in-team-member-grid-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'memberTitle' => esc_html__( 'Title #1', 'tpebl' ),
					),
				),
				'title_field' => '{{{ memberTitle }}}',
				'condition'   => array(
					'selctSource' => 'repeater',
				),
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
					'style-2' => esc_html__( 'Style 2 (PRO)', 'tpebl' ),
					'style-3' => esc_html__( 'Style 3', 'tpebl' ),
					'style-4' => esc_html__( 'Style 4 (PRO)', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'plus_pro_style_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'style!' => array( 'style-1', 'style-3' ),
				),
			)
		);
		$this->add_control(
			'layout',
			array(
				'label'   => esc_html__( 'Layout', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'grid',
				'options' => array(
					'grid'     => esc_html__( 'Grid', 'tpebl' ),
					'masonry'  => esc_html__( 'Masonry', 'tpebl' ),
					'carousel' => esc_html__( 'Carousel (PRO)', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_grid',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "show-team-members-in-grid-layout-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> Learn How it works  <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'layout' => 'grid',
				),
			)
		);
		$this->add_control(
			'how_it_works_Masonry',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "show-team-members-in-masonry-grid-layout-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> Learn How it works  <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'layout' => 'masonry',
				),
			)
		);
		$this->add_control(
			'layout_pro_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'layout' => 'carousel',
				),
			)
		);
		$this->add_responsive_control(
			'content_alignment',
			array(
				'label'       => esc_html__( 'Content Alignment', 'tpebl' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => array(
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
				'selectors'   => array(
					'{{WRAPPER}} .team-member-list .post-content-bottom' => 'text-align: {{VALUE}};',
				),
				'default'     => 'center',
				'label_block' => false,
				'toggle'      => true,
			)
		);
		$this->add_control(
			'disable_link',
			array(
				'label'     => esc_html__( 'Disable Link', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Disable', 'tpebl' ),
				'label_off' => esc_html__( 'Enable', 'tpebl' ),
				'default'   => '',
			)
		);
		$this->add_control(
			'disable_link_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'disable_link' => array( 'yes' ),
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'content_source_section',
			array(
				'label'     => esc_html__( 'Content Source', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'selctSource' => array( 'post' ),
				),
			)
		);
		$this->add_control(
			'post_category',
			array(
				'type'        => Controls_Manager::SELECT2,
				'label'       => esc_html__( 'Select Category', 'tpebl' ),
				'default'     => '',
				'multiple'    => true,
				'label_block' => true,
				'options'     => $this->tpae_get_categories(),
				'separator'   => 'before',
			)
		);
		$this->add_control(
			'display_posts',
			array(
				'label'     => esc_html__( 'Maximum Posts Display', 'tpebl' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 200,
				'step'      => 1,
				'default'   => 8,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'post_offset',
			array(
				'label'       => esc_html__( 'Offset Posts', 'tpebl' ),
				'type'        => Controls_Manager::NUMBER,
				'min'         => 0,
				'max'         => 50,
				'step'        => 1,
				'default'     => '',
				'description' => esc_html__( 'Hide posts from the beginning of listing.', 'tpebl' ),
			)
		);
		$this->add_control(
			'post_order_by',
			array(
				'label'   => esc_html__( 'Order By', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => l_theplus_orderby_arr(),
			)
		);
		$this->add_control(
			'post_order',
			array(
				'label'   => esc_html__( 'Order', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'DESC',
				'options' => l_theplus_order_arr(),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'columns_section',
			array(
				'label'     => esc_html__( 'Columns Manage', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'layout!' => array( 'carousel' ),
				),
			)
		);
		$this->add_control(
			'desktop_column',
			array(
				'label'     => esc_html__( 'Desktop Column', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '3',
				'options'   => l_theplus_get_columns_list(),
				'condition' => array(
					'layout!' => array( 'carousel' ),
				),
			)
		);
		$this->add_control(
			'tablet_column',
			array(
				'label'     => esc_html__( 'Tablet Column', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '4',
				'options'   => l_theplus_get_columns_list(),
				'condition' => array(
					'layout!' => array( 'carousel' ),
				),
			)
		);
		$this->add_control(
			'mobile_column',
			array(
				'label'     => esc_html__( 'Mobile Column', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '6',
				'options'   => l_theplus_get_columns_list(),
				'condition' => array(
					'layout!' => array( 'carousel' ),
				),
			)
		);
		$this->add_responsive_control(
			'columns_gap',
			array(
				'label'      => esc_html__( 'Columns Gap/Space Between', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'default'    => array(
					'top'    => '15',
					'right'  => '15',
					'bottom' => '15',
					'left'   => '15',
				),
				'separator'  => 'before',
				'condition'  => array(
					'layout!' => array( 'carousel' ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .team-member-list .post-inner-loop .grid-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'extra_option_section',
			array(
				'label' => esc_html__( 'Extra Options', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'post_title_tag',
			array(
				'label'     => esc_html__( 'Title Tag', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'h3',
				'options'   => l_theplus_get_tags_options(),
				'separator' => 'after',
			)
		);
		$this->add_control(
			'display_designation',
			array(
				'label'     => esc_html__( 'Display Designation', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'default'   => 'yes',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'display_social_icon',
			array(
				'label'     => esc_html__( 'Display Social Icon', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'default'   => 'yes',
				'separator' => 'before',
				'condition' => array(
					'style' => array( 'style-1', 'style-3', 'style-4' ),
				),
			)
		);
		$this->add_control(
			'display_thumbnail',
			array(
				'label'     => esc_html__( 'Display Image Size', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'default'   => 'no',
				'condition' => array(
					'layout!' => 'carousel',
				),
			)
		);
		$this->add_control(
			'display_thumbnail_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'layout!'           => 'carousel',
					'display_thumbnail' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'filter_category',
			array(
				'label'     => esc_html__( 'Category Wise Filter', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'default'   => 'no',
				'separator' => 'before',
				'condition' => array(
					'layout!' => 'carousel',
				),
			)
		);
		$this->add_control(
			'filter_category_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'layout!'         => 'carousel',
					'filter_category' => array( 'yes' ),
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			array(
				'label' => esc_html__( 'Title', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typography', 'tpebl' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .team-member-list .post-title,{{WRAPPER}} .team-member-list .post-title a',
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
			'title_color',
			array(
				'label'     => esc_html__( 'Title Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .team-member-list .post-title,{{WRAPPER}} .team-member-list .post-title a' => 'color: {{VALUE}}',
				),
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
			'title_hover_color',
			array(
				'label'     => esc_html__( 'Title Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .team-member-list .team-list-content:hover .post-title,{{WRAPPER}} .team-member-list .team-list-content:hover .post-title a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_designation_style',
			array(
				'label'     => esc_html__( 'Designation', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'display_designation' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'designation_typography',
				'label'    => esc_html__( 'Typography', 'tpebl' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .team-member-list .member-designation',
			)
		);
		$this->start_controls_tabs( 'tabs_designation_style' );
		$this->start_controls_tab(
			'tab_designation_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'designation_color',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .team-member-list .member-designation' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_designation_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'designation_color_hover',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .team-member-list .team-list-content:hover .member-designation' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_social_icon_style',
			array(
				'label'     => esc_html__( 'Social Icon', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'style'               => array( 'style-1', 'style-3' ),
					'display_social_icon' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'social_icon_size',
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
					'size' => '',
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .team-member-list .team-social-content .team-social-list li a i' => 'font-size: {{SIZE}}{{UNIT}}',
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
						'max'  => 250,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => '',
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .team-member-list.team-style-1 .team-social-content .team-social-list li a,{{WRAPPER}} .team-member-list.team-style-3 .team-social-content .team-social-list li a' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'social_icon_offset',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Offset', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => '',
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .team-member-list .team-social-content .team-social-list li a i' => 'transform: translateY({{SIZE}}{{UNIT}});',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_social_icon_style' );
		$this->start_controls_tab(
			'tab_social_icon_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'social_icon_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .team-member-list.team-style-1 .team-social-content .team-social-list li a,{{WRAPPER}} .team-member-list.team-style-3 .team-social-content .team-social-list li a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_social_icon_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'social_icon_color_hover',
			array(
				'label'     => esc_html__( 'Icon Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .team-member-list.team-style-1 .team-social-content .team-social-list li a:hover,{{WRAPPER}} .team-member-list.team-style-3 .team-social-content .team-social-list li a:hover' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'social_common_color_opt',
			array(
				'label'     => esc_html__( 'Social Icon Common Options', 'tpebl' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->start_controls_tabs( 'tabs_social_common_color_opt' );
		$this->start_controls_tab(
			'tab_scco_normal',
			array(
				'label'     => esc_html__( 'Normal', 'tpebl' ),
				'condition' => array(
					'social_common_color_opt' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'scco_n_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .team-member-list .team-social-content .team-social-list li a',
				'condition' => array(
					'social_common_color_opt' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'scco_n_border',
				'label'     => esc_html__( 'Border', 'tpebl' ),
				'selector'  => '{{WRAPPER}} .team-member-list .team-social-content .team-social-list li a',
				'separator' => 'before',
				'condition' => array(
					'social_common_color_opt' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'scco_n_br',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .team-member-list .team-social-content .team-social-list li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'social_common_color_opt' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'scco_n_shadow',
				'label'     => esc_html__( 'Box Shadow', 'tpebl' ),
				'selector'  => '{{WRAPPER}} .team-member-list .team-social-content .team-social-list li a',
				'separator' => 'before',
				'condition' => array(
					'social_common_color_opt' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_scco_hover',
			array(
				'label'     => esc_html__( 'Hover', 'tpebl' ),
				'condition' => array(
					'social_common_color_opt' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'scco_h_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .team-member-list .team-social-content .team-social-list li a:hover',
				'condition' => array(
					'social_common_color_opt' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'scco_h_border',
				'label'     => esc_html__( 'Border', 'tpebl' ),
				'selector'  => '{{WRAPPER}} .team-member-list .team-social-content .team-social-list li a:hover',
				'separator' => 'before',
				'condition' => array(
					'social_common_color_opt' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'scco_h_br',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .team-member-list .team-social-content .team-social-list li a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'social_common_color_opt' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'scco_h_shadow',
				'label'     => esc_html__( 'Box Shadow', 'tpebl' ),
				'selector'  => '{{WRAPPER}} .team-member-list .team-social-content .team-social-list li a:hover',
				'separator' => 'before',
				'condition' => array(
					'social_common_color_opt' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_post_image_style',
			array(
				'label' => esc_html__( 'Featured Image', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'featured_image_padding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .team-member-list .post-content-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'featured_image_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .team-member-list .team-profile img,{{WRAPPER}} .team-member-list .post-content-image,{{WRAPPER}} .team-member-list.team-style-2 .team-profile' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_image_shadow_style' );

		$this->start_controls_tab(
			'tab_image_shadow_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_responsive_control(
			'ImageOverlay',
			array(
				'label'     => esc_html__( 'Overlay Background Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .team-list-content .tp-image-overlay' => 'background: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'name'     => 'css_filters',
				'selector' => '{{WRAPPER}} .team-member-list .post-content-image img',

			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'image_shadow',
				'selector' => '{{WRAPPER}} .team-member-list .post-content-image',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_image_shadow_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_responsive_control(
			'ImageOverlayHover',
			array(
				'label'      => esc_html__( 'Overlay Hover Background Color', 'tpebl' ),
				'type'       => Controls_Manager::COLOR,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .team-list-content:hover .tp-image-overlay' => 'background: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'name'     => 'css_hover_filters',
				'selector' => '{{WRAPPER}} .team-member-list .team-list-content:hover .post-content-image img',

			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_filter_category_styling',
			array(
				'label'     => esc_html__( 'Filter Category', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'filter_category' => 'yes',
				),
			)
		);
		$this->add_control(
			'section_filter_category_styling_options',
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
			'section_box_loop_styling',
			array(
				'label' => esc_html__( 'Box Loop Background Style', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'content_bi_padding',
			array(
				'label'      => esc_html__( 'Content Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .team-member-list .post-content-bottom' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'content_inner_padding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .team-member-list .team-list-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'options'   => L_theplus_get_border_style(),
				'selectors' => array(
					'{{WRAPPER}} .team-member-list .team-list-content' => 'border-style: {{VALUE}};',
				),
				'condition' => array(
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
					'{{WRAPPER}} .team-member-list .team-list-content' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
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
		$this->add_responsive_control(
			'border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .team-member-list .team-list-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		$this->add_responsive_control(
			'border_hover_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .team-member-list .team-list-content:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
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
				'selector' => '{{WRAPPER}} .team-member-list .team-list-content',

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
				'name'     => 'box_active_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .team-member-list .team-list-content:hover',
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
				'selector' => '{{WRAPPER}} .team-member-list .team-list-content',
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
				'name'     => 'box_active_shadow',
				'selector' => '{{WRAPPER}} .team-member-list .team-list-content:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_carousel_options_styling',
			array(
				'label'     => esc_html__( 'Carousel Options', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'layout' => 'carousel',
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
			'section_extra_options_styling',
			array(
				'label' => esc_html__( 'Extra Options', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
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
					'messy_column' => array( 'yes' ),
				),
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
			'animated_column_list',
			array(
				'label'     => esc_html__( 'List Load Animation', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => array(
					''        => esc_html__( 'Content Animation Block', 'tpebl' ),
					'stagger' => esc_html__( 'Stagger Based Animation', 'tpebl' ),
					'columns' => esc_html__( 'Columns Based Animation', 'tpebl' ),
				),
				'condition' => array(
					'animation_effects!' => array( 'no-animation' ),
				),
			)
		);
		$this->add_control(
			'animation_stagger',
			array(
				'type'      => Controls_Manager::SLIDER,
				'label'     => esc_html__( 'Animation Stagger', 'tpebl' ),
				'default'   => array(
					'unit' => '',
					'size' => 150,
				),
				'range'     => array(
					'' => array(
						'min'  => 0,
						'max'  => 6000,
						'step' => 10,
					),
				),
				'condition' => array(
					'animation_effects!'   => array( 'no-animation' ),
					'animated_column_list' => 'stagger',
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
	 * Render Team-Member-Listout
	 *
	 * Written in PHP and HTML.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	protected function render() {
		$settings   = $this->get_settings_for_display();
		$query_args = $this->get_query_args();
		$query      = new \WP_Query( $query_args );
		$style      = ! empty( $settings['style'] ) ? $settings['style'] : 'style-1';
		$layout     = ! empty( $settings['layout'] ) ? $settings['layout'] : '';

		$team_name     = l_theplus_team_member_post_name();
		$team_taxonomy = $this->tpae_get_post_cat();

		$display_thumbnail = ! empty( $settings['display_thumbnail'] ) ? $settings['display_thumbnail'] : '';

		$post_title_tag = ! empty( $settings['post_title_tag'] ) ? $settings['post_title_tag'] : 'h3';
		$selct_source   = ! empty( $settings['selctSource'] ) ? $settings['selctSource'] : 'post';
		$tm_list        = ! empty( $settings['tmList'] ) ? $settings['tmList'] : array();

		$display_designation = ! empty( $settings['display_designation'] ) ? $settings['display_designation'] : '';
		$display_social_icon = ! empty( $settings['display_social_icon'] ) ? $settings['display_social_icon'] : '';

		$post_category = ! empty( $settings['post_category'] ) ? $settings['post_category'] : '';

		$content_alignment = ( '' !== $settings['content_alignment'] ) ? 'text-' . $settings['content_alignment'] : '';

		$animation_effects = ! empty( $settings['animation_effects'] ) ? $settings['animation_effects'] : '';
		$animate_duration  = ! empty( $settings['animate_duration']['size'] ) ? $settings['animate_duration']['size'] : 50;

		$animation_delay = ! empty( $settings['animation_delay']['size'] ) ? $settings['animation_delay']['size'] : 50;
		$ani_duration    = ! empty( $settings['animation_duration_default'] ) ? $settings['animation_duration_default'] : '';
		$out_effect      = ! empty( $settings['animation_out_effects'] ) ? $settings['animation_out_effects'] : '';
		$out_delay       = ! empty( $settings['animation_out_delay']['size'] ) ? $settings['animation_out_delay']['size'] : 50;
		$out_duration    = ! empty( $settings['animation_out_duration_default'] ) ? $settings['animation_out_duration_default'] : '';
		$out_speed       = ! empty( $settings['animation_out_duration']['size'] ) ? $settings['animation_out_duration']['size'] : 50;

		$animation_stagger = ! empty( $settings['animation_stagger']['size'] ) ? $settings['animation_stagger']['size'] : 150;

		$ani_col_l = ! empty( $settings['animated_column_list'] ) ? $settings['animated_column_list'] : '';

		$animated_columns = '';
		if ( 'no-animation' === $animation_effects ) {
			$animated_class = '';
			$animation_attr = '';
		} else {
			$animate_offset  = '85%';
			$animated_class  = 'animate-general';
			$animation_attr  = ' data-animate-type="' . esc_attr( $animation_effects ) . '" data-animate-delay="' . esc_attr( $animation_delay ) . '"';
			$animation_attr .= ' data-animate-offset="' . esc_attr( $animate_offset ) . '"';

			if ( 'stagger' === $ani_col_l ) {
				$animated_columns = 'animated-columns';
				$animation_attr  .= ' data-animate-columns="stagger"';
				$animation_attr  .= ' data-animate-stagger="' . esc_attr( $animation_stagger ) . '"';
			} elseif ( 'columns' === $ani_col_l ) {
				$animated_columns = 'animated-columns';
				$animation_attr  .= ' data-animate-columns="columns"';
			}

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

		$desktop_class = '';
		$tablet_class  = '';
		$mobile_class  = '';

		$desk_col   = ! empty( $settings['desktop_column'] ) ? $settings['desktop_column'] : '3';
		$tablet_col = ! empty( $settings['tablet_column'] ) ? $settings['tablet_column'] : '4';
		$mobile_col = ! empty( $settings['mobile_column'] ) ? $settings['mobile_column'] : '6';

		if ( 'metro' !== $layout ) {
			$desktop_class = 'tp-col-lg-' . esc_attr( $desk_col );
			$tablet_class  = 'tp-col-md-' . esc_attr( $tablet_col );
			$mobile_class  = 'tp-col-sm-' . esc_attr( $mobile_col );
			$mobile_class .= ' tp-col-' . esc_attr( $mobile_col );
		}

		$layout_attr = '';
		$data_class  = '';

		if ( ! empty( $layout ) ) {
			$data_class .= l_theplus_get_layout_list_class( $layout );
			$layout_attr = l_theplus_get_layout_list_attr( $layout );
		} else {
			$data_class .= ' list-isotope';
		}

		$data_class .= ' team-' . $style;

		$output    = '';
		$data_attr = '';

		$uid        = uniqid( 'post' );
		$data_attr .= ' data-id="' . esc_attr( $uid ) . '"';
		$data_attr .= ' data-style="' . esc_attr( $style ) . '"';

		$tp_row = '<div id="' . esc_attr( $uid ) . '" class="tp-row post-inner-loop ' . esc_attr( $uid ) . ' ' . esc_attr( $content_alignment ) . '">';

		if ( 'repeater' === $selct_source ) {

			if ( ! empty( $tm_list ) ) {
				$index   = 1;
				$output .= '<div id="theplus-team-member-list" class="team-member-list ' . esc_attr( $uid ) . ' ' . esc_attr( $data_class ) . ' ' . esc_attr( $animated_class ) . '" ' . $layout_attr . ' ' . $data_attr . ' ' . $animation_attr . ' data-enable-isotope="1">';
				$output .= $tp_row;
				foreach ( $tm_list as $item ) {
					$r_designation = ! empty( $item['designationTeam'] ) ? $item['designationTeam'] : '';
					$member_url    = ! empty( $item['customUrl']['url'] ) ? $item['customUrl']['url'] : '';

					$member_urlblank    = ! empty( $item['customUrl']['is_external'] ) ? '_blank' : '';
					$member_urlnofollow = ! empty( $item['customUrl']['nofollow'] ) ? 'nofollow' : '';

					$tm_title = ! empty( $item['memberTitle'] ) ? $item['memberTitle'] : '';
					$img_id   = ! empty( $item['tmImage']['id'] ) ? $item['tmImage']['id'] : '';

					$output .= '<div class="grid-item ' . $desktop_class . ' ' . $tablet_class . ' ' . $mobile_class . ' ' . esc_attr( $animated_columns ) . '">';

					$designation = '<div class="member-designation">' . wp_kses_post( $r_designation ) . '</div>';

					$team_social_contnet = $this->get_sociallinks( $item );

					if ( ! empty( $style ) ) {
						ob_start();
						include L_THEPLUS_WSTYLES . 'team-member/team-member-' . sanitize_file_name( $style ) . '.php';
						$output .= ob_get_contents();
						ob_end_clean();
					}

					$output .= '</div>';
					++$index;
				}
				$output .= '</div>';
				$output .= '</div>';
			}
		} elseif ( ! $query->have_posts() ) {
			$output .= '<h3 class="theplus-posts-not-found">' . esc_html__( 'Posts not found', 'tpebl' ) . '</h3>';
		} elseif ( 'style-1' === $style || 'style-3' === $style && 'carousel' !== $layout ) {

			$output .= '<div id="theplus-team-member-list" class="team-member-list ' . esc_attr( $uid ) . ' ' . esc_attr( $data_class ) . ' ' . $animated_class . '" ' . $layout_attr . ' ' . $data_attr . ' ' . $animation_attr . ' data-enable-isotope="1">';

			$member_urlblank    = '';
			$member_urlnofollow = '';

			$output .= $tp_row;

			while ( $query->have_posts() ) {
				$query->the_post();
				$post = $query->post;

				$designation = '';

				$designation_team = get_post_meta( get_the_ID(), 'theplus_tm_designation', true );

				if ( ! empty( $designation_team ) ) {
					$designation = '<div class="member-designation">' . esc_html( $designation_team ) . '</div>';
				}

				$team_social_contnet = $this->get_sociallinks( $query );

				$output .= '<div class="grid-item ' . $desktop_class . ' ' . $tablet_class . ' ' . $mobile_class . ' ' . esc_attr( $animated_columns ) . '">';

				if ( ! empty( $style ) ) {
					ob_start();
					include L_THEPLUS_WSTYLES . 'team-member/team-member-' . sanitize_file_name( $style ) . '.php';
					$output .= ob_get_contents();
					ob_end_clean();
				}

				$output .= '</div>';

			}

			$output .= '</div>';

			$output .= '</div>';
		} else {
			$output .= '<h3 class="theplus-posts-not-found">' . esc_html__( 'This Style Premium Version', 'tpebl' ) . '</h3>';
		}

		echo $output;

		wp_reset_postdata();
	}

	/**
	 * Get Query Args Team-Member-Listout
	 *
	 * @version 5.4.2
	 */
	protected function get_query_args() {
		$settings  = $this->get_settings_for_display();
		$team_name = l_theplus_team_member_post_name();

		$team_taxonomy = $this->tpae_get_post_cat();

		$terms = get_terms(
			array(
				'taxonomy'   => $team_taxonomy,
				'hide_empty' => true,
			)
		);

		$category      = array();
		$post_category = ! empty( $settings['post_category'] ) ? $settings['post_category'] : '';

		if ( null !== $terms && ! empty( $post_category ) ) {
			foreach ( $terms as $term ) {
				if ( in_array( $term->term_id, $post_category ) ) {
					$category[] = $term->slug;
				}
			}
		}

		$query_args = array(
			'post_type'           => $team_name,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			'posts_per_page'      => intval( $settings['display_posts'] ),
			'orderby'             => $settings['post_order_by'],
			'order'               => $settings['post_order'],
		);

		if ( null !== $terms && ! empty( $post_category ) ) {
			$query_args['tax_query'] = array(
				array(
					'taxonomy' => $team_taxonomy,
					'field'    => 'slug',
					'terms'    => $category,
				),
			);
		}

		$offset = $settings['post_offset'];
		$offset = ! empty( $offset ) ? absint( $offset ) : 0;

		if ( $offset ) {
			$query_args['offset'] = $offset;
		}

		global $paged;

		$paged_custom = 1;
		$paged_custom = $paged;

		if ( get_query_var( 'paged' ) ) {
			$paged_custom = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
			$paged_custom = get_query_var( 'page' );
		} else {
			$paged_custom = 1;
		}
		$query_args['paged'] = $paged_custom;

		return $query_args;
	}

	/**
	 * Get Social Link Team-Member-Listout
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 *
	 * @param Array $item include elementor repeter options.
	 */
	protected function get_sociallinks( $item ) {
		$settings     = $this->get_settings_for_display();
		$selct_source = ! empty( $settings['selctSource'] ) ? $settings['selctSource'] : 'post';

		$custom_url  = '';
		$website     = '';
		$google_link = '';
		$insta_link  = '';
		$twit_link   = '';
		$linked_link = '';
		$email_link  = '';
		$phone_link  = '';

		$facebook_link = '';

		$website_blank = '_blank';
		$fblink_blank  = '_blank';

		$google_link_blank = '_blank';
		$insta_link_blank  = '_blank';
		$twit_link_blank   = '_blank';
		$linked_link_blank = '_blank';
		$email_link_blank  = '_blank';
		$phone_link_blank  = '_blank';

		$website_nofollow     = '';
		$fb_link_nofollow     = '';
		$google_link_nofollow = '';
		$insta_link_nofollow  = '';
		$twit_link_nofollow   = '';
		$linked_link_nofollow = '';
		$email_link_nofollow  = '';
		$phone_link_nofollow  = '';

		if ( 'repeater' === $selct_source ) {
			$website          = ! empty( $item['websiteLink']['url'] ) ? $item['websiteLink']['url'] : '';
			$website_blank    = ! empty( $item['websiteLink']['is_external'] ) ? '_blank' : '';
			$website_nofollow = ! empty( $item['websiteLink']['nofollow'] ) ? 'nofollow' : '';

			$facebook_link    = ! empty( $item['fbLink']['url'] ) ? $item['fbLink']['url'] : '';
			$fblink_blank     = ! empty( $item['fbLink']['is_external'] ) ? '_blank' : '';
			$fb_link_nofollow = ! empty( $item['fbLink']['nofollow'] ) ? 'nofollow' : '';

			$google_link          = ! empty( $item['gooogleLink']['url'] ) ? $item['gooogleLink']['url'] : '';
			$google_link_blank    = ! empty( $item['gooogleLink']['is_external'] ) ? '_blank' : '';
			$google_link_nofollow = ! empty( $item['gooogleLink']['nofollow'] ) ? 'nofollow' : '';

			$insta_link          = ! empty( $item['instaLink']['url'] ) ? $item['instaLink']['url'] : '';
			$insta_link_blank    = ! empty( $item['instaLink']['is_external'] ) ? '_blank' : '';
			$insta_link_nofollow = ! empty( $item['instaLink']['nofollow'] ) ? 'nofollow' : '';

			$twit_link          = ! empty( $item['twitterLink']['url'] ) ? $item['twitterLink']['url'] : '';
			$twit_link_blank    = ! empty( $item['twitterLink']['is_external'] ) ? '_blank' : '';
			$twit_link_nofollow = ! empty( $item['twitterLink']['nofollow'] ) ? 'nofollow' : '';

			$linked_link          = ! empty( $item['linkdinLink']['url'] ) ? $item['linkdinLink']['url'] : '';
			$linked_link_blank    = ! empty( $item['linkdinLink']['is_external'] ) ? '_blank' : '';
			$linked_link_nofollow = ! empty( $item['linkdinLink']['nofollow'] ) ? 'relnofollow' : '';

			$email_link          = ! empty( $item['emailLink']['url'] ) ? $item['emailLink']['url'] : '';
			$email_link_blank    = ! empty( $item['emailLink']['is_external'] ) ? '_blank' : '';
			$email_link_nofollow = ! empty( $item['emailLink']['nofollow'] ) ? 'nofollow' : '';

			$phone_link          = ! empty( $item['phnLink']['url'] ) ? $item['phnLink']['url'] : '';
			$phone_link_blank    = ! empty( $item['phnLink']['is_external'] ) ? '_blank' : '';
			$phone_link_nofollow = ! empty( $item['phnLink']['nofollow'] ) ? 'nofollow' : '';
		} elseif ( 'post' === $selct_source ) {
			$website       = get_post_meta( get_the_ID(), 'theplus_tm_website_url', true );
			$facebook_link = get_post_meta( get_the_ID(), 'theplus_tm_face_link', true );
			$google_link   = get_post_meta( get_the_ID(), 'theplus_tm_googgle_link', true );
			$insta_link    = get_post_meta( get_the_ID(), 'theplus_tm_insta_link', true );
			$twit_link     = get_post_meta( get_the_ID(), 'theplus_tm_twit_link', true );
			$linked_link   = get_post_meta( get_the_ID(), 'theplus_tm_linked_link', true );
			$email_link    = get_post_meta( get_the_ID(), 'theplus_tm_email_link', true );
			$phone_link    = get_post_meta( get_the_ID(), 'theplus_tm_phone_link', true );
		}

		$team_social_contnet = '';
		if ( ! empty( $website ) || ! empty( $facebook_link ) || ! empty( $google_link ) || ! empty( $insta_link ) || ! empty( $twit_link ) || ! empty( $linked_link ) || ! empty( $email_link ) || ! empty( $phone_link ) ) {
			$team_social_contnet     .= '<div class="team-social-content">';
				$team_social_contnet .= '<ul class="team-social-list">';

			if ( ! empty( $website ) ) {
				$team_social_contnet .= '<li class="team-profile-link"><a rel="' . esc_attr( $website_nofollow ) . '" href="' . esc_url( $website ) . '" target="' . esc_attr( $website_blank ) . '"><i class="fa fa-globe" aria-hidden="true"></i></a>';
			}
			if ( ! empty( $facebook_link ) ) {
				$team_social_contnet .= '<li class="fb-link"><a rel="' . esc_attr( $fb_link_nofollow ) . '" href="' . esc_url( $facebook_link ) . '" target="' . esc_attr( $fblink_blank ) . '"><i class="fa fa-facebook" aria-hidden="true"></i></a>';
			}
			if ( ! empty( $twit_link ) ) {
				$team_social_contnet .= '<li class="twitter-link"><a rel="' . esc_attr( $twit_link_nofollow ) . '" href="' . esc_url( $twit_link ) . '" target="' . esc_attr( $twit_link_blank ) . '"><i class="fa fa-twitter" aria-hidden="true"></i></a>';
			}
			if ( ! empty( $insta_link ) ) {
				$team_social_contnet .= '<li class="instagram-link"><a rel="' . esc_attr( $insta_link_nofollow ) . '" href="' . esc_url( $insta_link ) . '" target="' . esc_attr( $insta_link_blank ) . '"><i class="fa fa-instagram" aria-hidden="true"></i></a>';
			}
			if ( ! empty( $google_link ) ) {
				$team_social_contnet .= '<li class="gplus-link"><a rel="' . esc_attr( $google_link_nofollow ) . '" href="' . esc_url( $google_link ) . '" target="' . esc_attr( $google_link_blank ) . '"><i class="fa fa-google-plus" aria-hidden="true"></i></a>';
			}
			if ( ! empty( $linked_link ) ) {
				$team_social_contnet .= '<li class="linkedin-link"><a rel="' . esc_attr( $linked_link_nofollow ) . '" href="' . esc_url( $linked_link ) . '" target="' . esc_attr( $linked_link_blank ) . '"><i class="fa fa-linkedin" aria-hidden="true"></i></a>';
			}
			if ( ! empty( $email_link ) ) {
				$team_social_contnet .= '<li class="team-profile-link"><a rel="' . esc_attr( $email_link_nofollow ) . '" href="mailto:' . esc_attr( $email_link ) . '" target="' . esc_attr( $email_link_blank ) . '"><i class="fa fa-envelope-o" aria-hidden="true"></i></a>';
			}
			if ( ! empty( $phone_link ) ) {
				$team_social_contnet .= '<li class="team-profile-link"><a rel="' . esc_attr( $phone_link_nofollow ) . '" href="tel:' . esc_attr( $phone_link ) . '" target="' . esc_attr( $phone_link_blank ) . '"><i class="fa fa-phone" aria-hidden="true"></i></a>';
			}

				$team_social_contnet .= '</ul>';
			$team_social_contnet     .= '</div>';
		}

		return $team_social_contnet;
	}

	/**
	 * Get Team-Member-categories
	 *
	 * @since 5.6.9
	 */
	public function tpae_get_categories() {

		$teams = $this->tpae_get_post_cat();

		if ( ! empty( $teams ) ) {
			$categories = get_categories(
				array(
					'taxonomy'   => $teams,
					'hide_empty' => 0,
				)
			);

			if ( empty( $categories ) || ! is_array( $categories ) ) {
				return array();
			}
		}

		return wp_list_pluck( $categories, 'name', 'term_id' );
	}

	/**
	 * Get Team-Member-post
	 *
	 * @since 5.6.9
	 */
	public function tpae_get_post_cat() {
		$post_type_options = get_option( 'post_type_options' );
		$team_post_type    = ! empty( $post_type_options['team_member_post_type'] ) ? $post_type_options['team_member_post_type'] : '';

		$taxonomy_name = 'theplus_team_member_cat';
		if ( isset( $team_post_type ) && ! empty( $team_post_type ) ) {
			if ( 'themes' === $team_post_type ) {
				$taxonomy_name = $this->tpae_get_options( 'team_member_category_name' );
			} elseif ( 'plugin' === $team_post_type ) {
				$get_name = $this->tpae_get_options( 'team_member_category_plugin_name' );
				if ( isset( $get_name ) && ! empty( $get_name ) ) {
					$taxonomy_name = $this->tpae_get_options( 'team_member_category_plugin_name' );
				}
			} elseif ( 'themes_pro' === $team_post_type ) {
				$taxonomy_name = 'team_member_category';
			}
		} else {
			$taxonomy_name = 'theplus_team_member_cat';
		}

		return $taxonomy_name;
	}

	/**
	 * Get tp options
	 *
	 * @since 5.6.9
	 *
	 * @param string $field use for get type.
	 */
	public function tpae_get_options( $field ) {

		$post_type_options = get_option( 'post_type_options' );

		if ( isset( $post_type_options[ $field ] ) && ! empty( $post_type_options[ $field ] ) ) {
			return $post_type_options[ $field ];
		}

		return '';
	}
}
