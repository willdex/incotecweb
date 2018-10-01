<?php
	/**
	 * Shortcode attributes
	 * @var $atts
	 * @var $title
	 * @var $el_class
	 * @var $value
	 * @var $units
	 * @var $color
	 * @var $custom_color
	 * @var $label_value
	 * @var $css
	 * Shortcode class
	 * @var $this WPBakeryShortCode_Vc_Pie
	 */
	$title = $el_class = $value = $units = $color = $custom_color = $label_value = $css = '';
	$atts = $this->convertOldColorsToNew( $atts );
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
	extract( $atts );

	wp_enqueue_script('vc_pie');

	$colors = array(
		'blue' => '#5472d2',
		'turquoise' => '#00c1cf',
		'pink' => '#fe6c61',
		'violet' => '#8d6dc4',
		'peacoc' => '#4cadc9',
		'chino' => '#cec2ab',
		'mulled-wine' => '#50485b',
		'vista-blue' => '#75d69c',
		'orange' => '#f7be68',
		'sky' => '#5aa1e3',
		'green' => '#6dab3c',
		'juicy-pink' => '#f4524d',
		'sandy-brown' => '#f79468',
		'purple' => '#b97ebb',
		'black' => '#2a2a2a',
		'grey' => '#ebebeb',
		'white' => '#ffffff'
	);

	if ( 'custom' === $color ) {
		$color = $custom_color;
	} else {
		$color = isset( $colors[ $color ] ) ? $colors[ $color ] : '';
	}

	if ( ! $color ) {
		$color = $colors['grey'];
	}

	$el_class = $this->getExtraClass( $el_class );
	$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_pie_chart wpb_content_element' . $el_class, $this->settings['base'], $atts );
	$output = "\n\t".'<div class= "'.$css_class.'" data-pie-value="'.$value.'" data-pie-label-value="'.$label_value.'" data-pie-units="'.$units.'" data-pie-color="'.esc_attr($color).'">';
	$output .= "\n\t\t".'<div class="wpb_wrapper">';
	if ($title!='') {
		$output .= '<div class="wpb_heading wpb_pie_chart_heading"><h5>'.$title.'</h5></div>';
	}
	$output .= "\n\t\t\t".'<div class="vc_pie_wrapper">';
	$output .= "\n\t\t\t".'<span style="border-color:'.$color.'" class="vc_pie_chart_back"></span>';
	$output .= "\n\t\t\t".'<span class="light vc_pie_chart_value" style="color: '.esc_attr($color).'"></span>';
	$output .= "\n\t\t\t".'<canvas width="201" height="201"></canvas>';
	$output .= "\n\t\t\t".'</div>';

	$output .= "\n\t\t".'</div>'.$this->endBlockComment('.wpb_wrapper');
	$output .= "\n\t".'</div>'.$this->endBlockComment('.wpb_pie_chart')."\n";

	echo $output;

