<?php get_header(); ?>

<?php
if ( is_singular( 'tribe_events' ) ) {
	$event_title_style = crocal_eutf_option( 'event_title_style', 'advanced' );
	if ( 'advanced' == $event_title_style ) {
		crocal_eutf_print_header_title( 'event' );
	}
	crocal_eutf_print_header_breadcrumbs( 'event' );
	crocal_eutf_print_anchor_menu( 'event' );
} else {
	if ( is_singular( 'tribe_organizer' ) || is_singular( 'tribe_venue' )  ) {
		// No advanced title
	} else {
		// No advanced title
		crocal_eutf_print_header_breadcrumbs( 'event_tax' );
	}
}
?>
<?php if ( is_singular( 'tribe_events' ) ) { ?>
<div class="eut-single-wrapper">
<?php } ?>


	<!-- CONTENT -->
	<div id="eut-content" class="clearfix <?php echo crocal_eutf_sidebar_class( 'event' ); ?>">
		<div class="eut-content-wrapper">
			<!-- MAIN CONTENT -->
			<div id="eut-main-content">
				<div class="eut-main-content-wrapper clearfix">
					<div class="eut-container">
						<?php tribe_events_before_html(); ?>
						<?php tribe_get_view(); ?>
						<?php tribe_events_after_html(); ?>
					</div>
				</div>
			</div>
			<!-- END MAIN CONTENT -->

			<?php crocal_eutf_set_current_view( 'event' ); ?>
			<?php get_sidebar(); ?>

		</div>
	</div>
	<!-- END CONTENT -->

<?php if ( is_singular( 'tribe_events' ) ) { ?>
<?php crocal_eutf_print_event_bar(); ?>
</div>
<?php } ?>

<?php
	get_footer();

//Omit closing PHP tag to avoid accidental whitespace output errors.
