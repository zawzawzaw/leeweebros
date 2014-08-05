<?php
/*
Plugin Name: WooCommerce Custom Payment Gateway
Plugin URI: http://www.manic.com.sg
Description: Custom Payment gateway for woocommerce
Version: 0.1
Author: MANIC
Author URI: http://www.manic.com.sg
*/
add_action('plugins_loaded', 'woocommerce_custom_payment_gateway_init', 0);

function woocommerce_custom_payment_gateway_init() {
  	if(!class_exists('WC_Payment_Gateway')) return;
 
  	class WC_Gateway_Custom_Payment_Gateway_1 extends WC_Payment_Gateway{

	    public function __construct(){
	    	$this->id = 'advance_payment_by_internet_banking_atm';
			$this->icon = apply_filters( 'woocommerce_cod_icon', '' );
			$this->method_title = 'Advance Payment Internet Banking/ATM';
			$this->method_description = 'Pay by internet banking or atm after delivery';		
			$this->has_fields = false;

			$this->init_form_fields();
			$this->init_settings();

			$this->title = $this->get_option( 'title' );
			$this->description = $this->get_option( 'description' );
			$this->instructions = $this->get_option( 'instructions' );

			add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );
			add_action( 'woocommerce_thankyou_apbtatm', array( $this, 'thankyou_page' ) );
	    }

	    function init_form_fields(){
 
	       	$this->form_fields = array(
	            'enabled' => array(
	                'title' => __('Enable/Disable', 'woocommerce'),
	                'type' => 'checkbox',
	                'label' => __('Enable This Payment Method', 'woocommerce'),
	                'default' => 'no'),
	            'title' => array(
	                'title' => __('Title:', 'woocommerce'),
	                'type'=> 'text',
	                'description' => __('This controls the title which the user sees during checkout.', 'woocommerce'),
	                'default' => __('Advance payment by internet funds transfer/ATM', 'woocommerce')),
	            'description' => array(
	                'title' => __('Description:', 'woocommerce'),
	                'type' => 'textarea',
	                'description' => __('This controls the description which the user sees during checkout.', 'woocommerce'),
	                'default' => __('', 'woocommerce')),
 	            'instructions' => array(
 	                'title'       => __( 'Instructions', 'woocommerce' ),
 	                'type'        => 'textarea',
 	                'description' => __( 'Instructions that will be added to the thank you page.', 'woocommerce' ),
 	                'default'     => __( 'Advance payment by internet funds transfer/ATM', 'woocommerce' ),
 	                'desc_tip'    => true,
 	             )
	        );
	    }

	    function process_payment( $order_id ) {

			$order = new WC_Order( $order_id );

			// Mark as processing (payment won't be taken until delivery)
			$order->update_status('processing', __( 'Advance payment by internet funds transfer/ATM', 'woocommerce' ));

			// Reduce stock levels
			$order->reduce_order_stock();

			// Remove cart
			WC()->cart->empty_cart();

			// Return thankyou redirect
			return array(
				'result' => 'success',
				'redirect' => $this->get_return_url( $order )
			);
		}

		public function thankyou_page() {
	        if ( $this->instructions )
	            echo wpautop( wptexturize( $this->instructions ) );
	    }

	}

	class WC_Gateway_Custom_Payment_Gateway_2 extends WC_Payment_Gateway{

		public function __construct(){
	    	$this->id = 'advance_payment_by_cash_at_outlets';
			$this->icon = apply_filters( 'woocommerce_cod_icon', '' );
			$this->method_title = 'Advance Payment By Cash';
			$this->method_description = 'Pay by cash at one of the outlets';		
			$this->has_fields = false;

			$this->init_form_fields();
			$this->init_settings();

			$this->title = $this->get_option( 'title' );
			$this->description = $this->get_option( 'description' );
			$this->instructions = $this->get_option( 'instructions' );

			add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );
			add_action( 'woocommerce_thankyou_apbtatm', array( $this, 'thankyou_page' ) );
	    }

	    function init_form_fields(){
 
	       	$this->form_fields = array(
	            'enabled' => array(
	                'title' => __('Enable/Disable', 'woocommerce'),
	                'type' => 'checkbox',
	                'label' => __('Enable This Payment Method', 'woocommerce'),
	                'default' => 'no'),
	            'title' => array(
	                'title' => __('Title:', 'woocommerce'),
	                'type'=> 'text',
	                'description' => __('This controls the title which the user sees during checkout.', 'woocommerce'),
	                'default' => __('Advance payment by cash at outlets', 'woocommerce')),
	            'description' => array(
	                'title' => __('Description:', 'woocommerce'),
	                'type' => 'textarea',
	                'description' => __('This controls the description which the user sees during checkout.', 'woocommerce'),
	                'default' => __('', 'woocommerce')),
 	            'instructions' => array(
 	                'title'       => __( 'Instructions', 'woocommerce' ),
 	                'type'        => 'textarea',
 	                'description' => __( 'Instructions that will be added to the thank you page.', 'woocommerce' ),
 	                'default'     => __( 'Advance payment by cash at outlets', 'woocommerce' ),
 	                'desc_tip'    => true,
 	             )
	        );
	    }

	    function process_payment( $order_id ) {

			$order = new WC_Order( $order_id );

			// Mark as processing (payment won't be taken until delivery)
			$order->update_status('processing', __( 'Advance payment by cash at outlet', 'woocommerce' ));

			// Reduce stock levels
			$order->reduce_order_stock();

			// Remove cart
			WC()->cart->empty_cart();

			// Return thankyou redirect
			return array(
				'result' => 'success',
				'redirect' => $this->get_return_url( $order )
			);
		}

		public function thankyou_page() {
	        if ( $this->instructions )
	            echo wpautop( wptexturize( $this->instructions ) );
	    }
	}

	/**
     * Add the Gateway to WooCommerce
     **/
    function woocommerce_add_custom_payment_gateway($methods) {
        $methods[] = 'WC_Gateway_Custom_Payment_Gateway_1';
        $methods[] = 'WC_Gateway_Custom_Payment_Gateway_2';
        return $methods;
    }
 
    add_filter('woocommerce_payment_gateways', 'woocommerce_add_custom_payment_gateway' );
}