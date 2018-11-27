<?php 
// register News custom post type
add_action('init', 'cobalt_register_safety_type');

function cobalt_register_safety_type() {
    register_post_type( 'safety',
        array(
            'labels' => array(
                'name' => __( 'Safety Messages' ),
                'singular_name' => __( 'Safety Message' ),
                'add_new' => __( 'Add New' ),
                'add_new_item' => __( 'Add New Safety Message' ),
                'edit' => __( 'Edit' ),
                'edit_item' => __( 'Edit Safety Message' ),
                'new_item' => __( 'New Safety Message' ),
                'view' => __( 'View Safety Messages' ),
                'view_item' => __( 'View Safety Messages' ),
                'search_items' => __( 'Search Safety Messages' ),
                'not_found' => __( 'No Safety Messages found' ),
                'not_found_in_trash' => __( 'No Safety Messages found in Trash' )
            ),
            'public' => true,
            'query_var' => true,
            'has_archive' => true,
            'menu_position' => 20,
            'rewrite'          => array(
                'slug'         => 'safety',
                'hierarchical' => true,
            )
        )
    );
};

?>