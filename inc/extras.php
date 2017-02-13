<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Fooding
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function fooding_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	if ( is_front_page() || is_home() ) {
		$homepage_layout = get_theme_mod( 'fooding_homepage_layout', 'default' );
		$classes[] = 'homepage-'.$homepage_layout;
	}

	if ( is_page_template( 'template-fullwidth.php' )) {
		$classes[] = 'full-width';
	}

	return $classes;
}
add_filter( 'body_class', 'fooding_body_classes' );


// add category nicenames in body and post class
function fooding_no_thumbnail_class( $classes ) {
	global $post;
	if ( ! has_post_thumbnail( $post->ID ) ) {
		$classes[] = 'no-post-thumbnail';
	}
	return $classes;
}
add_filter( 'post_class', 'fooding_no_thumbnail_class' );

/**
 * Filter the except length to 20 characters.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
 if ( ! function_exists( 'fooding_custom_excerpt_length' ) && ! is_admin() ) :
 function fooding_custom_excerpt_length( $length ) {
     return 30;
 }
 add_filter( 'excerpt_length', 'fooding_custom_excerpt_length', 999 );
 endif;

 if ( ! function_exists( 'fooding_excerpt_more' ) && ! is_admin() ) :
 function fooding_excerpt_more( $more ) {
 	return sprintf( '... <a class="read-more" href="%1$s">%2$s</a>',
        esc_url( get_permalink( get_the_ID() ) ),
        sprintf( esc_html__( '[Continue Reading]', 'fooding' ) )
     );
 }
 add_filter( 'excerpt_more', 'fooding_excerpt_more' );
 endif;
