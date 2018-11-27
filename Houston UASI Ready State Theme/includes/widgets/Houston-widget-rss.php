<?php
/**
 * Houston RSS Widget.
 */

class Houston_Widget_RSS extends WP_Widget
{
	public function __construct()
	{
		$widget_ops = array( 'description' => __('Entries from any RSS or Atom feed.') );
		$control_ops = array( 'width' => 400, 'height' => 200 );
		parent::__construct( 'houston_rss', __('Houston RSS', 'houston-uasi'), $widget_ops, $control_ops );
	}

    /**
     * Outputs the content for the current RSS widget instance.
     */
    public function widget( $args, $instance )
    {
        if ( isset($instance['error']) && $instance['error'] )
            return;

        $url = ! empty( $instance['url'] ) ? $instance['url'] : '';
        while ( stristr($url, 'http') != $url )
            $url = substr($url, 1);

        if ( empty($url) )
            return;

        // self-url destruction sequence
        if ( in_array( untrailingslashit( $url ), array( site_url(), home_url() ) ) )
            return;

        $rss = fetch_feed($url);
        $title = $instance['title'];
        $desc = '';
        $link = '';

        if ( ! is_wp_error($rss) ) {
            $desc = esc_attr(strip_tags(@html_entity_decode($rss->get_description(), ENT_QUOTES, get_option('blog_charset'))));
            if ( empty($title) )
                $title = strip_tags( $rss->get_title() );
            $link = strip_tags( $rss->get_permalink() );
            while ( stristr($link, 'http') != $link )
                $link = substr($link, 1);
        }

        if ( empty($title) )
            $title = empty($desc) ? __('Unknown Feed') : $desc;

        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

        $url = strip_tags( $url );
        $icon = includes_url( 'images/rss.png' );
        if ( $title )
            $title = '<a class="rsswidget" href="' . esc_url( $url ) . '"><img class="rss-widget-icon" style="border:0" width="14" height="14" src="' . esc_url( $icon ) . '" alt="RSS" /></a> <a class="rsswidget" href="' . esc_url( $link ) . '">'. esc_html( $title ) . '</a>';

        echo $args['before_widget'];
        if ( $title ) {
            echo $args['before_title'] . $title . $args['after_title'];
        }
        $this->rss_output( $rss, $instance );
        echo $args['after_widget'];

        if ( ! is_wp_error($rss) )
            $rss->__destruct();
        unset($rss);
    }

    /**
     *
     */
    public function rss_output($rss, $args = [])
    {
        if ( is_string( $rss ) ) {
            $rss = fetch_feed($rss);
        } elseif ( is_array($rss) && isset($rss['url']) ) {
            $args = $rss;
            $rss = fetch_feed($rss['url']);
        } elseif ( !is_object($rss) ) {
            return;
        }

        if ( is_wp_error($rss) ) {
            if ( is_admin() || current_user_can('manage_options') )
                echo '<p>' . sprintf( __('<strong>RSS Error</strong>: %s'), $rss->get_error_message() ) . '</p>';
            return;
        }

        $default_args = array( 'show_author' => 0, 'show_date' => 0, 'show_summary' => 0, 'items' => 0 );
        $args = wp_parse_args( $args, $default_args );

        $items = (int) $args['items'];
        if ( $items < 1 || 20 < $items )
            $items = 10;
        $show_summary  = (int) $args['show_summary'];
        $show_author   = (int) $args['show_author'];
        $show_date     = (int) $args['show_date'];

        if ( !$rss->get_item_quantity() ) {
            echo '<ul><li>' . __( 'An error has occurred, which probably means the feed is down. Try again later.' ) . '</li></ul>';
            $rss->__destruct();
            unset($rss);
            return;
        }

        echo '<ul>';
        foreach ( $rss->get_items( 0, $items ) as $item ) {
            $link = $item->get_link();
            while ( stristr( $link, 'http' ) != $link ) {
                $link = substr( $link, 1 );
            }
            $link = esc_url( strip_tags( $link ) );

            $title = esc_html( trim( strip_tags( $item->get_title() ) ) );
            if ( empty( $title ) ) {
                $title = __( 'Untitled' );
            }
            $title = '<h3>' . $title . '</h3>';

            $desc = @html_entity_decode( $item->get_description(), ENT_QUOTES, get_option( 'blog_charset' ) );
            $desc = esc_attr($desc);

            $summary = '';
            if ( $show_summary ) {
                $summary = $desc;

                // Change existing [...] to [&hellip;].
                if ( '[...]' == substr( $summary, -5 ) ) {
                    $summary = substr( $summary, 0, -5 ) . '[&hellip;]';
                }

                $summary = '<div class="rssSummary">' . esc_html( $summary ) . '</div>';
            }

            $date = '';
            if ( $show_date ) {
                $date = $item->get_date( 'U' );

                if ( $date ) {
                    $date = ' <span class="rss-date">' . date_i18n( get_option( 'date_format' ), $date ) . '</span>';
                }
            }

            $author = '';
            if ( $show_author ) {
                $author = $item->get_author();
                if ( is_object($author) ) {
                    $author = $author->get_name();
                    $author = ' <cite>' . esc_html( strip_tags( $author ) ) . '</cite>';
                }
            }

            if ( $link == '' ) {
                echo "<li>$title{$date}{$summary}{$author}</li>";
            } elseif ( $show_summary ) {
                echo "<li><a class='rsswidget' href='$link'>$title</a>{$date}{$summary}{$author}</li>";
            } else {
                echo "<li><a class='rsswidget' href='$link'>$title</a>{$date}{$author}</li>";
            }
        }
        echo '</ul>';
        $rss->__destruct();
        unset($rss);
    }

    public function update( $new_instance, $old_instance )
    {
        $testurl = ( isset( $new_instance['url'] ) && ( !isset( $old_instance['url'] ) || ( $new_instance['url'] != $old_instance['url'] ) ) );
        return wp_widget_rss_process( $new_instance, $testurl );
    }

    public function form( $args )
    {
        if ( empty( $args ) ) {
            $args = array( 'title' => '', 'url' => '', 'items' => 10, 'error' => false, 'show_summary' => 0, 'show_author' => 0, 'show_date' => 0 );
        }
        $args['number'] = $this->number;

        $default_inputs = array( 'url' => true, 'title' => true, 'items' => true, 'show_summary' => true, 'show_author' => true, 'show_date' => true );
        $inputs = wp_parse_args([], $default_inputs );

        $args['title'] = isset( $args['title'] ) ? $args['title'] : '';
        $args['url'] = isset( $args['url'] ) ? $args['url'] : '';
        $args['items'] = isset( $args['items'] ) ? (int) $args['items'] : 0;

        if ( $args['items'] < 1 || 20 < $args['items'] ) {
            $args['items'] = 10;
        }

        $args['show_summary']   = isset( $args['show_summary'] ) ? (int) $args['show_summary'] : (int) $inputs['show_summary'];
        $args['show_author']    = isset( $args['show_author'] ) ? (int) $args['show_author'] : (int) $inputs['show_author'];
        $args['show_date']      = isset( $args['show_date'] ) ? (int) $args['show_date'] : (int) $inputs['show_date'];

        if ( ! empty( $args['error'] ) ) {
            echo '<p class="widget-error"><strong>' . sprintf( __( 'RSS Error: %s' ), $args['error'] ) . '</strong></p>';
        }

        $esc_number = esc_attr( $args['number'] );
        if ( $inputs['url'] ) :
    ?>
        <p><label for="houston-rss-url-<?php echo $esc_number; ?>"><?php _e( 'Enter the RSS feed URL here:' ); ?></label>
        <input class="widefat" id="houston-rss-url-<?php echo $esc_number; ?>" name="widget-houston_rss[<?php echo $esc_number; ?>][url]" type="text" value="<?php echo esc_url( $args['url'] ); ?>" /></p>
    <?php endif; if ( $inputs['title'] ) : ?>
        <p><label for="houston-rss-title-<?php echo $esc_number; ?>"><?php _e( 'Give the feed a title (optional):' ); ?></label>
        <input class="widefat" id="houston-rss-title-<?php echo $esc_number; ?>" name="widget-houston_rss[<?php echo $esc_number; ?>][title]" type="text" value="<?php echo esc_attr( $args['title'] ); ?>" /></p>
    <?php endif; if ( $inputs['items'] ) : ?>
        <p><label for="houston-rss-items-<?php echo $esc_number; ?>"><?php _e( 'How many items would you like to display?' ); ?></label>
        <select id="houston-rss-items-<?php echo $esc_number; ?>" name="widget-houston_rss[<?php echo $esc_number; ?>][items]">
        <?php
        for ( $i = 1; $i <= 20; ++$i ) {
            echo "<option value='$i' " . selected( $args['items'], $i, false ) . ">$i</option>";
        }
        ?>
        </select></p>
    <?php endif; if ( $inputs['show_summary'] ) : ?>
        <p><input id="houston-rss-show-summary-<?php echo $esc_number; ?>" name="widget-houston_rss[<?php echo $esc_number; ?>][show_summary]" type="checkbox" value="1" <?php checked( $args['show_summary'] ); ?> />
        <label for="houston-rss-show-summary-<?php echo $esc_number; ?>"><?php _e( 'Display item content?' ); ?></label></p>
    <?php endif; if ( $inputs['show_author'] ) : ?>
        <p><input id="houston-rss-show-author-<?php echo $esc_number; ?>" name="widget-houston_rss[<?php echo $esc_number; ?>][show_author]" type="checkbox" value="1" <?php checked( $args['show_author'] ); ?> />
        <label for="houston-rss-show-author-<?php echo $esc_number; ?>"><?php _e( 'Display item author if available?' ); ?></label></p>
    <?php endif; if ( $inputs['show_date'] ) : ?>
        <p><input id="houston-rss-show-date-<?php echo $esc_number; ?>" name="widget-houston_rss[<?php echo $esc_number; ?>][show_date]" type="checkbox" value="1" <?php checked( $args['show_date'] ); ?>/>
        <label for="houston-rss-show-date-<?php echo $esc_number; ?>"><?php _e( 'Display item date?' ); ?></label></p>
    <?php
        endif;
        foreach ( array_keys($default_inputs) as $input ) :
            if ( 'hidden' === $inputs[$input] ) :
                $id = str_replace( '_', '-', $input );
    ?>
        <input type="hidden" id="houston-rss-<?php echo esc_attr( $id ); ?>-<?php echo $esc_number; ?>" name="widget-houston_rss[<?php echo $esc_number; ?>][<?php echo esc_attr( $input ); ?>]" value="<?php echo esc_attr( $args[ $input ] ); ?>" />
    <?php
            endif;
        endforeach;
    }
}