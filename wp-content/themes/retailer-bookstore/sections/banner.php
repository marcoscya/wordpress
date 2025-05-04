<?php

$retailer_bookstore_sldier_section = get_theme_mod( 'retailer_bookstore_enable_banner_section', false);

if ( ! $retailer_bookstore_sldier_section ) {
	return;
}

$retailer_bookstore_slider_content_ids  = array();
$retailer_bookstore_slider_content_type = get_theme_mod( 'retailer_bookstore_banner_slider_content_type', 'post' );

for ( $i = 1; $i <= 3; $i++ ) {
	$retailer_bookstore_slider_content_ids[] = get_theme_mod( 'retailer_bookstore_banner_slider_content_' . $retailer_bookstore_slider_content_type . '_' . $i );
}

// Get the category for the banner slider from theme mods or a default category
$retailer_bookstore_banner_slider_category = get_theme_mod('retailer_bookstore_banner_slider_category', 'slider');

// Modify query to fetch posts from a specific category
$retailer_bookstore_banner_slider_args = array(
	'post_type'           => $retailer_bookstore_slider_content_type,
	'post__in'            => array_filter( $retailer_bookstore_slider_content_ids ),
	'orderby'             => 'post__in',
	'posts_per_page'      => absint(3),
	'ignore_sticky_posts' => true,
);

// Apply category filter only if content type is 'post'
if ( 'post' === $retailer_bookstore_slider_content_type && ! empty( $retailer_bookstore_banner_slider_category ) ) {
	$retailer_bookstore_banner_slider_args['category_name'] = $retailer_bookstore_banner_slider_category;
}

$retailer_bookstore_banner_slider_args = apply_filters( 'retailer_bookstore_banner_section_args', $retailer_bookstore_banner_slider_args );

retailer_bookstore_render_banner_section( $retailer_bookstore_banner_slider_args );

/**
 * Render Banner Section.
 */
function retailer_bookstore_render_banner_section( $retailer_bookstore_banner_slider_args ) {     ?>

	<section id="retailer_bookstore_banner_section" class="banner-section banner-style-1">
		<?php
		if ( is_customize_preview() ) :
			retailer_bookstore_section_link( 'retailer_bookstore_banner_section' );
		endif;
		?>
		<div class="banner-section-wrapper">
			<?php
			$query = new WP_Query( $retailer_bookstore_banner_slider_args );
			if ( $query->have_posts() ) :
				?>
				<div class="asterthemes-banner-wrapper banner-slider retailer-bookstore-carousel-navigation" data-slick='{"autoplay": false }'>
					<?php 
					$i = 1;
					while ( $query->have_posts() ) :
						$query->the_post();
						$retailer_bookstore_button_label = get_theme_mod( 'retailer_bookstore_banner_button_label_' . $i);
						$retailer_bookstore_button_link  = get_theme_mod( 'retailer_bookstore_banner_button_link_' . $i);
						$retailer_bookstore_button_link  = ! empty( $retailer_bookstore_button_link ) ? $retailer_bookstore_button_link : get_the_permalink();
						?>
						<div class="banner-single-outer">
							<div class="banner-single">
								<div class="banner-img">
									<?php the_post_thumbnail( 'full' ); ?>
								</div>
								<div class="banner-caption">
									<div class="asterthemes-wrapper">
										<div class="banner-catption-wrapper">
											<h1 class="banner-caption-title">
												<a href="<?php the_permalink(); ?>">
							                        <?php the_title(); ?>
							                    </a>
											</h1>
											<div class="mag-post-excerpt">
												<?php the_excerpt(); ?>
											</div>
											<?php if ( ! empty( $retailer_bookstore_button_label ) ) { ?>
												<div class="banner-slider-btn">
													<a href="<?php echo esc_url( $retailer_bookstore_button_link ); ?>" class="asterthemes-button"><?php echo esc_html( $retailer_bookstore_button_label ); ?></a>
												</div>
											<?php } ?>
											<div class="socail-search">
				                                <div class="social-icons">
				                                    <?php
				                                    if ( has_nav_menu( 'social' ) ) {
				                                        wp_nav_menu(
				                                            array(
				                                                'menu_class'     => 'menu social-links',
				                                                'link_before'    => '<span class="screen-reader-text">',
				                                                'link_after'     => '</span>',
				                                                'theme_location' => 'social',
				                                            )
				                                        );
				                                    }
				                                    ?>
				                                </div>
				                            </div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php
						$i++;
					endwhile;
					wp_reset_postdata();
					?>
				</div>
				<?php
			endif;
			?>
		</div>
	</section>

	<?php
}