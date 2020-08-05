<?php
/**
 * The Gallery Post Type Template
 */
?>

<?php
if ( is_singular() ) {
	$crocal_eutf_disable_media = crocal_eutf_post_meta( '_crocal_eutf_disable_media' );
	$slider_items = crocal_eutf_post_meta( '_crocal_eutf_post_slider_items' );
	$gallery_mode = crocal_eutf_post_meta( '_crocal_eutf_post_type_gallery_mode', 'gallery' );
	$gallery_image_mode = crocal_eutf_post_meta( '_crocal_eutf_post_type_gallery_image_mode' );
	$image_size_slider = 'crocal-eutf-large-rect-horizontal';
	if ( 'resize' == $gallery_image_mode ) {
		$image_size_slider = "large";
	}
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('eut-single-post'); ?> itemscope itemType="http://schema.org/BlogPosting">
<?php
		if ( !empty( $slider_items ) && 'yes' != $crocal_eutf_disable_media ) {
?>
			<div id="eut-single-media">
				<div class="eut-container">
					<?php crocal_eutf_print_gallery_slider( $gallery_mode, $slider_items, $image_size_slider  ); ?>
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
	$crocal_eutf_post_class = crocal_eutf_get_post_class();
?>

	<!-- Article -->
	<article id="post-<?php the_ID(); ?>" <?php post_class( $crocal_eutf_post_class ); ?> itemscope itemType="http://schema.org/BlogPosting">
		<?php do_action( 'crocal_eutf_inner_post_loop_item_before' ); ?>
		<?php crocal_eutf_print_post_feature_media( 'gallery' ); ?>
		<div class="eut-post-content-wrapper">
			<div class="eut-post-content">
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
