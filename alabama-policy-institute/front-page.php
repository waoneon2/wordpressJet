<?php
/**
 * The front page template file
 *
 */
get_header();
?>
<main>
	<section class="hero hero--home hero--full"><img class="featured-img" src="<?php echo get_theme_mod('homepage_hero_image', get_template_directory_uri() . '/img/backgrounds/bg--home-hero.jpg');?>">
		<div class="container">
			<div class="hero__content">
				<div class="hero__logo">
					<img src="<?php echo get_theme_mod('homepage_hero_logo',get_template_directory_uri() . '/img/brandmarks/logo--hero.png');?>" alt="">
				</div>
				<div class="hero__text">
					<h2><?php echo get_theme_mod('homepage_hero_title1','<b>Strengthening</b> Free Enterprise');?></h2>
					<h2><?php echo get_theme_mod('homepage_hero_title2','<b>Defending</b> Limited Government');?></h2>
					<h2><?php echo get_theme_mod('homepage_hero_title2','<b>Championing</b> Strong Families');?></h2>
				</div>
			</div>
			<button type="button" name="button" class="btn btn--play-video" ><?php echo get_theme_mod('hero_vid_button','PLAY VIDEO');?><svg class="btn__icon" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22"><path fill="#fff" d="M11 0a11.01 11.01 0 0 0 0 22 11.01 11.01 0 0 0 0-22zm5.71 11.3l-8.07 5.5a.37.37 0 0 1-.38.02.36.36 0 0 1-.19-.32v-11c0-.14.07-.26.19-.32a.37.37 0 0 1 .38.02l8.07 5.5a.37.37 0 0 1 0 .6z"/></svg></button>


			<button type="button" name="button" class="btn btn--scroll-down">VIEW SITE <img class="btn__icon" src="<?php echo get_template_directory_uri() ?>/img/icons/ico--arrow--down--white.png" alt=""></button>
		</div>
	</section>
	<section>
		<div class="container">
			<h3><?php _e('Recent Content', 'alabama-policy-institute'); ?></h3>
			<?php $query = new WP_Query([
				'posts_per_page' 	  => 4,
				'ignore_sticky_posts' => 1,
				'post_type'		 	  => 'post'
			]);
            $i = 0;
            $showMore = count($query->posts) > 3;
            ?>
			<div class="content__wrapper">
			<?php
			if ($query->have_posts()):
				while ($query->have_posts() && $i < 3): $query->the_post();
					get_template_part('template-parts/content', 'archive');
                    $i++;
				endwhile;
				?>
                <?php if ($showMore): ?>
				<button type="button" name="button" class="btn btn--red btn--decoration btn--large btn--center btn--show-more" data-page="frontpage"><?php _e('SHOW MORE', 'alabama-policy-institute'); ?><img src="<?php echo get_template_directory_uri() ?>/img/icons/ico--arrow--down--red.png" alt="" class="btn__icon"></button>
                <?php endif; ?>
				<?php
			else:
				get_template_part( 'template-parts/content', 'none' );
			endif;
			wp_reset_postdata();
			?>
			</div>
		</div>
	</section>
    <section class="cta__section">
    <div class="container">
        <div class="cta__wrapper">
            <div class="cta__box" style="background-image: url(<?php echo get_theme_mod('homepage_image_cta1', get_template_directory_uri() . '/img/pics/HP_DailyClippings.jpg')?>)">
                <div class="cta__inner">
                    <div class="cta__content">
                        <h3 class="cta__title"><?php echo get_theme_mod('homepage_title_cta1','DAILY CLIPPINGS');?></h3>
                        <div class="cta__text"><p><?php echo get_theme_mod('homepage_content_cta1','Insert Text');?></p></div>
                    </div>
                    <a href="#" class="btn cta__btn"><?php echo get_theme_mod('homepage_button_cta1','VIEW THE LATEST');?><svg class="btn__icon" xmlns="http://www.w3.org/2000/svg" width="7" height="12" viewBox="0 0 7 12"><path fill="#fff" d="M6.78 7.03l-4.52 4.71c-.29.3-.76.3-1.05 0a.78.78 0 0 1 0-1.08l4.01-4.18-4.01-4.17a.81.81 0 0 1 0-1.09c.29-.3.76-.3 1.05 0l4.52 4.72c.15.15.22.35.22.54 0 .2-.07.4-.22.55z"/></svg></a>
                </div>
            </div>
            <div class="cta__box" style="background-image: url(<?php echo get_theme_mod('homepage_image_cta2', get_template_directory_uri() . '/img/pics/HP_Audience.jpg')?>)">
                <div class="cta__inner">
                    <div class="cta__content">
                        <h3 class="cta__title"><?php echo get_theme_mod('homepage_title_cta2','EVENTS');?></h3>
                        <div class="cta__text"><p><?php echo get_theme_mod('homepage_content_cta2','Insert Text');?></p></div>
                    </div>
                    <a href="#" class="btn cta__btn"><?php echo get_theme_mod('homepage_button_cta2','VIEW ALL EVENTS');?><svg class="btn__icon" xmlns="http://www.w3.org/2000/svg" width="7" height="12" viewBox="0 0 7 12"><path fill="#fff" d="M6.78 7.03l-4.52 4.71c-.29.3-.76.3-1.05 0a.78.78 0 0 1 0-1.08l4.01-4.18-4.01-4.17a.81.81 0 0 1 0-1.09c.29-.3.76-.3 1.05 0l4.52 4.72c.15.15.22.35.22.54 0 .2-.07.4-.22.55z"/></svg></a>
                </div>
            </div>
            <div class="cta__box" style="background-image: url(<?php echo get_theme_mod('homepage_image_cta3', get_template_directory_uri() . '/img/pics/Download_Image.jpg')?>)">
                <div class="cta__inner">
                    <div class="cta__content">
                        <h3 class="cta__title"><?php echo get_theme_mod('homepage_title_cta3','DOWNLOAD');?></h3>
                        <div class="cta__text"><p><?php echo get_theme_mod('homepage_content_cta3','Insert Text');?></p></div>
                    </div>
                    <a href="#" class="btn cta__btn"><?php echo get_theme_mod('homepage_button_cta3','VIEW ALL DOWNLOADS');?><svg class="btn__icon" xmlns="http://www.w3.org/2000/svg" width="7" height="12" viewBox="0 0 7 12"><path fill="#fff" d="M6.78 7.03l-4.52 4.71c-.29.3-.76.3-1.05 0a.78.78 0 0 1 0-1.08l4.01-4.18-4.01-4.17a.81.81 0 0 1 0-1.09c.29-.3.76-.3 1.05 0l4.52 4.72c.15.15.22.35.22.54 0 .2-.07.4-.22.55z"/></svg></a>
                </div>
            </div>
        </div>
    </div>
    </section>
	<section class="report__section">
		<div class="container report__container">
			<h3><?php _e('RESEARCH', 'alabama-policy-institute'); ?></h3>
			<?php
				$query = new WP_Query([
					'posts_per_page' 	  => 4,
					'ignore_sticky_posts' => 1,
					'post_type'		 	  => 'research'
				]);
			?>
			<div class="report__wrapper">
				<?php
				$full = false;
				if ($query->have_posts()):
					while ($query->have_posts()): $query->the_post();
						if ($full) {
							get_template_part('template-parts/content', 'research-full');
						} else {
							// full content
							get_template_part('template-parts/content', 'research');
						}
						$full = !$full;
					endwhile;
				else:
					get_template_part( 'template-parts/content', 'none' );
				endif;
				wp_reset_postdata();
				?>
			</div>
            <form action="<?php echo get_post_type_archive_link('research'); ?>" method="get">
                <button type="submit" name="button" class="btn btn--red btn--decoration btn--large btn--center btn--view-all">VIEW ALL REPORTS<svg class="btn__icon" xmlns="http://www.w3.org/2000/svg" width="7" height="12" viewBox="0 0 7 12"><path fill="#a51c30" d="M6.78 7.03l-4.52 4.71c-.29.3-.76.3-1.05 0a.78.78 0 0 1 0-1.08l4.01-4.18-4.01-4.17a.81.81 0 0 1 0-1.09c.29-.3.76-.3 1.05 0l4.52 4.72c.15.15.22.35.22.54 0 .2-.07.4-.22.55z"></path></svg></button>
            </form>
		</div>
	</section>
    <hr>
    <section>
            <div class="container">
                <div class="newsletter-contribute">
                    <div class="newsletter-contribute__wrapper">
                        <h3>Newsletter</h3>
                        <div class="newsletter-contribute__box" style="background-image: url('http://jetty.eresources.id/wp-content/themes/alabama-policy-institute/img/pics/HP_Newsletter_Mailbox.png')">
                            <h5>Sign up to receive weekly API updates</h5>
                            <form class="form form--newsletter" action="" method="get">
                                <input type="email" name="email" placeholder="your email address" class="form__input--text">
                                <button type="submit" class="btn form__submit">SIGN UP</button>

                            </form>
                        </div>
                    </div>

                    <div class="newsletter-contribute__wrapper">
                        <h3>Contribute</h3>
                        <div class="newsletter-contribute__box" style="background-image: url('http://jetty.eresources.id/wp-content/themes/alabama-policy-institute/img/pics/HP_Contribute_Flag.png')">
                            <h5>Help API preserve Free Markets, Limited&nbsp;Government and Strong Families.</h5>
                            <div class="newsletter-contribute__buttons">
                                <a href="#" class="btn newsletter-contribute__btn">$25</a>
                                <a href="#" class="btn newsletter-contribute__btn">$50</a>
                                <a href="#" class="btn newsletter-contribute__btn">Other</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
</main>
<?php get_footer();