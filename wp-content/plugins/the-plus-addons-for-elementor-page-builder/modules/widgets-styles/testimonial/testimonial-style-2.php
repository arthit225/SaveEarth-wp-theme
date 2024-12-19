<?php
/**
 * Testimonial style-2
 *
 * @package ThePlus
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( 'tlcontent' === $con_from ) {
	$postid = get_the_ID();
	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php } ?>
		<div class="testimonial-list-content">
			<div class="testimonial-content-text">
				<?php
					require L_THEPLUS_WSTYLES . 'testimonial/get-excerpt.php';
					require L_THEPLUS_WSTYLES . 'testimonial/post-meta-title.php';
				?>
			</div>
			<div class="post-content-image">
				<?php
					require L_THEPLUS_WSTYLES . 'testimonial/format-image.php';
					require L_THEPLUS_WSTYLES . 'testimonial/post-title.php';
					require L_THEPLUS_WSTYLES . 'testimonial/post-meta-designation.php';
				?>
			</div>		
		</div>
<?php if ( 'tlcontent' === $con_from ) { ?>
	</article>
<?php } ?>
