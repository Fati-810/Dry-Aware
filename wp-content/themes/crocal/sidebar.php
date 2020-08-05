<?php

/*
*	Main sidebar area
*
* 	@version	1.0
* 	@author		Euthemians Team
* 	@URI		http://euthemians.com
*/

$fixed = "";
$crocal_eutf_fixed_sidebar = "no";
$crocal_eutf_sidebar_extra_content = false;

$sidebar_view = crocal_eutf_get_current_view();
if ( 'search_page' == $sidebar_view ) {
	$crocal_eutf_sidebar_id = crocal_eutf_option( 'search_page_sidebar' );
	$crocal_eutf_sidebar_layout = crocal_eutf_option( 'search_page_layout', 'none' );
	$crocal_eutf_fixed_sidebar = crocal_eutf_option( 'search_page_fixed_sidebar', 'no' );
} else if ( 'forum' == $sidebar_view ) {
	$crocal_eutf_sidebar_id = crocal_eutf_option( 'forum_sidebar' );
	$crocal_eutf_sidebar_layout = crocal_eutf_option( 'forum_layout', 'none' );
	$crocal_eutf_fixed_sidebar = crocal_eutf_option( 'forum_fixed_sidebar', 'no' );
} else if ( 'shop' == $sidebar_view ) {
	if ( is_search() ) {
		$crocal_eutf_sidebar_id = crocal_eutf_option( 'product_search_sidebar' );
		$crocal_eutf_sidebar_layout = crocal_eutf_option( 'product_search_layout', 'none' );
		$crocal_eutf_fixed_sidebar = crocal_eutf_option( 'product_search_fixed_sidebar', 'no' );
	} else if ( is_shop() ) {
		$crocal_eutf_sidebar_id = crocal_eutf_post_meta_shop( '_crocal_eutf_sidebar', crocal_eutf_option( 'page_sidebar' ) );
		$crocal_eutf_sidebar_layout = crocal_eutf_post_meta_shop( '_crocal_eutf_layout', crocal_eutf_option( 'page_layout', 'none' ) );
		$crocal_eutf_fixed_sidebar =  crocal_eutf_post_meta_shop( '_crocal_eutf_fixed_sidebar' , crocal_eutf_option( 'page_fixed_sidebar', 'no' ) );
	} else if( is_product() ) {
		$crocal_eutf_sidebar_id = crocal_eutf_post_meta( '_crocal_eutf_sidebar', crocal_eutf_option( 'product_sidebar' ) );
		$crocal_eutf_sidebar_layout = crocal_eutf_post_meta( '_crocal_eutf_layout', crocal_eutf_option( 'product_layout', 'none' ) );
		$crocal_eutf_fixed_sidebar =  crocal_eutf_post_meta( '_crocal_eutf_fixed_sidebar' , crocal_eutf_option( 'product_fixed_sidebar', 'no' ) );
	} else {
		$crocal_eutf_sidebar_id = crocal_eutf_option( 'product_tax_sidebar' );
		$crocal_eutf_sidebar_layout = crocal_eutf_option( 'product_tax_layout', 'none' );
		$crocal_eutf_fixed_sidebar = crocal_eutf_option( 'product_tax_fixed_sidebar', 'no' );
	}
}  else if ( 'event' == $sidebar_view ) {
	if ( is_singular( 'tribe_events' ) ) {
		$crocal_eutf_sidebar_id = crocal_eutf_post_meta( '_crocal_eutf_sidebar', crocal_eutf_option( 'event_sidebar' ) );
		$crocal_eutf_sidebar_layout = crocal_eutf_post_meta( '_crocal_eutf_layout', crocal_eutf_option( 'event_layout', 'none' ) );
		$crocal_eutf_fixed_sidebar =  crocal_eutf_post_meta( '_crocal_eutf_fixed_sidebar' , crocal_eutf_option( 'event_fixed_sidebar', 'no' ) );
	} else {
		$crocal_eutf_sidebar_id = crocal_eutf_option( 'event_tax_sidebar' );
		$crocal_eutf_sidebar_layout = crocal_eutf_option( 'event_tax_layout', 'none' );
		$crocal_eutf_fixed_sidebar = crocal_eutf_option( 'event_tax_fixed_sidebar', 'no' );
	}
} else if ( is_singular() ) {
	if ( is_singular( 'post' ) ) {
		$crocal_eutf_sidebar_id = crocal_eutf_post_meta( '_crocal_eutf_sidebar', crocal_eutf_option( 'post_sidebar' ) );
		$crocal_eutf_sidebar_layout = crocal_eutf_post_meta( '_crocal_eutf_layout', crocal_eutf_option( 'post_layout', 'none' ) );
		$crocal_eutf_fixed_sidebar =  crocal_eutf_post_meta( '_crocal_eutf_fixed_sidebar' , crocal_eutf_option( 'post_fixed_sidebar', 'no' ) );
	} else if ( is_singular( 'portfolio' ) ) {
		$crocal_eutf_sidebar_id = crocal_eutf_post_meta( '_crocal_eutf_sidebar', crocal_eutf_option( 'portfolio_sidebar' ) );
		$crocal_eutf_sidebar_layout = crocal_eutf_post_meta( '_crocal_eutf_layout', crocal_eutf_option( 'portfolio_layout', 'none' ) );
		$crocal_eutf_fixed_sidebar =  crocal_eutf_post_meta( '_crocal_eutf_fixed_sidebar' , crocal_eutf_option( 'portfolio_fixed_sidebar', 'no' ) );
		$crocal_eutf_sidebar_extra_content = crocal_eutf_check_portfolio_details();
		if( $crocal_eutf_sidebar_extra_content && 'none' == $crocal_eutf_sidebar_layout ) {
			$crocal_eutf_sidebar_layout = 'right';
		}
	} else {
		$crocal_eutf_sidebar_id = crocal_eutf_post_meta( '_crocal_eutf_sidebar', crocal_eutf_option( 'page_sidebar' ) );
		$crocal_eutf_sidebar_layout = crocal_eutf_post_meta( '_crocal_eutf_layout', crocal_eutf_option( 'page_layout', 'none' ) );
		$crocal_eutf_fixed_sidebar =  crocal_eutf_post_meta( '_crocal_eutf_fixed_sidebar' , crocal_eutf_option( 'page_fixed_sidebar', 'no' ) );
	}
} else {
	$crocal_eutf_sidebar_id = crocal_eutf_option( 'blog_sidebar' );
	$crocal_eutf_sidebar_layout = crocal_eutf_option( 'blog_layout', 'none' );
	$crocal_eutf_fixed_sidebar = crocal_eutf_option( 'blog_fixed_sidebar', 'no' );
}

	if ( 'yes' == $crocal_eutf_fixed_sidebar ) {
		$fixed = " eut-fixed-sidebar";
	}

if ( 'none' != $crocal_eutf_sidebar_layout && ( is_active_sidebar( $crocal_eutf_sidebar_id ) || $crocal_eutf_sidebar_extra_content ) ) {
	if ( 'left' == $crocal_eutf_sidebar_layout || 'right' == $crocal_eutf_sidebar_layout ) {

		$crocal_eutf_sidebar_class = 'eut-sidebar' . $fixed;
?>
		<!-- Sidebar -->
		<aside id="eut-sidebar" class="<?php echo esc_attr( $crocal_eutf_sidebar_class ); ?>">
			<div class="eut-wrapper clearfix">
				<?php
					if ( $crocal_eutf_sidebar_extra_content ) {
						crocal_eutf_print_portfolio_details();
					}
				?>
				<?php dynamic_sidebar( $crocal_eutf_sidebar_id ); ?>
			</div>
		</aside>
		<!-- End Sidebar -->
<?php
	}
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
