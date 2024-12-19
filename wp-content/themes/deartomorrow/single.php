<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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

            <div class="entry-content">
            <?php
                while ( have_posts() ) : the_post();

                    get_template_part( 'template-parts/content', 'single' );

                    the_post_navigation( array (
                        'prev_text' => __('<i class="fa fa-arrow-left" aria-hidden="true"></i> <strong>Previous: </strong>%title'),
                        'next_text' => __('<strong>Next: </strong> %title <i class="fa fa-arrow-right" aria-hidden="true"></i>'),

                    ));

                    // If comments are open or we have at least one comment, load up the comment template.
                    // if ( comments_open() || get_comments_number() ) :
                    //    comments_template();
                    // endif;

                endwhile; // End of the loop.
                ?>
            </div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
