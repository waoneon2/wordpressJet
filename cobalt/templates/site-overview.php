<?php
/*
Template Name: Mailing List

*/

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<div class="container page-form-container">
		<div class="content-custompage-width">
			<?php
			//$category = get_category(42);
			//print_r($category);
			while ( have_posts() ) : the_post(); ?>
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header><!-- .entry-header -->
				<?php

				$menu_name = 'primary';
				$locations = get_nav_menu_locations();
				$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );

		    $menus = wp_get_nav_menu_items( $menu->term_id, array( 'order' => 'DESC' ) );
		    //print_r($menus); ?>
		    <ul class="overview-nav">
		      <?php
		      $count = 0;
		      $submenu = false;

		      foreach( $menus as $item ):
		      	//print_r(cobalt_get_childpost($item))
		        // set up title and url
		        $title = $item->title;
		        $link = $item->url;

		        // item does not have a parent so menu_item_parent equals 0 (false)
		        if ( !$item->menu_item_parent ):
		          // save this id for later comparison with sub-menu items
		        $parent_id = $item->ID; ?>
		        <li class="item">
		        <a href="<?php echo $link; ?>" class="title">
		          <?php echo $title; ?>
		        </a>
		        <?php endif; ?>

		          <?php if ( $parent_id == $item->menu_item_parent ): ?>
		            <?php if ( !$submenu ): $submenu = true; ?>
		            <ul class="sub-menu">
		            <?php endif; ?>
		              <li class="item">
		                <a href="<?php echo $link; ?>" class="title"><?php echo $title; ?></a>
		                <ul class="sub-menu-list"><?php echo cobalt_get_childpost($item) ?></ul>
		              </li>
		            <?php if ( $menus[ $count + 1 ]->menu_item_parent != $parent_id && $submenu ): ?>
		            </ul>
		            <?php $submenu = false; endif; ?>
		          <?php endif; ?>
		        <?php if ( @$menus[ $count + 1 ]->menu_item_parent != $parent_id ): ?>
		        </li>
		        <?php $submenu = false; endif; ?>

		      <?php $count++; endforeach; ?>
		    </ul>
				<?php
			endwhile; // End of the loop.
			?>
			</div><!-- .content-custompage-width -->
		</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
// get_sidebar();
get_footer();

function cobalt_get_childpost($menu) {
	$data = '';
	switch ($menu->type) {
		case 'post_type_archive':

			$args = array(
			  'post_type'   => $menu->object,
			  'post_status' => 'publish',
			  'posts_per_page' => -1
			);
			$post_type_archive = get_posts($args);

			foreach ($post_type_archive as $key => $value) {
				$meta_abouturl = get_post_meta( $value->ID, '_meta_abouturl', true );
				$data .= '<li>
					<!--img src="'.get_template_directory_uri() . '/libs/img/link-chain.png'.'"-->
					<a href="'.esc_url($meta_abouturl).'">'.$value->post_title.'</a>
					<span>('.date_i18n( 'F j, Y', strtotime($value->post_date)).')</span>
				</li>';
			}

			break;

		default:
			# code...
			break;
	}
	return $data;
}
