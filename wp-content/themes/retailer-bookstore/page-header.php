<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! retailer_bookstore_has_page_header() ) {
    return;
}

$retailer_bookstore_classes = array( 'page-header' );
$retailer_bookstore_style = retailer_bookstore_page_header_style();

if ( $retailer_bookstore_style ) {
    $retailer_bookstore_classes[] = $retailer_bookstore_style . '-page-header';
}

$retailer_bookstore_visibility = get_theme_mod( 'retailer_bookstore_page_header_visibility', 'all-devices' );

if ( 'hide-all-devices' === $retailer_bookstore_visibility ) {
    // Don't show the header at all
    return;
}

if ( 'hide-tablet' === $retailer_bookstore_visibility ) {
    $retailer_bookstore_classes[] = 'hide-on-tablet';
} elseif ( 'hide-mobile' === $retailer_bookstore_visibility ) {
    $retailer_bookstore_classes[] = 'hide-on-mobile';
} elseif ( 'hide-tablet-mobile' === $retailer_bookstore_visibility ) {
    $retailer_bookstore_classes[] = 'hide-on-tablet-mobile';
}

$retailer_bookstore_PAGE_TITLE_background_color = get_theme_mod('retailer_bookstore_page_title_background_color_setting', '');

// Get the toggle switch value
$retailer_bookstore_background_image_enabled = get_theme_mod('retailer_bookstore_page_header_style', true);

// Add background image to the header if enabled
$retailer_bookstore_background_image = get_theme_mod( 'retailer_bookstore_page_header_background_image', '' );
$retailer_bookstore_background_height = get_theme_mod( 'retailer_bookstore_page_header_image_height', '200' );
$retailer_bookstore_inline_style = '';

if ( $retailer_bookstore_background_image_enabled && ! empty( $retailer_bookstore_background_image ) ) {
    $retailer_bookstore_inline_style .= 'background-image: url(' . esc_url( $retailer_bookstore_background_image ) . '); ';
    $retailer_bookstore_inline_style .= 'height: ' . esc_attr( $retailer_bookstore_background_height ) . 'px; ';
    $retailer_bookstore_inline_style .= 'background-size: cover; ';
    $retailer_bookstore_inline_style .= 'background-position: center center; ';

    // Add the unique class if the background image is set
    $retailer_bookstore_classes[] = 'has-background-image';
}

$retailer_bookstore_classes = implode( ' ', $retailer_bookstore_classes );
$retailer_bookstore_heading = get_theme_mod( 'retailer_bookstore_page_header_heading_tag', 'h1' );
$retailer_bookstore_heading = apply_filters( 'retailer_bookstore_page_header_heading', $retailer_bookstore_heading );

?>

<?php do_action( 'retailer_bookstore_before_page_header' ); ?>

<header class="<?php echo esc_attr( $retailer_bookstore_classes ); ?>" style="<?php echo esc_attr( $retailer_bookstore_inline_style ); ?> background-color: <?php echo esc_attr($retailer_bookstore_PAGE_TITLE_background_color); ?>;">

    <?php do_action( 'retailer_bookstore_before_page_header_inner' ); ?>

    <div class="asterthemes-wrapper page-header-inner">

        <?php if ( retailer_bookstore_has_page_header() ) : ?>

            <<?php echo esc_attr( $retailer_bookstore_heading ); ?> class="page-header-title">
                <?php echo wp_kses_post( retailer_bookstore_get_page_title() ); ?>
            </<?php echo esc_attr( $retailer_bookstore_heading ); ?>>

        <?php endif; ?>

        <?php if ( function_exists( 'retailer_bookstore_breadcrumb' ) ) : ?>
            <?php retailer_bookstore_breadcrumb(); ?>
        <?php endif; ?>

    </div><!-- .page-header-inner -->

    <?php do_action( 'retailer_bookstore_after_page_header_inner' ); ?>

</header><!-- .page-header -->

<?php do_action( 'retailer_bookstore_after_page_header' ); ?>