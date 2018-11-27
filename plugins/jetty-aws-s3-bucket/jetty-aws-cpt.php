<?php

function jbucket_register_custom_post_types() {
    // PRODUCT custom post type
    register_post_type('jbucket-aws', array(
        'labels' => array(
            'name' => __( 'Jetty AWS Bucket', 'jbucket'),
            'singular_name' => __( 'Buckets', 'jbucket' ),
            'add_new' => __( 'Add New' ),
            'add_new_item' => __( 'Add New Bucket', 'jbucket' ),
            'edit' => __( 'Edit', 'jbucket' ),
            'edit_item' => __( 'Edit Bucket', 'jbucket' ),
            'new_item' => __( 'New Bucket', 'jbucket' ),
            'view' => __( 'View Bucket', 'jbucket' ),
            'view_item' => __( 'View Bucket', 'jbucket' ),
            'search_items' => __( 'Search Buckets', 'jbucket' ),
            'not_found' => __( 'No Buckets found', 'jbucket' ),
            'not_found_in_trash' => __( 'No Buckets found in Trash', 'jbucket' )
        ),
        'exclude_from_search'   => true,
        'publicly_queryable'    => true,
        'public'                => true,
        'query_var'             => true,
        'capability_type'       => 'post',
        'supports'              => array( 'title', 'editor' ),
        'has_archive'           => 'jbucket-aws',
        'hierarchical'          => false,
        'show_in_menu'          => false,
        'map_meta_cap'          => true
    ));

}
add_action('init', 'jbucket_register_custom_post_types');