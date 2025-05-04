<?php

/**
 * Single Post Options
 *
 * @package retailer_bookstore
 */

$wp_customize->add_section(
	'retailer_bookstore_single_post_options',
	array(
		'title' => esc_html__( 'Single Post Options', 'retailer-bookstore' ),
		'panel' => 'retailer_bookstore_theme_options',
	)
);


// Post Options - Show / Hide Date.
$wp_customize->add_setting(
	'retailer_bookstore_single_post_hide_date',
	array(
		'default'           => true,
		'sanitize_callback' => 'retailer_bookstore_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Retailer_Bookstore_Toggle_Switch_Custom_Control(
		$wp_customize,
		'retailer_bookstore_single_post_hide_date',
		array(
			'label'   => esc_html__( 'Show / Hide Date', 'retailer-bookstore' ),
			'section' => 'retailer_bookstore_single_post_options',
		)
	)
);

// Post Options - Show / Hide Author.
$wp_customize->add_setting(
	'retailer_bookstore_single_post_hide_author',
	array(
		'default'           => true,
		'sanitize_callback' => 'retailer_bookstore_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Retailer_Bookstore_Toggle_Switch_Custom_Control(
		$wp_customize,
		'retailer_bookstore_single_post_hide_author',
		array(
			'label'   => esc_html__( 'Show / Hide Author', 'retailer-bookstore' ),
			'section' => 'retailer_bookstore_single_post_options',
		)
	)
);

// Post Options - Show / Hide Comments.
$wp_customize->add_setting(
	'retailer_bookstore_single_post_hide_comments',
	array(
		'default'           => true,
		'sanitize_callback' => 'retailer_bookstore_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Retailer_Bookstore_Toggle_Switch_Custom_Control(
		$wp_customize,
		'retailer_bookstore_single_post_hide_comments',
		array(
			'label'   => esc_html__( 'Show / Hide Comments', 'retailer-bookstore' ),
			'section' => 'retailer_bookstore_single_post_options',
		)
	)
);

// Post Options - Show / Hide Time.
$wp_customize->add_setting(
	'retailer_bookstore_single_post_hide_time',
	array(
		'default'           => true,
		'sanitize_callback' => 'retailer_bookstore_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Retailer_Bookstore_Toggle_Switch_Custom_Control(
		$wp_customize,
		'retailer_bookstore_single_post_hide_time',
		array(
			'label'   => esc_html__( 'Show / Hide Time', 'retailer-bookstore' ),
			'section' => 'retailer_bookstore_single_post_options',
		)
	)
);

// Post Options - Show / Hide Category.
$wp_customize->add_setting(
	'retailer_bookstore_single_post_hide_category',
	array(
		'default'           => true,
		'sanitize_callback' => 'retailer_bookstore_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Retailer_Bookstore_Toggle_Switch_Custom_Control(
		$wp_customize,
		'retailer_bookstore_single_post_hide_category',
		array(
			'label'   => esc_html__( 'Show / Hide Category', 'retailer-bookstore' ),
			'section' => 'retailer_bookstore_single_post_options',
		)
	)
);

// Post Options - Show / Hide Tag.
$wp_customize->add_setting(
	'retailer_bookstore_post_hide_tags',
	array(
		'default'           => true,
		'sanitize_callback' => 'retailer_bookstore_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Retailer_Bookstore_Toggle_Switch_Custom_Control(
		$wp_customize,
		'retailer_bookstore_post_hide_tags',
		array(
			'label'   => esc_html__( 'Show / Hide Tag', 'retailer-bookstore' ),
			'section' => 'retailer_bookstore_single_post_options',
		)
	)
);


// Add Separator Custom Control
$wp_customize->add_setting( 'retailer_bookstore_related_post_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new retailer_bookstore_Separator_Custom_Control( $wp_customize, 'retailer_bookstore_related_post_separator', array(
	'label' => __( 'Enable / Disable Related Post Section', 'retailer-bookstore' ),
	'section' => 'retailer_bookstore_single_post_options',
	'settings' => 'retailer_bookstore_related_post_separator',
) ) );


// Post Options - Show / Hide Related Posts.
$wp_customize->add_setting(
	'retailer_bookstore_post_hide_related_posts',
	array(
		'default'           => true,
		'sanitize_callback' => 'retailer_bookstore_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Retailer_Bookstore_Toggle_Switch_Custom_Control(
		$wp_customize,
		'retailer_bookstore_post_hide_related_posts',
		array(
			'label'   => esc_html__( 'Show / Hide Related Posts', 'retailer-bookstore' ),
			'section' => 'retailer_bookstore_single_post_options',
		)
	)
);

// Register setting for number of related posts
$wp_customize->add_setting(
	'retailer_bookstore_related_posts_count',
	array(
		'default'           => '',
		'sanitize_callback' => 'absint', // Ensure it's an integer
	)
);

// Add control for number of related posts
$wp_customize->add_control(
	'retailer_bookstore_related_posts_count',
	array(
		'type'        => 'number',
		'label'       => esc_html__( 'Number of Related Posts to Display', 'retailer-bookstore' ),
		'section'     => 'retailer_bookstore_single_post_options',
		'input_attrs' => array(
			'min'  => 1,
			'max'  => 5, // Adjust maximum based on your preference
			'step' => 1,
		),
	)
);

// Post Options - Related Post Label.
$wp_customize->add_setting(
	'retailer_bookstore_post_related_post_label',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'retailer_bookstore_post_related_post_label',
	array(
		'label'    => esc_html__( 'Related Posts Label', 'retailer-bookstore' ),
		'section'  => 'retailer_bookstore_single_post_options',
		'settings' => 'retailer_bookstore_post_related_post_label',
		'type'     => 'text',
	)
);

