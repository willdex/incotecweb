<?php

add_shortcode('gem_fullwidth', 'thegem_fullwidth_shortcode');
add_shortcode('gem_custom_header', 'thegem_custom_header_shortcode');
add_shortcode('gem_divider', 'thegem_divider_shortcode');
add_shortcode('gem_image', 'thegem_image_shortcode');
add_shortcode('gem_icon_with_title', 'thegem_icon_with_title_shortcode');
add_shortcode('gem_textbox', 'thegem_textbox_shortcode');
add_shortcode('gem_youtube', 'thegem_youtube_shortcode');
add_shortcode('gem_vimeo', 'thegem_vimeo_shortcode');
add_shortcode('gem_dropcap', 'thegem_dropcap_shortcode');
add_shortcode('gem_quote', 'thegem_quote_shortcode');
add_shortcode('gem_video', 'thegem_video_shortcode');
add_shortcode('gem_list', 'thegem_list_shortcode');
add_shortcode('gem_table', 'thegem_table_shortcode');
add_shortcode('gem_icon_with_text', 'thegem_icon_with_text_shortcode');
add_shortcode('gem_alert_box', 'thegem_alert_box_shortcode');
add_shortcode('gem_clients', 'thegem_clients_shortcode');
add_shortcode('gem_diagram', 'thegem_diagram_shortcode');
add_shortcode('gem_skill', 'thegem_skill_shortcode');
add_shortcode('gem_gallery', 'thegem_gallery_shortcode');
add_shortcode('gem_news', 'thegem_news_shortcode');
add_shortcode('gem_quickfinder', 'thegem_quickfinder_shortcode');
add_shortcode('gem_team', 'thegem_team_shortcode');
add_shortcode('gem_pricing_table', 'thegem_pricing_table_shortcode');
add_shortcode('gem_pricing_column', 'thegem_pricing_column_shortcode');
add_shortcode('gem_pricing_price', 'thegem_pricing_price_shortcode');
add_shortcode('gem_pricing_row', 'thegem_pricing_row_shortcode');
add_shortcode('gem_pricing_row_title', 'thegem_pricing_row_title_shortcode');
add_shortcode('gem_pricing_footer', 'thegem_pricing_footer_shortcode');
add_shortcode('gem_icon', 'thegem_icon_shortcode');
add_shortcode('gem_button', 'thegem_button_shortcode');
add_shortcode('gem_testimonials', 'thegem_testimonials_shortcode');
add_shortcode('gem_map_with_text', 'thegem_map_with_text_shortcode');
add_shortcode('gem_counter', 'thegem_counter_shortcode');
add_shortcode('gem_counter_box', 'thegem_counter_box_shortcode');
add_shortcode('gem_portfolio_slider', 'thegem_portfolio_slider_shortcode');
add_shortcode('gem_portfolio', 'thegem_portfolio_shortcode');
add_shortcode('gem_link', 'thegem_link');
add_shortcode('gem_project_info', 'thegem_project_info_shortcode');
add_shortcode('gem_socials', 'thegem_socials_shortcode');
add_shortcode('gem_search_form', 'thegem_search_form_shortcode');
add_shortcode('gem_countdown', 'thegem_countdown_shortcode');


function thegem_project_info_shortcode($atts, $content) {
	extract(shortcode_atts(array(
		'style' => '',
		'title' => '',
		'pack' => '',
		'decription' => '',
		'icon_color' => '',
		'icon_elegant' => '',
		'icon_material' => '',
		'icon_fontawesome' => '',
		'icon_userpack' => ''
	), $atts, 'thegem_project_info'));
	$values = vc_param_group_parse_atts($atts['values']);
	$graph_lines_data = array();
	foreach ( $values as $data ) {
			$new_line['title'] =  isset($data['title']) ? ($data['title']) : '';
			$new_line['decription'] = isset($data['decription']) ? ($data['decription']) : '';
			$new_line['pack'] = isset($data['pack']) ? ($data['pack']) : '';
			$new_line['icon_material'] = isset($data['icon_material']) ? ($data['icon_material']) : '';
			$new_line['icon_elegant'] = isset($data['icon_elegant']) ? ($data['icon_elegant']) : '';
			$new_line['icon_fontawesome'] = isset($data['icon_fontawesome']) ? ($data['icon_fontawesome']) : '';
			$new_line['icon_userpack'] = isset($data['icon_userpack']) ? ($data['icon_userpack']) : '';

		$new_line['icon_color'] = isset($data['icon_color']) ? ($data['icon_color']) : '';
			$graph_lines_data[] = $new_line;
		if ($new_line['pack'] == 'elegant') {wp_enqueue_style( 'icons-elegant');}
		if ($new_line['pack'] == 'material') {wp_enqueue_style( 'icons-material');}
		if ($new_line['pack'] == 'fontawesome') {wp_enqueue_style( 'icons-fontawesome');}
		if ($new_line['pack'] == 'userpack') {wp_enqueue_style( 'icons-userpack');}

	}



	$output = '';
	foreach ( $graph_lines_data as $line ) {
			$color= 'background-color:'.$line['icon_color'].'; color:'.$line['icon_color'].';';
			$output .=   '<div class="project-info-shortcode-item">';
			if ($line['pack'] == 'elegant') {$icon =  ($line['icon_elegant']);}
			elseif ($line['pack'] == 'material') {$icon =  ($line['icon_material']);}
			elseif ($line['pack'] == 'userpack') {$icon =  ($line['icon_userpack']);}
			else {$icon =  ($line['icon_fontawesome']);}
			$output .= '<div style="'.$color.'" class="icon ' .$line['pack'].'">&#x'.$icon.'</div>';
			$output .= '<div class="title">'. $line['title'] .'</div>';
			if (!empty($line['decription'])){
			$output .= '<div class="decription">' .$line['decription'].'</div>';
			}
			$output .= '</div>';
	}
	if ($style == 2) {
		$calsses = 'project-info-shortcode project-info-shortcode-style-2';
	}
	else {
		$calsses = 'project-info-shortcode project-info-shortcode-style-default';
	}

	$return_html = "<div class='$calsses'>" .$output. "</div>";
	return $return_html;
}


function thegem_custom_header_shortcode($atts, $content) {
	extract(shortcode_atts(array(
		'background_image' => '',
		'background_style' => '',
		'ch_background_color' => '',
		'video_background_type' => '',
		'video_background_src' => '',
		'video_background_acpect_ratio' => '',
		'video_background_overlay_color' => '',
		'video_background_overlay_opacity' => '',
		'video_background_poster' => '',
		'container' => '',
		'icon' => '',
		'shape' => 'none',
		'style' => '',
		'color' => '',
		'color_2' => '',
		'background_color' => '',
		'border_color' => '',
		'size' => 'small',
		'centered' => '',
		'icon_position'=> 'gem-custom-header-icon-position-left',
		'subtitle' => '',
		'subtitle_width' => '900',
		'title_width' => '900',
		'subtitle_color' => '#4c5867',
		'opacity' => '1',
		'pack' => '',
		'icon_elegant' => '',
		'icon_material' => '',
		'icon_fontawesome' => '',
		'icon_userpack' => '',
		'breadcrumbs' => '',
		'breadcrumbs_color' => '',
		'padding_bottom' => '90',
		'padding_top' => '',
		'icon_top_margin' => '',
		'icon_bottom_margin' => '',
		'title_top_margin' => '',
		'centreed_breadcrumbs' =>  '',
		'title_bottom_margin' => '',

	), $atts, 'gem_custom_header'));

	$shape = thegem_check_array_value(array('circle', 'square', 'romb', 'hexagon'), $shape, 'none');
	$style = thegem_check_array_value(array('', 'angle-45deg-r', 'angle-45deg-l', 'angle-90deg'), $style, '');
	$size = thegem_check_array_value(array('small', 'medium', 'large', 'xlarge'), $size, 'small');
	$css_style_icon = '';
	$css_style_icon_1 = '';
	$css_style_icon_2 = '';
	$title_styles ='';
	$css_style_icon_background = '';
	if($background_color) {
		$css_style_icon_background .= 'background-color: '.$background_color.';';
		if(!$border_color) {
			$css_style_icon .= 'border-color: '.$background_color.';';
		}
	}
	if($title_top_margin) {
		$title_styles .= 'margin-top:' .$title_top_margin. 'px;';
	}
	if($title_bottom_margin) {
		$title_styles .= 'margin-bottom:' .$title_bottom_margin. 'px;';
	}

	if($opacity) {
	$css_style_icon .= 'opacity:'.$opacity.';';
	}
	if($border_color) {
	$css_style_icon .= 'border-color: '.$border_color.';';
	}
	if($icon_top_margin) {
		$css_style_icon .= 'margin-top: '.$icon_top_margin.'px;';
	}
	if($icon_bottom_margin) {
		$css_style_icon .= 'margin-bottom: '.$icon_bottom_margin.'px;';
	}
	$simple_icon = '';
	if(!($background_color || $border_color)) {
	$simple_icon = ' gem-simple-icon';
	}
	if($color = $color) {
	$css_style_icon_1 = 'color: '.$color.';';
	if(($color_2 = $color_2) && $style) {
	$css_style_icon_2 = 'color: '.$color_2.';';
	}
	else {
	$css_style_icon_2 = 'color: '.$color.';';
	}
	}
	$css_style = '';
	if($background_image = thegem_attachment_url($background_image)) {
	$css_style .= 'background-image: url('.$background_image.');';
	}
	if($ch_background_color) {
	$css_style .= 'background-color: '.$ch_background_color.';';
	}
	if($background_style == 'cover') {
	$css_style .= 'background-repeat: no-repeat; background-size: cover;';
	}
	if($background_style == 'contain') {
	$css_style .= 'background-repeat: no-repeat; background-size: contain;';
	}
	if($background_style == 'repeat') {
	$css_style .= 'background-repeat: repeat;';
	}
	if($padding_top) {
		$css_style .= 'padding-top: '.$padding_top.'px;';
	}

	if($background_style == 'no-repeat') {
	$css_style .= 'background-repeat: no-repeat;';
	}
	if($container == '') {
	$css_style .= 'padding-left: 21px; padding-right: 21px;';
	}
	if($pack =='elegant' && empty($icon) && $icon_elegant) {
		$icon = $icon_elegant;
	}
	if($pack =='material' && empty($icon) && $icon_material) {
		$icon = $icon_material;
	}
	if($pack =='fontawesome' && empty($icon) && $icon_fontawesome) {
		$icon = $icon_fontawesome;
	}
	if($pack =='userpack' && empty($icon) && $icon_userpack) {
		$icon = $icon_userpack;
	}
	wp_enqueue_style('icons-'.$pack);
	$custom_header_uid = uniqid();

	$html_js = '<script type="text/javascript">if (typeof(gem_fix_fullwidth_position) == "function") { gem_fix_fullwidth_position(document.getElementById("custom-header-' . $custom_header_uid . '")); }</script>';

	$video = thegem_video_background($video_background_type, $video_background_src, $video_background_acpect_ratio, false, $video_background_overlay_color, $video_background_overlay_opacity, thegem_attachment_url($video_background_poster));
		$return_html =
		'<div id="custom-header-' . $custom_header_uid . '" class="custom-header '.$icon_position.'  ' .($centreed_breadcrumbs ? 'centreed_breadcrumbs' : '') . ' fullwidth-block clearfix'.'" style="'.$css_style. '">'.$html_js.$video.($container ? '<div class="container">' : '').
				'<div class="gem-icon gem-icon-pack-'.$pack.' gem-icon-size-'.$size.' '.$style.' gem-icon-shape-'.$shape.$simple_icon.'" style="'.$css_style_icon.'">'.
					($shape == 'hexagon' ? '<div class="gem-icon-shape-hexagon-back"><div class="gem-icon-shape-hexagon-back-inner"><div class="gem-icon-shape-hexagon-back-inner-before" style="background-color: '.($border_color ? $border_color : $background_color).'"></div></div></div><div class="gem-icon-shape-hexagon-top"><div class="gem-icon-shape-hexagon-top-inner"><div class="gem-icon-shape-hexagon-top-inner-before" style="'.$css_style_icon_background.'"></div></div></div>' : '').
						'<div class="gem-icon-inner" style="'.$css_style_icon_background.'">'.
						($shape == 'romb' ? '<div class="romb-icon-conteiner">' : '').
						'<span class="gem-icon-half-1" style="'.$css_style_icon_1.'"><span class="back-angle">&#x'.$icon.';</span></span>'.
						'<span class="gem-icon-half-2" style="'.$css_style_icon_2.'"><span class="back-angle">&#x'.$icon.';</span></span>'.
						($shape == 'romb' ? '</div>' : '').
					'</div>'.
				'</div>
			<div class="gem-custom-header-conteiner">'.
			'<div style="'.$title_styles.'" class="custom-header-title"><span style=" max-width:'.$title_width.'px;">' .do_shortcode($content). '</span></div>'.
		'<div class="custom-header-subtitle styled-subtitle" style="padding-bottom:'.$padding_bottom.'px;"><span class="light" style="max-width:'.$subtitle_width.'px; color:'.$subtitle_color.'; ">'.$subtitle.'</span></div>';
			if($breadcrumbs) {
				ob_start();
					gem_breadcrumbs();
				$return_html .= ob_get_clean();
			}
		$return_html .=
		($container ? '</div>' : '').'</div></div>';

	return $return_html;
}



function thegem_fullwidth_shortcode($atts, $content) {
	extract(shortcode_atts(array(
		'color' => '',
		'fullheight' => '',
		'background_color' => '',
		'background_image' => '',
		'background_style' => '',
		'background_position_horizontal' => 'center',
		'background_position_vertical' => 'top',
		'background_parallax' => '',
		'background_parallax_mobile' => '',
		'background_parallax_type' => '',
		'background_parallax_overlay_color' => '',
		'video_background_type' => '',
		'video_background_src' => '',
		'video_background_acpect_ratio' => '16:9',
		'video_background_overlay_color' => '',
		'video_background_overlay_opacity' => '',
		'video_background_poster' => '',
		'padding_top' => '',
		'padding_bottom' => '',
		'padding_left' => '',
		'padding_right' => '',
		'container' => '',
		'styled_marker_top_style' => '',
		'styled_marker_top_direction' => 'inside',
		'styled_marker_bottom_style' => '',
		'styled_marker_bottom_direction' => 'inside',
	), $atts, 'gem_fullwidth'));
	$styled_marker_top_style = thegem_check_array_value(array('', 'triangle', 'figure'), $styled_marker_top_style, '');
	$styled_marker_bottom_style = thegem_check_array_value(array('', 'triangle', 'figure'), $styled_marker_bottom_style, '');
	$styled_marker_top_direction = thegem_check_array_value(array('inside', 'outside'), $styled_marker_top_direction, 'inside');
	$styled_marker_bottom_direction = thegem_check_array_value(array('inside', 'outside'), $styled_marker_bottom_direction, 'inside');
	$background_parallax_type = thegem_check_array_value(array('vertical', 'horizontal', 'fixed'), $background_parallax_type, 'vertical');
	$css_style = '';
	if($color) {
		$css_style .= 'color: '.$color.';';
	}
	if($background_color) {
		$css_style .= 'background-color: '.$background_color.';';
	}

	$background_image_style = '';
	if($background_image = thegem_attachment_url($background_image)) {
		$background_image_style .= 'background-image: url('.$background_image.');';

	if($background_style == 'cover') {
			$background_image_style .= 'background-repeat: no-repeat; background-size: cover;';
	}
	if($background_style == 'contain') {
			$background_image_style .= 'background-repeat: no-repeat; background-size: contain;';
	}
	if($background_style == 'repeat') {
			$background_image_style .= 'background-repeat: repeat;';
	}
	if($background_style == 'no-repeat') {
			$background_image_style .= 'background-repeat: no-repeat;';
	}
		$background_image_style .= 'background-position: '.$background_position_horizontal.' '.$background_position_vertical.';';
	}

	$video = thegem_video_background($video_background_type, $video_background_src, $video_background_acpect_ratio, false, $video_background_overlay_color, $video_background_overlay_opacity, thegem_attachment_url($video_background_poster));
	if($padding_top) {
		$css_style .= 'padding-top: '.$padding_top.'px;';
	}
	if($padding_bottom) {
		$css_style .= 'padding-bottom: '.$padding_bottom.'px;';
	}
	if($padding_left) {
		$css_style .= 'padding-left: '.$padding_left.'px;';
	}
	if($padding_right) {
		$css_style .= 'padding-right: '.$padding_right.'px;';
	}
	if($fullheight) {
		$css_style .= 'height: 100vh';
	}

	$top_marker = '';
	$bottom_marker = '';
	if($styled_marker_top_style == 'triangle') {
		if($styled_marker_top_direction == 'inside') {
			$top_marker = '<div class="fullwidth-top-marker marker-direction-inside"><svg width="140" height="70"><path d="M 0,0 70,70 140,0" /></svg></div>';
		} elseif($styled_marker_top_direction == 'outside' && $background_color) {
			$top_marker = '<div class="fullwidth-top-marker marker-direction-outside"><svg width="140" height="70" style="fill: '.$background_color.'"><path d="M 0,71 70,0 140,71" /></svg></div>';
		}
	} elseif($styled_marker_top_style == 'figure') {
		if($styled_marker_top_direction == 'inside') {
			$top_marker = '<div class="fullwidth-top-marker marker-direction-inside"><svg width="140" height="70"><path d="M 0,0 Q 65,5 70,70 Q 75,5 140,0" /></svg></div>';
		} elseif($styled_marker_top_direction == 'outside' && $background_color) {
			$top_marker = '<div class="fullwidth-top-marker marker-direction-outside"><svg width="140" height="70" style="fill: '.$background_color.'"><path d="M 0,71 Q 65,65 70,0 Q 75,65 140,71" /></svg></div>';
		}
	}
	if($styled_marker_bottom_style == 'triangle') {
		if($styled_marker_bottom_direction == 'inside') {
			$bottom_marker = '<div class="fullwidth-bottom-marker marker-direction-inside"><svg width="140" height="70"><path d="M 0,71 70,0 140,71" /></svg></div>';
		} elseif($styled_marker_bottom_direction == 'outside' && $background_color) {
			$bottom_marker = '<div class="fullwidth-bottom-marker marker-direction-outside"><svg width="140" height="70" style="fill: '.$background_color.'"><path d="M 0,0 70,70 140,0" /></svg></div>';
		}
	} elseif($styled_marker_bottom_style == 'figure') {
		if($styled_marker_bottom_direction == 'inside') {
			$bottom_marker= '<div class="fullwidth-bottom-marker marker-direction-inside"><svg width="140" height="70"><path d="M 0,71 Q 65,65 70,0 Q 75,65 140,71" /></svg></div>';
		} elseif($styled_marker_bottom_direction == 'outside' && $background_color) {
			$bottom_marker = '<div class="fullwidth-bottom-marker marker-direction-outside"><svg width="140" height="70" style="fill: '.$background_color.'"><path d="M 0,0 Q 65,5 70,70 Q 75,5 140,0" /></svg></div>';
		}
	}

	if ($background_parallax && in_array($background_parallax_type, array('vertical', 'horizontal'))) {
		wp_enqueue_script('thegem-parallax-' . $background_parallax_type);
	}

	$fullwidth_uid = uniqid();

	$html_js = '<script type="text/javascript">if (typeof(gem_fix_fullwidth_position) == "function") { gem_fix_fullwidth_position(document.getElementById("fullwidth-block-' . $fullwidth_uid . '")); }</script>';

	$return_html = '<div id="fullwidth-block-' . $fullwidth_uid . '" class="fullwidth-block' . ($background_parallax ? ' fullwidth-block-parallax-' . $background_parallax_type : '') . ' clearfix" ' . ($background_parallax ? 'data-mobile-parallax-enable="' . ($background_parallax_mobile ? '1' : '0') . '"' : '') .  ' style="'.$css_style.'">' . $html_js .$top_marker. ($background_image_style != '' ? '<div class="fullwidth-block-background" style="'.$background_image_style.'"></div>' : '') . ($background_parallax && $background_parallax_overlay_color ? '<div class="fullwidth-block-parallax-overlay" style="background-color: ' . $background_parallax_overlay_color . ';"></div>' : '') .$video. '<div class="fullwidth-block-inner">'.($container ? '<div class="container">' : '').do_shortcode($content).($container ? '</div>' : '').'</div>'.$bottom_marker.'</div>';
	return $return_html;
}

function thegem_divider_shortcode($atts) {
	extract(shortcode_atts(array(
		'style' => '',
		'color' => '',
		'margin_top' => '',
		'margin_bottom' => '',
		'fullwidth' => '',
		'class_name' => ''
	), $atts, 'gem_divider'));
	$css_style = '';
	if($margin_top) {
		$css_style .= 'margin-top: '.$margin_top.'px;';
	}
	if($margin_bottom) {
		$css_style .= 'margin-bottom: '.$margin_bottom.'px;';
	}
	if($color) {
		$css_style .= 'border-color: '.$color.';';
	}
	$svg = '';
	if($style == 1) {
		$svg = '<svg width="100%" height="1px"><line x1="0" x2="100%" y1="0" y2="0" stroke="'.$color.'" stroke-width="2" stroke-linecap="black" stroke-dasharray="4, 4"/></svg>';
	}
	if($style == 4) {
		$svg = '<svg width="100%" height="8px"><line x1="4" x2="100%" y1="4" y2="4" stroke="'.$color.'" stroke-width="6" stroke-linecap="round" stroke-dasharray="1, 13"/></svg>';
	}
	if($style == 5) {
		$svg = '<svg width="100%" height="6px"><line x1="3" x2="100%" y1="3" y2="3" stroke="'.$color.'" stroke-width="6" stroke-linecap="square" stroke-dasharray="9, 13"/></svg>';
	}
	$return_html = '<div class="clearboth"></div><div class="gem-divider '.($class_name ? $class_name : '') .  ($style ? ' gem-divider-style-'.$style : '').($fullwidth ? ' fullwidth-block' : '').'" style="'.$css_style.'">'.$svg.'</div>';
	return $return_html;
}

function thegem_image_shortcode($atts) {
	extract(shortcode_atts(array(
		'width' => '',
		'height' => '',
		'src' => '',
		'alt' => '',
		'style' => 'default',
		'position' => 'left',
		'disable_lightbox'=>'',
		'effects_enabled' => false
	), $atts, 'gem_image'));
	$css_style = '';
	$classes = $style;
	if(substr($width, -1) != "%") {
		$width = intval($width).'px';
	}
	if(substr($height, -1) != "%") {
		$height = intval($height).'px';
	}
	if($width && $width > 0) {
		$css_style .= 'width: '.$width.';';
	}
	if($height && $height > 0) {
		$css_style .= 'height: '.$height.';';
	}
	if($style == '11') {
		$height = $width;
	}
	$return_html = '<div class="gem-image gem-wrapbox gem-wrapbox-style-'.$classes.($position ? ' gem-wrapbox-position-'.$position : '') . ($effects_enabled ? ' lazy-loading' : '') .'" style="'.$css_style.'">'.
		'<div class="gem-wrapbox-inner ' . ($effects_enabled ? ' lazy-loading-item' : '') . '" ' . ($effects_enabled ? ' data-ll-effect="move-up"' : '') . '>'.
		($style == '12' ? '<div class="shadow-wrap">' : '').
		(!$disable_lightbox ? '<a href="'.thegem_attachment_url($src).'" class="fancybox">' : '').
		'<img class="gem-wrapbox-element img-responsive'.($style == '11' ? ' img-circle' : '').'" src="'.thegem_attachment_url($src).'" alt="'.$alt.'"/>'.
		(!$disable_lightbox ? '</a>' : '').
		($style == '12' ? '</div>' : '').
		'</div>'.
		'</div>';
	if($position == 'centered') {
		$return_html = '<div class="centered-box gem-image-centered-box">'.$return_html.'</div>';
	}
	return $return_html;
}

function thegem_youtube_shortcode($atts) {
	extract(shortcode_atts(array(
		'width' => '100%',
		'height' => '300',
		'video_id' => '',
		'style' => 'no-style',
		'position' => 'below',
		'aspect_ratio' => ''
	), $atts, 'gem_youtube'));
	$css_style = '';
	$classes = $style;
	if($style != 11 && $style != 12) {
		$classes .= ' rounded-corners';
	}
	if(in_array($style, array(1, 5, 7))) {
		$classes .= ' shadow-box';
	}
	if(substr($width, -1) != "%") {
		$width = intval($width).'px';
	}
	if(substr($height, -1) != "%") {
		$height = intval($height).'px';
	}
	if($width && $width > 0) {
		$css_style .= 'width: '.$width.';';
	}
	$ratio_style = '';
	if($aspect_percents = thegem_aspect_ratio_to_percents($aspect_ratio)) {
		$ratio_style = 'padding-top: '.$aspect_percents.'%';
	} else {
		if($height && $height > 0) {
			$css_style .= 'height: '.$height.';';
		}
	}
	$return_html = '<div class="gem-youtube gem-wrapbox gem-wrapbox-style-'.$classes.($position ? ' gem-wrapbox-position-'.$position : '').'" style="'.$css_style.'">'.
		'<div class="gem-wrapbox-inner'.($ratio_style ? ' gem-ratio-style' : '').'"'.($ratio_style ? ' style="'.$ratio_style.'"' : '').'>'.
		($style == '12' ? '<div class="shadow-wrap">' : '').
		'<iframe class="gem-wrapbox-element img-responsive" width="'.$width.'" height="'.intval($height).'"  allowfullscreen="allowfullscreen" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="//www.youtube.com/embed/'.$video_id.'?rel=0&amp;wmode=opaque"></iframe>'.

		($style == '12' ? '</div>' : '').
		'</div>'.
		'</div>';
	return $return_html;
}

function thegem_vimeo_shortcode($atts) {
	extract(shortcode_atts(array(
		'width' => '100%',
		'height' => '300',
		'video_id' => '',
		'style' => 'no-style',
		'position' => 'below',
		'aspect_ratio' => ''
	), $atts, 'gem_vimeo'));
	$css_style = '';
	$classes = $style;
	if($style != 11 && $style != 12) {
		$classes .= ' rounded-corners';
	}
	if(in_array($style, array(1, 5, 7))) {
		$classes .= ' shadow-box';
	}
	if(substr($width, -1) != "%") {
		$width = intval($width).'px';
	}
	if(substr($height, -1) != "%") {
		$height = intval($height).'px';
	}
	if($width && $width > 0) {
		$css_style .= 'width: '.$width.';';
	}
	$ratio_style = '';
	if($aspect_percents = thegem_aspect_ratio_to_percents($aspect_ratio)) {
		$ratio_style = 'padding-top: '.$aspect_percents.'%';
	} else {
		if($height && $height > 0) {
			$css_style .= 'height: '.$height.';';
		}
	}
	$return_html = '<div class="gem-vimeo gem-wrapbox gem-wrapbox-style-'.$classes.($position ? ' gem-wrapbox-position-'.$position : '').'" style="'.$css_style.'">'.
		'<div class="gem-wrapbox-inner'.($ratio_style ? ' gem-ratio-style' : '').'"'.($ratio_style ? ' style="'.$ratio_style.'"' : '').'>'.
		($style == '12' ? '<div class="shadow-wrap">' : '').
		'<iframe webkitallowfullscreen="true" mozallowfullscreen="true" allowfullscreen="true" class="gem-wrapbox-element img-responsive" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="//player.vimeo.com/video/'.$video_id.'?title=0&amp;byline=0&amp;portrait=0 "></iframe>'.
		($style == '12' ? '</div>' : '').
		'</div>'.
		'</div>';
	return $return_html;
}

function thegem_video_shortcode($atts) {
	extract(shortcode_atts(array(
		'width' => '100%',
		'height' => '300',
		'video_src' => '',
		'image_src' => '',
		'style' => 'no-style',
		'position' => 'below',
		'aspect_ratio' => ''
	), $atts, 'gem_video'));
	$css_style = '';
	$classes = $style;
	if($style != 11 && $style != 12) {
		$classes .= ' rounded-corners';
	}
	if(in_array($style, array(1, 5, 7))) {
		$classes .= ' shadow-box';
	}
	if(substr($width, -1) != "%") {
		$width = intval($width).'px';
	}
	if(substr($height, -1) != "%") {
		$height = intval($height).'px';
	}
	if($width && $width > 0) {
		$css_style .= 'width: '.$width.';';
	}
	$ratio_style = '';
	if($aspect_percents = thegem_aspect_ratio_to_percents($aspect_ratio)) {
		$ratio_style = 'padding-top: '.$aspect_percents.'%';
	} else {
		if($height && $height > 0) {
			$css_style .= 'height: '.$height.';';
		}
	}
	$image_src = thegem_attachment_url($image_src);
	wp_enqueue_style('wp-mediaelement');
	wp_enqueue_script('thegem-mediaelement');
	$return_html = '<div class="gem-video gem-wrapbox gem-wrapbox-style-'.$classes.($position ? ' gem-wrapbox-position-'.$position : '').'" style="'.$css_style.'">'.
		'<div class="gem-wrapbox-inner video-block'.($ratio_style ? ' gem-ratio-style' : '').'"'.($ratio_style ? ' style="'.$ratio_style.'"' : '').'>'.
		($style == '12' ? '<div class="shadow-wrap video-block">' : '').
		'<video width="100%" height="100%" controls="controls" src="'.$video_src.'" '.($image_src ? ' poster="'.$image_src.'"' : '').' preload="none"></video>'.
		($style == '12' ? '</div>' : '').
		'</div>'.
		'</div>';
	return $return_html;
}

function thegem_textbox_shortcode($atts, $content) {
	extract(shortcode_atts(array(
		'style' => 'default',
		'content_text_color' => '',
		'content_background_color' => '#f4f6f7',
		'content_background_image' => '',
		'content_background_style' => '',
		'content_background_position_horizontal' => 'center',
		'content_background_position_vertical' => 'top',
		'padding_top' => '',
		'padding_bottom' => '',
		'padding_left' => '',
		'padding_right' => '',
		'border_width' => '0',
		'border_color' => '',
		'border_radius' => '0',
		'rectangle_corner' => '',
		'top_style' => 'default',
		'bottom_style' => 'default',
		'icon_pack' => 'elegant',
		'icon_shape' => 'square',
		'icon_style' => '',
		'icon_elegant' => '',
		'icon_material' => '',
		'icon_fontawesome' => '',
		'icon_userpack' => '',
		'icon_color' => '',
		'icon_color_2' => '',
		'icon_background_color' => '',
		'icon_border_color' => '',
		'icon_size' => 'small',
		'icon_opacity' => '1',
		'title_content' => '',
		'title_text_color' => '',
		'title_background_color' => '',
		'title_padding_top' => '',
		'title_padding_bottom' => '',
		'picture' => '',
		'picture_position' => 'top',
		'disable_lightbox' => false,
		'centered' => '',
		'effects_enabled' => false
	), $atts, 'gem_textbox'));
	$return_html = '';
	$title_html = '';
	$content_html = '';
	$top_html = '';
	$bottom_html = '';
	$css_style = '';
	$css_content_style = '';
	$rectangle_corner = explode(',', $rectangle_corner);
	$border_radius = intval($border_radius);
	$border_width = intval($border_width);
	$svg_top_color = '';
	$svg_bottom_color = '';

	if($style == 'title') {
		$css_title_style = '';
		if($title_text_color) {
			$css_title_style .= 'color: '.$title_text_color.';';
		}
		if($title_background_color) {
			$css_title_style .= 'background-color: '.$title_background_color.';';
			$svg_top_color = $title_background_color;
		}
		if(intval($title_padding_top) >= 0 && $title_padding_top !== '') {
			$css_title_style .= 'padding-top: '.intval($title_padding_top).'px;';
		}
		if(intval($title_padding_bottom) >= 0 && $title_padding_bottom !== '') {
			$css_title_style .= 'padding-bottom: '.intval($title_padding_bottom).'px;';
		}
		if(intval($padding_left) >= 0 && $padding_left !== '') {
			$css_title_style .= 'padding-left: '.intval($padding_left).'px;';
		}
		if(intval($padding_right) >= 0 && $padding_right !== '') {
			$css_title_style .= 'padding-right: '.intval($padding_right).'px;';
		}
		$title_html .= '<div class="gem-textbox-title" style="'.$css_title_style.'">';
		if(($icon_pack =='elegant' && $icon_elegant) || ($icon_pack =='material' && $icon_material) || ($icon_pack =='fontawesome' && $icon_fontawesome) || ($icon_pack =='userpack' && $icon_userpack)) {
			$title_html .= '<div class="gem-textbox-title-icon">'.do_shortcode(thegem_build_icon_shortcode($atts)).'</div>';
		}
		if($title_content) {
			$title_html .= '<div class="gem-textbox-title-text">'.(rawurldecode(base64_decode($title_content))).'</div>';
		}
		$title_html .= '</div>';
	}
	if($style == 'picturebox' && $picture) {
		$title_html .= '<div class="gem-textbox-picture centered-box">';
		if($disable_lightbox) {
			$title_html .= '<img src="'.thegem_attachment_url($picture).'" alt="#" class="img-responsive" />';
		} else {
			$title_html .= '<a href="'.thegem_attachment_url($picture).'" class="fancy"><img src="'.thegem_attachment_url($picture).'" alt="#" class="img-responsive" /></a>';
		}
		$title_html .= '</div>';
	}

	if($content_text_color) {
		$css_content_style .= 'color: '.$content_text_color.';';
	}
	if($content_background_color) {
		$css_content_style .= 'background-color: '.$content_background_color.';';
		$svg_top_color = $svg_top_color ? $svg_top_color : $content_background_color;
		$svg_bottom_color = $content_background_color;
	}
	if($content_background_image = thegem_attachment_url($content_background_image)) {
		$css_content_style .= 'background-image: url('.$content_background_image.');';
	}
	if($content_background_style == 'cover') {
		$css_content_style .= 'background-repeat: no-repeat; background-size: cover;';
	}
	if($content_background_style == 'contain') {
		$css_content_style .= 'background-repeat: no-repeat; background-size: contain;';
	}
	if($content_background_style == 'repeat') {
		$css_content_style .= 'background-repeat: repeat;';
	}
	if($content_background_style == 'no-repeat') {
		$css_content_style .= 'background-repeat: no-repeat;';
	}
	$css_content_style .= 'background-position: '.$content_background_position_horizontal.' '.$content_background_position_vertical.';';

	if(intval($padding_top) >= 0 && $padding_top !== '') {
		$css_content_style .= 'padding-top: '.intval($padding_top).'px;';
	}
	if(intval($padding_bottom) >= 0 && $padding_bottom !== '') {
		$css_content_style .= 'padding-bottom: '.intval($padding_bottom).'px;';
	}
	if(intval($padding_left) >= 0 && $padding_left !== '') {
		$css_content_style .= 'padding-left: '.intval($padding_left).'px;';
	}
	if(intval($padding_right) >= 0 && $padding_right !== '') {
		$css_content_style .= 'padding-right: '.intval($padding_right).'px;';
	}

	$content_html .= '<div class="gem-textbox-content" style="'.$css_content_style.'">'.do_shortcode($content).'</div>';

	if($border_width && $border_color) {
		$css_style .= 'border: '.$border_width.'px solid '.$border_color.';';
		$svg_top_color = $border_color;
		$svg_bottom_color = $border_color;
	}

	if($top_style == 'flag') {
		$rectangle_corner = array_merge($rectangle_corner, array('lt', 'rt'));
		$top_html = '<div class="gem-textbox-top gem-textbox-top-flag"><svg viewBox="0 0 1000 20" preserveAspectRatio="none" width="100%" height="20" style="fill: '.$svg_top_color.';"><path d="M 0,20.5 0,0 500,20.5 1000,0 1000,20.5" /></svg></div>';
	}
	if($top_style == 'shield') {
		$rectangle_corner = array_merge($rectangle_corner, array('lt', 'rt'));
		$top_html = '<div class="gem-textbox-top gem-textbox-top-shield"><svg viewBox="0 0 1000 50" preserveAspectRatio="none" width="100%" height="50" style="fill: '.$svg_top_color.';"><path d="M 0,50.5 500,0 1000,50.5" /></svg></div>';
	}
	if($top_style == 'ticket') {
		$rectangle_corner = array_merge($rectangle_corner, array('lt', 'rt'));
		$pattern_id = 'pattern-'.time().'-'.rand(0, 100);
		$top_html = '<div class="gem-textbox-top gem-textbox-top-ticket"><svg width="100%" height="14" style="fill: '.$svg_top_color.';"><defs><pattern id="'.$pattern_id.'" x="16" y="0" width="32" height="16" patternUnits="userSpaceOnUse" ><path d="M 0,14.5 16,-0.5 32,14.5" /></pattern></defs><rect x="0" y="0" width="100%" height="14" style="fill: url(#'.$pattern_id.');" /></svg></div>';
	}
	if($top_style == 'sentence') {
		$top_html = '<div class="gem-textbox-top gem-textbox-top-sentence"><svg width="100" height="50" style="fill: '.$svg_top_color.';"><path d="M 0,51 Q 45,45 50,0 Q 55,45 100,51" /></svg></div>';
	}
	if($top_style == 'note-1') {
		$rectangle_corner = array_merge($rectangle_corner, array('lt', 'rt'));
		$pattern_id = 'pattern-'.time().'-'.rand(0, 100);
		$top_html = '<div class="gem-textbox-top gem-textbox-top-note-1"><svg width="100%" height="31" style="fill: '.$svg_top_color.';"><defs><pattern id="'.$pattern_id.'" x="11" y="0" width="23" height="32" patternUnits="userSpaceOnUse" ><path d="M20,9h3V0H0v9h3c2.209,0,4,1.791,4,4v6c0,2.209-1.791,4-4,4H0v9h23v-9h-3c-2.209,0-4-1.791-4-4v-6C16,10.791,17.791,9,20,9z" /></pattern></defs><rect x="0" y="0" width="100%" height="32" style="fill: url(#'.$pattern_id.');" /></svg></div>';
	}
	if($top_style == 'note-2') {
		$rectangle_corner = array_merge($rectangle_corner, array('lt', 'rt'));
		$pattern_id = 'pattern-'.time().'-'.rand(0, 100);
		$top_html = '<div class="gem-textbox-top gem-textbox-top-note-1"><svg width="100%" height="27" style="fill: '.$svg_top_color.';"><defs><pattern id="'.$pattern_id.'" x="10" y="0" width="20" height="28" patternUnits="userSpaceOnUse" ><path d="M20,8V0H0v8c3.314,0,6,2.687,6,6c0,3.313-2.686,6-6,6v8h20v-8c-3.313,0-6-2.687-6-6C14,10.687,16.687,8,20,8z" /></pattern></defs><rect x="0" y="0" width="100%" height="28" style="fill: url(#'.$pattern_id.');" /></svg></div>';
	}
	if($bottom_style == 'flag') {
		$rectangle_corner = array_merge($rectangle_corner, array('lb', 'rb'));
		$bottom_html = '<div class="gem-textbox-bottom gem-textbox-bottom-flag"><svg viewBox="0 0 1000 20" preserveAspectRatio="none" width="100%" height="20" style="fill: '.$svg_bottom_color.';"><path d="M 0,-0.5 0,20 500,0 1000,20 1000,-0.5" /></svg></div>';
	}
	if($bottom_style == 'shield') {
		$rectangle_corner = array_merge($rectangle_corner, array('lb', 'rb'));
		$bottom_html = '<div class="gem-textbox-bottom gem-textbox-bottom-shield"><svg viewBox="0 0 1000 50" preserveAspectRatio="none" width="100%" height="50" style="fill: '.$svg_bottom_color.';"><path d="M 0,-0.5 500,50 1000,-0.5" /></svg></div>';
	}
	if($bottom_style == 'ticket') {
		$rectangle_corner = array_merge($rectangle_corner, array('lb', 'rb'));
		$pattern_id = 'pattern-'.time().'-'.rand(0, 100);
		$bottom_html = '<div class="gem-textbox-bottom gem-textbox-bottom-ticket"><svg width="100%" height="14" style="fill: '.$svg_bottom_color.';"><defs><pattern id="'.$pattern_id.'" x="16" y="-1" width="32" height="16" patternUnits="userSpaceOnUse" ><path d="M 0,-0.5 16,14.5 32,-0.5" /></pattern></defs><rect x="0" y="-1" width="100%" height="14" style="fill: url(#'.$pattern_id.');" /></svg></div>';
	}
	if($bottom_style == 'sentence') {
		$bottom_html = '<div class="gem-textbox-bottom gem-textbox-bottom-sentence"><svg width="100" height="50" style="fill: '.$svg_bottom_color.';"><path d="M 0,-1 Q 45,5 50,50 Q 55,5 100,-1" /></svg></div>';
	}
	if($bottom_style == 'note-1') {
		$rectangle_corner = array_merge($rectangle_corner, array('lb', 'rb'));
		$pattern_id = 'pattern-'.time().'-'.rand(0, 100);
		$bottom_html = '<div class="gem-textbox-bottom gem-textbox-bottom-note-1"><svg width="100%" height="32" style="fill: '.$svg_bottom_color.';"><defs><pattern id="'.$pattern_id.'" x="11" y="-1" width="23" height="32" patternUnits="userSpaceOnUse" ><path d="M20,9h3V0H0v9h3c2.209,0,4,1.791,4,4v6c0,2.209-1.791,4-4,4H0v9h23v-9h-3c-2.209,0-4-1.791-4-4v-6C16,10.791,17.791,9,20,9z" /></pattern></defs><rect x="0" y="-1" width="100%" height="32" style="fill: url(#'.$pattern_id.');" /></svg></div>';
	}
	if($bottom_style == 'note-2') {
		$rectangle_corner = array_merge($rectangle_corner, array('lb', 'rb'));
		$pattern_id = 'pattern-'.time().'-'.rand(0, 100);
		$bottom_html = '<div class="gem-textbox-bottom gem-textbox-bottom-note-2"><svg width="100%" height="28" style="fill: '.$svg_bottom_color.';"><defs><pattern id="'.$pattern_id.'" x="10" y="-1" width="20" height="28" patternUnits="userSpaceOnUse" ><path d="M20,8V0H0v8c3.314,0,6,2.687,6,6c0,3.313-2.686,6-6,6v8h20v-8c-3.313,0-6-2.687-6-6C14,10.687,16.687,8,20,8z" /></pattern></defs><rect x="0" y="-1" width="100%" height="28" style="fill: url(#'.$pattern_id.');" /></svg></div>';
	}

	if($border_radius) {
		if(!in_array('lt', $rectangle_corner)) {
			$css_style .= 'border-top-left-radius: '.$border_radius.'px;';
		}
		if(!in_array('rt', $rectangle_corner)) {
			$css_style .= 'border-top-right-radius: '.$border_radius.'px;';
		}
		if(!in_array('rb', $rectangle_corner)) {
			$css_style .= 'border-bottom-right-radius: '.$border_radius.'px;';
		}
		if(!in_array('lb', $rectangle_corner)) {
			$css_style .= 'border-bottom-left-radius: '.$border_radius.'px;';
		}
	}

	if($style == 'picturebox' && $picture) {
		if($picture_position == 'top') {
			$return_html = ($effects_enabled ? '<div class="lazy-loading" data-ll-item-delay="0">' : '').'<div class="gem-textbox'.($effects_enabled ? ' lazy-loading-item' : '').($centered ? ' centered-box' : '').'" '.($effects_enabled ? ' data-ll-effect="move-up"' : '').'>'.$top_html.$title_html.'<div class="gem-textbox-inner gem-textbox-after-image" style="'.$css_style.'">'.$content_html.'</div>'.$bottom_html.'</div>'.($effects_enabled ? '</div>' : '');
		}
		if($picture_position == 'bottom') {
			$return_html = ($effects_enabled ? '<div class="lazy-loading" data-ll-item-delay="0">' : '').'<div class="gem-textbox'.($effects_enabled ? ' lazy-loading-item' : '').($centered ? ' centered-box' : '').'" '.($effects_enabled ? ' data-ll-effect="move-up"' : '').'>'.$top_html.'<div class="gem-textbox-inner gem-textbox-before-image" style="'.$css_style.'">'.$content_html.'</div>'.$title_html.$bottom_html.'</div>'.($effects_enabled ? '</div>' : '');
		}
	} else {
		$return_html = ($effects_enabled ? '<div class="lazy-loading" data-ll-item-delay="0">' : '').'<div class="gem-textbox'.($effects_enabled ? ' lazy-loading-item' : '').($centered ? ' centered-box' : '').'" '.($effects_enabled ? ' data-ll-effect="move-up"' : '').'>'.$top_html.'<div class="gem-textbox-inner" style="'.$css_style.'">'.$title_html.$content_html.'</div>'.$bottom_html.'</div>'.($effects_enabled ? '</div>' : '');
	}

	return $return_html;
}

function thegem_quote_shortcode($atts, $content) {
	extract(shortcode_atts(array(
		'style' => 'default',
		'no_paddings' => ''
	), $atts, 'gem_quote'));
	$return_html = '<div class="gem-quote'.($style ? ' gem-quote-style-'.$style : '').($no_paddings ? ' gem-quote-no-paddings' : '').'"><blockquote>'.do_shortcode($content).'</blockquote></div>';
	return $return_html;
}

function thegem_list_shortcode($atts, $content) {
	extract(shortcode_atts(array(
		'type' => '',
		'color' => '',
		'effects_enabled' => false
	), $atts, 'gem_list'));
	$return_html = '<div class="gem-list' . ($effects_enabled ? ' lazy-loading' : '') .($type ? ' gem-list-type-'.$type : '').($color ? ' gem-list-color-'.$color : '').'">'.thegem_remove_wpautop($content, true).'</div>';
	return $return_html;
}

function thegem_table_shortcode($atts, $content) {
	extract(shortcode_atts(array(
		'style' => '1',
		'row_headers' => ''
	), $atts, 'gem_table'));
	wp_enqueue_script('jquery-restable');
	$return_html = '<div class="gem-table gem-table-responsive'.($style ? ' gem-table-style-'.$style : '').($row_headers ? ' row-headers' : '').'">'.thegem_remove_wpautop($content, true).'</div>';
	return $return_html;
}

function thegem_quickfinder_shortcode($atts) {
	ob_start();
	thegem_quickfinder($atts);
	$return_html = trim(preg_replace('/\s\s+/', ' ', ob_get_clean()));
	return $return_html;
}

function thegem_team_shortcode($atts) {
	extract(shortcode_atts(array(
		'team' => '',
		'style' => '1',
		'columns' => '3'
	), $atts, 'gem_team'));
	$style = thegem_check_array_value(array(1,2,3,4,5,6), $style, 1);
	$columns = thegem_check_array_value(array('1', '2', '3', '4'), $columns, '3');
	ob_start();
	thegem_team(array('team' => $team, 'style' => 'style-'.$style, 'columns' => $columns));
	$return_html = trim(preg_replace('/\s\s+/', ' ', ob_get_clean()));
	return $return_html;
}

function thegem_gallery_shortcode($atts) {
	extract(shortcode_atts(array(
		'gallery_gallery' => '',
		'gallery_type' => 'slider',
		'gallery_slider_layout' => 'fullwidth',
		'gallery_layout' => '2x',
		'no_thumbs' => 0,
		'pagination' => 0,
		'autoscroll' => 0,
		'gallery_style' => 'justified',
		'gallery_fullwidth_columns' => '4',
		// 'gallery_no_gaps' => '',
		'gallery_hover' => 'default',
		'gallery_item_style' => 'default',
		'gallery_title' => '',
		'gaps_size' => '',
		'loading_animation' => 'move-up',
		'gallery_effects_enabled' => '',
		'metro_max_row_height' => 380
	), $atts, 'gem_gallery'));
	ob_start();
	if($gallery_type == 'slider') {
		thegem_gallery(array(
			'gallery' => $gallery_gallery,
			'hover' => $gallery_hover,
			'layout' => $gallery_slider_layout,
			'no_thumbs' => $no_thumbs,
			'pagination' => $pagination,
			'autoscroll' => $autoscroll,
		));
	} else {
		thegem_gallery_block(array(
			'gallery' => $gallery_gallery,
			'type' => $gallery_type,
			'layout' => $gallery_layout,
			'style' => $gallery_style,
			// 'no_gaps' => $gallery_no_gaps,
			'hover' => $gallery_hover,
			'item_style' => $gallery_item_style,
			'title' => $gallery_title,
			'gaps_size' => $gaps_size,
			'loading_animation' => $loading_animation,
			'effects_enabled' => $gallery_effects_enabled,
			'metro_max_row_height' => $metro_max_row_height,
			'fullwidth_columns' => $gallery_fullwidth_columns
		));
	}
	$return_html = trim(preg_replace('/\s\s+/', ' ', ob_get_clean()));
	return $return_html;
}

function thegem_vc_get_galleries() {
	$galleries_posts = get_posts(array(
		'post_type' => 'thegem_gallery',
		'posts_per_page' => -1,
		'orderby' => 'title',
		'order' => 'ASC',
	));
	$galleries = array();
	foreach($galleries_posts as $gallery) {
		$galleries[$gallery->post_title.' (ID='.$gallery->ID.')'] = $gallery->ID;
	}
	return $galleries;
}

function thegem_pricing_table_shortcode($atts, $content) {
	extract(shortcode_atts(array(
		'style' => '1',
		'button_icon' => 'default',
	), $atts, 'gem_pricing_table'));
	$style = thegem_check_array_value(array(1, 2, 3, 4, 5, 6, 7, 8) ,$style, 1);
	$content = str_replace('[gem_pricing_price', '[gem_pricing_price use_style="'.$style.'" ',$content);

	$return_html = '<div class="pricing-table row inline-row inline-row-center pricing-table-style-'.$style.' button-icon-'.$button_icon.'">';
	$return_html.= do_shortcode($content);
	$return_html.= '</div>';

	return $return_html;
}

function thegem_pricing_column_shortcode($atts, $content) {
	extract(shortcode_atts(array(
		'highlighted' => '0',
		'top_choice' => '',
		'top_choice_color' => '',
		'top_choice_background_color' => '',
		'label_top_corner' => 0,
		'cols' => 4,
	), $atts, 'gem_pricing_column'));
	$path = get_template_directory_uri().'/images/star.svg#star';
	$fill_svg_color ='';
	if ($top_choice_background_color) {
		 $fill_svg_color =  "style=fill:$top_choice_background_color;";
	}
	$fill_svg = '<svg class="svg_pricing" '.$fill_svg_color.'><use xlink:href='.$path.'></use></svg>';
	$return_html = '
	<div class="pricing-column-wrapper ' .($cols == 4  ? 'col-md-3 col-sm-4 col-xs-6 ' : ''). ($cols == 3  ? 'col-md-4 col-sm-4 col-xs-6 ' : ''). ' inline-column'.($highlighted == '1' ? ' highlighted' : '').'">'
		.($top_choice ?
			'<div ' .($top_choice_background_color ? 'style=background-color:'.$top_choice_background_color.'' : ''). '  class="pricing-column-top-choice">'.$fill_svg.'
		<div ' .($top_choice_color ? 'style=color:'.$top_choice_color.'' : ''). ' class="pricing-column-top-choice-text">'.$top_choice.'</div></div>' : '').
	'<div class="pricing-column'.($label_top_corner == '1' ? ' label-top-corner' : '').'">';
	$return_html.= do_shortcode($content);
	$return_html.= '</div></div>';
	return $return_html;
}

function thegem_pricing_price_shortcode($atts) {
	extract(shortcode_atts(array(
		'title' => '',
		'subtitle' => '',
		'currency' => '',
		'price' => '',
		'time' => '',
		'font_size' => '',
		'color' => '',
		'use_style' => '',
		'background' => '',
		'backgroundcolor' => '',
		'font_size' => '',
		'price_color' => '',
		'title_color' => '',
		'subtitle_color' => '',
		'time_color' => '',
		'font_size_time' => ''

	), $atts, 'gem_pricing_price'));

	$svg_fill= '';
	if ($backgroundcolor) { $svg_fill = "style='fill:$backgroundcolor'";}
	$url = get_template_directory_uri() . '/css/post-arrow.svg#dec-post-arrow';
	$bottom_html = '<svg ' .$svg_fill. ' class="wrap-style"><use xlink:href='.$url.' /></use></svg>';
	$background = thegem_attachment_url($background);
	$return_html = '
	 <div class="pricing-price-row '.($background ? 'pricing-price-row-width-background' : '').' "  style="'.($background ? ' background-image: url('.$background.');' : '') . ($backgroundcolor ? ' background-color: '.$backgroundcolor.'; ' : '') . ($price_color ? 'color:'.$price_color.'; ' : '') .'">

		'.($title ? '<div class="pricing-price-title-wrapper">
		<div '.($title_color ? 'style=color:'.$title_color.'' : '').'  class="pricing-price-title">'.$title.'</div>
		<div '.($subtitle_color ? 'style=color:'.$subtitle_color.'' : '').' class="pricing-price-subtitle">'.$subtitle.'</div>
		</div>' : '').'

		<div class="pricing-price-wrapper"><div class="pricing-price'.($background ? ' pricing-price-row-background' : '').'" style="'.($background ? ' background-image: url('.$background.');' : '') . ($backgroundcolor ? ' background-color: '.$backgroundcolor.'; ' : '') .'">'.
			'<div style=" '.($price_color ? 'color:'.$price_color.'; ' : '') .($font_size != '' ? 'font-size: '.$font_size.'px;' : '').'" class="pricing-cost">'.$currency.$price.'</div>'.($time != '' ? '<div  class="time" style= ' .'display:inline-block;'  . ($time_color ? 'color:'.$time_color.';' : '') . ($font_size_time ? 'font-size:'.$font_size_time.'px; ' : '') .'>'.$time.'</div>' : '').
		'</div></div>'
		.$bottom_html.
	'</div>';

	return $return_html;
}

function thegem_pricing_row_shortcode($atts, $content) {
	extract(shortcode_atts(array(
		'strike' => '',
	), $atts, 'gem_pricing_row'));

	$return_html = '<figure class="pricing-row'.($strike == '1' ? ' strike' : '').'">'.$content.'</figure>';
	return $return_html;
}
function thegem_pricing_row_title_shortcode($atts, $content) {
	extract(shortcode_atts(array(
		'subtitle' => '',
		'title_color' => '',
		'subtitle_color' => '',
	), $atts, 'gem_pricing_row_title'));
	$return_html = '<div class="pricing-row pricing-row-title"><div '.($title_color ? "style='color: $title_color'" :'').' class="pricing_row_title">'.$content.'</div>'.($subtitle ? '<div '.($subtitle_color ? "style='color: $subtitle_color'" :'').'  class="pricing_row_subtitle">'.$subtitle.'</div>' : ''). '</div>';
	return $return_html;
}

function thegem_pricing_footer_shortcode($atts, $content) {
	extract(shortcode_atts(array(
		'href' => '#',
		'button_1_text' => '',
		'button_1_link' => '',
		'button_1_style' => 'center',
		'button_1_size' => 'small',
		'button_1_text_weight' => 'normal',
		'button_1_no_uppercase' => 0,
		'button_1_corner' => 3,
		'button_1_border' => 2,
		'button_1_position' => 'center',
		'button_1_text_color' => '',
		'button_1_background_color' => '',
		'button_1_border_color' => '',
		'button_1_hover_text_color' => '',
		'button_1_hover_background_color' => '',
		'button_1_hover_border_color' => '',
		'button_1_icon_pack' => 'elegant',
		'button_1_icon_elegant' => '',
		'button_1_icon_material' => '',
		'button_1_icon_fontawesome' => '',
		'button_1_icon_userpack' => '',
		'button_1_icon_position' => 'left',
		'button_1_separator' => '',
		'button_1_extra_class' => '',
	), $atts, 'gem_pricing_footer'));
	$button1 = array();
	foreach($atts as $key => $value) {
		if(substr($key, 0, 9) == 'button_1_') {
			$button1[substr($key, 9)] = $value;
		}
	}
		$button1['position'] = 'center';
	$return_html = '<div class="pricing-footer">'.thegem_button_shortcode($button1).'</div>';
	return $return_html;
}

function thegem_icon_shortcode($atts) {
	extract(shortcode_atts(array(
		'pack' => '',
		'icon' => '',
		'icon_elegant' => '',
		'icon_material' => '',
		'icon_fontawesome' => '',
		'icon_userpack' => '',
		'shape' => 'square',
		'style' => '',
		'color' => '',
		'color_2' => '',
		'background_color' => '',
		'border_color' => '',
		'size' => 'small',
		'icon_opacity' => '1',
		'link' => '',
		'link_target' => '_self',
		'centered' => '',
		'icon_top_margin' => '0',
		'icon_bottom_margin' => '0',
		'css_style' => ''
	), $atts, 'gem_icon'));
	if($pack =='elegant' && empty($icon) && $icon_elegant) {
		$icon = $icon_elegant;
	}
	if($pack =='material' && empty($icon) && $icon_material) {
		$icon = $icon_material;
	}
	if($pack =='fontawesome' && empty($icon) && $icon_fontawesome) {
		$icon = $icon_fontawesome;
	}
	if($pack =='userpack' && empty($icon) && $icon_userpack) {
		$icon = $icon_userpack;
	}
	wp_enqueue_style('icons-'.$pack);
	$shape = thegem_check_array_value(array('circle', 'square', 'romb', 'hexagon'), $shape, 'square');
	$style = thegem_check_array_value(array('', 'angle-45deg-r', 'angle-45deg-l', 'angle-90deg'), $style, '');
	$size = thegem_check_array_value(array('small', 'medium', 'large', 'xlarge'), $size, 'small');
	$link = esc_url($link);
	$link_target = thegem_check_array_value(array('_self', '_blank'), $link_target, '_self');
	$css_style_icon = '';
	$css_style_icon_background = '';
	$css_style_icon_1 = '';
	$css_style_icon_2 = '';
	if($css_style) {
		$css_style_icon .= esc_attr($css_style);
	}
	if($background_color) {
		$css_style_icon_background .= 'background-color: '.$background_color.';';
		if(!$border_color) {
			$css_style_icon .= 'border-color: '.$background_color.';';
		}
	}
	if(intval($icon_top_margin)) {
		$css_style_icon .= 'margin-top: '.intval($icon_top_margin).'px;';
	}
	if(intval($icon_bottom_margin)) {
		$css_style_icon .= 'margin-bottom: '.intval($icon_bottom_margin).'px;';
	}
	if($border_color) {
		$css_style_icon .= 'border-color: '.$border_color.';';
	}
	if($icon_opacity) {
		$css_style_icon .= 'opacity: '.$icon_opacity.';';
	}
	$simple_icon = '';
	if(!($background_color || $border_color)) {
		$simple_icon = ' gem-simple-icon';
	}
	if($color = $color) {
		$css_style_icon_1 = 'color: '.$color.';';
		if(($color_2 = $color_2) && $style) {
			$css_style_icon_2 = 'color: '.$color_2.';';
		} else {
			$css_style_icon_2 = 'color: '.$color.';';
		}
	}
	if($shape == "romb") {'';}
	if($shape == "romb") {'</div> ';}


	$return_html = '<div class="gem-icon gem-icon-pack-'.$pack.' gem-icon-size-'.$size.' '.$style.' gem-icon-shape-'.$shape.$simple_icon.'" style="'.$css_style_icon.'">'.

		($shape == 'hexagon' ? '<div class="gem-icon-shape-hexagon-back"><div class="gem-icon-shape-hexagon-back-inner"><div class="gem-icon-shape-hexagon-back-inner-before" style="background-color: '.($border_color ? $border_color : $background_color).'"></div></div></div><div class="gem-icon-shape-hexagon-top"><div class="gem-icon-shape-hexagon-top-inner"><div class="gem-icon-shape-hexagon-top-inner-before" style="'.$css_style_icon_background.'"></div></div></div>' : '').
		'<div class="gem-icon-inner" style="'.$css_style_icon_background.'">'.
		($shape == 'romb' ? '<div class="romb-icon-conteiner">' : '').
		($link ? '<a href="'.$link.'" target="'.$link_target.'">' : '').
		'<span class="gem-icon-half-1" style="'.$css_style_icon_1.'"><span class="back-angle">&#x'.$icon.';</span></span>'.
		'<span class="gem-icon-half-2" style="'.$css_style_icon_2.'"><span class="back-angle">&#x'.$icon.';</span></span>'.
		($link ? '</a>' : '').
		($shape == 'romb' ? '</div>' : '').
		'</div>'.
		'</div>';
	return ($centered ? '<div class="centered-box">' : '').$return_html.($centered ? '</div>' : '');
}

function thegem_build_icon_shortcode($atts) {
	extract(shortcode_atts(array(
		'icon_pack' => 'elegant',
		'icon' => '',
		'icon_shape' => 'square',
		'icon_style' => '',
		'icon_elegant' => '',
		'icon_material' => '',
		'icon_fontawesome' => '',
		'icon_userpack' => '',
		'icon_color' => '',
		'icon_color_2' => '',
		'icon_background_color' => '',
		'icon_border_color' => '',
		'icon_size' => 'small',
		'icon_opacity' => '1',
		'icon_link' => '',
		'icon_link_target' => '_self',
		'css_style' => ''
	), $atts, 'gem_icon'));
	if($icon_pack =='elegant'  && $icon_elegant) {
		$icon = $icon_elegant;
	}
	if($icon_pack =='material' && $icon_material) {
		$icon = $icon_material;
	}
	if($icon_pack =='fontawesome' && $icon_fontawesome) {
		$icon = $icon_fontawesome;
	}
	if($icon_pack =='userpack' && $icon_userpack) {
		$icon = $icon_userpack;
	}
	$icon_shortcode = '[gem_icon pack="'.$icon_pack.
		'" icon="'.$icon.
		'" shape="'.$icon_shape.
		'" style="'.$icon_style.
		'" color="'.$icon_color.
		'" color_2="'.$icon_color_2.
		'" background_color="'.$icon_background_color.
		'" border_color="'.$icon_border_color.
		'" size="'.$icon_size.
		'" opacity="'.$icon_opacity.
		'" link="'.$icon_link.
		'" link_target="'.$icon_link_target.
		'" css_style="'.$css_style.'"]';
	return $icon_shortcode;
}

function thegem_build_icon_with_title_shortcode($atts) {
	extract(shortcode_atts(array(
		'icon_pack' => '',
		'icon' => '',
		'icon_elegant' => '',
		'icon_material' => '',
		'icon_fontawesome' => '',
		'icon_userpack' => '',
		'icon_shape' => 'circle',
		'icon_style' => '',
		'icon_color' => '',
		'icon_color_2' => '',
		'icon_background_color' => '',
		'icon_border_color' => '',
		'icon_size' => 'small',
		'title' => '',
		'level' => 'h6',
		'title_color' => '',

	), $atts, 'gem_icon'));
	$icon_shortcode = '[gem_icon pack="'.$icon_pack.
		'" icon="'.$icon.
		'" shape="'.$icon_shape.
		'" style="'.$icon_style.
		'" color="'.$icon_color.
		'" color_2="'.$icon_color_2.
		'" background_color="'.$icon_background_color.
		'" border_color="'.$icon_border_color.
		'" size="'.$icon_size;
	return $icon_shortcode;
}

function thegem_icon_with_title_shortcode($atts) {
	extract(shortcode_atts(array(
		'icon_pack' => '',
		'icon' => '',
		'link' => '',
		'icon_elegant' => '',
		'icon_material' => '',
		'icon_fontawesome' => '',
		'icon_userpack' => '',
		'icon_shape' => 'circle',
		'icon_style' => '',
		'icon_color' => '',
		'icon_color_2' => '',
		'icon_background_color' => '',
		'icon_border_color' => '',
		'icon_size' => 'small',
		'title' => '',
		'level' => 'h1',
		'title_color' => '',

	), $atts, 'gem_icon_with_title'));

	$level = thegem_check_array_value(array('h1','h2','h3','h4','h5','h6'), $level, 'h1');
	$icon_size = thegem_check_array_value(array('small', 'medium', 'large', 'xlarge'), $icon_size, 'small');
	$css_style = '';
	if($title_color) {
		$css_style = 'color: '.$title_color.';';
	}
	if($link) {
		$linkstart = '<a href=' . $link . '>';
		$linkend = '</a>';
	}

	$return_html = '<div class="gem-icon-with-title-icon">'.do_shortcode(thegem_build_icon_shortcode($atts)).'</div>';
	$return_html .= '<div class="gem-iconed-title"><'.$level.' style="'.$css_style.'">'. $linkstart . $title . $linkend . '</'.$level.'></div>';
	$return_html = '<div class=" gem-icon-with-title  gem-icon-with-title-icon-size-'.$icon_size.'">' .$linkstart . $return_html . $linkend .'</div>';
	return $return_html;
}

function thegem_icon_with_text_shortcode($atts, $content) {
	extract(shortcode_atts(array(
		'pack' => '',
		'icon' => '',
		'icon_shape' => 'square',
		'icon_style' => '',
		'icon_color' => '',
		'icon_color_2' => '',
		'icon_background_color' => '',
		'icon_border_color' => '',
		'icon_size' => 'small',
		'title' => '',
		'level' => 'h6',
		'flow' => '',
		'centered' => '',
		'title_color' => '',
		'icon_bottom_margin' => '0',
		'icon_top_margin' => '0',
		'icon_top_side_padding' => '0',
		'icon_right_side_padding' => '0',
		'icon_bottom_side_padding' => '0',
		'icon_left_side_padding'=> '0',
		'float_right' => ''

	), $atts, 'gem_icon_with_text'));
	if($title_color) {
		$css_style = 'color: '.$title_color.';';
	}
	$css_style_padding= "";
	if($icon_top_side_padding) {
		$css_style_padding .= 'padding-top: '.$icon_top_side_padding.'px;';
	}
	if($icon_right_side_padding) {
		$css_style_padding .= 'padding-right: '.$icon_right_side_padding.'px;';
	}
	if($icon_bottom_side_padding) {
		$css_style_padding .= 'padding-bottom: '.$icon_bottom_side_padding.'px;';
	}
	if($icon_left_side_padding) {
		$css_style_padding .= 'padding-left: '.$icon_left_side_padding.'px;';
	}


	$icon_size = thegem_check_array_value(array('small', 'medium', 'large', 'xlarge'), $icon_size, 'small');
	$return_html = '<div style="margin-bottom:' .$icon_bottom_margin. 'px;' .$css_style_padding. 'margin-top:' .$icon_top_margin. 'px; " class="gem-icon-with-text-icon">' .do_shortcode(thegem_build_icon_shortcode($atts)). '</div>';
	$return_html .= '<div class="gem-icon-with-text-content" >';
	if($title) {
		$return_html .= '<div class="gem-icon-with-text-empty"></div>';
	}
	$return_html .= '<div class="gem-icon-with-text-text">'.do_shortcode($content).'</div></div>';
	$return_html = '<div class="gem-icon-with-text gem-icon-with-text-icon-size-'.$icon_size.($centered ? ' centered-box' : '').($float_right ? ' gem-icon-with-text-float-right' : '').($flow ? ' gem-icon-with-text-flow' : '').'">'.$return_html.'<div class="clearboth"></div></div>';
	return $return_html;
}

function thegem_alert_box_shortcode($atts, $content) {
	extract(shortcode_atts(array(
		'content_text_color' => '',
		'content_background_color' => '#f4f6f7',
		'content_background_image' => '',
		'content_background_style' => '',
		'content_background_position_horizontal' => 'center',
		'content_background_position_vertical' => 'top',
		'border_width' => '0',
		'border_color' => '',
		'border_radius' => '0',
		'rectangle_corner' => '',
		'top_style' => 'default',
		'bottom_style' => 'default',
		'image' => '',
		'icon_pack' => 'elegant',
		'icon_shape' => 'square',
		'icon_style' => '',
		'icon_elegant' => '',
		'icon_material' => '',
		'icon_fontawesome' => '',
		'icon_userpack' => '',
		'icon_color' => '',
		'icon_color_2' => '',
		'icon_background_color' => '',
		'icon_border_color' => '',
		'icon_size' => 'small',
		'icon_opacity' => '1',

		'button_1_text' => '',
		'button_1_link' => '',
		'button_1_style' => 'flat',
		'button_1_size' => 'small',
		'button_1_text_weight' => 'normal',
		'button_1_no_uppercase' => 0,
		'button_1_corner' => 3,
		'button_1_border' => 2,
		'button_1_text_color' => '',
		'button_1_background_color' => '',
		'button_1_border_color' => '',
		'button_1_hover_text_color' => '',
		'button_1_hover_background_color' => '',
		'button_1_hover_border_color' => '',
		'button_1_icon_pack' => 'elegant',
		'button_1_icon_elegant' => '',
		'button_1_icon_material' => '',
		'button_1_icon_fontawesome' => '',
		'button_1_icon_userpack' => '',

		'button_2_activate' => 0,
		'button_2_text' => '',
		'button_2_link' => '',
		'button_2_style' => 'flat',
		'button_2_size' => 'small',
		'button_2_text_weight' => 'normal',
		'button_2_no_uppercase' => 0,
		'button_2_corner' => 3,
		'button_2_border' => 2,
		'button_2_text_color' => '',
		'button_2_background_color' => '',
		'button_2_border_color' => '',
		'button_2_hover_text_color' => '',
		'button_2_hover_background_color' => '',
		'button_2_hover_border_color' => '',
		'button_2_icon_pack' => 'elegant',
		'button_2_icon_elegant' => '',
		'button_2_icon_material' => '',
		'button_2_icon_fontawesome' => '',
		'button_2_icon_userpack' => '',

		'centered' => '',
	), $atts, 'gem_alert_box'));
	$atts = is_array($atts) ? $atts : array();
	$button1 = array();
	foreach($atts as $key => $value) {
		if(substr($key, 0, 9) == 'button_1_') {
			$button1[substr($key, 9)] = $value;
		}
	}
	if($centered) {
		$button1['position'] = 'inline';
	} else {
		$button1['position'] = 'center';
	}
	$button2 = array();
	if($button_2_activate) {
		foreach($atts as $key => $value) {
			if(substr($key, 0, 9) == 'button_2_') {
				$button2[substr($key, 9)] = $value;
			}
		}
		if($centered) {
			$button2['position'] = 'inline';
		} else {
			$button2['position'] = 'center';
		}
	}

	$ab_buttons = '<div class="gem-alert-box-buttons">'.thegem_button_shortcode($button1).($button_2_activate ? thegem_button_shortcode($button2) : '').'</div>';

	$ab_picture = '';
	if($image && $icon_pack == 'image') {
		$image_thumb = thegem_generate_thumbnail_src($image, 'thegem-person');
		$scrset = array();
		if (!empty($icon_size)) {
			switch ($icon_size) {
				case 'small':
				case 'medium':
					thegem_add_srcset_rule($scrset, '1x', 'thegem-person-80', $image);
					thegem_add_srcset_rule($scrset, '2x', 'thegem-person-160', $image);
					break;

				case 'large':
					thegem_add_srcset_rule($scrset, '1x', 'thegem-person-160', $image);
					thegem_add_srcset_rule($scrset, '2x', 'thegem-person', $image);
					break;

				case 'xlarge':
					thegem_add_srcset_rule($scrset, '1x', 'thegem-person-240', $image);
					thegem_add_srcset_rule($scrset, '2x', 'thegem-person', $image);
					break;
			}
			if (!empty($scrset)) {
				$srcset_condtions = array();
				foreach ($scrset as $condition => $condition_url) {
					$srcset_condtions[] = esc_url($condition_url) . ' ' . $condition;
				}
				$scrset = implode(', ', $srcset_condtions);
			}
		}
		$ab_picture = '<div class="gem-alert-box-picture"><div class="gem-alert-box-image image-size-'.$icon_size.' image-shape-'.$icon_shape.'"><img src="'.$image_thumb[0].'" alt="#" class="img-responsive" ' . ($scrset != '' ? 'srcset="' . $scrset . '"' : '') .' /></div></div>';
	}
	if(($icon_pack =='elegant' && $icon_elegant) || ($icon_pack =='material' && $icon_material) || ($icon_pack =='fontawesome' && $icon_fontawesome) || ($icon_pack =='userpack' && $icon_userpack)) {
		$ab_picture = '<div class="gem-alert-box-picture">'.do_shortcode(thegem_build_icon_shortcode($atts)).'</div>';
	}

	$ab_content = '<div class="gem-alert-box-content">'.do_shortcode($content).'</div>';

	$return_html = '<div class="gem-alert-box'.($centered ? ' centered-box' : '').'"><div class="gem-alert-inner">'.$ab_picture.$ab_content.$ab_buttons.'</div></div>';

	$return_html = thegem_textbox_shortcode(array_diff_key($atts, array_diff_key($atts, array(
		'content_text_color' => '',
		'content_background_color' => '#f4f6f7',
		'content_background_image' => '',
		'content_background_style' => '',
		'content_background_position_horizontal' => 'center',
		'content_background_position_vertical' => 'top',
		'border_width' => '0',
		'border_color' => '',
		'border_radius' => '0',
		'rectangle_corner' => '',
		'top_style' => 'default',
		'bottom_style' => 'default',
	))),$return_html);

	return $return_html;
}

function thegem_button_shortcode($atts) {
	extract(shortcode_atts(array(
		'text' => '',
		'link' => '',
		'style' => 'flat',
		'size' => 'small',
		'text_weight' => 'normal',
		'no_uppercase' => 0,
		'corner' => 3,
		'border' => 2,
		'position' => 'inline',
		'text_color' => '',
		'background_color' => '',
		'border_color' => '',
		'hover_text_color' => '',
		'hover_background_color' => '',
		'hover_border_color' => '',
		'icon_pack' => 'elegant',
		'icon_elegant' => '',
		'icon_material' => '',
		'icon_fontawesome' => '',
		'icon_userpack' => '',
		'icon_position' => 'left',
		'separator' => '',
		'extra_class' => '',
		'effects_enabled' => false
	), $atts, 'gem_button'));
	$link = ( '||' === $link ) ? '' : $link;
	if($link === 'post_link') {
		$a_href = $link;
		$a_title = '';
		$a_target = '';
	} else {
		$link = vc_build_link( $link );
		$a_href = $link['url'];
		$a_title = $link['title'];
		$a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
	}
	$icon = '';
	if($icon_elegant && $icon_pack == 'elegant') {
		$icon = $icon_elegant;
	}
	if($icon_material && $icon_pack == 'material') {
		$icon = $icon_material;
	}
	if($icon_fontawesome && $icon_pack == 'fontawesome') {
		$icon = $icon_fontawesome;
	}
	if($icon_userpack && $icon_pack == 'userpack') {
		$icon = $icon_userpack;
	}
	return thegem_button(array(
		'text' => $text,
		'href' => $a_href,
		'target' => $a_target,
		'title' => $a_title,
		'style' => $style,
		'size' => $size,
		'text_weight' => $text_weight,
		'no-uppercase' => $no_uppercase,
		'corner' => $corner,
		'border' => $border,
		'position' => $position,
		'text_color' => $text_color,
		'background_color' => $background_color,
		'border_color' => $border_color,
		'hover_text_color' => $hover_text_color,
		'hover_background_color' => $hover_background_color,
		'hover_border_color' => $hover_border_color,
		'icon_pack' => $icon_pack,
		'icon' => $icon,
		'icon_position' => $icon_position,
		'separator' => $separator,
		'extra_class' => $extra_class,
		'effects_enabled' => $effects_enabled
	));
}

function thegem_dropcap_shortcode($atts) {
	extract(shortcode_atts(array(
		'letter' => '',
		'shape' => 'square',
		'color' => '',
		'style' => 'medium',
		'background_color' => '',
		'border_color' => '',
	), $atts, 'gem_dropcap'));
	$shape = thegem_check_array_value(array('circle', 'square', 'hexagon'), $shape, 'circle');
	$style = thegem_check_array_value(array('medium', 'big'), $style, 'medium');
	$css_style = '';
	if($color) {
		$css_style .= 'color: '.$color.';';
	}
	if($background_color) {
		$css_style .= 'background-color: '.$background_color.';';
	}
	if($border_color) {
		$css_style .= 'border: 1px solid '.$border_color.';';
	}
	$letter = substr($letter,0,1);
	$return_html =


		'<div class="gem-dropcap gem-dropcap-shape-'.$shape.' gem-dropcap-style-'.$style.'">'.
		($shape == 'hexagon' ? '<div class="dropcap-hexagon-inner"><div class="gem-dropcap-shape-hexagon-back"><div class="gem-dropcap-shape-hexagon-back-inner"><div class="gem-dropcap-shape-hexagon-back-inner-before" style="background-color: '.($border_color ? $border_color : $background_color).'"></div></div></div><div class="gem-dropcap-shape-hexagon-top"><div class="gem-dropcap-shape-hexagon-top-inner"><div class="gem-dropcap-shape-hexagon-top-inner-before" style="background-color:'.$background_color.'"></div></div></div></div>' : '').

		'<span class="gem-dropcap-letter" style="'.$css_style.'">'.$letter.'</span></div>';


	return $return_html;
}

function thegem_counter_box_shortcode($atts, $content) {
	extract(shortcode_atts(array(
		'style' => 1,
		'columns' => 4,
		'connector_color' => '',
		'effects_enabled' => false,
		'team_person' => '',
		'team_image_size' => 'small',
		'number_format' => ''
	), $atts, 'gem_counter_box'));
	if(thegem_is_plugin_active('js_composer/js_composer.php')) {
		global $vc_manager;
		if($vc_manager->mode() == 'admin_frontend_editor' || $vc_manager->mode() == 'admin_page' || $vc_manager->mode() == 'page_editable') {
			$effects_enabled = false;
		}
	}
	wp_enqueue_style('odometr');
	wp_enqueue_script('thegem-counters-effects');
	$style = thegem_check_array_value(array(1, 2, 'vertical') ,$style, 1);
	$content = str_replace('[gem_counter ', '[gem_counter use_style="'.$style.'" ',$content);
	$number_format = $number_format ? $number_format : '(ddd).ddd';
	if($style == 'vertical') {
		$team_html = '';
		if($team_person) {
			$team_image_size = thegem_check_array_value(array('small', 'medium', 'large', 'xlarge'), $team_image_size, 'small');
			ob_start();
			thegem_team(array('team_person' => $team_person, 'style' => 'style-counter', 'columns' => 1, 'team_image_size' => $team_image_size));
			$team_html = '<div class="gem-counter-team image-size-'.esc_attr($team_image_size).'">'.trim(preg_replace('/\s\s+/', ' ', ob_get_clean())).'</div>';
		}
		$content = str_replace('[gem_counter ', '[gem_counter connector_color="'.$connector_color.'" ',$content);
		return '<div data-number-format="'.$number_format.'" class="gem-counter-box gem-counter-style-' . $style . ($effects_enabled ? ' lazy-loading lazy-loading-not-hide' : '') . '" ' . ($effects_enabled ? 'data-ll-item-delay="0"' : '') . '>'.$team_html.'<div class="gem-counters-list">'.do_shortcode($content).'</div></div>';
	} else {
		$content = str_replace('[gem_counter ', '[gem_counter columns="'.$columns.'" ',$content);
		return '<div data-number-format="'.$number_format.'" class="gem-counter-box row inline-row inline-row-center gem-counter-style-' . $style . ($effects_enabled ? ' lazy-loading lazy-loading-not-hide' : '') . '" ' . ($effects_enabled ? 'data-ll-item-delay="0"' : '') . '>'.do_shortcode($content).'</div>';
	}
}

function thegem_vc_get_team_persons() {
	$persons = get_posts(array(
		'post_type' => 'thegem_team_person',
		'posts_per_page' => -1,
		'orderby' => 'title',
		'order' => 'ASC',
	));
	$team_persons = array(__('None', 'thegem') => '');
	foreach($persons as $person) {
		$team_persons[$person->post_title.' (ID='.$person->ID.')'] = $person->ID;
	}
	return $team_persons;
}

function thegem_counter_shortcode($atts) {
	extract(shortcode_atts(array(
		'from' => '0',
		'to' => '100',
		'text' => '',
		'icon_pack' => 'elegant',
		'icon_shape' => '',
		'icon_style' => '',
		'icon_elegant' => '',
		'icon_material' => '',
		'icon_fontawesome' => '',
		'icon_userpack' => '',
		'icon_color' => '',
		'icon_color_2' => '',
		'icon_background_color' => '',
		'icon_border_color' => '',
		'icon_size' => 'small',
		'icon_opacity' => '1',
		'background_color' => '',
		'numbers_color' => '',
		'text_color' => '',
		'suffix' => '',
		'use_style' =>'',
		'columns' => 4,
		'connector_color' => '',
		'link' => '',
		'hover_icon_color' => '',
		'hover_background_color' => '',
		'hover_numbers_color' => '',
		'hover_text_color' => '',
	), $atts, 'gem_counter'));

	if(thegem_is_plugin_active('js_composer/js_composer.php')) {
		global $vc_manager;
		if($vc_manager->mode() == 'admin_frontend_editor' || $vc_manager->mode() == 'admin_page' || $vc_manager->mode() == 'page_editable') {
			return '<div class="counter-shortcode-dummy"></div>';
		}
	}
	$return_html = '';
	$circle_border = '';
	if($use_style == 2) {
		$circle_border = $icon_border_color ? $icon_border_color : '#ffffff';
		$background_color = '';
		$hover_background_color = '';
		$atts['icon_background_color'] = '';
		$atts['icon_border_color'] = '';
	}
	if($use_style == 'vertical') {
		$atts['icon_background_color'] = $icon_background_color ? $icon_background_color : ($background_color ? $background_color : '#ffffff');
	}

	$link = ( '||' === $link ) ? '' : $link;
	$link = vc_build_link( $link );
	$a_href = $link['url'];
	$a_title = $link['title'];
	$a_target = strlen( $link['target'] ) > 0 ? trim($link['target']) : '_self';

	$hover_data = '';
	$link_html = '';
	if($a_href) {
		$link_html = '<a class="gem-counter-link" href="'.esc_url($a_href).'"'.($a_title ? ' title="'.esc_attr($a_title).'"' : '').($a_target ? ' target="'.esc_attr($a_target).'"' : '').'></a>';
		if($hover_icon_color) {
			$hover_data .= ' data-hover-icon-color="'.$hover_icon_color.'"';
		}
		if($hover_background_color) {
			$hover_data .= ' data-hover-background-color="'.$hover_background_color.'"';
		}
		if($hover_numbers_color) {
			$hover_data .= ' data-hover-numbers-color="'.$hover_numbers_color.'"';
		}
		if($hover_text_color) {
			$hover_data .= ' data-hover-text-color="'.$hover_text_color.'"';
		}
	}

	$counter_effect = 'gem-counter-effect-';
	if(!empty($atts['icon_background_color'])) {
		$counter_effect .= 'background-reverse';
	} elseif(!empty($atts['icon_border_color'])) {
		$counter_effect .= 'border-reverse';
	} else {
		$counter_effect .= 'simple';
	}

	if(($icon_pack =='elegant' && $icon_elegant) || ($icon_pack =='material' && $icon_material) || ($icon_pack =='fontawesome' && $icon_fontawesome) || ($icon_pack =='userpack' && $icon_userpack)) {
		$icon_html = do_shortcode(thegem_build_icon_shortcode($atts));
		if($use_style == 2) {
			$return_html .= '<div class="gem-counter-icon"><div class="gem-counter-icon-circle-1" style="border-color: '.esc_attr($circle_border).';"><div class="gem-counter-icon-circle-2" style="border-color: '.esc_attr($circle_border).';">'.$icon_html.'</div></div></div>';
		} else {
			$return_html .= '<div class="gem-counter-icon">'.$icon_html.'</div>';
		}
	}
	$return_html .= '<div class="gem-counter-number"'.($numbers_color ? ' style="color: '.esc_attr($numbers_color).'"' : '').'><div class="gem-counter-odometer" data-to="'.$to.'">'.$from.'</div>'.($suffix ? '<span class="gem-counter-suffix">'.$suffix.'</span>' : '').'</div>';
	if($text) {
		$return_html .= '<div class="gem-counter-text styled-subtitle"'.($text_color ? ' style="color: '.esc_attr($text_color).'"' : '').'>'.$text.'</div>';
	}

	$counter_bottom = '';
	if($use_style == 1 && $background_color) {
		$counter_bottom = '<div class="gem-counter-bottom"><div class="gem-counter-bottom-left" style="background-color: '.$background_color.';"></div><svg width="20" height="10" style="fill: '.$background_color.';"><path d="M 0,0 0,10 2,10 C 2,-2 18,-2, 18,10 L 20,10 20,0 " /></svg><div class="gem-counter-bottom-right" style="background-color: '.$background_color.';"></div></div>';
	}

	if($use_style == 'vertical') {
		$icon_size = thegem_check_array_value(array('small', 'medium', 'large', 'xlarge'), $icon_size, 'small');
		return '<div class="gem-counter gem-counter-size-'.esc_attr($icon_size).' '.$counter_effect.'"'.$hover_data.'><div class="gem-counter-connector"'.($connector_color ? ' style="background-color: '.esc_attr($connector_color).'"' : '').'></div><div class="gem-counter-inner"'.($background_color ? ' style="background-color: '.esc_attr($background_color).'"' : '').'>'.$return_html.'</div>'.$link_html.'</div>';
	} else {
		$columns_class = 'col-md-3 col-sm-4 col-xs-6';
		if($columns == 1) {
			$columns_class = 'col-xs-12';
		} elseif($columns == 2) {
			$columns_class = 'col-sm-6 col-xs-12';
		} elseif($columns == 3) {
			$columns_class = 'col-md-4 col-sm-6 col-xs-12';
		}
		return '<div class="gem-counter '.$columns_class.' inline-column '.$counter_effect.'"'.$hover_data.'><div class="gem-counter-inner"'.($background_color ? ' style="background-color: '.esc_attr($background_color).'"' : '').'>'.$return_html.$counter_bottom.$link_html.'</div></div>';
	}
}

function thegem_news_shortcode($atts) {
	extract(shortcode_atts(array(
		'post_types' => '',
		'justified_style' => '',
		'slider_style' => '',
		'slider_autoscroll' => 0,
		'style' => '',
		'categories' => '',
		'post_per_page' => '',
		'post_pagination' => '',
		'ignore_sticky' => '',
		'effects_enabled' => 0,
		'hide_date' => 0,
		'hide_author' => 0,
		'hide_comments' => 0,
		'hide_likes' => 0,
		'loading_animation' => 'move-up',
	), $atts, 'gem_news'));

	$button_params = array();
	foreach((array)$atts as $key => $value) {
		if(substr($key, 0, 7) == 'button_') {
			$button_params[substr($key, 7)] = $value;
		}
	}

	ob_start();
	thegem_blog(array(
		'blog_post_types' => $post_types ? explode(',', $post_types) : array('post', 'thegem_news'),
		'blog_style' => $style,
		'justified_style' => $justified_style,
		'slider_style' => $slider_style,
		'slider_autoscroll' => $slider_autoscroll,
		'blog_categories' => $categories,
		'blog_post_per_page' => $post_per_page,
		'blog_pagination' => $post_pagination,
		'blog_ignore_sticky' => $ignore_sticky,
		'effects_enabled' => $effects_enabled,
		'hide_date' => $hide_date,
		'hide_author' => $hide_author,
		'hide_likes' => $hide_likes,
		'hide_comments' => $hide_comments,
		'loading_animation' => $loading_animation,
		'button' => $button_params
	));
	$return_html = trim(preg_replace('/\s\s+/', ' ', ob_get_clean()));
	return $return_html;
}

function thegem_clients_shortcode($atts) {
	extract(shortcode_atts(array(
		'set' => '',
		'style' => '',
		'rows' => '3',
		'cols' => '3',
		'autoscroll' => '',
		'fullwidth' => '',
		'disable_grayscale' => false,
		'effects_enabled' => false
	), $atts, 'gem_clients'));

	ob_start();
	if($style == 'carousel') {
		thegem_clients_block(array('disable_grayscale' => $disable_grayscale, 'clients_set' => $set, 'autoscroll' => $autoscroll, 'fullwidth' => $fullwidth, 'effects_enabled' => $effects_enabled));
	} else {
		thegem_clients(array('disable_grayscale' => $disable_grayscale, 'clients_set' => $set, 'rows' => $rows, 'cols' => $cols, 'autoscroll' => $autoscroll, 'effects_enabled' => $effects_enabled));
	}
	$return_html = trim(preg_replace('/\s\s+/', ' ', ob_get_clean()));
	return $return_html;
}

function thegem_testimonials_shortcode($atts) {
	extract(shortcode_atts(array(
		'set' => '',
		'fullwidth' => '',
		'style' => 'style1',
		'image_size' => 'size-small',
		'autoscroll' => 0,
	), $atts, 'gem_testimonials'));
	ob_start();
	thegem_testimonialss(array('testimonials_set' => $set, 'fullwidth' => $fullwidth, 'style' => $style, 'image_size' => $image_size, 'autoscroll' => $autoscroll));


	$return_html = trim(preg_replace('/\s\s+/', ' ', ob_get_clean()));
	return $return_html;
}

function thegem_map_with_text_shortcode($atts, $content) {
	extract(shortcode_atts(array(
		'background_color' => '',
		'color' => '',
		'size' => '',
		'link' => '',
		'grayscale' => '',
		'container' => '',
		'disable_scroll' => '',
		'rounded_corners' => ''
	), $atts, 'gem_map_with_text'));
	$size = str_replace( array( 'px', ' ' ), array( '', '' ), $size );
	$size = $size ? ($size + 46) : '';
	$map = '<div class="gem-map-with-text-map'.($grayscale ? ' grayscale' : '').'">'.do_shortcode('[vc_gmaps'.($link ? ' link="'.$link.'"' : '').' size="'.$size.'" disable_scroll="'.$disable_scroll.'"]').'</div>';
	$css_style = '';
	if($color) {
		$css_style .= 'color: '.$color.';';
	}
	if($background_color) {
		$css_style .= 'background-color: '.$background_color.';';
	}
	$return_html = '<div class="gem-map-with-text'.($rounded_corners ? ' rounded-corners' : '').'"><div class="gem-map-with-text-content" style="'.$css_style.'">'.($container ? '<div class="container">' : '').do_shortcode($content).($container ? '</div>' : '').'</div>'.$map.'</div>';
	return $return_html;
}

function thegem_link($atts) {
	extract(shortcode_atts(array(
		'text' => '',
		'href' => '',
		'class' => '',
		'title' => '',
		'target' => '_self',
	), $atts, 'gem_link'));
	$return_html = '<a';
	if($href) {
		$return_html .= ' href="'.esc_url($href).'"';
	}
	if($class) {
		$return_html .= ' class="'.esc_attr($href).'"';
	}
	if($title) {
		$return_html .= ' title="'.esc_attr($title).'"';
	}
	$target = thegem_check_array_value(array('_self', '_blank'), $target, '_self');
	$return_html .= ' target="'.esc_attr($target).'"';
	$return_html .= '>'.esc_html($text).'</a>';
	return $return_html;
}

function print_filters_for( $hook = '' ) {
	global $wp_filter;
	if( empty( $hook ) || !isset( $wp_filter[$hook] ) )
		return;

	$output = '<pre>';
	$output .= print_r( $wp_filter[$hook],1 );
	$output .= '</pre>';
	return $output;
}

function thegem_run_shortcode($content) {
	return $content;
}

if(!thegem_is_plugin_active('js_composer/js_composer.php')) {
	require_once(plugin_dir_path( __FILE__ ) . 'vc_shortcodes/init.php');
}

function thegem_userpack_to_dropdown() {
	return thegem_icon_userpack_enabled() ? array(__('UserPack', 'thegem') => 'userpack') : array();
}
function thegem_userpack_to_shortcode($arr = array()) {
	return thegem_icon_userpack_enabled() ? $arr : array();
}

function thegem_shortcodes() {
	$icons_params = array();
	if(function_exists('vc_map_integrate_shortcode')) {
		$icons_params = vc_map_integrate_shortcode( 'vc_icon', 'i_', '',
			array('include_only_regex' => '/^(type|icon_\w*)/'),
			array(
				'type' => 'add_icon',
				'value' => 'true',
			)
		);
	}

	$shortcodes = array(
		'gem_alert_box' => array(
			'name' => __('Alert Box / CTA', 'thegem'),
			'base' => 'gem_alert_box',
			'is_container' => true,
			'js_view' => 'VcGemAlertBoxView',
			'icon' => 'thegem-icon-wpb-ui-alert-box',
			'category' => __('The Gem', 'thegem'),
			'description' => __('Catch visitors attention with alert box', 'thegem'),
			'params' => array_merge(array(
				array(
					'type' => 'dropdown',
					'heading' => __('Icon pack', 'thegem'),
					'param_name' => 'icon_pack',
					'value' => array_merge(array(__('Elegant', 'thegem') => 'elegant', __('Material Design', 'thegem') => 'material', __('FontAwesome', 'thegem') => 'fontawesome'), thegem_userpack_to_dropdown(),array(__('Image', 'thegem') => 'image')),
				),
				array(
					'type' => 'thegem_icon',
					'heading' => __('Icon', 'thegem'),
					'param_name' => 'icon_elegant',
					'icon_pack' => 'elegant',
					'dependency' => array(
						'element' => 'icon_pack',
						'value' => array('elegant')
					),
				),
				array(
					'type' => 'thegem_icon',
					'heading' => __('Icon', 'thegem'),
					'param_name' => 'icon_material',
					'icon_pack' => 'material',
					'dependency' => array(
						'element' => 'icon_pack',
						'value' => array('material')
					),
				),
				array(
					'type' => 'thegem_icon',
					'heading' => __('Icon', 'thegem'),
					'param_name' => 'icon_fontawesome',
					'icon_pack' => 'fontawesome',
					'dependency' => array(
						'element' => 'icon_pack',
						'value' => array('fontawesome')
					),
				),
			),
			thegem_userpack_to_shortcode(array(
				array(
					'type' => 'thegem_icon',
					'heading' => __('Icon', 'thegem'),
					'param_name' => 'icon_userpack',
					'icon_pack' => 'userpack',
					'dependency' => array(
						'element' => 'icon_pack',
						'value' => array('userpack')
					),
				),
			)),
			array(
				array(
					'type' => 'attach_image',
					'heading' => __('Image', 'thegem'),
					'param_name' => 'image',
					'dependency' => array(
						'element' => 'icon_pack',
						'value' => array('image')
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Icon Shape', 'thegem'),
					'param_name' => 'icon_shape',
					'value' => array(__('Square', 'thegem') => 'square', __('Circle', 'thegem') => 'circle', __('Rhombus', 'thegem') => 'romb', __('Hexagon', 'thegem') => 'hexagon'),
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Icon Style', 'thegem'),
					'param_name' => 'icon_style',
					'value' => array(__('Default', 'thegem') => '', __('45 degree Right', 'thegem') => 'angle-45deg-r', __('45 degree Left', 'thegem') => 'angle-45deg-l', __('90 degree', 'thegem') => 'angle-90deg'),
					'dependency' => array(
						'element' => 'icon_pack',
						'value' => array('elegant', 'material', 'fontawesome', 'userpack')
					),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Icon Color', 'thegem'),
					'param_name' => 'icon_color',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'dependency' => array(
						'element' => 'icon_pack',
						'value' => array('elegant', 'material', 'fontawesome', 'userpack')
					),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Icon Color 2', 'thegem'),
					'param_name' => 'icon_color_2',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'dependency' => array(
						'element' => 'icon_pack',
						'value' => array('elegant', 'material', 'fontawesome', 'userpack')
					),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Icon Background Color', 'thegem'),
					'param_name' => 'icon_background_color',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'dependency' => array(
						'element' => 'icon_pack',
						'value' => array('elegant', 'material', 'fontawesome', 'userpack')
					),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Icon Border Color', 'thegem'),
					'param_name' => 'icon_border_color',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'dependency' => array(
						'element' => 'icon_pack',
						'value' => array('elegant', 'material', 'fontawesome', 'userpack')
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Icon Size', 'thegem'),
					'param_name' => 'icon_size',
					'value' => array(__('Small', 'thegem') => 'small', __('Medium', 'thegem') => 'medium', __('Large', 'thegem') => 'large', __('Extra Large', 'thegem') => 'xlarge'),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Text Color', 'thegem'),
					'param_name' => 'content_text_color',
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Background Color', 'thegem'),
					'param_name' => 'content_background_color',
					'std' => '#f4f6f7'
				),
				array(
					'type' => 'attach_image',
					'heading' => __('Background Image', 'thegem'),
					'param_name' => 'content_background_image',
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Background style', 'thegem'),
					'param_name' => 'content_background_style',
					'value' => array(
						__('Default', 'thegem') => '',
						__('Cover', 'thegem') => 'cover',
						__('Contain', 'thegem') => 'contain',
						__('No Repeat', 'thegem') => 'no-repeat',
						__('Repeat', 'thegem') => 'repeat'
					)
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Background horizontal position', 'thegem'),
					'param_name' => 'content_background_position_horizontal',
					'value' => array(
						__('Center', 'thegem') => 'center',
						__('Left', 'thegem') => 'left',
						__('Right', 'thegem') => 'right'
					)
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Background vertical position', 'thegem'),
					'param_name' => 'content_background_position_vertical',
					'value' => array(
						__('Top', 'thegem') => 'top',
						__('Center', 'thegem') => 'center',
						__('Bottom', 'thegem') => 'bottom'
					)
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Border Color', 'thegem'),
					'param_name' => 'border_color',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Border Width (px)', 'thegem'),
					'param_name' => 'border_width',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Border Radius (px)', 'thegem'),
					'param_name' => 'border_radius',
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Rectangle Corner', 'thegem'),
					'param_name' => 'rectangle_corner',
					'value' => array(
						__('Left Top', 'thegem') => 'lt',
						__('Right Top', 'thegem') => 'rt',
						__('Right Bottom', 'thegem') => 'rb',
						__('Left Bottom', 'thegem') => 'lb'
					)
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Top Arеа Style', 'thegem'),
					'param_name' => 'top_style',
					'value' => array(
						__('Default', 'thegem') => 'default',
						__('Flag', 'thegem') => 'flag',
						__('Shield', 'thegem') => 'shield',
						__('Ticket', 'thegem') => 'ticket',
						__('Sentence', 'thegem') => 'sentence',
						__('Note 1', 'thegem') => 'note-1',
						__('Note 2', 'thegem') => 'note-2',
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Bottom Arеа Style', 'thegem'),
					'param_name' => 'bottom_style',
					'value' => array(
						__('Default', 'thegem') => 'default',
						__('Flag', 'thegem') => 'flag',
						__('Shield', 'thegem') => 'shield',
						__('Ticket', 'thegem') => 'ticket',
						__('Sentence', 'thegem') => 'sentence',
						__('Note 1', 'thegem') => 'note-1',
						__('Note 2', 'thegem') => 'note-2',
					),
				),

				array(
					'type' => 'textfield',
					'heading' => __('Button Text', 'thegem'),
					'param_name' => 'button_1_text',
					'group' => __('Button 1', 'thegem'),
				),
				array(
					'type' => 'vc_link',
					'heading' => __( 'URL (Link)', 'thegem' ),
					'param_name' => 'button_1_link',
					'description' => __( 'Add link to button.', 'thegem' ),
					'group' => __('Button 1', 'thegem')
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Style', 'thegem'),
					'param_name' => 'button_1_style',
					'value' => array(__('Flat', 'thegem') => 'flat', __('Outline', 'thegem') => 'outline'),
					'group' => __('Button 1', 'thegem')
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Size', 'thegem'),
					'param_name' => 'button_1_size',
					'value' => array(__('Tiny', 'thegem') => 'tiny', __('Small', 'thegem') => 'small', __('Medium', 'thegem') => 'medium', __('Large', 'thegem') => 'large', __('Giant', 'thegem') => 'giant'),
					'std' => 'small',
					'group' => __('Button 1', 'thegem')
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Text weight', 'thegem'),
					'param_name' => 'button_1_text_weight',
					'value' => array(__('Normal', 'thegem') => 'normal', __('Thin', 'thegem') => 'thin'),
					'group' => __('Button 1', 'thegem')
				),
				array(
					'type' => 'checkbox',
					'heading' => __('No uppercase', 'thegem'),
					'param_name' => 'button_1_no_uppercase',
					'value' => array(__('Yes', 'thegem') => '1'),
					'group' => __('Button 1', 'thegem')
				),
				array(
					'type' => 'textfield',
					'heading' => __('Border radius', 'thegem'),
					'param_name' => 'button_1_corner',
					'value' => 3,
					'group' => __('Button 1', 'thegem')
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Border width', 'thegem'),
					'param_name' => 'button_1_border',
					'value' => array(1, 2, 3, 4, 5, 6),
					'std' => 2,
					'dependency' => array(
						'element' => 'button_1_style',
						'value' => array('outline')
					),
					'group' => __('Button 1', 'thegem')
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Text color', 'thegem'),
					'param_name' => 'button_1_text_color',
					'group' => __('Button 1', 'thegem')
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Hover text color', 'thegem'),
					'param_name' => 'button_1_hover_text_color',
					'group' => __('Button 1', 'thegem')
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Background color', 'thegem'),
					'param_name' => 'button_1_background_color',
					'dependency' => array(
						'element' => 'button_1_style',
						'value' => array('flat')
					),
					'group' => __('Button 1', 'thegem')
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Hover background color', 'thegem'),
					'param_name' => 'button_1_hover_background_color',
					'group' => __('Button 1', 'thegem')
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Border color', 'thegem'),
					'param_name' => 'button_1_border_color',
					'dependency' => array(
						'element' => 'button_1_style',
						'value' => array('outline')
					),
					'group' => __('Button 1', 'thegem')
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Hover border color', 'thegem'),
					'param_name' => 'button_1_hover_border_color',
					'dependency' => array(
						'element' => 'button_1_style',
						'value' => array('outline')
					),
					'group' => __('Button 1', 'thegem')
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Icon pack', 'thegem'),
					'param_name' => 'button_1_icon_pack',
					'value' => array_merge(array(__('Elegant', 'thegem') => 'elegant', __('Material Design', 'thegem') => 'material', __('FontAwesome', 'thegem') => 'fontawesome'), thegem_userpack_to_dropdown()),
					'std' => 2,
					'group' => __('Button 1', 'thegem')
				),
				array(
					'type' => 'thegem_icon',
					'heading' => __('Icon', 'thegem'),
					'param_name' => 'button_1_icon_elegant',
					'icon_pack' => 'elegant',
					'dependency' => array(
						'element' => 'button_1_icon_pack',
						'value' => array('elegant')
					),
					'group' => __('Button 1', 'thegem')
				),
				array(
					'type' => 'thegem_icon',
					'heading' => __('Icon', 'thegem'),
					'param_name' => 'button_1_icon_material',
					'icon_pack' => 'material',
					'dependency' => array(
						'element' => 'button_1_icon_pack',
						'value' => array('material')
					),
					'group' => __('Button 1', 'thegem')
				),
				array(
					'type' => 'thegem_icon',
					'heading' => __('Icon', 'thegem'),
					'param_name' => 'button_1_icon_fontawesome',
					'icon_pack' => 'fontawesome',
					'dependency' => array(
						'element' => 'button_1_icon_pack',
						'value' => array('fontawesome')
					),
					'group' => __('Button 1', 'thegem')
				),
			),
			thegem_userpack_to_shortcode(array(
				array(
					'type' => 'thegem_icon',
					'heading' => __('Icon', 'thegem'),
					'param_name' => 'button_1_icon_userpack',
					'icon_pack' => 'userpack',
					'dependency' => array(
						'element' => 'button_1_icon_pack',
						'value' => array('userpack')
					),
				),
			)),
			array(
				array(
					'type' => 'dropdown',
					'heading' => __( 'Icon position', 'thegem' ),
					'param_name' => 'button_1_icon_position',
					'value' => array(__( 'Left', 'thegem' ) => 'left', __( 'Right', 'thegem' ) => 'right'),
					'group' => __('Button 1', 'thegem')
				),

				array(
					'type' => 'checkbox',
					'heading' => __('Activate Button', 'thegem'),
					'param_name' => 'button_2_activate',
					'value' => array(__('Yes', 'thegem') => '1'),
					'group' => __('Button 2', 'thegem')
				),
				array(
					'type' => 'textfield',
					'heading' => __('Button Text', 'thegem'),
					'param_name' => 'button_2_text',
					'group' => __('Button 2', 'thegem'),
					'dependency' => array(
						'element' => 'button_2_activate',
						'not_empty' => true
					),
				),
				array(
					'type' => 'vc_link',
					'heading' => __( 'URL (Link)', 'thegem' ),
					'param_name' => 'button_2_link',
					'description' => __( 'Add link to button.', 'thegem' ),
					'dependency' => array(
						'element' => 'button_2_activate',
						'not_empty' => true
					),
					'group' => __('Button 2', 'thegem')
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Style', 'thegem'),
					'param_name' => 'button_2_style',
					'value' => array(__('Flat', 'thegem') => 'flat', __('Outline', 'thegem') => 'outline'),
					'dependency' => array(
						'element' => 'button_2_activate',
						'not_empty' => true
					),
					'group' => __('Button 2', 'thegem')
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Size', 'thegem'),
					'param_name' => 'button_2_size',
					'value' => array(__('Tiny', 'thegem') => 'tiny', __('Small', 'thegem') => 'small', __('Medium', 'thegem') => 'medium', __('Large', 'thegem') => 'large', __('Giant', 'thegem') => 'giant'),
					'std' => 'small',
					'dependency' => array(
						'element' => 'button_2_activate',
						'not_empty' => true
					),
					'group' => __('Button 2', 'thegem')
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Text weight', 'thegem'),
					'param_name' => 'button_2_text_weight',
					'value' => array(__('Normal', 'thegem') => 'normal', __('Thin', 'thegem') => 'thin'),
					'dependency' => array(
						'element' => 'button_2_activate',
						'not_empty' => true
					),
					'group' => __('Button 2', 'thegem')
				),
				array(
					'type' => 'checkbox',
					'heading' => __('No uppercase', 'thegem'),
					'param_name' => 'button_2_no_uppercase',
					'value' => array(__('Yes', 'thegem') => '1'),
					'dependency' => array(
						'element' => 'button_2_activate',
						'not_empty' => true
					),
					'group' => __('Button 2', 'thegem')
				),
				array(
					'type' => 'textfield',
					'heading' => __('Border radius', 'thegem'),
					'param_name' => 'button_2_corner',
					'value' => 3,
					'dependency' => array(
						'element' => 'button_2_activate',
						'not_empty' => true
					),
					'group' => __('Button 2', 'thegem')
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Border width', 'thegem'),
					'param_name' => 'button_2_border',
					'value' => array(1, 2, 3, 4, 5, 6),
					'std' => 2,
					'dependency' => array(
						'element' => 'button_2_style',
						'value' => array('outline')
					),
					'group' => __('Button 2', 'thegem')
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Text color', 'thegem'),
					'param_name' => 'button_2_text_color',
					'dependency' => array(
						'element' => 'button_2_activate',
						'not_empty' => true
					),
					'group' => __('Button 2', 'thegem')
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Hover text color', 'thegem'),
					'param_name' => 'button_2_hover_text_color',
					'dependency' => array(
						'element' => 'button_2_activate',
						'not_empty' => true
					),
					'group' => __('Button 2', 'thegem')
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Background color', 'thegem'),
					'param_name' => 'button_2_background_color',
					'dependency' => array(
						'element' => 'button_2_style',
						'value' => array('flat')
					),
					'group' => __('Button 2', 'thegem')
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Hover background color', 'thegem'),
					'param_name' => 'button_2_hover_background_color',
					'dependency' => array(
						'element' => 'button_2_activate',
						'not_empty' => true
					),
					'group' => __('Button 2', 'thegem')
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Border color', 'thegem'),
					'param_name' => 'button_2_border_color',
					'dependency' => array(
						'element' => 'button_2_style',
						'value' => array('outline')
					),
					'group' => __('Button 2', 'thegem')
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Hover border color', 'thegem'),
					'param_name' => 'button_2_hover_border_color',
					'dependency' => array(
						'element' => 'button_2_style',
						'value' => array('outline')
					),
					'group' => __('Button 2', 'thegem')
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Icon pack', 'thegem'),
					'param_name' => 'button_2_icon_pack',
					'value' => array_merge(array(__('Elegant', 'thegem') => 'elegant', __('Material Design', 'thegem') => 'material', __('FontAwesome', 'thegem') => 'fontawesome'), thegem_userpack_to_dropdown()),
					'std' => 2,
					'dependency' => array(
						'element' => 'button_2_activate',
						'not_empty' => true
					),
					'group' => __('Button 2', 'thegem')
				),
				array(
					'type' => 'thegem_icon',
					'heading' => __('Icon', 'thegem'),
					'param_name' => 'button_2_icon_elegant',
					'icon_pack' => 'elegant',
					'dependency' => array(
						'element' => 'button_2_icon_pack',
						'value' => array('elegant')
					),
					'group' => __('Button 2', 'thegem')
				),
				array(
					'type' => 'thegem_icon',
					'heading' => __('Icon', 'thegem'),
					'param_name' => 'button_2_icon_material',
					'icon_pack' => 'material',
					'dependency' => array(
						'element' => 'button_2_icon_pack',
						'value' => array('material')
					),
					'group' => __('Button 2', 'thegem')
				),
				array(
					'type' => 'thegem_icon',
					'heading' => __('Icon', 'thegem'),
					'param_name' => 'button_2_icon_fontawesome',
					'icon_pack' => 'fontawesome',
					'dependency' => array(
						'element' => 'button_2_icon_pack',
						'value' => array('fontawesome')
					),
					'group' => __('Button 2', 'thegem')
				),
			),
			thegem_userpack_to_shortcode(array(
				array(
					'type' => 'thegem_icon',
					'heading' => __('Icon', 'thegem'),
					'param_name' => 'button_2_icon_userpack',
					'icon_pack' => 'userpack',
					'dependency' => array(
						'element' => 'button_2_icon_pack',
						'value' => array('userpack')
					),
				),
			)),
			array(
				array(
					'type' => 'dropdown',
					'heading' => __( 'Icon position', 'thegem' ),
					'param_name' => 'button_2_icon_position',
					'value' => array(__( 'Left', 'thegem' ) => 'left', __( 'Right', 'thegem' ) => 'right'),
					'dependency' => array(
						'element' => 'button_2_activate',
						'not_empty' => true
					),
					'group' => __('Button 2', 'thegem')
				),

				array(
					'type' => 'checkbox',
					'heading' => __('Centered', 'thegem'),
					'param_name' => 'centered',
					'value' => array(__('Yes', 'thegem') => '1')
				),
			)),
		),

		'gem_button' => array(
			'name' => __('Button', 'thegem'),
			'base' => 'gem_button',
			'icon' => 'thegem-icon-wpb-ui-button',
			'category' => __('The Gem', 'thegem'),
			'description' => __('Styled button element', 'thegem'),
			'params' => array_merge(array(
				array(
					'type' => 'textfield',
					'heading' => __('Button Text', 'thegem'),
					'param_name' => 'text',
				),
				array(
					'type' => 'vc_link',
					'heading' => __( 'URL (Link)', 'thegem' ),
					'param_name' => 'link',
					'description' => __( 'Add link to button.', 'thegem' )
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Position', 'thegem'),
					'param_name' => 'position',
					'value' => array(__('Inline', 'thegem') => 'inline', __('Left', 'thegem') => 'left', __('Right', 'thegem') => 'right', __('Center', 'thegem') => 'center', __('Fullwidth', 'thegem') => 'fullwidth')
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Style', 'thegem'),
					'param_name' => 'style',
					'value' => array(__('Flat', 'thegem') => 'flat', __('Outline', 'thegem') => 'outline')
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Size', 'thegem'),
					'param_name' => 'size',
					'value' => array(__('Tiny', 'thegem') => 'tiny', __('Small', 'thegem') => 'small', __('Medium', 'thegem') => 'medium', __('Large', 'thegem') => 'large', __('Giant', 'thegem') => 'giant'),
					'std' => 'small'
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Text weight', 'thegem'),
					'param_name' => 'text_weight',
					'value' => array(__('Normal', 'thegem') => 'normal', __('Thin', 'thegem') => 'thin'),
				),
				array(
					'type' => 'checkbox',
					'heading' => __('No uppercase', 'thegem'),
					'param_name' => 'no_uppercase',
					'value' => array(__('Yes', 'thegem') => '1')
				),
				array(
					'type' => 'textfield',
					'heading' => __('Border radius', 'thegem'),
					'param_name' => 'corner',
					'value' => 3,
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Border width', 'thegem'),
					'param_name' => 'border',
					'value' => array(1, 2, 3, 4, 5, 6),
					'std' => 2,
					'dependency' => array(
						'element' => 'style',
						'value' => array('outline')
					),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Text color', 'thegem'),
					'param_name' => 'text_color',
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Hover text color', 'thegem'),
					'param_name' => 'hover_text_color',
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Background color', 'thegem'),
					'param_name' => 'background_color',
					'dependency' => array(
						'element' => 'style',
						'value' => array('flat')
					),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Hover background color', 'thegem'),
					'param_name' => 'hover_background_color',
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Border color', 'thegem'),
					'param_name' => 'border_color',
					'dependency' => array(
						'element' => 'style',
						'value' => array('outline')
					),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Hover border color', 'thegem'),
					'param_name' => 'hover_border_color',
					'dependency' => array(
						'element' => 'style',
						'value' => array('outline')
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Separatot Style', 'thegem'),
					'param_name' => 'separator',
					'value' => array(
						__('None', 'thegem') => '',
						__('Single', 'thegem') => 'single',
						__('Square', 'thegem') => 'square',
						__('Soft Double', 'thegem') => 'soft-double',
						__('Strong Double', 'thegem') => 'strong-double'
					),
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Extra class name', 'thegem' ),
					'param_name' => 'extra_class',
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Icon pack', 'thegem'),
					'param_name' => 'icon_pack',
					'value' => array_merge(array(__('Elegant', 'thegem') => 'elegant', __('Material Design', 'thegem') => 'material', __('FontAwesome', 'thegem') => 'fontawesome'), thegem_userpack_to_dropdown()),
					'std' => 2,
				),
				array(
					'type' => 'thegem_icon',
					'heading' => __('Icon', 'thegem'),
					'param_name' => 'icon_elegant',
					'icon_pack' => 'elegant',
					'dependency' => array(
						'element' => 'icon_pack',
						'value' => array('elegant')
					),
				),
				array(
					'type' => 'thegem_icon',
					'heading' => __('Icon', 'thegem'),
					'param_name' => 'icon_material',
					'icon_pack' => 'material',
					'dependency' => array(
						'element' => 'icon_pack',
						'value' => array('material')
					),
				),
				array(
					'type' => 'thegem_icon',
					'heading' => __('Icon', 'thegem'),
					'param_name' => 'icon_fontawesome',
					'icon_pack' => 'fontawesome',
					'dependency' => array(
						'element' => 'icon_pack',
						'value' => array('fontawesome')
					),
				),
			),
			thegem_userpack_to_shortcode(array(
				array(
					'type' => 'thegem_icon',
					'heading' => __('Icon', 'thegem'),
					'param_name' => 'icon_userpack',
					'icon_pack' => 'userpack',
					'dependency' => array(
						'element' => 'icon_pack',
						'value' => array('userpack')
					),
				),
			)),
			array(
				array(
					'type' => 'dropdown',
					'heading' => __( 'Icon position', 'thegem' ),
					'param_name' => 'icon_position',
					'value' => array(__( 'Left', 'thegem' ) => 'left', __( 'Right', 'thegem' ) => 'right'),
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Lazy loading enabled', 'scalia'),
					'param_name' => 'effects_enabled',
					'value' => array(__('Yes', 'thegem') => '1')
				),
			)),
		),

		'gem_clients' => array(
			'name' => __('Clients', 'thegem'),
			'base' => 'gem_clients',
			'icon' => 'thegem-icon-wpb-ui-clients',
			'category' => __('The Gem', 'thegem'),
			'description' => __('Clients overview inside content', 'thegem'),
			'params' => array_merge(array(
				array(
					'type' => 'dropdown',
					'heading' => __('Style', 'thegem'),
					'param_name' => 'style',
					'value' => array(__('Grid', 'thegem') => 'grid', __('Carousel', 'thegem') => 'carousel')
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Clients Sets', 'thegem'),
					'param_name' => 'set',
					'value' => thegem_vc_get_terms('thegem_clients_sets'),
					'group' =>__('Select Clients Sets', 'thegem'),
					'edit_field_class' => 'thegem-terms-checkboxes'
				),
				array(
					'type' => 'textfield',
					'heading' => __('Autoscroll', 'thegem'),
					'param_name' => 'autoscroll',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Rows', 'thegem'),
					'param_name' => 'rows',
					'value' => '3',
					'dependency' => array(
						'element' => 'style',
						'value' => array('grid')
					),
				),

				array(
					'type' => 'textfield',
					'heading' => __('Cols', 'thegem'),
					'param_name' => 'cols',
					'value' => '3',
					'dependency' => array(
						'element' => 'style',
						'value' => array('grid')
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Fullwidth', 'thegem'),
					'param_name' => 'fullwidth',
					'value' => array(__('Yes', 'thegem') => '1'),
					'dependency' => array(
						'element' => 'style',
						'value' => array('carousel')
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Lazy loading enabled', 'thegem'),
					'param_name' => 'effects_enabled',
					'value' => array(__('Yes', 'thegem') => '1')
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Disable grayscale', 'thegem'),
					'param_name' => 'disable_grayscale',
					'value' => array(__('Yes', 'thegem') => '1')
				),

			)),
		),

		'gem_countdown' => array(
			'name' => __( 'Countdown', 'thegem' ),
			'base' => 'gem_countdown',
			'category' => __( 'The Gem', 'thegem'),
			'params' => array(
				array(
					'type' => 'dropdown',
					'heading' => __( 'Style', 'thegem'),
					'param_name' => 'style',
					'value' => array(
						__('Boxes', 'thegem') => 'style-3',
						__('Elegant', 'thegem') => 'style-4',
						__('Cross', 'thegem') => 'style-6',
						__('Days Only', 'thegem') => 'style-7',
						__('Circles', 'thegem') => 'style-5',
					),
				),
				array(
					'type' => 'thegem_datepicker_param',
					'heading' => __( 'Start Event', 'thegem' ),
					'description' => 'Date format : Day-Month-Year',
					'param_name' => 'start_eventdate',
					'dependency' => array(
						'element' => 'style',
						'value' => 'style-5',
					),
				),
				array(
					'type' => 'thegem_datepicker_param',
					'heading' => __( 'Event Date', 'thegem' ),
					'description' => 'Date format : Day-Month-Year',
					'param_name' => 'eventdate',
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Aligment', 'thegem'),
					'param_name' => 'aligment',
					'value' => array( __('Left', 'thegem') => 'align-left', __('Center', 'thegem') => 'align-center', __('Right', 'thegem') => 'align-right'),
					'dependency' => array(
						'element' => 'style',
						'value' => array(
							'style-4',
							'style-6',
							'style-7',
						)
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Numbers Weight', 'thegem'),
					'param_name' => 'weight_number',
					'value' => array('Bold' => 8, 'Thin' => 4),
					'dependency' => array(
						'element' => 'style',
						'value' => 'style-5',
					),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Number color', 'thegem' ),
					'param_name' => 'color_number',
					'dependency' => array(
						'element' => 'style',
						'value' => array(
							'style-3',
							'style-4',
							'style-6',
							'style-7',
						),
					),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Text color', 'thegem' ),
					'param_name' => 'color_text',
					'dependency' => array(
						'element' => 'style',
						'value' => array(
							'style-3',
							'style-4',
							'style-5',
							'style-6',
							'style-7',
						),
					),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Border color', 'thegem' ),
					'param_name' => 'color_border',
					'dependency' => array(
						'element' => 'style',
						'value' => array(
							'style-3',
							'style-4',
							'style-6',
						),
					),
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Countdown text', 'thegem' ),
					'param_name' => 'countdown_text',
					'dependency' => array(
						'element' => 'style',
						'value' => 'style-7',
					),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Background color', 'thegem'),
					'param_name' => 'color_background',
					'dependency' => array(
						'element' => 'style',
						'value' => 'style-3',
					),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Color Days', 'thegem'),
					'param_name' => 'color_days',
					'dependency' => array(
						'element' => 'style',
						'value' => 'style-5',
					),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Color Hours', 'thegem'),
					'param_name' => 'color_hours',
					'dependency' => array(
						'element' => 'style',
						'value' => 'style-5',
					),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Color Minutes', 'thegem'),
					'param_name' => 'color_minutes',
					'dependency' => array(
						'element' => 'style',
						'value' => 'style-5',
					),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Color Seconds', 'thegem'),
					'param_name' => 'color_seconds',
					'dependency' => array(
						'element' => 'style',
						'value' => 'style-5',
					),
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Extra class name', 'thegem' ),
					'param_name' => 'extraclass',
				),
			)
		),

		'gem_counter' => array(
			'name' => __('Counter', 'thegem'),
			'base' => 'gem_counter',
			'as_child' => array('only' => 'gem_counter_box'),
			'content_element' => true,
			'icon' => 'thegem-icon-wpb-ui-counter',
			'category' => __('The Gem', 'thegem'),
			'description' => __('Counter', 'thegem'),
			'params' => array_merge(array(
				array(
					'type' => 'textfield',
					'heading' => __('From', 'thegem'),
					'param_name' => 'from',
				),
				array(
					'type' => 'textfield',
					'heading' => __('To', 'thegem'),
					'param_name' => 'to',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Text', 'thegem'),
					'param_name' => 'text',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Suffix', 'thegem'),
					'param_name' => 'suffix',
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Background Color', 'thegem'),
					'param_name' => 'background_color',
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Numbers Color', 'thegem'),
					'param_name' => 'numbers_color',
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Text Color', 'thegem'),
					'param_name' => 'text_color',
				),
				array(
					'type' => 'vc_link',
					'heading' => __( 'URL (Link)', 'thegem' ),
					'param_name' => 'link',
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Icon pack', 'thegem'),
					'param_name' => 'icon_pack',
					'value' => array_merge(array(__('Elegant', 'thegem') => 'elegant', __('Material Design', 'thegem') => 'material', __('FontAwesome', 'thegem') => 'fontawesome'), thegem_userpack_to_dropdown()),
					'group' => __('Icon', 'thegem')
				),
				array(
					'type' => 'thegem_icon',
					'heading' => __('Icon', 'thegem'),
					'param_name' => 'icon_elegant',
					'icon_pack' => 'elegant',
					'dependency' => array(
						'element' => 'icon_pack',
						'value' => array('elegant')
					),
					'group' => __('Icon', 'thegem')
				),
				array(
					'type' => 'thegem_icon',
					'heading' => __('Icon', 'thegem'),
					'param_name' => 'icon_material',
					'icon_pack' => 'material',
					'dependency' => array(
						'element' => 'icon_pack',
						'value' => array('material')
					),
					'group' => __('Icon', 'thegem')
				),
				array(
					'type' => 'thegem_icon',
					'heading' => __('Icon', 'thegem'),
					'param_name' => 'icon_fontawesome',
					'icon_pack' => 'fontawesome',
					'dependency' => array(
						'element' => 'icon_pack',
						'value' => array('fontawesome')
					),
					'group' => __('Icon', 'thegem')
				),
			),
			thegem_userpack_to_shortcode(array(
				array(
					'type' => 'thegem_icon',
					'heading' => __('Icon', 'thegem'),
					'param_name' => 'icon_userpack',
					'icon_pack' => 'userpack',
					'dependency' => array(
						'element' => 'icon_pack',
						'value' => array('userpack')
					),
				),
			)),
			array(
				array(
					'type' => 'dropdown',
					'heading' => __('Icon Shape', 'thegem'),
					'param_name' => 'icon_shape',
					'value' => array(__('Square', 'thegem') => 'square', __('Circle', 'thegem') => 'circle'),
					'group' => __('Icon', 'thegem')
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Icon Style', 'thegem'),
					'param_name' => 'icon_style',
					'value' => array(__('Default', 'thegem') => '', __('45 degree Right', 'thegem') => 'angle-45deg-r', __('45 degree Left', 'thegem') => 'angle-45deg-l', __('90 degree', 'thegem') => 'angle-90deg'),
					'group' => __('Icon', 'thegem')
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Icon Color', 'thegem'),
					'param_name' => 'icon_color',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group' => __('Icon', 'thegem')
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Icon Color 2', 'thegem'),
					'param_name' => 'icon_color_2',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group' => __('Icon', 'thegem')
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Icon Background Color', 'thegem'),
					'param_name' => 'icon_background_color',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group' => __('Icon', 'thegem')
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Icon Border Color', 'thegem'),
					'param_name' => 'icon_border_color',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group' => __('Icon', 'thegem')
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Icon Size', 'thegem'),
					'param_name' => 'icon_size',
					'value' => array(__('Small', 'thegem') => 'small', __('Medium', 'thegem') => 'medium', __('Large', 'thegem') => 'large', __('Extra Large', 'thegem') => 'xlarge'),
					'group' => __('Icon', 'thegem')
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Icon Color', 'thegem'),
					'param_name' => 'hover_icon_color',
					'group' => __('Hover', 'thegem'),
					'dependency' => array(
						'element' => 'link',
						'not_empty' => true
					),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Background Color', 'thegem'),
					'param_name' => 'hover_background_color',
					'group' => __('Hover', 'thegem'),
					'dependency' => array(
						'element' => 'link',
						'not_empty' => true
					),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Numbers Color', 'thegem'),
					'param_name' => 'hover_numbers_color',
					'group' => __('Hover', 'thegem'),
					'dependency' => array(
						'element' => 'link',
						'not_empty' => true
					),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Text Color', 'thegem'),
					'param_name' => 'hover_text_color',
					'group' => __('Hover', 'thegem'),
					'dependency' => array(
						'element' => 'link',
						'not_empty' => true
					),
				),
			)),
		),

		'gem_counter_box' => array(
			'name' => __('Counter box', 'thegem'),
			'base' => 'gem_counter_box',
			'is_container' => true,
			'js_view' => 'VcGemCounterBoxView',
			'as_parent' => array('only' => 'gem_counter'),
			'icon' => 'thegem-icon-wpb-ui-counter-box',
			'category' => __('The Gem', 'thegem'),
			'description' => __('Counter box', 'thegem'),
			'params' => array_merge(array(
				array(
					'type' => 'dropdown',
					'heading' => __('Style', 'thegem'),
					'param_name' => 'style',
					'value' => array(__('Style 1', 'thegem') => '1', __('Style 2', 'thegem') => '2', __('Vertical', 'thegem') => 'vertical')
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Columns', 'thegem'),
					'param_name' => 'columns',
					'value' => array(1,2,3,4),
					'std' => 4,
					'dependency' => array(
						'element' => 'style',
						'value' => array('1', '2')
					),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Connector color', 'thegem'),
					'param_name' => 'connector_color',
					'dependency' => array(
						'element' => 'style',
						'value' => array('vertical')
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Team Person', 'thegem'),
					'param_name' => 'team_person',
					'value' => thegem_vc_get_team_persons(),
					'dependency' => array(
						'element' => 'style',
						'value' => array('vertical')
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Team Person Image Size', 'thegem'),
					'param_name' => 'team_image_size',
					'value' => array(__('Small', 'thegem') => 'small', __('Medium', 'thegem') => 'medium', __('Large', 'thegem') => 'large', __('Extra Large', 'thegem') => 'xlarge'),
					'dependency' => array(
						'element' => 'team_person',
						'not_empty' => true
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Lazy loading enabled', 'thegem'),
					'param_name' => 'effects_enabled',
					'value' => array(__('Yes', 'thegem') => '1')
				),
				array(
					'type' => 'textfield',
					'heading' => __('Number format', 'thegem'),
					'param_name' => 'number_format',
					'std' => '(ddd).ddd',
					'description' => __('Example: (ddd).ddd -> 9999.99, ( ddd).ddd -> 9 999.99, (,ddd).ddd -> 9,999.99', 'thegem')
				),
			)),
		),

		'gem_custom_header' => array(
			'name' => __('Custom Header', 'thegem'),
			'base' => 'gem_custom_header',
			'is_container' => false,
			'js_view' => 'VcGemCustomHeaderView',
			'icon' => 'thegem-icon-wpb-ui-header',
			'category' => __('The Gem', 'thegem'),
			'description' => __('Custom Header', 'thegem'),
			'params' => array_merge(array(
				array(
					'type' => 'textarea_html',
					'heading' => __('Content', 'thegem'),
					'param_name' => 'content',
					'value' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __('Title max width px', 'thegem'),
					'param_name' => 'title_width',
					'value' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __('Title top margin', 'thegem'),
					'param_name' => 'title_top_margin',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Title bottom margin', 'thegem'),
					'param_name' => 'title_bottom_margin',
				),
				array(
					'type' => 'textarea',
					'heading' => __('Subtitle', 'thegem'),
					'param_name' => 'subtitle',
					'value' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __('Subtitle max width px', 'thegem'),
					'param_name' => 'subtitle_width',
					'value' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Subtitle color', 'thegem'),
					'param_name' => 'subtitle_color',
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Icon position', 'thegem'),
					'param_name' => 'icon_position',
					'value' => array(
						__('Left', 'thegem') => 'gem-custom-header-icon-position-left',
						__('Right', 'thegem') => 'gem-custom-header-icon-position-right',
						__('No Display', 'thegem') => 'gem-custom-header-no-icon',
						__('Centered', 'thegem') => 'gem-custom-header-icon-position-centered'
					)
				),
				array(
					'type' => 'attach_image',
					'heading' => __('Background image', 'thegem'),
					'param_name' => 'background_image',
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Background style', 'thegem'),
					'param_name' => 'background_style',
					'value' => array(
						__('Default', 'thegem') => '',
						__('Cover', 'thegem') => 'cover',
						__('Contain', 'thegem') => 'contain',
						__('No Repeat', 'thegem') => 'no-repeat',
						__('Repeat', 'thegem') => 'repeat'
					)
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Custom Header Background color', 'thegem'),
					'param_name' => 'ch_background_color',
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Background video type', 'thegem'),
					'param_name' => 'video_background_type',
					'value' => array(
						__('None', 'thegem') => '',
						__('YouTube', 'thegem') => 'youtube',
						__('Vimeo', 'thegem') => 'vimeo',
						__('Self', 'thegem') => 'self'
					)
				),
				array(
					'type' => 'textfield',
					'heading' => __('Video id (YouTube or Vimeo) or src', 'thegem'),
					'param_name' => 'video_background_src',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Video Aspect ratio (16:9, 16:10, 4:3...)', 'thegem'),
					'param_name' => 'video_background_acpect_ratio',
					'value' => '16:9'
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Background video overlay color', 'thegem'),
					'param_name' => 'video_background_overlay_color',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Background video overlay opacity (0 - 1)', 'thegem'),
					'param_name' => 'video_background_overlay_opacity',
				),
				array(
					'type' => 'attach_image',
					'heading' => __('Video Poster', 'thegem'),
					'param_name' => 'video_background_poster',
					'dependency' => array(
						'element' => 'video_background_type',
						'value' => array('self')
					)
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Container', 'thegem'),
					'param_name' => 'container',
					'value' => array(__('Yes', 'thegem') => '1')
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Show Bread Crumbs', 'thegem'),
					'param_name' => 'breadcrumbs',
					'value' => array(__('Yes', 'thegem') => '1')
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Centreed Bread Crumbs', 'thegem'),
					'param_name' => 'centreed_breadcrumbs',
					'value' => array(__('Yes', 'thegem') => '1')
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Icon pack', 'thegem'),
					'param_name' => 'pack',
					'value' => array_merge(array(__('Elegant', 'thegem') => 'elegant', __('Material Design', 'thegem') => 'material', __('FontAwesome', 'thegem') => 'fontawesome'), thegem_userpack_to_dropdown()),
					'std' => 2,
				),
				array(
					'type' => 'thegem_icon',
					'heading' => __('Icon', 'thegem'),
					'param_name' => 'icon_elegant',
					'icon_pack' => 'elegant',
					'dependency' => array(
						'element' => 'pack',
						'value' => array('elegant')
					),
				),
				array(
					'type' => 'thegem_icon',
					'heading' => __('Icon', 'thegem'),
					'param_name' => 'icon_material',
					'icon_pack' => 'material',
					'dependency' => array(
						'element' => 'pack',
						'value' => array('material')
					),
				),
				array(
					'type' => 'thegem_icon',
					'heading' => __('Icon', 'thegem'),
					'param_name' => 'icon_fontawesome',
					'icon_pack' => 'fontawesome',
					'dependency' => array(
						'element' => 'pack',
						'value' => array('fontawesome')
					),
				),
			),
			thegem_userpack_to_shortcode(array(
				array(
					'type' => 'thegem_icon',
					'heading' => __('Icon', 'thegem'),
					'param_name' => 'icon_userpack',
					'icon_pack' => 'userpack',
					'dependency' => array(
						'element' => 'pack',
						'value' => array('userpack')
					),
				),
			)),
			array(
				array(
					'type' => 'dropdown',
					'heading' => __('Shape', 'thegem'),
					'param_name' => 'shape',
					'value' => array(__('None', 'thegem') => 'none', __('Square', 'thegem') => 'square', __('Circle', 'thegem') => 'circle', __('Rhombus', 'thegem') => 'romb', __('Hexagon', 'thegem') => 'hexagon')
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Style', 'thegem'),
					'param_name' => 'style',
					'value' => array(__('Default', 'thegem') => '', __('45 degree Right', 'thegem') => 'angle-45deg-r', __('45 degree Left', 'thegem') => 'angle-45deg-l', __('90 degree', 'thegem') => 'angle-90deg')
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Color', 'thegem'),
					'param_name' => 'color',
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Color 2', 'thegem'),
					'param_name' => 'color_2',
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Background Color', 'thegem'),
					'param_name' => 'background_color',
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Border Color', 'thegem'),
					'param_name' => 'border_color',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Opacity (0-1)', 'thegem'),
					'param_name' => 'opacity',
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Size', 'thegem'),
					'param_name' => 'size',
					'value' => array(__('small', 'thegem') => 'small', __('medium', 'thegem') => 'medium', __('Large', 'thegem') => 'large', __('Extra Large', 'thegem') => 'xlarge')
				),
				array(
					'type' => 'textfield',
					'heading' => __('Icon top margin', 'thegem'),
					'param_name' => 'icon_top_margin',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Icon bottom margin', 'thegem'),
					'param_name' => 'icon_bottom_margin',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Padding top', 'thegem'),
					'param_name' => 'padding_top',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Padding bottom', 'thegem'),
					'param_name' => 'padding_bottom',
				),
			)),
		),

		'gem_diagram' => array(
			'name' => __('Diagram', 'thegem'),
			'base' => 'gem_diagram',
			'icon' => 'thegem-icon-wpb-ui-diagram',
			'category' => __('The Gem', 'thegem'),
			'description' => __('Styled diagrams and graphs', 'thegem'),
			'params' => array_merge(array(
				array(
					'type' => 'textfield',
					'heading' => __('title', 'thegem'),
					'param_name' => 'title',
				),
				array(
					'type' => 'textfield',
					'heading' => __('summary', 'thegem'),
					'param_name' => 'summary',
				),
				array(
					'type' => 'dropdown',
					'heading' => __('type', 'thegem'),
					'param_name' => 'type',
					'value' => array(__('circle', 'thegem') => 'circle', __('line', 'thegem') => 'line')
				),
				array(
					'type' => 'textarea',
					'heading' => __('Content', 'thegem'),
					'param_name' => 'content',
					'value' => '[gem_skill title="Skill1" amount="70" color="#ff0000"]'."\n".
						'[gem_skill title="Skill2" amount="70" color="#ffff00"]'."\n".
						'[gem_skill title="Skill3" amount="70" color="#ff00ff"]'."\n".
						'[gem_skill title="Skill4" amount="70" color="#f0f0f0"]'
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Lazy loading enabled', 'thegem'),
					'param_name' => 'effects_enabled',
					'value' => array(__('Yes', 'thegem') => '1')
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Style', 'thegem'),
					'param_name' => 'style',
					'value' => array(
						__('style-1', 'thegem') => 'style-1',
						__('style-2', 'thegem') => 'style-2',
						__('style-3', 'thegem') => 'style-3'
					)
				),
			)),
		),

		'gem_divider' => array(
			'name' => __('Divider', 'thegem'),
			'base' => 'gem_divider',
			'icon' => 'thegem-icon-wpb-ui-divider',
			'category' => __('The Gem', 'thegem'),
			'description' => __('Horizontal separator in different styles', 'thegem'),
			'params' => array_merge(array(
				array(
					'type' => 'dropdown',
					'heading' => __('Style', 'thegem'),
					'param_name' => 'style',
					'value' => array(
						__('1px', 'thegem') => '',
						__('stroked', 'thegem') => 1,
						__('3px', 'thegem') => 2,
						__('7px', 'thegem') => 3,
						__('dotted', 'thegem') => 4,
						__('dashed', 'thegem') => 5,
						__('zigzag', 'thegem') => 6,
						__('wave', 'thegem') => 7
					)
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Color', 'thegem'),
					'param_name' => 'color',
					/*'value' => thegem_get_option('divider_default_color') ? thegem_get_option('divider_default_color') : ''*/
				),
				array(
					'type' => 'textfield',
					'heading' => __('Margin top', 'thegem'),
					'param_name' => 'margin_top',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Margin bottom', 'thegem'),
					'param_name' => 'margin_bottom',
					/*'value' => '27'*/
				),
				array(
					'type' => 'textfield',
					'heading' => __('Extra class name', 'thegem'),
					'param_name' => 'class_name',
				),

			)),
		),

		'gem_dropcap' => array(
			'name' => __('Dropcap', 'thegem'),
			'base' => 'gem_dropcap',
			'icon' => 'thegem-icon-wpb-ui-dropcap',
			'category' => __('The Gem', 'thegem'),
			'description' => __('Dropcap symbol for text content', 'thegem'),
			'params' => array_merge(array(
				array(
					'type' => 'textfield',
					'heading' => __('letter', 'thegem'),
					'param_name' => 'letter',
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Shape', 'thegem'),
					'param_name' => 'shape',
					'value' => array(__('square', 'thegem') => 'square', __('circle', 'thegem') => 'circle', __('hexagon', 'thegem') => 'hexagon')
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Style', 'thegem'),
					'param_name' => 'style',
					'value' => array(__('Medium', 'thegem') => 'medium', __('Big', 'thegem') => 'big')
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Color', 'thegem'),
					'param_name' => 'color',
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Background Color', 'thegem'),
					'param_name' => 'background_color',
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Border Color', 'thegem'),
					'param_name' => 'border_color',
				),
			)),
		),

		'gem_fullwidth' => array(
			'name' => __('Fullwidth Container', 'thegem'),
			'base' => 'gem_fullwidth',
			'is_container' => true,
			'js_view' => 'VcGemFullwidthView',
			'icon' => 'thegem-icon-wpb-ui-fullwidth',
			'category' => __('The Gem', 'thegem'),
			'description' => __('Fullwidth', 'thegem'),
			'params' => array_merge(array(
				array(
					'type' => 'colorpicker',
					'heading' => __('Color', 'thegem'),
					'param_name' => 'color',
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Background Color', 'thegem'),
					'param_name' => 'background_color',
				),
				array(
					'type' => 'attach_image',
					'heading' => __('Background image', 'thegem'),
					'param_name' => 'background_image',
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Background style', 'thegem'),
					'param_name' => 'background_style',
					'value' => array(
						__('Default', 'thegem') => '',
						__('Cover', 'thegem') => 'cover',
						__('Contain', 'thegem') => 'contain',
						__('No Repeat', 'thegem') => 'no-repeat',
						__('Repeat', 'thegem') => 'repeat'
					)
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Background horizontal position', 'thegem'),
					'param_name' => 'background_position_horizontal',
					'value' => array(
						__('Center', 'thegem') => 'center',
						__('Left', 'thegem') => 'left',
						__('Right', 'thegem') => 'right'
					)
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Background vertical position', 'thegem'),
					'param_name' => 'background_position_vertical',
					'value' => array(
						__('Top', 'thegem') => 'top',
						__('Center', 'thegem') => 'center',
						__('Bottom', 'thegem') => 'bottom'
					)
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Parallax', 'thegem'),
					'param_name' => 'background_parallax',
					'value' => array(__('Yes', 'thegem') => '1')
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Enable Parallax on Mobiles', 'thegem'),
					'param_name' => 'background_parallax_mobile',
					'value' => array(__('Yes', 'thegem') => '1'),
					'dependency' => array(
						'element' => 'background_parallax',
						'value' => array('1')
					)
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Full-height', 'thegem'),
					'param_name' => 'fullheight',
					'value' => array(__('Yes', 'thegem') => '1')
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Parallax type', 'thegem'),
					'param_name' => 'background_parallax_type',
					'value' => array(
						__('Vertical', 'thegem') => 'vertical',
						__('Horizontal', 'thegem') => 'horizontal',
						__('Fixed', 'thegem') => 'fixed'
					),
					'dependency' => array(
						'element' => 'background_parallax',
						'value' => array('1')
					)
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Parallax overlay color', 'thegem'),
					'param_name' => 'background_parallax_overlay_color',
					'dependency' => array(
						'element' => 'background_parallax',
						'value' => array('1')
					)
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Background video type', 'thegem'),
					'param_name' => 'video_background_type',
					'value' => array(
						__('None', 'thegem') => '',
						__('YouTube', 'thegem') => 'youtube',
						__('Vimeo', 'thegem') => 'vimeo',
						__('Self', 'thegem') => 'self'
					)
				),
				array(
					'type' => 'textfield',
					'heading' => __('Video id (YouTube or Vimeo) or src', 'thegem'),
					'param_name' => 'video_background_src',
					'value' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __('Video Aspect ratio (16:9, 16:10, 4:3...)', 'thegem'),
					'param_name' => 'video_background_acpect_ratio',
					'value' => '16:9'
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Background video overlay color', 'thegem'),
					'param_name' => 'video_background_overlay_color',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Background video overlay opacity (0 - 1)', 'thegem'),
					'param_name' => 'video_background_overlay_opacity',
				),
				array(
					'type' => 'attach_image',
					'heading' => __('Video Poster', 'thegem'),
					'param_name' => 'video_background_poster',
					'dependency' => array(
						'element' => 'video_background_type',
						'value' => array('self')
					)
				),
				array(
					'type' => 'textfield',
					'heading' => __('Padding top', 'thegem'),
					'param_name' => 'padding_top',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Padding bottom', 'thegem'),
					'param_name' => 'padding_bottom',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Padding left', 'thegem'),
					'param_name' => 'padding_left',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Padding right', 'thegem'),
					'param_name' => 'padding_right',
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Container', 'thegem'),
					'param_name' => 'container',
					'value' => array(__('Yes', 'thegem') => '1')
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Top Styled Marker Style', 'thegem'),
					'param_name' => 'styled_marker_top_style',
					'value' => array(__('None', 'thegem') => '', __('Triangle', 'thegem') => 'triangle', __('Figure', 'thegem') => 'figure')
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Top Styled Marker Direction', 'thegem'),
					'param_name' => 'styled_marker_top_direction',
					'value' => array(__('Inside', 'thegem') => 'inside', __('Outside', 'thegem') => 'outside'),
					'dependency' => array(
						'element' => 'styled_marker_top_style',
						'not_empty' => true
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Bottom Styled Marker Style', 'thegem'),
					'param_name' => 'styled_marker_bottom_style',
					'value' => array(__('None', 'thegem') => '', __('Triangle', 'thegem') => 'triangle', __('Figure', 'thegem') => 'figure')
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Bottom Styled Marker Direction', 'thegem'),
					'param_name' => 'styled_marker_bottom_direction',
					'value' => array(__('Inside', 'thegem') => 'inside', __('Outside', 'thegem') => 'outside'),
					'dependency' => array(
						'element' => 'styled_marker_bottom_style',
						'not_empty' => true
					),
				),
			)),
		),

		'gem_icon' => array(
			'name' => __('Icon', 'thegem'),
			'base' => 'gem_icon',
			'icon' => 'thegem-icon-wpb-ui-icon',
			'category' => __('The Gem', 'thegem'),
			'description' => __('Customizable Font Icon', 'thegem'),
			'params' => array_merge(array(
				array(
					'type' => 'dropdown',
					'heading' => __('Icon pack', 'thegem'),
					'param_name' => 'pack',
					'value' => array_merge(array(__('Elegant', 'thegem') => 'elegant', __('Material Design', 'thegem') => 'material', __('FontAwesome', 'thegem') => 'fontawesome'), thegem_userpack_to_dropdown()),
					'std' => 2,
				),
				array(
					'type' => 'thegem_icon',
					'heading' => __('Icon', 'thegem'),
					'param_name' => 'icon_elegant',
					'icon_pack' => 'elegant',
					'dependency' => array(
						'element' => 'pack',
						'value' => array('elegant')
					),
				),
				array(
					'type' => 'thegem_icon',
					'heading' => __('Icon', 'thegem'),
					'param_name' => 'icon_material',
					'icon_pack' => 'material',
					'dependency' => array(
						'element' => 'pack',
						'value' => array('material')
					),
				),
				array(
					'type' => 'thegem_icon',
					'heading' => __('Icon', 'thegem'),
					'param_name' => 'icon_fontawesome',
					'icon_pack' => 'fontawesome',
					'dependency' => array(
						'element' => 'pack',
						'value' => array('fontawesome')
					),
				),
			),
			thegem_userpack_to_shortcode(array(
				array(
					'type' => 'thegem_icon',
					'heading' => __('Icon', 'thegem'),
					'param_name' => 'icon_userpack',
					'icon_pack' => 'userpack',
					'dependency' => array(
						'element' => 'pack',
						'value' => array('userpack')
					),
				),
			)),
			array(
				array(
					'type' => 'dropdown',
					'heading' => __('Shape', 'thegem'),
					'param_name' => 'shape',
					'value' => array(__('Square', 'thegem') => 'square', __('Circle', 'thegem') => 'circle', __('Rhombus', 'thegem') => 'romb', __('Hexagon', 'thegem') => 'hexagon')
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Style', 'thegem'),
					'param_name' => 'style',
					'value' => array(__('Default', 'thegem') => '', __('45 degree Right', 'thegem') => 'angle-45deg-r', __('45 degree Left', 'thegem') => 'angle-45deg-l', __('90 degree', 'thegem') => 'angle-90deg')
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Color', 'thegem'),
					'param_name' => 'color',
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Color 2', 'thegem'),
					'param_name' => 'color_2',
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Background Color', 'thegem'),
					'param_name' => 'background_color',
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Border Color', 'thegem'),
					'param_name' => 'border_color',
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Size', 'thegem'),
					'param_name' => 'size',
					'value' => array(__('small', 'thegem') => 'small', __('medium', 'thegem') => 'medium', __('Large', 'thegem') => 'large', __('Extra Large', 'thegem') => 'xlarge')
				),
				array(
					'type' => 'textfield',
					'heading' => __('Link', 'thegem'),
					'param_name' => 'link',
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Link target', 'thegem'),
					'param_name' => 'link_target',
					'value' => array(__('Self', 'thegem') => '_self', __('Blank', 'thegem') => '_blank')
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Centered', 'thegem'),
					'param_name' => 'centered',
					'value' => array(__('Yes', 'thegem') => '1')
				),
				array(
					'type' => 'textfield',
					'heading' => __('Icon top margin', 'thegem'),
					'param_name' => 'icon_top_margin',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Icon bottom margin', 'thegem'),
					'param_name' => 'icon_bottom_margin',
				),
			)),
		),

		'gem_icon_with_text' => array(
			'name' => __('Icon with text', 'thegem'),
			'base' => 'gem_icon_with_text',
			'is_container' => true,
			'js_view' => 'VcGemIconWithTextView',
			'icon' => 'thegem-icon-wpb-ui-icon_with_text',
			'category' => __('The Gem', 'thegem'),
			'description' => __('Font Icon with aligned text content', 'thegem'),
			'params' => array_merge(array(
				array(
					'type' => 'dropdown',
					'heading' => __('Icon pack', 'thegem'),
					'param_name' => 'icon_pack',
					'value' => array_merge(array(__('Elegant', 'thegem') => 'elegant', __('Material Design', 'thegem') => 'material', __('FontAwesome', 'thegem') => 'fontawesome'), thegem_userpack_to_dropdown()),
					'std' => 2,
				),
				array(
					'type' => 'thegem_icon',
					'heading' => __('Icon', 'thegem'),
					'param_name' => 'icon_elegant',
					'icon_pack' => 'elegant',
					'dependency' => array(
						'element' => 'icon_pack',
						'value' => array('elegant')
					),
				),
				array(
					'type' => 'thegem_icon',
					'heading' => __('Icon', 'thegem'),
					'param_name' => 'icon_material',
					'icon_pack' => 'material',
					'dependency' => array(
						'element' => 'icon_pack',
						'value' => array('material')
					),
				),
				array(
					'type' => 'thegem_icon',
					'heading' => __('Icon', 'thegem'),
					'param_name' => 'icon_fontawesome',
					'icon_pack' => 'fontawesome',
					'dependency' => array(
						'element' => 'icon_pack',
						'value' => array('fontawesome')
					),
				),
			),
			thegem_userpack_to_shortcode(array(
				array(
					'type' => 'thegem_icon',
					'heading' => __('Icon', 'thegem'),
					'param_name' => 'icon_userpack',
					'icon_pack' => 'userpack',
					'dependency' => array(
						'element' => 'icon_pack',
						'value' => array('userpack')
					),
				),
			)),
			array(
				array(
					'type' => 'dropdown',
					'heading' => __('Shape', 'thegem'),
					'param_name' => 'icon_shape',
					'value' => array(__('Square', 'thegem') => 'square', __('Circle', 'thegem') => 'circle', __('Rhombus', 'thegem') => 'romb', __('Hexagon', 'thegem') => 'hexagon')
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Icon style', 'thegem'),
					'param_name' => 'icon_style',
					'value' => array(__('Default', 'thegem') => '', __('45 degree Right', 'thegem') => 'angle-45deg-r', __('45 degree Left', 'thegem') => 'angle-45deg-l', __('90 degree', 'thegem') => 'angle-90deg')
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('color', 'thegem'),
					'param_name' => 'icon_color',
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('color 2', 'thegem'),
					'param_name' => 'icon_color_2',
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Background Color', 'thegem'),
					'param_name' => 'icon_background_color',
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Border Color', 'thegem'),
					'param_name' => 'icon_border_color',
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Size', 'thegem'),
					'param_name' => 'icon_size',
					'value' =>  array(__('small', 'thegem') => 'small', __('medium', 'thegem') => 'medium', __('Large', 'thegem') => 'large', __('Extra Large', 'thegem') => 'xlarge')
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Flow', 'thegem'),
					'param_name' => 'flow',
					'value' => array(__('Yes', 'thegem') => '1')
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Centered', 'thegem'),
					'param_name' => 'centered',
					'value' => array(__('Yes', 'thegem') => '1')
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Float right icon', 'thegem'),
					'param_name' => 'float_right',
					'value' => array(__('Yes', 'thegem') => '1')
				),
				array(
					'type' => 'textfield',
					'heading' => __('Icon top padding', 'thegem'),
					'param_name' => 'icon_top_side_padding',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Icon right padding', 'thegem'),
					'param_name' => 'icon_right_side_padding',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Icon bottom padding', 'thegem'),
					'param_name' => 'icon_bottom_side_padding',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Icon left padding', 'thegem'),
					'param_name' => 'icon_left_side_padding',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Icon top margin', 'thegem'),
					'param_name' => 'icon_top_margin',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Icon bottom margin', 'thegem'),
					'param_name' => 'icon_bottom_margin',
				),

			)),
		),

		'gem_icon_with_title' => array(
			'name' => __('Icon with Title', 'thegem'),
			'base' => 'gem_icon_with_title',
			'icon' => 'thegem-icon-wpb-ui-iconed_title',
			'category' => __('The Gem', 'thegem'),
			'description' => __('Title with customizable font icon', 'thegem'),
			'params' => array_merge(array(
				array(
					'type' => 'dropdown',
					'heading' => __('Icon pack', 'thegem'),
					'param_name' => 'icon_pack',
					'value' => array_merge(array(__('Elegant', 'thegem') => 'elegant', __('Material Design', 'thegem') => 'material', __('FontAwesome', 'thegem') => 'fontawesome'), thegem_userpack_to_dropdown()),
					'std' => 2,
				),
				array(
					'type' => 'thegem_icon',
					'heading' => __('Icon', 'thegem'),
					'param_name' => 'icon_elegant',
					'icon_pack' => 'elegant',
					'dependency' => array(
						'element' => 'icon_pack',
						'value' => array('elegant')
					),
				),
				array(
					'type' => 'thegem_icon',
					'heading' => __('Icon', 'thegem'),
					'param_name' => 'icon_material',
					'icon_pack' => 'material',
					'dependency' => array(
						'element' => 'icon_pack',
						'value' => array('material')
					),
				),
				array(
					'type' => 'thegem_icon',
					'heading' => __('Icon', 'thegem'),
					'param_name' => 'icon_fontawesome',
					'icon_pack' => 'fontawesome',
					'dependency' => array(
						'element' => 'icon_pack',
						'value' => array('fontawesome')
					),
				),
			),
			thegem_userpack_to_shortcode(array(
				array(
					'type' => 'thegem_icon',
					'heading' => __('Icon', 'thegem'),
					'param_name' => 'icon_userpack',
					'icon_pack' => 'userpack',
					'dependency' => array(
						'element' => 'icon_pack',
						'value' => array('userpack')
					),
				),
			)),
			array(
				array(
					'type' => 'dropdown',
					'heading' => __('Shape', 'thegem'),
					'param_name' => 'icon_shape',
					'value' => array(__('square', 'thegem') => 'square', __('circle', 'thegem') => 'circle', __('romb', 'thegem') => 'romb')
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Style', 'thegem'),
					'param_name' => 'icon_style',
					'value' => array(__('Default', 'thegem') => '', __('45 degree Right', 'thegem') => 'angle-45deg-r', __('45 degree Left', 'thegem') => 'angle-45deg-l', __('90 degree', 'thegem') => 'angle-90deg')
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Color', 'thegem'),
					'param_name' => 'icon_color',
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Color 2', 'thegem'),
					'param_name' => 'icon_color_2',
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Background Color', 'thegem'),
					'param_name' => 'icon_background_color',
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Border Color', 'thegem'),
					'param_name' => 'icon_border_color',
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Size', 'thegem'),
					'param_name' => 'icon_size',
					'value' =>  array(__('small', 'thegem') => 'small', __('medium', 'thegem') => 'medium', __('Large', 'thegem') => 'large', __('Extra Large', 'thegem') => 'xlarge')
				),
				array(
					'type' => 'textfield',
					'heading' => __('Title', 'thegem'),
					'param_name' => 'title',
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Title color', 'thegem'),
					'param_name' => 'title_color',
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Level', 'thegem'),
					'param_name' => 'level',
					'value' => array(__('h1', 'thegem') => 'h1', __('h2', 'thegem') => 'h2', __('h3', 'thegem') => 'h3', __('h4', 'thegem') => 'h4', __('h5', 'thegem') => 'h5', __('h6', 'thegem') => 'h6')
				),
				array(
					'type' => 'textfield',
					'heading' => __('Link', 'thegem'),
					'param_name' => 'link',
				),
			)),
		),

		'gem_map_with_text' => array(
			'name' => __('Map with Text', 'thegem'),
			'base' => 'gem_map_with_text',
			'is_container' => true,
			'js_view' => 'VcGemMapWithTextView',
			'icon' => 'thegem-icon-wpb-ui-map-with-text',
			'category' => __('The Gem', 'thegem'),
			'description' => __('Map with Text', 'thegem'),
			'params' => array_merge(array(
				array(
					'type' => 'colorpicker',
					'heading' => __('Background color', 'thegem'),
					'param_name' => 'background_color',
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Map height', 'thegem' ),
					'param_name' => 'size',
					'admin_label' => true,
					'description' => __( 'Enter map height in pixels. Example: 200 or leave it empty to make map responsive.', 'thegem' )
				),
				array(
					'type' => 'textarea_safe',
					'heading' => __( 'Map embed iframe', 'thegem' ),
					'param_name' => 'link',
					'description' => sprintf( __( 'Visit <a href="%s" target="_blank">Google maps</a> to create your map. 1) Find location 2) Click "Share" and make sure map is public on the web 3) Click folder icon to reveal "Embed on my site" link 4) Copy iframe code and paste it here.', 'thegem' ), 'https://www.google.com/maps/d/')
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Grayscale', 'thegem'),
					'param_name' => 'grayscale',
					'value' => array(__('Yes', 'thegem') => '1')
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Container', 'thegem'),
					'param_name' => 'container',
					'value' => array(__('Yes', 'thegem') => '1')
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Deactivate Map Zoom By Scrolling', 'thegem'),
					'param_name' => 'disable_scroll',
					'value' => array(__('Yes', 'thegem') => '1')
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Rounded Corners', 'thegem'),
					'param_name' => 'rounded_corners',
					'value' => array(__('Yes', 'thegem') => '1')
				),
			)),
		),

		'gem_news' => array(
			'name' => __('News & Blog', 'thegem'),
			'base' => 'gem_news',
			'icon' => 'thegem-icon-wpb-ui-news',
			'category' => __('The Gem', 'thegem'),
			'description' => __('News List', 'thegem'),
			'params' => array_merge(array(
				array(
					'type' => 'checkbox',
					'heading' => __('Post types', 'thegem'),
					'param_name' => 'post_types',
					'value' => array(__('Post', 'thegem') => 'post', __('News', 'thegem') => 'thegem_news')
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Style', 'thegem'),
					'param_name' => 'style',
					'value' => array(
						__('Default', 'thegem') => 'default',
						__('Timeline', 'thegem') => 'timeline',
						__('Timeline Fullwidth', 'thegem') => 'timeline_new',
						__('Masonry 3x', 'thegem') => '3x',
						__('Masonry 4x', 'thegem') => '4x',
						__('100% width', 'thegem') => '100%',
						__('Justified 3x', 'thegem') => 'justified-3x',
						__('Justified 4x', 'thegem') => 'justified-4x',
						__('Styled List 1', 'thegem') => 'styled_list1',
						__('Styled List 2', 'thegem') => 'styled_list2',
						__('Multi Author List', 'thegem') => 'multi-author',
						__('Carousel', 'thegem') => 'grid_carousel',
						__('Compact List', 'thegem') => 'compact',
						__('Slider', 'thegem') => 'slider',
					)
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Justified Style', 'thegem'),
					'param_name' => 'justified_style',
					'value' => array(
						__('Style 1', 'thegem') => 'justified-style-1',
						__('Style 2', 'thegem') => 'justified-style-2',
					),
					'dependency' => array(
						'element' => 'style',
						'value' => array('justified-3x', 'justified-4x'),
					)
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Slider Style', 'thegem'),
					'param_name' => 'slider_style',
					'value' => array(
						__('Fullwidth', 'thegem') => 'fullwidth',
						__('Halfwidth', 'thegem') => 'halfwidth',
					),
					'dependency' => array(
						'element' => 'style',
						'value' => array('slider'),
					)
				),
				array(
					'type' => 'textfield',
					'heading' => __('Autoscroll', 'thegem'),
					'param_name' => 'slider_autoscroll',
					'dependency' => array(
						'element' => 'style',
						'value' => array('slider'),
					)
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Categories', 'thegem'),
					'param_name' => 'categories',
					'value' => thegem_vc_get_blog_categories(),
					'group' =>__('Select Categories', 'thegem'),
					'edit_field_class' => 'thegem-terms-checkboxes'
				),
				array(
					'type' => 'textfield',
					'heading' => __('Post per page', 'thegem'),
					'param_name' => 'post_per_page',
					'value' => '5'
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Pagination', 'thegem'),
					'param_name' => 'post_pagination',
					'value' => array(
						__('Normal', 'thegem') => 'normal',
						__('Load More', 'thegem') => 'more',
						__('Infinite Scroll', 'thegem') => 'scroll',
						__('Disable pagination', 'thegem') => 'disable',
					)
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Loading animation', 'thegem'),
					'param_name' => 'loading_animation',
					'std' => 'move-up',
					'value' => array(__('Disabled', 'thegem') => 'disabled', __('Bounce', 'thegem') => 'bounce', __('Move Up', 'thegem') => 'move-up', __('Fade In', 'thegem') => 'fade-in', __('Fall Perspective', 'thegem') => 'fall-perspective', __('Scale', 'thegem') => 'scale', __('Flip', 'thegem') => 'flip'),
					'dependency' => array(
						'element' => 'style',
						'value' => array('default', 'timeline', 'timeline_new', '3x', '4x', '100%', 'justified-3x', 'justified-4x', 'styled_list1', 'styled_list2', 'multi-author', 'compact')
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Ignore Sticky Posts', 'thegem'),
					'param_name' => 'ignore_sticky',
					'value' => array(__('Yes', 'thegem') => '1')
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Hide date in title', 'thegem'),
					'param_name' => 'hide_date',
					'value' => array(__('Yes', 'thegem') => '1'),
					'dependency' => array(
						'element' => 'style',
						'value' => array('default', 'timeline', '3x', '4x', 'justified-3x', 'justified-4x', 'compact', 'slider')
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Hide author', 'thegem'),
					'param_name' => 'hide_author',
					'value' => array(__('Yes', 'thegem') => '1')
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Hide comments', 'thegem'),
					'param_name' => 'hide_comments',
					'value' => array(__('Yes', 'thegem') => '1')
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Hide likes', 'thegem'),
					'param_name' => 'hide_likes',
					'value' => array(__('Yes', 'thegem') => '1')
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Lazy loading enabled', 'thegem'),
					'param_name' => 'effects_enabled',
					'value' => array(__('Yes', 'thegem') => '1'),
					'dependency' => array(
						'element' => 'style',
						'value' => array('grid_carousel')
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Lazy loading enabled', 'thegem'),
					'param_name' => 'effects_enabled',
					'value' => array(__('Yes', 'thegem') => '1'),
					'dependency' => array(
						'element' => 'style',
						'value' => array('grid_carousel')
					),
				),

				array(
					'type' => 'textfield',
					'heading' => __('Button Text', 'thegem'),
					'param_name' => 'button_text',
					'group' => __('Load More Button', 'thegem'),
					'std' => __('Load More', 'thegem'),
					'dependency' => array(
						'element' => 'post_pagination',
						'value' => array('more')
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Style', 'thegem'),
					'param_name' => 'button_style',
					'value' => array(__('Flat', 'thegem') => 'flat', __('Outline', 'thegem') => 'outline'),
					'group' => __('Load More Button', 'thegem'),
					'dependency' => array(
						'element' => 'post_pagination',
						'value' => array('more')
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Size', 'thegem'),
					'param_name' => 'button_size',
					'value' => array(__('Tiny', 'thegem') => 'tiny', __('Small', 'thegem') => 'small', __('Medium', 'thegem') => 'medium', __('Large', 'thegem') => 'large', __('Giant', 'thegem') => 'giant'),
					'std' => 'medium',
					'group' => __('Load More Button', 'thegem'),
					'dependency' => array(
						'element' => 'post_pagination',
						'value' => array('more')
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Text weight', 'thegem'),
					'param_name' => 'button_text_weight',
					'value' => array(__('Normal', 'thegem') => 'normal', __('Thin', 'thegem') => 'thin'),
					'group' => __('Load More Button', 'thegem'),
					'dependency' => array(
						'element' => 'post_pagination',
						'value' => array('more')
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => __('No uppercase', 'thegem'),
					'param_name' => 'button_no_uppercase',
					'value' => array(__('Yes', 'thegem') => '1'),
					'group' => __('Load More Button', 'thegem'),
					'dependency' => array(
						'element' => 'post_pagination',
						'value' => array('more')
					),
				),
				array(
					'type' => 'textfield',
					'heading' => __('Border radius', 'thegem'),
					'param_name' => 'button_corner',
					'std' => 25,
					'group' => __('Load More Button', 'thegem'),
					'dependency' => array(
						'element' => 'post_pagination',
						'value' => array('more')
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Border width', 'thegem'),
					'param_name' => 'button_border',
					'value' => array(1, 2, 3, 4, 5, 6),
					'std' => 2,
					'dependency' => array(
						'element' => 'button_style',
						'value' => array('outline')
					),
					'group' => __('Load More Button', 'thegem'),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Text color', 'thegem'),
					'param_name' => 'button_text_color',
					'group' => __('Load More Button', 'thegem'),
					'dependency' => array(
						'element' => 'post_pagination',
						'value' => array('more')
					),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Hover text color', 'thegem'),
					'param_name' => 'button_hover_text_color',
					'group' => __('Load More Button', 'thegem'),
					'dependency' => array(
						'element' => 'post_pagination',
						'value' => array('more')
					),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Background color', 'thegem'),
					'param_name' => 'button_background_color',
					'dependency' => array(
						'element' => 'button_style',
						'value' => array('flat')
					),
					'std' => '#00bcd5',
					'group' => __('Load More Button', 'thegem'),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Hover background color', 'thegem'),
					'param_name' => 'button_hover_background_color',
					'group' => __('Load More Button', 'thegem'),
					'dependency' => array(
						'element' => 'post_pagination',
						'value' => array('more')
					),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Border color', 'thegem'),
					'param_name' => 'button_border_color',
					'dependency' => array(
						'element' => 'button_style',
						'value' => array('outline')
					),
					'group' => __('Load More Button', 'thegem'),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Hover border color', 'thegem'),
					'param_name' => 'button_hover_border_color',
					'dependency' => array(
						'element' => 'button_style',
						'value' => array('outline')
					),
					'group' => __('Load More Button', 'thegem'),
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Icon pack', 'thegem'),
					'param_name' => 'button_icon_pack',
					'value' => array_merge(array(__('Elegant', 'thegem') => 'elegant', __('Material Design', 'thegem') => 'material', __('FontAwesome', 'thegem') => 'fontawesome'), thegem_userpack_to_dropdown()),
					'std' => 2,
					'group' => __('Load More Button', 'thegem'),
					'dependency' => array(
						'element' => 'post_pagination',
						'value' => array('more')
					),
				),
				array(
					'type' => 'thegem_icon',
					'heading' => __('Icon', 'thegem'),
					'param_name' => 'button_icon_elegant',
					'icon_pack' => 'elegant',
					'dependency' => array(
						'element' => 'button_icon_pack',
						'value' => array('elegant')
					),
					'group' => __('Load More Button', 'thegem'),
				),
				array(
					'type' => 'thegem_icon',
					'heading' => __('Icon', 'thegem'),
					'param_name' => 'button_icon_material',
					'icon_pack' => 'material',
					'dependency' => array(
						'element' => 'button_icon_pack',
						'value' => array('material')
					),
					'group' => __('Load More Button', 'thegem'),
				),
				array(
					'type' => 'thegem_icon',
					'heading' => __('Icon', 'thegem'),
					'param_name' => 'button_icon_fontawesome',
					'icon_pack' => 'fontawesome',
					'dependency' => array(
						'element' => 'button_icon_pack',
						'value' => array('fontawesome')
					),
					'group' => __('Load More Button', 'thegem'),
				),
			),
			thegem_userpack_to_shortcode(array(
				array(
					'type' => 'thegem_icon',
					'heading' => __('Icon', 'thegem'),
					'param_name' => 'button_icon_userpack',
					'icon_pack' => 'userpack',
					'dependency' => array(
						'element' => 'button_icon_pack',
						'value' => array('userpack')
					),
				),
			)),
			array(
				array(
					'type' => 'dropdown',
					'heading' => __( 'Icon position', 'thegem' ),
					'param_name' => 'button_icon_position',
					'value' => array(__( 'Left', 'thegem' ) => 'left', __( 'Right', 'thegem' ) => 'right'),
					'group' => __('Load More Button', 'thegem'),
					'dependency' => array(
						'element' => 'post_pagination',
						'value' => array('more')
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Separatot Style', 'thegem'),
					'param_name' => 'button_separator',
					'value' => array(
						__('None', 'thegem') => '',
						__('Single', 'thegem') => 'single',
						__('Square', 'thegem') => 'square',
						__('Soft Double', 'thegem') => 'soft-double',
						__('Strong Double', 'thegem') => 'strong-double',
						__('Load More', 'thegem') => 'load-more'
					),
					'std' => 'load-more',
					'group' => __('Load More Button', 'thegem'),
					'dependency' => array(
						'element' => 'post_pagination',
						'value' => array('more')
					),
				),
			)),
		),

		'gem_project_info' => array(
			'name' => __('Project info', 'thegem'),
			'base' => 'gem_project_info',
			'is_container' => false,
			'icon' => 'thegem-icon-wpb-ui-project',
			'category' => __('The Gem', 'thegem'),
			'description' => __('Project info', 'thegem'),
			'params' => array_merge(array(
				array(
					'type' => 'dropdown',
					'heading' => __('Style', 'thegem'),
					'param_name' => 'style',
					'value' => array(
						__('Style 1', 'thegem') => '1',
						__('Style 2', 'thegem') => '2',
					)
				),
				array(
					'type' => 'param_group',
					'heading' => __( 'Values', 'js_composer' ),
					'param_name' => 'values',
					'value' => urlencode( json_encode( array(
								array(
									'title' => __( 'Element', 'js_composer' ),
									'decription' => '',
									'icon' => '',
									'pack' => 'elegant',
									'icon_color' => '',
								),
								array(
									'title' => __( 'Element', 'js_composer' ),
									'value' => '',
									'icon' => '',
									'pack' => 'elegant',
									'icon_color' => '',
								),
							)
						)
					),
					'params' => array_merge(array(
						array(
							'type' => 'textfield',
							'heading' => __( 'Title', 'js_composer' ),
							'param_name' => 'title',
							'admin_label' => true,
						),
						array(
							'type' => 'textfield',
							'heading' => __( 'Decription', 'js_composer' ),
							'param_name' => 'decription',
						),
						array(
							'type' => 'dropdown',
							'heading' => __('Icon pack', 'thegem'),
							'param_name' => 'pack',
							'value' => array_merge(array(__('Elegant', 'thegem') => 'elegant', __('Material Design', 'thegem') => 'material', __('FontAwesome', 'thegem') => 'fontawesome'), thegem_userpack_to_dropdown()),
						),
						array(
							'type' => 'thegem_icon',
							'heading' => __('Icon', 'thegem'),
							'param_name' => 'icon_elegant',
							'icon_pack' => 'elegant',
							'dependency' => array(
								'element' => 'pack',
								'value' => array('elegant')
							),
						),
						array(
							'type' => 'thegem_icon',
							'heading' => __('Icon', 'thegem'),
							'icon_pack' => 'material',
							'param_name' => 'icon_material',
							'dependency' => array(
								'element' => 'pack',
								'value' => array('material')
							),
						),
						array(
							'type' => 'thegem_icon',
							'heading' => __('Icon', 'thegem'),
							'param_name' => 'icon_fontawesome',
							'icon_pack' => 'fontawesome',
							'dependency' => array(
								'element' => 'pack',
								'value' => array('fontawesome')
							),
						),
					),
					thegem_userpack_to_shortcode(array(
						array(
							'type' => 'thegem_icon',
							'heading' => __('Icon', 'thegem'),
							'param_name' => 'icon_userpack',
							'icon_pack' => 'userpack',
							'dependency' => array(
								'element' => 'pack',
								'value' => array('userpack')
							),
						),
					)),
					array(
						array(
							'type' => 'colorpicker',
							'heading' => __('Icon Color', 'thegem'),
							'param_name' => 'icon_color',
						),

					)),
					'callbacks' => array(
						'after_add' => 'vcChartParamAfterAddCallback',
					),
				),
			)),
		),

		'gem_portfolio' => array(
			'name' => __('Portfolio', 'thegem'),
			'base' => 'gem_portfolio',
			'icon' => 'thegem-icon-wpb-ui-portfolio',
			'category' => __('The Gem', 'thegem'),
			'description' => __('Portfolio overview inside content', 'thegem'),
			'params' => array_merge(array(
				array(
					'type' => 'dropdown',
					'heading' => __('Layout', 'thegem'),
					'param_name' => 'portfolio_layout',
					'value' => array(__('2x columns', 'thegem') => '2x', __('3x columns', 'thegem') => '3x', __('4x columns', 'thegem') => '4x', __('100% width', 'thegem') => '100%', __('1x column list', 'thegem') => '1x')
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Layout Version', 'thegem'),
					'param_name' => 'portfolio_layout_version',
					'value' => array(__('Fullwidth', 'thegem') => 'fullwidth', __('With Sidebar', 'thegem') => 'sidebar'),
					'dependency' => array(
						'element' => 'portfolio_layout',
						'value' => array('1x')
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Caption Position', 'thegem'),
					'param_name' => 'portfolio_caption_position',
					'value' => array(__('Right', 'thegem') => 'right', __('Left', 'thegem') => 'left', __('Zigzag', 'thegem') => 'zigzag'),
					'dependency' => array(
						'element' => 'portfolio_layout',
						'value' => array('1x')
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Style', 'thegem'),
					'param_name' => 'portfolio_style',
					'value' => array(__('Justified Grid', 'thegem') => 'justified', __('Masonry Grid ', 'thegem') => 'masonry', __('Metro Style', 'thegem') => 'metro'),
					'dependency' => array(
						'element' => 'portfolio_layout',
						'value' => array('2x', '3x', '4x', '100%')
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Columns 100% Width (1920x Screen)', 'thegem'),
					'param_name' => 'portfolio_fullwidth_columns',
					'value' => array(__('4 Columns', 'thegem') => '4', __('5 Columns', 'thegem') => '5'),
					'dependency' => array(
						'element' => 'portfolio_layout',
						'value' => array('100%')
					),
				),
				array(
					'type' => 'textfield',
					'heading' => __('Gaps Size', 'thegem'),
					'param_name' => 'portfolio_gaps_size',
					'std' => 42,
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Display Titles', 'thegem'),
					'param_name' => 'portfolio_display_titles',
					'value' => array(__('On Page', 'thegem') => 'page', __('On Hover', 'thegem') => 'hover')
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Background Style', 'thegem'),
					'param_name' => 'portfolio_background_style',
					'value' => array(__('White', 'thegem') => 'white', __('Grey', 'thegem') => 'gray', __('Dark', 'thegem') => 'dark'),
					'dependency' => array(
						'element' => 'portfolio_display_titles',
						'value' => array('page')
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Hover Type', 'thegem'),
					'param_name' => 'portfolio_hover',
					'value' => array(__('Cyan Breeze', 'thegem') => 'default', __('Zooming White', 'thegem') => 'zooming-blur', __('Horizontal Sliding', 'thegem') => 'horizontal-sliding', __('Vertical Sliding', 'thegem') => 'vertical-sliding', __('Gradient', 'thegem') => 'gradient', __('Circular Overlay', 'thegem') => 'circular')
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Pagination', 'thegem'),
					'param_name' => 'portfolio_pagination',
					'value' => array(__('Normal', 'thegem') => 'normal', __('Load More ', 'thegem') => 'more', __('Infinite Scroll ', 'thegem') => 'scroll')
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Loading animation', 'thegem'),
					'param_name' => 'loading_animation',
					'std' => 'move-up',
					'value' => array(__('Disabled', 'thegem') => 'disabled', __('Bounce', 'thegem') => 'bounce', __('Move Up', 'thegem') => 'move-up', __('Fade In', 'thegem') => 'fade-in', __('Fall Perspective', 'thegem') => 'fall-perspective', __('Scale', 'thegem') => 'scale', __('Flip', 'thegem') => 'flip'),
				),
				array(
					'type' => 'textfield',
					'heading' => __('Items per page', 'thegem'),
					'param_name' => 'portfolio_items_per_page',
					'std' => '8'
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Show Date & Sets', 'thegem'),
					'param_name' => 'portfolio_show_info',
					'value' => array(__('Yes', 'thegem') => '1')
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Disable sharing buttons', 'thegem'),
					'param_name' => 'portfolio_disable_socials',
					'value' => array(__('Yes', 'thegem') => '1')
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Activate Filter', 'thegem'),
					'param_name' => 'portfolio_with_filter',
					'value' => array(__('Yes', 'thegem') => '1')
				),
				array(
					'type' => 'textfield',
					'heading' => __('Title', 'thegem'),
					'param_name' => 'portfolio_title'
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Activate Likes', 'thegem'),
					'param_name' => 'portfolio_likes',
					'value' => array(__('Yes', 'thegem') => '1')
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Activate Sorting', 'thegem'),
					'param_name' => 'portfolio_sorting',
					'value' => array(__('Yes', 'thegem') => '1')
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Portfolios', 'thegem'),
					'param_name' => 'portfolios',
					'value' => thegem_vc_get_terms('thegem_portfolios'),
					'group' =>__('Select Portfolios', 'thegem'),
					'edit_field_class' => 'thegem-terms-checkboxes'
				),

				array(
					'type' => 'textfield',
					'heading' => __('Button Text', 'thegem'),
					'param_name' => 'button_text',
					'group' => __('Load More Button', 'thegem'),
					'std' => __('Load More', 'thegem'),
					'dependency' => array(
						'element' => 'portfolio_pagination',
						'value' => array('more')
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Style', 'thegem'),
					'param_name' => 'button_style',
					'value' => array(__('Flat', 'thegem') => 'flat', __('Outline', 'thegem') => 'outline'),
					'group' => __('Load More Button', 'thegem'),
					'dependency' => array(
						'element' => 'portfolio_pagination',
						'value' => array('more')
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Size', 'thegem'),
					'param_name' => 'button_size',
					'value' => array(__('Tiny', 'thegem') => 'tiny', __('Small', 'thegem') => 'small', __('Medium', 'thegem') => 'medium', __('Large', 'thegem') => 'large', __('Giant', 'thegem') => 'giant'),
					'std' => 'medium',
					'group' => __('Load More Button', 'thegem'),
					'dependency' => array(
						'element' => 'portfolio_pagination',
						'value' => array('more')
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Text weight', 'thegem'),
					'param_name' => 'button_text_weight',
					'value' => array(__('Normal', 'thegem') => 'normal', __('Thin', 'thegem') => 'thin'),
					'group' => __('Load More Button', 'thegem'),
					'dependency' => array(
						'element' => 'portfolio_pagination',
						'value' => array('more')
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => __('No uppercase', 'thegem'),
					'param_name' => 'button_no_uppercase',
					'value' => array(__('Yes', 'thegem') => '1'),
					'group' => __('Load More Button', 'thegem'),
					'dependency' => array(
						'element' => 'portfolio_pagination',
						'value' => array('more')
					),
				),
				array(
					'type' => 'textfield',
					'heading' => __('Border radius', 'thegem'),
					'param_name' => 'button_corner',
					'std' => 25,
					'group' => __('Load More Button', 'thegem'),
					'dependency' => array(
						'element' => 'portfolio_pagination',
						'value' => array('more')
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Border width', 'thegem'),
					'param_name' => 'button_border',
					'value' => array(1, 2, 3, 4, 5, 6),
					'std' => 2,
					'dependency' => array(
						'element' => 'button_style',
						'value' => array('outline')
					),
					'group' => __('Load More Button', 'thegem'),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Text color', 'thegem'),
					'param_name' => 'button_text_color',
					'group' => __('Load More Button', 'thegem'),
					'dependency' => array(
						'element' => 'portfolio_pagination',
						'value' => array('more')
					),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Hover text color', 'thegem'),
					'param_name' => 'button_hover_text_color',
					'group' => __('Load More Button', 'thegem'),
					'dependency' => array(
						'element' => 'portfolio_pagination',
						'value' => array('more')
					),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Background color', 'thegem'),
					'param_name' => 'button_background_color',
					'dependency' => array(
						'element' => 'button_style',
						'value' => array('flat')
					),
					'std' => '#00bcd5',
					'group' => __('Load More Button', 'thegem'),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Hover background color', 'thegem'),
					'param_name' => 'button_hover_background_color',
					'group' => __('Load More Button', 'thegem'),
					'dependency' => array(
						'element' => 'portfolio_pagination',
						'value' => array('more')
					),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Border color', 'thegem'),
					'param_name' => 'button_border_color',
					'dependency' => array(
						'element' => 'button_style',
						'value' => array('outline')
					),
					'group' => __('Load More Button', 'thegem'),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Hover border color', 'thegem'),
					'param_name' => 'button_hover_border_color',
					'dependency' => array(
						'element' => 'button_style',
						'value' => array('outline')
					),
					'group' => __('Load More Button', 'thegem'),
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Icon pack', 'thegem'),
					'param_name' => 'button_icon_pack',
					'value' => array_merge(array(__('Elegant', 'thegem') => 'elegant', __('Material Design', 'thegem') => 'material', __('FontAwesome', 'thegem') => 'fontawesome'), thegem_userpack_to_dropdown()),
					'std' => 2,
					'group' => __('Load More Button', 'thegem'),
					'dependency' => array(
						'element' => 'portfolio_pagination',
						'value' => array('more')
					),
				),
				array(
					'type' => 'thegem_icon',
					'heading' => __('Icon', 'thegem'),
					'param_name' => 'button_icon_elegant',
					'icon_pack' => 'elegant',
					'dependency' => array(
						'element' => 'button_icon_pack',
						'value' => array('elegant')
					),
					'group' => __('Load More Button', 'thegem'),
				),
				array(
					'type' => 'thegem_icon',
					'heading' => __('Icon', 'thegem'),
					'param_name' => 'button_icon_material',
					'icon_pack' => 'material',
					'dependency' => array(
						'element' => 'button_icon_pack',
						'value' => array('material')
					),
					'group' => __('Load More Button', 'thegem'),
				),
				array(
					'type' => 'thegem_icon',
					'heading' => __('Icon', 'thegem'),
					'param_name' => 'button_icon_fontawesome',
					'icon_pack' => 'fontawesome',
					'dependency' => array(
						'element' => 'button_icon_pack',
						'value' => array('fontawesome')
					),
					'group' => __('Load More Button', 'thegem'),
				),
			),
			thegem_userpack_to_shortcode(array(
				array(
					'type' => 'thegem_icon',
					'heading' => __('Icon', 'thegem'),
					'param_name' => 'button_icon_userpack',
					'icon_pack' => 'userpack',
					'dependency' => array(
						'element' => 'button_icon_pack',
						'value' => array('userpack')
					),
				),
			)),
			array(
				array(
					'type' => 'dropdown',
					'heading' => __( 'Icon position', 'thegem' ),
					'param_name' => 'button_icon_position',
					'value' => array(__( 'Left', 'thegem' ) => 'left', __( 'Right', 'thegem' ) => 'right'),
					'group' => __('Load More Button', 'thegem'),
					'dependency' => array(
						'element' => 'portfolio_pagination',
						'value' => array('more')
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Separatot Style', 'thegem'),
					'param_name' => 'button_separator',
					'value' => array(
						__('None', 'thegem') => '',
						__('Single', 'thegem') => 'single',
						__('Square', 'thegem') => 'square',
						__('Soft Double', 'thegem') => 'soft-double',
						__('Strong Double', 'thegem') => 'strong-double',
						__('Load More', 'thegem') => 'load-more'
					),
					'std' => 'load-more',
					'group' => __('Load More Button', 'thegem'),
					'dependency' => array(
						'element' => 'portfolio_pagination',
						'value' => array('more')
					),
				),
				array(
					'type' => 'textfield',
					'heading' => __('Max. row\'s height in grid (px)', 'thegem'),
					'param_name' => 'metro_max_row_height',
					'dependency' => array(
						'callback' => 'metro_max_row_height_callback'
					),
					'std' => 380,
				),

			)),
		),

		'gem_portfolio_slider' => array(
			'name' => __('Portfolio slider', 'thegem'),
			'base' => 'gem_portfolio_slider',
			'icon' => 'thegem-icon-wpb-ui-portfolio',
			'category' => __('The Gem', 'thegem'),
			'description' => __('Portfolio slider inside content', 'thegem'),
			'params' => array_merge(array(
				array(
					'type' => 'textfield',
					'heading' => __('Title', 'thegem'),
					'param_name' => 'portfolio_title',
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Portfolios', 'thegem'),
					'param_name' => 'portfolios',
					'value' => thegem_vc_get_terms('thegem_portfolios'),
					'group' =>__('Select Portfolios', 'thegem'),
					'edit_field_class' => 'thegem-terms-checkboxes'
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Layout', 'thegem'),
					'param_name' => 'portfolio_layout',
					'value' => array(__('3x columns', 'thegem') => '3x', __('100% width', 'thegem') => '100%')
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Columns 100% Width (1920x Screen)', 'thegem'),
					'param_name' => 'portfolio_fullwidth_columns',
					'value' => array(__('3 Columns', 'thegem') => '3', __('4 Columns', 'thegem') => '4', __('5 Columns', 'thegem') => '5'),
					'std' => '4',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Gaps Size', 'thegem'),
					'param_name' => 'portfolio_gaps_size',
					'std' => 42,
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Display Titles', 'thegem'),
					'param_name' => 'portfolio_display_titles',
					'value' => array(__('On Page', 'thegem') => 'page', __('On Hover', 'thegem') => 'hover')
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Hover Type', 'thegem'),
					'param_name' => 'portfolio_hover',
					'value' => array(__('Cyan Breeze', 'thegem') => 'default', __('Zooming White', 'thegem') => 'zooming-blur', __('Horizontal Sliding', 'thegem') => 'horizontal-sliding', __('Vertical Sliding', 'thegem') => 'vertical-sliding', __('Gradient', 'thegem') => 'gradient', __('Circular Overlay', 'thegem') => 'circular')
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Background Style', 'thegem'),
					'param_name' => 'portfolio_background_style',
					'value' => array(__('White', 'thegem') => 'white', __('Grey', 'thegem') => 'gray', __('Dark', 'thegem') => 'dark'),
					'dependency' => array(
						'element' => 'portfolio_display_titles',
						'value' => array('page')
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Show Date & Sets', 'thegem'),
					'param_name' => 'portfolio_show_info',
					'value' => array(__('Yes', 'thegem') => '1')
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Disable sharing buttons', 'thegem'),
					'param_name' => 'portfolio_disable_socials',
					'value' => array(__('Yes', 'thegem') => '1')
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Lazy loading enabled', 'thegem'),
					'param_name' => 'effects_enabled',
					'value' => array(__('Yes', 'thegem') => '1')
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Activate Likes', 'thegem'),
					'param_name' => 'portfolio_likes',
					'value' => array(__('Yes', 'thegem') => '1')
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Arrow', 'thegem'),
					'param_name' => 'portfolio_slider_arrow',
					'value' => array(__('Big', 'thegem') => 'portfolio_slider_arrow_big', __('Small', 'thegem') => 'portfolio_slider_arrow_small')
				),
				array(
					'type' => 'textfield',
					'heading' => __('Autoscroll', 'thegem'),
					'param_name' => 'portfolio_autoscroll',
				),
			)),
		),

		'gem_pricing_column' => array(
			'name' => __('Pricing Table Column', 'thegem'),
			'base' => 'gem_pricing_column',
			'icon' => 'thegem-icon-wpb-ui-pricing-column',
			'as_parent' => array('only' => 'gem_pricing_price,gem_pricing_row,gem_pricing_row_title,gem_pricing_footer'),
			'as_child' => array('only' => 'gem_pricing_table'),
			'category' => __('The Gem', 'thegem'),
			'is_container' => true,
			'js_view' => 'VcGemPricingColumnView',
			'params' => array_merge(array(
				array(
					'type' => 'textfield',
					'heading' => __('Top Choice', 'thegem'),
					'param_name' => 'top_choice',
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Highlighted', 'thegem'),
					'param_name' => 'highlighted',
					'value' => array(__('Yes', 'thegem') => '1')
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Column width', 'thegem'),
					'param_name' => 'cols',
					'value' => array(3, 4),
				),
					array(
					'type' => 'colorpicker',
					'heading' => __('Top choice color', 'thegem'),
					'param_name' => 'top_choice_color',
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Top choice background color', 'thegem'),
					'param_name' => 'top_choice_background_color',
				)
			)),
		),

		'gem_pricing_price' => array(
			'name' => __("Column's Header", 'thegem'),
			'base' => 'gem_pricing_price',
			'icon' => 'thegem-icon-wpb-ui-pricing-price',
			'as_child' => array('only' => 'gem_pricing_column'),
			'category' => __('The Gem', 'thegem'),
			'params' => array_merge(array(
				array(
					'type' => 'textfield',
					'heading' => __('Column title', 'thegem'),
					'param_name' => 'title',
					'value' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => __('Column subtitle', 'thegem'),
					'param_name' => 'subtitle',
					'value' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Price background color ', 'thegem'),
					'param_name' => 'backgroundcolor',
				),
				array(
					'type' => 'attach_image',
					'heading' => __('Price background image', 'thegem'),
					'param_name' => 'background',
				),

				array(
					'type' => 'textfield',
					'heading' => __('Currency', 'thegem'),
					'param_name' => 'currency',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Price', 'thegem'),
					'param_name' => 'price',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Time period', 'thegem'),
					'param_name' => 'time',
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Styles', 'thegem'),
					'param_name' => 'font_size_label',
					'value' => array(__('Use default styles', 'thegem') => 'default', __('Use custom styles', 'thegem') => 'custom'),
					'dependency' => array(
						'element' => 'style',
					),
				),
				array(
					'type' => 'textfield',
					'heading' => __('Set font size of the price', 'thegem'),
					'param_name' => 'font_size',
					'dependency' => array(
						'element' => 'font_size_label',
						'value' => array('custom')
					),
				),
				array(
					'type' => 'textfield',
					'heading' => __('Set font size of the time', 'thegem'),
					'param_name' => 'font_size_time',
					'dependency' => array(
						'element' => 'font_size_label',
						'value' => array('custom')
					),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Set color for Price', 'thegem'),
					'param_name' => 'price_color',
					'dependency' => array(
						'element' => 'font_size_label',
						'value' => array('custom')
					),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Set color for title', 'thegem'),
					'param_name' => 'title_color',
					'dependency' => array(
						'element' => 'font_size_label',
						'value' => array('custom')
					),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Set color for subtitle', 'thegem'),
					'param_name' => 'subtitle_color',
					'dependency' => array(
						'element' => 'font_size_label',
						'value' => array('custom')
					),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Set color for time', 'thegem'),
					'param_name' => 'time_color',
					'dependency' => array(
						'element' => 'font_size_label',
						'value' => array('custom')
					),
				),
			)),
		),

		'gem_pricing_row' => array(
			'name' => __("Column's Row", 'thegem'),
			'base' => 'gem_pricing_row',
			'icon' => 'thegem-icon-wpb-ui-pricing-row',
			'as_child' => array('only' => 'gem_pricing_column'),
			'category' => __('The Gem', 'thegem'),
			'params' => array_merge(array(
				array(
					'type' => 'textarea_html',
					'heading' => __('Content', 'thegem'),
					'param_name' => 'content',
					'value' => '#'
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Strike', 'thegem'),
					'param_name' => 'strike',
					'value' => array(__('Yes', 'thegem') => '1')
				),
			)),
		),
		'gem_pricing_row_title' => array(
			'name' => __("Column's Extra Title", 'thegem'),
			'base' => 'gem_pricing_row_title',
			'icon' => 'thegem-icon-wpb-ui-pricing-row',
			'as_child' => array('only' => 'gem_pricing_column'),
			'category' => __('The Gem', 'thegem'),
			'params' => array_merge(array(
				array(
					'type' => 'textfield',
					'heading' => __('Extra Title', 'thegem'),
					'param_name' => 'content',
					'value' => '#'
				),
				array(
					'type' => 'textfield',
					'heading' => __('Extra Subtitle', 'thegem'),
					'param_name' => 'subtitle',
					'value' => '#'
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Extra Title Color', 'thegem'),
					'param_name' => 'title_color',

				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Extra Subtitle Color', 'thegem'),
					'param_name' => 'subtitle_color',

				),
			)),
		),
		'gem_pricing_footer' => array(
			'name' => __("Column's Footer", 'thegem'),
			'base' => 'gem_pricing_footer',
			'icon' => 'thegem-icon-wpb-ui-pricing-footer',
			'as_child' => array('only' => 'gem_pricing_column'),
			'category' => __('The Gem', 'thegem'),
			'params' => array_merge(array(
				array(
					'type' => 'textfield',
					'heading' => __('Button Text', 'thegem'),
					'param_name' => 'button_1_text',
				),
				array(
					'type' => 'vc_link',
					'heading' => __( 'URL (Link)', 'thegem' ),
					'param_name' => 'button_1_link',
					'description' => __( 'Add link to button.', 'thegem' )
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Style', 'thegem'),
					'param_name' => 'button_1_style',
					'value' => array(__('Flat', 'thegem') => 'flat', __('Outline', 'thegem') => 'outline')
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Size', 'thegem'),
					'param_name' => 'button_1_size',
					'value' => array(__('Tiny', 'thegem') => 'tiny', __('Small', 'thegem') => 'small', __('Medium', 'thegem') => 'medium', __('Large', 'thegem') => 'large', __('Giant', 'thegem') => 'giant'),
					'std' => 'small'
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Text weight', 'thegem'),
					'param_name' => 'button_1_text_weight',
					'value' => array(__('Normal', 'thegem') => 'normal', __('Thin', 'thegem') => 'thin'),
				),
				array(
					'type' => 'checkbox',
					'heading' => __('No uppercase', 'thegem'),
					'param_name' => 'button_1_no_uppercase',
					'value' => array(__('Yes', 'thegem') => '1')
				),
				array(
					'type' => 'textfield',
					'heading' => __('Border radius', 'thegem'),
					'param_name' => 'button_1_corner',
					'value' => 3,
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Border width', 'thegem'),
					'param_name' => 'button_1_border',
					'value' => array(1, 2, 3, 4, 5, 6),
					'std' => 2,
					'dependency' => array(
						'element' => 'button_1_style',
						'value' => array('outline')
					),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Text color', 'thegem'),
					'param_name' => 'button_1_text_color',
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Hover text color', 'thegem'),
					'param_name' => 'button_1_hover_text_color',
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Background color', 'thegem'),
					'param_name' => 'button_1_background_color',
					'dependency' => array(
						'element' => 'button_1_style',
						'value' => array('flat')
					),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Hover background color', 'thegem'),
					'param_name' => 'button_1_hover_background_color',
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Border color', 'thegem'),
					'param_name' => 'button_1_border_color',
					'dependency' => array(
						'element' => 'button_1_style',
						'value' => array('outline')
					),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Hover border color', 'thegem'),
					'param_name' => 'button_1_hover_border_color',
					'dependency' => array(
						'element' => 'button_1_style',
						'value' => array('outline')
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Icon pack', 'thegem'),
					'param_name' => 'button_1_icon_pack',
					'value' => array_merge(array(__('Elegant', 'thegem') => 'elegant', __('Material Design', 'thegem') => 'material', __('FontAwesome', 'thegem') => 'fontawesome'), thegem_userpack_to_dropdown()),
					'std' => 2,
				),
				array(
					'type' => 'thegem_icon',
					'heading' => __('Icon', 'thegem'),
					'param_name' => 'button_1_icon_elegant',
					'icon_pack' => 'elegant',
					'dependency' => array(
						'element' => 'button_1_icon_pack',
						'value' => array('elegant')
					),
				),
				array(
					'type' => 'thegem_icon',
					'heading' => __('Icon', 'thegem'),
					'param_name' => 'button_1_icon_material',
					'icon_pack' => 'material',
					'dependency' => array(
						'element' => 'button_1_icon_pack',
						'value' => array('material')
					),
				),
				array(
					'type' => 'thegem_icon',
					'heading' => __('Icon', 'thegem'),
					'param_name' => 'button_1_icon_fontawesome',
					'icon_pack' => 'fontawesome',
					'dependency' => array(
						'element' => 'button_1_icon_pack',
						'value' => array('fontawesome')
					),
				),
			),
			thegem_userpack_to_shortcode(array(
				array(
					'type' => 'thegem_icon',
					'heading' => __('Icon', 'thegem'),
					'param_name' => 'button_1_icon_userpack',
					'icon_pack' => 'userpack',
					'dependency' => array(
						'element' => 'button_1_icon_pack',
						'value' => array('userpack')
					),
				),
			)),
			array(
				array(
					'type' => 'dropdown',
					'heading' => __( 'Icon position', 'thegem' ),
					'param_name' => 'button_1_icon_position',
					'value' => array(__( 'Left', 'thegem' ) => 'left', __( 'Right', 'thegem' ) => 'right'),
				),

			)),
		),

		'gem_pricing_table' => array(
			'name' => __('Pricing table', 'thegem'),
			'base' => 'gem_pricing_table',
			'icon' => 'thegem-icon-wpb-ui-pricing-table',
			'is_container' => true,
			'js_view' => 'VcGemPricingTableView',
			'as_parent' => array('only' => 'gem_pricing_column'),
			'category' => __('The Gem', 'thegem'),
			'description' => __('Styled pricing table', 'thegem'),
			'params' => array_merge(array(
				array(
					'type' => 'dropdown',
					'heading' => __('Style', 'thegem'),
					'param_name' => 'style',
					'value' => array(__('Style 1', 'thegem') => '1', __('Style 2', 'thegem') => '2', __('Style 3', 'thegem') => '3', __('Style 4', 'thegem') => '4', __('Style 5', 'thegem') => '5', __('Style 6', 'thegem') => '6', __('Style 7', 'thegem') => '7', __('Style 8', 'thegem') => '8')
				),
			)),
		),

		'gem_quickfinder' => array(
			'name' => __('Quickfinder', 'thegem'),
			'base' => 'gem_quickfinder',
			'icon' => 'thegem-icon-wpb-ui-quickfinder',
			'category' => __('The Gem', 'thegem'),
			'description' => __('Quickfinder overviews inside content', 'thegem'),
			'params' => array_merge(array(
				array(
					'type' => 'dropdown',
					'heading' => __('Style', 'thegem'),
					'param_name' => 'style',
					'value' => array(
						__('Default Style', 'thegem') => 'default',
						__('Classic Box', 'thegem') => 'classic',
						__('Iconed Box', 'thegem') => 'iconed',
						__('Binded Box', 'thegem') => 'binded',
						__('Binded Iconed Boxes', 'thegem') => 'binded-iconed',
						__('Tag Box', 'thegem') => 'tag',
						__('Vertical Style 1', 'thegem') => 'vertical-1',
						__('Vertical Style 2', 'thegem') => 'vertical-2',
						__('Vertical Style 3', 'thegem') => 'vertical-3',
						__('Vertical Style 4', 'thegem') => 'vertical-4',
					)
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Number Of Columns', 'thegem'),
					'param_name' => 'columns',
					'value' => array(1,2,3,4,6),
					'std' => 3,
					'dependency' => array(
						'element' => 'style',
						'value' => array('classic', 'iconed', 'binded', 'binded-iconed', 'tag')
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Box Style', 'thegem'),
					'param_name' => 'box_style',
					'value' => array(
						__('Solid', 'thegem') => 'solid',
						__('Soft Outlined', 'thegem') => 'soft-outlined',
						__('Strong Outlined', 'thegem') => 'strong-outlined',
					),
					'dependency' => array(
						'element' => 'style',
						'value' => array('classic', 'iconed', 'binded', 'binded-iconed', 'tag')
					),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Box Background Color', 'thegem'),
					'param_name' => 'box_background_color',
					'dependency' => array(
						'element' => 'style',
						'value' => array('classic', 'iconed', 'binded', 'binded-iconed', 'tag')
					),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Box Border Color', 'thegem'),
					'param_name' => 'box_border_color',
					'dependency' => array(
						'element' => 'box_style',
						'value' => array('soft-outlined', 'strong-outlined')
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Alignment', 'thegem'),
					'param_name' => 'alignment',
					'value' => array(
						__('Centered', 'thegem') => 'center',
						__('Left', 'thegem') => 'left',
						__('Right', 'thegem') => 'right',
					),
					'dependency' => array(
						'element' => 'style',
						'value' => array('classic', 'iconed', 'binded', 'binded-iconed', 'tag', 'vertical-3')
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Icon Position', 'thegem'),
					'param_name' => 'icon_position',
					'value' => array(
						__('Top', 'thegem') => 'top',
						__('Bottom', 'thegem') => 'bottom',
						__('Top float', 'thegem') => 'top-float',
						__('Center float', 'thegem') => 'center-float',
					),
					'dependency' => array(
						'element' => 'style',
						'value' => array('classic', 'iconed', 'binded', 'binded-iconed', 'tag')
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Title Weight', 'thegem'),
					'param_name' => 'title_weight',
					'value' => array(
						__('Bold', 'thegem') => 'bold',
						__('Thin', 'thegem') => 'thin',
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Activate Button', 'thegem'),
					'param_name' => 'activate_button',
					'value' => array(__('Yes', 'thegem') => '1'),
					'dependency' => array(
						'element' => 'style',
						'value' => array('classic', 'iconed', 'binded', 'binded-iconed', 'tag')
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Button Style', 'thegem'),
					'param_name' => 'button_style',
					'value' => array(__('Flat', 'thegem') => 'flat', __('Outline', 'thegem') => 'outline'),
					'dependency' => array(
						'element' => 'activate_button',
						'not_empty' => true
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Button Text weight', 'thegem'),
					'param_name' => 'button_text_weight',
					'value' => array(__('Normal', 'thegem') => 'normal', __('Thin', 'thegem') => 'thin'),
					'dependency' => array(
						'element' => 'activate_button',
						'not_empty' => true
					),
				),
				array(
					'type' => 'textfield',
					'heading' => __('Button Border radius', 'thegem'),
					'param_name' => 'button_corner',
					'value' => 3,
					'dependency' => array(
						'element' => 'activate_button',
						'not_empty' => true
					),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Button Text color', 'thegem'),
					'param_name' => 'button_text_color',
					'dependency' => array(
						'element' => 'activate_button',
						'not_empty' => true
					),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Button Background color', 'thegem'),
					'param_name' => 'button_background_color',
					'dependency' => array(
						'element' => 'button_style',
						'value' => array('flat')
					),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Button Border color', 'thegem'),
					'param_name' => 'button_border_color',
					'dependency' => array(
						'element' => 'button_style',
						'value' => array('outline')
					),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Hover Icon Color', 'thegem'),
					'param_name' => 'hover_icon_color',
					'group' => __('Hovers', 'thegem'),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Hover Box Color', 'thegem'),
					'param_name' => 'hover_box_color',
					'group' => __('Hovers', 'thegem'),
					'dependency' => array(
						'element' => 'style',
						'value' => array('classic', 'iconed', 'binded', 'binded-iconed', 'tag')
					),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Hover Border Color', 'thegem'),
					'param_name' => 'hover_border_color',
					'group' => __('Hovers', 'thegem'),
					'dependency' => array(
						'element' => 'box_style',
						'value' => array('soft-outlined', 'strong-outlined')
					),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Hover Title Color', 'thegem'),
					'param_name' => 'hover_title_color',
					'group' => __('Hovers', 'thegem'),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Hover Description Color', 'thegem'),
					'param_name' => 'hover_description_color',
					'group' => __('Hovers', 'thegem'),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Hover Button Text Color', 'thegem'),
					'param_name' => 'hover_button_text_color',
					'group' => __('Hovers', 'thegem'),
					'dependency' => array(
						'element' => 'activate_button',
						'not_empty' => true
					),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Hover Button Background Color', 'thegem'),
					'param_name' => 'hover_button_background_color',
					'group' => __('Hovers', 'thegem'),
					'dependency' => array(
						'element' => 'activate_button',
						'not_empty' => true
					),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Hover Button Border Color', 'thegem'),
					'param_name' => 'hover_button_border_color',
					'group' => __('Hovers', 'thegem'),
					'dependency' => array(
						'element' => 'button_style',
						'value' => array('outline')
					),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Connector Color', 'thegem'),
					'param_name' => 'connector_color',
					'dependency' => array(
						'element' => 'style',
						'value' => array('vertical-1', 'vertical-2', 'vertical-3', 'vertical-4')
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Lazy loading enabled', 'thegem'),
					'param_name' => 'effects_enabled',
					'value' => array(__('Yes', 'thegem') => '1')
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Quickfinders', 'thegem'),
					'param_name' => 'quickfinders',
					'value' => thegem_vc_get_terms('thegem_quickfinders'),
					'group' =>__('Select Quickfinders', 'thegem'),
					'edit_field_class' => 'thegem-terms-checkboxes'
				),
			)),
		),

		'gem_quote' => array(
			'name' => __('Quoted text', 'thegem'),
			'base' => 'gem_quote',
			'icon' => 'thegem-icon-wpb-ui-quote',
			'category' => __('The Gem', 'thegem'),
			'description' => __('Quoted text content', 'thegem'),
			'params' => array_merge(array(
				array(
					'type' => 'textarea_html',
					'heading' => __('Content', 'thegem'),
					'param_name' => 'content',
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Style', 'thegem'),
					'param_name' => 'style',
					'value' => array(
						__('Default', 'thegem') => 'default',
						__('Style 1', 'thegem') => '1',
						__('Style 2', 'thegem') => '2',
						__('Style 3', 'thegem') => '3',
						__('Style 4', 'thegem') => '4',
						__('Style 5', 'thegem') => '5',
					)
				),
				array(
					'type' => 'checkbox',
					'heading' => __('No Paddings', 'thegem'),
					'param_name' => 'no_paddings',
					'value' => array(__('Yes', 'thegem') => '1')
				),
			)),
		),

		'gem_search_form' => array(
			'name' => __('Search form', 'thegem'),
			'base' => 'gem_search_form',
			'is_container' => false,
			'icon' => 'thegem-icon-wpb-ui-search-form',
			'category' => __('The Gem', 'thegem'),
			'description' => __('Search form', 'thegem'),
			'params' => array_merge(array(
				array(
					'type' => 'dropdown',
					'heading' => __('Style', 'thegem'),
					'param_name' => 'style',
					'value' => array(
						__('Light', 'thegem') => 'light',
						__('Dark', 'thegem') => 'dark',
					)
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Alignment', 'thegem'),
					'param_name' => 'alignment',
					'value' => array(
						__('Left', 'thegem') => 'left',
						__('Right', 'thegem') => 'right',
						__('Center', 'thegem') => 'center',
					)
				),
				array(
					'type' => 'textfield',
					'heading' => __('Placehoder', 'thegem'),
					'param_name' => 'placeholder',
					'std' => __('Search', 'thegem')
				),
			)),
		),

		'gem_socials' => array(
			'name' => __('Socials', 'thegem'),
			'base' => 'gem_socials',
			'is_container' => false,
			'icon' => 'thegem-icon-wpb-ui-socials',
			'category' => __('The Gem', 'thegem'),
			'description' => __('Socials', 'thegem'),
			'params' => array_merge(array(
				array(
					'type' => 'dropdown',
					'heading' => __('Style', 'thegem'),
					'param_name' => 'style',
					'value' => array(
						__('Default', 'thegem') => 'default',
						__('Rounded', 'thegem') => 'rounded',
						__('Square', 'thegem') => 'square',
					)
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Icons color', 'thegem'),
					'param_name' => 'colored',
					'value' => array(
						__('Default', 'thegem') => 'default',
						__('Custom', 'thegem') => 'custom',
					)
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Custom color', 'thegem'),
					'param_name' => 'color',
					'dependency' => array(
						'element' => 'colored',
						'value' => 'custom'
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Alignment', 'thegem'),
					'param_name' => 'alignment',
					'value' => array(
						__('Left', 'thegem') => 'left',
						__('Right', 'thegem') => 'right',
						__('Center', 'thegem') => 'center',
					)
				),
				array(
					'type' => 'textfield',
					'heading' => __('Icons size', 'thegem'),
					'param_name' => 'icons_size',
					'std' => 16
				),
				array(
					'type' => 'param_group',
					'heading' => __( 'Socials', 'thegem' ),
					'param_name' => 'socials',
					'value' => urlencode(json_encode(array(
						array(
							'social' => 'facebook',
							'url' => '#',
						),
						array(
							'social' => 'twitter',
							'url' => '#',
						),
						array(
							'social' => 'googleplus',
							'url' => '#',
						),
					))),
					'params' => array_merge(array(
						array(
							'type' => 'dropdown',
							'heading' => __( 'Social', 'thegem' ),
							'param_name' => 'social',
							'value' => array(
								__('Facebook', 'thegem') => 'facebook',
								__('Twitter', 'thegem') => 'twitter',
								__('Pinterest', 'thegem') => 'pinterest',
								__('Google Plus', 'thegem') => 'googleplus',
								__('Tumblr', 'thegem') => 'tumblr',
								__('StumbleUpon', 'thegem') => 'stumbleupon',
								__('Wordpress', 'thegem') => 'wordpress',
								__('Instagram', 'thegem') => 'instagram',
								__('Dribbble', 'thegem') => 'dribbble',
								__('Vimeo', 'thegem') => 'vimeo',
								__('Linkedin', 'thegem') => 'linkedin',
								__('RSS', 'thegem') => 'rss',
								__('DeviantArt', 'thegem') => 'deviantart',
								__('Share', 'thegem') => 'share',
								__('MySpace,', 'thegem') => 'myspace',
								__('Skype', 'thegem') => 'skype',
								__('Youtube', 'thegem') => 'youtube',
								__('Picassa', 'thegem') => 'picassa',
								__('Google Drive', 'thegem') => 'googledrive',
								__('Flickr', 'thegem') => 'flickr',
								__('Blogger', 'thegem') => 'blogger',
								__('Spotify', 'thegem') => 'spotify',
								__('Delicious', 'thegem') => 'delicious',
							),
						),
						array(
							'type' => 'textfield',
							'heading' => __('Url', 'thegem'),
							'param_name' => 'url',
							'std' => '#'
						),
					)),
				),

			)),
		),

		'gem_video' => array(
			'name' => __('Self-Hosted Video ', 'thegem'),
			'base' => 'gem_video',
			'icon' => 'thegem-icon-wpb-ui-video',
			'category' => __('The Gem', 'thegem'),
			'description' => __('Video content', 'thegem'),
			'params' => array_merge(array(
				array(
					'type' => 'textfield',
					'heading' => __('Width', 'thegem'),
					'param_name' => 'width',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Height', 'thegem'),
					'param_name' => 'height',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Video Aspect ratio (16:9, 16:10, 4:3...)', 'thegem'),
					'param_name' => 'aspect_ratio',
					'value' => '16:9'
				),
				array(
					'type' => 'textfield',
					'heading' => __('Video URL in mp4 or flv format', 'thegem'),
					'param_name' => 'video_src',
				),
				array(
					'type' => 'attach_image',
					'heading' => __('Poster Image', 'thegem'),
					'param_name' => 'image_src',
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Border Style', 'thegem'),
					'param_name' => 'style',
					'value' => array(
						__('no border', 'thegem') => 'default',
						__('8px & border', 'thegem') => '1',
						__('16px & border', 'thegem') => '2',
						__('8px outlined border', 'thegem') => '3',
						__('20px outlined border', 'thegem') => '4',
						__('20px border with shadow', 'thegem') => '5',
						__('Combined border', 'thegem') => '6',
						__('20px border radius', 'thegem') => '7',
						__('55px border radius', 'thegem') => '8',
						__('Dashed inside', 'thegem') => '9',
						__('Dashed outside', 'thegem') => '10',
						__('Rounded with border', 'thegem') => '11'
					)
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Position', 'thegem'),
					'param_name' => 'position',
					'value' => array(__('below', 'thegem') => 'below', __('left', 'thegem') => 'left', __('right', 'thegem') => 'right')
				),
			)),
		),

		'gem_gallery' => array(
			'name' => __('Styled Gallery', 'thegem'),
			'base' => 'gem_gallery',
			'icon' => 'thegem-icon-wpb-ui-gallery',
			'category' => __('The Gem', 'thegem'),
			'description' => __('Image gallery in different styles', 'thegem'),
			'params' => array_merge(array(
				array(
					'type' => 'dropdown',
					'heading' => __('Gallery', 'thegem'),
					'param_name' => 'gallery_gallery',
					'value' => thegem_vc_get_galleries(),
					'save_always' => true,
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Gallery Type', 'thegem'),
					'param_name' => 'gallery_type',
					'description' => __('Choose gallery type', 'thegem'),
					'value' => array(__('Slider', 'thegem') => 'slider', __('Grid', 'thegem') => 'grid')
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Layout', 'thegem'),
					'param_name' => 'gallery_slider_layout',
					'value' => array(__('fullwidth', 'thegem') => 'fullwidth', __('Sidebar', 'thegem') => 'sidebar'),
					'dependency' => array(
						'element' => 'gallery_type',
						'value' => array('slider')
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Disable thumbnails bar', 'thegem'),
					'param_name' => 'no_thumbs',
					'value' => array(__('Yes', 'thegem') => '1'),
					'dependency' => array(
						'element' => 'gallery_type',
						'value' => array('slider')
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Pagination', 'thegem'),
					'param_name' => 'pagination',
					'value' => array(__('Yes', 'thegem') => '1'),
					'dependency' => array(
						'element' => 'no_thumbs',
						'not_empty' => true
					),
				),
				array(
					'type' => 'textfield',
					'heading' => __('Autoscroll', 'thegem'),
					'param_name' => 'autoscroll',
					'dependency' => array(
						'element' => 'gallery_type',
						'value' => array('slider')
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Layout', 'thegem'),
					'param_name' => 'gallery_layout',
					'description' => __('Choose gallery layout', 'thegem'),
					'value' => array(__('2x columns', 'thegem') => '2x', __('3x columns', 'thegem') => '3x', __('4x columns', 'thegem') => '4x', __('100% width', 'thegem') => '100%'),
					'dependency' => array(
						'element' => 'gallery_type',
						'value' => array('grid')
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Style', 'thegem'),
					'param_name' => 'gallery_style',
					'description' => __('Choose gallery style', 'thegem'),
					'value' => array(__('Justified Grid', 'thegem') => 'justified', __('Masonry Grid', 'thegem') => 'masonry', __('Metro Style', 'thegem') => 'metro'),
					'dependency' => array(
						'element' => 'gallery_type',
						'value' => array('grid')
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Columns 100% Width (1920x Screen)', 'thegem'),
					'param_name' => 'gallery_fullwidth_columns',
					'value' => array(__('4 Columns', 'thegem') => '4', __('5 Columns', 'thegem') => '5'),
					'dependency' => array(
						'element' => 'gallery_layout',
						'value' => array('100%')
					),
				),
				array(
					'type' => 'textfield',
					'heading' => __('Gaps size (px)', 'thegem'),
					'param_name' => 'gaps_size',
					'dependency' => array(
						'element' => 'gallery_type',
						'value' => array('grid')
					),
					'std' => 42,

				),
				// array(
				// 	'type' => 'checkbox',
				// 	'heading' => __('No Gaps', 'thegem'),
				// 	'param_name' => 'gallery_no_gaps',
				// 	'value' => array(__('Yes', 'thegem') => '1'),
				// 	'dependency' => array(
				// 		'element' => 'gallery_type',
				// 		'value' => array('grid')
				// 	),
				// ),
				array(
					'type' => 'dropdown',
					'heading' => __('Hover Type', 'thegem'),
					'param_name' => 'gallery_hover',
					'value' => array(__('Cyan Breeze', 'thegem') => 'default', __('Zooming White', 'thegem') => 'zooming-blur', __('Horizontal Sliding', 'thegem') => 'horizontal-sliding', __('Vertical Sliding', 'thegem') => 'vertical-sliding', __('Gradient', 'thegem') => 'gradient', __('Circular Overlay', 'thegem') => 'circular')
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Border Style', 'thegem'),
					'param_name' => 'gallery_item_style',
					'value' => array(
						__('no border', 'thegem') => 'default',
						__('8px & border', 'thegem') => '1',
						__('16px & border', 'thegem') => '2',
						__('8px outlined border', 'thegem') => '3',
						__('20px outlined border', 'thegem') => '4',
						__('20px border with shadow', 'thegem') => '5',
						__('Combined border', 'thegem') => '6',
						__('20px border radius', 'thegem') => '7',
						__('55px border radius', 'thegem') => '8',
						__('Dashed inside', 'thegem') => '9',
						__('Dashed outside', 'thegem') => '10',
						__('Rounded with border', 'thegem') => '11'
					),
					'dependency' => array(
						'element' => 'gallery_type',
						'value' => array('grid')
					),
				),
				array(
					'type' => 'textfield',
					'heading' => __('Title', 'thegem'),
					'param_name' => 'gallery_title',
					'dependency' => array(
						'element' => 'gallery_type',
						'value' => array('grid')
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Loading animation', 'thegem'),
					'param_name' => 'loading_animation',
					'std' => 'move-up',
					'value' => array(__('Disabled', 'thegem') => 'disabled', __('Bounce', 'thegem') => 'bounce', __('Move Up', 'thegem') => 'move-up', __('Fade In', 'thegem') => 'fade-in', __('Fall Perspective', 'thegem') => 'fall-perspective', __('Scale', 'thegem') => 'scale', __('Flip', 'thegem') => 'flip'),
					'dependency' => array(
						'element' => 'gallery_type',
						'value' => array('grid')
					),
				),
				array(
					'type' => 'textfield',
					'heading' => __('Max. row\'s height in grid (px)', 'thegem'),
					'param_name' => 'metro_max_row_height',
					'dependency' => array(
						'callback' => 'metro_max_row_height_callback'
					),
					'std' => 380,
				),
			)),
		),

		'gem_image' => array(
			'name' => __('Styled Image', 'thegem'),
			'base' => 'gem_image',
			'icon' => 'thegem-icon-wpb-ui-image',
			'category' => __('The Gem', 'thegem'),
			'description' => __('Image in different styles', 'thegem'),
			'params' => array_merge(array(
				array(
					'type' => 'textfield',
					'heading' => __('Width', 'thegem'),
					'param_name' => 'width',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Height', 'thegem'),
					'param_name' => 'height',
				),
				array(
					'type' => 'attach_image',
					'heading' => __('Src', 'thegem'),
					'param_name' => 'src',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Alt text', 'thegem'),
					'param_name' => 'alt',
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Border Style', 'thegem'),
					'param_name' => 'style',
					'value' => array(
						__('no border', 'thegem') => 'default',
						__('8px & border', 'thegem') => '1',
						__('16px & border', 'thegem') => '2',
						__('8px outlined border', 'thegem') => '3',
						__('20px outlined border', 'thegem') => '4',
						__('20px border with shadow', 'thegem') => '5',
						__('Combined border', 'thegem') => '6',
						__('20px border radius', 'thegem') => '7',
						__('55px border radius', 'thegem') => '8',
						__('Dashed inside', 'thegem') => '9',
						__('Dashed outside', 'thegem') => '10',
						__('Rounded with border', 'thegem') => '11',
						__('Rounded without border', 'thegem') => '14'
					)
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Position', 'thegem'),
					'param_name' => 'position',
					'value' => array(__('below', 'thegem') => 'below', __('centered', 'thegem') => 'centered', __('left', 'thegem') => 'left', __('right', 'thegem') => 'right')
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Disable lightbox', 'thegem'),
					'param_name' => 'disable_lightbox',
					'value' => array(__('Yes', 'thegem') => '1')
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Lazy loading enabled', 'scalia'),
					'param_name' => 'effects_enabled',
					'value' => array(__('Yes', 'thegem') => '1')
				),
			)),
		),

		'gem_list' => array(
			'name' => __('Styled List', 'thegem'),
			'base' => 'gem_list',
			'icon' => 'thegem-icon-wpb-ui-list',
			'category' => __('The Gem', 'thegem'),
			'description' => __('List in different styles', 'thegem'),
			'params' => array_merge(array(
				array(
					'type' => 'dropdown',
					'heading' => __('Type', 'thegem'),
					'param_name' => 'type',
					'value' => array(__('Default', 'thegem') => '', __('Arrow', 'thegem') => 'arrow', __('Double arrow', 'thegem') => 'double-arrow',__('Check style 1', 'thegem') => 'check-style-1', __('Check style 2', 'thegem') => 'check-style-2', __('Disc style 1', 'thegem') => 'disc-style-1', __('Disc style 2', 'thegem') => 'disc-style-2', __('Checkbox', 'thegem') => 'checkbox', __('Cross', 'thegem') => 'cross', __('Snowflake style 1', 'thegem') => 'snowflake-style-1', __('Snowflake style 2', 'thegem') => 'snowflake-style-2', __('Square', 'thegem') => 'square', __('Star', 'thegem') => 'star', __('Plus', 'thegem') => 'plus', __('Label', 'thegem') => 'Label')
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Color', 'thegem'),
					'param_name' => 'color',
					'value' => array(
						__('Default Gray', 'thegem') => '',
						__('Aubergine', 'thegem') => '1',
						__('Teal', 'thegem') => '2',
						__('Cyan', 'thegem') => '3',
						__('Amber', 'thegem') => '4',
						__('Red', 'thegem') => '5',
						__('Deep Purple', 'thegem') => '6',
						__('Purple', 'thegem') => '7',
						__('Brown', 'thegem') => '8',
						__('Light Red ', 'thegem') => '9',
						__('Dark Pink', 'thegem') => '10',
						__('Lime', 'thegem') => '11'
					)

				),
				array(
					'type' => 'textarea_html',
					'heading' => __('Content', 'thegem'),
					'param_name' => 'content',
					'value' => '<ul>'."\n".'<li>'.__('Element 1', 'thegem').'</li>'."\n".'<li>'.__('Element 2', 'thegem').'</li>'."\n".'<li>'.__('Element 3', 'thegem').'</li>'."\n".'</ul>'
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Lazy loading enabled', 'thegem'),
					'param_name' => 'effects_enabled',
					'value' => array(__('Yes', 'thegem') => '1')
				),
			)),
		),

		'gem_table' => array(
			'name' => __('Table', 'thegem'),
			'base' => 'gem_table',
			'icon' => 'thegem-icon-wpb-ui-table',
			'category' => __('The Gem', 'thegem'),
			'description' => __('Styled table content', 'thegem'),
			'params' => array_merge(array(
				array(
					'type' => 'dropdown',
					'heading' => __('Style', 'thegem'),
					'param_name' => 'style',
					'value' => array(__('style-1', 'thegem') => '1', __('style-2', 'thegem') => '2', __('style-3', 'thegem') => '3')
				),
				array(
					'type' => 'textarea_html',
					'heading' => __('Content', 'thegem'),
					'param_name' => 'content',
					'value' => '<table style="width: 100%;">'."\n".
						'<thead><tr><th><h6>'.__('Title 1', 'thegem').'</h6></th><th><h6>'.__('Title 2', 'thegem').'</h6></th><th><h6>'.__('Title 3', 'thegem').'</h6></th></tr></thead>'."\n".
						'<tbody>'."\n".
						'<tr><td>'.__('Content 1 1', 'thegem').'</td><td>'.__('Content 1 2', 'thegem').'</td><td>'.__('Content 1 3', 'thegem').'</td></tr>'."\n".
						'<tr><td>'.__('Content 2 1', 'thegem').'</td><td>'.__('Content 2 2', 'thegem').'</td><td>'.__('Content 2 3', 'thegem').'</td></tr>'."\n".
						'<tr><td>'.__('Content 3 1', 'thegem').'</td><td>'.__('Content 3 2', 'thegem').'</td><td>'.__('Content 3 3', 'thegem').'</td></tr>'."\n".
						'</tbody></table>',
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Row Headers For Responsive', 'thegem'),
					'param_name' => 'row_headers',
					'value' => array(__('Yes', 'thegem') => '1')
				),
			)),
		),

		'gem_team' => array(
			'name' => __('Team', 'thegem'),
			'base' => 'gem_team',
			'icon' => 'thegem-icon-wpb-ui-team',
			'category' => __('The Gem', 'thegem'),
			'description' => __('Team overview inside content', 'thegem'),
			'params' => array_merge(array(
				array(
					'type' => 'dropdown',
					'heading' => __('Style', 'thegem'),
					'param_name' => 'style',
					'value' => array(
						__('Style 1', 'thegem') => '1',
						__('Style 2', 'thegem') => '2',
						__('Style 3', 'thegem') => '3',
						__('Style 4', 'thegem') => '4',
						__('Style 5', 'thegem') => '5',
						__('Style 6', 'thegem') => '6',
					)
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Teams', 'thegem'),
					'param_name' => 'team',
					'value' => thegem_vc_get_terms('thegem_teams'),
					'group' =>__('Select Teams', 'thegem'),
					'edit_field_class' => 'thegem-terms-checkboxes'
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Columns', 'thegem'),
					'param_name' => 'columns',
					'value' => array(1, 2, 3, 4),
					'std' => 3
				),
			)),
		),

		'gem_testimonials' => array(
			'name' => __('Testimonials', 'thegem'),
			'base' => 'gem_testimonials',
			'icon' => 'thegem-icon-wpb-ui-testimonials',
			'category' => __('The Gem', 'thegem'),
			'description' => __('Testimonials', 'thegem'),
			'params' => array_merge(array(
				array(
					'type' => 'dropdown',
					'heading' => __('Style', 'thegem'),
					'param_name' => 'style',
					'value' => array(
						__('Style 1', 'thegem') => 'style1',
						__('Style 2', 'thegem') => 'style2'
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Testimonials Sets', 'thegem'),
					'param_name' => 'set',
					'value' => thegem_vc_get_terms('thegem_testimonials_sets'),
					'group' =>__('Select Testimonials Sets', 'thegem'),
					'edit_field_class' => 'thegem-terms-checkboxes'
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Image Size', 'thegem'),
					'param_name' => 'image_size',
					'value' => array(
						__('Small', 'thegem') => 'size-small',
						__('Medium', 'thegem') => 'size-medium',
						__('Large', 'thegem') => 'size-large',
						__('Xlarge', 'thegem') => 'size-xlarge'
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Fullwidth', 'thegem'),
					'param_name' => 'fullwidth',
					'value' => array(__('Yes', 'thegem') => '1')
				),
				array(
					'type' => 'textfield',
					'heading' => __('Autoscroll', 'thegem'),
					'param_name' => 'autoscroll',
				),
			)),
		),

		'gem_textbox' => array(
			'name' => __('Styled Textbox', 'thegem'),
			'base' => 'gem_textbox',
			'is_container' => true,
			'js_view' => 'VcGemTextboxView',
			'icon' => 'thegem-icon-wpb-ui-textbox',
			'category' => __('The Gem', 'thegem'),
			'description' => __('Customizable block of text', 'thegem'),
			'params' => array_merge(array(
				array(
					'type' => 'dropdown',
					'heading' => __('Style', 'thegem'),
					'param_name' => 'style',
					'value' => array(
						__('Default / No Title ', 'thegem') => 'default',
						__('With Title Area', 'thegem') => 'title',
						__('Picturebox ', 'thegem') => 'picturebox',
					)
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Icon pack', 'thegem'),
					'param_name' => 'icon_pack',
					'value' => array_merge(array(__('Elegant', 'thegem') => 'elegant', __('Material Design', 'thegem') => 'material', __('FontAwesome', 'thegem') => 'fontawesome'), thegem_userpack_to_dropdown()),
					'dependency' => array(
						'element' => 'style',
						'value' => array('title')
					),
					'group' => __( 'Title', 'thegem' ),
				),
				array(
					'type' => 'thegem_icon',
					'heading' => __('Icon', 'thegem'),
					'param_name' => 'icon_elegant',
					'icon_pack' => 'elegant',
					'dependency' => array(
						'element' => 'icon_pack',
						'value' => array('elegant')
					),
					'group' => __( 'Title', 'thegem' ),
				),
				array(
					'type' => 'thegem_icon',
					'heading' => __('Icon', 'thegem'),
					'param_name' => 'icon_material',
					'icon_pack' => 'material',
					'dependency' => array(
						'element' => 'icon_pack',
						'value' => array('material')
					),
					'group' => __( 'Title', 'thegem' ),
				),
				array(
					'type' => 'thegem_icon',
					'heading' => __('Icon', 'thegem'),
					'param_name' => 'icon_fontawesome',
					'icon_pack' => 'fontawesome',
					'dependency' => array(
						'element' => 'icon_pack',
						'value' => array('fontawesome')
					),
					'group' => __( 'Title', 'thegem' ),
				),
			),
			thegem_userpack_to_shortcode(array(
				array(
					'type' => 'thegem_icon',
					'heading' => __('Icon', 'thegem'),
					'param_name' => 'icon_userpack',
					'icon_pack' => 'userpack',
					'dependency' => array(
						'element' => 'icon_pack',
						'value' => array('userpack')
					),
				),
			)),
			array(
				array(
					'type' => 'dropdown',
					'heading' => __('Icon Shape', 'thegem'),
					'param_name' => 'icon_shape',
					'value' => array(__('Square', 'thegem') => 'square', __('Circle', 'thegem') => 'circle', __('Rhombus', 'thegem') => 'romb', __('Hexagon', 'thegem') => 'hexagon'),
					'dependency' => array(
						'element' => 'style',
						'value' => array('title')
					),
					'group' => __( 'Title', 'thegem' ),
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Icon Style', 'thegem'),
					'param_name' => 'icon_style',
					'value' => array(__('Default', 'thegem') => '', __('45 degree Right', 'thegem') => 'angle-45deg-r', __('45 degree Left', 'thegem') => 'angle-45deg-l', __('90 degree', 'thegem') => 'angle-90deg'),
					'dependency' => array(
						'element' => 'style',
						'value' => array('title')
					),
					'group' => __( 'Title', 'thegem' ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Icon Color', 'thegem'),
					'param_name' => 'icon_color',
					'dependency' => array(
						'element' => 'style',
						'value' => array('title')
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group' => __( 'Title', 'thegem' ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Icon Color 2', 'thegem'),
					'param_name' => 'icon_color_2',
					'dependency' => array(
						'element' => 'style',
						'value' => array('title')
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group' => __( 'Title', 'thegem' ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Icon Background Color', 'thegem'),
					'param_name' => 'icon_background_color',
					'dependency' => array(
						'element' => 'style',
						'value' => array('title')
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group' => __( 'Title', 'thegem' ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Icon Border Color', 'thegem'),
					'param_name' => 'icon_border_color',
					'dependency' => array(
						'element' => 'style',
						'value' => array('title')
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group' => __( 'Title', 'thegem' ),
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Icon Size', 'thegem'),
					'param_name' => 'icon_size',
					'value' => array(__('Small', 'thegem') => 'small', __('Medium', 'thegem') => 'medium', __('Large', 'thegem') => 'large', __('Extra Large', 'thegem') => 'xlarge'),
					'dependency' => array(
						'element' => 'style',
						'value' => array('title')
					),
					'group' => __( 'Title', 'thegem' ),
				),
				array(
					'type' => 'textarea_raw_html',
					'heading' => __('Title Area Content', 'thegem'),
					'param_name' => 'title_content',
					'dependency' => array(
						'element' => 'style',
						'value' => array('title')
					),
					'group' => __( 'Title', 'thegem' ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Title Text Color', 'thegem'),
					'param_name' => 'title_text_color',
					'dependency' => array(
						'element' => 'style',
						'value' => array('title')
					),
					'group' => __( 'Title', 'thegem' ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Title Background Color', 'thegem'),
					'param_name' => 'title_background_color',
					'dependency' => array(
						'element' => 'style',
						'value' => array('title')
					),
					'group' => __( 'Title', 'thegem' ),
				),
				array(
					'type' => 'textfield',
					'heading' => __('Title Area Top Padding', 'thegem'),
					'param_name' => 'title_padding_top',
					'dependency' => array(
						'element' => 'style',
						'value' => array('title')
					),
					'group' => __( 'Title', 'thegem' ),
				),
				array(
					'type' => 'textfield',
					'heading' => __('Title Area Bottom Padding', 'thegem'),
					'param_name' => 'title_padding_bottom',
					'dependency' => array(
						'element' => 'style',
						'value' => array('title')
					),
					'group' => __( 'Title', 'thegem' ),
				),
				array(
					'type' => 'attach_image',
					'heading' => __('Choose Image', 'thegem'),
					'param_name' => 'picture',
					'dependency' => array(
						'element' => 'style',
						'value' => array('picturebox')
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Image position', 'thegem'),
					'param_name' => 'picture_position',
					'value' => array(
						__('Top', 'thegem') => 'top',
						__('Bottom', 'thegem') => 'bottom',
					),
					'dependency' => array(
						'element' => 'style',
						'value' => array('picturebox')
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Disable Lightbox', 'thegem'),
					'param_name' => 'disable_lightbox',
					'value' => array(__('Yes', 'thegem') => '1'),
					'dependency' => array(
						'element' => 'style',
						'value' => array('picturebox')
					),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Content Text Color', 'thegem'),
					'param_name' => 'content_text_color',
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Content Background Color', 'thegem'),
					'param_name' => 'content_background_color',
					'std' => '#f4f6f7',
				),
				array(
					'type' => 'attach_image',
					'heading' => __('Content Background Image', 'thegem'),
					'param_name' => 'content_background_image',
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Background style', 'thegem'),
					'param_name' => 'content_background_style',
					'value' => array(
						__('Default', 'thegem') => '',
						__('Cover', 'thegem') => 'cover',
						__('Contain', 'thegem') => 'contain',
						__('No Repeat', 'thegem') => 'no-repeat',
						__('Repeat', 'thegem') => 'repeat'
					)
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Background horizontal position', 'thegem'),
					'param_name' => 'content_background_position_horizontal',
					'value' => array(
						__('Center', 'thegem') => 'center',
						__('Left', 'thegem') => 'left',
						__('Right', 'thegem') => 'right'
					)
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Background vertical position', 'thegem'),
					'param_name' => 'content_background_position_vertical',
					'value' => array(
						__('Top', 'thegem') => 'top',
						__('Center', 'thegem') => 'center',
						__('Bottom', 'thegem') => 'bottom'
					)
				),
				array(
					'type' => 'textfield',
					'heading' => __('Padding top', 'thegem'),
					'param_name' => 'padding_top',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Padding bottom', 'thegem'),
					'param_name' => 'padding_bottom',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Padding left', 'thegem'),
					'param_name' => 'padding_left',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Padding right', 'thegem'),
					'param_name' => 'padding_right',
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Border Color', 'thegem'),
					'param_name' => 'border_color',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Border Width', 'thegem'),
					'param_name' => 'border_width',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Border Radius', 'thegem'),
					'param_name' => 'border_radius',
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Rectangle Corner', 'thegem'),
					'param_name' => 'rectangle_corner',
					'value' => array(
						__('Left Top', 'thegem') => 'lt',
						__('Right Top', 'thegem') => 'rt',
						__('Right Bottom', 'thegem') => 'rb',
						__('Left Bottom', 'thegem') => 'lb'
					)
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Top Arеа Style', 'thegem'),
					'param_name' => 'top_style',
					'value' => array(
						__('Default', 'thegem') => 'default',
						__('Flag', 'thegem') => 'flag',
						__('Shield', 'thegem') => 'shield',
						__('Ticket', 'thegem') => 'ticket',
						__('Sentence', 'thegem') => 'sentence',
						__('Note 1', 'thegem') => 'note-1',
						__('Note 2', 'thegem') => 'note-2',
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Bottom Arеа Style', 'thegem'),
					'param_name' => 'bottom_style',
					'value' => array(
						__('Default', 'thegem') => 'default',
						__('Flag', 'thegem') => 'flag',
						__('Shield', 'thegem') => 'shield',
						__('Ticket', 'thegem') => 'ticket',
						__('Sentence', 'thegem') => 'sentence',
						__('Note 1', 'thegem') => 'note-1',
						__('Note 2', 'thegem') => 'note-2',
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Centered', 'thegem'),
					'param_name' => 'centered',
					'value' => array(__('Yes', 'thegem') => '1')
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Lazy loading enabled', 'thegem'),
					'param_name' => 'effects_enabled',
					'value' => array(__('Yes', 'thegem') => '1')
				),
			)),
		),

		'gem_youtube' => array(
			'name' => __('Youtube', 'thegem'),
			'base' => 'gem_youtube',
			'icon' => 'thegem-icon-wpb-ui-youtube',
			'category' => __('The Gem', 'thegem'),
			'description' => __('Youtube video content', 'thegem'),
			'params' => array_merge(array(
				array(
					'type' => 'textfield',
					'heading' => __('Width', 'thegem'),
					'param_name' => 'width',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Height', 'thegem'),
					'param_name' => 'height',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Video Aspect ratio (16:9, 16:10, 4:3...)', 'thegem'),
					'param_name' => 'aspect_ratio',
					'value' => '16:9'
				),
				array(
					'type' => 'textfield',
					'heading' => __('Video_id', 'thegem'),
					'param_name' => 'video_id',
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Border Style', 'thegem'),
					'param_name' => 'style',
					'value' => array(
						__('no border', 'thegem') => 'default',
						__('8px & border', 'thegem') => '1',
						__('16px & border', 'thegem') => '2',
						__('8px outlined border', 'thegem') => '3',
						__('20px outlined border', 'thegem') => '4',
						__('20px border with shadow', 'thegem') => '5',
						__('Combined border', 'thegem') => '6',
						__('20px border radius', 'thegem') => '7',
						__('55px border radius', 'thegem') => '8',
						__('Dashed inside', 'thegem') => '9',
						__('Dashed outside', 'thegem') => '10',
						__('Rounded with border', 'thegem') => '11'
					)
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Position', 'thegem'),
					'param_name' => 'position',
					'value' => array(__('below', 'thegem') => 'below', __('left', 'thegem') => 'left', __('right', 'thegem') => 'right')
				),
			)),
		),

		'gem_vimeo' => array(
			'name' => __('Vimeo', 'thegem'),
			'base' => 'gem_vimeo',
			'icon' => 'thegem-icon-wpb-ui-vimeo',
			'category' => __('The Gem', 'thegem'),
			'description' => __('Vimeo video content', 'thegem'),
			'params' => array_merge(array(
				array(
					'type' => 'textfield',
					'heading' => __('Width', 'thegem'),
					'param_name' => 'width',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Height', 'thegem'),
					'param_name' => 'height',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Video Aspect ratio (16:9, 16:10, 4:3...)', 'thegem'),
					'param_name' => 'aspect_ratio',
					'value' => '16:9'
				),
				array(
					'type' => 'textfield',
					'heading' => __('Video id', 'thegem'),
					'param_name' => 'video_id',
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Border Style', 'thegem'),
					'param_name' => 'style',
					'value' => array(
						__('no border', 'thegem') => 'default',
						__('8px & border', 'thegem') => '1',
						__('16px & border', 'thegem') => '2',
						__('8px outlined border', 'thegem') => '3',
						__('20px outlined border', 'thegem') => '4',
						__('20px border with shadow', 'thegem') => '5',
						__('Combined border', 'thegem') => '6',
						__('20px border radius', 'thegem') => '7',
						__('55px border radius', 'thegem') => '8',
						__('Dashed inside', 'thegem') => '9',
						__('Dashed outside', 'thegem') => '10',
						__('Rounded with border', 'thegem') => '11'
					)
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Position', 'thegem'),
					'param_name' => 'position',
					'value' => array(__('below', 'thegem') => 'below', __('left', 'thegem') => 'left', __('right', 'thegem') => 'right')
				),
			)),
		),

	);
	return apply_filters('thegem_shortcodes_array', $shortcodes);
}

function thegem_VC_init() {
	if(thegem_is_plugin_active('js_composer/js_composer.php')) {
		global $vc_manager;
		remove_filter('the_excerpt', array($vc_manager->vc(), 'excerptFilter'));
		add_action('admin_print_scripts-post.php', 'thegem_printScriptsMessages');
		add_action('admin_print_scripts-post-new.php', 'thegem_printScriptsMessages');
		$shortcodes = thegem_shortcodes();
		foreach($shortcodes as $shortcode) {
			vc_map($shortcode);
		}
		$vc_layout_sub_controls = array(
			array( 'link_post', __( 'Link to post', 'thegem' ) ),
			array( 'no_link', __( 'No link', 'thegem' ) ),
			array( 'link_image', __( 'Link to bigger image', 'thegem' ) )
		);
		$target_arr = array(
			__( 'Same window', 'thegem' ) => '_self',
			__( 'New window', 'thegem' ) => '_blank'
		);
		vc_add_param('vc_column_inner', array(
			'type' => 'column_offset',
			'heading' => __('Responsiveness', 'thegem'),
			'param_name' => 'offset',
			'group' => __( 'Width & Responsiveness', 'thegem' ),
			'description' => __('Adjust column for different screen sizes. Control width, offset and visibility settings.', 'thegem')
		));
		vc_add_param('vc_gmaps', array(
			'type' => 'checkbox',
			'heading' => __('Deactivate Map Zoom By Scrolling', 'thegem'),
			'param_name' => 'disable_scroll',
			'value' => array(__('Yes', 'thegem') => '1')
		));
		vc_add_param('vc_gmaps', array(
			'type' => 'checkbox',
			'heading' => __('Hide GMaps Default Title Bar', 'thegem'),
			'param_name' => 'hide_title',
			'value' => array(__('Yes', 'thegem') => '1')
		));
		vc_add_param('vc_gmaps', array(
			'type' => 'dropdown',
			'heading' => __('Style', 'thegem'),
			'param_name' => 'style',
			'value' => array(
				__('no border', 'thegem') => 'default',
				__('8px & border', 'thegem') => '1',
				__('16px & border', 'thegem') => '2',
				__('8px outlined border', 'thegem') => '3',
				__('20px outlined border', 'thegem') => '4',
				__('20px border with shadow', 'thegem') => '5',
				__('Combined border', 'thegem') => '6',
				__('20px border radius', 'thegem') => '7',
				__('55px border radius', 'thegem') => '8',
				__('Dashed inside', 'thegem') => '9',
				__('Dashed outside', 'thegem') => '10',
				__('Rounded with border', 'thegem') => '11'
			)
		));
		vc_add_param('vc_accordion', array(
			'type' => 'checkbox',
			'heading' => __('Lazy loading enabled', 'thegem'),
			'param_name' => 'effects_enabled',
			'value' => array(__('Yes', 'thegem') => '1')
		));
		vc_add_param('contact-form-7', array(
			'type' => 'dropdown',
			'heading' => __('Style', 'thegem'),
			'param_name' => 'html_class',
			'value' => array(
				__('Default', 'thegem') => '',
				__('White', 'thegem') => 'gem-contact-form-white',
				__('Dark', 'thegem') => 'gem-contact-form-dark',
			)
		));
		vc_add_param('vc_text_separator', array(
			'type' => 'dropdown',
			'heading' => __('Title level', 'thegem'),
			'param_name' => 'title_level',
			'value' => array(
				__('H1', 'thegem') => 'h1',
				__('H2', 'thegem') => 'h2',
				__('H3', 'thegem') => 'h3',
				__('H4', 'thegem') => 'h4',
				__('H5', 'thegem') => 'h5',
				__('H6', 'thegem') => 'h6',
				__('XLarge', 'thegem') => 'xlarge',
				__('Styled Subtitle', 'thegem') => 'styled-subtitle',
			),
			'std' => 'h2',
			'weight' => 5
		));
		vc_add_param('vc_text_separator', array(
			'type' => 'checkbox',
			'heading' => __('Use light version of title', 'thegem'),
			'param_name' => 'title_light',
			'value' => array(__('Yes', 'thegem') => '1'),
			'dependency' => array(
				'element' => 'title_level',
				'value' => array('h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'xlarge')
			),
			'weight' => 550
		));
		vc_remove_element('vc_carousel');
		vc_remove_element('vc_button');
		vc_remove_element('vc_cta_button');
		vc_remove_element('vc_cta_button2');
		vc_remove_element('vc_video');
		vc_remove_element('vc_flickr');
		vc_remove_element('vc_flickr');
		vc_remove_element('vc_cta');
		vc_map_update('vc_tta_section', array(
			'allowed_container_element' => array('vc_row', 'gem_textbox', 'gem_alert_box', 'gem_counter_box', 'gem_icon_with_text', 'gem_map_with_text', 'gem_pricing_table'),
		));
		vc_map_update('vc_column_inner', array(
			'allowed_container_element' => array('gem_textbox', 'gem_alert_box', 'gem_counter_box', 'gem_icon_with_text', 'gem_map_with_text', 'gem_pricing_table'),
		));
		vc_add_shortcode_param( 'thegem_icon', 'thegem_icon_settings_field' );
		vc_add_shortcode_param( 'thegem_datepicker_param', 'thegem_datepicker_param_settings_field');
		if(thegem_is_plugin_active('woocommerce/woocommerce.php')) {
			add_filter( 'vc_autocomplete_gem_product_categories_ids_callback', 'TheGemProductCategoryCategoryAutocompleteSuggester', 10, 1 );
			vc_map(array(
				'name' => __( 'TheGem Product categories', 'js_composer' ),
				'base' => 'gem_product_categories',
				'icon' => 'icon-wpb-woocommerce',
				'category' => __( 'WooCommerce', 'js_composer' ),
				'description' => __( 'Display product categories loop', 'js_composer' ),
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => __( 'Number', 'js_composer' ),
						'param_name' => 'number',
						'description' => __( 'The `number` field is used to display the number of products.', 'js_composer' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => __( 'Order by', 'js_composer' ),
						'param_name' => 'orderby',
						'value' => array(
							'',
							__( 'Date', 'js_composer' ) => 'date',
							__( 'ID', 'js_composer' ) => 'ID',
							__( 'Author', 'js_composer' ) => 'author',
							__( 'Title', 'js_composer' ) => 'title',
							__( 'Modified', 'js_composer' ) => 'modified',
							__( 'Random', 'js_composer' ) => 'rand',
							__( 'Comment count', 'js_composer' ) => 'comment_count',
							__( 'Menu order', 'js_composer' ) => 'menu_order',
						),
						'save_always' => true,
						'description' => sprintf( __( 'Select how to sort retrieved products. More at %s.', 'js_composer' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => __( 'Sort order', 'js_composer' ),
						'param_name' => 'order',
						'value' => array(
							'',
							__( 'Descending', 'js_composer' ) => 'DESC',
							__( 'Ascending', 'js_composer' ) => 'ASC',
						),
						'save_always' => true,
						'description' => sprintf( __( 'Designates the ascending or descending order. More at %s.', 'js_composer' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
					),
					array(
						'type' => 'textfield',
						'heading' => __( 'Columns', 'js_composer' ),
						'value' => 4,
						'param_name' => 'columns',
						'save_always' => true,
						'description' => __( 'How much columns grid', 'js_composer' ),
					),
					array(
						'type' => 'textfield',
						'heading' => __( 'Number', 'js_composer' ),
						'param_name' => 'hide_empty',
						'description' => __( 'Hide empty', 'js_composer' ),
					),
					array(
						'type' => 'autocomplete',
						'heading' => __( 'Categories', 'js_composer' ),
						'param_name' => 'ids',
						'settings' => array(
							'multiple' => true,
							'sortable' => true,
						),
						'save_always' => true,
						'description' => __( 'List of product categories', 'js_composer' ),
					),
				),
			));
		}
		if($vc_manager->mode() != 'admin_frontend_editor' && $vc_manager->mode() != 'admin_page' && $vc_manager->mode() != 'page_editable') {
			add_filter('the_content', 'thegem_run_shortcode', 7);
			add_filter('thegem_print_shortcodes', 'thegem_run_shortcode', 7);
			add_filter('widget_text', 'thegem_run_shortcode', 7);
			add_filter('the_excerpt', 'thegem_run_shortcode', 7);
		}
	} else {
		add_filter('the_content', 'thegem_run_shortcode', 7);
		add_filter('thegem_print_shortcodes', 'thegem_run_shortcode', 7);
		add_filter('widget_text', 'thegem_run_shortcode', 7);
		add_filter('the_excerpt', 'thegem_run_shortcode', 7);
	}
}
add_action('init', 'thegem_VC_init', 11);

function thegem_update_vc_shortcodes_params() {
	$param = WPBMap::getParam('vc_gmaps', 'link');
	$param['description'] = sprintf( __( 'Visit <a href="%s" target="_blank">Google maps</a> to create your map. 1) Find location 2) Click "Share" and make sure map is public on the web 3) Click folder icon to reveal "Embed on my site" link 4) Copy iframe code and paste it here.', 'thegem' ), 'https://www.google.com/maps/d/');
	vc_update_shortcode_param('vc_gmaps', $param);
}
add_action('vc_after_init', 'thegem_update_vc_shortcodes_params');

if(class_exists('WPBakeryShortCodesContainer')) {
	class WPBakeryShortCode_gem_alert_box extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_gem_fullwidth extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_gem_custom_header extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_gem_map_with_text extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_gem_icon_with_text extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_gem_textbox extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_gem_counter_box extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_gem_pricing_table extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_gem_pricing_column extends WPBakeryShortCodesContainer {}
}

function thegem_js_remove_wpautop($content, $autop = false) {
	if(thegem_is_plugin_active('js_composer/js_composer.php')) {
		return wpb_js_remove_wpautop($content, $autop);
	}
	return $content;
}

function thegem_portfolio_slider_shortcode($atts) {
	extract(shortcode_atts(array(
		'portfolios' => '',
		'portfolio_title' => '',
		'portfolio_layout' => '3x',
		'portfolio_no_gaps' => '',
		'portfolio_display_titles' => 'page',
		'portfolio_hover' => 'default',
		'portfolio_background_style' => 'white',
		'portfolio_show_info' => '',
		'portfolio_disable_socials' => '',
		'portfolio_fullwidth_columns' => '4',
		'effects_enabled' => false,
		'portfolio_likes' => false,
		'portfolio_gaps_size' => 42,
		'portfolio_slider_arrow' => 'portfolio_slider_arrow_big',
		'portfolio_autoscroll' => false,
	), $atts, 'gem_portfolio_slider'));
	if(thegem_is_plugin_active('js_composer/js_composer.php')) {
		global $vc_manager;
		if($vc_manager->mode() == 'admin_frontend_editor' || $vc_manager->mode() == 'admin_page' || $vc_manager->mode() == 'page_editable') {
			return '<div class="portfolio-slider-shortcode-dummy"></div>';
		}
	}
	ob_start();
	thegem_portfolio_slider(array(
		'portfolio' => $portfolios,
		'title' => $portfolio_title,
		'layout' => $portfolio_layout,
		'no_gaps' => $portfolio_no_gaps,
		'display_titles' => $portfolio_display_titles,
		'hover' => $portfolio_hover,
		'background_style' => $portfolio_background_style,
		'show_info' => $portfolio_show_info,
		'disable_socials' => $portfolio_disable_socials,
		'fullwidth_columns' => $portfolio_fullwidth_columns,
		'effects_enabled' => $effects_enabled,
		'likes' => $portfolio_likes,
		'gaps_size' => $portfolio_gaps_size,
		'portfolio_arrow' => $portfolio_slider_arrow,
		'autoscroll' => $portfolio_autoscroll,
		)
	);
	$return_html = trim(preg_replace('/\s\s+/', ' ', ob_get_clean()));
	return $return_html;
}

function thegem_portfolio_shortcode($atts) {
	extract(shortcode_atts(array(
		'portfolios' => '',
		'portfolio_layout' => '2x',
		'portfolio_style' => 'justified',
		'portfolio_layout_version' => 'fullwidth',
		'portfolio_caption_position' => 'right',
		'portfolio_gaps_size' => 42,
		'portfolio_display_titles' => 'page',
		'portfolio_background_style' => 'white',
		'portfolio_hover' => 'default',
		'portfolio_pagination' => 'normal',
		'loading_animation' => 'move-up',
		'portfolio_items_per_page' => 8,
		'portfolio_show_info' => '',
		'portfolio_with_filter' => '',
		'portfolio_title' => '',
		'portfolio_disable_socials' => '',
		'portfolio_fullwidth_columns' => '4',
		'portfolio_likes' => false,
		'portfolio_sorting' => false,
		'metro_max_row_height' => 380
	), $atts, 'gem_portfolio'));
	if(thegem_is_plugin_active('js_composer/js_composer.php')) {
		global $vc_manager;
		if($vc_manager->mode() == 'admin_frontend_editor' || $vc_manager->mode() == 'admin_page' || $vc_manager->mode() == 'page_editable') {
			return '<div class="portfolio-shortcode-dummy"></div>';
		}
	}
	$button_params = array();
	foreach($atts as $key => $value) {
		if(substr($key, 0, 7) == 'button_') {
			$button_params[substr($key, 7)] = $value;
		}
	}
	ob_start();
	thegem_portfolio(array(
		'portfolio' => $portfolios,
		'title' => $portfolio_title,
		'layout' => $portfolio_layout,
		'layout_version' => $portfolio_layout_version,
		'caption_position' => $portfolio_caption_position,
		'style' => $portfolio_style,
		'gaps_size' => $portfolio_gaps_size,
		'display_titles' => $portfolio_display_titles,
		'background_style' => $portfolio_background_style,
		'hover' => $portfolio_hover,
		'pagination' => $portfolio_pagination,
		'loading_animation' => $loading_animation,
		'items_per_page' => $portfolio_items_per_page,
		'with_filter' => $portfolio_with_filter,
		'show_info' => $portfolio_show_info,
		'disable_socials' => $portfolio_disable_socials,
		'fullwidth_columns' => $portfolio_fullwidth_columns,
		'likes' => $portfolio_likes,
		'sorting' => $portfolio_sorting,
		'button' => $button_params,
		'metro_max_row_height' => $metro_max_row_height
	));
	$return_html = trim(preg_replace('/\s\s+/', ' ', ob_get_clean()));
	return $return_html;
}

function thegem_vc_get_terms($taxonomy) {
	$terms = get_terms($taxonomy, array('hide_empty' => false));
	$sets = array();
	foreach ($terms as $term) {
		$sets[$term->name] = $term->slug;
	}
	return $sets;
}

function thegem_vc_get_blog_categories() {
	$terms = get_terms('category', array('hide_empty' => false));
	$categories = array();
	foreach ($terms as $term) {
		$categories[$term->name.' ('.__('Posts', 'thegem').')'] = $term->slug;
	}
	$terms = get_terms('thegem_news_sets', array('hide_empty' => false));
	foreach ((array)$terms as $term) {
		$categories[$term->name.' ('.__('News', 'thegem').')'] = $term->slug;
	}
	return $categories;
}

/*
function gem_counter_box_vc_controls() {
?>
<script type="text/html" id="vc_controls-template-gem-counter-box">
	<div class="vc_controls-container">
		<div class="vc_controls-out-tl">
			<div class="vc_element element-{{ tag }}">
				<a class="vc_control-btn vc_element-name vc_element-move"
					 title="<?php printf( __( 'Drag to move %s', 'js_composer' ), '{{ name }}' ) ?>"><span
					class="vc_btn-content">{{ name }}</span></a>
				<a class="vc_control-btn vc_control-btn-prepend" href="#"
					 title="<?php printf( __( 'Prepend to %s', 'js_composer' ), '{{ name }}' ) ?>"><span
					class="vc_btn-content"><span class="icon"></span></span></a>
				<a class="vc_control-btn vc_control-btn-clone" href="#"
					 title="<?php printf( __( 'Clone %s', 'js_composer' ), '{{ name }}' ) ?>"><span
					class="vc_btn-content"><span class="icon"></span></span></a>
				<a class="vc_control-btn vc_control-btn-delete" href="#"
					 title="<?php printf( __( 'Delete %s', 'js_composer' ), '{{ name }}' ) ?>"><span
					class="vc_btn-content"><span class="icon"></span></span></a>
			</div>
		</div>
		<div class="vc_controls-bc">
			<a class="vc_control-btn vc_control-btn-append" href="#"
				 title="<?php printf( __( 'Append to %s', 'js_composer' ), '{{ name }}' ) ?>"><span
				class="vc_btn-content"><span class="icon"></span></span></a>
		</div>
	</div>
	<!-- end vc_controls-column -->
</script>
<?php
}
add_action('vc_frontend_editor_render_template', 'gem_counter_box_vc_controls');
*/

/*function thegem_custom_css_classes_for_vc_column($class_string, $tag) {
	if(!thegem_get_option('')) {
		global $vc_manager;
		if($vc_manager->mode() != 'admin_frontend_editor' && $vc_manager->mode() != 'admin_page' && $vc_manager->mode() != 'page_editable') {
			if($tag == 'vc_column' || $tag == 'vc_column_inner') {
				$class_string = preg_replace_callback('/vc_col-sm-(\d{1,2})/', 'thegem_vc_column_replace_classes', $class_string);
			}
		}
	}
	return $class_string;
}
add_filter('vc_shortcodes_css_class', 'thegem_custom_css_classes_for_vc_column', 10, 2);

function thegem_vc_column_replace_classes($matches) {
	$css_class = 'vc_col-md-'.$matches[1];
	if($matches[1] > 6) {
		$css_class .= ' vc_col-xs-12';
	}
	if($matches[1] < 7 && $matches[1] > 3) {
		$css_class .= ' vc_col-sm-6 vc_col-xs-12';
	}
	if($matches[1] == 3) {
		$css_class .= ' vc_col-xs-6';
	}
	if($matches[1] == 2) {
		$css_class .= ' vc_col-xs-3';
	}
	if($matches[1] == 1) {
		$css_class .= ' vc_col-sm-2 vc_col-xs-3';
	}
	return $css_class;
}*/


function thegem_printScriptsMessages() {
	if(in_array( get_post_type(), vc_editor_post_types())) {
		wp_enqueue_script('thegem_js_composer_js_custom_views');
	}
}

function thegem_add_tta_tabs_tour_accordion_color() {
	$param_thegem = array(__( 'The Gem', 'thegem' ) => 'thegem');
	$param = WPBMap::getParam( 'vc_tta_tabs', 'color' );
	$param['value'] = array_merge($param_thegem, $param['value']);
	$param['std'] = 'thegem';
	vc_update_shortcode_param( 'vc_tta_tabs', $param );
	$param = WPBMap::getParam( 'vc_tta_tour', 'color' );
	$param['value'] = array_merge($param_thegem, $param['value']);
	$param['std'] = 'thegem';
	vc_update_shortcode_param( 'vc_tta_tour', $param );
	$param = WPBMap::getParam( 'vc_tta_accordion', 'color' );
	$param['value'] = array_merge($param_thegem, $param['value']);
	$param['std'] = 'thegem';
	vc_update_shortcode_param( 'vc_tta_accordion', $param );
}
add_action( 'vc_after_init', 'thegem_add_tta_tabs_tour_accordion_color' );

function thegem_add_tta_accordion_styles_icons() {
	$param = WPBMap::getParam( 'vc_tta_accordion', 'style' );
	$param['value'][__( 'Simple solid', 'thegem' )] = 'simple_solid';
	$param['value'][__( 'Simple dashed', 'thegem' )] = 'simple_dashed';
	vc_update_shortcode_param( 'vc_tta_accordion', $param );
	$param = WPBMap::getParam( 'vc_tta_accordion', 'c_icon' );
	$param['value'][__( 'Solid squared', 'thegem' )] = 'solid_squared';
	$param['value'][__( 'Solid rounded', 'thegem' )] = 'solid_rounded';
	$param['value'][__( 'Outlined rounded', 'thegem' )] = 'outlined_rounded';
	vc_update_shortcode_param( 'vc_tta_accordion', $param );
}
add_action( 'vc_after_init', 'thegem_add_tta_accordion_styles_icons' );

function thegem_add_vc_shortcodes_pagination_styles() {
	$param_thegem = array(
		__( 'None', 'js_composer' ) => '',
		__( 'The Gem Circle', 'thegem' ) => 'thegem-circle',
		__( 'The Gem Square', 'thegem' ) => 'thegem-square'
	);
	$param = WPBMap::getParam( 'vc_tta_tabs', 'pagination_style' );
	$param['value'] = array_merge($param_thegem, $param['value']);
	vc_update_shortcode_param( 'vc_tta_tabs', $param );
	$param = WPBMap::getParam( 'vc_tta_tour', 'pagination_style' );
	$param['value'] = array_merge($param_thegem, $param['value']);
	vc_update_shortcode_param( 'vc_tta_tour', $param );
	$param = WPBMap::getParam( 'vc_tta_pageable', 'pagination_style' );
	$param['value'] = array_merge($param_thegem, $param['value']);
	$param['std'] = 'thegem-circle';
	vc_update_shortcode_param( 'vc_tta_pageable', $param );
}
add_action( 'vc_after_init', 'thegem_add_vc_shortcodes_pagination_styles' );

function thegem_add_vc_column_text_effects() {
	$param = WPBMap::getParam( 'vc_column_text', 'css_animation' );
	if($param['type'] == 'dropdown') {
		$param['value'][__( 'Fade', 'thegem' )] = 'fade';
		vc_update_shortcode_param( 'vc_column_text', $param );
	}
}
add_action( 'vc_after_init', 'thegem_add_vc_column_text_effects' );

function thegem_product_categories($atts) {
	if(!thegem_is_plugin_active('woocommerce/woocommerce.php')) return ;
	global $thegem_product_categories_images;
	$thegem_product_categories_images = true;
	$output = WC_Shortcodes::product_categories($atts);
	$thegem_product_categories_images = false;
	return $output;
}
add_shortcode('gem_product_categories', 'thegem_product_categories');

function TheGemProductCategoryCategoryAutocompleteSuggester( $query, $slug = false ) {
	global $wpdb;
	$cat_id = (int) $query;
	$query = trim( $query );
	$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT a.term_id AS id, b.name as name, b.slug AS slug
					FROM {$wpdb->term_taxonomy} AS a
					INNER JOIN {$wpdb->terms} AS b ON b.term_id = a.term_id
					WHERE a.taxonomy = 'product_cat' AND (a.term_id = '%d' OR b.slug LIKE '%%%s%%' OR b.name LIKE '%%%s%%' )", $cat_id > 0 ? $cat_id : - 1, stripslashes( $query ), stripslashes( $query ) ), ARRAY_A );

	$result = array();
	if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
		foreach ( $post_meta_infos as $value ) {
			$data = array();
			$data['value'] = $slug ? $value['slug'] : $value['id'];
			$data['label'] = __( 'Id', 'js_composer' ) . ': ' . $value['id'] . ( ( strlen( $value['name'] ) > 0 ) ? ' - ' . __( 'Name', 'js_composer' ) . ': ' . $value['name'] : '' ) . ( ( strlen( $value['slug'] ) > 0 ) ? ' - ' . __( 'Slug', 'js_composer' ) . ': ' . $value['slug'] : '' );
			$result[] = $data;
		}
	}

	return $result;
}

function thegem_socials_shortcode($atts) {
	$atts = shortcode_atts(array(
		'style' => 'default',
		'colored' => 'default',
		'color' => '',
		'alignment' => 'left',
		'icons_size' => 16,
		'socials' => urlencode(json_encode(array(
			array(
				'social' => 'facebook',
				'url' => '#',
			),
			array(
				'social' => 'twitter',
				'url' => '#',
			),
			array(
				'social' => 'googleplus',
				'url' => '#',
			),
		)))
	), $atts, 'gem_socials');
	if($atts['colored'] != 'custom') {
		$atts['color'] = '';
	}
	$socials = vc_param_group_parse_atts($atts['socials']);
	$socials_html = '';
	foreach($socials as $social) {
		$social = shortcode_atts(array(
			'social' => 'facebook',
			'url' => '#',
		), $social);
		$socials_html .= '<a class="socials-item" target="_blank" href="'.$social['url'].'"'.($atts['color'] ? ' style="color: '.$atts['color'].';"' : '').'><i class="socials-item-icon '.$social['social'].'" style="font-size: '.$atts['icons_size'].'px"></i></a>';
	}
	return '<div class="socials socials-list '.($atts['colored'] != 'custom' ? 'socials-colored' : 'socials-colored-hover').' socials-'.$atts['style'].' socials-alignment-'.$atts['alignment'].'">'.$socials_html.'</div>';
}

add_action( 'vc_before_init', 'thegem_disable_vc_updater' );
function thegem_disable_vc_updater() {
	global $vc_manager;
	$vc_manager->disableUpdater(true);
}

function thegem_search_form_shortcode($atts) {
	$atts = shortcode_atts(array(
		'style' => 'light',
		'alignment' => 'left',
		'placeholder' => __('Search', 'thegem')
	), $atts, 'gem_search_form');
	$output = '<div class="gem-search-form gem-search-form-style-'.$atts['style'].' gem-search-form-alignment-'.$atts['alignment'].'">'.
		'<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">'.
		'<input class="search-field" type="search" name="s" placeholder="'.$atts['placeholder'].'" />'.
		'<button class="search-submit" type="submit"></button>'.
		'</form>'.
		'</div>';
	return $output;
}

function thegem_icon_settings_field( $settings, $value ) {
	add_thickbox();
	wp_enqueue_style('icons-'.$settings['icon_pack']);
	wp_enqueue_script('thegem-icons-picker');
	return '<div class="thegem_icon_block">'
		.'<input name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value wpb-textinput icons-picker ' .
		esc_attr( $settings['param_name'] ) . ' ' .
		esc_attr( $settings['type'] ) . '_field" type="text" value="' . esc_attr( $value ) . '" data-iconpack="'.esc_attr( $settings['icon_pack'] ).'" />'
		.'</div>'.
		'<script type="text/javascript">'.
			'(function($) {'.
				'$(function() {'.
					'jQuery(\'.icons-picker\').iconsPicker();'.
				'});'.
			'})(jQuery);'.
		'</script>';
}

/* COUNTDOWN */

function thegem_datepickerTimeToTimestamp($eventdate){
	$date = preg_split('//u',$eventdate,-1,PREG_SPLIT_NO_EMPTY);
	$day = $date[0].$date[1];
	$month = $date[3].$date[4];
	$year = $date[6].$date[7].$date[8].$date[9];

	return mktime(0, 0, 0, $month, $day, $year);
}

function thegem_countdown_shortcode($atts){
	extract(shortcode_atts(array(
		'style' => 'style-3',
		'eventdate' => date('d-m-Y', (time() + 84900)),
		'start_eventdate' => date('d-m-Y', (time() - 84900)),
		'aligment' => 'align-left',
		'extraclass' => '',
		'color_number' => '#333333',
		'color_text' => '#333333',
		'color_border' => '#333333',
		'color_background' => '',
		'countdown_text' => '',
		'color_days' => '#333333',
		'color_hours' => '#333333',
		'color_minutes' => '#333333',
		'color_seconds' => '#333333',
		'weight_number' => 8
	), $atts, 'gem_countdown'));

	wp_enqueue_script('thegem-countdown');
	wp_enqueue_style('thegem-countdown');
	$eventdate_timestamp = thegem_datepickerTimeToTimestamp($eventdate);
	$eventdate_start_timestamp = thegem_datepickerTimeToTimestamp($start_eventdate);

	if ($style == 'style-3'){
		$output  = "<div data-eventdate='".esc_attr($eventdate_timestamp)."' class='countdown-container countdown-style-3 ".esc_attr($extraclass)."'>";
		$output .= "<div class='countdown-wrapper countdown-info'>";
		$output .= "<div class='countdown-item count-1'><div class='wrap' style='background:".esc_attr($color_background)."; border-color: ".esc_attr($color_border)."'><span class='item-count countdown-days title-h1' style='color:".esc_attr($color_number)."'></span><span class='item-title styled-subtitle' style='color:".esc_attr($color_text)."'>".__('Days', 'thegem')."</span></div></div>";
		$output .= "<div class='countdown-item count-2'><div class='wrap' style='background:".esc_attr($color_background)."; border-color: ".esc_attr($color_border)."'><span class='item-count countdown-hours title-h1' style='color:".esc_attr($color_number)."'></span><span class='item-title styled-subtitle' style='color:".esc_attr($color_text)."'>".__('Hours', 'thegem')."</span></div></div>";
		$output .= "<div class='countdown-item count-3'><div class='wrap' style='background:".esc_attr($color_background)."; border-color: ".esc_attr($color_border)."'><span class='item-count countdown-minutes title-h1' style='color:".esc_attr($color_number)."'></span><span class='item-title styled-subtitle' style='color:".esc_attr($color_text)."'>".__('Minutes', 'thegem')."</span></div></div>";
		$output .= "<div class='countdown-item count-4'><div class='wrap' style='background:".esc_attr($color_background)."; border-color: ".esc_attr($color_border)."'><span class='item-count countdown-seconds title-h1' style='color:".esc_attr($color_number)."'></span><span class='item-title styled-subtitle' style='color:".esc_attr($color_text)."'>".__('Seconds', 'thegem')."</span></div></div>";
		$output .= "</div></div><div style='clear: both'></div>";

		return $output;
	}

	if ($style == 'style-4'){
		$output  = "<div data-eventdate='".esc_attr($eventdate_timestamp)."' class='countdown-container countdown-style-4 ".esc_attr($aligment)." ".esc_attr($extraclass)."'>";
		$output .= "<div class='countdown-wrapper countdown-info'>";
		$output .= "<div class='countdown-item count-1'><div class='wrap' style='border-color: ".esc_attr($color_border)."'><span class='item-count countdown-days title-h2' style='color:".esc_attr($color_number)."'></span><span class='item-title' style='color:".esc_attr($color_text)."'>".__('Days', 'thegem')."</span></div></div>";
		$output .= "<div class='countdown-item count-2'><div class='wrap' style='border-color: ".esc_attr($color_border)."'><span class='item-count countdown-hours title-h2' style='color:".esc_attr($color_number)."'></span><span class='item-title' style='color:".esc_attr($color_text)."'>".__('Hours', 'thegem')."</span></div></div>";
		$output .= "<div class='countdown-item count-3'><div class='wrap' style='border-color: ".esc_attr($color_border)."'><span class='item-count countdown-minutes title-h2' style='color:".esc_attr($color_number)."'></span><span class='item-title' style='color:".esc_attr($color_text)."'>".__('Minutes', 'thegem')."</span></div></div>";
		$output .= "<div class='countdown-item count-4'><div class='wrap'><span class='item-count countdown-seconds title-h2' style='color:".esc_attr($color_number)."'></span><span class='item-title' style='color:".esc_attr($color_text)."'>".__('Seconds', 'thegem')."</span></div></div>";
		$output .= "</div></div><div style='clear: both;'></div>";

		return $output;
	}

	$weight_class = '';
	if($weight_number == 4){
		$weight_class = 'light';
	}

	if ($style == 'style-5'){
		$output  = "<div data-eventdate='".esc_attr($eventdate_timestamp)."' data-starteventdate='".esc_attr($eventdate_start_timestamp)."'  data-colordays='".esc_attr($color_days)."' data-colorhours='".esc_attr($color_hours)."' data-colorminutes='".esc_attr($color_minutes)."' data-colorseconds='".esc_attr($color_seconds)."' data-weightnumber='".esc_attr($weight_number)."' class='countdown-container countdown-style-5 ".esc_attr($aligment)." ".esc_attr($extraclass)."'>";
		$output .= "<div class='countdown-wrapper countdown-info'>";
		$output .= "<div class='countdown-item count-1'><div class='circle-raphael-days'></div><div class='wrap'><span class='item-count countdown-days title-h1 ".$weight_class."' style='color:".esc_attr($color_days )."'></span><span class='item-title styled-subtitle' style='color:".esc_attr($color_text)."'>".__('Days', 'thegem')."</span></div></div>";
		$output .= "<div class='countdown-item count-2'><div class='circle-raphael-hours'></div><div class='wrap'><span class='item-count countdown-hours title-h1 ".$weight_class."' style='color:".esc_attr($color_hours)."'></span><span class='item-title styled-subtitle' style='color:".esc_attr($color_text)."'>".__('Hours', 'thegem')."</span></div></div>";
		$output .= "<div class='countdown-item count-3'><div class='circle-raphael-minutes'></div><div class='wrap'><span class='item-count countdown-minutes title-h1 ".$weight_class."' style='color:".esc_attr($color_minutes)."'></span><span class='item-title styled-subtitle' style='color:".esc_attr($color_text)."'>".__('Minutes', 'thegem')."</span></div></div>";
		$output .= "<div class='countdown-item count-4'><div class='circle-raphael-seconds'></div><div class='wrap'><span class='item-count countdown-seconds title-h1 ".$weight_class."' style='color:".esc_attr($color_seconds)."'></span><span class='item-title styled-subtitle' style='color:".esc_attr($color_text)."'>".__('Seconds', 'thegem')."</span></div></div>";
		$output .= "</div></div><div style='clear: both'></div>";


		return $output;
	}

	if ($style == 'style-6'){
		$output  = "<div data-eventdate='".esc_attr($eventdate_timestamp)."' class='countdown-container countdown-style-6 ".esc_attr($aligment)." ".esc_attr($extraclass)."'>";
		$output .= "<div class='countdown-wrapper countdown-info'>";
		$output .= "<div class='countdown-item count-1'><div class='wrap'><div class='countdown-item-border-1' style='background:".esc_attr($color_border)."'></div><span class='item-title' style='color:".esc_attr($color_text)."'>".__('Days', 'thegem')."</span><span class='item-count countdown-days title-xlarge' style='color:".esc_attr($color_number)."'></span></div></div>";
		$output .= "<div class='countdown-item count-2'><div class='wrap'><div class='countdown-item-border-2' style='background:".esc_attr($color_border)."'></div><span class='item-title' style='color:".esc_attr($color_text) ."'>".__('Hours', 'thegem')."</span><span class='item-count countdown-hours title-xlarge' style='color:".esc_attr($color_number)."'></span></div></div>";
		$output .= "<div class='countdown-item count-3'><div class='wrap'><div class='countdown-item-border-3' style='background:".esc_attr($color_border)."'></div><span class='item-title' style='color:".esc_attr($color_text)."'>".__('Minutes', 'thegem')."</span><span class='item-count countdown-minutes title-xlarge' style='color:".esc_attr($color_number)."'></span></div></div>";
		$output .= "<div class='countdown-item count-4'><div class='wrap'><div class='countdown-item-border-4' style='background:".esc_attr($color_border)."'></div><span class='item-title' style='color:".esc_attr($color_text)."'>".__('Seconds', 'thegem')."</span><span class='item-count countdown-seconds title-xlarge' style='color:".esc_attr($color_number)."'></span></div></div>";
		$output .= "</div></div><div style='clear: both'></div>";

		return $output;
	}

	if ($style == 'style-7'){
		$output  = "<div data-eventdate='".esc_attr($eventdate_timestamp)."' class='countdown-container countdown-style-7 ".esc_attr($aligment)." ".esc_attr($extraclass)."'>";
		$output .= "<div class='countdown-wrapper countdown-info'>";
		$output .= "<div class='countdown-item'><div class='wrap'><span class='item-count countdown-days title-xlarge' style='color:".esc_attr($color_number)."'></span></div>";
		if(!empty($countdown_text)){
			$output .= "<div class='countdown-text styled-subtitle' style='color:".esc_attr($color_text)."'>". $countdown_text ."</div>";
		}
		$output .= "</div></div></div><div style='clear: both'></div>";

		return $output;
	}
}

function thegem_datepicker_param_settings_field($settings, $value){
	return "<input class='countdown_datepicker wpb_vc_param_value wpb-textinput " . esc_attr( $settings['param_name'] ) . ' ' .esc_attr( $settings['type'] ) . "_field' type='text' name='" . esc_attr( $settings['param_name'] ) . "' value='". $value ."'><script>jQuery(\".countdown_datepicker\").each(function () {
			if(!jQuery(this).data('datepicker')) {
				 jQuery(this).data('datepicker', true);
					jQuery(this).datepicker({
					constraintInput:true,
					dateFormat: \"dd-mm-yy\",
					showOtherMonths: true,
					selectOtherMonths: true,
					beforeShow: function(input, inst) {
						if(!inst.dpDiv.parent('.ui-lightness').length) {
							inst.dpDiv.wrap('<div class=\"ui-lightness\"/>');
						}
					}
				});
			}
		});</script>";

}

add_action('admin_enqueue_scripts', 'thegem_countdown_admin_styles');
function thegem_countdown_admin_styles(){
	wp_enqueue_style('jquery-ui-lightness', get_template_directory_uri() . '/css/jquery-ui/ui-lightness/jquery-ui.css');
	wp_enqueue_script('jquery-ui-datepicker');
}


function thegem_remove_wpautop( $content, $autop = false ) {

	if ( $autop ) {
		$content = wpautop( preg_replace( '/<\/?p\>/', "\n", $content ) . "\n" );
	}

	return do_shortcode( shortcode_unautop( $content ) );
}