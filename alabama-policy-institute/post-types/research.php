<?php

function research_init() {
	register_post_type( 'research', array(
		'labels'            => array(
			'name'                => __( 'Research', 'alabama-policy-institute' ),
			'singular_name'       => __( 'Research', 'alabama-policy-institute' ),
			'all_items'           => __( 'All Research', 'alabama-policy-institute' ),
			'new_item'            => __( 'New research', 'alabama-policy-institute' ),
			'add_new'             => __( 'Add New', 'alabama-policy-institute' ),
			'add_new_item'        => __( 'Add New research', 'alabama-policy-institute' ),
			'edit_item'           => __( 'Edit research', 'alabama-policy-institute' ),
			'view_item'           => __( 'View research', 'alabama-policy-institute' ),
			'search_items'        => __( 'Search research', 'alabama-policy-institute' ),
			'not_found'           => __( 'No research found', 'alabama-policy-institute' ),
			'not_found_in_trash'  => __( 'No research found in trash', 'alabama-policy-institute' ),
			'parent_item_colon'   => __( 'Parent research', 'alabama-policy-institute' ),
			'menu_name'           => __( 'Research', 'alabama-policy-institute' ),
		),
		'public'            => true,
		'hierarchical'      => false,
		'show_ui'           => true,
		'show_in_nav_menus' => true,
		'supports'          => array( 'title', 'editor', 'thumbnail' ),
		'has_archive'       => true,
		'rewrite'           => true,
		'query_var'         => true,
		'menu_icon'         => 'dashicons-admin-post',
		'show_in_rest'      => true,
		'rest_base'         => 'research',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
		'register_meta_box_cb'	=> 'research_admin_meta_box'
	) );

}
add_action( 'init', 'research_init' );

function research_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['research'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Research updated. <a target="_blank" href="%s">View research</a>', 'alabama-policy-institute'), esc_url( $permalink ) ),
		2 => __('Custom field updated.', 'alabama-policy-institute'),
		3 => __('Custom field deleted.', 'alabama-policy-institute'),
		4 => __('Research updated.', 'alabama-policy-institute'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Research restored to revision from %s', 'alabama-policy-institute'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Research published. <a href="%s">View research</a>', 'alabama-policy-institute'), esc_url( $permalink ) ),
		7 => __('Research saved.', 'alabama-policy-institute'),
		8 => sprintf( __('Research submitted. <a target="_blank" href="%s">Preview research</a>', 'alabama-policy-institute'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		9 => sprintf( __('Research scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview research</a>', 'alabama-policy-institute'),
		// translators: Publish box date format, see http://php.net/date
		date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		10 => sprintf( __('Research draft updated. <a target="_blank" href="%s">Preview research</a>', 'alabama-policy-institute'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'research_updated_messages' );

function research_admin_meta_box() {
	add_meta_box('api_research', __( 'Research Details', 'alabama-policy-institute' ), 'research_admin_meta_view', 'research', 'normal', 'default');
}

function research_admin_meta_view($post) {
    printf( '<input type="hidden" name="_alpi_research_nonce" value="%s" />', wp_create_nonce( plugin_basename(__FILE__) ) );
    printf( '<p><label for="%s">%s</label></p>', '_alpi_research_file', __('File URL: ', 'alabama-policy-institute') );
    printf( '<input type="text" name="_alpi_research_file" class="_alpi_research_file" value="%s" />', esc_attr( get_post_meta( $post->ID, '_alpi_research_file', true )));
    printf( '<button type="button" class="button new alpi_research_file" id="alpi_research_file">%s</button>', __('Insert File', 'bp'));
}

function research_admin_save_meta_box($post_id, $post) {
	if ( !isset($_POST['_alpi_research_nonce']) || !wp_verify_nonce( $_POST['_alpi_research_nonce'], plugin_basename(__FILE__) ) ) return;

	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
    if ( defined('DOING_AJAX') && DOING_AJAX ) return;
    if ( defined('DOING_CRON') && DOING_CRON ) return;

    //  is the user allowed to edit the URL?
    if ( ! current_user_can( 'edit_posts' ) || $post->post_type != 'research' ) return;

    $fields = array(
        '_alpi_research_file',
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
}
add_action('save_post', 'research_admin_save_meta_box', 10, 2);

function research_enqueue_admin_scripts() {
    $screen         = get_current_screen();
    $screen_id      = $screen ? $screen->id : '';
    //var_dump($screen_id);
    if ( in_array( $screen_id, array( 'edit-research', 'research' ) ) ) {
        wp_register_script( 'research-admin',get_template_directory_uri() . '/js/research-admin.js', array( 'jquery' ), '0.0.1' );
        wp_enqueue_script('research-admin');
    }
}
add_action( 'admin_enqueue_scripts', 'research_enqueue_admin_scripts');

function get_the_research_report_url($research = null) {
    global $post;
    if ($research === null) {
        $url = get_post_meta( $post->ID, '_alpi_research_file', true );
    } else if (is_object($research)) {
        $url = get_post_meta( $research->ID, '_alpi_research_file', true );
    } else {
        $url = get_post_meta( $research, '_alpi_research_file', true );
    }
    return $url ? $url : false;
}