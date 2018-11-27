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
if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
	<div id="tertiary" class="sidebar-container" role="complementary">
		<div class="sidebar-inner">
			<div class="widget-area">
            	<?php firecomps_get_sidebar_navigator($post_ID); ?>
				<?php dynamic_sidebar( 'sidebar-2' ); ?>
                <?php if ($post_ID == 8): ?>
                <aside id="sidebar-find-your-school" class="widget widget_form">
                	<h3 class="widget_title">Find Your School</h3>
                    <form method="get" action="<?php echo home_url('/resources/spotlight-database'); ?>">
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
                    </form>
                </aside>
				<?php endif; ?>
			</div><!-- .widget-area -->
		</div><!-- .sidebar-inner -->
	</div><!-- #tertiary -->
<?php endif; ?>