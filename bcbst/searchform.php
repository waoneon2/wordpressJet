<form role="search" method="get" class="searchs-form-full-not-mobile mx-2 my-auto d-inline w-100" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="input-group">
		<input type="search" class="form-control searchs-field" placeholder=" " value="<?php the_search_query(); ?>" name="s" title="Search for:">
			<div class="input-group-btn">
			 	<button type="submit" class="btn btn-default search-submit"><span class="fa fa-search"></span></button>
			</div>
	</div>
</form>