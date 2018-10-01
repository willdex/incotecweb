<?php

	$thegem_blog_style = isset($thegem_blog_style) ? $thegem_blog_style : 'default';

	$thegem_post_data = thegem_get_sanitize_page_title_data(get_the_ID());

	$params = isset($params) ? $params : array(
		'hide_author' => 0,
		'hide_comments' => 0,
		'hide_date' => 0,
		'hide_likes' => 0,
	);

	$thegem_categories = get_the_category();
	$thegem_categories_list = array();
	foreach($thegem_categories as $thegem_category) {
		$thegem_categories_list[] = '<a href="'.esc_url(get_category_link( $thegem_category->term_id )).'" title="'.esc_attr( sprintf( __( "View all posts in %s", "thegem" ), $thegem_category->name ) ).'">'.$thegem_category->cat_name.'</a>';
	}

	$thegem_classes = array();

	if(is_sticky() && !is_paged()) {
		$thegem_classes = array_merge($thegem_classes, array('sticky', 'default-background'));
	}

	$thegem_featured_content = thegem_get_post_featured_content(get_the_ID());
	if(empty($thegem_featured_content)) {
		$thegem_classes[] = 'no-image';
	}

	$thegem_classes[] = 'item-animations-not-inited';

?>

<article id="post-<?php the_ID(); ?>" <?php post_class($thegem_classes); ?>>
	<?php if(get_post_format() == 'quote' && $thegem_featured_content) : ?>
		<?php echo $thegem_featured_content; ?>
	<?php else : ?>
	<?php
		if(!is_single() && is_sticky() && !is_paged()) {
			echo '<div class="sticky-label">&#xe61a;</div>';
		}
	?>
	<div class="item-post-container">
		<div class="item-post clearfix">

			<?php if($thegem_featured_content) : ?>
				<div class="post-image"><?php echo $thegem_featured_content; ?></div>
			<?php endif; ?>

			<div class="post-meta date-color">
				<div class="entry-meta clearfix gem-post-date">
					<div class="post-meta-right">
						<?php if(comments_open() && !$params['hide_comments'] ): ?>
							<span class="comments-link"><?php comments_popup_link(0, 1, '%'); ?></span>
						<?php endif; ?>
						<?php if(comments_open() && !$params['hide_comments'] && function_exists('zilla_likes') && !$params['hide_likes']): ?><span class="sep"></span><?php endif; ?>
						<?php if( function_exists('zilla_likes') && !$params['hide_likes'] ) { echo '<span class="post-meta-likes">';zilla_likes();echo '</span>'; } ?>
					</div>
					<div class="post-meta-left">
						<?php if(!$params['hide_author']) : ?><span class="post-meta-author"><?php printf( esc_html__( "By %s", "thegem" ), get_the_author_link() ) ?></span><?php endif; ?>
						<?php if($thegem_categories): ?>
							<?php if(!$params['hide_author']) : ?><span class="sep"></span> <?php endif; ?><span class="post-meta-categories"><?php echo implode(' <span class="sep"></span> ', $thegem_categories_list); ?></span>
						<?php endif ?>
					</div>
				</div><!-- .entry-meta -->
			</div>

			<div class="post-title">
				<?php the_title('<'.(is_sticky() && !is_paged() ? 'h2' : 'h3').' class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">'.(!$params['hide_date'] ? get_the_date('d M').': ' : '').'<span class="light">', '</span></a></'.(is_sticky() && !is_paged() ? 'h2' : 'h3').'>'); ?>
			</div>

			<div class="post-text">
				<div class="summary">
					<?php if ( !empty( $thegem_post_data['title_excerpt'] ) ): ?>
						<?php echo $thegem_post_data['title_excerpt']; ?>
					<?php else: ?>
						<?php echo preg_replace('%&#x[a-fA-F0-9]+;%', '', apply_filters('the_excerpt', get_the_excerpt())); ?>
					<?php endif; ?>
				</div>
			</div>

			<div class="post-footer">
				<div class="post-footer-sharing"><?php thegem_button(array('icon' => 'share', 'size' => (is_sticky() && !is_paged() ? 'medium' : 'tiny')), 1); ?><div class="sharing-popup"><?php thegem_socials_sharing(); ?><svg class="sharing-styled-arrow"><use xlink:href="<?php echo esc_url(get_template_directory_uri() . '/css/post-arrow.svg'); ?>#dec-post-arrow"></use></svg></div></div>
				<div class="post-read-more"><?php thegem_button(array('href' => get_the_permalink(), 'style' => 'outline', 'text' => __('Read More', 'thegem'), 'size' => (is_sticky() && !is_paged() ? 'medium' : 'tiny')), 1); ?></div>
			</div>

		</div>
	</div>
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
