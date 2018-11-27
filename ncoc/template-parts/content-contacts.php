<?php
/**
 * Template part for displaying posts by category contacts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package NCOC
 */
?>
<div class="archive-contact-container">
        <div class="ncoc-contact-content">
            <div class="place-img-contact">
            <?php if(has_post_thumbnail()) : ?>
                <?php the_post_thumbnail(); ?> 
            <?php endif; ?>
            </div>
            <div class="place-contact-detail">
                <?php the_title( '<p class="ncoc entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></p>' ); ?>
                <div class="content-contact">
                    <?php the_content(); ?>
                </div>
            </div>
        
        </div>
</div>
