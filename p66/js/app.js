/*
Each component should have its own Javascript namespace within "App." It should return component
specific methods if other components need to interact with it. Otherwise it can return nothing.
*/
var $ = jQuery;
var App = App || {};

App.Global = (function(){

		function init(){
				breakpoints(jQuery, document, window, ResponsiveBootstrapToolkit);
		}

		//Debounced viewport height getter
		function resizeHeight(a,b) {
		  var c = [window.innerHeight];
		  return onresize = function() {
		    var d = window.innerHeight,
		        e = c.length;
		    c.push(d);
		    if(c[e]!==c[e-1]){
		      clearTimeout(b);
		      b = setTimeout(a, 250);
		    }
		  }, a;
		}


		function debounce(func, wait, immediate) {
			var timeout;
			return function() {
				var context = this,
					args = arguments;
				var later = function() {
					timeout = null;
					if ( !immediate ) {
						func.apply(context, args);
					}
				};
				var callNow = immediate && !timeout;
				clearTimeout(timeout);
				timeout = setTimeout(later, wait || 200);
				if ( callNow ) {
					func.apply(context, args);
				}
			};
		};


		//Non-debounced viewport height getter
		//Used by the debounced method above as well as the header component on page load
		function getInnerHeight(){
		  return window.innerHeight;
		}

		function getInnerWidth(){
			return window.innerWidth;
		}

		//Private method for getting current breakpoint. Called from init().
		function breakpoints($, document, window, viewport){
		  var body = $('body');

	    $(document).ready(function() {
	        $('#break-check').addClass(viewport.current());
	        var resizeTimeout;
	        var breaks = function(){$(window).trigger('break-event',viewport.current())};
	        if(resizeTimeout) clearTimeout(resizeTimeout);
	        resizeTimeout = setTimeout(breaks, 200);

	    });

	    $(window).resize(
	    		viewport.changed(function() {
	    			 $(window).trigger('break-event',[viewport.current()]);
	    			 $('#break-check').removeClass().addClass(viewport.current());
	    		})
	    );
	 };

		init();

		//Returns methods that need to be public
		return{
				resizeHeight:resizeHeight,
				getInnerHeight:getInnerHeight,
				getInnerWidth:getInnerWidth,
				debounce:debounce
		}
})();

//SlickSlider
App.slickSlider = (function(){

	//AnotherComponent methods defined below
	var $slider = $('.slider-component');

	function initSlider() {
		$slider.slick({
			dots: true,
			arrows: true,
			prevArrow: "<a class='slick-prev slick-arrow-right' href='#heroCarousel' role='button' data-slide='next'><span class='glyphicon glyphicon-menu-left' aria-hidden='true'></span><span class='sr-only'>Next</span></a>",
			nextArrow: "<a class='slick-next slick-arrow-right' href='#heroCarousel' role='button' data-slide='next'><span class='glyphicon glyphicon-menu-right' aria-hidden='true'></span><span class='sr-only'>Next</span></a>",
			// adaptiveHeight: true,
			responsive: [
				{
					breakpoint: 767,
					settings: {
						arrows: false,
						adaptiveHeight: true
					}
				}
			]
		});

		var $desktopContent = $('.desktop-content'),
		$mobileContent = $('.mobile-content div');
	}

	function checkSliderHeight() {
		if($(window).width() < 1085) {
			reInitSlider($slider);
		}

		if ($(window).width() < 767) {

			reInitSlider($slider);

			var $slickMobile = $('.slick-active .mobile-content');
			var $slickDots = $('.slick-dots');
			var mobileHeight = $slickMobile.outerHeight(true);
			$slickDots.css('bottom', mobileHeight+10);
		}
	}

	function reInitSlider($slider) {
		$slider.slick('unslick').slick({
			dots: true,
			arrows: true,
			prevArrow: "<a class='slick-prev slick-arrow-right' href='#heroCarousel' role='button' data-slide='next'><span class='glyphicon glyphicon-menu-left' aria-hidden='true'></span><span class='sr-only'>Next</span></a>",
			nextArrow: "<a class='slick-next slick-arrow-right' href='#heroCarousel' role='button' data-slide='next'><span class='glyphicon glyphicon-menu-right' aria-hidden='true'></span><span class='sr-only'>Next</span></a>",
			// adaptiveHeight: true,
			responsive: [
				{
					breakpoint: 767,
					settings: {
						arrows: false,
						adaptiveHeight: true
					}
				}
			]
		});
	}


	//Use init to intialize the component. Call init from the conditional at the bottom.
	function init(){
		initSlider();
		checkSliderHeight();
		$(window).on('break-event', function(e,msg){
			checkSliderHeight();
		});
	}

	if($slider.length > 0){
		init();
		return{

		}
	}
})();

//load more
var App = App || {};
App.loadMore = (function(){
	$( ".feature.btn-load-more" ).click(function() {
		var featureLink = $('.feature.view-all').attr('href');
		$('.promo-3-col .col-lg-4:nth-child(2), .promo-3-col .col-lg-4:nth-child(3)').slideDown();
		$(this).removeClass('feature');
		$(this).text("View All");
		setTimeout(function(){
		  $('.promo-3-col .btn-load-more').attr("href", featureLink);
		}, 2000);
	});

	$( ".news.btn-load-more" ).click(function() {
		var newsLink = $('.news.view-all').attr('href');
		$('.news-releases .col-lg-3:nth-child(2), .news-releases .col-lg-3:nth-child(3), .news-releases .col-lg-3:nth-child(4)').slideDown();
		$(this).removeClass('news');
		$(this).text("View All");
		setTimeout(function(){
		  $('.news-releases .btn-load-more').attr("href", newsLink);
		}, 2000);
	});
})();



//Modal JS
var App = App || {};
App.Modal = (function(){

	var componentClass = ".modal";
	var modals;
	var closeButtons;
	var isVideoScriptLoaded = false;
	var videoPlayers;


	function onPlayerReady(event){
		//event.target.playVideo();
	}

	function showModal(event){


		var modal = $(event.target);
		var videoId = modal.data('video-id');
		var width = modal.data('video-width');
		var height = modal.data('video-height');
		var player;
		if(videoId){
			var videoShellId = "video-" + videoId;
			player = players[videoShellId];
			if(!player){
				player = new YT.Player( videoShellId, {
		      height: height,
		      width: width,
		      videoId: videoId,
          events: {
            'onReady': onPlayerReady
          }
		    });
				players[videoShellId] = player;

			}else{
				//player.playVideo();
			}

		}

	}


	function closeModal(event){
		var modal = $(event.target);
		var videoId = modal.data('video-id');
		if(videoId){
			var videoShellId = "video-" + videoId;
			var player = players[videoShellId];
			if(player){
				player.stopVideo();
			}
		}
	}


	function onVideoScriptReady(){
		modals.each(function(){
			var modal = $(this);
			modal.on('show.bs.modal', showModal);
			modal.on('hide.bs.modal', closeModal);
		});
	}


	// set a global function for youtube on ready so we can continue setting up videos
  window.onYouTubePlayerAPIReady = function() {
    onVideoScriptReady();
  }


	function loadVideoScript(){
		var tag = document.createElement('script');
	  tag.src = "https://www.youtube.com/player_api";
	  var firstScriptTag = document.getElementsByTagName('script')[0];
	  firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
	}


	function init(){


		closeButtons = $('.modal .close-btn');
		closeButtons.on('click', function(e){
			var closestModal = $(this).closest('.modal');
			closestModal.modal('hide');
		});

		players = [];

		modals = $(componentClass);
		if(modals.length){
			loadVideoScript();
		}
	}

	/*
	Test for the existence of the component. If it exists on the page initialize it and return
	public methods if any exist.
	*/
	if($(componentClass).length > 0){
		init();
		return{
		}
	}
})();


// Image Grid
var App = App || {};
App.ImageGrid = (function(){
	var componentClass = ".image-grid-container";
	var body, header, currentSize, grid, listItems, current, btnLoadMore;

	function breakpointChange(size){
		currentSize = size;
		saveItemInfo();
		updateHeights();
	}


	function showNextMobileSet(e){

		var button = $(e.target);
		var imageGrid = button.closest('.image-grid');
		var count = button.data('count-to-show');


		var items = imageGrid.find('.mobileHiddenByDefault');

		var itemsToShow = items.slice(0,count);

		itemsToShow.slideDown(400, function(){
			saveItemInfo();
		});

		if(items.length <= itemsToShow.length){
			button.hide();
		}

		itemsToShow.removeClass('mobileHiddenByDefault');
		return false;
	}


	function hideDetails(listItem){


		listItems.children('.details').slideUp({duration:200, easing:'linear'});

		listItems.removeAttr('style');
		listItems.removeClass('open');
		current = -1;
	}


	function showDetails(listItem){
		hideDetails(listItem);


		current = listItem.index();
		listItem.addClass('open');
		listItem.children('.details').delay(200).slideDown({easing:'linear'});
		var imageHeight = listItem.data('height');
		var contentHeight = listItem.data('contentHeight');
		var newHeight = imageHeight + contentHeight - 1;
		listItem.css({'min-height':newHeight});
	}


	function positionDetails(listItem){
		// scroll page
		// case 1 : preview height + item height fits in window´s height
			// scroll to the top of the image after the header
		// case 2 : preview height + item height does not fit in window´s height and preview height is smaller than window´s height
			// scroll to the top of the image after the header
		// case 3 : preview height + item height does not fit in window´s height and preview height is bigger than window´s height
			// scroll to the top of the content after the header

		var listItemOffset = listItem.data('offsetTop');
		var imageHeight = listItem.data('imageHeight');
		var contentHeight = listItem.data('contentHeight');
		var windowHeight = App.Global.getInnerHeight();
		var headerOffset = header.height();



		var doesImageAndDetailsFitInWindow = ((imageHeight + contentHeight + headerOffset) < windowHeight);


		if(doesImageAndDetailsFitInWindow){

			scrollVal = listItemOffset - headerOffset;
		}else if(!doesImageAndDetailsFitInWindow && contentHeight < windowHeight - headerOffset){

			scrollVal = listItemOffset - headerOffset;
		}else if(!doesImageAndDetailsFitInWindow && contentHeight >= windowHeight - headerOffset){
			scrollVal = listItemOffset + imageHeight - headerOffset;
		}
		body.animate( { scrollTop : scrollVal }, 1000 );

		/*
		var position = this.$item.data( 'offsetTop' ),
			previewOffsetT = this.$previewEl.offset().top - scrollExtra,

			scrollVal = (this.height + this.$item.data( 'height' ) + marginExpanded <= winsize.height) ? position : this.height < winsize.height ? previewOffsetT - ( winsize.height - this.height ) : previewOffsetT;
		*/
	}



	function updateHeights(){
		listItems.each( function(index) {
			var listItem = $( this );

			if(current === index){

				var imageHeight = listItem.data('imageHeight');
				var contentHeight = listItem.data('contentHeight');
				var newHeight = imageHeight + contentHeight - 1;
				listItem.css({'min-height':newHeight});
			}

		});
	}


	function saveItemInfo() {
		listItems.each( function() {
			var listItem = $( this );
			var image = listItem.find('a>img').first();
			var imageHeight = image.height();
			var contentItem = listItem.children('.details');
			var contentHeight = contentItem.height();

			listItem.data('offsetTop', listItem.offset().top);
			listItem.data('height', listItem.height());
			listItem.data('imageHeight', imageHeight);
			listItem.data('contentHeight', contentHeight);
		});
	}


	function initEvents(){
		listItems.children('a').on('click', function(e) {

			var listItem = $( this ).parent();
			// check if item already opened
			if(current === listItem.index()){
				hideDetails();
			}else{
				showDetails(listItem);
				positionDetails(listItem);
			}
			return false;
		});

		listItems.on('click', '.close-btn', function() {
			hideDetails();
			return false;
		});

		btnLoadMore.on('click', showNextMobileSet);
	}


	function init(){

		body = $( 'html, body' );
		header = body.find('header.navbar');
		grid = $(componentClass);
		listItems = grid.children( 'li' );
		btnLoadMore = $('.btn-load-more');
		current = -1;


		// listen for braekpoint changes to determine if we should update the width
		$(window).on('break-event',function(e,msg){
				breakpointChange(msg);
		});


		// preload all images
		grid.imagesLoaded( function() {
			saveItemInfo();
			initEvents();
		});


	}

	/*
	Test for the existence of the component. If it exists on the page initialize it and return
	public methods if any exist.
	*/
	if($(componentClass).length > 0){
		init();
		return{
		}
	}
})();


// sticky navbar
var App = App || {};
App.stickyNav = (function(){
	var header = $('#masthead');
	var headheightN = header.height();
	var detectChildN = $(".sub-menu .current_page_item").length;
	var subHeightN = $(".sub-menu .current_page_item").height();

	var winWidthN = $(window).width();

	if (winWidthN > 767 && detectChildN > 0){
		headHeNew = headheightN + subHeightN;
		var paddingContent = headHeNew + 'px';
	} else {
		var paddingContent = headheightN + 'px';
	}

	$('.site-content').css('padding-top',paddingContent);
	$(window).on('scroll', function () {
	    var scrollTop = $(this).scrollTop();

	    if (scrollTop >= headheightN){
	    	header.addClass('sticky');
	    } else if (scrollTop < headheightN) {
	    	header.removeClass('sticky');
	    }
	});
})();

App.SearchBar = (function(){
	$(document).ready(function(){

		//get position of search box
		var adminHeight = $('#wpadminbar').height();
		var winWidth = $(window).width();
		var detectChild = $(".sub-menu .current_page_item").length;
		var subHeight = $(".sub-menu .current_page_item").height();
		var headHeight =$('#masthead').height();

		//add if there is subheader
		if (winWidth > 767 ){
			if (detectChild > 0 ) {
			var headHeight = $('#masthead').height() + subHeight;
			}
		}

		// add if there is admin bar
		if (adminHeight > 0) {
			var searchPos = headHeight + adminHeight;
		} else {
			var searchPos = headHeight;
		}

		//result search position
		$('.search-bar-header.affix').css('top',searchPos+'px');


		$(window).scroll(function(){
			headHeight =$('#masthead').height();
			subHeight = $(".sub-menu .current_page_item").height();
			var winPos = $(window).scrollTop();
			//add if there is subheader
			if (winWidth > 767 ){
				if (detectChild > 0 ) {
				var headHeight = $('#masthead').height() + subHeight;
				}
			}
			// add if there is admin bar
			if (adminHeight > 0) {
				var searchPos = headHeight + adminHeight;
			} else {
				var searchPos = headHeight;
			}
			if (winPos > adminHeight && winWidth < 601){
				var searchBaru = searchPos - adminHeight;
			} else {
				var searchBaru = searchPos;
			}

			$('.search-bar-header.affix').css('top',searchBaru+'px');
		});

		//trigger for search bar
			$('header .mobile-search-container').click(function(){
				$(this).toggleClass('clicked');
				$('.search-bar-header.affix').slideToggle();
			});
			$('header .search-icon').click(function(){
				$(this).toggleClass('clicked');
				$('.search-bar-header.affix').slideToggle();
			});
	});
})();


// HEADER
App.Header = (function(){
    var componentClass = $('.nav-container'),
      newHeight;

    function init(){
      console.log('init header');
        var nav = $('nav'),
            header = $('header'),
            menu = $('.menu'),
            menuContainer = $('.menu-container'),
            footerContainer = $('.menu-footer-container'),
            subMenu = $('.sub-menu'),
            toggle  = $('.toggle'),
            subToggle = $('.subCTA'),
            back = '<div class="hide-submenu"></div>',
            subHide = $(back),
            navContainer = $('.nav-container'),
            submenuHeading = $('.submenu-heading'),
            multi = $('.multi-container'),
            footer = $('ul.menu-footer'),
            breakCheck = $('#break-check'),
            logoImg = $('.logo-container img'),
            headerClass = $('.header'),
            headerTag = $("header"),
            logoCTA = $('.logo-container a'),
            rightCol = $('.right-col p.drk-grey'),
            searchBar = $('.search-bar-header'),
            menuSized = $('.menu.sized'),
            glyphSearch = $('.glyphicon-search'),
            searchIcon = $('.search-icon'),
            mobileSearchContainer = $('.mobile-search-container'),
            caroIcons = $('.carousel-indicators'),
            containerFluid = $('.container-fluid'),
            fixedContainer = $('.fixed-container'),
            shownSubmenu = menu.find('.show-subnav'),
            mobileSubnav = header.find('.mobile-subnav'),
            mobileTitle = mobileSubnav.find('.subnav-title').html(),
            shownSubmenuContainer = shownSubmenu.find('.submenu-contain'),
            subNavLinks = $("#subnav-links"),
            subNavSubmenuMobile = subNavLinks.find('.submenu-contain'),
            content = $(".body>.content");
            isSearchOpen = false,
            isMenuOpen = false,
            selectedSubmenu = null;
            totalWindowHeight = App.Global.getInnerHeight(),
            headerHeight = 83,
            menuItemHeight = 90,
            footerHeight = 100,
            footerHeaderHeight = headerHeight;


      function closeSearch(event){

        if(!isSearchOpen){
          return;
        }

        // if the event is specified, only close when clicking on the dimmer
        if(event && event.target != event.currentTarget){
          return;
        }

        console.log('closeSearch');

        // actually hide the search panel
        $('.container-fluid').removeClass('dimmed');
        searchBar.slideUp();
        $('.mobile-search-container').removeClass('clicked');

        $('.glyphicon-search').removeClass('clicked');
        $('.search-icon').removeClass('clicked');
        toggle.focus();

        // remove the handler, it will be reapplied on open
        containerFluid.off('click');

        isSearchOpen = false;
      }
      function closeMenu(event){

         if(!isMenuOpen){
             return;
         }

         console.log('closeMenu');

         $('header').removeClass('menu-open');

         $('.search-icon').addClass('hidden');
         $('.search-icon').addClass('visible-xs');
         $('.logo-container').removeClass('hidden');

         $('body').css({'overflow':'hidden'});

         navContainer.css({'z-index':'1'});
         header.toggleClass('is-visible');

         $('.toggle-main').show();
         $('.toggle-mobile').hide();
         toggle.css({'left':'18px','right':'auto'});

         submenuHeading.removeClass('is-visible');
         submenuHeading.addClass('visually-hidden');

         if(caroIcons.length > 0){
             caroIcons.css({'z-index':'15'});
         }

         $('.fixed-container').css({'position':'relative'});
         $('.fixed-container').css('overflow-y','hidden');
         nav.css({'position':'relative'});

         menu.removeClass('is-visible');

         navContainer.css({'z-index':'initial','height':getClosedMenuHeight(),'overflow':'hidden'});

         $('html').css({'overflow':'initial'});
         $('body').css({'overflow':'initial'});
         $('.body').show();

         // animate
         $('div.header .col-xs-3,div.header .col-xs-6').fadeIn(100);
         $('div.header .col-xs-3,div.header .col-xs-6').fadeOut(100);

         // Wait for CSS animation
         setTimeout(function() {
             nav.removeClass('view-submenu');
             menu.addClass('visually-hidden');
             $('header').trigger('menu-closed');
         }, 200);

         isMenuOpen = false;
         selectedSubmenu = null;

         footerContainer.removeClass('is-visible');
      }

      function getClosedMenuHeight(){

         var closedHeight = '67px';
         if($('header').hasClass('affix-top')){
             closedHeight = '102px';
         }
         return closedHeight;
      }

      function openMenu(){

          if(isMenuOpen){
              return;
          }

          closeSearch();

          isMenuOpen = true;

          console.log('openMenu');

          resizeNav();

          $('header').addClass('menu-open');

          // hide logo and search icon
          $('.search-icon').addClass('hidden');
          $('.search-icon').removeClass('visible-xs');
          $('.logo-container').addClass('hidden');
          $('.body').hide();

          $('.toggle-main').hide();
          $('.toggle-mobile').show();
          toggle.css({'left':'auto','right':'18px'});

          if(caroIcons.length > 0){
              caroIcons.css({'z-index':'0'});
          }

          $('body').css({'overflow':'hidden'});

          navContainer.css({'z-index':'1'});
          header.toggleClass('is-visible');
          submenuHeading.removeClass('is-visible');
          submenuHeading.addClass('visually-hidden');
          $('.fixed-container').css('overflow-y','auto');
          menu.toggleClass('visually-hidden is-visible');

          // animate
          $('div.header .col-xs-3,div.header .col-xs-6').fadeOut(100);

          footerContainer.addClass('is-visible');

          subMenu.hide();
      }

      function updateCommonScrollUI(container){

          //console.log('updateScrollUI ', container);

          var scrollAmount = container.scrollLeft();
          var parent = container.parent();
          var parentWidth = parent.width();
          var listItemsWidth = Math.ceil(container.find('.sub-menu').width());
          var isContentLessThanParent = listItemsWidth < parent.width();

          //console.log('listItemsWidth ', listItemsWidth);

          //console.log('\t isContentLessThanParent', isContentLessThanParent);

          // determine if we are the left most scroll position
          var isLeft = scrollAmount == 0;
          //console.log('\t isLeft ', isLeft);
          if(isLeft || isContentLessThanParent){
              //console.log('hide the left control');
              parent.removeClass('show-left-control');
          }else{
              //console.log('show the left control');
              parent.addClass('show-left-control');
          }

          // determine if we are the right most scroll position
          var isRight = (scrollAmount + parentWidth >= listItemsWidth);
          //console.log('\t isRight ', isRight);
          if(isRight || isContentLessThanParent){
              //console.log('hide the right control');
              parent.removeClass('show-right-control');
          }else{
              //console.log('show the right control');
              parent.addClass('show-right-control');
          }

      }

      function updateTabletDesktopScrollUI(e){
          //console.log('updateScrollUI');
          updateCommonScrollUI(shownSubmenuContainer);
      }

      function updateMobileScrollUI(e){
          //console.log('updateMobileScrollUI', subNavSubmenuMobile);
          updateCommonScrollUI(subNavSubmenuMobile);
      }

      function scrollToTopOfMenu(){
          $('.fixed-container').animate({
              scrollTop: 0
          }, 300);
      }

      function setSubmenuWidth(submenu, offset){

          var submenuListItems = submenu.find('li');
          var width = offset;
          submenuListItems.each(function(){
              var listItemWidth = Math.ceil($(this).outerWidth(true));
              width += listItemWidth;
          });
          submenu.find('.sub-menu').width(width);
      }


      function adjustContentPosition(){

          console.log('adjustContentPosition');

          var currentHeight = parseInt(content.css('min-height').split('px').join(''));
          var subNavHeight = 0;
          if((shownSubmenu && shownSubmenu.length) || (mobileTitle && mobileTitle.length)){
              if(msgCheck != 'xs'){
                  var ht = shownSubmenu.height();
                  if(ht){
                      subNavHeight = ht;
                  }

              }else{
                  var ht = mobileSubnav.height();
                  if(ht){
                      subNavHeight = ht;
                  }
              }
          }

          var newHeight = currentHeight + subNavHeight;
          content.css({'margin-top':newHeight});

          if(msgCheck != 'xs'){
              searchBar.css({'margin-top':subNavHeight});
          }else{
              searchBar.css({'margin-top':0});
          }
      }


      function adjustSubmenu(){

          var shownSubmenu = menu.find('.show-subnav');
          if(msgCheck != 'xs'){
              if(shownSubmenu.length > 0){
                  setSubmenuWidth(shownSubmenu, 2);
                  adjustContentPosition();
              }
          }else{
              shownSubmenu.css({width:""});
              if(shownSubmenu.length > 0){
                  setSubmenuWidth(subNavLinks, 10);
                  adjustContentPosition();
              }
          }
          updateTabletDesktopScrollUI();
          updateMobileScrollUI();
      }

      function resizeNav(){

          if(!isMenuOpen){
              return;
          }

          totalWindowHeight = App.Global.getInnerHeight();

          var heightOfItems = 0;

          var numItems = 0;
          if(selectedSubmenu){
              console.log('resize for specific submenu');
              numItems = selectedSubmenu.find('li').length;
          }else{
              console.log('resize for primary menu');
              numItems = $('.menu.sized > li').length;
          }
          console.log(numItems);
          heightOfItems = numItems * menuItemHeight;

          // set the holder sizes
          var newFixedSize = totalWindowHeight - 30;
          navContainer.css({'position':'fixed','height':totalWindowHeight});
          fixedContainer.css({'height':newFixedSize,'max-height':newFixedSize,'min-height':newFixedSize});

          // set the content size
          var contentHeight = heightOfItems + headerHeight;
          console.log('contentHeight ', contentHeight);
          var params = {'height':contentHeight,'max-height':contentHeight,'min-height':contentHeight, 'display': 'absolute'};
          menu.css(params);
          multi.css(params);
          menuContainer.css(params);
          if(selectedSubmenu){
              selectedSubmenu.css(params);
          }

      }

      // p66 custom height
      var fxCont = parseInt(fixedContainer.css('height')) - 1;
      $('.menu-container .current-menu-item .submenu-holder').css('top', fxCont);

      // p66 custom nav mobile title
      var data_msub_title = $('#p66-mobile-menu .submenu').data('msub-title');
      $('#p66-subnav-title').text(data_msub_title);
      p66_setSubmenuWidth(0);

      function p66_setSubmenuWidth(offset){
      		var submenu = $('.mobile-subnav .p66-mobile-menu ul.submenu:first-child');
          var submenuListItems = submenu.find('li');
          var width = offset;
          submenuListItems.each(function(){
              var listItemWidth = Math.ceil($(this).outerWidth(true));
              width += listItemWidth;
          });
          //console.log(data_msub_title == undefined);
          if (data_msub_title == undefined) {
          	//$('.mobile-subnav').removeClass('visible-xs');
          	$('.mobile-subnav .subnav-links').hide();
          } else {
          	submenu.width(width + 70);
          }
      }

      // p66 category title
      p66_category_title();
      function p66_category_title() {
      	var subvisible = $(".submenu-holder").is(":visible");
      	var subvisivle_height = $(".submenu-holder:visible").height() + 20;
      	var cat_header = $("header.entry-header-margin");
      	var breakpoint = $("#break-check").hasClass('xs');

      	if (subvisible && !breakpoint) {
      		cat_header.css('margin-top', subvisivle_height + 'px');
      	} else {
      		cat_header.css('margin-top', '0');
      	}
      }

      $(window).on('break-event',function(j, param){
           p66_setSubmenuWidth(0);
           p66_category_title();
      });


      // menu toggle
      toggle.on("click", function() {

          if(isSearchOpen){
              closeSearch();
          }
          console.log(isMenuOpen);
          if(isMenuOpen){
              closeMenu();
          }else{
              openMenu();
          }
      });

      // debounce the tablet/desktop scroll event to call the scrollUpdate function
      shownSubmenuContainer.scroll(App.Global.debounce(updateTabletDesktopScrollUI, 100));

      // debounce the mobile scroll event to call the scrollUpdate function, after the duplicated markup is available
      // only copy the subnav if it is shown
      if(shownSubmenu.length){
          var navToCopy = shownSubmenu.html();
          subNavLinks.html(navToCopy);
          setTimeout(function(){
              subNavSubmenuMobile = $('#subnav-links .submenu-contain');
              subNavSubmenuMobile.scroll(App.Global.debounce(updateMobileScrollUI, 100));
              updateMobileScrollUI();
              adjustContentPosition();
          },300);
      }

      // Add submenu hide bar
      subHide.prependTo(subMenu);
      var subHideToggle = $('.hide-submenu');


      // Show submenu
      subToggle.on("click", function(event) {
        // mobile do not goto the link in the nav
          console.log('clickSub');
          // desktop/tablet do nothing so the normal link takes user to the landing page
          if(!breakCheck.hasClass('xs')){
              return;
          }

          scrollToTopOfMenu();

          // mobile do not goto the link in the nav
          event.preventDefault();

          isMenuOnSubmenu = true;

          // handle submenu panels
          var specificSubmenu = $(this).parent().find('.sub-menu');

          selectedSubmenu = specificSubmenu;
          resizeNav();

          nav.addClass('view-submenu');
          multi.addClass('is-visible');

          submenuHeading.html(this.firstChild.data);
          submenuHeading.removeClass('visually-hidden');
          submenuHeading.addClass('is-visible');

          // Hide all the submenus except for the current one
          subMenu.hide();
          specificSubmenu.show();
      });


      // Hide submenu
      subHideToggle.on("click", function() {

          multi.removeClass('is-visible');
          nav.removeClass('view-submenu');
          submenuHeading.removeClass('is-visible');
          submenuHeading.addClass('visually-hidden');

          selectedSubmenu = null;

          resizeNav();
          scrollToTopOfMenu();

          // Wait for CSS animation before hiding the submenu
          var specificSubmenu = $(this.parentElement);
          setTimeout(function() {
              specificSubmenu.hide();
          }, 200);
      });

    }


    $(document).ready(function(){
      if($(componentClass).length > 0){
          init();
              return{

              }
          }
    });
})();
