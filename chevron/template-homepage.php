<?php
/**
 * Template Name: Homepage
 */
get_header(); ?>

    <div id="primary" class="homepage bg-offwhite">
        <main id="main" class="site-main container width-1280" role="main">

        <div id="home" class="content has-bg home">
            <div class="row">
                <div class="col-md-8 box">

                    <?php
                    $carID = get_theme_mod('front_category_dropdown_3');

                    if ($carID) {
                        $args = array(
                            'post_type' => 'post',
                            'posts_per_page' => 3,
                            'cat' => $carID,
                        );
                        $the_query = new WP_Query( $args );
                        if ( $the_query->have_posts() )
                        {
                            echo '<ul>';
                            while ( $the_query->have_posts() )
                            {
                                $the_query->the_post();
                                echo '<li class="' . implode(' ', get_post_class(['box-content', 'box-shadow'])) . '">';
                                the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                                echo '<div>' . get_the_excerpt().'</div>';
                                echo '</li>';
                            }
                            echo '</ul>';
                            /* Restore original Post Data */
                            wp_reset_postdata();
                        } else {
                        // no posts found
                        }
                    }
                ?>

                </div>

                <div class="col-md-4 box lts-right">
                    <?php get_sidebar();?>
                </div>
            </div>
        </div>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php get_footer(); ?>
