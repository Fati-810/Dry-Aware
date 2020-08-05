<?php
/*
*	Admin Page Welcome
*
* 	@author		Euthemians Team
* 	@URI		http://euthemians.com
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$docs_link = 'https://docs.euthemians.com/theme/crocal/';
$videos_link = 'https://www.youtube.com/channel/UCNp1cNhcLQKJm81q9hAKAcw';
$support_link = 'https://euthemians.ticksy.com';

?>
	<div id="eut-welcome-wrap" class="wrap">
		<h2><?php esc_html_e( "Welcome", 'crocal' ); ?></h2>
		<?php crocal_eutf_print_admin_links('welcome'); ?>
		<div id="eut-welcome-panel" class="eut-admin-panel">
			<div class="eut-admin-panel-content">
				<h2><?php esc_html_e( "Welcome to Crocal!", 'crocal' ); ?></h2>
				<p class="about-description"><?php esc_html_e( "Thank you so much for this purchase. You are now ready to use another premium WordPress theme by Euthemians. Be sure that we'd be happy to support you all the way through and make Crocal Theme a lasting experience.", 'crocal' ); ?></p>
				<div class="eut-admin-panel-container">
					<div class="eut-admin-panel-row">
						<div class="eut-admin-panel-column eut-admin-panel-column-1-3">
							<div class="eut-admin-panel-column-content">
								<img class="eut-admin-panel-icon" src="<?php echo get_template_directory_uri() .'/includes/images/admin-icons/live-tutorial.jpg'?>" alt="<?php esc_attr_e( "Live Tutorial", 'crocal' ); ?>">
								<h3><?php esc_html_e( "Live Tutorial", 'crocal' ); ?></h3>
								<p><?php esc_html_e( "We hope that in our Live Knowledgebase you will find all required information to get your site running.", 'crocal' ); ?></p>
								<a href="<?php echo esc_url( $docs_link ); ?>" class="eut-admin-panel-more" target="_blank"><?php esc_html_e( "Read More", 'crocal' ); ?></a>
							</div>
						</div>
						<div class="eut-admin-panel-column eut-admin-panel-column-1-3">
							<div class="eut-admin-panel-column-content">
								<img class="eut-admin-panel-icon" src="<?php echo get_template_directory_uri() .'/includes/images/admin-icons/video-tutorial.jpg'?>" alt="<?php esc_attr_e( "Video Tutorials", 'crocal' ); ?>">
								<h3><?php esc_html_e( "Video Tutorials", 'crocal' ); ?></h3>
								<p><?php esc_html_e( "We also recommend to check out our Video Tutorials. The easiest way to discover the amazing features of Crocal.", 'crocal' ); ?></p>
								<a href="<?php echo esc_url( $videos_link ); ?>" class="eut-admin-panel-more" target="_blank"><?php esc_html_e( "Read More", 'crocal' ); ?></a>
							</div>
						</div>
						<div class="eut-admin-panel-column eut-admin-panel-column-1-3">
							<div class="eut-admin-panel-column-content">
								<img class="eut-admin-panel-icon" src="<?php echo get_template_directory_uri() .'/includes/images/admin-icons/support-system.jpg'?>" alt="<?php esc_attr_e( "Support System", 'crocal' ); ?>">
								<h3><?php esc_html_e( "Support System", 'crocal' ); ?></h3>
								<p><?php esc_html_e( "Still no luck? No worries, we are here to help. Contact our support agents and they will get back to you as soon as possible.", 'crocal' ); ?></p>
								<a href="<?php echo esc_url( $support_link ); ?>" class="eut-admin-panel-more" target="_blank"><?php esc_html_e( "Read More", 'crocal' ); ?></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php

//Omit closing PHP tag to avoid accidental whitespace output errors.
