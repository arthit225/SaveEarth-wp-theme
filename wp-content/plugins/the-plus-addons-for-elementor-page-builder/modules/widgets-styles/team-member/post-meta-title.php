<?php
/**
 * Get Meta Title Here
 *
 * @package ThePlus
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! isset( $post_title_tag ) && empty( $post_title_tag ) ) {
	$post_title_tag = 'h3';
}

$tm_title = '';
if ( 'repeater' === $selct_source ) {
	$tm_title = $item['memberTitle'];
} else {
	$tm_title = get_the_title();
}

?>
<<?php echo esc_attr( l_theplus_validate_html_tag( $post_title_tag ) ); ?> class="post-title">
	<a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo esc_html( $tm_title ); ?></a>
</<?php echo esc_attr( l_theplus_validate_html_tag( $post_title_tag ) ); ?>>