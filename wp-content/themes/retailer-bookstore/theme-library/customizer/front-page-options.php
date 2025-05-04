<?php

/**
 * Front Page Options
 *
 * @package Retailer Bookstore
 */

$wp_customize->add_panel(
	'retailer_bookstore_front_page_options',
	array(
		'title'    => esc_html__( 'Front Page Options', 'retailer-bookstore' ),
		'priority' => 20,
	)
);

// Banner Section.
require get_template_directory() . '/theme-library/customizer/front-page-options/banner.php';

// Tranding Offer Section.
require get_template_directory() . '/theme-library/customizer/front-page-options/about.php';