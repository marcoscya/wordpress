<?php

/**
 * Header Options
 *
 * @package retailer_bookstore
 */

// ---------------------------------------- PRELOADER ----------------------------------------------------

$wp_customize->add_section(
	'retailer_bookstore_general_options',
	array(
		'panel' => 'retailer_bookstore_theme_options',
		'title' => esc_html__( 'General Options', 'retailer-bookstore' ),
	)
);

// Add Separator Custom Control
$wp_customize->add_setting( 'retailer_bookstore_preloader_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new retailer_bookstore_Separator_Custom_Control( $wp_customize, 'retailer_bookstore_preloader_separator', array(
	'label' => __( 'Enable / Disable Site Preloader Section', 'retailer-bookstore' ),
	'section' => 'retailer_bookstore_general_options',
	'settings' => 'retailer_bookstore_preloader_separator',
) ) );

// General Options - Enable Preloader.
$wp_customize->add_setting(
	'retailer_bookstore_enable_preloader',
	array(
		'sanitize_callback' => 'retailer_bookstore_sanitize_switch',
		'default'           => false,
	)
);

$wp_customize->add_control(
	new Retailer_Bookstore_Toggle_Switch_Custom_Control(
		$wp_customize,
		'retailer_bookstore_enable_preloader',
		array(
			'label'   => esc_html__( 'Enable Preloader', 'retailer-bookstore' ),
			'section' => 'retailer_bookstore_general_options',
		)
	)
);

// Preloader Style Setting
$wp_customize->add_setting(
    'retailer_bookstore_preloader_style',
    array(
        'default'           => 'style1',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    'retailer_bookstore_preloader_style',
    array(
        'type'     => 'select',
        'label'    => esc_html__('Select Preloader Styles', 'retailer-bookstore'),
		'active_callback' => 'retailer_bookstore_is_preloader_style',
        'section'  => 'retailer_bookstore_general_options',
        'choices'  => array(
            'style1' => esc_html__('Style 1', 'retailer-bookstore'),
            'style2' => esc_html__('Style 2', 'retailer-bookstore'),
            'style3' => esc_html__('Style 3', 'retailer-bookstore'),
        ),
    )
);

// ---------------------------------------- PAGINATION ----------------------------------------------------

// Add Separator Custom Control
$wp_customize->add_setting( 'retailer_bookstore_pagination_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new retailer_bookstore_Separator_Custom_Control( $wp_customize, 'retailer_bookstore_pagination_separator', array(
	'label' => __( 'Enable / Disable Pagination Section', 'retailer-bookstore' ),
	'section' => 'retailer_bookstore_general_options',
	'settings' => 'retailer_bookstore_pagination_separator',
) ) );


// Pagination - Enable Pagination.
$wp_customize->add_setting(
	'retailer_bookstore_enable_pagination',
	array(
		'default'           => true,
		'sanitize_callback' => 'retailer_bookstore_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Retailer_Bookstore_Toggle_Switch_Custom_Control(
		$wp_customize,
		'retailer_bookstore_enable_pagination',
		array(
			'label'    => esc_html__( 'Enable Pagination', 'retailer-bookstore' ),
			'section'  => 'retailer_bookstore_general_options',
			'settings' => 'retailer_bookstore_enable_pagination',
			'type'     => 'checkbox',
		)
	)
);

// Pagination - Pagination Type.
$wp_customize->add_setting(
	'retailer_bookstore_pagination_type',
	array(
		'default'           => 'default',
		'sanitize_callback' => 'retailer_bookstore_sanitize_select',
	)
);

$wp_customize->add_control(
	'retailer_bookstore_pagination_type',
	array(
		'label'           => esc_html__( 'Pagination Type', 'retailer-bookstore' ),
		'section'         => 'retailer_bookstore_general_options',
		'settings'        => 'retailer_bookstore_pagination_type',
		'active_callback' => 'retailer_bookstore_is_pagination_enabled',
		'type'            => 'select',
		'choices'         => array(
			'default' => __( 'Default (Older/Newer)', 'retailer-bookstore' ),
			'numeric' => __( 'Numeric', 'retailer-bookstore' ),
		),
	)
);

// ---------------------------------------- BREADCRUMB ----------------------------------------------------

// Add Separator Custom Control
$wp_customize->add_setting( 'retailer_bookstore_breadcrumb_separators', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new retailer_bookstore_Separator_Custom_Control( $wp_customize, 'retailer_bookstore_breadcrumb_separators', array(
	'label' => __( 'Enable / Disable Breadcrumb Section', 'retailer-bookstore' ),
	'section' => 'retailer_bookstore_general_options',
	'settings' => 'retailer_bookstore_breadcrumb_separators',
)));

// Breadcrumb - Enable Breadcrumb.
$wp_customize->add_setting(
	'retailer_bookstore_enable_breadcrumb',
	array(
		'sanitize_callback' => 'retailer_bookstore_sanitize_switch',
		'default'           => true,
	)
);

$wp_customize->add_control(
	new Retailer_Bookstore_Toggle_Switch_Custom_Control(
		$wp_customize,
		'retailer_bookstore_enable_breadcrumb',
		array(
			'label'   => esc_html__( 'Enable Breadcrumb', 'retailer-bookstore' ),
			'section' => 'retailer_bookstore_general_options',
		)
	)
);

// Breadcrumb - Separator.
$wp_customize->add_setting(
	'retailer_bookstore_breadcrumb_separator',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'default'           => '/',
	)
);

$wp_customize->add_control(
	'retailer_bookstore_breadcrumb_separator',
	array(
		'label'           => esc_html__( 'Separator', 'retailer-bookstore' ),
		'active_callback' => 'retailer_bookstore_is_breadcrumb_enabled',
		'section'         => 'retailer_bookstore_general_options',
	)
);




// ---------------------------------------- Website layout ----------------------------------------------------


// Add Separator Custom Control
$wp_customize->add_setting( 'retailer_bookstore_layuout_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new retailer_bookstore_Separator_Custom_Control( $wp_customize, 'retailer_bookstore_layuout_separator', array(
	'label' => __( 'Website Layout Setting', 'retailer-bookstore' ),
	'section' => 'retailer_bookstore_general_options',
	'settings' => 'retailer_bookstore_layuout_separator',
)));


$wp_customize->add_setting(
	'retailer_bookstore_website_layout',
	array(
		'sanitize_callback' => 'retailer_bookstore_sanitize_switch',
		'default'           => false,
	)
);

$wp_customize->add_control(
	new Retailer_Bookstore_Toggle_Switch_Custom_Control(
		$wp_customize,
		'retailer_bookstore_website_layout',
		array(
			'label'   => esc_html__('Boxed Layout', 'retailer-bookstore'),
			'section' => 'retailer_bookstore_general_options',
		)
	)
);


$wp_customize->add_setting('retailer_bookstore_layout_width_margin', array(
	'default'           => 50,
	'sanitize_callback' => 'retailer_bookstore_sanitize_range_value',
));

$wp_customize->add_control(new retailer_bookstore_Customize_Range_Control($wp_customize, 'retailer_bookstore_layout_width_margin', array(
		'label'       => __('Set Width', 'retailer-bookstore'),
		'description' => __('Adjust the width around the website layout by moving the slider. Use this setting to customize the appearance of your site to fit your design preferences.', 'retailer-bookstore'),
		'section'     => 'retailer_bookstore_general_options',
		'settings'    => 'retailer_bookstore_layout_width_margin',
		'active_callback' => 'retailer_bookstore_is_layout_enabled',
		'input_attrs' => array(
			'min'  => 0,
			'max'  => 130,
			'step' => 1,
		),
)));

// ---------------------------------------- HEADER OPTIONS ----------------------------------------------------	

// Header Options
$wp_customize->add_section(
	'retailer_bookstore_header_options',
	array(
		'panel' => 'retailer_bookstore_theme_options',
		'title' => esc_html__( 'Header Options', 'retailer-bookstore' ),
	)
);


// Add setting for sticky header
$wp_customize->add_setting(
	'retailer_bookstore_enable_sticky_header',
	array(
		'sanitize_callback' => 'retailer_bookstore_sanitize_switch',
		'default'           => false,
	)
);

// Add control for sticky header setting
$wp_customize->add_control(
	new Retailer_Bookstore_Toggle_Switch_Custom_Control(
		$wp_customize,
		'retailer_bookstore_enable_sticky_header',
		array(
			'label'   => esc_html__( 'Enable Sticky Header', 'retailer-bookstore' ),
			'section' => 'retailer_bookstore_header_options',
		)
	)
);

// Banner Section - Enable Section.
$wp_customize->add_setting(
	'retailer_bookstore_enable_header_search_section',
	array(
		'default'           => true,
		'sanitize_callback' => 'retailer_bookstore_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Retailer_Bookstore_Toggle_Switch_Custom_Control(
		$wp_customize,
		'retailer_bookstore_enable_header_search_section',
		array(
			'label'    => esc_html__( 'Enable Search Section', 'retailer-bookstore' ),
			'section'  => 'retailer_bookstore_header_options',
			'settings' => 'retailer_bookstore_enable_header_search_section',
		)
	)
);

// Banner Section - Button Label.
$wp_customize->add_setting(
	'retailer_bookstore_header_button_label_',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'retailer_bookstore_header_button_label_',
	array(
		'label'           => esc_html__( 'Button Label 1', 'retailer-bookstore'  ),
		'section'         => 'retailer_bookstore_header_options',
		'settings'        => 'retailer_bookstore_header_button_label_',
		'type'            => 'text',
	)
);

// Banner Section - Button Link.
$wp_customize->add_setting(
	'retailer_bookstore_header_button_link_',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	)
);

$wp_customize->add_control(
	'retailer_bookstore_header_button_link_',
	array(
		'label'           => esc_html__( 'Button Link 1', 'retailer-bookstore' ),
		'section'         => 'retailer_bookstore_header_options',
		'settings'        => 'retailer_bookstore_header_button_link_',
		'type'            => 'url',
	)
);

// Banner Section - Button Label.
$wp_customize->add_setting(
	'retailer_bookstore_header_button_label_1',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'retailer_bookstore_header_button_label_1',
	array(
		'label'           => esc_html__( 'Button Label 2', 'retailer-bookstore'  ),
		'section'         => 'retailer_bookstore_header_options',
		'settings'        => 'retailer_bookstore_header_button_label_1',
		'type'            => 'text',
	)
);

// Banner Section - Button Link.
$wp_customize->add_setting(
	'retailer_bookstore_header_button_link_1',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	)
);

$wp_customize->add_control(
	'retailer_bookstore_header_button_link_1',
	array(
		'label'           => esc_html__( 'Button Link 2', 'retailer-bookstore' ),
		'section'         => 'retailer_bookstore_header_options',
		'settings'        => 'retailer_bookstore_header_button_link_1',
		'type'            => 'url',
	)
);

// Add Separator Custom Control
$wp_customize->add_setting( 'retailer_bookstore_menu_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new retailer_bookstore_Separator_Custom_Control( $wp_customize, 'retailer_bookstore_menu_separator', array(
	'label' => __( 'Menu Settings', 'retailer-bookstore' ),
	'section' => 'retailer_bookstore_header_options',
	'settings' => 'retailer_bookstore_menu_separator',
)));

$wp_customize->add_setting( 'retailer_bookstore_menu_font_size', array(
    'default'           => 14,
    'sanitize_callback' => 'absint',
) );

// Add control for site title size
$wp_customize->add_control( 'retailer_bookstore_menu_font_size', array(
    'type'        => 'number',
    'section'     => 'retailer_bookstore_header_options',
    'label'       => __( 'Menu Font Size ', 'retailer-bookstore' ),
    'input_attrs' => array(
        'min'  => 10,
        'max'  => 100,
        'step' => 1,
    ),
));

$wp_customize->add_setting( 'retailer_bookstore_menu_text_transform', array(
    'default'           => 'capitalize', // Default value for text transform
    'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'retailer_bookstore_menu_text_transform', array(
    'type'     => 'select',
    'section'  => 'retailer_bookstore_header_options',
    'label'    => __( 'Menu Text Transform', 'retailer-bookstore' ),
    'choices'  => array(
        'none'       => __( 'None', 'retailer-bookstore' ),
        'capitalize' => __( 'Capitalize', 'retailer-bookstore' ),
        'uppercase'  => __( 'Uppercase', 'retailer-bookstore' ),
        'lowercase'  => __( 'Lowercase', 'retailer-bookstore' ),
    ),
) );

// Menu Text Color 
$wp_customize->add_setting(
	'retailer_bookstore_menu_text_color', 
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color',
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize, 
		'retailer_bookstore_menu_text_color', 
		array(
			'label' => __('Menu Color', 'retailer-bookstore'),
			'section' => 'retailer_bookstore_header_options',
		)
	)
);

// Sub Menu Text Color 
$wp_customize->add_setting(
	'retailer_bookstore_sub_menu_text_color', 
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color',
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize, 
		'retailer_bookstore_sub_menu_text_color', 
		array(
			'label' => __('Sub Menu Color', 'retailer-bookstore'),
			'section' => 'retailer_bookstore_header_options',
		)
	)
);

// ----------------------------------------SITE IDENTITY----------------------------------------------------

$wp_customize->add_setting( 'retailer_bookstore_site_title_size', array(
    'default'           => 30, // Default font size in pixels
    'sanitize_callback' => 'absint', // Sanitize the input as a positive integer
) );

// Add control for site title size
$wp_customize->add_control( 'retailer_bookstore_site_title_size', array(
    'type'        => 'number',
    'section'     => 'title_tagline', // You can change this section to your preferred section
    'label'       => __( 'Site Title Font Size ', 'retailer-bookstore' ),
    'input_attrs' => array(
        'min'  => 10,
        'max'  => 100,
        'step' => 1,
    ),
) );


// Site Logo - Enable Setting.
$wp_customize->add_setting(
	'retailer_bookstore_enable_site_logo',
	array(
		'default'           => true, // Default is to display the logo.
		'sanitize_callback' => 'retailer_bookstore_sanitize_switch', // Sanitize using a custom switch function.
	)
);

$wp_customize->add_control(
	new Retailer_Bookstore_Toggle_Switch_Custom_Control(
		$wp_customize,
		'retailer_bookstore_enable_site_logo',
		array(
			'label'    => esc_html__( 'Enable Site Logo', 'retailer-bookstore' ),
			'section'  => 'title_tagline', // Section to add this control.
			'settings' => 'retailer_bookstore_enable_site_logo',
		)
	)
);

// Site Title - Enable Setting.
$wp_customize->add_setting(
	'retailer_bookstore_enable_site_title_setting',
	array(
		'default'           => true,
		'sanitize_callback' => 'retailer_bookstore_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Retailer_Bookstore_Toggle_Switch_Custom_Control(
		$wp_customize,
		'retailer_bookstore_enable_site_title_setting',
		array(
			'label'    => esc_html__( 'Enable Site Title', 'retailer-bookstore' ),
			'section'  => 'title_tagline',
			'settings' => 'retailer_bookstore_enable_site_title_setting',
		)
	)
);
// Tagline - Enable Setting.
$wp_customize->add_setting(
	'retailer_bookstore_enable_tagline_setting',
	array(
		'default'           => false,
		'sanitize_callback' => 'retailer_bookstore_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Retailer_Bookstore_Toggle_Switch_Custom_Control(
		$wp_customize,
		'retailer_bookstore_enable_tagline_setting',
		array(
			'label'    => esc_html__( 'Enable Tagline', 'retailer-bookstore' ),
			'section'  => 'title_tagline',
			'settings' => 'retailer_bookstore_enable_tagline_setting',
		)
	)
);

$wp_customize->add_setting('retailer_bookstore_site_logo_width', array(
    'default'           => 200,
    'sanitize_callback' => 'retailer_bookstore_sanitize_range_value',
));

$wp_customize->add_control(new retailer_bookstore_Customize_Range_Control($wp_customize, 'retailer_bookstore_site_logo_width', array(
    'label'       => __('Adjust Site Logo Width', 'retailer-bookstore'),
    'description' => __('This setting controls the Width of Site Logo', 'retailer-bookstore'),
    'section'     => 'title_tagline',
    'settings'    => 'retailer_bookstore_site_logo_width',
    'input_attrs' => array(
        'min'  => 0,
        'max'  => 400,
        'step' => 5,
    ),
)));