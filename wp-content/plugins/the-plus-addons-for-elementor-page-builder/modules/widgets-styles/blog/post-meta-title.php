<?php
/**
 * Blog meta title
 *
 * @package ThePlus
 * @since 1.0.0
 * @version 5.6.7
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
if ( ! isset( $post_title_tag ) && empty( $post_title_tag ) ) {
	$post_title_tag = 'h3';
}
$title_text = esc_html( get_the_title() );
?>
<<?php echo esc_attr( l_theplus_validate_html_tag( $post_title_tag ) ); ?> class="post-title">
	<a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo ( wp_kses_post( $title_text ) ); ?></a>
</<?php echo esc_attr( l_theplus_validate_html_tag( $post_title_tag ) ); ?>>
