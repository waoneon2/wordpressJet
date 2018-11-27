<?php

/***** ASC Authors *****/

class asc_authors extends WP_Widget {
    function __construct() {
		parent::__construct(
			'asc_authors', esc_html_x('ASC Authors', 'widget name', 'asc'),
			array(
				'classname' => 'asc_authors',
				'description' => esc_html__('ASC Authors widget to display a list of authors including the number of published posts.', 'asc'),
				'customize_selective_refresh' => true
			)
		);
	}
    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        $authorcount = empty($instance['authorcount']) ? '5' : $instance['authorcount'];
        $offset = empty($instance['offset']) ? '' : $instance['offset'];
        $role = isset($instance['role']) ? $instance['role'] : '';
        $orderby = isset($instance['orderby']) ? $instance['orderby'] : 'post_count';
        $order = isset($instance['order']) ? $instance['order'] : 'DESC';
        echo $before_widget;
        	if (!empty($title)) { echo $before_title . $title . $after_title; } ?>
			<ul class="user-widget widget-list row clearfix"><?php
				$args = array('number' => $authorcount, 'offset' => $offset, 'role' => $role, 'orderby' => $orderby, 'order' => $order);
				$wp_user_query = new WP_User_Query($args);
				$authors = $wp_user_query->get_results();
				if (!empty($authors)) {
					foreach ($authors as $author) {
						$author_ID = $author->ID; ?>
						<li class="uw-wrap clearfix">
							<div class="uw-avatar">
								<a href="<?php echo get_author_posts_url($author_ID); ?>" title="<?php printf(__('Articles by %s', 'asc'), $author->display_name); ?>">
									<?php echo get_avatar($author_ID, 64); ?>
								</a>
							</div>
							<div class="uw-text">
								<a href="<?php echo get_author_posts_url($author_ID); ?>" title="<?php printf(__('Articles by %s', 'asc'), $author->display_name); ?>" class="author-name">
									<?php echo $author->display_name; ?>
								</a>
								<p class="uw-data">
									<?php printf(_x('published %d articles', 'author post count', 'asc'), count_user_posts($author_ID)); ?>
								</p>
							</div>
						</li><?php
					}
				} else {
					_e('No authors found', 'asc');
				} ?>
			</ul><?php
        echo $after_widget;
    }
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['authorcount'] = absint($new_instance['authorcount']);
        $instance['offset'] = absint($new_instance['offset']);
        $instance['role'] = strip_tags($new_instance['role']);
        $instance['orderby'] = strip_tags($new_instance['orderby']);
        $instance['order'] = strip_tags($new_instance['order']);
        return $instance;
    }
    function form($instance) {
        $defaults = array('title' => __('Authors', 'asc'), 'authorcount' => '5', 'offset' => '0', 'role' => '', 'orderby' => 'post_count', 'order' => 'DESC');
        $instance = wp_parse_args((array) $instance, $defaults); ?>
        <p>
        	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'asc'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['title']); ?>" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" />
        </p>
        <p>
        	<label for="<?php echo $this->get_field_id('authorcount'); ?>"><?php _e('Limit Author Number:', 'asc'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['authorcount']); ?>" name="<?php echo $this->get_field_name('authorcount'); ?>" id="<?php echo $this->get_field_id('authorcount'); ?>" />
	    </p>
	    <p>
        	<label for="<?php echo $this->get_field_id('offset'); ?>"><?php _e('Skip Authors (Offset):', 'asc'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['offset']); ?>" name="<?php echo $this->get_field_name('offset'); ?>" id="<?php echo $this->get_field_id('offset'); ?>" />
	    </p>
	    <p>
	    	<label for="<?php echo $this->get_field_id('role'); ?>"><?php _e('User Role:', 'asc'); ?></label>
			<select id="<?php echo $this->get_field_id('role'); ?>" class="widefat" name="<?php echo $this->get_field_name('role'); ?>">
				<option value="" <?php if ($instance['role'] == "") { echo "selected='selected'"; } ?>><?php _e('All Users', 'asc') ?></option>
				<option value="administrator" <?php if ($instance['role'] == "administrator") { echo "selected='selected'"; } ?>><?php _e('Administrator', 'asc') ?></option>
				<option value="editor" <?php if ($instance['role'] == "editor") { echo "selected='selected'"; } ?>><?php _e('Editor', 'asc') ?></option>
				<option value="author" <?php if ($instance['role'] == "author") { echo "selected='selected'"; } ?>><?php _e('Author', 'asc') ?></option>
				<option value="contributor" <?php if ($instance['role'] == "contributor") { echo "selected='selected'"; } ?>><?php _e('Contributor', 'asc') ?></option>
				<option value="subscriber" <?php if ($instance['role'] == "subscriber") { echo "selected='selected'"; } ?>><?php _e('Subscriber', 'asc') ?></option>
			</select>
        </p>
        <p>
	    	<label for="<?php echo $this->get_field_id('orderby'); ?>"><?php _e('Order Authors by:', 'asc'); ?></label>
			<select id="<?php echo $this->get_field_id('orderby'); ?>" class="widefat" name="<?php echo $this->get_field_name('orderby'); ?>">
				<option value="post_count" <?php if ($instance['orderby'] == "post_count") { echo "selected='selected'"; } ?>><?php _e('Number of Posts', 'asc') ?></option>
				<option value="display_name" <?php if ($instance['orderby'] == "display_name") { echo "selected='selected'"; } ?>><?php _e('User Name', 'asc') ?></option>
			</select>
        </p>
        <p>
	    	<label for="<?php echo $this->get_field_id('order'); ?>"><?php _e('Order:', 'asc'); ?></label>
			<select id="<?php echo $this->get_field_id('order'); ?>" class="widefat" name="<?php echo $this->get_field_name('order'); ?>">
				<option value="ASC" <?php if ($instance['order'] == "ASC") { echo "selected='selected'"; } ?>><?php _e('Ascending', 'asc') ?></option>
				<option value="DESC" <?php if ($instance['order'] == "DESC") { echo "selected='selected'"; } ?>><?php _e('Descending', 'asc') ?></option>
			</select>
        </p><?php
    }
}

?>