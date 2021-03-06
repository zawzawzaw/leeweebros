<?php 
/**
 * My Account page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

wc_print_notices(); ?>

<div class="space10"></div>

<div class="row" id="my-account">
	<div id="sub-title" class="col-md-12">
		<h2 class="myaccount_user">
			<?php
			$wp_current_user = wp_get_current_user();
			$wp_current_user_fullname = $wp_current_user->user_firstname . ' ' . $wp_current_user->user_lastname;
			printf(
				__( 'Hello <strong>%1$s</strong> (not %1$s? <a href="%2$s">Sign out</a>).', 'woocommerce' ) . ' ',
				$wp_current_user_fullname,
				wp_logout_url( get_permalink( wc_get_page_id( 'myaccount' ) ) )
			);
			?>
		</h2>
		<p>
			<?php
			printf( __( 'From your account dashboard you can view your recent orders, manage your shipping and billing addresses and <a href="%s">edit your password and account details</a>.', 'woocommerce' ),
				wc_customer_edit_account_url()
			);
			?>
		</p>		
	</div>
</div>

<div class="space20"></div>

<?php do_action( 'woocommerce_before_my_account' ); ?>

<?php //wc_get_template( 'myaccount/my-downloads.php' ); ?>

<?php wc_get_template( 'myaccount/my-orders.php', array( 'order_count' => $order_count ) ); ?>

<?php wc_get_template( 'myaccount/my-address.php' ); ?>

<?php do_action( 'woocommerce_after_my_account' ); ?>
