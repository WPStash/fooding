<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Fooding
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<div id="page" class="site">


	<!-- begin .header-mobile-menu -->
	<nav class="st-menu st-effect-1" id="menu-3">
		<div class="btn-close-home">
			<button class="close-button" id="closemenu"></button>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="home-button"><i class="fa fa-home"></i></a>
		</div>
		<?php wp_nav_menu( array('theme_location' => 'primary','echo' => true,'items_wrap' => '<ul>%3$s</ul>')); ?>
		<?php get_search_form( $echo = true ); ?>
	</nav>
	<!-- end .header-mobile-menu -->

	<div class="site-pusher">
		<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'fooding' ); ?></a>

		<header id="masthead" class="site-header" role="banner" data-parallax="scroll" data-image-src="<?php header_image() ; ?>">
			<div class="site-header-wrap">
				<div class="container">

					<button class="top-mobile-menu-button mobile-menu-button" data-effect="st-effect-1" type="button"><i class="fa fa-bars"></i></button>
					<div class="site-branding">

						<?php if ( has_custom_logo() ) : ?>
						<div class="site-logo">
							<?php fooding_the_custom_logo(); ?>
						</div>
						<?php endif; ?>

						<?php
						if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

						<?php else : ?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>

						<?php
						endif;

						$description = get_bloginfo( 'description', 'display' );
						if ( $description || is_customize_preview() ) : ?>
							<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
						<?php
						endif; ?>
					</div><!-- .site-branding -->
				</div>

				<nav id="site-navigation" class="main-navigation" role="navigation">
					<div class="container">
						<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
					</div>
				</nav><!-- #site-navigation -->

			</div> <!-- .site-header-wrap -->
		</header><!-- #masthead -->

		<div id="content" class="site-content">
