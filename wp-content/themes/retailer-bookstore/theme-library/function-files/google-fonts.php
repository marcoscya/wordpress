<?php
function retailer_bookstore_get_all_google_fonts() {
    $retailer_bookstore_webfonts_json = get_template_directory() . '/theme-library/google-webfonts.json';
    if ( ! file_exists( $retailer_bookstore_webfonts_json ) ) {
        return array();
    }

    $retailer_bookstore_fonts_json_data = file_get_contents( $retailer_bookstore_webfonts_json );
    if ( false === $retailer_bookstore_fonts_json_data ) {
        return array();
    }

    $retailer_bookstore_all_fonts = json_decode( $retailer_bookstore_fonts_json_data, true );
    if ( json_last_error() !== JSON_ERROR_NONE ) {
        return array();
    }

    $retailer_bookstore_google_fonts = array();
    foreach ( $retailer_bookstore_all_fonts as $retailer_bookstore_font ) {
        $retailer_bookstore_google_fonts[ $retailer_bookstore_font['family'] ] = array(
            'family'   => $retailer_bookstore_font['family'],
            'variants' => $retailer_bookstore_font['variants'],
        );
    }
    return $retailer_bookstore_google_fonts;
}


function retailer_bookstore_get_all_google_font_families() {
    $retailer_bookstore_google_fonts  = retailer_bookstore_get_all_google_fonts();
    $retailer_bookstore_font_families = array();
    foreach ( $retailer_bookstore_google_fonts as $retailer_bookstore_font ) {
        $retailer_bookstore_font_families[ $retailer_bookstore_font['family'] ] = $retailer_bookstore_font['family'];
    }
    return $retailer_bookstore_font_families;
}

function retailer_bookstore_get_fonts_url() {
    $retailer_bookstore_fonts_url = '';
    $retailer_bookstore_fonts     = array();

    $retailer_bookstore_all_fonts = retailer_bookstore_get_all_google_fonts();

    if ( ! empty( get_theme_mod( 'retailer_bookstore_site_title_font', 'Raleway' ) ) ) {
        $retailer_bookstore_fonts[] = get_theme_mod( 'retailer_bookstore_site_title_font', 'Raleway' );
    }

    if ( ! empty( get_theme_mod( 'retailer_bookstore_site_description_font', 'Raleway' ) ) ) {
        $retailer_bookstore_fonts[] = get_theme_mod( 'retailer_bookstore_site_description_font', 'Raleway' );
    }

    if ( ! empty( get_theme_mod( 'retailer_bookstore_header_font', 'Lilita One' ) ) ) {
        $retailer_bookstore_fonts[] = get_theme_mod( 'retailer_bookstore_header_font', 'Lilita One' );
    }

    if ( ! empty( get_theme_mod( 'retailer_bookstore_content_font', 'Oswald' ) ) ) {
        $retailer_bookstore_fonts[] = get_theme_mod( 'retailer_bookstore_content_font', 'Oswald' );
    }

    $retailer_bookstore_fonts = array_unique( $retailer_bookstore_fonts );

    foreach ( $retailer_bookstore_fonts as $retailer_bookstore_font ) {
        $retailer_bookstore_variants      = $retailer_bookstore_all_fonts[ $retailer_bookstore_font ]['variants'];
        $retailer_bookstore_font_family[] = $retailer_bookstore_font . ':' . implode( ',', $retailer_bookstore_variants );
    }

    $retailer_bookstore_query_args = array(
        'family' => urlencode( implode( '|', $retailer_bookstore_font_family ) ),
    );

    if ( ! empty( $retailer_bookstore_font_family ) ) {
        $retailer_bookstore_fonts_url = add_query_arg( $retailer_bookstore_query_args, 'https://fonts.googleapis.com/css' );
    }

    return $retailer_bookstore_fonts_url;
}

