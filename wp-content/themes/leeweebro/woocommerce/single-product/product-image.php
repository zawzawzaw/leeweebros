<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.14
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $woocommerce, $product;

?>

<div class="images">

	<?php
		if ( has_post_thumbnail() ) {

			$image_title = esc_attr( get_the_title() );
			$image_link  = wp_get_attachment_url( get_post_thumbnail_id() );
			$thumbnail_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
			// $timthumb_url = get_home_url()."/timthumb.php?src=".$thumbnail_url.'&h=249&w=320&zc=0';
			$image = '<img class="lazy img-responsive" data-original="'.$thumbnail_url.'" alt="product image">';
			// $image       = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
			// 	'title' => $image_title
			// 	) );

			$attachment_count = count( $product->get_gallery_attachment_ids() );

			if ( $attachment_count > 0 ) {
				$gallery = '[product-gallery]';
			} else {
				$gallery = '';
			}

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a>', $image_link, $image_title, $image ), $post->ID );

		} else {

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="" class="lazy" data-original="%s" alt="Placeholder" />', wc_placeholder_img_src() ), $post->ID );

		}
	?>

</div>

