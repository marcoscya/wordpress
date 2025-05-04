<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package retailer_bookstore
 */

function retailer_bookstore_customize_css() {
    $primary_color_or_gradient = get_theme_mod( 'primary_color_or_gradient', 'linear-gradient(90.09deg, #E6BB0A 0%, #FA382B 99.23%)' );
    ?>
    <style type="text/css">
        :root {
            --primary-color: <?php echo esc_html( $primary_color_or_gradient ); ?>;
        }
    </style>
    <?php
}
add_action( 'wp_head', 'retailer_bookstore_customize_css' );

function add_custom_script_in_footer() {
    if ( get_theme_mod( 'retailer_bookstore_enable_sticky_header', false ) ) {
        ?>
        <script>
            jQuery(document).ready(function($) {
                $(window).on('scroll', function() {
                    var scroll = $(window).scrollTop();
                    if (scroll > 0) {
                        $('.navigation-part.hello').addClass('is-sticky');
                    } else {
                        $('.navigation-part.hello').removeClass('is-sticky');
                    }
                });
            });
        </script>
        <?php
    }
}
add_action( 'wp_footer', 'add_custom_script_in_footer' );


function retailer_bookstore_enqueue_selected_fonts() {
    $retailer_bookstore_fonts_url = retailer_bookstore_get_fonts_url();
    if (!empty($retailer_bookstore_fonts_url)) {
        wp_enqueue_style('retailer-bookstore-google-fonts', $retailer_bookstore_fonts_url, array(), null);
    }
}
add_action('wp_enqueue_scripts', 'retailer_bookstore_enqueue_selected_fonts');

function retailer_bookstore_layout_customizer_css() {
    $retailer_bookstore_margin = get_theme_mod('retailer_bookstore_layout_width_margin', 50);
    ?>
    <style type="text/css">
        body.site-boxed--layout #page  {
            margin: 0 <?php echo esc_attr($retailer_bookstore_margin); ?>px;
        }
    </style>
    <?php
}
add_action('wp_head', 'retailer_bookstore_layout_customizer_css');

function retailer_bookstore_blog_layout_customizer_css() {
    // Retrieve the blog layout option
    $retailer_bookstore_blog_layout_option = get_theme_mod('retailer_bookstore_blog_layout_option_setting', 'Left');

    // Initialize custom CSS variable
    $retailer_bookstore_custom_css = '';

    // Generate custom CSS based on the layout option
    if ($retailer_bookstore_blog_layout_option === 'Default') {
        $retailer_bookstore_custom_css .= '.mag-post-detail { text-align: center; }';
    } elseif ($retailer_bookstore_blog_layout_option === 'Left') {
        $retailer_bookstore_custom_css .= '.mag-post-detail { text-align: left; }';
    } elseif ($retailer_bookstore_blog_layout_option === 'Right') {
        $retailer_bookstore_custom_css .= '.mag-post-detail { text-align: right; }';
    }

    // Output the combined CSS
    ?>
    <style type="text/css">
        <?php echo wp_kses($retailer_bookstore_custom_css, array( 'style' => array(), 'text-align' => array() )); ?>
    </style>
    <?php
}
add_action('wp_head', 'retailer_bookstore_blog_layout_customizer_css');

function retailer_bookstore_sidebar_width_customizer_css() {
    $retailer_bookstore_sidebar_width = get_theme_mod('retailer_bookstore_sidebar_width', '30');
    ?>
    <style type="text/css">
        .right-sidebar .asterthemes-wrapper .asterthemes-page {
            grid-template-columns: auto <?php echo esc_attr($retailer_bookstore_sidebar_width); ?>%;
        }
        .left-sidebar .asterthemes-wrapper .asterthemes-page {
            grid-template-columns: <?php echo esc_attr($retailer_bookstore_sidebar_width); ?>% auto;
        }
    </style>
    <?php
}
add_action('wp_head', 'retailer_bookstore_sidebar_width_customizer_css');

if ( ! function_exists( 'retailer_bookstore_get_page_title' ) ) {
    function retailer_bookstore_get_page_title() {
        $retailer_bookstore_title = '';

        if (is_404()) {
            $retailer_bookstore_title = esc_html__('Page Not Found', 'retailer-bookstore');
        } elseif (is_search()) {
            $retailer_bookstore_title = esc_html__('Search Results for: ', 'retailer-bookstore') . esc_html(get_search_query());
        } elseif (is_home() && !is_front_page()) {
            $retailer_bookstore_title = esc_html__('Blogs', 'retailer-bookstore');
        } elseif (function_exists('is_shop') && is_shop()) {
            $retailer_bookstore_title = esc_html__('Shop', 'retailer-bookstore');
        } elseif (is_page()) {
            $retailer_bookstore_title = get_the_title();
        } elseif (is_single()) {
            $retailer_bookstore_title = get_the_title();
        } elseif (is_archive()) {
            $retailer_bookstore_title = get_the_archive_title();
        } else {
            $retailer_bookstore_title = get_the_archive_title();
        }

        return apply_filters('retailer_bookstore_page_title', $retailer_bookstore_title);
    }
}

if ( ! function_exists( 'retailer_bookstore_has_page_header' ) ) {
    function retailer_bookstore_has_page_header() {
        // Default to true (display header)
        $retailer_bookstore_return = true;

        // Custom conditions for disabling the header
        if ('hide-all-devices' === get_theme_mod('retailer_bookstore_page_header_visibility', 'all-devices')) {
            $retailer_bookstore_return = false;
        }

        // Apply filters and return
        return apply_filters('retailer_bookstore_display_page_header', $retailer_bookstore_return);
    }
}

if ( ! function_exists( 'retailer_bookstore_page_header_style' ) ) {
    function retailer_bookstore_page_header_style() {
        $retailer_bookstore_style = get_theme_mod('retailer_bookstore_page_header_style', 'default');
        return apply_filters('retailer_bookstore_page_header_style', $retailer_bookstore_style);
    }
}

function retailer_bookstore_page_title_customizer_css() {
    $retailer_bookstore_layout_option = get_theme_mod('retailer_bookstore_page_header_layout', 'left');
    ?>
    <style type="text/css">
        .asterthemes-wrapper.page-header-inner {
            <?php if ($retailer_bookstore_layout_option === 'flex') : ?>
                display: flex;
                justify-content: space-between;
                align-items: center;
            <?php else : ?>
                text-align: <?php echo esc_attr($retailer_bookstore_layout_option); ?>;
            <?php endif; ?>
        }
    </style>
    <?php
}
add_action('wp_head', 'retailer_bookstore_page_title_customizer_css');

function retailer_bookstore_pagetitle_height_css() {
    $retailer_bookstore_height = get_theme_mod('retailer_bookstore_pagetitle_height', 50);
    ?>
    <style type="text/css">
        header.page-header {
            padding: <?php echo esc_attr($retailer_bookstore_height); ?>px 0;
        }
    </style>
    <?php
}
add_action('wp_head', 'retailer_bookstore_pagetitle_height_css');

function retailer_bookstore_customize_scss() {
    // Retrieve the two colors from the customizer settings.
    $retailer_bookstore_color1 = get_theme_mod('retailer_bookstore_gradient_color1', '#E6BB0A'); // Default start color
    $retailer_bookstore_color2 = get_theme_mod('retailer_bookstore_gradient_color2', '#FA382B'); // Default end color

    // Generate the gradient.
    $retailer_bookstore_gradient = "linear-gradient(94.02deg, $retailer_bookstore_color1 0.92%, $retailer_bookstore_color2 100%)";
    ?>
    <style type="text/css">
        :root {
            --primary-color: <?php echo esc_html($retailer_bookstore_color1); ?>; /* Fallback color (color1) */
            --primary-gradient: <?php echo esc_html($retailer_bookstore_gradient); ?>; /* Dynamically generated gradient */
        }
    </style>
    <?php
}
add_action('wp_head', 'retailer_bookstore_customize_scss');

function retailer_bookstore_site_logo_width() {
    $retailer_bookstore_site_logo_width = get_theme_mod('retailer_bookstore_site_logo_width', 200);
    ?>
    <style type="text/css">
        .site-logo img {
            max-width: <?php echo esc_attr($retailer_bookstore_site_logo_width); ?>px;
        }
    </style>
    <?php
}
add_action('wp_head', 'retailer_bookstore_site_logo_width');

function retailer_bookstore_menu_font_size_css() {
    $retailer_bookstore_menu_font_size = get_theme_mod('retailer_bookstore_menu_font_size', 14);
    ?>
    <style type="text/css">
        .main-navigation a {
            font-size: <?php echo esc_attr($retailer_bookstore_menu_font_size); ?>px;
        }
    </style>
    <?php
}
add_action('wp_head', 'retailer_bookstore_menu_font_size_css');

function retailer_bookstore_sidebar_widget_font_size_css() {
    $retailer_bookstore_sidebar_widget_font_size = get_theme_mod('retailer_bookstore_sidebar_widget_font_size', 24);
    ?>
    <style type="text/css">
        h2.wp-block-heading,aside#secondary .widgettitle,aside#secondary .widget-title {
            font-size: <?php echo esc_attr($retailer_bookstore_sidebar_widget_font_size); ?>px;
        }
    </style>
    <?php
}
add_action('wp_head', 'retailer_bookstore_sidebar_widget_font_size_css');

// Featured Image Dimension
function retailer_bookstore_custom_featured_image_css() {
    $retailer_bookstore_dimension = get_theme_mod('retailer_bookstore_blog_post_featured_image_dimension', 'default');
    $retailer_bookstore_width = get_theme_mod('retailer_bookstore_blog_post_featured_image_custom_width', '');
    $retailer_bookstore_height = get_theme_mod('retailer_bookstore_blog_post_featured_image_custom_height', '');
    
    if ($retailer_bookstore_dimension === 'custom' && $retailer_bookstore_width && $retailer_bookstore_height) {
        $retailer_bookstore_custom_css = "body:not(.single-post) .mag-post-single .mag-post-img img { width: {$retailer_bookstore_width}px !important; height: {$retailer_bookstore_height}px !important; }";
        wp_add_inline_style('retailer-bookstore-style', $retailer_bookstore_custom_css);
    }
}
add_action('wp_enqueue_scripts', 'retailer_bookstore_custom_featured_image_css');

// Woocommerce Related Products Settings
function retailer_bookstore_related_product_css() {
    $retailer_bookstore_related_product_show_hide = get_theme_mod('retailer_bookstore_related_product_show_hide', true);

    if ( $retailer_bookstore_related_product_show_hide != true) {
        ?>
        <style type="text/css">
            .related.products {
                display: none;
            }
        </style>
        <?php
    }
}
add_action('wp_head', 'retailer_bookstore_related_product_css');

// Woocommerce Product Sale Position 
function retailer_bookstore_product_sale_position_customizer_css() {
    $retailer_bookstore_layout_option = get_theme_mod('retailer_bookstore_product_sale_position', 'left');
    ?>
    <style type="text/css">
        .woocommerce ul.products li.product .onsale {
            <?php if ($retailer_bookstore_layout_option === 'left') : ?>
                right: auto;
                left: 0px;
            <?php else : ?>
                left: auto;
                right: 0px;
            <?php endif; ?>
        }
    </style>
    <?php
}
add_action('wp_head', 'retailer_bookstore_product_sale_position_customizer_css');  

//Copyright Alignment
function retailer_bookstore_footer_copyright_alignment_css() {
    $retailer_bookstore_footer_bottom_align = get_theme_mod( 'retailer_bookstore_footer_bottom_align', 'center' );   
    ?>
    <style type="text/css">
        .site-footer .site-footer-bottom .site-footer-bottom-wrapper {
            justify-content: <?php echo esc_attr( $retailer_bookstore_footer_bottom_align ); ?> 
        }

        /* Mobile Specific */
        @media screen and (max-width: 575px) {
            .site-footer .site-footer-bottom .site-footer-bottom-wrapper {
                justify-content: center;
                text-align:center;
            }
        }
    </style>
    <?php
}
add_action( 'wp_head', 'retailer_bookstore_footer_copyright_alignment_css' );