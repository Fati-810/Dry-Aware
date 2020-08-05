<?php get_header(); ?>


<?php crocal_eutf_print_header_title( 'blog' ); ?>
<?php crocal_eutf_print_header_breadcrumbs( 'post' ); ?>

<!-- CONTENT -->
<div id="eut-content" class="clearfix <?php echo crocal_eutf_sidebar_class( 'blog' ); ?>">
	<div class="eut-content-wrapper">
		<!-- MAIN CONTENT -->
		<div id="eut-main-content">
			<div class="eut-main-content-wrapper clearfix">

				<div class="eut-section eut-margin-bottom-none">

					<div class="eut-container">

						<!-- ROW -->
						<div class="eut-row">

							<!-- COLUMN 1 -->
							<div class="eut-column eut-column-1">
								<div class="eut-column-wrapper">
									<div class="eut-column-content">
										<!-- Blog FitRows -->
										<?php
											$crocal_eutf_blog_mode = crocal_eutf_option( 'blog_mode', 'large' );
											$crocal_eutf_blog_class = crocal_eutf_get_blog_class();
										?>
										<div id="eut-main-blog-loop" class="<?php echo esc_attr( $crocal_eutf_blog_class ); ?>" <?php crocal_eutf_print_blog_data(); ?>>

											<?php
											if ( have_posts() ) :
												if ( 'large' == $crocal_eutf_blog_mode ) {
											?>
												<div class="eut-standard-container">
											<?php
												} else {
											?>
												<div class="eut-isotope-container">
											<?php
												}

											// Start the Loop.
											while ( have_posts() ) : the_post();
												//Get post template
												get_template_part( 'content', get_post_format() );
											endwhile;

											?>
											</div>
											<?php
												// Previous/next post navigation.
												crocal_eutf_paginate_links( 'blog' );
											else :
												// If no content, include the "No posts found" template.
												get_template_part( 'content', 'none' );
											endif;
											?>

										</div>
										<!-- End Element Blog -->
									</div>
								</div>
							</div>
							<!-- END COLUMN 1 -->

						</div>
						<!-- END ROW -->

					</div>

				</div>

			</div>
		</div>
		<!-- End Content -->
		<?php
			crocal_eutf_set_current_view( 'blog' );
			if ( is_front_page() ) {
				//crocal_eutf_set_current_view( 'frontpage' );
			}
		?>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer();

//Omit closing PHP tag to avoid accidental whitespace output errors.
