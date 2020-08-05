				</div> <!-- end #eut-theme-content -->

				<!-- CART AREA -->
				<?php crocal_eutf_print_cart_area(); ?>
				<!-- END CART AREA -->

				<!-- HIDDEN MENU -->
				<?php crocal_eutf_print_hidden_menu(); ?>
				<!-- END HIDDEN MENU -->

				<?php crocal_eutf_print_search_modal(); ?>
				<?php crocal_eutf_print_form_modals(); ?>
				<?php crocal_eutf_print_language_modal(); ?>
				<?php crocal_eutf_print_login_modal(); ?>
				<?php crocal_eutf_print_social_modal(); ?>

				<?php do_action( 'crocal_eutf_footer_modal_container' ); ?>

				<?php crocal_eutf_print_back_top(); ?>
			</div>
		</div> <!-- end #eut-theme-wrapper -->

		<!-- SIDE AREA -->
		<?php
			$crocal_eutf_sidearea_data = crocal_eutf_get_sidearea_data();
			crocal_eutf_print_sidearea_button( $crocal_eutf_sidearea_data );
			crocal_eutf_print_side_area( $crocal_eutf_sidearea_data );
		?>
		<!-- END SIDE AREA -->

		<?php wp_footer(); // js scripts are inserted using this function ?>

	</body>

</html>