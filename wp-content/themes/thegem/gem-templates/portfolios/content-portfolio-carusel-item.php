<?php

$thegem_classes = array('portfolio-item');
$thegem_classes = array_merge($thegem_classes, $slugs);

$thegem_image_classes = array('image');
$thegem_caption_classes = array('caption');

$thegem_portfolio_item_data = get_post_meta(get_the_ID(), 'thegem_portfolio_item_data', 1);
$thegem_sizes = thegem_image_sizes();

if (empty($thegem_portfolio_item_data['types']))
	$thegem_portfolio_item_data['types'] = array();

if ($params['style'] != 'metro') {
	if ($params['layout'] == '3x') {

		if (isset($thegem_portfolio_item_data['highlight']) && $thegem_portfolio_item_data['highlight'] && empty($params['is_slider']))
			$thegem_classes = array_merge($thegem_classes, array('col-md-8', 'col-xs-12'));
		else
			$thegem_classes = array_merge($thegem_classes, array('col-md-4', 'col-xs-6'));
	}
}
	if ($params['fullwidth_columns'] == '3') {
		$thegem_size = 'thegem-portfolio-carusel-full-3x';
	}
	if ($params['fullwidth_columns'] == '4') {
		$thegem_size = 'thegem-portfolio-carusel-4x';
	}
	if ($params['fullwidth_columns'] == '5') {
		$thegem_size = 'thegem-portfolio-carusel-5x';
	}
	if ($params['layout'] == '3x') {
		$thegem_size = 'thegem-portfolio-carusel-3x';
	}





if (isset($thegem_portfolio_item_data['highlight']) && $thegem_portfolio_item_data['highlight'] && empty($params['is_slider']))
	$thegem_classes[] = 'double-item';



if ($params['effects_enabled'])
	$thegem_classes[] = 'lazy-loading-item';

$thegem_small_image_url = thegem_generate_thumbnail_src(get_post_thumbnail_id(), $thegem_size);
$thegem_large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
$thegem_self_video = '';

?>


<div style="padding: <?php echo intval($gap_size); ?>px;" <?php post_class($thegem_classes); ?> <?php if($params['effects_enabled']): ?>data-ll-effect="move-up"<?php endif; ?> data-sort-date="<?php echo get_the_date('U'); ?>">
	<div class="wrap clearfix">
		<div <?php post_class($thegem_image_classes); ?>>
			<div class="image-inner">
				<img src="<?php echo esc_url($thegem_small_image_url[0]); ?>" width="<?php echo esc_attr($thegem_small_image_url[1]); ?>" height="<?php echo esc_attr($thegem_small_image_url[2]); ?>" alt="<?php the_title(); ?>" />
			</div>
			<div class="overlay">
				<div class="overlay-circle"></div>
				<?php if (count($thegem_portfolio_item_data['types']) == 1 && $params['disable_socials']): ?>
					<?php
						$thegem_ptype = reset($thegem_portfolio_item_data['types']);
						if($thegem_ptype['type'] == 'full-image') {
							$thegem_link = $thegem_large_image_url[0];
						} elseif($thegem_ptype['type'] == 'self-link') {
							$thegem_link = get_permalink();
						} elseif($thegem_ptype['type'] == 'youtube') {
							$thegem_link = 'http://www.youtube.com/embed/'.$thegem_ptype['link'].'?autoplay=1';
						} elseif($thegem_ptype['type'] == 'vimeo') {
							$thegem_link = 'http://player.vimeo.com/video/'.$thegem_ptype['link'].'?autoplay=1';
						} else {
							$thegem_link = $thegem_ptype['link'];
						}
						if(!$thegem_link) {
							$thegem_link = '#';
						}
						if($thegem_ptype['type'] == 'self_video') {
							$thegem_self_video = $thegem_ptype['link'];
							wp_enqueue_style('wp-mediaelement');
							wp_enqueue_script('thegem-mediaelement');
						}

					?>
					<a href="<?php echo esc_url($thegem_link); ?>" target="<?php echo esc_attr($thegem_ptype['link_target']); ?>" class="portolio-item-link <?php echo esc_attr($thegem_ptype['type']); ?> <?php if($thegem_ptype['type'] == 'full-image') echo 'fancy'; ?>"></a>
				<?php endif; ?>
				<div class="links-wrapper">
					<div class="links">
						<div class="portfolio-icons">
							<?php foreach($thegem_portfolio_item_data['types'] as $thegem_ptype): ?>
								<?php
									if($thegem_ptype['type'] == 'full-image') {
										$thegem_link = $thegem_large_image_url[0];
									} elseif($thegem_ptype['type'] == 'self-link') {
										$thegem_link = get_permalink();
									} elseif($thegem_ptype['type'] == 'youtube') {
										$thegem_link = 'http://www.youtube.com/embed/'.$thegem_ptype['link'].'?autoplay=1';
									} elseif($thegem_ptype['type'] == 'vimeo') {
										$thegem_link = 'http://player.vimeo.com/video/'.$thegem_ptype['link'].'?autoplay=1';
									} else {
										$thegem_link = $thegem_ptype['link'];
									}
									if(!$thegem_link) {
										$thegem_link = '#';
									}
									if($thegem_ptype['type'] == 'self_video') {
										$thegem_self_video = $thegem_ptype['link'];
										wp_enqueue_style('wp-mediaelement');
										wp_enqueue_script('thegem-mediaelement');
									}
								?>
								<a href="<?php echo esc_url($thegem_link); ?>" target="<?php echo esc_attr($thegem_ptype['link_target']); ?>" class="icon <?php echo esc_attr($thegem_ptype['type']); ?> <?php if($thegem_ptype['type'] == 'full-image' && (count($thegem_portfolio_item_data['types']) > 1 || !$params['disable_socials'])) echo 'fancy'; ?>"></a>
							<?php endforeach; ?>
							<?php if(!$params['disable_socials']): ?>
								<a href="javascript: void(0);" class="icon share"></a>
							<?php endif; ?>
							<div class="overlay-line"></div>
							<?php if(!$params['disable_socials']): ?>
								<div class="portfolio-sharing-pane"><?php thegem_socials_sharing(); ?></div>
							<?php endif; ?>
						</div>
						<?php if( ($params['display_titles'] == 'hover' && $params['layout'] != '1x') || $params['hover'] == 'gradient' || $params['hover'] == 'circular'): ?>
							<div class="caption">
								<div class="title title-h4">
									<?php if($params['hover'] != 'default' && $params['hover'] != 'gradient' && $params['hover'] != 'circular') { echo '<span class="light">'; } ?>
									<?php if(!empty($thegem_portfolio_item_data['overview_title'])) : ?>
										<?php echo $thegem_portfolio_item_data['overview_title']; ?>
									<?php else : ?>
										<?php the_title(); ?>
									<?php endif; ?>
									<?php if($params['hover'] != 'default') { echo '</span>'; } ?>
								</div>
								<div class="description">
									<?php if(has_excerpt()) : ?><div class="subtitle"><?php the_excerpt(); ?></div><?php endif; ?>
									<?php if($params['show_info']): ?>
										<div class="info">
											<?php if($params['layout'] == '1x'): ?>
												<?php echo get_the_date('j F, Y'); ?>&nbsp;
												<?php
													foreach ($slugs as $thegem_k => $thegem_slug)
														if (isset($thegem_terms_set[$thegem_slug]))
															echo '<a data-slug="'.$thegem_terms_set[$thegem_slug]->slug.'">'.$thegem_terms_set[$thegem_slug]->name.'</a>';
												?>
											<?php else: ?>
												<?php echo get_the_date('j F, Y'); ?> <?php if(count($slugs) > 0): ?>in<?php endif; ?>&nbsp;
												<?php
													$thegem_index = 0;
													foreach ($slugs as $thegem_k => $thegem_slug)
														if (isset($thegem_terms_set[$thegem_slug])) {
															echo ($thegem_index > 0 ? '<span class="portfolio-set-comma">,</span> ': '').'<a data-slug="'.$thegem_terms_set[$thegem_slug]->slug.'">'.$thegem_terms_set[$thegem_slug]->name.'</a>';
															$thegem_index++;
														}
												?>
											<?php endif; ?>
										</div>
									<?php endif ?>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<?php if( ($params['display_titles'] == 'page' || $params['layout'] == '1x') && $params['hover'] != 'gradient' && $params['hover'] != 'circular'): ?>
			<div <?php post_class($thegem_caption_classes); ?>>
				<div class="title">
					<?php if(!empty($thegem_portfolio_item_data['overview_title'])) : ?>
						<?php echo $thegem_portfolio_item_data['overview_title']; ?>
					<?php else : ?>
						<?php the_title(); ?>
					<?php endif; ?>
				</div>
				<div class="caption-separator"></div>
				<?php if(has_excerpt()) : ?><div class="subtitle"><?php the_excerpt(); ?></div><?php endif; ?>
				<?php if($params['show_info']): ?>
					<div class="info">
						<?php if($params['layout'] == '1x'): ?>
							<?php echo get_the_date('j F, Y'); ?>&nbsp;
							<?php
								foreach ($slugs as $thegem_k => $thegem_slug)
									if (isset($thegem_terms_set[$thegem_slug]))
										echo '<span class="separator">|</span><a data-slug="'.$thegem_terms_set[$thegem_slug]->slug.'">'.$thegem_terms_set[$thegem_slug]->name.'</a>';
							?>
						<?php else: ?>
							<?php echo get_the_date('j F, Y'); ?> <?php if(count($slugs) > 0): ?>in<?php endif; ?>&nbsp;
							<?php
								$thegem_index = 0;
								foreach ($slugs as $thegem_k => $thegem_slug)
									if (isset($thegem_terms_set[$thegem_slug])) {
										echo ($thegem_index > 0 ? '<span class="sep"></span> ': '').'<a data-slug="'.$thegem_terms_set[$thegem_slug]->slug.'">'.$thegem_terms_set[$thegem_slug]->name.'</a>';
										$thegem_index++;
									}
							?>
						<?php endif; ?>
					</div>
				<?php endif; ?>
				<?php if($params['likes'] && $params['likes'] != 'false' && function_exists('zilla_likes')) { echo '<div class="portfolio-likes'.($params['show_info'] ? '' : ' visible').'">';zilla_likes();echo '</div>'; } ?>
			</div>
		<?php endif; ?>
	</div>
</div>
