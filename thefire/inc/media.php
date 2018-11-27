<?php

add_action( 'add_meta_boxes', function() {
    remove_meta_box( 'postimagediv','post','side' );
    add_meta_box( 'the-fire-post-thumbnail', __( 'Post thumbnail', 'woocommerce' ), 'the_fire_post_thumbnail', 'post', 'side', 'low' );
}, 30 );

function the_fire_post_thumbnail($post) {
    $thumbnail_id = get_post_meta( $post->ID, '_thumbnail_id', true );
    echo '<div class="featured-image">';
    echo _wp_post_thumbnail_html( $thumbnail_id, $post->ID );
    echo '</div>';

    printf( '<input type="hidden" name="_fire_media_nonce" value="%s" />',
        wp_create_nonce(plugin_basename(__FILE__) ));

    echo '<div class="photo-credit-featured">';
    printf( '<p><label for="%s">%s</label></p>', '_photo_credit', __('Photo Credit', 'fire') );
    printf('<p><input style="%s" type="text" name="%s" id="%s" value="%s" /></p>',
        'width: 99%;', '_photo_credit', '_photo_credit',
        esc_attr( get_post_meta( $post->ID, '_photo_credit', true ) ));
    echo '</div>';
}

add_action( 'save_post', function($post_id, $post) {
    //  verify the nonce
    if ( !isset($_POST['_fire_media_nonce']) || !wp_verify_nonce( $_POST['_fire_media_nonce'], plugin_basename(__FILE__) ) ) return;

    //  don't try to save the data under autosave, ajax, or future post.
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
    if ( defined('DOING_AJAX') && DOING_AJAX ) return;
    if ( defined('DOING_CRON') && DOING_CRON ) return;

    //  is the user allowed to edit?
    if ( ! current_user_can( 'edit_posts' ))
        return;

    $fields = array('_photo_credit');

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

add_action( 'admin_enqueue_scripts', function() {
    global $post;
    $screen       = get_current_screen();
    if ( in_array( $screen->id, array( 'post', 'edit-post') ) ) {
        wp_enqueue_media();
        wp_enqueue_style( 'fire-post-media', get_template_directory_uri() . '/css/media.css', array(), '0.0.1');
        wp_enqueue_script( 'fire-post-media', get_template_directory_uri() . '/js/media.js', array('backbone'), '0.0.1' );
    }
});

add_filter('admin_post_thumbnail_html', function($content, $post) {
    global $content_width, $_wp_additional_image_sizes;
    $post               = get_post( $post );
    if ($post->post_type != 'post') {
        return $content;
    }

    $post_type_object   = get_post_type_object( $post->post_type );
    $set_thumbnail_link = '<p class="hide-if-no-js"><a title="%s" href="%s" id="set-post-thumbnail" class="thickbox">%s</a></p>';
    $upload_iframe_src  = get_upload_iframe_src( 'image', $post->ID );
    $thumbnail_id       = get_post_meta( $post->ID, '_thumbnail_id', true );

    $content = sprintf( $set_thumbnail_link,
        esc_attr( $post_type_object->labels->set_featured_image ),
        esc_url( $upload_iframe_src ),
        esc_html( $post_type_object->labels->set_featured_image )
    );

    if ( $thumbnail_id && get_post( $thumbnail_id ) ) {
        $old_content_width = $content_width;
        $content_width = 266;
        if ( !isset( $_wp_additional_image_sizes['post-thumbnail'] ) )
            $thumbnail_html = wp_get_attachment_image( $thumbnail_id, array( $content_width, $content_width ) );
        else
            $thumbnail_html = wp_get_attachment_image( $thumbnail_id, 'post-thumbnail' );
        if ( !empty( $thumbnail_html ) ) {
            $ajax_nonce = wp_create_nonce( 'set_post_thumbnail-' . $post->ID );
            $content = sprintf( $set_thumbnail_link,
                esc_attr( $post_type_object->labels->set_featured_image ),
                esc_url( $upload_iframe_src ),
                $thumbnail_html
            );
            $content .= '<p class="hide-if-no-js"><a href="#" id="remove-post-thumbnail"">' . esc_html( $post_type_object->labels->remove_featured_image ) . '</a></p>';
        }
        $content_width = $old_content_width;
    }
    return $content;
}, 10, 2);