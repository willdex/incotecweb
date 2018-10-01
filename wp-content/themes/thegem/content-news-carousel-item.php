<?php

$thegem_classes = array('gem-news-item');

if ($params['effects_enabled'])
	$thegem_classes[] = 'lazy-loading-item';

?>
<article id="post-<?php the_ID(); ?>" <?php post_class($thegem_classes); ?> <?php if(!empty($params['effects_enabled'])): ?>data-ll-effect="drop-bottom"<?php endif; ?> >
	<div class="gem-news-item-left">
		<div class="gem-news-item-image">
			<a href="<?php echo esc_url(get_permalink()); ?>"><?php thegem_post_thumbnail('thegem-news-carousel'); ?></a>
		</div>
	</div>


	<div class="gem-news-item-right">
		<div class="gem-news-item-right-conteiner">
		<?php the_title('<div class="gem-news-item-title"><a href="'.esc_url(get_permalink()).'">', '</a></div>'); ?>

			<?php if(has_excerpt()) : ?>
				<div class='gem-news_title-excerpt'>
					<?php the_excerpt(); ?>
				</div>
			<?php else : ?>
				<div class='gem-news_title_excerpt'>
					<?php
						$thegem_item_title_data = thegem_get_sanitize_page_title_data(get_the_ID());

						echo $thegem_item_title_data['title_excerpt'];
					?>
				</div>
			<?php endif; ?>
		</div>
		<div  class="gem-news-item-meta">
			<div class="gem-news-item-date small-body"><?php echo get_the_date(); ?></div>
			<div class="gem-news-zilla-likes">
				<?php if( function_exists('zilla_likes') ) { echo '<span class="post-meta-likes">';zilla_likes();echo '</span>'; } ?>
				<?php if(comments_open()): ?>
					<span class="comments-link"><?php comments_popup_link(0, 1, '%'); ?></span>
				<?php endif; ?>
			</div>
		</div>

	</div>


</article>