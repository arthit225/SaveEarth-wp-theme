<?php
/**
 * Gallery meta icon
 *
 * @package ThePlus
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
$cut_img = ! empty( $settings['custom_icon_image']['url'] ) ? $settings['custom_icon_image']['url'] : '';

if ( ! empty( $cut_img ) ) {
	$icon_content = '<img src="' . esc_url( $cut_img ) . '" alt="' . esc_attr__( 'zoom', 'tpebl' ) . '"/>';
} else {
	$icon_content = '<i class="fas fa-search-plus" aria-hidden="true"></i>';
} ?>
<div class="meta-search-icon">	
	<a href="<?php echo esc_url( $full_image ); ?>" <?php echo wp_kses_post( $popup_attr_icon ); ?>><?php echo wp_kses_post( $icon_content ); ?></a>
</div>