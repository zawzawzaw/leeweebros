<?php
/**
 * Loop Add to Cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;
$min_order = $product->get_attribute( 'min order' );
?>

<?php if ( $product->is_in_stock() ) : ?>

	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

	<form class="cart" method="post" enctype='multipart/form-data'>
		<div class="selectors">
	 		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

		 	<label for="qty">Quantity: </label>
		 	<?php
		 		if ( ! $product->is_sold_individually() )
		 			woocommerce_quantity_input( array(
		 				'min_value' => apply_filters( 'woocommerce_quantity_input_min', 1, $product ),
		 				'max_value' => apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product )
		 			) );
		 	?>
		</div>
		<div class="space20"></div>
		<span id="min-order" style="display:none;"><?php echo (!empty($min_order)) ? $min_order : 1; ?></span>
	 	<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->id ); ?>" />
	 	<button type="submit" class="<?php echo ($product->is_purchasable() && $product->is_in_stock()) ? 'add_to_cart_button' : '' ?> button <?php echo 'product_type_'.esc_attr( $product->product_type ); ?> alt"><?php echo $product->add_to_cart_text(); ?></button>
	 	<!-- <button type="submit" class="<?php echo ($product->is_purchasable() && $product->is_in_stock()) ? 'add_to_cart_btn' : '' ?> <?php echo 'product_type_'.esc_attr( $product->product_type ); ?> button alt"><?php echo $product->add_to_cart_text(); ?></button> -->
	 	<span class="error-msg"></span>
		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	</form>

	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php endif; ?>
