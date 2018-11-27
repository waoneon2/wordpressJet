<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/*
Plugin Name: Jetty User Tags
Plugin URI: http://eresources.com
Description: Allow you to add tags to user
Version: 0.1
Author: Jetty Team
Author URI: http://eresources.com
License: GPL version 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/

add_action('admin_enqueue_scripts', 'jut_style_of_media');
function jut_style_of_media(){
    
    $screen = get_current_screen();
    if ( $screen->base === 'users' ) {
        wp_enqueue_script( 'jut-admin-script', plugins_url('/js/jut-admin-script.js', __FILE__ ), array('jquery'), '20171123', true );
    }
}

add_action('init', 'jut_register_taxononomy_for_user');
function jut_register_taxononomy_for_user()
{
  register_taxonomy( 'user_tag', 'user', array(
    'public' => false,
    'show_ui' => true,
    'labels' => array(
      'name'                       => 'Tags',
      'singular_name'              => 'Tag',
      'menu_name'                  => 'Tags',
      'search_items'               => 'Search Tags',
      'popular_items'              => 'Popular Tags',
      'all_items'                  => 'All Tags',
      'edit_item'                  => 'Edit Tag',
      'update_item'                => 'Update Tag',
      'add_new_item'               => 'Add New Tag',
      'new_item_name'              => 'New Tag Name',
      'separate_items_with_commas' => 'Separate Tags with commas',
      'add_or_remove_items'        => 'Add or remove Tags',
      'choose_from_most_used'      => 'Choose from the most popular tags',
    ),
    'hierarchical' => false,
    'rewrite' => false,
    'capabilities' => array(
      'manage_terms' => 'edit_users',
      'edit_terms'   => 'edit_users',
      'delete_terms' => 'edit_users',
      'assign_terms' => 'read',
    ),
  ) );
}

// Menus =====================================================
add_action('admin_menu', 'jut_admin_menu');
function jut_admin_menu()
{
    global $wp_taxonomies;
    $key = 'user_tag';
    $taxonomies = $wp_taxonomies[$key];
    add_users_page(
        $taxonomies->labels->menu_name, 
        $taxonomies->labels->menu_name, 
        $taxonomies->cap->manage_terms, 
        "edit-tags.php?taxonomy={$key}"
    );
}
add_filter('parent_file','jut_parent_menu');
function jut_parent_menu( $parent = '' )
{
    global $pagenow, $wp_taxonomies;
    $taxonomies = $wp_taxonomies;

    if(!empty($_GET['taxonomy']) && $pagenow == 'edit-tags.php' && isset($taxonomies[$_GET['taxonomy']])) {
        $parent = 'users.php';
    }
    return $parent;
}

// List Table ====================================================
add_filter( 'manage_users_columns' , 'jut_manage_users_columns' );
function jut_manage_users_columns( $columns )
{
    $col = array_slice( $columns, 0, 4 );
    $coll = array_slice( $columns, 4 );
    $col_new = array_merge( $col, array('user_tag' => __('Tags')), $coll );
    return $col_new;
}

add_filter( 'manage_users_custom_column' , 'jut_manage_users_custom_column', 10, 3 );
function jut_manage_users_custom_column( $content, $column, $user_id )
{
    if ( $column !== 'user_tag' ) return $content;
    if ( ! $tags = wp_get_object_terms( $user_id, $column ) )
    {
        return '<span class="na">&ndash;</span>';
    }
    else
    {
        $termlist = array();
        foreach ( $tags as $tag )
        {
            $termlist[] = '<a href="' . admin_url( 'users.php?user_tag=' . $tag->slug ) . ' ">' . $tag->name . '</a>';
        }
        return implode( ', ', $termlist );
    }
}

add_filter( 'pre_user_query', 'jut_filter_tag' );
function jut_filter_tag( $query )
{
    global $wpdb, $pagenow;

    if (is_admin() && $pagenow == 'users.php' && !empty( $_GET['user_tag'] ))
    {
        $slug = $_GET['user_tag'];
        $query->query_from .= " INNER JOIN {$wpdb->term_relationships} ON {$wpdb->users}.ID = {$wpdb->term_relationships}.object_id INNER JOIN {$wpdb->term_taxonomy} ON {$wpdb->term_relationships}.term_taxonomy_id = {$wpdb->term_taxonomy}.term_taxonomy_id INNER JOIN {$wpdb->terms} ON {$wpdb->terms}.term_id = {$wpdb->term_taxonomy}.term_id";
        $query->query_where .= " AND {$wpdb->terms}.slug = '{$slug}'";
    }
    
    if (is_admin() && $pagenow == 'users.php' && !empty( $_GET['user_meta_key']) && !empty( $_GET['user_meta_value'] ))
    {
        $meta_key = $_GET['user_meta_key'];
        $meta_value = $_GET['user_meta_value'];
        $query->query_from .= " INNER JOIN {$wpdb->usermeta} ON {$wpdb->usermeta}.user_id = {$wpdb->users}.ID ";
        $query->query_where = "WHERE {$wpdb->usermeta}.meta_key = '{$meta_key}' AND {$wpdb->usermeta}.meta_value = '{$meta_value}' ";
    }
}

// Bulk Option
function jut_get_term_obj(){
    $args = array(
        'child_of'                 => 0,
        'parent'                   => '',
        'orderby'                  => 'name',
        'order'                    => 'ASC',
        'hide_empty'               => 0,
        'hierarchical'             => 0,
        'exclude'                  => '',
        'include'                  => '',
        'number'                   => '',
        'taxonomy'                 => 'user_tag',
        'pad_counts'               => false 
    );

    return get_categories( $args );
}
add_filter( 'bulk_actions-users', 'jut_custom_bulk_action' );
function jut_custom_bulk_action($bulk_action){
    $break = 0;
    $term = jut_get_term_obj();
    $bulk_action[-1] = __('User Tags','jut');

    foreach ($term as $key1 => $value1) {
        $bulk_action['add_'.$value1->term_id] = __('&nbsp;&nbsp;&nbsp;Add: '.$value1->name,'jut');
    }
    foreach ($term as $key2 => $value2) {
        $bulk_action['remove_'.$value2->term_id] = __('&nbsp;&nbsp;&nbsp;Remove: '.$value2->name,'jut');
    }

    return $bulk_action;
}

add_filter( 'handle_bulk_actions-users', 'jut_custom_bulk_action_handler', 10, 3 );
function jut_custom_bulk_action_handler($redirect_to, $action_name, $post_ids){
    $da = explode("_", $action_name);
    $r = explode('?', $redirect_to);
    $redirect_to = $r[0];
    
    $term = jut_get_term_obj();
    $arr_cat_id = wp_list_pluck($term, 'term_id');

    if(isset($post_ids)){
        if($da[0] === "add"){
            for ($i=0; $i < count($post_ids); $i++) {
                $set_cat_to_media = wp_add_object_terms( (int)$post_ids[$i], (int)$da[1],'user_tag');
            }
        }
        if($da[0] === "remove"){
            for ($i=0; $i < count($post_ids); $i++) {
                $remove_cat_on_media = wp_remove_object_terms( (int)$post_ids[$i], (int)$da[1], 'user_tag' );
            }
        }
        return $redirect_to;
    } else {
        return $redirect_to;
    }
    return $redirect_to;
}

// Filter User Meta
add_action( 'restrict_manage_users', 'jut_bulk_filter', 1, 1 );
function jut_bulk_filter( $which ) {

    if ( $which !== 'top' )
        return;

    $user_meta = array_keys(get_user_meta( get_current_user_id()));
    if ( current_user_can( 'edit_users' ) ) { ?>

        <label class="screen-reader-text" for="add_user_tag"><?php _e( 'Add tag&hellip;', 'easy-user-tags' ) ?></label>
        <select name="user_meta_key" id="add_user_tag" style="float: none; vertical-align:0; margin-right: 0; margin-left: 10px;">
            <option value=""><?php _e( 'Meta Key&hellip;', 'easy-user-tags' ) ?></option>
            <?php foreach ($user_meta as $key => $value): ?>
                <option value="<?php echo $value ?>" <?php echo (isset($_GET['user_meta_key']) && $_GET['user_meta_key'] == $value) ? 'selected' : '' ?>><?php echo $value; ?></option>
            <?php endforeach ?>
        </select>

        <label class="screen-reader-text" for="remove_user_tag"><?php _e( 'Remove tag&hellip;', 'easy-user-tags' ) ?></label>
        <input type="text" name="user_meta_value" placeholder="Meta Value..." value="<?php echo isset($_GET['user_meta_value']) ? $_GET['user_meta_value'] : '' ?>">

        <input type="submit" name="filteruser" id="filteruser" class="button" value="Filter" >
    <?php }
}

// EOF Filter category for Media


// Hook
function jus_is_user_field_list($field) {
    $field_list = array('ID',
        'user_login',
        'user_pass',
        'user_nicename',
        'user_email',
        'user_url',
        'user_registered',
        'user_activation_key',
        'user_status',
        'display_name',
        'object_id',
        'term_taxonomy_id',
        'term_order',
        'term_id',
        'taxonomy',
        'description',
        'parent',
        'count',
        'name',
        'slug',
        'term_group'
    );

    return in_array($field, $field_list);
}
add_filter( 'jut_get_users', 'jut_get_user', 10, 2 );
function jut_get_user($slug, $filter) {

    global $wpdb;
    $meta = array();
    $select = $wpdb->users.'.ID';
    if (is_array($filter)) {
        foreach ($filter as $key => $value) {
            if (jus_is_user_field_list($value)) {
                $select .= ', ';
                $select .= $wpdb->users.'.'.$value;
            } else {
                $meta[] = $value;
            }
        }
    } else {
        if ($filter) {
            if (jus_is_user_field_list($filter)) {
                $select .= ', ';
                $select .= $wpdb->users.'.'.$filter;
            } else {
                $meta[] = $filter;
            }
        } else {
           
        }
    }

    $results = $wpdb->get_results( "SELECT {$select} FROM {$wpdb->users} 
        INNER JOIN {$wpdb->term_relationships} ON {$wpdb->users}.ID = {$wpdb->term_relationships}.object_id 
        INNER JOIN {$wpdb->term_taxonomy} ON {$wpdb->term_relationships}.term_taxonomy_id = {$wpdb->term_taxonomy}.term_taxonomy_id 
        INNER JOIN {$wpdb->terms} ON {$wpdb->terms}.term_id = {$wpdb->term_taxonomy}.term_id
        WHERE {$wpdb->terms}.slug = '{$slug}'", OBJECT );

    $i = 0;
    foreach ($results as $value) {
        $result[$i] = $value;
        if ($meta) {
            foreach ($meta as $m) {
                $result[$i]->{$m} = get_user_meta($value->ID, $m, true);
            }
        }
        $i++;
    }
    return is_array(isset($result)) ? $result : array();
}
 
function jut_get_user_by_tag($slug, $filter ) {
    return apply_filters( 'jut_get_users', $slug, $filter );
}