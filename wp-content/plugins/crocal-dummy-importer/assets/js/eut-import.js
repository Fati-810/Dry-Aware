jQuery(document).ready(function($) {

	"use strict";

	$('.eut-import-clear-selection').on('click',function(e) {
		e.preventDefault();
		$(this).closest( ".eut-importer-content" ).find('.eut-single-selector option:selected').prop("selected", false);
	});

	$('.eut-import-dummy-data').on('click',function(e) {
		e.preventDefault();
		var confirmText = eut_import_texts.confirmation_text;
		var dummySingularElement = $(this).closest( ".eut-admin-dummy-item" ).find('.eut-admin-dummy-option-singular');
		if( dummySingularElement.length ) {
			confirmText = eut_import_texts.confirmation_text_singular;
		}
		var eutConfirm = confirm( confirmText );
		if ( eutConfirm == true ) {

			$('#eut-import-output-info').hide().html('');
			$('#eut-import-output-container').hide().html('');

			$('.eut-import-dummy-data').attr('disabled','disabled').addClass('disabled');
			$('.eut-admin-dummy-item').hide();
			$('#eut-import-loading').show();
			$('#eut-import-countdown').show();

			//Show Loader
			$('#eut-importer-loader').show();

			var startTime = new Date();
			$('#eut-import-countdown').countdown('destroy');
			$('#eut-import-countdown').countdown({since: startTime, format: 'MS'});

			var dummyID = $(this).data('dummy-id');

			var dummySinglePages = false,
				dummyContent  = false,
				dummyOptions  = false,
				dummyWidgets  = false,
				dummySingular  = false,
				dummyDemoImages = false,
				dummySinglePages = '',
				dummySinglePosts = '',
				dummySinglePortfolios = '',
				dummySingleAreas = '',
				dummySingleProducts = '';

			var dummyNonce = $(this).closest( ".eut-admin-dummy-item" ).find('.eut-admin-dummy-option-dummy-nonce').val();

			if( dummySingularElement.length ) {
				dummySingular = $(this).closest( ".eut-admin-dummy-item" ).find('.eut-admin-dummy-option-singular').val();
				dummySinglePages = $(this).closest( ".eut-admin-dummy-item" ).find('.eut-admin-dummy-option-single-pages').val();
				dummySinglePosts = $(this).closest( ".eut-admin-dummy-item" ).find('.eut-admin-dummy-option-single-posts').val();
				dummySinglePortfolios = $(this).closest( ".eut-admin-dummy-item" ).find('.eut-admin-dummy-option-single-portfolios').val();
				dummySingleProducts = $(this).closest( ".eut-admin-dummy-item" ).find('.eut-admin-dummy-option-single-products').val();
				dummySingleAreas = $(this).closest( ".eut-admin-dummy-item" ).find('.eut-admin-dummy-option-single-areas').val();
				dummyDemoImages = $(this).closest( ".eut-admin-dummy-item" ).find('.eut-admin-dummy-option-single-demo-images').is(':checked');
			} else {
				dummyContent = $(this).closest( ".eut-admin-dummy-item" ).find('.eut-admin-dummy-option-dummy-content').is(':checked');
				dummyOptions = $(this).closest( ".eut-admin-dummy-item" ).find('.eut-admin-dummy-option-theme-options').is(':checked');
				dummyWidgets = $(this).closest( ".eut-admin-dummy-item" ).find('.eut-admin-dummy-option-widgets').is(':checked');
				if( $(this).closest( ".eut-admin-dummy-item" ).find('.eut-admin-dummy-option-full-demo-images').length ) {
					dummyDemoImages = $(this).closest( ".eut-admin-dummy-item" ).find('.eut-admin-dummy-option-full-demo-images').is(':checked');
				}
			}



			var importParams = {
				action:'crocal_import_demo_data',
				eut_import_data: dummyID,
				eut_import_content: dummyContent,
				eut_import_options: dummyOptions,
				eut_import_widgets: dummyWidgets,
				eut_import_single_pages: dummySinglePages,
				eut_import_single_posts: dummySinglePosts,
				eut_import_single_portfolios: dummySinglePortfolios,
				eut_import_single_products: dummySingleProducts,
				eut_import_single_areas: dummySingleAreas,
				eut_import_singular: dummySingular,
				eut_import_demo_images: dummyDemoImages,
				nonce: dummyNonce
			};

			var splitEnabled = parseInt(eut_import_texts.split_enabled);

			if( dummyDemoImages && 1 == splitEnabled ) {
				$.fn.eutPartialAttachmentImport( importParams, 0 );
			} else {
				$.fn.eutImportData( importParams );
			}
		}

	});

	$.fn.eutImportData = function( importParams ){

		var debug = parseInt(eut_import_texts.debug_enabled);
		var errorText = '<b>' + eut_import_texts.error_text + '</b> ';

		$.post(
			ajaxurl,
			importParams,
			function( response ) {
				$('#eut-import-countdown').countdown('pause');
				$('#eut-import-loading').hide();
				if ( '-1' != response ) {
					if(response.changed){
						if(!response.errors){
							$('#eut-import-output-info').show().append(response.info);
							if ( 1 != debug ) {
								setTimeout(function () {
									$( "#eut-import-finish-form" ).submit();
								},3000);
							} else {
								$('#eut-import-output-container').show().append(response.output);
							}
						} else {
							$('#eut-import-output-info').show().append(response.info);
							$('#eut-import-output-container').show().append(response.output);
							$('.eut-import-dummy-data').removeAttr('disabled').removeClass('disabled');
						}
					} else {
						$('#eut-import-countdown').hide();
						$('#eut-import-output-info').show().append(response.info);
						$('.eut-admin-dummy-item').show();
						$('.eut-import-dummy-data').removeAttr('disabled').removeClass('disabled');
					}
				}
			}
		).fail(function(xhr, status, error) {
			$('#eut-import-countdown').countdown('pause');
			$('#eut-import-loading').hide();
			$('#eut-import-output-info').show().append(errorText);
			$('#eut-import-output-info').show().append(error);
		});

	}

	$.fn.eutPartialAttachmentImport = function( importParams, index ){

		var errorText = '<b>' + eut_import_texts.error_text + '</b> ';
		var importAttachParams = {};
		var defaultParams = {
			action:'crocal_import_attachments',
			eut_import_attachments: true,
			eut_import_index: index
		};

		$.extend( importAttachParams, importParams, defaultParams );

		$.post(
			ajaxurl,
			importAttachParams,
			function( response ) {
				if ( '-1' != response ) {
					if(response.changed){
						if(!response.errors){
							$('#eut-import-output-info').show().html(response.info);
							if( !response.finished ){
								$.fn.eutPartialAttachmentImport( importParams, response.index );
							} else {
								$.fn.eutImportData( importParams );
							}
						} else {
							$('#eut-import-countdown').countdown('pause');
							$('#eut-import-loading').hide();
							$('#eut-import-output-info').show().append(response.info);
							$('#eut-import-output-container').show().append(response.output);
							$('.eut-import-dummy-data').removeAttr('disabled').removeClass('disabled');
						}
					} else {
						$('#eut-import-countdown').countdown('pause');
						$('#eut-import-countdown').hide();
						$('#eut-import-loading').hide();
						$('#eut-import-output-container').show().append(response.output);
						$('#eut-import-output-info').show().append(response.info);
					}
				}
			}
		).fail(function(xhr, status, error) {
			$('#eut-import-countdown').countdown('pause');
			$('#eut-import-loading').hide();
			$('#eut-import-output-info').show().append(errorText);
			$('#eut-import-output-info').show().append(error);
		});

	}

});