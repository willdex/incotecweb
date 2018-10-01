<?php

function thegem_quickfinder_item_post_type_init() {
	$labels = array(
		'name'               => __('Quickfinder Items', 'thegem'),
		'singular_name'      => __('Quickfinder Item', 'thegem'),
		'menu_name'          => __('Quickfinders', 'thegem'),
		'name_admin_bar'     => __('Quickfinder Item', 'thegem'),
		'add_new'            => __('Add New', 'thegem'),
		'add_new_item'       => __('Add New Quickfinder Item', 'thegem'),
		'new_item'           => __('New Quickfinder Item', 'thegem'),
		'edit_item'          => __('Edit Quickfinder Item', 'thegem'),
		'view_item'          => __('View Quickfinder Item', 'thegem'),
		'all_items'          => __('All Quickfinder Items', 'thegem'),
		'search_items'       => __('Search Quickfinder Items', 'thegem'),
		'not_found'          => __('No quickfinder items found.', 'thegem'),
		'not_found_in_trash' => __('No quickfinder items found in Trash.', 'thegem')
	);

	$args = array(
		'labels'               => $labels,
		'public'               => false,
		'exclude_from_search'  => true,
		'publicly_queryable'   => false,
		'show_ui'              => true,
		'query_var'            => false,
		'hierarchical'         => false,
		'supports'             => array('title', 'thumbnail', 'page-attributes'),
		'register_meta_box_cb' => 'thegem_quickfinder_items_register_meta_box',
		'taxonomies'           => array('thegem_quickfinders')
	);

	register_post_type('thegem_qf_item', $args);

	$labels = array(
		'name'                       => __('Quickfinders', 'thegem'),
		'singular_name'              => __('Quickfinder', 'thegem'),
		'search_items'               => __('Search Quickfinders', 'thegem'),
		'popular_items'              => __('Popular Quickfinders', 'thegem'),
		'all_items'                  => __('All Quickfinders', 'thegem'),
		'edit_item'                  => __('Edit Quickfinder', 'thegem'),
		'update_item'                => __('Update Quickfinder', 'thegem'),
		'add_new_item'               => __('Add New Quickfinder', 'thegem'),
		'new_item_name'              => __('New Quickfinder Name', 'thegem'),
		'separate_items_with_commas' => __('Separate Quickfinders with commas', 'thegem'),
		'add_or_remove_items'        => __('Add or remove Quickfinders', 'thegem'),
		'choose_from_most_used'      => __('Choose from the most used Quickfinders', 'thegem'),
		'not_found'                  => __('No quickfinders found.', 'thegem'),
		'menu_name'                  => __('Quickfinders', 'thegem'),
	);

	$args = array(
		'hierarchical'          => true,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => false,
		'public'                => false,
		'rewrite'               => false,
	);

	register_taxonomy('thegem_quickfinders', 'thegem_qf_item', $args);
}
add_action('init', 'thegem_quickfinder_item_post_type_init', 5);

/* QUICKFINDER ITEM POST META BOX */

function thegem_quickfinder_items_register_meta_box($post) {
	add_meta_box('thegem_quickfinder_item_settings', __('Quickfinder Item Settings', 'thegem'), 'thegem_quickfinder_item_settings_box', 'thegem_qf_item', 'normal', 'high');
}

function thegem_quickfinder_item_settings_box($post) {
	wp_nonce_field('thegem_quickfinder_item_settings_box', 'thegem_quickfinder_item_settings_box_nonce');
	$quickfinder_item_data = thegem_get_sanitize_qf_item_data($post->ID);
	$icon_styles = array('' => __('None', 'thegem'), 'angle-45deg-l' => __('45&deg; Left','thegem'), 'angle-45deg-r' => __('45&deg; Right','thegem'), 'angle-90deg' => __('90&deg;','thegem'));
?>
<p class="meta-options">
<div class="thegem-title-settings">
	<fieldset>
		<legend><?php _e('Description & Link', 'thegem'); ?></legend>
		<table class="settings-box-table" width="100%"><tbody><tr>
			<td>
				<label for="quickfinder_item_description"><?php _e('Description', 'thegem'); ?>:</label><br />
				<textarea name="thegem_quickfinder_item_data[description]" id="quickfinder_item_description" style="width: 100%;" rows="3"/><?php echo esc_textarea($quickfinder_item_data['description']); ?></textarea><br />
			</td>
			<td>
				<label for="quickfinder_item_link"><?php _e('Link', 'thegem'); ?>:</label><br />
				<input name="thegem_quickfinder_item_data[link]" type="text" id="quickfinder_item_link" value="<?php echo esc_attr($quickfinder_item_data['link']); ?>" style="width: 100%;" /><br />
				<br />
				<label for="quickfinder_item_link_text"><?php _e('Button text', 'thegem'); ?>:</label><br />
				<input name="thegem_quickfinder_item_data[link_text]" type="text" id="quickfinder_item_link_text" value="<?php echo esc_attr($quickfinder_item_data['link_text']); ?>" style="width: 100%;" /><br />
				<br />
				<label for="quickfinder_item_link_target"><?php _e('Link target', 'thegem'); ?>:</label><br />
				<?php thegem_print_select_input(array('_self' => 'Self', '_blank' => 'Blank'), $quickfinder_item_data['link_target'], 'thegem_quickfinder_item_data[link_target]', 'quickfinder_item_link_target'); ?><br />
				<br />
			</td>
		</tr></tbody></table>
	</fieldset>
	<fieldset>
		<legend><?php _e('Colors', 'thegem'); ?></legend>
		<table class="settings-box-table" width="100%"><tbody><tr>
			<td>
				<label for="quickfinder_item_title_text_color"><?php _e('Title text color', 'thegem'); ?>:</label><br />
				<input name="thegem_quickfinder_item_data[title_text_color]" type="text" id="quickfinder_item_title_text_color" value="<?php echo esc_attr($quickfinder_item_data['title_text_color']); ?>" class="color-select" /><br />
			</td>
			<td>
				<label for="quickfinder_item_description_text_color"><?php _e('Description text color', 'thegem'); ?>:</label><br />
				<input name="thegem_quickfinder_item_data[description_text_color]" type="text" id="quickfinder_item_description_text_color" value="<?php echo esc_attr($quickfinder_item_data['description_text_color']); ?>" class="color-select" /><br />
			</td>
		</tr></tbody></table>
	</fieldset>
	<fieldset>
		<legend><?php _e('Icon', 'thegem'); ?></legend>
		<table class="settings-box-table" width="100%"><tbody><tr>
			<td>
				<label for="quickfinder_item_icon_pack"><?php _e('Icon Pack', 'thegem'); ?>:</label><br />
				<?php thegem_print_select_input(thegem_icon_packs_select_array(), $quickfinder_item_data['icon_pack'], 'thegem_quickfinder_item_data[icon_pack]', 'quickfinder_item_icon_pack'); ?><br /><br />
				<?php
					add_thickbox();
					wp_enqueue_style('icons-elegant');
					wp_enqueue_style('icons-material');
					wp_enqueue_style('icons-fontawesome');
					wp_enqueue_style('icons-userpack');
					wp_enqueue_script('thegem-icons-picker');
				?>
				<label for="quickfinder_item_icon"><?php _e('Icon', 'thegem'); ?>:</label><br />
				<input name="thegem_quickfinder_item_data[icon]" type="text" id="quickfinder_item_icon" value="<?php echo esc_attr($quickfinder_item_data['icon']); ?>" class="icons-picker" /><br />
				<br />
				<label for="quickfinder_item_icon_color"><?php _e('Icon Color', 'thegem'); ?>:</label><br />
				<input name="thegem_quickfinder_item_data[icon_color]" type="text" id="quickfinder_item_icon_color" value="<?php echo esc_attr($quickfinder_item_data['icon_color']); ?>" class="color-select" /><br />
				<br />
				<label for="quickfinder_item_icon_color_2"><?php _e('Icon Color 2', 'thegem'); ?>:</label><br />
				<input name="thegem_quickfinder_item_data[icon_color_2]" type="text" id="quickfinder_item_icon_color_2" value="<?php echo esc_attr($quickfinder_item_data['icon_color_2']); ?>" class="color-select" /><br />
				<br />
				<label for="quickfinder_item_icon_style"><?php _e('Icon Style', 'thegem'); ?>:</label><br />
				<?php thegem_print_select_input($icon_styles, esc_attr($quickfinder_item_data['icon_style']), 'thegem_quickfinder_item_data[icon_style]', 'quickfinder_item_icon_styles'); ?>
			</td>
			<td>
				<label for="quickfinder_item_icon_background_color"><?php _e('Icon background color', 'thegem'); ?>:</label><br />
				<input name="thegem_quickfinder_item_data[icon_background_color]" type="text" id="quickfinder_item_icon_background_color" value="<?php echo esc_attr($quickfinder_item_data['icon_background_color']); ?>" class="color-select" /><br />
				<br />
				<label for="quickfinder_item_icon_border_color"><?php _e('Icon border color', 'thegem'); ?>:</label><br />
				<input name="thegem_quickfinder_item_data[icon_border_color]" type="text" id="quickfinder_item_icon_border_color" value="<?php echo esc_attr($quickfinder_item_data['icon_border_color']); ?>" class="color-select" /><br />
				<br />
				<label for="quickfinder_item_icon_shape"><?php _e('Icon shape', 'thegem'); ?>:</label><br />
				<?php thegem_print_select_input(array('circle' => __('Circle', 'thegem'), 'square' => __('Square', 'thegem'), 'romb' => __('Rhombus', 'thegem'), 'hexagon' => __('Hexagon', 'thegem')), $quickfinder_item_data['icon_shape'], 'thegem_quickfinder_item_data[icon_shape]', 'quickfinder_item_icon_shape'); ?><br />
				<br />
				<label for="quickfinder_item_icon_size"><?php _e('Icon size', 'thegem'); ?>:</label><br />
				<?php thegem_print_select_input(array('small' => __('Small', 'thegem'), 'medium' => __('Medium', 'thegem'), 'large' => __('Large', 'thegem'), 'xlarge' => __('xLarge', 'thegem')), $quickfinder_item_data['icon_size'], 'thegem_quickfinder_item_data[icon_size]', 'quickfinder_item_icon_size'); ?><br />
				<br />
			</td>
		</tr></tbody></table>
	</fieldset>
</div>
<script type="text/javascript">
(function($) {
	$(function() {
		$('#quickfinder_item_icon_pack').change(function() {
			$('.gem-icon-info').hide();
			$('.gem-icon-info-' + $(this).val()).show();
			$('#quickfinder_item_icon').data('iconpack', $(this).val());
		}).trigger('change');
	});
})(jQuery);
</script>
</p>
<?php
}

function thegem_quickfinder_item_save_meta_box_data($post_id) {
	if(!isset($_POST['thegem_quickfinder_item_settings_box_nonce'])) {
		return;
	}
	if(!wp_verify_nonce($_POST['thegem_quickfinder_item_settings_box_nonce'], 'thegem_quickfinder_item_settings_box')) {
		return;
	}
	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}

	if(isset($_POST['post_type']) && 'thegem_qf_item' == $_POST['post_type']) {
		if(!current_user_can('edit_page', $post_id)) {
			return;
		}
	} else {
		if(!current_user_can('edit_post', $post_id)) {
			return;
		}
	}

	if(!isset($_POST['thegem_quickfinder_item_data']) || !is_array($_POST['thegem_quickfinder_item_data'])) {
		return;
	}

	$quickfinder_item_data = thegem_get_sanitize_qf_item_data(0, $_POST['thegem_quickfinder_item_data']);
	update_post_meta($post_id, 'thegem_quickfinder_item_data', $quickfinder_item_data);
}
add_action('save_post', 'thegem_quickfinder_item_save_meta_box_data');

function thegem_get_sanitize_qf_item_data($post_id = 0, $item_data = array()) {
	$quickfinder_item_data = array(
		'description' => '',
		'title_text_color' => '',
		'description_text_color' => '',
		'link' => '',
		'link_text' => '',
		'link_target' => '',
		'icon_color' => '',
		'icon_color_2' => '',
		'icon_background_color' => '',
		'icon_shape' => '',
		'icon_border_color' => '',
		'icon_size' => '',
		'icon_style' => '',
		'icon' => '',
		'icon_pack' => '',
	);
	if(is_array($item_data) && !empty($item_data)) {
		$quickfinder_item_data = array_merge($item_data);
	} elseif($post_id != 0) {
		$quickfinder_item_data = thegem_get_post_data($quickfinder_item_data, 'quickfinder_item', $post_id);
	}
	$quickfinder_item_data['description'] = implode("\n", array_map('sanitize_text_field', explode("\n", $quickfinder_item_data['description'])));
	$quickfinder_item_data['link'] = esc_url($quickfinder_item_data['link']);
	$quickfinder_item_data['link_target'] = thegem_check_array_value(array('_blank', '_self'), $quickfinder_item_data['link_target'], '_self');
	$quickfinder_item_data['icon_color'] = sanitize_text_field($quickfinder_item_data['icon_color']);
	$quickfinder_item_data['icon_color_2'] = sanitize_text_field($quickfinder_item_data['icon_color_2']);
	$quickfinder_item_data['icon_background_color'] = sanitize_text_field($quickfinder_item_data['icon_background_color']);
	$quickfinder_item_data['icon_border_color'] = sanitize_text_field($quickfinder_item_data['icon_border_color']);
	$quickfinder_item_data['icon_shape'] = thegem_check_array_value(array('circle', 'square', 'romb', 'hexagon'), $quickfinder_item_data['icon_shape'], 'circle');
	$quickfinder_item_data['icon_size'] = thegem_check_array_value(array('small', 'medium', 'large', 'xlarge'), $quickfinder_item_data['icon_size'], 'large');
	$quickfinder_item_data['icon_style'] = thegem_check_array_value(array('', 'angle-45deg-r', 'angle-45deg-l', 'angle-90deg'), $quickfinder_item_data['icon_style'], '');

	$quickfinder_item_data['title_text_color'] = sanitize_text_field($quickfinder_item_data['title_text_color']);
	$quickfinder_item_data['description_text_color'] = sanitize_text_field($quickfinder_item_data['description_text_color']);
	$quickfinder_item_data['link_text'] = sanitize_text_field($quickfinder_item_data['link_text']);
	$quickfinder_item_data['icon_pack'] = thegem_check_array_value(array('elegant', 'material', 'fontawesome', 'userpack'), $quickfinder_item_data['icon_pack'], 'elegant');
	$quickfinder_item_data['icon'] = sanitize_text_field($quickfinder_item_data['icon']);

	return $quickfinder_item_data;
}