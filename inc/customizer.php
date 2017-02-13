<?php
/**
 * Fooding Theme Customizer.
 *
 * @package Fooding
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function fooding_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';


		/*------------------------------------------------------------------------*/
		/*  Section: Theme Options
		/*------------------------------------------------------------------------*/

		$wp_customize->add_panel( 'fooding_theme_options_panel' ,
				array(
					'priority'        => 30,
					'title'           => esc_html__( 'Theme Options', 'fooding' ),
					'description'     => ''
				)
			);
			// section
			$wp_customize->add_section( 'fooding_general' ,
				array(
					'priority'    => 3,
					'title'       => esc_html__( 'General', 'fooding' ),
					'description' => '',
					'panel'       => 'fooding_theme_options_panel',
				)
			);
				// settings
				$wp_customize->add_setting( 'fooding_homepage_layout',
					array(
						'sanitize_callback'	=> 'fooding_sanitize_select',
						'default'           => 'default',
					)
				);

				$wp_customize->add_control( 'fooding_homepage_layout',
					array(
						'label' 		=> esc_html__( 'Frontpage Layout', 'fooding' ),
						'description'   => esc_html__( 'Only apply when frontpage is a static page', 'fooding' ),
						'type'			=> 'radio',
						'section' 	=> 'fooding_general',
						'choices'   => array(
							'default' => esc_html__( 'Default', 'fooding' ),
							'home1'   => esc_html__( 'Homepage 1', 'fooding' ),
							'home2'   => esc_html__( 'Homepage 2', 'fooding' ),
						)
					)
				);

				// archive/search post layout
				$wp_customize->add_section( 'archive_layout' ,
					array(
						'priority'    => 3,
						'title'       => esc_html__( 'Archive/Search', 'fooding' ),
						'description' => '',
						'panel'       => 'fooding_theme_options_panel',
					)
				);
				$wp_customize->add_setting( 'fooding_archive_layout',
					array(
						'sanitize_callback'	=> 'fooding_sanitize_select',
						'default'           => 'default',
					)
				);
				$wp_customize->add_control( 'fooding_archive_layout',
					array(
						'label' 		=> esc_html__( 'Archive/Search layout:', 'fooding' ),
						'type'			=> 'radio',
						'section' 		=> 'archive_layout',
						'choices'   	=> array (
							'default'	=> esc_html__( 'Default', 'fooding' ),
							'grid'	    => esc_html__( 'Grid', 'fooding' ),
						)
					)
				);

			// staff picks
			$wp_customize->add_section( 'staff_picks' ,
				array(
					'priority'    => 3,
					'title'       => esc_html__( 'Staff Picks', 'fooding' ),
					'description' => '',
					'panel'       => 'fooding_theme_options_panel',
				)
			);

				$wp_customize->add_setting( 'fooding_staff_picks',
					array(
						'sanitize_callback'	=> 'fooding_sanitize_checkbox',
						'default'           => true,
					)
				);

				$wp_customize->add_control( 'fooding_staff_picks',
					array(
						'label' 		=> esc_html__( 'Turn on/off the staff picks', 'fooding' ),
						'type'			=> 'checkbox',
						'section' 		=> 'staff_picks',
					)
				);

				$wp_customize->add_setting( 'fooding_staff_picks_tags',
					array(
						'sanitize_callback'	=> 'fooding_sanitize_text',
						'default'           => '',
					)
				);
				$wp_customize->add_control( 'fooding_staff_picks_tags',
					array(

						'type'			=> 'text',
						'section' 		=> 'staff_picks',
						'description'	=> esc_html__( 'Enter post tags, separated by commas and without space.', 'fooding' )
					)
				);

				$wp_customize->add_setting( 'number_staff_picks',
					array(
						'sanitize_callback'		=> 'fooding_sanitize_number_absint',
						'default'           	=> '5',
					)
				);
				$wp_customize->add_control( 'number_staff_picks',
					array(

						'type'			=> 'text',
						'section' 		=> 'staff_picks',
						'description'	=> esc_html__( 'Enter number post display on Staff section.', 'fooding' )
					)
				);


				// Primary color setting
				$wp_customize->add_setting( 'primary_color' , array(
					'sanitize_callback'	=> 'fooding_sanitize_hex_color',
				    'default'     => '#a4cc00',
				) );

				$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primary_color', array(
					'label'        => esc_html__( 'Primary Color', 'fooding' ),
					'section'    => 'colors',
					'settings'   => 'primary_color',
				) ) );

				// Second color setting
				$wp_customize->add_setting( 'secondary_color' , array(
					'sanitize_callback'	=> 'fooding_sanitize_hex_color',
				    'default'     => '#444',
				) );
				$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondary_color', array(
					'label'        => esc_html__( 'Secondary Color', 'fooding' ),
					'section'    => 'colors',
					'settings'   => 'secondary_color',
				) ) );

}
add_action( 'customize_register', 'fooding_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function fooding_customize_preview_js() {
	wp_enqueue_script( 'fooding_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'fooding_customize_preview_js' );



/*------------------------------------------------------------------------*/
/*  fooding Sanitize Functions.
/*------------------------------------------------------------------------*/

function fooding_sanitize_file_url( $file_url ) {
	$output = '';
	$filetype = wp_check_filetype( $file_url );
	if ( $filetype["ext"] ) {
		$output = esc_url_raw( $file_url );
	}
	return $output;
}


function fooding_sanitize_select( $input, $setting ) {
	$input = sanitize_key( $input );
	$choices = $setting->manager->get_control( $setting->id )->choices;
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

function fooding_sanitize_hex_color( $color ) {
	if ( $color === '' ) {
		return '';
	}
	if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
		return $color;
	}
	return null;
}
function fooding_sanitize_checkbox( $checked ) {
    return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

function fooding_sanitize_text( $string ) {
	return wp_kses_post( balanceTags( $string ) );
}

function fooding_sanitize_number_absint( $number, $setting ) {
	// Ensure $number is an absolute integer (whole number, zero or greater).
	$number = absint( $number );

	// If the input is an absolute integer, return it; otherwise, return the default
	return ( $number ? $number : $setting->default );
}
