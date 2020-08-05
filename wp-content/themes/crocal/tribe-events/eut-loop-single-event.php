<?php
/**
 * Euthemians List View Single Event
 * This file contains one event in the list view
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

// Setup an array of venue details for use later in the template
$venue_details = tribe_get_venue_details();
// Venue
$has_venue_address = ( ! empty( $venue_details['address'] ) ) ? ' location' : '';
// Organizer
$organizer = tribe_get_organizer();

$event_overview_heading = crocal_eutf_option( 'event_overview_heading', 'h2' );

?>

<div class="eut-blog-item-inner">

<?php
if ( has_post_thumbnail() ) {


	$event_image_size = crocal_eutf_option( 'event_overview_image_size' );
	$image_size = 'medium';
	if( 'default' != $event_image_size ) {
		$image_size = crocal_eutf_get_image_size( $event_image_size );
	}

?>
	<!-- Event Image -->
	<div class="eut-media clearfix">
		<a class="url" href="<?php echo tribe_get_event_link() ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
			<?php crocal_eutf_the_post_thumbnail( $image_size  ); ?>
		</a>
	</div>
<?php
}
?>

	<div class="eut-post-content-wrapper">
		<div class="eut-post-header">

			<!-- Event Cost -->
			<?php if ( tribe_get_cost() ) : ?>
				<div class="eut-tribe-events-event-cost">
					<span><?php echo tribe_get_cost( null, true ); ?></span>
				</div>
			<?php endif; ?>

			<!-- Event Title -->
			<?php do_action( 'tribe_events_before_the_event_title' ); ?>
			<h2 class="eut-tribe-events-list-event-title eut-<?php echo esc_attr( $event_overview_heading ); ?>">
				<a class="eut-tribe-event-url" href="<?php echo esc_url( tribe_get_event_link() ); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
					<?php the_title(); ?>
				</a>
			</h2>
			<?php do_action( 'tribe_events_after_the_event_title' ); ?>

			<!-- Event Meta -->
			<?php do_action( 'tribe_events_before_the_meta' ); ?>
			<div class="eut-tribe-events-event-meta eut-post-meta">
				<div class="author <?php echo esc_attr( $has_venue_address ); ?>">

					<!-- Schedule & Recurrence Details -->
					<div class="eut-tribe-event-schedule-details">
						<?php echo tribe_events_event_schedule_details(); ?>
					</div>

					<?php if ( $venue_details ) : ?>
						<!-- Venue Display Info -->
						<div class="eut-tribe-events-venue-details">
							<?php echo implode( ', ', $venue_details ); ?>
							<?php
							if ( tribe_get_map_link() ) {
								echo tribe_get_map_link_html();
							}
							?>
						</div> <!-- .tribe-events-venue-details -->
					<?php endif; ?>

				</div>
			</div><!-- .tribe-events-event-meta -->
			<?php do_action( 'tribe_events_after_the_meta' ); ?>
		</div>
		<div class="eut-tribe-events-content" itemprop="articleBody">
			<!-- Event Content -->
			<?php do_action( 'tribe_events_before_the_content' ); ?>
			<?php echo tribe_events_get_the_excerpt( null, wp_kses_allowed_html( 'post' ) ); ?>
			<a href="<?php echo esc_url( tribe_get_event_link() ); ?>" class="eut-link-text eut-tribe-events-read-more" rel="bookmark"><?php esc_html_e( 'read more', 'crocal' ); ?></a>
			<?php do_action( 'tribe_events_after_the_content' ); ?>
		</div>
	</div>

</div>
