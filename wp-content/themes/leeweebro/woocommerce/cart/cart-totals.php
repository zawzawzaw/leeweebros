<?php
/**
 * Cart totals
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
<div class="row">
	<div class="col-xs-6 col-sm-6 col-md-2 col-md-offset-7">
		<p class="sub-total-label"><?php _e( 'Subtotal:', 'woocommerce' ); ?></p>
	</div>
	<div class="col-xs-6 col-sm-6 col-md-2 col-md-offset-1">
		<p class="sub-total"><?php echo WC()->cart->get_cart_subtotal(); ?></p>
	</div>
</div>

<div class="row">
	<div class="border"></div>	
</div>

<?php 
$subtotal = WC()->cart->subtotal; 

$remaining_jurong_sentosa = 120 - floatval($subtotal);
$remaining_other = 100 - floatval($subtotal);
?>
<?php if($remaining_jurong_sentosa > 0 || $remaining_other > 0): ?>
<div class="row">
	<div class="col-xs-8 col-sm-8 col-md-8 col-md-offset-1">
		<p class="delivery-info">Remaining amount to be added to your cart in order to obtain free delivery</p>
		<?php if($remaining_jurong_sentosa > 0): ?>
			<p class="delivery-info">To Jurong Island or Sentosa:</p>
		<?php endif; ?>
		<?php if($remaining_other > 0): ?>
			<p class="delivery-info">To other parts of Singapore:</p>
		<?php endif; ?>
	</div>
	<div class="col-xs-3 col-sm-3 col-md-2 col-md-offset-1">
		<?php if($remaining_jurong_sentosa > 0): ?>
			<p class="sub-total push-down"><?php if($subtotal < 120): echo 'S$ '.number_format($remaining_jurong_sentosa, 2, '.', ''); else: echo 'S$ '.number_format(0, 2, '.', ''); endif; ?></p>
		<?php endif; ?>
		<?php if($remaining_other > 0): ?>
			<p class="sub-total"><?php if($subtotal < 100): echo 'S$ '.number_format($remaining_other, 2, '.', ''); else: echo 'S$ '.number_format(0, 2, '.', ''); endif; ?></p>
		<?php endif; ?>
	</div>
</div>

<div class="row">
	<div class="border"></div>	
</div>
<?php endif; ?>