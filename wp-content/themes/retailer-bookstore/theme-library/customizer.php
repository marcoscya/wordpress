<?php

/**
 * Retailer Bookstore Theme Customizer
 *
 * @package retailer_bookstore
 */

// Sanitize callback.
require get_template_directory() . '/theme-library/customizer/sanitize-callback.php';

// Active Callback.
require get_template_directory() . '/theme-library/customizer/active-callback.php';

// Custom Controls.
require get_template_directory() . '/theme-library/customizer/custom-controls/custom-controls.php';

// Icon Controls.
require get_template_directory() . '/theme-library/customizer/custom-controls/icon-control.php';

function retailer_bookstore_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'retailer_bookstore_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'retailer_bookstore_customize_partial_blogdescription',
			)
		);
	}

	// Upsell Section.
	$wp_customize->add_section(
		new Retailer_Bookstore_Upsell_Section(
			$wp_customize,
			'upsell_section',
			array(
				'title'            => __( 'Retailer Bookstore Pro', 'retailer-bookstore' ),
				'button_text'      => __( 'Buy Pro', 'retailer-bookstore' ),
				'url'              => 'https://asterthemes.com/products/book-shop-wordpress-theme',
				'background_color' => 'linear-gradient(90.09deg, #E6BB0A 0%, #FA382B 99.23%)',
				'text_color'       => '#fff',
				'priority'         => 0,
			)
		)
	);

	// Doc Section.
	$wp_customize->add_section(
		new Retailer_Bookstore_Upsell_Section(
			$wp_customize,
			'doc_section',
			array(
				'title'            => __( 'Documentation', 'retailer-bookstore' ),
				'button_text'      => __( 'Free Doc', 'retailer-bookstore' ),
				'url'              => 'https://demo.asterthemes.com/docs/retailer-bookstore-free/',
				'background_color' => 'linear-gradient(90.09deg, #E6BB0A 0%, #FA382B 99.23%)',
				'text_color'       => '#fff',
				'priority'         => 1,
			)
		)
	);
	
	// Theme Options.
	require get_template_directory() . '/theme-library/customizer/theme-options.php';

	// Front Page Options.
	require get_template_directory() . '/theme-library/customizer/front-page-options.php';

	// Colors.
	require get_template_directory() . '/theme-library/customizer/colors.php';

}
add_action( 'customize_register', 'retailer_bookstore_customize_register' );

function retailer_bookstore_customize_partial_blogname() {
	bloginfo( 'name' );
}

function retailer_bookstore_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

function retailer_bookstore_customize_preview_js() {
	$min = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	wp_enqueue_script( 'retailer-bookstore-customizer', get_template_directory_uri() . '/resource/js/customizer' . $min . '.js', array( 'customize-preview' ), retailer_bookstore_VERSION, true );
}
add_action( 'customize_preview_init', 'retailer_bookstore_customize_preview_js' );

function retailer_bookstore_custom_control_scripts() {
	$min = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	wp_enqueue_style( 'retailer-bookstore-custom-controls-css', get_template_directory_uri() . '/resource/css/custom-controls' . $min . '.css', array(), '1.0', 'all' );

	wp_enqueue_script( 'retailer-bookstore-custom-controls-js', get_template_directory_uri() . '/resource/js/custom-controls' . $min . '.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-sortable' ), '1.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'retailer_bookstore_custom_control_scripts' );