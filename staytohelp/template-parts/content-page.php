<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package staytohelp
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<div class="content has-bg" data-scrollview="true">
		    <div class="content-bg">
		        <?php the_post_thumbnail() ?>
		    </div>
		        <div class="row action-box">
		            <div class="col-md-12 col-sm-12">
		               <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
		            </div>
		        </div>
		</div>
	</header><!-- .entry-header -->

		<div class="entry-content ">
			<?php
				the_content();

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'sth' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->


	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Edit <span class="screen-reader-text">%s</span>', 'sth' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
