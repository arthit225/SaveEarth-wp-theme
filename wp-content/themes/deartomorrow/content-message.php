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
    
    <header class="section-header">
        <?php if( !has_term( 'video', 'type' ) ) { ?>
            <div class="message-thumbnail">
                <a href="<?php echo get_the_post_thumbnail(); ?>"><?php the_post_thumbnail(); ?></a>
            </div>
        <?php } ?>
        <h1 class="section-title"><?php the_title(); ?></h1>
	</header><!-- .section-header -->


	<div class="entry-content">
        <?php if ( has_post_thumbnail() ) : ?>
        <?php endif; ?>        
		<?php
			the_content();
		?>
	</div><!-- .entry-content -->


    
    
    <?php
    
    $moreargs = array(
        'posts_per_page'   => 12,
        'orderby'          => 'rand', 
        'post_type'        => 'message',
        'post_status'      => 'publish',
        'exclude'          => get_the_ID(),
          'meta_query' => array(
             array(
               'key' => '_thumbnail_id'
             )
          ),
    );
    
    $moreposts = get_posts($moreargs);
    
    if ($moreposts) {
        echo '<div class="message-more">';
        echo '<h2>More Messages to the Future</h2>';
        echo '<div class="grid">';
            
        foreach ( $moreposts as $mpost ) : setup_postdata( $mpost ); 


        
            $element_class = array('element-item', 'has_thumbnail');
        
            $message_types = wp_get_post_terms( $mpost->ID, 'type' );
        


        foreach ($message_types as $type) {
                array_push($element_class, 'message-type-' . $type->slug);
            }
        
            $caption_excerpt = get_the_excerpt();
            $caption_excerpt = str_replace('"', "", $caption_excerpt);
            $caption_excerpt = str_replace("'", "", $caption_excerpt);
        ?>
            <a href="<?php echo esc_url( get_permalink($mpost->ID) ); ?>" id="post-<?php the_ID(); ?>" <?php post_class($element_class); ?>>
                <?php
                    echo '<div class="element-item-thumbnail" style="background-image: url(' . get_the_post_thumbnail_url($mpost->ID,'large') . ');">&nbsp;</div>';
                ?>
                <div class="entry-content">
                    <?php
                        echo '<p class="message-archive-title">' . get_the_title($mpost->ID) . '</p>';

                    ?>
                </div><!-- .entry-content -->

            </a><!-- #post-## -->
        <?php endforeach; 
        wp_reset_postdata();

            
        
        echo '</div>'; // end grid
        echo '<a class="button" href="'. get_site_url() . '/messages/">View All Messages</a>';
        echo '</div>'; // end .message-more">';
    }
    ?>
    
    
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