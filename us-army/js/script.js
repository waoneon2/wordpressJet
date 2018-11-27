( function( $ ) {
  $( document ).ready(function() {
    $('.nav-with-js .menu-item-has-children a').first().addClass('dropdown-toggle').attr('data-toggle','dropdown');
    $('.nav-with-js li.menu-item-has-children > a').addClass('dropdown-toggle').attr('data-toggle','dropdown');
    $('.nav-with-js .menu-item-has-children > a').append('<b class="caret"></b>');
    $( ".nav-with-js li.menu-item-has-children").not('.parent_have_child').addClass( "dropdown dropdown-submenu" );


    $( '.nav-with-js .dropdown' ).hover(
      function() {
        $(this).stop(true, true).delay(250).toggleClass('open');
      }, function() {
        $(this).stop(true, true).delay(250).toggleClass('open');
      }
    );

    $('.nav-with-js .dropdown').click(function() {
       $(this).removeClass('open');
    });


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


    if($('ol.breadcrumb').length !== 0){
      $('ol.breadcrumb li').filter(function() {
        return $.trim($(this).text()) === '' && $(this).children().length == 0
      }).remove()
    }

    $('ul.cycle-slideshow').on('cycle-update-view', function(e, optionHash, slideOptionsHash, currSlideEl) {
        var index = optionHash.currSlide;
        var myindex = index +1;
        $("#counterIndex").html(myindex);
    });
  });
} )( jQuery );
