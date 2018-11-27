( function( $ ) {
  $( document ).ready(function() {
    $('.nav-with-js .menu-item-has-children a').first().addClass('dropdown-toggle').attr('data-toggle','dropdown');
    $('.nav-with-js li.menu-item-has-children > a').addClass('dropdown-toggle').attr('data-toggle','dropdown');
    $('.nav-with-js .menu-item-has-children > a:first-child').append('<b class="caret"></b>');
    $( ".nav-with-js li.menu-item-has-children").not('.parent_have_child').addClass( "dropdown dropdown-submenu" );

    $('.nav-with-js ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
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

    $( '.cycle-slideshow' ).cycle().on('cycle-update-view', function(event, optionHash, slideOptionsHash, currentSlideEl) {
        if (!currentSlideEl.getAttribute('data-cycle-title')) {
            slideOptionsHash.overlayTemplate = '';
        } else { 
            slideOptionsHash.overlayTemplate = '<div class=inner><h3 class=title>{{title}}</h3><div class=desc>{{desc}}</div></div>';
        }
    });
    
    if($('ol.breadcrumb').length !== 0){
      $('ol.breadcrumb li').filter(function() {
        return $.trim($(this).text()) === '' && $(this).children().length == 0
      }).remove()
    }
    
  });
} )( jQuery );
