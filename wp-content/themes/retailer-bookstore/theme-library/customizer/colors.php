<?php

/**
 * Color Option
 *
 * @package retailer_bookstore
 */

// Color 1 (Start Color).
$wp_customize->add_setting(
    'retailer_bookstore_gradient_color1',
    array(
        'default'           => '#E6BB0A',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'retailer_bookstore_gradient_color1',
        array(
            'label'    => __( 'Gradient Color 1 (Primary color)', 'retailer-bookstore' ),
			'description' => __('The chosen color will be set as your primary color also', 'retailer-bookstore'),
            'section'  => 'colors',
            'priority' => 1,
        )
    )
);

// Color 2 (End Color).
$wp_customize->add_setting(
    'retailer_bookstore_gradient_color2',
    array(
        'default'           => '#FA382B',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'retailer_bookstore_gradient_color2',
        array(
            'label'    => __( 'Gradient Color 2', 'retailer-bookstore' ),
            'section'  => 'colors',
            'priority' => 2,
        )
    )
);