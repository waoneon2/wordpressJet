<?php

if (!defined('ABSPATH')) exit;

/**
 * Register custom post type for Jetty Inquiry
 * @return void
 */
function jai_setup_cpt()
{
    // Archived Inquiry
    $inquiry_label = [
        'name'               => _x('Archived Inquiries', 'post type general name', 'jai'),
        'singular_name'      => _x('Archived Inquiry', 'post type singular name', 'jai'),
        'add_new'            => __('Add New', 'jai'),
        'add_new_item'       => __('Add New Archived Inquiry', 'jai'),
        'edit_item'          => __('Edit Archived Inquiry', 'jai'),
        'new_item'           => __('New Archived Inquiry', 'jai'),
        'all_items'          => __('All Archived Inquiries', 'jai'),
        'view_item'          => __('View Archived Inquiries', 'jai'),
        'search_items'       => __('Search Archived Inquiries', 'jai'),
        'not_found'          => __('No Archived Inquiries found', 'jai'),
        'not_found_in_trash' => __('No Archived Inquiries found in Trash', 'jai'),
        'parent_item_colon'  => '',
        'menu_name'          => __('Archived Inquiries', 'jai')
    ];
    $inquiry_args = [
        'labels'          => apply_filters( 'jai_inquiry_label', $inquiry_label),
        'public'          => false,
        'show_ui'         => true,
        'query_var'       => false,
        'rewrite'         => false,
        'supports'        => false,
        'can_export'      => true,
        'capability_type' => 'post',
        'capabilities'    => [
            'create_posts' => 'do_not_allow',
        ],
        'map_meta_cap' => true,
        'show_in_menu' => 'edit.php?post_type=inquiry'
    ];
    register_post_type('jai_archived_inquiry', $inquiry_args);

    // Archived Inquiry Event's. Not Shown on Menu
    $event_label = [
        'name'                  => _x('Events', 'post type general name', 'jai'),
        'singular_name'         => _x('Event', 'post type singular name', 'jai'),
        'menu_name'             => _x('Inquiry Event', 'Admin menu name', 'jai'),
        'add_new'               => __('Add Event', 'jai'),
        'add_new_item'          => __('Add New Event', 'jai'),
        'edit'                  => __('Edit', 'jai'),
        'edit_item'             => __('Edit Event', 'jai'),
        'new_item'              => __('New Event', 'jai'),
        'view'                  => __('View Event', 'jai'),
        'view_item'             => __('View Event', 'jai'),
        'search_items'          => __('Search Events', 'jai'),
        'not_found'             => __('No Events found', 'jai'),
        'not_found_in_trash'    => __('No Events found in trash', 'jai'),
        'parent'                => __('Parent Events', 'jai')
    ];
    $event_args = [
        'label'             => $event_label,
        'public'            => false,
        'query_var'         => false,
        'rewrite'           => false,
        'show_ui'           => false,
        'supports'          => false,
        'can_export'        => true
    ];
    register_post_type('jai_archived_event', $event_args);

    $contact_label = [
        'name'                  => _x('Contacts', 'post type general name', 'jai'),
        'singular_name'         => _x('Contact', 'post type singular name', 'jai'),
        'menu_name'             => _x('Inquiry Contact', 'Admin menu name', 'jai'),
        'add_new'               => __('Add Contact', 'jai'),
        'add_new_item'          => __('Add New Contact', 'jai'),
        'edit'                  => __('Edit', 'jai'),
        'edit_item'             => __('Edit Contact', 'jai'),
        'new_item'              => __('New Contact', 'jai'),
        'view'                  => __('View Contact', 'jai'),
        'view_item'             => __('View Contact', 'jai'),
        'search_items'          => __('Search Contacts', 'jai'),
        'not_found'             => __('No Contacts found', 'jai'),
        'not_found_in_trash'    => __('No Contacts found in trash', 'jai'),
        'parent'                => __('Parent Contacts', 'jai')
    ];
    $contact_args = [
        'label'             => $contact_label,
        'public'            => false,
        'query_var'         => false,
        'rewrite'           => false,
        'show_ui'           => false,
        'supports'          => false,
        'can_export'        => true
    ];
    register_post_type('jai_archived_contact', $contact_args);
}
add_action('init', 'jai_setup_cpt');

/**
 * jai_get_inquiry_by_id
 * @param  int|string $id The inquiry ID
 * @return WP_Post|null
 */
function jai_get_inquiry_by_id($id)
{
    $args = [
        'meta_query' => [
            [ 'key'   => '_inquiry_id', 'value' => $id ]
        ],
        'post_type'         => 'jai_archived_inquiry',
        'posts_per_page'    => 1
    ];
    $inq = get_posts($args);
    return count($inq) > 0 ? current($inq) : null;
}

function jai_create_inquiry($title, $summary, $inquirer, $submitted_date = null)
{
    if ($submitted_date !== null) {
        try {
            $_date = new DateTime($submitted_date);
            $date = $_date->format('Y-m-d H:i:s');
        } catch (Exception $e) {
            $date = current_time('mysql');
        }
    } else {
        $date = current_time('mysql');
    }
    $id = wp_insert_post([
        'post_title'    => $title,
        'post_content'  => $summary,
        'post_status'   => 'publish',
        'post_type'     => 'jai_archived_inquiry',
        'post_date'     => $date
    ]);

    update_post_meta($id, '_inquirer', $inquirer);

    return $id;
}

function jai_create_inquiry_event($inquiryID, $title, $summary, $submitted_date = null)
{
    if ($submitted_date !== null) {
        try {
            $_date = new DateTime($submitted_date);
            $date = $_date->format('Y-m-d H:i:s');
        } catch (Exception $e) {
            $date = current_time('mysql');
        }
    } else {
        $date = current_time('mysql');
    }
    $id = wp_insert_post([
        'post_title'    => $title,
        'post_content'  => '',
        'post_status'   => 'publish',
        'post_type'     => 'jai_archived_event',
        'post_parent'   => $inquiryID,
        'post_date'     => $date
    ]);
    return $id;
}
