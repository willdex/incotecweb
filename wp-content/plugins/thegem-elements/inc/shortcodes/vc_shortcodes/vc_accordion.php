<?php
wp_enqueue_script('jquery-ui-accordion');
$return_html = $title = $interval = $el_class = $collapsible = $active_tab = '';

extract(shortcode_atts(array(
    'title' => '',
    'interval' => 0,
    'el_class' => '',
    'collapsible' => 'no',
    'active_tab' => '1'
), $atts));

$return_html .= '<div class="wpb_accordion" data-collapsible='.$collapsible.' data-active-tab="'.$active_tab.'">'; //data-interval="'.$interval.'"
$return_html .= '<div class="wpb_wrapper wpb_accordion_wrapper ui-accordion">';
$return_html .= thegem_wpb_widget_title(array('title' => $title, 'extraclass' => 'wpb_accordion_heading'));

$return_html .= thegem_wpb_js_remove_wpautop($content);
$return_html .= '</div> ';
$return_html .= '</div> ';