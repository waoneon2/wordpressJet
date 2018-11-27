var App = App || {};
App.Tabs = (function(){

	var componentClass = ".tabs";
	var currentSize;
	var tabs;


	function updateScrollUI(tab){

		var scrollAmount = tab.scrollLeft();

		var parent = tab.parent();
		var tabWidth = Math.ceil(tab.width());
		var tabsWidth = Math.ceil(tab.find('.nav-tabs').width());
		if (isNaN(tabsWidth)) {
			var tabsWidth = Math.ceil(tab.find('#p66-mobile-menu .submenu').width());
		}
		var isContentLessThanParent = tabsWidth < parent.width();

		var isLeft = scrollAmount == 0;

		if(isLeft || isContentLessThanParent){

			parent.removeClass('show-left-control');
		}else{

			parent.addClass('show-left-control');
		}


		var isRight = (scrollAmount + tabWidth >= tabsWidth);

		if(isRight || isContentLessThanParent){

			parent.removeClass('show-right-control');
		}else{

			parent.addClass('show-right-control');
		}
	}

	function scrollUpdate(event){
		var tab = $(this);
		updateScrollUI(tab);
	}


	function updateTabsWidth(){
		tabs.each(function(){
			var currentTabs = $(this);
			var navTab = currentTabs.find('.nav-tabs');


			var breakpointsWidthShouldUpdate = navTab.data('breakpoints');
			if(!breakpointsWidthShouldUpdate){
				breakpointsWidthShouldUpdate = 'xs';
			}

			if(breakpointsWidthShouldUpdate.indexOf(currentSize) > -1){



				// update the width
				var children = navTab.find('li');

				var width = 0;
				children.each(function(){
					var tab = $(this);
					width += Math.ceil(tab.outerWidth(true));
				});
				navTab.width(Math.ceil(width)+51);


				updateScrollUI(currentTabs);

			}else{


				navTab.removeAttr("style");
			}

		});
	}


	function breakpointChange(size){
		currentSize = size;
		updateTabsWidth();
	}



	function init(){
		tabs = $('.tabs');
		mobile_nav = $('.mobile-subnav .submenu-holder .submenu-contain');

		// debounce the scroll event to call the scrollUpdate function
		tabs.scroll(App.Global.debounce(scrollUpdate, 100));
		mobile_nav.scroll(App.Global.debounce(scrollUpdate, 100));

		// listen for braekpoint changes to determine if we should update the width
		$(window).on('break-event',function(e,msg){
				breakpointChange(msg);
		});
	}



		init();

})();
