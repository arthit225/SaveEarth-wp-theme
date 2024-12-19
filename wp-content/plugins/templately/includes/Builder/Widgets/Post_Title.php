<?php

namespace Templately\Builder\Widgets;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Plugin;
use Elementor\Utils;
use Elementor\Widget_Base;

class Post_Title extends Widget_Base {

	public function get_name() {
		return 'tl-post-title';
	}

	public function get_title() {
		return esc_html__( 'Post Title', 'templately' );
	}

	public function get_icon() {
		return 'eicon-t-letter templately-widget-icon';
	}

	public function get_categories() {
		return [ 'theme-elements-single' ];
	}

	public function get_keywords() {
		return [ 'title', 'post title', 'page title', 'heading' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Heading', 'templately' ),
			]
		);

		$this->add_control(
			'html_tag',
			[
				'label'   => esc_html__( 'HTML Tag', 'templately' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'h1'   => 'H1',
					'h2'   => 'H2',
					'h3'   => 'H3',
					'h4'   => 'H4',
					'h5'   => 'H5',
					'h6'   => 'H6',
					'div'  => 'div',
					'span' => 'span',
					'p'    => 'p',
				],
				'default' => 'h2',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			[
				'label' => esc_html__( 'Heading', 'templately' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Text Color', 'templately' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .templately-heading-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'typography',
				'global'   => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .templately-heading-title',
			]
		);

		$this->end_controls_section();
	}

	protected function get_dynamic_post_ID() {
		$latest_cpt = get_posts( "post_type=post&numberposts=1" );

		return Plugin::$instance->editor->is_edit_mode() || isset( $_GET['preview_id'] ) || isset( $_GET['preview'] ) ? $latest_cpt[0]->ID : get_the_ID();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$title    = get_the_title( $this->get_dynamic_post_ID() );

		$this->add_render_attribute( 'title', 'class', 'templately-heading-title' );

		printf( '<%1$s %2$s>%3$s</%1$s>', Utils::validate_html_tag( $settings['html_tag'] ), $this->get_render_attribute_string( 'title' ), $title );
	}
}
