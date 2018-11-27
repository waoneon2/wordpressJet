<?php

global $post_ID;
//$school_name = 'Washington State University';
global $state_abbreviations_reverse;
global $speech_codes;

$school_name = isset($_GET['x']) ? trim($_GET['x']) : '';
if($school_name == "Search by school name") {
	$school_name = '';
}
$search_state = isset($_GET['y']) ? trim($_GET['y']) : '';
$search_type = isset($_GET['z']) ? trim($_GET['z']) : '';
$speech_code = isset($_GET['speech_code']) ? trim($_GET['speech_code']) : '';
$institution_type = isset($_GET['institution_type']) ? trim($_GET['institution_type']) : '';
$statement = isset($_GET['statement']) ? $_GET['statement'] : '';

if (array_key_exists($search_state, $state_abbreviations_reverse) || array_key_exists($search_state, $state_abbreviations)) {
	$search_state = $state_abbreviations_reverse[$search_state];
}

if (array_key_exists($speech_code, $speech_codes)) {
	$speech_code = $speech_codes[$speech_code];
}
$types = array(
	'Cases' => 3,
	'Speech Codes' => 2,
	'Recent Media' => 0,
	'Commentary' => 4,
);
$type = ''; $cat_id = 0;
foreach ($types as $k => $v) {
	if (strtolower($k) === strtolower($search_type)) {
		$type = $k; $cat_id = $v;
		break;
	}
}

if (empty($type)) { $type = 'Speech Codes'; $cat_id = 2; }

//$schools = firecomps_get_school_data($school_name, $search_state, $speech_code, $institution_type, $statement );

$sql = 'SELECT SQL_CALC_FOUND_ROWS wp_posts.ID FROM wp_posts ';

$sql .= ' INNER JOIN wp_postmeta ON (wp_posts.ID = wp_postmeta.post_id) ';
if ($speech_code != '') {
$sql .= ' INNER JOIN wp_postmeta AS mt1 ON (wp_posts.ID = mt1.post_id) ';
}
if ($institution_type != '') {
$sql .= ' INNER JOIN wp_postmeta AS mt2 ON (wp_posts.ID = mt2.post_id)';
}

if (is_array($statement)) {
	
	$i = 1;
	foreach($statement as $catid) {
		$cat .= 'wp_terms.term_id="'.$catid.'"';
		if(count($statement) > $i) {
			$cat .= ' OR ';
		}
		$i++;
	}
	
	$sql .= '
	INNER JOIN wp_p2p ON wp_posts.ID = wp_p2p.p2p_to AND wp_p2p.p2p_type="statement_schools"
	INNER JOIN wp_term_relationships ON wp_p2p.p2p_from = wp_term_relationships.object_id 
	INNER JOIN wp_term_taxonomy ON wp_term_relationships.term_taxonomy_id=wp_term_taxonomy.term_taxonomy_id
	INNER JOIN wp_terms ON wp_terms.term_id=wp_term_taxonomy.term_id AND ('. $cat .')
	INNER JOIN wp_postmeta AS mt3 ON mt3.post_id=wp_term_relationships.object_id 
	';	
}
$sql .= '
WHERE 1=1 
AND wp_posts.post_type = "fire_schools" 
AND (wp_posts.post_status = "publish") 
';



if ($search_state != '' || $speech_code != '' || $institution_type != '') {
	$sql .= ' AND ( ';
}

	if ($search_state != '') {
		$sql .= ' (wp_postmeta.meta_key="state" AND CAST(wp_postmeta.meta_value AS CHAR)="'. $search_state .'") ';
		if ($speech_code != '' || $institution_type != '') {
			$sql .= ' AND ';
		}
	}
	
	if (is_array($statement) && $speech_code != '') {
		$sql .= ' (mt3.meta_key="speech_code_rating" AND CAST(mt3.meta_value AS CHAR)="'. $speech_code .'") ';
		if ($institution_type != '') {
			$sql .= ' AND ';
		}
	} else {
		/*
		if ($speech_code != '' && $speech_code != 'Not yet rated') {
			$sql .= ' (mt1.meta_key="school_speech_code_rating" AND CAST(mt1.meta_value AS CHAR)="'. $speech_code .'") ';
			if ($institution_type != '') {
				$sql .= ' AND ';
			}
		} else if ($speech_code == 'Not yet rated') {
			$sql .= ' (mt1.meta_key="school_speech_code_rating" AND CAST(mt1.meta_value AS CHAR)="0") ';
			if ($institution_type != '') {
				$sql .= ' AND ';
			}
		}
		*/
		if ($speech_code != '') {
			$sql .= ' (mt1.meta_key="school_speech_code_rating" AND CAST(mt1.meta_value AS CHAR)="'. $speech_code .'") ';
			if ($institution_type != '') {
				$sql .= ' AND ';
			}
		}
	}
	
	if ($institution_type != '') {
		$sql .= ' (mt2.meta_key="institution_type" AND CAST(mt2.meta_value AS CHAR)="'. $institution_type .'") ';
	}

if ($search_state != '' || $speech_code != '' || $institution_type != '') {
	$sql .= ' ) ';
}

if ($school_name != '') {
	$sql .= ' AND (wp_posts.post_title LIKE "%'. $school_name .'%" OR (';
	$sql .= ' (wp_postmeta.meta_key="nicknames" AND wp_postmeta.meta_value LIKE "'. $school_name .'") OR ';
	$sql .= ' (wp_postmeta.meta_key="nicknames" AND wp_postmeta.meta_value LIKE "'. $school_name .',%") OR ';
	$sql .= ' (wp_postmeta.meta_key="nicknames" AND wp_postmeta.meta_value LIKE "%,'. $school_name .'") OR ';
	$sql .= ' (wp_postmeta.meta_key="nicknames" AND wp_postmeta.meta_value LIKE "%,'. $school_name .',%") ';
	$sql .= '))';
}

$offset = (get_query_var('paged')-1)*20;
if($offset < 0) {
	$offset = 0;	
}
$sql .= ' GROUP BY wp_posts.ID ORDER BY wp_posts.post_title ASC LIMIT '. $offset .', 20';

//echo "<br><br>".$sql;

$schools = $wpdb->get_results($sql, 'OBJECT');
$sql_posts_total = $wpdb->get_var( "SELECT FOUND_ROWS();" );

foreach ( $schools as $school ) : setup_postdata( $school ); 
	$school_id = get_permalink($school->ID);
endforeach;

// echo '<pre>';
// print_r($schoolID); 
// echo '</pre>';
// die();

if($sql_posts_total == 1) {
	header("Location: " . $school_id);
	exit;
}

$max_num_pages = ceil($sql_posts_total / 20);

//echo "max_num_page".$max_num_pages;

if (count($schools) > 0 && $_GET):
?>
<script type="text/javascript">
<!--
function select(type) {
	var x = '<?php echo $school_name; ?>';
	var y = '<?php echo $search_state; ?>';
	var z = type;
	var speech_code = '<?php echo $speech_code; ?>';
	var url = window.location.pathname + '?x=test' + escape(x) + '&y=' + escape(y) + '&z=' + escape(z) + '&speech_code=' + escape(speech_code) + '#list';
	window.location.href = url;
}
-->
</script>
<div class="category-header" style="background-image: url('/wp-content/uploads/2014/01/default-banner.jpg');">
    <div class="wrapper clearfix">
        <h1 class="category-title">Search results</h1>
    </div>
</div>

<div class="category-header gradient">
    <div class="wrapper clearfix">
        <h1 class="category-title">Search results</h1>
    </div>
</div>
<div class="wrapper clearfix">
	<div id="primary" class="content-area">
        
        <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.infinitescroll.min.js"></script>
        <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/manual-trigger.js"></script>
        <script type="text/javascript">
        
            jQuery(document).ready(function() {
                jQuery('#content').infinitescroll({
                    navSelector  	: ".paging-navigation",
                    nextSelector 	: ".nav-next a",
                    itemSelector 	: ".school-info",	
                    behavior		: "twitter",
                    loading			: {
                        img: "<?php echo get_template_directory_uri(); ?>/images/loader.gif",
                        msgText: "<p style='font-size:12px;'>Loading the next set of posts...</p>",
						finishedMsg: "No more posts. <a href=#>Scroll to top</a>."
                    }
                });
            });
            
        </script>
    
		<div id="content" class="site-content" role="main">
        	<div class="site-breadcrumbs">
            	<?php 
				
				$speech_codes_reverse = array(5 => 'Exempt', 4 => 'Not yet rated', 3 => 'Green', 2 => 'Yellow', 1 => 'Red', 0 => 'Undefined', 'Not yet rated' => 'Undefined'); 
				
				if($school_name) {
					$breadcrumb[] = $school_name;
				}
				if($search_state) {
					$breadcrumb[] = $search_state;
				}
				if($speech_code) {
					$breadcrumb[] = $speech_codes_reverse[$speech_code];
				}
				if($institution_type) {
					$breadcrumb[] = $institution_type;
				}

				?>
            
        		<a href="<?php echo home_url('/'); ?>/spotlight/using-the-spotlight-database/">Spotlight Database</a> > Search Results > <?php echo implode(", ", $breadcrumb); ?>
            	<?php //if(function_exists('bcn_display')) bcn_display(); ?>
            </div>

						<a href="/spotlight" class="red-btn">New Search</a>
            
			<?php /*foreach($schools as $school): ?>
	            <section class="school-info code-<?php if ($school['speech_code']): echo sprintf(__('%s', 'firecomps'), $school['speech_code']); endif; ?>">
	            	<h1><?php echo $school['name']; ?></h1>
	                <ul class="no-style">
	                	<?php if ($school['location']): echo sprintf(__('<li>Location: %s</li>', 'firecomps'), $school['location']); endif; ?>
	                    <?php if ($school['website']): echo sprintf(__('<li>Website: <a href="%s">%s</a></li>', 'firecomps'), $school['website'], $school['website']); endif; ?>
	                    <?php if ($school['type']): echo sprintf(__('<li>Type: %s</li>', 'firecomps'), $school['type']); endif; ?>
	                    <?php if ($school['federal_circuit']): echo sprintf(__('<li>Federal Circuit: %s</li>', 'firecomps'), $school['federal_circuit']); endif; ?>
	                    <?php if ($school['speech_code']): echo sprintf(__('<li>Speech Code Rating: %s</li>', 'firecomps'), $school['speech_code']); endif; ?>
	               		<?php if ($school['the_url']): echo sprintf(__('%s', 'firecomps'), $school['the_url']); endif; ?>
	             
	                </ul>
	            </section>
			<?php endforeach;*/ ?> 
            
            <?php
			
			/*
			$meta_query = array();
			$meta_query['relation'] = 'AND';

			if ($search_state != '') {
				$meta_query[] = array(
					'key' => 'state',
					'value' => $search_state,
					'compare' => '='
				);
			}
			if ($speech_code != '' && $speech_code != 'Not yet rated') {
				$meta_query[] = array(
					'key' => 'school_speech_code_rating',
					'value' => $speech_code,
					'compare' => '='
				);
			}
			if ($speech_code == 'Not yet rated') {
				$meta_query[] = array(
					'key' => 'school_speech_code_rating',
					'value' => '0',
					'compare' => '='
				);
			}
			
			if ($institution_type != '') {
				$meta_query[] = array(
					'key' => 'institution_type',
					'value' => $institution_type,
					'compare' => '='
				);
			}
			

			if (is_array($statement)) {
				$meta_query[] = array(
					'key' => 'institution_type',
					'value' => $statement,
					'compare' => '='
				);
			}


			$args = array(
				'school_name' => $school_name,
				'post_type' => 'fire_schools',
				'post_status' => 'publish',
				'posts_per_page' => 10,
				'orderby' => 'title',
				'order' => 'ASC',		
				'paged' => (get_query_var('paged')) ? get_query_var('paged') : 1,
				'meta_query' => $meta_query
			);

			
			//print_r($meta_query);
			
			query_posts($args);
			
			echo $GLOBALS['wp_query']->request;
			*/

			//echo "<br><br>". $sql;
			
			// $schools = $wpdb->get_results($sql, 'OBJECT');
			
			if ( $schools ) : 
				foreach ( $schools as $school ) : setup_postdata( $school ); 

					?>
                    
                    <section class="school-info code-<?php if(empty($speech_codes_reverse[get_field('school_speech_code_rating', $school->ID)]) || $speech_codes_reverse[get_field('school_speech_code_rating', $school->ID)] == "Not yet rated") { echo "Undefined"; } else { echo $speech_codes_reverse[get_field('school_speech_code_rating', $school->ID)];} ?>">
                        <h1><a href="<?php echo get_permalink($school->ID); ?>"><?php echo get_the_title($school->ID); ?></a></h1>
                        <ul class="no-style">
                            <?php if (get_field('city', $school->ID)) { ?><li>Location: <?php echo get_field('city', $school->ID) . ', ' . get_field('state', $school->ID); ?></li><?php } ?>	                    
                            <?php if (get_field('website_url', $school->ID)) { ?><li>Website: <a href="<?php echo get_field('website_url', $school->ID); ?>"><?php echo get_field('website_url', $school->ID); ?></a></li><?php } ?>
                            <?php if (get_field('institution_type', $school->ID)) { ?><li>Type: <?php echo get_field('institution_type', $school->ID); ?></li><?php } ?>                    	                    
                            <?php if (get_field('federal_circuit', $school->ID)) { ?><li>Federal Circuit: <?php echo get_field('federal_circuit', $school->ID); ?></li><?php } ?>	                    
                            <?php if ($speech_codes_reverse[get_field('school_speech_code_rating', $school->ID)]) { ?><li>Speech Code Rating: <?php echo $speech_codes_reverse[get_field('school_speech_code_rating', $school->ID)]; ?></li><?php } ?>	               		 
                            <?php if (get_permalink($school->ID)) { ?><a href="<?php echo get_permalink($school->ID); ?>">Read More </a><?php } ?>	             
                        </ul>
                    </section>

                <?php endforeach; ?>

            <?php endif; ?>
            
            <a name="list"></a>

		</div><!-- #content -->
        
        <nav class="navigation paging-navigation" role="navigation">
            <div class="nav-links">
                <div class="nav-next" style="float:left;"><?php next_posts_link('&darr; More Schools', $max_num_pages); ?></div>
            </div>
        </nav>
        
	</div><!-- #primary -->

	<?php get_sidebar(); ?>
	<div class="support clearfix">
    	<p>Help FIRE protect the speech rights of students and faculty.</p>
        <a href="<?php echo home_url( '/donate' ); ?>">Support FIRE</a>
    </div>
</div>

<?php else: ?>
	<?php

		if ($school_name != '' || $search_state != '' || $search_type != '' || $institution_type != '' || $statement != '') { ?>
			<div class="noresults"><p>Sorry, your search returned no results.</p></div>
	<?php 	}?>
	
	<?php 
	if($_GET['type'] == "advanced") {
		get_template_part( 'content', 'advancedsearch' ); 
	} else {
		get_template_part( 'content', 'search' ); 
	}
	?>
<?php endif; ?>
