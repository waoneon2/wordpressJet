<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package aramco
 */
// grab the URL for the category image
function grab_image_category(){
	global $wp_query;
	$cat_obj = $wp_query->get_queried_object();
			if($cat_obj){
				$current_category = $cat_obj->slug;
				$args = array(
						'post_status' => 'inherit',
						'post_type'=> 'attachment',
						'posts_per_page' => 1,
						'orderby' => 'modified',
						'category_name' => $current_category,
				);
				$queryimg = new WP_Query( $args );
			}
	wp_reset_postdata();
	return $queryimg;
}
get_header(); ?>
<div class="contentWraper">
<div class="breadcrumbs">
<?php custom_breadcrumbs() ?>
</div>
	<div class="hubTemplate">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>
			<header class="page-header" style="display:none">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->
			<div class="contentHeader">
				<div class="contentTitle">
					<div class="title"><?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?></div>
				</div>
				<div class="socialMediaToolkit"></div>
			</div>
			<?php if(!empty(grab_image_category()->post)) : ?>
				<?php if (grab_image_category()->post->guid) : ?>
					<div class="parsys hero">
						<div class="hero section">
							<div class="heroBanner">
							<div class="categoryDescription">
								<h1><?php echo wp_strip_all_tags( category_description() );?></h1>
							</div>
							<img src="<?php echo grab_image_category()->post->guid; ?>" alt="<?php single_cat_title();?>" desc="<?php echo wp_strip_all_tags( category_description() );?>"/>
							</div>
						</div>
					</div>
				<?php endif; ?>
			<?php endif; ?>
			<div class="searchSection"></div>
			<div id="cardContainerArchive" data-columns>
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'category' );

			endwhile;
			?>
			</div>
			<?php

			// the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
