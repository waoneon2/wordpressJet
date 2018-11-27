( function( $ ) {

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

	$(window).bind("load", function() { 
       
      var $footer_id = $("#colophon"),
        $content_id = $("#content");
      var h = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
           
       footerSticky();
       
       function footerSticky() {

           if($("body").height() <= h){
           		$footer_id.css({
           			position : "absolute",
           			width : "100%",
           			bottom : "0"
           		});
           	} else {
           		$footer_id.css({
                position: "static"
              });
           	}      
       }

       $(window).scroll(footerSticky)
       $(window).resize(footerSticky)   
	});

} )( jQuery );