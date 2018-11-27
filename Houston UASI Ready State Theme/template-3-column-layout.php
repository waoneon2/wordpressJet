<?php /* Template Name: 3 Column layout */ ?>
<?php get_header(); ?>
<?php $tri_col = get_theme_mod( 'huasi_column_layout_3' ) ?>
<div class="houston-section houston-group houston-3-column-layout">
  <div class="houston-col houston-1-3"><?php ($tri_col['tri_col_1'] == 'widget_area') ? dynamic_sidebar('col-lay-1') : get_template_part('content', 'page') ?></div>
  <div class="houston-col houston-1-3"><?php ($tri_col['tri_col_2'] == 'page_content') ? get_template_part('content', 'page') : dynamic_sidebar('col-lay-2') ?></div>
  <div class="houston-col houston-1-3"><?php ($tri_col['tri_col_3'] == 'widget_area') ? dynamic_sidebar('col-lay-3') : dynamic_sidebar('sidebar') ?></div>
</div>
<?php get_footer(); ?>
