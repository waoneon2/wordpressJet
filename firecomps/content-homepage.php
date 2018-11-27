<div class="wrapper clearfix">
	<div class="banner-home">
    	<?php firecomps_home_banner(); ?>
    </div>

    <?php firecomps_home_featured(); ?>
</div>

<section id="find-your-school" class="maps-home">
    <div class="wrapper clearfix">
        <header>Find Your School<span>Click your state in the map to find your school</span></header>
        <form method="get" action="<?php echo home_url('/resources/spotlight-database'); ?>" id="form-find-your-school">
            <span>or</span>
            <div class="fieldset">
                <input type="text" name="x" value="Search by school name" />
                <input type="hidden" name="y" value="" />
                <div class="selector">
                    <strong class="selected">Select a State</strong>
                    <ul>
                        <li>State 1</li>
                        <li>State 2</li>
                        <li>State 3</li>
                    </ul>
                </div>
            </div>
        </form>
        <div id="maps-for-finding-your-school" class="dark"></div>
    </div>
</section>

<?php firecomps_home_recent(); ?>

<div class="registry-home">
	<div class="wrapper clearfix">
    	<section>
        	<header>Campus Freedom Network<span>Support free speech on your campus</span></header>
            <p>The Campus Freedom Network (CFN) is a loosely-knit coalition of faculty members and students dedicated to advancing individual liberties on their campuses. Its goal is to encourage energetic students and faculty members to pressure their administrations to change illiberal and unconstitutional policies. By organizing students and faculty, the CFN strives to change the culture of censorship on college campuses from the inside.</p>
        </section>
        <form method="post" action="#">
        	<input type="text" name="name" value="Your Name" />
            <input type="text" name="email" value="Email" />
            <input type="text" name="school" value="Your School" />
            <input type="submit" name="submit" value="Become a CFN Member!" />
        </form>
    </div>
</div>

<?php firecomps_home_defend(); ?>

<?php firecomps_home_video(); ?>

<div class="aboutus-home">
	<div class="wrapper clearfix">
    	<section class="clearfix">
        	<header>About Us</header>
            <p>The mission of FIRE is to defend and sustain individual rights at America's colleges and universities. These rights include freedom of speech, legal equality, due process, religious liberty, and sanctity of conscience — the essential qualities of individual liberty and dignity. FIRE's core mission is to protect the unprotected and to educate the public and communities of concerned Americans about the threats to these rights on our campuses and about the means to preserve them. </p>
            <footer><a href="<?php echo home_url( '/about-us' ); ?>" class="more">MORE ABOUT FIRE</a></footer>
        </section>
        
        <div class="support clearfix">
        	<p>Help FIRE protect the speech rights of students and faculty.</p>
            <a href="<?php echo home_url( '/donate' ); ?>">Support FIRE</a>
        </div>
    </div>
</div>