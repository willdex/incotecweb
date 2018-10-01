<?php
function thegem_tag_cloud_args($args){
	$args['smallest'] = 12;
	$args['largest'] = 30;
	$args['unit'] = 'px';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'thegem_tag_cloud_args');
add_filter( 'woocommerce_product_tag_cloud_widget_args', 'thegem_tag_cloud_args');

function thegem_clients_block($params) {
	$params = array_merge(array('clients_set' => '', 'autoscroll' => '', 'fullwidth' => '', 'effects_enabled' => false, 'disable_grayscale' => false), $params);
	$args = array(
		'post_type' => 'thegem_client',
		'orderby' => 'menu_order ID',
		'order' => 'ASC',
		'posts_per_page' => -1,
	);
	if($params['clients_set'] != '') {
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'thegem_clients_sets',
				'field' => 'slug',
				'terms' => $params['clients_set']
			)
		);
	}
	$clients_items = new WP_Query($args);
	$params['autoscroll'] = intval($params['autoscroll']);
	if($clients_items->have_posts()) {
		wp_enqueue_script('thegem-clients-grid-carousel');
		$clients_title = '';
		$clients_description = '';

		if($clients_set = get_term_by('slug', $params['clients_set'], 'thegem_clients_sets')) {
			$clients_title = $clients_set->name;
			$clients_description = $clients_set->description;
		}

 		?>

		<?php if($params['fullwidth']) : ?><div class="fullwidth-block"><?php endif; ?>
			<div class="gem-client-set-title">
				<?php if($params['fullwidth'] || $clients_title || $clients_description) : ?><div class="container"><?php endif; ?>
				<?php if ($clients_title) : ?><div class="clients_title"><h3><?php $clients_title ?> </h3></div><?php endif; ?>
				<?php if ($clients_description) : ?><div class="clients_description"><?php $clients_description ?> </div> <?php endif; ?>
				<?php if($params['fullwidth'] || $clients_title || $clients_description) : ?></div><?php endif; ?>
			</div>
			<div class="gem_client-carousel <?php if($params["disable_grayscale"]): ?> disable-grayscale<?php endif; ?> <?php if($params['effects_enabled']): ?>lazy-loading<?php endif; ?>" <?php if($params['effects_enabled']): ?>data-ll-item-delay="0"<?php endif; ?>>
				<div class="<?php ($params['fullwidth'] ? 'container ' : '')?> gem_client_carousel-items" data-autoscroll='<?php echo $params['autoscroll']?>'>
				<?php
					while($clients_items->have_posts()) {
					$clients_items->the_post();
					$link_start = '';
					$link_end = '';
					$item_data = thegem_get_sanitize_client_data(get_the_ID());
					if($link = thegem_get_data($item_data, 'link')) {
						$link_start = '<a href="'.esc_url($link).'" target="'.thegem_get_data($item_data, 'link_target').'" class="grayscale grayscale-hover rounded-corners ">';
						$link_end = '</a>';
					}
				?>
				<div class="gem-client-item  <?php if($params['effects_enabled']): ?>lazy-loading-item<?php endif; ?>" <?php if($params['effects_enabled']): ?>data-ll-effect="drop-right"<?php endif; ?>> <?php echo $link_start?> <?php thegem_post_thumbnail('thegem-person', '', '')?> <?php echo $link_end?></div>
				<?php
		}
		?>

				</div>
			</div>
		<?php if($params['fullwidth']) : ?></div><?php endif; ?>
		<?php
	}
	wp_reset_postdata();
}

function thegem_pf_categories() {
	$terms = get_the_terms(get_the_ID(), 'thegem_portfolios');
	if($terms && !is_wp_error($terms)) {
		$list = array();
		foreach($terms as $term) {
			$list[] = $term->name;
		}
		echo  '<span class="sep">|</span> <span class="tags-links">'.join(' <span class="sep">|</span> ', $list).'</span>';
	}
}



/* BASIC GRID STYLES */
function thegem_shortcode_post_grid_add_array_templates($templates) {
	$templatesMy['theGem_basicGrid'] = array(
		'name' => __( 'The Gem Basic Grid 1', 'js_composer' ),
		'template' => '[vc_gitem c_zone_position="bottom" el_class="gem-basic-grid"]
			[vc_gitem_animated_block]
				[vc_gitem_zone_a height_mode="1-1" link="post_link" featured_image="yes"]
					[vc_gitem_row position="top"]
						[vc_gitem_col width="1/1"][/vc_gitem_col]
					[/vc_gitem_row]
					[vc_gitem_row position="middle"]
						[vc_gitem_col width="1/2"][/vc_gitem_col]
						[vc_gitem_col width="1/2"][/vc_gitem_col]
					[/vc_gitem_row]
					[vc_gitem_row position="bottom"]
						[vc_gitem_col width="1/1"][/vc_gitem_col]
					[/vc_gitem_row]
				[/vc_gitem_zone_a]
				[vc_gitem_zone_b]
					[vc_gitem_row position="top"]
						[vc_gitem_col width="1/1"][/vc_gitem_col]
					[/vc_gitem_row]
					[vc_gitem_row position="middle"]
						[vc_gitem_col width="1/2"][/vc_gitem_col]
						[vc_gitem_col width="1/2"][/vc_gitem_col]
					[/vc_gitem_row]
					[vc_gitem_row position="bottom"]
						[vc_gitem_col width="1/1"][/vc_gitem_col]
					[/vc_gitem_row]
				[/vc_gitem_zone_b]
			[/vc_gitem_animated_block]
			[vc_gitem_zone_c]
				[vc_gitem_row]
					[vc_gitem_col width="1/1" featured_image=""]
						[gem_post_title_with_date]
						[vc_gitem_post_excerpt link="none" font_container="tag:p|text_align:left" use_custom_fonts="" google_fonts="font_family:Abril%20Fatface%3Aregular|font_style:400%20regular%3A400%3Anormal"]
						[gem_button link="post_link" text="' . __( 'Read more', 'js_composer' ) . '" style="outline" size="tiny"]
					[/vc_gitem_col]
				[/vc_gitem_row]
			[/vc_gitem_zone_c]
		[/vc_gitem]');

	$templatesMy['theGem_basicGrid_2'] = array(
		'name' => __( 'The Gem Basic Grid 2', 'js_composer' ),
		'template' => '[vc_gitem c_zone_position="bottom" el_class="gem-basic-grid-2"]
			[vc_gitem_animated_block]
				[vc_gitem_zone_a height_mode="1-1" link="post_link" featured_image="yes"]
					[vc_gitem_row position="top"]
						[vc_gitem_col width="1/1"][/vc_gitem_col]
					[/vc_gitem_row]
					[vc_gitem_row position="middle"]
						[vc_gitem_col width="1/2"][/vc_gitem_col]
						[vc_gitem_col width="1/2"][/vc_gitem_col]
					[/vc_gitem_row]
					[vc_gitem_row position="bottom"]
						[vc_gitem_col width="1/1"][/vc_gitem_col]
					[/vc_gitem_row]
				[/vc_gitem_zone_a]
				[vc_gitem_zone_b]
					[vc_gitem_row position="top"]
						[vc_gitem_col width="1/1"][/vc_gitem_col]
					[/vc_gitem_row]
					[vc_gitem_row position="middle"]
						[vc_gitem_col width="1/2"][/vc_gitem_col]
						[vc_gitem_col width="1/2"][/vc_gitem_col]
					[/vc_gitem_row]
					[vc_gitem_row position="bottom"]
						[vc_gitem_col width="1/1"][/vc_gitem_col]
					[/vc_gitem_row]
				[/vc_gitem_zone_b]
			[/vc_gitem_animated_block]
			[vc_gitem_zone_c]
				[vc_gitem_row]
					[vc_gitem_col width="1/1" featured_image=""]
						[gem_post_title_with_date]
						[vc_gitem_post_excerpt link="none" font_container="tag:p|text_align:left" use_custom_fonts="" google_fonts="font_family:Abril%20Fatface%3Aregular|font_style:400%20regular%3A400%3Anormal"]
						[gem_button link="post_link" text="' . __( 'Read more', 'js_composer' ) . '" style="outline" size="tiny"]
					[/vc_gitem_col]
				[/vc_gitem_row]
			[/vc_gitem_zone_c]
		[/vc_gitem]');

	$templatesMy['theGem_mediaGrid'] = array(
		'name' => __( 'The Gem Media Grid 1', 'js_composer' ),
		'template' => '[vc_gitem el_class="gem-media-grid"]
				[vc_gitem_animated_block animation="slideBottom"]
					[vc_gitem_zone_a height_mode="1-1" link="none" featured_image="yes"]
						[vc_gitem_row position="top"]
							[vc_gitem_col width="1/1"][/vc_gitem_col]
						[/vc_gitem_row]
						[vc_gitem_row position="middle"]
							[vc_gitem_col width="1/2"][/vc_gitem_col]
							[vc_gitem_col width="1/2"][/vc_gitem_col]
						[/vc_gitem_row]
						[vc_gitem_row position="bottom"]
							[vc_gitem_col width="1/1"][/vc_gitem_col]
						[/vc_gitem_row]
					[/vc_gitem_zone_a]
					[vc_gitem_zone_b link="none" featured_image=""]
						[vc_gitem_row position="top"]
							[vc_gitem_col width="1/1"][/vc_gitem_col]
						[/vc_gitem_row]
						[vc_gitem_row position="middle"]
							[vc_gitem_col width="1/1"]
								[vc_gitem_post_title link="post_link" font_container="tag:div|text_align:center" use_custom_fonts="yes"]
								[vc_separator color="white" align="align_center" border_width="2" el_width="50"]
								[vc_gitem_post_excerpt link="none" font_container="tag:div|text_align:center" use_custom_fonts="yes"]
								[gem_post_author]
							[/vc_gitem_col]
						[/vc_gitem_row]
						[vc_gitem_row position="bottom"]
							[vc_gitem_col width="1/1"][/vc_gitem_col]
						[/vc_gitem_row]
					[/vc_gitem_zone_b]
				[/vc_gitem_animated_block]
			[/vc_gitem]');

	$templatesMy['theGem_mediaGrid_2'] = array(
		'name' => __( 'The Gem Media Grid 2', 'js_composer' ),
		'template' => '[vc_gitem el_class="gem-media-grid-2"]
				[vc_gitem_animated_block animation="slideBottom"]
					[vc_gitem_zone_a height_mode="1-1" link="none" featured_image="yes"]
						[vc_gitem_row position="top"]
							[vc_gitem_col width="1/1"][/vc_gitem_col]
						[/vc_gitem_row]
						[vc_gitem_row position="middle"]
							[vc_gitem_col width="1/2"][/vc_gitem_col]
							[vc_gitem_col width="1/2"][/vc_gitem_col]
						[/vc_gitem_row]
						[vc_gitem_row position="bottom"]
							[vc_gitem_col width="1/1"][/vc_gitem_col]
						[/vc_gitem_row]
					[/vc_gitem_zone_a]
					[vc_gitem_zone_b link="none" featured_image=""]
						[vc_gitem_row position="top"]
							[vc_gitem_col width="1/1"][/vc_gitem_col]
						[/vc_gitem_row]
						[vc_gitem_row position="middle"]
							[vc_gitem_col width="1/1"]
								[gem_post_author]
								[vc_gitem_post_excerpt link="none" font_container="tag:div|text_align:left" use_custom_fonts="yes"]
								[vc_gitem_post_title link="post_link" font_container="tag:div|text_align:left" use_custom_fonts="yes"]
							[/vc_gitem_col]
						[/vc_gitem_row]
						[vc_gitem_row position="bottom"]
							[vc_gitem_col width="1/1"][/vc_gitem_col]
						[/vc_gitem_row]
					[/vc_gitem_zone_b]
				[/vc_gitem_animated_block]
			[/vc_gitem]');
	return array_merge($templatesMy, $templates);
}
/* Add shortcode POST AUTOR */
add_filter('vc_grid_item_predefined_templates', 'thegem_shortcode_post_grid_add_array_templates');

function thegem_add_default_post_grid_template() {
	$param = WPBMap::getParam( 'vc_basic_grid', 'item' );
	$param['std'] = 'theGem_basicGrid';
	vc_update_shortcode_param( 'vc_basic_grid', $param );
}
add_action( 'vc_after_init', 'thegem_add_default_post_grid_template' );

function thegem_attribute_post_author( $value, $data ) {
   extract( array_merge( array(
      'post' => null,
      'data' => ''
   ), $data ) );

   return get_the_author_link();
}
add_filter( 'vc_gitem_template_attribute_post_author', 'thegem_attribute_post_author', 10, 2 );

function thegem_post_author() {
   return '<div class="midia-grid-item-post-author">By <span>{{ post_author }}</span></div>'; 
}
add_shortcode( 'gem_post_author', 'thegem_post_author' );
/* Add shortcode POST TITLE WITH DATE */

add_filter( 'vc_gitem_template_attribute_post_title_with_date', 'thegem_attribute_post_title_with_date', 10, 2 );
function thegem_attribute_post_title_with_date( $value, $data ) {
	extract( array_merge( array(
		'post' => null,
		'data' => ''
	), $data ) );

	return '<div class="post-title"><h4 class="entry-title"><a href="'.esc_url(get_permalink()).'" rel="bookmark">'.mysql2date('d M', $post->post_date).': <span class="light">'. get_the_title($post->ID) .'</span></a></h4></div>';
}

add_shortcode( 'gem_post_title_with_date', 'thegem_post_title_with_date' );
function thegem_post_title_with_date($atts) {
	return '{{ post_title_with_date }}'; 
}







/* ADD 2 ICONS PACKS TWO TABS ACCORIONS TOURS */

add_action( 'vc_base_register_front_css', 'gem_vc_iconpicker_base_register_css' );
add_action( 'vc_base_register_admin_css', 'gem_vc_iconpicker_base_register_css' );

function gem_vc_iconpicker_base_register_css() {
	wp_register_style('thegem-elegant-icons', get_template_directory_uri() . '/css/icons-elegant.css');
	wp_register_style('thegem-material-icons', get_template_directory_uri() . '/css/icons-material.css');
}

add_action('vc_enqueue_font_icon_element', 'thegem_vc_change_icon_font', 10);
function thegem_vc_change_icon_font($font){
	if($font === 'elegant'){
		wp_enqueue_style( 'icons-elegant' );
	} elseif ($font === 'material'){
		wp_enqueue_style( 'icons-material' );
	}
}

add_action( 'vc_backend_editor_enqueue_js_css', 'thegem_iconpicker_editor_jscss', 10 );
add_action( 'vc_frontend_editor_enqueue_js_css', 'thegem_iconpicker_editor_jscss', 10 );

function thegem_iconpicker_editor_jscss() {
	wp_enqueue_style('icons-elegant');
	wp_enqueue_style('icons-material');
}

function gem_add_2_icon_packs() {
	$param = WPBMap::getParam( 'vc_tta_section', 'i_type' );
	if(is_array($param['value'])) {
		$paramMy = array();
		$paramMy[__( 'Elegant Icons', 'thegem' )] = 'elegant';
		$paramMy[__( 'Material Design', 'thegem' )] = 'material';
		$param['value'] = array_merge($paramMy, $param['value']);
		vc_update_shortcode_param( 'vc_tta_section', $param );
	}
}
add_action( 'vc_after_init', 'gem_add_2_icon_packs' );

function gem_change_element_weight() {
	$param = WPBMap::getParam( 'vc_tta_section', 'el_class' );
	$param['weight'] = -2;
	vc_update_shortcode_param( 'vc_tta_section', $param );
}
add_action( 'vc_after_init', 'gem_change_element_weight' );

function gem_add_2_icon_packs_dependences(){
	$attributes = array(
	    'type' => 'iconpicker',
	    'heading' => "Elegant",
	    'param_name' => 'i_icon_elegant',
	    'weight' => -1, 
	    'dependency' => array(
			'element' => 'i_type',
			'value' => array('elegant')
		),
		'settings' => array(
			'emptyIcon' => false, 
			'type' => 'elegant',
			'iconsPerPage' => 4000, 
		),
	);
	vc_add_param( 'vc_tta_section', $attributes );

	$attributes = array(
	    'type' => 'iconpicker',
	    'heading' => "Material",
	    'param_name' => 'i_icon_material',
	    'weight' => -1, //  
	    'dependency' => array(
			'element' => 'i_type',
			'value' => array('material')
		),
		'settings' => array(
			'emptyIcon' => false, 
			'type' => 'material',
			'iconsPerPage' => 4000, 
		),

	);
	vc_add_param( 'vc_tta_section', $attributes );
}
add_action( 'vc_after_init', 'gem_add_2_icon_packs_dependences' );