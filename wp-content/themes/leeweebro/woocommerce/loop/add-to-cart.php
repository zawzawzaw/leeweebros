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
?>

<?php if ( $product->is_in_stock() ) : ?>

	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

	<form class="cart" method="post" enctype='multipart/form-data'>
		<div class="selectors">
	 		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
		 	<div class="select-qty">

		 	<?php
		 		if ( ! $product->is_sold_individually() )
		 			woocommerce_quantity_input( array(
		 				'min_value' => apply_filters( 'woocommerce_quantity_input_min', 1, $product ),
		 				'max_value' => apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product )
		 			) );
		 	?>
			</div>
		</div>
		<div class="space20"></div>
	 	<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->id ); ?>" />
	 	<button type="submit" class="<?php echo ($product->is_purchasable() && $product->is_in_stock()) ? 'add_to_cart_button' : '' ?> button <?php echo 'product_type_'.esc_attr( $product->product_type ); ?> alt"><?php echo $product->add_to_cart_text(); ?></button>
		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
		<div class="space10"></div>
	</form>

	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php endif; ?>
