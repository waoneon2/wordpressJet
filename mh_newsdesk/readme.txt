=== MH Newsdesk - Dynamic News WordPress Theme ===
Theme URI: http://www.mhthemes.com/themes/mh/newsdesk/
Tags: Magazine, News, Blog, Responsive
Requires at least: 4.1.0
Tested up to: 4.6.0
Stable tag: 1.4.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
MH Newsdesk WordPress Theme, Copyright 2015 MH Themes
MH Newsdesk is distributed under the terms of the GNU GPL

==================================
Description
==================================

MH Newsdesk is a modern and dynamic news WordPress theme with great flexibility and powerful features. This advanced news template is ideal for up-to-date online newspapers, brilliant news magazines and all kind of other vibrant news websites. Styled in flat design MH Newsdesk WordPress Theme is focusing on your newsworthy and fresh content. 

==================================
Documentation & Theme Support
==================================

In case you have any questions regarding your WordPress theme, please visit our support center where you can find the theme documentation, tutorials and a lot of helpful information: http://www.mhthemes.com/support/

==================================
Licenses of bundled Resources
==================================

1.) Modernizr 2.8.3 (Custom Build) | MIT & BSD license
Source: http://modernizr.com/
License: http://modernizr.com/license/

2.) SlickNav Responsive Mobile Menu v1.0.0 | MIT license
Source: http://slicknav.com/
License: http://opensource.org/licenses/mit-license.php

3.) Google Webfonts | SIL Open Font License (OFL)
Source: https://www.google.com/fonts
License: http://scripts.sil.org/OFL

4.) Font Awesome Icon Fonts | SIL OFL 1.1 | Code licensed under MIT License
Source: http://fontawesome.io/
License: http://opensource.org/licenses/mit-license.php
License: http://scripts.sil.org/OFL

5.) CSS3 Media Queries support for old browsers | MIT license
Source: https://code.google.com/p/css3-mediaqueries-js/
License: http://opensource.org/licenses/mit-license.php

6.) Images from Theme Screenshot
Source: Pixabay.com
License: Free Public Domain (GPL Compatible)
Overview: http://demo.mhthemes.com/newsdesk/credits/

==================================
Changelog
==================================

= v1.4.0 20-09-2016 =
* Added option to change layout of archives
* Added 3 alternative layouts for archives
* Added option to disable / hide tags on posts
* Improved code for default magazine / news layout 
* Improved header.php to load pingback URL only on posts
* Implemented additional structured data for better SEO
* Updated Facebook JavaScript-SDK to v2.6
* Removed role attribute for nav elements to fix warnings in W3C validation
* Removed redundant conditional tag in mh_newsdesk_scripts()
* Removed redundant file content-news.php
* Added norwegian (bokmål) translation - thanks to Jan Sandtrø
* Updated german translation
* Updated translation files

= v1.3.0 04-04-2016 =
* Overall code maintenance
* Added selective refresh support for widgets (introduced in WP 4.5)
* Added option to MH YouTube Video widget to enable autoplay
* Added option to MH YouTube Video widget to display video title / information
* Added option to MH YouTube Video widget to display player controls
* Added option to MH YouTube Video widget to enable recommended videos
* Modified iframe of MH YouTube Video widget to allow fullscreen mode
* Added Google Webfonts character subsets for arabic, hebrew and vietnamese language
* Added several new Google Webfonts to fonts collection in customizer
* Improved implementation of Google Webfonts
* Updated theme screenshot
* Updated translation files
* Updated german translation

= v1.2.2 15-12-2015 =
* Overall code maintenance
* Improved breadcrumb navigation to display parents of parent pages
* Fixed issue with WordPress comments appearing on BuddyPress pages
* Fixed HTML5 validation notices for Google Webfonts
* Added CSS class to image placeholders
* Added missing structured data (hentry) on archives
* Removed option to disable comments on pages (disabled by default since WP 4.3)
* Removed option to add favicon in favor of Site Icon feature in WP 4.3
* Adjusted margins in comment form to support new layout in WordPress 4.4
* Renamed template-authorbox.php to content-author-box.php
* Renamed template-news-ticker.php to content-news-ticker.php
* Moved social buttons to content-social.php
* Removed redundant file comments-pages.php

= v1.2.1 07-10-2015 =
* Fixed issue with capitalisation of letters in post/page titles
* Added IDs to widget areas for improved customization experience
* Added files for Font Awesome icons v4.4.0
* Added missing escaping to links on theme admin page
* Removed backwards compatibility of title tag (introduced in WP 4.1)
* Improved function for Google Webfonts to load fonts via HTTPS

= v1.2.0 07-08-2015 =
* Several minor code improvements
* Improved sanitization of color options
* Fixed small issue with translations in comments.php
* Fixed issue with large horizontal scroll bar in RTL layout
* Fixed escaping of featured image caption to allow HTML
* Added theme support for title tags (introduced in WP 4.1)
* Added danish translation - thanks to Casper Reiff
* Added czech translation - thanks to Karolina Vyskocilova
* Updated german translation
* Updated translation files
* Updated constructor method for WP_Widget to fully support WordPress 4.3.0

= v1.1.0 20-04-2015 =
* Included css3-mediaqueries.js because Google Code will cease operations
* Improved handling of responsive embeds
* Improved microformats (hCard) for comments
* Added proper copyright attribution to readme.txt
* Added MH Facebook page widget (replaced MH Facebook likebox widget)
* Removed MH Facebook likebox widget (deprecated from June 23rd 2015)
* Updated Facebook SDK
* Updated child theme to load stylesheet with wp_enqueue_scripts() instead of @import
* Updated translation files
* Updated german translation

= v1.0.2 06-03-2015 =
* Several minor CSS adjustments
* Several minor code improvements
* Added function for favicon output
* Added conditional to allow full-width header image
* Added conditional to not display more-button if no read-more text exists
* Added option to hide date for MH Custom Posts widget
* Added RSS icon as default in case URL is not supported by social icons in header
* Redesigned share buttons and moved position of buttons to below post content
* Improved CSS for search widget / search form
* Improved function for prev/next post links to prevent unnecessary markup
* Fixed incorrect textdomain on sitemap template
* Fixed incorrect conditional for $content_width definition
* Fixed issue where category filter for news ticker did only accept one category ID
* Updated Font Awesome icons to v4.3.0
* Updated translation files
* Updated german translation

= v1.0.1 02-02-2015 =
* Fixed issue with option for sharing buttons 

= v1.0.0 30-01-2015 =
* Initial release