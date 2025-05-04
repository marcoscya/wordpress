<?php

/**
 * Template part for displaying Video Format
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package retailer_bookstore
 */

?>
<?php $retailer_bookstore_readmore = get_theme_mod( 'retailer_bookstore_readmore_button_text','Read More');?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="mag-post-single">
        <?php
			// Get the post ID
			$retailer_bookstore_post_id = get_the_ID();

			// Check if there are videos embedded in the post content
			$retailer_bookstore_post = get_post($retailer_bookstore_post_id);
			$retailer_bookstore_content = do_shortcode(apply_filters('the_content', $retailer_bookstore_post->post_content));
			$retailer_bookstore_embeds = get_media_embedded_in_content($retailer_bookstore_content);

			if (!empty($retailer_bookstore_embeds)) {
			    // Loop through embedded media and display videos
			    foreach ($retailer_bookstore_embeds as $retailer_bookstore_embed) {
			        // Check if the embed code contains a video tag or specific video providers like YouTube or Vimeo
			        if (strpos($retailer_bookstore_embed, 'video') !== false || strpos($retailer_bookstore_embed, 'youtube') !== false || strpos($retailer_bookstore_embed, 'vimeo') !== false || strpos($retailer_bookstore_embed, 'dailymotion') !== false || strpos($retailer_bookstore_embed, 'vine') !== false || strpos($retailer_bookstore_embed, 'wordPress.tv') !== false || strpos($retailer_bookstore_embed, 'hulu') !== false) {
			            ?>
			            <div class="custom-embedded-video">
			                <div class="video-container">
			                    <?php echo $retailer_bookstore_embed; ?>
			                </div>
			                <div class="video-comments">
			                    <?php
			                    // Add your comments section here
			                    comments_template(); // This will include the default WordPress comments template
			                    ?>
			                </div>
			            </div>
			            <?php
			        }
			    }
			}
	    ?>
		<div class="mag-post-detail">
			<div class="mag-post-category">
				<?php retailer_bookstore_categories_list(); ?>
			</div>
			<?php
			if ( is_singular() ) :
				the_title( '<h1 class="entry-title mag-post-title">', '</h1>' );
			else :
				if ( get_theme_mod( 'retailer_bookstore_post_hide_post_heading', true ) ) { 
					the_title( '<h2 class="entry-title mag-post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			    }
			endif;
			?>
			<div class="mag-post-meta">
				<?php
				retailer_bookstore_posted_by();
				retailer_bookstore_posted_on();
				retailer_bookstore_posted_comments();
				retailer_bookstore_posted_time();
				?>
			</div>
			<?php if ( get_theme_mod( 'retailer_bookstore_post_hide_post_content', true ) ) { ?>
				<div class="mag-post-excerpt">
					<?php the_excerpt(); ?>
				</div>
		    <?php } ?>
			<?php if ( get_theme_mod( 'retailer_bookstore_post_readmore_button', true ) === true ) : ?>
				<div class="mag-post-read-more">
					<a href="<?php the_permalink(); ?>" class="read-more-button">
						<?php if ( ! empty( $retailer_bookstore_readmore ) ) { ?> <?php echo esc_html( $retailer_bookstore_readmore ); ?> <?php } ?>
						<i class="<?php echo esc_attr( get_theme_mod( 'retailer_bookstore_readmore_btn_icon', 'fas fa-chevron-right' ) ); ?>"></i>
					</a>
				</div>
			<?php endif; ?>
		</div>
	</div>

</article><!-- #post-<?php the_ID(); ?> -->