<?php
/**
 * Gallery style 1
 *
 * @package ThePlus
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( $attachment ) {
	$image_id = $attachment->ID;
} else {
	$image_id = $image_id;
}

$full_image = '';
$full_image = wp_get_attachment_url( $image_id, 'full' );

$bg_attr = '';
if ( 'metro' === $layout ) {
	if ( ! empty( $full_image ) ) {
		$bg_attr = 'style="background:url(' . $full_image . ')"';
	} else {
		$bg_attr = l_theplus_loading_image_grid( $postid, 'background' );
	}
} ?>
<div class="gallery-list-content">

<?php if ( 'metro' !== $layout ) { ?>
<div class="post-content-image">
	<?php include L_THEPLUS_WSTYLES . 'gallery/format-image.php'; ?>
</div>
<?php } ?>
<div class="post-content-center">		
	<div class="post-hover-content">
		<?php
		if ( 'yes' === $display_icon_zoom ) {
			include L_THEPLUS_WSTYLES . 'gallery/meta-icon.php';
		}
		?>
		<?php if ( ! empty( $image_icon ) && ! empty( $list_img ) ) { ?>
			<div class="gallery-list-icon"><?php echo wp_kses_post( $list_img ); ?></div>
		<?php } ?>
		<?php
		if ( 'yes' === $display_title ) {
			include L_THEPLUS_WSTYLES . 'gallery/meta-title.php';
		}
		?>
		<?php
		if ( 'yes' === $display_excerpt && ! empty( $caption ) ) {
			include L_THEPLUS_WSTYLES . 'gallery/get-excerpt.php';
		}
		?>
	</div>
</div>
<?php if ( 'metro' === $layout ) { ?>
	<div class="gallery-bg-image-metro" <?php echo wp_kses_post( $bg_attr ); ?>></div>
<?php } ?>
</div>