<?php
/**
 * Template Name: Homepage
 */
get_header();

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
?>
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <div id="bodyContent" class="clearfix">
            <div id="homepageContent" class="clearfix">
                <div class="row" id="on-content-homepage">
                    <div class="col-md-8">
                        <div class="on-box-content" id="on-photo">
                            <div class="on-header">
                                <h2>
                                    <?php
                                        if(get_theme_mod('photo_header_title','Photo')){
                                            _e(get_theme_mod('photo_header_title','Photo'),'us-army'); 
                                        } else {
                                            _e('PHOTO','us-army'); 
                                        }
                                    ?>
                                </h2>
                            </div>
                            <div class="on-body">
                                <div class="clearfix">
                                    <?php _e(slider_image_fort_lee(),'us-army'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="on-box-content hidden-xs" id="on-traveller-stories">
                            <div class="on-header">
                                <h2>
                                    <?php
                                        if(get_theme_mod('traveller_header_text','From the Fort Lee Traveller')){
                                            _e(get_theme_mod('traveller_header_text','From the Fort Lee Traveller'),'us-army'); 
                                        } else {
                                            _e('From the Fort Lee Traveller','us-army');  
                                        }
                                    ?>
                                </h2>
                            </div>
                            <div class="on-body">
                                <div class="clearfix">
                                    <?php
                                        include_once( ABSPATH . WPINC . '/feed.php' );

                                        if(get_theme_mod('traveller_link_feed','https://www.fortleetraveller.com/search/?f=rss&amp;t=article&amp;l=50&amp;s=start_time&amp;sd=desc&amp;k[]=#topstory')){
                                            $link_rss = get_theme_mod('traveller_link_feed','https://www.fortleetraveller.com/search/?f=rss&amp;t=article&amp;l=50&amp;s=start_time&amp;sd=desc&amp;k[]=#topstory');
                                            $rss = fetch_feed($link_rss);
                                        } else {
                                            $rss = fetch_feed('https://www.fortleetraveller.com/search/?f=rss&amp;t=article&amp;l=50&amp;s=start_time&amp;sd=desc&amp;k[]=#topstory' );
                                        }

                                        $maxitems = 0;

                                        if ( ! is_wp_error( $rss ) ) :
                                            $maxitems = $rss->get_item_quantity( 10 );
                                            $rss_items = $rss->get_items( 0, $maxitems );
                                        endif;
                                    ?>

                                    <ul class="injectedDocumentList clearfix">
                                        <?php if ( $maxitems == 0 ) : ?>
                                            <li><?php _e( 'No items', 'my-text-domain' ); ?></li>
                                        <?php else : ?>
                                            <?php foreach ( $rss_items as $item ) : ?>
                                                <li class="documentInfo_wrapper">
                                                    <a href="<?php echo esc_url( $item->get_permalink() ); ?>" target="_blank">
                                                        <h4><?php echo esc_html( $item->get_title() ); ?></h4>
                                                    </a>
                                                    <span class="doc-date"> <?php 
                                                        echo $item->get_date('F j, Y'); ?> </span>
                                                </li>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="on-box-content hidden-xs">
                            <div class="on-header">
                                <h2>
                                    <?php
                                        if(get_theme_mod('installation_status_header_text','Installation Status')){
                                            _e(get_theme_mod('installation_status_header_text','Installation Status'),'us-army'); 
                                        } else {
                                            _e('Installation Status','us-army');  
                                        }
                                    ?>
                                </h2>
                            </div>
                            <div class="on-body">
                                <div class="clearfix">
                                    <div class="installation_content">
                                        <?php 
                                            $link = "";
                                            $text = "";
                                            if(get_theme_mod('installation_status_text','OPEN')){
                                                $text = get_theme_mod('installation_status_text','OPEN');
                                            } else {
                                                $text = "OPEN";
                                            }

                                            if(get_theme_mod('installation_status_link')){
                                                $link = esc_url(get_theme_mod('installation_status_link'));
                                            ?>
                                            <a href="<?php echo $link; ?>"><?php _e($text,'us-army'); ?></a>
                                            
                                            <?php
                                            } else {
                                            ?>
                                            <h3><?php _e($text, 'us-army'); ?></h3>
                                            <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- on mobile version -->
                        <div class="on-box-content hidden-xl hidden-md hidden-lg hidden-sm" id="on-release">
                            <div class="on-header">
                                <h2>
                                    <?php
                                        if(get_theme_mod('release_header_text','Release')){
                                            _e(get_theme_mod('release_header_text','Release'),'us-army'); 
                                        } else {
                                            _e('Release','us-army');  
                                        }
                                    ?>
                                </h2>
                            </div>
                            <div class="on-body">
                                <div class="clearfix">
                                    <?php 
                                        $release_query = "";
                                        if(get_theme_mod('release_for_category')){
                                            $gtm = get_theme_mod('release_for_category');
                                            $latest_release_for_category = array('post_type' => 'post', 'cat' => $gtm, 'posts_per_page' => -1);
                                            $release_query = new WP_Query($latest_release_for_category);
                                        }

                                        if(!empty($release_query)){
                                            if($release_query->have_posts()):
                                                while($release_query->have_posts()) :
                                                    $release_query->the_post();

                                                    echo '<a href="'.esc_url(get_the_permalink()).'"><h3>'.__(get_the_title(),'us_army')."</h3></a><p>". get_the_date('F j, Y',get_the_ID())."</p>";
                                                endwhile;
                                                wp_reset_query();
                                            endif;
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="on-box-content hidden-xl hidden-md hidden-lg hidden-sm" id="on-traveller-stories">
                            <div class="on-header">
                                <h2>
                                    <?php
                                        if(get_theme_mod('traveller_header_text','From the Fort Lee Traveller')){
                                            _e(get_theme_mod('traveller_header_text','From the Fort Lee Traveller'),'us-army'); 
                                        } else {
                                            _e('From the Fort Lee Traveller','us-army');  
                                        }
                                    ?>
                                </h2>
                            </div>
                            <div class="on-body">
                                <div class="clearfix">
                                    <?php
                                        include_once( ABSPATH . WPINC . '/feed.php' );

                                        if(get_theme_mod('traveller_link_feed','https://www.fortleetraveller.com/search/?f=rss&amp;t=article&amp;l=50&amp;s=start_time&amp;sd=desc&amp;k[]=#topstory')){
                                            $link_rss = get_theme_mod('traveller_link_feed','https://www.fortleetraveller.com/search/?f=rss&amp;t=article&amp;l=50&amp;s=start_time&amp;sd=desc&amp;k[]=#topstory');
                                            $rss = fetch_feed($link_rss);
                                        } else {
                                            $rss = fetch_feed('https://www.fortleetraveller.com/search/?f=rss&amp;t=article&amp;l=50&amp;s=start_time&amp;sd=desc&amp;k[]=#topstory' );
                                        }

                                        $maxitems = 0;

                                        if ( ! is_wp_error( $rss ) ) :
                                            $maxitems = $rss->get_item_quantity( 10 );
                                            $rss_items = $rss->get_items( 0, $maxitems );
                                        endif;
                                    ?>

                                    <ul class="injectedDocumentList clearfix">
                                        <?php if ( $maxitems == 0 ) : ?>
                                            <li><?php _e( 'No items', 'my-text-domain' ); ?></li>
                                        <?php else : ?>
                                            <?php foreach ( $rss_items as $item ) : ?>
                                                <li class="documentInfo_wrapper">
                                                    <a href="<?php echo esc_url( $item->get_permalink() ); ?>" target="_blank">
                                                        <h4><?php echo esc_html( $item->get_title() ); ?></h4>
                                                    </a>
                                                    <span class="doc-date"> <?php 
                                                        echo $item->get_date('F j, Y'); ?> </span>
                                                </li>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- // -->

                    </div>
                    <div class="col-md-4">
                        <div class="on-box-content hidden-xs" id="on-release">
                            <div class="on-header">
                                <h2>
                                    <?php
                                        if(get_theme_mod('release_header_text','Release')){
                                            _e(get_theme_mod('release_header_text','Release'),'us-army'); 
                                        } else {
                                            _e('Release','us-army');  
                                        }
                                    ?>
                                </h2>
                            </div>
                            <div class="on-body">
                                <div class="clearfix">
                                    <?php 
                                        $release_query = "";
                                        if(get_theme_mod('release_for_category')){
                                            $gtm = get_theme_mod('release_for_category');
                                            $latest_release_for_category = array('post_type' => 'post', 'cat' => $gtm, 'posts_per_page' => -1);
                                            $release_query = new WP_Query($latest_release_for_category);
                                        }

                                        if(!empty($release_query)){
                                            if($release_query->have_posts()):
                                                while($release_query->have_posts()) :
                                                    $release_query->the_post();

                                                    echo '<a href="'.esc_url(get_the_permalink()).'"><h3>'.__(get_the_title(),'us_army')."</h3></a><p>". get_the_date('F j, Y',get_the_ID())."</p>";
                                                endwhile;
                                                wp_reset_query();
                                            endif;
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="on-box-content hidden-xs">
                            <div class="on-header">
                                <h2>
                                    <?php
                                        if(get_theme_mod('socmed_header_text','Social Media')){
                                            _e(get_theme_mod('socmed_header_text','Social Media'),'us-army'); 
                                        } else {
                                            _e('Social Media','us-army');  
                                        }
                                    ?>
                                </h2>
                            </div>
                            <div class="on-body">
                                <div class="clearfix">
                                    <?php include('fl_social_link.php'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="on-box-content hidden-xs">
                            <div class="on-header">
                                <h2>
                                    <?php
                                        if(get_theme_mod('resources_header_text','Resources')){
                                            _e(get_theme_mod('resources_header_text','Resources'),'us-army'); 
                                        } else {
                                            _e('Resources','us-army'); 
                                        }
                                    ?>
                                </h2>
                            </div>
                            <div class="on-body">
                                <div class="clearfix">
                                    <div class="content_of_resources">
                                        <?php
                                            if(get_theme_mod('content_of_resources')){
                                                $content_text = get_theme_mod('content_of_resources', $default_content_resources);

                                                _e(html_entity_decode($content_text),'us-army');
                                            } else {
                                                echo $default_content_resources;
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- on mobile version -->
                        <div class="on-box-content hidden-xl hidden-md hidden-lg hidden-sm">
                            <div class="on-header">
                                <h2>
                                    <?php
                                        if(get_theme_mod('socmed_header_text','Social Media')){
                                            _e(get_theme_mod('socmed_header_text','Social Media'),'us-army'); 
                                        } else {
                                            _e('Social Media','us-army');  
                                        }
                                    ?>
                                </h2>
                            </div>
                            <div class="on-body">
                                <div class="clearfix">
                                    <?php include('fl_mobile_social_link.php'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="on-box-content hidden-xl hidden-md hidden-lg hidden-sm">
                            <div class="on-header">
                                <h2>
                                    <?php
                                        if(get_theme_mod('resources_header_text','Resources')){
                                            _e(get_theme_mod('resources_header_text','Resources'),'us-army'); 
                                        } else {
                                            _e('Resources','us-army'); 
                                        }
                                    ?>
                                </h2>
                            </div>
                            <div class="on-body">
                                <div class="clearfix">
                                    <div class="content_of_resources">
                                        <?php
                                            if(get_theme_mod('content_of_resources')){
                                                $content_text = get_theme_mod('content_of_resources', $default_content_resources);

                                                _e(html_entity_decode($content_text),'us-army');
                                            } else {
                                                echo $default_content_resources;
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="on-box-content hidden-xl hidden-md hidden-lg hidden-sm">
                            <div class="on-header">
                                <h2>
                                    <?php
                                        if(get_theme_mod('installation_status_header_text','Installation Status')){
                                            _e(get_theme_mod('installation_status_header_text','Installation Status'),'us-army'); 
                                        } else {
                                            _e('Installation Status','us-army');  
                                        }
                                    ?>
                                </h2>
                            </div>
                            <div class="on-body">
                                <div class="clearfix">
                                    <div class="installation_content">
                                        <?php 
                                            $link = "";
                                            $text = "";
                                            if(get_theme_mod('installation_status_text','OPEN')){
                                                $text = get_theme_mod('installation_status_text','OPEN');
                                            } else {
                                                $text = "OPEN";
                                            }

                                            if(get_theme_mod('installation_status_link')){
                                                $link = esc_url(get_theme_mod('installation_status_link'));
                                            ?>
                                            <a href="<?php echo $link; ?>"><?php _e($text,'us-army'); ?></a>
                                            
                                            <?php
                                            } else {
                                            ?>
                                            <h3><?php _e($text, 'us-army'); ?></h3>
                                            <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- // -->
                    </div>
                </div><!-- #on-content-homepage -->
            </div><!-- #homepageContent -->
        </div><!-- #bodyContent -->
    </main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();