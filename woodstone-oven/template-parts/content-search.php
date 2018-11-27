<?php
/**
 * Template part for displaying results in search pages
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
						<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

						<?php if ( 'post' === get_post_type() ) : ?>
						<div class="entry-meta">
							<?php
							wso_posted_on();
							wso_posted_by();
							?>
						</div><!-- .entry-meta -->
						<?php endif; ?>
					</header><!-- .entry-header -->	
				</div>

				<div class="card-body">
					<?php wso_post_thumbnail(); ?>
					<div class="entry-summary">
						<?php the_excerpt(); ?>
					</div><!-- .entry-summary -->
				</div>

				<div class="card-footer">
					<footer class="entry-footer">
						<?php wso_entry_footer(); ?>
					</footer><!-- .entry-footer -->
				</div>
			</div>
		
	</article><!-- #post-<?php the_ID(); ?> -->

