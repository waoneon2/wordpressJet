<?php
/**
 * Template Name: Default Home Unified Command Child 2
 */
// slider image
function ucctwo_get_slider_img(){
	$content_slider = '';
	$content_img = '';
	$content_overlay = '';

	if(get_theme_mod( 'uc_lk' )){
		$get_uc_image_slider = get_theme_mod('uc_lk');
		$content_slider .= '<div class="cycle-slideshow home-slides">';
			$content_slider .= '<div class="cycle-slideshow" id="uc-img-slider" data-cycle-fx=fadeout data-cycle-timeout=5000 data-cycle-pause-on-hover=true data-cycle-auto-height=container data-cycle-caption-plugin=caption2 data-cycle-overlay-fx-out=fadeOut data-cycle-overlay-fx-in=fadeIn data-cycle-log=false>';
				$content_slider .= '<div class="cycle-prev glyphicon glyphicon-chevron-left"></div>';
				$content_slider .= '<div class="cycle-next glyphicon glyphicon-chevron-right"></div>';
				$content_slider .= '<div class="cycle-overlay"></div>';

	            foreach ($get_uc_image_slider as $key => $value) {
	            	if(!empty($value)){
	            		if(get_theme_mod('uc_desc_overlay')){
							if(get_theme_mod('uc_link_overlay') && !empty(get_theme_mod('uc_link_overlay')[$key])){
								$content_overlay = '<a href="'.esc_url(get_theme_mod('uc_link_overlay')[$key]).'" target="_blank" class="overlay_link">'.esc_html(get_theme_mod('uc_desc_overlay')[$key]).'</a>';
							} else {
								if(!empty(get_theme_mod('uc_desc_overlay')[$key])):
		                        	$content_overlay = esc_html(get_theme_mod('uc_desc_overlay')[$key]);
		                    	endif;
							}
						} else {
							$content_overlay = '';
						}
	            		$content_img .= '<img id="slider-'.$key.'" class="header-images" src="'.$value.'" data-cycle-title="'.esc_html($content_overlay).'" data-cycle-desc="">';
	            	}	
	            }
	            $content_slider .= $content_img;
			$content_slider .= '</div>';
		$content_slider .= '</div>';
	}
	return $content_slider;	
}
// the excerpt
function unified_excerpt_more( $more, $req_form = false ) {
	global $post;
	// edit here if you like
	return '...<p><a class="btn btn-default" role="button" href="'. get_permalink( $post->ID ) . '" title="'. __( 'Read ', 'unified' ) . esc_attr( get_the_title( $post->ID ) ).'">'. __( 'read more »', 'unified' ) .'</a></p>';
}
add_filter( 'excerpt_more', 'unified_excerpt_more' );

function isacustom_excerpt_length($length) {
	global $post;
		return 100;
}
add_filter('excerpt_length', 'isacustom_excerpt_length');

get_header(); ?>


<div id="primarys" class="site-contents templates2 row">

<?php
while ( have_posts() ) : the_post();
    $images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) ); 
endwhile;

?>
<?php 
	$sticky = get_option('sticky_posts');
	if (!empty($sticky)) {
	    rsort($sticky);
	    $args = array(
	        'post__in' => $sticky
	    );
	    query_posts($args);
	    echo '<div class="box-car box-car-half col-md-8">';
	    echo ucctwo_get_slider_img();
    	echo '</div>';
	    echo '<div class="sticky-box col-md-4">';
	    while (have_posts()) {
	         the_post();
	         the_excerpt();
	    }
	    echo '</div>';
	} else {
		echo '<div class="box-car box-car-half col-md-12">';
		echo ucctwo_get_slider_img();
    	echo '</div>';
	}
?>
</div><!-- #primary -->
<div class="row hidden-md hidden-lg hidden-xl"></div>
<div class="sidebar-tmp2 row"><div class="col-md-12"><?php dynamic_sidebar( 'sidebar-ucctwo' ); ?></div></div>
</article>
<?php get_footer(); ?>