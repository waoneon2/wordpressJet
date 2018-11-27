<?php
/**
 * SWF File Upload
 * @package NCOC
 */
add_action( 'add_meta_boxes', 'ncoc_register_metaboxes' );
function ncoc_register_metaboxes() {
    add_meta_box('swf', __('SWF File', 'ncoc'), 'ncoc_swf_add_metaboxes', 'page', 'side', 'low');
}

function ncoc_image_rotator($post) {
    printf( '<input type="hidden" name="_ncoc_nonce" value="%s" />', wp_create_nonce( plugin_basename(__FILE__) ) );
    ?>
    <div id="image_rotator_container">
        <ul class="product_images">
            <?php
                if ( metadata_exists( 'post', $post->ID, '_image_rotator' ) ) {
                    $image_rotator = get_post_meta( $post->ID, '_image_rotator', true );


                    $attachments = array_filter( explode( ',', $image_rotator ) );

                    if ( ! empty( $attachments ) ) {
                        foreach ( $attachments as $attachment_id ) {
                            echo '<li class="image" data-attachment_id="' . esc_attr( $attachment_id ) . '">
                                ' . wp_get_attachment_image( $attachment_id, 'thumbnail' ) . '
                                <ul class="actions">
                                    <li><a href="#" class="delete tips" data-tip="' . esc_attr__( 'Delete image', 'ncoc' ) . '">' . __( 'Delete', 'ncoc' ) . '</a></li>
                                </ul>
                            </li>';
                        }
                    }
                }
            ?>
        </ul>

        <input type="hidden" id="image_rotator" name="image_rotator" value="<?php echo esc_attr( $image_rotator ); ?>" />

    </div>
    <p class="add_product_images hide-if-no-js">
        <a href="#" data-choose="<?php esc_attr_e( 'Add Images to Image Rotator', 'ncoc' ); ?>" data-update="<?php esc_attr_e( 'Add to image rotator', 'ncoc' ); ?>" data-delete="<?php esc_attr_e( 'Delete image', 'ncoc' ); ?>" data-text="<?php esc_attr_e( 'Delete', 'ncoc' ); ?>"><?php _e( 'Add images', 'ncoc' ); ?></a>
    </p>
    <?php
}

function ncoc_swf_add_metaboxes() {
    global $post;
    $pm = get_post_meta( $post->ID, '_ncoc_swf_file', true );
    printf( '<input type="hidden" name="_ncoc_swf_nonce" value="%s" />', wp_create_nonce( plugin_basename(__FILE__) ) );
    if(empty($pm)){
        printf( '<p id="label_if_not_set"><label for="%s">%s</label></p>', '_ncoc_swf_file', __('Set Header using swf file', 'ncoc') );
        _e('<embed style="display:none;" id="_ncoc_swf_file" src="'.esc_attr( get_post_meta( $post->ID, '_ncoc_swf_file', true )).'"></embed>','ncoc_swf_file_');
    } else {
        _e('<embed id="_ncoc_swf_file" src="'.esc_attr( get_post_meta( $post->ID, '_ncoc_swf_file', true )).'" style="position:relative;width:100%;height:100%;"></embed>','ncoc_swf_file_');
    }
    
    _e('<input type="hidden" name="_ncoc_swf_file" class="_ncoc_swf_file" value="'.esc_attr( get_post_meta( $post->ID, '_ncoc_swf_file', true )).'" />','ncoc_swf_file_');
    
    if(!empty($pm)){
        _e('<p class="hide-if-no-js"><a style="display:none" id="ncoc_swf_file" href="javascript:;">Set Header SWF</a></p>','ncoc_swf_file_');
        _e('<a id="remove_ncoc_swf_file" href="javascript:;">Remove Header SWF</a>','ncoc_swf_file_');
    } else {
        _e('<a id="ncoc_swf_file" href="javascript:;">Set Header SWF</a>','ncoc_swf_file_');
        _e('<p class="hide-if-no-js"><a style="display:none" id="remove_ncoc_swf_file" href="javascript:;">Remove Header SWF</a></p>','ncoc_swf_file_');
    }
}
?>

<?php 

function ncoc_save_rotator_meta($post_id, $post) {

    if(!isset($_POST['_ncoc_swf_nonce'])) return;

    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
    if ( defined('DOING_AJAX') && DOING_AJAX ) return;
    if ( defined('DOING_CRON') && DOING_CRON ) return;

    if ( ! current_user_can( 'edit_posts' ) || $post->post_type != 'page' )
        return;

    $fields = array(
        '_ncoc_swf_file',
    );

    foreach ($fields as $field) {
        $value = isset( $_POST[$field] ) ? $_POST[$field] : '';
        var_dump($field);
        if ( $value ) {
            update_post_meta($post->ID, $field, $value);
        } else {
            delete_post_meta($post->ID, $field);
        }
    }

}

add_action('save_post', 'ncoc_save_rotator_meta', 1, 2);
?>
