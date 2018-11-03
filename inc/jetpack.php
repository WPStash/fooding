<?php
/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.com/
 *
 * @package Fooding
 */
/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 * See: https://jetpack.com/support/content-options/
 */
function fooding_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'fooding_infinite_scroll_render',
		'footer'    => 'page',
	) );
	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

}
add_action( 'after_setup_theme', 'fooding_jetpack_setup' );
/**
 * Custom render function for Infinite Scroll.
 */
function fooding_infinite_scroll_render() {
    $homepage_layout = esc_attr( get_theme_mod( 'fooding_homepage_layout', 'default' ) );
    $archive_layout = get_theme_mod( 'fooding_archive_layout', 'default' );
    $count = 0;
	while ( have_posts() ) {
		the_post();
		if ( is_search() || is_archive() ) :

            switch ( $archive_layout ) {
               case 'grid':
                   get_template_part( 'template-parts/content', 'grid' );
                   break;

               default:
                   get_template_part( 'template-parts/content', 'grid-large' );
                   break;
           }
           
		else :

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

		endif;
        $count++;
	}
}
