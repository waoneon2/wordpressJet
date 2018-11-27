$(window).ready(function() {
  if($('#multipage').length !== 0){
    $('#multipage').multipage();
  }
  
});

function generateTabs(tabs) {

  html = '';
  for (var i in tabs) {
    tab = tabs[i];
    html = html + '<li class="multipage_tab"><a href="#" onclick="return $(\'#multipage\').gotopage(' + tab.number + ');">' + tab.title + '</a></li>';
  }
  $('<ul class="multipage_tabs" id="multipage_tabs">'+html+'<div class="clearer"></div></ul>').insertBefore('#multipage');
}
function setActiveTab(selector,page) {
  $('#multipage_tabs li').each(function(index){
    if ((index+1)==page) {
      $(this).addClass('active');
    } else {
      $(this).removeClass('active');
    }
  });
}

function transition(from,to) {
  $(from).fadeOut('fast',function(){$(to).fadeIn('fast');});
}
function textpages(obj,page,pages) {
  $(obj).html(page + ' of ' + pages);
}
