<?php

function jai_ajax_get_contact()
{
	$id = $_GET['id'];
    $contact = jai_get_contact($id);
    if (!$contact) {
        wp_send_json([
            'success' => false
        ]);
    } else {
        wp_send_json([
            'success' => true,
            'data'    => get_object_vars($contact)
        ]);
    }
}
add_action('wp_ajax_jai_ajax_get_contact', 'jai_ajax_get_contact', 10, 2);