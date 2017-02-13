<?php
/**
 * Template part for displaying Homepage layout 1.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Fooding
 */

?>
<!-- begin .hentry -->
<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-grid' ); ?> >

	<!-- begin .featured-image -->
	<?php if ( has_post_thumbnail() ) { ?>
	<div class="featured-image">
		<?php if ( has_post_thumbnail() ) : ?><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'fooding-default' ); ?></a><?php endif; ?>
	</div>
	<?php } ?>
	<!-- end .featured-image -->

	<!-- begin .entry-info -->
	<div class="entry-info">

		<!-- begin .entry-header -->
		<header class="entry-header">
            <?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

			<div class="entry-meta">
                <?php fooding_posted_on_without_cat(); ?>
			</div>

		</header>
		<!-- end .entry-header -->

		<!-- begin .entry-content -->
		<section class="entry-content">
            <p><?php the_excerpt(); ?></p>
        </section>
		<!-- end .entry-content -->

	</div>
	<!-- end .entry-info -->

</article>
<!-- end .hentry -->
