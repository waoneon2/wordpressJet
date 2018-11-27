<?php

add_action( 'widgets_init', function(){
     register_widget( 'aramco_popular_pages' );
});	
/**
 * Adds aramco_popular_pages widget.
 */
class aramco_popular_pages extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'aramco_popular_pages', // Base ID
			__('Aramco Popular Pages', 'text_domain'), // Name
			array( 'description' => __( 'This widget for footer to display popular pages', 'text_domain' ), ) // Args
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
			echo $args['before_title'].__('Most Popular','aramco').$args['after_title'];
		}
		// this place for display in body widget

		echo '<ul>';
		$pages = array(
			'post_type' => 'page',
			'meta_key'=>'post_views_count',
			'orderby' => 'meta_value_num',
			'order' => 'desc',
		    'posts_per_page' => 8
		);
		 
		$queryObject = new WP_Query($pages);
		if ( $queryObject->have_posts() ) :
			while ($queryObject->have_posts()) : $queryObject->the_post();
		?>
		    
		    	<li><span aria-hidden="true" data-icon="&#xe619;"></span> <a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a></li>
		    
		<?php
		endwhile; 
		endif;
		wp_reset_query();
		echo '</ul>';


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
		return $instance;
	}
} // class aramco_popular_pages

?>