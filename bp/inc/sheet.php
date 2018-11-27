<?php

// register sheet custom post type
add_action('init', 'bp_register_sheet_post_type');

function bp_register_sheet_post_type() {
    register_post_type( 'sheet',
        array(
            'labels' => array(
                'name' => __( 'Sheets' ),
                'singular_name' => __( 'Sheet' ),
                'add_new' => __( 'Add New' ),
                'add_new_item' => __( 'Add New Sheet' ),
                'edit' => __( 'Edit' ),
                'edit_item' => __( 'Edit Sheet' ),
                'new_item' => __( 'New Sheet' ),
                'view' => __( 'View Sheet' ),
                'view_item' => __( 'View Sheet' ),
                'search_items' => __( 'Search Sheet' ),
                'not_found' => __( 'No Sheet found' ),
                'not_found_in_trash' => __( 'No Sheet found in Trash' )
            ),
            'public' => true,
            'query_var' => true,
            'has_archive' => true,
            'menu_position' => 20,
            'rewrite'          => array(
                'slug'         => 'sheet',
                'hierarchical' => true,
            )
        )
    );
};

add_action('admin_menu', 'bp_sheet_add_metabox');

function bp_sheet_add_metabox() {
    add_meta_box('sheet', __('sheet', 'bp'), 'bp_sheet_add_metaboxes', 'sheet', 'normal', 'high');
}

function bp_sheet_add_metaboxes() {
    global $post;

    printf( '<input type="hidden" name="_bp_sheet_nonce" value="%s" />', wp_create_nonce( plugin_basename(__FILE__) ) );
    printf( '<p><label for="%s">%s</label></p>', '_bp_sheet_file', __('Sheet File', 'bp') );
    printf( '<input type="text" name="_bp_sheet_file" class="_bp_sheet_file" value="%s" />', esc_attr( get_post_meta( $post->ID, '_bp_sheet_file', true )));
    printf( '<button type="button" class="button new bp_sheet_file" id="bp_sheet_file">%s</button>', __('Insert File', 'bp'));
}

add_action( 'save_post', function($post_id, $post) {
    //  verify the nonce
    if ( !isset($_POST['_bp_sheet_nonce']) || !wp_verify_nonce( $_POST['_bp_sheet_nonce'], plugin_basename(__FILE__) ) ) return;

    //  don't try to save the data under autosave, ajax, or future post.
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
    if ( defined('DOING_AJAX') && DOING_AJAX ) return;
    if ( defined('DOING_CRON') && DOING_CRON ) return;

    //  is the user allowed to edit the URL?
    if ( ! current_user_can( 'edit_posts' ) || $post->post_type != 'sheet' ) return;

    $fields = array(
        '_bp_sheet_file',
    );

    foreach ($fields as $field) {
        $value = isset( $_POST[$field] ) ? $_POST[$field] : '';

        if ( $value ) {
            //  save/update
            update_post_meta($post->ID, $field, $value);
        } else {
            //  delete if blank
            delete_post_meta($post->ID, $field);
        }
    }
}, 1, 2 );