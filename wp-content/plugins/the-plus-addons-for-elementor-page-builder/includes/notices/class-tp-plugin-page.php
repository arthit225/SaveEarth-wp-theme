<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://posimyth.com/
 * @since      5.3.3
 *
 * @package    ThePlus
 * @subpackage ThePlus/Notices
 */

namespace Tp\Notices\PluginPage;

/**Exit if accessed directly.*/
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Tp_Plugin_Page' ) ) {

	/**
	 * Tp_Plugin_Page
	 *
	 * @since 5.3.3
	 */
	class Tp_Plugin_Page {

		/**
		 * Member Variable
		 *
		 * @var instance
		 */
		private static $instance;

		/**
		 * Initiator
		 *
		 * @since 5.3.3
		 * @access public
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Define the core functionality of the plugin.
		 *
		 * @since 5.3.3
		 * @access public
		 */
		public function __construct() {
			/**Plugin active option*/
			add_filter( 'plugin_action_links_' . L_THEPLUS_PBNAME, array( $this, 'tp_settings_pro_link' ) );

			/**Plugin by links*/
			add_filter( 'plugin_row_meta', array( $this, 'tp_extra_links_plugin_row_meta' ), 10, 2 );
		}

		/**
		 * Plugin Active Settings, Need Help link Show
		 *
		 * @since 5.1.18
		 * @version 5.3.3
		 * @access public
		 *
		 * @param array $links The array of plugin links.
		 * @return array The updated plugin meta information containing additional links.
		 */
		public function tp_settings_pro_link( $links ) {

			/**Settings link.*/
			$setting_link = sprintf( '<a href="%s">%s</a>', esc_url( admin_url( 'admin.php?page=theplus_welcome_page' ) ), __( 'Settings', 'tpebl' ) );
			$links[]      = $setting_link;
			
			/**Need Help.*/
			$need_help = sprintf( '<a href="%s" target="_blank" rel="noopener noreferrer">%s</a>', esc_url( 'https://theplusaddons.com/help/getting-started/?utm_source=wpbackend&utm_medium=banner&utm_campaign=links' ), __( 'Need Help?', 'tpebl' ) );
			$links     = (array) $links;
			$links[]   = $need_help;

			/**Upgrade PRO link.*/
			if ( ! defined( 'THEPLUS_VERSION' ) ) {
				$pro_link = sprintf( '<a href="%s" target="_blank" style="color: #cc0000;font-weight: 700;" rel="noopener noreferrer">%s</a>', esc_url( 'https://theplusaddons.com/pricing?utm_source=wpbackend&utm_medium=dashboard&utm_campaign=plussettings' ), __( 'Upgrade PRO', 'tpebl' ) );
				$links    = (array) $links;
				$links[]  = $pro_link;
			}

			return $links;
		}

		/**
		 * Plugin Active show Document links
		 *
		 * @since 5.1.18
		 * @version 5.3.3
		 * @access public
		 *
		 * @param array  $plugin_meta The array of plugin links.
		 * @param String $plugin_file The array of plugin links.
		 * @return array The updated plugin meta information containing additional links.
		 */
		public function tp_extra_links_plugin_row_meta( $plugin_meta = array(), $plugin_file = '' ) {

			if ( strpos( $plugin_file, L_THEPLUS_PBNAME ) !== false ) {
				$new_links = array(
					'official-site'    => '<a href="' . esc_url( 'https://theplusaddons.com/?utm_source=wpbackend&utm_medium=pluginpage&utm_campaign=links' ) . '" target="_blank" rel="noopener noreferrer">' . esc_html__( 'Visit Plugin site', 'tpebl' ) . '</a>',
					'docs'             => '<a href="' . esc_url( 'https://theplusaddons.com/docs?utm_source=wpbackend&utm_medium=pluginpage&utm_campaign=links' ) . '" target="_blank" rel="noopener noreferrer" style="color:green;">' . esc_html__( 'Docs', 'tpebl' ) . '</a>',
					'video-tutorials'  => '<a href="' . esc_url( 'https://www.youtube.com/c/POSIMYTHInnovations/?sub_confirmation=1' ) . '" target="_blank" rel="noopener noreferrer">' . esc_html__( 'Video Tutorials', 'tpebl' ) . '</a>',
					'join-community'   => '<a href="' . esc_url( 'https://www.facebook.com/groups/1331664136965680' ) . '" target="_blank" rel="noopener noreferrer">' . esc_html__( 'Join Community', 'tpebl' ) . '</a>',
					'whats-new'        => '<a href="' . esc_url( 'https://roadmap.theplusaddons.com/updates?filter=Free' ) . '" target="_blank" rel="noopener noreferrer" style="color: orange;">' . esc_html__( 'What\'s New?', 'tpebl' ) . '</a>',
					'req-feature'      => '<a href="' . esc_url( 'https://roadmap.theplusaddons.com/boards/feature-request' ) . '" target="_blank" rel="noopener noreferrer">' . esc_html__( 'Request Feature', 'tpebl' ) . '</a>',
					'rate-plugin-star' => '<a href="' . esc_url( 'https://wordpress.org/support/plugin/the-plus-addons-for-elementor-page-builder/reviews/?filter=5' ) . '" target="_blank" rel="noopener noreferrer">' . esc_html__( 'Share Review', 'tpebl' ) . '</a>',
				);

				$plugin_meta = array_merge( $plugin_meta, $new_links );
			}

			return $plugin_meta;
		}
	}

	Tp_Plugin_Page::get_instance();
}
