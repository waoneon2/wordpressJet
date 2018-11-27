<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package LADWP
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function ladwp_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'ladwp_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function ladwp_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'ladwp_pingback_header' );

/**
 * when on category page we want user still on there when filter them
 */
function ladwp_intercept_template_include($template)
{
	$isLadwpSearch = isset($_GET['ladwp-search-cat']) && $_GET['ladwp-search-cat'] == '1';
	if ($isLadwpSearch) {
		return get_category_template();
	}
	return $template;
}
add_filter('template_include', 'ladwp_intercept_template_include');