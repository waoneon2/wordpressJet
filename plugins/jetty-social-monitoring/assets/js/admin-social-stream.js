(function ( $ ) {
	"use strict";

	$(function () {

	});

	$(document).ready(function( $ ){

		var wallContent = {};
		var dataArr = [];
		var all_empty = true;

		function checkProperties(obj) {
		    for (var key in obj) {
		        if (obj[key] !== null && obj[key] != "")
		            return false;
		    }
		    return true;
		}

		function isEmpty(str) {
		    return (!str || 0 === str.length || true === (/^\s*$/).test(str));
		}

		if(!isEmpty(all_setting.value_textarea_feeds)){
			dataArr['rss'] = {
				id: all_setting.value_textarea_feeds,
				url: url_social_stream_obj.rss,
			};
			all_empty = false;
		}

		if(!isEmpty(all_setting.value_ig_access_token) && !isEmpty(all_setting.value_ig_client_id) && !isEmpty(all_setting.value_ig_user_id)){
			dataArr['instagram'] = {
				id: all_setting.value_ig_user_id,
				accessToken: all_setting.value_ig_access_token,
				clientId: all_setting.value_ig_client_id,
			};
			all_empty = false;
		}

		if(!isEmpty(all_setting.value_youtube_id) && !isEmpty(all_setting.value_youtube_api_key)){
			dataArr['youtube'] = {
				id: all_setting.value_youtube_id,
				api_key: all_setting.value_youtube_api_key
			};
			all_empty = false;
		}

		if(!isEmpty(all_setting.value_fb_gallery_id) && !isEmpty(all_setting.value_fb_app_id) && !isEmpty(all_setting.value_fb_app_secret)){
			dataArr['facebook'] = {
				id: all_setting.value_fb_gallery_id,
				url: url_social_stream_obj.facebook
			};
			all_empty = false;
		}

		if(!isEmpty(all_setting.value_twitter_username) && !isEmpty(all_setting.value_twitter_consumer_key) && 
				!isEmpty(all_setting.value_twitter_consumer_secret) && 
				!isEmpty(all_setting.value_twitter_oauth_access_token) && 
				!isEmpty(all_setting.value_twitter_oauth_access_token_secret)){
			dataArr['twitter'] = {
				id: all_setting.value_twitter_username,
				url: url_social_stream_obj.twitter,
				images: 'medium'
			};
			all_empty = false;
		}

		var optionsData = $.extend({}, dataArr);

		wallContent.feeds = optionsData;
		wallContent.rotate = {
			delay : 0
		};

		wallContent.wall = true;
		wallContent.control = false;
		wallContent.center = true;
		wallContent.max = 'limit';
		wallContent.limit = 30;
		wallContent.days = 30;
		wallContent.order = 'date';

		function run_wall_social_streamin(){
			$('#jetty-smm-social-stream').dcSocialStream(wallContent);
		}


		if(checkProperties(all_setting) === true || all_empty === true){
			$('div.jetty_smm_monitoring_main').remove();
			$('.if_no_content_streaming').show();
		} else {
			run_wall_social_streamin();
		}	


		// Search live
			var qsRegex;
			var $content = $('.stream');
			var filters = {};

			var $quicksearch = $('.quicksearch').keyup( debounce( function() {
				if($quicksearch.val() !== ''){
					$('div.dcsns-toolbar').hide();
				} else {
					$('div.dcsns-toolbar').show();
				}
			  qsRegex = new RegExp( $quicksearch.val(), 'gi' );
			  $content.isotope({ filter: function(){
			  	return qsRegex ? $(this).text().match( qsRegex ) : true;
			  }});
			}, 200 ) );

			function debounce( fn, threshold ) {
			  var timeout;
			  return function debounced() {
			    if ( timeout ) {
			      clearTimeout( timeout );
			    }
			    function delayed() {
			      fn();
			      timeout = null;
			    }
			    timeout = setTimeout( delayed, threshold || 100 );
			  }
			}
		// End Search live

	});

}(jQuery));