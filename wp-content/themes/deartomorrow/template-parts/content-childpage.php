<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package deartomorrow
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php
        if ( $post->post_parent ) {
            $section_title = get_the_title($post->post_parent);
            $page_title = get_the_title();
            
            $child_pages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&echo=0' );
            
            if ( isset($child_pages) ) {
                $section_nav = '<ul>' . $child_pages . '</ul>';
            }

        }
        else {
            $section_title = get_the_title();
            $page_title = '';

            $child_pages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0' );
            
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
    <?php if ((isset($page_title)) && ($page_title != '')) { ?>    
    <div class="entry-header" <?php if (get_field('intro_section_color')) {echo 'style="background-color: ' . get_field('intro_section_color') .'"'; } ?>>
        <div class="entry-header-inner">            
            <h1 class="entry-title"><?php echo $page_title; ?></h1>
        </div>
	</div><!-- .entry-header -->
    <?php } ?>
        
		<?php
			the_content();
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'deartomorrow' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
    <?php get_template_part( 'template-parts/newsletter' ); ?>
</article><!-- #post-## -->