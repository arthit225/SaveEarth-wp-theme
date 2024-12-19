<?php
/**
 * deartomorrow functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package deartomorrow
 */

if ( ! function_exists( 'deartomorrow_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function deartomorrow_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on deartomorrow, use a find and replace
	 * to change 'deartomorrow' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'deartomorrow', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
    
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
    add_image_size( 'blog-thumb', 600, 300, true ); // Hard Crop Mode
    add_image_size( 'slider-thumb', 400, 400, true ); // Hard Crop Mode


	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Main', 'deartomorrow' ),
		'menu-mobile' => esc_html__( 'Mobile', 'deartomorrow' ),
		'menu-social' => esc_html__( 'Social', 'deartomorrow' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'deartomorrow_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
    
	// Add theme support Custom Logo.
	add_theme_support( 'custom-logo', array(
		'height'      => 318,
		'width'       => 320,
		'flex-width' => true,
	) );
}
endif;
add_action( 'after_setup_theme', 'deartomorrow_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function deartomorrow_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'deartomorrow_content_width', 640 );
}
add_action( 'after_setup_theme', 'deartomorrow_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function deartomorrow_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'deartomorrow' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'deartomorrow' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'deartomorrow' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add widgets here.', 'deartomorrow' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );


}
add_action( 'widgets_init', 'deartomorrow_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function deartomorrow_scripts() {
	wp_enqueue_style( 'deartomorrow-style', get_stylesheet_uri() );

	wp_enqueue_script( 'deartomorrow-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

//Fonts    
    //wp_register_style('google-fonts', '//fonts.googleapis.com/css?family=Montserrat:300,400,400i,700,700i,900');
	//wp_enqueue_style( 'google-fonts');
    wp_enqueue_style( 'deartomorrow-ionicons', get_template_directory_uri() . '/css/ionicons.css', array(), '4.0.3' );

// Various Javascript File
    //wp_register_style('deartomorrow-jquery-ui-css', '//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css');
	//wp_enqueue_style( 'deartomorrow-jquery-ui-css');
    //wp_enqueue_script( 'deartomorrow-jquery-ui', '//code.jquery.com/ui/1.12.1/jquery-ui.js', array('jquery'), '20151215', false );
	wp_enqueue_script( 'deartomorrow-typed', get_template_directory_uri() . '/js/typed/typed.js', array(), '20120206', false );
    wp_enqueue_script( 'deartomorrow-main-js', get_stylesheet_directory_uri() . '/js/main.js', array('jquery'), '20151215', true );

    
//Isotope Stuff
	wp_enqueue_script( 'deartomorrow-infinite-scroll', get_template_directory_uri() . '/js/infinite-scroll.pkgd.min.js', array(), '20120206', true );

    
    
    
//Lightslider Stuff
    wp_enqueue_script( 'deartomorrow-lightslider', get_stylesheet_directory_uri() . '/js/lightslider.min.js', array('jquery'), '20170305', false );
    wp_enqueue_style( 'deartomorrow-lightslider-css',  get_stylesheet_directory_uri() . '/css/lightslider.min.css', array(), '20170305' );    
    
    wp_enqueue_script( 'deartomorrow-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'deartomorrow_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

function wpse_allowedtags() {
// Add custom tags to this string
    return '<script>,<style>,<br>,<em>,<i>,<ul>,<ol>,<li>,<a>,<p>,<img>,<video>,<audio>'; 
}

//Add Editor Styes
function wpdocs_theme_add_editor_styles() {
    add_editor_style( 'css/custom-editor-style.css' );
}
add_action( 'admin_init', 'wpdocs_theme_add_editor_styles' );


// Dashboard Styles
function my_admin_theme_style() {
    wp_enqueue_style('my-admin-theme', '/wp-content/themes/deartomorrow/css/wp-admin.css');
}
add_action('admin_enqueue_scripts', 'my_admin_theme_style');


function deartomorrow_image_size_names( $sizes ) {
    $sizes['slider-thumb'] = __( 'Large Square', 'deartomorrow' );

    return $sizes;
}
add_filter( 'image_size_names_choose', 'deartomorrow_image_size_names', 11, 1 );


// EJIMFORD: Login Logo
function my_login_logo() { 
    $custom_logo_id = get_theme_mod( 'custom_logo' );
    $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
    ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri() . '/images/nyu-access-login-logo.png';?>);
            height:100px;
            width:320px;
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            padding-bottom: 30px;
        }
    </style>
    <?php 
}
add_action( 'login_enqueue_scripts', 'my_login_logo' );

add_filter( 'login_headerurl', 'my_loginlogo_url' );
function my_loginlogo_url($url) {
    return get_site_url();
}

/*
* Callback function to filter the MCE settings
*/

function my_mce_before_init_insert_formats( $init_array ) {  

// Define the style_formats array

	$style_formats = array(  
/*
* Each array child is a format with it's own settings
* Notice that each array has title, block, classes, and wrapper arguments
* Title is the label which will be visible in Formats menu
* Block defines whether it is a span, div, selector, or inline style
* Classes allows you to define CSS classes
* Wrapper whether or not to add a new block-level element around any selected elements
*/
		array(  
			'title' => 'Fancy Button',  
			'selector' => 'a',  
			'classes' => 'fancy-button',
		),
		array(  
			'title' => 'Text Callout',  
			'block' => 'div',  
			'classes' => 'text-callout',
			'wrapper' => true,
		),
	);  
	// Insert the array, JSON ENCODED, into 'style_formats'
	$init_array['style_formats'] = json_encode( $style_formats );  
	
	return $init_array;  
  
} 
// Attach callback to 'tiny_mce_before_init' 
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' ); 


add_filter('acf/fields/taxonomy/query','my_taxonomy_query',10,3);
function my_taxonomy_query($args, $field, $options){
  $args['exclude'] = array(1); //the IDs of the excluded terms
  return $args;
}


// Hide the Archive Type Titles (eg. "Category:" or "Tag:")
add_filter( 'get_the_archive_title', function ($title) {
    if ( is_category() ) {
            $title = single_cat_title( '', false );
        } elseif ( is_tag() ) {
            $title = single_tag_title( '', false );
        } elseif ( is_author() ) {
            $title = '<span class="vcard">' . get_the_author() . '</span>' ;
        }

    return $title;

});

// List the child pages of current page
function list_child_pages() { 
	global $post; 
    
    $childpages = wp_list_pages( 'sort_column=menu_order&depth=1&title_li=&child_of=' . $post->ID . '&echo=0' );

    if ( $childpages ) {
		$string = '<ul>' . $childpages . '</ul>';
	}
	
	return $string;
}


// WP-Admin CSS
add_action('admin_head', 'my_wpadmin_css');

function my_wpadmin_css() {
  echo '<style>
    img.wpforms-header-logo, img[alt="Sullie the WPForms mascot"], .wpforms-panel-content .additional {
        display: none !important;
    }
    #wpforms-builder .wpforms-panels-toggle button.active, #wpforms-builder .wpforms-panels-toggle button.active:hover, .wpforms-setup-templates .wpforms-template-select, #wpforms-builder .wpforms-toolbar #wpforms-save, .wpforms-admin-page .wpforms-btn-orange, body div.jconfirm div.jconfirm-box button.btn-confirm {
        background-color: #57068c !important;
        border-color: #57068c !important;
    }
    
    </style>';
}

add_action('after_setup_theme', 'remove_admin_bar');
 
// Remove Admin Bar
function remove_admin_bar() {
  show_admin_bar(false);
}

// Display default Custom Fields Metabox
add_filter( 'acf/settings/remove_wp_meta_box', '__return_false' );

// Front End Form to Textarea
add_filter('acf/get_valid_field/type=wysiwyg', 'my_get_valid_field_post_content');
function my_get_valid_field_post_content( $field )
{
    if ((is_front_page()) || (is_page_template('page-sendphoto.php')) || (is_page_template('page-sendmessagehelp.php')) || is_singular('message')) {
        if ( $field['name'] == '_post_content' )
            $field['type'] = 'textarea';     
    }
    return $field;
}

// ## Add 'nav-menu-item' class to menu items
function pagenamed_class( $css_class, $post ) {
	if($post->post_type == 'nav_menu_item') {
	$content_page_id = get_post_meta( $post->ID, '_menu_item_object_id', true);
	$content_page = get_post( $content_page_id );
    $css_class[] = 'nav-' . $content_page->post_name;
	   } else {
			$css_class[] = 'nav-' . $post->post_name;
	   }
   
   return $css_class;
}
add_filter( 'nav_menu_css_class', 'pagenamed_class', 10, 2 );
add_filter( 'page_css_class', 'pagenamed_class', 10, 2 );


// Add Message Type to Post Class
add_filter( 'post_class', 'custom_taxonomy_post_class', 10, 3 );
if( !function_exists( 'custom_taxonomy_post_class' ) ) {
    function custom_taxonomy_post_class( $classes, $class, $ID ) {
        $taxonomy = 'type';
        $terms = get_the_terms( (int) $ID, $taxonomy );
        if( !empty( $terms ) ) {
            foreach( (array) $terms as $order => $term ) {
                if( !in_array( $term->slug, $classes ) ) {
                    $classes[] = $term->slug;
                }
            }
        }
        return $classes;
    }
}

add_filter('next_posts_link_attributes', 'posts_link_attributes_next');
add_filter('previous_posts_link_attributes', 'posts_link_attributes_prev');
function posts_link_attributes_next() {
    return 'class="pagination__next"';
}

function posts_link_attributes_prev() {
    return 'class="pagination__prev"';
}

function get_excerpt_by_id($post) {
    $return_excerpt = function($post) {
        if ($post->post_excerpt == '')
            return wp_trim_words($post->post_content, apply_filters( 'excerpt_length', 35 ), apply_filters( 'excerpt_more', ' ' . '[&hellip;]' ));
        return $post->post_excerpt;
    };
    if (!is_object($post)) {
        $post = get_post($post);
    }
    return apply_filters('the_excerpt', $return_excerpt($post));
}

function posts_where_excerpt_not_empty( $where ) {
    $where .= " AND post_excerpt != '' ";
    return $where;
}



// EJIMFORD: Set Message Type Based on Custom Field
add_action( 'save_post', 'set_partner_type_on_save', 10, 3 );
function set_partner_type_on_save( $post_id, $post ){
    // Check the post type
    if ( 'dna_project' == $post->post_type ) {
        
        // Get the Parter Field
        $partner_source = get_field( 'partner_source', $post_id );
        // Check if there is any genres entered in the metabox
        if ((isset($partner_source)) && ($partner_source !== '') ) {
            $this_type = get_term_by('name', $partner_source, 'type');
            wp_set_post_terms( $post_id, $this_type->term_id, 'type', true );
            
        }
    }
}






/* Set Random order for entries in Mesage archive page */
add_filter( 'posts_orderby', 'dt_randomise_with_pagination' );
function dt_randomise_with_pagination( $orderby ) {

	if( (is_post_type_archive( 'message' )) && (!is_admin()) ) {

	  	// Reset seed on load of initial archive page
		if( ! get_query_var( 'paged' ) || get_query_var( 'paged' ) == 0 || get_query_var( 'paged' ) == 1 ) {
			if( isset( $_SESSION['seed'] ) ) {
				unset( $_SESSION['seed'] );
			}
		}
	
		// Get seed from session variable if it exists
		$seed = false;
		if( isset( $_SESSION['seed'] ) ) {
			$seed = $_SESSION['seed'];
		}
	
	    	// Set new seed if none exists
	    	if ( ! $seed ) {
	      		$seed = rand();
	      		$_SESSION['seed'] = $seed;
	    	}
	
	    	// Update ORDER BY clause to use seed
	    	$orderby = 'RAND(' . $seed . ')';
	}

	return $orderby;
}

function dt_event_archive_startdate( $query ) {

    if( $query->is_main_query() && !is_admin() && is_post_type_archive( 'deartomorrow_event' ) ) {
		$query->set('orderby', 'meta_value');	
		$query->set('meta_key', 'event_start_date');	 
		$query->set('order', 'DESC'); 
    }
}
add_action( 'pre_get_posts', 'dt_event_archive_startdate' );


// ## Disable Posts' meta from being preloaded
// * This fixes memory problems in the WordPress Admin
function dt_pre_get_posts( WP_Query $wp_query ) {
    if ( in_array( $wp_query->get( 'post_type' ), array( 'page', 'post', 'message', 'deartomorrow_event' ) ) ) {
        $wp_query->set( 'update_post_meta_cache', false );
    }
}

// Only do this for admin
if ( is_admin() ) {
    add_action( 'pre_get_posts', 'dt_pre_get_posts' );
}


/* Google Maps API Key*/
function my_acf_google_map_api( $api ){
	$api['key'] = 'AIzaSyBbXrOwqaQhGjN58dm3rnDCUiFBdXm5ZpY';
	return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');


// EJIMFORD: Full Name Field - Makes the Full Name Field out of the First/Last Name Field
function my_acf_full_name( $field ) {
    
    $fullname = '';
    $first_name = get_field('first_name');
    $last_name = get_field('last_name');
    
    if ($first_name) {
        $fullname .= $first_name;
    }
    if ($last_name) {
        $fullname .= ' ' . $last_name;
    }
    		
     $field['default_value'] = $fullname;
     return $field;
}
add_filter('acf/load_field/name=full_name', 'my_acf_full_name');


//EJIMFORD: In Post Object Fields show the first last name in the menu.
function my_post_object_result( $title, $post, $field, $post_id ) {

    // add post type to each result
    
    $first_name = get_field('first_name', $post->ID);
    $last_name = get_field('last_name', $post->ID);
    $title .= ' (' . $first_name . ' ' . $last_name .  ')';

    return $title;

}

add_filter('acf/fields/post_object/result', 'my_post_object_result', 10, 4);

add_filter( 'protected_title_format', 'remove_protected_text' );
function remove_protected_text() {
return __('%s');
}

// ## Google Analytics
add_action('wp_head', 'add_google_analytics');
function add_google_analytics() { ?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-87322716-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-87322716-1');
</script>
<?php }

    	
