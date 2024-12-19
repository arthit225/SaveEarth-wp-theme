<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package deartomorrow
 */

get_header(); 

$news_page_id = get_option('page_for_posts');
$news_page_parent_id = wp_get_post_parent_id( $news_page_id );
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
        <?php
            if ( $news_page_parent_id ) {
                $section_title = get_the_title($news_page_parent_id);
                $page_title = get_the_title($news_page_id);

                $child_pages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $news_page_parent_id . '&echo=0' );

                if ( isset($child_pages) ) {
                    $section_nav = '<ul>' . $child_pages . '</ul>';
                }

            }
            else {
                $section_title = get_the_title($news_page_id);
                $page_title = '';

                $child_pages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $news_page_id . '&echo=0' );

                if ( isset($child_pages) ) {
                    $section_nav = '<ul>' . $child_pages . '</ul>';
                }
            }

        ?>

        <header class="section-header">
            <h1 class="section-title"><?php echo $section_title; ?></h1>
            <nav class="section-nav" role="navigation">
                <?php if ($child_pages) {echo $section_nav;} ?>
            </nav>
        </header><!-- .section-header -->
            
        <div class="grid">
        <?php
            if ( have_posts() ) :


                /* Start the Loop */
                while ( have_posts() ) : the_post();

                    /*
                     * Include the Post-Format-specific template for the content.
                     * If you want to override this in a child theme, then include a file
                     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                     */
                    get_template_part( 'template-parts/content', get_post_format() );

                endwhile;

                the_posts_navigation();

            else :

                get_template_part( 'template-parts/content', 'none' );

            endif; ?>
        </div><!-- .grid -->
            <p style="font-size: 24px; text-align: center; padding: 0px 20px;">For media and speaking inquiries, please send an email to <a href="mailto:jill@deartomorrow.org">jill@deartomorrow.org</a>.</p>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
