<?php
/**
 * Instagram Feed Header Template
 * Adds account information and an avatar to the top of the feed
 *
 * @version 6.0 Instagram Feed Pro by Smash Balloon
 *
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

// Elements
$username = SB_Instagram_Parse_Pro::get_username( $header_data );
$avatar   = SB_Instagram_Parse_Pro::get_avatar( $header_data, $settings );
$name     = SB_Instagram_Parse_Pro::get_name( $header_data );
$bio      = SB_Instagram_Parse_Pro::get_bio( $header_data, $settings );

// Attributes
$header_atts                = SB_Instagram_Display_Elements_Pro::get_header_data_attributes( 'standard-centered', $settings, $header_data );
$header_image_atts          = SB_Instagram_Display_Elements_Pro::get_header_img_data_attributes( $settings, $header_data );
$header_image_atts_centered = SB_Instagram_Display_Elements_Pro::get_header_img_data_attributes( $settings, $header_data, 'centered' );
$avatar_el_atts             = SB_Instagram_Display_Elements_Pro::get_avatar_element_data_attributes( $settings, $header_data );
$header_padding             = (int) $settings['imagepadding'] > 0 ? 'padding: ' . (int) $settings['imagepadding'] . esc_attr( $settings['imagepaddingunit'] ) . ';' : '';
$header_margin              = (int) $settings['imagepadding'] < 10 ? ' margin-bottom: 10px;' : '';
$header_text_color_style    = SB_Instagram_Display_Elements_Pro::get_header_text_color_styles( $settings ); // style="color: #517fa4;" already escaped
$header_classes             = SB_Instagram_Display_Elements_Pro::get_header_class( $settings, $avatar );
$header_heading_attribute   = SB_Instagram_Display_Elements_Pro::get_header_heading_data_attributes( $settings );
$should_show_bio            = $bio !== '' ? SB_Instagram_Display_Elements_Pro::should_show_element( 'headerbio', $settings ) : false;
$header_text_class          = SB_Instagram_Display_Elements_Pro::get_header_text_class( $header_data, $settings );
$bio_attribute              = SB_Instagram_Display_Elements_Pro::get_bio_data_attributes( $settings );
$header_link                = SB_Instagram_Display_Elements_Pro::get_header_link( $settings, $username );
$header_link_title          = SB_Instagram_Display_Elements_Pro::get_header_link_title( $settings, $username );

// Pro Elements
$post_count     = SB_Instagram_Parse_Pro::get_post_count( $header_data );
$follower_count = SB_Instagram_Parse_Pro::get_follower_count( $header_data );

// Pro Attributes
$follower_count_attribute = SB_Instagram_Display_Elements_Pro::get_follower_count_data_attributes( $settings );
$post_count_attribute     = SB_Instagram_Display_Elements_Pro::get_post_count_data_attributes( $settings );
?>
<div<?php echo $header_classes; ?> style="<?php echo $header_padding . $header_margin; ?>padding-bottom: 0;"<?php echo $header_atts; ?>>
    <a<?php echo $header_link ?> target="_blank" rel="nofollow noopener" <?php echo $header_link_title ?> class="sbi_header_link">
        <div<?php echo $header_text_class; ?>>
        <?php if ( SB_Instagram_Display_Elements_Pro::should_show_header_section( 'image-top', $settings ) ) : ?>
            <div class="sbi_header_img"<?php echo $header_image_atts_centered; ?>>
            <?php if ( $avatar !== '' || sbi_doing_customizer($settings) ):  ?>
                <div class="sbi_header_img_hover"><?php echo SB_Instagram_Display_Elements_Pro::get_icon( 'newlogo', 'svg' ); ?></div>
                <img<?php echo $avatar_el_atts; ?> width="50" height="50">
            <?php else: ?>
                <div class="sbi_header_hashtag_icon"><?php echo SB_Instagram_Display_Elements_Pro::get_icon( 'newlogo', 'svg' ); ?></div>
            <?php endif; ?>
            </div>
        <?php endif; ?>

            <h3<?php echo $header_text_color_style . $header_heading_attribute; ?>><?php echo esc_html( $username ); ?></h3>
            <p class="sbi_bio_info"<?php echo $header_text_color_style; ?>>
            <span class="sbi_posts_count"><?php echo SB_Instagram_Display_Elements_Pro::get_icon( 'photo', 'svg' ) . number_format_i18n( (int)$post_count, 0 ); ?></span>
            <?php if ( SB_Instagram_Display_Elements_Pro::should_show_element( 'headerfollowers', $settings ) ) : ?>
                <?php if ( $follower_count !== '' || ! empty( $follower_count_attribute ) ) : // basic display API does not include follower counts as of January 2020 ?>
                <span class="sbi_followers"<?php echo $follower_count_attribute; ?>><?php echo SB_Instagram_Display_Elements_Pro::get_icon( 'user', 'svg' ) . number_format_i18n( (int)$follower_count, 0 ); ?></span>
                <?php endif; ?>
            <?php endif; ?>
            </p>
        <?php if ( $should_show_bio ) : ?>
            <p class="sbi_bio"<?php echo $header_text_color_style . $bio_attribute; ?>><?php echo str_replace( '&lt;br /&gt;', '<br>', esc_html( nl2br( $bio ) ) ); ?></p>
        <?php endif; ?>
        </div>

    <?php if ( SB_Instagram_Display_Elements_Pro::should_show_header_section( 'image-bottom', $settings ) ) : ?>
        <div class="sbi_header_img"<?php echo $header_image_atts; ?>>
	        <?php if ( $avatar !== '' || sbi_doing_customizer($settings) ):  ?>
                <div class="sbi_header_img_hover"><?php echo SB_Instagram_Display_Elements_Pro::get_icon( 'newlogo', 'svg' ); ?></div>
                <img<?php echo $avatar_el_atts; ?> width="50" height="50">
	        <?php else: ?>
                <div class="sbi_header_hashtag_icon"><?php echo SB_Instagram_Display_Elements_Pro::get_icon( 'newlogo', 'svg' ); ?></div>
	        <?php endif; ?>
        </div>
    <?php endif; ?>

    </a>
</div>
