<?php

/**
 * Adds widget_twitter_feed widget.
 */
class Jetty_Widget_Button_Text extends WP_Widget
{
	/**
	 * Register widget with WordPress.
	 */
	function __construct()
	{
		parent::__construct(
			'jetty_widget_button_text',
			__('Jetty Widget - Andeavor Button Text Box', 'jetty'),
			array( 'description' => __( 'This widget for display text and button', 'jetty' ), )
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
			echo $args['before_widget'];
			$title = apply_filters('widget_title', empty($instance['title']) ? 'Title' : $instance['title'], $instance, $this->id_base);

			// this place for display in body widget
			$desc 	= apply_filters('widget_title', empty($instance['desc']) ? '' : $instance['desc']);

			$btn_text[1] 	= apply_filters('widget_title', empty($instance['btn_text1']) ? '' : $instance['btn_text1']);
			$btn_url[1] 	= apply_filters('widget_title', empty($instance['btn_url1']) ? '' : $instance['btn_url1']);
			$btn_text[2] 	= apply_filters('widget_title', empty($instance['btn_text2']) ? '' : $instance['btn_text2']);
			$btn_url[2]  	= apply_filters('widget_title', empty($instance['btn_url2']) ? '' : $instance['btn_url2']);
			$btn_text[3] 	= apply_filters('widget_title', empty($instance['btn_text3']) ? '' : $instance['btn_text3']);
			$btn_url[3]  	= apply_filters('widget_title', empty($instance['btn_url3']) ? '' : $instance['btn_url3']); ?>

				<div class="">  <!-- id="content-right" -->
					<div class="">
						<div class="on-title">
							<h2 class="widget-title"><?php echo $title ?></h2>
						</div>
						<div class="on-content">
							<p><?php echo $desc ?></p>
						</div>
						<?php for ($i=1;$i<=3;$i++): ?>
							<?php if ($btn_text[$i] && $btn_url[$i]): ?>
								<?php _e('<p class="btn-primary"><a href="'.esc_url($btn_url[$i]).'" target="_blank">'.$btn_text[$i].'</a></p>','andeavor');  ?>
							<?php endif ?>
						<?php endfor ?>
					</div>
				</div>

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

		$title 		= ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
		$desc 	= ( isset( $instance[ 'desc' ] ) ) ? $instance[ 'desc' ] : '';

		for ($i=1;$i<=3;$i++) {
			$btn_text[$i] = ( isset( $instance[ 'btn_text'.$i ] ) ) ? $instance[ 'btn_text'.$i ] : '';
			$btn_url[$i]  = ( isset( $instance[ 'btn_url'.$i ] ) ) ? $instance[ 'btn_url'.$i  ] : '';
		}

		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( ' ', 'jetty' );
		}

		?>
		<h4>- Text -</h4>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'andeavor'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'desc' ); ?>"><?php _e('Description', 'andeavor'); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'desc' ); ?>" name="<?php echo $this->get_field_name( 'desc' ); ?>"><?php echo esc_attr( $desc ); ?></textarea>
		</p>

		<fieldset>
			<h4>- Button -</h4>
			<?php for ($i=1;$i<=3;$i++) : ?>
				<p>
					<label for="<?php echo $this->get_field_id( 'btn_text'.$i ); ?>"><?php _e('Button Title '.$i, 'andeavor'); ?></label>
					<input class="widefat" id="<?php echo $this->get_field_id( 'btn_text'.$i ); ?>" name="<?php echo $this->get_field_name( 'btn_text'.$i ); ?>" type="text" value="<?php echo esc_attr( $btn_text[$i] ); ?>" />
					<label for="<?php echo $this->get_field_id( 'btn_url'.$i ); ?>"><?php _e('Button Url '.$i, 'andeavor'); ?></label>
					<input class="widefat" id="<?php echo $this->get_field_id( 'btn_url'.$i ); ?>" name="<?php echo $this->get_field_name( 'btn_url'.$i ); ?>" type="text" value="<?php echo esc_url( $btn_url[$i] ); ?>" />
				</p>	
			<?php endfor ?>
		</fieldset>
		<!-- END LOOP -->
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
		$new_instance = wp_parse_args((array) $new_instance, array( 'title' => '', 'desc' => '',
			'btn_text1' => '', 'btn_url1' => '', 'btn_text2' => '', 'btn_url2' => '', 'btn_text3' => '', 'btn_url3' => ''
		));

		$instance['title'] 		= sanitize_text_field($new_instance['title']);
		$instance['desc'] 	= ( ! empty( $new_instance['desc'] ) ) ? strip_tags( $new_instance['desc'] ) : '';
		$instance['btn_text1'] 	= sanitize_text_field($new_instance['btn_text1']);
		$instance['btn_url1'] 	= sanitize_text_field($new_instance['btn_url1']);
		$instance['btn_text2'] 	= sanitize_text_field($new_instance['btn_text2']);
		$instance['btn_url2'] 	= sanitize_text_field($new_instance['btn_url2']);
		$instance['btn_text3'] 	= sanitize_text_field($new_instance['btn_text3']);
		$instance['btn_url3'] 	= sanitize_text_field($new_instance['btn_url3']);

		return $instance;
	}

}
