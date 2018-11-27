<?php
/**
 * The sidebar containing the secondary widget area, displays on posts and pages.
 *
 * If no active widgets in this sidebar, it will be hidden completely.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
global $post_ID;

$categories = get_the_category();
$thetorch = 0;

foreach($categories as $cat){
	
	if($cat->term_id == 8) {
		$thetorch++;
	}
}

if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
	<div id="tertiary" class="sidebar-container" role="complementary">
		<div class="sidebar-inner">
			<div class="widget-area">
				<?php

				wp_nav_menu( array(
						'theme_location' => 'third',
						'menu_class' => 'nav-menu',
						'walker' => new description_walker() )
				);
				
				$url = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
				
				if ( $post->ID == 108767 || $post->ID == 109420 || $thetorch > 0 && strpos($url, "/author/") === false || strpos($url, "/torch/") !== false) {
					?>
                    <select name="archive-dropdown" class="archive-dropdown" onchange="document.location.href=this.options[this.selectedIndex].value;">
                      <option value=""><?php echo esc_attr( __( 'Select Month' ) ); ?></option> 
                      <?php wp_get_archives( array( 'type' => 'monthly', 'format' => 'option', 'show_post_count' => 1, 'cat' => 8 ) ); ?>
                    </select>
                    <?php
				}
				?>
            	<?php //firecomps_get_sidebar_navigator($post_ID); ?>

				<?php dynamic_sidebar( 'sidebar-2' ); ?>
 				<?php if ($post_ID == 59580): ?>
                <aside id="sidebar-find-your-school" class="widget widget_form">
                	<h3 class="widget_title">Find Your School</h3>
                    <form method="get" action="<?php echo home_url('spotlight/'); ?>" id="form-find-your-school">
                      
                        <div class="fieldset">
                            <input type="text" name="x" value="Search by school name" />
                            <input type="hidden" name="y" value="" />
                            <div class="selector" data-field-name="state">
                                <strong class="selected">Select a State</strong>
                                <ul class="scroll">
                                    <li>State 1</li>
                                    <li>State 2</li>
                                    <li>State 3</li>
                                </ul>
                            </div>
                            <input type="submit" name="submit" value="GO">
                        </div>
                    </form>
                </aside>
				<?php endif; ?>
			</div><!-- .widget-area -->
		</div><!-- .sidebar-inner -->
	</div><!-- #tertiary -->
<?php endif; ?>