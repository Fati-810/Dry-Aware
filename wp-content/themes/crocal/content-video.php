<?php
/**
 * The Video Post Type Template
 */
?>

<?php
if ( is_singular() ) {
	$crocal_eutf_disable_media = crocal_eutf_post_meta( '_crocal_eutf_disable_media' );
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class( 'eut-single-post' ); ?> itemscope itemType="http://schema.org/BlogPosting">
		<?php
			if ( 'yes' != $crocal_eutf_disable_media ) {
		?>
		<div id="eut-single-media">
			<div class="eut-container">
				<?php crocal_eutf_print_post_video(); ?>
			</div>
		</div>
		<?php
			}
		?>
		<div id="eut-single-content">
			<?php crocal_eutf_print_post_simple_title(); ?>
			<?php crocal_eutf_print_post_structured_data(); ?>
			<div itemprop="articleBody">
				<?php the_content(); ?>
			</div>
		</div>

	</article>

<?php
} else {

	$blog_mode = crocal_eutf_option( 'blog_mode', 'large' );
	$post_style = crocal_eutf_post_meta( '_crocal_eutf_post_video_style' );
	$bg_mode = false;

	if ( ( 'masonry' == $blog_mode || 'grid' == $blog_mode ) && 'crocal' == $post_style ) {
		$bg_mode = true;
	}
	if ( $bg_mode ) {
		$crocal_eutf_post_class = crocal_eutf_get_post_class("eut-style-2");
		$bg_color = crocal_eutf_post_meta( '_crocal_eutf_post_video_bg_color', 'black' );
		$bg_opacity = crocal_eutf_post_meta( '_crocal_eutf_post_video_bg_opacity', '70' );
		$bg_options = array(
			'bg_color' => $bg_color,
			'bg_opacity' => $bg_opacity,
		);
		$bg_post_size = crocal_eutf_post_meta( '_crocal_eutf_post_video_bg_size', 'normal' );
		$crocal_eutf_post_class .= ' eut-bg-size-' . $bg_post_size;
	} else {
		$crocal_eutf_post_class = crocal_eutf_get_post_class();
	}
?>

	<!-- Article -->
	<article id="post-<?php the_ID(); ?>" <?php post_class( $crocal_eutf_post_class ); ?> itemscope itemType="http://schema.org/BlogPosting">
		<?php do_action( 'crocal_eutf_inner_post_loop_item_before' ); ?>
		<?php if ( $bg_mode ) { ?>
		<?php crocal_eutf_print_post_bg_image_container( $bg_options ); ?>
		<?php } else { ?>
		<?php crocal_eutf_print_post_feature_media( 'video' ); ?>
		<?php } ?>
		<div class="eut-post-content-wrapper">
			<div class="eut-post-content">
				<?php if ( $bg_mode ) { ?>
				<?php crocal_eutf_print_post_video_popup(); ?>
				<?php } ?>
				<?php crocal_eutf_print_post_meta_top(); ?>
				<?php crocal_eutf_print_post_structured_data(); ?>
				<div itemprop="articleBody">
					<?php crocal_eutf_print_post_excerpt(); ?>
				</div>
			</div>
		</div>
		<?php do_action( 'crocal_eutf_inner_post_loop_item_after' ); ?>
	</article>
	<!-- End Article -->

<?php
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
