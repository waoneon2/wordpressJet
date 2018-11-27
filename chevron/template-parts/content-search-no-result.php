<?php
/**
 * Template part for displaying no result in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package chevron
 */

?>

<div class="container centered width-1280">
	<header class="page-header search-header">
		<div class="search-bar search-page font-gotham bg-offwhite">
			<div class="width-1280 centered">
				<form action="<?php echo esc_url( home_url( '/' ) )?>" method="get" class="contained">
                    <div class="input-group input-group-lg search-bar-container" id="cludo-search-meganav" role="search">
                        <span class="input-group-addon glyphicon glyphicon-search"></span>
                        <label class="placeholder font-gotham-narrow" for="cludo-search-meganav-input">what can we help you find?</label>
                        <input id="cludo-search-meganav-input" name="s" type="text" class="form-control search-input font-gotham-narrow" placeholder="what can we help you find?" value="<?php echo esc_attr($_GET['s']) ?>">
                        <a href="javascript:void(0)" class="input-group-addon clear-search-link clear-button cludo-search-query-clear cludo-hidden">
                          <span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>
                          <span class="clear-search">clear</span>
                        </a>
                        <div class="buttons pull-right">
                            <button class="input-group-addon search-button" type="submit" title="search">
                              <span class="dashicons dashicons-arrow-right-alt">
                                <span class="sr-only">search</span>
                              </span>
                            </button>
                        </div>
                    </div>
                </form>
			</div>
		</div>
		<div class="search-header-count">
				
			<?php
			/* translators: %s: search query. */
			printf( esc_html__( 'Your search for %s', 'chevron' ), '<span>' . "'<b>" .get_search_query() . "</b>'" . '</span>' ); ?>
			<span class="search-count">
				<?php
					$total_search_post = $wp_query->found_posts;

					printf( esc_html__('returned %s results', 'chevron'), '<b>'.$total_search_post.'</b>');
	            ?>
			</span>
		</div>
	</header><!-- .page-header -->
	<div class="container-no-result">
		<?php _e('No Results', 'chevron'); ?>
	</div>
</div>
 
