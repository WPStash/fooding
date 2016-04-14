<?php
/**
 * Template part for displaying post grid large Layout.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Fooding
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <!-- begin .featured-image -->
    <?php if ( has_post_thumbnail() ) { ?>
    <div class="featured-image">
        <?php if ( has_post_thumbnail() ) : ?><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('fooding-homepage-1'); ?></a><?php endif; ?>
    </div>
    <?php } ?>
    <!-- end .featured-image -->

    <div class="entry-info">
            <!-- begin .entry-header -->
            <div class="entry-header">

                <?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

                <div class="entry-meta">

                    <?php fooding_posted_on(); ?>

                </div>

            </div>
            <!-- end .entry-header -->

            <div class="entry-content">
                <?php  the_excerpt(); ?>
            </div><!-- .entry-content -->
    </div>
</article><!-- #post-## -->
