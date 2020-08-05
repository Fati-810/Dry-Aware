<?php
/** @var Crocal_Vc_Templates $controller */
/** @var array $templates */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

?>
<div class="vc_ui-templates-content eut-templates-content">

	<div class="eut-template-filters">
		<ul>
			<?php
				foreach( $filters as $filter_slug => $filter_name ) {
					echo '<li data-filter="' . esc_attr( $filter_slug ) . '">' . esc_html( $filter_name ) . ' <span class="eut-count">0</span></li>';
				}
			?>
		</ul>
	</div>

	<div id="eut-template-item-grid" class="vc_column vc_col-sm-12">

		<div class="vc_ui-template-list vc_templates-list-crocal_templates vc_ui-list-bar" data-vc-action="collapseAll">

		<?php
			$index = -1;
			foreach ( $templates as $key => $template ) :
			$index++;
		?>

			<div class="eut-template-item vc_ui-template vc_templates-template-type-crocal_templates <?php echo esc_attr( $template['custom_class'] ); ?>"
				data-template_id="<?php echo esc_attr( $index ); ?>"
				data-template_name="<?php echo esc_attr( $template['name'] ); ?>"
				data-category="crocal_templates"
				data-template_type="crocal_templates"
				data-vc-content=".vc_ui-template-content">
				<div class="eut-template-item-inner">
					<button type="button" class="eut-template-load-button vc_ui-list-bar-item-trigger" data-template-handler="" data-vc-ui-element="template-title">
						<div class="eut-template-image-wrapper">
							<img src="<?php echo esc_url( $template['image_path'] ); ?>" alt="<?php echo esc_attr( $template['name'] ); ?>">
						</div>
						<div class="eut-template-content">
							<div class="eut-template-label">
								<?php echo esc_html( $template['name'] ); ?>
							</div>
							<div class="eut-template-button"><?php esc_html_e( 'Add', 'crocal-extension' ); ?></div>
						</div>
					</button>

					<div class="vc_ui-template-content" data-js-content></div>
				</div>
			</div>

		<?php endforeach ?>
		</div>
	</div>
</div>
<script type="text/javascript">
(function($) {
	$('.eut-template-filters ul > li').each(function(){
		if($(this).attr('data-filter') == '*') {
			$(this).find('.eut-count').html( $('#eut-template-item-grid .eut-template-item').length );
		} else {
			$(this).find('.eut-count').html( $('#eut-template-item-grid .eut-template-item.' + $(this).attr('data-filter') ).length );
		}
	});
	$('.eut-template-filters li[data-filter="*"]').addClass('active').trigger('click');
	$('.eut-template-filters li').click(function(){
		$('.eut-template-filters li').removeClass('active');
		$(this).addClass('active');
		var $filter = $(this).attr('data-filter');
		$('#eut-template-item-grid .eut-template-item').hide();
		if( $filter != '*' ){
			$('#eut-template-item-grid .eut-template-item.' + $filter ).fadeIn('1000');
		} else {
			$('#eut-template-item-grid .eut-template-item').fadeIn('1000');
		}
	});
})(jQuery);
</script>
