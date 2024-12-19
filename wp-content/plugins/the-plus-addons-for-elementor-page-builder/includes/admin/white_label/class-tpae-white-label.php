<?php
/**
 * The file store Database Default Entry
 *
 * @link       https://posimyth.com/
 * @since      6.0.0
 *
 * @package    the-plus-addons-for-elementor-page-builder
 */

/**Exit if accessed directly.*/
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Tpae_White_Label' ) ) {

	/**
	 * Tpae_White_Label
	 *
	 * @since 6.0.0
	 */
	class Tpae_White_Label {

		/**
		 * Member Variable
		 *
		 * @var instance
		 */
		private static $instance;

		/**
		 *  Initiator
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
		 * @since 6.0.0
		 */
		public function __construct() {
			add_filter( 'all_plugins', array( $this, 'tpaep_white_label_update_free' ) );
		}

		/**
		 * White Label Plugin Page
		 *
		 * @since 6.0.0
		 */
		public function tpaep_white_label_update_free( $all_plugins ) {
			$label_options = get_option( 'theplus_white_label' );

			$plugin_name    = ! empty( $label_options['l_tp_plugin_name'] ) ? $label_options['l_tp_plugin_name'] : '';
			$tp_plugin_desc = ! empty( $label_options['l_tp_plugin_desc'] ) ? $label_options['l_tp_plugin_desc'] : '';
			$tp_author_name = ! empty( $label_options['l_tp_author_name'] ) ? $label_options['l_tp_author_name'] : '';
			$tp_author_uri  = ! empty( $label_options['l_tp_author_uri'] ) ? $label_options['l_tp_author_uri'] : '';

			if ( ! empty( $all_plugins[ L_THEPLUS_PBNAME ] ) && is_array( $all_plugins[ L_THEPLUS_PBNAME ] ) ) {
				$all_plugins[ L_THEPLUS_PBNAME ]['Name']        = ! empty( $plugin_name ) ? $plugin_name : $all_plugins[ L_THEPLUS_PBNAME ]['Name'];
				$all_plugins[ L_THEPLUS_PBNAME ]['PluginURI']   = ! empty( $tp_author_uri ) ? $tp_author_uri : $all_plugins[ L_THEPLUS_PBNAME ]['PluginURI'];
				$all_plugins[ L_THEPLUS_PBNAME ]['Description'] = ! empty( $tp_plugin_desc ) ? $tp_plugin_desc : $all_plugins[ L_THEPLUS_PBNAME ]['Description'];
				$all_plugins[ L_THEPLUS_PBNAME ]['Author']      = ! empty( $tp_author_name ) ? $tp_author_name : $all_plugins[ L_THEPLUS_PBNAME ]['Author'];
				$all_plugins[ L_THEPLUS_PBNAME ]['AuthorURI']   = ! empty( $tp_author_uri ) ? $tp_author_uri : $all_plugins[ L_THEPLUS_PBNAME ]['AuthorURI'];
				$all_plugins[ L_THEPLUS_PBNAME ]['Title']       = ! empty( $plugin_name ) ? $plugin_name : $all_plugins[ L_THEPLUS_PBNAME ]['Title'];
				$all_plugins[ L_THEPLUS_PBNAME ]['AuthorName']  = ! empty( $tp_author_name ) ? $tp_author_name : $all_plugins[ L_THEPLUS_PBNAME ]['AuthorName'];

				return $all_plugins;
			}
		}
	}

	Tpae_White_Label::get_instance();
}
