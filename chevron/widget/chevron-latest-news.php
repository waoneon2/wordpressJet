<?php

add_action( 'widgets_init', function(){
     register_widget( 'chevron_latest_news' );
});
/**
 * Adds chevron_latest_news widget.
 */
class chevron_latest_news extends WP_Widget {
  /**
   * Register widget with WordPress.
   */
  function __construct() {
    parent::__construct(
      'chevron_latest_news', // Base ID
      __('Chevron Latest News', 'chevron'), // Name
      array( 'description' => __( 'This widget for latest news widget', 'chevron' ), ) // Args
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
  public function widget( $args, $instance ) {

    echo $args['before_widget'];

    $title = apply_filters('widget_title', empty($instance['title']) ? 'adsadsadsads' : $instance['title'], $instance, $this->id_base);
    // this place for display in body widget
    $desc     = apply_filters('widget_title', empty($instance['desc']) ? '' : $instance['desc']);
    $catID    = apply_filters('widget_title', empty($instance['cat']) ? -1 : $instance['cat']);
    ?>

    <h2 class="widget-title"><?php echo $title ?></h2>

    <?php echo '<ul class="latestnews">';
    $pages = array(
      'cat'  => $catID,
      'post_type' => 'post',
      'orderby' => 'date',
      'order' => 'DESC',
      'posts_per_page' => 5
    );

    $queryObject = new WP_Query($pages);
    if ( $queryObject->have_posts() ) :
      while ($queryObject->have_posts()) : $queryObject->the_post(); ?>
          <li>
            <a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a>
            <a class="rm" href="<?php the_permalink(); ?>"><span>read more <span class="glyphicon glyphicon-menu-right"></span></span></a>
          </li>
      <?php endwhile;
    endif;
    wp_reset_query();
    echo '</ul>';


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

    $title    = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
    $desc     = ( isset( $instance[ 'desc' ] ) ) ? $instance[ 'desc' ] : '';
    $cat      = ( isset( $instance[ 'cat' ] ) ) ? $instance[ 'cat' ] : -1;

    if ( isset( $instance[ 'title' ] ) ) {
      $title = $instance[ 'title' ];
    }
    else {
      $title = __( 'Latest News', 'jetty' );
    }

    ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'chevron' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'cat' ); ?>"><?php _e('Select category for the gallery', 'chevron'); ?></label><br />
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
    $new_instance = wp_parse_args((array) $new_instance, array( 'title' => '', 'cat' => -1));

    $instance['title'] = sanitize_text_field($new_instance['title']);
    $instance['cat'] = (int) $new_instance['cat'];

    return $instance;
  }
} // class chevron_latest_news

?>
