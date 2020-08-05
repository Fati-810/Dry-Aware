<!doctype html>

<html class="no-js" <?php language_attributes(); ?>>

	<head>
		<meta charset="<?php echo esc_attr( get_bloginfo( 'charset' ) ); ?>">
		<?php if ( is_singular() && pings_open( get_queried_object() ) ) { ?>
		<!-- allow pinned sites -->
		<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
		<?php } ?>
		<?php wp_head(); ?>
	</head>
<?php
		// Theme Layout
		$crocal_eutf_theme_layout = crocal_eutf_option( 'theme_layout', 'stretched' );
		$crocal_eutf_frame_size = crocal_eutf_option( 'frame_size', 30 );
?>
	<body <?php body_class(); ?>>
		<?php do_action( 'crocal_eutf_body_top' ); ?>
		<?php if ( 'framed' == $crocal_eutf_theme_layout ) { ?>
		<div id="eut-frames" data-frame-size="<?php echo esc_attr( $crocal_eutf_frame_size ); ?>">
			<div class="eut-frame eut-top"></div>
			<div class="eut-frame eut-left"></div>
			<div class="eut-frame eut-right"></div>
			<div class="eut-frame eut-bottom"></div>
		</div>
		<?php } ?>
		<?php crocal_eutf_print_theme_loader(); ?>

		<!-- Theme Wrapper -->
		<div id="eut-theme-wrapper">
			<div class="eut-wrapper-inner">
				<div id="eut-theme-content">
