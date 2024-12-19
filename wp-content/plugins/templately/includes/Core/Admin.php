<?php
namespace Templately\Core;

use Exception;
use PriyoMukul\WPNotice\Notices;
use PriyoMukul\WPNotice\Utils\CacheBank;
use PriyoMukul\WPNotice\Utils\NoticeRemover;
use Templately\API\Login;
use Templately\Utils\Base;
use Templately\Utils\Helper;
use Templately\Utils\Options;
use Templately\Core\Platform\Elementor;
use Templately\Core\Platform\Gutenberg;

class Admin extends Base {

	/**
	 * @var CacheBank
	 */
	private static $cache_bank;

	/**
	 * Initially invoked function.
	 * Menu, Assets and maybe redirect on plugin activation is initialized.
	 */
	public function __construct() {
		add_action( 'admin_enqueue_scripts', [ $this, 'scripts' ] );
		add_action( 'admin_menu', [ $this, 'admin_menu' ] );

		self::$cache_bank = CacheBank::get_instance();

		try {
			add_action( 'admin_init', [ $this, 'notices' ], 11 );
		} catch ( Exception $e ) {
			unset( $e );
		}

		add_filter( 'plugin_action_links_' . TEMPLATELY_PLUGIN_BASENAME, [$this, 'handleActionLinks'], 10, 2 );

		add_action( 'admin_footer', [$this, 'my_custom_footer_html'] );

		// Remove OLD notice from 1.0.0 (if other WPDeveloper plugin has notice)
		NoticeRemover::get_instance( '1.0.0' );
	}

	public function register_post_type() {
		$labels = [
			'name'                  => _x( 'Theme Builders', 'Post type general name', 'templately' ),
			'singular_name'         => _x( 'Theme Builder', 'Post type singular name', 'templately' ),
			'menu_name'             => _x( 'Theme Builder', 'Admin Menu text', 'templately' ),
			'name_admin_bar'        => _x( 'Book', 'Add New on Toolbar', 'templately' ),
			'add_new'               => __( 'Add New', 'templately' ),
			'add_new_item'          => __( 'Add New Template', 'templately' ),
			'new_item'              => __( 'New Template', 'templately' ),
			'edit_item'             => __( 'Edit Template', 'templately' ),
			'view_item'             => __( 'View Template', 'templately' ),
			'all_items'             => __( 'All Templates', 'templately' ),
			'search_items'          => __( 'Search Templates', 'templately' ),
			'parent_item_colon'     => __( 'Parent Templates:', 'templately' ),
			'not_found'             => __( 'No templates found.', 'templately' ),
			'not_found_in_trash'    => __( 'No templates found in Trash.', 'templately' ),
			'featured_image'        => _x( 'Template Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'templately' ),
			'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'templately' ),
			'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'templately' ),
			'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'templately' ),
			'archives'              => _x( 'Template archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'templately' ),
			'insert_into_item'      => _x( /** @lang text */ "Insert Into Theme Builder", 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'templately' ),
			'uploaded_to_this_item' => _x( 'Uploaded to this template', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'templately' ),
			'filter_items_list'     => _x( 'Filter templates list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'templately' ),
			'items_list_navigation' => _x( 'Templates list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'templately' ),
			'items_list'            => _x( 'Templates list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'templately' ),
		];

		$args = [
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => false,
			'query_var'          => true,
			'rewrite'            => [ 'slug' => 'templately-library' ],
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 10,
			'supports'           => [ 'title', 'editor', 'author', 'thumbnail', 'custom-field' ],
		];

		register_post_type( 'templately_library', $args );
	}

	/**
	 * Enqueuing Assets
	 *
	 * @param  string $hook
	 * @return void
	 */
	public function scripts( string $hook ) {
		if ( ! in_array( $hook, [ 'index.php', 'edit.php', 'toplevel_page_templately', 'elementor', 'gutenberg' ], true ) ) {
			return;
		}

		if('index.php' === $hook){
			// need separate condition so we can return if page is index.php

			$is_complete = get_user_meta(get_current_user_id(), 'templately_fsi_complete', true);
			if($is_complete && $is_complete !== 'done' && !wp_is_mobile()){
				$user  = Options::get_instance()->get('user');
				$email = isset($user['email']) ? $user['email'] : '';

				templately()->assets->enqueue( 'templately', 'css/dashboard-style.css', [] );
				templately()->assets->enqueue( 'templately', 'js/dashboard.js', [], true );
				templately()->assets->localize( 'templately', 'templately', [
					'email' => $email,
					'nonce' => wp_create_nonce( 'templately_nonce' ),
				] );

			}
			return;
		}

		$templately = [];

		if ( 'edit.php' === $hook ) {
			global $current_screen;
			if ( $current_screen->post_type !== 'templately_library' ) {
				return;
			}

			$types = templately()->theme_builder::$templates_manager->get_template_types();
			$types = array_filter( $types, function ( $item ) {
				return $item::get_property( 'builder' ) || $item::get_property( 'builder' ) === null;
			} );

			$types = array_reduce( $types, function ( $carry, $item ) {
				return array_merge( $carry, [
					[
						'value' => call_user_func( [ $item, 'get_type' ] ),
						'label' => call_user_func( [ $item, 'get_title' ] )
					]
				] );
			}, [] );

			$templately = [
				'types' => $types
			];
		}

		$script_dependencies = ['regenerator-runtime'];
		$_localize_handle    = 'templately';
		$_current_screen     = 'templately';

		if ( $hook === 'elementor' || $hook === 'gutenberg' ) {
			$_current_screen       = $hook;
			$_localize_handle      = 'templately-' . $hook;
			$script_dependencies[] = $_localize_handle;
		}

		if ( $hook === 'toplevel_page_templately' || $hook == 'edit.php' ) {
			templately()->assets->enqueue( 'templately-admin', 'css/admin.css', [ 'templately' ] );
		}

		// Google Font Enqueueing
		templately()->assets->enqueue(
			'templately-dmsans',
			set_url_scheme( '//fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap' )
		);

		wp_enqueue_media();
		templately()->assets->enqueue( 'templately', 'js/templately.js', $script_dependencies, true );
		templately()->assets->enqueue( 'templately', 'css/templately.css', ['templately-dmsans'] );

		/**
		 * @var Elementor|Gutenberg $platform
		 */
		$platform = $this->platform( $_current_screen );

		$templately = array_merge( [
			'url'                => home_url(),
			'site_url'           => site_url(),
			'nonce'              => wp_create_nonce( 'templately_nonce' ),
			'rest_args'          => [
				'nonce'    => wp_create_nonce( 'wp_rest' ),
				'endpoint' => get_rest_url( null, 'templately/v1/' )
			],
			'log'                => defined( 'TEMPLATELY_DEBUG_LOG' ) && TEMPLATELY_DEBUG_LOG,
			'dev_mode'           => defined( 'TEMPLATELY_DEV' ) && TEMPLATELY_DEV,
			"icons"              => [
				'construction' => templately()->assets->icon( 'icons/construction.gif' ),
				'profile'      => templately()->assets->icon( 'icons/profile.svg' ),
				'warning'      => templately()->assets->icon( 'icons/warning.png' )
			],
			'promo_image'             => templately()->assets->icon( 'single-page-promo.png' ),
			'default_image'           => templately()->assets->icon( 'clouds/cloud-item.svg' ),
			'not_found'               => templately()->assets->icon( 'no-item-found.png' ),
			'no_items'                => templately()->assets->icon( 'no-items.png' ),
			'loadingImage'            => templately()->assets->icon( 'logos/loading-logo.gif' ),
			'current_url'             => admin_url( 'admin.php?page=templately' ),
			'is_signed'               => Login::is_signed(),
			'is_globally_signed'      => Login::is_globally_signed(),
			'signed_as_global'        => Login::signed_as_global(),
			'current_screen'          => $_current_screen,
			'can_fsi'                 => current_user_can('install_plugins') && current_user_can('install_themes'),
			'post_type'               => get_post_type(),
			'has_elementor'           => rest_sanitize_boolean( is_plugin_active( 'elementor/elementor.php' ) ),
			'has_elementor_pro'       => rest_sanitize_boolean( is_plugin_active( 'elementor-pro/elementor-pro.php' ) ),
			'theme'                   => $_current_screen == 'templately' ? 'light' : $platform->ui_theme(),
			'is_wp_support_gutenberg' => version_compare( get_bloginfo( 'version' ), '5.0.0', '>=' ),
		], $templately );

		templately()->assets->localize( $_localize_handle, 'templately', $templately );
	}

	/**
	 * Admin notices for Review and others.
	 *
	 * @since 2.0.0
	 * @return void
	 * @throws Exception
	 * @since 2.0.0
	 */
	public function notices() {
		$notices = new Notices( [
			// 'dev_mode'       => true,
			'id'             => 'templately',
			'storage_key'    => 'notices',
			'lifetime'       => 3,
			'stylesheet_url' => TEMPLATELY_ASSETS . 'css/notices.css',
			'styles'         => TEMPLATELY_ASSETS . 'css/notices.css',
			'priority'       => 2,
		] );

		$global_user     = Options::get_instance()->get( 'user', false, get_current_user_id() );
		$download_counts = Options::get_instance()->get( 'total_download_counts', 0, get_current_user_id() );
		$cloud_items     = 0;
		if ( isset( $global_user['my_cloud']['usages'] ) ) {
			$cloud_items = intval( $global_user['my_cloud']['usages'] );
		}

		if ( $cloud_items >= 5 || $download_counts >= 4 ) {
			$message = sprintf( __( "We hope you're enjoying %s! Could you please do us a favor and give us a review on %s to help us spread the word and boost our motivation?", 'templately' ), '<strong>Templately</strong>', '<strong>WordPress</strong>' );

			$_review_notice = [
				'thumbnail' => templately()->assets->icon( 'logos/logo.svg' ),
				'html'      => '<p>' . $message . '</p>',
				'links'     => [
					'later'            => [
						'link'       => 'https://wordpress.org/support/plugin/templately/reviews/#new-post',
						'target'     => '_blank',
						'label'      => __( 'Sure, you deserve it!', 'templately' ),
						'icon_class' => 'dashicons dashicons-external'
					],
					'allready'         => [
						'label'      => __( 'I already did', 'templately' ),
						'icon_class' => 'dashicons dashicons-smiley',
						'attributes' => [
							'data-dismiss' => true
						]
					],
					'maybe_later'      => [
						'label'      => __( 'Maybe Later', 'templately' ),
						'icon_class' => 'dashicons dashicons-calendar-alt',
						'attributes' => [
							'data-later' => true,
							'class'      => 'dismiss-btn'
						]
					],
					'support'          => [
						'link'       => 'https://wpdeveloper.com/support',
						'attributes' => [
							'target' => '_blank'
						],
						'label'      => __( 'I need help', 'templately' ),
						'icon_class' => 'dashicons dashicons-sos'
					],
					'never_show_again' => [
						'label'      => __( 'Never show again', 'templately' ),
						'icon_class' => 'dashicons dashicons-dismiss',
						'attributes' => [
							'data-dismiss' => true
						]
					]
				]
			];

			$notices->add( 'review', $_review_notice, [
				'start'       => $notices->strtotime(),
				'recurrence'  => 20,
				'dismissible' => true,
				'refresh'     => TEMPLATELY_VERSION,
				'screens'     => [
					'dashboard',
					'plugins',
					'themes',
					'edit-page',
					'edit-post',
					'users',
					'tools',
					'options-general',
					'nav-menus'
				]
			] );
		}

		if ( $global_user === false || isset( $global_user['plan'] ) && $global_user['plan'] == 'free' ) {
			$crown = '<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="m15.743 10.938.161-1.578c.086-.842.142-1.399.098-1.749h.015c.727 0 1.316-.622 1.316-1.389s-.589-1.389-1.315-1.389c-.727 0-1.316.622-1.316 1.39 0 .346.12.663.32.907-.287.186-.66.58-1.223 1.171-.434.456-.65.684-.893.72a.7.7 0 0 1-.394-.059c-.223-.104-.372-.385-.67-.95l-1.57-2.97a22 22 0 0 0-.476-.873c.569-.306.958-.93.958-1.65C10.754 1.496 9.97.667 9 .667s-1.754.829-1.754 1.852c0 .72.389 1.344.958 1.65-.139.234-.293.525-.476.873l-1.57 2.97c-.298.565-.447.846-.67.95a.7.7 0 0 1-.394.058c-.242-.035-.46-.263-.893-.719-.563-.592-.937-.985-1.223-1.171.2-.244.32-.56.32-.908 0-.767-.589-1.389-1.316-1.389-.726 0-1.315.622-1.315 1.39 0 .766.589 1.388 1.315 1.388h.016c-.045.35.012.906.098 1.749l.16 1.578c.09.876.164 1.71.255 2.46H15.49c.09-.75.165-1.584.254-2.46m-7.698 6.395h1.908c2.488 0 3.732 0 4.562-.784.362-.342.591-.959.757-1.762H2.727c.166.803.395 1.42.757 1.762.83.784 2.074.784 4.562.784" fill="#fff"/></svg>';

			$notices->add( 'upsale', wp_sprintf( '<p>%1$s <a target="_blank" href="%3$s">%2$s</a>.</p>', __( '🔥 Get access to 5,000+ Ready Templates & save up to 65% OFF now', 'templately' ), __( 'Upgrade to Pro', 'templately' ), 'https://templately.com/#pricing' ), [
				'start'       => $notices->strtotime( '+10 day' ),
				'dismissible' => true,
				'refresh'     => TEMPLATELY_VERSION,
				'screens'     => [
					'dashboard',
					'plugins',
					'themes',
					'edit-page',
					'edit-post',
					'users',
					'tools',
					'options-general',
					'nav-menus'
				]
			] );

			$notice_text  = '<p style="margin-top: 0; margin-bottom: 0px;"><strong>🏷️ Black Friday Special:</strong> Get Templately PRO up to 70% OFF & unlock 5500+ ready WordPress templates now.</p>';
			$notice_text .= sprintf(
				'<a class="button button-primary" target="_blank" href="%2$s">%1$s</a>',
				$crown . __('Upgrade to Pro', 'templately'),
				'https://templately.com/#pricing'
			);

			$_black_friday = [
				'thumbnail' => templately()->assets->icon( 'logos/logo-full.svg' ),
				'html'      => $notice_text,
			];

			$notices->add( 'black_friday', $_black_friday, [
				'start'       => $notices->strtotime('+1 minute'),
				'recurrence'  => false,
				'dismissible' => true,
				'refresh'     => TEMPLATELY_VERSION,
				"expire"      => strtotime( '11:59:59pm 5nd December, 2024' ),
				'display_if'  => !wp_is_mobile(),
				'screens'     => [
					'dashboard',
				],
			] );

			$halloween_text = sprintf(
				'<p style="margin-top: 0; margin-bottom: 0px;"> 🎃 %s <strong>%s</strong> %s</p>',
				__('Halloween Treats: Get Templately PRO', 'templately'),
				__('up to 65% OFF', 'templately'),
				__('& unlock 5000+ ready WordPress templates now.', 'templately')
			);

			$halloween_text .= sprintf(
				'<a class="button button-primary" target="_blank" href="%2$s">%1$s</a>',
				$crown . __('Upgrade to Pro', 'templately'),
				'https://templately.com/#pricing'
			);


			$_halloween = [
				'thumbnail' => templately()->assets->icon( 'logos/logo-full.svg' ),
				'html'      => $halloween_text,
			];

			$notices->add( 'halloween', $_halloween, [
				'start'       => $notices->strtotime('+1 minute'),
				'recurrence'  => false,
				'dismissible' => true,
				'refresh'     => TEMPLATELY_VERSION,
				"expire"      => strtotime( '11:59:59pm 3nd November, 2024' ),
				'display_if'  => !wp_is_mobile(),
				'screens'     => [
					'dashboard',
				],
			] );
		}

		self::$cache_bank->create_account( $notices );
		self::$cache_bank->calculate_deposits( $notices );
	}

	/**
	 * Adding Menu In Sidebar ( WordPress Left-side Dashboard Menu )
	 *
	 * @return void
	 */
	public function admin_menu() {
		// TODO: Role Management

		add_menu_page( 'Templately', 'Templately', 'delete_posts', 'templately', '', templately()->assets->icon( 'logos/logo-icon.svg' ), '58.7' );

		add_submenu_page( 'templately', 'Templately', 'Template Library', 'delete_posts', 'templately', [
			$this,
			'display'
		], '58.7' );

		add_submenu_page( 'templately', 'Theme Builder', 'Theme Builder', 'delete_posts', 'edit.php?post_type=templately_library', '', '58.7' );

		// add_submenu_page( 'templately', 'Settings', 'Settings', 'administrator', 'templately-settings', [
		// 	Settings::get_instance(),
		// 	'display'
		// ], '58.7' );
	}

	public function display() {
		Helper::views( 'settings' );
	}

	/**
	 * If Elementor doesn't exists.
	 *
	 * @return void
	 */
	public static function has_no_elementor() {
		$plugin_url  = \wp_nonce_url( \self_admin_url( 'update.php?action=install-plugin&amp;plugin=elementor' ), 'install-plugin_elementor' );
		$button_text = 'Install Elementor';
		if ( isset( Helper::get_plugins()['elementor/elementor.php'] ) ) {
			$plugin_url  = \wp_nonce_url( 'plugins.php?action=activate&amp;plugin=elementor/elementor.php', 'activate-plugin_elementor/elementor.php' );
			$button_text = 'Activate Elementor';
		}
		$output = '<div class="notice notice-error">';
		$output .= sprintf(
			"<p><strong>%s</strong> %s <strong>%s</strong> %s &nbsp;&nbsp;<a  class='button-primary' href='%s'>%s</a></p>",
			__( 'Templately', 'templately' ),
			__( 'requires', 'templately' ),
			__( 'Elementor', 'templately' ),
			__( 'plugin to be installed and activated. Please install Elementor to continue.', 'templately' ),
			esc_url( $plugin_url ),
			__( $button_text, 'templately' )
		);
		$output .= '</div>';
		echo $output;
	}

	public function header() {
		Helper::views( 'header' );
	}

    /**
     * Handle links displayed below the plugin name in the WordPress Installed Plugins page.
     *
     * @return  array
     * @since   3.1.2
     * @static
     *
     */
	public static function handleActionLinks($links, $file)
	{
		$settingsLink = '<a href="' . admin_url('admin.php?page=templately') . '" aria-label="' . __('Open settings page',
				'templately') . '">' . __('Templates Library', 'templately') . '</a>';

		$links[] = $settingsLink;
		return $links;
	}


	public function my_custom_footer_html() {
		global $current_screen;

		if ( ! $current_screen ) {
			return false;
		}

		if($current_screen->id !== 'dashboard'){
			return false;
		}

		$is_complete = get_user_meta(get_current_user_id(), 'templately_fsi_complete', true);

		if($is_complete && $is_complete !== 'done' && !wp_is_mobile()):
			?>
				<div id="templately-fsi-feedback"></div>
			<?php
		endif;
	}
}
