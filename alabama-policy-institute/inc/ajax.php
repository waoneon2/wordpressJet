<?php

function alabama_policy_institute_readmore_ajax()
{
    $offset     = $_GET['offset'];
    $perpage    = isset($_GET['per_page']) ? (int) $_GET['per_page'] : 3;
    $settings   = $_GET ['settings'];
    $page       = isset($_GET ['page']) ? $_GET ['page'] : '';


    if ( $page == 'staff') {
        $query = new WP_Query([
            'posts_per_page'      => $perpage + 1,
            'ignore_sticky_posts' => 1,
            'post_type'           => 'post',
            'offset'              => $offset,
            'author'              => $settings['author_ID'],
        ]);
    } elseif ( $page == 'taxonomy') {
        $query = new WP_Query([
            'posts_per_page'      => $perpage,
            'ignore_sticky_posts' => 1,
            'post_type'           => 'post',
            'offset'              => $offset,
            'tax_query' => array(
                array(
                    'taxonomy' => $settings['tax'],
                    'field'    => 'slug',
                    'terms'    => $settings['term'],
                ),
            )
        ]);
    } elseif ( $page == 'category') {
        $query = new WP_Query([
            'posts_per_page'      => $perpage + 1,
            'ignore_sticky_posts' => 1,
            'post_type'           => 'post',
            'offset'              => $offset,
            'cat'                 => $settings['catID']
        ]);
    } elseif ( $page == 'multimedia') {
        $terms_multimedia = get_terms('multimedia', array(
            'hide_empty' => false,
        ) );

        foreach ($terms_multimedia as $key => $value) {
            $term_list[] = $value->slug;
        }
        $query = new WP_Query([
            'posts_per_page'      => $perpage + 1,
            'ignore_sticky_posts' => 1,
            'post_type'           => 'post',
            'offset'              => $offset,
            'tax_query' => array(
                array(
                    'taxonomy' => 'multimedia',
                    'field'    => 'slug',
                    'terms'    => $term_list,
                ),
            )
        ]);
    } elseif ( $page == 'publication') {
        $pub_perpage = 10;
        $terms_publication = get_terms('publication', array(
            'hide_empty' => false,
        ) );

        foreach ($terms_publication as $key => $value) {
            $term_list[] = $value->slug;
        }
        $query = new WP_Query([
            'posts_per_page'      => $pub_perpage + 1 ,
            'ignore_sticky_posts' => 1,
            'post_type'           => 'post',
            'offset'              => $offset,
            'tax_query' => array(
                array(
                    'taxonomy' => 'publication',
                    'field'    => 'slug',
                    'terms'    => $term_list,
                ),
            )
        ]);
    } elseif ( $page == 'topic') {
        $terms_topic = get_terms('topic', array(
            'hide_empty' => false,
        ) );

        foreach ($terms_topic as $key => $value) {
            $term_list[] = $value->slug;
        }
        $query = new WP_Query([
            'posts_per_page'      => $perpage + 1,
            'ignore_sticky_posts' => 1,
            'post_type'           => 'post',
            'offset'              => $offset,
            'tax_query' => array(
                array(
                    'taxonomy' => 'topic',
                    'field'    => 'slug',
                    'terms'    => $term_list,
                ),
            )
        ]);
    } elseif ( $page == 'events') {
        $query = new WP_Query([
            'posts_per_page'      => $perpage + 1,
            'ignore_sticky_posts' => 1,
            'post_type'           => 'post',
            'offset'              => $offset,
            'category_name' => 'events'
        ]);
    } else {
        $query = new WP_Query([
            'posts_per_page'      => $perpage + 1,
            'ignore_sticky_posts' => 1,
            'post_type'           => 'post',
            'offset'              => $offset
        ]);
    }

    // Publication, Topic
    if( $page == 'publication' || $page == 'topic' || $page == 'events'){
        $j = 0;
        $next = count($query->posts) > 9;
        if ($query->have_posts()) {
            ob_start();
            while ($query->have_posts() && $j <= 9): $query->the_post();
                if ($page == 'publication') {
                    get_template_part('template-parts/content', 'publication-second');
                } elseif ($page == 'topic') {
                    get_template_part('template-parts/content', 'topic-second');
                } elseif ($page == 'events') {
                    get_template_part('template-parts/content', 'event-second');
                }

                $j++;
            endwhile;
            wp_reset_query();
            $html = ob_get_clean();
            send_origin_headers();
            @header( 'Content-Type: text/json; charset=' . get_option( 'blog_charset' ) );
            wp_send_json_success([
                'html' => $html,
                'page' => $page,
                'setting' => $settings,
                'next_available' => $next
            ]);
        } else {
            wp_send_json_error([
                'reason' => 'nomore'
            ]);
        }
    }
    else { //
        $i = 0;
        $next = count($query->posts) > 3;
        if ($query->have_posts()) {
            ob_start();
            while ($query->have_posts() && $i < 3): $query->the_post();
                if ( $page == 'staff' || $page == 'taxonomy' || $page == 'multimedia' || $page == 'category') {
                    get_template_part('template-parts/content', 'publication');
                } else {
                    get_template_part('template-parts/content', 'archive');
                }
                $i++;
            endwhile;
            wp_reset_query();
            $html = ob_get_clean();
            send_origin_headers();
            @header( 'Content-Type: text/json; charset=' . get_option( 'blog_charset' ) );
            wp_send_json_success([
                'html' => $html,
                'page' => $page,
                'setting' => $settings,
                'next_available' => $next
            ]);
        } else {
            wp_send_json_error([
                'reason' => 'nomore'
            ]);
        }
    }
    die;
}
add_action('wp_ajax_alabama_policy_institute_readmore_ajax', 'alabama_policy_institute_readmore_ajax' );
add_action('wp_ajax_nopriv_alabama_policy_institute_readmore_ajax', 'alabama_policy_institute_readmore_ajax' );

