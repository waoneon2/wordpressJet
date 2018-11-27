(function ( $ ) {
	"use strict";

	$(function () {

	});

	$(document).ready(function( $ ){
		var container = $('i#current-time-content');
		if(container.length !== 0){
			var i = 0,
			max = 60,
			dir = 0;

			function gotcha(){
				$.ajax({
					url : jetty_ui_timer.ajax_url,
					type : 'post',
					data : {
						action : 'dynamic_timer',
					},
					success : function( response ) {
						container.html("");
						container.html(response);
					}
				});
			}

			var timer = function() {
			    if (dir == 0) {
			        i++;
			    }

			    if (dir == 1) {
			        i--;
			    }

			    if(i == 0) {
			        dir = 0;
			        gotcha();
			    } else if(i == max) {
			        dir = 1;
			        gotcha();
			    }
			    setTimeout(timer, 1000);
			}
			timer();
		}
	});

}(jQuery));