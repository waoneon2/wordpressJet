<?php
/**
 * Template part for displaying posts by category News and Events.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package NCOC
 */

?>
<?php 
$default_permalink = esc_url( get_permalink() );
$url_file = esc_url(jetty_get_the_excerpt(get_the_ID()));
$link_validation = parse_url($url_file);
if(count($link_validation) >= 3){
	$default_permalink = $url_file;
}
?>
<tr class="ncoc-tr-news" id="ncoc_post-<?php the_ID(); ?>">
	<td class="ncoc-td-date-news"><p class="date-news"><b><?php the_time('j F'); ?></b></p></td>
	<td class="ncoc-td-title-news"><?php the_title( '<p class="ncoc entry-title"><a href="' . $default_permalink . '" rel="bookmark">', '</a></p>' ); ?></td>
</tr>
