<?php
/**
 * Client Format image
 *
 * @package ThePlus
 * @since 1.0.0
 * @version 5.6.7
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( 'clrepeater' === $content_from ) {
	$featured_image_url = $client_image;
} else {
	global $post;

	$postid = get_the_ID();

	$featured_image_url = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
}

if ( ! empty( $featured_image_url ) ) {
	if ( 'clrepeater' === $content_from ) {

		$feat_id = $client_imageid;

		if ( ! empty( $feat_id ) ) {
			$featured_image = tp_get_image_rander( $feat_id, 'full' );
		}
	} else {
		$featured_image = tp_get_image_rander( get_the_ID(), 'full', array(), 'post' );
	}
} else {
	$featured_image = l_theplus_get_thumb_url();

	if ( 'clrepeater' === $content_from ) {
		$featured_image = '<img width="600" height="600" loading="lazy" src="' . esc_url( $featured_image ) . '" class="tp-lazyload" alt="' . esc_attr( $client_lml ) . '">';
	} else {
		$featured_image = '<img width="600" height="600" loading="lazy" src="' . esc_url( $featured_image ) . '" class="tp-lazyload" alt="' . esc_attr( get_the_title() ) . '">';
	}
}
?>

<div class="client-featured-logo">
	<span class="thumb-wrap">
		<?php echo wp_kses_post( $featured_image ); ?>
	</span>
</div>
