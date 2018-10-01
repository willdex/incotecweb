<?php

	$thegem_post_data = thegem_get_sanitize_page_title_data(get_the_ID());

	$thegem_post_item_data = thegem_get_sanitize_post_data(get_the_ID());

	$thegem_post_date = get_the_date("M Y");

	$thegem_categories = get_the_category();
	$thegem_categories_list = array();
	foreach($thegem_categories as $thegem_category) {
		$thegem_categories_list[] = '<a href="'.esc_url(get_category_link( $thegem_category->term_id )).'" title="'.esc_attr( sprintf( __( "View all posts in %s", "thegem" ), $thegem_category->name ) ).'">'.$thegem_category->cat_name.'</a>';
	}

	$thegem_classes = array();

	if(is_sticky() && !is_paged()) {
		$thegem_classes = array_merge($thegem_classes, array('sticky', 'default-background'));
	}

	$has_content_gallery = get_post_format(get_the_ID()) == 'gallery';
	$thegem_post_sources = array();
	if (has_post_thumbnail() && !$has_content_gallery) {
		$thegem_post_sources = array(
			array('media' => '(max-width: 768px)', 'srcset' => array('1x' => 'thegem-blog-timeline-large', '2x' => 'thegem-blog-timeline-large')),
			array('media' => '(max-width: 1050px)', 'srcset' => array('1x' => 'thegem-blog-timeline-small', '2x' => 'thegem-blog-timeline-large')),
			array('media' => '(max-width: 1920px)', 'srcset' => array('1x' => 'thegem-blog-timeline', '2x' => 'thegem-blog-timeline-large')),
		);
	}

	$thegem_featured_content = thegem_get_post_featured_content(get_the_ID(), $has_content_gallery ? 'thegem-blog-timeline-large' : 'thegem-blog-default-large', false, $thegem_post_sources);
	if(empty($thegem_featured_content)) {
		$thegem_classes[] = 'no-image';
	}

	$thegem_classes[] = 'item-animations-not-inited';

?>

<article id="post-<?php the_ID(); ?>" <?php post_class($thegem_classes); ?> data-post-date="<?php echo esc_attr($thegem_post_date); ?>">
	<div class="item-post-container">
		<div class="post-timeline-elements">
			<div class="pointer"><div><span class="date"><?php echo get_the_date('d M'); ?></span><span class="time"><?php echo get_the_date('H:i'); ?></span></div></div>
			<div class="pointer-right"><div><span class="date"><?php echo get_the_date('d M'); ?></span><span class="time"><?php echo get_the_date('H:i'); ?></span></div></div>
			<?php if($thegem_post_date != $last_post_date): ?>
				<div class="timeline-date-title"><?php echo $thegem_post_date; ?></div>
				<div class="timeline-date-title-right"><?php echo $thegem_post_date; ?></div>
			<?php endif; ?>
		</div>

		<div class="post-item clearfix">
			<?php
				if(!is_single() && is_sticky()) {
					echo '<div class="sticky-label">&#xe61a;</div>';
				}
			?>
			<svg class="wrap-style">
				<use xlink:href="<?php echo esc_url(get_template_directory_uri() . '/css/post-arrow.svg'); ?>#dec-post-arrow"></use>
			</svg>
			<svg class="wrap-style wrap-style-right">
				<use xlink:href="<?php echo esc_url(get_template_directory_uri() . '/css/post-arrow.svg'); ?>#dec-post-arrow"></use>
			</svg>

			<?php if($thegem_featured_content): ?>
				<div class="post-image"><?php echo $thegem_featured_content; ?></div>
			<?php endif; ?>
			<?php if(get_post_format() != 'quote' || empty($thegem_featured_content)) : ?>
				<div class="post-text-wrap">
					<div class="post-meta date-color">
						<div class="entry-meta clearfix gem-post-date">
							<div class="post-meta-left">
								<span class="post-meta-author"><?php printf( esc_html__( "By %s", "thegem" ), get_the_author_link() ) ?></span>
							</div>
							<div class="post-meta-right">
							<?php if(comments_open()): ?>
								<span class="comments-link"><?php comments_popup_link(0, 1, '%'); ?></span>
							<?php endif; ?>
							<?php if(comments_open() && function_exists('zilla_likes')): ?><span class="sep"></span><?php endif; ?>
							<?php if( function_exists('zilla_likes') ) { echo '<span class="post-meta-likes">';zilla_likes();echo '</span>'; } ?>
							</div>
						</div><!-- .entry-meta -->
					</div>
					<div class="post-title"><?php the_title('<'.(is_sticky() && !is_paged() ? 'h2' : 'h3').' class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></'.(is_sticky() && !is_paged() ? 'h2' : 'h3').'>'); ?></div>
					<div class="post-content">
						<div class="summary">
							<?php if ( !empty( $thegem_post_data['title_excerpt'] ) ): ?>
								<?php echo $thegem_post_data['title_excerpt']; ?>
							<?php else: ?>
								<?php echo preg_replace('%&#x[a-fA-F0-9]+;%', '', apply_filters('the_excerpt', get_the_excerpt())); ?>
							<?php endif; ?>
						</div>
					</div>
					<div class="post-misc">
						<div class="post-links">
							<div class="post-footer-sharing"><?php thegem_button(array('icon' => 'share', 'size' => (is_sticky() && !is_paged() ? 'medium' : 'tiny')), 1); ?><div class="sharing-popup"><?php thegem_socials_sharing(); ?><svg class="sharing-styled-arrow"><use xlink:href="<?php echo esc_url(get_template_directory_uri() . '/css/post-arrow.svg'); ?>#dec-post-arrow"></use></svg></div></div>
							<div class="post-read-more"><?php thegem_button(array('href' => get_the_permalink(), 'style' => 'outline', 'text' => __('Read More', 'thegem'), 'size' => (is_sticky() && !is_paged() ? 'medium' : 'tiny')), 1); ?></div>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
