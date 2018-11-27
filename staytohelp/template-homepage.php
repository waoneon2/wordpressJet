<?php
/**
 * Template Name: Homepage
 */
get_header();

	//default for costumize content
	$content_main_title = 'Turn-key fundraising opportunity';
	$content_main_subtitle = 'Raise funds for your organization selling thousands of hotel rooms all over the world';
	$content_main_desc = "StayToHelp provides a turn-key hotel booking service that you can advertise to raise money for your non-profit organization.&#13;&#10;Your supporters can book hotels for the same rates as other hotel booking sites they're using today but make your organization money at the same time.&#13;&#10;Our template is fully customizable and easy for you to style to match your own colors and image.";

    $features1title = array (
        1 => 'Site Setup is Easy',
        2 => 'Easy To Customize',
        3 => 'Easy To Understand Commissions'
    );

    $features1desc = array (
        1 => '<ul><li>Be up and running in less than a day</li></ul>',
        2 => '<ul><li>Use your own colors and branding</li><li>Use your own domain name</li><li>Choose to display up to 35 languages</li><li>Shop and book in up to 27 currencies</li></ul>',
        3 => '<ul><li>Earn up to 4% per booking</li><li>Keep track of commissions with your booking dashboard</li></ul>'
    );

    //features 2

    $feature2title = array(
        1 => 'Your site styled to match your image',
        2 => 'Branded confirmation emails',
        3 => 'Keep track of your commissions',
        4 => 'Site control panel',
        5 => 'Administration panel',
        6 => 'Customize deals on your home page',
        7 => 'Customizable SEO',
        8 => 'Integrated Google Analytics',
        9 => 'TripAdvisor ratings and reviews',
        );

	$demo_ribbon_title = 'Take a tour of one of our fundraising sites';
	$demo_ribbon_desc='This is a live site, you can make a real booking';
	$demo_ribbon_links_url='https://reservations.staytohelp.com/';
	$demo_ribbon_links_text ='Demo';

	$signup_ribbon_title = 'Like what you see?';
	$signup_ribbon_desc = 'Sign up today';
	$signup_ribbon_links_url = 'https://my.staytohelp.com/signup';
	$signup_ribbon_links_text = 'Sign up today';

	$contact_us_title = 'Contact Us';
	$contact_us_desc = 'We look forward to the opportunity to get to work with you on this fundraising opportunity. Let us know how we can assist you.';
	$contact_us_content = 'If you would like to discuss how this fundraising opportunity can work for your organization, get in touch with us.';
	$contact_us_site = 'StayToHelp.com';
	$contact_us_address = 'Bellingham, WA, 98225';
	$contact_us_email = 'admin@StayToHelp.com';

	$how_it_work_title = 'How our program works';
	$how_it_work_content_title = 'Fundraising made easy';
	$how_it_work_content = '<p>StayToHelp offers you a turn-key fundraising solution that converts hotel bookings into commission payments to your non-profit organization. When you offer your StayToHelp site to your supporters, they can make hotel bookings on your site for the same rates as other global travel websites. StayToHelp then passes a commission on to you for a percentage of the booking revenue (before taxes and fees).</p><p>This service is free for eligible non-profit organizations. All you need to do is promote your site with supporters of your organization. This fundraising program is based on volume of bookings. The more bookings sold on your site in a given month, the higher your commission payments will be; typically between 2% and 4% per booking. We would love to work with you to bring in more money for your organization.<a href="https://fundraising.staytohelp.com/signup"> Sign up today</a></p>';
	$how_it_work_quote_title = 'Our philosophy';
	$how_it_work_quote = '      We love to help organizations raise funds by selling travel services people want.';
	$how_it_work_quote_source = 'Chad Baron';
	$how_it_work_company = 'Owner - StayToHelp.com';
	$features2_additional_information = '<strong>All of our sites include:<br></strong> Access to over 200,000 hotels, mobile-ready theme, special mobile rates, customer self-service, real-time booking management, custom styling, enable up to 35 languages, enable up to 27 currencies, deal cities for your home page, use your own domain name, branded confirmation emails and 24/7/365 telephone booking support';
?>

	<div id="primary" class="homepage">
		<main id="main" class="site-main" role="main">

			<?php
		if ( have_posts() ) :
			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?>tes</h1>
				</header>

			<?php
			endif;

			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;

			the_posts_navigation();

		else :
			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		<div id="home" class="content has-bg home" style="height: 950px;">
		    <!-- begin content-bg -->
		    <div class="content-bg">
			<?php
				$cmi = defaultAssetsImage('content-main');
				if(get_theme_mod('content_main_image') || !empty(get_theme_mod('content_main_image'))){
					$cmi = get_theme_mod('content_main_image', defaultAssetsImage('content-main'));
				}
			?>
		        <img src="<?php echo $cmi;?>" alt="Home">
		    </div>
		    <!-- end content-bg -->
		    <!-- begin container -->
		    <div class="container home-content">

				<?php echo (get_theme_mod('content_main_title'))? '<h1>'.get_theme_mod('content_main_title').'</h1>' : '<h1>'.$content_main_title.'</h1>';?>
				<?php echo (get_theme_mod('content_main_subtitle'))? '<h2>'.get_theme_mod('content_main_subtitle').'</h2>': '<h2>'.$content_main_subtitle. '</h2>';?>
					<?php

					if (get_theme_mod('content_main_desc')){
						$desc_main = trim(get_theme_mod('content_main_desc'));
						$string = $desc_main;
						$bits = explode("\n", $string);
						echo "<p>";
						foreach($bits as $bit) {
							echo  "" . $bit . "<br>";
						}
						echo "</p>";
					} else {
						$desc_main = trim($content_main_desc);
						$string = $desc_main;
						$bits = explode("&#13;&#10;", $string);
						echo "<p>";
						foreach($bits as $bit) {
							echo  "" . $bit . "<br>";
						}
						echo "</p>";
					}

					?>
		    </div>
		    <!-- end container -->
		</div>

		<div id="features" class="content" style="padding-bottom: 0px !important" data-scrollview="true">
		    <!-- begin container -->
		    <div class="container">
		        <!-- begin row -->
		        <div class="row">
		            <!-- begin col-4 -->
		            <?php
						$fione = array();
					 	for ($i=1; $i <= 3 ; $i++) :

		            	?>

		                <div class="col-md-4 col-sm-4">
		                    <div class="service">
		                        <?php
								if($i == 1) {
									$fione[$i] = defaultAssetsImage('feature-one')[$i];
									if ( get_theme_mod('features1_image'.$i ) || !empty(get_theme_mod('features1_image'.$i))){
										$fione[$i] = get_theme_mod('features1_image'.$i, defaultAssetsImage('feature-one')[$i]);
									}
								}
								if($i == 2) {
									$fione[$i] = defaultAssetsImage('feature-one')[$i];
									if ( get_theme_mod('features1_image'.$i ) || !empty(get_theme_mod('features1_image'.$i))){
										$fione[$i] = get_theme_mod('features1_image'.$i, defaultAssetsImage('feature-one')[$i]);
									}
								}
								if($i == 3) {
									$fione[$i] = defaultAssetsImage('feature-one')[$i];
									if ( get_theme_mod('features1_image'.$i ) || !empty(get_theme_mod('features1_image'.$i))){
										$fione[$i] = get_theme_mod('features1_image'.$i, defaultAssetsImage('feature-one')[$i]);
									}
								} ?>
		                        	<div class="icon bg-theme" data-animation="true" data-animation-type="bounceIn"><img src="<?php echo $fione[$i];?>"></div>
		                        <div class="info">
									<?php echo (get_theme_mod('features1_title')) ? '<h4 class="title">'.get_theme_mod('features1_title'.$i).'</h4>' : '<h4 class="title">'.$features1title[$i].'</h4>';?>
									<p>
										<?php
										if(get_theme_mod('features1_desc'.$i)){
											$desc_features1 = trim(get_theme_mod('features1_desc'.$i));

											$string = $desc_features1;
											$bits = explode("\n", $string);
											echo "<ul>";
											foreach($bits as $bit) {
												echo  "<li>" . $bit . "</li>";
											}
											echo  "</ul>";
										}
										else {
											echo $features1desc[$i];
										}
										?>
									</p>
		                        </div>
		                    </div>
		                </div>
		            <?php

		            endfor;?>
		            <!-- end col-4 -->
		        </div>
		        <!-- end row -->
		    </div>
		    <!-- end container -->
		</div>

		<?php
			$checklist = get_theme_mod('hide_how_it_work_section');

		if ($checklist == false): ?>
			<div id="how_it_works" class="content" style="padding-top: 20px;" data-scrollview="true">
			    <!-- begin container -->
			    <div class="container">
					<?php echo (get_theme_mod('how_it_work_title'))? '<h2 class="content-title">'.get_theme_mod('how_it_work_title').'</h2>' : '<h2 class="content-title">'.$how_it_work_title.'</h2>';?>
					<?php echo (get_theme_mod('how_it_work_desc')) ? '<p class="content-desc">'.get_theme_mod('how_it_work_desc').'</p>': '<p class="content-desc"></p>';?>
			        <div class="row">
			            <!-- begin col-4 -->
			            <div class="col-sm-6">
			                <!-- begin about -->
			                <div class="about">
								<?php echo (get_theme_mod('how_it_work_content_title'))? '<h3>'.get_theme_mod('how_it_work_content_title').'</h3>' : '<h3>'.$how_it_work_content_title.'</h3>';?>

								<?php
									if (get_theme_mod('how_it_work_content')){
										$desc_main = trim(get_theme_mod('how_it_work_content'));
										$string = $desc_main;
										$bits = explode("\n", $string);
										echo "<p>";
										foreach($bits as $bit) {
											echo  "" . $bit . "<br>";
										}
										echo "</p>";
									} else {
										echo $how_it_work_content;
									}
								?>
			                </div>
			                <!-- end about -->
			            </div>
			            <!-- end col-4 -->
			            <!-- begin col-4 -->
			            <div class="col-sm-6">
							<?php echo (get_theme_mod('how_it_work_quote_title'))? '<h3>'.get_theme_mod('how_it_work_quote_title').'</h3>' : '<h3>'.$how_it_work_quote_title.'</h3>';?>
			                <!-- begin about-author -->
			                <div class="about-author">
			                    <div class="quote bg-silver">
			                        <i class="fa fa-quote-left"></i>
									<?php echo (get_theme_mod('how_it_work_quote'))? '<h3>'.get_theme_mod('how_it_work_quote').'</h3>' : '<h3>'.$how_it_work_quote.'</h3>';?>
			                        <i class="fa fa-quote-right"></i>
			                    </div>
			                    <div class="author">
			                        <div class="image">
			                        <?php
									$howprofile = defaultAssetsImage('how-it-work-profile');
									if(get_theme_mod('how_it_work_image_profile') || !empty(get_theme_mod('how_it_work_image_profile'))){
										$howprofile = get_theme_mod('how_it_work_image_profile', defaultAssetsImage('how-it-work-profile'));
									}
									?>
								        <img src="<?php echo $howprofile; ?>">
			                        </div>
			                        <div class="info">
										<?php echo (get_theme_mod('how_it_work_quote_source'))? get_theme_mod('how_it_work_quote_source') : $how_it_work_quote_source;?>
			                            <small><?php echo (get_theme_mod('how_it_work_company'))?get_theme_mod('how_it_work_company') : $how_it_work_company;?></small>
			                        </div>
			                    </div>
			                </div>
			                <!-- end about-author -->
			            </div>
			        </div>
			        <!-- end row -->
			    </div>
			    <!-- end container -->
			</div>
		<?php endif ?>

		<div id="call_to_action_mid" class="content has-bg" data-scrollview="true">
		    <!-- begin content-bg -->
		    <div class="content-bg">
			<?php
			$drib = defaultAssetsImage('demo-ribbon-bg');
			if(get_theme_mod('demo_ribbon_image_background') || !empty(get_theme_mod('demo_ribbon_image_background'))){
				$drib = get_theme_mod('demo_ribbon_image_background', defaultAssetsImage('demo-ribbon-bg'));
			}
			?>
		        <img src="<?php echo $drib;?>">
		    </div>
		    <!-- end content-bg -->
		    <!-- begin container -->
		    <div class="container" data-animation="true" data-animation-type="fadeInRight">
		        <!-- begin row -->
		        <div class="row action-box">
		            <!-- begin col-9 -->
		            <div class="col-md-9 col-sm-9">
		                <div class="icon-large text-theme">
						<?php
						$drii = defaultAssetsImage('demo-ribbon-icon');
						if(get_theme_mod('demo_ribbon_image') || !empty(get_theme_mod('demo_ribbon_image'))){
							$drii = get_theme_mod('demo_ribbon_image', defaultAssetsImage('demo-ribbon-icon'));
						}

						?>
		        			<img src="<?php echo $drii;?>">
		                </div>
						<?php echo (get_theme_mod('demo_ribbon_title'))?'<h3>'.get_theme_mod('demo_ribbon_title').'</h3>':'<h3>'.$demo_ribbon_title.'</h3>';?>
						<?php echo (get_theme_mod('demo_ribbon_desc')) ? '<p><strong>'.get_theme_mod('demo_ribbon_desc').'</strong></p>':'<p><strong>'.$demo_ribbon_desc.'</strong></p>';?>
		            </div>
		            <!-- end col-9 -->
		            <!-- begin col-3 -->
		            <div class="col-md-3 col-sm-3">
		                <a href="<?php echo (get_theme_mod('demo_ribbon_links_url')) ? get_theme_mod('demo_ribbon_links_url'): $demo_ribbon_links_url; ?>" class="btn btn-outline btn-block" target="blank"><?php echo (get_theme_mod('demo_ribbon_links_text')) ? get_theme_mod('demo_ribbon_links_text'): $demo_ribbon_links_text; ?></a>
		            </div>
		            <!-- end col-3 -->
		        </div>
		        <!-- end row -->
		    </div>
		    <!-- end container -->
		</div>

		<div id="minor_bullets" class="content" style="padding-bottom: 20px;" data-scrollview="true">
			<!-- begin container -->
			<div class="container">
				<?php if (get_theme_mod('image_position') == 'right'): ?>
					<!-- begin row -->
				    <div class="row">
				        <div class="col-md-7 col-sm-12">
				            <div class="row">
			                    <!-- begin col-4 -->
			                    <?php
									$fitwo = array();
									for ($i =1; $i <= 9 ; $i++) :
					            	if (get_theme_mod('features2_title'.$i, $feature2title[$i])) :
									if($i == 1){
										$fitwo[$i] = defaultAssetsImage('feature-two')[$i];
										if ( get_theme_mod('features2_image_icon'.$i ) || !empty(get_theme_mod('features2_image_icon'.$i))){
											$fitwo[$i] = get_theme_mod('features2_image_icon'.$i, defaultAssetsImage('feature-two')[$i]);
										}
									}
									if($i == 2){
										$fitwo[$i] = defaultAssetsImage('feature-two')[$i];
										if ( get_theme_mod('features2_image_icon'.$i ) || !empty(get_theme_mod('features2_image_icon'.$i))){
											$fitwo[$i] = get_theme_mod('features2_image_icon'.$i, defaultAssetsImage('feature-two')[$i]);
										}
									}
									if($i == 3){
										$fitwo[$i] = defaultAssetsImage('feature-two')[$i];
										if ( get_theme_mod('features2_image_icon'.$i ) || !empty(get_theme_mod('features2_image_icon'.$i))){
											$fitwo[$i] = get_theme_mod('features2_image_icon'.$i, defaultAssetsImage('feature-two')[$i]);
										}
									}
									if($i == 4){
										$fitwo[$i] = defaultAssetsImage('feature-two')[$i];
										if ( get_theme_mod('features2_image_icon'.$i ) || !empty(get_theme_mod('features2_image_icon'.$i))){
											$fitwo[$i] = get_theme_mod('features2_image_icon'.$i, defaultAssetsImage('feature-two')[$i]);
										}
									}
									if($i == 5){
										$fitwo[$i] = defaultAssetsImage('feature-two')[$i];
										if ( get_theme_mod('features2_image_icon'.$i ) || !empty(get_theme_mod('features2_image_icon'.$i))){
											$fitwo[$i] = get_theme_mod('features2_image_icon'.$i, defaultAssetsImage('feature-two')[$i]);
										}
									}
									if($i == 6){
										$fitwo[$i] = defaultAssetsImage('feature-two')[$i];
										if ( get_theme_mod('features2_image_icon'.$i ) || !empty(get_theme_mod('features2_image_icon'.$i))){
											$fitwo[$i] = get_theme_mod('features2_image_icon'.$i, defaultAssetsImage('feature-two')[$i]);
										}
									}
									if($i == 7){
										$fitwo[$i] = defaultAssetsImage('feature-two')[$i];
										if ( get_theme_mod('features2_image_icon'.$i ) || !empty(get_theme_mod('features2_image_icon'.$i))){
											$fitwo[$i] = get_theme_mod('features2_image_icon'.$i, defaultAssetsImage('feature-two')[$i]);
										}
									}
									if($i == 8){
										$fitwo[$i] = defaultAssetsImage('feature-two')[$i];
										if ( get_theme_mod('features2_image_icon'.$i ) || !empty(get_theme_mod('features2_image_icon'.$i))){
											$fitwo[$i] = get_theme_mod('features2_image_icon'.$i, defaultAssetsImage('feature-two')[$i]);
										}
									}
									if($i == 9){
										$fitwo[$i] = defaultAssetsImage('feature-two')[$i];
										if ( get_theme_mod('features2_image_icon'.$i ) || !empty(get_theme_mod('features2_image_icon'.$i))){
											$fitwo[$i] = get_theme_mod('features2_image_icon'.$i, defaultAssetsImage('feature-two')[$i]);
										}
									}
					            	?>

				                    <div class="col-md-6 col-sm-4">
				                        <div class="service">
				                            	<div class="icon bg-theme" data-animation="true" data-animation-type="bounceIn"><img src="<?php echo $fitwo[$i];?>"></div>
				                            <div class="info">
				                            	<h4 class="title" style="font-size:1.2em; line-height:30px; padding-top:10px;"><?php echo get_theme_mod('features2_title'.$i, $feature2title[$i]); ?></h4>
				                            </div>
				                        </div>
				                    </div>
				                    <!-- end col-4 -->
					            <?php
					            endif;
					            endfor; ?>
				            </div>
				        </div>
				        <div class="col-md-5 hidden-xs hidden-sm">
						<?php
						$fitwobg = defaultAssetsImage('feature-two-image');
						if(get_theme_mod('features2_image') || !empty(get_theme_mod('features2_image'))){
							$fitwobg = get_theme_mod('features2_image', defaultAssetsImage('feature-two-image'));
						}
						?>
				            <img style="width:100%; margin-top:50px;" src="<?php echo $fitwobg;?>">
				        </div>
				    </div>
				    <!-- end row -->
				<?php else: ?>
					<!-- begin row -->
				    <div class="row">
				        <div class="col-md-5 hidden-xs hidden-sm">
				            <?php
								$fitwobgleft = defaultAssetsImage('feature-two-image');
								if(get_theme_mod('features2_image') || !empty(get_theme_mod('features2_image'))){
									$fitwobgleft = get_theme_mod('features2_image', defaultAssetsImage('feature-two-image'));
								}
							?>
				            <img style="width:100%; margin-top:50px;" src="<?php echo $fitwobgleft;?>">
				        </div>
				        <div class="col-md-7 col-sm-12">
				            <div class="row">
			                    <!-- begin col-4 -->
			                    <?php
								$ftr = array();
								for ($i=1; $i <= 9 ; $i++) :
					            	if (get_theme_mod('features2_title'.$i, $feature2title[$i])) :

									if($i == 1){
										$ftr[$i] = defaultAssetsImage('feature-two')[$i];
										if ( get_theme_mod('features2_image_icon'.$i ) || !empty(get_theme_mod('features2_image_icon'.$i))){
											$ftr[$i] = get_theme_mod('features2_image_icon'.$i, defaultAssetsImage('feature-two')[$i]);
										}
									}
									if($i == 2){
										$ftr[$i] = defaultAssetsImage('feature-two')[$i];
										if ( get_theme_mod('features2_image_icon'.$i ) || !empty(get_theme_mod('features2_image_icon'.$i))){
											$ftr[$i] = get_theme_mod('features2_image_icon'.$i, defaultAssetsImage('feature-two')[$i]);
										}
									}
									if($i == 3){
										$ftr[$i] = defaultAssetsImage('feature-two')[$i];
										if ( get_theme_mod('features2_image_icon'.$i ) || !empty(get_theme_mod('features2_image_icon'.$i))){
											$ftr[$i] = get_theme_mod('features2_image_icon'.$i, defaultAssetsImage('feature-two')[$i]);
										}
									}
									if($i == 4){
										$ftr[$i] = defaultAssetsImage('feature-two')[$i];
										if ( get_theme_mod('features2_image_icon'.$i ) || !empty(get_theme_mod('features2_image_icon'.$i))){
											$ftr[$i] = get_theme_mod('features2_image_icon'.$i, defaultAssetsImage('feature-two')[$i]);
										}
									}
									if($i == 5){
										$ftr[$i] = defaultAssetsImage('feature-two')[$i];
										if ( get_theme_mod('features2_image_icon'.$i ) || !empty(get_theme_mod('features2_image_icon'.$i))){
											$ftr[$i] = get_theme_mod('features2_image_icon'.$i, defaultAssetsImage('feature-two')[$i]);
										}
									}
									if($i == 6){
										$ftr[$i] = defaultAssetsImage('feature-two')[$i];
										if ( get_theme_mod('features2_image_icon'.$i ) || !empty(get_theme_mod('features2_image_icon'.$i))){
											$ftr[$i] = get_theme_mod('features2_image_icon'.$i, defaultAssetsImage('feature-two')[$i]);
										}
									}
									if($i == 7){
										$ftr[$i] = defaultAssetsImage('feature-two')[$i];
										if ( get_theme_mod('features2_image_icon'.$i ) || !empty(get_theme_mod('features2_image_icon'.$i))){
											$ftr[$i] = get_theme_mod('features2_image_icon'.$i, defaultAssetsImage('feature-two')[$i]);
										}
									}
									if($i == 8){
										$ftr[$i] = defaultAssetsImage('feature-two')[$i];
										if ( get_theme_mod('features2_image_icon'.$i ) || !empty(get_theme_mod('features2_image_icon'.$i))){
											$ftr[$i] = get_theme_mod('features2_image_icon'.$i, defaultAssetsImage('feature-two')[$i]);
										}
									}
									if($i == 9){
										$ftr[$i] = defaultAssetsImage('feature-two')[$i];
										if ( get_theme_mod('features2_image_icon'.$i ) || !empty(get_theme_mod('features2_image_icon'.$i))){
											$ftr[$i] = get_theme_mod('features2_image_icon'.$i, defaultAssetsImage('feature-two')[$i]);
										}
									}
					            	?>

				                    <div class="col-md-6 col-sm-4">
				                        <div class="service">
				                            	<div class="icon bg-theme" data-animation="true" data-animation-type="bounceIn"><img src="<?php echo $ftr[$i];?>"></div>
				                            <div class="info">
				                            	<h4 class="title" style="font-size:1.2em; line-height:30px; padding-top:10px;"><?php echo get_theme_mod('features2_title'.$i, $feature2title[$i]); ?></h4>
				                            </div>
				                        </div>
				                    </div>
				                    <!-- end col-4 -->
					            <?php
					            endif;
					            endfor;?>
				            </div>
				        </div>
				    </div>
				    <!-- end row -->
				<?php endif ?>

			</div>
			<!-- end container -->
			</div>

			<div id="earning_details" class="content" style="padding-top: 0px;" data-scrollview="true">
			    <!-- begin container -->

			    <div class="container">

			        	<?php
							if (get_theme_mod('features2_additional_information')){
								$desc_main = trim(get_theme_mod('features2_additional_information'));
								$string = $desc_main;
								$bits = explode("\n", $string);
								echo "<p class='content-desc'>&nbsp;";
								foreach($bits as $bit) {
									echo  "" . $bit . "<br>";
								}
								echo "</p>";
							} else {
								$desc_main = trim($features2_additional_information);
								$string = $desc_main;
								$bits = explode("&#13;&#10;", $string);
								echo "<p class='content-desc'>&nbsp;";
								foreach($bits as $bit) {
									echo  "" . $bit . "<br>";
								}
								echo "</p>";;
							}
						?>
			     </div>
			    <!-- end container -->
			</div>


			<div id="call_to_action_bottom" class="content has-bg" data-scrollview="true">
			    <!-- begin content-bg -->
			    <div class="content-bg" id="sign_up">
				<?php
				$signupbg = defaultAssetsImage('signup-ribbon-bg');
				if(get_theme_mod('signup_ribbon_image_background') || !empty(get_theme_mod('signup_ribbon_image_background'))){
					$signupbg = get_theme_mod('signup_ribbon_image_background', defaultAssetsImage('signup-ribbon-bg'));
				}
				?>
			        <img src="<?php echo $signupbg; ?>">
			    </div>
			    <!-- end content-bg -->
			    <!-- begin container -->
			    <div class="container" data-animation="true" data-animation-type="fadeInRight">
			        <!-- begin row -->
			        <div class="row action-box">
			            <!-- begin col-9 -->
			            <div class="col-md-9 col-sm-9">
			                <div class="icon-large text-theme">
							<?php
							$signupicon = defaultAssetsImage('signup-ribbon-icon');
							if(get_theme_mod('signup_ribbon_image') || !empty(get_theme_mod('signup_ribbon_image'))){
								$signupicon = get_theme_mod('signup_ribbon_image', defaultAssetsImage('signup-ribbon-icon'));
							}


							?>
			                    <img src="<?php echo $signupicon; ?>" style="margin-top: 15px;">
			                </div>
			                <h1><?php echo (get_theme_mod('signup_ribbon_title')) ? get_theme_mod('signup_ribbon_title') : $signup_ribbon_title; ?><br>
			                <span style="font-size: .6em;">
			                <?php echo (get_theme_mod('signup_ribbon_desc')) ? get_theme_mod('signup_ribbon_desc') : $signup_ribbon_desc; ?></span>
			                </h1>
			            </div>
			            <!-- end col-9 -->
			            <!-- begin col-3 -->
			            <div class="col-md-3 col-sm-3">
			                <br><br>
			                <a href="<?php echo (get_theme_mod('signup_ribbon_links_url')) ? get_theme_mod('signup_ribbon_links_url'): $signup_ribbon_links_url ; ?>" class="btn btn-outline btn-block"><?php echo (get_theme_mod('signup_ribbon_links_text')) ? get_theme_mod('signup_ribbon_links_text') : $signup_ribbon_links_text ; ?></a>
			            </div>
			            <!-- end col-3 -->
			        </div>
			        <!-- end row -->
			    </div>
			    <!-- end container -->
			</div>

			<div id="contact_us" class="content bg-silver-lighter" data-scrollview="true">
			    <!-- begin container -->
			    <div class="container">
			        <h2 class="content-title"> <?php echo (get_theme_mod('contact_us_title')) ? get_theme_mod('contact_us_title') : $contact_us_title;?> </h2>
			        <p class="content-desc">
			            <?php echo (get_theme_mod('contact_us_desc')) ? get_theme_mod('contact_us_desc') : $contact_us_desc ;?>
			        </p>
			        <!-- begin row -->
			        <div class="row">
			            <!-- begin col-6 -->
			            <div class="col-md-6" data-animation="true" data-animation-type="fadeInLeft">
			                <?php echo (get_theme_mod('contact_us_content')) ? '<h3>'.get_theme_mod('contact_us_content').'</h3>' : '<h3>'.$contact_us_content.'</h3>' ;?>
			                <?php echo (get_theme_mod('contact_us_site')) ? '<p><strong>'.get_theme_mod('contact_us_site').'</strong>' : '<p><strong>'.$contact_us_site.'</strong>';?>
			                <?php echo (get_theme_mod('contact_us_address')) ? '<br>'.get_theme_mod('contact_us_address').'</p>' : '<br>'.$contact_us_address.'</p>' ;?>
			                <p>
			                    <a href="mailto:<?php echo (get_theme_mod('contact_us_email')) ? get_theme_mod('contact_us_email') : $contact_us_email;?>"><?php echo (get_theme_mod('contact_us_email')) ? get_theme_mod('contact_us_email') : $contact_us_email;?></a>
			                </p>
			            </div>
			            <!-- end col-6 -->
			                <!-- begin col-6 -->
			                <div class="col-md-6 form-col" data-animation="true" data-animation-type="fadeInRight">
			                	<?php
								if(get_theme_mod('gravity_form') || !empty(get_theme_mod('gravity_form'))){
									echo gravity_form( $id_or_title = get_theme_mod('gravity_form'), $display_title = false, $display_description = true, $display_inactive = false, $field_values = null, $ajax = true, $tabindex = 15, $echo = true );
								}
								?>
			                </div>
			                <!-- end col-6 -->
			        </div>
			        <!-- end row -->
			    </div>
			    <!-- end container -->
			</div>


		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_footer();?>