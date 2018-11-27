<?php
/**
 * Template Name: Template #2
 */

// the excerpt
function unified_excerpt_more( $more, $req_form = false ) {
	global $post;
	// edit here if you like
	return '...<p><a class="template2-df-button" href="'. get_permalink( $post->ID ) . '" title="'. __( 'Read ', 'unified' ) . esc_attr( get_the_title( $post->ID ) ).'">'. __( 'read more »', 'unified' ) .'</a></p>';
}
add_filter( 'excerpt_more', 'unified_excerpt_more' );
function isacustom_excerpt_length($length) {
	global $post;

		return 100;
}
add_filter('excerpt_length', 'isacustom_excerpt_length');



get_header("templatetwo"); ?>


	<div id="primary" class="site-content template2">
		<div id="content" role="main">

<?php
while ( have_posts() ) : the_post();
        $images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) ); 

endwhile;

?>
			<div class="tmp2-row-one tmp2-row">
				<?php 
					// get sticky posts from DB
					$sticky = get_option('sticky_posts');
					// check if there are any
					if (!empty($sticky)) {
					    // optional: sort the newest IDs first
					    rsort($sticky);
					    // override the query
					    $args = array(
					        'post__in' => $sticky
					    );
					    query_posts($args);
					    // the loop
					    echo '<div class="box-car box-car-half">';
					    echo '<a class="car-btn-left" onclick="plusDivs(-1)">&#10094;</a> <a class="car-btn-right" onclick="plusDivs(1)">&#10095;</a>';
				        if ( $images ) { 
				                //looping through the images
				                foreach ( $images as $attachment_id => $attachment ) {
				               		echo '<div class="mySlides">';
					                echo wp_get_attachment_image( $attachment_id, 'full' ); 
					                echo '<div class="slide-caption">'.$attachment->post_excerpt.'</div>';
					                echo '</div>';
				                }
				        }
					    echo '</div>';
					    echo '<div class="sticky-box">';
					    while (have_posts()) {
					         the_post();
					         // your code
					         the_excerpt();
					    }
					    echo '</div>';
					} else {
						echo '<div class="box-car box-car-full">';
						echo '<a class="car-btn-left" onclick="plusDivs(-1)">&#10094;</a> <a class="car-btn-right" onclick="plusDivs(1)">&#10095;</a>';
				        if ( $images ) { 
				                //looping through the images
				                foreach ( $images as $attachment_id => $attachment ) {
				               		echo '<div class="mySlides">';
					                echo wp_get_attachment_image( $attachment_id, 'full' ); 
					                echo '<div class="slide-caption">'.$attachment->post_excerpt.'</div>';
					                echo '</div>';
				                }
				        }
						echo '</div>';
					}

				?>
			</div>

		</div><!-- #content -->
	</div><!-- #primary -->

<div class="sidebar-tmp2 "><?php dynamic_sidebar( 'sidebar-tmp2' ); ?></div>
<?php get_footer(); ?>


<script>
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function explode() {
  showDivs(slideIndex += 1);

}

setInterval(explode, 4000);

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }
  var aa =slideIndex-1;
  jQuery(".mySlides").eq(aa).fadeIn("slow");
}

jQuery(".cs-search #searchsubmit").prop('value', ' 🔍 ');
jQuery(".cs-search #s").prop('placeholder', 'Search...');

</script>