<?php
/*
*	Template Search Small Media
*
* 	@version	1.0
* 	@author		Euthemians Team
* 	@URI		http://euthemians.com
*/
?>

<?php
	$title_tag = crocal_eutf_option( 'search_page_heading_tag', 'h4' );
	$title_class = crocal_eutf_option( 'search_page_heading', 'h4' );
	$excerpt_length = crocal_eutf_option( 'search_page_excerpt_length_small' );
	$excerpt_more = crocal_eutf_option( 'search_page_excerpt_more' );
	$search_page_show_image = crocal_eutf_option( 'search_page_show_image', 'yes' );

	if ( 'yes' == $search_page_show_image ) {
		$search_image_mode = crocal_eutf_option( 'search_image_mode', 'landscape' );
		$image_size = crocal_eutf_get_image_size( $search_image_mode );
	}

?>

<article id="eut-search-<?php the_ID(); ?><?php echo uniqid('-'); ?>" <?php post_class( 'eut-blog-item eut-small-post eut-isotope-item eut-isotope-item' ); ?>>
	<div class="eut-blog-item-inner eut-isotope-item-inner">
	<?php if ( 'yes' == $search_page_show_image && has_post_thumbnail() ) { ?>
		<div class="eut-media eut-image-hover clearfix">
			<a href="<?php echo esc_url( get_permalink() ); ?>"><?php crocal_eutf_the_post_thumbnail( $image_size ); ?></a>
		</div>
	<?php } ?>
		<div class="eut-post-content-wrapper">
			<div class="eut-post-content">
				<?php the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark"><' . tag_escape( $title_tag ) . ' class="eut-post-title eut-text-hover-primary-1 eut-' . esc_attr( $title_class ) . '">', '</' . tag_escape( $title_tag ) . '></a>' ); ?>
				<div>
					<?php echo crocal_eutf_excerpt( $excerpt_length, $excerpt_more  ); ?>
				</div>
			</div>
		</div>
	</div>
</article>