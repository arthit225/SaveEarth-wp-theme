<?php
/**
 * Instagram Feed Item Template
 * Adds an image, link, and other data for each post in the feed
 *
 * @version 6.0 Instagram Feed Pro by Smash Balloon
 *
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$classes             = SB_Instagram_Display_Elements_Pro::get_item_classes( $settings, $post );
$post_id             = SB_Instagram_Parse_Pro::get_post_id( $post );
$timestamp           = SB_Instagram_Parse_Pro::get_timestamp( $post );
$media_type          = SB_Instagram_Parse_Pro::get_media_type( $post );
$permalink           = SB_Instagram_Parse_Pro::get_permalink( $post );
$maybe_content       = SB_Instagram_Display_Elements_Pro::get_photo_wrap_content( $post, $settings );
$maybe_carousel_icon = $media_type === 'carousel' ? SB_Instagram_Display_Elements_Pro::get_icon( 'carousel', 'svg' ) : '';
$maybe_video_icon    = $media_type === 'video' ? SB_Instagram_Display_Elements_Pro::get_icon( 'video', 'svg' ) : '';
$media_url           = SB_Instagram_Display_Elements_Pro::get_optimum_media_url( $post, $settings, $resized_images );

$media_full_res          = SB_Instagram_Parse_Pro::get_media_url( $post );
$sbi_photo_style_element = SB_Instagram_Display_Elements_Pro::get_sbi_photo_style_element( $post, $settings, $resized_images );
$media_all_sizes_json    = SB_Instagram_Parse_Pro::get_media_src_set( $post, $resized_images );
$media_iframe_url      = SB_Instagram_Parse_Pro::get_iframe_url( $post );
$media_product_type    = SB_Instagram_Parse_Pro::get_media_video_type( $post );
$media_posted_on = SB_Instagram_Parse_Pro::get_posted_on_date( $post );

/**
 * Text that appears in the "alt" attribute for this image
 *
 * @param string $img_alt full caption for post
 * @param array $post api data for the post
 *
 * @since 5.2.6
 */
$img_alt = SB_Instagram_Parse_Pro::get_caption( $post, sprintf( __( 'Instagram post %s', 'instagram-feed' ), $post_id ) );
$img_alt = apply_filters( 'sbi_img_alt', $img_alt, $post );

/**
 * Text that appears in the visually hidden screen reader element
 *
 * @param string $img_screenreader first 50 characters for post
 * @param array $post api data for the post
 *
 * @since 5.2.6
 */
$img_screenreader = substr( SB_Instagram_Parse_Pro::get_caption( $post, sprintf( __( 'Instagram post %s', 'instagram-feed' ), $post_id ) ), 0, 50 );
$img_screenreader = apply_filters( 'sbi_img_screenreader', $img_screenreader, $post );

// Pro Elements
$caption                            = SB_Instagram_Parse_Pro::get_caption( $post, '' );
$sanitized_caption                  = SB_Instagram_Display_Elements_Pro::sanitize_caption( $caption );
$avatar                             = SB_Instagram_Parse_Pro::get_item_avatar( $post, $settings['feed_avatars'] );
$username                           = SB_Instagram_Parse_Pro::get_username( $post );
$likes_count                        = SB_Instagram_Parse_Pro::get_likes_count( $post );
$comments_count                     = SB_Instagram_Parse_Pro::get_comments_count( $post );
$comment_or_like_counts_data_exists = SB_Instagram_Parse_Pro::comment_or_like_counts_data_exists( $post ); // "basic display" API does not support comment or like counts as of January 2020
$location_info                      = SB_Instagram_Parse_Pro::get_location_info( $post ); // array( 'name' => $name, 'id' => $int, 'longitude' => $lon_int , 'lattitude' => $lat_int )
$lightbox_media_atts                = SB_Instagram_Parse_Pro::get_lightbox_media_atts( $post ); // array( 'video' => $url, 'carousel' => $json )
$sbi_link_classes                   = SB_Instagram_Display_Elements_Pro::get_sbi_link_classes( $settings ); // // ' sbi_disable_lightbox'
$sbi_item_attributes                = SB_Instagram_Display_Elements_Pro::get_sbi_item_attributes( $post, $settings ); // post item HTML attributes

// Pro Styles
$link_styles                = SB_Instagram_Display_Elements_Pro::get_sbi_link_styles( $settings ); // style="background: rgba(30,115,190,0.85)" already escaped
$hover_styles               = SB_Instagram_Display_Elements_Pro::get_hover_styles( $settings ); // style="color: rgba(153,231,255,1)" already escaped
$sbi_info_styles            = SB_Instagram_Display_Elements_Pro::get_sbi_info_styles( $settings ); // style="font-size: 13px;" already escaped
$sbi_meta_color_styles      = SB_Instagram_Display_Elements_Pro::get_sbi_meta_color_styles( $settings ); // style="font-size: 13px;" already escaped
$sbi_meta_size_color_styles = SB_Instagram_Display_Elements_Pro::get_sbi_meta_size_color_styles( $settings ); // style="font-size: 13px;color: rgba(153,231,255,1)" already escaped
$sbi_inner_wrapper_style    = SB_Instagram_Display_Elements_Pro::get_item_styles_for_post_style( $settings );

// Pro Attributes
$sbi_post_image_style_attribute = SB_Instagram_Display_Elements_Pro::get_post_image_style_attributes( $settings );

/**
 * Date string for date posted
 *
 * @param string $img_alt full caption for post
 * @param array $post api data for the post
 *
 * @since 5.6.3
 */
$posted_on_date_str = ucfirst( date_i18n( 'M j', $timestamp ) ); // ex. Feb 2
$posted_on_date_str = apply_filters( 'sbi_posted_on_date', $posted_on_date_str, $timestamp );

$hover_text_limit = isset( $settings['hovercaptionlength'] ) ? $settings['hovercaptionlength'] : $settings['captionlength'];
?>
<div class="sbi_item sbi_type_<?php echo esc_attr( $media_type ); ?><?php echo esc_attr( $classes ); ?>" id="sbi_<?php echo esc_attr( $post_id ); ?>" data-date="<?php echo esc_attr( $timestamp ); ?>" data-numcomments="<?php echo esc_attr( $comments_count ); ?>" <?php echo $sbi_item_attributes ?> >
    <div class="sbi_inner_wrap" <?php echo $sbi_inner_wrapper_style; ?>>
        <div class="sbi_photo_wrap" <?php echo $sbi_post_image_style_attribute; ?>>
		    <?php echo $maybe_content; ?>
		    <?php echo $maybe_carousel_icon; ?>
		    <?php echo $maybe_video_icon; ?>

            <div <?php echo $link_styles; ?> <?php echo $sbi_link_classes; ?>>
                <div class="sbi_hover_top">
				    <?php if ( sbi_doing_customizer( $settings ) || SB_Instagram_Display_Elements_Pro::should_show_element( 'hoverusername', $settings ) ) : ?>
                        <p class="sbi_username"<?php echo SB_Instagram_Display_Elements_Pro::get_hoverusername_data_attributes( $settings ); ?>>
                            <a href="<?php echo esc_url( 'https://www.instagram.com/' . $username . '/' ); ?>" target="_blank" rel="nofollow noopener" <?php echo $hover_styles; ?>><?php echo esc_html( $username ); ?></a>
                        </p>
				    <?php endif; ?>
				    <?php if ( sbi_doing_customizer( $settings ) || SB_Instagram_Display_Elements_Pro::should_show_element( 'hovercaption', $settings ) ) : ?>
                        <p class="sbi_hover_caption_wrap" <?php echo SB_Instagram_Display_Elements_Pro::get_hovercaption_data_attributes( $settings, $caption ); ?>>
                            <span class="sbi_caption"<?php echo $hover_styles; ?>><?php echo str_replace( '&lt;br&gt;', '<br>', esc_html( nl2br( $sanitized_caption ) ) ); ?></span>
                        </p>
				    <?php endif; ?>
                </div>
			    <?php if ( sbi_doing_customizer( $settings ) || SB_Instagram_Display_Elements_Pro::should_show_element( 'hoverinstagram', $settings ) ) : ?>
                    <a class="sbi_instagram_link" href="<?php echo esc_url( $permalink ); ?>"<?php echo SB_Instagram_Display_Elements_Pro::get_hoverinstagram_data_attributes( $settings ); ?> target="_blank" rel="nofollow noopener" title="Instagram" <?php echo $hover_styles; ?>>
                        <span class="sbi-screenreader"><?php _e( 'View', 'instagram-feed' ); ?></span>
					    <?php echo SB_Instagram_Display_Elements_Pro::get_icon( 'instagram', 'svg' ); ?>
                    </a>
			    <?php endif; ?>
                <div class="sbi_hover_bottom" <?php echo $hover_styles; ?>>
				    <?php if ( sbi_doing_customizer( $settings ) || ( ($timestamp > 0 && SB_Instagram_Display_Elements_Pro::should_show_element( 'hoverdate', $settings ))
				                                                      || (! empty( $location_info ) && SB_Instagram_Display_Elements_Pro::should_show_element( 'hoverlocation', $settings ) )) ) : ?>
                        <p>
						    <?php if ( sbi_doing_customizer( $settings ) || ($timestamp > 0 && SB_Instagram_Display_Elements_Pro::should_show_element( 'hoverdate', $settings )) ) : ?>
                                <span class="sbi_date"<?php echo SB_Instagram_Display_Elements_Pro::get_hoverdate_data_attributes( $settings ); ?>>
                        <?php echo SB_Instagram_Display_Elements_Pro::get_icon( 'date', 'svg' ); ?>
                        <?php echo esc_html( $posted_on_date_str ); ?></span>
						    <?php endif; ?>

						    <?php if ( ! empty( $location_info ) && SB_Instagram_Display_Elements_Pro::should_show_element( 'hoverlocation', $settings ) ) : ?>
                                <a href="<?php echo esc_url( 'https://www.instagram.com/explore/locations/' . $location_info['id'] . '/' ); ?>" class="sbi_location" target="_blank" rel="nofollow noopener" <?php echo $hover_styles; ?>data-lat="<?php echo esc_attr( $location_info['longitude'] ); ?>" data-long="<?php echo esc_attr( $location_info['lattitude'] ); ?>"><?php echo SB_Instagram_Display_Elements_Pro::get_icon( 'map_marker', 'svg' ); ?><?php echo esc_html( $location_info['name'] ); ?></a>
						    <?php endif; ?>
                        </p>
				    <?php endif; ?>
				    <?php if ( sbi_doing_customizer( $settings ) || ($comment_or_like_counts_data_exists && SB_Instagram_Display_Elements_Pro::should_show_element( 'hoverlikes', $settings )) ) : ?>
                        <div class="sbi_meta"<?php echo SB_Instagram_Display_Elements_Pro::get_hoverlikes_data_attributes( $settings ); ?>>
                    <span class="sbi_likes" <?php echo $hover_styles; ?>>
                        <?php echo SB_Instagram_Display_Elements_Pro::get_icon( 'likes', 'svg' ); ?>
                        <?php echo esc_html( $likes_count ); ?></span>
                            <span class="sbi_comments" <?php echo $hover_styles; ?>>
                        <?php echo SB_Instagram_Display_Elements_Pro::get_icon( 'comments', 'svg' ); ?>
                        <?php echo esc_html( $comments_count ); ?></span>
                        </div>
				    <?php endif; ?>
                </div>
                <a class="sbi_link_area nofancybox" href="<?php echo esc_url( $media_full_res ); ?>" rel="nofollow noopener" data-lightbox-sbi="" data-title="<?php echo str_replace( '&lt;br /&gt;', '&lt;br&gt;', esc_attr( nl2br( $caption ) ) ); ?>" data-video="<?php echo esc_attr( $lightbox_media_atts['video'] ); ?>" data-carousel="<?php echo esc_attr( $lightbox_media_atts['carousel'] ); ?>" data-id="sbi_<?php echo esc_attr( $post_id ); ?>" data-user="<?php echo esc_attr( $username ); ?>" data-url="<?php echo esc_attr( $permalink ); ?>" data-avatar="<?php echo esc_attr( $avatar ); ?>" data-account-type="<?php echo esc_attr( $account_type ); ?>" data-iframe='<?php echo esc_url( $media_iframe_url ); ?>' data-media-type="<?php echo esc_attr( $media_product_type ); ?>" data-posted-on="<?php echo esc_attr( $media_posted_on ); ?>">
                    <span class="sbi-screenreader"><?php _e( 'Open', 'instagram-feed' ); ?></span>
				    <?php echo $maybe_video_icon; ?>
                </a>
            </div>

            <a class="sbi_photo" href="<?php echo esc_url( $permalink ); ?>" target="_blank" rel="nofollow noopener" data-full-res="<?php echo esc_url( $media_full_res ); ?>" data-img-src-set="<?php echo esc_attr( sbi_json_encode( $media_all_sizes_json ) ); ?>"<?php echo $sbi_photo_style_element; ?>>
                <img src="<?php echo esc_url( $media_url ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>">
            </a>
        </div>

        <div class="sbi_info_wrapper">
            <div class="sbi_info">

		        <?php if ( sbi_doing_customizer( $settings ) || SB_Instagram_Display_Elements_Pro::should_show_element( 'caption', $settings ) ) : ?>
                    <p class="sbi_caption_wrap" <?php echo SB_Instagram_Display_Elements_Pro::get_caption_data_attributes( $settings, $caption, $post_id ); ?>>
                        <span class="sbi_caption" <?php echo $sbi_info_styles; ?>><?php echo str_replace( '&lt;br&gt;', '<br>', esc_html( nl2br( $sanitized_caption ) ) ); ?></span><span class="sbi_expand"> <a href="#"><span class="sbi_more">...</span></a></span>
                    </p>
		        <?php endif; ?>

		        <?php if ( sbi_doing_customizer( $settings ) || ($comment_or_like_counts_data_exists && SB_Instagram_Display_Elements_Pro::should_show_element( 'likes', $settings ) )) : ?>
                    <div class="sbi_meta" <?php echo $sbi_meta_color_styles; ?><?php echo SB_Instagram_Display_Elements_Pro::get_meta_data_attributes( $settings ); ?>>
            <span class="sbi_likes" <?php echo $sbi_meta_size_color_styles; ?>>
                <?php echo SB_Instagram_Display_Elements_Pro::get_icon( 'likes', 'svg', $sbi_meta_size_color_styles ); ?>
                <?php echo esc_html( $likes_count ); ?></span>
                        <span class="sbi_comments" <?php echo $sbi_meta_size_color_styles; ?>>
                <?php echo SB_Instagram_Display_Elements_Pro::get_icon( 'comments', 'svg', $sbi_meta_size_color_styles ); ?>
                <?php echo esc_html( $comments_count ); ?></span>
                    </div>
		        <?php endif; ?>

            </div>
        </div>
    </div>

</div>