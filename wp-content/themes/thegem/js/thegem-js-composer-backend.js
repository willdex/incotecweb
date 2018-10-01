(function ($) {
	var Shortcodes = vc.shortcodes;
	var VcGemClass = vc.shortcode_view.extend({
		events:{
			'click > .vc_controls .column_delete': 'deleteShortcode',
			'click > .vc_controls .column_edit': 'editElement',
			'click > .vc_controls .column_clone': 'clone',
			'click > .vc_controls .column_prepend': 'prependElement',
			'click > .vc_controls .column_add': 'addElement',
			'click > .vc_empty-element': 'appendElement',
		}
	})

	window.VcGemAlertBoxView = VcGemClass.extend({});
	window.VcGemCounterBoxView = VcGemClass.extend({});
	window.VcGemFullwidthView = VcGemClass.extend({});
	window.VcGemCustomHeaderView = VcGemClass.extend({});
	window.VcGemIconWithTextView = VcGemClass.extend({});
	window.VcGemMapWithTextView = VcGemClass.extend({});
	window.VcGemPricingColumnView = VcGemClass.extend({});
	window.VcGemPricingTableView = VcGemClass.extend({});
	window.VcGemTextboxView = VcGemClass.extend({});
})(window.jQuery);
