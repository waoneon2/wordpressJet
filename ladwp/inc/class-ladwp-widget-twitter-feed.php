<?php

/**
 * Adds widget_twitter_feed widget.
 */
class LADWP_Widget_Twitter_Feed extends WP_Widget
{
	/**
	 * Register widget with WordPress.
	 */
	function __construct()
	{
		parent::__construct(
			'ladwp_widget_twitter_feed',
			__('Twitter Feed', 'ladwp'),
			array( 'description' => __( 'This widget for display twitter timeline feed', 'ladwp' ), )
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
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}
		// this place for display in body widget
		$username 	=  apply_filters('widget_title',$instance['username']);
		$max_h 	=  apply_filters('widget_title',$instance['max_h']);
		$max_w 	=  apply_filters('widget_title',$instance['max_w']);
		if (isset($max_h) && $max_h != 0) :
			$style_h = 'max-height :'.$max_h.'px;';
		else :
			$style_h = 'max-height : auto;';
		endif;

		if (isset($max_w) && $max_w != 0) :
			$style_w = 'max-width :'.$max_w.'px;';
		else :
			$style_w = 'max-width : auto;';
		endif;
		?>
		<div class="twitter-feed-widget" style="overflow:auto;<?php echo $style_h; echo $style_w;?>">
			<a class="twitter-timeline" href="https://twitter.com/<?php echo $username;?>">Tweets by <?php echo $username;?></a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
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

		$title 	= ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
		$username 	= ( isset( $instance[ 'username' ] ) ) ? $instance[ 'username' ] : '';
		$max_h 	= ( isset( $instance[ 'max_h' ] ) ) ? $instance[ 'max_h' ] : '';
		$max_w 	= ( isset( $instance[ 'max_w' ] ) ) ? $instance[ 'max_w' ] : '';

		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( ' ', 'ladwp' );
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'username' ); ?>">Twitter Username</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" type="text" value="<?php echo esc_attr( $username ); ?>" placeholder="add username name"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'max_h' ); ?>" >Max Height (optional)</label><br />
			<input class="" id="<?php echo $this->get_field_id( 'max_h' ); ?>" name="<?php echo $this->get_field_name( 'max_h' ); ?>" type="number" value="<?php echo esc_attr( $max_h ); ?>" /> <span>pixel</span>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'max_w' ); ?>" >Max Width (optional)</label><br />
			<input class="" id="<?php echo $this->get_field_id( 'max_w' ); ?>" name="<?php echo $this->get_field_name( 'max_w' ); ?>" type="number" value="<?php echo esc_attr( $max_w ); ?>" /> <span>pixel</span>
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
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['username'] = ( ! empty( $new_instance['username'] ) ) ? strip_tags( $new_instance['username'] ) : '';
		$instance['max_h'] = ( ! empty( $new_instance['max_h'] ) ) ? strip_tags( $new_instance['max_h'] ) : '';
		$instance['max_w'] = ( ! empty( $new_instance['max_w'] ) ) ? strip_tags( $new_instance['max_w'] ) : '';

		return $instance;
	}
}