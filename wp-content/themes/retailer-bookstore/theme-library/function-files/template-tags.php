<?php

/**
 * Custom template tags for this theme
 *
 * @package retailer_bookstore
 */

if ( ! function_exists( 'retailer_bookstore_posted_on_single' ) ) :
    /**
     * Prints HTML with meta information for the current post-date/time on single posts.
     */
    function retailer_bookstore_posted_on_single() {
        if ( get_theme_mod( 'retailer_bookstore_single_post_hide_date', true ) ) {
                $retailer_bookstore_time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
            if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
                $retailer_bookstore_time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
            }

            $retailer_bookstore_time_string = sprintf(
                $retailer_bookstore_time_string,
                esc_attr( get_the_date( DATE_W3C ) ),
                esc_html( get_the_date() ),
                esc_attr( get_the_modified_date( DATE_W3C ) ),
                esc_html( get_the_modified_date() )
            );

            $retailer_bookstore_posted_on = '<span class="post-date"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark"><i class="far fa-clock"></i>' . $retailer_bookstore_time_string . '</a></span>';

            echo $retailer_bookstore_posted_on; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            return;
        }
    }
endif;

if ( ! function_exists( 'retailer_bookstore_posted_on' ) ) :
    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function retailer_bookstore_posted_on() {
        if ( get_theme_mod( 'retailer_bookstore_post_hide_date', true ) ) {
            $retailer_bookstore_time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
            if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
                $retailer_bookstore_time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
            }
    
            $retailer_bookstore_time_string = sprintf(
                $retailer_bookstore_time_string,
                esc_attr( get_the_date( DATE_W3C ) ),
                esc_html( get_the_date() ),
                esc_attr( get_the_modified_date( DATE_W3C ) ),
                esc_html( get_the_modified_date() )
            );
    
            $retailer_bookstore_posted_on = '<span class="post-date"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark"><i class="far fa-clock"></i>' . $retailer_bookstore_time_string . '</a></span>';
    
            echo $retailer_bookstore_posted_on; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            return;
        }
    }
endif;


if ( ! function_exists( 'retailer_bookstore_posted_by_single' ) ) :
    /**
     * Prints HTML with meta information for the current author on single posts.
     */
    function retailer_bookstore_posted_by_single() {
        if ( get_theme_mod( 'retailer_bookstore_single_post_hide_author', true ) ) {
            $retailer_bookstore_byline = '<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '"><i class="fas fa-user"></i>' . esc_html( get_the_author() ) . '</a>';

            echo '<span class="post-author"> ' . $retailer_bookstore_byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            return;
        }
    }
endif;

if ( ! function_exists( 'retailer_bookstore_posted_by' ) ) :
    /**
     * Prints HTML with meta information for the current author.
     */
    function retailer_bookstore_posted_by() {
        if ( get_theme_mod( 'retailer_bookstore_post_hide_author', true ) ) {
            $retailer_bookstore_byline = '<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '"><i class="fas fa-user"></i>' . esc_html( get_the_author() ) . '</a>';

            echo '<span class="post-author"> ' . $retailer_bookstore_byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            return;
        }
    }
endif;

if ( ! function_exists( 'retailer_bookstore_posted_comments_single' ) ) :
    /**
     * Prints HTML with meta information for the current comment count on single posts.
     */
    function retailer_bookstore_posted_comments_single() {
        if ( get_theme_mod( 'retailer_bookstore_single_post_hide_comments', true ) ) {
            $retailer_bookstore_comment_count = get_comments_number();
            $retailer_bookstore_comment_text  = sprintf(
                /* translators: %s: comment count */
                _n( '%s Comment', '%s Comments', $retailer_bookstore_comment_count, 'retailer-bookstore' ),
                number_format_i18n( $retailer_bookstore_comment_count )
            );

            echo '<span class="post-comments"><i class="fas fa-comments"></i> ' . esc_html( $retailer_bookstore_comment_text ) . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            return;
        }
    }
endif;

if ( ! function_exists( 'retailer_bookstore_posted_comments' ) ) :
    /**
     * Prints HTML with meta information for the current comment count.
     */
    function retailer_bookstore_posted_comments() {
        if ( get_theme_mod( 'retailer_bookstore_post_hide_comments', true ) ) {
            $retailer_bookstore_comment_count = get_comments_number();
            $retailer_bookstore_comment_text  = sprintf(
                /* translators: %s: comment count */
                _n( '%s Comment', '%s Comments', $retailer_bookstore_comment_count, 'retailer-bookstore' ),
                number_format_i18n( $retailer_bookstore_comment_count )
            );

            echo '<span class="post-comments"><i class="fas fa-comments"></i> ' . esc_html( $retailer_bookstore_comment_text ) . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            return;
        }
    }
endif;

if ( ! function_exists( 'retailer_bookstore_posted_time_single' ) ) :
    /**
     * Prints HTML with meta information for the current post time on single posts.
     */
    function retailer_bookstore_posted_time_single() {
        if ( get_theme_mod( 'retailer_bookstore_single_post_hide_time', true ) ) {
            $retailer_bookstore_posted_on = sprintf(
                /* translators: %s: post time */
                esc_html__( 'Posted at %s', 'retailer-bookstore' ),
                '<a href="' . esc_url( get_permalink() ) . '"><time datetime="' . esc_attr( get_the_time( 'c' ) ) . '">' . esc_html( get_the_time() ) . '</time></a>'
            );

            echo '<span class="post-time"><i class="fas fa-clock"></i> ' . $retailer_bookstore_posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            return;
        }
    }
endif;

if ( ! function_exists( 'retailer_bookstore_posted_time' ) ) :
    /**
     * Prints HTML with meta information for the current post time.
     */
    function retailer_bookstore_posted_time() {
        if ( get_theme_mod( 'retailer_bookstore_post_hide_time', true ) ) {
            $retailer_bookstore_posted_on = sprintf(
                /* translators: %s: post time */
                esc_html__( 'Posted at %s', 'retailer-bookstore' ),
                '<a href="' . esc_url( get_permalink() ) . '"><time datetime="' . esc_attr( get_the_time( 'c' ) ) . '">' . esc_html( get_the_time() ) . '</time></a>'
            );

            echo '<span class="post-time"><i class="fas fa-clock"></i> ' . $retailer_bookstore_posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            return;
        }
    }
endif;

if ( ! function_exists( 'retailer_bookstore_categories_single_list' ) ) :
    function retailer_bookstore_categories_single_list( $retailer_bookstore_with_background = false ) {
        if ( is_singular( 'post' ) ) {
            $retailer_bookstore_hide_category = get_theme_mod( 'retailer_bookstore_single_post_hide_category', true );

            if ( $retailer_bookstore_hide_category ) {
                $retailer_bookstore_categories = get_the_category();
                $retailer_bookstore_separator  = '';
                $retailer_bookstore_output     = '';
                if ( ! empty( $retailer_bookstore_categories ) ) {
                    foreach ( $retailer_bookstore_categories as $retailer_bookstore_category ) {
                        $retailer_bookstore_output .= '<a href="' . esc_url( get_category_link( $retailer_bookstore_category->term_id ) ) . '">' . esc_html( $retailer_bookstore_category->name ) . '</a>' . $retailer_bookstore_separator;
                    }
                    echo trim( $retailer_bookstore_output, $retailer_bookstore_separator );
                }
            }
        }
    }
endif;

if ( ! function_exists( 'retailer_bookstore_categories_list' ) ) :
    function retailer_bookstore_categories_list( $retailer_bookstore_with_background = false ) {
        $retailer_bookstore_hide_category = get_theme_mod( 'retailer_bookstore_post_hide_category', true );

        if ( $retailer_bookstore_hide_category ) {
            $retailer_bookstore_categories = get_the_category();
            $retailer_bookstore_separator  = '';
            $retailer_bookstore_output     = '';
            if ( ! empty( $retailer_bookstore_categories ) ) {
                foreach ( $retailer_bookstore_categories as $retailer_bookstore_category ) {
                    $retailer_bookstore_output .= '<a href="' . esc_url( get_category_link( $retailer_bookstore_category->term_id ) ) . '">' . esc_html( $retailer_bookstore_category->name ) . '</a>' . $retailer_bookstore_separator;
                }
                echo trim( $retailer_bookstore_output, $retailer_bookstore_separator );
            }
        }
    }
endif;

if ( ! function_exists( 'retailer_bookstore_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the tags and comments.
	 */
	function retailer_bookstore_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() && is_singular() ) {
			$retailer_bookstore_hide_tag = get_theme_mod( 'retailer_bookstore_post_hide_tags', true );

			if ( $retailer_bookstore_hide_tag ) {
				/* translators: used between list items, there is a space after the comma */
				$retailer_bookstore_tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'retailer-bookstore' ) );
				if ( $retailer_bookstore_tags_list ) {
					/* translators: 1: list of tags. */
					printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'retailer-bookstore' ) . '</span>', $retailer_bookstore_tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
			}
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'retailer-bookstore' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'retailer_bookstore_post_thumbnail' ) ) :
    /**
     * Display the post thumbnail.
     */
    function retailer_bookstore_post_thumbnail() {
        // Return early if the post is password protected, an attachment, or does not have a post thumbnail.
        if ( post_password_required() || is_attachment() ) {
            return;
        }

        // Display post thumbnail for singular views.
        if ( is_singular() ) :
            // Check theme setting to hide the featured image in single posts.
            if ( get_theme_mod( 'retailer_bookstore_single_post_hide_feature_image', false ) ) {
                return;
            }
            ?>
            <div class="post-thumbnail">
                <?php 
                if ( has_post_thumbnail() ) {
                    the_post_thumbnail(); 
                } else {
                    // URL of the default image
                    $retailer_bookstore_default_image_url = get_template_directory_uri() . '/resource/img/default.png';
                    echo '<img src="' . esc_url( $retailer_bookstore_default_image_url ) . '" alt="' . esc_attr( get_the_title() ) . '">';
                }
                ?>
            </div><!-- .post-thumbnail -->
        <?php else :
            // Check theme setting to hide the featured image in non-singular posts.
            if ( ! get_theme_mod( 'retailer_bookstore_post_hide_feature_image', true ) ) {
                return;
            }
            ?>
            <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
                <?php
                if ( has_post_thumbnail() ) {
                    the_post_thumbnail(
                        'post-thumbnail',
                        array(
                            'alt' => the_title_attribute(
                                array(
                                    'echo' => false,
                                )
                            ),
                        )
                    );
                } else {
                    // URL of the default image
                    $retailer_bookstore_default_image_url = get_template_directory_uri() . '/resource/img/default.png';
                    echo '<img src="' . esc_url( $retailer_bookstore_default_image_url ) . '" alt="' . esc_attr( get_the_title() ) . '">';
                }
                ?>
            </a>
        <?php endif; // End is_singular().
    }
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;