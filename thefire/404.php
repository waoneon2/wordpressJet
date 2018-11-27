<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

<div class="wrapper clearfix">
	<div id="primary" class="content-area full-width">
		<div id="content" class="site-content" role="main">
        	<div class="entry-content">
                <h3 style="color: #DE2027;">This page may have moved or is no longer available. Please try one of the following:</h3>
                <ul>
                    <li>Check the Web address you entered to make sure if it's correct.</li>
                    <li>Try to access the page directly from the homepage instead of using a bookmark. If the page has moved, reset your bookmark.</li>
                    <li>Enter keywords in the Search box and click the Search button. </li>
                    <li><a href="mailto:webmaster@thefire.org">Report this technical issue</a> or view known technical issues.</li>
                </ul>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->

	<div class="support clearfix">
    	<p>Help FIRE protect the speech rights of students and faculty.</p>
        <a href="<?php echo home_url( '/donate' ); ?>">Support FIRE</a>
    </div>
</div>

<?php get_footer(); ?>