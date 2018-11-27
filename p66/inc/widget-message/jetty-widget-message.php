<?php

/**
 * Adds widget_twitter_feed widget.
 */
class Jetty_Widget_Message extends WP_Widget
{
	/**
	 * Register widget with WordPress.
	 */
	function __construct()
	{
		parent::__construct(
			'jetty_widget_message',
			__('Jetty Message', 'jetty'),
			array( 'description' => __( 'This widget for display message widget', 'jetty' ), )
		);
	}
	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */

	public function widget( $args, $instance )
	{
		global $post;

		echo $args['before_widget'];
		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

		$message 	= apply_filters('widget_title', empty($instance['message']) ? '' : $instance['message']);
		$page 		= apply_filters('widget_title', empty($instance['page']) ? '' : $instance['page']);
		$type 		= apply_filters('widget_title', empty($instance['type']) ? '' : $instance['type']);
		?>

		<?php if ($post->ID == $page): ?>
			<div class="contained">
				<div class="row alert <?php echo ($type == 0) ? 'alert-success' : 'alert-fail' ?>">
					<?php echo ($type == 0) ? '' : '<i class="glyphicon glyphicon-exclamation-sign"></i>' ?>
					<?php echo $message ?>
				</div>
			</div>
		<?php endif ?>

		<?php

		echo $args['after_widget'];
	}
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {

		$title 		= ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : 'tess';
		$message 	= ( isset( $instance[ 'message' ] ) ) ? $instance[ 'message' ] : '';
		$page 		= ( isset( $instance[ 'page' ] ) ) ? $instance[ 'page' ] : '';
		$type 		= ( isset( $instance[ 'type' ] ) ) ? $instance[ 'type' ] : '';

		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( ' ', 'jetty' );
		}

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'jetty'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'message' ); ?>"><?php _e('Message', 'jetty'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'message' ); ?>" name="<?php echo $this->get_field_name( 'message' ); ?>" type="text" value="<?php echo esc_attr( $message ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'page' ); ?>"><?php _e('Select refinery page for this widget', 'jetty'); ?></label><br />
			<?php
				$drop_page = wp_dropdown_pages(
					array(
						'selected' => $page,
						'name' => $this->get_field_name( 'page' ),
						'id' => $this->get_field_id( 'page' ),
						'class' => 'refinery-select-page',
						'meta_key' => '_wp_page_template',
						'meta_value' => 'template-refinary.php',
						'post_type' => 'page'
					)
				);
			?>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'type' ); ?>"><?php _e('Select type of message', 'jetty'); ?></label><br />
			<select name="<?php echo $this->get_field_name( 'type' ); ?>" id="<?php echo $this->get_field_id( 'type' ); ?>">
				<option value="0">Success</option>
				<option value="1" <?php echo ($type == 1) ? 'selected' : '' ?>>Fail</option>
			</select>
		</p>
		<?php

	}


	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$new_instance = wp_parse_args((array) $new_instance, array( 'title' => '', 'message' => '', 'page' => -1, 'type' => 0));

		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['message'] = sanitize_text_field($new_instance['message']);
		$instance['page'] = (int) $new_instance['page'];
		$instance['type'] = (int) $new_instance['type'];

		return $instance;
	}

}
