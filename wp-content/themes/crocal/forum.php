<?php get_header(); ?>
<?php the_post(); ?>
<?php crocal_eutf_print_header_title( 'forum' ); ?>

		<!-- CONTENT -->
		<div id="eut-content" class="clearfix <?php echo crocal_eutf_sidebar_class( 'forum' ); ?>">
			<div class="eut-content-wrapper">
				<!-- MAIN CONTENT -->
				<div id="eut-main-content">
					<div class="eut-main-content-wrapper clearfix">

						<!-- PAGE CONTENT -->
						<div id="eut-forum-<?php the_ID(); ?>" <?php post_class(); ?>>
							<div class="eut-container">
								<?php the_content(); ?>
							</div>
						</div>
						<!-- END PAGE CONTENT -->

					</div>
				</div>
				<!-- END MAIN CONTENT -->

				<?php crocal_eutf_set_current_view( 'forum' ); ?>
				<?php get_sidebar(); ?>

			</div>
		</div>
		<!-- END CONTENT -->
<?php get_footer(); ?>