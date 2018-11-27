<?php

/***** Houston UASI Facebook Page *****/

class houston_uasi_facebook_page extends WP_Widget {
	function __construct() {
		parent::__construct(
			'houston_uasi_facebook_page', esc_html_x('Houston UASI Facebook Page', 'widget name', 'houston-uasi'),
			array('classname' => 'houston_uasi_facebook_page', 'description' => esc_html__('Widget to display your Facebook page on your website.', 'houston-uasi'))
		);
	}
    function widget($args, $instance) {
    	$defaults = array('title' => esc_html__('Follow on Facebook', 'houston-uasi'), 'fb_url' => 'https://www.facebook.com/MHthemes', 'width' => 373, 'height' => 500, 'cover' => 0, 'faces' => 1, 'posts' => 0);
		$instance = wp_parse_args($instance, $defaults);

        echo $args['before_widget'];
			if (!empty($instance['title'])) {
				echo $args['before_title'] . esc_html(apply_filters('widget_title', $instance['title'])) . $args['after_title'];
			}
			if (!empty($instance['fb_url'])) {
	    		echo '<div class="fb-page" data-href="' . esc_url($instance['fb_url']) . '" data-width="' . absint($instance['width']) . '" data-height="' . absint($instance['height']) . '" data-hide-cover="' . esc_attr($instance['cover']) . '" data-show-facepile="' . esc_attr($instance['faces']) . '" data-show-posts="' . esc_attr($instance['posts']) . '"></div>'. "\n";
			}
		echo $args['after_widget'];
    }
    function update($new_instance, $old_instance) {
    	$instance = array();
		$instance['title'] = sanitize_text_field($new_instance['title']);
		if (!empty($new_instance['fb_url'])) {
			$instance['fb_url'] = esc_url_raw($new_instance['fb_url']);
		}
		if (!empty($new_instance['width'])) {
			$instance['width'] = absint($new_instance['width']);
		}
		if (!empty($new_instance['height'])) {
			$instance['height'] = absint($new_instance['height']);
		}
		$instance['cover'] = (!empty($new_instance['cover'])) ? 1 : 0;
		$instance['faces'] = (!empty($new_instance['faces'])) ? 1 : 0;
		$instance['posts'] = (!empty($new_instance['posts'])) ? 1 : 0;
        return $instance;
    }
    function form($instance) {
    	$defaults = array('title' => esc_html__('Follow on Facebook', 'houston-uasi'), 'fb_url' => 'https://www.facebook.com/Houston UASIthemes', 'width' => 373, 'height' => 500, 'cover' => 0, 'faces' => 1, 'posts' => 0);
        $instance = wp_parse_args($instance, $defaults); ?>

		<p>
        	<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'houston-uasi'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['title']); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" id="<?php echo esc_attr($this->get_field_id('title')); ?>" />
        </p>
        <p>
        	<label for="<?php echo esc_attr($this->get_field_id('fb_url')); ?>"><?php esc_html_e('Facebook Page URL:', 'houston-uasi'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_url($instance['fb_url']); ?>" name="<?php echo esc_attr($this->get_field_name('fb_url')); ?>" id="<?php echo esc_attr($this->get_field_id('fb_url')); ?>" />
        </p>
       	<p>
	    	<label for="<?php echo esc_attr($this->get_field_id('width')); ?>"><?php esc_html_e('Width (min. 280px):', 'houston-uasi'); ?></label>
			<input type="text" size="2" value="<?php echo esc_attr($instance['width']); ?>" name="<?php echo esc_attr($this->get_field_name('width')); ?>" id="<?php echo esc_attr($this->get_field_id('width')); ?>" /> px
	    </p>
	    <p>
	    	<label for="<?php echo esc_attr($this->get_field_id('height')); ?>"><?php esc_html_e('Height (min. 130px):', 'houston-uasi'); ?></label>
			<input type="text" size="2" value="<?php echo esc_attr($instance['height']); ?>" name="<?php echo esc_attr($this->get_field_name('height')); ?>" id="<?php echo esc_attr($this->get_field_id('height')); ?>" /> px
	    </p>
		<p>
			<input id="<?php echo esc_attr($this->get_field_id('cover')); ?>" name="<?php echo esc_attr($this->get_field_name('cover')); ?>" type="checkbox" value="1" <?php checked(1, $instance['cover']); ?> />
			<label for="<?php echo esc_attr($this->get_field_id('cover')); ?>"><?php esc_html_e('Hide cover photo', 'houston-uasi'); ?></label>
		</p>
		<p>
			<input id="<?php echo esc_attr($this->get_field_id('faces')); ?>" name="<?php echo esc_attr($this->get_field_name('faces')); ?>" type="checkbox" value="1" <?php checked(1, $instance['faces']); ?> />
			<label for="<?php echo esc_attr($this->get_field_id('faces')); ?>"><?php esc_html_e('Show profile photos', 'houston-uasi'); ?></label>
		</p>
		<p>
			<input id="<?php echo esc_attr($this->get_field_id('posts')); ?>" name="<?php echo esc_attr($this->get_field_name('posts')); ?>" type="checkbox" value="1" <?php checked(1, $instance['posts']); ?> />
			<label for="<?php echo esc_attr($this->get_field_id('posts')); ?>"><?php esc_html_e('Show posts from FB page', 'houston-uasi'); ?></label>
		</p><?php
    }
}

?>