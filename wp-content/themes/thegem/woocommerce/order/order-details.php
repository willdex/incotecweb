<?php
/**
 * Order details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details.php.
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
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$order = wc_get_order( $order_id );

$show_purchase_note = $order->has_status( apply_filters( 'woocommerce_purchase_note_order_statuses', array( 'completed', 'processing' ) ) );
$show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id();
?>

<div class="row order-order-details">
	<div class="col-xs-12<?php if(!is_account_page()) echo ' col-md-6'; ?> order-details-column">
		<h2 class="woocommerce-order-details__title"><span class="light"><?php _e( 'Order details', 'woocommerce' ); ?></span></h2>
		<div class="gem-table">
			<table class="woocommerce-table woocommerce-table--order-details shop_table order_details">

				<thead>
					<tr>
						<th class="woocommerce-table__product-name product-name" colspan="2"><?php _e( 'Product', 'woocommerce' ); ?></th>
						<th class="product-quantity"><?php _e( 'Quantity', 'woocommerce' ); ?></th>
						<th class="woocommerce-table__product-table product-total"><?php _e( 'Total', 'woocommerce' ); ?></th>
					</tr>
				</thead>

				<tbody>
					<?php
						foreach( $order->get_items() as $item_id => $item ) {
							$product = apply_filters( 'woocommerce_order_item_product', $item->get_product(), $item );

							wc_get_template( 'order/order-details-item.php', array(
								'order'   => $order,
								'item_id' => $item_id,
								'item'    => $item,
								'show_purchase_note'	=> $show_purchase_note,
						'purchase_note'	     => $product ? $product->get_purchase_note() : '',
								'product'				=> $product,
							) );
						}
					?>
					<?php do_action( 'woocommerce_order_items_table', $order ); ?>
				</tbody>
			</table>
		</div>
	</div>

	<div class="col-sm-12 <?php if(!is_account_page()) echo ' col-md-6'; ?> order-details-column">
		<h2><span class="light"><?php _e( 'Cart totals', 'woocommerce' ); ?></span></h2>
		<div class="cart_totals">
			<table>
				<tbody cellspacing="0">
					<?php foreach ( $order->get_order_item_totals() as $key => $total ) : ?>
						<tr>
							<th scope="row" colspan="2"><?php echo $total['label']; ?></th>
							<td colspan="2"><?php echo $total['value']; ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php do_action( 'woocommerce_order_details_after_order_table', $order ); ?>

<?php if ( $show_customer_details ) : ?>
<?php wc_get_template( 'order/order-details-customer.php', array( 'order' =>  $order ) ); ?>
<?php endif; ?>
