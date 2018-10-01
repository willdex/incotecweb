<?php
/**
 * The template for displaying product widget entries
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-widget-product.php.
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
 * @version 2.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product; ?>

<li>
	<?php woocommerce_show_product_loop_sale_flash(); ?>
	<div class="gem-products-image">
		<a href="<?php echo esc_url( $product->get_permalink() ); ?>">
		<?php echo $product->get_image(); ?>
		</a>
	</div>
	<div class="gem-products-content">
		<div class="gem-products-title">
			<a href="<?php echo esc_url( $product->get_permalink() ); ?>" title="<?php echo esc_attr( $product->get_name() ); ?>">
				<?php echo $product->get_name(); ?>
			</a>
		</div>
		<?php if ( ! empty( $show_rating ) ) : ?>
			<div class="gem-products-rating"><?php echo wc_get_rating_html( $product->get_average_rating() ); ?></div>
		<?php endif; ?>
		<div class="gem-products-price styled-subtitle"><?php echo $product->get_price_html(); ?></div>
	</div>
</li>
