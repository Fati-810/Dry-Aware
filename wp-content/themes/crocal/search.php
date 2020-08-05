<?php get_header(); ?>


<?php
	crocal_eutf_print_header_title('search_page');
	crocal_eutf_print_header_breadcrumbs( 'search_page' );

	$search_mode = crocal_eutf_option( 'search_page_mode', 'masonry' );
	$search_display_style = crocal_eutf_option( 'search_display_style', 'pagination' );
	$wrapper_attributes = array();

	$wrapper_attributes[] = 'data-display-style="' . esc_attr( $search_display_style ) . '"';

	if ( 'small' != $search_mode) {

		$columns_large_screen  = crocal_eutf_option( 'search_page_columns_large_screen', '3' );
		$columns = crocal_eutf_option( 'search_page_columns', '3' );
		$columns_tablet_landscape  = crocal_eutf_option( 'search_page_columns_tablet_landscape', '2' );
		$columns_tablet_portrait  = crocal_eutf_option( 'search_page_columns_tablet_portrait', '2' );
		$columns_mobile  = crocal_eutf_option( 'search_page_columns_mobile', '1' );
		$search_shadow  = crocal_eutf_option( 'search_page_shadow_style', 'shadow-mode' );
		if ( 'grid' == $search_mode) {
			$search_mode = 'fitRows';
		}

		$wrapper_attributes[] = 'data-columns-large-screen="' . esc_attr( $columns_large_screen ) . '"';
		$wrapper_attributes[] = 'data-columns="' . esc_attr( $columns ) . '"';
		$wrapper_attributes[] = 'data-columns-tablet-landscape="' . esc_attr( $columns_tablet_landscape ) . '"';
		$wrapper_attributes[] = 'data-columns-tablet-portrait="' . esc_attr( $columns_tablet_portrait ) . '"';
		$wrapper_attributes[] = 'data-columns-mobile="' . esc_attr( $columns_mobile ) . '"';
		$wrapper_attributes[] = 'data-layout="' . esc_attr( $search_mode ) . '"';
		$wrapper_attributes[] = 'data-gutter-size="30"';
		$wrapper_attributes[] = 'data-spinner="no"';

		$search_classes = array( 'eut-blog', 'eut-blog-columns', 'eut-isotope', 'eut-with-gap' );
		if( 'shadow-mode' == $search_shadow ){
			$search_classes[] = 'eut-with-shadow';
		}
	} else {
		$wrapper_attributes[] = 'data-columns-large-screen="1"';
		$wrapper_attributes[] = 'data-columns="1"';
		$wrapper_attributes[] = 'data-columns-tablet-landscape="1"';
		$wrapper_attributes[] = 'data-columns-tablet-portrait="1"';
		$wrapper_attributes[] = 'data-columns-mobile="1"';
		$wrapper_attributes[] = 'data-layout="fitRows"';

		$search_classes = array( 'eut-blog', 'eut-blog-small', 'eut-blog-columns', 'eut-isotope' );
	}

	$search_class_string = implode( ' ', $search_classes );
	$wrapper_attributes[] = 'class="' . esc_attr( $search_class_string ) . '"';

?>

<!-- CONTENT -->
<div id="eut-content" class="clearfix <?php echo crocal_eutf_sidebar_class( 'search_page' ); ?>">
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
							<?php
								if ( have_posts() ) :
							?>
								<div class="eut-column-wrapper">
									<div class="eut-column-content">
										<div id="eut-main-search-loop" <?php echo implode( ' ', $wrapper_attributes ); ?>>
											<?php
												$crocal_eutf_post_items = $crocal_eutf_page_items = $crocal_eutf_portfolio_items = $crocal_eutf_other_post_items = 0;
												$crocal_eutf_has_post_items = $crocal_eutf_has_page_items = $crocal_eutf_has_portfolio_items = 0;

												while ( have_posts() ) : the_post();
													$post_type = get_post_type();
													switch( $post_type ) {
														case 'post':
															 $crocal_eutf_post_items++;
															 $crocal_eutf_has_post_items = 1;
														break;
														case 'page':
															 $crocal_eutf_page_items++;
															 $crocal_eutf_has_page_items = 1;
														break;
														case 'portfolio':
															 $crocal_eutf_portfolio_items++;
															 $crocal_eutf_has_portfolio_items = 1;
														break;
														default:
															$crocal_eutf_other_post_items++;
														break;
													}
												endwhile;
												$crocal_eutf_item_types = $crocal_eutf_has_post_items + $crocal_eutf_has_page_items + $crocal_eutf_has_portfolio_items;

												if ( $crocal_eutf_item_types > 1 ) {
											?>
											<div class="eut-filter eut-link-text eut-list-divider eut-align-left">
												<ul>
													<li data-filter="*" class="selected"><?php esc_html_e( "All", 'crocal' ); ?></li>
													<?php if ( $crocal_eutf_has_post_items ) { ?>
													<li data-filter=".post"><?php esc_html_e( "Post", 'crocal' ); ?></li>
													<?php } ?>
													<?php if ( $crocal_eutf_has_page_items ) { ?>
													<li data-filter=".page"><?php esc_html_e( "Page", 'crocal' ); ?></li>
													<?php } ?>
													<?php if ( $crocal_eutf_has_portfolio_items ) { ?>
													<li data-filter=".portfolio"><?php esc_html_e( "Portfolio", 'crocal' ); ?></li>
													<?php } ?>
												</ul>
											</div>
											<?php
												}
												if ( 'small' == $search_mode ) {
													echo '<div class="eut-isotope-container">';
													while ( have_posts() ) : the_post();
													get_template_part( 'templates/search', 'small' );
													endwhile;
													echo '</div>';
												} else {
													echo '<div class="eut-isotope-container">';
													while ( have_posts() ) : the_post();
													get_template_part( 'templates/search', 'masonry' );
													endwhile;
													echo '</div>';
												}
												// Previous/next post navigation.
												crocal_eutf_paginate_links( 'search' );
											?>
										</div>
									</div>
								</div>
								<?php
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
		<!-- END MAIN CONTENT -->

		<?php crocal_eutf_set_current_view( 'search_page' ); ?>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer();

//Omit closing PHP tag to avoid accidental whitespace output errors.
