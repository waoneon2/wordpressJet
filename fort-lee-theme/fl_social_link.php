<div class="social-media-area">
    <div class="tab-content ui-tabs ui-widget ui-widget-content ui-corner-all">
         <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
             <li class="ui-state-default ui-corner-top active"><a data-toggle="tab" href="#tabs-1"><span class="fa fa-facebook-square fa-3x" data-mce-mark="1"></span></a></li>
             <li class="ui-state-default ui-corner-top"><a data-toggle="tab" href="#tabs-2"><span class="fa fa-twitter-square fa-3x" data-mce-mark="1"></span></a></li>
             <li class="ui-state-default ui-corner-top"><a data-toggle="tab" href="#tabs-3"><span class="fa fa-youtube-square fa-3x" data-mce-mark="1"></span></a></li>
         </ul>



        <?php
            if(get_theme_mod('socmed_facebook','ArmyFortLee')){
              $facebook = 'https://www.facebook.com/'.get_theme_mod('socmed_facebook','ArmyFortLee').'';
            } else {
              $facebook = 'https://www.facebook.com/ArmyFortLee';
            }

            if(get_theme_mod('socmed_twitter','ArmyFortLee')){
              $twitter  = 'https://twitter.com/'.get_theme_mod('socmed_twitter','ArmyFortLee').'';
            } else {
              $twitter  = 'https://twitter.com/ArmyFortLee';
            }

            if(get_theme_mod('socmed_youtube','videoseries?list=PL359EB7080B3BDC29')){
              $youtube  = 'https://www.youtube.com/embed/'.get_theme_mod('socmed_youtube','videoseries?list=PL359EB7080B3BDC29').'';
            } else {
              $youtube  = 'https://www.youtube.com/embed/videoseries?list=PL359EB7080B3BDC29';
            }
        ?>

        <!-- Facebook -->
        <div id="tabs-1" class="pierFacebook tab-pane ui-corner-bottom in active">
            <div class="scroll250">
                <div id="fb-root"></div>
                <script>(function(d, s, id) {
                  var js, fjs = d.getElementsByTagName(s)[0];
                  if (d.getElementById(id)) return;
                  js = d.createElement(s); js.id = id;
                  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.10&appId=568161160025250";
                  fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));</script>
                <div class="fb-page" data-href="<?php echo $facebook ?>" data-tabs="timeline" data-height="357" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"></div>
            </div>
            <div class="like-tab vmFacebook"><a href="<?php echo $facebook; ?>">Like us on Facebook »</a></div>
        </div>

        <!-- Twitter -->
        <div id="tabs-2" class="pierTwitter tab-pane ui-corner-bottom ">
            <div class="twitter-feed-widget">
            <a class="twitter-timeline" data-height="357" href="<?php echo $twitter ?>"></a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
            </div>
            <div class="like-tab vmTwitter"><a href="<?php echo $twitter; ?>">Follow us on Twitter »</a></div>
        </div>

        <!-- Youtube -->
        <div id="tabs-3" class="pierYoutube scroll360 tab-pane ui-corner-bottom ">
            <div class="scroll250"><iframe width="360" height="240" src="<?php echo $youtube ?>" frameborder="0" allowfullscreen=""></iframe></div>
            <div class="like-tab vmYoutube"><a href="<?php echo $youtube; ?>">Watch us on YouTube »</a></div>
        </div>
    </div>
</div>