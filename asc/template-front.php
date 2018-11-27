<?php /* Template Name: Homepage */ ?>
<?php get_header(); ?>
<div class="home asc-section asc-group">
	<div id="main-content" class="home-columns">
		<?php dynamic_sidebar('home-1'); ?>
		<?php if (is_active_sidebar('home-2') || is_active_sidebar('home-3')) : ?>
			<div class="asc-section asc-group">
				<?php if (is_active_sidebar('home-2')) { ?>
					<div class="asc-col asc-1-2 home-2">
						<?php dynamic_sidebar('home-2'); ?>
					</div>
				<?php } ?>
				<?php if (is_active_sidebar('home-3')) { ?>
					<div class="asc-col asc-1-2 home-3">
						<?php dynamic_sidebar('home-3'); ?>
					</div>
				<?php } ?>
			</div>
		<?php endif; ?>
		<?php dynamic_sidebar('home-4'); ?>
	</div>
	<aside class="home-sidebar">
		<?php dynamic_sidebar('home-5'); ?>
	</aside>
</div>
<?php get_footer(); ?>