<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

if ( !function_exists( 'chld_thm_cfg_parent_css' ) ):
    function chld_thm_cfg_parent_css() {
        wp_enqueue_style( 'chld_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array( 'font-awesome' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'chld_thm_cfg_parent_css');
         
if ( !function_exists( 'child_theme_configurator_css' ) ):
    function child_theme_configurator_css() {
        wp_enqueue_style( 'chld_thm_cfg_separate', trailingslashit( get_stylesheet_directory_uri() ) . 'ctc-style.css', array('bp-style' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'child_theme_configurator_css', 30);

if(!function_exists('bp_child_register_script')):
	function bp_child_register_script(){
		wp_enqueue_style( 'bootstrap-css', trailingslashit(get_stylesheet_directory_uri()) . 'libs/css/bootstrap.min.css', array() );
        if(defined('ICL_LANGUAGE_CODE')) :
        if(ICL_LANGUAGE_CODE == 'ar') { 
           wp_enqueue_style( 'bootstrap-rtl-css', trailingslashit(get_stylesheet_directory_uri()) . 'libs/css/bootstrap-rtl.css', array() ); 
        }
        endif;
		wp_enqueue_script( 'bootstrap-js', trailingslashit(get_stylesheet_directory_uri()) . 'libs/js/bootstrap.min.js', array('jquery'), '3.3.7', true );
		wp_enqueue_script( 'custom-bp-childs-js', trailingslashit(get_stylesheet_directory_uri()) . 'js/bp-child.js');
	}
endif;
add_action( 'wp_enqueue_scripts', 'bp_child_register_script', 25);

if(!function_exists('rm_register_script')):
	function rm_register_script() {
		wp_dequeue_style( 'grid-style' );
    	wp_deregister_style( 'grid-style' );
	}
endif;
add_action( 'wp_enqueue_scripts', 'rm_register_script', 20 );

class custom_walker_nav_menu extends Walker {
    var $tree_type = array( 'post_type', 'taxonomy', 'custom' );
    var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );
    function start_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth+1);
        $output .= "\t\n$indent\t<ul class=\"sub-menu dropdown-menu\">\n";
    }
    function end_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth+1);
        $output .= "$indent\t</ul>\n";
    }
    function start_el(&$output, $object, $depth = 0, $args = array(), $current_object_id = 0) { 
        global $wp_query;
        $products = array( 'siris', 'siris-lite', 'alto', 'genisis', 'g-series' );
        $replace = array(' '=> '-');
        $shortened_title = strtolower(strtr($object->title, $replace));
        $indent = ( $depth ) ? str_repeat( "\t", $depth+1 ) : '';
        $class_names = $value = '';
        $classes = empty( $object->classes ) ? array() : (array) $object->classes;
        $classes = in_array( 'current-menu-item', $classes ) ? array( 'current-menu-item' ) : $classes;
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $object, $args ) );
        if (in_array($shortened_title, $products) && $depth==1){
            $class_names .= ' product ' . $shortened_title;
        } else if ($depth==1) {
            $class_names .= ' page';
        }
        $class_names = strlen( trim( $class_names ) ) > 0 ? ' class="' . esc_attr( $class_names ) . '"' : '';
        $id = apply_filters( 'nav_menu_item_id', '', $object, $args );
        $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
        $output .= "\n$indent\t" .'<li' . $id . $value . $class_names .'>'."\n\t$indent\t";
        $attributes  = ! empty( $object->attr_title ) ? ' title="'  . esc_attr( $object->attr_title ) .'"' : '';
        $attributes .= ! empty( $object->target )     ? ' target="' . esc_attr( $object->target     ) .'"' : '';
        $attributes .= ! empty( $object->xfn )        ? ' rel="'    . esc_attr( $object->xfn        ) .'"' : '';
        $attributes .= ! empty( $object->url )        ? ' href="'   . esc_attr( $object->url        ) .'"' : '';
        $object_output = $args->before;
        $object_output .= '<a'. $attributes .'>';
        $object_output .= $args->link_before . apply_filters( 'the_title', $object->title, $object->ID ) . $args->link_after;
        if (in_array($shortened_title, $products) && $depth==1){
			$img_url = wp_get_attachment_image_src(get_post_thumbnail_id($object->object_id), 'medium');
            $img_src = $img_url[0];
            $object_output .= "<br><img src=\"$img_src\" alt=\"$shortened_title\" />";
        } else if ($depth==1) {
            $object_output .= ' <strong>&gt;</strong>';
        }
        $object_output .= "</a>\n$indent\t";
        $object_output .= $args->after;
        $output .= apply_filters( 'walker_nav_menu_start_el', $object_output, $object, $depth, $args );
    }
    function end_el(&$output, $object, $depth = 0, $args = array()) {
        $output .= "</li>\n";
    }
}
if(!function_exists('FileSizeConvert')):
function FileSizeConvert($bytes)
{
    $bytes = floatval($bytes);
        $arBytes = array(
            0 => array(
                "UNIT" => "TB",
                "VALUE" => pow(1024, 4)
            ),
            1 => array(
                "UNIT" => "GB",
                "VALUE" => pow(1024, 3)
            ),
            2 => array(
                "UNIT" => "MB",
                "VALUE" => pow(1024, 2)
            ),
            3 => array(
                "UNIT" => "KB",
                "VALUE" => 1024
            ),
            4 => array(
                "UNIT" => "B",
                "VALUE" => 1
            ),
        );

    foreach($arBytes as $arItem)
    {
        if($bytes >= $arItem["VALUE"])
        {
            $result = $bytes / $arItem["VALUE"];
            $result = str_replace(".", "," , strval(round($result, 2)))." ".$arItem["UNIT"];
            break;
        }
    }
    return $result;
}
endif;

// Creating the widget 
class factSheet_widget extends WP_Widget {

    function __construct() {
    parent::__construct(
    'factSheet_widget', 
    __('Facts Sheet Widget', 'bpc_widget_domain'), 
    array( 'description' => __( 'Widget to display recent update from Facts Sheet', 'bpc_widget_domain' ), ) 
    );
    }

    function getRealtyListings($numberOfListings) {
        $sheets = new WP_Query();
        $sheets->query('post_type=sheet&orderby=post_date&order=DESC&post_status=publish&posts_per_page=' . $numberOfListings );
        if($sheets->found_posts > 0) {
            echo "<div class='list-group'>";
                while ($sheets->have_posts()) {
                    echo "<div class='list-group-item'>";
                    $sheets->the_post();
                    $doc_id = get_post_meta( get_the_ID(), '_bp_sheet_file', true );
                    $filename = basename($doc_id);
                    printf("<small class='doc-date'>%s</small>",get_the_date());
                    printf("<h4 class='doc-head list-group-item-heading'><a href='%s'>%s</a></h4>",get_permalink(),get_the_title());
                    printf("<p><a href='%s'><img class='img-thumbnail' src='%s/img/pdf_lrg.gif' width='24' height='24' alt='File Type Icon'></a></p>",$doc_id,get_stylesheet_directory_uri());
                    echo "</div>";
                }
            echo "</div>";
            wp_reset_postdata();
        } else {
            echo '<p style="padding:25px;">No Sheets found</p>';
        }
    }

    public function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
        $numberOfListings = $instance['numberOfListings'];
        echo $args["before_widget"];
        if ( $title ) {
            echo $args["before_title"] . $title . $args["after_title"];
        }
        $this->getRealtyListings($numberOfListings);
        echo $args["after_widget"];
    }
            
    // Widget Backend 
    public function form( $instance ) {
        if( $instance) {
            $title = esc_attr($instance['title']);
            $numberOfListings = esc_attr($instance['numberOfListings']);
        } else {
            $title = '';
            $numberOfListings = '';
        }
    // Widget admin form
    ?>
    <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'bpc_widget_domain'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id('numberOfListings'); ?>"><?php _e('Number of Listings:', 'bpc_widget_domain'); ?></label>
        <select id="<?php echo $this->get_field_id('numberOfListings'); ?>"  name="<?php echo $this->get_field_name('numberOfListings'); ?>">
            <?php for($x=1;$x<=10;$x++): ?>
            <option <?php echo $x == $numberOfListings ? 'selected="selected"' : '';?> value="<?php echo $x;?>"><?php echo $x; ?></option>
            <?php endfor;?>
        </select>
    </p>
    <?php 
    }
        
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
    $instance['numberOfListings'] = strip_tags($new_instance['numberOfListings']);
    return $instance;
    }
} // Class bpc_widget ends here

// Register and load the widget
function bpc_load_widget() {
    register_widget( 'factSheet_widget' );
}
add_action( 'widgets_init', 'bpc_load_widget' );