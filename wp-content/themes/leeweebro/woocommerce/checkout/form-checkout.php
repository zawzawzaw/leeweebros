<?php
/**
 * Checkout Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

wc_print_notices();

?>

<div class="progress-indicator-container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="row">
				<div class="col-md-12">
					<ul class="progress-indicator">
						<li class="first">
							<div class="circle-holder">
								<div class="circle-text">LOGIN</div>
								<div class="circle done"></div>
							</div>
						</li>
						<li class="second">
							<div class="circle-holder">
								<div class="circle-text">SUMMARY</div>
								<div class="circle done"></div>
							</div>
						</li>
						<li class="third">
							<div class="circle-holder">
								<div class="circle-text">RECEVING MODE</div>
								<div class="circle done"></div>
							</div>
						</li>
						<li class="fourth">
							<div class="circle-holder">
								<div class="circle-text">ADDRESS</div>
								<div class="circle done"></div>
							</div>
						</li>
						<li class="fifth">
							<div class="circle-holder">
								<div class="circle-text active">PAYMENT</div>
								<div class="circle done"></div>
							</div>
						</li>
						<li class="sixth">
							<div class="circle-holder">
								<div class="circle-text">TERMS OF SERVICE</div>
								<div class="circle"></div>
							</div>
						</li>
						<li class="seventh">
							<div class="circle-holder">
								<div class="circle-text">SUBMISSION</div>
								<div class="circle"></div>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="space50"></div>
<div class="payment-mode delivery-container">
	<div class="row">
		<div class="col-md-12">
			<h2>PAYMENT MODE:</h2>
			<p>Please kindly select the choice of payment mode below.</p>
			<ul class="payment-method">
				<li>
					<input type="radio" name="paymentmethod" id="paymentmode" value="Personal Payment" >
					<label for="atm" class="radio-label"><span class="radiobtn"></span>Personal Payment</label>
				</li>
				<li>
					<input type="radio" name="paymentmethod" id="paymentmode" value="Corporate Payment" checked>
					<label for="online" class="radio-label"><span class="radiobtn"></span>Corporate Payment</label>
				</li>
			</ul>
		</div>
	</div>
	<div class="space50"></div>
	<div class="row">
		<!-- <div class="col-md-2"><button class="button">PREVIOUS</button></div> -->
		<div class="col-md-2 col-md-offset-8"><button class="button payment-mode-next">NEXT</button></div>
	</div>			
</div>

<div class="personal-payment delivery-container" style="display:none;">
	<div class="row">
		<div class="col-md-12">
			<h2>PERSONAL PAYMENT METHODS:</h2>
			<ul class="payment-method">
				<li>
					<input type="radio" name="personal_payment_method" value="Cash on delivery" checked>
					<label for="atm" class="radio-label"><span class="radiobtn"></span>Cash on delivery</label>
				</li>
				<li>
					<input type="radio" name="personal_payment_method" value="Advance payment by internet funds transfer/ATM">
					<label for="online" class="radio-label"><span class="radiobtn"></span>Advance payment by internet funds transfer/ATM</label>
				</li>
				<li>
					<input type="radio" name="personal_payment_method" value="Advance payment by cash at outlets">
					<label for="online" class="radio-label"><span class="radiobtn"></span>Advance payment by cash at outlets:</label>
					<div class="dropdown">
						<select name="outlets">
							<option value="Central Kitchen" selected>Central Kitchen</option>
							<option value="Raffles City Shopping Centre">Raffles City Shopping Centre</option>
							<option value="Tampines Mall">Tampines Mall</option>
							<option value="NEX Serangoon">NEX Serangoon</option>
						</select>
					</div>
				</li>
			</ul>
		</div>
	</div>
	<div class="space50"></div>
	<div class="row">
		<div class="col-md-2"><button class="button personal-payment-save">SAVE</button></div>
	</div>	
</div>

<div class="corporate-payment delivery-container" style="display:none;">
	<div class="row">
		<div class="col-md-12">
			<h2>CORPORATE PAYMENT METHODS:</h2>
			<ul class="payment-method">
				<li>
					<input type="radio" name="corporate_payment_method" value="Cash on delivery" checked>
					<label for="atm" class="radio-label"><span class="radiobtn"></span>Cash on delivery</label>
				</li>
				<li>
					<input type="radio" name="corporate_payment_method" value="Corporate cheque" >
					<label for="atm" class="radio-label"><span class="radiobtn"></span>Corporate cheque</label>
				</li>
				<li>
					<input type="radio" name="corporate_payment_method" value="Credit Terms" >
					<label for="atm" class="radio-label"><span class="radiobtn"></span>Credit Terms</label>
				</li>
				<li>
					<input type="radio" name="corporate_payment_method" value="GeBiz" >
					<label for="atm" class="radio-label"><span class="radiobtn"></span>GeBiz</label>
				</li>
				<li>
					<input type="radio" name="corporate_payment_method" value="AGD E-Invoice. Input blank field for: event name/code">
					<label for="online" class="radio-label"><span class="radiobtn"></span>AGD E-Invoice. Input blank field for: event name/code</label>
					<input type="text" name="einvoice">
				</li>
				<li>
					<input type="radio" name="corporate_payment_method" value="Interbank Giro">
					<label for="online" class="radio-label"><span class="radiobtn"></span>Interbank Giro:</label>
					<input type="text" name="interbankgiro">
				</li>
			</ul>
		</div>
	</div>
	<div class="space50"></div>
	<div class="row">
		<div class="col-md-2"><button class="button corporate-payment-save">SAVE</button></div>
	</div>	
</div>

<div class="cart-container summary-container" style="display:none;">
	<?php

	do_action( 'woocommerce_before_checkout_form', $checkout );

	// If checkout registration is disabled and not logged in, the user cannot checkout
	if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
		echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) );
		return;
	}

	// filter hook for include new pages inside the payment method
	$get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', WC()->cart->get_checkout_url() ); ?>

	<form name="checkout" method="post" class="checkout" action="<?php echo esc_url( $get_checkout_url ); ?>">

		<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>

			<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

			<div class="col2-set" id="customer_details">

				<div class="col-1">

					<?php do_action( 'woocommerce_checkout_billing' ); ?>

				</div>

				<div class="col-2">

					<?php do_action( 'woocommerce_checkout_shipping' ); ?>

				</div>

			</div>

			<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

			<!-- <h3 id="order_review_heading"><?php _e( 'Your order', 'woocommerce' ); ?></h3> -->

		<?php endif; ?>

		<?php do_action( 'woocommerce_checkout_order_review' ); ?>

	</form>

	<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
</div>

<div class="order-details-container" style="display:none;">
	<div class="row">
		<div class="col-md-12">
			<h3>ORDER DETAILS</h3>
		</div>
	</div>
	<div class="space10"></div>
	<div class="row">
		<div class="col-md-12">
			<?php $receiving_mode = json_decode(stripslashes($_POST['receiving_mode']), true); ?>
			<ul>
				<li><span class="paymentby-lbl">Payment By:</span> <span class="paymentby-value"></span></li>
				<li><span class="collectionby-lbl">Collection By:</span> <span class="collectionby-value"><?php echo (!empty($receiving_mode['collection_area'])) ? 'Collection' : 'Delivery'; ?></span></li>
			</ul>
		</div>
	</div>
	<div class="space10"></div>
	<div class="row">
		<div class="col-md-2">
			<h4><?php _e( 'BILLIN ADDRESS:', 'woocommerce' ); ?></h4>
			<?php $billing_address = json_decode(stripslashes($_POST['billing_address']), true); ?>
			<p class="billing-address">
				<span class="name"><?php echo $billing_address['first_name'] . ' ' . $billing_address['last_name']; ?></span><br>
				<span class="address-1"><?php echo $billing_address['address_1']; ?></span><br>
				<span class="address-2"><?php echo $billing_address['address_2']; ?></span><br>
				<span class="country"><?php echo $billing_address['country']; ?></span><span class="postcode"><?php echo $billing_address['postcode']; ?></span>
			</p>
		</div>
		<div class="col-md-2">
			<h4><?php _e( 'DELIVERY ADDRESS:', 'woocommerce' ); ?></h4>
			<?php $shipping_address = json_decode(stripslashes($_POST['shipping_address']), true); ?>
			<p class="shipping-address">
				<span class="name"><?php echo $shipping_address['first_name'] . ' ' . $shipping_address['last_name']; ?></span><br>
				<span class="address-1"><?php echo $shipping_address['address_1']; ?></span><br>
				<span class="address-2"><?php echo $shipping_address['address_2']; ?></span><br>
				<span class="country"><?php echo $shipping_address['country']; ?></span><span class="postcode"><?php echo $shipping_address['postcode']; ?></span>
			</p>
		</div>
	</div>
	<div class="space40"></div>
	<div class="row">
		<div class="col-md-7">
			<p class="note">You can review your order and download your invoice from the <span class="quote">"Order history"</span> section of your customer account by clicking <span class="quote">"My account"</span> on our shop.</p>
			<p class="note">If you have a guest account, you can follow your order via the <span class="quote">"Guest Tracking"</span> section on our shop.</p>
		</div>
	</div>
	<div class="space30"></div>
	<div class="row">
		<div class="col-md-4">
			<button class="button">PREVIOUS</button>
		</div>
		<div class="col-md-2 col-md-offset-6">
			<button id="confirm-order" class="button continue">CONFIRM ORDER</button>
		</div>
	</div>
</div>