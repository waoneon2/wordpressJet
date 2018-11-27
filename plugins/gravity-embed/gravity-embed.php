<?php
/**
 * Plugin Name: Gravity Embed
 * Plugin URI: http://www.eresources.com/
 * Description: Embed Gravity Form's form on other site
 * Author: Jetty Team
 * Version: 0.0.1
 * License: GPLv2 or later
 * Text Domain: gf-embed
 * Domain Path: languages
 */

// Setup
function gfembed_activation() {
    update_option('gfembed_flush_rewrite_rules', 'yes');
}

register_activation_hook(__FILE__ , 'gfembed_activation');

// flush rewrites rules if necessary
function gfembed_maybe_flush_retwrite_rules() {
    if (!is_network_admin() && 'yes' === get_option('gfembed_flush_rewrite_rules')) {
        update_option('gfembed_flush_rewrite_rules', 'yes' );
        flush_rewrite_rules();
    }
}

add_action('wp_loaded', 'gfembed_maybe_flush_retwrite_rules');

function gfembed_register_rewrite_rules() {
    add_rewrite_rule( '(gfembed)/?$', 'index.php?gfembed=$matches[1]', 'top' );
}

function gfembed_query_vars($vars) {
    $vars[] = 'gfembed';
    return $vars;
}

function gfembed_maybe_template_redirect() {
    global $wp, $_gfembed;

    if (empty( $wp->query_vars['gfembed'] ) || 'gfembed' !== $wp->query_vars['gfembed']) return;

    $form_id = null;
    if ( ! empty( $_GET['f'] ) ) {
        $form_id = absint( $_GET['f'] );
    } else {
        // The request needs an 'f' query arg with the form id.
        wp_die( esc_html__( 'Invalid form id.', 'gf-embed' ) );
    }
    $form = GFFormsModel::get_form_meta($form_id);
    $settings = $_gfembed->get_form_settings($form);

    if (empty( $settings['is_enabled'] ) || ! $settings['is_enabled'])
        wp_die( esc_html__( 'Embedding is disabled for this form.', 'gf-embed' ));

    // Disable the toolbar in case the form is embedded on the same domain.
    add_filter( 'show_admin_bar', '__return_false', 100 );

    require_once GFCommon::get_base_path() . '/form_display.php';

    // Settings may be overridden in the query string (querystring -> form settings -> default).
    $args = wp_parse_args( $_GET, array(
        'dt' => empty( $settings['display_title'] ) ? false : (bool) $settings['display_title'],
        'dd' => empty( $settings['display_description'] ) ? false : (bool) $settings['display_description'],
    ));

    // @todo Need to convert query string values to boolean.
    $display_title       = (bool) $args['dt'];
    $display_description = (bool) $args['dd'];

    unset( $args );
    unset( $settings );

    // allow templates to be customized in parent or child themes.
    $templates = array(
        'gf-embed-' . $form_id . '.php',
        'gf-embed.php',
    );

    $template = gfembed_locate_template($templates);
    require $template;
    exit;
}

function is_gfembed_page() {
    global $wp;
    return isset($wp->query_vars['gfembed'] ) && ('gfembed' === $wp->query_vars['gfembed']);
}

function gfembed_locate_template($templates, $load = false, $require_once = true) {
    $template = '';
    foreach ($templates as $tpl) {
        if (!$tpl) continue;
        if (file_exists($tc = get_stylesheet_directory() . '/' . $tpl)) {
            $template = $tc;
            break;
        } else if (file_exists($tp = get_template_directory() . '/' . $tpl)) {
            $template = $tp;
            break;
        } else if (file_exists($tpu = __DIR__ . '/templates/' .  $tpl)){
            $template = $tpu;
            break;
        }
    }
    if ($load && !empty($template)) load_template($template, $require_once);
    return $template;
}

function gfembed_wp_footer() {
    if (!is_gfembed_page() && !apply_filters('gfembed_print_resize_ping_script', false)) {
        return;
    }
    ?>
    <script type="text/javascript">
    (function($) {
        var $document = $( document );
        $(window).on( 'message', function( e ) {
            if ( 0 === e.originalEvent.data.indexOf( 'size?' ) ) {
                var index = e.originalEvent.data.replace( 'size?', '' ),
                    // size:index:width:height
                    message = 'size:' + index + ',' + document.body.scrollWidth + ',' + $document.height();
                e.originalEvent.source.postMessage(message, e.originalEvent.origin);
            }
        });
    } )(jQuery);
    </script>
    <?php

    do_action( 'gfembed_form_footer' );
}

// add our functionality on plugins_loaded hook
function gfembed_plugin_loaded() {
    global $_gfembed;
    if (! method_exists('GFForms', 'include_addon_framework')) {
        return;
    }
    add_action('init', 'gfembed_register_rewrite_rules');
    add_action('query_vars', 'gfembed_query_vars');
    add_action('template_redirect', 'gfembed_maybe_template_redirect');
    add_action('wp_footer', 'gfembed_wp_footer');
    GFForms::include_addon_framework();

    require_once __DIR__ . '/GFEmbedAddon.php';
    $_gfembed = new GFEmbedAddon(__FILE__);
}

add_action('plugins_loaded', 'gfembed_plugin_loaded');