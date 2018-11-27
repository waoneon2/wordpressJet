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
		$meta_telephone_numb = get_post_meta( get_the_ID(), '_meta_telephone_numb', true );
		$meta_telephone_email = get_post_meta( get_the_ID(), '_meta_telephone_email', true );
		$meta_telephone_name = get_post_meta( get_the_ID(), '_meta_telephone_name', true );
	?>

<div class="listing-post-archive">
    <div class="head-link">
    	<?php 
    	the_title() ;
    	if (!empty($meta_telephone_numb) && !empty($meta_telephone_email)) {
    		echo ': '.$meta_telephone_numb.' or email: '.$meta_telephone_email;
    	} else if (!empty($meta_telephone_numb)) {
    		echo ': '.$meta_telephone_numb;
    	} else if (!empty($meta_telephone_email)) {
    		echo ': '.$meta_telephone_email;
    	}
    	?>	
	</div>
    <div class="label-link"><?php echo $meta_telephone_name;?></div>
</div>
