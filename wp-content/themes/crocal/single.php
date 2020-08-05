<?php get_header(); ?>

<?php the_post(); ?>

<?php crocal_eutf_print_header_title( 'post' ); ?>
<?php crocal_eutf_print_header_breadcrumbs( 'post' ); ?>
<?php crocal_eutf_print_anchor_menu( 'post' ); ?>

<div class="eut-single-wrapper">
	<!-- CONTENT -->
	<div id="eut-content" class="clearfix <?php echo crocal_eutf_sidebar_class(); ?>">
		<div class="eut-content-wrapper">
			<!-- MAIN CONTENT -->
			<div id="eut-main-content">
				<div class="eut-main-content-wrapper clearfix">
					<?php
						get_template_part( 'content', get_post_format() );
						//Post Pagination
						wp_link_pages();
						if ( crocal_eutf_visibility( 'post_comments_visibility' ) && 'default' == crocal_eutf_option( 'post_comments_position', 'default' ) ) {
							comments_template();
						}
					?>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
			<?php crocal_eutf_set_current_view( 'post' ); ?>
			<?php get_sidebar(); ?>
		</div>
		<div class="eut-single-section">
			<div class="eut-container">

				<?php if ( crocal_eutf_social_bar ( 'post', 'check') ) {
					// Print Socials
					crocal_eutf_social_bar ( 'post', 'layout-2', 'text'  );
				} ?>

				<?php
					if ( crocal_eutf_visibility( 'post_tag_visibility', '1' ) ) {
						// Print Tags & Categories
						crocal_eutf_print_post_tags();
					}
				?>

				<?php crocal_eutf_print_post_about_author(); ?>

			</div>
		</div>
		<?php
		//Navigation Bar Layout 2
		if ( 'layout-2' == crocal_eutf_option( 'post_nav_layout', 'layout-1' ) ) {
			crocal_eutf_nav_bar( 'post' );
		}
		?>
		<?php
			if ( crocal_eutf_visibility( 'post_comments_visibility' ) &&
				'section' == crocal_eutf_option( 'post_comments_position', 'default' ) ) {
		?>
		<div id="eut-comments-section">
			<?php comments_template(); ?>
		</div>
		<?php
			}
		?>
	</div>
	<!-- END CONTENT -->


	<?php
	//Print Related Posts
	if ( crocal_eutf_visibility( 'post_related_visibility' ) ) {
		$related_query = crocal_eutf_get_related_posts();
		if ( !empty( $related_query ) ) {
	?>
	<div id="eut-related-section" class="eut-padding-top-2x eut-padding-bottom-4x">
		<?php crocal_eutf_print_related_posts( $related_query ); ?>
	</div>
	<?php
		}
	}
	?>

	<?php
	//Navigation Bar Layout 1
	if ( 'layout-1' == crocal_eutf_option( 'post_nav_layout', 'layout-1' ) ) {
		crocal_eutf_nav_bar( 'post' );
	}
	?>

</div>

<?php get_footer();

//Omit closing PHP tag to avoid accidental whitespace output errors.
