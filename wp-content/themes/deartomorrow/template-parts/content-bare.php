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
        <h1 class="section-title"><?php echo $section_title; ?></h1>
	</header><!-- .section-header -->


	<div class="entry-content">
    <?php if ((isset($page_title)) && ($page_title != '')) { ?>    
    <div class="entry-header" <?php if (get_field('intro_section_color')) {echo 'style="background-color: ' . get_field('intro_section_color') .'"'; } ?>>
        <div class="entry-header-inner">            
            <h1 class="entry-title"><?php echo $page_title; ?></h1>
        </div>
	</div><!-- .entry-header -->
    <?php } ?>
        
		<?php
        $responseid = $_GET['zwJJARSSKuDuresponseid'];
        if (($responseid) && ($responseid != '')) {
            echo '<div class="partnership-leader">In partnership with ' .  get_field('partner_source', $responseid) . '</div>';
        }
        
        
			the_content();
        
        $partner_source = get_field('partner_source');

        
        
        if (($partner_source) && ($partner_source != '')) {
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
                'fields' => array('post_title', 'post_content', '_thumbnail_id', 'email_address', 'first_name', 'last_name', 'country', 'postal_code', 'twitter_username', 'license', 'publish_anonymously', 'partner_source'),
                'return' => site_url() . '/thanks-partner/?qkSqiDxPFhHneETXisresponse=1&additionalCSnpDKlztbWrvvJU=1&zwJJARSSKuDuresponseid=%post_id%',
                'submit_value' => __("Send Your Promise to the Future", 'acf'),
            );
            acf_form($settings);        
        }
        else {
            /*$settings = array(            
                'id'		=> 'new-response',
                'post_id'	=> 'new_post',
                'new_post'	=> array(
                    'post_type'		=> 'message',
                    'post_status'	=> 'draft',
                    'tax_input'     => array('type' => array(4))
                ),
                'post_title'=> true,
                'post_content'=> true,
                'fields' => array('post_title', 'post_content', '_thumbnail_id', 'email_address', 'first_name', 'last_name', 'country', 'postal_code', 'twitter_username', 'license', 'publish_anonymously'),
                'return' => site_url() . '/thanks-partner/?qkSqiDxPFhHneETXisresponse=1&additionalCSnpDKlztbWrvvJU=1&zwJJARSSKuDuresponseid=%post_id%',
                'submit_value' => __("Send Your Promise to the Future", 'acf'),
            );*/
        }
            
        
		?>
        
        
        <script>
            jQuery("#acf-_post_title").attr("placeholder", "Enter a salutation like 'Dear Kris' or 'To My Grandchildren'");        
            jQuery("label[for='acf-_post_title']").html("Salutation <span class='acf-required'>*</span>");        
            jQuery("label[for='acf-_post_content']").html("Your Message <span class='acf-required'>*</span>"); 
        </script>
        <?php
            if ($partner_source) {
                echo '
                <script>
                    jQuery("input#acf-field_5bd0a910096e3").attr("value", "' . $partner_source . '");        
                    jQuery("input#acf-field_5bd0a910096e3").attr("readonly", "readonly");        
                </script>';

            }
        ?>
        
    <?php if( current_user_can('editor') || current_user_can('administrator') ) {  ?>
        <h2>Copy/Paste Embed Code</h2>
        <textarea style="padding: 0px; height: 100px; font-family: monospace; font-size: 12px !important"><iframe style="border: 0px #ffffff none;" src="<?php echo get_permalink(); ?>" name="dtembedframe" width="100%" height="400px" frameborder="0" marginwidth="0px" marginheight="0px" scrolling="yes" allowfullscreen="allowfullscreen"></iframe></textarea>

    <?php } ?>
        
	</div><!-- .entry-content -->
</article><!-- #post-## -->