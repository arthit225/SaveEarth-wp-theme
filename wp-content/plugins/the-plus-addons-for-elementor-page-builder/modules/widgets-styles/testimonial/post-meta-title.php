<?php
/**
 * Testimonial post-meta-title
 *
 * @package ThePlus
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( 'tlrepeater' === $con_from ) {
	$testimonial_title = $testi_title;
} else {
	$testimonial_title = get_post_meta( get_the_id(), 'theplus_testimonial_title', true );
}

if ( empty( $post_title_tag ) ) {
	$post_title_tag = 'h3';
}

if ( ! empty( $testimonial_title ) ) {
	if ( 'tlrepeater' === $con_from ) {
		$title = '';
		if ( $layout != 'carousel' ) { ?>
			<<?php echo esc_attr( l_theplus_validate_html_tag( $post_title_tag ) ); ?> class="testimonial-author-title title-scroll-<?php echo esc_attr( $cntscroll_on ); ?>"><?php echo esc_html( $testimonial_title ); ?></<?php echo esc_attr( l_theplus_validate_html_tag( $post_title_tag ) ); ?>>
			<?php
		} elseif ( $title_by_limit === 'words' ) {
				$titotal           = explode( ' ', $testimonial_title );
				$tilimit_words     = explode( ' ', $testimonial_title, $title_limit );
				$tiltn             = count( $tilimit_words );
				$tiremaining_words = implode( ' ', array_slice( $titotal, $title_limit - 1 ) );
			if ( count( $tilimit_words ) >= $title_limit ) {
				array_pop( $tilimit_words );
				$title = implode( ' ', $tilimit_words ) . ' <span class="testi-more-text" style = "display: none" >' . wp_kses_post( $tiremaining_words ) . '</span><a ' . $attr . ' class="testi-readbtn"> ' . esc_attr( $redmor_txt ) . ' </a>';
			} else {
				$title = implode( ' ', $tilimit_words );
			}
		} elseif ( $title_by_limit === 'letters' ) {
			$tiltn             = strlen( $testimonial_title );
			$tilimit_words     = substr( $testimonial_title, 0, $title_limit );
			$tiremaining_words = substr( $testimonial_title, $title_limit, $tiltn );
			if ( strlen( $testimonial_title ) > $title_limit ) {
				$title = $tilimit_words . '<span class="testi-more-text" style = "display:none" >' . wp_kses_post( $tiremaining_words ) . '</span><a ' . $attr . ' class="testi-readbtn"> ' . esc_attr( $redmor_txt ) . ' </a>';
			} else {
				$title = $tilimit_words;
			}
		} else {
			$title = $testimonial_title;
		}
	}

	if ( 'tlrepeater' === $con_from ) {
		?>
		<<?php echo esc_attr( l_theplus_validate_html_tag( $post_title_tag ) ); ?> class="testimonial-author-title"><?php echo wp_kses_post( $title ); ?></<?php echo esc_attr( l_theplus_validate_html_tag( $post_title_tag ) ); ?>>
	<?php } else { ?>
		<<?php echo esc_attr( l_theplus_validate_html_tag( $post_title_tag ) ); ?> class="testimonial-author-title"><?php echo esc_html( $testimonial_title ); ?></<?php echo esc_attr( l_theplus_validate_html_tag( $post_title_tag ) ); ?>>
	<?php }
}
?>