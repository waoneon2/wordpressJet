(function ( $ ) {
	"use strict";

	$(function () {

		$('.js-lightbox-inline').magnificPopup({
		  type:'inline',
		  midClick: true
		});

		$('.js-lightbox-img').magnificPopup({
			type: 'image',
			closeOnContentClick: true,
			closeBtnInside: false,
			fixedContentPos: true,
			mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
			image: {
				verticalFit: true
			},
			zoom: {
				enabled: true,
				duration: 300 // don't foget to change the duration also in CSS
			}
		});
	});

	$(document).ready(function( $ ){
		var bol_get_id_tag = $('#dashboard-widgets-wrap').length;
		if(bol_get_id_tag !== 0){
			// Inquiries by Status
			var data_1 = [
			    {
			        value: jettyUi_jettyMetrics.inquiries_by_status.open,
			        color:"#F7464A",
			        highlight: "#FF5A5E",
			        label: "Open"
			    },
			    {
			        value: jettyUi_jettyMetrics.inquiries_by_status.closed,
			        color: "#46BFBD",
			        highlight: "#5AD3D1",
			        label: "Closed"
			    },
			    {
			        value: jettyUi_jettyMetrics.inquiries_by_status.hold,
			        color: "#FDB45C",
			        highlight: "#FFC870",
			        label: "On Hold"
			    }
			];

			// Inquiries by Source
			var data_2 = {
			    labels: jettyUi_jettyMetrics.inquiries_by_source.labels,
			    datasets: [
			        {
			            label: "Inquiries by Source",
			            fillColor: "rgba(151,187,205,0.5)",
			            strokeColor: "rgba(151,187,205,0.8)",
			            highlightFill: "rgba(151,187,205,0.75)",
			            highlightStroke: "rgba(151,187,205,1)",
			            data: jettyUi_jettyMetrics.inquiries_by_source.data
			        }
			    ]
			};

			// Inquiries by category
			var data_3 = {
				labels: jettyUi_jettyMetrics.inquiries_by_cat.labels,
			    datasets: [
			        {
			            label: "Inquiries by Category",
			            fillColor: "rgba(151,187,205,0.5)",
			            strokeColor: "rgba(151,187,205,0.8)",
			            highlightFill: "rgba(151,187,205,0.75)",
			            highlightStroke: "rgba(151,187,205,1)",
						data: jettyUi_jettyMetrics.inquiries_by_cat.data
			        },
			    ]
			};

			// Posts by category
			var data_4 = {
				labels: jettyUi_jettyMetrics.posts_by_cat.labels,
			    datasets: [
			        {
			            label: "Posts by Category",
			            fillColor: "rgba(151,187,205,0.5)",
			            strokeColor: "rgba(151,187,205,0.8)",
			            highlightFill: "rgba(151,187,205,0.75)",
			            highlightStroke: "rgba(151,187,205,1)",
						data: jettyUi_jettyMetrics.posts_by_cat.data
			        },
			    ]
			};
			
			//Chart js
			var ctx1 = $("#Chart1").get(0).getContext("2d");
			var ctx2 = $("#Chart2").get(0).getContext("2d");
			var ctx3 = $("#Chart3").get(0).getContext("2d");
			var ctx4 = $("#Chart4").get(0).getContext("2d");
			
			var Chart1 = new Chart(ctx1).Pie(data_1);
			var Chart2 = new Chart(ctx2).Bar(data_3);
			var Chart3 = new Chart(ctx3).Bar(data_2);	
			var Chart4 = new Chart(ctx4).Bar(data_4);
		}
		
	});

}(jQuery));