<?php
//* Template Name: Thankyou Page
get_header(); ?>
    <div id="frontprimary" class="content-area">
        <main id="frontmain" class="site-main container" role="main">
            <fieldset id="thanks_page">
              <?php while ( have_posts() ) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <h1 class="main-headline"><?php the_title(); ?></h1>
                    <div class="home-subtitle">
                        <?php the_content(); ?>
                    </div>
                    <div class="entry-content">
                        <a href="/" class="to_homepage">CEP Homepage</a>
                        <div class="notice-user">You'll be redirect to the CEP Homepage in <span class="elapsed">15</span> seconds, or you<br />
                            can click the button to be redirected now.
                        </div>
                    </div>
                </article><!-- #post -->
            <?php endwhile; ?>
            </fieldset>
        </main><!-- #main -->
    </div><!-- #primary -->
<?php
get_footer();
