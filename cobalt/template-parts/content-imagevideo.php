<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package cobalt
 */

$path = cobalt_get_file_image_video_path();
$size = false;
$link = false;
$video_exstention = array("avi", "flv", "mp4", "mkv", "webm");
$img_exstention = array("jpg","jpeg","png","gif");
if ($path) {
    $size = FileSizeConvert(filesize($path));
    $link = true;
}

$filetype = wp_check_filetype(get_post_meta($post->ID, "_cobalt_image_video_file", true));
$filenameupload = get_post_meta($post->ID, "_cobalt_image_video_file", true);
$getfile = basename($filenameupload);
$test = "http://www.google.com";

if ($filenameupload) :
// var_dump($filetype["ext"]);
?>

<div class="listing-post-archive img-vid row">
	<div class="box-container col-md-10">
		<div class="date"><?php the_time('F d, Y'); ?> </div>
        <div class="head-link">
        	<a href="<?php echo esc_url($filenameupload); ?>" target='_blank'>
        		<?php echo $getfile; ?>
        	</a>
        </div>
        <div class="label-link">(<?php echo $size; ?>)</div>
    </div>
    <div class="img-box  col-md-2">
       <?php if(in_array($filetype["ext"], $video_exstention)){
            echo '<video class="thumbnail" src="'.esc_url($filenameupload).'"></video>';
        } ?>
        <?php if(in_array($filetype["ext"], $img_exstention)){
            echo '<img class="thumbnail" src="'.esc_url($filenameupload).'">';
        } ?>
    </div>
</div>



<?php 
endif;

?>
