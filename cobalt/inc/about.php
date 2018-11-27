
<?php

// About CPT
add_action( 'init', 'codex_about_init' );

function codex_about_init() {
	$labels = array(
		'name'               => _x( 'about', 'post type general name', 'cobalt' ),
		'singular_name'      => _x( 'about', 'post type singular name', 'cobalt' ),
		'menu_name'          => _x( 'About', 'admin menu', 'cobalt' ),
		'name_admin_bar'     => _x( 'about', 'add new on admin bar', 'cobalt' ),
		'add_new'            => _x( 'Add New', 'about', 'cobalt' ),
		'add_new_item'       => __( 'Add New About', 'cobalt' ),
		'new_item'           => __( 'New About', 'cobalt' ),
		'edit_item'          => __( 'Edit About', 'cobalt' ),
		'view_item'          => __( 'View About', 'cobalt' ),
		'all_items'          => __( 'All About', 'cobalt' ),
		'search_items'       => __( 'Search about', 'cobalt' ),
		'parent_item_colon'  => __( 'Parent about:', 'cobalt' ),
		'not_found'          => __( 'No about found.', 'cobalt' ),
		'not_found_in_trash' => __( 'No about found in Trash.', 'cobalt' )
	);

	$args = array(
		'labels'             => $labels,
        'description'        => __( 'Description.', 'cobalt' ),
		'public'             => true,
		// 'publicly_queryable' => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'about' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => true,
		'menu_position'      => 20,
		'supports'           => array( 'title' )
	);

	register_post_type( 'about', $args );
}

//metabox
add_action( 'add_meta_boxes', 'mtbox_url_about_us' );
function mtbox_url_about_us() {
    
    $screens = array( 'about' );
    foreach ( $screens as $screen ) {
        add_meta_box(
            'abouturl',            // Unique ID
            'Insert Url',      // Box title
            'url_about_cb',  // Content callback
             $screen                      // post type
        );
    }
}
function url_about_cb($post) {
	$meta_abouturl = get_post_meta( get_the_ID(), '_meta_abouturl', true );

    ?>
    	<label style="display: inline-block; padding-right: 10px; font-size: 15px;">Url </label>
    	<input type="url" style="width: 100%; max-width: 600px;display: inline-block;" name="in_abouturl" id="in_abouturl" value="<?php echo $meta_abouturl;?>" required="">
    <?php
}

add_action ('save_post', 'meta_abouturl_save');
function meta_abouturl_save($post_id) {
    if( isset($_POST['in_abouturl']) ) {
    	update_post_meta( $post_id, '_meta_abouturl', $_POST['in_abouturl']);
    }
    
}


?>
