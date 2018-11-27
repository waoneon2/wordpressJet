<?php
/**
 * Template Name: 3 Column Page
 */
get_header();
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div id="bodyContent" class="clearfix">
			<div class="headline_wrapper">
				<h1 class="headline"><?php the_title();?></h1>
			</div>
			<div id="homepageContent" class="clearfix">
				<div class="row">
					<div class="col-md-8">
						<div class="row">
							<?php get_sidebar('column-page'); ?>
						</div>
					</div>
					<div class="col-md-4">
						<?php get_sidebar() ?>
					</div>
				</div>
			</div> <!-- #homepageContent -->
		</div> <!-- #bodycontent -->
	</main><!-- #main -->
</div><!-- #primary -->

<?php

get_footer();

