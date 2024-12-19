<?php
/**
 * Gallery meta title
 *
 * @package ThePlus
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! isset( $post_title_tag ) && empty( $post_title_tag ) ) {
	$post_title_tag = 'h3';
} ?>

<<?php echo esc_attr( l_theplus_validate_html_tag( $post_title_tag ) ); ?> class="post-title">
	<?php
	if ( 'no' !== $popup_style ) {
		?>
				
		<a href="<?php echo esc_url( $full_image ); ?>" <?php echo esc_attr( $popup_attr ); ?>><?php echo esc_html( $title ); ?></a>				
		<?php
	} else {
		echo esc_html( $title );
	}
	?>
</<?php echo esc_attr( l_theplus_validate_html_tag( $post_title_tag ) ); ?>>