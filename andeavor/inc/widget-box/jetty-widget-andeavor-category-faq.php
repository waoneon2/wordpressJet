<?php

/**
 * Adds widget_twitter_feed widget.
 */
class Jetty_Widget_Andeavor_Category_Faq extends WP_Widget
{
	/**
	 * Register widget with WordPress.
	 */
	function __construct()
	{
		parent::__construct(
			'jetty_widget_andeavor_category_faq',
			__('Jetty Widget - Andeavor Category Faq', 'jetty'),
			array( 'description' => __( 'This widget for display collapse latest section on certain page', 'jetty' ), )
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
			$title = apply_filters('widget_title', empty($instance['title']) ? 'FAQ:' : $instance['title'], $instance, $this->id_base);

			// this place for display in body widget
			$desc 		= apply_filters('widget_title', empty($instance['desc']) ? '' : $instance['desc']);
			$catID		= apply_filters('widget_title', empty($instance['cat']) ? -1 : $instance['cat']);
			$btn_text	= apply_filters('widget_title', empty($instance['btn_text']) ? 'View All' : $instance['btn_text']);
			$btn_url 	= apply_filters('widget_title', empty($instance['btn_url']) ? '' : $instance['btn_url']);
			//$this->image(-1);
			$latest = array(
				'cat'  => $catID,
				'orderby' => 'date',
				'order'   => 'DESC'
			);
			$wp_query = new WP_Query( $latest ); ?>

				<div class="">
					<div class="">
						<div class="on-title">
							<h2 class="widget-title"><?php echo $title ?></h2>
							<p><?php echo $desc ?></p>
						</div>
						<div class="on-content">
							<ul class="list-faq-content">
								<?php
								if ( $wp_query->have_posts() ) :
									$i = 0;
									while ( $wp_query->have_posts() ) :
										$wp_query->the_post();
										$id = $wp_query->post->ID;
									?>
										<li <?php echo ($i > 2) ? 'class=""' : ''; ?>>
											<span class="content-datetime-faq"><?php echo get_the_time('F n, Y')?></span>
											<br>
											<a href="<?php the_permalink(); ?>"><h3 class="title"><?php echo get_the_title()?></h3></a>
										</li>
									<?php
									$i++;
									endwhile;
									wp_reset_postdata();
								endif; ?>
							</ul>
							<p class="btn-primary">
								<?php if ($btn_url): ?>
									<a href="<?php echo esc_url( $btn_url ); ?>" target="_blank"><?php echo esc_attr( $btn_text ); ?></a>
								<?php endif ?>
							</p>
						</div>
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
		$desc 		= ( isset( $instance[ 'desc' ] ) ) ? $instance[ 'desc' ] : '';
		$cat		= ( isset( $instance[ 'cat' ] ) ) ? $instance[ 'cat' ] : '';
		$btn_text	= ( isset( $instance[ 'btn_text' ] ) ) ? $instance[ 'btn_text' ] : '';
		$btn_url 	= ( isset( $instance[ 'btn_url' ] ) ) ? $instance[ 'btn_url' ] : '';

		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( ' ', 'jetty' );
		}

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'andeavor'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'desc' ); ?>"><?php _e('Description', 'andeavor'); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'desc' ); ?>" name="<?php echo $this->get_field_name( 'desc' ); ?>"><?php echo esc_attr( $desc ); ?></textarea>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'cat' ); ?>"><?php _e('Select category for the latest', 'andeavor'); ?></label><br />
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
		<p>
			<label for="<?php echo $this->get_field_id( 'btn_text' ); ?>"><?php _e('Button Title', 'andeavor'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'btn_text' ); ?>" name="<?php echo $this->get_field_name( 'btn_text' ); ?>" type="text" value="<?php echo esc_attr( $btn_text ); ?>" placeholder="" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'btn_url' ); ?>"><?php _e('Button Url', 'andeavor'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'btn_url' ); ?>" name="<?php echo $this->get_field_name( 'btn_url' ); ?>" type="text" value="<?php echo esc_url( $btn_url ); ?>" placeholder=""/>
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
		$new_instance = wp_parse_args((array) $new_instance, array( 'title' => '', 'desc' => '', 'cat' => -1, 'btn_text' => '', 'btn_url' => ''));

		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['desc'] = ( ! empty( $new_instance['desc'] ) ) ? strip_tags( $new_instance['desc'] ) : '';
		$instance['cat'] = (int) $new_instance['cat'];
		$instance['btn_text'] = sanitize_text_field($new_instance['btn_text']);
		$instance['btn_url'] = sanitize_text_field($new_instance['btn_url']);

		return $instance;
	}

}
