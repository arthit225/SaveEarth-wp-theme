<?php

namespace Templately\Builder\Widgets;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Plugin;

class Post_Content extends Widget_Base {
	public function get_name() {
		return 'tl-post-content';
	}

	public function get_title() {
		return esc_html__( 'Post Content', 'templately' );
	}

	public function get_icon() {
		return 'eicon-post-content templately-widget-icon';
	}

	public function get_categories() {
		return [ 'theme-elements-single' ];
	}

	public function get_keywords() {
		return [ 'content', 'post content', 'page content' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content_style',
			[
				'label' => esc_html__( 'Content', 'templately' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_p_color',
			[
				'label'     => esc_html__( 'Text Color', 'templately' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_TEXT,
				],
				'selectors' => [
					'{{WRAPPER}} p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'typography',
				'global'   => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
				'selector' => '{{WRAPPER}} p',
			]
		);

		$this->end_controls_section();
	}

	protected function get_dynamic_post_ID() {
		$latest_cpt = get_posts( "post_type=post&numberposts=1" );

		return Plugin::$instance->editor->is_edit_mode() || isset( $_GET['preview_id'] ) || isset( $_GET['preview'] ) ? $latest_cpt[0]->ID : get_the_ID();
	}

	protected function render() {
		static $did_posts = [];
		static $level = 0;

		$post = get_post();

		// Avoid recursion
		if ( $post && isset( $did_posts[ $post->ID ] ) ) {
			return;
		}

		$level ++;
		$did_posts[ $post->ID ] = true;
		// End avoid recursion

		$is_edit_mode = Plugin::$instance->editor->is_edit_mode();
		if ( $is_edit_mode || isset( $_GET['preview_id'] ) || isset( $_GET['preview'] ) ) {
			echo get_the_content( null, null, $this->get_dynamic_post_ID() );

			return false;
		}

		// Set edit mode as false, so don't render settings and etc. use the $is_edit_mode to indicate if we need the CSS inline
		Plugin::$instance->editor->set_edit_mode( false );

		// Print manually (and don't use `the_content()`) because it's within another `the_content` filter, and the Elementor filter has been removed to avoid recursion.
		$content = Plugin::$instance->frontend->get_builder_content( $post->ID, false );

		Plugin::$instance->frontend->remove_content_filter();

		if ( empty( $content ) ) {
			// Split to pages.
			setup_postdata( $post );

			/** This filter is documented in wp-includes/post-template.php */
			// PHPCS - `get_the_content` is safe.
			echo apply_filters( 'the_content', get_the_content() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

			wp_link_pages( [
				'before'      => '<div class="page-links elementor-page-links"><span class="page-links-title elementor-page-links-title">' . esc_html__( 'Pages:', 'templately' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'templately' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			] );

			Plugin::$instance->frontend->add_content_filter();

			$level --;

			// Restore edit mode state
			Plugin::$instance->editor->set_edit_mode( $is_edit_mode );

			return;
		} else {
			Plugin::$instance->frontend->remove_content_filters();
			$content = apply_filters( 'the_content', $content );
			Plugin::$instance->frontend->restore_content_filters();
		}

		// Restore edit mode state
		Plugin::$instance->editor->set_edit_mode( $is_edit_mode );

		echo $content; // XSS ok.

		$level --;

		if ( 0 === $level ) {
			$did_posts = [];
		}
	}
}
