<?php
/**
 * @package   BreadcrumbTrail
 * @version   1.1.0
 * @author    Justin Tadlock <justin@justintadlock.com>
 * @copyright Copyright (c) 2008 - 2017, Justin Tadlock
 * @link      https://themehybrid.com/plugins/breadcrumb-trail
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

function breadcrumb_trail( $retailer_bookstore_args = array() ) {

	$retailer_bookstore_breadcrumb = apply_filters( 'breadcrumb_trail_object', null, $retailer_bookstore_args );

	if ( ! is_object( $retailer_bookstore_breadcrumb ) ) {
		$retailer_bookstore_breadcrumb = new Breadcrumb_Trail( $retailer_bookstore_args );
	}

	return $retailer_bookstore_breadcrumb->trail();
}

/**
 * Creates a breadcrumbs menu for the site based on the current page that's being viewed by the user.
 *
 * @since  0.6.0
 * @access public
 */
class Breadcrumb_Trail {

	/**
	 * Array of items belonging to the current breadcrumb trail.
	 *
	 * @since  0.1.0
	 * @access public
	 * @var    array
	 */
	public $items = array();

	/**
	 * Arguments used to build the breadcrumb trail.
	 *
	 * @since  0.1.0
	 * @access public
	 * @var    array
	 */
	public $retailer_bookstore_args = array();

	/**
	 * Array of text labels.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    array
	 */
	public $retailer_bookstore_labels = array();

	/**
	 * Array of post types (key) and taxonomies (value) to use for single post views.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    array
	 */
	public $retailer_bookstore_post_taxonomy = array();

	public $labels;
    public $post_taxonomy;
	public $args;

	/* ====== Magic Methods ====== */

	/**
	 * Magic method to use in case someone tries to output the layout object as a string.
	 * We'll just return the trail HTML.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function __toString() {
		return $this->trail();
	}

	/**
	 * Sets up the breadcrumb trail properties.  Calls the `Breadcrumb_Trail::add_items()` method
	 * to creat the array of breadcrumb items.
	 *
	 * @since  0.6.0
	 * @access public
	 * @param  array $retailer_bookstore_args  {
	 *     @type string    $container      Container HTML element. nav|div
	 *     @type string    $before         String to output before breadcrumb menu.
	 *     @type string    $after          String to output after breadcrumb menu.
	 *     @type string    $browse_tag     The HTML tag to use to wrap the "Browse" header text.
	 *     @type string    $list_tag       The HTML tag to use for the list wrapper.
	 *     @type string    $retailer_bookstore_item_tag       The HTML tag to use for the item wrapper.
	 *     @type bool      $show_on_front  Whether to show when `is_front_page()`.
	 *     @type bool      $retailer_bookstore_network        Whether to link to the network main site (multisite only).
	 *     @type bool      $show_title     Whether to show the title (last item) in the trail.
	 *     @type bool      $show_browse    Whether to show the breadcrumb menu header.
	 *     @type array     $retailer_bookstore_labels         Text labels. @see Breadcrumb_Trail::set_labels()
	 *     @type array     $retailer_bookstore_post_taxonomy  Taxonomies to use for post types. @see Breadcrumb_Trail::set_post_taxonomy()
	 *     @type bool      $echo           Whether to print or return the breadcrumbs.
	 * }
	 * @return void
	 */
	public function __construct( $retailer_bookstore_args = array() ) {

		$retailer_bookstore_defaults = array(
			'container'     => 'nav',
			'before'        => '',
			'after'         => '',
			'browse_tag'    => 'h2',
			'list_tag'      => 'ul',
			'item_tag'      => 'li',
			'show_on_front' => true,
			'network'       => false,
			'show_title'    => true,
			'show_browse'   => true,
			'labels'        => array(),
			'post_taxonomy' => array(),
			'echo'          => true,
		);

		// Parse the arguments with the deaults.
		$this->args = apply_filters( 'breadcrumb_trail_args', wp_parse_args( $retailer_bookstore_args, $retailer_bookstore_defaults ) );

		// Set the labels and post taxonomy properties.
		$this->set_labels();
		$this->set_post_taxonomy();

		// Let's find some items to add to the trail!
		$this->add_items();
	}

	/* ====== Public Methods ====== */

	/**
	 * Formats the HTML output for the breadcrumb trail.
	 *
	 * @since  0.6.0
	 * @access public
	 * @return string
	 */
	public function trail() {

		// Set up variables that we'll need.
		$retailer_bookstore_breadcrumb    = '';
		$retailer_bookstore_item_count    = count( $this->items );
		$retailer_bookstore_item_position = 0;

		// Connect the breadcrumb trail if there are items in the trail.
		if ( 0 < $retailer_bookstore_item_count ) {

			// Add 'browse' label if it should be shown.
			if ( true === $this->args['show_browse'] ) {

				$retailer_bookstore_breadcrumb .= sprintf(
					'<%1$s class="trail-browse">%2$s</%1$s>',
					tag_escape( $this->args['browse_tag'] ),
					$this->labels['browse']
				);
			}

			// Open the unordered list.
			$retailer_bookstore_breadcrumb .= sprintf(
				'<%s class="trail-items" itemscope itemtype="http://schema.org/BreadcrumbList">',
				tag_escape( $this->args['list_tag'] )
			);

			// Add the number of items and item list order schema.
			$retailer_bookstore_breadcrumb .= sprintf( '<meta name="numberOfItems" content="%d" />', absint( $retailer_bookstore_item_count ) );
			$retailer_bookstore_breadcrumb .= '<meta name="itemListOrder" content="Ascending" />';

			// Loop through the items and add them to the list.
			foreach ( $this->items as $retailer_bookstore_item ) {

				// Iterate the item position.
				++$retailer_bookstore_item_position;

				// Check if the item is linked.
				preg_match( '/(<a.*?>)(.*?)(<\/a>)/i', $retailer_bookstore_item, $retailer_bookstore_matches );

				// Wrap the item text with appropriate itemprop.
				$retailer_bookstore_item = ! empty( $retailer_bookstore_matches ) ? sprintf( '%s<span itemprop="name">%s</span>%s', $retailer_bookstore_matches[1], $retailer_bookstore_matches[2], $retailer_bookstore_matches[3] ) : sprintf( '<span itemprop="name">%s</span>', $retailer_bookstore_item );

				// Wrap the item with its itemprop.
				$retailer_bookstore_item = ! empty( $retailer_bookstore_matches )
					? preg_replace( '/(<a.*?)([\'"])>/i', '$1$2 itemprop=$2item$2>', $retailer_bookstore_item )
					: sprintf( '<span itemprop="item">%s</span>', $retailer_bookstore_item );

				// Add list item classes.
				$retailer_bookstore_item_class = 'trail-item';

				if ( 1 === $retailer_bookstore_item_position && 1 < $retailer_bookstore_item_count ) {
					$retailer_bookstore_item_class .= ' trail-begin';

				} elseif ( $retailer_bookstore_item_count === $retailer_bookstore_item_position ) {
					$retailer_bookstore_item_class .= ' trail-end';
				}

				// Create list item attributes.
				$retailer_bookstore_attributes = 'itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="' . $retailer_bookstore_item_class . '"';

				// Build the meta position HTML.
				$retailer_bookstore_meta = sprintf( '<meta itemprop="position" content="%s" />', absint( $retailer_bookstore_item_position ) );

				// Build the list item.
				$retailer_bookstore_breadcrumb .= sprintf( '<%1$s %2$s>%3$s%4$s</%1$s>', tag_escape( $this->args['item_tag'] ), $retailer_bookstore_attributes, $retailer_bookstore_item, $retailer_bookstore_meta );
			}

			// Close the unordered list.
			$retailer_bookstore_breadcrumb .= sprintf( '</%s>', tag_escape( $this->args['list_tag'] ) );

			// Wrap the breadcrumb trail.
			$retailer_bookstore_breadcrumb = sprintf(
				'<%1$s role="navigation" aria-label="%2$s" class="breadcrumb-trail breadcrumbs" itemprop="breadcrumb">%3$s%4$s%5$s</%1$s>',
				tag_escape( $this->args['container'] ),
				esc_attr( $this->labels['aria_label'] ),
				$this->args['before'],
				$retailer_bookstore_breadcrumb,
				$this->args['after']
			);
		}

		// Allow developers to filter the breadcrumb trail HTML.
		$retailer_bookstore_breadcrumb = apply_filters( 'breadcrumb_trail', $retailer_bookstore_breadcrumb, $this->args );

		if ( false === $this->args['echo'] ) {
			return $retailer_bookstore_breadcrumb;
		}

		echo $retailer_bookstore_breadcrumb;
	}

	/* ====== Protected Methods ====== */

	/**
	 * Sets the labels property.  Parses the inputted labels array with the defaults.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @return void
	 */
	protected function set_labels() {

		$retailer_bookstore_defaults = array(
			'browse'              => esc_html__( 'Browse:', 'retailer-bookstore' ),
			'aria_label'          => esc_attr_x( 'Breadcrumbs', 'breadcrumbs aria label', 'retailer-bookstore' ),
			'home'                => esc_html__( 'Home', 'retailer-bookstore' ),
			'error_404'           => esc_html__( '404 Not Found', 'retailer-bookstore' ),
			'archives'            => esc_html__( 'Archives', 'retailer-bookstore' ),
			// Translators: %s is the search query.
			'search'              => esc_html__( 'Search results for: %s', 'retailer-bookstore' ),
			// Translators: %s is the page number.
			'paged'               => esc_html__( 'Page %s', 'retailer-bookstore' ),
			// Translators: %s is the page number.
			'paged_comments'      => esc_html__( 'Comment Page %s', 'retailer-bookstore' ),
			// Translators: Minute archive title. %s is the minute time format.
			'archive_minute'      => esc_html__( 'Minute %s', 'retailer-bookstore' ),
			// Translators: Weekly archive title. %s is the week date format.
			'archive_week'        => esc_html__( 'Week %s', 'retailer-bookstore' ),

			// "%s" is replaced with the translated date/time format.
			'archive_minute_hour' => '%s',
			'archive_hour'        => '%s',
			'archive_day'         => '%s',
			'archive_month'       => '%s',
			'archive_year'        => '%s',
		);

		$this->labels = apply_filters( 'breadcrumb_trail_labels', wp_parse_args( $this->args['labels'], $retailer_bookstore_defaults ) );
	}

	/**
	 * Sets the `$retailer_bookstore_post_taxonomy` property.  This is an array of post types (key) and taxonomies (value).
	 * The taxonomy's terms are shown on the singular post view if set.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @return void
	 */
	protected function set_post_taxonomy() {

		$retailer_bookstore_defaults = array();

		// If post permalink is set to `%postname%`, use the `category` taxonomy.
		if ( '%postname%' === trim( get_option( 'permalink_structure' ), '/' ) ) {
			$retailer_bookstore_defaults['post'] = 'category';
		}

		$this->post_taxonomy = apply_filters( 'breadcrumb_trail_post_taxonomy', wp_parse_args( $this->args['post_taxonomy'], $retailer_bookstore_defaults ) );
	}

	/**
	 * Runs through the various WordPress conditional tags to check the current page being viewed.  Once
	 * a condition is met, a specific method is launched to add items to the `$items` array.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @return void
	 */
	protected function add_items() {

		// If viewing the front page.
		if ( is_front_page() ) {
			$this->add_front_page_items();
		}

		// If not viewing the front page.
		else {

			// Add the network and site home links.
			$this->add_network_home_link();
			$this->add_site_home_link();

			// If viewing the home/blog page.
			if ( is_home() ) {
				$this->add_blog_items();
			}

			// If viewing a single post.
			elseif ( is_singular() ) {
				$this->add_singular_items();
			}

			// If viewing an archive page.
			elseif ( is_archive() ) {

				if ( is_post_type_archive() ) {
					$this->add_post_type_archive_items();

				} elseif ( is_category() || is_tag() || is_tax() ) {
					$this->add_term_archive_items();

				} elseif ( is_author() ) {
					$this->add_user_archive_items();

				} elseif ( get_query_var( 'minute' ) && get_query_var( 'hour' ) ) {
					$this->add_minute_hour_archive_items();

				} elseif ( get_query_var( 'minute' ) ) {
					$this->add_minute_archive_items();

				} elseif ( get_query_var( 'hour' ) ) {
					$this->add_hour_archive_items();

				} elseif ( is_day() ) {
					$this->add_day_archive_items();

				} elseif ( get_query_var( 'w' ) ) {
					$this->add_week_archive_items();

				} elseif ( is_month() ) {
					$this->add_month_archive_items();

				} elseif ( is_year() ) {
					$this->add_year_archive_items();

				} else {
					$this->add_default_archive_items();
				}
			}

			// If viewing a search results page.
			elseif ( is_search() ) {
				$this->add_search_items();
			}

			// If viewing the 404 page.
			elseif ( is_404() ) {
				$this->add_404_items();
			}
		}

		// Add paged items if they exist.
		$this->add_paged_items();

		// Allow developers to overwrite the items for the breadcrumb trail.
		$this->items = array_unique( apply_filters( 'breadcrumb_trail_items', $this->items, $this->args ) );
	}

	/**
	 * Gets front items based on $wp_rewrite->front.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @return void
	 */
	protected function add_rewrite_front_items() {
		global $wp_rewrite;

		if ( $wp_rewrite->front ) {
			$this->add_path_parents( $wp_rewrite->front );
		}
	}

	/**
	 * Adds the page/paged number to the items array.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @return void
	 */
	protected function add_paged_items() {

		// If viewing a paged singular post.
		if ( is_singular() && 1 < get_query_var( 'page' ) && true === $this->args['show_title'] ) {
			$this->items[] = sprintf( $this->labels['paged'], number_format_i18n( absint( get_query_var( 'page' ) ) ) );
		}

		// If viewing a singular post with paged comments.
		elseif ( is_singular() && get_option( 'page_comments' ) && 1 < get_query_var( 'cpage' ) ) {
			$this->items[] = sprintf( $this->labels['paged_comments'], number_format_i18n( absint( get_query_var( 'cpage' ) ) ) );
		}

		// If viewing a paged archive-type page.
		elseif ( is_paged() && true === $this->args['show_title'] ) {
			$this->items[] = sprintf( $this->labels['paged'], number_format_i18n( absint( get_query_var( 'paged' ) ) ) );
		}
	}

	/**
	 * Adds the network (all sites) home page link to the items array.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @return void
	 */
	protected function add_network_home_link() {

		if ( is_multisite() && ! is_main_site() && true === $this->args['network'] ) {
			$this->items[] = sprintf( '<a href="%s" rel="home">%s</a>', esc_url( network_home_url() ), $this->labels['home'] );
		}
	}

	/**
	 * Adds the current site's home page link to the items array.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @return void
	 */
	protected function add_site_home_link() {

		$retailer_bookstore_network = is_multisite() && ! is_main_site() && true === $this->args['network'];
		$retailer_bookstore_label   = $retailer_bookstore_network ? get_bloginfo( 'name' ) : $this->labels['home'];
		$retailer_bookstore_rel     = $retailer_bookstore_network ? '' : ' rel="home"';

		$this->items[] = sprintf( '<a href="%s"%s>%s</a>', esc_url( user_trailingslashit( home_url() ) ), $retailer_bookstore_rel, $retailer_bookstore_label );
	}

	/**
	 * Adds items for the front page to the items array.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @return void
	 */
	protected function add_front_page_items() {

		// Only show front items if the 'show_on_front' argument is set to 'true'.
		if ( true === $this->args['show_on_front'] || is_paged() || ( is_singular() && 1 < get_query_var( 'page' ) ) ) {

			// Add network home link.
			$this->add_network_home_link();

			// If on a paged view, add the site home link.
			if ( is_paged() ) {
				$this->add_site_home_link();
			}

			// If on the main front page, add the network home title.
			elseif ( true === $this->args['show_title'] ) {
				$this->items[] = is_multisite() && true === $this->args['network'] ? get_bloginfo( 'name' ) : $this->labels['home'];
			}
		}
	}

	/**
	 * Adds items for the posts page (i.e., is_home()) to the items array.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @return void
	 */
	protected function add_blog_items() {

		// Get the post ID and post.
		$retailer_bookstore_post_id = get_queried_object_id();
		$retailer_bookstore_post    = get_post( $retailer_bookstore_post_id );

		// If the post has parents, add them to the trail.
		if ( 0 < $retailer_bookstore_post->post_parent ) {
			$this->add_post_parents( $retailer_bookstore_post->post_parent );
		}

		// Get the page title.
		$retailer_bookstore_title = get_the_title( $retailer_bookstore_post_id );

		// Add the posts page item.
		if ( is_paged() ) {
			$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_permalink( $retailer_bookstore_post_id ) ), $retailer_bookstore_title );

		} elseif ( $retailer_bookstore_title && true === $this->args['show_title'] ) {
			$this->items[] = $retailer_bookstore_title;
		}
	}

	/**
	 * Adds singular post items to the items array.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @return void
	 */
	protected function add_singular_items() {

		// Get the queried post.
		$retailer_bookstore_post    = get_queried_object();
		$retailer_bookstore_post_id = get_queried_object_id();

		// If the post has a parent, follow the parent trail.
		if ( 0 < $retailer_bookstore_post->post_parent ) {
			$this->add_post_parents( $retailer_bookstore_post->post_parent );
		}

		// If the post doesn't have a parent, get its hierarchy based off the post type.
		else {
			$this->add_post_hierarchy( $retailer_bookstore_post_id );
		}

		// Display terms for specific post type taxonomy if requested.
		if ( ! empty( $this->post_taxonomy[ $retailer_bookstore_post->post_type ] ) ) {
			$this->add_post_terms( $retailer_bookstore_post_id, $this->post_taxonomy[ $retailer_bookstore_post->post_type ] );
		}

		// End with the post title.
		if ( $retailer_bookstore_post_title = single_post_title( '', false ) ) {

			if ( ( 1 < get_query_var( 'page' ) || is_paged() ) || ( get_option( 'page_comments' ) && 1 < absint( get_query_var( 'cpage' ) ) ) ) {
				$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_permalink( $retailer_bookstore_post_id ) ), $retailer_bookstore_post_title );

			} elseif ( true === $this->args['show_title'] ) {
				$this->items[] = $retailer_bookstore_post_title;
			}
		}
	}

	/**
	 * Adds the items to the trail items array for taxonomy term archives.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @global object $wp_rewrite
	 * @return void
	 */
	protected function add_term_archive_items() {
		global $wp_rewrite;

		// Get some taxonomy and term variables.
		$retailer_bookstore_term           = get_queried_object();
		$retailer_bookstore_taxonomy       = get_taxonomy( $retailer_bookstore_term->taxonomy );
		$retailer_bookstore_done_post_type = false;

		// If there are rewrite rules for the taxonomy.
		if ( false !== $retailer_bookstore_taxonomy->rewrite ) {

			// If 'with_front' is true, dd $wp_rewrite->front to the trail.
			if ( $retailer_bookstore_taxonomy->rewrite['with_front'] && $wp_rewrite->front ) {
				$this->add_rewrite_front_items();
			}

			// Get parent pages by path if they exist.
			$this->add_path_parents( $retailer_bookstore_taxonomy->rewrite['slug'] );

			// Add post type archive if its 'has_archive' matches the taxonomy rewrite 'slug'.
			if ( $retailer_bookstore_taxonomy->rewrite['slug'] ) {

				$retailer_bookstore_slug = trim( $retailer_bookstore_taxonomy->rewrite['slug'], '/' );

				// Deals with the situation if the slug has a '/' between multiple
				// strings. For example, "movies/genres" where "movies" is the post
				// type archive.
				$retailer_bookstore_matches = explode( '/', $retailer_bookstore_slug );

				// If matches are found for the path.
				if ( isset( $retailer_bookstore_matches ) ) {

					// Reverse the array of matches to search for posts in the proper order.
					$retailer_bookstore_matches = array_reverse( $retailer_bookstore_matches );

					// Loop through each of the path matches.
					foreach ( $retailer_bookstore_matches as $retailer_bookstore_match ) {

						// If a match is found.
						$retailer_bookstore_slug = $retailer_bookstore_match;

						// Get public post types that match the rewrite slug.
						$retailer_bookstore_post_types = $this->get_post_types_by_slug( $retailer_bookstore_match );

						if ( ! empty( $retailer_bookstore_post_types ) ) {

							$retailer_bookstore_post_type_object = $retailer_bookstore_post_types[0];

							// Add support for a non-standard label of 'archive_title' (special use case).
							$retailer_bookstore_label = ! empty( $retailer_bookstore_post_type_object->labels->archive_title ) ? $retailer_bookstore_post_type_object->labels->archive_title : $retailer_bookstore_post_type_object->labels->name;

							// Core filter hook.
							$retailer_bookstore_label = apply_filters( 'post_type_archive_title', $retailer_bookstore_label, $retailer_bookstore_post_type_object->name );

							// Add the post type archive link to the trail.
							$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_post_type_archive_link( $retailer_bookstore_post_type_object->name ) ), $retailer_bookstore_label );

							$retailer_bookstore_done_post_type = true;

							// Break out of the loop.
							break;
						}
					}
				}
			}
		}

		// If there's a single post type for the taxonomy, use it.
		if ( false === $retailer_bookstore_done_post_type && 1 === count( $retailer_bookstore_taxonomy->object_type ) && post_type_exists( $retailer_bookstore_taxonomy->object_type[0] ) ) {

			// If the post type is 'post'.
			if ( 'post' === $retailer_bookstore_taxonomy->object_type[0] ) {
				$retailer_bookstore_post_id = get_option( 'page_for_posts' );

				if ( 'posts' !== get_option( 'show_on_front' ) && 0 < $retailer_bookstore_post_id ) {
					$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_permalink( $retailer_bookstore_post_id ) ), get_the_title( $retailer_bookstore_post_id ) );
				}

				// If the post type is not 'post'.
			} else {
				$retailer_bookstore_post_type_object = get_post_type_object( $retailer_bookstore_taxonomy->object_type[0] );

				$retailer_bookstore_label = ! empty( $retailer_bookstore_post_type_object->labels->archive_title ) ? $retailer_bookstore_post_type_object->labels->archive_title : $retailer_bookstore_post_type_object->labels->name;

				// Core filter hook.
				$retailer_bookstore_label = apply_filters( 'post_type_archive_title', $retailer_bookstore_label, $retailer_bookstore_post_type_object->name );

				$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_post_type_archive_link( $retailer_bookstore_post_type_object->name ) ), $retailer_bookstore_label );
			}
		}

		// If the taxonomy is hierarchical, list its parent terms.
		if ( is_taxonomy_hierarchical( $retailer_bookstore_term->taxonomy ) && $retailer_bookstore_term->parent ) {
			$this->add_term_parents( $retailer_bookstore_term->parent, $retailer_bookstore_term->taxonomy );
		}

		// Add the term name to the trail end.
		if ( is_paged() ) {
			$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_term_link( $retailer_bookstore_term, $retailer_bookstore_term->taxonomy ) ), single_term_title( '', false ) );

		} elseif ( true === $this->args['show_title'] ) {
			$this->items[] = single_term_title( '', false );
		}
	}

	/**
	 * Adds the items to the trail items array for post type archives.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @return void
	 */
	protected function add_post_type_archive_items() {

		// Get the post type object.
		$retailer_bookstore_post_type_object = get_post_type_object( get_query_var( 'post_type' ) );

		if ( false !== $retailer_bookstore_post_type_object->rewrite ) {

			// If 'with_front' is true, add $wp_rewrite->front to the trail.
			if ( $retailer_bookstore_post_type_object->rewrite['with_front'] ) {
				$this->add_rewrite_front_items();
			}

			// If there's a rewrite slug, check for parents.
			if ( ! empty( $retailer_bookstore_post_type_object->rewrite['slug'] ) ) {
				$this->add_path_parents( $retailer_bookstore_post_type_object->rewrite['slug'] );
			}
		}

		// Add the post type [plural] name to the trail end.
		if ( is_paged() || is_author() ) {
			$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_post_type_archive_link( $retailer_bookstore_post_type_object->name ) ), post_type_archive_title( '', false ) );

		} elseif ( true === $this->args['show_title'] ) {
			$this->items[] = post_type_archive_title( '', false );
		}

		// If viewing a post type archive by author.
		if ( is_author() ) {
			$this->add_user_archive_items();
		}
	}

	/**
	 * Adds the items to the trail items array for user (author) archives.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @global object $wp_rewrite
	 * @return void
	 */
	protected function add_user_archive_items() {
		global $wp_rewrite;

		// Add $wp_rewrite->front to the trail.
		$this->add_rewrite_front_items();

		// Get the user ID.
		$retailer_bookstore_user_id = get_query_var( 'author' );

		// If $author_base exists, check for parent pages.
		if ( ! empty( $wp_rewrite->author_base ) && ! is_post_type_archive() ) {
			$this->add_path_parents( $wp_rewrite->author_base );
		}

		// Add the author's display name to the trail end.
		if ( is_paged() ) {
			$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_author_posts_url( $retailer_bookstore_user_id ) ), get_the_author_meta( 'display_name', $retailer_bookstore_user_id ) );

		} elseif ( true === $this->args['show_title'] ) {
			$this->items[] = get_the_author_meta( 'display_name', $retailer_bookstore_user_id );
		}
	}

	/**
	 * Adds the items to the trail items array for minute + hour archives.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @return void
	 */
	protected function add_minute_hour_archive_items() {

		// Add $wp_rewrite->front to the trail.
		$this->add_rewrite_front_items();

		// Add the minute + hour item.
		if ( true === $this->args['show_title'] ) {
			$this->items[] = sprintf( $this->labels['archive_minute_hour'], get_the_time( esc_html_x( 'g:i a', 'minute and hour archives time format', 'retailer-bookstore' ) ) );
		}
	}

	/**
	 * Adds the items to the trail items array for minute archives.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @return void
	 */
	protected function add_minute_archive_items() {

		// Add $wp_rewrite->front to the trail.
		$this->add_rewrite_front_items();

		// Add the minute item.
		if ( true === $this->args['show_title'] ) {
			$this->items[] = sprintf( $this->labels['archive_minute'], get_the_time( esc_html_x( 'i', 'minute archives time format', 'retailer-bookstore' ) ) );
		}
	}

	/**
	 * Adds the items to the trail items array for hour archives.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @return void
	 */
	protected function add_hour_archive_items() {

		// Add $wp_rewrite->front to the trail.
		$this->add_rewrite_front_items();

		// Add the hour item.
		if ( true === $this->args['show_title'] ) {
			$this->items[] = sprintf( $this->labels['archive_hour'], get_the_time( esc_html_x( 'g a', 'hour archives time format', 'retailer-bookstore' ) ) );
		}
	}

	/**
	 * Adds the items to the trail items array for day archives.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @return void
	 */
	protected function add_day_archive_items() {

		// Add $wp_rewrite->front to the trail.
		$this->add_rewrite_front_items();

		// Get year, month, and day.
		$retailer_bookstore_year  = sprintf( $this->labels['archive_year'], get_the_time( esc_html_x( 'Y', 'yearly archives date format', 'retailer-bookstore' ) ) );
		$retailer_bookstore_month = sprintf( $this->labels['archive_month'], get_the_time( esc_html_x( 'F', 'monthly archives date format', 'retailer-bookstore' ) ) );
		$retailer_bookstore_day   = sprintf( $this->labels['archive_day'], get_the_time( esc_html_x( 'j', 'daily archives date format', 'retailer-bookstore' ) ) );

		// Add the year and month items.
		$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_year_link( get_the_time( 'Y' ) ) ), $retailer_bookstore_year );
		$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ), $retailer_bookstore_month );

		// Add the day item.
		if ( is_paged() ) {
			$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_day_link( get_the_time( 'Y' ) ), get_the_time( 'm' ), get_the_time( 'd' ) ), $retailer_bookstore_day );

		} elseif ( true === $this->args['show_title'] ) {
			$this->items[] = $retailer_bookstore_day;
		}
	}

	/**
	 * Adds the items to the trail items array for week archives.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @return void
	 */
	protected function add_week_archive_items() {

		// Add $wp_rewrite->front to the trail.
		$this->add_rewrite_front_items();

		// Get the year and week.
		$retailer_bookstore_year = sprintf( $this->labels['archive_year'], get_the_time( esc_html_x( 'Y', 'yearly archives date format', 'retailer-bookstore' ) ) );
		$retailer_bookstore_week = sprintf( $this->labels['archive_week'], get_the_time( esc_html_x( 'W', 'weekly archives date format', 'retailer-bookstore' ) ) );

		// Add the year item.
		$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_year_link( get_the_time( 'Y' ) ) ), $retailer_bookstore_year );

		// Add the week item.
		if ( is_paged() ) {
			$this->items[] = esc_url(
				get_archives_link(
					add_query_arg(
						array(
							'm' => get_the_time( 'Y' ),
							'w' => get_the_time( 'W' ),
						),
						home_url()
					),
					$retailer_bookstore_week,
					false
				)
			);

		} elseif ( true === $this->args['show_title'] ) {
			$this->items[] = $retailer_bookstore_week;
		}
	}

	/**
	 * Adds the items to the trail items array for month archives.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @return void
	 */
	protected function add_month_archive_items() {

		// Add $wp_rewrite->front to the trail.
		$this->add_rewrite_front_items();

		// Get the year and month.
		$retailer_bookstore_year  = sprintf( $this->labels['archive_year'], get_the_time( esc_html_x( 'Y', 'yearly archives date format', 'retailer-bookstore' ) ) );
		$retailer_bookstore_month = sprintf( $this->labels['archive_month'], get_the_time( esc_html_x( 'F', 'monthly archives date format', 'retailer-bookstore' ) ) );

		// Add the year item.
		$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_year_link( get_the_time( 'Y' ) ) ), $retailer_bookstore_year );

		// Add the month item.
		if ( is_paged() ) {
			$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ), $retailer_bookstore_month );

		} elseif ( true === $this->args['show_title'] ) {
			$this->items[] = $retailer_bookstore_month;
		}
	}

	/**
	 * Adds the items to the trail items array for year archives.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @return void
	 */
	protected function add_year_archive_items() {

		// Add $wp_rewrite->front to the trail.
		$this->add_rewrite_front_items();

		// Get the year.
		$retailer_bookstore_year = sprintf( $this->labels['archive_year'], get_the_time( esc_html_x( 'Y', 'yearly archives date format', 'retailer-bookstore' ) ) );

		// Add the year item.
		if ( is_paged() ) {
			$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_year_link( get_the_time( 'Y' ) ) ), $retailer_bookstore_year );

		} elseif ( true === $this->args['show_title'] ) {
			$this->items[] = $retailer_bookstore_year;
		}
	}

	/**
	 * Adds the items to the trail items array for archives that don't have a more specific method
	 * defined in this class.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @return void
	 */
	protected function add_default_archive_items() {

		// If this is a date-/time-based archive, add $wp_rewrite->front to the trail.
		if ( is_date() || is_time() ) {
			$this->add_rewrite_front_items();
		}

		if ( true === $this->args['show_title'] ) {
			$this->items[] = $this->labels['archives'];
		}
	}

	/**
	 * Adds the items to the trail items array for search results.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @return void
	 */
	protected function add_search_items() {

		if ( is_paged() ) {
			$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_search_link() ), sprintf( $this->labels['search'], get_search_query() ) );

		} elseif ( true === $this->args['show_title'] ) {
			$this->items[] = sprintf( $this->labels['search'], get_search_query() );
		}
	}

	/**
	 * Adds the items to the trail items array for 404 pages.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @return void
	 */
	protected function add_404_items() {

		if ( true === $this->args['show_title'] ) {
			$this->items[] = $this->labels['error_404'];
		}
	}

	/**
	 * Adds a specific post's parents to the items array.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @param  int $retailer_bookstore_post_id
	 * @return void
	 */
	protected function add_post_parents( $retailer_bookstore_post_id ) {
		$retailer_bookstore_parents = array();

		while ( $retailer_bookstore_post_id ) {

			// Get the post by ID.
			$retailer_bookstore_post = get_post( $retailer_bookstore_post_id );

			// If we hit a page that's set as the front page, bail.
			if ( 'page' == $retailer_bookstore_post->post_type && 'page' == get_option( 'show_on_front' ) && $retailer_bookstore_post_id == get_option( 'page_on_front' ) ) {
				break;
			}

			// Add the formatted post link to the array of parents.
			$retailer_bookstore_parents[] = sprintf( '<a href="%s">%s</a>', esc_url( get_permalink( $retailer_bookstore_post_id ) ), get_the_title( $retailer_bookstore_post_id ) );

			// If there's no longer a post parent, break out of the loop.
			if ( 0 >= $retailer_bookstore_post->post_parent ) {
				break;
			}

			// Change the post ID to the parent post to continue looping.
			$retailer_bookstore_post_id = $retailer_bookstore_post->post_parent;
		}

		// Get the post hierarchy based off the final parent post.
		$this->add_post_hierarchy( $retailer_bookstore_post_id );

		// Display terms for specific post type taxonomy if requested.
		if ( ! empty( $this->post_taxonomy[ $retailer_bookstore_post->post_type ] ) ) {
			$this->add_post_terms( $retailer_bookstore_post_id, $this->post_taxonomy[ $retailer_bookstore_post->post_type ] );
		}

		// Merge the parent items into the items array.
		$this->items = array_merge( $this->items, array_reverse( $retailer_bookstore_parents ) );
	}

	/**
	 * Adds a specific post's hierarchy to the items array.  The hierarchy is determined by post type's
	 * rewrite arguments and whether it has an archive page.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @param  int $retailer_bookstore_post_id
	 * @return void
	 */
	protected function add_post_hierarchy( $retailer_bookstore_post_id ) {

		// Get the post type.
		$retailer_bookstore_post_type        = get_post_type( $retailer_bookstore_post_id );
		$retailer_bookstore_post_type_object = get_post_type_object( $retailer_bookstore_post_type );

		// If this is the 'post' post type, get the rewrite front items and map the rewrite tags.
		if ( 'post' === $retailer_bookstore_post_type ) {

			// Add $wp_rewrite->front to the trail.
			$this->add_rewrite_front_items();

			// Map the rewrite tags.
			$this->map_rewrite_tags( $retailer_bookstore_post_id, get_option( 'permalink_structure' ) );
		}

		// If the post type has rewrite rules.
		elseif ( false !== $retailer_bookstore_post_type_object->rewrite ) {

			// If 'with_front' is true, add $wp_rewrite->front to the trail.
			if ( $retailer_bookstore_post_type_object->rewrite['with_front'] ) {
				$this->add_rewrite_front_items();
			}

			// If there's a path, check for parents.
			if ( ! empty( $retailer_bookstore_post_type_object->rewrite['slug'] ) ) {
				$this->add_path_parents( $retailer_bookstore_post_type_object->rewrite['slug'] );
			}
		}

		// If there's an archive page, add it to the trail.
		if ( $retailer_bookstore_post_type_object->has_archive ) {

			// Add support for a non-standard label of 'archive_title' (special use case).
			$retailer_bookstore_label = ! empty( $retailer_bookstore_post_type_object->labels->archive_title ) ? $retailer_bookstore_post_type_object->labels->archive_title : $retailer_bookstore_post_type_object->labels->name;

			// Core filter hook.
			$retailer_bookstore_label = apply_filters( 'post_type_archive_title', $retailer_bookstore_label, $retailer_bookstore_post_type_object->name );

			$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_post_type_archive_link( $retailer_bookstore_post_type ) ), $retailer_bookstore_label );
		}

		// Map the rewrite tags if there's a `%` in the slug.
		if ( 'post' !== $retailer_bookstore_post_type && ! empty( $retailer_bookstore_post_type_object->rewrite['slug'] ) && false !== strpos( $retailer_bookstore_post_type_object->rewrite['slug'], '%' ) ) {
			$this->map_rewrite_tags( $retailer_bookstore_post_id, $retailer_bookstore_post_type_object->rewrite['slug'] );
		}
	}

	/**
	 * Gets post types by slug.  This is needed because the get_post_types() function doesn't exactly
	 * match the 'has_archive' argument when it's set as a string instead of a boolean.
	 *
	 * @since  0.6.0
	 * @access protected
	 * @param  int $retailer_bookstore_slug  The post type archive slug to search for.
	 * @return void
	 */
	protected function get_post_types_by_slug( $retailer_bookstore_slug ) {

		$retailer_bookstore_return = array();

		$retailer_bookstore_post_types = get_post_types( array(), 'objects' );

		foreach ( $retailer_bookstore_post_types as $retailer_bookstore_type ) {

			if ( $retailer_bookstore_slug === $retailer_bookstore_type->has_archive || ( true === $retailer_bookstore_type->has_archive && $retailer_bookstore_slug === $retailer_bookstore_type->rewrite['slug'] ) ) {
				$retailer_bookstore_return[] = $retailer_bookstore_type;
			}
		}

		return $retailer_bookstore_return;
	}

	/**
	 * Adds a post's terms from a specific taxonomy to the items array.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @param  int    $retailer_bookstore_post_id  The ID of the post to get the terms for.
	 * @param  string $retailer_bookstore_taxonomy The taxonomy to get the terms from.
	 * @return void
	 */
	protected function add_post_terms( $retailer_bookstore_post_id, $retailer_bookstore_taxonomy ) {

		// Get the post type.
		$retailer_bookstore_post_type = get_post_type( $retailer_bookstore_post_id );

		// Get the post categories.
		$retailer_bookstore_terms = get_the_terms( $retailer_bookstore_post_id, $retailer_bookstore_taxonomy );

		// Check that categories were returned.
		if ( $retailer_bookstore_terms && ! is_wp_error( $retailer_bookstore_terms ) ) {

			// Sort the terms by ID and get the first category.
			if ( function_exists( 'wp_list_sort' ) ) {
				$retailer_bookstore_terms = wp_list_sort( $retailer_bookstore_terms, 'term_id' );

			} else {
				usort( $retailer_bookstore_terms, '_usort_terms_by_ID' );
			}

			$retailer_bookstore_term = get_term( $retailer_bookstore_terms[0], $retailer_bookstore_taxonomy );

			// If the category has a parent, add the hierarchy to the trail.
			if ( 0 < $retailer_bookstore_term->parent ) {
				$this->add_term_parents( $retailer_bookstore_term->parent, $retailer_bookstore_taxonomy );
			}

			// Add the category archive link to the trail.
			$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_term_link( $retailer_bookstore_term, $retailer_bookstore_taxonomy ) ), $retailer_bookstore_term->name );
		}
	}

	/**
	 * Get parent posts by path.  Currently, this method only supports getting parents of the 'page'
	 * post type.  The goal of this function is to create a clear path back to home given what would
	 * normally be a "ghost" directory.  If any page matches the given path, it'll be added.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @param  string $retailer_bookstore_path The path (slug) to search for posts by.
	 * @return void
	 */
	function add_path_parents( $retailer_bookstore_path ) {

		// Trim '/' off $retailer_bookstore_path in case we just got a simple '/' instead of a real path.
		$retailer_bookstore_path = trim( $retailer_bookstore_path, '/' );

		// If there's no path, return.
		if ( empty( $retailer_bookstore_path ) ) {
			return;
		}

		// Get parent post by the path.
		$retailer_bookstore_post = get_page_by_path( $retailer_bookstore_path );

		if ( ! empty( $retailer_bookstore_post ) ) {
			$this->add_post_parents( $retailer_bookstore_post->ID );
		} elseif ( is_null( $retailer_bookstore_post ) ) {

			// Separate post names into separate paths by '/'.
			$retailer_bookstore_path = trim( $retailer_bookstore_path, '/' );
			preg_match_all( '/\/.*?\z/', $retailer_bookstore_path, $retailer_bookstore_matches );

			// If matches are found for the path.
			if ( isset( $retailer_bookstore_matches ) ) {

				// Reverse the array of matches to search for posts in the proper order.
				$retailer_bookstore_matches = array_reverse( $retailer_bookstore_matches );

				// Loop through each of the path matches.
				foreach ( $retailer_bookstore_matches as $retailer_bookstore_match ) {

					// If a match is found.
					if ( isset( $retailer_bookstore_match[0] ) ) {

						// Get the parent post by the given path.
						$retailer_bookstore_path = str_replace( $retailer_bookstore_match[0], '', $retailer_bookstore_path );
						$retailer_bookstore_post = get_page_by_path( trim( $retailer_bookstore_path, '/' ) );

						// If a parent post is found, set the $retailer_bookstore_post_id and break out of the loop.
						if ( ! empty( $retailer_bookstore_post ) && 0 < $retailer_bookstore_post->ID ) {
							$this->add_post_parents( $retailer_bookstore_post->ID );
							break;
						}
					}
				}
			}
		}
	}

	/**
	 * Searches for term parents of hierarchical taxonomies.  This function is similar to the WordPress
	 * function get_category_parents() but handles any type of taxonomy.
	 *
	 * @since  1.0.0
	 * @param  int    $retailer_bookstore_term_id  ID of the term to get the parents of.
	 * @param  string $retailer_bookstore_taxonomy Name of the taxonomy for the given term.
	 * @return void
	 */
	function add_term_parents( $retailer_bookstore_term_id, $retailer_bookstore_taxonomy ) {

		// Set up some default arrays.
		$retailer_bookstore_parents = array();

		// While there is a parent ID, add the parent term link to the $retailer_bookstore_parents array.
		while ( $retailer_bookstore_term_id ) {

			// Get the parent term.
			$retailer_bookstore_term = get_term( $retailer_bookstore_term_id, $retailer_bookstore_taxonomy );

			// Add the formatted term link to the array of parent terms.
			$retailer_bookstore_parents[] = sprintf( '<a href="%s">%s</a>', esc_url( get_term_link( $retailer_bookstore_term, $retailer_bookstore_taxonomy ) ), $retailer_bookstore_term->name );

			// Set the parent term's parent as the parent ID.
			$retailer_bookstore_term_id = $retailer_bookstore_term->parent;
		}

		// If we have parent terms, reverse the array to put them in the proper order for the trail.
		if ( ! empty( $retailer_bookstore_parents ) ) {
			$this->items = array_merge( $this->items, array_reverse( $retailer_bookstore_parents ) );
		}
	}

	/**
	 * Turns %tag% from permalink structures into usable links for the breadcrumb trail.  This feels kind of
	 * hackish for now because we're checking for specific %tag% examples and only doing it for the 'post'
	 * post type.  In the future, maybe it'll handle a wider variety of possibilities, especially for custom post
	 * types.
	 *
	 * @since  0.6.0
	 * @access protected
	 * @param  int    $retailer_bookstore_post_id ID of the post whose parents we want.
	 * @param  string $retailer_bookstore_path    Path of a potential parent page.
	 * @param  array  $retailer_bookstore_args    Mixed arguments for the menu.
	 * @return array
	 */
	protected function map_rewrite_tags( $retailer_bookstore_post_id, $retailer_bookstore_path ) {

		$retailer_bookstore_post = get_post( $retailer_bookstore_post_id );

		// Trim '/' from both sides of the $retailer_bookstore_path.
		$retailer_bookstore_path = trim( $retailer_bookstore_path, '/' );

		// Split the $retailer_bookstore_path into an array of strings.
		$retailer_bookstore_matches = explode( '/', $retailer_bookstore_path );

		// If matches are found for the path.
		if ( is_array( $retailer_bookstore_matches ) ) {

			// Loop through each of the matches, adding each to the $trail array.
			foreach ( $retailer_bookstore_matches as $retailer_bookstore_match ) {

				// Trim any '/' from the $retailer_bookstore_match.
				$retailer_bookstore_tag = trim( $retailer_bookstore_match, '/' );

				// If using the %year% tag, add a link to the yearly archive.
				if ( '%year%' == $retailer_bookstore_tag ) {
					$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_year_link( get_the_time( 'Y', $retailer_bookstore_post_id ) ) ), sprintf( $this->labels['archive_year'], get_the_time( esc_html_x( 'Y', 'yearly archives date format', 'retailer-bookstore' ) ) ) );
				}

				// If using the %monthnum% tag, add a link to the monthly archive.
				elseif ( '%monthnum%' == $retailer_bookstore_tag ) {
					$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_month_link( get_the_time( 'Y', $retailer_bookstore_post_id ), get_the_time( 'm', $retailer_bookstore_post_id ) ) ), sprintf( $this->labels['archive_month'], get_the_time( esc_html_x( 'F', 'monthly archives date format', 'retailer-bookstore' ) ) ) );
				}

				// If using the %day% tag, add a link to the daily archive.
				elseif ( '%day%' == $retailer_bookstore_tag ) {
					$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_day_link( get_the_time( 'Y', $retailer_bookstore_post_id ), get_the_time( 'm', $retailer_bookstore_post_id ), get_the_time( 'd', $retailer_bookstore_post_id ) ) ), sprintf( $this->labels['archive_day'], get_the_time( esc_html_x( 'j', 'daily archives date format', 'retailer-bookstore' ) ) ) );
				}

				// If using the %author% tag, add a link to the post author archive.
				elseif ( '%author%' == $retailer_bookstore_tag ) {
					$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_author_posts_url( $retailer_bookstore_post->post_author ) ), get_the_author_meta( 'display_name', $retailer_bookstore_post->post_author ) );
				}

				// If using the %category% tag, add a link to the first category archive to match permalinks.
				elseif ( taxonomy_exists( trim( $retailer_bookstore_tag, '%' ) ) ) {

					// Force override terms in this post type.
					$this->post_taxonomy[ $retailer_bookstore_post->post_type ] = false;

					// Add the post categories.
					$this->add_post_terms( $retailer_bookstore_post_id, trim( $retailer_bookstore_tag, '%' ) );
				}
			}
		}
	}
}