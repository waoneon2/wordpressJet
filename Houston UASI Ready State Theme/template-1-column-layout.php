<?php /* Template Name: 1 Column layout */ ?>
<?php get_header(); ?>
<?php $one_col = get_theme_mod( 'huasi_column_layout_1' ) ?>
<div class="houston-section houston-group houston-3-column-layout page-full-width">
  <div class="" style="width: 100%"><?php ($one_col['one_col_1'] == 'below') ? dynamic_sidebar('col-lay-1') : get_template_part('content', 'page') ?></div>
  <div class="" style="width: 100%"><?php ($one_col['one_col_1'] == 'below') ? get_template_part('content', 'page') : dynamic_sidebar('col-lay-1') ?></div>
</div>
<?php get_footer(); ?>
