<?php
if(!function_exists('jetty_header_custom_url')){
    function jetty_header_custom_url() {
        $custom_url = trim(get_theme_mod('exxon_redirect_url_setting', ''));
        if($custom_url !== '') {
            $url = filter_var($custom_url, FILTER_SANITIZE_URL);
            if(filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_HOST_REQUIRED) === FALSE){
                return home_url();
            } else {
                return esc_url($custom_url);
            }
        }
        return false;
    }
}

if(!function_exists('exxon_child_custom_redirect')){
    function exxon_child_custom_redirect()
    {
        if ((is_home() || is_front_page()) && !is_customize_preview()) {
            $url = jetty_header_custom_url();
            if ($url !== false && $url !== home_url()) {
                wp_redirect($url, 301);
                exit;
            }
        }
    }
}
add_action('template_redirect', 'exxon_child_custom_redirect');