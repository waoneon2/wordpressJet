<?php
$defaultImg = array(
    0 => get_stylesheet_directory_uri() . '/img/default_slider/1.jpg',
    1 => get_stylesheet_directory_uri() . '/img/default_slider/2.jpg',
    2 => get_stylesheet_directory_uri() . '/img/default_slider/3.jpg',
    3 => get_stylesheet_directory_uri() . '/img/default_slider/4.jpg',
);

$defaultTitle = array(
    0 => 'Engineer Sappers',
    1 => 'Engineer Sappers',
    2 => 'NBC Chamber',
    3 => 'Welcome to Fort Leonard Wood',
);

$defaultDesc = array(
    0 => '',
    1 => '',
    2 => '',
    3 => 'Basic Combat Training Arrival',
);

$defaultLink = array(
    0 => '',
    1 => '',
    2 => '',
    3 => '',
);

if(!function_exists('slider_image')):
function slider_image(){
    global $defaultImg, $defaultTitle, $defaultDesc, $defaultLink;

    $html   = "";
    $url    = "";

    $image  = array();
    $title  = array();
    $desc   = array();
    $link   = array();

    $html .= '<div class="no-margin cycle-slideshow" id="fort-leonard-wood-slider">';
    $html .= '<div class="cycle-slideshow" id="fl-img-slider" data-cycle-fx=fadeout data-cycle-timeout=5000 data-cycle-pause-on-hover=true data-cycle-auto-height=calc data-cycle-caption-plugin=caption2 data-cycle-overlay-fx-out=fadeOut data-cycle-overlay-fx-in=fadeIn data-cycle-log=false data-cycle-overlay-template="<div class=inner><h4 class=title>{{title}}</h4><div class=desc><p>{{desc}}</p></div></div>">';
    $html .= '<div class="cycle-overlay"></div>';

    for($j=0;$j<4;$j++){
        if($j == 0){
            $image[$j]  = $defaultImg[$j];
            $title[$j]  = $defaultTitle[$j];
            $desc[$j]   = $defaultDesc[$j];
            $link[$j]   = $defaultLink[$j];

            if (!empty(get_theme_mod('fl_lk')[$j])){
                $image[$j]  = get_theme_mod('fl_lk', $defaultImg)[$j];
            }
            if (!empty(get_theme_mod('fl_title_overlay')[$j])){
                $title[$j]  = get_theme_mod('fl_title_overlay', $defaultTitle)[$j];
            }
            if (!empty(get_theme_mod('fl_desc_overlay')[$j])){
                $desc[$j]   = get_theme_mod('fl_desc_overlay', $defaultDesc)[$j];
            }
            if (!empty(get_theme_mod('fl_link_overlay')[$j])){
                $link[$j]   = get_theme_mod('fl_link_overlay', $defaultLink)[$j];
            }
        }

        if($j == 1){
            $image[$j]  = $defaultImg[$j];
            $title[$j]  = $defaultTitle[$j];
            $desc[$j]   = $defaultDesc[$j];
            $link[$j]   = $defaultLink[$j];

            if (!empty(get_theme_mod('fl_lk')[$j])){
                $image[$j]  = get_theme_mod('fl_lk', $defaultImg)[$j];
            }
            if (!empty(get_theme_mod('fl_title_overlay')[$j])){
                $title[$j]  = get_theme_mod('fl_title_overlay', $defaultTitle)[$j];
            }
            if (!empty(get_theme_mod('fl_desc_overlay')[$j])){
                $desc[$j]   = get_theme_mod('fl_desc_overlay', $defaultDesc)[$j];
            }
            if (!empty(get_theme_mod('fl_link_overlay')[$j])){
                $link[$j]   = get_theme_mod('fl_link_overlay', $defaultLink)[$j];
            }

        }

        if($j == 2){
            $image[$j]  = $defaultImg[$j];
            $title[$j]  = $defaultTitle[$j];
            $desc[$j]   = $defaultDesc[$j];
            $link[$j]   = $defaultLink[$j];

            if (!empty(get_theme_mod('fl_lk')[$j])){
                $image[$j]  = get_theme_mod('fl_lk', $defaultImg)[$j];
            }
            if (!empty(get_theme_mod('fl_title_overlay')[$j])){
                $title[$j]  = get_theme_mod('fl_title_overlay', $defaultTitle)[$j];
            }
            if (!empty(get_theme_mod('fl_desc_overlay')[$j])){
                $desc[$j]   = get_theme_mod('fl_desc_overlay', $defaultDesc)[$j];
            }
            if (!empty(get_theme_mod('fl_link_overlay')[$j])){
                $link[$j]   = get_theme_mod('fl_link_overlay', $defaultLink)[$j];
            }

        }

        if($j == 3){
            $image[$j]  = $defaultImg[$j];
            $title[$j]  = $defaultTitle[$j];
            $desc[$j]   = $defaultDesc[$j];
            $link[$j]   = $defaultLink[$j];

            if (!empty(get_theme_mod('fl_lk')[$j])){
                $image[$j]  = get_theme_mod('fl_lk', $defaultImg)[$j];
            }
            if (!empty(get_theme_mod('fl_title_overlay')[$j])){
                $title[$j]  = esc_html(get_theme_mod('fl_title_overlay', $defaultTitle)[$j]);
            }
            if (!empty(get_theme_mod('fl_desc_overlay')[$j])){
                $desc[$j]   = esc_html(get_theme_mod('fl_desc_overlay', $defaultDesc)[$j]);
            }
            if (!empty(get_theme_mod('fl_link_overlay')[$j])){
                $link[$j]   = get_theme_mod('fl_link_overlay', $defaultLink)[$j];
            }

        }

        if(!empty($link[$j])){
            $url = "<a href=".esc_url($link[$j])." target='_blank' class='overlay_link'>".$title[$j]."</a>";
        } else {
            $url = $title[$j];
        }

        $html .= '<img id="slider-'.$j.'" class="img-responsive" src="'.$image[$j].'" data-cycle-title="'.esc_html($url).'" data-cycle-desc="'.esc_html($desc[$j]).'">';
    }
    $html .= '</div><!-- .no-margin --></div><!-- .fl-img-slider -->';
return $html;
}
endif;
