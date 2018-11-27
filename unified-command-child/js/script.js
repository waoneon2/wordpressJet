(function($){
	$( document ).ready(function() {
    	$( '.img-slider' ).cycle().on('cycle-update-view', function(event, optionHash, slideOptionsHash, currentSlideEl) {
            if (!currentSlideEl.getAttribute('data-cycle-desc') /*&& !currentSlideEl.getAttribute('data-cycle-title')*/) {
                slideOptionsHash.overlayTemplate = '';
            } else { 
                slideOptionsHash.overlayTemplate = '<div class="cap_title">{{title}}</div><div class="cap_desc">{{desc}}</div>';
            }
        });
	});
})(jQuery)
