<?php
/**
 * Instagram Feed Header Generic Template
 * Used for hashtag feeds
 *
 * @version 6.0 Instagram Feed Pro by Smash Balloon
 *
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$header_atts    = SB_Instagram_Display_Elements_Pro::get_header_data_attributes( 'generic', $settings, $header_data );
$header_padding = (int) $settings['imagepadding'] > 0 ? 'padding: ' . (int) $settings['imagepadding'] . esc_attr( $settings['imagepaddingunit'] ) . ';' : '';
$header_margin  = (int) $settings['imagepadding'] < 10 ? ' margin-bottom: 10px;' : '';

$hashtag                 = SB_Instagram_Parse_Pro::get_generic_term( $header_data );
$header_text_color_style = SB_Instagram_Display_Elements_Pro::get_header_text_color_styles( $settings ); // style="color: #517fa4;" already escaped
$type_class              = SB_Instagram_Display_Elements_Pro::get_feed_type_class( $settings );
$centered_class          = $settings['headerstyle'] === 'centered' ? ' sbi_centered' : '';
$size_class              = SB_Instagram_Display_Elements_Pro::get_header_size_class( $settings );
?>
<div class="sb_instagram_header sbi_header_type_generic <?php echo esc_attr( $type_class ) . esc_attr( $centered_class ) . esc_attr( $size_class ); ?>" style="<?php echo $header_padding . $header_margin; ?>padding-bottom: 0;"<?php echo $header_atts; ?>>
	<a href="<?php echo esc_url( 'https://www.instagram.com/explore/tags/' . $hashtag . '/' ); ?>" target="_blank" rel="nofollow noopener" title="#<?php echo esc_attr( $hashtag ); ?>" class="sbi_header_link">

		<?php if ( $settings['headerstyle'] === 'centered' ) : ?>
			<div class="sbi_header_img">
				<div class="sbi_header_hashtag_icon"><?php echo SB_Instagram_Display_Elements_Pro::get_icon( 'newlogo', 'svg' ); ?></div>
			</div>
		<?php endif; ?>

		<div class="sbi_header_text">
			<h3 class="sbi_no_bio" <?php echo $header_text_color_style; ?>>#<?php echo esc_html( $hashtag ); ?></h3>
		</div>

		<?php if ( $settings['headerstyle'] !== 'centered' ) : ?>
			<div class="sbi_header_img">
				<div class="sbi_header_hashtag_icon"><?php echo SB_Instagram_Display_Elements_Pro::get_icon( 'newlogo', 'svg' ); ?></div>
			</div>
		<?php endif; ?>

	</a>
</div>