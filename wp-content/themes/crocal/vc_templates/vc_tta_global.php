<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $content - shortcode content
 * @var $this WPBakeryShortCode_VC_Tta_Accordion|WPBakeryShortCode_VC_Tta_Tabs|WPBakeryShortCode_VC_Tta_Tour|WPBakeryShortCode_VC_Tta_Pageable
 */
$el_class = $css = $css_animation = '';
$links_gototop = 'no';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
$this->resetVariables( $atts, $content );
extract( $atts );

if ( 'vc_tta_tabs' == $this->shortcode || 'vc_tta_tour' == $this->shortcode ) {

	$this->setGlobalTtaInfo();
	$prepareContent = $this->getTemplateVariable( 'content' );
	$class_to_filter = '';
	$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
	$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );
	$active_section = $this->getActiveSection( $atts, false );
	$isPageEditable = vc_is_page_editable();

	$heading = crocal_eutf_array_value( $atts, 'heading', 'h3' );
	$heading_tag = crocal_eutf_array_value( $atts, 'heading_tag', 'h6' );
	$custom_font_family = crocal_eutf_array_value( $atts, 'custom_font_family' );
	$el_id = crocal_eutf_array_value( $atts, 'el_id' );

	$wrapper_attributes = array();
	if ( ! empty( $el_id ) ) {
		$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
	}
	if ( 'vc_tta_tabs' == $this->shortcode ) {
		$wrapper_attributes[] = 'class="eut-element eut-tab eut-horizontal-tab ' . esc_attr( $css_class ) . '"';
	} else {
		$wrapper_attributes[] = 'class="eut-element eut-tab eut-vertical-tab ' . esc_attr( $css_class ) . '" data-gototop="' . esc_attr( $links_gototop ) . '"';	
	}
	$wrapper_attributes[] = 'data-gototop="' . esc_attr( $links_gototop ) . '"';

	echo '<div ' . implode( ' ', $wrapper_attributes ) . '>';

	$title_classes = array( 'eut-title' );
	if ( !empty( $custom_font_family ) ) {
		$title_classes[] ='eut-' . $custom_font_family;
	}
	$title_classes[] ='eut-' . $heading;
	$title_class_string = implode( ' ', $title_classes );

	$tabs_title_classes = array( 'eut-tabs-title' );
	$tabs_title_classes[] = "eut-align-" . $alignment;
	if ( 'vc_tta_tour' == $this->shortcode ) {
		if( empty( $controls_size ) ) {
			$controls_size = "md";
		}
		$tabs_title_classes[] = "eut-width-" . $controls_size ;
		if( empty( $tab_position ) ) {
			$tab_position = "left";
		}
		$tabs_title_classes[] = "eut-position-" . $tab_position ;
	}
	$tabs_title_class_string = implode( ' ', $tabs_title_classes );

	//Tabs Top Title Wrapper
	echo '<div class="' . esc_attr( $tabs_title_class_string ) . '">';
	foreach ( WPBakeryShortCode_VC_Tta_Section::$section_info as $nth => $section ) {
		$classes = array( 'eut-tab-title', 'eut-tab-link' );
		if ( ( $nth + 1 ) === $active_section ) {
			$classes[] = 'active';
		}
		$icon_html = '';
		if ( 'true' === $section['add_icon'] ) {
			if ( 'left' === $section['i_position'] ) {
				$icon_html = '<span class="eut-tab-icon eut-position-left">';
				$icon_html .= $this->constructIcon( $section );
				$icon_html .= '</span>';
			} else {
				$icon_html = '<span class="eut-tab-icon eut-position-right">';
				$icon_html .= $this->constructIcon( $section );
				$icon_html .= '</span>';
			}
		}
		$title = '<' . tag_escape( $heading_tag ) .' class="' . esc_attr( $title_class_string ) . '">' . $icon_html . $section['title'] . '</' . tag_escape( $heading_tag ) .'>';
		echo '<div class="' . implode( ' ', $classes ) . '" data-rel="#' . $section['tab_id'] . '">' . $title . '</div>';
	}
	echo '</div>';


	//Tabs Wrapper
	echo '<div class="eut-tabs-wrapper">';

	foreach ( WPBakeryShortCode_VC_Tta_Section::$section_info as $nth => $section ) {

		$content_classes = array( 'eut-tab-content' );
		if ( ( $nth + 1 ) === $active_section ) {
			$content_classes[] = 'active';
		}
		if ( isset( $section['el_class'] ) ) {
			$content_classes[] = $section['el_class'];
		}
		$content_classes_string = implode( ' ', array_filter( $content_classes ) );

		echo '<div class="eut-tab-section">';

		$classes = array( 'eut-tab-title', 'eut-tab-link' );
		if ( ( $nth + 1 ) === $active_section ) {
			$classes[] = 'active';
		}
		$icon_html = '';
		if ( 'true' === $section['add_icon'] ) {
			if ( 'left' === $section['i_position'] ) {
				$icon_html = '<span class="eut-tab-icon eut-position-left">';
				$icon_html .= $this->constructIcon( $section );
				$icon_html .= '</span>';
			} else {
				$icon_html = '<span class="eut-tab-icon eut-position-right">';
				$icon_html .= $this->constructIcon( $section );
				$icon_html .= '</span>';
			}
		}
		$title = '<' . tag_escape( $heading_tag ) .' class="' . esc_attr( $title_class_string ) . '">' . $icon_html . $section['title'] . '</' . tag_escape( $heading_tag ) .'>';
		echo '<div class="' . implode( ' ', $classes ) . '" data-rel="#' . $section['tab_id'] . '">' . $title . '</div>';


		echo '<div class="' . esc_attr( $content_classes_string ) . '" id="' . esc_attr( $section['tab_id'] ) . '">';
		if ( $isPageEditable ) {
			echo '<div data-js-panel-body>';
		}
		echo do_shortcode( $section['content'] );
		if ( $isPageEditable ) {
			echo '</div>';
		}
		echo '</div>';

		echo '</div>'; // End Tab Section

	}

	echo '</div>';
	echo '</div>';

} elseif ( 'vc_tta_accordion' == $this->shortcode ) {

	$this->setGlobalTtaInfo();
	$prepareContent = $this->getTemplateVariable( 'content' );
	$class_to_filter = '';
	$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
	$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );
	$active_section = $this->getActiveSection( $atts, false );
	$heading = crocal_eutf_array_value( $atts, 'heading', 'h3' );
	$heading_tag = crocal_eutf_array_value( $atts, 'heading_tag', 'h6' );
	$custom_font_family = crocal_eutf_array_value( $atts, 'custom_font_family' );
	$el_id = crocal_eutf_array_value( $atts, 'el_id' );

	$title_classes = array( 'eut-title' );
	if ( !empty( $custom_font_family ) ) {
		$title_classes[] ='eut-' . $custom_font_family;
	}
	$title_classes[] ='eut-' . $heading;
	$title_class_string = implode( ' ', $title_classes );

	if ( isset( $atts['collapsible_all'] ) && 'true' === $atts['collapsible_all'] ) {
		$css_accordion_class = "eut-accordion-wrapper eut-action-toggle";
	} else {
		$css_accordion_class = "eut-accordion-wrapper eut-action-accordion";
	}

	if ( !isset( $atts['c_align'] ) || empty( $atts['c_align'] ) ) {
		$atts['c_align'] = "left";
	}

	$wrapper_attributes = array();
	$wrapper_attributes[] = 'class="eut-element eut-accordion ' . esc_attr( $css_class ) . '"';
	if ( ! empty( $el_id ) ) {
		$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
	}
	$wrapper_attributes[] = 'data-gototop="' . esc_attr( $links_gototop ) . '"';

	echo '<div ' . implode( ' ', $wrapper_attributes ) . '>';
	echo '<ul class="' . esc_attr( $css_accordion_class ) . '">';
	foreach ( WPBakeryShortCode_VC_Tta_Section::$section_info as $nth => $section ) {
		$classesTitle = array( 'eut-title-wrapper', 'eut-tab-link' );
		$classesTitle[] = "eut-align-" . $atts['c_align'];
		$classesContent = array( 'eut-accordion-content' );
		if ( ( $nth + 1 ) === $active_section ) {
			$classesTitle[] = 'active';
			$classesContent[] = 'active';
		}
		$title_wrapper = '';
		$title_wrapper .= '<div class="' . implode( ' ', $classesTitle ) . '" data-rel="#' . esc_attr( $section['tab_id'] ) . '">';
		if ( isset( $atts['c_icon'] ) && strlen( $atts['c_icon'] ) > 0 ) {

			if ( !isset( $atts['c_position'] ) || empty( $atts['c_position'] ) ) {
				$atts['c_position'] = "left";
			}

			if( 'triangle' == $atts['c_icon'] ) {
				$title_wrapper .= '<div class="eut-accordion-arrow eut-accordion-triangle eut-position-' . esc_attr( $atts['c_position'] ) . '"><i class="eut-icon-nav-right-small"></i></div>';
			} elseif( 'chevron' == $atts['c_icon'] ) {
				$title_wrapper .= '<div class="eut-accordion-arrow eut-accordion-chevron eut-position-' . esc_attr( $atts['c_position'] ) . '"><i class="eut-icon-nav-up"></i></div>';
			} else {
				$title_wrapper .= '<div class="eut-accordion-arrow eut-accordion-plus eut-position-' . esc_attr( $atts['c_position'] ) . '"><i class="eut-icon-plus"></i></div>';
			}
		}

		$icon_html = '';
		if ( 'true' === $section['add_icon'] ) {
			$iconClass = '';
			if ( isset( $section[ 'i_icon_' . $section['i_type'] ] ) ) {
				$iconClass = $section[ 'i_icon_' . $section['i_type'] ];
			}
			vc_icon_element_fonts_enqueue( $section['i_type'] );
			if ( 'left' === $section['i_position'] ) {
				$icon_html = '<span class="eut-accordion-icon eut-position-left">';
				$icon_html .= '<i class="' . esc_attr( $iconClass ) . '"></i>';
				$icon_html .= '</span>';
			} else {
				$icon_html = '<span class="eut-accordion-icon eut-position-right">';
				$icon_html .= '<i class="' . esc_attr( $iconClass ) . '"></i>';
				$icon_html .= '</span>';
			}
		}
		$title = '<' . tag_escape( $heading_tag ) .' class="' . esc_attr( $title_class_string ) . '">' . $icon_html . $section['title'] . '</' . tag_escape( $heading_tag ) .'>';
		$title_wrapper .= $title ;
		$title_wrapper .= '</div>';

		$content = '';
		$content .= '<div class="' . implode( ' ', $classesContent ) . '" id="' . esc_attr( $section['tab_id'] ) . '">';
		$content .= do_shortcode( $section['content'] );
		$content .= '</div>';

		$a_html = '';
		$a_html .= $title_wrapper;
		$a_html .= $content;
		echo '<li>' . $a_html . '</li>';

	}
	echo '</ul>';
	echo '</div>';

} else {

	$this->setGlobalTtaInfo();

	$this->enqueueTtaStyles();
	$this->enqueueTtaScript();

	// It is required to be before tabs-list-top/left/bottom/right for tabs/tours
	$prepareContent = $this->getTemplateVariable( 'content' );

	$class_to_filter = $this->getTtaGeneralClasses();
	$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation );
	$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

	echo '<div ' . $this->getWrapperAttributes() . '>' . $this->getTemplateVariable( 'title' );
	echo '<div class="' . esc_attr( $css_class ) . '">' . $this->getTemplateVariable( 'tabs-list-top' ) . $this->getTemplateVariable( 'tabs-list-left' );
	echo '<div class="vc_tta-panels-container">' . $this->getTemplateVariable( 'pagination-top' );
	echo '<div class="vc_tta-panels">' . $prepareContent . '</div>' . $this->getTemplateVariable( 'pagination-bottom' );
	echo '</div>' . $this->getTemplateVariable( 'tabs-list-bottom' ) . $this->getTemplateVariable( 'tabs-list-right' ) . '</div>';
	echo '</div>';

}
