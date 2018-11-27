<?php /* Template Name: Sitemap */ ?>
<?php get_header(); ?>
<?php asc_before_page_content(); ?>
<?php asc_page_title(); ?>
<div class="sitemap asc-section asc-group">
	<div class="asc-col asc-1-3">
		<h4 class="widget-title">
			<span><?php esc_html_e('Recent Articles', 'asc'); ?></span>
		</h4>
		<ul class="sitemap-list widget-list"><?php
			$args = array('posts_per_page' => 10);
			$recent = new WP_query($args);
			while ($recent->have_posts()) : $recent->the_post(); ?>
				<li>
					<a href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
					</a>
				</li><?php
			endwhile;
			wp_reset_postdata(); ?>
		</ul>
		<h4 class="widget-title">
			<span><?php esc_html_e('Pages', 'asc'); ?></span>
		</h4>
		<ul class="sitemap-list widget-list"><?php
			$args = array('title_li' => '', 'post_status' => 'publish');
			wp_list_pages($args); ?>
		</ul>
	</div>
	<div class="asc-col asc-1-3">
		<h4 class="widget-title">
			<span><?php esc_html_e('Archives', 'asc'); ?></span>
		</h4>
		<ul class="sitemap-list widget-list">
			<?php wp_get_archives('type=monthly&show_post_count=1'); ?>
		</ul>
	</div>
	<div class="asc-col asc-1-3">
		<h4 class="widget-title">
			<span><?php esc_html_e('Categories', 'asc'); ?></span>
		</h4>
		<ul class="sitemap-list widget-list"><?php
			$args = array('title_li' => '', 'feed' => 'RSS', 'show_option_none' => __('No categories', 'asc'));
			wp_list_categories($args); ?>
		</ul>
	</div>
</div>
<?php get_footer(); ?>