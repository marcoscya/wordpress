<?php

/**
 * Sidebar Position
 *
 * @package retailer_bookstore
 */

$wp_customize->add_section(
	'retailer_bookstore_sidebar_position',
	array(
		'title' => esc_html__( 'Sidebar Position', 'retailer-bookstore' ),
		'panel' => 'retailer_bookstore_theme_options',
	)
);


// Add Separator Custom Control
$wp_customize->add_setting( 'retailer_bookstore_global_sidebar_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new retailer_bookstore_Separator_Custom_Control( $wp_customize, 'retailer_bookstore_global_sidebar_separator', array(
	'label' => __( 'Global Sidebar Position', 'retailer-bookstore' ),
	'section' => 'retailer_bookstore_sidebar_position',
	'settings' => 'retailer_bookstore_global_sidebar_separator',
)));

// Sidebar Position - Global Sidebar Position.
$wp_customize->add_setting(
	'retailer_bookstore_sidebar_position',
	array(
		'sanitize_callback' => 'retailer_bookstore_sanitize_select',
		'default'           => 'right-sidebar',
	)
);

$wp_customize->add_control(
	'retailer_bookstore_sidebar_position',
	array(
		'label'   => esc_html__( 'Select Sidebar Position', 'retailer-bookstore' ),
		'section' => 'retailer_bookstore_sidebar_position',
		'type'    => 'select',
		'choices' => array(
			'right-sidebar' => esc_html__( 'Right Sidebar', 'retailer-bookstore' ),
			'left-sidebar'  => esc_html__( 'Left Sidebar', 'retailer-bookstore' ),
			'no-sidebar'    => esc_html__( 'No Sidebar', 'retailer-bookstore' ),
		),
	)
);


// Add Separator Custom Control
$wp_customize->add_setting( 'retailer_bookstore_post_sidebar_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new retailer_bookstore_Separator_Custom_Control( $wp_customize, 'retailer_bookstore_post_sidebar_separator', array(
	'label' => __( 'Post Sidebar Position', 'retailer-bookstore' ),
	'section' => 'retailer_bookstore_sidebar_position',
	'settings' => 'retailer_bookstore_post_sidebar_separator',
)));

// Sidebar Position - Post Sidebar Position.
$wp_customize->add_setting(
	'retailer_bookstore_post_sidebar_position',
	array(
		'sanitize_callback' => 'retailer_bookstore_sanitize_select',
		'default'           => 'right-sidebar',
	)
);

$wp_customize->add_control(
	'retailer_bookstore_post_sidebar_position',
	array(
		'label'   => esc_html__( 'Select Sidebar Position', 'retailer-bookstore' ),
		'section' => 'retailer_bookstore_sidebar_position',
		'type'    => 'select',
		'choices' => array(
			'right-sidebar' => esc_html__( 'Right Sidebar', 'retailer-bookstore' ),
			'left-sidebar'  => esc_html__( 'Left Sidebar', 'retailer-bookstore' ),
			'no-sidebar'    => esc_html__( 'No Sidebar', 'retailer-bookstore' ),
		),
	)
);

// Add Separator Custom Control
$wp_customize->add_setting( 'retailer_bookstore_page_sidebar_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new retailer_bookstore_Separator_Custom_Control( $wp_customize, 'retailer_bookstore_page_sidebar_separator', array(
	'label' => __( 'Page Sidebar Position', 'retailer-bookstore' ),
	'section' => 'retailer_bookstore_sidebar_position',
	'settings' => 'retailer_bookstore_page_sidebar_separator',
)));

// Sidebar Position - Page Sidebar Position.
$wp_customize->add_setting(
	'retailer_bookstore_page_sidebar_position',
	array(
		'sanitize_callback' => 'retailer_bookstore_sanitize_select',
		'default'           => 'right-sidebar',
	)
);

$wp_customize->add_control(
	'retailer_bookstore_page_sidebar_position',
	array(
		'label'   => esc_html__( 'Select Sidebar Position', 'retailer-bookstore' ),
		'section' => 'retailer_bookstore_sidebar_position',
		'type'    => 'select',
		'choices' => array(
			'right-sidebar' => esc_html__( 'Right Sidebar', 'retailer-bookstore' ),
			'left-sidebar'  => esc_html__( 'Left Sidebar', 'retailer-bookstore' ),
			'no-sidebar'    => esc_html__( 'No Sidebar', 'retailer-bookstore' ),
		),
	)
);

// Add Separator Custom Control
$wp_customize->add_setting( 'retailer_bookstore_sidebar_width_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new retailer_bookstore_Separator_Custom_Control( $wp_customize, 'retailer_bookstore_sidebar_width_separator', array(
	'label' => __( 'Sidebar Width Setting', 'retailer-bookstore' ),
	'section' => 'retailer_bookstore_sidebar_position',
	'settings' => 'retailer_bookstore_sidebar_width_separator',
)));


$wp_customize->add_setting( 'retailer_bookstore_sidebar_width', array(
	'default'           => '30',
	'sanitize_callback' => 'retailer_bookstore_sanitize_range_value',
) );

$wp_customize->add_control(new retailer_bookstore_Customize_Range_Control($wp_customize, 'retailer_bookstore_sidebar_width', array(
	'section'     => 'retailer_bookstore_sidebar_position',
	'label'       => __( 'Adjust Sidebar Width', 'retailer-bookstore' ),
	'description' => __( 'Adjust the width of the sidebar.', 'retailer-bookstore' ),
	'input_attrs' => array(
		'min'  => 10,
		'max'  => 50,
		'step' => 1,
	),
)));

$wp_customize->add_setting( 'retailer_bookstore_sidebar_widget_font_size', array(
    'default'           => 24,
    'sanitize_callback' => 'absint',
) );

// Add control for site title size
$wp_customize->add_control( 'retailer_bookstore_sidebar_widget_font_size', array(
    'type'        => 'number',
    'section'     => 'retailer_bookstore_sidebar_position',
    'label'       => __( 'Sidebar Widgets Heading Font Size ', 'retailer-bookstore' ),
    'input_attrs' => array(
        'min'  => 10,
        'max'  => 100,
        'step' => 1,
    ),
));