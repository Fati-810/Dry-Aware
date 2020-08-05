<?php

/*
*	Main theme functions and definitions
*
* 	@version	1.0
* 	@author		Euthemians Team
* 	@URI		http://euthemians.com
*/

/**
 * Theme Definitions
 * Please leave these settings unchanged
 */

define( 'CROCAL_EUTF_THEME_VERSION', '1.2.1' );
define( 'CROCAL_EUTF_THEME_REDUX_CUSTOM_PANEL', false);

/**
 * Set up the content width value based on the theme's design.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1080;
}

/**
 * Theme textdomain - must be loaded before redux
 */
load_theme_textdomain( 'crocal', get_template_directory() . '/languages' );

/**
 * Include Global helper files
 */
require_once get_template_directory() . '/includes/eut-gutenberg.php';
require_once get_template_directory() . '/includes/eut-global.php';
require_once get_template_directory() . '/includes/eut-meta-tags.php';
require_once get_template_directory() . '/includes/eut-privacy-functions.php';
require_once get_template_directory() . '/includes/eut-woocommerce-functions.php';
require_once get_template_directory() . '/includes/eut-bbpress-functions.php';
require_once get_template_directory() . '/includes/eut-events-calendar-functions.php';

/**
 * Register Plugins Libraries
 */
if ( is_admin() ) {
	require_once get_template_directory() . '/includes/plugins/tgm-plugin-activation/register-plugins.php';
}

require_once get_template_directory() . '/includes/admin/eut-admin-custom-sidebars.php';
require_once get_template_directory() . '/includes/admin/eut-admin-screens.php';

/**
 * ReduxFramework
 */
require_once get_template_directory() . '/includes/admin/eut-redux-extension-loader.php';

if ( !class_exists( 'ReduxFramework' ) && file_exists( get_template_directory() . '/includes/framework/framework.php' ) ) {
    require_once get_template_directory() . '/includes/framework/framework.php';
}

if ( !isset( $redux_demo ) ) {
	require_once get_template_directory() . '/includes/admin/eut-redux-framework-config.php';
}

function crocal_eutf_remove_redux_demo_link() {
    if ( class_exists('Redux_Framework_Plugin') ) {
		call_user_func( 'remove' . '_filter', 'plugin_row_meta', array( Redux_Framework_Plugin::instance(), 'plugin_metalinks' ), null, 2 );
        remove_action('admin_notices', array( Redux_Framework_Plugin::get_instance(), 'admin_notices' ) );
    }
	if ( class_exists('ReduxFrameworkPlugin') ) {
		call_user_func( 'remove' . '_filter', 'plugin_row_meta', array( ReduxFrameworkPlugin::instance(), 'plugin_metalinks' ), null, 2 );
        remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );
    }
}
add_action('init', 'crocal_eutf_remove_redux_demo_link');

/**
 * Custom Nav Menus
 */
require_once get_template_directory() . '/includes/custom-menu/eut-custom-nav-menu.php';

/**
 * Visual Composer Extentions
 */
if ( class_exists( 'WPBakeryVisualComposerAbstract' ) ) {

	function crocal_eutf_add_vc_extentions() {
		require_once get_template_directory() . '/vc_extend/eut-shortcodes-vc-helper.php';
		require_once get_template_directory() . '/vc_extend/eut-shortcodes-vc-remove.php';
		require_once get_template_directory() . '/vc_extend/eut-shortcodes-vc-add.php';
	}
	add_action( 'init', 'crocal_eutf_add_vc_extentions', 5 );

}

/**
 * Include admin helper files
 */
require_once get_template_directory() . '/includes/admin/eut-admin-functions.php';
require_once get_template_directory() . '/includes/admin/eut-admin-option-functions.php';
require_once get_template_directory() . '/includes/admin/eut-admin-feature-functions.php';
require_once get_template_directory() . '/includes/admin/eut-meta-functions.php';
require_once get_template_directory() . '/includes/admin/eut-category-meta.php';
require_once get_template_directory() . '/includes/admin/eut-post-meta.php';

require_once get_template_directory() . '/includes/admin/eut-portfolio-meta.php';
require_once get_template_directory() . '/includes/admin/eut-testimonial-meta.php';
require_once get_template_directory() . '/includes/eut-wp-gallery.php';

/**
 * Include Dynamic
 */
require_once get_template_directory() . '/includes/eut-dynamic-css-generator.php';
require_once get_template_directory() . '/includes/eut-dynamic-css-loader.php';

/**
 * Include helper files
 */
require_once get_template_directory() . '/includes/eut-breadcrumbs.php';
require_once get_template_directory() . '/includes/eut-excerpt.php';
require_once get_template_directory() . '/includes/eut-vce-functions.php';
require_once get_template_directory() . '/includes/eut-header-functions.php';
require_once get_template_directory() . '/includes/eut-feature-functions.php';
require_once get_template_directory() . '/includes/eut-layout-functions.php';
require_once get_template_directory() . '/includes/eut-blog-functions.php';
require_once get_template_directory() . '/includes/eut-portfolio-functions.php';
require_once get_template_directory() . '/includes/eut-media-functions.php';
require_once get_template_directory() . '/includes/eut-footer-functions.php';

add_action( 'after_switch_theme', 'crocal_eutf_theme_activate' );
add_action( 'after_setup_theme', 'crocal_eutf_theme_setup' );
add_action( 'widgets_init', 'crocal_eutf_register_sidebars' );

/**
 * Theme activation function
 * Used whe activating the theme
 */
function crocal_eutf_theme_activate() {

	update_option( 'crocal_eutf_theme_version', CROCAL_EUTF_THEME_VERSION );

	flush_rewrite_rules();
}

/**
 * Theme setup function
 * Theme support
 */
function crocal_eutf_theme_setup() {

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails', array( 'post' ) );
	add_theme_support( 'post-formats', array( 'gallery', 'link', 'quote', 'video', 'audio' ) );
	add_theme_support( 'title-tag' );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'style-editor.css' );

    add_theme_support(
		'editor-color-palette',
		array(
			array(
				'name' => __( 'Primary 1', 'crocal' ),
				'slug' => 'primary-1',
				'color' => crocal_eutf_option( 'body_primary_1_color' ),
			),
			array(
				'name' => __( 'Primary 2', 'crocal' ),
				'slug' => 'primary-2',
				'color' => crocal_eutf_option( 'body_primary_2_color' ),
			),
			array(
				'name' => __( 'Primary 3', 'crocal' ),
				'slug' => 'primary-3',
				'color' => crocal_eutf_option( 'body_primary_3_color' ),
			),
			array(
				'name' => __( 'Primary 4', 'crocal' ),
				'slug' => 'primary-4',
				'color' => crocal_eutf_option( 'body_primary_4_color' ),
			),
			array(
				'name' => __( 'Primary 5', 'crocal' ),
				'slug' => 'primary-5',
				'color' => crocal_eutf_option( 'body_primary_5_color' ),
			),
			array(
				'name' => __( 'Primary 6', 'crocal' ),
				'slug' => 'primary-6',
				'color' => crocal_eutf_option( 'body_primary_6_color' ),
			),
			array(
				'name' => __( 'Green', 'crocal' ),
				'slug' => 'green',
				'color' => '#6ECA09',
			),
			array(
				'name' => __( 'Red', 'crocal' ),
				'slug' => 'red',
				'color' => '#D0021B',
			),
			array(
				'name' => __( 'Orange', 'crocal' ),
				'slug' => 'orange',
				'color' => '#FAB901',
			),
			array(
				'name' => __( 'Aqua', 'crocal' ),
				'slug' => 'aqua',
				'color' => '#28d2dc',
			),
			array(
				'name' => __( 'Blue', 'crocal' ),
				'slug' => 'blue',
				'color' => '#15c7ff',
			),
			array(
				'name' => __( 'Purple', 'crocal' ),
				'slug' => 'purple',
				'color' => '#7639e2',
			),
			array(
				'name' => __( 'Grey', 'crocal' ),
				'slug' => 'grey',
				'color' => '#808080',
			),
			array(
				'name' => __( 'Dark Grey', 'crocal' ),
				'slug' => 'dark-grey',
				'color' => '#252525',
			),
			array(
				'name' => __( 'Light Grey', 'crocal' ),
				'slug' => 'light-grey',
				'color' => '#FAFAFA',
			),
			array(
				'name' => __( 'Black', 'crocal' ),
				'slug' => 'black',
				'color' => '#000000',
			),
			array(
				'name' => __( 'White', 'crocal' ),
				'slug' => 'white',
				'color' => '#ffffff',
			),
		)
	);


	$size_large_landscape_wide = crocal_eutf_option( 'size_large_landscape_wide', array( 'width'   => '1390', 'height'  => '782') );
	$size_small_square = crocal_eutf_option( 'size_small_square', array( 'width'   => '560', 'height'  => '560') );
	$size_small_landscape = crocal_eutf_option( 'size_small_landscape', array( 'width'   => '560', 'height'  => '420') );
	$size_small_portrait = crocal_eutf_option( 'size_small_portrait', array( 'width'   => '560', 'height'  => '747') );
	$size_medium_square = crocal_eutf_option( 'size_medium_square', array( 'width'   => '900', 'height'  => '900') );
	$size_medium_landscape = crocal_eutf_option( 'size_medium_landscape', array( 'width'   => '900', 'height'  => '675') );
	$size_medium_portrait = crocal_eutf_option( 'size_medium_portrait', array( 'width'   => '840', 'height'  => '1120') );
	$size_fullscreen = crocal_eutf_option( 'size_fullscreen', array( 'width'   => '1920', 'height'  => '1920') );

	add_image_size( 'crocal-eutf-large-rect-horizontal', $size_large_landscape_wide['width'], $size_large_landscape_wide['height'], true );
	add_image_size( 'crocal-eutf-small-square', $size_small_square['width'], $size_small_square['height'], true );
	add_image_size( 'crocal-eutf-small-rect-horizontal', $size_small_landscape['width'], $size_small_landscape['height'], true );
	add_image_size( 'crocal-eutf-small-rect-vertical', $size_small_portrait['width'], $size_small_portrait['height'], true );
	add_image_size( 'crocal-eutf-medium-square', $size_medium_square['width'], $size_medium_square['height'], true );
	add_image_size( 'crocal-eutf-medium-rect-horizontal', $size_medium_landscape['width'], $size_medium_landscape['height'], true );
	add_image_size( 'crocal-eutf-medium-rect-vertical', $size_medium_portrait['width'], $size_medium_portrait['height'], true );
	add_image_size( 'crocal-eutf-fullscreen', $size_fullscreen['width'], $size_fullscreen['height'], false );

	register_nav_menus(
		array(
			'crocal_header_nav' => esc_html__( 'Header Menu', 'crocal' ),
			'crocal_responsive_nav' => esc_html__( 'Responsive Menu', 'crocal' ),
			'crocal_top_left_nav' => esc_html__( 'Top Left Menu', 'crocal' ),
			'crocal_top_right_nav' => esc_html__( 'Top Right Menu', 'crocal' ),
			'crocal_footer_nav' => esc_html__( 'Footer Menu', 'crocal' ),
		)
	);

}

function crocal_eutf_add_excerpt_support_for_pages() {
    add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'crocal_eutf_add_excerpt_support_for_pages' );

/**
 * Navigation Menus
 */
if ( ! function_exists( 'crocal_eutf_get_header_nav' ) ) {
	function crocal_eutf_get_header_nav() {

		$crocal_eutf_main_menu = '';

		if ( 'default' == crocal_eutf_option( 'menu_header_integration', 'default' ) ) {

			if ( is_singular() ) {
				if ( 'yes' == crocal_eutf_post_meta( '_crocal_eutf_disable_menu' ) ) {
					return 'disabled';
				} else {
					$crocal_eutf_main_menu	= crocal_eutf_post_meta( '_crocal_eutf_main_navigation_menu' );
					$crocal_eutf_main_menu = apply_filters( 'wpml_object_id', $crocal_eutf_main_menu, 'nav_menu', TRUE  );
				}
			} else if ( crocal_eutf_is_woo_shop() ) {
				if ( 'yes' == crocal_eutf_post_meta_shop( '_crocal_eutf_disable_menu' ) ) {
					return 'disabled';
				} else {
					$crocal_eutf_main_menu	= crocal_eutf_post_meta_shop( '_crocal_eutf_main_navigation_menu' );
					$crocal_eutf_main_menu = apply_filters( 'wpml_object_id', $crocal_eutf_main_menu, 'nav_menu', TRUE  );
				}
			}
		} else {
			$crocal_eutf_main_menu = 'disabled';
		}

		return $crocal_eutf_main_menu;
	}
}

if ( ! function_exists( 'crocal_eutf_get_responsive_nav' ) ) {
	function crocal_eutf_get_responsive_nav() {

		$crocal_eutf_main_menu = '';

		if ( 'default' == crocal_eutf_option( 'menu_header_integration', 'default' ) ) {

			if ( is_singular() ) {
				if ( 'yes' == crocal_eutf_post_meta( '_crocal_eutf_disable_menu' ) ) {
					return 'disabled';
				} else {
					$crocal_eutf_main_menu	= crocal_eutf_post_meta( '_crocal_eutf_responsive_navigation_menu' );
					$crocal_eutf_main_menu = apply_filters( 'wpml_object_id', $crocal_eutf_main_menu, 'nav_menu', TRUE  );
				}
			} else if ( crocal_eutf_is_woo_shop() ) {
				if ( 'yes' == crocal_eutf_post_meta_shop( '_crocal_eutf_disable_menu' ) ) {
					return 'disabled';
				} else {
					$crocal_eutf_main_menu	= crocal_eutf_post_meta_shop( '_crocal_eutf_responsive_navigation_menu' );
					$crocal_eutf_main_menu = apply_filters( 'wpml_object_id', $crocal_eutf_main_menu, 'nav_menu', TRUE  );
				}
			}
		} else {
			$crocal_eutf_main_menu = 'disabled';
		}

		return $crocal_eutf_main_menu;
	}
}

if ( ! function_exists( 'crocal_eutf_header_nav' ) ) {
	function crocal_eutf_header_nav( $crocal_eutf_main_menu = '', $crocal_eutf_header_menu_mode = 'default') {

		if( 'split' == $crocal_eutf_header_menu_mode ) {
			$walker = new Crocal_Eutf_Split_Navigation_Walker();
		} else {
			$walker = new Crocal_Eutf_Main_Navigation_Walker();
		}

		if ( empty( $crocal_eutf_main_menu ) ) {

			wp_nav_menu(
				array(
					'menu_class' => 'eut-menu', /* menu class */
					'theme_location' => 'crocal_header_nav', /* where in the theme it's assigned */
					'container' => false,
					'fallback_cb' => 'crocal_eutf_fallback_menu',
					'link_before' => '<span class="eut-item">',
					'link_after' => '</span>',
					'walker' => $walker,
				)
			);
		} else {
			//Custom Alternative Menu
			wp_nav_menu(
				array(
					'menu_class' => 'eut-menu', /* menu class */
					'menu' => $crocal_eutf_main_menu, /* menu name */
					'container' => false,
					'fallback_cb' => 'crocal_eutf_fallback_menu',
					'link_before' => '<span class="eut-item">',
					'link_after' => '</span>',
					'walker' => $walker,
				)
			);
		}
	}
}

if ( ! function_exists( 'crocal_eutf_responsive_nav' ) ) {
	function crocal_eutf_responsive_nav( $crocal_eutf_main_menu = '' ) {

		if ( empty( $crocal_eutf_main_menu ) ) {
			wp_nav_menu(
				array(
					'menu_class' => 'eut-menu', /* menu class */
					'theme_location' => 'crocal_responsive_nav', /* where in the theme it's assigned */
					'container' => false,
					'fallback_cb' => 'crocal_eutf_fallback_menu',
					'link_before' => '<span class="eut-item">',
					'link_after' => '</span>',
					'walker' => new Crocal_Eutf_Main_Navigation_Walker(),
				)
			);
		} else {
			//Custom Alternative Menu
			wp_nav_menu(
				array(
					'menu_class' => 'eut-menu', /* menu class */
					'menu' => $crocal_eutf_main_menu, /* menu name */
					'container' => false,
					'fallback_cb' => 'crocal_eutf_fallback_menu',
					'link_before' => '<span class="eut-item">',
					'link_after' => '</span>',
					'walker' => new Crocal_Eutf_Main_Navigation_Walker(),
				)
			);
		}
	}
}

/**
 * Main Navigation FallBack Menu
 */
if ( ! function_exists( 'crocal_eutf_fallback_menu' ) ) {
	function crocal_eutf_fallback_menu(){

		if( current_user_can( 'administrator' ) ) {
			echo '<span class="eut-no-assigned-menu eut-small-text">';
			echo esc_html__( 'Header Menu is not assigned!', 'crocal'  ) . " " .
			"<a href='" . esc_url( admin_url() ) . "nav-menus.php?action=locations' target='_blank'>" . esc_html__( "Manage Locations", 'crocal' ) . "</a>";
			echo '</span>';
		}
	}
}

function crocal_eutf_footer_nav() {

	wp_nav_menu(
		array(
			'theme_location' => 'crocal_footer_nav',
			'container' => false, /* no container */
			'depth' => '1',
			'fallback_cb' => false,
			'walker' => new Crocal_Eutf_Simple_Navigation_Walker(),
		)
	);

}

function crocal_eutf_top_left_nav() {

	wp_nav_menu(
		array(
			'theme_location' => 'crocal_top_left_nav',
			'container' => false, /* no container */
			'depth' => '2',
			'fallback_cb' => false,
			'walker' => new Crocal_Eutf_Simple_Navigation_Walker(),
		)
	);

}

function crocal_eutf_top_right_nav() {

	wp_nav_menu(
		array(
			'theme_location' => 'crocal_top_right_nav',
			'container' => false, /* no container */
			'depth' => '2',
			'fallback_cb' => false,
			'walker' => new Crocal_Eutf_Simple_Navigation_Walker(),
		)
	);

}

/**
 * Sidebars & Widgetized Areas
 */
function crocal_eutf_register_sidebars() {

	$sidebar_heading_tag = crocal_eutf_option( 'sidebar_heading_tag', 'div' );
	$footer_heading_tag = crocal_eutf_option( 'footer_heading_tag', 'div' );

	register_sidebar( array(
		'id' => 'eut-default-sidebar',
		'name' => esc_html__( 'Main Sidebar', 'crocal' ),
		'description' => esc_html__( 'Main Sidebar Widget Area', 'crocal' ),
		'before_widget' => '<div id="%1$s" class="eut-widget widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<' . tag_escape( $sidebar_heading_tag ) . ' class="eut-widget-title">',
		'after_title' => '</' . tag_escape( $sidebar_heading_tag ) . '>',
	));

	register_sidebar( array(
		'id' => 'eut-single-portfolio-sidebar',
		'name' => esc_html__( 'Single Portfolio', 'crocal' ),
		'description' => esc_html__( 'Single Portfolio Sidebar Widget Area', 'crocal' ),
		'before_widget' => '<div id="%1$s" class="eut-widget widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<' . tag_escape( $sidebar_heading_tag ) . ' class="eut-widget-title">',
		'after_title' => '</' . tag_escape( $sidebar_heading_tag ) . '>',
	));

	register_sidebar( array(
		'id' => 'eut-footer-1-sidebar',
		'name' => esc_html__( 'Footer 1', 'crocal' ),
		'description' => esc_html__( 'Footer 1 Widget Area', 'crocal' ),
		'before_widget' => '<div id="%1$s" class="eut-widget widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<' . tag_escape( $footer_heading_tag ) . ' class="eut-widget-title">',
		'after_title' => '</' . tag_escape( $footer_heading_tag ) . '>',
	));
	register_sidebar( array(
		'id' => 'eut-footer-2-sidebar',
		'name' => esc_html__( 'Footer 2', 'crocal' ),
		'description' => esc_html__( 'Footer 2 Widget Area', 'crocal' ),
		'before_widget' => '<div id="%1$s" class="eut-widget widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<' . tag_escape( $footer_heading_tag ) . ' class="eut-widget-title">',
		'after_title' => '</' . tag_escape( $footer_heading_tag ) . '>',
	));
	register_sidebar( array(
		'id' => 'eut-footer-3-sidebar',
		'name' => esc_html__( 'Footer 3', 'crocal' ),
		'description' => esc_html__( 'Footer 3 Widget Area', 'crocal' ),
		'before_widget' => '<div id="%1$s" class="eut-widget widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<' . tag_escape( $footer_heading_tag ) . ' class="eut-widget-title">',
		'after_title' => '</' . tag_escape( $footer_heading_tag ) . '>',
	));
	register_sidebar( array(
		'id' => 'eut-footer-4-sidebar',
		'name' => esc_html__( 'Footer 4', 'crocal' ),
		'description' => esc_html__( 'Footer 4 Widget Area', 'crocal' ),
		'before_widget' => '<div id="%1$s" class="eut-widget widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<' . tag_escape( $footer_heading_tag ) . ' class="eut-widget-title">',
		'after_title' => '</' . tag_escape( $footer_heading_tag ) . '>',
	));

	$crocal_eutf_custom_sidebars = get_option( '_crocal_eutf_custom_sidebars' );
	if ( ! empty( $crocal_eutf_custom_sidebars ) ) {
		foreach ( $crocal_eutf_custom_sidebars as $crocal_eutf_custom_sidebar ) {
			register_sidebar( array(
				'id' => $crocal_eutf_custom_sidebar['id'],
				'name' => esc_html__( 'Custom Sidebar', 'crocal' ) . ': ' . esc_html( $crocal_eutf_custom_sidebar['name'] ),
				'description' => '',
				'before_widget' => '<div id="%1$s" class="eut-widget widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<' . tag_escape( $sidebar_heading_tag ) . ' class="eut-widget-title">',
				'after_title' => '</' . tag_escape( $sidebar_heading_tag ) . '>',
			));
		}
	}

}

/**
 * Custom Modal Search Form
 */
if ( ! function_exists( 'crocal_eutf_modal_wpsearch' ) ) {
	function crocal_eutf_modal_wpsearch() {

		$search_modal_text = crocal_eutf_option( 'search_modal_text' );
		$search_modal_button_text = crocal_eutf_option( 'search_modal_button_text' );

		$form = '';
		$form .= '<form class="eut-search eut-search-modal" method="get" action="' . esc_url( home_url( '/' ) ) . '" >';
		if( !empty( $search_modal_text ) ) {
			$form .= '<div class="eut-search-title eut-heading-color eut-h2">' . wp_kses( $search_modal_text , array( 'br' => array() ) ) . '</div>';
		}
		$form .= '  <input type="text" class="eut-search-textfield eut-h2 eut-border" value="' . get_search_query() . '" name="s" autocomplete="off"/>';
		$form .= '  <input class="eut-search-btn" type="submit" value="' . esc_attr( $search_modal_button_text  ) . '">';
		if ( defined( 'ICL_SITEPRESS_VERSION' ) && defined( 'ICL_LANGUAGE_CODE' ) ) {
			$form .= '<input type="hidden" name="lang" value="'. esc_attr( ICL_LANGUAGE_CODE ) .'"/>';
		}
		$form .= '</form>';
		return $form;
	}
}

/**
 * Enqueue scripts and styles for the front end.
 */
function crocal_eutf_frontend_scripts() {

	$crocal_version = trim( CROCAL_EUTF_THEME_VERSION );

	wp_register_style( 'crocal-eutf-style', get_stylesheet_directory_uri()."/style.css", array(), esc_attr( $crocal_version ), 'all' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/all.min.css', array(), '5.7.1' );
	wp_enqueue_style( 'font-awesome-v4-shims', get_template_directory_uri() . '/css/v4-shims.min.css', array( 'font-awesome' ), '5.7.1' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_style( 'crocal-eutf-theme-style', get_template_directory_uri() . '/css/theme-style.css', array(), esc_attr( $crocal_version ) );
	if ( crocal_eutf_woocommerce_enabled() ) {
		wp_enqueue_style( 'crocal-eutf-woocommerce-custom', get_template_directory_uri() . '/css/woocommerce-custom.css', array(), esc_attr( $crocal_version ), 'all' );
	}

	if ( 'openstreetmap' == crocal_eutf_option( 'map_api_mode', 'google-maps' ) ) {
		wp_enqueue_style(  'leaflet', '//unpkg.com/leaflet@1.3.1/dist/leaflet.css', array(), '1.3.1', 'all' );
	}

	wp_enqueue_style( 'crocal-eutf-custom-style', get_template_directory_uri() . '/css/elements.css', array(), esc_attr( $crocal_version ) );

	crocal_eutf_load_dynamic_css();

	if ( is_rtl() ) {
		wp_enqueue_style(  'crocal-eutf-rtl',  get_template_directory_uri() . '/css/rtl.css', array(), esc_attr( $crocal_version ), 'all' );
	}

	if ( get_stylesheet_directory_uri() !=  get_template_directory_uri() ) {
		wp_enqueue_style( 'crocal-eutf-style');
	}

	wp_register_script( 'youtube-iframe-api', '//www.youtube.com/iframe_api', array(), esc_attr( $crocal_version ), true );
	wp_register_script( 'vimeo-api', '//player.vimeo.com/api/player.js', array(), esc_attr( $crocal_version ), true );



	if ( crocal_eutf_is_privacy_key_enabled( 'gmaps' ) ) {
		$gmap_api_key = crocal_eutf_option( 'gmap_api_key' );
		if ( !empty( $gmap_api_key ) ) {
			wp_register_script( 'google-maps-api', '//maps.googleapis.com/maps/api/js?key=' . esc_attr( $gmap_api_key ), NULL, NULL, true );
		} else {
			wp_register_script( 'google-maps-api', '//maps.googleapis.com/maps/api/js?v=3', NULL, NULL, true );
		}
		wp_register_script( 'leaflet-maps-api', '//unpkg.com/leaflet@1.3.1/dist/leaflet.js', array(), '1.3.1', true );


		if ( 'openstreetmap' == crocal_eutf_option( 'map_api_mode', 'google-maps' ) ) {
			wp_register_script( 'crocal-eutf-maps-script', get_template_directory_uri() . '/js/leaflet-maps.js', array( 'jquery', 'leaflet-maps-api' ), esc_attr( $crocal_version ), true );
			$crocal_eutf_maps_data = array(
				'map_tile_url' => crocal_eutf_option( 'map_tile_url', 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png' ),
				'map_tile_url_subdomains' => crocal_eutf_option( 'map_tile_url_subdomains', 'abc' ),
				'map_tile_attribution' => crocal_eutf_option( 'map_tile_attribution' ),
			);
		} else {
			wp_register_script( 'crocal-eutf-maps-script', get_template_directory_uri() . '/js/maps.js', array( 'jquery', 'google-maps-api' ), esc_attr( $crocal_version ), true );
			$crocal_eutf_maps_data = array(
				'custom_enabled' => crocal_eutf_option( 'gmap_custom_enabled', '0' ),
				'water_color' => crocal_eutf_option( 'gmap_water_color', '#424242' ),
				'lanscape_color' => crocal_eutf_option( 'gmap_landscape_color', '#232323' ),
				'poi_color' => crocal_eutf_option( 'gmap_poi_color', '#232323' ),
				'road_color' => crocal_eutf_option( 'gmap_road_color', '#1a1a1a' ),
				'label_color' => crocal_eutf_option( 'gmap_label_color', '#777777' ),
				'label_stroke_color' => crocal_eutf_option( 'gmap_label_stroke_color', '#1a1a1a' ),
				'label_enabled' => crocal_eutf_option( 'gmap_label_enabled', '0' ),
				'country_color' => crocal_eutf_option( 'gmap_country_color', '#000000' ),
				'zoom_enabled' => crocal_eutf_option( 'gmap_zoom_enabled', '0' ),
				'custom_code' => crocal_eutf_option( 'gmap_custom_code', '[]' ),
				'gesture_handling' => crocal_eutf_option( 'gmap_gesture_handling', 'auto' ),
				'type_control' => crocal_eutf_option( 'gmap_type_control', '0' ),
			);
		}
		wp_localize_script( 'crocal-eutf-maps-script', 'crocal_eutf_maps_data', $crocal_eutf_maps_data );
	}

	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.custom.js', array( 'jquery' ), '2.8.3', false );


	if ( '1' == crocal_eutf_option( 'combine_js', '1' ) ) {
		wp_enqueue_script( 'crocal-eutf-extras', get_template_directory_uri() . '/js/extras.js', array( 'jquery' ), esc_attr( $crocal_version ), true );
		wp_enqueue_script( 'crocal-eutf-main-script', get_template_directory_uri() . '/js/main.js', array( 'jquery' ), esc_attr( $crocal_version ), true );
	} else {
		wp_enqueue_script( 'anime', get_template_directory_uri() . '/js/plugins/anime.min.js', array( 'jquery' ), '2.2.0', true );
		wp_enqueue_script( 'sticky-kit', get_template_directory_uri() . '/js/plugins/sticky-kit.min.js', array( 'jquery' ), '1.1.3', true );
		wp_enqueue_script( 'lazysizes', get_template_directory_uri() . '/js/plugins/lazysizes.min.js', array( 'jquery' ), '4.1.2', true );
		wp_enqueue_script( 'jquery-smoothscroll', get_template_directory_uri() . '/js/plugins/smoothscroll.min.js', array( 'jquery' ), '1.4.9', true );
		wp_enqueue_script( 'crocal-eutf-eut', get_template_directory_uri() . '/js/plugins/eut.min.js', array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script( 'raf', get_template_directory_uri() . '/js/plugins/rAF.min.js', array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script( 'hoverIntent' );
		wp_enqueue_script( 'jquery-superfish', get_template_directory_uri() . '/js/plugins/superfish.min.js', array( 'jquery' ), '1.7.9', true );
		wp_enqueue_script( 'snap-svg', get_template_directory_uri() . '/js/plugins/snap.svg.min.js', array( 'jquery' ), '0.5.1', true );
		wp_enqueue_script( 'debounce', get_template_directory_uri() . '/js/plugins/debounce.min.js', array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script( 'jquery-appear', get_template_directory_uri() . '/js/plugins/jquery.appear.min.js', array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script( 'countup', get_template_directory_uri() . '/js/plugins/countUp.min.js', array( 'jquery' ), '1.9.3', true );
		wp_enqueue_script( 'jquery-easypiechart', get_template_directory_uri() . '/js/plugins/jquery.easypiechart.min.js', array( 'jquery' ), '2.1.6', true );
		wp_enqueue_script( 'owlcarousel', get_template_directory_uri() . '/js/plugins/owl.carousel.min.js', array( 'jquery' ), '2.3.4', true );
		wp_enqueue_script( 'imagesloaded' );
		wp_enqueue_script( 'isotope', get_template_directory_uri() . '/js/plugins/isotope.min.js', array( 'jquery' ), '3.0.6', true );
		wp_enqueue_script( 'infinite-scroll', get_template_directory_uri() . '/js/plugins/infinite-scroll.min.js', array( 'jquery' ), '3.0.5', true );
		wp_enqueue_script( 'jquery-magnific-popup', get_template_directory_uri() . '/js/plugins/jquery.magnific-popup.min.js', array( 'jquery' ), '1.1.0', true );
		wp_enqueue_script( 'jquery-fitvids', get_template_directory_uri() . '/js/plugins/fitvids.min.js', array( 'jquery' ), '1.1.0', true );
		wp_enqueue_script( 'jquery-easing', get_template_directory_uri() . '/js/plugins/jquery.easing.min.js', array( 'jquery' ), '1.3', true );
		wp_enqueue_script( 'typed', get_template_directory_uri() . '/js/plugins/typed.min.js', array( 'jquery' ), '1.0', true );
		wp_enqueue_script( 'jquery-countdown', get_template_directory_uri() . '/js/plugins/jquery.countdown.min.js', array( 'jquery' ), '2.2.0', true );
		wp_enqueue_script( 'vivus', get_template_directory_uri() . '/js/plugins/vivus.min.js', array( 'jquery' ), '0.4.4', true );
		wp_enqueue_script( 'jquery-pagepiling', get_template_directory_uri() . '/js/plugins/jquery.pagepiling.min.js', array( 'jquery' ), '1.5.5', true );
		wp_enqueue_script( 'jquery-iscroll', get_template_directory_uri() . '/js/plugins/iscroll.min.js', array( 'jquery' ), '5.2.0', true );
		wp_enqueue_script( 'jquery-fullpage', get_template_directory_uri() . '/js/plugins/fullpage.min.js', array( 'jquery' ), '2.9.7', true );
		wp_enqueue_script( 'lightgallery', get_template_directory_uri() . '/js/plugins/lightgallery.min.js', array( 'jquery' ), '1.6.11', true );
		wp_enqueue_script( 'crocal-eutf-main-script', get_template_directory_uri() . '/js/main.js', array( 'jquery' ), esc_attr( $crocal_version ), true );
	}
	$crocal_eutf_fullpage = $crocal_eutf_piling = 0;
	if ( is_page_template( 'page-templates/template-full-page.php' ) ) {
		$scrolling_page = crocal_eutf_post_meta( '_crocal_eutf_scrolling_page' );
		if( 'pilling' == $scrolling_page ) {
			$crocal_eutf_piling = 1;
		} else {
			$crocal_eutf_fullpage = 1;
		}
	}
	$scrolling_speed = crocal_eutf_option( 'scrolling_speed', 'normal' );
	if( 'fast' == $scrolling_speed ) {
		$smoothframerate = '60';
		$smoothanimationtime = '700';
		$smoothstepsize = '120';
	} elseif( 'slow' == $scrolling_speed ) {
		$smoothframerate = '100';
		$smoothanimationtime = '1200';
		$smoothstepsize = '85';
	} else {
		$smoothframerate = '80';
		$smoothanimationtime = '1000';
		$smoothstepsize = '100';
	}

	$crocal_eutf_smoothscroll_data = array(
		'smoothscrolling' => crocal_eutf_scroll_check(),
		'smoothframerate' => $smoothframerate,
		'smoothanimationtime' => $smoothanimationtime,
		'smoothstepsize' => $smoothstepsize,
	);
	$crocal_eutf_fullpage_data = array(
		'fullpage' => $crocal_eutf_fullpage,
	);
	$crocal_eutf_piling_data = array(
		'piling' => $crocal_eutf_piling,
	);

	$crocal_eutf_main_data = array(
		'siteurl' => get_template_directory_uri() ,
		'ajaxurl' => esc_url( admin_url( 'admin-ajax.php' ) ),
		'wp_gallery_popup' => crocal_eutf_option( 'wp_gallery_popup', '0' ),
		'woo_popup_thumbs' => crocal_eutf_option( 'product_gallery_woo_popup_thumbs', '1' ),
		'device_animations' => crocal_eutf_option( 'device_animations', '0' ),
		'device_hover_single_tap' => crocal_eutf_option( 'device_hover_single_tap', '0' ),
		'back_top_top' => crocal_eutf_option( 'back_to_top_enabled', '1' ),
		'string_weeks' => esc_html__( 'Weeks', 'crocal' ),
		'string_days' => esc_html__( 'Days', 'crocal' ),
		'string_hours' => esc_html__( 'Hours', 'crocal' ),
		'string_minutes' => esc_html__( 'Min', 'crocal' ),
		'string_seconds' => esc_html__( 'Sec', 'crocal' ),
		'nonce_likes' => wp_create_nonce( 'crocal-eutf-likes' ),
	);

	$resolution_code = "var screen_width = Math.max( screen.width, screen.height );var devicePixelRatio = window.devicePixelRatio ? window.devicePixelRatio : 1;document.cookie = 'resolution=' + screen_width + ',' + devicePixelRatio + '; path=/';";
	$custom_js_code = crocal_eutf_option( 'custom_js' );

	if ( '1' == crocal_eutf_option( 'combine_js', '1' ) ) {
		wp_localize_script( 'crocal-eutf-extras', 'crocal_eutf_smoothscroll_data', $crocal_eutf_smoothscroll_data );
		wp_localize_script( 'crocal-eutf-extras', 'crocal_eutf_fullpage_data', $crocal_eutf_fullpage_data );
		wp_localize_script( 'crocal-eutf-extras', 'crocal_eutf_piling_data', $crocal_eutf_piling_data );
		wp_localize_script( 'crocal-eutf-main-script', 'crocal_eutf_main_data', $crocal_eutf_main_data );
		if ( function_exists( 'wp_add_inline_script' ) ) {
			wp_add_inline_script( 'crocal-eutf-main-script', $resolution_code );
			wp_add_inline_script( 'crocal-eutf-main-script', crocal_eutf_get_privacy_cookie_script() );
			if ( !empty( $custom_js_code ) ) {
				wp_add_inline_script( 'crocal-eutf-main-script', $custom_js_code );
			}
		}
	} else {
		wp_localize_script( 'jquery-smoothscroll', 'crocal_eutf_smoothscroll_data', $crocal_eutf_smoothscroll_data );
		wp_localize_script( 'jquery-fullpage', 'crocal_eutf_fullpage_data', $crocal_eutf_fullpage_data );
		wp_localize_script( 'jquery-pagepiling', 'crocal_eutf_piling_data', $crocal_eutf_piling_data );
		wp_localize_script( 'crocal-eutf-main-script', 'crocal_eutf_main_data', $crocal_eutf_main_data );
		if ( function_exists( 'wp_add_inline_script' ) ) {
			wp_add_inline_script( 'crocal-eutf-main-script', $resolution_code );
			wp_add_inline_script( 'crocal-eutf-main-script', crocal_eutf_get_privacy_cookie_script() );
			if ( !empty( $custom_js_code ) ) {
				wp_add_inline_script( 'crocal-eutf-main-script', $custom_js_code );
			}
		}
	}

}
add_action( 'wp_enqueue_scripts', 'crocal_eutf_frontend_scripts' );

function crocal_eutf_vc_frontend_css() {

	//Deregister VC awesome fonts as older version from Theme
	if ( wp_style_is( 'font-awesome', 'registered' ) ) {
		wp_deregister_style( 'font-awesome' );
		wp_register_style( 'font-awesome', get_template_directory_uri() . '/css/all.min.css', array(), '5.7.1' );
	}

}
add_action( 'vc_base_register_front_css', 'crocal_eutf_vc_frontend_css' );

/**
 * Pagination functions
 */
function crocal_eutf_paginate_links( $type = 'blog' ) {
	global $wp_query;

	$paged = 1;
	if ( get_query_var( 'paged' ) ) {
		$paged = get_query_var( 'paged' );
	} elseif ( get_query_var( 'page' ) ) {
		$paged = get_query_var( 'page' );
	}

	$display_style = 'pagination';
	if( 'blog' == $type ) {
		$blog_mode = crocal_eutf_option( 'blog_mode', 'large' );
		$display_style = crocal_eutf_option( 'blog_display_style', 'pagination' );
		$load_more_title = crocal_eutf_option( 'blog_load_more_title', 'Load More' );
		if ( 'large' == $blog_mode ) {
			$display_style = 'pagination';
		}
	}
	if( 'search' == $type ) {
		$display_style = crocal_eutf_option( 'search_display_style', 'pagination' );
		$load_more_title = crocal_eutf_option( 'search_load_more_title', 'Load More' );
	}

	$total = $wp_query->max_num_pages;
	$big = 999999999; // need an unlikely integer
	if( $total > 1 )  {
		if( 'infinite-scroll' == $display_style || 'load-more' == $display_style ) {
			echo '<div class="eut-infinite-pagination">';
		} else {
			echo '<div class="eut-pagination eut-pagination-text eut-heading-color">';
		}
		if( get_option('permalink_structure') ) {
			$format = 'page/%#%/';
		} else {
			$format = '&paged=%#%';
		}
		echo paginate_links(array(
			'base'			=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format'		=> $format,
			'current'		=> max( 1, $paged ),
			'total'			=> $total,
			'mid_size'		=> 2,
			'type'			=> 'list',
			'prev_text'    => "<i class='eut-icon-nav-left'></i>",
			'next_text'    => "<i class='eut-icon-nav-right'></i>",
			'add_args' => false,
		));
		echo '</div>';
		if( 'infinite-scroll' == $display_style ){
			echo '<div class="eut-infinite-page-load">
					<div class="eut-loader-ellips">
						<span class="eut-loader-ellips-dot"></span>
						<span class="eut-loader-ellips-dot"></span>
						<span class="eut-loader-ellips-dot"></span>
						<span class="eut-loader-ellips-dot"></span>
					</div>
				</div>';
		}
		if ( 'load-more' == $display_style ) {
			echo '<div class="eut-infinite-button-wrapper">
					<div class="eut-infinite-button eut-link-text">' . esc_html( $load_more_title ) . '
						<div class="eut-infinite-page-load eut-infinite-spinner">
							<div class="eut-bounce1"></div>
							<div class="eut-bounce2"></div>
							<div class="eut-bounce3"></div>
						</div>
					</div>
				</div>';
		}
	}
}

function crocal_eutf_wp_link_pages_args( $args ) {

	$args = array(
		'before'           => '<div class="eut-pagination eut-pagination-text eut-heading-color"><ul><li>',
		'after'            => '</li></ul></div>',
		'link_before'      => '<span>',
		'link_after'       => '</span>',
		'aria_current'     => 'page',
		'next_or_number'   => 'number',
		'separator'        => '</li><li>',
		'nextpagelink'     => "<i class='eut-icon-nav-right'></i>",
		'previouspagelink' => "<i class='eut-icon-nav-left'></i>",
		'pagelink'         => '%',
		'echo'             => 1
	);

	return $args;
}
add_filter( 'wp_link_pages_args', 'crocal_eutf_wp_link_pages_args' );

/**
 * Comments
 */
function crocal_eutf_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	$comment_type = get_comment_type();
	?>
	<li class="eut-comment-item eut-border">
		<!-- Comment -->
		<div id="comment-<?php comment_ID(); ?>"  <?php comment_class( 'eut-comment-type-' . $comment_type ); ?>>
			<div class="eut-comment-header">
				<div class="eut-author-image">
					<?php echo get_avatar( $comment, 50 ); ?>
				</div>
				<div class="eut-comment-title">
					<span class="eut-author eut-text-heading eut-h6 eut-bold-text"><?php comment_author(); ?></span>
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>" class="eut-comment-date"><?php printf( ' %1$s ' . esc_html__( 'at', 'crocal' ) . ' %2$s', get_comment_date(),  get_comment_time() ); ?></a>
				</div>
			</div>
			<div class="eut-comment-content">
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<p><?php esc_html_e( 'Your comment is awaiting moderation.', 'crocal' ); ?></p>
				<?php endif; ?>
				<div class="eut-comment-text"><?php comment_text(); ?></div>
				<div class="eut-reply-edit">
					<?php comment_reply_link( array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => esc_html__( 'Reply', 'crocal' ) ) ) ); ?>
					<?php edit_comment_link( esc_html__( 'Edit', 'crocal' ), '  ', '' ); ?>
				</div>
			</div>
		</div>

	<!-- </li> is added by WordPress automatically -->
<?php
}

/**
 * Navigation links for prev/next in comments
 */
function crocal_eutf_replace_reply_link_class( $output ) {
	$class = 'eut-comment-reply eut-link-text eut-text-grey eut-text-hover-primary-1';
	return preg_replace( '/comment-reply-link/', 'comment-reply-link ' . $class, $output, 1 );
}
add_filter('comment_reply_link', 'crocal_eutf_replace_reply_link_class');

function crocal_eutf_replace_edit_link_class( $output ) {
	$class = 'eut-comment-edit eut-link-text eut-text-grey eut-text-hover-primary-1';
	return preg_replace( '/comment-edit-link/', 'comment-edit-link ' . $class, $output, 1 );
}
add_filter('edit_comment_link', 'crocal_eutf_replace_edit_link_class');


/**
 * Title Render Fallback before WordPress 4.1
 */
 if ( ! function_exists( '_wp_render_title_tag' ) ) {
	function crocal_eutf_theme_render_title() {
?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php
	}
	add_action( 'wp_head', 'crocal_eutf_theme_render_title' );
}

/**
 * Theme identifier function
 * Used to get theme information
 */
function crocal_eutf_info() {

	$crocal_eutf_info = array (
		"version" => CROCAL_EUTF_THEME_VERSION,
		"short_name" => 'crocal',
	);

	return $crocal_eutf_info;
}

/**
 * Add Container
 */
add_action('the_content','crocal_eutf_container_div');
add_action('crocal_eutf_the_content','crocal_eutf_container_div');

function crocal_eutf_container_div( $content ){

	if( is_singular() && !has_shortcode( $content, 'vc_row') ) {
		return '<div class="eut-container">' . $content . '</div>';
	} else {
		return $content;
	}

}

/**
 * Add max srcset
 */
if ( ! function_exists( 'crocal_eutf_max_srcset_image_width' ) ) {
	function crocal_eutf_max_srcset_image_width( $max_image_width, $size_array ) {
		return 1920;
	}
}
add_filter( 'max_srcset_image_width', 'crocal_eutf_max_srcset_image_width', 10 , 2 );


/**
 * Add Body Class
 */
function crocal_eutf_body_class( $classes ){
	$theme_classes = array( 'eut-body' );
	$theme_classes[] = 'eut-' . crocal_eutf_option( 'theme_layout', 'stretched' );
	if ( wp_is_mobile() ) {
		$theme_classes[] = 'eut-is-device';
	}
	return array_merge( $classes, $theme_classes );
}
add_filter( 'body_class', 'crocal_eutf_body_class' );

//Omit closing PHP tag to avoid accidental whitespace output errors.

