function portfolio_add_item_type(elem) {
	if (jQuery('select[id^="portfolio_item_type_"]').not('select[id="portfolio_item_type_%INDEX%"]').size() >= 4)
		return false;

	var index = jQuery('select[id^="portfolio_item_type_"]:last').attr('id').replace('portfolio_item_type_', '');
	index = parseInt(index) + 1;
	var $box = jQuery(elem).siblings('.portfolio-types');
	var template = jQuery('#add_portfolio_item_type_template').html();
	$box.append(template.replace(/%INDEX%/g, index));
	init_portfolio_settings();
	return false;
}

function fix_portfolio_remove_item_type_visible() {
	if (jQuery('div[id^="portfolio_item_remove_button_"]').not('div[id="portfolio_item_remove_button_%INDEX%_wrapper"]').size() > 1)
		jQuery('div[id^="portfolio_item_remove_button_"]').not('div[id="portfolio_item_remove_button_%INDEX%_wrapper"]').show();
	else
		jQuery('div[id^="portfolio_item_remove_button_"]').not('div[id="portfolio_item_remove_button_%INDEX%_wrapper"]').hide();
}

function portfolio_remove_item_type(elem) {
	var index = jQuery(elem).parent().attr('id').replace('portfolio_item_remove_button_', '').replace('_wrapper', '');
	jQuery('.portfolio_item_element_' + index).remove();
	fix_portfolio_remove_item_type_visible();
	return false;
}

function init_portfolio_page_settings() {
	jQuery('#page_portfolio_position').on('change', function() {
		var position = jQuery(this).val();
		var origin_layouts = jQuery('#page_portfolio_layout').data('layouts') || '';
		if (!origin_layouts) {
			origin_layouts = jQuery('#page_portfolio_layout').html();
			jQuery('#page_portfolio_layout').data('layouts', origin_layouts);
		}
		if (position == 'above' || position == 'below') {
			jQuery('#page_portfolio_style').attr('disabled', 'disabled');
			jQuery('#page_portfolio_pagination').attr('disabled', 'disabled');
			jQuery('#page_portfolio_items_per_page').attr('disabled', 'disabled');
			jQuery('#page_portfolio_layout option').each(function() {
				if (jQuery(this).attr('value') != '3x' && jQuery(this).attr('value') != '100%')
					jQuery(this).remove();
			});
			jQuery('#portfolio_slider_effects_enabled').show();
		} else {
			jQuery('#page_portfolio_style').removeAttr('disabled');
			jQuery('#page_portfolio_pagination').removeAttr('disabled');
			jQuery('#page_portfolio_items_per_page').removeAttr('disabled');
			jQuery('#page_portfolio_layout').html(origin_layouts);
			jQuery('#portfolio_slider_effects_enabled').hide();
		}
	});
	jQuery('#page_portfolio_position').trigger('change');
}

function init_portfolio_settings() {
	jQuery('select[id^=portfolio_item_type_]').unbind('change');
	jQuery('select[id^=portfolio_item_type_]').on('change', function() {
		var item_type = jQuery(this).val();
		var index = jQuery(this).attr('id').replace('portfolio_item_type_', '');
		if (index == '%INDEX%')
			return false;
		if (item_type == 'self-link' || item_type == 'full-image') {
			jQuery('#portfolio_item_link_' + index + '_wrapper').hide();
		} else {
			jQuery('#portfolio_item_link_' + index + '_wrapper').show();
		}
		if (item_type == 'full-image') {
			jQuery('#portfolio_item_link_target_' + index + '_wrapper').hide();
		} else {
			jQuery('#portfolio_item_link_target_' + index + '_wrapper').show();
		}
	});
	jQuery('select[id^=portfolio_item_type_]').trigger('change');
	fix_portfolio_remove_item_type_visible();
}

function init_post_item_settings() {
	jQuery('#post_item_media_type').unbind('change');
	jQuery('#post_item_media_type').on('change', function() {
		var item_type = jQuery(this).val();
		if (item_type == 'default') {
			jQuery('#post_item_link_wrapper').hide();
		} else {
			jQuery('#post_item_link_wrapper').show();
		}
	});
	jQuery('#post_item_media_type').trigger('change');
}

function init_gallery_page_settings() {
	jQuery('#page_gallery_type').on('change', function() {
		var gtype = jQuery(this).val();
		if (gtype == 'slider') {
			jQuery('#page_gallery_layout').attr('disabled', 'disabled');
			jQuery('#page_gallery_style').attr('disabled', 'disabled');
			jQuery('#page_gallery_item_style').attr('disabled', 'disabled');
		} else {
			jQuery('#page_gallery_layout').removeAttr('disabled');
			jQuery('#page_gallery_style').removeAttr('disabled');
			jQuery('#page_gallery_item_style').removeAttr('disabled');
		}
	});
	jQuery('#page_gallery_type').trigger('change');
}

function metro_max_row_height_callback() {
	var $max_height_box = jQuery('input[name="metro_max_row_height"]', this.$content);

	var $style_box = jQuery('select[name="portfolio_style"]', this.$content);
	if ($style_box.length == 0) {
		$style_box = jQuery('select[name="gallery_style"]', this.$content);
	}

	var $layout_box = jQuery('select[name="portfolio_layout"]', this.$content);
	if ($layout_box.length == 0) {
		$layout_box = jQuery('select[name="gallery_layout"]', this.$content);
	}

	if ($style_box.length == 0 || $max_height_box.length == 0 || $layout_box.length == 0) {
		return false;
	}

	var old_layout = $layout_box.val();

	function changeStyleEvent() {
		if ($style_box.val() != 'metro') {
			jQuery($max_height_box).closest('.vc_shortcode-param').addClass('vc_dependent-hidden');
			return false;
		}
		jQuery($max_height_box).closest('.vc_shortcode-param').removeClass('vc_dependent-hidden');
	}

	function changeLayoutEvent() {
		var layout = $layout_box.val();

		if (old_layout == layout) {
			return;
		}

		old_layout = layout;

		var defaults = {
			'2x': 380,
			'3x': 380,
			'4x': 280,
			'100%': 380
		};
		var default_value = 380;
		if (defaults[layout] != undefined && defaults[layout] != null) {
			default_value = defaults[layout];
		}
		$max_height_box.val(default_value);
	}

	$style_box.bind('change', changeStyleEvent).trigger('change');
	$layout_box.bind('change', changeLayoutEvent);
}

(function($){
	$(function() {
		$('input.color-select').each(function(){
			$('<span class="color-select-button"></span>')
				.insertAfter($(this))
				.css('backgroundColor', $(this).val());
		});
		$('input.color-select').ColorPicker({
			onSubmit: function(hsb, hex, rgb, el) {
				$(el).val('#' + hex);
				$(el).ColorPickerHide();
				$(el).change();
			},
			onBeforeShow: function () {
				$(this).ColorPickerSetColor(this.value);
			}
		});
		$('body').on('change', 'input.color-select', function(){
			$(this).next('.color-select-button').css('backgroundColor', $(this).val());
		});
		$('input.color-select + .color-select-button').click(function(){
			$(this).prev('input').ColorPickerShow();
		});
	});
})(jQuery);

(function($){
	$(function() {
		$('input.picture-select-id, input.picture-select, input.video-select, input.audio-select').each(function() {
			if ($(this).nextAll('.picture-select-button').size() == 0) {
				$('<button class="picture-select-button">Select</button>').insertAfter(this);
			}
		});
		var media_selector_frame;
		$('body').on('click', 'input.picture-select-id + button, input.picture-select + button, input.video-select + button, input.audio-select + button', function(event) {
				var $this = $(this);
				event.preventDefault();
				var mediaType = 'image';
				var mediaTypeTitle = 'Image';
				var $formfield = $(this).prev('input.picture-select-id, input.picture-select, input.video-select, input.audio-select');

				if($formfield.hasClass('video-select')) {
					var mediaType = 'video';
					var mediaTypeTitle = 'Video';
				}
				if($formfield.hasClass('audio-select')) {
					var mediaType = 'audio';
					var mediaTypeTitle = 'Audio';
				}

				// Create the media frame.
				media_selector_frame = wp.media.frames.mediaSelector = wp.media({
					// Set the title of the modal.
					title: 'Select '+mediaTypeTitle,
					button: {
						text: 'Insert '+mediaTypeTitle,
					},
					library: {
						type: mediaType
					}
				});
				// When an image is selected, run a callback.
				media_selector_frame.on( 'select', function() {
					var attachment = media_selector_frame.state().get('selection').first();
					attachment = attachment.toJSON();
					if(attachment.id) {
						if($formfield.hasClass('picture-select-id')) {
							$formfield.val(attachment.id).trigger('change');
						} else {
							$formfield.val(attachment.url).trigger('change');
						}
					}
				});
					// Finally, open the modal.
				media_selector_frame.open();
		});
	});
})(jQuery);

(function($){
	$(function() {
		$('#shortcode-generator').each(function() {
			var $scg = $(this);
			var $scgSelect = $('.shortcodes-select select', $scg);
			var $scgItems = $('.shortcode-item', $scg);
			var $scgInsert = $('.shortcode-insert-button button', $scg);
			var $scgResult = $('.shortcode-result textarea', $scg);

			$scgItems.each(function() {
				var $scgItem = $(this);
				$(':input', $scgItem).change(function() {
					var paramsSting = $.map($(':input', $scgItem).serializeArray(), function(a) {
						if(a.name != 'scg_content' && a.value != '') {
							return a.name.replace('scg_', '')+'="'+a.value+'"';
						}
						return null;
					}).join(' ');
					var shortcodeString = '['+$scgItem.data('name')+' '+paramsSting+']';
					if($scgItem.data('is_container') === 1) {
						if($('[name="scg_content"]:input', $scgItem).length ) {
							shortcodeString = shortcodeString + $('[name="scg_content"]:input', $scgItem).val();
						}
						shortcodeString = shortcodeString + '[/'+$scgItem.data('name')+']';
					}
					$scgResult.val(shortcodeString);
				});
			});

			$scgSelect.change(function() {
				$scgItems.hide();
				$scgInsert.parent().hide();
				$scgResult.parent().hide();
				if($('#' + $(this).val()).length) {
					$('#' + $(this).val()).show();
					$('#' + $(this).val() + ' :input').eq(0).trigger('change');
					$scgInsert.parent().show();
					$scgResult.parent().show();
				}
			}).trigger('change');

			$scgInsert.click(function(e) {
				e.preventDefault();
				if(tinymce.editors.content !== undefined && !$('textarea#content').is(':visible')) {
					var selectionText = tinymce.editors.content.selection.getContent();
					var replaceString = $scgResult.val();
					tinymce.editors.content.selection.setContent(replaceString);
				} else if($('textarea#content').length > 0) {
					var textareaText = $('textarea#content').val();
					var selectionStart = $('textarea#content').get(0).selectionStart;
					var selectionEnd = $('textarea#content').get(0).selectionEnd;
					var selectionText = textareaText.substr(selectionStart, selectionEnd-selectionStart);
					var replaceString = $scgResult.val();;
					$('textarea#content').val(textareaText.substr(0, selectionStart) + replaceString + textareaText.substr(selectionEnd));
				}
			});

		});
	});
})(jQuery);

(function($) {
	$(function() {
		$('#portfoliosets_icon_pack').change(function() {
			var $form = $(this).closest('form');
			$('.gem-icon-info', $form).hide();
			$('.gem-icon-info-' + $(this).val(), $form).show();
		}).trigger('change');
	});
})(jQuery);
