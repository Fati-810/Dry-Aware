<?php
/**
 * The Quote Post Type Template
 */
?>

<?php
if ( is_singular() ) {

	$bg_color = crocal_eutf_post_meta( '_crocal_eutf_post_quote_bg_color', 'primary-1' );
	$bg_hover_color = crocal_eutf_post_meta( '_crocal_eutf_post_quote_bg_hover_color', 'black' );
	$bg_opacity = crocal_eutf_post_meta( '_crocal_eutf_post_quote_bg_opacity', '70' );
	$bg_options = array(
		'bg_color' => $bg_color,
		'bg_hover_color' => $bg_hover_color,
		'bg_opacity' => $bg_opacity,
	);
	$crocal_eutf_post_quote_name = crocal_eutf_post_meta( '_crocal_eutf_post_quote_name' );
	$crocal_eutf_post_quote_text = crocal_eutf_post_meta( '_crocal_eutf_post_quote_text' );
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class( 'eut-single-post eut-post-quote' ); ?> itemscope itemType="http://schema.org/BlogPosting">
		<?php if( !empty( $crocal_eutf_post_quote_text ) ) { ?>
		<div id="eut-single-quote">
			<div class="eut-container">
				<?php crocal_eutf_print_post_bg_image_container( $bg_options ); ?>
				<div class="eut-post-content">
					<div class="eut-post-icon">
						<i class="eut-icon-quote"></i>
						<svg class="eut-animated-circle" x="0px" y="0px" width="60px" height="60px" viewBox="0 0 60 60"><circle fill="none" stroke="#ffffff" stroke-width="2" cx="30" cy="30" r="29" transform="rotate(-90 30 30)"/></svg>
					</div>
					<div>
						<?php crocal_eutf_print_post_excerpt('quote'); ?>
					</div>
					<?php if ( !empty( $crocal_eutf_post_quote_name ) ) { ?>
					<div class="eut-quote-writer"><?php echo wp_kses_post(  $crocal_eutf_post_quote_name ); ?></div>
					<?php } ?>
				</div>
			</div>
		</div>
		<?php } ?>
		
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
	$crocal_eutf_post_class = crocal_eutf_get_post_class( 'eut-style-2' );

	$bg_color = crocal_eutf_post_meta( '_crocal_eutf_post_quote_bg_color', 'primary-1' );
	$bg_hover_color = crocal_eutf_post_meta( '_crocal_eutf_post_quote_bg_hover_color', 'black' );
	$bg_opacity = crocal_eutf_post_meta( '_crocal_eutf_post_quote_bg_opacity', '70' );
	$bg_options = array(
		'bg_color' => $bg_color,
		'bg_hover_color' => $bg_hover_color,
		'bg_opacity' => $bg_opacity,
	);
	$bg_post_size = crocal_eutf_post_meta( '_crocal_eutf_post_quote_bg_size', 'normal' );
	$crocal_eutf_post_class .= ' eut-bg-size-' . $bg_post_size;
	$crocal_eutf_post_quote_name = crocal_eutf_admin_post_meta( $post->ID, '_crocal_eutf_post_quote_name' );


?>

	<!-- Article -->
	<article id="post-<?php the_ID(); ?>" <?php post_class( $crocal_eutf_post_class ); ?> itemscope itemType="http://schema.org/BlogPosting">
		<?php do_action( 'crocal_eutf_inner_post_loop_item_before' ); ?>

		<a class="eut-post-link" href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"></a>
		<?php crocal_eutf_print_post_bg_image_container( $bg_options ); ?>
		<div class="eut-post-content-wrapper">
			<div class="eut-post-content">
				<div class="eut-post-icon">
					<i class="eut-icon-quote"></i>
					<svg class="eut-animated-circle" x="0px" y="0px" width="60px" height="60px" viewBox="0 0 60 60"><circle fill="none" stroke="#ffffff" stroke-width="2" cx="30" cy="30" r="29" transform="rotate(-90 30 30)"/></svg>
				</div>
				<?php do_action( 'crocal_eutf_inner_post_loop_item_title_hidden' ); ?>
				<div itemprop="articleBody">
				<?php crocal_eutf_print_post_excerpt('quote'); ?>
				</div>
				<?php if ( !empty( $crocal_eutf_post_quote_name ) ) { ?>
					<div class="eut-quote-writer"><?php echo wp_kses_post(  $crocal_eutf_post_quote_name ); ?></div>
				<?php } ?>
				<?php crocal_eutf_print_post_structured_data(); ?>
			</div>
		</div>

		<?php do_action( 'crocal_eutf_inner_post_loop_item_after' ); ?>
	</article>
	<!-- End Article -->

<?php
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
