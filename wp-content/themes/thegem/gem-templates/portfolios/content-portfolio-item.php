<?php

$thegem_classes = array('portfolio-item');
$thegem_classes = array_merge($thegem_classes, $slugs);

$thegem_image_classes = array('image');
$thegem_caption_classes = array('caption');

$thegem_portfolio_item_data = get_post_meta(get_the_ID(), 'thegem_portfolio_item_data', 1);

if (!empty($thegem_portfolio_item_data['highlight_type'])) {
	$thegem_highlight_type = $thegem_portfolio_item_data['highlight_type'];
} else {
	$thegem_highlight_type = 'squared';
}

if (empty($thegem_portfolio_item_data['types']))
	$thegem_portfolio_item_data['types'] = array();

if ($params['style'] != 'metro') {
	if ($params['layout'] == '1x') {
		$thegem_classes = array_merge($thegem_classes, array('col-xs-12'));
		$thegem_image_classes = array_merge($thegem_image_classes, array('col-sm-5', 'col-xs-12'));
		$thegem_caption_classes = array_merge($thegem_caption_classes, array('col-sm-7', 'col-xs-12'));
	}

	if ($params['layout'] == '2x') {
		if (isset($thegem_portfolio_item_data['highlight']) && $thegem_portfolio_item_data['highlight'] && empty($params['is_slider']) && $thegem_highlight_type != 'vertical')
			$thegem_classes = array_merge($thegem_classes, array('col-xs-12'));
		else
			$thegem_classes = array_merge($thegem_classes, array('col-sm-6', 'col-xs-12'));
	}

	if ($params['layout'] == '3x') {
		if (isset($thegem_portfolio_item_data['highlight']) && $thegem_portfolio_item_data['highlight'] && empty($params['is_slider']) && $thegem_highlight_type != 'vertical')
			$thegem_classes = array_merge($thegem_classes, array('col-md-8', 'col-xs-8'));
		else
			$thegem_classes = array_merge($thegem_classes, array('col-md-4', 'col-xs-4'));
	}

	if ($params['layout'] == '4x') {
		if (isset($thegem_portfolio_item_data['highlight']) && $thegem_portfolio_item_data['highlight'] && empty($params['is_slider']) && $thegem_highlight_type != 'vertical')
			$thegem_classes = array_merge($thegem_classes, array('col-md-6', 'col-sm-8', 'col-xs-8'));
		else
			$thegem_classes = array_merge($thegem_classes, array('col-md-3', 'col-sm-4', 'col-xs-4'));
	}
}

if (isset($thegem_portfolio_item_data['highlight']) && $thegem_portfolio_item_data['highlight'] && empty($params['is_slider']))
	$thegem_classes[] = 'double-item';

if (isset($thegem_portfolio_item_data['highlight']) && $thegem_portfolio_item_data['highlight'] && empty($params['is_slider']) && $thegem_highlight_type != 'squared') {
	$thegem_classes[] = 'double-item-' . $thegem_highlight_type;
}

$thegem_size = 'thegem-portfolio-justified';
$thegem_sizes = thegem_image_sizes();
if ($params['layout'] != '1x') {
	if ($params['style'] == 'masonry') {
		$thegem_size = 'thegem-portfolio-masonry';
		if (isset($thegem_portfolio_item_data['highlight']) && $thegem_portfolio_item_data['highlight'] && empty($params['is_slider']))
			$thegem_size = 'thegem-portfolio-masonry-double';
	} elseif ($params['style'] == 'metro') {
		$thegem_size = 'thegem-portfolio-metro';
	} else {
		if (isset($thegem_portfolio_item_data['highlight']) && $thegem_portfolio_item_data['highlight'] && empty($params['is_slider'])) {
			$thegem_size = 'thegem-portfolio-double-' . str_replace('%', '',$params['layout']);

			if ( ($params['display_titles'] == 'hover' || $params['hover'] == 'gradient' || $params['hover'] == 'circular') && isset($thegem_sizes[$thegem_size.'-hover'])) {
				$thegem_size .= '-hover';
			}

			if(isset($thegem_sizes[$thegem_size.'-gap-'.$params['gaps_size']])) {
				$thegem_size .= '-gap-'.$params['gaps_size'];
			}

		}
	}

	if (isset($thegem_portfolio_item_data['highlight']) && $thegem_portfolio_item_data['highlight'] && $params['style'] != 'metro' && empty($params['is_slider']) && $thegem_highlight_type != 'squared') {
		$thegem_size .= '-' . $thegem_highlight_type;
	}
} else {
	$thegem_size = 'thegem-portfolio-1x';
}

$thegem_classes[] = 'item-animations-not-inited';

$thegem_size = apply_filters('portfolio_size_filter', $thegem_size);

$thegem_large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
$thegem_self_video = '';

$thegem_sources = array();

if ($params['style'] == 'metro') {
	$thegem_sources = array(
		array('media' => '(min-width: 550px) and (max-width: 1100px)', 'srcset' => array('1x' => 'thegem-portfolio-metro-medium', '2x' => 'thegem-portfolio-metro-retina'))
	);
}

if (!isset($thegem_portfolio_item_data['highlight']) || !$thegem_portfolio_item_data['highlight'] || !empty($params['is_slider']) ||
		($params['style'] == 'masonry' && isset($thegem_portfolio_item_data['highlight']) && $thegem_portfolio_item_data['highlight']) && $thegem_highlight_type == 'vertical') {

	$retina_size = $params['style'] == 'justified' ? $thegem_size : 'thegem-portfolio-masonry-double';

	if ($params['layout'] == '100%') {
		if ($params['style'] == 'justified' || $params['style'] == 'masonry') {
			switch ($params['fullwidth_columns']) {
				case '4':
					$thegem_sources = array(
						array('media' => '(max-width: 550px)', 'srcset' => array('1x' => 'thegem-portfolio-' . $params['style'] . '-2x-500', '2x' => $retina_size)),
						array('media' => '(min-width: 1280px) and (max-width: 1495px)', 'srcset' => array('1x' => 'thegem-portfolio-' . $params['style'] . '-fullwidth-5x', '2x' => $retina_size)),
						array('media' => '(max-width: 1920px)', 'srcset' => array('1x' => 'thegem-portfolio-' . $params['style'] . '-fullwidth-4x', '2x' => $retina_size))
					);
					break;

				case '5':
					$thegem_sources = array(
						array('media' => '(max-width: 550px)', 'srcset' => array('1x' => 'thegem-portfolio-' . $params['style'] . '-2x-500', '2x' => $retina_size)),
						array('media' => '(min-width: 1495px) and (max-width: 1680px), (min-width: 550px) and (max-width: 1280px)', 'srcset' => array('1x' => 'thegem-portfolio-' . $params['style'] . '-fullwidth-4x', '2x' => $retina_size)),
						array('media' => '(min-width: 1680px) and (max-width: 1920px), (min-width: 1280px) and (max-width: 1495px)', 'srcset' => array('1x' => 'thegem-portfolio-' . $params['style'] . '-fullwidth-5x', '2x' => $retina_size))
					);
					break;
			}
		}
	} else {
		if ($params['style'] == 'justified' || $params['style'] == 'masonry') {
			switch ($params['layout']) {
				case '2x':
					$thegem_sources = array(
						array('media' => '(max-width: 550px)', 'srcset' => array('1x' => 'thegem-portfolio-' . $params['style'] . '-2x-500', '2x' => $retina_size)),
						array('media' => '(max-width: 1920px)', 'srcset' => array('1x' => 'thegem-portfolio-' . $params['style'] . '-2x', '2x' => $retina_size))
					);
					break;

				case '3x':
					$thegem_sources = array(
						array('media' => '(max-width: 550px)', 'srcset' => array('1x' => 'thegem-portfolio-' . $params['style'] . '-2x-500', '2x' => $retina_size)),
						array('media' => '(max-width: 1920px)', 'srcset' => array('1x' => 'thegem-portfolio-' . $params['style'] . '-3x', '2x' => $retina_size))
					);
					break;

				case '4x':
					$thegem_sources = array(
						array('media' => '(max-width: 550px)', 'srcset' => array('1x' => 'thegem-portfolio-' . $params['style'] . '-2x-500', '2x' => $retina_size)),
						array('media' => '(max-width: 1100px)', 'srcset' => array('1x' => 'thegem-portfolio-' . $params['style'] . '-3x', '2x' => $retina_size)),
						array('media' => '(max-width: 1920px)', 'srcset' => array('1x' => 'thegem-portfolio-' . $params['style'] . '-4x', '2x' => $retina_size))
					);
					break;
			}
		}
	}
}

?>

<div <?php post_class($thegem_classes); ?> style="padding: <?php echo intval($gap_size); ?>px;" data-default-sort="<?php echo intval(get_post()->menu_order); ?>" data-sort-date="<?php echo get_the_date('U'); ?>">
	<div class="wrap clearfix">
		<div <?php post_class($thegem_image_classes); ?>>
			<div class="image-inner">
				<?php thegem_post_picture($thegem_size, $thegem_sources, array('alt' => get_the_title())); ?>
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
