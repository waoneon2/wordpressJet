<?php


function jai_insert_contact($contact, $wp_error = false)
{
    global $wpdb;

    $defaults = [
        'email'         => '',
        'email2'        => '',
        'first_name'    => '',
        'last_name'     => '',
        'association'   => '',
        'city'          => '',
        'state'         => '',
        'address'       => '',
        'address2'      => '',
        'zip'           => '',
        'phone'         => '',
        'phone2'        => ''
    ];
    $contact = wp_parse_args($contact, $defaults);
    $id = wp_insert_post([
        'post_type'     => 'jai_archived_contact',
        'post_status'   => 'publish',
        'post_title'    => $contact['first_name'] . ' ' . $contact['last_name'],
        'post_content'  => ''
    ]);
    foreach ($contact as $k => $v) {
        update_post_meta($id, '_' . $k, $v);
    }
    return $id;
}

function jai_update_contact($contactarr, $id, $wp_error = false)
{
    foreach ($contactarr as $k => $v) {
        update_post_meta($id, '_' . $k, $v);
    }
    return $id;
}

function jai_get_contact($id)
{
    $contact = new stdClass();
    $meta = get_post_meta($id);
    if (!$meta) return false;
    $keys = [
        'email',
        'email2',
        'first_name',
        'last_name',
        'association',
        'city',
        'state',
        'address',
        'address2',
        'zip',
        'phone',
        'phone2',
    ];
    $contact->ID = $id;
    foreach ($keys as $k) {
        $contact->$k = $meta['_' . $k][0];
    }
    return $contact;
}

function jai_anonymous_contact()
{
    $contact = new stdClass();
    $keys = [
        'email',
        'email2',
        'first_name',
        'last_name',
        'association',
        'city',
        'state',
        'address',
        'address2',
        'zip',
        'phone',
        'phone2',
    ];
    foreach ($keys as $k) {
        $contact->$k = '';
    }
    $contact->ID = 0;
    return $contact;
}

function jai_get_contact_by_email($email)
{
    $args = [
        'meta_query' => [
            [ 'key'   => '_email', 'value' => $email ]
        ],
        'post_type'         => 'jai_archived_contact',
        'posts_per_page'    => 1
    ];
    $inq = get_posts($args);
    $iq = count($inq) > 0 ? current($inq) : null;
    if ($iq === null) return false;
    return jai_get_contact($iq->ID);
}