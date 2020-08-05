<?php
if ( crocal_eutf_visibility( 'page_404_header' ) ) {
	get_header();
} else {
	get_header( 'basic' );
}

$section_classes = "eut-section eut-percentage-height eut-loading-height";
?>

			<div id="eut-content" class="eut-error-404 clearfix">
				<div class="eut-content-wrapper">
					<div id="eut-main-content">
						<div class="eut-main-content-wrapper eut-padding-none clearfix">

							<div class="eut-section eut-percentage-height eut-loading-height" data-height-ratio="100">
								<div class="eut-container">
									<div class="eut-row eut-percentage-content">
										<div class="eut-column eut-column-1 eut-vertical-position-middle">
											<div class="eut-column-wrapper">
												<div class="eut-column-content">
													<div class="eut-align-center">

														<div id="eut-content-area">
														<?php
															$crocal_eutf_404_search_box = crocal_eutf_option('page_404_search');
															$crocal_eutf_404_home_button = crocal_eutf_option('page_404_home_button');
															echo do_shortcode( wp_kses_post( crocal_eutf_option( 'page_404_content' ) ) );
														?>
														</div>

														<br/>

														<?php if ( $crocal_eutf_404_search_box ) { ?>
														<div class="eut-widget">
															<?php get_search_form(); ?>
														</div>
														<br/>
														<?php } ?>

														<?php if ( $crocal_eutf_404_home_button ) { ?>
														<div class="eut-element">
															<a class="eut-btn eut-btn-medium eut-round eut-bg-primary-1 eut-bg-hover-black" target="_self" href="<?php echo esc_url( home_url( '/' ) ); ?>">
																<span><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span>
															</a>
														</div>
														<?php } ?>

													</div>

												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>

<?php

if ( crocal_eutf_visibility( 'page_404_footer' ) ) {
	get_footer();
} else {
	if ( crocal_eutf_visibility( 'page_404_header' ) ) {
		get_footer( 'basic-header' );
	} else {
		get_footer( 'basic' );
	}
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
