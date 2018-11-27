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


		<!-- select -->
		<div class="form-group required">
		  <label class="col-md-4 control-label" for="selectbasic">I belong to the following group *</label>
		  <div class="col-md-8">
		    <select id="selectbasic" name="selectbasic" class="form-control">
		      <option value="media">Media</option>
		      <option value="community">Community</option>
		      <option value="non-goverment">Non-Govermental Organization</option>
		      <option value="other">Other</option>
		    </select>
		  </div>
		</div>

		<div class="form-group">
		  <label class="col-md-4 control-label" for="selulatin">Selulation</label>
		  <div class="col-md-8">
		    <select id="selulatin" name="selulatin" class="form-control">
		      <option value="media"> </option>
		      <option value="community"> </option>
		      <option value="non-goverment"> </option>
		      <option value="other"> </option>
		    </select>
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group required">
		  <label class="col-md-4 control-label" for="first-name">First Name *</label>
		  <div class="col-md-8">
		  <input id="first-name" name="first-name" type="text" placeholder="" class="form-control input-md" required="">
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group required">
		  <label class="col-md-4 control-label" for="last-name">Last Name *</label>
		  <div class="col-md-8">
		  <input id="last-name" name="last-name" type="text" placeholder="" class="form-control input-md" required="">
		  </div>
		</div>


		<!-- Text input-->
		<div class="form-group required">
		  <label class="col-md-4 control-label" for="email">Email *</label>
		  <div class="col-md-8">
		  <input id="email" name="email" type="text" placeholder="" class="form-control input-md" required="">
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="email-2">Email 2</label>
		  <div class="col-md-8">
		  <input id="email-2" name="email-2" type="text" placeholder="" class="form-control input-md" required="">
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group required">
		  <label class="col-md-4 control-label" for="organization">Organization *</label>
		  <div class="col-md-8">
		  <input id="organization" name="organization" type="text" placeholder="" class="form-control input-md" required="">
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group ">
		  <label class="col-md-4 control-label" for="Title">Title </label>
		  <div class="col-md-8">
		  <input id="Title" name="Title" type="text" placeholder="" class="form-control input-md" >
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="address">Address </label>
		  <div class="col-md-8">
		  <input id="address" name="address" type="text" placeholder="" class="form-control input-md">
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group ">
		  <label class="col-md-4 control-label" for="address-2">Address 2 </label>
		  <div class="col-md-8">
		  <input id="address-2" name="address-2" type="text" placeholder="" class="form-control input-md">
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group required">
		  <label class="col-md-4 control-label" for="city">City *</label>
		  <div class="col-md-8">
		  <input id="city" name="city" type="text" placeholder="" class="form-control input-md">

		  </div>
		</div>

		<div class="form-group">
		  <label class="col-md-4 control-label" for="state">State </label>
		  <div class="col-md-8">
		    <select id="state" name="state" class="form-control">
		      <option value="1"> </option>
		      <option value="2"> </option>
		      <option value="3"> </option>
		      <option value="4"> </option>
		    </select>
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="zip">Zip/postal code </label>
		  <div class="col-md-8">
		  <input id="zip" name="zip" type="text" placeholder="" class="form-control input-md">
		  </div>
		</div>

		<div class="form-group required">
		  <label class="col-md-4 control-label" for="country">Country *</label>
		  <div class="col-md-8">
		    <select id="country" name="country" class="form-control" placeholder="Select Country">
		      <option value="1"> </option>
		      <option value="2"> </option>
		      <option value="3"> </option>
		      <option value="4"> </option>
		    </select>
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="workphone">Work Phone </label>
		  <div class="col-md-8">
		  <input id="workphone" name="workphone" type="number" placeholder="" class="form-control input-md">
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="cellphone">Cell Phone </label>
		  <div class="col-md-8">
		  <input id="cellphone" name="cellphone" type="number" placeholder="" class="form-control input-md">
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="homephone">Home Phone </label>
		  <div class="col-md-8">
		  <input id="homephone" name="homephone" type="number" placeholder="" class="form-control input-md">
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="fax">Fax </label>
		  <div class="col-md-8">
		  <input id="fax" name="fax" type="text" placeholder="" class="form-control input-md">
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="website">Website </label>
		  <div class="col-md-8">
		  <input id="website" name="website" type="text" placeholder="" class="form-control input-md">
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
