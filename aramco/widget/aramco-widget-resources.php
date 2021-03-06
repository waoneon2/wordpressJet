<?php

/**
 * Adds widget_twitter_feed widget.
 */
class Aramco_Widget_Resources extends WP_Widget
{
	/**
	 * Register widget with WordPress.
	 */
	function __construct()
	{
		parent::__construct(
			'aramco_widget_resources',
			__('Aramco Resources', 'aramco'),
			array( 'description' => __( 'This widget for display external resources list', 'aramco' ), )
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
		$desc 	=  apply_filters('widget_title', empty($instance['desc']) ? '' : $instance['desc']);
		$items 	= ( isset( $instance[ 'items' ] ) ) ? $instance[ 'items' ] : array();

		echo $title; ?>
		<ul>
			<?php foreach ($items as $value): ?>
				<?php if ($value['url'] && $value['text']): ?>
					<li><a href="<?php echo esc_url($value['url']); ?>"><?php echo $value['text']; ?> <span class="dashicons dashicons-arrow-right-alt2"></span></a></li>
				<?php elseif ($value['text']): ?>
					<li><span><?php echo $value['text']; ?> </span></li>
				<?php endif; ?>
			<?php endforeach; ?>
		</ul>
		<style type="text/css">
			.widget_aramco_widget_resources ul {
				list-style: none;
				margin:0;
				padding: 0;
			}
			.widget_aramco_widget_resources ul li {
				border-bottom: 1px solid #e3e3e3;
				color: #676a6e;
				padding: 10px 0px 3px;
			}
			.widget_aramco_widget_resources ul li a {
				text-decoration: none;
			}
			.widget_aramco_widget_resources .dashicons {
				font-size: 14px;
				vertical-align: bottom;
			}
		</style>
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
		<div class="aramco_widget_resources_form">
		    <?php
		    		$more = count($items);
		        foreach ($items as $key => $item) {
		            echo $this->displayTabsItem($item, $key);
		        }
		    ?>
		    <button class="button jiw-add-more<?php echo ($more === 15 ? ' hidden' : ''); ?>" data-widgetbase="<?php echo esc_attr($this->number); ?>"><?php esc_html_e('Add More', 'aramco'); ?></button>
		</div>
		<!-- END LOOP -->
		<?php

	}

	protected function displayTabsItem($item, $i)
	{
	    $item = wp_parse_args((array) $item, array('text' => 'Resources', 'url' => ''));
	    extract($item);
	    ob_start();
	    ?>
	        <div class="media-item media-item-<?php echo $i; ?>" data-index="<?php echo $i; ?>">
			        <div class="jetty-image-choose-action">
			            <a href="#" class="jetty-remove-image button button-secondary"><?php _e('Remove', 'aramco'); ?></a>
			        </div>
	            <label for="<?php echo esc_attr("text_$i"); ?>"><?php _e('Resource Text', 'aramco'); ?></label>
	            <input type="text" name="<?php echo $this->get_field_name("items[$i][text]"); ?>" class="" value="<?php echo esc_attr($text); ?>"/>

	            <label for="<?php echo esc_attr("url_$i"); ?>"><?php _e('Resource URL', 'aramco'); ?></label>
	            <input type="url" name="<?php echo $this->get_field_name("items[$i][url]"); ?>" class="" value="<?php echo esc_url($url); ?>"/>
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
	    $item = wp_parse_args((array) $item, array('text' => '', 'url' => ''));
	    $cleaned = array();

	    $cleaned['text'] = sanitize_text_field($item['text']);
	    $cleaned['url'] = sanitize_text_field($item['url']);

	    return $cleaned;
	}
}
