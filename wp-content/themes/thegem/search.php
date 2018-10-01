<?php

$thegem_panel_classes = array('panel', 'row');
$thegem_center_classes = 'panel-center col-xs-12';

get_header(); ?>

<div id="main-content" class="main-content">

<?php echo thegem_page_title(); ?>

	<div class="block-content">
		<div class="container">
			<div class="<?php echo esc_attr(implode(' ', $thegem_panel_classes)); ?>">
				<div class="<?php echo esc_attr($thegem_center_classes); ?>">
				<?php
					if ( have_posts() ) {

						if(!is_singular()) {
							$blog_style = '3x';
							$params = array(
								'hide_author' => false,
								'hide_date' => true,
								'hide_comments' => true,
								'hide_likes' => true
							);
							wp_enqueue_style('thegem-blog');
							wp_enqueue_style('thegem-additional-blog');
							wp_enqueue_style('thegem-blog-timeline-new');
							wp_enqueue_style('thegem-animations');
							wp_enqueue_script('imagesloaded');
							wp_enqueue_script('isotope-js');
							wp_enqueue_script('thegem-items-animations');
							wp_enqueue_script('thegem-blog');
							wp_enqueue_script('thegem-gallery');
							wp_enqueue_script('thegem-scroll-monitor');
							echo '<div class="preloader"><div class="preloader-spin"></div></div>';
							echo '<div class="blog blog-style-3x blog-style-masonry">';
						}

						while ( have_posts() ) : the_post();

							include(locate_template(array('gem-templates/blog/content-blog-item-masonry.php', 'content-blog-item.php')));

						endwhile;

						if(!is_singular()) { echo '</div>'; thegem_pagination(); }

					} else {
						get_template_part( 'content', 'none' );
					}
				?>
				</div>
			</div>
		</div><!-- .container -->
	</div><!-- .block-content -->
</div><!-- #main-content -->

<?php
get_footer();
