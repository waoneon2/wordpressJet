<?php
/**
 * Template for press release archives category
 */

get_header(); ?>
<?php
global $wp_query;
$cat_ID = get_query_var('cat');
//$the_banner = /?cat=<?php the_field('banner_image');
$details = get_field('banner_image', 'category_'. $cat_ID .'');
$limit = isset($_GET['limit']) ? sanitize_text_field($_GET['limit']) : null;

if(empty($details)) {
    $details = get_field('banner_image', 'category_'. get_top_parent_category($cat_ID) .'');
}

function get_top_parent_category($cat_ID){
    $cat = get_category( $cat_ID );
    $new_cat_id = $cat->category_parent;

    if($new_cat_id != "0"){
        return (get_top_parent_category($new_cat_id));
    }
    return $cat_ID;
}

if ($cat_ID == 530):
    //get_template_part('content', 'cases');
else: ?>

    <div class="category-header" style="background-image: url('<?php
    /* KELL Changed url for default image from :default-banner.jpg  */
    if(!empty($details)) { echo $details; } else { echo '/wp-content/uploads/2014/02/default-banner.jpg'; }

    ?>');">
        <div class="wrapper clearfix">
            <h1 class="category-title"><?php echo single_cat_title( '', false ); ?></h1>
        </div>
    </div>
    <div class="category-header gradient">
        <div class="wrapper clearfix">
            <h1 class="category-title"><?php echo single_cat_title( '', false ); ?> <?php echo (is_year())?  the_time('Y') : '' ?></h1>
        </div>
    </div>
    <div class="wrapper clearfix">
        <div id="primary" class="content-area">
            <div id="content" class="site-content" role="main">
                <?php
				/*
                if((isset($limit)) && (null !== $limit) && ("all" === $limit)){
                    query_posts('cat=' . $cat_ID . '&amp;year='. get_the_time('Y') . '&posts_per_page=-1');
               	}
                 
				if ( have_posts() ) : ?>
                    <?php /* The loop  ?>
                    <ul class="posts-list">
                        <?php while ( have_posts() ) : the_post(); ?>

                            <?php get_template_part('content', 'media_coverage'); ?>

                        <?php endwhile; ?>
                    </ul>
                    <?php //ww_paging_nav_view_all(); ?>

                <?php else : ?>
                    <?php //get_template_part( 'content', 'none' ); ?>
                <?php endif; */?>
                
                <?php

					$current_year = get_the_time('Y');

					$press_release_args = array(
							'tax_query' => array(
									array(
										'taxonomy' => 'category',
										'field' => 'id',
										'terms' => $cat_ID
									)
							),
							'date_query' => array(
									array(
										'year'  => $current_year
									),
							),

						'posts_per_page' => -1
					);

					$press_release_query = new WP_Query( $press_release_args );


					if($press_release_query->have_posts()): ?>
						<b><?php echo $monthName; ?></b>
						<br><br>
						<section class="posts-list">
							<ul class="no-style">
								<?php while ( $press_release_query->have_posts() ) : $press_release_query->the_post(); ?>
									<?php get_template_part('content', 'media_coverage'); ?>
								<?php endwhile; ?>
							</ul>
						</section>
						<?php
						wp_reset_query();
					endif;


				?>

            </div><!-- #content -->
        </div><!-- #primary -->
        <?php get_sidebar(); ?>
    </div>
<?php endif; ?>
<?php get_footer(); ?>