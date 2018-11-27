<?php
/**
 * Template Name: Images Page
 */

get_header(); ?>
<style>
    .pagination-count {
        text-align: -webkit-center;
        text-align: center;
    }
    .title-img, .title-latest {
        padding-left: 0;
    }
</style>

<div id="primary" class="content-area">
        <main id="main" class="site-main">

        <?php
            $cat_img = (int) get_theme_mod('category_img');
            $bol_cat_img = false;
            if($cat_img){
                $bol_cat_img = true;
                $cat_img_args = array(
                    'cat'               => $cat_img,
                    'post_type'         => array('post','attachment'),
                    'post_status'       => array('publish','inherit'),
                    'posts_per_page'    => 10,
                    'nopaging'          => false,
                    'paged'             => get_query_var( 'paged' ),
                );
                $img_category = new WP_Query( $cat_img_args );
            }

            if($bol_cat_img){
            ?>
            <article id="post-tag-template">
                <header class="entry-header">
                    <h1 class="entry-title title-img"><?php _e(get_the_title(),'andeavor'); ?></h1>
                </header><!-- .entry-header -->

                <div class="entry-content">
                    <p class="count-showing">
                    <?php
                        $paged    = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
                        $per_page = $img_category->get( 'posts_per_page' );
                        $total    = $img_category->found_posts;
                        $first    = ( $per_page * $paged ) - $per_page + 1;
                        $last     = min( $total, $img_category->get( 'posts_per_page' ) * $paged );

                        printf( _x( 'Showing <span class="res">%1$d</span> – <span class="res">%2$d</span> of <span class="res">%3$d</span>', '%1$d = first, %2$d = last, %3$d = total', 'andeavor' ), $first, $last, $total );
                    ?>
                    </p>
                </div><!-- .entry-content -->

                <div class="content-img">
                    <p><?php echo $post->post_content; ?></p>
                </div>

                <div class="row-list-cat">
                    
                    <?php
                        if ( $img_category->have_posts() ) :
                            while ( $img_category->have_posts() ) :
                                $img_category->the_post();
                                $thumb_url = ($post->post_type == 'post') ? get_the_post_thumbnail_url($post->ID, 'full') : $post->guid;    
                                ?>
                                <div class="list-title cat_image_content row">
                                    <div class="col-sm-8">
                                        <a href="<?php echo $thumb_url; ?>" class="content-box">
                                            <h4><?php the_title() ?></h4>
                                        </a>
                                        <span> (<?php andeavor_sizeinfo($thumb_url); ?>)</span>
                                    </div>
                                    <div class="col-sm-4">
                                        <a href="<?php echo $thumb_url; ?>">
                                            <?php if ($post->post_type == 'post'): ?>
                                                <?php if (has_post_thumbnail()): ?>
                                                    <span class="cat_image" style="float: right;">
                                                       <span class="cat_image_size">
                                                           <?php the_post_thumbnail('thumbnail') ?>
                                                       </span>
                                                    </span> 
                                                <?php endif ?>
                                            <?php else: ?>
                                                <span class="cat_image" style="float: right;">
                                                   <span class="cat_image_size">
                                                       <img src="<?php echo $post->guid ?>">
                                                   </span>
                                                </span> 
                                            <?php endif ?>
                                        </a>
                                    </div>
                                </div>
                            <?php
                            endwhile;
                        endif;
                    ?>
                </div>
            </article>
                <?php
                $paginate = paginate_links( array(
                    'base'      => str_replace( PHP_INT_MAX, '%#%', esc_url( get_pagenum_link( PHP_INT_MAX ) ) ),
                    'format'    => '?paged=%#%',
                    'current'   => max( 1, absint( get_query_var( 'paged' ) ) ),
                    'total'     => $img_category->max_num_pages,
                    'type'      => 'array',
                    'prev_text' => '&laquo;',
                    'next_text' => '&raquo;',
                ) );
                ?>
            <div class="pagination-count">
                <?php if ( ! empty( $paginate ) ) : ?>
                    <ul class="pagination">
                        <?php foreach ( $paginate as $key => $page_link ) : ?>
                            <li class="paginated_link<?php if ( strpos( $page_link, 'current' ) !== false ) { echo ' active'; } ?>"><?php echo $page_link ?></li>
                        <?php endforeach ?>
                    </ul>
                <?php endif ?>
            </div>
            <?php
                wp_reset_postdata();
            } else {
                get_template_part( 'template-parts/content', 'none' );
            }
        ?>
        </main><!-- #main -->
    </div><!-- #primary -->
<?php
get_footer();