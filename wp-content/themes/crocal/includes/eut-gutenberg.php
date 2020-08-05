<?php

/*
*	Gutenberg functions
*
* 	@version	1.0
* 	@author		Euthemians Team
* 	@URI		http://euthemians.com
*/
/**
 * Enqueue WordPress theme styles within Gutenberg.
 */
function crocal_eutf_gutenberg_styles() {
	 wp_enqueue_style( 'crocal-eutf-editor-customizer-styles', get_template_directory_uri() .  '/includes/css/eut-gutenberg-editor.css' , false, '1.0', 'all' );
	 wp_add_inline_style( 'crocal-eutf-editor-customizer-styles', crocal_eutf_custom_colors_css() );
}
add_action( 'enqueue_block_editor_assets', 'crocal_eutf_gutenberg_styles' );



function crocal_eutf_editor_custom_title_colors_css( $post ) {

	$post_id = $post->ID;
	$mode = $post->post_type;

	$image_url = '';
	$css = '';

	$crocal_eutf_page_title = array(
		'title_color' => crocal_eutf_option( $mode . '_title_color' ),
		'title_color_custom' => crocal_eutf_option( $mode . '_title_color_custom' ),
		'content_bg_color' => crocal_eutf_option( $mode . '_title_content_bg_color' ),
		'content_bg_color_custom' => crocal_eutf_option( $mode . '_title_content_bg_color_custom' ),
		'content_position' => crocal_eutf_option( $mode . '_title_content_position' ),
		'container_size' => crocal_eutf_option( $mode . '_title_container_size' ),
		'content_size' => crocal_eutf_option( $mode . '_title_content_size' ),
		'content_alignment' => crocal_eutf_option( $mode . '_title_content_alignment' ),
		'bg_mode' => crocal_eutf_option( $mode . '_title_bg_mode' ),
		'bg_image_id' => crocal_eutf_option( $mode . '_title_bg_image', '', 'id' ),
		'bg_position' => crocal_eutf_option( $mode . '_title_bg_position' ),
		'bg_color' => crocal_eutf_option( $mode . '_title_bg_color', 'dark' ),
		'bg_color_custom' => crocal_eutf_option( $mode . '_title_bg_color_custom' ),
	);

	$crocal_eutf_custom_title_options = get_post_meta( $post_id, '_crocal_eutf_custom_title_options', true );
	$crocal_eutf_title_style = crocal_eutf_option( $mode . '_title_style' );
	$crocal_eutf_page_title_custom = crocal_eutf_array_value( $crocal_eutf_custom_title_options, 'custom', $crocal_eutf_title_style );

	if ( 'simple' !== $crocal_eutf_page_title_custom ) {
		if ( 'custom' == $crocal_eutf_page_title_custom ) {
			$crocal_eutf_page_title = $crocal_eutf_custom_title_options;
		}

		$content_size = crocal_eutf_array_value( $crocal_eutf_page_title, 'content_size', 'large' );
		$title_width = crocal_eutf_array_value( crocal_eutf_get_post_width_array(), $content_size , '1170' );
		$title_align = crocal_eutf_array_value( $crocal_eutf_page_title, 'content_alignment', 'center' );

		$content_bg_color = crocal_eutf_array_value( $crocal_eutf_page_title, 'content_bg_color', 'custom' );
		if ( 'custom' == $content_bg_color ) {
			$content_bg_color = crocal_eutf_array_value( $crocal_eutf_page_title, 'content_bg_color_custom', 'F8F8FB' );
		} elseif ( 'none' == $content_bg_color   ) {
			$content_bg_color = 'none';
		} else {
			$content_bg_color = crocal_eutf_array_value( crocal_eutf_get_color_array(), $content_bg_color , '#ffffff' );
		}

		$title_bg_color = crocal_eutf_array_value( $crocal_eutf_page_title, 'bg_color', 'custom' );
		if ( 'custom' == $title_bg_color ) {
			$title_bg_color = crocal_eutf_array_value( $crocal_eutf_page_title, 'bg_color_custom', 'F8F8FB' );
		} elseif ( 'transparent' == $title_bg_color ) {
			$title_bg_color = 'transparent';
		} else {
			$title_bg_color = crocal_eutf_array_value( crocal_eutf_get_color_array(), $title_bg_color , '#F8F8FB' );
		}

		$title_color = crocal_eutf_array_value( $crocal_eutf_page_title, 'title_color', 'dark' );
		if ( 'custom' == $title_color ) {
			$title_color = crocal_eutf_array_value( $crocal_eutf_page_title, 'title_color_custom', '#000000' );
		} else {
			$title_color = crocal_eutf_array_value( crocal_eutf_get_color_array(), $title_color , '#000000' );
		}
		
		
		$bg_mode = crocal_eutf_array_value( $crocal_eutf_page_title, 'bg_mode', 'color' );
		if ( 'color' != $bg_mode ) {

			$bg_position = crocal_eutf_array_value( $crocal_eutf_page_title, 'bg_position', 'center-center' );

			$media_id = '0';

			if ( 'featured' == $bg_mode ) {
				if( has_post_thumbnail( $post_id ) ) {
					$media_id = get_post_thumbnail_id( $post_id );
				}
			} else if ( 'custom' ) {
				$media_id = crocal_eutf_array_value( $crocal_eutf_page_title, 'bg_image_id' );
			}
			$full_src = wp_get_attachment_image_src( $media_id, 'crocal-eutf-fullscreen' );
			$image_url = $full_src[0];
		}		

		
		$css .= "
			.editor-styles-wrapper  .wp-block.editor-post-title__block {
				max-width: " . esc_attr( $title_width ) . "px;
				margin-bottom: 0;
			}
			.editor-styles-wrapper .editor-post-title {
				padding-top: 60px;
				padding-bottom: 60px;
				background-color: " . esc_attr( $title_bg_color ) . ";
			}
			.editor-styles-wrapper .editor-post-title__block .editor-post-title__input {
				text-align: " . esc_attr( $title_align ) .";
				color: " . esc_attr( $title_color ) . ";
			}
		";
		
		if ( 'none' != $content_bg_color ) {
		$css .= "
			.editor-styles-wrapper  .wp-block.editor-post-title__block {
				background-color: " . esc_attr( $content_bg_color ) . ";
				vertical-align: middle;
				padding: 4% 5%;
				-webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
				-moz-box-shadow: 0 1px 2px rgba(0,0,0,0.2);
				box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
			}
		";
		}			
		if( !empty( $image_url ) ) {
		$css .= "
			.editor-styles-wrapper .editor-post-title {
				background-image: url(" . esc_url( $image_url ) . ");
				background-position: center center;
				background-size: cover;
				background-repeat: no-repeat;
			}
		";
		}		

		if ( 'post' == $post->post_type	) {
			$css .= "
				.editor-styles-wrapper .editor-post-title__block .editor-post-title__input {
					font-family: " . crocal_eutf_option( 'post_title', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
					font-weight: " . crocal_eutf_option( 'post_title', 'normal', 'font-weight'  ) . ";
					font-style: " . crocal_eutf_option( 'post_title', 'normal', 'font-style'  ) . ";
					font-size: " . crocal_eutf_option( 'post_title', '60px', 'font-size'  ) . ";
					text-transform: " . crocal_eutf_option( 'post_title', 'uppercase', 'text-transform'  ) . ";
					line-height: " . crocal_eutf_option( 'post_title', '112px', 'line-height'  ) . ";
					" . crocal_eutf_css_option( 'post_title', '0px', 'letter-spacing'  ) . "
				}
			";
		} else {
			$css .= "
				.editor-styles-wrapper .editor-post-title__block .editor-post-title__input {
					font-family: " . crocal_eutf_option( 'page_title', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
					font-weight: " . crocal_eutf_option( 'page_title', 'normal', 'font-weight'  ) . ";
					font-style: " . crocal_eutf_option( 'page_title', 'normal', 'font-style'  ) . ";
					font-size: " . crocal_eutf_option( 'page_title', '60px', 'font-size'  ) . ";
					text-transform: " . crocal_eutf_option( 'page_title', 'uppercase', 'text-transform'  ) . ";
					line-height: " . crocal_eutf_option( 'page_title', '60px', 'line-height'  ) . ";
					" . crocal_eutf_css_option( 'page_title', '0px', 'letter-spacing'  ) . "
				}
			";
		}
	} else {
		if ( 'post' == $post->post_type	) {
			$css .= "
				.editor-styles-wrapper .editor-post-title__block .editor-post-title__input {
					font-family: " . crocal_eutf_option( 'post_simple_title', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
					font-weight: " . crocal_eutf_option( 'post_simple_title', 'normal', 'font-weight'  ) . ";
					font-style: " . crocal_eutf_option( 'post_simple_title', 'normal', 'font-style'  ) . ";
					font-size: " . crocal_eutf_option( 'post_simple_title', '60px', 'font-size'  ) . ";
					text-transform: " . crocal_eutf_option( 'post_simple_title', 'uppercase', 'text-transform'  ) . ";
					line-height: " . crocal_eutf_option( 'post_simple_title', '112px', 'line-height'  ) . ";
					" . crocal_eutf_css_option( 'post_simple_title', '0px', 'letter-spacing'  ) . "
				}
			";
		}
	}




	return $css;

}

function crocal_eutf_custom_colors_css() {

	global $post, $pagenow;
	$css = "";

	$crocal_eutf_content_skin_options = array();
	$crocal_eutf_content_skin_options = crocal_eutf_post_meta( '_crocal_eutf_content_skin_options' );
	$crocal_eutf_content_skin = crocal_eutf_array_value( $crocal_eutf_content_skin_options, 'skin' );

	switch( $crocal_eutf_content_skin ) {
		case 'custom':
			$crocal_eutf_content_background = $crocal_eutf_content_skin_options;
			$crocal_eutf_widget_title_color = $crocal_eutf_content_heading_color = crocal_eutf_array_value( $crocal_eutf_content_skin_options, 'heading_color', '#000000' );
			$crocal_eutf_content_text_color = crocal_eutf_array_value( $crocal_eutf_content_skin_options, 'text_color', '#888888' );
			$crocal_eutf_content_heading_color = crocal_eutf_array_value( $crocal_eutf_content_skin_options, 'heading_color', '#000000' );
			$crocal_eutf_content_link_color = crocal_eutf_array_value( $crocal_eutf_content_skin_options, 'link_color', '#000000' );
			$crocal_eutf_content_link_hover_color = crocal_eutf_array_value( $crocal_eutf_content_skin_options, 'link_hover_color', '#01B5ED' );
		break;
		case 'light':
			$crocal_eutf_content_background = array( 'background-color' => '#ffffff' );
			$crocal_eutf_content_heading_color = "#000000";
			$crocal_eutf_widget_title_color = "#000000";
			$crocal_eutf_content_text_color = "#000000";
			$crocal_eutf_content_heading_color = "#000000";
			$crocal_eutf_content_link_color = "#000000";
			$crocal_eutf_content_link_hover_color = "#01B5ED";
		break;
		case 'dark':
			$crocal_eutf_content_background = array( 'background-color' => '#000000' );
			$crocal_eutf_content_heading_color = "#ffffff";
			$crocal_eutf_widget_title_color = "#ffffff";
			$crocal_eutf_content_text_color = "#ffffff";
			$crocal_eutf_content_heading_color = "#ffffff";
			$crocal_eutf_content_link_color = "#ffffff";
			$crocal_eutf_content_link_hover_color = "#01B5ED";
		break;
		default:
			$crocal_eutf_content_background = crocal_eutf_option( 'content_background', array( 'background-color' => '#ffffff' ) );
			$crocal_eutf_content_heading_color = crocal_eutf_option( 'body_heading_color' );
			$crocal_eutf_content_text_color = crocal_eutf_option( 'body_text_color' );
			$crocal_eutf_widget_title_color = crocal_eutf_option( 'widget_title_color' );
			$crocal_eutf_content_heading_color = crocal_eutf_option( 'body_heading_color' );
			$crocal_eutf_content_link_color = crocal_eutf_option( 'body_text_link_color' );
			$crocal_eutf_content_link_hover_color = crocal_eutf_option( 'body_text_link_hover_color' );
		break;
	}

	$css .= "
		.edit-post-visual-editor .editor-block-list__layout {
			" . crocal_eutf_get_background_css( $crocal_eutf_content_background ) . "
			padding-top: 40px;
			padding-bottom: 40px;
		}
		.edit-post-visual-editor .editor-block-list__block-edit,
		.edit-post-visual-editor {
			color: " . esc_attr( $crocal_eutf_content_text_color ) . ";
		}
	";

	/* Link Colors */

	$css .= "
	.editor-styles-wrapper a,
	.editor-styles-wrapper a code,
	.editor-styles-wrapper .wp-block-freeform.block-library-rich-text__tinymce a code {
		color: " . esc_attr( $crocal_eutf_content_link_color ) . ";

	}
	.editor-styles-wrapper a:hover,
	.editor-styles-wrapper a:hover code {
		color: " . esc_attr( $crocal_eutf_content_link_hover_color ) . ";
	}
	";

	/* Header Colors */
	$css .= "
	.editor-styles-wrapper h1,
	.editor-styles-wrapper h2,
	.editor-styles-wrapper h3,
	.editor-styles-wrapper h4,
	.editor-styles-wrapper h5,
	.editor-styles-wrapper h6 {
		color: " . esc_attr( $crocal_eutf_content_heading_color ) . ";
	}
	";

	if ( $pagenow == 'post-new.php' || $pagenow == 'post.php' ) {

		$post_id = $post->ID;
		$mode = $post->post_type;


		$css .= crocal_eutf_editor_custom_title_colors_css( $post );

		if ( 'post' == $post->post_type	) {
			$crocal_eutf_width = crocal_eutf_post_meta( '_crocal_eutf_post_content_width', crocal_eutf_option( 'post_content_width', 'small' ) );
			$content_width = crocal_eutf_array_value( crocal_eutf_get_post_width_array(), $crocal_eutf_width, crocal_eutf_option( 'container_size', 1170 ) );

			$css .= "
				.editor-styles-wrapper .wp-block {
					max-width: " . esc_attr( $content_width ) . "px;
				}
				.edit-post-visual-editor .editor-block-list__block-edit,
				.edit-post-visual-editor,
				.wp-block-freeform.block-library-rich-text__tinymce p {
					font-size: " . crocal_eutf_option( 'single_post_font', '18px', 'font-size'  ) . ";
					font-family: " . crocal_eutf_option( 'single_post_font', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
					font-weight: " . crocal_eutf_option( 'single_post_font', 'normal', 'font-weight'  ) . ";
					line-height: " . crocal_eutf_option( 'single_post_font', '36px', 'line-height'  ) . ";
					" . crocal_eutf_css_option( 'single_post_font', '0px', 'letter-spacing'  ) . "
				}
			";
		} else {
			$css .= "
			.editor-styles-wrapper .wp-block {
				max-width: " . crocal_eutf_option( 'container_size', 1170 ) . "px;
			}
			.edit-post-visual-editor .editor-block-list__block-edit,
			.edit-post-visual-editor {
				font-size: " . crocal_eutf_option( 'body_font', '14px', 'font-size'  ) . ";
				font-family: " . crocal_eutf_option( 'body_font', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
				font-weight: " . crocal_eutf_option( 'body_font', 'normal', 'font-weight'  ) . ";
				line-height: " . crocal_eutf_option( 'body_font', '36px', 'line-height'  ) . ";
				" . crocal_eutf_css_option( 'body_font', '0px', 'letter-spacing'  ) . "
			}
			";
		}
	}
	$css .= "

	.mce-content-body h1,
	.editor-styles-wrapper h1,
	.editor-styles-wrapper .eut-h1,
	.wp-block-freeform.block-library-rich-text__tinymce h1,
	.wp-block-heading h1.editor-rich-text__tinymce {
		font-family: " . crocal_eutf_option( 'h1_font', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
		font-weight: " . crocal_eutf_option( 'h1_font', 'normal', 'font-weight'  ) . ";
		font-style: " . crocal_eutf_option( 'h1_font', 'normal', 'font-style'  ) . ";
		text-transform: " . crocal_eutf_option( 'h1_font', ' none', 'text-transform'  ) . ";
		font-size: " . crocal_eutf_option( 'h1_font', '56px', 'font-size'  ) . ";
		line-height: " . crocal_eutf_option( 'h1_font', '60px', 'line-height'  ) . ";
		" . crocal_eutf_css_option( 'h1_font', '0px', 'letter-spacing'  ) . "
	}

	.editor-styles-wrapper h2,
	.editor-styles-wrapper .eut-h2,
	.wp-block-freeform.block-library-rich-text__tinymce h2,
	.wp-block-heading h2.editor-rich-text__tinymce {
		font-family: " . crocal_eutf_option( 'h2_font', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
		font-weight: " . crocal_eutf_option( 'h2_font', 'normal', 'font-weight'  ) . ";
		font-style: " . crocal_eutf_option( 'h2_font', 'normal', 'font-style'  ) . ";
		text-transform: " . crocal_eutf_option( 'h2_font', ' none', 'text-transform'  ) . ";
		font-size: " . crocal_eutf_option( 'h2_font', '36px', 'font-size'  ) . ";
		line-height: " . crocal_eutf_option( 'h2_font', '40px', 'line-height'  ) . ";
		" . crocal_eutf_css_option( 'h2_font', '0px', 'letter-spacing'  ) . "
	}

	.editor-styles-wrapper h3,
	.editor-styles-wrapper .eut-h3,
	.wp-block-freeform.block-library-rich-text__tinymce h3,
	.wp-block-heading h3.editor-rich-text__tinymce {
		font-family: " . crocal_eutf_option( 'h3_font', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
		font-weight: " . crocal_eutf_option( 'h3_font', 'normal', 'font-weight'  ) . ";
		font-style: " . crocal_eutf_option( 'h3_font', 'normal', 'font-style'  ) . ";
		text-transform: " . crocal_eutf_option( 'h3_font', ' none', 'text-transform'  ) . ";
		font-size: " . crocal_eutf_option( 'h3_font', '30px', 'font-size'  ) . ";
		line-height: " . crocal_eutf_option( 'h3_font', '33px', 'line-height'  ) . ";
		" . crocal_eutf_css_option( 'h3_font', '0px', 'letter-spacing'  ) . "
	}

	.editor-styles-wrapper h4,
	.editor-styles-wrapper .eut-h4,
	.wp-block-freeform.block-library-rich-text__tinymce h4,
	.wp-block-heading h4.editor-rich-text__tinymce {
		font-family: " . crocal_eutf_option( 'h4_font', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
		font-weight: " . crocal_eutf_option( 'h4_font', 'normal', 'font-weight'  ) . ";
		font-style: " . crocal_eutf_option( 'h4_font', 'normal', 'font-style'  ) . ";
		text-transform: " . crocal_eutf_option( 'h4_font', ' none', 'text-transform'  ) . ";
		font-size: " . crocal_eutf_option( 'h4_font', '23px', 'font-size'  ) . ";
		line-height: " . crocal_eutf_option( 'h4_font', '26px', 'line-height'  ) . ";
		" . crocal_eutf_css_option( 'h4_font', '0px', 'letter-spacing'  ) . "
	}

	.editor-styles-wrapper h5,
	.editor-styles-wrapper .eut-h5,
	.wp-block-freeform.block-library-rich-text__tinymce h5,
	.wp-block-heading h5.editor-rich-text__tinymce {
		font-family: " . crocal_eutf_option( 'h5_font', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
		font-weight: " . crocal_eutf_option( 'h5_font', 'normal', 'font-weight'  ) . ";
		font-style: " . crocal_eutf_option( 'h5_font', 'normal', 'font-style'  ) . ";
		text-transform: " . crocal_eutf_option( 'h5_font', ' none', 'text-transform'  ) . ";
		font-size: " . crocal_eutf_option( 'h5_font', '18px', 'font-size'  ) . ";
		line-height: " . crocal_eutf_option( 'h5_font', '20px', 'line-height'  ) . ";
		" . crocal_eutf_css_option( 'h5_font', '0px', 'letter-spacing'  ) . "
	}

	.editor-styles-wrapper h6,
	.editor-styles-wrapper .eut-h6,
	.wp-block-freeform.block-library-rich-text__tinymce h6,
	.wp-block-heading h6.editor-rich-text__tinymce {
		font-family: " . crocal_eutf_option( 'h6_font', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
		font-weight: " . crocal_eutf_option( 'h6_font', 'normal', 'font-weight'  ) . ";
		font-style: " . crocal_eutf_option( 'h6_font', 'normal', 'font-style'  ) . ";
		text-transform: " . crocal_eutf_option( 'h6_font', ' none', 'text-transform'  ) . ";
		font-size: " . crocal_eutf_option( 'h6_font', '16px', 'font-size'  ) . ";
		line-height: " . crocal_eutf_option( 'h6_font', '18px', 'line-height'  ) . ";
		" . crocal_eutf_css_option( 'h6_font', '0px', 'letter-spacing'  ) . "
	}

	.editor-styles-wrapper blockquote p,
	.editor-styles-wrapper blockquote,
	.wp-block-freeform.block-library-rich-text__tinymce blockquote,
	.wp-block-freeform.block-library-rich-text__tinymce blockquote p,
	.wp-block-quote cite,
	.wp-block-pullquote cite,
	.wp-block-quote footer,
	.wp-block-pullquote footer,
	.wp-block-quote__citation,
	.wp-block-pullquote__citation {
		font-family: " . crocal_eutf_option( 'quote_text', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
		font-weight: " . crocal_eutf_option( 'quote_text', 'normal', 'font-weight'  ) . ";
		font-style: " . crocal_eutf_option( 'quote_text', 'normal', 'font-style'  ) . ";
		font-size: " . crocal_eutf_option( 'quote_text', '34px', 'font-size'  ) . ";
		text-transform: " . crocal_eutf_option( 'quote_text', 'none', 'text-transform'  ) . ";
		line-height: " . crocal_eutf_option( 'quote_text', '36px', 'line-height'  ) . ";
		" . crocal_eutf_css_option( 'quote_text', '0px', 'letter-spacing'  ) . "
	}
	.editor-styles-wrapper blockquote:before {
		font-family: " . crocal_eutf_option( 'quote_text', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
		font-style: " . crocal_eutf_option( 'quote_text', 'normal', 'font-style'  ) . ";
	}

	blockquote p {
		border-color: " . crocal_eutf_option( 'body_primary_1_color' ) . ";
	}

	blockquote:before,
	blockquote > p:before	{
		color: " . crocal_eutf_option( 'body_primary_1_color' ) . ";
	}

	blockquote > p:before {
		color: " . crocal_eutf_option( 'body_primary_1_color' ) . ";
	}
	";

	$css .= "
	.editor-styles-wrapper table,
	.editor-styles-wrapper tr,
	.editor-styles-wrapper td,
	.editor-styles-wrapper th,
	.editor-styles-wrapper form,
	.editor-styles-wrapper form p,
	.editor-styles-wrapper label,
	.editor-styles-wrapper div,
	.editor-styles-wrapper hr {
		border-color: " . crocal_eutf_option( 'body_border_color' ) . " !important;
	}

	.editor-styles-wrapper hr.is-style-dots:before {
		color: " . crocal_eutf_option( 'body_border_color' ) . " !important;
	}

	";

	return $css;
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
