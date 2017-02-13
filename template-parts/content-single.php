<?php
/**
 * Template part for displaying page content in single.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package fooding
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
	<div class="entry-thumb">
		<?php the_post_thumbnail( 'fooding-homepage-1' ); ?>
	</div>
	<?php endif; ?>

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php fooding_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'fooding' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php
	the_post_navigation( array(
            'prev_text'                  => '<span>' . esc_html__( 'Previous article', 'fooding' ) .'</span> %title',
            'next_text'                  => '<span>' . esc_html__( 'Next article', 'fooding' ) .'</span> %title',
            'in_same_term'               => true,
            'screen_reader_text' 		 => esc_html__( 'Continue Reading', 'fooding' ),
    ) );
	?>

	<footer class="entry-footer">
		<?php fooding_entry_footer(); ?>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
