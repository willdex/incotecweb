<?php
	$params = empty($params) ? array() : $params;
	$params = array_merge(array(
		'columns' => 4,
		'alignment' => 'center',
		'icon_position' => 'top',
		'activate_button' => 0,
		'effects_enabled' => ''
	), $params);
	$thegem_item_data = thegem_get_sanitize_qf_item_data(get_the_ID());
	$thegem_icon_shortcode = thegem_build_icon_shortcode($thegem_item_data);
	$thegem_quickfinder_effect = 'quickfinder-item-effect-';
	if($thegem_item_data['icon_border_color'] && $thegem_item_data['icon_background_color']) {
		$thegem_quickfinder_effect .= 'border-reverse border-reverse-with-background';
	} elseif($thegem_item_data['icon_border_color']) {
		$thegem_quickfinder_effect .= 'border-reverse';
	} elseif($thegem_item_data['icon_background_color']) {
		$thegem_quickfinder_effect .= 'background-reverse';
	} else {
		$thegem_quickfinder_effect .= 'simple';
	}
	if(!$thegem_item_data['icon'] && has_post_thumbnail()) {
		$thegem_quickfinder_effect = 'quickfinder-item-effect-image-scale';
	}
	$thegem_title_text_color = '';
	if(!empty($thegem_item_data['title_text_color'])){
		$thegem_title_text_color = ' style="color: '. $thegem_item_data['title_text_color'] .';"';
	}
	$thegem_description_text_color = '';
	if(!empty($thegem_item_data['description_text_color'])){
		$thegem_description_text_color = ' style="color: '. $thegem_item_data['description_text_color'] .';"';
	}
	$thegem_columns_class = 'col-md-3 col-xs-6';
	switch ($params['columns']) {
		case 1:
			$thegem_columns_class = 'col-md-12 col-sm-12 col-xs-12'; break;
		case 2:
			$thegem_columns_class = 'col-md-6 col-sm-6 col-xs-12'; break;
		case 3:
			$thegem_columns_class = 'col-md-4 col-sm-6 col-xs-12'; break;
		case 6:
			$thegem_columns_class = 'col-md-2 col-sm-3 col-xs-4'; break;
		default:
			$thegem_columns_class = 'col-md-3 col-xs-6';
	}

	$thegem_button = $params['activate_button'] && $thegem_item_data['link'] ? thegem_button(array(
		'text' => $thegem_item_data['link_text'] ? $thegem_item_data['link_text'] : __('Read more', 'thegem'),
		'style' => $params['button_style'],
		'text_weight' => $params['button_text_weight'],
		'corner' => $params['button_corner'],
		'position' => 'inline',
		'text_color' => $params['button_text_color'],
		'background_color' => $params['button_background_color'],
		'border_color' => $params['button_border_color'],
		'extra_class' => 'quickfinder-button',
	)) : '';
?>
<div id="post-<?php the_ID(); ?>" <?php if($params['effects_enabled']) echo ' data-ll-finish-delay="200" '; ?> <?php post_class(array('quickfinder-item', 'inline-column', $thegem_columns_class, $thegem_quickfinder_effect, 'icon-size-'.$thegem_item_data['icon_size'], $params['effects_enabled'] ? 'lazy-loading' : '')); ?>>
	<?php if($params['icon_position'] == 'top-float' || $params['icon_position'] == 'center-float') : ?><div class="quickfinder-item-table"><?php endif; ?>
	<div class="quickfinder-item-inner">
		<?php if($params['icon_position'] == 'top' || ($params['icon_position'] != 'bottom' && $params['alignment'] != 'right')) : ?>
			<div class="quickfinder-item-image">
					<div class="quickfinder-item-image-content <?php if($params['effects_enabled']): ?>lazy-loading-item<?php endif; ?>" <?php if($params['effects_enabled']): ?>data-ll-item-delay="0" data-ll-effect="clip"<?php endif; ?>>
						<?php if($thegem_item_data['icon']) : ?>
							<div class="quickfinder-item-image-wrapper">
								<?php echo do_shortcode($thegem_icon_shortcode); ?>
							</div>
						<?php else : ?>
							<div class="quickfinder-item-image-wrapper quickfinder-item-picture quickfinder-item-image-shape-<?php echo $thegem_item_data['icon_shape'] ?>">
								<?php thegem_post_thumbnail('thegem-person', true, ' quickfinder-img-size-'.$thegem_item_data['icon_size'], thegem_quickfinder_srcset($thegem_item_data)); ?>
							</div>
						<?php endif; ?>
					</div>
			</div>
		<?php endif; ?>
		<div class="quickfinder-item-info-wrapper">
			<div class="quickfinder-item-info <?php if($params['effects_enabled']): ?>lazy-loading-item<?php endif; ?>" <?php if($params['effects_enabled']): ?>data-ll-item-delay="200" data-ll-effect="fading"<?php endif; ?>>
				<?php the_title('<div class="quickfinder-item-title" '.$thegem_title_text_color.'>', '</div>'); ?>
				<?php echo thegem_get_data($thegem_item_data, 'description', '', '<div class="quickfinder-item-text" '.$thegem_description_text_color.'>', '</div>'); ?>
				<?php echo $thegem_button; ?>
			</div>
		</div>
		<?php if($params['icon_position'] == 'bottom' || ($params['icon_position'] != 'top' && $params['alignment'] == 'right')) : ?>
			<div class="quickfinder-item-image">
					<div class="quickfinder-item-image-content<?php if($params['effects_enabled']): ?> lazy-loading-item<?php endif; ?>" <?php if($params['effects_enabled']): ?>data-ll-item-delay="0" data-ll-effect="clip"<?php endif; ?>>
						<?php if($thegem_item_data['icon']) : ?>
							<div class="quickfinder-item-image-wrapper">
								<?php echo do_shortcode($thegem_icon_shortcode); ?>
							</div>
						<?php else : ?>
							<div class="quickfinder-item-image-wrapper quickfinder-item-picture quickfinder-item-image-shape-<?php echo $thegem_item_data['icon_shape'] ?>">
								<?php thegem_post_thumbnail('thegem-person', true, ' quickfinder-img-size-'.$thegem_item_data['icon_size'], thegem_quickfinder_srcset($thegem_item_data)); ?>
							</div>
						<?php endif; ?>
					</div>
			</div>
		<?php endif; ?>
	</div>
	<?php if($params['icon_position'] == 'top-float' || $params['icon_position'] == 'center-float') : ?></div><?php endif; ?>
	<?php if($thegem_item_data['link']) : ?>
		<a href="<?php echo esc_url($thegem_item_data['link']); ?>" target="<?php echo esc_attr($thegem_item_data['link_target']); ?>" class="quickfinder-item-link"></a>
	<?php endif; ?>
</div>
