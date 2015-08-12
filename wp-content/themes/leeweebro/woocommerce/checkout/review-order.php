<?php
/**
 * Review order form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.8
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php if ( ! is_ajax() ) : ?><div id="order_review" class="row order-item-data"><?php endif; ?>

	<div class="col-md-12">
		<div class="row cart-heading">
			<div class="col-md-1"><h5 class="ref"><?php _e( 'REF.', 'woocommerce' ); ?></h5></div>
			<div class="col-md-2"><h5 class="category"><?php _e( 'CATEGORY', 'woocommerce' ); ?></h5></div>
			<div class="col-md-3"><h5 class="prod"><?php _e( 'PRODUCT', 'woocommerce' ); ?></h5></div>
			<div class="col-md-2"><h5 class="qty"><?php _e( 'QUANTITY', 'woocommerce' ); ?></h5></div>
			<div class="col-md-2"><h5 class="price"><?php _e( 'UNIT PRICE', 'woocommerce' ); ?></h5></div>
			<div class="col-md-2"><h5 class="totalprice"><?php _e( 'TOTAL PRICE', 'woocommerce' ); ?></h5></div>
		</div>
	
		<div class="cart-content">
			<?php
				do_action( 'woocommerce_review_order_before_cart_contents' );
				$i = 0;
				foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
					$i++;
					$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

					if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
						$terms = get_the_terms( $_product->post->ID, 'product_cat' );
						?>
						<div class="row <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
							<div class="col-md-1"><?php echo $i; ?></div>
							<div class="col-md-2"><p><?php echo (isset($terms[0]->name)) ? $terms[0]->name : ''; ?></p></div>
							<div class="col-md-3"><h5><?php echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ); ?></h5><p class="status"><?php echo ($_product->variation_data['attribute_cooked']) ? "Cooked or Uncooked: " . ucfirst($_product->variation_data['attribute_cooked']) : ''; ?></p></div>
							<div class="col-md-1">
								<p class="qty"><?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', ' <strong class="product-quantity">' . sprintf( '%s', $cart_item['quantity'] ) . '</strong>', $cart_item, $cart_item_key ); ?></p>
							</div>
							<div class="col-md-2 col-md-offset-1"><p class="price">$<?php echo (!empty($_product->sale_price)) ? $_product->sale_price : $_product->regular_price; ?></p></div>
							<div class="col-md-2"><p class="price"><?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?></p></div>
						</div>
						<div class="row">
							<div class="border"></div>	
						</div>
						<?php
					}
				}

				do_action( 'woocommerce_review_order_after_cart_contents' );
			?>
			<div class="row">
				<div class="col-xs-7 col-sm-7 col-md-4 col-md-offset-5">
					<p class="sub-total-lbl"><?php _e( 'Total Products:', 'woocommerce' ); ?></p>
					<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
					<p class="delivery-charge-lbl"><?php _e( 'Delivery Surcharge:', 'woocommerce' ); ?></p>
					<?php endforeach; ?>
					<?php foreach ( WC()->cart->get_coupons( 'order' ) as $code => $coupon ) : ?>
						<?php if(!empty($code)): ?>
							<p class="delivery-charge-lbl"><?php _e( 'Coupon Discount ('.$code.'):', 'woocommerce' ); ?></p>
						<?php endif; ?>
					<?php endforeach; ?>
				</div>
				<div class="col-xs-5 col-sm-5 col-md-2 col-md-offset-1">
					<p class="sub-total"><?php wc_cart_totals_subtotal_html(); ?></p>			
					<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
						<p class="delivery-charge"><?php wc_cart_totals_fee_html( $fee ); ?></p>
					<?php endforeach; ?>
					<?php foreach ( WC()->cart->get_coupons( 'order' ) as $code => $coupon ) : ?>
						<p style="margin-left: -4px;"><?php wc_cart_totals_coupon_html( $coupon ); ?></p>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="row">
				<div class="border"></div>	
			</div>
			<div class="row">
				<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>
				<div class="col-xs-7 col-sm-7 col-md-2 col-md-offset-7">
					<p class="payable-total-lbl"><?php _e( 'Payable', 'woocommerce' ); ?></p>
				</div>
				<div class="col-xs-5 col-sm-5 col-md-2 col-md-offset-1">
					<p class="payable-total"><?php wc_cart_totals_order_total_html(); ?></p>
				</div>
				<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>
			</div>
			<div class="row">
				<div class="border"></div>	
			</div>
		</div>
	</div>

	<!-- <table class="shop_table">
		<thead>
			<tr>
				<th class="product-name"><?php _e( 'Product', 'woocommerce' ); ?></th>
				<th class="product-total"><?php _e( 'Total', 'woocommerce' ); ?></th>
			</tr>
		</thead>
		<tfoot>

			<tr class="cart-subtotal">
				<th><?php _e( 'Cart Subtotal', 'woocommerce' ); ?></th>
				<td><?php wc_cart_totals_subtotal_html(); ?></td>
			</tr>

			<?php foreach ( WC()->cart->get_coupons( 'cart' ) as $code => $coupon ) : ?>
				<tr class="cart-discount coupon-<?php echo esc_attr( $code ); ?>">
					<th><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
					<td><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
				</tr>
			<?php endforeach; ?>

			<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

				<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

				<?php wc_cart_totals_shipping_html(); ?>

				<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

			<?php endif; ?>

			<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
				<tr class="fee">
					<th><?php echo esc_html( $fee->name ); ?></th>
					<td><?php wc_cart_totals_fee_html( $fee ); ?></td>
				</tr>
			<?php endforeach; ?>

			<?php if ( WC()->cart->tax_display_cart === 'excl' ) : ?>
				<?php if ( get_option( 'woocommerce_tax_total_display' ) === 'itemized' ) : ?>
					<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
						<tr class="tax-rate tax-rate-<?php echo sanitize_title( $code ); ?>">
							<th><?php echo esc_html( $tax->label ); ?></th>
							<td><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
						</tr>
					<?php endforeach; ?>
				<?php else : ?>
					<tr class="tax-total">
						<th><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></th>
						<td><?php echo wc_price( WC()->cart->get_taxes_total() ); ?></td>
					</tr>
				<?php endif; ?>
			<?php endif; ?>

			<?php foreach ( WC()->cart->get_coupons( 'order' ) as $code => $coupon ) : ?>
				<tr class="order-discount coupon-<?php echo esc_attr( $code ); ?>">
					<th><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
					<td><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
				</tr>
			<?php endforeach; ?>

			<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

			<tr class="order-total">
				<th><?php _e( 'Order Total', 'woocommerce' ); ?></th>
				<td><?php wc_cart_totals_order_total_html(); ?></td>
			</tr>

			<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>

		</tfoot>
		<tbody>
			<?php
				do_action( 'woocommerce_review_order_before_cart_contents' );

				foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
					$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

					if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
						?>
						<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
							<td class="product-name">
								<?php echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ); ?>
								<?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', ' <strong class="product-quantity">' . sprintf( '&times; %s', $cart_item['quantity'] ) . '</strong>', $cart_item, $cart_item_key ); ?>
								<?php echo WC()->cart->get_item_data( $cart_item ); ?>
							</td>
							<td class="product-total">
								<?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?>
							</td>
						</tr>
						<?php
					}
				}

				do_action( 'woocommerce_review_order_after_cart_contents' );
			?>
		</tbody>
	</table> -->

	<?php do_action( 'woocommerce_review_order_before_payment' ); ?>

	<div id="payment" style="display:none;">
		<?php if ( WC()->cart->needs_payment() ) : ?>
		<ul class="payment_methods methods">
			<?php
				$available_gateways = WC()->payment_gateways->get_available_payment_gateways();
				if ( ! empty( $available_gateways ) ) {

					// Chosen Method
					if ( isset( WC()->session->chosen_payment_method ) && isset( $available_gateways[ WC()->session->chosen_payment_method ] ) ) {
						$available_gateways[ WC()->session->chosen_payment_method ]->set_current();
					} elseif ( isset( $available_gateways[ get_option( 'woocommerce_default_gateway' ) ] ) ) {
						$available_gateways[ get_option( 'woocommerce_default_gateway' ) ]->set_current();
					} else {
						current( $available_gateways )->set_current();
					}

					foreach ( $available_gateways as $gateway ) {
						?>
						<li class="payment_method_<?php echo $gateway->id; ?>">
							<input id="payment_method_<?php echo $gateway->id; ?>" type="radio" class="input-radio" name="payment_method" value="<?php echo esc_attr( $gateway->id ); ?>" <?php checked( $gateway->chosen, true ); ?> data-order_button_text="<?php echo esc_attr( $gateway->order_button_text ); ?>" />
							<label for="payment_method_<?php echo $gateway->id; ?>"><?php echo $gateway->get_title(); ?> <?php echo $gateway->get_icon(); ?></label>
							<?php
								if ( $gateway->has_fields() || $gateway->get_description() ) :
									echo '<div class="payment_box payment_method_' . $gateway->id . '" ' . ( $gateway->chosen ? '' : 'style="display:none;"' ) . '>';
									$gateway->payment_fields();
									echo '</div>';
								endif;
							?>
						</li>
						<?php
					}
				} else {

					if ( ! WC()->customer->get_country() )
						$no_gateways_message = __( 'Please fill in your details above to see available payment methods.', 'woocommerce' );
					else
						$no_gateways_message = __( 'Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce' );

					echo '<p>' . apply_filters( 'woocommerce_no_available_payment_methods_message', $no_gateways_message ) . '</p>';

				}
			?>
		</ul>
		<?php endif; ?>

		<div class="form-row place-order">

			<noscript><?php _e( 'Since your browser does not support JavaScript, or it is disabled, please ensure you click the <em>Update Totals</em> button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'woocommerce' ); ?><br/><input type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="<?php _e( 'Update totals', 'woocommerce' ); ?>" /></noscript>

			<?php wp_nonce_field( 'woocommerce-process_checkout' ); ?>

			<?php do_action( 'woocommerce_review_order_before_submit' ); ?>

			<?php
			$order_button_text = apply_filters( 'woocommerce_order_button_text', __( 'Place order', 'woocommerce' ) );

			echo apply_filters( 'woocommerce_order_button_html', '<input type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '" />' );
			?>

			<?php if ( wc_get_page_id( 'terms' ) > 0 && apply_filters( 'woocommerce_checkout_show_terms', true ) ) { 
				$terms_is_checked = apply_filters( 'woocommerce_terms_is_checked_default', isset( $_POST['terms'] ) );
				?>
				<p class="form-row terms">
					<label for="terms" class="checkbox"><?php printf( __( 'I&rsquo;ve read and accept the <a href="%s" target="_blank">terms &amp; conditions</a>', 'woocommerce' ), esc_url( get_permalink( wc_get_page_id( 'terms' ) ) ) ); ?></label>
					<input type="checkbox" class="input-checkbox" name="terms" <?php checked( $terms_is_checked, true ); ?> id="terms" />
				</p>
			<?php } ?>

			<?php do_action( 'woocommerce_review_order_after_submit' ); ?>

		</div>

		<div class="clear"></div>

	</div>

	<?php do_action( 'woocommerce_review_order_after_payment' ); ?>

<?php if ( ! is_ajax() ) : ?></div><?php endif; ?>