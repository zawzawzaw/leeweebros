<?php
/**
 * Variable product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $product, $post;
$min_order = $product->get_attribute( 'min order' );

foreach ($available_variations as $key => &$each_variable) {
	$each_variable['image_src'] = get_home_url()."/timthumb.php?src=".$each_variable['image_link'].'&h=249&w=320&zc=0';
}

// print_r($available_variations);
?>

<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>
<form class="variations_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo $post->ID; ?>" data-product_variations="<?php echo esc_attr( json_encode( $available_variations ) ) ?>">
	<?php if ( ! empty( $available_variations ) ) : ?>
		<div class="selectors">
			<div class="variations select-type">
				<div class="dropdown">
					<?php $loop = 0; foreach ( $attributes as $name => $options ) : $loop++; ?>
							<label for="<?php echo sanitize_title($name); ?>"><?php echo wc_attribute_label( $name ); ?></label>
							<select id="<?php echo esc_attr( sanitize_title( $name ) ); ?>" name="attribute_<?php echo sanitize_title( $name ); ?>">
								<!-- <option value=""><?php echo __( 'Choose an option', 'woocommerce' ) ?>&hellip;</option> -->
								<?php
									if ( is_array( $options ) ) {

										if ( isset( $_REQUEST[ 'attribute_' . sanitize_title( $name ) ] ) ) {
											$selected_value = $_REQUEST[ 'attribute_' . sanitize_title( $name ) ];
										} elseif ( isset( $selected_attributes[ sanitize_title( $name ) ] ) ) {
											$selected_value = $selected_attributes[ sanitize_title( $name ) ];
										} else {
											$selected_value = '';
										}

										// Get terms if this is a taxonomy - ordered
										if ( taxonomy_exists( $name ) ) {

											$orderby = wc_attribute_orderby( $name );

											switch ( $orderby ) {
												case 'name' :
													$args = array( 'orderby' => 'name', 'hide_empty' => false, 'menu_order' => false );
												break;
												case 'id' :
													$args = array( 'orderby' => 'id', 'order' => 'ASC', 'menu_order' => false, 'hide_empty' => false );
												break;
												case 'menu_order' :
													$args = array( 'menu_order' => 'ASC', 'hide_empty' => false );
												break;
											}

											$terms = get_terms( $name, $args );

											foreach ( $terms as $term ) {
												if ( ! in_array( $term->slug, $options ) )
													continue;

												echo '<option value="' . esc_attr( $term->slug ) . '" ' . selected( sanitize_title( $selected_value ), sanitize_title( $term->slug ), false ) . '>' . apply_filters( 'woocommerce_variation_option_name', $term->name ) . '</option>';
											}
										} else {

											foreach ( $options as $option ) {
												echo '<option value="' . esc_attr( sanitize_title( $option ) ) . '" ' . selected( sanitize_title( $selected_value ), sanitize_title( $option ), false ) . '>' . esc_html( apply_filters( 'woocommerce_variation_option_name', $option ) ) . '</option>';
											}

										}
									}
								?>
							</select> 
							<?php
								// if ( sizeof( $attributes ) == $loop )
									// echo '<a class="reset_variations" href="#reset">' . __( 'Clear selection', 'woocommerce' ) . '</a>';
							?>
			        <?php endforeach;?>
			    </div>
			</div>

			<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

			<div class="single_variation_wrap" style="display:none;">
				<?php do_action( 'woocommerce_before_single_variation' ); ?>

				<!-- <div class="single_variation"></div> -->

				<label for="qty">Quantity: </label>
				<?php woocommerce_quantity_input(); ?>
				

			</div>
		</div>
		<div class="space20"></div>
		<span id="min-order" style="display:none;"><?php echo (!empty($min_order)) ? $min_order : 1; ?></span>
		<input type="hidden" name="add-to-cart" value="<?php echo $product->id; ?>" />
		<input type="hidden" name="variation_id" value="" />
		<input type="hidden" name="product_id" value="<?php echo esc_attr( $post->ID ); ?>" />
		<button type="submit" class="single_add_to_cart_button button alt"><?php echo $product->single_add_to_cart_text(); ?></button>
		<span class="error-msg"></span>
		<?php do_action( 'woocommerce_after_single_variation' ); ?>
		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

	<?php else : ?>

		<p class="stock out-of-stock"><?php _e( 'This product is currently out of stock and unavailable.', 'woocommerce' ); ?></p>

	<?php endif; ?>
</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
