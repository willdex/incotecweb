<?php
$return_html = $title = $tab_id = '';
extract(shortcode_atts(array(
		'tab_id' => __( "Tab", "thegem" ),
		'title' => ''
), $atts));

wp_enqueue_script('jquery_ui_tabs_rotate');
$return_html .= "\n\t\t\t" . '<div id="tab-'. (empty($tab_id) ? sanitize_title( $title ) : $tab_id) .'wpb_tab ui-tabs-panel wpb_ui-tabs-hide vc_clearfix">';
$return_html .= ($content=='' || $content==' ') ? __("Empty section. Edit page to add content here.", "js_composer") : "\n\t\t\t\t" . thegem_wpb_js_remove_wpautop($content);
$return_html .= "\n\t\t\t" . '</div> ';