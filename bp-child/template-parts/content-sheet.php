<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package BP
 */

$path = bp_get_file_sheet_path();
$size = false;
$link = false;
if ($path) {
    $size = FileSizeConvert(filesize($path));
    $link = true;
}
?>
<div class="doc-list-full-item clearfix">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php
            if ( is_single() ) {
                the_title( '<h3 class="entry-title">', '</h3>');
            } else {
                the_title( '<div class="col-md-10 col-sm-10"><small>'. get_the_date() .'</small><h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a>' );
            }

        if ($size) printf('<small class="file-sheet-size">(%s)</small></h3></div>', $size);
        if ($link) printf('<a class="pdf_link" href="%s" target="_blank"><div class="col-md-2 col-sm-2"><img class="pdf_downloads img-responsive img-thumbnail" width="24" height="24" src="%s/img/pdf_lrg.gif"></div></a>', get_post_meta($post->ID, "_bp_sheet_file", true), get_stylesheet_directory_uri());

        ?>
    </header><!-- .entry-header -->
<?php
    if ( is_single()){
    ?>
    <div class="entry-content">
        <?php
            the_content( sprintf(
                /* translators: %s: Name of current post. */
                wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'bp' ), array( 'span' => array( 'class' => array() ) ) ),
                the_title( '<span class="screen-reader-text">"', '"</span>', false )
            ) );

            wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'bp' ),
                'after'  => '</div>',
            ) );
        ?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php bp_entry_footer(); ?>
    </footer><!-- .entry-footer -->
    <?php } ?>
</article><!-- #post-## -->
</div>