<?php
/**
 * Testimonial post-meta-logo
 *
 * @package ThePlus
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
if ( 'tlrepeater' === $con_from ) {
	$testimonial_logo = $testi_logo;
} elseif ( 'tlrepeater' === $con_from ) {
	$testimonial_logo = get_post_meta( get_the_id(), 'theplus_testimonial_logo', true );
}

if ( ! empty( $testimonial_logo ) ) {
	?>
	<div class="testimonial-author-logo"><img src="<?php echo esc_url( $testimonial_logo ); ?>" /></div>
	<?php
}