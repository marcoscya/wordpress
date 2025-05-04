<?php
/**
 * Retailer Bookstore functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package retailer_bookstore
 */

$retailer_bookstore_theme_data = wp_get_theme();
if( ! defined( 'retailer_bookstore_THEME_VERSION' ) ) define ( 'retailer_bookstore_THEME_VERSION', $retailer_bookstore_theme_data->get( 'Version' ) );
if( ! defined( 'retailer_bookstore_THEME_NAME' ) ) define( 'retailer_bookstore_THEME_NAME', $retailer_bookstore_theme_data->get( 'Name' ) );
if( ! defined( 'retailer_bookstore_THEME_TEXTDOMAIN' ) ) define( 'retailer_bookstore_THEME_TEXTDOMAIN', $retailer_bookstore_theme_data->get( 'TextDomain' ) );

if ( ! defined( 'retailer_bookstore_VERSION' ) ) {
	define( 'retailer_bookstore_VERSION', '1.0.0' );
}

if ( ! function_exists( 'retailer_bookstore_setup' ) ) :
	
	function retailer_bookstore_setup() {
		
		load_theme_textdomain( 'retailer-bookstore', get_template_directory() . '/languages' );

		add_theme_support( 'woocommerce' );

		add_theme_support( 'automatic-feed-links' );
		
		add_theme_support( 'title-tag' );

		add_theme_support( 'post-thumbnails' );

		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary', 'retailer-bookstore' ),
				'social'  => esc_html__( 'Social', 'retailer-bookstore' ),
			)
		);

		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
				'woocommerce',
			)
		);

		add_theme_support( 'post-formats', array(
			'image',
			'video',
			'gallery',
			'audio', 
		) );

		add_theme_support(
			'custom-background',
			apply_filters(
				'retailer_bookstore_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		add_theme_support( 'customize-selective-refresh-widgets' );

		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		add_theme_support( 'align-wide' );

		add_theme_support( 'responsive-embeds' );
	}
endif;
add_action( 'after_setup_theme', 'retailer_bookstore_setup' );

function retailer_bookstore_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'retailer_bookstore_content_width', 640 );
}
add_action( 'after_setup_theme', 'retailer_bookstore_content_width', 0 );

function retailer_bookstore_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'retailer-bookstore' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'retailer-bookstore' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title"><span>',
			'after_title'   => '</span></h2>',
		)
	);

	// Regsiter 4 footer widgets.
	// Regsiter 4 footer widgets.
	$retailer_bookstore_footer_widget_column = get_theme_mod('retailer_bookstore_footer_widget_column','4');
	for ($i=1; $i<=$retailer_bookstore_footer_widget_column; $i++) {
		register_sidebar( array(
			'name' => __( 'Footer  ', 'retailer-bookstore' )  . $i,
			'id' => 'retailer-bookstore-footer-widget-' . $i,
			'description' => __( 'The Footer Widget Area', 'retailer-bookstore' )  . $i,
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<div class="widget-header"><h4 class="widget-title">',
			'after_title' => '</h4></div>',
		) );
	}
}
add_action( 'widgets_init', 'retailer_bookstore_widgets_init' );

function retailer_bookstore_custom_css() {
    $retailer_bookstore_slider_section = get_theme_mod('retailer_bookstore_enable_banner_section', false);
    if (!$retailer_bookstore_slider_section) {
        echo '<style>
            header.site-header {
                position: relative !important;
                background: var(--primary-gradient);
            }
            .home .main-navigation a:focus, .home .main-navigation a:hover{
            	color: #000000;
            }
        </style>';
    }
}
add_action('wp_head', 'retailer_bookstore_custom_css');

/**
 * Enqueue scripts and styles.
 */
function retailer_bookstore_scripts() {
	// Append .min if SCRIPT_DEBUG is false.
	$min = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	// Slick style.
	wp_enqueue_style( 'slick-style', get_template_directory_uri() . '/resource/css/slick' . $min . '.css', array(), '1.8.1' );

	// Fontawesome style.
	wp_enqueue_style( 'fontawesome-style', get_template_directory_uri() . '/resource/css/fontawesome' . $min . '.css', array(), '5.15.4' );

	// Main style.
	wp_enqueue_style( 'retailer-bookstore-style', get_template_directory_uri() . '/style.css', array(), retailer_bookstore_VERSION );

	// RTL style.
	wp_style_add_data('retailer-bookstore-style', 'rtl', 'replace');

	// Navigation script.
	wp_enqueue_script( 'navigation-script', get_template_directory_uri() . '/resource/js/navigation' . $min . '.js', array(), retailer_bookstore_VERSION, true );

	// Slick script.
	wp_enqueue_script( 'slick-script', get_template_directory_uri() . '/resource/js/slick' . $min . '.js', array( 'jquery' ), '1.8.1', true );

	// Custom script.
	wp_enqueue_script( 'retailer-bookstore-custom-script', get_template_directory_uri() . '/resource/js/custom.js', array( 'jquery' ), retailer_bookstore_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Include the file.
	require_once get_theme_file_path( 'theme-library/function-files/wptt-webfont-loader.php' );

	// Load the webfont.
	wp_enqueue_style(
		'oswald',
		wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap' ),
		array(),
		'1.0'
	);

	wp_enqueue_style(
		'luckiest-guy',
		wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=Luckiest+Guy&display=swap' ),
		array(),
		'1.0'
	);

	wp_enqueue_style(
		'jost',
		wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap' ),
		array(),
		'1.0'
	);

	wp_enqueue_style(
		'lilita-one',
		wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=Lilita+One&display=swap' ),
		array(),
		'1.0'
	);

}
add_action( 'wp_enqueue_scripts', 'retailer_bookstore_scripts' );

//Change number of products per page 
add_filter( 'loop_shop_per_page', 'retailer_bookstore_products_per_page' );
function retailer_bookstore_products_per_page( $cols ) {
  	return  get_theme_mod( 'retailer_bookstore_products_per_page',9);
}

// Change number or products per row 
add_filter('loop_shop_columns', 'retailer_bookstore_loop_columns');
	if (!function_exists('retailer_bookstore_loop_columns')) {
	function retailer_bookstore_loop_columns() {
		return get_theme_mod( 'retailer_bookstore_products_per_row', 3 );
	}
}

/**
 * Include wptt webfont loader.
 */
require_once get_theme_file_path( 'theme-library/function-files/wptt-webfont-loader.php' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/theme-library/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/theme-library/function-files/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/theme-library/function-files/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/theme-library/customizer.php';

/**
 * Breadcrumb
 */
require get_template_directory() . '/theme-library/function-files/class-breadcrumb-trail.php';

/**
 * Google Fonts
 */
require get_template_directory() . '/theme-library/function-files/google-fonts.php';

/**
 * Dynamic CSS
 */
require get_template_directory() . '/theme-library/dynamic-css.php';

/**
 * Customizer Settings Functions
*/
require get_template_directory() . '/theme-library/function-files/customizer-settings-functions.php';

/**
 * Getting Started
*/
require get_template_directory() . '/theme-library/getting-started/getting-started.php';

/**
 * Theme Wizard
*/
require get_parent_theme_file_path( '/theme-wizard/config.php' );

// Featured Image Dimension
function retailer_bookstore_blog_post_featured_image_dimension(){
	if(get_theme_mod('retailer_bookstore_blog_post_featured_image_dimension') == 'custom' ) {
		return true;
	}
	return false;
}

add_filter( 'woocommerce_enable_setup_wizard', '__return_false' );