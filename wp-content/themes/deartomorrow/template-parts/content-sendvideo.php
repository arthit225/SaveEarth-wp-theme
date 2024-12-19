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
        
        
        
        if ((isset($_GET['qkSqiDxPFhHneETXisresponse'])) && (isset($_GET['zwJJARSSKuDuresponseid'])) && (!empty($_GET['qkSqiDxPFhHneETXisresponse']))  && (!empty($_GET['zwJJARSSKuDuresponseid']))) {
            $settings = array(            
                'id'		=> 'response-followup',
                'post_id'	=> $_GET['zwJJARSSKuDuresponseid'],
                'post_title'=> true,
                'post_content'=> false,
                'uploader' => 'basic',
                'fields' => array('post_title', 'video_url', 'email_address', 'first_name', 'last_name', 'country', 'postal_code','instagram _username', 'twitter_username', 'subscribe_mailing_list', 'license', 'publish_anonymously'),
                'return' => site_url() . '/thanks/?qkSqiDxPFhHneETXisresponse=1&additionalCSnpDKlztbWrvvJU=1&zwJJARSSKuDuresponseid=%post_id%',
                'submit_value' => __("Send Your Promise to the Future", 'acf'),
            );
            echo '<h1 id="follow-up-questions">Thanks for submitting your photo!</h1>';
            echo '<p>Take a moment to review your message and tell us a little more about yourself so we can store and contact you about your message.</p>';
        }
        else {
            $settings = array(            
                'id'		=> 'new-response',
                'post_id'	=> 'new_post',
                'new_post'	=> array(
                    'post_type'		=> 'message',
                    'post_status'	=> 'draft',
                    'tax_input'     => array('type' => array(5))
                ),
                'post_title'=> true,
                'post_content'=> false,
                'fields' => array('post_title', 'video_url', 'email_address', 'first_name', 'last_name', 'country', 'postal_code', 'instagram _username', 'twitter_username', 'license', 'publish_anonymously'),
                'return' => site_url() . '/thanks/?qkSqiDxPFhHneETXisresponse=1&additionalCSnpDKlztbWrvvJU=1&zwJJARSSKuDuresponseid=%post_id%',
                'submit_value' => __("Send Your Promise to the Future", 'acf'),
            );
        }
            
            acf_form($settings);        
        
		?>
        
        
        <script>
            jQuery("#acf-_post_title").attr("placeholder", "Dear...");        
            jQuery("label[for='acf-_post_title']").html("Who is this video to? <span class='acf-required'>*</span>");        
            jQuery("label[for='acf-field_5b4e2845a8055']").html("Please upload your video YouTube or Vimeo and paste the link below. <span class='acf-required'>*</span>");        
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