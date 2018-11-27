<?php if ( is_single() ) : ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <span class="entry-header">
		<?php the_title(); ?>
    </span><!-- .entry-header -->    
    <div class="entry-content">
		<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
        <div class="entry-thumbnail">
            <?php the_post_thumbnail(); ?>
        </div>
        <?php endif; ?>     
         <?php $source_type = trim( get_post_meta( get_the_ID(), "institution_type", true) );
            if( !empty( $source_type ) && $source_type != 'No type yet' ) : // Checks Insititutions if it has a type.        
				$label_type = $source_type;?>     
            <?php
       		 else :
          		$label_type = 'No Type Yet'?> 
       		<?php endif; ?> 
		<?php $source_fed = trim( get_post_meta( get_the_ID(), 'federal_circuit', true ) );
            if( !empty( $source_fed ) ) : //checks to see is federal circuit has a rating          
				$label_fed = $source_fed;
       		else :
          		$label_fed = 'Not rated'?>
       		<?php endif; ?>
          <?php $source_rating = trim( get_post_meta( get_the_ID(), "school_speech_code_rating", true) );
            if( !empty( $source_rating  ) ) : //checks to see if Speach Code Rating has a rating 
            
        $field_rating = get_field_object('school_speech_code_rating');
        $value_rating = get_field('school_speech_code_rating');
        $label_rating = $field_rating['choices'][ $value_rating ];
            
        else :
            $label_rating = 'Not rated'?>
        <?php endif; ?>        
        <?php the_content(); ?>  
        <?php $school_thumb = trim( get_post_meta( get_the_ID(), "square_390x390", true) ); ?>           
		<?php if ( get_post_meta( get_the_ID(), "square_390x390", true) ) : //get the school thumbnail ?>
            <div class="entry-thumbnail">
              <img src="<?php echo the_field('square_390x390') ?>" alt="<?php the_title(); ?>" />
            </div>    
           <?php endif; ?>
		<p class="category">
			<?php print 'Location: '; the_field('city'); print ', '; the_field('state');      ?> <br />
	         <?php print'Website: '; ?> <a href="<?php the_field('website_url'); ?>" target="_blank"><?php the_field('website_url');    ?></a><br />
	        Type: <?php echo $label_type ?> <br />
            Federal Circuit: <?php echo $label_fed ?>
 			
	    </p>
       
        <p class="schools-redline"><em></em></p>
        
        <span class="entry-header">Speech Code Rating</span> 
        <p>
        <?php 
		if($label_rating == "Green") {	
			print '<img style="float:left;margin: 5px 20px 10px 0;" src="'. get_bloginfo('url') .'/wp-content/themes/thefire/images/green-light.png" />'; the_title(); print ' has been given the speech code rating '.$label_rating.'. Green light institutions are those colleges and universities whose policies nominally protect free speech. Read more <a href="/resources/spotlight/using-the-spotlight-database/#green">here</a>.';
		} elseif($label_rating == "Yellow") {
			print '<img style="float:left;margin: 5px 20px 10px 0;" src="'. get_bloginfo('url') .'/wp-content/themes/thefire/images/yellow-light.png" />'; the_title(); print ' has been given the speech code rating '.$label_rating.'. Yellow light colleges and universities are those institutions with at least one ambiguous policy that too easily encourages administrative abuse and arbitrary application. Read more <a href="/resources/spotlight/using-the-spotlight-database/#yellow">here</a>.';
		} elseif($label_rating == "Red") {	
			print '<img style="float:left;margin: 5px 20px 10px 0;" src="'. get_bloginfo('url') .'/wp-content/themes/thefire/images/red-light.png" />'; the_title(); print ' has been given the speech code rating '.$label_rating.'. A red light university has at least one policy that both clearly and substantially restricts freedom of speech. Read more <a href="/resources/spotlight/using-the-spotlight-database/#red">here</a>.';
		}  elseif($label_rating == "Exempt") {	
			print '<img style="float:left;margin: 5px 20px 10px 0;" src="'. get_bloginfo('url') .'/wp-content/themes/thefire/images/blue-light.png" />'; the_title(); print ' has been given the speech code rating '.$label_rating.'. Exempt institutions are private universities that express clearly and consistently that they believe in a set of values above the commitment of free speech. Read more <a href="/resources/spotlight/using-the-spotlight-database/#exempt">here</a>.';
		} else {
			print '<img style="float:left;margin: 5px 20px 10px 0;" src="'. get_bloginfo('url') .'/wp-content/themes/thefire/images/gray-light.png" />'; the_title(); print ' is not currently rated in our system. To request speech code information about this school, please submit a speech code <a href="'. get_bloginfo('url') .'/resources/speech-code-information-request/">request form.</a><br><br>';
		}
		?></p>		
       <div id="tabs">
       	<section class="posts-list">
      <ul>
        <li><a href="#tabs-1">Cases</a></li>
        <li><a href="#tabs-2">Speech Codes</a></li>
        <li><a href="#tabs-3">Media Coverage</a></li>
        <li><a href="#tabs-4">Commentary</a></li>
      </ul>
      <div id="tabs-1">
				<section class="posts-list">
				<?php			
			$connectedCases = new WP_Query( array(
			'connected_type' => 'school_cases',
			'connected_items' => get_queried_object(),
			'nopaging' => true,
			) );			
			// Display connected pages
			if ( $connectedCases->have_posts() ) {
				?>
				<ul class="no-style">
					<?php while ( $connectedCases->have_posts() ) : $connectedCases->the_post(); ?>
   
                <li><?php get_template_part( 'content-cases_tabs', get_post_format() ); ?></li>   
					<?php endwhile; ?>
				</ul>
				
				<?php 
				// Prevent weirdness
				wp_reset_postdata();
			
			} else {
				print 'This school does not have any Cases at this time.';
			}
			?> 
            </section>
      </div>
      <div id="tabs-2">
			<section class="posts-list">          
            <?php		
			$connectedSpeechCodes1 = new WP_Query( array(
			'connected_type' => 'statement_schools',
			'connected_items' => get_queried_object(),
			'nopaging' => true,
			'meta_key' => 'speech_code_rating',
			'orderby' => 'meta_value',
			'meta_value' => '1',
			'meta_compare' => '='
			) );			
			
			//echo $connectedSpeechCodes1->request;
			
			// Display connected pages
			if ( $connectedSpeechCodes1->have_posts() ) {
				?>
				<p class="title-codes"><span class="schools-Red-s"></span>Red Light Policies</p>
                <ul class="no-style">
					<?php while ( $connectedSpeechCodes1->have_posts() ) : $connectedSpeechCodes1->the_post(); ?>
				<li><?php get_template_part( 'content-schools_rating', get_post_format() ); ?></li>
					<?php endwhile; ?>
				<hr>
                </ul>
				<?php 
				// Prevent weirdness
				wp_reset_postdata();
			}
			?> 
             <?php		
			$connectedSpeechCodes2 = new WP_Query( array(
			'connected_type' => 'statement_schools',
			'connected_items' => get_queried_object(),
			'nopaging' => true,
			'meta_key' => 'speech_code_rating',
			'orderby' => 'meta_value',
			'meta_value' => '2',
			'meta_compare' => '='
			) );			
			// Display connected pages
			if ( $connectedSpeechCodes2->have_posts() ) {
				?>
				<header class="title-codes"><span class="schools-Yellow-s"></span>Yellow Light Policies</header>
                <ul class="no-style">
					<?php while ( $connectedSpeechCodes2->have_posts() ) : $connectedSpeechCodes2->the_post(); ?>
				<li><?php get_template_part( 'content-schools_rating', get_post_format() ); ?></li>
					<?php endwhile; ?>
				<hr>
                </ul>
				<?php 
				// Prevent weirdness
				wp_reset_postdata();
			}
			?> 
             <?php		
			$connectedSpeechCodes3 = new WP_Query( array(
			'connected_type' => 'statement_schools',
			'connected_items' => get_queried_object(),
			'nopaging' => true,
			'meta_key' => 'speech_code_rating',
			'orderby' => 'meta_value',
			'meta_value' => '3',
			'meta_compare' => '='
			) );			
			// Display connected pages
			if ( $connectedSpeechCodes3->have_posts() ) {
				?>
				<header class="title-codes"><span class="schools-Green-s"></span>Green Light Policies</header>
                <ul class="no-style">
					<?php while ( $connectedSpeechCodes3->have_posts() ) : $connectedSpeechCodes3->the_post(); ?>
				<li><?php get_template_part( 'content-schools_rating', get_post_format() ); ?></li>
					<?php endwhile; ?>
				<hr>
                </ul>
				<?php 
				// Prevent weirdness
				wp_reset_postdata();
			}
			?>                   
             <?php		
			$connectedSpeechCodes4 = new WP_Query( array(
			'connected_type' => 'statement_schools',
			'connected_items' => get_queried_object(),
			'nopaging' => true,
			'meta_key' => 'speech_code_rating',
			'meta_value' => array('1', '2', '3'),
			'meta_compare' => 'NOT IN'
			) );
			// Display connected pages
			if ( $connectedSpeechCodes4->have_posts() ) {
				?>
				<header class="title-codes"><span class="schools-Not-s"></span>Not Rated Policies</header>
                <ul class="no-style">
					<?php while ( $connectedSpeechCodes4->have_posts() ) : $connectedSpeechCodes4->the_post(); ?>
				<li><?php get_template_part( 'content-schools_rating', get_post_format() ); ?></li>
					<?php endwhile; ?>
				</ul>
				<?php 
				// Prevent weirdness
				wp_reset_postdata();
			} 
			
			if ( !$connectedSpeechCodes1->have_posts() && !$connectedSpeechCodes2->have_posts() && !$connectedSpeechCodes3->have_posts() && !$connectedSpeechCodes4->have_posts() ) {
				print 'This school does not have any Speech Codes at this time.';
			}
			?>                        
        </section>    
      </div>
      <div id="tabs-3">
      	<section class="posts-list">
				<?php
			
			$connectedRecentMedia = new WP_Query( array(
			'connected_type' => 'school_media',
			'connected_items' => get_queried_object(),
			'nopaging' => true,
			) );
			
			// Display connected pages
			if ( $connectedRecentMedia->have_posts() ) {
				?>
				<ul class="no-style">
					<?php while ( $connectedRecentMedia->have_posts() ) : $connectedRecentMedia->the_post(); ?>
				 <li><?php get_template_part( 'content-cases_tabs', get_post_format() ); ?></li> 
					<?php endwhile; ?>
				</ul>
				
				<?php 
				// Prevent weirdness
				wp_reset_postdata();
			
			} else {
				print 'This school does not have any Media Coverage at this time.';
			}
			?>      
      	</section>
      </div>
      <div id="tabs-4">
      	<section class="posts-list">
				<?php
			
			$connectedCommentary = new WP_Query( array(
			'connected_type' => 'school_commentary',
			'connected_items' => get_queried_object(),
			'nopaging' => true,
			) );
			
			// Display connected pages
			if ( $connectedCommentary->have_posts() ) {
				?>
				<ul class="no-style">
					<?php while ( $connectedCommentary->have_posts() ) : $connectedCommentary->the_post(); ?>
				 <li><?php get_template_part( 'content-cases_tabs', get_post_format() ); ?></li> 
					<?php endwhile; ?>
				</ul>
				
				<?php 
				// Prevent weirdness
				wp_reset_postdata();
			} else {
				print 'This school does not have any Commentary at this time.';
			}
			?> 
         </section>   
      </div>
      </section>
    </div>

    <?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
    </div><!-- .entry-content -->

    <footer class="entry-meta">
        <?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
    </footer><!-- .entry-meta -->
</article><!-- #post -->
<?php else: ?>
<div class="item">
	<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
    <?php $_cat = get_the_category_list( __( ', ', 'firecomps' ) ); if ($_cat): ?>
    <p class="category">Category: <?php echo get_the_category_list( __( ', ', 'firecomps' ) ); ?></p>
    <?php endif; ?>
	<?php the_excerpt(); ?>
    <p><a href="<?php the_permalink(); ?>" class="more">&raquo; Read More</a></p>
</div>
<?php endif; ?>