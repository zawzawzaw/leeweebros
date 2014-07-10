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

// Woocommerce New Customer Admin Notification Email
// add_action('woocommerce_created_customer', 'admin_email_on_registration');
// function admin_email_on_registration() {
//     $user_id = get_current_user_id();
//     wp_new_user_notification( $user_id );
// }

// Add the code below to your theme's functions.php file to add a confirm password field on the register form under My Accounts.
add_filter('woocommerce_registration_errors', 'registration_errors_validation', 10, 3);
function registration_errors_validation($reg_errors, $sanitized_user_login, $user_email) {
	global $woocommerce;
	$error = new WP_Error();
	extract( $_POST );
 
	if ( empty($first_name) ) {
		// $error->add('registration-error', __( 'Please enter your first name.', 'woocommerce' ));
		return new WP_Error( 'registration-error', __( 'Please enter your first name.', 'woocommerce' ) );
	}
	if( empty($last_name) ) {
		return new WP_Error( 'registration-error', __( 'Please enter your last name.', 'woocommerce' ) );	
	}

	return $reg_errors;
}

add_action( 'user_register', 'myplugin_registration_save', 10, 1 );

function myplugin_registration_save( $user_id ) {

    if ( isset( $_POST['first_name'] ) )
        update_user_meta($user_id, 'first_name', $_POST['first_name']);
    if( isset( $_POST['last_name'] ) )
    	update_user_meta($user_id, 'last_name', $_POST['last_name']);
    if(isset($_POST['title']))
    	add_user_meta( $user_id, 'title', $_POST['title'] );
    if(isset($_POST['dob']))
    	add_user_meta( $user_id, 'dob', $_POST['dob'] );
    if(isset($_POST['first_name_address']))
    	add_user_meta( $user_id, 'first_name_address', $_POST['first_name_address'] );
    if(isset($_POST['last_name_address']))
    	add_user_meta( $user_id, 'last_name_address', $_POST['last_name_address'] );
    if(isset($_POST['company']))
    	add_user_meta( $user_id, 'company', $_POST['company'] );   
    if(isset($_POST['address_1']))
    	add_user_meta( $user_id, 'address_1', $_POST['address_1'] );
    if(isset($_POST['address_2']))
    	add_user_meta( $user_id, 'address_2', $_POST['address_2'] );
    if(isset($_POST['zip_postal_code']))
    	add_user_meta( $user_id, 'zip_postal_code', $_POST['zip_postal_code'] );
    if(isset($_POST['town']))
    	add_user_meta( $user_id, 'town', $_POST['town'] );
    if(isset($_POST['country']))
    	add_user_meta( $user_id, 'country', $_POST['country'] );
    if(isset($_POST['addition_info']))
    	add_user_meta( $user_id, 'addition_info', $_POST['addition_info'] );
    if(isset($_POST['telephone']))
    	add_user_meta( $user_id, 'telephone', $_POST['telephone'] );
    if(isset($_POST['mobile']))
    	add_user_meta( $user_id, 'mobile', $_POST['mobile'] );
    if(isset($_POST['future_ref']))
    	add_user_meta( $user_id, 'future_ref', $_POST['future_ref'] );
    
}