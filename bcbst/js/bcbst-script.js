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
	});
})(jQuery)
