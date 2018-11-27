(function ( $ ) {
	"use strict";

	$(function () {

	});

	$(document).ready(function( $ ){
		$("span#social-term-help").click(function(e) {
			e.preventDefault();
			var SocialName = $(this).data('social');
			$("div.jetty_smm_"+SocialName+"_help").toggle("slow");
		});

		var const_screen_name = 'social_page_jetty_social_media_monitoring_setting';
		var const_tab_name = 'jetty_smm_terms_network';
		var arr_empty = [];

		function checkNetworkAPI(){
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

			function hideTermsBox(tag_id){
				$(tag_id).hide();
			}

			// Twitter
			if(isEmpty(all_settings.value_twitter_consumer_key) || 
				isEmpty(all_settings.value_twitter_consumer_secret) || 
				isEmpty(all_settings.value_twitter_oauth_access_token) || 
				isEmpty(all_settings.value_twitter_oauth_access_token_secret)){

					hideTermsBox('#twit_setting');
					arr_empty.push('twitter_empty');
			}

			// Facebook
			if(isEmpty(all_settings.value_fb_app_id) || 
				isEmpty(all_settings.value_fb_app_secret)){

					hideTermsBox('#fb_setting');
					arr_empty.push('fb_empty');

			}

			// Instagram
			if(isEmpty(all_settings.value_ig_access_token) || 
				isEmpty(all_settings.value_ig_client_id)){

					hideTermsBox('#ig_setting');
					arr_empty.push('ig_empty');
				
			}

			// Youtube
			if(isEmpty(all_settings.value_youtube_api_key)){

					hideTermsBox('#yt_setting');
					arr_empty.push('ytb_empty');
			}

			// Disable button save if all API network is empty
			if(checkProperties(all_settings) === true || arr_empty.length === 4){
				$('#save_jetty_smm_settings').prop('disabled', true);
			}
		}



		var get_tab_active 		= $('h2.nav-tab-wrapper').find('.nav-tab.nav-tab-active');
		var get_search_text 	= get_tab_active[0].search;
		var split_text_search 	= get_search_text.split('=');

		if(split_text_search[split_text_search.length - 1] === const_tab_name && currentScreenId === const_screen_name){
			checkNetworkAPI();
		}
	});

}(jQuery));