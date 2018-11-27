<?php
$root = dirname(dirname(dirname(dirname(dirname(dirname(__FILE__))))));

if (file_exists($root.'/wp-load.php')) {
	require_once($root.'/wp-load.php');
} else {
	require_once($root.'/wp-config.php');
}

// SET YOUR TWITTER API DETAILS HERE
$consumer_key = get_option('twitter_consumer_key', ''); 
$consumer_secret = get_option('twitter_consumer_secret', '');
$oauth_access_token = get_option('twitter_oauth_access_token', '');
$oauth_access_token_secret = get_option('twitter_oauth_access_token_secret', '');

$count = isset($_GET['count']) ? $_GET['count'] : '20';
$include_rts = isset($_GET['include_rts']) ? $_GET['include_rts'] : '';
$exclude_replies = isset($_GET['exclude_replies']) ? $_GET['exclude_replies'] : '';

// DO NOT EDIT BELOW THIS LINE
switch($_GET['url'])
{
	case 'timeline':
	$rest = 'statuses/user_timeline' ;
	$params = Array('count' => $count, 'include_rts' => $include_rts, 'exclude_replies' => $exclude_replies, 'screen_name' => $_GET['screen_name'], 'tweet_mode' => 'extended');
	break;
	case 'search':
	$rest = "search/tweets";
	$params = Array('q' => $_GET['q'], 'count' => $count, 'include_rts' => $include_rts, 'tweet_mode' => 'extended');
	break;
	case 'list':
	$rest = "lists/statuses";
	$params = Array('list_id' => $_GET['list_id'], 'count' => $count, 'include_rts' => $include_rts, 'tweet_mode' => 'extended');
	break;
	default:
	$rest = 'statuses/user_timeline' ;
	$params = Array('count' => '20');
	break;
}

$auth = new TwitterOAuth($consumer_key,$consumer_secret,$oauth_access_token,$oauth_access_token_secret);
$get = $auth->get( $rest, $params );

if( ! $get ) {
	echo 'An error occurs while reading the feed, please check your connection or settings';
}
		
if( isset( $get->errors ) ) {
	foreach( $get->errors as $key => $val ) echo $val;
} else {
	echo $get;
}

?>