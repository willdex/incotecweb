<?php

function thegem_woocommerce_scripts() {
	if(thegem_is_plugin_active('woocommerce/woocommerce.php')) {
		wp_enqueue_style('thegem-woocommerce', get_template_directory_uri() . '/css/thegem-woocommerce.css');
		wp_enqueue_style('thegem-woocommerce1', get_template_directory_uri() . '/css/thegem-woocommerce1.css');
		wp_enqueue_style('thegem-woocommerce-temp', get_template_directory_uri() . '/css/thegem-woocommerce-temp.css');
		wp_enqueue_style('thegem-woocommerce-custom', get_template_directory_uri() . '/css/thegem-woocommerce-custom.css');
		wp_register_script('thegem-checkout', get_template_directory_uri() . '/js/thegem-checkout.js', array('jquery'));
		wp_register_script('thegem-woocommerce', get_template_directory_uri() . '/js/thegem-woocommerce.js', array('jquery'), '', true);

		if(is_woocommerce()) {
			wp_enqueue_script('thegem-woocommerce');
		}
	}
}
add_action('wp_enqueue_scripts', 'thegem_woocommerce_scripts');

add_action('add_meta_boxes', 'thegem_add_product_settings_boxes');
function thegem_add_product_settings_boxes() {
	add_meta_box('thegem_product_description_meta_box', esc_html__('Product Description', 'thegem'), 'thegem_product_description_settings_box', 'product', 'normal', 'high');
	add_meta_box('thegem_product_hover_meta_box', esc_html__('Product Hover', 'thegem'), 'thegem_product_hover_settings_box', 'product', 'side', 'high');
}

function thegem_product_description_settings_box($post) {
	wp_nonce_field('thegem_product_description_settings_box', 'thegem_product_description_settings_box_nonce');
	$product_description = get_post_meta($post->ID, 'thegem_product_description', true);
?>
<div class="inside">
	<?php wp_editor(htmlspecialchars_decode($product_description), 'thegem_product_description', array(
			'textarea_name' => 'thegem_product_description',
			'quicktags' => array('buttons' => 'em,strong,link'),
			'tinymce' => array(
				'theme_advanced_buttons1' => 'bold,italic,strikethrough,separator,bullist,numlist,separator,blockquote,separator,justifyleft,justifycenter,justifyright,separator,link,unlink,separator,undo,redo,separator',
				'theme_advanced_buttons2' => '',
			),
			'editor_css' => '<style>#wp-excerpt-editor-container .wp-editor-area{height:175px; width:100%;}</style>'
		)); ?>
</div>
<?php
}
function thegem_product_hover_settings_box($post) {
	wp_nonce_field('thegem_product_hover_settings_box', 'thegem_product_hover_settings_box_nonce');
	$product_hover = get_post_meta($post->ID, 'thegem_product_disable_hover', true);
?>
<div class="inside">
	<input name="thegem_product_disable_hover" type="checkbox" id="thegem_product_disable_hover" value="1" <?php checked($product_hover, 1); ?> />
	<label for="thegem_product_disable_hover"><?php esc_html_e('Disable hover with alternative product image', 'thegem'); ?></label>
</div>
<?php
}

function thegem_save_product_data($post_id) {
	if(!isset($_POST['thegem_product_description_settings_box_nonce']) || !isset($_POST['thegem_product_hover_settings_box_nonce'])) {
		return;
	}
	if(!wp_verify_nonce($_POST['thegem_product_description_settings_box_nonce'], 'thegem_product_description_settings_box') || !wp_verify_nonce($_POST['thegem_product_hover_settings_box_nonce'], 'thegem_product_hover_settings_box')) {
		return;
	}

	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}

	if(isset($_POST['post_type']) && $_POST['post_type'] == 'product') {
		if(!current_user_can('edit_page', $post_id)) {
			return;
		}
	} else {
		if(!current_user_can('edit_post', $post_id)) {
			return;
		}
	}
	if(isset($_POST['thegem_product_description'])) {
		update_post_meta($post_id, 'thegem_product_description', $_POST['thegem_product_description']);
	}

	if(isset($_POST['thegem_product_disable_hover'])) {
		update_post_meta($post_id, 'thegem_product_disable_hover', $_POST['thegem_product_disable_hover']);
	}
}
add_action('save_post', 'thegem_save_product_data');

add_filter('woocommerce_enqueue_styles', '__return_false');

function thegem_loop_shop_columns($count) {
	$item_data = array(
		'sidebar_position' => '',
	);
	$item_data = thegem_get_post_data($item_data, 'page', wc_get_page_id('shop'));
	$sidebar_position = thegem_check_array_value(array('', 'left', 'right'), $item_data['sidebar_position'], '');
	if(is_active_sidebar('shop-sidebar') && $sidebar_position) {
		return 3;
	}
	return 4;
}
add_filter('loop_shop_columns', 'thegem_loop_shop_columns');

function thegem_woocommerce_single_product_gallery() {
	global $post, $product;
	wp_enqueue_script('thegem-gallery');
	$attachments_ids = $product->get_gallery_image_ids();
	if('variable' === $product->get_type()) {
		foreach($product->get_available_variations() as $variation) {
			if(has_post_thumbnail($variation['variation_id'])) {
				$thumbnail_id = get_post_thumbnail_id($variation['variation_id']);
				if(!in_array($thumbnail_id, $attachments_ids)) {
					$attachments_ids[] = $thumbnail_id;
				}
			}
		}
	}
	if(empty($attachments_ids) && has_post_thumbnail()) {
		$attachments_ids[] = get_post_thumbnail_id();
	}
	if(empty($attachments_ids)) return ;
	echo '<div class="preloader"><div class="preloader-spin"></div></div>';
	echo '<div class="gem-gallery gem-gallery-hover-default">';
	foreach($attachments_ids as $attachments_id) {
		$thumb_image_url = wp_get_attachment_image_src($attachments_id, apply_filters('single_product_small_thumbnail_size', 'shop_thumbnail'));
		$preview_image_url = wp_get_attachment_image_src($attachments_id, apply_filters('single_product_large_thumbnail_size', 'shop_single'));
		$full_image_url = wp_get_attachment_image_src($attachments_id, 'full');
		?>
<div class="gem-gallery-item">
	<div class="gem-gallery-item-image">
		<a href="<?php echo esc_url($preview_image_url[0]); ?>" data-full-image-url="<?php echo esc_url($full_image_url[0]); ?>">
			<svg width="20" height="10"><path d="M 0,10 Q 9,9 10,0 Q 11,9 20,10" /></svg>
			<img src="<?php echo esc_url($thumb_image_url[0]); ?>" alt="" class="img-responsive">
		</a>
	</div>
</div>
<?php
	}
	echo '</div>';
}

function thegem_woocommerce_single_product_page_content() {
	$vc_show_content = false;
	if(thegem_is_plugin_active('js_composer/js_composer.php')) {
		global $vc_manager;
		if($vc_manager->mode() == 'admin_frontend_editor' || $vc_manager->mode() == 'admin_page' || $vc_manager->mode()== 'page_editable') {
			$vc_show_content = true;
		}
	}
	if(get_the_content() || $vc_show_content) {
?>
<div class="product-content entry-content"><?php the_content(); ?></div>
<?php
	}
}

function thegem_woocommerce_output_related_products_args($args) {
	$args['posts_per_page'] = 6;
	$args['columns'] = 6;
	return $args;
}
add_filter('woocommerce_output_related_products_args', 'thegem_woocommerce_output_related_products_args');

function thegem_loop_shop_per_page() {
	$pc = !empty($_REQUEST['product_count']) && intval($_REQUEST['product_count']) > 0 ? intval($_REQUEST['product_count']) : 12;
	return $pc;
}
add_filter('loop_shop_per_page', 'thegem_loop_shop_per_page', 15);

function thegem_woocommerce_product_per_page_select() {
	$products_per_page_items = array(12,24,48);
	$pc = !empty($_REQUEST['product_count']) && intval($_REQUEST['product_count']) > 0 ? intval($_REQUEST['product_count']) : 12;
?>
<div class="woocommerce-select-count">
	<select id="products-per-page" name="products_per_page" class="gem-combobox" onchange="window.location.href=jQuery(this).val();">
		<?php foreach($products_per_page_items as $products_per_page_item) : ?>
			<option value="<?php echo esc_url(add_query_arg('product_count', $products_per_page_item)); ?>" <?php selected($pc, $products_per_page_item); ?>><?php printf(esc_html__('Show %d On Page', 'thegem'), $products_per_page_item); ?></option>
		<?php endforeach; ?>
	</select>
</div>
<?php
}

function thegem_woocommerce_before_shop_content() {
	echo '<div class="products-list">';
}
function thegem_woocommerce_after_shop_content() {
	echo '</div><!-- .products-list -->';
}

function thegem_woocommerce_before_shop_loop_start() {
	echo '<div class="before-products-list rounded-corners clearfix">';
}
function thegem_woocommerce_before_shop_loop_end() {
	echo '</div>';
}
function thegem_woocommerce_single_product_navigation() {
?>
<div class="block-navigation">
	<?php if($post = get_previous_post()) : ?>
		<div class="block-product-navigation-prev">
			<?php thegem_button(array(
				'text' => __('Prev', 'thegem'),
				'href' => get_permalink($post->ID),
				'style' => 'outline',
				'size' => 'tiny',
				'position' => 'left',
				'icon' => 'prev',
				'border_color' => thegem_get_option('button_background_basic_color'),
				'text_color' => thegem_get_option('button_background_basic_color'),
				'hover_background_color' => thegem_get_option('button_background_basic_color'),
				'hover_text_color' => thegem_get_option('button_outline_text_hover_color'),
			), 1); ?>
		</div>
	<?php endif; ?>
	<?php if($post = get_next_post()) : ?>
		<div class="block-product-navigation-next">
			<?php thegem_button(array(
				'text' => __('Next', 'thegem'),
				'href' => get_permalink($post->ID),
				'style' => 'outline',
				'size' => 'tiny',
				'position' => 'right',
				'icon' => 'next',
				'icon_position' => 'right',
				'border_color' => thegem_get_option('button_background_basic_color'),
				'text_color' => thegem_get_option('button_background_basic_color'),
				'hover_background_color' => thegem_get_option('button_background_basic_color'),
				'hover_text_color' => thegem_get_option('button_outline_text_hover_color'),
			), 1); ?>
		</div>
	<?php endif; ?>
</div><!-- .block-product-navigation-prev -->
<?php
}

function thegem_woocommerce_show_product_loop_featured_flash() {
	global $post, $product;
	if($product->is_featured()) {
		echo apply_filters('woocommerce_featured_flash', '<span class="new-label title-h6">' . esc_html__( 'New', 'thegem' ) . '</span>', $post, $product);
	}
}

function thegem_woocommerce_after_shop_loop_item_link() {
	global $post, $product;
	echo '<a href="'.esc_url(get_the_permalink()).'" class="bottom-product-link"></a>';
}

function thegem_woocommerce_single_variation_add_to_cart_button() {
	global $product;
	?>
	<div class="variations_button">
		<?php woocommerce_quantity_input( array( 'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : 1 ) ); ?>
		<?php thegem_button(array(
			'tag' => 'button',
			'text' => esc_html($product->single_add_to_cart_text()),
			'icon' => 'cart',
			'background_color' => thegem_get_option('styled_elements_color_1'),
			'attributes' => array('type' => 'submit', 'class' => 'single_add_to_cart_button button alt'),
		), 1); ?>
		<?php do_action('thegem_woocommerce_after_add_to_cart_button'); ?>
		<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
		<input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
		<input type="hidden" name="variation_id" class="variation_id" value="" />
	</div>
	<?php
}

function thegem_woocommerce_back_to_shop_button() {
	thegem_button(array(
		'href' => get_permalink(wc_get_page_id('shop')),
		'style' => 'outline',
		'size' => 'tiny',
		'position' => 'right',
		'icon' => 'prev',
		'border_color' => thegem_get_option('button_background_basic_color'),
		'text_color' => thegem_get_option('button_background_basic_color'),
		'hover_background_color' => thegem_get_option('button_background_basic_color'),
		'hover_text_color' => thegem_get_option('button_outline_text_hover_color'),
		'extra_class' => 'back-to-shop-button'
	), 1);
}

function thegem_woocommerce_rating_separator() {
	echo '<div class="rating-divider"></div>';
}

function thegem_woocommerce_size_guide() {
	global $product;
	$product_size_guide_data = thegem_get_sanitize_product_size_guide_data($product->get_id());
	$size_guide_image = thegem_get_option('size_guide_image');
	if($product_size_guide_data['disable']) {
		$size_guide_image = '';
	} elseif($product_size_guide_data['custom'] && $product_size_guide_data['custom_image']) {
		$size_guide_image = $product_size_guide_data['custom_image'];
	}
?>
	<?php if($size_guide_image) : ?>
		<div class="size-guide"><a href="<?php echo esc_url($size_guide_image); ?>" class="fancybox"><?php esc_html_e('Size guide', 'thegem'); ?></a></div>
	<?php endif; ?>
<?php
}

function thegem_yith_wcwl_add_to_wishlist_button() {
	global $product;

	if( ! isset( $product ) ){
		$product = ( isset( $atts['product_id'] ) ) ? wc_get_product( $atts['product_id'] ) : false;
	}

	$label_option = get_option( 'yith_wcwl_add_to_wishlist_text' );
	$label = apply_filters( 'yith_wcwl_button_label', $label_option );
	$browse_wishlist = get_option( 'yith_wcwl_browse_wishlist_text' );

	$default_wishlists = is_user_logged_in() ? YITH_WCWL()->get_wishlists( array( 'is_default' => true ) ) : false;

	if( ! empty( $default_wishlists ) ){
		$default_wishlist = $default_wishlists[0]['ID'];
	}
	else{
		$default_wishlist = false;
	}

	$exists = YITH_WCWL()->is_product_in_wishlist( $product->get_id(), $default_wishlist );

	$wishlist_url = YITH_WCWL()->get_wishlist_url();
	$product_type = $product->get_type();

	$disable_wishlist = false;
	$available_multi_wishlist = false;
?>

<div class="yith-wcwl-add-to-wishlist add-to-wishlist-<?php echo esc_attr($product->get_id()); ?>">
	<?php if(!($disable_wishlist && ! is_user_logged_in())): ?>
		<?php
			thegem_button(array(
				'style' => 'outline',
				'text' => $label,
				'href' => esc_url(add_query_arg('add_to_wishlist', $product->get_id())),
				'text_color' => thegem_get_option('button_background_basic_color'),
				'border_color' => thegem_get_option('button_background_basic_color'),
				'hover_text_color' => thegem_get_option('button_outline_text_hover_color'),
				'hover_background_color' => thegem_get_option('button_background_basic_color'),
				'hover_border_color' => thegem_get_option('button_background_basic_color'),
				'icon' => 'add-to-wishlist',
				'attributes' => array(
					'data-product-type' => $product_type,
					'data-product-id' => $product->get_id(),
					'rel' => 'nofollow',
					'class' => 'add_to_wishlist',
				),
				'extra_class' => 'yith-wcwl-add-button '.(($exists && ! $available_multi_wishlist) ? 'hide': 'show'),
			),1);
		?>

		<?php
			thegem_button(array(
				'style' => 'outline',
				'text' => apply_filters('yith-wcwl-browse-wishlist-label', $browse_wishlist),
				'href' => esc_url($wishlist_url),
				'text_color' => thegem_get_option('button_background_basic_color'),
				'border_color' => thegem_get_option('button_background_basic_color'),
				'hover_text_color' => thegem_get_option('button_outline_text_hover_color'),
				'hover_background_color' => thegem_get_option('button_background_basic_color'),
				'hover_border_color' => thegem_get_option('button_background_basic_color'),
				'icon' => 'browse-wishlist',
				'attributes' => array(
					'rel' => 'nofollow',
				),
				'extra_class' => 'yith-wcwl-wishlistaddedbrowse hide',
			),1);
		?>

		<?php
			thegem_button(array(
				'style' => 'outline',
				'text' => apply_filters('yith-wcwl-browse-wishlist-label', $browse_wishlist),
				'href' => esc_url($wishlist_url),
				'text_color' => thegem_get_option('button_background_basic_color'),
				'border_color' => thegem_get_option('button_background_basic_color'),
				'hover_text_color' => thegem_get_option('button_outline_text_hover_color'),
				'hover_background_color' => thegem_get_option('button_background_basic_color'),
				'hover_border_color' => thegem_get_option('button_background_basic_color'),
				'icon' => 'browse-wishlist',
				'attributes' => array(
					'rel' => 'nofollow',
				),
				'extra_class' => 'yith-wcwl-wishlistexistsbrowse '.(($exists && ! $available_multi_wishlist) ? 'show' : 'hide'),
			),1);
		?>
		<div class="yith-wcwl-wishlistaddresponse"></div>
	<?php else: ?>
		<?php
			thegem_button(array(
				'style' => 'outline',
				'text' => $label,
				'href' => esc_url(add_query_arg(array('wishlist_notice' => 'true', 'add_to_wishlist' => $product->get_id()), get_permalink(wc_get_page_id('myaccount')))),
				'text_color' => thegem_get_option('button_background_basic_color'),
				'border_color' => thegem_get_option('button_background_basic_color'),
				'hover_text_color' => thegem_get_option('button_outline_text_hover_color'),
				'hover_background_color' => thegem_get_option('button_background_basic_color'),
				'hover_border_color' => thegem_get_option('button_background_basic_color'),
				'icon' => 'wishlist',
				'attributes' => array(
					'data-product-type' => $product_type,
					'rel' => 'nofollow',
					'class' => 'add_to_wishlist',
				),
				'extra_class' => 'yith-wcwl-add-button '.(($exists && !$available_multi_wishlist) ? 'hide': 'show'),
			),1);
		?>
	<?php endif; ?>

</div>
<?php
}

function thegem_woocommerce_template_loop_product_hover_thumbnail() {
	global $post, $product;
	$gallery = $product->get_gallery_image_ids();
	$product_hover = get_post_meta($post->ID, 'thegem_product_disable_hover', true);
	$output = '<span class="woo-product-overlay"></span>';
	if(isset($gallery[0]) && !$product_hover) {
		$image = wp_get_attachment_image($gallery[0], 'shop_catalog', false, array( 'class' => 'attachment-$size woo-product-hover'));
		if(!empty($image)) $output = $image;
	}
	echo $output;
}

function thegem_woocommerce_template_loop_category_title($category) {
	echo '<div class="category-overlay">';
	echo '<h6 class="category-title">'.$category->name.'</h6>';
	echo '<div class="category-overlay-separator"></div>';
	echo '<div class="category-count">'.sprintf(esc_html(_n('%s item', '%s items', $category->count, 'thegem')), $category->count).'</div>';
	echo '</div>';
}

remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 10 );
add_action( 'woocommerce_after_shop_loop', 'thegem_woocommerce_after_shop_content', 15);
add_action( 'woocommerce_after_shop_loop', 'woocommerce_taxonomy_archive_description', 15 );
add_action( 'woocommerce_after_shop_loop', 'woocommerce_product_archive_description', 15 );

remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );

remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
add_action('woocommerce_before_shop_loop', 'thegem_woocommerce_before_shop_content', 4);
add_action('woocommerce_before_shop_loop', 'thegem_woocommerce_before_shop_loop_start', 5);
add_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 10);
add_action('woocommerce_before_shop_loop', 'woocommerce_breadcrumb', 20);
add_action('woocommerce_before_shop_loop', 'thegem_woocommerce_product_per_page_select', 30);
add_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 40);
add_action('woocommerce_before_shop_loop', 'thegem_woocommerce_before_shop_loop_end', 45);

remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
add_action('woocommerce_shop_loop_item_labels', 'woocommerce_show_product_loop_sale_flash', 5);
add_action('woocommerce_shop_loop_item_labels', 'thegem_woocommerce_show_product_loop_featured_flash', 10);
add_action('woocommerce_shop_loop_item_image', 'woocommerce_template_loop_product_thumbnail', 10);
add_action('woocommerce_shop_loop_item_image', 'thegem_woocommerce_template_loop_product_hover_thumbnail', 15);
add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);

add_action('woocommerce_after_shop_loop_item', 'thegem_woocommerce_after_shop_loop_item_link', 15);
if(function_exists('thegem_is_plugin_active') && thegem_is_plugin_active('yith-woocommerce-wishlist/init.php')) {
	add_action('woocommerce_after_shop_loop_item', create_function('', 'echo do_shortcode( "[yith_wcwl_add_to_wishlist]" );'), 20);
}

add_action('thegem_woocommerce_single_product_left', 'thegem_woocommerce_single_product_gallery', 5);
add_action('thegem_woocommerce_single_product_left', 'thegem_socials_sharing', 10);
add_action('thegem_woocommerce_single_product_left', 'woocommerce_template_single_meta', 15);

add_action('thegem_woocommerce_single_product_right', 'thegem_woocommerce_back_to_shop_button', 5);
add_action('thegem_woocommerce_single_product_right', 'woocommerce_template_single_title', 10);
add_action('thegem_woocommerce_single_product_right', 'woocommerce_breadcrumb', 15);
add_action('thegem_woocommerce_single_product_right', 'woocommerce_template_single_rating', 20);
add_action('thegem_woocommerce_single_product_right', 'thegem_woocommerce_rating_separator', 25);
add_action('thegem_woocommerce_single_product_right', 'woocommerce_template_single_price', 30);
add_action('thegem_woocommerce_single_product_right', 'woocommerce_template_single_excerpt', 35);
add_action('thegem_woocommerce_single_product_right', 'woocommerce_template_single_add_to_cart', 45);
add_action('thegem_woocommerce_single_product_right', 'thegem_woocommerce_size_guide', 50);

if(function_exists('thegem_is_plugin_active') && thegem_is_plugin_active('yith-woocommerce-wishlist/init.php')) {
	add_action('thegem_woocommerce_after_add_to_cart_button', 'thegem_yith_wcwl_add_to_wishlist_button');
}

remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20 );
add_action( 'woocommerce_single_variation', 'thegem_woocommerce_single_variation_add_to_cart_button', 20 );

add_action('thegem_woocommerce_single_product_bottom', 'woocommerce_output_product_data_tabs', 5);
add_action('thegem_woocommerce_single_product_bottom', 'thegem_woocommerce_single_product_navigation', 10);
add_action('thegem_woocommerce_single_product_bottom', 'thegem_woocommerce_single_product_page_content', 15);

add_action('thegem_woocommerce_after_single_product', 'woocommerce_output_related_products', 5);

remove_action( 'woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10 );
add_action( 'woocommerce_shop_loop_subcategory_title', 'thegem_woocommerce_template_loop_category_title', 10 );


function thegem_cart_menu($items, $args) {
	if(thegem_is_plugin_active('woocommerce/woocommerce.php') && $args->theme_location == 'primary' && thegem_get_option('header_layout') !== 'overlay') {
		global $woocommerce;

		$count = sizeof(WC()->cart->get_cart());

		ob_start();
		woocommerce_mini_cart();
		$minicart = ob_get_clean();
		$items .= '<li class="menu-item menu-item-cart"><a href="'.esc_url(get_permalink(wc_get_page_id('cart'))).'" class="minicart-menu-link ' . ($count == 0 ? 'empty' : '') . '">' . '<span class="minicart-item-count">' . $count . '</span>' . '</a><div class="minicart"><div class="widget_shopping_cart_content">'.$minicart.'</div></div></li>';
	}
	return $items;
}
add_filter('wp_nav_menu_items', 'thegem_cart_menu', 11, 2);

function thegem_woocommerce_placeholder_img($val, $size, $dimensions) {
	return '<span class="product-dummy-wrapper" style="max-width: '.$dimensions['width'].'px;"><span class="product-dummy" style="padding-bottom: '.($dimensions['height']*100/$dimensions['width']).'%;"></span></span>';
}
add_filter('woocommerce_placeholder_img', 'thegem_woocommerce_placeholder_img', 10, 3);

function thegem_cart_short_info() {
	global $woocommerce;
	echo '<div class="cart-short-info">'.sprintf(wp_kses(__('You Have <span class="items-count">%d Items</span> In Your Cart', 'thegem'), array('span' => array('class' => array()))), $woocommerce->cart->cart_contents_count).'</div>';
}
add_action('woocommerce_before_cart', 'thegem_cart_short_info', 5);
add_action('woocommerce_before_cart', 'woocommerce_breadcrumb', 10);

function thegem_wc_add_to_cart_message($message, $product_id) {
	$titles = array();

	if ( is_array( $product_id ) ) {
		foreach ( $product_id as $id ) {
			$titles[] = get_the_title( $id );
		}
	} else {
		$titles[] = get_the_title( $product_id );
	}

	$titles = array_filter( $titles );
	$added_text = sprintf( _n( '%s has been added to your cart.', '%s have been added to your cart.', sizeof( $titles ), 'woocommerce' ), wc_format_list_of_items( $titles ) );

	// Output success messages
	if(get_option('woocommerce_cart_redirect_after_add') == 'yes') :

		$return_to = apply_filters( 'woocommerce_continue_shopping_redirect', wc_get_raw_referer() ? wp_validate_redirect( wc_get_raw_referer(), false ) : wc_get_page_permalink( 'shop' ) );

		$message = sprintf('<div class="cart-added"><div class="cart-added-text">%s</div><div class="cart-added-button"><a href="%s" class="gem-button button wc-forward">%s</a></div></div>', $added_text, esc_url($return_to), esc_html__('Continue Shopping', 'woocommerce'));

	else :

		$message = sprintf('<div class="cart-added"><div class="cart-added-text">%s</div><div class="cart-added-button"><a href="%s" class="gem-button button wc-forward">%s</a></div></div>', $added_text, esc_url(get_permalink(wc_get_page_id('cart'))), esc_html__('View Cart', 'woocommerce'));

	endif;

	return $message;
}
add_filter('wc_add_to_cart_message_html', 'thegem_wc_add_to_cart_message', 10, 2);

function thegem_product_add_page_settings_boxes() {
	add_meta_box('thegem_page_title', esc_html__('Page Title', 'thegem'), 'thegem_page_title_settings_box', 'product', 'normal', 'high');
	add_meta_box('thegem_page_sidebar', esc_html__('Page Sidebar', 'thegem'), 'thegem_page_sidebar_settings_box', 'product', 'normal', 'high');
}
add_action('add_meta_boxes', 'thegem_product_add_page_settings_boxes');

function thegem_save_product_page_data($post_id) {
	if(
		!isset($_POST['thegem_page_title_settings_box_nonce']) ||
		!isset($_POST['thegem_page_sidebar_settings_box_nonce'])
	) {
		return;
	}
	if(
		!wp_verify_nonce($_POST['thegem_page_title_settings_box_nonce'], 'thegem_page_title_settings_box') ||
		!wp_verify_nonce($_POST['thegem_page_sidebar_settings_box_nonce'], 'thegem_page_sidebar_settings_box')
	) {
		return;
	}

	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}

	if(isset($_POST['post_type']) && in_array($_POST['post_type'], array('product'))) {
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
		thegem_get_sanitize_page_sidebar_data(0, $_POST['thegem_page_data'])
	);
	update_post_meta($post_id, 'thegem_page_data', $page_data);
}
add_action('save_post', 'thegem_save_product_page_data');


function thegem_product_tabs($tabs = array()) {
		global $product, $post;
		// Description tab - shows product content
		if (get_post_meta($post->ID, 'thegem_product_description', true)) {
			$tabs['description'] = array(
				'title'	=> esc_html__( 'Description', 'woocommerce' ),
				'priority' => 10,
				'callback' => 'woocommerce_product_description_tab'
			);
		} elseif(isset($tabs['description'])) {
			unset($tabs['description']);
		}

		return $tabs;
}
add_filter('woocommerce_product_tabs', 'thegem_product_tabs', 11);

function thegem_woocommerce_subcategory_thumbnail( $category ) {
	$small_thumbnail_size = apply_filters( 'single_category_small_thumbnail_size', 'shop_catalog' );
	$thumbnail_id = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true);
	$image = '';

	if ( $thumbnail_id ) {
		$image = wp_get_attachment_image_src( $thumbnail_id, $small_thumbnail_size );
	}

	if ( $image ) {
		$image[0] = str_replace( ' ', '%20', $image[0] );
		echo '<img src="' . esc_url( $image[0] ) . '" width="'.esc_attr($image[1]).'" height="'.esc_attr($image[2]).'" alt="' . esc_attr( $category->name ) . '" class="img-responsive" />';
	} else {
		echo wc_placeholder_img($small_thumbnail_size);
	}
}
remove_action('woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10);
add_action('woocommerce_before_subcategory_title', 'thegem_woocommerce_subcategory_thumbnail', 10);

add_filter('add_to_cart_fragments', 'gem_woocommerce_header_dropdown_cart_fragment');

function gem_woocommerce_header_dropdown_cart_fragment( $fragments ) {
	global $woocommerce;

	$count = sizeof(WC()->cart->get_cart());
	$fragments['a.minicart-menu-link'] = '<a href="'.esc_url(get_permalink(wc_get_page_id('cart'))).'" class="minicart-menu-link ' . ($count == 0 ? 'empty' : '') . '"><span class="minicart-item-count">'.$count.'</span></a>';
	return $fragments;
}

function thegem_single_product_small_thumbnail_size($size) {
	global $thegem_product_categories_images;
	if($thegem_product_categories_images) {
		return 'thegem-custom-product-categories';
	}
	return $size;
}
add_filter( 'single_category_small_thumbnail_size', 'thegem_single_product_small_thumbnail_size' );

function thegem_woocommerce_get_image_size_categories($size) {
	$size = array(
		'width'  => '1170',
		'height' => '1117',
		'crop'   => 1
	);
	return $size;
}
add_filter( 'woocommerce_get_image_size_thegem-custom-product-categories', 'thegem_woocommerce_get_image_size_categories' );

function thegem_woocommerce_account_menu_item_classes($classes, $endpoint) {
	if(in_array('is-active', $classes)) {
		$classes[] = 'current-menu-ancestor';
	}
	return $classes;
}
add_filter('woocommerce_account_menu_item_classes', 'thegem_woocommerce_account_menu_item_classes', 10, 2);
