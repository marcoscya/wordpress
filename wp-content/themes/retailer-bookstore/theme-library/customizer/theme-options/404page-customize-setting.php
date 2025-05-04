<?php
/**
 * 404 page Customizer settings
 *
 * @package retailer_bookstore
 */

/*=========================================
404 Page Section
=========================================*/
$wp_customize->add_section(
    '404_pg_options', array(
        'title' => esc_html__('404 Page', 'retailer-bookstore'),
        'panel' => 'retailer_bookstore_theme_options',
    )
);

// Title
$wp_customize->add_setting(
    'retailer_bookstore_pg_404_ttl', array(
        'default'           => __('404 Page Not Found', 'retailer-bookstore'),
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    'retailer_bookstore_pg_404_ttl', array(
        'label'   => __('404 Page Title', 'retailer-bookstore'),
        'section' => '404_pg_options',
        'type'    => 'text',
    )
);

// Image
$wp_customize->add_setting(
    'retailer_bookstore_pg_404_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    )
);

$wp_customize->add_control(new WP_Customize_Image_Control(
    $wp_customize, 'retailer_bookstore_pg_404_image', array(
        'label'    => __('404 Page Image', 'retailer-bookstore'),
        'section'  => '404_pg_options',
        'settings' => 'retailer_bookstore_pg_404_image',
    )
));

// Text
$wp_customize->add_setting(
    'retailer_bookstore_pg_404_text', array(
        'default'           => __('Apologies, but the page you are seeking cannot be found.', 'retailer-bookstore'),
        'sanitize_callback' => 'sanitize_textarea_field',
    )
);

$wp_customize->add_control(
    'retailer_bookstore_pg_404_text', array(
        'label'    => __('404 Page Text', 'retailer-bookstore'),
        'section' => '404_pg_options',
        'settings' => 'retailer_bookstore_pg_404_text',
        'type'     => 'textarea',
    )
);

// Button Label
$wp_customize->add_setting(
    'retailer_bookstore_pg_404_btn_lbl', array(
        'default'           => __('Go Back Home', 'retailer-bookstore'),
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    'retailer_bookstore_pg_404_btn_lbl', array(
        'label'    => __('404 Button Label', 'retailer-bookstore'),
        'section' => '404_pg_options',
        'settings' => 'retailer_bookstore_pg_404_btn_lbl',
    )
);

// Button Link
$wp_customize->add_setting(
    'retailer_bookstore_pg_404_btn_link', array(
        'default'           => esc_url(home_url('/')),
        'sanitize_callback' => 'esc_url_raw',
    )
);

$wp_customize->add_control(
    'retailer_bookstore_pg_404_btn_link', array(
        'label'    => __('404 Button Link', 'retailer-bookstore'),
        'section' => '404_pg_options',
        'settings' => 'retailer_bookstore_pg_404_btn_link',
    )
);
?>
