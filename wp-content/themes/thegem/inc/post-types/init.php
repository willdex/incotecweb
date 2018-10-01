<?php

function thegem_get_post_data($default = array(), $post_data_name = '', $post_id = 0) {
	$post_data = get_post_meta($post_id, 'thegem_'.$post_data_name.'_data', true);
	if(!is_array($default)) {
		return apply_filters('thegem_get_post_data', array(), $post_id, $post_data_name);;
	}
	if(!is_array($post_data)) {
		return apply_filters('thegem_get_post_data', $default, $post_id, $post_data_name);
	}
	return apply_filters('thegem_get_post_data', array_merge($default, $post_data), $post_id, $post_data_name);
}

/* PAGE OPTIONS */

/* Additional page options */
add_action('add_meta_boxes', 'thegem_add_page_settings_boxes');
function thegem_add_page_settings_boxes() {
	$post_types = array('post', 'page', 'thegem_pf_item', 'thegem_news');
	foreach($post_types as $post_type) {
		add_meta_box('thegem_page_title', esc_html__('Page Title', 'thegem'), 'thegem_page_title_settings_box', $post_type, 'normal', 'high');
		add_meta_box('thegem_page_header', esc_html__('Page Header', 'thegem'), 'thegem_page_header_settings_box', $post_type, 'normal', 'high');
		add_meta_box('thegem_page_sidebar', esc_html__('Page Sidebar', 'thegem'), 'thegem_page_sidebar_settings_box', $post_type, 'normal', 'high');
		if(thegem_is_plugin_active('thegem-elements/thegem-elements.php')) {
			add_meta_box('thegem_page_slideshow', esc_html__('Page Slideshow', 'thegem'), 'thegem_page_slideshow_settings_box', $post_type, 'normal', 'high');
		}
		add_meta_box('thegem_page_effects', esc_html__('Additional Options', 'thegem'), 'thegem_page_effects_settings_box', $post_type, 'normal', 'high');
		add_meta_box('thegem_page_preloader', esc_html__('Page Preloader', 'thegem'), 'thegem_page_preloader_settings_box', $post_type, 'normal', 'high');
	}
	add_meta_box('thegem_page_title', esc_html__('Page Title', 'thegem'), 'thegem_page_title_settings_box', 'product', 'normal', 'high');
	add_meta_box('thegem_page_sidebar', esc_html__('Page Sidebar', 'thegem'), 'thegem_page_sidebar_settings_box', 'product', 'normal', 'high');\
	add_meta_box('thegem_page_sidebar', esc_html__('Additional Options', 'thegem'), 'thegem_page_effects_settings_box', 'product', 'normal', 'high');
	add_meta_box('thegem_product_size_guide', esc_html__('Size Guide', 'thegem'), 'thegem_product_size_guide_settings_box', 'product', 'normal', 'high');
	add_meta_box('thegem_post_item_settings', esc_html__('Blog Item Settings', 'thegem'), 'thegem_post_item_settings_box', 'post', 'normal', 'high');
}

/* Title box */
function thegem_page_title_settings_box($post) {
	wp_nonce_field('thegem_page_title_settings_box', 'thegem_page_title_settings_box_nonce');
	$page_data = thegem_get_sanitize_page_title_data($post->ID);
	$video_background_types = array('' => __('None', 'thegem'), 'youtube' => __('YouTube', 'thegem'), 'vimeo' => __('Vimeo', 'thegem'), 'self' => __('Self-Hosted Video', 'thegem'));
	$title_styles = array('1' => __('Enable', 'thegem'), '' => __('Disable', 'thegem'));
	$icon_styles = array('' => __('None', 'thegem'), 'angle-45deg-l' => __('45&deg; Left','thegem'), 'angle-45deg-r' => __('45&deg; Right','thegem'), 'angle-90deg' => __('90&deg;','thegem'));
	$title_background_image_items = array('01.jpg', '02.jpg', '03.jpg', '04.jpg', '05.jpg', '06.jpg', '07.jpg', '08.jpg', '09.jpg', '10.jpg', '11.jpg', '12.jpg', '13.jpg', '14.jpg', '15.jpg', '16.jpg', '17.jpg', '18.jpg');
?>
<div class="thegem-title-settings">
<fieldset>
	<legend><?php esc_html_e('Style &amp; Alignment', 'thegem'); ?></legend>
	<table class="settings-box-table" width="100%"><tbody><tr>
		<td>
			<label for="page_title_style"><?php esc_html_e('Enable Page Title', 'thegem'); ?>:</label><br />
			<?php thegem_print_select_input($title_styles, $page_data['title_style'], 'thegem_page_data[title_style]', 'page_title_style'); ?><br />
			<br />
			<label for="page_title_alignment"><?php esc_html_e('Alignment', 'thegem'); ?>:</label><br />
			<?php thegem_print_select_input(array('center' => __('Center', 'thegem'), 'left' => __('Left', 'thegem'), 'right' => __('Right', 'thegem')), $page_data['title_alignment'], 'thegem_page_data[title_alignment]', 'page_title_alignment'); ?>
		</td>
		<td>
			<label for="page_title_padding_top"><?php esc_html_e('Padding Top', 'thegem'); ?>:</label><br />
			<input type="number" name="thegem_page_data[title_padding_top]" id="page_title_padding_top" value="<?php echo esc_attr($page_data['title_padding_top']); ?>" min="0" /><br />
			<br />
			<label for="page_title_padding_bottom"><?php esc_html_e('Padding Bottom', 'thegem'); ?>:</label><br />
			<input type="number" name="thegem_page_data[title_padding_bottom]" id="page_title_title_padding_bottom" value="<?php echo esc_attr($page_data['title_padding_bottom']); ?>" min="0" />		</td>
	</tr></tbody></table>
</fieldset>
<fieldset>
	<legend><?php esc_html_e('Rich Content Title', 'thegem'); ?></legend>
	<table class="settings-box-table" width="100%"><tbody><tr>
		<td>
			<input name="thegem_page_data[title_rich_content]" type="checkbox" id="page_title_rich_content" value="1" <?php checked($page_data['title_rich_content'], 1); ?> />
			<label for="page_title_rich_content"><?php esc_html_e('Use rich content title', 'thegem'); ?></label><br /><br />
			<?php wp_editor(htmlspecialchars_decode($page_data['title_content']), 'page_title_content', array(
				'textarea_name' => 'thegem_page_data[title_content]',
				'quicktags' => array('buttons' => 'em,strong,link'),
				'editor_height' => '100',
				'tinymce' => array(
					'theme_advanced_buttons1' => 'bold,italic,strikethrough,separator,bullist,numlist,separator,blockquote,separator,justifyleft,justifycenter,justifyright,separator,link,unlink,separator,undo,redo,separator',
					'theme_advanced_buttons2' => '',
				),
				'editor_css' => '<style>#wp-excerpt-editor-container .wp-editor-area{height:175px; width:100%;}</style>'
			)); ?>
		</td>
	</tr></tbody></table>
</fieldset>
<fieldset>
	<legend><?php esc_html_e('Title &amp; Excerpt', 'thegem'); ?></legend>
	<table class="settings-box-table" width="100%"><tbody><tr>
		<td>
			<label for="page_title_text_color"><?php esc_html_e('Title Text Color', 'thegem'); ?>:</label><br />
			<input type="text" name="thegem_page_data[title_text_color]" id="page_title_text_color" value="<?php echo esc_attr($page_data['title_text_color']); ?>" class="color-select" /><br />
			<br />
			<label for="page_title_excerpt_text_color"><?php esc_html_e('Excerpt Color', 'thegem'); ?>:</label><br />
			<input type="text" name="thegem_page_data[title_excerpt_text_color]" id="page_title_excerpt_text_color" value="<?php echo esc_attr($page_data['title_excerpt_text_color']); ?>" class="color-select" /><br />
			<br />
			<label for="page_title_excerpt"><?php esc_html_e('Excerpt', 'thegem'); ?>:</label><br />
			<textarea name="thegem_page_data[title_excerpt]" id="page_title_excerpt" style="width: 100%;" rows="3"><?php echo esc_textarea($page_data['title_excerpt']); ?></textarea><br />
			<br />
			<input name="thegem_page_data[title_breadcrumbs]" type="checkbox" id="page_title_breadcrumbs" value="1" <?php checked($page_data['title_breadcrumbs'], 1); ?> />
			<label for="page_title_breadcrumbs"><?php esc_html_e('Hide Breadcrumbs', 'thegem'); ?></label>
		</td>
		<td>
			<label for="page_title_title_width"><?php esc_html_e('Title Max Width', 'thegem'); ?>:</label><br />
			<input type="number" name="thegem_page_data[title_title_width]" id="page_title_title_width" value="<?php echo esc_attr($page_data['title_title_width']); ?>" min="0" /><br />
			<br />
			<label for="page_title_excerpt_width"><?php esc_html_e('Excerpt Max Width', 'thegem'); ?>:</label><br />
			<input type="number" name="thegem_page_data[title_excerpt_width]" id="page_title_excerpt_width" value="<?php echo esc_attr($page_data['title_excerpt_width']); ?>" min="0" /><br />
			<br />
			<label for="page_title_top_margin"><?php esc_html_e('Title Top Margin', 'thegem'); ?>:</label><br />
			<input type="number" name="thegem_page_data[title_top_margin]" id="page_title_top_margin" value="<?php echo esc_attr($page_data['title_top_margin']); ?>" /><br />
			<br />
			<label for="page_title_excerpt_top_margin"><?php esc_html_e('Excerpt Top Margin', 'thegem'); ?>:</label><br />
			<input type="number" name="thegem_page_data[title_excerpt_top_margin]" id="page_title_title_excerpt_top_margin" value="<?php echo esc_attr($page_data['title_excerpt_top_margin']); ?>" />
		</td>
	</tr></tbody></table>
</fieldset>
<fieldset>
	<legend><?php esc_html_e('Background', 'thegem'); ?></legend>
	<table class="settings-box-table" width="100%"><tbody><tr>
		<td>
			<label for="page_title_background_image"><?php esc_html_e('Background Image', 'thegem'); ?>:</label><br />
			<input type="text" name="thegem_page_data[title_background_image]" id="page_title_background_image" value="<?php echo esc_attr($page_data['title_background_image']); ?>" class="picture-select" /><br />
			<span id="page_title_background_image_select" style="display: block;">
				<?php foreach($title_background_image_items as $item) : ?>
					<a href="<?php echo esc_url(get_template_directory_uri() . '/images/backgrounds/title/' . $item); ?>" style="background-image: url('<?php echo esc_url(get_template_directory_uri() . '/images/backgrounds/title/' . $item); ?>')"></a>
				<?php endforeach; ?>
			</span>
			<br />
			<label for="page_title_background_color"><?php esc_html_e('Background Color', 'thegem'); ?>:</label><br />
			<input type="text" name="thegem_page_data[title_background_color]" id="page_title_background_color" value="<?php echo esc_attr($page_data['title_background_color']); ?>" class="color-select" />
		</td>
	</tr></tbody></table>
</fieldset>
<?php if(thegem_is_plugin_active('thegem-elements/thegem-elements.php')) : ?>
<fieldset>
	<legend><?php esc_html_e('Icon', 'thegem'); ?></legend>
	<table class="settings-box-table" width="100%"><tbody><tr>
		<td>
			<label for="page_title_icon_pack"><?php esc_html_e('Icon Pack', 'thegem'); ?>:</label><br />
			<?php thegem_print_select_input(thegem_icon_packs_select_array(), $page_data['title_icon_pack'], 'thegem_page_data[title_icon_pack]', 'page_title_icon_pack'); ?><br />
			<br />
			<?php
				add_thickbox();
				wp_enqueue_style('icons-elegant');
				wp_enqueue_style('icons-material');
				wp_enqueue_style('icons-fontawesome');
				wp_enqueue_style('icons-userpack');
				wp_enqueue_script('thegem-icons-picker');
			?>
			<label for="page_title_icon"><?php esc_html_e('Icon', 'thegem'); ?>:</label><br />
			<input name="thegem_page_data[title_icon]" type="text" id="page_title_icon" value="<?php echo esc_attr($page_data['title_icon']); ?>" class="icons-picker" /><br />
			<br />
			<label for="page_title_icon_color"><?php esc_html_e('Icon Color', 'thegem'); ?>:</label><br />
			<input name="thegem_page_data[title_icon_color]" type="text" id="page_title_icon_color" value="<?php echo esc_attr($page_data['title_icon_color']); ?>" class="color-select" /><br />
			<br />
			<label for="page_title_icon_color_2"><?php esc_html_e('Icon Color 2', 'thegem'); ?>:</label><br />
			<input name="thegem_page_data[title_icon_color_2]" type="text" id="page_title_icon_color_2" value="<?php echo esc_attr($page_data['title_icon_color_2']); ?>" class="color-select" /><br />
			<br />
			<label for="page_title_icon_style"><?php esc_html_e('Icon Style', 'thegem'); ?>:</label><br />
			<?php thegem_print_select_input($icon_styles, esc_attr($page_data['title_icon_style']), 'thegem_page_data[title_icon_style]', 'page_title_icon_style'); ?>
		</td>
		<td>
			<label for="page_title_icon_background_color"><?php esc_html_e('Icon Background Color', 'thegem'); ?>:</label><br />
			<input name="thegem_page_data[title_icon_background_color]" type="text" id="page_title_icon_background_color" value="<?php echo esc_attr($page_data['title_icon_background_color']); ?>" class="color-select" /><br />
			<br />
			<label for="page_title_icon_border_color"><?php esc_html_e('Icon Border Color', 'thegem'); ?>:</label><br />
			<input name="thegem_page_data[title_icon_border_color]" type="text" id="page_title_icon_border_color" value="<?php echo esc_attr($page_data['title_icon_border_color']); ?>" class="color-select" /><br />
			<br />
			<label for="page_title_icon_shape"><?php esc_html_e('Icon Shape', 'thegem'); ?>:</label><br />
			<?php thegem_print_select_input(array('circle' => __('Circle', 'thegem'), 'square' => __('Square', 'thegem'), 'romb' => __('Rhombus', 'thegem'), 'hexagon' => __('Hexagon', 'thegem')), $page_data['title_icon_shape'], 'thegem_page_data[title_icon_shape]', 'page_title_icon_shape'); ?><br />
			<br />
			<label for="page_title_icon_size"><?php esc_html_e('Icon Size', 'thegem'); ?>:</label><br />
			<?php thegem_print_select_input(array('small' => __('Small', 'thegem'), 'medium' => __('Medium', 'thegem'), 'large' => __('Large', 'thegem'), 'xlarge' => __('Extra Large', 'thegem')), $page_data['title_icon_size'], 'thegem_page_data[title_icon_size]', 'page_title_icon_size'); ?>
		</td>
	</tr></tbody></table>
</fieldset>
<?php endif; ?>
<fieldset>
	<legend><?php esc_html_e('Video Background', 'thegem'); ?></legend>
	<table class="settings-box-table" width="100%"><tbody><tr>
		<td>
			<label for="page_title_video_type"><?php esc_html_e('Video Background Type', 'thegem'); ?>:</label><br />
			<?php thegem_print_select_input($video_background_types, esc_attr($page_data['title_video_type']), 'thegem_page_data[title_video_type]', 'page_title_video_type'); ?><br />
			<br />
			<label for="page_title_video"><?php esc_html_e('Link to video or video ID (for YouTube or Vimeo)', 'thegem'); ?>:</label><br />
			<input type="text" name="thegem_page_data[title_video_background]" id="page_title_video_background" value="<?php echo esc_attr($page_data['title_video_background']); ?>" class="video-select" /><br />
			<br />
			<label for="page_title_video_aspect_ratio"><?php esc_html_e('Video Background Aspect Ratio (16:9, 16:10, 4:3...)', 'thegem'); ?>:</label><br />
			<input type="text" name="thegem_page_data[title_video_aspect_ratio]" id="page_title_video_aspect_ratio" value="<?php echo esc_attr($page_data['title_video_aspect_ratio']); ?>" />
			</td>
			<td>
			<label for="page_title_video_overlay_color"><?php esc_html_e('Video Overlay Color', 'thegem'); ?>:</label><br />
			<input type="text" name="thegem_page_data[title_video_overlay_color]" id="page_title_video_overlay_color" value="<?php echo esc_attr($page_data['title_video_overlay_color']); ?>" class="color-select" /><br />
			<br />
			<label for="page_title_video_overlay_opacity"><?php esc_html_e('Video Overlay Opacity (0 - 1)', 'thegem'); ?>:</label><br />
			<input type="text" name="thegem_page_data[title_video_overlay_opacity]" id="page_title_video_overlay_opacity" value="<?php echo esc_attr($page_data['title_video_overlay_opacity']); ?>" /><br />
			<br />
			<label for="page_title_video_poster"><?php esc_html_e('Video Poster', 'thegem'); ?>:</label><br />
			<input type="text" name="thegem_page_data[title_video_poster]" id="page_title_video_poster" value="<?php echo esc_attr($page_data['title_video_poster']); ?>" class="picture-select" />
		</td>
	</tr></tbody></table>
</fieldset>
</div>
<script type="text/javascript">
(function($) {
	$(function() {
		$('#page_title_background_image_select a[href="'+$('#page_title_background_image').val()+'"]').addClass('active');
		$('#page_title_background_image_select a').click(function(e) {
			$('#page_title_background_image_select a.active').removeClass('active');
			e.preventDefault();
			$('#page_title_background_image').val($(this).attr('href'));
			$(this).addClass('active');
		});
		$('#page_title_icon_pack').change(function() {
			$('.gem-icon-info').hide();
			$('.gem-icon-info-' + $(this).val()).show();
			$('#page_title_icon').data('iconpack', $(this).val());
		}).trigger('change');
		$('#page_title_rich_content').change(function() {
			if($(this).is(':checked')) {
				$('#wp-page_title_content-wrap').show();
			} else {
				$('#wp-page_title_content-wrap').hide();
			}
		}).trigger('change');
	});
})(jQuery);
</script>
<?php
}

function thegem_page_header_settings_box($post) {
	wp_nonce_field('thegem_page_header_settings_box', 'thegem_page_header_settings_box_nonce');
	$page_data = thegem_get_sanitize_page_header_data($post->ID);
?>
<table class="settings-box-table" width="100%"><tbody><tr>
	<td>
		<input name="thegem_page_data[header_transparent]" type="checkbox" id="page_header_transparent" value="1" <?php checked($page_data['header_transparent'], 1); ?> />
		<label for="page_header_transparent"><?php esc_html_e('Transparent Menu On Header', 'thegem'); ?></label><br /><br />
		<label for="page_header_opacity"><?php esc_html_e('Header Opacity (0-100%)', 'thegem'); ?>:</label><br />
		<input type="text" name="thegem_page_data[header_opacity]" id="page_header_opacity" value="<?php echo esc_attr($page_data['header_opacity']); ?>" /><br /><br />
		<input name="thegem_page_data[header_menu_logo_light]" type="checkbox" id="page_header_menu_logo_light" value="1" <?php checked($page_data['header_menu_logo_light'], 1); ?> />
		<label for="page_header_menu_logo_light"><?php esc_html_e('Use Light Menu &amp; Logo', 'thegem'); ?></label><br />
		<br />
		<input name="thegem_page_data[header_hide_top_area]" type="checkbox" id="page_header_hide_top_area" value="1" <?php checked($page_data['header_hide_top_area'], 1); ?> />
		<label for="page_header_hide_top_area"><?php esc_html_e('Hide Top Area', 'thegem'); ?></label>
	</td>
</tr></tbody></table>
<?php
}

/* Effects box */
function thegem_page_effects_settings_box($post) {
	wp_nonce_field('thegem_page_effects_settings_box', 'thegem_page_effects_settings_box_nonce');
	$page_data = thegem_get_sanitize_page_effects_data($post->ID);
	$is_woo_shop = false;
	if(function_exists('wc_get_page_id') && wc_get_page_id('shop') === $post->ID) {
		$is_woo_shop = true;
	}
?>
<table class="settings-box-table"><tbody><tr>
	<td>
		<input name="thegem_page_data[effects_one_pager]" type="checkbox" id="page_effects_one_pager" value="1" <?php checked($page_data['effects_one_pager'], 1); ?> />
		<label for="page_effects_one_pager"><?php esc_html_e('Page as One-Pager', 'thegem'); ?></label><?php if(!$is_woo_shop) : ?><br /><br />
		<input name="thegem_page_data[effects_page_scroller]" type="checkbox" id="page_effects_page_scroller" value="1" <?php checked($page_data['effects_page_scroller'], 1); ?> />
		<label for="page_effects_page_scroller"><?php esc_html_e('Page as fullscreen vertical slider', 'thegem'); ?></label>
		<?php endif; ?>
		<br /><br />
		<input name="thegem_page_data[effects_parallax_footer]" type="checkbox" id="page_effects_parallax_footer" value="1" <?php checked($page_data['effects_parallax_footer'], 1); ?> />
		<label for="page_effects_parallax_footer"><?php esc_html_e('Parallax Footer', 'thegem'); ?></label>
	</td>
	<td>
		<input name="thegem_page_data[effects_no_top_margin]" type="checkbox" id="page_effects_no_top_margin" value="1" <?php checked($page_data['effects_no_top_margin'], 1); ?> />
		<label for="page_effects_no_top_margin"><?php esc_html_e('Disable top margin', 'thegem'); ?></label><br /><br />
		<input name="thegem_page_data[effects_no_bottom_margin]" type="checkbox" id="page_effects_no_bottom_margin" value="1" <?php checked($page_data['effects_no_bottom_margin'], 1); ?> />
		<label for="page_effects_no_bottom_margin"><?php esc_html_e('Disable bottom margin', 'thegem'); ?></label>
	</td>
	<td>
		<input name="thegem_page_data[effects_disabled]" type="checkbox" id="page_effects_disabled" value="1" <?php checked($page_data['effects_disabled'], 1); ?> />
		<label for="page_effects_disabled"><?php esc_html_e('Lazy loading disabled', 'thegem'); ?></label><br /><br />
		<input name="thegem_page_data[redirect_to_subpage]" type="checkbox" id="page_redirect_to_subpage" value="1" <?php checked($page_data['redirect_to_subpage'], 1); ?> />
		<label for="page_redirect_to_subpage"><?php esc_html_e('Redirect to subpage', 'thegem'); ?></label>
	</td>
	<td>
		<input name="thegem_page_data[effects_hide_header]" type="checkbox" id="page_effects_hide_header" value="1" <?php checked($page_data['effects_hide_header'], 1); ?> />
		<label for="page_effects_hide_header"><?php esc_html_e('Hide Header', 'thegem'); ?></label><br /><br />
		<input name="thegem_page_data[effects_hide_footer]" type="checkbox" id="page_effects_hide_footer" value="1" <?php checked($page_data['effects_hide_footer'], 1); ?> />
		<label for="page_effects_hide_footer"><?php esc_html_e('Hide Footer', 'thegem'); ?></label>
	</td>
</tr></tbody></table>
<?php
}

/* Page Preloader box */
function thegem_page_preloader_settings_box($post) {
	wp_nonce_field('thegem_page_preloader_settings_box', 'thegem_page_preloader_settings_box_nonce');
	$page_data = thegem_get_sanitize_page_preloader_data($post->ID);
?>
<input name="thegem_page_data[enable_page_preloader]" type="checkbox" id="enable_page_preloader" value="1" <?php checked($page_data['enable_page_preloader'], 1); ?> />
<label for="enable_page_preloader"><?php esc_html_e('Enable Page Preloader', 'thegem'); ?></label>
<?php
}

/* Slideshows box */
function thegem_page_slideshow_settings_box($post) {
	wp_nonce_field('thegem_page_slideshow_settings_box', 'thegem_page_slideshow_settings_box_nonce');
	$page_data = thegem_get_sanitize_page_slideshow_data($post->ID);
	$slideshow_types = array('' => __('None', 'thegem'), 'NivoSlider' => 'NivoSlider');
	$slideshows_terms = get_terms('thegem_slideshows', array('hide_empty' => false));
	$slideshows = array('' => __('All Slides', 'thegem'));
	foreach($slideshows_terms as $term) {
		$slideshows[$term->slug] = $term->name;
	}
	$layersliders = array();
	if(thegem_is_plugin_active('LayerSlider/layerslider.php')) {
		$slideshow_types['LayerSlider'] = 'LayerSlider';
		global $wpdb;
		$table_name = $wpdb->prefix . "layerslider";
		$query_results = $wpdb->get_results("SELECT * FROM $table_name WHERE flag_hidden = '0' AND flag_deleted = '0' ORDER BY id ASC");
		foreach($query_results as $query_result) {
			$layersliders[$query_result->id] = $query_result->name;
		}
	}
	$revsliders = array();
	if(thegem_is_plugin_active('revslider/revslider.php')) {
		$slideshow_types['revslider'] = 'Revolution Slider';
		$slider = new RevSlider();
		$arrSliders = $slider->getArrSliders();
		foreach($arrSliders as $arrSlider) {
			$revsliders[$arrSlider->getAlias()] = $arrSlider->getTitle();
		}
	}
?>
<table class="settings-box-table"><tbody><tr>
	<td>
		<label for="page_slideshow_type"><?php esc_html_e('Slideshow Type', 'thegem'); ?>:</label><br />
		<?php thegem_print_select_input($slideshow_types, $page_data['slideshow_type'], 'thegem_page_data[slideshow_type]', 'page_slideshow_type'); ?><br />
		<br />
		<div class="slideshow-select NivoSlider">
			<label for="page_slideshow_slideshow"><?php esc_html_e('Select Slideshow', 'thegem'); ?>:</label><br />
			<?php thegem_print_select_input($slideshows, $page_data['slideshow_slideshow'], 'thegem_page_data[slideshow_slideshow]', 'page_slideshow_slideshow'); ?><br />
		</div>
		<?php if(thegem_is_plugin_active('LayerSlider/layerslider.php')) : ?>
			<div class="slideshow-select LayerSlider">
				<label for="page_slideshow_layerslider"><?php esc_html_e('Select LayerSlider', 'thegem'); ?>:</label><br />
				<?php thegem_print_select_input($layersliders, $page_data['slideshow_layerslider'], 'thegem_page_data[slideshow_layerslider]', 'page_slideshow_layerslider'); ?><br />
			</div>
		<?php endif; ?>
		<?php if(thegem_is_plugin_active('revslider/revslider.php')) : ?>
			<div class="slideshow-select revslider">
				<label for="page_slideshow_revslider"><?php esc_html_e('Select Revolution Slider', 'thegem'); ?>:</label><br />
				<?php thegem_print_select_input($revsliders, $page_data['slideshow_revslider'], 'thegem_page_data[slideshow_revslider]', 'page_slideshow_revslider'); ?><br />
			</div>
		<?php endif; ?>
	</td>
</tr></tbody></table>
<script type="text/javascript">
	(function($) {
		$(function() {
			$('.slideshow-select').hide();
			if($('#page_slideshow_type').val() != '') {
				$('.slideshow-select.'+$('#page_slideshow_type').val()).show();
			}
			$('#page_slideshow_type').change(function() {
				if($('#page_slideshow_type').val() != '') {
					$('.slideshow-select:not(.'+$('#page_slideshow_type').val()+')').slideUp();
				} else {
					$('.slideshow-select').slideUp();
				}
				if($('#page_slideshow_type').val() != '') {
					$('.slideshow-select.'+$('#page_slideshow_type').val()).slideDown();
				}
			});
		});
	})(jQuery)
</script>
<?php
}

/* Sidebar box */
function thegem_page_sidebar_settings_box($post) {
	wp_nonce_field('thegem_page_sidebar_settings_box', 'thegem_page_sidebar_settings_box_nonce');
	$page_data = thegem_get_sanitize_page_sidebar_data($post->ID);
	$sidebar_positions = array('' => __('None', 'thegem'), 'left' => __('Left', 'thegem'), 'right' => __('Right', 'thegem'));
?>
<table class="settings-box-table"><tbody><tr>
	<td>
		<label for="page_sidebar_position"><?php esc_html_e('Sidebar Position', 'thegem'); ?>:</label><br />
		<?php thegem_print_select_input($sidebar_positions, $page_data['sidebar_position'], 'thegem_page_data[sidebar_position]', 'page_sidebar_position'); ?><br />
	</td>
	<td>
		<input name="thegem_page_data[sidebar_sticky]" type="checkbox" id="page_sidebar_sticky" value="1" <?php checked($page_data['sidebar_sticky'], 1); ?> />
		<label for="page_sidebar_sticky"><?php esc_html_e('Sticky sidebar', 'thegem'); ?></label>
	</td>
</tr></tbody></table>
<?php
}

function thegem_post_item_settings_box($post) {
	wp_nonce_field('thegem_post_item_settings_box', 'thegem_post_item_settings_box_nonce');
	$post_item_data = thegem_get_sanitize_post_data($post->ID);
	$video_background_types = array('youtube' => __('YouTube', 'thegem'), 'vimeo' => __('Vimeo', 'thegem'), 'self' => __('Self-Hosted Video', 'thegem'));
?>
<div class="thegem-title-settings">
<fieldset>
	<legend><?php esc_html_e('Featured Image', 'thegem'); ?></legend>
	<table class="settings-box-table"><tbody><tr>
		<td>
			<input name="thegem_post_item_data[show_featured_content]" type="checkbox" id="post_item_show_featured_content" value="1" <?php checked($post_item_data['show_featured_content'], 1); ?> />
			<label for="post_item_show_featured_content"><?php esc_html_e('Show Featured Content', 'thegem'); ?></label>
		</td>
	</tr></tbody></table>
</fieldset>
<fieldset>
	<legend><?php esc_html_e('For Video Post', 'thegem'); ?></legend>
	<table class="settings-box-table" width="100%"><tbody><tr>
		<td>
			<label for="post_item_video_type"><?php esc_html_e('Video Type', 'thegem'); ?>:</label><br />
			<?php thegem_print_select_input($video_background_types, esc_attr($post_item_data['video_type']), 'thegem_post_item_data[video_type]', 'post_item_video_type'); ?><br />
			<br />
			<label for="post_item_video"><?php esc_html_e('Link to video or video ID (for YouTube or Vimeo)', 'thegem'); ?>:</label><br />
			<input type="text" name="thegem_post_item_data[video]" id="post_item_video" value="<?php echo esc_attr($post_item_data['video']); ?>" class="video-select" /><br />
			<br />
			<label for="post_item_video_aspect_ratio"><?php esc_html_e('Video Background Aspect Ratio (16:9, 16:10, 4:3...)', 'thegem'); ?>:</label><br />
			<input type="text" name="thegem_post_item_data[video_aspect_ratio]" id="post_item_video_aspect_ratio" value="<?php echo esc_attr($post_item_data['video_aspect_ratio']); ?>" />
		</td>
	</tr></tbody></table>
</fieldset>
<fieldset>
	<legend><?php esc_html_e('For Quote Post', 'thegem'); ?></legend>
	<table class="settings-box-table" width="100%"><tbody><tr>
		<td>
			<label for="post_item_quote_text"><?php esc_html_e('Quote Text', 'thegem'); ?>:</label><br />
			<?php wp_editor($post_item_data['quote_text'], 'post_item_quote_text', array('textarea_name' => 'thegem_post_item_data[quote_text]')); ?><br />
			<br />
			<label for="post_item_quote_author"><?php esc_html_e('Quote Author', 'thegem'); ?>:</label><br />
			<input type="text" name="thegem_post_item_data[quote_author]" id="post_item_quote_author" value="<?php echo esc_attr($post_item_data['quote_author']); ?>" /><br />
			<br />
			<label for="post_item_video_quote_background"><?php esc_html_e('Background Color', 'thegem'); ?>:</label><br />
			<input type="text" name="thegem_post_item_data[quote_background]" id="post_item_quote_background" value="<?php echo esc_attr($post_item_data['quote_background']); ?>" class="color-select" /><br />
			<br />
			<label for="post_item_video_quote_author_color"><?php esc_html_e('Author &amp; Link Color', 'thegem'); ?>:</label><br />
			<input type="text" name="thegem_post_item_data[quote_author_color]" id="post_item_quote_author_color" value="<?php echo esc_attr($post_item_data['quote_author_color']); ?>" class="color-select" />
		</td>
	</tr></tbody></table>
</fieldset>
<fieldset>
	<legend><?php esc_html_e('For Audio Post', 'thegem'); ?></legend>
	<table class="settings-box-table" width="100%"><tbody><tr>
		<td>
			<label for="post_item_audio"><?php esc_html_e('Audio', 'thegem'); ?>:</label><br />
			<input type="text" name="thegem_post_item_data[audio]" id="post_item_audio" value="<?php echo esc_attr($post_item_data['audio']); ?>" class="audio-select" />
		</td>
	</tr></tbody></table>
</fieldset>
<?php if(thegem_is_plugin_active('thegem-elements/thegem-elements.php')) : ?>
<fieldset>
	<legend><?php esc_html_e('For Gallery Post', 'thegem'); ?></legend>
	<table class="settings-box-table" width="100%"><tbody><tr>
		<td>
			<label for="post_item_gallery"><?php esc_html_e('Gallery', 'thegem'); ?>:</label><br />
			<?php thegem_print_select_input(thegem_galleries_array(), esc_attr($post_item_data['gallery']), 'thegem_post_item_data[gallery]', 'post_item_gallery'); ?><br />
			<br />
			<label for="post_item_gallery_autoscroll"><?php esc_html_e('Autoscroll (msec)', 'thegem'); ?>:</label><br />
			<input type="text" name="thegem_post_item_data[gallery_autoscroll]" id="post_item_gallery_autoscroll" value="<?php echo esc_attr($post_item_data['gallery_autoscroll']); ?>" />
		</td>
	</tr></tbody></table>
</fieldset>
<?php endif; ?>
</div>
<?php
}

function thegem_save_page_data($post_id) {
	if(
		!isset($_POST['thegem_page_title_settings_box_nonce']) ||
		!isset($_POST['thegem_page_header_settings_box_nonce']) ||
		!isset($_POST['thegem_page_effects_settings_box_nonce']) ||
		(!isset($_POST['thegem_page_slideshow_settings_box_nonce']) && thegem_is_plugin_active('thegem-elements/thegem-elements.php')) ||
		!isset($_POST['thegem_page_sidebar_settings_box_nonce'])
	) {
		return;
	}
	if(
		!wp_verify_nonce($_POST['thegem_page_title_settings_box_nonce'], 'thegem_page_title_settings_box') ||
		!wp_verify_nonce($_POST['thegem_page_header_settings_box_nonce'], 'thegem_page_header_settings_box') ||
		!wp_verify_nonce($_POST['thegem_page_effects_settings_box_nonce'], 'thegem_page_effects_settings_box') ||
		(!wp_verify_nonce($_POST['thegem_page_slideshow_settings_box_nonce'], 'thegem_page_slideshow_settings_box') && thegem_is_plugin_active('thegem-elements/thegem-elements.php')) ||
		!wp_verify_nonce($_POST['thegem_page_sidebar_settings_box_nonce'], 'thegem_page_sidebar_settings_box')
	) {
		return;
	}

	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}

	if(isset($_POST['post_type']) && in_array($_POST['post_type'], array('post', 'page', 'thegem_pf_item', 'thegem_news'))) {
		if(!current_user_can('edit_page', $post_id)) {
			return;
		}
	} else {
		if(!current_user_can('edit_post', $post_id)) {
			return;
		}
	}

	if(!isset($_POST['thegem_page_data']) || !is_array($_POST['thegem_page_data'])) {
		return;
	}

	$page_data = array_merge(
		thegem_get_sanitize_page_title_data(0, $_POST['thegem_page_data']),
		thegem_get_sanitize_page_header_data(0, $_POST['thegem_page_data']),
		thegem_get_sanitize_page_effects_data(0, $_POST['thegem_page_data']),
		thegem_get_sanitize_page_preloader_data(0, $_POST['thegem_page_data']),
		thegem_get_sanitize_page_slideshow_data(0, $_POST['thegem_page_data']),
		thegem_get_sanitize_page_sidebar_data(0, $_POST['thegem_page_data'])
	);
	update_post_meta($post_id, 'thegem_page_data', $page_data);
}
add_action('save_post', 'thegem_save_page_data');

function thegem_get_sanitize_page_title_data($post_id = 0, $item_data = array()) {
	$page_data = apply_filters('thegem_page_title_data_defaults', array(
		'title_style' => '1',
		'title_rich_content' => '',
		'title_content' => '',
		'title_background_image' => thegem_get_option('default_page_title_background_image'),
		'title_background_color' => thegem_get_option('default_page_title_background_color'),
		'title_video_type' => '',
		'title_video_background' => '',
		'title_video_aspect_ratio' => '',
		'title_video_overlay_color' => '',
		'title_video_overlay_opacity' => '',
		'title_video_poster' => '',
		'title_menu_on_video' => '',
		'title_text_color' => thegem_get_option('default_page_title_text_color'),
		'title_excerpt_text_color' => thegem_get_option('default_page_title_excerpt_text_color'),
		'title_excerpt' => '',
		'title_title_width' => thegem_get_option('default_page_title_max_width'),
		'title_excerpt_width' => thegem_get_option('default_page_title_excerpt_width'),
		'title_padding_top' => thegem_get_option('default_page_title_top_padding') ? thegem_get_option('default_page_title_top_padding') : 80,
		'title_padding_bottom' => thegem_get_option('default_page_title_bottom_padding') ? thegem_get_option('default_page_title_bottom_padding') : 80,
		'title_top_margin' => thegem_get_option('default_page_title_top_margin'),
		'title_excerpt_top_margin' => thegem_get_option('default_page_title_excerpt_top_margin') ? thegem_get_option('default_page_title_excerpt_top_margin') : 18,
		'title_breadcrumbs' => '',
		'title_alignment' => thegem_get_option('default_page_title_alignment'),
		'title_icon_pack' => '',
		'title_icon' => '',
		'title_icon_color' => '',
		'title_icon_color_2' => '',
		'title_icon_background_color' => '',
		'title_icon_shape' => '',
		'title_icon_border_color' => '',
		'title_icon_size' => '',
		'title_icon_style' => '',
		'title_icon_opacity' => '',
	));
	if(is_array($item_data) && !empty($item_data)) {
		$page_data = array_merge($page_data, $item_data);
	} elseif($post_id != 0) {
		$page_data = thegem_get_post_data($page_data, 'page', $post_id);
	}
	$page_data['title_rich_content'] = $page_data['title_rich_content'] ? 1 : 0;
	$page_data['title_style'] = thegem_check_array_value(array('', '1', '2'), $page_data['title_style'], '1');
	$page_data['title_background_image'] = esc_url($page_data['title_background_image']);
	$page_data['title_background_color'] = sanitize_text_field($page_data['title_background_color']);
	$page_data['title_video_type'] = thegem_check_array_value(array('', 'youtube', 'vimeo', 'self'), $page_data['title_video_type'], '');
	$page_data['title_video_background'] = sanitize_text_field($page_data['title_video_background']);
	$page_data['title_video_aspect_ratio'] = sanitize_text_field($page_data['title_video_aspect_ratio']);
	$page_data['title_video_overlay_color'] = sanitize_text_field($page_data['title_video_overlay_color']);
	$page_data['title_video_overlay_opacity'] = sanitize_text_field($page_data['title_video_overlay_opacity']);
	$page_data['title_video_poster'] = esc_url($page_data['title_video_poster']);
	$page_data['title_text_color'] = sanitize_text_field($page_data['title_text_color']);
	$page_data['title_excerpt_text_color'] = sanitize_text_field($page_data['title_excerpt_text_color']);
	$page_data['title_excerpt'] = implode("\n", array_map('sanitize_text_field', explode("\n", $page_data['title_excerpt'])));
	$page_data['title_title_width'] = intval($page_data['title_title_width']) > 0 ? intval($page_data['title_title_width']) : 0;
	$page_data['title_excerpt_width'] = intval($page_data['title_excerpt_width']) > 0 ? intval($page_data['title_excerpt_width']) : 0;
	$page_data['title_top_margin'] = intval($page_data['title_top_margin']);
	$page_data['title_excerpt_top_margin'] = intval($page_data['title_excerpt_top_margin']);
	$page_data['title_breadcrumbs'] = $page_data['title_breadcrumbs'] ? 1 : 0;
	$page_data['title_padding_top'] = intval($page_data['title_padding_top']) >= 0 ? intval($page_data['title_padding_top']) : 0;
	$page_data['title_padding_bottom'] = intval($page_data['title_padding_bottom']) >= 0 ? intval($page_data['title_padding_bottom']) : 0;
	$page_data['title_icon_pack'] = thegem_check_array_value(array('elegant', 'material', 'fontawesome', 'userpack'), $page_data['title_icon_pack'], 'elegant');
	$page_data['title_icon'] = sanitize_text_field($page_data['title_icon']);
	$page_data['title_alignment'] = thegem_check_array_value(array('center', 'left', 'right'), $page_data['title_alignment'], 'center');
	$page_data['title_icon_color'] = sanitize_text_field($page_data['title_icon_color']);
	$page_data['title_icon_color_2'] = sanitize_text_field($page_data['title_icon_color_2']);
	$page_data['title_icon_background_color'] = sanitize_text_field($page_data['title_icon_background_color']);
	$page_data['title_icon_border_color'] = sanitize_text_field($page_data['title_icon_border_color']);
	$page_data['title_icon_shape'] = thegem_check_array_value(array('circle', 'square', 'romb', 'hexagon'), $page_data['title_icon_shape'], 'circle');
	$page_data['title_icon_size'] = thegem_check_array_value(array('small', 'medium', 'large', 'xlarge'), $page_data['title_icon_size'], 'large');
	$page_data['title_icon_style'] = thegem_check_array_value(array('', 'angle-45deg-r', 'angle-45deg-l', 'angle-90deg'), $page_data['title_icon_style'], '');
	$page_data['title_icon_opacity'] = floatval($page_data['title_icon_opacity']) >= 0 && floatval($page_data['title_icon_opacity']) <= 1 ? floatval($page_data['title_icon_opacity']) : 0;

	return $page_data;
}

function thegem_get_sanitize_page_header_data($post_id = 0, $item_data = array()) {
	$page_data = array(
		'header_transparent' => '',
		'header_opacity' => '',
		'header_menu_logo_light' => '',
		'header_hide_top_area' => '',
	);
	if(is_array($item_data) && !empty($item_data)) {
		$page_data = array_merge($page_data, $item_data);
	} elseif($post_id != 0) {
		$page_data = thegem_get_post_data($page_data, 'page', $post_id);
	}
	$page_data['header_transparent'] = $page_data['header_transparent'] ? 1 : 0;
	$page_data['header_opacity'] = intval($page_data['header_opacity']) >= 0 && intval($page_data['header_opacity']) <= 100 ? intval($page_data['header_opacity']) : 0;
	$page_data['header_menu_logo_light'] = $page_data['header_menu_logo_light'] ? 1 : 0;
	$page_data['header_hide_top_area'] = $page_data['header_hide_top_area'] ? 1 : 0;
	return $page_data;
}

function thegem_get_sanitize_page_effects_data($post_id = 0, $item_data = array()) {
	$page_data = array(
		'effects_disabled' => false,
		'effects_page_scroller' => false,
		'effects_one_pager' => false,
		'effects_parallax_footer' => false,
		'effects_no_bottom_margin' => false,
		'effects_no_top_margin' => false,
		'redirect_to_subpage' => false,
		'effects_hide_header' => false,
		'effects_hide_footer' => false,
	);
	if(is_array($item_data) && !empty($item_data)) {
		$page_data = array_merge($page_data, $item_data);
	} elseif($post_id != 0) {
		$page_data = thegem_get_post_data($page_data, 'page', $post_id);
	}
	$page_data['effects_disabled'] = $page_data['effects_disabled'] ? 1 : 0;
	$page_data['effects_page_scroller'] = $page_data['effects_page_scroller'] ? 1 : 0;
	$page_data['effects_one_pager'] = $page_data['effects_one_pager'] ? 1 : 0;
	$page_data['effects_parallax_footer'] = $page_data['effects_parallax_footer'] ? 1 : 0;
	$page_data['effects_no_bottom_margin'] = $page_data['effects_no_bottom_margin'] ? 1 : 0;
	$page_data['effects_no_top_margin'] = $page_data['effects_no_top_margin'] ? 1 : 0;
	$page_data['redirect_to_subpage'] = $page_data['redirect_to_subpage'] ? 1 : 0;
	$page_data['effects_hide_header'] = $page_data['effects_hide_header'] ? 1 : 0;
	$page_data['effects_hide_footer'] = $page_data['effects_hide_footer'] ? 1 : 0;
	return $page_data;
}

function thegem_get_sanitize_page_preloader_data($post_id = 0, $item_data = array()) {
	$page_data = array(
		'enable_page_preloader' => false,
	);
	if(is_array($item_data) && !empty($item_data)) {
		$page_data = array_merge($page_data, $item_data);
	} elseif($post_id != 0) {
		$page_data = thegem_get_post_data($page_data, 'page', $post_id);
	}
	$page_data['enable_page_preloader'] = $page_data['enable_page_preloader'] ? 1 : 0;
	return $page_data;
}

function thegem_get_sanitize_page_slideshow_data($post_id = 0, $item_data = array()) {
	$page_data = array(
		'slideshow_type' => '',
		'slideshow_slideshow' => '',
		'slideshow_layerslider' => '',
		'slideshow_revslider' => '',
	);
	if(is_array($item_data) && !empty($item_data)) {
		$page_data = array_merge($page_data, $item_data);
	} elseif($post_id != 0) {
		$page_data = thegem_get_post_data($page_data, 'page', $post_id);
	}
	$page_data['slideshow_type'] = thegem_check_array_value(array('', 'NivoSlider', 'LayerSlider', 'revslider'), $page_data['slideshow_type'], '');
	$page_data['slideshow_slideshow'] = sanitize_text_field($page_data['slideshow_slideshow']);
	$page_data['slideshow_layerslider'] = sanitize_text_field($page_data['slideshow_layerslider']);
	$page_data['slideshow_revslider'] = sanitize_text_field($page_data['slideshow_revslider']);
	return $page_data;
}

function thegem_get_sanitize_page_sidebar_data($post_id = 0, $item_data = array()) {
	$page_data = array(
		'sidebar_position' => '',
		'sidebar_sticky' => '',
	);
	if(is_array($item_data) && !empty($item_data)) {
		$page_data = array_merge($page_data, $item_data);
	} elseif($post_id != 0) {
		$page_data = thegem_get_post_data($page_data, 'page', $post_id);
	}
	$page_data['sidebar_position'] = thegem_check_array_value(array('', 'left', 'right'), $page_data['sidebar_position'], '');
	$page_data['sidebar_sticky'] = $page_data['sidebar_sticky'] ? 1 : 0;
	return $page_data;
}

function thegem_post_item_save_meta_box_data($post_id) {
	if(!isset($_POST['thegem_post_item_settings_box_nonce'])) {
		return;
	}
	if(!wp_verify_nonce($_POST['thegem_post_item_settings_box_nonce'], 'thegem_post_item_settings_box')) {
		return;
	}
	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}

	if(isset($_POST['post_type']) && ('thegem_news' == $_POST['post_type'] || 'post' == $_POST['post_type'])) {
		if(!current_user_can('edit_page', $post_id)) {
			return;
		}
	} else {
		if(!current_user_can('edit_post', $post_id)) {
			return;
		}
	}

	if(!isset($_POST['thegem_post_item_data']) || !is_array($_POST['thegem_post_item_data'])) {
		return;
	}

	$post_item_data = thegem_get_sanitize_post_data(0, $_POST['thegem_post_item_data']);
	update_post_meta($post_id, 'thegem_post_general_item_data', $post_item_data);
}
add_action('save_post', 'thegem_post_item_save_meta_box_data');

function thegem_get_sanitize_post_data($post_id = 0, $item_data = array()) {
	$post_item_data = array(
		'show_featured_content' => 0,
		'video_type' => 'youtube',
		'video' => '',
		'video_aspect_ratio' => '',
		'quote_text' => '',
		'quote_author' => '',
		'quote_background' => '',
		'quote_author_color' => '',
		'audio' => '',
		'gallery' => '',
		'gallery_autoscroll' => '',
	);
	if(is_array($item_data) && !empty($item_data)) {
		$post_item_data = array_merge($post_item_data, $item_data);
	} elseif($post_id != 0) {
		$post_item_data = thegem_get_post_data($post_item_data, 'post_general_item', $post_id);
	}

	$post_item_data['show_featured_content'] = $post_item_data['show_featured_content'] ? 1 : 0;
	$post_item_data['video_type'] = thegem_check_array_value(array('youtube', 'vimeo', 'self'), $post_item_data['video_type'], 'youtube');
	$post_item_data['video'] = sanitize_text_field($post_item_data['video']);
	$post_item_data['video_aspect_ratio'] = sanitize_text_field($post_item_data['video_aspect_ratio']);
	$post_item_data['quote_author'] = sanitize_text_field($post_item_data['quote_author']);
	$post_item_data['quote_background'] = sanitize_text_field($post_item_data['quote_background']);
	$post_item_data['quote_author_color'] = sanitize_text_field($post_item_data['quote_author_color']);
	$post_item_data['audio'] = sanitize_text_field($post_item_data['audio']);
	$post_item_data['gallery'] = intval($post_item_data['gallery']);
	$post_item_data['gallery_autoscroll'] = intval($post_item_data['gallery_autoscroll']);

	return $post_item_data;
}

function thegem_product_size_guide_settings_box($post) {
	wp_nonce_field('thegem_product_size_guide_settings_box', 'thegem_product_size_guide_settings_box_nonce');
	$product_size_guide_data = thegem_get_sanitize_product_size_guide_data($post->ID);
?>
<table class="settings-box-table" width="100%"><tbody><tr>
	<td>
		<input name="thegem_product_size_guide_data[disable]" type="checkbox" id="product_size_guide_disable" value="1" <?php checked($product_size_guide_data['disable'], 1); ?> />
		<label for="product_size_guide_disable"><?php esc_html_e('Disable size guide', 'thegem'); ?></label><br /><br />
		<input name="thegem_product_size_guide_data[custom]" type="checkbox" id="product_size_guide_custom" value="1" <?php checked($product_size_guide_data['custom'], 1); ?> />
		<label for="product_size_guide_custom"><?php esc_html_e('Use custom size guide', 'thegem'); ?></label><br /><br />
		<label for="product_size_guide_custom_image"><?php esc_html_e('Size guide custom image', 'thegem'); ?>:</label><br />
		<input type="text" name="thegem_product_size_guide_data[custom_image]" id="product_size_guide_custom_image" value="<?php echo esc_attr($product_size_guide_data['custom_image']); ?>" class="picture-select" />
	</td>
</tr></tbody></table>
<?php
}

function thegem_product_size_guide_save_meta_box_data($post_id) {
	if(!isset($_POST['thegem_product_size_guide_settings_box_nonce'])) {
		return;
	}
	if(!wp_verify_nonce($_POST['thegem_product_size_guide_settings_box_nonce'], 'thegem_product_size_guide_settings_box')) {
		return;
	}
	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}

	if(isset($_POST['post_type']) && ('product' == $_POST['post_type'])) {
		if(!current_user_can('edit_page', $post_id)) {
			return;
		}
	} else {
		if(!current_user_can('edit_post', $post_id)) {
			return;
		}
	}

	if(!isset($_POST['thegem_product_size_guide_data']) || !is_array($_POST['thegem_product_size_guide_data'])) {
		return;
	}

	$product_size_guide_data = thegem_get_sanitize_post_data(0, $_POST['thegem_product_size_guide_data']);
	update_post_meta($post_id, 'thegem_product_size_guide_data', $product_size_guide_data);
}
add_action('save_post', 'thegem_product_size_guide_save_meta_box_data');

function thegem_get_sanitize_product_size_guide_data($post_id = 0, $item_data = array()) {
	$post_item_data = array(
		'disable' => 0,
		'custom' => 0,
		'custom_image' => '',
	);
	if(is_array($item_data) && !empty($item_data)) {
		$post_item_data = array_merge($post_item_data, $item_data);
	} elseif($post_id != 0) {
		$post_item_data = thegem_get_post_data($post_item_data, 'product_size_guide', $post_id);
	}

	$post_item_data['disable'] = $post_item_data['disable'] ? 1 : 0;
	$post_item_data['custom'] = $post_item_data['custom'] ? 1 : 0;
	$post_item_data['custom_image'] = esc_url($post_item_data['custom_image']);

	return $post_item_data;
}

add_action('wp_ajax_thegem_icon_list', 'thegem_icon_list_info');
function thegem_icon_list_info() {
	if(!empty($_REQUEST['iconpack']) && in_array($_REQUEST['iconpack'], array('elegant', 'material', 'fontawesome', 'userpack'))) {
		$svg_links = array(
			'elegant' => get_template_directory_uri() . '/fonts/elegant/ElegantIcons.svg',
			'material' => get_template_directory_uri() . '/fonts/material/materialdesignicons.svg',
			'fontawesome' => get_template_directory_uri() . '/fonts/fontawesome/fontawesome-webfont.svg',
			'userpack' => get_stylesheet_directory_uri() . '/fonts/UserPack/UserPack.svg',
		);
		$css_links = array(
			'elegant' => get_template_directory_uri() . '/css/icons-elegant.css',
			'material' => get_template_directory_uri() . '/css/icons-material.css',
			'fontawesome' => get_template_directory_uri() . '/css/icons-fontawesome.css',
			'userpack' => get_stylesheet_directory_uri() . '/css/icons-userpack.css',
		);
		echo '<ul class="icons-list icons-'.esc_attr($_REQUEST['iconpack']).' styled"></ul>';
?>
	<script type="text/javascript">
	(function($) {
		$(function() {
			$.ajax({
				url: '<?php echo esc_url($svg_links[$_REQUEST['iconpack']]); ?>'
			}).done(function(data) {
				var $glyphs = $('glyph', data);
				$('.icons-list').html('');
				$glyphs.each(function() {
					var code = $(this).attr('unicode').charCodeAt(0).toString(16);
					if($(this).attr('d')) {
						$('<li><span class="icon">'+$(this).attr('unicode')+'</span><span class="code">'+code+'</span></li>').appendTo($('.icons-list'));
					}
				});
			});
		});
	})(jQuery);
	</script>
<?php
		exit;
	}
	die(-1);
}
