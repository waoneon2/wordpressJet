<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package p66
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="search-results-list">
		<div class="search-results-item">
			<header class="entry-header">
				<?php the_title( sprintf( '<h4 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>
			</header><!-- .entry-header -->

			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
		</div>
	</div>

</article><!-- #post-<?php the_ID(); ?> -->


<style type="text/css">

	@media (min-width: 992px){
		.search-results-list {
		    max-width: 850px;
		}
	}

	@media (min-width: 768px){
		.search-results-list {
		    margin-top: 55px;
		}
	}

	.search-results-item {
	    border-bottom: 1px solid #cbc8c7;
	    font-size: 1.28571em;
	    margin-top: 30px;
	}

	.search-results-item h4 {
	    color: #266FDC;
	    font-size: 1.71429em;
	    margin-bottom: 15px;
	}

	.entry-meta a {
	    color: #A9AAAA;
	    margin-bottom: 10px;
	    display: block;
	}

	p {
	    color: #000;
	    font-size: 18px;
	    line-height: 26px;
	    margin: 0 0 10px;
	    font-family: "Open Sans", sans-serif;
	    font-weight: 400;
	}

	.search-results-row {
	    max-width: 100%;
	}

	.post-categories {
		padding-left: 0;
	    /*display: flex;*/
	    margin-bottom: 30px;
	}

	@media (min-width: 768px){
		.post-categories li {
			min-width: 250px;
	    	width: 35%;
		}
	}

	.post-categories li {
		display: inline-block;
    	width: 45%;
	}

	.post-categories a {
		color: #266fdc;
	    margin-bottom: 10px;
	    display: block;
	}


</style>
