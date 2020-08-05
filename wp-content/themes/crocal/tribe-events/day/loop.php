<?php
/**
 * Day View Loop
 * This file sets up the structure for the day loop
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/loop.php
 *
 * @version 4.6.19
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
} ?>

<?php

global $more, $post, $wp_query;
$more = false;
$current_timeslot = null;

$wrapper_attributes = array();
$wrapper_attributes[] = 'id="eut-tribe-events-day"';
$wrapper_attributes[] = 'class="eut-tribe-events-loop eut-blog eut-blog-small eut-non-isotope"';
$event_item_class_string = 'eut-blog-item eut-non-isotope-item eut-small-post';
?>

<div <?php echo implode( ' ', $wrapper_attributes ); ?>>

	<div class="tribe-events-day-time-slot">

	<?php while ( have_posts() ) : the_post(); ?>
		<?php do_action( 'tribe_events_inside_before_loop' ); ?>

		<?php if ( $current_timeslot != $post->timeslot ) :
		$current_timeslot = $post->timeslot; ?>
	</div>
	<!-- .tribe-events-day-time-slot -->

	<div class="tribe-events-day-time-slot">
		<h5><?php echo wp_kses_post( $current_timeslot ); ?></h5>
		<?php endif; ?>

		<!-- Event  -->
		<div id="post-<?php the_ID() ?>" class="<?php tribe_events_event_classes() ?> <?php echo esc_attr( $event_item_class_string ); ?>">
			<?php
			$event_type = tribe( 'tec.featured_events' )->is_featured( $post->ID ) ? 'featured' : 'event';

			/**
			 * Filters the event type used when selecting a template to render
			 *
			 * @param $event_type
			 */
			$event_type = apply_filters( 'tribe_events_day_view_event_type', $event_type );

			tribe_get_template_part( 'day/single', $event_type );
			?>
		</div>

		<?php do_action( 'tribe_events_inside_after_loop' ); ?>
	<?php endwhile; ?>

	</div>
	<!-- .tribe-events-day-time-slot -->
</div><!-- .tribe-events-loop -->
