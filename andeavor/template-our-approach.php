<?php
/**
 * Template Name: Our Approach Page
 */
 
get_header(); 
$cat_approach = (int) get_theme_mod('category_our_approach'); ?>
<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <article id="post-tag-template">
			<header class="entry-header">
				<h1 class="entry-title title-news"><?php _e(get_the_title(),'andeavor'); ?></h1>
				<?php echo category_description($cat_approach); ?> 
			</header><!-- .entry-header -->
			<?php 
				$bol_cat_approach = false;
				if($cat_approach){
					$bol_cat_approach = true;
					$cat_approach_args = array(
					    'cat' 				=> $cat_approach,
					    'post_type' 		=> array('post','attachment'),
					    'post_status' 		=> 'publish',
					    'posts_per_page' 	=> 10,
					    'nopaging' 			=> false,
					    'paged'          => get_query_var( 'paged' ),
					);
					$approach_category = new WP_Query( $cat_approach_args );
				}
			?>

			<?php if ($bol_cat_approach): ?>
				<div class="content-approach">
					<?php
						if ( $approach_category->have_posts() ) :
							while ( $approach_category->have_posts() ) :
								$approach_category->the_post();
				    			?>
							    <a href="<?php the_permalink(); ?>" class="content-box">
							        <h3><?php the_title();?></h3>
							    </a>
							    <?php the_content() ?>
							<?php
							endwhile;
						endif;
					?>
				</div>
				<div class="button-approach">
					<?php if (get_theme_mod('button_text_our_approach')): ?>
						<p class="btn-primary"><a href="<?php echo get_theme_mod('link_our_approach') ?>"><?php echo get_theme_mod('button_text_our_approach') ?></a></p>
					<?php endif ?>
				</div>
			<?php else: ?>
				<?php get_template_part( 'template-parts/content', 'none' ); ?>
			<?php endif ?>
			
			
		</article>
    </main><!-- #main -->
</div><!-- #primary -->
 
<?php
get_footer();