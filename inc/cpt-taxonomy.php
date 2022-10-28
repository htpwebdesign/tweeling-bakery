<?php
function tweel_register_custom_post_types()
{

    // Register Careers
    $labels = array(
        'name'                  => _x('Career', 'post type general name'),
        'singular_name'         => _x('Career', 'post type singular name'),
        'menu_name'             => _x('Careers', 'admin menu'),
        'name_admin_bar'        => _x('Career', 'add new on admin bar'),
        'add_new'               => _x('Add New', 'Career'),
        'add_new_item'          => __('Add New Career'),
        'new_item'              => __('New Career'),
        'edit_item'             => __('Edit Career'),
        'view_item'             => __('View Career'),
        'all_items'             => __('All Careers'),
        'search_items'          => __('Search Careers'),
        'parent_item_colon'     => __('Parent Careers:'),
        'not_found'             => __('No Careers found.'),
        'not_found_in_trash'    => __('No Careers found in Trash.'),
        'archives'              => __('Career Archives'),
        'insert_into_item'      => __('Insert into Career'),
        'uploaded_to_this_item' => __('Uploaded to this Career'),
        'filter_item_list'      => __('Filter Careers list'),
        'items_list_navigation' => __('Careers list navigation'),
        'items_list'            => __('Careers list'),
        'featured_image'        => __('Career featured image'),
        'set_featured_image'    => __('Set Career featured image'),
        'remove_featured_image' => __('Remove Career featured image'),
        'use_featured_image'    => __('Use as featured image'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'show_in_admin_bar'  => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'careers'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-archive',
        'supports'           => array('title', 'editor'),
    );

    register_post_type('tweel-career', $args);
}
add_action('init', 'tweel_register_custom_post_types');
