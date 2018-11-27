<div class="social-media-area">
    <div class="tab-content ui-tabs ui-widget ui-widget-content ui-corner-all">
         <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
             <li class="ui-state-default ui-corner-top active"><a data-toggle="tab" href="#tabs-1"><img src="<?php echo get_stylesheet_directory_uri() . '/img/fb.jpg' ?>"></a></li>
             <li class="ui-state-default ui-corner-top"><a data-toggle="tab" href="#tabs-2"><img src="<?php echo get_stylesheet_directory_uri() . '/img/tw.jpg' ?>"></a></li>
             <li class="ui-state-default ui-corner-top"><a data-toggle="tab" href="#tabs-3"><img src="<?php echo get_stylesheet_directory_uri() . '/img/yt.jpg' ?>"></a></li>
             <li class="ui-state-default ui-corner-top"><a data-toggle="tab" href="#tabs-4"><img src="<?php echo get_stylesheet_directory_uri() . '/img/fl.jpg' ?>"></a></li>
             <li class="ui-state-default ui-corner-top"><a data-toggle="tab" href="#tabs-5"><img src="<?php echo get_stylesheet_directory_uri() . '/img/ig.jpg' ?>"></a></li>
         </ul>
        <!-- Facebook -->


        <?php
            $facebook = 'https://www.facebook.com/fortleonardwoodmissouri';
            $twitter = 'https://twitter.com/fortleonardwood';
            $youtube = 'https://www.youtube-nocookie.com/embed/SKG0OEi_XgI?list=PL91D410527AF9F662';
            $flickr = 'https://www.flickr.com/photos/58197238@N05/';
            $instagram = 'https://snapwidget.com/sl/?u=Zm9ydGxlb25hcmR3b29kfGlufDM1MHwxfDF8fG5vfDIwfG5vbmV8b25TdGFydHx5ZXN8bm8=&amp;ve=131115';
        ?>


        <div id="tabs-1" class="pierFacebook tab-pane ui-corner-bottom  in active">
            <div class="scroll250">
                <div id="fb-root"></div>
                <script>(function(d, s, id) {
                  var js, fjs = d.getElementsByTagName(s)[0];
                  if (d.getElementById(id)) return;
                  js = d.createElement(s); js.id = id;
                  js.src = "//connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.10&appId=568161160025250";
                  fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));</script>
                <div class="fb-page" data-href="<?php echo $facebook ?>" data-tabs="timeline" data-height="380" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="<?php echo $facebook ?>" class="fb-xfbml-parse-ignore"><a href="<?php echo $facebook ?>">U.S. Army Fort Leonard Wood</a></blockquote></div>
            </div>
            <div class="like-tab vmFacebook"><a href="https://www.facebook.com/fortleonardwoodmissouri">Like us on Facebook »</a></div>
        </div>

        <!-- Twitter -->
        <div id="tabs-2" class="pierTwitter tab-pane ui-corner-bottom ">
            <div class="twitter-feed-widget" style="overflow:auto; max-height:380px; max-width:auto; ?>">
            <a class="twitter-timeline" href="<?php echo $twitter ?>">Tweets by <?php echo 'fortleonardwood';?></a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
            </div>
            <div class="like-tab vmTwitter"><a href="https://twitter.com/fortleonardwood">Follow us on Twitter »</a></div>
        </div>

        <!-- Youtube -->
        <div id="tabs-3" class="pierYoutube scroll360 tab-pane ui-corner-bottom ">
            <div class="scroll250"><iframe width="360" height="240" src="<?php echo $youtube ?>" frameborder="0" allowfullscreen=""></iframe></div>
            <div class="like-tab vmYoutube"><a href="https://www.youtube.com/watch?v=SKG0OEi_XgI&list=PL91D410527AF9F662">Watch us on YouTube »</a></div>
        </div>

        <!-- Flickr -->
        <div id="tabs-4" class="pierFlickr scroll360 tab-pane ui-corner-bottom ">
            <div style="width:auto;height:350px;text-align:center;margin:auto;" ><object width="auto" height="350" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000"  codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0"> <param name="flashvars" value="offsite=true&amp;lang=en-us&amp;page_show_url=%2Fphotos%2F58197238%40N05%2Fshow&amp;page_show_back_url=%2Fphotos%2F58197238%40N05%2F&amp;user_id=58197238@N05" /> <param name="allowFullScreen" value="true" /> <param name="src" value="https://www.flickr.com/apps/slideshow/show.swf?v=71649" /> <embed width="auto" height="350" type="application/x-shockwave-flash" src="https://www.flickr.com/apps/slideshow/show.swf?v=71649" flashvars="offsite=true&amp;lang=en-us&amp;page_show_url=%2Fphotos%2F58197238%40N05%2Fshow&amp;page_show_back_url=%2Fphotos%2F58197238%40N05%2F&amp;user_id=58197238@N05" allowFullScreen="true" /> </object></div>
            <div class="like-tab vmFlickr"><a href="https://www.flickr.com/photos/58197238@N05/">View us on Flickr »</a></div>
        </div>

        <!-- Instagram -->
        <div id="tabs-5" class="pierRSS scroll360 tab-pane ui-corner-bottom ">
            <div class="scroll250"><iframe width="320" height="240" style="border: none; overflow: hidden; width: 300px; height: 350px;" src="<?php echo $instagram ?>" title="Instagram Widget" allowtransparency="true" frameborder="0" scrolling="no"></iframe></div>
            <div class="like-tab vmrss"><a href="https://www.instagram.com/fortleonardwood/">Follow us on Instagram »</a></div>
        </div>
    </div>
</div>

<style type="text/css">
    .tab-pane {
        padding: 5px;
    }
</style>
