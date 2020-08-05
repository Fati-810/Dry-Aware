<?php

/*
*	Footer Helper functions
*
* 	@version	1.0
* 	@author		Euthemians Team
* 	@URI		http://euthemians.com
*/


/**
 * Prints Footer Background Image
 */
if ( !function_exists('crocal_eutf_print_footer_bg_image') ) {
	function crocal_eutf_print_footer_bg_image() {
		if ( 'custom' == crocal_eutf_option( 'footer_bg_mode' ) ) {
			$crocal_eutf_footer_custom_bg = array(
				'bg_mode' => 'custom',
				'bg_image_id' => crocal_eutf_option( 'footer_bg_image', '', 'id' ),
				'bg_position' => crocal_eutf_option( 'footer_bg_position', 'center-center' ),
				'pattern_overlay' => crocal_eutf_option( 'footer_pattern_overlay' ),
				'color_overlay' => crocal_eutf_option( 'footer_color_overlay' ),
				'opacity_overlay' => crocal_eutf_option( 'footer_opacity_overlay' ),
			);
			crocal_eutf_print_title_bg_image( $crocal_eutf_footer_custom_bg );
		}
	}
}

/**
 * Prints Footer Widgets
 */
if ( !function_exists('crocal_eutf_print_footer_widgets') ) {
	function crocal_eutf_print_footer_widgets() {
		$crocal_section_visibility = 'no';
		if ( crocal_eutf_visibility( 'footer_widgets_visibility' ) ) {
			$crocal_section_visibility = 'yes';
		}
		if ( is_singular() ) {
			$crocal_section_visibility = crocal_eutf_post_meta( '_crocal_eutf_footer_widgets_visibility', $crocal_section_visibility );
		} else if( crocal_eutf_is_woo_shop() ) {
			$crocal_section_visibility = crocal_eutf_post_meta_shop( '_crocal_eutf_footer_widgets_visibility', $crocal_section_visibility );
		}

		if ( 'yes' == $crocal_section_visibility ) {

			$crocal_eutf_footer_columns = crocal_eutf_option('footer_widgets_layout');

			switch( $crocal_eutf_footer_columns ) {
				case 'footer-1':
					$footer_sidebars = array(
						array(
							'sidebar-id' => 'eut-footer-1-sidebar',
							'column' => '1-4',
							'tablet-column' => '1-2',
						),
						array(
							'sidebar-id' => 'eut-footer-2-sidebar',
							'column' => '1-4',
							'tablet-column' => '1-2',
						),
						array(
							'sidebar-id' => 'eut-footer-3-sidebar',
							'column' => '1-4',
							'tablet-column' => '1-2',
						),
						array(
							'sidebar-id' => 'eut-footer-4-sidebar',
							'column' => '1-4',
							'tablet-column' => '1-2',
						),
					);
				break;
				case 'footer-2':
					$footer_sidebars = array(
						array(
							'sidebar-id' => 'eut-footer-1-sidebar',
							'column' => '1-2',
							'tablet-column' => '1',
						),
						array(
							'sidebar-id' => 'eut-footer-2-sidebar',
							'column' => '1-4',
							'tablet-column' => '1-2',
						),
						array(
							'sidebar-id' => 'eut-footer-3-sidebar',
							'column' => '1-4',
							'tablet-column' => '1-2',
						),
					);
				break;
				case 'footer-3':
					$footer_sidebars = array(
						array(
							'sidebar-id' => 'eut-footer-1-sidebar',
							'column' => '1-4',
							'tablet-column' => '1-2',
						),
						array(
							'sidebar-id' => 'eut-footer-2-sidebar',
							'column' => '1-4',
							'tablet-column' => '1-2',
						),
						array(
							'sidebar-id' => 'eut-footer-3-sidebar',
							'column' => '1-2',
							'tablet-column' => '1',
						),
					);
				break;
				case 'footer-4':
					$footer_sidebars = array(
						array(
							'sidebar-id' => 'eut-footer-1-sidebar',
							'column' => '1-2',
							'tablet-column' => '1-2',
						),
						array(
							'sidebar-id' => 'eut-footer-2-sidebar',
							'column' => '1-2',
							'tablet-column' => '1-2',
						),
					);
				break;
				case 'footer-5':
					$footer_sidebars = array(
						array(
							'sidebar-id' => 'eut-footer-1-sidebar',
							'column' => '1-3',
							'tablet-column' => '1-3',
						),
						array(
							'sidebar-id' => 'eut-footer-2-sidebar',
							'column' => '1-3',
							'tablet-column' => '1-3',
						),
						array(
							'sidebar-id' => 'eut-footer-3-sidebar',
							'column' => '1-3',
							'tablet-column' => '1-3',
						),
					);
				break;
				case 'footer-6':
					$footer_sidebars = array(
						array(
							'sidebar-id' => 'eut-footer-1-sidebar',
							'column' => '2-3',
							'tablet-column' => '1-2',
						),
						array(
							'sidebar-id' => 'eut-footer-2-sidebar',
							'column' => '1-3',
							'tablet-column' => '1-2',
						),
					);
				break;
				case 'footer-7':
					$footer_sidebars = array(
						array(
							'sidebar-id' => 'eut-footer-1-sidebar',
							'column' => '1-3',
							'tablet-column' => '1-2',
						),
						array(
							'sidebar-id' => 'eut-footer-2-sidebar',
							'column' => '2-3',
							'tablet-column' => '1-2',
						),
					);
				break;
				case 'footer-8':
					$footer_sidebars = array(
						array(
							'sidebar-id' => 'eut-footer-1-sidebar',
							'column' => '1-4',
							'tablet-column' => '1-3',
						),
						array(
							'sidebar-id' => 'eut-footer-2-sidebar',
							'column' => '1-2',
							'tablet-column' => '1-3',
						),
						array(
							'sidebar-id' => 'eut-footer-3-sidebar',
							'column' => '1-4',
							'tablet-column' => '1-3',
						),
					);
				break;
				case 'footer-9':
				default:
					$footer_sidebars = array(
						array(
							'sidebar-id' => 'eut-footer-1-sidebar',
							'column' => '1',
							'tablet-column' => '1',
						),
					);
				break;
			}

			$section_type = crocal_eutf_option( 'footer_section_type', 'fullwidth-background' );

			$crocal_eutf_footer_class = array( 'eut-widget-area' );

			if( 'fullwidth-element' == $section_type ) {
				$crocal_eutf_footer_class[] = 'eut-fullwidth';
			}
			$crocal_eutf_footer_class_string = implode( ' ', $crocal_eutf_footer_class );

			$footer_padding_top = crocal_eutf_option( 'footer_padding_top_multiplier', '3x' );
			$footer_padding_bottom = crocal_eutf_option( 'footer_padding_bottom_multiplier', '3x' );

	?>
			<!-- Footer -->
			<div class="<?php echo esc_attr( $crocal_eutf_footer_class_string ); ?>">
				<div class="eut-container eut-padding-top-<?php echo esc_attr( $footer_padding_top ); ?> eut-padding-bottom-<?php echo esc_attr( $footer_padding_bottom ); ?> ">
					<div class="eut-row eut-columns-gap-30">
		<?php

					foreach ( $footer_sidebars as $footer_sidebar ) {
						echo '<div class="eut-column eut-column-' . $footer_sidebar['column'] . ' eut-tablet-column-' . $footer_sidebar['tablet-column'] . '">';
						echo '<div class="eut-column-wrapper">';
						dynamic_sidebar( $footer_sidebar['sidebar-id'] );
						echo '</div>';
						echo '</div>';
					}
		?>
					</div>
				</div>
			</div>
	<?php

		}
	}
}

/**
 * Prints Footer Bar Area
 */

if ( !function_exists('crocal_eutf_print_footer_bar') ) {
	function crocal_eutf_print_footer_bar() {
		$crocal_section_visibility = 'no';
		if ( crocal_eutf_visibility( 'footer_bar_visibility' ) ) {
			$crocal_section_visibility = 'yes';
		}
		if ( is_singular() ) {
			$crocal_section_visibility = crocal_eutf_post_meta( '_crocal_eutf_footer_bar_visibility', $crocal_section_visibility );
		} else if( crocal_eutf_is_woo_shop() ) {
			$crocal_section_visibility = crocal_eutf_post_meta_shop( '_crocal_eutf_footer_bar_visibility', $crocal_section_visibility );
		}

		if ( 'yes' == $crocal_section_visibility ) {

			$section_type = crocal_eutf_option( 'footer_bar_section_type', 'fullwidth-background' );

			$crocal_eutf_footer_bar_class = array( 'eut-footer-bar', 'eut-padding-top-1x', 'eut-padding-bottom-1x' );

			if( 'fullwidth-element' == $section_type ) {
				$crocal_eutf_footer_bar_class[] = 'eut-fullwidth';
			}
			$crocal_eutf_footer_bar_class_string = implode( ' ', $crocal_eutf_footer_bar_class );

			$align_center = crocal_eutf_option( 'footer_bar_align_center', 'no' );
			$second_area = crocal_eutf_option( 'second_area_visibility', '1' );
	?>

			<div class="<?php echo esc_attr( $crocal_eutf_footer_bar_class_string ); ?>" data-align-center="<?php echo esc_attr( $align_center ); ?>">
				<div class="eut-container">
					<?php if ( crocal_eutf_visibility( 'footer_copyright_visibility' ) ) { ?>
					<div class="eut-bar-content eut-left-side">
						<div class="eut-copyright">
							<?php echo do_shortcode( wp_kses_post( crocal_eutf_option( 'footer_copyright_text' ) ) ); ?>
						</div>
					</div>
					<?php } ?>
					<?php if ( '2' == $second_area ) { ?>
					<div class="eut-bar-content eut-right-side">
						<nav class="eut-footer-menu">
							<?php crocal_eutf_footer_nav(); ?>
						</nav>
					</div>
					<?php
					} else if ( '3' == $second_area ) { ?>
					<div class="eut-bar-content eut-right-side">
						<?php
						global $crocal_eutf_social_list_extended;
						$options = crocal_eutf_option('footer_social_options');
						$social_display = crocal_eutf_option('footer_social_display', 'text');
						$social_options = crocal_eutf_option('social_options');

						if ( !empty( $options ) && !empty( $social_options ) ) {
							if ( 'text' == $social_display ) {
								echo '<ul class="eut-social">';
								foreach ( $social_options as $key => $value ) {
									if ( isset( $options[$key] ) && 1 == $options[$key] && $value ) {
										if ( 'skype' == $key ) {
											echo '<li><a href="' . esc_url( $value, array( 'skype', 'http', 'https' ) ) . '">' . esc_html( $crocal_eutf_social_list_extended[$key]['title'] ) . '</a></li>';
										} else {
											echo '<li><a href="' . esc_url( $value ) . '" target="_blank">' . esc_html( $crocal_eutf_social_list_extended[$key]['title'] ) . '</a></li>';
										}
									}
								}
								echo '</ul>';
							} else {
								echo '<ul class="eut-social eut-social-icons">';
								foreach ( $social_options as $key => $value ) {
									if ( isset( $options[$key] ) && 1 == $options[$key] && $value ) {
										if ( 'skype' == $key ) {
											echo '<li><a href="' . esc_url( $value, array( 'skype', 'http', 'https' ) ) . '" class="' . esc_attr( $crocal_eutf_social_list_extended[$key]['class'] ) . '"></a></li>';
										} else {
											echo '<li><a href="' . esc_url( $value ) . '" target="_blank" class="' . esc_attr( $crocal_eutf_social_list_extended[$key]['class'] ) . '"></a></li>';
										}
									}
								}
								echo '</ul>';
							}
						}
						?>
					</div>
					<?php
					} else if ( '4' == $second_area ) { ?>
					<div class="eut-bar-content eut-right-side">
						<div class="eut-copyright">
							<?php echo do_shortcode( wp_kses_post( crocal_eutf_option( 'footer_second_copyright_text' ) ) ); ?>
						</div>
					</div>
					<?php
					}
					?>
				</div>
			</div>

	<?php
		}
	}
}

/**
 * Prints Back To Top Link
 */
if ( !function_exists('crocal_eutf_print_back_top') ) {
	function crocal_eutf_print_back_top() {
		if ( ( is_singular() && 'yes' == crocal_eutf_post_meta( '_crocal_eutf_disable_back_to_top' ) ) || ( crocal_eutf_is_woo_shop() && 'yes' == crocal_eutf_post_meta_shop( '_crocal_eutf_disable_back_to_top' ) ) ) {
			return;
		}

		if ( crocal_eutf_visibility( 'back_to_top_enabled' )  ) {

			$crocal_eutf_back_to_top_shape = crocal_eutf_option( 'back_to_top_shape', 'none' );
			$crocal_eutf_back_to_top_speed = crocal_eutf_option( 'back_to_top_speed', 'height-based' );

			$crocal_eutf_back_to_top_icon_wrapper_classes = array('eut-arrow-wrapper');
			if( 'none' != $crocal_eutf_back_to_top_shape ){
				$crocal_eutf_back_to_top_icon_wrapper_classes[] = 'eut-' . $crocal_eutf_back_to_top_shape;
				$crocal_eutf_back_to_top_icon_wrapper_classes[] = 'eut-wrapper-color';
			}
			$crocal_eutf_back_to_top_icon_wrapper_class_string = implode( ' ', $crocal_eutf_back_to_top_icon_wrapper_classes );

		?>
			<div class="eut-back-top" data-speed="<?php echo esc_attr( $crocal_eutf_back_to_top_speed ); ?>">
				<div class="<?php echo esc_attr( $crocal_eutf_back_to_top_icon_wrapper_class_string ); ?>">
					<svg class="eut-back-top-icon" width="18px" height="18px" viewBox="0 0 18 18"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon fill="#000000" fill-rule="nonzero" points="10 3.75735931 10 18 8 18 8 3.89949494 3.41421356 8.48528137 2 7.07106781 9.07106781 0 16.1421356 7.07106781 14.7279221 8.48528137"></polygon></g></svg>
				</div>
			</div>
		<?php
		}
	}
}

 /**
 * Prints Bottom Bar
 */
if ( !function_exists('crocal_eutf_print_bottom_bar') ) {
	function crocal_eutf_print_bottom_bar() {

		$crocal_area_id = crocal_eutf_option('bottom_bar_area');
		if ( is_singular() ) {
			$crocal_area_id = crocal_eutf_post_meta( '_crocal_eutf_bottom_bar_area', $crocal_area_id );
		}
		if( crocal_eutf_is_woo_shop() ) {
			$crocal_area_id = crocal_eutf_post_meta_shop( '_crocal_eutf_bottom_bar_area', $crocal_area_id );
		}
		$crocal_area_id = apply_filters( 'wpml_object_id', $crocal_area_id, 'area-item', TRUE  );
		if ( !empty( $crocal_area_id ) && 'none' != $crocal_area_id ) {
			$crocal_content = get_post_field( 'post_content', $crocal_area_id );
	?>
			<!-- BOTTOM BAR -->
			<div id="eut-bottom-bar" class="eut-bookmark"><?php echo apply_filters( 'crocal_eutf_the_content', $crocal_content ); ?></div>
			<!-- END BOTTOM BAR -->
	<?php
		}
	}
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
