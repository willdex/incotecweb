<?php
/**
 * Template Name: Woocommerce
 * The Woocommerce template file
 * @package TheGem
 */

	$thegem_item_data = array(
		'sidebar_position' => '',
		'sidebar_sticky' => '',
		'effects_no_bottom_margin' => 0,
		'effects_no_top_margin' => 0,
		'slideshow_type' => '',
		'slideshow_slideshow' => '',
		'slideshow_layerslider' => '',
		'slideshow_revslider' => '',
	);
	$thegem_page_id = wc_get_page_id('shop');
	if(is_product()) {
		$thegem_page_id = get_the_ID();
	}
	$thegem_item_data = thegem_get_post_data($thegem_item_data, 'page', $thegem_page_id);

	$thegem_no_margins_block = '';
	if($thegem_item_data['effects_no_bottom_margin']) {
		$thegem_no_margins_block .= ' no-bottom-margin';
	}
	if($thegem_item_data['effects_no_top_margin']) {
		$thegem_no_margins_block .= ' no-top-margin';
	}

	$thegem_sidebar_stiky = $thegem_item_data['sidebar_sticky'] ? 1 : 0;
	$thegem_sidebar_position = thegem_check_array_value(array('', 'left', 'right'), $thegem_item_data['sidebar_position'], '');
	$thegem_panel_classes = array('panel', 'row');
	$thegem_center_classes = 'panel-center';
	$thegem_sidebar_classes = '';

	if(is_active_sidebar('shop-sidebar') && $thegem_sidebar_position) {
		$thegem_panel_classes[] = 'panel-sidebar-position-'.$thegem_sidebar_position;
		$thegem_panel_classes[] = 'with-sidebar';
		$thegem_center_classes .= ' col-lg-9 col-md-9 col-sm-12';
		if($thegem_sidebar_position == 'left') {
			$thegem_center_classes .= ' col-md-push-3 col-sm-push-0';
			$thegem_sidebar_classes .= ' col-md-pull-9 col-sm-pull-0';
		}
	} else {
		$thegem_center_classes .= ' col-xs-12';
	}
	if($thegem_sidebar_stiky) {
		$thegem_panel_classes[] = 'panel-sidebar-sticky';
	}

get_header();

?>

<div id="main-content" class="main-content">

<?php
	if($thegem_item_data['slideshow_type']) {
		thegem_slideshow_block(array('slideshow_type' => $thegem_item_data['slideshow_type'], 'slideshow' => $thegem_item_data['slideshow_slideshow'], 'lslider' => $thegem_item_data['slideshow_layerslider'], 'slider' => $thegem_item_data['slideshow_revslider']));
	}
?>

<?php echo thegem_page_title(); ?>
	<div class="block-content<?php echo esc_attr($thegem_no_margins_block); ?>">
		<div class="container">
			<div class="<?php echo esc_attr(implode(' ', $thegem_panel_classes)); ?>">
				<div class="<?php echo esc_attr($thegem_center_classes); ?>">
					<?php woocommerce_content(); ?>
				</div>

				<?php
					if(is_active_sidebar('shop-sidebar') && $thegem_sidebar_position) {
						echo '<div class="sidebar col-lg-3 col-md-3 col-sm-12'.esc_attr($thegem_sidebar_classes).' '.esc_attr($thegem_sidebar_position).'" role="complementary">';
						get_sidebar('shop');
						echo '</div><!-- .sidebar -->';
					}
				?>
			</div>
			<?php if(is_product()) {
				do_action('thegem_woocommerce_after_single_product');
			} ?>
		</div>
	</div>
	<?php get_sidebar('shop-bottom'); ?>
</div><!-- #main-content -->

<?php
get_footer();