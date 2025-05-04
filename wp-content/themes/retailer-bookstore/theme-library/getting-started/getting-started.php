<?php
/**
 * Getting Started Page.
 *
 * @package retailer_bookstore
 */


if( ! function_exists( 'retailer_bookstore_getting_started_menu' ) ) :
/**
 * Adding Getting Started Page in admin menu
 */
function retailer_bookstore_getting_started_menu(){	
	add_theme_page(
		__( 'Getting Started', 'retailer-bookstore' ),
		__( 'Getting Started', 'retailer-bookstore' ),
		'manage_options',
		'retailer-bookstore-getting-started',
		'retailer_bookstore_getting_started_page'
	);
}
endif;
add_action( 'admin_menu', 'retailer_bookstore_getting_started_menu' );

if( ! function_exists( 'retailer_bookstore_getting_started_admin_scripts' ) ) :
/**
 * Load Getting Started styles in the admin
 */
function retailer_bookstore_getting_started_admin_scripts( $hook ){
	// Load styles only on our page
	if( 'appearance_page_retailer-bookstore-getting-started' != $hook ) return;

    wp_enqueue_style( 'retailer-bookstore-getting-started', get_template_directory_uri() . '/resource/css/getting-started.css', false, retailer_bookstore_THEME_VERSION );

    wp_enqueue_script( 'retailer-bookstore-getting-started', get_template_directory_uri() . '/resource/js/getting-started.js', array( 'jquery' ), retailer_bookstore_THEME_VERSION, true );
}
endif;
add_action( 'admin_enqueue_scripts', 'retailer_bookstore_getting_started_admin_scripts' );

if( ! function_exists( 'retailer_bookstore_getting_started_page' ) ) :
/**
 * Callback function for admin page.
*/
function retailer_bookstore_getting_started_page(){ 
	$retailer_bookstore_theme = wp_get_theme();?>
	<div class="wrap getting-started">
		<div class="intro-wrap">
			<div class="intro cointaner">
				<div class="intro-content">
					<h3><?php echo esc_html( 'Welcome to', 'retailer-bookstore' );?> <span class="theme-name"><?php echo esc_html( retailer_bookstore_THEME_NAME ); ?></span></h3>
					<p class="about-text">
						<?php
						// Remove last sentence of description.
						$retailer_bookstore_description = explode( '. ', $retailer_bookstore_theme->get( 'Description' ) );

						$retailer_bookstore_description = implode( '. ', $retailer_bookstore_description );

						echo esc_html( $retailer_bookstore_description . '' );
					?></p>
					<div class="btns-getstart">
						<a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>"target="_blank" class="button button-primary"><?php esc_html_e( 'Customize', 'retailer-bookstore' ); ?></a>
						<a class="button button-primary" href="<?php echo esc_url( 'https://wordpress.org/support/theme/retailer-bookstore/reviews/#new-post' ); ?>" title="<?php esc_attr_e( 'Visit the Review', 'retailer-bookstore' ); ?>" target="_blank">
							<?php esc_html_e( 'Review', 'retailer-bookstore' ); ?>
						</a>
						<a class="button button-primary" href="<?php echo esc_url( 'https://wordpress.org/support/theme/retailer-bookstore' ); ?>" title="<?php esc_attr_e( 'Visit the Support', 'retailer-bookstore' ); ?>" target="_blank">
							<?php esc_html_e( 'Contact Support', 'retailer-bookstore' ); ?>
						</a>
					</div>
					<div class="btns-wizard">
						<a class="wizard" href="<?php echo esc_url( admin_url( 'themes.php?page=retailerbookstore-wizard' ) ); ?>"target="_blank" class="button button-primary"><?php esc_html_e( 'One Click Demo Setup', 'retailer-bookstore' ); ?></a>
					</div>
				</div>
				<div class="intro-img">
					<img src="<?php echo esc_url(get_template_directory_uri()) .'/screenshot.png'; ?>" />
				</div>
				
			</div>
		</div>

		<div class="cointaner panels">
			<ul class="inline-list">
				<li class="current">
                    <a id="help" href="javascript:void(0);">
                        <?php esc_html_e( 'Getting Started', 'retailer-bookstore' ); ?>
                    </a>
                </li>
				<li>
                    <a id="free-pro-panel" href="javascript:void(0);">
                        <?php esc_html_e( 'Free Vs Pro', 'retailer-bookstore' ); ?>
                    </a>
                </li>
			</ul>
			<div id="panel" class="panel">
				<?php require get_template_directory() . '/theme-library/getting-started/tabs/help-panel.php'; ?>
				<?php require get_template_directory() . '/theme-library/getting-started/tabs/free-vs-pro-panel.php'; ?>
				<?php require get_template_directory() . '/theme-library/getting-started/tabs/link-panel.php'; ?>
			</div>
		</div>
	</div>
	<?php
}
endif;