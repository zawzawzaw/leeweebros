<?php
/**
 * My Orders
 *
 * Shows recent orders on the account page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$customer_orders = get_posts( apply_filters( 'woocommerce_my_account_my_orders_query', array(
	'numberposts' => $order_count,
	'meta_key'    => '_customer_user',
	'meta_value'  => get_current_user_id(),
	'post_type'   => 'shop_order',
	'post_status' => 'publish'
) ) );

if ( $customer_orders ) : ?>

	<h2><?php echo apply_filters( 'woocommerce_my_account_my_orders_title', __( 'Recent Orders', 'woocommerce' ) ); ?></h2>

	<div class="myorder-container">
		<div class="row">
			<div class="col-md-10">
				<div class="row myorder-heading">
					<div class="col-md-1"><h5 class="ref"><?php _e( 'Order', 'woocommerce' ); ?></h5></div>
					<div class="col-md-2"><h5 class="category"><?php _e( 'Date', 'woocommerce' ); ?></h5></div>
					<div class="col-md-2"><h5 class="prod"><?php _e( 'Status', 'woocommerce' ); ?></h5></div>
					<div class="col-md-3"><h5 class="qty"><?php _e( 'Total', 'woocommerce' ); ?></h5></div>
					<div class="col-md-2"><h5 class="qty"><?php _e( 'Action', 'woocommerce'); ?></h5></div>
				</div>
				<div class="myorder-content">
					<?php
					foreach ( $customer_orders as $customer_order ) {
						$order = new WC_Order();

						$order->populate( $customer_order );

						$status     = get_term_by( 'slug', $order->status, 'shop_order_status' );
						$item_count = $order->get_item_count();

						?>
						<div class="row">
							<div class="col-md-1">
								<?php echo $order->get_order_number(); ?>
								<!-- <a href="<?php echo $order->get_view_order_url(); ?>">
									
								</a> -->
							</div>
							<div class="col-md-2"><p><time datetime="<?php echo date( 'Y-m-d', strtotime( $order->order_date ) ); ?>" title="<?php echo esc_attr( strtotime( $order->order_date ) ); ?>"><?php echo date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ); ?></time></p></div>
							<div class="col-md-2"><?php echo ucfirst( __( $status->name, 'woocommerce' ) ); ?></div>
							<div class="col-md-3">
								<?php echo sprintf( _n( '%s for %s item', '%s for %s items', $item_count, 'woocommerce' ), $order->get_formatted_order_total(), $item_count ); ?>
							</div>
							<div class="col-md-1">
								<?php
									$actions = array();

									if ( in_array( $order->status, apply_filters( 'woocommerce_valid_order_statuses_for_payment', array( 'pending', 'failed' ), $order ) ) ) {
										$actions['pay'] = array(
											'url'  => $order->get_checkout_payment_url(),
											'name' => __( 'Pay', 'woocommerce' )
										);
									}

									if ( in_array( $order->status, apply_filters( 'woocommerce_valid_order_statuses_for_cancel', array( 'pending', 'failed' ), $order ) ) ) {
										$actions['cancel'] = array(
											'url'  => $order->get_cancel_order_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ),
											'name' => __( 'Cancel', 'woocommerce' )
										);
									}

									$actions['view'] = array(
										'url'  => $order->get_view_order_url(),
										'name' => __( 'View', 'woocommerce' )
									);

									$actions = apply_filters( 'woocommerce_my_account_my_orders_actions', $actions, $order );

									if ($actions) {
										foreach ( $actions as $key => $action ) {
											echo '<a href="' . esc_url( $action['url'] ) . '" class="' . sanitize_html_class( $key ) . '">' . esc_html( $action['name'] ) . '</a>';
										}
									}
								?>
							</div>
						</div>
						<div class="row">
							<div class="border"></div>	
						</div>
					<?php
					}
					?>
				</div>
			</div>
		</div>				
	</div>


	<!-- <table class="shop_table my_account_orders">

		<thead>
			<tr>
				<th class="order-number"><span class="nobr"><?php _e( 'Order', 'woocommerce' ); ?></span></th>
				<th class="order-date"><span class="nobr"><?php _e( 'Date', 'woocommerce' ); ?></span></th>
				<th class="order-status"><span class="nobr"><?php _e( 'Status', 'woocommerce' ); ?></span></th>
				<th class="order-total"><span class="nobr"><?php _e( 'Total', 'woocommerce' ); ?></span></th>
				<th class="order-actions">&nbsp;</th>
			</tr>
		</thead>

		<tbody><?php
			foreach ( $customer_orders as $customer_order ) {
				$order = new WC_Order();

				$order->populate( $customer_order );

				$status     = get_term_by( 'slug', $order->status, 'shop_order_status' );
				$item_count = $order->get_item_count();

				?><tr class="order">
					<td class="order-number">
						<a href="<?php echo $order->get_view_order_url(); ?>">
							<?php echo $order->get_order_number(); ?>
						</a>
					</td>
					<td class="order-date">
						<time datetime="<?php echo date( 'Y-m-d', strtotime( $order->order_date ) ); ?>" title="<?php echo esc_attr( strtotime( $order->order_date ) ); ?>"><?php echo date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ); ?></time>
					</td>
					<td class="order-status" style="text-align:left; white-space:nowrap;">
						<?php echo ucfirst( __( $status->name, 'woocommerce' ) ); ?>
					</td>
					<td class="order-total">
						<?php echo sprintf( _n( '%s for %s item', '%s for %s items', $item_count, 'woocommerce' ), $order->get_formatted_order_total(), $item_count ); ?>
					</td>
					<td class="order-actions">
						<?php
							$actions = array();

							if ( in_array( $order->status, apply_filters( 'woocommerce_valid_order_statuses_for_payment', array( 'pending', 'failed' ), $order ) ) ) {
								$actions['pay'] = array(
									'url'  => $order->get_checkout_payment_url(),
									'name' => __( 'Pay', 'woocommerce' )
								);
							}

							if ( in_array( $order->status, apply_filters( 'woocommerce_valid_order_statuses_for_cancel', array( 'pending', 'failed' ), $order ) ) ) {
								$actions['cancel'] = array(
									'url'  => $order->get_cancel_order_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ),
									'name' => __( 'Cancel', 'woocommerce' )
								);
							}

							$actions['view'] = array(
								'url'  => $order->get_view_order_url(),
								'name' => __( 'View', 'woocommerce' )
							);

							$actions = apply_filters( 'woocommerce_my_account_my_orders_actions', $actions, $order );

							if ($actions) {
								foreach ( $actions as $key => $action ) {
									echo '<a href="' . esc_url( $action['url'] ) . '" class="button ' . sanitize_html_class( $key ) . '">' . esc_html( $action['name'] ) . '</a>';
								}
							}
						?>
					</td>
				</tr><?php
			}
		?></tbody>

	</table> -->

<?php endif; ?>
