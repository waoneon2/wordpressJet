(function ( $ ) {
	"use strict";

	$(function () {

	});

	function FirstWidget(){
		Array.prototype.getarrlast = function() {return this[this.length-1];}
		var kop = 'id=1&id=2&id=3&id=4';
		if($('#top_widget_sort_value').length !== 0){
			kop = $('#top_widget_sort_value').val();
		}

		var splitAnd 	= kop.split('&');
		var idArr 		= [];
		for(var i=0;i<splitAnd.length;i++){
			var po = splitAnd[i].split('=');
			idArr.push(po[po.length - 1]);
		}
		var lastId = idArr.getarrlast();

		$('.dashboard-chart#dashboard-chart-'+lastId).css({
        	"border-right" : "none",
        	"margin-right" : "0"
        });
		var contentAreaTop = $( ".dashboard-charts div.dashboard-chart" );

		for (var i = 0; i < idArr.length; i++) {
			$(".dashboard-charts").append(contentAreaTop[idArr[i]-1]);
		}

		$( ".dashboard-charts" ).sortable({
			containment: "parent",
			axis: "x",
			update: function (event, ui) {
		        var dataSort 	= $(this).sortable('serialize', { key: "id" });
		        var dataSortArr = $(this).sortable('toArray');
		        for (var i = 0; i < dataSortArr.length; i++) {
		        	if(i === dataSortArr.length-1){
		        		$('.dashboard-chart#'+dataSortArr[i]).css({
				        	"border-right" : "none",
				        	"margin-right" : "0"
				        });	
		        	} else {
		        		$('.dashboard-chart#'+dataSortArr[i]).css({
				        	"border-right" : "1px solid #D6D6D6",
				        	"margin-right" : "-1px"
				        });	
		        	}
		        }

				$.ajax({
					url : jetty_ui_sortable_widget_chart.chart_ajax_url,
					type: 'post',
					data: {
						action : 'save_event_top_widget_sortable',
						datasort : dataSort
					},
					success : function( response ) {
						
					}
				});
			},
			activate: function( event, ui ) {

			}
		});
	}

	function SecondWidget(){
		var kop = 'id=1&id=2';
		if($('#bottom_widget_sort_value').length !== 0){
			kop = $('#bottom_widget_sort_value').val();
		}

		var splitAnd 	= kop.split('&');
		var idArr 		= [];
		for(var i=0;i<splitAnd.length;i++){
			var po = splitAnd[i].split('=');
			idArr.push(po[po.length - 1]);
		}

		for (var j = 0; j < idArr.length; j++) {
			if(j === idArr.length-1){
				$('div#dashboard-ca-'+idArr[j]).css({
		        	"margin-right": "0",
		        });
			} else {
				$('div#dashboard-ca-'+idArr[j]).css({
		        	"margin-right": "2%",
		        });	
			}
		}

		var contentAreaTop = $( ".content-area .dashboard-second" );

		for (var i = 0; i < idArr.length; i++) {
			$(".content-area").append(contentAreaTop[idArr[i]-1]);
		}

		$( ".content-area" ).sortable({
			containment: "parent",
			axis: "x",
			update: function (event, ui) {
		        var dataSort 	= $(this).sortable('serialize', { key: "id" });
		        var dataSortArr = $(this).sortable('toArray');

		        for (var i = 0; i < dataSortArr.length; i++) {
		        	if(i === dataSortArr.length-1){
		        		$('#'+dataSortArr[i]).css({
				        	"margin-right": "0",
				        });	
		        	} else {
		        		$('#'+dataSortArr[i]).css({
				        	"margin-right": "2%",
				        });	
		        	}
		        }

		        $.ajax({
					url : jetty_ui_sortable_widget_chart.chart_ajax_url,
					type: 'post',
					data: {
						action : 'save_event_bottom_widget_sortable',
						datasortsecond : dataSort
					},
					success : function( response ) {
						console.log(response);
					}
				});
			}
		});
	}

	function MakeLabel(nameLabel, value, textLabel, checked = true){
		var html = '';
		html += '<label for="'+nameLabel+'">';
		if(checked){
			html += '<input class="hide-postbox-toggle" name="'+nameLabel+'" type="checkbox" id="'+nameLabel+'" value="'+value+'" checked="checked">';
		} else {
			html += '<input class="hide-postbox-toggle" name="'+nameLabel+'" type="checkbox" id="'+nameLabel+'" value="'+value+'">';
		}
			
			html += textLabel;
		html += '</label>';

		return html;
	}

	function CustomInputCheckHandle(){
		var getCb = $('#custom_c_v_div').text();
		if(getCb !== ''){
			var sera = JSON.parse(getCb);
	    	for (var i = 0; i < sera.length; i++) {
	    		if(sera[i].checked !== undefined){
	    			$("#"+sera[i].name).prop('checked', false);
	    			$('div#'+sera[i].value).hide();
	    		}
	    	}
		}
		

		var get_value = '';
		$('.hide-postbox-toggle').change(function(){
			var ser = $('.hide-postbox-toggle').serializeArray();
			ser = ser.concat(
	            $('.hide-postbox-toggle:not(:checked)').map(
	                function() {
	                    return {"name": this.name, "value": this.value, "checked": this.checked}
	                }).get()
	    	);

			$.ajax({
				url : jetty_ui_sortable_widget_chart.chart_ajax_url,
				type: 'post',
				data: {
					action : 'save_event_handler_custom_checked',
					datachecked : ser
				},
				success : function( response ) {
					
				}
			});

			if(this.checked){
				get_value = $(this).val();
				$('div#'+get_value).show();
			} else {
				get_value = $(this).val();
				$('div#'+get_value).hide();
			}
		});
	}

	$(document).ready(function( $ ){
		FirstWidget();
		SecondWidget();
		$('fieldset.metabox-prefs').append(MakeLabel('i_b_c','dashboard-chart-2','Inquiries by Category'));
		$('fieldset.metabox-prefs').append(MakeLabel('i_b_s','dashboard-chart-1','Inquiries by Status'));
		$('fieldset.metabox-prefs').append(MakeLabel('i_b_so','dashboard-chart-3','Inquiries by Source'));
		$('fieldset.metabox-prefs').append(MakeLabel('p_b_c','dashboard-chart-4','Posts by Category'));

		CustomInputCheckHandle();
	});

}(jQuery));