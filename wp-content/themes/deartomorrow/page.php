<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package deartomorrow
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );


			endwhile; // End of the loop.
            
            if (isset($_GET['qkSqiDxPFhHneETXisresponse']) && isset($_GET['zwJJARSSKuDuresponseid'])) {
                $responseid = $_GET['zwJJARSSKuDuresponseid'];
                
                $subscribe_array = get_field('subscribe_mailing_list', $responseid);
                $subscribe_me = $subscribe_array[0];
                if ($subscribe_me == '1') {
                    
                    $sub_email = get_field('email_address', $responseid);
                    $sub_fname = get_field('first_name', $responseid);
                    $sub_lname = get_field('last_name', $responseid);

                    $list_id = '96b9b6ae65';
                    $authToken = 'd8846fffacbb83566efd5f71f1e41cc6-us13';
                    // The data to send to the API

                    $postData = array(
                        "email_address" => $sub_email, 
                        "status" => "subscribed", 
                        "merge_fields" => array(
                            "FNAME"=> $sub_fname,
                            "LNAME"=> $sub_lname,
                        ),
                    );

                    // Setup cURL
                    $ch = curl_init('https://us13.api.mailchimp.com/3.0/lists/'.$list_id.'/members/');
                    curl_setopt_array($ch, array(
                        CURLOPT_POST => TRUE,
                        CURLOPT_RETURNTRANSFER => TRUE,
                        CURLOPT_HTTPHEADER => array(
                            'Authorization: apikey '.$authToken,
                            'Content-Type: application/json'
                        ),
                        CURLOPT_POSTFIELDS => json_encode($postData)
                    ));
                    // Send the request
                    $response = curl_exec($ch);
                
                }
                
                
            }
            
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
