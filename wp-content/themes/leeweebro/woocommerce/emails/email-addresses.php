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
<table cellspacing="0" cellpadding="0" style="width: 100%; vertical-align: top;" border="0">

	<tr>

		<td valign="top" width="50%">

			<h3 style="<?php echo $header_content_h3; ?>"><?php _e( 'Billing address', 'woocommerce' ); ?></h3>

			<p><?php echo $order->get_formatted_billing_address(); ?></p>

		</td>

		<?php if ( get_option( 'woocommerce_ship_to_billing_address_only' ) === 'no' && ( $shipping = $order->get_formatted_shipping_address() ) ) : ?>

		<td valign="top" width="50%">

			<h3 style="<?php echo $header_content_h3; ?>"><?php _e( 'Delivery address', 'woocommerce' ); ?></h3>

			<p><?php echo $shipping; ?></p>

		</td>

		<?php endif; ?>

	</tr>

</table>