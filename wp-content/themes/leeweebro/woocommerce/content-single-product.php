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

<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="row">
		<div class="col-md-12" id="page-title">
			<?php
				/**
				 * woocommerce_single_product_title_custom hook
				 *
				 * @hooked woocommerce_template_single_title - 5
				 */
				do_action( 'woocommerce_single_product_title_custom' );
			?>			
		</div>
	</div>
	<hr class="">
	<div class="space10"></div>
	
	<div class="summary entry-summary row">
		
		<div class="col-md-6">
			<?php
				/**
				 * woocommerce_single_product_image_custom hook
				 *
				 * @hooked woocommerce_show_product_images - 10
				 */
				do_action( 'woocommerce_single_product_image_custom' );
			?>
			<a href="#" class="full-size">Full Size</a>
		</div>
		<div class="col-md-6">
			<?php
				/**
				 * woocommerce_single_product_summary hook
				 *
				 * @hooked woocommerce_template_single_title - 5
				 * @hooked woocommerce_show_product_images - 10
				 * @hooked woocommerce_template_single_price - 20
				 * @hooked woocommerce_template_single_excerpt - 30
				 * @hooked woocommerce_template_single_add_to_cart - 40
				 * @hooked woocommerce_template_single_meta - 50
				 * @hooked woocommerce_template_single_sharing - 60
				 */
				do_action('woocommerce_single_product_summary_custom');
				// do_action( 'woocommerce_single_product_summary' );
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
		</div>
	</div>
	<!-- .summary -->

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

</div>
<!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>
