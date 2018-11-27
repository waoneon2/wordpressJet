<?php
/**
 * Template Name: Register Page
 */
get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
            <div>
              <?php
              if ( have_posts() ) : ?>
              <?php
                    /* Start the Loop */
                    while ( have_posts() ) : the_post();
                        /*
                         * Include the Post-Format-specific template for the content.
                         * If you want to override this in a child theme, then include a file
                         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                         */
                        get_template_part( 'template-parts/content', get_post_format() );

                    endwhile;
                    the_posts_navigation();

                else :
                    get_template_part( 'template-parts/content', 'none' );
                endif; ?>
                      <div class="andeavor_gform">
                        <?php
                        if(get_theme_mod('gravity_form') || !empty(get_theme_mod('gravity_form'))){
                            echo gravity_form( $id_or_title = get_theme_mod('gravity_form'), $display_title = false, $display_description = true, $display_inactive = false, $field_values = null, $ajax = true, $tabindex = 1, $echo = true );
                        }
                        ?>
                      </div>
            </div>

    	</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();?>