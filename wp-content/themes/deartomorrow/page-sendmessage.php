<?php
/**
 * Template Name: Send Message
 *
 * @package deartomorrow
 */
acf_form_head();
get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
            
			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'sendmessage' );


			endwhile; // End of the loop.
            
            
            
            
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
