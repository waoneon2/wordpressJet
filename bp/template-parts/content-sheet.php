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
    $size = filesize($path) / 1000;
    $link = true;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php
            if ( is_single() ) {
                the_title( '<h2 class="entry-title">', '</h2>');
            } else {
                the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
            }
        if ($size) printf('<span class="file-sheet-size">(%s KB)</span>', $size);
        if ($link) printf('<a class="pdf_link" href="%s" target="_blank"><img class="pdf_download" src="%s/images/pdf_download.png"></a>', get_post_meta($post->ID, "_bp_sheet_file", true), get_template_directory_uri());

        // if ( 'post' === get_post_type() ) : ?>
        <!-- <div class="entry-meta"> -->
            <?php //bp_posted_on(); ?>
        <!-- </div>.entry-meta -->
        <?php
        //endif; ?>
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
