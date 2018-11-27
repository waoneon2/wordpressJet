<?php 
// register News custom post type
add_action('init', 'cobalt_register_telephone_type');

function cobalt_register_telephone_type() {
    register_post_type( 'telephone',
        array(
            'labels' => array(
                'name' => __( 'Telephone Numbers' ),
                'singular_name' => __( 'Telephone Number' ),
                'add_new' => __( 'Add New' ),
                'add_new_item' => __( 'Add New Contact' ),
                'edit' => __( 'Edit' ),
                'edit_item' => __( 'Edit Contact' ),
                'new_item' => __( 'New Contact' ),
                'view' => __( 'View Telephone Numbers' ),
                'view_item' => __( 'View Telephone Numbers' ),
                'search_items' => __( 'Search Telephone Numbers' ),
                'not_found' => __( 'No Telephone Numbers found' ),
                'not_found_in_trash' => __( 'No Telephone Numbers found in Trash' )
            ),
            'public' => true,
            'query_var' => true,
            'has_archive' => true,
            'supports'           => array( '' ),
            'menu_position' => 20,
            'rewrite'          => array(
                'slug'         => 'telephone',
                'hierarchical' => true,
            )
        )
    );
};

//metabox
add_action( 'add_meta_boxes', 'mtbox_url_telephone_us' );
function mtbox_url_telephone_us() {

    $screens = array( 'telephone' );
    foreach ( $screens as $screen ) {
        add_meta_box(
            'telephonebox',            // Unique ID
            'Input Contact Here',      // Box title
            'url_telephone_cb',     // Content callback
             $screen                   // post type
        );
    }
}
function url_telephone_cb($post) {
    $meta_telephone_numb = get_post_meta( get_the_ID(), '_meta_telephone_numb', true );
    $meta_telephone_email = get_post_meta( get_the_ID(), '_meta_telephone_email', true );
    $meta_telephone_name = get_post_meta( get_the_ID(), '_meta_telephone_name', true );

    ?>
        <div>
            <label style="display: inline-block; padding-right: 10px; font-size: 15px; width: 120px;">Contact Title  </label>
            <input type="text" style="width: 100%; max-width: 300px;display: inline-block;" name="post_title" id="post_title" value="<?php echo $post->post_title ?>" required="">
        </div>
        <div>
            <label style="display: inline-block; padding-right: 10px; font-size: 15px; width: 120px;">Name </label>
            <input type="text" style="width: 100%; max-width: 300px;display: inline-block;" name="in_telephone_name" id="in_telephone_name" value="<?php echo $meta_telephone_name;?>" required="">
        </div>
        <div>
            <label style="display: inline-block; padding-right: 10px; font-size: 15px; width: 120px;">Phone </label>
            <input type="tel" pattern="^\d{12}$" style="width: 100%; max-width: 300px;display: inline-block;" name="in_telephone_numb" id="in_telephone_numb" value="<?php echo $meta_telephone_numb;?>" required="">
        </div>

        <div>
            <label style="display: inline-block; padding-right: 10px; font-size: 15px; width: 120px;">Email </label>
            <input type="email"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" style="width: 100%; max-width: 400px;display: inline-block;" name="in_telephone_email" id="in_telephone_email" value="<?php echo $meta_telephone_email;?>" required="">
        </div>
    <?php
}

add_action ('save_post', 'meta_telephonebox_save');

function meta_telephonebox_save($post_id) {

    if( isset($_POST['in_telephone_numb']) || isset($_POST['in_telephone_email'] ) || isset($_POST['in_telephone_name'] ) ) {
        update_post_meta( $post_id, '_meta_telephone_numb', $_POST['in_telephone_numb']);
        update_post_meta( $post_id, '_meta_telephone_email', $_POST['in_telephone_email']);
        update_post_meta( $post_id, '_meta_telephone_name', $_POST['in_telephone_name']);
    }
}

?>