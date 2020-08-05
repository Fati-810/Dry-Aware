<?php
/*
*	Admin Page Import
*
* 	@author		Euthemians Team
* 	@URI		http://euthemians.com
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( class_exists( 'Crocal_Importer' ) ) {
	$import_url = admin_url( 'admin.php?import=crocal-demo-importer' );
} else {
	$import_url = admin_url( 'admin.php?page=crocal-tgmpa-install-plugins' );
}

?>
	<div id="eut-import-wrap" class="wrap">
		<h2><?php esc_html_e( "Import Demos", 'crocal' ); ?></h2>
		<?php crocal_eutf_print_admin_links('import'); ?>
		<div id="eut-import-panel" class="eut-admin-panel">
			<div class="eut-admin-panel-content">
				<h2><?php esc_html_e( "The Easiest Ways to Import Crocal Demo Content", 'crocal' ); ?></h2>
				<p class="about-description"><?php esc_html_e( "Crocal offers you two options to import the content of our theme. With the first one, the Import on Demand, you can import specific pages, posts, portfolios. With the second one, the Full Import Demo, you can import any of the available demos. It's up to you!", 'crocal' ); ?></p>
				<?php if ( class_exists( 'Crocal_Importer' ) ) { ?>
				<a href="<?php echo esc_url( $import_url ); ?>" class="eut-admin-panel-btn"><?php esc_html_e( "Import Demos", 'crocal' ); ?></a>
				<?php } else { ?>
				<a href="<?php echo esc_url( $import_url ); ?>" class="eut-admin-panel-btn"><?php esc_html_e( "Install/Activate Demo Importer", 'crocal' ); ?></a>
				<?php } ?>
				<div class="eut-admin-panel-container">
					<div class="eut-admin-panel-row">
						<div class="eut-admin-panel-column eut-admin-panel-column-1-2">
							<div class="eut-admin-panel-column-content">
								<iframe width="100%" height="290" src="https://www.youtube-nocookie.com/embed/W8j2yaKIS3Y" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
								<h3><?php esc_html_e( "Import on Demand", 'crocal' ); ?></h3>
								<p><?php esc_html_e( "Do you just need specific pages or portfolios, posts, products of our demo content to create your site? Select the ones you prefer via the available multi selectors under Crocal Demos.", 'crocal' ); ?></p>
							</div>
						</div>
						<div class="eut-admin-panel-column eut-admin-panel-column-1-2">
							<div class="eut-admin-panel-column-content">
								<iframe width="100%" height="290" src="https://www.youtube-nocookie.com/embed/DGyKX_3LuiM" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
								<h3><?php esc_html_e( "Full Import", 'crocal' ); ?></h3>
								<p><?php esc_html_e( "Of course, you can still import the whole dummy content. With Crocal you have the possibility to import any of the demos with just ONE click.", 'crocal' ); ?></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php

//Omit closing PHP tag to avoid accidental whitespace output errors.
