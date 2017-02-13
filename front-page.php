<?php
/**

 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Fooding
 */

get_header(); ?>

<div class="container">


	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		global $wp_query;

		if ( get_query_var('paged') ) {
			$paged = get_query_var('paged');
		} elseif ( get_query_var('page') ) { 
			$paged = get_query_var('page');
		} else {
			$paged = 1;
		}

		$args = array( 'post_type' => 'post', 'paged' => $paged );

        $query = new WP_Query( $args );

		$homepage_layout = esc_attr( get_theme_mod( 'fooding_homepage_layout', 'default' ) );
		$count = 0;
		if ( $query->have_posts() ) :

			/* Start the Loop */
			while ( $query->have_posts() ) : $query->the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				switch ( $homepage_layout ) {
		 			case 'home1':
		 				get_template_part( 'template-parts/content', 'grid-large' );
		 				break;

		 			case 'home2':
						if ( $count == 0) {
							get_template_part( 'template-parts/content', 'grid-large' );
						}
						else {
							get_template_part( 'template-parts/content', 'grid' );
						}
		 				break;

		 			default:
		 				get_template_part( 'template-parts/content', 'grid' );
		 				break;
		 		}

			$count++;
			endwhile;

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;

		if (  $wp_query->max_num_pages > 1  ) {
			echo '<div class="post-pagination">';
			the_posts_pagination( array(
				'prev_next' => true,
				'prev_text' => '',
				'next_text' => '',
				'before_page_number' => '<span class="screen-reader-text">' . esc_html__('Page', 'fooding') . ' </span>',
			));
			echo '</div>';
		}
		wp_reset_postdata();

		?>
		</main><!-- #main -->
	</div><!-- #primary -->

	<?php get_sidebar(); ?>

</div>

<?php get_footer();
