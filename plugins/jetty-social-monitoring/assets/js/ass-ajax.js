(function ( $ ) {
	"use strict";

	$(function () {
	});


	$(document).ready(function( $ ){
		function jsReqAjax(){
			$('button.btn_on_inquiry').click(function(e){
				e.preventDefault();
				var postTitle 	= '';
				var sourcePost 	= '';
				var sourceTitle = '';
				var postContent = '';
				var sourceUser 	= '';
				var userGet		= '';
				var userFor		= '';

				var updateText 		= $(this).find('.text_inquiry');
				var parentElement 	= $(this).parent().parent();
				var findTarget 		= $(parentElement).find('.inner');
				var text 			= $(findTarget).find('.section-text');
				var title 			= $(findTarget).find('.section-title');

				if(title.length !== 0){
					postTitle = $(title).text();
				} else {
					postTitle = $(text).text();
				}

				postContent = $(findTarget).html();

				sourcePost = parentElement.attr('class');

				if(sourcePost.match(/twitter/gi) !== null){
					sourceTitle 	= 'twitter';
					userGet 		= $(text).find('.twitter-user');
					sourceUser 		= $(userGet).find('a');
					var pathnameUrl = $(sourceUser).attr('href');
					pathnameUrl 	= pathnameUrl.split('/').pop();
					userFor 		= pathnameUrl.toLowerCase();
					userFor 		= userFor.replace(/\s/g,'');
				}

				if(sourcePost.match(/facebook/gi) !== null){
					sourceTitle 	= 'facebook';
					userGet 		= $(findTarget).find('.section-user');
					sourceUser 		= $(userGet).find('.link-user');
					userFor 		= $(sourceUser).text();
					userFor 		= userFor.toLowerCase();
					userFor 		= userFor.replace(/\s/g,'');
				}

				if(sourcePost.match(/youtube/gi) !== null){
					sourceTitle 	= 'other';
					userGet 		= $(findTarget).find('.section-user');
					sourceUser 		= $(userGet).find('.link-user');
					userFor 		= $(sourceUser).text();
					userFor 		= userFor.toLowerCase();
					userFor 		= userFor.replace(/\s/g,'');
				}

				if(sourcePost.match(/rss/gi) !== null){
					sourceTitle 	= 'rss';
					userGet 		= $(findTarget).find('.section-user');
					sourceUser 		= $(userGet).find('.link-user');
					var pathnameUrl = $(sourceUser).attr('href');
					pathnameUrl 	= pathnameUrl.split('/').pop();
					userFor 		= pathnameUrl.toLowerCase();
					userFor 		= userFor.replace(/\s/g,'');
				}

				if(sourcePost.match(/instagram/gi) !== null){
					sourceTitle 	= 'instagram';
					userGet 		= $(findTarget).find('.section-user');
					sourceUser 		= $(userGet).find('.link-user');
					userFor 		= $(sourceUser).text();
					userFor 		= userFor.toLowerCase();
					userFor 		= userFor.replace(/\s/g,'');
				}

				$.ajax({
					url : ass_ajax_action.ajax_url,
					type : 'post',
					data : {
						action : 'HandleAjaxRequest',
						post_content : postContent,
						post_title : postTitle,
						source_title : sourceTitle,
						username : userFor
					},
					beforeSend : function(){
						$(updateText).html('Creating Inquiry'+'<img class="img-ajax-loading" src="'+imgurl+'">');
					},
					success : function( response ) {
						setTimeout(function(){
							$(updateText).text('Inquiry Created');
						}, 4000);
					}
				});
			});
		}

		setTimeout(function(){
			jsReqAjax();
		}, 4000);
	});
}(jQuery));