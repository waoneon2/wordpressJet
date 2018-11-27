<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package staytohelp
 */

get_header(); ?>

<div class="error">
		<div class="error-code m-b-10">404 <i class="fa fa-warning"></i></div>
		<div class="error-content">
			<div class="error-message"><?php _e("Sorry, we couldn't find it...","sth"); ?></div>
			<div class="error-desc m-b-20">
				<?php _e("The page you're looking for doesn't exist.","sth"); ?>
			</div>
			<div>
				<a href="<?php echo esc_url(home_url( "/" )); ?>" class="btn btn-warning"><?php _e("Go to Home Page","sth"); ?></a>
			</div>
            <div>
                <a href="<?php echo esc_url(home_url( "/" )); ?>"><img src="<?php echo get_template_directory_uri() . '/images/header_logo.png' ?>" class="m-t-40"></a>
            </div>
		</div>
	</div>

<?php
get_footer();
