<?php
add_filter('nav_menu_items_page_recent', 'nav_menu_items_page_recent_with_private', 10, 3);
add_filter('nav_menu_items_post_recent', 'nav_menu_items_page_recent_with_private', 10, 3);

// Update post_status arg to include private pages
function nav_menu_items_page_recent_with_private($most_recent, $args, $box) {
    $args['post_status'] = [
      'publish',
      'private',
    ];

    // Unsure why these aren't passed into the filter already since it's specifically for the Most Recent tab.
    // Bug filed: https://core.trac.wordpress.org/ticket/39849#ticket
    $recent_args = array_merge( $args, array( 'orderby' => 'post_date', 'order' => 'DESC', 'posts_per_page' => 15 ) );

    // @todo transient caching of these results with proper invalidation on updating of a post of this type
    $get_posts = new WP_Query;

    $most_recent = $get_posts->query( $recent_args );
    return $most_recent;

  }

add_filter('nav_menu_items_page', 'nav_menu_items_page_with_private', 10, 3);
add_filter('nav_menu_items_post', 'nav_menu_items_page_with_private', 10, 3);

// Once again, update the args. But we'll have to copy and paste a little extra to be truly seamless.
function nav_menu_items_page_with_private($posts, $args, $post_type) {
  global $_nav_menu_placeholder;

  $args['post_status'] = [
    'publish',
    'private',
  ];

  $get_posts = new WP_Query;
  $posts = $get_posts->query( $args );

  /*
   * If we're dealing with pages, let's put a checkbox for the front
   * page at the top of the list. *** Copied from wp-admin/includes/nav-menu.php ***
   */
  if ( 'page' == $post_type ) {
      $front_page = 'page' == get_option('show_on_front') ? (int) get_option( 'page_on_front' ) : 0;
      if ( ! empty( $front_page ) ) {
        $front_page_obj = get_post( $front_page );
        $front_page_obj->front_or_home = true;
        array_unshift( $posts, $front_page_obj );
      } else {
        $_nav_menu_placeholder = ( 0 > $_nav_menu_placeholder ) ? intval($_nav_menu_placeholder) - 1 : -1;
        array_unshift( $posts, (object) array(
          'front_or_home' => true,
          'ID' => 0,
          'object_id' => $_nav_menu_placeholder,
          'post_content' => '',
          'post_excerpt' => '',
          'post_parent' => '',
          'post_title' => _x('Home', 'nav menu home label'),
          'post_type' => 'nav_menu_item',
          'type' => 'custom',
          'url' => home_url('/'),
        ) );
      }
    }

    if ( $post_type->has_archive ) {
      $_nav_menu_placeholder = ( 0 > $_nav_menu_placeholder ) ? intval($_nav_menu_placeholder) - 1 : -1;
      array_unshift( $posts, (object) array(
        'ID' => 0,
        'object_id' => $_nav_menu_placeholder,
        'object'     => $post_type_name,
        'post_content' => '',
        'post_excerpt' => '',
        'post_title' => $post_type->labels->archives,
        'post_type' => 'nav_menu_item',
        'type' => 'post_type_archive',
        'url' => get_post_type_archive_link( $post_type_name ),
      ) );
    }
    return $posts;
  }

add_filter( 'wp_get_nav_menu_items', 'remove_private_pages_from_menu', null, 3);

// Make sure that only logged in users will see these private pages
function remove_private_pages_from_menu($items, $menu, $args) {
  if(!is_user_logged_in() || !current_user_can('read_private_pages')) {
    foreach($items as $key => $item) {
      if('private' == get_post_status($item->object_id)) {
        unset($items[$key]);
      }
    }
  }
  return $items;
}
