<?php

namespace Templately\Builder\Widgets;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Plugin;
use Elementor\Widget_Base;

class Featured_Image extends Widget_Base {

	public function get_name() {
		return 'tl-post-fatured-image';
	}

	public function get_title() {
		return esc_html__( 'Featured Image', 'templately' );
	}

	public function get_icon() {
		return 'eicon-featured-image templately-widget-icon';
	}

	public function get_categories() {
		return [ 'theme-elements-single' ];
	}

	public function get_keywords() {
		return [ 'featured image', 'image', 'featured' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Featured Image', 'templately' ),
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'    => 'image',
				'default' => 'full',
				'exclude' => [ 'custom' ]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_image_style',
			[
				'label' => esc_html__( 'Image', 'templately' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label'     => esc_html__( 'Alignment', 'templately' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => esc_html__( 'Left', 'templately' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'templately' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => esc_html__( 'Right', 'templately' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'width',
			[
				'label'          => esc_html__( 'Width', 'templately' ),
				'type'           => Controls_Manager::SLIDER,
				'default'        => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units'     => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'range'          => [
					'%'  => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors'      => [
					'{{WRAPPER}} img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'max-width',
			[
				'label'          => esc_html__( 'Max Width', 'templately' ),
				'type'           => Controls_Manager::SLIDER,
				'default'        => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units'     => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'range'          => [
					'%'  => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors'      => [
					'{{WRAPPER}} img' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'height',
			[
				'label'      => esc_html__( 'Height', 'templately' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'vh', 'custom' ],
				'range'      => [
					'px' => [
						'min' => 1,
						'max' => 500,
					],
					'vh' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'object-fit',
			[
				'label'     => esc_html__( 'Object Fit', 'templately' ),
				'type'      => Controls_Manager::SELECT,
				'condition' => [
					'height[size]!' => '',
				],
				'options'   => [
					''        => esc_html__( 'Default', 'templately' ),
					'fill'    => esc_html__( 'Fill', 'templately' ),
					'cover'   => esc_html__( 'Cover', 'templately' ),
					'contain' => esc_html__( 'Contain', 'templately' ),
				],
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} img' => 'object-fit: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'object-position',
			[
				'label'     => esc_html__( 'Object Position', 'templately' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'center center' => esc_html__( 'Center Center', 'templately' ),
					'center left'   => esc_html__( 'Center Left', 'templately' ),
					'center right'  => esc_html__( 'Center Right', 'templately' ),
					'top center'    => esc_html__( 'Top Center', 'templately' ),
					'top left'      => esc_html__( 'Top Left', 'templately' ),
					'top right'     => esc_html__( 'Top Right', 'templately' ),
					'bottom center' => esc_html__( 'Bottom Center', 'templately' ),
					'bottom left'   => esc_html__( 'Bottom Left', 'templately' ),
					'bottom right'  => esc_html__( 'Bottom Right', 'templately' ),
				],
				'default'   => 'center center',
				'selectors' => [
					'{{WRAPPER}} img' => 'object-position: {{VALUE}};',
				],
				'condition' => [
					'height[size]!' => '',
					'object-fit'    => 'cover',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'image_border',
				'selector'  => '{{WRAPPER}} img',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'templately' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'image_box_shadow',
				'exclude'  => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} img',
			]
		);

		$this->end_controls_section();
	}

	protected function get_dynamic_post_ID() {
		$latest_cpt = get_posts( "post_type=post&numberposts=1" );

		return Plugin::$instance->editor->is_edit_mode() || isset( $_GET['preview_id'] ) || isset( $_GET['preview'] ) ? $latest_cpt[0]->ID : get_the_ID();
	}

	protected function render() {
		$settings         = $this->get_settings_for_display();
		$size             = $settings['image_size'];
		$attachment_id    = get_post_thumbnail_id( $this->get_dynamic_post_ID() );
		$image_src        = wp_get_attachment_image_src( $attachment_id, $size );
		$image_src        = $image_src[0] ?? '';
		$image_title      = get_the_title( $attachment_id );
		$image_alt        = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ?? '';
		$image_class_html = "attachment-{$size} size-{$size} wp-image-{$attachment_id}";

		printf(
			'<img src="%1$s" title="%2$s" alt="%3$s" class="%4$s" loading="lazy" />',
			esc_url( $image_src ),
			esc_attr( $image_title ),
			esc_attr( $image_alt ),
			esc_attr( $image_class_html )
		);
	}
}
