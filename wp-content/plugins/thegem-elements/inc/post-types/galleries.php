<?php

function thegem_galleries_post_type_init() {
	$labels = array(
		'name'               => __('Galleries', 'thegem'),
		'singular_name'      => __('Gallery', 'thegem'),
		'menu_name'          => __('Galleries', 'thegem'),
		'name_admin_bar'     => __('Gallery', 'thegem'),
		'add_new'            => __('Add New', 'thegem'),
		'add_new_item'       => __('Add New Gallery', 'thegem'),
		'new_item'           => __('New Gallery', 'thegem'),
		'edit_item'          => __('Edit Gallery', 'thegem'),
		'view_item'          => __('View Gallery', 'thegem'),
		'all_items'          => __('All Galleries', 'thegem'),
		'search_items'       => __('Search Galleries', 'thegem'),
		'not_found'          => __('No galleries found.', 'thegem'),
		'not_found_in_trash' => __('No galleries found in Trash.', 'thegem')
	);

	$args = array(
		'labels'               => $labels,
		'public'               => false,
		'exclude_from_search'  => true,
		'publicly_queryable'   => false,
		'show_ui'              => true,
		'query_var'            => false,
		'public'               => false,
		'hierarchical'         => false,
		'supports'             => array('title'),
		'register_meta_box_cb' => 'thegem_galleries_register_meta_box',
	);

	register_post_type('thegem_gallery', $args);
}
add_action('init', 'thegem_galleries_post_type_init');

/* GALLERY POST META BOX */

function thegem_galleries_register_meta_box($post) {
	add_meta_box('thegem_gallery_settings', sprintf(__('Gallery Manager (ID = %s)', 'thegem'), (isset($post->ID) ? $post->ID : 0)), 'thegem_gallery_settings_box', 'thegem_gallery', 'normal', 'high');
}

function thegem_gallery_settings_box($post) {
	wp_nonce_field('thegem_gallery_settings_box', 'thegem_gallery_settings_box_nonce');
	if(metadata_exists('post', $post->ID, 'thegem_gallery_images')) {
		$thegem_gallery_images_ids = get_post_meta($post->ID, 'thegem_gallery_images', true);
	} else {
		$attachments_ids = get_posts('post_parent=' . $post->ID . '&numberposts=-1&post_type=attachment&orderby=menu_order&order=ASC&post_mime_type=image&fields=ids');
		$thegem_gallery_images_ids = implode(',', $attachments_ids);
	}
	$attachments_ids = array_filter(explode(',', $thegem_gallery_images_ids));

	echo '<div id="gallery_manager">';
	echo '<input type="hidden" id="thegem_gallery_images" name="thegem_gallery_images" value="' . esc_attr($thegem_gallery_images_ids) . '" />';
	echo '<a id="upload_button" class="button" href="javascript:void(0);" style="font-size: 16px;">' . __('Add images','thegem') . '</a>';

	echo '<ul class="gallery-images">';
	if($attachments_ids) {
		foreach($attachments_ids as $attachment_id) {
			echo '<li class="image" data-attachment_id="' . esc_attr($attachment_id) . '"><a target="_blank" href="' . get_edit_post_link($attachment_id) . '" class="edit">' .wp_get_attachment_image($attachment_id, 'thumbnail') . '</a><a href="javascript:void(0);" class="remove">x</a></li>';
		}
	}
	echo '</ul><br class="clear" />';

	echo '</div>';
?>

<?php
}

function thegem_gallery_save_meta_box_data($post_id) {
	if(!isset($_POST['thegem_gallery_settings_box_nonce'])) {
		return;
	}
	if(!wp_verify_nonce($_POST['thegem_gallery_settings_box_nonce'], 'thegem_gallery_settings_box')) {
		return;
	}
	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}

	if(isset($_POST['post_type']) && 'thegem_gallery' == $_POST['post_type']) {
		if(!current_user_can('edit_page', $post_id)) {
			return;
		}
	} else {
		if(!current_user_can('edit_post', $post_id)) {
			return;
		}
	}

	if(!isset($_POST['thegem_gallery_images'])) {
		return;
	}

	update_post_meta($post_id, 'thegem_gallery_images', $_POST['thegem_gallery_images']);
}
add_action('save_post', 'thegem_gallery_save_meta_box_data');

function thegem_galleries_array() {
	$galleries_posts = get_posts(array(
		'post_type' => 'thegem_gallery',
		'posts_per_page' => -1,
		'orderby' => 'title',
		'order' => 'ASC',
	));
	$galleries = array();
	foreach($galleries_posts as $gallery) {
		$galleries[$gallery->ID] = $gallery->post_title.' (ID='.$gallery->ID.')';
	}
	return $galleries;
}