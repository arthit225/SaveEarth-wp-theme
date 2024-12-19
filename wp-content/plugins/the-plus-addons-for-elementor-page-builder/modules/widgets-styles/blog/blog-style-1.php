<?php
/**
 * Blog Style-1
 *
 * @package ThePlus
 * @since 1.0.0
 * @version 5.6.7
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$postid  = get_the_ID();
$bg_attr = '';

if ( 'metro' === $layout ) {
		$featured_image = get_the_post_thumbnail_url( $postid, 'full' );
	if ( ! empty( $featured_image ) ) {
		$bg_attr = l_theplus_loading_bg_image( $postid );
	} else {
		$bg_attr = l_theplus_loading_image_grid( $postid, 'background' );
	}
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="blog-list-content">
		<?php if ( 'metro' !== $layout ) { ?>
		<div class="post-content-image">
			<a href="<?php echo esc_url( get_the_permalink() ); ?>">
				<?php include L_THEPLUS_WSTYLES . 'blog/format-image.php'; ?>
			</a>
		</div>
		<?php } ?>
		<div class="post-content-bottom">
			<?php if ( 'yes' === $display_post_meta ) { ?>
				<div class="post-meta-info style-1">
					<?php include L_THEPLUS_WSTYLES . 'blog/meta-date.php'; ?>
					<span>|</span> <span class="post-author">
						<?php echo esc_html__( 'By ', 'tpebl' ); ?> 
						<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author" class="fn">
						<?php echo get_the_author(); ?>
			</a></span>
				</div>
				<?php
			}
			require L_THEPLUS_WSTYLES . 'blog/post-meta-title.php';
			?>
			<div class="post-hover-content">
				<?php
				if ( 'yes' === $display_excerpt && get_the_excerpt() ) {
					include L_THEPLUS_WSTYLES . 'blog/get-excerpt.php';
				}
				?>
			</div>
		</div>
		<?php
		if ( 'metro' === $layout ) {
			$lazybgclass = '';
			if ( tp_has_lazyload() ) {
				$lazybgclass = ' lazy-background';
			}
			?>
		<a href="<?php echo esc_url( get_the_permalink() ); ?>"><div class="blog-bg-image-metro <?php echo ( esc_attr( $lazybgclass ) ); ?>" <?php echo ( wp_kses_post( $bg_attr ) ); ?>></div></a>
		<?php } ?>
	</div>
</article>
