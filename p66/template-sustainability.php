<?php
/**
 * Template Name: Sustainability
 */
get_header(); ?>

<div class="content">
	<?php if (get_theme_mod('sustainability_image_video')) :?>
		<div class="video-container contained orange-test section-bottom">
            <div class="video video-sustainability" data-toggle="modal" data-target=".modal-video-3">
                <img src="<?php echo get_theme_mod('sustainability_image_video');?>">
                <img class="video-button" src="<?php echo get_template_directory_uri(); ?>/img/button-play.png">
                <button class="video-button" type="button"></button>
            </div>
        </div>
    <?php 
    endif; 
    if (get_theme_mod('sustainability_image_video')) :
    ?>
    <div class="contained wide-content orange-test section-bottom">
		<div class="row text-center">
			<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
				<h2><?php echo get_theme_mod('sustainability_title');?></h2>
				<p><?php echo (get_theme_mod('sustainability_content_1')) ? '<p>'.get_theme_mod('sustainability_content_1').'</p>' :'';?></p>
				<p><?php echo (get_theme_mod('sustainability_content_2')) ? '<p>'.get_theme_mod('sustainability_content_2').'</p>' :'';?></p>
			</div>
		</div>
	</div>
	<?php 
	endif;
	 ?>
    <div class="contained two-column orange-test section-bottom">
        <?php
        while ( have_posts() ) : the_post();
          get_template_part( 'template-parts/content', 'page' );
        endwhile; // End of the loop. ?>
  	</div>

	<div class="contained flush orange-test section-bottom">
		<div class="promo-sustainability promo fully-shaded">
			<style type="text/css">
			@media (min-width: 768px) {
			.promo-sustainability.promo {
					    background: -webkit-linear-gradient(left, rgba(0, 0, 0, 0.6) 0, rgba(0, 0, 0, 0.6) 70%), url(<?php echo get_theme_mod('sustainability_image_promo')?>) center center/100%;
					    background: linear-gradient(to right, rgba(0, 0, 0, 0.6) 0, rgba(0, 0, 0, 0.6) 70%), url(<?php echo get_theme_mod('sustainability_image_promo')?>) center center/100%;
					}
				}
			@media (max-width: 767px) {
						.promo-sustainability.promo:after {
					    padding-top: 51.16279%;
					    content: '';
					    display: block;
					}
					.promo-sustainability.promo {
					    background: -webkit-linear-gradient(left, rgba(0, 0, 0, 0) 0, rgba(0, 0, 0, 0) 0%), url(<?php echo get_theme_mod('sustainability_image_promo')?>) center center/100%;
					    background: linear-gradient(to right, rgba(0, 0, 0, 0) 0, rgba(0, 0, 0, 0) 0%), url(<?php echo get_theme_mod('sustainability_image_promo')?>) center center/100%;
					}
				}
			</style>
				<div class="row promo-full-width-row">
					<div class="col-lg-push-6 col-md-push-6 col-sm-push-5 col-lg-5 col-md-5 col-sm-6 hidden-xs desktop-content text-right">
				    	<h2><?php echo get_theme_mod('sustainability_title_promo');?></h2>
				    	<div>
					    	<p><?php echo get_theme_mod('sustainability_content_3' );?></p>
				       </div>
				   </div>
			   </div>
	    </div>
		   <div class="mobile-content promo-content visible-xs">
			    <div></div>
		   </div>
	</div>

	<?php
	if (is_active_sidebar('jetty-sustainability-page')) {
	    dynamic_sidebar('jetty-sustainability-page');
	} ?>

	<div class="contained flush orange-test">
		<div class="promo promo-sustainability-ceo">
			<div class="row promo-full-width-row">
				<div class="col-lg-push-6">
			    	<h2>A message from</h2>
			    	<img src="<?php echo get_theme_mod('sustainability_image_sign')?>" alt="CEO signature" class="signature">
			    	<div>
			    		<button class="btn-primary btn-video" data-toggle="modal" data-target=".modal-video-3"><i class="glyphicon glyphicon-play" aria-hidden="true"></i>Watch now</button>
			    		<a href="">View Letter</a>
			    	</div>
			   </div>
		   </div>
		   <img src="<?php echo get_theme_mod('sustainability_image_ceo')?>">
		</div>
	</div>
		<!-- Modal - Video -->
	<div class="modal fade modal-video-3" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" data-video-id="<?php echo get_theme_mod('sustainability_link');?>" data-video-height="380" data-video-width="640">
		  <div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
		      <span class="close-btn">
		        <span>Close Video</span>
		      </span>
		      <div class="embed-responsive embed-responsive-16by9">
		        <div class="videoShell" id="video-<?php echo get_theme_mod('sustainability_link');?>"></div>
		      </div>
		    </div>
		  </div>
	</div>
</div><!-- #content -->

<?php get_footer();
