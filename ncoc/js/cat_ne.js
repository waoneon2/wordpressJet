(function($){
    $(document).ready(function(){
        $('.year_nav').click(function(e){
            e.preventDefault();
            var parent = $(this).parent();
            var f_o_s = $(parent).find('.on_select');

            if(f_o_s.length > 0){
               for (var index = 0; index < f_o_s.length; index++) {
                   var element = f_o_s[index];
                   var cci = '#'+element.id;
                   $(cci).removeClass('on_select');
               }
            }

            var year = $(this).attr("data-year");
            var nonce = $(this).attr("data-nonce");
            $(this).addClass('on_select');
            $('.on_date').text(year);
            $.ajax({
                type : "post",
                dataType : "json",
                url : jettyAjax.ajaxurl,
                data : {action: "cat_ne_year", year_id : year, nonce: nonce},
                beforeSend : function(){
                    $('#ncoc-table-news > tbody').html('<div class="ncoc_image_loading"></div>');
                    $('div.ncoc_image_loading').html('<img class="ncoc_img_ajax_loading" src="'+jettyAjax.gif_loading+'"> <p class="rtp">Retrieve post by '+year+'</p>');
                },
                success: function(response) {
                    $('div.ncoc_image_loading').remove();
                    $('#ncoc-table-news > tbody').empty();
                    var content = response.content;
                    for (var index = 0; index < content.length; index++) {
                        var element = content[index];
                        var tag_html = '<tr class="ncoc-tr-news" id="ncoc_post-'+element.id+'">';
                            tag_html += '<td class="ncoc-td-date-news"><p class="date-news"><b>'+element.date+'</b></p></td>';
                            tag_html += '<td class="ncoc-td-title-news">';
                            tag_html += '<p class="ncoc entry-title">';
                            tag_html += '<a href="'+element.link+'" rel="bookmark">'+element.title+'</a>'
                            tag_html += '</p>';
                            tag_html += '</td>';
                            tag_html += '</tr>';

                        $('#ncoc-table-news > tbody').append(tag_html);
                    }
                }
            }); 

        });
    });
})(jQuery);