<?php

$thegem_classes = array('portfolio-item');
$thegem_classes = array_merge($thegem_classes, $slugs);

$thegem_image_classes = array('image');
$thegem_caption_classes = array('caption');

if($params['caption_position'] == 'zigzag') {
	$thegem_caption_position = $eo_marker ? 'left' : 'right';
} else {
	$thegem_caption_position = $params['caption_position'];
}

$thegem_portfolio_item_data = thegem_get_sanitize_pf_item_data(get_the_ID());
$thegem_title_data = thegem_get_sanitize_page_title_data(get_the_ID());

if (empty($thegem_portfolio_item_data['types']))
	$thegem_portfolio_item_data['types'] = array();

$thegem_classes = array_merge($thegem_classes, array('col-xs-12'));

if($params['display_titles'] == 'page' && $params['hover'] != 'gradient' && $params['hover'] != 'circular') {
	if($params['layout_version'] == 'fullwidth') {
		$thegem_image_classes = array_merge($thegem_image_classes, array('col-md-8', 'col-xs-12'));
		$thegem_caption_classes = array_merge($thegem_caption_classes, array('col-md-4', 'col-xs-12'));
		if($thegem_caption_position == 'left') {
			$thegem_image_classes = array_merge($thegem_image_classes, array('col-md-push-4'));
			$thegem_caption_classes = array_merge($thegem_caption_classes, array('col-md-pull-8'));
		}
	} else {
		$thegem_image_classes = array_merge($thegem_image_classes, array('col-md-7', 'col-xs-12'));
		$thegem_caption_classes = array_merge($thegem_caption_classes, array('col-md-5', 'col-xs-12'));
		if($thegem_caption_position == 'left') {
			$thegem_image_classes = array_merge($thegem_image_classes, array('col-md-push-5'));
			$thegem_caption_classes = array_merge($thegem_caption_classes, array('col-md-pull-7'));
		}
	}
}

$thegem_size = 'thegem-portfolio-1x';
if($params['display_titles'] == 'hover' || $params['hover'] == 'gradient' || $params['hover'] == 'circular') {
	$thegem_size .= '-hover';
} else {
	$thegem_size .= $params['layout_version'] == 'sidebar' ? '-sidebar' : '';
}

$thegem_small_image_url = thegem_generate_thumbnail_src(get_post_thumbnail_id(), $thegem_size);
$thegem_large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
$thegem_self_video = '';

$thegem_bottom_line = false;
$thegem_portfolio_button_link = '';
if($thegem_portfolio_item_data['project_link'] || !$params['disable_socials']) {
	$thegem_bottom_line = true;
}

$thegem_classes[] = 'item-animations-not-inited';

?>

<div <?php post_class($thegem_classes); ?> style="padding: <?php echo intval($gap_size); ?>px;" data-sort-date="<?php echo get_the_date('Y-m-d'); ?>">
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
							$thegem_bottom_line = true;
							$thegem_portfolio_button_link = $thegem_link;
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
										$thegem_bottom_line = true;
										$thegem_portfolio_button_link = $thegem_link;
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
						<?php if($params['display_titles'] == 'hover' || $params['hover'] == 'gradient' || $params['hover'] == 'circular'): ?>
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
												<?php echo get_the_date('j F, Y'); ?> <?php if(count($slugs) > 0) { echo esc_html_x('in', 'in categories', 'thegem'); } ?>&nbsp;
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
		<?php if($params['display_titles'] == 'page' && $params['hover'] != 'gradient' && $params['hover'] != 'circular'): ?>
			<div <?php post_class($thegem_caption_classes); ?>>
				<div class="caption-sizable-content<?php echo ($thegem_bottom_line ? ' with-bottom-line' : ''); ?>">
					<div class="title title-h3"><span class="light">
						<?php if(!empty($thegem_portfolio_item_data['overview_title'])) : ?>
							<?php echo $thegem_portfolio_item_data['overview_title']; ?>
						<?php else : ?>
							<?php the_title(); ?>
						<?php endif; ?>
					</span></div>
					<?php if($params['show_info']): ?>
						<div class="info clearfix">
							<div class="caption-separator-line"><?php echo get_the_date('j F, Y'); ?></div><!--
							<?php if($params['likes'] && $params['likes'] != 'false' && function_exists('zilla_likes') ) { echo '--><div class="caption-separator-line-hover"> <span class="sep"></span> <span class="post-meta-likes">';zilla_likes();echo '</span></div><!--'; } ?>
						--></div>
					<?php endif; ?>
					<?php if(has_excerpt()) : ?>
						<div class="subtitle"><?php the_excerpt(); ?></div>
					<?php elseif($thegem_title_data['title_excerpt']) : ?>
						<div class="subtitle"><?php echo nl2br($thegem_page_data['title_excerpt']); ?></div>
					<?php endif; ?>
					<?php if($params['show_info']): ?>
						<div class="info">
							<?php
								if(count($slugs) > 0) { echo esc_html_x('in', 'in categories', 'thegem'); }
								$thegem_index = 0;
								foreach ($slugs as $thegem_k => $thegem_slug) {
									if (isset($thegem_terms_set[$thegem_slug])) {
										echo ($thegem_index > 0 ? '<span class="portfolio-set-comma">,</span> ': '').' <a data-slug="'.$thegem_terms_set[$thegem_slug]->slug.'">'.$thegem_terms_set[$thegem_slug]->name.'</a>';
										$thegem_index++;
									}
								}
								?>
						</div>
					<?php endif; ?>
				</div>
				<div class="caption-bottom-line">
					<?php if($thegem_portfolio_item_data['project_link']) { thegem_button(array('size' => 'tiny', 'href' => $thegem_portfolio_item_data['project_link'] , 'text' => ($thegem_portfolio_item_data['project_text'] ? $thegem_portfolio_item_data['project_text'] : __('Launch', 'thegem')), 'extra_class' => 'project-button'), 1); } ?>
					<?php if($thegem_portfolio_button_link) { thegem_button(array('size' => 'tiny', 'text' => __('Details', 'thegem'), 'style' => 'outline', 'href' => get_permalink()), 1); } ?>
					<?php if(!$params['disable_socials']): ?>
						<div class="post-footer-sharing"><?php thegem_button(array('icon' => 'share', 'size' => 'tiny'), 1); ?><div class="sharing-popup"><?php thegem_socials_sharing(); ?><svg class="sharing-styled-arrow"><use xlink:href="<?php echo esc_url(get_template_directory_uri() . '/css/post-arrow.svg'); ?>#dec-post-arrow"></use></svg></div></div>
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>
