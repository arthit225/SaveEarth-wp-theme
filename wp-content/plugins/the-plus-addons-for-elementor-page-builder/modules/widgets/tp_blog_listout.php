<?php
/**
 * Widget Name: Blog Post Listing
 * Description: Different style of Blog Post listing layouts.
 * Author: Theplus
 * Author URI: https://posimyth.com
 *
 * @package ThePlus
 */

namespace TheplusAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class L_ThePlus_Blog_ListOut
 */
class L_ThePlus_Blog_ListOut extends Widget_Base {

	/**
	 * Document Link For Need help.
	 *
	 * @since 5.3.3
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
	 * @since 1.0.0
	 */
	public function get_name() {
		return 'tp-blog-listout';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 1.0.0
	 */
	public function get_title() {
		return esc_html__( 'Blog/Post Listing', 'tpebl' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'fa fa-newspaper-o theplus_backend_icon';
	}

	/**
	 * Get Widget categories.
	 *
	 * @since 1.0.0
	 */
	public function get_categories() {
		return array( 'plus-listing' );
	}

	/**
	 * Get Widget keywords.
	 *
	 * @since 1.0.0
	 */
	public function get_keywords() {
		return array( 'blog list', 'listing', 'bloglisting', 'theplus', 'Elementor blog' );
	}

	/**
	 * Get Docs Url.
	 *
	 * @since 1.0.0
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
	 * Register controls.
	 *
	 * @since 1.0.0
	 *
	 * @version 5.5.4
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
			'style',
			array(
				'label'   => esc_html__( 'Style', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => array(
					'style-1' => esc_html__( 'Style 1', 'tpebl' ),
					'style-2' => esc_html__( 'Style 2 (PRO)', 'tpebl' ),
					'style-3' => esc_html__( 'Style 3 (PRO)', 'tpebl' ),
					'style-4' => esc_html__( 'Style 4 (PRO)', 'tpebl' ),
					'smart-loop-builder' => esc_html__( 'Smart Loop Builder - Beta', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'smart_loop_builder_note_doc',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "create-custom-elementor-post-loop-skin-with-smart-loop-builder/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> Learn How it works  <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'style' => array( 'smart-loop-builder' ),
				),
			)
		);
		$this->add_control(
			'smart_loop_builder_note',
			array(
				'type'        => Controls_Manager::RAW_HTML,
				'raw'         => '<p class="tp-controller-notice"><i>Note : This is first version of Smart Loop Builder, We will have more dynamic options, ACF support and release in more listing widgets coming up next..</i></p>',
				'label_block' => true,
				'condition'   => array(
					'style' => array( 'smart-loop-builder' ),
				),
			)
		);
		$this->add_control(
			'style_pro_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'style!' => array( 'style-1','smart-loop-builder' ),
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
					'metro'    => esc_html__( 'Metro', 'tpebl' ),
					'carousel' => esc_html__( 'Carousel (PRO)', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_grid',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "show-blog-posts-in-grid-layout-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> Learn How it works  <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'layout' => 'grid',
				),
			)
		);
		$this->add_control(
			'how_it_works_Masonry',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "show-blog-posts-in-masonry-grid-layout-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> Learn How it works  <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'layout' => 'masonry',
				),
			)
		);
		$this->add_control(
			'how_it_works_Metro',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "show-blog-posts-in-metro-layout-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> Learn How it works  <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'layout' => 'metro',
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
		$this->end_controls_section();

		$this->start_controls_section(
			'smart_loop_builder_section',
			array(
				'label' => esc_html__( 'Smart Loop Builder (Beta)', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
				'condition'   => array(
					'style' => array( 'smart-loop-builder' ),
				),
			)
		);

		$this->add_control(
			'smart-loop-builder-button',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => '<a class="tp-preset-editor-raw" id="tp-preset-editor-raw" data-wd_type="tp-blog-listout">Ready Presets</a>',
				// 'content_classes' => 'tp-preset-editor-btn',
				'label_block'     => true,
			)
		);
		$this->add_control(
			'content_html',
			[
				'label' => esc_html__( 'HTML', 'tpebl' ),
				'type' => Controls_Manager::CODE,
				'language' => 'html',
				'separator' => 'before',
				'rows' => 10,
			]
		);
		$this->add_control(
			'content_css',
			[
				'label' => esc_html__( 'CSS', 'tpebl' ),
				'type' => Controls_Manager::CODE,
				'language' => 'css',
				'rows' => 10,
			]
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
					'layout!' => array( 'metro', 'carousel' ),
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
					'layout!' => array( 'metro', 'carousel' ),
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
					'layout!' => array( 'metro', 'carousel' ),
				),
			)
		);
		$this->add_control(
			'metro_column',
			array(
				'label'     => esc_html__( 'Metro Column', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '3',
				'options'   => array(
					'3' => esc_html__( 'Column 3', 'tpebl' ),
					'4' => esc_html__( 'Column 4 (PRO)', 'tpebl' ),
					'5' => esc_html__( 'Column 5 (PRO)', 'tpebl' ),
					'6' => esc_html__( 'Column 6 (PRO)', 'tpebl' ),
				),
				'condition' => array(
					'layout' => array( 'metro' ),
				),
			)
		);
		$this->add_control(
			'metro_style_3',
			array(
				'label'     => esc_html__( 'Metro Style', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style-1',
				'options'   => l_theplus_get_style_list( 1 ),
				'condition' => array(
					'metro_column' => '3',
					'layout'       => array( 'metro' ),
				),
			)
		);
		$this->add_control(
			'plus_pro_metro_column_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'metro_column!' => '3',
					'layout'        => array( 'metro' ),
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
					'{{WRAPPER}} .blog-list .post-inner-loop .grid-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'content_source_section',
			array(
				'label' => esc_html__( 'Content Source', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'post_category',
			array(
				'type'        => Controls_Manager::SELECT2,
				'label'       => esc_html__( 'Select Category', 'tpebl' ),
				'default'     => '',
				'label_block' => true,
				'multiple'    => true,
				'options'     => l_theplus_get_categories(),
			)
		);
		$this->add_control(
			'post_tags',
			array(
				'type'        => Controls_Manager::SELECT2,
				'label'       => esc_html__( 'Select Tags', 'tpebl' ),
				'default'     => '',
				'label_block' => true,
				'multiple'    => true,
				'options'     => l_theplus_get_tags(),
			)
		);
		$this->add_control(
			'display_posts',
			array(
				'label'   => esc_html__( 'Maximum Posts Display', 'tpebl' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 1,
				'max'     => 200,
				'step'    => 1,
				'default' => 8,
			)
		);
		$this->add_control(
			'post_offset',
			array(
				'label'   => wp_kses_post( "Offset Posts <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "hide-recent-blog-post-from-list-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 0,
				'max'     => 50,
				'step'    => 1,
				'default' => '',
			)
		);
		$this->add_control(
			'post_offset_Note',
			array(
				'type'        => Controls_Manager::RAW_HTML,
				'raw'         => '<p class="tp-controller-notice"><i>Note : Hide posts from the beginning of listing.</i></p>',
				'label_block' => true,
			)
		);
		$this->add_control(
			'post_order_by',
			array(
				'label'   => wp_kses_post( "Order By <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "show-recent-blog-posts-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
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
			'display_title_limit',
			array(
				'label'     => esc_html__( 'Title Limit', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'display_title_limit_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'display_title_limit' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'display_post_category',
			array(
				'label'     => esc_html__( 'Display Category Post', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'default'   => 'yes',
				'condition' => array(
					'style!' => array( 'style-1' ),
				),
			)
		);
		$this->add_control(
			'display_post_category_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'style!'                => array( 'style-1' ),
					'display_post_category' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'display_excerpt',
			array(
				'label'     => esc_html__( 'Display Excerpt/Content', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'default'   => 'yes',
			)
		);
		$this->add_control(
			'post_excerpt_count',
			array(
				'label'     => wp_kses_post( "Excerpt/Content Count <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "limit-post-excerpt-in-elementor-blog-posts/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 5,
				'max'       => 500,
				'step'      => 2,
				'default'   => 30,
				'separator' => 'after',
				'condition' => array(
					'display_excerpt' => 'yes',
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
			'display_post_meta',
			array(
				'label'     => esc_html__( 'Display Post Meta', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'default'   => 'yes',
			)
		);
		$this->add_control(
			'post_meta_tag_style',
			array(
				'label'     => esc_html__( 'Post Meta Tag', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style-1',
				'options'   => l_theplus_get_style_list( 1 ),
				'condition' => array(
					'display_post_meta' => 'yes',
				),
			)
		);
		$this->add_control(
			'filter_category',
			array(
				'label'     => wp_kses_post( "Category Wise Filter <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "add-category-wise-filter-in-blog-post-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
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
		$this->add_control(
			'post_extra_option',
			array(
				'label'     => esc_html__( 'More Post Loading Options', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'none',
				'options'   => array(
					'none'       => esc_html__( 'Select Options', 'tpebl' ),
					'pagination' => esc_html__( 'Pagination (PRO)', 'tpebl' ),
					'load_more'  => esc_html__( 'Load More', 'tpebl' ),
					'lazy_load'  => esc_html__( 'Lazy Load (PRO)', 'tpebl' ),
				),
				'condition' => array(
					'layout!' => array( 'carousel' ),
				),
			)
		);
		$this->add_control(
			'post_extra_pro_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'post_extra_option!' => array( 'none', 'load_more' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_load_more',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "add-read-more-button-in-blog-posts-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> Learn How it works  <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'post_extra_option' => array( 'load_more' ),
				),
			)
		);
		$this->add_control(
			'load_more_btn_text',
			array(
				'label'     => esc_html__( 'Button Text', 'tpebl' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'default'   => esc_html__( 'Load More', 'tpebl' ),
				'condition' => array(
					'layout!'           => array( 'carousel' ),
					'post_extra_option' => 'load_more',
				),
			)
		);
		$this->add_control(
			'tp_loading_text',
			array(
				'label'     => esc_html__( 'Loading Text', 'tpebl' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Loading...', 'tpebl' ),
				'condition' => array(
					'layout!'           => array( 'carousel' ),
					'post_extra_option' => array( 'load_more' ),
				),
			)
		);
		$this->add_control(
			'loaded_posts_text',
			array(
				'label'     => esc_html__( 'All Posts Loaded Text', 'tpebl' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'All done!', 'tpebl' ),
				'condition' => array(
					'layout!'           => array( 'carousel' ),
					'post_extra_option' => array( 'load_more' ),
				),
			)
		);
		$this->add_control(
			'load_more_post',
			array(
				'label'     => esc_html__( 'More posts on click/scroll', 'tpebl' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 30,
				'step'      => 1,
				'default'   => 4,
				'condition' => array(
					'layout!'           => array( 'carousel' ),
					'post_extra_option' => array( 'load_more' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'load_more_typography',
				'label'     => esc_html__( 'Load More Typography', 'tpebl' ),
				'global'    => array(
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .ajax_load_more .post-load-more',
				'condition' => array(
					'layout!'           => array( 'carousel' ),
					'post_extra_option' => 'load_more',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'loaded_posts_typo',
				'label'     => esc_html__( 'Loaded All Posts Typography', 'tpebl' ),
				'global'    => array(
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .plus-all-posts-loaded',
				'separator' => 'before',
				'condition' => array(
					'layout!'           => array( 'carousel' ),
					'post_extra_option' => array( 'load_more' ),
				),
			)
		);
		$this->add_control(
			'load_more_border',
			array(
				'label'     => esc_html__( 'Load More Border', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'default'   => 'no',
				'separator' => 'before',
				'condition' => array(
					'layout!'           => array( 'carousel' ),
					'post_extra_option' => 'load_more',
				),
			)
		);
		$this->add_control(
			'load_more_border_style',
			array(
				'label'     => esc_html__( 'Border Style', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'solid',
				'options'   => L_theplus_get_border_style(),
				'selectors' => array(
					'{{WRAPPER}} .ajax_load_more .post-load-more' => 'border-style: {{VALUE}};',
				),
				'condition' => array(
					'layout!'           => array( 'carousel' ),
					'post_extra_option' => 'load_more',
					'load_more_border'  => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'load_more_border_width',
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
					'{{WRAPPER}} .ajax_load_more .post-load-more' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'layout!'           => array( 'carousel' ),
					'post_extra_option' => 'load_more',
					'load_more_border'  => 'yes',
				),
			)
		);
		$this->start_controls_tabs(
			'tabs_load_more_border_style',
			array(
				'condition' => array(
					'layout!'           => array( 'carousel' ),
					'post_extra_option' => 'load_more',
					'load_more_border'  => 'yes',
				),
			)
		);
		$this->start_controls_tab(
			'tab_load_more_border_normal',
			array(
				'label'     => esc_html__( 'Normal', 'tpebl' ),
				'condition' => array(
					'layout!'           => array( 'carousel' ),
					'post_extra_option' => 'load_more',
					'load_more_border'  => 'yes',
				),
			)
		);
		$this->add_control(
			'load_more_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .ajax_load_more .post-load-more' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'layout!'           => array( 'carousel' ),
					'post_extra_option' => 'load_more',
					'load_more_border'  => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'load_more_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .ajax_load_more .post-load-more' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
				'condition'  => array(
					'layout!'           => array( 'carousel' ),
					'post_extra_option' => 'load_more',
					'load_more_border'  => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_load_more_border_hover',
			array(
				'label'     => esc_html__( 'Hover', 'tpebl' ),
				'condition' => array(
					'layout!'           => array( 'carousel' ),
					'post_extra_option' => 'load_more',
					'load_more_border'  => 'yes',
				),
			)
		);
		$this->add_control(
			'load_more_border_hover_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .ajax_load_more .post-load-more:hover' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'layout!'           => array( 'carousel' ),
					'post_extra_option' => 'load_more',
					'load_more_border'  => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'load_more_border_hover_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .ajax_load_more .post-load-more:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
				'condition'  => array(
					'layout!'           => array( 'carousel' ),
					'post_extra_option' => 'load_more',
					'load_more_border'  => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->start_controls_tabs(
			'tabs_load_more_style',
			array(
				'condition' => array(
					'layout!'           => array( 'carousel' ),
					'post_extra_option' => 'load_more',
				),
			)
		);
		$this->start_controls_tab(
			'tab_load_more_normal',
			array(
				'label'     => esc_html__( 'Normal', 'tpebl' ),
				'condition' => array(
					'layout!'           => array( 'carousel' ),
					'post_extra_option' => 'load_more',
				),
			)
		);
		$this->add_control(
			'load_more_color',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .ajax_load_more .post-load-more' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'layout!'           => array( 'carousel' ),
					'post_extra_option' => 'load_more',
				),
			)
		);
		$this->add_control(
			'loaded_posts_color',
			array(
				'label'     => esc_html__( 'Loaded Posts Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .plus-all-posts-loaded' => 'color: {{VALUE}}',
				),
				'separator' => 'after',
				'condition' => array(
					'layout!'           => array( 'carousel' ),
					'post_extra_option' => array( 'load_more', 'lazy_load' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'load_more_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .ajax_load_more .post-load-more',
				'condition' => array(
					'layout!'           => array( 'carousel' ),
					'post_extra_option' => 'load_more',
				),
			)
		);
		$this->add_control(
			'load_more_shadow_options',
			array(
				'label'     => esc_html__( 'Box Shadow Options', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'layout!'           => array( 'carousel' ),
					'post_extra_option' => 'load_more',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'load_more_shadow',
				'selector'  => '{{WRAPPER}} .ajax_load_more .post-load-more',
				'condition' => array(
					'layout!'           => array( 'carousel' ),
					'post_extra_option' => 'load_more',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_load_more_hover',
			array(
				'label'     => esc_html__( 'Hover', 'tpebl' ),
				'condition' => array(
					'layout!'           => array( 'carousel' ),
					'post_extra_option' => 'load_more',
				),
			)
		);
		$this->add_control(
			'load_more_color_hover',
			array(
				'label'     => esc_html__( 'Text Hover Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .ajax_load_more .post-load-more:hover' => 'color: {{VALUE}}',
				),
				'separator' => 'after',
				'condition' => array(
					'layout!'           => array( 'carousel' ),
					'post_extra_option' => 'load_more',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'load_more_hover_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .ajax_load_more .post-load-more:hover',
				'separator' => 'after',
				'condition' => array(
					'layout!'           => array( 'carousel' ),
					'post_extra_option' => 'load_more',
				),
			)
		);
		$this->add_control(
			'load_more_shadow_hover_options',
			array(
				'label'     => esc_html__( 'Hover Shadow Options', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'layout!'           => array( 'carousel' ),
					'post_extra_option' => 'load_more',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'load_more_hover_shadow',
				'selector'  => '{{WRAPPER}} .ajax_load_more .post-load-more:hover',
				'condition' => array(
					'layout!'           => array( 'carousel' ),
					'post_extra_option' => 'load_more',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_meta_tag_style',
			array(
				'label'     => esc_html__( 'Post Meta Tag', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'display_post_meta' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'meta_tag_typography',
				'label'    => esc_html__( 'Typography', 'tpebl' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .blog-list .post-inner-loop .post-meta-info span,
				               {{WRAPPER}} .blog-list .post-inner-loop .tpae-preset-meta-tag',
			)
		);
		$this->start_controls_tabs( 'tabs_post_meta_style' );
		$this->start_controls_tab(
			'tab_post_meta_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'post_meta_color',
			array(
				'label'     => esc_html__( 'Post Meta Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .blog-list .post-inner-loop .post-meta-info span,
					{{WRAPPER}} .blog-list .post-inner-loop .post-meta-info span a,
					{{WRAPPER}} .blog-list .post-inner-loop .tpae-preset-meta-tag' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_post_meta_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'post_meta_color_hover',
			array(
				'label'     => esc_html__( 'Post Meta Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .blog-list .post-inner-loop .blog-list-content:hover .post-meta-info span,
					{{WRAPPER}} .blog-list .post-inner-loop .blog-list-content:hover .post-meta-info span a,
					{{WRAPPER}} .blog-list .post-inner-loop .tpae-preset-meta-tag:hover' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_post_category_style',
			array(
				'label'     => esc_html__( 'Category Post', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'display_post_category' => 'yes',
					'style!'                => 'style-1',
				),
			)
		);
		$this->add_control(
			'section_post_category_style_options',
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
				'selector' => '{{WRAPPER}} .blog-list .post-inner-loop .post-title,
				              {{WRAPPER}} .blog-list .post-inner-loop .post-title a,
							  {{WRAPPER}} .blog-list .post-inner-loop .tpae-preset-title',
			)
		);
		$this->add_responsive_control(
			'title_margin',
			array(
				'label'      => esc_html__( 'Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .blog-list .post-inner-loop .post-title,
					{{WRAPPER}} .blog-list .post-inner-loop .tpae-preset-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			's_title_pg',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} #pt-plus-blog-post-list.blog-list.blog-style-1 .post-title, 
					{{WRAPPER}} #pt-plus-blog-post-list.blog-list.blog-style-2 .post-title, 
					{{WRAPPER}} .blog-list.blog-style-3 h3.post-title, 
					{{WRAPPER}} #pt-plus-blog-post-list.blog-list.blog-style-4 .post-title,
					{{WRAPPER}} .blog-list .post-inner-loop .tpae-preset-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
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
					'{{WRAPPER}} .blog-list .post-inner-loop .post-title,
					{{WRAPPER}} .blog-list .post-inner-loop .post-title a,
					{{WRAPPER}} .blog-list .post-inner-loop .tpae-preset-title' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .blog-list .post-inner-loop .blog-list-content:hover .post-title,
					{{WRAPPER}} .blog-list .post-inner-loop .blog-list-content:hover .post-title a,
					{{WRAPPER}} .blog-list .post-inner-loop .tpae-preset-title:hover' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_excerpt_style',
			array(
				'label'     => esc_html__( 'Excerpt/Content', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'display_excerpt' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'excerpt_typography',
				'label'    => esc_html__( 'Typography', 'tpebl' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .blog-list .post-inner-loop .entry-content,
				{{WRAPPER}} .blog-list .post-inner-loop .entry-content p,
				{{WRAPPER}} .blog-list .post-inner-loop .tpae-preset-description',
			)
		);
		/* Content Background Padding Start */
		$this->add_responsive_control(
			'excerpt_margin',
			array(
				'label'      => esc_html__( 'Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .blog-list .post-inner-loop .entry-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			's_excerpt_content_pg',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .blog-list .blog-list-content .entry-content p,
					{{WRAPPER}} .blog-list .post-inner-loop .tpae-preset-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		/* Content Background Padding End */
		$this->start_controls_tabs( 'tabs_excerpt_style' );
		$this->start_controls_tab(
			'tab_excerpt_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'excerpt_color',
			array(
				'label'     => esc_html__( 'Content Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .blog-list .post-inner-loop .entry-content,
					{{WRAPPER}} .blog-list .post-inner-loop .entry-content p,
					{{WRAPPER}} .blog-list .post-inner-loop .tpae-preset-description' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_excerpt_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'excerpt_hover_color',
			array(
				'label'     => esc_html__( 'Content Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .blog-list .post-inner-loop .blog-list-content:hover .entry-content,
					{{WRAPPER}} .blog-list .post-inner-loop .blog-list-content:hover .entry-content p,
					{{WRAPPER}} .blog-list .post-inner-loop .tpae-preset-description:hover' => 'color: {{VALUE}}',
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
				'name'     => 'contnet_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .blog-list.blog-style-1 .post-content-bottom,
				{{WRAPPER}} .blog-list .tpae-preset-content',
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
				'name'     => 'content_hover_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .blog-list.blog-style-1 .blog-list-content:hover .post-content-bottom,
				{{WRAPPER}} .blog-list .tpae-preset-content:hover',
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
				'condition' => array(
					'style!' => 'smart-loop-builder',
				),
			)
		);
		$this->add_control(
			'hover_image_style',
			array(
				'label'   => esc_html__( 'Image Hover Effect', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => l_theplus_get_style_list( 1, 'yes' ),
			)
		);
		$this->add_responsive_control(
			'featured_image_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .blog-list.blog-style-3 .blog-list-content,{{WRAPPER}} .blog-list.blog-style-3 .blog-featured-image,{{WRAPPER}} .blog-list.blog-style-2 .blog-featured-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
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
			'content_inner_padding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .blog-list .post-inner-loop .grid-item .blog-list-content,
					{{WRAPPER}} .blog-list .post-inner-loop .grid-item .tpae-preset-blog' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'style!' => array( 'style-1', 'style-4' ),
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
					'{{WRAPPER}} .blog-list .post-inner-loop .grid-item .blog-list-content,
					{{WRAPPER}} .blog-list .post-inner-loop .grid-item .tpae-preset-blog' => 'border-style: {{VALUE}};',
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
					'{{WRAPPER}} .blog-list .post-inner-loop .grid-item .blog-list-content,
					{{WRAPPER}} .blog-list .post-inner-loop .grid-item .tpae-preset-blog' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'label'     => esc_html__( 'Normal', 'tpebl' ),
				'condition' => array(
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
					'{{WRAPPER}} .blog-list .post-inner-loop .grid-item .blog-list-content,
					{{WRAPPER}} .blog-list .post-inner-loop .grid-item .tpae-preset-blog' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
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
		$this->add_responsive_control(
			'border_hover_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .blog-list .post-inner-loop .grid-item .blog-list-content:hover
					{{WRAPPER}} .blog-list .post-inner-loop .grid-item .tpae-preset-blog:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'box_border' => 'yes',
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
				'selector' => '{{WRAPPER}} .blog-list .post-inner-loop .grid-item .blog-list-content,
				{{WRAPPER}} .blog-list .post-inner-loop .grid-item .tpae-preset-blog',
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
				'selector' => '{{WRAPPER}} .blog-list .post-inner-loop .grid-item .blog-list-content:hover,
				{{WRAPPER}} .blog-list .post-inner-loop .grid-item .tpae-preset-blog:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'content_box_shadow_options',
			array(
				'label'     => esc_html__( 'Box Shadow Options', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->start_controls_tabs(
			'tabs_content_shadow_style',
			array()
		);
		$this->start_controls_tab(
			'tab_content_shadow_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'content_shadow',
				'selector' => '{{WRAPPER}} .blog-list.blog-style-1 .blog-list-content,
				{{WRAPPER}} .blog-list .post-inner-loop .grid-item .tpae-preset-blog',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_content_shadow_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'content_hover_shadow',
				'selector' => '{{WRAPPER}} .blog-list.blog-style-1 .blog-list-content:hover,
				{{WRAPPER}} .blog-list .post-inner-loop .grid-item .tpae-preset-blog:hover',
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
	 * Render Written in PHP and HTML.
	 *
	 * @since 1.0.0
	 * @version 5.5.4
	 */
	protected function render() {
		
		$settings   = $this->get_settings_for_display();
		$query_args = $this->get_query_args();
		$query      = new \WP_Query( $query_args );

		$style     = ! empty( $settings['style'] ) ? $settings['style'] : 'style-1';
		$layout    = ! empty( $settings['layout'] ) ? $settings['layout'] : 'grid';
		$post_tags = ! empty( $settings['post_tags'] ) ? $settings['post_tags'] : '';
		$content_html  = ! empty( $settings['content_html'] ) ? $settings['content_html'] : '';

		$post_title_tag = ! empty( $settings['post_title_tag'] ) ? $settings['post_title_tag'] : 'h3';
		$post_category  = ! empty( $settings['post_category'] ) ? $settings['post_category'] : '';

		$display_post_meta   = ! empty( $settings['display_post_meta'] ) ? $settings['display_post_meta'] : '';
		$post_meta_tag_style = ! empty( $settings['post_meta_tag_style'] ) ? $settings['post_meta_tag_style'] : 'style-1';

		$post_excerpt_count = ! empty( $settings['post_excerpt_count'] ) ? $settings['post_excerpt_count'] : 30;
		$animation_stagger  = ! empty( $settings['animation_stagger']['size'] ) ? $settings['animation_stagger']['size'] : 150;
		$ani_out_duration   = ! empty( $settings['animation_out_duration']['size'] ) ? $settings['animation_out_duration']['size'] : 50;

		$display_excerpt = ! empty( $settings['display_excerpt'] ) ? $settings['display_excerpt'] : '';
		$out_duration    = ! empty( $settings['animation_out_duration_default'] ) ? $settings['animation_out_duration_default'] : '';
		$metro_col       = ! empty( $settings['metro_column'] ) ? $settings['metro_column'] : '3';

		$ani_effect = ! empty( $settings['animation_effects'] ) ? $settings['animation_effects'] : 'no-animation';
		$ani_delay  = ! empty( $settings['animation_delay']['size'] ) ? $settings['animation_delay']['size'] : 50;
		$out_delay  = ! empty( $settings['animation_out_delay']['size'] ) ? $settings['animation_out_delay']['size'] : 50;

		$ani_list     = ! empty( $settings['animated_column_list'] ) ? $settings['animated_column_list'] : '';
		$ani_duration = ! empty( $settings['animation_duration_default'] ) ? $settings['animation_duration_default'] : '';
		$ani_speed    = ! empty( $settings['animate_duration']['size'] ) ? $settings['animate_duration']['size'] : 50;
		$out_effect   = ! empty( $settings['animation_out_effects'] ) ? $settings['animation_out_effects'] : 'no-animation';

		$animated_columns = '';

		if ( 'no-animation' === $ani_effect ) {
			$animated_class = '';
			$animation_attr = '';
		} else {
			$animate_offset  = '85%';
			$animated_class  = 'animate-general';
			$animation_attr  = ' data-animate-type="' . esc_attr( $ani_effect ) . '" data-animate-delay="' . esc_attr( $ani_delay ) . '"';
			$animation_attr .= ' data-animate-offset="' . esc_attr( $animate_offset ) . '"';

			if ( 'stagger' === $ani_list ) {
				$animated_columns = 'animated-columns';
				$animation_attr  .= ' data-animate-columns="stagger"';
				$animation_attr  .= ' data-animate-stagger="' . esc_attr( $animation_stagger ) . '"';
			} elseif ( 'columns' === $ani_list ) {
				$animated_columns = 'animated-columns';
				$animation_attr  .= ' data-animate-columns="columns"';
			}

			if ( 'yes' === $ani_duration ) {
				$animate_duration = $ani_speed;
				$animation_attr  .= ' data-animate-duration="' . esc_attr( $animate_duration ) . '"';
			}

			if ( 'no-animation' !== $out_effect ) {
				$animation_attr .= ' data-animate-out-type="' . esc_attr( $out_effect ) . '" data-animate-out-delay="' . esc_attr( $out_delay ) . '"';

				if ( 'yes' === $out_duration ) {
					$animation_attr .= ' data-animate-out-duration="' . esc_attr( $ani_out_duration ) . '"';
				}
			}
		}

		$desktop_class = '';
		$tablet_class  = '';
		$mobile_class  = '';

		if ( 'carousel' !== $layout && 'metro' !== $layout ) {
			$desktop_class = 'tp-col-lg-' . esc_attr( $settings['desktop_column'] );
			$tablet_class  = 'tp-col-md-' . esc_attr( $settings['tablet_column'] );
			$mobile_class  = 'tp-col-sm-' . esc_attr( $settings['mobile_column'] );
			$mobile_class .= ' tp-col-' . esc_attr( $settings['mobile_column'] );
		}

		$layout_attr = '';
		$data_class  = '';

		if ( ! empty( $layout ) ) {
			$data_class .= l_theplus_get_layout_list_class( $layout );
			$layout_attr = l_theplus_get_layout_list_attr( $layout );
		} else {
			$data_class .= ' list-isotope';
		}

		$metro_columns = $metro_col;
		$metro_style   = ! empty( $settings[ 'metro_style_' . $metro_columns ] ) ? $settings[ 'metro_style_' . $metro_columns ] : 'style-1';

		if ( 'metro' === $layout ) {

			$layout_attr .= ' data-metro-columns="' . esc_attr( $metro_columns ) . '" ';
			if ( ! empty( $metro_style ) ) {

				$layout_attr .= ' data-metro-style="' . esc_attr( $metro_style ) . '" ';
			}
		}

		$data_class .= ' blog-' . esc_attr( $style );
		$data_class .= ' hover-image-' . esc_attr( $settings['hover_image_style'] );

		$output    = '';
		$data_attr = '';

		$ji  = 1;
		$ij  = '';
		$uid = uniqid( 'post' );

		$data_attr .= ' data-id="' . esc_attr( $uid ) . '"';
		$data_attr .= ' data-style="' . esc_attr( $style ) . '"';

		$tablet_ij = '';

		if ( ! $query->have_posts() ) {
			$output .= '<h3 class="theplus-posts-not-found">' . esc_html__( 'Posts not found', 'tpebl' ) . '</h3>';
		} elseif ( 'style-1' === $style || 'smart-loop-builder' === $style) {

			if( 'smart-loop-builder' === $style ){
				$style_custom = !empty($settings['content_css']) ? $settings['content_css'] : '';
				$html_custom = !empty($settings['content_html']) ? $settings['content_html'] : '';

				if( !empty( $style_custom ) ){
					echo '<style>' . $style_custom . '</style>';
				}

				if ( empty( $html_custom ) ) {
					$output .= '<h3 class="theplus-posts-not-found">' . esc_html__( 'Please enter values in both HTML & CSS to enable the Smart Loop Builder feature. If you don’t want to write your own, choose from Ready Presets.', 'tpebl' ) . '</h3>';
				}
			}	
			
			$output .= '<div id="pt-plus-blog-post-list" class="blog-list ' . esc_attr( $uid ) . ' ' . $data_class . ' ' . esc_attr( $animated_class ) . '" ' . $layout_attr . ' ' . $data_attr . ' ' . $animation_attr . ' data-enable-isotope="1">';

			$output .= '<div id="' . esc_attr( $uid ) . '" class="tp-row post-inner-loop ' . esc_attr( $uid ) . ' ">';

			while ( $query->have_posts() ) {
				
				$query->the_post();
				$post = $query->post;

				if ( 'metro' === $layout ) {

					if ( ! empty( $metro_style ) ) {
						$ij = l_theplus_metro_style_layout( $ji, $metro_col, $metro_style );
					}
				}

				$output .= '<div class="grid-item metro-item' . esc_attr( $ij ) . ' ' . $desktop_class . ' ' . $tablet_class . ' ' . $mobile_class . ' ' . esc_attr( $animated_columns ) . '">';
				
				if ( ! empty( $style ) ) {
					ob_start();
					include L_THEPLUS_WSTYLES . 'blog/blog-' . sanitize_file_name( $style ) . '.php';
					$output .= ob_get_contents();
					ob_end_clean();
				}

				$output .= '</div>';

				++$ji;
			}

			$output .= '</div>';

			if ( ! empty( $post_category ) && is_array( $post_category ) ) {
				$post_category = implode( ',', $post_category );
			} else {
				$post_category = '';
			}

			if ( ! empty( $post_tags ) && is_array( $post_tags ) ) {
				$post_tags = implode( ',', $post_tags );
			} else {
				$post_tags = '';
			}

			if ( $query->found_posts != '' ) {
				$total_posts   = $query->found_posts;
				$post_offset   = ( $settings['post_offset'] != '' ) ? $settings['post_offset'] : 0;
				$display_posts = ( $settings['display_posts'] != '' ) ? $settings['display_posts'] : 0;
				$offset_posts  = intval( $display_posts + $post_offset );
				$total_posts   = intval( $total_posts - $offset_posts );
				if ( $total_posts != 0 && $settings['load_more_post'] != 0 ) {
					$load_page = ceil( intval($total_posts) / intval($settings['load_more_post']) );
				} else {
					$load_page = 1;
				}
				$load_page = $load_page + 1;
			} else {
				$load_page = 1;
			}

			$loaded_posts_text = ! empty( $settings['loaded_posts_text'] ) ? $settings['loaded_posts_text'] : 'All done!';
			$tp_loading_text   = ! empty( $settings['tp_loading_text'] ) ? $settings['tp_loading_text'] : 'Loading...';

			$data_loadkey = '';
			if ( ( $settings['post_extra_option'] == 'load_more' || $settings['post_extra_option'] == 'lazy_load' ) && $layout != 'carousel' ) {
				$postattr = array(
					'load'                => 'blogs',
					'post_type'           => 'post',
					'texonomy_category'   => 'cat',
					'post_title_tag'      => esc_attr( $post_title_tag ),
					'layout'              => esc_attr( $layout ),
					'style'               => esc_attr( $style ),
					'desktop-column'      => esc_attr( $settings['desktop_column'] ),
					'tablet-column'       => esc_attr( $settings['tablet_column'] ),
					'mobile-column'       => esc_attr( $settings['mobile_column'] ),
					'metro_column'        => esc_attr( $settings['metro_column'] ),
					'metro_style'         => esc_attr( $metro_style ),
					'offset-posts'        => esc_attr( $settings['post_offset'] ),
					'category'            => esc_attr( $post_category ),
					'post_tags'           => esc_attr( $post_tags ),
					'order_by'            => esc_attr( $settings['post_order_by'] ),
					'post_order'          => esc_attr( $settings['post_order'] ),
					'filter_category'     => esc_attr( $settings['filter_category'] ),
					'display_post'        => esc_attr( $settings['display_posts'] ),
					'animated_columns'    => esc_attr( $animated_columns ),
					'post_load_more'      => esc_attr( $settings['load_more_post'] ),
					'content_html'        => $content_html,

					'display_post_meta'   => $display_post_meta,
					'post_meta_tag_style' => $post_meta_tag_style,
					'theplus_nonce'       => wp_create_nonce( 'theplus-addons' ),
				);

				$postattr     = array_merge( $postattr );
				$data_loadkey = L_tp_plus_simple_decrypt( wp_json_encode( $postattr ), 'ey' );
			}

			if ( $settings['post_extra_option'] == 'load_more' && $layout != 'carousel' ) {
				if ( ! empty( $total_posts ) && $total_posts > 0 ) {
					$output     .= '<div class="ajax_load_more">';
						$output .= '<a class="post-load-more" data-layout="' . esc_attr( $layout ) . '" data-offset-posts="' . $settings['post_offset'] . '" data-load-class="' . esc_attr( $uid ) . '" data-display_post="' . esc_attr( $settings['display_posts'] ) . '" data-post_load_more="' . esc_attr( $settings['load_more_post'] ) . '" data-loaded_posts="' . esc_attr( $loaded_posts_text ) . '" data-tp_loading_text="' . esc_attr( $tp_loading_text ) . '" data-page="1" data-total_page="' . esc_attr( $load_page ) . '" data-loadattr= \'' . $data_loadkey . '\'>' . esc_html( $settings['load_more_btn_text'] ) . '</a>';
					$output     .= '</div>';
				}
			}

			$output .= '</div>';
		} else {
			$output .= '<h3 class="theplus-posts-not-found">' . esc_html__( 'This Style Premium Version', 'tpebl' ) . '</h3>';
		}

		echo $output;

		wp_reset_postdata();
	}

	/**
	 * Fetch post data Written in PHP and HTML.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	protected function get_query_args() {
		$settings  = $this->get_settings_for_display();
		$post_tags = ! empty( $settings['post_tags'] ) ? $settings['post_tags'] : '';

		$post_category = ! empty( $settings['post_category'] ) ? $settings['post_category'] : '';

		$query_args = array(
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			'posts_per_page'      => intval( $settings['display_posts'] ),
			'orderby'             => $settings['post_order_by'],
			'order'               => $settings['post_order'],
		);

		$offset = $settings['post_offset'];
		$offset = ! empty( $offset ) ? absint( $offset ) : 0;

		if ( $offset ) {
			$query_args['offset'] = $offset;
		}

		if ( ! empty( $post_category ) ) {
			$query_args['category__in'] = $post_category;
		}

		if ( ! empty( $post_tags ) ) {
			$query_args['tag__in'] = $post_tags;
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
}
