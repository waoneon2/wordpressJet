<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
    <div><label class="screen-reader-text" for="s"><?php _e('Search for:','castrol'); ?></label>
        <input type="text" placeholder="<?php _e('Search...','castrol'); ?>" value="" name="s" id="s" />
        <input type="submit" id="searchsubmit" value="<?php _e('Search','castrol'); ?>" />
    </div>
</form>