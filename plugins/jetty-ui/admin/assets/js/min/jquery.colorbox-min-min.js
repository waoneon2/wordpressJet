!function(e){var t="Close",n="BeforeClose",i="AfterClose",o="BeforeAppend",r="MarkupParse",a="Open",s="Change",l="mfp",c="."+l,d="mfp-ready",u="mfp-removing",p="mfp-prevent-close",f,m=function(){},g=!!window.jQuery,h,v=e(window),C,y,w,b,I,x=function(e,t){f.ev.on(l+e+c,t)},k=function(t,n,i,o){var r=document.createElement("div");return r.className="mfp-"+t,i&&(r.innerHTML=i),o?n&&n.appendChild(r):(r=e(r),n&&r.appendTo(n)),r},T=function(t,n){f.ev.triggerHandler(l+t,n),f.st.callbacks&&(t=t.charAt(0).toLowerCase()+t.slice(1),f.st.callbacks[t]&&f.st.callbacks[t].apply(f,e.isArray(n)?n:[n]))},E=function(t){return t===I&&f.currTemplate.closeBtn||(f.currTemplate.closeBtn=e(f.st.closeMarkup.replace("%title%",f.st.tClose)),I=t),f.currTemplate.closeBtn},_=function(){e.magnificPopup.instance||(f=new m,f.init(),e.magnificPopup.instance=f)},S=function(){var e=document.createElement("p").style,t=["ms","O","Moz","Webkit"];if(void 0!==e.transition)return!0;for(;t.length;)if(t.pop()+"Transition"in e)return!0;return!1};m.prototype={constructor:m,init:function(){var t=navigator.appVersion;f.isIE7=-1!==t.indexOf("MSIE 7."),f.isIE8=-1!==t.indexOf("MSIE 8."),f.isLowIE=f.isIE7||f.isIE8,f.isAndroid=/android/gi.test(t),f.isIOS=/iphone|ipad|ipod/gi.test(t),f.supportsTransition=S(),f.probablyMobile=f.isAndroid||f.isIOS||/(Opera Mini)|Kindle|webOS|BlackBerry|(Opera Mobi)|(Windows Phone)|IEMobile/i.test(navigator.userAgent),y=e(document),f.popupsCache={}},open:function(t){C||(C=e(document.body));var n;if(t.isObj===!1){f.items=t.items.toArray(),f.index=0;var i=t.items,o;for(n=0;n<i.length;n++)if(o=i[n],o.parsed&&(o=o.el[0]),o===t.el[0]){f.index=n;break}}else f.items=e.isArray(t.items)?t.items:[t.items],f.index=t.index||0;if(f.isOpen)return void f.updateItemHTML();f.types=[],b="",f.ev=t.mainEl&&t.mainEl.length?t.mainEl.eq(0):y,t.key?(f.popupsCache[t.key]||(f.popupsCache[t.key]={}),f.currTemplate=f.popupsCache[t.key]):f.currTemplate={},f.st=e.extend(!0,{},e.magnificPopup.defaults,t),f.fixedContentPos="auto"===f.st.fixedContentPos?!f.probablyMobile:f.st.fixedContentPos,f.st.modal&&(f.st.closeOnContentClick=!1,f.st.closeOnBgClick=!1,f.st.showCloseBtn=!1,f.st.enableEscapeKey=!1),f.bgOverlay||(f.bgOverlay=k("bg").on("click"+c,function(){f.close()}),f.wrap=k("wrap").attr("tabindex",-1).on("click"+c,function(e){f._checkIfClose(e.target)&&f.close()}),f.container=k("container",f.wrap)),f.contentContainer=k("content"),f.st.preloader&&(f.preloader=k("preloader",f.container,f.st.tLoading));var s=e.magnificPopup.modules;for(n=0;n<s.length;n++){var l=s[n];l=l.charAt(0).toUpperCase()+l.slice(1),f["init"+l].call(f)}T("BeforeOpen"),f.st.showCloseBtn&&(f.st.closeBtnInside?(x(r,function(e,t,n,i){n.close_replaceWith=E(i.type)}),b+=" mfp-close-btn-in"):f.wrap.append(E())),f.st.alignTop&&(b+=" mfp-align-top"),f.wrap.css(f.fixedContentPos?{overflow:f.st.overflowY,overflowX:"hidden",overflowY:f.st.overflowY}:{top:v.scrollTop(),position:"absolute"}),(f.st.fixedBgPos===!1||"auto"===f.st.fixedBgPos&&!f.fixedContentPos)&&f.bgOverlay.css({height:y.height(),position:"absolute"}),f.st.enableEscapeKey&&y.on("keyup"+c,function(e){27===e.keyCode&&f.close()}),v.on("resize"+c,function(){f.updateSize()}),f.st.closeOnContentClick||(b+=" mfp-auto-cursor"),b&&f.wrap.addClass(b);var u=f.wH=v.height(),p={};if(f.fixedContentPos&&f._hasScrollBar(u)){var m=f._getScrollbarSize();m&&(p.marginRight=m)}f.fixedContentPos&&(f.isIE7?e("body, html").css("overflow","hidden"):p.overflow="hidden");var g=f.st.mainClass;return f.isIE7&&(g+=" mfp-ie7"),g&&f._addClassToMFP(g),f.updateItemHTML(),T("BuildControls"),e("html").css(p),f.bgOverlay.add(f.wrap).prependTo(f.st.prependTo||C),f._lastFocusedEl=document.activeElement,setTimeout(function(){f.content?(f._addClassToMFP(d),f._setFocus()):f.bgOverlay.addClass(d),y.on("focusin"+c,f._onFocusIn)},16),f.isOpen=!0,f.updateSize(u),T(a),t},close:function(){f.isOpen&&(T(n),f.isOpen=!1,f.st.removalDelay&&!f.isLowIE&&f.supportsTransition?(f._addClassToMFP(u),setTimeout(function(){f._close()},f.st.removalDelay)):f._close())},_close:function(){T(t);var n=u+" "+d+" ";if(f.bgOverlay.detach(),f.wrap.detach(),f.container.empty(),f.st.mainClass&&(n+=f.st.mainClass+" "),f._removeClassFromMFP(n),f.fixedContentPos){var o={marginRight:""};f.isIE7?e("body, html").css("overflow",""):o.overflow="",e("html").css(o)}y.off("keyup"+c+" focusin"+c),f.ev.off(c),f.wrap.attr("class","mfp-wrap").removeAttr("style"),f.bgOverlay.attr("class","mfp-bg"),f.container.attr("class","mfp-container"),f.st.showCloseBtn&&(!f.st.closeBtnInside||f.currTemplate[f.currItem.type]===!0)&&f.currTemplate.closeBtn&&f.currTemplate.closeBtn.detach(),f._lastFocusedEl&&e(f._lastFocusedEl).focus(),f.currItem=null,f.content=null,f.currTemplate=null,f.prevHeight=0,T(i)},updateSize:function(e){if(f.isIOS){var t=document.documentElement.clientWidth/window.innerWidth,n=window.innerHeight*t;f.wrap.css("height",n),f.wH=n}else f.wH=e||v.height();f.fixedContentPos||f.wrap.css("height",f.wH),T("Resize")},updateItemHTML:function(){var t=f.items[f.index];f.contentContainer.detach(),f.content&&f.content.detach(),t.parsed||(t=f.parseEl(f.index));var n=t.type;if(T("BeforeChange",[f.currItem?f.currItem.type:"",n]),f.currItem=t,!f.currTemplate[n]){var i=f.st[n]?f.st[n].markup:!1;T("FirstMarkupParse",i),f.currTemplate[n]=i?e(i):!0}w&&w!==t.type&&f.container.removeClass("mfp-"+w+"-holder");var o=f["get"+n.charAt(0).toUpperCase()+n.slice(1)](t,f.currTemplate[n]);f.appendContent(o,n),t.preloaded=!0,T(s,t),w=t.type,f.container.prepend(f.contentContainer),T("AfterChange")},appendContent:function(e,t){f.content=e,e?f.st.showCloseBtn&&f.st.closeBtnInside&&f.currTemplate[t]===!0?f.content.find(".mfp-close").length||f.content.append(E()):f.content=e:f.content="",T(o),f.container.addClass("mfp-"+t+"-holder"),f.contentContainer.append(f.content)},parseEl:function(t){var n=f.items[t],i;if(n.tagName?n={el:e(n)}:(i=n.type,n={data:n,src:n.src}),n.el){for(var o=f.types,r=0;r<o.length;r++)if(n.el.hasClass("mfp-"+o[r])){i=o[r];break}n.src=n.el.attr("data-mfp-src"),n.src||(n.src=n.el.attr("href"))}return n.type=i||f.st.type||"inline",n.index=t,n.parsed=!0,f.items[t]=n,T("ElementParse",n),f.items[t]},addGroup:function(e,t){var n=function(n){n.mfpEl=this,f._openClick(n,e,t)};t||(t={});var i="click.magnificPopup";t.mainEl=e,t.items?(t.isObj=!0,e.off(i).on(i,n)):(t.isObj=!1,t.delegate?e.off(i).on(i,t.delegate,n):(t.items=e,e.off(i).on(i,n)))},_openClick:function(t,n,i){var o=void 0!==i.midClick?i.midClick:e.magnificPopup.defaults.midClick;if(o||2!==t.which&&!t.ctrlKey&&!t.metaKey){var r=void 0!==i.disableOn?i.disableOn:e.magnificPopup.defaults.disableOn;if(r)if(e.isFunction(r)){if(!r.call(f))return!0}else if(v.width()<r)return!0;t.type&&(t.preventDefault(),f.isOpen&&t.stopPropagation()),i.el=e(t.mfpEl),i.delegate&&(i.items=n.find(i.delegate)),f.open(i)}},updateStatus:function(e,t){if(f.preloader){h!==e&&f.container.removeClass("mfp-s-"+h),!t&&"loading"===e&&(t=f.st.tLoading);var n={status:e,text:t};T("UpdateStatus",n),e=n.status,t=n.text,f.preloader.html(t),f.preloader.find("a").on("click",function(e){e.stopImmediatePropagation()}),f.container.addClass("mfp-s-"+e),h=e}},_checkIfClose:function(t){if(!e(t).hasClass(p)){var n=f.st.closeOnContentClick,i=f.st.closeOnBgClick;if(n&&i)return!0;if(!f.content||e(t).hasClass("mfp-close")||f.preloader&&t===f.preloader[0])return!0;if(t===f.content[0]||e.contains(f.content[0],t)){if(n)return!0}else if(i&&e.contains(document,t))return!0;return!1}},_addClassToMFP:function(e){f.bgOverlay.addClass(e),f.wrap.addClass(e)},_removeClassFromMFP:function(e){this.bgOverlay.removeClass(e),f.wrap.removeClass(e)},_hasScrollBar:function(e){return(f.isIE7?y.height():document.body.scrollHeight)>(e||v.height())},_setFocus:function(){(f.st.focus?f.content.find(f.st.focus).eq(0):f.wrap).focus()},_onFocusIn:function(t){return t.target===f.wrap[0]||e.contains(f.wrap[0],t.target)?void 0:(f._setFocus(),!1)},_parseMarkup:function(t,n,i){var o;i.data&&(n=e.extend(i.data,n)),T(r,[t,n,i]),e.each(n,function(e,n){if(void 0===n||n===!1)return!0;if(o=e.split("_"),o.length>1){var i=t.find(c+"-"+o[0]);if(i.length>0){var r=o[1];"replaceWith"===r?i[0]!==n[0]&&i.replaceWith(n):"img"===r?i.is("img")?i.attr("src",n):i.replaceWith('<img src="'+n+'" class="'+i.attr("class")+'" />'):i.attr(o[1],n)}}else t.find(c+"-"+e).html(n)})},_getScrollbarSize:function(){if(void 0===f.scrollbarSize){var e=document.createElement("div");e.id="mfp-sbm",e.style.cssText="width: 99px; height: 99px; overflow: scroll; position: absolute; top: -9999px;",document.body.appendChild(e),f.scrollbarSize=e.offsetWidth-e.clientWidth,document.body.removeChild(e)}return f.scrollbarSize}},e.magnificPopup={instance:null,proto:m.prototype,modules:[],open:function(t,n){return _(),t=t?e.extend(!0,{},t):{},t.isObj=!0,t.index=n||0,this.instance.open(t)},close:function(){return e.magnificPopup.instance&&e.magnificPopup.instance.close()},registerModule:function(t,n){n.options&&(e.magnificPopup.defaults[t]=n.options),e.extend(this.proto,n.proto),this.modules.push(t)},defaults:{disableOn:0,key:null,midClick:!1,mainClass:"",preloader:!0,focus:"",closeOnContentClick:!1,closeOnBgClick:!0,closeBtnInside:!0,showCloseBtn:!0,enableEscapeKey:!0,modal:!1,alignTop:!1,removalDelay:0,prependTo:null,fixedContentPos:"auto",fixedBgPos:"auto",overflowY:"auto",closeMarkup:'<button title="%title%" type="button" class="mfp-close">&times;</button>',tClose:"Close (Esc)",tLoading:"Loading..."}},e.fn.magnificPopup=function(t){_();var n=e(this);if("string"==typeof t)if("open"===t){var i,o=g?n.data("magnificPopup"):n[0].magnificPopup,r=parseInt(arguments[1],10)||0;o.items?i=o.items[r]:(i=n,o.delegate&&(i=i.find(o.delegate)),i=i.eq(r)),f._openClick({mfpEl:i},n,o)}else f.isOpen&&f[t].apply(f,Array.prototype.slice.call(arguments,1));else t=e.extend(!0,{},t),g?n.data("magnificPopup",t):n[0].magnificPopup=t,f.addGroup(n,t);return n};var P="inline",O,z,M,B=function(){M&&(z.after(M.addClass(O)).detach(),M=null)};e.magnificPopup.registerModule(P,{options:{hiddenClass:"hide",markup:"",tNotFound:"Content not found"},proto:{initInline:function(){f.types.push(P),x(t+"."+P,function(){B()})},getInline:function(t,n){if(B(),t.src){var i=f.st.inline,o=e(t.src);if(o.length){var r=o[0].parentNode;r&&r.tagName&&(z||(O=i.hiddenClass,z=k(O),O="mfp-"+O),M=o.after(z).detach().removeClass(O)),f.updateStatus("ready")}else f.updateStatus("error",i.tNotFound),o=e("<div>");return t.inlineElement=o,o}return f.updateStatus("ready"),f._parseMarkup(n,{},t),n}}});var F="ajax",H,L=function(){H&&C.removeClass(H)},A=function(){L(),f.req&&f.req.abort()};e.magnificPopup.registerModule(F,{options:{settings:null,cursor:"mfp-ajax-cur",tError:'<a href="%url%">The content</a> could not be loaded.'},proto:{initAjax:function(){f.types.push(F),H=f.st.ajax.cursor,x(t+"."+F,A),x("BeforeChange."+F,A)},getAjax:function(t){H&&C.addClass(H),f.updateStatus("loading");var n=e.extend({url:t.src,success:function(n,i,o){var r={data:n,xhr:o};T("ParseAjax",r),f.appendContent(e(r.data),F),t.finished=!0,L(),f._setFocus(),setTimeout(function(){f.wrap.addClass(d)},16),f.updateStatus("ready"),T("AjaxContentAdded")},error:function(){L(),t.finished=t.loadError=!0,f.updateStatus("error",f.st.ajax.tError.replace("%url%",t.src))}},f.st.ajax.settings);return f.req=e.ajax(n),""}}});var j,N=function(t){if(t.data&&void 0!==t.data.title)return t.data.title;var n=f.st.image.titleSrc;if(n){if(e.isFunction(n))return n.call(f,t);if(t.el)return t.el.attr(n)||""}return""};e.magnificPopup.registerModule("image",{options:{markup:'<div class="mfp-figure"><div class="mfp-close"></div><figure><div class="mfp-img"></div><figcaption><div class="mfp-bottom-bar"><div class="mfp-title"></div><div class="mfp-counter"></div></div></figcaption></figure></div>',cursor:"mfp-zoom-out-cur",titleSrc:"title",verticalFit:!0,tError:'<a href="%url%">The image</a> could not be loaded.'},proto:{initImage:function(){var e=f.st.image,n=".image";f.types.push("image"),x(a+n,function(){"image"===f.currItem.type&&e.cursor&&C.addClass(e.cursor)}),x(t+n,function(){e.cursor&&C.removeClass(e.cursor),v.off("resize"+c)}),x("Resize"+n,f.resizeImage),f.isLowIE&&x("AfterChange",f.resizeImage)},resizeImage:function(){var e=f.currItem;if(e&&e.img&&f.st.image.verticalFit){var t=0;f.isLowIE&&(t=parseInt(e.img.css("padding-top"),10)+parseInt(e.img.css("padding-bottom"),10)),e.img.css("max-height",f.wH-t)}},_onImageHasSize:function(e){e.img&&(e.hasSize=!0,j&&clearInterval(j),e.isCheckingImgSize=!1,T("ImageHasSize",e),e.imgHidden&&(f.content&&f.content.removeClass("mfp-loading"),e.imgHidden=!1))},findImageSize:function(e){var t=0,n=e.img[0],i=function(o){j&&clearInterval(j),j=setInterval(function(){return n.naturalWidth>0?void f._onImageHasSize(e):(t>200&&clearInterval(j),t++,3===t?i(10):40===t?i(50):100===t&&i(500),void 0)},o)};i(1)},getImage:function(t,n){var i=0,o=function(){t&&(t.img[0].complete?(t.img.off(".mfploader"),t===f.currItem&&(f._onImageHasSize(t),f.updateStatus("ready")),t.hasSize=!0,t.loaded=!0,T("ImageLoadComplete")):(i++,200>i?setTimeout(o,100):r()))},r=function(){t&&(t.img.off(".mfploader"),t===f.currItem&&(f._onImageHasSize(t),f.updateStatus("error",a.tError.replace("%url%",t.src))),t.hasSize=!0,t.loaded=!0,t.loadError=!0)},a=f.st.image,s=n.find(".mfp-img");if(s.length){var l=document.createElement("img");l.className="mfp-img",t.img=e(l).on("load.mfploader",o).on("error.mfploader",r),l.src=t.src,s.is("img")&&(t.img=t.img.clone()),l=t.img[0],l.naturalWidth>0?t.hasSize=!0:l.width||(t.hasSize=!1)}return f._parseMarkup(n,{title:N(t),img_replaceWith:t.img},t),f.resizeImage(),t.hasSize?(j&&clearInterval(j),t.loadError?(n.addClass("mfp-loading"),f.updateStatus("error",a.tError.replace("%url%",t.src))):(n.removeClass("mfp-loading"),f.updateStatus("ready")),n):(f.updateStatus("loading"),t.loading=!0,t.hasSize||(t.imgHidden=!0,n.addClass("mfp-loading"),f.findImageSize(t)),n)}}});var W,R=function(){return void 0===W&&(W=void 0!==document.createElement("p").style.MozTransform),W};e.magnificPopup.registerModule("zoom",{options:{enabled:!1,easing:"ease-in-out",duration:300,opener:function(e){return e.is("img")?e:e.find("img")}},proto:{initZoom:function(){var e=f.st.zoom,i=".zoom",o;if(e.enabled&&f.supportsTransition){var r=e.duration,a=function(t){var n=t.clone().removeAttr("style").removeAttr("class").addClass("mfp-animated-image"),i="all "+e.duration/1e3+"s "+e.easing,o={position:"fixed",zIndex:9999,left:0,top:0,"-webkit-backface-visibility":"hidden"},r="transition";return o["-webkit-"+r]=o["-moz-"+r]=o["-o-"+r]=o[r]=i,n.css(o),n},s=function(){f.content.css("visibility","visible")},l,c;x("BuildControls"+i,function(){if(f._allowZoom()){if(clearTimeout(l),f.content.css("visibility","hidden"),o=f._getItemToZoom(),!o)return void s();c=a(o),c.css(f._getOffset()),f.wrap.append(c),l=setTimeout(function(){c.css(f._getOffset(!0)),l=setTimeout(function(){s(),setTimeout(function(){c.remove(),o=c=null,T("ZoomAnimationEnded")},16)},r)},16)}}),x(n+i,function(){if(f._allowZoom()){if(clearTimeout(l),f.st.removalDelay=r,!o){if(o=f._getItemToZoom(),!o)return;c=a(o)}c.css(f._getOffset(!0)),f.wrap.append(c),f.content.css("visibility","hidden"),setTimeout(function(){c.css(f._getOffset())},16)}}),x(t+i,function(){f._allowZoom()&&(s(),c&&c.remove(),o=null)})}},_allowZoom:function(){return"image"===f.currItem.type},_getItemToZoom:function(){return f.currItem.hasSize?f.currItem.img:!1},_getOffset:function(t){var n;n=t?f.currItem.img:f.st.zoom.opener(f.currItem.el||f.currItem);var i=n.offset(),o=parseInt(n.css("padding-top"),10),r=parseInt(n.css("padding-bottom"),10);i.top-=e(window).scrollTop()-o;var a={width:n.width(),height:(g?n.innerHeight():n[0].offsetHeight)-r-o};return R()?a["-moz-transform"]=a.transform="translate("+i.left+"px,"+i.top+"px)":(a.left=i.left,a.top=i.top),a}}});var Z="iframe",q="//about:blank",D=function(e){if(f.currTemplate[Z]){var t=f.currTemplate[Z].find("iframe");t.length&&(e||(t[0].src=q),f.isIE8&&t.css("display",e?"block":"none"))}};e.magnificPopup.registerModule(Z,{options:{markup:'<div class="mfp-iframe-scaler"><div class="mfp-close"></div><iframe class="mfp-iframe" src="//about:blank" frameborder="0" allowfullscreen></iframe></div>',srcAction:"iframe_src",patterns:{youtube:{index:"youtube.com",id:"v=",src:"//www.youtube.com/embed/%id%?autoplay=1"},vimeo:{index:"vimeo.com/",id:"/",src:"//player.vimeo.com/video/%id%?autoplay=1"},gmaps:{index:"//maps.google.",src:"%id%&output=embed"}}},proto:{initIframe:function(){f.types.push(Z),x("BeforeChange",function(e,t,n){t!==n&&(t===Z?D():n===Z&&D(!0))}),x(t+"."+Z,function(){D()})},getIframe:function(t,n){var i=t.src,o=f.st.iframe;e.each(o.patterns,function(){return i.indexOf(this.index)>-1?(this.id&&(i="string"==typeof this.id?i.substr(i.lastIndexOf(this.id)+this.id.length,i.length):this.id.call(this,i)),i=this.src.replace("%id%",i),!1):void 0});var r={};return o.srcAction&&(r[o.srcAction]=i),f._parseMarkup(n,r,t),f.updateStatus("ready"),n}}});var K=function(e){var t=f.items.length;return e>t-1?e-t:0>e?t+e:e},Y=function(e,t,n){return e.replace(/%curr%/gi,t+1).replace(/%total%/gi,n)};e.magnificPopup.registerModule("gallery",{options:{enabled:!1,arrowMarkup:'<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>',preload:[0,2],navigateByImgClick:!0,arrows:!0,tPrev:"Previous (Left arrow key)",tNext:"Next (Right arrow key)",tCounter:"%curr% of %total%"},proto:{initGallery:function(){var n=f.st.gallery,i=".mfp-gallery",o=Boolean(e.fn.mfpFastClick);return f.direction=!0,n&&n.enabled?(b+=" mfp-gallery",x(a+i,function(){n.navigateByImgClick&&f.wrap.on("click"+i,".mfp-img",function(){return f.items.length>1?(f.next(),!1):void 0}),y.on("keydown"+i,function(e){37===e.keyCode?f.prev():39===e.keyCode&&f.next()})}),x("UpdateStatus"+i,function(e,t){t.text&&(t.text=Y(t.text,f.currItem.index,f.items.length))}),x(r+i,function(e,t,i,o){var r=f.items.length;i.counter=r>1?Y(n.tCounter,o.index,r):""}),x("BuildControls"+i,function(){if(f.items.length>1&&n.arrows&&!f.arrowLeft){var t=n.arrowMarkup,i=f.arrowLeft=e(t.replace(/%title%/gi,n.tPrev).replace(/%dir%/gi,"left")).addClass(p),r=f.arrowRight=e(t.replace(/%title%/gi,n.tNext).replace(/%dir%/gi,"right")).addClass(p),a=o?"mfpFastClick":"click";i[a](function(){f.prev()}),r[a](function(){f.next()}),f.isIE7&&(k("b",i[0],!1,!0),k("a",i[0],!1,!0),k("b",r[0],!1,!0),k("a",r[0],!1,!0)),f.container.append(i.add(r))}}),x(s+i,function(){f._preloadTimeout&&clearTimeout(f._preloadTimeout),f._preloadTimeout=setTimeout(function(){f.preloadNearbyImages(),f._preloadTimeout=null},16)}),x(t+i,function(){y.off(i),f.wrap.off("click"+i),f.arrowLeft&&o&&f.arrowLeft.add(f.arrowRight).destroyMfpFastClick(),f.arrowRight=f.arrowLeft=null}),void 0):!1},next:function(){f.direction=!0,f.index=K(f.index+1),f.updateItemHTML()},prev:function(){f.direction=!1,f.index=K(f.index-1),f.updateItemHTML()},goTo:function(e){f.direction=e>=f.index,f.index=e,f.updateItemHTML()},preloadNearbyImages:function(){var e=f.st.gallery.preload,t=Math.min(e[0],f.items.length),n=Math.min(e[1],f.items.length),i;for(i=1;i<=(f.direction?n:t);i++)f._preloadItem(f.index+i);for(i=1;i<=(f.direction?t:n);i++)f._preloadItem(f.index-i)},_preloadItem:function(t){if(t=K(t),!f.items[t].preloaded){var n=f.items[t];n.parsed||(n=f.parseEl(t)),T("LazyLoad",n),"image"===n.type&&(n.img=e('<img class="mfp-img" />').on("load.mfploader",function(){n.hasSize=!0}).on("error.mfploader",function(){n.hasSize=!0,n.loadError=!0,T("LazyLoadError",n)}).attr("src",n.src)),n.preloaded=!0}}}});var U="retina";e.magnificPopup.registerModule(U,{options:{replaceSrc:function(e){return e.src.replace(/\.\w+$/,function(e){return"@2x"+e})},ratio:1},proto:{initRetina:function(){if(window.devicePixelRatio>1){var e=f.st.retina,t=e.ratio;t=isNaN(t)?t():t,t>1&&(x("ImageHasSize."+U,function(e,n){n.img.css({"max-width":n.img[0].naturalWidth/t,width:"100%"})}),x("ElementParse."+U,function(n,i){i.src=e.replaceSrc(i,t)}))}}}}),function(){var t=1e3,n="ontouchstart"in window,i=function(){v.off("touchmove"+r+" touchend"+r)},o="mfpFastClick",r="."+o;e.fn.mfpFastClick=function(o){return e(this).each(function(){var a=e(this),s;if(n){var l,c,d,u,p,f;a.on("touchstart"+r,function(e){u=!1,f=1,p=e.originalEvent?e.originalEvent.touches[0]:e.touches[0],c=p.clientX,d=p.clientY,v.on("touchmove"+r,function(e){p=e.originalEvent?e.originalEvent.touches:e.touches,f=p.length,p=p[0],(Math.abs(p.clientX-c)>10||Math.abs(p.clientY-d)>10)&&(u=!0,i())}).on("touchend"+r,function(e){i(),u||f>1||(s=!0,e.preventDefault(),clearTimeout(l),l=setTimeout(function(){s=!1},t),o())})})}a.on("click"+r,function(){s||o()})})},e.fn.destroyMfpFastClick=function(){e(this).off("touchstart"+r+" click"+r),n&&v.off("touchmove"+r+" touchend"+r)}}(),_()}(window.jQuery||window.Zepto);