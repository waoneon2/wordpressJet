<?php

function press_init() {
	register_taxonomy( 'press', array( 'post', 'research' ), array(
		'hierarchical'      => true,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_ui'           => true,
		'show_admin_column' => false,
		'query_var'         => true,
		'rewrite'           => true,
		'capabilities'      => array(
			'manage_terms'  => 'edit_posts',
			'edit_terms'    => 'edit_posts',
			'delete_terms'  => 'edit_posts',
			'assign_terms'  => 'edit_posts'
		),
		'labels'            => array(
			'name'                       => __( 'Press', 'alabama-policy-institute' ),
			'singular_name'              => _x( 'Press', 'taxonomy general name', 'alabama-policy-institute' ),
			'search_items'               => __( 'Search press', 'alabama-policy-institute' ),
			'popular_items'              => __( 'Popular press', 'alabama-policy-institute' ),
			'all_items'                  => __( 'All press', 'alabama-policy-institute' ),
			'parent_item'                => __( 'Parent press', 'alabama-policy-institute' ),
			'parent_item_colon'          => __( 'Parent press:', 'alabama-policy-institute' ),
			'edit_item'                  => __( 'Edit press', 'alabama-policy-institute' ),
			'update_item'                => __( 'Update press', 'alabama-policy-institute' ),
			'add_new_item'               => __( 'New press', 'alabama-policy-institute' ),
			'new_item_name'              => __( 'New press', 'alabama-policy-institute' ),
			'separate_items_with_commas' => __( 'Separate press with commas', 'alabama-policy-institute' ),
			'add_or_remove_items'        => __( 'Add or remove press', 'alabama-policy-institute' ),
			'choose_from_most_used'      => __( 'Choose from the most used press', 'alabama-policy-institute' ),
			'not_found'                  => __( 'No press found.', 'alabama-policy-institute' ),
			'menu_name'                  => __( 'Press and Media', 'alabama-policy-institute' ),
		),
		'show_in_rest'      => true,
		'rest_base'         => 'press',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	) );

}
add_action( 'init', 'press_init' );
