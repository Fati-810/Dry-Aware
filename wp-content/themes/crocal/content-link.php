<?php
/**
 * The Link Post Type Template
 */
?>

<?php
if ( is_singular() ) {

	$crocal_eutf_link = get_post_meta( get_the_ID(), '_crocal_eutf_post_link_url', true );
	$new_window = get_post_meta( get_the_ID(), '_crocal_eutf_post_link_new_window', true );

	if( empty( $crocal_eutf_link ) ) {
		$crocal_eutf_link = get_permalink();
	}

	$crocal_eutf_target = '_self';
	if( !empty( $new_window ) ) {
		$crocal_eutf_target = '_blank';
	}

	$bg_color = crocal_eutf_post_meta( '_crocal_eutf_post_link_bg_color', 'primary-1' );
	$bg_hover_color = crocal_eutf_post_meta( '_crocal_eutf_post_link_bg_hover_color', 'black' );
	$bg_opacity = crocal_eutf_post_meta( '_crocal_eutf_post_link_bg_opacity', '70' );
	$bg_options = array(
		'bg_color' => $bg_color,
		'bg_hover_color' => $bg_hover_color,
		'bg_opacity' => $bg_opacity,
	);

?>

	<article id="post-<?php the_ID(); ?>" <?php post_class( 'eut-single-post' ); ?> itemscope itemType="http://schema.org/BlogPosting">
		<div id="eut-single-link">
			<div class="eut-container">
				<a href="<?php echo esc_url( $crocal_eutf_link ); ?>" target="<?php echo esc_attr( $crocal_eutf_target ); ?>" rel="bookmark">
					<?php crocal_eutf_print_post_bg_image_container( $bg_options ); ?>
					<div class="eut-post-content">
						<div class="eut-post-icon">
							<i class="eut-icon-link"></i>
							<svg class="eut-animated-circle" x="0px" y="0px" width="60px" height="60px" viewBox="0 0 60 60"><circle fill="none" stroke="#ffffff" stroke-width="2" cx="30" cy="30" r="29" transform="rotate(-90 30 30)"/></svg>
						</div>
						<h2 class="eut-post-title eut-text-light eut-h3" itemprop="name headline"><?php the_title(); ?></h2>
						<div class="eut-post-url"><?php echo esc_url( $crocal_eutf_link ); ?></div>
					</div>
				</a>
			</div>
		</div>
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

	$crocal_eutf_post_class = crocal_eutf_get_post_class( 'eut-style-2' );
	$crocal_eutf_link = get_post_meta( get_the_ID(), '_crocal_eutf_post_link_url', true );
	$new_window = get_post_meta( get_the_ID(), '_crocal_eutf_post_link_new_window', true );

	if( empty( $crocal_eutf_link ) ) {
		$crocal_eutf_link = get_permalink();
	}

	$crocal_eutf_target = '_self';
	if( !empty( $new_window ) ) {
		$crocal_eutf_target = '_blank';
	}

	$bg_color = crocal_eutf_post_meta( '_crocal_eutf_post_link_bg_color', 'primary-1' );
	$bg_hover_color = crocal_eutf_post_meta( '_crocal_eutf_post_link_bg_hover_color', 'black' );
	$bg_opacity = crocal_eutf_post_meta( '_crocal_eutf_post_link_bg_opacity', '70' );
	$bg_options = array(
		'bg_color' => $bg_color,
		'bg_hover_color' => $bg_hover_color,
		'bg_opacity' => $bg_opacity,
	);
	$bg_post_size = crocal_eutf_post_meta( '_crocal_eutf_post_link_bg_size', 'normal' );
	$crocal_eutf_post_class .= ' eut-bg-size-' . $bg_post_size;

?>

	<article id="post-<?php the_ID(); ?>" <?php post_class( $crocal_eutf_post_class ); ?> itemscope itemType="http://schema.org/BlogPosting">
		<?php do_action( 'crocal_eutf_inner_post_loop_item_before' ); ?>
		<a class="eut-post-link" href="<?php echo esc_url( $crocal_eutf_link ); ?>" target="<?php echo esc_attr( $crocal_eutf_target ); ?>" rel="bookmark"></a>
		<?php crocal_eutf_print_post_bg_image_container( $bg_options ); ?>
		<div class="eut-post-content-wrapper">
			<div class="eut-post-content">
				<div class="eut-post-icon">
					<i class="eut-icon-link"></i>
					<svg class="eut-animated-circle" x="0px" y="0px" width="60px" height="60px" viewBox="0 0 60 60"><circle fill="none" stroke="#ffffff" stroke-width="2" cx="30" cy="30" r="29" transform="rotate(-90 30 30)"/></svg>
				</div>
				<?php crocal_eutf_loop_post_title(); ?>
				<?php crocal_eutf_print_post_structured_data(); ?>
				<div itemprop="articleBody">
				<?php crocal_eutf_print_post_excerpt('link'); ?>
				</div>
				<div class="eut-post-url"><?php echo esc_url( $crocal_eutf_link ); ?></div>
			</div>
		</div>
		<?php do_action( 'crocal_eutf_inner_post_loop_item_after' ); ?>

	</article>

<?php

}

//Omit closing PHP tag to avoid accidental whitespace output errors.
