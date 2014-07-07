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
?>
<!-- <div class="col-md-6">
<h2>FISH OTAH</h2>
<div class="space10"></div> -->

<h2><?php the_title(); ?></h2>
<div class="space10"></div>
<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">

	<p class="price price-info"><span class="price red"><?php echo $product->get_price_html(); ?></span> <span class="per-item">per pcs</span></p>

	<meta itemprop="price" content="<?php echo $product->get_price(); ?>" />
	<meta itemprop="priceCurrency" content="<?php echo get_woocommerce_currency(); ?>" />
	<link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />

</div>
<div class="space10"></div>