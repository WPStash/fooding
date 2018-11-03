<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Fooding
 */

if ( ! function_exists( 'fooding_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function fooding_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( ' on %s', 'post date', 'fooding' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'fooding' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	$categories_list = get_the_category_list( esc_html__( ', ', 'fooding' ) );
	$posted_in = sprintf( esc_html__( ' in %1$s', 'fooding' ),  $categories_list);


	echo '<span class="byline"> ' . $byline . '</span><span class="posted-on">' . $posted_on . '</span><span class="posted-in">' . $posted_in . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'fooding_posted_on_without_cat' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function fooding_posted_on_without_cat() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( ' on %s', 'post date', 'fooding' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'fooding' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	$categories_list = get_the_category_list( esc_html__( ', ', 'fooding' ) );
	$posted_in = sprintf( esc_html__( ' in %1$s', 'fooding' ),  $categories_list);


	echo '<span class="byline"> ' . $byline . '</span><span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

}
endif;


if ( ! function_exists( 'fooding_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function fooding_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'fooding' ) );
		if ( $categories_list && fooding_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'fooding' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'fooding' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged : %1$s', 'fooding' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( esc_html( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'fooding' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'fooding' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function fooding_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'fooding_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'fooding_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so fooding_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so fooding_categorized_blog should return false.
		return false;
	}
}


if ( ! function_exists( 'fooding_comments' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own codilight_lite_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @return void
 */
 function fooding_comments( $comment, $args, $depth ) {
 	switch ( $comment->comment_type ) :
 		case 'pingback' :
 		case 'trackback' :
 	?>
 	<li class="pingback">
 		<p><?php esc_html_e( 'Pingback:', 'fooding' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'fooding' ), ' ' ); ?></p>
 	<?php
 			break;
 		default :
 	?>
 	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
 		<article id="comment-<?php comment_ID(); ?>" class="comment">
 			<div class="comment-author vcard">
 				<?php echo get_avatar( $comment, 60 ); ?>
 				<?php //printf( '<cite class="fn">%s</cite>', get_comment_author_link() ); ?>
 			</div><!-- .comment-author .vcard -->

 			<div class="comment-wrapper">
 				<?php if ( $comment->comment_approved == '0' ) : ?>
 					<em><?php esc_html_e( 'Your comment is awaiting moderation.', 'fooding' ); ?></em>
 				<?php endif; ?>

 				<div class="comment-meta comment-metadata">
					<?php printf( '<cite class="fn">%s</cite>', get_comment_author_link() ); ?>
					<span class="says"><?php esc_html_e( 'says:', 'fooding' ) ?></span><br>
 					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
 					<?php
 						/* translators: 1: date, 2: time */
 						printf( esc_html__( '%1$s at %2$s', 'fooding' ), get_comment_date(), get_comment_time() ); ?>
 					</time></a>
 				</div><!-- .comment-meta .commentmetadata -->
 				<div class="comment-content"><?php comment_text(); ?></div>
 				<div class="comment-actions">
 					<?php comment_reply_link( array_merge( array( 'after' => '<i class="fa fa-reply"></i>' ), array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
 				</div><!-- .reply -->
 			</div> <!-- .comment-wrapper -->

 		</article><!-- #comment-## -->

 	<?php
 			break;
 	endswitch;
 }
endif;

/**
 * Flush out the transients used in fooding_categorized_blog.
 */
function fooding_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'fooding_categories' );
}
add_action( 'edit_category', 'fooding_category_transient_flusher' );
add_action( 'save_post',     'fooding_category_transient_flusher' );


if ( ! function_exists( 'fooding_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 * @since Fooding
 */
function fooding_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;


if ( ! function_exists( 'fooding_footer_site_info' ) ) {

    function fooding_footer_site_info()
    {
        ?>
		<div class="theme-info-text">
        	<?php printf( esc_html__( 'Fooding Theme by %1$s', 'fooding' ), '<a href="https://freeresponsivethemes.com/fooding/" rel="nofollow">FRT</a>' ); ?>
		</div>
		<?php
    }
}
add_action( 'fooding_footer_site_info', 'fooding_footer_site_info' );

add_action( 'wp_enqueue_scripts', 'fooding_custom_inline_style', 100 );
if ( ! function_exists( 'fooding_custom_inline_style' ) ) {

	function fooding_custom_inline_style()
    {
		// Add extra styling to patus-style
		$primary   = esc_attr( get_theme_mod( 'primary_color', '#a4cc00' ) );
		$secondary = esc_attr( get_theme_mod( 'secondary_color', '#444444' ) );
		$custom_css = "
				.navigation .current, h2.entry-title a, h2.entry-title a, .site-footer .footer_menu ul li a, .widget-title { color: {$secondary}; }

				.entry-meta a,.comments-area .logged-in-as a,a:hover,a.read-more ,
				.main-navigation .current_page_item > a, .main-navigation .current-menu-item > a, .main-navigation .current_page_ancestor > a,
				.main-navigation ul ul a:hover
				{ color : {$primary};}
				.st-menu .btn-close-home .close-button,
				.st-menu .btn-close-home .home-button,
				button, input[type=\"button\"], input[type=\"reset\"], input[type=\"submit\"]{
					background-color: {$primary};
					border-color : {$primary};
				}
				.widget_tag_cloud a:hover { border-color :  {$primary}; color:  {$primary}; }
				button:hover, input[type=\"button\"]:hover,
				input[type=\"reset\"]:hover,
				input[type=\"submit\"]:hover,
				.st-menu .btn-close-home .home-button:hover,
				.st-menu .btn-close-home .close-button:hover {
						background-color: {$secondary};
						border-color: {$secondary};
				}";

		$header_text_color = esc_attr( get_header_textcolor() );
		if ( $header_text_color ) {
			$custom_css .= '.site-header .site-branding .site-title:after {
				background-color: #'.$header_text_color.';
			}';
		}

		wp_add_inline_style( 'fooding-style', $custom_css );
	}

}
