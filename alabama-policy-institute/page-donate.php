<?php
/**
 * Template Name: Donate
 */
?>

<?php get_header(); ?>

<div id="primary" class="content-area">
<main>
	<section class="featured-img hero hero--small hero--donate" style="background-image: url('<?php echo get_template_directory_uri() ?>/img/backgrounds/bg--donate-hero.jpg')">
		<h2 class="hero__heading">Donate</h2>
	</section>
	<section >
		<div class="container">
			<div class="donate">
				<form class="donate__form">
					<fieldset class="donate__fieldset">
						<h3 class="donate__heading"><span class="donate__step">1</span>How would you like to donate?</h3>
						<div class="donate__flex-box">
							<input class="donate__radio" type="radio" name="period" value="one-time" id="one-time">
							<label class="donate__label donate__label--large" for="one-time">
								<svg class="donate__label__img" xmlns="http://www.w3.org/2000/svg" width="52" height="50" viewBox="0 0 52 50"><path fill="#a51c30" d="M50.09 16.54L34.46.92a3.12 3.12 0 0 0-5.2 1.28 14.5 14.5 0 0 1-3.74 6.1c-2.42 2.42-5.57 4.25-8.9 6.18-3.54 2.05-7.2 4.18-10.19 7.17a20.66 20.66 0 0 0-5.3 8.68 3.13 3.13 0 0 0 .78 3.13L17.54 49.1a3.13 3.13 0 0 0 5.2-1.3c.7-2.29 1.93-4.28 3.74-6.1 2.42-2.4 5.57-4.24 8.9-6.17 3.54-2.05 7.2-4.18 10.19-7.17a20.64 20.64 0 0 0 5.3-8.68 3.13 3.13 0 0 0-.78-3.13zM19.75 46.87L4.12 31.25C8.57 16.87 27.82 17.5 32.25 3.12l15.63 15.63c-4.44 14.37-23.7 13.75-28.13 28.12zm11.82-23.59a4.18 4.18 0 0 0-3.09-1.02c-.5.03-1.03.15-1.56.35-.52.2-1.05.43-1.58.69a88.4 88.4 0 0 0-2.52-2.8c.38-.35.74-.52 1.1-.53.35-.02.7.02 1.02.1l.9.2c.29.06.53 0 .75-.18.22-.2.35-.44.37-.75.01-.3-.1-.6-.36-.9-.33-.38-.73-.6-1.2-.7a3.73 3.73 0 0 0-1.46.04 5.48 5.48 0 0 0-2.48 1.35l-.3-.28a.58.58 0 0 0-.42-.16.54.54 0 0 0-.43.21.56.56 0 0 0-.14.45c.01.16.08.29.2.39l.3.26c-.4.48-.73 1.01-.99 1.58a5.25 5.25 0 0 0-.48 1.66c-.06.55 0 1.05.17 1.51.16.47.47.87.93 1.24.73.61 1.6.87 2.6.82 1-.07 2.08-.37 3.24-.99a99.3 99.3 0 0 0 2.77 3.1c-.39.34-.73.53-1.03.59-.3.06-.57.05-.81-.02a2.58 2.58 0 0 1-.68-.32c-.21-.15-.41-.27-.62-.37-.2-.1-.41-.16-.62-.16-.21 0-.44.1-.7.32a1 1 0 0 0-.37.77c0 .29.13.59.4.88.26.3.6.55 1.02.75a3.83 3.83 0 0 0 3.05.1c.58-.2 1.15-.59 1.72-1.16.27.27.55.52.82.77.11.1.26.15.42.13.17 0 .31-.08.43-.22.11-.14.16-.3.15-.45a.54.54 0 0 0-.2-.39c-.28-.22-.55-.45-.82-.7.46-.56.84-1.17 1.12-1.77.27-.6.44-1.18.5-1.72.05-.54-.02-1.02-.2-1.47a3 3 0 0 0-.92-1.2zm-8.74 1.06c-.44.02-.83-.13-1.17-.45-.14-.14-.24-.3-.3-.5-.07-.2-.09-.42-.06-.66.02-.23.09-.48.21-.73a3 3 0 0 1 .5-.73 57 57 0 0 1 2.38 2.54c-.6.33-1.12.51-1.56.53zm7.37 3.13c-.14.26-.3.49-.5.7a64.77 64.77 0 0 1-2.62-2.86l.71-.31c.26-.11.51-.18.76-.22a2 2 0 0 1 .78.03c.25.06.49.2.71.42.22.22.36.45.42.7.06.24.06.5.02.76-.04.26-.14.52-.28.78zM24 34.65a28.4 28.4 0 0 0-2.82 2.43c-.85.85-1.62 1.74-2.28 2.66l-1.07 1.46c-.2.3-.16.71.1.98.3.3.8.3 1.11 0a.7.7 0 0 0 .12-.16l1-1.37c.62-.84 1.33-1.67 2.12-2.46.88-.88 1.7-1.56 2.68-2.3v-.01l.08-.07A.78.78 0 0 0 24 34.65zm5.71-22.6a25.96 25.96 0 0 1-2.8 2.4.8.8 0 0 0 1.1 1.13c.98-.74 1.93-1.54 2.81-2.42.85-.85 1.61-1.74 2.28-2.65l1.07-1.47a.79.79 0 1 0-1.3-.88l-1.03 1.42a21.1 21.1 0 0 1-2.12 2.47z"/></svg>
								One Time
							</label>
							<input class="donate__radio" type="radio" name="period" value="monthly" id="monthly">
							<label class="donate__label donate__label--large" for="monthly">
								<svg class="donate__label__img"  xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50"><path fill="#a51c30" d="M45.83 4.69h-6.77V1.56a1.56 1.56 0 1 0-3.12 0V4.7h-9.38V1.56a1.56 1.56 0 0 0-3.12 0V4.7h-9.38V1.56a1.56 1.56 0 0 0-3.12 0V4.7H4.17A4.17 4.17 0 0 0 0 8.85v36.98C0 48.13 1.86 50 4.17 50h41.66c2.3 0 4.17-1.87 4.17-4.17V8.85c0-2.3-1.87-4.16-4.17-4.16zm1.05 41.14c0 .58-.47 1.05-1.05 1.05H4.17c-.58 0-1.05-.47-1.05-1.05V8.85c0-.57.47-1.04 1.05-1.04h6.77v3.13a1.56 1.56 0 0 0 3.12 0V7.8h9.38v3.13a1.56 1.56 0 0 0 3.12 0V7.8h9.38v3.13a1.56 1.56 0 1 0 3.12 0V7.8h6.77c.58 0 1.05.47 1.05 1.04zM17 23v-4h-6v4zm0 8v-4h-6v4zm0 8v-5h-6v5zm11 0v-5h-6v5zm0-8v-4h-6v4zm0-8v-4h-6v4zm11 16v-5h-6v5zm0-8v-4h-6v4zm0-8v-4h-6v4z"/></svg>
								Monthly
							</label>
							<input class="donate__radio" type="radio" name="period" value="annually" id="annually">
							<label class="donate__label donate__label--large" for="annually">
								<svg class="donate__label__img"  xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50"><path fill="#a51c30" d="M25 0a25 25 0 1 0 0 50 25 25 0 0 0 0-50zm21.73 24.2h-9.67a32.14 32.14 0 0 0-1.85-10.12 26.2 26.2 0 0 0 6.03-3.54 21.66 21.66 0 0 1 5.5 13.65zM24.11 46.72a25.71 25.71 0 0 1-6.58-8.5 24.89 24.89 0 0 1 6.66-1.1v9.6h-.08zm1.78-43.46a26.03 26.03 0 0 1 7.2 9.88c-2.3.79-4.74 1.24-7.28 1.32V3.27h.08zm2.69.28c4.45.74 8.44 2.81 11.55 5.82a24.69 24.69 0 0 1-5.53 3.23 28.37 28.37 0 0 0-6.02-9.05zm-4.39-.28v11.2a24.97 24.97 0 0 1-7.28-1.32 26.05 26.05 0 0 1 7.2-9.88h.08zm-8.8 9.33c-1.98-.83-3.83-1.93-5.52-3.22a21.7 21.7 0 0 1 11.55-5.83 28.3 28.3 0 0 0-6.02 9.05zm.9 2.04c2.5.86 5.15 1.36 7.9 1.45v8.1h-9.64c.09-3.37.68-6.6 1.75-9.55zm7.9 11.17v9.71c-2.54.08-5 .5-7.32 1.24a30.3 30.3 0 0 1-2.32-10.95zm-2.77 20.64a21.67 21.67 0 0 1-10.55-4.92c1.59-1.1 3.3-2.03 5.14-2.74 1.4 2.92 3.25 5.5 5.41 7.66zm4.39.28v-9.6c2.3.08 4.55.44 6.66 1.1a25.75 25.75 0 0 1-6.58 8.5h-.08zm8.18-7.94a24.8 24.8 0 0 1 5.14 2.74 21.7 21.7 0 0 1-10.55 4.92c2.16-2.15 4-4.74 5.41-7.66zm-.86-2.03a26.49 26.49 0 0 0-7.32-1.23V25.8h9.64a30.3 30.3 0 0 1-2.32 10.95zM25.8 16.1c2.75-.09 5.4-.59 7.9-1.45a30.6 30.6 0 0 1 1.74 9.55H25.8zM8.76 10.54a26.27 26.27 0 0 0 6.03 3.54 32.16 32.16 0 0 0-1.85 10.11H3.27c.19-5.23 2.23-9.99 5.5-13.65zm-5.5 15.27h9.68c.1 4.12.96 8 2.42 11.5-2.04.8-3.95 1.87-5.7 3.12a21.73 21.73 0 0 1-6.4-14.62zm37.09 14.62a26.29 26.29 0 0 0-5.71-3.11 31.79 31.79 0 0 0 2.42-11.52h9.67a21.7 21.7 0 0 1-6.38 14.63z"/></svg>
								Annually
							</label>
						</div>
					</fieldset>

					<fieldset class="donate__fieldset">
						<h3 class="donate__heading"><span class="donate__step">2</span>How much would you like to give?</h3>
						<div class="donate__flex-box donate__flex-box--center">
							<input class="donate__radio" type="radio" name="value" value="25" id="25">
							<label class="donate__label donate__label" for="25">$25</label>

							<input class="donate__radio" type="radio" name="value" value="50" id="50">
							<label class="donate__label donate__label" for="50">$50</label>

							<input class="donate__radio" type="radio" name="value" value="100" id="100">
							<label class="donate__label donate__label" for="100">$100</label><br>

							<input class="donate__radio" type="radio" name="value" value="250" id="250">
							<label class="donate__label donate__label" for="250">$250</label>

							<input class="donate__radio" type="radio" name="value" value="other" id="other">
							<label class="donate__label donate__label donate__label--medium" for="other">Other</label>
						</div>
					</fieldset>

					<fieldset class="donate__fieldset donate__fieldset--large-margin">
						<h3 class="donate__heading"><span class="donate__step">3</span>Credit Card Info</h3>
						<label class="donate__form__label" for="card-number">Credit Card Number</label>
						<input class="donate__form__input-text" type="text" name="card-number" id="card-number">
						<div class="donate__form__input-group">
							<label class="donate__form__label" for="ex-date">Ex Date (##/##/####)</label>
							<input class="donate__form__input-text donate__form__input-text--date" type="text" name="ex-date" id="ex-date" placeholder="_ _ / _ _ / _ _ _ _">
						</div>
						<div class="donate__form__input-group">
							<label class="donate__form__label" for="CVS">CVS</label>
							<input class="donate__form__input-text donate__form__input-text--small" type="text" name="CVS" id="CVS">
						</div>
					</fieldset>

					<fieldset class="donate__fieldset">
						<h3 class="donate__heading"><span class="donate__step">4</span>Just a little more info</h3>
						<label class="donate__form__label" for="first-name">First Name</label>
						<input class="donate__form__input-text" type="text" name="first-name" id="first-name">
						<label class="donate__form__label" for="last-name">Last Name</label>
						<input class="donate__form__input-text" type="text" name="last-name" id="last-name">
						<label class="donate__form__label" for="address">Address</label>
						<input class="donate__form__input-text" type="text" name="address" id="address">
						<label class="donate__form__label" for="address2">Address 2 (if necessary)</label>
						<input class="donate__form__input-text" type="text" name="address2" id="address2">
						<label class="donate__form__label" for="city">City</label>
						<input class="donate__form__input-text" type="text" name="city" id="city">
						<div class="donate__form__input-group">
							<label class="donate__form__label" for="state">State</label>
							<input class="donate__form__input-text donate__form__input-text--small" type="text" name="state" id="state">
						</div>
						<div class="donate__form__input-group">
							<label class="donate__form__label" for="Zip">Zip</label>
							<input class="donate__form__input-text donate__form__input-text--medium" type="text" name="Zip" id="Zip">
						</div>
						<div class="donate__form__checkbox">
							<input type="checkbox" id="newsletter" />
							<label for="newsletter">Sign me up for the Alabama Policy Newsletter</label>
						</div>
					</fieldset>

					<button type="submit" class="btn form__submit donate__form__submit">Submit<img class="submit__icon" src="<?php echo get_template_directory_uri() ?>/img/icons/ico--arrow--right--white.svg" alt=""></button>
				</form>
				<aside class="benefits">
					<div class="benefits__logo">
						<img src="<?php echo get_template_directory_uri() ?>/img/brandmarks/logo--society.png" alt="">
					</div>
					<div class="benefits__item">
						<div class="benefits__img"><img src="<?php echo get_template_directory_uri() ?>/img/pics/donate-1.png" alt=""></div>
						<div class="benefits__content">
							<h5 class="benefits__title">Sweet Home Circle</h5>
							<p class="benefits__value">$500-$1,999</p>
							<p class="benefits__text benefits__text--italic">The song title, the movie title, and the interstate welcome signs echo our sen-timent. The state of Alabama began off icially incorporating the phrase “Sweet Home Alabama” in 2009.</p>
							<p class="benefits__text">Sweet Home Circle Mem-bers receive invitations to API events and a 1989 Soci-ety lapel pin.</p>
						</div>
					</div>
					<div class="benefits__item">
						<div class="benefits__img"><img src="<?php echo get_template_directory_uri() ?>/img/pics/donate-2.png" alt=""></div>
						<div class="benefits__content">
							<h5 class="benefits__title">Camellia Circle</h5>
							<p class="benefits__value">$2,000-$4,999</p>
							<p class="benefits__text benefits__text--italic">The Camellia replaced the Gold-enrod as the state flower of Ala-bama in 1959. It is the only off i-cial state symbol that is not native to Alabama</p>
							<p class="benefits__text">Camellia Circle Members receive all previous bene-fits, recognition in API’s Annual Report, and auto-matic admittance to host receptions at API events.</p>
						</div>
					</div>
					<div class="benefits__item">
						<div class="benefits__img"><img src="<?php echo get_template_directory_uri() ?>/img/pics/donate-3.png" alt=""></div>
						<div class="benefits__content">
							<h5 class="benefits__title">Monarch Circle</h5>
							<p class="benefits__value">$5,000-$9,999</p>
							<p class="benefits__text benefits__text--italic">The state of Alabama adopted the Monarch butterfly as an off icial state symbol in 1989. Monarch butterflies migrate annually and can be seen in Alabama in the spring and summer. </p>
							<p class="benefits__text">Monarch Circle Members re-ceive all previous benefits, and exclusive monthly updates from API’s President.</p>
						</div>
					</div>
					<div class="benefits__item">
						<div class="benefits__img"><img src="<?php echo get_template_directory_uri() ?>/img/pics/donate-4.png" alt=""></div>
						<div class="benefits__content">
							<h5 class="benefits__title">Sweet Home Circle</h5>
							<p class="benefits__value">$10,000 +</p>
							<p class="benefits__text benefits__text--italic">The yellowhammer was chosen as the state bird of Alabama in 1927. Ala-bama is the only state that has a species of woodpecker as its state bird. </p>
							<p class="benefits__text">Yellowhammer Circle Mem-bers receive all previous bene-fits, private briefings from API staff members, and a compli-mentary event table.</p>
						</div>
					</div>
					<div class="benefits__item">
						<div class="benefits__img"><img src="<?php echo get_template_directory_uri() ?>/img/pics/donate-5.png" alt=""></div>
						<div class="benefits__content">
							<h5 class="benefits__title">Sweet Home Circle</h5>
							<p class="benefits__text benefits__text--italic">Alabama Legacy Circle recog-nizes Members who have made a bequest or indicated that they have included API in their es-tate plans. Legacy Circle mem-bers receive all benefits of a Yel-lowhammer Circle Member, two complementary event tickets to be used in the year the commit-ment is made known, and the satisfaction of knowing your legacy will live on through API’s vital work.</p>
						</div>
					</div>
					<div class="benefits__socials">
						<ul class="share-this">
							<li class="share-this__item "><a class="share-this__link" href="#">
								<svg class="share-this__icon" xmlns="http://www.w3.org/2000/svg" width="11" height="22" viewBox="0 0 11 22"><path fill="#00356b" d="M10.98.16v3.51s-2.53-.26-3.17.74c-.34.54-.14 2.13-.17 3.27H11c-.29 1.34-.49 2.24-.7 3.4H7.62V22H2.97V11.12H1V7.68h1.96c.1-2.51.14-5 1.36-6.27C5.68-.02 6.98.16 10.98.16z"/></svg>
								Share</a>
							</li>
							<li class="share-this__item "><a class="share-this__link" href="#">
								<svg class="share-this__icon" xmlns="http://www.w3.org/2000/svg" width="23" height="19" viewBox="0 0 23 19"><path fill="#00356b" d="M22.01 3.19c-.1.82-1.25 1.64-1.94 2.26C20.76 15.9 9.31 22.4 1 17.12c2.33.02 4.95-.64 6.34-2-2.02-.35-3.44-1.3-4-3.15.6-.05 1.42.14 1.82-.12-1.85-.73-3.3-1.85-3.4-4.4.66.08 1 .48 1.82.38-1.19-.79-2.55-3.8-1.33-6.02 2.16 2.48 4.87 4.41 9.1 4.77-1.06-4.62 4.85-7.47 7.5-4.14 1.04-.23 1.91-.63 2.8-1-.37 1.04-1.1 1.7-1.82 2.38.78-.15 1.6-.26 2.18-.63z"/></svg>
								Tweet</a>
							</li>
							<li class="share-this__item "><a class="share-this__link" href="#">
								<div class="share-this__icon share-this__icon--email">
									<img src="<?php echo get_template_directory_uri() ?>/img/icons/ico--share--email.png" alt="">
									<img class="share-this__icon--hover" src="<?php echo get_template_directory_uri() ?>/img/icons/ico--share--email--red.png" alt="">
								</div>
								Email</a></li>
							</ul>
						</div>
					</aside>
				</div>
			</div>
		</section>
	</main>
	
</div>
<?php get_footer(); ?>
