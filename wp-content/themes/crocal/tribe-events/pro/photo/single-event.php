<?php
/**
 * Photo View Single Event
 * This file contains one event in the photo view
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/pro/photo/single_event.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
} ?>

<?php

global $post;

$event_overview_heading = crocal_eutf_option( 'event_overview_heading', 'h2' );
?>

<div class="tribe-events-photo-event-wrap">
	
	<div class="eut-media clearfix">
		<?php crocal_eutf_the_post_thumbnail( 'medium_large' ); ?>
	</div>

	<div class="tribe-events-event-details tribe-clearfix">

		<!-- Event Title -->
		<?php do_action( 'tribe_events_before_the_event_title' ); ?>
		<h2 class="eut-tribe-events-list-event-title eut-<?php echo esc_attr( $event_overview_heading ); ?>">
			<a class="tribe-event-url" href="<?php echo esc_url( tribe_get_event_link() ); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
				<?php the_title(); ?>
			</a>
		</h2>
		<?php do_action( 'tribe_events_after_the_event_title' ); ?>

		<!-- Event Meta -->
		<?php do_action( 'tribe_events_before_the_meta' ); ?>
		<div class="eut-tribe-events-event-meta eut-post-meta">
			<div class="tribe-event-schedule-details">
				<?php if ( ! empty( $post->distance ) ) : ?>
					<strong>[<?php echo tribe_get_distance_with_unit( $post->distance ); ?>]</strong>
				<?php endif; ?>
				<?php echo tribe_events_event_schedule_details(); ?>
			</div>
		</div><!-- .tribe-events-event-meta -->
		<?php do_action( 'tribe_events_after_the_meta' ); ?>

		<!-- Event Content -->
		<?php do_action( 'tribe_events_before_the_content' ); ?>
		<div class="tribe-events-list-photo-description tribe-events-content">
			<?php echo tribe_events_get_the_excerpt(); ?>
		</div>
		<?php do_action( 'tribe_events_after_the_content' ); ?>

	</div><!-- /.tribe-events-event-details -->

</div><!-- /.tribe-events-photo-event-wrap -->
