<?php
/**
 * Testimonial post-meta-title
 *
 * @package ThePlus
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<div class="post-title">
	<?php
	if ( 'tlrepeater' === $con_from ) {
		echo esc_html( $testi_label );
	} else {
		echo esc_html( get_the_title() );
	}
	?>
</div>