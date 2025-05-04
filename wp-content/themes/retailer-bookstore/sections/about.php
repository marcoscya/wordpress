<?php

if ( ! get_theme_mod( 'retailer_bookstore_enable_service_section', false ) ) {
  return;
}

$retailer_bookstore_args = '';

retailer_bookstore_render_service_section( $retailer_bookstore_args );

/**
 * Render Offer Section.
 */
function retailer_bookstore_render_service_section( $retailer_bookstore_args ) { ?>
    <section id="retailer_bookstore_trending_section" class="asterthemes-frontpage-section trending-section trending-style-1">
    <?php
    if ( is_customize_preview() ) :
      retailer_bookstore_section_link( 'retailer_bookstore_service_section' );
    endif;

    $retailer_bookstore_about_text = get_theme_mod( 'retailer_bookstore_about_text', 'Dec 31 2025');
    $retailer_bookstore_timmer_text = get_theme_mod( 'retailer_bookstore_timmer_text', 'Hurry Up!');
    $retailer_bookstore_timmer_heading = get_theme_mod( 'retailer_bookstore_timmer_heading', 'Time Left');
    $retailer_bookstore_about_1_button_link = get_theme_mod( 'retailer_bookstore_about_1_button_link', '#');
    $retailer_bookstore_about_2_button_link = get_theme_mod( 'retailer_bookstore_about_2_button_link', '#');
    $retailer_bookstore_about_1_button_text = get_theme_mod( 'retailer_bookstore_about_1_button_text', 'Deal of the Day');
    $retailer_bookstore_about_2_button_text = get_theme_mod( 'retailer_bookstore_about_2_button_text', 'Deal of the Day');
    $retailer_bookstore_about_left_image_1 = get_theme_mod( 'retailer_bookstore_about_left_image_1');
    $retailer_bookstore_about_left_image_2 = get_theme_mod( 'retailer_bookstore_about_left_image_2');
    ?>
    <div class="asterthemes-wrapper">
      <div class="about-us">
        <?php if ( ! empty( $retailer_bookstore_about_left_image_1 ) || ! empty( $retailer_bookstore_about_left_image_2 ) ) { ?>
          <div class="about-left-box">
            <div class="about-img-box-1">
                <div class="about-img-2">
                    <div class="service-img">
                        <?php if ( ! empty( $retailer_bookstore_about_left_image_1 ) ) { ?>
                            <img src="<?php echo esc_url( $retailer_bookstore_about_left_image_1 ); ?>" alt="<?php the_title_attribute(); ?>">
                        <?php } else { ?>
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/resource/img/about1.png' ); ?>" alt="<?php the_title_attribute(); ?>">
                        <?php } ?>
                        
                        <?php if ( ! empty( $retailer_bookstore_about_1_button_link ) ) { ?>
                            <div class="about-btn">
                                <a href="<?php echo esc_url( $retailer_bookstore_about_1_button_link ); ?>" class="asterthemes-button">
                                    <?php echo esc_html( $retailer_bookstore_about_1_button_text ); ?>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="about-img-3">
                    <div class="service-img">
                        <?php if ( ! empty( $retailer_bookstore_about_left_image_2 ) ) { ?>
                            <img src="<?php echo esc_url( $retailer_bookstore_about_left_image_2 ); ?>" alt="<?php the_title_attribute(); ?>">
                        <?php } else { ?>
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/resource/img/about2.png' ); ?>" alt="<?php the_title_attribute(); ?>">
                        <?php } ?>

                        <?php if ( ! empty( $retailer_bookstore_about_2_button_link ) ) { ?>
                            <div class="about-btn">
                                <a href="<?php echo esc_url( $retailer_bookstore_about_2_button_link ); ?>" class="asterthemes-button">
                                    <?php echo esc_html( $retailer_bookstore_about_2_button_text ); ?>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php if ( ! empty( $retailer_bookstore_about_text ) || ! empty( $retailer_bookstore_timmer_heading ) || ! empty( $retailer_bookstore_timmer_text ) ) { ?>
        <div class="about-right-box">
          <div class="header-contact-inner">
            <?php if ( ! empty( $retailer_bookstore_timmer_heading ) ) { ?>
              <h4><?php echo esc_html( $retailer_bookstore_timmer_heading ); ?></h4>
            <?php } ?>
            <p id="timer" class="timmercount">
              <input type="hidden" class="timmer" value="<?php echo esc_attr( $retailer_bookstore_about_text ); ?>">
            </p>
            <?php if ( ! empty( $retailer_bookstore_timmer_text ) ) { ?>
              <h4><?php echo esc_html( $retailer_bookstore_timmer_text ); ?></h4>
            <?php } ?>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </section>
  <?php
}