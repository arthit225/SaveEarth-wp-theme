<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
    exit;  
    
/*
 * VITE & Tailwind JIT development
 * Inspired by https://github.com/andrefelipe/vite-php-setup
 *
 */

// dist subfolder - defined in vite.config.json
define('DIST_DEF', 'dist');

// defining some base urls and paths
define('DIST_URI', get_template_directory_uri() . '/' . DIST_DEF);
define('DIST_PATH', get_template_directory() . '/' . DIST_DEF);

// js enqueue settings
define('JS_DEPENDENCY', array()); // array('jquery') as example
define('JS_LOAD_IN_FOOTER', true); // load scripts in footer?

// deafult server address, port and entry point can be customized in vite.config.json
define('VITE_SERVER', 'http://localhost:3000');
define('VITE_ENTRY_POINT', '/main.js');
add_theme_support( 'post-thumbnails' );
// enqueue hook
add_action( 'wp_enqueue_scripts', function() {
     // Swiper CSS
     wp_enqueue_style('dt-swiper-css', 'https://unpkg.com/swiper/swiper-bundle.min.css', array(), null);
    
     // Swiper JS
     wp_enqueue_script('dt-swiper-js', 'https://unpkg.com/swiper/swiper-bundle.min.js', array(), null, true);

     // Marquee JS
     wp_enqueue_script('dt-marquee-js', 'https://cdn.jsdelivr.net/npm/jquery.marquee@1.6.0/jquery.marquee.min.js', array(), null, true);

     // Lazysizes JS
     wp_enqueue_script('dt-lazysizes-js', 'http://afarkas.github.io/lazysizes/lazysizes.min.js', array(), null, true);
    
    if (defined('IS_VITE_DEVELOPMENT') && IS_VITE_DEVELOPMENT === true) {

        // insert hmr into head for live reload
        function vite_head_module_hook() {
            echo '<script type="module" crossorigin src="' . VITE_SERVER . VITE_ENTRY_POINT . '"></script>';
        }
        add_action('wp_head', 'vite_head_module_hook');        

    } else {

        // production version, 'npm run build' must be executed in order to generate assets
        // ----------

        // read manifest.json to figure out what to enqueue
        $manifest = json_decode( file_get_contents( DIST_PATH . '/manifest.json'), true );
        // is ok
        if (is_array($manifest)) {
            
            // get first key, by default is 'main.js' but it can change
            $manifest_key = array_keys($manifest);
            foreach($manifest_key as $index=>$key ) {
                if ($key == 'main.js') {
                    // enqueue CSS files
                    foreach(@$manifest[$manifest_key[$index]]['css'] as $css_file) {
                        wp_enqueue_style( 'main', DIST_URI . '/' . $css_file );
                    }
                    
                    // enqueue main JS file
                    $js_file = @$manifest[$manifest_key[$index]]['file'];
                    if ( ! empty($js_file)) {
                        wp_enqueue_script( 'main', DIST_URI . '/' . $js_file, JS_DEPENDENCY, '', JS_LOAD_IN_FOOTER );
                    }
                    
                } else if ($key == 'main.css') {
                    wp_enqueue_style( 'main', DIST_URI . '/' . @$manifest[$manifest_key[$index]]['file'] );
                }
            }

        }

    }

    

});