(function($){
	$( document ).ready(function() {
    jQuery(".cs-search #searchsubmit").prop('value', ' 🔍 ');
    jQuery(".cs-search #s").prop('placeholder', 'Search...');

    function isInt(n) {
       return n % 1 === 0;
    }
    var get_length_aside = $("div.sidebar-tmp2.row div.col-md-12 aside").length;
    if(get_length_aside !== 1){
        var get_avg = get_length_aside/2;
        // media query event handler
        if (matchMedia) {
          var mq = window.matchMedia("(min-width: 600px)");
          mq.addListener(WidthChange);
          WidthChange(mq);
        }

        // media query change
        function WidthChange(mq) {
          if (mq.matches) {
            if(!isInt(get_avg)){
                $("div.sidebar-tmp2.row div.col-md-12 aside").last().attr("style","display:inline-table !important; width: 49%; width: calc(50% - 2px); padding-left: 15px;");
            }
          } else {
            // window width is less than 600px
            if(!isInt(get_avg)){
                $("div.sidebar-tmp2.row div.col-md-12 aside").last().attr("style","display:block !important; width: 100%; width: 100%; padding-left: 0;");
            }
          }
        }
    }

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

	$('.cycle-slideshow').cycle().on('cycle-update-view', function(event, optionHash, slideOptionsHash, currentSlideEl) {
    if (!currentSlideEl.getAttribute('data-cycle-desc') && !currentSlideEl.getAttribute('data-title')) {
        slideOptionsHash.overlayTemplate = '';
    } else {
        slideOptionsHash.overlayTemplate = "<div id='slideshow-text'><div class='slide-item'><h4 class='doc-head'>{{title}}</h4><p>{{desc}}</p><p class='more-link'><a href='{{link}}'>{{textlink}}</a></p></div></div>";
    }
    });

  // add class for frontpage widget
  $('.front-exxon-sidebar  aside').addClass('col col-xs-12 col-sm-6 col-md-6 col-lg-3 clearfix');

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
  $('.search-wrapper').click(function() {
      $(this).toggleClass("_active");
      if($('.search-wrapper').hasClass('_active')) {
          //$(this).children().removeClass('fa-search');
          $(this).children().toggleClass('fa-times');
          $(this).children().toggleClass('fa-search');
          $('.site-search-form').addClass('_show'),
          $('.site-cover').addClass('_show');
      } else {
          $(this).children().toggleClass('fa-times');
          $(this).children().toggleClass('fa-search');
          $('.site-search-form').removeClass('_show'),
          $('.site-cover').removeClass('_show');
      }
  });


})(jQuery)
