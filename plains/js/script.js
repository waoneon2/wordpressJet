( function( $ ) {
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

		var get_arrow = $('.cycle-slideshow.home-slides img').length;
		if(get_arrow === 0 || get_arrow === 1) {
			$('.cycle-prev').hide();
			$('.cycle-next').hide();
		}

		var eadv = $('#jetty_advance_search_filter').length;
		 if(eadv !== 0) {

		    config = {
		        inputField  : "f_sd",
		        ifFormat  : "%m/%d/%Y",
		        button    : "cal_trigger_1",
		        singleClick : true,
		        showOthers  : true,
		        align   : "Bl",
		        cache   : false
		    }
		    Calendar.setup(config);

		    config = {
		      inputField  : "f_ed",
		        ifFormat  : "%m/%d/%Y",
		        button    : "cal_trigger_2",
		        singleClick : true,
		        showOthers  : true,
		        align   : "Bl",
		        cache   : false
		    }
		    Calendar.setup(config);
		}
	});
} )( jQuery );