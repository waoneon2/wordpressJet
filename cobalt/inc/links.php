<?php 
// register News custom post type
add_action('init', 'cobalt_register_link_type');

function cobalt_register_link_type() {
    register_post_type( 'link',
        array(
            'labels' => array(
                'name' => __( 'Links' ),
                'singular_name' => __( 'Link' ),
                'add_new' => __( 'Add New' ),
                'add_new_item' => __( 'Add New Link' ),
                'edit' => __( 'Edit' ),
                'edit_item' => __( 'Edit Link' ),
                'new_item' => __( 'New Link' ),
                'view' => __( 'View Links' ),
                'view_item' => __( 'View Links' ),
                'search_items' => __( 'Search Links' ),
                'not_found' => __( 'No Links found' ),
                'not_found_in_trash' => __( 'No Links found in Trash' )
            ),
            'public' => true,
            'query_var' => true,
            'supports'           => array( 'title' ),
            'has_archive' => true,
            'menu_position' => 20,
            'rewrite'          => array(
                'slug'         => 'link',
                'hierarchical' => true,
            )
        )
    );
};

//metabox
add_action( 'add_meta_boxes', 'mtbox_url_links' );
function mtbox_url_links() {
    
    $screens = array( 'link' );
    foreach ( $screens as $screen ) {
        add_meta_box(
            'linkurl',            // Unique ID
            'Insert Url',      // Box title
            'url_link_cb',  // Content callback
             $screen                      // post type
        );
    }
}
function url_link_cb($post) {
    $meta_linkurl = get_post_meta( get_the_ID(), '_meta_linkurl', true );

    ?>
        <label style="display: inline-block; padding-right: 10px; font-size: 15px;">Url </label>
        <input type="url" style="width: 100%; max-width: 600px;display: inline-block;" name="in_linkurl" id="in_linkurl" value="<?php echo $meta_linkurl;?>" required="">
    <?php
}

add_action ('save_post', 'meta_linkurl_save');
function meta_linkurl_save($post_id) {
    if( isset($_POST['in_linkurl']) ) {
        update_post_meta( $post_id, '_meta_linkurl', $_POST['in_linkurl']);
    }
}


?>