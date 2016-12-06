<?php
/**
 * Template part for displaying staff picks post.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package fooding
 */
?>
<div class="footer-staff-picks">

    		<?php
            $tags = get_theme_mod( 'fooding_staff_picks_tags' );
            $number   = intval( get_theme_mod( 'number_staff_picks', 5 ) );
            $number   = ( 0 != $number ) ? $number : 5;
            $args = array( 'posts_per_page' => $number , 'tag' => $tags , 'ignore_sticky_posts' => true, 'meta_query' => array(array('key' => '_thumbnail_id')) );
            $staff_picks = new WP_Query( $args );
            ?>

		    <?php
            if ( $staff_picks->have_posts() ) :
			    while( $staff_picks->have_posts() ): $staff_picks->the_post();
            ?>

			<!-- begin .hentry -->
			<article id="post-<?php the_ID(); ?>-recent" <?php post_class(); ?>>

				<!-- begin .featured-image -->
				<?php if ( has_post_thumbnail() ) { ?>
				<div class="featured-image">
					<?php if ( has_post_thumbnail() ) : ?><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'fooding-staff-picks' ); ?></a><?php endif; ?>
				</div>
				<?php } ?>
				<!-- end .featured-image -->

			</article>
			<!-- end .hentry -->
            <?php
				endwhile;
            endif;
            ?>

    		<?php wp_reset_postdata(); ?>

</div>
