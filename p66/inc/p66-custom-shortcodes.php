<?php 

function alert_message_shortcode() {
    return 'If you enjoyed this article, I encourage you to &lt;a href=&quot;http://feeds.feedburner.com/ElegantThemes&quot; title=&quot;Subscribe to Our Blog&quot;&gt;subscribe to the Elegant Themes blog via RSS&lt;/a&gt;.';
    ?>
	<div class="row alert alert-fail">
		<i class="glyphicon glyphicon-exclamation-sign"></i>Alert message goes here. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
	</div>
    <?php
}
add_shortcode('alert', 'alert_message_shortcode');