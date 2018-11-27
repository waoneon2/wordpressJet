<?php

add_action( 'widgets_init', function(){
     register_widget( 'aramco_follow_us' );
});
/**
 * Adds aramco_follow_us widget.
 */
class aramco_follow_us extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'aramco_follow_us', // Base ID
			__('Aramco Follow Us', 'text_domain'), // Name
			array( 'description' => __( 'This widget for footer to display social icon in footer', 'text_domain' ), ) // Args
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
	public function widget( $args, $instance ) {
	
     	echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		} else {
			echo $args['before_title'].__('Follow Us','aramco').$args['after_title'];
		}
		// this place for display in body widget
		$sub1 	=  apply_filters('widget_title',!empty($instance['sub1']) ? $instance['sub1'] : '');
		$sub2 	=  apply_filters('widget_title',!empty($instance['sub2']) ? $instance['sub2'] : '' );
		$sub3 	=  apply_filters('widget_title',!empty($instance['sub3']) ? $instance['sub3'] : '');
		$sub4 	=  apply_filters('widget_title',!empty($instance['sub4']) ? $instance['sub4'] : '');
		$link1 	=  apply_filters('widget_title',!empty($instance['link1']) ? $instance['link1'] : '#');
		$link2 	=  apply_filters('widget_title',!empty($instance['link2']) ? $instance['link2'] : '#');
		$link3 	=  apply_filters('widget_title',!empty($instance['link3']) ? $instance['link3'] : '#');
		$link4 	=  apply_filters('widget_title',!empty($instance['link4']) ? $instance['link4'] : '#');

		$alink1 = ($link1 == '#' ) ? $sub1 : '<a href="'.esc_url($link1).'">'.$sub1.'</a>';
		$alink2 = ($link2 == '#' ) ? $sub2 : '<a href="'.esc_url($link2).'">'.$sub2.'</a>';
		$alink3 = ($link3 == '#' ) ? $sub3 : '<a href="'.esc_url($link3).'">'.$sub3.'</a>';
		$alink4 = ($link4 == '#' ) ? $sub4 : '<a href="'.esc_url($link4).'">'.$sub4.'</a>';
		?>
		<ul>
		<li><span aria-hidden="true" data-icon="&#xe619;"></span><?php echo $alink1 ?></li>
		<li><span aria-hidden="true" data-icon="&#xe619;"></span><?php echo $alink2 ?></li>
		<li><span aria-hidden="true" data-icon="&#xe619;"></span><?php echo $alink3 ?></li>
		<li><span aria-hidden="true" data-icon="&#xe619;"></span><?php echo $alink4 ?></li>
		</ul>

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

		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'New title', 'text_domain' );
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>

		<?php
		for ($z=1; $z < 5; $z++) :
			$sub= 'sub'.$z;
			$link='link'.$z;
			$vasub	= ( isset( $instance[ $sub ] ) ) ? $instance[ $sub ] : '';
			$valink	= ( isset( $instance[ $link ] ) ) ? $instance[ $link ] : ''; 	?>
			<p>
				<label for="<?php echo $this->get_field_id( $sub ); ?>"><?php _e( 'Opsi '.$z ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( $sub ); ?>" name="<?php echo $this->get_field_name( $sub ); ?>" type="text" value="<?php echo esc_attr( $vasub ); ?>" placeholder="add name"/>
				<input class="widefat" id="<?php echo $this->get_field_id( $link ); ?>" name="<?php echo $this->get_field_name( $link ); ?>" type="text" value="<?php echo esc_attr( $valink ); ?>" placeholder="add the link here" />
			</p>

		<?php 	endfor;
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
		$instance['sub1'] = ( ! empty( $new_instance['sub1'] ) ) ? strip_tags( $new_instance['sub1'] ) : '';
		$instance['link1'] = ( ! empty( $new_instance['link1'] ) ) ? strip_tags( $new_instance['link1'] ) : '';
		$instance['sub2'] = ( ! empty( $new_instance['sub2'] ) ) ? strip_tags( $new_instance['sub2'] ) : '';
		$instance['link2'] = ( ! empty( $new_instance['link2'] ) ) ? strip_tags( $new_instance['link2'] ) : '';
		$instance['sub3'] = ( ! empty( $new_instance['sub3'] ) ) ? strip_tags( $new_instance['sub3'] ) : '';
		$instance['link3'] = ( ! empty( $new_instance['link3'] ) ) ? strip_tags( $new_instance['link3'] ) : '';
		$instance['sub4'] = ( ! empty( $new_instance['sub4'] ) ) ? strip_tags( $new_instance['sub4'] ) : '';
		$instance['link4'] = ( ! empty( $new_instance['link4'] ) ) ? strip_tags( $new_instance['link4'] ) : '';

		return $instance;
	}
} // class aramco_follow_us

?>
