<?php

	$thegem_post_data = thegem_get_sanitize_page_title_data(get_the_ID());

	$thegem_categories = get_the_category();
	$thegem_categories_list = array();
	foreach($thegem_categories as $thegem_category) {
		$thegem_categories_list[] = '<a href="'.esc_url(get_category_link( $thegem_category->term_id )).'" title="'.esc_attr( sprintf( __( "View all posts in %s", "thegem" ), $thegem_category->name ) ).'">'.$thegem_category->cat_name.'</a>';
	}

	$thegem_classes = array();
	$thegem_sources = array();
	$has_content_gallery = get_post_format(get_the_ID()) == 'gallery';

	if(is_sticky() && !is_paged()) {
		$thegem_classes = array_merge($thegem_classes, array('sticky'));
		$thegem_featured_content = thegem_get_post_featured_content(get_the_ID(), 'thegem-blog-justified-sticky');
	} else {
		$thegem_post_gallery_size = 'thegem-blog-justified';
		if ($has_content_gallery) {
			if ($blog_style == 'justified-3x') {
				$thegem_post_gallery_size = 'thegem-blog-justified-3x';
			} elseif ($blog_style == 'justified-4x') {
				$thegem_post_gallery_size = 'thegem-blog-justified-4x';
			}
		}

		if (has_post_thumbnail() && !$has_content_gallery) {
			if ($blog_style == 'justified-3x') {
				$thegem_sources = array(
					array('media' => '(max-width: 992px)', 'srcset' => array('1x' => 'thegem-blog-justified', '2x' => 'thegem-blog-justified')),
					array('media' => '(max-width: 1100px)', 'srcset' => array('1x' => 'thegem-blog-justified-3x-small', '2x' => 'thegem-blog-justified')),
					array('media' => '(max-width: 1920px)', 'srcset' => array('1x' => 'thegem-blog-justified-3x', '2x' => 'thegem-blog-justified'))
				);
			} elseif ($blog_style == 'justified-4x') {
				$thegem_sources = array(
					array('media' => '(max-width: 600px)', 'srcset' => array('1x' => 'thegem-blog-justified', '2x' => 'thegem-blog-justified')),
					array('media' => '(max-width: 992px)', 'srcset' => array('1x' => 'thegem-blog-justified-4x', '2x' => 'thegem-blog-justified')),
					array('media' => '(max-width: 1125px)', 'srcset' => array('1x' => 'thegem-blog-justified-3x-small', '2x' => 'thegem-blog-justified')),
					array('media' => '(max-width: 1920px)', 'srcset' => array('1x' => 'thegem-blog-justified-4x', '2x' => 'thegem-blog-justified'))
				);
			}
		}

		$thegem_featured_content = thegem_get_post_featured_content(get_the_ID(), $has_content_gallery ? $thegem_post_gallery_size : 'thegem-blog-justified', false, $thegem_sources);
	}

	if ($blog_style == 'justified-3x'){
		if (is_sticky() && !is_paged())
			$thegem_classes = array_merge($thegem_classes, array('col-lg-8', 'col-md-8', 'col-sm-6', 'col-xs-12', 'inline-column'));
		else
			$thegem_classes = array_merge($thegem_classes, array('col-lg-4', 'col-md-4', 'col-sm-6', 'col-xs-6', 'inline-column'));
	} elseif ($blog_style == 'justified-4x'){
		if (is_sticky() && !is_paged())
			$thegem_classes = array_merge($thegem_classes, array('col-lg-6', 'col-md-6', 'col-sm-12', 'col-xs-12', 'inline-column'));
		else
			$thegem_classes = array_merge($thegem_classes, array('col-lg-3', 'col-md-3', 'col-sm-6', 'col-xs-6', 'inline-column'));
	}

	if(is_sticky() && !is_paged() && empty($thegem_featured_content)) {
		$thegem_classes[] = 'no-image';
	}

	$thegem_classes[] = 'item-animations-not-inited';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class($thegem_classes); ?>>
	<?php if(get_post_format() == 'quote' && $thegem_featured_content) : ?>
		<?php echo $thegem_featured_content; ?>
	<?php else : ?>
		<div class="post-content-wrapper">
		<?php
			if(!is_single() && is_sticky() && !is_paged()) {
				echo '<div class="sticky-label">&#xe61a;</div>';
			}
		?>
		<?php if($thegem_featured_content): ?>
			<div class="post-image"><?php echo $thegem_featured_content; ?></div>
		<?php endif; ?>
		<div class="description">
			<div class="post-meta-conteiner">
				<?php if(!$params['hide_author']) : ?><span class="post-meta-author"><?php printf( esc_html__( "By %s", "thegem" ), get_the_author_link() ) ?></span><?php endif; ?>
				<div class="post-meta-right">
					<?php if(comments_open() && !$params['hide_comments']) : ?>
						<span class="comments-link"><?php comments_popup_link(0, 1, '%'); ?></span>
					<?php endif; ?>
					<?php if( function_exists('zilla_likes') && !$params['hide_likes'] ) { echo '<span class="post-meta-likes">';zilla_likes();echo '</span>'; } ?>
				</div>
			</div>
			<div class="post-title">
				<?php the_title('<div class="entry-title title-h4"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">'.(!$params['hide_date'] ? get_the_date('d M').': ' : '').'<span class="light">', '</span></a></div>'); ?>
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
			<div class="info clearfix">
				<div class="post-footer-sharing"><?php thegem_button(array('icon' => 'share', 'size' => (is_sticky() && !is_paged() ? 'medium' : 'tiny')), 1); ?><div class="sharing-popup"><?php thegem_socials_sharing(); ?><svg class="sharing-styled-arrow"><use xlink:href="<?php echo esc_url(get_template_directory_uri() . '/css/post-arrow.svg'); ?>#dec-post-arrow"></use></svg></div></div>
				<div class="post-read-more"><?php thegem_button(array('href' => get_the_permalink(), 'style' => 'outline', 'text' => __('Read More', 'thegem'), 'size' => (is_sticky() && !is_paged() ? 'medium' : 'tiny')), 1); ?></div>
			</div>
		</div>
	</div>
<?php endif; ?>
</article>
