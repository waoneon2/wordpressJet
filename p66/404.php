<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package p66
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="content">
					<div class="search-hero section-bottom-small">
						<h1 class="search-h1 hidden-xs">404 NOT FOUND</h1>
						<div class="contained two-column section-top section-bottom">
							<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'p66' ); ?></h1>
							<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'p66' ); ?></p>
						</div>
						<div class="search-bar row" data-spy="affix">
						    <div class="col-lg-12">
						      <!-- GET should likely be a POST, once the backend integration is avialable -->
								<form action="<?php bloginfo('url');?>" method="get" class="contained">
									<input type="text" name="s" placeholder="search phillips66.com">
									<button type="submit" class="btn-primary">search</button>
								</form>
						    </div>
						</div>
					</div>
				</header><!-- .page-header -->



			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();

?>

<style type="text/css">
	/*header*/
	.error-404 .search-hero {
	    background-color: #f8f9fa;
	    /*box-shadow: 0 5px 10px #CCCCCC;*/
	}

	@media (min-width: 768px){
		.error-404 .search-hero {
		    box-shadow: none;
		}
	}

	.section-bottom-small {
	    margin-bottom: 30px;
	}

	.error-404 .search-h1 {
	    padding-top: 50px;
	}

	.error-404 .search-h1, .error-404 .search-h2 {
	    text-align: center;
	    margin: 0;
	}

	h1 {
	    font-weight: 700;
	}

	@media (min-width: 992px){
		.error-404 .search-h2 {
		    font-size: 1.42857em;
		}
	}

	.error-404 .search-h2 {
	    padding: 30px 0;
	    font-size: 1.28571em;
	}

	.error-404 .search-bar {
	    display: block;
	    position: static;
	    background-color: #f8f9fa;
	    border-top: 0;
	}

	@media (min-width: 768px){
		.search-bar.affix {
		    top: 162px;
		}
	}

	@media (min-width: 768px){
		.search-bar {
		    height: 124px;
		    background-color: #fff;
		    border-top: 1px solid #e6e7e8;
		    text-align: center;
		    padding-top: 20px;
		    left: 0;
		    top: 168px;
		    z-index: 102;
		    width: 100%;
		    display: none;
		}
	}

	.row {
	    max-width: 100%;
	    margin: 0;
	    padding: 0;
	}

	.affix {
	    position: fixed;
	}

	@media (min-width: 1280px){
		.col-lg-12 {
		    width: 100%;
		}
	}

	@media (min-width: 1280px){
		.col-lg-1, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-10, .col-lg-11, .col-lg-12 {
		    float: left;
		}
	}

	.error-404 .search-bar .contained {
	    position: relative;
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

	.error-404 .search-bar input {
	    background-color: #f8f9fa;
	    width: 100%;
	}

	@media (min-width: 768px){
		.search-bar form input {
		    width: 85%;
		    height: 70px;
		    text-transform: uppercase;
		    border: 0;
		    border-bottom: 3px solid #636363;
		    font-size: 30px;
		    padding: 0 0 0 30px;
		}
	}

	@media (max-width: 767px){
		.search-bar form input {
		    width: calc(100% - 10px);
		    height: 50px;
		    text-transform: uppercase;
		    border: 0;
		    border-bottom: 3px solid #636363;
		    font-size: 18px;
		    padding: 0 7px;
		}
	}

	.search-bar input {
	    outline: -webkit-focus-ring-color auto 0;
	    outline: none;
	}
	
	.error-404 .search-bar button {
	    right: auto;
	}

	@media (min-width: 768px){
		.error-404 .search-bar button {
		    right: 9%;
		}
	}

	@media (min-width: 992px){
		.error-404 .search-bar button {
		    right: 18%;
		}
	}

	@media (max-width: 767px){
		.search-bar button {
		    position: relative;
		    margin-top: 20px;
		}
	}

	.search-bar button {
	    padding: 10px 20px 10px;
	}

	@media (min-width: 768px){
		.search-bar button {
		    position: absolute;
		    font-weight: 800;
		    top: 0;
		    right: 9%;
		    height: 50px;
		    padding: 16px 20px 20px 20px;
		}
	}

	@media (min-width: 768px){
		.search-bar button {
		    position: absolute;
		    font-weight: 800;
		    top: 0;
		    right: 9%;
		    height: 50px;
		    padding: 16px 20px 20px 20px;
		}
	}

	.search-bar button {
	    padding: 10px 20px 10px;
	}

	button.btn-primary, a.btn-primary {
	    background-color: #e10000;
	    color: #fff;
	    padding: 15px 20px;
	    box-shadow: inset 0px -2px 1px 2px rgba(0, 0, 0, 0.1);
	}

</style>