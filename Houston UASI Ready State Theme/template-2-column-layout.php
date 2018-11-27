<?php /* Template Name: 2 Column layout */ ?>
<?php get_header(); ?>
<?php $two_col = get_theme_mod( 'huasi_column_layout_2' ) ?>

<div class="houston-section houston-group houston-3-column-layout">
  <div class="houston-col houston-2-3">
  <div class="" style="width: 100%"><?php ($two_col['two_col_1'] == 'below') ? dynamic_sidebar('col-lay-1') : get_template_part('content', 'page') ?></div>
  <div class="" style="width: 100%"><?php ($two_col['two_col_1'] == 'below') ? get_template_part('content', 'page') : dynamic_sidebar('col-lay-1') ?></div>
  </div>
  <div class="houston-col houston-1-3"><?php ($two_col['two_col_3'] == 'widget_area') ? dynamic_sidebar('col-lay-2') : dynamic_sidebar('sidebar') ?></div>
</div>
<?php get_footer(); ?>
