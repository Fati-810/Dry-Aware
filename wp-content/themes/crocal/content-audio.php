<?php
/**
 * The Audio Post Type Template
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
			<?php crocal_eutf_print_post_audio(); ?>
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
	$crocal_eutf_post_class = crocal_eutf_get_post_class();
?>

	<!-- Article -->
	<article id="post-<?php the_ID(); ?>" <?php post_class( $crocal_eutf_post_class ); ?> itemscope itemType="http://schema.org/BlogPosting">
		<?php do_action( 'crocal_eutf_inner_post_loop_item_before' ); ?>
		<?php crocal_eutf_print_post_feature_media( 'audio' ); ?>
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
