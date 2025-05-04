<?php

/**
 * Banner Section
 *
 * @package retailer_bookstore
 */

$wp_customize->add_section(
	'retailer_bookstore_banner_section',
	array(
		'panel'    => 'retailer_bookstore_front_page_options',
		'title'    => esc_html__( 'Banner Section', 'retailer-bookstore' ),
		'priority' => 10,
	)
);

// Banner Section - Enable Section.
$wp_customize->add_setting(
	'retailer_bookstore_enable_banner_section',
	array(
		'default'           => false,
		'sanitize_callback' => 'retailer_bookstore_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Retailer_Bookstore_Toggle_Switch_Custom_Control(
		$wp_customize,
		'retailer_bookstore_enable_banner_section',
		array(
			'label'    => esc_html__( 'Enable Banner Section', 'retailer-bookstore' ),
			'section'  => 'retailer_bookstore_banner_section',
			'settings' => 'retailer_bookstore_enable_banner_section',
		)
	)
);

if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial(
		'retailer_bookstore_enable_banner_section',
		array(
			'selector' => '#retailer_bookstore_banner_section .section-link',
			'settings' => 'retailer_bookstore_enable_banner_section',
		)
	);
}


// Banner Section - Banner Slider Content Type.
$wp_customize->add_setting(
	'retailer_bookstore_banner_slider_content_type',
	array(
		'default'           => 'post',
		'sanitize_callback' => 'retailer_bookstore_sanitize_select',
	)
);

$wp_customize->add_control(
	'retailer_bookstore_banner_slider_content_type',
	array(
		'label'           => esc_html__( 'Select Banner Slider Content Type', 'retailer-bookstore' ),
		'section'         => 'retailer_bookstore_banner_section',
		'settings'        => 'retailer_bookstore_banner_slider_content_type',
		'type'            => 'select',
		'active_callback' => 'retailer_bookstore_is_banner_slider_section_enabled',
		'choices'         => array(
			'page' => esc_html__( 'Page', 'retailer-bookstore' ),
			'post' => esc_html__( 'Post', 'retailer-bookstore' ),
		),
	)
);

// Banner Slider Category Setting.
$wp_customize->add_setting('retailer_bookstore_banner_slider_category', array(
	'default'           => 'slider',
	'sanitize_callback' => 'sanitize_text_field',
));

// Add custom control for Banner Slider Category with conditional visibility.
$wp_customize->add_control(new retailer_bookstore_Customize_Category_Dropdown_Control($wp_customize, 'retailer_bookstore_banner_slider_category', array(
	'label'    => __('Select Banner Category', 'retailer-bookstore'),
	'section'  => 'retailer_bookstore_banner_section',
	'settings' => 'retailer_bookstore_banner_slider_category',
	'active_callback' => function() use ($wp_customize) {
		return $wp_customize->get_setting('retailer_bookstore_banner_slider_content_type')->value() === 'post';
	},
)));

for ( $retailer_bookstore_i = 1; $retailer_bookstore_i <= 3; $retailer_bookstore_i++ ) {

	// Banner Section - Select Banner Post.
	$wp_customize->add_setting(
		'retailer_bookstore_banner_slider_content_post_' . $retailer_bookstore_i,
		array(
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'retailer_bookstore_banner_slider_content_post_' . $retailer_bookstore_i,
		array(
			/* translators: %d: Post Count. */
			'label'           => sprintf( esc_html__( 'Select Post %d', 'retailer-bookstore' ), $retailer_bookstore_i ),
			'description'     => sprintf( esc_html__( 'Kindly :- Select a Post based on the category selected in the upper settings', 'retailer-bookstore' ), $retailer_bookstore_i ),
			'section'         => 'retailer_bookstore_banner_section',
			'settings'        => 'retailer_bookstore_banner_slider_content_post_' . $retailer_bookstore_i,
			'active_callback' => 'retailer_bookstore_is_banner_slider_section_and_content_type_post_enabled',
			'type'            => 'select',
			'choices'         => retailer_bookstore_get_post_choices(),
		)
	);

	// Banner Section - Select Banner Page.
	$wp_customize->add_setting(
		'retailer_bookstore_banner_slider_content_page_' . $retailer_bookstore_i,
		array(
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'retailer_bookstore_banner_slider_content_page_' . $retailer_bookstore_i,
		array(
			/* translators: %d: Page Count. */
			'label'           => sprintf( esc_html__( 'Select Page %d', 'retailer-bookstore' ), $retailer_bookstore_i ),
			'section'         => 'retailer_bookstore_banner_section',
			'settings'        => 'retailer_bookstore_banner_slider_content_page_' . $retailer_bookstore_i,
			'active_callback' => 'retailer_bookstore_is_banner_slider_section_and_content_type_page_enabled',
			'type'            => 'select',
			'choices'         => retailer_bookstore_get_page_choices(),
		)
	);

	// Banner Section - Button Label.
	$wp_customize->add_setting(
		'retailer_bookstore_banner_button_label_' . $retailer_bookstore_i,
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'retailer_bookstore_banner_button_label_' . $retailer_bookstore_i,
		array(
			/* translators: %d: Button Label Count. */
			'label'           => sprintf( esc_html__( 'Button Label %d', 'retailer-bookstore' ), $retailer_bookstore_i ),
			'section'         => 'retailer_bookstore_banner_section',
			'settings'        => 'retailer_bookstore_banner_button_label_' . $retailer_bookstore_i,
			'type'            => 'text',
			'active_callback' => 'retailer_bookstore_is_banner_slider_section_enabled',
		)
	);

	// Banner Section - Button Link.
	$wp_customize->add_setting(
		'retailer_bookstore_banner_button_link_' . $retailer_bookstore_i,
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control(
		'retailer_bookstore_banner_button_link_' . $retailer_bookstore_i,
		array(
			/* translators: %d: Button Link Count. */
			'label'           => sprintf( esc_html__( 'Button Link %d', 'retailer-bookstore' ), $retailer_bookstore_i ),
			'section'         => 'retailer_bookstore_banner_section',
			'settings'        => 'retailer_bookstore_banner_button_link_' . $retailer_bookstore_i,
			'type'            => 'url',
			'active_callback' => 'retailer_bookstore_is_banner_slider_section_enabled',
		)
	);
}