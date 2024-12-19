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
        <div class="message-image-header"  style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>);">
           <div class="message-image-header-excerpt">
                <h1 class="section-title" style="text-align: center;"><?php the_title(); ?></h1>
                <?php
                    $event_location = get_field('event_location');
                    $event_start_date = get_field('event_start_date');
                    $event_end_date = get_field('event_end_date');
                ?>
                <div class="event-meta">
                    <span class="event-location"><?php echo $event_location; ?></span>
                    <span class="event-date"><?php echo $event_start_date; ?>
                    <?php
                        if ($event_end_date) {
                            echo ' - ' . $event_end_date;
                        }
                    ?>
                    </span>
                </div>


               <a rel="m_PageScroll2id" href="#the-message-content" class="scroll-down" aria-hidden="true"><img class="aligncenter"  src="<?php echo get_site_url(); ?>/wp-content/themes/deartomorrow/images/two-down-chevron.png" /></a>
            </div>
        </div>
        
        
	</header><!-- .section-header -->


	<div id="the-message-content" class="entry-content">
		<?php
			the_content();
		?>
        <div class="clear" style="width: 100%; clear: both; height: 1px; font-size: 1px; line-height: 1px;">&nbsp;</div>
        
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