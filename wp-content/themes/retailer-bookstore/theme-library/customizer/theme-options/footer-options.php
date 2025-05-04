<?php

/**
 * Footer Options
 *
 * @package retailer_bookstore
 */

$wp_customize->add_section(
	'retailer_bookstore_footer_options',
	array(
		'panel' => 'retailer_bookstore_theme_options',
		'title' => esc_html__( 'Footer Options', 'retailer-bookstore' ),
	)
);

// Add Separator Custom Control
$wp_customize->add_setting( 'retailer_bookstore_footer_separators', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new retailer_bookstore_Separator_Custom_Control( $wp_customize, 'retailer_bookstore_footer_separators', array(
	'label' => __( 'Footer Settings', 'retailer-bookstore' ),
	'section' => 'retailer_bookstore_footer_options',
	'settings' => 'retailer_bookstore_footer_separators',
)));


	// column // 
$wp_customize->add_setting(
	'retailer_bookstore_footer_widget_column',
	array(
        'default'			=> '4',
		'capability'     	=> 'edit_theme_options',
		'sanitize_callback' => 'retailer_bookstore_sanitize_select',
		
	)
);	

$wp_customize->add_control(
	'retailer_bookstore_footer_widget_column',
	array(
	    'label'   		=> __('Select Widget Column','retailer-bookstore'),
	    'section' 		=> 'retailer_bookstore_footer_options',
		'type'			=> 'select',
		'choices'        => 
		array(
			'' => __( 'None', 'retailer-bookstore' ),
			'1' => __( '1 Column', 'retailer-bookstore' ),
			'2' => __( '2 Column', 'retailer-bookstore' ),
			'3' => __( '3 Column', 'retailer-bookstore' ),
			'4' => __( '4 Column', 'retailer-bookstore' )
		) 
	) 
);

//  BG Color // 
$wp_customize->add_setting('retailer_bookstore_footer_background_color_setting', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'retailer_bookstore_footer_background_color_setting', array(
    'label' => __('Footer Background Color', 'retailer-bookstore'),
    'section' => 'retailer_bookstore_footer_options',
)));

// Footer Background Image Setting
$wp_customize->add_setting('retailer_bookstore_footer_background_image_setting', array(
    'default' => '',
    'sanitize_callback' => 'esc_url_raw',
));

$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'retailer_bookstore_footer_background_image_setting', array(
    'label' => __('Footer Background Image', 'retailer-bookstore'),
    'section' => 'retailer_bookstore_footer_options',
)));

$wp_customize->add_setting('footer_text_transform', array(
    'default' => 'none',
    'sanitize_callback' => 'sanitize_text_field',
));

// Add Footer Text Transform Control
$wp_customize->add_control('footer_text_transform', array(
    'label' => __('Footer Heading Text Transform', 'retailer-bookstore'),
    'section' => 'retailer_bookstore_footer_options',
    'settings' => 'footer_text_transform',
    'type' => 'select',
    'choices' => array(
        'none' => __('None', 'retailer-bookstore'),
        'capitalize' => __('Capitalize', 'retailer-bookstore'),
        'uppercase' => __('Uppercase', 'retailer-bookstore'),
        'lowercase' => __('Lowercase', 'retailer-bookstore'),
    ),
));

$wp_customize->add_setting(
	'retailer_bookstore_footer_copyright_text',
	array(
		'sanitize_callback' => 'wp_kses_post',
		'transport'         => 'refresh',
	)
);

$wp_customize->add_control(
	'retailer_bookstore_footer_copyright_text',
	array(
		'label'    => esc_html__( 'Copyright Text', 'retailer-bookstore' ),
		'section'  => 'retailer_bookstore_footer_options',
		'settings' => 'retailer_bookstore_footer_copyright_text',
		'type'     => 'textarea',
	)
);

//Copyright Alignment
$wp_customize->add_setting(
	'retailer_bookstore_footer_bottom_align',
	array(
		'default' 			=> 'center',
		'sanitize_callback' => 'sanitize_text_field'
	)
);

$wp_customize->add_control(
	'retailer_bookstore_footer_bottom_align',
	array(
		'label' => __('Copyright Alignment ','retailer-bookstore'),
		'section' => 'retailer_bookstore_footer_options',
		'type'			=> 'select',
		'choices' => 
		array(
			'left' => __('Left','retailer-bookstore'),
			'right' => __('Right','retailer-bookstore'),
			'center' => __('Center','retailer-bookstore'),
		),
	)
);

// Add Separator Custom Control
$wp_customize->add_setting( 'retailer_bookstore_scroll_separators', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new retailer_bookstore_Separator_Custom_Control( $wp_customize, 'retailer_bookstore_scroll_separators', array(
	'label' => __( 'Scroll Top Settings', 'retailer-bookstore' ),
	'section' => 'retailer_bookstore_footer_options',
	'settings' => 'retailer_bookstore_scroll_separators',
)));

// Footer Options - Scroll Top.
$wp_customize->add_setting(
	'retailer_bookstore_scroll_top',
	array(
		'sanitize_callback' => 'retailer_bookstore_sanitize_switch',
		'default'           => true,
	)
);

$wp_customize->add_control(
	new Retailer_Bookstore_Toggle_Switch_Custom_Control(
		$wp_customize,
		'retailer_bookstore_scroll_top',
		array(
			'label'   => esc_html__( 'Enable Scroll Top Button', 'retailer-bookstore' ),
			'section' => 'retailer_bookstore_footer_options',
		)
	)
);
// icon // 
$wp_customize->add_setting(
	'retailer_bookstore_scroll_btn_icon',
	array(
        'default' => 'fas fa-chevron-up',
		'sanitize_callback' => 'sanitize_text_field',
		'capability' => 'edit_theme_options',
		
	)
);	

$wp_customize->add_control(new retailer_bookstore_Change_Icon_Control($wp_customize, 
	'retailer_bookstore_scroll_btn_icon',
	array(
	    'label'   		=> __('Scroll Top Icon','retailer-bookstore'),
	    'section' 		=> 'retailer_bookstore_footer_options',
		'iconset' => 'fa',
	))  
);
$wp_customize->add_setting( 'retailer_bookstore_scroll_top_position', array(
    'default'           => 'bottom-right',
    'sanitize_callback' => 'retailer_bookstore_sanitize_scroll_top_position',
) );

// Add control for Scroll Top Button Position
$wp_customize->add_control( 'retailer_bookstore_scroll_top_position', array(
    'label'    => __( 'Scroll Top Button Position', 'retailer-bookstore' ),
    'section'  => 'retailer_bookstore_footer_options',
    'settings' => 'retailer_bookstore_scroll_top_position',
    'type'     => 'select',
    'choices'  => array(
        'bottom-right' => __( 'Bottom Right', 'retailer-bookstore' ),
        'bottom-left'  => __( 'Bottom Left', 'retailer-bookstore' ),
        'bottom-center'=> __( 'Bottom Center', 'retailer-bookstore' ),
    ),
) );

$wp_customize->add_setting( 'retailer_bookstore_scroll_top_shape', array(
	'default'           => 'box',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'retailer_bookstore_scroll_top_shape', array(
	'label'    => __( 'Scroll to Top Button Shape', 'retailer-bookstore' ),
	'section'  => 'retailer_bookstore_footer_options',
	'settings' => 'retailer_bookstore_scroll_top_shape',
	'type'     => 'radio',
	'choices'  => array(
		'box'        => __( 'Box', 'retailer-bookstore' ),
		'curved-box' => __( 'Curved Box', 'retailer-bookstore' ),
		'circle'     => __( 'Circle', 'retailer-bookstore' ),
	),
) );

