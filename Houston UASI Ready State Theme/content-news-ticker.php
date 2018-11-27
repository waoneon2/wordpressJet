<?php /* Template for content in news ticker */ ?>
<?php $houston_uasi_options = houston_uasi_theme_options(); ?>
<div id="ticker" class="news-ticker houston-col houston-2-3 clearfix">
	<?php if ($houston_uasi_options['ticker_title']) { ?>
		<span class="ticker-title">
			<?php echo esc_attr($houston_uasi_options['ticker_title']); ?>
		</span>
	<?php } ?>
	<ul class="ticker-content"><?php
		$args = array('posts_per_page' => $houston_uasi_options['ticker_posts'], 'cat' => $houston_uasi_options['ticker_cats'], 'tag' => $houston_uasi_options['ticker_tags'], 'offset' => $houston_uasi_options['ticker_offset'], 'ignore_sticky_posts' => $houston_uasi_options['ticker_sticky']);
		$ticker_loop = new WP_Query($args);
		while ($ticker_loop->have_posts()) : $ticker_loop->the_post(); ?>
			<li class="ticker-item">
				<a class="ticker-item-link" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<span class="ticker-item-date"><?php echo get_the_date(); ?></span>
					<span class="ticker-item-separator">|</span>
					<span class="ticker-item-title"><?php the_title(); ?></span>
				</a>
			</li><?php
		endwhile;
		wp_reset_postdata(); ?>
	</ul>
</div>