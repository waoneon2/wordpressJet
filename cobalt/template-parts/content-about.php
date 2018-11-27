<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package cobalt
 */

?>

<?php
		$meta_abouturl = get_post_meta( get_the_ID(), '_meta_abouturl', true );
		$input = $meta_abouturl;
		// If scheme not included, prepend it
		if (!preg_match('#^http(s)?://#', $input)) {
		    $input = 'http://' . $input;
		}
		$urlParts = parse_url($input);
		// print_r($urlParts);
		// remove www
		$host = preg_replace('/^www\./', '', $urlParts['host']);
		if (array_key_exists ('path', $urlParts)) {
			$domain = $host . $urlParts['path'];
		} else {
			$domain = $host;
		}
	?>
<div class="listing-post-archive about">
	<a target="_blank" href="<?php echo esc_url($meta_abouturl); ?>">
        <div class="head-link"><?php the_title() ;?></div>
        <div class="label-link"><?php echo $domain; ?></div>
        <div class="img-link">
        	<img src="<?php echo get_template_directory_uri() . '/libs/img/link-chain.png'; ?>">
        </div>
    </a>
</div>

<style type="text/css">

</style>