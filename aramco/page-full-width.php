<?php
/**
 * Template Name: Full Width
 * @package aramco
 */

get_header();
$frontpage_id = get_option( 'page_on_front' );
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<div class="parsys hero">
			<div class="hero section">
				<div class="heroBanner">
				<?php echo get_the_post_thumbnail( $frontpage_id, 'full' ); ?>
				<?php
					$content_post = get_post($frontpage_id);
					$content = $content_post->post_content;
					$content = apply_filters('the_content', $content);
					$content = str_replace(']]>', ']]&gt;', $content);
				?>
				<?php
				if( $content !== '') : ?>
				<div class="descFrontPage">
					<?php echo $content; ?>
				</div>
				<?php
				endif; ?>
				</div>
			</div>
		</div>
<div id="cardContainer" data-columns>
<?php
$args = array(
	'posts_per_page'   => -1,
);
$getposts = get_posts($args);
foreach($getposts as $post) :
setup_postdata($post);
?>
<div class="card-wrapper section">
	<div class="card whiteTheme">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<?php
				if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta category">
					<?php the_category( ', ' ); ?>
				</div><!-- .entry-meta -->
				<?php
				endif; ?>
				<?php
				if ( is_single() ) :
					the_title( '<h1 class="entry-title">', '</h1>' );
				else :
					the_title( '<h2 class="entry-title header-title-post"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				endif;
				?>


			</header><!-- .entry-header -->

		   <?php
				if ( has_post_thumbnail() ) {
					?>
					<div class="thumbnail">
					<?php echo "<a href=" .esc_url( get_permalink() ) ." rel='post_link_image' class='post_image_link'>" ?>
		    		<?php the_post_thumbnail(); ?>
					</a>
					</div>
					<?php
					} ?>

			<div class="entry-content">

				<?php
				the_excerpt();

					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'aramco' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->

			<footer class="entry-footer" style="display:none">
				<?php //aramco_entry_footer(); ?>
			</footer><!-- .entry-footer -->
		</article><!-- #post-## -->
	</div>
</div>
<?php endforeach; wp_reset_postdata(); ?>
</div>
	</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_footer();
