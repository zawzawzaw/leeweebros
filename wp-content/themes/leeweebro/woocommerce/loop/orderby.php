<?php
/**
 * Show options for ordering
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $wp_query;

if ( 1 == $wp_query->found_posts || ! woocommerce_products_will_display() )
	return;
?>

<form class="woocommerce-ordering" method="get">
	<a href="#" id="view-by">
		VIEW BY
		<div class="view">
			<ul id="viewby">
				<li id="listview">List</li>
				<li id="gridview">Grid</li>
			</ul>
		</div>
	</a>
	
	<a href="#" id="order-by">
		SORT BY
		<div class="sort">
			<ul id="orderby">
				<li>None</li>
				<li>Price (Lowest)</li>
				<li>Price (Highest)</li>
				<li>Name (A - Z)</li>
				<li>In-stock first</li>
			</ul>
		</div>
	</a>
	<select name="orderby" class="orderby" style="display:none;">
		<?php
			$catalog_orderby = apply_filters( 'woocommerce_catalog_orderby', array(
				'date' => __( 'Sort by', 'woocommerce' ),
				'menu_order' => __( 'Default', 'woocommerce' ),
				'price'      => __( 'Price (Lowest)', 'woocommerce' ),
				'price-desc' => __( 'Price (Highest)', 'woocommerce' )
			) );

			if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' )
				unset( $catalog_orderby['rating'] );

			foreach ( $catalog_orderby as $id => $name )
				echo '<option value="' . esc_attr( $id ) . '" ' . selected( $orderby, $id, false ) . '>' . esc_attr( $name ) . '</option>';
		?>
	</select>
	<?php
		// Keep query string vars intact
		foreach ( $_GET as $key => $val ) {
			if ( 'orderby' === $key || 'submit' === $key )
				continue;
			
			if ( is_array( $val ) ) {
				foreach( $val as $innerVal ) {
					echo '<input type="hidden" name="' . esc_attr( $key ) . '[]" value="' . esc_attr( $innerVal ) . '" />';
				}
			
			} else {
				echo '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" />';
			}
		}
	?>
	<a href="#">
		ITEMS
		<div class="item">
			<ul id="item">
				<li>12</li>
				<li>24</li>
				<li>All</li>
			</ul>
		</div>
	</a>
    <select name="items" class="items" style="display:none;">
		<?php
			//Get products on page reload
			if  (isset($_GET['items']) && (($_COOKIE['shop_pageResults'] <> $_GET['items']))) {
		    	$items = $_GET['items'];
		  	} else {
		    	$items = $_COOKIE['shop_pageResults'];
		  	}

			//  This is where you can change the amounts per page that the user will use  feel free to change the numbers and text as you want, in my case we had 4 products per row so I chose to have multiples of four for the user to select.
			$shopCatalog_orderby = apply_filters('woocommerce_sortby_page', array(
			//Add as many of these as you like, -1 shows all products per page
			   	''       => __('ITEMS', 'woocommerce'),
				'12' 		=> __('12', 'woocommerce'),
				'24' 		=> __('24', 'woocommerce'),
				'-1' 		=> __('All', 'woocommerce'),
			));

			foreach ( $shopCatalog_orderby as $sort_id => $sort_name )
				echo '<option value="' . $sort_id . '" ' . selected( $items, $sort_id, true ) . ' >' . $sort_name . '</option>';
		?>
	</select>
</form>