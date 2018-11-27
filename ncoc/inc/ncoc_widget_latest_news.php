<?php

class ncoc_widget_latest_news extends WP_Widget {

function __construct() {
parent::__construct(

'ncoc_widget_latest_news', 

__('NCOC Latest News', 'ncoc_widget_domain'), 

array( 'description' => __( 'Display Latest News', 'ncoc_widget_domain' ), ) 
);
}

public function widget( $args, $instance ) {
$current_date = date("Y");
$args_news = array(
	'category_name' 	=> 'news-and-events',
	'post_type' 		=> array('post'),
	'post_status' 		=> array('publish'),
	'posts_per_page' 	=> 2,
	'order' 			=> 'DESC',
	'orderby' 			=> 'date',
	'year'				=> $current_date
);
$news_query = new WP_Query($args_news);

$title = apply_filters( 'widget_title', $instance['title'] );
$get_link = __( '<li><a href="%s" title="%s">%s</a></li>', 'ncoc_widget_domain' );

echo $args['before_widget'];

if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];
echo '<div id="latest-news-box">';
if ( $news_query->have_posts() ) :
	while ( $news_query->have_posts() ) : $news_query->the_post();	
	$default_permalink = esc_url( get_permalink() );
	if(jetty_get_the_excerpt(get_the_ID())){
		$url_file = esc_url(jetty_get_the_excerpt(get_the_ID()));
		$link_validation = parse_url($url_file);
		if(count($link_validation) >= 3){
			$default_permalink = $url_file;
		}
	}
	?>
	<div class="latest-news-content">
		<div class="content-title">
		<p class="date-latest-news"><b><?php the_time('j F Y'); ?></b></p>
			<?php the_title( '<p class="ncoc entry-title-latest-news"><a href="' . $default_permalink . '" rel="bookmark">', '<br><strong class="blue">MORE...</strong></a></p>' ); ?>
		</div>
	</div>
	<?php
	endwhile;
else:
	echo __("No last news here.", "ncoc_widget_domain");
endif;
echo '</div>';
echo $args['after_widget'];
}
		

public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = __( 'LATEST NEWS', 'ncoc_widget_domain' );
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

function ncoc_ln_load_widget() {
	register_widget( 'ncoc_widget_latest_news' );
}
add_action( 'widgets_init', 'ncoc_ln_load_widget' );
?>