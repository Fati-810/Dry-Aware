<?php
/*
*	Helper Functions for meta options ( Post / Page / Portfolio / Product )
*
* 	@author		Euthemians Team
* 	@URI		http://euthemians.com
*/


add_action( 'save_post', 'crocal_eutf_generic_options_save_postdata', 10, 2 );


/**
 * Page Options Metabox
 */
function crocal_eutf_page_options_box( $post ) {

	global $crocal_eutf_button_color_selection;

	$post_type = get_post_type( $post->ID );
	
	$crocal_eutf_page_title_selection = array(
		'' => esc_html__( '-- Inherit --', 'crocal' ),
		'custom' => esc_html__( 'Custom Advanced Title', 'crocal' ),
	);
	$crocal_eutf_area_colors_info = esc_html__( 'Inherit : Appearance - Customize', 'crocal' );
	$crocal_eutf_theme_options_info_text_empty = $crocal_eutf_desc_info = "";

	switch( $post_type ) {
		case 'tribe_events':
			$crocal_eutf_theme_options_info = esc_html__( 'Inherit : Theme Options - Events Calendar Options - Single Event Settings.', 'crocal' );
		break;
		case 'portfolio':
			$crocal_eutf_theme_options_info = esc_html__( 'Inherit : Theme Options - Portfolio Options.', 'crocal' );
			$crocal_eutf_theme_options_info_text_empty =  esc_html__('If empty, text is configured from: Theme Options - Portfolio Options.', 'crocal' );
			$crocal_eutf_desc_info = esc_html__( 'Enter your portfolio description.', 'crocal' );
		break;
		case 'post':
			$crocal_eutf_theme_options_info = esc_html__( 'Inherit : Theme Options - Blog Options - Single Post.', 'crocal' );
			$crocal_eutf_theme_options_info_text_empty =  esc_html__('If empty, text is configured from: Theme Options - Blog Options - Single Post.', 'crocal' );
			$crocal_eutf_desc_info = esc_html__( 'Enter your post description( Not available in Simple Title ).', 'crocal' );
			$crocal_eutf_page_title_selection = array(
				'' => esc_html__( '-- Inherit --', 'crocal' ),
				'custom' => esc_html__( 'Custom Advanced Title', 'crocal' ),
				'simple' => esc_html__( 'Simple Title', 'crocal' ),
			);
		break;
		case 'product':
			$crocal_eutf_area_colors_info = esc_html__( 'Inherit : Appearance - Customize - Colors - Shop/Product - Colors - Product Area.', 'crocal' );
			$crocal_eutf_theme_options_info = esc_html__( 'Inherit : Theme Options - WooCommerce Options - Single Product.', 'crocal' );
			$crocal_eutf_theme_options_info_text_empty =  esc_html__('If empty, text is configured from: Theme Options - WooCommerce Options - Single Product.', 'crocal' );
			$crocal_eutf_desc_info = esc_html__( 'Enter your product description( Not available in Simple Title ).', 'crocal' );
			$crocal_eutf_page_title_selection = array(
				'' => esc_html__( '-- Inherit --', 'crocal' ),
				'custom' => esc_html__( 'Custom Advanced Title', 'crocal' ),
				'simple' => esc_html__( 'Simple Title', 'crocal' ),
			);
		break;
		case 'page':
		default:
			$crocal_eutf_theme_options_info = esc_html__( 'Inherit : Theme Options - Page Options.', 'crocal' );
			$crocal_eutf_theme_options_info_text_empty =  esc_html__('If empty, text is configured from: Theme Options - Page Options.', 'crocal' );
			$crocal_eutf_desc_info = esc_html__( 'Enter your page description.', 'crocal' );
		break;
	}

	$crocal_eutf_page_padding_selection = array(
		'' => esc_html__( '-- Inherit --', 'crocal' ),
		'none' => esc_html__( 'None', 'crocal' ),
		'1x' => esc_html__( '1x', 'crocal' ),
		'2x' => esc_html__( '2x', 'crocal' ),
		'3x' => esc_html__( '3x', 'crocal' ),
		'4x' => esc_html__( '4x', 'crocal' ),
		'5x' => esc_html__( '5x', 'crocal' ),
		'6x' => esc_html__( '6x', 'crocal' ),
	);

	$crocal_eutf_page_padding_selection_extra = array(
		'' => esc_html__( '-- Inherit --', 'crocal' ),
		'none' => esc_html__( 'None', 'crocal' ),
		'1x' => esc_html__( '1x', 'crocal' ),
		'2x' => esc_html__( '2x', 'crocal' ),
		'3x' => esc_html__( '3x', 'crocal' ),
		'4x' => esc_html__( '4x', 'crocal' ),
		'5x' => esc_html__( '5x', 'crocal' ),
		'6x' => esc_html__( '6x', 'crocal' ),
		'custom' => esc_html__( 'Custom', 'crocal' ),
	);

	wp_nonce_field( 'crocal_eutf_nonce_page_save', '_crocal_eutf_nonce_page_save' );


	$crocal_eutf_custom_title_options = get_post_meta( $post->ID, '_crocal_eutf_custom_title_options', true );
	$crocal_eutf_content_skin_options = get_post_meta( $post->ID, '_crocal_eutf_content_skin_options', true );

	$crocal_eutf_description = get_post_meta( $post->ID, '_crocal_eutf_description', true );


	//Product Area
	$crocal_eutf_area_colors = get_post_meta( $post->ID, '_crocal_eutf_area_colors', true );
	$crocal_eutf_area_section_type = get_post_meta( $post->ID, '_crocal_eutf_area_section_type', true );
	$crocal_eutf_area_padding_top_multiplier = get_post_meta( $post->ID, '_crocal_eutf_area_padding_top_multiplier', true );
	$crocal_eutf_area_padding_bottom_multiplier = get_post_meta( $post->ID, '_crocal_eutf_area_padding_bottom_multiplier', true );
	$crocal_eutf_area_image_id = get_post_meta( $post->ID, '_crocal_eutf_area_image_id', true );


	//Layout Fields
	$crocal_eutf_padding_top_multiplier = get_post_meta( $post->ID, '_crocal_eutf_padding_top_multiplier', true );
	$crocal_eutf_padding_bottom_multiplier = get_post_meta( $post->ID, '_crocal_eutf_padding_bottom_multiplier', true );
	$crocal_eutf_padding_top = get_post_meta( $post->ID, '_crocal_eutf_padding_top', true );
	$crocal_eutf_padding_bottom = get_post_meta( $post->ID, '_crocal_eutf_padding_bottom', true );
	$crocal_eutf_layout = get_post_meta( $post->ID, '_crocal_eutf_layout', true );
	$crocal_eutf_sidebar = get_post_meta( $post->ID, '_crocal_eutf_sidebar', true );
	$crocal_eutf_fixed_sidebar = get_post_meta( $post->ID, '_crocal_eutf_fixed_sidebar', true );
	$crocal_eutf_post_content_width = get_post_meta( $post->ID, '_crocal_eutf_post_content_width', true ); //Post/Product/Event Only
	$crocal_eutf_content_skin = get_post_meta( $post->ID, '_crocal_eutf_content_skin', true );

	//Sliding Area
	$crocal_eutf_sidearea_visibility = get_post_meta( $post->ID, '_crocal_eutf_sidearea_visibility', true );
	$crocal_eutf_sidearea_sidebar = get_post_meta( $post->ID, '_crocal_eutf_sidearea_sidebar', true );

	//Scrolling Page
	$crocal_eutf_scrolling_page = get_post_meta( $post->ID, '_crocal_eutf_scrolling_page', true );
	$crocal_eutf_responsive_scrolling = get_post_meta( $post->ID, '_crocal_eutf_responsive_scrolling', true );
	$crocal_eutf_scrolling_lock_anchors = get_post_meta( $post->ID, '_crocal_eutf_scrolling_lock_anchors', true );
	$crocal_eutf_scrolling_direction = get_post_meta( $post->ID, '_crocal_eutf_scrolling_direction', true );
	$crocal_eutf_scrolling_loop = get_post_meta( $post->ID, '_crocal_eutf_scrolling_loop', true );
	$crocal_eutf_scrolling_speed = get_post_meta( $post->ID, '_crocal_eutf_scrolling_speed', true );

	//Header - Main Menu Fields
	$crocal_eutf_header_overlapping = get_post_meta( $post->ID, '_crocal_eutf_header_overlapping', true );
	$crocal_eutf_header_style = get_post_meta( $post->ID, '_crocal_eutf_header_style', true );
	$crocal_eutf_main_navigation_menu = get_post_meta( $post->ID, '_crocal_eutf_main_navigation_menu', true );
	$crocal_eutf_responsive_navigation_menu = get_post_meta( $post->ID, '_crocal_eutf_responsive_navigation_menu', true );
	$crocal_eutf_sticky_header_type = get_post_meta( $post->ID, '_crocal_eutf_sticky_header_type', true );
	$crocal_eutf_menu_type = get_post_meta( $post->ID, '_crocal_eutf_menu_type', true );
	$crocal_eutf_responsive_header_overlapping = get_post_meta( $post->ID, '_crocal_eutf_responsive_header_overlapping', true );

	//Extras
	$crocal_eutf_details_title = get_post_meta( $post->ID, '_crocal_eutf_details_title', true ); //Portfolio Only
	$crocal_eutf_details = get_post_meta( $post->ID, '_crocal_eutf_details', true ); //Portfolio Only

	$crocal_eutf_details_link_text = get_post_meta( $post->ID, '_crocal_eutf_details_link_text', true ); //Portfolio Only
	$crocal_eutf_details_link_url = get_post_meta( $post->ID, '_crocal_eutf_details_link_url', true ); //Portfolio Only
	$crocal_eutf_details_link_new_window = get_post_meta( $post->ID, '_crocal_eutf_details_link_new_window', true ); //Portfolio Only
	$crocal_eutf_details_link_extra_class = get_post_meta( $post->ID, '_crocal_eutf_details_link_extra_class', true ); //Portfolio Only
	$crocal_eutf_social_bar_layout = get_post_meta( $post->ID, '_crocal_eutf_social_bar_layout', true ); //Portfolio Only

	$crocal_eutf_backlink_id = get_post_meta( $post->ID, '_crocal_eutf_backlink_id', true ); //Portfolio. Post, Product

	$crocal_eutf_anchor_navigation_menu = get_post_meta( $post->ID, '_crocal_eutf_anchor_navigation_menu', true );
	$crocal_eutf_theme_loader = get_post_meta( $post->ID, '_crocal_eutf_theme_loader', true );

	//Visibility Fields
	$crocal_eutf_disable_top_bar = get_post_meta( $post->ID, '_crocal_eutf_disable_top_bar', true );
	$crocal_eutf_disable_logo = get_post_meta( $post->ID, '_crocal_eutf_disable_logo', true );
	$crocal_eutf_disable_menu = get_post_meta( $post->ID, '_crocal_eutf_disable_menu', true );
	$crocal_eutf_disable_menu_items = get_post_meta( $post->ID, '_crocal_eutf_disable_menu_items', true );
	$crocal_eutf_disable_header_text = get_post_meta( $post->ID, '_crocal_eutf_disable_header_text', true );
	$crocal_eutf_disable_breadcrumbs = get_post_meta( $post->ID, '_crocal_eutf_disable_breadcrumbs', true );
	$crocal_eutf_disable_title = get_post_meta( $post->ID, '_crocal_eutf_disable_title', true );
	$crocal_eutf_disable_media = get_post_meta( $post->ID, '_crocal_eutf_disable_media', true ); //Post Only
	$crocal_eutf_disable_content = get_post_meta( $post->ID, '_crocal_eutf_disable_content', true ); //Page Only
	$crocal_eutf_disable_recent_entries = get_post_meta( $post->ID, '_crocal_eutf_disable_recent_entries', true );//Portfolio Only
	$crocal_eutf_disable_back_to_top = get_post_meta( $post->ID, '_crocal_eutf_disable_back_to_top', true );

	$crocal_eutf_bottom_bar_area = get_post_meta( $post->ID, '_crocal_eutf_bottom_bar_area', true );
	$crocal_eutf_footer_widgets_visibility = get_post_meta( $post->ID, '_crocal_eutf_footer_widgets_visibility', true );
	$crocal_eutf_footer_bar_visibility = get_post_meta( $post->ID, '_crocal_eutf_footer_bar_visibility', true );

?>

	<!--  METABOXES -->
	<div class="eut-metabox-content">

		<!-- TABS -->
		<div class="eut-tabs">

			<ul class="eut-tab-links">
				<li class="active"><a href="#eut-page-option-tab-header"><?php esc_html_e( 'Header / Main Menu', 'crocal' ); ?></a></li>
				<li><a href="#eut-page-option-tab-title"><?php esc_html_e( 'Title / Description', 'crocal' ); ?></a></li>
				<?php if( 'product' == $post_type ) { ?>
				<li><a href="#eut-page-option-tab-section-area"><?php esc_html_e( 'Product Area', 'crocal' ); ?></a></li>
				<?php } ?>
				<li><a href="#eut-page-option-tab-layout"><?php esc_html_e( 'Content / Sidebars', 'crocal' ); ?></a></li>
				<li><a href="#eut-page-option-tab-sliding-area"><?php esc_html_e( 'Sliding Area', 'crocal' ); ?></a></li>
				<?php if( 'page' == $post_type ) { ?>
				<li><a href="#eut-page-option-tab-scrolling-sections"><?php esc_html_e( 'Scrolling Sections', 'crocal' ); ?></a></li>
				<?php } ?>
				<li><a href="#eut-page-option-tab-bottom-footer-areas"><?php esc_html_e( 'Bottom / Footer Areas', 'crocal' ); ?></a></li>
				<li><a href="#eut-page-option-tab-extras"><?php esc_html_e( 'Extras', 'crocal' ); ?></a></li>
				<li><a href="#eut-page-option-tab-visibility"><?php esc_html_e( 'Visibility', 'crocal' ); ?></a></li>
			</ul>
			<div class="eut-tab-content">

				<div id="eut-page-option-tab-header" class="eut-tab-item active">
					<?php

						//Header Overlapping Option
						crocal_eutf_print_admin_option(
							array(
								'type' => 'select',
								'name' => '_crocal_eutf_header_overlapping',
								'id' => '_crocal_eutf_header_overlapping',
								'value' => $crocal_eutf_header_overlapping,
								'options' => array(
									'' => esc_html__( '-- Inherit --', 'crocal' ),
									'yes' => esc_html__( 'Yes', 'crocal' ),
									'no' => esc_html__( 'No', 'crocal' ),
								),
								'label' => array(
									"title" => esc_html__( 'Header Overlapping', 'crocal' ),
									"desc" => esc_html__( 'Select if you want to overlap your page header', 'crocal' ),
									"info" => $crocal_eutf_theme_options_info,
								),
							)
						);

						//Header Style Option
						crocal_eutf_print_admin_option(
							array(
								'type' => 'select',
								'name' => '_crocal_eutf_header_style',
								'id' => '_crocal_eutf_header_style',
								'value' => $crocal_eutf_header_style,
								'options' => array(
									'' => esc_html__( '-- Inherit --', 'crocal' ),
									'default' => esc_html__( 'Default', 'crocal' ),
									'dark' => esc_html__( 'Dark', 'crocal' ),
									'light' => esc_html__( 'Light', 'crocal' ),
								),
								'label' => array(
									"title" => esc_html__( 'Header Style', 'crocal' ),
									"desc" => esc_html__( 'With this option you can change the coloring of your header. In case that you use Slider in Feature Section, select the header style per slide/image.', 'crocal' ),
									"info" => $crocal_eutf_theme_options_info,
								),
							)
						);

						//Main Navigation Menu Option
						crocal_eutf_print_admin_option_wrapper_start(
							array(
								'type' => 'select',
								'label' => array(
									"title" => esc_html__( 'Main Navigation Menu', 'crocal' ),
									"desc" => esc_html__( 'Select alternative main navigation menu.', 'crocal' ),
									"info" => esc_html__( 'Inherit : Menus - Theme Locations - Header Menu.', 'crocal' ),
								),
							)
						);
						crocal_eutf_print_menu_selection( $crocal_eutf_main_navigation_menu, 'eut-main-navigation-menu', '_crocal_eutf_main_navigation_menu', 'default' );
						crocal_eutf_print_admin_option_wrapper_end();

						//Responsive Navigation Menu Option
						crocal_eutf_print_admin_option_wrapper_start(
							array(
								'type' => 'select',
								'label' => array(
									"title" => esc_html__( 'Responsive Navigation Menu', 'crocal' ),
									"desc" => esc_html__( 'Select alternative responsive navigation menu.', 'crocal' ),
									"info" => esc_html__( 'Inherit : Menus - Theme Locations - Responsive Menu.', 'crocal' ),
								),
							)
						);
						crocal_eutf_print_menu_selection( $crocal_eutf_responsive_navigation_menu, 'eut-responsive-navigation-menu', '_crocal_eutf_responsive_navigation_menu', 'default' );
						crocal_eutf_print_admin_option_wrapper_end();

						//Menu Type
						crocal_eutf_print_admin_option(
							array(
								'type' => 'select',
								'name' => '_crocal_eutf_menu_type',
								'id' => '_crocal_eutf_menu_type',
								'value' => $crocal_eutf_menu_type,
								'options' => array(
									'' => esc_html__( '-- Inherit --', 'crocal' ),
									'classic' => esc_html__( 'Classic', 'crocal' ),
									'button' => esc_html__( 'Button Style', 'crocal' ),
									'underline' => esc_html__( 'Underline', 'crocal' ),
									'hidden' => esc_html__( 'Hidden', 'crocal' ),
									'advanced-hidden' => esc_html__( 'Advanced Hidden', 'crocal' ),
								),
								'label' => array(
									"title" => esc_html__( 'Menu Type', 'crocal' ),
									"desc" => esc_html__( 'With this option you can select the type of the menu ( Not available for Side Header Mode ).', 'crocal' ),
									"info" => esc_html__( 'Inherit : Theme Options - Header Options.', 'crocal' ),
								),
							)
						);

						//Sticky Header Type
						crocal_eutf_print_admin_option(
							array(
								'type' => 'select',
								'name' => '_crocal_eutf_sticky_header_type',
								'id' => '_crocal_eutf_sticky_header_type',
								'value' => $crocal_eutf_sticky_header_type,
								'options' => array(
									'' => esc_html__( '-- Inherit --', 'crocal' ),
									'none' => esc_html__( '-- None --', 'crocal' ),
									'simple' => esc_html__( 'Simple', 'crocal' ),
									'shrink' => esc_html__( 'Shrink', 'crocal' ),
									'scrollup' => esc_html__( 'Scroll Up', 'crocal' ),
								),
								'label' => array(
									"title" => esc_html__( 'Sticky Header Type', 'crocal' ),
									"desc" => esc_html__( 'With this option you can select the type of sticky header.', 'crocal' ),
									"info" => esc_html__( 'Inherit : Theme Options - Header Options - Sticky Header Options.', 'crocal' ),
								),
							)
						);

						//Responsive Header Overlapping Option
						crocal_eutf_print_admin_option(
							array(
								'type' => 'select',
								'name' => '_crocal_eutf_responsive_header_overlapping',
								'id' => '_crocal_eutf_responsive_header_overlapping',
								'value' => $crocal_eutf_responsive_header_overlapping,
								'options' => array(
									'' => esc_html__( '-- Inherit --', 'crocal' ),
									'yes' => esc_html__( 'Yes', 'crocal' ),
									'no' => esc_html__( 'No', 'crocal' ),
								),
								'label' => array(
									"title" => esc_html__( 'Responsive Header Overlapping', 'crocal' ),
									"desc" => esc_html__( 'Select if you want to overlap your responsive header', 'crocal' ),
									"info" => esc_html__( 'Inherit : Theme Options - Header Options - Responsive Header Options.', 'crocal' ),
								),
							)
						);
					?>
				</div>
				<div id="eut-page-option-tab-title" class="eut-tab-item">
					<?php

						echo '<div id="_crocal_eutf_page_title">';

						crocal_eutf_print_admin_option(
							array(
								'type' => 'select',
								'name' => '_crocal_eutf_disable_title',
								'id' => '_crocal_eutf_disable_title',
								'value' => $crocal_eutf_disable_title,
								'options' => array(
									'' => esc_html__( 'Visible', 'crocal' ),
									'yes' => esc_html__( 'Hidden', 'crocal' ),

								),
								'label' => array(
									"title" => esc_html__( 'Title/Description Visibility', 'crocal' ),
									"desc" => esc_html__( 'Select if you want to hide your title and decription .', 'crocal' ),
								),
								'group_id' => '_crocal_eutf_page_title',
							)
						);
						if( 'tribe_events' != $post_type ) {
							//Description Option
							crocal_eutf_print_admin_option(
								array(
									'type' => 'textarea',
									'name' => '_crocal_eutf_description',
									'id' => '_crocal_eutf_description',
									'value' => $crocal_eutf_description,
									'label' => array(
										'title' => esc_html__( 'Description', 'crocal' ),
										'desc' => $crocal_eutf_desc_info,
									),
									'width' => 'fullwidth',
									'rows' => 2,
								)
							);
						}

						//Custom Title Option

						crocal_eutf_print_admin_option(
							array(
								'type' => 'select',
								'name' => '_crocal_eutf_page_title_custom',
								'id' => '_crocal_eutf_page_title_custom',
								'value' => crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'custom' ),
								'options' => $crocal_eutf_page_title_selection,
								'label' => array(
									"title" => esc_html__( 'Title Options', 'crocal' ),
									"info" => $crocal_eutf_theme_options_info,
								),
								'group_id' => '_crocal_eutf_page_title',
								'highlight' => 'highlight',
								'dependency' =>
								'[
									{ "id" : "_crocal_eutf_disable_title", "values" : [""] }
								]',
							)
						);



						global $crocal_eutf_area_height;
						crocal_eutf_print_admin_option(
							array(
								'type' => 'select',
								'options' => $crocal_eutf_area_height,
								'name' => '_crocal_eutf_page_title_height',
								'id' => '_crocal_eutf_page_title_height',
								'value' => crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'height', '40' ),
								'label' => array(
									"title" => esc_html__( 'Title Area Height', 'crocal' ),
								),
								'dependency' =>
								'[
									{ "id" : "_crocal_eutf_page_title_custom", "values" : ["custom"] },
									{ "id" : "_crocal_eutf_disable_title", "values" : [""] }
								]',
							)
						);
						crocal_eutf_print_admin_option(
							array(
								'type' => 'textfield',
								'name' => '_crocal_eutf_page_title_min_height',
								'id' => '_crocal_eutf_page_title_min_height',
								'value' => crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'min_height', '200' ),
								'label' => array(
									"title" => esc_html__( 'Title Area Minimum Height in px', 'crocal' ),
								),
								'dependency' =>
								'[
									{ "id" : "_crocal_eutf_page_title_custom", "values" : ["custom"] },
									{ "id" : "_crocal_eutf_disable_title", "values" : [""] }
								]',
							)
						);

						crocal_eutf_print_admin_option(
							array(
								'type' => 'select',
								'name' => '_crocal_eutf_page_title_container_size',
								'id' => '_crocal_eutf_page_title_container_size',
								'options' => array(
									'' => esc_html__( 'Default', 'crocal' ),
									'large' => esc_html__( 'Large', 'crocal' ),
								),
								'value' => crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'container_size' ),
								'label' => array(
									"title" => esc_html__( 'Container Size', 'crocal' ),
								),
								'dependency' =>
								'[
									{ "id" : "_crocal_eutf_page_title_custom", "values" : ["custom"] },
									{ "id" : "_crocal_eutf_disable_title", "values" : [""] }
								]',
							)
						);

						crocal_eutf_print_admin_option(
							array(
								'type' => 'select-colorpicker',
								'name' => '_crocal_eutf_page_title_bg_color',
								'id' => '_crocal_eutf_page_title_bg_color',
								'value' => crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'bg_color', 'dark' ),
								'value2' => crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'bg_color_custom', '#000000' ),
								'default_value2' => '#000000',
								'label' => array(
									"title" => esc_html__( 'Background Color', 'crocal' ),
								),
								'dependency' =>
								'[
									{ "id" : "_crocal_eutf_page_title_custom", "values" : ["custom"] },
									{ "id" : "_crocal_eutf_disable_title", "values" : [""] }
								]',
								'multiple' => 'multi',
								'type_usage' => 'section-bg',
							)
						);

						crocal_eutf_print_admin_option(
							array(
								'type' => 'select-colorpicker',
								'name' => '_crocal_eutf_page_title_content_bg_color',
								'id' => '_crocal_eutf_page_title_content_bg_color',
								'value' => crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'content_bg_color', 'none' ),
								'value2' => crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'content_bg_color_custom', '#ffffff' ),
								'default_value2' => '#ffffff',
								'label' => array(
									"title" => esc_html__( 'Content Background Color', 'crocal' ),
								),
								'dependency' =>
								'[
									{ "id" : "_crocal_eutf_page_title_custom", "values" : ["custom"] },
									{ "id" : "_crocal_eutf_disable_title", "values" : [""] }
								]',
								'multiple' => 'multi',
								'type_usage' => 'title-content-bg',
							)
						);

						if( 'post' == $post_type ) {
							crocal_eutf_print_admin_option(
								array(
									'type' => 'select-colorpicker',
									'name' => '_crocal_eutf_page_title_subheading_color',
									'id' => '_crocal_eutf_page_title_subheading_color',
									'value' => crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'subheading_color', 'light' ),
									'value2' => crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'subheading_color_custom', '#ffffff' ),
									'default_value2' => '#ffffff',
									'label' => array(
										"title" => esc_html__( 'Categories/Meta Color', 'crocal' ),
									),
									'dependency' =>
									'[
										{ "id" : "_crocal_eutf_page_title_custom", "values" : ["custom"] },
										{ "id" : "_crocal_eutf_disable_title", "values" : [""] }
									]',
									'multiple' => 'multi',
								)
							);
						}

						crocal_eutf_print_admin_option(
							array(
								'type' => 'select-colorpicker',
								'name' => '_crocal_eutf_page_title_title_color',
								'id' => '_crocal_eutf_page_title_title_color',
								'value' => crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'title_color', 'light' ),
								'value2' => crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'title_color_custom', '#ffffff' ),
								'default_value2' => '#ffffff',
								'label' => array(
									"title" => esc_html__( 'Title Color', 'crocal' ),
								),
								'dependency' =>
								'[
									{ "id" : "_crocal_eutf_page_title_custom", "values" : ["custom"] },
									{ "id" : "_crocal_eutf_disable_title", "values" : [""] }
								]',
								'multiple' => 'multi',
							)
						);

						crocal_eutf_print_admin_option(
							array(
								'type' => 'select-colorpicker',
								'name' => '_crocal_eutf_page_title_caption_color',
								'id' => '_crocal_eutf_page_title_caption_color',
								'value' => crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'caption_color', 'light' ),
								'value2' => crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'caption_color_custom', '#ffffff' ),
								'default_value2' => '#ffffff',
								'label' => array(
									"title" => esc_html__( 'Description Color', 'crocal' ),
								),
								'dependency' =>
								'[
									{ "id" : "_crocal_eutf_page_title_custom", "values" : ["custom"] },
									{ "id" : "_crocal_eutf_disable_title", "values" : [""] }
								]',
								'multiple' => 'multi',
							)
						);

						crocal_eutf_print_admin_option(
							array(
								'type' => 'select',
								'name' => '_crocal_eutf_page_title_content_size',
								'id' => '_crocal_eutf_page_title_content_size',
								'value' => crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'content_size', 'large' ),
								'options' => array(
									'large' => esc_html__( 'Large', 'crocal' ),
									'medium' => esc_html__( 'Medium', 'crocal' ),
									'small' => esc_html__( 'Small', 'crocal' ),
								),
								'label' => esc_html__( 'Content Size', 'crocal' ),
								'dependency' =>
								'[
									{ "id" : "_crocal_eutf_page_title_custom", "values" : ["custom"] },
									{ "id" : "_crocal_eutf_disable_title", "values" : [""] }
								]',
							)
						);

						crocal_eutf_print_admin_option(
							array(
								'type' => 'select-align',
								'name' => '_crocal_eutf_page_title_content_alignment',
								'id' => '_crocal_eutf_page_title_content_alignment',
								'value' => crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'content_alignment', 'center' ),
								'label' => esc_html__( 'Content Alignment', 'crocal' ),
								'dependency' =>
								'[
									{ "id" : "_crocal_eutf_page_title_custom", "values" : ["custom"] },
									{ "id" : "_crocal_eutf_disable_title", "values" : [""] }
								]',
							)
						);


						global $crocal_eutf_media_bg_position_selection;
						crocal_eutf_print_admin_option(
							array(
								'type' => 'select',
								'name' => '_crocal_eutf_page_title_content_position',
								'id' => '_crocal_eutf_page_title_content_position',
								'value' => crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'content_position', 'center-center' ),
								'options' => $crocal_eutf_media_bg_position_selection,
								'label' => array(
									"title" => esc_html__( 'Content Position', 'crocal' ),
								),
								'dependency' =>
								'[
									{ "id" : "_crocal_eutf_page_title_custom", "values" : ["custom"] },
									{ "id" : "_crocal_eutf_disable_title", "values" : [""] }
								]',
							)
						);

						crocal_eutf_print_admin_option(
							array(
								'type' => 'select-text-animation',
								'name' => '_crocal_eutf_page_title_content_animation',
								'value' => crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'content_animation', 'fade-in' ),
								'label' => esc_html__( 'Content Animation', 'crocal' ),
								'dependency' =>
								'[
									{ "id" : "_crocal_eutf_page_title_custom", "values" : ["custom"] },
									{ "id" : "_crocal_eutf_disable_title", "values" : [""] }
								]',
							)
						);


						crocal_eutf_print_admin_option(
							array(
								'type' => 'select',
								'name' => '_crocal_eutf_page_title_bg_mode',
								'id' => '_crocal_eutf_page_title_bg_mode',
								'value' => crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'bg_mode'),
								'options' => array(
									'' => esc_html__( 'Color Only', 'crocal' ),
									'featured' => esc_html__( 'Featured Image', 'crocal' ),
									'custom' => esc_html__( 'Custom Image', 'crocal' ),

								),
								'label' => array(
									"title" => esc_html__( 'Background Mode', 'crocal' ),
								),
								'group_id' => '_crocal_eutf_page_title',
								'dependency' =>
								'[
									{ "id" : "_crocal_eutf_page_title_custom", "values" : ["custom"] },
									{ "id" : "_crocal_eutf_disable_title", "values" : [""] }

								]',
							)
						);
						crocal_eutf_print_admin_option(
							array(
								'type' => 'select-image',
								'name' => '_crocal_eutf_page_title_bg_image_id',
								'id' => '_crocal_eutf_page_title_bg_image_id',
								'value' => crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'bg_image_id'),
								'label' => array(
									"title" => esc_html__( 'Background Image', 'crocal' ),
								),
								'width' => 'fullwidth',
								'dependency' =>
								'[
									{ "id" : "_crocal_eutf_page_title_custom", "values" : ["custom"] },
									{ "id" : "_crocal_eutf_page_title_bg_mode", "values" : ["custom"] },
									{ "id" : "_crocal_eutf_disable_title", "values" : [""] }

								]',
							)
						);
						crocal_eutf_print_admin_option(
							array(
								'type' => 'select-bg-position',
								'name' => '_crocal_eutf_page_title_bg_position',
								'id' => '_crocal_eutf_page_title_bg_position',
								'value' => crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'bg_position', 'center-center'),
								'label' => array(
									"title" => esc_html__( 'Background Position', 'crocal' ),
								),
								'dependency' =>
								'[
									{ "id" : "_crocal_eutf_page_title_custom", "values" : ["custom"] },
									{ "id" : "_crocal_eutf_page_title_bg_mode", "values" : ["featured","custom"] },
									{ "id" : "_crocal_eutf_disable_title", "values" : [""] }
								]',
							)
						);

						crocal_eutf_print_admin_option(
							array(
								'type' => 'select-pattern-overlay',
								'name' => '_crocal_eutf_page_title_pattern_overlay',
								'value' => crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'pattern_overlay'),
								'label' => esc_html__( 'Pattern Overlay', 'crocal' ),
								'dependency' =>
								'[
									{ "id" : "_crocal_eutf_page_title_custom", "values" : ["custom"] },
									{ "id" : "_crocal_eutf_page_title_bg_mode", "values" : ["featured","custom"] },
									{ "id" : "_crocal_eutf_disable_title", "values" : [""] }
								]',
							)
						);
						crocal_eutf_print_admin_option(
							array(
								'type' => 'select-colorpicker',
								'name' => '_crocal_eutf_page_title_color_overlay',
								'value' => crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'color_overlay', 'dark' ),
								'value2' => crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'color_overlay_custom', '#000000' ),
								'default_value2' => '#000000',
								'label' => esc_html__( 'Color Overlay', 'crocal' ),
								'multiple' => 'multi',
								'dependency' =>
								'[
									{ "id" : "_crocal_eutf_page_title_custom", "values" : ["custom"] },
									{ "id" : "_crocal_eutf_page_title_bg_mode", "values" : ["featured","custom"] },
									{ "id" : "_crocal_eutf_disable_title", "values" : [""] }
								]',
							)
						);
						crocal_eutf_print_admin_option(
							array(
								'type' => 'select-opacity',
								'name' => '_crocal_eutf_page_title_opacity_overlay',
								'value' => crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'opacity_overlay', '0' ),
								'label' => esc_html__( 'Opacity Overlay', 'crocal' ),
								'dependency' =>
								'[
									{ "id" : "_crocal_eutf_page_title_custom", "values" : ["custom"] },
									{ "id" : "_crocal_eutf_page_title_bg_mode", "values" : ["featured","custom"] },
									{ "id" : "_crocal_eutf_disable_title", "values" : [""] }
								]',
							)
						);

						echo '</div>';
					?>
				</div>

				<?php if( 'product' == $post_type ) { ?>
				<div id="eut-page-option-tab-section-area" class="eut-tab-item">
					<?php

						echo '<div id="_crocal_eutf_page_section_area">';

						crocal_eutf_print_admin_option(
							array(
								'type' => 'select',
								'name' => '_crocal_eutf_area_section_type',
								'id' => '_crocal_eutf_area_section_type',
								'value' => $crocal_eutf_area_section_type,
								'options' => array(
									'' => esc_html__( '-- Inherit --', 'crocal' ),
									'fullwidth-background' => esc_html__( 'No', 'crocal' ),
									'fullwidth-element' => esc_html__( 'Yes', 'crocal' ),
								),
								'label' => array(
									'title' => esc_html__( 'Area Full Width', 'crocal' ),
									'desc' => esc_html__( "Select if you prefer a full-width Area.", 'crocal' ),
									"info" => $crocal_eutf_theme_options_info,
								),
							)
						);
						crocal_eutf_print_admin_option(
							array(
								'type' => 'select',
								'name' => '_crocal_eutf_area_padding_top_multiplier',
								'id' => '_crocal_eutf_area_padding_top_multiplier',
								'value' => $crocal_eutf_area_padding_top_multiplier,
								'options' => $crocal_eutf_page_padding_selection,
								'label' => array(
									'title' => esc_html__( 'Top Padding', 'crocal' ),
									'desc' => esc_html__( "Select the space above the area.", 'crocal' ),
									"info" => $crocal_eutf_theme_options_info,
								),
							)
						);
						crocal_eutf_print_admin_option(
							array(
								'type' => 'select',
								'name' => '_crocal_eutf_area_padding_bottom_multiplier',
								'id' => '_crocal_eutf_area_padding_bottom_multiplier',
								'value' => $crocal_eutf_area_padding_bottom_multiplier,
								'options' => $crocal_eutf_page_padding_selection,
								'label' => array(
									'title' => esc_html__( 'Bottom Padding', 'crocal' ),
									'desc' => esc_html__( "Select the space below the area.", 'crocal' ),
									"info" => $crocal_eutf_theme_options_info,
								),
							)
						);

						crocal_eutf_print_admin_option(
							array(
								'type' => 'select-image',
								'name' => '_crocal_eutf_area_image_id',
								'id' => '_crocal_eutf_area_image_id',
								'value' => $crocal_eutf_area_image_id,
								'label' => array(
									"title" => esc_html__( 'Custom Image', 'crocal' ),
									"desc" => esc_html__( 'If selected this image will replace the Feature Image of this area.', 'crocal' ),
								),
								'width' => 'fullwidth',
							)
						);

						//Custom colors

						crocal_eutf_print_admin_option(
							array(
								'type' => 'select',
								'name' => '_crocal_eutf_area_colors_custom',
								'id' => '_crocal_eutf_area_colors_custom',
								'value' => crocal_eutf_array_value( $crocal_eutf_area_colors, 'custom' ),
								'options' => array(
									'' => esc_html__( '-- Inherit --', 'crocal' ),
									'custom' => esc_html__( 'Custom', 'crocal' ),
								),
								'label' => array(
									"title" => esc_html__( 'Area Color Options', 'crocal' ),
									"info" => $crocal_eutf_area_colors_info,
								),
								'group_id' => '_crocal_eutf_page_section_area',
								'highlight' => 'highlight',
							)
						);

						crocal_eutf_print_admin_option(
							array(
								'type' => 'colorpicker',
								'name' => '_crocal_eutf_area_bg_color',
								'id' => '_crocal_eutf_area_bg_color',
								'value' => crocal_eutf_array_value( $crocal_eutf_area_colors, 'bg_color', '#eeeeee' ),
								'default_value' => '#eeeeee',
								'label' => array(
									"title" => esc_html__( 'Background Color', 'crocal' ),
								),
								'dependency' =>
								'[
									{ "id" : "_crocal_eutf_area_colors_custom", "values" : ["custom"] }
								]',
							)
						);
						crocal_eutf_print_admin_option(
							array(
								'type' => 'colorpicker',
								'name' => '_crocal_eutf_area_headings_color',
								'id' => '_crocal_eutf_area_headings_color',
								'value' => crocal_eutf_array_value( $crocal_eutf_area_colors, 'headings_color', '#000000' ),
								'default_value' => '#000000',
								'label' => array(
									"title" => esc_html__( 'Headings Color', 'crocal' ),
								),
								'dependency' =>
								'[
									{ "id" : "_crocal_eutf_area_colors_custom", "values" : ["custom"] }
								]',
							)
						);
						crocal_eutf_print_admin_option(
							array(
								'type' => 'colorpicker',
								'name' => '_crocal_eutf_area_font_color',
								'id' => '_crocal_eutf_area_font_color',
								'value' => crocal_eutf_array_value( $crocal_eutf_area_colors, 'font_color', '#999999' ),
								'default_value' => '#999999',
								'label' => array(
									"title" => esc_html__( 'Font Color', 'crocal' ),
								),
								'dependency' =>
								'[
									{ "id" : "_crocal_eutf_area_colors_custom", "values" : ["custom"] }
								]',
							)
						);
						crocal_eutf_print_admin_option(
							array(
								'type' => 'colorpicker',
								'name' => '_crocal_eutf_area_link_color',
								'id' => '_crocal_eutf_area_link_color',
								'value' => crocal_eutf_array_value( $crocal_eutf_area_colors, 'link_color', '#FF7D88' ),
								'default_value' => '#FF7D88',
								'label' => array(
									"title" => esc_html__( 'Link Color', 'crocal' ),
								),
								'dependency' =>
								'[
									{ "id" : "_crocal_eutf_area_colors_custom", "values" : ["custom"] }
								]',
							)
						);
						crocal_eutf_print_admin_option(
							array(
								'type' => 'colorpicker',
								'name' => '_crocal_eutf_area_hover_color',
								'id' => '_crocal_eutf_area_hover_color',
								'value' => crocal_eutf_array_value( $crocal_eutf_area_colors, 'hover_color', '#000000' ),
								'default_value' => '#000000',
								'label' => array(
									"title" => esc_html__( 'Hover Color', 'crocal' ),
								),
								'dependency' =>
								'[
									{ "id" : "_crocal_eutf_area_colors_custom", "values" : ["custom"] }
								]',
							)
						);
						crocal_eutf_print_admin_option(
							array(
								'type' => 'colorpicker',
								'name' => '_crocal_eutf_area_border_color',
								'id' => '_crocal_eutf_area_border_color',
								'value' => crocal_eutf_array_value( $crocal_eutf_area_colors, 'border_color', '#e0e0e0' ),
								'default_value' => '#e0e0e0',
								'label' => array(
									"title" => esc_html__( 'Border Color', 'crocal' ),
								),
								'dependency' =>
								'[
									{ "id" : "_crocal_eutf_area_colors_custom", "values" : ["custom"] }
								]',
							)
						);
						crocal_eutf_print_admin_option(
							array(
								'type' => 'select',
								'name' => '_crocal_eutf_area_button_color',
								'id' => '_crocal_eutf_area_button_color',
								'value' => crocal_eutf_array_value( $crocal_eutf_area_colors, 'button_color', 'primary-1' ),
								'options' => $crocal_eutf_button_color_selection,
								'label' => array(
									"title" => esc_html__( 'Button Color', 'crocal' ),
								),
								'dependency' =>
								'[
									{ "id" : "_crocal_eutf_area_colors_custom", "values" : ["custom"] }
								]',
							)
						);
						crocal_eutf_print_admin_option(
							array(
								'type' => 'select',
								'name' => '_crocal_eutf_button_hover_color',
								'id' => '_crocal_eutf_button_hover_color',
								'value' => crocal_eutf_array_value( $crocal_eutf_area_colors, 'button_hover_color', 'black' ),
								'options' => $crocal_eutf_button_color_selection,
								'label' => array(
									"title" => esc_html__( 'Button HoverColor', 'crocal' ),
								),
								'dependency' =>
								'[
									{ "id" : "_crocal_eutf_area_colors_custom", "values" : ["custom"] }
								]',
							)
						);

						echo '</div>';
					?>
				</div>
				<?php } ?>

				<div id="eut-page-option-tab-layout" class="eut-tab-item">
					<?php

						echo '<div id="_crocal_eutf_page_padding">';

						crocal_eutf_print_admin_option(
							array(
								'type' => 'select',
								'name' => '_crocal_eutf_padding_top_multiplier',
								'id' => '_crocal_eutf_padding_top_multiplier',
								'value' => $crocal_eutf_padding_top_multiplier,
								'options' => $crocal_eutf_page_padding_selection_extra,
								'label' => array(
									'title' => esc_html__( 'Top Padding', 'crocal' ),
									'desc' => esc_html__( "Select the space above the content area.", 'crocal' ),
									"info" => $crocal_eutf_theme_options_info,
								),
								'group_id' => '_crocal_eutf_page_padding',
							)
						);
						crocal_eutf_print_admin_option(
							array(
								'type' => 'textfield',
								'name' => '_crocal_eutf_padding_top',
								'id' => '_crocal_eutf_padding_top',
								'value' => $crocal_eutf_padding_top,
								'label' => array(
									'title' => esc_html__( 'Custom Top Padding', 'crocal' ),
									'desc' => esc_html__( "You can use px, em, %, etc. or enter just number and it will use pixels.", 'crocal' ),
								),
								'dependency' =>
								'[
									{ "id" : "_crocal_eutf_padding_top_multiplier", "values" : ["custom"] }
								]',
							)
						);
						crocal_eutf_print_admin_option(
							array(
								'type' => 'select',
								'name' => '_crocal_eutf_padding_bottom_multiplier',
								'id' => '_crocal_eutf_padding_bottom_multiplier',
								'value' => $crocal_eutf_padding_bottom_multiplier,
								'options' => $crocal_eutf_page_padding_selection_extra,
								'label' => array(
									'title' => esc_html__( 'Bottom Padding', 'crocal' ),
									'desc' => esc_html__( "Select the space below the content area.", 'crocal' ),
									"info" => $crocal_eutf_theme_options_info,
								),
								'group_id' => '_crocal_eutf_page_padding',
							)
						);
						crocal_eutf_print_admin_option(
							array(
								'type' => 'textfield',
								'name' => '_crocal_eutf_padding_bottom',
								'id' => '_crocal_eutf_padding_bottom',
								'value' => $crocal_eutf_padding_bottom,
								'label' => array(
									'title' => esc_html__( 'Custom Bottom Padding', 'crocal' ),
									'desc' => esc_html__( "You can use px, em, %, etc. or enter just number and it will use pixels.", 'crocal' ),
								),
								'dependency' =>
								'[
									{ "id" : "_crocal_eutf_padding_bottom_multiplier", "values" : ["custom"] }
								]',
							)
						);

						echo '</div>';


						//Layout Option
						crocal_eutf_print_admin_option(
							array(
								'type' => 'select',
								'name' => '_crocal_eutf_layout',
								'id' => '_crocal_eutf_layout',
								'value' => $crocal_eutf_layout,
								'options' => array(
									'' => esc_html__( '-- Inherit --', 'crocal' ),
									'none' => esc_html__( 'Full Width', 'crocal' ),
									'left' => esc_html__( 'Left Sidebar', 'crocal' ),
									'right' => esc_html__( 'Right Sidebar', 'crocal' ),
								),
								'label' => array(
									"title" => esc_html__( 'Layout', 'crocal' ),
									"desc" => esc_html__( 'Select page content and sidebar alignment.', 'crocal' ),
									"info" => $crocal_eutf_theme_options_info,
								),
							)
						);

						//Sidebar Option
						crocal_eutf_print_admin_option_wrapper_start(
							array(
								'type' => 'select',
								'label' => array(
									"title" => esc_html__( 'Sidebar', 'crocal' ),
									"desc" => esc_html__( 'Select page sidebar.', 'crocal' ),
									"info" => $crocal_eutf_theme_options_info,
								),
							)
						);
						crocal_eutf_print_sidebar_selection( $crocal_eutf_sidebar, '_crocal_eutf_sidebar', '_crocal_eutf_sidebar' );
						crocal_eutf_print_admin_option_wrapper_end();

						//Fixed Sidebar Option
						crocal_eutf_print_admin_option(
							array(
								'type' => 'select',
								'name' => '_crocal_eutf_fixed_sidebar',
								'id' => '_crocal_eutf_fixed_sidebar',
								'value' => $crocal_eutf_fixed_sidebar,
								'options' => array(
									'' => esc_html__( '-- Inherit --', 'crocal' ),
									'no' => esc_html__( 'No', 'crocal' ),
									'yes' => esc_html__( 'Yes', 'crocal' ),
								),
								'label' => array(
									"title" => esc_html__( 'Fixed Sidebar', 'crocal' ),
									"desc" => esc_html__( 'If selected, sidebar will be fixed.', 'crocal' ),
								),
							)
						);



						//Posts Content Width
						if ( 'post' == $post_type || 'product' == $post_type || 'tribe_events' == $post_type  ) {

							crocal_eutf_print_admin_option(
								array(
									'type' => 'select',
									'name' => '_crocal_eutf_post_content_width',
									'id' => '_crocal_eutf_post_content_width',
									'value' => $crocal_eutf_post_content_width,
									'options' => array(
										'' => esc_html__( '-- Inherit --', 'crocal' ),
										'container' => esc_html__( 'Container Size' , 'crocal' ),
										'large' => esc_html__( 'Large' , 'crocal' ),
										'medium' => esc_html__( 'Medium' , 'crocal' ),
										'small' => esc_html__( 'Small' , 'crocal' ),
									),
									'label' => array(
										"title" => esc_html__( 'Content Width', 'crocal' ),
										"desc" => esc_html__( 'Select the Content Width (only for Full Width Layout)', 'crocal' ),
										"info" => $crocal_eutf_theme_options_info,
									),
								)
							);
						}

						//Background Options
						echo '<div id="_crocal_eutf_content_skin_options">';

						crocal_eutf_print_admin_option(
							array(
								'type' => 'select',
								'name' => '_crocal_eutf_content_skin',
								'id' => '_crocal_eutf_content_skin',
								'value' => crocal_eutf_array_value( $crocal_eutf_content_skin_options, 'skin' ),
								'options' => array(
									'' => esc_html__( '-- Inherit --', 'crocal' ),
									'dark' => esc_html__( 'Dark' , 'crocal' ),
									'light' => esc_html__( 'Light' , 'crocal' ),
									'custom' => esc_html__( 'Custom', 'crocal' ),
								),
								'label' => array(
									"title" => esc_html__( 'Content Skin', 'crocal' ),
									"info" => esc_html__( 'Inherit :Background from Theme Options - General Settings, Colors from Appearance > Customize > Colors - Main Content.', 'crocal' ),
								),
								'group_id' => '_crocal_eutf_content_skin_options',
								'highlight' => 'highlight',
							)
						);

						crocal_eutf_print_admin_option(
							array(
								'type' => 'colorpicker',
								'name' => '_crocal_eutf_content_text_color',
								'id' => '_crocal_eutf_content_text_color',
								'value' => crocal_eutf_array_value( $crocal_eutf_content_skin_options, 'text_color', "#888888" ),
								'label' => array(
									"title" => esc_html__( 'Color', 'crocal' ),
								),
								'default_value' => '#888888',
								'dependency' =>
								'[
									{ "id" : "_crocal_eutf_content_skin", "values" : ["custom"] }
								]',
							)
						);
						crocal_eutf_print_admin_option(
							array(
								'type' => 'colorpicker',
								'name' => '_crocal_eutf_content_heading_color',
								'id' => '_crocal_eutf_content_heading_color',
								'value' => crocal_eutf_array_value( $crocal_eutf_content_skin_options, 'heading_color','#000000' ),
								'label' => array(
									"title" => esc_html__( 'Heading Color', 'crocal' ),
								),
								'default_value' => '#000000',
								'dependency' =>
								'[
									{ "id" : "_crocal_eutf_content_skin", "values" : ["custom"] }
								]',
							)
						);

						crocal_eutf_print_admin_option(
							array(
								'type' => 'colorpicker',
								'name' => '_crocal_eutf_content_bg_color',
								'id' => '_crocal_eutf_content_bg_color',
								'value' => crocal_eutf_array_value( $crocal_eutf_content_skin_options, 'background-color', '#ffffff' ),
								'label' => array(
									"title" => esc_html__( 'Background Color', 'crocal' ),
								),
								'default_value' => '#ffffff',
								'dependency' =>
								'[
									{ "id" : "_crocal_eutf_content_skin", "values" : ["custom"] }
								]',
							)
						);

						crocal_eutf_print_admin_option(
							array(
								'type' => 'select',
								'name' => '_crocal_eutf_content_bg_repeat',
								'id' => '_crocal_eutf_content_bg_repeat',
								'value' => crocal_eutf_array_value( $crocal_eutf_content_skin_options, 'background-repeat' ),
								'options' => array(
									'' => esc_html__( '-- Not selected --', 'crocal' ),
									'no-repeat' => 'No Repeat',
									'repeat'    => 'Repeat All',
									'repeat-x'  => 'Repeat Horizontally',
									'repeat-y'  => 'Repeat Vertically',
									'inherit'   => 'Inherit',
								),
								'label' => esc_html__( 'Background Repeat', 'crocal' ),
								'dependency' =>
								'[
									{ "id" : "_crocal_eutf_content_skin", "values" : ["custom"] }
								]',
							)
						);

						crocal_eutf_print_admin_option(
							array(
								'type' => 'select',
								'name' => '_crocal_eutf_content_bg_size',
								'id' => '_crocal_eutf_content_bg_size',
								'value' => crocal_eutf_array_value( $crocal_eutf_content_skin_options, 'background-size' ),
								'options' => array(
									'' => esc_html__( '-- Not selected --', 'crocal' ),
									'inherit' => 'Inherit',
									'cover'   => 'Cover',
									'contain' => 'Contain',
								),
								'label' => esc_html__( 'Background Size', 'crocal' ),
								'dependency' =>
								'[
									{ "id" : "_crocal_eutf_content_skin", "values" : ["custom"] }
								]',
							)
						);

						crocal_eutf_print_admin_option(
							array(
								'type' => 'select',
								'name' => '_crocal_eutf_content_bg_attachment',
								'id' => '_crocal_eutf_content_bg_attachment',
								'value' => crocal_eutf_array_value( $crocal_eutf_content_skin_options, 'background-attachment' ),
								'options' => array(
									'' => esc_html__( '-- Not selected --', 'crocal' ),
									'fixed'   => 'Fixed',
									'scroll'  => 'Scroll',
									'inherit' => 'Inherit',
								),
								'label' => esc_html__( 'Background Attachment', 'crocal' ),
								'dependency' =>
								'[
									{ "id" : "_crocal_eutf_content_skin", "values" : ["custom"] }
								]',
							)
						);

						crocal_eutf_print_admin_option(
							array(
								'type' => 'select',
								'name' => '_crocal_eutf_content_bg_position',
								'id' => '_crocal_eutf_content_bg_position',
								'value' => crocal_eutf_array_value( $crocal_eutf_content_skin_options, 'background-position' ),
								'options' => array(
									'' => esc_html__( '-- Not selected --', 'crocal' ),
									'left top'      => 'Left Top',
									'left center'   => 'Left center',
									'left bottom'   => 'Left Bottom',
									'center top'    => 'Center Top',
									'center center' => 'Center Center',
									'center bottom' => 'Center Bottom',
									'right top'     => 'Right Top',
									'right center'  => 'Right center',
									'right bottom'  => 'Right Bottom',
								),
								'label' => esc_html__( 'Background Position', 'crocal' ),
								'dependency' =>
								'[
									{ "id" : "_crocal_eutf_content_skin", "values" : ["custom"] }
								]',
							)
						);

						crocal_eutf_print_admin_option(
							array(
								'type' => 'select-bg-image',
								'name' => '_crocal_eutf_content_bg_image',
								'id' => '_crocal_eutf_content_bg_image',
								'value' => crocal_eutf_array_value( $crocal_eutf_content_skin_options, 'background-image' ),
								'label' => esc_html__( 'Background Image', 'crocal' ),
								'width' => 'fullwidth',
								'dependency' =>
								'[
									{ "id" : "_crocal_eutf_content_skin", "values" : ["custom"] }
								]',
							)
						);

						echo '</div>';



					?>
				</div>
				<div id="eut-page-option-tab-sliding-area" class="eut-tab-item">
					<?php
						//Sidearea Visibility
						crocal_eutf_print_admin_option(
							array(
								'type' => 'select',
								'name' => '_crocal_eutf_sidearea_visibility',
								'id' => '_crocal_eutf_sidearea_visibility',
								'value' => $crocal_eutf_sidearea_visibility,
								'options' => array(
									'' => esc_html__( '-- Inherit --', 'crocal' ),
									'no' => esc_html__( 'No', 'crocal' ),
									'yes' => esc_html__( 'Yes', 'crocal' ),
								),
								'label' => array(
									"title" => esc_html__( 'Sliding Area Visibility', 'crocal' ),
									"info" => $crocal_eutf_theme_options_info,
								),
							)
						);

						//Sidearea Sidebar Option
						crocal_eutf_print_admin_option_wrapper_start(
							array(
								'type' => 'select',
								'label' => array(
									"title" => esc_html__( 'Sliding Area Sidebar', 'crocal' ),
									"desc" => esc_html__( 'Select sliding area sidebar.', 'crocal' ),
									"info" => $crocal_eutf_theme_options_info,
								),
							)
						);
						crocal_eutf_print_sidebar_selection( $crocal_eutf_sidearea_sidebar, '_crocal_eutf_sidearea_sidebar', '_crocal_eutf_sidearea_sidebar' );
						crocal_eutf_print_admin_option_wrapper_end();
					?>
				</div>
				<div id="eut-page-option-tab-bottom-footer-areas" class="eut-tab-item">
					<?php
						//Bottom / Footer Areas Visibility

						crocal_eutf_print_admin_option_wrapper_start(
							array(
								'type' => 'select',
								'label' => array(
									"title" => esc_html__( 'Bottom Bar Area', 'crocal' ),
									"desc" => esc_html__( 'Select an area item for your Bottom Bar Area.', 'crocal' ),
									"info" => esc_html__( 'Inherit : Theme Options - Bottom / Footer Areas - Bottom Bar Area Item.', 'crocal' ),
								),
							)
						);
						crocal_eutf_print_area_selection( $crocal_eutf_bottom_bar_area, 'eut-bottom-bar-area-item', '_crocal_eutf_bottom_bar_area' );
						crocal_eutf_print_admin_option_wrapper_end();

						crocal_eutf_print_admin_option(
							array(
								'type' => 'select',
								'name' => '_crocal_eutf_footer_widgets_visibility',
								'id' => '_crocal_eutf_footer_widgets_visibility',
								'value' => $crocal_eutf_footer_widgets_visibility,
								'options' => array(
									'' => esc_html__( '-- Inherit --', 'crocal' ),
									'no' => esc_html__( 'No', 'crocal' ),
									'yes' => esc_html__( 'Yes', 'crocal' ),
								),
								'label' => array(
									"title" => esc_html__( 'Footer Widgets Visibility', 'crocal' ),
									"desc" => esc_html__( 'Inherit : Theme Options - Bottom / Footer Areas - Footer Widgets Settings.', 'crocal' ),
								),
							)
						);

						crocal_eutf_print_admin_option(
							array(
								'type' => 'select',
								'name' => '_crocal_eutf_footer_bar_visibility',
								'id' => '_crocal_eutf_footer_bar_visibility',
								'value' => $crocal_eutf_footer_bar_visibility,
								'options' => array(
									'' => esc_html__( '-- Inherit --', 'crocal' ),
									'no' => esc_html__( 'No', 'crocal' ),
									'yes' => esc_html__( 'Yes', 'crocal' ),
								),
								'label' => array(
									"title" => esc_html__( 'Footer Bar Visibility', 'crocal' ),
									"desc" => esc_html__( 'Inherit : Theme Options - Bottom / Footer Areas - Footer Bar Settings.', 'crocal' ),
								),
							)
						);
					?>
				</div>
				<div id="eut-page-option-tab-extras" class="eut-tab-item">
					<?php

						//Details Option
						if ( 'portfolio' == $post_type) {
							crocal_eutf_print_admin_option(
								array(
									'type' => 'textfield',
									'name' => '_crocal_eutf_details_title',
									'id' => '_crocal_eutf_details_title',
									'value' => $crocal_eutf_details_title,
									'label' => array(
										'title' => esc_html__( 'Details Title', 'crocal' ),
										'desc' => esc_html__( 'Enter your details title.', 'crocal' ),
										'info' => $crocal_eutf_theme_options_info_text_empty,
									),
									'width' => 'fullwidth',
								)
							);
							crocal_eutf_print_admin_option(
								array(
									'type' => 'textarea',
									'name' => '_crocal_eutf_details',
									'id' => '_crocal_eutf_details',
									'value' => $crocal_eutf_details,
									'label' => array(
										'title' => esc_html__( 'Details Area', 'crocal' ),
										'desc' => esc_html__( 'Enter your details area.', 'crocal' ),
									),
									'width' => 'fullwidth',
								)
							);

							crocal_eutf_print_admin_option(
								array(
									'type' => 'textfield',
									'name' => '_crocal_eutf_details_link_text',
									'id' => '_crocal_eutf_details_link_text',
									'value' => $crocal_eutf_details_link_text,
									'label' => array(
										'title' => esc_html__( 'Link Text', 'crocal' ),
										'desc' => esc_html__( 'Enter your details link text.', 'crocal' ),
										'info' => $crocal_eutf_theme_options_info_text_empty,
									),
									'width' => 'fullwidth',
								)
							);
							crocal_eutf_print_admin_option(
								array(
									'type' => 'textfield',
									'name' => '_crocal_eutf_details_link_url',
									'value' => $crocal_eutf_details_link_url,
									'label' => array(
										'title' => esc_html__( 'Link URL', 'crocal' ),
										'desc' => esc_html__( 'Enter the full URL of your link.', 'crocal' ),
									),
									'width' => 'fullwidth',
								)
							);
							crocal_eutf_print_admin_option(
								array(
									'type' => 'checkbox',
									'name' => '_crocal_eutf_details_link_new_window',
									'value' => $crocal_eutf_details_link_new_window,
									'label' => array(
										'title' => esc_html__( 'Open Link in new window', 'crocal' ),
										'desc' => esc_html__( 'If selected, link will open in a new window.', 'crocal' ),
									),
								)
							);
							crocal_eutf_print_admin_option(
								array(
									'type' => 'textfield',
									'name' => '_crocal_eutf_details_link_extra_class',
									'value' => $crocal_eutf_details_link_extra_class,
									'label' => array(
										'title' => esc_html__( 'Link extra class name', 'crocal' ),
									),
								)
							);
							crocal_eutf_print_admin_option(
							array(
								'type' => 'select',
								'name' => '_crocal_eutf_social_bar_layout',
								'id' => '_crocal_eutf_social_bar_layout',
								'value' => $crocal_eutf_social_bar_layout,
								'options' => array(
									'' => esc_html__( '-- Inherit --', 'crocal' ),
									'hide' => esc_html__( 'Hide', 'crocal' ),
									'layout-1' => esc_html__( 'Bottom Layout', 'crocal' ),
									'layout-2' => esc_html__( 'Side Layout', 'crocal' ),
								),
								'label' => array(
									"title" => esc_html__( 'Social Layout', 'crocal' ),
									"desc" => esc_html__( 'Select your social layout.', 'crocal' ),
									"info" => $crocal_eutf_theme_options_info,
								),
							)
						);

						}

						if ( 'post' == $post_type || 'portfolio' == $post_type || 'product' == $post_type ) {
							//Backlink page
							crocal_eutf_print_admin_option_wrapper_start(
								array(
									'type' => 'select',
									'label' => array(
										"title" => esc_html__( 'Backlink', 'crocal' ),
										"desc" => esc_html__( 'Select your backlink page.', 'crocal' ),
										"info" => $crocal_eutf_theme_options_info,
									),
								)
							);
							crocal_eutf_print_page_selection( $crocal_eutf_backlink_id, 'eut-backlink-id', '_crocal_eutf_backlink_id' );
							crocal_eutf_print_admin_option_wrapper_end();
						}

						//Anchor Navigation Menu Option

						crocal_eutf_print_admin_option_wrapper_start(
							array(
								'type' => 'select',
								'label' => array(
									"title" => esc_html__( 'Anchor Navigation Menu', 'crocal' ),
									"desc" => esc_html__( 'Select page anchor navigation menu.', 'crocal' ),
								),
							)
						);
						crocal_eutf_print_menu_selection( $crocal_eutf_anchor_navigation_menu, 'eut-page-navigation-menu', '_crocal_eutf_anchor_navigation_menu' );
						crocal_eutf_print_admin_option_wrapper_end();

						//Theme Loader
						crocal_eutf_print_admin_option(
							array(
								'type' => 'select',
								'name' => '_crocal_eutf_theme_loader',
								'id' => '_crocal_eutf_theme_loader',
								'value' => $crocal_eutf_theme_loader,
								'options' => array(
									'' => esc_html__( '-- Inherit --', 'crocal' ),
									'no' => esc_html__( 'No', 'crocal' ),
									'yes' => esc_html__( 'Yes', 'crocal' ),
								),
								'label' => array(
									"title" => esc_html__( 'Theme Loader Visibility', 'crocal' ),
									"info" => esc_html__( 'Inherit : Theme Options - General Settings - Theme Loader / Transitions.', 'crocal' ),
								),
							)
						);
					?>
				</div>
				<div id="eut-page-option-tab-scrolling-sections" class="eut-tab-item">
					<?php

						//Responsive Scrolling Option
						if ( 'page' == $post_type) {

							echo '<div id="_crocal_eutf_page_scrolling_section">';

							crocal_eutf_print_admin_option(
								array(
									'type' => 'select',
									'name' => '_crocal_eutf_scrolling_page',
									'id' => '_crocal_eutf_scrolling_page',
									'value' => $crocal_eutf_scrolling_page,
									'options' => array(
										'' => esc_html__( 'Full Page', 'crocal' ),
										'pilling' => esc_html__( 'Page Pilling', 'crocal' ),
									),
									'label' => array(
										'title' => esc_html__( 'Scrolling Sections Plugin', 'crocal' ),
										'desc' => esc_html__( 'Select the scrolling sections plugin you want to use.', 'crocal' ),
										'info' => esc_html__( 'Note: The following options are available only for Scrolling Full Screen Sections Template.', 'crocal' ),
									),
									'highlight' => 'highlight',
									'group_id' => '_crocal_eutf_page_scrolling_section',
								)
							);
							crocal_eutf_print_admin_option(
								array(
									'type' => 'select',
									'name' => '_crocal_eutf_scrolling_lock_anchors',
									'id' => '_crocal_eutf_scrolling_lock_anchors',
									'value' => $crocal_eutf_scrolling_lock_anchors,
									'options' => array(
										'' => esc_html__( 'URL without /#', 'crocal' ),
										'no' => esc_html__( 'Allow Anchor Links in URL', 'crocal' ),
									),
									'label' => array(
										'title' => esc_html__( 'Anchor Links', 'crocal' ),
										'desc' => esc_html__( 'Select if you want to allow anchor links.', 'crocal' ),
									),
								)
							);
							crocal_eutf_print_admin_option(
								array(
									'type' => 'select',
									'name' => '_crocal_eutf_scrolling_loop',
									'id' => '_crocal_eutf_scrolling_loop',
									'value' => $crocal_eutf_scrolling_loop,
									'options' => array(
										'' => esc_html__( 'None', 'crocal' ),
										'top' => esc_html__( 'Loop Top', 'crocal' ),
										'bottom' => esc_html__( 'Loop Bottom', 'crocal' ),
										'both' => esc_html__( 'Loop Top/Bottom', 'crocal' ),
									),
									'label' => array(
										'title' => esc_html__( 'Loop', 'crocal' ),
										'desc' => esc_html__( 'Select if you want to loop.', 'crocal' ),
									),
								)
							);
							crocal_eutf_print_admin_option(
								array(
									'type' => 'select',
									'name' => '_crocal_eutf_scrolling_direction',
									'id' => '_crocal_eutf_scrolling_direction',
									'value' => $crocal_eutf_scrolling_direction,
									'options' => array(
										'' => esc_html__( 'Vertical', 'crocal' ),
										'horizontal' => esc_html__( 'Horizontal', 'crocal' ),
									),
									'label' => array(
										'title' => esc_html__( 'Direction', 'crocal' ),
										'desc' => esc_html__( 'Select scrolling direction.', 'crocal' ),
									),
									'dependency' =>
									'[
										{ "id" : "_crocal_eutf_scrolling_page", "values" : ["pilling"] }
									]',
								)
							);
							crocal_eutf_print_admin_option(
								array(
									'type' => 'textfield',
									'name' => '_crocal_eutf_scrolling_speed',
									'id' => '_crocal_eutf_scrolling_speed',
									'value' => $crocal_eutf_scrolling_speed,
									'label' => array(
										'title' => esc_html__( 'Speed (ms)', 'crocal' ),
										'desc' => esc_html__( 'Enter scrolling speed.', 'crocal' ),
									),
									'default_value' => '1000',

								)
							);
							crocal_eutf_print_admin_option(
								array(
									'type' => 'select',
									'name' => '_crocal_eutf_responsive_scrolling',
									'id' => '_crocal_eutf_responsive_scrolling',
									'value' => $crocal_eutf_responsive_scrolling,
									'options' => array(
										'' => esc_html__( 'Yes', 'crocal' ),
										'no' => esc_html__( 'No', 'crocal' ),
									),
									'label' => array(
										'title' => esc_html__( 'Responsive Scrolling Full Sections', 'crocal' ),
										'desc' => esc_html__( 'Select if you want to maintain the scrolling feature on devices.', 'crocal' ),
									),
								)
							);

							echo '</div>';
						}

					?>
				</div>
				<div id="eut-page-option-tab-visibility" class="eut-tab-item">
					<?php

						crocal_eutf_print_admin_option(
							array(
								'type' => 'checkbox',
								'name' => '_crocal_eutf_disable_top_bar',
								'id' => '_crocal_eutf_disable_top_bar',
								'value' => $crocal_eutf_disable_top_bar,
								'label' => array(
									"title" => esc_html__( 'Disable Top Bar', 'crocal' ),
									"desc" => esc_html__( 'If selected, top bar will be hidden.', 'crocal' ),
								),
							)
						);

						crocal_eutf_print_admin_option(
							array(
								'type' => 'checkbox',
								'name' => '_crocal_eutf_disable_logo',
								'id' => '_crocal_eutf_disable_logo',
								'value' => $crocal_eutf_disable_logo,
								'label' => array(
									"title" => esc_html__( 'Disable Logo', 'crocal' ),
									"desc" => esc_html__( 'If selected, logo will be disabled.', 'crocal' ),
								),
							)
						);
						crocal_eutf_print_admin_option(
							array(
								'type' => 'checkbox',
								'name' => '_crocal_eutf_disable_menu',
								'id' => '_crocal_eutf_disable_menu',
								'value' => $crocal_eutf_disable_menu,
								'label' => array(
									"title" => esc_html__( 'Disable Main Menu', 'crocal' ),
									"desc" => esc_html__( 'If selected, main menu will be hidden.', 'crocal' ),
								),
							)
						);

						crocal_eutf_print_admin_option(
							array(
								'type' => 'checkbox',
								'name' => '_crocal_eutf_disable_menu_item_search',
								'id' => '_crocal_eutf_disable_menu_item_search',
								'value' => crocal_eutf_array_value( $crocal_eutf_disable_menu_items, 'search'),
								'label' => array(
									"title" => esc_html__( 'Disable Main Menu Item Search', 'crocal' ),
									"desc" => esc_html__( 'If selected, main menu item will be hidden.', 'crocal' ),
								),
							)
						);
						crocal_eutf_print_admin_option(
							array(
								'type' => 'checkbox',
								'name' => '_crocal_eutf_disable_menu_item_form',
								'id' => '_crocal_eutf_disable_menu_item_form',
								'value' => crocal_eutf_array_value( $crocal_eutf_disable_menu_items, 'form'),
								'label' => array(
									"title" => esc_html__( 'Disable Main Menu Item Contact Form', 'crocal' ),
									"desc" => esc_html__( 'If selected, main menu item will be hidden.', 'crocal' ),
								),
							)
						);
						crocal_eutf_print_admin_option(
							array(
								'type' => 'checkbox',
								'name' => '_crocal_eutf_disable_menu_item_language',
								'id' => '_crocal_eutf_disable_menu_item_language',
								'value' => crocal_eutf_array_value( $crocal_eutf_disable_menu_items, 'language'),
								'label' => array(
									"title" => esc_html__( 'Disable Main Menu Item Language Selector', 'crocal' ),
									"desc" => esc_html__( 'If selected, main menu item will be hidden.', 'crocal' ),
								),
							)
						);
						crocal_eutf_print_admin_option(
							array(
								'type' => 'checkbox',
								'name' => '_crocal_eutf_disable_menu_item_cart',
								'id' => '_crocal_eutf_disable_menu_item_cart',
								'value' => crocal_eutf_array_value( $crocal_eutf_disable_menu_items, 'cart'),
								'label' => array(
									"title" => esc_html__( 'Disable Main Menu Item Shopping Cart', 'crocal' ),
									"desc" => esc_html__( 'If selected, main menu item will be hidden.', 'crocal' ),
								),
							)
						);
						crocal_eutf_print_admin_option(
							array(
								'type' => 'checkbox',
								'name' => '_crocal_eutf_disable_menu_item_social',
								'id' => '_crocal_eutf_disable_menu_item_social',
								'value' => crocal_eutf_array_value( $crocal_eutf_disable_menu_items, 'social'),
								'label' => array(
									"title" => esc_html__( 'Disable Main Menu Item Social Icons', 'crocal' ),
									"desc" => esc_html__( 'If selected, main menu item will be hidden.', 'crocal' ),
								),
							)
						);
						crocal_eutf_print_admin_option(
							array(
								'type' => 'checkbox',
								'name' => '_crocal_eutf_disable_header_text',
								'id' => '_crocal_eutf_disable_header_text',
								'value' => $crocal_eutf_disable_header_text,
								'label' => array(
									"title" => esc_html__( 'Disable Header Text', 'crocal' ),
									"desc" => esc_html__( 'If selected, header text will be hidden.', 'crocal' ),
								),
							)
						);

						crocal_eutf_print_admin_option(
							array(
								'type' => 'checkbox',
								'name' => '_crocal_eutf_disable_breadcrumbs',
								'id' => '_crocal_eutf_disable_breadcrumbs',
								'value' => $crocal_eutf_disable_breadcrumbs,
								'label' => array(
									"title" => esc_html__( 'Disable Breadcrumbs', 'crocal' ),
									"desc" => esc_html__( 'If selected, breadcrumbs items will be hidden.', 'crocal' ),
								),
							)
						);

						if ( 'page' == $post_type ) {
							if ( crocal_eutf_woocommerce_enabled() && $post->ID == wc_get_page_id( 'shop' ) ) {
								//Skip
							} else {
								crocal_eutf_print_admin_option(
									array(
										'type' => 'checkbox',
										'name' => '_crocal_eutf_disable_content',
										'id' => '_crocal_eutf_disable_content',
										'value' => $crocal_eutf_disable_content,
										'label' => array(
											"title" => esc_html__( 'Disable Content Area', 'crocal' ),
											"desc" => esc_html__( 'If selected, content area will be hidden (including sidebar and comments).', 'crocal' ),
										),
									)
								);
							}
						}

						if ( 'post' == $post_type ) {
							crocal_eutf_print_admin_option(
								array(
									'type' => 'checkbox',
									'name' => '_crocal_eutf_disable_media',
									'id' => '_crocal_eutf_disable_media',
									'value' => $crocal_eutf_disable_media,
									'label' => array(
										"title" => esc_html__( 'Disable Media Area', 'crocal' ),
										"desc" => esc_html__( 'If selected, media area will be hidden.', 'crocal' ),
									),
								)
							);
						}
						if ( 'portfolio' == $post_type ) {
							crocal_eutf_print_admin_option(
								array(
									'type' => 'checkbox',
									'name' => '_crocal_eutf_disable_recent_entries',
									'id' => '_crocal_eutf_disable_recent_entries',
									'value' => $crocal_eutf_disable_recent_entries,
									'label' => array(
										"title" => esc_html__( 'Disable Recent Entries', 'crocal' ),
										"desc" => esc_html__( 'If selected, recent entries area will be hidden.', 'crocal' ),
									),
								)
							);
						}

						crocal_eutf_print_admin_option(
							array(
								'type' => 'checkbox',
								'name' => '_crocal_eutf_disable_back_to_top',
								'id' => '_crocal_eutf_disable_back_to_top',
								'value' => $crocal_eutf_disable_back_to_top,
								'label' => array(
									"title" => esc_html__( 'Disable Back to Top', 'crocal' ),
									"desc" => esc_html__( 'If selected, Back to Top button will be hidden.', 'crocal' ),
								),
							)
						);

					?>
				</div>
			</div>
		</div>
	</div>

<?php
}

function crocal_eutf_page_feature_section_box( $post ) {

	wp_nonce_field( 'crocal_eutf_nonce_feature_save', '_crocal_eutf_nonce_feature_save' );

	$post_id = $post->ID;
	crocal_eutf_admin_get_feature_section( $post_id );

}

function crocal_eutf_generic_options_save_postdata( $post_id , $post ) {

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( isset( $_POST['_crocal_eutf_nonce_feature_save'] ) && wp_verify_nonce( $_POST['_crocal_eutf_nonce_feature_save'], 'crocal_eutf_nonce_feature_save' ) ) {

		if ( crocal_eutf_check_permissions( $post_id ) ) {
			crocal_eutf_admin_save_feature_section( $post_id );
		}

	}

	if ( isset( $_POST['_crocal_eutf_nonce_page_save'] ) && wp_verify_nonce( $_POST['_crocal_eutf_nonce_page_save'], 'crocal_eutf_nonce_page_save' ) ) {

		if ( crocal_eutf_check_permissions( $post_id ) ) {

			$crocal_eutf_page_options = array (
				array(
					'name' => 'Description',
					'id' => '_crocal_eutf_description',
					'html' => true,
				),
				array(
					'name' => 'Details Title',
					'id' => '_crocal_eutf_details_title',
					'html' => true,
				),
				array(
					'name' => 'Details',
					'id' => '_crocal_eutf_details',
					'html' => true,
				),
				array(
					'name' => 'Details Link Text',
					'id' => '_crocal_eutf_details_link_text',
					'html' => true,
				),
				array(
					'name' => 'Details Link URL',
					'id' => '_crocal_eutf_details_link_url',
				),
				array(
					'name' => 'Details Link New Window',
					'id' => '_crocal_eutf_details_link_new_window',
				),
				array(
					'name' => 'Details Link Extra Class',
					'id' => '_crocal_eutf_details_link_extra_class',
				),
				array(
					'name' => 'Social Bar Layout',
					'id' => '_crocal_eutf_social_bar_layout',
				),

				array(
					'name' => 'Backlink',
					'id' => '_crocal_eutf_backlink_id',
				),
				array(
					'name' => 'Area Section Type',
					'id' => '_crocal_eutf_area_section_type',
				),
				array(
					'name' => 'Area Top Padding Multiplier',
					'id' => '_crocal_eutf_area_padding_top_multiplier',
				),
				array(
					'name' => 'Area Bottom Padding Multiplier',
					'id' => '_crocal_eutf_area_padding_bottom_multiplier',
				),
				array(
					'name' => 'Area Image ID',
					'id' => '_crocal_eutf_area_image_id',
				),
				array(
					'name' => 'Top Padding',
					'id' => '_crocal_eutf_padding_top_multiplier',
				),
				array(
					'name' => 'Bottom Padding',
					'id' => '_crocal_eutf_padding_bottom_multiplier',
				),
				array(
					'name' => 'Custom Top Padding',
					'id' => '_crocal_eutf_padding_top',
				),
				array(
					'name' => 'Custom Bottom Padding',
					'id' => '_crocal_eutf_padding_bottom',
				),
				array(
					'name' => 'Layout',
					'id' => '_crocal_eutf_layout',
				),
				array(
					'name' => 'Sidebar',
					'id' => '_crocal_eutf_sidebar',
				),
				array(
					'name' => 'Post Content width',
					'id' => '_crocal_eutf_post_content_width',
				),
				array(
					'name' => 'Content Skin',
					'id' => '_crocal_eutf_content_skin',
				),
				array(
					'name' => 'Sidearea Area Visibility',
					'id' => '_crocal_eutf_sidearea_visibility',
				),
				array(
					'name' => 'Sidearea Sidebar',
					'id' => '_crocal_eutf_sidearea_sidebar',
				),
				array(
					'name' => 'Fixed Sidebar',
					'id' => '_crocal_eutf_fixed_sidebar',
				),
				array(
					'name' => 'Header Overlapping',
					'id' => '_crocal_eutf_header_overlapping',
				),
				array(
					'name' => 'Header Style',
					'id' => '_crocal_eutf_header_style',
				),
				array(
					'name' => 'Navigation Anchor Menu',
					'id' => '_crocal_eutf_anchor_navigation_menu',
				),
				array(
					'name' => 'Theme Loader',
					'id' => '_crocal_eutf_theme_loader',
				),
				array(
					'name' => 'Scrolling Page',
					'id' => '_crocal_eutf_scrolling_page',
				),
				array(
					'name' => 'Responsive Scrolling',
					'id' => '_crocal_eutf_responsive_scrolling',
				),
				array(
					'name' => 'Scrolling Lock Anchors',
					'id' => '_crocal_eutf_scrolling_lock_anchors',
				),
				array(
					'name' => 'Scrolling Direction',
					'id' => '_crocal_eutf_scrolling_direction',
				),
				array(
					'name' => 'Scrolling Loop',
					'id' => '_crocal_eutf_scrolling_loop',
				),
				array(
					'name' => 'Scrolling Speed',
					'id' => '_crocal_eutf_scrolling_speed',
				),
				array(
					'name' => 'Main Navigation Menu',
					'id' => '_crocal_eutf_main_navigation_menu',
				),
				array(
					'name' => 'Responsive Navigation Menu',
					'id' => '_crocal_eutf_responsive_navigation_menu',
				),
				array(
					'name' => 'Menu Type',
					'id' => '_crocal_eutf_menu_type',
				),
				array(
					'name' => 'Responsive Header Overlapping',
					'id' => '_crocal_eutf_responsive_header_overlapping',
				),
				array(
					'name' => 'Sticky Header Type',
					'id' => '_crocal_eutf_sticky_header_type',
				),
				array(
					'name' => 'Bottom Bar',
					'id' => '_crocal_eutf_bottom_bar_area',
				),
				array(
					'name' => 'Footer Widgets',
					'id' => '_crocal_eutf_footer_widgets_visibility',
				),
				array(
					'name' => 'Footer Bar',
					'id' => '_crocal_eutf_footer_bar_visibility',
				),
				array(
					'name' => 'Disable Top Bar',
					'id' => '_crocal_eutf_disable_top_bar',
				),
				array(
					'name' => 'Disable Logo',
					'id' => '_crocal_eutf_disable_logo',
				),
				array(
					'name' => 'Disable Menu',
					'id' => '_crocal_eutf_disable_menu',
				),
				array(
					'name' => 'Disable Menu Items',
					'id' => '_crocal_eutf_disable_menu_items',
				),
				array(
					'name' => 'Disable Header Text',
					'id' => '_crocal_eutf_disable_header_text',
				),
				array(
					'name' => 'disable Breadcrumbs',
					'id' => '_crocal_eutf_disable_breadcrumbs',
				),
				array(
					'name' => 'Disable Title',
					'id' => '_crocal_eutf_disable_title',
				),
				array(
					'name' => 'Disable Media',
					'id' => '_crocal_eutf_disable_media',
				),
				array(
					'name' => 'Disable Content',
					'id' => '_crocal_eutf_disable_content',
				),
				array(
					'name' => 'Disable Recent Entries',
					'id' => '_crocal_eutf_disable_recent_entries',
				),
				array(
					'name' => 'Disable Back to Top',
					'id' => '_crocal_eutf_disable_back_to_top',
				),
			);

			$crocal_eutf_disable_menu_items_options = array (
				array(
					'param_id' => 'search',
					'id' => '_crocal_eutf_disable_menu_item_search',
					'default' => '',
				),
				array(
					'param_id' => 'form',
					'id' => '_crocal_eutf_disable_menu_item_form',
					'default' => '',
				),
				array(
					'param_id' => 'language',
					'id' => '_crocal_eutf_disable_menu_item_language',
					'default' => '',
				),
				array(
					'param_id' => 'cart',
					'id' => '_crocal_eutf_disable_menu_item_cart',
					'default' => '',
				),
				array(
					'param_id' => 'social',
					'id' => '_crocal_eutf_disable_menu_item_social',
					'default' => '',
				),
			);

			//Title Options
			$crocal_eutf_page_title_options = array (
				array(
					'param_id' => 'custom',
					'id' => '_crocal_eutf_page_title_custom',
					'default' => '',
				),
				array(
					'param_id' => 'height',
					'id' => '_crocal_eutf_page_title_height',
					'default' => '40',
				),
				array(
					'param_id' => 'min_height',
					'id' => '_crocal_eutf_page_title_min_height',
					'default' => '200',
				),
				array(
					'param_id' => 'bg_color',
					'id' => '_crocal_eutf_page_title_bg_color',
					'default' => 'light',
				),
				array(
					'param_id' => 'bg_color_custom',
					'id' => '_crocal_eutf_page_title_bg_color_custom',
					'default' => '#ffffff',
				),
				array(
					'param_id' => 'subheading_color',
					'id' => '_crocal_eutf_page_title_subheading_color',
					'default' => 'light',
				),
				array(
					'param_id' => 'subheading_color_custom',
					'id' => '_crocal_eutf_page_title_subheading_color_custom',
					'default' => '#ffffff',
				),
				array(
					'param_id' => 'title_color',
					'id' => '_crocal_eutf_page_title_title_color',
					'default' => 'dark',
				),
				array(
					'param_id' => 'title_color_custom',
					'id' => '_crocal_eutf_page_title_title_color_custom',
					'default' => '#000000',
				),
				array(
					'param_id' => 'caption_color',
					'id' => '_crocal_eutf_page_title_caption_color',
					'default' => 'dark',
				),
				array(
					'param_id' => 'caption_color_custom',
					'id' => '_crocal_eutf_page_title_caption_color_custom',
					'default' => '#000000',
				),
				array(
					'param_id' => 'content_bg_color',
					'id' => '_crocal_eutf_page_title_content_bg_color',
					'default' => 'none',
				),
				array(
					'param_id' => 'content_bg_color_custom',
					'id' => '_crocal_eutf_page_title_content_bg_color_custom',
					'default' => '#000000',
				),
				array(
					'param_id' => 'container_size',
					'id' => '_crocal_eutf_page_title_container_size',
					'default' => '',
				),
				array(
					'param_id' => 'content_size',
					'id' => '_crocal_eutf_page_title_content_size',
					'default' => 'large',
				),
				array(
					'param_id' => 'content_alignment',
					'id' => '_crocal_eutf_page_title_content_alignment',
					'default' => 'center',
				),
				array(
					'param_id' => 'content_position',
					'id' => '_crocal_eutf_page_title_content_position',
					'default' => 'center-center',
				),
				array(
					'param_id' => 'content_animation',
					'id' => '_crocal_eutf_page_title_content_animation',
					'default' => 'fade-in',
				),
				array(
					'param_id' => 'bg_mode',
					'id' => '_crocal_eutf_page_title_bg_mode',
					'default' => '',
				),
				array(
					'param_id' => 'bg_image_id',
					'id' => '_crocal_eutf_page_title_bg_image_id',
					'default' => '0',
				),
				array(
					'param_id' => 'bg_position',
					'id' => '_crocal_eutf_page_title_bg_position',
					'default' => 'center-center',
				),
				array(
					'param_id' => 'pattern_overlay',
					'id' => '_crocal_eutf_page_title_pattern_overlay',
					'default' => '',
				),
				array(
					'param_id' => 'color_overlay',
					'id' => '_crocal_eutf_page_title_color_overlay',
					'default' => 'dark',
				),
				array(
					'param_id' => 'color_overlay_custom',
					'id' => '_crocal_eutf_page_title_color_overlay_custom',
					'default' => '#000000',
				),
				array(
					'param_id' => 'opacity_overlay',
					'id' => '_crocal_eutf_page_title_opacity_overlay',
					'default' => '0',
				),
			);

			//Content Background Options
			$crocal_eutf_content_skin_options = array (
				array(
					'param_id' => 'skin',
					'id' => '_crocal_eutf_content_skin',
					'default' => '',
				),
				array(
					'param_id' => 'text_color',
					'id' => '_crocal_eutf_content_text_color',
					'default' => '#888888',
				),
				array(
					'param_id' => 'heading_color',
					'id' => '_crocal_eutf_content_heading_color',
					'default' => '#000000',
				),
				array(
					'param_id' => 'background-color',
					'id' => '_crocal_eutf_content_bg_color',
					'default' => '#ffffff',
				),
				array(
					'param_id' => 'background-repeat',
					'id' => '_crocal_eutf_content_bg_repeat',
					'default' => '',
				),
				array(
					'param_id' => 'background-size',
					'id' => '_crocal_eutf_content_bg_size',
					'default' => '',
				),
				array(
					'param_id' => 'background-attachment',
					'id' => '_crocal_eutf_content_bg_attachment',
					'default' => '',
				),
				array(
					'param_id' => 'background-position',
					'id' => '_crocal_eutf_content_bg_position',
					'default' => '',
				),
				array(
					'param_id' => 'background-image',
					'id' => '_crocal_eutf_content_bg_image',
					'default' => '',
				),
			);

			//Area Colors
			$crocal_eutf_area_colors = array (
				array(
					'param_id' => 'custom',
					'id' => '_crocal_eutf_area_colors_custom',
					'default' => '',
				),
				array(
					'param_id'    => 'bg_color',
					'id'          => '_crocal_eutf_area_bg_color',
					'default'     => '#eeeeee',
				),
				array(
					'param_id'    => 'headings_color',
					'id'          => '_crocal_eutf_area_headings_color',
					'default'     => '#000000',
				),
				array(
					'param_id'    => 'font_color',
					'id'          => '_crocal_eutf_area_font_color',
					'default'     => '#999999',
				),
				array(
					'param_id'    => 'link_color',
					'id'          => '_crocal_eutf_area_link_color',
					'default'     => '#FF7D88',
				),
				array(
					'param_id'    => 'hover_color',
					'id'          => '_crocal_eutf_area_hover_color',
					'default'     => '#000000',
				),
				array(
					'param_id'    => 'border_color',
					'id'          => '_crocal_eutf_area_border_color',
					'default'     => '#e0e0e0',
				),
				array(
					'param_id'    => 'button_color',
					'id'          =>'_crocal_eutf_area_button_color',
					'default'     => 'primary-1',
				),
				array(
					'param_id'    => 'button_hover_color',
					'id'          =>'_crocal_eutf_button_hover_color',
					'default'     => 'black',
				),
			);

			//Update Single custom fields
			foreach ( $crocal_eutf_page_options as $value ) {
				$allow_html = ( isset( $value['html'] ) ? $value['html'] : false );
				if( $allow_html ) {
					$new_meta_value = ( isset( $_POST[$value['id']] ) ? wp_filter_post_kses( $_POST[$value['id']] ) : '' );
				} else {
					$new_meta_value = ( isset( $_POST[$value['id']] ) ? sanitize_text_field( $_POST[$value['id']] ) : '' );
				}
				$meta_key = $value['id'];


				$meta_value = get_post_meta( $post_id, $meta_key, true );

				if ( '' != $new_meta_value  && '' == $meta_value ) {
					if ( !add_post_meta( $post_id, $meta_key, $new_meta_value, true ) ) {
						update_post_meta( $post_id, $meta_key, $new_meta_value );
					}
				} elseif ( '' != $new_meta_value && $new_meta_value != $meta_value ) {
					update_post_meta( $post_id, $meta_key, $new_meta_value );
				} elseif ( '' == $new_meta_value && '' != $meta_value ) {
					delete_post_meta( $post_id, $meta_key );
				}
			}

			//Update Menu Items Visibility array
			crocal_eutf_update_meta_array( $post_id, '_crocal_eutf_disable_menu_items', $crocal_eutf_disable_menu_items_options );
			//Update Title Options array
			crocal_eutf_update_meta_array( $post_id, '_crocal_eutf_custom_title_options', $crocal_eutf_page_title_options );
			//Update Content Background array
			crocal_eutf_update_meta_array( $post_id, '_crocal_eutf_content_skin_options', $crocal_eutf_content_skin_options );
			//Update Area Colors array
			crocal_eutf_update_meta_array( $post_id, '_crocal_eutf_area_colors', $crocal_eutf_area_colors );
		}
	}

}

/**
 * Function update meta array
 */
function crocal_eutf_update_meta_array( $post_id, $param_id, $param_array_options ) {

	$array_options = array();

	if( !empty( $param_array_options ) ) {

		foreach ( $param_array_options as $value ) {

			$meta_key = $value['param_id'];
			$meta_default = $value['default'];

			$allow_html = ( isset( $value['html'] ) ? $value['html'] : false );
			if( $allow_html ) {
				$new_meta_value = ( isset( $_POST[$value['id']] ) ? wp_filter_post_kses( $_POST[$value['id']] ) : $meta_default );
			} else {
				$new_meta_value = ( isset( $_POST[$value['id']] ) ? sanitize_text_field( $_POST[$value['id']] ) : $meta_default );
			}

			if( !empty( $new_meta_value ) ) {
				$array_options[$meta_key] = $new_meta_value;
			}
		}

	}

	if( !empty( $array_options ) ) {
		update_post_meta( $post_id, $param_id, $array_options );
	} else {
		delete_post_meta( $post_id, $param_id );
	}
}

/**
 * Function to check post type permissions
 */

function crocal_eutf_check_permissions( $post_id ) {

	if ( 'post' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_post', $post_id ) ) {
			return false;
		}
	} else {
		if ( !current_user_can( 'edit_page', $post_id ) ) {
			return false;
		}
	}
	return true;
}

/**
 * Function to print menu selector
 */
function crocal_eutf_print_menu_selection( $menu_id, $id, $name, $default = 'none' ) {

	?>
	<select id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>">
		<option value="" <?php selected( '', $menu_id ); ?>>
			<?php
				if ( 'none' == $default ){
					esc_html_e( 'None', 'crocal' );
				} else {
					esc_html_e( '-- Inherit --', 'crocal' );
				}
			?>
		</option>
	<?php
		$menus = wp_get_nav_menus();
		if ( ! empty( $menus ) ) {
			foreach ( $menus as $item ) {
	?>
				<option value="<?php echo esc_attr( $item->term_id ); ?>" <?php selected( $item->term_id, $menu_id ); ?>>
					<?php echo esc_html( $item->name ); ?>
				</option>
	<?php
			}
		}
	?>
	</select>
	<?php
}

/**
 * Function to print layout selector
 */
function crocal_eutf_print_layout_selection( $layout, $id, $name ) {

	$layouts = array(
		'' => esc_html__( '-- Inherit --', 'crocal' ),
		'none' => esc_html__( 'Full Width', 'crocal' ),
		'left' => esc_html__( 'Left Sidebar', 'crocal' ),
		'right' => esc_html__( 'Right Sidebar', 'crocal' ),
	);

	?>
	<select id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>">
	<?php
		foreach ( $layouts as $key => $value ) {
			if ( $value ) {
	?>
				<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $key, $layout ); ?>><?php echo esc_html( $value ); ?></option>
	<?php
			}
		}
	?>
	</select>
	<?php
}

/**
 * Function to print sidebar selector
 */
function crocal_eutf_print_sidebar_selection( $sidebar, $id, $name ) {
	global $wp_registered_sidebars;

	?>
	<select id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>">
		<option value="" <?php selected( '', $sidebar ); ?>><?php echo esc_html__( '-- Inherit --', 'crocal' ); ?></option>
	<?php
	foreach ( $wp_registered_sidebars as $key => $value ) {
		?>
		<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $key, $sidebar ); ?>><?php echo esc_html( $value['name'] ); ?></option>
		<?php
	}
	?>
	</select>
	<?php
}

/**
 * Function to print page selector
 */
function crocal_eutf_print_page_selection( $page_id, $id, $name ) {

?>
	<select id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>">
		<option value="" <?php selected( '', $page_id ); ?>>
			<?php esc_html_e( '-- Inherit --', 'crocal' ); ?>
		</option>
<?php
		$pages = get_pages();
		foreach ( $pages as $page ) {
?>
			<option value="<?php echo esc_attr( $page->ID ); ?>" <?php selected( $page->ID, $page_id ); ?>>
				<?php echo esc_html( $page->post_title ); ?>
			</option>
<?php
		}
?>
	</select>
<?php

}


/**
 * Function to print page selector
 */
function crocal_eutf_print_area_selection( $area_id, $id, $name ) {

?>
	<select id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>">
		<option value="" <?php selected( '', $area_id ); ?>>
			<?php esc_html_e( '-- Inherit --', 'crocal' ); ?>
		</option>
		<option value="none" <?php selected( 'none', $area_id ); ?>>
			<?php esc_html_e( '-- None --', 'crocal' ); ?>
		</option>
<?php
		$args = array( 'post_type' => 'area-item', 'numberposts' => -1 );
		$posts = get_posts( $args );
		if ( ! empty ( $posts ) ) {
			foreach ( $posts as $post ) {
?>
			<option value="<?php echo esc_attr( $post->ID ); ?>" <?php selected( $post->ID, $area_id ); ?>>
				<?php echo esc_html( $post->post_title ); ?>
			</option>
<?php
			}
		}
		wp_reset_postdata();
?>
	</select>
<?php

}

//Omit closing PHP tag to avoid accidental whitespace output errors.
