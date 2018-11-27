<?php
add_action( 'widgets_init', function(){
register_widget( 'aramco_widget_category' );
});
/**
 * Adds widget_twitter_feed widget.
 */
class Aramco_Widget_Category extends WP_Widget
{
	/**
	 * Register widget with WordPress.
	 */
	function __construct()
	{
		parent::__construct(
			'aramco_widget_category',
			__('Aramco Select Category', 'aramco'),
			array( 'description' => __( 'This widget for display list of post in selected category', 'aramco' ), )
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
	function image($id) {
			$image = $id;
			if ( -1 == $image ) {
				$image = get_template_directory_uri(). '/img/promo-placeholder.jpg';
			} else {
				$image = wp_get_attachment_url($id);
			}
			echo($image);
	}

	public function widget( $args, $instance )
	{
	     	extract($args);
			$title = apply_filters('widget_title', empty($instance['title']) ? __('Latest News') : $instance['title']);
				// this place for display in body widget
			$catID		= apply_filters('widget_title', empty($instance['cat']) ? -1 : $instance['cat']);
			//$this->image(-1);
			
			echo $before_widget;
			if ($title) {
				echo $before_title . $title . $after_title;
			}
			$gallery = array(
				'cat'  => $catID,
				'posts_per_page' => 10,
				'orderby' => 'date',
				'order'   => 'DESC'
			);
			$the_query = new WP_Query( $gallery );
			// front end

			if ( $the_query->have_posts() ) {
				echo '<ul class="arsc-list">';
				while ( $the_query->have_posts() ) {
					$the_query->the_post();
					echo '<li><a href="'. get_permalink() .'" class="arsc-title">' . get_the_title() . '</a><div class="arsc-date">';
					the_time('F j, Y');
					echo '</div></li>';
				}
				echo '</ul>';
				/* Restore original Post Data */
				wp_reset_postdata();
			} else {
				// no posts found
			}


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

		$title 		= ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
		$desc 		= ( isset( $instance[ 'desc' ] ) ) ? $instance[ 'desc' ] : '';
		$cat			= ( isset( $instance[ 'cat' ] ) ) ? $instance[ 'cat' ] : '';

		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( ' ', 'aramco' );
		}

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'jiw'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'cat' ); ?>"><?php _e('Select category', 'jiw'); ?></label><br />
			<?php
			//$cat = 28;
				$drop_category = wp_dropdown_categories(
					array(
						'show_option_all'    => '',
						'show_option_none'   => '',
						'option_none_value'  => '0',
						'echo' => '0',
						'selected' => $cat,
						'name' => $this->get_field_name( 'cat' ),
						'id' => $this->get_field_id( 'cat' )
					)
				);
				echo $drop_category;
			?>
		</p>
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
		$new_instance = wp_parse_args((array) $new_instance, array( 'title' => '', 'cat' => -1));

		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['cat'] = (int) $new_instance['cat'];

		return $instance;
	}

}
