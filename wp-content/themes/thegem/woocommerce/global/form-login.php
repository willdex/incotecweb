<?php
/**
 * Login form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/form-login.php.
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
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( is_user_logged_in() ) {
	return;
}

?>
<form class="woocomerce-form woocommerce-form-login login" method="post" <?php if ( $hidden ) echo 'style="display:none;"'; ?>>

	<?php do_action( 'woocommerce_login_form_start' ); ?>

	<?php if ( $message ) echo wpautop( wptexturize( $message ) ); ?>

	<p class="form-row form-row-first">
		<label for="username"><?php _e( 'Username or email', 'woocommerce' ); ?> <span class="required">*</span></label>
		<input type="text" class="input-text" name="username" id="username" />
	</p>
	<p class="form-row form-row-last">
		<label for="password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
		<input class="input-text" type="password" name="password" id="password" />
	</p>
	<div class="clear"></div>

	<?php do_action( 'woocommerce_login_form' ); ?>

	<div class="form-row inline">
		<?php wp_nonce_field( 'woocommerce-login' ); ?>
		<?php
			thegem_button(array(
				'tag' => 'button',
				'text' => __( 'Login', 'woocommerce' ),
				'style' => 'outline',
				'size' => 'medium',
				'extra_class' => 'checkout-login-button',
				'attributes' => array(
					'type' => 'submit',
					'name' => 'login',
					'value' => esc_attr__( 'Login', 'woocommerce' )
				)
			), true);
		?>
		<input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ) ?>" />
		<span class="checkout-login-remember">
			<input name="rememberme" type="checkbox" id="rememberme" value="forever" class="gem-checkbox" />
			<label for="rememberme" class="inline"> <?php _e( 'Remember me', 'woocommerce' ); ?></label>
		</span>
	</div>

	<p class="lost_password">
		<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', 'woocommerce' ); ?></a>
	</p>

	<div class="clear"></div>

	<?php do_action( 'woocommerce_login_form_end' ); ?>

</form>
