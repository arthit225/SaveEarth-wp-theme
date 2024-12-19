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
        <?php if( have_rows('inspiration_items') ): ?>

            <div class="grid">
            <?php while( have_rows('inspiration_items') ): the_row(); 

                // vars
                $inspiration_item_image = get_sub_field('inspiration_item_image');
                $inspiration_item_title = get_sub_field('inspiration_item_title');
                $inspiration_item_text = get_sub_field('inspiration_item_text');
                $inspiration_item_link = get_sub_field('inspiration_item_link');
                ?>
                <?php if ($inspiration_item_link) { ?>
                    <a href="<?php echo $inspiration_item_link; ?>" class="element-item inspiration-item">
                <?php } else { ?>
                    <a href="#" class="element-item inspiration-item">
                
                <?php } ?>
                
                    <div class="element-item-thumbnail" style="background-image: url(<?php echo $inspiration_item_image['url']; ?>);">&nbsp;</div>
                    <div class="entry-content">
                        <p class="inspiration-title"><?php echo $inspiration_item_title; ?></p>
                        <span class="message-archive-excerpt"><?php echo $inspiration_item_text; ?></span>
                    </div>




                </a>

            <?php endwhile; ?>

            </div>

    <script>
        jQuery("a.inspiration-item").on("click", function(event){
            event.preventDefault();
        });
    </script>
    
        <?php endif; ?>
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