<?php

/**
 * Pige Title Options
 *
 * @package retailer_bookstore
 */



$wp_customize->add_section(
	'retailer_bookstore_page_title_options',
	array(
		'panel' => 'retailer_bookstore_theme_options',
		'title' => esc_html__( 'Page Title', 'retailer-bookstore' ),
	)
);

$wp_customize->add_setting(
    'retailer_bookstore_page_header_visibility',
    array(
        'default'           => 'all-devices',
        'sanitize_callback' => 'retailer_bookstore_sanitize_select',
    )
);

$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'retailer_bookstore_page_header_visibility',
        array(
            'label'    => esc_html__( 'Page Header Visibility', 'retailer-bookstore' ),
            'type'     => 'select',
            'section'  => 'retailer_bookstore_page_title_options',
            'settings' => 'retailer_bookstore_page_header_visibility',
            'priority' => 10,
            'choices'  => array(
                'all-devices'        => esc_html__( 'Show on all devices', 'retailer-bookstore' ),
                'hide-tablet'        => esc_html__( 'Hide on Tablet', 'retailer-bookstore' ),
                'hide-mobile'        => esc_html__( 'Hide on Mobile', 'retailer-bookstore' ),
                'hide-tablet-mobile' => esc_html__( 'Hide on Tablet & Mobile', 'retailer-bookstore' ),
                'hide-all-devices'   => esc_html__( 'Hide on all devices', 'retailer-bookstore' ),
            ),
        )
    )
);


$wp_customize->add_setting( 'retailer_bookstore_page_title_background_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new retailer_bookstore_Separator_Custom_Control( $wp_customize, 'retailer_bookstore_page_title_background_separator', array(
	'label' => __( 'Page Title BG Image & Color Setting', 'retailer-bookstore' ),
	'section' => 'retailer_bookstore_page_title_options',
	'settings' => 'retailer_bookstore_page_title_background_separator',
)));


$wp_customize->add_setting(
	'retailer_bookstore_page_header_style',
	array(
		'sanitize_callback' => 'retailer_bookstore_sanitize_switch',
		'default'           => False,
	)
);

$wp_customize->add_control(
	new Retailer_Bookstore_Toggle_Switch_Custom_Control(
		$wp_customize,
		'retailer_bookstore_page_header_style',
		array(
			'label'   => esc_html__('Page Title Background Image', 'retailer-bookstore'),
			'section' => 'retailer_bookstore_page_title_options',
		)
	)
);

$wp_customize->add_setting( 'retailer_bookstore_page_header_background_image', array(
    'default' => '',
    'sanitize_callback' => 'esc_url_raw',
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'retailer_bookstore_page_header_background_image', array(
    'label'    => __( 'Background Image', 'retailer-bookstore' ),
    'section'  => 'retailer_bookstore_page_title_options',
	'description' => __('Choose either a background image or a color. If a background image is selected, the background color will not be visible.', 'retailer-bookstore'),
    'settings' => 'retailer_bookstore_page_header_background_image',
	'active_callback' => 'retailer_bookstore_is_pagetitle_bcakground_image_enabled',
)));


$wp_customize->add_setting('retailer_bookstore_page_header_image_height', array(
	'default'           => 200,
	'sanitize_callback' => 'retailer_bookstore_sanitize_range_value',
));

$wp_customize->add_control(new retailer_bookstore_Customize_Range_Control($wp_customize, 'retailer_bookstore_page_header_image_height', array(
		'label'       => __('Image Height', 'retailer-bookstore'),
		'section'     => 'retailer_bookstore_page_title_options',
		'settings'    => 'retailer_bookstore_page_header_image_height',
		'active_callback' => 'retailer_bookstore_is_pagetitle_bcakground_image_enabled',
		'input_attrs' => array(
			'min'  => 0,
			'max'  => 1000,
			'step' => 5,
		),
)));


$wp_customize->add_setting('retailer_bookstore_page_title_background_color_setting', array(
    'default' => '#f5f5f5',
    'sanitize_callback' => 'sanitize_hex_color',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'retailer_bookstore_page_title_background_color_setting', array(
    'label' => __('Page Title Background Color', 'retailer-bookstore'),
    'section' => 'retailer_bookstore_page_title_options',
)));

$wp_customize->add_setting('retailer_bookstore_pagetitle_height', array(
    'default'           => 50,
    'sanitize_callback' => 'retailer_bookstore_sanitize_range_value',
));

$wp_customize->add_control(new retailer_bookstore_Customize_Range_Control($wp_customize, 'retailer_bookstore_pagetitle_height', array(
    'label'       => __('Set Height', 'retailer-bookstore'),
    'description' => __('This setting controls the page title height when no background image is set. If a background image is set, this setting will not apply.', 'retailer-bookstore'),
    'section'     => 'retailer_bookstore_page_title_options',
    'settings'    => 'retailer_bookstore_pagetitle_height',
    'input_attrs' => array(
        'min'  => 0,
        'max'  => 300,
        'step' => 5,
    ),
)));

$wp_customize->add_setting( 'retailer_bookstore_page_title_style_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new retailer_bookstore_Separator_Custom_Control( $wp_customize, 'retailer_bookstore_page_title_style_separator', array(
	'label' => __( 'Page Title Styling Setting', 'retailer-bookstore' ),
	'section' => 'retailer_bookstore_page_title_options',
	'settings' => 'retailer_bookstore_page_title_style_separator',
)));


$wp_customize->add_setting( 'retailer_bookstore_page_header_heading_tag', array(
	'default'   => 'h1',
	'sanitize_callback' => 'retailer_bookstore_sanitize_select',
) );

$wp_customize->add_control( 'retailer_bookstore_page_header_heading_tag', array(
	'label'   => __( 'Page Title Heading Tag', 'retailer-bookstore' ),
	'section' => 'retailer_bookstore_page_title_options',
	'type'    => 'select',
	'choices' => array(
		'h1' => __( 'H1', 'retailer-bookstore' ),
		'h2' => __( 'H2', 'retailer-bookstore' ),
		'h3' => __( 'H3', 'retailer-bookstore' ),
		'h4' => __( 'H4', 'retailer-bookstore' ),
		'h5' => __( 'H5', 'retailer-bookstore' ),
		'h6' => __( 'H6', 'retailer-bookstore' ),
		'p' => __( 'p', 'retailer-bookstore' ),
		'a' => __( 'a', 'retailer-bookstore' ),
		'div' => __( 'div', 'retailer-bookstore' ),
		'span' => __( 'span', 'retailer-bookstore' ),
	),
) );


$wp_customize->add_setting('retailer_bookstore_page_header_layout', array(
	'default' => 'left',
	'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_control('retailer_bookstore_page_header_layout', array(
	'label' => __('Style', 'retailer-bookstore'),
	'section' => 'retailer_bookstore_page_title_options',
	'description' => __('"Flex Layout Style" wont work below 600px (mobile media)', 'retailer-bookstore'),
	'settings' => 'retailer_bookstore_page_header_layout',
	'type' => 'radio',
	'choices' => array(
		'left' => __('Classic', 'retailer-bookstore'),
		'right' => __('Aligned Right', 'retailer-bookstore'),
		'center' => __('Centered Focus', 'retailer-bookstore'),
		'flex' => __('Flex Layout', 'retailer-bookstore'),
	),
));