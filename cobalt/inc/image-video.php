<?php 
// register News custom post type
add_action('init', 'cobalt_register_media_type');

function cobalt_register_media_type() {
    register_post_type( 'image_video',
        array(
            'labels' => array(
                'name' => __( 'Images & Videos' ),
                'singular_name' => __( 'Image and Video' ),
                'add_new' => __( 'Add New' ),
                'add_new_item' => __( 'Add New Image and Video' ),
                'edit' => __( 'Edit' ),
                'edit_item' => __( 'Edit Image and Video' ),
                'new_item' => __( 'New Image and Video' ),
                'view' => __( 'View Images and Videos' ),
                'view_item' => __( 'View Images and Videos' ),
                'search_items' => __( 'Search Images and Videos' ),
                'not_found' => __( 'No Images and Videos found' ),
                'not_found_in_trash' => __( 'No Images and Videos found in Trash' )
            ),
            'public' => true,
            'query_var' => true,
            'supports' => array('thumbnail','title','editor'),
            'has_archive' => true,
            'menu_position' => 20,
            'rewrite'          => array(
                'slug'         => 'image_video',
                'hierarchical' => true,
            )
        )
    );
};

add_action('admin_menu', 'cobalt_image_video_add_metabox');

function cobalt_image_video_add_metabox() {
    add_meta_box('image_video', __('Image/Video', 'cobalt'), 'cobalt_image_video_add_metaboxes', 'image_video', 'normal', 'high');
}

function cobalt_image_video_add_metaboxes() {
    global $post;

    printf( '<input type="hidden" name="_cobalt_image_video_nonce" value="%s" />', wp_create_nonce( plugin_basename(__FILE__) ) );
    printf( '<p><label for="%s">%s</label></p>', '_cobalt_image_video_file', __('Insert File (Image/Video)', 'cobalt') );
    printf( '<input type="text" name="_cobalt_image_video_file" class="_cobalt_image_video_file" value="%s" />', esc_attr( get_post_meta( $post->ID, '_cobalt_image_video_file', true )));
    printf( '<button type="button" class="button new cobalt_image_video_file" id="cobalt_image_video_file">%s</button>', __('Insert File', 'cobalt'));
}

add_action( 'save_post', function($post_id, $post) {
    //  verify the nonce
    if ( !isset($_POST['_cobalt_image_video_nonce']) || !wp_verify_nonce( $_POST['_cobalt_image_video_nonce'], plugin_basename(__FILE__) ) ) return;

    //  don't try to save the data under autosave, ajax, or future post.
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
    if ( defined('DOING_AJAX') && DOING_AJAX ) return;
    if ( defined('DOING_CRON') && DOING_CRON ) return;

    //  is the user allowed to edit the URL?
    if ( ! current_user_can( 'edit_posts' ) || $post->post_type != 'image_video' ) return;

    $fields = array(
        '_cobalt_image_video_file',
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
?>