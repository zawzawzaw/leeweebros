<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] = 'first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';
?>
<div <?php post_class( $classes ); ?>>
	<div class="row">
		<div class="col-md-4">
			<a href="<?php the_permalink(); ?>">
				<?php do_action( 'woocommerce_before_shop_loop_item_title_custom' ); ?>
			</a>
		</div>
		<div class="col-md-6">
			<a href="<?php the_permalink(); ?>"><h2><?php echo (strlen(get_the_title()) > 20) ? substr(get_the_title(), 0, 20) . '...' : get_the_title(); ?></h2></a>
			<?php do_action('woocommerce_shop_loop_item_desc_custom'); ?>
			
			<?php do_action( 'woocommerce_after_shop_loop_item_custom' ); ?>
			<div class="space10"></div>
		</div>
		<div class="col-md-2" style="padding-left:0;">
			<!-- <div class="space40"></div> -->
			<?php do_action( 'woocommerce_after_shop_loop_item_title_custom' ); ?>
			<!-- <p class="price-info"><span class="price">S$0.60</span><br><span class="per-item">per pcs</span></p> -->
			<div class="space10"></div>
		</div>
	</div>
</div>
<div class="space30"></div>