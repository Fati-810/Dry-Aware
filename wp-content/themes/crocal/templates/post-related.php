<?php
/*
*	Template Post Related
*
* 	@version	1.0
* 	@author		Euthemians Team
* 	@URI		http://euthemians.com
*/


$crocal_eutf_link = get_permalink();
$crocal_eutf_target = '_self';

if ( 'link' == get_post_format() ) {
	$crocal_eutf_link = get_post_meta( get_the_ID(), '_crocal_eutf_post_link_url', true );
	$new_window = get_post_meta( get_the_ID(), '_crocal_eutf_post_link_new_window', true );
	if( empty( $crocal_eutf_link ) ) {
		$crocal_eutf_link = get_permalink();
	}

	if( !empty( $new_window ) ) {
		$crocal_eutf_target = '_blank';
	}
}

	$column_classes = array( 'eut-column', 'eut-column-1-3', 'eut-align-center' );
	if ( has_post_thumbnail() ) {
		$column_classes[]  = 'eut-has-post-thumbnail ';
	} else {
		$column_classes[]  = 'eut-vertical-position-middle ';
	}
	$column_class_string = implode( ' ', $column_classes );

?>
	<div class="<?php echo esc_attr( $column_class_string )?>">
		<div class="eut-column-wrapper eut-medium-shadow eut-with-shadow">
			<div class="eut-column-content">
				<article id="eut-post-related-<?php the_ID(); ?><?php echo uniqid('-'); ?>">
					<a class="eut-item-url" href="<?php echo esc_url( $crocal_eutf_link ); ?>" target="<?php echo esc_attr( $crocal_eutf_target ); ?>"></a>
					<div class="eut-blog-item-inner">
						<?php if ( has_post_thumbnail() ) { ?>
						<div class="eut-media">
							<?php $image_size = 'crocal-eutf-small-rect-horizontal'; ?>
							<?php crocal_eutf_print_post_bg_image( $image_size ); ?>
						</div>
						<?php } ?>
						<div class="eut-post-content-wrapper">
							<div class="eut-post-content">
								<ul class="eut-post-meta">
									<?php crocal_eutf_print_post_date( 'list'); ?>
								</ul>
								<div class="eut-title eut-h6"><?php the_title(); ?></div>
							</div>
						</div>
					</div>
				</article>
			</div>
		</div>
	</div>