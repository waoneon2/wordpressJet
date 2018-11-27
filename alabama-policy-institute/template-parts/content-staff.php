<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Alabama_Policy_Institute
 */

?>
<?php 
	$featured_img_url 	= get_the_post_thumbnail_url(get_the_ID(),'alpi-staff-thumbnail');
	$emp_position 		= get_post_meta(get_the_ID(), 'api_staff_emp_position', true);

	$emp_facts 			= get_post_meta(get_the_ID(), 'api_staff_emp_facts', true);
	$emp_facts_list 	= ($emp_facts) ? preg_split('/\r\n|[\r\n]/', $emp_facts) : '';

	$emp_fb 			= (get_post_meta($post->ID, 'api_staff_emp_fb', true)) ? get_post_meta($post->ID, 'api_staff_emp_fb', true) : '#';
	$emp_tw 			= (get_post_meta($post->ID, 'api_staff_emp_tw', true)) ? get_post_meta($post->ID, 'api_staff_emp_tw', true) : '#';
	$emp_contact 		= (get_post_meta($post->ID, 'api_staff_emp_contact', true)) ? get_post_meta($post->ID, 'api_staff_emp_contact', true) : '#';
?>
<section>
	<div class="container">
		<div class="employee__wrapper">
			<div class="employee__info">
				<div class="employee__img"><img src="<?php echo $featured_img_url; ?>" alt=""></div>
				<div class="employee__header employee__header--mobile">
					<?php the_title( '<h2 class="employee__name">', '</h2>' ); ?>
					<span class="employee__position"><?php echo $emp_position ?></span>
				</div>
				<ul class="employee__socials share-this share-this--vertical">
					<li class="share-this__item "><a class="share-this__link" href="<?php echo $emp_fb ?>" <?php ($emp_fb == '#') ? '' : 'target="_blank"' ?>>
						<svg class="share-this__icon" xmlns="http://www.w3.org/2000/svg" width="11" height="22" viewBox="0 0 11 22"><path fill="#00356b" d="M10.98.16v3.51s-2.53-.26-3.17.74c-.34.54-.14 2.13-.17 3.27H11c-.29 1.34-.49 2.24-.7 3.4H7.62V22H2.97V11.12H1V7.68h1.96c.1-2.51.14-5 1.36-6.27C5.68-.02 6.98.16 10.98.16z"/></svg>
						Like</a>
					</li>
					<li class="share-this__item "><a class="share-this__link" href="<?php echo $emp_tw ?>" <?php ($emp_tw == '#') ? '' : 'target="_blank"' ?>>
						<svg class="share-this__icon" xmlns="http://www.w3.org/2000/svg" width="23" height="19" viewBox="0 0 23 19"><path fill="#00356b" d="M22.01 3.19c-.1.82-1.25 1.64-1.94 2.26C20.76 15.9 9.31 22.4 1 17.12c2.33.02 4.95-.64 6.34-2-2.02-.35-3.44-1.3-4-3.15.6-.05 1.42.14 1.82-.12-1.85-.73-3.3-1.85-3.4-4.4.66.08 1 .48 1.82.38-1.19-.79-2.55-3.8-1.33-6.02 2.16 2.48 4.87 4.41 9.1 4.77-1.06-4.62 4.85-7.47 7.5-4.14 1.04-.23 1.91-.63 2.8-1-.37 1.04-1.1 1.7-1.82 2.38.78-.15 1.6-.26 2.18-.63z"/></svg>
						Follow</a>
					</li>
					<li class="share-this__item "><a class="share-this__link" href="mailto:<?php echo $emp_contact  ?>" target="_blank">
						<div class="share-this__icon share-this__icon--email">
							<img src="<?php echo get_template_directory_uri() ?>/img/icons/ico--share--email.png" alt="">
							<img class="share-this__icon--hover" src="<?php echo get_template_directory_uri() ?>/img/icons/ico--share--email--red.png" alt="">
						</div>
						Contact</a>
					</li>
					<li class="share-this__item "><a class="share-this__link" href="#">
						<div class="share-this__icon share-this__icon--mic">
							<img src="<?php echo get_template_directory_uri() ?>/img/icons/ico--share--mic.png" alt="">
							<img class="share-this__icon--hover" src="<?php echo get_template_directory_uri() ?>/img/icons/ico--share--mic--red.png" alt="">
						</div>
						Request as a speaker</a>
					</li>
				</ul>
			</div>
			<div class="employee__content">
				<div class="employee__header">
					<?php the_title( '<h2 class="employee__name">', '</h2>' ); ?>
					<span class="employee__position"><?php echo $emp_position ?></span>
				</div>
				<?php the_content() ?>

				<?php if ($emp_facts_list): ?>
					<div class="employee__facts">
						<h3>FUN FACTS</h3>
						<?php foreach ($emp_facts_list as $key => $value): ?>
							<p class="employee__facts__item">
								<span class="employee__facts__number"><?php echo $key + 1 ?></span>
								<?php echo $value ?>
							</p>
						<?php endforeach ?>
					</div>
				<?php endif ?>

			</div>
		</div>
	</div>
</section>

