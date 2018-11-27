<!--<div class="container">-->
	<!--<div class="row">-->
           <div id="custom-search-input">
            <div class="input-group col-md-12" id="grouping-search">
            <form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
            <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ) ?></span>
            <div class="col-md-11" id="on_type_search">
                <input type="search" class="search-query form-control"
                name="s"
                value="<?php echo get_search_query() ?>"
                title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>"
                placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder' ) ?>" />
            </div>
            <div class="col-md-1" id="on_button_submit">
                <span>
                    <button class="btn btn-danger search-submit pull-right" type="submit">
                        <span class="glyphicon glyphicon-search gly-rotate-90"></span>
                    </button>
                </span>
            </div>
            </form>
            </div>
         </div>
	<!--</div>-->
<!--</div>-->