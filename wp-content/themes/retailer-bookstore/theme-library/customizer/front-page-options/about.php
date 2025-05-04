<?php

/**
 * Offer Section
 *
 * @package retailer_bookstore
 */

$wp_customize->add_section(
	'retailer_bookstore_products_section',
	array(
		'panel'    => 'retailer_bookstore_front_page_options',
		'title'    => esc_html__( 'Offer Section', 'retailer-bookstore' ),
		'priority' => 10,
	)
);

// Offer Section - Enable Section.
$wp_customize->add_setting(
	'retailer_bookstore_enable_service_section',
	array(
		'default'           => false,
		'sanitize_callback' => 'retailer_bookstore_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Retailer_Bookstore_Toggle_Switch_Custom_Control(
		$wp_customize,
		'retailer_bookstore_enable_service_section',
		array(
			'label'    => esc_html__( 'Enable Offer Section', 'retailer-bookstore' ),
			'section'  => 'retailer_bookstore_products_section',
			'settings' => 'retailer_bookstore_enable_service_section',
		)
	)
);

if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial(
		'retailer_bookstore_enable_service_section',
		array(
			'selector' => '#retailer_bookstore_service_section .section-link',
			'settings' => 'retailer_bookstore_enable_service_section',
		)
	);
}

// Offer Section - Offer Image.
$wp_customize->add_setting(
	'retailer_bookstore_about_left_image_1',
	array(
		'sanitize_callback' => 'retailer_bookstore_sanitize_image',
	)
);

$wp_customize->add_control(
	new WP_Customize_Image_Control(
		$wp_customize,
		'retailer_bookstore_about_left_image_1',
		array(
			'label'           => esc_html__( 'Offer Image 1', 'retailer-bookstore'),
			'section'         => 'retailer_bookstore_products_section',
			'settings'        => 'retailer_bookstore_about_left_image_1',
			'active_callback' => 'retailer_bookstore_is_service_section_enabled',
		)
	)
);

// Offer Section - Button Label.
$wp_customize->add_setting(
	'retailer_bookstore_about_1_button_text',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'retailer_bookstore_about_1_button_text',
	array(
		'label'           => esc_html__( 'Offer Button Title', 'retailer-bookstore' ),
		'section'         => 'retailer_bookstore_products_section',
		'settings'        => 'retailer_bookstore_about_1_button_text',
		'type'            => 'text',
		'active_callback' => 'retailer_bookstore_is_service_section_enabled',
	)
);

// Banner Section - Button Link.
$wp_customize->add_setting(
	'retailer_bookstore_about_1_button_link',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	)
);

$wp_customize->add_control(
	'retailer_bookstore_about_1_button_link',
	array(
		'label'           => esc_html__( 'Offer Button Link', 'retailer-bookstore'),
		'section'         => 'retailer_bookstore_products_section',
		'settings'        => 'retailer_bookstore_about_1_button_link',
		'type'            => 'url',
		'active_callback' => 'retailer_bookstore_is_service_section_enabled',
	)
);

// Offer Section - Offer Heading.
$wp_customize->add_setting(
	'retailer_bookstore_about_left_image_2',
	array(
		'sanitize_callback' => 'retailer_bookstore_sanitize_image',
	)
);

$wp_customize->add_control(
	new WP_Customize_Image_Control(
		$wp_customize,
		'retailer_bookstore_about_left_image_2',
		array(
			'label'           => esc_html__( 'Offer Image 2', 'retailer-bookstore'),
			'section'         => 'retailer_bookstore_products_section',
			'settings'        => 'retailer_bookstore_about_left_image_2',
			'active_callback' => 'retailer_bookstore_is_service_section_enabled',
		)
	)
);

// Offer Section - Button Label.
$wp_customize->add_setting(
	'retailer_bookstore_about_2_button_text',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'retailer_bookstore_about_2_button_text',
	array(
		'label'           => esc_html__( 'Offer Button Title', 'retailer-bookstore' ),
		'section'         => 'retailer_bookstore_products_section',
		'settings'        => 'retailer_bookstore_about_2_button_text',
		'type'            => 'text',
		'active_callback' => 'retailer_bookstore_is_service_section_enabled',
	)
);

// Offer Section - Button Link.
$wp_customize->add_setting(
	'retailer_bookstore_about_2_button_link',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	)
);

$wp_customize->add_control(
	'retailer_bookstore_about_2_button_link',
	array(
		'label'           => esc_html__( 'Offer Button Link', 'retailer-bookstore'),
		'section'         => 'retailer_bookstore_products_section',
		'settings'        => 'retailer_bookstore_about_2_button_link',
		'type'            => 'url',
		'active_callback' => 'retailer_bookstore_is_service_section_enabled',
	)
);

// Offer Section - Content Label.
$wp_customize->add_setting(
	'retailer_bookstore_timmer_heading',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'retailer_bookstore_timmer_heading',
	array(
		'label'           => esc_html__( 'Timer Heading', 'retailer-bookstore' ),
		'section'         => 'retailer_bookstore_products_section',
		'settings'        => 'retailer_bookstore_timmer_heading',
		'type'            => 'text',
		'active_callback' => 'retailer_bookstore_is_service_section_enabled',
	)
);

// Offer Section - Content Label.
$wp_customize->add_setting(
	'retailer_bookstore_about_text',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'retailer_bookstore_about_text',
	array(
		'label'           => esc_html__( 'Timer Date', 'retailer-bookstore' ),
		'section'         => 'retailer_bookstore_products_section',
		'settings'        => 'retailer_bookstore_about_text',
		'description'	  => esc_html__( 'Exp: Dec 31 2025', 'retailer-bookstore' ),
		'type'            => 'text',
		'active_callback' => 'retailer_bookstore_is_service_section_enabled',
	)
);



// Offer Section - Content Label.
$wp_customize->add_setting(
	'retailer_bookstore_timmer_text',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'retailer_bookstore_timmer_text',
	array(
		'label'           => esc_html__( 'Timer Heading', 'retailer-bookstore' ),
		'section'         => 'retailer_bookstore_products_section',
		'settings'        => 'retailer_bookstore_timmer_text',
		'type'            => 'text',
		'active_callback' => 'retailer_bookstore_is_service_section_enabled',
	)
);