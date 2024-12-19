<?php
/**
 * Plugin Name: The Plus Addons for Elementor
 * Plugin URI: https://theplusaddons.com/
 * Description: Highly Customisable 120+ Advanced Elementor Widgets & Extensions for Performance Driven Website.
 * Version: 6.0.4
 * Author: POSIMYTH
 * Author URI: https://posimyth.com/
 * Text Domain: tpebl
 * Domain Path: /lang
 * Elementor tested up to: 3.24
 * Elementor Pro tested up to: 3.24
 *
 * @package the-plus-addons-for-elementor-page-builder
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'L_THEPLUS_VERSION', '6.0.4' );
define( 'L_THEPLUS_FILE', __FILE__ );
define( 'L_THEPLUS_PATH', plugin_dir_path( __FILE__ ) );
define( 'L_THEPLUS_PBNAME', plugin_basename( __FILE__ ) );
define( 'L_THEPLUS_PNAME', basename( __DIR__ ) );
define( 'L_THEPLUS_URL', plugins_url( '/', __FILE__ ) );
define( 'L_THEPLUS_ASSETS_URL', L_THEPLUS_URL . 'assets/' );
define( 'L_THEPLUS_ASSET_PATH', wp_upload_dir()['basedir'] . DIRECTORY_SEPARATOR . 'theplus-addons' );
define( 'L_THEPLUS_ASSET_URL', wp_upload_dir()['baseurl'] . '/theplus-addons' );
define( 'L_THEPLUS_INCLUDES_URL', L_THEPLUS_PATH . 'includes/' );
define( 'L_THEPLUS_WSTYLES', L_THEPLUS_PATH . 'modules/widgets-styles/' );
define( 'L_THEPLUS_TPDOC', 'https://theplusaddons.com/docs/' );
define( 'L_THEPLUS_WDKIT_URL', 'https://wdesignkit.com/' );
define( 'L_THEPLUS_HELP', 'https://wordpress.org/support/plugin/the-plus-addons-for-elementor-page-builder/#new-topic-0' );

require L_THEPLUS_PATH . 'widgets_loader.php';
