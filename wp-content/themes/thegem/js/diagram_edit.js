jQuery(document).ready(function() {
	thegem_init_diagram_edit();
});

function thegem_init_diagram_edit() {
	jQuery('.diagram-edit-skills').each(function() {
		jQuery(this).data('skills-count', jQuery(this).find('fieldset').size());
	});
	jQuery('a.diagram-edit-add-skill').unbind('click');
	jQuery('a.diagram-edit-add-skill').click(function() {
		var index = parseInt(jQuery(this).parents('.diagram-edit-skills:first').data('skills-count')) + 1;
		var code = jQuery(this).parents('form:first').find('.diagram-edit-skill-template').html();
		code = code.replace(/%INDEX%/g, index);
		jQuery(this).parent().before(code);
		jQuery(this).parents('.diagram-edit-skills:first').data('skills-count', index);
		thegem_init_diagram_skills();
		return false;
	});
	thegem_init_diagram_skills();
}

function thegem_init_diagram_skills() {
	jQuery('.diagram-edit-skills fieldset').each(function() {
		jQuery(this).find('a.diagram-delete-skill').unbind('click');
		jQuery(this).find('a.diagram-delete-skill').click(function() {
			jQuery(this).parent().parent().remove();
			return false;
		});

		jQuery(this).find('input.color-select').each(function(){
			jQuery(this).siblings('.cs_button').remove();
			jQuery('<span class="cs_button" style="margin: 0; float: right;"></span>')
				.insertAfter(jQuery(this))
				.css('backgroundColor', jQuery(this).val());
			jQuery(this).width('70%');
		});

		jQuery(this).find('input.color-select').ColorPicker({
			onSubmit: function(hsb, hex, rgb, el) {
				jQuery(el).val('#' + hex);
				jQuery(el).ColorPickerHide();
				jQuery(el).change();
			},
			onBeforeShow: function () {
				jQuery(this).ColorPickerSetColor(this.value);
			}
		});

		jQuery(this).find('input.color-select').unbind('change');
		jQuery(this).find('input.color-select').bind('change', function(){
			jQuery(this).next('.cs_button').css('backgroundColor', jQuery(this).val());
		});

		jQuery(this).find('input.color-select + .cs_button').unbind('click');
		jQuery(this).find('input.color-select + .cs_button').click(function(){
			jQuery(this).prev('input').ColorPickerShow();
		});
	});
}
