<?php
$return_html = $title = '';

extract(shortcode_atts(array(
	'title' => __("Section", "thegem")
), $atts));

$return_html .= '<div class="wpb_accordion_section group">';
$return_html .= '<div class="wpb_accordion_header ui-accordion-header"><a href="#'.sanitize_title($title).'">'.$title.'</a></div>';
$return_html .= '<div class="wpb_accordion_content ui-accordion-content vc_clearfix">';
$return_html .= ($content=='' || $content==' ') ? __("Empty section. Edit page to add content here.", "thegem") : thegem_wpb_js_remove_wpautop($content);
$return_html .= '</div>';
$return_html .= '</div>';