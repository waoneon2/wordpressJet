<?php
/*
Template Name: Archive Posts
*/

global $wpdb;
?>
<?php get_header();

$catID = get_field('category_id');

?>

<?php $source = trim( get_post_meta($post->ID, "banner_image", true) );
if( !empty( $source ) ) : ?>
	<div class="category-header" style="background-image: url('<?php //the_field('banner_image');  ?>/wp-content/uploads/2014/01/default-banner.jpg');">
<?php else :?>
	<div class="category-header" style="background-image: url('/wp-content/uploads/2014/01/default-banner.jpg');">
<?php endif; ?>

	<div class="wrapper clearfix">
		<h1 class="category-title"><?php echo get_the_title(); ?></h1>

	</div></div>
	<div class="category-header gradient">
		<div class="wrapper clearfix">
			<h1 class="category-title"><?php echo get_the_title(); ?></h1>
		</div>
	</div>

	<div class="wrapper clearfix">
		<div id="primary" class="content-area">
			<div id="content" class="site-content" role="main">
				<?php

				if ( function_exists( 'sharing_display' ) ) {
					sharing_display( '', true );
				}

				if ( class_exists( 'Jetpack_Likes' ) ) {
					$custom_likes = new Jetpack_Likes;
					echo $custom_likes->post_likes( '' );
				}

				?>
				<?php /* The loop */

				$months = array(
						"12" => "December",
						"11" => "November",
						"10" => "October",
						"09" => "September",
						"08" => "August",
						"07" => "July",
						"06" => "June",
						"05" => "May",
						"04" => "April",
						"03" => "March",
						"02" => "February",
						"01" => "January",
				);


				foreach($months as $month=>$monthName) {

					$today = getdate();
					$media_coverage_args = array(
							'tax_query' => array(
									array(
											'taxonomy' => 'category',
											'field' => 'id',
											'terms' => $catID
									)
							),
							'date_query' => array(
									array(
											'year'  => $today["year"],
											'month' => $month
									),
							),
							
							'posts_per_page' => -1
					);

					$media_coverage_query = new WP_Query( $media_coverage_args );


					if($media_coverage_query->have_posts()): ?>
						<b><?php echo $monthName; ?></b><br /><br />
						<section class="posts-list">
							<ul class="no-style">
								<?php while ( $media_coverage_query->have_posts() ) : $media_coverage_query->the_post(); ?>
									<li class="item bullet">
										<h1><a href="<?php the_permalink(); ?>"><i><?php if($publicationName = get_field('publication_name')) : ?> <?php echo $publicationName . ','; endif; ?></i> <?php $mediaCoverageDate = get_the_date(); echo $mediaCoverageDate; ?></a><span style="font-weight: normal">,</span> <a href="<?php the_permalink(); ?>" class="blue-link"><?php the_title(); ?></a></h1>
									</li>
								<?php endwhile; ?>
							</ul>
						</section>
						<?php
						wp_reset_query();
					endif;
				}
				?>
				<br /><br />
				<h2>Archives</h2>
				<ul class="archivelist">
					<?php /* The loop */

					function theme_get_archives_link ( $link_html ) {
						global $wp;
						if ( stristr( $link_html, date("Y") ) !== false ) {
							$link_html = preg_replace( '/(<[^\s>]+)/', '\1 style="display:none;"', $link_html, 1 );
						}
						return $link_html;
					}
					add_filter('get_archives_link', 'theme_get_archives_link');

					wp_get_archives(
							array(
									'type' => 'yearly',
									'show_post_count' => 1,
									'cat' => $catID ,
									'before' => get_the_title(). ' for '
							)
					);

					?>
				</ul>

			</div><!-- #content -->
		</div><!-- #primary -->

		<?php get_sidebar(); ?>

	</div>

<?php get_footer(); ?>