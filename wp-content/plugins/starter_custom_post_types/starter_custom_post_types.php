<?php
/**
 * Plugin Name: Custom Post Types - Starter
 * Plugin URI: https://web.ejimford.com/
 * Description: This plugin contains the custom post types for this website.
 * Version: 1.0
 * Author: e. james ford
 * Author URI: https://web.ejimford.com
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 */

/**
 * Custom Post Types
 */
 
 
if ( ! function_exists('custom_post_type') ) {
    function custom_post_type() {

/*
        //Copy Paste for New Post Type
        // Find/Replace "Generic"

        $labels = array(
            'name'                  => _x( 'Generics', 'Post Type General Name', 'starter' ),
            'singular_name'         => _x( 'Generic', 'Post Type Singular Name', 'starter' ),
            'menu_name'             => __( 'Generics', 'starter' ),
            'name_admin_bar'        => __( 'Generic', 'starter' ),
            'archives'              => __( 'Generic Archives', 'starter' ),
            'attributes'            => __( 'Generic Attributes', 'starter' ),
            'parent_item_colon'     => __( 'Parent Generic:', 'starter' ),
            'all_items'             => __( 'All Generics', 'starter' ),
            'add_new_item'          => __( 'Add New Generic', 'starter' ),
            'add_new'               => __( 'Add New', 'starter' ),
            'new_item'              => __( 'New Generic', 'starter' ),
            'edit_item'             => __( 'Edit Generic', 'starter' ),
            'update_item'           => __( 'Update Generic', 'starter' ),
            'view_item'             => __( 'View Generic', 'starter' ),
            'view_items'            => __( 'View Generic', 'starter' ),
            'search_items'          => __( 'Search Generic', 'starter' ),
            'not_found'             => __( 'Not found', 'starter' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'starter' ),
            'featured_image'        => __( 'Featured Image', 'starter' ),
            'set_featured_image'    => __( 'Set featured image', 'starter' ),
            'remove_featured_image' => __( 'Remove featured image', 'starter' ),
            'use_featured_image'    => __( 'Use as featured image', 'starter' ),
            'insert_into_item'      => __( 'Insert into Generic', 'starter' ),
            'uploaded_to_this_item' => __( 'Uploaded to this Generic', 'starter' ),
            'items_list'            => __( 'Generics list', 'starter' ),
            'items_list_navigation' => __( 'Generics list navigation', 'starter' ),
            'filter_items_list'     => __( 'Filter Generic list', 'starter' ),
        );
        $args = array(
            'label'                 => __( 'Generic', 'starter' ),
            'description'           => __( 'Generic Description', 'starter' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields' ),
            'taxonomies'            => array( 'category', 'post_tag' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 20,
            'menu_icon'             => 'dashicons-marker',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
        );
        register_post_type( 'generic', $args );
        // End Copy/Paste
*/
        // VVV #Paste Here VVV

	$labels = array(
		'name'                  => _x( 'Messages', 'Post Type General Name', 'deartomorrow' ),
		'singular_name'         => _x( 'message', 'Post Type Singular Name', 'deartomorrow' ),
		'menu_name'             => __( 'Messages', 'deartomorrow' ),
		'name_admin_bar'        => __( 'Message', 'deartomorrow' ),
		'archives'              => __( 'Message Archives', 'deartomorrow' ),
		'parent_item_colon'     => __( 'Parent Message', 'deartomorrow' ),
		'all_items'             => __( 'All Messages', 'deartomorrow' ),
		'add_new_item'          => __( 'Add New Message', 'deartomorrow' ),
		'add_new'               => __( 'Add New', 'deartomorrow' ),
		'new_item'              => __( 'New Message', 'deartomorrow' ),
		'edit_item'             => __( 'Edit Message', 'deartomorrow' ),
		'update_item'           => __( 'Update Message', 'deartomorrow' ),
		'view_item'             => __( 'View Message', 'deartomorrow' ),
		'search_items'          => __( 'Search Message', 'deartomorrow' ),
		'not_found'             => __( 'Not found', 'deartomorrow' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'deartomorrow' ),
		'featured_image'        => __( 'Featured Image', 'deartomorrow' ),
		'set_featured_image'    => __( 'Set featured image', 'deartomorrow' ),
		'remove_featured_image' => __( 'Remove featured image', 'deartomorrow' ),
		'use_featured_image'    => __( 'Use as featured image', 'deartomorrow' ),
		'insert_into_item'      => __( 'Insert into Message', 'deartomorrow' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Message', 'deartomorrow' ),
		'items_list'            => __( 'Messages list', 'deartomorrow' ),
		'items_list_navigation' => __( 'Messages list navigation', 'deartomorrow' ),
		'filter_items_list'     => __( 'Filter Messages list', 'deartomorrow' ),
	);
	$args = array(
		'label'                 => __( 'message', 'deartomorrow' ),
		'description'           => __( 'Messages to the future about climate change', 'deartomorrow' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields', ),
		'taxonomies'            => array( 'type', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-megaphone',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'message', $args );


    $labels = array(
        'name'                  => _x( 'Events', 'Post Type General Name', 'starter' ),
        'singular_name'         => _x( 'Event', 'Post Type Singular Name', 'starter' ),
        'menu_name'             => __( 'Events', 'starter' ),
        'name_admin_bar'        => __( 'Event', 'starter' ),
        'archives'              => __( 'Event Archives', 'starter' ),
        'attributes'            => __( 'Event Attributes', 'starter' ),
        'parent_item_colon'     => __( 'Parent Event:', 'starter' ),
        'all_items'             => __( 'All Events', 'starter' ),
        'add_new_item'          => __( 'Add New Event', 'starter' ),
        'add_new'               => __( 'Add New', 'starter' ),
        'new_item'              => __( 'New Event', 'starter' ),
        'edit_item'             => __( 'Edit Event', 'starter' ),
        'update_item'           => __( 'Update Event', 'starter' ),
        'view_item'             => __( 'View Event', 'starter' ),
        'view_items'            => __( 'View EventEvent', 'starter' ),
        'search_items'          => __( 'Search Event', 'starter' ),
        'not_found'             => __( 'Not found', 'starter' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'starter' ),
        'featured_image'        => __( 'Featured Image', 'starter' ),
        'set_featured_image'    => __( 'Set featured image', 'starter' ),
        'remove_featured_image' => __( 'Remove featured image', 'starter' ),
        'use_featured_image'    => __( 'Use as featured image', 'starter' ),
        'insert_into_item'      => __( 'Insert into Event', 'starter' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Event', 'starter' ),
        'items_list'            => __( 'Events list', 'starter' ),
        'items_list_navigation' => __( 'Events list navigation', 'starter' ),
        'filter_items_list'     => __( 'Filter Event list', 'starter' ),
    );
    $args = array(
        'label'                 => __( 'Event', 'starter' ),
        'description'           => __( 'Event Description', 'starter' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'author', 'excerpt', 'revisions', 'custom-fields' ),
        'taxonomies'            => array( 'category', 'post_tag' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 20,
        'menu_icon'             => 'dashicons-calendar-alt',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
    );
    register_post_type( 'deartomorrow_event', $args );
        
        
    $labels = array(
		'name'                       => _x( 'Types', 'Taxonomy General Name', 'deartomorrow' ),
		'singular_name'              => _x( 'Type', 'Taxonomy Singular Name', 'deartomorrow' ),
		'menu_name'                  => __( 'Types', 'deartomorrow' ),
		'all_items'                  => __( 'All Types', 'deartomorrow' ),
		'parent_item'                => __( 'Parent Type', 'deartomorrow' ),
		'parent_item_colon'          => __( 'Parent Type:', 'deartomorrow' ),
		'new_item_name'              => __( 'New Type', 'deartomorrow' ),
		'add_new_item'               => __( 'Add New Type', 'deartomorrow' ),
		'edit_item'                  => __( 'Edit Type', 'deartomorrow' ),
		'update_item'                => __( 'Update Type', 'deartomorrow' ),
		'view_item'                  => __( 'View Type', 'deartomorrow' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'deartomorrow' ),
		'add_or_remove_items'        => __( 'Add or remove type', 'deartomorrow' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'deartomorrow' ),
		'popular_items'              => __( 'Popular Types', 'deartomorrow' ),
		'search_items'               => __( 'Search Types', 'deartomorrow' ),
		'not_found'                  => __( 'Not Found', 'deartomorrow' ),
		'no_terms'                   => __( 'No Types', 'deartomorrow' ),
		'items_list'                 => __( 'Types list', 'deartomorrow' ),
		'items_list_navigation'      => __( 'Types list navigation', 'deartomorrow' ),
	);
	$capabilities = array(
		'manage_terms'               => 'manage_categories',
		'edit_terms'                 => 'manage_categories',
		'delete_terms'               => 'manage_categories',
		'assign_terms'               => 'read',
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'capabilities'               => $capabilities,
	);
	register_taxonomy( 'type', array( 'message' ), $args );        
        
        
    }
add_action( 'init', 'custom_post_type', 0 );

}

