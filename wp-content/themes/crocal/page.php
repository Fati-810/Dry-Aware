<?php get_header(); ?>

<?php the_post(); ?>

<?php crocal_eutf_print_header_title( 'page' ); ?>
<?php crocal_eutf_print_header_breadcrumbs( 'page' ); ?>
<?php crocal_eutf_print_anchor_menu( 'page' ); ?>

<?php
	if ( 'yes' == crocal_eutf_post_meta( '_crocal_eutf_disable_content' ) ) {
		get_footer();
	} else {
?>
	<div class="eut-single-wrapper">
		<!-- CONTENT -->
		<div id="eut-content" class="clearfix <?php echo crocal_eutf_sidebar_class( 'page' ); ?>">
			<div class="eut-content-wrapper">
				<!-- MAIN CONTENT -->
				<div id="eut-main-content">
					<div class="eut-main-content-wrapper clearfix">

						<!-- PAGE CONTENT -->
						<div id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
							<?php the_content(); ?>
							<?php wp_link_pages(); ?>
							<?php
								if ( crocal_eutf_visibility( 'page_comments_visibility' ) &&
									'default' == crocal_eutf_option( 'page_comments_position', 'default' ) ) {
									comments_template();
								}
							?>
						</div>
						<!-- END PAGE CONTENT -->
					</div>
				</div>
				<!-- END MAIN CONTENT -->

				<?php crocal_eutf_set_current_view( 'page' ); ?>
				<?php get_sidebar(); ?>

			</div>
		</div>
		<!-- END CONTENT -->

		<?php
			if ( crocal_eutf_visibility( 'page_comments_visibility' ) &&
				'section' == crocal_eutf_option( 'page_comments_position', 'default' ) ) {
		?>
		<div id="eut-comments-section">
			<?php comments_template(); ?>
		</div>
		<?php
			}
		?>

	</div>

	<?php get_footer(); ?>

<?php
	}

//Omit closing PHP tag to avoid accidental whitespace output errors.
