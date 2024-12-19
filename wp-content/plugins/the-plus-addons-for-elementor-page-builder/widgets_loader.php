<?php
/**
 * The file that defines the core plugin class
 *
 * @link    https://posimyth.com/
 * @since   1.0.0
 *
 * @package Theplus
 */

namespace TheplusAddons;

use Elementor\Utils;
use Elementor\Core\Settings\Manager as SettingsManager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * It Is load all widget and dashbord
 *
 * @since 1.0.0
 */
final class L_Theplus_Element_Load {

	/**
	 * Core singleton class
	 *
	 * @var _instance pattern realization
	 */
	private static $instance;

	/**
	 * Get Elementor Plugin Instance
	 *
	 * @return \Elementor\Theplus_Element_Loader
	 */
	public static function elementor() {
		return \Elementor\Plugin::$instance;
	}

	/**
	 * Get Singleton Instance
	 *
	 * This static method ensures that only one instance of the class is created
	 * and provides a way to access that instance.
	 *
	 * @since 1.0.0
	 *
	 * @return Theplus_Element_Loader The single instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * ThePlus_Load Class
	 *
	 * This class is responsible for handling the loading of ThePlus Addons.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		add_action( 'in_plugin_update_message-' . L_THEPLUS_PBNAME, array( $this, 'tp_f_in_plugin_update_message' ), 10, 2 );

		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', array( $this, 'tp_f_elementor_load_notice' ) );
			return;
		}

		register_activation_hook( L_THEPLUS_FILE, array( __CLASS__, 'tp_f_activation' ) );
		register_deactivation_hook( L_THEPLUS_FILE, array( __CLASS__, 'tp_f_deactivation' ) );

		add_action( 'plugins_loaded', array( $this, 'tp_f_plugin_loaded' ) );
	}

	/**
	 * When Show Update Notice that time this function is used
	 *
	 * @since 5.6.6
	 *
	 * @param array  $data     Array of plugin update data.
	 * @param object $response Object containing response data from the update check.
	 */
	public function tp_f_in_plugin_update_message( $data, $response ) {

		if ( isset( $data['upgrade_notice'] ) && ! empty( $data['upgrade_notice'] ) ) {
			printf( '<div class="update-message">%s</div>', wpautop( $data['upgrade_notice'] ) );
		}
	}

	/**
	 * Elementor Plugin Not install than show this Notice
	 *
	 * @since 5.6.6
	 */
	public function tp_f_elementor_load_notice() {
		$plugin = 'elementor/elementor.php';

		$installed_plugins = get_plugins();

		if ( isset( $installed_plugins[ $plugin ] ) ) {

			if ( ! current_user_can( 'activate_plugins' ) ) {
				return;
			}

			$activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin );
			$admin_notice   = '<p>' . esc_html__( 'Elementor is missing. You need to activate your installed Elementor to use The Plus Addons.', 'tpebl' ) . '</p>';
			$admin_notice  .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $activation_url, esc_html__( 'Activate Elementor Now', 'tpebl' ) ) . '</p>';
		} else {
			if ( ! current_user_can( 'install_plugins' ) ) {
				return;
			}
			$install_url   = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );
			$admin_notice  = '<p>' . esc_html__( 'Elementor Required. You need to install & activate Elementor to use The Plus Addons.', 'tpebl' ) . '</p>';
			$admin_notice .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $install_url, esc_html__( 'Install Elementor Now', 'tpebl' ) ) . '</p>';
		}

		echo '<div class="notice notice-error is-dismissible" style="border-left-color: #8072fc;">' . $admin_notice . '</div>';
	}

	/**
	 * Plugin Activation.
	 *
	 * @return void
	 */
	public static function tp_f_activation() {}

	/**
	 * Plugin deactivation.
	 *
	 * @return void
	 */
	public static function tp_f_deactivation() {}

	/**
	 * After Load Plugin All set than call this function
	 *
	 * @since 5.6.6
	 */
	public function tp_f_plugin_loaded() {

		$this->tp_f_load_textdomain();

		// Register class automatically.
		$this->tp_manage_files();

		$this->includes();

		// Finally hooked up all things.
		$this->hooks();

		if ( ! defined( 'THEPLUS_VERSION' ) ) {
			L_Theplus_Elements_Integration()->init();
		}

		theplus_core_cp_lite()->init();

		$this->include_widgets();
	}

	/**
	 * Load Text Domain.
	 * Text Domain : tpebl
	 *
	 * @since 5.6.6
	 */
	public function tp_f_load_textdomain() {
		load_plugin_textdomain( 'tpebl', false, L_THEPLUS_PNAME . '/lang' );
	}

	/**
	 * Include and manage files related to notices.
	 *
	 * This function includes the class responsible for managing notices in ThePlus plugin.
	 * It includes the file class-tp-notices-main.php from the specified path.
	 *
	 * @since 5.1.18
	 */
	public function tp_manage_files() {

		require_once L_THEPLUS_PATH . 'includes/admin/tpae_hooks/class-tpae-hooks.php';
		do_action( 'tpae_db_default' );

		include L_THEPLUS_PATH . 'includes/notices/class-tp-notices-main.php';
		include L_THEPLUS_PATH . 'includes/user-experience/class-tp-user-experience-main.php';
		include L_THEPLUS_PATH . 'includes/admin/dashboard/class-tpae-dashboard-main.php';
		include L_THEPLUS_PATH . 'includes/preset/class-tpae-preset.php';

		// Front or Elementor Editor
		require_once L_THEPLUS_PATH . 'includes/tp-lazy-function.php';
	}

	/**
	 * Hooks Setup for ThePlus Load Class
	 *
	 * This private method sets up hooks and actions needed for the functionality of the ThePlus Load class.
	 *
	 * @since 5.1.18
	 */
	private function hooks() {
		$theplus_options = get_option( 'theplus_options' );

		$plus_extras = l_theplus_get_option( 'general', 'extras_elements' );

		if ( ( isset( $plus_extras ) && empty( $plus_extras ) && empty( $theplus_options ) ) || ( ! empty( $plus_extras ) && in_array( 'plus_display_rules', $plus_extras ) ) ) {
			add_action( 'wp_head', array( $this, 'print_style' ) );
		}

		add_action( 'elementor/init', array( $this, 'add_elementor_category' ) );
		add_action( 'elementor/editor/after_enqueue_styles', array( $this, 'theplus_editor_styles' ) );

		add_filter( 'upload_mimes', array( $this, 'theplus_mime_types' ) );

		// Include some backend files.
		add_action( 'admin_enqueue_scripts', array( $this, 'theplus_elementor_admin_css' ) );
	}

	/**
	 * Include Module Manager and Admin PHP Files
	 *
	 * This private method is called during the class instantiation and loads
	 * the required module manager and admin PHP files.
	 *
	 * @since 1.0.0
	 */
	private function includes() {
		
		require_once L_THEPLUS_INCLUDES_URL . 'plus_addon.php';
		require_once L_THEPLUS_PATH . 'modules/widgets-feature/class-tp-widgets-feature-main.php';

		require L_THEPLUS_PATH . 'modules/theplus-core-cp.php';

		if ( ! defined( 'THEPLUS_VERSION' ) ) {
			require L_THEPLUS_PATH . 'modules/theplus-integration.php';
		}

		require L_THEPLUS_PATH . 'modules/query-control/module.php';

		require_once L_THEPLUS_PATH . 'modules/helper-function.php';
	}

	/**
	 * Include Widget Files
	 *
	 * This method is responsible for including the required files related to widgets.
	 * It ensures that the necessary files for widgets are loaded.
	 *
	 * @since 1.0.0
	 */
	public function include_widgets() {
		require_once L_THEPLUS_PATH . 'modules/theplus-include-widgets.php';

		if ( defined('THEPLUS_VERSION') ) {
			require L_THEPLUS_PATH . 'includes/admin/white_label/class-tpae-white-label.php';
		}
	}

	/**
	 * Theplus_Element_Loader Class
	 *
	 * This class manages the inclusion of styles for Theplus Elementor Editor.
	 *
	 * @since 1.0.0
	 */
	public function theplus_editor_styles() {

		wp_enqueue_style( 'theplus-ele-admin', L_THEPLUS_ASSETS_URL . 'css/admin/theplus-ele-admin.css', array(), L_THEPLUS_VERSION, false );

		$ui_theme = SettingsManager::get_settings_managers( 'editorPreferences' )->get_model()->get_settings( 'ui_theme' );

		if ( ! empty( $ui_theme ) && 'dark' === $ui_theme ) {
			wp_enqueue_style( 'theplus-ele-admin-dark', L_THEPLUS_ASSETS_URL . 'css/admin/theplus-ele-admin-dark.css', array(), L_THEPLUS_VERSION, false );
		}
	}

	/**
	 * Enqueue Theplus Elementor Admin CSS and JavaScript
	 *
	 * This method enqueues the necessary scripts and styles for Theplus Elementor Admin.
	 * It includes jQuery UI Dialog, Theplus Elementor Admin CSS, and a custom admin JavaScript file.
	 * Additionally, it sets up inline JavaScript variables for AJAX functionality.
	 *
	 * @since 1.0.0
	 */
	public function theplus_elementor_admin_css() {

		wp_enqueue_style( 'theplus-ele-admin', L_THEPLUS_ASSETS_URL . 'css/admin/theplus-ele-admin.css', array(), L_THEPLUS_VERSION, false );
		wp_enqueue_script( 'theplus-admin-js', L_THEPLUS_ASSETS_URL . 'js/admin/theplus-admin.js', array(), L_THEPLUS_VERSION, false );

		$js_inline = 'var theplus_ajax_url = "' . admin_url( 'admin-ajax.php' ) . '";
		var theplus_ajax_post_url = "' . admin_url( 'admin-post.php' ) . '";
        var theplus_nonce = "' . wp_create_nonce( 'theplus-addons' ) . '";';

		echo wp_print_inline_script_tag( $js_inline );
	}

	/**
	 * Modify Allowed MIME Types for File Uploads
	 *
	 * This function is a WordPress filter used to extend the list of allowed MIME types for file uploads.
	 * It adds support for SVG (Scalable Vector Graphics) and SVGZ (compressed SVG) file types.
	 *
	 * @param array $mimes Associative array of allowed MIME types.
	 * @return array Modified array of allowed MIME types.
	 *
	 * @since 1.0.0
	 */
	public function theplus_mime_types( $mimes ) {
		$mimes['svg']  = 'image/svg+xml';
		$mimes['svgz'] = 'image/svg+xml';

		return $mimes;
	}

	/**
	 * Print style.
	 *
	 * Adds custom CSS to the HEAD html tag. The CSS that emphasise the maintenance
	 * mode with red colors.
	 *
	 * Fired by `admin_head` and `wp_head` filters.
	 *
	 * @since 2.1.0
	 */
	public function print_style() {
		?>
		<style>*:not(.elementor-editor-active) .plus-conditions--hidden {display: none;}</style> 
		<?php
	}

	/**
	 * Add Elementor Category for PlusEssential Elements
	 *
	 * This method is responsible for adding a custom category to the Elementor Page Builder
	 * for PlusEssential elements.
	 *
	 * @since 1.0.0
	 */
	public function add_elementor_category() {

		$elementor = \Elementor\Plugin::$instance;

		// Add elementor category.
		$elementor->elements_manager->add_category(
			'plus-essential',
			array(
				'title' => esc_html__( 'Plus Essential', 'tpebl' ),
				'icon'  => 'fa fa-plug',
			),
			1
		);
		$elementor->elements_manager->add_category(
			'plus-listing',
			array(
				'title' => esc_html__( 'Plus Listing', 'tpebl' ),
				'icon'  => 'fa fa-plug',
			),
			1
		);
		$elementor->elements_manager->add_category(
			'plus-creatives',
			array(
				'title' => esc_html__( 'Plus Creatives', 'tpebl' ),
				'icon'  => 'fa fa-plug',
			),
			1
		);
		$elementor->elements_manager->add_category(
			'plus-tabbed',
			array(
				'title' => esc_html__( 'Plus Tabbed', 'tpebl' ),
				'icon'  => 'fa fa-plug',
			),
			1
		);
		$elementor->elements_manager->add_category(
			'plus-adapted',
			array(
				'title' => esc_html__( 'Plus Adapted', 'tpebl' ),
				'icon'  => 'fa fa-plug',
			),
			1
		);
		$elementor->elements_manager->add_category(
			'plus-header',
			array(
				'title' => esc_html__( 'Plus Header', 'tpebl' ),
				'icon'  => 'fa fa-plug',
			),
			1
		);
		$elementor->elements_manager->add_category(
			'plus-builder',
			array(
				'title' => esc_html__( 'Plus Builder', 'tpebl' ),
				'icon'  => 'fa fa-plug',
			),
			1
		);
		$elementor->elements_manager->add_category(
			'plus-social',
			array(
				'title' => esc_html__( 'Plus Social', 'tpebl' ),
				'icon'  => 'fa fa-plug',
			),
			1
		);
		$elementor->elements_manager->add_category(
			'plus-woo-builder',
			array(
				'title' => esc_html__( 'Plus WooCommerce', 'tpebl' ),
				'icon'  => 'fa fa-plug',
			),
			1
		);
		$elementor->elements_manager->add_category(
			'plus-depreciated',
			array(
				'title' => esc_html__( 'Plus Depreciated', 'tpebl' ),
				'icon'  => 'fa fa-plug',
			),
			1
		);
	}
}

L_Theplus_Element_Load::instance();
