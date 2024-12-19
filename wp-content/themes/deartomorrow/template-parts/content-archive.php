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


$message_types = wp_get_post_terms( get_the_ID(), 'type' );  


foreach ($message_types as $type) {
    array_push($element_class, 'message-type-' . $type->slug);
}

if( has_term( 'photo', 'type' ) ) {
    $message_link = get_the_post_thumbnail_url(get_the_ID(),'full');
}

elseif( has_term( 'video', 'type' ) ) {
    $message_link = get_field('video_url', get_the_ID());
}


else {
    $message_link = esc_url( get_permalink() );
}

                $is_anon = get_field('publish_anonymously');
                if ( $is_anon && in_array('i_want_my_message_published_on_the_website_anonymously', $is_anon) ){
                    $message_name = 'Anonymous';
            
                }
                else {
                    $message_name =  get_field('first_name') . ' ' . get_field('last_name');
                     }


                $caption_excerpt = get_excerpt_by_id($this_id);

                $caption_excerpt = str_replace('"', "", $caption_excerpt);
                $caption_excerpt = str_replace("'", "", $caption_excerpt);
    
?>

<a <?php if( !has_term( 'letter', 'type' )) { echo 'data-fancybox="gallery"'; } ?> data-caption="<?php echo $message_name . ': ' . $caption_excerpt; ?> <a class='expand-photo-link' href='<?php echo esc_url( get_permalink() ); ?>'><img src='<?php echo get_site_url(); ?>/wp-content/themes/deartomorrow/images/icon-expand.png' /></a>" href="<?php echo $message_link; ?>" id="post-<?php the_ID(); ?>" <?php post_class($element_class); ?>>
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
            if ('message' == get_post_type()) {
                echo '<p class="message-archive-name">by ' . $message_name . '</p>';
            }
            echo '</span>';

		?>
	</div><!-- .entry-content -->

</a><!-- #post-## -->
