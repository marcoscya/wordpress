<?php

/**
 * Render homepage sections.
 */
function retailer_bookstore_homepage_sections() {
	$homepage_sections = array_keys( retailer_bookstore_get_homepage_sections() );

	foreach ( $homepage_sections as $retailer_bookstore_section ) {
		require get_template_directory() . '/sections/' . $retailer_bookstore_section . '.php';
	}
}