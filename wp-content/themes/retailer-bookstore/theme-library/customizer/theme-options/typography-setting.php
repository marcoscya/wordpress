<?php

/**
 * Typography Settings
 *
 * @package retailer_bookstore
 */

// Typography Settings
$wp_customize->add_section(
    'retailer_bookstore_typography_setting',
    array(
        'panel' => 'retailer_bookstore_theme_options',
        'title' => esc_html__( 'Typography Settings', 'retailer-bookstore' ),
    )
);

$wp_customize->add_setting(
    'retailer_bookstore_site_title_font',
    array(
        'default'           => 'Raleway',
        'sanitize_callback' => 'retailer_bookstore_sanitize_google_fonts',
    )
);

$wp_customize->add_control(
    'retailer_bookstore_site_title_font',
    array(
        'label'    => esc_html__( 'Site Title Font Family', 'retailer-bookstore' ),
        'section'  => 'retailer_bookstore_typography_setting',
        'settings' => 'retailer_bookstore_site_title_font',
        'type'     => 'select',
        'choices'  => retailer_bookstore_get_all_google_font_families(),
    )
);

// Typography - Site Description Font.
$wp_customize->add_setting(
	'retailer_bookstore_site_description_font',
	array(
		'default'           => 'Raleway',
		'sanitize_callback' => 'retailer_bookstore_sanitize_google_fonts',
	)
);

$wp_customize->add_control(
	'retailer_bookstore_site_description_font',
	array(
		'label'    => esc_html__( 'Site Description Font Family', 'retailer-bookstore' ),
		'section'  => 'retailer_bookstore_typography_setting',
		'settings' => 'retailer_bookstore_site_description_font',
		'type'     => 'select',
		'choices'  => retailer_bookstore_get_all_google_font_families(),
	)
);

// Typography - Header Font.
$wp_customize->add_setting(
	'retailer_bookstore_header_font',
	array(
		'default'           => 'Lilita One',
		'sanitize_callback' => 'retailer_bookstore_sanitize_google_fonts',
	)
);

$wp_customize->add_control(
	'retailer_bookstore_header_font',
	array(
		'label'    => esc_html__( 'Heading Font Family', 'retailer-bookstore' ),
		'section'  => 'retailer_bookstore_typography_setting',
		'settings' => 'retailer_bookstore_header_font',
		'type'     => 'select',
		'choices'  => retailer_bookstore_get_all_google_font_families(),
	)
);

// Typography - Body Font.
$wp_customize->add_setting(
	'retailer_bookstore_content_font',
	array(
		'default'           => 'Oswald',
		'sanitize_callback' => 'retailer_bookstore_sanitize_google_fonts',
	)
);

$wp_customize->add_control(
	'retailer_bookstore_content_font',
	array(
		'label'    => esc_html__( 'Content Font Family', 'retailer-bookstore' ),
		'section'  => 'retailer_bookstore_typography_setting',
		'settings' => 'retailer_bookstore_content_font',
		'type'     => 'select',
		'choices'  => retailer_bookstore_get_all_google_font_families(),
	)
);
