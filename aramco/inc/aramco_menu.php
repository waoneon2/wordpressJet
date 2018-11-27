<?php # -*- coding: utf-8 -*-
/**
 * Create a nav.
 *
 * @author Dharmawan
 * @version 1.0
 */
class Aramco_Walker_Nav_Menu extends Walker_Nav_Menu
{
    /**
     * Start the element output.
     *
     * @param  string $output Passed by reference. Used to append additional content.
     * @param  object $item   Menu item data object.
     * @param  int $depth     Depth of menu item. May be used for padding.
     * @param  array $args    Additional strings.
     * @return void
     */
    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 )
    {

        global $wp;
        $url_part = add_query_arg(array(),$wp->request);
        $attributes  = '';
        $item_output = '';
        ! empty ( $item->attr_title )
            // Avoid redundant titles
            and $item->attr_title !== $item->title
            and $attributes .= ' title="' . esc_attr( $item->attr_title ) .'"';
        ! empty ( $item->url )
            and $attributes .= ' href="' . esc_attr( $item->url ) .'"';
        $attributes  = trim( $attributes );
        $title       = apply_filters( 'the_title', $item->title, $item->ID );

        $child = '';
        if (in_array("menu-item-has-children", $item->classes)) {
           $child = 'have_child';
        }

        if ( in_array("current-menu-item",$item->classes)) {
            $active = ' selected';
            $current = ' current-menu-item';
        } else {
            if ($item->current_item_ancestor) {
                $active = ' selected';
            } else {
                $active = '';
            }
        }
        $attributes .= 'class="'.$active.' href-'.$depth.'"';

        // if menu is post
        if ($item->object == 'post') {
        	$img_thumb = "";

            if (get_the_post_thumbnail( $item->object_id, 'ar_220x124' )) {
                $img_thumb = get_the_post_thumbnail( $item->object_id, 'ar_220x124' );
            }
            $output     .= '<li class="menu-item li-depth-'.$item->object.'">';
            $item_output .= '<div class="card">
                <strong><a href="">News &amp; media</a></strong>
                <h2><a href="'.$item->url.'">'.$item->title.'</a></h2>
                '.$img_thumb.'
            </div>';
        } else {

            $output     .= '<li class="menu-item li-depth-'.$depth.' '.$child.'">';
            $item_output = "$args->before<a $attributes>$args->link_before$title</a>"
                                . "$args->link_after$args->after";
        }
        //$item_output .= '<!--'.json_encode($item).'-->';
        //$item_output .= '<!--'.json_encode(in_array("current-menu-item",$item->classes) ? ' active' : '').'-->';


        // Since $output is called by reference we don't need to return anything.
        $output .= apply_filters(
            'walker_nav_menu_start_el'
            ,   $item_output
            ,   $item
            ,   $depth
            ,   $args
        );

        if ($depth === 0) {
            $output .= '<div class="clearfix"></div>';
            $output .= '<div class="aramco-megamenu">';
        }

    }
    /**
     * @see Walker::start_lvl()
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @return void
     */
    public function start_lvl( &$output, $depth = 0, $args = array())
    {

        $output .= '<ul class="sub-depth-'.$depth.'">';

    }
    /**
     * @see Walker::end_lvl()
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @return void
     */
    public function end_lvl( &$output, $depth = 0, $args = array())
    {
        $output .= '</ul>';

        //if ($depth === 0)
        //$output .= '<span class="closeNav"><span class="visuallyhidden">close</span></span>';
    }
    /**
     * @see Walker::end_el()
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @return void
     */
    function end_el( &$output, $item, $depth = 0, $args = array() )
    {
        if ($depth === 0)
        $output .= '</div>';

        $output .= '</li>';
    }
}

class Aramco_Walker_Mobile_Menu extends Walker_Nav_Menu
{
    /**
     * Start the element output.
     *
     * @param  string $output Passed by reference. Used to append additional content.
     * @param  object $item   Menu item data object.
     * @param  int $depth     Depth of menu item. May be used for padding.
     * @param  array $args    Additional strings.
     * @return void
     */
    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 )
    {

        $attributes  = '';
        ! empty ( $item->attr_title )
            // Avoid redundant titles
            and $item->attr_title !== $item->title
            and $attributes .= ' title="' . esc_attr( $item->attr_title ) .'"';
        ! empty ( $item->url )
            and $attributes .= ' href="' . esc_attr( $item->url ) .'"';
        $attributes  = trim( $attributes );
        $title       = apply_filters( 'the_title', $item->title, $item->ID );

        $child = '';
        $current  = '';
        if (in_array("menu-item-has-children", $item->classes)) {
           $child = 'parent mdepth-'.$depth;
        }
        // if menu is post
        if ($depth != 1) {
            # code...
            if ( in_array("current-menu-item",$item->classes)) {
                $active = ' selected';
                $current = ' current-menu-item';
            } else {
                if ($item->current_item_ancestor) {
                    $active = ' selected';
                } else {
                    $active = '';
                }
            }
            $attributes .= 'class="'.$active.'"';
            $output     .= '<li class="mmenu '.$child.$current.'">';
            $item_output = "$args->before<a $attributes>$args->link_before$title</a>"
                                . "$args->link_after$args->after";

            // Since $output is called by reference we don't need to return anything.
            $output .= apply_filters(
                'walker_nav_menu_start_el'
                ,   $item_output
                ,   $item
                ,   $depth
                ,   $args
            );
        }
    }
    /**
     * @see Walker::start_lvl()
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @return void
     */
    public function start_lvl( &$output, $depth = 0, $args = array() )
    {
        if ($depth != 0) {
            $output .= '<ul><!--'.$depth.'-->';
        }
    }
    /**
     * @see Walker::end_lvl()
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @return void
     */
    public function end_lvl( &$output, $depth = 0, $args = array())
    {

        if ($depth != 0) {
            $output .= '</ul>';
        }
    }
    /**
     * @see Walker::end_el()
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @return void
     */
    function end_el( &$output, $item, $depth = 0, $args = array() )
    {
        if ($depth != 1) {
            $output .= '</li>';
        }

    }
}
