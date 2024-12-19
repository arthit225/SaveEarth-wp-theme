<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package deartomorrow
 */

$this_id = get_the_ID();

$element_class = array('element-item');
$message_link = esc_url( get_permalink() );

$is_anon = get_field('publish_anonymously');
if ( ($is_anon) && (in_array('i_want_my_message_published_on_the_website_anonymously', $is_anon)) ){
    $message_name = 'Anonymous';
}
else {
    $message_name =  get_field('first_name') . ' ' . get_field('last_name');
}


$search_term = get_search_query();
$anon_field = get_field('publish_anonymously');
$anon_check = $anon_field[0];

if ($anon_check == 'i_want_my_message_published_on_the_website_anonymously') {
    $hide_it_from_search = 1;
}


$first_check = strtolower(get_field('first_name'));
$last_check = strtolower(get_field('last_name'));
$full_check = strtolower(get_field('full_name'));
$search_term = strtolower($search_term);
//if (($hide_it_from_search == 1) && ( ($search_term == $first_check) || ($search_term == $last_check) || ($search_term == $full_check) ) ) {

if (($hide_it_from_search == 1)) {
    $keep_it_secret = 1;
}

?>
<?php if (!$keep_it_secret == 1) { ?>
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
            if ('message' == get_post_type()) {
                echo '<p class="message-archive-name">by ' . $message_name . '</p>';
            }
            echo '</span>';

		?>
	</div><!-- .entry-content -->

</a><!-- #post-## -->
<?php } ?>