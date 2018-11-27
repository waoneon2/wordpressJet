(function($){
	$( document ).ready(function() {
  		$('ul.nav > li').has('ul').addClass('parent_have_child');
  		$('.parent_have_child a').first().addClass('dropdown-toggle').attr('data-toggle','dropdown');
  		$('li.menu-item-has-children > a').addClass('dropdown-toggle').attr('data-toggle','dropdown');
  		$('.parent_have_child > a:first-child').append('<b class="caret"></b>');
  		$( "li.menu-item-has-children").not('.parent_have_child').addClass( "dropdown dropdown-submenu" );

  		$('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
			event.preventDefault(); 
			event.stopPropagation(); 
			$(this).parent().siblings().removeClass('open');
			$(this).parent().toggleClass('open');
		});
		var get_length_breadcrumbs = $('div#breadcumb_nav ul.breadcrumbs').length;
		if(get_length_breadcrumbs === 0){
			$('div#breadcumb_nav').hide();
		}
	});
})(jQuery)