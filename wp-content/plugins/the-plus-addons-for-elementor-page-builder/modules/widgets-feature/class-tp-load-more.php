<?php
/**
 * The file that defines the core plugin class
 *
 * @link       https://posimyth.com/
 * @since      5.6.7
 *
 * @package    the-plus-addons-for-elementor-page-builder
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Tp_load_more' ) ) {

	/**
	 * Tp_load_more
	 *
	 * @since 5.6.7
	 */
	class Tp_load_more {

		/**
		 * Member Variable
		 *
		 * @var instance
		 */
		private static $instance;

		/**
		 *  Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Define the core functionality of the plugin.
		 *
		 * @since 5.6.7
		 */
		public function __construct() {
			$this->tp_check_elements();
		}

		/**
		 * Check extra options switcher
		 *
		 * @since 5.6.7
		 */
		public function tp_check_elements() {
			add_action( 'wp_ajax_L_theplus_more_post', array( $this, 'L_theplus_more_post_ajax' ) );
			add_action( 'wp_ajax_nopriv_L_theplus_more_post', array( $this, 'L_theplus_more_post_ajax' ) );
		}

		/**
		 * Load More
		 *
		 * @since 5.6.7
		 */
		public function L_theplus_more_post_ajax() {
			global $post;
			ob_start();

			$load_attr = isset( $_POST['loadattr'] ) ? wp_unslash( $_POST['loadattr'] ) : '';
			if ( empty( $load_attr ) ) {
				ob_get_contents();
				exit;
				ob_end_clean();
			}

			$load_attr = L_tp_plus_simple_decrypt( $load_attr, 'dy' );
			$load_attr = json_decode( $load_attr, true );
			if ( ! is_array( $load_attr ) ) {
				ob_get_contents();
				exit;
				ob_end_clean();
			}

			$nonce = ( isset( $load_attr['theplus_nonce'] ) ) ? wp_unslash( $load_attr['theplus_nonce'] ) : '';
			if ( ! wp_verify_nonce( $nonce, 'theplus-addons' ) ) {
				die( 'Security checked!' );
			}

			$paged  = isset( $_POST['paged'] ) && intval( $_POST['paged'] ) ? wp_unslash( $_POST['paged'] ) : '';
			$offset = isset( $_POST['offset'] ) && intval( $_POST['offset'] ) ? wp_unslash( $_POST['offset'] ) : '';
			$layout = isset( $load_attr['layout'] ) ? sanitize_text_field( wp_unslash( $load_attr['layout'] ) ) : '';

			$category  = isset( $load_attr['category'] ) ? wp_unslash( $load_attr['category'] ) : '';
			$post_type = isset( $load_attr['post_type'] ) ? sanitize_text_field( wp_unslash( $load_attr['post_type'] ) ) : '';
			$post_load = isset( $load_attr['load'] ) ? sanitize_text_field( wp_unslash( $load_attr['load'] ) ) : '';
			$order_by  = isset( $load_attr['order_by'] ) ? sanitize_text_field( wp_unslash( $load_attr['order_by'] ) ) : '';
			$post_tags = isset( $load_attr['post_tags'] ) ? wp_unslash( $load_attr['post_tags'] ) : '';

			$display_post = isset( $load_attr['display_post'] ) && intval( $load_attr['display_post'] ) ? wp_unslash( $load_attr['display_post'] ) : 4;
			$post_authors = isset( $load_attr['post_authors'] ) ? wp_unslash( $load_attr['post_authors'] ) : '';
			$post_order   = isset( $load_attr['post_order'] ) ? sanitize_text_field( wp_unslash( $load_attr['post_order'] ) ) : '';

			$include_posts = isset( $load_attr['include_posts'] ) ? sanitize_text_field( wp_unslash( $load_attr['include_posts'] ) ) : '';
			$exclude_posts = isset( $load_attr['exclude_posts'] ) ? sanitize_text_field( wp_unslash( $load_attr['exclude_posts'] ) ) : '';

			$desktop_column = isset( $load_attr['desktop-column'] ) && intval( $load_attr['desktop-column'] ) ? wp_unslash( $load_attr['desktop-column'] ) : '';
			$tablet_column  = isset( $load_attr['tablet-column'] ) && intval( $load_attr['tablet-column'] ) ? wp_unslash( $load_attr['tablet-column'] ) : '';
			$mobile_column  = isset( $load_attr['mobile-column'] ) && intval( $load_attr['mobile-column'] ) ? wp_unslash( $load_attr['mobile-column'] ) : '';

			$style        = isset( $load_attr['style'] ) ? sanitize_text_field( wp_unslash( $load_attr['style'] ) ) : '';
			$style_layout = isset( $load_attr['style_layout'] ) ? sanitize_text_field( wp_unslash( $load_attr['style_layout'] ) ) : '';

			$filter_category  = isset( $load_attr['filter_category'] ) ? wp_unslash( $load_attr['filter_category'] ) : '';
			$animated_columns = isset( $load_attr['animated_columns'] ) ? sanitize_text_field( wp_unslash( $load_attr['animated_columns'] ) ) : '';
			$post_load_more   = isset( $load_attr['post_load_more'] ) && intval( $load_attr['post_load_more'] ) ? wp_unslash( $load_attr['post_load_more'] ) : '';

			$metro_column = isset( $load_attr['metro_column'] ) ? wp_unslash( $load_attr['metro_column'] ) : '';
			$metro_style  = isset( $load_attr['metro_style'] ) ? wp_unslash( $load_attr['metro_style'] ) : '';

			$texonomy_category = isset( $load_attr['texonomy_category'] ) ? sanitize_text_field( wp_unslash( $load_attr['texonomy_category'] ) ) : '';

			$tablet_metro_column = isset( $load_attr['tablet_metro_column'] ) ? wp_unslash( $load_attr['tablet_metro_column'] ) : '';
			$tablet_metro_style  = isset( $load_attr['tablet_metro_style'] ) ? wp_unslash( $load_attr['tablet_metro_style'] ) : '';

			$responsive_tablet_metro = isset( $load_attr['responsive_tablet_metro'] ) ? wp_unslash( $load_attr['responsive_tablet_metro'] ) : '';

			$post_title_tag     = isset( $load_attr['post_title_tag'] ) ? wp_unslash( $load_attr['post_title_tag'] ) : '';
			$display_post_title = isset( $load_attr['display_post_title'] ) ? wp_unslash( $load_attr['display_post_title'] ) : '';

			$author_prefix = isset( $load_attr['author_prefix'] ) ? wp_unslash( $load_attr['author_prefix'] ) : '';
			$feature_image = isset( $load_attr['feature_image'] ) ? wp_unslash( $load_attr['feature_image'] ) : '';

			$dpc_all = isset( $load_attr['dpc_all'] ) ? wp_unslash( $load_attr['dpc_all'] ) : '';

			$display_excerpt   = isset( $load_attr['display_excerpt'] ) ? wp_unslash( $load_attr['display_excerpt'] ) : '';
			$display_post_meta = isset( $load_attr['display_post_meta'] ) ? wp_unslash( $load_attr['display_post_meta'] ) : '';

			$post_excerpt_count  = isset( $load_attr['post_excerpt_count'] ) ? wp_unslash( $load_attr['post_excerpt_count'] ) : '';
			$post_meta_tag_style = isset( $load_attr['post_meta_tag_style'] ) ? wp_unslash( $load_attr['post_meta_tag_style'] ) : '';
			$post_category_style = isset( $load_attr['post_category_style'] ) ? wp_unslash( $load_attr['post_category_style'] ) : '';

			$title_desc_word_break = isset( $load_attr['title_desc_word_break'] ) ? wp_unslash( $load_attr['title_desc_word_break'] ) : '';
			$display_post_category = isset( $load_attr['display_post_category'] ) ? wp_unslash( $load_attr['display_post_category'] ) : '';

			if ( 'blogs' === $post_load ) {
                $content_html = isset( $load_attr['content_html'] ) ? wp_unslash( $load_attr['content_html'] ) : '';
            }

			$desktop_class = '';
			$tablet_class  = '';
			$mobile_class  = '';

			if ( 'carousel' !== $layout && 'metro' !== $layout ) {
				$desktop_class = 'tp-col-lg-' . esc_attr( $desktop_column );
				$tablet_class  = 'tp-col-md-' . esc_attr( $tablet_column );
				$mobile_class  = 'tp-col-sm-' . esc_attr( $mobile_column );
				$mobile_class .= ' tp-col-' . esc_attr( $mobile_column );
			}

			$j = 1;

			$args = array(
				'post_type'        => $post_type,
				'posts_per_page'   => $post_load_more,
				$texonomy_category => $category,
				'offset'           => $offset,
				'orderby'          => $order_by,
				'post_status'      => 'publish',
				'order'            => $post_order,
			);

			if ( '' !== $exclude_posts ) {
				$exclude_posts        = explode( ',', $exclude_posts );
				$args['post__not_in'] = $exclude_posts;
			}
			if ( '' !== $include_posts ) {
				$include_posts    = explode( ',', $include_posts );
				$args['post__in'] = $include_posts;
			}

			if ( '' !== $post_tags && 'post' === $post_type ) {
				$post_tags         = explode( ',', $post_tags );
				$args['tax_query'] = array(
					'relation' => 'AND',
					array(
						'taxonomy'         => 'post_tag',
						'terms'            => $post_tags,
						'field'            => 'term_id',
						'operator'         => 'IN',
						'include_children' => true,
					),
				);
			}

			if ( '' !== $post_authors && 'post' === $post_type ) {
				$args['author'] = $post_authors;
			}

			$ji = ( $post_load_more * $paged ) - $post_load_more + $display_post + 1;
			$ij = '';

			$tablet_metro_class = '';
			$tablet_ij          = '';

			$loop = new WP_Query( $args );
			if ( $loop->have_posts() ) :
				while ( $loop->have_posts() ) {
					$loop->the_post();

					if ( 'blogs' === $post_load ) {
						include L_THEPLUS_WSTYLES . 'blog/ajax-load-post/blog-style.php';
					}
					++$ji;
				}

				$content = ob_get_contents();

				ob_end_clean();
				endif;
			wp_reset_postdata();

			echo $content;

			exit;
			ob_end_clean();
		}
	}

	return Tp_load_more::get_instance();
}
