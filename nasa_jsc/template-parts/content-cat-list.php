<?php
/**
 * Template part for displaying Category list
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Nasa_JSC
 */

?>
<div class="col-md-12 clearfix">
		<div class="doc-list-full-item clearfix">
			<div class="col-md-10 col-sm-10">
				<small><?php the_time('F j, Y');?></small>
				<h3 class="entry-title">
					<a href="<?php echo esc_url(get_permalink());?>" rel="bookmark" >
						<?php the_title();?>
					</a>
				</h3>
			</div>
			<?php if (is_search()): ?>
				<div class="col-md-2 col-sm-2">
				    <div class="pull-right">
				        <span class="label label-warning"><?php the_category( ', ' ); ?></span>
				    </div>
				</div>
			<?php endif ?>
		</div>
	</div>
