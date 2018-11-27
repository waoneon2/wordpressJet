<?php
// Reference https://gist.github.com/jayarjo/5846636
function jau_ajax_upload_settings() {

    if ( empty( $_FILES ) || $_FILES['async-upload']['error'] ) {
        wp_die( __( 'Failed to move uploaded file.' ) );
    }

    if ( ! is_user_logged_in() || ! current_user_can( 'upload_files' ) ) {
        wp_die( __( 'Sorry, you are not allowed to upload files.' ) );
    }
    check_admin_referer( 'media-form' );
// Reference http://www.plupload.com/docs/Chunking
    $chunk  = isset( $_REQUEST['chunk']) ? intval( $_REQUEST['chunk'] ) : 0;
    $chunks = isset( $_REQUEST['chunks']) ? intval( $_REQUEST['chunks'] ) : 0;

    $fileName = isset( $_REQUEST['name'] ) ? $_REQUEST['name'] : $_FILES['async-upload']['name'];
    $filePath = dirname( $_FILES['async-upload']['tmp_name'] ) . '/' . md5( $fileName );
// Error handler for uploaded file size
    $jau_max_upload_file_size = jau_disk_free_space('');

    if ( file_exists( "{$filePath}.part" ) && filesize( "{$filePath}.part" ) + filesize( $_FILES['async-upload']['tmp_name'] ) > $jau_max_upload_file_size ) {

        if ( ! $chunks || $chunk == $chunks - 1 ) {
            @unlink( "{$filePath}.part" );
            if ( ! isset( $_REQUEST['short'] ) || ! isset( $_REQUEST['type'] ) ) {
                echo wp_json_encode( array(
                    'success' => false,
                    'data'    => array(
                        'message'  => __( 'The file size has exceeded the maximum file size setting.', 'jau' ),
                        'filename' => $_FILES['async-upload']['name'],
                    )
                ) );
                wp_die();
            } else {

                echo '<div class="error-div error">
                <a class="dismiss" href="#" onclick="jQuery(this).parents(\'div.media-item\').slideUp(200, function(){jQuery(this).remove();});">' . __( 'Dismiss' ) . '</a>
                <strong>' . sprintf( __( '&#8220;%s&#8221; has failed to upload.' ), esc_html( $_FILES['async-upload']['name'] ) ) . '<br />' . __( 'The file size has exceeded the maximum file size setting.', 'jau' ) . '</strong><br />' .
                esc_html( $id->get_error_message() ) . '</div>';
            }
        }
        die();
    }
// Reference http://www.plupload.com/docs/Chunking
    $out = @fopen( "{$filePath}.part", $chunk == 0 ? 'wb' : 'ab' );
    if ( $out ) {
        $in = @fopen( $_FILES['async-upload']['tmp_name'], 'rb' );

        if ( $in ) {
            while ( $buff = fread( $in, 4096 ) ) {
                fwrite( $out, $buff );
            }
        } else {
            @fclose( $out );
            @unlink( "{$filePath}.part" );
            die('{"OK": 0, "info": "Failed to open input stream."}');
        }
        @fclose( $in );
        @fclose( $out );

        @unlink( $_FILES['async-upload']['tmp_name'] );

    } else {
        die('{"OK": 0, "info": "Failed to open input stream."}');
    }

    if ( ! $chunks || $chunk == $chunks - 1 ) {

        rename( "{$filePath}.part", $_FILES['async-upload']['tmp_name'] );
        $_FILES['async-upload']['name'] = $fileName;
        $_FILES['async-upload']['size'] = filesize( $_FILES['async-upload']['tmp_name'] );
        $_FILES['async-upload']['type'] = jau_get_mime_type( $_FILES['async-upload']['tmp_name'] );
        header( 'Content-Type: text/html; charset=' . get_option( 'blog_charset' ) );

        if ( ! isset( $_REQUEST['short'] ) || ! isset( $_REQUEST['type'] ) ) {
            send_nosniff_header();
            nocache_headers();
            wp_ajax_upload_attachment();
            die( '0' );
        } 
        else {
            $post_id = 0;
            if ( isset( $_REQUEST['post_id'] ) ) {
                $post_id = absint( $_REQUEST['post_id'] );
                if ( ! get_post( $post_id ) || ! current_user_can( 'edit_post', $post_id ) )
                    $post_id = 0;
            }
// Reference https://github.com/WordPress/WordPress/blob/master/wp-admin/async-upload.php#L91
            $id = media_handle_upload( 'async-upload', $post_id );
            if ( is_wp_error( $id ) ) {
                echo '<div class="error-div error">
                <a class="dismiss" href="#" onclick="jQuery(this).parents(\'div.media-item\').slideUp(200, function(){jQuery(this).remove();});">' . __( 'Dismiss' ) . '</a>
                <strong>' . sprintf( __( '&#8220;%s&#8221; has failed to upload.' ), esc_html( $_FILES['async-upload']['name'] ) ) . '</strong><br />' .
                esc_html( $id->get_error_message() ) . '</div>';
                exit;
            }

            if ( isset( $_REQUEST['short'] ) && $_REQUEST['short'] ) {
                echo $id;
            } elseif ( isset( $_REQUEST['type'] ) ) {
                $type = $_REQUEST['type'];
                echo apply_filters( "async_upload_{$type}", $id );
            }
        }
    }
    die();
}
add_action('wp_ajax_jau_upload_large_file', 'jau_ajax_upload_settings');