<?php /* Template for displaying a "No posts found" message. */ ?>
<style type="text/css">
/*Style for login form on private post/page */
#login h1 {
    text-align: center;
}
#login {
    width: 320px;
    padding: 8% 0 0;
    margin: auto;
}
#login form, #login h1 a {
    overflow: hidden;
    font-weight: 400;
}
#login form {
    margin-top: 20px;
    margin-bottom: 20px;
    margin-left: 0;
    padding: 26px 24px 46px;
    background: #fff;
    -webkit-box-shadow: 0 1px 3px rgba(0,0,0,.13);
    box-shadow: 0 1px 3px rgba(0,0,0,.13);
}
#login form p {
	margin-bottom: 0;
}
#login label {
    color: #72777c;
    font-size: 14px;
}

#login form input[type=text],
#login form input[type=password],
#login form input[type=checkbox] {
	border: 1px solid #ddd;
    -webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,.07);
    box-shadow: inset 0 1px 2px rgba(0,0,0,.07);
    background-color: #fff;
    color: #32373c;
    outline: 0;
    -webkit-transition: 50ms border-color ease-in-out;
    transition: 50ms border-color ease-in-out;
}
#login form .input, #login input[type=text] {
    font-size: 24px;
    width: 100%;
    padding: 3px;
    margin: 2px 6px 16px 0;
}
#login form .input, 
#login form input[type=checkbox], 
#login input[type=text] {
    background: #fbfbfb;
}
</style>
<?php
	global $wp_query;
	$slug = '';
	if(isset($wp_query->query['pagename'])){
		$slug = $wp_query->query['pagename'];
	} 
	if(isset($wp_query->query['name'])) {
		$slug = $wp_query->query['name'];
	}
	
	$status = get_page_by_path($slug, OBJECT, array('post','page'));

	if (is_object($status) && $status->post_status == "private" && !is_user_logged_in()) {
?>
	<div id="login" class="for_private_login">
	<h1 style="color: #921818;">Authorization required - please log in.</h1>
	<?php echo '<h3 style="display:none;" class="hide_title_private">'.$status->post_title.'<h3>'; ?>
	<?php 
		$args = array(
		    'redirect' => get_permalink($status->ID),
		    'form_id'  => 'private_loginform',
		    'id_username' => 'private_user',
    		'id_password' => 'private_pass',
		   );
		wp_login_form($args); 
	?>
	</div>
<?php

	} else {

?>
	<div class="entry-content clearfix"><?php
	if (is_search()) { ?>
		<p><?php _e('Sorry, but nothing matched your search terms. Please try again with different keywords.', 'asc'); ?></p><?php
	} else { ?>
		<p><?php _e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'asc'); ?></p><?php
	}
	get_search_form(); ?>
	</div>
	<div class="not-found-widgets asc-section asc-group">
		<div class="asc-col asc-1-2 home-2"><?php
			$instance = array('title' => __('Popular Articles', 'asc'), 'postcount' => '5', 'order' => 'comment_count', 'excerpt' => 'first', 'sticky' => 1);
			$args = array('before_widget' => '<div class="sb-widget">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title"><span>', 'after_title' => '</span></h4>');
			the_widget('asc_custom_posts', $instance , $args); ?>
		</div>
		<div class="asc-col asc-1-2 home-3"><?php
			$instance = array('title' => __('Random Articles', 'asc'), 'postcount' => '5', 'order' => 'rand', 'excerpt' => 'first', 'sticky' => 1);
			$args = array('before_widget' => '<div class="sb-widget">', 'after_widget' => '</div>', 'before_title' => '<h4 class="widget-title"><span>', 'after_title' => '</span></h4>');
			the_widget('asc_custom_posts', $instance , $args); ?>
		</div>
	</div>
<?php

	}
?>
<script type="text/javascript">
	( function( $ ) {
	$( document ).ready(function() {
  	  var html_val = $('span.bc-text').html();
  	  var length_h3_private = $('h3.hide_title_private').length;
  	  if(length_h3_private !== 0){
  	  	var current_title = $('h3.hide_title_private').html();
	  	if(html_val === 'Page not found (404)'){
	  	  	$('span.bc-text').html(current_title);
	  	}
  	  }
	});
} )( jQuery );
</script>
