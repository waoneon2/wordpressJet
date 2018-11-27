<?php /* Template for displaying the author box content on posts */
$author_ID = get_the_author_meta('ID'); ?>
<div class="houston-author-box">
	<h4 class="widget-title houston-author-box-title">
		<span><?php esc_html_e('About the Author', 'houston-uasi'); ?></span>
	</h4>
	<div class="author-box clearfix">
		<div class="author-box-avatar">
			<a href="<?php echo esc_url(get_author_posts_url($author_ID)); ?>">
				<?php echo get_avatar($author_ID, 100); ?>
			</a>
		</div>
		<h5 class="author-box-name">
			<a href="<?php echo esc_url(get_author_posts_url($author_ID)); ?>">
				<?php echo esc_attr(get_the_author_meta('display_name', $author_ID)); ?>
			</a>
		</h5>
		<div class="author-box-desc">
			<?php echo wp_kses_post(get_the_author_meta('description', $author_ID)); ?>
		</div>
	</div>
</div>