<?php
global $state_abbreviations_reverse;
$state_abbreviations_reverse = array('AL' => 'Alabama', 'AK' => 'Alaska', 'AS' => 'American Samoa', 'AZ' => 'Arizona', 'AR' => 'Arkansas', 'CA' => 'California', 'CO' => 'Colorado', 'CT' => 'Connecticut', 'DE' => 'Delaware', 'DC' => 'District Of Columbia', 'FM' => 'Federated States Of Micronesia', 'FL' => 'Florida', 'GA' => 'Georgia', 'GU' => 'Guam Gu', 'HI' => 'Hawaii', 'ID' => 'Idaho', 'IL' => 'Illinois', 'IN' => 'Indiana', 'IA' => 'Iowa', 'KS' => 'Kansas', 'KY' => 'Kentucky', 'LA' => 'Louisiana', 'ME' => 'Maine', 'MH' => 'Marshall Islands', 'MD' => 'Maryland', 'MA' => 'Massachusetts', 'MI' => 'Michigan', 'MN' => 'Minnesota', 'MS' => 'Mississippi', 'MO' => 'Missouri', 'MT' => 'Montana', 'NE' => 'Nebraska', 'NV' => 'Nevada', 'NH' => 'New Hampshire', 'NJ' => 'New Jersey', 'NM' => 'New Mexico', 'NY' => 'New York', 'NC' => 'North Carolina', 'ND' => 'North Dakota', 'MP' => 'Northern Mariana Islands', 'OH' => 'Ohio', 'OK' => 'Oklahoma', 'OR' => 'Oregon', 'PW' => 'Palau', 'PA' => 'Pennsylvania', 'PR' => 'Puerto Rico', 'RI' => 'Rhode Island', 'SC' => 'South Carolina', 'SD' => 'South Dakota', 'TN' => 'Tennessee', 'TX' => 'Texas', 'UT' => 'Utah', 'VT' => 'Vermont', 'VI' => 'Virgin Islands', 'VA' => 'Virginia', 'WA' => 'Washington', 'WV' => 'West Virginia', 'WI' => 'Wisconsin', 'WY' => 'Wyoming');
?>

<div class="wrapper clearfix">
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

            <form method="get" action="<?php echo home_url('/spotlight/'); ?>" id="form-find-your-school">
                <h3>Advanced Search</h3>
                <div class="entry-content">
                <?php while ( have_posts() ) : the_post(); ?>
                <?php the_content(); ?>
                <?php endwhile; ?>
				</div>
                
                <script type="text/javascript">
					jQuery(document).ready(function() {
						jQuery('#y').val('');
						jQuery('#speech_code').val('');
						jQuery('#institution_type').val('');
					});
				</script>
                
                <div class="row clearfix">
                    <input type="hidden" id="y" name="y" value="" />
                    <input type="hidden" id="speech_code" name="speech_code" value="" />
                    <input type="hidden" id="institution_type" name="institution_type" value="" />
                    <input type="hidden" name="type" value="advanced" />
                </div>
                <div class="row clearfix" style="margin: 0 0 10px 0;">
                    <div class="selector" data-field-name="institution_type">
                        <strong class="selected both-selected">Select Institution type</strong>
                        <ul class="scroll">
														<li></li>
                            <li class="public">Public</li>
                            <li class="private">Private</li>
                            <li class="both"></li>
                        </ul>
                    </div>
                </div>

                <script>

                    jQuery(document).ready(function() {
                        jQuery('.both').on('click', function() {
                            jQuery('.both-selected').addClass('both');
                        });
                        jQuery('.private, .public').on('click', function() {
                            jQuery('.both-selected').removeClass('both');
                        });
                    });

                </script>

                <div class="row clearfix" style="margin: 0 0 10px 0;">
                    <div class="selector" data-field-name="speech_code">
                        <strong class="selected">Select Speech Code Rating</strong>
                        <ul class="scroll">
														<li></li>
                            <li>Not yet rated</li>
                            <li>Exempt</li>
                            <li>Green</li>
                            <li>Yellow</li>
                            <li>Red</li>
                        </ul>
                    </div>
                </div>
                <div class="row clearfix" style="margin: 0 0 10px 0;">
                    <div class="selector" data-field-name="state">
                        <strong class="selected">Select a State</strong>
                        <ul class="scroll">
													<li></li>
                            <?php
                            
                                foreach($state_abbreviations_reverse as $stateShort=>$stateName) {
                                    echo "<li>". $stateShort ."</li>";	
                                }
                                
                            ?>
                        </ul>
                    </div>
                </div>
                <h3 style="font-size:18px;">Search by Statement Type</h3>
                <?php
                    $statements = array(
                        "806" => "Advertised Commitments to Free Expression",
                        "805" => "Policies on Tolerance, Respect and Civility",
                        "804" => "Harassment Policies",
                        "809" => "Policies Restricting Freedom of Conscience",
                        "806" => "Other Speech Codes",
                        "849" => "Bullying Policies",
                        "810" => "Protest and Demonstration Policies",
                        "812" => "Posting Policies",
                        "811" => "Internet Usage Policies",
                        "843" => "Policies on Bias and Hate Speech"
                    );
                    
                    foreach($statements as $statementID => $statement) {
                        echo '<div class="formItem" style="width:100%;float:left;margin: 0 0 3px 0;"><input type="checkbox" name="statement[]" value="'. $statementID .'"> '. $statement .'</div>';
                    }
                ?>
				<div class="row clearfix" style="margin: 20px 0 0 0;float:left;">
                <input type="submit" name="submit" value="Search" style="padding: 10px; background: #004f9a; color: #fff; font-size: 15px; border: none; border-radius: 5px;"/>
                </div>
            </form>

		</div><!-- #content -->
	</div><!-- #primary -->
    
	<?php get_sidebar(); ?>
    <div class="support clearfix">
        <p>Help FIRE protect the speech rights of students and faculty.</p>
        <a href="<?php echo home_url( '/donate' ); ?>">Support FIRE</a>
    </div>
</div>