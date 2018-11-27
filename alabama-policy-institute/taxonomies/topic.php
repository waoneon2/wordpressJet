<?php

function topic_init() {
	register_taxonomy( 'topic', array( 'post', 'research' ), array(
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
			'name'                       => __( 'Topics', 'alabama-policy-institute' ),
			'singular_name'              => _x( 'Topic', 'taxonomy general name', 'alabama-policy-institute' ),
			'search_items'               => __( 'Search topics', 'alabama-policy-institute' ),
			'popular_items'              => __( 'Popular topics', 'alabama-policy-institute' ),
			'all_items'                  => __( 'All topics', 'alabama-policy-institute' ),
			'parent_item'                => __( 'Parent topic', 'alabama-policy-institute' ),
			'parent_item_colon'          => __( 'Parent topic:', 'alabama-policy-institute' ),
			'edit_item'                  => __( 'Edit topic', 'alabama-policy-institute' ),
			'update_item'                => __( 'Update topic', 'alabama-policy-institute' ),
			'add_new_item'               => __( 'New topic', 'alabama-policy-institute' ),
			'new_item_name'              => __( 'New topic', 'alabama-policy-institute' ),
			'separate_items_with_commas' => __( 'Separate topics with commas', 'alabama-policy-institute' ),
			'add_or_remove_items'        => __( 'Add or remove topics', 'alabama-policy-institute' ),
			'choose_from_most_used'      => __( 'Choose from the most used topics', 'alabama-policy-institute' ),
			'not_found'                  => __( 'No topics found.', 'alabama-policy-institute' ),
			'menu_name'                  => __( 'Topics', 'alabama-policy-institute' ),
		),
		'show_in_rest'      => true,
		'rest_base'         => 'topic',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	) );

}
add_action( 'init', 'topic_init' );
