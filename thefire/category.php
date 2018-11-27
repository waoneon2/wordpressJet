<?php
/**
 * The template for displaying Category pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>
	<?php 
	global $wp_query; 
	$cat_ID = get_query_var('cat');
	//$the_banner = /?cat=<?php the_field('banner_image');
	$details = get_field('banner_image', 'category_'. $cat_ID .''); 
	
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
		<?php if ( have_posts() ) : ?>
			<?php /* The loop */ ?>
            <ul class="posts-list">
					<?php while ( have_posts() ) : the_post(); ?>

					    <?php get_template_part('content', 'media_coverage'); ?>

					<?php endwhile; ?>
            </ul>
			<?php twentythirteen_paging_nav(); ?>

		<?php else : ?>
			<?php //get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->
    <?php get_sidebar(); ?>
</div>
    <?php endif; ?>
<?php get_footer(); ?>