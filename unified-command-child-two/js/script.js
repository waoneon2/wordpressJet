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
    
    
	});

	$('.cycle-slideshow').cycle().on('cycle-update-view', function(event, optionHash, slideOptionsHash, currentSlideEl) {
        if (!currentSlideEl.getAttribute('data-cycle-title') || !currentSlideEl.getAttribute('data-cycle-title')) {
            slideOptionsHash.overlayTemplate = '';
        } else { 
            slideOptionsHash.overlayTemplate = '<div class=inner><h6 class="title">{{title}}</h6><div class="desc">{{desc}}</div></div>';
        }
    });
})(jQuery)
