<?php
function lms() {

    global $wp_query;

    wp_enqueue_script('jquery');

    wp_register_script( 'mylms', get_template_directory_uri() . '/js/mylms.js', array('jquery') );

    wp_localize_script( 'mylms', 'mlp', array(
        'chevron_ajaxurl' => admin_url('admin-ajax.php', 'relative'),
        'posts' => json_encode( $wp_query->query_vars ),
        'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
        'max_page' => $wp_query->max_num_pages
    ) );

    wp_enqueue_script( 'mylms' );
}

add_action( 'wp_enqueue_scripts', 'lms' );

function jetty_lmr_ajax_handler(){

    $args = json_decode( stripslashes( $_POST['query'] ), true );
    $args['paged'] = $_POST['page'] + 1;
    $args['post_status'] = 'publish';

    query_posts( $args );
    if( have_posts() ) :
        while( have_posts() ): the_post();
            get_template_part( 'template-parts/content', 'search' );
        endwhile;

    endif;
    die;
}

add_action('wp_ajax_lmr', 'jetty_lmr_ajax_handler');
add_action('wp_ajax_nopriv_lmr', 'jetty_lmr_ajax_handler');