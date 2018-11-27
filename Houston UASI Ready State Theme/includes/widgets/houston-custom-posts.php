<?php

/***** Houston UASI Custom Posts *****/

class houston_uasi_custom_posts extends WP_Widget {
    function __construct() {
		parent::__construct(
			'houston_uasi_custom_posts', esc_html_x('Houston UASI Custom Posts', 'widget name', 'houston-uasi'),
			array(
				'classname' => 'houston_uasi_custom_posts',
				'description' => esc_html__('Display posts from any category or tag.', 'houston-uasi'),
				'customize_selective_refresh' => true
			)
		);
	}
    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        $category = isset($instance['category']) ? $instance['category'] : '';
        $cats = empty($instance['cats']) ? '' : $instance['cats'];
        $tags = empty($instance['tags']) ? '' : $instance['tags'];
        $postcount = empty($instance['postcount']) ? '5' : $instance['postcount'];
        $offset = empty($instance['offset']) ? '' : $instance['offset'];
        $order = isset($instance['order']) ? $instance['order'] : 'date';
        $excerpt = isset($instance['excerpt']) ? $instance['excerpt'] : 'first';
        $link = empty($instance['link']) ? '' : $instance['link'];
        $sticky = isset($instance['sticky']) ? $instance['sticky'] : 1;
        $houston_uasi_options = houston_uasi_theme_options();
        $post_date = !$houston_uasi_options['post_meta_date'];
        $date = isset($instance['date']) ? $instance['date'] : 0;
        if ($link) {
	        $before_title = $before_title . '<a href="' . esc_url($link) . '" class="widget-title-link">';
	        $after_title = '</a>' . $after_title;
        } elseif ($category) {
        	$cat_url = get_category_link($category);
	        $before_title = $before_title . '<a href="' . esc_url($cat_url) . '" class="widget-title-link">';
	        $after_title = '</a>' . $after_title;
        }
        if ($cats) {
	    	$category = $category . ', ' . $cats;
        }
        echo $before_widget;
        	if (!empty($title)) { echo $before_title . esc_attr($title) . $after_title; }
			$args = array('posts_per_page' => $postcount, 'offset' => $offset, 'cat' => $category, 'tag' => $tags, 'orderby' => $order, 'ignore_sticky_posts' => $sticky);
			$counter = 1;
			$widget_loop = new WP_Query($args); ?>
			<div class="houston-cp-widget clearfix"><?php
				while ($widget_loop->have_posts()) : $widget_loop->the_post();
					if ($counter == 1 && $excerpt == 'first' || $excerpt == 'all') : ?>
						<article class="cp-wrap cp-large clearfix">
							<div class="cp-thumb-xl">
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php
									if (has_post_thumbnail()) {
										the_post_thumbnail('cp-thumb-xl');
									} else {
										echo '<img class="houston-image-placeholder" src="' . get_template_directory_uri() . '/images/placeholder-thumb-xl.jpg' . '" alt="No Picture" />';
									} ?>
								</a>
							</div>
							<?php if ($date == 0 && $post_date) { ?>
								<p class="entry-meta">
									<span class="updated"><?php echo get_the_date(); ?></span>
								</p>
							<?php } ?>
							<h3 class="cp-title-xl">
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
									<?php the_title(); ?>
								</a>
							</h3>
							<div class="cp-excerpt-xl">
								<?php the_excerpt(); ?>
								<?php houston_uasi_more(); ?>
							</div>
						</article>
						<hr class="houston-separator"><?php
					else : ?>
						<article class="cp-wrap cp-small clearfix">
							<div class="cp-thumb-small">
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php
									if (has_post_thumbnail()) {
										the_post_thumbnail('cp-thumb-small');
									} else {
										echo '<img class="houston-image-placeholder" src="' . get_template_directory_uri() . '/images/placeholder-thumb-small.jpg' . '" alt="No Picture" />';
									} ?>
								</a>
							</div>
							<?php if ($date == 0 && $post_date) { ?>
								<p class="entry-meta"><span class="updated"><?php echo get_the_date(); ?></span></p>
							<?php } ?>
							<h3 class="cp-title-small">
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
									<?php the_title(); ?>
								</a>
							</h3>
						</article>
						<hr class="houston-separator"><?php
					endif;
					$counter++;
				endwhile;
				wp_reset_postdata(); ?>
			</div><?php
		echo $after_widget;
    }
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['category'] = absint($new_instance['category']);
        $instance['cats'] = strip_tags($new_instance['cats']);
        $instance['tags'] = strip_tags($new_instance['tags']);
        $instance['postcount'] = absint($new_instance['postcount']);
        $instance['offset'] = absint($new_instance['offset']);
        $instance['order'] = strip_tags($new_instance['order']);
        $instance['excerpt'] = strip_tags($new_instance['excerpt']);
        $instance['link'] = esc_url_raw($new_instance['link']);
        $instance['sticky'] = (!empty($new_instance['sticky'])) ? 1 : 0;
        $instance['date'] = (!empty($new_instance['date'])) ? 1 : 0;
        return $instance;
    }
    function form($instance) {
        $defaults = array('title' => '', 'category' => '', 'cats' => '', 'tags' => '', 'postcount' => '5', 'offset' => '0', 'order' => 'date', 'excerpt' => 'first', 'link' => '', 'sticky' => 1, 'date' => 0);
        $instance = wp_parse_args((array) $instance, $defaults); ?>
        <p>
        	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'houston-uasi'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['title']); ?>" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" />
        </p>
        <p>
			<label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Select a Category:', 'houston-uasi'); ?></label>
			<select id="<?php echo $this->get_field_id('category'); ?>" class="widefat" name="<?php echo $this->get_field_name('category'); ?>">
				<option value="0" <?php if (!$instance['category']) echo 'selected="selected"'; ?>><?php _e('All', 'houston-uasi'); ?></option>
				<?php
				$categories = get_categories(array('type' => 'post'));
				foreach($categories as $cat) {
					echo '<option value="' . $cat->cat_ID . '"';
					if ($cat->cat_ID == $instance['category']) { echo ' selected="selected"'; }
					echo '>' . $cat->cat_name . ' (' . $cat->category_count . ')';
					echo '</option>';
				}
				?>
			</select>
		</p>
		<p>
        	<label for="<?php echo $this->get_field_id('cats'); ?>"><?php _e('Multiple Categories Filter by ID:', 'houston-uasi'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['cats']); ?>" name="<?php echo $this->get_field_name('cats'); ?>" id="<?php echo $this->get_field_id('cats'); ?>" />
	    </p>
		<p>
        	<label for="<?php echo $this->get_field_id('tags'); ?>"><?php _e('Filter Posts by Tags (e.g. lifestyle):', 'houston-uasi'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['tags']); ?>" name="<?php echo $this->get_field_name('tags'); ?>" id="<?php echo $this->get_field_id('tags'); ?>" />
	    </p>
	    <p>
        	<label for="<?php echo $this->get_field_id('postcount'); ?>"><?php _e('Limit Post Number:', 'houston-uasi'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['postcount']); ?>" name="<?php echo $this->get_field_name('postcount'); ?>" id="<?php echo $this->get_field_id('postcount'); ?>" />
	    </p>
	    <p>
        	<label for="<?php echo $this->get_field_id('offset'); ?>"><?php _e('Skip Posts (Offset):', 'houston-uasi'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['offset']); ?>" name="<?php echo $this->get_field_name('offset'); ?>" id="<?php echo $this->get_field_id('offset'); ?>" />
	    </p>
	    <p>
	    	<label for="<?php echo $this->get_field_id('order'); ?>"><?php _e('Post Order:', 'houston-uasi'); ?></label>
			<select id="<?php echo $this->get_field_id('order'); ?>" class="widefat" name="<?php echo $this->get_field_name('order'); ?>">
				<option value="date" <?php if ($instance['order'] == "date") { echo "selected='selected'"; } ?>><?php _e('Latest Posts', 'houston-uasi') ?></option>
				<option value="rand" <?php if ($instance['order'] == "rand") { echo "selected='selected'"; } ?>><?php _e('Random Posts', 'houston-uasi') ?></option>
				<option value="comment_count" <?php if ($instance['order'] == "comment_count") { echo "selected='selected'"; } ?>><?php _e('Popular Posts', 'houston-uasi') ?></option>
			</select>
        </p>
        <p>
	    	<label for="<?php echo $this->get_field_id('excerpt'); ?>"><?php _e('Display Excerpts:', 'houston-uasi'); ?></label>
			<select id="<?php echo $this->get_field_id('excerpt'); ?>" class="widefat" name="<?php echo $this->get_field_name('excerpt'); ?>">
				<option value="first" <?php if ($instance['excerpt'] == "first") { echo "selected='selected'"; } ?>><?php _e('Excerpt for first Post', 'houston-uasi') ?></option>
				<option value="all" <?php if ($instance['excerpt'] == "all") { echo "selected='selected'"; } ?>><?php _e('Excerpt for all Posts', 'houston-uasi') ?></option>
				<option value="none" <?php if ($instance['excerpt'] == "none") { echo "selected='selected'"; } ?>><?php _e('Display no Excerpts', 'houston-uasi') ?></option>
			</select>
        </p>
	    <p>
        	<label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Link Title to custom URL (optional):', 'houston-uasi'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_url($instance['link']); ?>" name="<?php echo $this->get_field_name('link'); ?>" id="<?php echo $this->get_field_id('link'); ?>" />
        </p>
        <p>
      		<input id="<?php echo $this->get_field_id('sticky'); ?>" name="<?php echo $this->get_field_name('sticky'); ?>" type="checkbox" value="1" <?php checked('1', $instance['sticky']); ?>/>
	  		<label for="<?php echo $this->get_field_id('sticky'); ?>"><?php _e('Ignore Sticky Posts', 'houston-uasi'); ?></label>
    	</p>
    	<p>
      		<input id="<?php echo $this->get_field_id('date'); ?>" name="<?php echo $this->get_field_name('date'); ?>" type="checkbox" value="1" <?php checked('1', $instance['date']); ?>/>
	  		<label for="<?php echo $this->get_field_id('date'); ?>"><?php _e('Hide Date', 'houston-uasi'); ?></label>
    	</p><?php
    }
}

?>