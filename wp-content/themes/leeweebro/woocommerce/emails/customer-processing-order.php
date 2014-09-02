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
	color: #42210b;
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
	text-align:left;
";
$header_content_h2_2 = "
	color: #da0009;
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
	text-align:left;
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
";
?>

<?php do_action('woocommerce_email_header', $email_heading); ?>

<h2 style="<?php echo $header_content_h2; ?>"><?php echo __( 'Order:', 'woocommerce' ) . ' ' . $order->get_order_number(); ?></h2>

<p><strong><?php _e( "Thank you for shopping with Lee Wee & Brothers' Foodstuff Pte Ltd!", 'woocommerce' ); ?></strong></p>

<p><?php _e( "Your order has been received and is now being processed. Your order details are shown below for your reference:", 'woocommerce' ); ?></p>

<?php //do_action( 'woocommerce_email_before_order_table', $order, $sent_to_admin, $plain_text ); ?>

<table cellspacing="0" cellpadding="6" style="width:100%;border:none;margin-bottom:20px;" border="1">
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

<h2 style="<?php echo $header_content_h2_2; ?>"><?php _e( 'Order details:', 'woocommerce' ); ?></h2>

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
<p style="margin:0;"><strong><?php _e( 'Payment By:', 'woocommerce' ); ?></strong> <?php echo $order->payment_method_title; ?> <?php echo (!empty($extra_detail)) ? '( '.$extra_detail.' )' : '' ; ?></p>
<p style="margin-bottom: 20px; margin-top: 0;"><strong><?php _e( 'Receiving By:', 'woocommerce' ); ?></strong> <?php echo (isset($order->delivery)) ? 'Delivery' : 'Self Collection'; ?></p>
<?php if(isset($order->collection_area)): ?>
<p><span class="collectionplace-lbl">Collection Place:</span> <?php echo $order->collection_area; ?></p>
<p><span class="collectiondate-lbl">Collection Date:</span> <?php echo $order->collection_date_day . '/' . $order->collection_date_month . '/'. $order->collection_date_year; ?></p>
<p><span class="collectiontime-lbl">Collection Time:</span> <?php echo $order->collection_time; ?></p>
<?php endif; ?>
<?php if(isset($order->delivery)): ?>
<p><span class="deliveryplace-lbl">Delivery Location:</span> <?php echo ($order->delivery=='allotherarea') ? 'All areas excluding Jurong Island & Sentosa' : 'Jurong Island and Sentosa'; ?></p>
<p><span class="deliverydate-lbl">Delivery Date:</span> <?php echo $order->delivery_date_day . '/' . $order->delivery_date_month . '/'. $order->delivery_date_year; ?></p>
<p><span class="deliverytime-lbl">Delivery Time:</span> <?php echo $order->delivery_time; ?></p>
<?php endif; ?>

<?php wc_get_template( 'emails/email-addresses.php', array( 'order' => $order ) ); ?>

<p><?php _e( "You can review your order and download your invoice from the <strong>\"Order history\"</strong> section of your customer account by clicking <strong>\"My account\"</strong> on our website.", 'woocommerce' ); ?></p>

<?php do_action( 'woocommerce_email_footer' ); ?>