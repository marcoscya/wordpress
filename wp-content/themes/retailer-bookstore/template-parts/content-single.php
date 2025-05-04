<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package retailer_bookstore
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="mag-post-single">
		<div class="mag-post-detail">
			<div class="mag-post-category">
				<?php retailer_bookstore_categories_single_list(); ?>
			</div>
			<header class="entry-header">
				<?php
				if ( is_singular() ) {
				    if ( ! get_theme_mod( 'retailer_bookstore_single_post_hide_post_heading', false ) ) {
				        the_title( '<h1 class="entry-title">', '</h1>' );
				    }
				} else {
				    the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				}

				if ( 'post' === get_post_type() ) :
					?>
					<div class="mag-post-meta">
						<?php
						retailer_bookstore_posted_by_single();
						retailer_bookstore_posted_on_single();
						retailer_bookstore_posted_comments_single();
						retailer_bookstore_posted_time_single();
						?>
					</div>
				<?php endif; ?>
			</header><!-- .entry-header -->
		</div>
		<?php retailer_bookstore_post_thumbnail(); ?>
		<?php if ( !get_theme_mod( 'retailer_bookstore_single_post_hide_post_content', false ) ) { ?>
			<div class="entry-content">
				<?php
				the_content(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'retailer-bookstore' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						wp_kses_post( get_the_title() )
					)
				);

				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'retailer-bookstore' ),
						'after'  => '</div>',
					)
				);
				?>
			</div><!-- .entry-content -->
		<?php } ?>
	</div>

	<footer class="entry-footer">
		<?php retailer_bookstore_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->