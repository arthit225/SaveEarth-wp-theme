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
        <div id="entry-content-copy">
            <?php the_content(); ?>
        </div>
        
        
        <?php
        if ($_GET['lang'] == 'it') {
            $return_url = site_url() . '/grazie/?qkSqiDxPFhHneETXisresponse=1&additionalCSnpDKlztbWrvvJU=1&zwJJARSSKuDuresponseid=%post_id%&lang=it';
            $tax_array = array('type' => array(4,21));
        }
        else {
            $return_url = site_url() . '/thanks/?qkSqiDxPFhHneETXisresponse=1&additionalCSnpDKlztbWrvvJU=1&zwJJARSSKuDuresponseid=%post_id%';
            $tax_array = array('type' => array(4));
        }
        
        if ((isset($_GET['qkSqiDxPFhHneETXisresponse'])) && (isset($_GET['zwJJARSSKuDuresponseid'])) && (!empty($_GET['qkSqiDxPFhHneETXisresponse']))  && (!empty($_GET['zwJJARSSKuDuresponseid']))) {
            $settings = array(            
                'id'		=> 'response-followup',
                'post_id'	=> $_GET['zwJJARSSKuDuresponseid'],
                'post_title'=> true,
                'post_content'=> true,
                'uploader' => 'basic',
                'fields' => array('post_title', 'post_content', '_thumbnail_id', 'email_address', 'first_name', 'last_name', 'country', 'postal_code', 'twitter_username', 'subscribe_mailing_list', 'license', 'publish_anonymously'),
                'return' => $return_url,
                'submit_value' => __("Send Your Promise to the Future", 'acf'),
            );
            echo '<h1 id="follow-up-questions">Thanks for submitting your message!</h1>';
            echo '<p>Take a moment to review your message and tell us a little more about yourself so we can store and contact you about your message.</p>';
        }
        else {
            $settings = array(            
                'id'		=> 'new-response',
                'post_id'	=> 'new_post',
                'new_post'	=> array(
                    'post_type'		=> 'message',
                    'post_status'	=> 'draft',
                    'tax_input'     => $tax_array
                ),
                'post_title'=> true,
                'post_content'=> true,
                'fields' => array('post_title', 'post_content', '_thumbnail_id', 'email_address', 'first_name', 'last_name', 'country', 'postal_code','instagram _username', 'twitter_username', 'subscribe_mailing_list', 'license', 'publish_anonymously'),
                'return' => $return_url,
                'submit_value' => __("Send Your Promise to the Future", 'acf'),
            );
        }
            
            acf_form($settings);        
        
		?>
        <!-- here it is
<?php var_dump($tax_array); ?>

-->
        
        <script>
            jQuery("#acf-_post_title").attr("placeholder", "Enter a salutation like 'Dear Kris' or 'To My Grandchildren'");        
            jQuery("label[for='acf-_post_title']").html("Salutation <span class='acf-required'>*</span>");        
            jQuery("label[for='acf-_post_content']").html("Your Message <span class='acf-required'>*</span>");        
        </script>

        <?php 
            if ($_GET['lang']) {
                if ($_GET['lang'] == 'it') { ?>
                    <script>
                        jQuery(".section-title").html("Manda una tua lettera verso il futuro");
                        jQuery("#entry-content-copy").html("<p>Pensa ad una persona importante nella tua vita: tuo figlio, un amico, un membro della tua famiglia o  all’immagine di te in un futuro. Immagina che sia il 2050 e che questa persona riceva una lettera scritta da te oggi. La tua lettera condivide i tuoi pensieri sul cambiamento climatico ed esprime la tua promessa di agire per garantire  un mondo sicuro a questa persona importante nella tua vita.</p><p>Scrivi quella lettera oggi stesso. Condivideremo la tua lettera ora e la conserveremo per il futuro.</p>");
                        jQuery("#acf-_post_title").attr("placeholder", " ");        
                        jQuery("label[for='acf-_post_title']").html("Saluto <span class='acf-required'>*</span>");        
                        jQuery("label[for='acf-_post_content']").html("Il tuo messaggio <span class='acf-required'>*</span>");        
                        jQuery("label[for='acf-field_5b4fbb02cf769']").html("Aggiungi una foto o un'immagine");        
                        jQuery(".acf-field-image .acf-label .description").html("Si prega di caricare una foto da includere nel messaggio se si desidera che il proprio messaggio sia candidato per essere messo in primo piano sul nostro sito.");        

                        jQuery("label[for='acf-field_5b4e2732f0083']").html("Indirizzo e-mail <span class='acf-required'>*</span>");        
                        jQuery("label[for='acf-field_5b4e2739f0084']").html("Nome");        
                        jQuery("label[for='acf-field_5b4e2743f0085']").html("Cognome");        
                        jQuery("label[for='acf-field_5b4e274ff0086']").html("Paese");        
                        jQuery("label[for='acf-field_5b4e278bf0087']").html("Codice postale");        
                        jQuery("label[for='acf-field_5b4e27f80256a']").html("Nome utente Twitter");        

                        jQuery("label[for='acf-field_5ddd79877b5bf']").html("Iscriviti alla nostra Mailing List");        
                        jQuery(".acf-field-5ddd79877b5bf .acf-label .description").html("Vuoi iscriverti alla mailing list “Dear Tomorrow” per ricevere importanti aggiornamenti e notizie su attività ed eventi (un totale stimato a 10-12 email all'anno)?");        
                        jQuery(".acf-field-5ddd79877b5bf .acf-input .acf-checkbox-list label").html("<input type='checkbox' id='acf-field_5ddd79877b5bf-1' name='acf[field_5ddd79877b5bf][]' value='1'> Sì! Iscrivetemi alla lista");

                        jQuery("label[for='acf-field_5b4fcee279b32']").html("Licenza");        
                        jQuery(".acf-field-5b4fcee279b32 .acf-label .description").html("Grazie mille per aver contribuito con un messaggio a DearTomorrow.org. Ci auguriamo che il vostro messaggio migliori la consapevolezza del pubblico e aumenti la motivazione individuale ad agire sul cambiamento climatico. Cerchiamo anche di preservare i messaggi per ricerche future e per aiutare a sviluppare l’interesse a questo tema da parte delle prossime generazioni. Come parte dell'archivio, stiamo lavorando per creare una capsula del tempo contenente messaggi che stanno  disponibili al pubblico negli anni 2030 e 2050. Accettando questa licenza, confermi che questo è il tuo lavoro originale (hai creato tu la foto) e dai il permesso a DearTomorrow e ai suoi incaricati di condividere i messaggi e le foto (anche online) e di adattarli in accordo con una licenza Creative Commons Attribution-NonCommercial 4.0 International. Nota bene: DearTomorrow si riserva il diritto di non pubblicare lettere, foto e video che non rientrino nell'ambito del progetto o che violino le leggi sul copyright.");
                        jQuery(".acf-field-5b4fcee279b32 .acf-input .acf-checkbox-list label").html("<input type='checkbox' id='acf-field_5b4fcee279b32-I-agree-to-this-license' name='acf[field_5b4fcee279b32][]' value='Accetto questa licenza'> Accetto questa licenza");        

                        jQuery("label[for='acf-field_5b4e27a9f0088']").html("Pubblicare in forma anonima");        
                        jQuery(".acf-field-5b4e27a9f0088 .acf-label .description").html("Potete pubblicare il vostro messaggio con o senza il vostro nome sul sito web o sull'archivio. Spunta le caselle sottostanti se vuoi rimanere anonimo.");        
                        jQuery(".acf-field-5b4e27a9f0088 .acf-input .acf-checkbox-list label").html("<input type='checkbox' id='acf-field_5b4e27a9f0088-i_want_my_message_published_on_the_website_anonymously' name='acf[field_5b4e27a9f0088][]' value='i_want_my_message_published_on_the_website_anonymously'> Voglio che il mio messaggio sia pubblicato sul sito web in forma anonima");        
                        
                        
                        jQuery(".acf-form-submit input[type='submit']").attr("value", "Manda una tua lettera");        
                        var input = jQuery("<input>")
                                       .attr("type", "hidden")
                                       .attr("name", "lang").val("it");
                        jQuery('#new-response').append(input);
                        jQuery('#response-followup').append(input);
                    </script>
        
                <?php    
                }

            }
        ?>
        
        
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