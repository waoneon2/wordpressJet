<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package chevron
 */ 

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="col col-xs-12 centered width-800 ">

			<?php
			if ( is_singular() ) :
				the_title( '<h1 class="entry-title ">', '</h1>' );

			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif; ?>
		</div>

        <?php 
            if(has_post_thumbnail()) {
                $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
        ?>
        <div class="bg-cover on-single" style="background-image:url(<?php echo $featured_img_url; ?>)"></div>
        <?php
            }
        ?>

	</header><!-- .entry-header -->

	<div class="entry-content">
		<div class="content-basics container-fluid width-1280">
			<div class="col centered width-800">
			<?php
				the_content( sprintf(
					wp_kses(
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'chevron' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				) );

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'chevron' ),
					'after'  => '</div>',
				) );
			?>

			<?php
			if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta footnote">
					<?php chevron_posted_on(); ?>
				</div><!-- .entry-meta -->
			<?php endif; ?>
			</div>
		</div>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<!-- <?php chevron_entry_footer(); ?> -->
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->