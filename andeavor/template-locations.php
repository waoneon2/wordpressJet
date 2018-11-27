<?php
/**
 * Template Name: Locations Page
 */

get_header(); ?>
<style>
    .pagination-count {
        text-align: -webkit-center;
        text-align: center;
    }
</style>
<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <?php
            $cats = (array) get_theme_mod('category_locations');
            //$cat_loc = implode (", ", $cats);
            $bol_cat_loc = false;
            if ($cats[0] == 0) $cats = array_slice($cats, 1);
            
            if($cats){
                $bol_cat_loc = true;
            }
        ?>
        <?php if ($bol_cat_loc): ?>
            <article id="post-tag-template">
                <header class="entry-header">
                    <h1 class="entry-title title-news"><?php _e(get_the_title(),'andeavor'); ?></h1>
                </header><!-- .entry-header -->

                <?php
                foreach ($cats as $key => $cat_ID) {
                    $cat_loc_args = array(
                        'cat'               => (int) $cat_ID,
                        'post_type'         => array('post','attachment'),
                        'post_status'       => array('publish','inherit'),
                        'posts_per_page'    => 10,
                        'nopaging'          => false,
                        'paged'             => get_query_var( 'paged' ),
                    );
                    $loc_category = new WP_Query( $cat_loc_args );
                    $cat_obj = get_category($cat_ID);

                    echo '<div class="content-news">';
                        echo '<h3>'.$cat_obj->name.'</h3>';
                        echo '<p>'.$cat_obj->category_description.'</p>';
                        if ( $loc_category->have_posts() ) :
                            while ( $loc_category->have_posts() ) :
                                $loc_category->the_post(); ?>
                            	<?php $meme_type = explode('/', $loc_category->post->post_mime_type); ?>
                                <?php if (get_post_type() == 'post'): ?>
                                    <p><a href="<?php the_permalink(); ?>"><?php 
                                    	the_title(); 
                                    	echo ' ('.get_the_time('F n').')'; 
                                    ?></a></p>
                                <?php else: ?>
                                   <p class="btn-primary"><a href="<?php echo $loc_category->post->guid; ?>"><?php the_title() ?> (<?php echo $meme_type[1] ?>)</a></p>
                                <?php endif ?>
                            <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                    echo '</div>';

                }
                ?>
            </article>
        <?php else: ?>
            <?php get_template_part( 'template-parts/content', 'none' ); ?>
        <?php endif ?>
    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();