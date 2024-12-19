<?php
/**
 * Widget Name: Testimonial Carousel
 * Description: Different style of testimonial.
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
 * Class L_ThePlus_Testimonial_ListOut
 */
class L_ThePlus_Testimonial_ListOut extends Widget_Base {

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
		return 'tp-testimonial-listout';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Testimonial', 'tpebl' );
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
	 * Update is_reload_preview_required.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function is_reload_preview_required() {
		return true;
	}

	/**
	 * Get Docs Url.
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
					'style-2' => esc_html__( 'Style 2', 'tpebl' ),
					'style-3' => esc_html__( 'Style 3 (PRO)', 'tpebl' ),
					'style-4' => esc_html__( 'Style 4', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'layout',
			array(
				'label'   => esc_html__( 'Layout', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'carousel',
				'options' => array(
					'grid'     => esc_html__( 'Grid', 'tpebl' ),
					'masonry'  => esc_html__( 'Masonry', 'tpebl' ),
					'carousel' => esc_html__( 'Carousel', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_grid',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "show-testimonials-in-grid-layout-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> Learn How it works  <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'layout' => 'grid',
				),
			)
		);
		$this->add_control(
			'how_it_works_Masonry',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "show-testimonials-in-masonry-grid-layout-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> Learn How it works  <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'layout' => 'masonry',
				),
			)
		);
		$this->add_control(
			'how_it_works_carousel',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "add-a-testimonial-carousel-slider-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> Learn How it works  <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'layout' => 'carousel',
				),
			)
		);
		$this->add_control(
			'content_alignment_4',
			array(
				'label'       => esc_html__( 'Content Alignment', 'tpebl' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => array(
					'left'  => array(
						'title' => esc_html__( 'Left', 'tpebl' ),
						'icon'  => 'eicon-text-align-left',
					),
					'right' => array(
						'title' => esc_html__( 'Right', 'tpebl' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'     => 'left',
				'condition'   => array(
					'style' => 'style-4',
				),
				'label_block' => false,
				'toggle'      => true,
			)
		);
		$this->add_control(
			'tlContentFrom',
			array(
				'label'   => esc_html__( 'Select Source', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'tlcontent',
				'options' => array(
					'tlcontent'  => esc_html__( 'Post Type', 'tpebl' ),
					'tlrepeater' => esc_html__( 'Repeater', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_Post_Type',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "add-testimonials-with-custom-post-type-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> Learn How it works  <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'tlContentFrom' => 'tlcontent',
				),
			)
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'testiAuthor',
			array(
				'label'       => esc_html__( 'Testimonial Content', 'tpebl' ),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => '',
				'placeholder' => esc_html__( 'Enter Testimonial Content', 'tpebl' ),
				'dynamic'     => array( 'active' => true ),
			)
		);
		$repeater->add_control(
			'testiTitle',
			array(
				'label'       => esc_html__( 'Testimonial Title', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array( 'active' => true ),
				'default'     => '',
				'placeholder' => esc_html__( 'Enter Testimonial Title', 'tpebl' ),
			)
		);
		$repeater->add_control(
			'testiLabel',
			array(
				'label'       => esc_html__( 'Author Name', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array( 'active' => true ),
				'default'     => '',
				'placeholder' => esc_html__( 'Enter Author Name', 'tpebl' ),
			)
		);
		$repeater->add_control(
			'testiDesign',
			array(
				'label'       => esc_html__( 'Author Designation', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array( 'active' => true ),
				'default'     => '',
				'placeholder' => esc_html__( 'Enter Designation', 'tpebl' ),
			)
		);
		$repeater->add_control(
			'testiImage',
			array(
				'label'   => esc_html__( 'Author Image', 'tpebl' ),
				'type'    => Controls_Manager::MEDIA,
				'dynamic' => array( 'active' => true ),
			)
		);
		$repeater->add_control(
			'testiLogo',
			array(
				'label'   => esc_html__( 'Company Logo', 'tpebl' ),
				'type'    => Controls_Manager::MEDIA,
				'dynamic' => array( 'active' => true ),
			)
		);
		$repeater->add_control(
			'testiLogoNote',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => 'Note : This is just for style 4.',
				'content_classes' => 'tp-widget-description',
			)
		);
		$this->add_control(
			'testiAllList',
			array(
				'label'       => esc_html__( 'Manage Testimonials', 'tpebl' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'testiAuthor' => 'I have been using the software from XYZ Business for a few weeks now and it has exceeded my expectations. It is user-friendly, efficient, and the customer support team is always available to help. Highly recommend this software!',
						'testiTitle'  => 'Outstanding Support',
						'testiLabel'  => 'Emily Thompson',
						'testiDesign' => 'CEO of CodeCraft Inc.',
					),
					array(
						'testiAuthor' => 'I have been using the software from XYZ Business for a few weeks now and it has exceeded my expectations. It is user-friendly, efficient, and the customer support team is always available to help. Highly recommend this software!',
						'testiTitle'  => 'Improved Productivity',
						'testiLabel'  => 'Benjamin Reed',
						'testiDesign' => 'Founder of X Community',
					),
					array(
						'testiAuthor' => 'I have been using the software from XYZ Business for a few weeks now and it has exceeded my expectations. It is user-friendly, efficient, and the customer support team is always available to help. Highly recommend this software!',
						'testiTitle'  => 'Highly recommend',
						'testiLabel'  => 'Rachel Johnson',
						'testiDesign' => 'COO of AppFinity Solutions',
					),
				),
				'title_field' => '{{{ testiLabel }}}',
				'condition'   => array(
					'tlContentFrom' => 'tlrepeater',
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
					'style!' => array( 'style-1', 'style-2', 'style-4' ),
				),
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
					'{{WRAPPER}} .testimonial-list .post-inner-loop .grid-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'tlContentFrom!' => 'tlrepeater',
				),
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
			'content_extra_options_section',
			array(
				'label' => esc_html__( 'Extra Option', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'post_title_tag',
			array(
				'label'   => esc_html__( 'Title Tag', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => l_theplus_get_tags_options(),
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
					'display_thumbnail' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'caroByheight',
			array(
				'label'     => esc_html__( 'Content Limit By', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => array(
					''           => esc_html__( 'Default', 'tpebl' ),
					'height'     => esc_html__( 'Height', 'tpebl' ),
					'text-limit' => esc_html__( 'Text Limit', 'tpebl' ),
				),
				'condition' => array(
					'tlContentFrom' => array( 'tlrepeater' ),
					'layout'        => array( 'carousel' ),
				),
			)
		);
		$this->add_responsive_control(
			'contentHei',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => wp_kses_post( "Content Height(px) <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "set-elementor-testimonial-carousel-height/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'size_units'  => array( 'px' ),
				'default'     => array(
					'unit' => 'px',
					'size' => '',
				),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 500,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .testimonial-list .testimonial-list-content .entry-content' => 'height: {{SIZE}}{{UNIT}};overflow-y: auto; padding-right: 5px;',
				),
				'conditions'  => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'terms' => array(
								array(
									'name'     => 'layout',
									'operator' => '===',
									'value'    => 'grid',
								),
							),
						),
						array(
							'terms' => array(
								array(
									'name'     => 'layout',
									'operator' => '===',
									'value'    => 'carousel',
								),
								array(
									'name'     => 'caroByheight',
									'operator' => '===',
									'value'    => 'height',
								),
							),
						),
					),
				),
			)
		);
		$this->add_responsive_control(
			'titleHei',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Title Height(px)', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'default'     => array(
					'unit' => 'px',
					'size' => '',
				),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 500,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .testimonial-list .testimonial-list-content .testimonial-author-title' => 'height: {{SIZE}}{{UNIT}};overflow-y: auto; padding-right: 5px;',
				),
				'conditions'  => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'terms' => array(
								array(
									'name'     => 'layout',
									'operator' => '===',
									'value'    => 'grid',
								),
							),
						),
						array(
							'terms' => array(
								array(
									'name'     => 'layout',
									'operator' => '===',
									'value'    => 'carousel',
								),
								array(
									'name'     => 'caroByheight',
									'operator' => '===',
									'value'    => 'height',
								),
							),
						),
					),
				),
			)
		);
		$this->add_control(
			'cntscrollOn',
			array(
				'label'      => esc_html__( 'Content Scroll', 'tpebl' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'on-hover',
				'options'    => array(
					'on-hover' => esc_html__( 'On Hover', 'tpebl' ),
					'visible'  => esc_html__( 'Visible', 'tpebl' ),
				),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'terms' => array(
								array(
									'name'     => 'layout',
									'operator' => '===',
									'value'    => 'grid',
								),
							),
						),
						array(
							'terms' => array(
								array(
									'name'     => 'layout',
									'operator' => '===',
									'value'    => 'carousel',
								),
								array(
									'name'     => 'caroByheight',
									'operator' => '===',
									'value'    => 'height',
								),
							),
						),
					),
				),
			)
		);
		$this->add_control(
			'descByLimit',
			array(
				'label'      => wp_kses_post( "Excerpt Limit <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "limit-elementor-testimonial-carousel-by-text/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'default',
				'options'    => array(
					'default' => esc_html__( 'Default', 'tpebl' ),
					'letters' => esc_html__( 'By Letters', 'tpebl' ),
					'words'   => esc_html__( 'By Words', 'tpebl' ),
				),
				'condition'  => array(
					'tlContentFrom' => array( 'tlrepeater' ),
				),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'terms' => array(
								array(
									'name'     => 'layout',
									'operator' => '===',
									'value'    => 'masonry',
								),
							),
						),
						array(
							'terms' => array(
								array(
									'name'     => 'layout',
									'operator' => '===',
									'value'    => 'carousel',
								),
								array(
									'name'     => 'caroByheight',
									'operator' => '===',
									'value'    => 'text-limit',
								),
							),
						),
					),
				),
			)
		);
		$this->add_control(
			'descLimit',
			array(
				'label'      => esc_html__( 'Maximum Letters/Words', 'tpebl' ),
				'type'       => Controls_Manager::NUMBER,
				'min'        => 0,
				'max'        => 1000,
				'step'       => 1,
				'default'    => 30,
				'condition'  => array(
					'tlContentFrom' => array( 'tlrepeater' ),
				),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'terms' => array(
								array(
									'name'     => 'layout',
									'operator' => '===',
									'value'    => 'masonry',
								),
								array(
									'name'     => 'descByLimit',
									'operator' => '!==',
									'value'    => 'default',
								),
							),
						),
						array(
							'terms' => array(
								array(
									'name'     => 'layout',
									'operator' => '===',
									'value'    => 'carousel',
								),
								array(
									'name'     => 'caroByheight',
									'operator' => '===',
									'value'    => 'text-limit',
								),
								array(
									'name'     => 'descByLimit',
									'operator' => '!==',
									'value'    => 'default',
								),
							),
						),
					),
				),
			)
		);
		$this->add_control(
			'titleByLimit',
			array(
				'label'     => esc_html__( 'Title Limit', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'default',
				'options'   => array(
					'default' => esc_html__( 'Default', 'tpebl' ),
					'letters' => esc_html__( 'By Letters', 'tpebl' ),
					'words'   => esc_html__( 'By Words', 'tpebl' ),
				),
				'condition' => array(
					'layout'        => array( 'carousel' ),
					'tlContentFrom' => array( 'tlrepeater' ),
					'caroByheight'  => array( 'text-limit' ),
				),
			)
		);
		$this->add_control(
			'titleLimit',
			array(
				'label'     => esc_html__( 'Maximum Letters/Words', 'tpebl' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 1000,
				'step'      => 1,
				'default'   => 30,
				'condition' => array(
					'layout'        => array( 'carousel' ),
					'tlContentFrom' => array( 'tlrepeater' ),
					'caroByheight'  => array( 'text-limit' ),
					'titleByLimit!' => 'default',
				),
			)
		);
		$this->add_control(
			'redmorTxt',
			array(
				'label'       => esc_html__( 'Read More', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array( 'active' => true ),
				'separator'   => 'before',
				'default'     => esc_html__( 'Read More', 'tpebl' ),
				'placeholder' => esc_html__( 'Enter Read More', 'tpebl' ),
				'condition'   => array(
					'tlContentFrom' => array( 'tlrepeater' ),
					'layout'        => array( 'masonry', 'carousel' ),
					'caroByheight'  => array( 'text-limit' ),
				),
				'conditions'  => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'terms' => array(
								array(
									'name'     => 'descByLimit',
									'operator' => '!=',
									'value'    => 'default',
								),
							),
						),
						array(
							'terms' => array(
								array(
									'name'     => 'titleByLimit',
									'operator' => '!=',
									'value'    => 'default',
								),
							),
						),
					),
				),
			)
		);
		$this->add_control(
			'redlesTxt',
			array(
				'label'       => esc_html__( 'Read Less', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array( 'active' => true ),
				'default'     => esc_html__( 'Read Less', 'tpebl' ),
				'placeholder' => esc_html__( 'Enter Read Less', 'tpebl' ),
				'condition'   => array(
					'tlContentFrom' => array( 'tlrepeater' ),
					'layout'        => array( 'masonry', 'carousel' ),
					'caroByheight'  => array( 'text-limit' ),
				),
				'conditions'  => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'terms' => array(
								array(
									'name'     => 'descByLimit',
									'operator' => '!=',
									'value'    => 'default',
								),
							),
						),
						array(
							'terms' => array(
								array(
									'name'     => 'titleByLimit',
									'operator' => '!=',
									'value'    => 'default',
								),
							),
						),
					),
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
				'selector' => '{{WRAPPER}} .testimonial-list .post-content-image .post-title,{{WRAPPER}} .testimonial-list.testimonial-style-4 .post-title',
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
					'{{WRAPPER}} .testimonial-list .post-content-image .post-title,{{WRAPPER}} .testimonial-list.testimonial-style-4 .post-title' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .testimonial-list .testimonial-list-content:hover .post-title,{{WRAPPER}} .testimonial-list.testimonial-style-4 .testimonial-list-content:hover .post-title' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_extra_title_style',
			array(
				'label'     => esc_html__( 'Extra Title', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'style' => array( 'style-1', 'style-2', 'style-4' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'extra_title_typography',
				'label'    => esc_html__( 'Typography', 'tpebl' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .testimonial-list.testimonial-style-1 .testimonial-list-content .testimonial-author-title,{{WRAPPER}} .testimonial-list.testimonial-style-2 .testimonial-list-content .testimonial-author-title,{{WRAPPER}} .testimonial-list.testimonial-style-4 .testimonial-author-title',
			)
		);
		$this->start_controls_tabs( 'tabs_extra_title_style' );

		$this->start_controls_tab(
			'tab_extra_title_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'extra_title_color',
			array(
				'label'     => esc_html__( 'Extra Title Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .testimonial-list.testimonial-style-1 .testimonial-list-content .testimonial-author-title,{{WRAPPER}} .testimonial-list.testimonial-style-2 .testimonial-list-content .testimonial-author-title,{{WRAPPER}} .testimonial-list.testimonial-style-4 .testimonial-author-title' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_extra_title_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'extra_title_hover_color',
			array(
				'label'     => esc_html__( 'Extra Title Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .testimonial-list.testimonial-style-1 .testimonial-list-content:hover .testimonial-author-title,{{WRAPPER}} .testimonial-list.testimonial-style-2 .testimonial-list-content:hover .testimonial-author-title,{{WRAPPER}} .testimonial-list.testimonial-style-4 .testimonial-list-content:hover .testimonial-author-title' => 'color: {{VALUE}}',
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
					'style' => array( 'style-1', 'style-2', 'style-4' ),
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
				'selector' => '{{WRAPPER}} .testimonial-list.testimonial-style-1 .post-designation,{{WRAPPER}} .testimonial-list.testimonial-style-2 .post-designation,{{WRAPPER}} .testimonial-list.testimonial-style-4 .post-designation',
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
				'label'     => esc_html__( 'Designation Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .testimonial-list.testimonial-style-1 .post-designation,{{WRAPPER}} .testimonial-list.testimonial-style-2 .post-designation,{{WRAPPER}} .testimonial-list.testimonial-style-4 .post-designation' => 'color: {{VALUE}}',
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
			'designation_hover_color',
			array(
				'label'     => esc_html__( 'Designation Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .testimonial-list.testimonial-style-1 .testimonial-list-content:hover .post-designation,{{WRAPPER}} .testimonial-list.testimonial-style-2 .testimonial-list-content:hover .post-designation,{{WRAPPER}} .testimonial-list.testimonial-style-4 .testimonial-list-content:hover .post-designation' => 'color: {{VALUE}}',
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
					'style' => array( 'style-1', 'style-2', 'style-4' ),
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
				'selector' => '{{WRAPPER}} .testimonial-list .entry-content',
			)
		);
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
					'{{WRAPPER}} .testimonial-list .entry-content,{{WRAPPER}} .testimonial-list .entry-content p' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .testimonial-list .testimonial-list-content:hover .entry-content,{{WRAPPER}} .testimonial-list .testimonial-list-content:hover .entry-content p' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_bg_style',
			array(
				'label'     => esc_html__( 'Content Background', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'style' => array( 'style-1', 'style-2', 'style-4' ),
				),
			)
		);
		$this->add_responsive_control(
			'content_inner_padding',
			array(
				'label'      => esc_html__( 'Inner Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .testimonial-list.testimonial-style-1 .testimonial-content-text,{{WRAPPER}} .testimonial-list.testimonial-style-2 .testimonial-list-content,{{WRAPPER}} .testimonial-list.testimonial-style-4 .testimonial-list-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'content_bg_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .testimonial-list.testimonial-style-1 .testimonial-content-text,{{WRAPPER}} .testimonial-list.testimonial-style-2 .testimonial-list-content,{{WRAPPER}} .testimonial-list.testimonial-style-4 .testimonial-list-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			array(
				'name'     => 'border',
				'selector' => '{{WRAPPER}} .testimonial-list .testimonial-list-content',
			)
		);
		$this->add_responsive_control(
			'box_bg_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .testimonial-list .testimonial-list-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
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
				'selector' => '{{WRAPPER}} .testimonial-list.testimonial-style-1 .testimonial-content-text,{{WRAPPER}} .testimonial-list.testimonial-style-2 .testimonial-list-content,{{WRAPPER}} .testimonial-list.testimonial-style-4 .testimonial-list-content',
			)
		);
		$this->add_control(
			'down_arrow_color',
			array(
				'label'     => esc_html__( 'Down Arrow Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'separator' => 'before',
				'selectors' => array(
					'{{WRAPPER}} .testimonial-list.testimonial-style-1 .testimonial-content-text:after' => 'border-top-color: {{VALUE}}',
				),
				'condition' => array(
					'style' => 'style-1',
				),
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
				'selector' => '{{WRAPPER}} .testimonial-list.testimonial-style-1 .testimonial-list-content:hover .testimonial-content-text,{{WRAPPER}} .testimonial-list.testimonial-style-2 .testimonial-list-content:hover,{{WRAPPER}} .testimonial-list.testimonial-style-4 .testimonial-list-content:hover',
			)
		);
		$this->add_control(
			'down_arrow_hover_color',
			array(
				'label'     => esc_html__( 'Down Arrow Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'separator' => 'before',
				'selectors' => array(
					'{{WRAPPER}} .testimonial-list.testimonial-style-1 .testimonial-list-content:hover .testimonial-content-text:after' => 'border-top-color: {{VALUE}}',
				),
				'condition' => array(
					'style' => 'style-1',
				),
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
		$this->start_controls_tabs( 'tabs_content_shadow_style' );
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
				'selector' => '{{WRAPPER}} .testimonial-list.testimonial-style-1 .testimonial-list-content .testimonial-content-text,{{WRAPPER}} .testimonial-list.testimonial-style-2 .testimonial-list-content,{{WRAPPER}} .testimonial-list.testimonial-style-3 .testimonial-list-content,{{WRAPPER}} .testimonial-list.testimonial-style-4 .testimonial-list-content',
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
				'selector' => '{{WRAPPER}} .testimonial-list.testimonial-style-1 .testimonial-list-content:hover .testimonial-content-text,{{WRAPPER}} .testimonial-list.testimonial-style-2 .testimonial-list-content:hover,{{WRAPPER}} .testimonial-list.testimonial-style-3 .testimonial-list-content:hover,{{WRAPPER}} .testimonial-list.testimonial-style-4 .testimonial-list-content:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_readML_style',
			array(
				'label'      => esc_html__( 'Read More/Less', 'tpebl' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'condition'  => array(
					'tlContentFrom' => array( 'tlrepeater' ),
				),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'terms' => array(
								array(
									'name'     => 'layout',
									'operator' => '===',
									'value'    => 'masonry',
								),
								array(
									'name'     => 'descByLimit',
									'operator' => '!==',
									'value'    => 'default',
								),
							),
						),
						array(
							'terms' => array(
								array(
									'name'     => 'layout',
									'operator' => '===',
									'value'    => 'carousel',
								),
								array(
									'name'     => 'titleByLimit',
									'operator' => '!==',
									'value'    => 'default',
								),
							),
						),
					),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'readTypo',
				'label'    => esc_html__( 'Typography', 'tpebl' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .testimonial-list .testimonial-content-text .entry-content a.testi-readbtn,{{WRAPPER}} .testimonial-list .testimonial-content-text .entry-content a.testi-readbtn',
			)
		);
		$this->start_controls_tabs( 'tabs_readML_style' );
		$this->start_controls_tab(
			'tab_readML_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'readColor',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .testimonial-list .testimonial-list-content .entry-content a.testi-readbtn,{{WRAPPER}} .testimonial-list .testimonial-list-content .entry-content a.testi-readbtn' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_readML_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'readmhvrColor',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .testimonial-list .testimonial-list-content:hover .entry-content a.testi-readbtn,{{WRAPPER}} .testimonial-list .testimonial-list-content:hover .entry-content a.testi-readbtn' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'scroll_testi_section',
			array(
				'label'      => esc_html__( 'Scroll Bar', 'tpebl' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'terms' => array(
								array(
									'name'     => 'layout',
									'operator' => '===',
									'value'    => 'grid',
								),
							),
						),
						array(
							'terms' => array(
								array(
									'name'     => 'layout',
									'operator' => '===',
									'value'    => 'carousel',
								),
								array(
									'name'     => 'caroByheight',
									'operator' => '===',
									'value'    => 'height',
								),
							),
						),
					),
				),
			)
		);
		$this->start_controls_tabs( 'scroll_Tl_style' );
		$this->start_controls_tab(
			'scrollTl_Bar',
			array(
				'label' => esc_html__( 'Scrollbar', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'tesSclBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .testimonial-list-content .entry-content::-webkit-scrollbar,{{WRAPPER}} .testimonial-list-content .testimonial-author-title::-webkit-scrollbar',
			)
		);
		$this->add_responsive_control(
			'tesSclWidth',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Width', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .testimonial-list-content .entry-content::-webkit-scrollbar,{{WRAPPER}} .testimonial-list-content .testimonial-author-title::-webkit-scrollbar' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'scrollTl_Tmb',
			array(
				'label' => esc_html__( 'Thumb', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'tesThumbBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .testimonial-list-content .entry-content::-webkit-scrollbar-thumb,{{WRAPPER}} .testimonial-list-content .testimonial-author-title::-webkit-scrollbar-thumb',
			)
		);
		$this->add_responsive_control(
			'tesThumbBrs',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .testimonial-list-content .entry-content::-webkit-scrollbar-thumb,{{WRAPPER}} .testimonial-list-content .testimonial-author-title::-webkit-scrollbar-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'tesThumbBsw',
				'selector' => '{{WRAPPER}} .testimonial-list-content .entry-content::-webkit-scrollbar-thumb,{{WRAPPER}} .testimonial-list-content .testimonial-author-title::-webkit-scrollbar-thumb',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'scrollTl_Trk',
			array(
				'label' => esc_html__( 'Track', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'tesTrackBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .testimonial-list-content .entry-content::-webkit-scrollbar-track,{{WRAPPER}} .testimonial-list-content .testimonial-author-title::-webkit-scrollbar-track',
			)
		);
		$this->add_responsive_control(
			'tesTrackBRs',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .testimonial-list-content .entry-content::-webkit-scrollbar-track,{{WRAPPER}} .testimonial-list-content .testimonial-author-title::-webkit-scrollbar-track' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'tesTrackBsw',
				'selector' => '{{WRAPPER}} .testimonial-list-content .entry-content::-webkit-scrollbar-track,{{WRAPPER}} .testimonial-list-content .testimonial-author-title::-webkit-scrollbar-track',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_post_image_style',
			array(
				'label'     => esc_html__( 'Featured Image', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'style' => array( 'style-1', 'style-2', 'style-4' ),
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
					'{{WRAPPER}} .testimonial-list.testimonial-style-1 .testimonial-featured-image img,{{WRAPPER}} .testimonial-list.testimonial-style-2 .testimonial-featured-image img,{{WRAPPER}} .testimonial-list.testimonial-style-4 .testimonial-featured-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_carousel_options_styling',
			array(
				'label'     => esc_html__( 'Carousel Options', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'layout' => array( 'carousel' ),
				),
			)
		);
		$this->add_control(
			'slider_direction',
			array(
				'label'   => esc_html__( 'Slider Mode', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'horizontal',
				'options' => array(
					'horizontal' => esc_html__( 'Horizontal', 'tpebl' ),
					'vertical'   => esc_html__( 'Vertical (PRO)', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'carousel_direction',
			array(
				'label'   => esc_html__( 'Slide Direction', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'ltr',
				'options' => array(
					'rtl' => esc_html__( 'Right to Left', 'tpebl' ),
					'ltr' => esc_html__( 'Left to Right', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'slide_speed',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Slide Speed', 'tpebl' ),
				'size_units' => '',
				'range'      => array(
					'' => array(
						'min'  => 0,
						'max'  => 10000,
						'step' => 100,
					),
				),
				'default'    => array(
					'unit' => '',
					'size' => 1500,
				),
			)
		);

		$this->start_controls_tabs( 'tabs_carousel_style' );
		$this->start_controls_tab(
			'tab_carousel_desktop',
			array(
				'label' => esc_html__( 'Desktop', 'tpebl' ),
			)
		);
		$this->add_control(
			'slider_desktop_column',
			array(
				'label'   => esc_html__( 'Desktop Columns', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'options' => array(
					'1'  => esc_html__( 'Column 1', 'tpebl' ),
					'2'  => esc_html__( 'Column 2', 'tpebl' ),
					'3'  => esc_html__( 'Column 3', 'tpebl' ),
					'4'  => esc_html__( 'Column 4', 'tpebl' ),
					'5'  => esc_html__( 'Column 5', 'tpebl' ),
					'6'  => esc_html__( 'Column 6', 'tpebl' ),
					'7'  => esc_html__( 'Column 7', 'tpebl' ),
					'8'  => esc_html__( 'Column 8', 'tpebl' ),
					'9'  => esc_html__( 'Column 9', 'tpebl' ),
					'10' => esc_html__( 'Column 10', 'tpebl' ),
					'11' => esc_html__( 'Column 11', 'tpebl' ),
					'12' => esc_html__( 'Column 12', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'steps_slide',
			array(
				'label'     => esc_html__( 'Next Previous', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '1',
				'options'   => array(
					'1' => esc_html__( 'One Column', 'tpebl' ),
					'2' => esc_html__( 'All Visible Columns (PRO)', 'tpebl' ),
				),
				'separator' => 'after',
			)
		);
		$this->add_control(
			'steps_slide_Note',
			array(
				'type'        => Controls_Manager::RAW_HTML,
				'raw'         => '<p class="tp-controller-notice"><i>Select option of column scroll on previous or next in carousel.</i></p>',
				'label_block' => true,
			)
		);
		$this->add_responsive_control(
			'slider_padding',
			array(
				'label'      => esc_html__( 'Slide Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'default'    => array(
					'px' => array(
						'top'      => '',
						'right'    => '10',
						'bottom'   => '',
						'left'     => '10',
						'isLinked' => true,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .list-carousel-slick .slick-initialized .slick-slide' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'slider_draggable',
			array(
				'label'     => esc_html__( 'Draggable', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'tpebl' ),
				'label_off' => esc_html__( 'Off', 'tpebl' ),
				'default'   => 'yes',
			)
		);
		$this->add_control(
			'multi_drag',
			array(
				'label'     => esc_html__( 'Multi Drag', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'default'   => 'no',
				'condition' => array(
					'slider_draggable' => 'yes',
				),
			)
		);
		$this->add_control(
			'multi_drag_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'multi_drag' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'slider_infinite',
			array(
				'label'     => esc_html__( 'Infinite Mode', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'tpebl' ),
				'label_off' => esc_html__( 'Off', 'tpebl' ),
				'default'   => 'yes',
			)
		);
		$this->add_control(
			'slider_pause_hover',
			array(
				'label'     => esc_html__( 'Pause On Hover', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'tpebl' ),
				'label_off' => esc_html__( 'Off', 'tpebl' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'slider_pause_hover_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'slider_pause_hover' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'slider_adaptive_height',
			array(
				'label'     => esc_html__( 'Adaptive Height', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'tpebl' ),
				'label_off' => esc_html__( 'Off', 'tpebl' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'slider_animation',
			array(
				'label'   => esc_html__( 'Animation Type', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'ease',
				'options' => array(
					'ease'   => esc_html__( 'With Hold (Pro)', 'tpebl' ),
					'linear' => esc_html__( 'Continuous (Pro)', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'slider_autoplay',
			array(
				'label'     => esc_html__( 'Autoplay', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'tpebl' ),
				'label_off' => esc_html__( 'Off', 'tpebl' ),
				'default'   => 'yes',
			)
		);
		$this->add_control(
			'autoplay_speed',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Autoplay Speed', 'tpebl' ),
				'size_units' => '',
				'range'      => array(
					'' => array(
						'min'  => 500,
						'max'  => 10000,
						'step' => 200,
					),
				),
				'default'    => array(
					'unit' => '',
					'size' => 3000,
				),
				'condition'  => array(
					'slider_autoplay' => 'yes',
				),
			)
		);

		$this->add_control(
			'slider_dots',
			array(
				'label'     => esc_html__( 'Show Dots', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'tpebl' ),
				'label_off' => esc_html__( 'Off', 'tpebl' ),
				'default'   => 'yes',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'slider_dots_style',
			array(
				'label'     => esc_html__( 'Dots Style', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style-1',
				'options'   => array(
					'style-1' => esc_html__( 'Style 1', 'tpebl' ),
					'style-2' => esc_html__( 'Style 2 (PRO)', 'tpebl' ),
					'style-3' => esc_html__( 'Style 3 (PRO)', 'tpebl' ),
					'style-4' => esc_html__( 'Style 4 (PRO)', 'tpebl' ),
					'style-5' => esc_html__( 'Style 5 (PRO)', 'tpebl' ),
					'style-6' => esc_html__( 'Style 6 (PRO)', 'tpebl' ),
					'style-7' => esc_html__( 'Style 7 (PRO)', 'tpebl' ),
				),
				'condition' => array(
					'slider_dots' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'dots_border_color',
			array(
				'label'     => esc_html__( 'Dots Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .list-carousel-slick .slick-dots.style-1 li button' => '-webkit-box-shadow:inset 0 0 0 8px {{VALUE}};-moz-box-shadow: inset 0 0 0 8px {{VALUE}};box-shadow: inset 0 0 0 8px {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick .slick-dots.style-1 li.slick-active button' => '-webkit-box-shadow:inset 0 0 0 1px {{VALUE}};-moz-box-shadow: inset 0 0 0 1px {{VALUE}};box-shadow: inset 0 0 0 1px {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick .slick-dots.style-1 li button:before' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'slider_dots_style' => array( 'style-1', 'style-2', 'style-3', 'style-5' ),
					'slider_dots'       => 'yes',
				),
			)
		);
		$this->add_control(
			'slider_arrows',
			array(
				'label'     => esc_html__( 'Show Arrows', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'tpebl' ),
				'label_off' => esc_html__( 'Off', 'tpebl' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'slider_arrows_style',
			array(
				'label'     => esc_html__( 'Arrows Style', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style-2',
				'options'   => array(
					'style-1' => esc_html__( 'Style 1 (PRO)', 'tpebl' ),
					'style-2' => esc_html__( 'Style 2', 'tpebl' ),
					'style-3' => esc_html__( 'Style 3 (PRO)', 'tpebl' ),
					'style-4' => esc_html__( 'Style 4 (PRO)', 'tpebl' ),
					'style-5' => esc_html__( 'Style 5 (PRO)', 'tpebl' ),
					'style-6' => esc_html__( 'Style 6 (PRO)', 'tpebl' ),
				),
				'condition' => array(
					'slider_arrows' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'arrow_icon_color',
			array(
				'label'     => esc_html__( 'Arrow Icon Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => array(
					'{{WRAPPER}} .list-carousel-slick .slick-prev.style-2 .icon-wrap:before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-2 .icon-wrap:after,{{WRAPPER}} .list-carousel-slick .slick-next.style-2 .icon-wrap:before,{{WRAPPER}} .list-carousel-slick .slick-next.style-2 .icon-wrap:after' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'slider_arrows_style' => array( 'style-2' ),
					'slider_arrows'       => 'yes',
				),
			)
		);
		$this->add_control(
			'arrow_hover_bg_color',
			array(
				'label'     => esc_html__( 'Arrow Hover Background Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => array(
					'{{WRAPPER}} .list-carousel-slick .slick-prev.style-2:hover::before,{{WRAPPER}} .list-carousel-slick .slick-next.style-2:hover::before' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'slider_arrows_style' => array( 'style-2' ),
					'slider_arrows'       => 'yes',
				),
			)
		);
		$this->add_control(
			'arrow_hover_icon_color',
			array(
				'label'     => esc_html__( 'Arrow Hover Icon Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c44d48',
				'selectors' => array(
					'{{WRAPPER}} .list-carousel-slick .slick-prev.style-2:hover .icon-wrap::before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-2:hover .icon-wrap::after,{{WRAPPER}} .list-carousel-slick .slick-next.style-2:hover .icon-wrap::before,{{WRAPPER}} .list-carousel-slick .slick-next.style-2:hover .icon-wrap::after' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'slider_arrows_style' => array( 'style-2' ),
					'slider_arrows'       => 'yes',
				),
			)
		);
		$this->add_control(
			'arrow_y_space',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Position Y', 'tpebl' ),
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => -100,
						'max'  => 500,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => '%',
					'size' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .slick-nav' => 'top: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'slider_arrows' => 'yes',
				),
			)
		);
		$this->add_control(
			'slider_center_mode',
			array(
				'label'     => esc_html__( 'Center Mode', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'tpebl' ),
				'label_off' => esc_html__( 'Off', 'tpebl' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'slider_center_mode_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'slider_center_mode' => array( 'yes' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_carousel_tablet',
			array(
				'label' => esc_html__( 'Tablet', 'tpebl' ),
			)
		);
		$this->add_control(
			'tab_carousel_tablet_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_carousel_mobile',
			array(
				'label' => esc_html__( 'Mobile', 'tpebl' ),
			)
		);
		$this->add_control(
			'tab_carousel_mobile_options',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
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
	 * Register controls.
	 *
	 * @since 1.0.1
	 * @version 5.5.4
	 */
	protected function render() {
		$settings      = $this->get_settings_for_display();
		$query         = $this->get_query_args();
		$post_name     = l_theplus_testimonial_post_name();
		$taxonomy_name = $this->tpae_get_post_cat();

		$style          = ! empty( $settings['style'] ) ? $settings['style'] : '';
		$layout         = ! empty( $settings['layout'] ) ? $settings['layout'] : 'carousel';
		$post_title_tag = ! empty( $settings['post_title_tag'] ) ? $settings['post_title_tag'] : '';
		$post_category  = ! empty( $settings['post_category'] ) ? $settings['post_category'] : '';
		$con_from       = ! empty( $settings['tlContentFrom'] ) ? $settings['tlContentFrom'] : 'tlcontent';
		$testi_list     = ! empty( $settings['testiAllList'] ) ? $settings['testiAllList'] : array();

		$content_alignment_4 = ! empty( $settings['content_alignment_4'] ) ? 'content-' . $settings['content_alignment_4'] : '';

		$descby_limit  = ! empty( $settings['descByLimit'] ) ? $settings['descByLimit'] : 'default';
		$desc_limit    = ! empty( $settings['descLimit'] ) ? $settings['descLimit'] : 30;
		$cntscroll_on  = ! empty( $settings['cntscrollOn'] ) ? $settings['cntscrollOn'] : 'on-hover';
		$caro_byheight = ! empty( $settings['caroByheight'] ) ? $settings['caroByheight'] : '';

		$title_by_limit = ! empty( $settings['titleByLimit'] ) ? $settings['titleByLimit'] : 'default';
		$title_limit    = ! empty( $settings['titleLimit'] ) ? $settings['titleLimit'] : 30;

		$redmor_txt = ! empty( $settings['redmorTxt'] ) ? $settings['redmorTxt'] : '';
		$redles_txt = ! empty( $settings['redlesTxt'] ) ? $settings['redlesTxt'] : '';

		$animation_effects = ! empty( $settings['animation_effects'] ) ? $settings['animation_effects'] : '';
		$animation_delay   = ! empty( $settings['animation_delay']['size'] ) ? $settings['animation_delay']['size'] : 50;
		$ani_duration      = ! empty( $settings['animation_duration_default'] ) ? $settings['animation_duration_default'] : '';
		$animate_duration  = ! empty( $settings['animate_duration']['size'] ) ? $settings['animate_duration']['size'] : 50;
		$out_effect        = ! empty( $settings['animation_out_effects'] ) ? $settings['animation_out_effects'] : '';
		$out_delay         = ! empty( $settings['animation_out_delay']['size'] ) ? $settings['animation_out_delay']['size'] : 50;
		$out_duration      = ! empty( $settings['animation_out_duration_default'] ) ? $settings['animation_out_duration_default'] : '';
		$out_speed         = ! empty( $settings['animation_out_duration']['size'] ) ? $settings['animation_out_duration']['size'] : 50;

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

		$desktop_class = '';
		$tablet_class  = '';
		$mobile_class  = '';

		if ( 'carousel' !== $layout ) {
			$desktop_class = 'tp-col-lg-' . esc_attr( $settings['desktop_column'] );
			$tablet_class  = 'tp-col-md-' . esc_attr( $settings['tablet_column'] );
			$mobile_class  = 'tp-col-sm-' . esc_attr( $settings['mobile_column'] );
			$mobile_class .= ' tp-col-' . esc_attr( $settings['mobile_column'] );
		}

		$carousel_direction = '';
		$carousel_slider    = '';

		if ( 'carousel' === $layout ) {
			$carousel_direction = ! empty( $settings['carousel_direction'] ) ? esc_attr( tp_senitize_js_input( $settings['carousel_direction'] ) ) : 'ltr';

			if ( ! empty( $carousel_direction ) ) {
				$carousel_data   = array(
					'carousel_direction' => $carousel_direction,
				);
				$carousel_slider = 'data-result="' . htmlspecialchars( wp_json_encode( $carousel_data, true ), ENT_QUOTES, 'UTF-8' ) . '"';
			}
		}

		$layout_attr = '';
		$data_class  = '';

		if ( ! empty( $layout ) ) {
			if ( 'grid' !== $layout ) {
				$data_class  .= l_theplus_get_layout_list_class( $layout );
				$layout_attr .= l_theplus_get_layout_list_attr( $layout );
			} else {
				$data_class .= ' list-isotope';
			}
		} else {
				$data_class .= ' list-isotope';
		}

		$data_class = '';
		if ( 'carousel' === $layout ) {
			$data_class .= ' list-carousel-slick ';
		}
		$data_class .= ' testimonial-' . $style;

		$read_attr = array();
		$attr      = '';
		if ( 'masonry' === $layout || ( 'carousel' === $layout && 'text-limit' === $caro_byheight ) ) {

			$read_attr['readMore'] = $redmor_txt;
			$read_attr['readLess'] = $redles_txt;

			$read_attr = htmlspecialchars( wp_json_encode( $read_attr ), ENT_QUOTES, 'UTF-8' );

			$attr = 'data-readData = \'' . $read_attr . '\'';
		}

		$output    = '';
		$data_attr = '';

		$i   = 1;
		$uid = uniqid( 'post' );

		$data_attr .= ' data-id="' . esc_attr( $uid ) . '"';
		$data_attr .= ' data-style="' . esc_attr( $style ) . '"';
		if ( 'carousel' === $layout ) {
			$data_attr .= $this->get_carousel_options();
		}

		if ( 'tlrepeater' === $con_from ) {

			if ( ! empty( $testi_list ) ) {
				$index = 1;
				if ( 'style-1' === $style || 'style-2' === $style || 'style-4' === $style ) {
					$output     .= '<div id="theplus-testimonial-post-list" class="testimonial-list ' . esc_attr( $uid ) . ' ' . esc_attr( $data_class ) . ' ' . esc_attr( $animated_class ) . '" ' . $layout_attr . ' ' . $data_attr . ' ' . $animation_attr . ' ' . $carousel_slider . ' dir=' . esc_attr( $carousel_direction ) . ' data-enable-isotope="1">';
						$output .= '<div class="tp-row post-inner-loop ' . esc_attr( $uid ) . ' ' . esc_attr( $content_alignment_4 ) . '">';
					foreach ( $testi_list as $item ) {
						$testi_author   = ! empty( $item['testiAuthor'] ) ? $item['testiAuthor'] : '';
						$testi_title    = ! empty( $item['testiTitle'] ) ? $item['testiTitle'] : '';
						$testi_label    = ! empty( $item['testiLabel'] ) ? $item['testiLabel'] : '';
						$testi_design   = ! empty( $item['testiDesign'] ) ? $item['testiDesign'] : '';
						$testi_image_id = ! empty( $item['testiImage']['id'] ) ? $item['testiImage']['id'] : '';
						$testi_logo     = ! empty( $item['testiLogo']['url'] ) ? $item['testiLogo']['url'] : '';

						$output .= '<div class="grid-item ' . $desktop_class . ' ' . $tablet_class . ' ' . $mobile_class . '">';
						if ( ! empty( $style ) ) {
							ob_start();
							include L_THEPLUS_WSTYLES . 'testimonial/testimonial-' . sanitize_file_name( $style ) . '.php';
							$output .= ob_get_contents();
							ob_end_clean();
						}
							$output .= '</div>';
							++$index;
					}
						$output .= '</div>';
					$output     .= '</div>';
				} else {
					$output .= '<h3 class="theplus-posts-not-found">' . esc_html__( 'This Style Premium Version', 'tpebl' ) . '</h3>';
				}
			}
		} elseif ( ! $query->have_posts() ) {
				$output .= '<h3 class="theplus-posts-not-found">' . esc_html__( 'Posts not found', 'tpebl' ) . '</h3>';
		} elseif ( 'style-1' === $style || 'style-2' === $style || 'style-4' === $style ) {
			$output .= '<div id="theplus-testimonial-post-list" class="testimonial-list ' . esc_attr( $uid ) . ' ' . esc_attr( $data_class ) . ' ' . esc_attr( $animated_class ) . '" ' . $layout_attr . ' ' . $data_attr . ' ' . $animation_attr . ' ' . $carousel_slider . ' dir=' . esc_attr( $carousel_direction ) . ' data-enable-isotope="1">';

			$output .= '<div class="tp-row post-inner-loop ' . esc_attr( $uid ) . ' ' . esc_attr( $content_alignment_4 ) . '">';

			while ( $query->have_posts() ) {

				$query->the_post();
				$post = $query->post;

				$output .= '<div class="grid-item ' . $desktop_class . ' ' . $tablet_class . ' ' . $mobile_class . '">';

				if ( ! empty( $style ) ) {
					ob_start();
					include L_THEPLUS_WSTYLES . 'testimonial/testimonial-' . sanitize_file_name( $style ) . '.php';
					$output .= ob_get_contents();
					ob_end_clean();
				}

				$output .= '</div>';

				++$i;
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
	 * Widgets : Testimonial Listout
	 *
	 * Written Query Args
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	protected function get_query_args() {
		$settings      = $this->get_settings_for_display();
		$post_name     = l_theplus_testimonial_post_name();
		$taxonomy_name = $this->tpae_get_post_cat();
		$terms         = get_terms(
			array(
				'taxonomy'   => $taxonomy_name,
				'hide_empty' => true,
			)
		);

		$post_category = ! empty( $settings['post_category'] ) ? $settings['post_category'] : '';

		$category = array();
		if ( ! is_wp_error( $terms ) && ! empty( $terms ) && ! empty( $post_category ) ) {
			foreach ( $terms as $term ) {
				if ( in_array( $term->term_id, $post_category ) ) {
					$category[] = $term->slug;
				}
			}
		}

		$query_args = array(
			'post_type'           => $post_name,
			$taxonomy_name        => $category,
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

		global $paged;
		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
			$paged = get_query_var( 'page' );
		} else {
			$paged = 1;
		}

		$query_args['paged'] = $paged;

		$query = new \WP_Query( $query_args );

		return $query;
	}

	/**
	 * Render Testimonial Listout
	 *
	 * Written in PHP and HTML.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	protected function get_carousel_options() {
		$settings      = $this->get_settings_for_display();
		$data_slider   = '';
		$arrow_on      = ! empty( $settings['slider_arrows'] ) ? $settings['slider_arrows'] : '';
		$slider_on     = ! empty( $settings['slider_dots'] ) ? $settings['slider_dots'] : '';
		$autoplay      = ! empty( $settings['slider_autoplay'] ) ? $settings['slider_autoplay'] : '';
		$slider_height = ! empty( $settings['slider_adaptive_height'] ) ? $settings['slider_adaptive_height'] : '';
		$infinite_mode = ! empty( $settings['slider_infinite'] ) ? $settings['slider_infinite'] : '';
		$draggable_on  = ! empty( $settings['slider_draggable'] ) ? $settings['slider_draggable'] : '';

		$desktop_column = ! empty( $settings['slider_desktop_column'] ) ? $settings['slider_desktop_column'] : '1';

			$data_slider .= ' data-slide_speed="' . esc_attr( $settings['slide_speed']['size'] ) . '"';

			$data_slider .= ' data-slider_desktop_column="' . esc_attr( $desktop_column ) . '"';
			$data_slider .= ' data-steps_slide="1"';

			$slider_draggable = ( 'yes' === $draggable_on ) ? 'true' : 'false';
			$data_slider     .= ' data-slider_draggable="' . esc_attr( $slider_draggable ) . '"';
			$slider_infinite  = ( 'yes' === $infinite_mode ) ? 'true' : 'false';
			$data_slider     .= ' data-slider_infinite="' . esc_attr( $slider_infinite ) . '"';

			$slider_adaptive_height = ( 'yes' === $slider_height ) ? 'true' : 'false';

			$data_slider    .= ' data-slider_adaptive_height="' . esc_attr( $slider_adaptive_height ) . '"';
			$slider_autoplay = ( 'yes' === $autoplay ) ? 'true' : 'false';

			$data_slider .= ' data-slider_autoplay="' . esc_attr( $slider_autoplay ) . '"';
			$data_slider .= ' data-autoplay_speed="' . esc_attr( ! empty( $settings['autoplay_speed']['size'] ) ? $settings['autoplay_speed']['size'] : 3000 ) . '"';

			$slider_dots  = ( 'yes' === $slider_on ) ? 'true' : 'false';
			$data_slider .= ' data-slider_dots="' . esc_attr( $slider_dots ) . '"';
			$data_slider .= ' data-slider_dots_style="slick-dots ' . esc_attr( $settings['slider_dots_style'] ) . '"';

			$slider_arrows = ( 'yes' === $arrow_on ) ? 'true' : 'false';
			$data_slider  .= ' data-slider_arrows="' . esc_attr( $slider_arrows ) . '"';
			$data_slider  .= ' data-slider_arrows_style="' . esc_attr( $settings['slider_arrows_style'] ) . '" ';
			$data_slider  .= ' data-arrow_icon_color="' . esc_attr( $settings['arrow_icon_color'] ) . '" ';
			$data_slider  .= ' data-arrow_hover_bg_color="' . esc_attr( $settings['arrow_hover_bg_color'] ) . '" ';
			$data_slider  .= ' data-arrow_hover_icon_color="' . esc_attr( $settings['arrow_hover_icon_color'] ) . '" ';

		return $data_slider;
	}

	/**
	 * Get Testimonial-categories
	 *
	 * @since 5.6.9
	 */
	public function tpae_get_categories() {

		$testimonial = $this->tpae_get_post_cat();

		if ( ! empty( $testimonial ) ) {

			$categories = get_categories(
				array(
					'taxonomy'   => $testimonial,
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
	 * Get Testimonial-post
	 *
	 * @since 5.6.9
	 */
	public function tpae_get_post_cat() {
		$post_type_options = get_option( 'post_type_options' );
		$testi_post_type   = ! empty( $post_type_options['testimonial_post_type'] ) ? $post_type_options['testimonial_post_type'] : '';

		$taxonomy_name = 'theplus_testimonial_cat';

		if ( isset( $testi_post_type ) && ! empty( $testi_post_type ) ) {
			if ( 'themes' === $testi_post_type ) {
				$taxonomy_name = $this->tpae_get_options( 'testimonial_category_name' );
			} elseif ( 'plugin' === $testi_post_type ) {
				$get_name = $this->tpae_get_options( 'testimonial_category_plugin_name' );
				if ( isset( $get_name ) && ! empty( $get_name ) ) {
					$taxonomy_name = $this->tpae_get_options( 'testimonial_category_plugin_name' );
				}
			} elseif ( 'themes_pro' === $testi_post_type ) {
				$taxonomy_name = 'testimonial_category';
			}
		} else {
			$taxonomy_name = 'theplus_testimonial_cat';
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
