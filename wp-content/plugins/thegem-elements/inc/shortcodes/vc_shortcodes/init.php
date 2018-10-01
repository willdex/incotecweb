<?php

add_shortcode('vc_column', '__return_false');
add_shortcode('vc_column_inner', '__return_false');
add_shortcode('vc_row', '__return_false');
add_shortcode('vc_row_inner', '__return_false');
add_shortcode('vc_accordion', '__return_false');
add_shortcode('vc_accordion_tab', '__return_false');
add_shortcode('vc_tabs', '__return_false');
add_shortcode('vc_tour', '__return_false');
add_shortcode('vc_tab', '__return_false');
add_shortcode('vc_gmaps', '__return_false');

add_filter('the_content', 'thegem_vc_run_shortcode', 7);
add_filter('widget_text', 'thegem_vc_run_shortcode', 7);
add_filter('the_excerpt', 'thegem_vc_run_shortcode', 7);

function thegem_vc_run_shortcode($content) {
	global $shortcode_tags;
	$orig_shortcode_tags = $shortcode_tags;
	remove_all_shortcodes();

	add_shortcode('vc_column', 'thegem_vc_column_shortcode');
	add_shortcode('vc_column_inner', 'thegem_vc_column_shortcode');
	add_shortcode('vc_row', 'thegem_vc_row_shortcode');
	add_shortcode('vc_row_inner', 'thegem_vc_row_shortcode');
	add_shortcode('vc_accordion', 'thegem_vc_accordion_shortcode');
	add_shortcode('vc_accordion_tab', 'thegem_vc_accordion_tab_shortcode');
	add_shortcode('vc_tabs', 'thegem_vc_tabs_shortcode');
	add_shortcode('vc_tour', 'thegem_vc_tour_shortcode');
	add_shortcode('vc_tab', 'thegem_vc_tab_shortcode');
	add_shortcode('vc_gmaps', 'thegem_vc_gmaps_shortcode');

	$content = do_shortcode($content);
	$shortcode_tags = $orig_shortcode_tags;
	return $content;
}

function thegem_shortcodes_array_add_vc($shortcodes) {
	$shortcodes['vc_column'] = array(
		'name' => __( 'Row', 'js_composer' ),
		'base' => 'vc_row',
		'is_container' => true,
		'icon' => 'icon-wpb-row',
		'show_settings_on_create' => false,
		'category' => __( 'Content', 'js_composer' ),
		'description' => __( 'Place content elements inside the row', 'js_composer' ),
		'params' => array(
			array(
				'type' => 'colorpicker',
				'heading' => __( 'Font Color', 'js_composer' ),
				'param_name' => 'font_color',
				'description' => __( 'Select font color', 'js_composer' ),
				'edit_field_class' => 'vc_col-md-6 vc_column'
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Extra class name', 'js_composer' ),
				'param_name' => 'el_class',
				'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
			),
			array(
				'type' => 'css_editor',
				'heading' => __( 'Css', 'js_composer' ),
				'param_name' => 'css',
				// 'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
				'group' => __( 'Design options', 'js_composer' )
			)
		),
	);
	$shortcodes['vc_column_inner'] = $shortcodes['vc_column'];
	$shortcodes['vc_row'] = array(
		'name' => __( 'Row', 'js_composer' ),
		'base' => 'vc_row',
		'is_container' => true,
		'icon' => 'icon-wpb-row',
		'show_settings_on_create' => false,
		'category' => __( 'Content', 'js_composer' ),
		'description' => __( 'Place content elements inside the row', 'js_composer' ),
		'params' => array(
			array(
				'type' => 'colorpicker',
				'heading' => __( 'Font Color', 'js_composer' ),
				'param_name' => 'font_color',
				'description' => __( 'Select font color', 'js_composer' ),
				'edit_field_class' => 'vc_col-md-6 vc_column'
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Extra class name', 'js_composer' ),
				'param_name' => 'el_class',
				'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
			),
			array(
				'type' => 'css_editor',
				'heading' => __( 'Css', 'js_composer' ),
				'param_name' => 'css',
				// 'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
				'group' => __( 'Design options', 'js_composer' )
			)
		)
	);
	$shortcodes['vc_row_inner'] = $shortcodes['vc_row'];
	$shortcodes['vc_accordion'] = array(
		'name' => __( 'Accordion', 'js_composer' ),
		'base' => 'vc_accordion',
		'show_settings_on_create' => false,
		'is_container' => true,
		'icon' => 'icon-wpb-ui-accordion',
		'category' => __( 'Content', 'js_composer' ),
		'description' => __( 'Collapsible content panels', 'js_composer' ),
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Widget title', 'js_composer' ),
				'param_name' => 'title',
				'description' => __( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'js_composer' )
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Active section', 'js_composer' ),
				'param_name' => 'active_tab',
				'description' => __( 'Enter section number to be active on load or enter false to collapse all sections.', 'js_composer' )
			),
			array(
				'type' => 'checkbox',
				'heading' => __( 'Allow collapsible all', 'js_composer' ),
				'param_name' => 'collapsible',
				'description' => __( 'Select checkbox to allow all sections to be collapsible.', 'js_composer' ),
				'value' => array( __( 'Allow', 'js_composer' ) => 'yes' )
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Extra class name', 'js_composer' ),
				'param_name' => 'el_class',
				'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
			)
		)
	);
	$shortcodes['vc_accordion_tab'] = array(
		'name' => __( 'Section', 'js_composer' ),
		'base' => 'vc_accordion_tab',
		'allowed_container_element' => 'vc_row',
		'is_container' => true,
		'content_element' => false,
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Title', 'js_composer' ),
				'param_name' => 'title',
				'description' => __( 'Accordion section title.', 'js_composer' )
			),
		),
	);
	$shortcodes['vc_tabs'] = array(
		"name" => __( 'Tabs', 'js_composer' ),
		'base' => 'vc_tabs',
		'show_settings_on_create' => false,
		'is_container' => true,
		'icon' => 'icon-wpb-ui-tab-content',
		'category' => __( 'Content', 'js_composer' ),
		'description' => __( 'Tabbed content', 'js_composer' ),
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Widget title', 'js_composer' ),
				'param_name' => 'title',
				'description' => __( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'js_composer' )
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Auto rotate tabs', 'js_composer' ),
				'param_name' => 'interval',
				'value' => array( __( 'Disable', 'js_composer' ) => 0, 3, 5, 10, 15 ),
				'std' => 0,
				'description' => __( 'Auto rotate tabs each X seconds.', 'js_composer' )
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Extra class name', 'js_composer' ),
				'param_name' => 'el_class',
				'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
			)
		),
	);
	$shortcodes['vc_tour'] = array(
		'name' => __( 'Tour', 'js_composer' ),
		'base' => 'vc_tour',
		'show_settings_on_create' => false,
		'is_container' => true,
		'container_not_allowed' => true,
		'icon' => 'icon-wpb-ui-tab-content-vertical',
		'category' => __( 'Content', 'js_composer' ),
		'wrapper_class' => 'vc_clearfix',
		'description' => __( 'Vertical tabbed content', 'js_composer' ),
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Widget title', 'js_composer' ),
				'param_name' => 'title',
				'description' => __( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'js_composer' )
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Auto rotate slides', 'js_composer' ),
				'param_name' => 'interval',
				'value' => array( __( 'Disable', 'js_composer' ) => 0, 3, 5, 10, 15 ),
				'std' => 0,
				'description' => __( 'Auto rotate slides each X seconds.', 'js_composer' )
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Extra class name', 'js_composer' ),
				'param_name' => 'el_class',
				'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
			)
		)
	);
	$shortcodes['vc_tab'] = array(
		'name' => __( 'Tab', 'js_composer' ),
		'base' => 'vc_tab',
		'allowed_container_element' => 'vc_row',
		'is_container' => true,
		'content_element' => false,
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Title', 'js_composer' ),
				'param_name' => 'title',
				'description' => __( 'Tab title.', 'js_composer' )
			),
			array(
				'type' => 'tab_id',
				'heading' => __( 'Tab ID', 'js_composer' ),
				'param_name' => "tab_id"
			)
		)
	);
	$shortcodes['vc_gmaps'] = array(
		'name' => __( 'Google Maps', 'js_composer' ),
		'base' => 'vc_gmaps',
		'icon' => 'icon-wpb-map-pin',
		'category' => __( 'Content', 'js_composer' ),
		'description' => __( 'Map block', 'js_composer' ),
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Widget title', 'js_composer' ),
				'param_name' => 'title',
				'description' => __( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'js_composer' )
			),
			array(
				'type' => 'textarea_safe',
				'heading' => __( 'Map embed iframe', 'js_composer' ),
				'param_name' => 'link',
				'description' => sprintf( __( 'Visit <a href="%s" target="_blank">Google maps</a> to create your map. 1) Find location 2) Click "Share" and make sure map is public on the web 3) Click folder icon to reveal "Embed on my site" link 4) Copy iframe code and paste it here.', 'js_composer' ), 'https://www.google.com/maps/d/')
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Map height', 'js_composer' ),
				'param_name' => 'size',
				'admin_label' => true,
				'description' => __( 'Enter map height in pixels. Example: 200 or leave it empty to make map responsive.', 'js_composer' )
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Extra class name', 'js_composer' ),
				'param_name' => 'el_class',
				'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
			)
		)
	);

	return $shortcodes;
}
add_filter('thegem_shortcodes_array', 'thegem_shortcodes_array_add_vc');

function thegem_getExtraClass($el_class) {
	$output = '';
	if ($el_class != '') {
		$output = " " . str_replace(".", "", $el_class);
	}
	return $output;
}

function thegem_buildStyle($bg_image = '', $bg_color = '', $bg_image_repeat = '', $font_color = '', $padding = '', $margin_bottom = '') {
	$has_image = false;
	$style = '';
	if ((int)$bg_image > 0 && ($image_url = wp_get_attachment_url($bg_image, 'large')) !== false) {
		$has_image = true;
		$style .= "background-image: url(" . $image_url . ");";
	}
	if (! empty($bg_color)) {
		$style .= vc_get_css_color('background-color', $bg_color);
	}
	if (! empty($bg_image_repeat) && $has_image) {
		if ($bg_image_repeat === 'cover') {
			$style .= "background-repeat:no-repeat;background-size: cover;";
		} elseif ($bg_image_repeat === 'contain') {
			$style .= "background-repeat:no-repeat;background-size: contain;";
		} elseif ($bg_image_repeat === 'no-repeat') {
			$style .= 'background-repeat: no-repeat;';
		}
	}
	if (! empty($font_color)) {
		$style .= vc_get_css_color('color', $font_color); // 'color: '.$font_color.';';
	}
	if ($padding != '') {
		$style .= 'padding: ' . (preg_match('/(px|em|\%|pt|cm)$/', $padding) ? $padding : $padding . 'px') . ';';
	}
	if ($margin_bottom != '') {
		$style .= 'margin-bottom: ' . (preg_match('/(px|em|\%|pt|cm)$/', $margin_bottom) ? $margin_bottom : $margin_bottom . 'px') . ';';
	}
	return empty($style) ? $style : ' style="' . $style . '"';
}

function thegem_wpb_js_remove_wpautop($content, $autop = false) {
	if ($autop) { // Possible to use !preg_match('('.WPBMap::getTagsRegexp().')', $content)
		$content = wpautop(preg_replace('/<\/?p\>/', "\n", $content) . "\n");
	}
	return do_shortcode(shortcode_unautop($content));
}

function thegem_wpb_translateColumnWidthToSpan($width, $front = true) {
	if (preg_match('/^(\d{1,2})\/12$/', $width, $match)) {
		$w = "span" . $match[1];
	} else {
		switch ($width) {
			case "1/6" :
				$w = "col-md-2 col-xs-12";
				break;
			case "1/4" :
				$w = "col-md-3 col-sm-4 col-xs-6";
				break;
			case "1/3" :
				$w = "col-md-4 col-sm-6 col-xs-12";
				break;
			case "1/2" :
				$w = "col-md-6 col-xs-12";
				break;
			case "2/3" :
				$w = "col-md-8 col-xs-12";
				break;
			case "3/4" :
				$w = "col-md-9 col-xs-12";
				break;
			case "5/6" :
				$w = "col-md-10 col-xs-12";
				break;
			case "1/1" :
				$w = "col-md-12 col-xs-12";
				break;
			default :
				$w = $width;
		}
	}
	return $w;
}

function thegem_wpb_widget_title($params = array('title' => '')) {
	if ($params['title'] == '') return;

	$extraclass = (isset($params['extraclass'])) ? " " . $params['extraclass'] : "";
	$output = '<h2 class="wpb_heading' . $extraclass . '">' . $params['title'] . '</h2>';

	return apply_filters('wpb_widget_title', $output, $params);
}

function thegem_vc_row_shortcode($atts, $content) {
	include(get_template_directory() . '/inc/shortcodes/vc_shortcodes/vc_row.php');
	return $return_html;
}

function thegem_vc_column_shortcode($atts, $content) {
	include(get_template_directory() . '/inc/shortcodes/vc_shortcodes/vc_column.php');
	return $return_html;
}

function thegem_vc_accordion_shortcode($atts, $content) {
	include(get_template_directory() . '/inc/shortcodes/vc_shortcodes/vc_accordion.php');
	return $return_html;
}

function thegem_vc_accordion_tab_shortcode($atts, $content) {
	include(get_template_directory() . '/inc/shortcodes/vc_shortcodes/vc_accordion_tab.php');
	return $return_html;
}

function thegem_vc_tabs_shortcode($atts, $content) {
	$shortcode = 'vc_tabs';
	include(get_template_directory() . '/inc/shortcodes/vc_shortcodes/vc_tabs.php');
	return $return_html;
}

function thegem_vc_tour_shortcode($atts, $content) {
	$shortcode = 'vc_tour';
	include(get_template_directory() . '/inc/shortcodes/vc_shortcodes/vc_tour.php');
	return $return_html;
}

function thegem_vc_tab_shortcode($atts, $content) {
	include(get_template_directory() . '/inc/shortcodes/vc_shortcodes/vc_tab.php');
	return $return_html;
}


function thegem_vc_gmaps_shortcode($atts) {
	ob_start();
	include(get_template_directory() . '/inc/shortcodes/vc_shortcodes/vc_gmaps.php');
	return ob_get_clean();
}