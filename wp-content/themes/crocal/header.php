<!doctype html>

<html class="no-js" <?php language_attributes(); ?>>

	<head>
		<meta charset="<?php echo esc_attr( get_bloginfo( 'charset' ) ); ?>">
		<?php if ( is_singular() && pings_open( get_queried_object() ) ) { ?>
		<!-- allow pinned sites -->
		<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
		<?php } ?>
		<?php wp_head(); ?>
	</head>

	<?php
		$crocal_eutf_header_mode = crocal_eutf_option( 'header_mode', 'default' );
		$crocal_eutf_header_fullwidth = crocal_eutf_option( 'header_fullwidth', '1' );
		$crocal_eutf_header_data = crocal_eutf_get_feature_header_data();
		$crocal_eutf_header_style = $crocal_eutf_header_data['header_style'];
		$crocal_eutf_header_overlapping = $crocal_eutf_header_data['data_overlap'];
		$crocal_eutf_responsive_header_overlapping = crocal_eutf_option( 'responsive_header_overlapping', 'no' );
		$crocal_eutf_header_position = $crocal_eutf_header_data['data_header_position'];
		$crocal_eutf_menu_open_type = crocal_eutf_option( 'header_menu_open_type', 'toggle' );

		// Theme Layout
		$crocal_eutf_theme_layout = crocal_eutf_option( 'theme_layout', 'stretched' );
		$crocal_eutf_frame_size = crocal_eutf_option( 'frame_size', 30 );

		//Sticky Header
		$crocal_eutf_header_sticky_type = crocal_eutf_option( 'header_sticky_type', 'simple' );
		$crocal_eutf_header_sticky_height = crocal_eutf_option( 'header_sticky_shrink_height', '0' );


		if ( is_singular() ) {
			$crocal_eutf_header_sticky_type = crocal_eutf_post_meta( '_crocal_eutf_sticky_header_type', $crocal_eutf_header_sticky_type );
			$crocal_eutf_responsive_header_overlapping = crocal_eutf_post_meta( '_crocal_eutf_responsive_header_overlapping', $crocal_eutf_responsive_header_overlapping );
		} else if ( crocal_eutf_is_woo_shop() ) {
			$crocal_eutf_header_sticky_type = crocal_eutf_post_meta_shop( '_crocal_eutf_sticky_header_type', $crocal_eutf_header_sticky_type );
			$crocal_eutf_responsive_header_overlapping = crocal_eutf_post_meta_shop( '_crocal_eutf_responsive_header_overlapping', $crocal_eutf_responsive_header_overlapping );
		}
		$crocal_eutf_header_sticky_type = crocal_eutf_visibility( 'header_sticky_enabled' ) ? $crocal_eutf_header_sticky_type : 'none';
		if( 'simple' == $crocal_eutf_header_sticky_type && 'default' == $crocal_eutf_header_mode) {
			$crocal_eutf_header_sticky_height = crocal_eutf_option( 'header_height' );
		}
		if( 'simple' == $crocal_eutf_header_sticky_type && 'logo-top' == $crocal_eutf_header_mode) {
			$crocal_eutf_header_sticky_height = crocal_eutf_option( 'header_bottom_height' );
		}

		$crocal_eutf_header_menu_mode = crocal_eutf_option( 'header_menu_mode', 'default' );

		$crocal_eutf_menu_type = 'classic';

		if ( 'default' == $crocal_eutf_header_mode ) {
			if ( 'logo-center' == $crocal_eutf_header_menu_mode  ) {
				$crocal_eutf_logo_align = 'center';
			} else {
				$crocal_eutf_logo_align = 'left';
			}
			if ( 'split' == $crocal_eutf_header_menu_mode ) {
				$crocal_eutf_menu_align = 'center';
			} else if ( 'logo-center' == $crocal_eutf_header_menu_mode  ) {
				$crocal_eutf_menu_align = crocal_eutf_option( 'logo_center_menu_align', 'right' );
			} else {
				$crocal_eutf_menu_align = crocal_eutf_option( 'menu_align', 'right' );
			}
			$crocal_eutf_menu_type = crocal_eutf_option( 'menu_type', 'classic' );
			if ( is_singular() ) {
				$crocal_eutf_menu_type = crocal_eutf_post_meta( '_crocal_eutf_menu_type', $crocal_eutf_menu_type );
			} else if ( crocal_eutf_is_woo_shop() ) {
				$crocal_eutf_menu_type = crocal_eutf_post_meta_shop( '_crocal_eutf_menu_type', $crocal_eutf_menu_type );
			}
		} else if ( 'logo-top' == $crocal_eutf_header_mode ) {
			$crocal_eutf_logo_align = crocal_eutf_option( 'header_top_logo_align', 'center' );
			$crocal_eutf_menu_align = crocal_eutf_option( 'header_top_menu_align', 'center' );
			$crocal_eutf_menu_type = crocal_eutf_option( 'header_top_logo_menu_type', 'classic' );
			if ( is_singular() ) {
				$crocal_eutf_menu_type = crocal_eutf_post_meta( '_crocal_eutf_menu_type', $crocal_eutf_menu_type );
			} else if ( crocal_eutf_is_woo_shop() ) {
				$crocal_eutf_menu_type = crocal_eutf_post_meta_shop( '_crocal_eutf_menu_type', $crocal_eutf_menu_type );
			}
		} else {
			$crocal_eutf_header_fullwidth = 0;
			$crocal_eutf_header_overlapping = 'no';
			$crocal_eutf_header_sticky_type = 'none';
			$crocal_eutf_menu_align = crocal_eutf_option( 'header_side_menu_align', 'left' );
			$crocal_eutf_logo_align = crocal_eutf_option( 'header_side_logo_align', 'left' );
		}
		//Header Classes
		$crocal_eutf_header_classes = array();
		if ( 1 == $crocal_eutf_header_fullwidth ) {
			$crocal_eutf_header_classes[] = 'eut-fullwidth';
		}
		if ( 'yes' == $crocal_eutf_header_overlapping ) {
			$crocal_eutf_header_classes[] = 'eut-overlapping';
		}
		if ( 'yes' == $crocal_eutf_responsive_header_overlapping ) {
			$crocal_eutf_header_classes[] = 'eut-responsive-overlapping';
		}
		if( 'below' == $crocal_eutf_header_position ) {
			$crocal_eutf_header_classes[] = 'eut-header-below';
		}
		if( 'advanced-hidden' == $crocal_eutf_menu_type ){
			$crocal_eutf_header_classes[] = 'eut-advanced-hidden-menu';
		}
		if ( 'split' == $crocal_eutf_header_menu_mode ) {
			$crocal_eutf_header_classes[] = 'eut-header-split-menu';
		}
		if ( 'logo-center' == $crocal_eutf_header_menu_mode ) {
			$crocal_eutf_header_classes[] = 'eut-header-logo-center';
		}
		$crocal_eutf_header_class_string = implode( ' ', $crocal_eutf_header_classes );

		$crocal_eutf_sidearea_data = crocal_eutf_get_sidearea_data();

		//Main Header Classes
		$crocal_eutf_main_header_classes = array();
		$crocal_eutf_main_header_classes[] = 'eut-header-' . $crocal_eutf_header_mode;
		if ( 'side' == $crocal_eutf_header_mode ) {
			$crocal_eutf_main_header_classes[] = 'eut-' . $crocal_eutf_menu_open_type . '-menu';
		} else {
			$crocal_eutf_main_header_classes[] = 'eut-' . $crocal_eutf_header_style;
		}
		if ( 'side' != $crocal_eutf_header_mode || 'none' != $crocal_eutf_header_sticky_type ) {
			$crocal_eutf_main_header_classes[] = 'eut-' . $crocal_eutf_header_sticky_type . '-sticky';
		}

		$crocal_eutf_header_main_class_string = implode( ' ', $crocal_eutf_main_header_classes );

		$crocal_eutf_menu_arrows = crocal_eutf_option( 'submenu_pointer', 'none' );

		// Main Menu Classes
		$crocal_eutf_main_menu_classes = array();
		if ( 'side' != $crocal_eutf_header_mode ) {
			$crocal_eutf_main_menu_classes[] = 'eut-horizontal-menu';
			if ( 'default' == $crocal_eutf_header_mode && 'split' == $crocal_eutf_header_menu_mode  ) {
				$crocal_eutf_main_menu_classes[] = 'eut-split-menu';
			}
			$crocal_eutf_main_menu_classes[] = 'eut-position-' . $crocal_eutf_menu_align;
			if( 'none' != $crocal_eutf_menu_arrows ) {
				$crocal_eutf_main_menu_classes[] = 'eut-' . $crocal_eutf_menu_arrows;
			}
			if ( 'hidden' != $crocal_eutf_menu_type ){
				$crocal_eutf_main_menu_classes[] = 'eut-menu-type-' . $crocal_eutf_menu_type;
			}
		} else {
			$crocal_eutf_main_menu_classes[] = 'eut-vertical-menu';
			$crocal_eutf_main_menu_classes[] = 'eut-align-' . $crocal_eutf_menu_align;
		}
		$crocal_eutf_main_menu_classes[] = 'eut-main-menu';
		$crocal_eutf_main_menu_class_string = implode( ' ', $crocal_eutf_main_menu_classes );

		$crocal_eutf_main_menu = crocal_eutf_get_header_nav();


		$crocal_eutf_header_sticky_devices_enabled = crocal_eutf_option( 'header_sticky_devices_enabled' );
		$crocal_eutf_header_sticky_devices = 'no';
		if ( '1' == $crocal_eutf_header_sticky_devices_enabled ) {
			$crocal_eutf_header_sticky_devices = 'yes';
		}

	?>

	<body <?php body_class(); ?>>
		<?php do_action( 'crocal_eutf_body_top' ); ?>
		<?php if ( 'framed' == $crocal_eutf_theme_layout ) { ?>
		<div id="eut-frames" data-frame-size="<?php echo esc_attr( $crocal_eutf_frame_size ); ?>">
			<div class="eut-frame eut-top"></div>
			<div class="eut-frame eut-left"></div>
			<div class="eut-frame eut-right"></div>
			<div class="eut-frame eut-bottom"></div>
		</div>
		<?php } ?>
		<?php crocal_eutf_print_theme_loader(); ?>
		<?php
			// Theme Wrapper Classes
			$crocal_eutf_theme_wrapper_classes = array();
			if ( 'side' == $crocal_eutf_header_mode ) {
				$crocal_eutf_theme_wrapper_classes[] = 'eut-header-side';
			}
			if( 'below' == $crocal_eutf_header_position && 'yes' == $crocal_eutf_header_overlapping ) {
				$crocal_eutf_theme_wrapper_classes[] = 'eut-feature-below';
			}

			$crocal_eutf_content_skin = '';
			if ( is_singular() ) {
				$crocal_eutf_content_skin_options = crocal_eutf_post_meta( '_crocal_eutf_content_skin_options' );
				$crocal_eutf_content_skin = crocal_eutf_array_value( $crocal_eutf_content_skin_options, 'skin' );
			} else if ( crocal_eutf_is_woo_shop() ) {
				$crocal_eutf_content_skin_options = crocal_eutf_post_meta_shop( '_crocal_eutf_content_skin_options' );
				$crocal_eutf_content_skin = crocal_eutf_array_value( $crocal_eutf_content_skin_options, 'skin' );
			}
			if( !empty( $crocal_eutf_content_skin ) ) {
				$crocal_eutf_theme_wrapper_classes[] = 'eut-skin-' . esc_attr( $crocal_eutf_content_skin );
			}
			$crocal_eutf_theme_wrapper_class_string = implode( ' ', $crocal_eutf_theme_wrapper_classes );
		?>

		<!-- Theme Wrapper -->
		<div id="eut-theme-wrapper" class="<?php echo esc_attr( $crocal_eutf_theme_wrapper_class_string ); ?>" data-mask-layer="2">
			<div class="eut-wrapper-inner">
			<?php
				//Top Bar
				crocal_eutf_print_header_top_bar();
				//FEATURE Header Below
				if( 'below' == $crocal_eutf_header_position ) {
					crocal_eutf_print_header_feature();
				}
			?>

			<!-- HEADER -->
			<header id="eut-header" class="<?php echo esc_attr( $crocal_eutf_header_class_string ); ?>" data-sticky="<?php echo esc_attr( $crocal_eutf_header_sticky_type ); ?>" data-sticky-height="<?php echo esc_attr( $crocal_eutf_header_sticky_height ); ?>" data-devices-sticky="<?php echo esc_attr( $crocal_eutf_header_sticky_devices ); ?>">
				<div class="eut-wrapper clearfix">

					<!-- Header -->
					<div id="eut-main-header" class="<?php echo esc_attr( $crocal_eutf_header_main_class_string ); ?>">
					<?php
						if ( 'side' == $crocal_eutf_header_mode ) {
					?>
						<div class="eut-main-header-wrapper clearfix">
							<div class="eut-content">
								<?php do_action( 'crocal_eutf_side_logo_before' ); ?>
								<?php crocal_eutf_print_logo( 'side', $crocal_eutf_logo_align ); ?>
								<?php do_action( 'crocal_eutf_side_logo_after' ); ?>
								<?php if ( $crocal_eutf_main_menu != 'disabled' ) { ?>
								<!-- Main Menu -->
								<nav id="eut-main-menu" class="<?php echo esc_attr( $crocal_eutf_main_menu_class_string ); ?>">
									<div class="eut-wrapper">
										<?php crocal_eutf_header_nav( $crocal_eutf_main_menu ); ?>
									</div>
								</nav>
								<!-- End Main Menu -->
								<?php } ?>
							</div>
						</div>
						<div class="eut-header-elements-wrapper eut-align-<?php echo esc_attr( $crocal_eutf_menu_align); ?>">
							<?php crocal_eutf_print_header_elements(); ?>
							<?php crocal_eutf_print_header_text(); ?>
						</div>
						<?php crocal_eutf_print_side_header_bg_image(); ?>
					<?php
						} else if ( 'logo-top' == $crocal_eutf_header_mode ) {
						//Log on Top Header
					?>
						<div id="eut-top-header">
							<div class="eut-wrapper clearfix">
								<div class="eut-container">
									<?php do_action( 'crocal_eutf_top_logo_before' ); ?>
									<?php crocal_eutf_print_logo( 'logo-top', $crocal_eutf_logo_align ); ?>
									<?php do_action( 'crocal_eutf_top_logo_after' ); ?>
								</div>
							</div>
						</div>
						<div id="eut-bottom-header">
							<div class="eut-wrapper clearfix">
								<div class="eut-container">
									<div class="eut-header-elements-wrapper eut-position-right">
								<?php
									if ( 'hidden' == $crocal_eutf_menu_type && 'disabled' != $crocal_eutf_main_menu ) {
										crocal_eutf_print_header_hiddenarea_button();
									}
									crocal_eutf_print_header_elements();
									crocal_eutf_print_header_text();
								?>
									</div>
								<?php
									if ( 'hidden' != $crocal_eutf_menu_type && $crocal_eutf_main_menu != 'disabled' ) {
								?>
										<!-- Main Menu -->
										<nav id="eut-main-menu" class="<?php echo esc_attr( $crocal_eutf_main_menu_class_string ); ?>">
											<div class="eut-wrapper">
												<?php crocal_eutf_header_nav( $crocal_eutf_main_menu ); ?>
											</div>
										</nav>
										<!-- End Main Menu -->
								<?php
									}
								?>
								</div>
							</div>
						</div>
					<?php
						} else {
						//Default Header
					?>
						<div class="eut-wrapper clearfix">
							<div class="eut-container">
							<?php if ( 'default' == $crocal_eutf_header_menu_mode || 'logo-center' == $crocal_eutf_header_menu_mode || 'hidden' == $crocal_eutf_menu_type || 'disabled' == $crocal_eutf_main_menu  ) { ?>
								<?php do_action( 'crocal_eutf_default_logo_before' ); ?>
								<?php crocal_eutf_print_logo( 'default', $crocal_eutf_logo_align ); ?>
								<?php do_action( 'crocal_eutf_default_logo_after' ); ?>
							<?php } ?>
								<?php if ( 'advanced-hidden' == $crocal_eutf_menu_type && 'disabled' != $crocal_eutf_main_menu ) { ?>
									<div class="eut-hidden-menu-btn eut-position-right">
										<div class="eut-header-element">
											<a href="#">
												<span class="eut-item">
													<span></span>
													<span></span>
													<span></span>
												</span>
											</a>
										</div>
									</div>
								<?php } ?>
								<div class="eut-header-elements-wrapper eut-position-right">
							<?php
								if ( 'hidden' == $crocal_eutf_menu_type && 'disabled' != $crocal_eutf_main_menu ) {
									crocal_eutf_print_header_hiddenarea_button();
								}
								crocal_eutf_print_header_elements();
								crocal_eutf_print_header_text();
							?>
								</div>
							<?php
								if ( 'hidden' != $crocal_eutf_menu_type && $crocal_eutf_main_menu != 'disabled' ) {
							?>
									<!-- Main Menu -->
									<nav id="eut-main-menu" class="<?php echo esc_attr( $crocal_eutf_main_menu_class_string ); ?>">
										<div class="eut-wrapper">
											<?php crocal_eutf_header_nav( $crocal_eutf_main_menu, $crocal_eutf_header_menu_mode ); ?>
										</div>
									</nav>
									<!-- End Main Menu -->
							<?php
								}
							?>
							</div>
						</div>
					<?php
						}
					?>

					</div>
					<!-- End Header -->

					<!-- Responsive Header -->
					<div id="eut-responsive-header">
						<div id="eut-main-responsive-header" class="eut-wrapper clearfix">
							<div class="eut-container">
							<?php do_action( 'crocal_eutf_responsive_logo_before' ); ?>
							<?php crocal_eutf_print_logo( 'responsive' , 'left' ); ?>
							<?php do_action( 'crocal_eutf_responsive_logo_after' ); ?>
								<div class="eut-header-elements-wrapper eut-position-right">
								<?php do_action( 'crocal_eutf_responsive_elements_first' ); ?>
								<!-- Hidden Menu & Side Area Button -->
								<?php
									if ( 'disabled' != $crocal_eutf_main_menu || crocal_eutf_check_header_elements_visibility_any() ){
										crocal_eutf_print_header_hiddenarea_button();
									}
								?>
								<?php crocal_eutf_print_login_responsive_button(); ?>
								<?php crocal_eutf_print_cart_responsive_link(); ?>
								<!-- End Hidden Menu  -->
								<?php do_action( 'crocal_eutf_responsive_elements_last' ); ?>
								</div>
							</div>
						</div>
					</div>
					<!-- End Responsive Header -->
				</div>

				<!-- Crocal Sticky Header -->
			<?php
				if ( 'side' != $crocal_eutf_header_mode && 'crocal' == $crocal_eutf_header_sticky_type ) {

				// Crocal Sticky Menu Classes
				$crocal_eutf_crocal_sticky_menu_classes = array();

				$crocal_eutf_crocal_sticky_menu_classes[] = 'eut-horizontal-menu';
				$crocal_eutf_crocal_sticky_menu_classes[] = 'eut-position-' . $crocal_eutf_menu_align;
				$crocal_eutf_crocal_sticky_menu_classes[] = 'eut-main-menu';
				if( 'none' != $crocal_eutf_menu_arrows ) {
					$crocal_eutf_crocal_sticky_menu_classes[] = 'eut-' . $crocal_eutf_menu_arrows;
				}
				if ( 'hidden' != $crocal_eutf_menu_type ){
					$crocal_eutf_crocal_sticky_menu_classes[] = 'eut-menu-type-' . $crocal_eutf_menu_type;
				}

				$crocal_eutf_crocal_sticky_menu_class_string = implode( ' ', $crocal_eutf_crocal_sticky_menu_classes );

			?>
				<div id="eut-crocal-sticky-header" class="eut-fullwidth">
					<div class="eut-wrapper clearfix">
						<div class="eut-container">

						<?php crocal_eutf_print_logo( 'crocal-sticky' , 'left' ); ?>
						<div class="eut-header-elements-wrapper eut-position-right">
							<?php crocal_eutf_print_header_elements(); ?>
						</div>
						<?php
							if ( 'hidden' != $crocal_eutf_menu_type && $crocal_eutf_main_menu != 'disabled' ) {
						?>
							<!-- Main Menu -->
							<nav id="eut-crocal-sticky-menu" class="<?php echo esc_attr( $crocal_eutf_crocal_sticky_menu_class_string ); ?>">
								<div class="eut-wrapper">
									<?php crocal_eutf_header_nav( $crocal_eutf_main_menu ); ?>
								</div>
							</nav>
							<!-- End Main Menu -->
						<?php
							}
						?>

						</div>
					</div>

				</div>
			<?php
				}
			?>
				<!-- End Crocal Sticky Header -->

			</header>
			<!-- END HEADER -->
			<?php do_action( 'crocal_eutf_header_after' ); ?>
			<div id="eut-theme-content">

			<?php
				//FEATURE Header Above
				if( 'above' == $crocal_eutf_header_position ) {
					crocal_eutf_print_header_feature();
				}


//Omit closing PHP tag to avoid accidental whitespace output errors.
