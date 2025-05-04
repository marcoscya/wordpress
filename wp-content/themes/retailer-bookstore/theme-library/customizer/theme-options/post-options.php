<?php

/**
 * Post Options
 *
 * @package retailer_bookstore
 */

$wp_customize->add_section(
	'retailer_bookstore_post_options',
	array(
		'title' => esc_html__( 'Post Options', 'retailer-bookstore' ),
		'panel' => 'retailer_bookstore_theme_options',
	)
);

// Post Options - Show / Hide Feature Image.
$wp_customize->add_setting(
	'retailer_bookstore_post_hide_feature_image',
	array(
		'default'           => true,
		'sanitize_callback' => 'retailer_bookstore_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Retailer_Bookstore_Toggle_Switch_Custom_Control(
		$wp_customize,
		'retailer_bookstore_post_hide_feature_image',
		array(
			'label'   => esc_html__( 'Show / Hide Featured Image', 'retailer-bookstore' ),
			'section' => 'retailer_bookstore_post_options',
		)
	)
);

// Post Options - Show / Hide Post Heading.
$wp_customize->add_setting(
	'retailer_bookstore_post_hide_post_heading',
	array(
		'default'           => true,
		'sanitize_callback' => 'retailer_bookstore_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Retailer_Bookstore_Toggle_Switch_Custom_Control(
		$wp_customize,
		'retailer_bookstore_post_hide_post_heading',
		array(
			'label'   => esc_html__( 'Show / Hide Post Heading', 'retailer-bookstore' ),
			'section' => 'retailer_bookstore_post_options',
		)
	)
);

// Post Options - Show / Hide Post Content.
$wp_customize->add_setting(
	'retailer_bookstore_post_hide_post_content',
	array(
		'default'           => true,
		'sanitize_callback' => 'retailer_bookstore_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Retailer_Bookstore_Toggle_Switch_Custom_Control(
		$wp_customize,
		'retailer_bookstore_post_hide_post_content',
		array(
			'label'   => esc_html__( 'Show / Hide Post Content', 'retailer-bookstore' ),
			'section' => 'retailer_bookstore_post_options',
		)
	)
);

// Post Options - Show / Hide Date.
$wp_customize->add_setting(
	'retailer_bookstore_post_hide_date',
	array(
		'default'           => true,
		'sanitize_callback' => 'retailer_bookstore_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Retailer_Bookstore_Toggle_Switch_Custom_Control(
		$wp_customize,
		'retailer_bookstore_post_hide_date',
		array(
			'label'   => esc_html__( 'Show / Hide Date', 'retailer-bookstore' ),
			'section' => 'retailer_bookstore_post_options',
		)
	)
);

// Post Options - Show / Hide Author.
$wp_customize->add_setting(
	'retailer_bookstore_post_hide_author',
	array(
		'default'           => true,
		'sanitize_callback' => 'retailer_bookstore_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Retailer_Bookstore_Toggle_Switch_Custom_Control(
		$wp_customize,
		'retailer_bookstore_post_hide_author',
		array(
			'label'   => esc_html__( 'Show / Hide Author', 'retailer-bookstore' ),
			'section' => 'retailer_bookstore_post_options',
		)
	)
);

// Post Options - Show / Hide Comments.
$wp_customize->add_setting(
	'retailer_bookstore_post_hide_comments',
	array(
		'default'           => true,
		'sanitize_callback' => 'retailer_bookstore_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Retailer_Bookstore_Toggle_Switch_Custom_Control(
		$wp_customize,
		'retailer_bookstore_post_hide_comments',
		array(
			'label'   => esc_html__( 'Show / Hide Comments', 'retailer-bookstore' ),
			'section' => 'retailer_bookstore_post_options',
		)
	)
);

// Post Options - Show / Hide Time.
$wp_customize->add_setting(
	'retailer_bookstore_post_hide_time',
	array(
		'default'           => true,
		'sanitize_callback' => 'retailer_bookstore_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Retailer_Bookstore_Toggle_Switch_Custom_Control(
		$wp_customize,
		'retailer_bookstore_post_hide_time',
		array(
			'label'   => esc_html__( 'Show / Hide Time', 'retailer-bookstore' ),
			'section' => 'retailer_bookstore_post_options',
		)
	)
);

// Post Options - Show / Hide Category.
$wp_customize->add_setting(
	'retailer_bookstore_post_hide_category',
	array(
		'default'           => true,
		'sanitize_callback' => 'retailer_bookstore_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Retailer_Bookstore_Toggle_Switch_Custom_Control(
		$wp_customize,
		'retailer_bookstore_post_hide_category',
		array(
			'label'   => esc_html__( 'Show / Hide Category', 'retailer-bookstore' ),
			'section' => 'retailer_bookstore_post_options',
		)
	)
);


// ---------------------------------------- Post layout ----------------------------------------------------

// Add Separator Custom Control
$wp_customize->add_setting( 'retailer_bookstore_archive_layuout_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new retailer_bookstore_Separator_Custom_Control( $wp_customize, 'retailer_bookstore_archive_layuout_separator', array(
	'label' => __( 'Archive/Blogs Layout Setting', 'retailer-bookstore' ),
	'section' => 'retailer_bookstore_post_options',
	'settings' => 'retailer_bookstore_archive_layuout_separator',
)));

// Archive Layout - Column Layout.
$wp_customize->add_setting(
	'retailer_bookstore_archive_column_layout',
	array(
		'default'           => 'column-1',
		'sanitize_callback' => 'retailer_bookstore_sanitize_select',
	)
);

$wp_customize->add_control(
	'retailer_bookstore_archive_column_layout',
	array(
		'label'   => esc_html__( 'Select Posts Layout', 'retailer-bookstore' ),
		'section' => 'retailer_bookstore_post_options',
		'type'    => 'select',
		'choices' => array(
			'column-1' => __( 'Column 1', 'retailer-bookstore' ),
			'column-2' => __( 'Column 2', 'retailer-bookstore' ),
			'column-3' => __( 'Column 3', 'retailer-bookstore' ),
		),
	)
);

$wp_customize->add_setting('retailer_bookstore_blog_layout_option_setting',array(
	'default' => 'Left',
	'sanitize_callback' => 'retailer_bookstore_sanitize_choices'
  ));
  $wp_customize->add_control(new retailer_bookstore_Image_Radio_Control($wp_customize, 'retailer_bookstore_blog_layout_option_setting', array(
	'type' => 'select',
	'label' => __('Blog Content Alignment','retailer-bookstore'),
	'section' => 'retailer_bookstore_post_options',
	'choices' => array(
		'Left' => esc_url(get_template_directory_uri()).'/resource/img/layout-2.png',
		'Default' => esc_url(get_template_directory_uri()).'/resource/img/layout-1.png',
		'Right' => esc_url(get_template_directory_uri()).'/resource/img/layout-3.png',
))));


// ---------------------------------------- Read More ----------------------------------------------------

// Add Separator Custom Control
$wp_customize->add_setting( 'retailer_bookstore_readmore_separators', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new retailer_bookstore_Separator_Custom_Control( $wp_customize, 'retailer_bookstore_readmore_separators', array(
	'label' => __( 'Read More Button Settings', 'retailer-bookstore' ),
	'section' => 'retailer_bookstore_post_options',
	'settings' => 'retailer_bookstore_readmore_separators',
)));


// Post Options - Show / Hide Read More Button.
$wp_customize->add_setting(
	'retailer_bookstore_post_readmore_button',
	array(
		'default'           => true,
		'sanitize_callback' => 'retailer_bookstore_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Retailer_Bookstore_Toggle_Switch_Custom_Control(
		$wp_customize,
		'retailer_bookstore_post_readmore_button',
		array(
			'label'   => esc_html__( 'Show / Hide Read More Button', 'retailer-bookstore' ),
			'section' => 'retailer_bookstore_post_options',
		)
	)
);

$wp_customize->add_setting(
    'retailer_bookstore_readmore_btn_icon',
    array(
        'default' => 'fas fa-chevron-right', // Set default icon here
        'sanitize_callback' => 'sanitize_text_field',
        'capability' => 'edit_theme_options',
    )
);

$wp_customize->add_control(new retailer_bookstore_Change_Icon_Control(
    $wp_customize, 
    'retailer_bookstore_readmore_btn_icon',
    array(
        'label'    => __('Read More Icon','retailer-bookstore'),
        'section'  => 'retailer_bookstore_post_options',
        'iconset'  => 'fa',
    )
));

$wp_customize->add_setting(
	'retailer_bookstore_readmore_button_text',
	array(
		'default'           => 'Read More',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'retailer_bookstore_readmore_button_text',
	array(
		'label'           => esc_html__( 'Read More Button Text', 'retailer-bookstore' ),
		'section'         => 'retailer_bookstore_post_options',
		'settings'        => 'retailer_bookstore_readmore_button_text',
		'type'            => 'text',
	)
);

// Featured Image Dimension
$wp_customize->add_setting(
	'retailer_bookstore_blog_post_featured_image_dimension',
	array(
		'default' => 'default',
		'sanitize_callback' => 'retailer_bookstore_sanitize_choices'
	)
);

$wp_customize->add_control(
	'retailer_bookstore_blog_post_featured_image_dimension', 
	array(
		'type' => 'select',
		'label' => __('Featured Image Dimension','retailer-bookstore'),
		'section' => 'retailer_bookstore_post_options',
		'choices' => array(
			'default' => __('Default','retailer-bookstore'),
			'custom' => __('Custom Image Size','retailer-bookstore'),
		),
		'description' => __('Note: If you select "Custom Image Size", you can set a custom width and height up to 950px.', 'retailer-bookstore')
	)
);
 
// Featured Image Custom Width
$wp_customize->add_setting(
	'retailer_bookstore_blog_post_featured_image_custom_width',
	array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	)
);

$wp_customize->add_control(
	'retailer_bookstore_blog_post_featured_image_custom_width',
	array(
		'label'	=> __('Featured Image Custom Width','retailer-bookstore'),
		'section'=> 'retailer_bookstore_post_options',
		'type'=> 'text',
		'input_attrs' => array(
			'placeholder' => __( '300', 'retailer-bookstore' ),
		),
		'active_callback' => 'retailer_bookstore_blog_post_featured_image_dimension'
	)
);

// Featured Image Custom Height
$wp_customize->add_setting(
	'retailer_bookstore_blog_post_featured_image_custom_height',
	array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	)
);

$wp_customize->add_control(
	'retailer_bookstore_blog_post_featured_image_custom_height',
	array(
		'label'	=> __('Featured Image Custom Height','retailer-bookstore'),
		'section'=> 'retailer_bookstore_post_options',
		'type'=> 'text',
		'input_attrs' => array(
			'placeholder' => __( '300', 'retailer-bookstore' ),
		),
		'active_callback' => 'retailer_bookstore_blog_post_featured_image_dimension'
	)
);