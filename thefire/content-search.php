<?php
global $state_abbreviations_reverse;
$state_abbreviations_reverse = array('AL' => 'Alabama', 'AK' => 'Alaska', 'AS' => 'American Samoa', 'AZ' => 'Arizona', 'AR' => 'Arkansas', 'CA' => 'California', 'CO' => 'Colorado', 'CT' => 'Connecticut', 'DE' => 'Delaware', 'DC' => 'District Of Columbia', 'FM' => 'Federated States Of Micronesia', 'FL' => 'Florida', 'GA' => 'Georgia', 'GU' => 'Guam Gu', 'HI' => 'Hawaii', 'ID' => 'Idaho', 'IL' => 'Illinois', 'IN' => 'Indiana', 'IA' => 'Iowa', 'KS' => 'Kansas', 'KY' => 'Kentucky', 'LA' => 'Louisiana', 'ME' => 'Maine', 'MH' => 'Marshall Islands', 'MD' => 'Maryland', 'MA' => 'Massachusetts', 'MI' => 'Michigan', 'MN' => 'Minnesota', 'MS' => 'Mississippi', 'MO' => 'Missouri', 'MT' => 'Montana', 'NE' => 'Nebraska', 'NV' => 'Nevada', 'NH' => 'New Hampshire', 'NJ' => 'New Jersey', 'NM' => 'New Mexico', 'NY' => 'New York', 'NC' => 'North Carolina', 'ND' => 'North Dakota', 'MP' => 'Northern Mariana Islands', 'OH' => 'Ohio', 'OK' => 'Oklahoma', 'OR' => 'Oregon', 'PW' => 'Palau', 'PA' => 'Pennsylvania', 'PR' => 'Puerto Rico', 'RI' => 'Rhode Island', 'SC' => 'South Carolina', 'SD' => 'South Dakota', 'TN' => 'Tennessee', 'TX' => 'Texas', 'UT' => 'Utah', 'VT' => 'Vermont', 'VI' => 'Virgin Islands', 'VA' => 'Virginia', 'WA' => 'Washington', 'WV' => 'West Virginia', 'WI' => 'Wisconsin', 'WY' => 'Wyoming');
?>

<div id="slideout">
		<div class="nav-icon"><img src="http://d28htnjz2elwuj.cloudfront.net/wp-content/uploads/2015/03/menu_icon_tab.png" alt="Open Spotlight Resources" /></div>
		<div class="close-icon"><img src="http://d28htnjz2elwuj.cloudfront.net/wp-content/uploads/2015/03/Menu_Close.png" alt="close" /></div>
		<div id="slideout_inner">
			<div id="tertiary" class="sidebar-container" role="complementary">
		<div class="sidebar-inner">
			<div class="widget-area">
				<?php

				wp_nav_menu( array(
						'theme_location' => 'third',
						'menu_class' => 'nav-menu',
						'walker' => new description_walker() )
				);
				
				$url = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
				
				if ( $post->ID == 108767 || $post->ID == 109420 || $thetorch > 0 && strpos($url, "/author/") === false || strpos($url, "/torch/") !== false) {
					?>
                    <select name="archive-dropdown" class="archive-dropdown" onchange="document.location.href=this.options[this.selectedIndex].value;">
                      <option value=""><?php echo esc_attr( __( 'Select Month' ) ); ?></option> 
                      <?php wp_get_archives( array( 'type' => 'monthly', 'format' => 'option', 'show_post_count' => 1, 'cat' => 8 ) ); ?>
                    </select>
                    <?php
				}
				?>
            				</div><!-- .widget-area -->
		</div><!-- .sidebar-inner -->
	</div><!-- #tertiary -->

		</div>
	</div>

<div class="wrapper clearfix">

    <section id="page-find-your-school">
        <header style="margin:30px 0 0 0;">Find Your School</header>
        <div id="maps-for-finding-your-school" class="zoom-4"></div>
        
        <article class="post-20 page type-page status-publish hentry" id="post-20">
            <br /><span class="entry-header" style="text-align:center;width:100%;">Welcome to the Spotlight Speech Codes Database</span><br /><br /><br />
            <div class="entry-content">
                <p>An overwhelming majority of colleges and universities across the country deny students the rights they are granted under the First Amendment or institutional promises. Every year, FIRE reads through the rules governing student speech at more than 400 of our nation's biggest and most prestigious universities to document the institutions that ignore students' rights—or don't tell the truth about how they've taken them away. FIRE's Spotlight database will tell you if your school is one of them.</p>
            </div>
        </article>
        
        <form method="get" action="<?php echo home_url('/spotlight/'); ?>" id="form-find-your-school">
        	<h3>Search by School Name or State</h3>
            <div class="row clearfix">
                <input type="text" name="x" placeholder="Search by school name" />
                <input type="hidden" name="y" value="" />
                <input type="hidden" name="speech_code" value="" />
                <input type="submit" name="submit" value="GO" />
            </div>
            <div class="row clearfix">
                <div class="selector" data-field-name="state">
                    <strong class="selected">Select a State</strong>
                    <ul class="scroll">
                    	<?php
						
							foreach($state_abbreviations_reverse as $stateShort=>$stateName) {
								echo "<li>". $stateShort ."</li>";	
							}
							
						?>
                    </ul>
                </div>
                <input type="submit" name="submit" value="GO" />
            </div>
            <div class="row clearfix">
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
                <input type="submit" name="submit" value="GO" />
            </div>
            <div class="row">
                <p><a href="<?php echo home_url('/spotlight/advancedsearch/'); ?>">Advanced Search</a> • <a href="<?php echo home_url('/schools'); ?>">List All Schools</a></p>
            </div>
        </form>
        <p>Please refer to "<a href="http://www.thefire.org/spotlight/using-the-spotlight-database/">Using FIRE's Spotlight</a>" for instructions on how best to find the information you want.</p><br /><br />
    </section>

</div>

<div class="support clearfix">
	<p>Help FIRE protect the speech rights of students and faculty.</p>
    <a href="<?php echo home_url( '/donate' ); ?>">Support FIRE</a>
</div>

<script> 
	jQuery("#slideout").click(function () {

    // Set the effect type
    var effect = 'slide';

    // Set the options for the effect type chosen
    var options = { direction: 'right' };

    // Set the duration (default: 400 milliseconds)
    var duration = 500;
	
	$( this ).toggleClass( "active" );

    jQuery('#slideout_inner').toggle(effect, options, duration);
});
</script>
	