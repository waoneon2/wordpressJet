<div class="wrapper clearfix">
	<div class="banner-home">
    	
        <section class="slider">
            <div class="flexslider">
                <ul class="slides">

                <?php firecomps_home_banner(); ?>
        
                <ul>
            </div>
        </section>
    


    </div>




    <?php firecomps_home_featured(); ?>
</div>

<section id="find-your-school" class="maps-home">
    <div class="wrapper clearfix">
        <header>Find Your School<span>Use the search to find your school's free speech rating</span></header>
        <form method="get" action="<?php echo home_url('spotlight/'); ?>" id="form-find-your-school">
            <span>or</span>
            <div class="fieldset">
                <input type="text" name="x" value="Search by school name" onblur="if(this.value==''){this.value='Search by school name';}" onfocus="if(this.value=='Search by school name'){this.value='';}" />
                <input type="hidden" name="y" value="" />
                <div class="selector" data-field-name="state">
                    <strong class="selected">Select a State</strong>
                    <ul class="scroll">
                        <li>State 1</li>
                        <li>State 2</li>
                        <li>State 3</li>
                    </ul>
                </div>
                <input class="small" type="submit" name="submit" value="Search" />
            </div>
        </form>
        <div id="maps-for-finding-your-school" class="dark"></div>
    </div>
</section>

<?php firecomps_home_recent(); ?>

<div class="registry-home">
	<div class="wrapper clearfix">
    	<section>
        	<header>FIRE Student Network (FSN)<span>Support free speech on your campus</span></header>
            <p>The FIRE Student Network (FSN) is a coalition of students and faculty members who recognize the importance of advancing civil liberties on their campuses. Signing up for the FSN is free!</p>
        </section>
        <!--
        <form method="post" action="#">
        	<input type="text" name="name" value="Your Name" />
            <input type="text" name="email" value="Email" />
            <input type="text" name="school" value="Your School" />
            <input type="text" name="year" value="Graduation Year" />
            <input type="submit" name="submit" value="Become a CFN Member!" />
        </form>
		-->
        <?php echo do_shortcode('[Formstack id=1650921 viewkey=yunpckZogp]'); ?>

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

<script type="text/javascript">
	( function( $ ) {
		<?php if(date('Y-m-d h:i') > "2014-07-01 17:55") { echo '$(".popup.add").fadeIn("slow");'; }  ?>
	} )( jQuery );
</script>
