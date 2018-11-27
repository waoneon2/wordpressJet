<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package LADWP
 */

if ( ! function_exists( 'ladwp_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function ladwp_posted_on($bold = '') {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( '%s', 'post date', 'ladwp' ),
		$time_string
	);

	echo '<p class="small '.$bold.'">' . $posted_on . '</p>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'ladwp_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function ladwp_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'ladwp' ) );
		if ( $categories_list && ladwp_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'ladwp' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'ladwp' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'ladwp' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'ladwp' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( ' Edit %s', 'ladwp' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

function ladwp_the_excerpt_more() {
	return '...';
}

add_filter('excerpt_more', 'ladwp_the_excerpt_more');

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function ladwp_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'ladwp_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'ladwp_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so ladwp_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so ladwp_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in ladwp_categorized_blog.
 */
function ladwp_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'ladwp_categories' );
}
add_action( 'edit_category', 'ladwp_category_transient_flusher' );
add_action( 'save_post',     'ladwp_category_transient_flusher' );

function _ladwp_year_dropdown($postType) {
	global $wpdb, $wp_locale;

	$where = $wpdb->prepare( "WHERE post_type = %s AND post_status = 'publish'", $postType );
	$query = "SELECT YEAR(post_date) AS `year`, count(ID) as posts FROM $wpdb->posts $where GROUP BY YEAR(post_date) ORDER BY post_date DESC";
	$years = $wpdb->get_results($query);
	$y = isset( $_GET['year'] ) ? (int) $_GET['year'] : 0;
	ob_start();
	?>
		<label for="filter-by-year" class="filter-by-year"><?php _e( 'Filter by Year' ); ?>
			<select name="year" id="filter-by-year" class="filter-select">
				<option<?php selected( $y, 0 ); ?> value="0"><?php _e( 'All years' ); ?></option>
				<?php
					foreach ((array) $years as $res ) {
						if ( 0 == $res->year )
							continue;
						$year = $res->year;
						printf( "<option %s value='%s'>%s</option>\n",
							selected($y, $year, false ),
							esc_attr($res->year),
							/* translators: 1: month name, 2: 4-digit year */
							sprintf( '%d', $year)
						);
					}
				?>
			</select>
		</label>
	<?php
	return ob_get_clean();
}

function get_ladwp_search_form($echo = true) {
	$form = '<aside class="ladwp-search-form-container border-green">
		<form role="search" method="get" class="ladwp-search-form" action="' . esc_url( home_url( '/' ) ) . '">
			<label>
				<span class="screen-reader-text">' . _x( 'Search for:', 'label' ) . '</span>
				<input type="search" class="search-field" placeholder="' . esc_attr_x( 'Search &hellip;', 'placeholder' ) . '" value="' . get_search_query() . '" name="s" maxlength="200"/>
			</label>
			' . _ladwp_year_dropdown('post') . '
			<label>' . esc_html__('Filter by Topic', 'ladwp') .'
			' . wp_dropdown_categories(array('show_option_none' => __('All Topics', 'ladwp'), 'echo' => false, 'class' => 'filter-select')) .'
			</label>
			<input type="hidden" name="ladwp-search-cat" value="1" >
			<button type="submit" class="btn ladwp-search-submit">' . esc_attr_x( 'Search', 'submit button' ) .'</button>
		</form>
	</aside>';

	if ( $echo )
		echo $form;
	else
		return $form;
}

function ladwp_get_search_form() {
	return '<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">
		<div class="search-form-container">
		<label class="screen-reader-text">' . _x( 'Search for:', 'label' ) . '</label>
		<input type="search" class="search-field" placeholder="' . esc_attr_x( 'Search &hellip;', 'placeholder' ) . '" value="' . get_search_query() . '" name="s" />
		<button class="btn-search"><i class="fa fa-search"></i></button>
		</div>
	</form>';
}

add_filter('get_search_form', 'ladwp_get_search_form');
