<?php
/**
 * The template for displaying the footer
 */

	$id = is_singular() ? get_the_ID() : 0;
	$effects_params = thegem_get_sanitize_page_effects_data($id);
	if($effects_params['effects_parallax_footer']) {
		wp_enqueue_script('thegem-parallax-footer');
	}
?>

		</div><!-- #main -->
		<div id="lazy-loading-point"></div>

		<?php if(!$effects_params['effects_page_scroller'] && !$effects_params['effects_hide_footer']) : ?>
			<?php if($effects_params['effects_parallax_footer']) : ?><div class="parallax-footer"><?php endif; ?>
			<?php if(is_active_sidebar('footer-widget-area')) : ?>
			<footer id="colophon" class="site-footer" role="contentinfo">
				<div class="container">
					<?php get_sidebar('footer'); ?>
				</div>
			</footer><!-- #colophon -->
			<?php endif; ?>

			<?php if(thegem_get_option('footer_active')) : ?>

			<footer id="footer-nav" class="site-footer">
				<div class="container"><div class="row">

					<div class="col-md-3 col-md-push-9">
						<?php
							$socials_icons = array('facebook' => thegem_get_option('facebook_active'), 'linkedin' => thegem_get_option('linkedin_active'), 'twitter' => thegem_get_option('twitter_active'), 'instagram' => thegem_get_option('instagram_active'), 'pinterest' => thegem_get_option('pinterest_active'), 'googleplus' => thegem_get_option('googleplus_active'), 'stumbleupon' => thegem_get_option('stumbleupon_active'), 'rss' => thegem_get_option('rss_active'), 'vimeo' => thegem_get_option('vimeo_active'), 'youtube' => thegem_get_option('youtube_active'), 'flickr' => thegem_get_option('flickr_active'));
							if(in_array(1, $socials_icons)) : ?>
							<div id="footer-socials"><div class="socials inline-inside socials-colored">
									<?php foreach($socials_icons as $name => $active) : ?>
										<?php if($active) : ?>
											<a href="<?php echo esc_url(thegem_get_option($name . '_link')); ?>" target="_blank" title="<?php echo esc_attr($name); ?>" class="socials-item"><i class="socials-item-icon <?php echo esc_attr($name); ?>"></i></a>
										<?php endif; ?>
									<?php endforeach; ?>
									<?php do_action('thegem_footer_socials'); ?>
							</div></div><!-- #footer-socials -->
						<?php endif; ?>
					</div>

					<div class="col-md-4">
						<?php if(has_nav_menu('footer')) : ?>
						<nav id="footer-navigation" class="site-navigation footer-navigation centered-box" role="navigation">
							<?php wp_nav_menu(array('theme_location' => 'footer', 'menu_id' => 'footer-menu', 'menu_class' => 'nav-menu styled clearfix inline-inside', 'container' => false, 'depth' => 1, 'walker' => new thegem_walker_footer_nav_menu)); ?>
						</nav>
						<?php endif; ?>
					</div>



<!-- --------------------- DERECHOS RESERVADOS ----------------------------------------------------- -->



					<div class="col-md-5 col-md-pull-7"><div class="footer-site-info"><?php echo wp_kses_post(do_shortcode(nl2br(stripslashes(thegem_get_option('footer_html'))))); ?> - <a href="http://www.grayhatcorp.com" target="_blank">Desarrolladores</a> </div></div>


<!-- /////////////////////////////////////////////////////////////////////////////////////////////////// -->


				</div></div>
			</footer><!-- #footer-nav -->
			<?php endif; ?>
			<?php if($effects_params['effects_parallax_footer']) : ?></div><!-- .parallax-footer --><?php endif; ?>

		<?php endif; ?>
	</div><!-- #page -->

	<?php wp_footer(); ?>
</body>
</html>
