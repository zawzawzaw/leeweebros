<?php 
/********************************************************************************************************/
/* CONSTANTS */
/********************************************************************************************************/

define("THEMEROOT", get_stylesheet_directory_uri());
define("IMAGES", THEMEROOT."/images");
define("JS", THEMEROOT."/js");
define("LIB", THEMEROOT."/lib");

/********************************************************************************************************/
/* MENUS */
/********************************************************************************************************/

function register_my_menus(){
  register_nav_menus(array(
    'main-menu' => __('Main Menu', 'leeweebro'),
    'footer-menu' => __('Footer Menu', 'leeweebro')
  ));
}

add_action('init', 'register_my_menus');

## adding class name to submenu parent li
function menu_set_dropdown( $sorted_menu_items, $args ) {
    $last_top = 0;
    foreach ( $sorted_menu_items as $key => $obj ) {
        // it is a top lv item?
        if ( 0 == $obj->menu_item_parent ) {
            // set the key of the parent
            $last_top = $key;
        } else {
            $sorted_menu_items[$last_top]->classes['dropdown'] = 'subnav';
        }
    }
    return $sorted_menu_items;
}
add_filter( 'wp_nav_menu_objects', 'menu_set_dropdown', 10, 2 );

/********************************************************************************************************/
/* CUSTOM POST TYPE & META BOXES */
/********************************************************************************************************/

require 'my-custom-posts.php';

# slider post #

add_post_type('slider', array(
    'supports' => array('title','aside','thumbnail','editor')
));

add_taxonomy('place', 'slider', array(
    'labels' => array('add_new_item' => 'Add New Page')
));

# end slider #

/********************************************************************************************************/
/* ADD WIDGETS SUPPORT */
/********************************************************************************************************/

function arphabet_widgets_init() {

    register_sidebar( array(
        'name' => 'Home right sidebar',
        'id' => 'home_right_1',
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="rounded">',
        'after_title' => '</h2>',
    ) );
}
add_action( 'widgets_init', 'arphabet_widgets_init' );

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

    if ($product->product_type == "variable") {
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
    setcookie('shop_pageResults', $_GET['items'], time()+1209600, '/', '103.25.202.72', false); //this will fail if any part of page has been output- hope this works!
    $count = $_GET['items'];
  }else {
    $count = 12; // default count
  }
  // else normal page load and no cookie
  return $count;
}
 
add_filter('loop_shop_per_page','dl_sort_by_page');
// add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 12;' ), 20 );

wp_deregister_script('jquery');

// woo commerce JS reset
wp_dequeue_script('woocommerce');
wp_enqueue_script( 'woocommerce', get_bloginfo( 'stylesheet_directory' ). '/js/woocommerce.js', array( 'jquery', 'jquery-blockui' ), false, true );
wp_enqueue_script( 'jqueryui', '//code.jquery.com/ui/1.11.0/jquery-ui.js', array( 'jquery' ), false, true );
wp_enqueue_script( 'bootstrap', get_bloginfo( 'stylesheet_directory' ). '/lib/bootstrap/dist/js/bootstrap.min.js', array( 'jquery' ), false, true );
wp_enqueue_script( 'jcarousel', get_bloginfo( 'stylesheet_directory' ). '/lib/jquery.jcarousel.min.js', array( 'jquery' ), false, true );
wp_enqueue_script( 'validator', get_bloginfo( 'stylesheet_directory' ). '/lib/jquery.validate.min.js', array( 'jquery' ), false, true );
wp_enqueue_script( 'googlemap', '//maps.googleapis.com/maps/api/js?v=3.exp', array( 'jquery' ), false, true );
// wp_enqueue_script( 'additionalvalidator', get_bloginfo( 'stylesheet_directory' ). '/lib/additional-methods.min.js', array( 'jquery' ), false, true );
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

    if ( isset( $_POST['first_name'] ) ) {
      update_user_meta($user_id, 'first_name', $_POST['first_name']);
      update_user_meta($user_id, 'address_book_1_first_name', $_POST['first_name']);
    }
    if( isset( $_POST['last_name'] ) ) {
    	update_user_meta($user_id, 'last_name', $_POST['last_name']);
      update_user_meta($user_id, 'address_book_1_last_name', $_POST['last_name']);
    }

    foreach ($_POST as $key => $value) {
      if($key!='day' && $key!='month' && $key!='year' && $key!='first_name' && $key!='last_name')
        add_user_meta( $user_id, $key, htmlspecialchars($_POST[$key], ENT_QUOTES, "utf-8") );
    }

    $dob = htmlspecialchars($_POST['day'], ENT_QUOTES, "utf-8") . '/' . htmlspecialchars($_POST['month'], ENT_QUOTES, "utf-8") . '/' . htmlspecialchars($_POST['year'], ENT_QUOTES, "utf-8");
    add_user_meta( $user_id, 'date_of_birth', $dob );
}

// Hook in (existing woocommerce fields override)
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields_billing_and_shipping' );

// Our hooked in function - $fields is passed via the filter!
function custom_override_checkout_fields_billing_and_shipping( $fields ) {

  $billing_address = json_decode(stripslashes($_POST['billing_address']), true);
  $address_book_index = 1;
  $user_id = get_current_user_id();

  if(isset($billing_address)) {
    $existing_or_new = $billing_address['existing_or_new'];
    $address_book_id = $billing_address['address_book_id'];

    foreach ($billing_address as $key => $value) {
      if($key!='future_ref') {

        // to save in order flow
        $billing_key = 'billing_'.$key;
        $fields['billing'][$billing_key]['default'] = $value;
        $fields['billing'][$billing_key]['label'] = $key;

        // to save to address book
        if($existing_or_new=="new") {

          $address_book_index = $address_book_id + 1;
          $address_book_key = 'address_book_'.$address_book_index.'_'.$key;
          update_user_meta($user_id, $address_book_key, $value);

        }else if($existing_or_new=="existing") {

          $address_book_index = $address_book_id;
          $address_book_key = 'address_book_'.$address_book_index.'_'.$key;
          // echo $user_id . ' ' . $address_book_key . ' ' . $value . '<br>';
          update_user_meta($user_id, $address_book_key, $value);

        }
      }
    }
  }

  $shipping_address = json_decode(stripslashes($_POST['shipping_address']), true);

  if(isset($shipping_address)) {
    $existing_or_new = $shipping_address['existing_or_new'];
    $address_book_id = $shipping_address['address_book_id'];
    $same_as_billing = $shipping_address['same_as_billing'];

    foreach ($shipping_address as $key => $value) {

      // to save in order flow
      $shipping_key = 'shipping_'.$key;
      $fields['shipping'][$shipping_key]['default'] = $value;
      $fields['shipping'][$shipping_key]['label'] = $key;

      // to save to address book
      if($existing_or_new=="new") {

        if($same_as_billing=='no') {
          // if billing was also new address
          if($billing_address['existing_or_new']=="new")
            $address_book_index = $address_book_id + 2;
          else
            $address_book_index = $address_book_id + 1;
        
          $address_book_key = 'address_book_'.$address_book_index.'_'.$key;
          update_user_meta($user_id, $address_book_key, $value);
        }

      }else if($existing_or_new=="existing") {

        $address_book_index = $address_book_id;
        $address_book_key = 'address_book_'.$address_book_index.'_'.$key;
        // echo $user_id . ' ' . $address_book_key . ' ' . $value . '<br>';
        update_user_meta($user_id, $address_book_key, $value);

      }
    }
  }

  $fields['order']['order_comments']['label'] = 'Special Instruction';
  $fields['order']['order_comments']['default'] = $_POST['special_instruction'];

  // remove required phone
  $fields['shipping']['shipping_phone'] = array(
    'label'     => __('Phone', 'woocommerce'),
    'placeholder'   => _x('Phone', 'placeholder', 'woocommerce'),
    'required'  => false,
    'class'     => array('form-row-wide'),
    'clear'     => true
  );

  // remove required city
  $fields['shipping']['shipping_city'] = array(
    'label'     => __('City', 'woocommerce'),
    'placeholder'   => _x('City', 'placeholder', 'woocommerce'),
    'required'  => false,
    'class'     => array('form-row-wide'),
    'clear'     => true
  );

  // remove required phone
  $fields['billing']['billing_phone'] = array(
    'label'     => __('Phone', 'woocommerce'),
    'placeholder'   => _x('Phone', 'placeholder', 'woocommerce'),
    'required'  => false,
    'class'     => array('form-row-wide'),
    'clear'     => true
  );

  // remove required city
  $fields['billing']['billing_city'] = array(
    'label'     => __('City', 'woocommerce'),
    'placeholder'   => _x('City', 'placeholder', 'woocommerce'),
    'required'  => false,
    'class'     => array('form-row-wide'),
    'clear'     => true
  );

  return $fields;
}

// Hook in (adding new checkout fields)
add_filter( 'woocommerce_after_order_notes' , 'custom_override_checkout_fields' );

// Our hooked in function - $fields is passed via the filter!
function custom_override_checkout_fields( $fields ) { 

    $receiving_mode = json_decode(stripslashes($_POST['receiving_mode']), true);

    if(isset($receiving_mode)) {
      foreach ($receiving_mode as $key => $value) {
        woocommerce_form_field( $key, array(
        'type'          => 'text',
        'class'         => array('my-field-class form-row-wide'),
        'label'         => __($key),
        'placeholder'   => __($key)
        ), $value);
      }  
    }     

    woocommerce_form_field( 'pay_by_cash_outlet', array(
        'type'          => 'text',
        'class'         => array('my-field-class form-row-wide'),
        'label'         => __('pay_by_cash_outlet'),
        'placeholder'   => __('Pay By Cash Outlet')
        ), '');

    return $fields;
}

/**
 * Update the order meta with field value
 */
add_action( 'woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_order_meta' );
 
function my_custom_checkout_field_update_order_meta( $order_id ) {
    if(isset($_POST)) {
       foreach ($_POST as $key => $value) {
        $post_key = '_'.$key;

        update_post_meta( $order_id, $post_key, sanitize_text_field( $_POST[$key] ) );
      }
    }
}

add_action( 'woocommerce_cart_calculate_fees','woocommerce_custom_surcharge' );
function woocommerce_custom_surcharge() {
  global $woocommerce;
 
  // if ( is_admin() && ! defined( 'DOING_AJAX' ) )
  //   return;

  if( isset($_POST['surcharge']) && !empty($_POST['surcharge']) ) $surcharge = $_POST['surcharge'];
  else if(isset($_POST['receiving_mode'])) {
    
    $receiving_mode = json_decode(stripslashes($_POST['receiving_mode']), true);
    $surcharge = $receiving_mode['surcharge'];

  }else if(isset($_POST['post_data'])) {
    
    $post_data = urldecode($_POST['post_data']);

    parse_str($post_data, $post_data_variables);
    $surcharge = $post_data_variables['surcharge'];
  } 

  $woocommerce->cart->add_fee( 'Surcharge', $surcharge, true, 'standard' );

}

// alter the subscriptions error
function my_woocommerce_add_error( $error ) {

    if (strpos($error,'The password you entered for the username') !== false) {
        $lost_password_url = esc_url( wc_lostpassword_url() );
        $error = '<strong>ERROR: </strong>Username or password is incorrect. <a href="'.$lost_password_url.'">Lost your password?</a>';
    }
    
    return $error;
}
add_filter( 'woocommerce_add_error', 'my_woocommerce_add_error' );

// ajax
add_action('wp_head','my_ajaxurl');
function my_ajaxurl() {
  $html = '<script type="text/javascript">';
  $html .= 'var ajaxurl = "' . admin_url( 'admin-ajax.php' ) . '"';
  $html .= '</script>';
  echo $html;
}

// save address ajax
add_action('wp_ajax_saveaddress', 'saveaddress_ajax');
function saveaddress_ajax() {
    $address_array = json_decode(stripslashes($_POST['postdata']), true);
    $user_id = get_current_user_id();

    foreach ($address_array as $key => $address) {
      $address_book_key = 'address_book_'.$address_array['address_book_id'].'_'.$key;
      update_user_meta($user_id, $address_book_key, $address);
    }
}

// delete address ajax
add_action('wp_ajax_deleteaddress', 'delete_address_ajax');
function delete_address_ajax() {
    $address_array = json_decode(stripslashes($_POST['postdata']), true);
    $user_id = get_current_user_id();

    foreach ($address_array as $key => $address) {
      $address_book_key = 'address_book_'.$address_array['address_book_id'].'_'.$key;
      delete_user_meta($user_id, $address_book_key);
    }
}

add_action('get_product_search_form', 'custom_wc_search');

// custom woocommerce search
function custom_wc_search() {
  $html = '<form role="search" method="get" id="searchform" action="'. esc_url( home_url( '/'  ) ) .'">
    <button id="searchsubmit" class="search-btn"></button>
    <input type="text" value="'. get_search_query() .'" name="s" id="search" placeholder="SEARCH" />
    <input type="hidden" name="post_type" value="product" />
</form>';

  return $html;
}

function the_excerpt_max_charlength($charlength) {
  $excerpt = get_the_excerpt();
  $charlength++;

  if ( strlen( $excerpt ) > $charlength ) {
    $subex = mb_substr( $excerpt, 0, $charlength - 5 );
    $exwords = explode( ' ', $subex );
    $excut = - ( strlen( $exwords[ count( $exwords ) - 1 ] ) );
    if ( $excut < 0 ) {
      echo mb_substr( $subex, 0, $excut );
    } else {
      echo $subex;
    }
    echo '[...]';
  } else {
    echo $excerpt;
  }
}