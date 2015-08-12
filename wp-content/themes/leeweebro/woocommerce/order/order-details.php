<?php
/**
 * Order details
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

$order = new WC_Order( $order_id );
?>
<h2><?php _e( 'Order Details', 'woocommerce' ); ?></h2>

<div class="myorder-container shop_table order_details">
	<div class="row">
		<div class="col-md-12">
			<div class="row myorder-heading">
				<div class="col-md-5 product-name"><h5><?php _e( 'Product', 'woocommerce' ); ?></h5></div>
				<div class="col-md-5 product-total"><h5><?php _e( 'Total', 'woocommerce' ); ?></h5></div>
			</div>
			<div class="myorder-content">
				<?php
				if ( sizeof( $order->get_items() ) > 0 ) {

					foreach( $order->get_items() as $item ) {
						$_product     = apply_filters( 'woocommerce_order_item_product', $order->get_product_from_item( $item ), $item );
						$item_meta    = new WC_Order_Item_Meta( $item['item_meta'], $_product );

						?>
						<div class="row <?php echo esc_attr( apply_filters( 'woocommerce_order_item_class', 'order_item', $item, $order ) ); ?>">
							<div class="col-md-5 product-name">
								<?php
									if ( $_product && ! $_product->is_visible() )
										echo apply_filters( 'woocommerce_order_item_name', $item['name'], $item );
									else
										echo apply_filters( 'woocommerce_order_item_name', sprintf( '<a href="%s">%s</a>', get_permalink( $item['product_id'] ), $item['name'] ), $item );

									echo apply_filters( 'woocommerce_order_item_quantity_html', ' <strong class="product-quantity">' . sprintf( '&times; %s', $item['qty'] ) . '</strong>', $item );

									$item_meta->display();

									if ( $_product && $_product->exists() && $_product->is_downloadable() && $order->is_download_permitted() ) {

										$download_files = $order->get_item_downloads( $item );
										$i              = 0;
										$links          = array();

										foreach ( $download_files as $download_id => $file ) {
											$i++;

											$links[] = '<small><a href="' . esc_url( $file['download_url'] ) . '">' . sprintf( __( 'Download file%s', 'woocommerce' ), ( count( $download_files ) > 1 ? ' ' . $i . ': ' : ': ' ) ) . esc_html( $file['name'] ) . '</a></small>';
										}

										echo '<br/>' . implode( '<br/>', $links );
									}
								?>
							</div>
							<div class="col-md-5 product-total">
								<?php echo $order->get_formatted_line_subtotal( $item ); ?>
							</div>
						</div>

						<?php

						if ( in_array( $order->status, array( 'processing', 'completed' ) ) && ( $purchase_note = get_post_meta( $_product->id, '_purchase_note', true ) ) ) {
							?>
							<div class="row product-purchase-note">
								<div class="col-md-12">
									<?php echo apply_filters( 'the_content', $purchase_note ); ?>
								</div>
							</div>
							<?php
						}
						?>
						<div class="row">
							<div class="border"></div>	
						</div>
						<?php
					}
				}

				do_action( 'woocommerce_order_items_table', $order );
				?>
			</div>
		</div>
	</div>
</div>

<div class="space20"></div>

<div class="more-order-details">
	<div class="row">
		<div class="col-md-12">
			<?php 
				switch ($order->payment_method_title) {
					case 'Advance payment by cash at outlets':
						$extra_detail = (!empty($order->pay_by_cash_outlet)) ? $order->pay_by_cash_outlet : '';
						break;

					case 'AGD E-Invoice':
						$extra_detail = (!empty($order->agd_event_code_name)) ? $order->agd_event_code_name : '';
						break;

					case 'Interbank Giro':
						$extra_detail = (!empty($order->interbank_giro_order_no)) ? $order->interbank_giro_order_no : '';
						break;
					
					default:
						$extra_detail = '';
						break;
				}
			?>

			<ul>
				<li><span class="paymentby-lbl">Payment By:</span> <?php echo $order->payment_method_title; ?> <?php echo (!empty($extra_detail)) ? '( '.$extra_detail.' )' : '' ; ?></li>
				<li><span class="receivingmode-lbl">Receiving Mode:</span> <?php echo (isset($order->delivery)) ? 'Delivery' : 'Self Collection'; ?></li>
				<?php if(isset($order->collection_area)): ?>
				<li><span class="collectionplace-lbl">Collection Place:</span> <?php echo $order->collection_area; ?></li>
				<li><span class="collectiondate-lbl">Collection Date:</span> <?php echo $order->collection_date_day . '/' . $order->collection_date_month . '/'. $order->collection_date_year; ?></li>
				<li><span class="collectiontime-lbl">Collection Time:</span> <?php echo $order->collection_time; ?></li>
				<?php endif; ?>
				<?php if(isset($order->delivery)): ?>
				<li><span class="deliveryplace-lbl">Delivery Location:</span> <?php echo ($order->delivery=='allotherarea') ? 'All areas excluding Jurong Island & Sentosa' : 'Jurong Island and Sentosa'; ?></li>
				<li><span class="deliverydate-lbl">Delivery Date:</span> <?php echo $order->delivery_date_day . '/' . $order->delivery_date_month . '/'. $order->delivery_date_year; ?></li>
				<li><span class="deliverytime-lbl">Delivery Time:</span> <?php echo $order->delivery_time; ?></li>
				<?php endif; ?>
				<li><span class="deliverytime-lbl">Consumption Time:</span> <?php echo $order->consumption_time_hr . ':'. $order->consumption_time_mm . ':' . $order->consumption_time_am_pm; ?></li>
			</ul>
		</div>
	</div>
</div>

<div class="space20"></div>

<div class="order-details-container">
	<?php do_action( 'woocommerce_order_details_after_order_table', $order ); ?>

	<div class="row">
		<div class="col-md-12">
			<h2><?php _e( 'Customer details', 'woocommerce' ); ?></h2>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<ul>
				<?php
					if ( $order->billing_email ) echo '<li><span class="email-lbl">' . __( 'Email: ', 'woocommerce' ) . '</span><span>' . $order->billing_email . '</span></li>';
					if ( $order->billing_mobile ) echo '<li><span class="telephone-lbl">' . __( 'Mobile: ', 'woocommerce' ) . '</span><span>' . $order->billing_mobile . '</span></li>';

					// Additional customer details hook
					do_action( 'woocommerce_order_details_after_customer_details', $order );
				?>
			</ul>
		</div>
	</div>
	
	<div class="space20"></div>

	<div class="row">
		<div class="col-md-3">
			<h2>BILLING ADDRESS</h2>
			<p class="billing-address">
				<?php
					if ( ! $order->get_formatted_billing_address() ) _e( 'N/A', 'woocommerce' ); else echo $order->get_formatted_billing_address();
				?>
			</p>
		</div>
		<?php if ( get_option( 'woocommerce_ship_to_billing_address_only' ) === 'no' && get_option( 'woocommerce_calc_shipping' ) !== 'no' ) : ?>	

		<div class="col-md-3">
			<h2>DELIVERY ADDRESS:</h2>
			<p class="shipping-address">
				<?php
				if ( ! $order->get_formatted_shipping_address() ) _e( 'N/A', 'woocommerce' ); else echo $order->get_formatted_shipping_address();
				?>
			</p>
		</div>

		<?php endif; ?>
	</div>
	<div class="space30"></div>
	<div class="row">
		<div class="col-md-4">
			<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account','woothemes'); ?>" class="button">Back</a>
		</div>
	</div>
</div>