<?php

/***** ASC Recent Comments *****/

class asc_comments extends WP_Widget {
    function __construct() {
		parent::__construct(
			'asc_comments', esc_html_x('ASC Recent Comments', 'widget name', 'asc'),
			array(
				'classname' => 'asc_comments',
				'description' => esc_html__('ASC Recent Comments widget to display your recent comments including user avatars.', 'asc'),
				'customize_selective_refresh' => true
			)
		);
	}
    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        $number = empty($instance['number']) ? '5' : $instance['number'];
        $offset = empty($instance['offset']) ? '' : $instance['offset'];
		echo $before_widget;
       		if (!empty($title)) { echo $before_title . $title . $after_title; } ?>
	   		<ul class="user-widget widget-list row clearfix"><?php
	   			$comments = get_comments(array('number' => $number, 'offset' => $offset, 'status' => 'approve', 'type' => 'comment'));
	   			if ($comments) {
	   				foreach ($comments as $comment) { ?>
	   					<li class="uw-wrap clearfix">
	   						<div class="uw-avatar">
		   						<a href="<?php echo get_permalink($comment->comment_post_ID) . '#comment-' . $comment->comment_ID; ?>" title="<?php echo $comment->comment_author; ?>">
			   						<?php echo get_avatar($comment->comment_author_email, 64); ?>
			   					</a>
			   				</div>
			   				<div class="uw-text">
				   				<?php printf(_x('%1$s on %2$s', 'comment widget', 'asc'), $comment->comment_author, ''); ?>
				   				<a href="<?php echo get_permalink($comment->comment_post_ID) . '#comment-' . $comment->comment_ID; ?>" title="<?php echo $comment->comment_author . ' | ' . get_the_title($comment->comment_post_ID); ?>">
					   				<?php echo get_the_title($comment->comment_post_ID); ?>
					   			</a>
					   		</div>
					   	</li><?php
					}
				} ?>
        	</ul><?php
        echo $after_widget;
    }
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['number'] = absint($new_instance['number']);
        $instance['offset'] = absint($new_instance['offset']);
        return $instance;
    }
    function form($instance) {
        $defaults = array('title' => esc_html__('Recent Comments', 'asc'), 'number' => '5', 'offset' => '0');
        $instance = wp_parse_args((array) $instance, $defaults); ?>
        <p>
        	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'asc'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['title']); ?>" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" />
        </p>
        <p>
        	<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Limit Comment Number:', 'asc'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['number']); ?>" name="<?php echo $this->get_field_name('number'); ?>" id="<?php echo $this->get_field_id('number'); ?>" />
	    </p>
	    <p>
        	<label for="<?php echo $this->get_field_id('offset'); ?>"><?php _e('Skip Comments (Offset):', 'asc'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['offset']); ?>" name="<?php echo $this->get_field_name('offset'); ?>" id="<?php echo $this->get_field_id('offset'); ?>" />
	    </p><?php
    }
}

?>