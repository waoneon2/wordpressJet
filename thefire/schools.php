<?php 

	require "../../../wp-load.php";

	// Check if user is logged in and can manage options

	if (!is_user_logged_in() && !current_user_can( 'manage_options' ) ) { 
		die( 'access denied' );
	}
	
	// Deliver CSV file
	
	header( 'Content-Type: text/csv' );
	header( 'Content-Disposition: attachment; filename=schools.csv' );
    header( 'Pragma: no-cache' );

	// Check if Discard Drafts or Exclude Fire-Only Cases is checked.

	$discard_drafts = (isset($_POST['discard_drafts']) == 'Discard Drafts') ? 'publish' : array('publish', 'draft');
	$exclude_category = (isset($_POST['exclude_category']) == 'Exclude Fire-Only Cases') ? array(858) : array();

	$query_school_args = array(
	    'post_type' => 'fire_schools',
	    'category__not_in' => $exclude_category,
	    'post_status' => $discard_drafts, 
	    'posts_per_page' => -1,
	    'order' => 'ASC',
	    'orderby'=> 'title',
	);

	$query_schools = new WP_Query( $query_school_args );

	// Build Schools Array
	global $wpdb;
	$schools = array();
	foreach($query_schools->posts as $school) {		
		
		$query_id = $school->ID;
		$result = $wpdb->get_results( 'SELECT p2p_to FROM wp_p2p WHERE p2p_from = ' . $query_id . ' AND p2p_type = "school_cases"' );
		if(count($result) > 0){
			foreach($result as $r){
				$post = get_post($r->p2p_to);
				$cc_list[] = $post->post_title;
			}
		} else {
			$cc_list = array();
		}


		$schools[] = array(
			'ID' => $school->ID,
			'Title' => $school->post_title,
			'State' => $school->state,
			'Rating' => $school->school_speech_code_rating,
			'Federal Circuit' => $school->federal_circuit,
			'Institution Type' => $school->institution_type,
			'Connect Cases' => implode('; ', $cc_list)
			);
	}

	// echo '<pre>';
	// print_r( $schools[0]->ID );
	// echo '</pre>';				
                
	$output = fopen('php://output', 'w'); // Set output for CSV

	fputcsv( $output, array('ID', 'School Name', 'State', 'Rating', 'Federal Circuit', 'Institution Type', 'Connected Cases') );  // Set column headers

	foreach( $schools as $school ) {
		fputcsv( $output, $school );
	}

	// close output

	fclose($output);