<?php

function thegem_clients_post_type_init() {
	$labels = array(
		'name'               => __('Clients', 'thegem'),
		'singular_name'      => __('Client', 'thegem'),
		'menu_name'          => __('Clients', 'thegem'),
		'name_admin_bar'     => __('Client', 'thegem'),
		'add_new'            => __('Add New', 'thegem'),
		'add_new_item'       => __('Add New Client', 'thegem'),
		'new_item'           => __('New Client', 'thegem'),
		'edit_item'          => __('Edit Client', 'thegem'),
		'view_item'          => __('View Client', 'thegem'),
		'all_items'          => __('All Clients', 'thegem'),
		'search_items'       => __('Search Clients', 'thegem'),
		'not_found'          => __('No clients found.', 'thegem'),
		'not_found_in_trash' => __('No clients found in Trash.', 'thegem')
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
		'register_meta_box_cb' => 'thegem_clients_register_meta_box',
		'taxonomies'           => array('thegem_clients_sets')
	);

	register_post_type('thegem_client', $args);

	$labels = array(
		'name'                       => __('Clients Sets', 'thegem'),
		'singular_name'              => __('Clients Set', 'thegem'),
		'search_items'               => __('Search Clients Sets', 'thegem'),
		'popular_items'              => __('Popular Clients Sets', 'thegem'),
		'all_items'                  => __('All Clients Sets', 'thegem'),
		'edit_item'                  => __('Edit Clients Set', 'thegem'),
		'update_item'                => __('Update Clients Set', 'thegem'),
		'add_new_item'               => __('Add New Clients Set', 'thegem'),
		'new_item_name'              => __('New Clients Set Name', 'thegem'),
		'separate_items_with_commas' => __('Separate Clients Sets with commas', 'thegem'),
		'add_or_remove_items'        => __('Add or remove Clients Sets', 'thegem'),
		'choose_from_most_used'      => __('Choose from the most used Clients Sets', 'thegem'),
		'not_found'                  => __('No clients sets found.', 'thegem'),
		'menu_name'                  => __('Clients Sets', 'thegem'),
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

	register_taxonomy('thegem_clients_sets', 'thegem_client', $args);
}
add_action('init', 'thegem_clients_post_type_init');

/* CLIENT POST META BOX */

function thegem_clients_register_meta_box($post) {
	remove_meta_box('postimagediv', 'thegem_client', 'side');
	add_meta_box('postimagediv', __('Client Image', 'thegem'), 'post_thumbnail_meta_box', 'thegem_client', 'normal', 'high');
	add_meta_box('thegem_client_settings', __('Client Settings', 'thegem'), 'thegem_client_settings_box', 'thegem_client', 'normal', 'high');
}

function thegem_client_settings_box($post) {
	wp_nonce_field('thegem_client_settings_box', 'thegem_client_settings_box_nonce');
	$client_data = thegem_get_sanitize_client_data($post->ID);
?>
<p class="meta-options">

	<label for="client_link"><?php _e('Link', 'thegem'); ?>:</label><br />
	<input name="thegem_client_data[link]" type="text" id="client_link" value="<?php echo esc_attr($client_data['link']); ?>" size="60" /><br />
	<br />
	<label for="client_link_target"><?php _e('Link target', 'thegem'); ?>:</label><br />
	<?php thegem_print_select_input(array('_blank' => 'Blank', '_self' => 'Self'), $client_data['link_target'], 'thegem_client_data[link_target]', 'client_link_target'); ?>
</p>
<?php
}

function thegem_client_save_meta_box_data($post_id) {
	if(!isset($_POST['thegem_client_settings_box_nonce'])) {
		return;
	}
	if(!wp_verify_nonce($_POST['thegem_client_settings_box_nonce'], 'thegem_client_settings_box')) {
		return;
	}
	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}

	if(isset($_POST['post_type']) && 'thegem_client' == $_POST['post_type']) {
		if(!current_user_can('edit_page', $post_id)) {
			return;
		}
	} else {
		if(!current_user_can('edit_post', $post_id)) {
			return;
		}
	}

	if(!isset($_POST['thegem_client_data']) || !is_array($_POST['thegem_client_data'])) {
		return;
	}

	$client_data = thegem_get_sanitize_client_data(0, $_POST['thegem_client_data']);
	update_post_meta($post_id, 'thegem_client_data', $client_data);
}
add_action('save_post', 'thegem_client_save_meta_box_data');

function thegem_get_sanitize_client_data($post_id = 0, $item_data = array()) {
	$client_data = array(
		'description' => '',
		'link' => '',
		'link_target' => ''
	);
	if(is_array($item_data) && !empty($item_data)) {
		$client_data = array_merge($item_data);
	} elseif($post_id != 0) {
		$client_data = thegem_get_post_data($client_data, 'client', $post_id);
	}
	$client_data['description'] = sanitize_text_field($client_data['description']);
	$client_data['link'] = esc_url($client_data['link']);
	$client_data['link_target'] = thegem_check_array_value(array('_blank', '_self'), $client_data['link_target'], '_blank');
	return $client_data;
}

/* CLIENTS SET OPTIONS */

function thegem_clients_sets_add_form_fields_callback() {
?>
	<div class="form-field">
		<label for="clients_set_icon"><?php _e('Icon', 'thegem'); ?></label>
		<input class= "icon" type="text" id="clients_set_icon" name="clients_set_icon"/><br/>
		<?php _e('Enter icon code', 'thegem'); ?>. <a href="<?php echo thegem_user_icons_info_link(); ?>" onclick="tb_show('<?php _e('Icons info', 'thegem'); ?>', this.href+'?TB_iframe=true'); return false;"><?php _e('Show Icon Codes', 'thegem'); ?></a>
	</div>
<?php
}
add_action('thegem_clients_sets_add_form_fields','thegem_clients_sets_add_form_fields_callback');

function thegem_clients_sets_edit_form_fields_callback() {
?>
	<tr class="form-field">
		<th valign="top" scope="row"><label for="clients_set_icon"><?php _e('Icon', 'thegem'); ?></label></th>
		<td>
			<input class= "icon" type="text" id="clients_set_icon" name="clients_set_icon" value="<?php echo esc_attr(get_option('thegem_clients_set_' . $_REQUEST['tag_ID'] . '_icon')); ?>"/><br />
			<span class="description"><?php _e('Enter icon code', 'thegem'); ?>. <a href="<?php echo thegem_user_icons_info_link(); ?>" onclick="tb_show('<?php _e('Icons info', 'thegem'); ?>', this.href+'?TB_iframe=true'); return false;"><?php _e('Show Icon Codes', 'thegem'); ?></a></span>
		</td>
	</tr>
<?php
}
add_action('thegem_clients_sets_edit_form_fields','thegem_clients_sets_edit_form_fields_callback');

function thegem_clients_sets_create_callback($id) {
	if(isset($_REQUEST['clients_set_icon'])) {
		update_option('thegem_clients_set_' . $id . '_icon', $_REQUEST['clients_set_icon']);
	}
}
add_action('create_thegem_clients_sets','thegem_clients_sets_create_callback');

function thegem_clients_sets_update_callback($id) {
	if(isset($_REQUEST['clients_set_icon'])) {
		update_option('thegem_clients_set_' . $id . '_icon', $_REQUEST['clients_set_icon']);
	}
}
add_action('edit_thegem_clients_sets','thegem_clients_sets_update_callback');

function thegem_clients_sets_delete_callback($id) {
	delete_option('thegem_clients_set_' . $id . '_icon');
}
add_action('delete_thegem_clients_sets','thegem_clients_sets_delete_callback');