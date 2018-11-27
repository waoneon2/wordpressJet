<?php

function jai_process_admin_actions()
{
    if ( isset( $_POST['jai-action'] ) ) {
        do_action( 'jai_' . $_POST['jai-action'], $_POST );
    }

    if ( isset( $_GET['jai-action'] ) ) {
        do_action( 'jai_' . $_GET['jai-action'], $_GET );
    }
}
add_action('admin_init', 'jai_process_admin_actions');

function jai_admin_delete_contact($data)
{
    if (!isset($data['_wpnonce']) || !wp_verify_nonce($data['_wpnonce'], 'jai_contact_nonce')) {
        wp_die( __( 'Trying to cheat or something?', 'jai' ), __( 'Error', 'jai' ), array( 'response' => 403 ) );
    }

    $id = $data['contact'];
    wp_delete_post($id, true);
}
add_action('jai_delete_contact', 'jai_admin_delete_contact');