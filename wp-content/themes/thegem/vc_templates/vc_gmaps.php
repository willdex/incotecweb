<?php
$output = $title = $link = $size = $zoom = $type = $bubble = $el_class = '';
extract( shortcode_atts( array(
	'title' => '',
	//'link' => 'https://maps.google.com/maps?q=New+York&hl=en&sll=40.686236,-73.995409&sspn=0.038009,0.078192',
	'link' => '<iframe src="https://www.google.com/maps/d/embed?mid=zy8g7PkInS5s.k1_kczfkJRjs" width="100%" height="480"></iframe>',
	'size' => '480',
	'zoom' => 14, //depreceated from 4.0.2
	'type' => 'm', //depreceated from 4.0.2
	'bubble' => '', //depreceated from 4.0.2
	'el_class' => '',
	'disable_scroll' => '',
	'style' => '',
	'hide_title' => '',
), $atts ) );

if ( $link == '' ) {
	return null;
}
$link1 = '';
$link = trim( vc_value_from_safe( $link ) );
$bubble = ( $bubble != '' && $bubble != '0' ) ? '&amp;iwloc=near' : '';
$size = str_replace( array( 'px', ' ' ), array( '', '' ), $size );

$el_class = $this->getExtraClass( $el_class );
$el_class .= ( $size == '' ) ? ' vc_map_responsive' : '';

if ( is_numeric( $size ) ) $link = preg_replace( '/height="[0-9]*"/', 'height="' . $size . '"', $link );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_gmaps_widget wpb_content_element' . $el_class, $this->settings['base'], $atts );
?>

<?php
	if($style) {
		$classes = $style;
		$width = '100%';
		if ( preg_match( '/^\<iframe/', $link ) ) {
			preg_match('/width="([^"]+)"/', $link, $width);
			$width = $width[1];
			if(!is_numeric($size)) {
				preg_match('/height="([^"]+)"/', $link, $size);
				$size = $size[1];
			}
			preg_match('/src="([^"]+)"/', $link, $link);
			$link = $link[1];
		}

		if(substr($width, -1) != "%") {
			$width = intval($width).'px';
		}
		$size = (intval($size) + 46).'px';
		$css_style = '';
		$frame_css_style = '';
		if($width && intval($width) > 0) {
			$css_style .= 'width: '.$width.';';
		}
		if($disable_scroll) {
			$frame_css_style .= 'pointer-events: none;';
		}
		if($size && intval($size) > 0) {
			$frame_css_style .= 'height: '.$size.';';
		}
		$return_html = '<div class="gem-gmaps gem-wrapbox gem-wrapbox-style-'.$classes.'" style="'.$css_style.'">'.
			'<div class="gem-wrapbox-inner">'.
			($style == '11' ? '<div class="gmaps_round">' : '').
			'<div class="gem-gmaps-hide"><iframe style="'.$frame_css_style.'" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="' . esc_url($link . '&amp;t=' . $type . '&amp;z=' . $zoom . '&amp;output=embed' . $bubble) . '" class="gem-wrapbox-element"></iframe>'.($disable_scroll ? '<a class="map-locker" href="javascript:void(0);"></a>' : '').'</div>'.
			($style == '11' ? '</div>' : '').
			'</div>'.
			'</div>';
		echo $return_html;
		return ;
	}
?>
<div class="<?php echo esc_attr($css_class); ?>">
	<?php echo wpb_widget_title( array( 'title' => $title, 'extraclass' => 'wpb_map_heading' ) ); ?>
	<div class="wpb_wrapper">
		<div class="wpb_map_wraper <?php if ($hide_title) echo 'hide_title'?>">
			<?php
			if ( preg_match( '/^\<iframe/', $link ) ) {
				if($disable_scroll) {
					$link = preg_replace( '/^\<iframe/', '<iframe style="pointer-events: none;"', $link ).'<a class="map-locker" href="javascript:void(0);"></a>';
				}
				echo $link;
			}
			else echo '<iframe width="100%" height="' . $size . '" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="' . esc_url($link . '&amp;t=' . $type . '&amp;z=' . $zoom . '&amp;output=embed' . $bubble) . '"'.($disable_scroll ? ' style="pointer-events: none;"' : '').'></iframe>'.($disable_scroll ? '<a class="map-locker" href="javascript:void(0);"></a>' : '');
			?>
		</div>
	</div><?php echo $this->endBlockComment( '.wpb_wrapper' ); ?>
</div><?php echo $this->endBlockComment( '.wpb_gmaps_widget' ); ?>