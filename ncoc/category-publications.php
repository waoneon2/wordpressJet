<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package NCOC
 */

get_header('publication'); ?>
    <div id="primary archive-pub" class="content-area col-md-6">
        <main id="main" class="site-main" role="main">

        <?php
        if ( have_posts() ) : ?>

            <header class="page-header-publication">
              <h1 class="page-title" id="ncoc-publication-page-title"><?php _e('Publications', 'ncoc'); ?></h1>
            </header><!-- .page-header -->

            <?php
            echo "<div class='row-of-pub'>";
            /* Start the Loop */
            while ( have_posts() ) : the_post();

                get_template_part( 'template-parts/content', 'publications');

            endwhile;
            echo "</div>";


        else :

            get_template_part( 'template-parts/content', 'none' );

        endif; ?>


        </main><!-- #main -->
    </div><!-- #primary -->
    <div class="col-md-6 update-sidebar" id="col-of-update-sidebar">
    	<main id="main" class="site-main" role="main">
    		<header class="page-header-publication">
              <h1 class="page-title" id="ncoc-publication-page-title"><?php _e('News and Events', 'ncoc'); ?></h1>
            </header><!-- .page-header -->
            <div class="col-md-3">
            <?php
            $img_news = get_template_directory_uri(). "/images/news.jpg";
            if(get_theme_mod("ncoc_li_news_img")):
            $img_news = get_theme_mod("ncoc_li_news_img");
            endif;
            _e('<img class="img-responsive img-thumbnail icon-link" src="'.esc_url($img_news).'"/>','ncoc_link');
            ?>
            </div>
            <div class="col-md-9">
            <?php
            $text_news = "Click here to the recent news and events.";
            if(get_theme_mod("ncoc_li_news_text")):
                $text_news = get_theme_mod("ncoc_li_news_text");
            endif;
            printf(__("<a class='news-link-update' href=%s><p>".$text_news."</p></a>","ncoc_link"),get_cat_url( 'News and Events' ));
            ?>
            </div>
    	</main>

    	<main id="main" class="site-main" role="main">
    		<header class="page-header-contact">
              <h1 class="page-title" id="ncoc-publication-page-title"><?php _e('Media Team', 'ncoc'); ?></h1>
            </header><!-- .page-header -->
            <div class="col-md-3">
            <?php
            $img_contact = get_template_directory_uri(). "/images/contact.jpg";
            if(get_theme_mod("ncoc_li_contact_img")):
            $img_contact = get_theme_mod("ncoc_li_contact_img");
            endif;
            _e('<img class="img-responsive img-thumbnail icon-link" src="'.esc_url($img_contact).'"/>','ncoc_link');
            ?>
            </div>
            <div class="col-md-9">
            <?php
            $text_contact = "Click here to the recent contact.";
			if(get_theme_mod("ncoc_li_contact_text")):
                $text_contact = get_theme_mod("ncoc_li_contact_text");
            endif;
			printf(__("<a class='news-link-update' href=%s><p>".$text_contact."</p></a>","ncoc_link"),get_cat_url( 'Contacts' ));
            ?>
            </div>
    	</main>
    </div>
  </div><!-- #content -->
  </div><!-- #col-of-content -->
  </div> <!-- .row -->

<?php
get_footer();