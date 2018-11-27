<?php
/*
 * Custom Functions
 *
*/ 

function button_read_more($id_post){
	$get_link = get_permalink($id_post);
	return '<p><a class="btn btn-default" href="'.$get_link.'">Read More »</a></p>';
}
function button_learn_more($id_post){
	$get_link = get_permalink($id_post);
	return '<a class="btn btn-default" href="'.$get_link.'">Learn More »</a>';
}

function button_middle_learn_more($url, $text){
    return '<a class="btn btn-default" href="'.esc_url($url).'">'.$text.'</a>';
}

// Apply Setting for Custom Customizer
function plains_set_color_of_button_one() {
    $button_one_color = get_theme_mod( 'header_button_one_color_custom' ); 
    
    if ( $button_one_color != '#002A5C' ) :
    ?>
        <style type="text/css">
            .btn-primary, a.btn-primary {
                background-color: <?php echo $button_one_color; ?>;
            }
        </style>
    <?php
    endif;
}
add_action( 'wp_head', 'plains_set_color_of_button_one' );

function plains_set_color_of_button_two() {
    $button_two_color = get_theme_mod( 'header_button_two_color_custom' ); 
    
    if ( $button_two_color != '#D31145' ) :
    ?>
        <style type="text/css">
            .btn-danger, a.btn-danger {
                background-color: <?php echo $button_two_color; ?>;
            }
        </style>
    <?php
    endif;
}
add_action( 'wp_head', 'plains_set_color_of_button_two' );

function set_header_text_color(){
    $link_color = get_header_textcolor(); 
    $link_color_default = '002A5C';

        if ( $link_color !== 'blank' && $link_color !== '000000') :
    ?>
        <style type="text/css">
        .navbar-title a, .navbar-title a:visited, .head-title h2 {
                color: #<?php echo $link_color; ?>;
            }   
        </style>
    <?php else: ?>
        <style type="text/css">
        .navbar-title a, .navbar-title a:visited, .head-title h2 {
                color: #<?php echo $link_color_default; ?>;
            }   
        </style>
    <?php
    endif; ?>
    <?php

}
add_action('wp_head', 'set_header_text_color');

function set_background_color(){
    $link_color = get_background_color(); 
    $link_color_default = 'ffffff';

        if ( $link_color != 'blank' ) :
    ?>
        <style type="text/css">
        #content {
                background-color: #<?php echo $link_color; ?>;
            }   
        </style>
    <?php else: ?>
        <style type="text/css">
        #content {
                background-color: #<?php echo $link_color_default; ?>;
            }   
        </style>
    <?php
    endif; ?>
    <?php

}
add_action('wp_head', 'set_background_color');

// yz --
// filtering archive page title
add_filter( 'get_the_archive_title', function ($title) {
    if ( is_category() ) {
            $title = single_cat_title( '', false );
        } elseif ( is_tag() ) {
            $title = single_tag_title( '', false );
        }
    return $title;
});


?>