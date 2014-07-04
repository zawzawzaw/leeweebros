<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>

<div class="col-md-9" itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
		/**
		 * woocommerce_single_product_summary hook
		 *
		 * @hooked woocommerce_template_single_title - 5
		 * @hooked woocommerce_template_single_rating - 10
		 * @hooked woocommerce_template_single_price - 10
		 * @hooked woocommerce_template_single_excerpt - 20
		 * @hooked woocommerce_template_single_add_to_cart - 30
		 * @hooked woocommerce_template_single_meta - 40
		 * @hooked woocommerce_template_single_sharing - 50
		 */
		// do_action( 'woocommerce_single_product_summary' );
	?>
	<div class="row">
		<div class="col-md-12" id="page-title"><h1><?php the_title(); ?></h1></div>
	</div>
	<hr class="">
	<div class="space10"></div>
	<div class="row">
		<div class="col-md-6">
			<img src="images/content/otah.png" alt="otah">
			<a href="#">Print</a> | <a href="#">Full Size</a>
		</div>
		<div class="col-md-6">
			<h2><?php the_title(); ?></h2>
			<?php global $post, $product; ?>
			<div class="space10"></div>
			<p class="price-info"><span class="price red"><?php echo $product->get_price_html(); ?></span> <span class="per-item">per pcs</span></p>
			<div class="space10"></div>
			<p class="desc"><?php if ( $post->post_excerpt ) echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?></p>
			<div class="space10"></div>
			<div class="selectors">
				<div class="select-type">
					<div class="dropdown">
						<label for="type">Cooked or Raw: </label>
						<select name="type" id="type">
							<option value="Uncooked">Uncooked</option>
							<option value="Cooked">Cooked</option>
						</select>
					</div>
				</div>
				<div class="select-qty">
					<div class="dropdown">
						<label for="qty">Quantity: </label>
						<select name="qty" id="qty">
							<option value="50">50</option>
							<option value="40">40</option>
							<option value="30">30</option>
							<option value="20">20</option>
							<option value="10">10</option>
						</select>
					</div>
				</div>
			</div>
			<div class="space20"></div>
			<a href="<?php echo esc_url( $product_url ); ?>" rel="nofollow" class="single_add_to_cart_button button alt add-to-cart button"><?php echo $button_text; ?></a>
			<div class="space10"></div>
		</div>
	</div>

	<?php
		/**
		 * woocommerce_before_single_product_summary hook
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */
		// do_action( 'woocommerce_before_single_product_summary' );
	?>


	<?php
		/**
		 * woocommerce_after_single_product_summary hook
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_output_related_products - 20
		 */
		// do_action( 'woocommerce_after_single_product_summary' );
	?>

	<meta itemprop="url" content="<?php the_permalink(); ?>" />

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>
