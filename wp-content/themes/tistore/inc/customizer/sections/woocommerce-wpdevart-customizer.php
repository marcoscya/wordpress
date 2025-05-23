<?php 
	$wp_customize->add_panel( 'wpdevart_tistore_woocommerce_settings_panel', 
    array(
		'title'	=> esc_html__('WooCommerce WpDevArt','tistore'),			
        'description'	=> esc_html__('WooCommerce custom settings','tistore'),		
		'priority'		=> 29
    ) 
	);

	##################------ WooCommerce ------##################

	$wp_customize->add_section('woocommerce_general_section',array(
		'title'	=> esc_html__('WooCommerce Layout','tistore'),					
		'priority'		=> null,
		'panel'         => 'wpdevart_tistore_woocommerce_settings_panel'
	));
    $wp_customize->add_setting( 'wpdevart_tistore_woocommerce_shop_category_layout',
	array(
		'default' => esc_html('sidebarnone'),
		'transport' => 'refresh',
		'sanitize_callback' => 'wpdevart_tistore_text_sanitization'
	)
	);
	$wp_customize->add_control( new Wpdevart_Image_Radio_Button_Custom_Control( $wp_customize, 'wpdevart_tistore_woocommerce_shop_category_layout',
	array(
		'label' => esc_html__( 'WooCommerce Shop/Category pages layout', 'tistore' ),
		'description' => esc_html__( 'Choose the WooCommerce Shop/Category pages layout.', 'tistore' ),
		'section' => 'woocommerce_general_section',
		'choices' => array(
		'sidebarleft' => array(
			'image' => trailingslashit( get_template_directory_uri() ) . 'images/sidebar-left.png',
			'name' => esc_html__( 'Left Sidebar', 'tistore' )
		),
		'sidebarnone' => array(
			'image' => trailingslashit( get_template_directory_uri() ) . 'images/sidebar-none.png',
			'name' => esc_html__( 'No Sidebar', 'tistore' )
		),
		'sidebarright' => array(
			'image' => trailingslashit( get_template_directory_uri() ) . 'images/sidebar-right.png',
			'name' => esc_html__( 'Right Sidebar', 'tistore' )
		)
		)
	)
	) );
	$wp_customize->add_setting( 'wpdevart_tistore_woocommerce_product_pages_layout',
	array(
		'default' => esc_html('sidebarnone'),
		'transport' => 'refresh',
		'sanitize_callback' => 'wpdevart_tistore_text_sanitization'
	)
	);
	$wp_customize->add_control( new Wpdevart_Image_Radio_Button_Custom_Control( $wp_customize, 'wpdevart_tistore_woocommerce_product_pages_layout',
	array(
		'label' => esc_html__( 'WooCommerce Products pages layout', 'tistore' ),
		'description' => esc_html__( 'Choose the WooCommerce products pages layout.', 'tistore' ),
		'section' => 'woocommerce_general_section',
		'choices' => array(
		'sidebarleft' => array(
			'image' => trailingslashit( get_template_directory_uri() ) . 'images/sidebar-left.png',
			'name' => esc_html__( 'Left Sidebar', 'tistore' )
		),
		'sidebarnone' => array(
			'image' => trailingslashit( get_template_directory_uri() ) . 'images/sidebar-none.png',
			'name' => esc_html__( 'No Sidebar', 'tistore' )
		),
		'sidebarright' => array(
			'image' => trailingslashit( get_template_directory_uri() ) . 'images/sidebar-right.png',
			'name' => esc_html__( 'Right Sidebar', 'tistore' )
		)
		)
	)
	) );
	$wp_customize->add_setting( 'wpdevart_tistore_woocommerce_cart_checkout_account_layout',
	array(
		'default' => esc_html('sidebarnone'),
		'transport' => 'refresh',
		'sanitize_callback' => 'wpdevart_tistore_text_sanitization'
	)
	);
	$wp_customize->add_control( new Wpdevart_Image_Radio_Button_Custom_Control( $wp_customize, 'wpdevart_tistore_woocommerce_cart_checkout_account_layout',
	array(
		'label' => esc_html__( 'WooCommerce Cart/Checkout/Account layout', 'tistore' ),
		'description' => esc_html__( 'Choose the WooCommerce Cart/Checkout/Account pages layout.', 'tistore' ),
		'section' => 'woocommerce_general_section',
		'choices' => array(
		'sidebarleft' => array(
			'image' => trailingslashit( get_template_directory_uri() ) . 'images/sidebar-left.png',
			'name' => esc_html__( 'Left Sidebar', 'tistore' )
		),
		'sidebarnone' => array(
			'image' => trailingslashit( get_template_directory_uri() ) . 'images/sidebar-none.png',
			'name' => esc_html__( 'No Sidebar', 'tistore' )
		),
		'sidebarright' => array(
			'image' => trailingslashit( get_template_directory_uri() ) . 'images/sidebar-right.png',
			'name' => esc_html__( 'Right Sidebar', 'tistore' )
		)
		)
	)
	) );

	##################------ WooCommerce Typography ------##################

	$wp_customize->add_section('woocommerce_typography_section',array(
		'title'	=> esc_html__('WooCommerce Typography','tistore'),					
		'priority'		=> null,
		'panel'         => 'wpdevart_tistore_woocommerce_settings_panel'
	));

	$wp_customize->add_setting( 'wpdevart_tistore_woocommerce_text_font_size',
	array(
		'default' => esc_html('17'),
		'sanitize_callback' => 'wpdevart_tistore_sanitize_integer'
		)
	);
	$wp_customize->add_control( new Wpdevart_Slider_Custom_Control( $wp_customize, 'wpdevart_tistore_woocommerce_text_font_size',
		array(
		'label' => esc_html__( 'Text font-size for Woo pages (px)', 'tistore' ),
		'section' => 'woocommerce_typography_section',
		'input_attrs' => array(
			'min' => esc_html('16'),
			'max' => esc_html('20'),
			'step' => esc_html('1'),
		),
		)
	) );
	$wp_customize->add_setting( 'wpdevart_tistore_woocommerce_link_font_size',
	array(
		'default' => esc_html('17'),
		'sanitize_callback' => 'wpdevart_tistore_sanitize_integer'
		)
	);
	$wp_customize->add_control( new Wpdevart_Slider_Custom_Control( $wp_customize, 'wpdevart_tistore_woocommerce_link_font_size',
		array(
		'label' => esc_html__( 'Link font-size for Woo pages (px)', 'tistore' ),
		'section' => 'woocommerce_typography_section',
		'input_attrs' => array(
			'min' => esc_html('16'),
			'max' => esc_html('20'),
			'step' => esc_html('1'),
		),
		)
	) );
	$wp_customize->add_setting( 'wpdevart_tistore_woocommerce_heading_h1_font_size',
	array(
		'default' => esc_html('40'),
		'sanitize_callback' => 'wpdevart_tistore_sanitize_integer'
		)
	);
	$wp_customize->add_control( new Wpdevart_Slider_Custom_Control( $wp_customize, 'wpdevart_tistore_woocommerce_heading_h1_font_size',
		array(
		'label' => esc_html__( 'Title font-size for Woo pages (px)', 'tistore' ),
		'section' => 'woocommerce_typography_section',
		'input_attrs' => array(
			'min' => esc_html('35'),
			'max' => esc_html('60'),
			'step' => esc_html('1'),
		),
		)
	) );
	
	##################------ WooCommerce Primary Button ------##################

	$wp_customize->add_section('woocommerce_primary_button_colors_section',array(
		'title'	=> esc_html__('WooCommerce Primary Button','tistore'),					
		'priority'		=> null,
		'panel'         => 'wpdevart_tistore_woocommerce_settings_panel'
	));

	$wp_customize->add_setting('wpdevart_tistore_woo_primary_button_bg_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_woo_primary_button_bg_color', esc_html('#1287ff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_woo_primary_button_bg_color', array(
		'label' => esc_html__('WooCommerce primary button bg color','tistore'),
		'section' => 'woocommerce_primary_button_colors_section',
		'settings' => 'wpdevart_tistore_woo_primary_button_bg_color'
	)));
	$wp_customize->add_setting('wpdevart_tistore_woo_primary_button_border_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_woo_primary_button_border_color', esc_html('#1287ff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_woo_primary_button_border_color', array(
		'label' => esc_html__('WooCommerce primary button border color','tistore'),
		'section' => 'woocommerce_primary_button_colors_section',
		'settings' => 'wpdevart_tistore_woo_primary_button_border_color'
	)));
	$wp_customize->add_setting('wpdevart_tistore_woo_primary_button_link_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_woo_primary_button_link_color', esc_html('#ffffff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_woo_primary_button_link_color', array(
		'label' => esc_html__('WooCommerce primary button text color','tistore'),
		'section' => 'woocommerce_primary_button_colors_section',
		'settings' => 'wpdevart_tistore_woo_primary_button_link_color'
	)));
	$wp_customize->add_setting('wpdevart_tistore_woo_primary_button_bg_hover_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_woo_primary_button_bg_hover_color', esc_html('#ffffff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_woo_primary_button_bg_hover_color', array(
		'label' => esc_html__('WooCommerce primary button bg hover color','tistore'),
		'section' => 'woocommerce_primary_button_colors_section',
		'settings' => 'wpdevart_tistore_woo_primary_button_bg_hover_color'
	)));
	$wp_customize->add_setting('wpdevart_tistore_woo_primary_button_border_hover_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_woo_primary_button_border_hover_color', esc_html('#1287ff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_woo_primary_button_border_hover_color', array(
		'label' => esc_html__('WooCommerce primary button border hover color','tistore'),
		'section' => 'woocommerce_primary_button_colors_section',
		'settings' => 'wpdevart_tistore_woo_primary_button_border_hover_color'
	)));
	$wp_customize->add_setting('wpdevart_tistore_woo_primary_button_link_hover_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_woo_primary_button_link_hover_color', esc_html('#1287ff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_woo_primary_button_link_hover_color', array(
		'label' => esc_html__('WooCommerce primary button text hover color','tistore'),
		'section' => 'woocommerce_primary_button_colors_section',
		'settings' => 'wpdevart_tistore_woo_primary_button_link_hover_color'
	)));
		
	##################------ WooCommerce Shop/Product Colors ------##################

	$wp_customize->add_section('woocommerce_global_colors_section',array(
		'title'	=> esc_html__('WooCommerce Colors','tistore'),					
		'priority'		=> null,
		'panel'         => 'wpdevart_tistore_woocommerce_settings_panel'
	));

	$wp_customize->add_setting('wpdevart_tistore_woocommerce_page_bg_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_woocommerce_page_bg_color', esc_html('#ffffff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_woocommerce_page_bg_color', array(
        'label' => esc_html__('WooCommerce pages bg color','tistore'),
        'section' => 'woocommerce_global_colors_section',
        'settings' => 'wpdevart_tistore_woocommerce_page_bg_color'
    )));

	$wp_customize->add_setting('wpdevart_tistore_woocommerce_products_blocks_bg_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_woocommerce_products_blocks_bg_color', esc_html('#ffffff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_woocommerce_products_blocks_bg_color', array(
        'label' => esc_html__('WooCommerce product summary bg color','tistore'),
        'section' => 'woocommerce_global_colors_section',
        'settings' => 'wpdevart_tistore_woocommerce_products_blocks_bg_color'
    )));
	$wp_customize->add_setting('wpdevart_tistore_woocommerce_heading_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_woocommerce_heading_color', esc_html('#000000')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_woocommerce_heading_color', array(
        'label' => esc_html__('WooCommerce pages headings color','tistore'),
        'section' => 'woocommerce_global_colors_section',
        'settings' => 'wpdevart_tistore_woocommerce_heading_color'
    )));
	$wp_customize->add_setting('wpdevart_tistore_woocommerce_text_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_woocommerce_text_color', esc_html('#333333')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_woocommerce_text_color', array(
        'label' => esc_html__('WooCommerce pages text color','tistore'),
        'section' => 'woocommerce_global_colors_section',
        'settings' => 'wpdevart_tistore_woocommerce_text_color'
    )));
	$wp_customize->add_setting('wpdevart_tistore_woocommerce_link_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_woocommerce_link_color', esc_html('#000000')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_woocommerce_link_color', array(
        'label' => esc_html__('WooCommerce pages link color','tistore'),
        'section' => 'woocommerce_global_colors_section',
        'settings' => 'wpdevart_tistore_woocommerce_link_color'
    )));
	$wp_customize->add_setting('wpdevart_tistore_woocommerce_link_hover_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_woocommerce_link_hover_color', esc_html('#fa3c7a')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_woocommerce_link_hover_color', array(
        'label' => esc_html__('WooCommerce pages link hover color','tistore'),
        'section' => 'woocommerce_global_colors_section',
        'settings' => 'wpdevart_tistore_woocommerce_link_hover_color'
    )));
	$wp_customize->add_setting('wpdevart_tistore_woocommerce_sales_bg_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_woocommerce_sales_bg_color', esc_html('#ffffff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_woocommerce_sales_bg_color', array(
        'label' => esc_html__('WooCommerce Sales background color','tistore'),
        'section' => 'woocommerce_global_colors_section',
        'settings' => 'wpdevart_tistore_woocommerce_sales_bg_color'
    )));
	$wp_customize->add_setting('wpdevart_tistore_woocommerce_sales_text_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_woocommerce_sales_text_color', esc_html('#1287ff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_woocommerce_sales_text_color', array(
        'label' => esc_html__('WooCommerce Sales text color','tistore'),
        'section' => 'woocommerce_global_colors_section',
        'settings' => 'wpdevart_tistore_woocommerce_sales_text_color'
    )));
	$wp_customize->add_setting('wpdevart_tistore_woocommerce_active_tab_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_woocommerce_active_tab_color', esc_html('#1287ff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_woocommerce_active_tab_color', array(
        'label' => esc_html__('WooCommerce product active tab color','tistore'),
        'section' => 'woocommerce_global_colors_section',
        'settings' => 'wpdevart_tistore_woocommerce_active_tab_color'
    )));
	$wp_customize->add_setting('wpdevart_tistore_woocommerce_inactive_tab_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_woocommerce_inactive_tab_color', esc_html('#7e7e7e')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_woocommerce_inactive_tab_color', array(
        'label' => esc_html__('WooCommerce product inactive tab color','tistore'),
        'section' => 'woocommerce_global_colors_section',
        'settings' => 'wpdevart_tistore_woocommerce_inactive_tab_color'
    )));
	$wp_customize->add_setting('wpdevart_tistore_woocommerce_tab_border_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_woocommerce_tab_border_color', esc_html('#e2eeff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_woocommerce_tab_border_color', array(
        'label' => esc_html__('WooCommerce product tab border color','tistore'),
        'section' => 'woocommerce_global_colors_section',
        'settings' => 'wpdevart_tistore_woocommerce_tab_border_color'
    )));
	$wp_customize->add_setting('wpdevart_tistore_woocommerce_rating_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_woocommerce_rating_color', esc_html('#fa3c7a')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_woocommerce_rating_color', array(
        'label' => esc_html__('WooCommerce rating/star color','tistore'),
        'section' => 'woocommerce_global_colors_section',
        'settings' => 'wpdevart_tistore_woocommerce_rating_color'
    )));
	$wp_customize->add_setting('wpdevart_tistore_woocommerce_info_border_icon_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_woocommerce_info_border_icon_color', esc_html('#1287ff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_woocommerce_info_border_icon_color', array(
        'label' => esc_html__('WooCommerce Info border/icon color','tistore'),
        'section' => 'woocommerce_global_colors_section',
        'settings' => 'wpdevart_tistore_woocommerce_info_border_icon_color'
    )));
	
	##################------ WooCommerce Pagination ------##################

	$wp_customize->add_section('wpdevart_tistore_woo_pagination_settings',array(
		'title'	=> esc_html__('WooCommerce Pagination','tistore'),					
		'priority'		=> null,
		'panel'         => 'wpdevart_tistore_woocommerce_settings_panel'
	));

	$wp_customize->add_setting('wpdevart_tistore_woo_pagination_buttons_bg_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_woo_pagination_buttons_bg_color', esc_html('#ffffff')),
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_woo_pagination_buttons_bg_color', array(
        'label' => esc_html__('Buttons background color','tistore'),
        'section' => 'wpdevart_tistore_woo_pagination_settings',
        'settings' => 'wpdevart_tistore_woo_pagination_buttons_bg_color'
    )));
	$wp_customize->add_setting('wpdevart_tistore_woo_pagination_buttons_border_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_woo_pagination_buttons_border_color', esc_html('#fa3c7a')),
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_woo_pagination_buttons_border_color', array(
        'label' => esc_html__('Buttons border color','tistore'),
        'section' => 'wpdevart_tistore_woo_pagination_settings',
        'settings' => 'wpdevart_tistore_woo_pagination_buttons_border_color'
    )));
	$wp_customize->add_setting('wpdevart_tistore_woo_pagination_buttons_link_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_woo_pagination_buttons_link_color', esc_html('#fa3c7a')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_woo_pagination_buttons_link_color', array(
        'label' => esc_html__('Text color of active buttons','tistore'),
        'section' => 'wpdevart_tistore_woo_pagination_settings',
        'settings' => 'wpdevart_tistore_woo_pagination_buttons_link_color'
    )));
	$wp_customize->add_setting('wpdevart_tistore_woo_pagination_buttons_text_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_woo_pagination_buttons_text_color', esc_html('#f9c0d7')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_woo_pagination_buttons_text_color', array(
        'label' => esc_html__('Text color of inactive buttons','tistore'),
        'section' => 'wpdevart_tistore_woo_pagination_settings',
        'settings' => 'wpdevart_tistore_woo_pagination_buttons_text_color'
    )));
	$wp_customize->add_setting('wpdevart_tistore_woo_pagination_buttons_bg_hover_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_woo_pagination_buttons_bg_hover_color', esc_html('#fa3c7a')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_woo_pagination_buttons_bg_hover_color', array(
        'label' => esc_html__('Buttons background hover color','tistore'),
        'section' => 'wpdevart_tistore_woo_pagination_settings',
        'settings' => 'wpdevart_tistore_woo_pagination_buttons_bg_hover_color'
    )));
	$wp_customize->add_setting('wpdevart_tistore_woo_pagination_buttons_border_hover_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_woo_pagination_buttons_border_hover_color', esc_html('#fa3c7a')),
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_woo_pagination_buttons_border_hover_color', array(
        'label' => esc_html__('Buttons border hover color','tistore'),
        'section' => 'wpdevart_tistore_woo_pagination_settings',
        'settings' => 'wpdevart_tistore_woo_pagination_buttons_border_hover_color'
    )));
	$wp_customize->add_setting('wpdevart_tistore_woo_pagination_buttons_link_hover_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_woo_pagination_buttons_link_hover_color', esc_html('#ffffff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_woo_pagination_buttons_link_hover_color', array(
        'label' => esc_html__('Text color of active buttons on hover','tistore'),
        'section' => 'wpdevart_tistore_woo_pagination_settings',
        'settings' => 'wpdevart_tistore_woo_pagination_buttons_link_hover_color'
    )));
	$wp_customize->add_setting('wpdevart_tistore_woo_pagination_buttons_text_hover_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_tistore_woo_pagination_buttons_text_hover_color', esc_html('#f9c0d7')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_tistore_woo_pagination_buttons_text_hover_color', array(
        'label' => esc_html__('Text color of inactive buttons on hover','tistore'),
        'section' => 'wpdevart_tistore_woo_pagination_settings',
        'settings' => 'wpdevart_tistore_woo_pagination_buttons_text_hover_color'
    )));
	$wp_customize->add_setting( 'wpdevart_tistore_woo_pagination_text_font_size',
	array(
		'default' => esc_html('18'),
		'sanitize_callback' => 'wpdevart_tistore_sanitize_integer'
		)
	);
	$wp_customize->add_control( new Wpdevart_Slider_Custom_Control( $wp_customize, 'wpdevart_tistore_woo_pagination_text_font_size',
		array(
		'label' => esc_html__( 'Font-size of buttons (px)', 'tistore' ),
		'section' => 'wpdevart_tistore_woo_pagination_settings',
		'input_attrs' => array(
			'min' => esc_html('16'),
			'max' => esc_html('20'),
			'step' => esc_html('1'),
		),
		)
	) );