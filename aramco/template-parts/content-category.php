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
    <div class="entry-meta category">
			<?php the_category( ', ' ); ?>
		</div><!-- .entry-meta -->
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
			// the_content( sprintf(
			// 	/* translators: %s: Name of current post. */
			// 	wp_kses( __( 'Read more %s', 'aramco' ), array( 'span' => array( 'class' => array() ) ) ),
			// 	the_title( '<span class="screen-reader-text">"', '"</span>', false )
			// ) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'aramco' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php //aramco_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
</div>
</div>