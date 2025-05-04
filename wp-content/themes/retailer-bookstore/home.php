<?php

/**
 * The main template file
 * 
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package retailer_bookstore
 */

get_header();

$retailer_bookstore_column = get_theme_mod( 'retailer_bookstore_archive_column_layout', 'column-1' );
?>
<main id="primary" class="site-main">

	<?php

	if ( is_home() && ! is_front_page() ) {
	}

	if ( have_posts() ) :

		if ( is_home() && ! is_front_page() ) :
		endif;
		?>

		<div class="retailer_bookstore-archive-layout grid-layout <?php echo esc_attr( $retailer_bookstore_column ); ?>">
			<?php
			/* Start the Loop */
			while ( have_posts() ) :
                the_post();

                get_template_part( 'template-parts/content', get_post_format() );

            endwhile;
			?>
		</div>
		<?php
		do_action( 'retailer_bookstore_posts_pagination' );

	else :

		get_template_part( 'template-parts/content', 'none' );

	endif;
	?>

</main><!-- #main -->

<?php
if ( retailer_bookstore_is_sidebar_enabled() ) {
	get_sidebar();
}

get_footer();