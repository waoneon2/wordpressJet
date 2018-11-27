<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
</div><!-- #second-container -->
</article><!-- article -->
	</div><!-- #content .container-fluid -->
	<footer id="colophon footer" role="contentsinfo">
	<div class="container-fluid">
		<section id="footer-top" class="row">
			<div class="footer-l-side col col-xs-12 col-sm-8 col-md-8">
				<nav id="footer-nav" class="navbar">
			      <div class="no-padding" id="btm-menu">
			        <?php
	                    wp_nav_menu( array(
	                        'menu'              => 'footer_nav_one',
	                        'theme_location'    => 'footer_nav_one',
	                        'container'         => false,
	                        'menu_class'        => 'menu1 nav navbar-nav clearfix'
	                        )
	                    );
                	?>
			      </div>
			    </nav>
			    <div class="nav-select-country">
			      <div class="pull-left">
			      	<?php if(get_theme_mod('exxon_static_link_text') != 'Static Link') : ?>
                	<?php if(get_theme_mod('exxon_static_link_url') != 'corporate.exxonmobil.com') : ?>
                		<a href="<?php echo esc_url(get_theme_mod('exxon_static_link_url')); ?>" target="_blank">
            		<?php else : ?>
                		<a href="http://corporate.exxonmobil.com/" target="_blank">
            		<?php endif; ?>
            		<?php if(get_theme_mod('exxon_static_link_logo') != 'fa-globe') : ?>
                		<i class="fa <?php echo get_theme_mod('exxon_static_link_logo'); ?>" id="logo-static-link"></i>
            		<?php else : ?>
                		<i class="fa fa-globe" id="logo-static-link"></i>
            		<?php endif; ?>
                		<span class="select-country"><?php echo get_theme_mod('exxon_static_link_text'); ?></span>
                		</a>
            		<?php else : ?>
		                <a target="_blank" href="http://corporate.exxonmobil.com/">
					    <i class="fa fa-globe" id="logo-static-link"></i>
					    <span class="select-country">Select country</span>
					    </a>
            		<?php endif; ?>

			      </div>
			    </div>
			</div>
			<div class="footer-r-side col col-xs-12 col-sm-4 col-md-4">
				<div class="nav navbar-nav navbar-right">
			      <form class="navbar-form" role="search" method="get" action="<?php echo home_url( '/' ); ?>">
			        <div class="input-group">
			          <input type="text" class="form-control" placeholder="Search" name="s" alt="Search">
			            <div class="input-group-btn">
			              <button class="btn btn-default" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
			          </div>
			        </div>
			      </form>
			    </div>
			</div>
		</section>
		<section id="footer-btm" class="row">
			<div class="col col-xs-12 col-sm-6 col-md-6 pull-left">
				<div class="logos">
					<a href="<?php echo home_url( '/' ); ?>">ExxonMobil</a>
				</div>
			</div>
			<div class="col col-xs-12 col-sm-6 col-md-6 pull-right text-right">
				<div class="row">
					<div class="col-md-12">
						<nav class="bottom-nav pull-right">
					        <?php
			                    wp_nav_menu( array(
			                        'menu'              => 'footer_nav_two',
			                        'theme_location'    => 'footer_nav_two',
			                        'container'         => false,
			                        'menu_class'        => 'menu2 footer_nav_two'
			                        )
			                    );
		                	?>
				        </nav>
					</div>
					<div class="col-md-12">
						<div class="copyright">
							<ul class="list-unstyled list-inline text-right">
					          <li><?php printf( esc_html__( '&copy; Copyright %s-%s %s', 'exxon' ), '2003', date("Y"), 'Exxon Mobil Corporation' ); ?></li>
					          <li> - </li>
							  <li><?php printf( '<a href="%s" title="%s">%s</a>', 'http://jettyapp.com','Jetty','Proudly powered by Jetty' ); ?></li>
					        </ul>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
