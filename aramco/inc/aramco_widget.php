<?php class aramco_widget_post_related extends WP_Widget {
    function __construct(){
        parent::__construct(
            'aramco_widget_post_related',
            __('Aramco Post Related', 'aramco_widget_domain'),
            array(
                'description' => __('Widget to display post related', 'aramco_widget_domain'),
            )
        );
    }

    public function widget($args,$instance){
        global $wp;
        $cats = 'none';
        $cat_name = 'none';
        $cat_part = 'none';
        $sc = '';
        $url_part = add_query_arg(array(),$wp->request);
        $post_categories = get_the_category( get_the_ID() );
        
        echo $args['before_widget'];

        if(is_home() || is_single() || is_archive() || is_front_page()){

            foreach($post_categories as $c){
                $cat_part = $c->category_parent;
                $cats = $c->slug;
                $cat_name = $c->name;
            }
            
            // Get the ID of a given category
            $category_id = get_cat_ID( $cat_name );

            // Get the URL of this category
            $category_link = get_category_link( $category_id );
            if(is_tag()){
                $current_tag = single_tag_title("", false);

                echo $args['before_title'] . '<a href='.esc_url(get_tag_link()).'>'.$current_tag. '</a>' . $args['after_title'];
            } else {

                echo $args['before_title'] . '<a href='.esc_url( $category_link ).'>'.$cat_name. '</a>' . $args['after_title'];
            }

            $sc = 'category_name='.$cats;
            $the_query = new WP_Query( $sc );

            if ( $the_query->have_posts() ) {
            
                echo '<ul>';
                while ( $the_query->have_posts() ) {
                    $the_query->the_post();
                    if(basename(esc_url(get_permalink())) ===  $url_part ){
                        echo __('<li><a href='.esc_url(get_permalink()).' class="visited"><span aria-hidden="true" data-icon="&#xe619;"></span>'.get_the_title().'<span class="dashicons dashicons-arrow-right-alt2"></span></a></li>','aramco_widget_domain');
                    }
                    else {
                        echo __('<li><a href='.esc_url(get_permalink()).'><span aria-hidden="true" data-icon="&#xe619;"></span>'.get_the_title().'<span class="dashicons dashicons-arrow-right-alt2"></span></a></li>','aramco_widget_domain');
                    }
                    
                }
                echo '</ul>';
            } else {
                // no posts found
            }
            /* Restore original Post Data */
            wp_reset_postdata();
        } 

        else if(is_page()){

            echo $args['before_title'] . '<a href='.esc_url( get_page_link() ).'>'.get_the_title(). '</a>' . $args['after_title'];
        }

        else if(is_404()){
            $title_name = 'Page not found';
            echo $args['before_title'] . '<a href=#>'.$title_name. '</a>' . $args['after_title'];
        }

        echo $args['after_widget'];
    }
}

function aramco_load_widget() {
	register_widget( 'aramco_widget_post_related' );
}
add_action( 'widgets_init', 'aramco_load_widget' );
?>