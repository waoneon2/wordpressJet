<div class="wrapper clearfix">
	<div class="site-breadcrumbs single-breadcrumbs">
    	<?php if(function_exists('bcn_display')) bcn_display(); ?>
    </div>
    <article class="post-20 page type-page status-publish hentry" id="post-20">
        <header class="entry-header">Welcome to FIRE’s Spotlight Database</header>
        <div class="entry-content">
        	<p><em>Welcome to FIRE’s Spotlight: The Campus Freedom Resource, where you will find comprehensive information on the state of liberty on America’s campuses. Use FIRE’s Spotlight to find pages for individual academic institutions, which contain relevant links to our research of speech codes, case materials from FIRE’s Individual Rights Defense Program, media coverage of FIRE’s work, and entries from FIRE’s blog, <a href="#">The Torch</a>.</em></p>
        </div>
    </article>
    
    <section id="page-find-your-school">
        <header>Find Your School</header>
        <p>Please refer to “<a href="#">Using FIRE’s Spotlight</a>” for instructions on how best to find the information you want.</p>
        <div id="maps-for-finding-your-school" class="zoom-4"></div>
        <form method="get" action="<?php echo home_url('/resources/spotlight-database'); ?>" id="form-find-your-school">
        	<h3>Search by School Name or State</h3>
            <div class="row clearfix">
                <input type="text" name="x" value="Search by school name" />
                <input type="hidden" name="y" value="" />
                <input type="submit" name="submit" value="GO" />
            </div>
            <div class="row clearfix">
                <div class="selector">
                    <strong class="selected">Select a State</strong>
                    <ul>
                        <li>State 1</li>
                        <li>State 2</li>
                        <li>State 3</li>
                    </ul>
                </div>
                <input type="submit" name="submit" value="GO" />
            </div>
            <div class="row">
                <p><a href="#">Advanced Search</a> • <a href="<?php echo home_url('/supported-schools'); ?>">List All Schools</a></p>
            </div>
        </form>
    </section>
</div>

<div class="support clearfix">
	<p>Help FIRE protect the speech rights of students and faculty.</p>
    <a href="<?php echo home_url( '/donate' ); ?>">Support FIRE</a>
</div>