<?php

/**
 * Adds widget_twitter_feed widget.
 */
class Jetty_Widget_Collapse_Gallery extends WP_Widget
{
	/**
	 * Register widget with WordPress.
	 */
	function __construct()
	{
		parent::__construct(
			'jetty_widget_collapse_gallery',
			__('Jetty Collapse Gallery', 'jetty'),
			array( 'description' => __( 'This widget for display collapse gallery section on certain page', 'jetty' ), )
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
			echo $args['before_widget'];
			$title = apply_filters('widget_title', empty($instance['title']) ? 'adsadsadsads' : $instance['title'], $instance, $this->id_base);

			// this place for display in body widget
			$desc 		= apply_filters('widget_title', empty($instance['desc']) ? '' : $instance['desc']);
			$catID		= apply_filters('widget_title', empty($instance['cat']) ? -1 : $instance['cat']);
			//$this->image(-1);
			$gallery = array(
				'cat'  => $catID,
				'posts_per_page' => 9,
				'orderby' => 'date',
				'order'   => 'DESC'
			);
			$wp_query = new WP_Query( $gallery ); ?>

			<div class="image-grid section-top orange-test">
				<div class="contained flush">

					<div class="image-grid-header">
						<h2><?php echo $title ?></h2>
						<p><?php echo $desc ?></p>
					</div>

					<ul class="image-grid-container threePerRow">
						<?php
						if ( $wp_query->have_posts() ) :
							$i = 0;
							while ( $wp_query->have_posts() ) :
								$wp_query->the_post();
								$id = $wp_query->post->ID;
								//var_dump();
							?>
								<li <?php echo ($i > 2) ? 'class="mobileHiddenByDefault"' : ''; ?>>
									<a href="#">
										<img src="<?php echo (get_the_post_thumbnail_url($id, 'image-grid')) ? get_the_post_thumbnail_url($id, 'image-grid') : get_template_directory_uri(). '/img/grid-placeholder.jpg' ?>" alt="<?php the_title() ?>">
										<div class="img-overlay">
											<span><?php the_title() ?></span>
										</div>
									</a>
									<div class="details collapse" id="demo">
										<span class="close-btn">
											<span>Close Image Details</span>
										</span>
										<div class="details-inner">
											<div class="image">
												<img src="<?php echo (get_the_post_thumbnail_url($id, 'image-grid-detail')) ? get_the_post_thumbnail_url($id, 'image-grid-detail') : get_template_directory_uri(). '/img/grid-placeholder.jpg' ?>">
											</div>
											<div class="description">
												<h3><?php the_title() ?></h3>
												<p><?php the_content() ?></p>
											</div>
										</div>
									</div>
								</li>
							<?php
							$i++;
							endwhile;
							wp_reset_postdata();
						endif; ?>
						<div class="row visible-xs">
						  <a href="#moreHistory" class="btn-load-more btn-tertiary" data-count-to-show="3">load more history</a>
						</div>
					</ul>

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
		$cat			= ( isset( $instance[ 'cat' ] ) ) ? $instance[ 'cat' ] : '';

		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( ' ', 'jetty' );
		}

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'jiw'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'desc' ); ?>"><?php _e('Description', 'jiw'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'desc' ); ?>" name="<?php echo $this->get_field_name( 'desc' ); ?>" type="text" value="<?php echo esc_attr( $desc ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'cat' ); ?>"><?php _e('Select category for the gallery', 'jiw'); ?></label><br />
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
		$new_instance = wp_parse_args((array) $new_instance, array( 'title' => '', 'desc' => '', 'cat' => -1));

		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['desc'] = ( ! empty( $new_instance['desc'] ) ) ? strip_tags( $new_instance['desc'] ) : '';
		$instance['cat'] = (int) $new_instance['cat'];

		return $instance;
	}

}
