<?php

/**
 * WooCommerce Settings
 *
 * @package retailer_bookstore
 */

$wp_customize->add_section(
	'retailer_bookstore_woocommerce_settings',
	array(
		'panel' => 'retailer_bookstore_theme_options',
		'title' => esc_html__( 'WooCommerce Settings', 'retailer-bookstore' ),
	)
);

//WooCommerce - Products per page.
$wp_customize->add_setting( 'retailer_bookstore_products_per_page', array(
    'default'           => 9,
    'sanitize_callback' => 'absint',
));

$wp_customize->add_control( 'retailer_bookstore_products_per_page', array(
    'type'        => 'number',
    'section'     => 'retailer_bookstore_woocommerce_settings',
    'label'       => __( 'Products Per Page', 'retailer-bookstore' ),
    'input_attrs' => array(
        'min'  => 0,
        'max'  => 50,
        'step' => 1,
    ),
));

//WooCommerce - Products per row.
$wp_customize->add_setting( 'retailer_bookstore_products_per_row', array(
    'default'           => '3',
    'sanitize_callback' => 'retailer_bookstore_sanitize_choices',
) );

$wp_customize->add_control( 'retailer_bookstore_products_per_row', array(
    'label'    => __( 'Products Per Row', 'retailer-bookstore' ),
    'section'  => 'retailer_bookstore_woocommerce_settings',
    'settings' => 'retailer_bookstore_products_per_row',
    'type'     => 'select',
    'choices'  => array(
        '2' => '2',
		'3' => '3',
		'4' => '4',
    ),
) );

//WooCommerce - Show / Hide Related Product.
$wp_customize->add_setting(
	'retailer_bookstore_related_product_show_hide',
	array(
		'default'           => true,
		'sanitize_callback' => 'retailer_bookstore_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Retailer_Bookstore_Toggle_Switch_Custom_Control(
		$wp_customize,
		'retailer_bookstore_related_product_show_hide',
		array(
			'label'   => esc_html__( 'Show / Hide Related product', 'retailer-bookstore' ),
			'section' => 'retailer_bookstore_woocommerce_settings',
		)
	)
);

// WooCommerce - Product Sale Position.
$wp_customize->add_setting(
	'retailer_bookstore_product_sale_position', 
	array(
		'default' => 'left',
		'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_control(
	'retailer_bookstore_product_sale_position', 
	array(
		'label' => __('Product Sale Position', 'retailer-bookstore'),
		'section' => 'retailer_bookstore_woocommerce_settings',
		'settings' => 'retailer_bookstore_product_sale_position',
		'type' => 'radio',
		'choices' => 
	array(
		'left' => __('Left', 'retailer-bookstore'),
		'right' => __('Right', 'retailer-bookstore'),
	),
));