<?php

/**
 * Theme Options
 *
 * @package retailer_bookstore
 */

$wp_customize->add_panel(
	'retailer_bookstore_theme_options',
	array(
		'title'    => esc_html__( 'Theme Options', 'retailer-bookstore' ),
		'priority' => 10,
	)
);

// Theme Options.
require get_template_directory() . '/theme-library/customizer/theme-options/theme-options.php';

// typography-setting.
require get_template_directory() . '/theme-library/customizer/theme-options/typography-setting.php';

// Page Title.
require get_template_directory() . '/theme-library/customizer/theme-options/page-title.php';

// Excerpt.
require get_template_directory() . '/theme-library/customizer/theme-options/excerpt.php';

// Sidebar Position.
require get_template_directory() . '/theme-library/customizer/theme-options/sidebar-position.php';

// Post Options.
require get_template_directory() . '/theme-library/customizer/theme-options/post-options.php';

// Single Post Options.
require get_template_directory() . '/theme-library/customizer/theme-options/single-post-options.php';

// Footer Options.
require get_template_directory() . '/theme-library/customizer/theme-options/footer-options.php';

// 404 page option.
require get_template_directory() . '/theme-library/customizer/theme-options/404page-customize-setting.php';

// WooCommerce setting.
require get_template_directory() . '/theme-library/customizer/theme-options/woocommerce-setting.php';