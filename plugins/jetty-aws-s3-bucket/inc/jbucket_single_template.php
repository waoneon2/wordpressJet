<?php
if (!defined('ABSPATH')) exit;

get_header('jbucket');

?>
<div id="jbucket_primary" class="jbucket-content-area">
	<main id="jbucket_main" class="jbucket-site-main jbucket-container" role="main">
		<?php
		// echo get_post_meta( get_the_ID(), 'meta_url_object_bucket', true );
		function generate_html_tag_by_type_file($mime_type, $link_object){
			$html_document = '';

			if(jbucket_is_image($mime_type)){
				$html_document .= '<img src="'.esc_url($link_object).'" class="img-responsive" id="jbucket-image" >';
			}

			if(jbucket_is_document($mime_type)){
				$getNameofFile = basename(esc_url($link_object));
				$exp = explode('.',$getNameofFile);
	    		$getFileExtension = end($exp);
	    		$getFileName = $exp[0];

	    		$html_document .= '<div class="content_of_icon_document">';
	    			$html_document .= '<span class="name_of_extension">';
	    				$html_document .= $getFileExtension;
	    			$html_document .= '</span>';
	    		$html_document .= '</div>';

	    		$html_document .= '<div class="jbucket_document_filename">';
	    			$html_document .= '<a href="'.esc_url($link_object).'">';
	    				$html_document .= '<span class="name_of_file">';
	    					$html_document .= '<img src="'.jbucket_get_icon_document().'" class="jbucket_icon_document">';
	    					$html_document .= $getFileName;
	    				$html_document .= '</span>';
	    			$html_document .= '</a>';
	    		$html_document .= '</div>';
			}

			if(jbucket_is_video($mime_type)){
				$html_document .= '<video width="auto" controls>';
					$html_document .= '<source src="'.$link_object.'" type="'.$mime_type.'">';
					$html_document .= 'Your browser does not support HTML5 video.';
				$html_document .= '</video>';
			}

			return $html_document;
		}

		while ( have_posts() ) : the_post();
			$json = str_replace('""', '"', get_the_content());
			$jbucket_data = json_decode($json, true);

			$access_content = get_post_meta( get_the_ID(), 'jbucket_access', true );
			$content_for_pt = get_post_meta( get_the_ID(), 'meta_url_object_bucket', true );
			$getMimeType = jbucket_get_url_mime_type($content_for_pt);

			if($getMimeType === FALSE){
				$mimeTypeMeta = get_post_meta( get_the_ID(), 'jbucket_meta_content_type', true );
				$getMimeType = $mimeTypeMeta;
			}

			if($access_content === "public"){
				if(!empty($content_for_pt)){
					echo generate_html_tag_by_type_file($getMimeType, $content_for_pt);
				} else {
	                echo generate_html_tag_by_type_file($getMimeType, $jbucket_data['effectiveUri']);
				}
			} elseif($access_content === "private") {
				if(!is_user_logged_in()){
					wp_login_form();
				} else {
					if(!empty($content_for_pt)){
						echo generate_html_tag_by_type_file($getMimeType, $content_for_pt);
					} else {
		                echo generate_html_tag_by_type_file($getMimeType, $jbucket_data['effectiveUri']);
					}
				}
				
			} else {
				echo "Content Not Found";
			}
			

		endwhile; // End of the loop.
		wp_reset_postdata();
		?>
	</main><!-- #main -->
</div><!-- #primary -->
<?php

get_footer('jbucket');