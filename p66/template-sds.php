<?php
/**
 * Template Name: Safety data sheets
 */
get_header(); ?>

<div class="content">
		<div class="contained wide-content section-top orange-test">
			<!-- <div class="row"> -->
				<div class="col-xs-12 col-md-9">
					<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/content', 'page' );

					endwhile; // End of the loop.
					?>
				</div>
			<!-- </div> -->

			<div class="sds-form orange-test">
			  <form role="search" method="get">
				  <div class="row">
				      <div class="col-xs-12 col-sm-6 col-md-4">
				        <label for="product-name" class="control-label">Product Name/SDS Number</label>
				        <button type="button" class="dashicons dashicons-info" data-toggle="modal" data-target=".modal-tooltip-product-name"></button>
				        	<!-- Modal Tip -->
				        	<div class="modal fade modal-tooltip-product-name" tabindex="-1" role="dialog" aria-labelledby="modalTooltipProductName">
										<div class="modal-dialog modal-sm" role="document">
										  <div class="modal-content">
										    <div class="modal-header">
										      <span class="close-btn">
										        <span>Close Video</span>
										      </span>
										      <h4 class="modal-title" id="modalTooltipProductName">Product Name/SDS Number</h4>
										    </div>
										    <div class="modal-body">
										      ...
										    </div>
										  </div>
										</div>
									</div>
				        <input type="search" class="form-control" name="s" id="search">
					  </div>

			      <div class="col-xs-12 col-sm-6 col-md-4">
			        <label for="languageSelection">Language</label>
			        <select class="form-control dropdown" name="language" id="languageSelection">
			          <option value="">Select One</option>
			          <option value="am_en">American English</option>
			          <option value="sp">Spanish</option>
			          <option value="fr">French</option>
			        </select>
			      </div>

			      <div class="col-xs-12 col-sm-6 col-md-4">
			        <label for="regionSelection">Region</label>
			        <select class="form-control dropdown" name="region" id="regionSelection">
			          <option value="">Select One</option>
			          <option value="americas">Americas</option>
			          <option value="europe">Europe</option>
			          <option value="asia">Asia</option>
			        </select>
			      </div>

			      <div class="col-xs-12 col-sm-6 col-md-4">
			        <button type="submit" class="btn btn-primary">Submit</button>
			        <button type="reset" class="btn btn-link">Reset</button>
			      </div>

			    </div>
			  </form>
			</div>
		</div>

		<div class="contained flush section-top orange-test">
		<!-- Mobile Responsive -->
			<div class="table-sort-dropdown visible-xs">
			    <label for="dropdownTableSortSDS1">Sort By</label>
			    <select class="form-control dropdown" name="language" id="dropdownTableSortSDS1">
			      <option value="searchdataseheetresultspage.html?sortby=dept&amp;order=dsc">Department (Descending)</option>
			      <option value="searchdataseheetresultspage.html?sortby=dept&amp;order=asc" selected="">Department (Ascending)</option>
			      <option value="searchdataseheetresultspage.html?sortby=sdsnumber&amp;order=dsc">SDS # (Descending)</option>
			      <option value="searchdataseheetresultspage.html?sortby=sdsnumber&amp;order=asc">SDS # (Ascending)</option>
			      <option value="searchdataseheetresultspage.html?sortby=reviseddate&amp;order=dsc">Revised Dates (Descending)</option>
			      <option value="searchdataseheetresultspage.html?sortby=reviseddate&amp;order=asc">Revised Dates (Ascending)</option>
			      <option value="searchdataseheetresultspage.html?sortby=language&amp;order=dsc">Language (Descending)</option>
			      <option value="searchdataseheetresultspage.html?sortby=language&amp;order=asc">Language (Ascending)</option>
			      <option value="searchdataseheetresultspage.html?sortby=region&amp;order=dsc">Region (Descending)</option>
			      <option value="searchdataseheetresultspage.html?sortby=region&amp;order=asc">Region (Ascending)</option>
			    </select>
			  </div>

			<div><table class=" table stacktable small-only">
				  	<tbody><tr class="">
						  	<td class="st-key"> Department </td>
						  	<td class="st-val"> Donations </td>
				      	</tr>
				      	<tr class="">
				      		<td class="st-key"> SDS #</td>
				      		<td class="st-val"> 724240 </td>
				      	</tr>
				      	<tr class="">
				      		<td class="st-key"> Revised Dates </td>
				      		<td class="st-val"> 4/1/2015 </td>
				      	</tr>
				      	<tr class="">
				      		<td class="st-key"> Language</td>
				      		<td class="st-val"> American English </td>
				      	</tr>
				      	<tr class="">
				      		<td class="st-key"> Region </td>
				      		<td class="st-val"> Americas </td>
				      	</tr>
					</tbody>
				</table>
				<table class=" table stacktable small-only">
					<tbody><tr class="">
							<td class="st-key"> Department </td>
							<td class="st-val"> Material Safety Data Sheets (MSDS) </td>
					  </tr>
					  <tr class="">
					  		<td class="st-key"> SDS # </td>
					  		<td class="st-val"> 817779 </td>
					  </tr>
					  <tr class="">
					  		<td class="st-key"> Revised Dates </td>
					  		<td class="st-val"> 10/10/2014 </td>
					  </tr>
					  <tr class="">
					  		<td class="st-key"> Language </td>
					  		<td class="st-val"> Spanish </td>
					  </tr>
					  <tr class="">
					  		<td class="st-key"> Region </td>
					  		<td class="st-val"> Americas </td>
					  </tr>
					</tbody>
				</table>
				<table class=" table stacktable small-only">
					<tbody><tr class="">
							<td class="st-key"> Department </td>
							<td class="st-val"> Oil and gas Interest owners </td>
						</tr><tr class="">
							<td class="st-key"> SDS # </td>
							<td class="st-val"> 830199 </td>
						</tr>
						<tr class="">
							<td class="st-key"> Revised Dates </td>
							<td class="st-val"> 11/18/2015 </td>
						</tr>
						<tr class="">
							<td class="st-key"> Language </td>
							<td class="st-val"> French </td>
						</tr><tr class="">
							<td class="st-key"> Region </td>
							<td class="st-val"> Europe </td>
						</tr>
					</tbody>
				</table>
			</div>

		<table id="myTable" class="table stacktable large-only">
			<thead>
		      <tr>
		         <th class="dashicons-arrow-down"><a>Department</a></th>
		         <th><a>SDS #</a></th>
		         <th><a>Revised Dates</a></th>
		         <th><a>Language</a></th>
		         <th><a>Region</a></th>
		      </tr>
		    </thead>
				<tr>
			      <td>Donations</td>
			      <td>724240</td>
			      <td>04/01/2015</td>
			      <td>American English</td>
			      <td>Americas</td>
			    </tr>
			    <tr>
			      <td>Material Safety Data Sheets (MSDS)</td>
			      <td>817779</td>
			      <td>10/10/2014</td>
			      <td>Spanish</td>
			      <td>Americas</td>
			    </tr>
			    <tr>
			      <td>Oil and gas Interest owners</td>
			      <td>830199</td>
			      <td>11/18/2015</td>
			      <td>French</td>
			      <td>Europe</td>
			    </tr>
		</table>
		</div>

		<div class="contained wide-content content-footer section-top orange-test">
		  <div class="row">
		    <div class="col-xs-12">
		      <?php echo '<p>'.get_theme_mod('sds_footer').'</p>';?>
		    </div>
		  </div>
		</div>

	</div><!-- #content -->

<?php
get_footer();

