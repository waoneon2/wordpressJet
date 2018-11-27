<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
 
$post_ID = get_the_ID();
$redirect_slug = get_post_custom_values('redirect_slug', $post_ID);
if ($redirect_slug) {
	$redirect_url = home_url($redirect_slug[0]);
	wp_redirect($redirect_url);
	exit;
}

if (($post_ID == 59578) && isset($_GET['_do']) && ($_GET['_do'] == 'ajax')) { firecomps_ajax(); }

get_header(); 

if ($post_ID == 17): 
	get_template_part('content', 'spotlight');
elseif ($post_ID == 101292): 
	get_template_part('content', 'advancedsearch');
else:

$source = trim( get_post_meta($post->ID, "banner_image", true) );
$postid = $post->ID;
if(empty($source)) {
	$source = trim( get_post_meta(get_top_parent_page_id(), "banner_image", true) );
	$postid = get_top_parent_page_id();
}

if( !empty( $source ) ) :?>
	<div class="category-header" style="background-image: url('<?php the_field('banner_image', $postid);  ?>');">
<?php else :?>
  	<div class="category-header" style="background-image: url('/wp-content/uploads/2014/02/default-banner.jpg');">
<?php endif; ?>
	
	<div class="wrapper clearfix">
        <h1 class="category-title"><?php echo get_the_title(); ?></h1>

    </div></div>
    
<div class="category-header gradient">
    <div class="wrapper clearfix">
        <h1 class="category-title"><?php echo get_the_title(); ?></h1>
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
			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<span class="entry-header">
						<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
						<div class="entry-thumbnail">
							<?php the_post_thumbnail('full'); ?>
						</div>
						<?php endif; ?>
					</span><!-- .entry-header -->

					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
					</div><!-- .entry-content -->

					<footer class="entry-meta">
						<?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
					</footer><!-- .entry-meta -->
				</article><!-- #post -->

				<?php //comments_template(); ?>
			<?php endwhile; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
	<div class="support clearfix">
    	<p>Help FIRE protect the speech rights of students and faculty.</p>
        <a href="<?php echo home_url( '/donate' ); ?>">Support FIRE</a>
    </div>
</div>
<?php endif; ?>
<?php get_footer(); ?>