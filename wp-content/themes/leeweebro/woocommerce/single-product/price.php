<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;
$per_attribute = $product->get_attribute( 'per' );

if($product->product_type=='variable') {
	$product = new WC_Product_Variable( $post->ID );
	$available_variations = $product->get_available_variations();

	foreach ($available_variations as $key => $variable) {
		$variation_id = $variable['variation_id'];
		$variable_product[] = new WC_Product_Variation( $variation_id );
	}
}
?>

<h2><?php the_title(); ?></h2>
<div class="space10"></div>
<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">

	<p class="price price-info">
		<?php 
		if($product->product_type=='variable'):
			foreach ($variable_product as $vk => $vp): ?>
				<?php 
					$data_key = key($vp->variation_data); 
					$data = $vp->variation_data[$data_key];
				?>
				<span class="price variable-price <?php echo $data; ?>" <?php if($vk!==0): ?>style="display:none;"<?php endif; ?>>
					<?php echo (!empty($vp->sale_price)) ? '$'.number_format((float)$vp->sale_price, 2, '.', '') : '$'.number_format((float)$vp->regular_price, 2, '.', ''); ?>
				</span>
		<?php
			endforeach;
		else:
		?>
			<span class="price"><?php echo $product->get_price_html(); ?></span> 
		<?php
		endif; 
		?>
		<span class="per-item"><?php echo $per_attribute; ?></span>
	</p>

	<meta itemprop="price" content="<?php echo $product->get_price(); ?>" />
	<meta itemprop="priceCurrency" content="<?php echo get_woocommerce_currency(); ?>" />
	<link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />

</div>
<div class="space10"></div>