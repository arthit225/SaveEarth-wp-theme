<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package deartomorrow
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="blog-post-title">
		<?php
        if (is_single()) {
            the_title( '<h2 class="entry-title">', '</h2>' );
        }
        else {
            the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
        }
        if ( has_post_thumbnail() ) {
            echo '<a href="' . get_the_post_thumbnail_url() . '">';
            the_post_thumbnail('large');
            echo '</a>';
        } 
		?>
	</header><!-- .blog-post-header -->
    <?php

    
    ?>

	<div class="blog-post-content">
        
        <div class="post-date">
            <?php echo get_the_date('F j, Y');?>
        </div>
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'deartomorrow' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'deartomorrow' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .blog-post-content -->

	<footer class="entry-footer">
		<?php deartomorrow_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
