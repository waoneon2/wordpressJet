<?php

function staff_init() {
	register_post_type( 'staff', array(
		'labels'            => array(
			'name'                => __( 'Staff', 'alabama-policy-institute' ),
			'singular_name'       => __( 'Staff', 'alabama-policy-institute' ),
			'all_items'           => __( 'All Staff', 'alabama-policy-institute' ),
			'new_item'            => __( 'New staff', 'alabama-policy-institute' ),
			'add_new'             => __( 'Add New', 'alabama-policy-institute' ),
			'add_new_item'        => __( 'Add New staff', 'alabama-policy-institute' ),
			'edit_item'           => __( 'Edit staff', 'alabama-policy-institute' ),
			'view_item'           => __( 'View staff', 'alabama-policy-institute' ),
			'search_items'        => __( 'Search staff', 'alabama-policy-institute' ),
			'not_found'           => __( 'No staff found', 'alabama-policy-institute' ),
			'not_found_in_trash'  => __( 'No staff found in trash', 'alabama-policy-institute' ),
			'parent_item_colon'   => __( 'Parent staff', 'alabama-policy-institute' ),
			'menu_name'           => __( 'Staff', 'alabama-policy-institute' ),
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
		'rest_base'         => 'staff',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
		'register_meta_box_cb'  => 'staff_register_metaboxes',
	) );

}
add_action( 'init', 'staff_init' );

function staff_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['staff'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Staff updated. <a target="_blank" href="%s">View staff</a>', 'alabama-policy-institute'), esc_url( $permalink ) ),
		2 => __('Custom field updated.', 'alabama-policy-institute'),
		3 => __('Custom field deleted.', 'alabama-policy-institute'),
		4 => __('Staff updated.', 'alabama-policy-institute'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Staff restored to revision from %s', 'alabama-policy-institute'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Staff published. <a href="%s">View staff</a>', 'alabama-policy-institute'), esc_url( $permalink ) ),
		7 => __('Staff saved.', 'alabama-policy-institute'),
		8 => sprintf( __('Staff submitted. <a target="_blank" href="%s">Preview staff</a>', 'alabama-policy-institute'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		9 => sprintf( __('Staff scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview staff</a>', 'alabama-policy-institute'),
		// translators: Publish box date format, see http://php.net/date
		date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		10 => sprintf( __('Staff draft updated. <a target="_blank" href="%s">Preview staff</a>', 'alabama-policy-institute'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'staff_updated_messages' );

/* * * * * * * * * 
 *    META BOX   *
 * * * * * * * * */
function staff_register_metaboxes() {
    add_meta_box( 'api_staff',__( 'Staff Information', 'alabama-policy-institute' ), 'staff_meta_view', 'staff', 'normal', 'default');
}

function staff_meta_view($post) {
	$position 	= get_post_meta($post->ID, 'api_staff_emp_position', true);
	$facts 		= get_post_meta($post->ID, 'api_staff_emp_facts', true);
	$authorID 	= get_post_meta($post->ID, 'api_staff_emp_author', true);
	$fb 		= get_post_meta($post->ID, 'api_staff_emp_fb', true);
	$tw 		= get_post_meta($post->ID, 'api_staff_emp_tw', true);
	$contact 	= get_post_meta($post->ID, 'api_staff_emp_contact', true);

	printf( '<input type="hidden" name="api_staff_nonce" value="%s" />', wp_create_nonce( plugin_basename(__FILE__) ) ); 
	echo '<table width="100%" class="table-staff">
       	<tr align="left">
           <td>'.__('Employee Position', 'alabama-policy-institute').'</td>
           <th><input type="text" name="api_staff_emp_position" value="'.esc_html($position).'"></th>
       	</tr>';
       	echo '<tr align="left">
           <td>'.__('Employee Fun Fact', 'alabama-policy-institute').'</td>
           <th><textarea name="api_staff_emp_facts" rows="10">'.esc_html($facts).'</textarea>
           	<span class="description">'.__('New line per item list', 'alabama-policy-institute').'</span>
           </th>
       	</tr>';
       	echo '<tr align="left">';
			echo '<td>'.__('Employee Author Name', 'alabama-policy-institute').'</td><th>'; 
			wp_dropdown_users(array(
				'name' => 'api_staff_emp_author', 
				'selected' => $authorID
			));
			echo '</th>';
		echo '<tr align="left">
			<td>'.__('Employee Facebook Page', 'alabama-policy-institute').'</td>
			<th><input type="url" name="api_staff_emp_fb" value="'.esc_url($fb).'" >
				<span class="description">'.__('example: http://domain.com', 'alabama-policy-institute').'</span>
			</th>
		</tr>';
		echo '<tr align="left">
			<td>'.__('Employee Twitter Page', 'alabama-policy-institute').'</td>
			<th><input type="url" name="api_staff_emp_tw" value="'.esc_url($tw).'" >
				<span class="description">'.__('example: http://domain.com', 'alabama-policy-institute').'</span>
			</th>
		</tr>';
		echo '<tr align="left">
			<td>'.__('Employee Contact', 'alabama-policy-institute').'</td>
			<th><input type="email" name="api_staff_emp_contact" value="'.$contact.'" ></th>
		</tr>';
		echo '</tr>';
	echo '</table>';
}


/* * * * * * * * * * * *
 *    SAVE META BOX    *
 * * * * * * * * * * * */
function docrt_save_meta($post_id, $post) {

   //   verify the nonce
    if ( !isset($_POST['api_staff_nonce']) || !wp_verify_nonce( $_POST['api_staff_nonce'], plugin_basename(__FILE__) ) ) return;

    //  don't try to save the data under autosave, ajax, or future post.
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
    if ( defined('DOING_AJAX') && DOING_AJAX ) return;
    if ( defined('DOING_CRON') && DOING_CRON ) return;

    //  is the user allowed to edit the URL?
    if ( ! current_user_can( 'edit_posts' ) || $post->post_type != 'staff' )
        return;

    update_post_meta($post->ID, 'api_staff_emp_position', $_POST['api_staff_emp_position']);
    update_post_meta($post->ID, 'api_staff_emp_facts', $_POST['api_staff_emp_facts']);
    update_post_meta($post->ID, 'api_staff_emp_author', $_POST['api_staff_emp_author']);
    update_post_meta($post->ID, 'api_staff_emp_fb', $_POST['api_staff_emp_fb']);
    update_post_meta($post->ID, 'api_staff_emp_tw', $_POST['api_staff_emp_tw']);
    update_post_meta($post->ID, 'api_staff_emp_contact', $_POST['api_staff_emp_contact']);
}
add_action('save_post', 'docrt_save_meta', 1, 2);