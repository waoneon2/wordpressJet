
<form role="search" method="get" class="td-search-form-widget" action="<?php echo esc_url(home_url( '/' )); ?>">
    <label for="search" class="screen-reader-txt">Search</label>
    <input type="text" id="search" title="Search" name="s" id="s" placeholder="Search entire website" value="<?php echo get_search_query(); ?>">
    
    <button class="btnSearchText" type="submit" id="searchsubmit">
        <span aria-hidden="true" data-icon="&#58880;"></span>
        <span class="screen-reader-txt">Search</span>
    </button>
</form>