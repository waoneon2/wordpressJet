<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Woodstone_Oven
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
		<div class="container" style="margin-top: 40px;">
			<div class="row">
				<div class="col-md-8">
					
						<div class="alert alert-danger" role="alert">


							  <section class="error-404 not-found">
									<header class="page-header">
										<div class="page-title">
											<h4 class="alert-heading"> 
												<?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'wso' ); ?> 
											</h4>
										</div>
									</header><!-- .page-header -->

									<div class="page-content">
										<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'wso' ); ?></p>
									</div><!-- .page-content -->
									<hr>
							  		<div class="mb-0">
							  			<?php
											get_search_form();
										?>
							  		</div>
							</section><!-- .error-404 -->
						</div>

				</div>
				<div class="col-md-4">
						<div class="card">
							<div class="card-body">
								<?php
									/* translators: %1$s: smiley */
									$wso_archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'wso' ), convert_smilies( ':)' ) ) . '</p>';
									the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$wso_archive_content" ); ?>
							</div>
						</div>
						<br>
						<div class="card">
							<div class="card-body">
								<?php 
									the_widget( 'WP_Widget_Tag_Cloud' );
								?>
								
							</div>
						</div>
						<br>


				</div>
			</div>

		</div><!-- #primary -->
		</main><!-- #main -->
</div>
<?php
get_footer();
