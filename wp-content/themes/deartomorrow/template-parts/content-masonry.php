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
    <header class="entry-header">
        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>        
	</header><!-- .entry-header -->

	<div class="entry-content">
        <?php
            if(isset($_GET['updated'])) {
                   echo '<h2>Your Resource has been saved!  It needs to be approved by an NYU Access staff members.  Keep checking back!</h2>';
            }
        ?>

        
		<?php
			the_content();
        ?>
        
        <div id="filters" class="button-group filter-button-group">
            
            <div class="filter-topics">
                <!-- <h4>Topics</h4> -->
            <?php
                
            $terms = get_terms( 'category', array('exclude' => array( 1 )) );
                
            if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
                foreach ( $terms as $term ) {
                    echo '<button ';
                    if ($_GET['t'] == $term->slug) {
                        echo 'id="firstfilter" ';
                    }
                    echo 'data-filter=".type-' . $term->slug . '">' . $term->name . '</button>';
                }
            }            
            ?>
            <button data-filter="*">Show All</button>
            </div>
            
        </div>
        <input type="text" id="quicksearch" placeholder="Search Resources" />

        <div class="clear">&nbsp;</div>
        
        <div class="grid">
        <?php
            
            $masonry_post_type = get_field('masonry_post_type');
            
            $args = array( 
                'posts_per_page' => -1,
                'post_type' => $masonry_post_type,
                'orderby' => 'menu_order'
            );

            $myitems = get_posts( $args );
            foreach ( $myitems as $item ) { 
                
                
                $type_array = get_the_terms( $item->ID, 'category' );
                $format_array = get_field('resource_type',  $item->ID);
                $type_classes = '';
                if ($type_array) {
                    foreach( $type_array as $type_class ) {
                        $type_classes .= 'type-' . $type_class->slug . ' ';
                    }
                }
                
                if (in_array("link", $format_array)) {
                    $the_link = get_field('resource_link_url', $item->ID);
                    $the_target = '_blank';
                }
                else {
                    $the_link = get_permalink($item->ID);
                    $the_target = '_self';
                }
                

        ?>
            <a href="<?php echo $the_link; ?>" target="<?php echo $the_target; ?>" class="element-item <?php echo $type_classes; ?>">
               <?php 
                $this_post_thumbnail = get_the_post_thumbnail( $item->ID, 'large', array( 'alt' => 'Image for ' . $item->post_title ) );
                if ($this_post_thumbnail != '') {
                    echo $this_post_thumbnail;
                }
                ?>
                <h3 class="item_title"><?php echo $item->post_title; ?></h3>
            </a>
                
         <?php   
            } 
         ?>
        </div>
        
<script>
jQuery(function($){
  $(window).load(function(){

var qsRegex;
var buttonFilter;

// init Isotope
var $grid = $('.grid').isotope({
  itemSelector: '.element-item',
  layoutMode: 'masonry',
  filter: function() {
    var $this = $(this);
    var searchResult = qsRegex ? $this.text().match( qsRegex ) : true;
    var buttonResult = buttonFilter ? $this.is( buttonFilter ) : true;
    return searchResult && buttonResult;
  }
});

$('#filters').on( 'click', 'button', function() {
  buttonFilter = $( this ).attr('data-filter');
  $grid.isotope();
});

// use value of search field to filter
var $quicksearch = $('#quicksearch').keyup( debounce( function() {
  qsRegex = new RegExp( $quicksearch.val(), 'gi' );
  $grid.isotope();
}) );


  // change is-checked class on buttons
$('.button-group').each( function( i, buttonGroup ) {
  var $buttonGroup = $( buttonGroup );
  $buttonGroup.on( 'click', 'button', function() {
    $buttonGroup.find('.selected').removeClass('selected');
    $( this ).addClass('selected');
  });
});
  

// debounce so filtering doesn't happen every millisecond
function debounce( fn, threshold ) {
  var timeout;
  return function debounced() {
    if ( timeout ) {
      clearTimeout( timeout );
    }
    function delayed() {
      fn();
      timeout = null;
    }
    setTimeout( delayed, threshold || 100 );
  };
}
  
  });
});
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