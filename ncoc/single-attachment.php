<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package NCOC
 */
get_header('single'); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if(get_cond_for_attachment($post->id) == "video"){
			$url_video = wp_get_attachment_url($post->id);
		 	$type = get_post_mime_type($post->id);
		 	$poster_default = get_template_directory_uri(). "/images/poster-default-black.png";
		 	if(has_post_thumbnail()):
		 		$poster_default = get_the_post_thumbnail_url();
		 	endif;
		
		?>
		<div class="wrapper col-md-12">
 			<div class="videocontent">
		<video id="ncoc-video" class="video-js vjs-big-play-centered vjs-16-9 " controls preload="auto" width="640" height="264"
		  poster="<?php echo $poster_default; ?>" data-setup='{"fluid": true}'>
		    <source src="<?php echo $url_video; ?>" type='<?php echo $type; ?>'>
		    <p class="vjs-no-js">
		      To view this video please enable JavaScript
		    </p>
		 </video>
		 </div>
		 </div>
		<?php
		}
		elseif(get_cond_for_attachment($post->id) == "img"){
			?>
			<div class="wrapper col-md-12">
 			<div class="videocontent imgcontent">
 			<?php echo wp_get_attachment_image( $post->id, 'full', "", ["class" => "img-responsive"] ); ?>
 			</div>
 			</div>
			<?php
		}
		else{
			while ( have_posts() ) : the_post();
			get_template_part( 'template-parts/content', get_post_format() );
			endwhile;
		}
		?>

		</main><!-- #main -->
	</div><!-- #primary -->
	
	</div><!-- #content -->
	</div><!-- #col-of-content -->
	</div> <!-- .row -->

<?php
get_footer();