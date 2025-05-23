<?php
/**
 * The template part for displaying post
 *
 * @package Shoes Store 
 * @subpackage shoes-store
 * @since shoes-store 1.0
 */
?>

<?php 
  $shoes_store_archive_year  = esc_html(get_the_time('Y')); 
  $shoes_store_archive_month = esc_html(get_the_time('m')); 
  $shoes_store_archive_day   = esc_html(get_the_time('d')); 
?>

<div id="post-<?php the_ID(); ?>" <?php post_class('inner-service'); ?>>
  <div class="post-main-box p-3 mb-3 wow zoomInUp delay-1000" data-wow-duration="2s">
    <?php $shoes_store_theme_lay = get_theme_mod( 'shoes_store_blog_layout_option','Left');
    if($shoes_store_theme_lay == 'Default'){ ?>
      <div class="row">
        <?php if(has_post_thumbnail() && get_theme_mod( 'shoes_store_featured_image_hide_show',true) == 1) {?>
          <div class="box-image col-lg-6 col-md-6 align-self-center">
            <?php the_post_thumbnail(); ?>
          </div>
        <?php } ?>
        <article class="new-text <?php if(has_post_thumbnail() && get_theme_mod( 'shoes_store_featured_image_hide_show',true) == 1) { ?>col-lg-6 col-md-6 align-self-center" <?php } else { ?>col-lg-12 col-md-12" <?php } ?>>
          <h2 class="section-title mt-0 pt-0"><a href="<?php the_permalink(); ?>"><?php the_title();?><span class="screen-reader-text"><?php the_title(); ?></span></a></h2>
          <?php if( get_theme_mod( 'shoes_store_toggle_postdate',true) == 1 || get_theme_mod( 'shoes_store_toggle_author',true) == 1 || get_theme_mod( 'shoes_store_toggle_comments',true) == 1 || get_theme_mod( 'shoes_store_toggle_time',true) == 1) { ?>
            <div class="post-info p-2 my-3">
              <?php if(get_theme_mod('shoes_store_toggle_postdate',true)==1){ ?>
                <i class="fas fa-calendar-alt me-2"></i><span class="entry-date"><a href="<?php echo esc_url( get_day_link( $shoes_store_archive_year, $shoes_store_archive_month, $shoes_store_archive_day)); ?>"><?php echo esc_html( get_the_date() ); ?><span class="screen-reader-text"><?php echo esc_html( get_the_date() ); ?></span></a></span>
              <?php } ?>

              <?php if(get_theme_mod('shoes_store_toggle_author',true)==1){ ?>
                <span><?php echo esc_html(get_theme_mod('shoes_store_meta_field_separator', '|'));?></span> <i class="fas fa-user me-2"></i><span class="entry-author"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>"><?php the_author(); ?><span class="screen-reader-text"><?php the_author(); ?></span></a></span>
              <?php } ?>

              <?php if(get_theme_mod('shoes_store_toggle_comments',true)==1){ ?>
                <span><?php echo esc_html(get_theme_mod('shoes_store_meta_field_separator', '|'));?></span> <i class="fa fa-comments me-2" aria-hidden="true"></i><span class="entry-comments"><?php comments_number( __('0 Comment', 'shoes-store'), __('0 Comments', 'shoes-store'), __('% Comments', 'shoes-store') ); ?></span>
              <?php } ?>

              <?php if(get_theme_mod('shoes_store_toggle_time',true)==1){ ?>
                <span><?php echo esc_html(get_theme_mod('shoes_store_meta_field_separator', '|'));?></span> <i class="fas fa-clock me-2"></i><span class="entry-time"><?php echo esc_html( get_the_time() ); ?></span>
              <?php } ?>
            </div>
          <?php } ?>
          <p class="mb-0">
            <?php $shoes_store_theme_lay = get_theme_mod( 'shoes_store_excerpt_settings','Excerpt');
            if($shoes_store_theme_lay == 'Content'){ ?>
              <?php the_content(); ?>
            <?php }
            if($shoes_store_theme_lay == 'Excerpt'){ ?>
              <?php if(get_the_excerpt()) { ?>
                <?php $shoes_store_excerpt = get_the_excerpt(); echo esc_html( shoes_store_string_limit_words( $shoes_store_excerpt, esc_attr(get_theme_mod('shoes_store_excerpt_number','30')))); ?><?php echo esc_html(get_theme_mod('shoes_store_blog_excerpt_suffix',''));?>
              <?php }?>
            <?php }?>
          </p>
          <?php if( get_theme_mod('shoes_store_button_text','Read More') != ''){ ?>
            <div class="more-btn mt-4 mb-4">
              <a class="p-3" href="<?php the_permalink(); ?>"><?php echo esc_html(get_theme_mod('shoes_store_button_text',__('Read More','shoes-store')));?><span class="screen-reader-text"><?php echo esc_html(get_theme_mod('shoes_store_button_text',__('Read More','shoes-store')));?></span><span class="top-icon"></span></a>
            </div>
          <?php } ?>
        </article>
      </div>
    <?php }else if($shoes_store_theme_lay == 'Center'){ ?>
      <div class="service-text">
        <h2 class="section-title"><a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo the_title_attribute(); ?>"><?php the_title();?><span class="screen-reader-text"><?php the_title(); ?></span></a></h2>
        <?php if( get_theme_mod( 'shoes_store_featured_image_hide_show',true) == 1) { ?>
          <div class="box-image">
            <?php the_post_thumbnail(); ?>
          </div>
        <?php } ?>
        <?php if( get_theme_mod( 'shoes_store_toggle_postdate',true) == 1 || get_theme_mod( 'shoes_store_toggle_author',true) == 1 || get_theme_mod( 'shoes_store_toggle_comments',true) == 1 || get_theme_mod( 'shoes_store_toggle_time',true) == 1) { ?>
            <div class="post-info p-2 my-3">
              <?php if(get_theme_mod('shoes_store_toggle_postdate',true)==1){ ?>
                <i class="fas fa-calendar-alt me-2"></i><span class="entry-date"><a href="<?php echo esc_url( get_day_link( $shoes_store_archive_year, $shoes_store_archive_month, $shoes_store_archive_day)); ?>"><?php echo esc_html( get_the_date() ); ?><span class="screen-reader-text"><?php echo esc_html( get_the_date() ); ?></span></a></span>
              <?php } ?>

              <?php if(get_theme_mod('shoes_store_toggle_author',true)==1){ ?>
                <span><?php echo esc_html(get_theme_mod('shoes_store_meta_field_separator', '|'));?></span> <i class="fas fa-user me-2"></i><span class="entry-author"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>"><?php the_author(); ?><span class="screen-reader-text"><?php the_author(); ?></span></a></span>
              <?php } ?>

              <?php if(get_theme_mod('shoes_store_toggle_comments',true)==1){ ?>
                <span><?php echo esc_html(get_theme_mod('shoes_store_meta_field_separator', '|'));?></span> <i class="fa fa-comments me-2" aria-hidden="true"></i><span class="entry-comments"><?php comments_number( __('0 Comment', 'shoes-store'), __('0 Comments', 'shoes-store'), __('% Comments', 'shoes-store') ); ?></span>
              <?php } ?>

              <?php if(get_theme_mod('shoes_store_toggle_time',true)==1){ ?>
                <span><?php echo esc_html(get_theme_mod('shoes_store_meta_field_separator', '|'));?></span> <i class="fas fa-clock me-2"></i><span class="entry-time"><?php echo esc_html( get_the_time() ); ?></span>
              <?php } ?>
            </div>
          <?php } ?>
        <div class="entry-content">
          <p class="mb-0">
            <?php $shoes_store_theme_lay = get_theme_mod( 'shoes_store_excerpt_settings','Excerpt');
            if($shoes_store_theme_lay == 'Content'){ ?>
              <?php the_content(); ?>
            <?php }
            if($shoes_store_theme_lay == 'Excerpt'){ ?>
              <?php if(get_the_excerpt()) { ?>
                <?php $shoes_store_excerpt = get_the_excerpt(); echo esc_html( shoes_store_string_limit_words( $shoes_store_excerpt, esc_attr(get_theme_mod('shoes_store_excerpt_number','30')))); ?><?php echo esc_html(get_theme_mod('shoes_store_blog_excerpt_suffix',''));?>
              <?php }?>
            <?php }?>
          </p>
        </div>
        <?php if( get_theme_mod('shoes_store_button_text','Read More') != ''){ ?>
          <div class="more-btn mt-4 mb-4">
            <a class="p-3" href="<?php the_permalink(); ?>"><?php echo esc_html(get_theme_mod('shoes_store_button_text',__('Read More','shoes-store')));?><span class="screen-reader-text"><?php echo esc_html(get_theme_mod('shoes_store_button_text',__('Read More','shoes-store')));?></span><span class="top-icon"></span></a>
          </div>
        <?php } ?>
      </div>
    <?php }else if($shoes_store_theme_lay == 'Left'){ ?>
      <div class="service-text">
        <?php if( get_theme_mod( 'shoes_store_featured_image_hide_show',true) == 1) { ?>
          <div class="box-image">
            <?php the_post_thumbnail(); ?>
          </div>
        <?php } ?>
        <h2 class="section-title"><a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo the_title_attribute(); ?>"><?php the_title();?><span class="screen-reader-text"><?php the_title(); ?></span></a></h2>
       <?php if( get_theme_mod( 'shoes_store_toggle_postdate',true) == 1 || get_theme_mod( 'shoes_store_toggle_author',true) == 1 || get_theme_mod( 'shoes_store_toggle_comments',true) == 1 || get_theme_mod( 'shoes_store_toggle_time',true) == 1) { ?>
            <div class="post-info p-2 my-3">
              <?php if(get_theme_mod('shoes_store_toggle_postdate',true)==1){ ?>
                <i class="fas fa-calendar-alt me-2"></i><span class="entry-date"><a href="<?php echo esc_url( get_day_link( $shoes_store_archive_year, $shoes_store_archive_month, $shoes_store_archive_day)); ?>"><?php echo esc_html( get_the_date() ); ?><span class="screen-reader-text"><?php echo esc_html( get_the_date() ); ?></span></a></span>
              <?php } ?>

              <?php if(get_theme_mod('shoes_store_toggle_author',true)==1){ ?>
                <span><?php echo esc_html(get_theme_mod('shoes_store_meta_field_separator', '|'));?></span> <i class="fas fa-user me-2"></i><span class="entry-author"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>"><?php the_author(); ?><span class="screen-reader-text"><?php the_author(); ?></span></a></span>
              <?php } ?>

              <?php if(get_theme_mod('shoes_store_toggle_comments',true)==1){ ?>
                <span><?php echo esc_html(get_theme_mod('shoes_store_meta_field_separator', '|'));?></span> <i class="fa fa-comments me-2" aria-hidden="true"></i><span class="entry-comments"><?php comments_number( __('0 Comment', 'shoes-store'), __('0 Comments', 'shoes-store'), __('% Comments', 'shoes-store') ); ?></span>
              <?php } ?>

              <?php if(get_theme_mod('shoes_store_toggle_time',true)==1){ ?>
                <span><?php echo esc_html(get_theme_mod('shoes_store_meta_field_separator', '|'));?></span> <i class="fas fa-clock me-2"></i><span class="entry-time"><?php echo esc_html( get_the_time() ); ?></span>
              <?php } ?>
            </div>
          <?php } ?>
        <div class="entry-content">
          <p class="mb-0">
            <?php $shoes_store_theme_lay = get_theme_mod( 'shoes_store_excerpt_settings','Excerpt');
            if($shoes_store_theme_lay == 'Content'){ ?>
              <?php the_content(); ?>
            <?php }
            if($shoes_store_theme_lay == 'Excerpt'){ ?>
              <?php if(get_the_excerpt()) { ?>
                <?php $shoes_store_excerpt = get_the_excerpt(); echo esc_html( shoes_store_string_limit_words( $shoes_store_excerpt, esc_attr(get_theme_mod('shoes_store_excerpt_number','30')))); ?><?php echo esc_html(get_theme_mod('shoes_store_blog_excerpt_suffix',''));?>
              <?php }?>
            <?php }?>
          </p>
        </div>
        <?php if( get_theme_mod('shoes_store_button_text','Read More') != ''){ ?>
          <div class="more-btn mt-4 mb-4">
            <a class="p-3" href="<?php the_permalink(); ?>"><?php echo esc_html(get_theme_mod('shoes_store_button_text',__('Read More','shoes-store')));?><span class="screen-reader-text"><?php echo esc_html(get_theme_mod('shoes_store_button_text',__('Read More','shoes-store')));?></span><span class="top-icon"></span></a>
          </div>
        <?php } ?>
      </div>
    <?php } ?>
  </div>
</div>