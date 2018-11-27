<?php
global $post_ID;
//$school_name = 'Washington State University';
$school_name = isset($_GET['x']) ? trim($_GET['x']) : '';
$search_state = isset($_GET['y']) ? trim($_GET['y']) : '';
$search_type = isset($_GET['z']) ? trim($_GET['z']) : '';
$types = array(
	'Cases' => 3,
	'Speech Codes' => 2,
	'Recent Media' => 0,
	'Commentary' => 4,
);
$type = ''; $cat_id = 0;
foreach ($types as $k => $v) if (strtolower($k) === strtolower($search_type)) { $type = $k; $cat_id = $v; break; }
if (empty($type)) { $type = 'Speech Codes'; $cat_id = 2; }
$school = firecomps_get_school_data($school_name);
if ($school):
?>
<script type="text/javascript">
<!--
function select(type) {
	var x = '<?php echo $school_name; ?>';
	var y = '<?php echo $search_state; ?>';
	var z = type;
	var url = window.location.pathname + '?x=' + escape(x) + '&y=' + escape(y) + '&z=' + escape(z) + '#list';
	window.location.href = url;
}
-->
</script>
<div class="wrapper clearfix">
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
        	<div class="site-breadcrumbs">
            	<?php if(function_exists('bcn_display')) bcn_display(); ?>
            </div>
            <section class="school-info">
            	<header><?php echo $school['name']; ?></header>
                <ul>
                	<?php if ($school['location']): echo sprintf(__('<li>Location: %s</li>', 'firecomps'), $school['location']); endif; ?>
                    <?php if ($school['website']): echo sprintf(__('<li class="sep">Website: <a href="%s">%s</a></li>', 'firecomps'), $school['website'], $school['website']); endif; ?>
                    <?php if ($school['type']): echo sprintf(__('<li>Type: %s</li>', 'firecomps'), $school['type']); endif; ?>
                    <?php if ($school['federal_circuit']): echo sprintf(__('<li>Federal Circuit: %s</li>', 'firecomps'), $school['federal_circuit']); endif; ?>
                </ul>
            </section>
            <a name="list"></a>
            <?php 
			if ($type === 'Speech Codes') {
				$level = array('Red', 'Yellow', 'Green');
				foreach ($level as $lv) {
					$query_name = 'query_' . strtolower($lv);
					$args = array(
						'cat' => $cat_id,
						'post_type' => 'post',
						'post_status' => 'publish',
						'posts_per_page' => -1,
						'orderby' => 'date',
						'order' => 'DESC',
						'meta_query' => array(
							array('key' => 'school', 'value' => $school['name'], 'compare' => '='),
							array('key' => 'rating', 'value' => strtolower($lv), 'compare' => '='),
						),
					);
					$$query_name = new WP_Query($args);
				}
				if ($query_red->have_posts()):
			?>
            <section class="warning-red-light">
            	<header>Speech Code Rating</header>
                <p>Washington State University has been given a speech code rating of Red. You may read more about this institution's speech codes at <a href="#">this page</a>.</p>
            </section>
            <?php 
				endif;
			} elseif ($type === 'Recent Media') {
				$args = array(
					'post_type' => 'video',
					'post_status' => 'publish',
					'posts_per_page' => -1,
					'orderby' => 'date',
					'order' => 'DESC',
					'meta_key' => 'school',
					'meta_value' => $school['name'],
					'meta_compare' => '='
				);
				$query = new WP_Query($args);
			} else {
				$args = array(
					'cat' => $cat_id,
					'post_type' => 'post',
					'post_status' => 'publish',
					'posts_per_page' => -1,
					'orderby' => 'date',
					'order' => 'DESC',
					'meta_key' => 'school',
					'meta_value' => $school['name'],
					'meta_compare' => '='
				);
				$query = new WP_Query($args);
			}
			?>
            <div class="search-bar">
            	<ul class="clearfix">
                <?php foreach ($types as $k => $v): ?>
                <li><a href="javascript:select('<?php echo $k; ?>');"<?php if ($type == $k) echo ' class="current"'; ?>><?php echo $k; ?></a></li>
                <?php endforeach; ?>
                </ul>
            </div>
            <?php if ($type === 'Speech Codes'):
				$level = array('Red', 'Yellow', 'Green'); 
				foreach ($level as $lv): $query = 'query_' . strtolower($lv);
					if (!$$query->have_posts()) continue;
			?>
            <section class="search-list">
            	<header style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/<?php echo strtolower($lv); ?>-light.png');"><?php echo sprintf(__('%s Light Policies'), $lv); ?></header>
                <ul>
                	<?php while ($$query->have_posts()): $$query->the_post(); ?>
                	<li>
                    	<div class="item">
                        	<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                            <p class="category">Speech Code Category: <?php echo get_the_category_list( __( ', ', 'firecomps' ) ); ?></p>
                            <?php the_excerpt(); ?>
                            <p><a href="<?php the_permalink(); ?>" class="more">&raquo; View Full Policy</a></p>
                        </div>
                    </li>
					<?php endwhile; ?>
                </ul>
            </section>
            <?php
				endforeach;
			?>
            <?php else: ?>
            <?php if ($query->have_posts()): ?>
            <section class="search-list">
            	<ul>
                	<?php while ($query->have_posts()): $query->the_post(); ?>
                    <li>
                    	<div class="item">
                        	<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                            <?php $_cat = get_the_category_list( __( ', ', 'firecomps' ) ); if($_cat): ?>
                            <p class="category">Category: <?php echo get_the_category_list( __( ', ', 'firecomps' ) ); ?></p>
                            <?php endif; ?>
                            <?php the_excerpt(); ?>
                            <p><a href="<?php the_permalink(); ?>" class="more">&raquo; View Full Policy</a></p>
                        </div>
                    </li>
                    <?php endwhile; ?>
                </ul>
            </section>
            <?php endif; ?>
            <?php endif; ?>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
	<div class="support clearfix">
    	<p>Help FIRE protect the speech rights of students and faculty.</p>
        <a href="<?php echo home_url( '/donate' ); ?>">Support FIRE</a>
    </div>
</div>
<?php else: ?>
	<?php get_template_part( 'content', 'search' ); ?>
<?php endif; ?>