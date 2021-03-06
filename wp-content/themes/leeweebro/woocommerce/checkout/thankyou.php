<?php
/**
 * Thankyou page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

if ( $order ) : ?>

	<?php if ( in_array( $order->status, array( 'failed' ) ) ) : ?>

		<p><?php _e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction.', 'woocommerce' ); ?></p>

		<p><?php
			if ( is_user_logged_in() )
				_e( 'Please attempt your purchase again or go to your account page.', 'woocommerce' );
			else
				_e( 'Please attempt your purchase again.', 'woocommerce' );
		?></p>

		<p>
			<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php _e( 'Pay', 'woocommerce' ) ?></a>
			<?php if ( is_user_logged_in() ) : ?>
			<a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ); ?>" class="button pay"><?php _e( 'My Account', 'woocommerce' ); ?></a>
			<?php endif; ?>
		</p>

	<?php else : ?>

		<div class="row">
			<div class="col-md-12" id="page-title"><h1><?php _e( 'Thank you. Your order has been submitted.', 'woocommerce' ); ?></h1></div>
		</div>
		<div class="space20"></div>
		<div class="complete-container">
			<div class="row">
				<div class="col-md-9">
					<div class="space10"></div>
					<h2>ORDER: <?php echo $order->get_order_number(); ?></h2>
					<div class="space10"></div>
					<h3>Thank you for shopping with Lee Wee & Brothers' Foodstuff Pte Ltd!</h3>
					<div class="space10"></div>
					<p>You will receive an email acknowledgment shortly at the email address you provided during checkout and our customer service personnel will contact you within 24 hours via telephone to confirm your order.</p>
				</div>
			</div>
			<div class="space50"></div>	
		</div>

		<!-- <ul class="order_details">
			<li class="order">
				<?php _e( 'Order:', 'woocommerce' ); ?>
				<strong><?php echo $order->get_order_number(); ?></strong>
			</li>
			<li class="date">
				<?php _e( 'Date:', 'woocommerce' ); ?>
				<strong><?php echo date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ); ?></strong>
			</li>
			<li class="total">
				<?php _e( 'Total:', 'woocommerce' ); ?>
				<strong><?php echo $order->get_formatted_order_total(); ?></strong>
			</li>
			<?php if ( $order->payment_method_title ) : ?>
			<li class="method">
				<?php _e( 'Payment method:', 'woocommerce' ); ?>
				<strong><?php echo $order->payment_method_title; ?></strong>
			</li>
			<?php endif; ?>
			<li><?php echo get_post_meta( $order->id, 'Collection Area', true ); ?></li>
		</ul> -->
		<div class="clear"></div>

	<?php endif; ?>

	

	<?php //do_action( 'woocommerce_thankyou_' . $order->payment_method, $order->id ); ?>
	<?php //do_action( 'woocommerce_thankyou', $order->id ); ?>

<?php else : ?>

	<p><?php _e( 'Thank you. Your order has been received.', 'woocommerce' ); ?></p>

<?php endif; ?>