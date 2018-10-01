function copyToClipboard(element) {
	var temp = jQuery("<input>");
	jQuery("body").append(temp);
	temp.val(jQuery(element).text()).select();
	document.execCommand("copy");
	temp.remove();
	var etext = jQuery(element).text();
	alert('Class ' +etext+' was copy in Clipboard. Use Ctrl + v for Paste');
}