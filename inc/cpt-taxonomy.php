<?php
function tweel_register_custom_post_types()
{

    // Register Locations
    $labels = array(
        'name'                  => _x('Location', 'post type general name'),
        'singular_name'         => _x('Location', 'post type singular name'),
        'menu_name'             => _x('Locations', 'admin menu'),
        'name_admin_bar'        => _x('Location', 'add new on admin bar'),
        'add_new'               => _x('Add New', 'Location'),
        'add_new_item'          => __('Add New Location'),
        'new_item'              => __('New Location'),
        'edit_item'             => __('Edit Location'),
        'view_item'             => __('View Location'),
        'all_items'             => __('All Locations'),
        'search_items'          => __('Search Locations'),
        'parent_item_colon'     => __('Parent Locations:'),
        'not_found'             => __('No Locations found.'),
        'not_found_in_trash'    => __('No Locations found in Trash.'),
        'archives'              => __('Location Archives'),
        'insert_into_item'      => __('Insert into Location'),
        'uploaded_to_this_item' => __('Uploaded to this Location'),
        'filter_item_list'      => __('Filter Locations list'),
        'items_list_navigation' => __('Locations list navigation'),
        'items_list'            => __('Locations list'),
        'featured_image'        => __('Location featured image'),
        'set_featured_image'    => __('Set Location featured image'),
        'remove_featured_image' => __('Remove Location featured image'),
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
        'rewrite'            => array('slug' => 'locations'),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-location',
        'supports'           => array('title', 'editor', 'thumbnail'),
    );

    register_post_type('tweel-location', $args);





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
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-businessperson',
        'supports'           => array('title', 'editor'),
    );

    register_post_type('tweel-career', $args);
}
add_action('init', 'tweel_register_custom_post_types');



function tweel_register_taxonomies()
{
    // Add Career Location taxonomy
    $labels = array(
        'name'              => _x('Career Location', 'taxonomy general name'),
        'singular_name'     => _x('Career Location', 'taxonomy singular name'),
        'search_items'      => __('Search Career Location'),
        'all_items'         => __('All Career Location'),
        'parent_item'       => __('Parent Career Location'),
        'parent_item_colon' => __('Parent Career Location:'),
        'edit_item'         => __('Edit Career Location'),
        'view_item'         => __('View Career Location'),
        'update_item'       => __('Update Career Location'),
        'add_new_item'      => __('Add New Career Location'),
        'new_item_name'     => __('New Career Location Name'),
        'menu_name'         => __('Career Location'),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'show_in_nav_menu'  => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'tweel-career-locations'),
    );
    register_taxonomy('tweel-career-locations', array('tweel-career'), $args);
}
add_action('init', 'tweel_register_taxonomies');




function tweel_update_custom_terms($post_id)
{

    // only update terms if it's a location post
    if ('tweel-location' != get_post_type($post_id)) {
        return;
    }

    // don't create or update terms for system generated posts
    if (get_post_status($post_id) == 'auto-draft') {
        return;
    }

    /*
    * Grab the post title and slug to use as the new 
    * or updated term name and slug
    */
    $term_title = get_the_title($post_id);
    $term_slug = get_post($post_id)->post_name;

    /*
    * Check if a corresponding term already exists by comparing 
    * the post ID to all existing term descriptions. 
    */
    $existing_terms = get_terms(
        'tweel-career-locations',
        array(
            'hide_empty' => false
        )
    );

    foreach ($existing_terms as $term) {
        if ($term->description == $post_id) {
            //term already exists, so update it and we're done
            wp_update_term(
                $term->term_id,
                'tweel-career-locations',
                array(
                    'name' => $term_title,
                    'slug' => $term_slug
                )
            );
            return;
        }
    }

    /* 
    * If we didn't find a match above, this is a new post, 
    * so create a new term.
    */
    wp_insert_term(
        $term_title,
        'tweel-career-locations',
        array(
            'slug' => $term_slug,
            'description' => $post_id
        )
    );
}
//run the update function whenever a post is created 
add_action('save_post', 'tweel_update_custom_terms');
