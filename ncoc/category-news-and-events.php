<?php
/**
 * The template for displaying category news and events.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package NCOC
 */

get_header('news');
$getdate = getdate();
$getAllYear = [];
$valInc = 0;
$args = array(
    'category_name' => 'news-and-events',
    'post_type' => array('post'),
    'post_status' => array('publish'),
    'posts_per_page' => -1,
    'orderby' => 'date',
	'year' => $getdate['year']

);
$query = new WP_Query( $args );

$args_all = array(
    'category_name' => 'news-and-events',
    'post_type' => array('post'),
    'post_status' => array('publish'),
    'posts_per_page' => -1,
	'order' => 'ASC',
    'orderby' => 'date'

);
$query_all = new WP_Query( $args_all );
if( $query_all->have_posts() ) {
    while( $query_all->have_posts() ) {
      $query_all->the_post();
      $year = get_the_date( 'Y' );
      if ( ! isset( $years[ $year ] ) ) $years[ $year ] = array();
      $years[ $year ][] = array( 'title' => get_the_title(), 'permalink' => get_the_permalink() );
      $getAllYear[$valInc] = $year;

      $valInc++;
    }
}

if(!empty($getAllYear)){
	update_option( 'ncoc_last_year_on_post', end($getAllYear) );
}

if(!$query->have_posts()){
	$args_old = array(
		'category_name' => 'news-and-events',
		'post_type' => array('post'),
		'post_status' => array('publish'),
		'posts_per_page' => -1,
		'orderby' => 'date',
		'year' => get_option( 'ncoc_last_year_on_post', $getdate['year'] - 1)
	);
	$query = new WP_Query( $args_old );
}

wp_reset_postdata();

?>
<div class="archive_by_year col-md-12">
		<p class="on_list_archive">
			<?php echo __('<strong>News and Events Archives:</strong>&nbsp;&nbsp;', 'ncoc' ); 
			foreach ($years as $key => $value) {
				if($key == $getdate['year']){
					echo '<a href="#" id="on_year_'.$key.'" class="year_nav on_select" data-nonce="'.wp_create_nonce( 'cat_ne_year_nonce' ).'" data-year='.$key.'>'.$key.'</a><span class="sep"> | </span>';
				} 
				elseif ($key == end($getAllYear)) {
					echo '<a href="#" id="on_year_'.$key.'" class="year_nav on_select" data-nonce="'.wp_create_nonce( 'cat_ne_year_nonce' ).'" data-year='.$key.'>'.$key.'</a><span class="sep"> | </span>';
				}
				else {
					echo '<a href="#" id="on_year_'.$key.'" class="year_nav" data-nonce="'.wp_create_nonce( 'cat_ne_year_nonce' ).'" data-year='.$key.'>'.$key.'</a><span class="sep"> | </span>';
				}
				
			}
			?>
		</p>
	</div>
	<div id="primary archive-news" class="content-area col-md-6">
		<main id="main" class="site-main" role="main">

		<?php
		if ( $query->have_posts() ) : ?>

			<header class="page-header-news"> 
				<?php
					if($getdate['year'] == end($getAllYear)) {
				?>
				<h1 class="page-title" id="ncoc-news-page-title"><?php _e('News and Events ', 'ncoc_news_title');?><span class="on_date"><?php _e($getdate['year'],'ncoc_year'); ?></span></h1>
				<?php 
					} else {
						?>
						<h1 class="page-title" id="ncoc-news-page-title"><?php _e('News and Events ', 'ncoc_news_title');?><span class="on_date"><?php _e(end($getAllYear),'ncoc_year'); ?></span></h1>
						<?php
					}

				?>
				<?php
					the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			echo "<div class='table-responsive'><table class='table' id='ncoc-table-news'>";
			while ( $query->have_posts() ) : $query->the_post();
				get_template_part( 'template-parts/content', 'news-and-events' );
			endwhile;
			wp_reset_postdata();
			echo "</table></div>";
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->
<!-- Sidebar -->
<div class="col-md-6 update-sidebar" id="col-of-update-sidebar">
    	<main id="main" class="site-main" role="main">
    		<header class="page-header-publication">
              <h1 class="page-title" id="ncoc-publication-page-title"><?php _e('Publications', 'ncoc'); ?></h1>
            </header><!-- .page-header -->
			<div class="col-md-3">
			<?php
            $img_publication = get_template_directory_uri(). "/images/publication.jpg";
            if(get_theme_mod("ncoc_li_publication_img")):
            $img_publication = get_theme_mod("ncoc_li_publication_img");
            endif;
            _e('<img class="img-responsive img-thumbnail icon-link" src="'.esc_url($img_publication).'"/>','ncoc_link');
            ?>
			</div>
            <div class="col-md-9">
            <?php
			 $text_pub = "Click here to the recent publication.";
            if(get_theme_mod("ncoc_li_publication_text")):
                $text_pub = get_theme_mod("ncoc_li_publication_text");
            endif;
            printf(__("<a class='news-link-update' href=%s><p>".$text_pub."</p></a>","ncoc_link"),get_cat_url( 'Publications' ));
			?>
			</div>
    	</main>

    	<main id="main" class="site-main" role="main">
    		<header class="page-header-contact">
              <h1 class="page-title" id="ncoc-publication-page-title"><?php _e('Media Team', 'ncoc'); ?></h1>
            </header><!-- .page-header -->
			<div class="col-md-3">
			<?php
            $img_contact = get_template_directory_uri(). "/images/contact.jpg";
            if(get_theme_mod("ncoc_li_contact_img")):
            $img_contact = get_theme_mod("ncoc_li_contact_img");
            endif;
            _e('<img class="img-responsive img-thumbnail icon-link" src="'.esc_url($img_contact).'"/>','ncoc_link');
            ?>
			</div>
            <div class="col-md-9">
            <?php
			$text_contact = "Click here to the recent contact.";
			if(get_theme_mod("ncoc_li_contact_text")):
                $text_contact = get_theme_mod("ncoc_li_contact_text");
            endif;
			printf(__("<a class='news-link-update' href=%s><p>".$text_contact."</p></a>","ncoc_link"),get_cat_url( 'Contacts' ));
			?>
			</div>
    	</main>
    </div>
<!--EOF Sidebar-->
	</div><!-- #content -->
	</div><!-- #col-of-content -->
	</div>

<?php
get_footer();
