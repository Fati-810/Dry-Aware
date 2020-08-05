<?php
/**
 * The default post template
 */
?>

<?php
if ( is_singular() ) {
	$crocal_eutf_disable_media = crocal_eutf_post_meta( '_crocal_eutf_disable_media' );
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('eut-single-post'); ?> itemscope itemType="http://schema.org/BlogPosting">

		<?php
			if ( crocal_eutf_visibility( 'post_feature_image_visibility', '1' ) && 'yes' != $crocal_eutf_disable_media && has_post_thumbnail() ) {
				$image_size = "large";
		?>
		<div id="eut-single-media">
			<div class="eut-container">
				<div class="eut-media eut-align-center">
					<?php
						$img_id = get_post_thumbnail_id();
						$img_src = wp_get_attachment_image_src( $img_id, $image_size );
						$img_width = $img_src[1];
						$img_height = $img_src[2];

						if( $img_width >= $img_height && $img_width >= 1024 ) {
							crocal_eutf_the_post_thumbnail( $image_size, array( 'data-column-space' => 100 ) );
						} else {
							crocal_eutf_the_post_thumbnail( $image_size );
						}
					?>
				</div>
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

	$post_style = crocal_eutf_post_meta( '_crocal_eutf_post_standard_style' );
	$bg_mode = false;

	if ( ( 'masonry' == $blog_mode || 'grid' == $blog_mode ) && 'crocal' == $post_style ) {
		$bg_mode = true;
	}
	if ( $bg_mode ) {
		$crocal_eutf_post_class = crocal_eutf_get_post_class("eut-style-2");
		$bg_color = crocal_eutf_post_meta( '_crocal_eutf_post_standard_bg_color', 'black' );
		$bg_opacity = crocal_eutf_post_meta( '_crocal_eutf_post_standard_bg_opacity', '70' );
		$bg_options = array(
			'bg_color' => $bg_color,
			'bg_opacity' => $bg_opacity,
		);
		$bg_post_size = crocal_eutf_post_meta( '_crocal_eutf_post_standard_bg_size', 'double' );
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
		<?php crocal_eutf_print_post_feature_media( 'image' ); ?>
		<?php } ?>
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
