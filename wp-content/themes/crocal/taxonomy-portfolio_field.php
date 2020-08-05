<?php get_header(); ?>

<?php crocal_eutf_print_header_title( 'portfolio' ); ?>
<?php crocal_eutf_print_header_breadcrumbs( 'portfolio' ); ?>

<?php
	$portfolio_style = 'fitRows';
	$columns = '3';
	$columns_tablet_landscape = '3';
	$columns_tablet_portrait = '2';
	$columns_mobile = '1';
?>

<!-- CONTENT -->
<div id="eut-content" class="clearfix">
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

										<div class="eut-portfolio eut-isotope eut-with-gap" data-gutter-size="40" data-columns="<?php echo esc_attr( $columns ); ?>" data-columns-tablet-landscape="<?php echo esc_attr( $columns_tablet_landscape ); ?>" data-columns-tablet-portrait="<?php echo esc_attr( $columns_tablet_portrait ); ?>" data-columns-mobile="<?php echo esc_attr( $columns_mobile ); ?>" data-layout="<?php echo esc_attr( $portfolio_style ); ?>" data-spinner="no">
								<?php
									if ( have_posts() ) :
								?>
											<div class="eut-isotope-container">
								<?php
											// Start the Loop.
											while ( have_posts() ) : the_post();
												//Get post template
												get_template_part( 'templates/portfolio', 'grid' );

											endwhile;
								?>
											</div>
								<?php
										// Previous/next post navigation.
										crocal_eutf_paginate_links( 'portfolio_fields' );
									else :
										// If no content, include the "No posts found" template.
										get_template_part( 'content', 'none' );
									endif;
								?>
										</div>

									</div>
								</div>
							</div>

						</div>
					</div>

				</div>

			</div>
		</div>
		<!-- End Content -->
	</div>
</div>
<?php get_footer();

//Omit closing PHP tag to avoid accidental whitespace output errors.
