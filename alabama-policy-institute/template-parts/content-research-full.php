<?php
/**
 * Template part for displaying research
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Alabama_Policy_Institute
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(['report__box', 'report__box--large']); ?>>
    <div class="report__img" style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'alpi-research-thumbnail'); ?>')"></div>
    <div class="report__content">
        <?php the_title( '<h4><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' ); ?>
        <p class="report__date"><?php the_time('M j, Y'); ?></p>
        <a href="<?php the_permalink(); ?>" class="btn btn--decoration report__btn btn--dark btn--small"><?php _e("Read More", "alabama-policy-institute"); ?>
            <svg class="btn__icon" xmlns="http://www.w3.org/2000/svg" width="8" height="12" viewBox="0 0 8 12"><path fill="#4b515b" d="M7.75 6.59l-5.28 5.16a.87.87 0 0 1-1.22 0 .83.83 0 0 1 0-1.19L5.92 6 1.25 1.43a.83.83 0 0 1 0-1.19.9.9 0 0 1 1.22 0L7.75 5.4a.83.83 0 0 1 0 1.19z"/>
            </svg>
        </a>
        <?php if ($url = get_the_research_report_url()): ?>
        <a href="<?php echo esc_url($url); ?>" class="btn btn--download">
            <svg class="btn__icon" xmlns="http://www.w3.org/2000/svg" width="29" height="17" viewBox="0 0 29 17"><path fill="#4b515b" d="M7.57 3.7H3.78v8.6h1.26V8.63h2.53a2.5 2.5 0 0 0 2.52-2.47A2.5 2.5 0 0 0 7.57 3.7zm0 3.68H5.04V4.92h2.53c.75 0 1.26.5 1.26 1.23 0 .74-.5 1.23-1.26 1.23zM25.22 0H3.78A3.67 3.67 0 0 0 0 3.7v8.6C0 14.4 1.64 16 3.78 16h21.44c2.14 0 3.78-1.6 3.78-3.7V3.7C29 1.6 27.36 0 25.22 0zm2.52 12.3a2.5 2.5 0 0 1-2.52 2.47H3.78a2.5 2.5 0 0 1-2.52-2.46V3.69a2.5 2.5 0 0 1 2.52-2.46h21.44a2.5 2.5 0 0 1 2.52 2.46zM15.13 3.7h-3.78v8.6h3.78a2.5 2.5 0 0 0 2.52-2.45v-3.7a2.5 2.5 0 0 0-2.52-2.46zm1.26 6.15c0 .73-.5 1.23-1.26 1.23h-2.52V4.92h2.52c.76 0 1.26.5 1.26 1.23zm2.52 2.46h1.26V8.6h3.79V7.39h-3.79V4.92h5.05V3.7h-6.3z"/>
            </svg><?php _e('DOWNLOAD REPORT', 'alabama-policy-institute'); ?>
        </a>
        <?php endif; ?>
    </div>
</article>