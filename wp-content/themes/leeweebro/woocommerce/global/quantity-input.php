<?php
/**
 * Product quantity inputs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
<div class="quantity dropdown">
	<label for="qty">Quantity: </label>
	<select name="<?php echo esc_attr( $input_name ); ?>" id="qty">
		<option value="50"<?php echo (esc_attr( $input_value )==50) ? ' selected="selected"' : ''; ?>>50</option>
		<option value="40"<?php echo (esc_attr( $input_value )==40) ? ' selected="selected"' : ''; ?>>40</option>
		<option value="30"<?php echo (esc_attr( $input_value )==30) ? ' selected="selected"' : ''; ?>>30</option>
		<option value="20"<?php echo (esc_attr( $input_value )==20) ? ' selected="selected"' : ''; ?>>20</option>
		<option value="10"<?php echo (esc_attr( $input_value )==10) ? ' selected="selected"' : ''; ?>>10</option>
	</select>
	<!-- <input type="number" step="<?php echo esc_attr( $step ); ?>" <?php if ( is_numeric( $min_value ) ) : ?>min="<?php echo esc_attr( $min_value ); ?>"<?php endif; ?> <?php if ( is_numeric( $max_value ) ) : ?>max="<?php echo esc_attr( $max_value ); ?>"<?php endif; ?> name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $input_value ); ?>" title="<?php _ex( 'Qty', 'Product quantity input tooltip', 'woocommerce' ) ?>" class="input-text qty text" size="4" /> -->
</div>