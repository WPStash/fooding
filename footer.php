<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Fooding
 */

?>

	</div><!-- #content -->


		<footer id="colophon" class="site-footer" role="contentinfo">

			<?php $enable_staff_picks = get_theme_mod( 'fooding_staff_picks', true ) ;

			if ( $enable_staff_picks == true ) {
				get_template_part( 'template-parts/content', 'staff' );
			}

			?>

			<div class="footer-widgets">
				<div class="container">
					<?php
						if ( is_active_sidebar( 'footer' ) ) {
							dynamic_sidebar( 'footer' );
						}
					?>
				</div>
			</div>

			<div class="site-info">
				<div class="container">
					<?php wp_nav_menu( array( 'theme_location' => 'footer' ) ) ?>

					<div class="site-copyright">
						<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'fooding' ) ); ?>"><?php printf( esc_html__( 'Powered by %s', 'fooding' ), 'WordPress' ); ?></a>
						<span class="sep"> . </span>
						<?php printf( esc_html__( 'Theme by %2$s.', 'fooding' ), 'fooding', '<a href="https://wpstash.com" rel="designer">WPStash</a>' ); ?>
					</div>
				</div>
			</div><!-- .site-info -->
		</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
