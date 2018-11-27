(function ( $ ) {
	"use strict";

	$(function () {
		
	});

	jQuery.fn.extend({
		jettyPrintElement: function() {
			var cloned = this.clone();
		    var printSection = $('#printSection');
		    if (printSection.length == 0) {
		    	printSection = $('<div id="printSection"></div>')
		    	$('body').append(printSection);
		    }
		    printSection.append(cloned);
		    var toggleBody = $('body *:visible');
		    toggleBody.hide();
		    $('#printSection').css({
		    	'position' : 'relative',
		    	'margin' : '0 auto',
		    	'width' : '100%',
		    });
		    $('#printSection, #printSection *').show();
		    window.print();
		    printSection.remove();
		    toggleBody.show();
		}
	});

	function set_up_print(id_tag){
		// Print Area
		$('a#print_board_modal').click(function(e){
			e.preventDefault();
			var contents = $(id_tag).find('.container-content');
			contents.jettyPrintElement();
		});
	}

	$(document).ready(function( $ ){
		var bol_get_id_tag = $('#dashboard-widgets-wrap').length;
		var bol_widget_class_tag = $('.post_stuf_dashboard_second').length;
		var main_id_tag = $('.dashboard-status-boards').length;
		if(bol_get_id_tag !== 0 || main_id_tag !== 0 || bol_widget_class_tag !== 0){
			$('td.dashboard-status-boards-post-column .row-title.clickable').click(function(e){
				e.preventDefault();
				var data_id_status_board = $(this).data('status-board-lightbox');
				var original = $('#status-board-modal')[0];
				var clone = $(original).clone().attr('id', 'status-board-modal-'+data_id_status_board);
				var find_title = $(clone).find('.on_title');
				var find_content = $(clone).find('.on_content');
				var find_control = $(clone).find('.on_control');

				$.ajax({
					url : jetty_ui_ajax_status_board.ajax_url,
					type : 'post',
					data : {
						action : 'get_content_status_board',
						post_id : data_id_status_board
					},
					success : function( response ) {
						var response_parse = JSON.parse(response);
						find_title.html(response_parse['title']);
						find_content.html(response_parse['content']);
						find_control.html('<a href="'+response_parse['edit_link']+'">Edit</a> | <a href="#" id="print_board_modal">Print</a>');

						$(clone).dialog({
						    title: 'Boards',
						    dialogClass: 'wp-dialog on-status-bar-class',
						    autoOpen: false,
						    draggable: false,
						    width: '500px',
						    modal: true,
						    resizable: false,
						    closeOnEscape: true,
						    position: {
						      my: "center",
						      at: "center",
						      of: window
						    },
						    open: function () {
						      $('.ui-widget-overlay').bind('click', function(){
						        $('#status-board-modal-'+data_id_status_board).dialog('close');
						      });
						      var idTag = '#status-board-modal-'+data_id_status_board;

						      set_up_print(idTag);
						    },
						    close: function(){
						        $(clone).remove();
						    },
						    create: function () {
						      $('.ui-dialog-titlebar-close').addClass('ui-button');
						    },
					  	});

						$('#status-board-modal-'+data_id_status_board).dialog('open');
					}
				});
			});
		}
	});

}(jQuery));