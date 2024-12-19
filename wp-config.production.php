<?php
/**
 * Production environment config settings
 *
 * Enter any WordPress config settings that are specific to this environment 
 * in this file.
 * 
 * @package    Studio 24 WordPress Multi-Environment Config
 */
  

// ** MySQL settings - You can get this info from your web host ** //
    define('WP_HOME','https://www.deartomorrow.org');
    define('WP_SITEURL','https://www.deartomorrow.org');

    // ** MySQL settings - You can get this info from your web host ** //
    /** The name of the database for WordPress */
    define('DB_NAME', 'd3art0m0rr0w_wp');

    /** MySQL database username */
    define('DB_USER', 'd3ar2_wp_user');

    /** MySQL database password */
    define('DB_PASSWORD', '7mSLZmX5an8bBxF6');

    /** MySQL hostname */
    define('DB_HOST', 'mysql.deartomorrow.dreamhosters.com');

/** MySQL database password - set in wp-config.local.php */

/**
 * For developers: WordPress debugging mode.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);


// Recommended WP config settings, uncomment to use these

/**
 * Disable theme/plugin upload.
 */
//define( 'DISALLOW_FILE_MODS', true );