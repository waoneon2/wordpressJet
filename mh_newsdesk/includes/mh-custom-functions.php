<?php

/***** Add CSS classes to body tag *****/

if (!function_exists('mh_newsdesk_body_class')) {
	function mh_newsdesk_body_class($classes) {
		$mh_newsdesk_options = mh_newsdesk_theme_options();
		$classes[] = 'mh-' . esc_attr($mh_newsdesk_options['sidebar']) . '-sb';
		$classes[] = 'mh-loop-' . esc_attr($mh_newsdesk_options['archives']);
		return $classes;
	}
}
add_filter('body_class', 'mh_newsdesk_body_class');

/***** Logo/Sitename *****/

if (!function_exists('mh_newsdesk_logo')) {
	function mh_newsdesk_logo() {
		$header_img = get_header_image();
		$header_title = get_bloginfo('name');
		$header_desc = get_bloginfo('description');
		echo '<a href="' . esc_url(home_url('/')) . '" title="' . esc_attr($header_title) . '" rel="home">' . "\n";
		echo '<div class="logo-wrap" role="banner">' . "\n";
		if ($header_img) {
			echo '<img src="' . esc_url($header_img) . '" height="' . get_custom_header()->height . '" width="' . get_custom_header()->width . '" alt="' . esc_attr($header_title) . '" />' . "\n";
		}
		if (display_header_text()) {
			$text_color = get_header_textcolor();
			if ($text_color != get_theme_support('custom-header', 'default-text-color')) {
				echo '<style type="text/css" id="mh-header-css">';
					echo '.logo-title, .logo-tagline { color: #' . esc_attr($text_color) . '; }';
				echo '</style>' . "\n";
			}
			echo '<div class="logo">' . "\n";
			if ($header_title) {
				echo '<h1 class="logo-title">' . esc_attr($header_title) . '</h1>' . "\n";
			}
			if ($header_desc) {
				echo '<h2 class="logo-tagline">' . esc_attr($header_desc) . '</h2>' . "\n";
			}
			echo '</div>' . "\n";
		}
		echo '</div>' . "\n";
		echo '</a>' . "\n";
	}
}

/***** Page Title Output *****/

if (!function_exists('mh_newsdesk_page_title')) {
	function mh_newsdesk_page_title() {
		if (!is_front_page()) {
			echo '<h1 class="page-title">';
			if (is_archive()) {
				if (is_category() || is_tax()) {
					single_cat_title();
				} elseif (is_tag()) {
					single_tag_title();
				} elseif (is_author()) {
					global $author;
					$user_info = get_userdata($author);
					printf(_x('Articles by %s', 'post author', 'mh-newsdesk'), esc_attr($user_info->display_name));
				} elseif (is_day()) {
					echo get_the_date();
				} elseif (is_month()) {
					echo get_the_date('F Y');
				} elseif (is_year()) {
					echo get_the_date('Y');
				} elseif (is_post_type_archive()) {
					global $post;
					$post_type = get_post_type_object(get_post_type($post));
					echo $post_type->labels->name;
				} else {
					_e('Archives', 'mh-newsdesk');
				}
			} else {
				if (is_home()) {
					echo get_the_title(get_option('page_for_posts', true));
				} elseif (is_404()) {
					_e('Page not found (404)', 'mh-newsdesk');
				} elseif (is_search()) {
					printf(__('Search Results for %s', 'mh-newsdesk'), esc_attr(get_search_query()));
				} else {
					the_title();
				}
			}
			echo '</h1>' . "\n";
		}
	}
}

/***** Output Post Meta Data *****/

if (!function_exists('mh_newsdesk_post_meta')) {
	function mh_newsdesk_post_meta() {
		$mh_newsdesk_options = mh_newsdesk_theme_options();
		$post_cat = !$mh_newsdesk_options['post_meta_cat'];
		$post_author = !$mh_newsdesk_options['post_meta_author'];
		$post_date = !$mh_newsdesk_options['post_meta_date'];
		if ($post_cat || $post_author || $post_date) {
			echo '<p class="entry-meta">' . "\n";
				if (has_category() && $post_cat && !is_single()) {
					echo '<span class="entry-meta-cats">' . get_the_category_list(', ', '') . '</span>' . "\n";
				}
				if ($post_author && is_single()) {
					echo '<span class="entry-meta-author vcard author">' . sprintf(_x('Posted By: %s', 'post author', 'mh-newsdesk'), '<a class="fn" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a>') . '</span>' . "\n";
				}
				if ($post_date) {
					echo '<span class="entry-meta-date updated">' . get_the_date() . '</span>' . "\n";
				}
			echo '</p>' . "\n";
		}
	}
}

/***** Featured Image on Posts *****/

if (!function_exists('mh_newsdesk_featured_image')) {
	function mh_newsdesk_featured_image() {
		$mh_newsdesk_options = mh_newsdesk_theme_options();
		global $page, $post;
		if (has_post_thumbnail() && $page == '1' && $mh_newsdesk_options['featured_image'] == 'enable') {
			$caption_text = get_post(get_post_thumbnail_id())->post_excerpt;
			echo "\n" . '<div class="entry-thumbnail">' . "\n";
				the_post_thumbnail('content-single');
				if ($caption_text) {
					echo '<span class="wp-caption-text">' . wp_kses_post($caption_text) . '</span>' . "\n";
				}
			echo '</div>' . "\n";
		}
	}
}

/***** Custom Excerpts *****/

if (!function_exists('mh_newsdesk_trim_excerpt')) {
	function mh_newsdesk_trim_excerpt($text = '') {
		$raw_excerpt = $text;
		if ('' == $text) {
			$mh_newsdesk_options = mh_newsdesk_theme_options();
			$text = get_the_content('');
			$text = strip_shortcodes($text);
			$text = apply_filters('the_content', $text);
			$text = str_replace(']]>', ']]&gt;', $text);
			$excerpt_length = apply_filters('excerpt_length', $mh_newsdesk_options['excerpt_length']);
			$excerpt_more = apply_filters('excerpt_more', '...');
			$text = wp_trim_words($text, $excerpt_length, $excerpt_more);
		}
		return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
	}
}
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'mh_newsdesk_trim_excerpt');

/***** Archive Layouts *****/

if (!function_exists('mh_newsdesk_loop_layout')) {
	function mh_newsdesk_loop_layout() {
		global $paged;
		$mh_newsdesk_options = mh_newsdesk_theme_options();
		if ($mh_newsdesk_options['archives'] === 'layout1' && is_home() && $paged < 2 || $mh_newsdesk_options['archives'] === 'layout1' && is_category() && $paged < 2) {
			global $wp_query;
			$counter = 1;
			$max_posts = $wp_query->post_count;
			while (have_posts()) : the_post();
				if ($counter === 1) {
					get_template_part('content', 'lead');
					echo '<div class="mh-separator"></div>' . "\n";
				}
				if ($counter === 1 && $max_posts > 1) {
					echo '<div class="archive-grid mh-section mh-group">' . "\n";
				}
				if ($counter > 1 && $counter <= 9) {
					get_template_part('content', 'grid');
				}
				if ($counter === 5 && $max_posts > 5) {
					echo '</div>' . "\n";
					echo '<div class="mh-separator hidden-sm"></div>' . "\n";
					echo '<div class="archive-grid mh-section mh-group">' . "\n";
				}
				if ($counter === 10) {
					echo '</div>' . "\n";
					echo '<div class="mh-separator hidden-sm"></div>' . "\n";
					echo '<div class="archive-list mh-section mh-group">' . "\n";
				}
				if ($counter >= 10) {
					get_template_part('content');
				}
				if ($counter > 1 && $counter === $max_posts) {
					echo '</div>' . "\n";
					if ($counter < 10) {
						echo '<div class="mh-separator"></div>' . "\n";
					}
				}
			$counter++;
			endwhile;
		} elseif ($mh_newsdesk_options['archives'] === 'layout2') {
			$counter = 1;
			while (have_posts()) : the_post();
				if ($counter === 1) {
					get_template_part('content', 'lead');
					echo '<div class="mh-separator"></div>' . "\n";
				} else {
					get_template_part('content');
				}
			$counter++;
			endwhile;
		} elseif ($mh_newsdesk_options['archives'] === 'layout3') {
			while (have_posts()) : the_post();
				get_template_part('content', 'lead');
				echo '<div class="mh-separator"></div>' . "\n";
			endwhile;
		} else {
			while (have_posts()) : the_post();
				get_template_part('content');
			endwhile;
		}
	}
}

/***** Pagination *****/

if (!function_exists('mh_newsdesk_pagination')) {
	function mh_newsdesk_pagination() {
		global $wp_query;
	    $big = 9999;
	    $paginate_links = paginate_links(array(
	    	'base' 		=> str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
	    	'format' 	=> '?paged=%#%',
	    	'current' 	=> max(1, get_query_var('paged')),
	    	'prev_next' => true,
	    	'prev_text' => __('&laquo;', 'mh-newsdesk'),
	    	'next_text' => __('&raquo;', 'mh-newsdesk'),
	    	'total' 	=> $wp_query->max_num_pages
	    ));
	    if ($paginate_links) {
	    	echo '<div class="pagination clearfix">';
				echo $paginate_links;
			echo '</div>';
		}
	}
}

/***** Pagination for paginated Posts *****/

if (!function_exists('mh_newsdesk_posts_pagination')) {
	function mh_newsdesk_posts_pagination($content) {
		if (is_singular() && is_main_query()) {
			$content .= wp_link_pages(array('before' => '<div class="pagination clear">', 'after' => '</div>', 'link_before' => '<span class="pagelink">', 'link_after' => '</span>', 'nextpagelink' => __('&raquo;', 'mh-newsdesk'), 'previouspagelink' => __('&laquo;', 'mh-newsdesk'), 'pagelink' => '%', 'echo' => 0));
		}
		return $content;
	}
}
add_filter('the_content', 'mh_newsdesk_posts_pagination', 1);

/***** Post / Image Navigation *****/

if (!function_exists('mh_newsdesk_postnav')) {
	function mh_newsdesk_postnav() {
		global $post;
		$mh_newsdesk_options = mh_newsdesk_theme_options();
		if ($mh_newsdesk_options['post_nav'] == 'enable') {
			$parent_post = get_post($post->post_parent);
			$attachment = is_attachment();
			$previous = ($attachment) ? $parent_post : get_adjacent_post(false, '', true);
			$next = get_adjacent_post(false, '', false);

			if (!$next && !$previous)
			return;

			if ($attachment) {
				$attachments = get_children(array('post_type' => 'attachment', 'post_mime_type' => 'image', 'post_parent' => $parent_post->ID));
				$count = count($attachments);
			}
			echo '<nav class="post-nav-wrap" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">' . "\n";
				echo '<ul class="post-nav clearfix">' . "\n";
					if ($previous || $attachment) {
						echo '<li class="post-nav-prev">' . "\n";
							if ($attachment) {
								if ($count == 1) {
									$permalink = get_permalink($parent_post);
									echo '<a href="' . $permalink . '"><i class="fa fa-chevron-left"></i>' . __('Back to post', 'mh-newsdesk') . '</a>';
								} else {
									previous_image_link('%link', '<i class="fa fa-chevron-left"></i>' . __('Previous image', 'mh-newsdesk'));
								}
							} else {
								previous_post_link('%link', '<i class="fa fa-chevron-left"></i>' . __('Previous post', 'mh-newsdesk'));
							}
						echo '</li>' . "\n";
					}
					if ($next || $attachment) {
						echo '<li class="post-nav-next">' . "\n";
							if ($attachment) {
								next_image_link('%link', __('Next image', 'mh-newsdesk') . '<i class="fa fa-chevron-right"></i>');
							} else {
								next_post_link('%link', __('Next post', 'mh-newsdesk') . '<i class="fa fa-chevron-right"></i>');
							}
						echo '</li>' . "\n";
					}
				echo '</ul>' . "\n";
			echo '</nav>' . "\n";
		}
	}
}

/***** Custom Commentlist *****/

if (!function_exists('mh_newsdesk_comments')) {
	function mh_newsdesk_comments($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment; ?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
			<div id="comment-<?php comment_ID(); ?>">
				<div class="vcard meta">
					<?php echo get_avatar($comment->comment_author_email, 70); ?>
					<span class="fn"><?php echo get_comment_author_link() ?></span> |
					<a href="<?php echo esc_url(get_comment_link($comment->comment_ID)) ?>"><?php printf(__('%1$s at %2$s', 'mh-newsdesk'), get_comment_date(),  get_comment_time()) ?></a> |
					<?php if (comments_open() && $args['max_depth']!=$depth) { ?>
						<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
					<?php } ?>
					<?php edit_comment_link(__('(Edit)', 'mh-newsdesk'),'  ','') ?>
				</div>
				<?php if ($comment->comment_approved == '0') : ?>
					<div class="comment-info"><?php _e('Your comment is awaiting moderation.', 'mh-newsdesk') ?></div>
				<?php endif; ?>
				<div class="comment-text">
					<?php comment_text() ?>
				</div>
			</div><?php
	}
}

/***** Custom Comment Fields *****/

if (!function_exists('mh_newsdesk_comment_fields')) {
	function mh_newsdesk_comment_fields($fields) {
		$commenter = wp_get_current_commenter();
		$req = get_option('require_name_email');
		$aria_req = ($req ? " aria-required='true'" : '');
		$fields =  array(
			'author'	=>	'<p class="comment-form-author"><label for="author">' . __('Name ', 'mh-newsdesk') . '</label>' . ($req ? '<span class="required">*</span>' : '') . '<br/><input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' /></p>',
			'email' 	=>	'<p class="comment-form-email"><label for="email">' . __('Email ', 'mh-newsdesk') . '</label>' . ($req ? '<span class="required">*</span>' : '' ) . '<br/><input id="email" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . ' /></p>',
			'url' 		=>	'<p class="comment-form-url"><label for="url">' . __('Website', 'mh-newsdesk') . '</label><br/><input id="url" name="url" type="text" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" /></p>'
		);
		return $fields;
	}
}
add_filter('comment_form_default_fields', 'mh_newsdesk_comment_fields');

/***** Read More Button *****/

if (!function_exists('mh_newsdesk_more')) {
	function mh_newsdesk_more() {
		$mh_newsdesk_options = mh_newsdesk_theme_options();
		if ($mh_newsdesk_options['excerpt_more'] != '') { ?>
			<a class="button" href="<?php the_permalink(); ?>">
				<span><?php echo esc_attr($mh_newsdesk_options['excerpt_more']); ?></span>
			</a><?php
		}
	}
}

/***** Social Share Buttons *****/

if (!function_exists('mh_newsdesk_share_buttons')) {
	function mh_newsdesk_share_buttons() {
		$mh_newsdesk_options = mh_newsdesk_theme_options();
		if ($mh_newsdesk_options['social_sharing'] == 'enable') {
			get_template_part('content', 'social');
		}
	}
}

/***** Load Facebook Script (SDK) *****/

if (!function_exists('mh_newsdesk_facebook_sdk')) {
	function mh_newsdesk_facebook_sdk() {
		if (is_active_widget('', '', 'mh_newsdesk_facebook_page')) {
			global $locale; ?>
			<div id="fb-root"></div>
			<script>
				(function(d, s, id){
					var js, fjs = d.getElementsByTagName(s)[0];
					if (d.getElementById(id)) return;
					js = d.createElement(s); js.id = id;
					js.src = "//connect.facebook.net/<?php echo esc_attr($locale); ?>/sdk.js#xfbml=1&version=v2.6";
					fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));
			</script> <?php
		}
	}
}
add_action('wp_footer', 'mh_newsdesk_facebook_sdk');

/***** Add CSS3 Media Queries Support for older versions of IE *****/

function mh_newsdesk_media_queries() {
	echo '<!--[if lt IE 9]>' . "\n";
	echo '<script src="' . get_template_directory_uri() . '/js/css3-mediaqueries.js"></script>' . "\n";
	echo '<![endif]-->' . "\n";
}
add_action('wp_head', 'mh_newsdesk_media_queries');

?>