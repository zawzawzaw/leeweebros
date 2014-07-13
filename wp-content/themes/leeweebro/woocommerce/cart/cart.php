<?php
/**
 * Cart Page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

if(!empty($_POST))
	woocommerce_get_template( 'cart/cart-new.php' );

// wc_print_notices();

// do_action( 'woocommerce_before_cart' ); ?>

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
								<div class="circle-text active">SUMMARY</div>
								<div class="circle done"></div>
							</div>
						</li>
						<li class="third">
							<div class="circle-holder">
								<div class="circle-text">RECEVING MODE</div>
								<div class="circle"></div>
							</div>
						</li>
						<li class="fourth">
							<div class="circle-holder">
								<div class="circle-text">ADDRESS</div>
								<div class="circle"></div>
							</div>
						</li>
						<li class="fifth">
							<div class="circle-holder">
								<div class="circle-text">PAYMENT</div>
								<div class="circle"></div>
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
<div class="cart-container" <?php echo (isset($_POST)) ? "style='visibility:hidden;'" : ""; ?>>
	<div class="row">
		<div class="col-md-12">

			<form action="" method="post">
			<?php //echo esc_url( WC()->cart->get_cart_url() ); ?>

				<?php do_action( 'woocommerce_before_cart_table' ); ?>

				<div class="row cart-heading">
					<div class="col-md-1"></div>
					<div class="col-md-2"><h5 class="product"><?php _e( 'PRODUCT', 'woocommerce' ); ?></h5></div>
					<div class="col-md-3"><h5 class="desc"><?php _e( 'DESCRIPTION', 'woocommerce' ); ?></h5></div>
					<div class="col-md-2"><h5 class="qty"><?php _e( 'QUANTITY', 'woocommerce' ); ?></h5></div>
					<div class="col-md-2"><h5 class="price"><?php _e( 'UNIT PRICE', 'woocommerce' ); ?></h5></div>
					<div class="col-md-2"><h5 class="totalprice"><?php _e( 'TOTAL PRICE', 'woocommerce' ); ?></h5></div>
				</div>
				<div class="cart-content">

					<?php do_action( 'woocommerce_before_cart_contents' ); ?>
						<?php
						$cart_items = WC()->cart->get_cart();

						foreach ( $cart_items as $cart_item_key => $cart_item ) {
							$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
							$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

							if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
								?>
								<div class="row">

									<!-- delete btn -->
									<div class="col-md-1">
										<div class="remove-button">
										<?php
											echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" class="remove" title="%s"></a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', 'woocommerce' ) ), $cart_item_key );
										?>
										</div>
									</div>

									<!-- thumbnail image -->
									<div class="col-md-2">
										<?php
											$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

											if ( ! $_product->is_visible() )
												echo $thumbnail;
											else
												printf( '<a href="%s">%s</a>', $_product->get_permalink(), $thumbnail );
										?>
									</div>

									<!-- description -->
									<div class="col-md-3">
										<?php
											if ( ! $_product->is_visible() )
												echo apply_filters( 
													'woocommerce_cart_item_name', 
													$_product->get_title(), 
													$cart_item, 
													$cart_item_key 
													);
											else
												echo apply_filters( 
													'woocommerce_cart_item_name', 
													sprintf( 
														'<a href="%s"><h5>%s</h5></a>', 
														$_product->get_permalink(), 
														$_product->get_title() 
													), 
													$cart_item, 
													$cart_item_key );

											// Meta data
											echo WC()->cart->get_item_data( $cart_item );

				               				// Backorder notification
				               				// if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) )
				               				// 	echo '<p class="backorder_notification">' . __( 'Available on backorder', 'woocommerce' ) . '</p>';
										?>
									</div>

									<!-- quantity -->
									<div class="col-md-2">
										<?php
											if ( $_product->is_sold_individually() ) {
												$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
											} else {
												$product_quantity = woocommerce_quantity_input( array(
													'input_name'  => "cart[{$cart_item_key}][qty]",
													'input_value' => $cart_item['quantity'],
													'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
													'min_value'   => '0'
												), $_product, false );
											}

											echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key );
										?>
										<span class="update">
											<input type="submit" class="button" name="update_cart" value="submit" style="" /> 	
										</span>
									</div>

									<!-- indiviudal price -->
									<div class="col-md-2">
										<p class="price">
											<?php
												echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
											?>
										</p>
									</div>

									<!-- sub total price -->
									<div class="col-md-2">
										<p class="price">
											<?php
												echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
											?>
										</p>
									</div>
								</div>

								<?php
								// if end of item don't add border
								end($cart_items);
								if ($cart_item_key !== key($cart_items) ): ?>
								<div class="row">
									<div class="border"></div>	
								</div>
								<?php
								endif;
							}
						}

						do_action( 'woocommerce_cart_contents' );
						?>

						<div class="row">
							<div class="border"></div>	
						</div>

						<?php woocommerce_cart_totals(); ?>

					<?php do_action( 'woocommerce_after_cart_contents' ); ?>
				
				</div><!-- end cart-content -->
				<div class="order-details-container">
					<!-- <div class="row">
						<div class="col-md-12">
							<h3>ORDER DETAILS</h3>
						</div>
					</div>
					<div class="space10"></div>
					<div class="row">
						<div class="col-md-2">
							<h4>BILLIN ADDRESS</h4>
							<p class="billing-address">
								<span class="name">Lui Yiling</span><br>
								<span class="address-1">Blk 289A Bukit Batok</span><br>
								<span class="address-2">St 25 #04-210</span><br>
								<span class="country">Singapore</span><span class="postcode">650289</span>
							</p>
						</div>
						<div class="col-md-2">
							<h4>DELIVERY ADDRESS:</h4>
							<p class="shipping-address">
								<span class="name">Lui Yiling</span><br>
								<span class="address-1">Blk 289A Bukit Batok</span><br>
								<span class="address-2">St 25 #04-210</span><br>
								<span class="country">Singapore</span><span class="postcode">650289</span>
							</p>
						</div>
					</div>-->
					<!-- <div class="space40"></div> 
					<div class="row">
						<div class="col-md-12">
							<h3>PAYMENT METHOD</h3>
							<ul class="payment-method">
								<li>
									<input type="radio" name="paymentmethod" value="online" checked>
									<label for="online" class="radio-label"><span class="radiobtn"></span>Online Funds Transfer</label>
								</li>
								<li>
									<input type="radio" name="paymentmethod" value="atm" >
									<label for="atm" class="radio-label"><span class="radiobtn"></span>ATM Funds Transfer</label>
								</li>
								<li>
									<input type="radio" name="paymentmethod" value="cash" >
									<label for="cash" class="radio-label"><span class="radiobtn"></span>Payment by cash at any of our outlets</label>
								</li>
							</ul>
						</div>
					</div>
					<div class="space40"></div>
					<div class="row">
						<div class="col-md-7">
							<p class="important">Please note that this is not a confirmation. Our Customer Service Personnel will contact you to confirm your order within 24 hours. Alternatively, you may call us at <a href="tel:63859122">63859122</a> for further assistance. Bank transfer account information will be provided upon confirmation of order via our customer service personnel.</p>
						</div>
					</div> -->
					<div class="space30"></div>
					<div class="row">
						
						<div class="col-md-4">
							<a class="button continue wc-backward" href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>"><?php _e( 'CONTINUE SHOPPING', 'woocommerce' ) ?></a>
						</div>
						<div class="col-md-2 col-md-offset-6">
							<!-- <input type="submit" class="checkout-button button alt wc-forward" name="proceed" value="<?php _e( 'NEXT', 'woocommerce' ); ?>" /> -->
							<input type="submit" class="button" value="NEXT">
						</div>

						<?php do_action( 'woocommerce_proceed_to_checkout' ); ?>

						<?php wp_nonce_field( 'woocommerce-cart' ); ?>
					</div>
				</div>

				<?php do_action( 'woocommerce_after_cart_table' ); ?>

			</form>

		</div><!-- end col-md-12 -->
	</div><!-- end row -->
</div><!-- end cart-container -->

<?php do_action( 'woocommerce_after_cart' ); ?>
