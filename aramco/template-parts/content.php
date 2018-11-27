<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package aramco
 */

?>

<div class="card-wrapper section">
<div class="card whiteTheme">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta category">
			<?php the_category( ' ' ); ?>
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
    		<?php 
			if(is_search()){
				the_post_thumbnail('thumbnail');
			} else {
				the_post_thumbnail();
			}
			 ?>
			</a>
			</div>
			<?php 
			} ?>
   
	<div class="entry-content">
	<?php 
	if(is_search()){
		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta category">
			<?php the_category( ' ' ); ?>
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
	<?php } ?>
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