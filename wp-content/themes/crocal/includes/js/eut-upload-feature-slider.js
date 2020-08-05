jQuery(document).ready(function($) {

	"use strict";

	var eutFeatureSliderFrame;
	var eutFeatureSliderContainer = $( "#eut-feature-slider-container" );
	if ( eutFeatureSliderContainer.length ) {
		eutFeatureSliderContainer.sortable();
	}

	$(document).on("click",".eut-feature-slider-item-delete-button",function() {
		$(this).parent().remove();
	});

	$(document).on("click",".eut-upload-feature-slider-post-button",function() {

		var post_ids = $('#eut-upload-feature-slider-post-selection').val();
		if( '' != post_ids ) {
			var dataParams = {
				action:'crocal_eutf_get_admin_feature_slider_media',
				post_ids: post_ids.toString(),
				_eutf_nonce: crocal_eutf_upload_feature_slider_texts.nonce_feature_slider_media
			};
			$.post( crocal_eutf_upload_feature_slider_texts.ajaxurl, dataParams, function( mediaHtml ) {
				eutFeatureSliderContainer.append(mediaHtml);
				$(this).eutFeatureSliderUpdatefunctions();
			}).fail(function(xhr, status, error) {
				$('#eut-upload-feature-slider-button-spinner').hide();
			});
		}

	});

	$(document).on("click",".eut-upload-feature-slider-button",function() {

		if ( eutFeatureSliderFrame ) {
			eutFeatureSliderFrame.open();
			return;
		}

		eutFeatureSliderFrame = wp.media.frames.eutFeatureSliderFrame = wp.media({
			className: 'media-frame eut-media-feature-slider-frame',
			frame: 'select',
			multiple: 'toggle',
			title: crocal_eutf_upload_feature_slider_texts.modal_title,
			library: {
				type: 'image'
			},
			button: {
				text:  crocal_eutf_upload_feature_slider_texts.modal_button_title
			}

		});
		eutFeatureSliderFrame.on('select', function(){
			var selection = eutFeatureSliderFrame.state().get('selection');
			var ids = selection.pluck('id');

			$('#eut-upload-feature-slider-button-spinner').show();
			var dataParams = {
				action:'crocal_eutf_get_admin_feature_slider_media',
				attachment_ids: ids.toString(),
				_eutf_nonce: crocal_eutf_upload_feature_slider_texts.nonce_feature_slider_media
			};
			$.post( crocal_eutf_upload_feature_slider_texts.ajaxurl, dataParams, function( mediaHtml ) {
				eutFeatureSliderContainer.append(mediaHtml);
				$(this).eutFeatureSliderUpdatefunctions();
			}).fail(function(xhr, status, error) {
				$('#eut-upload-feature-slider-button-spinner').hide();
			});
		});
		eutFeatureSliderFrame.on('ready', function(){
			$( '.media-modal' ).addClass( 'eut-media-no-sidebar' );
		});


		eutFeatureSliderFrame.open();
	});

	$.fn.eutFeatureSliderUpdatefunctions = function(){
		$('.eut-slider-item.eut-item-new .wp-color-picker-field').wpColorPicker();
		$('.eut-slider-item.eut-item-new').removeClass('eut-item-new');
		$('#eut-upload-feature-slider-button-spinner').hide();
		$( "[data-dependency]" ).eutInitFieldsDependency();
	}

});