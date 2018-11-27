<?php
add_action('customize_register','us_army_custom_customizer');

function us_army_custom_customizer ($wp_customize){

    $social_media_arr = array(
        0 => 'facebook',
        1 => 'twitter',
        2 => 'youtube',
        3 => 'flickr'
    );

    $front_category_setting =  array(
        1 => 'Latest Press Release',
        2 => 'Past Press Release',
        4 => 'Fort Hood Sentinel Headlines',
        5 => 'Reporters Toolbox',
        6 => 'Fort Hood Orientation Video'
    );

    class WP_Customize_dropdown_category extends WP_Customize_Control {
        public function render_content() {
            $drop_category = wp_dropdown_categories(
                    array(
                        'show_option_all'    => '',
                        'show_option_none'   => '',
                        'option_none_value'  => '0',
                        'echo' => '0',
                        'selected' => $this->value(),
                        'name' => '_custom-drop-category' . $this->id
                        )
                );
            $drop_category = str_replace( '<select', '<select ' . $this->get_link(), $drop_category );
 
            printf (
                '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
                $this->label,
                $drop_category
            );
        }
    }

    class WP_Customize_dropdown_menus extends WP_Customize_Control {
        public $type = 'custom_dropdown_menus';

        public function render_content() {
            $postArr = array();
            $menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
            foreach ($menus as $menu) {
                $postArr[$menu->term_id] = $menu->name;
            }
        ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <span class="description customize-control-description"><?php echo $this->description; ?></span>
                <select <?php $this->link(); ?> style="width: 100%;" id="us_army_custom_dropdown_menu">
                    <?php
                        foreach ( $postArr as $value => $label ) {
                            echo "<option " . selected( $this->value(), $value ) . " value='" . $value . "'>" . $label . "</option>";
                        }
                    ?>
                </select>
            </label>
        <?php }
    }

    class WP_Customize_Text_Custom_Control extends WP_Customize_Control {
        public $type = 'custom_input_text';
 
        public function render_content() {
        ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <input width="100%" type="text" maxlength="27" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />
            </label>
        <?php
        }
    }

    class WP_Customize_Textarea_Control extends WP_Customize_Control {
        public $type = 'textarea';
 
        public function render_content() {
        ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <span class="description customize-control-description"><?php echo $this->description; ?></span>
                <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
            </label>
        <?php
        }
    }

    /***** Add Panels *****/
    $wp_customize->add_panel('us_army_theme_options', array('title' => esc_html__('US Army Theme Options', 'plains'), 'description' => '', 'capability' => 'edit_theme_options', 'theme_supports' => '', 'priority' => 1,));

    /***** Add Sections *****/
    // Reporters Toolbox
    $wp_customize->add_section('us_army_get_latest',array(
        'title' => __('Get the Latest Updates','us_army'),
        'priority' => 0,
        'panel' => 'us_army_theme_options'
    ));

    $wp_customize->add_section('us_army_latest_press_release',array(
        'title' => __('Latest press release','us_army'),
        'priority' => 2,
        'description' => 'This section will display only one post from selected category',
        'panel' => 'us_army_theme_options'
    ));
    $wp_customize->add_section('us_army_past_press_release',array(
        'title' => __('Past press release','us_army'),
        'priority' => 3,
        'description' =>'This section will display list of post title from selected category',
        'panel' => 'us_army_theme_options'
    ));
    $wp_customize->add_section('us_army_orientation_video',array(
        'title' => __('Orientation Video','us_army'),
        'priority' => 4,
        'description' =>'',
        'panel' => 'us_army_theme_options'
    ));
    $wp_customize->add_section('us_army_hot_topic',array(
        'title' => __('Hot Topics','us_army'),
        'priority' => 1,
        'description' =>'Select category for displayed in hot topics section',
        'panel' => 'us_army_theme_options'
    ));
    $wp_customize->add_section('us_army_headlines',array(
        'title' => __('Fort Hood Sentinel Headlines','us_army'),
        'priority' => 5,
        'description' =>'Select category for displayed in headlines section',
        'panel' => 'us_army_theme_options'
    ));

    // Reporters Toolbox
    $wp_customize->add_section('us_army_dropdown_menus',array(
        'title' => __('Reporters Toolbox','us_army'),
        'priority' => 6,
        'panel' => 'us_army_theme_options'
    ));

    // Social Media Link Section
    $wp_customize->add_section('social_media_link_opt',array(
        'title' => __('Social Media Link','us_army'),
        'priority' => 7,
        'panel' => 'us_army_theme_options'
    ));
    $wp_customize->add_section('external_web_link_opt',array(
        'title' => __('External Web Link','us_army'),
        'priority' => 8,
        'panel' => 'us_army_theme_options'
    ));

    // Gravity Form section
    $wp_customize->add_section('us_army_hide_date_gf', array('title' => __('Show/Hide Date Gravity Form','us_army'), 'priority' => 9, 'panel' => 'us_army_theme_options'));

    // Show hide date GF
    $wp_customize->add_setting('us_army_hide_date_gf_setting', array('default' => 'hide'));

    /***** Add Controls about show hide date GF *****/
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'us_army_hide_date_gf_setting',
        array(
        'label'    => __( 'Show/Hide Date on Gravity Form', 'us_army' ),
        'section'  => 'us_army_hide_date_gf',
        'settings' => 'us_army_hide_date_gf_setting',
        'type'    => 'select',
        'choices'    => array(
            'show' => 'Show',
            'hide' => 'Hide',
        ),
        'priority' => 1
    ) ) );

    // Footer section
    $wp_customize->add_section('us_army_footer_info', array('title' => __('Footer Info','us_army'), 'priority' => 10, 'panel' => 'us_army_theme_options'));

    /***** Add Settings *****/
    foreach ($front_category_setting as $key => $value) {
        $wp_customize->add_setting( 'front_category_title_'.$key, array('default' => $value));
    }

    for ($i=1; $i <= 4; $i++) {
        $wp_customize->add_setting( 'front_category_dropdown_'.$i);
    }
    $wp_customize->add_setting('ex_web_link');

    foreach ($social_media_arr as $key => $value) {
        $wp_customize->add_setting('social_media_link['.$value.']');
    }

    $wp_customize->add_setting('us_army_get_latest_menu');
    $wp_customize->add_setting('us_army_menus_list');
    $wp_customize->add_setting('video_orentation_file');
    $wp_customize->add_setting('video_orentation_thumbnail');

    // Footer setting
    $wp_customize->add_setting( 'footer_info_setting' );

    // Display date hot topics settings
    $wp_customize->add_setting('hot_topics_display_date_setting', array('default' => 'show'));

    /***** Add Controls *****/
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'hot_topics_display_date_setting',
        array(
        'label'    => __( 'Display date on slider', 'us_army' ),
        'section'  => 'us_army_hot_topic',
        'settings' => 'hot_topics_display_date_setting',
        'type'    => 'select',
        'choices'    => array(
            'show' => 'Show',
            'hide' => 'Hide',
        ),
        'priority' => 4
    ) ) );

    // Show hide hot topic
    $wp_customize->add_setting('hot_topics_display_setting', array('default' => 'show'));

    /***** Add Controls *****/
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'hot_topics_display_setting',
        array(
        'label'    => __( 'Display Hot Topic', 'us_army' ),
        'section'  => 'us_army_hot_topic',
        'settings' => 'hot_topics_display_setting',
        'type'    => 'select',
        'choices'    => array(
            'show' => 'Show',
            'hide' => 'Hide',
        ),
        'priority' => 3
    ) ) );

    // Footer controls
    $wp_customize->add_control(
        new WP_Customize_Textarea_Control(
        $wp_customize,
        'footer_info_setting',
        array(
            'label' => __( 'Footer Info', 'us_army' ),
            'section' => 'us_army_footer_info',
            'settings' => 'footer_info_setting',
        ) )
    );
    //get the latest-menu
    $wp_customize->add_control(
        new WP_Customize_dropdown_menus(
        $wp_customize,
        'us_army_get_latest_menu',
            array(
                'label'         => __( 'Choose Menu', 'us_army' ),
                'description'   => __( 'If you have not custom menu for displayed here, please create it first in menu section.', 'us_army' ),
                'section'       => 'us_army_get_latest',
                'settings'      => 'us_army_get_latest_menu',
                'type'          => 'custom_dropdown_menus',
            )
        )
    );
    //reporter toolbox
    $wp_customize->add_control(
        new WP_Customize_Text_Custom_Control(
        $wp_customize,
        'front_category_title_5',
            array(
                'label'         => __( 'Set The Title', 'us_army' ),
                'description'   => __('','us_army'),
                'section'       => 'us_army_dropdown_menus',
                'settings'      => 'front_category_title_5',
                'type'          => 'custom_input_text',
            )
        )
    );
    $wp_customize->add_control(
        new WP_Customize_dropdown_menus(
        $wp_customize,
        'us_army_menus_list',
            array(
                'label'         => __( 'Choose Menu', 'us_army' ),
                'description'   => __( 'If you have not custom menu for displayed here, please create it first in menu section.', 'us_army' ),
                'section'       => 'us_army_dropdown_menus',
                'settings'      => 'us_army_menus_list',
                'type'          => 'custom_dropdown_menus',
            )
        )
    );

    // Latest press release
    $wp_customize->add_control(
        new WP_Customize_Text_Custom_Control(
        $wp_customize,
        'front_category_title_1',
            array(
                'label'         => __( 'Set The Title', 'us_army' ),
                'description'   => __('','us_army'),
                'section'       => 'us_army_latest_press_release',
                'settings'      => 'front_category_title_1',
                'type'          => 'custom_input_text',
            )
        )
    );
    
    $wp_customize->add_control(
        new WP_Customize_dropdown_category(
                $wp_customize,
                'front_category_dropdown_1',
                array(
                    'label' => 'Choose category',
                    'description'   => __('Latest post in selected category will be displayed','us_army'),
                    'section' => 'us_army_latest_press_release',
                    'setting' => 'front_category_dropdown_1'
                )
            )
        );

    // Past press release
    $wp_customize->add_control(
        new WP_Customize_Text_Custom_Control(
        $wp_customize,
        'front_category_title_2',
        array(
            'label'         => __( 'Set The Title', 'us_army' ),
            'description'   => __('','us_army'),
            'section'       => 'us_army_past_press_release',
            'settings'      => 'front_category_title_2',
            'type'          => 'custom_input_text',
        ) )
    );
    
    $wp_customize->add_control(
        new WP_Customize_dropdown_category(
                $wp_customize,
                'front_category_dropdown_2',
            array(
                'label' => 'Choose category',
                'description'   => __('All post in selected category will be displayed','us_army'),
                'section' => 'us_army_past_press_release',
                'setting' => 'front_category_dropdown_2'
            )
        )
    );

    // Orientation Video
    $wp_customize->add_control(
        new WP_Customize_Text_Custom_Control(
        $wp_customize,
        'front_category_title_6',
        array(
            'label'         => __( 'Set The Title', 'us_army' ),
            'description'   => __('','us_army'),
            'section'       => 'us_army_orientation_video',
            'settings'      => 'front_category_title_6',
            'type'          => 'custom_input_text'
        ) )
    );
    $wp_customize->add_control(
        new WP_Customize_Control(
           $wp_customize,
           'video_orentation_file',
        array(
           'label'      => __( '', 'us_army' ),
           'description'=> __('insert video','us_army'),
           'section'    => 'us_army_orientation_video',
           'settings'   => 'video_orentation_file',
           'type'       => 'text'
        ))
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
           $wp_customize,
           'video_orentation_thumbnail',
        array(
           'label'      => __( '', 'us_army' ),
           'description'   => __('Upload thumbnail image','us_army'),
           'section'    => 'us_army_orientation_video',
           'settings'   => 'video_orentation_thumbnail'
        ))
    );


    // Hot topics
    $wp_customize->add_control(
        new WP_Customize_dropdown_category(
                $wp_customize,
                'front_category_dropdown_3',
            array(
                'label' => 'Choose category',
                'section' => 'us_army_hot_topic',
                'setting' => 'front_category_dropdown_3'
            )
        )
    );

    // Headline
    $wp_customize->add_control(
        new WP_Customize_Text_Custom_Control(
        $wp_customize,
        'front_category_title_4',
        array(
            'label'         => __( 'Set The Title', 'us_army' ),
            'description'   => __('','us_army'),
            'section'       => 'us_army_headlines',
            'settings'      => 'front_category_title_4',
            'type'          => 'custom_input_text',
        ) )
    );
    
    $wp_customize->add_control(
        new WP_Customize_dropdown_category(
                $wp_customize,
                'front_category_dropdown_4',
            array(
                'label' => 'Choose category',
                'description'   => __('All post in selected category will be displayed','us_army'),
                'section' => 'us_army_headlines',
                'setting' => 'front_category_dropdown_4'
            )
        )
    );

    // Social media link
    foreach ($social_media_arr as $key => $value) {
        $wp_customize->add_setting('social_media_link_'.$value);
        $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'social_media_link_'.$value,
            array(
                'label'         => __( $value, 'us_army' ),
                'description'   => __('Insert the url','us_army'),
                'section'       => 'social_media_link_opt',
                'settings'      => 'social_media_link_'.$value,
                'type'          => 'link',
            ) )
        );
    }

    // External web link control
    $wp_customize->add_control(
        new WP_Customize_Control(
        $wp_customize,
        'ex_web_link',
        array(
            'label'         => __( 'External Web url', 'us_army' ),
            'description'   => __('text area','us_army'),
            'section'       => 'social_media_link_opt',
            'settings'      => 'ex_web_link',
            'type'          => 'textarea',
        ))
    );

}


