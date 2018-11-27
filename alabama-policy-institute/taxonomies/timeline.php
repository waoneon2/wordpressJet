<?php

function timeline_init() {
	register_taxonomy( 'timeline', array( 'post', 'research' ), array(
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
			'name'                       => __( 'Timelines', 'alabama-policy-institute' ),
			'singular_name'              => _x( 'Timeline', 'taxonomy general name', 'alabama-policy-institute' ),
			'search_items'               => __( 'Search timelines', 'alabama-policy-institute' ),
			'popular_items'              => __( 'Popular timelines', 'alabama-policy-institute' ),
			'all_items'                  => __( 'All timelines', 'alabama-policy-institute' ),
			'parent_item'                => __( 'Parent timeline', 'alabama-policy-institute' ),
			'parent_item_colon'          => __( 'Parent timeline:', 'alabama-policy-institute' ),
			'edit_item'                  => __( 'Edit timeline', 'alabama-policy-institute' ),
			'update_item'                => __( 'Update timeline', 'alabama-policy-institute' ),
			'add_new_item'               => __( 'New timeline', 'alabama-policy-institute' ),
			'new_item_name'              => __( 'New timeline', 'alabama-policy-institute' ),
			'separate_items_with_commas' => __( 'Separate timelines with commas', 'alabama-policy-institute' ),
			'add_or_remove_items'        => __( 'Add or remove timelines', 'alabama-policy-institute' ),
			'choose_from_most_used'      => __( 'Choose from the most used timelines', 'alabama-policy-institute' ),
			'not_found'                  => __( 'No timelines found.', 'alabama-policy-institute' ),
			'menu_name'                  => __( 'Timelines', 'alabama-policy-institute' ),
		),
		'show_in_rest'      => true,
		'rest_base'         => 'timeline',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	) );

}
add_action( 'init', 'timeline_init' );
