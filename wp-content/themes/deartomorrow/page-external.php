<?php
/**
Template Name: External Source
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main page-container" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'external' );

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
// get_sidebar();
get_footer();
