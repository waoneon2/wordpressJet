<?php $houston_uasi_options = houston_uasi_theme_options(); ?>
</div>
<footer class="houston-footer" itemscope="itemscope" itemtype="http://schema.org/WPFooter">
	<?php dynamic_sidebar('footer-ad'); ?>
	<div class="wrapper-inner clearfix">
		<?php if (is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3')) { ?>
			<div class="houston-section houston-group footer-widgets">
				<?php if (is_active_sidebar('footer-1')) { ?>
					<div class="houston-col houston-1-3 footer-1">
						<?php dynamic_sidebar('footer-1'); ?>
					</div>
				<?php } ?>
				<?php if (is_active_sidebar('footer-2')) { ?>
					<div class="houston-col houston-1-3 footer-2">
						<?php dynamic_sidebar('footer-2'); ?>
					</div>
				<?php } ?>
				<?php if (is_active_sidebar('footer-3')) { ?>
					<div class="houston-col houston-1-3 footer-3">
						<?php dynamic_sidebar('footer-3'); ?>
					</div>
				<?php } ?>
			</div>
		<?php } ?>
	</div>
	<div class="footer-bottom">
		<div class="wrapper-inner clearfix">
			<?php if (has_nav_menu('footer_nav')) { ?>
				<nav class="footer-nav clearfix" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
					<?php wp_nav_menu(array('theme_location' => 'footer_nav', 'fallback_cb' => '')); ?>
				</nav>
			<?php } ?>
			<div class="copyright-wrap">
				<p class="copyright">
					<?php echo empty($houston_uasi_options['copyright']) ? sprintf(__('Copyright %1$s | Houston UASI Ready State Theme by %2$s', 'houston-uasi'), date("Y"), '<a href="' . esc_url('http://jettyapp.com') . '" title="Premium Magazine WordPress Themes" rel="nofollow">Jetty</a>') : $houston_uasi_options['copyright']; ?>
				</p>
			</div>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>