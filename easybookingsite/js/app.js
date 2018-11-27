(function ($) {
  'use strict';

  function handleHomeContentHeight() {
    $('#home').height($(window).height());
  }

  $(window).resize(function() {
    if (window.matchMedia('(min-width: 768px)').matches) {
        var get_wpadminbar = $('#wpadminbar').length;
        if(get_wpadminbar > 0){
          $('.navbar-fixed-top').attr('style','top:32px');
        }
    }
  });

  function handleHeaderNavigationState() {
    if ($('#header').attr('data-state-change') != 'disabled') {
      // var totalScroll = $(window).scrollTop();
      var headerHeight = $('.navbar-header').height();
      var distanceY = window.pageYOffset
      if (distanceY >= headerHeight) {
          $('#header').addClass('navbar-small');
          if (window.matchMedia('(max-width: 767px)').matches) {
              var get_wpadminbar = $('#wpadminbar').length;
              if (get_wpadminbar > 0) {
                $('.navbar-fixed-top').attr('style','top:0');
              }
          }
      } else {
          $('#header').removeClass('navbar-small');
          if (window.matchMedia('(max-width: 767px)').matches) {
              var get_wpadminbar = $('#wpadminbar').length;
              if(get_wpadminbar > 0){
                $('.navbar-fixed-top').attr('style','top:48px');
              }
          }
      }
    }
  }

  function handlePageContainerShow() {
    $('#page-container').addClass('in');
  }

  function handlePaceLoadingPlugins() {
    Pace.on('hide', function() {
      $('.pace').addClass('hide');
    });
  };

var handlePageScrollContentAnimation = function() {
    $('[data-scrollview="true"]').each(function() {
        var myElement = $(this);
        var elementWatcher = scrollMonitor.create( myElement, 60 );

        elementWatcher.enterViewport(function() {
            $(myElement).find('[data-animation=true]').each(function() {
                var targetAnimation = $(this).attr('data-animation-type');
                var targetElement = $(this);
                if (!$(targetElement).hasClass('contentAnimated')) {
                    if (targetAnimation == 'number') {
                        var finalNumber = parseInt($(targetElement).attr('data-final-number'));
                        $({animateNumber: 0}).animate({animateNumber: finalNumber}, {
                            duration: 1000,
                            easing:'swing',
                            step: function () {
                                var displayNumber = handleAddCommasToNumber(Math.ceil(this.animateNumber));
                                $(targetElement).text(displayNumber).addClass('contentAnimated');
                            }
                        });
                    } else {
                        $(this).addClass(targetAnimation + ' contentAnimated');
                        setTimeout(function() {
                            $(targetElement).addClass('finishAnimated');
                        }, 1500);
                    }
                }
            });
        });
    });
};

  var handleHeaderScrollToAction = function() {
    $('[data-click=scroll-to-target]').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        var target = $(this).attr('href');
        var headerHeight = 50;
        $('html, body').animate({
            scrollTop: $(target).offset().top - headerHeight
        }, 500);

        if ($(this).attr('data-toggle') == 'dropdown') {
            var targetLi = $(this).closest('li.dropdown');
            if ($(targetLi).hasClass('open')) {
                $(targetLi).removeClass('open');
            } else {
                $(targetLi).addClass('open');
            }
        }
    });
    $(document).click(function(e) {
        if (!e.isPropagationStopped()) {
            $('.dropdown.open').removeClass('open');
        }
    });
};

  function main() {
    handleHomeContentHeight()
    handlePageContainerShow()
    handlePaceLoadingPlugins()
    handlePageScrollContentAnimation()
    handleHeaderScrollToAction()
    $(window).on('load scroll touchmove', handleHeaderNavigationState)
  }

  $(document).ready(main)
})(jQuery)