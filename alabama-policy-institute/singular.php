<!DOCTYPE html>
<html>
<head>
	<?php wp_head() ?>
</head>
<body>
	<div id="page">
		<div class="header-mobile">
			<div class="container">
				<div class="menu__toggle"><button class="btn"><img src="<?php echo get_template_directory_uri() ?>/img/icons/ico--menu.png" alt=""></button></div>
				<div class="menu__logo"><a href="/index.html"><img src="<?php echo get_template_directory_uri() ?>/img/brandmarks/logo--menu.png" alt=""></a></div>
			</div>
		</div>
		<aside class="menu open-start">
			<div class="menu__content">
				<div class="menu__top">
					<div class="menu__toggle"><button class="btn"><img src="<?php echo get_template_directory_uri() ?>/img/icons/ico--menu--close.png" alt=""></button></div>
					<div class="menu__logo"><a href="/index.html"><img src="<?php echo get_template_directory_uri() ?>/img/brandmarks/logo--menu.png" alt=""></a></div>
				</div>
				<div class="search">
					<button class="search__icon">
						<img src="<?php echo get_template_directory_uri() ?>/img/icons/ico--search.png" alt="">
						<img class="search__icon--close" src="<?php echo get_template_directory_uri() ?>/img/icons/ico--search--close.png" alt="">
					</button>
					<form class="search__form" >
						<input class="search__input" type="text" name="search" >
						<button class="search__submit" type="submit">Search <img class="search__submit__icon" src="<?php echo get_template_directory_uri() ?>/img/icons/ico--arrow--right--white.svg" alt=""></button>
					</form>
				</div>
				<nav class="menu__nav">
					<ul class="menu__list">
						<li class="menu__item">
							<a class="menu__link menu__link--with-sub-list" href="#">About</a>
							<ul class="menu__sub-list">
								<li><a href="#" class="menu__sub-link">Associate Board of Directors</a></li>
								<li><a href="#" class="menu__sub-link">Board of Directors</a></li>
								<li><a href="#" class="menu__sub-link">Internships</a></li>
								<li><a href="#" class="menu__sub-link">Our Staff</a></li>
								<li><a href="#" class="menu__sub-link">Receive Weekly Updates</a></li>
							</ul>
						</li>
						<li class="menu__item"><a class="menu__link" href="#">Publications</a></li>
						<li class="menu__item"><a class="menu__link" href="#">Topics</a></li>
						<li class="menu__item"><a class="menu__link" href="#">Initiatives</a></li>
						<li class="menu__item"><a class="menu__link" href="#">Press & Media</a></li>
						<li class="menu__item"><a class="menu__link" href="#">Events</a></li>
						<li class="menu__item"><a class="menu__link" href="#">Contact</a></li>
						<li class="menu__item"><a href="#" class="menu__link menu__link--large">CONTRIBUTE</a></li>
					</ul>
				</nav>
			</div>
			<div class="menu__content--closed">
				<div class="menu__toggle"><button class="btn"><img src="<?php echo get_template_directory_uri() ?>/img/icons/ico--menu.png" alt=""></button></div>
				<div class="menu__logo"><a href="/index.html"><img src="<?php echo get_template_directory_uri() ?>/img/brandmarks/logo--menu--closed.png" alt=""></a></div>
			</div>
		</aside>
		
		<div class="main-content open-start">
			<main>
				<section class="hero hero--detail hero--full featured-img">
					<div class="container">
						<div class="detail__heading">
							<span class="detail__pre-title">Gambling</span>
							<h2 class="detail__title"><b>Alabama Needs Real Hope, Not a State Lottery</b></h2>
							<span class="detail__info">OCT 26, 2016</span>
							<span class="detail__info">Joshua Author</span>
							<p class="detail__description">There are a number of policies, particularly those that stimulate economic growth, that are proven solutions to poverty. Just as easily identifiable are policies that exacerbate&nbsp;poverty.</p>
						</div>
					</div>
				</section>
				<section class="detail__wrapper">
					<div class="container detail__container">
						<div class="detail__sticky"></div>
						<ul class="detail__socials share-this">
							<li class="share-this__item "><a class="share-this__link" href="#">
								<svg class="share-this__icon" xmlns="http://www.w3.org/2000/svg" width="11" height="22" viewBox="0 0 11 22"><path fill="#00356b" d="M10.98.16v3.51s-2.53-.26-3.17.74c-.34.54-.14 2.13-.17 3.27H11c-.29 1.34-.49 2.24-.7 3.4H7.62V22H2.97V11.12H1V7.68h1.96c.1-2.51.14-5 1.36-6.27C5.68-.02 6.98.16 10.98.16z"/></svg>
								Like</a>
							</li>
							<li class="share-this__item "><a class="share-this__link" href="#">
								<svg class="share-this__icon" xmlns="http://www.w3.org/2000/svg" width="23" height="19" viewBox="0 0 23 19"><path fill="#00356b" d="M22.01 3.19c-.1.82-1.25 1.64-1.94 2.26C20.76 15.9 9.31 22.4 1 17.12c2.33.02 4.95-.64 6.34-2-2.02-.35-3.44-1.3-4-3.15.6-.05 1.42.14 1.82-.12-1.85-.73-3.3-1.85-3.4-4.4.66.08 1 .48 1.82.38-1.19-.79-2.55-3.8-1.33-6.02 2.16 2.48 4.87 4.41 9.1 4.77-1.06-4.62 4.85-7.47 7.5-4.14 1.04-.23 1.91-.63 2.8-1-.37 1.04-1.1 1.7-1.82 2.38.78-.15 1.6-.26 2.18-.63z"/></svg>
								Tweet</a>
							</li>
							<li class="share-this__item "><a class="share-this__link" href="#">
								<div class="share-this__icon share-this__icon--pdf">
									<img src="<?php echo get_template_directory_uri() ?>/img/icons/ico--share--pdf.png" alt="">
									<img class="share-this__icon--hover" src="<?php echo get_template_directory_uri() ?>/img/icons/ico--share--pdf--red.png" alt="">
								</div>
								Pdf</a>
							</li>
							<li class="share-this__item "><a class="share-this__link" href="#">
								<div class="share-this__icon share-this__icon--print">
									<img src="<?php echo get_template_directory_uri() ?>/img/icons/ico--share--printer.png" alt="">
									<img class="share-this__icon--hover" src="<?php echo get_template_directory_uri() ?>/img/icons/ico--share--printer--red.png" alt="">
								</div>
								Print</a>
							</li>
						</ul>
						<div class="detail__content">
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem</p>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem </p>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute</p>
							<img class="img--full-width" src="<?php echo get_template_directory_uri() ?>/img/pics/lottery-balls-heh.jpg" alt="">
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem </p>
						</div>
					</div>
				</section>
				<hr>
				<section>
					<div class="container">
						<h3>MORE ON GAMBLING</h3>
						<div class="content__wrapper content__wrapper--padding">
							<article class="content__box">
								<div class="content__image">
									<img src="<?php echo get_template_directory_uri() ?>/img/pics/pexels-photo.jpg" alt="">
								</div>
								<div class="content__inner">
									<h4 class="content__title">Republicans’ Proposal a Bad Move for Alabama</h4>
									<p class="content__date">APR 16, 2016</p>
									<p class="content__text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex</p>
								</div>
							</article>
							<article class="content__box">
								<div class="content__image">
									<img src="<?php echo get_template_directory_uri() ?>/img/pics/lotto-484801_960_7201.jpg" alt="">
								</div>
								<div class="content__inner">
									<h4 class="content__title">Guide to the Issues: Lottery: Socioeconomic Effects</h4>
									<p class="content__date">JAN 22, 2016</p>
									<p class="content__text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex</p>
								</div>
							</article>
							<article class="content__box">
								<div class="content__image">
									<img src="<?php echo get_template_directory_uri() ?>/img/pics/HP_RecentContent_3.jpg" alt="">
								</div>
								<div class="content__inner">
									<h4 class="content__title">Hillbillies and the American Dream</h4>
									<p class="content__date">JAN 12, 2017</p>
									<p class="content__text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in</p>
								</div>
							</article>
						</div>
					</div>
				</section>
				<section>
					<div class="container">
						<h3 class="no-top-margin">MORE FROM THE AUTHOR</h3>
						<div class="content__wrapper content__wrapper--padding">
							<article class="content__box">
								<div class="content__image">
									<img src="<?php echo get_template_directory_uri() ?>/img/pics/cube-442544_960_720.jpg" alt="">
								</div>
								<div class="content__inner">
									<h4 class="content__title">State Lotteries and the Government’s Betrayal of</h4>
									<p class="content__date">AUG 12, 2015</p>
									<p class="content__text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex</p>
								</div>
							</article>
							<article class="content__box">
								<div class="content__image">
									<img src="<?php echo get_template_directory_uri() ?>/img/pics/cube-570704_960_720.jpg" alt="">
								</div>
								<div class="content__inner">
									<h4 class="content__title">Penalties for Illegal Gambling: Cost of Business or a Crime</h4>
									<p class="content__date">JUL 6, 2015</p>
									<p class="content__text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex</p>
								</div>
							</article>
							<article class="content__box">
								<div class="content__image">
									<img src="<?php echo get_template_directory_uri() ?>/img/pics/lotto-484782_960_720.jpg" alt="">
								</div>
								<div class="content__inner">
									<h4 class="content__title">Governor is Right to Take Gambling off the Table</h4>
									<p class="content__date">MAY 26, 2015</p>
									<p class="content__text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in</p>
								</div>
							</article>
						</div>
					</div>
				</section>
			</main>
			<footer class="footer">
				<div class="footer__img">
			
				</div>
				<div class="container">
					<div class="footer__top">
						<a href="/index.html">
							<img src="<?php echo get_template_directory_uri() ?>/img/brandmarks/logo--footer.png" alt="">
						</a>
						<nav class="footer__nav">
							<ul class="footer__list">
								<li class="footer__item footer__group">
									<a href="#" class="footer__link">About</a>
									<ul class="footer__sub-list">
										<li><a href="#" class="footer__link">Associate Board of Directors</a></li>
										<li><a href="#" class="footer__link">Board of Directors</a></li>
										<li><a href="#" class="footer__link">Internships</a></li>
										<li><a href="#" class="footer__link">Our Staff</a></li>
										<li><a href="#" class="footer__link">Receive Weekly Updates</a></li>
									</ul>
								</li>
								<li class="footer__item footer__group">
									<a href="#" class="footer__link">Research</a>
									<ul class="footer__sub-list">
										<li><a href="#" class="footer__link">By the Numbers</a></li>
										<li><a href="#" class="footer__link">Guide to the Issues</a></li>
										<li><a href="#" class="footer__link">Multimedia</a></li>
										<li><a href="#" class="footer__link">Research Papers</a></li>
										<li><a href="#" class="footer__link">Policy Resources</a></li>
										<li><a href="#" class="footer__link">White Papers</a></li>
									</ul>
								</li>
								<div class="footer__group">
									<li class="footer__item">
										<a href="#" class="footer__link">Blog</a>
									</li>
									<li class="footer__item">
										<a href="#" class="footer__link">Events</a>
									</li>
									<li class="footer__item">
										<a href="#" class="footer__link">Press & Media</a>
									</li>
								</div>
							</ul>
						</nav>
					</div>
					<div class="footer__bottom">
						<div class="footer__bottom__inner">
							<a href="tel:(205)8709900" class="footer__tel"><svg class="footer__icon" xmlns="http://www.w3.org/2000/svg" width="17" height="30" viewBox="0 0 17 30"><path fill="#9da2a8" d="M14.81 0H2.19C.99 0 .01.98.01 2.18v25.64c0 1.2.98 2.18 2.18 2.18h12.62c1.2 0 2.18-.98 2.18-2.18V2.18c0-1.2-.98-2.18-2.18-2.18zM5.39 1.33h6.22c.16 0 .29.23.29.52 0 .29-.13.53-.29.53H5.39c-.16 0-.29-.24-.29-.53 0-.29.13-.52.29-.52zM8.5 27.84a1.39 1.39 0 1 1 0-2.78 1.39 1.39 0 1 1 0 2.78zm6.85-4.77H1.65V3.69h13.7z"/></svg>(205) 870.9900</a>
							<a href="mailto:info@alabamapolicy.org" class="footer__mail"><svg class="footer__icon" xmlns="http://www.w3.org/2000/svg" width="27" height="19" viewBox="0 0 27 19"><path fill="#9da2a8" d="M9.88 9.9L.7 17.56c.34.3.79.49 1.28.49H24.2c.5 0 .94-.19 1.28-.49L16.3 9.9l-3.21 2.73zM24.2 0H1.98C1.49 0 1.04.19.71.49l12.38 10.34L25.48.49A1.9 1.9 0 0 0 24.2 0zM.12 16.58l8.96-7.41L.12 1.58zm25.95 0v-15l-8.96 7.59z"/></svg>info@alabamapolicy.org</a>
							<div class="footer__address">
								<p>Post Office Box 131088</p>
								<p>Birmingham, AL 35213</p>
							</div>
							<ul class="footer__socials">
								<li ><a class="footer__social-icon" href="#"><img src="<?php echo get_template_directory_uri() ?>/img/icons/ico--social--twitter.png" alt=""></a></li>
								<li ><a class="footer__social-icon" href="#"><img src="<?php echo get_template_directory_uri() ?>/img/icons/ico--social--fb.png" alt=""></a></li>
								<li ><a class="footer__social-icon" href="#"><img src="<?php echo get_template_directory_uri() ?>/img/icons/ico--social--yt.png" alt=""></a></li>
								<li ><a class="footer__social-icon" href="#"><img src="<?php echo get_template_directory_uri() ?>/img/icons/ico--social--instagram.png" alt=""></a></li>
								<li ><a class="footer__social-icon" href="#"><img src="<?php echo get_template_directory_uri() ?>/img/icons/ico--social--rss.png" alt=""></a></li>
							</ul>
						</div>
			
					</div>
				</div>
			</footer>
			
		</div>
	</div>
	<?php wp_footer() ?>
</body>
</html>
