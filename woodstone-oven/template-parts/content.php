<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Woodstone_Oven
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="card">
		<div class="card-header"> 
			<header class="entry-header">
				<?php
				if ( is_singular() ) :
					// the_title( '<h4 class="entry-title">', '</h4>' );
					the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' );
				else :
					the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' );
				endif; ?>
			</header><!-- .entry-header -->
		</div>

		<div class="card-body">
			<?php wso_post_thumbnail(); ?>
			<div class="entry-content">
				<?php
				the_content( sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'wso' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				) );

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wso' ),
					'after'  => '</div>',
				) );
				?>
			</div><!-- .entry-content -->
		</div>

		<div class="card-footer">
			<div class="row">
				<div class="col-sm-6">
					 <footer class="entry-footer">
						<?php //wso_entry_footer(); ?>
					</footer><!-- .entry-footer -->
				</div>
				<div class="col-sm-6">
					<div class="float-right">
						<?php if ( 'post' === get_post_type() ) : ?>
						<div class="entry-meta">
							<?php
							wso_posted_on();
							wso_posted_by();
							?>
						</div><!-- .entry-meta -->
						<?php endif; ?> 
					</div>
				</div>
			</div>
		</div>
		
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
