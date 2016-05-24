<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.com/
 *
 * @package fooding
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 */
function fooding_jetpack_setup() {
	// Add theme support for Featured Content.
    add_theme_support( 'featured-content', array(
        'filter'     => 'fooding_get_featured_posts',
        'max_posts'  => 20,
        'post_types' => array( 'post' ),
    ) );

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );
}
add_action( 'after_setup_theme', 'fooding_jetpack_setup' );
