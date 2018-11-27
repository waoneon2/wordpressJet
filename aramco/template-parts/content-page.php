<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package aramco
 */

?>
<div class="card-wrapper section">
<div class="contentHeader">
	<div class="contentTitle">
		<div class="title"><?php the_title( '<h1 class="entry-title-out">', '</h1>' ) ?></div>
	</div>
	<div class="socialMediaToolkit"></div>
</div>

		<?php 
		if ( has_post_thumbnail() ) {	
			?>
		<div class="parsys hero">
			<div class="hero section">
				<div class="heroBanner">
			<?php the_post_thumbnail('full'); ?>
				</div>
			</div>
		</div>
		<?php
		}
		?>
<div class="card whiteTheme">	
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'aramco' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'aramco' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-## -->
</div>
</div>