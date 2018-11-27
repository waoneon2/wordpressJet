<?php
/**
 * Template Name: Businesses
 */
get_header(); ?>

<div class="content">

    <!-- Businesses page wide content, a center version -->
    <div class="contained two-column section-top section-bottom">
        <?php
        while ( have_posts() ) : the_post();
          get_template_part( 'template-parts/content', 'page' );
        endwhile; // End of the loop. ?>
    </div>

    <?php
        if (is_active_sidebar('jetty-businesses-page')) {
        dynamic_sidebar('jetty-businesses-page');
        } ?>

    </div>

    <?php
        $services = array();
        for ($i=1; $i <=4 ; $i++) {
            $services[$i]=get_theme_mod('business_services'.$i);
            $servicestext[$i]=get_theme_mod('business_services_text'.$i);
        }
    ?>
    <div class="contained section-top orange-test">
        <div class="row text-center">
            <div class="col-xs-12">
                <h2>Services</h2>
            </div>
        </div>
        <div class="row teaser-grid">
        <?php
            $posts = new WP_Query(array('post__in' => array_values($services), 'post_type' => 'page'));
            $j = 1;
            if ($posts->have_posts()) {
                while ($posts->have_posts()): $posts->the_post();
                    $postexc = get_the_excerpt();
                    $linktext = ($servicestext[$j]) ? $servicestext[$j] : 'Detail';
                    ?>
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="teaser-box">
                            <h3><?php the_title(); ?></h3>
                            <p><?php echo $postexc; ?></p>
                            <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo $linktext; ?></a>
                        </div>
                    </div>
                    <?php
                $j++;
                endwhile; wp_reset_postdata();
            }
        ?>
        </div>
    </div>

</div>
<?php
get_footer();
