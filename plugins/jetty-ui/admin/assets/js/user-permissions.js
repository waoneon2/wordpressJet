(function($) {
	$(function() {
		// Expand to show role information once role name is clicked
		$('.role__name').click(function() {
			$(this).parents('.role').toggleClass('role--active');
		});
	});
})(jQuery);