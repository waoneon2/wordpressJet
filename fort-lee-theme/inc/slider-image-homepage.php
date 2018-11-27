<?php

if(!function_exists('slider_image_fort_lee')):
function slider_image_fort_lee(){

    $html   = "";
    $title_overlay = "";
    $descripiton_overlay = "";
    $content_of_image_slider = "";

    $image  = array();
    $title  = array();
    $desc   = array();
    $link   = array();

    $html .= '<div class="no-margin cycle-slideshow" id="fort-lee-slider">';
    $html .= '<div class="cycle-slideshow" id="fl-img-slider" data-cycle-fx=fadeout data-cycle-timeout=5000 data-cycle-pause-on-hover=true data-cycle-auto-height=calc data-cycle-caption-plugin=caption2 data-cycle-overlay-fx-out=fadeOut data-cycle-overlay-fx-in=fadeIn data-cycle-log=false data-cycle-overlay-template="<div class=inner><h4 class=title>{{title}}</h4><div class=desc><p>{{desc}}</p></div></div>">';
    $html .= '<div class="cycle-overlay"></div>';

    if(get_theme_mod('fl_lk')){
        $image_slider = get_theme_mod('fl_lk');

        foreach ($image_slider as $key => $value) {
            if (!empty($value)) {
                // Title
                if(get_theme_mod('fl_title_overlay')){
                    $title = get_theme_mod('fl_title_overlay');
                    if(!empty($title[$key])){
                        if(get_theme_mod('fl_link_overlay')){
                            $link = get_theme_mod('fl_link_overlay');
                            if(!empty($link[$key])){
                                $get_target = get_theme_mod('fl_link_target','self');
                                $target_url = "_self";
                                if($get_target){
                                    if(!empty($get_target[$key])){
                                        $target_url = $get_target[$key];
                                    }
                                }
                                $title_overlay = "<a href=".esc_url($link[$key])." target='".$target_url."' class='overlay_link'>".esc_html($title[$key])."</a>";
                            } else {
                                $title_overlay = esc_html($title[$key]);
                            }
                        }
                    } else {
                        $title_overlay = "";
                    }
                } else {
                    $title_overlay = "";
                }

                // Description
                if(get_theme_mod('fl_desc_overlay')){
                    $desc = get_theme_mod('fl_desc_overlay');
                    if(!empty($desc[$key])){
                        $descripiton_overlay = esc_html($desc[$key]);
                    } else {
                        $descripiton_overlay = "";
                    }
                } else {
                    $descripiton_overlay = "";
                }

                $content_of_image_slider .= '<img id="slider-'.$key.'" class="header-images img-responsive" src="'.$value.'" data-cycle-title="'.esc_html($title_overlay).'" data-cycle-desc="'.esc_html($descripiton_overlay).'" />';
            }
        }
    }

    $html .= $content_of_image_slider;

    $html .= '</div><!-- .no-margin --></div><!-- .fl-img-slider -->';
    return $html;
}
endif;