<?php
/**
 * Testimonial get-excerpt
 *
 * @package ThePlus
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( 'tlrepeater' === $con_from ) {
	$testimonial_author_text = wpautop( $testi_author );
} else {
	$testimonial_author_text = get_post_meta( get_the_id(), 'theplus_testimonial_author_text', true );
	$testimonial_author_text = wpautop( $testimonial_author_text );
}

if ( ! empty( $testimonial_author_text ) ) {

	if ( 'tlrepeater' === $con_from ) {

		$excerpt = '';

		if ( 'default' === $descby_limit ) {
			?>
				<div class="entry-content scroll-<?php echo esc_attr( $cntscroll_on ); ?>"><?php echo wp_kses_post( $testimonial_author_text ); ?></div>
			<?php
		} elseif ( 'words' === $descby_limit ) {

			$total = explode( ' ', $testimonial_author_text );
			$words = explode( ' ', $testimonial_author_text );

			$remaining_words = implode( ' ', array_slice( $total, $desc_limit - 1 ) );
			$limit_words     = implode( ' ', array_splice( $words, 0, $desc_limit - 1 ) );

		} elseif ( 'letters' === $descby_limit ) {

			$ltn = strlen( $testimonial_author_text );

			$limit_words     = substr( $testimonial_author_text, 0, $desc_limit );
			$remaining_words = substr( $testimonial_author_text, $desc_limit, $ltn );

			if ( strlen( $testimonial_author_text ) > $desc_limit ) {
				$excerpt = $limit_words . '<span class="testi-more-text" style = "display:none" >' . wp_kses_post( $remaining_words ) . '</span><a ' . esc_attr( $attr ) . ' class="testi-readbtn"> ' . esc_attr( $redmor_txt ) . ' </a>';
			} else {
				$excerpt = $limit_words;
			}
		}
	}
	?>
		
<div class="entry-content">
	<?php
	if ( 'tlrepeater' === $con_from ) {
		echo $excerpt;
	} else {
		echo $testimonial_author_text;
	}
	?>
</div>
<?php } ?>