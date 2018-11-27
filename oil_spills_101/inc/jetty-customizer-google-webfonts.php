<?php
/*
* Jetty Customizer Google Webfonts
* Reference : https://developers.google.com/fonts/docs/developer_api
*/

$key = 'AIzaSyAurnlKoevMhLqTEuaC_TlgEbSDmaWOz0o';
$get_url = 'https://www.googleapis.com/webfonts/v1/webfonts';
$get_all_google_webfonts = $get_url . '?key=' .$key;
$response = wp_remote_request($get_all_google_webfonts, array('sslverify' => false ));
$fg = wp_remote_retrieve_body($response);
$bn = array();
if( is_wp_error( $fg ) ) {
    echo 'Something went wrong!';
} else {

    $json_fonts = json_decode($fg,  true);
    
    $items = $json_fonts['items'];
    $i = 0;
    foreach ($items as $item) {
        $i++;
        $name = str_replace(' ', '_', strtolower($item['family']));
        $location = str_replace(' ', '+', $item['family']);
        $css = '"'.$item['family'].'", '.$item['category'].'';
        $bn[$name] = array(
            'name' => $item['family'],
            'location' => $location,
            'css' => $css
            );
    }
}

$jetty_google_webfonts = $bn;

$jetty_google_webfonts_list = wp_list_pluck($jetty_google_webfonts, 'name');

function jetty_typography_options($wp_customize) {
    global $jetty_google_webfonts_list;

    $wp_customize->add_section('jetty_typography_section', array('title' => esc_html__('Font Picker', 'jettyapp'), 'priority' => 3));


    $wp_customize->add_setting('jetty_google_webfonts_options[google_webfonts]', array('default' => 'enable', 'type' => 'option', 'sanitize_callback' => 'jetty_sanitize_select'));
    $wp_customize->add_setting('jetty_google_webfonts_options[font_heading]', array('default' => 'oswald', 'type' => 'option', 'sanitize_callback' => 'jetty_sanitize_google_webfonts'));
    $wp_customize->add_setting('jetty_google_webfonts_options[font_body]', array('default' => 'pt_serif', 'type' => 'option', 'sanitize_callback' => 'jetty_sanitize_google_webfonts'));


    $wp_customize->add_control('google_webfonts', array('label' => esc_html__('Google Webfonts', 'jettyapp'), 'section' => 'jetty_typography_section', 'settings' => 'jetty_google_webfonts_options[google_webfonts]', 'priority' => 2, 'type' => 'select', 'choices' => array('enable' => esc_html__('Enable', 'jettyapp'), 'disable' => esc_html__('Disable', 'jettyapp'))));
    $wp_customize->add_control('font_heading', array('label' => esc_html__('Google Webfont for Headings', 'jettyapp'),'description' => __('Change <b>font-family</b> for <b>header, h1, h2, button, select, textarea, input</b>','jettyapp'), 'section' => 'jetty_typography_section', 'settings' => 'jetty_google_webfonts_options[font_heading]', 'priority' => 4, 'type' => 'select', 'choices' => $jetty_google_webfonts_list));
    $wp_customize->add_control('font_body', array('label' => esc_html__('Google Webfont for Body Text', 'jettyapp'), 'description' => __('Change <b>font-family</b> for <b>body</b>','jettyapp'), 'section' => 'jetty_typography_section', 'settings' => 'jetty_google_webfonts_options[font_body]', 'priority' => 5, 'type' => 'select', 'choices' => $jetty_google_webfonts_list));

}
add_action('customize_register', 'jetty_typography_options');

function jetty_sanitize_google_webfonts($input) {
    global $jetty_google_webfonts_list;
    $valid = $jetty_google_webfonts_list;
    if (array_key_exists($input, $valid)) {
        return $input;
    } else {
        return '';
    }
}

function jetty_sanitize_select($input) {
    $valid = array(
        'enable' => esc_html__('Enable', 'jettyapp'),
        'disable' => esc_html__('Disable', 'jettyapp'),
    );
    if (array_key_exists($input, $valid)) {
        return $input;
    } else {
        return '';
    }
}

if (!function_exists('jetty_custom_fonts')) {
    function jetty_custom_fonts() {
        $custom_fonts = wp_parse_args(
            get_option('jetty_google_webfonts_options', array()),
            jetty_default_fonts()
        );
        return $custom_fonts;
    }
}

if (!function_exists('jetty_default_fonts')) {
    function jetty_default_fonts() {
        $default_fonts = array(
            'google_webfonts' => 'enable',
            'font_heading' => 'oswald',
            'font_body' => 'pt_serif'
        );
        return $default_fonts;
    }
}

if (!function_exists('jetty_google_webfonts')) {
    function jetty_google_webfonts() {
        $jetty_fonts = jetty_custom_fonts();
        if ($jetty_fonts['google_webfonts'] == 'enable') {
            global $jetty_google_webfonts;
            $font_header_text = '';
            $font_heading = '';
            if ($jetty_fonts['font_heading'] != $jetty_fonts['font_body']) {
                $font_heading = '%7c' . $jetty_google_webfonts[$jetty_fonts['font_heading']]['location'];
            }
            wp_enqueue_style('jetty-google-fonts', 'https://fonts.googleapis.com/css?family=' . $jetty_google_webfonts[$jetty_fonts['font_body']]['location'] . $font_heading . $font_header_text, array(), null);
        }
    }
}
add_action('wp_enqueue_scripts', 'jetty_google_webfonts');

if (!function_exists('jetty_fonts_css')) {
    function jetty_fonts_css() {
        $jetty_fonts = jetty_custom_fonts();
        if ($jetty_fonts['google_webfonts'] == 'enable') {
            global $jetty_google_webfonts;
            if ($jetty_fonts['font_heading'] != 'oswald' || $jetty_fonts['font_body'] != 'pt_serif') {
                echo '<style type="text/css">' . "\n";
                    if ($jetty_fonts['font_heading'] != 'oswald') {
                        echo 'header.site-header, header, h1, h2, button, select, textarea, input { font-family: ' . $jetty_google_webfonts[$jetty_fonts['font_heading']]['css'] .'; }' . "\n";
                    }
                    if ($jetty_fonts['font_body'] != 'pt_serif') {
                        echo 'body { font-family: ' . $jetty_google_webfonts[$jetty_fonts['font_body']]['css'] . '; }' . "\n";
                    }
                echo '</style>' . "\n";
            }
        }
    }
}
add_action('wp_head', 'jetty_fonts_css');

?>