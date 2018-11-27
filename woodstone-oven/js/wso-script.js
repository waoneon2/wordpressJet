(function($){
	$( document ).ready(function() {
		$('ul.nav.on-mobile-menu li').has('ul').addClass('parent_have_child');
		$('.parent_have_child a').first().addClass('dropdown-toggle').attr('data-toggle','dropdown');
		$('ul.on-mobile-menu li.menu-item-has-children > a').addClass('dropdown-toggle').attr('data-toggle','dropdown');
		$('.parent_have_child > a:first-child').append('<b class="caret"></b>');
		$( "ul.on-mobile-menu li.menu-item-has-children").not('.parent_have_child').addClass( "dropdown dropdown-submenu" );

		$('li.parent_have_child > a.dropdown-toggle').on('click', function(event) {
			event.preventDefault();
			event.stopPropagation();
			$(this).parent().siblings().removeClass('open');
			$(this).parent().toggleClass('open');
		});

		gform.addFilter( 'gform_datepicker_options_pre_init', function( optionsObj, formId, fieldId ) {
			// console.log(formId);
			// console.log(fieldId);
			console.log(optionsObj);
		    if ( formId == 7 && fieldId == 3 ) {
		        var disabledDays = ['12/24/2018', '12/25/2018'];
		        optionsObj.beforeShowDay = function(date) {
		            var checkdate = jQuery.datepicker.formatDate('mm/dd/yy', date);
		            console.log(checkdate);
		            return [disabledDays.indexOf(checkdate) == -1];
		        };
		    }
		    return optionsObj;
		});
	});
})(jQuery)
