<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package DearTomorrow
 */
$thesource = $_GET['source'];
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); echo ': ' . $thesource; ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_content();
        ?>
        We have partnered with <?php echo $thesource; ?> to share their messages to the future about their promise to take action on climate change.

        <div class="best-of-container">
            
        <?php
        
            $bestofargs = array(
                'posts_per_page'   => -1,
                'post_type'        => 'message',
                'post_status'      => 'publish',
                'fields'           => 'ids',
                  'tax_query' => array(
                    array(
                      'taxonomy' => 'type',
                      'field' => 'name',
                      'terms' => $thesource,
                      'include_children' => false
                    )
                  )
                );
        
            $bestofposts = get_posts( $bestofargs );
            foreach ( $bestofposts as $bopost ) { 
                $bothumb = wp_get_attachment_image_src( get_post_thumbnail_id($bopost), 'large', false, '' );
                $botext = get_excerpt_by_id($bopost);
            ?>
            <div class="best-of-item">
                <?php if ($bothumb) { ?> <a href="<?php echo get_permalink($bopost); ?>" class="best-of-thumbnail" style="background-image: url(<?php echo $bothumb[0]; ?>)">&nbsp;</a> <?php } ?>
                <?php if ($botext) { echo '<a class="best-of-text" href="' . get_permalink($bopost) . '">' . $botext . '</a>'; } ?>
            </div>
            <?php
            }
		?>
        </div><!-- .best-of-container -->
        <script>
        jQuery(function($){
          $(window).load(function(){

            // activate isotope:
            $('.best-of-container').isotope({
               itemSelector: 'div.best-of-item', layoutMode: 'masonry', percentPosition: true
            });

          });
        });
        </script>            
        
	</div><!-- .entry-content -->

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
</article><!-- #post-## -->
