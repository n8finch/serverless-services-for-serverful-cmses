<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register a custom post type called "breaking new".
 *
 * @see get_post_type_labels() for label keys.
 */
function breaking_news_cpt_init() {
    $labels = array(
        'name'                  => _x( 'Breaking News', 'Post type general name', 'textdomain' ),
        'singular_name'         => _x( 'Breaking News', 'Post type singular name', 'textdomain' ),
        'menu_name'             => _x( 'Breaking News', 'Admin Menu text', 'textdomain' ),
        'name_admin_bar'        => _x( 'Breaking News', 'Add New on Toolbar', 'textdomain' ),
        'add_new'               => __( 'Add New', 'textdomain' ),
        'add_new_item'          => __( 'Add New Breaking News', 'textdomain' ),
        'new_item'              => __( 'New Breaking News', 'textdomain' ),
        'edit_item'             => __( 'Edit Breaking News', 'textdomain' ),
        'view_item'             => __( 'View Breaking News', 'textdomain' ),
        'all_items'             => __( 'All Breaking News', 'textdomain' ),
        'search_items'          => __( 'Search Breaking News', 'textdomain' ),
        'parent_item_colon'     => __( 'Parent Breaking News:', 'textdomain' ),
        'not_found'             => __( 'No breaking news found.', 'textdomain' ),
        'not_found_in_trash'    => __( 'No breaking news found in Trash.', 'textdomain' ),
        'featured_image'        => _x( 'Breaking New Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'archives'              => _x( 'Breaking New archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
        'insert_into_item'      => _x( 'Insert into breaking new', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this breaking new', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain' ),
        'filter_items_list'     => _x( 'Filter breaking news list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
        'items_list_navigation' => _x( 'Breaking News list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
        'items_list'            => _x( 'Breaking News list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),
    );
 
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'menu_icon'          => 'dashicons-megaphone',
        'rewrite'            => array( 'slug' => 'breaking-news' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
        'show_in_rest'       => true
    );
 
    register_post_type( 'breaking-news', $args );
}
 
add_action( 'init', 'breaking_news_cpt_init' );