<?php

/**
 * Adds widget_twitter_feed widget.
 */
class Jetty_Widget_Promo extends WP_Widget
{
	/**
	 * Register widget with WordPress.
	 */
	function __construct()
	{
		parent::__construct(
			'jetty_widget_promo',
			__('Jetty Promo', 'jetty'),
			array( 'description' => __( 'This widget for display promo section on certain page', 'jetty' ), )
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
				$image = wp_get_attachment_image_src($id, 'carousel');
				$image = $image[0];
			}
			echo($image);
	}

	public function widget( $args, $instance )
	{
			echo $args['before_widget'];
			$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

			// this place for display in body widget
			$desc 		= apply_filters('widget_title', empty($instance['desc']) ? '' : $instance['desc']);
			$btn_text	= apply_filters('widget_title', empty($instance['btn_text']) ? '' : $instance['btn_text']);
			$btn_url 	= apply_filters('widget_title', empty($instance['btn_url']) ? '' : $instance['btn_url']);
			$image_ID		= apply_filters('widget_title', empty($instance['image']) ? -1 : $instance['image']);
			//$this->image(-1);
			?>

			<!-- Modal - Video -->
			<div class="modal fade widget-promo-popup" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" data-video-id="<?php echo $btn_url ?>" data-video-height="380" data-video-width="640">
			  <div class="modal-dialog modal-lg" role="document">
			    <div class="modal-content">
			    	<span class="close-btn">
			        <span>Close Video</span>
			      </span>

						<div class="embed-responsive embed-responsive-16by9">
			        <div class="videoShell" id="video-<?php echo $btn_url ?>"></div>
						</div>
			    </div>
			  </div>
			</div>

			<div class="contained no-margin section-top section-bottom orange-test">
				<div class="row">
					<div class="promo-full-width">
					  <img src="<?php echo $this->image($image_ID) ?>" >
					  <div class="row promo-full-width-row fully-brightened left">
					   <div class="hidden-xs desktop-content col-sm-6 col-md-5 col-sm-push-1">
					      <h1 class="white"><?php echo $title ?></h1>
					      <div>
						      <p class="white"><?php echo $desc ?></p>
						      <button data-toggle="modal" data-target=".widget-promo-popup" class="btn btn-primary video-link1"><span class="video-link" aria-hidden="true"></span><?php echo $btn_text ?></button>
					      </div>
					  	</div>
					  	<div class="col-lg-3 col-md-3 col-sm-3"></div>
					 	</div>
					 <div class="mobile-content visible-xs">
					 		<div class="center">
			 			      <h1 class="white"><?php echo $title ?></h1>
			 			      <div>
			 				      <p class="white"><?php echo $desc ?></p>
			 				      <button data-toggle="modal" data-target=".widget-promo-popup" class="btn btn-primary video-link1"><span class="video-link" aria-hidden="true"></span><?php echo $btn_text ?></button>
			 			      </div>
					 		</div>
					 </div>
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
		$btn_text	= ( isset( $instance[ 'btn_text' ] ) ) ? $instance[ 'btn_text' ] : '';
		$btn_url 	= ( isset( $instance[ 'btn_url' ] ) ) ? $instance[ 'btn_url' ] : '';
		$image 		= ( isset( $instance[ 'image' ] ) ) ? $instance[ 'image' ] : -1;

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
			<label for="<?php echo $this->get_field_id( 'btn_text' ); ?>"><?php _e('Button Text', 'jiw'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'btn_text' ); ?>" name="<?php echo $this->get_field_name( 'btn_text' ); ?>" type="text" value="<?php echo esc_attr( $btn_text ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'btn_url' ); ?>"><?php _e('Youtube ID', 'jiw'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'btn_url' ); ?>" name="<?php echo $this->get_field_name( 'btn_url' ); ?>" type="text" value="<?php echo esc_attr( $btn_url ); ?>" placeholder="NpEaa2P7qZI"/>
		</p>

		<!-- LOOP -->
		<div class="jetty-widget-promo-form jetty-widget-custom">
		   <div class="media-item">
					<input type="hidden" name="<?php echo $this->get_field_name('image'); ?>" class="jiw_repeatable_attachment_id_field" value="<?php echo esc_attr($image); ?>"/>
				  <div class="jetty-image-choose-action">
				  		<a href="#" class="jiw_upload_file_button button button-primary"><?php _e('Upload', 'jiw'); ?></a>
				  </div>

				  <figure class="image-preview">
				      <?php if ($image !== -1) {
				          $imageUrl = wp_get_attachment_url($image);
				          echo '<img class="preview-image-item preview-image-item" src="' . $imageUrl .'">';
				      }
				      ?>
				  </figure>
				</div>
		</div>
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
		$new_instance = wp_parse_args((array) $new_instance, array( 'title' => '', 'desc' => '', 'btn_text' => '', 'btn_url' => '', 'image' => -1));

		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['desc'] = ( ! empty( $new_instance['desc'] ) ) ? strip_tags( $new_instance['desc'] ) : '';
		$instance['btn_text'] = sanitize_text_field($new_instance['btn_text']);
		$instance['btn_url'] = sanitize_text_field($new_instance['btn_url']);
		$instance['image'] = (int) $new_instance['image'];

		return $instance;
	}

}
