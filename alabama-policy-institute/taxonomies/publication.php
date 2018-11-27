<?php

function publication_init() {
	register_taxonomy( 'publication', array( 'post', 'research' ), array(
		'hierarchical'      => true,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => true,
		'capabilities'      => array(
			'manage_terms'  => 'edit_posts',
			'edit_terms'    => 'edit_posts',
			'delete_terms'  => 'edit_posts',
			'assign_terms'  => 'edit_posts'
		),
		'labels'            => array(
			'name'                       => __( 'Publications', 'alabama-policy-institute' ),
			'singular_name'              => _x( 'Publication', 'taxonomy general name', 'alabama-policy-institute' ),
			'search_items'               => __( 'Search publications', 'alabama-policy-institute' ),
			'popular_items'              => __( 'Popular publications', 'alabama-policy-institute' ),
			'all_items'                  => __( 'All publications', 'alabama-policy-institute' ),
			'parent_item'                => __( 'Parent publication', 'alabama-policy-institute' ),
			'parent_item_colon'          => __( 'Parent publication:', 'alabama-policy-institute' ),
			'edit_item'                  => __( 'Edit publication', 'alabama-policy-institute' ),
			'update_item'                => __( 'Update publication', 'alabama-policy-institute' ),
			'add_new_item'               => __( 'New publication', 'alabama-policy-institute' ),
			'new_item_name'              => __( 'New publication', 'alabama-policy-institute' ),
			'separate_items_with_commas' => __( 'Separate publications with commas', 'alabama-policy-institute' ),
			'add_or_remove_items'        => __( 'Add or remove publications', 'alabama-policy-institute' ),
			'choose_from_most_used'      => __( 'Choose from the most used publications', 'alabama-policy-institute' ),
			'not_found'                  => __( 'No publications found.', 'alabama-policy-institute' ),
			'menu_name'                  => __( 'Publications', 'alabama-policy-institute' ),
		),
		'show_in_rest'      => true,
		'rest_base'         => 'publication',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	) );

}
add_action( 'init', 'publication_init' );
