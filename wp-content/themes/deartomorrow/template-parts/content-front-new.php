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
	<div class="entry-content">

        <?php
            $sliderArgs = array(
                'numberposts' => '4',
                'orderby' => 'rand',
                'post_type' => 'message',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'type',
                        'field' => 'slug',
                        'terms' => 'featured',
                    )
                ),
            );
        
            $slides = get_posts($sliderArgs);
            if ($slides) {
        ?>
        
                <div class="section slider">
                    <ul id="lightCarousel" class="cS-hidden">
                        <?php
                        foreach ($slides as $slide) {
                        ?>
                            <li class="carousel-item">
                                    <a href="<?php echo get_permalink($slide->ID); ?>" class="carousel-item-thumbnail"><?php echo get_the_post_thumbnail( $slide->ID, 'slider-thumb' ); ?></a>
                                    <h1><?php echo get_the_title($slide->ID); ?></h1>
                                    <?php echo get_excerpt_by_id($slide->ID); ?>
                                    <a href="<?php echo get_permalink($slide->ID); ?>" class="button view-slide">View this message</a>
                                    <a rel="m_PageScroll2id" href="#make_a_promise" class="button send-slide">Send a message</a>


                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
        
        
        <?php
            }
        
        
        
        echo '<div id="make_a_promise" class="section promise">';
        echo '<div class="promise-inner">';
        echo '<h1>Make a Promise Today</h1>';
        echo '<p>Think of a person important in your life - your child, a friend, a family member or your future self. Imagine it is 2050 and they receive a message from you written today. Your message shares your thoughts about climate change and your promise to take action to ensure they have a safe and healthy world.</p>';
        echo '<div class="promise-cta">';

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
            'return' => site_url() . '/send/letter/?qkSqiDxPFhHneETXisresponse=1&zwJJARSSKuDuresponseid=%post_id%#follow-up-questions',
            'submit_value' => __("Send Your Promise to the Future", 'acf'),
        );


            acf_form($settings);
        
        echo '</div> <!-- .promise-cta -->';
        echo '<div class="promise-image"><img src="' . get_site_url() . '/wp-content/themes/deartomorrow/images/send-a-message-2.jpg" border="0" alt="Mother and Child Looking to the Future" /></div>';
        echo '<div class="clear" style="width: 100%; clear: both; height: 1px; font-size: 1px; line-height: 1px;">&nbsp;</div>';
        echo '</div> <!-- .promise_inner -->';
        echo '</div> <!-- .section.promise -->';
    ?>
        <script>
            
            jQuery("#acf-_post_content").attr("placeholder", "Enter Your Message... ");        

            var cursorFocus = function(elem) {
              var x = window.scrollX, y = window.scrollY;
              elem.focus();
              window.scrollTo(x, y);
            }
            document.addEventListener('DOMContentLoaded', function() {
                var typed = new Typed('#acf-_post_title', {
                    strings: ["Send Your Message to the Future...^1500", "Dear Son...", "Dear Daughter...", "Dear Future Self...", "Dear Students...", "Dear Next Generation...", "Dear Grandchild...", "Dear Tomorrow...^1200 (Enter Your Salutation)^2000"],
                    typeSpeed: 10,
                    backSpeed: 10,
                    backDelay: 1000,
                    loop: true,
                    attr: 'placeholder',
                    bindInputFocusEvents: true,
                    showCursor: false,
                });
            });
        </script>
        
        <div class="section instagram">
            <h1>instagram</h1>
            <?php echo do_shortcode('[instagram-feed]'); ?>
        </div>
    <?php get_template_part( 'template-parts/newsletter' ); ?>
        
	</div><!-- .entry-content -->

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
</article><!-- #post-## -->
