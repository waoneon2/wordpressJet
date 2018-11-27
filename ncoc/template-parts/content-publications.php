<?php
/**
 * Template part for displaying posts on category publications.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package NCOC
 */

$url_file = esc_url(jetty_get_the_excerpt(get_the_ID()));
$link_validation = parse_url($url_file);
$check_file = wp_check_filetype($url_file);
$path_convert_to_filesize = ncoc_remote_filesize($url_file);
$link_to_file = "invalid";
$size = 0;
$link = false;
if ($path_convert_to_filesize) {
    $size = FileSizeConverts($path_convert_to_filesize);
    $link = true;
}
$file_type = "invalid";
if(count($link_validation) >= 3):
$link_to_file = $url_file;
$filetype = wp_check_filetype($link_to_file);
$file_type = $filetype['ext'];
endif;
?>
<div class="archive-pub-container col-sm-6">
        <div class="ncoc-pub-content">
            <div class="place-img-pub">
            <?php if(has_post_thumbnail()) : ?>
                <img src="<?php echo get_the_post_thumbnail_url(); ?>" class="img-responsive img-thumbnail">
            <?php else: ?>
                <img  src="<?php echo get_template_directory_uri(). "/images/No_Image_Available.png"; ?>" class="empty-img">
            <?php endif; ?>
            <div class="place-desc-file">
                <?php if($link_to_file != "invalid"): the_title( '<p class="ncoc entry-title"><a href="' . $link_to_file . '" rel="bookmark" target="_blank">', '</a></p>' ); else: the_title( '<p class="ncoc entry-title">', '</p>' ); endif;?>
                <?php printf(__('<p class="file-type">File type: <span class="text-uppercase">%s</span></p>','ncoc_file_pub'), $file_type); ?>
                <?php printf(__('<p class="file-size">File size: %s</p>','ncoc_file_pub'), $size); ?>
            </div>
            </div>
        </div>
</div>

