<?php
/**
 * Blog format image
 *
 * @package ThePlus
 * @since 1.0.0
 * @version 5.6.7
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$featured_image_url = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );

if ( ! empty( $featured_image_url ) ) {
	if ( 'grid' === $layout ) {
		$featured_image = tp_get_image_rander( get_the_ID(), 'tp-image-grid', array(), 'post' );

	} elseif ( 'masonry' === $layout ) {
		$featured_image = tp_get_image_rander( get_the_ID(), 'full', array(), 'post' );
	} else {
		$featured_image = tp_get_image_rander( get_the_ID(), 'full', array(), 'post' );
	}
} else {
	$featured_image_url = l_theplus_get_thumb_url();
	$featured_image     = '<img width="600" height="600" loading="lazy" data-src="' . esc_url( $featured_image_url ) . '" src="' . esc_url( $featured_image_url ) . '" class="tp-lazyload" alt="' . esc_attr( get_the_title() ) . '">';
}

?>
<div class="blog-featured-image">
<span class="thumb-wrap">
	<?php echo wp_kses_post( $featured_image ); ?>
</span>
</div>
