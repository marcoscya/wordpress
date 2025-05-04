<?php

/**
 * Excerpt
 *
 * @package retailer_bookstore
 */

$wp_customize->add_section(
	'retailer_bookstore_excerpt_options',
	array(
		'panel' => 'retailer_bookstore_theme_options',
		'title' => esc_html__( 'Excerpt', 'retailer-bookstore' ),
	)
);

// Excerpt - Excerpt Length.
$wp_customize->add_setting(
	'retailer_bookstore_excerpt_length',
	array(
		'default'           => 20,
		'sanitize_callback' => 'absint',
		'transport'         => 'refresh',
	)
);

$wp_customize->add_control(
	'retailer_bookstore_excerpt_length',
	array(
		'label'       => esc_html__( 'Excerpt Length (no. of words)', 'retailer-bookstore' ),
		'section'     => 'retailer_bookstore_excerpt_options',
		'settings'    => 'retailer_bookstore_excerpt_length',
		'type'        => 'number',
		'input_attrs' => array(
			'min'  => 10,
			'max'  => 200,
			'step' => 1,
		),
	)
);