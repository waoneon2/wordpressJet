<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Woodstone_Oven
 */

?>
<?php $content = get_the_content(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	 <div class="<?php if (has_shortcode( $content, 'configurator' )) {echo '';} else {echo 'container';} ?>">
			<header class="entry-header" style="">
				<div class="alert alert-light" role="alert"> 
					 <?php //the_title( '<h5 class="entry-title" style="margin-left: 95px; ">', '</h5>' ); ?>
					 <?php  
					 		if (has_shortcode( $content, 'configurator' )) 
					 		{
					 			the_title( '<h5 class="entry-title pad-95">', '</h5>' );
					 		} 
					 		else 
					 		{
					 			the_title( '<h5 class="entry-title">', '</h5>' );
					 		}
					 ?>
				</div>
			</header><!-- .entry-header -->

			
				
					<?php wso_post_thumbnail(); ?>

					<div class="entry-content">
						<?php
						the_content();

						wp_link_pages( array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wso' ),
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
										__( 'Edit <span class="screen-reader-text">%s</span>', 'wso' ),
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
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
