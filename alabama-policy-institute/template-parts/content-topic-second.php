<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Alabama_Policy_Institute
 */
?>
<?php 
$terms = get_the_terms(get_the_ID(), 'topic');
$bol_term = false;
$url = "#";
$href = "";

if (!empty($terms)) {
    $bol_term = true;

    foreach ($terms as $term) {
      $url = get_term_link($term->term_id, 'topic');
      $href[] = '<a href="'.esc_url($url).'">, '.$term->name.'</a>';
    }
}

?>
<article id="post-<?php the_ID(); ?>" class="content__box page-pub">
	<div class="content__image">
    <?php
        if ( has_post_thumbnail() ) {
            the_post_thumbnail();
        } else {
            echo '<img src="'.get_bloginfo('template_directory').'/img/placeholder.jpg">';
        }
    ?>
    </div>
    <div class="content__inner">
        <?php the_title( '<h4 class="content__title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' ); ?>
        <p class="content__date"><?php the_time('M j, Y'); ?></p>
        <p class="p-type">
            <?php
            if($bol_term){
                foreach ($href as $vhref) {
                    echo $vhref;
                }
            }
            ?>
        </p>
        <p class="content__text"><?php echo alabama_policy_institute_get_excerpt(350); ?></p>
    </div>
</article><!-- #post-<?php the_ID(); ?> -->
