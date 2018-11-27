<?php

function jte_register_custom_post_type()
{
    register_post_type('editing', [
        'labels' => [
            'name' => __('Editings'),
            'singular_name' => __('Editing'),
        ],
        'public' => false,
        'capability_type' => 'post',
        'map_meta_cap' => true,
        'hierarchical' => false,
        'rewrite' => false,
        'query_var' => false,
        'can_export' => false,
        'delete_with_user' => true,
        'supports' => ['author'],
    ]);
}
add_action('init', 'jte_register_custom_post_type');

function _jte_post_editing_fields($post = null, $autosave = false)
{
    static $fields;
    if ($fields === null) {
        $fields = [
            'post_title' => __('Title', 'jte'),
            'post_content' => __('Content', 'jte'),
            'post_excerpt' => __('Excerpt', 'jte'),
        ];

        $fields = apply_filters('_jte_post_editing_fields', $fields);
        $k = [
            'ID', 'post_name', 'post_parent', 'post_date', 'post_date_gmt', 'post_status',
            'post_type', 'comment_count', 'post_author',
        ];

        foreach ($k as $ki) {
            unset($fields[$ki]);
        }
    }
    if ($post instanceof WP_Post) {
        $post = get_object_vars($post);
    }
    if (!is_array($post)) {
        return $fields;
    }
    $ret = [];
    foreach (array_intersect(array_keys($post), array_keys($fields)) as $field) {
        $ret[$field] = $post[$field];
    }

    $ret['post_parent'] = $post['ID'];
    $ret['post_title'] = $post['post_title'];
    $ret['post_content'] = $post['post_content'];
    $ret['post_status'] = 'inherit';
    $ret['post_type'] = 'editing';
    $ret['post_name'] = $autosave ? "$post[ID]-autosave-v1" : "$post[ID]-editing-v1";
    $ret['post_date'] = isset($post['post_modified']) ? $post['post_modified'] : '';
    $ret['post_date_gmt'] = isset($post['post_modified_gmt']) ? $post['post_modified_gmt'] : '';

    return $ret;
}

function jte_save_post_editing($post_id)
{
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!$post = get_post($post_id, 'raw')) {
        return;
    }
    if ('auto-draft' === $post->post_status || !in_array($post->post_type, ['post', 'page'], true)) {
        return;
    }
    $editing = jte_get_post_first_editing($post);

    $fields = _jte_post_editing_fields(get_object_vars($post));
    $fields['ID'] = $editing->ID;
    wp_update_post($fields);
}
add_action('post_updated', 'jte_save_post_editing', 10, 1);

function jte_get_post_editing(&$post, $output = OBJECT, $filter = 'raw')
{
    if (!$editing = get_post($post, OBJECT, $filter)) {
        return $editing;
    }
    if ('editing' !== $editing->post_type) {
        return null;
    }
    if ($output === OBJECT) {
        return $editing;
    } elseif ($output === ARRAY_A) {
        $_editing = get_object_vars($editing);

        return $_editing;
    } elseif ($output === ARRAY_N) {
        $_editing = array_values(get_object_vars($editing));

        return $_editing;
    }

    return $editing;
}

function jte_delete_post_editing($post_id)
{
    if (!$editing = jte_get_post_editing($post_id)) {
        return $editing;
    }

    $delete = wp_delete_post($editing->ID);
    if ($delete) {
        do_action('jte_delete_post_editing', $editing->ID, $editing);
    }

    return $delete;
}

function _jte_put_post_editing($post = null, $autosave = false)
{
    if (is_object($post)) {
        $post = get_object_vars($post);
    } elseif (!is_array($post)) {
        $post = get_post($post, ARRAY_A);
    }

    if (!$post || empty($post['ID'])) {
        return new WP_Error('invalid_post', __('Invalid post ID.', 'jte'));
    }

    if (isset($post['post_type']) && 'editing' === $post['post_type']) {
        return new WP_Error('post_type', __('Cannot create a editing of a editing', 'jte'));
    }

    $post = _jte_post_editing_fields($post, $autosave);
    $post = wp_slash($post); //since data is from db

    $editing_id = wp_insert_post($post);
    if (is_wp_error($editing_id)) {
        return $editing_id;
    }

    if ($editing_id) {
        do_action('_jte_put_post_editing', $editing_id);
    }

    return $editing_id;
}

function jte_get_post_editings($post_id = 0, $args = null)
{
    $post = get_post($post_id);
    if (!$post || empty($post->ID)) {
        return [];
    }
    $defaults = ['order' => 'DESC', 'orderby' => 'date ID', 'check_enabled' => true];
    $args = wp_parse_args($args, $defaults);

    $args = array_merge($args, ['post_parent' => $post->ID, 'post_type' => 'editing', 'post_status' => 'inherit']);

    if (!$editings = get_children($args)) {
        return [];
    }
    return $editings;
}

function jte_get_post_first_editing($post_id = 0, $args = null)
{
    $editings = array_values(jte_get_post_editings($post_id, $args));
    if (empty($editings)) {
        $post = get_post($post_id);
        $editing = get_post(_jte_put_post_editing(get_object_vars($post)));
        jte_save_post_editing($post_id);
        $editing = get_post($editing->ID);
    } else {
        $editing = $editings[0];
    }

    return $editing;
}