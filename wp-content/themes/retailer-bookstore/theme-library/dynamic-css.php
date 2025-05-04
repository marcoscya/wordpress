<?php

/**
 * Dynamic CSS
 */
function retailer_bookstore_dynamic_css() {
	$retailer_bookstore_primary_color = get_theme_mod( 'primary_color', '#E6BB0A' );

	$retailer_bookstore_site_title_font       = get_theme_mod( 'retailer_bookstore_site_title_font', 'Raleway' );
	$retailer_bookstore_site_description_font = get_theme_mod( 'retailer_bookstore_site_description_font', 'Raleway' );
	$retailer_bookstore_header_font           = get_theme_mod( 'retailer_bookstore_header_font', 'Lilita One' );
	$retailer_bookstore_content_font             = get_theme_mod( 'retailer_bookstore_content_font', 'Oswald' );

	// Enqueue Google Fonts
	$retailer_bookstore_fonts_url = retailer_bookstore_get_fonts_url();
	if ( ! empty( $retailer_bookstore_fonts_url ) ) {
		wp_enqueue_style( 'retailer-bookstore-google-fonts', esc_url( $retailer_bookstore_fonts_url ), array(), null );
	}

	$retailer_bookstore_custom_css  = '';
	$retailer_bookstore_custom_css .= '
    /* Color */
    :root {
        --primary-color: ' . esc_attr( $retailer_bookstore_primary_color ) . ';
        --header-text-color: ' . esc_attr( '#' . get_header_textcolor() ) . ';
    }
    ';

	$retailer_bookstore_custom_css .= '
    /* Typography */
    :root {
        --font-heading: "' . esc_attr( $retailer_bookstore_header_font ) . '", serif;
        --font-main: -apple-system, BlinkMacSystemFont, "' . esc_attr( $retailer_bookstore_content_font ) . '", "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
    }

    body,
	button, input, select, optgroup, textarea, p {
        font-family: "' . esc_attr( $retailer_bookstore_content_font ) . '", serif;
	}

	.site-identity p.site-title, h1.site-title a, h1.site-title, p.site-title a, .site-branding h1.site-title a {
        font-family: "' . esc_attr( $retailer_bookstore_site_title_font ) . '", serif;
	}
    
	p.site-description {
        font-family: "' . esc_attr( $retailer_bookstore_site_description_font ) . '", serif !important;
	}
    ';

	wp_add_inline_style( 'retailer-bookstore-style', $retailer_bookstore_custom_css );
}
add_action( 'wp_enqueue_scripts', 'retailer_bookstore_dynamic_css', 99 );