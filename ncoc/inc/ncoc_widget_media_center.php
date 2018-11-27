<?php

class ncoc_widget_media_center extends WP_Widget {

function __construct() {
parent::__construct(

'ncoc_widget_media_center', 

__('NCOC Media Center', 'ncoc'), 

array( 'description' => __( 'Display List of Media Center', 'ncoc' ), ) 
);
}


public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
$get_link = __( '<li><a href="%s" title="%s">%s</a></li>', 'ncoc' );

echo $args['before_widget'];
echo '<div id="media-box"><ul id="rPmedia-menu"><li>';
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];
echo '<ul>';
printf($get_link,get_cat_url( 'News and Events' ),__('News and Events','ncoc'),__('News and Events','ncoc'));
printf($get_link,get_cat_url( 'Publications' ),__('Publications','ncoc'),__('Publications','ncoc'));
printf($get_link,get_cat_url( 'Contacts' ),__('Contact the Media relations team','ncoc'),__('Contact the Media relations team','ncoc'));
echo '</ul>';
echo '</li></ul></div>';
echo $args['after_widget'];
}
		

public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = __( 'MEDIA CENTER', 'ncoc' );
}

?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<?php 
}

public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
return $instance;
}
} 


function ncoc_load_widget() {
	register_widget( 'ncoc_widget_media_center' );
}
add_action( 'widgets_init', 'ncoc_load_widget' );
?>