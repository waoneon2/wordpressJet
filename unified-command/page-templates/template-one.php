<?php
/**
 * Template Name: Template #1
 */
get_header('templateone');
$args = array(
    'order' => 'DESC',
	// 'post_type' => 'page'
);

$rp = new WP_Query( $args );
?>

<style type="text/css">
.widget {
    -webkit-box-shadow: 0 2px 6px rgba(100, 100, 100, 0.3);
    -moz-box-shadow: 0 2px 6px rgba(100, 100, 100, 0.3);
    box-shadow: 0 2px 6px rgba(100, 100, 100, 0.3);
    padding: 20px;
}
div#menunav_container_id {
	-webkit-box-shadow: 0 2px 6px rgba(100, 100, 100, 0.3);
    -moz-box-shadow: 0 2px 6px rgba(100, 100, 100, 0.3);
    box-shadow: 0 2px 6px rgba(100, 100, 100, 0.3);
}
a#link_logo_client img {
	width: auto;
    max-width: 100px;
    height: 65px;
}
a#link_logo_client {
	float: left;
}
a#link_logo_client:not(:last-child) {
    margin-right: 10px;
}

@media screen and (max-width: 710px){
	a#link_logo_client img {
		width: auto;
		max-width: 100px;
		height: 50px;
	}

	h1.site-title {
		font-size: 20px;
	}
	h2.site-description
	{
		font-size: 10px;
	}
}

@media screen and (max-width: 610px){
	a#link_logo_client img {
		width: auto;
		max-width: 100px;
		height: 45px;
	}

	h1.site-title {
		font-size: 17px;
	}
	h2.site-description
	{
		font-size: 7px;
	}
}

@media screen and (max-width: 599px){
	div#each_logo_client{
		display:none;
	}

	h1.site-title {
		font-size: 20px;
	}
	
	h2.site-description
	{
		font-size: 10px;
	}
}

@media screen and (min-width: 600px){
	.widget-area {
    	width: 35%;
	}
	.site-content {
    	width: 60%;
	}
	.main-navigation .current-menu-item > a {
    	color: white;
	}
	.main-navigation li a {
		padding-left: 5px;
		color: white;
	}
	.main-navigation li a:hover {
    	color: #ccc;
	}
	a#site-logo {
		float: left;
		width: 65%;
	}
	hgroup {
		float: right;
		position: relative;
	}
	h1.site-title,
	h2.site-description{
		text-align: right;
	}
	.main-navigation {
        margin-top: 80px;
        margin-top: 5.714286rem;
        text-align: center;
    }
	
	div#each_logo_client {
		overflow: hidden;
		display: inline;
	}
}
</style>

<div id="primary" class="site-content templateone">
		<div id="content" role="main">
        
		<?php if ($rp->have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( $rp->have_posts() ) : $rp->the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>

			<?php twentytwelve_content_nav( 'nav-below' ); ?>

		<?php else : ?>

			<article id="post-0" class="post no-results not-found">

			<?php if ( current_user_can( 'edit_posts' ) ) :
				// Show a different message to a logged-in user who can add posts.
			?>
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'No posts to display', 'twentytwelve' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php printf( __( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'twentytwelve' ), admin_url( 'post-new.php' ) ); ?></p>
				</div><!-- .entry-content -->

			<?php else :
				// Show the default message to everyone else.
			?>
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Nothing Found', 'twentytwelve' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php _e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'twentytwelve' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			<?php endif; // end current_user_can() check ?>

			</article><!-- #post-0 -->

		<?php endif; // end have_posts() check ?>

		</div><!-- #content -->
</div><!-- #primary -->

<?php get_sidebar('templateone'); ?>
<?php get_footer(); ?>