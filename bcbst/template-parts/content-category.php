<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package bcbst
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="page-header">
		<?php if ( 'post' === get_post_type() ) : ?>
				<?php endif; ?>
				<?php the_title( sprintf( '<h2><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

				<?php if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta">
					<?php bcbst_posted_on(); ?>
				</div><!-- .entry-meta -->
				<?php endif; ?>

				<div class="entry-content">
					<?php the_excerpt(); ?>
				</div>

	</header><!-- .entry-header -->

</article><!-- #post-## -->
