<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural = tribe_get_event_label_plural();
$event_title_style = crocal_eutf_option( 'event_title_style', 'advanced' );

$event_id = get_the_ID();

?>

<div id="tribe-events-content" class="tribe-events-single">

	<!-- Notices -->
	<?php tribe_the_notices(); ?>

	<?php if ( 'simple' == $event_title_style ) { ?>
	<?php the_title( '<h1 class="tribe-events-single-event-title">', '</h1>' ); ?>

	<div class="tribe-events-schedule tribe-clearfix">
		<?php echo tribe_events_event_schedule_details( $event_id, '<h2>', '</h2>' ); ?>
		<?php if ( tribe_get_cost() ) : ?>
			<span class="tribe-events-cost"><?php echo tribe_get_cost( null, true ); ?></span>
		<?php endif; ?>
	</div>
	<div class="clear></div>"
	<?php } ?>

	<?php while ( have_posts() ) :  the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<!-- Event featured image, but exclude link -->
			<?php
			if ( crocal_eutf_visibility( 'event_image_visibility', '1' ) && has_post_thumbnail() ) {
				$event_image_size = crocal_eutf_option( 'event_image_size' );
				$image_size = 'large';
				if( 'default' != $event_image_size ) {
					$image_size = crocal_eutf_get_image_size( $event_image_size );
				}

			?>
				<div id="eut-single-media">
					<div class="eut-media clearfix">
						<?php crocal_eutf_the_post_thumbnail( $image_size  ); ?>
					</div>
				</div>
			<?php
			}
			?>

			<!-- Event content -->
			<?php do_action( 'tribe_events_single_event_before_the_content' ); ?>
			<div id="eut-single-content" class="tribe-events-single-event-description tribe-events-content">
				<?php the_content(); ?>
			</div>
			<!-- .tribe-events-single-event-description -->
			<?php do_action( 'tribe_events_single_event_after_the_content' ); ?>

			<!-- Event meta -->
			<?php do_action( 'tribe_events_single_event_before_the_meta' ); ?>
			<?php tribe_get_template_part( 'modules/meta' ); ?>
			<?php do_action( 'tribe_events_single_event_after_the_meta' ); ?>
		</div> <!-- #post-x -->
		<?php if ( get_post_type() == Tribe__Events__Main::POSTTYPE && tribe_get_option( 'showComments', false ) ) { comments_template(); } ?>
	<?php endwhile; ?>

</div><!-- #tribe-events-content -->
