<?php
/**
 * The template for displaying Author archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header();

$limit = isset($_GET['limit']) ? sanitize_text_field($_GET['limit']) : null;
$art_limit = isset($_GET['article-limit']) ? sanitize_text_field($_GET['article-limit']) : null;

?>

<div class="category-header" style="background-image: url('/wp-content/uploads/2014/01/default-banner.jpg');">
    <div class="wrapper clearfix">
        <header class="author-header">
             <h1 class="category-title"><?php printf( __( '%s', 'twentythirteen' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h1>
        </header><!-- .author-header -->
    </div>
</div>	
<div class="category-header gradient">
    <div class="wrapper clearfix">
        <header class="author-header">
             <h1 class="category-title"><?php printf( __( '%s', 'twentythirteen' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h1>
        </header><!-- .author-header -->
    </div>
</div>
<div class="wrapper clearfix">
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
            <?php 
			
			if ( function_exists( 'sharing_display' ) ) {
				sharing_display( '', true );
			}
			 
			if ( class_exists( 'Jetpack_Likes' ) ) {
				$custom_likes = new Jetpack_Likes;
				echo $custom_likes->post_likes( '' );
			}
		
			?>
    
            
        <?php if ( get_the_author_meta( 'description' ) ) : ?>
			<?php get_template_part( 'author-bio' ); ?>
		<?php endif; ?>
			
		<?php 
		// Grab posts from the torch category
		$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
		$wp_query = new WP_Query(array(
			'paged' => $paged,
			'posts_per_page' => (isset($limit) ? -1 : 10),
			'post_type' => 'post',
			'author' => get_the_author_meta( 'ID' ),
			'category__in' => array(8,3,534,1,2760,834,532,506,832)
		));
		if ( $wp_query->have_posts() ) : ?>
			<section class="posts-list">
			<?php
				/* Queue the first post, that way we know
				 * what author we're dealing with (if that is the case).
				 *
				 * We reset this later so we can run the loop
				 * properly with a call to rewind_posts().
				 */
				$wp_query->the_post();
			?>

			<?php
				/* Since we called the_post() above, we need to
				 * rewind the loop back to the beginning that way
				 * we can run the loop properly, in full.
				 */
				$wp_query->rewind_posts();
			?>
			
			<h3>Commentary</h3>

			<?php /* The loop */ ?>
			<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>
			
			</section>

        <?php ww_paging_nav_view_all_author(); ?>
		<?php endif; wp_reset_query(); ?>

<?php 
		// Grab posts from the torch category
		$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
		$wp_query = new WP_Query(array(
			'paged' => $paged,
            'posts_per_page' => (isset($art_limit) ? -1 : 10),
			'post_type' => 'post',
			'author' => get_the_author_meta( 'ID' ),
			'category__in' => array(504),
		));
		if ( $wp_query->have_posts() ) : ?>
			<section class="posts-list-ww">
			<?php
				/* Queue the first post, that way we know
				 * what author we're dealing with (if that is the case).
				 *
				 * We reset this later so we can run the loop
				 * properly with a call to rewind_posts().
				 */
				$wp_query->the_post();
			?>

			<?php
				/* Since we called the_post() above, we need to
				 * rewind the loop back to the beginning that way
				 * we can run the loop properly, in full.
				 */
				$wp_query->rewind_posts();
			?>

			<h3>Articles</h3>

			<?php /* The loop */ ?>
			<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
				<?php get_template_part( 'content', 'ww-author' ); ?>
			<?php endwhile; ?>
			
			</section>

			<?php ww_paging_nav_author_articles(); ?>
		<?php endif; wp_reset_query(); ?>


	
		</div><!-- #content -->
	</div><!-- #primary -->
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>