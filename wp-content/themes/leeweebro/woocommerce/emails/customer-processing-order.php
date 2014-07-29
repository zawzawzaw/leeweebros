<?php
/**
 * Customer processing order email
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Load colours
$bg 		= get_option( 'woocommerce_email_background_color' );
$body		= get_option( 'woocommerce_email_body_background_color' );
$base 		= get_option( 'woocommerce_email_base_color' );
$base_text 	= wc_light_or_dark( $base, '#202020', '#ffffff' );
$text 		= get_option( 'woocommerce_email_text_color' );

$header_content_h2 = "
	color: " . esc_attr( $base_text ) . ";
	margin:0;
	text-shadow: 0 1px 0 $base_lighter_20;
	display:block;
	font-family: 'Auto1-Bold', Verdana, sans-serif;
  	font-weight: 300;
  	font-style: normal;
	font-size: 17px;
	line-height: 28px;
	text-transform: uppercase;
	display: block;
	color: #42210b;
	text-align:left;
	/*line-height: 150%;*/
";
$header_content_h3 = "
	color: " . esc_attr( $base_text ) . ";
	margin:0;
	text-shadow: 0 1px 0 $base_lighter_20;
	display:block;
	font-family: 'Auto1-Bold', Verdana, sans-serif;
  	font-weight: 300;
  	font-style: normal;
	font-size: 13px;
	line-height: 28px;
	text-transform: uppercase;
	display: block;
	color: #42210b;
	text-align:left;
	/*line-height: 150%;*/
";
?>

<?php do_action('woocommerce_email_header', $email_heading); ?>

<h2 style="<?php echo $header_content_h2; ?>"><?php echo __( 'Order:', 'woocommerce' ) . ' ' . $order->get_order_number(); ?></h2>

<p><strong><?php _e( "Thank you for shopping with Lee Wee & Brothers' Foodstuff Pte Ltd!", 'woocommerce' ); ?></strong></p>

<p><?php _e( "Your order has been received and is now being processed. Your order details are shown below for your reference:", 'woocommerce' ); ?></p>

<?php do_action( 'woocommerce_email_before_order_table', $order, $sent_to_admin, $plain_text ); ?>

<table cellspacing="0" cellpadding="6" style="width: 100%; border: none;" border="1">
	<thead>
		<tr style="background:#da0009;color:white;">
			<th scope="col" style="text-align:left; border: none;"><?php _e( 'Product', 'woocommerce' ); ?></th>
			<th scope="col" style="text-align:left; border: none;"><?php _e( 'Quantity', 'woocommerce' ); ?></th>
			<th scope="col" style="text-align:left; border: none;"><?php _e( 'Price', 'woocommerce' ); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php echo $order->email_order_items_table( $order->is_download_permitted(), true, ( $order->status=='processing' ) ? true : false ); ?>
	</tbody>
	<tfoot>
		<?php
			if ( $totals = $order->get_order_item_totals() ) {
				$i = 0;
				foreach ( $totals as $total ) {
					$i++;
					?><tr>
						<th scope="row" colspan="2" style="text-align:left; border: none; <?php if ( $i == 1 ) echo 'border-top-width: 4px;'; ?>"><?php echo $total['label']; ?></th>
						<td style="text-align:left; border: none; <?php if ( $i == 1 ) echo 'border-top-width: 4px;'; ?>"><?php echo $total['value']; ?></td>
					</tr><?php
				}
			}
		?>
	</tfoot>
</table>

<?php do_action( 'woocommerce_email_after_order_table', $order, $sent_to_admin, $plain_text ); ?>

<?php do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text ); ?>

<h2 style="<?php echo $header_content_h2; ?>"><?php _e( 'Order details:', 'woocommerce' ); ?></h2>

<p><strong><?php _e( 'Payment By:', 'woocommerce' ); ?></strong> <?php echo $order->billing_email; ?></p>
<p><strong><?php _e( 'Collection By:', 'woocommerce' ); ?></strong> <?php echo $order->billing_phone; ?></p>

<?php wc_get_template( 'emails/email-addresses.php', array( 'order' => $order ) ); ?>

<p><?php _e( "You can review your order and download your invoice from the <strong>\"Order history\"</strong> section of your customer account by clicking <strong>\"My account\"</strong> on our shop.", 'woocommerce' ); ?></p>

<p><?php _e( "If you have a guest account, you can follow your order via the \"Guest Tracking\" section on our shop." ) ?></p>

<?php do_action( 'woocommerce_email_footer' ); ?>