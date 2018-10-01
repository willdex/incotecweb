<?php
$return_html = $title = $interval = $el_class = '';
extract( shortcode_atts( array(
	'title' => '',
	'interval' => 0,
	'el_class' => '',
	'style' => ''
), $atts ) );

wp_enqueue_script( 'jquery-ui-tabs' );


$element = 'gem-tabs';
if ( 'vc_tour' == $shortcode ) $element = 'gem-tour';

// Extract tab titles
preg_match_all( '/vc_tab([^\]]+)/i', $content, $matches, PREG_OFFSET_CAPTURE );
$tab_titles = array();
/**
 * vc_tabs
 *
 */
if ( isset( $matches[1] ) ) {
	$tab_titles = $matches[1];
}
$tabs_nav = '';
$tabs_nav .= '<ul class="wpb_tabs_nav ui-tabs-nav clearfix resp-tabs-list">';
foreach ( $tab_titles as $tab ) {
	$tab_atts = shortcode_parse_atts($tab[0]);
	if(isset($tab_atts['title'])) {
		$tabs_nav .= '<li><a href="#tab-' . ( isset( $tab_atts['tab_id'] ) ? $tab_atts['tab_id'] : sanitize_title( $tab_atts['title'] ) ) . '">' . $tab_atts['title'] . '</a></li>';
	}
}
$tabs_nav .= '</ul>' . "\n";

$return_html .= "\n\t" . '<div class="' . $element . '" data-interval="' . $interval . '">';
$return_html .= "\n\t\t" . '<div class="wpb_wrapper wpb_tour_tabs_wrapper ui-tabs clearfix">';
$return_html .= thegem_wpb_widget_title( array( 'title' => $title, 'extraclass' => $element . '_heading' ) );
$return_html .= "\n\t\t\t" . $tabs_nav;
$return_html .= "\n\t\t\t" . '<div class="resp-tabs-container">' . thegem_wpb_js_remove_wpautop( $content ) . '</div>';
if ( 'vc_tour' == $shortcode ) {
	$return_html .= "\n\t\t\t" . '<div class="wpb_tour_next_prev_nav clearfix"> <span class="wpb_prev_slide"><a href="#prev" title="' . __( 'Previous slide', 'thegem' ) . '">' . __( 'Previous slide', 'thegem' ) . '</a></span> <span class="wpb_next_slide"><a href="#next" title="' . __( 'Next slide', 'thegem' ) . '">' . __( 'Next slide', 'thegem' ) . '</a></span></div>';
}
$return_html .= "\n\t\t" . '</div> ';
$return_html .= "\n\t" . '</div> ';