<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package deartomorrow
 */

$this_id = get_the_ID();



if ( has_post_thumbnail() ) {
    $element_class = array('element-item', 'has_thumbnail');
}
else {
    $element_class = array('element-item');
}




$message_link = esc_url( get_permalink() );



                $caption_excerpt = get_excerpt_by_id($this_id);

                $caption_excerpt = str_replace('"', "", $caption_excerpt);
                $caption_excerpt = str_replace("'", "", $caption_excerpt);
    
?>

<a href="<?php echo $message_link; ?>" id="post-<?php the_ID(); ?>" <?php post_class($element_class); ?>>
    <?php
        if ( has_post_thumbnail() ) {
            echo '<div class="element-item-thumbnail" style="background-image: url(' . get_the_post_thumbnail_url(get_the_ID(),'large') . ');">&nbsp;</div>';
        } 
    ?>
	<div class="entry-content">
        <?php
            echo '<p class="message-archive-title">' . get_the_title() . '</p>';
            echo '<span class="message-archive-excerpt">';
			the_excerpt( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'deartomorrow' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
        
            $event_location = get_field('event_location');
            $event_start_date = get_field('event_start_date');        
        
            echo '<p class="message-archive-name">' . $event_location . '<br/>' . $event_start_date . '</p>';
            echo '</span>';

		?>
	</div><!-- .entry-content -->

</a><!-- #post-## -->
