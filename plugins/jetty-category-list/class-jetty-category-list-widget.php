<?php
class Jetty_Category_List_Widget extends WP_Widget
{
    public function __construct()
    {
        $widget_ops = array(
            'classname' => 'jetty_category_list_widget',
            'description' => __( 'A widget that allow to display your posts in widget areas.', 'jcl' ),
            'customize_selective_refresh' => true,
        );
        parent::__construct('jetty_category_list_widget', _x( 'Jetty Category list Widget', 'Jetty Category list Widget' ), $widget_ops);
    }

    public function widget($args, $instance)
    {
        $instance = wp_parse_args((array) $instance, $this->getDefaultSettings());
       

        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        $in_post = false;
        $no_post = true;
        if (is_singular('post')) {
            $in_post = get_the_ID();
        }
        $list_cat = implode(',', $instance['cat']);
        $parameters = [
            'post_type'      => 'post',
            'cat'            => $list_cat,
            'posts_per_page' => (int) $instance['num'],
            'orderby'        => $instance['sort_by'],
            'order'          => $instance['asc_sort_order'] ? 'ASC' : 'DESC'
        ];

        if ($instance['exclude_current_post'] && $in_post !== false) {
            $parameters['post__not_in'] = [$in_post];
        }
        $query = new WP_Query($parameters); ?>

        <?php echo $args['before_widget']; ?>
        <?php
            if ($title !== '') {
                $linkTitle = $instance['title_link_url'];
                if (empty($linkTitle)) {
                    echo $args['before_title'] . $title . $args['after_title'];
                } else {
                    echo $args['before_title'] . sprintf('<a href="%s">%s</a>', esc_url($linkTitle), $title) . $args['after_title'];
                }
            }
        ?>
        <ul class="jetty-widget-post-tag-category-recent">
            <?php if ($query->have_posts()) : ?>
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <?php if ($instance['hide_no_thumbnail'] && !has_post_thumbnail()) continue; ?>
                    <?php $no_post = false; ?>
                    <li>
                        <div class="jetty-cat-list-post-title">
                            <a href="<?php the_permalink(); ?>" rel="bookmark"><?php get_the_title() ? the_title() : the_ID(); ?></a>
                        </div>
                        <?php if ($instance['show_date']): ?>
                            <span class="jetty-cat-list-post-date"><?php echo get_the_date($instance['date_format']); ?></span>
                        <?php endif; ?>
                        <div class="jetty-cat-list-post-details">
                            <?php if ($instance['show_post_thumbnail'] && has_post_thumbnail()): ?>
                            <img width="<?php echo esc_attr($instance['post_thumbnail_w']); ?>" height="<?php echo esc_attr($instance['post_thumbnail_h']); ?>" src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="<?php echo get_the_title(get_the_ID()); ?>">
                            <?php endif; ?>
                            <div class="jetty-cat-list-post-excerpt"><?php $this->custom_excerpts($instance['excerpt_length'], $instance['excerpt_more'], get_the_permalink()); ?></div>
                        </div>
                    </li>
                <?php endwhile; ?>
                <!-- if no post found -->
                <?php if ($no_post): ?>
                      <li>- No Post Found -</li>
                <?php endif ?>
                <?php wp_reset_postdata(); ?>
            <?php else: ?>
                <!-- if no post found -->
                <li>- No Post Found -</li>
            <?php endif; ?>
        </ul>
        <?php if ($instance['footer_text'] && $instance['footer_url']): ?>
            <h3><a href="<?php echo esc_url($instance['footer_url']) ?>"><?php echo $instance['footer_text']; ?></a></h3>
        <?php endif ?>

        <?php echo $args['after_widget']; 
    }

    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $new_instance = wp_parse_args((array) $new_instance, $this->getDefaultSettings());
        // clean up user input
        $instance['title']                  = sanitize_text_field($new_instance['title']);
        $instance['title_link_url']         = esc_url($new_instance['title_link_url']);
        $instance['cat']                    = (array) $new_instance['cat'];
        $instance['num']                    = (int) sanitize_text_field($new_instance['num']);
        $instance['exclude_current_post']   = $new_instance['exclude_current_post'] === '1' ? true : false;
        $instance['sort_by']                = sanitize_text_field($new_instance['sort_by']);
        $instance['status']                 = sanitize_text_field($new_instance['status']);
        $instance['asc_sort_order']         = $new_instance['asc_sort_order'] === '1' ? true : false;
        // thumbnail
        $instance['show_post_thumbnail']    = $new_instance['show_post_thumbnail'] === '1' ? true : false;
        $instance['post_thumbnail_w']       = sanitize_text_field($new_instance['post_thumbnail_w']);
        $instance['post_thumbnail_h']       = sanitize_text_field($new_instance['post_thumbnail_h']);
        $instance['hide_no_thumbnail']      = $new_instance['hide_no_thumbnail'] === '1' ? true : false;
        // date format
        $instance['show_date']              = $new_instance['show_date'] === '1' ? true : false;
        $instance['date_format']            = sanitize_text_field($new_instance['date_format']);
        // excerpt
        $instance['excerpt_length']         = (int) sanitize_text_field($new_instance['excerpt_length']);
        $instance['excerpt_more']           = sanitize_text_field($new_instance['excerpt_more']);
        // footer
        $instance['footer_text']            = sanitize_text_field($new_instance['footer_text']);
        $instance['footer_url']             = esc_url($new_instance['footer_url']);

        //filter
        if ($instance['num'] == 0) $instance['num'] = 1;
        if ($instance['num'] < 0) $instance['num'] = -1;

        return $instance;
    }

    protected function getDefaultSettings()
    {
        return [
            // title for widget
            'title'                 => __('Recent Posts', 'jcl'),
            'title_link_url'        => '',
            // category and tags filter
            'cat'                   => array(), // filter by cat
            'num'                   => get_option('posts_per_page'), // how many posts should displayed?
            'exclude_current_post'  => false,
            // thumbnail
            'show_post_thumbnail'   => true,
            'post_thumbnail_w'      => '',
            'post_thumbnail_h'      => '',
            'hide_no_thumbnail'     => false,
            // sort by
            'sort_by'               => 'date',
            'asc_sort_order'        => false,
            // date format
            'show_date'             => true,
            'date_format'           => 'F j, Y',
            // excerpt
            'excerpt_length'        => apply_filters('excerpt_length', 55),
            'excerpt_more'          => '',
            // footer
            'footer_text'           => '',
            'footer_url'            => '',
        ];
    }

    public function form($instance)
    {   
        $instance = wp_parse_args((array) $instance, $this->getDefaultSettings());
        ?>
        <div class ="jetty-category-list-tag-form">
            <h3><?php _e('Title', 'jcl'); ?></h3>
            <!-- title -->
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'jcl'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" maxlength="50"/></label></p>

            <p><label for="<?php echo $this->get_field_id('title_link_url'); ?>"><?php _e('Title link URL:', 'jcl'); ?> <input type="text" class="widefat" value="<?php echo esc_url($instance['title_link_url']); ?>" name="<?php echo $this->get_field_name('title_link_url'); ?>" id="<?php $this->get_field_id('title_link_url'); ?>"></label></p>

            <!-- Listing -->
            <h3><?php _e('Listing: ', 'jcl'); ?></h3>
            <?php $list_cat = implode(',', $instance['cat']); ?>
            <p><label for="<?php echo $this->get_field_id('cat') ?>"><?php _e('Category:', 'jcl'); ?>
                <?php wp_dropdown_categories([
                    'selected'      => $list_cat,
                    'show_count'    => false,
                    'name'          => $this->get_field_name('cat'),
                    'id'            => $this->get_field_id('cat'),
                    'multiple'      => true
                ]); ?></label></p>

            <p><label for="<?php echo $this->get_field_id('num'); ?>"><?php _e('Number of posts to show <i>(-1 to show all)</i>', 'jcl'); ?><input type="number" class="widefat" name="<?php echo $this->get_field_name('num'); ?>" id="<?php echo $this->get_field_id('num'); ?>" value="<?php echo esc_attr($instance['num']); ?>"    ></label></p>

            <?php $sort_option = array('none', 'ID', 'author', 'title', 'name', 'type', 'date', 'modified', 'parent', 'rand', 'comment_count', 'menu_order') ?>
            <?php if (get_current_user_id() == 1): ?>
            <p><label for="<?php echo $this->get_field_id('sort_by'); ?>"><?php _e('Sort by: '); ?>
                <select name="<?php echo $this->get_field_name('sort_by'); ?>" id="<?php echo $this->get_field_id('sort_by'); ?>">
                    <?php foreach ($sort_option as $key => $val): ?>
                        <option value="<?php echo $val ?>" <?php selected( esc_attr($instance['sort_by']), $val ); ?>><?php echo $val ?></option>
                    <?php endforeach ?>
                </select>
            </label></p>
            <?php endif ?>

            <p><label for="<?php echo $this->get_field_id('asc_sort_order'); ?>"><input type="checkbox" name="<?php echo $this->get_field_name('asc_sort_order'); ?>" value="1"<?php checked($instance['asc_sort_order'] ? '1' : '0', '1'); ?>><?php _e('Reverse sort order (ASC)', 'jcl'); ?></label></p>

            <p><label for="<?php echo $this->get_field_id('exclude_current_post'); ?>"><input type="checkbox" name="<?php echo $this->get_field_name('exclude_current_post'); ?>" id="<?php echo $this->get_field_id('exclude_current_post'); ?>" value="1"<?php checked($instance['exclude_current_post'] ? '1' : '0', '1'); ?>><?php _e('Excelude current post', 'jcl'); ?></label></p>

            <!-- thumbnail -->
            <h3><?php _e('Thumbnail: ', 'jcl'); ?></h3>
            <p><label for="<?php echo $this->get_field_id('show_post_thumbnail'); ?>"><input type="checkbox" name="<?php echo $this->get_field_name('show_post_thumbnail'); ?>" id="<?php echo $this->get_field_id('show_post_thumbnail'); ?>" value="1"<?php checked($instance['show_post_thumbnail'] ? '1' : '0', '1'); ?>><?php _e('Show post thumbnail', 'jcl'); ?></label></p>
            <p><fieldset>
                <label for="<?php echo $this->get_field_id('post_thumbnail_w'); ?>"><?php _e('Width: ', 'jcl'); ?> <input type="number" name="<?php echo $this->get_field_name('post_thumbnail_w'); ?>" id="<?php echo $this->get_field_id('post_thumbnail_w'); ?>" value="<?php echo esc_attr($instance['post_thumbnail_w']); ?>" class="small-text"></label>
                <label for="<?php echo $this->get_field_id('post_thumbnail_h'); ?>"><?php _e('Height: ', 'jcl'); ?> <input type="number" name="<?php echo $this->get_field_name('post_thumbnail_h'); ?>" id="<?php echo $this->get_field_id('post_thumbnail_h'); ?>" value="<?php echo esc_attr($instance['post_thumbnail_h']); ?>" class="small-text"></label>
            </fieldset></p>
            <p><label for="<?php echo $this->get_field_id('hide_no_thumbnail'); ?>"><input type="checkbox" name="<?php echo $this->get_field_name('hide_no_thumbnail'); ?>" id="<?php echo $this->get_field_id('hide_no_thumbnail'); ?>" value="1"<?php checked($instance['hide_no_thumbnail'] ? '1' : '0', '1'); ?>><?php _e('Hide posts which have no thumbnail', 'jcl'); ?>
            </label></p>

            <!-- date -->
            <h3><?php _e('Date:', 'jcl'); ?></h3>
            <p><label for="<?php echo $this->get_field_id('show_date'); ?>"><input type="checkbox" name="<?php echo $this->get_field_name('show_date'); ?>" id="<?php echo $this->get_field_id('show_date'); ?>" value="1"<?php checked($instance['show_date'] ? '1' : '0', '1'); ?>><?php _e('Show Date:'); ?> </label></p>
            <p><label for="<?php echo $this->get_field_id('date_format'); ?>"><?php _e('Date format', 'jcl'); ?> <input type="text" name="<?php echo $this->get_field_name('date_format'); ?>" id="<?php echo $this->get_field_id('date_format'); ?>" value="<?php echo esc_attr($instance['date_format']); ?>"></label></p>

            <!-- excerpt -->
            <h3><?php _e('Excerpt:', 'jcl'); ?></h3>
            <p><label for="<?php echo $this->get_field_id('excerpt_length'); ?>"><?php _e('Excerpt length (in words)', 'jcl'); ?><input type="number" class="widefat" name="<?php echo $this->get_field_name('excerpt_length'); ?>" id="<?php echo $this->get_field_id('excerpt_length'); ?>" value="<?php echo esc_attr($instance['excerpt_length']); ?>"></label></p>
            <p><label for="<?php echo $this->get_field_id('excerpt_more'); ?>"><?php _e("Excerpt 'more' text", 'jcl'); ?> <input type="text" class="widefat" name="<?php echo $this->get_field_name('excerpt_more'); ?>" id="<?php echo $this->get_field_id('excerpt_more'); ?>" value="<?php echo esc_attr($instance['excerpt_more']); ?>"></label></p>

            <!-- footer -->
            <h3><?php _e('Footer:', 'jcl'); ?></h3>
            <p><label for="<?php echo $this->get_field_id('footer_text'); ?>"><?php _e('Footer link text', 'jcl'); ?> <input type="text" class="widefat" name="<?php echo $this->get_field_name('footer_text'); ?>" id="<?php echo $this->get_field_id('footer_text'); ?>" value="<?php echo esc_attr($instance['footer_text']); ?>" maxlength="50"></label></p>
            <p><label for="<?php echo $this->get_field_id('footer_url'); ?>"><?php _e('Footer link URL', 'jcl'); ?> <input type="text" class="widefat" value="<?php echo esc_url($instance['footer_url']); ?>" name="<?php echo $this->get_field_name('footer_url'); ?>" id="<?php $this->get_field_id('footer_url'); ?>"></label></p>
        </div>
        <?php
    }

    private function custom_excerpts($limit, $more, $link) {
        echo '<p>'.wp_trim_words(get_the_excerpt(), $limit, '').' '.(($more) ? '<a href="'.$link.'">'.$more.'</a>' : '').'</p>';
    }

}
