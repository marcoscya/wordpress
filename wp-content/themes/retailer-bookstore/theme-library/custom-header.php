<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package retailer_bookstore
 */

function retailer_bookstore_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'retailer_bookstore_custom_header_args', array(
		'default-text-color'     => 'fff',
		'header-text' 			 =>	false,
		'width'                  => 1360,
		'height'                 => 110,
		'flex-width'         	=> true,
        'flex-height'        	=> true,
		'wp-head-callback'       => 'retailer_bookstore_header_style',
	) ) );
}

add_action( 'after_setup_theme', 'retailer_bookstore_custom_header_setup' );

if ( ! function_exists( 'retailer_bookstore_header_style' ) ) :

add_action( 'wp_enqueue_scripts', 'retailer_bookstore_header_style' );
function retailer_bookstore_header_style() {
	if ( get_header_image() ) :
	$retailer_bookstore_custom_css = "
        header.site-header .header-main-wrapper .bottom-header-outer-wrapper .bottom-header-part{
			background-image:url('".esc_url(get_header_image())."') !important;
			background-size: 100% 100%;
			background-position: center top;
		}";
	   	wp_add_inline_style( 'retailer-bookstore-style', $retailer_bookstore_custom_css );
	endif;
}
endif;