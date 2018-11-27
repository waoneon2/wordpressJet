<?php

/**
 * Adds widget_twitter_feed widget.
 */
class BCBST_Widget_Resources extends WP_Widget
{
	/**
	 * Register widget with WordPress.
	 */
	function __construct()
	{
		parent::__construct(
			'bcbst_widget_resources',
			__('BCBST Resources', 'bcbst'),
			array( 'description' => __( 'This widget for display external resources list', 'bcbst' ), )
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
		$title = $args['before_title'] . apply_filters('widget_title', empty($instance['title']) ? 'Resources' : $instance['title'], $instance, $this->id_base) . $args['after_title'];

		// this place for display in body widget
		$items 	= ( isset( $instance[ 'items' ] ) ) ? $instance[ 'items' ] : array();

		echo $title; ?>
		<ul class="resources">
			<?php foreach ($items as $value): ?>
				<?php if ($value['url'] && $value['text']): ?>
					<li>
						<a href="<?php echo $value['url'] ?>"><?php echo $value['text'] ?></a>
						<p><?php echo $value['desc'] ?></p>
					</li>
				<?php elseif ($value['text']): ?>
					<li>
						<span><?php echo $value['text'] ?> </span>
						<p><?php echo $value['desc'] ?></p>
					</li>
				<?php elseif ($value['url']): ?>
					<li>
						<?php $url_name = parse_url($value['url']);
						$url_name = $url_name['host']; ?>
						<a href="<?php echo $value['url'] ?>"><?php echo $url_name ?></a>
						<p><?php echo $value['desc'] ?></p>
					</li>
				<?php endif ?>
			<?php endforeach ?>
		</ul>
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
		$items 	= ( isset( $instance[ 'items' ] ) ) ? $instance[ 'items' ] : array();;

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

		<!-- LOOP -->
		<div class="bcbst_widget_resources_form">
		    <?php
		    		$more = count($items);
		        foreach ($items as $key => $item) {
		            echo $this->displayTabsItem($item, $key);
		        }
		    ?>
		    <button class="button jiw-add-more<?php echo ($more === 15 ? ' hidden' : ''); ?>" data-widgetbase="<?php echo esc_attr($this->number); ?>"><?php esc_html_e('Add More', 'bcbst'); ?></button>
		</div>
		<!-- END LOOP -->
		<?php

	}

	protected function displayTabsItem($item, $i)
	{
	    $item = wp_parse_args((array) $item, array('text' => 'Resources', 'url' => '', 'desc' => ''));
	    extract($item);
	    ob_start();
	    ?>
	        <div class="media-item media-item-<?php echo $i; ?>" data-index="<?php echo $i; ?>">
			        <div class="jetty-image-choose-action">
			            <a href="#" class="jetty-remove-image button button-secondary"><?php _e('Remove', 'bcbst'); ?></a>
			        </div>
	            <label for="<?php echo esc_attr("text_$i"); ?>"><?php _e('Resource Text', 'bcbst'); ?></label>
	            <input type="text" name="<?php echo $this->get_field_name("items[$i][text]"); ?>" class="" value="<?php echo esc_attr($text); ?>"/>

	            <label for="<?php echo esc_attr("url_$i"); ?>"><?php _e('Resource URL', 'bcbst'); ?></label>
	            <input type="url" name="<?php echo $this->get_field_name("items[$i][url]"); ?>" class="" value="<?php echo esc_url($url); ?>"/>

							<label for="<?php echo esc_attr("desc_$i"); ?>"><?php _e('Description', 'bcbst'); ?></label>
							<textarea name="<?php echo $this->get_field_name("items[$i][desc]"); ?>"><?php echo esc_attr($desc); ?></textarea>
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
		$new_instance = wp_parse_args((array) $new_instance, array( 'title' => 'Resources', 'items' => array()));

		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['items'] = array_values(array_map(array($this, 'sanitizeItem'), $new_instance['items']));

		return $instance;
	}

	public function sanitizeItem($item)
	{
	    $item = wp_parse_args((array) $item, array('text' => '', 'url' => '', 'desc' => ''));
	    $cleaned = array();

	    $cleaned['text'] = sanitize_text_field($item['text']);
	    $cleaned['url'] = sanitize_text_field($item['url']);
	    $cleaned['desc'] = sanitize_text_field($item['desc']);

	    return $cleaned;
	}
}
