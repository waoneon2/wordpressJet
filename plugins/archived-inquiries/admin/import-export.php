<?php

if (!defined('ABSPATH')) exit;

function jai_setup_inquiry_importer()
{
    global $_jinq_csv_importer;
    if (!defined('WP_LOAD_IMPORTERS')) return;
    // Load the import API
    require_once ABSPATH . 'wp-admin/includes/import.php';

    if (! class_exists('WP_Importer')) {
        $class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
        if (file_exists($class_wp_importer))
            require_once $class_wp_importer;
    }

    require_once __DIR__ . '/class-jai-csv-importer.php';
    $importerId = 'jai_achived_inquiry_importer_csv';
    $_jai_csv_importer = new JAI_CSV_Importer($importerId);
    register_importer(
        $importerId,
        __('Jetty Archived Inquiries Importer (CSV)', 'jai'),
        __( 'Import <strong>Inquiries</strong> csv file into your site.', 'jai'),
        [$_jai_csv_importer, 'dispatch']
    );
}
add_action('admin_init', 'jai_setup_inquiry_importer');