<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ocala
 */
$states = require __DIR__ . '/inc/us-states.php';
get_header(); ?>

	<div id="frontprimary" class="content-area">
		<main id="frontmain" class="site-main container" role="main">
			<form id="multipage" class="multipage form">

	        <fieldset id="page_one">

	            <h1 class="main-headline">Your CEP Partnership</h1>
				<div class="home-subtitle">What kind of return will you earn?</div>

				<!-- Leadership section -->
				<div class="partner-offer-slider">
					<?php
					$args = array(
							'post_type' => 'leadership',
							'orderby' => 'date',
							'posts_per_page' => 4
						);
					$loop = new WP_Query( $args );
					while ( $loop->have_posts() ) : $loop->the_post();

					?>
						<?php
							$key_1_value = get_post_meta( get_the_ID(), '_meta_price_value', true );
							$key_2_value = get_post_meta( get_the_ID(), '_meta_favorite_value', true );
							$key_member_id = get_post_meta( get_the_ID(), '_meta_member_id', true );
						 ?>
						<article class="partner-offer <?php echo $key_2_value?>" data-amount="<?php echo $key_1_value; ?>" >
							<h2 class="title-headline"><?php the_title(); ?></h2>
							<h4 class="accent-headline">
								<?php
								echo '<div class="member-id" style="display:none;">';
								echo  $key_member_id;
								echo '</div>';
								// Check if have price, print price.
								if ( ! empty( $key_1_value ) ) { echo '$'. number_format($key_1_value); } ?></h4>
							<?php the_content(); ?>
							<button class="button button-border">SELECT</button>
						</article>
					<?php
					endwhile;
					?>
				</div>

	            <!-- Progress-bar -->
	            <div class="clear"></div>
	            <div class="progress-bar" role="progressbar">
	                <div class="progress-point progress-point-full">
	                    <span>Select Plan</span>
	                </div>
	                <div class="progress-body"></div>
	                <div class="progress-point">
	                    <span>Payment</span>
	                </div>
	            </div>
	            <!-- //Progress-bar -->
	        </fieldset>
	        	<!-- Partership form -->

	            <!-- Payment form -->
	        <fieldset id="page_two" >
	            <h1 class="main-headline">Payment</h1>
	            <section class="form-body">
	                <div class="form-container">
	                    <div class="form-row">
	                        <div class="form-field">
	                            <label for="name">Name</label>
	                            <input type="text" name="name" value="" placeholder="As appears on your credit card">
	                        </div>
	                    </div>
	                    <div class="form-row">
	                        <div class="form-field">
	                            <label for="email">Email</label>
	                            <input type="email" name="email" value="">
	                        </div>
	                    </div>
	                    <div class="form-row">
	                        <div class="form-field">
	                            <label for="card">Credit Card Number</label>
	                            <div class="iframeholder" id="creditCardNumberInput"></div>
	                            <!-- <input type="tel" name="card" id="creditCardNumberInput" value="" placeholder="•••• •••• •••• ••••" maxlength="16"> -->
	                        </div>
	                    </div>
	                    <div class="form-row">
	                        <div class="form-field form-field-min">
	                            <label for="expire">Expiration Date</label>
	                            <div class="iframeholder" id="creditCardExpireInput"></div>
	                            <!-- <input type="tel" name="expire" value="" id="creditCardExpireInput" placeholder="MM / YYYY"> -->
	                        </div>
	                        <div class="form-field form-field-min">
	                            <label for="cvv">CVV Code</label>
	                            <div class="iframeholder" id="creditCardCvvInput"></div>
	                            <!-- <input type="tel" name="cvv" id="creditCardCvvInput" value="" placeholder="..."> -->
	                        </div>
	                    </div>
	                    <div class="form-row">
	                    	<input type="hidden" name="amount_payment" id="amount_payment">
	                        <p class="form-field form-field-info">* Partnership does not begin until payment is processed</p>
	                        <div class="g-recaptcha" data-callback="listenCaptcha" data-sitekey="6LdJXygTAAAAAJz2iI_nouUdPE3aFUKidC0PVYmE"></div>
	                    </div>
	                </div>
	            </section>

	            <!-- Progress-bar -->
	            <div class="clear"></div>
	            <div class="progress-bar" role="progressbar">
	                <div class="progress-point progress-point-full">
	                    <span>Select Plan</span>
	                </div>
	                <div class="progress-body progress-body-full"></div>
	                <div class="progress-point progress-point-full">
	                    <span>Payment</span>
	                </div>
	            </div>
	            <!-- //Progress-bar -->
	        </fieldset>
	        <!-- //Payment form -->

	        <!-- Welcome form -->
	        <fieldset id="page_three" >
	            <legend class="dnone">COMPLETE PARTNERSHIP</legend>
	            <h1 class="main-headline">Welcome</h1>
	            <p class="info-text">Thank you, your payment has been processed. Your credit card has been charged $<span id="amount"></span></p>
	            <p class="before-form">Congratulations on becoming a partner! You’ll be receiving some exciting information soon from our team. Now that you’re a partner, please tell us a bit more about you and your business for our directory.</p>
	            <section class="form-body">

	                <div class="form-container">
	                    <div class="form-row">
	                        <p class="form-field">
	                            <label for="cname">Company Name</label>
	                            <input type="text" name="cname" value="">
	                        </p>
	                    </div>
	                    <div class="form-row">
	                        <p class="form-field">
	                            <label for="address">Physical Address</label>
	                            <input type="text" name="address" value="">
	                        </p>
	                    </div>
	                    <div class="form-row">
	                        <p class="form-field">
	                            <label for="address2">Physical Address 2 (optional)</label>
	                            <input type="text" name="address2" value="">
	                        </p>
	                    </div>
	                    <div class="form-row">
	                        <p class="form-field">
	                            <label for="city">City</label>
	                            <input type="text" name="city" value="">
	                        </p>
	                    </div>
	                    <div class="form-row">
	                        <p class="form-field form-field-mid">
	                            <label for="state">State</label>
	                            <select name="state">
	                            	<?php foreach ($states as $key => $value): ?>
										<option value="<?php echo esc_attr($key); ?>"><?php echo $value; ?></option>
									<?php endforeach; ?>
								</select>
	                        </p>
	                        <p class="form-field form-field-min">
	                            <label for="zipcode">Zip Code</label>
	                            <input type="text" name="zipcode" value="" placeholder="32123">
	                        </p>
	                    </div>
	                    <div class="form-row">
	                        <p class="form-field">
	                            <label for="country">Country</label>
	                            <select name="country">
	                            	<option value="United States of America">United States of America</option>
									<option value="Australia">Australia</option>
									<option value="Belgium">Belgium</option>
									<option value="Chile">Chile</option>
								</select>
	                        </p>
	                    </div>

	                    <!-- input YES NO section -->
	                    <div class="form-row radio-box">
	                        <!-- Billing input section -->
	                        <div class="form-field radios">
	                            <p>Same as Mailing?</p>
	                            <div class="custom-radio">
	                                <input id="billing1" type="radio" checked="checked" name="billing" value="yes">
	                                <label class="icon" for="billing1"></label>
	                            </div>
	                            <label class="icon-text" for="billing1">yes</label>
	                            <div class="custom-radio">
	                                <input id="billing0" type="radio" checked="" name="billing" value="no">
	                                <label class="icon" for="billing0"></label>
	                            </div>
	                            <label class="icon-text" for="billing0">no</label>

	                            <!-- Billing data section -->
	                            <div id="billing-data" class="dnone">
	                                <div class="form-row">
	                                    <p class="form-field">
	                                        <span class="accent-headline">Data for Mailing</span><br>
	                                        <label for="billing-cname">Company Name</label>
	                                        <input type="text" name="billing-cname" value="">
	                                    </p>
	                                </div>
	                                <div class="form-row">
	                                    <p class="form-field">
	                                        <label for="billing-address">Physical Address</label>
	                                        <input type="text" name="billing-address" value="">
	                                    </p>
	                                </div>
	                                <div class="form-row">
	                                    <p class="form-field">
	                                        <label for="billing-address2">Physical Address 2 (optional)</label>
	                                        <input type="text" name="billing-address2" value="">
	                                    </p>
	                                </div>
	                                <div class="form-row">
	                                    <p class="form-field">
	                                        <label for="billing-city">City</label>
	                                        <input type="text" name="billing-city" value="">
	                                    </p>
	                                </div>
	                                <div class="form-row">
	                                    <p class="form-field form-field-mid">
	                                        <label for="billing-state">State</label>
	                                        <select name="billing-state">
												<?php foreach ($states as $key => $value): ?>
													<option value="<?php echo esc_attr($key); ?>"><?php echo $value; ?></option>
												<?php endforeach; ?>
											</select>
	                                    </p>
	                                    <p class="form-field form-field-min">
	                                        <label for="billing-zipcode">Zip Code</label>
	                                        <input type="text" name="billing-zipcode" value="" placeholder="32123">
	                                    </p>
	                                </div>
	                                <div class="form-row">
	                                    <p class="form-field">
	                                        <label for="billing-country">Country</label>
	                                        <select name="billing-country">
												<option value="Australia">Australia</option>
												<option value="Belgium">Belgium</option>
												<option value="Chile">Chile</option>
												<option value="United States of America">United States of America</option>
											</select>
	                                    </p>
	                                </div>
	                            </div>
	                            <!-- //Billing data section -->
	                        </div>
	                        <!-- //Billing input section -->
	                    </div>
	                    <!-- //input YES NO section -->

	                    <div class="form-row">
	                        <p class="form-field">
	                            <label for="phone">Phone</label>
	                            <input type="text" name="phone" value="" placeholder="xxx-xxx-xxxx">
	                        </p>
	                    </div>
	                    <div class="form-row">
	                        <p class="form-field">
	                            <label for="cellphone">Website</label>
	                            <input type="text" name="cellphone" value="" placeholder="http://">
	                        </p>
	                    </div>
	                </div>

	            </section>
	        </fieldset>

			<fieldset id="page_four">
	            <legend class="dnone">SAVE &amp; NEXT</legend>
	            <h1 class="main-headline">Be Social</h1>
	            <section class="form-body">

	                <div class="form-container">
	                    <div class="form-row">
	                        <!-- input checkbox section -->
	                        <div class="form-field checkboxes">
	                            <p>This business is</p>
	                            <div class="first-checkbox">
	                                <div class="custom-checkbox">
	                                    <input id="business1" type="checkbox" name="business" value="Minority-Owned">
	                                    <label class="icon" for="business1"></label>
	                                </div>
	                                <label class="icon-text" for="business1">Minority-Owned</label><br>
	                            </div>

	                            <div>
	                                <div class="custom-checkbox">
	                                    <input id="business2" type="checkbox" name="business" value="Female-Owned">
	                                    <label class="icon" for="business2"></label>
	                                </div>
	                                <label class="icon-text" for="business2">Female-Owned</label>
	                            </div>
	                            <div>
	                                <div class="custom-checkbox">
	                                    <input id="business3" type="checkbox" name="business" value="veteran-Owned">
	                                    <label class="icon" for="business3"></label>
	                                </div>
	                                <label class="icon-text" for="business3">Veteran-Owned</label>
	                            </div>

	                        </div>
	                        <!-- //input checkbox section -->
	                    </div>

	                    <div class="form-row social-row">
	                        <p class="form-field">
	                            <label for="companyfb">Connect with our company at</label>
	                            <input type="text" name="companyfb" class="facebook" value="" placeholder="paste the link to your company facebook page here">
	                        </p>
	                        <p class="form-field">
	                            <input type="text" name="companytwitter" class="twitter" value="" placeholder="paste the link to your company twitter page here">
	                        </p>
	                    </div>
	                    <div class="form-row social-row">
	                        <p class="form-field">
	                            <label for="personalfb">Connect with me at</label>
	                            <input type="text" name="personalfb" class="facebook" value="" placeholder="paste the link to your personal facebook page here">
	                        </p>
	                        <p class="form-field">
	                            <input type="text" name="personaltwitter" class="twitter" value="" placeholder="paste the link to your personal twitter page here">
	                        </p>
	                    </div>
	                    <div class="form-row social-row">
	                        <p class="form-field referer">
	                            <label class="refer-label" for="referer">Referred by</label>
	                            <input class="refer-input" type="text" name="personalfb" class="referred" value="" placeholder="">
	                        </p>

	                    </div>

	                </div>
	            </section>
	        </fieldset>

	        <input type="submit" value="COMPLETE" />

	        </form>
		</main><!-- #main -->
	</div><!-- #primary -->




<?php
get_footer();
