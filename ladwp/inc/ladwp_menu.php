<?php # -*- coding: utf-8 -*-
/**
 * Create a nav.
 *
 * @author Dharmawan
 * @version 1.0
 */
class ladwp_walker_nav_menu extends Walker_Nav_Menu {
    var $tree_type = array( 'post_type', 'taxonomy', 'custom' );
    var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );
    public $data = array();

    function start_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth+1);
        if ($depth == 0)
        $output .= "\t\n$indent\t<div class=\"subnav\">\n";

        $output .= "\t\n$indent\t<ul class=\"\">\n";
    }
    function end_lvl(&$output, $depth = 0, $args = array()) {

        $indent = str_repeat("\t", $depth+1);
        $output .= "$indent\t</ul>\n";
        if ($depth == 0) {
            $output .= $this->show_page();
            $output .= "\t\n$indent\t</div>\n";
           // print_r($args);exit;
        }

    }
    function start_el(&$output, $object, $depth = 0, $args = array(), $current_object_id = 0) {
        global $wp_query;
        $this->data[$object->ID] = $object;
        //print_r($object);

        $indent = ( $depth ) ? str_repeat( "\t", $depth+1 ) : '';
        $class_names = $value = '';
        $classes = empty( $object->classes ) ? array() : (array) $object->classes;
        $classes = in_array( 'current-menu-item', $classes ) ? array( 'current-menu-item' ) : $classes;
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $object, $args ) );

        $class_names = strlen( trim( $class_names ) ) > 0 ? ' class="' . esc_attr( $class_names ) .'"' : '';
        $id = apply_filters( 'nav_menu_item_id', '', $object, $args );
        $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
        $output .= "\n$indent\t" .'<li' . $id . $value . $class_names . ' data-tabID="'.trim($object->ID).'" >'."\n\t$indent\t";
        $attributes  = ! empty( $object->attr_title ) ? ' title="'  . esc_attr( $object->attr_title ) .'"' : '';
        $attributes .= ! empty( $object->target )     ? ' target="' . esc_attr( $object->target     ) .'"' : '';
        $attributes .= ! empty( $object->xfn )        ? ' rel="'    . esc_attr( $object->xfn        ) .'"' : '';
        $attributes .= ! empty( $object->url )        ? ' href="'   . esc_attr( $object->url        ) .'"' : '';

        if(isset($args->before)):
        $object_output = $args->before;
        $object_output .= '<a'. $attributes .'>';
        $object_output .= $args->link_before . apply_filters( 'the_title', $object->title, $object->ID ) . $args->link_after;
        if ($depth == 1) $object_output .= '<span class="sprite arrow"></span>';
        $object_output .= "</a>\n$indent\t";
        $object_output .= $args->after;
        $output .= apply_filters( 'walker_nav_menu_start_el', $object_output, $object, $depth, $args );
        endif;
    }
    function end_el(&$output, $object, $depth = 0, $args = array()) {
        $output .= "</li>\n";
    }

    function show_page() {
        //print_r( $this->data);
        $data = $this->data;
        $output = '';
        foreach ($data as $key => $val) {
            if ($val->menu_item_parent != 0) {
                $img_thumb = get_the_post_thumbnail( $val->object_id, 'thumbnail' ) ? get_the_post_thumbnail( $val->object_id, 'thumbnail' ) : '';
                $desc = apply_filters('the_content', $val->description);
                $desc = str_replace( ']]>', ']]&gt;', $desc );
                $output .= '<div id="our-'.$val->ID.'" class="tab-content ladwp-tab-content ui-tabs-panel ui-widget-content ui-corner-bottom" aria-labelledby="ui-id-8" role="tabpanel" aria-hidden="false" style="display: none;" data-tabid="'.$val->ID.'"><div class="col nav-wide-content">
                    <h2>'.$val->title.'</h2>
                    <div class="text-content">' . $desc . '</div>
                    </div>
                    <div class="col nav-narrow-content">'.$img_thumb.'</div></div>';
            }
        }

        return $output;
    }
}

/**
 * Create a MOBILE NAV
 *
 * @author Dharmawan
 * @version 1.0
 */
class ladwp_mobile_walker_nav_menu extends Walker_Nav_Menu {
    var $tree_type = array( 'post_type', 'taxonomy', 'custom' );
    var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );
    function start_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth+1);
        $output .= "\t\n$indent\t<ul class=\"sub-menu\">\n";
    }
    function end_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth+1);
        $output .= "$indent\t</ul>\n";
    }
    function start_el(&$output, $object, $depth = 0, $args = array(), $current_object_id = 0) {
        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth+1 ) : '';
        $class_names = $value = '';
        $classes = empty( $object->classes ) ? array() : (array) $object->classes;
        $classes = in_array( 'current-menu-item', $classes ) ? array( 'current-menu-item' ) : $classes;
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $object, $args ) );

        $class_names = strlen( trim( $class_names ) ) > 0 ? ' class="' . esc_attr( $class_names ) . '"' : '';
        $id = apply_filters( 'nav_menu_item_id', '', $object, $args );
        $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
        $output .= "\n$indent\t" .'<li' . $id . $value . $class_names .'>'."\n\t$indent\t";
        $attributes  = ! empty( $object->attr_title ) ? ' title="'  . esc_attr( $object->attr_title ) .'"' : '';
        $attributes .= ! empty( $object->target )     ? ' target="' . esc_attr( $object->target     ) .'"' : '';
        $attributes .= ! empty( $object->xfn )        ? ' rel="'    . esc_attr( $object->xfn        ) .'"' : '';
        $attributes .= ! empty( $object->url )        ? ' href="'   . esc_attr( $object->url        ) .'"' : '';
        if(isset($args->before)):
        $object_output = $args->before;
        $object_output .= '<a'. $attributes .'>';
        $object_output .= $args->link_before . apply_filters( 'the_title', $object->title, $object->ID ) . $args->link_after;
        if($depth == 0){
            $object_output .= '<span class="fa"></span>';
        }
        $object_output .= "</a>\n$indent\t";
        $object_output .= $args->after;
        $output .= apply_filters( 'walker_nav_menu_start_el', $object_output, $object, $depth, $args );
        endif;
    }
    function end_el(&$output, $object, $depth = 0, $args = array()) {
        $output .= "</li>\n";
    }
}



/**
 * Create a MOBILE NAV
 *
 * @author Dharmawan
 * @version 1.0
 */
class ladwp_social_nav extends Walker_Nav_Menu {
    var $tree_type = array( 'post_type', 'taxonomy', 'custom' );
    var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );
    function start_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth+1);
        $output .= "\t\n$indent\t<ul class=\"sub-menu\">\n";
    }
    function end_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth+1);
        $output .= "$indent\t</ul>\n";
    }
    function start_el(&$output, $object, $depth = 0, $args = array(), $current_object_id = 0) {
        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth+1 ) : '';
        $class_names = $value = '';
        $classes = empty( $object->classes ) ? array() : (array) $object->classes;
        $classes = in_array( 'current-menu-item', $classes ) ? array( 'current-menu-item' ) : $classes;
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $object, $args ) );

        $class_names = strlen( trim( $class_names ) ) > 0 ? ' class="' . esc_attr( $class_names ) . '"' : '';
        $id = apply_filters( 'nav_menu_item_id', '', $object, $args );
        $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
        $output .= "\n$indent\t" .'<li' . $id . $value . $class_names .'>'."\n\t$indent\t";
        $attributes  = ! empty( $object->attr_title ) ? ' title="'  . esc_attr( $object->attr_title ) .'"' : '';
        $attributes .= ! empty( $object->target )     ? ' target="' . esc_attr( $object->target     ) .'"' : '';
        $attributes .= ! empty( $object->xfn )        ? ' rel="'    . esc_attr( $object->xfn        ) .'"' : '';
        $attributes .= ! empty( $object->url )        ? ' href="'   . esc_attr( $object->url        ) .'"' : '';

        $sosmed = strtolower($object->title);
        $sosmed = trim($sosmed);
        $sosmed = strip_tags($sosmed);
        $sosmed_status = false;

        if ($sosmed == 'facebook') {
            $sosmed_status = true;
            $sosmed_url = get_template_directory_uri() . '/img/FB-29x29.png';
        } elseif ($sosmed == 'twitter') {
            $sosmed_status = true;
            $sosmed_url = get_template_directory_uri() . '/img/Twitter-32x29.png';
        } elseif ($sosmed == 'youtube') {
            $sosmed_status = true;
            $sosmed_url = get_template_directory_uri() . '/img/YouTube-29x29.png';
        } elseif ($sosmed == 'linkedin') {
            $sosmed_status = true;
            $sosmed_url = get_template_directory_uri() . '/img/LinkedIn-29x38.png';
        }
        if(isset($args->before)):
        $object_output = $args->before;
        $object_output .= '<a'. $attributes .'>';

        if ($sosmed_status) {
            $object_output .= '<img src="'.$sosmed_url.'" alt="'.$object->title.'" class="cq-dd-image" title="'.$object->title.'">';
        } else {
            $object_output .= $args->link_before . apply_filters( 'the_title', $object->title, $object->ID ) . $args->link_after;
        }

        $object_output .= "</a>\n$indent\t";
        $object_output .= $args->after;
        $output .= apply_filters( 'walker_nav_menu_start_el', $object_output, $object, $depth, $args );
        endif;
    }
    function end_el(&$output, $object, $depth = 0, $args = array()) {
        $output .= "</li>\n";
    }
}
