<?php
/**
 * Plugin Name: WP fancyBox3
 * Description: The plugin allows to include <a href="http://fancyapps.com/fancybox/3/" target=_blank>fancyBox 3</a> on your website
 * Version: 2.5.9
 * Tags: fancybox, lightbox, gallery, image, photo, video, flash, overlay, youtube, vimeo, dailymotion, pdf, svg, iframe, swf, jquery, webp
 * Author: e. james ford
 * Author URI: https://web.ejimford.com
 * Textdomain: wpfancybox3
 * Domain Path: /languages
 */

if ( ! class_exists('WPfancyBox3\Core')) {
    require __DIR__ . '/src/Core.php';
    new \WPFancyBox3\Core(__FILE__);
}