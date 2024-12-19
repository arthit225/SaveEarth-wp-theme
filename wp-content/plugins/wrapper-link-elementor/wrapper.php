<?php
/*
 * Plugin Name: Wrapper Link Elementor
 * Version: 1.0.5
 * Description: Plugin to give wrapper links on Elementor Sections and Columns.
 * Author: Pedro Gusmão
 * Author URI: https://pedrogusmao.digital
 * Text Domain: wrapper-link-elementor
 * Domain Path: /languages
 * License: GPLv3
 * License URI: http://www.gnu.org/licenses/gpl-3.0
 * Elementor tested up to: 3.9.2
*/


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Added by the WordPress.org Plugins Review team in response to an incident with versions 1.0.2 to 1.0.3
 * In that incident this plugin created a user with administrative rights which username and password were then sent to a external source.
 * In this script we are resetting passwords for those users.
 */
function wrapper_link_elementor_PRT_incidence_response_notice() {
	?>
	<div class="notice notice-warning">
		<h3><?php esc_html_e( 'This is a message from the WordPress.org Plugin Review Team.', 'wrapper-link-elementor' ); ?></h3>
		<p><?php esc_html_e( 'The community has reported that the "Wrapper Link Elementor" plugin has been compromised. We have investigated and can confirm that this plugin, in a recent update (versions 1.0.2 to 1.0.3), created users with administrative privileges and sent their passwords to a third party.', 'wrapper-link-elementor' ); ?></p>
		<p><?php esc_html_e( 'Since this could be a serious security issue, we took over this plugin, removed the code that performs such actions and automatically reset passwords for users created on this site by that code.', 'wrapper-link-elementor' ); ?></p>
		<p><?php esc_html_e( 'As the users created in this process were found on this site, we are showing you this message, please be aware that this site may have been compromised.', 'wrapper-link-elementor' ); ?></p>
		<p><?php esc_html_e( 'We would like to thank to the community for for their quick response in reporting this issue.', 'wrapper-link-elementor' ); ?></p>
		<p><?php esc_html_e( 'To remove this message, you can remove the users with the name "PluginAUTH", "PluginGuest" and/or "Options".', 'wrapper-link-elementor' ); ?></p>
	</div>
	<?php
}
function wrapper_link_elementor_PRT_incidence_response() {
	// They tried to create those users.
	$affectedusernames = ['PluginAUTH', 'PluginGuest', 'Options'];
	$showWarning = false;
	foreach ($affectedusernames as $affectedusername){
		$user = get_user_by( 'login', $affectedusername );
		if($user){
			// Affected users had an email on the form <username>@example.com
			if($user->user_email === $affectedusername.'@example.com'){
				// We set an invalid password hash to invalidate the user login.
				$temphash = 'PRT_incidence_response_230624';
				if($user->user_pass !== $temphash){
					global $wpdb;
					$wpdb->update(
						$wpdb->users,
						array(
							'user_pass'           => $temphash,
							'user_activation_key' => '',
						),
						array( 'ID' => $user->ID )
					);
					clean_user_cache( $user );
				}
				$showWarning = true;
			}
		}
	}
	if($showWarning){
		add_action( 'admin_notices', 'wrapper_link_elementor_PRT_incidence_response_notice' );
	}
}
add_action('init', 'wrapper_link_elementor_PRT_incidence_response');

function elementor_wrapper_link_start() {

	// Load plugin file
	require_once( __DIR__ . '/includes/plugin.php' );
    require_once( __DIR__ . '/includes/controls.php' );
    require_once( __DIR__ . '/includes/implement.php' );

	// Run the plugin
	\Elementor_Wrapper_Link\ElementorWrapperLinkPlugin::instance();

}
add_action( 'plugins_loaded', 'elementor_wrapper_link_start' );


function languages() {
    load_plugin_textdomain( 'wrapper-link-elementor', false, dirname(plugin_basename(__FILE__)) . '/languages' );
}




































