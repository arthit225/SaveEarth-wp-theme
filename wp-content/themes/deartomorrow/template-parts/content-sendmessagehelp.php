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
        <h1 class="section-title"><?php echo get_the_title(); ?></h1>
	</header><!-- .section-header -->


	<div class="entry-content">
        
		<?php
			the_content();
        
            $settings = array(            
                'id'		=> 'new-response',
                'post_id'	=> 'new_post',
                'new_post'	=> array(
                    'post_type'		=> 'message',
                    'post_status'	=> 'draft',
                    'tax_input'     => array('type' => array(4, 18))
                ),
                'post_title'=> true,
                'post_content'=> true,
                'fields' => array('post_title', 'post_content', 'help_your_thoughts_about_climate_change', 'help_your_hopes_for_the_future', 'help_your_promise', '_thumbnail_id', 'email_address', 'first_name', 'last_name', 'country', 'postal_code', 'twitter_username', 'subscribe_mailing_list', 'license', 'publish_anonymously'),
                'return' => site_url() . '/thanks/?qkSqiDxPFhHneETXisresponse=1&additionalCSnpDKlztbWrvvJU=1&zwJJARSSKuDuresponseid=%post_id%',
                'submit_value' => __("Send Your Promise to the Future", 'acf'),
            );
            
            acf_form($settings);        
        
		?>
        
        
        <script>
            jQuery("#acf-_post_title").attr("placeholder", "Enter a salutation like 'Dear Alice' or 'To My Future Son'");
            jQuery("#acf-_post_content").attr("placeholder", "Enter a memory, one of their unique characteristics, something you/they love, a place you want to preserve.");
            
            jQuery("label[for='acf-_post_title']").html("Salutation <span class='acf-required'>*</span>");        
            jQuery("label[for='acf-_post_content']").html("Share with your child, grandchild or recipient something special about you or them. <span class='acf-required'>*</span>");        
        </script>
        
        
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