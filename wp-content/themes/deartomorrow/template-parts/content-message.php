<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package deartomorrow
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    <header class="section-header">
        <?php if( !has_term( 'video', 'type' ) ) { ?>
            <?php if ( has_post_thumbnail() ) : ?>
                <div class="message-image-header"  style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>);">
                   <div class="message-image-header-excerpt">
                       <?php the_excerpt(); ?>
                        <a rel="m_PageScroll2id" href="#the-message-content" class="scroll-down" aria-hidden="true"><img class="aligncenter"  src="<?php echo get_site_url(); ?>/wp-content/themes/deartomorrow/images/two-down-chevron.png" /></a>
                    </div>
                </div>
            <?php endif; ?>
        <?php } ?>
        
        
        <div class="message-meta">

        
            Sent on 
            <div class="post-date"><?php the_date() ?></div>
            by
            <div class="author name-of-person">
                <?php
                    $is_anon = get_field('publish_anonymously');
                    if ( $is_anon && in_array('i_want_my_message_published_on_the_website_anonymously', $is_anon) ){  ?>
                        Anonymous
                <?php
                    }
                    else {
                        echo get_field('first_name') . ' ' . get_field('last_name');
                         }
                ?>
            </div>        
        
        
            <a href="#send-your-own" rel="m_PageScroll2id" class="button message-send-scroll">Send Your Own Message</a>
            
        </div>
	</header><!-- .section-header -->


	<div id="the-message-content" class="entry-content">
        <h1 class="section-title" style="text-align: center;"><?php the_title(); ?></h1>
        <?php if ( has_post_thumbnail() ) : ?>
            <div class="message-thumbnail">
                <a href="<?php echo get_the_post_thumbnail_url(); ?>"><?php the_post_thumbnail('large'); ?></a>
            </div>
        <?php endif; ?>        
		<?php
        
            $video_url = get_field('video_url');
            if (($video_url) && ($video_url != '')) {
                $video_domain = parse_url($video_url, PHP_URL_HOST);

                if ($video_domain == 'vimeo.com') {
                    // Show Vimeo Embed Code
                    $video_id = parse_url($resource_video_url, PHP_URL_PATH);
                    $vimeo_api = unserialize(file_get_contents("http://vimeo.com/api/v2/video$video_id.php"));
                    $video_img = $vimeo_api[0]['thumbnail_large'];
                    $video_href = '//player.vimeo.com/video'. $video_id;
                }
                elseif ($video_domain == 'www.youtube.com') {
                    //Show Youtube Embed Code
                    parse_str( parse_url( $resource_video_url, PHP_URL_QUERY ), $my_array_of_vars );
                    $video_id = $my_array_of_vars['v'];
                    $video_img = 'http://i3.ytimg.com/vi/' . $video_id . '/hqdefault.jpg';
                    $video_href = '//www.youtube.com/embed/'. $video_id;
                }
                elseif ($video_domain == 'youtu.be') {
                    //Show Youtube Embed Code
                    $video_id = parse_url($resource_video_url, PHP_URL_PATH);

                    $video_img = 'http://i3.ytimg.com/vi' . $video_id . '/hqdefault.jpg';
                    $video_href = 'https://www.youtube.com/embed' . $video_id;
                }
                elseif ($video_domain == 'players.brightcove.net') {
                    //Show Brightcove Embed Code
                    parse_str( parse_url( $resource_video_url, PHP_URL_QUERY ), $my_array_of_vars );

                    $video_path = parse_url($resource_video_url, PHP_URL_PATH);
                    $video_id = $my_array_of_vars['videoId'];
                    $video_href = '//players.brightcove.net' . $video_path . '?videoId=' . $video_id;
                }
                elseif ($video_domain == 'www.wevideo.com') {
                    //Show We Video Embed Code
                    $video_href = $video_url;
                }
                echo '<iframe class="video_embed" width="100%" height="450" src="' . $video_href . '" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';            
            
            
            }
        
			the_content();
        
        
		?>
        <div class="clear" style="width: 100%; clear: both; height: 1px; font-size: 1px; line-height: 1px;">&nbsp;</div>
        <a href="#send-your-own" rel="m_PageScroll2id" class="button message-send-scroll">Send Your Own Message</a>
        
	</div><!-- .entry-content -->


    
    
    <?php
    
    $moreargs = array(
        'posts_per_page'   => 12,
        'orderby'          => 'rand', 
        'post_type'        => 'message',
        'post_status'      => 'publish',
        'suppress_filters' => false,
        'exclude'          => get_the_ID(),
          'meta_query' => array(
             array(
                'key' => '_thumbnail_id',
                'value' => array(''),
                'compare' => 'NOT IN' 
             )
          ),
    );
    add_filter( 'posts_where' , 'posts_where_excerpt_not_empty' );
    $moreposts = get_posts($moreargs);
    remove_filter( 'posts_where' , 'posts_where_excerpt_not_empty' );
    
    if ($moreposts) {
        echo '<div class="message-more">';
        echo '<h2>More Messages to the Future</h2>';
        echo '<div class="grid">';
            
        foreach ( $moreposts as $mpost ) : setup_postdata( $mpost ); 


        
            $element_class = array('element-item', 'has_thumbnail');
        
            $message_types = wp_get_post_terms( $mpost->ID, 'type' );
        


        foreach ($message_types as $type) {
                array_push($element_class, 'message-type-' . $type->slug);
            }
        
            $caption_excerpt = get_excerpt_by_id($mpost->ID);
            $caption_excerpt = str_replace('"', "", $caption_excerpt);
            $caption_excerpt = str_replace("'", "", $caption_excerpt);
        ?>
            <a href="<?php echo esc_url( get_permalink($mpost->ID) ); ?>" id="post-<?php the_ID(); ?>" <?php post_class($element_class); ?>>
                <?php
                    echo '<div class="element-item-thumbnail" style="background-image: url(' . get_the_post_thumbnail_url($mpost->ID,'large') . ');">&nbsp;</div>';
                ?>
                <div class="entry-content">
                    <?php
                        echo '<p class="message-archive-title">' . get_the_title($mpost->ID) . '</p>';
                        echo '<span class="message-archive-excerpt">' . $caption_excerpt . '</span>';

                    ?>
                </div><!-- .entry-content -->

            </a><!-- #post-## -->
        <?php endforeach; 
        wp_reset_postdata();

            
        
        echo '</div>'; // end grid
        echo '<a class="button" href="'. get_site_url() . '/message/">View All Messages</a>';
        echo '</div>'; // end .message-more">';
    }
    ?>
    <div class="message-send-message" id="send-your-own">
        <h2>Send Your Own Message</h2>
        <?php
            $settings = array(            
                'id'		=> 'new-response',
                'post_id'	=> 'new_post',
                'new_post'	=> array(
                    'post_type'		=> 'message',
                    'post_status'	=> 'draft',
                    'tax_input'     => array('type' => array(4))
                ),
                'post_title'=> true,
                'post_content'=> true,
                'fields' => array('post_content'),
                'html_after_fields' => '<input type="hidden" name="acf[field_5b2e7bd532824]" value="57" />',
                'return' => site_url() . '/send-message/?qkSqiDxPFhHneETXisresponse=1&zwJJARSSKuDuresponseid=%post_id%#follow-up-questions',
                'submit_value' => __("Send Your Promise to the Future", 'acf'),
            );

            acf_form($settings);
        ?>
        <script>
            jQuery("#acf-_post_title").attr("placeholder", "Enter a salutation like 'Dear Kris' or 'To My Grandchildren'");
            jQuery("#acf-_post_content").attr("placeholder", "Enter Your Message... ");
            jQuery("label[for='acf-_post_title']").html("Salutation <span class='acf-required'>*</span>");        
            jQuery("label[for='acf-_post_content']").html("Your Message <span class='acf-required'>*</span>");        
        </script>
    </div>
    
	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'deartomorrow' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
    <?php get_template_part( 'template-parts/newsletter' ); ?>
</article><!-- #post-## -->