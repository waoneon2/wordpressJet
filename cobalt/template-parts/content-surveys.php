<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package cobalt
 */

?>
<div class="content-custompage-width">
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_content();
		?>

		<form class="form-horizontal">
	

		<!-- Text input-->
		<div class="form-group required">
		  <label class="col-md-4 control-label" for="name">Your Name? *</label>  
		  <div class="col-md-8">
		  <input id="name" name="name" type="text" placeholder="" class="form-control input-md" required="">
		    
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group required">
		  <label class="col-md-4 control-label" for="job">Your Job Title? *</label>  
		  <div class="col-md-8">
		  <input id="job" name="job" type="text" placeholder="" class="form-control input-md" required="">
		    
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group required">
		  <label class="col-md-4 control-label" for="MediaOutlet">Name of your Media Outlet? (Add any network or other affiliation) *</label>  
		  <div class="col-md-8">
		  <input id="MediaOutlet" name="MediaOutlet" type="text" placeholder="" class="form-control input-md" required="">
		    
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group required">
		  <label class="col-md-4 control-label" for="OutletLocation">Your Media Outlet's Location? (List City, State, Country) *</label>  
		  <div class="col-md-8">
		  <input id="OutletLocation" name="OutletLocation" type="text" placeholder="" class="form-control input-md" required="">
		    
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group required">
		  <label class="col-md-4 control-label" for="WorkPhone">Your Work Phone Number? *</label>  
		  <div class="col-md-8">
		  <input id="WorkPhone" name="WorkPhone" type="number" placeholder="" class="form-control input-md" required="">
		    
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group required">
		  <label class="col-md-4 control-label" for="MobilePhone">Your Cell or Phone Number? *</label>  
		  <div class="col-md-8">
		  <input id="MobilePhone" name="MobilePhone" type="number" placeholder="" class="form-control input-md" required="">
		    
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group required">
		  <label class="col-md-4 control-label" for="email">Your E-mail Address? *</label>  
		  <div class="col-md-8">
		  <input id="email" name="email" type="email" placeholder="" class="form-control input-md" required="">
		    
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="MediaWebsite">Your Media Outlet's Website?</label>  
		  <div class="col-md-8">
		  <input id="MediaWebsite" name="MediaWebsite" type="url" placeholder="" class="form-control input-md">
		    
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group required">
		  <label class="col-md-4 control-label" for="WhoTarget">WHO would you like to interview? (List a specific person, or a specific agency or organization or answer "First-available spokesperson" familt with the topics that you want to cover in the interview.) *</label>  
		  <div class="col-md-8">
		  <!-- <input id="WhoTarget" name="WhoTarget" type="text" placeholder="" class="form-control input-md" required=""> -->
		  <textarea class="form-control" id="WhoTarget" name="WhoTarget"></textarea>
		    
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group required">
		  <label class="col-md-4 control-label" for="StoryAngle">WHAT is the  subject or story angle for this interview and the topic(s) to be covered? *</label>  
		  <div class="col-md-8">
		  <!-- <input id="StoryAngle" name="StoryAngle" type="text" placeholder="" class="form-control input-md" required=""> -->
		  <textarea class="form-control" id="StoryAngle" name="StoryAngle"></textarea>
		    
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group required">
		  <label class="col-md-4 control-label" for="DateTarget">WHEN would you like to conduct this interview? (List a DAte and U.S. Central Time at least four hours after the time you submit this request, or answer "As soon as possible" whenever the interview can be scheduled.) *</label>  
		  <div class="col-md-8">
		  <!-- <input id="DateTarget" name="DateTarget" type="date" placeholder="" class="form-control input-md" required=""> -->
		  <textarea class="form-control" id="DateTarget" name="DateTarget"></textarea>
		    
		  </div>
		</div>

		<!-- Multiple Checkboxes -->
		<div class="form-group required">
		  <label class="col-md-4 control-label" for="HowInterview">HOW would you like to conducted this interview? (Check one or more boxes) *</label>
		  <div class="col-md-8">
		  <div class="checkbox">
		    <label for="HowInterview-0">
		      <input type="checkbox" name="HowInterview" id="HowInterview-0" value="email">
		      By E-mail
		    </label>
			</div>
		  <div class="checkbox">
		    <label for="HowInterview-1">
		      <input type="checkbox" name="HowInterview" id="HowInterview-1" value="phone">
		      By Telephone
		    </label>
			</div>
		  <div class="checkbox">
		    <label for="HowInterview-2">
		      <input type="checkbox" name="HowInterview" id="HowInterview-2" value="skype">
		      By Skype or video conferencing
		    </label>
			</div>
		  <div class="checkbox">
		    <label for="HowInterview-3">
		      <input type="checkbox" name="HowInterview" id="HowInterview-3" value="inperson">
		      In person (face to face)
		    </label>
			</div>
		  <div class="checkbox">
		    <label for="HowInterview-4">
		      <input type="checkbox" name="HowInterview" id="HowInterview-4" value="all">
		      Any of the above
		    </label>
			</div>
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="InpersonLocation">If you are requsting an in-Person Interview, WHERE would you like to conduct this interview?</label>  
		  <div class="col-md-8">
		  <textarea class="form-control" id="InpersonLocation" name="InpersonLocation"></textarea>
		    
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="SpecialRequest">Any special request for this interview? (For example, will the interview be broadcast live? Will the interview be conducted in a foreign language?)</label>  
		  <div class="col-md-8">
		  <textarea class="form-control" id="SpecialRequest" name="SpecialRequest"></textarea>
		    
		  </div>
		</div>

		<!-- Button (Double) -->
		<div class="form-group button-group">
		    <button id="submit" name="submit" class="btn btn-default">Submit</button>
		    <button id="cancel" name="cancel" class="btn btn-default">Cancel</button>
		</div>

		
		</form>







	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'cobalt' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</div><!-- #post-## -->


<style type="text/css">
/*	.page-form-container .form-group.required > .control-label {
		color : red;
	}

	.page-form-container .form-group .control-label {
		text-align: left;
	}

	.page-form-container .form-group {
	    margin: 20px 0 !important;
	    display: block;
	    max-width: 700px;
	    padding: 10px;
	    border: 1px solid #ccc;
	}
	.page-form-container .form-group textarea {
	    height: 80px;
	}
	.button-group {
		border:0px;
	}
	.page-form-container input[type="text"], input[type="email"], input[type="url"], input[type="password"], input[type="search"], input[type="number"], input[type="tel"], input[type="range"], input[type="date"], input[type="month"], input[type="week"], input[type="time"], input[type="datetime"], input[type="datetime-local"], input[type="color"], textarea {
		border-radius: 0 !important;
	}*/

</style>