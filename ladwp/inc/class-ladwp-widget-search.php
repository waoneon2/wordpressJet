<?php
/**
 * LADWP Search. To allow search by category and Years
 */
class LADWP_Widget_Search extends WP_Widget
{
    public function __construct()
    {
        $widget_ops = array(
            'classname' => 'widget_ladwp_search',
            'description' => __( 'A search form for LADWP site. Allow filter by categories and year. It used for category', 'ladwp' ),
            'customize_selective_refresh' => true,
        );
        parent::__construct( 'ladwp_search', _x( 'LADWP Search', 'LADWP Search widget' ), $widget_ops );
    }

    public function widget($args, $instance)
    {
        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

        echo $args['before_widget'];
        if ( $title ) {
            echo $args['before_title'] . $title . $args['after_title'];
        }
        get_ladwp_search_form();
        echo $args['after_widget'];
    }

    /**
     * Outputs the settings form for the Search widget.
     *
     */
    public function form($instance)
    {
        $instance = wp_parse_args( (array) $instance, array( 'title' => '') );
        $title = $instance['title'];
        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
        <?php
    }

    /**
     * Handles updating settings for the current Search widget instance.
     *
     */
    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $new_instance = wp_parse_args((array) $new_instance, array( 'title' => ''));
        $instance['title'] = sanitize_text_field($new_instance['title']);
        return $instance;
    }
}