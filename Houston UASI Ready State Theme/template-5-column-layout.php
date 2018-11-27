<?php /* Template Name: 5 Column layout */ ?>
<?php get_header(); ?>
<div class="home houston-section houston-group">
	<div id="main-content" class="home-columns">
		<?php dynamic_sidebar('template-51'); ?>
		<?php if (is_active_sidebar('template-52') || is_active_sidebar('template-53')) : ?>
			<div class="houston-section houston-group">
				<?php if (is_active_sidebar('template-52')) { ?>
					<div class="houston-col houston-1-2 home-2">
						<?php dynamic_sidebar('template-52'); ?>
					</div>
				<?php } ?>
				<?php if (is_active_sidebar('template-53')) { ?>
					<div class="houston-col houston-1-2 home-3">
						<?php dynamic_sidebar('template-53'); ?>
					</div>
				<?php } ?>
			</div>
		<?php endif; ?>
		<?php dynamic_sidebar('template-54'); ?>
	</div>
	<aside class="home-sidebar">
		<?php dynamic_sidebar('template-55'); ?>
	</aside>
</div>
<?php get_footer(); ?>