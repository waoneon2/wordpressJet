(function($){
        $.fn.extend({
        treed: function (o) {
        
        var openedClass = 'glyphicon-minus-sign';
        var closedClass = 'glyphicon-plus-sign';
        
        if (typeof o != 'undefined'){
            if (typeof o.openedClass != 'undefined'){
            openedClass = o.openedClass;
            }
            if (typeof o.closedClass != 'undefined'){
            closedClass = o.closedClass;
            }
        };
      
        //initialize each of the top levels
        var tree = $(this);
        tree.addClass("tree");
        tree.find('li').has("ul").each(function () {
            var branch = $(this); //li with children ul
            branch.prepend("<i class='indicator glyphicon " + closedClass + "'></i>");
            branch.addClass('branch');
            branch.on('click', function (e) {
                if (this == e.target) {
                    var icon = $(this).children('i:first');
                    icon.toggleClass(openedClass + " " + closedClass);
                    $(this).children().children().toggle();
                }
            })
            branch.children().children().toggle();
        });

        //fire event from hover
        tree.find('.branch .indicator').each(function(){
            $(this).hover(
            function(e){
                $(this).closest('li').click();
                e.preventDefault();
            }, 
            function(e){
            });
        });

        //fire event from current menu select
        tree.find('.current-menu-item').each(function(){
            var j_k = $('.current-menu-ancestor');
            if(j_k.length > 0){
                j_k.each(function(){
                    var n_m1 = $(this).find(".indicator.glyphicon")[0];
                    var c_x1 = n_m1.closest('li');
                    c_x1.click();
                });
            } else {
                var n_m = $(this).find(".indicator.glyphicon")[0];
                var c_x = n_m.closest('li');
                c_x.click();
            }
            
        });

        //fire event to open branch if the li contains an anchor instead of text
        tree.find('.branch>a').each(function () {});
        //fire event to open branch if the li contains a button instead of text
        tree.find('.branch>button').each(function () {});
    }
});

// Initialize of menu to tree element 
$('#primary-menu').treed({openedClass : 'glyphicon-arrow-down', closedClass : 'glyphicon-arrow-right'});
	$('ul.sub-menu > .branch').each(function(){
		var icon = $(this).children('i:first');
			icon.removeClass('glyphicon-arrow-right').removeClass('glyphicon-arrow-down').removeClass('indicator').removeClass('glyphicon').addClass('inc-sub-menu');
			$(this).children().children().show();

	});

var l_k = $(".videocontent").length;
if(l_k > 0){
    $("#content").addClass("on_video");
}

var h_val = $("#on_hidden_year");
if(h_val.length > 0){
    var v_h_val = h_val.val();
    var l_list_y = $(".on_list_archive a").length;
    var list_y = $(".on_list_archive a");
    for (var i = 0; i < l_list_y; i++) {
        if(list_y[i].innerText === v_h_val){
            $(list_y[i]).addClass("on_select");
        }
    }
}

var c_pc = $(".page-child");
if(c_pc.length > 0){
    $("#header-color").addClass("on_child_page");
} 

var c_l = $("#cycle-on-parent-page");
if(c_l.length > 0){
    $(".ncoc-single-header").addClass("on_parent_page");
}

var h_t_n = $("h1.head-title-news");
if(h_t_n.length > 0) {
    var d_l = $(h_t_n[1]).html().replace(/\s+/g, ' ');
    var de_l = d_l.replace(/^\s+|\s+$/gm,'');
    if(de_l !== ""){
        $(".entry-header").hide();
    }
}

})(jQuery);