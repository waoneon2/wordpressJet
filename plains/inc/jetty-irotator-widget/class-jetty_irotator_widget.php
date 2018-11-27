<?php

class Jetty_IRotator_Widget extends WP_Widget
{
    public function __construct()
    {
        $widget_ops = array(
            'classname' => 'jetty_irotator_widget',
            'description' => __( 'A widget that allows us to add images (logos) from the media library and add a link to image.', 'jirw' ),
            'customize_selective_refresh' => true,
        );
        parent::__construct( 'jetty_irotator_widget', _x( 'Jetty Image Rotator', 'Jetty Image Rotator' ), $widget_ops );
    }

    public function widget($args, $instance)
    {
        global $post;

        // MAIN TITLE
        echo $args['before_widget'];

        // IMAGE ROTATOR ?>
        <div class="rotator plains-inside-page">
            <div class="col-md-3 hidden-xs hidden-sm blue">
                <?php //echo $image_rotator['attachments'][0] ?>
                <div class="cycle-slideshow survey-slides data-cycle-timeout=18000 data-cycle-speed=" 20000"="" style="position: relative;">
                    <?php
                        $media = $instance['media'];
                        foreach ($media as $item) {
                           $item = wp_parse_args((array) $item, array('image' => -1, 'url' => ''));
                           if ($item['image'] === -1) continue; // dont display an empty image
                           $imgUrl =  wp_get_attachment_image( $item['image'], 'plains_image_rotate' );
                           echo $imgUrl;
                        }
                    ?>
                </div>

            </div>
            <?php $title = empty($instance['title']) ? '' : $instance['title']; ?>
            <?php $content = empty($instance['content']) ? '' : $instance['content']; ?>
            <div class="col-md-9 col-sm-12 col-md-12 main-text-survey">
                <h2><?php echo $title ?></h2>
                <?php echo $content ?>
            </div>
        </div>

        <?php // display the images
        echo '<div style="clear: both;"></div>';
        echo $args['after_widget'];
    }

    /**
     * Helper to display a media item form on widget form below
     */
    protected function displayMediaItem($item, $i)
    {
        $item = wp_parse_args((array) $item, array('image' => -1, 'url' => ''));
        extract($item);
        ob_start();
        ?>
            <div class="media-item media-item-<?php echo $i; ?>" data-index="<?php echo $i; ?>">
                <input type="hidden" name="<?php echo $this->get_field_name("media[$i][image]"); ?>" class="jirw_repeatable_attachment_id_field" value="<?php echo esc_attr($image); ?>"/>
                <div class="jetty-image-choose-action">
                    <a href="#" class="jirw_upload_file_button button button-primary"><?php _e('+', 'jirw'); ?></a>
                    <a href="#" class="jetty-remove-image button button-secondary"><?php _e('x', 'jirw'); ?></a>
                </div>
                <figure class="image-preview">
                    <?php if ($image !== -1) {
                        $imageUrl = wp_get_attachment_url($image);
                        echo '<img class="preview-image-item preview-image-item-' . $i .'" src="' . $imageUrl .'">';
                    }
                    ?>
                </figure>
                <!-- <label for="<?php echo esc_attr("media-url-$i"); ?>"><?php _e('Link URL', 'jirw'); ?></label> -->
                <!-- <input type="url" id="<?php echo esc_attr("media-url-$i"); ?>" name="<?php echo $this->get_field_name("media[$i][url]"); ?>" value="<?php echo esc_url($url); ?>"> -->

                <div style="clear: both;"></div>
            </div>
        <?php
        return ob_get_clean();
    }

    public function form($instance)
    {
        $instance = wp_parse_args((array) $instance, array(
            'title' => '',
            'content' => '',
            'media' => array(),
            'init' => 1
        ));
        $title = $instance['title'];
        $content = $instance['content'];
        $media = $instance['media'];
        $init = $instance['init'];
        $more = count($media);
        if ($more < 3 && $init === 1) {
            for ($i = $more; $i < 3; $i++) {
                $media[] = array();
            }
        }
        ?>
        <div class ="jetty-irotator-widget-form">

            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title') ?>" value="<?php echo esc_attr($title) ?>" />
            </label></p>
            <?php
                foreach ($media as $key => $item) {
                    echo $this->displayMediaItem($item, $key);
                }
            ?>


            <button class="button jirw-add-more<?php echo ($more === 8 ? ' hidden' : ''); ?>" data-widgetbase="<?php echo esc_attr($this->number); ?>"><?php esc_html_e('Add More', 'jirw'); ?></button>
            <div style="clear: both;"></div>

            <p><label for="<?php echo $this->get_field_id('content'); ?>"><?php _e('Content:'); ?>
                <textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('content'); ?>" name="<?php echo $this->get_field_name('content'); ?>"><?php echo $content; ?></textarea>
            </label></p>
        </div>
        <?php
    }

    public function sanitizeItem($item)
    {
        $item = wp_parse_args((array) $item, array('image' => -1, 'url' => ''));
        $cleaned = array();
        $cleaned['image'] = (int) $item['image'];
        $cleaned['url'] = sanitize_text_field($item['url']);

        return $cleaned;
    }

    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $new_instance = wp_parse_args((array) $new_instance, array(
            'title' => '',
            'content' => '',
            'media' => array(),
            'init' => 1
        ));
        // clean up user input

        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['content'] = $new_instance['content'];

        $instance['media'] = array_values(array_map(array($this, 'sanitizeItem'), $new_instance['media']));
        $instance['init']  = sanitize_text_field((int) $new_instance['init']);

        return $instance;
    }
}
