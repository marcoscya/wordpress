<?php
require get_template_directory() . '/theme-wizard/tgm/class-tgm-plugin-activation.php';
/**
 * Recommended plugins.
 */
function retailer_bookstore_register_recommended_plugins_set() {
	$plugins = array(
		array(
			'name'             => __( 'WooCommerce', 'retailer-bookstore' ),
			'slug'             => 'woocommerce',
			'source'           => '',
			'required'         => false,
			'force_activation' => false,
		),
	);
	$config = array();
	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'retailer_bookstore_register_recommended_plugins_set' );