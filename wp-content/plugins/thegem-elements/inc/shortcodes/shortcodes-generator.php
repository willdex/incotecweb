<?php

function thegem_add_shortcodes_generator_metabox() {
	add_meta_box('thegem_shortcodes_generator', __('Shortcodes Generator', 'thegem'), 'thegem_shortcodes_generator_metabox', 'post', 'side', 'high');
	add_meta_box('thegem_shortcodes_generator', __('Shortcodes Generator', 'thegem'), 'thegem_shortcodes_generator_metabox', 'page', 'side', 'high');
}
add_action('add_meta_boxes', 'thegem_add_shortcodes_generator_metabox');

function thegem_shortcodes_generator_metabox($post) {
	$shortcodes = thegem_shortcodes();
?>
<div id="shortcode-generator">
	<div class="shortcodes-select">
		<label><?php _e('Select Shortcode', 'thegem') ?>:</label>
		<select>
			<option><?php _e('-- Select Shortcode --', 'thegem'); ?></option>
			<?php foreach($shortcodes as $id => $shortcode) : ?>
			<option value="shortcode-item-<?php echo esc_attr($id); ?>"><?php echo $shortcode['name']; ?></option>
			<?php endforeach; ?>
		</select>
	</div>
	<div class="shortcodes-blocks">
		<?php foreach($shortcodes as $id => $shortcode) : ?>
			<div class="shortcode-item" data-name="<?php echo esc_attr($id); ?>" id="shortcode-item-<?php echo $id; ?>"<?php echo thegem_gem_is_container($shortcode) ? ' data-is_container="1"' : ''; ?>>
				<hr>
				<div class="shortcode-item-description"><?php echo !empty($shortcode['description']) ? $shortcode['description'] : '' ; ?></div>
				<div class="shortcode-item-params">
					<?php foreach($shortcode['params'] as $param) : ?>
						<div class="shortcode-item-param">
							<div class="shortcode-item-param-title"><?php echo $param['heading']; ?>:</div>
							<div class="shortcode-item-param-field"><?php echo thegem_scg_field($param); ?></div>
							<?php if(isset($param['description'])) : ?>
								<div class="shortcode-item-param-description"><?php echo $param['description']; ?></div>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>
				<hr>
			</div>
		<?php endforeach; ?>
	</div>
	<div class="shortcode-insert-button"><button><?php _e('Insert Shortcode', 'thegem'); ?></button></div>
	<div class="shortcode-result"><textarea></textarea></div>
</div>
<?php
}

function thegem_scg_field($param) {
	$output = '';
	$param['param_name'] = 'scg_'.$param['param_name'];
	switch ($param['type']) {
		case 'dropdown':
			$output .= '<select name="'.esc_attr($param['param_name']).'">';
			foreach($param['value'] as $title => $key) {
				$output .= '<option value="'.esc_attr($key).'">'.$title.'</option>';
			}
			$output .= '</select>';
			break;
		case 'attach_image':
			$output .= '<input type="text" name="'.esc_attr($param['param_name']).'"'.(isset($param['value']) ? ' value="'.esc_attr($param['value']).'"' : '').' class="picture-select-id">';
			break;
		case 'colorpicker':
			$output .= '<input type="text" name="'.esc_attr($param['param_name']).'"'.(isset($param['value']) ? ' value="'.esc_attr($param['value']).'"' : '').' class="color-select">';
			break;
		case 'checkbox':
			foreach($param['value'] as $title => $key) {
				$output .= '<input type="checkbox" name="'.esc_attr($param['param_name']).'" value="'.$key.'"> '.$title;
			}
			break;
		case 'textarea':
		case 'textarea_html':
		case 'textarea_safe':
			$output .= '<textarea name="'.esc_attr($param['param_name']).'">'.(isset($param['value']) ? esc_textarea($param['value']) : '').'</textarea>';
			break;
		default:
			$output .= '<input type="text" name="'.esc_attr($param['param_name']).'"'.(isset($param['value']) ? ' value="'.esc_attr($param['value']).'"' : '').'>';
			break;
	}
	return $output;
}

function thegem_gem_is_container($shortcode) {
	if(isset($shortcode['is_container']) && $shortcode['is_container']) {
		return true;
	}
	foreach($shortcode['params'] as $param) {
		if($param['param_name'] == 'content') {
			return true;
		}
	}
	return false;
}