<?php

/**
 * Adds widget_twitter_feed widget.
 */
class Jetty_Widget_Horizontal_Tab extends WP_Widget
{
	/**
	 * Register widget with WordPress.
	 */
	function __construct()
	{
		parent::__construct(
			'jetty_widget_horizontal_tab',
			__('Jetty Horizontal Tabs', 'jetty'),
			array( 'description' => __( 'This widget for display horizontal tab on certain page', 'jetty' ), )
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

		//echo "<pre>";
		//print_r($tabs );
		//echo "</pre>";

		?>

		<div class="horizontal-tabs" style="margin-top: 60px;">

			<!-- Title and Description -->
			<div class="contained wide-content section-top">
				<div class="row text-center">
					<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
						<?php echo $title ?>
						<p><?php echo $desc ?></p>
					</div>
				</div>
			</div>
			<!-- End Title and Description -->

			<!-- Tabs -->
			<div class="contained flush tabs-component">
				<div class="tabs-contain">
					<div class="tabs">
					  <!-- Nav tabs -->

					  <ul class="nav nav-tabs horizontal-tabs-nav" role="tablist" data-breakpoints="xs,sm,md,lg">
					  <?php $i = 0 ?>
					  <?php foreach ($tabs as $key => $value): ?>
							<?php
							$str = strtolower(trim( preg_replace( "/[^0-9a-z]+/i", " ", $value['tab_title'] ) )) ;
							$tabsId[] = str_replace(" ", "-", $str); ?>
							<?php if ($value['tab_title']): ?>
								<li role="presentation" class="<?php echo ($i == 0) ? 'active' : '' ?>" >
									<a href="<?php echo '#'.$tabsId[$i] ?>" role="tab" data-toggle="tab" <?php echo ($i == 0) ? 'aria-expanded="true"' : '' ?>><?php echo $value['tab_title'] ?></a>
								</li>
							<?php endif ?>
					  <?php $i++; endforeach ?>
					</div>
				 	<div class="left-control"></div>
					<div class="right-control"></div>
				</div>
			</div>
			<!-- End Tabs -->

			<!-- Tabs Content -->
			<div class="contained flush section-bottom">
				<div class="tabs-content">
					<div class="row">
					  <!-- Tab panes -->
					  <div class="tab-content">
					  	<?php $i = 0; ?>
					  	<?php foreach ($tabs as $key => $value): ?>
								<div role="tabpanel" class="tab-pane <?php echo ($i == 0) ? 'active' : '' ?>" id="<?php echo $tabsId[$i] ?>">
									<div class="row">
										<?php if ($value['content1'] && $value['content2']) { ?>
											<div class="col-sm-6">
												<p><?php echo $value['content1'] ?></p>
											</div>
											<div class="col-sm-6">
												<p><?php echo $value['content2'] ?></p>
											</div>
										<?php } elseif ($value['content1']) { ?>
											<div class="col-sm-12">
												<p><?php echo $value['content1'] ?></p>
											</div>
										<?php } elseif ($value['content2']) { ?>
											<div class="col-sm-12">
												<p><?php echo $value['content2'] ?></p>
											</div>
										<?php } else {  ?>
											<div class="col-sm-12">
												<p> - </p>
											</div>
										<?php } ?>
									</div>
								</div>
					  	<?php $i++; endforeach ?>
					  </div>

					</div>

				</div>
			</div>
			<!-- End Tabs Content -->
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
		<div class="jetty-widget-horizontal-tab-form">
		    <?php
		    		$more = count($tabs);
		        foreach ($tabs as $key => $item) {
		            echo $this->displayTabsItem($item, $key);
		        }
		    ?>
		    <button class="button jiw-add-more<?php echo ($more === 8 ? ' hidden' : ''); ?>" data-widgetbase="<?php echo esc_attr($this->number); ?>"><?php esc_html_e('Add More', 'jht'); ?></button>
		</div>
		<!-- END LOOP -->
		<?php

	}

	protected function displayTabsItem($item, $i)
	{
	    $item = wp_parse_args((array) $item, array('tab_title' => 'title', 'content1' => '', 'content2' => ''));
	    extract($item);
	    ob_start();
	    ?>
	        <div class="media-item media-item-<?php echo $i; ?>" data-index="<?php echo $i; ?>">
			        <div class="jetty-image-choose-action">
			            <a href="#" class="jetty-remove-image button button-secondary"><?php _e('Remove', 'jht'); ?></a>
			        </div>
	            <label for="<?php echo esc_attr("tab_title_$i"); ?>"><?php _e('Title', 'jht'); ?></label>
	            <input type="text" name="<?php echo $this->get_field_name("tabs[$i][tab_title]"); ?>" class="jiw_repeatable_attachment_id_field" value="<?php echo esc_attr($tab_title); ?>"/>

	            <label for="<?php echo esc_attr("content1_$i"); ?>"><?php _e('Content 1', 'jht'); ?></label>
	            <!-- <input type="text" id="<?php echo esc_attr("content1_$i"); ?>" name="<?php echo $this->get_field_name("tabs[$i][content1]"); ?>" value="<?php echo esc_attr($content1); ?>"> -->
	            <textarea id="<?php echo esc_attr("content1_$i"); ?>" name="<?php echo $this->get_field_name("tabs[$i][content1]"); ?>" rows="5"><?php echo $content1; ?></textarea>

	            <label for="<?php echo esc_attr("content2_$i"); ?>"><?php _e('Content 2', 'jht'); ?></label>
	            <!-- <input type="text" id="<?php echo esc_attr("content2_$i"); ?>" name="<?php echo $this->get_field_name("tabs[$i][content2]"); ?>" value="<?php echo esc_attr($content2); ?>"> -->
	            <textarea id="<?php echo esc_attr("content2_$i"); ?>" name="<?php echo $this->get_field_name("tabs[$i][content2]"); ?>" rows="5"><?php echo $content2; ?></textarea>
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
	    $item = wp_parse_args((array) $item, array('tab_title' => 'title', 'content1' => '', 'content2' => ''));
	    $cleaned = array();

	    $cleaned['tab_title'] = sanitize_text_field($item['tab_title']);
	    $cleaned['content1'] = $item['content1'];
	    $cleaned['content2'] = $item['content2'];

	    return $cleaned;
	}
}
