<?php
if ( current_user_can( 'read_inquiries' )) :
?>
<div class="wrap">		

<div class="dashboard-charts" style="display: block;">
	
	<div id="dashboard-chart-1" class="dashboard-chart">
		<div><canvas id="Chart1" width="400" height="400"></canvas></div>
		<h3 class="dashboard-chart-label">Inquiries by Status</h3>
	</div>
	
	<div id="dashboard-chart-2" class="dashboard-chart">
		<div><canvas id="Chart2" width="400" height="400"></canvas></div>
		<h3 class="dashboard-chart-label">Inquiries by Category</h3>
	</div>

	<div id="dashboard-chart-3" class="dashboard-chart">
		<div><canvas id="Chart3" width="400" height="400"></canvas></div>
		<h3 class="dashboard-chart-label">Inquiries by Source</h3>
	</div>
	
	<div id="dashboard-chart-4" class="dashboard-chart">
		<div><canvas id="Chart4" width="400" height="400"></canvas></div>
		<h3 class="dashboard-chart-label">Posts by Category</h3>
	</div>
</div>

<form name="my_form" method="post">  
	<input type="hidden" name="action" value="some-action">
	<?php 
	wp_nonce_field( 'some-action-nonce' );
	wp_nonce_field( 'meta-box-order', 'meta-box-order-nonce', false );
	wp_nonce_field( 'closedpostboxes', 'closedpostboxesnonce', false );
	?>

	<div id="poststuff" class="post_stuf_dashboard_second">

		 <div id="post-body" class="metabox-holder columns-<?php echo 1 == get_current_screen()->get_columns() ? '1' : '2'; ?>"> 

			  <div id="post-body-content">
				
			  </div>
	
			  <div id="postbox-container-one" class="dashboard_second_one">
			        <?php do_meta_boxes('','normal',null); ?>
			  </div>    

			  <div id="postbox-container-two" class="dashboard_second_two">
			        <?php do_meta_boxes('','side',null);  ?>
			  </div>	     					
		 </div> <!-- #post-body -->
	
	 </div> <!-- #poststuff -->
</form>	
</div>

<script>
jQuery(document).ready(function( $ ){
	
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
	
});
</script>

<?php
else:
?>
	<div class="wrap">
		<h1>Your account does not have sufficient permissions to view this page.</h1>
		<p>If you feel this is an error please contact a site administrator to edit your account permissions.</p>
	</div>
<?php 
endif;
?>