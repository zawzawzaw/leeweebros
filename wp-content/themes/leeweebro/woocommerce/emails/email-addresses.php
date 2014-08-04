<?php
/**
 * Email Addresses
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

$header_content_h3 = "
	color: " . esc_attr( $base_text ) . ";
	margin:0px;
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

$table_content_p = "
	margin:0px;
  	font-family: 'Open Sans', Verdana, sans-serif;
  	font-weight: 400;
  	font-style: normal;
  	font-size: 13px;
	line-height: 18px;
	color: #603913;
	text-align:left;
";
?>
<table cellspacing="0" cellpadding="0" style="width: 100%; vertical-align: top;" border="0">

	<tr>

		<td valign="top" width="50%">

			<h3 style="<?php echo $header_content_h3; ?>"><?php _e( 'BILLING ADDRESS:', 'woocommerce' ); ?></h3>

			<?php $billing_address = $order->get_billing_address(); $billing_address = explode(',', $billing_address); ?>
			
			<p style="<?php echo $table_content_p; ?>">
			<?php foreach ($billing_address as $key => $billadd) { ?>
				<?php if(is_numeric(trim($billadd))): ?>
					<a href="tel:<?php echo $billadd; ?>" style="color: #603913; text-decoration: none;"><?php echo $billadd; ?></a><br>
				<?php else: ?>
					<?php echo $billadd . '<br>'; ?>
				<?php endif; ?>
			<?php } ?>
			</p>

		</td>

		<?php if ( get_option( 'woocommerce_ship_to_billing_address_only' ) === 'no' && ( $shipping = $order->get_shipping_address() ) ) : ?>
	
		<td valign="top" width="50%">

			<h3 style="<?php echo $header_content_h3; ?>"><?php _e( 'DELIVERY ADDRESS:', 'woocommerce' ); ?></h3>

			<?php $shipping_address = explode(',', $shipping); ?>

			<p style="<?php echo $table_content_p; ?>">
			<?php foreach ($shipping_address as $key => $shipadd) { ?>
				<?php if(is_numeric(trim($shipadd))): ?>
					<a href="tel:<?php echo $shipadd; ?>" style="color: #603913; text-decoration: none;"><?php echo $shipadd; ?></a><br>
				<?php else: ?>
					<?php echo $shipadd . '<br>'; ?>
				<?php endif; ?>
			<?php } ?>
			</p>

		</td>

		<?php endif; ?>

	</tr>

</table>