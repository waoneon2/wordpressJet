/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */

(function($){
	$( document ).ready(function() {
  		$('ul.nav > li').has('ul').addClass('parent_have_child');
  		$('.parent_have_child a').first().addClass('dropdown-toggle').attr('data-toggle','dropdown');
  		$('li.menu-item-has-children > a').addClass('dropdown-toggle').attr('data-toggle','dropdown');
  		$('.parent_have_child > a:first-child').append(' <span class="caret"></span>');
  		$( "li.menu-item-has-children").not('.parent_have_child').addClass( "dropdown dropdown-submenu" );
  	
  		$('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
			event.preventDefault(); 
			event.stopPropagation(); 
			$(this).parent().siblings().removeClass('open');
			$(this).parent().toggleClass('open');
		});
	});
})(jQuery)