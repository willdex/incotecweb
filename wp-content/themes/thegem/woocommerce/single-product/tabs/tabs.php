<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );
if ( ! empty( $tabs ) ) :
wp_enqueue_script( 'thegem_tabs_script' );
wp_enqueue_style( 'vc_tta_style' ); ?>

<div class="vc_tta-container woocommerce-tabs wc-tabs-wrapper gem-woocommerce-tabs" data-vc-action="collapse">
	<div class="vc_general vc_tta vc_tta-tabs vc_tta-color-thegem vc_tta-style-classic vc_tta-shape-square vc_tta-spacing-5 vc_tta-tabs-position-top vc_tta-controls-align-left">
		<div class="vc_tta-tabs-container">
			<ul class="vc_tta-tabs-list">
			<?php $is_first = true; foreach ( $tabs as $key => $tab ) : ?>
				<li class="vc_tta-tab<?php if($is_first) { echo ' vc_active'; $is_first= false; } ?>" data-vc-tab><a href="#tab-<?php echo esc_attr( $key ); ?>" data-vc-tabs data-vc-container=".vc_tta"><span class="vc_tta-title-text"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></span></a></li>
			<?php endforeach; ?>
			</ul>
		</div>
		<div class="vc_tta-panels-container">
			<div class="vc_tta-panels">
				<?php $is_first = true; foreach ( $tabs as $key => $tab ) : ?>
				<div class="vc_tta-panel<?php if($is_first) { echo ' vc_active'; $is_first= false; } ?>" id="tab-<?php echo esc_attr( $key ); ?>" data-vc-content=".vc_tta-panel-body">
					<div class="vc_tta-panel-heading"><h4 class="vc_tta-panel-title"><a href="#tab-<?php echo esc_attr( $key ); ?>" data-vc-accordion data-vc-container=".vc_tta-container"><span class="vc_tta-title-text"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></span></a></h4></div>
					<div class="vc_tta-panel-body"><?php call_user_func( $tab['callback'], $key, $tab ); ?></div>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
