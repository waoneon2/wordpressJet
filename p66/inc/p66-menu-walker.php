<?php
class p66_menu_walker extends Walker {

    public $tree_type = array( 'post_type', 'taxonomy', 'custom' );
    public $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );


    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = str_repeat( $t, $depth );
        $depth="child";
        $output .= '<div class="submenu-holder">';
        $output .= '<div class="submenu-contain">';
        $output .= "{$n}{$indent}<ul class=\"sub-menu\">{$n}";
    }

    public function end_lvl( &$output, $depth = 0, $args = array() ) {
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = str_repeat( $t, $depth );
        $output .= "$indent</ul>{$n}";
        $output .= '</div>';
        $output .= '</div>';

    }

    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li' . $id . $class_names .'>';

        $atts = array();
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
        $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
        $atts['href']   = ! empty( $item->url )        ? $item->url        : '';

        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        /** This filter is documented in wp-includes/post-template.php */
        $title = apply_filters( 'the_title', $item->title, $item->ID );

        $title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

        if ($args->walker->has_children) {
            $alter_subToggle = 'class="subCTA"';
            $alter_glip = '<span class="glyphicon gi-2x"></span>';
        } else {
            $alter_subToggle = '';
            $alter_glip = '';
        }

        $item_output = $args->before;
        $item_output .= '<a'. $attributes . ' ' . $alter_subToggle .'>';
        $item_output .= $args->link_before . $title . $args->link_after;
        $item_output .= $alter_glip;
        $item_output .= '</a>';
        $item_output .= $args->after;


        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

    public function end_el( &$output, $item, $depth = 0, $args = array() ) {
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $output .= "</li>{$n}";
    }
}

// ======================================= Moblie =========================================================
//
class p66_menu_walker_mobile extends Walker {

    public $tree_type = array( 'post_type', 'taxonomy', 'custom' );
    public $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );
    public $p_id = -1;
    public $p_nav = 'navmobile';
    public $p_title = '';

    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        $this->p_nav = 'navmobile';
        if ($this->p_id == -1) return;
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = str_repeat( $t, $depth );
        //$depth="child";

        $output .= "{$n}{$indent}<ul class=\"submenu \" data-msub-title=".$this->p_title.">{$n}";
    }

    public function end_lvl( &$output, $depth = 0, $args = array() ) {
        if ($this->p_id == -1) return;
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = str_repeat( $t, $depth );
        $output .= "$indent</ul>{$n}";

    }

    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

        if ($item->current_item_ancestor) {
            $this->p_id = $item->db_id;
            $this->p_title = $item->title;
        }

        if ($this->p_id == $item->menu_item_parent) {
            //if ($depth !== 0) {

                if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
                    $t = '';
                    $n = '';
                } else {
                    $t = "\t";
                    $n = "\n";
                }
                $indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

                $classes = empty( $item->classes ) ? array() : (array) $item->classes;
                $classes[] = 'menu-item-' . $item->ID;

                $args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

                $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
                $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

                $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
                $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

                $output .= $indent . '<li' . $id . $class_names .'>';

                $atts = array();
                $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
                $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
                $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
                $atts['href']   = ! empty( $item->url )        ? $item->url        : '';

                $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

                $attributes = '';
                foreach ( $atts as $attr => $value ) {
                    if ( ! empty( $value ) ) {
                        $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                        $attributes .= ' ' . $attr . '="' . $value . '"';
                    }
                }

                /** This filter is documented in wp-includes/post-template.php */
                $title = apply_filters( 'the_title', $item->title, $item->ID );

                $title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );


                $item_output = $args->before;
                $item_output .= '<a'. $attributes . ' ' . ($item->current ? 'class="selected"' : '') .'>';
                $item_output .= $args->link_before . $title . $args->link_after;
                $item_output .= '</a>';
                $item_output .= $args->after;


                $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
            //}
        }
    }

    public function end_el( &$output, $item, $depth = 0, $args = array() ) {
        if ($depth !== 0) {
            if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
                $t = '';
                $n = '';
            } else {
                $t = "\t";
                $n = "\n";
            }
            $output .= "</li>{$n}";
        }
    }
}
