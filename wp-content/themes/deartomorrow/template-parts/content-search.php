<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package deartomorrow
 */

?>

<?php

$search_term = get_search_query();
$anon_field = get_field('publish_anonymously');
$anon_check = $anon_field[0];

echo 'anonanon' . $anon_check;
if ($anon_check == 'i_want_my_message_published_on_the_website_anonymously') {
    $is_anon = 1;
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php deartomorrow_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

	<footer class="entry-footer">
		<?php deartomorrow_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
