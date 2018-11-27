<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package aramco
 */
function custom_search_form(){
	echo '<div class="searchSection custom-search">';
	echo '<form role="search" method="get" class="search-form-custom" action="'.home_url( '/' ).'">';
    echo '<div class="searchBarContainer"><div class="searchSectionGroup"><div class="field"><label>';
    echo '<span class="screen-reader-text">'. _x( 'Search for:', 'label' ).'</span>';
    echo '<input type="search" class="search-field-custom"
            placeholder="'.esc_attr_x( 'Search …', 'placeholder' ).'"value="'.get_search_query().'" name="s"
            title="'.esc_attr_x( 'Search for:', 'label' ).'" />';
    echo '</label>';
    echo '<button class="search-submit-custom" value="'.esc_attr_x( 'Search', 'submit button' ).'" ><span aria-hidden="true" data-icon="&#58880;"></span></button></div></div></div>';
	echo '</form></div>';
}
?>
<div class="card whiteTheme">
<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'aramco' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'aramco' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'aramco' ); ?></p>
			<?php
				custom_search_form();

		else : ?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'aramco' ); ?></p>
			<?php
				custom_search_form();

		endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
</div>