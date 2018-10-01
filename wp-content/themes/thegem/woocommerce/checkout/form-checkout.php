<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices();

do_action( 'woocommerce_before_checkout_form', $checkout );
wp_enqueue_script('thegem-checkout');
wp_enqueue_script('thegem-woocommerce');


<?php woocommerce_checkout_coupon_form(); ?>

<div class="checkout-steps <?php if(is_user_logged_in()): ?>user-logged<?php endif; ?> clearfix">
	<?php if(is_user_logged_in() || 'no' === get_option( 'woocommerce_enable_checkout_login_reminder' )): ?>
		<div class="checkout-step active" data-tab-id="checkout-billing"><?php esc_html_e('1. Billing','thegem'); ?></div>
		<div class="checkout-step" data-tab-id="checkout-payment"><?php esc_html_e('2. Payment','thegem'); ?></div>
		<div class="checkout-step disabled" data-tab-id="checkout-confirmation"><?php esc_html_e('3. Confirmation','thegem'); ?></div>
	<?php else: ?>
		<div class="checkout-step active" data-tab-id="checkout-signin"><?php esc_html_e('1. Sign in','thegem'); ?></div>
		<div class="checkout-step" data-tab-id="checkout-billing"><?php esc_html_e('2. Billing','thegem'); ?></div>
		<div class="checkout-step" data-tab-id="checkout-payment"><?php esc_html_e('3. Payment','thegem'); ?></div>
		<div class="checkout-step disabled" data-tab-id="checkout-confirmation"><?php esc_html_e('4. Confirmation','thegem'); ?></div>
	<?php endif; ?>
</div>

<?php if(!is_user_logged_in()): ?>
	<div class="checkout-contents clearfix" data-tab-content-id="checkout-signin">
		<div class="row" id="customer_details">
			<div class="col-sm-6 col-xs-12 checkout-login">
				<?php
					do_action( 'woocommerce_before_checkout_form', $checkout );
				?>
			</div>
			<?php if ($checkout->enable_guest_checkout || $checkout->enable_signup): ?>
				<div class="col-sm-6 col-xs-12 checkout-signin">
					<h2><span class="light"><?php esc_html_e('New customer','thegem'); ?></span></h2>
					<?php
						if ($checkout->enable_guest_checkout) {
							thegem_button(array(
								'tag' => 'button',
								'text' => esc_html__( 'checkout as guest', 'thegem' ),
								'style' => 'flat',
								'extra_class' => 'checkout-as-guest',
								'attributes' => array(
									'type' => 'button',
								)
							), true);
						}
					?>
					<?php
						if ($checkout->enable_signup) {
							thegem_button(array(
								'tag' => 'button',
								'text' => esc_html__( 'create an account', 'thegem' ),
								'style' => 'flat',
								'extra_class' => 'checkout-create-account',
								'attributes' => array(
									'type' => 'button',
								)
							), true);
						}
					?>
				</div>
			<?php endif; ?>
		</div>
	</div>
<?php endif; ?>

<form name="checkout" method="post" novalidate class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url ); ?>" enctype="multipart/form-data">

	<?php if ( $checkout->get_checkout_fields() ) : ?>
		<div class="checkout-contents clearfix" data-tab-content-id="checkout-billing">
			<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

			<div class="row" id="customer_details">
				<div class="col-sm-6 col-xs-12">
					<?php do_action( 'woocommerce_checkout_billing' ); ?>
				</div>
				<div class="col-sm-6 col-xs-12">
					<?php do_action( 'woocommerce_checkout_shipping' ); ?>
				</div>
			</div>

			<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

			<div class="checkout-navigation-buttons clearfix">
				<?php
					thegem_button(array(
						'tag' => 'button',
						'text' => esc_html__( 'Previous step', 'thegem' ),
						'style' => 'outline',
						'size' => 'medium',
						'extra_class' => 'checkout-prev-step',
						'attributes' => array(
							'value' => esc_attr__( 'Previous step', 'thegem' ),
							'type' => 'button',
						)
					), true);
				?>
				<?php
					thegem_button(array(
						'tag' => 'button',
						'text' => esc_html__( 'Next step', 'thegem' ),
						'style' => 'outline',
						'size' => 'medium',
						'extra_class' => 'checkout-next-step',
						'attributes' => array(
							'value' => esc_attr__( 'Next step', 'thegem' ),
							'type' => 'button',
						)
					), true);
				?>
			</div>
		</div>
	<?php endif; ?>

	<div class="checkout-contents clearfix" data-tab-content-id="checkout-payment">
		<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

		<h2 id="order_review_heading"><span class="light"><?php _e( 'Your order', 'woocommerce' ); ?></span></h2>

		<div class="gem-table checkout-payment">
			<div id="order_review" class="woocommerce-checkout-review-order">
				<?php do_action( 'woocommerce_checkout_order_review' ); ?>
			</div>
		</div>

		<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
	</div>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>

<script>
(function($) {
	function active_checkout_tab($tab, isinit) {
		if ($tab.length == 0 || ($tab.hasClass('active') && !isinit)) {
			return false;
		}

		$tab.parent().find('.checkout-step').removeClass('active before-active');
		$tab.addClass('active');
		$tab.prev('.checkout-step').addClass('before-active');
		var tab_id = $tab.data('tab-id');
		$('.checkout-contents').removeClass('active');
		$('.checkout-contents[data-tab-content-id="' + tab_id + '"]').addClass('active');
		window.location.hash = '#' + tab_id;
	}

	var m = window.location.hash.match(/#checkout\-(.+)/);
	if (m && $('.checkout-steps .checkout-step[data-tab-id="checkout-' + m[1] + '"]').length == 1) {
		active_checkout_tab($('.checkout-steps .checkout-step[data-tab-id="checkout-' + m[1] + '"]'), true);
	} else {
		active_checkout_tab($('.checkout-steps .checkout-step:first'), true);
	}

	$('.checkout-steps .checkout-step').not('.disabled').click(function() {
		active_checkout_tab($(this), false);
	});
})(jQuery);
</script>
