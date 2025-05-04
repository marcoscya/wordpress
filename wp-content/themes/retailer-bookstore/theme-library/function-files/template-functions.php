<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package retailer_bookstore
 */

function retailer_bookstore_body_classes( $retailer_bookstore_classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$retailer_bookstore_classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$retailer_bookstore_classes[] = 'no-sidebar';
	}

	$retailer_bookstore_classes[] = retailer_bookstore_sidebar_layout();

	return $retailer_bookstore_classes;
}
add_filter( 'body_class', 'retailer_bookstore_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function retailer_bookstore_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'retailer_bookstore_pingback_header' );


/**
 * Get all posts for customizer Post content type.
 */
function retailer_bookstore_get_post_choices() {
	$retailer_bookstore_choices = array( '' => esc_html__( '--Select--', 'retailer-bookstore' ) );
	$retailer_bookstore_args    = array( 'numberposts' => -1 );
	$retailer_bookstore_posts   = get_posts( $retailer_bookstore_args );

	foreach ( $retailer_bookstore_posts as $retailer_bookstore_post ) {
		$retailer_bookstore_id             = $retailer_bookstore_post->ID;
		$retailer_bookstore_title          = $retailer_bookstore_post->post_title;
		$retailer_bookstore_choices[ $retailer_bookstore_id ] = $retailer_bookstore_title;
	}

	return $retailer_bookstore_choices;
}

/**
 * Get all pages for customizer Page content type.
 */
function retailer_bookstore_get_page_choices() {
	$retailer_bookstore_choices = array( '' => esc_html__( '--Select--', 'retailer-bookstore' ) );
	$retailer_bookstore_pages   = get_pages();

	foreach ( $retailer_bookstore_pages as $retailer_bookstore_page ) {
		$retailer_bookstore_choices[ $retailer_bookstore_page->ID ] = $retailer_bookstore_page->post_title;
	}

	return $retailer_bookstore_choices;
}

/**
 * Get all categories for customizer Category content type.
 */
function retailer_bookstore_get_post_cat_choices() {
	$retailer_bookstore_choices = array( '' => esc_html__( '--Select--', 'retailer-bookstore' ) );
	$retailer_bookstore_cats    = get_categories();

	foreach ( $retailer_bookstore_cats as $retailer_bookstore_cat ) {
		$retailer_bookstore_choices[ $retailer_bookstore_cat->term_id ] = $retailer_bookstore_cat->name;
	}

	return $retailer_bookstore_choices;
}

/**
 * Get all donation forms for customizer form content type.
 */
function retailer_bookstore_get_post_donation_form_choices() {
	$retailer_bookstore_choices = array( '' => esc_html__( '--Select--', 'retailer-bookstore' ) );
	$retailer_bookstore_posts   = get_posts(
		array(
			'post_type'   => 'give_forms',
			'numberposts' => -1,
		)
	);
	foreach ( $retailer_bookstore_posts as $retailer_bookstore_post ) {
		$retailer_bookstore_choices[ $retailer_bookstore_post->ID ] = $retailer_bookstore_post->post_title;
	}
	return $retailer_bookstore_choices;
}

if ( ! function_exists( 'retailer_bookstore_excerpt_length' ) ) :
	/**
	 * Excerpt length.
	 */
	function retailer_bookstore_excerpt_length( $retailer_bookstore_length ) {
		if ( is_admin() ) {
			return $retailer_bookstore_length;
		}

		return get_theme_mod( 'retailer_bookstore_excerpt_length', 20 );
	}
endif;
add_filter( 'excerpt_length', 'retailer_bookstore_excerpt_length', 999 );

if ( ! function_exists( 'retailer_bookstore_excerpt_more' ) ) :
	/**
	 * Excerpt more.
	 */
	function retailer_bookstore_excerpt_more( $retailer_bookstore_more ) {
		if ( is_admin() ) {
			return $retailer_bookstore_more;
		}

		return '&hellip;';
	}
endif;
add_filter( 'excerpt_more', 'retailer_bookstore_excerpt_more' );

if ( ! function_exists( 'retailer_bookstore_sidebar_layout' ) ) {
	/**
	 * Get sidebar layout.
	 */
	function retailer_bookstore_sidebar_layout() {
		$retailer_bookstore_sidebar_position      = get_theme_mod( 'retailer_bookstore_sidebar_position', 'right-sidebar' );
		$retailer_bookstore_sidebar_position_post = get_theme_mod( 'retailer_bookstore_post_sidebar_position', 'right-sidebar' );
		$retailer_bookstore_sidebar_position_page = get_theme_mod( 'retailer_bookstore_page_sidebar_position', 'right-sidebar' );

		if ( is_single() ) {
			$retailer_bookstore_sidebar_position = $retailer_bookstore_sidebar_position_post;
		} elseif ( is_page() ) {
			$retailer_bookstore_sidebar_position = $retailer_bookstore_sidebar_position_page;
		}

		return $retailer_bookstore_sidebar_position;
	}
}

if ( ! function_exists( 'retailer_bookstore_is_sidebar_enabled' ) ) {
	/**
	 * Check if sidebar is enabled.
	 */
	function retailer_bookstore_is_sidebar_enabled() {
		$retailer_bookstore_sidebar_position      = get_theme_mod( 'retailer_bookstore_sidebar_position', 'right-sidebar' );
		$retailer_bookstore_sidebar_position_post = get_theme_mod( 'retailer_bookstore_post_sidebar_position', 'right-sidebar' );
		$retailer_bookstore_sidebar_position_page = get_theme_mod( 'retailer_bookstore_page_sidebar_position', 'right-sidebar' );

		$retailer_bookstore_sidebar_enabled = true;
		if ( is_home() || is_archive() || is_search() ) {
			if ( 'no-sidebar' === $retailer_bookstore_sidebar_position ) {
				$retailer_bookstore_sidebar_enabled = false;
			}
		} elseif ( is_single() ) {
			if ( 'no-sidebar' === $retailer_bookstore_sidebar_position || 'no-sidebar' === $retailer_bookstore_sidebar_position_post ) {
				$retailer_bookstore_sidebar_enabled = false;
			}
		} elseif ( is_page() ) {
			if ( 'no-sidebar' === $retailer_bookstore_sidebar_position || 'no-sidebar' === $retailer_bookstore_sidebar_position_page ) {
				$retailer_bookstore_sidebar_enabled = false;
			}
		}
		return $retailer_bookstore_sidebar_enabled;
	}
}

if ( ! function_exists( 'retailer_bookstore_get_homepage_sections ' ) ) {
	/**
	 * Returns homepage sections.
	 */
	function retailer_bookstore_get_homepage_sections() {
		$retailer_bookstore_sections = array(
			'banner'  => esc_html__( 'Banner Section', 'retailer-bookstore' ),
			'about' => esc_html__( 'Offer Section', 'retailer-bookstore' ),
		);
		return $retailer_bookstore_sections;
	}
}

/**
 * Renders customizer section link
 */
function retailer_bookstore_section_link( $retailer_bookstore_section_id ) {
	$retailer_bookstore_section_name      = str_replace( 'retailer_bookstore_', ' ', $retailer_bookstore_section_id );
	$retailer_bookstore_section_name      = str_replace( '_', ' ', $retailer_bookstore_section_name );
	$retailer_bookstore_starting_notation = '#';
	?>
	<span class="section-link">
		<span class="section-link-title"><?php echo esc_html( $retailer_bookstore_section_name ); ?></span>
	</span>
	<style type="text/css">
		<?php echo $retailer_bookstore_starting_notation . $retailer_bookstore_section_id; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>:hover .section-link {
			visibility: visible;
		}
	</style>
	<?php
}

/**
 * Adds customizer section link css
 */
function retailer_bookstore_section_link_css() {
	if ( is_customize_preview() ) {
		?>
		<style type="text/css">
			.section-link {
				visibility: hidden;
				background-color: black;
				position: relative;
				top: 80px;
				z-index: 99;
				left: 40px;
				color: #fff;
				text-align: center;
				font-size: 20px;
				border-radius: 10px;
				padding: 20px 10px;
				text-transform: capitalize;
			}

			.section-link-title {
				padding: 0 10px;
			}

			.banner-section {
				position: relative;
			}

			.banner-section .section-link {
				position: absolute;
				top: 100px;
			}
		</style>
		<?php
	}
}
add_action( 'wp_head', 'retailer_bookstore_section_link_css' );

/**
 * Breadcrumb.
 */
function retailer_bookstore_breadcrumb( $retailer_bookstore_args = array() ) {
	if ( ! get_theme_mod( 'retailer_bookstore_enable_breadcrumb', true ) ) {
		return;
	}

	$retailer_bookstore_args = array(
		'show_on_front' => false,
		'show_title'    => true,
		'show_browse'   => false,
	);
	breadcrumb_trail( $retailer_bookstore_args );
}
add_action( 'retailer_bookstore_breadcrumb', 'retailer_bookstore_breadcrumb', 10 );

/**
 * Add separator for breadcrumb trail.
 */
function retailer_bookstore_breadcrumb_trail_print_styles() {
	$breadcrumb_separator = get_theme_mod( 'retailer_bookstore_breadcrumb_separator', '/' );

	$retailer_bookstore_style = '
		.trail-items li::after {
			content: "' . $breadcrumb_separator . '";
		}'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	$retailer_bookstore_style = apply_filters( 'retailer_bookstore_breadcrumb_trail_inline_style', trim( str_replace( array( "\r", "\n", "\t", '  ' ), '', $retailer_bookstore_style ) ) );

	if ( $retailer_bookstore_style ) {
		echo "\n" . '<style type="text/css" id="breadcrumb-trail-css">' . $retailer_bookstore_style . '</style>' . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}
add_action( 'wp_head', 'retailer_bookstore_breadcrumb_trail_print_styles' );

/**
 * Pagination for archive.
 */
function retailer_bookstore_render_posts_pagination() {
	$retailer_bookstore_is_pagination_enabled = get_theme_mod( 'retailer_bookstore_enable_pagination', true );
	if ( $retailer_bookstore_is_pagination_enabled ) {
		$retailer_bookstore_pagination_type = get_theme_mod( 'retailer_bookstore_pagination_type', 'default' );
		if ( 'default' === $retailer_bookstore_pagination_type ) :
			the_posts_navigation();
		else :
			the_posts_pagination();
		endif;
	}
}
add_action( 'retailer_bookstore_posts_pagination', 'retailer_bookstore_render_posts_pagination', 10 );

/**
 * Pagination for single post.
 */
function retailer_bookstore_render_post_navigation() {
	the_post_navigation(
		array(
			'prev_text' => '<span>&#10229;</span> <span class="nav-title">%title</span>',
			'next_text' => '<span class="nav-title">%title</span> <span>&#10230;</span>',
		)
	);
}
add_action( 'retailer_bookstore_post_navigation', 'retailer_bookstore_render_post_navigation' );

/**
 * Adds footer copyright text.
 */
function retailer_bookstore_output_footer_copyright_content() {
    $retailer_bookstore_theme_data = wp_get_theme();
    $retailer_bookstore_copyright_text = get_theme_mod('retailer_bookstore_footer_copyright_text');

    if (!empty($retailer_bookstore_copyright_text)) {
        $retailer_bookstore_text = $retailer_bookstore_copyright_text;
    } else {

    	$retailer_bookstore_default_text = '<a href="'. esc_url(__('https://asterthemes.com/products/free-bookstore-wordpress-theme','retailer-bookstore')) . '" target="_blank"> ' . esc_html($retailer_bookstore_theme_data->get('Name')) . '</a>' . '&nbsp;' . esc_html__('by', 'retailer-bookstore') . '&nbsp;<a target="_blank" href="' . esc_url($retailer_bookstore_theme_data->get('AuthorURI')) . '">' . esc_html(ucwords($retailer_bookstore_theme_data->get('Author'))) . '</a>';
		/* translators: %s: WordPress.org URL */
        $retailer_bookstore_default_text .= sprintf(esc_html__(' | Powered by %s', 'retailer-bookstore'), '<a href="' . esc_url(__('https://wordpress.org/', 'retailer-bookstore')) . '" target="_blank">WordPress</a>. ');

        $retailer_bookstore_text = $retailer_bookstore_default_text;
    }
    ?>
    <span><?php echo wp_kses_post($retailer_bookstore_text); ?></span>
    <?php
}
add_action('retailer_bookstore_footer_copyright', 'retailer_bookstore_output_footer_copyright_content');


if ( ! function_exists( 'retailer_bookstore_footer_widget' ) ) :
	function retailer_bookstore_footer_widget() {
		$retailer_bookstore_footer_widget_column = get_theme_mod('retailer_bookstore_footer_widget_column','4');

		$retailer_bookstore_column_class = '';
		if ($retailer_bookstore_footer_widget_column == '1') {
			$retailer_bookstore_column_class = 'one-column';
		} elseif ($retailer_bookstore_footer_widget_column == '2') {
			$retailer_bookstore_column_class = 'two-columns';
		} elseif ($retailer_bookstore_footer_widget_column == '3') {
			$retailer_bookstore_column_class = 'three-columns';
		} else {
			$retailer_bookstore_column_class = 'four-columns';
		}
	
		if($retailer_bookstore_footer_widget_column !== ''): 
		?>
		<div class="dt_footer-widgets <?php echo esc_attr($retailer_bookstore_column_class); ?>">
			<div class="footer-widgets-column">
				<?php
				$footer_widgets_active = false;

				// Loop to check if any footer widget is active
				for ($i = 1; $i <= $retailer_bookstore_footer_widget_column; $i++) {
					if (is_active_sidebar('retailer-bookstore-footer-widget-' . $i)) {
						$footer_widgets_active = true;
						break;
					}
				}

				if ($footer_widgets_active) {
					// Display active footer widgets
					for ($i = 1; $i <= $retailer_bookstore_footer_widget_column; $i++) {
						if (is_active_sidebar('retailer-bookstore-footer-widget-' . $i)) : ?>
							<div class="footer-one-column">
								<?php dynamic_sidebar('retailer-bookstore-footer-widget-' . $i); ?>
							</div>
						<?php endif;
					}
				} else {
				?>
				<div class="footer-one-column default-widgets">
					<aside id="search-2" class="widget widget_search default_footer_search">
						<div class="widget-header">
							<h4 class="widget-title"><?php esc_html_e('Search Here', 'retailer-bookstore'); ?></h4>
						</div>
						<?php get_search_form(); ?>
					</aside>
				</div>
				<div class="footer-one-column default-widgets">
					<aside id="recent-posts-2" class="widget widget_recent_entries">
						<h2 class="widget-title"><?php esc_html_e('Recent Posts', 'retailer-bookstore'); ?></h2>
						<ul>
							<?php
							$recent_posts = wp_get_recent_posts(array(
								'numberposts' => 5,
								'post_status' => 'publish',
							));
							foreach ($recent_posts as $post) {
								echo '<li><a href="' . esc_url(get_permalink($post['ID'])) . '">' . esc_html($post['post_title']) . '</a></li>';
							}
							wp_reset_query();
							?>
						</ul>
					</aside>
				</div>
				<div class="footer-one-column default-widgets">
					<aside id="recent-comments-2" class="widget widget_recent_comments">
						<h2 class="widget-title"><?php esc_html_e('Recent Comments', 'retailer-bookstore'); ?></h2>
						<ul>
							<?php
							$recent_comments = get_comments(array(
								'number' => 5,
								'status' => 'approve',
							));
							foreach ($recent_comments as $comment) {
								echo '<li><a href="' . esc_url(get_comment_link($comment)) . '">' .
									/* translators: %s: details. */
									sprintf(esc_html__('Comment on %s', 'retailer-bookstore'), get_the_title($comment->comment_post_ID)) .
									'</a></li>';
							}
							?>
						</ul>
					</aside>
				</div>
				<div class="footer-one-column default-widgets">
					<aside id="calendar-2" class="widget widget_calendar">
						<h2 class="widget-title"><?php esc_html_e('Calendar', 'retailer-bookstore'); ?></h2>
						<?php get_calendar(); ?>
					</aside>
				</div>
			</div>
			<?php } ?>
		</div>
		<?php
		endif;
	}
	endif;
add_action( 'retailer_bookstore_footer_widget', 'retailer_bookstore_footer_widget' );


function retailer_bookstore_footer_text_transform_css() {
    $retailer_bookstore_footer_text_transform = get_theme_mod('footer_text_transform', 'none');
    ?>
    <style type="text/css">
        .site-footer h4,footer#colophon h2.wp-block-heading,footer#colophon .widgettitle,footer#colophon .widget-title {
            text-transform: <?php echo esc_html($retailer_bookstore_footer_text_transform); ?>;
        }
    </style>
    <?php
}
add_action('wp_head', 'retailer_bookstore_footer_text_transform_css');

/**
 * GET START FUNCTION
 */

function retailer_bookstore_getpage_css($hook) {
	wp_enqueue_script( 'retailer-bookstore-admin-script', get_template_directory_uri() . '/resource/js/retailer-bookstore-admin-notice-script.js', array( 'jquery' ) );
    wp_localize_script( 'retailer-bookstore-admin-script', 'retailer_bookstore_ajax_object',
        array( 'ajax_url' => admin_url( 'admin-ajax.php' ) )
    );
    wp_enqueue_style( 'retailer-bookstore-notice-style', get_template_directory_uri() . '/resource/css/notice.css' );
}

add_action( 'admin_enqueue_scripts', 'retailer_bookstore_getpage_css' );


add_action('wp_ajax_retailer_bookstore_dismissable_notice', 'retailer_bookstore_dismissable_notice');
function retailer_bookstore_switch_theme() {
    delete_user_meta(get_current_user_id(), 'retailer_bookstore_dismissable_notice');
}
add_action('after_switch_theme', 'retailer_bookstore_switch_theme');
function retailer_bookstore_dismissable_notice() {
    update_user_meta(get_current_user_id(), 'retailer_bookstore_dismissable_notice', true);
    die();
}

function retailer_bookstore_deprecated_hook_admin_notice() {
    global $pagenow;
    
    // Check if the current page is the one where you don't want the notice to appear
    if ( $pagenow === 'themes.php' && isset( $_GET['page'] ) && $_GET['page'] === 'retailer-bookstore-getting-started' ) {
        return;
    }

    $dismissed = get_user_meta( get_current_user_id(), 'retailer_bookstore_dismissable_notice', true );
    if ( !$dismissed) { ?>
        <div class="getstrat updated notice notice-success is-dismissible notice-get-started-class">
            <div class="at-admin-content" >
                <h2><?php esc_html_e('Welcome to Cleaning Services Agent', 'retailer-bookstore'); ?></h2>
                <p><?php _e('Explore the features of our Pro Theme and take your Dental journey to the next level.', 'retailer-bookstore'); ?></p>
                <p ><?php _e('Get Started With Theme By Clicking On Getting Started.', 'retailer-bookstore'); ?><p>
                <div style="display: flex; justify-content: center;">
                    <a class="admin-notice-btn button button-primary button-hero" href="<?php echo esc_url( admin_url( 'themes.php?page=retailer-bookstore-getting-started' )); ?>"><?php esc_html_e( 'Get started', 'retailer-bookstore' ) ?></a>
                    <a  class="admin-notice-btn button button-primary button-hero" target="_blank" href="https://demo.asterthemes.com/retailer-bookstore/"><?php esc_html_e('View Demo', 'retailer-bookstore') ?></a>
                    <a  class="admin-notice-btn button button-primary button-hero" target="_blank" href="https://asterthemes.com/products/book-shop-wordpress-theme"><?php esc_html_e('Buy Now', 'retailer-bookstore') ?></a>
                    <a  class="admin-notice-btn button button-primary button-hero" target="_blank" href="https://demo.asterthemes.com/docs/retailer-bookstore-free/"><?php esc_html_e('Free Doc', 'retailer-bookstore') ?></a>
                </div>
            </div>
            <div class="at-admin-image">
                <img style="width: 100%;max-width: 320px;line-height: 40px;display: inline-block;vertical-align: top;border: 2px solid #ddd;border-radius: 4px;" src="<?php echo esc_url(get_stylesheet_directory_uri()) .'/screenshot.png'; ?>" />
            </div>
        </div>
    <?php }
}

add_action( 'admin_notices', 'retailer_bookstore_deprecated_hook_admin_notice' );


//Admin Notice For Getstart
function retailer_bookstore_ajax_notice_handler() {
    if ( isset( $_POST['type'] ) ) {
        $type = sanitize_text_field( wp_unslash( $_POST['type'] ) );
        update_option( 'dismissed-' . $type, TRUE );
    }
}