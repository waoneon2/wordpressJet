<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_parent_css' ) ):
    function chld_thm_cfg_parent_css() {
        wp_enqueue_style( 'chld_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array( 'us_army-bootstrap','us_army-bootstrap-theme','us_army-jquery-ui','us_army-font-awesome','us_army-calendar-blue' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'chld_thm_cfg_parent_css', 10 );

// END ENQUEUE PARENT ACTION

// Default Resource Content
if(!function_exists('fldefaultResources')):
function fldefaultResources(){
    $defaultImgResources = array(
        643998 => get_stylesheet_directory_uri() . '/img/default_resources/643998.png',
        644002 => get_stylesheet_directory_uri() . '/img/default_resources/644002.png',
        643990 => get_stylesheet_directory_uri() . '/img/default_resources/643990.png',
        643994 => get_stylesheet_directory_uri() . '/img/default_resources/643994.png',
        643982 => get_stylesheet_directory_uri() . '/img/default_resources/643982.png',
        643986 => get_stylesheet_directory_uri() . '/img/default_resources/643986.png',
        644006 => get_stylesheet_directory_uri() . '/img/default_resources/644006.png',
        644010 => get_stylesheet_directory_uri() . '/img/default_resources/644010.png',

    );

    $defaultPdf = get_stylesheet_directory_uri() . '/img/default_resources/Fort_Lee_Fast_Facts_2017Q2.pdf';

    $content_default_html = "";
    $content_default_html .= '<div class="resources_area">';
        $content_default_html .= '<p>';
            $content_default_html .= '<a href="'.$defaultPdf.'" target="_blank">';
                $content_default_html .= '<img onmouseout="this.src=\''.$defaultImgResources[643998].'\'" src="'.$defaultImgResources[643998].'" alt="Fast Facts" onmouseover="this.src=\''.$defaultImgResources[644002].'\'" height="55" width="275">';
            $content_default_html .= '</a>';
        $content_default_html .= '</p>';

        $content_default_html .= '<p>';
            $content_default_html .= '<a href="https://www.dvidshub.net/unit/FLVAPAO" target="_blank">';
                $content_default_html .= '<img onmouseout="this.src=\''.$defaultImgResources[643990].'\'" src="'.$defaultImgResources[643990].'" alt="DVIDS" onmouseover="this.src=\''.$defaultImgResources[643994].'\'" height="55" width="275">';
            $content_default_html .= '</a>';
        $content_default_html .= '</p>';

        $content_default_html .= '<p>';
            $content_default_html .= '<a href="http://www.lee.army.mil/CRG" target="_blank">';
                $content_default_html .= '<img onmouseout="this.src=\''.$defaultImgResources[643982].'\'" src="'.$defaultImgResources[643982].'" alt="Fort Lee Community Resource Guide" onmouseover="this.src=\''.$defaultImgResources[643986].'\'" height="55" width="275">';
            $content_default_html .= '</a>';
        $content_default_html .= '</p>';

        $content_default_html .= '<p>';
            $content_default_html .= '<a href="http://www.ftleetraveller.com/community_life/fort-lee-directory/" target="_blank">';
                $content_default_html .= '<img onmouseout="this.src=\''.$defaultImgResources[644006].'\'" src="'.$defaultImgResources[644006].'" alt="Post Guide and Directory" onmouseover="this.src=\''.$defaultImgResources[644010].'\'" height="55" width="275">';
            $content_default_html .= '</a>';
        $content_default_html .= '</p>';


    $content_default_html .= '</div>';

    $default_content_resources = $content_default_html;

    return $default_content_resources;
}
endif;
// REMOVE PARENT FUNCTIONS
add_action('after_setup_theme', 'remove_parent_functions');
function remove_parent_functions() {
    remove_action('wp_head', 'set_header_text_color', 10);
}

// REMOVE UNUSED FUNCTIONALITY OF CUSTOMIZER 
add_action( 'customize_register', 'fl_remove_custom', 15 );
function fl_remove_custom($wp_customize) {
		
	$wp_customize->remove_panel('us_army_theme_options');
	$wp_customize->remove_setting('front_category_title_1');
	$wp_customize->remove_control('front_category_title_1');

	$wp_customize->remove_setting('front_category_title_2');
	$wp_customize->remove_control('front_category_title_2');

	$wp_customize->remove_section('us_army_latest_press_release');
    $wp_customize->remove_section('social_media_link_opt');
    $wp_customize->remove_section('us_army_get_latest');
    $wp_customize->remove_section('us_army_hot_topic');
    $wp_customize->remove_section('us_army_orientation_video');
    $wp_customize->remove_section('us_army_past_press_release');
    $wp_customize->remove_section('us_army_headlines');
    $wp_customize->remove_section('us_army_dropdown_menus');

	$wp_customize->add_panel('us_army_theme_options', array('title' => esc_html__('Fort Lee Theme Options', 'us_army'), 'description' => '', 'capability' => 'edit_theme_options', 'theme_supports' => '', 'priority' => 1,));


	$wp_customize->remove_setting('front_category_title_4');
	$wp_customize->remove_setting('front_category_title_6');

	$wp_customize->add_setting( 'front_category_title_4', array('default' => 'Fort Lee Sentinel Headlines'));
	$wp_customize->add_setting( 'front_category_title_6', array('default' => 'Fort Lee Orientation Video'));

    // Add Customizer for Installation status
    $wp_customize->add_section('fl_add_installation_status',array(
        'title' => __('Installation Status','us_army'),
        'panel' => 'us_army_theme_options',
        'priority' => 2
    ));

    $wp_customize->add_setting('installation_status_header_text',  array(
        'default' => 'Installation Status',
    ));
    $wp_customize->add_control(
        new WP_Customize_Control(
        $wp_customize,
        'installation_status_header_text',
        array(
            'label'         => __( 'Header Text Status', 'us_army' ),
            'description'   => __('This title to show on header installation status','us_army'),
            'section'       => 'fl_add_installation_status',
            'settings'      => 'installation_status_header_text',
            'type'          => 'text',
        ) )
    );

    $wp_customize->add_setting('installation_status_text',  array(
        'default' => 'OPEN',
    ));
    $wp_customize->add_control(
        new WP_Customize_Control(
        $wp_customize,
        'installation_status_text',
        array(
            'label'         => __( 'Text Status', 'us_army' ),
            'description'   => __('Text status ex: <b>OPEN</b>/<b>CLOSED</b> etc.','us_army'),
            'section'       => 'fl_add_installation_status',
            'settings'      => 'installation_status_text',
            'type'          => 'text',
        ) )
    );

    $wp_customize->add_setting('installation_status_link');
    $wp_customize->add_control(
        new WP_Customize_Control(
        $wp_customize,
        'installation_status_link',
        array(
            'label'         => __( 'Link/Url Status', 'us_army' ),
            'description'   => __('This link for text status','us_army'),
            'section'       => 'fl_add_installation_status',
            'settings'      => 'installation_status_link',
            'type'          => 'url',
        ) )
    );
    // ---

    // Add Customizer for Release
    $wp_customize->add_section('fl_add_release',array(
        'title' => __('Release','us_army'),
        'panel' => 'us_army_theme_options',
        'priority' => 1
    ));

    $wp_customize->add_setting('release_header_text',  array(
        'default' => 'Release',
    ));
    $wp_customize->add_control(
        new WP_Customize_Control(
        $wp_customize,
        'release_header_text',
        array(
            'label'         => __( 'Header Text Release', 'us_army' ),
            'description'   => __('This title to show on header release','us_army'),
            'section'       => 'fl_add_release',
            'settings'      => 'release_header_text',
            'type'          => 'text',
        ) )
    );

    $wp_customize->add_setting('release_for_category');
    $wp_customize->add_control(
    new WP_Customize_dropdown_category(
            $wp_customize,
            'release_for_category',
            array(
                'label' => 'Choose category',
                'description'   => __('Latest post in selected category will be displayed on release section','us_army'),
                'section' => 'fl_add_release',
                'setting' => 'release_for_category'
            )
        )
    );
    // ---

    // Add Customizer for Resources
    $wp_customize->add_section('fl_add_resources',array(
        'title' => __('Resources','us_army'),
        'panel' => 'us_army_theme_options',
        'priority' => 5
    ));
    $wp_customize->add_setting('resources_header_text',  array(
        'default' => 'Resources',
    ));
    $wp_customize->add_control(
        new WP_Customize_Control(
        $wp_customize,
        'resources_header_text',
        array(
            'label'         => __( 'Header Text Resources', 'us_army' ),
            'description'   => __('This title to show on header resources','us_army'),
            'section'       => 'fl_add_resources',
            'settings'      => 'resources_header_text',
            'type'          => 'text',
        ) )
    );

    $wp_customize->add_setting('content_of_resources', array(
        'default' => fldefaultResources(),
    ));
    $wp_customize->add_control(
        new WP_Customize_Control(
        $wp_customize,
        'content_of_resources',
        array(
            'label'         => __( 'Description', 'us_army' ),
            'description'   => __('Content for resources section','us_army'),
            'section'       => 'fl_add_resources',
            'settings'      => 'content_of_resources',
            'type'          => 'textarea',
        ) )
    );
    // ---

    // Add Customizer for From the Fort Lee Traveller
    $wp_customize->add_section('fl_add_traveller',array(
        'title' => __('Traveller','us_army'),
        'panel' => 'us_army_theme_options',
        'priority' => 3
    ));
    $wp_customize->add_setting('traveller_header_text',  array(
        'default' => 'From the Fort Lee Traveller',
    ));
    $wp_customize->add_control(
        new WP_Customize_Control(
        $wp_customize,
        'traveller_header_text',
        array(
            'label'         => __( 'Header Text Traveller', 'us_army' ),
            'description'   => __('This title to show on header traveller','us_army'),
            'section'       => 'fl_add_traveller',
            'settings'      => 'traveller_header_text',
            'type'          => 'text',
        ) )
    );

    $wp_customize->add_setting('traveller_link_feed', array(
        'default' => 'https://www.fortleetraveller.com/search/?f=rss&amp;t=article&amp;l=50&amp;s=start_time&amp;sd=desc&amp;k[]=#topstory',
    ));
    $wp_customize->add_control(
        new WP_Customize_Control(
        $wp_customize,
        'traveller_link_feed',
        array(
            'label'         => __( 'Link/Url RSS Feed', 'us_army' ),
            'description'   => __('This link for Traveller Feed','us_army'),
            'section'       => 'fl_add_traveller',
            'settings'      => 'traveller_link_feed',
            'type'          => 'url',
        ) )
    );
    // ---

    // Add Customizer for Social Media
     $wp_customize->add_section('fl_add_socmed',array(
        'title' => __('Social Media','us_army'),
        'panel' => 'us_army_theme_options',
        'priority' => 4
    ));
    $wp_customize->add_setting('socmed_header_text',  array(
        'default' => 'Social Media',
    ));
    $wp_customize->add_control(
        new WP_Customize_Control(
        $wp_customize,
        'socmed_header_text',
        array(
            'label'         => __( 'Header Text Social Media', 'us_army' ),
            'description'   => __('This title to show on header social media','us_army'),
            'section'       => 'fl_add_socmed',
            'settings'      => 'socmed_header_text',
            'type'          => 'text',
        ) )
    );
    // Facebook
    $wp_customize->add_setting('socmed_facebook',  array(
        'default' => 'ArmyFortLee',
    ));
    $wp_customize->add_control(
        new WP_Customize_Control(
        $wp_customize,
        'socmed_facebook',
        array(
            'label'         => __( 'Facebook ID/Username', 'us_army' ),
            'description'   => __('Example : https://www.facebook.com/<b>ArmyFortLee</b>, bold text is Facebook ID/Username','us_army'),
            'section'       => 'fl_add_socmed',
            'settings'      => 'socmed_facebook',
            'type'          => 'text',
        ) )
    );
    // Twitter
    $wp_customize->add_setting('socmed_twitter',  array(
        'default' => 'ArmyFortLee',
    ));
    $wp_customize->add_control(
        new WP_Customize_Control(
        $wp_customize,
        'socmed_twitter',
        array(
            'label'         => __( 'Twitter ID/Username', 'us_army' ),
            'description'   => __('Example : https://twitter.com/<b>ArmyFortLee</b>, bold text is Twitter ID/Username','us_army'),
            'section'       => 'fl_add_socmed',
            'settings'      => 'socmed_twitter',
            'type'          => 'text',
        ) )
    );
    // Youtube
    $wp_customize->add_setting('socmed_youtube',  array(
        'default' => 'videoseries?list=PL359EB7080B3BDC29',
    ));
    $wp_customize->add_control(
        new WP_Customize_Control(
        $wp_customize,
        'socmed_youtube',
        array(
            'label'         => __( 'Youtube embed ID', 'us_army' ),
            'description'   => __('Example : https://www.youtube.com/embed/<b>videoseries?list=PL359EB7080B3BDC29</b>, bold text is Youtube ID','us_army'),
            'section'       => 'fl_add_socmed',
            'settings'      => 'socmed_youtube',
            'type'          => 'text',
        ) )
    );
    // ---


	// Add Customizer Slider Image
    $wp_customize->add_section('fl_add_lgs',array(
        'title' => __('Photo','us_army'),
        'panel' => 'us_army_theme_options',
        'priority' => 0
    ));

    $wp_customize->add_setting('photo_header_title',  array(
        'default' => 'Photo',
    ));
    $wp_customize->add_control(
        new WP_Customize_Control(
        $wp_customize,
        'photo_header_title',
        array(
            'label'         => __( 'Header title of Photo', 'us_army' ),
            'description'   => __('This title to show on header Photo','us_army'),
            'section'       => 'fl_add_lgs',
            'settings'      => 'photo_header_title',
            'type'          => 'text',
        ) )
    );

    for ($i=0; $i < 4; $i++) {
        $wp_customize->add_setting( 'fl_lk['.$i.']' );
        $wp_customize->add_control( new WP_Customize_Image_Control(
            $wp_customize,
            'fl_lk['.$i.']',
            array(
            'label'    => __( 'Image', 'us_army' ),
            'section'  => 'fl_add_lgs',
            'settings' => 'fl_lk['.$i.']'
        ) ) );
        $wp_customize->add_setting('fl_title_overlay['.$i.']');
        $wp_customize->add_control(
            new WP_Customize_Control(
            $wp_customize,
            'fl_title_overlay['.$i.']',
            array(
                'label'         => __( 'Title', 'us_army' ),
                'description'   => __('This title to show on overlay image','us_army'),
                'section'       => 'fl_add_lgs',
                'settings'      => 'fl_title_overlay['.$i.']',
                'type'          => 'text',
            ) )
        );
        $wp_customize->add_setting('fl_desc_overlay['.$i.']');
        $wp_customize->add_control(
            new WP_Customize_Control(
            $wp_customize,
            'fl_desc_overlay['.$i.']',
            array(
                'label'         => __( 'Description', 'us_army' ),
                'description'   => __('This description to show on overlay image','us_army'),
                'section'       => 'fl_add_lgs',
                'settings'      => 'fl_desc_overlay['.$i.']',
                'type'          => 'textarea',
            ) )
        );
        $wp_customize->add_setting('fl_link_overlay['.$i.']');
        $wp_customize->add_control(
            new WP_Customize_Control(
            $wp_customize,
            'fl_link_overlay['.$i.']',
            array(
                'label'         => __( 'Link/Url', 'us_army' ),
                'description'   => __('This link for title overlay','us_army'),
                'section'       => 'fl_add_lgs',
                'settings'      => 'fl_link_overlay['.$i.']',
                'type'          => 'url',
            ) )
        );
        $wp_customize->add_setting('fl_link_target['.$i.']', array(
            'default' => '_self',
        ));
        $wp_customize->add_control(
            new WP_Customize_Control(
            $wp_customize,
            'fl_link_target['.$i.']',
                array(
                    'label'         => __( 'Link target attribute', 'us_army' ),
                    'description'   => __('The target attribute specifies where to open the linked photo','us_army'),
                    'section'       => 'fl_add_lgs',
                    'settings'      => 'fl_link_target['.$i.']',
                    'type'          => 'radio',
                    'choices'       => array(
                                        '_self'  => __('Same window/tab (default)','us_army'),
                                        '_blank' => __('New window/tab','us_army'),
                                    ),
                ) 
            )
        );
    }
    // Eof Customizer Slider Image
}

// FOR CHILD ACTION
if( !function_exists( 'fl_set_header_text_color') ):
	function fl_set_header_text_color(){
		$link_color = get_header_textcolor();
		$link_color_default = 'fff';

			if ( $link_color !== 'blank' && $link_color !== '000000') :
		?>
			<style type="text/css">
			.navbar-title a, .navbar-title a:visited, .header-section-rt h1, .header-section-rt h3  {
				color: #<?php echo $link_color; ?>;
			}
			@media (max-width: 1067px){
				div.navbar-title a, div.navbar-title a:visited {
					color: #333333 !important;
					font-weight: bold !important;
				}
			}
			</style>
		<?php else: ?>
			<style type="text/css">
			.navbar-title a, .navbar-title a:visited, .header-section-rt h1, .header-section-rt h3 {
				color: #<?php echo $link_color_default; ?>;
			}
			</style>
		<?php
		endif; ?>
		<?php
	}
endif;
add_action('wp_head', 'fl_set_header_text_color', 15);

require_once( get_stylesheet_directory() . '/inc/slider-image-homepage.php' );