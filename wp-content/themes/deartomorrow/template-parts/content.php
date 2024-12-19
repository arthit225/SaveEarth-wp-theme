<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package deartomorrow
 */


$this_id = get_the_ID();
$press_link = get_field('press_link');

if ($press_link) {
    $blog_post_link = $press_link;
    $blog_post_target = '_blank';
}
else {
    $blog_post_link = get_permalink();
    $blog_post_target = '_self';
}


?>

<a href="<?php echo $blog_post_link; ?>" target="<?php echo $blog_post_target; ?>" id="post-<?php the_ID(); ?>" <?php post_class('element-item blog-post'); ?>>
    <?php
        if ( has_post_thumbnail() ) {
            echo '<div class="element-item-thumbnail" style="background-image: url(' . get_the_post_thumbnail_url(get_the_ID(),'large') . ');">&nbsp;</div>';
        }
    ?>
	<div class="entry-content">
        <?php
            echo '<p class="blog-post-title">' . get_the_title() . '</p>';
            echo '<span class="blog-post-excerpt">';
            echo get_excerpt_by_id($this_id);
            echo '<p class="blog-post-date">' . get_the_date() . '</p>';
            echo '</span>';

		?>
	</div><!-- .entry-content -->

</a><!-- #post-## -->
