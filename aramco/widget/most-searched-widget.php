<?php

add_action( 'widgets_init', function(){
register_widget( 'aramco_most_searched' );
});	
/**
 * Adds aramco_most_searched widget.
 */
class aramco_most_searched extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'aramco_most_searched', // Base ID
			__('Aramco Most Searched', 'aramco'), // Name
			array( 'description' => __( 'This widget for footer to display most searched tags', 'aramco' ), ) // Args
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
	
     	extract($args);
		$title = apply_filters('widget_title', empty($instance['popular-searches-title']) ? __('Popular Searches') : $instance['popular-searches-title']);
		$count = (int) (empty($instance['popular-searches-number']) ? 5 : $instance['popular-searches-number']);
		
		echo $before_widget;
		echo $before_title . $title . $after_title;
		aramco_list_popular_searches('', '', aramco_constrain_widget_search_count($count));
		echo $after_widget;
	}
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$instance = wp_parse_args((array) $instance, array('popular-searches-title' => 'Popular Searches', 'popular-searches-number' => 5));
		
		$title = (htmlspecialchars($instance['popular-searches-title'])) ? htmlspecialchars($instance['popular-searches-title']) : 'Popular Searches';
		$count = htmlspecialchars($instance['popular-searches-number']);
		# Output the options
		echo '<p><label for="' . $this->get_field_name('popular-searches-title') . '">' . __('Title:') . ' <input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('popular-searches-title') . '" type="text" value="' . $title . '" /></label></p>';
		echo '<p><label for="' . $this->get_field_name('popular-searches-number') . '">' . __('Number of searches to show:') . ' <input id="' . $this->get_field_id('popular-searches-number') . '" name="' . $this->get_field_name('popular-searches-number') . '" type="text" value="' . $count . '" size="3" /></label></p>';
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
		$instance['popular-searches-title'] = strip_tags(stripslashes($new_instance['popular-searches-title']));
		$instance['popular-searches-number'] = (int) ($new_instance['popular-searches-number']);
		return $instance;
	}
} // class aramco_most_searched

?>