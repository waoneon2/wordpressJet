<?php

/**
 *
 */
class Jetty_Widget_Carousel extends WP_Widget
{
	/**
	 * Register widget with WordPress.
	 */
	function __construct()
	{
		parent::__construct(
			'jetty_widget_carousel',
			__('Jetty Carousel', 'jetty'),
			array( 'description' => __( 'This widget for display carousel widget', 'jetty' ), )
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
			$items 	= ( isset( $instance[ 'items' ] ) ) ? $instance[ 'items' ] : array();
			$page 	= apply_filters('widget_title', empty($instance['page']) ? '' : $instance['page']);
			?>
					<div class="section-top-m section-bottom-m contained">
					  <div class="row orange-test">
					      <!-- Wrapper for slides -->
					      <div class="carousel-inner slider-component content-bottom">
									<?php if ($post->ID == $page): ?>
										<?php $i = 0 ?>
										<?php foreach ($items as $key => $value): ?>
											<?php
												$image = wp_get_attachment_image_src($value['image'], 'carousel');
												$image = $image[0];
											?>
											<?php if ($image): ?>
											<div class="promo-full-width orange-test">
											  <div class="slick-img-wrap">
											    <img src="<?php echo $image ?>">
											  </div>

											  <div class="row carousel-content-row <?php echo $value['type'] ?>">
											    <div class="col-lg-1 col-md-1 col-sm-1"></div>
											    <div class="col-lg-6 col-md-8 col-sm-7 hidden-xs desktop-content desktop-content-bottom-text">
											        <div>
											          <p class="white"><?php echo $value['desc']; ?></p>
											        </div>
											    </div>
											    <div class="col-lg-5 col-md-3 col-sm-4"></div>
											  </div>
											  <div class="mobile-content mobile-content-bottom-text visible-xs">
											    <div class="center">
											      <div>
											        <p class="white"><?php echo $value['desc']; ?></p>
											      </div>
											    </div>
											  </div>
											</div>
										<?php endif; ?>
										<?php $i++; endforeach ?>
									<?php endif ?>
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

		$title 	= ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
		$items 	= ( isset( $instance[ 'items' ] ) ) ? $instance[ 'items' ] : array();
		$page 	= ( isset( $instance[ 'page' ] ) ) ? $instance[ 'page' ] : '';

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
		<!-- LOOP -->
		<div class="jetty-widget-carousel-form jetty-widget-custom">
		    <?php
		    		$more = count($items);
		        foreach ($items as $key => $item) {
		            echo $this->displayTabsItem($item, $key);
		        }
		    ?>
		    <button class="button jiw-add-more<?php echo ($more === 8 ? ' hidden' : ''); ?>" data-widgetbase="<?php echo esc_attr($this->number); ?>"><?php esc_html_e('Add More', 'jetty'); ?></button>
		</div>
		<!-- END LOOP -->
		<?php
	}

	protected function displayTabsItem($item, $i)
	{
	    $item = wp_parse_args((array) $item, array('image' => -1, 'desc' => '', 'type' => 'normal'));

	    extract($item);
	    ob_start();
	    ?>
	        <div class="media-item media-item-<?php echo $i; ?>" data-index="<?php echo $i; ?>">
	        		<input type="hidden" name="<?php echo $this->get_field_name("items[$i][image]"); ?>" class="jiw_repeatable_attachment_id_field" value="<?php echo esc_attr($image); ?>"/>

			        <div class="jetty-image-choose-action">
			        		<a href="#" class="jiw_upload_file_button button button-primary"><?php _e('Upload', 'jetty'); ?></a>
			            <a href="#" class="jetty-remove-image button button-secondary"><?php _e('Remove', 'jetty'); ?></a>
			        </div>

			        <figure class="image-preview">
			            <?php if ($image !== -1) {
			                $imageUrl = wp_get_attachment_url($image);
			                echo '<img class="preview-image-item preview-image-item-' . $i .'" src="' . $imageUrl .'">';
			            }
			            ?>
			        </figure>

	            <p>
								<label for="<?php echo $this->get_field_id( "items[$i][desc]" ); ?>"><?php _e('Description', 'jetty'); ?></label>
								<textarea class="widefat" id="<?php echo $this->get_field_id( "items[$i][desc]" ); ?>" name="<?php echo $this->get_field_name( "items[$i][desc]" ); ?>" row="5"><?php echo esc_attr( $desc ); ?></textarea>
							</p>

							<p>
								<label for="<?php echo $this->get_field_id( "items[$i][type]" ); ?>"><?php _e('Select carousel type', 'jetty'); ?></label><br />
								<select name="<?php echo $this->get_field_name( "items[$i][type]" ); ?>" id="<?php echo $this->get_field_id( "items[$i][type]" ); ?>">
									<option value="normal">Normal</option>
									<option value="fully-shaded-red" <?php echo ($type == 'fully-shaded-red') ? 'selected' : '' ?>>Fully Shaded Red</option>
									<option value="fully-shaded" <?php echo ($type == 'fully-shaded') ? 'selected' : '' ?>>Fully Shaded</option>
									<option value="fully-brightened" <?php echo ($type == 'fully-brightened') ? 'selected' : '' ?>>Fully Brightened</option>
								</select>
							</p>

	        </div>
	    <?php
	    return ob_get_clean();
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
		$new_instance = wp_parse_args((array) $new_instance, array( 'title' => '', 'items' => array(),'page' => -1));

		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['items'] = array_values(array_map(array($this, 'sanitizeItem'), $new_instance['items']));
		$instance['page'] = (int) $new_instance['page'];

		return $instance;
	}

	public function sanitizeItem($item)
	{
	    $item = wp_parse_args((array) $item, array('image' => -1, 'desc' => '', 'type' => 'normal'));
	    $cleaned = array();

			$cleaned['image'] = (int) $item['image'];
	    $cleaned['desc'] = ( ! empty( $item['desc'] ) ) ? strip_tags( $item['desc'] ) : '';
	    $cleaned['type'] = $item['type'];

	    return $cleaned;
	}
}
