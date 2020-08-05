<?php
/*
*	Template Portfolio Grid
*
* 	@version	1.0
* 	@author		Euthemians Team
* 	@URI		http://euthemians.com
*/
?>

<article id="eut-portfolio-item-<?php the_ID(); ?><?php echo uniqid('-'); ?>" <?php post_class( 'eut-portfolio-item eut-isotope-item' ); ?>>
	<div class="eut-isotope-item-inner eut-hover-item eut-hover-style-1 eut-zoom-none">
		<figure class="eut-image-hover eut-media eut-zoom-none">
			<a class="eut-item-url" href="<?php echo esc_url( get_permalink() ); ?>"></a>
			<?php crocal_eutf_print_portfolio_image( 'crocal-eutf-small-square' ); ?>
			<figcaption></figcaption>
		</figure>
		<div class="eut-content eut-align-center">
			<h3 class="eut-title eut-text-inherit eut-h5"><?php the_title(); ?></h3>
		</div>
	</div>
</article>