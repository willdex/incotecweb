(function ($) {
	var Shortcodes = vc.shortcodes;
	var VcGemClass = vc.shortcode_view.extend({
		events:{
			'click > .vc_controls .column_delete': 'destroy',
			'click > .vc_controls .column_edit': 'edit',
			'click > .vc_controls .column_clone': 'clone',
			'click > .vc_controls .column_prepend': 'prependElement',
			'click > .vc_controls .column_append': 'appendElement',
			'click > .vc_empty-element': 'appendElement',
		}
	})

	$(function() {
		if(!vc.app) return;
		vc.app.setSortable = function() {
			var that = this;
			$('.wpb_main_sortable').sortable({
				forcePlaceholderSize:true,
				placeholder:"widgets-placeholder",
				cursor:"move",
				items:"> .wpb_vc_row", // wpb_sortablee
				handle:'.column_move',
				distance:0.5,
				start:this.sortingStarted,
				stop:this.sortingStopped,
				update:this.updateRowsSorting,
				over:function (event, ui) {
					ui.placeholder.css({maxWidth:ui.placeholder.parent().width()});
				}
			});
			$('.wpb_column_container').sortable({
				forcePlaceholderSize: true,
				forceHelperSize: false,
				connectWith:".wpb_column_container",
				placeholder:"vc_placeholder",
				items:"> div.wpb_sortable", //wpb_sortablee
				helper: this.renderPlaceholder,
				distance: 3,
				scroll: true,
				scrollSensitivity: 70,
				cursor: 'move',
				cursorAt: {top: 20, left: 16},
				tolerance:'pointer',
				start:function () {
					$('#visual_composer_content').addClass('vc_sorting-started');
					$('.vc_not_inner_content').addClass('dragging_in');
				},
				stop:function (event, ui) {
					$('#visual_composer_content').removeClass('vc_sorting-started');
					$('.dragging_in').removeClass('dragging_in');
					var tag = ui.item.data('element_type'),
						parent_tag = ui.item.parent().closest('[data-element_type]').data('element_type'),
						allowed_container_element = !_.isUndefined(vc.map[parent_tag].allowed_container_element) ? vc.map[parent_tag].allowed_container_element : true;
					if (!vc.check_relevance(parent_tag, tag)) {
						$(this).sortable('cancel');
					}
					if (vc.map[ui.item.data('element_type')].is_container && !(allowed_container_element === true || allowed_container_element === ui.item.data('element_type').replace(/_inner$/, ''))) {
						$(this).sortable('cancel');
					}
					$('.vc_sorting-empty-container').removeClass('vc_sorting-empty-container');
				},
				update:this.updateElementsSorting,
				over:function (event, ui) {
					var tag = ui.item.data('element_type'),
						parent_tag = ui.placeholder.closest('[data-element_type]').data('element_type'),
						allowed_container_element = !_.isUndefined(vc.map[parent_tag].allowed_container_element) ? vc.map[parent_tag].allowed_container_element : true;
					if (!vc.check_relevance(parent_tag, tag)) {
						ui.placeholder.addClass('vc_hidden-placeholder');
						return false;
					}
					if (vc.map[ui.item.data('element_type')].is_container && !(allowed_container_element === true || allowed_container_element === ui.item.data('element_type').replace(/_inner$/, ''))) {
						ui.placeholder.addClass('vc_hidden-placeholder');
						return false;
					}
					if(ui.sender && ui.sender.length && !ui.sender.find('[data-element_type]:visible').length) {
						ui.sender.addClass('vc_sorting-empty-container');
					}
					ui.placeholder.removeClass('vc_hidden-placeholder');
					ui.placeholder.css({maxWidth:ui.placeholder.parent().width()});
				}
			});
			return this;
		}
	});

})(window.jQuery);
