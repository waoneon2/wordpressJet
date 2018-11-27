<?php
/**
 * Represents the view for the administration dashboard.
 *
 * This includes the header, options, and other information that should provide
 * The User Interface to the end user.
 *
 * @package   Plugin_Name
 * @author    Your Name <email@example.com>
 * @license   GPL-2.0+
 * @link      http://example.com
 * @copyright 2014 Your Name or Company Name
 */
?>

<div class="wrap">

	<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
	
	<p>
	<form method="post">
		<label>Start Date
		<input type="input" name="dates[start_date]" class="datepicker">
		</label>
		
		<label>End Date
		<input type="input" name="dates[end_date]" class="datepicker">
		</label>
		
		<input class="button-primary" type="submit" name="submit" value="Submit">
		<p>Enter the date range for which you would like to view stats. Default is last 90 days.</p>
	</form>
	</p>
	
	<hr>
	
	<h3>Post Stats for <?php echo $range; ?></h3>
	<ul>
		<li>Total Posts: <?php echo $post_stats['total_posts']; ?></li>
	</ul>
	<h4>By Category</h4>
	<ul>
		<?php foreach ( $post_stats['categories'] as $k => $v ) : ?>
			<?php $term = get_term_by('slug', $k, 'category'); ?>
			<li><?php echo $term->name; ?>: <?php echo $v; ?></li>
		<?php endforeach; ?>
	</ul>
	
	<hr>
		
	<h3>Inquiry Stats for <?php echo $range; ?></h3>
	
	
	<h4>Counts by Inquiry Status</h4>
	<ul>
		<li>Open: <?php echo $inquiry_stats['open']; ?></li>
		<li>Closed: <?php echo $inquiry_stats['closed']; ?></li>
		<li>On Hold: <?php echo $inquiry_stats['hold']; ?></li>
	</ul>
		
	
	<h4>Inquiries by Category</h4>
	<ul>
		<?php foreach ( $inquiry_stats['categories'] as $k => $v ) : ?>
			<?php $iterm = $k != 'uncategorized' ? get_term_by('slug', $k, 'inquiry_category') : 'Uncategorized'; ?>
			<li><?php echo isset($iterm->name) ? $iterm->name : $iterm; ?>: <?php echo $v; ?></li>
		<?php endforeach; ?>
	</ul>
		
	<h4>Inquiries by Source</h4>
	<ul>
		<?php foreach ( $inquiry_stats['source'] as $k => $v ) : ?>
			<li><?php echo $k == 'unknown' ? 'Unknown' : $inquiry_stats['sources'][$k]; ?>: <?php echo $v; ?></li>
		<?php endforeach; ?>
	<pre>
	<?php
	//	print_r( Jetty_Inquiries::get_all_sources() );
	?>
	</pre>

</div>
<script type="text/javascript">
	jQuery( function() {
		jQuery( ".datepicker" ).datepicker();
	} );
</script>