jQuery.fn.placeholder = function($) {
	var value = $(this).val();
	if (value == '' || value == null) return;
	
	$(this).focus(function() {
		if ($(this).val() == value) $(this).val('');
	});
	
	$(this).blur(function() {
		if ($(this).val() == '') $(this).val(value);
	});
};