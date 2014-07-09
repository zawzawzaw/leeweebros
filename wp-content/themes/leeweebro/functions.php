<?php 
/********************************************************************************************************/
/* CONSTANTS */
/********************************************************************************************************/

define("THEMEROOT", get_stylesheet_directory_uri());
define("IMAGES", THEMEROOT."/images");
define("JS", THEMEROOT."/js");
define("LIB", THEMEROOT."/lib");

/********************************************************************************************************/
/* WOOCOMMERCE */
/********************************************************************************************************/

define('WOOCOMMERCE_USE_CSS', false);

add_theme_support( 'woocommerce' );

add_filter( 'woocommerce_breadcrumb_defaults', 'jk_woocommerce_breadcrumbs' );
function jk_woocommerce_breadcrumbs() {
    return array(
            'delimiter'   => ' &#47; ',
            'wrap_before' => '',
            'wrap_after'  => '',
            'before'      => '',
            'after'       => '',
            'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
        );
}

// single product custom hooks
add_action( 'woocommerce_single_product_title_custom', 'woocommerce_template_single_title', 10 );
add_action( 'woocommerce_single_product_image_custom', 'woocommerce_show_product_images', 10 );
add_action( 'woocommerce_single_product_summary_custom', 'woocommerce_template_single_price', 20 );
add_action( 'woocommerce_single_product_summary_custom', 'woocommerce_template_single_excerpt', 30 );
add_action( 'woocommerce_single_product_summary_custom', 'woocommerce_template_single_meta', 50 );
add_action( 'woocommerce_single_product_summary_custom', 'woocommerce_template_single_sharing', 60 );
add_action( 'woocommerce_single_product_summary_custom', 'woocommerce_template_single_add_to_cart', 40 );

add_action( 'woocommerce_after_shop_loop_item_custom', 'woocommerce_template_loop_add_to_cart', 10 );
add_action( 'woocommerce_before_shop_loop_item_title_custom', 'woocommerce_template_loop_product_thumbnail', 10 );
add_action( 'woocommerce_shop_loop_item_desc_custom', 'woocommerce_template_loop_short_description', 10 );
add_action( 'woocommerce_after_shop_loop_item_title_custom', 'woocommerce_template_loop_price', 10 );

add_action( 'woocommerce_before_shop_loop_custom', 'wc_print_notices', 10 );
add_action( 'woocommerce_before_shop_loop_custom', 'woocommerce_catalog_ordering', 20 );

add_action( 'woocommerce_after_shop_loop_custom', 'woocommerce_result_count', 20 );

// short desc

if ( ! function_exists( 'woocommerce_template_loop_short_description' ) ) {

	/**
	 * Get the product price for the loop.
	 *
	 * @access public
	 * @subpackage	Loop
	 * @return void
	 */
	function woocommerce_template_loop_short_description() {
		wc_get_template( 'loop/short-description.php' );
	}
}

// for category page variable

if ( ! function_exists( 'woocommerce_template_loop_add_to_cart' ) ) {

  function woocommerce_template_loop_add_to_cart() {
    global $product;

    if ($product->product_type == "variable" && (is_product() || is_product_category() || is_product_tag())) {
      woocommerce_variable_add_to_cart();
    }
    else {
      woocommerce_get_template( 'loop/add-to-cart.php' );
    }
  }

}

add_filter( 'woocommerce_get_catalog_ordering_args', 'custom_woocommerce_get_catalog_ordering_args' );
 
function custom_woocommerce_get_catalog_ordering_args( $args ) {
  $orderby_value = isset( $_GET['orderby'] ) ? woocommerce_clean( $_GET['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
 
	if ( 'name_asc' == $orderby_value ) {
		$args['orderby'] = 'title';
		$args['order'] = 'ASC';
		$args['meta_key'] = '';
	}else if( 'name_desc' == $orderby_value ) {
		$args['orderby'] = 'title';
		$args['order'] = 'DESC';
		$args['meta_key'] = '';
	}else if( 'in_stock_first' == $orderby_value ) {
		$args['orderby'] = '_stock_status';
		$args['order'] = 'ASC';
		$args['meta_key'] = '_stock_status';
		$args['meta_value'] = 'instock';
		
	}
 
	return $args;
}
 
add_filter( 'woocommerce_default_catalog_orderby_options', 'custom_woocommerce_catalog_orderby_name_asc' );
add_filter( 'woocommerce_catalog_orderby', 'custom_woocommerce_catalog_orderby_name_asc' );
 
function custom_woocommerce_catalog_orderby_name_asc( $sortby ) {
	$sortby['name_asc'] = 'Name (A - Z)';
	return $sortby;
}

add_filter( 'woocommerce_default_catalog_orderby_options', 'custom_woocommerce_catalog_orderby_name_desc' );
add_filter( 'woocommerce_catalog_orderby', 'custom_woocommerce_catalog_orderby_name_desc' );
 
function custom_woocommerce_catalog_orderby_name_desc( $sortby ) {
	$sortby['name_desc'] = 'Name (Z - A)';
	return $sortby;
}

add_filter( 'woocommerce_default_catalog_orderby_options', 'custom_woocommerce_catalog_orderby_in_stock_asc' );
add_filter( 'woocommerce_catalog_orderby', 'custom_woocommerce_catalog_orderby_in_stock_asc' );
 
function custom_woocommerce_catalog_orderby_in_stock_asc( $sortby ) {
	$sortby['in_stock_first'] = 'In-stock first';
	return $sortby;
}

// now we set our cookie if we need to
function dl_sort_by_page($count) {
  if (isset($_COOKIE['shop_pageResults'])) { // if normal page load with cookie
     $count = $_COOKIE['shop_pageResults'];
  }
  if (isset($_GET['items'])) { //if form submitted
    setcookie('shop_pageResults', $_GET['items'], time()+1209600, '/', 'www.your-domain-goes-here.com', false); //this will fail if any part of page has been output- hope this works!
    $count = $_GET['items'];
  }
  // else normal page load and no cookie
  return $count;
}
 
add_filter('loop_shop_per_page','dl_sort_by_page');

wp_deregister_script('jquery');

// woo commerce JS reset
wp_dequeue_script('woocommerce');
wp_enqueue_script( 'woocommerce', get_bloginfo( 'stylesheet_directory' ). '/js/woocommerce.js', array( 'jquery', 'jquery-blockui' ), false, true );
wp_enqueue_script( 'bootstrap', get_bloginfo( 'stylesheet_directory' ). '/lib/bootstrap/dist/js/bootstrap.min.js', array( 'jquery' ), false, true );
wp_enqueue_script( 'jcarousel', get_bloginfo( 'stylesheet_directory' ). '/lib/jquery.jcarousel.min.js', array( 'jquery' ), false, true );
wp_enqueue_script( 'main', get_bloginfo( 'stylesheet_directory' ). '/js/main.js', array( 'jquery' ), false, true );

add_action( 'woocommerce_before_customer_login_form', 'jk_login_message' );
function jk_login_message() {
    if ( get_option( 'woocommerce_enable_myaccount_registration' ) == 'yes' ) {
	?>
		<div class="woocommerce-info">
			<p><?php _e( 'Returning customers login. New users register for next time so you can:' ); ?></p>
			<ul>
				<li><?php _e( 'View your order history' ); ?></li>
				<li><?php _e( 'Check on your orders' ); ?></li>
				<li><?php _e( 'Edit your addresses' ); ?></li>
				<li><?php _e( 'Change your password' ); ?></li>
			</ul>
		</div>
	<?php
	}
}