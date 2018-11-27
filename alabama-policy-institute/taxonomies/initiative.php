<?php

function initiative_init() {
	register_taxonomy( 'initiative', array( 'post', 'research' ), array(
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
			'name'                       => __( 'Initiatives', 'alabama-policy-institute' ),
			'singular_name'              => _x( 'Initiative', 'taxonomy general name', 'alabama-policy-institute' ),
			'search_items'               => __( 'Search initiatives', 'alabama-policy-institute' ),
			'popular_items'              => __( 'Popular initiatives', 'alabama-policy-institute' ),
			'all_items'                  => __( 'All initiatives', 'alabama-policy-institute' ),
			'parent_item'                => __( 'Parent initiative', 'alabama-policy-institute' ),
			'parent_item_colon'          => __( 'Parent initiative:', 'alabama-policy-institute' ),
			'edit_item'                  => __( 'Edit initiative', 'alabama-policy-institute' ),
			'update_item'                => __( 'Update initiative', 'alabama-policy-institute' ),
			'add_new_item'               => __( 'New initiative', 'alabama-policy-institute' ),
			'new_item_name'              => __( 'New initiative', 'alabama-policy-institute' ),
			'separate_items_with_commas' => __( 'Separate initiatives with commas', 'alabama-policy-institute' ),
			'add_or_remove_items'        => __( 'Add or remove initiatives', 'alabama-policy-institute' ),
			'choose_from_most_used'      => __( 'Choose from the most used initiatives', 'alabama-policy-institute' ),
			'not_found'                  => __( 'No initiatives found.', 'alabama-policy-institute' ),
			'menu_name'                  => __( 'Initiatives', 'alabama-policy-institute' ),
		),
		'show_in_rest'      => true,
		'rest_base'         => 'initiative',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	) );

}
add_action( 'init', 'initiative_init' );
