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
				  <?php 
					 $static_text = "Static Link";
					 $static_link = esc_url("//corporate.exxonmobil.com");
					 $static_logo = "fa-globe";

					 if(get_theme_mod('exxon_static_link_text')){
						$static_text = get_theme_mod('exxon_static_link_text');
					 }
					 if(get_theme_mod('exxon_static_link_url')){
						 $static_link = get_theme_mod('exxon_static_link_url');
					 }
					 if(get_theme_mod('exxon_static_link_logo')){
						 $static_logo = get_theme_mod('exxon_static_link_logo');
					 }
				  ?>
					<a target="_blank" href="<?php echo $static_link; ?>">
					<i class="fa <?php echo $static_logo; ?>" id="logo-static-link"></i>
					<span class="select-country"><?php echo $static_text; ?></span>
					</a>
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
