<?php

/**
 * Twitter Hook - Inquiry Response
 * 
 * @param $inqID id of inquiry post.
 * @param string $status replay status.
 *
 * @return twitter json response
 *
 */ 

function jsm_twitter_inquiry_response($inqID, $status ) {
    return apply_filters( 'jsm_twitter_inquiry_responses', $inqID, $status );
}

add_filter( 'jsm_twitter_inquiry_responses', 'jsm_twitter_inquiry_response_filter', 10, 2 );
function jsm_twitter_inquiry_response_filter($inqID, $status) {

	$post 		= get_post($inqID);
	$twID 		= jsm_twitter_get_tweet_id($post->post_content);
	$twUsername = '@'.get_post_meta( $post->ID , 'inquiry_username', true);
	$source 	= get_post_meta( $post->ID , 'inquiry_source', true);
	
	if ($twID) {
		$rest 	= 'statuses/update';
		$params = Array('Name' => $post->post_name, 'status' => $twUsername.' '.$status, 'in_reply_to_status_id' => $twID);

		extract(jsm_twitter_key());
		$auth 	= new TwitterOAuth($consumer_key,$consumer_secret,$oauth_access_token,$oauth_access_token_secret);
		$get 	= $auth->post( $rest, $params );

		if( isset( $get->errors ) ) {
			return $get->errors;
		} else {
			return $get;
		}

	} else {
		return FALSE;
	}
}

function jsm_twitter_get_tweet_id($content, $type = 'id') {

	preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $content, $match);
	
	$find = FALSE;
	switch ($type) {
		case 'username':
			foreach ($match[0] as $key => $url) {
				$parse_url = parse_url($url);
				if ($parse_url['host'] == 'www.twitter.com') {
					$find = $parse_url['path'];
					break;
				}	
			}
			if ($find) {
				$return = str_replace('/', '@', $parse_url['path']);
			} else {
				$return = FALSE;
			}
		break;
		
		default:
			foreach ($match[0] as $key => $url) {
			    if (strpos($url, 'favorite?tweet_id') !== FALSE) { 
			        $find = $match[0][$key];
			    }
			}
			if ($find) {
			    parse_str($find, $tweet_id_array);
			    foreach ($tweet_id_array as $tweet_id_val) {
			       $return = $tweet_id_val;
			       break;
			    }
			} else {
			    $return = FALSE;
			}
		break;
	}

	return $return;
}

function jsm_twitter_key() {
    return array(
    	'consumer_key' => get_option('twitter_consumer_key', ''),
    	'consumer_secret' => get_option('twitter_consumer_secret', ''),
    	'oauth_access_token' => get_option('twitter_oauth_access_token', ''),
    	'oauth_access_token_secret' => get_option('twitter_oauth_access_token_secret', '')
    );
}