<?php
/**
 * Staging environment config settings
 *
 * Enter any WordPress config settings that are specific to this environment 
 * in this file.
 *
 * @package    Studio 24 WordPress Multi-Environment Config
 */
  

// ** MySQL settings - You can get this info from your web host ** //
define( 'DB_NAME', 'wp_deartomorrostg' );
define( 'DB_USER', 'deartomorrostg' );
define( 'DB_PASSWORD', 'CeGi7nqMrBcDqCzmyGC5' );
define( 'DB_HOST', '127.0.0.1:3306' );
define( 'DB_HOST_SLAVE', '127.0.0.1:3306' );

// WP Engine specific constants
define('WPE_APIKEY', ''); // Add this line
define('WPE_CLUSTER_ID', 'deartomorrostg');
define('WPE_CLUSTER_TYPE', 'wpengine');
define('WPE_SFTP_HOST', 'deartomorrostg.sftp.wpengine.com');
define('WPE_SFTP_PORT', '2222');
define('PWP_NAME', 'deartomorrostg');


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