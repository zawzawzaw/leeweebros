<?php
/**
 * Simple product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $product;
$min_order = $product->get_attribute( 'min order' );

if ( ! $product->is_purchasable() ) return;
?>

<?php
	// Availability
	// $availability = $product->get_availability();

	// if ( $availability['availability'] )
		// echo apply_filters( 'woocommerce_stock_html', '<p class="stock ' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</p>', $availability['availability'] );
?>

<?php if ( $product->is_in_stock() ) : ?>

	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

	<form class="cart" method="post" enctype='multipart/form-data'>
		<div class="selectors">
			<!-- <div class="select-type">
				<div class="dropdown">
					<label for="type">Cooked or Raw: </label>
					<select name="type" id="type">
						<option value="Uncooked">Uncooked</option>
						<option value="Cooked">Cooked</option>
					</select>
				</div>
			</div> -->
		
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
	 	<button type="submit" class="single_add_to_cart_button button alt"><?php echo $product->single_add_to_cart_text(); ?></button>
	 	<span class="error-msg"></span>
	 	<div class="space10"></div>

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	</form>

	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php endif; ?>