<?php

/**
 * Adds widget_twitter_feed widget.
 */
class Jetty_Widget_Vertical_Tab extends WP_Widget
{
	/**
	 * Register widget with WordPress.
	 */
	function __construct()
	{
		parent::__construct(
			'jetty_widget_vertical_tab',
			__('Jetty Vertical Tabs', 'jetty'),
			array( 'description' => __( 'This widget for display vertical tab on certain page', 'jetty' ), )
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
			$title = $args['before_title'] . apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base) . $args['after_title'];

			// this place for display in body widget
			$desc 	=  apply_filters('widget_title', empty($instance['desc']) ? '' : $instance['desc']);
			$tabs 	= ( isset( $instance[ 'tabs' ] ) ) ? $instance[ 'tabs' ] : array();

			?>
			<div class="vertical-tabs" style="margin-top: 60px;">

				<div class="contained flush section-top section-bottom ">

					<div class="row text-center">
						<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
							<?php echo $title ?>
							<p><?php echo $desc ?></p>
						</div>
					</div>

					<div class="selector">
						<!-- Nav tabs -->
						<div class="tabs-contain">
						  <div class="tabs">
							  <ul class="nav nav-tabs vertical-tabs-nav" role="tablist" data-breakpoints="xs">
							    <?php $i = 0 ?>
							    <?php foreach ($tabs as $key => $value): ?>
							  		<?php
	   		 						$value = wp_parse_args((array) $value, array('image' => -1, 'tab_title' => 'title', 'content' => '', 'text_url' => '', 'url' => ''));

							  		$str = strtolower(trim( preg_replace( "/[^0-9a-z]+/i", " ", $value['tab_title'] ) )) ;
							  		$tabsId[] = str_replace(" ", "-", $str); ?>
							  		<?php if ($value['tab_title']): ?>
							  		<li role="presentation" class="<?php echo ($i == 0) ? 'active' : '' ?>" >
							  			<a href="<?php echo '#'.$tabsId[$i] ?>" role="tab" data-toggle="tab" <?php echo ($i == 0) ? 'aria-expanded="true"' : '' ?>><span><?php echo $value['tab_title'] ?></span></a>
							  		</li>
							  		<?php endif ?>
							    <?php $i++; endforeach ?>
							  </ul>
						  </div>
						 	<div class="left-control"></div>
							<div class="right-control"></div>
						</div>
						<!-- End Nav tabs -->

					  <!-- Tab panes -->
					  <div class="tab-content">
					  	<div class="tab-overlay"></div>
							<?php $i = 0; ?>
					  	<?php foreach ($tabs as $key => $value): ?>
						  	<?php $value = wp_parse_args((array) $value, array('image' => -1, 'tab_title' => 'title', 'content' => '', 'text_url' => '', 'url' => '')); ?>
						  	<?php $imgUrl = wp_get_attachment_url($value['image']); ?>
						  	<?php $imgBg = ($imgUrl) ? 'background-image:url('.$imgUrl.');' : 'background-image:none' ?>
								<div role="tabpanel" class="tab-pane <?php echo ($i == 0) ? 'active' : '' ?>" id="<?php echo $tabsId[$i] ?>" style="<?php echo $imgBg  ?>">
									<div class="content">
										<h2><?php echo $value['tab_title'] ?></h2>
										<div>
											<p><?php echo $value['content'] ?></p>
											<?php if ($value['url']): ?>
												<p><a href="<?php echo esc_url($value['url']) ?>"><?php echo ($value['text_url']) ? $value['text_url'] : 'More About '.$value['tab_title'] ?></a></p>
											<?php endif ?>
										</div>

									</div>
								</div>
				  		<?php $i++; endforeach ?>
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

		$title 	= ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
		$desc 	= ( isset( $instance[ 'desc' ] ) ) ? $instance[ 'desc' ] : '';
		$tabs 	= ( isset( $instance[ 'tabs' ] ) ) ? $instance[ 'tabs' ] : array();;

		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( ' ', 'jetty' );
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'desc' ); ?>">Description</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'desc' ); ?>" name="<?php echo $this->get_field_name( 'desc' ); ?>" type="text" value="<?php echo esc_attr( $desc ); ?>" placeholder="add desc name"/>
		</p>

		<!-- LOOP -->
		<div class="jetty-widget-vertical-tab-form">
		    <?php
		    		$more = count($tabs);
		        foreach ($tabs as $key => $item) {
		            echo $this->displayTabsItem($item, $key);
		        }
		    ?>
		    <button class="button jiw-add-more<?php echo ($more === 8 ? ' hidden' : ''); ?>" data-widgetbase="<?php echo esc_attr($this->number); ?>"><?php esc_html_e('Add More', 'jvt'); ?></button>
		</div>
		<!-- END LOOP -->
		<?php

	}

	protected function displayTabsItem($item, $i)
	{
	    $item = wp_parse_args((array) $item, array('image' => -1, 'tab_title' => 'title', 'content' => '', 'text_url' => '', 'url' => ''));
	    extract($item);
	    ob_start();
	    ?>
	        <div class="media-item media-item-<?php echo $i; ?>" data-index="<?php echo $i; ?>">
	        		<input type="hidden" name="<?php echo $this->get_field_name("tabs[$i][image]"); ?>" class="jiw_repeatable_attachment_id_field" value="<?php echo esc_attr($image); ?>"/>
			        <div class="jetty-image-choose-action">
			        		<a href="#" class="jiw_upload_file_button button button-primary"><?php _e('Upload', 'jiw'); ?></a>
			            <a href="#" class="jetty-remove-image button button-secondary"><?php _e('Remove', 'jvt'); ?></a>
			        </div>

			        <figure class="image-preview">
			            <?php if ($image !== -1) {
			                $imageUrl = wp_get_attachment_url($image);
			                echo '<img class="preview-image-item preview-image-item-' . $i .'" src="' . $imageUrl .'">';
			            }
			            ?>
			        </figure>

	            <label for="<?php echo esc_attr("tab_title_$i"); ?>"><?php _e('Title', 'jvt'); ?></label>
	            <input type="text" name="<?php echo $this->get_field_name("tabs[$i][tab_title]"); ?>" value="<?php echo esc_attr($tab_title); ?>"/>

	            <label for="<?php echo esc_attr("content_$i"); ?>"><?php _e('Content', 'jvt'); ?></label>
	            <textarea id="<?php echo esc_attr("content_$i"); ?>" name="<?php echo $this->get_field_name("tabs[$i][content]"); ?>" rows="5"><?php echo esc_attr($content); ?></textarea>

	            <label for="<?php echo esc_attr("text_url_$i"); ?>"><?php _e('Text URL', 'jvt'); ?></label>
	            <input type="text" id="<?php echo esc_attr("text_url_$i"); ?>" name="<?php echo $this->get_field_name("tabs[$i][text_url]"); ?>" value="<?php echo esc_attr($text_url); ?>">

	            <label for="<?php echo esc_attr("url_$i"); ?>"><?php _e('URL', 'jvt'); ?></label>
	            <input type="url" id="<?php echo esc_attr("url_$i"); ?>" name="<?php echo $this->get_field_name("tabs[$i][url]"); ?>" value="<?php echo esc_url($url); ?>">
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
		$new_instance = wp_parse_args((array) $new_instance, array( 'title' => '', 'desc' => '', 'tabs' => array()));

		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['desc'] = ( ! empty( $new_instance['desc'] ) ) ? strip_tags( $new_instance['desc'] ) : '';
		$instance['tabs'] = array_values(array_map(array($this, 'sanitizeItem'), $new_instance['tabs']));

		return $instance;
	}

	public function sanitizeItem($item)
	{
	    $item = wp_parse_args((array) $item, array('image' => -1, 'tab_title' => 'title', 'content' => '', 'text_url' => '', 'url' => ''));
	    $cleaned = array();

			$cleaned['image'] = (int) $item['image'];
	    $cleaned['tab_title'] = sanitize_text_field($item['tab_title']);
	    $cleaned['content'] = sanitize_text_field($item['content']);
	    $cleaned['text_url'] = sanitize_text_field($item['text_url']);
	    $cleaned['url'] = sanitize_text_field($item['url']);

	    return $cleaned;
	}
}
