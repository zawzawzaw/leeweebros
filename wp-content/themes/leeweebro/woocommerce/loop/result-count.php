<?php
/**
 * Result Count
 *
 * Shows text: Showing x - x of x results
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $wp_query;

if ( ! woocommerce_products_will_display() )
	return;
?>
<p class="woocommerce-result-count page-navi">
	<?php
	$paged    = max( 1, $wp_query->get( 'paged' ) );
	$per_page = $wp_query->get( 'posts_per_page' );
	$total    = $wp_query->found_posts;
	$total_page = ceil($total/$per_page);
	$first    = ( $per_page * $paged ) - $per_page + 1;
	$last     = min( $total, $wp_query->get( 'posts_per_page' ) * $paged );
	if($last==-1){
		$last = $total;
	}

	if ( 1 == $total ) {
		_e( 'Showing the single result', 'woocommerce' );
	} elseif ( $total <= $per_page || -1 == $per_page ) {
		// printf( _x( 'Showing %1$d - %2$d of %3$d (%4$d page)', '%1$d = first, %2$d = last, %3$d = total, %4$d = total_page', 'woocommerce' ), $first, $last, $total, $total_page );
		printf( _x( 'Showing %1$d - %2$d of %3$d', '%1$d = first, %2$d = last, %3$d = total, %4$d = total_page', 'woocommerce' ), $first, $last, $total, $total_page );
	} else {
		printf( _x( 'Showing %1$d - %2$d of %3$d', '%1$d = first, %2$d = last, %3$d = total, %4$d = total_page', 'woocommerce' ), $first, $last, $total, $total_page );
		// printf( _x( 'Showing %1$d - %2$d of %3$d (%4$d pages)', '%1$d = first, %2$d = last, %3$d = total, %4$d = total_page', 'woocommerce' ), $first, $last, $total, $total_page );
	}
	?>
</p>