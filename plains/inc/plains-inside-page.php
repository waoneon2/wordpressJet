<?php
/**
* Plains Inside Page
* @package Plains
*/

add_action( 'add_meta_boxes', 'plains_register_metaboxes' );
function plains_register_metaboxes() {
    add_meta_box( 'inside-page-custom', __( 'Inside Page', 'plains' ), 'plains_inside_page_custom_box', 'page', 'normal', 'default');
}

function plains_inside_page_custom_box($post){
	printf( '<input type="hidden" name="_plains_inside_page_nonce" value="%s" />', wp_create_nonce( plugin_basename(__FILE__) ) );
	$meta 				= get_post_meta($post->ID, 'plains_rotate', true);
	$meta_title_main 	= get_post_meta($post->ID, 'plains_title_main', true);
	$extrapad 			= get_post_meta($post->ID, 'plains_extra_pad', true);
	$lastrow 			= get_post_meta($post->ID, 'plains_last_row', true);

    echo generate_main_title($meta_title_main); // Main Title
    echo generate_detail_box_image_rotator($meta); // Detail of Image Rotator
    echo generate_content_img_rotator($post); // Image Rotator Upload
    echo generate_content_extra_pad($extrapad); // Content of Extra Pad
    echo generate_last_row($lastrow); // Content of last row
}

function generate_content_img_rotator($post){
?>
  <div class='ir-border-container ir-notop '>
    <div id="image_rotator_container">
    <div class="img_rotator_title">
    	<h2><strong>Image Rotator</strong></h2>
    </div>
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
                                    <li><a href="#" class="delete tips delete-actions" data-tip="' . esc_attr__( 'Delete image', 'plains' ) . '">' . __( 'Delete', 'plains' ) . '</a></li>
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
        <a href="#" class="button button-primary button-large" data-choose="<?php esc_attr_e( 'Add Images to Image Rotator', 'plains' ); ?>" data-update="<?php esc_attr_e( 'Add to image rotator', 'plains' ); ?>" data-delete="<?php esc_attr_e( 'Delete image', 'plains' ); ?>" data-text="<?php esc_attr_e( 'Delete', 'plains' ); ?>"><?php _e( 'Add images', 'plains' ); ?></a>
    </p>
  </div>
<?php
}

function generate_main_title($title_main){
?>
	<div class="container-main-title ">
		<div class="this-title">
			<h2><strong>Main Title<strong></h2>
		</div>
		<div class="this-content-input" id="titlediv">
			<input name="plains_title_main[title]" type="text" id="title" class="plains_inputs" id="plains_main_title" value="<?php echo isset($title_main['title']) ? $title_main['title'] : ''?>" maxlength="200"/>
		</div>
	</div>
<?php
}

function generate_detail_box_image_rotator($meta){
?>
  <div class="ir-border-container ir-nobottom">
  	<table width="100%">
  	    <tr align="left">
  	        <th><label class="diy-label" for="plains_rotate_status">Status</label></th>
  	        <td> : </td>
  	        <td><input name="plains_rotate[status]" type="checkbox" class="plains_inputs" id="plains_rotate_status" value="1" <?php checked( @$meta['status'], 1 ); ?>/></td>
  	    </tr>
  	    <tr align="left">
  	        <th><label class="diy-label" for="plains_rotate_title">Title</label></th>
  	        <td> : </td>
  	        <td><input name="plains_rotate[title]" type="text" class="plains_inputs" id="plains_rotate_title" value="<?php echo isset($meta['title']) ? $meta['title'] : ''?>" style="width: 100%"  maxlength="200"/></td>
  	    </tr>
  	    <tr align="left">
  	        <th colspan="3"><?php generate_plains_editor('plains_rotate_content', '_editor_plains_rotator_content', '_editor_plains_rotator_extra_content', ''); ?></th>
  	    </tr>
  	</table>
  </div>
<?php
}

function generate_content_extra_pad($meta_extrapad){
?>
  <div class="ir-border-container">
	<table width="100%">
	    <tr align="left">
	        <th><label class="diy-label" for="plains_extra_pad_title">Title</label></th>
	        <td> : </td>
	        <td><input name="plains_extra_pad[title]" type="text" class="plains_inputs" id="plains_extra_pad_title" value="<?php echo isset($meta_extrapad['title']) ? $meta_extrapad['title'] : ''?>" style="width: 100%"  maxlength="200"/></td>
	    </tr>
	    <tr align="left">
	        <th colspan="3"><?php generate_plains_editor('plains_extra_pad_content', '_editor_plains_extra_pad_content', '_editor_plains_extra_pad_noun_content', 'Extra Pad'); ?></th>
	    </tr>
	</table>
  </div>
<?php
}

function generate_last_row($meta_last_row){
?>
  <div class="ir-border-container">
	<table width="100%">
	    <tr align="left">
	        <th><label class="diy-label" for="plains_last_row_title">Title</label></th>
	        <td> : </td>
	        <td><input name="plains_last_row[title]" type="text" class="plains_inputs" id="plains_last_row_title" value="<?php echo isset($meta_last_row['title']) ? $meta_last_row['title'] : ''?>" style="width: 100%"  maxlength="200"/></td>
	    </tr>
	    <tr align="left">
	        <th colspan="3"><?php generate_plains_editor('plains_last_row_content', '_editor_plains_last_row_content', '_editor_plains_last_row_noun_content', 'Last Row'); ?></th>
	    </tr>
	</table>
  </div>
<?php
}

function generate_plains_editor($meta_box_id, $editor_id, $extra_content, $title){
	global $post;

	echo "<p><strong>".$title."</strong></p>";
	echo "
	    <style type='text/css'>
	            #$meta_box_id #edButtonHTML, #$meta_box_id #edButtonPreview {background-color: #F1F1F1; border-color: #DFDFDF #DFDFDF #CCC; color: #999;}
	            #$editor_id{width:100%;height:200px;}
	            #$meta_box_id #editorcontainer{background:#fff !important;}
	            #$meta_box_id #editor_id_fullscreen{display:none;}
	    </style>

	    <script type='text/javascript'>
	            jQuery(function($){
	                    $('#$meta_box_id #editor-toolbar > a').click(function(){
	                            $('#$meta_box_id #editor-toolbar > a').removeClass('active');
	                            $(this).addClass('active');
	                    });

	                    if($('#$meta_box_id #edButtonPreview').hasClass('active')){
	                            $('#$meta_box_id #ed_toolbar').hide();
	                    }

	                    $('#$meta_box_id #edButtonPreview').click(function(){
	                            $('#$meta_box_id #ed_toolbar').hide();
	                    });

	                    $('#$meta_box_id #edButtonHTML').click(function(){
	                            $('#$meta_box_id #ed_toolbar').show();
	                    });
	    //Tell the uploader to insert content into the correct WYSIWYG editor
	    $('#media-buttons a').bind('click', function(){
	        var customEditor = $(this).parents('#$meta_box_id');
	        if(customEditor.length > 0){
	            edCanvas = document.getElementById('$editor_id');
	        }
	        else{
	            edCanvas = document.getElementById('content');
	        }
	    });
	            });
	    </script>
	";

	//Create The Editor
	$content = get_post_meta($post->ID, $extra_content, true);
	wp_editor($content, $editor_id);
}

function plains_save_rotator_meta($post_id, $post) {

   //   verify the nonce
    if ( !isset($_POST['_plains_inside_page_nonce']) || !wp_verify_nonce( $_POST['_plains_inside_page_nonce'], plugin_basename(__FILE__) ) ) return;

    //  don't try to save the data under autosave, ajax, or future post.
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
    if ( defined('DOING_AJAX') && DOING_AJAX ) return;
    if ( defined('DOING_CRON') && DOING_CRON ) return;

    //  is the user allowed to edit the URL?
    if ( ! current_user_can( 'edit_posts' ) || $post->post_type != 'page' )
        return;

    update_post_meta( $post_id, 'plains_rotate', $_POST['plains_rotate'] );
    update_post_meta( $post_id, 'plains_title_main', $_POST['plains_title_main'] );
    update_post_meta( $post_id, 'plains_extra_pad', $_POST['plains_extra_pad'] );
    update_post_meta( $post_id, 'plains_last_row', $_POST['plains_last_row'] );

    if(isset($_REQUEST['_editor_plains_rotator_content'])):
    	update_post_meta($post->ID, '_editor_plains_rotator_extra_content', $_REQUEST['_editor_plains_rotator_content']);
	endif;

	if(isset($_REQUEST['_editor_plains_extra_pad_content'])):
    	update_post_meta($post->ID, '_editor_plains_extra_pad_noun_content', $_REQUEST['_editor_plains_extra_pad_content']);
	endif;

	if(isset($_REQUEST['_editor_plains_last_row_content'])):
    	update_post_meta($post->ID, '_editor_plains_last_row_noun_content', $_REQUEST['_editor_plains_last_row_content']);
	endif;

    $attachment_ids = isset( $_POST['image_rotator'] ) ? array_filter( explode( ',', sanitize_text_field( $_POST['image_rotator'] ) ) ) : array();
    update_post_meta( $post_id, '_image_rotator', implode( ',', $attachment_ids ) );
}

add_action('save_post', 'plains_save_rotator_meta', 1, 2);
?>
