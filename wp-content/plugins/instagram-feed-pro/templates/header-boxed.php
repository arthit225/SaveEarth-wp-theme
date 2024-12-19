<?php
/**
 * Custom Feeds for Instagram Header Boxed Template
 * Adds account information and an avatar to the top of the feed
 *
 * @version 6.0 Custom Feeds for Instagram Pro by Smash Balloon
 *
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
// Elements
$bio      = SB_Instagram_Parse_Pro::get_bio( $header_data, $settings );
$username = SB_Instagram_Parse_Pro::get_username( $header_data );
$avatar   = SB_Instagram_Parse_Pro::get_avatar( $header_data, $settings );
$name     = SB_Instagram_Parse_Pro::get_name( $header_data );

// Attributes
$header_atts             = SB_Instagram_Display_Elements_Pro::get_header_data_attributes( 'boxed', $settings, $header_data );
$header_image_atts       = SB_Instagram_Display_Elements_Pro::get_header_img_data_attributes( $settings, $header_data );
$header_classes          = SB_Instagram_Display_Elements_Pro::get_header_class( $settings, $avatar, 'boxed' );
$avatar_el_atts          = SB_Instagram_Display_Elements_Pro::get_avatar_element_data_attributes( $settings, $header_data );
$header_text_color_style = SB_Instagram_Display_Elements_Pro::get_header_text_color_styles( $settings ); // style="color: #517fa4;"
$header_link             = SB_Instagram_Display_Elements_Pro::get_header_link( $settings, $username );
$header_link_title       = SB_Instagram_Display_Elements_Pro::get_header_link_title( $settings, $username );
$should_show_bio         = $bio !== '' ? SB_Instagram_Display_Elements_Pro::should_show_element( 'headerbio', $settings ) : false;
$bio_class               = ! $should_show_bio ? ' sbi_no_bio' : '';
$header_text_class       = SB_Instagram_Display_Elements_Pro::get_header_text_class( $header_data, $settings );
$bio_attribute           = SB_Instagram_Display_Elements_Pro::get_bio_data_attributes( $settings );

// Pro Elements
$post_count     = SB_Instagram_Parse_Pro::get_post_count( $header_data );
$follower_count = SB_Instagram_Parse_Pro::get_follower_count( $header_data );

// Pro Attributes
$post_count_attribute     = SB_Instagram_Display_Elements_Pro::get_post_count_data_attributes( $settings, $header_data );
$follower_count_attribute = SB_Instagram_Display_Elements_Pro::get_follower_count_data_attributes( $settings, $header_data );

// Boxed Header Specific
$follow_button_text = __( $settings['followtext'], 'instagram-feed' );
$has_info           = $should_show_bio || SB_Instagram_Display_Elements_Pro::should_show_element( 'headerfollowers', $settings );
$info_class         = ! $has_info ? ' sbi_no_info' : '';
$avatar_class       = $avatar !== '' ? '' : ' sbi_no_avatar';
$header_style       = SB_Instagram_Display_Elements_Pro::get_boxed_header_styles( $settings ); // style="background: #517fa4;" already escaped
$header_bar_style   = SB_Instagram_Display_Elements_Pro::get_header_bar_styles( $settings ); // style="background: #eeeeee;" already escaped
$header_info_style  = SB_Instagram_Display_Elements_Pro::get_header_info_styles( $settings ); // style="color: #517fa4;" already escaped
$follow_btn_style   = SB_Instagram_Display_Elements_Pro::get_follow_styles( $settings ); // style="background: rgb();color: rgb();" already escaped
$follow_btn_classes = strpos( $follow_btn_style, 'background' ) !== false ? ' sbi_custom' : '';
$follow_attribute   = SB_Instagram_Display_Elements_Pro::get_follow_attribute( $settings );
?>
<div<?php echo $header_classes; ?><?php echo $header_style; ?><?php echo $header_atts; ?>>
    <a<?php echo $header_link; ?> class="sbi_header_link" target="_blank" rel="nofollow noopener"<?php echo $header_link_title; ?>>
        <div class="sbi_header_text<?php echo esc_attr( $bio_class ) . esc_attr( $info_class ); ?>">
            <h3<?php echo $header_text_color_style; ?>><?php echo esc_html( $username ); ?></h3>
            <?php if ( $should_show_bio ) : ?>
                <p class="sbi_bio"<?php echo $header_text_color_style; ?><?php echo $bio_attribute; ?>><?php echo str_replace( '&lt;br /&gt;', '<br>', esc_html( nl2br( $bio ) ) ); ?></p>
            <?php endif; ?>
        </div>
        <div class="sbi_header_img" <?php echo $header_image_atts; ?>>
            <?php if ( $avatar !== '' || sbi_doing_customizer($settings) ):  ?>
                <div class="sbi_header_img_hover"><?php echo SB_Instagram_Display_Elements_Pro::get_icon( 'newlogo', 'svg' ); ?></div>
                <img<?php echo $avatar_el_atts; ?> width="50" height="50">
            <?php else: ?>
                <div class="sbi_header_hashtag_icon"><?php echo SB_Instagram_Display_Elements_Pro::get_icon( 'newlogo', 'svg' ); ?></div>

            <?php endif; ?>

        </div>
    </a>

    <div class="sbi_header_bar" <?php echo $header_bar_style; ?>>
        <p class="sbi_bio_info" <?php echo $header_info_style; ?>>
        <span class="sbi_posts_count"><?php echo SB_Instagram_Display_Elements_Pro::get_icon( 'photo', 'svg' ) . number_format_i18n( (int)$post_count, 0 ); ?></span>
        <?php if ( SB_Instagram_Display_Elements_Pro::should_show_element( 'headerfollowers', $settings ) ) : ?>
            <?php if ( $follower_count !== '' || ! empty( $follower_count_attribute ) ) : // basic display API does not include follower counts as of January 2020 ?>
            <span class="sbi_followers"<?php echo $follower_count_attribute; ?>><?php echo SB_Instagram_Display_Elements_Pro::get_icon( 'user', 'svg' ) . number_format_i18n( (int)$follower_count, 0 ); ?></span>
            <?php endif; ?>
        <?php endif; ?>
        </p>
        <a class="sbi_header_follow_btn<?php echo esc_attr( $follow_btn_classes ); ?>"<?php echo $header_link; ?> target="_blank" rel="nofollow noopener" <?php echo $follow_btn_style; ?>>
            <?php echo SB_Instagram_Display_Elements_Pro::get_icon( 'instagram', 'svg' ); ?>
            <span <?php echo $follow_attribute; ?>><?php echo esc_html( $follow_button_text ); ?></span>
        </a>
    </div>
</div>