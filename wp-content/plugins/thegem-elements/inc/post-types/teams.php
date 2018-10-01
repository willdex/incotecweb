<?php

function thegem_team_person_post_type_init() {
	$labels = array(
		'name'               => __('Team Persons', 'thegem'),
		'singular_name'      => __('Team Person', 'thegem'),
		'menu_name'          => __('Teams', 'thegem'),
		'name_admin_bar'     => __('Team Person', 'thegem'),
		'add_new'            => __('Add New', 'thegem'),
		'add_new_item'       => __('Add New Person', 'thegem'),
		'new_item'           => __('New Person', 'thegem'),
		'edit_item'          => __('Edit Person', 'thegem'),
		'view_item'          => __('View Person', 'thegem'),
		'all_items'          => __('All Persons', 'thegem'),
		'search_items'       => __('Search Persons', 'thegem'),
		'not_found'          => __('No persons found.', 'thegem'),
		'not_found_in_trash' => __('No persons found in Trash.', 'thegem')
	);

	$args = array(
		'labels'               => $labels,
		'public'               => false,
		'exclude_from_search'  => true,
		'publicly_queryable'   => false,
		'show_ui'              => true,
		'query_var'            => false,
		'hierarchical'         => false,
		'supports'             => array('title', 'editor', 'thumbnail', 'page-attributes'),
		'register_meta_box_cb' => 'thegem_team_persons_register_meta_box',
		'taxonomies'           => array('thegem_teams')
	);

	register_post_type('thegem_team_person', $args);

	$labels = array(
		'name'                       => __('Teams', 'thegem'),
		'singular_name'              => __('Team', 'thegem'),
		'search_items'               => __('Search Teams', 'thegem'),
		'popular_items'              => __('Popular Teams', 'thegem'),
		'all_items'                  => __('All Teams', 'thegem'),
		'edit_item'                  => __('Edit Team', 'thegem'),
		'update_item'                => __('Update Team', 'thegem'),
		'add_new_item'               => __('Add New Team', 'thegem'),
		'new_item_name'              => __('New Team Name', 'thegem'),
		'separate_items_with_commas' => __('Separate Teams with commas', 'thegem'),
		'add_or_remove_items'        => __('Add or remove Teams', 'thegem'),
		'choose_from_most_used'      => __('Choose from the most used Teams', 'thegem'),
		'not_found'                  => __('No teams found.', 'thegem'),
		'menu_name'                  => __('Teams', 'thegem'),
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

	register_taxonomy('thegem_teams', 'thegem_team_person', $args);
}
add_action('init', 'thegem_team_person_post_type_init');

/* PERSON POST META BOX */

function thegem_team_persons_register_meta_box($post) {
	add_meta_box('thegem_team_person_settings', __('Person Settings', 'thegem'), 'thegem_team_person_settings_box', 'thegem_team_person', 'normal', 'high');
}

function thegem_team_person_settings_box($post) {
	wp_nonce_field('thegem_team_person_settings_box', 'thegem_team_person_settings_box_nonce');
	$person_data = thegem_get_sanitize_team_person_data($post->ID);
?>
<p class="meta-options">
<table class="settings-box-table" width="100%"><tbody><tr>
	<td>
		<label for="person_name"><?php _e('Name', 'thegem'); ?>:</label><br />
		<input name="thegem_team_person_data[name]" type="text" id="person_name" value="<?php echo esc_attr($person_data['name']); ?>" /><br />
		<br />
		<label for="person_position"><?php _e('Position', 'thegem'); ?>:</label><br />
		<input name="thegem_team_person_data[position]" type="text" id="person_position" value="<?php echo esc_attr($person_data['position']); ?>" /><br />
		<br />
		<label for="person_phone"><?php _e('Phone', 'thegem'); ?>:</label><br />
		<input name="thegem_team_person_data[phone]" type="text" id="person_phone" value="<?php echo esc_attr($person_data['phone']); ?>" /><br />
		<br />
		<label for="person_email"><?php _e('Email', 'thegem'); ?>:</label><br />
		<input name="thegem_team_person_data[email]" type="email" id="person_email" value="<?php echo esc_attr($person_data['email']); ?>" /><br />
		<br />
		<input name="thegem_team_person_data[hide_email]" type="checkbox" id="person_hide_email" value="1" <?php checked($person_data['hide_email'], 1); ?> />
		<label for="person_hide_email"><?php _e('Hide Email', 'thegem'); ?></label><br />
		<br />
		<label for="person_link"><?php _e('Link', 'thegem'); ?>:</label><br />
		<input name="thegem_team_person_data[link]" type="text" id="person_link" value="<?php echo esc_attr($person_data['link']); ?>" /><br />
		<br />
		<label for="person_link_target"><?php _e('Link target', 'thegem'); ?>:</label><br />
		<?php thegem_print_select_input(array('_self' => 'Self', '_blank' => 'Blank'), $person_data['link_target'], 'thegem_team_person_data[link_target]', 'person_link_target'); ?>
	</td>
	<td>
		<?php foreach(thegem_team_person_socials_list() as $key => $value) : ?>
			<label for="person_social_link_<?php echo esc_attr($key); ?>"><?php echo $value; ?>:</label><br />
			<input name="thegem_team_person_data[social_link_<?php echo esc_attr($key); ?>]" type="text" id="person_social_link_<?php echo esc_attr($key); ?>" value="<?php echo esc_attr($person_data['social_link_'.$key]); ?>" /><br />
		<?php endforeach; ?>
	</td>
</tr></tbody></table>
</p>
<?php
}

function thegem_team_person_socials_list() {
	return (array)apply_filters('thegem_team_person_socials_list', array(
		'facebook' => __('Facebook'),
		'googleplus' => __('Google Plus'),
		'twitter' => __('Twitter'),
		'linkedin' => __('LinkedIn'),
		'instagram' => __('Instagram'),
		'skype' => __('Skype'),
	));
}

function thegem_team_person_save_meta_box_data($post_id) {
	if(!isset($_POST['thegem_team_person_settings_box_nonce'])) {
		return;
	}
	if(!wp_verify_nonce($_POST['thegem_team_person_settings_box_nonce'], 'thegem_team_person_settings_box')) {
		return;
	}
	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}

	if(isset($_POST['post_type']) && 'thegem_team_person' == $_POST['post_type']) {
		if(!current_user_can('edit_page', $post_id)) {
			return;
		}
	} else {
		if(!current_user_can('edit_post', $post_id)) {
			return;
		}
	}

	if(!isset($_POST['thegem_team_person_data']) || !is_array($_POST['thegem_team_person_data'])) {
		return;
	}

	$person_data = thegem_get_sanitize_team_person_data(0, $_POST['thegem_team_person_data']);
	$person_data['link_target'] = thegem_check_array_value(array('_blank', '_self'), $person_data['link_target'], '_self');

	update_post_meta($post_id, 'thegem_team_person_data', $person_data);
}
add_action('save_post', 'thegem_team_person_save_meta_box_data');

function thegem_get_sanitize_team_person_data($post_id = 0, $item_data = array()) {
	$person_data = array(
		'name' => '',
		'position' => '',
		'phone' => '',
		'email' => '',
		'hide_email' => false,
		'link' => '',
		'link_target' => ''
	);
	foreach(array_keys(thegem_team_person_socials_list()) as $social) {
		$person_data['social_link_'.$social] = '';
	}
	if(is_array($item_data) && !empty($item_data)) {
		$person_data = array_merge($item_data);
	} elseif($post_id != 0) {
		$person_data = thegem_get_post_data($person_data, 'team_person', $post_id);
	}
	$person_data['name'] = sanitize_text_field($person_data['name']);
	$person_data['position'] = sanitize_text_field($person_data['position']);
	$person_data['phone'] = sanitize_text_field($person_data['phone']);
	$person_data['email'] = sanitize_email($person_data['email']);
	$person_data['hide_email'] = $person_data['hide_email'] ? 1 : 0;
	$person_data['link'] = esc_url($person_data['link']);
	$person_data['link_target'] = thegem_check_array_value(array('_blank', '_self'), $person_data['link_target'], '_self');
	foreach(array_keys(thegem_team_person_socials_list()) as $social) {
		$person_data['social_link_'.$social] = esc_url($person_data['social_link_'.$social]);
	}
	return $person_data;
}