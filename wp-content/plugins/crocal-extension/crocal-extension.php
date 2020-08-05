<?php
/*
 * Plugin Name: Crocal Extension
 * Description: This plugin extends Page Builder and adds custom post type capabilities.
 * Author: Euthemians Team
 * Author URI: http://euthemians.com
 * Version: 1.2.1
 * Text Domain: crocal-extension
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! defined( 'CROCAL_EXT_VERSION' ) ) {
	define( 'CROCAL_EXT_VERSION', '1.2.1' );
}

if ( ! defined( 'CROCAL_EXT_PLUGIN_DIR_PATH' ) ) {
	define( 'CROCAL_EXT_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'CROCAL_EXT_PLUGIN_DIR_URL' ) ) {
	define( 'CROCAL_EXT_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! class_exists( 'Crocal_Extension_Plugin' ) ) {

	class Crocal_Extension_Plugin {

		/**
		 * @action plugins_loaded
		 * @return Crocal_Extension_Plugin
		 * @static
		 */
		public static function init()
		{

			static $instance = false;

			if ( ! $instance ) {
				load_plugin_textdomain( 'crocal-extension' , false , dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
				$instance = new Crocal_Extension_Plugin;
			}
			return $instance;

		}

		private function __construct() {

			if ( is_user_logged_in() ) {
				add_action( 'admin_enqueue_scripts' , $this->marshal( 'crocal_ext_vce_extension_add_scripts' ) );
			}
			add_action( 'wp_enqueue_scripts' , $this->marshal( 'crocal_ext_vce_extension_add_front_end_scripts' ) );

			require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'includes/crocal-ext-metaboxes.php';
			require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'includes/crocal-ext-functions.php';
			require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'includes/crocal-ext-add-param.php';
			require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'includes/crocal-ext-shortcode-param.php';

			//Shortcodes
			if( function_exists( 'vc_lean_map' ) || function_exists( 'vc_map' ) ) {

				require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'shortcodes/crocal_title.php';
				require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'shortcodes/crocal_empty_space.php';
				require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'shortcodes/crocal_divider.php';
				require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'shortcodes/crocal_button.php';
				require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'shortcodes/crocal_quote.php';
				require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'shortcodes/crocal_dropcap.php';
				require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'shortcodes/crocal_slogan.php';
				require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'shortcodes/crocal_callout.php';
				require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'shortcodes/crocal_progress_bar.php';
				require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'shortcodes/crocal_pricing_table.php';

				require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'shortcodes/crocal_message_box.php';
				require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'shortcodes/crocal_icon.php';
				require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'shortcodes/crocal_icon_box.php';

				require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'shortcodes/crocal_image_text.php';
				require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'shortcodes/crocal_media_box.php';
				require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'shortcodes/crocal_single_image.php';
				require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'shortcodes/crocal_gallery.php';
				require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'shortcodes/crocal_slider.php';
				require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'shortcodes/crocal_video.php';

				require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'shortcodes/crocal_social.php';
				require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'shortcodes/crocal_social_links.php';
				require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'shortcodes/crocal_gmap.php';

				require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'shortcodes/crocal_team.php';
				require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'shortcodes/crocal_blog.php';
				require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'shortcodes/crocal_blog_carousel.php';
				require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'shortcodes/crocal_blog_leader.php';
				require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'shortcodes/crocal_portfolio.php';
				require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'shortcodes/crocal_portfolio_carousel.php';

				require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'shortcodes/crocal_testimonial.php';

				if ( class_exists( 'woocommerce' ) ) {
					require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'shortcodes/crocal_products.php';
					require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'shortcodes/crocal_products_carousel.php';
				}
				if ( class_exists( 'Tribe__Events__Main' ) ) {
					require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'shortcodes/crocal_events.php';
				}
				require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'shortcodes/crocal_content_slider.php';
				require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'shortcodes/crocal_fancy_box.php';
				require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'shortcodes/crocal_flexible_carousel.php';

				require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'shortcodes/crocal_counter.php';
				require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'shortcodes/crocal_pie_chart.php';
				require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'shortcodes/crocal_typed_text.php';
				require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'shortcodes/crocal_promo.php';

				require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'shortcodes/crocal_countdown.php';
				require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'shortcodes/crocal_modal.php';

				if ( class_exists( 'WPCF7_ContactForm' ) ) {
					require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'shortcodes/crocal_contact_form.php';
				}



				require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'shortcodes/crocal_language_selector.php';
				require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'shortcodes/crocal_instagram.php';

				if ( function_exists( 'crocal_eutf_visibility' ) ) {
					$content_manager = crocal_eutf_visibility( 'vc_content_manager_visibility' );
					if ( $content_manager ) {
						require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'crocal-templates/crocal-templates.php';
					}
				}

				require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'shortcodes/crocal_privacy_gtracking.php';
				require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'shortcodes/crocal_privacy_gmaps.php';
				require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'shortcodes/crocal_privacy_gfonts.php';
				require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'shortcodes/crocal_privacy_video_embeds.php';
				require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'shortcodes/crocal_privacy_required.php';
				require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'shortcodes/crocal_privacy_custom.php';
				require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'shortcodes/crocal_privacy_policy_page_link.php';
				require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'shortcodes/crocal_privacy_preferences_link.php';

			}

		}

		public function Crocal_Extension_Plugin() {
			$this->__construct();
		}

		public function crocal_ext_vce_extension_add_scripts( $hook ) {
			wp_enqueue_style('crocal-ext-vc-elements', CROCAL_EXT_PLUGIN_DIR_URL .'assets/css/crocal-ext-vc-elements.css', array(), time(), 'all');
			wp_enqueue_style('crocal-ext-vc-custom-fields', CROCAL_EXT_PLUGIN_DIR_URL .'assets/css/crocal-ext-vc-custom-fields.css', array(), time(), 'all');
			wp_enqueue_style('crocal-ext-vc-simple-line-icons', CROCAL_EXT_PLUGIN_DIR_URL .'assets/css/simple-line-icons.css', array(), '2.2.3', 'all');
			wp_enqueue_style('crocal-ext-vc-elegant-line-icons', CROCAL_EXT_PLUGIN_DIR_URL .'assets/css/et-line-icons.css', array(), '1.0.0', 'all');
		}

		public function crocal_ext_vce_extension_add_front_end_scripts() {
			wp_register_style( 'crocal-ext-vc-simple-line-icons', CROCAL_EXT_PLUGIN_DIR_URL .'assets/css/simple-line-icons.css', array(), '2.2.3', 'all' );
			wp_register_style( 'crocal-ext-vc-elegant-line-icons', CROCAL_EXT_PLUGIN_DIR_URL .'assets/css/et-line-icons.css', array(), '1.0.0', 'all' );
		}

		public function marshal( $method_name ) {
			return array( &$this , $method_name );
		}
	}

	/**
	 * Initialize the Extension Plugin
	 */
	add_action( 'init' , array( 'Crocal_Extension_Plugin' , 'init' ), 12 );


	/**
	 * Initialize Custom Post Types
	 */
	function crocal_ext_vce_rewrite_flush() {
		crocal_ext_vce_register_custom_post_init();
		flush_rewrite_rules();
	}
	register_activation_hook( __FILE__, 'crocal_ext_vce_rewrite_flush' );

	function crocal_ext_vce_register_custom_post_init() {
		require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'includes/crocal-portfolio-post-type.php';
		require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'includes/crocal-testimonial-post-type.php';
		require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'includes/crocal-area-item-post-type.php';
	}
	add_action( 'init', 'crocal_ext_vce_register_custom_post_init', 9 );

	function crocal_ext_vce_body_class( $classes ){
		$crocal_ext_ver = 'eut-vce-ver-' . CROCAL_EXT_VERSION;
		return array_merge( $classes, array( $crocal_ext_ver ) );
	}
	add_filter( 'body_class', 'crocal_ext_vce_body_class' );

	require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'includes/crocal-ext-global-functions.php';

	/**
	 * Widgets
	 */
	function crocal_ext_register_widgets() {
		require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'widgets/eut-widget-social-list.php';
		require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'widgets/eut-widget-social.php';
		require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'widgets/eut-widget-latest-posts.php';
		require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'widgets/eut-widget-latest-comments.php';
		require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'widgets/eut-widget-latest-portfolio.php';
		require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'widgets/eut-widget-contact-info.php';
		require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'widgets/eut-widget-instagram-feed.php';
		require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'widgets/eut-widget-sticky.php';

		register_widget( 'Crocal_Ext_Widget_Social_List' );
		register_widget( 'Crocal_Ext_Widget_Social' );
		register_widget( 'Crocal_Ext_Widget_Latest_Posts' );
		register_widget( 'Crocal_Ext_Widget_Latest_Comments' );
		register_widget( 'Crocal_Ext_Widget_Latest_Portfolio' );
		register_widget( 'Crocal_Ext_Widget_Contact_Info' );
		register_widget( 'Crocal_Ext_Widget_Instagram_Feed' );
		register_widget( 'Crocal_Ext_Widget_Sticky' );

	}
	add_action( 'widgets_init', 'crocal_ext_register_widgets' );


	/**
	 *Admin Menu
	 */
	require_once CROCAL_EXT_PLUGIN_DIR_PATH . 'includes/admin/crocal-ext-admin-functions.php';

}

//Omit closing PHP tag to avoid accidental whitespace output errors.