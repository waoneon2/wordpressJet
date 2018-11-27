<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Alabama_Policy_Institute
 */

?>
		<footer class="footer">
			<div class="footer__img">
                <img src="<?php echo get_theme_mod('image_footer_thumbnails', get_template_directory_uri() . '/img/backgrounds/bg--footer.jpg');?>">
            </div>
			<div class="container">
				<div class="footer__top">
					<a href="<?php echo esc_url(home_url('/')); ?>">
						<img src="<?php echo get_theme_mod('image_footer_logo', get_template_directory_uri() . '/img/brandmarks/logo--footer.png');?>" alt="">
					</a>
					<?php
						$locations = get_nav_menu_locations();
						if(!empty($locations[ 'menu-2' ])){
							$menu = $locations[ 'menu-2' ] ;
							$menu_footer_array =  wp_get_nav_menu_items($menu);

							$i = 0;
							foreach ($menu_footer_array as $key => $item) {
								if ($item->menu_item_parent == 0) {
									$nav[$item->ID] = $item;
									$nav[$item->ID]->child = [];
									foreach ($menu_footer_array as $key => $item_child) {
										$itemID = $item->ID ;
										if ($itemID == $item_child->menu_item_parent) {
											$nav[$item->ID]->child[] = $item_child;
										}
									}
								}
								$i++;
							}
						}
						$withChilds = array_filter($nav, function ($item) {
							return count($item->child) > 0;
						});
						$childLess  = array_filter($nav, function ($item) {
							return count($item->child) === 0;
						});
					?>
					<nav class="footer__nav">
						<ul class="footer__list">
							<?php foreach ($withChilds as $key => $item) : ?>
								<li class="footer__item footer__group">
									<?php $itemID = $item->ID ?>
										<a href="<?php echo $item->url ?>" class="footer__link"><?php echo $item->title ?></a>
										<ul class="footer__sub-list">
											<?php foreach ($item->child as $key => $item_child): ?>
												<?php if ($itemID == $item_child->menu_item_parent): ?>
													<li><a href="<?php echo $item_child->url ?>" class="footer__link"><?php echo $item_child->title ?></a></li>
												<?php endif ?>
											<?php endforeach ?>
										</ul>
								</li>
							<?php endforeach ?>
							<div class="footer__group">
							<?php foreach ($childLess as $key => $childless): ?>
								<li class="footer__item">
									<a href="<?php echo $childless->url ?>" class="footer__link"><?php echo $childless->title ?></a>
								</li>
							<?php endforeach ?>
							</div>
						</ul>
					</nav>
				</div>
				<div class="footer__bottom">
					<div class="footer__bottom__inner">
						<a href="tel:(205)8709900" class="footer__tel"><svg class="footer__icon" xmlns="http://www.w3.org/2000/svg" width="17" height="30" viewBox="0 0 17 30"><path fill="#9da2a8" d="M14.81 0H2.19C.99 0 .01.98.01 2.18v25.64c0 1.2.98 2.18 2.18 2.18h12.62c1.2 0 2.18-.98 2.18-2.18V2.18c0-1.2-.98-2.18-2.18-2.18zM5.39 1.33h6.22c.16 0 .29.23.29.52 0 .29-.13.53-.29.53H5.39c-.16 0-.29-.24-.29-.53 0-.29.13-.52.29-.52zM8.5 27.84a1.39 1.39 0 1 1 0-2.78 1.39 1.39 0 1 1 0 2.78zm6.85-4.77H1.65V3.69h13.7z"/></svg><?php echo get_theme_mod('contact_us_phone_number','(205) 870.9900');?></a>
						<a href="mailto:info@alabamapolicy.org" class="footer__mail"><svg class="footer__icon" xmlns="http://www.w3.org/2000/svg" width="27" height="19" viewBox="0 0 27 19"><path fill="#9da2a8" d="M9.88 9.9L.7 17.56c.34.3.79.49 1.28.49H24.2c.5 0 .94-.19 1.28-.49L16.3 9.9l-3.21 2.73zM24.2 0H1.98C1.49 0 1.04.19.71.49l12.38 10.34L25.48.49A1.9 1.9 0 0 0 24.2 0zM.12 16.58l8.96-7.41L.12 1.58zm25.95 0v-15l-8.96 7.59z"/></svg><?php echo get_theme_mod('contact_us_email','info@alabamapolicy.org');?></a>
						<div class="footer__address">
							<p> <?php echo get_theme_mod('contact_us_pobox','Post Office Box 131088');?> </p>
                            <p> <?php echo get_theme_mod('contact_us_address','Birmingham, AL 35213');?></p>
						</div>

                        <?php
                            $media = array (
                                1 => 'twitter',
                                2 => 'facebook',
                                3 => 'youtube',
                                4 => 'instagram',
                                5 => 'rss',
                            );
                         ?>
    					<ul class="footer__socials">
                            <li ><a class="footer__social-icon" href="<?php echo get_theme_mod('social_media'.$media[1],'default');?>"><img src="<?php echo get_template_directory_uri() ?>/img/icons/ico--social--twitter.png" alt=""></a></li>
                            <li ><a class="footer__social-icon" href="<?php echo get_theme_mod('social_media'.$media[2],'default');?>"><img src="<?php echo get_template_directory_uri() ?>/img/icons/ico--social--fb.png" alt=""></a></li>
                            <li ><a class="footer__social-icon" href="<?php echo get_theme_mod('social_media'.$media[3],'default');?>"><img src="<?php echo get_template_directory_uri() ?>/img/icons/ico--social--yt.png" alt=""></a></li>
                            <li ><a class="footer__social-icon" href="<?php echo get_theme_mod('social_media'.$media[4],'default');?>"><img src="<?php echo get_template_directory_uri() ?>/img/icons/ico--social--instagram.png" alt=""></a></li>
                            <li ><a class="footer__social-icon" href="<?php echo get_theme_mod('social_media'.$media[5],'default');?>"><img src="<?php echo get_template_directory_uri() ?>/img/icons/ico--social--rss.png" alt=""></a></li>
						</ul>
					</div>
				</div>
			</div>
		</footer>
	</div><!-- #content -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
