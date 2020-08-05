<?php
/**
 * Google Map Shortcode
 */

if( !function_exists( 'crocal_ext_vce_gmap_shortcode' ) ) {

	function crocal_ext_vce_gmap_shortcode( $atts, $content ) {
		$output = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'map_lat' => '51.516221',
					'map_lng' => '-0.136986',
					'map_height' => '280',
					'map_marker' => '',
					'map_marker_type' => '',
					'map_marker_bg_color' => 'primary-1',
					'map_zoom' => '14',
					'map_disable_style' => 'no',
					'margin_bottom' => '',
					'el_class' => '',
					'map_mode' => '',
					'map_points' => '',
				),
				$atts
			)
		);

		wp_enqueue_script( 'crocal-eutf-maps-script');

		$gmap_classes = array( 'eut-element', 'eut-map' );

		if ( !empty ( $el_class ) ) {
			array_push( $gmap_classes, $el_class );
		}
		$gmap_class_string = implode( ' ', $gmap_classes );

		$style = crocal_ext_vce_build_margin_bottom_style( $margin_bottom );

		$map_marker_width = $map_marker_height = '';
		if ( empty( $map_marker_type ) ) {
			if ( empty( $map_marker ) ) {
				$map_marker = get_template_directory_uri() . '/images/markers/markers.png';
				$map_marker_width = '38';
				$map_marker_height = '60';
			} else {
				$id = preg_replace('/[^\d]/', '', $map_marker);
				$full_src = wp_get_attachment_image_src( $id, 'full' );
				$map_marker = $full_src[0];
				$map_marker_width = $full_src[1];
				$map_marker_height = $full_src[2];
			}
			$point_type = $map_marker_type = 'image';
			$point_bg_color = '';
		} else {
			$map_marker = get_template_directory_uri() . '/images/markers/transparent.png';
			$point_type = $map_marker_type;
			$point_bg_color = $map_marker_bg_color;
		}
		$map_marker = str_replace( array( 'http:', 'https:' ), '', $map_marker );

		$map_title = '';
		$values = (array) vc_param_group_parse_atts( $map_points );

		$data_map = 'data-lat="' . esc_attr( $map_lat ) . '" data-lng="' . esc_attr( $map_lng ) . '" data-zoom="' . esc_attr( $map_zoom ) . '" data-disable-style="' . esc_attr( $map_disable_style ) . '"';
		$output .= '<div class="eut-map-wrapper">';
		$output .= '  <div class="' . esc_attr( $gmap_class_string ) . '" ' . $data_map . ' style="' . $style . crocal_ext_vce_build_dimension( 'height', $map_height ) . '">';
		$output .= apply_filters( 'crocal_eutf_privacy_gmap_fallback', '', $map_lat, $map_lng );
		$output .= '</div>';
		if ( empty( $map_mode ) ) {
			$map_point_attributes = array();
			$map_point_attributes[] = 'data-point-lat="' . esc_attr( $map_lat ) . '"';
			$map_point_attributes[] = 'data-point-lng="' . esc_attr( $map_lng ) . '"';
			$map_point_attributes[] = 'data-point-title="' . esc_attr( $map_title ) . '"';
			$map_point_attributes[] = 'data-point-type="' . esc_attr( $point_type ) . '"';
			$map_point_attributes[] = 'data-point-marker-width="' . esc_attr( $map_marker_width ) . '"';
			$map_point_attributes[] = 'data-point-marker-height="' . esc_attr( $map_marker_height ) . '"';
			if( 'image' != $point_type ) {
				$map_point_attributes[] = 'data-point-bg-color="' . esc_attr( $point_bg_color ) . '"';
			}
			$output .= '  <div style="display:none" class="eut-map-point" data-point-marker="' . esc_attr( $map_marker ) . '" ' . implode( ' ', $map_point_attributes ) . '></div>';
		} else {
			if( !empty( $values ) ) {
				foreach ( $values as $k => $v ) {

					$point_lat = isset( $v['lat'] ) ? $v['lat'] : '51.516221';
					$point_lng = isset( $v['lng'] ) ? $v['lng'] : '-0.136986';
					$point_marker = isset( $v['marker'] ) ? $v['marker'] : '';
					$point_title = isset( $v['title'] ) ? $v['title'] : '';
					$point_infotext = isset( $v['infotext'] ) ? $v['infotext'] : '';
					$point_infotext_open = isset( $v['infotext_open'] ) ? $v['infotext_open'] : 'no';
					$point_link_text = isset( $v['link_text'] ) ? $v['link_text'] : '';
					$point_link = isset( $v['link'] ) ? $v['link'] : '';
					$point_link_class = isset( $v['link_class'] ) ? 'eut-infotext-link ' . $v['link_class'] : 'eut-infotext-link';

					if ( empty( $point_marker ) ) {
						$point_marker = $map_marker;
						$point_type = $map_marker_type;
						$point_bg_color = $map_marker_bg_color;
						$point_marker_width = $map_marker_width;
						$point_marker_height = $map_marker_height;
					} else {
						$id = preg_replace('/[^\d]/', '', $point_marker);
						$full_src = wp_get_attachment_image_src( $id, 'full' );
						$point_marker = $full_src[0];
						$point_marker_width = $full_src[1];
						$point_marker_height = $full_src[2];
						$point_type = 'image';
						$point_bg_color = '';
					}
					$point_marker = str_replace( array( 'http:', 'https:' ), '', $point_marker );

					$map_point_attributes = array();
					$map_point_attributes[] = 'data-point-lat="' . esc_attr( $point_lat ) . '"';
					$map_point_attributes[] = 'data-point-lng="' . esc_attr( $point_lng ) . '"';
					$map_point_attributes[] = 'data-point-title="' . esc_attr( $point_title ) . '"';
					$map_point_attributes[] = 'data-point-type="' . esc_attr( $point_type ) . '"';
					$map_point_attributes[] = 'data-point-open="' . esc_attr( $point_infotext_open ) . '"';
					$map_point_attributes[] = 'data-point-marker-width="' . esc_attr( $point_marker_width ) . '"';
					$map_point_attributes[] = 'data-point-marker-height="' . esc_attr( $point_marker_height ) . '"';
					if( 'image' != $point_type ) {
						$map_point_attributes[] = 'data-point-bg-color="' . esc_attr( $point_bg_color ) . '"';
					}

					$output .= '<div style="display:none" class="eut-map-point" data-point-marker="' . esc_attr( $point_marker ) . '" ' . implode( ' ', $map_point_attributes ) . '>';
					if ( !empty( $point_title ) || !empty( $point_infotext ) || !empty( $point_link_text ) ) {
						$output .= '<div class="eut-map-infotext">';
						if ( !empty( $point_title ) ) {
							$output .= '<h6 class="eut-infotext-title">' . esc_html( $point_title ) . '</h6>';
						}
						if ( !empty( $point_infotext ) ) {
							$output .= '<p class="eut-infotext-description">' . wp_kses_post( $point_infotext ) . '</p>';
						}
						if ( !empty( $point_link_text ) && crocal_ext_vce_has_link ( $point_link ) ) {
							$link_attributes = crocal_ext_vce_get_link_attributes( $point_link, $point_link_class );
							$output .= '<a ' . implode( ' ', $link_attributes ) . '>';
							$output .= esc_html( $point_link_text );
							$output .= '</a>';
						}
						$output .= '</div>';
					}
					$output .= '</div>';
				}
			}
		}
		$output .= '</div>';


		return $output;
	}
	add_shortcode( 'crocal_gmap', 'crocal_ext_vce_gmap_shortcode' );

}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'crocal_ext_vce_gmap_shortcode_params' ) ) {
	function crocal_ext_vce_gmap_shortcode_params( $tag ) {
		return array(
			"name" => esc_html__( "Google Map", "crocal-extension" ),
			"description" => esc_html__( "Freely place your Google Map", "crocal-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-eut-gmap",
			"category" => esc_html__( "Content", "js_composer" ),
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Map Zoom", "crocal-extension" ),
					"param_name" => "map_zoom",
					"value" => array( '1', '2', '3' ,'4', '5', '6', '7', '8' ,'9' ,'10' ,'11' ,'12', '13', '14', '15', '16', '17', '18', '19' ),
					"std" => '14',
					"description" => esc_html__( "Zoom of the map.", "crocal-extension" ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Map Height", "crocal-extension" ),
					"param_name" => "map_height",
					"value" => "280",
					"description" => esc_html__( "Type map height.", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Disable Custom Style", "crocal-extension" ),
					"param_name" => "map_disable_style",
					"value" => array(
						esc_html__( "No", "crocal-extension" ) => 'no',
						esc_html__( "Yes", "crocal-extension" ) => 'yes',
					),
					"description" => esc_html__( "Select if you want to disable custom map style.", "crocal-extension" ),
				),
				crocal_ext_vce_add_margin_bottom(),
				crocal_ext_vce_add_el_class(),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Map Mode", "crocal-extension" ),
					"param_name" => "map_mode",
					"value" => array(
						esc_html__( "Single Marker", "crocal-extension" ) => '',
						esc_html__( "Multiple Markers", "crocal-extension" ) => 'multiple',
					),
					"description" => esc_html__( "Select if you want to disable custom map style.", "crocal-extension" ),
					"group" => esc_html__( "Map Points", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Global Marker Type", "crocal-extension" ),
					"param_name" => "map_marker_type",
					"value" => array(
						esc_html__( "Image", "crocal-extension" ) => '',
						esc_html__( "Pulse Dot Icon", "crocal-extension" ) => 'pulse-dot',
						esc_html__( "Dot Icon", "crocal-extension" ) => 'dot',
					),
					"description" => esc_html__( "Select the type of your marker.", "crocal-extension" ),
					"group" => esc_html__( "Map Points", "crocal-extension" ),
				),
				array(
					"type" => "attach_image",
					"heading" => esc_html__( "Global Custom marker", "crocal-extension" ),
					"param_name" => "map_marker",
					"value" => '',
					"description" => esc_html__( "Select an icon for the custom marker.", "crocal-extension" ),
					"dependency" => array( 'element' => "map_marker_type", 'value' => array( '' ) ),
					"group" => esc_html__( "Map Points", "crocal-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Background Color", "crocal-extension" ),
					"param_name" => "map_marker_bg_color",
					"param_holder_class" => "eut-colored-dropdown",
					"value" => array(
						esc_html__( "Primary 1", "crocal-extension" ) => 'primary-1',
						esc_html__( "Primary 2", "crocal-extension" ) => 'primary-2',
						esc_html__( "Primary 3", "crocal-extension" ) => 'primary-3',
						esc_html__( "Primary 4", "crocal-extension" ) => 'primary-4',
						esc_html__( "Primary 5", "crocal-extension" ) => 'primary-5',
						esc_html__( "Primary 6", "crocal-extension" ) => 'primary-6',
						esc_html__( "Green", "crocal-extension" ) => 'green',
						esc_html__( "Orange", "crocal-extension" ) => 'orange',
						esc_html__( "Red", "crocal-extension" ) => 'red',
						esc_html__( "Blue", "crocal-extension" ) => 'blue',
						esc_html__( "Aqua", "crocal-extension" ) => 'aqua',
						esc_html__( "Purple", "crocal-extension" ) => 'purple',
						esc_html__( "Black", "crocal-extension" ) => 'black',
						esc_html__( "Grey", "crocal-extension" ) => 'grey',
						esc_html__( "White", "crocal-extension" ) => 'white',
					),
					"description" => esc_html__( "Background color of the marker.", "crocal-extension" ),
					'std' => 'primary-1',
					"dependency" => array( 'element' => "map_marker_type", 'value_not_equal_to' => array( '' ) ),
					"group" => esc_html__( "Map Points", "crocal-extension" ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Map Latitude", "crocal-extension" ),
					"param_name" => "map_lat",
					"value" => "51.516221",
					"description" => esc_html__( "Type map Latitude.", "crocal-extension" ),
					"dependency" => array( 'element' => "map_mode", 'value' => array( '' ) ),
					"group" => esc_html__( "Map Points", "crocal-extension" ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Map Longtitude", "crocal-extension" ),
					"param_name" => "map_lng",
					"value" => "-0.136986",
					"description" => esc_html__( "Type map Longtitude.", "crocal-extension" ),
					"dependency" => array( 'element' => "map_mode", 'value' => array( '' ) ),
					"group" => esc_html__( "Map Points", "crocal-extension" ),
				),
				array(
					'type' => 'param_group',
					'param_name' => 'map_points',
					'heading' => esc_html__( "Map Points", "crocal-extension" ),
					"description" => esc_html__( "Configure your map points.", "crocal-extension" ),
					'value' => urlencode( json_encode( array(
						array(
							'title' => 'Point 1',
							'lat' => '51.516221',
							'lng' => '-0.136986',
						),
					) ) ),
					'params' => array(
						array(
							"type" => "textfield",
							"heading" => esc_html__( "Title", "crocal-extension" ),
							"param_name" => "title",
							"value" => "",
							"description" => esc_html__( "Enter your point title.", "crocal-extension" ),
							"admin_label" => true,
						),
						array(
							"type" => "attach_image",
							"heading" => esc_html__( "Marker", "crocal-extension" ),
							"param_name" => "marker",
							"value" => '',
							"description" => esc_html__( "Select an icon for your point marker. Note: if empty global marker will be used instead.", "crocal-extension" ),
						),
						array(
							'type' => 'textfield',
							'value' => '51.516221',
							'heading' => 'Latitude',
							'param_name' => 'lat',
						),
						array(
							'type' => 'textfield',
							'value' => '-0.136986',
							'heading' => 'Longitude',
							'param_name' => 'lng',
						),
						array(
							"type" => "textarea",
							"heading" => esc_html__( "Info Text", "crocal-extension" ),
							"param_name" => "infotext",
							"value" => "",
							"description" => esc_html__( "Enter your info text.", "crocal-extension" ),
						),
						array(
							"type" => "dropdown",
							"heading" => esc_html__( "Open Info Text Onload", "crocal-extension" ),
							"param_name" => "infotext_open",
							"value" => array(
								esc_html__( "No", "crocal-extension" ) => 'no',
								esc_html__( "Yes", "crocal-extension" ) => 'yes',
							),
							"description" => esc_html__( "Select if you want to open info text on load.", "crocal-extension" ),
						),
						array(
							"type" => "textfield",
							"heading" => esc_html__( "Link Text", "crocal-extension" ),
							"param_name" => "link_text",
							"value" => "",
							"description" => esc_html__( "Enter your link text.", "crocal-extension" ),
						),
						array(
							"type" => "vc_link",
							"heading" => esc_html__( "Link", "crocal-extension" ),
							"param_name" => "link",
							"value" => "",
							"description" => esc_html__( "Enter your link.", "crocal-extension" ),
						),
						array(
							"type" => "textfield",
							"heading" => esc_html__( "Link Class", "crocal-extension" ),
							"param_name" => "link_class",
							"value" => "",
							"description" => esc_html__( "Enter your link class.", "crocal-extension" ),
						),
					),
					"dependency" => array( 'element' => "map_mode", 'value' => array( 'multiple' ) ),
					"group" => esc_html__( "Map Points", "crocal-extension" ),
				),
			),
		);
	}
}

if( function_exists( 'vc_lean_map' ) ) {
	vc_lean_map( 'crocal_gmap', 'crocal_ext_vce_gmap_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = crocal_ext_vce_gmap_shortcode_params( 'crocal_gmap' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
