<?php

/**
 * Active Callbacks
 *
 * @package retailer_bookstore
 */

// Theme Options.
function retailer_bookstore_is_pagination_enabled( $retailer_bookstore_control ) {
	return ( $retailer_bookstore_control->manager->get_setting( 'retailer_bookstore_enable_pagination' )->value() );
}
function retailer_bookstore_is_breadcrumb_enabled( $retailer_bookstore_control ) {
	return ( $retailer_bookstore_control->manager->get_setting( 'retailer_bookstore_enable_breadcrumb' )->value() );
}
function retailer_bookstore_is_layout_enabled( $retailer_bookstore_control ) {
	return ( $retailer_bookstore_control->manager->get_setting( 'retailer_bookstore_website_layout' )->value() );
}
function retailer_bookstore_is_pagetitle_bcakground_image_enabled( $retailer_bookstore_control ) {
	return ( $retailer_bookstore_control->manager->get_setting( 'retailer_bookstore_page_header_style' )->value() );
}
function retailer_bookstore_is_preloader_style( $retailer_bookstore_control ) {
	return ( $retailer_bookstore_control->manager->get_setting( 'retailer_bookstore_enable_preloader' )->value() );
}

// Header Options.
function retailer_bookstore_is_topbar_enabled( $retailer_bookstore_control ) {
	return ( $retailer_bookstore_control->manager->get_Setting( 'retailer_bookstore_enable_topbar' )->value() );
}

// Banner Slider Section.
function retailer_bookstore_is_banner_slider_section_enabled( $retailer_bookstore_control ) {
	return ( $retailer_bookstore_control->manager->get_setting( 'retailer_bookstore_enable_banner_section' )->value() );
}
function retailer_bookstore_is_banner_slider_section_and_content_type_post_enabled( $retailer_bookstore_control ) {
	$content_type = $retailer_bookstore_control->manager->get_setting( 'retailer_bookstore_banner_slider_content_type' )->value();
	return ( retailer_bookstore_is_banner_slider_section_enabled( $retailer_bookstore_control ) && ( 'post' === $content_type ) );
}
function retailer_bookstore_is_banner_slider_section_and_content_type_page_enabled( $retailer_bookstore_control ) {
	$content_type = $retailer_bookstore_control->manager->get_setting( 'retailer_bookstore_banner_slider_content_type' )->value();
	return ( retailer_bookstore_is_banner_slider_section_enabled( $retailer_bookstore_control ) && ( 'page' === $content_type ) );
}

//Offer Section.
function retailer_bookstore_is_service_section_enabled( $retailer_bookstore_control ) {
	return ( $retailer_bookstore_control->manager->get_setting( 'retailer_bookstore_enable_service_section' )->value() );
}
function retailer_bookstore_is_service_section_and_content_type_post_enabled( $retailer_bookstore_control ) {
	$content_type = $retailer_bookstore_control->manager->get_setting( 'retailer_bookstore_service_content_type' )->value();
	return ( retailer_bookstore_is_service_section_enabled( $retailer_bookstore_control ) && ( 'post' === $content_type ) );
}
function retailer_bookstore_is_service_section_and_content_type_page_enabled( $retailer_bookstore_control ) {
	$content_type = $retailer_bookstore_control->manager->get_setting( 'retailer_bookstore_service_content_type' )->value();
	return ( retailer_bookstore_is_service_section_enabled( $retailer_bookstore_control ) && ( 'page' === $content_type ) );
}