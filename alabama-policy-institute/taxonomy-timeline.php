<?php
/**
 * Template Name: Taxonomy Timeline
 */
?>

<?php get_header(); ?>
<div id="primary" class="content-area">
	<main>
		<section class="featured-img hero hero--small hero--timeline" style="background-image: url('<?php echo get_template_directory_uri() ?>/img/backgrounds/bg--timeline--hero.jpg')">
			<h2 class="hero__heading">Timeline</h2>
		</section>
		<section>
			<h1 class="timeline__heading">Alabama Policy Network Timeline</h1>
		</section>
		<section>
			<div class="container">
				<div class="timeline-slider">
					<input type="hidden" class="range-slider" />
				</div>
				<div class="timeline-range-mobile">
					<input type="text" name="" value="">
					<input type="text" name="" value="">
					<input type="submit" value="Go">
					<p>Enter Two Years above</p>
				</div>
				<ol class="timeline">
					<li class="timeline__item">
						<div class="timeline__img"><a href="#">
							<img src="<?php echo get_template_directory_uri() ?>/img/pics/timeline--1.jpg">
							<time class="timeline__date">Jan 28</time></a>
						</div>
						<h2 class="timeline__title"><a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eius-</a></h2>
						<p class="timeline__content">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in rep</p>
					</li>
					<li class="timeline__item">
						<div class="timeline__img"><a href="#">
							<img src="<?php echo get_template_directory_uri() ?>/img/pics/timeline--2.jpg">
							<time class="timeline__date">MAR 7</time></a>
						</div>
						<h2 class="timeline__title"><a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eius-</a></h2>
						<p class="timeline__content">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in rep</p>
					</li>
					<li class="timeline__item">
						<div class="timeline__img"><a href="#">
							<img src="<?php echo get_template_directory_uri() ?>/img/pics/timeline--3.jpg">
							<time class="timeline__date">APR 16</time></a>
						</div>
						<h2 class="timeline__title"><a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eius-</a></h2>
						<p class="timeline__content">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in rep</p>
					</li>
					<li class="timeline__item">
						<div class="timeline__img"><a href="#">
							<img src="<?php echo get_template_directory_uri() ?>/img/pics/timeline--4.jpg">
							<time class="timeline__date">Jul 4</time></a>
						</div>
						<h2 class="timeline__title"><a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eius-</a></h2>
						<p class="timeline__content">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in rep</p>
					</li>
					<li class="timeline__item">
						<div class="timeline__img"><a href="#">
							<img src="<?php echo get_template_directory_uri() ?>/img/pics/timeline--3.jpg">
							<time class="timeline__date">SEP 22</time></a>
						</div>
						<h2 class="timeline__title"><a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eius-</a></h2>
						<p class="timeline__content">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in rep</p>
					</li>
					<li class="timeline__item">
						<div class="timeline__img"><a href="#">
							<img src="<?php echo get_template_directory_uri() ?>/img/pics/timeline--5.jpg">
							<time class="timeline__date">NOV 14</time></a>
						</div>
						<h2 class="timeline__title"><a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eius-</a></h2>
						<p class="timeline__content">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in rep</p>
					</li>
				</ol>
			</div>
		</section>
		<hr>
		<section>
			<div class="container">
				<div class="newsletter-contribute">
					<div class="newsletter-contribute__wrapper">
						<h3>Newsletter</h3>
						<div class="newsletter-contribute__box" style="background-image: url('<?php echo get_template_directory_uri() ?>/img/pics/HP_Newsletter_Mailbox.png')">
							<h5>Sign up to receive weekly API updates</h5>
							<form class="form form--newsletter" action="" method="get">
								<input type="email" name="email" placeholder="your email address" class="form__input--text">
								<button type="submit" class="btn form__submit">SIGN UP</button>

							</form>
						</div>
					</div>

					<div class="newsletter-contribute__wrapper">
						<h3>Contribute</h3>
						<div class="newsletter-contribute__box" style="background-image: url('<?php echo get_template_directory_uri() ?>/img/pics/HP_Contribute_Flag.png')">
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
	
</div>
<?php get_footer();
