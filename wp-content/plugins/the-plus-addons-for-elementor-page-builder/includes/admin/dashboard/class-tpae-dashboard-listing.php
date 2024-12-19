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

if ( ! class_exists( 'Tpae_Dashboard_Listing' ) ) {

	/**
	 * Tpae_Dashboard_Listing
	 *
	 * @since 6.0.0
	 */
	class Tpae_Dashboard_Listing {

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
			add_action( 'init', array( $this, 'initialize_all_functions' ) );
		}

		/**
		 * Initialize all necessary functions for this class.
		 *
		 * This method is hooked to 'init' and calls all related functions.
		 *
		 * @since 6.0.0
		 */
		public function initialize_all_functions() {
			$this->tpae_ele_clients_function();
			$this->tpae_ele_clients_category();

			$this->tpae_ele_testimonial();
			$this->tpae_ele_testimonial_category();

			$this->tpae_ele_team_member_function();
			$this->tpae_ele_team_member_category();

			$client_post = l_theplus_get_option( 'post_type', 'client_post_type' );
			if ( isset( $client_post ) && ! empty( $client_post ) && ( $client_post == 'themes' || $client_post == 'plugin' || $client_post == 'themes_pro' ) ) {
				require_once L_THEPLUS_INCLUDES_URL . 'admin/extra-option/clients_options.php';
			}

			$testimonial_post = l_theplus_get_option( 'post_type', 'testimonial_post_type' );
			if ( isset( $testimonial_post ) && ! empty( $testimonial_post ) && ( $testimonial_post == 'themes' || $testimonial_post == 'plugin' || $client_post == 'themes_pro' ) ) {
				require_once L_THEPLUS_INCLUDES_URL . 'admin/extra-option/testimonial_option.php';
			}

			$team_member_post = l_theplus_get_option( 'post_type', 'team_member_post_type' );
			if ( isset( $team_member_post ) && ! empty( $team_member_post ) && ( $team_member_post == 'themes' || $team_member_post == 'plugin' || $client_post == 'themes_pro' ) ) {
				require_once L_THEPLUS_INCLUDES_URL . 'admin/extra-option/teammember_options.php';
			}
		}

		/**
		 * Clients_function
		 *
		 * @param string $options_type The type of option to retrieve. E.g., 'post_type'.
		 * @param string $field The specific field key within the option array to retrieve the value for.
		 *
		 * @return mixed The value associated with the given field for the specified option type, or an empty string if not found.
		 *
		 * @since 6.0.0
		 */
		public function tpae_post_type_get_option( $options_type, $field ) {

			$post_type_options = get_option( 'post_type_options' );

			$values = '';
			if ( 'post_type' === $options_type ) {
				if ( isset( $post_type_options[ $field ] ) && ! empty( $post_type_options[ $field ] ) ) {
					$values = $post_type_options[ $field ];
				}
			}

			return $values;
		}

		/**
		 * Clients_function
		 *
		 * @since 6.0.0
		 */
		public function tpae_ele_clients_function() {

			$status = $this->tpae_post_type_get_option( 'post_type', 'client_post_type' );

			if ( empty( $status ) ) {
				return;
			} elseif ( 'disable' === $status ) {
				return;
			}

			$post_name = $this->tpae_post_type_get_option( 'post_type', 'client_plugin_name' );
			if ( isset( $post_name ) && ! empty( $post_name ) ) {
				$post_name = $this->tpae_post_type_get_option( 'post_type', 'client_plugin_name' );
			} else {
				$post_name = 'theplus_clients';
			}

			$tp_client_title   = $this->tpae_post_type_get_option( 'post_type', 'client_plugin_title' );
			$client_post_title = 'Tp Clients';
			if ( isset( $tp_client_title ) && ! empty( $tp_client_title ) ) {
				$client_post_title = $this->tpae_post_type_get_option( 'post_type', 'client_plugin_title' );
			}

			$labels = array(
				// Translators: %s is the plural name of the post type.
				'name'                  => sprintf( _x( '%s', 'Post Type General Name', 'tpebl' ), $client_post_title ),
				// Translators: %s is the singular name of the post type.
				'singular_name'         => sprintf( _x( '%s', 'Post Type Singular Name', 'tpebl' ), $client_post_title ),
				'menu_name'             => esc_html( $client_post_title ),
				'name_admin_bar'        => esc_html( $client_post_title ),
				'archives'              => esc_html__( 'Item Archives', 'tpebl' ),
				'attributes'            => esc_html__( 'Item Attributes', 'tpebl' ),
				'parent_item_colon'     => esc_html__( 'Parent Item:', 'tpebl' ),
				'all_items'             => esc_html__( 'All Items', 'tpebl' ),
				'add_new_item'          => esc_html__( 'Add New Item', 'tpebl' ),
				'add_new'               => esc_html__( 'Add New', 'tpebl' ),
				'new_item'              => esc_html__( 'New Item', 'tpebl' ),
				'edit_item'             => esc_html__( 'Edit Item', 'tpebl' ),
				'update_item'           => esc_html__( 'Update Item', 'tpebl' ),
				'view_item'             => esc_html__( 'View Item', 'tpebl' ),
				'view_items'            => esc_html__( 'View Items', 'tpebl' ),
				'search_items'          => esc_html__( 'Search Item', 'tpebl' ),
				'not_found'             => esc_html__( 'Not found', 'tpebl' ),
				'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'tpebl' ),
				'featured_image'        => esc_html__( 'Featured Image', 'tpebl' ),
				'set_featured_image'    => esc_html__( 'Set featured image', 'tpebl' ),
				'remove_featured_image' => esc_html__( 'Remove featured image', 'tpebl' ),
				'use_featured_image'    => esc_html__( 'Use as featured image', 'tpebl' ),
				'insert_into_item'      => esc_html__( 'Insert into item', 'tpebl' ),
				'uploaded_to_this_item' => esc_html__( 'Uploaded to this item', 'tpebl' ),
				'items_list'            => esc_html__( 'Items list', 'tpebl' ),
				'items_list_navigation' => esc_html__( 'Items list navigation', 'tpebl' ),
				'filter_items_list'     => esc_html__( 'Filter items list', 'tpebl' ),
			);

			$args = array(
				'label'               => esc_html__( 'Clients', 'tpebl' ),
				'description'         => esc_html__( 'Post Type Description', 'tpebl' ),
				'labels'              => $labels,
				'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions' ),
				'hierarchical'        => false,
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'menu_position'       => 68,
				'show_in_admin_bar'   => true,
				'show_in_nav_menus'   => true,
				'can_export'          => true,
				'has_archive'         => true,
				'exclude_from_search' => false,
				'publicly_queryable'  => true,
				'capability_type'     => 'page',
			);

			register_post_type( $post_name, $args );
		}

		/**
		 * Clients_category
		 *
		 * @since 6.0.0
		 */
		public function tpae_ele_clients_category() {

			$status = $this->tpae_post_type_get_option( 'post_type', 'client_post_type' );

			if ( empty( $status ) ) {
				return;
			} elseif ( 'disable' === $status ) {
				return;
			}

			$post_name = $this->tpae_post_type_get_option( 'post_type', 'client_plugin_name' );
			if ( isset( $post_name ) && ! empty( $post_name ) ) {
				$post_name = $this->tpae_post_type_get_option( 'post_type', 'client_plugin_name' );
			} else {
				$post_name = 'theplus_clients';
			}
			$category_name = $this->tpae_post_type_get_option( 'post_type', 'client_category_plugin_name' );
			if ( isset( $category_name ) && ! empty( $category_name ) ) {
				$category_name = $this->tpae_post_type_get_option( 'post_type', 'client_category_plugin_name' );
			} else {
				$category_name = 'theplus_clients_cat';
			}

			$tp_client_title   = $this->tpae_post_type_get_option( 'post_type', 'client_plugin_title' );
			$client_post_title = 'Tp Clients';
			if ( isset( $tp_client_title ) && ! empty( $tp_client_title ) ) {
				$client_post_title = $this->tpae_post_type_get_option( 'post_type', 'client_plugin_title' );
			}

			$labels = array(
				'name'                       => $client_post_title . ' Categories',
				'singular_name'              => $client_post_title . ' Category',
				'menu_name'                  => $client_post_title . ' Category',
				'all_items'                  => 'All Items',
				'parent_item'                => 'Parent Item',
				'parent_item_colon'          => 'Parent Item:',
				'new_item_name'              => 'New Item Name',
				'add_new_item'               => 'Add New Item',
				'edit_item'                  => 'Edit Item',
				'update_item'                => 'Update Item',
				'view_item'                  => 'View Item',
				'separate_items_with_commas' => 'Separate items with commas',
				'add_or_remove_items'        => 'Add or remove items',
				'choose_from_most_used'      => 'Choose from the most used',
				'popular_items'              => 'Popular Items',
				'search_items'               => 'Search Items',
				'not_found'                  => 'Not Found',
			);
			$args   = array(
				'labels'            => $labels,
				'hierarchical'      => true,
				'public'            => true,
				'show_ui'           => true,
				'show_admin_column' => true,
				'show_in_nav_menus' => true,
				'show_tagcloud'     => true,
			);
			register_taxonomy( $category_name, array( $post_name ), $args );
		}

		/**
		 * Testimonials_func
		 *
		 * @since 6.0.0
		 */
		public function tpae_ele_testimonial() {

			$status = $this->tpae_post_type_get_option( 'post_type', 'testimonial_post_type' );

			if ( empty( $status ) ) {
				return;
			} elseif ( 'disable' === $status ) {
				return;
			}

			$post_name = $this->tpae_post_type_get_option( 'post_type', 'testimonial_plugin_name' );
			if ( isset( $post_name ) && ! empty( $post_name ) ) {
				$post_name = $this->tpae_post_type_get_option( 'post_type', 'testimonial_plugin_name' );
			} else {
				$post_name = 'theplus_testimonial';
			}

			$tp_testimonial_title      = $this->tpae_post_type_get_option( 'post_type', 'testimonial_plugin_title' );
			$tp_testimonial_post_title = 'TP Testimonials';
			if ( isset( $tp_testimonial_title ) && ! empty( $tp_testimonial_title ) ) {
				$tp_testimonial_post_title = $this->tpae_post_type_get_option( 'post_type', 'testimonial_plugin_title' );
			}

			$labels = array(
				// Translators: %s is the post type general name.
				'name'                  => sprintf( _x( '%s', 'Post Type General Name', 'tpebl' ), $tp_testimonial_post_title ),
				// Translators: %s is the post type singular name.
				'singular_name'         => sprintf( _x( '%s', 'Post Type Singular Name', 'tpebl' ), $tp_testimonial_post_title ),
				'menu_name'             => esc_html( $tp_testimonial_post_title ),
				'name_admin_bar'        => esc_html( $tp_testimonial_post_title ),
				'archives'              => esc_html__( 'Item Archives', 'tpebl' ),
				'parent_item_colon'     => esc_html__( 'Parent Item:', 'tpebl' ),
				'all_items'             => esc_html__( 'All Items', 'tpebl' ),
				'add_new_item'          => esc_html__( 'Add New Item', 'tpebl' ),
				'add_new'               => esc_html__( 'Add New', 'tpebl' ),
				'new_item'              => esc_html__( 'New Item', 'tpebl' ),
				'edit_item'             => esc_html__( 'Edit Item', 'tpebl' ),
				'update_item'           => esc_html__( 'Update Item', 'tpebl' ),
				'view_item'             => esc_html__( 'View Item', 'tpebl' ),
				'search_items'          => esc_html__( 'Search Item', 'tpebl' ),
				'not_found'             => esc_html__( 'Not found', 'tpebl' ),
				'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'tpebl' ),
				'featured_image'        => esc_html__( 'Profile Image', 'tpebl' ),
				'set_featured_image'    => esc_html__( 'Set profile image', 'tpebl' ),
				'remove_featured_image' => esc_html__( 'Remove profile image', 'tpebl' ),
				'use_featured_image'    => esc_html__( 'Use as profile image', 'tpebl' ),
				'insert_into_item'      => esc_html__( 'Insert into item', 'tpebl' ),
				'uploaded_to_this_item' => esc_html__( 'Uploaded to this item', 'tpebl' ),
				'items_list'            => esc_html__( 'Items list', 'tpebl' ),
				'items_list_navigation' => esc_html__( 'Items list navigation', 'tpebl' ),
				'filter_items_list'     => esc_html__( 'Filter items list', 'tpebl' ),
			);

			$args = array(
				'label'               => esc_html__( 'TP Testimonials', 'tpebl' ),
				'description'         => esc_html__( 'Post Type Description', 'tpebl' ),
				'labels'              => $labels,
				'supports'            => array( 'title', 'thumbnail', 'revisions' ),
				'hierarchical'        => false,
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'menu_icon'           => 'dashicons-testimonial',
				'menu_position'       => 68,
				'show_in_admin_bar'   => true,
				'show_in_nav_menus'   => true,
				'can_export'          => true,
				'has_archive'         => true,
				'exclude_from_search' => false,
				'publicly_queryable'  => true,
				'capability_type'     => 'page',
			);

			register_post_type( $post_name, $args );
		}

		/**
		 * Testimonial_category
		 *
		 * @since 6.0.0
		 */
		public function tpae_ele_testimonial_category() {

			$status = $this->tpae_post_type_get_option( 'post_type', 'testimonial_post_type' );

			if ( empty( $status ) ) {
				return;
			} elseif ( 'disable' === $status ) {
				return;
			}

			$post_name = $this->tpae_post_type_get_option( 'post_type', 'testimonial_plugin_name' );
			if ( isset( $post_name ) && ! empty( $post_name ) ) {
				$post_name = $this->tpae_post_type_get_option( 'post_type', 'testimonial_plugin_name' );
			} else {
				$post_name = 'theplus_testimonial';
			}
			$category_name = $this->tpae_post_type_get_option( 'post_type', 'testimonial_category_plugin_name' );
			if ( isset( $category_name ) && ! empty( $category_name ) ) {
				$category_name = $this->tpae_post_type_get_option( 'post_type', 'testimonial_category_plugin_name' );
			} else {
				$category_name = 'theplus_testimonial_cat';
			}

			$tp_testimonial_title      = $this->tpae_post_type_get_option( 'post_type', 'testimonial_plugin_title' );
			$tp_testimonial_post_title = 'TP Testimonials';
			if ( isset( $tp_testimonial_title ) && ! empty( $tp_testimonial_title ) ) {
				$tp_testimonial_post_title = $this->tpae_post_type_get_option( 'post_type', 'testimonial_plugin_title' );
			}

			$labels = array(
				'name'                       => $tp_testimonial_post_title . ' Categories',
				'singular_name'              => $tp_testimonial_post_title . ' Category',
				'menu_name'                  => $tp_testimonial_post_title . ' Category',
				'all_items'                  => 'All Items',
				'parent_item'                => 'Parent Item',
				'parent_item_colon'          => 'Parent Item:',
				'new_item_name'              => 'New Item Name',
				'add_new_item'               => 'Add New Item',
				'edit_item'                  => 'Edit Item',
				'update_item'                => 'Update Item',
				'view_item'                  => 'View Item',
				'separate_items_with_commas' => 'Separate items with commas',
				'add_or_remove_items'        => 'Add or remove items',
				'choose_from_most_used'      => 'Choose from the most used',
				'popular_items'              => 'Popular Items',
				'search_items'               => 'Search Items',
				'not_found'                  => 'Not Found',
			);

			$args = array(
				'labels'            => $labels,
				'hierarchical'      => true,
				'public'            => true,
				'show_ui'           => true,
				'show_admin_column' => true,
				'show_in_nav_menus' => true,
				'show_tagcloud'     => true,
			);

			register_taxonomy( $category_name, array( $post_name ), $args );
		}

		/**
		 * Testimonial_category
		 *
		 * @since 6.0.0
		 */
		public function tpae_ele_team_member_function() {

			$status = $this->tpae_post_type_get_option( 'post_type', 'team_member_post_type' );

			if ( empty( $status ) ) {
				return;
			} elseif ( 'disable' === $status ) {
				return;
			}

			$post_name = $this->tpae_post_type_get_option( 'post_type', 'team_member_plugin_name' );
			if ( isset( $post_name ) && ! empty( $post_name ) ) {
				$post_name = $this->tpae_post_type_get_option( 'post_type', 'team_member_plugin_name' );
			} else {
				$post_name = 'theplus_team_member';
			}

			$team_member_plugin_title = $this->tpae_post_type_get_option( 'post_type', 'team_member_plugin_title' );
			$team_member_title        = 'TP Team Member';
			if ( isset( $team_member_plugin_title ) && ! empty( $team_member_plugin_title ) ) {
				$team_member_title = $this->tpae_post_type_get_option( 'post_type', 'team_member_plugin_title' );
			}

			$labels = array(
				// Translators: %s is the post type general name.
				'name'                  => sprintf( _x( '%s', 'Post Type General Name', 'tpebl' ), $team_member_title ),
				// Translators: %s is the post type singular name.
				'singular_name'         => sprintf( _x( '%s', 'Post Type Singular Name', 'tpebl' ), $team_member_title ),
				'menu_name'             => esc_html( $team_member_title ),
				'name_admin_bar'        => esc_html( $team_member_title ),
				'archives'              => esc_html__( 'Item Archives', 'tpebl' ),
				'attributes'            => esc_html__( 'Item Attributes', 'tpebl' ),
				'parent_item_colon'     => esc_html__( 'Parent Item:', 'tpebl' ),
				'all_items'             => esc_html__( 'All Items', 'tpebl' ),
				'add_new_item'          => esc_html__( 'Add New Item', 'tpebl' ),
				'add_new'               => esc_html__( 'Add New', 'tpebl' ),
				'new_item'              => esc_html__( 'New Item', 'tpebl' ),
				'edit_item'             => esc_html__( 'Edit Item', 'tpebl' ),
				'update_item'           => esc_html__( 'Update Item', 'tpebl' ),
				'view_item'             => esc_html__( 'View Item', 'tpebl' ),
				'view_items'            => esc_html__( 'View Items', 'tpebl' ),
				'search_items'          => esc_html__( 'Search Item', 'tpebl' ),
				'not_found'             => esc_html__( 'Not found', 'tpebl' ),
				'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'tpebl' ),
				'featured_image'        => esc_html__( 'Featured Image', 'tpebl' ),
				'set_featured_image'    => esc_html__( 'Set featured image', 'tpebl' ),
				'remove_featured_image' => esc_html__( 'Remove featured image', 'tpebl' ),
				'use_featured_image'    => esc_html__( 'Use as featured image', 'tpebl' ),
				'insert_into_item'      => esc_html__( 'Insert into item', 'tpebl' ),
				'uploaded_to_this_item' => esc_html__( 'Uploaded to this item', 'tpebl' ),
				'items_list'            => esc_html__( 'Items list', 'tpebl' ),
				'items_list_navigation' => esc_html__( 'Items list navigation', 'tpebl' ),
				'filter_items_list'     => esc_html__( 'Filter items list', 'tpebl' ),
			);

			$args = array(
				'label'               => esc_html__( 'TP Team Member', 'tpebl' ),
				'description'         => esc_html__( 'Post Type Description', 'tpebl' ),
				'labels'              => $labels,
				'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields' ),
				'hierarchical'        => false,
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'menu_position'       => 68,
				'show_in_admin_bar'   => true,
				'show_in_nav_menus'   => true,
				'can_export'          => true,
				'has_archive'         => true,
				'menu_icon'           => 'dashicons-id-alt',
				'exclude_from_search' => false,
				'publicly_queryable'  => true,
				'capability_type'     => 'page',
			);

			register_post_type( $post_name, $args );
		}

		/**
		 * Testimonial_category
		 *
		 * @since 6.0.0
		 */
		public function tpae_ele_team_member_category() {

			$status = $this->tpae_post_type_get_option( 'post_type', 'team_member_post_type' );

			if ( empty( $status ) ) {
				return;
			} elseif ( 'disable' === $status ) {
				return;
			}

			$post_name = $this->tpae_post_type_get_option( 'post_type', 'team_member_plugin_name' );
			if ( isset( $post_name ) && ! empty( $post_name ) ) {
				$post_name = $this->tpae_post_type_get_option( 'post_type', 'team_member_plugin_name' );
			} else {
				$post_name = 'theplus_team_member';
			}
			$category_name = $this->tpae_post_type_get_option( 'post_type', 'team_member_category_plugin_name' );
			if ( isset( $category_name ) && ! empty( $category_name ) ) {
				$category_name = $this->tpae_post_type_get_option( 'post_type', 'team_member_category_plugin_name' );
			} else {
				$category_name = 'theplus_team_member_cat';
			}
			$team_member_plugin_title = $this->tpae_post_type_get_option( 'post_type', 'team_member_plugin_title' );
			$team_member_title        = 'TP Team Member';
			if ( isset( $team_member_plugin_title ) && ! empty( $team_member_plugin_title ) ) {
				$team_member_title = $this->tpae_post_type_get_option( 'post_type', 'team_member_plugin_title' );
			}
			$labels = array(
				'name'                       => $team_member_title . ' Categories',
				'singular_name'              => $team_member_title . ' Category',
				'menu_name'                  => $team_member_title . ' Category',
				'all_items'                  => 'All Items',
				'parent_item'                => 'Parent Item',
				'parent_item_colon'          => 'Parent Item:',
				'new_item_name'              => 'New Item Name',
				'add_new_item'               => 'Add New Item',
				'edit_item'                  => 'Edit Item',
				'update_item'                => 'Update Item',
				'view_item'                  => 'View Item',
				'separate_items_with_commas' => 'Separate items with commas',
				'add_or_remove_items'        => 'Add or remove items',
				'choose_from_most_used'      => 'Choose from the most used',
				'popular_items'              => 'Popular Items',
				'search_items'               => 'Search Items',
				'not_found'                  => 'Not Found',
			);
			$args   = array(
				'labels'            => $labels,
				'hierarchical'      => true,
				'public'            => true,
				'show_ui'           => true,
				'show_admin_column' => true,
				'show_in_nav_menus' => true,
				'show_tagcloud'     => true,
			);
			register_taxonomy( $category_name, array( $post_name ), $args );
		}
	}

	Tpae_Dashboard_Listing::get_instance();
}
