<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package p66
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header entry-header-margin">
		<?php
		if ( is_singular() ) :
			echo '<h1 class="entry-title">'.strip_tags(get_the_title()).'</h1>';
		else :
			echo '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">'.strip_tags(get_the_title()).'</a></h2>';
		endif;?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_content( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. */
					__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'p66' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'p66' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="story-info row">
		<div class="tag">
			<!-- <span class="dashicons dashicons-tag"></span> -->
			<?php p66_entry_footer(); ?>
		</div>
		<div class="publish">
			<?php
				if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta">
					<?php p66_posted_on(); ?>
				</div><!-- .entry-meta -->
				<?php
				endif;
			?>
		</div>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->

