<?php
/**
* Tweetable text shortcode
*/
add_shortcode( 'tweetable', 'the_fire_tweetable_shortcode');

function the_fire_tweetable_shortcode($attrs, $content) {
    global $post;
    if (strlen($content) === 0) {
        return;
    }
    $defaults = array(
        'via' => '',
        'url' => get_permalink($post),
    );
    $attrs = shortcode_atts($defaults, $attrs);
    $strdata = '';
    foreach ($attrs as $key => $val) {
        if (isset($val) && strlen($val)) {
            $strdata .= " data-$key='$val'";
        }
    }
    return "<span class='tweetable-fire' $strdata><span>" . $content . "</span><i class='dashicons dashicons-twitter'></i></span>";
}

add_action( 'wp_enqueue_scripts', 'the_fire_tweetable_scripts' );

function the_fire_tweetable_scripts() {
    wp_enqueue_style('dashicons');
    wp_enqueue_script( 'the-fire-tweetable-script', get_template_directory_uri() . '/js/tweetable.js', array( 'jquery' ), '0.0.1', true );
}