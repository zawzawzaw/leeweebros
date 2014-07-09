<?php
/**
 * Loop Price
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;
$per_attribute = $product->get_attribute( 'per' );
?>

<?php if ( $price_html = $product->get_price_html() ) : ?>
	<div class="space40"></div>
	<p class="price-info"><span class="price"><?php echo $price_html; ?></span><br><span class="per-item"><?php echo $per_attribute; ?></span></p>
	<div class="space10"></div>
<?php endif; ?>