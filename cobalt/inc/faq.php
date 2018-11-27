<?php 
// register News custom post type
add_action('init', 'cobalt_register_faq_type');

function cobalt_register_faq_type() {
    register_post_type( 'faq',
        array(
            'labels' => array(
                'name' => __( 'FAQs' ),
                'singular_name' => __( 'FAQ' ),
                'add_new' => __( 'Add New' ),
                'add_new_item' => __( 'Add New FAQ' ),
                'edit' => __( 'Edit' ),
                'edit_item' => __( 'Edit FAQ' ),
                'new_item' => __( 'New FAQ' ),
                'view' => __( 'View FAQs' ),
                'view_item' => __( 'View FAQs' ),
                'search_items' => __( 'Search FAQs' ),
                'not_found' => __( 'No FAQs found' ),
                'not_found_in_trash' => __( 'No FAQs found in Trash' )
            ),
            'description' => __( 'These Frequently Asked Questions appear in alphabetical order, sorted by general topic. You may also use the Search tool on this site to find questions and answers by any keyword.', 'cobalt' ),
            'public' => true,
            'query_var' => true,
            'has_archive' => true,
            'menu_position' => 20,
            'rewrite'          => array(
                'slug'         => 'faq',
                'hierarchical' => true,
            )
        )
    );
};

?>