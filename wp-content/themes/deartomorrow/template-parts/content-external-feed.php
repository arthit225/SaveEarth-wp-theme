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
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_content();
        ?>
        <div class="message-feed-container">
        <?php
        
        
            $srcfeedargs = array(
                'posts_per_page'   => -1,
                'post_type'        => 'message',
                'post_status'      => 'publish',
                'fields'           => 'ids',
                'meta_key'         => 'usp-custom-9',
                'meta_value'       => $thesource,
                );
        
            $srcfeedposts = get_posts( $srcfeedargs );
            foreach ( $srcfeedposts as $srcpost ) { 
                $srcthumb = wp_get_attachment_image_src( get_post_thumbnail_id($srcpost), 'thumbnail', false, '' );
                $srctext = get_excerpt_by_id($srcpost);
            ?>
            <div class="message-feed-item">
                <?php if ($srcthumb) { ?> <a href="<?php echo get_permalink($srcpost); ?>" class="message-feed-thumbnail" style="background-image: url(<?php echo $srcthumb[0]; ?>)">&nbsp;</a> <?php } ?>
                <?php if ($srctext) { echo '<a class="message-feed-text" href="' . get_permalink($srcpost) . '">' . $srctext . '</a>'; } ?>
                <div class="clear" style="height: 1px; line-height: 1px; font-size: 1px; clear: both; width: 100%;">&nbsp;</div>
            </div>
            <?php
            }
		?>
        </div><!-- .message-feed-container -->
        <script>
        jQuery(function($){
          $(window).load(function(){

          });
        });
        </script>            
        
	</div><!-- .entry-content -->

</article><!-- #post-## -->
