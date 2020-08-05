<?php
/*
Template Name: Header and Feature Only
*/
?>
<?php get_header(); ?>

<?php the_post(); ?>
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