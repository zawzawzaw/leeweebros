<?php
/**
 * Loop Price
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

<?php if ( $price_html = $product->get_price_html() ) : ?>
	<div class="space40"></div>
	<p class="price-info">
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
		?>
			<br>
		<?php
		else:
		?>
			<span class="price"><?php echo $price_html; ?></span><br>
		<?php
		endif; 
		?>
		
		<span class="per-item"><?php echo $per_attribute; ?></span>
	</p>
	<div class="space10"></div>
<?php endif; ?>