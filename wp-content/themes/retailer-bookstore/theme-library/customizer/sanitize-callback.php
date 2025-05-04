<?php

function retailer_bookstore_sanitize_select( $retailer_bookstore_input, $retailer_bookstore_setting ) {
	$retailer_bookstore_input = sanitize_key( $retailer_bookstore_input );
	$retailer_bookstore_choices = $retailer_bookstore_setting->manager->get_control( $retailer_bookstore_setting->id )->choices;
	return ( array_key_exists( $retailer_bookstore_input, $retailer_bookstore_choices ) ? $retailer_bookstore_input : $retailer_bookstore_setting->default );
}

function retailer_bookstore_sanitize_switch( $retailer_bookstore_input ) {
	if ( true === $retailer_bookstore_input ) {
		return true;
	} else {
		return false;
	}
}

function retailer_bookstore_sanitize_google_fonts( $retailer_bookstore_input, $retailer_bookstore_setting ) {
	$retailer_bookstore_choices = $retailer_bookstore_setting->manager->get_control( $retailer_bookstore_setting->id )->choices;
	return ( array_key_exists( $retailer_bookstore_input, $retailer_bookstore_choices ) ? $retailer_bookstore_input : $retailer_bookstore_setting->default );
}

/**
 * Sanitize URL input.
 *
 * @param string $retailer_bookstore_input URL input to sanitize.
 * @return string Sanitized URL.
 */
function retailer_bookstore_sanitize_url( $retailer_bookstore_input ) {
    return esc_url_raw( $retailer_bookstore_input );
}

// Sanitize Scroll Top Position
function retailer_bookstore_sanitize_scroll_top_position( $retailer_bookstore_input ) {
    $valid_positions = array( 'bottom-right', 'bottom-left', 'bottom-center' );
    if ( in_array( $retailer_bookstore_input, $valid_positions ) ) {
        return $retailer_bookstore_input;
    } else {
        return 'bottom-right'; // Default to bottom-right if invalid value
    }
}

function retailer_bookstore_sanitize_image( $retailer_bookstore_image, $retailer_bookstore_setting ) {
	/*
	* Array of valid image file types.
	*
	* The array includes image mime types that are included in wp_get_mime_types()
	*/
	$retailer_bookstore_mimes = array(
		'jpg|jpeg|jpe' => 'image/jpeg',
		'gif'          => 'image/gif',
		'png'          => 'image/png',
		'bmp'          => 'image/bmp',
		'tif|tiff'     => 'image/tiff',
		'ico'          => 'image/x-icon',
		'svg'          => 'image/svg+xml',
	);
	// Return an array with file extension and mime_type.
	$file = wp_check_filetype( $retailer_bookstore_image, $retailer_bookstore_mimes );
	// If $retailer_bookstore_image has a valid mime_type, return it; otherwise, return the default.
	return ( $file['ext'] ? $retailer_bookstore_image : $retailer_bookstore_setting->default );
}

function retailer_bookstore_sanitize_choices( $retailer_bookstore_input, $retailer_bookstore_setting ) {
    global $wp_customize; 
    $control = $wp_customize->get_control( $retailer_bookstore_setting->id ); 
    if ( array_key_exists( $retailer_bookstore_input, $control->choices ) ) {
        return $retailer_bookstore_input;
    } else {
        return $retailer_bookstore_setting->default;
    }
}

function retailer_bookstore_sanitize_range_value( $retailer_bookstore_number, $retailer_bookstore_setting ) {

	// Ensure input is an absolute integer.
	$retailer_bookstore_number = absint( $retailer_bookstore_number );

	// Get the input attributes associated with the setting.
	$retailer_bookstore_atts = $retailer_bookstore_setting->manager->get_control( $retailer_bookstore_setting->id )->input_attrs;

	// Get minimum number in the range.
	$retailer_bookstore_min = ( isset( $retailer_bookstore_atts['min'] ) ? $retailer_bookstore_atts['min'] : $retailer_bookstore_number );

	// Get maximum number in the range.
	$retailer_bookstore_max = ( isset( $retailer_bookstore_atts['max'] ) ? $retailer_bookstore_atts['max'] : $retailer_bookstore_number );

	// Get step.
	$retailer_bookstore_step = ( isset( $retailer_bookstore_atts['step'] ) ? $retailer_bookstore_atts['step'] : 1 );

	// If the number is within the valid range, return it; otherwise, return the default.
	return ( $retailer_bookstore_min <= $retailer_bookstore_number && $retailer_bookstore_number <= $retailer_bookstore_max && is_int( $retailer_bookstore_number / $retailer_bookstore_step ) ? $retailer_bookstore_number : $retailer_bookstore_setting->default );
}

function retailer_bookstore_sanitize_color_or_gradient( $retailer_bookstore_value ) {
    if ( preg_match( '/^#[a-f0-9]{6}$/i', $retailer_bookstore_value ) || preg_match( '/^linear-gradient\((.+)\)$/i', $retailer_bookstore_value ) ) {
        return $retailer_bookstore_value;
    }
    return '';
}