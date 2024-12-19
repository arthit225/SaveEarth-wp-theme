<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package deartomorrow
 */

get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php
		if ( have_posts() ) : 
            
            $this_type = get_query_var( 'term' );
            ?>
            

			<header class="section-header">
				<h1 class="section-title">Messages</h1>
                
                <?php if (($this_type != 'elders-climate-action') && ($this_type != 'climate-dads')) { ?>
                <div class="section-nav">
                    <ul>
                        <li><a href="<?php echo get_site_url(); ?>/message/">All</a></li>
                        <li <?php if ($this_type == 'letter') { echo ' class="current-type"'; } ?>><a href="<?php echo get_site_url(); ?>/type/letter/">Letters</a></li>
                        <li <?php if ($this_type == 'photo') { echo ' class="current-type"'; } ?>><a href="<?php echo get_site_url(); ?>/type/photo/">Photos</a></li>
                        <li <?php if ($this_type == 'video') { echo ' class="current-type"'; } ?>><a href="<?php echo get_site_url(); ?>/type/video/">Videos</a></li>
                    </ul>
                </div>
                <?php } else { ?>
                    <h2 class="partner-title"><?php $partner_array = get_term_by('slug', $this_type, 'type'); echo $partner_array->name; ?></h2>
                <?php } ?>
                
                
			</header><!-- .page-header -->
            <div class="grid">
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'archive' );

			endwhile;
            ?>
            </div>
            <div class="post-nav-links">
            <?php
                posts_nav_link(' ', 'Back', 'More');
            ?>
            </div>
        <?php
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
