<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package US_Army
 */

if ( ! function_exists( 'us_army_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function us_army_posted_on() {
	$posted_on = sprintf(
		esc_html_x( 'DATE: %s', 'post date', 'us-army' ),
		get_the_time('F j, Y g:i:s A T')
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'nasa_jsc' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<p><i>' . $posted_on . '</i></p>'; // WPCS: XSS OK.
}
endif;

if ( ! function_exists( 'us_army_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function us_army_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'us-army' ) );
		if ( $categories_list && us_army_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'us-army' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'us-army' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'us-army' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'us-army' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'us-army' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function us_army_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'us_army_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'us_army_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so us_army_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so us_army_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in us_army_categorized_blog.
 */
function us_army_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'us_army_categories' );
}
add_action( 'edit_category', 'us_army_category_transient_flusher' );
add_action( 'save_post',     'us_army_category_transient_flusher' );
