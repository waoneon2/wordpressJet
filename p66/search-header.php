<div class="col-md-4 col-sm-5 col-lg-4 col-xs right-col">
	<div class="search-icon visible-xs">
	  <span class="<?php echo !is_search() ? 'search' : '' ?> ">
	    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
	    <span class="sr-only">Site search</span>
	  </span>

	  <?php if (!is_search()): ?>
	  <span class="close-btn">
	    <span>Close search</span>
	  </span>
      <?php endif; ?>

	</div>
	<!-- <p class="hidden-xs drk-grey" style="display: block;"><span>PSX <img src="<?php echo get_template_directory_uri() . '/img/icon-stock-market-up-arrow-desktop.png' ?>" width="13" height="14" alt="stock up"> <strong>73.34 +0.64</strong></span> <span>PSPX <img src="<?php echo get_template_directory_uri() . '/img/icon-stock-market-up-arrow-desktop.png' ?>" width="13" height="14" alt="stock up"> <strong>44.07 +0.64</strong></span></p>
	<a href="<?php echo esc_url($contact_link); ?>" class="hidden-xs">Contact</a>
	<a href="<?php echo esc_url($careers_link); ?>" class="hidden-xs">Careers</a> -->
</div>

<?php if (!is_search()): ?>
	<div class="search-bar search-bar-header row affix" data-spy="affix" style="display: none;">
	    <div class="col-lg-12">
			<form action="<?php bloginfo('url');?>" method="get" class="contained">
				<input type="text" name="s" placeholder="search phillips66.com">
				<button type="submit" class="btn-primary">search</button>
			</form>
	    </div>
	</div>
<?php endif; ?>
