<?php

/**
 * Adds widget_twitter_feed widget.
 */
class Jetty_Widget_Statistics extends WP_Widget
{
	/**
	 * Register widget with WordPress.
	 */
	function __construct()
	{
		parent::__construct(
			'jetty_widget_statistics',
			__('Jetty Statistics', 'jetty'),
			array( 'description' => __( 'This widget for display statistics widget', 'jetty' ), )
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

	function currencyFormat($num) {
		if ($num) {
			$x = round($num);
			$x_number_format = number_format($x);
			$x_array = explode(',', $x_number_format);
			$x_parts = array('k', 'm', 'b', 't');
			$x_count_parts = count($x_array) - 1;
			$x_display = $x;
			$x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
			//var_dump();
			$return[0] = $x_display;
			$return[1] = $x_parts[$x_count_parts - 1];
			//$return[2] = '';
			if (strlen($x_display) == 4) {
				$return[2] = 'style="font-size:85%"';
			} elseif (strlen($x_display) == 5) {
				$return[2] = 'style="font-size:70%"';
			} else {
				$return[2] = '';
			}
		} else {
			$return[0] = 0;
			$return[1] = '';
			$return[2] = '';
		}

		return $return;
	}

	public function widget( $args, $instance )
	{
		global $post;

		echo $args['before_widget'];
		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

		$crude 			= apply_filters('widget_title', empty($instance['crude']) ? 0 : $instance['crude']);
		$total 			= apply_filters('widget_title', empty($instance['total']) ? 0 : $instance['total']);
		$ncf 				= apply_filters('widget_title', empty($instance['ncf']) ? 0 : $instance['ncf']);
		$gasoline 	= apply_filters('widget_title', empty($instance['gasoline']) ? 0 : $instance['gasoline']);
		$distillate	= apply_filters('widget_title', empty($instance['distillate']) ? 0 : $instance['distillate']);
		$cpyc 			= apply_filters('widget_title', empty($instance['cpyc']) ? 0 : $instance['cpyc']);

		$page 		= apply_filters('widget_title', empty($instance['page']) ? '' : $instance['page']);

		$crude_a = $this->currencyFormat($crude);
		$total_a = $this->currencyFormat($total);
		$gasoline_a = $this->currencyFormat($gasoline);
		$distillate_a = $this->currencyFormat($distillate);
		$ncf_a = $this->currencyFormat($ncf);

		?>

		<?php if ($post->ID == $page): ?>
			<div class="contained statistics section-top orange-test">
				<h2><?php echo $title ?></h2>
				<ul class="row">
					<li class="col-xs-6 col-md-4">
						<div class="stat-contain">
							<p class="heading">Crude Capacity</p>
							<!-- <p class="stat"><span class="value">73</span><span class="units">k</span></p> -->
							<p class="stat"><span class="value" <?php echo $crude_a[2] ?>><?php echo $crude_a[0] ?></span><span class="units"><?php echo $crude_a[1] ?></span></p>
							<p class="subtext">barrels per day</p>
						</div>
					</li>
					<li class="col-xs-6 col-md-4">
						<div class="stat-contain">
							<p class="heading">Total Capacity</p>
							<p class="stat"><span class="value" <?php echo $total_a[2] ?>><?php echo $total_a[0] ?></span><span class="units"><?php echo $total_a[1] ?></span></p>
							<p class="subtext">barrels per day</p>
						</div>
					</li>
					<li class="col-xs-6 col-md-4">
						<div class="stat-contain">
							<p class="heading">Nelson Complexity Factor</p>
							<p class="stat"><span class="value" <?php echo $ncf_a[2] ?>><?php echo $ncf_a[0] ?></span><span class="units"><?php echo $ncf_a[1] ?></span></p>
						</div>
					</li>
					<li class="col-xs-6 col-md-4">
						<div class="stat-contain">
							<p class="heading">Gasoline Capacity</p>
							<p class="stat"><span class="value" <?php echo $gasoline_a[2] ?>><?php echo $gasoline_a[0] ?></span><span class="units"><?php echo $gasoline_a[1] ?></span></p>
							<p class="subtext">barrels per day</p>
						</div>
					</li>
					<li class="col-xs-6 col-md-4">
						<div class="stat-contain">
							<p class="heading">Distillate Capacity</p>
							<p class="stat"><span class="value" <?php echo $distillate_a[2] ?>><?php echo $distillate_a[0] ?></span><span class="units"><?php echo $distillate_a[1] ?></span></p>
							<p class="subtext">barrels per day</p>
						</div>
					</li>
					<li class="col-xs-6 col-md-4">
						<div class="stat-contain">
							<p class="heading">Clean Product Yield Capability</p>
							<p class="stat"><span class="value"><?php echo $cpyc ?></span><span class="units">%</span></p>
						</div>
					</li>
				</ul>
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

		$title 			= ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : 'tess';

		$crude 			= ( isset( $instance[ 'crude' ] ) ) ? $instance[ 'crude' ] : 0;
		$total 			= ( isset( $instance[ 'total' ] ) ) ? $instance[ 'total' ] : 0;
		$ncf 				= ( isset( $instance[ 'ncf' ] ) ) ? $instance[ 'ncf' ] : 0;
		$gasoline 	= ( isset( $instance[ 'gasoline' ] ) ) ? $instance[ 'gasoline' ] : 0;
		$distillate	= ( isset( $instance[ 'distillate' ] ) ) ? $instance[ 'distillate' ] : 0;
		$cpyc 			= ( isset( $instance[ 'cpyc' ] ) ) ? $instance[ 'cpyc' ] : 0;

		$page 			= ( isset( $instance[ 'page' ] ) ) ? $instance[ 'page' ] : '';
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
			<label for="<?php echo $this->get_field_id( 'crude' ); ?>"><?php _e('Crude Capacity (barrels per day)', 'jetty'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'crude' ); ?>" name="<?php echo $this->get_field_name( 'crude' ); ?>" type="number" value="<?php echo esc_attr( $crude ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'total' ); ?>"><?php _e('Total Capacity (barrels per day)', 'jetty'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'total' ); ?>" name="<?php echo $this->get_field_name( 'total' ); ?>" type="number" value="<?php echo esc_attr( $total ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'ncf' ); ?>"><?php _e('Nelson Complexity Factor', 'jetty'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'ncf' ); ?>" name="<?php echo $this->get_field_name( 'ncf' ); ?>" type="number" value="<?php echo esc_attr( $ncf ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'gasoline' ); ?>"><?php _e('Gasoline Capacity (barrels per day)', 'jetty'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'gasoline' ); ?>" name="<?php echo $this->get_field_name( 'gasoline' ); ?>" type="number" value="<?php echo esc_attr( $gasoline ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'distillate' ); ?>"><?php _e('Distillate Capacity (barrels per day)', 'jetty'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'distillate' ); ?>" name="<?php echo $this->get_field_name( 'distillate' ); ?>" type="number" value="<?php echo esc_attr( $distillate ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'cpyc' ); ?>"><?php _e('Clean Product Yield Capability', 'jetty'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'cpyc' ); ?>" name="<?php echo $this->get_field_name( 'cpyc' ); ?>" type="number" min='0' max='100' value="<?php echo esc_attr( $cpyc ); ?>" />
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
		$new_instance = wp_parse_args((array) $new_instance, array(
			'title' => '',
			'crude' => 0,
			'total' => 0,
			'ncf' => 0,
			'gasoline' => 0,
			'distillate' => 0,
			'cpyc' => 0,
			'page' => -1
		));

		$instance['title'] = sanitize_text_field($new_instance['title']);

		$instance['crude'] = (float) $new_instance['crude'];
		$instance['total'] = (float) $new_instance['total'];
		$instance['ncf'] = (float) $new_instance['ncf'];
		$instance['gasoline'] = (float) $new_instance['gasoline'];
		$instance['distillate'] = (float) $new_instance['distillate'];
		$instance['cpyc'] = (float) $new_instance['cpyc'];
		$instance['cpyc'] = ($instance['cpyc'] > 100) ? 100 : $instance['cpyc'];

		$instance['page'] = (int) $new_instance['page'];

		return $instance;
	}

}
