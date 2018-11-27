<?php
/*
 * Jetty Advance Search (JAS)
 * 
*/


//  Global Attribute
$has_form_posted = false;
$hasqmark = false;
$hassearchquery = false;
$urlparams = "/";
$searchterm = "";
$tagid = 0;
$catid = 0;
$defaults = array();
$frmreserved = array();
$taxonomylist = array();

// Global Reserved Attribute
$frmreserved = array("category", "search", "post_tag", "submitted", "post_date", "post_types");
$frmqreserved = array("category_name", "s", "tag", "submitted", "post_date", "post_types");

function jas_register_queryvars($vars){
	$vars[] = 'post_types';
	$vars[] = 'post_date';

	return $vars;
}

add_filter('query_vars','jas_register_queryvars');

function jas_filter_query_post_date($query){
	global $wp_query;

		if(($query->is_main_query())&&(!is_admin())) {
				if(isset($wp_query->query['post_date'])) {
					if(is_string($wp_query->query['post_date'])) :
						$url_encode = urlencode($wp_query->query['post_date']);
						$post_date = explode("+", esc_attr($url_encode));

						if(!empty($post_date)) {
							if (count($post_date) > 1 && $post_date[0] != $post_date[1]) {
								if((!empty($post_date[0]))&&(!empty($post_date[1]))) {
									add_filter('posts_where', 'jas_limit_date_range_query');

									add_action('posts_selection', 'jas_remove_limit_date_range_query');
								}
							} else { 

								if (!empty($post_date[0])) {
									$post_time = strtotime($post_date[0]);
									$query->set('year', date('Y', $post_time));
									$query->set('monthnum', date('m', $post_time));
									$query->set('day', date('d', $post_time));
								}
							}
						}
					endif;
					
				}
		}
}

add_filter('pre_get_posts', 'jas_filter_query_post_date');

function jas_limit_date_range_query( $where ) {
	global $wp_query;

		$post_date = explode("+", esc_attr(urlencode($wp_query->query['post_date'])));

		if (count($post_date) > 1 && $post_date[0] != $post_date[1]) {
				$date_query = array();

			if (!empty($post_date[0])) {
					$pd_0 = urldecode($post_date[0]);
					$date_query['after'] = date('Y-m-d 00:00:00', strtotime($pd_0));
			}

			if (!empty($post_date[1])) {
					$pd_1 = urldecode($post_date[1]);
					$date_query['before'] = date('Y-m-d 23:59:59', strtotime($pd_1));
			}

		}

		$where .= " AND post_date >='" . $date_query['after'] . "' AND post_date <='" . $date_query['before'] . "'";

	return $where;
}

function jas_remove_limit_date_range_query() {
	remove_filter( 'posts_where', 'jas_limit_date_range_query' );
}

function jas_setup(){
	add_shortcode('jetty_advance_search','jas_form');
}
add_action('init','jas_setup');

function jas_form(){
	return jas_get_search_form();
}

function jas_check_post(){
	// Initial of Global attribute
	$glob_searchterm = $GLOBALS['searchterm'];
	$glob_hasqmark = $GLOBALS['hasqmark'];
	$glob_urlparams = $GLOBALS['urlparams'];
	$glob_hassearchquery = $GLOBALS['hassearchquery'];

	if(isset($_POST['submitted']))
	{
		if($_POST['submitted']==="1")
		{
			$GLOBALS["has_form_posted"] = true;
		}
	}

	/* SEARCH BOX */
	if((isset($_POST['search']))&&($GLOBALS["has_form_posted"]))
	{
		$glob_searchterm = trim(stripslashes($_POST['search']));

		if($glob_searchterm!="")
		{
			if(!$glob_hasqmark)
			{
				$glob_urlparams .= "?";
				$glob_hasqmark = true;
			}
			else
			{
				$glob_urlparams .= "&";
			}
			$glob_urlparams .= "s=".urlencode($glob_searchterm);
			$glob_hassearchquery = true;
		}
	}

	/* POST DATE */
	if((isset($_POST['post_date']))&&($GLOBALS["has_form_posted"]))
	{
		$the_post_date = ($_POST['post_date']);

		if(!is_array($the_post_date))
		{
			$post_date_arr[] = $the_post_date;
		}
		else
		{
			$post_date_arr = $the_post_date;
		}

		$num_post_date = count($post_date_arr);

		for($i=0; $i<$num_post_date; $i++)
		{
			if($post_date_arr[$i]=="0")
			{
				$post_date_arr[$i] = "all";
			}
		}

		if(count($post_date_arr)>0)
		{
			$post_date_count = count($post_date_arr);

			if($post_date_count==2)
			{

				if(($post_date_arr[0]!="")&&($post_date_arr[1]==""))
				{
					$post_date = $post_date_arr[0];
				}
				else if($post_date_arr[1]=="")
				{
					unset($post_date_arr[1]);
				}
				else if($post_date_arr[0]=="")
				{
					$post_date = "+".$post_date_arr[1];
				}
				else
				{
					$post_date = implode("+",array_filter($post_date_arr));
				}
			}
			else
			{
				$post_date = $post_date_arr[0];
			}

			if(isset($post_date))
			{
				if($post_date!="")
				{
					if(!$glob_hasqmark)
					{
						$glob_urlparams .= "?";
						$glob_hasqmark = true;
					}
					else
					{
						$glob_urlparams .= "&";
					}
					$glob_urlparams .= "post_date=".$post_date;
				}
			}
		}
	}

	if($GLOBALS["has_form_posted"])
	{

		if($glob_urlparams=="/")
		{
			$glob_urlparams .= "?s=";
		}

		wp_redirect((home_url().$glob_urlparams));
		exit;
	}
}
add_action( 'get_header', 'jas_check_post');

function jas_get_search_form() {

	$returnvar = '<form action="" method="post" class="searchandfilter" id="jetty_advance_search_filter">
    <div>
        <div class="form-group clearfix">
            <div class="col-md-2 col-sm-2 col-xs-12">
                <label class="control-label" for="f_q">Keywords</label>
            </div>
            <div class="col-md-8 col-sm-8 col-xs-8">
                <input class="form-control " type="text" name="search" placeholder="" required>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-4">
                <button class="btn btn-success" type="submit">Search</button>
            </div>
        </div>

        <div class="form-group clearfix">
            <div class="col-md-2 col-sm-2 col-xs-12">
                <label class="control-label" for="f_sd">Between</label>
            </div>
            <div class="col-md-8 col-sm-8 col-xs-8">
                <input class="form-control postform" type="text" name="post_date[]" id="f_sd">
            </div>
            <div class="col-sm-2">
                <img src="'.trailingslashit(get_stylesheet_directory_uri()).'img/icon.gif" id="cal_trigger_1" alt="Date Selector" title="Date Selector" />
            </div>
        </div>

        <div class="form-group clearfix">
            <div class="col-md-2 col-sm-2 col-xs-12">
                <label class="control-label" for="f_ed">And</label>
            </div>
            <div class="col-md-8 col-sm-8 col-xs-8">
                <input class="form-control postform" type="text" name="post_date[]" id="f_ed">
            </div>
            <div class="col-sm-2">
                <img src="'.trailingslashit(get_stylesheet_directory_uri()).'img/icon.gif" id="cal_trigger_2" alt="Date Selector" title="Date Selector" />
            </div>
        </div>
        <input type="hidden" name="submitted" value="1">
    </div>
</form>';
	return $returnvar;
}
?>