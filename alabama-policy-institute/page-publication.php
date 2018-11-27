<?php
/**
 * Template Name: Publication
 */
?>

<?php get_header(); ?>

<?php
    $obj = get_queried_object();
    $current_taxonomy = get_query_var( 'publication' );
    $current_term = get_query_var( 'term' );
    $terms = get_terms($current_taxonomy, array(
        'hide_empty' => false,
    ) );
?>
    <div id="primary" class="content-area">
        <main id="main" class="site-main">
                <section class="featured-img hero hero--small hero--list hero--topic-landing" style="background-image: url('<?php echo get_template_directory_uri() ?>/img/backgrounds/bg-topic-detail--hero.jpg')">
                    <h2 class="hero__heading"><?php _e('Publications', 'alabama-policy-institute'); ?></h2>
                    <p class="hero__sub-heading"><?php echo $obj->description ?></p>
                </section>
                <?php
                    $terms_publication = get_terms('publication', array(
                        'hide_empty' => false,
                    ) );

                    foreach ($terms_publication as $key => $value) {
                        $term_list[] = $value->slug;
                    }

                    $args = array(
                        'post_type' => 'post',
                        'posts_per_page' => 10,
                        'ignore_sticky_posts' => true,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'publication',
                                'field'    => 'slug',
                                'terms'    => $term_list,
                            ),
                        ),
                    );
                    $taxonomy_posts = new WP_Query( $args );
                ?>
                <section >
                    <div class="container">
                        <div class="content__wrapper pub-page-plusone">
                            <?php
                                $i = 0;
                                // var_dump(count($taxonomy_posts->posts));
                                $showMore = count($taxonomy_posts->posts) > 9;
                                if ($taxonomy_posts->have_posts()) {
                                    while ($taxonomy_posts->have_posts() && $i <= 9): $taxonomy_posts->the_post();
                                        $terms_obj = wp_get_post_terms($taxonomy_posts->post->ID, 'publication');
                                        ?>
                                            <article class="content__box page-pub">
                                                <?php
                                                    if ( has_post_thumbnail() ) {
                                                        echo '<div class="content__image">';
                                                        the_post_thumbnail();
                                                        echo '</div>';
                                                    } else {
                                                        echo '<div class="content__image"><img src="';
                                                        echo get_bloginfo('template_directory').'/img/placeholder.jpg"></div>';
                                                    }
                                                ?>
                                                <div class="content__inner">
                                                    <?php the_title( '<h4 class="content__title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' ); ?>
                                                    <p class="content__date"><?php the_time('M j, Y'); ?></p>
                                                    <p class="p-type">
                                                        <?php foreach ($terms_obj as $k => $v): ?>
                                                            <a href="<?php echo get_term_link($v, 'publication') ;?>">,
                                                                <?php echo $v->name ?></a>
                                                        <?php endforeach ?>
                                                    </p>
                                                    <p class="content__text"><?php echo alabama_policy_institute_get_excerpt(350); ?></p>
                                                </div>
                                            </article>
                                        <?php
                                        $i++;
                                    endwhile; ?>
                                    <?php if ($showMore ): ?>
                                        <button type="button" name="button" class="btn btn--red btn--decoration btn--large btn--center btn--show-more2" data-page="publication"><span><?php _e('SHOW MORE', 'alabama-policy-institute'); ?></span><img src="<?php echo get_template_directory_uri() ?>/img/icons/ico--arrow--down--red.png" alt="" class="btn__icon"></button>
                                    <?php endif ?>
                                    <?php
                                    wp_reset_postdata();
                                }
                            ?>
                        </div>

                    </div>
                </section>
                <hr>
                <section>
                    <div class="container">
                        <div class="newsletter-contribute">
                            <div class="newsletter-contribute__wrapper">
                                <h3>Newsletter</h3>
                                <div class="newsletter-contribute__box" style="background-image: url('<?php echo get_template_directory_uri() ?>/img/pics/HP_Newsletter_Mailbox.png')">
                                    <h5>Sign up to receive weekly API updates</h5>
                                    <form class="form form--newsletter" action="" method="get">
                                        <input type="email" name="email" placeholder="your email address" class="form__input--text">
                                        <button type="submit" class="btn form__submit">SIGN UP</button>

                                    </form>
                                </div>
                            </div>

                            <div class="newsletter-contribute__wrapper">
                                <h3>Contribute</h3>
                                <div class="newsletter-contribute__box" style="background-image: url('<?php echo get_template_directory_uri() ?>/img/pics/HP_Contribute_Flag.png')">
                                    <h5>Help API preserve Free Markets, Limited&nbsp;Government and Strong Families.</h5>
                                    <div class="newsletter-contribute__buttons">
                                        <a href="#" class="btn newsletter-contribute__btn">$25</a>
                                        <a href="#" class="btn newsletter-contribute__btn">$50</a>
                                        <a href="#" class="btn newsletter-contribute__btn">Other</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

        </main><!-- #main -->
    </div><!-- #primary -->
<?php get_footer(); ?>