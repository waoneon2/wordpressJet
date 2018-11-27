<?php

function multimedia_init() {
	register_taxonomy( 'multimedia', array( 'post', 'research' ), array(
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
			'name'                       => __( 'Multimedia', 'alabama-policy-institute' ),
			'singular_name'              => _x( 'Multimedia', 'taxonomy general name', 'alabama-policy-institute' ),
			'search_items'               => __( 'Search multimedia', 'alabama-policy-institute' ),
			'popular_items'              => __( 'Popular multimedia', 'alabama-policy-institute' ),
			'all_items'                  => __( 'All multimedia', 'alabama-policy-institute' ),
			'parent_item'                => __( 'Parent multimedia', 'alabama-policy-institute' ),
			'parent_item_colon'          => __( 'Parent multimedia:', 'alabama-policy-institute' ),
			'edit_item'                  => __( 'Edit multimedia', 'alabama-policy-institute' ),
			'update_item'                => __( 'Update multimedia', 'alabama-policy-institute' ),
			'add_new_item'               => __( 'New multimedia', 'alabama-policy-institute' ),
			'new_item_name'              => __( 'New multimedia', 'alabama-policy-institute' ),
			'separate_items_with_commas' => __( 'Separate multimedia with commas', 'alabama-policy-institute' ),
			'add_or_remove_items'        => __( 'Add or remove multimedia', 'alabama-policy-institute' ),
			'choose_from_most_used'      => __( 'Choose from the most used multimedia', 'alabama-policy-institute' ),
			'not_found'                  => __( 'No multimedia found.', 'alabama-policy-institute' ),
			'menu_name'                  => __( 'Multimedia', 'alabama-policy-institute' ),
		),
		'show_in_rest'      => true,
		'rest_base'         => 'multimedia',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	) );

}
add_action( 'init', 'multimedia_init' );
