<?php get_header(); ?>

<?php the_post(); ?>
<?php crocal_eutf_print_header_title( 'portfolio' ); ?>
<?php crocal_eutf_print_header_breadcrumbs( 'portfolio' ); ?>
<?php crocal_eutf_print_anchor_menu( 'portfolio' ); ?>

<?php
	$eut_disable_portfolio_recent = crocal_eutf_post_meta( '_crocal_eutf_disable_recent_entries' );
	$eut_portfolio_media = crocal_eutf_post_meta( '_crocal_eutf_portfolio_media_selection' );
	$portfolio_media_fullwidth = crocal_eutf_post_meta( '_crocal_eutf_portfolio_media_fullwidth', 'no' );
	$eut_sidebar_layout = crocal_eutf_post_meta( '_crocal_eutf_layout', crocal_eutf_option( 'portfolio_layout', 'none' ) );
	$eut_sidebar_extra_content = crocal_eutf_check_portfolio_details();
	$eut_portfolio_details_sidebar = false;
	if( $eut_sidebar_extra_content && 'none' == $eut_sidebar_layout ) {
		$eut_portfolio_details_sidebar = true;
	}


	$portfolio_media_classes = array( 'eut-portfolio-media' );
	if( 'yes' == $portfolio_media_fullwidth ){
		array_push( $portfolio_media_classes, 'eut-section', 'eut-fullwidth');
	}
	if ( $eut_portfolio_details_sidebar ) {
		array_push( $portfolio_media_classes, 'eut-without-sidebar' );
	} else {
		array_push( $portfolio_media_classes, 'eut-with-sidebar' );
	}

	$portfolio_media_class_string = implode( ' ', $portfolio_media_classes );

	$eut_social_bar_layout = crocal_eutf_post_meta( '_crocal_eutf_social_bar_layout', crocal_eutf_option( 'portfolio_social_bar_layout', 'layout-1' ) );
	$eut_nav_bar_layout = crocal_eutf_option( 'portfolio_nav_layout', 'layout-1' )
?>

<div class="eut-single-wrapper">
	<?php
		if ( $eut_portfolio_details_sidebar && 'none' != $eut_portfolio_media ) {
	?>
		<div id="eut-single-media" class="<?php echo esc_attr( $portfolio_media_class_string ); ?>">
			<div class="eut-container">
				<?php crocal_eutf_print_portfolio_media(); ?>
			</div>
		</div>
	<?php
		}
	?>
	<!-- CONTENT -->
	<div id="eut-content" class="clearfix <?php echo crocal_eutf_sidebar_class( 'portfolio' ); ?>">
		<div class="eut-content-wrapper">
			<!-- MAIN CONTENT -->
			<div id="eut-main-content">
				<div class="eut-main-content-wrapper clearfix">

					<article id="post-<?php the_ID(); ?>" <?php post_class('eut-single-portfolio'); ?>>
						<?php
							if ( !$eut_portfolio_details_sidebar && 'none' != $eut_portfolio_media ) {
						?>
							<div id="eut-single-media" class="<?php echo esc_attr( $portfolio_media_class_string ); ?>">
								<div class="eut-container">
									<?php crocal_eutf_print_portfolio_media(); ?>
								</div>
							</div>
						<?php
							}
						?>
						<div id="eut-post-content">
							<?php the_content(); ?>
							<?php
								if ( crocal_eutf_visibility( 'portfolio_comments_visibility' ) &&
									'default' == crocal_eutf_option( 'portfolio_comments_position', 'default' ) ) {
									comments_template();
								}
							?>
						</div>
					</article>
					<?php if ( 'layout-1' == $eut_social_bar_layout && crocal_eutf_social_bar ( 'portfolio', 'check') ) {
						// Print Socials
						crocal_eutf_social_bar ( 'portfolio', 'layout-2', 'text'  );
					} ?>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
			<?php
				if ( $eut_portfolio_details_sidebar ) {
			?>
				<aside id="eut-sidebar">
					<?php crocal_eutf_print_portfolio_details(); ?>
				</aside>
			<?php
				} else {
					crocal_eutf_set_current_view( 'portfolio' );
					get_sidebar();
				}
			?>
		</div>
		<?php
		//Navigation Bar Layout 2
		if ( 'layout-2' == $eut_nav_bar_layout ) {
			crocal_eutf_nav_bar( 'portfolio' );
		}
		?>
	</div>
	<!-- End CONTENT -->

	<?php
		if ( crocal_eutf_visibility( 'portfolio_comments_visibility' ) &&
			'section' == crocal_eutf_option( 'portfolio_comments_position', 'default' ) ) {
	?>
	<div id="eut-comments-section">
		<?php comments_template(); ?>
	</div>
	<?php
		}
	?>

	<?php
	//Recent Items
	$eut_disable_portfolio_recent = crocal_eutf_post_meta( '_crocal_eutf_disable_recent_entries' );
	if ( crocal_eutf_visibility( 'portfolio_recents_visibility' ) && 'yes' != $eut_disable_portfolio_recent ) {
		crocal_eutf_print_recent_portfolio_items_classic();
	}
	?>
	<?php
	//Navigation Bar Layout 1 or 3
	if ( 'layout-1' == $eut_nav_bar_layout || 'layout-3' == $eut_nav_bar_layout ) {
		crocal_eutf_nav_bar( 'portfolio' );
	}
	?>

</div>
<?php get_footer();

//Omit closing PHP tag to avoid accidental whitespace output errors.
