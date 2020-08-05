<?php
/*
Template Name: Scrolling Full Screen Sections
*/
?>
<?php get_header(); ?>

<?php the_post(); ?>

<?php

	$scrolling_page = crocal_eutf_post_meta( '_crocal_eutf_scrolling_page' );
	$responsive_scrolling_page = crocal_eutf_post_meta( '_crocal_eutf_responsive_scrolling', 'yes' );
	$scrolling_lock_anchors = crocal_eutf_post_meta( '_crocal_eutf_scrolling_lock_anchors', 'yes' );
	$scrolling_loop = crocal_eutf_post_meta( '_crocal_eutf_scrolling_loop', 'none' );
	$scrolling_speed = crocal_eutf_post_meta( '_crocal_eutf_scrolling_speed', 1000 );

	$wrapper_attributes = array();
	if( 'pilling' == $scrolling_page ) {
		$scrolling_page_id = 'eut-pilling-page';
		$scrolling_direction = crocal_eutf_post_meta( '_crocal_eutf_scrolling_direction', 'vertical' );
		$wrapper_attributes[] = 'data-scroll-direction="' . esc_attr( $scrolling_direction ) . '"';
	} else {
		$scrolling_page_id = 'eut-fullpage';
	}
	$wrapper_attributes[] = 'id="' . esc_attr( $scrolling_page_id ) . '"';
	$wrapper_attributes[] = 'data-device-scrolling="' . esc_attr( $responsive_scrolling_page ) . '"';
	$wrapper_attributes[] = 'data-lock-anchors="' . esc_attr( $scrolling_lock_anchors ) . '"';
	$wrapper_attributes[] = 'data-scroll-loop="' . esc_attr( $scrolling_loop ) . '"';
	$wrapper_attributes[] = 'data-scroll-speed="' . esc_attr( $scrolling_speed ) . '"';

?>

				<!-- CONTENT -->
				<div id="eut-content" class="clearfix">
					<div class="eut-content-wrapper">
						<!-- MAIN CONTENT -->
						<div id="eut-main-content">
							<div class="eut-main-content-wrapper eut-padding-none clearfix">

								<!-- PAGE CONTENT -->
								<div id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
										<div <?php echo implode( ' ', $wrapper_attributes ); ?>>
										<?php the_content(); ?>
									</div>
								</div>
								<!-- END PAGE CONTENT -->

							</div>
						</div>
						<!-- END MAIN CONTENT -->

					</div>
				</div>
				<!-- END CONTENT -->
			</div> <!-- end #eut-theme-content -->
			<!-- SIDE AREA -->
			<?php
				$crocal_eutf_sidearea_data = crocal_eutf_get_sidearea_data();
				crocal_eutf_print_side_area( $crocal_eutf_sidearea_data );
			?>
			<!-- END SIDE AREA -->

			<!-- HIDDEN MENU -->
			<?php crocal_eutf_print_hidden_menu(); ?>
			<!-- END HIDDEN MENU -->

			<?php crocal_eutf_print_search_modal(); ?>
			<?php crocal_eutf_print_form_modals(); ?>
			<?php crocal_eutf_print_language_modal(); ?>
			<?php crocal_eutf_print_login_modal(); ?>
			<?php crocal_eutf_print_social_modal(); ?>


		</div> <!-- end #eut-theme-wrapper -->

		<?php wp_footer(); // js scripts are inserted using this function ?>

	</body>

</html>