(function($) {
	$(function() {
		$('#fonts-manager-form .font-pane:not(.empty) .file_url input').fileSelector();
		$('#fonts-manager-form .add-new').click(function() {
			var $newPane = $('#fonts-manager-form .font-pane.empty').clone();
			$('.file_url input', $newPane).fileSelector();
			$newPane.removeClass('empty')
				.insertBefore(this)
				.animate({opacity: 'show'});
		});
		$('#fonts-manager-form').on('click', '.font-pane .remove a', function() {
			$(this).closest('.font-pane').animate({opacity: 'hide'}, function() {
				$(this).remove();
			});
		});
	});
})(jQuery);