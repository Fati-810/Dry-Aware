<?php
/*
*	Template Content None
*
* 	@version	1.0
* 	@author		Euthemians Team
* 	@URI		http://euthemians.com
*/
?>
<div class="eut-content-none eut-padding-top-6x eut-padding-bottom-6x">
	<div class="eut-post-content">
		<?php echo do_shortcode( wp_kses_post( crocal_eutf_option( 'search_page_not_found_text' ) ) ); ?>
		<div class="eut-widget eut-margin-top-2x">
			<?php get_search_form(); ?>
		</div>
	</div>
</div>