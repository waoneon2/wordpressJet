<?php
/**
 * Template Name: Contact Us
 *
 * @package p66
 */

get_header(); ?>

	<div id="primary" class="content-area homepage">
		<main id="main" class="site-main" role="main">
			<div class="contained section-top-small section-bottom-small corporate-hq">
				<h2><?php echo get_theme_mod('contact_us_title') ?></h2>
				<p><?php
						$text_desc_contact = trim(get_theme_mod('contact_us_desc'));
						$text_desc_contact = nl2br($text_desc_contact);
						echo($text_desc_contact);
					?>
				</p>
			</div>

			<div class="contained flush two-column orange-test section-bottom">
				<div class="row">
					<div class="col-xs-12 col-sm-6 contact-box-wrap">
						<div class="contact-box">

							<h4>Address:</h4>
							<p><?php
									$text_address_contact = trim(get_theme_mod('contact_us_address'));
									$text_address_contact = nl2br($text_address_contact);
									echo($text_address_contact);
								?>
							</p>
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 contact-box-wrap">
						<div class="contact-box">
							<h4>Phone:</h4>
							<p class="hidden-xs"><?php echo get_theme_mod('contact_us_phone') ?></p>
							<a href="tel:281-293-6600" class="visible-xs"><?php echo get_theme_mod('contact_us_phone') ?></a>
						</div>
					</div>
				</div>
			</div>

			<div class="contact-form section-top">
				<div class="contained corporate-hq">
					<h2>Send an email</h2>
					<p>Vestibulum euismod venenatis ante, eget fermentum quam tempor et. Donec.</p>
				</div>
				<div class="row contained flush">
					<div class="contact-wrap">
						<div class="first-selection form-group col-xs-12 col-sm-6">
						  	<form>
								<label for="departmentSelection">Department</label>
								<select class="form-control dropdown contact-dropdown dropdown" id="departmentSelection">
									<option value="" selected disabled>Select One</option>
									<option value="careers">Careers</option>
									<option value="donations">Donations</option>
									<option value="msds">Material Safety Data Sheets (MSDS)</option>
									<option value="media-relations">Media Relations</option>
									<option value="oil-and-gas-interest-owners">Oil and gas Interest owners</option>
									<option value="other-inquiries">Other Inquiries</option>
									<option value="retail-outlets-products-services">Retail outlets, products and services</option>
									<option value="service-station-inquiries">Service station inquiries</option>
									<option value="shareholder-services">Shareholder Services</option>
									<option value="vendor">Vendor Form</option>
								</select>
							</form>
						</div>

						<div class="second-selection col-xs-12 col-sm-6">

							<div class="form-group" data-second="careers">
								<label for="careersIssues">Issue</label>
								<select class="form-control dropdown contact-dropdown" id="careersIssues" disabled>
									<option value="" selected disabled>Select One</option>
								  <option value="career-questions">Career questions</option>
								  <option value="password-resets">Password resets</option>
								</select>
							</div>

						</div>
					</div>


					<div class="third-selection section-top-small">

						<div class="third" data-third="career-questions">
							<form action="/examplepage.html" method="get" class="form-wrap form-validate">
								<div class="form-group col-lg-4 col-md-6 col-sm-12">
								  <label for="career-questions-name" class="control-label">Name <sup class="required-mark">*</sup></label>
								  <div>
								    <input type="text" class="form-control" name="name" id="career-questions-name" required>
								  </div>
								</div>

								<div class="form-group col-lg-4 col-md-6 col-sm-12">
								  <label for="career-questions-email" class="control-label">Email address <sup class="required-mark">*</sup></label>
								  <div>
								    <input type="email" class="form-control" name="email" id="career-questions-email" required>
								  </div>
								</div>

								<div class="form-group col-lg-2 col-md-6 col-sm-12">
									<label for="career-questions-name" class="control-label">Phone Type</label>
									<select class="form-control dropdown contact-dropdown" id="departmentSelection">
										<option value="" selected disabled>Select One</option>
									  	<option value="careers">Home</option>
									  	<option value="donations">Mobile</option>
									</select>
								</div>

								<div class="form-group col-lg-2 col-md-6 col-sm-12">
									<label for="career-questions-name" class="control-label">Phone Number</label>
									<div>
								    	<input type="text" class="form-control" name="name" id="career-questions-name">
								  	</div>
								</div>

								<div class="form-group col-lg-4 col-md-6 col-sm-12 offset-sm-0 offset-md-6 offset-lg-8">
									<label for="career-questions-country" class="control-label">Country</label>
									<select name="" id="" class="form-control dropdown contact-dropdown" id="country">
										<option value="" selected disabled>Select One</option>
										<option value="AFG">Afghanistan</option>
										<option value="ALA">Åland Islands</option>
										<option value="ALB">Albania</option>
										<option value="DZA">Algeria</option>
										<option value="ASM">American Samoa</option>
										<option value="AND">Andorra</option>
										<option value="AGO">Angola</option>
										<option value="AIA">Anguilla</option>
										<option value="ATA">Antarctica</option>
										<option value="ATG">Antigua and Barbuda</option>
										<option value="ARG">Argentina</option>
										<option value="ARM">Armenia</option>
										<option value="ABW">Aruba</option>
										<option value="AUS">Australia</option>
										<option value="AUT">Austria</option>
										<option value="AZE">Azerbaijan</option>
										<option value="BHS">Bahamas</option>
										<option value="BHR">Bahrain</option>
										<option value="BGD">Bangladesh</option>
										<option value="BRB">Barbados</option>
										<option value="BLR">Belarus</option>
										<option value="BEL">Belgium</option>
										<option value="BLZ">Belize</option>
										<option value="BEN">Benin</option>
										<option value="BMU">Bermuda</option>
										<option value="BTN">Bhutan</option>
										<option value="BOL">Bolivia, Plurinational State of</option>
										<option value="BES">Bonaire, Sint Eustatius and Saba</option>
										<option value="BIH">Bosnia and Herzegovina</option>
										<option value="BWA">Botswana</option>
										<option value="BVT">Bouvet Island</option>
										<option value="BRA">Brazil</option>
										<option value="IOT">British Indian Ocean Territory</option>
										<option value="BRN">Brunei Darussalam</option>
										<option value="BGR">Bulgaria</option>
										<option value="BFA">Burkina Faso</option>
										<option value="BDI">Burundi</option>
										<option value="KHM">Cambodia</option>
										<option value="CMR">Cameroon</option>
										<option value="CAN">Canada</option>
										<option value="CPV">Cape Verde</option>
										<option value="CYM">Cayman Islands</option>
										<option value="CAF">Central African Republic</option>
										<option value="TCD">Chad</option>
										<option value="CHL">Chile</option>
										<option value="CHN">China</option>
										<option value="CXR">Christmas Island</option>
										<option value="CCK">Cocos (Keeling) Islands</option>
										<option value="COL">Colombia</option>
										<option value="COM">Comoros</option>
										<option value="COG">Congo</option>
										<option value="COD">Congo, the Democratic Republic of the</option>
										<option value="COK">Cook Islands</option>
										<option value="CRI">Costa Rica</option>
										<option value="CIV">Côte d'Ivoire</option>
										<option value="HRV">Croatia</option>
										<option value="CUB">Cuba</option>
										<option value="CUW">Curaçao</option>
										<option value="CYP">Cyprus</option>
										<option value="CZE">Czech Republic</option>
										<option value="DNK">Denmark</option>
										<option value="DJI">Djibouti</option>
										<option value="DMA">Dominica</option>
										<option value="DOM">Dominican Republic</option>
										<option value="ECU">Ecuador</option>
										<option value="EGY">Egypt</option>
										<option value="SLV">El Salvador</option>
										<option value="GNQ">Equatorial Guinea</option>
										<option value="ERI">Eritrea</option>
										<option value="EST">Estonia</option>
										<option value="ETH">Ethiopia</option>
										<option value="FLK">Falkland Islands (Malvinas)</option>
										<option value="FRO">Faroe Islands</option>
										<option value="FJI">Fiji</option>
										<option value="FIN">Finland</option>
										<option value="FRA">France</option>
										<option value="GUF">French Guiana</option>
										<option value="PYF">French Polynesia</option>
										<option value="ATF">French Southern Territories</option>
										<option value="GAB">Gabon</option>
										<option value="GMB">Gambia</option>
										<option value="GEO">Georgia</option>
										<option value="DEU">Germany</option>
										<option value="GHA">Ghana</option>
										<option value="GIB">Gibraltar</option>
										<option value="GRC">Greece</option>
										<option value="GRL">Greenland</option>
										<option value="GRD">Grenada</option>
										<option value="GLP">Guadeloupe</option>
										<option value="GUM">Guam</option>
										<option value="GTM">Guatemala</option>
										<option value="GGY">Guernsey</option>
										<option value="GIN">Guinea</option>
										<option value="GNB">Guinea-Bissau</option>
										<option value="GUY">Guyana</option>
										<option value="HTI">Haiti</option>
										<option value="HMD">Heard Island and McDonald Islands</option>
										<option value="VAT">Holy See (Vatican City State)</option>
										<option value="HND">Honduras</option>
										<option value="HKG">Hong Kong</option>
										<option value="HUN">Hungary</option>
										<option value="ISL">Iceland</option>
										<option value="IND">India</option>
										<option value="IDN">Indonesia</option>
										<option value="IRN">Iran, Islamic Republic of</option>
										<option value="IRQ">Iraq</option>
										<option value="IRL">Ireland</option>
										<option value="IMN">Isle of Man</option>
										<option value="ISR">Israel</option>
										<option value="ITA">Italy</option>
										<option value="JAM">Jamaica</option>
										<option value="JPN">Japan</option>
										<option value="JEY">Jersey</option>
										<option value="JOR">Jordan</option>
										<option value="KAZ">Kazakhstan</option>
										<option value="KEN">Kenya</option>
										<option value="KIR">Kiribati</option>
										<option value="PRK">Korea, Democratic People's Republic of</option>
										<option value="KOR">Korea, Republic of</option>
										<option value="KWT">Kuwait</option>
										<option value="KGZ">Kyrgyzstan</option>
										<option value="LAO">Lao People's Democratic Republic</option>
										<option value="LVA">Latvia</option>
										<option value="LBN">Lebanon</option>
										<option value="LSO">Lesotho</option>
										<option value="LBR">Liberia</option>
										<option value="LBY">Libya</option>
										<option value="LIE">Liechtenstein</option>
										<option value="LTU">Lithuania</option>
										<option value="LUX">Luxembourg</option>
										<option value="MAC">Macao</option>
										<option value="MKD">Macedonia, the former Yugoslav Republic of</option>
										<option value="MDG">Madagascar</option>
										<option value="MWI">Malawi</option>
										<option value="MYS">Malaysia</option>
										<option value="MDV">Maldives</option>
										<option value="MLI">Mali</option>
										<option value="MLT">Malta</option>
										<option value="MHL">Marshall Islands</option>
										<option value="MTQ">Martinique</option>
										<option value="MRT">Mauritania</option>
										<option value="MUS">Mauritius</option>
										<option value="MYT">Mayotte</option>
										<option value="MEX">Mexico</option>
										<option value="FSM">Micronesia, Federated States of</option>
										<option value="MDA">Moldova, Republic of</option>
										<option value="MCO">Monaco</option>
										<option value="MNG">Mongolia</option>
										<option value="MNE">Montenegro</option>
										<option value="MSR">Montserrat</option>
										<option value="MAR">Morocco</option>
										<option value="MOZ">Mozambique</option>
										<option value="MMR">Myanmar</option>
										<option value="NAM">Namibia</option>
										<option value="NRU">Nauru</option>
										<option value="NPL">Nepal</option>
										<option value="NLD">Netherlands</option>
										<option value="NCL">New Caledonia</option>
										<option value="NZL">New Zealand</option>
										<option value="NIC">Nicaragua</option>
										<option value="NER">Niger</option>
										<option value="NGA">Nigeria</option>
										<option value="NIU">Niue</option>
										<option value="NFK">Norfolk Island</option>
										<option value="MNP">Northern Mariana Islands</option>
										<option value="NOR">Norway</option>
										<option value="OMN">Oman</option>
										<option value="PAK">Pakistan</option>
										<option value="PLW">Palau</option>
										<option value="PSE">Palestinian Territory, Occupied</option>
										<option value="PAN">Panama</option>
										<option value="PNG">Papua New Guinea</option>
										<option value="PRY">Paraguay</option>
										<option value="PER">Peru</option>
										<option value="PHL">Philippines</option>
										<option value="PCN">Pitcairn</option>
										<option value="POL">Poland</option>
										<option value="PRT">Portugal</option>
										<option value="PRI">Puerto Rico</option>
										<option value="QAT">Qatar</option>
										<option value="REU">Réunion</option>
										<option value="ROU">Romania</option>
										<option value="RUS">Russian Federation</option>
										<option value="RWA">Rwanda</option>
										<option value="BLM">Saint Barthélemy</option>
										<option value="SHN">Saint Helena, Ascension and Tristan da Cunha</option>
										<option value="KNA">Saint Kitts and Nevis</option>
										<option value="LCA">Saint Lucia</option>
										<option value="MAF">Saint Martin (French part)</option>
										<option value="SPM">Saint Pierre and Miquelon</option>
										<option value="VCT">Saint Vincent and the Grenadines</option>
										<option value="WSM">Samoa</option>
										<option value="SMR">San Marino</option>
										<option value="STP">Sao Tome and Principe</option>
										<option value="SAU">Saudi Arabia</option>
										<option value="SEN">Senegal</option>
										<option value="SRB">Serbia</option>
										<option value="SYC">Seychelles</option>
										<option value="SLE">Sierra Leone</option>
										<option value="SGP">Singapore</option>
										<option value="SXM">Sint Maarten (Dutch part)</option>
										<option value="SVK">Slovakia</option>
										<option value="SVN">Slovenia</option>
										<option value="SLB">Solomon Islands</option>
										<option value="SOM">Somalia</option>
										<option value="ZAF">South Africa</option>
										<option value="SGS">South Georgia and the South Sandwich Islands</option>
										<option value="SSD">South Sudan</option>
										<option value="ESP">Spain</option>
										<option value="LKA">Sri Lanka</option>
										<option value="SDN">Sudan</option>
										<option value="SUR">Suriname</option>
										<option value="SJM">Svalbard and Jan Mayen</option>
										<option value="SWZ">Swaziland</option>
										<option value="SWE">Sweden</option>
										<option value="CHE">Switzerland</option>
										<option value="SYR">Syrian Arab Republic</option>
										<option value="TWN">Taiwan, Province of China</option>
										<option value="TJK">Tajikistan</option>
										<option value="TZA">Tanzania, United Republic of</option>
										<option value="THA">Thailand</option>
										<option value="TLS">Timor-Leste</option>
										<option value="TGO">Togo</option>
										<option value="TKL">Tokelau</option>
										<option value="TON">Tonga</option>
										<option value="TTO">Trinidad and Tobago</option>
										<option value="TUN">Tunisia</option>
										<option value="TUR">Turkey</option>
										<option value="TKM">Turkmenistan</option>
										<option value="TCA">Turks and Caicos Islands</option>
										<option value="TUV">Tuvalu</option>
										<option value="UGA">Uganda</option>
										<option value="UKR">Ukraine</option>
										<option value="ARE">United Arab Emirates</option>
										<option value="GBR">United Kingdom</option>
										<option value="USA">United States</option>
										<option value="UMI">United States Minor Outlying Islands</option>
										<option value="URY">Uruguay</option>
										<option value="UZB">Uzbekistan</option>
										<option value="VUT">Vanuatu</option>
										<option value="VEN">Venezuela, Bolivarian Republic of</option>
										<option value="VNM">Viet Nam</option>
										<option value="VGB">Virgin Islands, British</option>
										<option value="VIR">Virgin Islands, U.S.</option>
										<option value="WLF">Wallis and Futuna</option>
										<option value="ESH">Western Sahara</option>
										<option value="YEM">Yemen</option>
										<option value="ZMB">Zambia</option>
										<option value="ZWE">Zimbabwe</option>
									</select>
								</div>

								<div class="offset-sm-12 offset-md-6 offset-lg-4 col-lg-8 col-md-6 col-sm-0 offset-block form-group"></div>

								<div class="form-group col-lg-4 col-md-6 col-sm-12">
								  <label for="career-questions-name" class="control-label">Mailing Address</label>
								  <div>
								    <input type="text" class="form-control" name="name" id="career-questions-name">
								  </div>
								</div>

								<div class="form-group col-lg-4 col-md-6 col-sm-12">
								  <label for="career-questions-email" class="control-label">City</label>
								  <div>
								    <input type="email" class="form-control" name="email" id="career-questions-email">
								  </div>
								</div>

								<div class="form-group col-lg-2 col-md-6 col-sm-12">
									<label for="career-questions-name" class="control-label">State</label>
									<select class="form-control dropdown contact-dropdown dropdown" id="departmentSelection">
										<option value="" selected disabled>Select One</option>
									  	<option value="AL">Alabama</option>
										<option value="AK">Alaska</option>
										<option value="AZ">Arizona</option>
										<option value="AR">Arkansas</option>
										<option value="CA">California</option>
										<option value="CO">Colorado</option>
										<option value="CT">Connecticut</option>
										<option value="DE">Delaware</option>
										<option value="DC">District Of Columbia</option>
										<option value="FL">Florida</option>
										<option value="GA">Georgia</option>
										<option value="HI">Hawaii</option>
										<option value="ID">Idaho</option>
										<option value="IL">Illinois</option>
										<option value="IN">Indiana</option>
										<option value="IA">Iowa</option>
										<option value="KS">Kansas</option>
										<option value="KY">Kentucky</option>
										<option value="LA">Louisiana</option>
										<option value="ME">Maine</option>
										<option value="MD">Maryland</option>
										<option value="MA">Massachusetts</option>
										<option value="MI">Michigan</option>
										<option value="MN">Minnesota</option>
										<option value="MS">Mississippi</option>
										<option value="MO">Missouri</option>
										<option value="MT">Montana</option>
										<option value="NE">Nebraska</option>
										<option value="NV">Nevada</option>
										<option value="NH">New Hampshire</option>
										<option value="NJ">New Jersey</option>
										<option value="NM">New Mexico</option>
										<option value="NY">New York</option>
										<option value="NC">North Carolina</option>
										<option value="ND">North Dakota</option>
										<option value="OH">Ohio</option>
										<option value="OK">Oklahoma</option>
										<option value="OR">Oregon</option>
										<option value="PA">Pennsylvania</option>
										<option value="RI">Rhode Island</option>
										<option value="SC">South Carolina</option>
										<option value="SD">South Dakota</option>
										<option value="TN">Tennessee</option>
										<option value="TX">Texas</option>
										<option value="UT">Utah</option>
										<option value="VT">Vermont</option>
										<option value="VA">Virginia</option>
										<option value="WA">Washington</option>
										<option value="WV">West Virginia</option>
										<option value="WI">Wisconsin</option>
										<option value="WY">Wyoming</option>
									</select>
								</div>

								<div class="form-group col-lg-2 col-md-6 col-sm-12">
									<label for="career-questions-name" class="control-label">Zip</label>
									<div>
								    	<input type="text" class="form-control" name="name" id="career-questions-name">
								  	</div>
								</div>

								<div class="form-group col-lg-12 col-md-12 col-sm-12">
								  <label for="career-questions-name" class="control-label">Question/Problem <sup class="required-mark">*</sup></label>
								  <div>
								    <textarea class="form-control" name="question" id="career-questions-question-problem" required></textarea>
								  </div>
								</div>

								<div class="form-group  col-xs-6">
								    <button type="submit" class="btn btn-primary">Submit</button>
								</div>

								<div class="form-group col-xs-6 required-field">
									<sup class="required-mark">*</sup> required field
								</div>
							</form>
						</div>

					</div>
				</div>
			</div>

			<div class="contained section-top corporate-hq">
				<h2><?php echo get_theme_mod('contact_external_links_title') ?></h2>
				<p><?php
						$text_desc_external_links = trim(get_theme_mod('contact_external_links_desc'));
						$text_desc_external_links = nl2br($text_desc_external_links);
						echo($text_desc_external_links);
					?>
				</p>
			</div>
			<div class="contained two-column orange-test section-bottom">
				<div class="row">
					<div class="contact-links col-md-4 col-sm-5 col-xs-12">
						<ul class="contact-links-list">
								<?php for ($count=1; $count <=5 ; $count++) { ?>
									<?php if (get_theme_mod("contact_external_links_text".$count)): ?>
										<li>
											<?php if (get_theme_mod("contact_external_links_url".$count)): ?>
												<a href="<?php echo get_theme_mod('contact_external_links_url'.$count) ?>">
													<i class="glyphicon glyphicon-share"></i>
													<?php echo get_theme_mod('contact_external_links_text'.$count) ?>
												</a>
											<?php else: ?>
												<i class="glyphicon glyphicon-share"></i>
												<?php echo get_theme_mod('contact_external_links_text'.$count) ?>
											<?php endif ?>
										</li>
									<?php endif ?>
								<?php } ?>
						</ul>
					</div>
					<div class="contact-links col-md-4 col-sm-5 col-xs-12">
						<ul class="contact-links">
							<li>Credit Cards</li>
							<?php for ($count=1; $count <=4 ; $count++) { ?>
								<?php if (get_theme_mod("contact_credit_cards_text".$count)): ?>
									<li>
										<?php if (get_theme_mod("contact_credit_cards_url".$count)): ?>
											<a href="<?php echo get_theme_mod('contact_credit_cards_url'.$count) ?>">
												<i class="glyphicon glyphicon-share"></i>
												<?php echo get_theme_mod('contact_credit_cards_text'.$count) ?>
											</a>
										<?php else: ?>
											<i class="glyphicon glyphicon-share"></i>
											<?php echo get_theme_mod('contact_credit_cards_text'.$count) ?>
										<?php endif ?>
									</li>
								<?php endif ?>
							<?php } ?>
						</ul>
					</div>
				</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();

?>

<style type="text/css">
	.promo-full-width {
	    position: relative;
	    padding-bottom: 1px;
	    overflow: visible;
	}

	@media (min-width: 768px){
		.promo-full-width .promo-full-width-row.fully-shaded {
		    background-image: -webkit-linear-gradient(left, rgba(0, 0, 0, 0.6) 0, rgba(0, 0, 0, 0.6) 70%);
		    background-image: -webkit-gradient(linear, left top, right top, from(rgba(0, 0, 0, 0.6)), to(rgba(0, 0, 0, 0.6)));
		    background-image: linear-gradient(to right, rgba(0, 0, 0, 0.6) 0, rgba(0, 0, 0, 0.6) 70%);
		    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#80000000', endColorstr='#00000000', GradientType=1);
		    background-repeat: repeat-x;
		}
	}

	.promo-full-width .promo-full-width-row.row {
	    z-index: 1;
	    position: absolute;
	    min-width: 100%;
	}

	@media (min-width: 768px){
		.promo-full-width .promo-full-width-row {
		    top: 0;
		    bottom: 0;
		    height: 100%;
		    position: absolute;
		}
	}



	@media (min-width: 768px){
		.promo-full-width .promo-full-width-row.center p {
		    text-align: center;
		    color: white;
		    font-size: 18px;
		}
	}

	@media (max-width: 991px) and (min-width: 768px){
		.promo-full-width .promo-full-width-row.center h1 {
		    font-size: 28px;
		}
	}

	@media (max-width: 991px) and (min-width: 768px){
		.promo-full-width .promo-full-width-row.center p {
		    font-size: 14px;
		}
	}

	.fully-shaded {
	    background: -webkit-gradient(linear, left top, right top, from(rgba(0, 0, 0, 0.6)), to(rgba(0, 0, 0, 0.6)));
	    background: -webkit-linear-gradient(left, rgba(0, 0, 0, 0.6) 0, rgba(0, 0, 0, 0.6) 70%);
	    background: linear-gradient(to right, rgba(0, 0, 0, 0.6) 0, rgba(0, 0, 0, 0.6) 70%);
	    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#80000000', endColorstr='#00000000', GradientType=1);
	    background-repeat: repeat-x;
	}
	@media (min-width: 768px){
		.promo-full-width .promo-full-width-row.center .desktop-content {
		    left: 50%;
		    -webkit-transform: translate(-50%, -50%);
		    transform: translate(-50%, -50%);
		    max-width: 600px;
		}
	}

	@media (min-width: 768px){
		.promo-full-width .promo-full-width-row .desktop-content {
		    position: absolute;
		    top: 50%;
		    -webkit-transform: translateY(-50%);
		    transform: translateY(-50%);
		}
	}

	@media (max-width: 767px){
		.hidden-xs {
		    display: none !important;
		}
	}

	.promo-full-width .mobile-content {
	    display: none;
	    text-align: center;
	    margin-top: 30px;
	    z-index: 99;
	    width: 100%;
	}

	@media (max-width: 767px){
		.visible-xs {
		    display: block !important;
		}
	}

	@media (max-width: 767px){
		a.visible-xs{
			font-size: 18px;
		}
	}

	.promo-full-width .mobile-content .center {
	    position: relative;
	    padding: 0 40px;
	    width: 100%;
	    margin: auto;
	}

	.corporate-hq {
	    margin-bottom: 20px;
	}

	@media (min-width: 768px){
		.corporate-hq {
		    margin-bottom: 30px;
		}
	}

	@media (max-width: 991px) and (min-width: 768px){
		.corporate-hq p {
		    font-size: 14px;
		}
	}

	.section-bottom-small {
	    margin-bottom: 30px;
	}

	.section-top-small {
	    margin-top: 30px;
	}
	@media (min-width: 768px){
		.contained {
		    padding: 0 8.33%;
		}
	}

	.contained {
	    max-width: 1280px;
	    margin-left: auto;
	    margin-right: auto;
	}

	@media (max-width: 767px){
		.contained.flush {
		    padding: 0;
		}
	}

	.two-column {
	    position: relative;
	}

	@media (max-width: 767px){
		.two-column .row > div:first-child {
		    padding-bottom: 20px;
		}
	}

	.section-bottom {
	    margin-bottom: 60px;
	}

	@media (min-width: 992px){
		.section-bottom {
		    margin-bottom: 100px;
		}
	}

	.contact-box-wrap {
	    max-width: none;
    	padding: 0 5px;
	}

	@media (min-width: 992px){
		.contact-box-wrap {
		    max-width: 325px;
		}
	}

	.contact-box {
	    background-color: #f8f9fa;
	    height: auto;
	    padding: 20px;
	}

	@media (min-width: 768px){
		.contact-box {
		    height: 170px;
		}
	}

	@media (max-width: 991px) and (min-width: 768px){
		.contact-box p {
		    font-size: 14px;
		}
	}

	.contact-box h4, .contact-box p, .contact-box a {
	    line-height: 1.5em;
	}

	.contact-box h4 {
		font-weight: bold;
		margin: 0;
	}

	.section-top {
	    margin-top: 60px;
	}

	@media (min-width: 992px){
		.section-top {
		    margin-top: 100px;
		}
	}

	@media (min-width: 768px){
		.contained {
		    padding: 0 8.33%;
		}
	}

	@media (max-width: 767px){
		.contained {
		    padding: 0 20px;
		}
	}

	@media (max-width: 767px){
		.contained.flush {
		    padding: 0;
		}
	}

	.contact-wrap {
	    padding: 0 20px;
	}

	@media (min-width: 768px){
		.contact-wrap {
		    padding: 0;
		}
	}

	.form-group {
	    margin-bottom: 15px;
	}

	.first-selection {
	    margin-bottom: 30px;
	}

	@media (min-width: 768px){
		.first-selection {
		    margin-bottom: 0;
		}
	}

	.contact-form .second-selection {
	    margin-left: 0;
	}

	@media (min-width: 992px){
		.contact-form .second-selection {
		    margin-left: 8px;
		}
	}

	.first-selection, .second-selection {
	    display: inline-block;
	    min-width: 300px;
	    max-width: none;
	    width: 100%;
    	padding: 0 5px;
	}

	@media (min-width: 768px){
		.first-selection, .second-selection {
		    max-width: 50%;
		}
	}

	@media (min-width: 992px){
		.first-selection, .second-selection {
		    max-width: 315px;
		}
	}

	.form-group select.dropdown.contact-dropdown {
	    max-width: none;
	    margin-bottom: 0;
	}

	select.dropdown.contact-dropdown {
	    display: block;
	    text-align: center;
	    -webkit-transition: opacity 0.5s ease-in-out;
	    transition: opacity 0.5s ease-in-out;
	}

	@media (min-width: 768px){
		select.dropdown.contact-dropdown {
		    display: inline-block;
		    max-width: 260px;
		}
	}

	@media (min-width: 992px){
		select.dropdown.contact-dropdown {
		    max-width: 300px;
		}
	}

	.contact-links {
		padding: 0 5px;
	}

	.contact-links-list {
	    margin-bottom: 40px;
    	padding-left: 0;
	}

	@media (min-width: 992px){
		.contact-links-list {
		    margin-bottom: 0;
		}
	}

	.contact-links li {
	    margin-bottom: 15px;
	}

	.contact-links li i {
	    padding-right: 10px;
	}

	.glyphicon {
	    position: relative;
	    top: 1px;
	    display: inline-block;
	    font-family: 'Glyphicons Halflings';
	    font-style: normal;
	    font-weight: normal;
	    line-height: 1;
	    -webkit-font-smoothing: antialiased;
	    -moz-osx-font-smoothing: grayscale;
	}

	.third-selection {
	    background-color: #f8f9fa;
	    padding: 0 5px;
    	margin-top: 150px;
	}

	.third-selection:after {
	    content: "";
	    display: table;
	    clear: both;
	}

	@media (min-width: 768px){
		.third-selection {
		    padding: 0 30px;
    		margin-top: 90px;
		}
	}

	@media (min-width: 992px){
		.third-selection {
		    padding: 0 40px;
    		margin-top: 90px;
		}
	}

	.form-wrap {
	    padding: 40px 0;
	}

	.form-validate .form-group {
	    margin-bottom: 40px;
	}

	.form-validate .offset-block {
	    height: 0;
	    margin-bottom: 0;
	}

	@media (min-width: 768px){
		.form-validate .offset-block {
		    height: 60px;
		    margin-bottom: 40px;
		}
	}

	.third-selection label {
	    display: block;
	}

	.form-group {
	    margin-bottom: 15px;
	}

	.form-group:after {
	    content: "";
	    display: table;
	    clear: both;
	}

	.form-group input {
	    height: 35px;
	}

	.form-validate input, .form-validate textarea {
	    -webkit-transition: border 0.3s;
	    transition: border 0.3s;
	}

	.form-validate .required-field {
	    padding-top: 20px;
	    height: 60px;
	    font-weight: bold;
	}

	.third-selection input, .third-selection select, .third-selection textarea {
	    border: 1px solid #D1CECD;
	    border-radius: 2px;
	}

	sup.required-mark {
	    color: red;
	}

</style>
