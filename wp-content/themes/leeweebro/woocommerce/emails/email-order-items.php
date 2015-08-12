<?php
/**
 * Email Order Items
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     2.1.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $woocommerce;

foreach ( $items as $item ) :
	$_product     = apply_filters( 'woocommerce_order_item_product', $order->get_product_from_item( $item ), $item );
	$item_meta    = new WC_Order_Item_Meta( $item['item_meta'], $_product );
	$terms = get_the_terms( $_product->id, 'product_cat' );

	$category = (isset($terms[0]->name)) ? $terms[0]->name : '';
	?>
	<tr>
		<td style="text-align:left; vertical-align:middle; border: none; word-wrap:break-word; padding: 0px 6px 0px 6px;"><?php

			// Show title/image etc
			if ( $show_image ) {
				echo apply_filters( 'woocommerce_order_item_thumbnail', '<img src="' . ( $_product->get_image_id() ? current( wp_get_attachment_image_src( $_product->get_image_id(), 'thumbnail') ) : wc_placeholder_img_src() ) .'" alt="' . __( 'Product Image', 'woocommerce' ) . '" height="' . esc_attr( $image_size[1] ) . '" width="' . esc_attr( $image_size[0] ) . '" style="vertical-align:middle; margin-right: 10px;" />', $item );
			}

			// Product name
			echo $category . ' - ' . apply_filters( 'woocommerce_order_item_name', $item['name'], $item );

			// SKU
			if ( $show_sku && is_object( $_product ) && $_product->get_sku() ) {
				echo ' (#' . $_product->get_sku() . ')';
			}

			// File URLs
			if ( $show_download_links && is_object( $_product ) && $_product->exists() && $_product->is_downloadable() ) {

				$download_files = $order->get_item_downloads( $item );
				$i              = 0;

				foreach ( $download_files as $download_id => $file ) {
					$i++;

					if ( count( $download_files ) > 1 ) {
						$prefix = sprintf( __( 'Download %d', 'woocommerce' ), $i );
					} elseif ( $i == 1 ) {
						$prefix = __( 'Download', 'woocommerce' );
					}

					echo '<br/><small>' . $prefix . ': <a href="' . esc_url( $file['download_url'] ) . '" target="_blank">' . esc_html( $file['name'] ) . '</a></small>';
				}
			}

			// Variation
			if ( $item_meta->meta ) {
				echo '<br/><small>' . nl2br( $item_meta->display( true, true ) ) . '</small>';
			}

		?></td>
		<td style="text-align:left; vertical-align:middle; border: none; padding: 0px 6px 0px 6px;"><?php echo $item['qty'] ;?></td>
		<td style="text-align:left; vertical-align:middle; border: none; padding: 0px 6px 0px 6px;"><?php echo $order->get_formatted_line_subtotal( $item ); ?></td>
	</tr>

	<?php if ( $show_purchase_note && is_object( $_product ) && $purchase_note = get_post_meta( $_product->id, '_purchase_note', true ) ) : ?>
		<tr>
			<td colspan="3" style="text-align:left; vertical-align:middle; border: none;"><?php echo apply_filters( 'the_content', $purchase_note ); ?></td>
		</tr>
	<?php endif; ?>

	<tr>
		<td colspan="3" style="text-align:left; vertical-align:middle; border: none;padding-top: 0; padding-bottom: 0;"><hr style="margin:0;padding:0;border: none;height: 1px;background:#cea77c;"></td>
	</tr>

<?php endforeach; ?>
