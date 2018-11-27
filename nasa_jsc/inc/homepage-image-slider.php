<?php
/**
 * Homepage Image Slider
 * 
 **/

function set_img_slider(){
	$html  = '';
	$image = '';
	$title_overlay = array();
	$get_title_overlay = '';
	if(get_theme_mod('nasa_jsc_his')):
		$get_nasa_jsc_image_slider = get_theme_mod('nasa_jsc_his');
        $count_img_slider = count($get_nasa_jsc_image_slider);
        $make_arr   = array();
        $get_arr    = array();
        $count_up   = 0;

        foreach ($get_nasa_jsc_image_slider as $key => $value) {
            if ($value !== "") :
                    $make_arr[$count_up] = array(
                        'large_img' => $value,
                        'idloop' => $key
                    );
               $count_up++;
            endif;
        }
        $get_arr["data"] = $make_arr;
        $convert_json = json_encode($get_arr, JSON_PRETTY_PRINT);
        $decode_data = json_decode($convert_json, true);
        foreach ($decode_data["data"] as $key => $value) {
        	if(get_theme_mod('nasa_jsc_his_title')):
    			$title_overlay = get_theme_mod('nasa_jsc_his_title');
    			if(!empty($title_overlay[$value['idloop']])):
    				$get_title_overlay = htmlspecialchars($title_overlay[$value['idloop']]);
    			else :
    				$get_title_overlay = "";
    			endif;
        	else:
        		$get_title_overlay = "";
        	endif;
        	$image .= '<img id="slider-'.$key.'" class="header-images img-responsive" src="'.$value["large_img"].'" data-cycle-title="'.$get_title_overlay.'" data-cycle-desc />';
        }
	endif;
	
	$html .= '<div class="slideshow">';
	$html .= '<div class="cycle-slideshow" data-cycle-fx="fadeout" data-cycle-timeout="5000" data-cycle-pause-on-hover="true" data-cycle-auto-height="calc" data-cycle-caption-plugin="caption2" data-cycle-overlay-fx-out="fadeOut" data-cycle-overlay-fx-in="fadeIn" data-cycle-log=false>';
	$html .= '<div class="cycle-overlay"></div><!-- eof .cycle-overlay -->';
	$html .= $image;
	$html .= '</div><!-- eof .cycle-slideshow -->';
	$html .= '</div><!-- eof .slideshow -->'; 
	
	return $html;
}
?>