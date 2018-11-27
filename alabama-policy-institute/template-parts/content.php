<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Alabama_Policy_Institute
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
			$background = '';
            if(has_post_thumbnail()) {
            	$background .= ' style="background-image:url('. get_the_post_thumbnail_url(get_the_ID(), 'alpi-full-width') .')"';
            }
        ?>
        <section class="hero hero--detail hero--full featured-img"<?php echo $background; ?>>
        <div class="container">
	        <div class="detail__heading">
	        	<p class="detail__pre-title">
					<?php the_category(', ') ?>
				</p>

				<?php
				if ( is_singular() ) :
					the_title( '<h2 class="entry-title detail__title">', '</h2>' );
				else :
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				endif;

				if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta detail__info">
					<?php alabama_policy_institute_posted_on(); ?>
				</div><!-- .entry-meta -->
				<?php
				endif; ?>

				<p class="detail__description">
					<?php
						$my_excerpt = get_the_excerpt();
						echo $my_excerpt;
					?>
				</p>

			</div>
		</div>
		</section>
	</header><!-- .entry-header -->

	<div class="entry-content detail__wrapper">
		<div class="container detail__container">
			<ul class="detail__socials share-this">
				<li class="share-this__item facebook"><a class="share-this__link" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url(get_the_permalink()); ?>" onclick="window.open(this.href, 'facebook-share','width=580,height=296');return false;">
					<svg class="share-this__icon" xmlns="http://www.w3.org/2000/svg" width="11" height="22" viewBox="0 0 11 22"><path fill="#00356b" d="M10.98.16v3.51s-2.53-.26-3.17.74c-.34.54-.14 2.13-.17 3.27H11c-.29 1.34-.49 2.24-.7 3.4H7.62V22H2.97V11.12H1V7.68h1.96c.1-2.51.14-5 1.36-6.27C5.68-.02 6.98.16 10.98.16z"></path></svg>
					<?php _e('Share', 'alabama-policy-institute'); ?></a>
				</li>
				<li class="share-this__item twitter"><a class="share-this__link" href="https://twitter.com/intent/tweet?text=<?php echo esc_attr(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8'))); ?>&amp;url=<?php echo esc_url(get_the_permalink()); ?>" onclick="window.open(this.href, 'twitter-share', 'width=550,height=235');return false;">
					<svg class="share-this__icon" xmlns="http://www.w3.org/2000/svg" width="23" height="19" viewBox="0 0 23 19"><path fill="#00356b" d="M22.01 3.19c-.1.82-1.25 1.64-1.94 2.26C20.76 15.9 9.31 22.4 1 17.12c2.33.02 4.95-.64 6.34-2-2.02-.35-3.44-1.3-4-3.15.6-.05 1.42.14 1.82-.12-1.85-.73-3.3-1.85-3.4-4.4.66.08 1 .48 1.82.38-1.19-.79-2.55-3.8-1.33-6.02 2.16 2.48 4.87 4.41 9.1 4.77-1.06-4.62 4.85-7.47 7.5-4.14 1.04-.23 1.91-.63 2.8-1-.37 1.04-1.1 1.7-1.82 2.38.78-.15 1.6-.26 2.18-.63z"></path></svg>
					<?php _e('Tweet', 'alabama-policy-institute'); ?></a>
				</li>
				<li class="share-this__item "><a class="share-this__link" href="#">
					<div class="share-this__icon share-this__icon--pdf">
						<img src="<?php echo get_template_directory_uri(); ?>/img/icons/ico--share--pdf.png" alt="">
						<img class="share-this__icon--hover" src="<?php echo get_template_directory_uri(); ?>/img/icons/ico--share--pdf--red.png" alt="">
					</div>
					Pdf</a>
				</li>
				<li class="share-this__item "><a class="share-this__link" href="#">
					<div class="share-this__icon share-this__icon--print">
						<img src="<?php echo get_template_directory_uri(); ?>/img/icons/ico--share--printer.png" alt="">
						<img class="share-this__icon--hover" src="<?php echo get_template_directory_uri(); ?>/img/icons/ico--share--printer--red.png" alt="">
					</div>
					Print</a>
				</li>
			</ul>
			<div class="detail__content">
				<?php
					the_content( sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'alabama-policy-institute' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					) );

					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'alabama-policy-institute' ),
						'after'  => '</div>',
					) );
				?>
			</div>
		</div>
	</div><!-- .entry-content -->
	<hr>

	<footer class="entry-footer">
		<!-- <?php alabama_policy_institute_entry_footer(); ?> -->
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
