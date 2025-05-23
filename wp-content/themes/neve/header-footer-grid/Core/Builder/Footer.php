<?php
/**
 * Footer class for Header Footer Grid.
 *
 * Name:    Header Footer Grid
 * Author:  Bogdan Preda <bogdan.preda@themeisle.com>
 *
 * @version 1.0.0
 * @package HFG
 */

namespace HFG\Core\Builder;

use HFG\Main;
use Neve\Core\Theme_Info;

/**
 * Class Footer
 *
 * @package HFG\Core\Builder
 */
class Footer extends Abstract_Builder {
	use Theme_Info;

	/**
	 * Builder name.
	 */
	const BUILDER_NAME = 'footer';

	/**
	 * Footer constructor.
	 *
	 * @since   1.0.0
	 * @access  public
	 */
	public function init() {
		$this->set_property( 'title', __( 'Footer', 'neve' ) );
		$this->set_property( 'columns_layout', true );
		$this->set_property(
			'description',
			apply_filters(
				'hfg_footer_panel_description',
				sprintf(
				/* translators: %s link to documentation */
					esc_html__( 'Design your %1$s by dragging, dropping and resizing all the elements in real-time. %2$s.', 'neve' ),
					/* translators: %s builder type */
					$this->get_property( 'title' ),
					/* translators: %s link text */
					sprintf(
						'<br/><a target="_blank" rel="external noopener noreferrer" href="https://docs.themeisle.com/article/946-neve-doc#footer-builder"><span class="screen-reader-text">%s</span><svg xmlns="http://www.w3.org/2000/svg" focusable="false" role="img" viewBox="0 0 512 512" width="12" height="12" style="margin-right: 5px;"><path fill="currentColor" d="M432 320H400a16 16 0 0 0-16 16V448H64V128H208a16 16 0 0 0 16-16V80a16 16 0 0 0-16-16H48A48 48 0 0 0 0 112V464a48 48 0 0 0 48 48H400a48 48 0 0 0 48-48V336A16 16 0 0 0 432 320ZM488 0h-128c-21.4 0-32 25.9-17 41l35.7 35.7L135 320.4a24 24 0 0 0 0 34L157.7 377a24 24 0 0 0 34 0L435.3 133.3 471 169c15 15 41 4.5 41-17V24A24 24 0 0 0 488 0Z"/></svg>%s</a>',
						esc_html__( '(opens in a new tab)', 'neve' ),
						esc_html__( 'Read full documentation', 'neve' )
					)
				)
			)
		);

		$upgrade_url_copyright = tsdk_translate_link( tsdk_utmify( 'https://themeisle.com/themes/neve/upgrade/', 'copyright' ), 'query' );

		$this->set_property(
			'instructions_array',
			array(
				'description' => sprintf(
				/* translators: 1: builder, 2: builder symbol */
					esc_attr__( 'Welcome to the %1$s builder! Click the %2$s button to add a new component or follow the Quick Links.', 'neve' ),
					$this->get_property( 'title' ),
					'+'
				),
				'quickLinks'  => array(
					'footer_copyright_content'            => array(
						'label'             => esc_html__( 'Change Copyright', 'neve' ),
						'icon'              => 'dashicons-nametag',
						'url'               => $this->has_valid_addons() ? null : $upgrade_url_copyright,
						'badge'             => esc_html__( 'PRO', 'neve' ),
						'upsellDescription' => sprintf(
							/* translators: %1$s: opening anchor tag, %2$s: closing anchor tag */
							__( 'The Neve theme free version doesn\'t support copyright edits. Pro unlocks this and more—%1$sexplore%2$s it when you\'re ready!', 'neve' ),
							'<a href="' . esc_url_raw( $upgrade_url_copyright ) . '" target="_blank" rel="noopener noreferrer">',
							'</a>'
						),
					),
					'hfg_footer_layout_bottom_background' => array(
						'label' => esc_html__( 'Change Footer Color', 'neve' ),
						'icon'  => 'dashicons-admin-appearance',
					),
				),
			)
		);
		$this->devices = [
			'desktop' => __( 'Desktop', 'neve' ),
			'mobile'  => __( 'Mobile', 'neve' ),
		];

		/**
		 * Fix legacy search widget display in footer
		 * Only applies for versions < 5.8
		 */
		add_filter(
			'dynamic_sidebar_params',
			function ( $params ) {
				$processed_params        = [];
				$has_legacy_search_style = apply_filters( 'neve_has_legacy_search_style_filter', false );
				foreach ( $params as $param ) {
					if ( isset( $param['before_widget'] ) && strpos( $param['before_widget'], 'widget_search' ) !== false && $has_legacy_search_style === false ) {
						$param['before_widget'] = '<style type="text/css">.widget_search .search-form .search-submit, .widget_search .search-form .search-field { height: auto; }</style>' . $param['before_widget'];
						add_filter( 'neve_has_legacy_search_style_filter', '__return_true' );
					}
					array_push( $processed_params, $param );
				}

				return $processed_params;
			}
		);

		/**
		 * Add mobile footer layout if not present using the same layout from desktop if mobile is empty.
		 * This will apply from Neve 3.5.8 and offer backward compatibility for users that have not set a mobile footer layout.
		 *
		 * @since 3.5.8
		 */
		add_filter(
			'theme_mod_hfg_footer_layout_v2',
			function ( $value ) {
				if ( is_string( $value ) ) {
					$maybe_parse_json = json_decode( $value, true );
					if ( ! empty( $maybe_parse_json['mobile'] ) ) {
						return $value;
					}
					$maybe_parse_json['mobile'] = $maybe_parse_json['desktop'];
					return wp_json_encode( $maybe_parse_json );
				}
				return $value;
			}
		);

		add_action( 'neve_after_slot_component', [ $this, 'add_footer_component' ], 10, 3 );
	}

	/**
	 * Add footer component.
	 *
	 * @param string $builder Builder slug.
	 * @param string $row Row slug.
	 * @param string $slot Slot name.
	 *
	 * @return void
	 */
	public function add_footer_component( $builder, $row, $slot ) {
		if ( $this->has_valid_addons() ) {
			return;
		}

		if ( $builder !== self::BUILDER_NAME ) {
			return;
		}

		if ( $row !== 'bottom' ) {
			return;
		}

		if ( $slot !== 'left' ) {
			return;
		}

		$output  = '<div class="builder-item"><div class="item--inner"><div class="component-wrap"><div>';
		$output .= sprintf(
		/* translators: %1$s is Theme Name ( Neve ), %2$s is WordPress */
			esc_html__( '%1$s | Powered by %2$s', 'neve' ),
			wp_kses_post( '<p><a href="' . tsdk_translate_link( 'https://themeisle.com/themes/neve/', 'path' ) . '" rel="nofollow">Neve</a>' ),
			wp_kses_post( '<a href="https://wordpress.org" rel="nofollow">WordPress</a></p>' )
		);
		$output .= '</div></div></div></div>';


		echo wp_kses_post( $output );
	}

	/**
	 * Method called via hook.
	 *
	 * @since   1.0.0
	 * @access  public
	 */
	public function load_template() {

		Main::get_instance()->load( 'footer-wrapper' );
	}

	/**
	 * Render builder row.
	 *
	 * @param string $device_id The device id.
	 * @param string $row_id The row id.
	 * @param array  $row_details Row data.
	 */
	public function render_row( $device_id, $row_id, $row_details ) {
		Main::get_instance()->load( 'footer-row-wrapper' );
	}

	/**
	 * Get builder id.
	 *
	 * @return string Builder id.
	 */
	public function get_id() {
		return self::BUILDER_NAME;
	}

	/**
	 * Overrides parent method to limit rows.
	 *
	 * @return array
	 * @since   1.0.0
	 * @access  protected
	 */
	protected function get_rows() {
		if ( neve_is_new_builder() ) {
			return [
				'top'    => array(
					'title'       => __( 'Footer Top', 'neve' ),
					'description' => $this->get_property( 'description' ),
				),
				'main'   => array(
					'title'       => __( 'Footer Main', 'neve' ),
					'description' => $this->get_property( 'description' ),
				),
				'bottom' => array(
					'title'       => __( 'Footer Bottom', 'neve' ),
					'description' => $this->get_property( 'description' ),
				),
			];
		}

		return [
			'top'    => array(
				'title'       => __( 'Footer Top', 'neve' ),
				'description' => $this->get_property( 'description' ),
			),
			'bottom' => array(
				'title'       => __( 'Footer Bottom', 'neve' ),
				'description' => $this->get_property( 'description' ),
			),
		];
	}

	/**
	 * Get upsell components.
	 *
	 * @return array
	 */
	protected function get_upsell_components() {
		if ( $this->has_valid_addons() ) {
			return [];
		}

		return [
			[
				'icon' => 'email',
				'name' => __( 'Contact', 'neve' ),
			],
			[
				'icon' => 'images-alt',
				'name' => __( 'Payment icons', 'neve' ),
			],
			[
				'icon' => 'share',
				'name' => __( 'Social Icons', 'neve' ),
			],
		];
	}
}
