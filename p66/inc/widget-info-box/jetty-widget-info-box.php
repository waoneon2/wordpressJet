<?php

/**
 *
 */
class Jetty_Widget_Info_Box extends WP_Widget
{
	/**
	 * Register widget with WordPress.
	 */
	function __construct()
	{
		parent::__construct(
			'jetty_widget_info_box',
			__('Jetty Info Box', 'jetty'),
			array( 'description' => __( 'This widget for display info box widget', 'jetty' ), )
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

			// this place for display in body widget
			$hotline 	= apply_filters('widget_title', empty($instance['hotline']) ? '' : $instance['hotline']);
			$job_link	= apply_filters('widget_title', empty($instance['job_link']) ? '' : $instance['job_link']);
			$page 		= apply_filters('widget_title', empty($instance['page']) ? '' : $instance['page']);

			//$this->image(-1);
			// get refinery archive link
			$refinery=get_theme_mod('refinery_archive_page');
			$ref_link = get_the_permalink($refinery);
			?>

			<?php if ($post->ID == $page): ?>
				<div class="contained flush wide-content wide-content-refinery orange-test">
				  <div class="row">
				    <div class="col-sm-4 col-xs-12">
				    	<div class="info-box">
		            <div class="wrap">
		                <img src="<?php echo get_template_directory_uri() . '/img/refinery-phone.svg' ?>" alt="phone" class="icon">
		                <p>Community Hotline</p>
		                <p class="hidden-xs"><?php echo $hotline ?></p>
		                <a href="tel:<?php echo $hotline ?>" class="visible-xs"><?php echo $hotline ?></a>
		            </div>
				    	</div>
				    </div>
				    <div class="col-sm-4 col-xs-12">
				    	<div class="info-box">
		            <div class="wrap">
			        		<img src="<?php echo get_template_directory_uri() . '/img/refinery-briefcase.svg' ?>" alt="phone" class="icon">
				    			<p>Interested in working at this refinery?</p>
				    			<a href="<?php echo $job_link ?>">View all Job Postings</a>
	            	</div>
							</div>
				    </div>
				    <div class="col-sm-4 col-xs-12">
				    	<div class="info-box">
				            <div class="wrap">
				                <img src="<?php echo get_template_directory_uri() . '/img/refinery-droplet.svg' ?>" alt="phone" class="icon">
				                <p>Looking for a different refinery?</p>
				                <a href="<?php echo esc_url($ref_link); ?>">View All Refinery Locations</a>
				            </div>
				    	</div>
				    </div>
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

		$title 		= ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
		$hotline 	= ( isset( $instance[ 'hotline' ] ) ) ? $instance[ 'hotline' ] : '';
		$job_link	= ( isset( $instance[ 'job_link' ] ) ) ? $instance[ 'job_link' ] : '';
		$page 		= ( isset( $instance[ 'page' ] ) ) ? $instance[ 'page' ] : '';

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
			<label for="<?php echo $this->get_field_id( 'hotline' ); ?>"><?php _e('Community Hotline', 'jetty'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'hotline' ); ?>" name="<?php echo $this->get_field_name( 'hotline' ); ?>" type="text" value="<?php echo esc_attr( $hotline ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'job_link' ); ?>"><?php _e('Jobs Link', 'jetty'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'job_link' ); ?>" name="<?php echo $this->get_field_name( 'job_link' ); ?>" type="url" value="<?php echo esc_url( $job_link ); ?>" />
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
		$new_instance = wp_parse_args((array) $new_instance, array( 'title' => '', 'hotline' => '', 'job_link' => '', 'page' => -1));

		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['hotline'] = sanitize_text_field($new_instance['hotline']);
		$instance['job_link'] = sanitize_text_field($new_instance['job_link']);
		$instance['page'] = (int) $new_instance['page'];

		return $instance;
	}

}
